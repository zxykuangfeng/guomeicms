<?php

class P8_pgsql{

    var $connected = false;
    var $link = null;
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

    function __construct($host, $user, $password, $db, $charset = 'utf8', $port = 5432, $pconnect = false){
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;
        $this->charset = $charset ?: 'utf8';
        $this->pconnect = $pconnect;
        $this->port = $port ?: 5432;
    }

    function connect(){
        if($this->connected){
            return 0;
        }

        $dsn = 'pgsql:host=' . $this->host . ';port=' . $this->port;
        if(!empty($this->db)){
            $dsn .= ';dbname=' . $this->db;
        }

        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        if($this->pconnect){
            $options[PDO::ATTR_PERSISTENT] = true;
        }

        try{
            $this->link = new PDO($dsn, $this->user, $this->password, $options);
            if($this->charset){
                $this->link->exec("SET NAMES '" . $this->charset . "'");
            }
        }catch(\PDOException $e){
            $this->last_errno = $e->getCode();
            $this->last_error = $e->getMessage();
            return -1;
        }

        $this->connected = true;
        return 0;
    }

    protected function normalize_sql($query){
        if(is_array($query)){
            return $query;
        }

        $query = $this->parsesql($query);
        if($query === ''){
            return '';
        }

        $query = str_replace('`', '"', $query);

        if(preg_match('/LIMIT\s+(\d+)\s*,\s*(\d+)/i', $query, $matches)){
            $query = preg_replace('/LIMIT\s+(\d+)\s*,\s*(\d+)/i', 'LIMIT ' . $matches[2] . ' OFFSET ' . $matches[1], $query);
        }

        return $query;
    }

    function querys($query, $type = ''){
        if(is_array($query)){
            $result = false;
            foreach($query as $sql){
                $result = $this->query($sql, $type);
            }
            return $result;
        }
        return $this->query($query, $type);
    }

    function query($query, $type = ''){
        if(!$this->connected){
            $this->connect();
        }

        $query = $this->normalize_sql($query);
        if($query === ''){
            return false;
        }

        try{
            $this->pdoStatement = $this->link->query($query);
            $this->query_num++;
            return $this->pdoStatement;
        }catch(\PDOException $e){
            $this->last_errno = $e->getCode();
            $this->last_error = $e->getMessage();

            if(defined('SQL_DEBUG')){
                $fp = fopen(CACHE_PATH . 'debug_sql.txt', 'a');
                fputs($fp, date('Y-m-d H:i:s', P8_TIME) . "\t" . $this->last_errno . ':' . $this->last_error . "\t" . $query . "\r\n");
                fclose($fp);
            }

            global $core;
            if(!empty($core->CONFIG['debug'])){
                echo $this->last_error . "<br>\r\n";
                echo '<font color=red>SQL ERROR:</font>' . $query . "<br>\r\n<pre>";
                foreach(debug_backtrace() as $v){
                    echo "$v[file]: $v[line]\r\n";
                }
                echo "\r\n</pre><br>";
            }
            return false;
        }
    }

    function execute($query, $params = array()){
        if(!$this->connected){
            $this->connect();
        }

        $query = $this->normalize_sql($query);
        if($query === ''){
            return false;
        }

        try{
            $this->pdoStatement = $this->link->prepare($query);
            foreach($params as $name => $value){
                $this->pdoStatement->bindValue($name, $value);
            }
            $this->pdoStatement->execute();
            $this->query_num++;
            return $this->pdoStatement;
        }catch(\PDOException $e){
            $this->last_errno = $e->getCode();
            $this->last_error = $e->getMessage();

            if(defined('SQL_DEBUG')){
                $fp = fopen(CACHE_PATH . 'debug_sql.txt', 'a');
                fputs($fp, date('Y-m-d H:i:s', P8_TIME) . "\t" . $this->last_errno . ':' . $this->last_error . "\t" . $query . "\r\n");
                fclose($fp);
            }

            global $core;
            if(!empty($core->CONFIG['debug'])){
                echo $this->last_error . "<br>\r\n";
                echo '<font color=red>SQL ERROR:</font>' . $query . "<br>\r\n<pre>";
                foreach(debug_backtrace() as $v){
                    echo "$v[file]: $v[line]\r\n";
                }
                echo "\r\n</pre><br>";
            }
            return false;
        }
    }

    function fetch_array($query, $type = PDO::FETCH_ASSOC){
        if(is_string($query)){
            $query = $this->query($query);
        }

        if(!is_object($query)){
            return false;
        }

        return $query->fetch($type);
    }

