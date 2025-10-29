<?php
/*针对角色增加链接转向及字段优化升级*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "ALTER TABLE `p8_role` ADD `url` VARCHAR(255) NOT NULL DEFAULT '' AFTER `name`;
ALTER TABLE `p8_role` ADD `forward` VARCHAR(255) NOT NULL DEFAULT '' AFTER `url`;
ALTER TABLE `p8_role_group_field` ADD `is_unique` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' AFTER `not_null`;";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略，请进后台更新全站缓存";
