<?php
/*针对在线调查*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'install/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "ALTER TABLE `p8_survey_item` ADD `uid` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `id`";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "在线调查功能升级完成，如有错误提示，请忽略";
