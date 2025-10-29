<?php
/*审核推送的数据时，给推送者发站内信*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "ALTER TABLE  `p8_sites_stop_data` ADD  `from` VARCHAR( 20 ) NOT NULL DEFAULT  'cms';
ALTER TABLE  `p8_sites_stop_data` ADD  `to` VARCHAR( 20 ) NOT NULL DEFAULT  'sites';
ALTER TABLE  `p8_cms_item_unverified` ADD  `push_item_id` int(10) unsigned NOT NULL default '0';
ALTER TABLE  `p8_sites_item_unverified` ADD  `push_item_id` int(10) unsigned NOT NULL default '0';";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略";
