<?php
/*
awesome字体库
*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "ALTER TABLE `p8_admin_menu` ADD `menu_sys` VARCHAR( 20 ) NOT NULL DEFAULT 'main' AFTER `menu_icon`;";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
require_once PHP168_PATH .'inc/cache.func.php';
cache_menu();
echo "升级完成，请刷新！";