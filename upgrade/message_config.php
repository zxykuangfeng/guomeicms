<?php
/*针对站内短消息默认只保留90天内的系统消息的升级*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;
$this_module = $core->load_module('message');
$this_module->set_config(array(
	'interval_day' => '90',
));
echo "升级完成，请进入后台更新全站缓存！";
