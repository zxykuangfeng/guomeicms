<?php
/*针对导数据后模块地址异常的处理*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';
require_once PHP168_PATH .'inc/cache.func.php';

@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;
$sql = "select * from p8_config where k = 'system&module'";

$list = $DB_master->fetch_all($sql);

$v = mb_unserialize(stripslashes($list[0]['v']));
$v['cms']['modules']['wechat'] = $v['cms']['modules']['item'];
foreach($v['cms']['modules']['wechat'] as $key=>$value){
	$v['cms']['modules']['wechat'][$key] = str_replace('item','wechat',$value);
	$v['cms']['modules']['wechat'][$key] = str_replace('Item','Wechat',$v['cms']['modules']['wechat'][$key]);
}
$v['cms']['modules']['wechat']['name'] = '微件助手';
$vs = $DB_master->escape_string(serialize($v));

$sql2 = "UPDATE `p8_config` SET `v` = '$vs' WHERE `system` = 'core' AND `module` = '' AND `k` = 'system&module'";
$DB_master->query($sql2);

$sql = "CREATE TABLE IF NOT EXISTS `p8_cms_wechat_keywords` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keyword` varchar(100) NOT NULL DEFAULT '',
  `type` varchar(10) NOT NULL DEFAULT '',
  `pattern` tinyint(3) unsigned NOT NULL DEFAULT 1,
  `content` mediumtext DEFAULT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `picurl` varchar(200) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL DEFAULT '',
  `reply_type` varchar(10) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `keyword` (`keyword`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `p8_cms_wechat_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT 0,
  `name` varchar(30) NOT NULL DEFAULT '',
  `value` varchar(100) NOT NULL DEFAULT '',
  `type` varchar(10) NOT NULL DEFAULT '',
  `list_order` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `p8_cms_wechat_messages` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(30) NOT NULL DEFAULT '',
  `type` varchar(15) NOT NULL DEFAULT '',
  `content` varchar(255) NOT NULL DEFAULT '',
  `reply` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `p8_cms_wechat_pushlogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned NOT NULL,
  `no` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `media_id` varchar(100) NOT NULL DEFAULT '',
  `msg_id` varchar(100) NOT NULL DEFAULT '',
  `msg_data_id` varchar(100) NOT NULL DEFAULT '',
  `litpic` varchar(100) NOT NULL DEFAULT '',
  `litpic_id` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(200) NOT NULL DEFAULT '',
  `username` varchar(50) NOT NULL DEFAULT '',
  `verifier` varchar(50) NOT NULL  DEFAULT '',
  `author` varchar(30) NOT NULL DEFAULT '',
  `show_author` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `open_comment` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `fans_comment` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `description` varchar(255) NOT NULL DEFAULT '',
  `body` text DEFAULT NULL,
  `push_at` varchar(255) NOT NULL DEFAULT '',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `aid` (`aid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `p8_cms_wechat_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(30) NOT NULL DEFAULT '',
  `subscribe` tinyint(1) NOT NULL DEFAULT 0,
  `nickname` varchar(30) NOT NULL DEFAULT '',
  `sex` tinyint(1) NOT NULL DEFAULT 0,
  `city` varchar(30) NOT NULL DEFAULT '',
  `province` varchar(30) NOT NULL DEFAULT '',
  `country` varchar(30) NOT NULL DEFAULT '',
  `headimgurl` varchar(200) NOT NULL DEFAULT '',
  `subscribe_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `unionid` varchar(30) NOT NULL DEFAULT '',
  `subscribe_scene` varchar(20) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `openid` (`openid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
DELETE FROM `p8_module` WHERE `name` = 'wechat';
INSERT INTO `p8_module` (`system`, `name`, `alias`, `class`, `controller_class`, `installed`, `enabled`) VALUES
('cms', 'wechat', '微件助手', 'P8_CMS_Wechat', 'P8_CMS_Wechat_Controller', 1, 1);";


$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}


echo "操作成功，如有报错请忽略，请在后台更新缓存！";











