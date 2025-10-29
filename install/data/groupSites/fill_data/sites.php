-- <?php exit;?>
DROP TABLE IF EXISTS `p8_sites_attachment`;
CREATE TABLE `p8_sites_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module` char(50) NOT NULL DEFAULT '',
  `item_id` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `filename` char(100) NOT NULL DEFAULT '',
  `type` char(50) NOT NULL DEFAULT '',
  `ext` char(5) NOT NULL DEFAULT '',
  `size` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ip` char(15) NOT NULL DEFAULT '',
  `path` char(60) NOT NULL DEFAULT '',
  `thumb` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `remote` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`uid`),
  KEY `module` (`module`,`timestamp`),
  KEY `uid` (`uid`,`timestamp`),
  KEY `item_id` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_category`;
CREATE TABLE `p8_sites_category` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
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
  `list_template_mobile` varchar(50) NOT NULL DEFAULT '',
  `view_template` varchar(50) NOT NULL DEFAULT '',
  `view_template_mobile` varchar(50) NOT NULL DEFAULT '',
  `item_template` varchar(50) NOT NULL DEFAULT '',
  `item_template_mobile` varchar(50) NOT NULL DEFAULT '',
  `display_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `seo_keywords` text NOT NULL,
  `seo_description` text NOT NULL,
  `label_postfix` varchar(50) NOT NULL DEFAULT '',
  `list_all_model` tinyint(1) NOT NULL DEFAULT '0',
  `config` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `model` (`model`),
  KEY `site` (`site`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_category_recycle`;
CREATE TABLE `p8_sites_category_recycle` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
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
  `list_template_mobile` varchar(50) NOT NULL DEFAULT '',
  `view_template` varchar(50) NOT NULL DEFAULT '',
  `view_template_mobile` varchar(50) NOT NULL DEFAULT '',
  `item_template` varchar(50) NOT NULL DEFAULT '',
  `item_template_mobile` varchar(50) NOT NULL DEFAULT '',
  `display_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `seo_keywords` text NOT NULL,
  `seo_description` text NOT NULL,
  `label_postfix` varchar(50) NOT NULL DEFAULT '',
  `list_all_model` tinyint(1) NOT NULL DEFAULT '0',
  `config` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `model` (`model`),
  KEY `site` (`site`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_farm_field`;
CREATE TABLE `p8_sites_farm_field` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(30) NOT NULL DEFAULT '',
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL DEFAULT '',
  `alias` varchar(50) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT '',
  `list_table` tinyint(1) NOT NULL DEFAULT '0',
  `filterable` tinyint(1) NOT NULL DEFAULT '0',
  `orderby` tinyint(1) NOT NULL DEFAULT '0',
  `not_null` tinyint(1) unsigned NOT NULL,
  `length` varchar(10) NOT NULL DEFAULT '',
  `is_unsigned` tinyint(1) unsigned NOT NULL,
  `editable` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `default_value` text NOT NULL,
  `data` text NOT NULL,
  `config` text NOT NULL,
  `widget` varchar(50) NOT NULL DEFAULT '',
  `widget_addon_attr` varchar(255) NOT NULL DEFAULT '',
  `display_order` tinyint(3) unsigned NOT NULL,
  `units` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`model`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item`;
CREATE TABLE `p8_sites_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(120) NOT NULL DEFAULT '',
  `site` varchar(50) NOT NULL DEFAULT '',
  `cid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `frame` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `author` varchar(20) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `username` varchar(50) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `pages` smallint(5) unsigned NOT NULL DEFAULT '1',
  `html_view_url_rule` varchar(80) NOT NULL DEFAULT '',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `source` varchar(255) NOT NULL,
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `verify_frame` varchar(255) NOT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `list_order` int(10) unsigned NOT NULL DEFAULT '0',
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `verifier` tinyint(1) NOT NULL DEFAULT '0',
  `ever_verified` tinyint(1) NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `allow_mood` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `credit` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `credit_type` smallint(5) unsigned NOT NULL DEFAULT '0',
  `digg` mediumint(8) NOT NULL DEFAULT '0',
  `trample` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `site_cid_id` (`site`,`cid`,`id`),
  KEY `timestamp` (`timestamp`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_affairs_`;
CREATE TABLE `p8_sites_item_affairs_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(120) NOT NULL DEFAULT '',
  `site` varchar(50) NOT NULL DEFAULT '',
  `frame` varchar(100) NOT NULL DEFAULT '',
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL,
  `verifier` tinyint(1) unsigned NOT NULL,
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
  `fileno` varchar(255) NOT NULL,
  `indexno` varchar(255) NOT NULL,
  `issued` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sxlb` varchar(255) NOT NULL,
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_affairs_addon`;
CREATE TABLE `p8_sites_item_affairs_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL,
  `site` varchar(50) NOT NULL DEFAULT '',
  `page` smallint(5) unsigned NOT NULL,
  `addon_title` varchar(40) NOT NULL DEFAULT '',
  `addon_frame` varchar(100) NOT NULL DEFAULT '',
  `addon_summary` varchar(180) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext,
  `opendate` varchar(255) NOT NULL,
  `recorder` varchar(255) NOT NULL,
  `toushu` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_article_`;
CREATE TABLE `p8_sites_item_article_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(120) NOT NULL DEFAULT '',
  `site` varchar(50) NOT NULL DEFAULT '',
  `frame` varchar(100) NOT NULL DEFAULT '',
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL,
  `verifier` tinyint(1) unsigned NOT NULL,
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
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_article_addon`;
CREATE TABLE `p8_sites_item_article_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL,
  `site` varchar(50) NOT NULL DEFAULT '',
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_attribute`;
CREATE TABLE `p8_sites_item_attribute` (
  `id` int(10) unsigned NOT NULL,
  `aid` tinyint(3) unsigned NOT NULL,
  `cid` mediumint(8) unsigned NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `last_setter` char(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`aid`,`id`),
  KEY `id` (`id`),
  KEY `aid` (`aid`,`timestamp`),
  KEY `cid` (`aid`,`cid`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_baoming_`;
CREATE TABLE `p8_sites_item_baoming_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(120) NOT NULL DEFAULT '',
  `site` varchar(50) NOT NULL DEFAULT '',
  `frame` varchar(100) NOT NULL DEFAULT '',
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL,
  `verifier` tinyint(1) unsigned NOT NULL,
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
  `name` varchar(255) NOT NULL,
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_baoming_addon`;
CREATE TABLE `p8_sites_item_baoming_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL,
  `site` varchar(50) NOT NULL DEFAULT '',
  `page` smallint(5) unsigned NOT NULL,
  `addon_title` varchar(40) NOT NULL DEFAULT '',
  `addon_frame` varchar(100) NOT NULL DEFAULT '',
  `addon_summary` varchar(180) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `tel` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dizhi` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_comment`;
CREATE TABLE `p8_sites_item_comment` (
  `id` bigint(20) unsigned NOT NULL,
  `iid` int(10) unsigned NOT NULL,
  `mid` smallint(5) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL,
  `quote` text NOT NULL,
  `content` text NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `ip` char(15) NOT NULL DEFAULT '',
  `digg` smallint(5) unsigned NOT NULL DEFAULT '0',
  `oppose` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`timestamp`),
  KEY `digg` (`iid`,`digg`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_comment_id`;
