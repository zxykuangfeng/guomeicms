<?php
/*针对敏感词*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "
ALTER TABLE `p8_filter_word` ADD `aid` smallint(5) unsigned NOT NULL DEFAULT '0' AFTER `filter_word`;
ALTER TABLE `p8_filter_word` ADD `type` tinyint(1) NOT NULL default '1' AFTER `aid`;
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, false);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略";
