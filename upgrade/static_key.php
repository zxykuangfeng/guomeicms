<?php
/*增加索引*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "ALTER TABLE `p8_admin_log` ADD INDEX `ttc`(`timestamp`);
ALTER TABLE `p8_cms_statistic_sites_views` ADD INDEX `sct`(`site`, `cid`, `timestamp`);";
$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略";
