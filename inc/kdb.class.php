<?php

class P8_kdb
{

    var $connected = false;
    var $link;
    var $query_num = 0;
    var $version;

    var $host, $user, $password, $db, $charset, $pconnect, $port;

    function __construct($host, $user, $password, $db, $charset = 'utf8', $port = 0, $pconnect = false)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;
        $this->charset = $charset;
        $this->pconnect = $pconnect;
        $this->port = $port ? $port : 54321;
    }

    function connect()
    {
        if ($this->connected) return 0;
        try {
            $this->link = new PDO(sprintf("kdb:host=%s;port=%d;dbname=%s", $this->host, $this->port,$this->db), $this->user, $this->password, array(PDO::ATTR_PERSISTENT => $this->pconnect));
            //$this->host . ';dbname=' . $this->db, $this->user, $this->password, array(PDO::ATTR_PERSISTENT => $this->pconnect));
            $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            echo $e->getCode();
            echo $e->getMessage();
            echo "\n\r<br/>";
            return -1;
        }
        $this->connected = true;
    }

    function closepdo()
    {
        if ($this->link !== null) {
            $this->link = null;
        }
    }

    function select_db($db)
    {
        return false;
    }

    function querys($query, $type = ''){
        if(is_array($query)){
            foreach($query as $v){
               $result= $this->query($v, $type);
            }
        }else{
            $result= $this->query($query, $type);
        }
        return $result;
    }

    function query($query, $type = null){
        if(!$query)return false;
        if(!$this->connected) $this->connect();

        return $this->execute($this->formatQuery($query),$type);
    }

    function execute($query,$params=array()){
        if(!$this->connected) $this->connect();
        try{

            if(defined('SQL_DEBUG')){
                if($params){
                    $querystr = $this->generate($query,$params);
                }else{
                    $querystr = $query;
                }
                $fp = fopen(CACHE_PATH .'runtime/debug_sql_'.date('Y-m-d').'.php', 'a');
                fputs($fp, date('Y-m-d H:i:s', P8_TIME) ."\t".$query ."|\t". $querystr ."\r\n");
                fclose($fp);
            }
            $this->pdoStatement = $this->link->prepare($query);
            $this->bindParams($params);

            $this->pdoStatement->execute();
            return $this->pdoStatement;
        }catch(\Exception $e){
            global $core;
            if($params){
                $querystr = $this->generate($query,$params);
            }else{
                $querystr = $query;
            }
            if(empty($core->CONFIG['debug']) && function_exists('exception_handler')){
                exception_handler($e,'sql_', $query."|\t".$querystr);
                return false;
            }
            echo '<font color=red>SQL ERROR:</font>'.$querystr."<br>\r\n<pre>";
            echo $e->getCode();
            echo $e->getMessage();
            echo "\r\n</pre><br>";

        }
        return false;
    }

    protected  function generate($query,$param){
        $key = [];
        $replace = [];
        foreach($param as $k=>$v){
            $key[] = $k;
            $replace[] = "'$v'";
        }
        $query = str_replace($key, $replace, $query);
        return $query;
    }
    function bindParams($params)
    {

        foreach ($params as $name => $value) {
            $this->pdoStatement->bindValue($name, $value);
        }
    }

    function fetch_array($query, $type = ''){
        if(!$query)return false;
        if(is_object($query))return $query->fetch(PDO::FETCH_ASSOC);
        $this->query($query);
        return $this->pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    function fetchArray($query)
    {
        if (is_object($query)) return $query->fetch(PDO::FETCH_ASSOC);
        $this->execute($query);
        return $this->pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    function fetch_one($query){
        if(!$query)return false;
        $result = $this->fetch_array($query);
        return $result ? $result[0] : array();
    }

    function fetch_all($query)
    {
        $que = $this->query($query);
        $ret = array();
        while ($arr = $this->fetch_array($que)) {
            $ret[] = $arr;
        }
        $this->free_result($que);
        return $ret;
    }

    function affected_rows() {
        return $this->pdoStatement->rowCount();
    }

    function rowCount()
    {
        return $this->pdoStatement->rowCount();
    }

    function insert_id(){
        return $this->link->lastInsertId();

    }

    function fetch_row($query)
    {
        return [];
    }

    function fetch_fields($query)
    {
        $num = mysql_num_fields($query);
        $ret = array();
        for ($i = 0; $i < $num; $i++)
            $ret[$i] = mysql_field_name($query, $i);

        return $ret;
    }

    function error(){

        $errorInfo = $this->link->errorInfo();
        $ret = $errorInfo[2];

        return $ret;
    }

    function errno(){
        return $this->link->errorCode();
    }
    function escape_string($s){
        return $s;
    }

    function escape_string_bak($s){
        if(is_array($s)){
            foreach($s as $k => $v){
                $s[$k] = $this->escape_string_bak($v);
            }
            return $s;
        }
        return $this->escapestring($s);
    }
    function escapestring($s){
        return addslashes($s);
    }

    function version(){
        if(!empty($this->version)) return $this->version;
        if(!$this->connected) $this->connect();

        return $this->link->getAttribute(PDO::ATTR_SERVER_VERSION);
    }


    function close(){
        $this->connected = false;
        return;
    }

    function free_result($r){
        return;
    }

    /**
     * @param array $option
     * 插入数据到数据库
     * @param string $table 要插入的表
     * @param array $datas 要插入的数据,如果是多行插入,$datas为字段列表
     * ------------------
     * 单行$datas = array('id' => 1, 'cid' => 2);
     * insert('t', $datas)
     * insert('t', $datas, true);	加第3个参数证明是replace into
     * ------------------
     * 多行例子
     * $fields = array('id', 'cid');
     * $data = array(array(1, 2), array(3, 4));
     * insert($table, $fields, $data)
     * insert($table, $fields, $data, true);	加第4个参数证明是replace into
     *
     * --------------------------------
     * 达梦不支持 replace 若要使用 replace=>true, 则必须提供unique 判断字段组,
     * 则会先查此字段组的值是否存在，不存在则写入，存在则更新
     * @return bool|null
     */
    function insert($table, $datas, $option = array('multiple' => array(),'unique'=>array(), 'replace' => false)){
        if(empty($datas)) return false;
        // $option['replace']=false;
        if(empty($option['replace'])) {

            if (empty($option['multiple'])) {
                $option['multiple'] = array_keys($datas);
                $datas = [$datas];
            }
            foreach ($datas as $row) {
                list($fields, $vals, $param3) = $this->make_insert($option['multiple'], $row);
                $sql = "INSERT INTO $table ($fields) VALUES ($vals)";
                $option['return_id'] && $sql = $sql.' returning id';
                $status = $this->execute($sql, $param3);
            }
            //$id = $this->insert_id();
            return empty($option['return_id']) ? $status : $this->insert_id();

            //return $id ? $id : $status;
        }else{
            return $this->formatReplace($table,$datas,$option);
        }

    }

    /**
     * kdb不支持
     * @param $table
     * @param $datas
     * @return null
     */
    protected function formatReplace($table,$datas,$option){

        $multiple = $option['multiple'];
        $unique = $option['unique'];
        if (empty($multiple)) {
            foreach ($datas as $kk=>$vv){
                if(is_array($vv)){
                    foreach ($vv as $k => $v) {
                        $multiple[] = $k;
                    }
                    break;
                }else{
                    $multiple[] = $kk;
                }
            }

        }
        if(count($datas) == count($datas, 1)){
            $datas = array($datas);
        }
        foreach ($datas as $row) {
            list($condition,$param) = $this->make_condition($unique, $row);

            $checkSql = "SELECT COUNT(1) AS CC FROM $table";
            if($condition)$checkSql .=" WHERE {$condition}";
            if($this->execute($checkSql,$param))
                $status = $this->pdoStatement->fetchAll(PDO::FETCH_ASSOC);

            if($status[0]['CC']){
                list($SETDATA,$param2) = $this->make_condition($multiple, $row,' , ');
                $sql = "UPDATE $table SET $SETDATA";
                if($condition)$sql .=" WHERE {$condition}";
                $param= array_merge($param,$param2);
                $this->execute($sql,$param);
            }else{
                list($fields, $vals, $param3) = $this->make_insert($multiple, $row);
                $sql = "INSERT INTO $table ($fields) VALUES ($vals)";
                $this->execute($sql,$param3);
            }
        }

        return empty($option['return_id']) ? $status : $this->insert_id();
    }

    /**
     * 构建条件
     * @param $unique
     * @param $data
     * @param string $explot
     * @return array
     */
    protected function make_condition($unique, $data, $explot = ' AND '){

        $condition = [];
        $param = [];
        foreach($unique as $i=>$field){
            $condition[] = "$field=:f_{$i}_$field";
            $v = isset($data[$field])?$data[$field]:$data[$i];
            $param[":f_{$i}_$field"] = empty($v)?(is_numeric($v)?$v:''):$v;
        }
        $condition = implode($explot, $condition );
        return array($condition, $param);
    }

    protected function make_update($multiple, $datas){
        $i = 0;
        foreach ($datas as $k=>$v) {
            $field = 'f'.$i.'_'.(is_string($k)?$k:$multiple[$k]);
            $condition[] = "\"$k\"=:$field";
            $param[":$field"] = empty($v)?(is_numeric($v)?$v:''):$v;
            $i++;
        }
        $condition = implode(', ', $condition );
        return array($condition, $param);
    }

    protected function make_insert($multiple, $datas){
        $vals= $param = [];

        foreach ($multiple as $i=>$v) {
            $vals[] =':f'.$i.'_'.$v;
        }
        $ii = 0;
        foreach ($datas as $k=>$v) {
            $field = 'f'.$ii.'_'.(is_string($k)?$k:$multiple[$k]);
            $param[":$field"] = empty($v)?(is_numeric($v)?$v:''):$v;
            $ii++;
        }
        $fields = '"'.implode('", "',$multiple).'"';
        $vals = implode(', ',$vals);
        return [$fields, $vals, $param];
    }

    /**
     * 更新表
     * @param string $table 要更新的表
     * @param array $datas 要更新的字段及数据映射数组
     * @param object|string 要更新的条件,可以直接写a = 1也可以传个用select对象构造的条件
     * @param bool 是否把值括起来,如果不括,可以写灵活点的SQL,如a = a+1
     * @return int 受影响的条数
     **/
    function update($table, $datas, $select, $quote = true){

        if(empty($datas)) return false;

        $SQL = "UPDATE $table SET ";

        $param2=[];
        if($quote) {
            $multiple = array_keys($datas);
            list($SETDATA, $param2) = $this->make_update($multiple, $datas);
            $SQL .= $SETDATA;
        }else{
            $comma = '';
            foreach($datas as $k => $v){
                if($quote)
                    $SQL .= "$comma`$k`='$v'";
                else
                    $SQL .= "$comma`$k`=$v";

                $comma = ',';
            }
        }

        if(is_object($select)){
            $SQL .= $select->build_where() . $select->build_order() . $select->build_limit();
        }else{
            $SQL .= empty($select) ? '' : " WHERE ". $select;
        }
        //echo $SQL;
        $status = $this->query($SQL,$param2);
        $rows = $this->affected_rows();return $rows;
        return $rows ? $rows : $status;
    }

    /**
     * 删除数据
     * @param string $table 要删除数据的表
     * @param object|string 删除的条件,可以直接写a = 1 AND b = 2,也可以传个用select对象构造的条件
     * @return int 受影响的条数
     **/
    function delete($table, $select){
        $SQL = "DELETE FROM $table ";

        if(is_object($select)){
            $SQL .= $select->build_where() . $select->build_order() . $select->build_limit();
        }else{
            $SQL .= empty($select) ? '' : " WHERE ". $select;
        }
        $status = $this->query($SQL);
        $rows = $this->affected_rows();return $rows;
        return $rows ? $rows : $status;
    }

    function flashAutoIncrementId($key,$num){
        $this->query("ALTER SEQUENCE \"public\".\"{$key}\" RESTART $num");
    }

    function getAllTable(){
        $result= $this->fetch_all("select table_name from information_schema.tables where table_schema ='public'");
        return $result;
    }

    function checkTableExists($table){
        $result= $this->fetch_one("select COUNT(1) AS C FROM information_schema.TABLES WHERE table_schema ='public' AND table_name ='{$table}'");
        return $result['C']>0;
    }

    function checkFileExists($table, $file){
        $result= $this->fetch_one("select COUNT(1) AS C from (select 	a.attnum,a.attname as field from sys_class c left join  sys_attribute a	 on  a.attrelid = c.oid where c.relname = '{$table}' and a.attnum > 0)  d where d.field ='{$file}'");
        return $result['C']>0;
    }

    function getTableColumn($table, $file){
        $result=[];
        if($_result= $this->fetch_one("select * from (select a.attnum, a.attname as field, t.typname as type, a.attlen as length, a.atttypmod as lengthvar, a.attnotnull as notnull, a.atthasdef as hasdef, b.description as comment from sys_class c, sys_attribute a left outer join sys_description b on a.attrelid = b.objoid and a.attnum = b.objsubid, pg_type t where c.relname = '{$table}' and a.attnum > 0 and a.attrelid = c.oid and a.atttypid = t.oid order by a.attnum) as x  where x.field ='{$file}'")){
            $result['Field'] = $_result['field'];
            $result['Null'] = $_result['notnull']=='f'?'NO':'YES';
            $result['Key'] = $_result['COLUMN_NAME'];
            $result['Default'] = $_result['hasdef'];
            $result['Extra'] = '';
            $result['Type'] = strtolower($_result['type']);
            if($_result['length']>0 or $_result['lengthvar']>0){
                $length = $_result['length']>0?:$_result['lengthvar'];
                $result['Type'] .='('.$length.')';
            }
        }

        return $result;
    }

    function checkPartition(){
        return false;
    }


    function getTableStatus($table=''){


        $where = $table?" AND relanme='$table'":'';
        $query = $this->query("SELECT schemaname,relname,n_live_tup FROM sys_stat_user_tables WHERE schemaname='public' $where");
        $counts = array();
        while($arr = $this->fetch_array($query)){
            $counts[$arr['relname']] = $arr['n_live_tup'];
        }

        $where = $table?" AND relanme='$table'":'';
        $query = $this->query(" select schemaname,relname,sys_total_relation_size(relid) as dateleng from sys_stat_user_tables where schemaname='public' $where");
        $lines = array();
        while($arr = $this->fetch_array($query)){
            $lines[$arr['relname']] = $arr['dateleng'];
        }


        $where = $table?" AND tablename='$table'":'';
        $query = $this->query("SELECT * FROM sys_tables WHERE schemaname='public' $where");
        $list = array();
        $k = 0;
        while($arr = $this->fetch_array($query)){

            $list[$k]['Name'] = $arr['tablename'];
            $list[$k]['Data_length'] = $arr['BYTES'];
            $list[$k]['Rows'] = '-';
            $list[$k]['Collation'] = $this->charset;
            $list[$k]['Create_time'] = '-';
            $list[$k]['Update_time'] = '-';
            $list[$k]['Engine'] = '-';
            $list[$k]['Rows'] = $counts[$arr['tablename']];
            $list[$k]['Data_length'] = $lines[$arr['tablename']];
            $list[$k]['Collation'] = 'utf8';
            $k++;
        }

        return $list;
    }

    /**
     * 表结构
     **/
    function getTableStruct($table=''){
        $query = $this->query("SELECT * FROM information_schema.COLUMNS WHERE table_name='{$table}'");
        $autoIndata = [];
        while($arr = $this->fetch_array($query)) {
            $autoIndata[$arr['column_name']] = $arr;
        }
        $query = $this->query("select a.attnum, a.attname as field, t.typname as type, a.attlen as length, a.atttypmod as lengthvar, a.attnotnull as notnull, a.atthasdef as hasdef, b.description as comment from sys_class c, sys_attribute a left outer join sys_description b on a.attrelid = b.objoid and a.attnum = b.objsubid, pg_type t where c.relname = '{$table}' and a.attnum > 0 and a.attrelid = c.oid and a.atttypid = t.oid order by a.attnum");
        $list = array();
        $k = 0;
        while($arr = $this->fetch_array($query)){
            $field = $arr['field'];
            $clumnData = $autoIndata[$field];
            $list[$k] = $arr;
            $list[$k]['Field'] = $field;
            $list[$k]['Type'] = strtolower($clumnData['data_type']);

            $type = $list[$k]['Type'];
            if($type=='user-defined')$type=strtolower($clumnData['udt_name']);
            $length = $arr['length']>0?$arr['length']:$arr['lengthvar'];
            if($length<0)$length=null;
            if($type=='integer'){
                $type = 'int';
            }elseif($type=='numeric'){
                if($clumnData['numeric_scale']>0){
                    $type = 'decimal';
                    $length = $clumnData['numeric_precision'].','.$clumnData['numeric_scale'];
                }else{
                    $type = 'int';
                }

            }
            $default =  preg_replace('/::(\w+)/i','',$clumnData['column_default']);

            $list[$k]['Type'] = $type;
            $list[$k]['Length'] = $length;
            $list[$k]['Property'] = '';
            $list[$k]['Null'] = $arr['notnull']=='t'?'YES':'NONE';
            $list[$k]['Default'] = $arr['hasdef']=='t'?$default:null;
            $list[$k]['Key'] = empty($arr['Key'])?(strtolower($arr['field'])=='id'?'PRI':'NOL'):$arr['Key'];
            $list[$k]['Collation'] = $this->charset;
            $list[$k]['Extra'] = $this->charset;
            $k++;
        }
        return $list;
    }

    /**
     * 表索引
     **/
    function getTableKeys($table){

        $query = $this->query("SELECT * FROM sys_indexes WHERE schemaname='public' AND tablename='{$table}'");
        $keys = array();
        while($arr = $this->fetch_array($query)){
            $k = $arr['indexname'];
            $keys[$k]['def'] = $arr['indexdef'];
        }
        return $keys;
    }

    /**
     * 取建表语句
     * @param $table
     * @return array
     */
    function getDDL($table){
        $data['Create Table'] = '';

        $struct = $this->getTableStruct($table);

        $primaryKey = '';
        $index = '';
        $autoIncrement = '';
        //TODO 建序列
        // 建主键
        // 建索引
        $keyindex = $this->getTableKeys($table);

        foreach ($keyindex as $keyName =>$keys){

            if(strpos($keys['def'],'pramiry_key')!==false){
                $field = substr($keys['def'],strpos($keys['def'],'('));
                $primaryKey = sprintf("CONSTRAINT %s PRIMARY KEY %s\n",$keyName,$field);
            }elseif($keys['def']) {
                $index .= $keys['def'] . ";\n";
            }
        }

        //TODO 建表
        $data['Create Table'] .= "CREATE TABLE {$table} (\n";
        $cc = count($struct);
        foreach ($struct as $k=>$field){
            $fieldname = $field['Field'];

            if(strpos($field['Default'],'nextval')!==false){
                $increnemt = 'auto_increnemt_'.$table.'_'.$fieldname;
                $autoIncrement ="DROP SEQUENCE IF EXISTS {$increnemt};\nCREATE SEQUENCE $increnemt  START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;\n";
            }

            $type = $field['Type'];
            $length = $field['Length'];
            $lengthstr = '';
            if(in_array($type,['int','bigint','datetime','date'])){
                $lengthstr = '';
            }elseif($length>0){
                $lengthstr = sprintf("(%s)",$length);
            }
            $null = $field['Null']=='YES'?'NOT NULL':'';
            $default = '';
            if(!is_null($field['Default'])){
               $defval= $field['Default'];
                $defval = preg_replace('/::(\w+)/i','',$defval);
                if(empty($defval) && $defval!=0 && $type!='int')$defval="''";
                $default = 'DEFAULT '.$defval;

            }
            $split = ',';
            if($cc==$k+1){
                if($primaryKey)
                    $split=",\n $primaryKey);";
                else
                    $split="\n);";
            }
            $data['Create Table'] .= sprintf("  \"%s\" %s%s %s %s%s\n",$fieldname,$type,$lengthstr,$null,$default,$split);
        }
        if($autoIncrement) $data['Create Table'] = $autoIncrement.$data['Create Table'];
        $data['Create Table'].=$index;
        return $data;
    }


    function formatSql($sqls,$drop_table=false){
        $returnSql = [];
        $sqls = is_array($sqls)?$sqls:[$sqls];
        foreach($sqls as $kkey=>$sql) {
            if (preg_match('/^(insert|update|select|delete|replace)/i', $sql)) {
                $sql = $this->formatQuery($sql);
                $sql = str_replace(["\'",'\r\n','\"'],["''","\r\n",'"'],$sql);
                $returnSql[] = $sql;
            } else {
                $this->formatTable($sql,$returnSql,$drop_table);
            }
        }

        return $returnSql;
    }


    function formatQuery($sql){
        if(preg_match('/^replace into/i',$sql)){
            $sql = preg_replace('/^replace into (.*)/i','INSERT INTO $1', $sql);
        }
        $sql = str_replace(['`','IGNORE','ignore'],['"','INTO','into'],$sql);
        return $sql;
    }

    function formatTable($sql,&$returnSql=[],$drop_table=false){
        $table = '';

        if(preg_match("/CREATE TABLE(\sIF NOT EXISTS)? (?<table>[a-z0-9\_\-`.]+).+?\s/i", $sql, $m)){
            $table = trim($m['table'],'`');
            if($drop_table) {
                $returnSql[] = "DROP TABLE IF EXISTS {$m['table']};";
            }
        }
        //处理索引
        $uk = [];//UNIQUE KEY
        $ukk = [];
        $nm = []; //nomal key
        $nmm = [];
        $au = [];
        preg_match('/UNIQUE KEY `(?<name>\S+)` \((?<field>.*)\)/i', $sql, $uk);
        preg_match('/UNIQUE KEY\s+\((?<field>.*)\)/i', $sql, $ukk);
        preg_match_all('/KEY `?(?<name>\S+)`? \((?<field>.*)\)/i', $sql, $nm);
        preg_match_all('/\s\sKEY\s+\((?<field>.*)\)/i', $sql, $nmm);

        $sql = preg_replace('/mediumint\s?\(\s?\d+\s?\)/i', 'int', $sql);
        $sql = preg_replace('/smallint\s?\(\s?\d+\s?\)/i', 'int', $sql);
        $sql = preg_replace('/tinyint\s?\(\s?\d+\s?\)/i', 'int', $sql);
        $sql = preg_replace('/int\s?\(\s?\d+\s?\)/i', 'int', $sql);
        $sql = preg_replace('/enum\(.*\)/i', 'varchar(255)', $sql);
        /*$sql = preg_replace_callback('/\s\w*char\(\s?(\d+)\s?\)/i',  function ($matches) {
            return ' VARCHAR('.($matches[1]*5).')';
        }, $sql);*/
        $sql = preg_replace('/ENGINE=(.*)/i', '', $sql);
        $sql = preg_replace('/UNIQUE KEY\s?`\S+` \(.*\),?/i', '', $sql);
        $sql = preg_replace('/UNIQUE KEY\s+\(.*\),?/i', '', $sql);
        $sql = preg_replace('/KEY `?\S+`?\s?\(.*\),?/i', '', $sql);
        $sql = preg_replace('/\s\sKEY\s+\(.*\),?/i', '', $sql);
        $sql = preg_replace('/MODIFY COLUMN/i', 'MODIFY', $sql);


        $sql = str_replace([ 'UNSIGNED', 'unsigned ','ON UPDATE current_timestamp()','CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', '#','CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP','0000-00-00','COLLATE utf8_unicode_ci'],
            [ '', '',"''","''", '','NULL','CURRENT_DATE',''], $sql);

        $sql = preg_replace('/,\s+\)\s?/im',"\n)",$sql);
        $sql = preg_replace('/AFTER\s[^,]+/i','',$sql);

        //自增长处理
        if(preg_match("/`(\w+)`(.*?)auto_increment,/i",$sql,$au)){
            $autoIncrementName = sprintf("auto_increnemt_%s_%s",$table,$au[1]);
            $sql = str_replace(['AUTO_INCREMENT', 'auto_increment'],"DEFAULT NEXTVAL('$autoIncrementName')",$sql);
            if($drop_table) {
                $returnSql[] = "DROP SEQUENCE IF EXISTS {$autoIncrementName}";
                $returnSql[] = "CREATE SEQUENCE {$autoIncrementName} START WITH 1 INCREMENT BY 1";
            }else{
                $returnSql[] = "CREATE SEQUENCE IF NOT EXISTS {$autoIncrementName} START WITH 1 INCREMENT BY 1";
            }
        }

        if(!preg_match('/CONSTRAINT\s+"?[\w_]+"?\s+PRIMARY\s+KEY\s+\([\w_,\s]+\)/i',$sql)) {
            $sql = preg_replace_callback('/PRIMARY KEY\s+\((.*)\),?/i', function ($matches) use ($table) {
                return sprintf('CONSTRAINT pramiry_key_%s_%s PRIMARY KEY(%s)', $table, str_replace([',', '`', ' '], ['_', '', ''], $matches['1']), $matches['1']);
            }, $sql);
        }

        if(preg_match('/ALTER TABLE\s+(?<table>[a-z0-9\_\-`".]+)\s+CHANGE\s+(?<clumn1>[a-z0-9\_\-`".]+)\s+(?<clumn2>[a-z0-9\_\-`".]+)\s+(?<other>.*)/i',$sql,$m)){
            $sql = sprintf('ALTER TABLE %s MODIFY COLUMN %s %s',$m['table'],$m['clumn1'], $m['other']);
        }else if(preg_match('/ALTER TABLE\s+(?<table>[a-z0-9\_\-`.]+) (?<clumn>[^;]+)/im',$sql,$m)){
            $this->alertFormat($returnSql,$m['table'],$m['clumn']);
            $sql = '';
        }
        if (preg_match("/CREATE TABLE(\sIF NOT EXISTS)? (?<table>[a-z0-9\_\-`.]+).+?\s/i", $sql, $m)) {
            $returnSql[] = $sql;
            $this->indexFormat($returnSql,$m['table'], $nm,$nmm, $uk,$ukk);
        }else{
            $returnSql[] = $sql;
        }
    }

    function alertFormat(&$indexStr,$table, $clumn){
        $clumns = explode(',',$clumn);
        foreach($clumns as $clum){
            $clum = str_replace("\r\n",'',$clum);
            $indexStr[] = sprintf('ALTER TABLE %s %s',$table,$clum);
        }
    }

    private function makeAutoIncrement(&$indexStr,$table,$au)
    {
        $kename = sprintf("auto_increment_%s_%s",$table,$au[1]);
        $indexStr[] = "CREATE SEQUENCE {$kename} START WITH 1 INCREMENT BY 1";
        return $kename;
    }

    function indexFormat(&$indexStr,$table,$nm,$nmm,$uk,$ukk){
        if($nm[0]){
            foreach($nm['name'] as $k=>$name){
                $name = str_replace('`','',$name);
                $kename = strpos($name,$table)==false?$table.'_'.$name:$name;
                $kename = str_replace([',',' '],['_',''],$kename);
                $indexStr[] = "DROP INDEX IF EXISTS key_{$kename}";
                $field = $nm['field'][$k];
                $indexStr[] = "CREATE INDEX key_{$kename} ON {$table}($field)";
            }
        }
        if($nmm[0]){
            foreach($nmm['field'] as $k=>$name){
                $name = str_replace('`','',$name);
                $kename = strpos($name,$table)==false?$table.'_'.$name:$name;
                $kename = str_replace([',',' '],['_',''],$kename);
                $indexStr[] = "DROP INDEX IF EXISTS key_{$kename}";
                $indexStr[] = "CREATE INDEX key_{$kename} ON {$table}($name)";
            }
        }
        if($uk) {
            $kename = strpos($uk['name'],$table)==false?$table . '_' . $uk['name']:$uk['name'];
            $kename = str_replace(['`',',',' '],['','_',''],$kename);
            $indexStr[] = "DROP INDEX IF EXISTS ukey_{$kename}";
            $field = $uk['field'];
            $indexStr[] = "CREATE UNIQUE INDEX ukey_{$kename} ON {$table}($field)";
        }
        if($ukk) {
            $kename = strpos($ukk['field'],$table)==false?$table . '_' . $ukk['field']:$ukk['field'];
            $kename = str_replace(['`',',',' '],['','_',''],$kename);
            $indexStr[] = "DROP INDEX IF EXISTS ukey_{$kename}";
            $field = $ukk['field'];
            $indexStr[] = "CREATE UNIQUE INDEX ukey_{$kename} ON {$table}($field)";
        }
    }

    public function flashTableAutoIncrement($table,$field='id'){
        $sql = "SELECT MAX({$field}) AS ma FROM {$table}";
        $last_value = $this->fetch_one($sql);
        $newValue = $last_value['ma']+1;
        $sequence = 'auto_increnemt_'.$table.'_'.$field;
        $sql = "ALTER SEQUENCE $sequence RESTART $newValue";
        $this->execute($sql);
    }

    public function flashAutoIncrement($table=''){
        $sql = "SELECT table_catalog,table_name, column_name ,column_default FROM information_schema.COLUMNS WHERE table_schema ='public' AND column_default LIKE 'nextval%'";
        if($table){
            $sql .= " and table_name ='{$table}'";
        }

        $list = $this->fetch_all($sql);

        foreach ($list as $item){
            $field = $item['column_name'];
            $talbe = $item['table_name'];
            $this->flashTableAutoIncrement($talbe,$field);
        }
    }

    public function afterRestore(){
        $this->flashAutoIncrement();
    }

    function showCharacterSet(){
        $charsets = [];
        $query = $this->query('show server_encoding');
        while($arr = $this->fetch_array($query)){
            $charsets[] = $arr['server_encoding'];
        }
        return $charsets;
    }

    function getDataSize(){
        $query = $this->fetch_one("select sys_database_size('{$this->db}')");
        return $query['sys_database_size'];
    }
}