    function fetch_all($query){
        if(is_string($query)){
            $query = $this->query($query);
        }

        if(!is_object($query)){
            return array();
        }

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function fetch_one($query){
        $result = $this->fetch_array($query);
        return $result ? $result : array();
    }

    function fetch_row($query){
        if(is_string($query)){
            $query = $this->query($query);
        }

        if(!is_object($query)){
            return false;
        }

        return $query->fetch(PDO::FETCH_NUM);
    }

    function affected_rows(){
        if(is_object($this->pdoStatement)){
            return $this->pdoStatement->rowCount();
        }
        return 0;
    }

    function insert_id($sequence = null){
        if(!$this->connected){
            $this->connect();
        }

        try{
            return $this->link->lastInsertId($sequence);
        }catch(\PDOException $e){
            return 0;
        }
    }

    function escape_string($s){
        if(is_array($s)){
            foreach($s as $k => $v){
                $s[$k] = $this->escape_string($v);
            }
            return $s;
        }
        return str_replace("'", "''", $s);
    }

    function version(){
        if(!$this->connected){
            $this->connect();
        }

        if($this->version){
            return $this->version;
        }

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
        if(is_object($query)){
            $query->closeCursor();
        }
    }

    function checkTableExists($table){
        $table = trim($table, '"');
        $schema = 'public';
        if(strpos($table, '.') !== false){
            list($schema, $table) = explode('.', $table, 2);
            $schema = trim($schema, '"');
        }

        $sql = "SELECT tablename FROM pg_catalog.pg_tables WHERE schemaname = :schema AND tablename = :table";
        $stmt = $this->execute($sql, array(':schema' => $schema, ':table' => $table));
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : array();
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
        $stmt = $this->execute($sql, array(':schema' => $schema, ':table' => $table, ':column' => $file));
        return $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : array();
    }

    function checkPartition(){
        $sql = "SELECT EXISTS(SELECT 1 FROM pg_class c JOIN pg_inherits i ON c.oid = i.inhrelid) AS partitioned";
        $row = $this->fetch_one($sql);
        return !empty($row['partitioned']);
    }

    function getTableColumn($table, $file){
        return $this->checkFileExists($table, $file);
    }

    function getTableStatus($table){
        $params = array();
        $condition = '';
        if($table){
            $condition = 'AND tablename = :table';
            $params[':table'] = trim($table, '"');
        }

        $sql = "SELECT schemaname AS Schema, tablename AS Name FROM pg_catalog.pg_tables WHERE schemaname NOT IN ('pg_catalog','information_schema') $condition";
        $stmt = $this->execute($sql, $params);
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : array();
    }

    function getTableStruct($table){
        $table = trim($table, '"');
        $schema = 'public';
        if(strpos($table, '.') !== false){
            list($schema, $table) = explode('.', $table, 2);
            $schema = trim($schema, '"');
        }

        $sql = "SELECT column_name AS Field, data_type AS Type, character_maximum_length AS Length, is_nullable AS Null, column_default AS Default FROM information_schema.columns WHERE table_schema = :schema AND table_name = :table ORDER BY ordinal_position";
        $stmt = $this->execute($sql, array(':schema' => $schema, ':table' => $table));
        $list = array();
        if($stmt){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $row['Type'] = strtolower($row['Type']);
                $row['Length'] = $row['Length'];
                $row['Property'] = strtolower($row['Null']) === 'no' ? 'not null' : '';
                $list[] = $row;
            }
        }
        return $list;
    }

