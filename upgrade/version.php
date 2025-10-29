<?php
/*针对菜单的升级*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 0;

$sql = "REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES('core', '', 'string', 'build', '20240809');";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
require_once PHP168_PATH .'inc/cache.func.php';

cache_all();
echo "升级完成，如有错误，请忽略！";
