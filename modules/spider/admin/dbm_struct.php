<?php
defined('PHP168_PATH') or die();

/**
* 表结构管理
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');
$dbm_config = $core->CACHE->read($this_system->name .'/modules', $this_module->name, 'dbm_config');
$dbm_config or message('mysql_config_err');
$db = new P8_mysql(
	$dbm_config['_db_host'],
	$dbm_config['_db_user'],
	$dbm_config['_db_password'],
	$dbm_config['_db_name'],
	$dbm_config['_db_charset'],
	0
);
if($db->connect() != 0){
	message("Error:连接失败,请检查MySQL配置参数！");
}

$name = isset($_GET['name']) ? p8_stripslashes2(xss_clear($_GET['name'])) : '';
$name or message('access_denied');

$list = $db->getTableStruct($name);
if($dbm_config['_page_charset'] == 'gbk') $list = convert_encode('GBK','UTF-8', $list);

$properties = array('binary', 'unsigned', 'unsigned zerofill', 'on update current_timestamp');
$types = array(
	'tinyint', 'smallint', 'mediumint', 'int', 'integer', 'bigint', 
	'bit', 'real', 'float', 'double', 'decimal', 'numberic', 
	'char', 'varchar', 
	'date', 'time', 'datetime', 'timestamp',
	'tinyblob', 'blob', 'mediumblob', 'longblob',
	'tinytext', 'text', 'mediumtext', 'longtext',
	'enum', 'set', 'binary'
);
$key_types = array('primary', 'unique', 'fulltext', '');

$keys = $db->getTableKeys($name);

include template($this_module, 'dbm_struct', 'admin');	

