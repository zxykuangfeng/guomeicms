<?php
/*针对系统内容体检扫描*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "
CREATE TABLE IF NOT EXISTS `p8_word_scan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `system` varchar(30) NOT NULL DEFAULT '',
  `module` varchar(30) NOT NULL DEFAULT '',
  `site` varchar(30) NOT NULL DEFAULT '',
  `iid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `model` varchar(20) NOT NULL DEFAULT '',
  `message` varchar(512) NOT NULL DEFAULT '',
   PRIMARY KEY (`id`)
);
CREATE TABLE IF NOT EXISTS `p8_word_scan_filter` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `filter_word` char(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `filter_word` (`filter_word`)
);
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, false);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略";
