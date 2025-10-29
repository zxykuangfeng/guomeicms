<?php
/*针对分级审核，缺少审核选项，打开后台信息列表异常的处理*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "REPLACE INTO `p8_config` VALUES ('cms','item','serialize','verify_acl','a:5:{i:2;a:2:{s:4:\"name\";s:6:\"初审\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}i:1;a:2:{s:4:\"name\";s:6:\"终审\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}i:0;a:2:{s:4:\"name\";s:9:\"待审核\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}i:88;a:2:{s:4:\"name\";s:9:\"回收站\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}i:-99;a:2:{s:4:\"name\";s:6:\"退稿\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}}');
REPLACE INTO `p8_config` VALUES ('sites','item','serialize','verify_acl','a:5:{i:2;a:2:{s:4:\"name\";s:6:\"初审\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}i:1;a:2:{s:4:\"name\";s:6:\"终审\";s:4:\"role\";a:0:{}}i:0;a:2:{s:4:\"name\";s:9:\"待审核\";s:4:\"role\";a:0:{}}i:88;a:2:{s:4:\"name\";s:9:\"回收站\";s:4:\"role\";a:0:{}}i:-99;a:2:{s:4:\"name\";s:6:\"退稿\";s:4:\"role\";a:0:{}}}');";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略，请进后台更新全站缓存";
