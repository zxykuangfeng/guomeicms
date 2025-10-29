<?php
/*标签缺失字段尝试修复*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'install/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "
ALTER TABLE `p8_label` ADD `site` VARCHAR( 50 ) NOT NULL AFTER `module`;
ALTER TABLE `p8_label` ADD `env` VARCHAR( 50 ) NOT NULL AFTER `site`;
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
require_once PHP168_PATH .'inc/cache.func.php';

cache_label();