    function getTableKeys($table){
        $table = trim($table, '"');
        $schema = 'public';
        if(strpos($table, '.') !== false){
            list($schema, $table) = explode('.', $table, 2);
            $schema = trim($schema, '"');
        }

        $sql = "SELECT i.relname AS key_name, ix.indisunique AS unique, ix.indisprimary AS primary, array_to_string(array_agg(a.attname), ',') AS column_name FROM pg_class t JOIN pg_index ix ON t.oid = ix.indrelid JOIN pg_class i ON ix.indexrelid = i.oid JOIN pg_attribute a ON a.attrelid = t.oid AND a.attnum = ANY(ix.indkey) JOIN pg_namespace n ON n.oid = t.relnamespace WHERE t.relkind = 'r' AND n.nspname = :schema AND t.relname = :table GROUP BY key_name, unique, primary";
        $stmt = $this->execute($sql, array(':schema' => $schema, ':table' => $table));
        $keys = array();
        if($stmt){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $name = $row['key_name'];
                $keys[$name]['field'] = $row['column_name'];
                if($row['primary'] === 't'){
                    $keys[$name]['type'] = 'primary';
                    $keys[$name]['unique'] = true;
                }else if($row['unique'] === 't'){
                    $keys[$name]['type'] = 'unique';
                    $keys[$name]['unique'] = true;
                }else{
                    $keys[$name]['type'] = '';
                    $keys[$name]['unique'] = false;
                }
            }
        }
        return $keys;
    }

    function insert($table, $datas, $option = array()){
        if(empty($datas)){
            return false;
        }

        $table = $this->normalize_identifier($table);

        if(!empty($option['multiple'])){
            $fields = array();
            foreach($option['multiple'] as $field){
                $fields[] = '"' . $field . '"';
            }
            $values_sql = array();
            foreach($datas as $row){
                $values = array();
                foreach($row as $value){
                    $values[] = "'" . $this->escape_string($value) . "'";
                }
                $values_sql[] = '(' . implode(',', $values) . ')';
            }
            $sql = "INSERT INTO {$table} (" . implode(',', $fields) . ") VALUES " . implode(',', $values_sql);
        }else{
            $fields = array();
            $values = array();
            foreach($datas as $field => $value){
                $fields[] = '"' . $field . '"';
                $values[] = "'" . $this->escape_string($value) . "'";
            }
            $sql = "INSERT INTO {$table} (" . implode(',', $fields) . ") VALUES (" . implode(',', $values) . ')';
        }

        $status = $this->query($sql);
        if(!empty($option['return_id'])){
            return $this->insert_id();
        }
        return $status;
    }

    function update($table, $datas, $select, $quote = true){
        if(empty($datas)){
            return false;
        }

        $table = $this->normalize_identifier($table);

        $sets = array();
        foreach($datas as $field => $value){
            if($quote){
                $sets[] = '"' . $field . '"=' . "'" . $this->escape_string($value) . "'";
            }else{
                $sets[] = '"' . $field . '"=' . $value;
            }
        }

        if(is_object($select)){
            $where = $select->build_where() . $select->build_order() . $select->build_limit();
        }else{
            $where = empty($select) ? '' : ' WHERE ' . $select;
        }

        $sql = "UPDATE {$table} SET " . implode(',', $sets) . $where;
        $sql = $this->normalize_sql($sql);
        $status = $this->query($sql);
        $rows = $this->affected_rows();
        return $rows ? $rows : $status;
    }

    function delete($table, $select){
        $table = $this->normalize_identifier($table);

        if(is_object($select)){
            $where = $select->build_where() . $select->build_order() . $select->build_limit();
        }else{
            $where = empty($select) ? '' : ' WHERE ' . $select;
        }

        $sql = "DELETE FROM {$table} " . $where;
        $sql = $this->normalize_sql($sql);
        $status = $this->query($sql);
        $rows = $this->affected_rows();
        return $rows ? $rows : $status;
    }

    function parsesql($query){
        if(preg_match('/database\(\s?\)|user\(\s?\)|sleep\(\d+\)|@version|updatexml\(|table_schema|information_schema/i', $query)){
            return '';
        }
        return $query;
    }

    function afterRestore(){
        return true;
    }

    function showCharacterSet(){
        $sql = "SELECT DISTINCT pg_catalog.pg_encoding_to_char(encoding) AS charset FROM pg_catalog.pg_database";
        $stmt = $this->query($sql);
        if(!$stmt){
            return array();
        }
        $charsets = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $charsets[] = $row['charset'];
        }
        return $charsets;
    }

    function getDataSize(){
        if(empty($this->db)){
            return 0;
        }
        $stmt = $this->execute('SELECT pg_database_size(:db) AS data', array(':db' => $this->db));
        if(!$stmt){
            return 0;
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['data'] : 0;
    }

    protected function normalize_identifier($identifier){
        $identifier = trim($identifier);
        if(stripos($identifier, ' as ') !== false){
            list($name, $alias) = preg_split('/\s+as\s+/i', $identifier);
            return $this->normalize_identifier($name) . ' AS ' . $this->normalize_identifier($alias);
        }
        $identifier = str_replace('`', '"', $identifier);
        return $identifier;
    }

    function error(){
        if($this->last_error){
            return $this->last_error;
        }
        if($this->link){
            $info = $this->link->errorInfo();
            return isset($info[2]) ? $info[2] : '';
        }
        return '';
    }

    function errno(){
        if($this->last_errno){
            return $this->last_errno;
        }
        if($this->link){
            return $this->link->errorCode();
        }
        return 0;
    }
}