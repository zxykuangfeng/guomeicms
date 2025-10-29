<?php
/*针对栏目需要密码访问的升级*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "
ALTER TABLE `p8_cms_category_recycle` CHANGE `id` `id` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `p8_sites_category_recycle` CHANGE `id` `id` MEDIUMINT(8) UNSIGNED NOT NULL;
ALTER TABLE `p8_sites_category` ADD `need_password` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `label_postfix` ,
ADD `category_password` VARCHAR( 32 ) NOT NULL AFTER `need_password`;
ALTER TABLE `p8_sites_category_recycle` ADD `need_password` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `label_postfix` ,
ADD `category_password` VARCHAR( 32 ) NOT NULL AFTER `need_password`;";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}

echo "升级完成，如有错误提示，请忽略，请进入后台更新全站缓存";
