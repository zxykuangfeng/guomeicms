<?php

require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;


$sql = "
ALTER TABLE `p8_sites_stop_data` ADD COLUMN `new_id` int(11) NOT NULL default '0';
CREATE TABLE IF NOT EXISTS `p8_cms_statistic_sites_push` (
  `site` varchar(30) NOT NULL DEFAULT '',
  `cid` smallint(8) NOT NULL DEFAULT '0',
  `model` varchar(30) NOT NULL DEFAULT '',
  `year` smallint(4) unsigned NOT NULL DEFAULT '0',
  `month` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `day` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `post` int(10) unsigned NOT NULL DEFAULT '0',
  `verified` int(10) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `uk` (`year`,`month`,`site`)
) ENGINE=MyISAM DEFAULT charset=utf-8;
CREATE TABLE IF NOT EXISTS `p8_cms_statistic_sites_content` (
  `site` varchar(30) NOT NULL DEFAULT '',
  `cid` smallint(8) NOT NULL DEFAULT '0',
  `model` varchar(30) NOT NULL DEFAULT '',
  `year` smallint(4) NOT NULL DEFAULT '0',
  `month` tinyint(1) NOT NULL DEFAULT '0',
  `day` tinyint(1) NOT NULL DEFAULT '0',
  `post` int(10) NOT NULL DEFAULT '0',
  `verified` int(10) NOT NULL DEFAULT '0',
  `unverified` int(10) NOT NULL,
  `timestamp` int(10) NOT NULL DEFAULT '0',
  UNIQUE KEY `uk` (`year`,`month`,`site`)
) ENGINE=MyISAM DEFAULT charset=utf-8;
";
$sql = get_install_sql($DB_master, $sql, $core->TABLE_, false);
foreach($sql as $v){
	$DB_master->query($v);
}


$premenu = $DB_master->fetch_one("select * from {$core->TABLE_}admin_menu where system='cms' and name='统计'");
$DB_master->insert($core->TABLE_.'admin_menu', array('system'=>'cms','module'=>'statistic','parent'=>$premenu['id'],'name'=>'分站推送统计','action'=>'statistic_sites_push','display'=>1));
$DB_master->insert($core->TABLE_.'admin_menu', array('system'=>'cms','module'=>'statistic','parent'=>$premenu['id'],'name'=>'分站内容统计','action'=>'statistic_sites_content','display'=>1));

echo '补丁完成，如有错误可忽略!';
