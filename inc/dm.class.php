<?php

class p8_dm{

    var $connected = false;
    var $link;
    var $query_num = 0;
    var $version;
	var $dmkeywords = ['ABORT','ABSOLUTE','ABSTRACT','ACCESSED','ACCOUNT','ACROSS','ACTION','ADD','ADMIN','ADVANCED','AFTER','AGGREGATE','ALL','ALLOW_DATETIME','ALLOW_IP','ALTER','ANALYZE','AND','ANY','APR','ARCHIVE','ARCHIVEDIR','ARCHIVELOG','ARCHIVESTYLE','ARRAY','ARRAYLEN','AS','ASC','ASCII','ASENSITIVE','ASSIGN','ASYNCHRONOUS','AT','ATTACH','AUDIT','AUG','AUTHID','AUTHORIZATION','AUTO','AUTOEXTEND','AUTONOMOUS_TRANSACTION','AVG','BACKED','BACKUP','BACKUPDIR','BACKUPINFO','BACKUPSET','BADFILE','BAKFILE','BASE','BEFORE','BEGIN','BETWEEN','BIGDATEDIFF','BIGINT','BINARY','BIT','BITMAP','BLOB','BLOCK','BOOL','BOOLEAN','BOTH','BRANCH','BREADTH','BREAK','BSTRING','BTREE','BUFFER','BUILD','BULK','BY','BYDAY','BYHOUR','BYMINUTE','BYMONTH','BYMONTHDAY','BYSECOND','BYTE','BYWEEKNO','BYYEARDAY','CACHE','CALCULATE','CALL','CASCADE','CASCADED','CASE','CAST','CATALOG','CATCH','CHAIN','CHAR','CHARACTER','CHARACTERISTICS','CHECK','CIPHER','CLASS','CLOB','CLOSE','CLUSTER','CLUSTERBTR','COLLATE','COLLATION','COLLECT','COLUMN','COLUMNS','COMMENT','COMMIT','COMMITTED','COMMITWORK','COMPILE','COMPLETE','COMPRESS','COMPRESSED','CONDITIONAL','CONNECT','CONNECT_BY_ISCYCLE','CONNECT_BY_ISLEAF','CONNECT_BY_ROOT','CONNECT_IDLE_TIME','CONNECT_TIME','CONST','CONSTANT','CONSTRAINT','CONSTRAINTS','CONSTRUCTOR','CONTAINS','CONTEXT','CONTINUE','CONVERT','COPY','CORRESPONDING','CORRUPT','COUNT','COUNTER','CPU_PER_CALL','CPU_PER_SESSION','CREATE','CROSS','CRYPTO','CTLFILE','CUBE','CUMULATIVE','CURRENT','CURRENT_SCHEMA','CURRENT_USER','CURSOR','CYCLE','DAILY','DANGLING','DATA','DATABASE','DATAFILE','DATE','DATEADD','DATEDIFF','DATEPART','DATETIME','DAY','DBFILE','DDL','DDL_CLONE','DEBUG','DEC','DECIMAL','DECLARE','DECODE','DEFAULT','DEFERRABLE','DEFERRED','DEFINER','DELETE','DELETING','DELIMITED','DELTA','DEMAND','DENSE_RANK','DEPTH','DEREF','DESC','DETACH','DETERMINISTIC','DEVICE','DIAGNOSTICS','DICTIONARY','DIRECTORY','DISABLE','DISCONNECT','DISKSPACE','DISTINCT','DISTRIBUTED','DO','DOMAIN','DOUBLE','DOWN','DROP','DUMP','EACH','ELSE','ELSEIF','ELSIF','EMPTY','ENABLE','ENCRYPT','ENCRYPTION','END','EQU','ERROR','ERRORS','ESCAPE','EVENTINFO','EVENTS','EXCEPT','EXCEPTION','EXCEPTIONS','EXCEPTION_INIT','EXCHANGE','EXCLUDE','EXCLUDING','EXCLUSIVE','EXEC','EXECUTE','EXISTS','EXIT','EXPLAIN','EXTENDS','EXTERN','EXTERNAL','EXTERNALLY','EXTRACT','FAILED_LOGIN_ATTEMPS','FAST','FEB','FETCH','FIELDS','FILE','FILEGROUP','FILESIZE','FILLFACTOR','FINAL','FINALLY','FIRST','FLOAT','FOLLOWING','FOR','FORALL','FORCE','FOREIGN','FORMAT','FREQ','FREQUENCE','FRI','FROM','FULL','FULLY','FUNCTION','GET','GLOBAL','GLOBALLY','GOTO','GRANT','GROUP','GROUPING','HASH','HAVING','HEXTORAW','HOLD','HOUR','HOURLY','HUGE','IDENTIFIED','IDENTITY','IDENTITY_INSERT','IF','IMAGE','IMMEDIATE','IN','INCLUDE','INCLUDING','INCREASE','INCREMENT','INDEX','INDEXES','INDICES','INITIAL','INITIALIZED','INITIALLY','INLINE','INNER','INNERID','INPUT','INSENSITIVE','INSERT','INSERTING','INSTANTIABLE','INSTEAD','INT','INTEGER','INTENT','INTERSECT','INTERVAL','INTO','INVISIBLE','IS','ISOLATION','JAN','JAVA','JOB','JOIN','JSON','JSON_QUERY','JSON_VALUE','JUL','KEEP','KEY','KEYS','LABEL','LARGE','LAST','LAX','LEADING','LEFT','LESS','LEVEL','LEXER','LIKE','LIMIT','LINK','LIST','LNNVL','LOB','LOCAL','LOCALLY','LOCATION','LOCK','LOCKED','LOG','LOGFILE','LOGGING','LOGIC','LOGIN','LOGOFF','LOGON','LOGOUT','LONG','LONGVARBINARY','LONGVARCHAR','LOOP','LSN','MANUAL','MAP','MAPPED','MAR','MATCH','MATCHED','MATERIALIZED','MAX','MAXPIECESIZE','MAXSIZE','MAXVALUE','MAX_RUN_DURATION','MAY','MEMBER','MEMORY','MEM_SPACE','MERGE','MIN','MINEXTENTS','MINUS','MINUTE','MINUTELY','MINVALUE','MIRROR','MOD','MODE','MODIFY','MON','MONEY','MONITORING','MONTH','MONTHLY','MOUNT','MOVEMENT','MULTISET','NATIONAL','NATURAL','NCHAR','NCHARACTER','NEVER','NEW','NEXT','NO','NOARCHIVELOG','NOAUDIT','NOBRANCH','NOCACHE','NOCOPY','NOCYCLE','NODE','NOLOGGING','NOMAXVALUE','NOMINVALUE','NOMONITORING','NONE','NOORDER','NORMAL','NOROWDEPENDENCIES','NOSORT','NOT','NOT_ALLOW_DATETIME','NOT_ALLOW_IP','NOV','NOWAIT','NULL','NULLS','NUMBER','NUMERIC','OBJECT','OCT','OF','OFF','OFFLINE','OFFSET','OLD','ON','ONCE','ONLINE','ONLY','OPEN','OPTIMIZE','OPTION','OR','ORDER','OUT','OUTER','OVER','OVERLAPS','OVERLAY','OVERRIDE','OVERRIDING','PACKAGE','PAD','PAGE','PARALLEL','PARALLEL_ENABLE','PARMS','PARTIAL','PARTITION','PARTITIONS','PASSING','PASSWORD_GRACE_TIME','PASSWORD_LIFE_TIME','PASSWORD_LOCK_TIME','PASSWORD_POLICY','PASSWORD_REUSE_MAX','PASSWORD_REUSE_TIME','PATH','PENDANT','PERCENT','PIPE','PIPELINED','PIVOT','PLACING','PLS_INTEGER','PRAGMA','PRECEDING','PRECISION','PRESERVE','PRETTY','PRIMARY','PRINT','PRIOR','PRIVATE','PRIVILEGE','PRIVILEGES','PROCEDURE','PROTECTED','PUBLIC','PURGE','QUERY_REWRITE_INTEGRITY','RAISE','RANDOMLY','RANGE','RAWTOHEX','READ','READONLY','READ_PER_CALL','READ_PER_SESSION','REAL','REBUILD','RECORD','RECORDS','REF','REFERENCE','REFERENCES','REFERENCING','REFRESH','RELATED','RELATIVE','RENAME','REPEAT','REPEATABLE','REPLACE','REPLAY','REPLICATE','RESIZE','RESTORE','RESTRICT','RESULT','RESULT_CACHE','RETURN','RETURNING','REVERSE','REVOKE','RIGHT','ROLE','ROLLBACK','ROLLFILE','ROLLUP','ROOT','ROW','ROWCOUNT','ROWDEPENDENCIES','ROWID','ROWNUM','ROWS','RULE','SALT','SAMPLE','SAT','SAVE','SAVEPOINT','SBYTE','SCHEMA','SCOPE','SCROLL','SEALED','SEARCH','SECOND','SECONDLY','SECTION','SEED','SELECT','SELF','SENSITIVE','SEP','SEQUENCE','SERERR','SERIALIZABLE','SERVER','SESSION','SESSION_PER_USER','SET','SETS','SHARE','SHORT','SHUTDOWN','SIBLINGS','SIMPLE','SINCE','SIZE','SIZEOF','SKIP','SMALLINT','SNAPSHOT','SOME','SOUND','SPACE','SPAN','SPATIAL','SPFILE','SPLIT','SQL','STANDBY','STARTUP','STAT','STATEMENT','STATIC','STDDEV','STORAGE','STORE','STRICT','STRING','STRUCT','STYLE','SUBPARTITION','SUBPARTITIONS','SUBSTRING','SUBTYPE','SUCCESSFUL','SUM','SUN','SUSPEND','SWITCH','SYNC','SYNCHRONOUS','SYNONYM','SYSTEM','SYS_CONNECT_BY_PATH','TABLE','TABLESPACE','TASK','TEMPLATE','TEMPORARY','TEXT','THAN','THEN','THREAD','THROW','THU','TIES','TIME','TIMER','TIMES','TIMESTAMP','TIMESTAMPADD','TIMESTAMPDIFF','TIME_ZONE','TINYINT','TO','TOP','TRACE','TRAILING','TRANSACTION','TRANSACTIONAL','TRIGGER','TRIGGERS','TRIM','TRUNCATE','TRUNCSIZE','TRXID','TRY','TUE','TYPE','TYPEDEF','TYPEOF','UINT','ULONG','UNBOUNDED','UNCOMMITTED','UNCONDITIONAL','UNDER','UNION','UNIQUE','UNLIMITED','UNLOCK','UNPIVOT','UNTIL','UNUSABLE','UP','UPDATE','UPDATING','USAGE','USER','USE_HASH','USE_MERGE','USE_NL','USE_NL_WITH_INDEX','USHORT','USING','VALUE','VALUES','VARBINARY','VARCHAR','VARCHAR2','VARIANCE','VARRAY','VARYING','VERIFY','VERSIONS','VERSIONS_ENDTIME','VERSIONS_ENDTRXID','VERSIONS_OPERATION','VERSIONS_STARTTIME','VERSIONS_STARTTRXID','VERTICAL','VIEW','VIRTUAL','VISIBLE','VOID','VSIZE','WAIT','WED','WEEK','WEEKLY','WHEN','WHENEVER','WHERE','WHILE','WITH','WITHIN','WITHOUT','WORK','WRAPPED','WRAPPER','WRITE','XML','XMLPARSE','XMLTABLE','YEAR','YEARLY','ZONE'];

