<?php
/*针对会员增加找回密码升级*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "
ALTER TABLE  `p8_member` ADD `find_pwd` VARCHAR(255) NOT NULL DEFAULT '';
INSERT INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES
('core', 'member', 'serialize', 'questions', 'a:9:{i:9;s:24:\"您配偶的生日是？\";i:8;s:24:\"您的小学校名是？\";i:7;s:24:\"您的中学校名是？\";i:6;s:24:\"您的大学校名是？\";i:5;s:24:\"您最喜欢的歌曲？\";i:4;s:24:\"您最喜爱的食物？\";i:3;s:24:\"您的偶像明星是？\";i:2;s:24:\"您最喜爱的电影？\";i:1;s:18:\"您的宠物是？\";}');
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略，请进后台更新全站缓存";
