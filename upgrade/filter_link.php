<?php
/*创建外链数据表*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "CREATE TABLE IF NOT EXISTS `p8_filter_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system` varchar(30) NOT NULL,
  `module` varchar(30) NOT NULL,
  `site` varchar(30) NOT NULL DEFAULT '',
  `iid` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `link` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, false);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略";
