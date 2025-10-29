<?php
/*浏览量的统计的升级*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "
CREATE TABLE IF NOT EXISTS `p8_cms_statistic_sites_views` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site` varchar(50) NOT NULL DEFAULT '',
  `cid` mediumint(8) NOT NULL DEFAULT '0',
  `count` mediumint(8) NOT NULL DEFAULT '0',
  `timestamp` int(10) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `p8_cms_statistic_views` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` mediumint(8) NOT NULL DEFAULT '0',
  `count` mediumint(8) NOT NULL DEFAULT '0',
  `timestamp` int(10) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM;
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, false);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略";