    var $host, $user, $password, $db, $charset, $pconnect, $port;

    function __construct($host, $user, $password, $db, $charset = 'utf8', $port = 0, $pconnect = false){
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->charset = $charset;
        $this->pconnect = $pconnect;
        $this->port = $host=='dm'?'':($port?$port:5236);
    }

    function connect(){
        if($this->connected) return 0;

        $_host = $this->port ? $this->host .':'. $this->port : $this->host;
        try{
            $this->link = new PDO('dm:host='.$_host, $this->user, $this->password,array(PDO::ATTR_PERSISTENT => $this->pconnect));
            $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(\Exception $e){

            echo $e->getCode();
            echo $e->getMessage();
            echo "\n\r<br/>";
            return -1;
        }
        $this->connected = true;
    }

    function closepdo(){
        if($this->link !== null){
            $this->link=null;
        }
    }

    function select_db($db){
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
    /**
     * DM不支持
     * @param $table
     * @param $datas
     * @return null
     */
    protected function formatReplace2($query){
        $mm = [];
        preg_match('/REPLACE INTO `?(?<table>.*)`? \((?<fields>.*)\)VALUES\((?<values>.*)\)/i',$query,$mm);
        $files = explode(',',str_replace('`','',$mm['fields']));
        $vals = explode(',',$mm['values']);
        $table = str_replace('`','',$mm['table']);
        $ki ='';
        $values = $fields = $select = $update = [];
        foreach ($files as $k=>$f) {
            $file = $f;
            $ki = $ki?$ki:$file;
            $fields[] = $file ;
            $v=$vals[$k];
            $values[] = 't.'.$file;
            $select[] = " {$v} {$file}";
            if($k)
            $update[] = " {$table}.{$file}=t.{$file}";
        }
		$fields = implode(', ',$fields);
		$select = implode(', ',$select);
		$update = implode(', ',$update);
		$values = implode(', ',$values);
        $insert= 'INSERT (' . $fields . ') VALUES (' . $values . ')';

        $sql = "MERGE INTO $table
                USING (SELECT $select FROM dual) t
                ON({$table}.{$ki} = t.{$ki})
                WHEN MATCHED THEN
                UPDATE SET {$update}
                WHEN NOT MATCHED THEN
                {$insert}";
        return $sql;
    }


    function bindParams($params){

        foreach($params as $name=>$value){
            $this->pdoStatement->bindValue($name, $value);
        }
    }

    function fetch_array($query, $type = ''){
        if(!$query)return false;
        if(is_object($query))return $query->fetch(PDO::FETCH_ASSOC);
        $this->query($query);
        return $this->pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    function fetch_one($query){
        if(!$query)return false;
        $result = $this->fetch_array($query);
        return $result ? $result[0] : array();
    }

    function fetch_all($query){
        if(!$query)return false;
        $que = $this->query($query);
        $ret = array();
         while($arr = $this->fetch_array($que)){
            foreach ($arr as $k=>$v){
                if(in_array($k,$this->dmkeywords)) {
                    $arr[strtolower($k)] = $v;
                }
            }
            $ret[] = $arr;
        }
        $this->free_result($que);
        return $ret;
    }

    function affected_rows() {
        return $this->pdoStatement->rowCount();
    }

    function insert_id(){
        return $this->link->lastInsertId();

    }

    function fetch_row($query) {
        return [];
    }

    function fetch_fields($query) {
        $num = mysql_num_fields($query);
        $ret = array();
        for($i = 0; $i < $num; $i++)
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
                if($itt = $this->formatIdentity($sql)){
                    $this->execute($itt);
                }
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
     * DM不支持
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

    function checkTableExists($table){

        $schema = strtoupper($this->user);
        $result= $this->fetch_one("select COUNT(1) AS C from dba_segments where OWNER='{$schema}' and SEGMENT_NAME='{$table}'");
        return $result['C']>0;
    }

    function checkFileExists($table, $file){
        $result= $this->fetch_one("select COUNT(1) AS C from all_tab_columns where TABLE_NAME='{$table}' and COLUMN_NAME ='{$file}'");
        return $result['C']>0;
    }

    function getTableColumn($table, $file){
        $result=[];
        if($_result= $this->fetch_one("select * from all_tab_columns where TABLE_NAME='{$table}' and COLUMN_NAME ='{$file}'")){
            $result['Field'] = $_result['COLUMN_NAME'];
            $result['Null'] = $_result['NULLABLE']=='N'?'NO':'YES';
            $result['Key'] = $_result['COLUMN_NAME'];
            $result['Default'] = $_result['DATA_DEFAULT'];
            $result['Extra'] = '';
            $result['Type'] = strtolower($_result['DATA_TYPE']);
            $_result['DATA_LENGTH'] && $result['Type'] .='('.$_result['DATA_LENGTH'].')';
        }

        return $result;
    }

    function checkPartition(){
        return false;
    }


    function getTableStatus($table=''){
        $schema = strtoupper($this->user);
        $where = $table?" AND SEGMENT_NAME='$table'":'';
        $query = $this->query("select * from dba_segments where  OWNER='{$schema}' AND SEGMENT_TYPE='TABLE' $where");
        $list = array();
        $k = 0;
        while($arr = $this->fetch_array($query)){

            $list[$k]['Name'] = $arr['SEGMENT_NAME'];
            $list[$k]['Data_length'] = $arr['BYTES'];
            $list[$k]['Rows'] = '-';
            $list[$k]['Collation'] = $this->charset;
            $list[$k]['Create_time'] = '-';
            $list[$k]['Update_time'] = '-';
            $list[$k]['Engine'] = '-';
            $k++;
        }
        return $list;
    }

    /**
     * 表结构
     **/
    function getTableStruct($table=''){
        $schema = strtoupper($this->user);
        $where = $table?" AND TABLE_NAME='$table'":'';
        $query = $this->query("select * from all_tab_columns where  OWNER='{$schema}' $where");
        $list = array();
        $k = 0;
        while($arr = $this->fetch_array($query)){

            $list[$k] = $arr;
            $list[$k]['Field'] = strtolower($arr['COLUMN_NAME']);
            $list[$k]['Type'] = strtolower($arr['DATA_TYPE']);
            $list[$k]['Length'] = $arr['DATA_LENGTH'];
            $list[$k]['Property'] = '';
            $list[$k]['Null'] = $arr['NULLABLE']?'YES':'NONE';
            $list[$k]['Default'] = $arr['DATA_DEFAULT'];
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
        $query = $this->query("SHOW KEYS FROM `$table`");
        $keys = array();
        while($arr = $this->fetch_array($query)){
            $k = $arr['Key_name'];
            $keys[$k]['field'] = isset($keys[$k]) ?
                $keys[$k]['field'] .','. $arr['Column_name'] :
                $arr['Column_name'];

            $keys[$k]['unique'] = empty($arr['Non_unique']);

            if($k == 'PRIMARY'){
                $keys[$k]['type'] = 'primary';
            }else if($keys[$k]['unique']){
                $keys[$k]['type'] = 'unique';
            }else if($arr['Index_type'] == 'FULLTEXT'){
                $keys[$k]['type'] = 'fulltext';
            }else{
                $keys[$k]['type'] = '';
            }
        }
        return $keys;
    }

    /**
     * 取建表语句
     * @param $table
     * @return array
     */
    function getDDL($table){
        $schema = strtoupper($this->user);
        $data = [];
        $data['Table'] =  $table;
        $str = $this->fetch_one(" select dbms_metadata.get_ddl('TABLE','{$table}','{$schema}') DDLSTR from dual");
        $data['Create Table'] = rtrim($str['DDLSTR'],';');


        $list = $this->fetch_all("select INDEX_NAME,INDEX_TYPE,OWNER from dba_indexes where TABLE_NAME='{$table}'");
        $return = '';
        foreach($list as $item){
            $indexName = $item['INDEX_NAME'];
            if(strpos($indexName,$table)===false) continue;
            $str = $this->fetch_one("select dbms_metadata.get_ddl('INDEX','{$indexName}','{$item['OWNER']}') DDLSTR from dual");
            $data['Create Table'] .= "DROP INDEX IF EXISTS  {$indexName};"."\r\n";
            $data['Create Table'] .= $str['DDLSTR']."\r\n";
        }
        return $data;
    }


    function formatSql($sqls,$drop_table=false){
        $indexStr = [];
        $identitys = [];
        $drops = [];
        $sqls = is_array($sqls)?$sqls:[$sqls];
        foreach($sqls as $kkey=>&$sql) {

            if($drop_table){
                if(preg_match("/CREATE TABLE(\sIF NOT EXISTS)? (?<table>[a-z0-9\_\-`.]+).+?\s/i", $sql, $m))
                    $drops = "DROP TABLE IF EXISTS {$m['table']};";
            }

            if (preg_match('/^(insert|update|select|delete|replace)/i', $sql)) {
                $sql = $this->formatQuery($sql);
                $sql = str_replace(["\'",'\r\n','\"'],["''","\r\n",'"'],$sql);
            } else {
                $sql = $this->formatTable($sql,$indexStr);
            }
            if (preg_match('/^insert/i', $sql)) {
                if($entt = $this->formatIdentity($sql)) {
                    $identitys[] = $entt;
                    $identitys[] = $sql;
                    unset($sql);
                    unset($sqls[$kkey]);
                }
            }
        }
        $drops && $sqls = array_merge($drops,$sqls);
        $indexStr && $sqls = array_merge($sqls,$indexStr);
        $identitys && $sqls = array_merge($sqls,$identitys);

        return $sqls;
    }

    function formatIdentity($sql){
        $mm = [];
        $sql = str_replace('`','"',$sql);
        preg_match('/^INSERT INTO "?(?<table>[\w_]+)"? \((?<column>.*)\)\s?VALUES\S?(.*)/i',$sql,$mm);
        $table = $mm['table'];
        $column = explode(',',strtoupper(str_replace(['`','"',"'",' '],'',$mm['column'])));

        if(in_array('ID',$column)){
            return "SET IDENTITY_INSERT {$table} ON";
        }
        return false;
    }

    function formatQuery($sql){
        if(preg_match('/^replace into/i',$sql)){
            $sql = preg_replace('/^replace into (.*)/i','INSERT INTO $1', $sql);
        }
        $sql = str_replace(["\'",'`','IGNORE','ignore'],["''",'"','INTO','into'],$sql);
        return $sql;
    }

    function formatTable($sql,&$indexStr=[]){
            //处理索引
            $uk = [];
            $ukk = [];
            $nm = [];
            $nmm = [];
            preg_match('/UNIQUE KEY `(?<name>\S+)` \((?<field>.*)\)/i', $sql, $uk);
            preg_match('/UNIQUE KEY\s+\((?<field>.*)\)/i', $sql, $ukk);
            preg_match_all('/KEY `?(?<name>\S+)`? \((?<field>.*)\)/i', $sql, $nm);
            preg_match_all('/\s\sKEY\s+\((?<field>.*)\)/i', $sql, $nmm);

            $sql = preg_replace('/mediumint\s?\(\s?\d+\s?\)/i', 'int', $sql);
            $sql = preg_replace('/smallint\s?\(\s?\d+\s?\)/i', 'int', $sql);
            $sql = preg_replace('/tinyint\s?\(\s?\d+\s?\)/i', 'tinyint', $sql);
            $sql = preg_replace('/int\s?\(\s?\d+\s?\)/i', 'int', $sql);
            $sql = preg_replace('/enum\(.*\)/i', 'varchar(255)', $sql);
            $sql = preg_replace_callback('/\s\w*char\(\s?(\d+)\s?\)/i',  function ($matches) {
				return ' VARCHAR('.($matches[1]*5).')';
			}, $sql);
            $sql = preg_replace('/ENGINE=(.*)/i', '', $sql);
            $sql = preg_replace('/UNIQUE KEY\s?`\S+` \(.*\),?/i', '', $sql);
            $sql = preg_replace('/UNIQUE KEY\s+\(.*\),?/i', '', $sql);
            $sql = preg_replace('/KEY `?\S+`?\s?\(.*\),?/i', '', $sql);
            $sql = preg_replace('/\s\sKEY\s+\(.*\),?/i', '', $sql);
            $sql = preg_replace('/MODIFY COLUMN/i', 'MODIFY', $sql);
            $sql = preg_replace('/PRIMARY KEY\s+\(`(.*)`\),?/i', 'NOT CLUSTER PRIMARY KEY ("$1")', $sql);

            $map = [
                '`'=>'"',
                'AUTO_INCREMENT'=>'IDENTITY',
                'auto_increment'=>'identity',
                'mediumtext'=>'text',
                'MEDIUMTEXT'=>'text',
                'longtext'=>'text',
                'LONGTEXT'=>'text',
                'IF NOT EXISTS'=>'',
                'if not exists'=>'',
                'USING BTREE'=>'',
                'using btree'=>'',
                'UNSIGNED'=>'',
                'unsigned '=>'',
                'current_timestamp() ON UPDATE current_timestamp()'=>"''",
                'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'=>"''",
                'ON UPDATE CURRENT_TIMESTAMP()'=>'',
                'ON UPDATE current_timestamp()'=>'',
                '0000-00-00'=>'',
                '#'=>''
            ];
            foreach ($map as $fo=>$to) {
                $sql = str_replace($fo, $to, $sql);
            }

			
            $sql = preg_replace('/"(.*)" tinyint (.*) IDENTITY/', '"$1" int $2 IDENTITY',$sql);
            $sql = preg_replace('/,\s+\)\s?/im',"\n)",$sql);
            $sql = preg_replace('/AFTER\s[^,]+/i','',$sql);

            if (preg_match("/CREATE TABLE(\sIF NOT EXISTS)? (?<table>[a-z0-9\_\-`.]+).+?\s/i", $sql, $m)) {
                $this->indexFormat($indexStr,$m['table'], $nm,$nmm, $uk,$ukk);
            }elseif(preg_match("/CREATE TABLE \"?(?<table>[a-z0-9\_\-`.]+).+?\"?\s/i", $sql, $m)){
                $this->indexFormat($indexStr,$m['table'], $nm,$nmm, $uk,$ukk);
            }

            if(preg_match('/ALTER TABLE\s+(?<table>[a-z0-9\_\-`".]+)\s+CHANGE\s+(?<clumn1>[a-z0-9\_\-`".]+)\s+(?<clumn2>[a-z0-9\_\-`".]+)\s+(?<other>.*)/i',$sql,$m)){
                $sql = sprintf('ALTER TABLE %s MODIFY %s %s',$m['table'],$m['clumn1'], $m['other']);
            }else if(preg_match('/ALTER TABLE\s+(?<table>[a-z0-9\_\-`.]+) (?<clumn>[^;]+)/im',$sql,$m)){
                    $this->alertFormat($indexStr,$m['table'],$m['clumn']);
                    $sql = '';
            }
            return $sql;
    }

    function alertFormat(&$indexStr,$table, $clumn){
        $clumns = explode(',',$clumn);
        foreach($clumns as $clum){
            $clum = str_replace("\r\n",'',$clum);
            $indexStr[] = sprintf('ALTER TABLE %s %s',$table,$clum);
        }
    }

    function indexFormat(&$indexStr,$table,$nm,$nmm,$uk,$ukk){
        if($nm[0]){
            foreach($nm['name'] as $k=>$name){
                $name = str_replace('`','',$name);
                $kename = strpos($name,$table)==false?$table.'_'.$name:$name;
                $kename = str_replace([',',' '],['_',''],$kename);
                $indexStr[] = "DROP INDEX IF EXISTS {$kename}";
                $field = $nm['field'][$k];
                $indexStr[] = "CREATE INDEX {$kename} ON {$table}($field)";
            }
        }
        if($nmm[0]){
            foreach($nmm['field'] as $k=>$name){
                $name = str_replace('`','',$name);
                $kename = strpos($name,$table)==false?$table.'_'.$name:$name;
                $kename = str_replace([',',' '],['_',''],$kename);
                $indexStr[] = "DROP INDEX IF EXISTS {$kename}";
                $indexStr[] = "CREATE INDEX {$kename} ON {$table}($name)";
            }
        }
        if($uk) {
            $kename = strpos($uk['name'],$table)==false?$table . '_' . $uk['name']:$uk['name'];
            $kename = str_replace(['`',',',' '],['','_',''],$kename);
            $indexStr[] = "DROP INDEX IF EXISTS {$kename}";
            $field = $uk['field'];
            $indexStr[] = "CREATE UNIQUE INDEX {$kename} ON {$table}($field)";
        }
        if($ukk) {
            $kename = strpos($ukk['field'],$table)==false?$table . '_' . $ukk['field']:$ukk['field'];
            $kename = str_replace(['`',',',' '],['','_',''],$kename);
            $indexStr[] = "DROP INDEX IF EXISTS {$kename}";
            $field = $ukk['field'];
            $indexStr[] = "CREATE UNIQUE INDEX {$kename} ON {$table}($field)";
        }
    }

    function afterRestore(){
        return true;
    }

    function showCharacterSet(){
        $charsets = ['utf8'];
        return $charsets;
    }
    function getDataSize(){
        return 0;
    }
}

