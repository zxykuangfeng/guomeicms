<?php

class P8_pgsql {

    var $connected = false;
    /** @var PDO|null */
    var $link = null;
    /** @var PDOStatement|null */
    var $pdoStatement = null;
    var $query_num = 0;
    var $version = '';
    var $last_error = '';
    var $last_errno = 0;

    var $host;
    var $user;
    var $password;
    var $db;
    var $charset;
    var $pconnect;
    var $port;

    // 日志文件（一定会写）
    private $logfile = '/tmp/p8_pgsql_error.log';

    function __construct($host, $user, $password, $db, $charset = 'utf8', $port = 5432, $pconnect = false){
        $this->host = $host;
        $this->user = 'tpcc';
        $this->password = 'tpcc@123';
        $this->db = 'test';
        $this->charset = $charset ?: 'utf8';
        $this->pconnect = 'false';
        $this->port =  5432;

    }

    private function log($msg){
        // 永远落盘日志，方便你在服务器上 tail 看
        @file_put_contents($this->logfile, '['.date('Y-m-d H:i:s')."] $msg\n", FILE_APPEND);
    }

    function connect(){
        if($this->connected) return 0;

        $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // 关键：抛异常
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        if($this->pconnect){
            $options[PDO::ATTR_PERSISTENT] = true;
        }

        try{
            $this->link = new PDO($dsn, $this->user, $this->password, $options);
            // 编码 & schema（按需改成你的 schema）
            if($this->charset){
                $this->link->exec("SET NAMES '{$this->charset}'");
            }
            $this->link->exec("SET client_encoding TO 'UTF8'");
            // 如果你的表都在 public，可以固定；如果有别的 schema，按需改：
            $this->link->exec("SET search_path TO public");
        }catch(PDOException $e){
            $this->last_errno = (int)$e->getCode();
            $this->last_error = $e->getMessage();
            $this->log("CONNECT ERROR: {$this->last_errno} {$this->last_error}");
            // 同时也直接输出一份（便于前端立刻看到）
            echo "❌ DB CONNECT ERROR: {$this->last_error}";
            return -1;
        }

        $this->connected = true;
        return 0;
    }

   protected function normalize_sql($query){
    if(is_array($query)) return $query;

    $query = $this->parsesql($query);
    if($query === '') return '';

    // 兼容 MySQL 反引号
    $query = str_replace('`', '"', $query);

    // 自动替换 MySQL 函数或关键字
    $query = str_ireplace(['now()','ifnull','unsigned'], ['CURRENT_TIMESTAMP','coalesce',''], $query);

    // 兼容 MySQL 的 LIMIT m,n
    if(preg_match('/LIMIT\s+(\d+)\s*,\s*(\d+)/i', $query, $m)){
        $query = preg_replace('/LIMIT\s+(\d+)\s*,\s*(\d+)/i', 'LIMIT '.$m[2].' OFFSET '.$m[1], $query);
    }

    return $query;
}

    function querys($query, $type = ''){
        if(is_array($query)){
            $ret = false;
            foreach($query as $sql){
                $ret = $this->query($sql, $type);
            }
            return $ret;
        }
        return $this->query($query, $type);
    }
    

