<?php
/*针对前台导航菜单上传图片及简介*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "ALTER TABLE  `p8_navigation_menu` ADD `summary` text DEFAULT NULL,ADD `frame` varchar( 255 ) NOT NULL DEFAULT '';
ALTER TABLE `p8_navigation_menu` ADD `dynamic_url` varchar( 255 ) NOT NULL DEFAULT '' AFTER `url`;
UPDATE `p8_navigation_menu` SET `dynamic_url` =  `url`;
ALTER TABLE  `p8_sites_menu` ADD `summary` text DEFAULT NULL,ADD `frame` varchar( 255 ) NOT NULL DEFAULT '';
ALTER TABLE `p8_sites_menu` ADD `dynamic_url` varchar( 255 ) NOT NULL DEFAULT '' AFTER `url`;
UPDATE `p8_sites_menu` SET `dynamic_url` =  `url`;";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "新增前台导航菜单上传图片及简介升级完成，如有错误提示，请忽略，请进后台更新全站缓存";
