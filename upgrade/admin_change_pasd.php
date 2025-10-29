<?php

//就是管理员账号需要强制在多少时间段内重新修改密码，不修改密码，直接跳转到修改密码界面
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "ALTER TABLE `p8_member` ADD COLUMN `last_change_password` int(10) NOT NULL DEFAULT 0 AFTER `last_login_ip`";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略，请进后台更新全站缓存";