    function query($query, $type = ''){ 
    if(!$this->connected){
        $c = $this->connect();
        if($c !== 0) return false;
    }

    $query = $this->normalize_sql($query);
    if($query === '') return false;

    // === ① 自动跳过 MySQL 专属语法 ===
    $lower = strtolower(trim($query));
    if (strpos($lower, 'repair table') === 0 || strpos($lower, 'optimize table') === 0 || strpos($lower, 'analyze table') === 0) {
        $this->log("SKIP MySQL-only SQL: {$query}");
        return true; // 什么也不做，直接返回成功
    }

    try{
        $this->pdoStatement = $this->link->query($query);
        $this->query_num++;
        return $this->pdoStatement;

    }catch(PDOException $e){
        $this->last_errno = (int)$e->getCode();
        $this->last_error = $e->getMessage();

        // === ② 针对 Vastbase 缺省值错误的自动修复逻辑 ===
        if (stripos($this->last_error, "doesn't have a default value") !== false ||
            stripos($this->last_error, "null value in column") !== false) {

            $this->log("AUTO-FIX: Missing NOT NULL field detected in SQL: {$query}");

            // 1️⃣ 提取表名
            if (preg_match('/INSERT\s+INTO\s+("?[\w\.]+"?)/i', $query, $m)) {
                $table = trim($m[1], '"');
            } else {
                $this->log("AUTO-FIX: 无法识别表名，跳过");
                return false;
            }

            // 2️⃣ 直接查询表结构（避免递归）
            $cols = [];
            try {
                $metaSQL = "SELECT column_name, column_default, is_nullable 
                            FROM information_schema.columns 
                            WHERE table_schema='public' AND table_name='{$table}'";
                $metaResult = $this->link->query($metaSQL);
                while ($r = $metaResult->fetch(PDO::FETCH_ASSOC)) {
                    $cols[$r['column_name']] = [
                        'nullable' => ($r['is_nullable'] == 'YES'),
                        'default'  => $r['column_default']
                    ];
                }
            } catch (Exception $e2) {
                $this->log("META QUERY ERROR: ".$e2->getMessage());
            }

            // 3️⃣ 自动补全缺字段
            if ($cols && preg_match('/INSERT\s+INTO\s+("[^"]+"|\w+)\s*\(([^)]+)\)\s*VALUES\s*\(([^)]+)\)/i', $query, $m)) {

                $fields = array_map(function($x){ return trim($x,'" '); }, explode(',', $m[2]));
                $values = array_map('trim', explode(',', $m[3]));

                foreach ($cols as $col => $meta) {
                    if (!in_array($col, $fields)) {
                        $fields[] = '"' . $col . '"';
                        $values[] = ($meta['nullable'] ? 'NULL' : ($meta['default'] ? $meta['default'] : '0'));
                    }
                }

                $fixedSQL = 'INSERT INTO '.$m[1].' ('.implode(',', $fields).') VALUES ('.implode(',', $values).')';
                $this->log("AUTO-FIX RETRY SQL: {$fixedSQL}");

                try {
                    $this->pdoStatement = $this->link->query($fixedSQL);
                    $this->query_num++;
                    echo "<div style='color:green'>⚙️ AUTO-FIX: 已自动补全缺字段并执行成功。</div>";
                    return $this->pdoStatement;
                } catch (PDOException $e3) {
                    $this->log("AUTO-FIX RETRY FAILED: ".$e3->getMessage()." | SQL: ".$fixedSQL);
                    echo "<pre>❌ AUTO-FIX RETRY FAILED: {$e3->getMessage()}\nSQL: {$fixedSQL}</pre>";
                    return false;
                }
            } else {
                $this->log("AUTO-FIX: 未能识别 INSERT 结构或获取列信息失败。");
            }
        }

        // === ③ 记录普通 SQL 错误 ===
        $this->log("SQL ERROR: {$this->last_errno} {$this->last_error} | SQL: {$query}");
        echo "<pre>❌ SQL ERROR: {$this->last_error}\nSQL: {$query}</pre>";
        return false;
    }
}
    
    function execute($query, $params = []){
        if(!$this->connected){
            $c = $this->connect();
            if($c !== 0) return false;
        }
        $query = $this->normalize_sql($query);
        if($query === '') return false;

        try{
            $this->pdoStatement = $this->link->prepare($query);
            foreach($params as $name => $value){
                // 支持 :name 或 ? 两种绑定风格
                is_int($name) ? $this->pdoStatement->bindValue($name+1, $value)
                              : $this->pdoStatement->bindValue($name, $value);
            }
            $this->pdoStatement->execute();
            $this->query_num++;
            return $this->pdoStatement;
        }catch(PDOException $e){
            $this->last_errno = (int)$e->getCode();
            $this->last_error = $e->getMessage();
            $this->log("EXEC ERROR: {$this->last_errno} {$this->last_error} | SQL: {$query} | PARAMS: ".json_encode($params, JSON_UNESCAPED_UNICODE));
            echo "<pre>❌ EXEC ERROR: {$this->last_error}\nSQL: {$query}\nPARAMS: ".htmlspecialchars(json_encode($params, JSON_UNESCAPED_UNICODE))."</pre>";
            return false;
        }
    }

    function fetch_array($query, $type = PDO::FETCH_ASSOC){
        if(is_string($query)) $query = $this->query($query);
        if(!is_object($query)) return false;
        return $query->fetch($type);
    }

