<?php
/*针对排班字段升级字段*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'install/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "ALTER TABLE `p8_plugin_schedul_` CHANGE `date_time` `date_time` VARCHAR( 50 ) NOT NULL DEFAULT '';
ALTER TABLE `p8_plugin_schedul_` ADD `dcode` VARCHAR(50) NOT NULL DEFAULT '' AFTER `date_time`";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "排班功能升级完成，如有错误提示，请忽略";
