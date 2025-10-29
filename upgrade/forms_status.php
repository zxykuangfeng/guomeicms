<?php
//针对表单，增加字段
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$sql = "
ALTER TABLE `p8_forms_item` ADD `p8_status` VARCHAR( 50 ) NOT NULL DEFAULT '';
ALTER TABLE `p8_forms_item` ADD `p8_reply` VARCHAR( 255 ) NOT NULL DEFAULT '';
ALTER TABLE `p8_forms_item` ADD `p8_replyer` VARCHAR( 50 ) NOT NULL DEFAULT '';
ALTER TABLE `p8_forms_item` ADD `p8_reply_time` INT(10) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `p8_forms_item` CHANGE `replyer` `replyer` VARCHAR(50) NOT NULL DEFAULT '';
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}

echo "升级完成，请进入后台更新全站缓存！";