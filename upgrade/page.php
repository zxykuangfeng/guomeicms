<?php
/*
 *CMS新增单网页模型
*/

require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "
INSERT INTO `p8_cms_model` (`name`, `alias`, `enabled`, `config`) VALUES ('page', '单网页', 1, 'a:0:{}');
INSERT INTO `p8_cms_model_field` (`model`, `parent`, `name`, `alias`, `type`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `description`) VALUES ('page', 0, 'content', '', 'mediumtext', 0, 0, 0, 1, '0', 0, 1, '', 'a:0:{}', 'a:0:{}', 'editor', '', 99, '', '');
CREATE TABLE IF NOT EXISTS `p8_cms_item_page_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(120) NOT NULL DEFAULT '',
  `frame` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL,
  `verifier` varchar(50) NOT NULL DEFAULT '',
  `verify_time` int(10) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `list_order` int(10) unsigned NOT NULL,
  `update_time` int(10) unsigned NOT NULL,
  `pages` smallint(5) unsigned NOT NULL DEFAULT '1',
  `html_view_url_rule` varchar(80) NOT NULL DEFAULT '',
  `template` varchar(30) NOT NULL DEFAULT '',
  `views` mediumint(8) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `comments` mediumint(8) unsigned NOT NULL,
  `seo_keywords` varchar(100) NOT NULL,
  `seo_description` varchar(200) NOT NULL,
  `label_postfix` varchar(50) NOT NULL,
  `config` varchar(512) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `level` (`level`,`list_order`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `p8_cms_item_page_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL,
  `page` smallint(5) unsigned NOT NULL,
  `addon_title` varchar(40) NOT NULL DEFAULT '',
  `addon_frame` varchar(100) NOT NULL DEFAULT '',
  `addon_summary` varchar(180) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, false);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "单网页模型新增成功，请进入后台更新缓存";