<?php
/*
 *计划任务字段长度增加
 * 计划任务增加几点执行
*/

require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "ALTER TABLE  `p8_crontab_` CHANGE  `script`  `script` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT  '';
ALTER TABLE `p8_crontab_` ADD COLUMN `time` tinyint(2) NOT NULL DEFAULT 0;
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成！";