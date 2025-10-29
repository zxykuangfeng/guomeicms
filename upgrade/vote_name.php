<?php
/*针对投票模块设置*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "
ALTER TABLE  `p8_vote` CHANGE `title` `title` VARCHAR(255) NOT NULL DEFAULT '';
ALTER TABLE  `p8_vote_` CHANGE `name` `name` VARCHAR(255) NOT NULL DEFAULT '';
ALTER TABLE  `p8_vote_option` CHANGE `name` `name` VARCHAR(255) NOT NULL DEFAULT '';
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略，请进后台更新全站缓存";
