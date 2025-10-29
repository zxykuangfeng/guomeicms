<?php
/*针对上传附件的升级*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "ALTER TABLE `p8_cms_attachment` CHANGE `type` `type` VARCHAR(100) NOT NULL DEFAULT '';
ALTER TABLE `p8_sites_attachment` CHANGE `type` `type` VARCHAR(100) NOT NULL DEFAULT '';
ALTER TABLE `p8_attachment` CHANGE `type` `type` VARCHAR(100) NOT NULL DEFAULT '';
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略，请进后台更新全站缓存";
