<?php
/*强化升级后台操作日志*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "ALTER TABLE `p8_admin_log` ADD `system` CHAR(30) NOT NULL DEFAULT '' AFTER `uid`, ADD `module` CHAR(30) NOT NULL DEFAULT '' AFTER `system`, ADD `action` CHAR(30) NOT NULL DEFAULT '' AFTER `module`, ADD `site` CHAR(30) NOT NULL DEFAULT '' AFTER `action`, ADD `iid` CHAR(30) NOT NULL DEFAULT '0' AFTER `action`, ADD `cid` SMALLINT(5) NOT NULL DEFAULT '0' AFTER `iid`;";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略，请进后台更新全站缓存";
