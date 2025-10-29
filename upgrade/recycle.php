<?php
/*针对增加回收站的升级2018.12.19*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "
CREATE TABLE IF NOT EXISTS `p8_cms_category_recycle` (
  `id` mediumint(8) unsigned NOT NULL,
  `parent` smallint(5) unsigned NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `letter` varchar(2) NOT NULL DEFAULT '',
  `model` varchar(20) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `domain` varchar(255) NOT NULL DEFAULT '',
  `frame` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL,
  `item_count` mediumint(8) unsigned NOT NULL,
  `htmlize` tinyint(1) unsigned NOT NULL,
  `html_list_url_rule` varchar(255) NOT NULL DEFAULT '',
  `html_list_url_rule_mobile` varchar(255) NOT NULL DEFAULT '',
  `html_view_url_rule` varchar(255) NOT NULL DEFAULT '',
  `html_view_url_rule_mobile` varchar(255) NOT NULL DEFAULT '',
  `path` varchar(255) NOT NULL DEFAULT '',
  `page_size` smallint(5) unsigned NOT NULL DEFAULT '20',
  `list_template` varchar(50) NOT NULL DEFAULT '',
  `list_template_mobile`  varchar(50) NOT NULL DEFAULT '',
  `view_template` varchar(50) NOT NULL DEFAULT '',
  `view_template_mobile`  varchar(50) NOT NULL DEFAULT '',
  `item_template` varchar(50) NOT NULL DEFAULT '',
  `item_template_mobile`  varchar(50) NOT NULL DEFAULT '',
  `display_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `seo_keywords` text DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `label_postfix` varchar(50) NOT NULL DEFAULT '',
  `need_password` tinyint(1) NOT NULL DEFAULT 0,
  `category_password` varchar(32) NOT NULL DEFAULT '',
  `list_all_model`  tinyint(1) NOT NULL DEFAULT 0,
  `config` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `model` (`model`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `p8_sites_category_recycle` (
  `id` mediumint(8) unsigned NOT NULL,
  `parent` smallint(5) unsigned NOT NULL,
  `matrix` smallint(5) unsigned NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `site` varchar(50) NOT NULL DEFAULT '',
  `letter` varchar(2) NOT NULL DEFAULT '',
  `model` varchar(20) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `domain` varchar(255) NOT NULL DEFAULT '',
  `frame` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL,
  `item_count` mediumint(8) unsigned NOT NULL,
  `htmlize` tinyint(1) unsigned NOT NULL,
  `html_list_url_rule` varchar(255) NOT NULL DEFAULT '',
  `html_view_url_rule` varchar(255) NOT NULL DEFAULT '',
  `path` varchar(255) NOT NULL DEFAULT '',
  `page_size` smallint(5) unsigned NOT NULL DEFAULT '20',
  `list_template` varchar(50) NOT NULL DEFAULT '',
  `list_template_mobile`  varchar(50) NOT NULL DEFAULT '',
  `view_template` varchar(50) NOT NULL DEFAULT '',
  `view_template_mobile`  varchar(50) NOT NULL DEFAULT '',
  `item_template` varchar(50) NOT NULL DEFAULT '',
  `item_template_mobile`  varchar(50) NOT NULL DEFAULT '',
  `display_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `seo_keywords` text DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `label_postfix` varchar(50) NOT NULL DEFAULT '',
  `list_all_model`  tinyint(1) NOT NULL DEFAULT 0,
  `config` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `model` (`model`),
  KEY `site` (`site`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'serialize', 'verify_acl', 'a:5:{i:2;a:2:{s:4:\"name\";s:6:\"初审\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}i:1;a:2:{s:4:\"name\";s:6:\"终审\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}i:0;a:2:{s:4:\"name\";s:12:\"取消审核\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}i:88;a:2:{s:4:\"name\";s:9:\"回收站\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}i:-99;a:2:{s:4:\"name\";s:6:\"退稿\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}}');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('sites', 'item', 'serialize', 'verify_acl', 'a:5:{i:2;a:2:{s:4:\"name\";N;s:4:\"role\";a:0:{}}i:1;a:2:{s:4:\"name\";s:6:\"终审\";s:4:\"role\";a:0:{}}i:0;a:2:{s:4:\"name\";s:12:\"取消审核\";s:4:\"role\";a:0:{}}i:88;a:2:{s:4:\"name\";s:9:\"回收站\";s:4:\"role\";a:0:{}}i:-99;a:2:{s:4:\"name\";s:6:\"退稿\";s:4:\"role\";a:0:{}}}');
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, false);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略，请进后台更新全站缓存";
