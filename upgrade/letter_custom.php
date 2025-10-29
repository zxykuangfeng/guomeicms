<?php
/*针对信件增加预留字段的升级*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "ALTER TABLE `p8_letter_item` ADD `custom_a` VARCHAR(255) NOT NULL DEFAULT '' AFTER `fengfa`, ADD `custom_b` VARCHAR(255) NOT NULL DEFAULT '' AFTER `custom_a`, ADD `custom_c` VARCHAR(255) NOT NULL DEFAULT '' AFTER `custom_b`, ADD `custom_d` VARCHAR(255) NOT NULL DEFAULT '' AFTER `custom_c`, ADD `custom_e` VARCHAR(255) NOT NULL DEFAULT '' AFTER `custom_d`, ADD `custom_f` VARCHAR(255) NOT NULL DEFAULT '' AFTER `custom_e`;";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略";