CREATE TABLE `p8_sites_item_comment_id` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_down_`;
CREATE TABLE `p8_sites_item_down_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(120) NOT NULL DEFAULT '',
  `site` varchar(50) NOT NULL DEFAULT '',
  `frame` varchar(100) NOT NULL DEFAULT '',
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL,
  `verifier` tinyint(1) unsigned NOT NULL,
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
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_down_addon`;
CREATE TABLE `p8_sites_item_down_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL,
  `site` varchar(50) NOT NULL DEFAULT '',
  `page` smallint(5) unsigned NOT NULL,
  `addon_title` varchar(40) NOT NULL DEFAULT '',
  `addon_frame` varchar(100) NOT NULL DEFAULT '',
  `addon_summary` varchar(180) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `demo` varchar(255) DEFAULT NULL,
  `softsize` varchar(10) NOT NULL,
  `softurl` mediumtext NOT NULL,
  `totaldown` mediumint(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_govopen_`;
CREATE TABLE `p8_sites_item_govopen_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(120) NOT NULL DEFAULT '',
  `site` varchar(50) NOT NULL DEFAULT '',
  `frame` varchar(100) NOT NULL DEFAULT '',
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL,
  `verifier` tinyint(1) unsigned NOT NULL,
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
  `duixiang` tinyint(3) NOT NULL,
  `geshi` tinyint(3) NOT NULL,
  `jigou` tinyint(3) NOT NULL,
  `shengming` tinyint(3) NOT NULL,
  `suoyin` varchar(255) NOT NULL,
  `ticai` tinyint(3) NOT NULL,
  `wenhao` varchar(255) DEFAULT NULL,
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_govopen_addon`;
CREATE TABLE `p8_sites_item_govopen_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL,
  `site` varchar(50) NOT NULL DEFAULT '',
  `page` smallint(5) unsigned NOT NULL,
  `addon_title` varchar(40) NOT NULL DEFAULT '',
  `addon_frame` varchar(100) NOT NULL DEFAULT '',
  `addon_summary` varchar(180) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `xinxifenlei` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_jianyi_`;
CREATE TABLE `p8_sites_item_jianyi_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(120) NOT NULL DEFAULT '',
  `site` varchar(50) NOT NULL DEFAULT '',
  `frame` varchar(100) NOT NULL DEFAULT '',
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL,
  `verifier` tinyint(1) unsigned NOT NULL,
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
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_jianyi_addon`;
CREATE TABLE `p8_sites_item_jianyi_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL,
  `site` varchar(50) NOT NULL DEFAULT '',
  `page` smallint(5) unsigned NOT NULL,
  `addon_title` varchar(40) NOT NULL DEFAULT '',
  `addon_frame` varchar(100) NOT NULL DEFAULT '',
  `addon_summary` varchar(180) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `tel` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `xingbie` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_member`;
CREATE TABLE `p8_sites_item_member` (
  `iid` int(10) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL,
  `model` char(20) NOT NULL DEFAULT '',
  `verified` tinyint(1) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`iid`),
  KEY `uid` (`uid`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_page_`;
CREATE TABLE `p8_sites_item_page_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(120) NOT NULL DEFAULT '',
  `site` varchar(50) NOT NULL DEFAULT '',
  `frame` varchar(100) NOT NULL DEFAULT '',
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL,
  `verifier` tinyint(1) unsigned NOT NULL,
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
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_page_addon`;
CREATE TABLE `p8_sites_item_page_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL,
  `site` varchar(50) NOT NULL DEFAULT '',
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_paper_`;
CREATE TABLE `p8_sites_item_paper_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(120) NOT NULL DEFAULT '',
  `site` varchar(50) NOT NULL DEFAULT '',
  `frame` varchar(100) NOT NULL DEFAULT '',
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL,
  `verifier` tinyint(1) unsigned NOT NULL,
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
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_paper_addon`;
CREATE TABLE `p8_sites_item_paper_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL,
  `site` varchar(50) NOT NULL DEFAULT '',
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_photo_`;
CREATE TABLE `p8_sites_item_photo_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(120) NOT NULL DEFAULT '',
  `site` varchar(50) NOT NULL DEFAULT '',
  `frame` varchar(100) NOT NULL DEFAULT '',
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL,
  `verifier` tinyint(1) unsigned NOT NULL,
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
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_photo_addon`;
CREATE TABLE `p8_sites_item_photo_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL,
  `site` varchar(50) NOT NULL DEFAULT '',
  `page` smallint(5) unsigned NOT NULL,
  `addon_title` varchar(40) NOT NULL DEFAULT '',
  `addon_frame` varchar(100) NOT NULL DEFAULT '',
  `addon_summary` varchar(180) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext,
  `photourl` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_product_`;
CREATE TABLE `p8_sites_item_product_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(120) NOT NULL DEFAULT '',
  `site` varchar(50) NOT NULL DEFAULT '',
  `frame` varchar(100) NOT NULL DEFAULT '',
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL,
  `verifier` tinyint(1) unsigned NOT NULL,
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
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_product_addon`;
CREATE TABLE `p8_sites_item_product_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL,
  `site` varchar(50) NOT NULL DEFAULT '',
  `page` smallint(5) unsigned NOT NULL,
  `addon_title` varchar(40) NOT NULL DEFAULT '',
  `addon_frame` varchar(100) NOT NULL DEFAULT '',
  `addon_summary` varchar(180) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `aboutinfo` mediumtext NOT NULL,
  `attrbutes` text NOT NULL,
  `content` mediumtext NOT NULL,
  `pics` text NOT NULL,
  `pro_down` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_unverified`;
CREATE TABLE `p8_sites_item_unverified` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `site` varchar(50) NOT NULL DEFAULT '',
  `cid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `pages` smallint(5) unsigned NOT NULL DEFAULT '1',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `source` varchar(255) NOT NULL,
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL,
  `verify_frame` varchar(255) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `ever_verified` tinyint(1) NOT NULL DEFAULT '0',
  `data` longtext NOT NULL,
  `push_back_reason` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`timestamp`),
  KEY `site_cid_id` (`site`,`cid`,`id`),
  KEY `cid` (`cid`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_video_`;
CREATE TABLE `p8_sites_item_video_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(120) NOT NULL DEFAULT '',
  `site` varchar(50) NOT NULL DEFAULT '',
  `frame` varchar(100) NOT NULL DEFAULT '',
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL,
  `verifier` tinyint(1) unsigned NOT NULL,
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
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_video_addon`;
CREATE TABLE `p8_sites_item_video_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL,
  `site` varchar(50) NOT NULL DEFAULT '',
  `page` smallint(5) unsigned NOT NULL,
  `addon_title` varchar(40) NOT NULL DEFAULT '',
  `addon_frame` varchar(100) NOT NULL DEFAULT '',
  `addon_summary` varchar(180) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `video_height` smallint(5) NOT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `video_width` smallint(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_yingping_`;
CREATE TABLE `p8_sites_item_yingping_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(120) NOT NULL DEFAULT '',
  `site` varchar(50) NOT NULL DEFAULT '',
  `frame` varchar(100) NOT NULL DEFAULT '',
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL,
  `verifier` tinyint(1) unsigned NOT NULL,
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
  `name` varchar(255) NOT NULL,
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_yingping_addon`;
CREATE TABLE `p8_sites_item_yingping_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL,
  `site` varchar(50) NOT NULL DEFAULT '',
  `page` smallint(5) unsigned NOT NULL,
  `addon_title` varchar(40) NOT NULL DEFAULT '',
  `addon_frame` varchar(100) NOT NULL DEFAULT '',
  `addon_summary` varchar(180) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `xingbie` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gangwei` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_zhaopin_`;
CREATE TABLE `p8_sites_item_zhaopin_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(120) NOT NULL DEFAULT '',
  `site` varchar(50) NOT NULL DEFAULT '',
  `frame` varchar(100) NOT NULL DEFAULT '',
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL,
  `verifier` tinyint(1) unsigned NOT NULL,
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
  `gangwei` varchar(255) NOT NULL,
  `didian` varchar(255) NOT NULL,
  `renshu` varchar(255) NOT NULL,
  `xueli` varchar(255) NOT NULL,
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_zhaopin_addon`;
CREATE TABLE `p8_sites_item_zhaopin_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL,
  `site` varchar(50) NOT NULL DEFAULT '',
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_letter_data`;
CREATE TABLE `p8_sites_letter_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL DEFAULT '0',
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `site` varchar(20) NOT NULL DEFAULT '',
  `attachment_name` varchar(30) NOT NULL DEFAULT '',
  `attachment` varchar(255) NOT NULL DEFAULT '',
  `add_time` int(11) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `reply_uid` int(11) NOT NULL DEFAULT '0',
  `reply_name` varchar(30) NOT NULL,
  `reply_department` smallint(5) NOT NULL,
  `reply_time` int(11) NOT NULL,
  `reply` text NOT NULL,
  `turntig` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_letter_department`;
CREATE TABLE `p8_sites_letter_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `site` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(30) NOT NULL DEFAULT '',
  `num` int(11) NOT NULL DEFAULT '0',
  `desc` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `site` (`site`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_letter_item`;
CREATE TABLE `p8_sites_letter_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` smallint(5) NOT NULL,
  `type` tinyint(3) NOT NULL,
  `site` varchar(20) NOT NULL DEFAULT '',
  `visual` tinyint(1) NOT NULL DEFAULT '0',
  `undisplay` tinyint(1) NOT NULL DEFAULT '0',
  `number` varchar(20) NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `code` char(32) NOT NULL DEFAULT '',
  `gender` tinyint(1) NOT NULL DEFAULT '0',
  `age` tinyint(3) NOT NULL DEFAULT '0',
  `phone` varchar(16) NOT NULL DEFAULT '',
  `ip` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `id_type` tinyint(2) NOT NULL DEFAULT '0',
  `id_num` varchar(30) NOT NULL DEFAULT '',
  `source` tinyint(1) NOT NULL DEFAULT '0',
  `profession` varchar(30) NOT NULL DEFAULT '',
  `education` varchar(30) NOT NULL DEFAULT '',
  `address` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(60) NOT NULL DEFAULT '',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `status_change_time` int(11) NOT NULL DEFAULT '0',
  `askable` tinyint(1) NOT NULL DEFAULT '0',
  `log` text NOT NULL,
  `solve_time` int(11) NOT NULL DEFAULT '0',
  `solve_uid` int(11) NOT NULL DEFAULT '0',
  `solve_department` int(11) NOT NULL DEFAULT '0',
  `solve_name` varchar(30) NOT NULL,
  `comment` int(1) NOT NULL DEFAULT '0',
  `comment_time` int(11) NOT NULL DEFAULT '0',
  `finish_time` int(11) NOT NULL DEFAULT '0',
  `finish_name` varchar(30) NOT NULL DEFAULT '',
  `fengfa` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `create_time` (`create_time`),
  KEY `department` (`site`,`department`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_letter_type`;
CREATE TABLE `p8_sites_letter_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `site` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(30) NOT NULL DEFAULT '',
  `num` int(11) NOT NULL DEFAULT '0',
  `desc` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `site` (`site`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_log`;
CREATE TABLE `p8_sites_log` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `site` char(50) NOT NULL DEFAULT '',
  `username` char(30) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `request` text NOT NULL,
  `ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
/*!50100 PARTITION BY KEY ()
PARTITIONS 10 */;

DROP TABLE IF EXISTS `p8_sites_member`;
CREATE TABLE `p8_sites_member` (
  `id` mediumint(8) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '',
  `role_id` smallint(5) unsigned NOT NULL,
  `item_count` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `role_id` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_menu`;
CREATE TABLE `p8_sites_menu` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `site` char(50) NOT NULL DEFAULT '',
  `action` char(50) NOT NULL DEFAULT '',
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `color` char(7) NOT NULL DEFAULT '',
  `name` char(30) NOT NULL DEFAULT '',
  `url` char(255) NOT NULL DEFAULT '',
  `dynamic_url` char(255) NOT NULL DEFAULT '',
  `target` char(10) NOT NULL DEFAULT '',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `front` tinyint(1) NOT NULL DEFAULT '0',
  `display_order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `summary` text NOT NULL,
  `frame` char(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_model`;
CREATE TABLE `p8_sites_model` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL DEFAULT '',
  `alias` char(30) NOT NULL DEFAULT '',
  `site` varchar(50) NOT NULL DEFAULT '',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `display_order` tinyint(2) NOT NULL DEFAULT '0',
  `config` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_model_field`;
CREATE TABLE `p8_sites_model_field` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(30) NOT NULL DEFAULT '',
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL DEFAULT '',
  `alias` varchar(50) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT '',
  `list_table` tinyint(1) NOT NULL DEFAULT '0',
  `filterable` tinyint(1) NOT NULL DEFAULT '0',
  `orderby` tinyint(1) NOT NULL DEFAULT '0',
  `not_null` tinyint(1) unsigned NOT NULL,
  `length` varchar(10) NOT NULL DEFAULT '',
  `is_unsigned` tinyint(1) unsigned NOT NULL,
  `editable` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `default_value` text NOT NULL,
  `data` text NOT NULL,
  `config` text NOT NULL,
  `widget` varchar(50) NOT NULL DEFAULT '',
  `widget_addon_attr` varchar(255) NOT NULL DEFAULT '',
  `display_order` tinyint(3) unsigned NOT NULL,
  `units` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`model`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_site`;
CREATE TABLE `p8_sites_site` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parent` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sitename` varchar(20) NOT NULL DEFAULT '',
  `alias` varchar(100) NOT NULL DEFAULT '',
  `ip` varchar(255) NOT NULL DEFAULT '',
  `point` varchar(10) NOT NULL DEFAULT '',
  `domain` varchar(255) NOT NULL DEFAULT '',
  `ipordomain` tinyint(1) NOT NULL DEFAULT '0',
  `manager` varchar(255) NOT NULL DEFAULT '',
  `manager_role` varchar(255) NOT NULL DEFAULT '',
  `poster` varchar(255) NOT NULL DEFAULT '',
  `display` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0',
  `template` varchar(100) NOT NULL DEFAULT '',
  `lock` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `update` int(10) unsigned NOT NULL DEFAULT '0',
  `config` text NOT NULL,
  `data1` text NOT NULL,
  `data2` text NOT NULL,
  `data3` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_site_recycle`;
CREATE TABLE `p8_sites_site_recycle` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parent` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sitename` varchar(20) NOT NULL DEFAULT '',
  `alias` varchar(100) NOT NULL DEFAULT '',
  `ip` varchar(255) NOT NULL DEFAULT '',
  `point` varchar(10) NOT NULL DEFAULT '',
  `domain` varchar(255) NOT NULL DEFAULT '',
  `ipordomain` tinyint(1) NOT NULL DEFAULT '0',
  `manager` varchar(255) NOT NULL DEFAULT '',
  `manager_role` varchar(255) NOT NULL DEFAULT '',
  `poster` varchar(255) NOT NULL DEFAULT '',
  `display` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0',
  `template` varchar(100) NOT NULL DEFAULT '',
  `lock` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `update` int(10) unsigned NOT NULL DEFAULT '0',
  `config` text NOT NULL,
  `data1` text NOT NULL,
  `data2` text NOT NULL,
  `data3` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_stop_category`;
CREATE TABLE `p8_sites_stop_category` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parent` smallint(5) unsigned NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `item_count` mediumint(8) unsigned NOT NULL,
  `display_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_stop_data`;
CREATE TABLE `p8_sites_stop_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` mediumint(10) unsigned NOT NULL DEFAULT '0',
  `cname` char(50) NOT NULL DEFAULT '',
  `site` varchar(255) NOT NULL DEFAULT '',
  `item_id` int(5) unsigned NOT NULL DEFAULT '0',
  `sc` char(1) NOT NULL DEFAULT '',
  `model` char(30) NOT NULL DEFAULT '',
  `model_alias` char(30) NOT NULL DEFAULT '',
  `title` char(100) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `data` mediumtext NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `site_status` text NOT NULL,
  `new_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
REPLACE INTO `p8_config` VALUES ('sites','','string','sit_manager_role','116');
REPLACE INTO `p8_config` VALUES ('sites','','string','template','default');
REPLACE INTO `p8_config` VALUES ('sites','','serialize','_hook_modules','a:1:{s:4:\"item\";a:2:{s:5:\"sites\";a:1:{s:8:\"category\";s:3:\"cid\";}s:4:\"core\";a:1:{s:6:\"member\";s:3:\"uid\";}}}');
REPLACE INTO `p8_config` VALUES ('sites','','serialize','hook_modules','a:2:{s:8:\"category\";a:1:{s:5:\"sites\";a:1:{s:4:\"item\";s:3:\"cid\";}}s:4:\"item\";a:1:{s:4:\"core\";a:1:{s:8:\"uploader\";s:7:\"item_id\";}}}');
REPLACE INTO `p8_config` VALUES ('sites','item','string','dynamic_list_url_rule','{$module_controller}-list-category-{$id}#-page-{$page}#.html');
REPLACE INTO `p8_config` VALUES ('sites','item','string','dynamic_view_url_rule','{$module_controller}-view-id-{$id}#-page-{$page}#.html');
REPLACE INTO `p8_config` VALUES ('sites','item','string','dynamic_homepage_list_url_rule','{$URL}#-page-{$page}#.html');
REPLACE INTO `p8_config` VALUES ('sites','item','string','list_page_cacle_ttl','0');
REPLACE INTO `p8_config` VALUES ('sites','item','string','view_page_cacle_ttl','0');
REPLACE INTO `p8_config` VALUES ('sites','item','string','allow_comment','1');
REPLACE INTO `p8_config` VALUES ('sites','item','string','allow_mood','1');
REPLACE INTO `p8_config` VALUES ('sites','item','string','list_navigagion','nav_list02');
REPLACE INTO `p8_config` VALUES ('sites','item','string','allow_digg','1');
REPLACE INTO `p8_config` VALUES ('sites','item','string','first_img_to_frame','1');
REPLACE INTO `p8_config` VALUES ('sites','item','serialize','comment','a:4:{s:7:\"enabled\";i:1;s:14:\"require_verify\";i:0;s:9:\"page_size\";i:20;s:14:\"view_page_size\";i:5;}');
REPLACE INTO `p8_config` VALUES ('sites','item','serialize','sphinx','a:3:{s:7:\"enabled\";i:0;s:4:\"host\";s:9:\"localhost\";s:4:\"port\";i:3312;}');
REPLACE INTO `p8_config` VALUES ('sites','item','string','template','default');
REPLACE INTO `p8_config` VALUES ('sites','item','string','htmlize','0');
REPLACE INTO `p8_config` VALUES ('sites','item','serialize','verify_acl','a:5:{i:2;a:2:{s:4:\"name\";N;s:4:\"role\";a:0:{}}i:1;a:2:{s:4:\"name\";s:6:\"终审\";s:4:\"role\";a:0:{}}i:0;a:2:{s:4:\"name\";s:12:\"取消审核\";s:4:\"role\";a:0:{}}i:88;a:2:{s:4:\"name\";s:9:\"回收站\";s:4:\"role\";a:0:{}}i:-99;a:2:{s:4:\"name\";s:6:\"退稿\";s:4:\"role\";a:0:{}}}');
REPLACE INTO `p8_config` VALUES ('sites','stop','string','template','default');
REPLACE INTO `p8_config` VALUES ('sites','letter','string','hong','7');
REPLACE INTO `p8_config` VALUES ('sites','letter','string','huan','3');
REPLACE INTO `p8_config` VALUES ('sites','letter','string','undisplay','0');
REPLACE INTO `p8_config` VALUES ('sites','letter','string','template','group7_blue');
REPLACE INTO `p8_config` VALUES ('sites','','string','mobile_template','mobile/group');
REPLACE INTO `p8_config` VALUES ('sites','','string','table_prefix','');
REPLACE INTO `p8_config` VALUES ('sites','item','string','mobile_template','mobile/group');
REPLACE INTO `p8_config` VALUES ('sites','letter','string','mobile_template','mobile/group');
REPLACE INTO `p8_config` VALUES ('sites','stop','string','mobile_template','mobile/group');
REPLACE INTO `p8_sites_item` VALUES ('5148','article','华为基于5G商用网络与折叠手机，重定义视频体验','','0','','qy3','11366','<!--#p8_attach#-->/cms/item/2019_02/26_15/ae0544d6f30a810f.jpg','','1','','','admin','6','在2019世界移动大会前夕，华为在巴塞罗那举办主题为“构建万物互联的智能世界”的华为Day0论坛。在“5G is ON”分论坛上，基于西班牙沃达丰与华为联合部署的5G商用网络，华为常务董事、运营商BG总裁丁耘使用5G折叠屏智能手机演示了4K超高清视频点播','1','','11','0','','0','1551110400','','1551166674','1551167381','1551110400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5228','article','劳动节活','','0','','school02','11642','<!--#p8_attach#-->/sites/item/2017_09/29_09/94746ccf1a065e04.png','','1','','','admin','6','','1','','0','0','','0','1506614400','','1563243840','1563243840','1506614400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5234','article','厂房设备1','','0','','school02','11644','<!--#p8_attach#-->/sites/item/2017_09/29_09/6bce5b714dc924fe.jpg','','1','','','admin','6','&nbsp;','1','','0','0','','0','1504195200','','1563243840','1563243840','1504195200','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5236','article','兰州石化化工污水处理装置升级','','0','','school02','11646','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','0','0','','0','1506614400','','1563243840','1563243840','1506614400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5240','article','宝石机械公司自主研制首套低温钻机驶向北极','','0','','school02','11646','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','0','0','','0','1506528000','','1563243840','1563243840','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5282','zhaopin','Java开发工程师','','0','','school02','11669','','','1','','','admin','','&nbsp;Java开发工程师Java开发工程师Java开发工程师Java开发工程师Java开发工程师Java开发工程师Java开发工程师Java开发工程师Java开发工程师','1','','0','0','','0','1505747655','','1563243840','1563243840','1505747655','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5288','jianyi','','','0','','school02','11674','','','1','','','admin','','内容内容内容内容内容内容内容内容内容内容','1','','0','0','','0','1505662124','','1563243840','1563243840','1505662124','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5290','jianyi','23423','','0','','school02','11674','','','1','','','admin','','23423','1','','0','0','','0','1505662437','','1563243840','1563243840','1505662437','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5154','article','劳动光荣2014','','0','','english','11562','<!--#p8_attach#-->/sites/item/2017_09/29_09/334f6519e6fb0b5e.png','','15','','','admin','6','','1','','0','0','','0','1504540800','','1551425565','1551425565','1504540800','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5166','article','煤层气公司：打造物资装备共享模','','0','','english','11566','http://center.cnpc.com.cn/pic/0/00/09/25/92531_100606.jpg','','15','[db:发布人]','','admin','6','　　从十八大以来，我国经济进入新常态，正从&ldquo;中国制','1','','0','0','','0','1506528000','','1551425565','1551425565','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5176','article','东方物探积极创新开启电商采购新模式','','0','','english','11566','','','15','[db:发布人]','','admin','','　　中国石油网消','1','','0','0','','0','1506528000','','1551425565','1551425565','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5196','product','产品投放','','0','','english','11572','<!--#p8_attach#-->/sites/item/2017_09/07_14/8a2453289d0831c9.jpg.thumb.jpg','','15','','','admin','6','面向分组传送的新一代多业务平台，围绕SuperSmart、Soft，Slicing核心理念，秉承MPLS-TP管道思想，构建超宽、智能、开放的端到端的承载网，满足未来多网络业务融合承载、高带宽、差异化质量保障需求、灵活开放，高效协同的SDN架构，帮助企业客户构建最佳网络承助企业客','1','','0','0','','0','1504764342','','1551425565','1551425565','1504764342','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5202','product','视频直博服务','','0','','english','11574','<!--#p8_attach#-->/sites/item/2017_10/10_11/8916d64f2eb9f3ec.jpg.thumb.jpg','','15','','','admin','6','频服务器主打安防行业视频直播,数字景区直播、视频农场、视频商','1','','0','0','','0','1507605136','','1551425565','1551425565','1507605136','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5204','product','视频直播','','0','','english','11574','<!--#p8_attach#-->/sites/item/2017_10/10_11/8b20eb7d648ae862.jpg.thumb.jpg','','15','','','admin','6','一键视频语音呼叫报警、园区安全和消防预警一体化视频联动系统','1','','0','0','','0','1507605526','','1551425565','1551425565','1507605526','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5208','zhaopin','PHP工程','','0','','english','11589','','','15','','','admin','','1、承担Web应用模块的设','1','','0','0','','0','1505664000','','1551425565','1551425565','1505664000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5216','jianyi','','','0','','english','11594','','','15','','','admin','','内容内容内容内容内容内容内容内容内容内容','1','','0','0','','0','1505662124','','1551425565','1551425565','1505662124','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4668','article','煤层气公司：打造物资装备共享模','','0','','qy1','11286','http://center.cnpc.com.cn/pic/0/00/09/25/92531_100606.jpg','','1','[db:发布人]','','admin','6','　　从十八大以来，我国经济进入新常态，正从&ldquo;中国制','1','','5','0','','0','1506528000','','1539041723','1539041723','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4682','article','国务院国资委部署中央企业近期重点工作','','0','','qy1','11287','','','1','[db:发布人]','','admin','','　　中国石油网消息（记者李丹）9','1','','6','0','','0','1505836800','','1539041723','1539041723','1505836800','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4694','product','睡袋','','0','','qy1','11293','<!--#p8_attach#-->/sites/item/2017_09/29_11/54585a25d313cb61.png','','1','','','admin','6','轻量，拒水，保暖','1','','0','0','','0','1506655703','','1539041723','1539041723','1506655703','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4696','article','工商银行','','0','','qy1','11306','<!--#p8_attach#-->/sites/item/2017_09/18_07/39581594935e4eed.jpg','','1','','','admin','6','&nbsp;工商银行','1','','0','0','','0','1505691626','','1539041723','1539041723','1505691626','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4714','article','刘冲先生（非执行董事','','0','','qy1','11277','<!--#p8_attach#-->/sites/item/2017_08/31_17/6f02b081703fd3f3.jpg','','1','','','admin','6','1970年出生','1','','10','0','','0','1504170460','','1539041723','1539041723','1504170460','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4726','product','演出舞台烟机','','0','','qy1','11292','<!--#p8_attach#-->/sites/item/2017_09/14_15/b93750be32f42d60.png','','1','','','admin','6','用于多类型舞台效果渲染，有很多不同的样式','1','','0','0','','0','1505373262','','1539041723','1539041723','1505373262','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4728','product','视频直博服务','','0','','qy1','11294','<!--#p8_attach#-->/sites/item/2017_10/10_11/8916d64f2eb9f3ec.jpg.thumb.jpg','','1','','','admin','6','频服务器主打安防行业视频直播,数字景区直播、视频农场、视频商','1','','0','0','','0','1507605136','','1539041723','1539041723','1507605136','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4734','article','活动2016','','0','','qy2','11322','<!--#p8_attach#-->/sites/item/2017_09/29_09/a86558591db7cadd.png','','1','','','admin','6','','1','','7','0','','0','1506649775','','1539073485','1539073485','1506649775','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4742','article','兰州石化化工污水处理装置升级','','0','','qy2','11326','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','4','0','','0','1506614400','','1539073485','1539073485','1506614400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4744','article','煤层气公司：打造物资装备共享模','','0','','qy2','11326','http://center.cnpc.com.cn/pic/0/00/09/25/92531_100606.jpg','','1','[db:发布人]','','admin','6','　　从十八大以来，我国经济进入新常态，正从&ldquo;中国制','1','','3','0','','0','1506528000','','1539073485','1539073485','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4748','article','宝鸡钢管公司成焊工序实现远程实时自动控制','','0','','qy2','11326','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','6','0','','0','1506528000','','1539073485','1539073485','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4752','article','宝鸡钢管863重要课题顺利通过国家验收','','0','','qy2','11326','http://news.cnpc.com.cn/epaper/zgsyb/2017\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\20170928\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\image\\\\\\\\\\\\\\\\\\\\\\\\\\\\','','1','[db:发布人]','','admin','6','　　中国石油网消','1','','4','0','','0','1506528000','','1539073485','1539073485','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4754','article','东方物探积极创新开启电商采购新模式','','0','','qy2','11326','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','2','0','','0','1506528000','','1539073485','1539073485','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4764','article','我国天然气管道应用技术领跑国','','0','','qy2','11327','','','1','[db:发布人]','','admin','','　　中国石油网消息（记者蒋万全 通讯员张对红 郭志梅）9','1','','2','0','','0','1504713600','','1539073485','1539073485','1504713600','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4774','product','野营帐篷','','0','','qy2','11332','<!--#p8_attach#-->/sites/item/2017_09/29_11/59e16fb016e90bfc.png','','1','','','admin','6','帐篷真的好！','1','','0','0','','0','1506614400','','1539073485','1539073485','1506614400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4786','zhaopin','Java开发工程师','','0','','qy2','11349','','','1','','','admin','','&nbsp;Java开发工程师Java开发工程师Java开发工程师Java开发工程师Java开发工程师Java开发工程师Java开发工程师Java开发工程师Java开发工程师','1','','0','0','','0','1505747655','','1539073485','1539073485','1505747655','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4869','article','劳动节活','','0','','qy4','11402','<!--#p8_attach#-->/sites/item/2017_09/29_09/94746ccf1a065e04.png','','1','','','admin','6','','1','','7','0','','0','1506614400','','1539073698','1539073698','1506614400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4870','article','活动2016','','0','','qy4','11402','<!--#p8_attach#-->/sites/item/2017_09/29_09/a86558591db7cadd.png','','1','','','admin','6','','1','','10','0','','0','1506649775','','1539073698','1539073698','1506649775','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4871','article','活动2017','','0','','qy4','11402','<!--#p8_attach#-->/sites/item/2017_09/29_09/4c5546d7b1b3090d.png','','1','','','admin','6','','1','','7','0','','0','1506649816','','1539073698','1539073698','1506649816','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4877','article','厂房设备2','','0','','qy4','11404','<!--#p8_attach#-->/sites/item/2017_09/01_14/5f7f727c4499a829.JPG','','1','','','admin','6','','1','','10','0','','0','1504195200','','1539073698','1539073698','1504195200','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4881','article','中国石油装备管理渐入佳境扫描','','0','','qy4','11406','','','1','[db:发布人]','','admin','','　　2016年年底，集团公司进行总部机关职能优化与机构改革，赋予物资装备部装备管理相关职能。　　9个多月来，物资装备部坚决贯彻落实集团公司党组的正确决策、集团公司年度工作会议精神和年中领导干部会议精神，认真履行装备管理职能，深入企业现场调研，组织专业分','1','','5','0','','0','1506528000','','1539073698','1539073698','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4883','article','渤海装备华油钢管公司力破市场寒冬扭亏为盈','','0','','qy4','11406','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','6','0','','0','1506528000','','1539073698','1539073698','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4885','article','新疆克拉玛依','','0','','qy4','11406','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','7','0','','0','1506528000','','1539073698','1539073698','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4887','article','扬州钢管超大口径螺旋埋弧焊管试制成功','','0','','qy4','11406','http://news.cnpc.com.cn/epaper/zgsyb/2017\\\\\\\\20170928\\\\\\\\image\\\\\\\\0244401006.jpeg','','1','[db:发布人]','','admin','6','　　中国石油网消','1','','10','0','','0','1506528000','','1539073698','1539073698','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4889','article','渤海钻探：呵护利器打造深井第一','','0','','qy4','11406','','','1','[db:发布人]','','admin','','　　打造深井复杂结构井第一军，是渤海钻探的追求和奋斗目标之一。记','1','','8','0','','0','1506528000','','1539073698','1539073698','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4900','article','我国天然气管道应用技术领跑国','','0','','qy4','11407','','','1','[db:发布人]','','admin','','　　中国石油网消息（记者蒋万全 通讯员张对红 郭志梅）9','1','','5','0','','0','1504713600','','1539073698','1539073698','1504713600','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4904','article','领导一行到中国中铁广东地区单位和项目调','','0','','qy4','11408','<!--#p8_attach#-->/sites/item/2017_09/29_16/daf5c2ff37f484b6.jpg','','1','','','admin','6','11','1','','14','0','','0','1482076800','','1539073698','1539073698','1482076800','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4909','product','演出舞台烟机','','0','','qy4','11412','<!--#p8_attach#-->/sites/item/2017_09/14_15/b93750be32f42d60.png','','1','','','admin','6','用于多类型舞台效果渲染，有很多不同的样式','1','','0','0','','0','1505373262','','1539073698','1539073698','1505373262','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4919','zhaopin','IT工程','','0','','qy4','11429','','','1','','','admin','','待会文档说明','1','','11','0','','0','1505664000','','1539073698','1539073698','1505664000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4927','down','下载测试','','0','','qy4','11433','','','1','','','admin','','&nbsp;233342','1','','7','0','','0','1505538893','','1539073698','1539073698','1505538893','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4935','article','刘冲先生（非执行董事','','0','','qy5','11437','<!--#p8_attach#-->/sites/item/2017_08/31_17/6f02b081703fd3f3.jpg','','1','','','admin','6','1970年出生','1','','4','0','','0','1504170460','','1539074307','1539074307','1504170460','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4938','article','活动2016','','0','','qy5','11442','<!--#p8_attach#-->/sites/item/2017_09/29_09/a86558591db7cadd.png','','1','','','admin','6','','1','','7','0','','0','1506649775','','1539074307','1539074307','1506649775','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4943','article','荣誉资质3','','0','','qy5','11443','<!--#p8_attach#-->/sites/item/2017_09/16_08/516ec0ffe9864446.jpg','','1','','','admin','6','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&am','1','','4','0','','0','1505491200','','1539074307','1539074307','1505491200','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4944','article','厂房设备1','','0','','qy5','11444','<!--#p8_attach#-->/sites/item/2017_09/29_09/6bce5b714dc924fe.jpg','','1','','','admin','6','&nbsp;','1','','3','0','','0','1504195200','','1539074307','1539074307','1504195200','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4946','article','兰州石化化工污水处理装置升级','','0','','qy5','11446','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','3','0','','0','1506614400','','1539074307','1539074307','1506614400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4953','article','新疆克拉玛依','','0','','qy5','11446','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','8','0','','0','1506528000','','1539074307','1539074307','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4954','article','中国石油持续提升物资装备与招标管理工作水','','0','','qy5','11446','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','4','0','','0','1506528000','','1539074307','1539074307','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4967','article','王宜林赴福建、江西石油销售企业调','','0','','qy5','11447','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','2','0','','0','1504713600','','1539074307','1539074307','1504713600','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4970','article','东北管网安全改造圆满收','','0','','qy5','11447','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','2','0','','0','1504454400','','1539074307','1539074307','1504454400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4975','product','产品3','','0','','qy5','11451','<!--#p8_attach#-->/sites/item/2017_09/14_14/d64eadefbeaf0459.jpg','','1','','','admin','6','我公司生产各种各类滚针轴承，包括支承滚轮.曲线滚轮（螺栓性滚轮滚针轴承）','1','','0','0','','0','1505372362','','1539074307','1539074307','1505372362','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4976','product','产品投放','','0','','qy5','11452','<!--#p8_attach#-->/sites/item/2017_09/07_14/8a2453289d0831c9.jpg.thumb.jpg','','1','','','admin','6','面向分组传送的新一代多业务平台，围绕SuperSmart、Soft，Slicing核心理念，秉承MPLS-TP管道思想，构建超宽、智能、开放的端到端的承载网，满足未来多网络业务融合承载、高带宽、差异化质量保障需求、灵活开放，高效协同的SDN架构，帮助企业客户构建最佳网络承助企业客','1','','0','0','','0','1504764342','','1539074307','1539074307','1504764342','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4978','product','野营帐篷','','0','','qy5','11452','<!--#p8_attach#-->/sites/item/2017_09/29_11/59e16fb016e90bfc.png','','1','','','admin','6','帐篷真的好！','1','','0','0','','0','1506614400','','1539074307','1539074307','1506614400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4985','article','工商银行','','0','','qy5','11466','<!--#p8_attach#-->/sites/item/2017_09/18_07/39581594935e4eed.jpg','','1','','','admin','6','&nbsp;工商银行','1','','0','0','','0','1505691626','','1539074307','1539074307','1505691626','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4986','article','交通银','','0','','qy5','11466','<!--#p8_attach#-->/sites/item/2017_09/18_07/59c44bd1aca22d30.jpg','','1','','','admin','6','&nbsp;交通银','1','','0','0','','0','1505691650','','1539074307','1539074307','1505691650','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4995','down','下载测试','','0','','qy5','11473','','','1','','','admin','','&nbsp;233342','1','','1','0','','0','1505538893','','1539074307','1539074307','1505538893','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4997','jianyi','姓名姓名姓名','','0','','qy5','11474','','','1','','','admin','','议内议内议内议内议内议内议内议内议内议内议内议内议内议内议内','1','','0','0','','0','1505662366','','1539074307','1539074307','1505662366','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5009','article','荣誉','','0','','qy6','11483','<!--#p8_attach#-->/sites/item/2017_09/16_08/f0b2bc7b048f6bee.jpg','','1','','','admin','6','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&','1','','0','0','','0','1505318400','','1539076441','1539076441','1505318400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5012','article','厂房设备1','','0','','qy6','11484','<!--#p8_attach#-->/sites/item/2017_09/29_09/6bce5b714dc924fe.jpg','','1','','','admin','6','&nbsp;','1','','9','0','','0','1504195200','','1539076441','1539076441','1504195200','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5013','article','厂房设备2','','0','','qy6','11484','<!--#p8_attach#-->/sites/item/2017_09/01_14/5f7f727c4499a829.JPG','','1','','','admin','6','','1','','8','0','','0','1504195200','','1539076441','1539076441','1504195200','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5015','article','吉林松原采气厂打造低效油田开发样板纪','','0','','qy6','11486','','','1','[db:发布人]','','admin','','　　截至9','1','','4','0','','0','1506614400','','1539076441','1539076441','1506614400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5016','article','煤层气公司：打造物资装备共享模','','0','','qy6','11486','http://center.cnpc.com.cn/pic/0/00/09/25/92531_100606.jpg','','1','[db:发布人]','','admin','6','　　从十八大以来，我国经济进入新常态，正从&ldquo;中国制','1','','2','0','','0','1506528000','','1539076441','1539076441','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5018','article','宝石机械公司自主研制首套低温钻机驶向北极','','0','','qy6','11486','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','2','0','','0','1506528000','','1539076441','1539076441','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5021','article','新疆克拉玛依','','0','','qy6','11486','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','3','0','','0','1506528000','','1539076441','1539076441','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5025','article','渤海钻探：呵护利器打造深井第一','','0','','qy6','11486','','','1','[db:发布人]','','admin','','　　打造深井复杂结构井第一军，是渤海钻探的追求和奋斗目标之一。记','1','','5','0','','0','1506528000','','1539076441','1539076441','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5036','article','我国天然气管道应用技术领跑国','','0','','qy6','11487','','','1','[db:发布人]','','admin','','　　中国石油网消息（记者蒋万全 通讯员张对红 郭志梅）9','1','','3','0','','0','1504713600','','1539076441','1539076441','1504713600','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5040','article','领导一行到中国中铁广东地区单位和项目调','','0','','qy6','11488','<!--#p8_attach#-->/sites/item/2017_09/29_16/daf5c2ff37f484b6.jpg','','1','','','admin','6','11','1','','4','0','','0','1482076800','','1539076441','1539076441','1482076800','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5043','product','产品3','','0','','qy6','11491','<!--#p8_attach#-->/sites/item/2017_09/14_14/d64eadefbeaf0459.jpg','','1','','','admin','6','我公司生产各种各类滚针轴承，包括支承滚轮.曲线滚轮（螺栓性滚轮滚针轴承）','1','','0','0','','0','1505372362','','1539076441','1539076441','1505372362','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5050','product','视频直博服务','','0','','qy6','11494','<!--#p8_attach#-->/sites/item/2017_10/10_11/8916d64f2eb9f3ec.jpg.thumb.jpg','','1','','','admin','6','频服务器主打安防行业视频直播,数字景区直播、视频农场、视频商','1','','0','0','','0','1507605136','','1539076441','1539076441','1507605136','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5053','article','工商银行','','0','','qy6','11506','<!--#p8_attach#-->/sites/item/2017_09/07_14/8a2453289d0831c9.jpg','','1','','','admin','6',' 工商银行','1','','8','0','','0','1505664000','','1539076441','1551175844','1505664000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5054','article','交通银','','0','','qy6','11506','<!--#p8_attach#-->/sites/item/2017_09/18_07/59c44bd1aca22d30.jpg','','1','','','admin','6','&nbsp;交通银','1','','3','0','','0','1505691650','','1539076441','1539076441','1505691650','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5074','article','活动2016','','0','','qy7','11522','<!--#p8_attach#-->/sites/item/2017_09/29_09/a86558591db7cadd.png','','1','','','admin','6','','1','','16','0','','0','1506649775','','1539077272','1539077272','1506649775','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5075','article','活动2017','','0','','qy7','11522','<!--#p8_attach#-->/sites/item/2017_09/29_09/4c5546d7b1b3090d.png','','1','','','admin','6','','1','','15','0','','0','1506649816','','1539077272','1539077272','1506649816','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5076','article','活动2014','','0','','qy7','11521','<!--#p8_attach#-->/sites/item/2017_09/29_09/02d11fab81d52693.png','','1','','','admin','6','','1','','14','0','','0','1506649885','','1539077272','1539077272','1506649885','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5077','article','荣誉','','0','','qy7','11523','<!--#p8_attach#-->/sites/item/2017_09/16_08/f0b2bc7b048f6bee.jpg','','1','','','admin','6','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&','1','','1','0','','0','1505318400','','1539077272','1539077272','1505318400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5079','article','荣誉资质3','','0','','qy7','11523','<!--#p8_attach#-->/sites/item/2017_09/16_08/516ec0ffe9864446.jpg','','1','','','admin','6','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&am','1','','1','0','','0','1505491200','','1539077272','1539077272','1505491200','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5080','article','厂房设备1','','0','','qy7','11524','<!--#p8_attach#-->/sites/item/2017_09/29_09/6bce5b714dc924fe.jpg','','1','','','admin','6','&nbsp;','1','','7','0','','0','1504195200','','1539077272','1539077272','1504195200','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5084','article','煤层气公司：打造物资装备共享模','','0','','qy7','11526','http://center.cnpc.com.cn/pic/0/00/09/25/92531_100606.jpg','','1','[db:发布人]','','admin','6','　　从十八大以来，我国经济进入新常态，正从&ldquo;中国制','1','','8','0','','0','1506528000','','1539077272','1539077272','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5085','article','中国石油装备管理渐入佳境扫描','','0','','qy7','11526','','','1','[db:发布人]','','admin','','　　2016年年底，集团公司进行总部机关职能优化与机构改革，赋予物资装备部装备管理相关职能。　　9个多月来，物资装备部坚决贯彻落实集团公司党组的正确决策、集团公司年度工作会议精神和年中领导干部会议精神，认真履行装备管理职能，深入企业现场调研，组织专业分','1','','4','0','','0','1506528000','','1539077272','1539077272','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5087','article','渤海装备华油钢管公司力破市场寒冬扭亏为盈','','0','','qy7','11526','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','2','0','','0','1506528000','','1539077272','1539077272','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5106','article','东北管网安全改造圆满收','','0','','qy7','11527','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','1','0','','0','1504454400','','1539077272','1539077272','1504454400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5107','article','中国石油集团2017年“质量月”活动全面启','','0','','qy7','11527','','','1','[db:发布人]','','admin','','　　中国石油网消息（记者王','1','','2','0','','0','1504195200','','1539077272','1539077272','1504195200','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5108','article','领导一行到中国中铁广东地区单位和项目调','','0','','qy7','11528','<!--#p8_attach#-->/sites/item/2017_09/29_16/daf5c2ff37f484b6.jpg','','1','','','admin','6','11','1','','10','0','','0','1482076800','','1539077272','1539077272','1482076800','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5109','product','产品1','','0','','qy7','11531','<!--#p8_attach#-->/sites/item/2017_09/04_11/8b68845fe76c8caa.jpg.thumb.jpg','','1','','','admin','6','连接方式：快速卡口连接； 接触件形式：压接式； ','1','','0','0','','0','1504496996','','1539077272','1539077272','1504496996','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5112','product','产品投放','','0','','qy7','11532','<!--#p8_attach#-->/sites/item/2017_09/07_14/8a2453289d0831c9.jpg.thumb.jpg','','1','','','admin','6','面向分组传送的新一代多业务平台，围绕SuperSmart、Soft，Slicing核心理念，秉承MPLS-TP管道思想，构建超宽、智能、开放的端到端的承载网，满足未来多网络业务融合承载、高带宽、差异化质量保障需求、灵活开放，高效协同的SDN架构，帮助企业客户构建最佳网络承助企业客','1','','0','0','','0','1504764342','','1539077272','1539077272','1504764342','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5116','product','睡袋','','0','','qy7','11533','<!--#p8_attach#-->/sites/item/2017_09/29_11/54585a25d313cb61.png','','1','','','admin','6','轻量，拒水，保暖','1','','0','0','','0','1506655703','','1539077272','1539077272','1506655703','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5117','product','手电','','0','','qy7','11533','<!--#p8_attach#-->/sites/item/2017_09/29_11/fc6b716b836c3328.png','','1','','','admin','6','耐摔，耐打','1','','0','0','','0','1506614400','','1539077272','1539077272','1506614400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5122','article','交通银','','0','','qy7','11546','<!--#p8_attach#-->/sites/item/2017_09/18_07/59c44bd1aca22d30.jpg','','1','','','admin','6','&nbsp;交通银','1','','0','0','','0','1505691650','','1539077272','1539077272','1505691650','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5147','article','华为基于5G商用网络与折叠手机，重定义视频体验','','0','','qy2','11326','<!--#p8_attach#-->/cms/item/2019_02/26_15/ae0544d6f30a810f.jpg','','1','','','admin','6','在2019世界移动大会前夕，华为在巴塞罗那举办主题为&ldquo;构建万物互联的智能世界&rdquo;的华为Day0论坛。在&ldquo;5G is ON&rdquo;分论坛上，基于西班牙沃达丰与华为联合部署的5G商用网络，华为常务董事、运营商BG总裁丁耘使用5G折叠屏智能手机演示了4K超高清视频点播','1','','12','0','','0','1551166599','','1551166674','1551166674','1551166599','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5153','article','刘冲先生（非执行董事','','0','','english','11557','<!--#p8_attach#-->/sites/item/2017_08/31_17/6f02b081703fd3f3.jpg','','15','','','admin','6','1970年出生','1','','0','0','','0','1504170460','','1551425565','1551425565','1504170460','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5195','product','产品3','','0','','english','11571','<!--#p8_attach#-->/sites/item/2017_09/14_14/d64eadefbeaf0459.jpg','','15','','','admin','6','我公司生产各种各类滚针轴承，包括支承滚轮.曲线滚轮（螺栓性滚轮滚针轴承）','1','','0','0','','0','1505372362','','1551425565','1551425565','1505372362','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5207','zhaopin','IT工程','','0','','english','11589','','','15','','','admin','','待会文档说明','1','','0','0','','0','1505664000','','1551425565','1551425565','1505664000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5227','article','劳动光荣2014','','0','','school02','11642','<!--#p8_attach#-->/sites/item/2017_09/29_09/334f6519e6fb0b5e.png','','1','','','admin','6','','1','','0','0','','0','1504540800','','1563243840','1563243840','1504540800','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5239','article','中国石油装备管理渐入佳境扫描','','0','','school02','11646','','','1','[db:发布人]','','admin','','　　2016年年底，集团公司进行总部机关职能优化与机构改革，赋予物资装备部装备管理相关职能。　　9个多月来，物资装备部坚决贯彻落实集团公司党组的正确决策、集团公司年度工作会议精神和年中领导干部会议精神，认真履行装备管理职能，深入企业现场调研，组织专业分','1','','0','0','','0','1506528000','','1563243840','1563243840','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5249','article','光明网：中葡两国元首见证中粮“卓越中心”落户葡萄牙','','0','','school02','11646','<!--#p8_attach#-->/cms/item/2019_02/26_15/7b9541f281ed57ee.jpg','','1','','','admin','6','葡萄牙当地时间12月5日，在中葡两国元首的共同见证下，中粮集团党组书记、董事长吕军和葡萄牙贸易与投资促进局局长路易斯•卡斯特罗•恩里克斯代表双方签署合作谅解备忘录。中粮集团将在葡萄牙波尔图大区设立为旗下中粮国际提供共享服务的“卓越中心&rdquo','1','','0','0','','0','1551165637','','1563243840','1563243840','1551165637','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5265','product','产品1','','0','','school02','11651','<!--#p8_attach#-->/sites/item/2017_09/04_11/8b68845fe76c8caa.jpg.thumb.jpg','','1','','','admin','6','连接方式：快速卡口连接； 接触件形式：压接式； ','1','','0','0','','0','1504496996','','1563243840','1563243840','1504496996','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5267','product','产品3','','0','','school02','11651','<!--#p8_attach#-->/sites/item/2017_09/14_14/d64eadefbeaf0459.jpg','','1','','','admin','6','我公司生产各种各类滚针轴承，包括支承滚轮.曲线滚轮（螺栓性滚轮滚针轴承）','1','','0','0','','0','1505372362','','1563243840','1563243840','1505372362','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5275','product','视频直播服务','','0','','school02','11654','<!--#p8_attach#-->/sites/item/2017_10/10_11/7623e0026796c34f.jpg.thumb.jpg','','1','','','admin','6','&ldquo;环保监控、安全督查、园区安全和消防预警一体化视频联动系统','1','','0','0','','0','1507605347','','1563243840','1563243840','1507605347','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5281','zhaopin','Java工程','','0','','school02','11669','','','1','','','admin','','&nbsp;Java工程师Java工程师Java工程师Java工程','1','','0','0','','0','1505747521','','1563243840','1563243840','1505747521','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5291','jianyi','23432','','0','','school02','11674','','','1','','','admin','','&nbsp;23423','1','','0','0','','0','1505664000','','1563243840','1563243840','1505664000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4687','article','王宜林赴福建、江西石油销售企业调','','0','','qy1','11287','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','4','0','','0','1504713600','','1539041723','1539041723','1504713600','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4691','article','中国石油集团2017年“质量月”活动全面启','','0','','qy1','11287','','','1','[db:发布人]','','admin','','　　中国石油网消息（记者王','1','','3','0','','0','1504195200','','1539041723','1539041723','1504195200','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4695','product','手电','','0','','qy1','11293','<!--#p8_attach#-->/sites/item/2017_09/29_11/fc6b716b836c3328.png','','1','','','admin','6','耐摔，耐打','1','','0','0','','0','1506614400','','1539041723','1539041723','1506614400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4719','product','产品3','','0','','qy1','11291','<!--#p8_attach#-->/sites/item/2017_09/14_14/d64eadefbeaf0459.jpg','','1','','','admin','6','我公司生产各种各类滚针轴承，包括支承滚轮.曲线滚轮（螺栓性滚轮滚针轴承）','1','','0','0','','0','1505372362','','1539041723','1539041723','1505372362','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4723','article','活动2017','','0','','qy1','11281','<!--#p8_attach#-->/sites/item/2017_09/29_09/4c5546d7b1b3090d.png','','1','','','admin','6','','1','','6','0','','0','1506649816','','1539041723','1539041723','1506649816','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4727','product','野营帐篷','','0','','qy1','11292','<!--#p8_attach#-->/sites/item/2017_09/29_11/59e16fb016e90bfc.png','','1','','','admin','6','帐篷真的好！','1','','0','0','','0','1506614400','','1539041723','1539041723','1506614400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4741','article','厂房设备2','','0','','qy2','11324','<!--#p8_attach#-->/sites/item/2017_09/01_14/5f7f727c4499a829.JPG','','1','','','admin','6','','1','','7','0','','0','1504195200','','1539073485','1539073485','1504195200','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4745','article','中国石油装备管理渐入佳境扫描','','0','','qy2','11326','','','1','[db:发布人]','','admin','','　　2016年年底，集团公司进行总部机关职能优化与机构改革，赋予物资装备部装备管理相关职能。　　9个多月来，物资装备部坚决贯彻落实集团公司党组的正确决策、集团公司年度工作会议精神和年中领导干部会议精神，认真履行装备管理职能，深入企业现场调研，组织专业分','1','','2','0','','0','1506528000','','1539073485','1539073485','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4749','article','新疆克拉玛依','','0','','qy2','11326','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','7','0','','0','1506528000','','1539073485','1539073485','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4751','article','扬州钢管超大口径螺旋埋弧焊管试制成功','','0','','qy2','11326','http://news.cnpc.com.cn/epaper/zgsyb/2017\\\\\\\\20170928\\\\\\\\image\\\\\\\\0244401006.jpeg','','1','[db:发布人]','','admin','6','　　中国石油网消','1','','2','0','','0','1506528000','','1539073485','1539073485','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4779','product','视频直播服务','','0','','qy2','11334','<!--#p8_attach#-->/sites/item/2017_10/10_11/7623e0026796c34f.jpg.thumb.jpg','','1','','','admin','6','&ldquo;环保监控、安全督查、园区安全和消防预警一体化视频联动系统','1','','0','0','','0','1507605347','','1539073485','1539073485','1507605347','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4781','article','工商银行','','0','','qy2','11346','<!--#p8_attach#-->/sites/item/2017_09/18_07/39581594935e4eed.jpg','','1','','','admin','6','&nbsp;工商银行','1','','8','0','','0','1505691626','','1539073485','1539073485','1505691626','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4818','article','中国石油持续提升物资装备与招标管理工作水','','0','','qy3','11366','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','4','0','','0','1506528000','','1539073583','1539073583','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4819','article','扬州钢管超大口径螺旋埋弧焊管试制成功','','0','','qy3','11366','http://news.cnpc.com.cn/epaper/zgsyb/2017\\\\\\\\20170928\\\\\\\\image\\\\\\\\0244401006.jpeg','','1','[db:发布人]','','admin','6','　　中国石油网消','1','','2','0','','0','1506528000','','1539073583','1539073583','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4820','article','宝鸡钢管863重要课题顺利通过国家验收','','0','','qy3','11366','http://news.cnpc.com.cn/epaper/zgsyb/2017\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\20170928\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\image\\\\\\\\\\\\\\\\\\\\\\\\\\\\','','1','[db:发布人]','','admin','6','　　中国石油网消','1','','1','0','','0','1506528000','','1539073583','1539073583','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4821','article','渤海钻探：呵护利器打造深井第一','','0','','qy3','11366','','','1','[db:发布人]','','admin','','　　打造深井复杂结构井第一军，是渤海钻探的追求和奋斗目标之一。记','1','','1','0','','0','1506528000','','1539073583','1539073583','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4831','article','王宜林赴福建、江西石油销售企业调','','0','','qy3','11367','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','2','0','','0','1504713600','','1539073583','1539073583','1504713600','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4850','article','交通银','','0','','qy3','11386','<!--#p8_attach#-->/sites/item/2017_09/18_07/59c44bd1aca22d30.jpg','','1','','','admin','6','&nbsp;交通银','1','','2','0','','0','1505691650','','1539073583','1539073583','1505691650','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4851','zhaopin','IT工程','','0','','qy3','11389','','','1','','','admin','','待会文档说明','1','','2','0','','0','1505664000','','1539073583','1539073583','1505664000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4852','zhaopin','PHP工程','','0','','qy3','11389','','','1','','','admin','','1、承担Web应用模块的设','1','','8','0','','0','1505664000','','1539073583','1539073583','1505664000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4853','zhaopin','Java工程','','0','','qy3','11389','','','1','','','admin','','&nbsp;Java工程师Java工程师Java工程师Java工程','1','','4','0','','0','1505747521','','1539073583','1539073583','1505747521','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5123','zhaopin','IT工程','','0','','qy7','11549','','','1','','','admin','','待会文档说明','1','','2','0','','0','1505664000','','1539077272','1539077272','1505664000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5129','zhaopin','淘宝美工','','0','','qy7','11549','','','1','','','admin','','&nbsp;淘宝美工淘宝美工淘宝美工淘宝美工淘宝美工淘宝美工','1','','14','0','','0','1505748740','','1539077272','1539077272','1505748740','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5133','jianyi','姓名姓名姓名','','0','','qy7','11554','','','1','','','admin','','议内议内议内议内议内议内议内议内议内议内议内议内议内议内议内','1','','0','0','','0','1505662366','','1539077272','1539077272','1505662366','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5135','jianyi','23432','','0','','qy7','11554','','','1','','','admin','','&nbsp;23423','1','','0','0','','0','1505664000','','1539077272','1539077272','1505664000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5144','article','光明网：中葡两国元首见证中粮“卓越中心”落户葡萄牙','','0','','qy6','11486','<!--#p8_attach#-->/cms/item/2019_02/26_15/7b9541f281ed57ee.jpg','','1','','','admin','6','葡萄牙当地时间12月5日，在中葡两国元首的共同见证下，中粮集团党组书记、董事长吕军和葡萄牙贸易与投资促进局局长路易斯•卡斯特罗•恩里克斯代表双方签署合作谅解备忘录。中粮集团将在葡萄牙波尔图大区设立为旗下中粮国际提供共享服务的“卓越中心&rdquo','1','','7','0','','0','1551165637','','1551166674','1551166674','1551165637','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5174','article','宝鸡钢管863重要课题顺利通过国家验收','','0','','english','11566','http://news.cnpc.com.cn/epaper/zgsyb/2017\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\20170928\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\image\\\\\\\\\\\\\\\\\\\\\\\\\\\\','','15','[db:发布人]','','admin','6','　　中国石油网消','1','','0','0','','0','1506528000','','1551425565','1551425565','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5182','article','国务院国资委部署中央企业近期重点工作','','0','','english','11567','','','15','[db:发布人]','','admin','','　　中国石油网消息（记者李丹）9','1','','0','0','','0','1505836800','','1551425565','1551425565','1505836800','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5190','article','东北管网安全改造圆满收','','0','','english','11567','','','15','[db:发布人]','','admin','','　　中国石油网消','1','','0','0','','0','1504454400','','1551425565','1551425565','1504454400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5192','article','领导一行到中国中铁广东地区单位和项目调','','0','','english','11568','<!--#p8_attach#-->/sites/item/2017_09/29_16/daf5c2ff37f484b6.jpg','','15','','','admin','6','11','1','','0','0','','0','1482076800','','1551425565','1551425565','1482076800','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5222','jianyi','4234','','0','','english','11594','','','15','','','admin','','3244','1','','0','0','','0','1518400721','','1551425565','1551425565','1518400721','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5224','article','测试推送数据到主站','','0','','qy1','11286','','','27','','','张老师','','234243234242322423sdfsdfssd','1','','21','0','','0','1557367129','','1557367129','1557367129','1557367129','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5258','article','中国石油集团金融工作会议召开','','0','','school02','11647','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','0','0','','0','1504800000','','1563243840','1563243840','1504800000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5272','product','睡袋','','0','','school02','11653','<!--#p8_attach#-->/sites/item/2017_09/29_11/54585a25d313cb61.png','','1','','','admin','6','轻量，拒水，保暖','1','','0','0','','0','1506655703','','1563243840','1563243840','1506655703','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5276','product','视频直播','','0','','school02','11654','<!--#p8_attach#-->/sites/item/2017_10/10_11/8b20eb7d648ae862.jpg.thumb.jpg','','1','','','admin','6','一键视频语音呼叫报警、园区安全和消防预警一体化视频联动系统','1','','0','0','','0','1507605526','','1563243840','1563243840','1507605526','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5280','zhaopin','PHP工程','','0','','school02','11669','','','1','','','admin','','1、承担Web应用模块的设','1','','0','0','','0','1505664000','','1563243840','1563243840','1505664000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5292','jianyi','','','0','','school02','11674','','','1','','','admin','','','1','','0','0','','0','1506351790','','1563243840','1563243840','1506351790','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4664','article','荣誉2','','0','','qy1','11283','<!--#p8_attach#-->/sites/item/2017_09/14_15/b64fe32a8d3178ba.png.thumb.jpg','','1','','','admin','6','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&','1','','0','0','','0','1505318400','','1539041723','1539041723','1505318400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4680','article','塔里木油田油气工程研究院《甲酸盐完井液技术》发','','0','','qy1','11287','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','11','0','','0','1506441600','','1539041723','1539041723','1506441600','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4686','article','中国石油集团金融工作会议召开','','0','','qy1','11287','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','3','0','','0','1504800000','','1539041723','1539041723','1504800000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4692','article','领导一行到中国中铁广东地区单位和项目调','','0','','qy1','11288','<!--#p8_attach#-->/sites/item/2017_09/29_16/daf5c2ff37f484b6.jpg','','1','','','admin','6','11','1','','9','0','','0','1482076800','','1539041723','1539041723','1482076800','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4700','zhaopin','Java工程','','0','','qy1','11309','','','1','','','admin','','&nbsp;Java工程师Java工程师Java工程师Java工程','1','','7','0','','0','1505747521','','1539041723','1539041723','1505747521','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4704','zhaopin','淘宝美工','','0','','qy1','11309','','','1','','','admin','','&nbsp;淘宝美工淘宝美工淘宝美工淘宝美工淘宝美工淘宝美工','1','','7','0','','0','1505748740','','1539041723','1539041723','1505748740','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4712','jianyi','','','0','','qy1','11314','','','1','','','admin','','','1','','0','0','','0','1507517418','','1539041723','1539041723','1507517418','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4718','product','产品2','','0','','qy1','11291','<!--#p8_attach#-->/sites/item/2017_09/14_14/01252577a4304cb3.png','','1','','','admin','6','高温齿轮泵由齿轮','1','','0','0','','0','1505371977','','1539041723','1539041723','1505371977','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4724','article','活动2014','','0','','qy1','11282','<!--#p8_attach#-->/sites/item/2017_09/29_09/02d11fab81d52693.png','','1','','','admin','6','','1','','10','0','','0','1506649885','','1539041723','1539041723','1506649885','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4732','article','劳动光荣2014','','0','','qy2','11322','<!--#p8_attach#-->/sites/item/2017_09/29_09/334f6519e6fb0b5e.png','','1','','','admin','6','','1','','2','0','','0','1504540800','','1539073485','1539073485','1504540800','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4736','article','活动2014','','0','','qy2','11321','<!--#p8_attach#-->/sites/item/2017_09/29_09/02d11fab81d52693.png','','1','','','admin','6','','1','','2','0','','0','1506649885','','1539073485','1539073485','1506649885','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4770','product','产品2','','0','','qy2','11331','<!--#p8_attach#-->/sites/item/2017_09/14_14/01252577a4304cb3.png','','1','','','admin','6','高温齿轮泵由齿轮','1','','0','0','','0','1505371977','','1539073485','1539073485','1505371977','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4776','product','睡袋','','0','','qy2','11333','<!--#p8_attach#-->/sites/item/2017_09/29_11/54585a25d313cb61.png','','1','','','admin','6','轻量，拒水，保暖','1','','0','0','','0','1506655703','','1539073485','1539073485','1506655703','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4788','zhaopin','PHP工程人才','','0','','qy2','11349','','','1','','','admin','','PHP工程人才','1','','0','0','','0','1505748490','','1539073485','1539073485','1505748490','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4804','article','活动2014','','0','','qy3','11361','<!--#p8_attach#-->/sites/item/2017_09/29_09/02d11fab81d52693.png','','1','','','admin','6','','1','','6','0','','0','1506649885','','1539073583','1539073583','1506649885','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4806','article','荣誉2','','0','','qy3','11363','<!--#p8_attach#-->/sites/item/2017_09/14_15/b64fe32a8d3178ba.png.thumb.jpg','','1','','','admin','6','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&','1','','4','0','','0','1505318400','','1539073583','1539073583','1505318400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4817','article','新疆克拉玛依','','0','','qy3','11366','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','2','0','','0','1506528000','','1539073583','1539073583','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4824','article','塔里木油田油气工程研究院《甲酸盐完井液技术》发','','0','','qy3','11367','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','36','0','','0','1506441600','','1539073583','1539073583','1506441600','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4836','article','领导一行到中国中铁广东地区单位和项目调','','0','','qy3','11368','<!--#p8_attach#-->/sites/item/2017_09/29_16/daf5c2ff37f484b6.jpg','','1','','','admin','6','11','1','','5','0','','0','1482076800','','1539073583','1539073583','1482076800','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4838','product','产品2','','0','','qy3','11371','<!--#p8_attach#-->/sites/item/2017_09/14_14/01252577a4304cb3.png','','1','','','admin','6','高温齿轮泵由齿轮','1','','0','0','','0','1505371977','','1539073583','1539073583','1505371977','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4849','article','工商银行','','0','','qy3','11386','<!--#p8_attach#-->/sites/item/2017_09/18_07/39581594935e4eed.jpg','','1','','','admin','6','&nbsp;工商银行','1','','3','0','','0','1505691626','','1539073583','1539073583','1505691626','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4856','zhaopin','PHP工程人才','','0','','qy3','11389','','','1','','','admin','','PHP工程人才','1','','4','0','','0','1505748490','','1539073583','1539073583','1505748490','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4864','jianyi','','','0','','qy3','11394','','','1','','','admin','','','1','','0','0','','0','1506351790','','1539073583','1539073583','1506351790','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4865','jianyi','','','0','','qy3','11394','','','1','','','admin','','','1','','0','0','','0','1507517418','','1539073583','1539073583','1507517418','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4867','article','刘冲先生（非执行董事','','0','','qy4','11397','<!--#p8_attach#-->/sites/item/2017_08/31_17/6f02b081703fd3f3.jpg','','1','','','admin','6','1970年出生','1','','4','0','','0','1504170460','','1539073698','1539073698','1504170460','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4868','article','劳动光荣2014','','0','','qy4','11402','<!--#p8_attach#-->/sites/item/2017_09/29_09/334f6519e6fb0b5e.png','','1','','','admin','6','','1','','8','0','','0','1504540800','','1539073698','1539073698','1504540800','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4879','article','吉林松原采气厂打造低效油田开发样板纪','','0','','qy4','11406','','','1','[db:发布人]','','admin','','　　截至9','1','','6','0','','0','1506614400','','1539073698','1539073698','1506614400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4882','article','宝石机械公司自主研制首套低温钻机驶向北极','','0','','qy4','11406','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','8','0','','0','1506528000','','1539073698','1539073698','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4884','article','宝鸡钢管公司成焊工序实现远程实时自动控制','','0','','qy4','11406','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','6','0','','0','1506528000','','1539073698','1539073698','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4886','article','中国石油持续提升物资装备与招标管理工作水','','0','','qy4','11406','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','5','0','','0','1506528000','','1539073698','1539073698','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4891','article','EIA原油库存意外下降汽油库存意外增加 国际油价V型反','','0','','qy4','11407','','','1','[db:发布人]','','admin','','　　周三(9','1','','14','0','','0','1506614400','','1539073698','1539073698','1506614400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4902','article','东北管网安全改造圆满收','','0','','qy4','11407','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','6','0','','0','1504454400','','1539073698','1539073698','1504454400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4907','product','产品3','','0','','qy4','11411','<!--#p8_attach#-->/sites/item/2017_09/14_14/d64eadefbeaf0459.jpg','','1','','','admin','6','我公司生产各种各类滚针轴承，包括支承滚轮.曲线滚轮（螺栓性滚轮滚针轴承）','1','','0','0','','0','1505372362','','1539073698','1539073698','1505372362','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4913','product','手电','','0','','qy4','11413','<!--#p8_attach#-->/sites/item/2017_09/29_11/fc6b716b836c3328.png','','1','','','admin','6','耐摔，耐打','1','','0','0','','0','1506614400','','1539073698','1539073698','1506614400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4914','product','视频直博服务','','0','','qy4','11414','<!--#p8_attach#-->/sites/item/2017_10/10_11/8916d64f2eb9f3ec.jpg.thumb.jpg','','1','','','admin','6','频服务器主打安防行业视频直播,数字景区直播、视频农场、视频商','1','','0','0','','0','1507605136','','1539073698','1539073698','1507605136','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4928','jianyi','','','0','','qy4','11434','','','1','','','admin','','内容内容内容内容内容内容内容内容内容内容','1','','0','0','','0','1505662124','','1539073698','1539073698','1505662124','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4929','jianyi','姓名姓名姓名','','0','','qy4','11434','','','1','','','admin','','议内议内议内议内议内议内议内议内议内议内议内议内议内议内议内','1','','0','0','','0','1505662366','','1539073698','1539073698','1505662366','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4933','jianyi','','','0','','qy4','11434','','','1','','','admin','','','1','','0','0','','0','1507517418','','1539073698','1539073698','1507517418','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4936','article','劳动光荣2014','','0','','qy5','11442','<!--#p8_attach#-->/sites/item/2017_09/29_09/334f6519e6fb0b5e.png','','1','','','admin','6','','1','','7','0','','0','1504540800','','1539074307','1539074307','1504540800','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4937','article','劳动节活','','0','','qy5','11442','<!--#p8_attach#-->/sites/item/2017_09/29_09/94746ccf1a065e04.png','','1','','','admin','6','','1','','4','0','','0','1506614400','','1539074307','1539074307','1506614400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4942','article','荣誉2','','0','','qy5','11443','<!--#p8_attach#-->/sites/item/2017_09/14_15/b64fe32a8d3178ba.png.thumb.jpg','','1','','','admin','6','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&','1','','3','0','','0','1505318400','','1539074307','1539074307','1505318400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4961','article','中国石油与黑龙江省签署合作协','','0','','qy5','11447','http://center.cnpc.com.cn/pic/0/00/09/25/92505_693604.jpg','','1','[db:发布人]','','admin','6','9','1','','6','0','','0','1506355200','','1539074307','1539074307','1506355200','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4965','article','中国石油助力','','0','','qy5','11447','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','3','0','','0','1505059200','','1539074307','1539074307','1505059200','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4968','article','我国天然气管道应用技术领跑国','','0','','qy5','11447','','','1','[db:发布人]','','admin','','　　中国石油网消息（记者蒋万全 通讯员张对红 郭志梅）9','1','','2','0','','0','1504713600','','1539074307','1539074307','1504713600','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4969','article','2017年金砖国家工商论坛在厦门举行','','0','','qy5','11447','http://center.cnpc.com.cn/pic/0/00/09/20/92088_065295.jpg','','1','[db:发布人]','','admin','6','　　王宜林出席开幕式及论坛相关活动，在专题研','1','','3','0','','0','1504627200','','1539074307','1539074307','1504627200','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4974','product','产品2','','0','','qy5','11451','<!--#p8_attach#-->/sites/item/2017_09/14_14/01252577a4304cb3.png','','1','','','admin','6','高温齿轮泵由齿轮','1','','0','0','','0','1505371977','','1539074307','1539074307','1505371977','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4988','zhaopin','PHP工程','','0','','qy5','11469','','','1','','','admin','','1、承担Web应用模块的设','1','','5','0','','0','1505664000','','1539074307','1539074307','1505664000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4990','zhaopin','Java开发工程师','','0','','qy5','11469','','','1','','','admin','','&nbsp;Java开发工程师Java开发工程师Java开发工程师Java开发工程师Java开发工程师Java开发工程师Java开发工程师Java开发工程师Java开发工程师','1','','4','0','','0','1505747655','','1539074307','1539074307','1505747655','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('4996','jianyi','','','0','','qy5','11474','','','1','','','admin','','内容内容内容内容内容内容内容内容内容内容','1','','0','0','','0','1505662124','','1539074307','1539074307','1505662124','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5000','jianyi','','','0','','qy5','11474','','','1','','','admin','','','1','','0','0','','0','1506351790','','1539074307','1539074307','1506351790','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5007','article','活动2017','','0','','qy6','11482','<!--#p8_attach#-->/sites/item/2017_09/29_09/4c5546d7b1b3090d.png','','1','','','admin','6','','1','','4','0','','0','1506649816','','1539076441','1539076441','1506649816','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5014','article','兰州石化化工污水处理装置升级','','0','','qy6','11486','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','6','0','','0','1506614400','','1539076441','1539076441','1506614400','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5019','article','渤海装备华油钢管公司力破市场寒冬扭亏为盈','','0','','qy6','11486','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','3','0','','0','1506528000','','1539076441','1539076441','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5020','article','宝鸡钢管公司成焊工序实现远程实时自动控制','','0','','qy6','11486','','','1','[db:发布人]','','admin','','　　中国石油网消','1','','3','0','','0','1506528000','','1539076441','1539076441','1506528000','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5030','article','国务院国资委部署中央企业近期重点工作','','0','','qy6','11487','','','1','[db:发布人]','','admin','','　　中国石油网消息（记者李丹）9','1','','10','0','','0','1505836800','','1539076441','1539076441','1505836800','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5031','article','王宜林拜会意大利总理真蒂洛尼','','0','','qy6','11487','http://news.cnpc.com.cn/epaper/zgsyb/2017\\\\\\\\20170915\\\\\\\\image\\\\\\\\0243445006.jpeg','','1','[db:发布人]','','admin','6','　　中国石油集团董事长王宜林9','1','','11','0','','0','1505404800','','1539076441','1539076441','1505404800','1','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_sites_item` VALUES ('5048','product','睡袋','','0','','qy6','11493','<!--#p8_attach#-->/sites/item/2017_09/29_11/54585a25d313cb61.png','','1','','','admin','6','轻量，拒水，保暖','1','','0','0','','0','1506655703','','1539076441','1539076441','1506655703','1','0','1','1','1','0','0','0','0');