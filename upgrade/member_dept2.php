<?php
/*针对会员增加组织架构及统计的设置升级*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "CREATE TABLE IF NOT EXISTS `p8_member_dept` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `parent` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` varchar(40) NOT NULL DEFAULT '',
  `display_order` smallint(5) unsigned NOT NULL default '0',
  `item_count` mediumint(8) unsigned NOT NULL default '0',
  `item_count_sites` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
ALTER TABLE  `p8_member` ADD `dept2` VARCHAR(10) NOT NULL DEFAULT '';
ALTER TABLE `p8_member_dept` ADD `item_score` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0' AFTER `item_count`;
ALTER TABLE `p8_member_dept` ADD `item_score_sites` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0' AFTER `item_count_sites`;
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, false);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略，请进后台更新全站缓存";
