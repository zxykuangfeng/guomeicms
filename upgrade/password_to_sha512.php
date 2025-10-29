<?php
/**
 * 把密码加密改成sha512,字段长度增加
 */
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';

@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;
$sql = "ALTER TABLE `p8_member` MODIFY COLUMN `username` varchar(50) NOT NULL DEFAULT '';
ALTER TABLE `p8_member` MODIFY COLUMN `password` varchar(128) NOT NULL DEFAULT '';";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
    $DB_master->query($v);
}
echo "OK";