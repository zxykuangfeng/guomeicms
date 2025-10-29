<?php
/*
 * 增加字段复杂布局设置升级
*/

require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "
ALTER TABLE  `p8_cms_model_field` ADD  `part` varchar(20) NOT NULL DEFAULT '' AFTER `type`;
ALTER TABLE  `p8_sites_model_field` ADD  `part` varchar(20) NOT NULL DEFAULT '' AFTER `type`;
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "增加字段复杂布局设置升级，请进入后台更新缓存！";