    function fetch_all($query){
        if(is_string($query)) $query = $this->query($query);
        if(!is_object($query)) return [];
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function fetch_one($query){
        $r = $this->fetch_array($query);
        return $r ? $r : [];
    }

    function fetch_row($query){
        if(is_string($query)) $query = $this->query($query);
        if(!is_object($query)) return false;
        return $query->fetch(PDO::FETCH_NUM);
    }

    function affected_rows(){
        return is_object($this->pdoStatement) ? $this->pdoStatement->rowCount() : 0;
    }

    function insert_id($sequence = null){
        if(!$this->connected){ $this->connect(); }
        try{
            return $this->link->lastInsertId($sequence);
        }catch(PDOException $e){
            return 0;
        }
    }

    function escape_string($s){
        if(is_array($s)){
            foreach($s as $k=>$v){ $s[$k] = $this->escape_string($v); }
            return $s;
        }
        return str_replace("'", "''", $s);
    }

    function version(){
        if(!$this->connected){ $this->connect(); }
        if($this->version) return $this->version;
        $this->version = $this->link->getAttribute(PDO::ATTR_SERVER_VERSION);
        return $this->version;
    }

    function close(){
        $this->connected = false;
        $this->link = null;
        $this->pdoStatement = null;
        return true;
    }

    function free_result($query){
        if(is_object($query)){ $query->closeCursor(); }
    }

    // === 下方保留你的原工具方法 ===

    function checkTableExists($table){
        $table = trim($table, '"');
        $schema = 'public';
        if(strpos($table, '.') !== false){
            list($schema, $table) = explode('.', $table, 2);
            $schema = trim($schema, '"');
        }
        $sql = "SELECT tablename FROM pg_catalog.pg_tables WHERE schemaname = :schema AND tablename = :table";
        $stmt = $this->execute($sql, [':schema'=>$schema, ':table'=>$table]);
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    function checkFileExists($table, $file){
        $table = trim($table, '"');
        $file = trim($file, '"');
        $schema = 'public';
        if(strpos($table, '.') !== false){
            list($schema, $table) = explode('.', $table, 2);
            $schema = trim($schema, '"');
        }
        $sql = "SELECT column_name FROM information_schema.columns WHERE table_schema = :schema AND table_name = :table AND column_name = :column";
        $stmt = $this->execute($sql, [':schema'=>$schema, ':table'=>$table, ':column'=>$file]);
        return $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : [];
    }

    function checkPartition(){
        $row = $this->fetch_one("SELECT EXISTS(SELECT 1 FROM pg_class c JOIN pg_inherits i ON c.oid = i.inhrelid) AS partitioned");
        return !empty($row['partitioned']) && ($row['partitioned']==='t' || $row['partitioned']===true || $row['partitioned']=='1');
    }

    function getTableColumn($table, $file){ return $this->checkFileExists($table, $file); }

    function getTableStatus($table){
        $params = []; $cond = '';
        if($table){ $cond = 'AND tablename = :table'; $params[':table'] = trim($table, '"'); }
        $sql = "SELECT schemaname AS Schema, tablename AS Name FROM pg_catalog.pg_tables
                WHERE schemaname NOT IN ('pg_catalog','information_schema') $cond";
        $stmt = $this->execute($sql, $params);
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    function getTableStruct($table){
        $table = trim($table, '"'); $schema = 'public';
        if(strpos($table, '.') !== false){
            list($schema, $table) = explode('.', $table, 2); $schema = trim($schema, '"');
        }
        $sql = "SELECT column_name AS Field, data_type AS Type, character_maximum_length AS Length,
                       is_nullable AS Null, column_default AS Default
                FROM information_schema.columns
                WHERE table_schema = :schema AND table_name = :table
                ORDER BY ordinal_position";
        $stmt = $this->execute($sql, [':schema'=>$schema, ':table'=>$table]);
        $list = [];
        if($stmt){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $row['Type'] = strtolower($row['Type']);
                $row['Property'] = (strtolower($row['Null']) === 'no') ? 'not null' : '';
                $list[] = $row;
            }
        }
        return $list;
    }

    function getTableKeys($table){
        $table = trim($table, '"'); $schema = 'public';
        if(strpos($table, '.') !== false){
            list($schema, $table) = explode('.', $table, 2); $schema = trim($schema, '"');
        }
        $sql = "SELECT i.relname AS key_name,
                       ix.indisunique AS unique,
                       ix.indisprimary AS primary,
                       array_to_string(array_agg(a.attname), ',') AS column_name
                FROM pg_class t
                JOIN pg_index ix ON t.oid = ix.indrelid
                JOIN pg_class i ON ix.indexrelid = i.oid
                JOIN pg_attribute a ON a.attrelid = t.oid AND a.attnum = ANY(ix.indkey)
                JOIN pg_namespace n ON n.oid = t.relnamespace
                WHERE t.relkind = 'r' AND n.nspname = :schema AND t.relname = :table
                GROUP BY key_name, unique, primary";
        $stmt = $this->execute($sql, [':schema'=>$schema, ':table'=>$table]);
        $keys = [];
        if($stmt){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $name = $row['key_name'];
                $keys[$name]['field'] = $row['column_name'];
                $keys[$name]['type'] = ($row['primary']==='t') ? 'primary' : (($row['unique']==='t') ? 'unique' : '');
                $keys[$name]['unique'] = ($row['primary']==='t' || $row['unique']==='t');
            }
        }
        return $keys;
    }

    function insert($table, $datas, $option = []){
        if(empty($datas)) return false;
        $table = $this->normalize_identifier($table);

        if(!empty($option['multiple'])){
            $fields = array_map(function($f){ return '"'.$f.'"'; }, $option['multiple']);
            $values_sql = [];
            foreach($datas as $row){
                $vals = [];
                foreach($row as $v){ $vals[] = "'".$this->escape_string($v)."'"; }
                $values_sql[] = '('.implode(',', $vals).')';
            }
            $sql = "INSERT INTO {$table} (".implode(',', $fields).") VALUES ".implode(',', $values_sql);
        }else{
            $fields = []; $vals = [];
            foreach($datas as $f=>$v){ $fields[] = '"'.$f.'"'; $vals[] = "'".$this->escape_string($v)."'"; }
            $sql = "INSERT INTO {$table} (".implode(',', $fields).") VALUES (".implode(',', $vals).")";
        }

        $st = $this->query($sql);
        if(!empty($option['return_id'])) return $this->insert_id();
        return $st;
    }

    function update($table, $datas, $select, $quote = true){
        if(empty($datas)) return false;
        $table = $this->normalize_identifier($table);

        $sets = [];
        foreach($datas as $f=>$v){
            $sets[] = '"'.$f.'"=' . ($quote ? "'".$this->escape_string($v)."'" : $v);
        }

        if(is_object($select)){
            $where = $select->build_where() . $select->build_order() . $select->build_limit();
        }else{
            $where = empty($select) ? '' : ' WHERE '.$select;
        }

        $sql = "UPDATE {$table} SET ".implode(',', $sets).$where;
        $sql = $this->normalize_sql($sql);
        $st = $this->query($sql);
        $rows = $this->affected_rows();
        return $rows ? $rows : $st;
    }

    function delete($table, $select){
        $table = $this->normalize_identifier($table);
        if(is_object($select)){
            $where = $select->build_where() . $select->build_order() . $select->build_limit();
        }else{
            $where = empty($select) ? '' : ' WHERE '.$select;
        }
        $sql = "DELETE FROM {$table} ".$where;
        $sql = $this->normalize_sql($sql);
        $st = $this->query($sql);
        $rows = $this->affected_rows();
        return $rows ? $rows : $st;
    }

    function parsesql($query){
        if(preg_match('/database\(\s?\)|user\(\s?\)|sleep\(\d+\)|@version|updatexml\(|table_schema|information_schema/i', $query)){
            return '';
        }
        return $query;
    }

    function afterRestore(){ return true; }

    protected function normalize_identifier($identifier){
        $identifier = trim($identifier);
        if(stripos($identifier, ' as ') !== false){
            list($name, $alias) = preg_split('/\s+as\s+/i', $identifier);
            return $this->normalize_identifier($name) . ' AS ' . $this->normalize_identifier($alias);
        }
        return str_replace('`', '"', $identifier);
    }

    function error(){
        if($this->last_error) return $this->last_error;
        if($this->link){
            $info = $this->link->errorInfo();
            return isset($info[2]) ? $info[2] : '';
        }
        return '';
    }

    function errno(){
        if($this->last_errno) return $this->last_errno;
        if($this->link) return $this->link->errorCode();
        return 0;
    }
}
