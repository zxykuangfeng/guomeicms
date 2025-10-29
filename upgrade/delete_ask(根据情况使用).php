<?php
/*针对导数据后模块地址异常的处理*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';
require_once PHP168_PATH .'inc/cache.func.php';

@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "select * from p8_config where k = 'system&module'";

$list = $DB_master->fetch_all($sql);
$v = mb_unserialize(stripslashes($list[0]['v']));
unset($v['ask']);
$vs = $DB_master->escape_string(serialize($v));
$sql2 = "UPDATE `p8_config` SET `v` = '$vs' WHERE `system` = 'core' AND `module` = '' AND `k` = 'system&module'";
$DB_master->query($sql2);

$sql3 = "DELETE FROM `p8_config` WHERE `system` = 'ask';
DELETE FROM `p8_system` WHERE `name` = 'ask';
UPDATE `p8_system` SET `table_prefix` = '' WHERE 1=1;";

$sql3 = get_install_sql($DB_master, $sql3, $core->TABLE_, true);
foreach($sql3 as $vv){
	$DB_master->query($vv);
}
echo "删除问答模块成功，请在后台更新缓存！";











