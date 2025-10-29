<?php
/*针对敏感词*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "
ALTER TABLE `p8_word_scan_filter` ADD `aid` smallint(5) unsigned NOT NULL DEFAULT '0' AFTER `filter_word`;
ALTER TABLE `p8_word_scan_filter` ADD `type` tinyint(1) NOT NULL default '1' AFTER `aid`;
ALTER TABLE `p8_word_scan` ADD `title` varchar(512) NOT NULL DEFAULT '' AFTER `module`;
ALTER TABLE `p8_word_scan` ADD `timestamp` int(10) unsigned NOT NULL DEFAULT '0' AFTER `title`;
ALTER TABLE `p8_word_scan` ADD `uid` smallint(10) unsigned NOT NULL DEFAULT '0' AFTER `timestamp`;
ALTER TABLE `p8_word_scan` ADD `author` varchar(20) NOT NULL DEFAULT '' AFTER `uid`;;
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, false);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略";
