<?php
/*评论支持审核等操作*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES
('cms', 'item', 'string', 'allow_comment', '1'),
('cms', 'item', 'serialize', 'exp_type', 'a:14:{i:0;a:2:{s:4:\"code\";s:9:\"chinapost\";s:4:\"name\";s:12:\"邮政包裹\";}i:1;a:2:{s:4:\"code\";s:3:\"YTO\";s:4:\"name\";s:6:\"圆通\";}i:2;a:2:{s:4:\"code\";s:9:\"SFEXPRESS\";s:4:\"name\";s:6:\"顺丰\";}i:3;a:2:{s:4:\"code\";s:3:\"STO\";s:4:\"name\";s:6:\"申通\";}i:4;a:2:{s:4:\"code\";s:2:\"JD\";s:4:\"name\";s:6:\"京东\";}i:5;a:2:{s:4:\"code\";s:5:\"YUNDA\";s:4:\"name\";s:6:\"韵达\";}i:6;a:2:{s:4:\"code\";s:3:\"ZTO\";s:4:\"name\";s:6:\"中通\";}i:7;a:2:{s:4:\"code\";s:4:\"HTKY\";s:4:\"name\";s:6:\"汇通\";}i:8;a:2:{s:4:\"code\";s:3:\"EMS\";s:4:\"name\";s:3:\"EMS\";}i:9;a:2:{s:4:\"code\";s:6:\"TTKDEX\";s:4:\"name\";s:6:\"天天\";}i:10;a:2:{s:4:\"code\";s:3:\"GTO\";s:4:\"name\";s:6:\"国通\";}i:11;a:2:{s:4:\"code\";s:6:\"DEPPON\";s:4:\"name\";s:6:\"德邦\";}i:12;a:2:{s:4:\"code\";s:3:\"ZJS\";s:4:\"name\";s:9:\"宅急送\";}i:13;a:2:{s:4:\"code\";s:6:\"others\";s:4:\"name\";s:6:\"其它\";}}');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES
('cms', 'item', 'serialize', 'order', 'a:12:{s:7:\"enabled\";s:1:\"1\";s:7:\"field_1\";s:6:\"姓名\";s:15:\"field_1_enabled\";s:1:\"1\";s:7:\"field_2\";s:6:\"电话\";s:15:\"field_2_enabled\";s:1:\"1\";s:7:\"field_3\";s:6:\"数量\";s:15:\"field_3_enabled\";s:1:\"1\";s:7:\"field_4\";s:9:\"手机号\";s:7:\"field_5\";s:12:\"电子邮件\";s:7:\"field_6\";s:12:\"快递地址\";s:7:\"field_7\";s:12:\"公司名称\";s:4:\"code\";s:3:\"dx_\";}');
ALTER TABLE  `p8_cms_item_comment` ADD  `verifier` VARCHAR(30) NULL DEFAULT  '',
ADD `verified` tinyint(1) unsigned NOT NULL default '1',
ADD `verify_timestramp` int(10) unsigned NOT NULL,
ADD `reason` varchar(255) NOT NULL default '',
ADD `code` varchar(30) NOT NULL DEFAULT '',
ADD `exp_type` varchar(25) NOT NULL DEFAULT '',
ADD `exp_no` varchar(50) NOT NULL DEFAULT '',
ADD `field_1` varchar(255) NOT NULL default '',
ADD `field_2` varchar(255) NOT NULL default '',
ADD `field_3` varchar(255) NOT NULL default '',
ADD `field_4` varchar(255) NOT NULL default '',
ADD `field_5` varchar(255) NOT NULL default '',
ADD `field_6` varchar(255) NOT NULL default '',
ADD `field_7` varchar(255) NOT NULL default '';
ALTER TABLE  `p8_cms_item_comment_unverified` ADD  `verifier` VARCHAR(30) NULL DEFAULT  '',
ADD `verified` tinyint(1) unsigned NOT NULL default '1',
ADD `verify_timestramp` int(10) unsigned NOT NULL,
ADD `reason` varchar(255) NOT NULL default '',
ADD `code` varchar(30) NOT NULL DEFAULT '',
ADD `exp_type` varchar(25) NOT NULL DEFAULT '',
ADD `exp_no` varchar(50) NOT NULL DEFAULT '',
ADD `field_1` varchar(255) NOT NULL default '',
ADD `field_2` varchar(255) NOT NULL default '',
ADD `field_3` varchar(255) NOT NULL default '',
ADD `field_4` varchar(255) NOT NULL default '',
ADD `field_5` varchar(255) NOT NULL default '',
ADD `field_6` varchar(255) NOT NULL default '',
ADD `field_7` varchar(255) NOT NULL default '';";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略";
