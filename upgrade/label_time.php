<?php
/*针对标签模块增加更新时间和用户设置的升级*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "
ALTER TABLE `p8_label` ADD `update_time` INT(10) UNSIGNED NOT NULL DEFAULT '0',ADD `last_setter` VARCHAR(20) NOT NULL DEFAULT '';
UPDATE `p8_label` SET `update_time` = `timestamp`;";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略，请进后台更新全站缓存";
