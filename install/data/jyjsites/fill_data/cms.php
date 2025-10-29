-- <?php exit;?>
DROP TABLE IF EXISTS `p8_cms_attachment`;
CREATE TABLE `p8_cms_attachment` (
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

DROP TABLE IF EXISTS `p8_cms_category`;
CREATE TABLE `p8_cms_category` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
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
  `list_template_mobile` varchar(50) NOT NULL DEFAULT '',
  `view_template` varchar(50) NOT NULL DEFAULT '',
  `view_template_mobile` varchar(50) NOT NULL DEFAULT '',
  `item_template` varchar(50) NOT NULL DEFAULT '',
  `item_template_mobile` varchar(50) NOT NULL DEFAULT '',
  `display_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `seo_keywords` text NOT NULL,
  `seo_description` text NOT NULL,
  `label_postfix` varchar(50) NOT NULL DEFAULT '',
  `need_password` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `category_password` varchar(32) NOT NULL,
  `list_all_model` tinyint(1) NOT NULL DEFAULT '0',
  `config` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `model` (`model`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_category_recycle`;
CREATE TABLE `p8_cms_category_recycle` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
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
  `list_template_mobile` varchar(50) NOT NULL DEFAULT '',
  `view_template` varchar(50) NOT NULL DEFAULT '',
  `view_template_mobile` varchar(50) NOT NULL DEFAULT '',
  `item_template` varchar(50) NOT NULL DEFAULT '',
  `item_template_mobile` varchar(50) NOT NULL DEFAULT '',
  `display_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `seo_keywords` text NOT NULL,
  `seo_description` text NOT NULL,
  `label_postfix` varchar(50) NOT NULL DEFAULT '',
  `need_password` tinyint(1) NOT NULL DEFAULT '0',
  `category_password` varchar(32) NOT NULL DEFAULT '',
  `list_all_model` tinyint(1) NOT NULL DEFAULT '0',
  `config` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `model` (`model`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item`;
CREATE TABLE `p8_cms_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(120) NOT NULL DEFAULT '',
  `cid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `frame` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(1000) NOT NULL DEFAULT '',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL,
  `editer` varchar(20) NOT NULL DEFAULT '',
  `username` varchar(50) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `pages` smallint(5) unsigned NOT NULL DEFAULT '1',
  `html_view_url_rule` varchar(80) NOT NULL DEFAULT '',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `source` varchar(255) NOT NULL DEFAULT '',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `verify_frame` varchar(255) NOT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `list_order` int(10) unsigned NOT NULL DEFAULT '0',
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `verifier` varchar(50) NOT NULL DEFAULT '',
  `verify_time` int(10) unsigned NOT NULL DEFAULT '0',
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
  KEY `timestamp` (`timestamp`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_article_`;
CREATE TABLE `p8_cms_item_article_` (
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
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(1000) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL,
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
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_article_addon`;
CREATE TABLE `p8_cms_item_article_addon` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_attribute`;
CREATE TABLE `p8_cms_item_attribute` (
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

DROP TABLE IF EXISTS `p8_cms_item_comment`;
CREATE TABLE `p8_cms_item_comment` (
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

DROP TABLE IF EXISTS `p8_cms_item_comment_id`;
CREATE TABLE `p8_cms_item_comment_id` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_comment_unverified`;
CREATE TABLE `p8_cms_item_comment_unverified` (
  `id` bigint(20) unsigned NOT NULL,
  `iid` int(10) unsigned NOT NULL,
  `mid` smallint(2) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL,
  `quote` text NOT NULL,
  `content` text NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `ip` char(15) NOT NULL DEFAULT '',
  `digg` smallint(5) unsigned NOT NULL DEFAULT '0',
  `oppose` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_digg`;
CREATE TABLE `p8_cms_item_digg` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL,
  `digg` mediumint(8) NOT NULL DEFAULT '0',
  `trample` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `aid` (`iid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_down_`;
CREATE TABLE `p8_cms_item_down_` (
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
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(1000) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL,
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
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_down_addon`;
CREATE TABLE `p8_cms_item_down_addon` (
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
  `softsize` varchar(10) NOT NULL,
  `softurl` mediumtext NOT NULL,
  `totaldown` mediumint(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_government_affairs_`;
CREATE TABLE `p8_cms_item_government_affairs_` (
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
  `url` varchar(1000) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL,
  `verifier` varchar(50) NOT NULL DEFAULT '',
  `verify_time` int(10) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL,
  `list_order` int(10) unsigned NOT NULL,
  `update_time` int(10) unsigned NOT NULL,
  `pages` smallint(5) unsigned NOT NULL DEFAULT '1',
  `html_view_url_rule` varchar(80) NOT NULL DEFAULT '',
  `template` varchar(30) NOT NULL DEFAULT '',
  `views` mediumint(8) unsigned NOT NULL,
  `comments` mediumint(8) unsigned NOT NULL,
  `seo_keywords` varchar(100) NOT NULL,
  `seo_description` varchar(200) NOT NULL,
  `label_postfix` varchar(50) NOT NULL,
  `editer` varchar(20) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `indexno` varchar(255) NOT NULL,
  `issued` varchar(255) NOT NULL,
  `jigou` tinyint(3) NOT NULL,
  `lcimage` varchar(255) NOT NULL,
  `downfile` varchar(255) NOT NULL,
  `sxlb` varchar(255) NOT NULL,
  `weblink` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_government_affairs_addon`;
CREATE TABLE `p8_cms_item_government_affairs_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL,
  `page` smallint(5) unsigned NOT NULL,
  `addon_title` varchar(40) NOT NULL DEFAULT '',
  `addon_frame` varchar(100) NOT NULL DEFAULT '',
  `addon_summary` varchar(180) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_govopen2_`;
CREATE TABLE `p8_cms_item_govopen2_` (
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
  `authority` varchar(255) NOT NULL,
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
  `duixiang` tinyint(3) NOT NULL,
  `geshi` tinyint(3) NOT NULL,
  `jigou` tinyint(3) NOT NULL,
  `shengming` tinyint(3) NOT NULL,
  `suoyin` varchar(255) NOT NULL,
  `ticai` tinyint(3) NOT NULL,
  `wenhao` varchar(255) NOT NULL,
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_govopen2_addon`;
CREATE TABLE `p8_cms_item_govopen2_addon` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_govopen3_`;
CREATE TABLE `p8_cms_item_govopen3_` (
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
  `authority` varchar(255) NOT NULL,
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
  `duixiang` tinyint(3) NOT NULL,
  `geshi` tinyint(3) NOT NULL,
  `jigou` tinyint(3) NOT NULL,
  `shengming` tinyint(3) NOT NULL,
  `suoyin` varchar(255) NOT NULL,
  `ticai` tinyint(3) NOT NULL,
  `wenhao` varchar(255) NOT NULL,
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_govopen3_addon`;
CREATE TABLE `p8_cms_item_govopen3_addon` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_govopen4_`;
CREATE TABLE `p8_cms_item_govopen4_` (
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
  `authority` varchar(255) NOT NULL,
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
  `duixiang` tinyint(3) NOT NULL,
  `geshi` tinyint(3) NOT NULL,
  `jigou` tinyint(3) NOT NULL,
  `shengming` tinyint(3) NOT NULL,
  `suoyin` varchar(255) NOT NULL,
  `ticai` tinyint(3) NOT NULL,
  `wenhao` varchar(255) NOT NULL,
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_govopen4_addon`;
CREATE TABLE `p8_cms_item_govopen4_addon` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_govopen5_`;
CREATE TABLE `p8_cms_item_govopen5_` (
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
  `authority` varchar(255) NOT NULL,
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
  `duixiang` tinyint(3) NOT NULL,
  `geshi` tinyint(3) NOT NULL,
  `jigou` tinyint(3) NOT NULL,
  `shengming` tinyint(3) NOT NULL,
  `suoyin` varchar(255) NOT NULL,
  `ticai` tinyint(3) NOT NULL,
  `wenhao` varchar(255) NOT NULL,
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_govopen5_addon`;
CREATE TABLE `p8_cms_item_govopen5_addon` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_govopen_`;
CREATE TABLE `p8_cms_item_govopen_` (
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
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(1000) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL,
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

DROP TABLE IF EXISTS `p8_cms_item_govopen_addon`;
CREATE TABLE `p8_cms_item_govopen_addon` (
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
  `xinxifenlei` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_lingdao_`;
CREATE TABLE `p8_cms_item_lingdao_` (
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
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_lingdao_addon`;
CREATE TABLE `p8_cms_item_lingdao_addon` (
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
  `xinxifenlei` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_member`;
CREATE TABLE `p8_cms_item_member` (
  `iid` int(10) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL,
  `model` char(20) NOT NULL DEFAULT '',
  `verified` tinyint(1) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`iid`),
  KEY `uid` (`uid`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_member_collection`;
CREATE TABLE `p8_cms_item_member_collection` (
  `iid` int(10) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`iid`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_mood`;
CREATE TABLE `p8_cms_item_mood` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL DEFAULT '',
  `image` char(20) NOT NULL DEFAULT '',
  `display_order` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_mood_data`;
CREATE TABLE `p8_cms_item_mood_data` (
  `iid` int(10) unsigned NOT NULL,
  `m1` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `m2` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `m3` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `m4` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `m5` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `m6` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `m7` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `m8` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`iid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_page_`;
CREATE TABLE `p8_cms_item_page_` (
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
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
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
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `level` (`level`,`list_order`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_page_addon`;
CREATE TABLE `p8_cms_item_page_addon` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_paper_`;
CREATE TABLE `p8_cms_item_paper_` (
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
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(1000) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL,
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
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_paper_addon`;
CREATE TABLE `p8_cms_item_paper_addon` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_pay`;
CREATE TABLE `p8_cms_item_pay` (
  `iid` int(10) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL,
  `timestamp` int(8) NOT NULL,
  PRIMARY KEY (`iid`,`uid`),
  KEY `uid` (`uid`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_people_`;
CREATE TABLE `p8_cms_item_people_` (
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
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(1000) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL,
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
  `department` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_people_addon`;
CREATE TABLE `p8_cms_item_people_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL,
  `page` smallint(5) unsigned NOT NULL,
  `addon_title` varchar(40) NOT NULL DEFAULT '',
  `addon_frame` varchar(100) NOT NULL DEFAULT '',
  `addon_summary` varchar(180) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `award` mediumtext,
  `birthday` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `education` varchar(255) NOT NULL,
  `event` mediumtext,
  `Hometown` varchar(255) NOT NULL,
  `motion` mediumtext,
  `office` varchar(255) NOT NULL,
  `photo` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_photo_`;
CREATE TABLE `p8_cms_item_photo_` (
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
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(1000) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL,
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
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_photo_addon`;
CREATE TABLE `p8_cms_item_photo_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL,
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

DROP TABLE IF EXISTS `p8_cms_item_product_`;
CREATE TABLE `p8_cms_item_product_` (
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
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(1000) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL,
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL,
  `verifier` varchar(50) NOT NULL DEFAULT '',
  `verify_time` int(10) NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL,
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
  `editer` varchar(20) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_product_addon`;
CREATE TABLE `p8_cms_item_product_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL,
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

DROP TABLE IF EXISTS `p8_cms_item_tag`;
CREATE TABLE `p8_cms_item_tag` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `item_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `hot` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `display_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_tag_item`;
CREATE TABLE `p8_cms_item_tag_item` (
  `tid` smallint(5) unsigned NOT NULL,
  `iid` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`tid`,`iid`),
  KEY `iid` (`iid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_unverified`;
CREATE TABLE `p8_cms_item_unverified` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
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
  `verifier` varchar(50) NOT NULL DEFAULT '',
  `ever_verified` tinyint(1) NOT NULL DEFAULT '0',
  `data` longtext NOT NULL,
  `push_back_reason` varchar(255) NOT NULL DEFAULT '',
  `push_item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`timestamp`),
  KEY `cid` (`cid`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_video_`;
CREATE TABLE `p8_cms_item_video_` (
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
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(1000) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL,
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
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_video_addon`;
CREATE TABLE `p8_cms_item_video_addon` (
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
  `video_height` smallint(5) NOT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `video_width` smallint(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_zlku_`;
CREATE TABLE `p8_cms_item_zlku_` (
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
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(1000) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL,
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL,
  `verifier` varchar(50) NOT NULL DEFAULT '',
  `verify_time` int(10) NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL,
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
  `editer` varchar(20) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `config` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_zlku_addon`;
CREATE TABLE `p8_cms_item_zlku_addon` (
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
  `copyright` tinyint(3) NOT NULL,
  `softlanguage` tinyint(3) NOT NULL,
  `softsize` varchar(10) NOT NULL,
  `softurl` mediumtext NOT NULL,
  `totaldown` mediumint(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_member`;
CREATE TABLE `p8_cms_member` (
  `id` mediumint(8) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '',
  `role_id` smallint(5) unsigned NOT NULL,
  `item_count` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `role_id` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_model`;
CREATE TABLE `p8_cms_model` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL DEFAULT '',
  `alias` char(30) NOT NULL DEFAULT '',
  `list_order` int(10) NOT NULL DEFAULT '0',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `config` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_model_field`;
CREATE TABLE `p8_cms_model_field` (
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

DROP TABLE IF EXISTS `p8_cms_order`;
CREATE TABLE `p8_cms_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NO` varchar(25) NOT NULL DEFAULT '',
  `interface_NO` varchar(25) NOT NULL DEFAULT '',
  `name` varchar(40) NOT NULL DEFAULT '',
  `subject` varchar(60) NOT NULL DEFAULT '',
  `seller_uid` mediumint(8) unsigned NOT NULL,
  `seller_username` varchar(20) NOT NULL DEFAULT '',
  `buyer_uid` mediumint(8) unsigned NOT NULL,
  `sid` mediumint(8) unsigned NOT NULL,
  `buyer_username` varchar(20) NOT NULL DEFAULT '',
  `phone` varchar(30) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `address` varchar(100) NOT NULL DEFAULT '',
  `interface` varchar(10) NOT NULL DEFAULT '',
  `amount` decimal(10,2) unsigned NOT NULL,
  `number` smallint(5) unsigned NOT NULL,
  `ip` varchar(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `paid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `notify` text NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NO` (`NO`),
  KEY `seller_uid` (`seller_uid`,`timestamp`),
  KEY `buyer_uid` (`buyer_uid`,`timestamp`),
  KEY `status` (`status`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_statistic_cluster`;
CREATE TABLE `p8_cms_statistic_cluster` (
  `client_id` int(11) NOT NULL DEFAULT '0',
  `cid` int(11) NOT NULL DEFAULT '0',
  `model` varchar(30) NOT NULL DEFAULT '',
  `year` smallint(4) NOT NULL DEFAULT '0',
  `month` tinyint(1) NOT NULL DEFAULT '0',
  `day` tinyint(1) NOT NULL DEFAULT '0',
  `post` int(11) NOT NULL DEFAULT '0',
  `unverified` int(11) NOT NULL DEFAULT '0',
  `verified` int(11) NOT NULL DEFAULT '0',
  `timestamp` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `model` (`client_id`,`model`,`year`,`month`,`day`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_statistic__sites_content`;
CREATE TABLE `p8_cms_statistic__sites_content` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_statistic__sites_push`;
CREATE TABLE `p8_cms_statistic__sites_push` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_statistic_data`;
CREATE TABLE `p8_cms_statistic_data` (
  `cid` int(11) NOT NULL DEFAULT '0',
  `model` varchar(30) NOT NULL DEFAULT '',
  `year` smallint(4) NOT NULL DEFAULT '0',
  `month` tinyint(1) NOT NULL DEFAULT '0',
  `day` tinyint(1) NOT NULL DEFAULT '0',
  `post` int(11) NOT NULL DEFAULT '0',
  `unverified` int(11) NOT NULL DEFAULT '0',
  `comment` int(11) NOT NULL DEFAULT '0',
  `visit` int(11) NOT NULL DEFAULT '0',
  `timestamp` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `model` (`cid`,`model`,`year`,`month`,`day`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_statistic_member`;
CREATE TABLE `p8_cms_statistic_member` (
  `uid` int(11) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '0',
  `role_gid` int(11) NOT NULL DEFAULT '0',
  `cid` int(11) NOT NULL DEFAULT '0',
  `model` varchar(30) NOT NULL DEFAULT '',
  `year` smallint(4) NOT NULL DEFAULT '0',
  `month` tinyint(2) NOT NULL DEFAULT '0',
  `day` tinyint(2) NOT NULL DEFAULT '0',
  `post` int(11) NOT NULL DEFAULT '0',
  `unverified` int(11) NOT NULL DEFAULT '0',
  `comment` int(11) NOT NULL DEFAULT '0',
  `visit` int(11) NOT NULL DEFAULT '0',
  `timestamp` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `model` (`uid`,`cid`,`model`,`year`,`month`,`day`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_statistic_sites_content`;
CREATE TABLE `p8_cms_statistic_sites_content` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_statistic_sites_push`;
CREATE TABLE `p8_cms_statistic_sites_push` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_wechat_keywords`;
CREATE TABLE `p8_cms_wechat_keywords` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keyword` varchar(100) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `pattern` tinyint(255) unsigned DEFAULT '1',
  `content` mediumtext,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `picurl` varchar(200) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `reply_type` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `keyword` (`keyword`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_wechat_menus`;
CREATE TABLE `p8_cms_wechat_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `list_order` tinyint(3) unsigned DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_wechat_messages`;
CREATE TABLE `p8_cms_wechat_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(30) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `reply` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_wechat_pushlogs`;
CREATE TABLE `p8_cms_wechat_pushlogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned DEFAULT NULL,
  `no` tinyint(1) unsigned DEFAULT '0',
  `media_id` varchar(100) DEFAULT NULL,
  `msg_id` varchar(100) DEFAULT NULL,
  `msg_data_id` varchar(100) DEFAULT NULL,
  `litpic` varchar(100) DEFAULT NULL,
  `litpic_id` varchar(100) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `verifier` varchar(50) DEFAULT NULL,
  `author` varchar(30) DEFAULT NULL,
  `show_author` tinyint(1) unsigned DEFAULT '0',
  `open_comment` tinyint(1) unsigned DEFAULT '1',
  `fans_comment` tinyint(1) unsigned DEFAULT '0',
  `description` varchar(255) DEFAULT NULL,
  `body` text,
  `push_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `aid` (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_wechat_users`;
CREATE TABLE `p8_cms_wechat_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(30) DEFAULT NULL,
  `subscribe` tinyint(1) DEFAULT NULL,
  `nickname` varchar(30) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `province` varchar(30) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `headimgurl` varchar(200) DEFAULT NULL,
  `subscribe_time` datetime DEFAULT NULL,
  `unionid` varchar(30) DEFAULT NULL,
  `subscribe_scene` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `openid` (`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
REPLACE INTO `p8_cms_attachment` VALUES ('1','item','1','1','AD444E7352D5CB2C2A7161C0DEF19C8B.jpg','application/octet-stream','jpg','14076','192.168.1.175','cms/item/2010_12/08_11/8764672f9925ff1f.jpg','1','0','1291778075');
REPLACE INTO `p8_cms_attachment` VALUES ('2','item','1','1','4D4B5004A24F6BEB6F5DD717312F22FE.jpg','application/octet-stream','jpg','19760','192.168.1.175','cms/item/2010_12/08_11/b7e82af23b1144b0.jpg','1','0','1291778075');
REPLACE INTO `p8_cms_attachment` VALUES ('3','item','2','1','20101205033712734b9.jpg','application/octet-stream','jpg','39400','192.168.1.175','cms/item/2010_12/08_11/7a19ccbc3af02c79.jpg','1','0','1291778222');
REPLACE INTO `p8_cms_attachment` VALUES ('4','item','4','1','8685177F103E6ED71D99C01EC59B64FE.jpg','application/octet-stream','jpg','29294','192.168.1.175','cms/item/2010_12/08_11/855030f503135e65.jpg','1','0','1291778456');
REPLACE INTO `p8_cms_attachment` VALUES ('5','item','4','1','13E9559F9316594C520B81DDDD900DC6.jpg','application/octet-stream','jpg','50526','192.168.1.175','cms/item/2010_12/08_11/9bda420096b495ab.jpg','1','0','1291778456');
REPLACE INTO `p8_cms_attachment` VALUES ('6','item','4','1','906BB1DA41C5361CF164F598B02AE0E9.jpg','application/octet-stream','jpg','57909','192.168.1.175','cms/item/2010_12/08_11/5b61aef0201c64ab.jpg','1','0','1291778456');
REPLACE INTO `p8_cms_attachment` VALUES ('7','item','6','1','A96EB1AB300251E19E612B632B4370E0.jpg','application/octet-stream','jpg','53016','192.168.1.175','cms/item/2010_12/08_11/1b2a4988ed469903.jpg','1','0','1291778692');
REPLACE INTO `p8_cms_attachment` VALUES ('8','item','7','1','2EDE84FA33C9025F9487143017B03313.jpg','application/octet-stream','jpg','11106','192.168.1.175','cms/item/2010_12/08_11/66507371e1a64a67.jpg','1','0','1291778762');
REPLACE INTO `p8_cms_attachment` VALUES ('9','item','9','1','40F7E44BD90CEC950EE2399EC903FE09.jpg','application/octet-stream','jpg','43490','192.168.1.175','cms/item/2010_12/08_11/d17089c8662acc7e.jpg','1','0','1291778916');
REPLACE INTO `p8_cms_attachment` VALUES ('61','item','9','1','04fe5c8d3ec419b1.jpg','application/octet-stream','jpg','8439','192.168.1.175','cms/item/2010_12/08_15/496321f067169783.jpg','1','0','1291793360');
REPLACE INTO `p8_cms_attachment` VALUES ('71','item','0','1','cea73627288e3afb.gif','application/octet-stream','gif','68635','192.168.1.175','cms/item/2010_12/08_17/1968152fca13e53b.gif','1','0','1291800727');
REPLACE INTO `p8_cms_attachment` VALUES ('86','item','76','1','44.jpg','image/jpeg','jpg','24606','192.168.1.110','cms/item/2010_12/14_09/de676eecf23f5eca.jpg','2','0','1292290708');
REPLACE INTO `p8_cms_attachment` VALUES ('87','item','76','1','33.jpg','image/jpeg','jpg','3615','192.168.1.110','cms/item/2010_12/14_09/cb76e647d9a6ba64.jpg','0','0','1292291406');
REPLACE INTO `p8_cms_attachment` VALUES ('209','item','287','1','1731479_980x1200_234.jpg','image/jpeg','jpg','249005','113.64.115.80','cms/item/2012_09/02_02/0a397fd572b3d038.jpg','2','0','1346523688');
REPLACE INTO `p8_cms_attachment` VALUES ('147','item','0','1','333.gif','image/gif','gif','22554','219.136.183.45','cms/item/2011_06/14_14/5f5e037048b9908e.gif','1','0','1308032973');
REPLACE INTO `p8_cms_attachment` VALUES ('208','item','287','1','b20113332200502925146.jpg','image/jpeg','jpg','229256','113.64.115.80','cms/item/2012_09/02_02/ed06de3b55b12af0.jpg','1','0','1346523578');
REPLACE INTO `p8_cms_attachment` VALUES ('207','item','287','1','F251.jpg','image/jpeg','jpg','17427','113.64.115.80','cms/item/2012_09/02_02/8311c4015f44d3fc.jpg','1','0','1346523578');
REPLACE INTO `p8_cms_attachment` VALUES ('206','item','285','1','992.jpg','image/jpeg','jpg','7401','61.144.100.3','cms/item/2012_09/01_21/a79b21b365f95960.jpg','1','0','1346507936');
REPLACE INTO `p8_cms_attachment` VALUES ('205','item','284','1','992.jpg','image/jpeg','jpg','5831','61.144.100.3','cms/item/2012_09/01_21/df3da5beaed1202f.jpg','1','0','1346507862');
REPLACE INTO `p8_cms_attachment` VALUES ('204','item','283','1','992.jpg','image/jpeg','jpg','8187','61.144.100.3','cms/item/2012_09/01_21/82fa47cae98e580b.jpg','1','0','1346507813');
REPLACE INTO `p8_cms_attachment` VALUES ('203','item','282','1','992.jpg','image/jpeg','jpg','8116','61.144.100.3','cms/item/2012_09/01_21/ae5d690afcecd650.jpg','1','0','1346507769');
REPLACE INTO `p8_cms_attachment` VALUES ('163','item','207','1','5.gif','image/gif','gif','5964','219.136.181.14','cms/item/2011_06/21_10/79ef90ef7438d6e6.gif','0','0','1308624687');
REPLACE INTO `p8_cms_attachment` VALUES ('164','item','206','1','6.gif','image/gif','gif','5738','219.136.181.14','cms/item/2011_06/21_10/f258988406a5125c.gif','0','0','1308624706');
REPLACE INTO `p8_cms_attachment` VALUES ('165','item','205','1','7.gif','image/gif','gif','6294','219.136.181.14','cms/item/2011_06/21_10/82c79ea641ab4fe4.gif','0','0','1308624725');
REPLACE INTO `p8_cms_attachment` VALUES ('166','item','0','1','7.gif','image/gif','gif','6294','219.136.181.14','cms/item/2011_06/21_15/0bfc11e075348ddc.gif','0','0','1308643019');
REPLACE INTO `p8_cms_attachment` VALUES ('167','item','204','1','7.gif','image/gif','gif','6294','219.136.181.14','cms/item/2011_06/21_15/ba91230c0cd9b7c5.gif','0','0','1308643099');
REPLACE INTO `p8_cms_attachment` VALUES ('168','item','201','1','6.gif','image/gif','gif','5738','219.136.181.14','cms/item/2011_06/21_15/5645556c8d1caefc.gif','0','0','1308643186');
REPLACE INTO `p8_cms_attachment` VALUES ('169','item','201','1','8.gif','image/gif','gif','4898','219.136.181.14','cms/item/2011_06/22_10/cf84a09721789855.gif','0','0','1308708150');
REPLACE INTO `p8_cms_attachment` VALUES ('170','item','76','1','9.gif','image/gif','gif','5041','219.136.181.14','cms/item/2011_06/22_10/6937af88a3c88d53.gif','0','0','1308708391');
REPLACE INTO `p8_cms_attachment` VALUES ('171','item','201','1','88.gif','image/gif','gif','4827','219.136.181.14','cms/item/2011_06/22_10/1f72395c2f073107.gif','0','0','1308708937');
REPLACE INTO `p8_cms_attachment` VALUES ('202','item','281','1','991.jpg','image/jpeg','jpg','6144','61.144.100.3','cms/item/2012_09/01_21/cdd5f3b451774c11.jpg','1','0','1346507675');
REPLACE INTO `p8_cms_attachment` VALUES ('201','item','281','1','99.jpg','image/jpeg','jpg','4904','61.144.100.3','cms/item/2012_09/01_21/2d3d1bc3382893e9.jpg','0','0','1346507560');
REPLACE INTO `p8_cms_attachment` VALUES ('174','item','240','1','5.jpg','image/jpeg','jpg','215624','61.140.42.212','cms/item/2012_08/23_00/a79f5e84a6fcbc8d.jpg','2','0','1345651923');
REPLACE INTO `p8_cms_attachment` VALUES ('175','item','242','1','5.jpg','image/jpeg','jpg','81191','61.140.42.212','cms/item/2012_08/23_00/afa9ec23dfb52a78.jpg','2','0','1345652020');
REPLACE INTO `p8_cms_attachment` VALUES ('176','item','244','1','5.jpg','image/jpeg','jpg','100677','61.140.42.212','cms/item/2012_08/23_00/e8823f5e58f887e7.jpg','2','0','1345652184');
REPLACE INTO `p8_cms_attachment` VALUES ('177','item','246','1','5.jpg','image/jpeg','jpg','44333','61.140.42.212','cms/item/2012_08/23_00/957d299fb7d2da1e.jpg','1','0','1345652332');
REPLACE INTO `p8_cms_attachment` VALUES ('178','item','247','1','5.jpg','image/jpeg','jpg','65845','61.140.42.212','cms/item/2012_08/23_00/59ff705a00dad16e.jpg','1','0','1345652482');
REPLACE INTO `p8_cms_attachment` VALUES ('180','item','0','1','6_2.jpg','image/jpeg','jpg','2306388','61.140.42.212','cms/item/2012_08/23_00/7afe62b6e4cd73e4.jpg','2','0','1345653708');
REPLACE INTO `p8_cms_attachment` VALUES ('182','item','260','1','888.jpg','image/jpeg','jpg','99180','113.103.2.24','cms/item/2012_08/23_12/f0bdea87dc7defa8.jpg','2','0','1345695603');
REPLACE INTO `p8_cms_attachment` VALUES ('183','item','260','1','4-6.txt','text/plain','txt','2420','113.103.2.24','cms/item/2012_08/23_12/00f764c773ad19f2.txt','0','0','1345695994');
REPLACE INTO `p8_cms_attachment` VALUES ('184','item','0','1','888.jpg','application/octet-stream','jpg','99180','113.103.2.24','cms/item/2012_08/23_13/29ae89330cead15c.jpg','2','0','1345699704');
REPLACE INTO `p8_cms_attachment` VALUES ('185','item','0','1','6_2.jpg','application/octet-stream','jpg','178034','113.103.2.24','cms/item/2012_08/23_13/f3871d08521f1fac.jpg','2','0','1345699708');
REPLACE INTO `p8_cms_attachment` VALUES ('186','item','263','1','6.jpg','image/jpeg','jpg','6494','113.103.2.24','cms/item/2012_08/23_13/6f3c4b9afbd5f425.jpg','1','0','1345701218');
REPLACE INTO `p8_cms_attachment` VALUES ('187','item','263','1','888.jpg','image/jpeg','jpg','99180','113.103.2.24','cms/item/2012_08/23_13/32dd67ce0462cd60.jpg','2','0','1345701258');
REPLACE INTO `p8_cms_attachment` VALUES ('188','item','263','1','6_2.jpg','application/octet-stream','jpg','178034','113.103.2.24','cms/item/2012_08/23_13/583aefc1010e1ada.jpg','2','0','1345701378');
REPLACE INTO `p8_cms_attachment` VALUES ('189','item','263','1','6_1.jpg','application/octet-stream','jpg','41914','113.103.2.24','cms/item/2012_08/23_13/9edb559ba671343e.jpg','1','0','1345701379');
REPLACE INTO `p8_cms_attachment` VALUES ('190','item','263','1','内网教程.txt','text/plain','txt','1755','113.103.2.24','cms/item/2012_08/23_13/095b084e3511e0d8.txt','0','0','1345701411');
REPLACE INTO `p8_cms_attachment` VALUES ('191','item','264','1','888.jpg','image/jpeg','jpg','99180','113.103.2.24','cms/item/2012_08/23_16/3240fd004ac68658.jpg','2','0','1345708879');
REPLACE INTO `p8_cms_attachment` VALUES ('192','item','264','1','6_2.jpg','application/octet-stream','jpg','178034','113.103.2.24','cms/item/2012_08/23_16/9797e52208869a73.jpg','2','0','1345708911');
REPLACE INTO `p8_cms_attachment` VALUES ('193','item','264','1','6_1.jpg','application/octet-stream','jpg','41914','113.103.2.24','cms/item/2012_08/23_16/cde8489b6dbb181d.jpg','1','0','1345708913');
REPLACE INTO `p8_cms_attachment` VALUES ('194','item','264','1','学校网站.txt','text/plain','txt','1500','113.103.2.24','cms/item/2012_08/23_16/ef178e9556f68162.txt','0','0','1345709057');
REPLACE INTO `p8_cms_attachment` VALUES ('195','item','0','1','html案例.doc','application/octet-stream','doc','546816','113.103.2.24','cms/item/2012_08/23_16/a91fc2ec6a459779.doc','0','0','1345711183');
REPLACE INTO `p8_cms_attachment` VALUES ('196','item','269','1','9999.jpg','image/jpeg','jpg','59445','113.103.3.249','cms/item/2012_08/29_17/bfb49728bcfc4771.jpg','1','0','1346234058');
REPLACE INTO `p8_cms_attachment` VALUES ('197','item','275','1','99995.jpg','image/jpeg','jpg','28240','61.140.40.185','cms/item/2012_08/30_14/05432d1aeeaa1e99.jpg','1','0','1346306974');
REPLACE INTO `p8_cms_attachment` VALUES ('198','item','276','1','99995.jpg','image/jpeg','jpg','8976','61.140.40.185','cms/item/2012_08/30_14/ddb684a540bf5290.jpg','1','0','1346307126');
REPLACE INTO `p8_cms_attachment` VALUES ('199','item','277','1','99996.jpg','image/jpeg','jpg','12519','61.140.40.185','cms/item/2012_08/30_14/f471e79ac218bca2.jpg','1','0','1346307259');
REPLACE INTO `p8_cms_attachment` VALUES ('200','item','278','1','99996.jpg','image/jpeg','jpg','9741','61.140.40.185','cms/item/2012_08/30_14/e4518b36b9966e4f.jpg','1','0','1346307352');
REPLACE INTO `p8_cms_attachment` VALUES ('212','item','304','1','ca58d69c878e0921.jpg','image/jpeg','jpg','156034','61.183.53.76','cms/item/2013_04/14_17/e2059a024aed0b66.jpg','2','0','1365933213');
REPLACE INTO `p8_cms_attachment` VALUES ('213','item','282','1','test.png','image/x-png','png','3741','116.236.146.210','cms/item/2013_04/23_10/03de43ece19621b7.png','1','0','1366685735');
REPLACE INTO `p8_cms_attachment` VALUES ('215','item','1025','1','IMG_20130630_0002.jpg','image/jpeg','jpg','2563704','119.141.175.138','cms/item/2013_12/08_14/edd83c0579cec54f.jpg','2','0','1386485867');
REPLACE INTO `p8_cms_attachment` VALUES ('216','item','284','1','5.jpg','image/jpeg','jpg','291575','183.48.65.141','cms/item/2014_08/30_21/fa206fa3582f2338.jpg','1','0','1409404064');
REPLACE INTO `p8_cms_attachment` VALUES ('217','item','1017','1','5.jpg','image/jpeg','jpg','291575','14.121.14.170','cms/item/2014_09/01_17/385cdb5e20e4ed8e.jpg','1','0','1409564819');
REPLACE INTO `p8_cms_attachment` VALUES ('218','item','284','1','2.jpg','image/jpeg','jpg','177341','14.121.14.170','cms/item/2014_09/01_17/593cbe81e81c1655.jpg','1','0','1409565044');
REPLACE INTO `p8_cms_attachment` VALUES ('219','item','1058','1','91.jpg','image/jpeg','jpg','342577','14.120.231.20','cms/item/2014_09/10_22/f06d99571a5d25c2.jpg','1','0','1410359756');
REPLACE INTO `p8_cms_attachment` VALUES ('220','item','1053','1','school.jpg','image/jpeg','jpg','54811','183.48.66.5','cms/item/2015_01/06_20/e6a9fd61a4dddd43.jpg','2','0','1420549106');
REPLACE INTO `p8_cms_attachment` VALUES ('221','item','285','1','fdee430bb9e38552.jpg','application/octet-stream','jpg','24984','121.8.205.76','cms/item/2015_01/11_01/e3aaa9ee0334b92a.jpg','1','0','1420909633');
REPLACE INTO `p8_cms_attachment` VALUES ('222','item','1080','1','2.jpg','image/jpeg','jpg','207088','113.96.85.241','cms/item/2015_05/23_08/2491223fbece3b6d.jpg','1','0','1432341327');
REPLACE INTO `p8_cms_attachment` VALUES ('223','item','1064','1','3.jpg','image/jpeg','jpg','58518','113.96.85.241','cms/item/2015_05/23_08/6bda83cf89e6cf65.jpg','0','0','1432341359');
REPLACE INTO `p8_cms_attachment` VALUES ('224','item','1061','1','6.jpg','image/jpeg','jpg','66694','113.96.85.241','cms/item/2015_05/23_08/9a720b9fd38c67fb.jpg','0','0','1432341393');
REPLACE INTO `p8_cms_attachment` VALUES ('225','item','1079','1','4.jpg','image/jpeg','jpg','61104','113.96.85.241','cms/item/2015_05/23_08/def29b9c7dd0d591.jpg','0','0','1432341452');
REPLACE INTO `p8_cms_attachment` VALUES ('226','item','0','1','1442326420827544.jpg','image/jpeg','jpg','136165','175.12.244.179','ueditor/image/20150915/1442326420827544.jpg','0','0','1442326421');
REPLACE INTO `p8_cms_attachment` VALUES ('227','item','0','1','1442676782968215.jpg','image/jpeg','jpg','376801','222.240.162.130','ueditor/image/20150919/1442676782968215.jpg','0','0','1442676782');
REPLACE INTO `p8_cms_attachment` VALUES ('228','item','0','1','267398_231519045229_2.jpg','image/jpeg','jpg','131166','119.62.48.87','cms/item/2015_10/29_11/f53297cda0bd1e2b.jpg','2','0','1446089927');
REPLACE INTO `p8_cms_attachment` VALUES ('233','item','0','1','云信通微信二维码.png','image/png','png','8414','116.226.127.6','cms/item/2016_08/23_15/a95aa34a9b321d23.png','0','0','1471937735');
REPLACE INTO `p8_cms_attachment` VALUES ('234','item','1111','1','219919077f47ff3a.png','image/png','png','69789','36.157.225.191','cms/item/2020_02/20_12/b93409c78d814e0c.png','1','0','1582171218');
REPLACE INTO `p8_cms_attachment` VALUES ('235','item','1112','1','2f.png','image/png','png','82517','36.157.225.191','cms/item/2020_02/20_12/72f7b76d63d42d80.png','1','0','1582171273');
REPLACE INTO `p8_cms_attachment` VALUES ('236','item','1113','1','3.png','image/png','png','80834','36.157.225.191','cms/item/2020_02/20_12/dda0039cf6530982.png','1','0','1582171329');
REPLACE INTO `p8_cms_attachment` VALUES ('237','item','1109','311','991.jpg','image/jpeg','jpg','12813','113.247.22.132','cms/item/2020_02/21_06/09d68f381503589d.jpg','1','0','1582237049');
REPLACE INTO `p8_cms_attachment` VALUES ('214','item','0','2','146370981.jpg','image/jpeg','jpg','65198','121.56.21.39','cms/item/2013_11/23_01/1fe0a2ec2d0cce77.jpg','1','0','1385140507');
REPLACE INTO `p8_cms_attachment` VALUES ('230','item','0','292','allbg.jpg','application/octet-stream','jpg','242828','106.114.6.224','cms/item/2016_02/22_10/6e775fdfa7e40e17.jpg','2','0','1456108893');
REPLACE INTO `p8_cms_attachment` VALUES ('231','item','0','293','1.rar','application/octet-stream','rar','27','36.63.78.21','cms/item/2016_03/27_14/b249cd0aff1b8c41.rar','0','0','1459059419');
REPLACE INTO `p8_cms_attachment` VALUES ('232','item','0','296','1111.gif','image/gif','gif','7','182.91.38.59','cms/item/2016_06/01_16/97a101a59cc268e4.gif','0','0','1464770312');
REPLACE INTO `p8_cms_category` VALUES ('1','0','新闻动态','x','article','','','','1','60','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xinwenzhongxin','20','article/list_xxgk3','article/list_mobile','article/view','article/view_mobile','common/ico_title/list012','mobile/list','248','','','','0','','1','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('15','0','站内公告','z','article','','','','1','24','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','zhanneigonggao','20','article/list','article/list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list','0','','','','0','','0','a:5:{s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";}');
REPLACE INTO `p8_cms_category` VALUES ('16','20','组织工作','z','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','jingxiaoshanghuodongyudaili/shouhouzixun','30','article/list','article/list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list','8','','','category_34','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('17','20','党建工作','d','article','','','','2','4','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','jingxiaoshanghuodongyudaili/shouhouchangjianwenti','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','10','','','category_34','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('20','0','党群工作','d','article','','','','1','5','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','jingxiaoshanghuodongyudaili','20','article/big_list','article/list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list','45','','','','0','','1','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('26','15','站内公告','z','article','','','','2','6','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','zhanneigonggao/zhanneigonggao','20','article/list','article/list_mobile','article/view2','article/view_mobile','common/ico_title/list016','mobile/list','0','','','','0','','0','a:7:{s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:19:\"list_pages_template\";s:0:\"\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";}');
REPLACE INTO `p8_cms_category` VALUES ('34','1','学校动态','x','article','','','','2','22','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xinwenzhongxin/xingyedongtai','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','6','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('856','176','信息公开年报','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinxigongkai/xinxigongkainianbao','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','6','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:17:\"list_title_length\";i:150;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('44','1','教育要闻','j','article','','','','2','18','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xinwenzhongxin/ceshilanmu','30','article/list','article/list_mobile','article/view','article/view_mobile','adaption/pic_title_summary/list022','mobile/list','10','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('47','20','理论学习','l','article','','','','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','jingxiaoshanghuodongyudaili/shiziduiwu','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','6','','','category_34','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('768','767','群众路线专题','q','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','wangzhanzhuanti/qunzhongluxianzhuanti','30','article/list_new_zt2','article/list_mobile','article/view_zhuanti','article/view_mobile','common/ico_title/list007_zt','mobile/list','2','','','category_891','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('53','138','学院视频','x','video','','','','2','5','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','tupianshijie/shipinxinwen','20','video/list','video/list_mobile','video/view','video/view_mobile','common/pic_title/list001b','mobile/list','10','','','category_34','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('805','767','心理健康','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','wangzhanzhuanti/xinlijiankang','30','article/list_new_zt2','article/list_mobile','article/view_zhuanti','article/view_mobile','common/ico_title/list016','mobile/list','5','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('853','176','政策文件','z','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinxigongkai/zhengcefagui','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','18','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:150;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('855','176','信息公开指南','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinxigongkai/xinxigongkaizhinan','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','25','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:17:\"list_title_length\";i:150;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('860','176','行政复议公开','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinxigongkai/xingzhengfuyigongkai','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','7','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('861','176','行政执法','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinxigongkai/xingzhengzhifa','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','8','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('128','1','通知公告','t','article','','','','2','20','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xinwenzhongxin/tongzhigonggao','20','article/list','article/list_mobile','article/view','article/view_mobile','adaption/ico_title/dot_title_14px-11','mobile/list','8','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('144','143','学院资料','x','down','','','','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xiazaizhongxin/xuexiziliao','30','down/list','down/list_mobile','down/view','down/view_mobile','common/ico_title/list016','mobile/list','12','','','category_144','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('143','0','下载中心','x','down','','','','1','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xiazaizhongxin','20','down/big_list','down/list_mobile','down/view','down/view_mobile','common/ico_title/list016','mobile/list','30','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('149','143','其他下载','q','down','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xiazaizhongxin/qitaxiazai','30','article/list','down/list_mobile','down/view','down/view_mobile','common/ico_title/list016','mobile/list','0','','','category_144','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('136','0','学生园地','x','photo','','','','1','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','tupianmoxing','20','photo/photo_index','photo/list_mobile','photo/view','photo/view_mobile','common/pic_title/list001b','mobile/list','130','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('137','136','活动图片','h','photo','','','','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','tupianmoxing/xiaoyuanfengguang','20','photo/list','photo/list_mobile','photo/view','photo/view_mobile','common/pic_title/list001c','mobile/list','0','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('138','0','视频世界','s','video','','','','1','11','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','tupianshijie','20','video/video_index','video/list_mobile','video/view','video/view_mobile','common/pic_title/list002b','mobile/list','24','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('769','768','典型风采','d','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','wangzhanzhuanti/qunzhongluxianzhuanti/dianxingfengcai','30','zhuanti/list','article/list_mobile','zhuanti/view','article/view_mobile','common/ico_title/list011','mobile/list','18','','','category_891','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('140','138','活动视频','h','video','','','','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','tupianshijie/xiaoyuanfengguang','20','video/list','video/list_mobile','video/view','video/view_mobile','common/pic_title/list002b','mobile/list','0','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('141','138','教学视频','j','video','','','','2','5','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','tupianshijie/jingpinkecheng','20','video/list','video/list_mobile','video/view','video/view_mobile','common/ico_title/list016','mobile/list','0','','','','0','','0','a:7:{s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('145','143','软件下载','r','down','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xiazaizhongxin/ruanjianxiazai','30','down/list','down/list_mobile','down/view','down/view_mobile','common/ico_title/list016','mobile/list','9','','','category_144','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('146','143','文档下载','w','down','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xiazaizhongxin/wendangxiazai','30','down/list','down/list_mobile','down/view','down/view_mobile','common/ico_title/list016','mobile/list','7','','','category_144','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('147','143','电子书下载','d','down','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xiazaizhongxin/dianzishuxiazai','20','down/list','down/list_mobile','down/view','down/view_mobile','common/ico_title/list016','mobile/list','5','','','category_144','0','','0','a:7:{s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:19:\"list_pages_template\";s:0:\"\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";}');
REPLACE INTO `p8_cms_category` VALUES ('148','143','表格下载','b','down','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xiazaizhongxin/biaogexiazai','20','down/list','down/list_mobile','down/view','down/view_mobile','common/ico_title/list016','mobile/list','3','','','category_144','0','','0','a:7:{s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:19:\"list_pages_template\";s:0:\"\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";}');
REPLACE INTO `p8_cms_category` VALUES ('176','0','信息公开','x','article','','','','1','3','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xinxigongkai','20','article/list_xxgk','article/list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list','242','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('187','176','发展规划','f','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xinxigongkai/caiwugongshi','40','article/list','article/list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list','12','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('186','176','领导之窗','l','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xinxigongkai/jihuazongjie','40','article/list','article/list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list','15','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('185','176','财政预算','c','article','','','','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xinxigongkai/fazhanguihua','40','article/list','article/list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list','13','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('189','176','教育收费','j','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xinxigongkai/jiaoyushoufei','40','article/list','article/list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list','10','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('714','136','作品展示','z','photo','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','tupianmoxing/shidageshou','20','photo/list','photo/list_mobile','photo/view','photo/view_mobile','common/pic_title/list001c','mobile/list','0','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('770','768','学习辅导','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','wangzhanzhuanti/qunzhongluxianzhuanti/xuexifudao','30','zhuanti/list','article/list_mobile','zhuanti/view','article/view_mobile','common/ico_title/list007_zt','mobile/list','20','','','category_891','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('715','136','优秀学生','y','photo','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','tupianmoxing/dongwuzhiwu','20','photo/list','photo/list_mobile','photo/view','photo/view_mobile','common/pic_title/list001c','mobile/list','0','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('767','0','教育专题','j','article','','','','1','2','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','wangzhanzhuanti','30','article/list_new_zt1','article/list_mobile','category/view','article/view_mobile','common/ico_title/list014','mobile/list','234','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('771','768','热点关注','r','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','wangzhanzhuanti/qunzhongluxianzhuanti/redianguanzhu','30','zhuanti/list','article/list_mobile','zhuanti/view','article/view_mobile','common/ico_title/list007_zt','mobile/list','22','','','category_891','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('772','768','中央精神','z','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','wangzhanzhuanti/qunzhongluxianzhuanti/zhongyangjingshen','30','zhuanti/list','article/list_mobile','zhuanti/view','article/view_mobile','common/ico_title/list007_zt','mobile/list','25','','','category_891','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('773','768','工作动态','g','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','wangzhanzhuanti/qunzhongluxianzhuanti/gongzuodongtai','30','zhuanti/list','article/list_mobile','zhuanti/view','article/view_mobile','common/ico_title/list007_zt','mobile/list','30','','','category_891','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('774','767','创先争优','c','article','','','','2','2','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','wangzhanzhuanti/zhuanti3','30','article/list_new_zt3','article/list_mobile','article/view_zhuanti','article/view_mobile','adaption/pic_title_summary/list020','mobile/list','8','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('775','767','校园安全','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','wangzhanzhuanti/zhuanti2','30','article/list_new_zt2','article/list_mobile','article/view_zhuanti','article/view_mobile','common/ico_title/list014','mobile/list','6','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('776','0','教育概况','j','article','','','','1','4','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xueyuangaikuang','30','article/big_list','article/list_mobile','category/view','article/view_mobile','common/ico_title/list014','mobile/list','200','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('777','776','联系电话','l','article','item-view-id-1056.shtml','','','3','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xueyuangaikuang/lishiyange','30','article/list','article/list_mobile','article/view2','article/view_mobile','common/ico_title/list016','mobile/list','5','','','category_34','0','','0','a:2:{s:6:\"target\";s:6:\"_blank\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";}');
REPLACE INTO `p8_cms_category` VALUES ('778','776','教育局职能','j','page','','','','4','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xueyuangaikuang/xueyuanweiyuanhui','30','page/list3','page/list','page/view','page/view','cms/page/list','mobile/list','12','','','category_34','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('779','776','组织机构','z','article','','','','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xueyuangaikuang/zuzhijigou','30','article/list','article/list','article/view5','article/view','cms/article/list','mobile/list','10','','','category_779','0','','0','a:13:{s:6:\"target\";s:5:\"_self\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('780','776','领导班子','l','article','item-view-id-1054.shtml','','','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xueyuangaikuang/xueyuanlingdao','30','article/list','article/list_mobile','article/view2','article/view_mobile','common/ico_title/list016','mobile/list','9','','','category_34','0','','0','a:12:{s:6:\"target\";s:5:\"_self\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('781','776','教育局简介','j','page','','','','4','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xueyuangaikuang/xueyuanjianjie','30','page/list3','page/list','page/view','page/view','cms/page/list','mobile/list','13','','','category_34','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('787','0','办事指南','b','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','banshizhinan','30','article/big_list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list014','mobile/list','232','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('788','787','学生（家长）办事指南','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','banshizhinan/xueshengjiachangbanshizhinan','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','15','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('789','787','老师（学校）办事指南','l','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','banshizhinan/laoshibanshizhinan','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','13','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('791','787','便民咨询问答','b','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','banshizhinan/changjianwenti','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','8','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('792','787','常用咨询电话','c','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','banshizhinan/zixundianhua','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','4','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('793','767','阳光教育','y','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','wangzhanzhuanti/yangguangjiaoyu','30','article/list_new_zt2','article/list_mobile','article/view_zhuanti','article/view_mobile','common/ico_title/list016','mobile/list','2','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('794','0','招生考试','z','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','zhaoshengkaoshi','30','article/big_list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list014','mobile/list','236','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('795','794','高考','g','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','zhaoshengkaoshi/gaokao','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','8','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('796','794','中考','z','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','zhaoshengkaoshi/zhongkao','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','6','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('797','794','自考','z','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','zhaoshengkaoshi/zikao','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','4','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('798','794','成人考试','c','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','zhaoshengkaoshi/chengrenkaoshi','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','2','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('799','794','其他考试','q','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','zhaoshengkaoshi/qitakaoshi','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','1','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('831','0','登录','d','article','','','','2','0','0','{$core_url}/dl.html','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','denglu','30','article/list_login','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','228','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('854','1','教改动态','j','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzhongxin/jiaogaidongtai','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','4','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('834','1','教育视界','j','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzhongxin/yuanxixinwen','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','2','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('841','0','教育服务','j','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','jiaoyufuwu','30','article/list_xxgk2','article/big_list','article/view','article/view','cms/article/list','mobile/list','238','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('836','0','学校直通车','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','jiaozhigongxitong','30','article/daohang_xuesheng','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','230','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('857','176','依申请公开','y','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinxigongkai/yishenqinggongkai','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','20','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:17:\"list_title_length\";i:150;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('858','176','信息公开目录','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinxigongkai/xinxigongkaimulu','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','22','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:17:\"list_title_length\";i:150;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('859','176','组织机构','z','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinxigongkai/zuzhijigou','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','17','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('851','841','职业教育','z','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','jiaoyufuwu/zhiyejiaoyu','40','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','6','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:17:\"list_title_length\";i:150;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('850','841','特殊教育','t','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','jiaoyufuwu/tesejiaoyu','40','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','8','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:150;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('846','841','学前教育','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','jiaoyufuwu/xueqianjiaoyu','40','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','20','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:17:\"list_title_length\";i:150;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('847','841','义务教育','y','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','jiaoyufuwu/yiwujiaoyu','40','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','18','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:17:\"list_title_length\";i:150;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('848','841','高中教育','g','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','jiaoyufuwu/gaozhongjiaoyu','40','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','16','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:17:\"list_title_length\";i:150;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('849','841','高等教育','g','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','jiaoyufuwu/gaodengjiao','40','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','15','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:150;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_item` VALUES ('1','article','湖南衡阳区划调整引堵路事件 市县抢夺资源','','0','','17','','','1','','','','admin','','湖南衡阳市衡山县争夺店门镇辖权引矛盾，传因此影响人事调整，衡山县县委书记空缺一年。衡山县村民反对划并曾多次堵路。知情者称，衡阳市划并店门镇是为争夺南岳衡山的管辖权。\r\n','1','','33','','0','4','1291778075','','0','1291778075','1291778075','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('2','article','凯里官方:网吧隔壁危险化学品引发爆炸','','0','','17','','','1','','','','admin','','贵州凯里网吧爆炸已造成6死38伤，官方称事件初步确定是由于网吧隔壁存放的大量危险化学品引发。据悉事发时网吧内有45人在上网。目前2名网吧负责人及存放化学品的业主已被警方控制。\r\n','1','','24','','0','0','1291778207','','0','1291778222','1291778207','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('3','article','银行收费新规至今无下文 监管被指成&quot;保护伞&quot;','','0','','17','','','1','','','','admin','5','　　中国新闻网12月8日报道;不少市民日前反映，最近去银行办理业务，发现此前广受质疑的小额账户管理费、短信通知费等仍在收取。银行人员称;这些收费监','1','','24','','0','0','1291778283','','0','1291882516','1291778283','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('43','article','世青赛中国女乒1-3日本8年首次丢冠 男乒3比0登顶','','0','','17','','','1','','','','admin','','　　新浪体育讯　北京时间12月9日消息，在斯洛文尼亚进行的乒乓球世青赛女团决赛中，中国女队1比3不敌石川佳纯领衔的日本队，仅获得亚军。这也是中国女乒八年来首次无缘世青赛冠军。男团决赛中国队则以3比0完','1','','19','','0','0','1291882117','','0','1291882117','1291219200','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('119','article','企业站内公告1','','0','','26','','','1','','','','admin','','企业站内公告','1','','2','','0','0','1308558474','','0','1308558474','1308558474','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('120','article','企业站内公告2','','0','','26','','','1','','','','admin','','企业站内公告','1','','4','','0','0','1308558482','','0','1308558482','1308558482','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('121','article','企业站内公告3','','0','','26','','','1','','','','admin','','企业站内公告','1','','9','','0','0','1308558488','','0','1308558488','1308558488','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('122','article','企业站内公告4','','0','','26','','','1','','','','admin','','企业站内公告','1','','4','','0','0','1308558495','','0','1308558495','1308558495','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('123','article','企业站内公告5','','0','','26','','','1','','','','admin','','企业站内公告','1','','8','','0','0','1308558502','','0','1308558502','1308558502','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('124','article','企业站内公告6','','0','','26','','','1','','','','admin','','企业站内公告','1','','7','','0','0','1308558508','','0','1308558508','1308558508','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('208','article','行业动态新闻资讯测试','','0','','34','','','1','','','','admin','5','行业动态新闻资讯测试','1','','80','','0','0','1308565385','','0','1308565385','1308565385','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('232','article','本周校领导接待日（7月19日）暂停通知','','0','','128','','','1','','','','admin','','&amp;nbsp; &amp;nbsp; 因校领导另有公务安排，本周校领导接待日（7月19日）暂停一次。 &amp;nbsp;&amp;nbsp;&amp;nbsp; 需要反映问题的师生员工，请留意下次校领导接待日安排通知。','1','','61','','0','0','1345651612','','0','1345651612','1345651612','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('233','article','中国传媒大学文化产业孵化器项目征集宣讲会通知 ','','0','','128','','','1','','','','admin','','中国传媒大学文化产业孵化器企业（项目）征集宣讲会将于6月27日下午14:00在我校国际交流中心405会议室举办，欢迎感兴趣的师生踊跃参加。中国传媒大学文化产业孵化器是我校发挥大学学科优势、科研优势、人才优势实现服','1','','114','','0','0','1408885252','','0','1408885252','1345651659','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('234','article','2012年秋季辅修、辅修/双学位专业招生信息','','0','','128','','','1','','','','admin','','我校将于2012年9月开设4个辅修、辅修/双学位专业，其中包括3个辅修/双学位专业，1个辅修专业，6月15日起开始招生，欢迎各位同学咨询报名。招生时间：2012年6月15日-9月4日报名方式：具体请见教务处主页通知 链接地址','1','','73','','0','0','1345651676','','0','1345651676','1345651676','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('235','article','关于第四届全国话语语言学学术研讨会的公告','','0','','128','','','1','','','','admin','','&amp;amp;ldquo;第四届全国话语语言学学术研讨会&amp;amp;rdquo;将于2012年10月20日至21日在中国传媒大学举办。本次学术会议由中国传媒大学外国语学院和全国话语语言学研究会联合举办，旨在促进（外国）语言学及应用语言学学术界的广','1','','93','','0','0','1345651699','','0','1345651699','1345651699','1','','0','1','1','1','0','0','2','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('236','article','北京中传资产管理有限公司招聘启事','','0','','128','','','1','','','','admin','','北京中传资产管理有限公司是经教育部批准，中国传媒大学下属的国有独资有限公司。现因业务发展需要招聘人员若干，招聘事宜公告如下：&amp;amp;nbsp;一、招聘岗位及要求&amp;amp;nbsp;1、物业管理人员?&amp;amp;nbsp; 工作内容：负责物业项目日','1','','76','','0','0','1345651724','','0','1345651724','1345651724','1','','0','1','1','1','0','0','1','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('237','article','本周校领导接待日（3月15日）安排通知','','0','','128','','','1','','','','admin','','本周校领导接待日时间定于3月15日（本周四）下午14：00至16：30，负责接待的校领导为苏志武校长。&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp; 凡要反映问题的师生员工可先到39号楼109室（联系电话：9319），由党委校长办公','1','','318','','0','0','1345651763','','0','1345651763','1345651763','1','','0','1','1','1','0','0','1','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('238','article','校电视台实况直播预告','','0','','128','','','1','','','','admin','','学校电视台于6月26日全天和27日下午，通过校园有线电视网和校园互连网，在本台综合频道和视频网站，现场直播2012届本专科毕业典礼、2012届研究生毕业典礼暨学位授予仪式、&amp;amp;ldquo;中国传媒大学2010-2012年创先争优活动','1','','83','','0','0','1345651800','','0','1345651800','1345651800','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('239','article','中标公告[2012]第027号 互联网接入服务招标','','0','','128','','','1','','','','admin','2','1、采购单位： 中国传媒大学&amp;amp;nbsp; 2、项目名称： 互联网接入服务招标&amp;amp;nbsp;&amp;amp;nbsp; 3、项目编号： 中传招标[2012]第027号&amp;amp;nbsp;&amp;amp;nbsp; 4、中标人：&amp;amp;nbsp;&amp;amp;nbsp; 中国电信股份有限公司北京分公司&amp;amp;nbsp; 5、中标金额：','1','','115','','0','0','1345651832','','0','1345651832','1345651832','1','刘丰','1431221131','1','1','1','0','0','1','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('240','article','北京电视台节目评价与改版报告项目总结交流会举行','','0','','34','<!--#p8_attach#-->/cms/item/2012_08/23_00/a79f5e84a6fcbc8d.jpg.thumb.jpg','','1','','','','admin','6','&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp; 受北京市委宣传部委托，由中国传媒大学和北京电视台联合进行的北京电视台节目评价与改版报告项目已基本完成。日前，中国传媒大学与北京电视台联合举行了该项目的总结交流会。苏志武校长、刘利群副','1','','60','','0','0','1345651930','','0','1345651930','1345651930','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('241','article','袁军副校长率团参加第八届国际博士研究生学术研讨会','','0','','34','','','1','','','','admin','','2012年7月22至23日，袁军副校长率中国传媒大学师生学术代表团参加了在泰国曼谷朱拉隆公大学举办的第八届国际博士研究生学术研讨会。会议期间，袁军副校长与相关国际合作院校负责人就深化研究生合作办学、学术交流等事','1','','56','','0','0','1345651973','','0','1345651973','1345651973','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('242','article','中美大学生文化交流活动在我校举行','','0','','34','<!--#p8_attach#-->/cms/item/2012_08/23_00/afa9ec23dfb52a78.jpg.thumb.jpg','','1','','','','admin','6','2012年7月19日，由中美文化教育基金会发起、北京市委教育工委主办、中国传媒大学学生工作处承办的&amp;amp;ldquo;新世纪的丝绸之路&amp;amp;rdquo;之中美大学生文化交流活动在中国传媒大学综合实验楼400人报告厅拉开帷幕。此次活动吸','1','','63','','0','0','1345652038','','0','1345652038','1345652038','1','','0','1','1','1','0','0','0','1','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('243','article','2012夏季学期系列：坚守在火灾现场 2012夏季学期系列：坚守在火灾现场 ','','0','','34','','','1','','','','admin','','6月28日下午，台州广播电视台《600全民新闻》节目办公室的电话骤然响起，原来是该市黄岩区一家制造太空杯的工厂发生火灾。我校实习记者徐鑫和电视台另外两名记者带上设备，立即驱车赶赴火灾现场实施报道。火灾现场一','1','','93','','0','0','1345652094','','0','1345652094','1345652094','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('244','article','廖祥忠副校长率团赴清华、北师大开展科研专项调研 ','','0','','34','<!--#p8_attach#-->/cms/item/2012_08/23_00/e8823f5e58f887e7.jpg.thumb.jpg','','1','','','','admin','6','2012年7月10日，廖祥忠副校长赴清华大学、北京师范大学开展科研专项调研，文科科研处处长胡智锋等陪同调研，标志着我校人文社会科学专项系列调研活动正式启动。&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp; 为贯彻落实《教育部关于推进高等学','1','','72','','0','0','1345652188','','0','1345652188','1345652188','1','','0','1','1','1','0','0','1','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('245','article','著名影视制片人张纪中来我校讲座','','0','','34','','','1','','','','admin','','2012年7月7日下午，著名影视制片人张纪中在我校举行了一场别开生面的讲座，与同学们分享了《西游记》的创作历程。MBA学院张树庭院长为张纪中颁发了中传MBA实践导师聘书。张纪中表示，重拍《西游记》是一个巨大的挑战','1','','67','','0','0','1345652212','','0','1345652212','1345652212','1','','0','1','1','1','0','0','1','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('267','video','外交部称正在调查日本大使坐车国旗被夺事件','','0','','140','','','1','','','','admin','','外交部称正在调查日本大使坐车国旗被夺事件','1','','94','','0','0','1346204810','','0','1346233539','1346204810','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('281','video','耶鲁开放课程：古希腊历史简介','','0','','53','<!--#p8_attach#-->/cms/item/2012_09/01_21/cdd5f3b451774c11.jpg.thumb.jpg','','1','','','','admin','6','耶鲁开放课程：古希腊历史简介耶鲁开放课程：古希腊历史简介','1','','58','','0','0','1346507685','','0','1346507685','1346507685','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('282','video','耶鲁开放课程：1871年后的法国','','0','','53','<!--#p8_attach#-->/cms/item/2012_09/02_02/ed06de3b55b12af0.jpg','','1','','','','admin','6','耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国','1','','83','','0','0','1408537248','','0','1408537248','1366685777','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('283','video','麻省理工开放课程：物流管理专题','','0','','53','<!--#p8_attach#-->/cms/item/2012_09/01_21/82fa47cae98e580b.jpg.thumb.jpg','','1','','','','admin','6','麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题','1','','69','','0','0','1346507832','','0','1346507832','1346507832','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('284','video','开放课程：生物医学工程探索（一）','','0','','53','<!--#p8_attach#-->/cms/item/2014_09/01_17/593cbe81e81c1655.jpg','','1','','','','admin','6','开放课程：生物医学工程探索开放课程：生物医学工程探索','1','','88','','0','1','1346428800','','0','1409565048','1346428800','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('285','video','麻省理工学院：算法导论','','0','','53','<!--#p8_attach#-->/cms/item/2015_01/11_01/e3aaa9ee0334b92a.jpg','','1','','','','admin','3,6','麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院','1','','292','','0','0','1346428800','','0','1431236286','1346428800','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('287','photo','柠檬绿茶★居家高端精品天天低价','','0','','137','<!--#p8_attach#-->/cms/item/2012_09/02_02/0a397fd572b3d038.jpg.thumb.jpg','','1','','','','admin','6,7','柠檬绿茶★居家高端精品天天低价','1','','330','','0','0','1346515200','','0','1420552016','1346515200','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('288','article','创新中国DEMO CHINA 2013”春季赛拉开帷幕','','0','创新中国DEMO CHINA 2013”春季赛拉开帷幕','128','','','1','','','','admin','','创新中国DEMO CHINA”是由创业邦举办的一场面向国内外创业者的创业大赛，截止2012年已举办七年，吸引了包括大陆、港台、加拿大等国家地区的创业者参与，因聚集了国内外最优质的潜力项目，创新中国 ','1','','112','','0','0','1358738248','','0','1358738248','1358738248','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('306','govopen','223423423432','','0','23423','176','','','1','','','','admin','','23423423','1','','27','','0','0','1366726862','','1366726862','1366726862','1366726862','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('309','article','国微主站内容推送给分站','','0','','34','','','0','','','','','','234323243232','1','','71','','0','0','1366773633','','1366773633','1366773633','1366773633','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('311','govopen','大学召开2012年第12次校长办公会议','','0','','185','','','1','','','','admin','','&amp;amp;nbsp;9月17日，校长李元元主持召开了本年度第12次校长办公会议。&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp; 会议审议通过了吉林大学高层次人才特殊支持计划工作领导小组成员名单及有关预算追加事宜；研究了解决青年教职工周转房有关事宜；','1','','113','','0','0','1367808746','','1367808746','1367808746','1367808746','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('313','article','住建系统举行党的十七届六中全会精神专题报告会','','0','','34','http://nw3.php168.net/gov3/attachment/cms/item/2012_03/05_17/6568c6548c29d1fa.jpg','','0','','','','','','&amp;amp;nbsp; 为认真学习贯彻党的十七届六中全会，切实用全会精神统一住建系统广大党员干部群众的思想，进一步提高认识，振奋精神，推进建设系统文化大发展大繁荣。根据市委&amp;amp;laquo;中共温州市委办公室关于做好党的十七届六','1','','33','','0','0','1370495199','','1370495199','1370495199','1370495199','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('314','article','测试内容去11232','','0','','34','','','0','','','','','','1313131313','1','','588','','0','0','1370511539','','1370511539','1370511539','1370511539','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('315','article','国微站群系统---政府、大学、集团','','0','','34','','z3.php168.net/','0','','','','','','　　','1','','29','','0','0','1370542402','','1370511655','1370542402','1370511655','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('317','article','47447477','','0','','34','','http://z3.php168.net/','0','','','','','','','1','','15','','0','0','1370542689','','1370542689','1370542689','1370542689','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('322','article','股民中签后券商通知的法律责任分析','','0','','34','','','0','','','','','','原告李某与被告某证券公司于2000年10月19日签订了一份配售新股协议书。','1','','68','','0','0','1377244239','','1370738424','1377244239','1370738424','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('323','article','创新中国DEMO CHINA 2013”春季赛拉开帷幕','','0','创新中国DEMO CHINA 2013”春季赛拉开帷幕','34','','','0','','','','','','创新中国DEMO CHINA”是由创业邦举办的一场面向国内外创业者的创业大赛，截止2012年已举办七年，吸引了包括大陆、港台、加拿大等国家地区的创业者参与，因聚集了国内外最优质的潜力项目，创新中国 ','1','','89','','0','0','1370738424','','1370738424','1370738424','1370738424','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('324','article','著名影视制片人张纪中来我校讲座','','0','','34','','','0','','','','','','2012年7月7日下午，著名影视制片人张纪中在我校举行了一场别开生面的讲座，与同学们分享了《西游记》的创作历程。MBA学院张树庭院长为张纪中颁发了中传MBA实践导师聘书。张纪中表示，重拍《西游记》是一个巨大的挑战','1','','45','','0','0','1370738424','','1370738424','1370738424','1370738424','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('326','article','著名影视制片人张纪中来我校讲座','','0','','34','','','0','','','','','','2012年7月7日下午，著名影视制片人张纪中在我校举行了一场别开生面的讲座，与同学们分享了《西游记》的创作历程。MBA学院张树庭院长为张纪中颁发了中传MBA实践导师聘书。张纪中表示，重拍《西游记》是一个巨大的挑战','1','','83','','0','0','1370738424','','1370738424','1370738424','1370738424','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('327','article','凯里官方:网吧隔壁危险化学品引发爆炸','','0','','34','','','0','','','','','','贵州凯里网吧爆炸已造成6死38伤，官方称事件初步确定是由于网吧隔壁存放的大量危险化学品引发。据悉事发时网吧内有45人在上网。目前2名网吧负责人及存放化学品的业主已被警方控制。','1','','94','','0','0','1375774623','','1370738424','1375774623','1370738424','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('328','article','主站推送给分站的使用','','0','','34','','','0','','','','','','主站推送给分站的使用2234','1','','72','','0','0','1370738424','','1370738424','1370738424','1370738424','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('329','article','住建系统举行党的十七届六中全会精神专题报告会','','0','','34','http://nw3.php168.net/gov3/attachment/cms/item/2012_03/05_17/6568c6548c29d1fa.jpg','','0','','','','','','&amp;amp;nbsp; 为认真学习贯彻党的十七届六中全会，切实用全会精神统一住建系统广大党员干部群众的思想，进一步提高认识，振奋精神，推进建设系统文化大发展大繁荣。根据市委&amp;amp;laquo;中共温州市委办公室关于做好党的十七届六','1','','74','','0','0','1370738424','','1370738424','1370738424','1370738424','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('330','article','电子企业新增产值340亿 今年收入或逼近两千亿','','0','','128','','','0','','','','','','　　今年，我省电子信息产业将投产、达产、量产和扩产项目共124项，预计新增产值340亿元。至年底，全省电子信息产业销售收入约可逼近2000亿元大关。　　这是省经信委昨日公布的数据。2010年，我省电子','1','','86','','0','0','1370738424','','1370738424','1370738424','1370738424','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('331','article','国微站群主站推送内容给所有分站','','0','','128','','','0','','','','','','23423432234234232','1','','101','','0','0','1370738424','','1370738424','1370738424','1370738424','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1011','article','股民中签后券商通知的法律责任分析','','0','','128','','','0','','','','','','[案情介绍]　　原告李某与被告某证券公司于2000年10月19日签订了一份配售新股协议书。协议约定：一、原告选择被告某证券公司为二级市场配售新股的代理商，被告经审核同意接受原告的委托；二、协议签订后，如遇新股配','1','','164','','0','0','1379386844','','1379386844','1379386844','1379386844','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1017','paper','美国劳产率水平全球最高　中国进步显著','','0','','44','<!--#p8_attach#-->/cms/item/2014_09/01_17/385cdb5e20e4ed8e.jpg','','0','','','','','1,6,7','2日发布《劳动力市场主要指标(第五版)》的报告显示，美国依然是全球劳动生产率最高的国家，中国劳动生产率提高速度很快。（详见第三版）','1','','244','','0','0','1393171200','','1379420676','1409564906','1393171200','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1019','paper','发展改革委：中国没有出现严重的通货膨胀','','0','','34','','','0','','','','','','据新华社北京9月4日电(记者张毅　江国成)　国家发展和改革委员会副主任毕井泉4日说，虽然今年前七个月我国居民消费价格总水平比上年同期上涨3.5%，但主要是食品价格上涨的拉动，物价总体上仍处于可控范围，没有出现由','1','','95','','0','0','1379420676','','1379420676','1379420676','1379420676','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1020','paper','新龙船“浦江游览1号”亮相上海黄浦江','','0','','34','','','0','','','','','','新龙船&ldquo;浦江游览1号&rdquo;亮相上海黄浦江　　9月3日，&ldquo;浦江游览1号&rdquo;龙船载着游客在黄浦江上观光。当日，一艘全新的仿古龙船&ldquo;浦江游览1号&rdquo;加入上海黄浦江水上游览运营，以替代&ldquo;','1','','59','','0','0','1379420676','','1379420676','1379420676','1379420676','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1021','article','西藏首个国家公园雅鲁藏布大峡谷国家公园建成','','0','','44','','','0','','','','','5','新华网林芝12月8日电  6日，西藏首个国家公园——雅鲁藏布大峡谷国家公园正式建成。','1','','80','','0','0','1379420676','','1379420676','1379420676','1379420676','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1022','article','社科院称2010住宅市场量价齐升 调控中再现回落','','0','','44','<!--#p8_attach#-->/cms/item/2010_12/08_11/1b2a4988ed469903.jpg.thumb.jpg','','0','','','','','','由中国社会科学院财政与贸易经济研究所、社会科学文献出版社联合主办的“2011年《住房绿皮书》发布暨2010~2011年住房形势与政策研讨会”8日在北京举行。','1','','67','','0','0','1379420676','','1379420676','1379420676','1379420676','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1023','article','中美大学生文化交流活动在我校举行','','0','','44','<!--#p8_attach#-->/cms/item/2012_08/23_00/afa9ec23dfb52a78.jpg.thumb.jpg','','0','','','','','','2012年7月19日，由中美文化教育基金会发起、北京市委教育工委主办、中国传媒大学学生工作处承办的&ldquo;新世纪的丝绸之路&rdquo;之中美大学生文化交流活动在中国传媒大学综合实验楼400人报告厅拉开帷幕。此次活动吸','1','','152','','0','0','1379420676','','1379420676','1379420676','1379420676','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1027','article','理论学习工作台指导意见','','0','','47','','','1','','','','admin','','理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习','1','','32','','0','0','1393140327','','1393140327','1393140327','1393140327','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1029','article','中国高校毕业生数量10年翻了一番 就业人数再创历史新高','','0','','44','','','1','','','','admin','2','  政府工作报告提出，今年高校毕业生将达727万人，要开发更多就业岗位，实施不间断的就业创业服务，提高大学生就业创业比例','1','','92','','0','0','1398590182','','1394984958','1398590182','1394984958','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1046','article','关于开展2014年青年全球治理创新设计大赛','','0','','44','','','1','','','','admin','','青年全球治理创新设计大赛（Youth Innovation Competition on Global Governance，简称&amp;amp;ldquo;YICGG&amp;amp;rdquo;）是由复旦大学国际关系与公共事务学院于2007年创办、复旦大学和联合国开发计划署联合主办的一项赛事活动。它面向全球所有高校青年征集智慧与创意，解决人类命运','1','','64','','0','0','1399118224','','1399118224','1399118224','1399118224','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1047','article','我校举行“五一”劳动节座谈会','','0','','44','','','1','','','','admin','','4月29日，我校在主楼824室举行&amp;amp;ldquo;五一&amp;amp;rdquo;劳动节座谈会。学校领导傅广生、王余丁、王凤鸣、王培光、杨立海出席会议。各级劳动模范、&amp;amp;ldquo;三育人&amp;amp;rdquo;先进个人及我校模范教师代表，党办、校办、宣传部、工会等部门负责人参加了会议。劳模代表一一发言，讲述了','1','','48','','0','0','1399118264','','1399118264','1399118264','1399118264','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1048','article','“校园杯”篮球联赛圆满落幕','','0','','44','','','1','','','','admin','','4月25日下午，历时10天的2014年河北大学&amp;amp;ldquo;校园杯&amp;amp;rdquo;篮球赛落下帷幕。本次比赛有23支代表队345名运动员参加，共举行85场比赛。比赛采用男女生混合组队的形式。经过激烈角逐，工商学院、电子信息工程学院、政法学院、经济学院、新闻传播学院、质量技术监督学院、','1','','57','','0','0','1399118285','','1399118285','1399118285','1399118285','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1049','article','我校召开校级党员领导干部学习汇报会','','0','','128','','','1','','','','admin','','根据省委督导组的要求，为充分发挥党员领导干部在教育实践活动中的带头示范作用，4月23日下午，我校在主楼304报告厅召开了校级党员领导干部学习汇报会。省委督导组组长李益民，常务副组长鲁杰，副组长杨造成，以及沈建国、靳学军、张学工等领导同志，学校领导，近三年退','1','','86','','0','0','1408885160','','1399118350','1408885160','1399118350','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1050','article','我校举行青年志愿者表彰大会','','0','','44','','','1','刘先生','','','admin','','4月19日下午， 2013—2014年度青年志愿者表彰大会在图书馆报告厅举行。大会对我校在2013年度志愿服务工作中表现突出的集体和个人进行了表彰。党委常委王培光对我校志愿服务工作取得的成绩给予了肯定，希望志愿者工作要与青年学生的教育培养相结合，全面提高志愿服务','1','','89','','0','0','1408885180','','1399118414','1408885180','1399118414','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1052','down','学校通讯录联系表','','0','','144','','','1','','','','admin','','23423432','1','','67','','0','0','1408849436','','1408849436','1408849436','1408849436','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1054','article','领导班子','','0','','780','','','1','','','','admin','','局长:杨靖主持市教育局全面工作。联系电话：2366011823党组书记：梁凤主持市教育局党组工作。联系电话：236603823调研员：黄海分管办公室（市语言文字工作委员会）、计划财务科、市教育信息中心、市教育装备中心、市教育基金会。联系电话：236604823牳本殖ぁ⑹薪逃&#65533;','1','','290','','0','0','1408809600','','1408851788','1437221825','1408809600','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1055','article','组织机构','','0','','779','<!--#p8_attach#-->/cms/item/2015_05/23_08/def29b9c7dd0d591.jpg','','1','','','','admin','6','','1','','495','','0','0','1408809600','','1408851902','1511778413','1408809600','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1056','article','联系电话','','0','','777','','','1','','','','admin','','　','1','','242','','0','0','1408809600','','1408851984','1438006701','1408809600','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1058','article','缘梦彩云支教团土木学院支教队云南昭通支教','#ee1d24','0','','44','<!--#p8_attach#-->/cms/item/2014_09/10_22/f06d99571a5d25c2.jpg','','1','','','','admin','1,6','2014年暑期缘梦彩云支教活动于 2014年7月18日至8月5日在云南省昭通市彝良县举行。本次支教活动共有三个支队，第一支队12人，由土木学院学生9名13级学生及3名12级学生组成，支教地为云南省昭通市彝良县奎乡仙','1','','198','','0','0','1410278400','','1410357357','1511764726','1410278400','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1059','article','我院举行2014级研究生新生开学典礼','','0','','44','','','1','','','','admin','','朗朗金秋，丹桂飘香。土木工程学院又迎来了307名硕士研究生和46名博士研究生。9月5日下午2点半，湖南大学土木工程学院2014级研究生新生开学典礼在复临舍301隆重举行。院长肖岩，院党委书记赵明华,副院长易伟建，院务委员李正农莅临大会，外专千人计划学者S.Kunnath,&nbs','1','','48','','0','0','1410278400','','1410359902','1410359956','1410278400','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1060','article','中秋送欢乐 有爱更温暖','','0','','44','','','1','','','','admin','','9月8日，正值中秋佳节，一户家庭贫困的三胞胎孩子的家中一片欢声笑语。来自土木工程学院红十字分会的3名志愿者，给这户三胞胎家庭送去了温暖和关爱。当志愿者们到达三胞胎小朋友的家中时，小朋友们十分高兴。小朋友们拉着志愿者到客厅围坐一圈，并给志愿者唱了一首ABC歌','1','','52','','0','0','1410360021','','1410360021','1410360021','1410360021','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1061','article','工程学院红十字分会暑期社会实践活动总结','','0','','44','<!--#p8_attach#-->/cms/item/2015_05/23_08/9a720b9fd38c67fb.jpg','','1','','','','admin','6','7月3日上午，土木工程学院红十字分会暑期社会实践团的团员们向来自钱塘博文小学的留守儿童宣传防水、防火的相关知识，也向小朋友们及其家长们讲解了一些常用药品的正确使用方法，纠正日常生活中常见的药品错误使用方法。此外，团员们还在现场向小朋友展示几种应急的包扎','1','','123','','0','0','1410278400','','1410360065','1432341396','1410278400','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1062','article','人民日报评论员：以“三种意识”推进全面深化改革','','0','','44','','','1','','','','admin','','历经35年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼&amp;amp;ldquo;两个一百年&amp;amp;rdquo;目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的','1','','48','','0','0','1410360106','','1410360106','1410360106','1410360106','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1063','article','2014年硕士研究生招生复试及录取工作流程','','0','','44','','','1','','','','admin','','研究生教育招生简介导师信息考试目录及大纲学科方向资讯动态您现在的位置：&amp;amp;nbsp;土木工程学院&amp;amp;nbsp;&amp;gt;&amp;gt;&amp;amp;nbsp;研究生教育&amp;amp;nbsp;&amp;gt;&amp;gt;&amp;amp;nbsp;资讯动态&amp;amp;nbsp;&amp;gt;&amp;gt;&amp;amp;nbsp;正文福建工程学院土木工程学院2014年硕士研究生招生复试及录取工作流程文章来源：本站原创&amp;amp;nbsp;&','1','','60','','0','0','1410360151','','1410360151','1410360151','1410360151','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1064','article','播洒爱心 放飞希望 努力促进教育公平提升教育质量','','0','','44','<!--#p8_attach#-->/cms/item/2015_05/23_08/6bda83cf89e6cf65.jpg','','1','','','','admin','6','9月9日上午，在笫29个教师节来临之际，中共中央政治局常委、国务院总理李克强在大连考察并看望师生，与基层教师座谈。　　大连二十高中安静的校园里，学生们正在上课。李克强走进教师办公室，看到总理，教师们纷纷围拢过来。李克强说，教师永远是天底下最受人尊敬的职业','1','','123','','0','0','1410278400','','1410360231','1432341362','1410278400','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1065','article','“24字”核心价值观具有强大认同力和凝聚力','','0','','44','','','1','','','','admin','','十八大报告对社会主义核心价值体系建设提出了新部署新要求，强调&amp;amp;ldquo;要深入开展社会主义核心价值体系学习教育，用社会主义核心价值体系引领社会思潮、凝聚社会共识&amp;amp;rdquo;，&amp;amp;ldquo;倡导富强、民主、文明、和谐，倡导自由、平等、公正、法治，倡导爱国、敬业、诚信、友','1','','113','','0','0','1410360259','','1410360259','1410360259','1410360259','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1066','article','教育部关于切实加强和改学风建设的实施意见','','0','','44','','','1','','','','admin','','&amp;amp;nbsp;各省、自治区、直辖市教育厅（教委），新疆生产建设兵团教育局，有关部门（单位）教育司（局），部属各高等学校：　　为贯彻党的十七届六中全会&amp;amp;ldquo;深化政风、行风建设，开展道德领域突出问题专项教育和治理&amp;amp;rdquo;的精神，落实《国家中长期教育改革和发展规划','1','','106','','0','0','1410360358','','1410360358','1410360358','1410360358','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1067','article','教育部关于切实加强和改学风建设的实施意见','','0','','128','','','1','','','','admin','','&nbsp;各省、自治区、直辖市教育厅（教委），新疆生产建设兵团教育局，有关部门（单位）教育司（局），部属各高等学校：　　为贯彻党的十七届六中全会&ldquo;深化政风、行风建设，开展道德领域突出问题专项教育和治理&rdquo;的精神，落实《国家中长期教育改革和发展规划','1','','111','','0','0','1415764673','','1415764673','1415764673','1415764673','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1068','article','教育部关于切实加强和改学风建设的实施意见','','0','','128','','','1','','','','admin','','&nbsp;各省、自治区、直辖市教育厅（教委），新疆生产建设兵团教育局，有关部门（单位）教育司（局），部属各高等学校：　　为贯彻党的十七届六中全会&ldquo;深化政风、行风建设，开展道德领域突出问题专项教育和治理&rdquo;的精神，落实《国家中长期教育改革和发展规划','1','','142','','0','0','1415764749','','1415764749','1415764749','1415764749','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1076','article','人民日报评论员：以“三种意识”推进全面深化改革','','0','','128','','','0','','','','admin','','历经35年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼&ldquo;两个一百年&rdquo;目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的','1','','107','','0','0','1431834918','','1431834918','1431834918','1431834918','1','admin','1450407528','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1077','article','市属高校三年规划建设项目开展专项稽察','','0','','128','','','0','','','','admin','','市发展改革委对部分市属高校三年规划建设项目开展专项稽察。为了加强对我市重点建设项目稽察监管，市发展改革委近日对北方工业大学、首都师范大学和北京第二外国语学院3所院校的6个建设项目开展了专项稽察，重点对项目进度情况、资金到位及使用情况；履行基本建设程序、','1','','398','','0','0','1431834918','','1431834918','1431834918','1431834918','1','admin','1431835200','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1078','article','人民日报评论员：以“三种意识”推进全面深化改革','','0','','128','','','0','','','','admin','','历经35年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼&ldquo;两个一百年&rdquo;目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的','1','','218','','0','0','1431835066','','1431835066','1431835066','1431835066','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1079','article','市属高校三年规划建设项目开展专项稽察','','0','','128','<!--#p8_attach#-->/cms/item/2015_05/23_08/def29b9c7dd0d591.jpg','','0','','','','admin','6','市发展改革委对部分市属高校三年规划建设项目开展专项稽察。为了加强对我市重点建设项目稽察监管，市发展改革委近日对北方工业大学、首都师范大学和北京第二外国语学院3所院校的6个建设项目开展了专项稽察，重点对项目进度情况、资金到位及使用情况；履行基本建设程序、','1','','110','','0','0','1431792000','','1431835066','1432341455','1431792000','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1080','article','专家上海研讨大城市规划 绿色可持续城市仍为热点','','0','','44','<!--#p8_attach#-->/cms/item/2015_05/23_08/2491223fbece3b6d.jpg','','0','','','','admin','6','“新型城镇化”现已成为一个全民议题。如何走新型城镇化道路，需要全社会尤其是“规划师”的探索与创新。作为担当城乡规划重任的“青年规划师”的思考及探索，将为中国新型城镇化实践提供新的思路。　　17日，以“新型城镇化与城乡规','1','','213','','0','0','1431792000','','1431835066','1432341331','1431792000','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1085','article','工程学院红十字分会暑期社会实践活动总结','','0','','128','<!--#p8_attach#-->/cms/item/2015_05/23_08/9a720b9fd38c67fb.jpg','','1','','','','admin','1,2,6','7月3日上午，土木工程学院红十字分会暑期社会实践团的团员们向来自钱塘博文小学的留守儿童宣传防水、防火的相关知识，也向小朋友们及其家长们讲解了一些常用药品的正确使用方法，纠正日常生活中常见的药品错误使用方法。此外，团员们还在现场向小朋友展示几种应急的包扎','1','','725','','0','0','1433865600','','1433905343','1442676786','1433865600','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1102','page','教育局简介','','0','','781','','','1','','','','admin','','　　 广东省国微市教育局　　　　Guanzhou guowei soft Technology CO.,Ltd　　百年大计，教育为本，教育的发展是城市现代化建设的坚实基础。东莞市委、市政府充分认识到教育的重要意义，历来高度重视教育，把教育作为战略发展重点，确定科教兴市和人才强市战略，采取重','1','','91','','0','0','1581930868','','1581930868','1581931410','1581930868','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1103','video','耶鲁开放课程：古希腊历史简介','','0','','141','<!--#p8_attach#-->/cms/item/2012_09/01_21/cdd5f3b451774c11.jpg.thumb.jpg','','1','','','','admin','6','耶鲁开放课程：古希腊历史简介耶鲁开放课程：古希腊历史简介','1','','24','','0','0','1582019825','','1582019838','1582019838','1582019825','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1104','video','耶鲁开放课程：1871年后的法国','','0','','141','<!--#p8_attach#-->/cms/item/2012_09/02_02/ed06de3b55b12af0.jpg','','1','','','','admin','6','耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国','1','','8','','0','0','1582019825','','1582019838','1582019838','1582019825','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1105','video','麻省理工开放课程：物流管理专题','','0','','141','<!--#p8_attach#-->/cms/item/2012_09/01_21/82fa47cae98e580b.jpg.thumb.jpg','','1','','','','admin','6','麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题','1','','11','','0','0','1582019825','','1582019838','1582019838','1582019825','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1106','video','开放课程：生物医学工程探索（一）','','0','','141','<!--#p8_attach#-->/cms/item/2014_09/01_17/593cbe81e81c1655.jpg','','1','','','','admin','6','开放课程：生物医学工程探索开放课程：生物医学工程探索','1','','4','','0','0','1582019825','','1582019838','1582019838','1582019825','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1107','video','麻省理工学院：算法导论','','0','','141','<!--#p8_attach#-->/cms/item/2015_01/11_01/e3aaa9ee0334b92a.jpg','','1','','','','admin','6','麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院','1','','3','','0','0','1582019825','','1582019838','1582019838','1582019825','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1108','article','市属高校三年规划建设项目开展专项稽察','','0','','774','<!--#p8_attach#-->/cms/item/2015_05/23_08/def29b9c7dd0d591.jpg','','1','','','','admin','6','市发展改革委对部分市属高校三年规划建设项目开展专项稽察。为了加强对我市重点建设项目稽察监管，市发展改革委近日对北方工业大学、首都师范大学和北京第二外国语学院3所院校的6个建设项目开展了专项稽察，重点对项目进度情况、资金到位及使用情况；履行基本建设程序、','1','','47','|','0','0','1582086160','','1582086172','1582086172','1582086160','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1109','article','工程学院红十字分会暑期社会实践活动总结','','0','','774','<!--#p8_attach#-->/cms/item/2020_03/05_09/7b3f9fe8d69e5c40.jpg.thumb.jpg','','1','','','','admin','6','7月3日上午，土木工程学院红十字分会暑期社会实践团的团员们向来自钱塘博文小学的留守儿童宣传防水、防火的相关知识，也向小朋友们及其家长们讲解了一些常用药品的正确使用方法，纠正日常生活中常见的药品错误使用方法。此外，团员们还在现场向小朋友展示几种应急的包扎','1','','11','部门1（交流处）|','0','0','1582086160','','1582086172','1583371344','1582086160','1','adminroot','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1110','page','教育局职能','','0','','778','<!--#p8_attach#-->/ueditor/image/20150718/1437221655116667.jpg','','1','','','','admin','','','1','','17','','0','0','1582098607','','1582098607','1582098607','1582098607','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1','article','17','1','admin','湖南衡阳区划调整引堵路事件 市县抢夺资源','','0','','','','','','湖南衡阳市衡山县争夺店门镇辖权引矛盾，传因此影响人事调整，衡山县县委书记空缺一年。衡山县村民反对划并曾多次堵路。知情者称，衡阳市划并店门镇是为争夺南岳衡山的管辖权。\r\n','','','','','','1','','0','1291778075','0','1291778075','1291778075','1','','','33','0','4','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('2','article','17','1','admin','凯里官方:网吧隔壁危险化学品引发爆炸','','0','','','','','','贵州凯里网吧爆炸已造成6死38伤，官方称事件初步确定是由于网吧隔壁存放的大量危险化学品引发。据悉事发时网吧内有45人在上网。目前2名网吧负责人及存放化学品的业主已被警方控制。\r\n','','','','','','1','','0','1291778207','0','1291778207','1291778222','1','','','24','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('3','article','17','1','admin','银行收费新规至今无下文 监管被指成&quot;保护伞&quot;','','0','','','','','5','　　中国新闻网12月8日报道;不少市民日前反映，最近去银行办理业务，发现此前广受质疑的小额账户管理费、短信通知费等仍在收取。银行人员称;这些收费监','','','','','','1','','0','1291778283','0','1291778283','1291882516','1','','','24','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('43','article','17','1','admin','世青赛中国女乒1-3日本8年首次丢冠 男乒3比0登顶','','0','','','','','','　　新浪体育讯　北京时间12月9日消息，在斯洛文尼亚进行的乒乓球世青赛女团决赛中，中国女队1比3不敌石川佳纯领衔的日本队，仅获得亚军。这也是中国女乒八年来首次无缘世青赛冠军。男团决赛中国队则以3比0完','','','','','','1','','0','1291882117','0','1291219200','1291882117','1','','','19','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('119','article','26','1','admin','企业站内公告1','','0','','','','','','企业站内公告','','','','','','1','','0','1308558474','0','1308558474','1308558474','1','','','2','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('120','article','26','1','admin','企业站内公告2','','0','','','','','','企业站内公告','','','','','','1','','0','1308558482','0','1308558482','1308558482','1','','','4','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('121','article','26','1','admin','企业站内公告3','','0','','','','','','企业站内公告','','','','','','1','','0','1308558488','0','1308558488','1308558488','1','','','9','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('122','article','26','1','admin','企业站内公告4','','0','','','','','','企业站内公告','','','','','','1','','0','1308558495','0','1308558495','1308558495','1','','','4','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('123','article','26','1','admin','企业站内公告5','','0','','','','','','企业站内公告','','','','','','1','','0','1308558502','0','1308558502','1308558502','1','','','8','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('124','article','26','1','admin','企业站内公告6','','0','','','','','','企业站内公告','','','','','','1','','0','1308558508','0','1308558508','1308558508','1','','','7','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('208','article','34','1','admin','行业动态新闻资讯测试','','0','','','','','5','行业动态新闻资讯测试','','','','','','1','','0','1308565385','0','1308565385','1308565385','1','','','80','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('232','article','128','1','admin','本周校领导接待日（7月19日）暂停通知','','0','','','','','','&amp;nbsp; &amp;nbsp; 因校领导另有公务安排，本周校领导接待日（7月19日）暂停一次。 &amp;nbsp;&amp;nbsp;&amp;nbsp; 需要反映问题的师生员工，请留意下次校领导接待日安排通知。','','','','','','1','','0','1345651612','0','1345651612','1345651612','1','','','61','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('233','article','128','1','admin','中国传媒大学文化产业孵化器项目征集宣讲会通知 ','','0','','','','','','中国传媒大学文化产业孵化器企业（项目）征集宣讲会将于6月27日下午14:00在我校国际交流中心405会议室举办，欢迎感兴趣的师生踊跃参加。中国传媒大学文化产业孵化器是我校发挥大学学科优势、科研优势、人才优势实现服','','','','','','1','','0','1408885252','0','1345651659','1408885252','1','','','114','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('234','article','128','1','admin','2012年秋季辅修、辅修/双学位专业招生信息','','0','','','','','','我校将于2012年9月开设4个辅修、辅修/双学位专业，其中包括3个辅修/双学位专业，1个辅修专业，6月15日起开始招生，欢迎各位同学咨询报名。招生时间：2012年6月15日-9月4日报名方式：具体请见教务处主页通知 链接地址','','','','','','1','','0','1345651676','0','1345651676','1345651676','1','','','73','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('235','article','128','1','admin','关于第四届全国话语语言学学术研讨会的公告','','0','','','','','','&amp;amp;ldquo;第四届全国话语语言学学术研讨会&amp;amp;rdquo;将于2012年10月20日至21日在中国传媒大学举办。本次学术会议由中国传媒大学外国语学院和全国话语语言学研究会联合举办，旨在促进（外国）语言学及应用语言学学术界的广','','','','','','1','','0','1345651699','0','1345651699','1345651699','1','','','93','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('236','article','128','1','admin','北京中传资产管理有限公司招聘启事','','0','','','','','','北京中传资产管理有限公司是经教育部批准，中国传媒大学下属的国有独资有限公司。现因业务发展需要招聘人员若干，招聘事宜公告如下：&amp;amp;nbsp;一、招聘岗位及要求&amp;amp;nbsp;1、物业管理人员?&amp;amp;nbsp; 工作内容：负责物业项目日','','','','','','1','','0','1345651724','0','1345651724','1345651724','1','','','76','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('237','article','128','1','admin','本周校领导接待日（3月15日）安排通知','','0','','','','','','本周校领导接待日时间定于3月15日（本周四）下午14：00至16：30，负责接待的校领导为苏志武校长。&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp; 凡要反映问题的师生员工可先到39号楼109室（联系电话：9319），由党委校长办公','','','','','','1','','0','1345651763','0','1345651763','1345651763','1','','','318','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('238','article','128','1','admin','校电视台实况直播预告','','0','','','','','','学校电视台于6月26日全天和27日下午，通过校园有线电视网和校园互连网，在本台综合频道和视频网站，现场直播2012届本专科毕业典礼、2012届研究生毕业典礼暨学位授予仪式、&amp;amp;ldquo;中国传媒大学2010-2012年创先争优活动','','','','','','1','','0','1345651800','0','1345651800','1345651800','1','','','83','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('239','article','128','1','admin','中标公告[2012]第027号 互联网接入服务招标','','0','','','','','2','1、采购单位： 中国传媒大学&amp;amp;nbsp; 2、项目名称： 互联网接入服务招标&amp;amp;nbsp;&amp;amp;nbsp; 3、项目编号： 中传招标[2012]第027号&amp;amp;nbsp;&amp;amp;nbsp; 4、中标人：&amp;amp;nbsp;&amp;amp;nbsp; 中国电信股份有限公司北京分公司&amp;amp;nbsp; 5、中标金额：','','','','','','1','刘丰','1431221131','1345651832','0','1345651832','1345651832','1','','','115','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('240','article','34','1','admin','北京电视台节目评价与改版报告项目总结交流会举行','','0','','<!--#p8_attach#-->/cms/item/2012_08/23_00/a79f5e84a6fcbc8d.jpg.thumb.jpg','','','6','&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp; 受北京市委宣传部委托，由中国传媒大学和北京电视台联合进行的北京电视台节目评价与改版报告项目已基本完成。日前，中国传媒大学与北京电视台联合举行了该项目的总结交流会。苏志武校长、刘利群副','','','','','','1','','0','1345651930','0','1345651930','1345651930','1','','','60','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('241','article','34','1','admin','袁军副校长率团参加第八届国际博士研究生学术研讨会','','0','','','','','','2012年7月22至23日，袁军副校长率中国传媒大学师生学术代表团参加了在泰国曼谷朱拉隆公大学举办的第八届国际博士研究生学术研讨会。会议期间，袁军副校长与相关国际合作院校负责人就深化研究生合作办学、学术交流等事','','','','','','1','','0','1345651973','0','1345651973','1345651973','1','','','56','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('242','article','34','1','admin','中美大学生文化交流活动在我校举行','','0','','<!--#p8_attach#-->/cms/item/2012_08/23_00/afa9ec23dfb52a78.jpg.thumb.jpg','','','6','2012年7月19日，由中美文化教育基金会发起、北京市委教育工委主办、中国传媒大学学生工作处承办的&amp;amp;ldquo;新世纪的丝绸之路&amp;amp;rdquo;之中美大学生文化交流活动在中国传媒大学综合实验楼400人报告厅拉开帷幕。此次活动吸','','','','','','1','','0','1345652038','0','1345652038','1345652038','1','','','63','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('243','article','34','1','admin','2012夏季学期系列：坚守在火灾现场 2012夏季学期系列：坚守在火灾现场 ','','0','','','','','','6月28日下午，台州广播电视台《600全民新闻》节目办公室的电话骤然响起，原来是该市黄岩区一家制造太空杯的工厂发生火灾。我校实习记者徐鑫和电视台另外两名记者带上设备，立即驱车赶赴火灾现场实施报道。火灾现场一','','','','','','1','','0','1345652094','0','1345652094','1345652094','1','','','93','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('244','article','34','1','admin','廖祥忠副校长率团赴清华、北师大开展科研专项调研 ','','0','','<!--#p8_attach#-->/cms/item/2012_08/23_00/e8823f5e58f887e7.jpg.thumb.jpg','','','6','2012年7月10日，廖祥忠副校长赴清华大学、北京师范大学开展科研专项调研，文科科研处处长胡智锋等陪同调研，标志着我校人文社会科学专项系列调研活动正式启动。&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp; 为贯彻落实《教育部关于推进高等学','','','','','','1','','0','1345652188','0','1345652188','1345652188','1','','','72','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('245','article','34','1','admin','著名影视制片人张纪中来我校讲座','','0','','','','','','2012年7月7日下午，著名影视制片人张纪中在我校举行了一场别开生面的讲座，与同学们分享了《西游记》的创作历程。MBA学院张树庭院长为张纪中颁发了中传MBA实践导师聘书。张纪中表示，重拍《西游记》是一个巨大的挑战','','','','','','1','','0','1345652212','0','1345652212','1345652212','1','','','67','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('288','article','128','1','admin','创新中国DEMO CHINA 2013”春季赛拉开帷幕','','0','创新中国DEMO CHINA 2013”春季赛拉开帷幕','','','','','创新中国DEMO CHINA”是由创业邦举办的一场面向国内外创业者的创业大赛，截止2012年已举办七年，吸引了包括大陆、港台、加拿大等国家地区的创业者参与，因聚集了国内外最优质的潜力项目，创新中国 ','','','','','创新中国,DEMO ,CHINA, 2013,春季赛拉开帷幕','1','','0','1358738248','0','1358738248','1358738248','1','','','112','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('309','article','34','0','','国微主站内容推送给分站','','0','','','','','','234323243232','媒体主站|http://z.php168.net','','','','','1','','0','1366773633','1366773633','1366773633','1366773633','1','','','71','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('313','article','34','0','','住建系统举行党的十七届六中全会精神专题报告会','','0','','http://nw3.php168.net/gov3/attachment/cms/item/2012_03/05_17/6568c6548c29d1fa.jpg','','','','&amp;amp;nbsp; 为认真学习贯彻党的十七届六中全会，切实用全会精神统一住建系统广大党员干部群众的思想，进一步提高认识，振奋精神，推进建设系统文化大发展大繁荣。根据市委&amp;amp;laquo;中共温州市委办公室关于做好党的十七届六','政府分站2|http://nw3.php168.net/gov7','','','','','1','','0','1370495199','1370495199','1370495199','1370495199','1','','','33','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('314','article','34','0','','测试内容去11232','','0','','','','','','1313131313','政府分站1|http://nw3.php168.net','','','','','1','','0','1370511539','1370511539','1370511539','1370511539','1','','','588','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('315','article','34','0','','国微站群系统---政府、大学、集团','','0','','','','z3.php168.net/','','　　','政府分站1|http://nw3.php168.net','','','','','1','','0','1370542402','1370511655','1370511655','1370542402','1','','','29','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('317','article','34','0','','47447477','','0','','','','http://z3.php168.net/','','','学校分站1|http://z3.php168.net','','','','','1','','0','1370542689','1370542689','1370542689','1370542689','1','','','15','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('322','article','34','0','','股民中签后券商通知的法律责任分析','','0','','','','','','原告李某与被告某证券公司于2000年10月19日签订了一份配售新股协议书。','政府分站1|http://nw3.php168.net','','','','','1','','0','1377244239','1370738424','1370738424','1377244239','1','','','68','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('323','article','34','0','','创新中国DEMO CHINA 2013”春季赛拉开帷幕','','0','创新中国DEMO CHINA 2013”春季赛拉开帷幕','','','','','创新中国DEMO CHINA”是由创业邦举办的一场面向国内外创业者的创业大赛，截止2012年已举办七年，吸引了包括大陆、港台、加拿大等国家地区的创业者参与，因聚集了国内外最优质的潜力项目，创新中国 ','学校分站1|http://z3.php168.net','','','','创新中国,DEMO ,CHINA, 2013,春季赛拉开帷幕','1','','0','1370738424','1370738424','1370738424','1370738424','1','','','89','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('324','article','34','0','','著名影视制片人张纪中来我校讲座','','0','','','','','','2012年7月7日下午，著名影视制片人张纪中在我校举行了一场别开生面的讲座，与同学们分享了《西游记》的创作历程。MBA学院张树庭院长为张纪中颁发了中传MBA实践导师聘书。张纪中表示，重拍《西游记》是一个巨大的挑战','学校分站1|http://z3.php168.net','','','','','1','','0','1370738424','1370738424','1370738424','1370738424','1','','','45','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('326','article','34','0','','著名影视制片人张纪中来我校讲座','','0','','','','','','2012年7月7日下午，著名影视制片人张纪中在我校举行了一场别开生面的讲座，与同学们分享了《西游记》的创作历程。MBA学院张树庭院长为张纪中颁发了中传MBA实践导师聘书。张纪中表示，重拍《西游记》是一个巨大的挑战','学校分站1|http://z3.php168.net','','','','','1','','0','1370738424','1370738424','1370738424','1370738424','1','','','83','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('327','article','34','0','','凯里官方:网吧隔壁危险化学品引发爆炸','','0','','','','','','贵州凯里网吧爆炸已造成6死38伤，官方称事件初步确定是由于网吧隔壁存放的大量危险化学品引发。据悉事发时网吧内有45人在上网。目前2名网吧负责人及存放化学品的业主已被警方控制。','门户分站1|http://z1.php168.net','','','','','1','','0','1375774623','1370738424','1370738424','1375774623','1','','','94','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('328','article','34','0','','主站推送给分站的使用','','0','','','','','','主站推送给分站的使用2234','媒体主站|http://z.php168.net','','','','','1','','0','1370738424','1370738424','1370738424','1370738424','1','','','72','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('329','article','34','0','','住建系统举行党的十七届六中全会精神专题报告会','','0','','http://nw3.php168.net/gov3/attachment/cms/item/2012_03/05_17/6568c6548c29d1fa.jpg','','','','&amp;amp;nbsp; 为认真学习贯彻党的十七届六中全会，切实用全会精神统一住建系统广大党员干部群众的思想，进一步提高认识，振奋精神，推进建设系统文化大发展大繁荣。根据市委&amp;amp;laquo;中共温州市委办公室关于做好党的十七届六','政府分站2|http://nw3.php168.net/gov7','','','','','1','','0','1370738424','1370738424','1370738424','1370738424','1','','','74','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('330','article','128','0','','电子企业新增产值340亿 今年收入或逼近两千亿','','0','','','','','','　　今年，我省电子信息产业将投产、达产、量产和扩产项目共124项，预计新增产值340亿元。至年底，全省电子信息产业销售收入约可逼近2000亿元大关。　　这是省经信委昨日公布的数据。2010年，我省电子','政府分站2|http://nw3.php168.net/gov7','','','','','1','','0','1370738424','1370738424','1370738424','1370738424','1','','','86','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('331','article','128','0','','国微站群主站推送内容给所有分站','','0','','','','','','23423432234234232','国微站群主站|http://z.php168.net','','','','','1','','0','1370738424','1370738424','1370738424','1370738424','1','','','101','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1011','article','128','0','','股民中签后券商通知的法律责任分析','','0','','','','','','[案情介绍]　　原告李某与被告某证券公司于2000年10月19日签订了一份配售新股协议书。协议约定：一、原告选择被告某证券公司为二级市场配售新股的代理商，被告经审核同意接受原告的委托；二、协议签订后，如遇新股配','政府分站1|http://nw3.php168.net','','','','','1','','0','1379386844','1379386844','1379386844','1379386844','1','','','164','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1021','article','44','0','','西藏首个国家公园雅鲁藏布大峡谷国家公园建成','','0','','','','','5','新华网林芝12月8日电  6日，西藏首个国家公园——雅鲁藏布大峡谷国家公园正式建成。','学校分站1|http://z3.php168.net','','','','','1','','0','1379420676','1379420676','1379420676','1379420676','1','','','80','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1022','article','44','0','','社科院称2010住宅市场量价齐升 调控中再现回落','','0','','<!--#p8_attach#-->/cms/item/2010_12/08_11/1b2a4988ed469903.jpg.thumb.jpg','','','','由中国社会科学院财政与贸易经济研究所、社会科学文献出版社联合主办的“2011年《住房绿皮书》发布暨2010~2011年住房形势与政策研讨会”8日在北京举行。','中国网','','','','','1','','0','1379420676','1379420676','1379420676','1379420676','1','','','67','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1023','article','44','0','','中美大学生文化交流活动在我校举行','','0','','<!--#p8_attach#-->/cms/item/2012_08/23_00/afa9ec23dfb52a78.jpg.thumb.jpg','','','','2012年7月19日，由中美文化教育基金会发起、北京市委教育工委主办、中国传媒大学学生工作处承办的&ldquo;新世纪的丝绸之路&rdquo;之中美大学生文化交流活动在中国传媒大学综合实验楼400人报告厅拉开帷幕。此次活动吸','学校分站1|http://z3.php168.net','','','','','1','','0','1379420676','1379420676','1379420676','1379420676','1','','','152','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1027','article','47','1','admin','理论学习工作台指导意见','','0','','','','','','理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习','','','','','','1','admin','0','1393140327','1393140327','1393140327','1393140327','1','','','32','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1029','article','44','1','admin','中国高校毕业生数量10年翻了一番 就业人数再创历史新高','','0','','','','','2','  政府工作报告提出，今年高校毕业生将达727万人，要开发更多就业岗位，实施不间断的就业创业服务，提高大学生就业创业比例','','','','','','1','','0','1398590182','1394984958','1394984958','1398590182','1','','','92','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1046','article','44','1','admin','关于开展2014年青年全球治理创新设计大赛','','0','','','','','','青年全球治理创新设计大赛（Youth Innovation Competition on Global Governance，简称&amp;amp;ldquo;YICGG&amp;amp;rdquo;）是由复旦大学国际关系与公共事务学院于2007年创办、复旦大学和联合国开发计划署联合主办的一项赛事活动。它面向全球所有高校青年征集智慧与创意，解决人类命运','','','','','','1','admin','0','1399118224','1399118224','1399118224','1399118224','1','','','64','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1047','article','44','1','admin','我校举行“五一”劳动节座谈会','','0','','','','','','4月29日，我校在主楼824室举行&amp;amp;ldquo;五一&amp;amp;rdquo;劳动节座谈会。学校领导傅广生、王余丁、王凤鸣、王培光、杨立海出席会议。各级劳动模范、&amp;amp;ldquo;三育人&amp;amp;rdquo;先进个人及我校模范教师代表，党办、校办、宣传部、工会等部门负责人参加了会议。劳模代表一一发言，讲述了','','','','','','1','admin','0','1399118264','1399118264','1399118264','1399118264','1','','','48','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1048','article','44','1','admin','“校园杯”篮球联赛圆满落幕','','0','','','','','','4月25日下午，历时10天的2014年河北大学&amp;amp;ldquo;校园杯&amp;amp;rdquo;篮球赛落下帷幕。本次比赛有23支代表队345名运动员参加，共举行85场比赛。比赛采用男女生混合组队的形式。经过激烈角逐，工商学院、电子信息工程学院、政法学院、经济学院、新闻传播学院、质量技术监督学院、','','','','','','1','admin','0','1399118285','1399118285','1399118285','1399118285','1','','','57','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1049','article','128','1','admin','我校召开校级党员领导干部学习汇报会','','0','','','','','','根据省委督导组的要求，为充分发挥党员领导干部在教育实践活动中的带头示范作用，4月23日下午，我校在主楼304报告厅召开了校级党员领导干部学习汇报会。省委督导组组长李益民，常务副组长鲁杰，副组长杨造成，以及沈建国、靳学军、张学工等领导同志，学校领导，近三年退','','','','','','1','','0','1408885160','1399118350','1399118350','1408885160','1','','','86','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1050','article','44','1','admin','我校举行青年志愿者表彰大会','','0','','','','','','4月19日下午， 2013—2014年度青年志愿者表彰大会在图书馆报告厅举行。大会对我校在2013年度志愿服务工作中表现突出的集体和个人进行了表彰。党委常委王培光对我校志愿服务工作取得的成绩给予了肯定，希望志愿者工作要与青年学生的教育培养相结合，全面提高志愿服务','','刘先生','','','','1','','0','1408885180','1399118414','1399118414','1408885180','1','','','89','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1054','article','780','1','admin','领导班子','','0','','','','','','局长:杨靖主持市教育局全面工作。联系电话：2366011823党组书记：梁凤主持市教育局党组工作。联系电话：236603823调研员：黄海分管办公室（市语言文字工作委员会）、计划财务科、市教育信息中心、市教育装备中心、市教育基金会。联系电话：236604823牳本殖ぁ⑹薪逃&#65533;','','','','','','1','','0','1408809600','1408851788','1408809600','1437221825','1','','','290','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1055','article','779','1','admin','组织机构','','0','','<!--#p8_attach#-->/cms/item/2015_05/23_08/def29b9c7dd0d591.jpg','','','6','','','','','','','1','','0','1408809600','1408851902','1408809600','1511778413','1','','','495','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1056','article','777','1','admin','联系电话','','0','','','','','','　','','','','','','1','','0','1408809600','1408851984','1408809600','1438006701','1','','','242','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1058','article','44','1','admin','缘梦彩云支教团土木学院支教队云南昭通支教','#ee1d24','0','','<!--#p8_attach#-->/cms/item/2014_09/10_22/f06d99571a5d25c2.jpg','','','1,6','2014年暑期缘梦彩云支教活动于 2014年7月18日至8月5日在云南省昭通市彝良县举行。本次支教活动共有三个支队，第一支队12人，由土木学院学生9名13级学生及3名12级学生组成，支教地为云南省昭通市彝良县奎乡仙','','','','','','1','','0','1410278400','1410357357','1410278400','1511764726','1','','','198','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1059','article','44','1','admin','我院举行2014级研究生新生开学典礼','','0','','','','','','朗朗金秋，丹桂飘香。土木工程学院又迎来了307名硕士研究生和46名博士研究生。9月5日下午2点半，湖南大学土木工程学院2014级研究生新生开学典礼在复临舍301隆重举行。院长肖岩，院党委书记赵明华,副院长易伟建，院务委员李正农莅临大会，外专千人计划学者S.Kunnath,&nbs','','','','','','1','','0','1410278400','1410359902','1410278400','1410359956','1','','','48','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1060','article','44','1','admin','中秋送欢乐 有爱更温暖','','0','','','','','','9月8日，正值中秋佳节，一户家庭贫困的三胞胎孩子的家中一片欢声笑语。来自土木工程学院红十字分会的3名志愿者，给这户三胞胎家庭送去了温暖和关爱。当志愿者们到达三胞胎小朋友的家中时，小朋友们十分高兴。小朋友们拉着志愿者到客厅围坐一圈，并给志愿者唱了一首ABC歌','','','','','','1','admin','0','1410360021','1410360021','1410360021','1410360021','1','','','52','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1061','article','44','1','admin','工程学院红十字分会暑期社会实践活动总结','','0','','<!--#p8_attach#-->/cms/item/2015_05/23_08/9a720b9fd38c67fb.jpg','','','6','7月3日上午，土木工程学院红十字分会暑期社会实践团的团员们向来自钱塘博文小学的留守儿童宣传防水、防火的相关知识，也向小朋友们及其家长们讲解了一些常用药品的正确使用方法，纠正日常生活中常见的药品错误使用方法。此外，团员们还在现场向小朋友展示几种应急的包扎','','','','','','1','','0','1410278400','1410360065','1410278400','1432341396','1','','','123','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1062','article','44','1','admin','人民日报评论员：以“三种意识”推进全面深化改革','','0','','','','','','历经35年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼&amp;amp;ldquo;两个一百年&amp;amp;rdquo;目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的','','','','','','1','admin','0','1410360106','1410360106','1410360106','1410360106','1','','','48','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1063','article','44','1','admin','2014年硕士研究生招生复试及录取工作流程','','0','','','','','','研究生教育招生简介导师信息考试目录及大纲学科方向资讯动态您现在的位置：&amp;amp;nbsp;土木工程学院&amp;amp;nbsp;&amp;gt;&amp;gt;&amp;amp;nbsp;研究生教育&amp;amp;nbsp;&amp;gt;&amp;gt;&amp;amp;nbsp;资讯动态&amp;amp;nbsp;&amp;gt;&amp;gt;&amp;amp;nbsp;正文福建工程学院土木工程学院2014年硕士研究生招生复试及录取工作流程文章来源：本站原创&amp;amp;nbsp;&','','','','','','1','admin','0','1410360151','1410360151','1410360151','1410360151','1','','','60','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1064','article','44','1','admin','播洒爱心 放飞希望 努力促进教育公平提升教育质量','','0','','<!--#p8_attach#-->/cms/item/2015_05/23_08/6bda83cf89e6cf65.jpg','','','6','9月9日上午，在笫29个教师节来临之际，中共中央政治局常委、国务院总理李克强在大连考察并看望师生，与基层教师座谈。　　大连二十高中安静的校园里，学生们正在上课。李克强走进教师办公室，看到总理，教师们纷纷围拢过来。李克强说，教师永远是天底下最受人尊敬的职业','','','','','','1','','0','1410278400','1410360231','1410278400','1432341362','1','','','123','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1065','article','44','1','admin','“24字”核心价值观具有强大认同力和凝聚力','','0','','','','','','十八大报告对社会主义核心价值体系建设提出了新部署新要求，强调&amp;amp;ldquo;要深入开展社会主义核心价值体系学习教育，用社会主义核心价值体系引领社会思潮、凝聚社会共识&amp;amp;rdquo;，&amp;amp;ldquo;倡导富强、民主、文明、和谐，倡导自由、平等、公正、法治，倡导爱国、敬业、诚信、友','','','','','','1','admin','0','1410360259','1410360259','1410360259','1410360259','1','','','113','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1066','article','44','1','admin','教育部关于切实加强和改学风建设的实施意见','','0','','','','','','&amp;amp;nbsp;各省、自治区、直辖市教育厅（教委），新疆生产建设兵团教育局，有关部门（单位）教育司（局），部属各高等学校：　　为贯彻党的十七届六中全会&amp;amp;ldquo;深化政风、行风建设，开展道德领域突出问题专项教育和治理&amp;amp;rdquo;的精神，落实《国家中长期教育改革和发展规划','','','','','','1','admin','0','1410360358','1410360358','1410360358','1410360358','1','','','106','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1067','article','128','1','admin','教育部关于切实加强和改学风建设的实施意见','','0','','','','','','&nbsp;各省、自治区、直辖市教育厅（教委），新疆生产建设兵团教育局，有关部门（单位）教育司（局），部属各高等学校：　　为贯彻党的十七届六中全会&ldquo;深化政风、行风建设，开展道德领域突出问题专项教育和治理&rdquo;的精神，落实《国家中长期教育改革和发展规划','','','','','','1','','0','1415764673','1415764673','1415764673','1415764673','1','','','111','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1068','article','128','1','admin','教育部关于切实加强和改学风建设的实施意见','','0','','','','','','&nbsp;各省、自治区、直辖市教育厅（教委），新疆生产建设兵团教育局，有关部门（单位）教育司（局），部属各高等学校：　　为贯彻党的十七届六中全会&ldquo;深化政风、行风建设，开展道德领域突出问题专项教育和治理&rdquo;的精神，落实《国家中长期教育改革和发展规划','','','','','','1','','0','1415764749','1415764749','1415764749','1415764749','1','','','142','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1076','article','128','0','admin','人民日报评论员：以“三种意识”推进全面深化改革','','0','','','','','','历经35年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼&ldquo;两个一百年&rdquo;目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的','|','','','','','1','admin','1450407528','1431834918','1431834918','1431834918','1431834918','1','','','107','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1077','article','128','0','admin','市属高校三年规划建设项目开展专项稽察','','0','','','','','','市发展改革委对部分市属高校三年规划建设项目开展专项稽察。为了加强对我市重点建设项目稽察监管，市发展改革委近日对北方工业大学、首都师范大学和北京第二外国语学院3所院校的6个建设项目开展了专项稽察，重点对项目进度情况、资金到位及使用情况；履行基本建设程序、','|','','','','','1','admin','1431835200','1431834918','1431834918','1431834918','1431834918','1','','','398','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1078','article','128','0','admin','人民日报评论员：以“三种意识”推进全面深化改革','','0','','','','','','历经35年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼&ldquo;两个一百年&rdquo;目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的','|','','','','','1','admin','0','1431835066','1431835066','1431835066','1431835066','1','','','218','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1079','article','128','0','admin','市属高校三年规划建设项目开展专项稽察','','0','','<!--#p8_attach#-->/cms/item/2015_05/23_08/def29b9c7dd0d591.jpg','','','6','市发展改革委对部分市属高校三年规划建设项目开展专项稽察。为了加强对我市重点建设项目稽察监管，市发展改革委近日对北方工业大学、首都师范大学和北京第二外国语学院3所院校的6个建设项目开展了专项稽察，重点对项目进度情况、资金到位及使用情况；履行基本建设程序、','|','','','','','1','','0','1431792000','1431835066','1431792000','1432341455','1','','','110','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1080','article','44','0','admin','专家上海研讨大城市规划 绿色可持续城市仍为热点','','0','','<!--#p8_attach#-->/cms/item/2015_05/23_08/2491223fbece3b6d.jpg','','','6','“新型城镇化”现已成为一个全民议题。如何走新型城镇化道路，需要全社会尤其是“规划师”的探索与创新。作为担当城乡规划重任的“青年规划师”的思考及探索，将为中国新型城镇化实践提供新的思路。　　17日，以“新型城镇化与城乡规','|','','','','','1','','0','1431792000','1431835066','1431792000','1432341331','1','','','213','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1085','article','128','1','admin','工程学院红十字分会暑期社会实践活动总结','','0','','<!--#p8_attach#-->/cms/item/2015_05/23_08/9a720b9fd38c67fb.jpg','','','1,2,6','7月3日上午，土木工程学院红十字分会暑期社会实践团的团员们向来自钱塘博文小学的留守儿童宣传防水、防火的相关知识，也向小朋友们及其家长们讲解了一些常用药品的正确使用方法，纠正日常生活中常见的药品错误使用方法。此外，团员们还在现场向小朋友展示几种应急的包扎','部门1（交流处）|','','','','','1','','0','1433865600','1433905343','1433865600','1442676786','1','','','725','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1108','article','774','1','admin','市属高校三年规划建设项目开展专项稽察','','0','','<!--#p8_attach#-->/cms/item/2015_05/23_08/def29b9c7dd0d591.jpg','','','6','市发展改革委对部分市属高校三年规划建设项目开展专项稽察。为了加强对我市重点建设项目稽察监管，市发展改革委近日对北方工业大学、首都师范大学和北京第二外国语学院3所院校的6个建设项目开展了专项稽察，重点对项目进度情况、资金到位及使用情况；履行基本建设程序、','|','','','','','1','','0','1582086160','1582086172','1582086160','1582086172','1','','','47','0','0','','','','a:2:{i:0;s:0:\\\"\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1109','article','774','1','admin','工程学院红十字分会暑期社会实践活动总结','','0','','<!--#p8_attach#-->/cms/item/2020_03/05_09/7b3f9fe8d69e5c40.jpg.thumb.jpg','','','6','7月3日上午，土木工程学院红十字分会暑期社会实践团的团员们向来自钱塘博文小学的留守儿童宣传防水、防火的相关知识，也向小朋友们及其家长们讲解了一些常用药品的正确使用方法，纠正日常生活中常见的药品错误使用方法。此外，团员们还在现场向小朋友展示几种应急的包扎','部门1（交流处）|','','','','','1','adminroot','0','1582086160','1582086172','1582086160','1583371344','1','','','11','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('1','1','1','','','湖南衡阳市衡山县争夺店门镇辖权引矛盾，传因此影响人事调整，衡山县县委书记空缺一年。衡山县村民反对划并曾多次堵路。知情者称，衡阳市划并店门镇是为争夺南岳衡山的管辖权。\\r\\n','192.168.1.175','192.168.1.175','1291778075','<p align=\"center\" class=\"f_center\" style=\"text-align: center\">\r\n	　　<img alt=\"衡阳市与衡山县的“店门之争”（1）(图)\" src=\"<!--#p8_attach#-->/cms/item/2010_12/08_11/8764672f9925ff1f.jpg\" /></p>\r\n<p>\r\n	　　6月13日，衡山县群众因反对衡阳市划走店门镇而聚集在一起。一青年脸上贴着衡山县地图。资料图片</p>\r\n<p align=\"center\" class=\"f_center\" style=\"text-align: center\">\r\n	　　<img alt=\"衡阳市与衡山县的“店门之争”（2）(图)\" src=\"<!--#p8_attach#-->/cms/item/2010_12/08_11/b7e82af23b1144b0.jpg\" /></p>\r\n<p>\r\n	　　衡山坐落于衡阳市的南岳区，衡阳市&ldquo;扩城连岳&rdquo;解决南岳区行政&ldquo;飞地&rdquo;问题。</p>\r\n<p>\r\n	　　<strong>新京报12月8日报道 </strong>湖南衡阳市欲进行一次区划调整，而引发堵路事件，虽然事过半年，但如今仍是当地人的热议话题。</p>\r\n<p>\r\n	　　今年6月7日，衡阳市提出&ldquo;扩城连岳&rdquo;方案，欲把衡阳县的集兵镇、樟木乡划并给石鼓区，把衡山县的店门镇划并给南岳区。划并店门镇，遭到衡山县一些民众反对。</p>\r\n<p>\r\n	　　衡阳市发改委负责人解释，&ldquo;扩城连岳&rdquo;只为解决南岳区行政&ldquo;飞地&rdquo;问题，并能为南岳突破缺水缺地瓶颈。</p>\r\n<p>\r\n	　　而采访中湖南省委党校易可君认为，衡阳此举与湖南省推行的&ldquo;省直管县&rdquo;相背离。他说现有很多地方都在将优质资源的乡镇划并入城区，或搞经济圈，来影响&ldquo;省直管县&rdquo;行政区划调整。这是一场地方政府的利益博弈。</p>\r\n<p>\r\n	　　衡山县曾因南岳衡山而闻名。</p>\r\n<p>\r\n	　　如今，这座地处湖南省中部的小县城又再次跃入人们视线。</p>\r\n<p>\r\n	　　当地出了两件事，其一，衡山县县委书记一职已空缺近1年，衡阳市迟迟未安排人选。其二，今年6月，衡山县出现多人堵路风波，他们反对衡阳市将该县的店门镇划并到其他城区。</p>\r\n<p>\r\n	　　11月26日，这两件事依旧是当地人的热议话题。不管在商店里，还是公车上，只要提到店门镇，衡山县人的话匣子就关不住。</p>\r\n<p>\r\n	　　当地一名知情者告诉记者，其实在这两件事背后，还和湖南省正在推行的省直管县改革有关，这其中隐藏着一场地方政府的利益博弈。</p>\r\n<p>\r\n	　　<strong>&ldquo;没给衡山县穿小鞋&rdquo;</strong></p>\r\n<p>\r\n	　　<strong>当地已近一年没有县委书记，知情者称因县里闹出店门镇风波，故搁置人事调整；衡阳市官员予以否认</strong></p>\r\n<p>\r\n	　　罗东海原是衡山县的县委书记。今年2月，他被调至衡阳，任市委秘书长、办公室主任。衡山县县委书记的职务就此空缺。</p>\r\n<p>\r\n	　　衡山县一位官员说，县委书记空缺一年很不正常，地方政府是党委负责制。&ldquo;这跟空缺县长、局长概念不一样。&rdquo;</p>\r\n<p>\r\n	　　胡军是衡山县老年大学校长。他说，没有县委书记，影响到整个县的人事任免，现在有四五个局的老领导到期了，退不下来。</p>\r\n<p>\r\n	　　据了解，一般基层政府人事调动，3个月的调整期属于正常。就在罗东海被调走的4个月后的6月13日，当地发生了群众堵塞107国道事件。</p>\r\n<p>\r\n	　　据知情者介绍，当日，有省里一日常工作巡视小组到县里检查工作。上午9点左右，一些老干部和公务员聚集到县人民广场，手中打着横幅，脸上贴着衡山县地图，他们想见巡视组，反映问题，但未被接待，于是，这100多人冒雨堵塞国道，直至下午4点多，最后有代表和县政府协商后，人群方散去。胡军就是那天去协商的代表之一。</p>\r\n<p>\r\n	　　胡军说，群众堵路是因为他们反对衡阳市要划走店门镇。</p>\r\n<p>\r\n	　　今年6月7日，衡阳市委市政府联席会议决定，拟将衡山县店门镇，划归至衡阳市南岳区管辖。</p>\r\n<p>\r\n	　　6月11日晚，衡山县正式就此事召开常委会议，并同意了衡阳市的方案。</p>\r\n<p>\r\n	　　&ldquo;这个常委会开得很憋屈，要割走我们的地区，没有谁会愿意，但这又是没办法的事。&rdquo;一名与会官员事后称。</p>\r\n<p>\r\n	　　随后出现了6月13日的堵路事件。</p>\r\n<p>\r\n	　　3天后，衡阳市委、衡山县委宣布暂时停止店门镇的区划调整工作。</p>\r\n<p>\r\n	　　一名知情者透露，衡山县迟迟没有安排县委书记也和店门镇事件有关。</p>\r\n<p>\r\n	　　他说，现任县委副书记、县长周骥原应该被提拔为县委书记，此前衡阳市曾有人找过周骥，称店门并入南岳一事他要拍得了板，这是考验他的时候。</p>\r\n<p>\r\n	　　&ldquo;但现在，店门镇区划调整工作被搁置了，提拔一事也就被搁置了。&rdquo;这名知情者说。</p>\r\n<p>\r\n	　　衡阳市委宣传部新闻办主任成新平否认了这个说法。</p>\r\n<p>\r\n	　　他说，干部是一批批任免的，调研需要时间。书记调整，还要报省委组织部审批，也需要时间。</p>\r\n<p>\r\n	　　&ldquo;市里没有给衡山县穿小鞋。&rdquo;成新平说。</p>\r\n<p>\r\n	　　<strong>割店门，如割肉</strong></p>\r\n<p>\r\n	　　<strong>店门镇有水库和土地资源，若并入南岳可缓解其缺水缺地饥渴；衡山县官员称那无疑掐断县里农业命脉</strong></p>\r\n<p>\r\n	　　当划走店门镇的方案流传到民间后，激起了一些人的责难。网民在相关论坛发帖表示，资源都被划走了，衡山县的经济还要不要发展？</p>\r\n<p>\r\n	　　店门镇是衡山县面积最大的乡镇，该镇紧依南岳距其约15公里。由于衡山坐落在南岳区，店门镇也已开发出了白泥度假村、九观水上乐园、南岳衡山九龙峡漂流等旅游项目，实现年接待游客30多万人次以上。</p>\r\n<p>\r\n	　　一位不愿透露姓名的衡山县官员说，店门镇上还有兰竹、生猪养殖等基地。生猪基地养着四五万头猪，如果少了这些猪，县里连国家生猪养殖补贴都拿不到。</p>\r\n<p>\r\n	　　这名官员说，店门镇的农业收入占全县GDP三分之一，&ldquo;割店门，无异于割肉。&rdquo;</p>\r\n<p>\r\n	　　而在店门镇，还有一个更重要的宝贝：九观桥水库。这个水库总库容3370万立方米，灌溉衡山县及南岳区共10个乡镇的耕地8.13万亩。</p>\r\n<p>\r\n	　　当地知情者称，南岳区缺水、缺地，所以急需这方面的资源。</p>\r\n<p>\r\n	　　南岳区宣传部副部一官员证实了这一说法，南岳发展确实遇到瓶颈，&ldquo;缺人，缺地，缺水。&rdquo;</p>\r\n<p>\r\n	　　每年夏季，南岳衡山景区经常宾馆用水都保证不了，得分片停水。南岳人经常跑到衡山县去洗澡。他们协商到九观桥水库借水。</p>\r\n<p>\r\n	　　&ldquo;对方只答应水够的时候才能供给。他们要保证农业用水，无法同时兼顾我们。&rdquo;朱正光说。</p>\r\n<p>\r\n	　　南岳区很小，面积只有185平方公里，下辖5.4万人口，人均GDP排在衡阳市前列。</p>\r\n<p>\r\n	　　南岳区宣传部副部长朱正光说，南岳区经济结构单一，旅游产业占全区GDP产量的80%。在2003年非典时，旅游产值不到同期十分之一，对全区影响很大。</p>\r\n<p>\r\n	　　据知情人介绍，区里也想发展其他产业，想发展房产业，缺少土地；想改变旅游业单一局面，建个影视城，也得找衡山县要地；想从穿过衡山县的京珠高速开个口子方便南岳的旅游交通，不但要找高管局还要跟衡山县协调，处处受制。</p>\r\n<p>\r\n	　　&ldquo;若有了店门镇的地和水，就能缓解资源饥渴。&rdquo;这名知情人说。</p>\r\n<p>\r\n	　　而衡山县一官员对此质疑说，全县几乎1/3的农田都由此输水，受益农民达20万余人。若水库被划走，无异于掐住了衡山县农业命脉，衡山县农业还怎么存活？</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('2','2','1','','','贵州凯里网吧爆炸已造成6死38伤，官方称事件初步确定是由于网吧隔壁存放的大量危险化学品引发。据悉事发时网吧内有45人在上网。目前2名网吧负责人及存放化学品的业主已被警方控制。\r\n','192.168.1.175','192.168.1.175','1291778207','<p>\r\n	　　<strong><img alt=\"12月5日，救援人员在现场施救。新华社发(陈沛亮 摄) \" src=\"<!--#p8_attach#-->/cms/item/2010_12/08_11/7a19ccbc3af02c79.jpg\" /></strong></p>\r\n<p>\r\n	　　12月5日，救援人员在现场施救。新华社发(陈沛亮 摄)</p>\r\n<p>\r\n	　　<span style=\"font-weight: bold\">新华网贵阳12月5日报道 </span>5日，贵州省凯里市网吧爆炸事件的原因已初步查明，为网吧隔壁一出租屋内存放的危险化学品发生爆炸引发。</p>\r\n<p>\r\n	　　记者从凯里市委、市政府了解到，截至目前，经州、市公安机关刑侦部门现场勘查，初步确认爆炸系由网吧一墙之隔的一小房间堆放的危险化学物品引发。爆炸现场位于凯里市清平南路桥下，房间内靠南墙堆放有三种袋装化学粉状物品，经查看包装袋，分别为高效聚氯化铝、氢氧化铝、亚硝酸钠，在袋装物品上还散落着若干玻璃瓶装液体，瓶上标签分别为硝酸、盐酸和石油醚。</p>\r\n<p>\r\n	　　现警方已将网吧业主陈成贵、邢光昌控制，并于5日凌晨将堆放危险化学物品的业主吴展智抓获。</p>\r\n<p>\r\n	　　据了解，该网吧已开业多年，证照齐全，共有140台电脑，爆炸时，网吧共有45人正在上网。</p>\r\n<p>\r\n	　　爆炸发生后，贵州省委书记栗战书作出批示，要求全力以赴开展救援，尽快查明爆炸原因，做好善后工作；省委常委、副省长黄康生立即从贵阳赶赴凯里指挥救援、看望伤员；省委常委、政法委书记崔亚东在公安厅指挥中心连夜指挥侦查。</p>\r\n<p>\r\n	　　目前，这起爆炸事件已造成6人死亡，38人受伤，其中9人重伤。</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('3','3','1','','','　　中国新闻网12月8日报道;不少市民日前反映，最近去银行办理业务，发现此前广受质疑的小额账户管理费、短信通知费等仍在收取。银行人员称;这些收费监','192.168.1.175','192.168.1.103','1291778283','<p>\r\n	　　<strong>中国新闻网12月8日报道</strong>&nbsp;不少市民日前反映，最近去银行办理业务，发现此前广受质疑的小额账户管理费、短信通知费等仍在收取。银行人员称&ldquo;这些收费监管部门从未取消，我们一直在收取&rdquo;。</p>\r\n<p>\r\n	　　记者调查后发现，此前价格主管部门和银行监管机构称已经起草完成，并公开表示将广泛征求意见的《商业银行服务价格管理办法》，在相隔了数个月后至今不见下文，其何时能出台仍是一个未知数。</p>\r\n<p>\r\n	　　<strong>银行收费新规至今未露面</strong></p>\r\n<p>\r\n	　　记者近期在调查多家商业银行收费服务项目后发现，包括小额账户管理费、转账失败手续费等屡遭各界质疑的收费项目依然普遍存在。</p>\r\n<p>\r\n	　　今年年中，也正是这些收费项目以及来自商业银行语焉不详的解释引发社会普遍质疑。正当舆论质疑之声愈演愈烈时，监管部门的表态以及相关媒体由此引申的&ldquo;多项银行收费被叫停&rdquo;的报道让人们看到了希望。</p>\r\n<p>\r\n	　　国家发改委有关负责人7月28日就商业银行收费问题答记者问时表示：&ldquo;发展改革委已经配合有关部门研究起草了新的《商业银行服务价格管理办法》，发改委正在积极协调有关部门，对草案进行完善，争取尽快出台，以进一步规范商业银行收费行为，维护广大消费者利益&hellip;&hellip;&rdquo;</p>\r\n<p>\r\n	　　8月3日，银监会也发文说，正&ldquo;与国家发展改革委抓紧修订《商业银行服务价格管理暂行办法》&hellip;&hellip;将在征求各方意见后尽快发布&rdquo;。</p>\r\n<p>\r\n	　　然而，时隔数月，该办法不但没有&ldquo;尽快出台&rdquo;，甚至连公众意见也没有公开征求。</p>\r\n<p>\r\n	　　记者就此多次联系银监会及发改委的相关人士，询问该管理办法制定及征求意见进展情况，接受记者采访的银监会人士称&ldquo;领导忙于其他事务&rdquo;，发改委人士则称&ldquo;手中急件太多，等急件弄完再说&rdquo;，两部门人士始终不作正面回应。</p>\r\n<p>\r\n	　　据记者多方深入了解，除银行系统外，目前该办法征求意见工作仅在少数业内专家中小范围进行过。</p>\r\n<p>\r\n	　　&ldquo;既不出台，也不征求公众意见，公众甚至连该管理办法征求意见稿是个什么样子都不知道，感觉像平息公众质疑的权宜之计。&rdquo;采访中，一位银行客户的说法颇具代表性。</p>\r\n<p>\r\n	　　<strong>多方参与 为何公众声音独遭冷落</strong></p>\r\n<p>\r\n	　　商业银行服务价格的收取涉及到公众利益，其服务项目收费标准的制定和调整，理应听取包括商业银行、消费者组织及公众个人的意见。</p>\r\n<p>\r\n	　　然而，社会公众不仅从公开渠道看不到这份征求意见稿，记者辗转相关部门、被征求意见专家以及多家商业银行，也未能看到这份&ldquo;神秘&rdquo;的征求意见稿，来自银行和专家的说法是&ldquo;要保密&rdquo;。</p>\r\n<p>\r\n	　　而早在今年8月份银监会有关负责人在接受媒体采访时就表示，目前征求意见稿主要针对商业银行收集信息，约持续两周时间。各大商业银行当时亦表示已收到征求意见稿，并将积极反馈意见。</p>\r\n<p>\r\n	　　待遇的不同，不仅如此。</p>\r\n<p>\r\n	　　银监会和发改委在2003年出台的《商业银行服务价格管理暂行办法》就明文规定&ldquo;商业银行就前款事项(商业银行依据本办法制定服务价格)报告中国银行业监督管理委员会的同时，应抄送中国银行业协会&rdquo;。丝毫未提及作为公众利益发声载体的消费者协会或者其他组织。</p>\r\n<p>\r\n	　　作为银行业行业自律组织的银行业协会在年中关于银行收费的舆论质疑声中，发表意见称商业银行上调有关服务收费合法合规，遭多方诟病。</p>\r\n<p>\r\n	　　在采访中，银监会一位内部人士告诉记者，在商业银行服务价格管理办法的起草过程中，银行业协会参与了其中的部分工作，&ldquo;具体情况应该问他们&rdquo;。银行业协会人士则向记者表示，参与了管理办法起草的前期工作，但不清楚后续进展。</p>\r\n<p>\r\n	　　而消费者协会一位副会长在接受记者采访时十分无奈地说：&ldquo;消协在这次商业银行服务价格管理办法起草中基本上被冷场。&rdquo;</p>\r\n<p>\r\n	　　<strong>监管机构：是&ldquo;教练员&rdquo;还是&ldquo;裁判员&rdquo;</strong></p>\r\n<p>\r\n	　　显然，这项管理办法的制定与出台是一场多方利益的博弈。在此过程中，究竟谁能代表公众利益发声呢?</p>\r\n<p>\r\n	　　&ldquo;公众利益的代表，一方面是公权力机构，另一方面是一些社会团体。&rdquo;中国人民大学法学院教授刘俊海在接受记者采访时说，国家发改委、银监会均应代表公众利益。</p>\r\n<p>\r\n	　　然而，不为广大公众所知的是，作为银行业监管部门的银监会，每年均向商业银行征收银行业机构监管费和业务监管费。</p>\r\n<p>\r\n	　　记者手持的由国家发改委联合财政部于2007年12月及今年9月发布的两份通知表明，银行业机构监管费和业务监管费的征收额度与银行实收资本及资产总额存在关联。</p>\r\n<p>\r\n	　　与之相关，手续费及佣金净收入已成为拉动银行业绩增长的重要引擎。上市银行半年报显示，可统计的15家上市银行手续费及佣金净收入较去年同期增长382.92亿元，涨幅达35.13%，商业银行手续费及佣金增速普遍已超过传统息差收入。</p>\r\n<p>\r\n	　　&ldquo;正因为与此相关的利益勾连，银行业监管部门为商业银行收费行为充当&lsquo;保护伞&rsquo;，导致银行乱收费、乱涨价等行为一再上演。&rdquo;北京两高律师事务所律师董正伟十分犀利地指出。</p>\r\n<p>\r\n	　　2003年出台的《商业银行服务价格管理暂行办法》规定，除人民币基本结算类业务和银监会、国家发改委根据对个人、企事业的影响程度以及市场竞争状况确定的商业银行服务项目外，商业银行提供的其他服务实行市场调节价。实行市场调节价的服务价格，由商业银行总行自行制定和调整。</p>\r\n<p>\r\n	　　而这也正是今年年中众多商业银行单方面设定服务收费或上调服务收费标准的重要依据。</p>\r\n<p>\r\n	　　不少法律界人士却质疑其与现行《商业银行法》相抵触。《商业银行法》第五十条规定，商业银行收费项目和标准，由国务院银行业监督管理机构、中国人民银行根据职责分工，分别会同国务院价格主管部门制定。</p>\r\n<p>\r\n	　　细心的人士注意到，与此前出台的《商业银行服务价格管理暂行办法》只提&ldquo;市场调节价&rdquo;&ldquo;政府指导价&rdquo;、不提对公众相对有利的&ldquo;政府定价&rdquo;不同，发改委在答记者问中提出，商业银行服务收费依据其性质、特点和市场竞争状况，分别实行政府指导价、政府定价或市场调节价。</p>\r\n<p>\r\n	　　而银监会的发文丝毫未提及政府定价。</p>\r\n<p>\r\n	　　中国政法大学教授吴景明指出，措辞不同，可以看出二者立场有差异。</p>\r\n<p>\r\n	　　&ldquo;政府定价介入力度更大，政府定价机制是同企业某些见利忘义行为相抗衡的有效制度。&rdquo;刘俊海说。</p>\r\n<p>\r\n	　　&ldquo;这种差异，或许正是新规迟迟不见下文的重要原因。&rdquo;董正伟猜测说。</p>\r\n<p>\r\n	　　由于采访两部委未获正面回应，记者尚无法求证，上述猜测是否就是新办法迟迟未见进展的真实原因。</p>\r\n<p>\r\n	　　不过，法律界人士在接受记者采访时普遍认为，作为履行公共管理职能的部门，不宜成为利益攸关方，否则难以站在公正立场维护公众利益。</p>\r\n<p>\r\n	　　&ldquo;这也是商业银行不断出台收费项目、调整收费价格，老百姓反响强烈，却得不到银行监管机构任何有效制止的根源所在。&rdquo;吴景明说。</p>');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('26','43','1','','','　　新浪体育讯　北京时间12月9日消息，在斯洛文尼亚进行的乒乓球世青赛女团决赛中，中国女队1比3不敌石川佳纯领衔的日本队，仅获得亚军。这也是中国女乒八年来首次无缘世青赛冠军。男团决赛中国队则以3比0完胜日本队','192.168.1.175','192.168.1.175','1291882117','<p>\r\n	　　新浪体育讯　北京时间12月9日消息，在斯洛文尼亚进行的乒乓球世青赛女团决赛中，中国女队1比3不敌石川佳纯领衔的日本队，仅获得亚军。这也是中国女乒八年来首次无缘世青赛冠军。男团决赛中国队则以3比0完胜日本队夺冠。</p>\r\n<p>\r\n	　　<strong>女团：中国1-3日本</strong></p>\r\n<p>\r\n	　　日本队历史突破的最大功臣在于17岁的石川佳纯，她接连击败朱雨玲和顾玉婷，另外一场胜利来自于谷冈阿尤卡，她击败中国易芳贤；顾玉婷击败森园美咲赢得唯一一场胜利。详细比分为：朱雨玲2比3石川佳纯、顾玉婷3比1森园美咲、易芳贤2比3谷冈阿尤卡(音译)、顾玉婷0比3石川佳纯。</p>\r\n<p>\r\n	　　率先为中国队登场的是朱雨玲，朱雨玲在今年的日本公开赛上不敌王越古夺得亚军，一鸣惊人。而石川佳纯则是中国观众熟悉的福原爱之后的日本女乒代表。相对来讲，石川佳纯的大赛经验更为丰富。第一局，石川佳纯便以11比9拿下，第二局竞争格外胶着，一直到15比13，石川佳纯2比0领先，被逼到绝路的朱雨玲放手一搏，以11比6和11比7连扳两局，可惜的是决胜局石川佳纯轻松11比3拿下。中国队0比1落后。</p>\r\n<p>\r\n	　　第二场是中国顾玉婷，她也是2010年新加坡青奥会女单冠军得主，和森园美咲的较量中，两人前两局各有胜负，第三局11比8顾玉婷拿下，第四局两人打出16比14的高分，顾玉婷3比1胜出，中国队1比1平。</p>\r\n<p>\r\n	　　第三场由来自武汉的易芳贤出战，她在今年2月的直通赛中胜出从二队上升至一队，对手则是日本队的谷冈阿尤卡。第一局谷冈11比9拿下，易芳贤随后还以两个11比4，谁料第四局谷冈11比7实现逆转；决胜局，易芳贤再度失利，9比11不敌对手，中国队1比2落后。</p>\r\n<p>\r\n	　　第四场，由青奥会冠军顾玉婷迎战石川佳纯。中国队大比分落后，再输一场将丢冠。心理压力骤增的顾玉婷崩盘，7比11、6比11和8比11连输三局，不敌石川佳纯。成年组莫斯科世乒赛崩盘之后，世青赛上中国队再度落败，1比3，无缘女团冠军。这也是中国队八年来首度无缘女团世青赛冠军。</p>\r\n<p>\r\n	　　<strong>男团：中国3-0日本</strong></p>\r\n<p>\r\n	　　男女团冠军的较量都是中国与日本，虽然女队的姑娘们1比3落败，但男队的小伙子们顶住了日本队的强烈冲击，以3比0锁定胜局，其中周雨3比0击败吉田雅己，吴家骥3比2险胜丹羽孝希，林高远3比0击败平野友树。</p>\r\n<p>\r\n	　　首场比赛周雨的胜出显得相对容易，11比6、11比7和11比2，非常轻松；第二场吴家骥和丹羽孝希之间的较量则格外惊心动魄，首局吴家骥13比11拿下，接着5比11和4比11连丢两局；第四局，吴家骥11比9艰难胜出；关键的决胜局，吴家骥7比10落后，丹羽孝希手握三个赛点，而吴家骥此时发挥神勇连追三分，10平！丹羽孝希赢得接下来的一分，第四个赛点出现，吴家骥依旧沉着挽救赛点成功，并赢得接下来的两分，逆转成功！五局大战，吴家骥终于拿下。</p>\r\n<p>\r\n	　　第三场林高远迎战日本平野友树，他也是日本名将平野早矢香的弟弟。日本队0比2落后的情况下，平野友树也未能抵挡住中国队的攻势，7比11、6比11、6比11，平野友树0比3不敌林高远，中国队也3比0胜出，夺得男团冠军。(安然)</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('49','76','2','','','&amp;amp;nbsp;功能模块&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp','192.168.1.110','192.168.1.110','1292290627','\r\n<p>\r\n	&nbsp;</p>\r\n<div id=\"maincontent\">\r\n	<p>\r\n		<span style=\"color: rgb(0, 0, 255);\"><font size=\"5\"><b>功能模块</b></font></span><font size=\"4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><br />\r\n		<br />\r\n		<br />\r\n		<font size=\"4\">站群系统&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; CMS新闻系统&nbsp;&nbsp;<br />\r\n		<br />\r\n		问答系统&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 图片模块<br />\r\n		<br />\r\n		考试系统&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 下载模块<br />\r\n		<br />\r\n		视频模块&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;专题模块<br />\r\n		<br />\r\n		广告模块&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;表单模块<br />\r\n		<br />\r\n		投票模块&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;链接模块<br />\r\n		<br />\r\n		支付模块&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;积分模块<br />\r\n		<br />\r\n		上传模块&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;独立页模块<br />\r\n		<br />\r\n		邮件模块&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;短消息模块<br />\r\n		<br />\r\n		<br />\r\n		<br />\r\n		淘宝客、商城、杂志、报刊模块功能是官方将按顺序开发的功能。<br />\r\n		<br />\r\n		<br />\r\n		编辑一键排版、批量导入会员、文章收费模式、积分规则、支付体系、标签新闻关键词等使用功能一应俱全。</font></p>\r\n</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('82','119','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558474','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('83','120','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558482','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('84','121','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558488','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('85','122','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558495','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('86','123','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558502','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('87','124','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558508','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('171','208','1','','','行业动态新闻资讯测试','219.136.169.248','219.136.169.248','1308565385','行业动态新闻资讯测试');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('195','232','1','','','&amp;nbsp; &amp;nbsp; 因校领导另有公务安排，本周校领导接待日（7月19日）暂停一次。 &amp;nbsp;&amp;nbsp;&amp;nbsp; 需要反映问题的师生员工，请留意下次校领导接待日安排通知。','61.140.42.212','61.140.42.212','1345651612','&nbsp; &nbsp; 因校领导另有公务安排，本周校领导接待日（7月19日）暂停一次。<span style=\"FONT-SIZE: small\"> </span>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp; 需要反映问题的师生员工，请留意下次校领导接待日安排通知。</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('196','233','1','','','中国传媒大学文化产业孵化器企业（项目）征集宣讲会将于6月27日下午14:00在我校国际交流中心405会议室举办，欢迎感兴趣的师生踊跃参加。中国传媒大学文化产业孵化器是我校发挥大学学科优势、科研优势、人才优势实现服','61.140.42.212','121.8.7.164','1408885252','<p style=\"TEXT-INDENT: 24pt\">\r\n	<span style=\"FONT-SIZE: 12pt; LINE-HEIGHT: 150%; FONT-FAMILY: 宋体\">中国传媒大学文化产业孵化器企业（项目）征集宣讲会将于6月27日下午14:00在我校国际交流中心405会议室举办，欢迎感兴趣的师生踊跃参加。</span></p>\r\n<p style=\"TEXT-INDENT: 21pt\">\r\n	<span style=\"FONT-SIZE: 12pt; LINE-HEIGHT: 150%; FONT-FAMILY: 宋体\">中国传媒大学文化产业孵化器是我校发挥大学学科优势、科研优势、人才优势实现服务社会的重要平台，同时也是我校响应国家&ldquo;文化大发展、大繁荣&rdquo;政策的重要举措。我校文化产业孵化器为具有创新性和发展前景的文化初创企业（项目）提供低廉的办公场地、免费的配套服务、专业的创业导师以及扶持资金申请等多项服务，旨在推助文化企业（项目）健康、快成长。</span></p>\r\n<p style=\"TEXT-INDENT: 21pt\">\r\n	<span style=\"FONT-SIZE: 12pt; LINE-HEIGHT: 150%; FONT-FAMILY: 宋体\">孵化器现正面向我校在校师生、校友及创业者征集优质企业（项目），详情请关注中国传媒大学文化产业孵化器校园宣讲会。</span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('197','234','1','','','我校将于2012年9月开设4个辅修、辅修/双学位专业，其中包括3个辅修/双学位专业，1个辅修专业，6月15日起开始招生，欢迎各位同学咨询报名。招生时间：2012年6月15日-9月4日报名方式：具体请见教务处主页通知 链接地址','61.140.42.212','61.140.42.212','1345651676','<p align=\"left\" style=\"TEXT-INDENT: 12pt; TEXT-ALIGN: left\">\r\n	<span style=\"font-size: 12pt; line-height: 175%; font-family: 宋体; \">我校将于</span><span style=\"font-size: 12pt; line-height: 175%; font-family: \'Times New Roman\', serif; \">2012</span><span style=\"font-size: 12pt; line-height: 175%; font-family: 宋体; \">年</span><span style=\"font-size: 12pt; line-height: 175%; font-family: \'Times New Roman\', serif; \">9</span><span style=\"font-size: 12pt; line-height: 175%; font-family: 宋体; \">月开设</span><span style=\"font-size: 12pt; line-height: 175%; font-family: \'Times New Roman\', serif; \">4</span><span style=\"font-size: 12pt; line-height: 175%; font-family: 宋体; \">个辅修、辅修</span><span style=\"font-size: 12pt; line-height: 175%; font-family: \'Times New Roman\', serif; \">/</span><span style=\"font-size: 12pt; line-height: 175%; font-family: 宋体; \">双学位专业，其中包括</span><span style=\"font-size: 12pt; line-height: 175%; font-family: \'Times New Roman\', serif; \">3</span><span style=\"font-size: 12pt; line-height: 175%; font-family: 宋体; \">个辅修</span><span style=\"font-size: 12pt; line-height: 175%; font-family: \'Times New Roman\', serif; \">/</span><span style=\"font-size: 12pt; line-height: 175%; font-family: 宋体; \">双学位专业，</span><span style=\"font-size: 12pt; line-height: 175%; font-family: \'Times New Roman\', serif; \">1</span><span style=\"font-size: 12pt; line-height: 175%; font-family: 宋体; \">个辅修专业，</span><span style=\"font-size: 12pt; line-height: 175%; font-family: \'Times New Roman\', serif; \">6</span><span style=\"font-size: 12pt; line-height: 175%; font-family: 宋体; \">月</span><span style=\"font-size: 12pt; line-height: 175%; font-family: \'Times New Roman\', serif; \">15</span><span style=\"font-size: 12pt; line-height: 175%; font-family: 宋体; \">日起开始招生，欢迎各位同学咨询报名。</span></p>\r\n<p align=\"left\" style=\"TEXT-ALIGN: left\">\r\n	<span style=\"font-size: 12pt; line-height: 175%; font-family: 宋体; \">招生时间：</span><span style=\"font-size: 12pt; line-height: 175%; font-family: \'Times New Roman\', serif; \">2012</span><span style=\"font-size: 12pt; line-height: 175%; font-family: 宋体; \">年</span><span style=\"font-size: 12pt; line-height: 175%; font-family: \'Times New Roman\', serif; \">6</span><span style=\"font-size: 12pt; line-height: 175%; font-family: 宋体; \">月</span><span style=\"font-size: 12pt; line-height: 175%; font-family: \'Times New Roman\', serif; \">15</span><span style=\"font-size: 12pt; line-height: 175%; font-family: 宋体; \">日</span><span style=\"font-size: 12pt; line-height: 175%; font-family: \'Times New Roman\', serif; \">-9</span><span style=\"font-size: 12pt; line-height: 175%; font-family: 宋体; \">月</span><span style=\"font-size: 12pt; line-height: 175%; font-family: \'Times New Roman\', serif; \">4</span><span style=\"font-size: 12pt; line-height: 175%; font-family: 宋体; \">日</span></p>\r\n<p align=\"left\" style=\"TEXT-ALIGN: left\">\r\n	<span style=\"font-size: 12pt; line-height: 175%; font-family: 宋体; \">报名方式：</span><span style=\"font-size: 12pt; line-height: 175%; font-family: 宋体; \">具体请见教务处主页通知</span><span style=\"font-size: 12pt; line-height: 175%; font-family: \'Times New Roman\', serif; \"> </span></p>\r\n<p align=\"left\" style=\"TEXT-ALIGN: left\">\r\n	<span style=\"font-size: 12pt; line-height: 175%; font-family: 宋体; \">链接地址：</span><span style=\"font-size: 12pt; line-height: 175%; font-family: \'Times New Roman\', serif; \">http://jw.cuc.edu.cn/home/infoSingleArticle.do?articleId=1528</span></p>\r\n<table align=\"left\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\" style=\"BORDER-RIGHT: medium none; BORDER-TOP: medium none; MARGIN: 3.2pt 7.2pt; BORDER-LEFT: medium none; WIDTH: 423.6pt; BORDER-BOTTOM: medium none; BORDER-COLLAPSE: collapse\" width=\"706\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"BORDER-RIGHT: windowtext 1pt solid; BORDER-TOP: windowtext 1pt solid; BORDER-LEFT: windowtext 1pt solid; BORDER-BOTTOM: windowtext 1pt solid\" width=\"210\">\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 黑体\">专业名称</span></p>\r\n			</td>\r\n			<td style=\"BORDER-RIGHT: windowtext 1pt solid; BORDER-TOP: windowtext 1pt solid; BORDER-LEFT: windowtext 1pt solid; BORDER-BOTTOM: windowtext 1pt solid\" width=\"135\">\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 黑体\">专业性质</span></p>\r\n			</td>\r\n			<td style=\"BORDER-RIGHT: windowtext 1pt solid; BORDER-TOP: windowtext 1pt solid; BORDER-LEFT: windowtext 1pt solid; BORDER-BOTTOM: windowtext 1pt solid\" width=\"60\">\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 黑体\">学习年限</span></p>\r\n			</td>\r\n			<td style=\"BORDER-RIGHT: windowtext 1pt solid; BORDER-TOP: windowtext 1pt solid; BORDER-LEFT: windowtext 1pt solid; BORDER-BOTTOM: windowtext 1pt solid\" width=\"301\">\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 黑体\">招生对象</span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"BORDER-RIGHT: windowtext 1pt solid; BORDER-TOP: windowtext 1pt solid; BORDER-LEFT: windowtext 1pt solid; BORDER-BOTTOM: windowtext 1pt solid\" width=\"210\">\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">广播电视编导</span></p>\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">（电视编辑方向）</span></p>\r\n			</td>\r\n			<td style=\"BORDER-RIGHT: windowtext 1pt solid; BORDER-TOP: windowtext 1pt solid; BORDER-LEFT: windowtext 1pt solid; BORDER-BOTTOM: windowtext 1pt solid\" width=\"135\">\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">辅修</span><span style=\"FONT-SIZE: 12pt; FONT-FAMILY: \'Times New Roman\',\'serif\'\">/</span><span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">双学位</span></p>\r\n			</td>\r\n			<td style=\"BORDER-RIGHT: windowtext 1pt solid; BORDER-TOP: windowtext 1pt solid; BORDER-LEFT: windowtext 1pt solid; BORDER-BOTTOM: windowtext 1pt solid\" width=\"60\">\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">两年</span></p>\r\n			</td>\r\n			<td style=\"BORDER-RIGHT: windowtext 1pt solid; BORDER-TOP: windowtext 1pt solid; BORDER-LEFT: windowtext 1pt solid; BORDER-BOTTOM: windowtext 1pt solid\" width=\"301\">\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">本校部分在校本科生、研究生；<b>校外学生及社会人员</b></span><span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">（详见简章）</span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"BORDER-RIGHT: windowtext 1pt solid; BORDER-TOP: windowtext 1pt solid; BORDER-LEFT: windowtext 1pt solid; BORDER-BOTTOM: windowtext 1pt solid\" width=\"210\">\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">广播电视编导（电视节目后期制作方向）</span></p>\r\n			</td>\r\n			<td style=\"BORDER-RIGHT: windowtext 1pt solid; BORDER-TOP: windowtext 1pt solid; BORDER-LEFT: windowtext 1pt solid; BORDER-BOTTOM: windowtext 1pt solid\" width=\"135\">\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">辅修</span><span style=\"FONT-SIZE: 12pt; FONT-FAMILY: \'Times New Roman\',\'serif\'\">/</span><span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">双学位</span></p>\r\n			</td>\r\n			<td style=\"BORDER-RIGHT: windowtext 1pt solid; BORDER-TOP: windowtext 1pt solid; BORDER-LEFT: windowtext 1pt solid; BORDER-BOTTOM: windowtext 1pt solid\" width=\"60\">\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">两年</span></p>\r\n			</td>\r\n			<td style=\"BORDER-RIGHT: windowtext 1pt solid; BORDER-TOP: windowtext 1pt solid; BORDER-LEFT: windowtext 1pt solid; BORDER-BOTTOM: windowtext 1pt solid\" width=\"301\">\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">限本校部分在校本科生</span></p>\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">（详见简章）</span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"BORDER-RIGHT: windowtext 1pt solid; BORDER-TOP: windowtext 1pt solid; BORDER-LEFT: windowtext 1pt solid; BORDER-BOTTOM: windowtext 1pt solid\" width=\"210\">\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">新闻学</span></p>\r\n			</td>\r\n			<td style=\"BORDER-RIGHT: windowtext 1pt solid; BORDER-TOP: windowtext 1pt solid; BORDER-LEFT: windowtext 1pt solid; BORDER-BOTTOM: windowtext 1pt solid\" width=\"135\">\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">辅修</span><span style=\"FONT-SIZE: 12pt; FONT-FAMILY: \'Times New Roman\',\'serif\'\">/</span><span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">双学位</span></p>\r\n			</td>\r\n			<td style=\"BORDER-RIGHT: windowtext 1pt solid; BORDER-TOP: windowtext 1pt solid; BORDER-LEFT: windowtext 1pt solid; BORDER-BOTTOM: windowtext 1pt solid\" width=\"60\">\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">两年</span></p>\r\n			</td>\r\n			<td style=\"BORDER-RIGHT: windowtext 1pt solid; BORDER-TOP: windowtext 1pt solid; BORDER-LEFT: windowtext 1pt solid; BORDER-BOTTOM: windowtext 1pt solid\" width=\"301\">\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">限本校部分在校本科生</span></p>\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">（详见简章）</span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"BORDER-RIGHT: windowtext 1pt solid; BORDER-TOP: windowtext 1pt solid; BORDER-LEFT: windowtext 1pt solid; BORDER-BOTTOM: windowtext 1pt solid\" width=\"210\">\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 楷体_GB2312\">文化产业管理</span></p>\r\n			</td>\r\n			<td style=\"BORDER-RIGHT: windowtext 1pt solid; BORDER-TOP: windowtext 1pt solid; BORDER-LEFT: windowtext 1pt solid; BORDER-BOTTOM: windowtext 1pt solid\" width=\"135\">\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 楷体_GB2312\">辅修</span></p>\r\n			</td>\r\n			<td style=\"BORDER-RIGHT: windowtext 1pt solid; BORDER-TOP: windowtext 1pt solid; BORDER-LEFT: windowtext 1pt solid; BORDER-BOTTOM: windowtext 1pt solid\" width=\"60\">\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 楷体_GB2312\">一年</span></p>\r\n			</td>\r\n			<td style=\"BORDER-RIGHT: windowtext 1pt solid; BORDER-TOP: windowtext 1pt solid; BORDER-LEFT: windowtext 1pt solid; BORDER-BOTTOM: windowtext 1pt solid\" width=\"301\">\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 楷体_GB2312\">限本校部分在校本科生</span></p>\r\n				<p align=\"center\" style=\"TEXT-ALIGN: center\">\r\n					<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 楷体_GB2312\">（详见简章）</span></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('198','235','1','','','&amp;amp;ldquo;第四届全国话语语言学学术研讨会&amp;amp;rdquo;将于2012年10月20日至21日在中国传媒大学举办。本次学术会议由中国传媒大学外国语学院和全国话语语言学研究会联合举办，旨在促进（外国）语言学及应用语言学学术界的广','61.140.42.212','61.140.42.212','1345651699','<p align=\"left\" style=\"TEXT-INDENT: 2em; TEXT-ALIGN: left\">\r\n	&ldquo;第四届全国话语语言学学术研讨会&rdquo;将于2012年10月20日至21日在中国传媒大学举办。本次学术会议由中国传媒大学外国语学院和全国话语语言学研究会联合举办，旨在促进（外国）语言学及应用语言学学术界的广泛沟通和学术交流。</p>\r\n<p align=\"left\" style=\"TEXT-INDENT: 2em; TEXT-ALIGN: left\">\r\n	会议主题：现代话语语言学：传承与发展。工作语言为汉语/英语。</p>\r\n<p align=\"left\" style=\"TEXT-INDENT: 2em; TEXT-ALIGN: left\">\r\n	在此，我们真诚邀请各位学者前来参加会议。邀请函请见附件。&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('199','236','1','','','北京中传资产管理有限公司是经教育部批准，中国传媒大学下属的国有独资有限公司。现因业务发展需要招聘人员若干，招聘事宜公告如下：&amp;amp;nbsp;一、招聘岗位及要求&amp;amp;nbsp;1、物业管理人员?&amp;amp;nbsp; 工作内容：负责物业项目日','61.140.42.212','61.140.42.212','1345651724','<p style=\"TEXT-INDENT: 28pt\">\r\n	<span style=\"FONT-SIZE: 14pt; FONT-FAMILY: 宋体\">北京中传资产管理有限公司是经教育部批准，中国传媒大学下属的国有独资有限公司。</span></p>\r\n<p style=\"TEXT-INDENT: 28pt\">\r\n	<span style=\"FONT-SIZE: 14pt; FONT-FAMILY: 宋体\">现因业务发展需要招聘人员若干，招聘事宜公告如下：</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<b><span style=\"FONT-SIZE: 14pt; FONT-FAMILY: 宋体\">一、招聘岗位及要求</span></b></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<b><span style=\"FONT-SIZE: 14pt; FONT-FAMILY: 宋体\">1</span></b><b><span style=\"FONT-SIZE: 14pt; FONT-FAMILY: 宋体\">、物业管理人员</span></b></p>\r\n<p style=\"MARGIN-LEFT: 49.1pt; TEXT-INDENT: -21pt\">\r\n	<span style=\"FONT-SIZE: 14pt; FONT-FAMILY: Wingdings\">?&nbsp; </span><span style=\"FONT-SIZE: 14pt; FONT-FAMILY: 宋体\">工作内容：<br />\r\n	负责物业项目日常工作的监督和协调；负责物业项目管理与经营，制定全面运营工作计划并组织、实施；及时收集、整理有关提高服务质量方面的建议和信息；监督检查制度的执行。</span></p>\r\n<p style=\"MARGIN-LEFT: 49.1pt; TEXT-INDENT: -21pt\">\r\n	<span style=\"FONT-SIZE: 14pt; FONT-FAMILY: Wingdings\">?&nbsp; </span><span style=\"FONT-SIZE: 14pt; FONT-FAMILY: 宋体\">任职资格：<br />\r\n	1）、本科及以上学历，有物业管理工作经验或持物业管理上岗证者优先；<br />\r\n	2）、精通物业管理法规和业务，有实干精神，能妥善处理客户的重大投诉，帮助解决客户的重大困难；<br />\r\n	3）、具备处理突发事件的应急能力和良好的协调、沟通能力；<br />\r\n	4）、具备全面统筹工作能力，有先进、全面的物业管理知识和超前的管理理念；<br />\r\n	5）、性格开朗、沟通、协调、组织能力强，出色的管理能力和团队建设能力。</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<b><span style=\"FONT-SIZE: 14pt; FONT-FAMILY: 宋体\">2</span></b><b><span style=\"FONT-SIZE: 14pt; FONT-FAMILY: 宋体\">、办公室行政人员</span></b></p>\r\n<p style=\"MARGIN-LEFT: 49.1pt; TEXT-INDENT: -21pt\">\r\n	<span style=\"FONT-SIZE: 14pt; FONT-FAMILY: Wingdings\">?&nbsp; </span><span style=\"FONT-SIZE: 14pt; COLOR: #333333; FONT-FAMILY: 宋体\">工</span><span style=\"FONT-SIZE: 14pt; FONT-FAMILY: 宋体\">作内容：<br />\r\n	协助领导起草各类行政文件、信函、报告等，负责公文签收、存档管理； 负责公司高层工作会议组织、筹划，跟踪落实会议成果；督导公司日常管理制度和细则执行，传达和保存上级部门和公司的相关文件；完成上级交办的临时工作。</span></p>\r\n<p style=\"MARGIN-LEFT: 49.1pt; TEXT-INDENT: -21pt\">\r\n	<span style=\"FONT-SIZE: 14pt; FONT-FAMILY: Wingdings\">?&nbsp; </span><span style=\"FONT-SIZE: 14pt; FONT-FAMILY: 宋体\">任职资格：</span></p>\r\n<p style=\"MARGIN-LEFT: 70.1pt; TEXT-INDENT: -21pt\">\r\n	<span style=\"FONT-SIZE: 14pt; FONT-FAMILY: 宋体\">1)&nbsp; </span><span style=\"FONT-SIZE: 14pt; FONT-FAMILY: 宋体\">本科以上学历，专业不限；</span></p>\r\n<p style=\"MARGIN-LEFT: 70.1pt; TEXT-INDENT: -21pt\">\r\n	<span style=\"FONT-SIZE: 14pt; FONT-FAMILY: 宋体\">2)&nbsp; </span><span style=\"FONT-SIZE: 14pt; FONT-FAMILY: 宋体\">具备优秀的沟通和表达能力，具备良好的公文写作能力，熟练使用OFFICE办公系统软件;</span></p>\r\n<p style=\"MARGIN-LEFT: 70.1pt; TEXT-INDENT: -21pt\">\r\n	<span style=\"FONT-SIZE: 14pt; FONT-FAMILY: 宋体\">3)&nbsp; </span><span style=\"FONT-SIZE: 14pt; FONT-FAMILY: 宋体\">良好的学习能力和独立工作能力，工作细致，责任感强。踏实、稳重、大方、机灵、有服务意识；</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<b><span style=\"FONT-SIZE: 14pt; FONT-FAMILY: 宋体\">二、报名方式及期限：</span></b></p>\r\n<p style=\"MARGIN-LEFT: 42pt; TEXT-INDENT: -21pt\">\r\n	<span style=\"FONT-SIZE: 14pt; FONT-FAMILY: Wingdings\">?&nbsp; </span><span style=\"FONT-SIZE: 14pt; FONT-FAMILY: 宋体\">有意者请将个人简历电子版发送至邮箱：officecamc@cuc.edu.cn</span></p>\r\n<p style=\"MARGIN-LEFT: 42pt; TEXT-INDENT: -21pt\">\r\n	<span style=\"FONT-SIZE: 14pt; FONT-FAMILY: Wingdings\">?&nbsp; </span><span style=\"FONT-SIZE: 14pt; FONT-FAMILY: 宋体\">报名截止日期：2012年7月20日。</span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('200','237','1','','','本周校领导接待日时间定于3月15日（本周四）下午14：00至16：30，负责接待的校领导为苏志武校长。&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp; 凡要反映问题的师生员工可先到39号楼109室（联系电话：9319），由党委校长办公','61.140.42.212','61.140.42.212','1345651763','<div align=\"left\" style=\"TEXT-INDENT: 28pt; LINE-HEIGHT: 150%; TEXT-ALIGN: left\">\r\n	<span style=\"font-size: 14pt; line-height: 150%; \">本周校领导接待日时间定于</span><span style=\"font-size: 14pt; line-height: 150%; \">3</span><span style=\"font-size: 14pt; line-height: 150%; \">月</span><span style=\"font-size: 14pt; line-height: 150%; \">15</span><span style=\"font-size: 14pt; line-height: 150%; \">日（本周四）下午</span><span style=\"font-size: 14pt; line-height: 150%; \">14</span><span style=\"font-size: 14pt; line-height: 150%; \">：</span><span style=\"font-size: 14pt; line-height: 150%; \">00</span><span style=\"font-size: 14pt; line-height: 150%; \">至</span><span style=\"font-size: 14pt; line-height: 150%; \">16</span><span style=\"font-size: 14pt; line-height: 150%; \">：</span><span style=\"font-size: 14pt; line-height: 150%; \">30</span><span style=\"font-size: 14pt; line-height: 150%; \">，负责接待的校领导为苏志武校长。</span></div>\r\n<div align=\"left\" style=\"LINE-HEIGHT: 150%; TEXT-ALIGN: left\">\r\n	<span style=\"font-size: 14pt; line-height: 150%; \">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span style=\"font-size: 14pt; line-height: 150%; \">凡要反映问题的师生员工可先到</span><span style=\"font-size: 14pt; line-height: 150%; \">39</span><span style=\"font-size: 14pt; line-height: 150%; \">号楼</span><span style=\"font-size: 14pt; line-height: 150%; \">109</span><span style=\"font-size: 14pt; line-height: 150%; \">室（联系电话：</span><span style=\"font-size: 14pt; line-height: 150%; \">9319</span><span style=\"font-size: 14pt; line-height: 150%; \">），由党委校长办公室专人负责安排接待。</span></div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('201','238','1','','','学校电视台于6月26日全天和27日下午，通过校园有线电视网和校园互连网，在本台综合频道和视频网站，现场直播2012届本专科毕业典礼、2012届研究生毕业典礼暨学位授予仪式、&amp;amp;ldquo;中国传媒大学2010-2012年创先争优活动','61.140.42.212','61.140.42.212','1345651800','<p style=\"TEXT-INDENT: 2em\">\r\n	<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">学校电视台于6月26日全天和27日下午，通过校园有线电视网和校园互连网，在本台综合频道和视频网站，现场直播2012届本专科毕业典礼、2012届研究生毕业典礼暨学位授予仪式、&ldquo;中国传媒大学2010-2012年创先争优活动总结表彰大会&rdquo;，欢迎广大师生登录校电视台网站和有线网收看。</span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('202','239','1','','','1、采购单位： 中国传媒大学&amp;amp;nbsp; 2、项目名称： 互联网接入服务招标&amp;amp;nbsp;&amp;amp;nbsp; 3、项目编号： 中传招标[2012]第027号&amp;amp;nbsp;&amp;amp;nbsp; 4、中标人：&amp;amp;nbsp;&amp;amp;nbsp; 中国电信股份有限公司北京分公司&am','61.140.42.212','61.140.42.212','1345651832','<p>\r\n	<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">1</span><span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">、采购单位： 中国传媒大学&nbsp; </span></p>\r\n<p>\r\n	<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">2</span><span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">、项目名称： 互联网接入服务招标&nbsp;&nbsp; </span></p>\r\n<p>\r\n	<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">3</span><span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">、项目编号： 中传招标[2012]第027号&nbsp;&nbsp; </span></p>\r\n<p>\r\n	<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">4</span><span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">、中标人：&nbsp;&nbsp; 中国电信股份有限公司北京分公司&nbsp; </span></p>\r\n<p>\r\n	<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">5</span><span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">、中标金额： ￥850000.00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></p>\r\n<p>\r\n	<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">人民币大写：&nbsp; 捌拾伍万元整&nbsp; &nbsp;&nbsp;&nbsp; </span></p>\r\n<p>\r\n	<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></p>\r\n<p>\r\n	<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">联 系 人： 张老师 </span></p>\r\n<p>\r\n	<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">联系方式：&nbsp;010-65779373&nbsp; </span></p>\r\n<p>\r\n	<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<a href=\"mailto:zhaobiaoban@cuc.edu.cn\">zhaobiaoban@cuc.edu.cn</a></span></p>\r\n<p>\r\n	<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">&nbsp;&nbsp;&nbsp; </span></p>\r\n<p>\r\n	<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">公告期为自公示之日起3个工作日&nbsp; </span></p>\r\n<p>\r\n	<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">&nbsp;&nbsp;&nbsp; </span></p>\r\n<p align=\"right\" style=\"TEXT-ALIGN: right\">\r\n	<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">&nbsp;&nbsp;&nbsp; </span><span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">中国传媒大学招投标管理办公室</span></p>\r\n<p align=\"right\" style=\"TEXT-ALIGN: right\">\r\n	<span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体\">&nbsp;&nbsp;&nbsp; 2012-6-15</span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('203','240','1','','<!--#p8_attach#-->/cms/item/2012_08/23_00/a79f5e84a6fcbc8d.jpg.thumb.jpg','&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp; 受北京市委宣传部委托，由中国传媒大学和北京电视台联合进行的北京电视台节目评价与改版报告项目已基本完成。日前，中国传媒大学与北京电视台联合举行了该项目的总结交流会。苏志武校长、刘利群副','61.140.42.212','61.140.42.212','1345651930','<p align=\"center\" style=\"TEXT-INDENT: 2em\">\r\n	<img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25441&amp;filename=p1034_1342598010138.jpg\" /></p>\r\n<div align=\"left\">\r\n	&nbsp;&nbsp;&nbsp; 受北京市委宣传部委托，由中国传媒大学和北京电视台联合进行的北京电视台节目评价与改版报告项目已基本完成。日前，中国传媒大学与北京电视台联合举行了该项目的总结交流会。苏志武校长、刘利群副书记、廖祥忠副校长，北京电视台赵多佳总编辑、窦晓东常务副台长、朱江副总编辑、张亮副总编辑、王澎副台长，以及校台联合专家组成员、各联合工作组负责人、北京电视台有关部门和各节目中心负责人共150余人参加了会议。</div>\r\n<p align=\"center\" style=\"TEXT-INDENT: 2em\">\r\n	<img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25441&amp;filename=p1034_1342598065423.jpg\" /></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	总结交流会上，中国传媒大学党委宣传部部长孙杰与北京电视台研发部主任蒋虎，分别代表校台双方对合作过程与报告结果进行了回顾和介绍。他们认为，校台双方高度重视，携手并肩作战，投入包括联合专家组和14个专项工作小组在内的精英团队超过200人，历时半年时间，组织会议上百次，历经数十次的修改，最后经过联合专家组21位专家的反复研究和论证，形成了总计14个分项、20余万字的《北京电视台节目评价与改版报告》。校台双方通过这个项目不仅结下了深厚的友谊，也开创了主流电视媒体与高校深度合作模式的先河。</p>\r\n<p align=\"center\" style=\"TEXT-INDENT: 2em\">\r\n	<img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25441&amp;filename=p1034_1342598519251.jpg\" /></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	苏志武校长代表中国传媒大学祝贺北京电视台节目评价与改版报告的完成。他认为，报告是校台合作、协同创新的成果，是共同智慧的结晶。与北京电视台的精诚合作，对于提高我校师生的实践能力、提高办学质量，更好地服务社会有着重要的作用。他表示，有了这次成功合作的基础，双方的友谊将更加深厚，今后的合作将会更加紧密，合作的领域将会更加宽广。希望中国传媒大学与北京电视台携起手来，加强合作，协同创新，共同发展。</p>\r\n<p align=\"center\" style=\"TEXT-INDENT: 2em\">\r\n	<img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25441&amp;filename=p1034_1342598710776.jpg\" /></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	赵多佳总编辑在讲话中高度称赞合作成果，并对中国传媒大学领导和老师们的辛勤付出表示衷心感谢。她说，校台双方有着天然的血缘关系，为双方合作打下了良好的基础。她认为，目前需要将研究报告中富有价值的成果，转化成务实、可操作的行动，在市场竞争中结出硕果。她进一步指出，本次校台合作只是一个开始，今后的合作将沿着更加具体、更加细化的项目合作道路走下去。&nbsp;</p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	联合专家组主要专家中国传媒大学党委副书记刘利群、副校长廖祥忠，以及徐舫州、郎劲松、刘燕南等教授纷纷发言，对报告成果给予了高度评价，为北京电视台进一步推进成果转化，实现节目的改版升级提出了针对性的意见和建议。</p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	会议最后，刘利群副书记、赵多佳总编辑代表校台双方互赠纪念品并寄予了美好祝愿。</p>\r\n<p align=\"center\" style=\"TEXT-INDENT: 2em\">\r\n	<img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25441&amp;filename=p1034_1342598861935.jpg\" /></p>\r\n<p align=\"left\" style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p align=\"center\" style=\"TEXT-INDENT: 2em\">\r\n	<img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25441&amp;filename=p1034_1342598874578.jpg\" /></p>\r\n<p align=\"center\" style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p align=\"center\" style=\"TEXT-INDENT: 2em\">\r\n	<img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25441&amp;filename=p1034_1342667405972.jpg\" /></p>\r\n<p align=\"center\" style=\"TEXT-INDENT: 2em\">\r\n	北京电视台项目总结交流会集体合影</p>\r\n<p align=\"center\" style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p>\r\n	附：北京电视台致中国传媒大学的感谢函&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('204','241','1','','','2012年7月22至23日，袁军副校长率中国传媒大学师生学术代表团参加了在泰国曼谷朱拉隆公大学举办的第八届国际博士研究生学术研讨会。会议期间，袁军副校长与相关国际合作院校负责人就深化研究生合作办学、学术交流等事','61.140.42.212','61.140.42.212','1345651973','<p style=\"TEXT-INDENT: 2em\">\r\n	2012<span style=\"FONT-FAMILY: 宋体\">年</span>7<span style=\"FONT-FAMILY: 宋体\">月</span>22<span style=\"FONT-FAMILY: 宋体\">至</span>23<span style=\"FONT-FAMILY: 宋体\">日，袁军副校长率中国传媒大学师生学术代表团参加了在泰国曼谷朱拉隆公大学举办的第八届国际博士研究生学术研讨会。会议期间，袁军副校长与相关国际合作院校负责人就深化研究生合作办学、学术交流等事宜进行了富有成果的会谈。</span></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p align=\"center\" style=\"TEXT-INDENT: 2em; TEXT-ALIGN: center\">\r\n	<span style=\"text-indent: 2em; font-family: 宋体; \">国际</span><span style=\"text-indent: 2em; font-family: 宋体; \">博士研究生学术研讨会是由澳大利亚麦考瑞大学和清华大学发起的一个集学术研讨、人才培养、国际合作于一体的高端学术活动。研讨会旨在通过学术研讨的形式，促进合作院校在博士生培养、学术研究以及国际校际合作等方面开展深度交流与合作。目前共有包括麦考瑞大学、清华大学、巴黎第三大学（巴黎索邦大学）、泰国国立朱拉隆公大学、美国德克萨斯大学奥斯汀分校和中国传媒大学在内的六所院校参与了此项活动。</span></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	<span style=\"FONT-FAMILY: 宋体\">本次会议的主题是&ldquo;&lsquo;</span>M<span style=\"FONT-FAMILY: 宋体\">&rsquo;的世界：研究方法的跨学科拓展&rdquo;，集中研讨新闻传播和传媒研究的方法论问题。我校共有</span>9<span style=\"FONT-FAMILY: 宋体\">名博士生的学术论文通过评审，进入会议主题发言和海报展示环节，其中包括</span>2<span style=\"FONT-FAMILY: 宋体\">名留学我校的国际博士生。</span></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	<span style=\"FONT-FAMILY: 宋体\">袁军副校长代表中国传媒大学在会议开幕式上作了题为《&ldquo;渔&rdquo;胜于&ldquo;鱼&rdquo;&mdash;&mdash;中国传媒大学博士生方法课教学的几点思考》的主题演讲，详细介绍了我校博士研究生培养中方法论课程的设置思路和改革路径，获得与会者高度赞赏。</span></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	<span style=\"FONT-FAMILY: 宋体\">我校研究生院副院长田智辉教授、中国国际传播战略与发展研究中心常务副主任张毓强副教授，以及传播研究院教师黄典林博士分别担任了不同小组研讨的主持人和学术评议人。</span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('205','242','1','','<!--#p8_attach#-->/cms/item/2012_08/23_00/afa9ec23dfb52a78.jpg.thumb.jpg','2012年7月19日，由中美文化教育基金会发起、北京市委教育工委主办、中国传媒大学学生工作处承办的&amp;amp;ldquo;新世纪的丝绸之路&amp;amp;rdquo;之中美大学生文化交流活动在中国传媒大学综合实验楼400人报告厅拉开帷幕。此次活动吸','61.140.42.212','61.140.42.212','1345652038','<p>\r\n	2012年7月19日，由中美文化教育基金会发起、北京市委教育工委主办、中国传媒大学学生工作处承办的&ldquo;新世纪的丝绸之路&rdquo;之中美大学生文化交流活动在中国传媒大学综合实验楼400人报告厅拉开帷幕。此次活动吸引了来自中国传媒大学、北京交通大学、北京工商大学以及加州大学洛杉矶分校等中美两国十余所大学的两百余名师生。&nbsp;</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp; 北京市委教工委副书记唐立军、中国传媒大学副书记田维义、北京市教工委宣教处处长王达品、中国传媒大学学生处处长张根兴，加州大学洛杉矶分校（UCLA）副校长Janina Montero，美国国家癌症学会学部委员、加州大学尔湾分校医学院流行病学系主任Hoda Culver等出席活动。田维义副书记在欢迎辞中表示，&ldquo;新世纪的丝绸之路&rdquo;项目至今已有12年历史，期间成就了许多重要的中美教育界峰会、论坛和学术交流活动，并为上万名中美大学生和教育工作者搭建了沟通的桥梁，我校十分重视本次活动，也希望今后能够与该项目持续开展合作。在随后的颁奖仪式上，唐立军副书记致开幕词，他表示，&ldquo;新世纪的丝绸之路&rdquo;活动以丝绸和绘画为载体，推动了中美大学生的文化交流和感情沟通，增进了彼此了解，扩大了文化共识，也将推动北京作为中国特色世界城市的建设。</p>\r\n<p align=\"center\">\r\n	<span style=\"FONT-FAMILY: KaiTi_GB2312\"><img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25485&amp;filename=p1052_1342756244906.jpg\" /></span></p>\r\n<p align=\"center\">\r\n	<span style=\"FONT-FAMILY: KaiTi_GB2312\">北京市教工委唐立军副书记在颁奖仪式上致辞</span></p>\r\n<p align=\"center\">\r\n	<span style=\"FONT-FAMILY: KaiTi_GB2312\">&nbsp;</span></p>\r\n<p align=\"center\">\r\n	<span style=\"FONT-FAMILY: KaiTi_GB2312\"><img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25485&amp;filename=p1052_1342756362215.jpg\" /></span></p>\r\n<p align=\"center\">\r\n	<span style=\"FONT-FAMILY: KaiTi_GB2312\">田维义副书记为获得丝画大赛一等奖的学生颁奖</span><span style=\"FONT-FAMILY: KaiTi_GB2312\">&nbsp;</span></p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp; 为使活动突出文化交流主题、凸显民族文化特色，我校周密部署，精心组织安排了交流活动的各个环节。在五个多小时的交流活动中，中美学生文化论坛、丝画展示评选、&ldquo;丝画设计大赛&rdquo;颁奖仪式等环节精彩纷呈，既突出了&ldquo;弘扬践行北京精神、增进中美文化交流&ldquo;的主题，又开拓了首都大学生的国际视野，加深了中美大学生之间的文化和思想交流。</p>\r\n<p align=\"center\">\r\n	<span style=\"FONT-FAMILY: KaiTi_GB2312\"><img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25485&amp;filename=p1052_1342756273300.jpg\" /></span></p>\r\n<p align=\"center\">\r\n	<span style=\"FONT-FAMILY: KaiTi_GB2312\">中美学生丝画作品展示 </span></p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp; 为给大家提供充分交流的机会，中美学生文化论坛分为分论坛和总论坛两部分。参加活动的中美大学生首先分组至四个分论坛展开主题为&ldquo;中美友谊对世界和平的重要性&rdquo;的热烈讨论，之后又齐聚总论坛，由各组代表向大会作主题发言，分享交流成果。</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp; 作为&ldquo;新世纪的丝绸之路&rdquo;中美大学生文化交流活动的重要组成部分，本次丝画设计大赛共征集到数十所中美高校大学生设计的作品百余幅，大赛从众多提交作品中共评出中美双方一、二、三等奖各三名，鼓励奖各五名。由到场的中美领导嘉宾为两国获奖大学生颁发了获奖证书和奖品。为感谢加州大学洛杉矶分校（UCLA）副校长Janina&nbsp;Montero对中美大学生文化交流活动的支持，大赛授予其&ldquo;特别贡献奖&rdquo;称号。随后，我校学生精心准备的精彩歌舞表演为颁奖典礼锦上添花，并博得了台下观众的阵阵掌声。此次文化交流活动在和平友好的氛围中圆满结束。 &nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('206','243','1','','','6月28日下午，台州广播电视台《600全民新闻》节目办公室的电话骤然响起，原来是该市黄岩区一家制造太空杯的工厂发生火灾。我校实习记者徐鑫和电视台另外两名记者带上设备，立即驱车赶赴火灾现场实施报道。火灾现场一','61.140.42.212','61.140.42.212','1345652094','<div class=\"content_main\">\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		6月28日下午，台州广播电视台《600全民新闻》节目办公室的电话骤然响起，原来是该市黄岩区一家制造太空杯的工厂发生火灾。我校实习记者徐鑫和电视台另外两名记者带上设备，立即驱车赶赴火灾现场实施报道。</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		火灾现场一片惨烈，滚滚浓烟直冲天际，不时响起的爆炸声震耳欲聋，几十辆消防车停在了工厂附近，奋力灭火，交警在忙着疏散现场&hellip;&hellip;</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		在没有任何防护措施的情况下，徐鑫同学和同伴立即投入到现场报道中，通过即时画面播报火灾现场的情景，特别是消防战士手持高压水枪奋力灭火的壮举。由于火势猛烈，在离现场几十米开外的地方就已经让人感到高温难耐，塑料燃烧产生的难闻气味也让人不得不捂住鼻子。&ldquo;我们要接近现场往火势最猛的地方去，这样才能拍摄到最真实的场景。&rdquo;事后徐鑫这样说道。</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		这次新闻现场播报，是2009级广播电视新闻学专业学生徐鑫来台州广播电视总台实习的第三天遇到的事。回想那次现场拍摄经历，徐鑫别有一番感触：&ldquo;记者还要顶着最艰辛的环境做现场出镜。这样的情况是给记者们的一个选择，一个职业精神与生命安全之间的选择，其实无论是哪个都是无可厚非的。&rdquo;</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		《600全民新闻》是台州电视台的一档民生新闻节目，几乎每天都会遇到各种各样的突发性事件，记者总会在第一时间赶到现场。这样的任务，对于实习生徐鑫来说，不仅仅是采访实践的磨练机会，也是一次次真实的考验。在实习的这两周里，她克服了很多困难，也积累了不少的经验。徐鑫同学的敬业精神受到了电视台记者的肯定，影视文化频道的记者蒋琦说：&ldquo;徐鑫同学能够虚心向指导老师求教钻研业务，现在已经很好地掌握了新闻采访写作的方法，表现良好。&rdquo;</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		包括徐鑫在内，今年来台州广播电视台参加教务处顶岗实习项目的共有六名同学，分别在台州电视台新闻综合频道、影视文化频道和公共财富频道等频道实习实践，或参加采访，或参与播音，或承担技术。尽管实习实践岗位不同，有的同学还是第一次参加这样的实践，但是同学们的责任感一样的强，干劲一样的足，他们知道，只有通过一线实践，才能更好地理解、把握和运用好在课堂上学到的知识，同时，通过实践锻炼和磨砺，又可以进一步增强学校学习的针对性和主动性。正如2011级新闻双学位的王娟同学所说的那样，&ldquo;参与顶岗实习，跟着记者真正进行一次实地采访，才真正明白新闻报道应该怎么做&rdquo;。</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		雨季过后，台州进入夏季高温天气，实习生们每天都要跟随记者，冒着35℃以上的高温奔赴各地参与新闻拍摄。尽管如此，同学们没有一个叫苦，叫累，而是以他们的坚韧和毅力，用他们的学识和智慧，为台州广播电视事业贡献着点点滴滴，同时也在这点点滴滴中成长成熟&hellip;&hellip;</p>\r\n	<p align=\"right\" style=\"TEXT-INDENT: 2em\">\r\n		（文：曹坤、王悦&nbsp;图：王晴沐洋、王悦 编辑：王维家）&nbsp;</p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('207','244','1','','<!--#p8_attach#-->/cms/item/2012_08/23_00/e8823f5e58f887e7.jpg.thumb.jpg','2012年7月10日，廖祥忠副校长赴清华大学、北京师范大学开展科研专项调研，文科科研处处长胡智锋等陪同调研，标志着我校人文社会科学专项系列调研活动正式启动。&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp; 为贯彻落实《教育部关于推进高等学','61.140.42.212','61.140.42.212','1345652188','<div class=\"content_main\">\r\n	<p>\r\n		2012年7月10日，廖祥忠副校长赴清华大学、北京师范大学开展科研专项调研，文科科研处处长胡智锋等陪同调研，标志着我校人文社会科学专项系列调研活动正式启动。</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp; 为贯彻落实《教育部关于推进高等学校哲学社会科学繁荣发展的意见》、《高等学校哲学社会科学繁荣计划（2011&mdash;2020年）》、《中共中国传媒大学委员会关于深入推进哲学社会科学繁荣发展的意见》等文件精神，推动协同创新及我校哲学社会科学的全面发展，文科科研处启动了人文社会科学专项系列调研活动，旨在学习北京各高校的人文社科管理经验，推动我校文科科研管理机制创新，全面提升我校人文社科科研管理水平和文科科研质量，制定人文社科科学管理的长远规划。</p>\r\n	<p align=\"center\">\r\n		<img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25387&amp;filename=p1052_1341991110442.jpg\" /></p>\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp; 在清华大学，调研团队与清华大学主管文科科研管理的领导、专家进行了深入座谈。清华大学党委副书记邓卫向调研团队介绍了清华大学恢复重建文科30年来的科研管理概况，着重介绍了文科分类管理、建立文科科研评价与衡量体系、以及如何贯彻国家&ldquo;十二五&rdquo;规划和教育部、财政部&ldquo;协同创新&rdquo;等文件精神的举措。清华大学文科建设处副处长仲伟民、科研机构管理办公室主任甄树宁等介绍了清华大学文科科研管理的经验与细则，并着重介绍了主管科研的科研院与文科建设处的机构设置、对学校科研机构的认定与评估、科研信息管理系统等方面的做法与经验。</p>\r\n	<p align=\"center\">\r\n		<img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25387&amp;filename=p1052_1341991123180.jpg\" /></p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp; 在北京师范大学，北京师范大学党委副书记田辉、社科处处长刘复兴、副处长田晓刚等向调研团队详细介绍了该校在人文社科项目、经费、成果管理与奖励机制等方面的经验。双方还就各自在人文社科管理方面面临的问题及未来的发展进行了深入探讨与交流。</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp; 此次调研加强了我校与兄弟高校科研管理机构的沟通与联系，有助于我校深入了解兄弟高校在人文社科方面的管理经验，开阔视野，对于我校人文社科科研的项目管理、经费管理、成果认定、奖励制定等相关管理制度的改进与提升具有重要的意义。</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp; 此次北京高校调研考察是文科科研处专项系列调研活动的第一站，调研团队随后将陆续赴外地高校深入开展调研，于今年年底形成调研报告，为形成富有我校特色的人文社会科学科研管理体制提供经验借鉴。</p>\r\n	<p align=\"right\">\r\n		(文：曾祥敏 编辑：王维家)&nbsp;</p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('208','245','1','','','2012年7月7日下午，著名影视制片人张纪中在我校举行了一场别开生面的讲座，与同学们分享了《西游记》的创作历程。MBA学院张树庭院长为张纪中颁发了中传MBA实践导师聘书。张纪中表示，重拍《西游记》是一个巨大的挑战','61.140.42.212','61.140.42.212','1345652212','<div class=\"content_main\">\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		2012年7月7日下午，著名影视制片人张纪中在我校举行了一场别开生面的讲座，与同学们分享了《西游记》的创作历程。MBA学院张树庭院长为张纪中颁发了中传MBA实践导师聘书。</p>\r\n	<p align=\"center\" style=\"TEXT-INDENT: 2em\">\r\n		<img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25395&amp;filename=p1034_1342145778258.jpg\" /></p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		张纪中表示，重拍《西游记》是一个巨大的挑战，一次全新的考验。如何在重拍过程中达到前所未有的效果，难度非常大，投资大半给了特技班底，邀请了特效造型师加盟，通过乳胶发泡技术，将剧中人物形象逼真再现，还首度使用微型模型和等比例模型的联动拍摄。</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		谈到重拍《西游记》的初衷，张纪中表示这是他的梦想和理想，孙悟空不羁的性格、大智大勇的精神，值得去重新演绎。《西游记》也具有强烈的现实意义，剧中运用巧妙的比喻，将人心中的魔鬼外化成了妖魔鬼怪。西天取经路其实就是人生的征程，在每一个路口都会有占有欲、权利欲等人性的弱点。人性的真善美、假恶丑都在《西游记》里能够找到。《西游记》为我们呈现的是人生历练的过程，&ldquo;励志&rdquo;才是《西游记》的精神所在。另外《西游记》所体现出的团结，对统一理想的追求，恰是当下职场和企业建设乃至和谐社会最需要的。</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		张纪中告诫同学们，优秀的制片人要有强烈的社会责任感，工作过程中要不断磨练自己，提升自身文化修养，坚定不移地为理想而战，相信理想感动自己的同时，也能感动其他人一起来完成追寻的事业。</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		张纪中从作品谈到人生，从理想谈到现实，富有感染力的演讲，赢得了在场观众阵阵掌声。</p>\r\n	<p align=\"right\" style=\"TEXT-INDENT: 2em\">\r\n		（文：汪琴、旷小勇&nbsp;图：李冬雾）&nbsp;</p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('234','288','1','','','创新中国DEMO CHINA”是由创业邦举办的一场面向国内外创业者的创业大赛，截止2012年已举办七年，吸引了包括大陆、港台、加拿大等国家地区的创业者参与，因聚集了国内外最优质的潜力项目，创新中国 ','221.237.121.196','221.237.121.196','1358738248','创新中国DEMO CHINA&rdquo;是由创业邦举办的一场面向国内外创业者的创业大赛，截止2012年已举办七年，吸引了包括大陆、港台、加拿大等国家地区的创业者参与，因聚集 了国内外最优质的潜力项目，创新中国 DEMO CHINA已然成为国内外创业项目展示的第一平台，创业、投资趋势的风向标，受到业内创业者和投资人的强烈关注。现&ldquo;创新中国DEMO CHINA 2013&rdquo;春季赛已启动，准备对&ldquo;创新中国DEMO CHINA&rdquo;app应用版本更新，地址：https://itunes.apple.com/cn/app/chuang-xin-zhong-guo /id551344402?mt=8');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('249','309','1','','','234323243232','127.0.0.1','127.0.0.1','1366773633','234323243232');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('250','313','1','','http://nw3.php168.net/gov3/attachment/cms/item/2012_03/05_17/6568c6548c29d1fa.jpg','&amp;amp;nbsp; 为认真学习贯彻党的十七届六中全会，切实用全会精神统一住建系统广大党员干部群众的思想，进一步提高认识，振奋精神，推进建设系统文化大发展大繁荣。根据市委&amp;amp;laquo;中共温州市委办公室关于做好党的十七届六','127.0.0.1','127.0.0.1','1370495199','<p>\r\n	<span style=\"FONT-FAMILY: Arial\"><span style=\"FONT-SIZE: medium\">&nbsp; 为认真学习贯彻党的十七届六中全会，切实用全会精神统一住建系统广大党员干部群众的思想，进一步提高认识，振奋精神，推进建设系统文化大发展大繁荣。根据市委&laquo;中共温州市委办公室关于做好党的十七届六中全会精神宣讲工作的通知&raquo;(温委办发[2011]152号)文件通知精神，12月6日，住建委邀请市委宣讲团成员、市委党校副校长胡瑞怀同志作深入学习贯彻党的十七届六中全会精神的专题报告。<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 建委副主任倪忠礼主持报告会，市房管局、园林局、工务局、市住房公积金管理中心、委直属各单位领导班子成员及委机关全体工作人员参加了报告会。<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 胡校长在报告中围绕如何正确认识党的十七届六中全会的重大意义、如何把握党的十七届六中全会基本精神、如何贯彻落实党的十七届六中全会提出的目标任务作了深刻的阐释和解读。同时紧密结合我国文化发展的实际，回顾总结了改革开放特别是党的十六大以来文化建设取得的巨大成就，认真分析了推进文化改革发展的重要性和紧迫性，生动阐述了中国特色社会主义文化发展道路的基本内涵与要求，深刻阐明了新形势下深化文化体制改革、推动社会主义文化大发展大繁荣的指导思想、主要方针和目标任务。<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 胡校长的报告深入简出、通俗易懂，紧密联系当前国际国内形势发展变化与我国文化改革发展实践，贴近群众的思想实际。整场报告逻辑严谨，思想深刻，既有理论思考又有实践总结，既有观点阐释又有事实说明，在现场听众中引起积极反响。聆听此次报告会的同志纷纷表示，本场报告对于我委进一步领会十七届六中全会精神、体会《决定》的重大意义、提高住建系统文化建设的自觉性有很大的帮助。（</span></span><span style=\"FONT-FAMILY: Arial\"><span style=\"FONT-SIZE: medium\">住建委宣教处）</span></span></p>\r\n<p style=\"TEXT-ALIGN: center\">\r\n	<span style=\"FONT-SIZE: medium\"><span style=\"FONT-FAMILY: Arial\"><img alt=\"\" height=\"464\" src=\"http://www.wzcb.gov.cn/JC_Data/JC_Edt/etc/20111209153555309.jpg\" width=\"700\" /></span></span></p>\r\n<p style=\"TEXT-ALIGN: center\">\r\n	<span style=\"FONT-FAMILY: Arial\"><span style=\"FONT-SIZE: medium\"><img alt=\"\" height=\"457\" src=\"http://www.wzcb.gov.cn/JC_Data/JC_Edt/etc/20111209153619488.jpg\" width=\"700\" /></span></span></p>\r\n<p style=\"TEXT-ALIGN: center\">\r\n	<span style=\"FONT-SIZE: medium\"><span style=\"FONT-FAMILY: Arial\"><img alt=\"\" src=\"http://www.wzcb.gov.cn/JC_Data/JC_Edt/etc/20111209153632363.jpg\" /></span></span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('251','314','1','','','1313131313','127.0.0.1','127.0.0.1','1370511539','1313131313');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('252','315','1','','','　　','127.0.0.1','183.29.231.196','1370542402','<p>\r\n	　 &nbsp; &nbsp; 国微站群系统（软件著作权登记书：2011SR002495）主要是面向政府、学校、企业集团。实现主站管理分站、网站信息相互推送共享，可大幅降低成本和实现高质量信息化。是国内的最主流的站群模式之一。国微CMS也是中国南方在PHP领域最大的开源系统提供商，客户包括清华大学、部队、集团等。</p>\r\n<p>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;国微站群系统---分站演示：国微CMS旗下的任意以下方案均可作为站群分站；每个分站为独立的方案、独立的数据库，独立的顶级域名以及独立的空间。完美实现数据相互推送，主站管理分站的网站群统筹模式。是国内公认的最先进的站群模式。</p>\r\n<div>\r\n	　</div>\r\n<p>\r\n	　　<font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\">媒体门户分站：<a href=\"http://php168.cn/\" style=\"outline-style: none; color: rgb(0,112,175)\" target=\"_blank\">http://php168.cn</a></font><br style=\"outline-style: none\" />\r\n	　　<font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\">学校门户分站：<a href=\"http://company.php168.net/mh\" style=\"outline-style: none; color: rgb(0,112,175)\" target=\"_blank\">http://company.php168.net/mh</a></font><br style=\"outline-style: none\" />\r\n	　　<font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">政府部队分站：<a href=\"http://gov.php168.net/\" style=\"outline-style: none; color: rgb(0,112,175)\" target=\"_blank\">http://gov.php168.net</a></font></font><br style=\"outline-style: none\" />\r\n	　　<font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">集团企业分站：<a href=\"http://php168.cn/com3\" style=\"outline-style: none; color: rgb(0,112,175)\" target=\"_blank\">http://php168.cn/com3</a></font></font><br style=\"outline-style: none\" />\r\n	　　学<font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">校院系分站：<a href=\"http://php168.cn/school\" style=\"outline-style: none; color: rgb(0,112,175)\" target=\"_blank\">http://php168.cn/school</a></font></font><br style=\"outline-style: none\" />\r\n	　　<font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">国微内网分站：<a href=\"http://php168.cn/nw\" style=\"outline-style: none; color: rgb(0,112,175)\" target=\"_blank\">http://php168.cn/nw</a></font></font><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><span style=\"outline-style: none; color: rgb(102,51,204)\"><b style=\"outline-style: none\"><font size=\"5\" style=\"line-height: 1.1em; outline-style: none\"><span style=\"outline-style: none; color: rgb(0,0,0)\">国微站群----主站演示：</span></font></b></span></font><br style=\"outline-style: none\" />\r\n	　　　　<br style=\"outline-style: none\" />\r\n	　　<font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><span style=\"outline-style: none; color: rgb(102,51,204)\"><b style=\"outline-style: none\"><font size=\"5\" style=\"line-height: 1.1em; outline-style: none\"><span style=\"outline-style: none; color: rgb(0,0,0)\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><span id=\"att_71047\" style=\"outline-style: none\"><img border=\"0\" src=\"http://bbs.php168.net/attachment123456br666vh00/Day_120402/10276_40001_6f126bf00e54e91.jpg\" style=\"outline-style: none\" /></span><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"4\" style=\"line-height: 1.1em; outline-style: none\">国微</font><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"4\" style=\"line-height: 1.1em; outline-style: none\">站群详细介绍：</font><a href=\"http://www.php168.net/page/zq.html\" style=\"outline-style: none; color: rgb(0,112,175)\" target=\"_blank\">http://www.php168.net/page/zq.html</a>&nbsp;</font></font></font><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"4\" style=\"line-height: 1.1em; outline-style: none\">主站演示：</font><a href=\"http://z.php168.net/admin.php/core/cluster-index\" style=\"outline-style: none; color: rgb(0,112,175)\" target=\"_blank\">http://z.php168.net/admin.php/core/cluster-index</a></font></span></font></b></span></font><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><span style=\"outline-style: none; color: rgb(102,51,204)\"><font size=\"5\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">学校、政府、媒体、企业<span style=\"outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">：</font>站群测试申请地址：<a href=\"http://www.php168.net/index.php/forms-post?mid=2\" style=\"outline-style: none; color: rgb(0,112,175)\" target=\"_blank\">http://www.php168.net/index.php/forms-post?mid=2</a></span></font></font></span></font><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">联系电话：020-87202645&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; QQ：1184440934&nbsp;</font></font><br style=\"text-align: left; line-height: 24px; outline-style: none; font-family: Arial; color: rgb(51,51,51); font-size: 14px\" />\r\n	　　<br style=\"text-align: left; line-height: 24px; outline-style: none; font-family: Arial; color: rgb(51,51,51); font-size: 14px\" />\r\n	　　<br style=\"text-align: left; line-height: 24px; outline-style: none; font-family: Arial; color: rgb(51,51,51); font-size: 14px\" />\r\n	　　<b style=\"text-align: left; line-height: 24px; outline-style: none; font-family: Arial; color: rgb(51,51,51); font-size: 14px\"><font size=\"5\" style=\"line-height: 1.1em; outline-style: none\">国微站群核心优势：</font></b><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<b style=\"text-align: left; line-height: 24px; outline-style: none; font-family: Arial; color: rgb(51,51,51); font-size: 14px\"><font size=\"5\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">A、<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">系统的高安全性</font></font></font></b><font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\">。采用了二十余种安全措施以及严格的代码<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">编写<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">模式</font></font>，系统已深入使用到集团、政府、部队。<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><b style=\"outline-style: none\">B、<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">国微</font>站群模式</b><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><b style=\"outline-style: none\">：</b><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">每个分站<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">都是独立的系统平台，享受独立的数据库、顶级<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">域名和空间。每个分站有自我的运营体系。<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><b style=\"outline-style: none\">C、</b><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><b style=\"outline-style: none\">千万级数据负载能力</b><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><b style=\"outline-style: none\">：</b></font></font></font></font></font></font></font></font></font><font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">国微<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">CMS是<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">现<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">阶段国内唯一一家提供千万级数据演示平台（常规环境下）的厂商<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">，属高端<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">核心优势。</font></font></font></font></font></font></font></font></font><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><b style=\"outline-style: none\">D、海量数据搜索能力：</b>500万级海量数据下，搜索数千条内容消耗时间不到0.5秒。<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><b style=\"outline-style: none\">E、国微<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">系统底层</font>体系</b><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><b style=\"outline-style: none\">化：</b><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">体系是一个软件的灵魂，国<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">微<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">的12大体系融入了系统架构，极大了满足了系统的实用性、可靠性。</font></font></font></font></font></font></font></font></font></font></font></font></font></font><br style=\"outline-style: none\" />\r\n	　　..........................</font><br style=\"outline-style: none\" />\r\n	　　<br style=\"text-align: left; line-height: 24px; outline-style: none; font-family: Arial; color: rgb(51,51,51); font-size: 14px\" />\r\n	　　<font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><span style=\"outline-style: none; color: rgb(255,0,0)\"><b style=\"outline-style: none\">系统优势视频介绍（推荐阅读）：<a href=\"http://v.ifeng.com/vblog/paike/201206/c391f30b-3728-935b-04bb-add9c96ca164.shtml\" style=\"outline-style: none; color: rgb(0,112,175)\" target=\"_blank\">http://v.ifeng.com/vblog/paike/201206/c391f30b-3728-935b-04bb-add9c96ca164.shtml</a></b></span></font></font><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font face=\"tahoma, \" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51); font-size: 14px\"><span style=\"outline-style: none; color: rgb(68,68,68)\"><span style=\"outline-style: none\"><span style=\"outline-style: none; color: rgb(0,0,0)\"><b style=\"outline-style: none\"><font size=\"5\" style=\"line-height: 1.1em; outline-style: none\">国微站群应用对象：</font></b></span></span></span></font><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><span style=\"outline-style: none; color: rgb(102,51,204)\"><font size=\"5\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><span style=\"outline-style: none\"><span style=\"outline-style: none; color: rgb(0,0,255)\">A、政府单位站群：</span><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font face=\"tahoma, \" style=\"line-height: 1.1em; outline-style: none\"><span style=\"outline-style: none; color: rgb(68,68,68)\"><span style=\"outline-style: none\">最有效的政府信息化技术模式，是成熟政府平台的首选应用，能避免重复建设。极大降低成本和保障信息畅通，<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　请重点关注相关视频介绍。</span></span></font><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<span style=\"outline-style: none; color: rgb(0,0,255)\">B、部队单位站群:</span><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font face=\"tahoma, \" style=\"line-height: 1.1em; outline-style: none\"><span style=\"outline-style: none; color: rgb(68,68,68)\"><span style=\"outline-style: none\">上级主站与分站可以相互推送数据，信息无延时畅通。多系列分站方案快速实施内部高效信息化</span></span></font><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<span style=\"outline-style: none; color: rgb(0,0,0)\"><span style=\"outline-style: none; color: rgb(0,0,255)\">C、学校单位站群:</span></span><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font face=\"tahoma, \" style=\"line-height: 1.1em; outline-style: none\"><span style=\"outline-style: none; color: rgb(68,68,68)\"><span style=\"outline-style: none\">学校一般有数十个部门和学院，国微站群可协助学校达到网站群的有效管理、端口标准、数据互通等高标准信息化。</span></span></font><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<span style=\"outline-style: none; color: rgb(0,0,255)\">D、企业集团站群：</span><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font face=\"tahoma, \" style=\"line-height: 1.1em; outline-style: none\"><span style=\"outline-style: none; color: rgb(68,68,68)\"><span style=\"outline-style: none\">集团统筹所有分公司信息平台，国微提供企业平台数十个模块和多套模板，一键替换。</span></span></font><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<span style=\"outline-style: none; color: rgb(0,0,255)\">E、媒体门户站群：</span><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font face=\"tahoma, \" style=\"line-height: 1.1em; outline-style: none\"><span style=\"outline-style: none; color: rgb(68,68,68)\"><span style=\"outline-style: none\">媒体下面如有多个分站门户，可启用站群。分站为独立数据库、独立域名、独立管理体系</span></span></font><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font face=\"tahoma, \" style=\"line-height: 1.1em; outline-style: none\"><span style=\"outline-style: none; color: rgb(68,68,68)\"><span style=\"outline-style: none\">F、国微CMS系统千万级数据负载、高速页面速度、高安全性是官方的核心优势和客户运营的有力保障</span></span></font></span></font></font></span><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font size=\"5\" style=\"line-height: 1.1em; outline-style: none\"><b style=\"outline-style: none\">系统高性能说明</b></font>&nbsp;<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　1、系统支持主从服务器结构，千万级数据应用时，系统可无限添加多台从服务器分担负载，并支持服务器读写分离。&nbsp;<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　2、支持Memcached应用，能大幅度提高系统效率，需匹配官方特有PHP环境套件。&nbsp;<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　3、全方位支持sphinx方案，让国微CMS系统负载在海量级数据应用时，能从容应对。(需专业人士配置，不懂sphinx<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　的朋友需要官方的协助。)&nbsp;<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　4、官方采取了多进程同时静态、一个进程批量静态的模式，将静态能力处理得比较完美，静态化能力达到10万条/小时&nbsp;<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　5、支持系统分表分库，让海量数据负载时能合理分担。&nbsp;<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　6、系统支持百万计会员注册，根据服务器带宽等实际因素，系统支持门户级网站同时在线人数。&nbsp;<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　7、新版中具有严格而标准的代码体系 ,重视提供强健的系统核心&nbsp;<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　8、国微官方已经联系广州重点大学实验室进行第三方性能测试。&nbsp;<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font size=\"5\" style=\"line-height: 1.1em; outline-style: none\"><b style=\"outline-style: none\">三、站群系统架构</b></font>&nbsp;<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　A、站群遵循&ldquo;核心+系统+模块+插件&rdquo;的技术架构，拓展灵活。&nbsp;<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　B、搭建---政府主站+N个政府局级分站&nbsp;<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　C、如分站下属还有关联站点，则此分站也可以成为主站并与附属站点关联。&nbsp;<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　E、站群系统即为交换机，所有推送数据在此中转、存储、推送、管理。&nbsp;<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　F、站群功能服务可以不断增加模块&nbsp;</font><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<br style=\"text-align: left; line-height: 24px; outline-style: none; font-family: Arial; color: rgb(51,51,51); font-size: 14px\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><span id=\"att_71046\" style=\"outline-style: none\"><img border=\"0\" src=\"http://bbs.php168.net/attachment123456br666vh00/Day_120402/10276_40001_e9a4b66b198661a.gif\" style=\"outline-style: none\" /></span>&nbsp;</font></font><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　</p>\r\n<div align=\"left\" style=\"outline-style: none; word-wrap: break-word; word-break: break-all\">\r\n	　　<b style=\"line-height: 24px; outline-style: none; font-family: Arial; color: rgb(51,51,51); font-size: 14px\"><font face=\"tahoma, \" style=\"line-height: 1.1em; outline-style: none\"><font size=\"5\" style=\"line-height: 1.1em; outline-style: none\"><span style=\"outline-style: none\">国微系统体系化介绍：</span></font></font></b></div>\r\n<br style=\"outline-style: none\" />\r\n<div align=\"left\" style=\"outline-style: none; word-wrap: break-word; word-break: break-all\">\r\n	　　<font size=\"3\" style=\"line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><span style=\"outline-style: none\"><span style=\"outline-style: none; color: rgb(0,0,0)\"><font face=\"arial \" style=\"line-height: 1.1em; outline-style: none\">体系是软件系统的灵魂，2010年国微CMS推出的二代架构，开发之前共梳理了12大体系，作为系统开发的基石，</font></span></span></font></div>\r\n<div align=\"left\" style=\"outline-style: none; word-wrap: break-word; word-break: break-all\">\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font size=\"3\" style=\"line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><span style=\"outline-style: none\"><span style=\"outline-style: none; color: rgb(0,0,0)\"><font face=\"arial \" style=\"line-height: 1.1em; outline-style: none\">确保用户成功。</font></span></span></font></div>\r\n<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\n<font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><span style=\"outline-style: none; color: rgb(0,0,0)\">模块化体系：所有功能均已系统化、模块化、插件化，如CMS、问答、广告、标签</span><br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\n<span style=\"outline-style: none; color: rgb(0,0,0)\">用户体系： 不仅区分企业、个人，并可自由添加角色组与角色，使其用户体系与实体一致。</span><br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\n<span style=\"outline-style: none; color: rgb(0,0,0)\">权限体系： 所有功能模块封装并与权限匹配，可以细化至栏目对接角色管理权限。</span><br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\n<span style=\"outline-style: none; color: rgb(0,0,0)\">标签体系： 常规标签、变量标签、标签后缀、标签缓存体系等已全面实施。</span><br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\n<span style=\"outline-style: none; color: rgb(0,0,0)\">模板体系： 从方案模板、会员中心、系统模块模板、栏目、列表页面、内容页完全可独立选择。</span><br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\n<span style=\"outline-style: none; color: rgb(0,0,0)\">积分体系： 积分兑换、积分消费、积分规则等已经开始在系统内实施。</span></font><br style=\"outline-style: none\" />\r\n<div align=\"left\" style=\"outline-style: none; word-wrap: break-word; word-break: break-all\">\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font size=\"3\" style=\"line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><font face=\"tahoma, \" style=\"line-height: 1.1em; outline-style: none\"><span style=\"outline-style: none; color: rgb(68,68,68)\"><span style=\"outline-style: none\"><span style=\"outline-style: none; color: rgb(0,0,0)\">菜单体系： 后台菜单、前台菜单、会员中心菜单均可自由添加和控制。&nbsp;</span><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<span style=\"outline-style: none; color: rgb(0,0,0)\">安全体系： 支持IP黑名单、白名单、支持防CC攻击、支持批量过滤敏感词汇。</span></span></span></font></font></div>\r\n<br style=\"outline-style: none\" />\r\n<div align=\"left\" style=\"outline-style: none; word-wrap: break-word; word-break: break-all\">\r\n	　　<font face=\"tahoma, \" style=\"line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51); font-size: 14px\"><span style=\"outline-style: none; color: rgb(68,68,68)\"><span style=\"outline-style: none\"><span style=\"outline-style: none; color: rgb(0,0,0)\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">通讯体系： 手机模块、邮件模块、短消息模块均已做成接口模式，任意功能均可方便调用。&nbsp;</font></span><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　<font size=\"2\" style=\"line-height: 1.1em; outline-style: none\"><span style=\"outline-style: none; color: rgb(0,0,0)\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">程序整合体系：将支持PHPwind、UC、国微CMS自身等系统整合，同时互动百科也将整合。</font></span></font></span></span></font><br style=\"outline-style: none\" />\r\n	　　<br style=\"outline-style: none\" />\r\n	　　</div>\r\n<br style=\"outline-style: none\" />\r\n<font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><font size=\"5\" style=\"line-height: 1.1em; outline-style: none\"><b style=\"outline-style: none\">站群系统功能</b></font>&nbsp;<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nA、站群、主站、多个分站可以放置在同一服务器中，减低成本。&nbsp;<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nB、主站可以推送数据分站，一站式共享&nbsp;<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nC、分站可以设定自动接收、或手动审核接收推送信息。&nbsp;<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nD、提供日志管理&nbsp;<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nE、可以添加分站管理员管理分站。&nbsp;<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nF、站群可以先设定公共栏目，分站设定自身栏目与公共栏目对接&nbsp;<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nG、站群服务实现模块话，可以开启或关闭相关服务。&nbsp;<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nH、站群内容可以选择推送到某个分站或者全部分站。&nbsp;</font><br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\n<font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><span style=\"outline-style: none; color: rgb(255,0,0)\"><b style=\"outline-style: none\">国微站群视频介绍：<a href=\"http://v.ifeng.com/vblog/others/201210/21cfa93c-1278-4b19-c27e-0b687c3acb45.shtml\" style=\"outline-style: none; color: rgb(0,112,175)\" target=\"_blank\">http://v.ifeng.com/vblog/others/201210/21cfa93c-1278-4b19-c27e-0b687c3acb45.shtml</a></b></span></font></font><br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\n<font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"5\" style=\"line-height: 1.1em; outline-style: none\"><b style=\"outline-style: none\">国<font size=\"5\" style=\"line-height: 1.1em; outline-style: none\">微<font size=\"5\" style=\"line-height: 1.1em; outline-style: none\">分站基本功能模块：</font></font></b></font>&nbsp;<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nA、<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">文章模块</font>&nbsp;<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nB、图片模块<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nC、视频模块&nbsp;<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nD、下载模块<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nE、<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">信息公开模块</font>&nbsp;<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nF<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">、手机短信模块</font>&nbsp;<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nG、邮件群发模块&nbsp;<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nH、问答系统</font></font><br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\n<font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">G、在线办事系统<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nK、<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">表单系统</font>&nbsp;<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nL<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">、投票模块</font>&nbsp;<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nM、留言本模块<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nN、广告模块</font></font></font></font><br style=\"outline-style: none\" />\r\n<br style=\"text-align: left; line-height: 24px; outline-style: none; font-family: Arial; color: rgb(51,51,51); font-size: 14px\" />\r\n<font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">O、<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">论坛系统</font>&nbsp;<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nP<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">、学籍管理系统</font>&nbsp;<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nQ、教师库查询系统&nbsp;<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nR、成绩查询系统</font></font><br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\n<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">S、学校招生系统<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nT、<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">服务体系模块</font>&nbsp;<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\nU<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">、友情链接模块</font></font></font></font></font></font></font></font></font><br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\n<font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">v<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">、独立<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">页模块</font></font></font></font></font></font></font></font></font></font></font>&nbsp;</font></font></font></font></font></font></font><br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\n<span style=\"outline-style: none; color: rgb(255,0,0)\"><span style=\"outline-style: none; color: rgb(0,0,0)\"><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">（备注：国内很多站群都是将所有分站的<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">数据，<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">放在同一个数据库里面的模式，极<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">容易造成<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">项目失败，<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\n<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">这<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">点是大家选型系统时务必要避免的<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">。另外网络平台一般不选择jave<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">语言，因其部署困难、维护困难以及环境封闭，<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\n<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">大量先进的互联网技术无法更新</font>，预算也<font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">是主流平台的十倍以上，一般选择PHP或net语言，其中PHP占了全球<br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\n站点的75%，是其首选。</font></font></font></font></font></font></font></font></font></font></span></span></font><span style=\"text-align: left; line-height: 24px; font-family: Arial; color: rgb(51,51,51); font-size: 14px\">）</span><br style=\"outline-style: none\" />\r\n<div style=\"text-align: left\">\r\n	&nbsp;</div>\r\n<font size=\"3\" style=\"text-align: left; line-height: 1.1em; outline-style: none; font-family: Arial; color: rgb(51,51,51)\"><b style=\"outline-style: none\"><span style=\"outline-style: none; color: rgb(255,0,0)\">站群详细介绍：<a href=\"http://www.php168.net/page/zq.html\" style=\"outline-style: none; color: rgb(0,112,175)\" target=\"_blank\">http://www.php168.net/page/zq.html</a></span></b><br style=\"outline-style: none\" />\r\n<br style=\"outline-style: none\" />\r\n<b style=\"outline-style: none\"><span style=\"outline-style: none; color: rgb(255,0,0)\">国微站群白皮书：<a href=\"http://esales.php168.net/download/zhanqun-guowei.rar\" style=\"outline-style: none; color: rgb(0,112,175)\" target=\"_blank\">http://esales.php168.net/download/zhanqun-guowei.rar</a><font size=\"3\" style=\"line-height: 1.1em; outline-style: none\">&nbsp;</font></span></b></font><br style=\"outline-style: none\" />\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('254','317','1','','','','127.0.0.1','127.0.0.1','1370542689','');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('259','322','1','','','原告李某与被告某证券公司于2000年10月19日签订了一份配售新股协议书。','127.0.0.1','113.96.230.42','1377244239','<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	[案情介绍]</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　原告李某与被告某证券公司于2000年10月19日签订了一份配售新股协议书。协议约定：一、原告选择被告某证券公司为二级市场配售新股的代理商，被告经审核同意接受原告的委托；二、协议签订后，如遇新股配售发行，被告将自动进行申购处理，原告于T+2日到被告处查询中签与否并存足款项，账面资金不足，视同放弃认购；三、原告要撤销上海账户指定交易或深圳账户进行转托管必须同时撤销本协议，否则，由此引起的后果由原告负责。</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　协议签订后，2003年11月5日长江电力配售新股，原告账户中签1000股，每股4.30元。但由于原告资金账户余额不足，只成交了六股。被告于中签当日拨打原告手机通知原告，因原告手机关机，未能通知到原告，其后的两天被告未再通知。之后该股票上市交易，开盘价6.23元，当日最高价6.48元、收盘价为6.18元，原告损失1918.42元。原告向被告某证券公司索赔，遭拒绝后具状至烟台市牟平区人民法院，要求被告某证券公司赔偿损失1918.42元。</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　[法院审判]</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　法院经审理后认为，原、被告之间的民事法律关系为代理关系。被告某证券公司作为代理人为维护和实现被代理人（原告）的合法权益，应认真履行代理职责，如实、及时报告新代理事务进展情况，因其殆于通知原告股票中签，导致原告利益受损，应赔偿原告合理的经济损失。被告某证券公司以原告作为投资者，有义务查询股票是否中签，且原告已查询到股票的配号，而不查询中签结果，作为免责事由的理由不当。虽然合同中约定，原告于T+2到被告处查询中签与否并存足款项，账面资金不足，视同放弃认购。但该约定被告是根据2000年2月13日证监发行字[2000]5号 《关于向二级市场投资者配售新股有关问题的通知》的规定而制定，该条款为格式条款，在原告不具备较强专业知识的情况下，被告主张以该约定免除其责任，理由不当，本院不予支持。依据《中华人民共和国民法通则》第六十六条第二款之规定，判决被告某证券公司于判决生效后十日内赔偿原告李某经济损失1918.42元。</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　[法官评析]</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　本案的审理涉及新股中签后券商是否有通知股民的义务及格式条款的理解等问题。</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　一、新股中签后券商是否有通知股民的义务</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　新股中签后券商有无通知义务及相关法律问题，涉及投资者与券商双方的权利、义务和切身利益，存在问题和潜在纠纷较为普遍。券商往往以新股中签通知只是券商提供的一项服务内容，并不是证券公司的法定义务作为理由进行抗辩。</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　在我国目前的制度体系内，确实没有任何关于券商必须尽以上通知义务的明确法律规定。投资者和证券公司所签的协议所约定的条款就显得特别重要。如果证券公司签订的代理申购市值配售协议约定证券公司具有中签通知义务，证券公司没有履行该义务应承担违约责任；否则证券公司不应承担责任。如果证券公司在营业大厅等公开场合明确告示有中签通知服务并且股民留有准确的联系方式，但证券公司仍未通知股民，导致股民缴款不足而造成经济损失，证券公司应当承担责任。因为，证券公司以公开的方式在其大门口醒目位置张贴书面告示，称证券公司将设法通知中签者。这是对股民的郑重承诺，应视作为双方所签订协议中权利义务的补充，一旦公开告示，即对其构成法律约束力，成为其应当履行，而不是可以履行也可以不履行的义务。这不仅是一个法律问题，也是证券公司信誉和形象的问题。在此种情况下，股民新股中签并留有准确的联系方式，未能履行通知义务并导致股款不足而无法足额认购并造成经济损失，证券公司毫无疑问应承担经济责任。如果协议中约定了证券公司的中签通知义务，因为股民的联系方式不畅导致无法通知股民，需要根据具体情况分析以确定应当由谁承担责任。如股民留下的地址、电话号码准确无误，则证券公司没有通知的行为属于违约行为，应该承担违约责任。除非证券公司能够提供相反的证据，否则证券公司不能免除责任；如果是由于手机关机、电话无人接听，股民应自行承担责任。但是，限于技术条件的限制，举证可能会有一定的难度。</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　二、如果协议里无此通知的约定，证券公司是否应承担责任</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　证券公司代理投资者进行新股配售申购，双方形成平等主体之间的代理法律关系，按照代理协议的约定履行权利和义务，一方支付代理费用，另一方提供服务，是合法有效的法律行为。代理制度为被代理人的利益而设，被代理人设立代理的目的是为了利用代理人的知识和技能为自己服务。代理人的活动是为了实现被代理人的利益。因此，代理人的代理行为，应从被代理人的利益出发，以对自己事务的注意，处理好被代理人的事务，以增加被代理人的利益。一般投资者之所以委托证券公司统一申购，就是由于自己资金、时间、能力、精力的欠缺才需委托证券公司代理，证券公司作为代理人，必须尽到其善良管理人的义务，以对自己事务的注意程度来处理被代理人的事务。</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　代理人应将处理代理事务的一切重要情况向被代理人报告，以使被代理人知道事务的进展以及自己财产的损益情况。在代理事务处理完毕后，代理人还应向被代理人报告执行任务的经过和结果，并提交必要的文件材料。证券公司作为代理人应认真履行代理职责，如实、及时报告新代理事务进展情况，以此来维护和实现被代理人的合法权益。被告为原告申购的股票中签，被告应及时尽力通知原告，便于原告在有效时间内存足款项进行认购。</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('261','324','1','','','2012年7月7日下午，著名影视制片人张纪中在我校举行了一场别开生面的讲座，与同学们分享了《西游记》的创作历程。MBA学院张树庭院长为张纪中颁发了中传MBA实践导师聘书。张纪中表示，重拍《西游记》是一个巨大的挑战','127.0.0.1','127.0.0.1','1370738424','<div class=\"content_main\">\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		2012年7月7日下午，著名影视制片人张纪中在我校举行了一场别开生面的讲座，与同学们分享了《西游记》的创作历程。MBA学院张树庭院长为张纪中颁发了中传MBA实践导师聘书。</p>\r\n	<p align=\"center\" style=\"TEXT-INDENT: 2em\">\r\n		<img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25395&amp;filename=p1034_1342145778258.jpg\" /></p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		张纪中表示，重拍《西游记》是一个巨大的挑战，一次全新的考验。如何在重拍过程中达到前所未有的效果，难度非常大，投资大半给了特技班底，邀请了特效造型师加盟，通过乳胶发泡技术，将剧中人物形象逼真再现，还首度使用微型模型和等比例模型的联动拍摄。</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		谈到重拍《西游记》的初衷，张纪中表示这是他的梦想和理想，孙悟空不羁的性格、大智大勇的精神，值得去重新演绎。《西游记》也具有强烈的现实意义，剧中运用巧妙的比喻，将人心中的魔鬼外化成了妖魔鬼怪。西天取经路其实就是人生的征程，在每一个路口都会有占有欲、权利欲等人性的弱点。人性的真善美、假恶丑都在《西游记》里能够找到。《西游记》为我们呈现的是人生历练的过程，&ldquo;励志&rdquo;才是《西游记》的精神所在。另外《西游记》所体现出的团结，对统一理想的追求，恰是当下职场和企业建设乃至和谐社会最需要的。</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		张纪中告诫同学们，优秀的制片人要有强烈的社会责任感，工作过程中要不断磨练自己，提升自身文化修养，坚定不移地为理想而战，相信理想感动自己的同时，也能感动其他人一起来完成追寻的事业。</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		张纪中从作品谈到人生，从理想谈到现实，富有感染力的演讲，赢得了在场观众阵阵掌声。</p>\r\n	<p align=\"right\" style=\"TEXT-INDENT: 2em\">\r\n		（文：汪琴、旷小勇&nbsp;图：李冬雾）&nbsp;</p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('263','326','1','','','2012年7月7日下午，著名影视制片人张纪中在我校举行了一场别开生面的讲座，与同学们分享了《西游记》的创作历程。MBA学院张树庭院长为张纪中颁发了中传MBA实践导师聘书。张纪中表示，重拍《西游记》是一个巨大的挑战','127.0.0.1','127.0.0.1','1370738424','<div class=\"content_main\">\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		2012年7月7日下午，著名影视制片人张纪中在我校举行了一场别开生面的讲座，与同学们分享了《西游记》的创作历程。MBA学院张树庭院长为张纪中颁发了中传MBA实践导师聘书。</p>\r\n	<p align=\"center\" style=\"TEXT-INDENT: 2em\">\r\n		<img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25395&amp;filename=p1034_1342145778258.jpg\" /></p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		张纪中表示，重拍《西游记》是一个巨大的挑战，一次全新的考验。如何在重拍过程中达到前所未有的效果，难度非常大，投资大半给了特技班底，邀请了特效造型师加盟，通过乳胶发泡技术，将剧中人物形象逼真再现，还首度使用微型模型和等比例模型的联动拍摄。</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		谈到重拍《西游记》的初衷，张纪中表示这是他的梦想和理想，孙悟空不羁的性格、大智大勇的精神，值得去重新演绎。《西游记》也具有强烈的现实意义，剧中运用巧妙的比喻，将人心中的魔鬼外化成了妖魔鬼怪。西天取经路其实就是人生的征程，在每一个路口都会有占有欲、权利欲等人性的弱点。人性的真善美、假恶丑都在《西游记》里能够找到。《西游记》为我们呈现的是人生历练的过程，&ldquo;励志&rdquo;才是《西游记》的精神所在。另外《西游记》所体现出的团结，对统一理想的追求，恰是当下职场和企业建设乃至和谐社会最需要的。</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		张纪中告诫同学们，优秀的制片人要有强烈的社会责任感，工作过程中要不断磨练自己，提升自身文化修养，坚定不移地为理想而战，相信理想感动自己的同时，也能感动其他人一起来完成追寻的事业。</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		张纪中从作品谈到人生，从理想谈到现实，富有感染力的演讲，赢得了在场观众阵阵掌声。</p>\r\n	<p align=\"right\" style=\"TEXT-INDENT: 2em\">\r\n		（文：汪琴、旷小勇&nbsp;图：李冬雾）&nbsp;</p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('264','327','1','','','贵州凯里网吧爆炸已造成6死38伤，官方称事件初步确定是由于网吧隔壁存放的大量危险化学品引发。据悉事发时网吧内有45人在上网。目前2名网吧负责人及存放化学品的业主已被警方控制。','127.0.0.1','183.48.67.230','1375774623','<p>\r\n	　　<strong><img alt=\"12月5日，救援人员在现场施救。新华社发(陈沛亮 摄) \" src=\"http://z1.php168.net/attachment/cms/item/2010_12/08_11/7a19ccbc3af02c79.jpg\" /></strong></p>\r\n<p>\r\n	　　12月5日，救援人员在现场施救。新华社发(陈沛亮 摄)</p>\r\n<p>\r\n	　　<span style=\"font-weight: bold\">新华网贵阳12月5日报道 </span>5日，贵州省凯里市网吧爆炸事件的原因已初步查明，为网吧隔壁一出租屋内存放的危险化学品发生爆炸引发。</p>\r\n<p>\r\n	　　记者从凯里市委、市政府了解到，截至目前，经州、市公安机关刑侦部门现场勘查，初步确认爆炸系由网吧一墙之隔的一小房间堆放的危险化学物品引发。爆炸现场位于凯里市清平南路桥下，房间内靠南墙堆放有三种袋装化学粉状物品，经查看包装袋，分别为高效聚氯化铝、氢氧化铝、亚硝酸钠，在袋装物品上还散落着若干玻璃瓶装液体，瓶上标签分别为硝酸、盐酸和石油醚。</p>\r\n<p>\r\n	　　现警方已将网吧业主陈成贵、邢光昌控制，并于5日凌晨将堆放危险化学物品的业主吴展智抓获。</p>\r\n<p>\r\n	　　据了解，该网吧已开业多年，证照齐全，共有140台电脑，爆炸时，网吧共有45人正在上网。</p>\r\n<p>\r\n	　　爆炸发生后，贵州省委书记栗战书作出批示，要求全力以赴开展救援，尽快查明爆炸原因，做好善后工作；省委常委、副省长黄康生立即从贵阳赶赴凯里指挥救援、看望伤员；省委常委、政法委书记崔亚东在公安厅指挥中心连夜指挥侦查。</p>\r\n<p>\r\n	　　目前，这起爆炸事件已造成6人死亡，38人受伤，其中9人重伤。</p>\r\n<p>\r\n	&nbsp;</p>\r\n<div style=\"page-break-after: always;\">\r\n	<span style=\"display: none;\">&nbsp;</span></div>\r\n<p>\r\n	&nbsp;</p>\r\n<div style=\"page-break-after: always;\">\r\n	<span style=\"display: none;\">&nbsp;</span></div>\r\n<p>\r\n	记者从凯里市委、市政府了解到，截至目前，经州、市公安机关刑侦部门现场勘查，初步确认爆炸系由网吧一墙之隔的一小房间堆放的危险化学物品引发。爆炸现场位于凯里市清平南路桥下，房间内靠南墙堆放有三种袋装化学粉状物品，经查看包装袋，分别为高效聚氯化铝、氢氧化铝、亚硝酸钠，在袋装物品上还散落着若干玻璃瓶装液体，瓶上标签分别为硝酸、盐酸和石油醚。</p>\r\n<p>\r\n	　　现警方已将网吧业主陈成贵、邢光昌控制，并于5日凌晨将堆放危险化学物品的业主吴展智抓获。</p>\r\n<p>\r\n	　　据了解，该网吧已开业多年，证照齐全，共有140台电脑，爆炸时，网吧共有45人正在上网。</p>\r\n<p>\r\n	　　爆炸发生后，贵州省委书记栗战书作出批示，要求全力以赴开展救援，尽快查明爆炸原因，做好善后工作；省委常委、副省长黄康生立即从贵阳赶赴凯里指挥救援、看望伤员；省委常委、政法委书记崔亚东在公安厅指挥中心连夜指挥侦查。</p>\r\n<p>\r\n	　　目前，这起爆炸事件已造成6人死亡，38人受伤，其中9人重伤。</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('265','328','1','','','主站推送给分站的使用2234','127.0.0.1','127.0.0.1','1370738424','主站推送给分站的使用2234');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('266','329','1','','http://nw3.php168.net/gov3/attachment/cms/item/2012_03/05_17/6568c6548c29d1fa.jpg','&amp;amp;nbsp; 为认真学习贯彻党的十七届六中全会，切实用全会精神统一住建系统广大党员干部群众的思想，进一步提高认识，振奋精神，推进建设系统文化大发展大繁荣。根据市委&amp;amp;laquo;中共温州市委办公室关于做好党的十七届六','127.0.0.1','127.0.0.1','1370738424','<p>\r\n	<span style=\"FONT-FAMILY: Arial\"><span style=\"FONT-SIZE: medium\">&nbsp; 为认真学习贯彻党的十七届六中全会，切实用全会精神统一住建系统广大党员干部群众的思想，进一步提高认识，振奋精神，推进建设系统文化大发展大繁荣。根据市委&laquo;中共温州市委办公室关于做好党的十七届六中全会精神宣讲工作的通知&raquo;(温委办发[2011]152号)文件通知精神，12月6日，住建委邀请市委宣讲团成员、市委党校副校长胡瑞怀同志作深入学习贯彻党的十七届六中全会精神的专题报告。<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 建委副主任倪忠礼主持报告会，市房管局、园林局、工务局、市住房公积金管理中心、委直属各单位领导班子成员及委机关全体工作人员参加了报告会。<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 胡校长在报告中围绕如何正确认识党的十七届六中全会的重大意义、如何把握党的十七届六中全会基本精神、如何贯彻落实党的十七届六中全会提出的目标任务作了深刻的阐释和解读。同时紧密结合我国文化发展的实际，回顾总结了改革开放特别是党的十六大以来文化建设取得的巨大成就，认真分析了推进文化改革发展的重要性和紧迫性，生动阐述了中国特色社会主义文化发展道路的基本内涵与要求，深刻阐明了新形势下深化文化体制改革、推动社会主义文化大发展大繁荣的指导思想、主要方针和目标任务。<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 胡校长的报告深入简出、通俗易懂，紧密联系当前国际国内形势发展变化与我国文化改革发展实践，贴近群众的思想实际。整场报告逻辑严谨，思想深刻，既有理论思考又有实践总结，既有观点阐释又有事实说明，在现场听众中引起积极反响。聆听此次报告会的同志纷纷表示，本场报告对于我委进一步领会十七届六中全会精神、体会《决定》的重大意义、提高住建系统文化建设的自觉性有很大的帮助。（</span></span><span style=\"FONT-FAMILY: Arial\"><span style=\"FONT-SIZE: medium\">住建委宣教处）</span></span></p>\r\n<p style=\"TEXT-ALIGN: center\">\r\n	<span style=\"FONT-SIZE: medium\"><span style=\"FONT-FAMILY: Arial\"><img alt=\"\" height=\"464\" src=\"http://www.wzcb.gov.cn/JC_Data/JC_Edt/etc/20111209153555309.jpg\" width=\"700\" /></span></span></p>\r\n<p style=\"TEXT-ALIGN: center\">\r\n	<span style=\"FONT-FAMILY: Arial\"><span style=\"FONT-SIZE: medium\"><img alt=\"\" height=\"457\" src=\"http://www.wzcb.gov.cn/JC_Data/JC_Edt/etc/20111209153619488.jpg\" width=\"700\" /></span></span></p>\r\n<p style=\"TEXT-ALIGN: center\">\r\n	<span style=\"FONT-SIZE: medium\"><span style=\"FONT-FAMILY: Arial\"><img alt=\"\" src=\"http://www.wzcb.gov.cn/JC_Data/JC_Edt/etc/20111209153632363.jpg\" /></span></span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('267','330','1','','','　　今年，我省电子信息产业将投产、达产、量产和扩产项目共124项，预计新增产值340亿元。至年底，全省电子信息产业销售收入约可逼近2000亿元大关。　　这是省经信委昨日公布的数据。2010年，我省电子','127.0.0.1','127.0.0.1','1370738424','<p>\r\n	　　今年，我省电子信息产业将投产、达产、量产和扩产项目共124项，预计新增产值340亿元。至年底，全省电子信息产业销售收入约可逼近2000亿元大关。</p>\r\n<p>\r\n	　　这是省经信委昨日公布的数据。2010年，我省电子信息产业规模以上企业实现主营业收入1539.9亿元，同比增长29.2%，增速高于全国同行业3.6个百分点;实现工业增加值450.2亿元;产业规模继续保持全国第十一位、中部第一位，超额完成了全年和&ldquo;十一五&rdquo;各项目标任务。</p>\r\n<p>\r\n	　　目前，全行业产值过百亿元的企业3户，分别是冠捷、邮科院、鸿富锦(武汉富士康)，比上年净增1户(鸿富锦)。</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('268','331','1','','','23423432234234232','127.0.0.1','127.0.0.1','1370738424','23423432234234232');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('279','1011','1','','','[案情介绍]　　原告李某与被告某证券公司于2000年10月19日签订了一份配售新股协议书。协议约定：一、原告选择被告某证券公司为二级市场配售新股的代理商，被告经审核同意接受原告的委托；二、协议签订后，如遇新股配','127.0.0.1','127.0.0.1','1379386844','<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	[案情介绍]</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　原告李某与被告某证券公司于2000年10月19日签订了一份配售新股协议书。协议约定：一、原告选择被告某证券公司为二级市场配售新股的代理商，被告经审核同意接受原告的委托；二、协议签订后，如遇新股配售发行，被告将自动进行申购处理，原告于T+2日到被告处查询中签与否并存足款项，账面资金不足，视同放弃认购；三、原告要撤销上海账户指定交易或深圳账户进行转托管必须同时撤销本协议，否则，由此引起的后果由原告负责。</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　协议签订后，2003年11月5日长江电力配售新股，原告账户中签1000股，每股4.30元。但由于原告资金账户余额不足，只成交了六股。被告于中签当日拨打原告手机通知原告，因原告手机关机，未能通知到原告，其后的两天被告未再通知。之后该股票上市交易，开盘价6.23元，当日最高价6.48元、收盘价为6.18元，原告损失1918.42元。原告向被告某证券公司索赔，遭拒绝后具状至烟台市牟平区人民法院，要求被告某证券公司赔偿损失1918.42元。</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　[法院审判]</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　法院经审理后认为，原、被告之间的民事法律关系为代理关系。被告某证券公司作为代理人为维护和实现被代理人（原告）的合法权益，应认真履行代理职责，如实、及时报告新代理事务进展情况，因其殆于通知原告股票中签，导致原告利益受损，应赔偿原告合理的经济损失。被告某证券公司以原告作为投资者，有义务查询股票是否中签，且原告已查询到股票的配号，而不查询中签结果，作为免责事由的理由不当。虽然合同中约定，原告于T+2到被告处查询中签与否并存足款项，账面资金不足，视同放弃认购。但该约定被告是根据2000年2月13日证监发行字[2000]5号 《关于向二级市场投资者配售新股有关问题的通知》的规定而制定，该条款为格式条款，在原告不具备较强专业知识的情况下，被告主张以该约定免除其责任，理由不当，本院不予支持。依据《中华人民共和国民法通则》第六十六条第二款之规定，判决被告某证券公司于判决生效后十日内赔偿原告李某经济损失1918.42元。</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　[法官评析]</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　本案的审理涉及新股中签后券商是否有通知股民的义务及格式条款的理解等问题。</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　一、新股中签后券商是否有通知股民的义务</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　新股中签后券商有无通知义务及相关法律问题，涉及投资者与券商双方的权利、义务和切身利益，存在问题和潜在纠纷较为普遍。券商往往以新股中签通知只是券商提供的一项服务内容，并不是证券公司的法定义务作为理由进行抗辩。</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　在我国目前的制度体系内，确实没有任何关于券商必须尽以上通知义务的明确法律规定。投资者和证券公司所签的协议所约定的条款就显得特别重要。如果证券公司签订的代理申购市值配售协议约定证券公司具有中签通知义务，证券公司没有履行该义务应承担违约责任；否则证券公司不应承担责任。如果证券公司在营业大厅等公开场合明确告示有中签通知服务并且股民留有准确的联系方式，但证券公司仍未通知股民，导致股民缴款不足而造成经济损失，证券公司应当承担责任。因为，证券公司以公开的方式在其大门口醒目位置张贴书面告示，称证券公司将设法通知中签者。这是对股民的郑重承诺，应视作为双方所签订协议中权利义务的补充，一旦公开告示，即对其构成法律约束力，成为其应当履行，而不是可以履行也可以不履行的义务。这不仅是一个法律问题，也是证券公司信誉和形象的问题。在此种情况下，股民新股中签并留有准确的联系方式，未能履行通知义务并导致股款不足而无法足额认购并造成经济损失，证券公司毫无疑问应承担经济责任。如果协议中约定了证券公司的中签通知义务，因为股民的联系方式不畅导致无法通知股民，需要根据具体情况分析以确定应当由谁承担责任。如股民留下的地址、电话号码准确无误，则证券公司没有通知的行为属于违约行为，应该承担违约责任。除非证券公司能够提供相反的证据，否则证券公司不能免除责任；如果是由于手机关机、电话无人接听，股民应自行承担责任。但是，限于技术条件的限制，举证可能会有一定的难度。</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　二、如果协议里无此通知的约定，证券公司是否应承担责任</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　证券公司代理投资者进行新股配售申购，双方形成平等主体之间的代理法律关系，按照代理协议的约定履行权利和义务，一方支付代理费用，另一方提供服务，是合法有效的法律行为。代理制度为被代理人的利益而设，被代理人设立代理的目的是为了利用代理人的知识和技能为自己服务。代理人的活动是为了实现被代理人的利益。因此，代理人的代理行为，应从被代理人的利益出发，以对自己事务的注意，处理好被代理人的事务，以增加被代理人的利益。一般投资者之所以委托证券公司统一申购，就是由于自己资金、时间、能力、精力的欠缺才需委托证券公司代理，证券公司作为代理人，必须尽到其善良管理人的义务，以对自己事务的注意程度来处理被代理人的事务。</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　代理人具有报告义务。代理人应将处理代理事务的一切重要情况向被代理人报告，以使被代理人知道事务的进展以及自己财产的损益情况。在代理事务处理完毕后，代理人还应向被代理人报告执行任务的经过和结果，并提交必要的文件材料。证券公司作为代理人应认真履行代理职责，如实、及时报告新代理事务进展情况，以此来维护和实现被代理人的合法权益。被告为原告申购的股票中签，被告应及时尽力通知原告，便于原告在有效时间内存足款项进行认购。</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('286','1021','1','','','新华网林芝12月8日电  6日，西藏首个国家公园——雅鲁藏布大峡谷国家公园正式建成。','127.0.0.1','127.0.0.1','1379420676','<p>\r\n	　　西藏林芝地区行署副专员红卫说，雅鲁藏布大峡谷国家公园的建成，可以在不远的未来带动林芝周边自然保护区和国家公园的建设，打造一个面积最大、自然体系最完整的国家公园群，这些周边地区包括察隅、然乌、波密、易贡、尼洋河流域等，描摹一幅完整的自然文化生态公园的诱人画卷，推动当地旅游业快速发展，为把旅游业培育成支撑林芝地区跨越式发展的主导产业、人民群众更加满意的现代服务业贡献力量。</p>\r\n<p>\r\n	　　西藏自治区旅游局副局长王松平说，近几年，通过当地政府和西藏有关旅游企业的精心打造，雅鲁藏布大峡谷景区基础设施不断改善，旅游产品不断丰富，景区品牌得以传播。目前，大峡谷已逐步成为集观光、摄影、徒步、自驾、游船、科考、探险、朝圣等功能为一体的综合型景区，世界级生态旅游圣地。今年前10月，大峡谷景区已接待游客13.5万人次，是整个西藏增幅最高、发展最快、潜力最大的新兴旅游区。</p>\r\n<p>\r\n	　　西藏旅游股份有限公司董事长欧阳旭说，雅鲁藏布大峡谷位于藏东南边陲，历史上由于重山阻隔、峡谷挡道，使她长期与世隔绝，像一座孤岛沉睡在群山之中。20世纪末，长期藏在隐秘腹地的雅鲁藏布大峡谷终于向人类展示了她绚丽的身姿，并以其高度、深度、长度、生物多样性、水能蕴藏量等指标，荣膺&ldquo;世界第一大峡谷&rdquo;，国务院于1998年10月10日正式予以命名。</p>\r\n<p>\r\n	　　据了解，国家公园制度是一种资源保护与开发利用实现双赢的先进管理模式，以求生态环境与旅游消费达到和谐共存。国家公园不仅仅是个名称，其背后蕴涵的是一种对自然与文化区域进行可持续发展与保护的最优化的管理体制。国内外实践证明，国家公园制度行之有效、普遍适应，体现了兼顾保护与利用、协同开发与管理的战略，既有利于保护珍贵的自然资源和人文资源，又有利于开发出游客赞赏的目的地景区，还有利于改善社区居民的生活环境。（完）</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('287','1022','1','','<!--#p8_attach#-->/cms/item/2010_12/08_11/1b2a4988ed469903.jpg.thumb.jpg','由中国社会科学院财政与贸易经济研究所、社会科学文献出版社联合主办的“2011年《住房绿皮书》发布暨2010~2011年住房形势与政策研讨会”8日在北京举行。','127.0.0.1','127.0.0.1','1379420676','<p align=\"center\" class=\"f_center\" style=\"text-align: center;\">\r\n	　　<strong><img align=\"center\" alt=\"社科院称2010住宅市场量价齐升 调控中再现回落\" border=\"0\" id=\"14551850\" sourcedescription=\"编辑提供的本地文件\" sourcename=\"本地文件\" src=\"<!--#p8_attach#-->/cms/item/2010_12/08_11/1b2a4988ed469903.jpg\" style=\"width: 600px; height: 450px;\" /></strong><br />\r\n	<br />\r\n	　　社科院《住房绿皮书》。中国网 杨佳 摄</p>\r\n<p>\r\n	　　<strong>中国网12月8日报道 </strong>由中国社会科学院财政与贸易经济研究所、社会科学文献出版社联合主办的&ldquo;2011年《住房绿皮书》发布暨2010~2011年住房形势与政策研讨会&rdquo;8日在北京举行。会议研讨了中国住房发展面临的现实问题和重大挑战,分析了2009~2010年中国住房及相关市场走势，预测了2010~2011年我国住房发展趋势, 会议正式对外发布由中国社会科学院财政与贸易经济研究所、中国社会科学院城市与竞争力研究中心完成的国家重大社科基金阶段性成果：住房绿皮书《中国住房发展报告（2010-2011）》。</p>\r\n<p>\r\n	　　绿皮书指出，住宅市场在2009年第4季度延续了回暖趋势，特别是12月由于购房优惠政策的到期，住宅销售面积达到16342.25万平方米。</p>\r\n<p>\r\n	　　进入2010年以来，住宅销售面积增速下降，特别是4月新一轮房地产调控以来，住宅销售面积呈现负增长。住宅销售价格也在2009年第3季度以来经历了较快地上升，在2010年4月增速达到15.4%。但由于严厉的房地产调控措施的出台，住宅销售价格增速也逐月下降，2010年8月降至11.7%。</p>\r\n<p>\r\n	　　绿皮书分析认为，宽松的货币政策致使住宅市场快速回暖以至于过热，从而招致了新一轮的宏观调控。尽管销售面积和销售价格有所回调,但住宅投资由于滞后效应的存在并没有受到太大影响。住宅投资完成额在2009年第3季度以来维持较高的增速，2010年1月达到40.0%，8月才有所降低，为30.8%，但总体仍维持了较高的增速。相比2009年住房投资对经济增长的直接带动作用仅为0.42个百分点（当年GDP实际增长率为8.7个百分点），贡献度为4.83%；而2010年上半年住房投资对经济增长的直接带动作用增强，为0.93个百分点，贡献度为8.34%，比上年明显提高。</p>');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('288','1023','1','','<!--#p8_attach#-->/cms/item/2012_08/23_00/afa9ec23dfb52a78.jpg.thumb.jpg','2012年7月19日，由中美文化教育基金会发起、北京市委教育工委主办、中国传媒大学学生工作处承办的&ldquo;新世纪的丝绸之路&rdquo;之中美大学生文化交流活动在中国传媒大学综合实验楼400人报告厅拉开帷幕。此次活动吸','127.0.0.1','127.0.0.1','1379420676','<p>\r\n	2012年7月19日，由中美文化教育基金会发起、北京市委教育工委主办、中国传媒大学学生工作处承办的&ldquo;新世纪的丝绸之路&rdquo;之中美大学生文化交流活动在中国传媒大学综合实验楼400人报告厅拉开帷幕。此次活动吸引了来自中国传媒大学、北京交通大学、北京工商大学以及加州大学洛杉矶分校等中美两国十余所大学的两百余名师生。&nbsp;</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp; 北京市委教工委副书记唐立军、中国传媒大学副书记田维义、北京市教工委宣教处处长王达品、中国传媒大学学生处处长张根兴，加州大学洛杉矶分校（UCLA）副校长Janina Montero，美国国家癌症学会学部委员、加州大学尔湾分校医学院流行病学系主任Hoda Culver等出席活动。田维义副书记在欢迎辞中表示，&ldquo;新世纪的丝绸之路&rdquo;项目至今已有12年历史，期间成就了许多重要的中美教育界峰会、论坛和学术交流活动，并为上万名中美大学生和教育工作者搭建了沟通的桥梁，我校十分重视本次活动，也希望今后能够与该项目持续开展合作。在随后的颁奖仪式上，唐立军副书记致开幕词，他表示，&ldquo;新世纪的丝绸之路&rdquo;活动以丝绸和绘画为载体，推动了中美大学生的文化交流和感情沟通，增进了彼此了解，扩大了文化共识，也将推动北京作为中国特色世界城市的建设。</p>\r\n<p align=\"center\">\r\n	<span style=\"FONT-FAMILY: KaiTi_GB2312\"><img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25485&amp;filename=p1052_1342756244906.jpg\" /></span></p>\r\n<p align=\"center\">\r\n	<span style=\"FONT-FAMILY: KaiTi_GB2312\">北京市教工委唐立军副书记在颁奖仪式上致辞</span></p>\r\n<p align=\"center\">\r\n	<span style=\"FONT-FAMILY: KaiTi_GB2312\">&nbsp;</span></p>\r\n<p align=\"center\">\r\n	<span style=\"FONT-FAMILY: KaiTi_GB2312\"><img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25485&amp;filename=p1052_1342756362215.jpg\" /></span></p>\r\n<p align=\"center\">\r\n	<span style=\"FONT-FAMILY: KaiTi_GB2312\">田维义副书记为获得丝画大赛一等奖的学生颁奖</span><span style=\"FONT-FAMILY: KaiTi_GB2312\">&nbsp;</span></p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp; 为使活动突出文化交流主题、凸显民族文化特色，我校周密部署，精心组织安排了交流活动的各个环节。在五个多小时的交流活动中，中美学生文化论坛、丝画展示评选、&ldquo;丝画设计大赛&rdquo;颁奖仪式等环节精彩纷呈，既突出了&ldquo;弘扬践行北京精神、增进中美文化交流&ldquo;的主题，又开拓了首都大学生的国际视野，加深了中美大学生之间的文化和思想交流。</p>\r\n<p align=\"center\">\r\n	<span style=\"FONT-FAMILY: KaiTi_GB2312\"><img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25485&amp;filename=p1052_1342756273300.jpg\" /></span></p>\r\n<p align=\"center\">\r\n	<span style=\"FONT-FAMILY: KaiTi_GB2312\">中美学生丝画作品展示 </span></p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp; 为给大家提供充分交流的机会，中美学生文化论坛分为分论坛和总论坛两部分。参加活动的中美大学生首先分组至四个分论坛展开主题为&ldquo;中美友谊对世界和平的重要性&rdquo;的热烈讨论，之后又齐聚总论坛，由各组代表向大会作主题发言，分享交流成果。</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp; 作为&ldquo;新世纪的丝绸之路&rdquo;中美大学生文化交流活动的重要组成部分，本次丝画设计大赛共征集到数十所中美高校大学生设计的作品百余幅，大赛从众多提交作品中共评出中美双方一、二、三等奖各三名，鼓励奖各五名。由到场的中美领导嘉宾为两国获奖大学生颁发了获奖证书和奖品。为感谢加州大学洛杉矶分校（UCLA）副校长Janina&nbsp;Montero对中美大学生文化交流活动的支持，大赛授予其&ldquo;特别贡献奖&rdquo;称号。随后，我校学生精心准备的精彩歌舞表演为颁奖典礼锦上添花，并博得了台下观众的阵阵掌声。此次文化交流活动在和平友好的氛围中圆满结束。 &nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('290','1027','1','','','理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习','120.86.68.196','120.86.68.196','1393140327','<p>\r\n	理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见</p>\r\n<p>\r\n	理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('291','1029','1','','','  政府工作报告提出，今年高校毕业生将达727万人，要开发更多就业岗位，实施不间断的就业创业服务，提高大学生就业创业比例','113.64.28.34','14.121.15.119','1398590182','&nbsp; &nbsp;政府工作报告提出，今年高校毕业生将达727万人，要开发更多就业岗位，实施不间断的就业创业服务，提高大学生就业创业比例。<br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &ldquo;727万&rdquo;又一次触动社会的神经，相比2013年的699万增量不大但总量很大。专家分析，2014年大学生就业形势依然严峻。<br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 记者梳理发现，来自教育部、人力资源和社会保障部等公布的数据显示，从2005年至2014年，10年间全国普通高校毕业生从338万人增长至727万人，总数翻了一番还要多。<br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 人力资源和社会保障部国际劳动保障研究所所长莫荣说，&ldquo;我国每年新进入市场的劳动者大约1500万人，727万人差不多占到一半了。综合考虑，今年大学生就业形势不容乐观。&rdquo;莫荣说。<br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 对于高校毕业生逐年增加，代表委员建议客观、理性看待。<br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lsquo;难&rsquo;不应被过度放大，也不能只看数据。&rdquo;全国人大代表、共青团安徽省委书记李红认为，&ldquo;喊&lsquo;难&rsquo;的声音太多，无形中给毕业生和家长传递了一种压力感和焦虑感。&rdquo;政府工作报告明确提出开发更多就业岗位，实施不间断的就业创业服务，提高大学生就业创业比例。现在关键是将这些要求落到实处。<br />\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('298','1046','1','','','青年全球治理创新设计大赛（Youth Innovation Competition on Global Governance，简称&amp;amp;ldquo;YICGG&amp;amp;rdquo;）是由复旦大学国际关系与公共事务学院于2007年创办、复旦大学和联合国开发计划署联合主办的一项赛事活动。它面向全球所有高校青年征集智慧与创意，解决人类命运','183.48.65.148','183.48.65.148','1399118224','<p>\r\n	青年全球治理创新设计大赛（Youth Innovation Competition on Global Governance，简称&ldquo;YICGG&rdquo;）是由复旦大学国际关系与公共事务学院于2007年创办、复旦大学和联合国开发计划署联合主办的一项赛事活动。它面向全球所有高校青年征集智慧与创意，解决人类命运的基本问题，是目前世界上第一个以创新性和国际性为特点的超越学科、超越国界、超越传统理论的青年创意比赛。&nbsp;</p>\r\n<p>\r\n	自创办起，大赛已在中国、意大利、格鲁吉亚等国举办多次，有来自中国、美国、日本、意大利、格鲁吉亚等全球逾二十多个国家与地区的三百多名大学生参加了历届比赛。参赛选手们在有关全球治理、人类未来和环境保护的诸多问题上形成了许多建设性的提案，并提交联合国有关部门作为相关问题的参考意见。&nbsp;</p>\r\n<p>\r\n	大赛采取两级赛制，分别为复旦大学校内选拔赛与夏季总决赛。根据阶段性赛事的不同要求，2014年青年全球治理创新设计大赛复旦大学校内选拔赛的工作安排如下（评审与答辩时间安排将根据实际报名情况略有调整）： &nbsp;</p>\r\n<p>\r\n	<br />\r\n	一、报名与项目申报&nbsp;</p>\r\n<p>\r\n	（一）报名途径&nbsp;</p>\r\n<p>\r\n	报名对象为复旦大学全日制在校本科生、硕士研究生、博士研究生和MBA学生。3至5人为一组，推选1人为领队，以组队形式参加比赛。&nbsp;</p>\r\n<p>\r\n	请登录官方公共邮箱（账号：yicgg2014.register@hotmail.com｜密码：register2014），前往［收件箱］下载报名表格，填写后发送至以下参赛邮箱：yicgg2014@hotmail.com&nbsp;</p>\r\n<p>\r\n	报名截止时间为：2014年4月11日（周五）22：00，届时组委会将向每个参赛队伍的领队发送确认短信和邮件。&nbsp;</p>\r\n<p>\r\n	（二）赛前准备&nbsp;</p>\r\n<p>\r\n	报名成功后，选手须按时参加组委会提供的相应培训，内容包括：比赛注意事项、答辩会具体时间地点安排、队伍匹配导师见面和指导时间等必要信息。&nbsp;</p>\r\n<p>\r\n	（三）项目提案申报&nbsp;</p>\r\n<p>\r\n	参赛作品的主题选取及具体要求参见&ldquo;通知&rdquo;附件。&nbsp;</p>\r\n<p>\r\n	团队须在2014年4月22日（周二）24：00前，将提案终稿发送至官方参赛邮箱yicgg2014@hotmail.com。若需组委会帮助准备展示用的材料或用具，须提前至少一天告知组委会。请参赛队伍在审评前检查确认是否携带本组提案的纸质版和自备展示用具，以方便组委会按时开始项目审评。&nbsp;</p>\r\n<p>\r\n	（四）最终解释权&nbsp;</p>\r\n<p>\r\n	对于报名方式和比赛规则如有任何疑惑，可通过官方微博「青年全球治理创新研究与发展中心」以及微信公共平台进行问询，或在人人网「复旦YICGG」上查阅发布的相关问题FAQ文章。如情况实在特殊，请直接通过官方邮箱「yicgg2014@hotmail.com」联系YICGG2014组委会。 &nbsp;</p>\r\n<p>\r\n	<br />\r\n	二、赛前培训及相关安排&nbsp;</p>\r\n<p>\r\n	（一）赛前培训&nbsp;</p>\r\n<p>\r\n	组委会将在报名截止后联系各团队的领队，通知相关培训的地点；领队负责将时间地点传达给队员，并保证所有成员可以出席培训。&nbsp;</p>\r\n<p>\r\n	（二）第一次培训时间安排&nbsp;</p>\r\n<p>\r\n	第一次培训安排在2014年4月22日（周二），内容包括核实参赛队伍、介绍大赛相关知识、往届经验分享、本届参赛方案简介和答辩介绍。&nbsp;</p>\r\n<p>\r\n	（三）第二次培训时间安排&nbsp;</p>\r\n<p>\r\n	复旦大学校内选拔赛决出的优胜队伍将直接参加YICGG2014夏季决赛，在夏季赛开赛前的一个星期，组委会计划安排第二次培训，向参赛队伍介绍本次夏季赛的组织情形与参与情况，使各队伍对比赛的大致情况有所了解。</p>\r\n<p>\r\n	<br />\r\n	三、校内赛答辩</p>\r\n<p>\r\n	校内赛答辩安排在2014年4月29日（周二）进行，答辩的具体流程会在赛前第一次培训时详细说明。 &nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('299','1047','1','','','4月29日，我校在主楼824室举行&amp;amp;ldquo;五一&amp;amp;rdquo;劳动节座谈会。学校领导傅广生、王余丁、王凤鸣、王培光、杨立海出席会议。各级劳动模范、&amp;amp;ldquo;三育人&amp;amp;rdquo;先进个人及我校模范教师代表，党办、校办、宣传部、工会等部门负责人参加了会议。劳模代表一一发言，讲述了','183.48.65.148','183.48.65.148','1399118264','<div align=\"left\" style=\"line-height: 24pt; text-indent: 24pt;\">\r\n	<div align=\"left\" style=\"line-height: 24pt; text-indent: 24pt;\">\r\n		<span id=\"ctl00_ContentArea_gvList_ctl02_Label2\" style=\"LINE-HEIGHT: 30px\"><span style=\"FONT-SIZE: 12pt\"><span style=\"FONT-SIZE: 12pt\">4</span><span style=\"FONT-SIZE: 12pt\">月29日</span><span style=\"FONT-SIZE: 12pt\">，我校在主楼824室举行&ldquo;五一&rdquo;劳动节座谈会。学校领导傅广生、王余丁、王凤鸣、王培光、杨立海出席会议。各级劳动模范、&ldquo;三育人&rdquo;先进个人及我校模范教师代表，党办、校办、宣传部、工会等部门负责人参加了会议。</span></span></span></div>\r\n	<div align=\"left\" style=\"line-height: 24pt; text-indent: 24pt;\">\r\n		<span id=\"ctl00_ContentArea_gvList_ctl02_Label2\" style=\"LINE-HEIGHT: 30px\"><span style=\"FONT-SIZE: 12pt\"><span style=\"FONT-SIZE: 12pt\">劳模代表一一发言，讲述了各自爱岗敬业、甘于奉献、争创一流、拼搏奋斗的感人事迹，表达了把河北大学早日建成&ldquo;特色鲜明、国际知名&rdquo;高水平综合性大学的强烈愿望。</span></span></span></div>\r\n	<div align=\"left\" style=\"line-height: 24pt; text-indent: 24pt;\">\r\n		<span id=\"ctl00_ContentArea_gvList_ctl02_Label2\" style=\"LINE-HEIGHT: 30px\"><span style=\"FONT-SIZE: 12pt\"><span style=\"FONT-SIZE: 12pt\">校长傅广生代表学校向各位劳模代表，并通过他们向全校师生表达了节日的问候。他通报了一年来我校在学科建设、师资队伍建设、人才培养、科学研究、社会服务、国际交流合作、基础设施建设等各方面取得的突出成绩。他指出，当前，我校正全力推进两件大事，一是党的群众路线教育实践活动，二是中西部高校提升综合实力工程建设，希望全体师生凝心聚力，同心同德，把这两件事情扎扎实实做好。最后，他以&ldquo;教育是事业，事业的价值在于献身&rdquo;、&ldquo;教育是科学，科学的价值在于求真&rdquo;、&ldquo;教育是艺术，艺术的生命在于创新&rdquo;三句话，与广大教师共勉。</span></span></span></div>\r\n	<span id=\"ctl00_ContentArea_gvList_ctl02_Label2\" style=\"LINE-HEIGHT: 30px\"><span style=\"FONT-SIZE: 12pt\"><span style=\"FONT-SIZE: 12pt\">座谈会由党委常委杨立海主持。他指出，河北大学每一位教职工都要以劳动模范作为学习榜样，为学校的建设发展、争创国内一流大学做出更大的贡献。</span></span></span></div>\r\n<div style=\"TEXT-ALIGN: right; LINE-HEIGHT: 24pt; TEXT-INDENT: 24pt; LAYOUT-GRID-MODE: char\">\r\n	<span id=\"ctl00_ContentArea_gvList_ctl02_Label2\" style=\"LINE-HEIGHT: 30px\"><span style=\"FONT-SIZE: 12pt\"><span style=\"FONT-SIZE: 12pt\">（工会、宣传部供稿）</span></span></span></div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('300','1048','1','','','4月25日下午，历时10天的2014年河北大学&amp;amp;ldquo;校园杯&amp;amp;rdquo;篮球赛落下帷幕。本次比赛有23支代表队345名运动员参加，共举行85场比赛。比赛采用男女生混合组队的形式。经过激烈角逐，工商学院、电子信息工程学院、政法学院、经济学院、新闻传播学院、质量技术监督学院、','183.48.65.148','183.48.65.148','1399118285','<div align=\"left\" style=\"line-height: 24pt; text-indent: 24pt;\">\r\n	<span id=\"ctl00_ContentArea_gvList_ctl02_Label2\" style=\"LINE-HEIGHT: 30px\"><span style=\"FONT-SIZE: 12pt\">4</span><span style=\"FONT-SIZE: 12pt\">月25日</span><span style=\"FONT-SIZE: 12pt\">下午，历时10天的2014年河北大学&ldquo;校园杯&rdquo;篮球赛落下帷幕。</span></span></div>\r\n<div align=\"left\" style=\"line-height: 24pt; text-indent: 24pt;\">\r\n	<span id=\"ctl00_ContentArea_gvList_ctl02_Label2\" style=\"LINE-HEIGHT: 30px\"><span style=\"FONT-SIZE: 12pt\">本次比赛有23支代表队345名运动员参加，共举行85场比赛。比赛采用男女生混合组队的形式。经过激烈角逐，工商学院、电子信息工程学院、政法学院、经济学院、新闻传播学院、质量技术监督学院、生命科学学院代表队获得甲组前七名；管理学院、中医学院、物理科学与技术学院、艺术学院、建筑工程学院、基础医学院、国际交流与教育学院、化学与环境科学学院代表队获得乙组前八名。 </span></span></div>\r\n<div style=\"TEXT-ALIGN: right; LINE-HEIGHT: 24pt; TEXT-INDENT: 24pt\">\r\n	<span id=\"ctl00_ContentArea_gvList_ctl02_Label2\" style=\"LINE-HEIGHT: 30px\"><span style=\"FONT-SIZE: 12pt\">（体育教研部供稿）</span></span></div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('301','1049','1','','','根据省委督导组的要求，为充分发挥党员领导干部在教育实践活动中的带头示范作用，4月23日下午，我校在主楼304报告厅召开了校级党员领导干部学习汇报会。省委督导组组长李益民，常务副组长鲁杰，副组长杨造成，以及沈建国、靳学军、张学工等领导同志，学校领导，近三年退','183.48.65.148','121.8.7.164','1408885160','<div align=\"left\" style=\"line-height: 24pt; text-indent: 24pt;\">\r\n	<span id=\"ctl00_ContentArea_gvList_ctl02_Label2\" style=\"LINE-HEIGHT: 30px\"><span style=\"FONT-SIZE: 12pt\">根据省委督导组的要求，为充分发挥党员领导干部在教育实践活动中的带头示范作用，4月23日下午，我校在主楼304报告厅召开了校级党员领导干部学习汇报会。省委督导组组长李益民，常务副组长鲁杰，副组长杨造成，以及沈建国、靳学军、张学工等领导同志，学校领导，近三年退出领导岗位的学校领导，中层干部，二、三级专业技术人员，省级人大代表、政协委员，各民主党派主要负责人参加了会议。</span></span></div>\r\n<div align=\"left\" style=\"line-height: 24pt; text-indent: 24pt;\">\r\n	<span id=\"ctl00_ContentArea_gvList_ctl02_Label2\" style=\"LINE-HEIGHT: 30px\"><span style=\"FONT-SIZE: 12pt\">党委书记王洪瑞首先汇报了校领导班子和个人学习教育开展情况。他说，在省委督导组的精心指导和有力推动下，学校党的群众路线教育实践活动正在扎实、健康、有序推进，总体上做到了规定动作不走样、自选动作求创新、蹄疾步稳重实效。他以《用真情实意和制度约束来反对和克服官僚主义》为题，汇报了自己的学习体会。他表示，通过学习周恩来同志《反对官僚主义》的讲话和前段时间听取师生的意见，深刻认识到反对官僚主义问题始终是中国共产党面临的重大课题，群众路线是党的&ldquo;传家宝&rdquo;，官僚主义是党群关系的&ldquo;隔离墙&rdquo;。关于如何反对和克服官僚主义，他认为要在真知、真干、真治上下功夫，踏踏实实做人，勤勤恳恳做事，并依靠制度进行约束，建立长效机制。</span></span></div>\r\n<div align=\"left\" style=\"line-height: 24pt; text-indent: 24pt;\">\r\n	<span id=\"ctl00_ContentArea_gvList_ctl02_Label2\" style=\"LINE-HEIGHT: 30px\"><span style=\"FONT-SIZE: 12pt\">党委副书记、校长傅广生以《凝练教育实践成果，推动学校科学发展》为题，汇报了个人开展学习教育情况和学习体会。他表示通过系统学习、深入群众，在教育实践活动中获益良多，认为办好大学最关键要找准办学定位，凸显办学特色。为了把河北大学办成人民满意大学，他说要以习近平总书记系列重要讲话指导办学实践，从优化国家高等教育布局、引领地方高等教育和促进区域经济发展的宏大视野谋划发展，坚守办学传统，凝练品牌特色，重塑大学精神。</span></span></div>\r\n<div align=\"left\" style=\"line-height: 24pt; text-indent: 24pt;\">\r\n	<span id=\"ctl00_ContentArea_gvList_ctl02_Label2\" style=\"LINE-HEIGHT: 30px\"><span style=\"FONT-SIZE: 12pt\">党委副书记王余丁，党委常委、副校长王凤鸣，党委常委、副校长康书生，党委常委王培光，党委常委杨立海，党委常、纪委书记张彦勤，副校长杨学新，副校长申世刚，副校长任德亮等党员校领导分别以《学习习近平总书记关于党的作风建设的体会》，《以焦裕禄精神为标，真抓实干助推学校实力提升&mdash;&mdash;党的群众路线教育实践活动学习体会》，《坚持科学发展观,正确处理研究生教育若干关系&mdash;&mdash;学习习近平同志关于科学发展重要论述体会》，《关于加强教师队伍建设重要性的几点认识》，《学习焦裕禄精神，做人民群众的好干部》，《人格如金，德行为本&mdash;&mdash;弘扬焦裕禄精神，践行&ldquo;三严三实&rdquo;要求》，《调整思路，抢抓机遇，全面提高教育教学质量》，《科学发展引领河北大学学科建设&mdash;&mdash;学习习近平同志关于推动科学发展的重要论述体会》，《全心全意为师生服务》等为题，先后汇报了个人在群众路线教育实践活动中的学习教育情况和学习体会。</span></span></div>\r\n<div align=\"left\" style=\"line-height: 24pt; text-indent: 24pt;\">\r\n	<span id=\"ctl00_ContentArea_gvList_ctl02_Label2\" style=\"LINE-HEIGHT: 30px\"><span style=\"FONT-SIZE: 12pt\">省委第十六督导组组长李益民做了点评讲话。她简要传达了省委书记周本顺同志在全省第二批教育实践活动汇报会上的重要讲话精神和省活动办《关于进一步抓好学习教育的通知》精神。她说，从11位党员校领导的汇报来看，大家态度端正，学习有收获，对下一步的学习起到了引领作用。她指出，从前一阶段的工作来看，河北大学对教育实践活动重视程度高，广大党员干部态度是端正的，要求是严格的，整体推进是有力的，能够广泛发动群众，征求意见质量好，并且结合实际，立改立行，产生了良好的效果。她强调，下一阶段的教育实践活动将进入攻坚阶段，要紧紧围绕中央提出的&ldquo;五个进一步&rdquo;的目标开展工作，站在新的高度继续深入学习，把学习提高贯穿始终；将解决&ldquo;四风&rdquo;问题与转变作风相结合，把制度建设贯穿始终；聚焦问题，聚焦重点，把整改落实贯穿始终。</span></span></div>\r\n<div align=\"left\" style=\"line-height: 24pt; text-indent: 24pt;\">\r\n	<span id=\"ctl00_ContentArea_gvList_ctl02_Label2\" style=\"LINE-HEIGHT: 30px\"><span style=\"FONT-SIZE: 12pt\">党委书记王洪瑞主持会议。他指出，省委督导组组长李益民同志的讲话高屋建瓴，语重心长，对我们的工作提出了明确的指导意见，我们要认真学习领会，贯彻落实。他强调，当前，教育实践活动正向纵深推进，任务十分繁重，我们必须以&ldquo;踏石留印、抓铁有痕&rdquo;的劲头抓好每一个环节，做到善始善终、善做善成，使教育实践活动达到预期的目标。</span></span></div>\r\n<div align=\"right\" style=\"TEXT-ALIGN: right; LINE-HEIGHT: 24pt; TEXT-INDENT: 24pt; LAYOUT-GRID-MODE: char\">\r\n	<span id=\"ctl00_ContentArea_gvList_ctl02_Label2\" style=\"LINE-HEIGHT: 30px\"><span style=\"FONT-SIZE: 12pt\">（党办、组织部、宣传部供稿）</span></span></div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('302','1050','1','','','4月19日下午， 2013—2014年度青年志愿者表彰大会在图书馆报告厅举行。大会对我校在2013年度志愿服务工作中表现突出的集体和个人进行了表彰。党委常委王培光对我校志愿服务工作取得的成绩给予了肯定，希望志愿者工作要与青年学生的教育培养相结合，全面提高志愿服务','183.48.65.148','121.8.7.164','1408885180','<div align=\"left\" style=\"line-height: 24pt; text-indent: 24pt;\">\r\n	<span id=\"ctl00_ContentArea_gvList_ctl02_Label2\" style=\"LINE-HEIGHT: 30px\"><span style=\"FONT-SIZE: 12pt\">4</span><span style=\"FONT-SIZE: 12pt\">月19日</span><span style=\"FONT-SIZE: 12pt\">下午， 2013&mdash;2014年度青年志愿者表彰大会在图书馆报告厅举行。</span></span></div>\r\n<div align=\"left\" style=\"line-height: 24pt; text-indent: 24pt;\">\r\n	<span id=\"ctl00_ContentArea_gvList_ctl02_Label2\" style=\"LINE-HEIGHT: 30px\"><span style=\"FONT-SIZE: 12pt\">大会对我校在2013年度志愿服务工作中表现突出的集体和个人进行了表彰。党委常委王培光对我校志愿服务工作取得的成绩给予了肯定，</span><span style=\"FONT-SIZE: 12pt\">希望志愿者工作要与青年学生的教育培养相结合，全面提高志愿服务层次，拓宽志愿服务领域</span><span style=\"FONT-SIZE: 12pt\">，为构建温馨校园、和谐社会贡献力量。优秀志愿者代表、志愿服务突出贡献组织单位代表分别发言，志愿者代表温永利带领全体参会人员重温了志愿誓词。组织部、党委办公室、宣传部、关工委、校团委等部门负责人，各学院团委书记、离退休老一辈代表、获奖集体和个人代表及来自各学院的青年志愿者共200余人参加了大会。</span></span></div>\r\n<div align=\"left\" style=\"line-height: 24pt; text-indent: 24pt;\">\r\n	<span id=\"ctl00_ContentArea_gvList_ctl02_Label2\" style=\"LINE-HEIGHT: 30px\"><span style=\"FONT-SIZE: 12pt\">会后，学校关老委、关工委组织了&ldquo;我的中国梦&rdquo;主题育讲座。</span></span></div>\r\n<div style=\"TEXT-ALIGN: right; LINE-HEIGHT: 24pt; TEXT-INDENT: 24pt; LAYOUT-GRID-MODE: char\">\r\n	<span id=\"ctl00_ContentArea_gvList_ctl02_Label2\" style=\"LINE-HEIGHT: 30px\"><span style=\"FONT-SIZE: 12pt\">（关老委、关工委、校团委供稿）</span></span></div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('305','1054','1','','','局长:杨靖主持市教育局全面工作。联系电话：2366011823党组书记：梁凤主持市教育局党组工作。联系电话：236603823调研员：黄海分管办公室（市语言文字工作委员会）、计划财务科、市教育信息中心、市教育装备中心、市教育基金会。联系电话：236604823牳本殖ぁ⑹薪逃&#65533;','121.8.7.164','218.108.128.12','1408809600','<p><br /></p><p style=\"text-align: center;\"><strong><span style=\"font-size: 24px;\">领导班子<br /></span></strong><br /></p><p style=\"font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><strong style=\"font-size: 18px; line-height: 1.5;\">局长:杨靖</strong></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">主持市教育局全面工作。</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">联系电话：2366011823</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\"><br /></span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\"><span style=\"line-height: 27px;\"><strong>党组书记：梁凤</strong></span></span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\"><span style=\"line-height: 27px;\">主持市教育局党组工作。</span></span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\"><span style=\"line-height: 27px;\">联系电话：236603823</span></span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: medium;\"><span style=\"line-height: 27px;\"><br /></span></span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\"><strong>调研员：黄海</strong></span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">分管办公室（市语言文字工作委员会）、计划财务科、市教育信息中心、市教育装备中心、市教育基金会。</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">联系电话：236604823</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">&nbsp;</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\"><strong>副局长、市教育督导室主任：黄健</strong></span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">分管教育督导室、市教育发展研究与评估中心、市招生考试办公室。</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">联系电话：236660823</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">&nbsp;</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\"><strong>副局长：陈明</strong></span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">分管思想政治教育科、学前教育科、关心下一代工作委员会、市青少年活动中心、市中小学德育基地。</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">联系电话：236607823</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">&nbsp;</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\"><strong>副局长、市教育工会主席：建群</strong></span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">分管民办学校管理科、安全管理科、市教育工会、市民办教育协会。</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">联系电话：236680823</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">&nbsp;</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\"><strong>市纪委派驻市教育局纪检组组长、市教育局直属机关党委书记：张炳</strong></span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">主管市纪委、监察局派驻局纪检组、监察室的工作，分管人事科（党委办）、局直属机关党委、市教育系统社会组织党委、市教师继续教育指导中心、市教师进修学校。</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">联系电话：236690823</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">&nbsp;</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\"><strong>副局长：邓松</strong></span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">分管职业与成人教育科、高等教育办公室。</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">联系电话：236606823</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\"><br /></span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\"><strong>副局长：何基</strong></span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">分管基础教育科、教研室、中等学校招生办公室。</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">联系电话：236670823</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">&nbsp;</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\"><strong>副调研员：周少</strong></span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">协管纪检监察工作、局直属机关党委、市教育系统社会组织党委。</span></p><p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal;\"><span style=\"font-size: 18px;\">联系电话：236670823</span></p><p><br /></p>');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('306','1055','1','','<!--#p8_attach#-->/cms/item/2015_05/23_08/def29b9c7dd0d591.jpg','','121.8.7.164','113.247.20.58','1408809600','<p>&nbsp;</p>\r\n\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n\r\n<p style=\"text-align: center;\"><img alt=\"3.jpg\" src=\"<!--#p8_attach#-->/ueditor/image/20150718/1437221655116667.jpg\" title=\"1437221655116667.jpg\" /></p>\r\n\r\n<p>6666</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('307','1056','1','','','　','121.8.7.164','175.9.118.115','1408809600','<p style=\"TEXT-ALIGN: center\" sizcache=\"40\" sizset=\"190\"><strong><span style=\"FONT-SIZE: 24px\">　工作机构信息</span></strong></p><p style=\"TEXT-ALIGN: left\" sizcache=\"40\" sizset=\"190\"><span style=\"FONT-SIZE: 14px\"><br /></span></p><p style=\"TEXT-ALIGN: left\" sizcache=\"40\" sizset=\"190\"><span style=\"FONT-SIZE: 14px\"></span></p><p style=\"FONT-SIZE: 14px; FONT-FAMILY: sans-serif, 宋体; WHITE-SPACE: normal; LINE-HEIGHT: 25px\"><span style=\"FONT-SIZE: 16px\">市教育局信息公开工作机构：设在局办公室</span><br /><span style=\"FONT-SIZE: 16px\">办公地点：市南城三元路8号东莞报业大厦9楼</span><br /><span style=\"FONT-SIZE: 16px\">办公时间：周一至五&nbsp;上午:8：30—12：00；</span><span style=\"FONT-SIZE: 16px\">下午:14：00—17：30</span><span style=\"FONT-SIZE: 16px; LINE-HEIGHT: 25px\">（节假日除外）</span></p><p style=\"FONT-SIZE: 14px; FONT-FAMILY: sans-serif, 宋体; WHITE-SPACE: normal; LINE-HEIGHT: 25px\"><span style=\"FONT-SIZE: 16px\">联系电话：070-231260343&nbsp;&nbsp;传真：070-234126100</span><br /><span style=\"FONT-SIZE: 16px\">网上申请地址：在教育网</span><span style=\"FONT-SIZE: 16px\">“信息公开”和市政府信息公开网</span></p><p style=\"FONT-SIZE: 14px; FONT-FAMILY: sans-serif, 宋体; WHITE-SPACE: normal; LINE-HEIGHT: 25px\"><span style=\"FONT-SIZE: 16px\"></span>&nbsp;</p><p style=\"FONT-SIZE: 14px; FONT-FAMILY: sans-serif, 宋体; WHITE-SPACE: normal; TEXT-ALIGN: center; LINE-HEIGHT: 25px\"><span style=\"FONT-SIZE: 16px\"></span></p><p style=\"TEXT-ALIGN: left\" sizcache=\"40\" sizset=\"190\"><span style=\"FONT-SIZE: 14px\"><br /></span><br /></p>');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('309','1058','1','','<!--#p8_attach#-->/cms/item/2014_09/10_22/f06d99571a5d25c2.jpg','2014年暑期缘梦彩云支教活动于 2014年7月18日至8月5日在云南省昭通市彝良县举行。本次支教活动共有三个支队，第一支队12人，由土木学院学生9名13级学生及3名12级学生组成，支教地为云南省昭通市彝良县奎乡仙','14.120.231.20','113.247.20.58','1410278400','<p style=\"line-height: 200%;\">&nbsp;<span style=\"font-size: 14pt;\"><span style=\"font-family: 宋体;\">由东南大学缘梦彩云支教团、土木工程学院团委共同开展的2014</span>年暑期缘梦彩云支教活动于 2014<span style=\"font-size: 14pt;\">年7</span>月18</span>日<span style=\"font-size: 14pt;\">至8</span>月5日在云南省昭通市彝良县举行。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 28pt;\"><span style=\"font-size: 14pt;\"><span style=\"font-family: 宋体;\">本次支教活动共有三个支队，第一支队12</span>人，由土木学院学生9</span>名13级学生及3名12级学生组成，支教地为云南省昭通市彝良县奎乡仙马小学；第二支队是混合编队，12人来自不同学院，以13级同学为主，支教地为云南省昭通市彝良县奎乡吉塘小学；第三支队也是混合编队，但11人以高年级为主，他们在云南省昭通市彝良县洛泽河镇笋叶小学开展支教活动。</p>\r\n\r\n<p style=\"line-height: 200%;\"><span style=\"font-size: 14pt;\"><span style=\"font-family: 宋体;\">&nbsp;&nbsp; 7月18</span></span>日，三支支教队乘坐三十多小时的火车来到昭通彝良县。在此之前，支教团的同学们已经在学校做了充分的准备工作，有专门的支教培训和支教课件制作，同学们很快适应了当地的生活。当地的学校条件依旧十分艰苦，除了每天的工作室和宿舍条件非常简陋外，一天三顿的饭菜都需要队员们自己大锅生火、洗菜烧菜。其中四五天的一次赶集，队员们能采集到的食材自然也十分有限，当地的主要食材洋芋（马铃薯）也就成了大家的主要菜品。奋斗后得到的果实总是甜美的，对于很多第一次接触纯粹农村生活的同学而言，每一顿饭下来，碗筷间都洋溢着他们品尝自己劳动果实的喜悦，每一晚拖着疲惫身体回板房就寝，脸上却也淌着幸福的微笑。</p>\r\n\r\n<p style=\"line-height: 200%;\">&nbsp;&nbsp; <span style=\"font-size: 14pt;\"><span style=\"font-family: 宋体;\">在当地学校主管老师的帮助下，很快就有一批已经进入假期的学生来学校上课。仙马小学有120</span>名学生返校，吉塘小学有320</span>名同学返校，笋叶小学也有110名同学返校。大家为学生分配好年级、班级，各任课老师开始自己紧锣密鼓的排课和授课阶段。在支教活动中，同学们带给当地学生基础知识的补充，让他们接触到了历史、环境卫生、美术等平日不常见到的课程，更重要的是在这个过程中，他们体会到的外面世界的精彩，在他们心中种下了希望的种子和催生了前进的动力。师生间的欢声笑语充盈着校园的每一个角落。</p>\r\n\r\n<p style=\"line-height: 200%;\"><span style=\"font-size: 14pt;\"><span style=\"font-family: 宋体;\">&nbsp;&nbsp; 8月3</span></span>日下午3时30分，就在支教工作的尾声阶段，云南省昭通市鲁甸县发生了里氏6.5<span style=\"font-size: 14pt;\"><span style=\"font-family: 宋体;\">级的地震，本次地震发生在昭通市的山区地带，震源深度较浅，灾害程度较高。正在支教的队员们离震中也很近，明显感觉到了大地的晃动。大家很快通过各个途径及时了解地震的准确消息。支教队员们支教行动完成结束后，大家临时决定在当地进行志愿救助工作。心系灾区人民，整个中国都在为灾区加油。身在灾区的各位支教队员，更有义务为当地的灾区人民进行力所能及的救助。大家募集善款到捐款点进行捐款外，一部分队员把随身带着的睡袋也送给了灾区的人民。队员们都希望通过自己的努力，为这几天的灾区救助贡献一份力量，以这种特殊的方式，结束支教工作离开昭通。对于我们这些大学生而言意义非凡。很多队员也表示，这次支教活动以及灾区救助活动提升了自己的人生意义。</span></span></p>\r\n\r\n<p style=\"line-height: 200%;\">&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('310','1059','1','','','朗朗金秋，丹桂飘香。土木工程学院又迎来了307名硕士研究生和46名博士研究生。9月5日下午2点半，湖南大学土木工程学院2014级研究生新生开学典礼在复临舍301隆重举行。院长肖岩，院党委书记赵明华,副院长易伟建，院务委员李正农莅临大会，外专千人计划学者S.Kunnath,&nbs','14.120.231.20','14.120.231.20','1410278400','<p style=\"font-family:Tahoma;font-size:12px;text-indent:28pt;margin-bottom:0pt;margin-top:0pt;line-height:20px;color:rgb(51, 51, 51);\">\r\n	　　<span style=\"font-size:14px;\"><span style=\"font-family:宋体;\"><span><span style=\"color:rgb(73,73,73);\">朗朗金秋，丹桂飘香。土木工程学院又迎来了307名硕士研究生和46名博士研究生。9月5日下午2点半，湖南大学土木工程学院2014级研究生新生开学典礼在复临舍301隆重举行。院长肖岩，院党委书记赵明华,副院长易伟建，院务委员李正农莅临大会，外专千人计划学者S.Kunnath,&nbsp;G.&nbsp;Monti以及各系主任和教师代表们也出席了典礼。开学典礼由院党委副书记颜李主持。</span></span></span></span></p>\r\n<p style=\"font-family:Tahoma;font-size:12px;text-indent:28pt;margin-bottom:0pt;margin-top:0pt;line-height:20px;color:rgb(51, 51, 51);\">\r\n	&nbsp;</p>\r\n<p style=\"font-family:Tahoma;font-size:12px;text-indent:28pt;margin-bottom:0pt;margin-top:0pt;line-height:20px;color:rgb(51, 51, 51);\">\r\n	　　<span style=\"font-size:14px;\"><span style=\"font-family:宋体;\"><span><span style=\"color:rgb(73,73,73);\">首先，肖岩院长代表全院师生对新同学的到来表示了热烈的欢迎，向同学们介绍了土木院的办学历史和特色等。</span></span><span><span style=\"color:rgb(73,73,73);\">肖院长就大学</span></span><span><span style=\"color:rgb(73,73,73);\">学术诚信和反腐倡廉</span></span><span><span style=\"color:rgb(73,73,73);\">进行了阐述，</span></span><span><span style=\"color:rgb(73,73,73);\">鼓励同学们要秉承千年学府和百年学院的优良传统，诚实做人，专心治学，并送给同学们</span></span><span><span style=\"color:rgb(73,73,73);\">两个具有湖大特色的词</span></span><span><span style=\"color:rgb(73,73,73);\">：&ldquo;自卑亭&rdquo;&ldquo;惟楚有才&rdquo;，在做学问的时候既要有谦卑的姿态，也要有攻克难关的信念，也应有心系天下的楚人襟怀。</span></span></span></span></p>\r\n<p style=\"font-family:Tahoma;font-size:12px;text-indent:28pt;margin-bottom:0pt;margin-top:0pt;line-height:20px;color:rgb(51, 51, 51);\">\r\n	&nbsp;</p>\r\n<p style=\"font-family:Tahoma;font-size:12px;text-indent:28pt;margin-bottom:0pt;margin-top:0pt;line-height:20px;color:rgb(51, 51, 51);\">\r\n	　　<span style=\"font-size:14px;\"><span style=\"font-family:宋体;\"><span><span style=\"color:rgb(73,73,73);\">接着，</span></span><span><span style=\"color:rgb(73,73,73);\">易伟建副</span></span><span><span style=\"color:rgb(73,73,73);\">院长鼓励同学们好好利用研究生自主学习的时间，专注于学习与科研，并对新生寄予了美好的希望，希望同学们做到三好：&ldquo;心态好、身体好、学习好&rdquo;。随后，我院国家外专千人学者</span></span><span>Monti教授</span><span><span style=\"color:rgb(73,73,73);\">用英语向新同学们进行了开学问候和交流，在大家的掌声中，颜李书记宣布开学典礼顺利结束。</span></span></span></span></p>\r\n<p style=\"font-family:Tahoma;font-size:12px;text-indent:28pt;margin-bottom:0pt;margin-top:0pt;line-height:20px;color:rgb(51, 51, 51);\">\r\n	&nbsp;</p>\r\n<p style=\"font-family:Tahoma;font-size:12px;text-indent:28pt;margin-bottom:0pt;margin-top:0pt;line-height:20px;color:rgb(51, 51, 51);\">\r\n	　　<span style=\"font-size:14px;\"><span style=\"font-family:宋体;\"><span><span style=\"color:rgb(73,73,73);\">随后，研究生教务秘书林燕老师给大家介绍了制定培养计划和选课等相关事项的流程，辅导员马晓倩老师、王宁老师向新生们介绍研究生日常管理工作等各方面注意事项。</span></span></span></span></p>\r\n<p style=\"font-family:Tahoma;font-size:12px;text-indent:28pt;margin-bottom:0pt;margin-top:0pt;line-height:20px;color:rgb(51, 51, 51);\">\r\n	&nbsp;</p>\r\n<p style=\"font-family:Tahoma;font-size:12px;text-indent:28pt;margin-bottom:0pt;margin-top:0pt;line-height:20px;color:rgb(51, 51, 51);\">\r\n	　　<span style=\"font-size:14px;\"><span style=\"font-family:宋体;\"><span><span style=\"color:rgb(73,73,73);\">开学典礼作为我院给新生入学教育的第一课，为广大新生和老师提供了一个交流的平台，有助于新生更快、更好地了解适应研究生生活，同时也为接下来各项新生工作的开展打下了基础。新的一批研究生为土木院注入了新的力量，相信他们会利用好土木学院这一腾飞的舞台，努力去创造属于自己的研究生时代。</span></span></span></span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('311','1060','1','','','9月8日，正值中秋佳节，一户家庭贫困的三胞胎孩子的家中一片欢声笑语。来自土木工程学院红十字分会的3名志愿者，给这户三胞胎家庭送去了温暖和关爱。当志愿者们到达三胞胎小朋友的家中时，小朋友们十分高兴。小朋友们拉着志愿者到客厅围坐一圈，并给志愿者唱了一首ABC歌','14.120.231.20','14.120.231.20','1410360021','<p align=\"left\" style=\"line-height:26pt;text-indent:24pt;margin:0cm 0cm 10pt;\">\r\n	<span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">9</span></span><span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">月8</span>日，正值中秋佳节，一户家庭贫困的三胞胎孩子的家中一片欢声笑语。来自土木工程学院红十字分会的3</span>名志愿者，给这户三胞胎家庭送去了温暖和关爱。</p>\r\n<p align=\"left\" style=\"line-height:26pt;text-indent:24pt;margin:0cm 0cm 10pt;\">\r\n	<span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">当志愿者们到达三胞胎小朋友的家中时，小朋友们十分高兴。小朋友们拉着志愿者到客厅围坐一圈，并给志愿者唱了一首ABC</span>歌。随后，志愿者们拿出了一些空瓶子，在小朋友们惊奇的目光中，把那些废瓶子变成了一把扫把，这激起了小朋友的好奇心以及强烈的动手感，于是在志愿者们的指导下，小朋友们把原本的空瓶子，变成了笔筒、花篮等手工艺品。接着，志愿者们同小家伙们玩起了游戏，小朋友们欢乐的笑声贯穿在游戏之中。最后，志愿者们拿出了送给小朋友们准备的中秋礼物，在小朋友们的欢呼雀跃中，本次志愿者活动圆满的落下帷幕。</span></p>\r\n<p align=\"left\" style=\"line-height:26pt;text-indent:24pt;margin:0cm 0cm 10pt;\">\r\n	<span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">此次关爱三胞胎的活动，不仅增强了三个小朋友们的环保意识，还为她们送来温暖。志愿者们虽然未能与家人一起度过这个中秋，但是因为爱的奉献，他们没有遗憾反而倍感开心。</span></span></p>\r\n<p align=\"right\" style=\"text-align:right;line-height:26pt;text-indent:24pt;margin:0cm 0cm 10pt;\">\r\n	<span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">土木工程学院宣</span></span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('312','1061','1','','<!--#p8_attach#-->/cms/item/2015_05/23_08/9a720b9fd38c67fb.jpg','7月3日上午，土木工程学院红十字分会暑期社会实践团的团员们向来自钱塘博文小学的留守儿童宣传防水、防火的相关知识，也向小朋友们及其家长们讲解了一些常用药品的正确使用方法，纠正日常生活中常见的药品错误使用方法。此外，团员们还在现场向小朋友展示几种应急的包扎','14.120.231.20','113.96.85.241','1410278400','<p align=\"left\" style=\"line-height:26pt;text-indent:24pt;\"><span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">7</span></span><span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">月3</span>日</span><span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">上午，土木工程学院红十字分会暑期社会实践团的团员们向来自钱塘博文小学的留守儿童宣传防水、防火的相关知识，也向小朋友们及其家长们讲解了一些常用药品的正确使用方法，纠正日常生活中常见的药品错误使用方法。此外，团员们还在现场向小朋友展示几种应急的包扎方式，并让小朋友们动手实践，小朋友们受益颇多。上午的活动极大地提升了小朋友们的安全意识和自救能力。</span></span></p>\r\n\r\n<p align=\"left\" style=\"line-height:26pt;text-indent:24pt;\"><span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">7</span></span><span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">月3</span>号下午，团员们为小朋友们设计了几个简单却蕴意深刻的游戏。团员们和小朋友们一起参与到游戏中去，以游戏的方式来拉近团员们和小朋友之间的距离，让他们感受到快乐，感受到来自社会的关怀。</span></p>\r\n\r\n<p align=\"left\" style=\"line-height:26pt;text-indent:24pt;\"><span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">7</span></span><span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">月4</span>日</span><span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">上午，团员们为留守儿童举行了爱心红书袋的捐赠仪式。著名书法家石鸣老师出席了此次仪式，并将他亲笔所写的字赠予在场的小朋友。在下午的活动中，小朋友们收到了来自社会人员的礼物，让他们更为深切的感受到了社会各界人士对他们的关怀。至此，此次暑期社会实践活动圆满落下帷幕。</span></span></p>\r\n\r\n<p align=\"left\" style=\"line-height:26pt;text-indent:24pt;\"><span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">经过此次暑期社会实践活动，团员们不仅弘扬了红十字会的博爱人道精神，还让钱塘文博小学的孩子们学会了如何防灾自救。这为构建和谐社会、实现中国梦奠定了基础，也是团员们作为当代大学生服务社会，回报国家的良好举措。团员们在学习之余投身社会实践，将理论与实际相结合，在服务他人的同时也提高了自身的综合素养。</span></span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('313','1062','1','','','历经35年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼&amp;amp;ldquo;两个一百年&amp;amp;rdquo;目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的','14.120.231.20','14.120.231.20','1410360106','<p align=\"left\" style=\"line-height:22.5pt;text-indent:24pt;margin:7.5pt 0cm;\">\r\n	<span style=\"font-size:16pt;\"><span style=\"color:#26214a;\"><span style=\"font-family:仿宋_gb2312;\">历经35</span>年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼&ldquo;两个一百年&rdquo;目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的历史起点上改革&ldquo;集结号&rdquo;。</span></span></p>\r\n<p align=\"left\" style=\"line-height:22.5pt;text-indent:24pt;margin:7.5pt 0cm;\">\r\n	<span style=\"font-size:16pt;\"><span style=\"color:#26214a;\"><span style=\"font-family:仿宋_gb2312;\">历史是最好的教科书，深刻揭示出一个国家、一个民族的进步发展之道。35</span>年来，从国民经济的快速增长，到人民生活水平的显著改善，从经济体制的深刻变革，到国家和人民面貌的深刻变化，莫不靠的是改革开放。今天，破解发展中面临的难题、化解来自各方面的风险挑战、推动经济社会持续健康发展，除了深化改革开放，别无他途。全面深化改革，关系党和人民事业前途命运，关系党的执政基础和执政地位，在整个社会主义现代化进程中，改革开放的旗帜，绝不能有丝毫动摇。</span></span></p>\r\n<p align=\"left\" style=\"line-height:22.5pt;text-indent:24pt;margin:7.5pt 0cm;\">\r\n	<span style=\"font-size:16pt;\"><span style=\"color:#26214a;\"><span style=\"font-family:仿宋_gb2312;\">这次三中全会制定全面深化改革的总体方案，提出了全面深化改革的指导思想、总体思路、目标任务，为的就是高举改革开放旗帜、不断推进中国特色社会主义制度自我完善和发展，为实现亿万人民的中国梦释放强大动力。这是指导新形势下全面深化改革的纲领性文件。当前和今后一个时期，全党全国的一项重要政治任务，就是要以强烈的进取意识、机遇意识、责任意识，深刻领会全会精神并转化成改造现实世界的强大力量。</span></span></span></p>\r\n<p align=\"left\" style=\"line-height:22.5pt;text-indent:24pt;margin:7.5pt 0cm;\">\r\n	<span style=\"font-size:16pt;\"><span style=\"color:#26214a;\"><span style=\"font-family:仿宋_gb2312;\">在35</span>年的改革历程中，我们谱写的中华民族自强不息、顽强奋进的壮丽史诗，靠的是一往无前的进取精神。今天，改革面临的矛盾越多、难度越大，越要坚定与时俱进、攻坚克难信心，越要有进取意识、进取精神、进取毅力，越要有&ldquo;明知山有虎，偏向虎山行&rdquo;的勇气。纵观世界，变革是大势所趋、人心所向。领导改革开放这一前无古人、世所罕见的伟大事业，最要不得的是思想僵化、固步自封。&ldquo;逆水行舟用力撑，一篙松劲退千寻&rdquo;。以习近平同志为总书记的党中央，作出了全面深化改革的战略部署，牢固树立进取意识，全面审视当今世界和当代中国发展大势，全面把握我国发展新要求和人民群众新期待，更加奋发有为地开拓进取，我们就一定能够坚定不移把改革开放引向深入。</span></span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('314','1063','1','','','研究生教育招生简介导师信息考试目录及大纲学科方向资讯动态您现在的位置：&amp;amp;nbsp;土木工程学院&amp;amp;nbsp;&amp;gt;&amp;gt;&amp;amp;nbsp;研究生教育&amp;amp;nbsp;&amp;gt;&amp;gt;&amp;amp;nbsp;资讯动态&amp;amp;nbsp;&amp;gt;&amp;g','14.120.231.20','14.120.231.20','1410360151','<div>\r\n	<h2>\r\n		<a><strong>研究生教育</strong></a></h2>\r\n	<ul>\r\n		<li>\r\n			<h3>\r\n				<a href=\"http://civil.fjut.edu.cn/yjs/ShowArticle.asp?ArticleID=2464\">招生简介</a></h3>\r\n		</li>\r\n		<li>\r\n			<h3>\r\n				<a href=\"http://civil.fjut.edu.cn/yjs/ShowArticle.asp?ArticleID=2472\">导师信息</a></h3>\r\n		</li>\r\n		<li>\r\n			<h3>\r\n				<a href=\"http://civil.fjut.edu.cn/yjs/showclass.asp?classid=171\">考试目录及大纲</a></h3>\r\n		</li>\r\n		<li>\r\n			<h3>\r\n				<a href=\"http://civil.fjut.edu.cn/yjs/ShowClass.asp?ClassID=170\">学科方向</a></h3>\r\n		</li>\r\n		<li>\r\n			<h3>\r\n				<a href=\"http://civil.fjut.edu.cn/yjs/showclass.asp?classid=172\">资讯动态</a></h3>\r\n		</li>\r\n	</ul>\r\n</div>\r\n<div>\r\n	<div>\r\n		<div>\r\n			您现在的位置：&nbsp;<a href=\"http://civil.fjut.edu.cn/\">土木工程学院</a>&nbsp;&gt;&gt;&nbsp;<a href=\"http://civil.fjut.edu.cn/yjs/Index.asp\">研究生教育</a>&nbsp;&gt;&gt;&nbsp;<a href=\"http://civil.fjut.edu.cn/yjs/ShowClass.asp?ClassID=172\">资讯动态</a>&nbsp;&gt;&gt;&nbsp;正文</div>\r\n	</div>\r\n	<div>\r\n		<h3>\r\n			福建工程学院土木工程学院2014年硕士研究生招生复试及录取工作流程</h3>\r\n		<em>文章来源：本站原创&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;浏览次数：520&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;发布时间： 2014-3-27</em>\r\n		<div>\r\n			<p align=\"center\" style=\"text-align:center;margin:15.6pt 0cm 0pt;background:#fefefe;\">\r\n				&nbsp;</p>\r\n			<p align=\"left\" style=\"line-height:26pt;text-indent:-21pt;margin:15.6pt 0cm 0pt;background:rgb(254, 254, 254);\">\r\n				<strong><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">1.</span></span></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">复试信息发布及复试通知</span></span></strong></p>\r\n			<p align=\"left\" style=\"line-height:26pt;text-indent:28pt;background:rgb(254, 254, 254);\">\r\n				<span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">在土木工程学院网站http://civil.fjut.edu.cn</span>上公布参加复试的考生名单、复试录取政策及工作流程等，用电话、短信及email</span>等方式通知考生复试。</p>\r\n			<p align=\"left\" style=\"line-height:26pt;text-indent:-21pt;background:rgb(254, 254, 254);\">\r\n				<strong><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">2.</span></span></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">考生报到</span></span></strong></p>\r\n			<p align=\"left\" style=\"line-height:26pt;text-indent:28pt;background:rgb(254, 254, 254);\">\r\n				<span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">时间：2014</span>年4</span>月1日下午14:30－16:00</p>\r\n			<p align=\"left\" style=\"line-height:26pt;text-indent:28pt;background:rgb(254, 254, 254);\">\r\n				<span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">地点：</span></span><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">福建工程学院旗山校区土木工程学院思源楼4</span>楼</span></p>\r\n			<p align=\"left\" style=\"line-height:26pt;text-indent:-21pt;background:rgb(254, 254, 254);\">\r\n				<strong><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">3.</span></span></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">考生参加体检</span></span></strong></p>\r\n			<p align=\"left\" style=\"line-height:26pt;text-indent:28pt;background:rgb(254, 254, 254);\">\r\n				<span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">时间：</span></span><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">待定（报到时通知）</span></span></p>\r\n			<p align=\"left\" style=\"line-height:26pt;text-indent:28pt;background:rgb(254, 254, 254);\">\r\n				<span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">地点：</span></span><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">待定（报到时通知）</span></span></p>\r\n			<p align=\"left\" style=\"line-height:26pt;text-indent:-21pt;background:rgb(254, 254, 254);\">\r\n				<strong><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">4.</span></span></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">考生参加复试</span></span></strong></p>\r\n			<p align=\"left\" style=\"line-height:26pt;text-indent:28pt;background:rgb(254, 254, 254);\">\r\n				<span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">时间：</span></span><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">2014</span></span><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">年4</span>月2</span>日上午<span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">8:30</span></span><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">－12:00</span></span></p>\r\n			<p align=\"left\" style=\"line-height:26pt;text-indent:28pt;background:rgb(254, 254, 254);\">\r\n				<span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">地点：福建工程学院旗山校区土木工程学院思源楼4</span>楼</span></p>\r\n			<p align=\"left\" style=\"line-height:26pt;text-indent:-21pt;background:rgb(254, 254, 254);\">\r\n				<strong><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">5.</span></span></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">复试小组成员现场评分</span></span></strong></p>\r\n			<p align=\"left\" style=\"line-height:26pt;text-indent:-21pt;background:rgb(254, 254, 254);\">\r\n				<strong><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">6.</span></span></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">计算总成绩及专业排名</span></span></strong></p>\r\n			<p align=\"left\" style=\"line-height:26pt;text-indent:28pt;background:rgb(254, 254, 254);\">\r\n				<span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">复试完毕，计算考生的入学考试总成绩，按总成绩从高到低排名。</span></span></p>\r\n			<p align=\"left\" style=\"line-height:26pt;text-indent:-21pt;background:rgb(254, 254, 254);\">\r\n				<strong><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">7.</span></span></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">确定拟录取名单</span></span></strong></p>\r\n			<p align=\"left\" style=\"line-height:26pt;text-indent:28pt;background:rgb(254, 254, 254);\">\r\n				<span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">按照考生入学考试总成绩排名，按照从高分到低分顺序，确定拟录取名单。</span></span></p>\r\n			<p align=\"left\" style=\"line-height:26pt;text-indent:-21pt;background:rgb(254, 254, 254);\">\r\n				<strong><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">8.&nbsp;</span></span></strong><strong><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">公布拟录取名单</span></span></strong></p>\r\n			<p align=\"left\" style=\"line-height:26pt;text-indent:28pt;background:rgb(254, 254, 254);\">\r\n				<span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">时间：2014</span>年4</span>月2日15:00。</p>\r\n			<p align=\"left\" style=\"line-height:26pt;text-indent:-21pt;background:rgb(254, 254, 254);\">\r\n				<strong><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">9.&nbsp;</span></span></strong><strong><span style=\"font-size:14pt;\"><span style=\"font-family:宋体;\">报送拟录取名单，录取工作结束。</span></span></strong></p>\r\n		</div>\r\n	</div>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('315','1064','1','','<!--#p8_attach#-->/cms/item/2015_05/23_08/6bda83cf89e6cf65.jpg','9月9日上午，在笫29个教师节来临之际，中共中央政治局常委、国务院总理李克强在大连考察并看望师生，与基层教师座谈。　　大连二十高中安静的校园里，学生们正在上课。李克强走进教师办公室，看到总理，教师们纷纷围拢过来。李克强说，教师永远是天底下最受人尊敬的职业','14.120.231.20','113.96.85.241','1410278400','<p align=\"left\" style=\"line-height:24pt;margin:0cm 0cm 18.75pt;\"><span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">9</span></span><span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">月9</span>日</span><span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">上午，在笫29</span>个教师节来临之际，中共中央政治局常委、国务院总理李克强在大连考察并看望师生，与基层教师座谈。</span></p>\r\n\r\n<p align=\"left\" style=\"line-height:24pt;margin:0cm 0cm 18.75pt;\"><span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">　　大连二十高中安静的校园里，学生们正在上课。李克强走进教师办公室，看到总理，教师们纷纷围拢过来。李克强说，教师永远是天底下最受人尊敬的职业，广大教师燃烧自己、照亮别人，为国家和民族的未来带来希望，尊师重教是社会文明进步的标志。当听说二十中是首批承办内地新疆班教学的学校，李克强高兴地对身边的各族教师说，孩子们远离家乡，你们是他们知识的导师、生活的父母，你们这个集体是支持西部教育、促进民族团结的生动见证。他鼓励学校把新疆班办出品牌、办出经验，让教育资源相对丰厚的沿海和东部更多支援中西部。</span></span></p>\r\n\r\n<p align=\"left\" style=\"line-height:24pt;margin:0cm 0cm 18.75pt;\"><span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">　　在学校会议室，李克强同教师代表座谈。他说，明天是你们的节日，我代表党中央、国务院向在座各位并向全国的教育工作者致以节日问候，衷心感谢大家为教育事业付出的辛劳和心血。曾参加援疆援藏支教、从事新疆班教学和从贵州、新疆等地来进修的老师们争相发言，谈了体会和感受。援藏的老师还给总理送上一张反映支教生活的光盘，李克强愉快地收下，并表示会好好看。他说，你们怀着一颗热爱教育的心，为边远贫困地区孩子带去知识和希望，汇聚起促进教育公平的积极力量。要鼓励更多人才到西部支教，让更多西部教师到东部培训，这不仅可以提高西部教育水平，更是扬起了一面旗帜，放飞了希望，让贫困地区的孩子感到有前途、有奔头。</span></span></p>\r\n\r\n<p align=\"left\" style=\"line-height:24pt;margin:0cm 0cm 18.75pt;\"><span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">　　座谈中，李克强请教师们就促进教育公平提建议、献良策，他把老师们反映的东西部教育差距，归纳为教育资源特别是师资力量、教学方法、学生求学愿望三个方面。他指出，教育是建设中国特色社会主义的有力支撑。教育公平是社会公平的重要基础，具有起点公平的意义。要缩小城乡和区域这两个最大的差距，就必须缩小教育差距、促进教育公平，这样才能使发展更均衡、社会更和谐。他特别强调，重视教育、关心教师是各级党委政府的神圣职责。教育资源要向中西部特别是农村、边远、贫困、民族地区倾斜，不仅要均衡发展九年义务教育，还要发展好职业教育和高等教育。最重要的教育资源不是楼房、不是课桌，而是教师。促进教育公平、提高教育质量，都需要更多优秀人才长期从教，特别是到农村、边远贫困地区从教，使他们成为孩子们知识的授予者、人生的引路者、文明的传承者、道德的示范者。他希望广大教师增强责任感，努力提高师德修养和教学水平，真正做到为人师表、授业解惑。</span></span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('316','1065','1','','','十八大报告对社会主义核心价值体系建设提出了新部署新要求，强调&amp;amp;ldquo;要深入开展社会主义核心价值体系学习教育，用社会主义核心价值体系引领社会思潮、凝聚社会共识&amp;amp;rdquo;，&amp;amp;ldquo;倡导富强、民主、文明、和谐，倡导自由、平等、公正、法治，倡导爱国、敬业、诚信、友','14.120.231.20','14.120.231.20','1410360259','<div align=\"left\">\r\n	<font size=\"4\">十八大报告对社会主义核心价值体系建设提出了新部署新要求，强调&ldquo;要深入开展社会主义核心价值体系学习教育，用社会主义核心价值体系引领社会思潮、凝聚社会共识&rdquo;，&ldquo;倡导富强、民主、文明、和谐，倡导自由、平等、公正、法治，倡导爱国、敬业、诚信、友善，积极培育社会主义核心价值观&rdquo;。</font></div>\r\n<div align=\"left\">\r\n	<font size=\"4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 价值观是人们心中的深层信念，是判断是非的标准，是行动遵循的准则。一个国家和社会是否拥有广泛认同的核心价值观，直接影响到一个国家的凝聚力和影响力。十八大报告用24个字，分别从国家、社会、个人三个层面，高度概括社会主义核心价值观，清晰而凝练，不仅展现了党对社会主义核心价值观的全新认识，而且让社会公众找到核心价值观里的&ldquo;主心骨&rdquo;，为多元时代凝聚思想共识指明了方向。</font></div>\r\n<div align=\"left\">\r\n	<font size=\"4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &ldquo;共识&rdquo;产生&ldquo;合力&rdquo;，夺取中国特色社会主义新胜利，需要最大可能地引领社会思潮，凝聚社会共识。倡导富强、民主、文明、和谐，昭示中国特色社会主义伟大事业的美好前景，始终是一个鼓舞人心、振奋精神的价值理想，是一个能够凝聚起亿万人民群众智慧和力量的宏伟目标。倡导自由、平等、公正、法治，是对人民首创精神的尊重，是对人民权益的保障，更是对人民平等发展权利的维护，顺应了人民群众的呼声与需求。倡导爱国、敬业、诚信、友善，是对个人价值和个人道德的普适要求，与从古至今每个人都在追求的仁爱德义不谋而合。可以说，&ldquo;三个倡导&rdquo;顺应世情民意，最大限度地代表了社会共同理想和追求。</font></div>\r\n<div align=\"left\">\r\n	<font size=\"4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 实现&ldquo;三个倡导&rdquo;，培育社会主义核心价值观，首先需要国家层面的制度保障。如何保证自由、平等，尊重群众的创造力，如何维护社会公平正义，保障群众的基本权利，都需要相关的法规制度更加完善和执行有力。</font></div>\r\n<div align=\"left\">\r\n	<font size=\"4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 实现&ldquo;三个倡导&rdquo;，培育社会主义核心价值观，还离不开每个人从我做起，自觉践行共同的价值追求。把&ldquo;国家兴亡、匹夫有责&rdquo;化为点点滴滴爱岗奉献的行动，把诚实守信、互助友爱融入到人与人之间文明交往中，在&ldquo;春风化雨&rdquo;中弘扬真善美，呼唤中国进步发展之&ldquo;魂&rdquo;。</font></div>\r\n<div align=\"left\">\r\n	<font size=\"4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 今天，前人期待了百年的现代化之梦正在实现，对精神家园、共同理想的呼唤更加强烈。简短的24字如同一面旗帜，鲜明亮出了国家和民族的&ldquo;精气神&rdquo;。有理由相信，在这样的价值观引领下，必将凝聚起最广泛的社会力量，实现国家和民族的伟大复兴。（作者系新华社记者）</font></div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('317','1066','1','','','&amp;amp;nbsp;各省、自治区、直辖市教育厅（教委），新疆生产建设兵团教育局，有关部门（单位）教育司（局），部属各高等学校：　　为贯彻党的十七届六中全会&amp;amp;ldquo;深化政风、行风建设，开展道德领域突出问题专项教育和治理&amp;amp;rdquo;的精神，落实《国家中长期教育改革和发展规划','14.120.231.20','14.120.231.20','1410360358','<h3>\r\n	&nbsp;</h3>\r\n<div align=\"left\">\r\n	各省、自治区、直辖市教育厅（教委），新疆生产建设兵团教育局，有关部门（单位）教育司（局），部属各高等学校：</div>\r\n<div align=\"left\">\r\n	　　为贯彻党的十七届六中全会&ldquo;深化政风、行风建设，开展道德领域突出问题专项教育和治理&rdquo;的精神，落实《国家中长期教育改革和发展规划纲要（2010-2020年）》的要求，坚决反对不良学风，有效遏制学术不端行为，营造风清气正的育人环境和求真务实的学术氛围，教育部决定在&ldquo;十二五&rdquo;期间开展高校学风建设专项教育和治理行动，并提出如下实施意见。</div>\r\n<div align=\"left\">\r\n	　　<strong>一、充分认识高校学风建设的重要性和紧迫性。</strong>学风是大学精神的集中体现，是教书育人的本质要求，是高等学校的立校之本、发展之魂。优良学风是提高教育教学质量的根本保证。能否营造一个优良学风环境，关系到高等教育的科学发展和教育事业的兴衰成败。当前，高校的学风总体上是好的。但近一个时期来，在高校教师及学生的教学与科研活动中，急功近利、浮躁浮夸、抄袭剽窃、伪造篡改、买卖论文、考试舞弊等不良现象和不端行为时有发生，严重破坏了教书育人的学术风气，也造成了极其负面的社会影响。切实加强和改进高校学风建设工作已经刻不容缓。</div>\r\n<div align=\"left\">\r\n	　　<strong>二、坚持标本兼治综合治理的原则。</strong>加强高校学风建设，要坚持教育和治理相结合，坚持教育引导、制度规范、监督约束、查处警示，建立并完善弘扬优良学风的长效机制。通过专项教育治理行动，迅速建立学风建设工作体系，明确各地、各部门和高校的责任义务，力争&ldquo;十二五&rdquo;期间高校学风和科研诚信整体状况得到明显改观，为保证人才培养质量、提升科学研究水平、增强社会服务能力奠定良好的学风基础。</div>\r\n<div align=\"left\">\r\n	　　<strong>三、构建学风建设工作体系。</strong>教育部设立学风建设办公室，负责制定高校学风建设相关政策，指导检查高校学风建设工作，接受对学术不端行为的举报，指导协调和督促调查处理。各地、各部门要健全学风建设机构，负责所属高校学风建设工作。各高校要建立相应的工作机构和工作机制，负责本校学风建设工作和学术不端行为查处。</div>\r\n<div align=\"left\">\r\n	　　<strong>四、强化高校的主体责任。</strong>高校主要领导是本校学风建设和学术不端行为查处的第一责任人，应有专门领导分工负责学风建设。各地教育部门要将学风建设纳入高校领导班子的考核，完善目标责任制，落实问责机制。高校要将学风建设工作常规化，摆在更加突出的位置，建立健全教育宣传，制度建设、不端行为查处等完整的工作体系，实现学风建设机构、学术规范制度和不端行为查处机制三落实、三公开。高校要按年度发布学风建设工作报告。</div>\r\n<div align=\"left\">\r\n	　　<strong>五、建立学术规范教育制度。</strong>坚持把教育作为加强学风和学术道德建设的基础。在师生中加强科学精神教育，注重发挥楷模的教育作用，强调学者的自律意识和自我道德养成。教育部和中国科协共同组织对全国研究生的科学道德和学风建设宣讲教育。教育部科技委组织专家赴各地讲解《科学技术学术规范指南》。各地教育部门要组织实施本地区的宣讲教育。高校要为本专科生开设科学伦理讲座，在研究生中进行学术规范宣讲教育；要把科学道德教育纳入教师岗位培训范畴和职业培训体系，纳入行政管理人员学习范畴。</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('318','1067','1','','','&nbsp;各省、自治区、直辖市教育厅（教委），新疆生产建设兵团教育局，有关部门（单位）教育司（局），部属各高等学校：　　为贯彻党的十七届六中全会&ldquo;深化政风、行风建设，开展道德领域突出问题专项教育和治理&rdquo;的精神，落实《国家中长期教育改革和发展规划','14.19.97.238','14.19.97.238','1415764673','<h3>\r\n	&nbsp;</h3>\r\n<div align=\"left\">\r\n	各省、自治区、直辖市教育厅（教委），新疆生产建设兵团教育局，有关部门（单位）教育司（局），部属各高等学校：</div>\r\n<div align=\"left\">\r\n	　　为贯彻党的十七届六中全会&ldquo;深化政风、行风建设，开展道德领域突出问题专项教育和治理&rdquo;的精神，落实《国家中长期教育改革和发展规划纲要（2010-2020年）》的要求，坚决反对不良学风，有效遏制学术不端行为，营造风清气正的育人环境和求真务实的学术氛围，教育部决定在&ldquo;十二五&rdquo;期间开展高校学风建设专项教育和治理行动，并提出如下实施意见。</div>\r\n<div align=\"left\">\r\n	　　<strong>一、充分认识高校学风建设的重要性和紧迫性。</strong>学风是大学精神的集中体现，是教书育人的本质要求，是高等学校的立校之本、发展之魂。优良学风是提高教育教学质量的根本保证。能否营造一个优良学风环境，关系到高等教育的科学发展和教育事业的兴衰成败。当前，高校的学风总体上是好的。但近一个时期来，在高校教师及学生的教学与科研活动中，急功近利、浮躁浮夸、抄袭剽窃、伪造篡改、买卖论文、考试舞弊等不良现象和不端行为时有发生，严重破坏了教书育人的学术风气，也造成了极其负面的社会影响。切实加强和改进高校学风建设工作已经刻不容缓。</div>\r\n<div align=\"left\">\r\n	　　<strong>二、坚持标本兼治综合治理的原则。</strong>加强高校学风建设，要坚持教育和治理相结合，坚持教育引导、制度规范、监督约束、查处警示，建立并完善弘扬优良学风的长效机制。通过专项教育治理行动，迅速建立学风建设工作体系，明确各地、各部门和高校的责任义务，力争&ldquo;十二五&rdquo;期间高校学风和科研诚信整体状况得到明显改观，为保证人才培养质量、提升科学研究水平、增强社会服务能力奠定良好的学风基础。</div>\r\n<div align=\"left\">\r\n	　　<strong>三、构建学风建设工作体系。</strong>教育部设立学风建设办公室，负责制定高校学风建设相关政策，指导检查高校学风建设工作，接受对学术不端行为的举报，指导协调和督促调查处理。各地、各部门要健全学风建设机构，负责所属高校学风建设工作。各高校要建立相应的工作机构和工作机制，负责本校学风建设工作和学术不端行为查处。</div>\r\n<div align=\"left\">\r\n	　　<strong>四、强化高校的主体责任。</strong>高校主要领导是本校学风建设和学术不端行为查处的第一责任人，应有专门领导分工负责学风建设。各地教育部门要将学风建设纳入高校领导班子的考核，完善目标责任制，落实问责机制。高校要将学风建设工作常规化，摆在更加突出的位置，建立健全教育宣传，制度建设、不端行为查处等完整的工作体系，实现学风建设机构、学术规范制度和不端行为查处机制三落实、三公开。高校要按年度发布学风建设工作报告。</div>\r\n<div align=\"left\">\r\n	　　<strong>五、建立学术规范教育制度。</strong>坚持把教育作为加强学风和学术道德建设的基础。在师生中加强科学精神教育，注重发挥楷模的教育作用，强调学者的自律意识和自我道德养成。教育部和中国科协共同组织对全国研究生的科学道德和学风建设宣讲教育。教育部科技委组织专家赴各地讲解《科学技术学术规范指南》。各地教育部门要组织实施本地区的宣讲教育。高校要为本专科生开设科学伦理讲座，在研究生中进行学术规范宣讲教育；要把科学道德教育纳入教师岗位培训范畴和职业培训体系，纳入行政管理人员学习范畴。</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('319','1068','1','','','&nbsp;各省、自治区、直辖市教育厅（教委），新疆生产建设兵团教育局，有关部门（单位）教育司（局），部属各高等学校：　　为贯彻党的十七届六中全会&ldquo;深化政风、行风建设，开展道德领域突出问题专项教育和治理&rdquo;的精神，落实《国家中长期教育改革和发展规划','14.19.97.238','14.19.97.238','1415764749','<h3>\r\n	&nbsp;</h3>\r\n<div align=\"left\">\r\n	各省、自治区、直辖市教育厅（教委），新疆生产建设兵团教育局，有关部门（单位）教育司（局），部属各高等学校：</div>\r\n<div align=\"left\">\r\n	　　为贯彻党的十七届六中全会&ldquo;深化政风、行风建设，开展道德领域突出问题专项教育和治理&rdquo;的精神，落实《国家中长期教育改革和发展规划纲要（2010-2020年）》的要求，坚决反对不良学风，有效遏制学术不端行为，营造风清气正的育人环境和求真务实的学术氛围，教育部决定在&ldquo;十二五&rdquo;期间开展高校学风建设专项教育和治理行动，并提出如下实施意见。</div>\r\n<div align=\"left\">\r\n	　　<strong>一、充分认识高校学风建设的重要性和紧迫性。</strong>学风是大学精神的集中体现，是教书育人的本质要求，是高等学校的立校之本、发展之魂。优良学风是提高教育教学质量的根本保证。能否营造一个优良学风环境，关系到高等教育的科学发展和教育事业的兴衰成败。当前，高校的学风总体上是好的。但近一个时期来，在高校教师及学生的教学与科研活动中，急功近利、浮躁浮夸、抄袭剽窃、伪造篡改、买卖论文、考试舞弊等不良现象和不端行为时有发生，严重破坏了教书育人的学术风气，也造成了极其负面的社会影响。切实加强和改进高校学风建设工作已经刻不容缓。</div>\r\n<div align=\"left\">\r\n	　　<strong>二、坚持标本兼治综合治理的原则。</strong>加强高校学风建设，要坚持教育和治理相结合，坚持教育引导、制度规范、监督约束、查处警示，建立并完善弘扬优良学风的长效机制。通过专项教育治理行动，迅速建立学风建设工作体系，明确各地、各部门和高校的责任义务，力争&ldquo;十二五&rdquo;期间高校学风和科研诚信整体状况得到明显改观，为保证人才培养质量、提升科学研究水平、增强社会服务能力奠定良好的学风基础。</div>\r\n<div align=\"left\">\r\n	　　<strong>三、构建学风建设工作体系。</strong>教育部设立学风建设办公室，负责制定高校学风建设相关政策，指导检查高校学风建设工作，接受对学术不端行为的举报，指导协调和督促调查处理。各地、各部门要健全学风建设机构，负责所属高校学风建设工作。各高校要建立相应的工作机构和工作机制，负责本校学风建设工作和学术不端行为查处。</div>\r\n<div align=\"left\">\r\n	　　<strong>四、强化高校的主体责任。</strong>高校主要领导是本校学风建设和学术不端行为查处的第一责任人，应有专门领导分工负责学风建设。各地教育部门要将学风建设纳入高校领导班子的考核，完善目标责任制，落实问责机制。高校要将学风建设工作常规化，摆在更加突出的位置，建立健全教育宣传，制度建设、不端行为查处等完整的工作体系，实现学风建设机构、学术规范制度和不端行为查处机制三落实、三公开。高校要按年度发布学风建设工作报告。</div>\r\n<div align=\"left\">\r\n	　　<strong>五、建立学术规范教育制度。</strong>坚持把教育作为加强学风和学术道德建设的基础。在师生中加强科学精神教育，注重发挥楷模的教育作用，强调学者的自律意识和自我道德养成。教育部和中国科协共同组织对全国研究生的科学道德和学风建设宣讲教育。教育部科技委组织专家赴各地讲解《科学技术学术规范指南》。各地教育部门要组织实施本地区的宣讲教育。高校要为本专科生开设科学伦理讲座，在研究生中进行学术规范宣讲教育；要把科学道德教育纳入教师岗位培训范畴和职业培训体系，纳入行政管理人员学习范畴。</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('325','1078','1','','','历经35年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼&ldquo;两个一百年&rdquo;目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的','112.124.52.149','112.124.52.149','1431835066','<p align=\"left\" style=\"line-height:22.5pt;text-indent:24pt;margin:7.5pt 0cm;\">\r\n	<span style=\"font-size:16pt;\"><span style=\"color:#26214a;\"><span style=\"font-family:仿宋_gb2312;\">历经35</span>年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼&ldquo;两个一百年&rdquo;目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的历史起点上改革&ldquo;集结号&rdquo;。</span></span></p>\r\n<p align=\"left\" style=\"line-height:22.5pt;text-indent:24pt;margin:7.5pt 0cm;\">\r\n	<span style=\"font-size:16pt;\"><span style=\"color:#26214a;\"><span style=\"font-family:仿宋_gb2312;\">历史是最好的教科书，深刻揭示出一个国家、一个民族的进步发展之道。35</span>年来，从国民经济的快速增长，到人民生活水平的显著改善，从经济体制的深刻变革，到国家和人民面貌的深刻变化，莫不靠的是改革开放。今天，破解发展中面临的难题、化解来自各方面的风险挑战、推动经济社会持续健康发展，除了深化改革开放，别无他途。全面深化改革，关系党和人民事业前途命运，关系党的执政基础和执政地位，在整个社会主义现代化进程中，改革开放的旗帜，绝不能有丝毫动摇。</span></span></p>\r\n<p align=\"left\" style=\"line-height:22.5pt;text-indent:24pt;margin:7.5pt 0cm;\">\r\n	<span style=\"font-size:16pt;\"><span style=\"color:#26214a;\"><span style=\"font-family:仿宋_gb2312;\">这次三中全会制定全面深化改革的总体方案，提出了全面深化改革的指导思想、总体思路、目标任务，为的就是高举改革开放旗帜、不断推进中国特色社会主义制度自我完善和发展，为实现亿万人民的中国梦释放强大动力。这是指导新形势下全面深化改革的纲领性文件。当前和今后一个时期，全党全国的一项重要政治任务，就是要以强烈的进取意识、机遇意识、责任意识，深刻领会全会精神并转化成改造现实世界的强大力量。</span></span></span></p>\r\n<p align=\"left\" style=\"line-height:22.5pt;text-indent:24pt;margin:7.5pt 0cm;\">\r\n	<span style=\"font-size:16pt;\"><span style=\"color:#26214a;\"><span style=\"font-family:仿宋_gb2312;\">在35</span>年的改革历程中，我们谱写的中华民族自强不息、顽强奋进的壮丽史诗，靠的是一往无前的进取精神。今天，改革面临的矛盾越多、难度越大，越要坚定与时俱进、攻坚克难信心，越要有进取意识、进取精神、进取毅力，越要有&ldquo;明知山有虎，偏向虎山行&rdquo;的勇气。纵观世界，变革是大势所趋、人心所向。领导改革开放这一前无古人、世所罕见的伟大事业，最要不得的是思想僵化、固步自封。&ldquo;逆水行舟用力撑，一篙松劲退千寻&rdquo;。以习近平同志为总书记的党中央，作出了全面深化改革的战略部署，牢固树立进取意识，全面审视当今世界和当代中国发展大势，全面把握我国发展新要求和人民群众新期待，更加奋发有为地开拓进取，我们就一定能够坚定不移把改革开放引向深入。</span></span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('326','1079','1','','<!--#p8_attach#-->/cms/item/2015_05/23_08/def29b9c7dd0d591.jpg','市发展改革委对部分市属高校三年规划建设项目开展专项稽察。为了加强对我市重点建设项目稽察监管，市发展改革委近日对北方工业大学、首都师范大学和北京第二外国语学院3所院校的6个建设项目开展了专项稽察，重点对项目进度情况、资金到位及使用情况；履行基本建设程序、','112.124.52.149','113.96.85.241','1431792000','市发展改革委对部分市属高校三年规划建设项目开展专项稽察。为了加强对我市重点建设项目稽察监管，市发展改革委近日对北方工业大学、首都师范大学和北京第二外国语学院3所院校的6个建设项目开展了专项稽察，重点对项目进度情况、资金到位及使用情况；履行基本建设程序、&ldquo;四制&rdquo;执行、概算执行、质量管理以及财务管理等情况进行了检查。稽察情况显示，这6个项目建设管理总体比较规范，基本建设程序履行比较完整，合同制、监理制落实较好，招投标过程比较规范，资金使用基本合规，未发现严重资金违规问题，实际建设内容与规模与批复基本一致，项目建设进度较快。针对稽察中发现的一些问题，市发展改革委将督促建设单位加强整改。');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('327','1080','1','','<!--#p8_attach#-->/cms/item/2015_05/23_08/2491223fbece3b6d.jpg','“新型城镇化”现已成为一个全民议题。如何走新型城镇化道路，需要全社会尤其是“规划师”的探索与创新。作为担当城乡规划重任的“青年规划师”的思考及探索，将为中国新型城镇化实践提供新的思路。　　17日，以“新型城镇化与城乡规','112.124.52.149','113.96.85.241','1431792000','<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">&ldquo;新型城镇化&rdquo;现已成为一个全民议题。如何走新型城镇化道路，需要全社会尤其是&ldquo;规划师&rdquo;的探索与创新。作为担当城乡规划重任的&ldquo;青年规划师&rdquo;的思考及探索，将为中国新型城镇化实践提供新的思路。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　17日，以&ldquo;新型城镇化与城乡规划编制创新&rdquo;为主题的&ldquo;第三届金经昌中国青年规划师创新论坛&rdquo;在上海举行。近期，北京启动总体规划调整和修改，上海启动新一轮城市总体规划编制，在此背景下，本次论坛聚焦&ldquo;大都市地区总体规划编制创新&rdquo;这一热点，展开研讨。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　自2007年开始，全世界一半以上的人口生活在城市，世界正式进入了&ldquo;城市纪元&rdquo;，城市成为了全球人关注的重点；而预计到2040年，全球将有64.7%的人生活在城市中。城市已经成为最不了不起的成就。但城市发展中又面临种种问题。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　中国城市规划设计研究院总规划师张兵在论坛上作了题为《场所&middot;结构&middot;治理&mdash;大都市地区空间发展与总体规划》的报告。他说，大都市地区新一轮总体规划编制工作出现了一些新特点，包括开展前期评估、公众参与、以人为本、从重规模转向重结构、强调生态文明建设和文化传承等，这反映了规划工作者在改进规划方面所作的努力，但这些改进还无法真正解决大都市区历史性转变中面临着的现实需要。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　张兵强调，应该通过出行等人的行为来认识都市区内部发育状况，为规划重点问题解决提供认识基础，在此基础上，他指出大都市区总规改进的三个方向：结构塑形、设施引领场所再组织和改革空间治理体系。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　当前，生态与可持续发展已成为城市发展的目标，上海也在这方面紧随世界的步伐。上海提出以节能减排先进城市系统为其建设的基本目标。同时在具体区域，如建设崇明生态岛、真如城市副中心、崇明陈桥镇生态城镇、长风商务区等，以此在城市开发中注重生态发展。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　上海市规划与国土资源局副局长徐毅松介绍了刚刚启动的上海新一轮总体规划编制工作思路，生态环境颇为引人关注。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　值得关注的是，尽管从上世纪90年代起，全世界都热衷将生态作为一种标签，但往往流于表面形式，世界各地也依次出现了一些不同类型的生态城市试验，例如荷兰的太阳城、斯德哥尔摩哈马尔比滨水城、上海的崇明东滩生态城等。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　城市规划到底走向何方？可能如中科院院士、同济大学郑时龄教授当天在当天举行的上海科普大讲坛上所言，&ldquo;我们按照自己的文化和理想建设我们的城市，理想、想象和幻想越是丰富，我们的城市也就越理想&rdquo;。</span>');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('328','1077','1','','','市发展改革委对部分市属高校三年规划建设项目开展专项稽察。为了加强对我市重点建设项目稽察监管，市发展改革委近日对北方工业大学、首都师范大学和北京第二外国语学院3所院校的6个建设项目开展了专项稽察，重点对项目进度情况、资金到位及使用情况；履行基本建设程序、','112.124.52.149','112.124.52.149','1431834918','市发展改革委对部分市属高校三年规划建设项目开展专项稽察。为了加强对我市重点建设项目稽察监管，市发展改革委近日对北方工业大学、首都师范大学和北京第二外国语学院3所院校的6个建设项目开展了专项稽察，重点对项目进度情况、资金到位及使用情况；履行基本建设程序、&ldquo;四制&rdquo;执行、概算执行、质量管理以及财务管理等情况进行了检查。稽察情况显示，这6个项目建设管理总体比较规范，基本建设程序履行比较完整，合同制、监理制落实较好，招投标过程比较规范，资金使用基本合规，未发现严重资金违规问题，实际建设内容与规模与批复基本一致，项目建设进度较快。针对稽察中发现的一些问题，市发展改革委将督促建设单位加强整改。');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('332','1085','1','','<!--#p8_attach#-->/cms/item/2015_05/23_08/9a720b9fd38c67fb.jpg','7月3日上午，土木工程学院红十字分会暑期社会实践团的团员们向来自钱塘博文小学的留守儿童宣传防水、防火的相关知识，也向小朋友们及其家长们讲解了一些常用药品的正确使用方法，纠正日常生活中常见的药品错误使用方法。此外，团员们还在现场向小朋友展示几种应急的包扎','113.96.84.24','222.240.162.130','1433865600','<p style=\"TEXT-ALIGN: left; LINE-HEIGHT: 26pt; TEXT-INDENT: 24pt\"><span style=\"FONT-SIZE: 12pt\"><span style=\"FONT-FAMILY: 宋体\">7</span></span><span style=\"FONT-SIZE: 12pt\"><span style=\"FONT-FAMILY: 宋体\">月3</span>日</span><span style=\"FONT-SIZE: 12pt\"><span style=\"FONT-FAMILY: 宋体\">上午，土木工程学院红十字分会暑期社会实践团的团员们向来自钱塘博文小学的留守儿童宣传防水、防火的相关知识，也向小朋友们及其家长们讲解了一些常用药品的正确使用方法，纠正日常生活中常见的药品错误使用方法。此外，团员们还在现场向小朋友展示几种应急的包扎方式，并让小朋友们动手实践，小朋友们受益颇多。上午的活动极大地提升了小朋友们的安全意识和自救能力。</span></span></p><p style=\"TEXT-ALIGN: left; LINE-HEIGHT: 26pt; TEXT-INDENT: 24pt\"><span style=\"FONT-SIZE: 12pt\"><span style=\"FONT-FAMILY: 宋体\"></span></span>&nbsp;</p><p style=\"TEXT-ALIGN: left; LINE-HEIGHT: 26pt; TEXT-INDENT: 24pt\"><span style=\"FONT-SIZE: 12pt\"><span style=\"FONT-FAMILY: 宋体\"></span></span>&nbsp;</p><p style=\"TEXT-ALIGN: left; LINE-HEIGHT: 26pt; TEXT-INDENT: 24pt\"><span style=\"FONT-SIZE: 12pt\"><span style=\"FONT-FAMILY: 宋体\"><img title=\"1442676782968215.jpg\" alt=\"QQ截图20150919233245.jpg\" src=\"/yanshi/jyj/attachment/ueditor/image/20150919/1442676782968215.jpg\" /></span></span></p><p style=\"TEXT-ALIGN: left; LINE-HEIGHT: 26pt; TEXT-INDENT: 24pt\"><span style=\"FONT-SIZE: 12pt\"><span style=\"FONT-FAMILY: 宋体\">7</span></span><span style=\"FONT-SIZE: 12pt\"><span style=\"FONT-FAMILY: 宋体\">月3</span>号下午，团员们为小朋友们设计了几个简单却蕴意深刻的游戏。团员们和小朋友们一起参与到游戏中去，以游戏的方式来拉近团员们和小朋友之间的距离，让他们感受到快乐，感受到来自社会的关怀。</span></p><p style=\"TEXT-ALIGN: left; LINE-HEIGHT: 26pt; TEXT-INDENT: 24pt\"><span style=\"FONT-SIZE: 12pt\"><span style=\"FONT-FAMILY: 宋体\">7</span></span><span style=\"FONT-SIZE: 12pt\"><span style=\"FONT-FAMILY: 宋体\">月4</span>日</span><span style=\"FONT-SIZE: 12pt\"><span style=\"FONT-FAMILY: 宋体\">上午，团员们为留守儿童举行了爱心红书袋的捐赠仪式。著名书法家石鸣老师出席了此次仪式，并将他亲笔所写的字赠予在场的小朋友。在下午的活动中，小朋友们收到了来自社会人员的礼物，让他们更为深切的感受到了社会各界人士对他们的关怀。至此，此次暑期社会实践活动圆满落下帷幕。</span></span></p><p style=\"TEXT-ALIGN: left; LINE-HEIGHT: 26pt; TEXT-INDENT: 24pt\"><span style=\"FONT-SIZE: 12pt\"><span style=\"FONT-FAMILY: 宋体\">经过此次暑期社会实践活动，团员们不仅弘扬了红十字会的博爱人道精神，还让钱塘文博小学的孩子们学会了如何防灾自救。这为构建和谐社会、实现中国梦奠定了基础，也是团员们作为当代大学生服务社会，回报国家的良好举措。团员们在学习之余投身社会实践，将理论与实际相结合，在服务他人的同时也提高了自身的综合素养。</span></span></p>');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('339','1076','1','','','历经35年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼&ldquo;两个一百年&rdquo;目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的','112.124.52.149','112.124.52.149','1431834918','<p align=\"left\" style=\"line-height:22.5pt;text-indent:24pt;margin:7.5pt 0cm;\">\r\n	<span style=\"font-size:16pt;\"><span style=\"color:#26214a;\"><span style=\"font-family:仿宋_gb2312;\">历经35</span>年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼&ldquo;两个一百年&rdquo;目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的历史起点上改革&ldquo;集结号&rdquo;。</span></span></p>\r\n<p align=\"left\" style=\"line-height:22.5pt;text-indent:24pt;margin:7.5pt 0cm;\">\r\n	<span style=\"font-size:16pt;\"><span style=\"color:#26214a;\"><span style=\"font-family:仿宋_gb2312;\">历史是最好的教科书，深刻揭示出一个国家、一个民族的进步发展之道。35</span>年来，从国民经济的快速增长，到人民生活水平的显著改善，从经济体制的深刻变革，到国家和人民面貌的深刻变化，莫不靠的是改革开放。今天，破解发展中面临的难题、化解来自各方面的风险挑战、推动经济社会持续健康发展，除了深化改革开放，别无他途。全面深化改革，关系党和人民事业前途命运，关系党的执政基础和执政地位，在整个社会主义现代化进程中，改革开放的旗帜，绝不能有丝毫动摇。</span></span></p>\r\n<p align=\"left\" style=\"line-height:22.5pt;text-indent:24pt;margin:7.5pt 0cm;\">\r\n	<span style=\"font-size:16pt;\"><span style=\"color:#26214a;\"><span style=\"font-family:仿宋_gb2312;\">这次三中全会制定全面深化改革的总体方案，提出了全面深化改革的指导思想、总体思路、目标任务，为的就是高举改革开放旗帜、不断推进中国特色社会主义制度自我完善和发展，为实现亿万人民的中国梦释放强大动力。这是指导新形势下全面深化改革的纲领性文件。当前和今后一个时期，全党全国的一项重要政治任务，就是要以强烈的进取意识、机遇意识、责任意识，深刻领会全会精神并转化成改造现实世界的强大力量。</span></span></span></p>\r\n<p align=\"left\" style=\"line-height:22.5pt;text-indent:24pt;margin:7.5pt 0cm;\">\r\n	<span style=\"font-size:16pt;\"><span style=\"color:#26214a;\"><span style=\"font-family:仿宋_gb2312;\">在35</span>年的改革历程中，我们谱写的中华民族自强不息、顽强奋进的壮丽史诗，靠的是一往无前的进取精神。今天，改革面临的矛盾越多、难度越大，越要坚定与时俱进、攻坚克难信心，越要有进取意识、进取精神、进取毅力，越要有&ldquo;明知山有虎，偏向虎山行&rdquo;的勇气。纵观世界，变革是大势所趋、人心所向。领导改革开放这一前无古人、世所罕见的伟大事业，最要不得的是思想僵化、固步自封。&ldquo;逆水行舟用力撑，一篙松劲退千寻&rdquo;。以习近平同志为总书记的党中央，作出了全面深化改革的战略部署，牢固树立进取意识，全面审视当今世界和当代中国发展大势，全面把握我国发展新要求和人民群众新期待，更加奋发有为地开拓进取，我们就一定能够坚定不移把改革开放引向深入。</span></span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('350','1108','1','','<!--#p8_attach#-->/cms/item/2015_05/23_08/def29b9c7dd0d591.jpg','市发展改革委对部分市属高校三年规划建设项目开展专项稽察。为了加强对我市重点建设项目稽察监管，市发展改革委近日对北方工业大学、首都师范大学和北京第二外国语学院3所院校的6个建设项目开展了专项稽察，重点对项目进度情况、资金到位及使用情况；履行基本建设程序、','36.157.225.191','36.157.225.191','1582086160','市发展改革委对部分市属高校三年规划建设项目开展专项稽察。为了加强对我市重点建设项目稽察监管，市发展改革委近日对北方工业大学、首都师范大学和北京第二外国语学院3所院校的6个建设项目开展了专项稽察，重点对项目进度情况、资金到位及使用情况；履行基本建设程序、&ldquo;四制&rdquo;执行、概算执行、质量管理以及财务管理等情况进行了检查。稽察情况显示，这6个项目建设管理总体比较规范，基本建设程序履行比较完整，合同制、监理制落实较好，招投标过程比较规范，资金使用基本合规，未发现严重资金违规问题，实际建设内容与规模与批复基本一致，项目建设进度较快。针对稽察中发现的一些问题，市发展改革委将督促建设单位加强整改。');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('351','1109','1','','<!--#p8_attach#-->/cms/item/2020_03/05_09/7b3f9fe8d69e5c40.jpg.thumb.jpg','7月3日上午，土木工程学院红十字分会暑期社会实践团的团员们向来自钱塘博文小学的留守儿童宣传防水、防火的相关知识，也向小朋友们及其家长们讲解了一些常用药品的正确使用方法，纠正日常生活中常见的药品错误使用方法。此外，团员们还在现场向小朋友展示几种应急的包扎','36.157.225.191','113.247.55.181','1582086160','<p style=\"text-align: left; line-height: 26pt; text-indent: 24pt\"><span style=\"font-size: 12pt\"><span style=\"font-family: 宋体\">7</span></span><span style=\"font-size: 12pt\"><span style=\"font-family: 宋体\">月3</span>日</span><span style=\"font-size: 12pt\"><span style=\"font-family: 宋体\">上午，土木工程学院红十字分会暑期社会实践团的团员们向来自钱塘博文小学的留守儿童宣传防水、防火的相关知识，也向小朋友们及其家长们讲解了一些常用药品的正确使用方法，纠正日常生活中常见的药品错误使用方法。此外，团员们还在现场向小朋友展示几种应急的包扎方式，并让小朋友们动手实践，小朋友们受益颇多。上午的活动极大地提升了小朋友们的安全意识和自救能力。</span></span></p>\r\n\r\n<p style=\"text-align: left; line-height: 26pt; text-indent: 24pt\"><span style=\"font-size: 12pt\"><span style=\"font-family: 宋体\">7</span></span><span style=\"font-size: 12pt\"><span style=\"font-family: 宋体\">月3</span>号下午，团员们为小朋友们设计了几个简单却蕴意深刻的游戏。团员们和小朋友们一起参与到游戏中去，以游戏的方式来拉近团员们和小朋友之间的距离，让他们感受到快乐，感受到来自社会的关怀。</span></p>\r\n\r\n<p style=\"text-align: left; line-height: 26pt; text-indent: 24pt\"><span style=\"font-size: 12pt\"><span style=\"font-family: 宋体\">7</span></span><span style=\"font-size: 12pt\"><span style=\"font-family: 宋体\">月4</span>日</span><span style=\"font-size: 12pt\"><span style=\"font-family: 宋体\">上午，团员们为留守儿童举行了爱心红书袋的捐赠仪式。著名书法家石鸣老师出席了此次仪式，并将他亲笔所写的字赠予在场的小朋友。在下午的活动中，小朋友们收到了来自社会人员的礼物，让他们更为深切的感受到了社会各界人士对他们的关怀。至此，此次暑期社会实践活动圆满落下帷幕。</span></span></p>\r\n\r\n<p style=\"text-align: left; line-height: 26pt; text-indent: 24pt\"><span style=\"font-size: 12pt\"><span style=\"font-family: 宋体\">经过此次暑期社会实践活动，团员们不仅弘扬了红十字会的博爱人道精神，还让钱塘文博小学的孩子们学会了如何防灾自救。这为构建和谐社会、实现中国梦奠定了基础，也是团员们作为当代大学生服务社会，回报国家的良好举措。团员们在学习之余投身社会实践，将理论与实际相结合，在服务他人的同时也提高了自身的综合素养。</span></span></p>\r\n');
REPLACE INTO `p8_cms_item_attribute` VALUES ('9','6','6','1291793364','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('8','6','6','1291793416','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('7','6','6','1291878306','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('3','5','17','1291882516','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('6','5','6','1291976688','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('42','5','6','1291883583','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('6','6','6','1291976688','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('76','6','6','1308725891','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1080','6','44','1432341331','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('285','6','53','1431236286','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1029','2','44','1398590182','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('287','7','137','1420552016','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('76','5','6','1308725891','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('285','3','53','1431236286','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('284','6','53','1409565048','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('283','6','53','1346507832','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('208','5','34','1342837471','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('282','6','53','1408537248','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('240','6','34','1345651930','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('242','6','34','1345652038','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('244','6','34','1345652188','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('246','6','87','1420550909','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('247','6','87','1420550879','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1021','5','44','1393229979','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('239','2','128','1431221131','刘丰');
REPLACE INTO `p8_cms_item_attribute` VALUES ('281','6','53','1346507685','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1017','6','44','1409564906','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1017','1','44','1409564906','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1017','7','44','1409565891','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('287','6','137','1420552016','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1058','6','44','1511764726','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1058','1','44','1511764726','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1064','6','44','1432341362','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1061','6','44','1432341396','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1079','6','128','1432341455','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1055','6','779','1511778413','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1085','6','128','1442676786','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1085','2','128','1450407361','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1085','1','128','1442676786','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1103','6','141','1582019838','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1104','6','141','1582019838','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1105','6','141','1582019838','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1106','6','141','1582019838','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1107','6','141','1582019838','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1108','6','774','1582086172','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1109','6','774','1583371344','adminroot');
REPLACE INTO `p8_cms_item_digg` VALUES ('1','1085','1','0');
REPLACE INTO `p8_cms_item_down_` VALUES ('1052','down','144','1','admin','学校通讯录联系表','','0','','','','','','23423432','','','','','','1','admin','0','1408849436','1408849436','1408849436','1408849436','1','','','67','0','0','','','','');
REPLACE INTO `p8_cms_item_down_addon` VALUES ('12','1052','1','','','23423432','121.8.7.164','121.8.7.164','1408849436','23423432','300','IMG_20130630_0002.jpg<!--#p8_attach#-->/cms/item/2013_12/08_14/edd83c0579cec54f.jpg','34');
REPLACE INTO `p8_cms_item_government_affairs_` VALUES ('1098','government_affairs','1273','1','admin','职业病危害控制效果评价与防护设施竣工验收','','0','','','','','职业病危害控制效果评价与防护设施竣工验收职业病危害控制效果评价与防护设施竣工验收职业病危害控制效果评价与防护设施竣工验收','','','','1','admin','0','1460505406','1460505406','1460505406','1','','','8','0','','','','','1460505406','11','11','0','','','','');
REPLACE INTO `p8_cms_item_government_affairs_` VALUES ('1106','government_affairs','1273','1','admin','我国可耕地为1.2亿多公顷 耕地保护形势仍严峻','','0','','','','','国务院新闻办公室今日上午举行新闻发布会，请国土资源部副部长、国务院第二次全国土地调查领导小组办公室主任王世元，国务院第二次全国土地调查领导小组办公室常务副主任高延利，国家统计局副局长张为民介绍第二次全国土地调查主要数据成果，并答记者问。　　王世元: 全','','','','1','','0','1460563200','1460563200','1460599218','1','','','2','0','','','','','1460599117','23427890','国土局','1','20150901105053102169.jpg<!--#p8_attach#-->/cms/item/2016_04/14_10/2a6a16f2cc6eada0.jpg','保护耕地<!--#p8_attach#-->/cms/item/2016_04/14_09/1011565a74aedf2c.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2016_04/14_09/1011565a74aedf2c.jpg.thumb.jpg','线上审批','http://');
REPLACE INTO `p8_cms_item_government_affairs_` VALUES ('1107','government_affairs','1273','1','admin','习近平就做好耕地保护作出重要指示','','0','','','','','中共中央总书记、国家主席、中央军委主席习近平近日对耕地保护工作作出重要指示。他强调，耕地是我国最为宝贵的资源。我国人多地少的基本国情，决定了我们必须把关系十几亿人吃饭大事的耕地保护好，绝不能有闪失。要实行最严格的耕地保护制度，依法依规做好耕地占补平衡','','','','1','admin','0','1460599756','1460599756','1460599756','1','','','5','0','','','','','1460599756','2345','国土局','1','20150901105053102169.jpg<!--#p8_attach#-->/cms/item/2016_04/14_10/ebf5c3d208860292.jpg','耕地保护<!--#p8_attach#-->/cms/item/2016_04/14_10/ec241b1becf2064b.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2016_04/14_10/ec241b1becf2064b.jpg.thumb.jpg','线上审批','http://');
REPLACE INTO `p8_cms_item_government_affairs_` VALUES ('1108','government_affairs','1273','1','admin','加大耕地保护力度','','0','','','','','8日下午，全国政协十二届三次会议在政协礼堂举办了提案办理协商会，主题为&amp;amp;ldquo;加大耕地保护工作力度，为人民提供优质安全的农产品&amp;amp;rdquo;，各民主党派中央和全国工商联代表、提案者代表、提案委员会成员、相关承办部门代表等参加了会议。　　会上，提案者代表分析了我','','','','1','admin','0','1460599982','1460599982','1460599982','1','','','3','0','','','','','1460599982','765434342','国土局','1','20150901105053102169.jpg<!--#p8_attach#-->/cms/item/2016_04/14_10/0327ecc9a0fe07cf.jpg','耕地保护<!--#p8_attach#-->/cms/item/2016_04/14_10/dbe2ce4efd8d254d.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2016_04/14_10/dbe2ce4efd8d254d.jpg.thumb.jpg','线上审批','http://');
REPLACE INTO `p8_cms_item_government_affairs_` VALUES ('1109','government_affairs','1273','1','admin','我县多举措落实最严格的耕地保护制度','','0','','','','','习近平总书记近日就耕地保护和农村土地流转工作作出重要指示，强调要实行最严格的耕地保护制度，依法依规做好耕地占补平衡，规范有序推进农村土地流转，像保护大熊猫一样保护耕地。　　耕地保护是土地管理的核心，多年来，我县把保护耕地作为土地管理的首要任务，积极探','','','','1','admin','0','1460600170','1460600170','1460600170','1','','','2','0','','','','','1460600170','67543','国土局','1','20150901105053102169.jpg<!--#p8_attach#-->/cms/item/2016_04/14_10/32f1a8a0019517d3.jpg','耕地保护<!--#p8_attach#-->/cms/item/2016_04/14_10/11440b5d7d6516aa.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2016_04/14_10/11440b5d7d6516aa.jpg.thumb.jpg','线上审批','http://');
REPLACE INTO `p8_cms_item_government_affairs_` VALUES ('1115','government_affairs','1274','1','admin','2017年中国将基本完成地质环境管理信息化','','0','','<!--#p8_attach#-->/cms/item/2016_04/14_10/0b6c7e344a68b9d0.jpg','','6','中国将分&amp;amp;ldquo;三步走&amp;amp;rdquo;建立涵盖地质灾害防治、地质环境监测及保护的信息化的全国体系，2017年基本完成中国地质环境管理信息化。　　国土部近日印发《全国地质环境信息化建设方案》(以下简称《方案》)，详细部署2013年至2017年的国家地质环境信息化建设工作。　　','','','','1','admin','0','1460602834','1460602834','1460602834','1','','','2','0','','','','','1460602834','56789o','地质局','1','20150901105053102169.jpg<!--#p8_attach#-->/cms/item/2016_04/14_10/a01af3a49db6e5ee.jpg','地质环境<!--#p8_attach#-->/cms/item/2016_04/14_10/a6e9a37f06512757.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2016_04/14_10/a6e9a37f06512757.jpg.thumb.jpg','线上+线下','http://');
REPLACE INTO `p8_cms_item_government_affairs_` VALUES ('1116','government_affairs','1274','1','admin','加强“五水共治”中 地质环境研究','','0','','<!--#p8_attach#-->/cms/item/2016_04/14_11/dcd6f0af1ce820eb.jpg','','6','参加省政协十一届三次会议的省政协委员、省水文地质工程地质大队总工程师叶兴永提交提案，建议加强&amp;amp;ldquo;五水共治&amp;amp;rdquo;过程中地质环境研究工作。　　叶兴永委员在提案中指出，&amp;amp;ldquo;五水共治&amp;amp;rdquo;与地质环境密切相关，因为地质环境是地球岩石圈表层对人类有影响的','','','','1','admin','0','1460602955','1460602955','1460602955','1','','','1','0','','','','','1460602955','987654','地质局','1','20150901105053102169.jpg<!--#p8_attach#-->/cms/item/2016_04/14_11/bf56a1a5ff205ce1.jpg','地主环境<!--#p8_attach#-->/cms/item/2016_04/14_11/89df06dc62ab4739.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2016_04/14_11/89df06dc62ab4739.jpg.thumb.jpg','线上+线下','http://');
REPLACE INTO `p8_cms_item_government_affairs_` VALUES ('1117','government_affairs','1274','1','admin','国土资源部：我国地质环境监测迎来发展新机','','0','','<!--#p8_attach#-->/cms/item/2016_04/14_11/47d9fc7265ca6cea.jpg','','6','《地质环境监测管理办法》发布施行、全国地质环境监测规划编制有序开展、国家地下水监测工程付诸实施、全国地质环境信息化建设稳步推进&amp;amp;hellip;&amp;amp;hellip;12月12日，在河北省石家庄市召开的全国地质环境监测工作座谈会上，这些为我国地质环境保护、地下水资源合理开发、地','','','','1','admin','0','1460603053','1460603053','1460603053','1','','','0','0','','','','','1460603053','98765','地质局','1','20150901105053102169.jpg<!--#p8_attach#-->/cms/item/2016_04/14_11/7cad799ee2bf9ea3.jpg','地质环境<!--#p8_attach#-->/cms/item/2016_04/14_11/f4bb545ecabe95b5.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2016_04/14_11/f4bb545ecabe95b5.jpg.thumb.jpg','线上审批','http://');
REPLACE INTO `p8_cms_item_government_affairs_` VALUES ('1118','government_affairs','1274','1','admin','全市地质环境工作会议召开','','0','','<!--#p8_attach#-->/cms/item/2016_04/14_11/6096ee246d640e99.jpg','','6','5月4日，全市地质环境工作会议在市局召开。会议总结回顾了2011年全市地质环境工作，明确了2012年工作任务，重点安排部署了当前地质灾害防治工作。局党组成员、副局长张锡勇出席会议并讲话。局办公室、地质环境科、地质环境监测站以及市地质公园办相关人员，各区、县(分','','','','1','admin','0','1460603160','1460603160','1460603160','1','','','3','0','','','','','1460603160','34577','地质局','1','20150901105053102169.jpg<!--#p8_attach#-->/cms/item/2016_04/14_11/505a171e5c945773.jpg','地质环境<!--#p8_attach#-->/cms/item/2016_04/14_11/4b4ef1877e0ec652.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2016_04/14_11/4b4ef1877e0ec652.jpg.thumb.jpg','线上审批','http://');
REPLACE INTO `p8_cms_item_government_affairs_` VALUES ('1119','government_affairs','1274','1','admin','全国地质环境管理工作会议提出地质环境工作要肩负起新的历史','','0','','<!--#p8_attach#-->/cms/item/2016_04/14_11/8db4fd5befff29e2.jpg','','6','10月31日，全国地质环境管理工作会议在江西省南昌市召开。会议宣读了国土资源部部长、党组书记、国家土地总督察徐绍史对地质环境工作的重要批示。国土资源部党组成员、副部长、中国地质调查局局长汪民发表讲话。江西省常务副省长凌成兴致辞，江西省政协副主席胡幼桃出席','','','','1','admin','0','1460603274','1460603274','1460603274','1','','','215','0','','','','','1460603274','36776867','地质局','1','20150901105053102169.jpg<!--#p8_attach#-->/cms/item/2016_04/14_11/b11e3d233c80b514.jpg','地质环境<!--#p8_attach#-->/cms/item/2016_04/14_11/f3438508f4dd7156.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2016_04/14_11/f3438508f4dd7156.jpg.thumb.jpg','线下审批','http://');
REPLACE INTO `p8_cms_item_government_affairs_addon` VALUES ('35','1098','1','','','职业病危害控制效果评价与防护设施竣工验收职业病危害控制效果评价与防护设施竣工验收职业病危害控制效果评价与防护设施竣工验收','175.13.248.56','175.13.248.56','1460505406','&nbsp;职业病危害控制效果评价与防护设施竣工验收职业病危害控制效果评价与防护设施竣工验收职业病危害控制效果评价与防护设施竣工验收');
REPLACE INTO `p8_cms_item_government_affairs_addon` VALUES ('36','1106','1','','','国务院新闻办公室今日上午举行新闻发布会，请国土资源部副部长、国务院第二次全国土地调查领导小组办公室主任王世元，国务院第二次全国土地调查领导小组办公室常务副主任高延利，国家统计局副局长张为民介绍第二次全国土地调查主要数据成果，并答记者问。　　王世元: 全','175.13.255.10','175.13.255.10','1460563200','<p style=\"font: 14px/28px \"Times New Roman\"; margin: 1em 0px; padding: 0px; border: 0px currentColor; border-image: none; color: rgb(51, 51, 51); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; widows: 1; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 国务院新闻办公室今日上午举行新闻发布会，请国土资源部副部长、国务院第二次全国土地调查领导小组办公室主任王世元，国务院第二次全国土地调查领导小组办公室常务副主任高延利，国家统计局副局长张为民介绍第二次全国土地调查主要数据成果，并答记者问。</p>\r\n\r\n<p style=\"font: 14px/28px \"Times New Roman\"; margin: 1em 0px; padding: 0px; border: 0px currentColor; border-image: none; color: rgb(51, 51, 51); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; widows: 1; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;\">　　王世元: 全国土地调查是重大的国情国力调查。自1996年完成第一次全国土地调查十年间，土地利用状况发生了很大变化，原有的土地调查数据成果难以满足需要。2006年12月，国务院部署开展第二次全国土地调查，并成立了12个部委局组成的领导小组。2007年7月，国务院召开电视电话会议，全面部署这项工作。历时三年，全面完成了调查任务。</p>\r\n\r\n<p style=\"font: 14px/28px \"Times New Roman\"; margin: 1em 0px; padding: 0px; border: 0px currentColor; border-image: none; color: rgb(51, 51, 51); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; widows: 1; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;\">　<strong style=\"margin: 0px; padding: 0px; text-indent: 0px;\">　一、二次调查工作取得了一系列重大成果</strong></p>\r\n\r\n<p style=\"font: 14px/28px \"Times New Roman\"; margin: 1em 0px; padding: 0px; border: 0px currentColor; border-image: none; color: rgb(51, 51, 51); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; widows: 1; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;\">　　二次调查是新中国成立以来首次采用统一的土地利用分类国家标准，首次采用政府统一组织、地方实地调查、国家掌控质量的组织模式，首次采用覆盖全国遥感影像的调查底图，实现了图、数、实地一致，做到了全面、真实、准确。</p>\r\n\r\n<p style=\"font: 14px/28px \"Times New Roman\"; margin: 1em 0px; padding: 0px; border: 0px currentColor; border-image: none; color: rgb(51, 51, 51); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; widows: 1; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;\">　　这次调查全面查清了全国土地利用现状，掌握了各类土地资源底数。截止到2009年12月31日，全国耕地13538.5万公顷，园地1481.2万公顷、林地25395.0万公顷、草地28731.4万公顷，其他主要地类数据请详见《公报》。同时，建成了全国土地利用基础数据库；建立了土地变更调查新机制，实现了常态化土地利用变化监测；构建了国土资源管理&ldquo;一张图&rdquo;和综合监管平台。</p>\r\n\r\n<p style=\"font: 14px/28px \"Times New Roman\"; margin: 1em 0px; padding: 0px; border: 0px currentColor; border-image: none; color: rgb(51, 51, 51); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; widows: 1; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;\"><strong style=\"margin: 0px; padding: 0px; text-indent: 0px;\">　　二、我国土地资源的基本国情没有改变，必须毫不动摇坚持最严格的耕地保护制度和节约用地制度，必须大力推进生态文明建设</strong></p>\r\n\r\n<p style=\"font: 14px/28px \"Times New Roman\"; margin: 1em 0px; padding: 0px; border: 0px currentColor; border-image: none; color: rgb(51, 51, 51); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; widows: 1; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;\">　　第一，全国耕地调查数据虽有所增加，但实有耕地还是那么多，必须继续实行最严格的耕地保护制度。二次调查耕地数据比基于一次调查数据逐年变更到2009年的耕地数据多出1358.7万公顷（即我们常说的2亿亩），主要是由于调查标准、技术方法的改进和农村税费政策调整等因素影响，使调查数据更加全面、客观、准确。</p>\r\n\r\n<p style=\"font: 14px/28px \"Times New Roman\"; margin: 1em 0px; padding: 0px; border: 0px currentColor; border-image: none; color: rgb(51, 51, 51); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; widows: 1; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;\">　　我国的粮棉油及其他农产品就是这些实有耕地生产的。同时，二次调查的相关数据反映，全国有564.9万公顷耕地位于东北、西北地区的林区、草原以及河流湖泊最高洪水位控制线范围内，还有431.4万公顷耕地位于25度以上陡坡，这996.3万公顷（将近1.5亿亩）耕地中，有相当部分需要根据国家退耕还林、还草、还湿和耕地休养生息等安排逐步调整；</p>\r\n\r\n<p style=\"font: 14px/28px \"Times New Roman\"; margin: 1em 0px; padding: 0px; border: 0px currentColor; border-image: none; color: rgb(51, 51, 51); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; widows: 1; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;\">　　有相当数量耕地受到中、重度污染，大多不宜耕种；还有一定数量的耕地因开矿塌陷造成地表土层破坏、因地下水超采，已影响正常耕种。这样算下来，适宜稳定利用的耕地也就是1.2亿多公顷。</p>\r\n\r\n<p style=\"font: 14px/28px \"Times New Roman\"; margin: 1em 0px; padding: 0px; border: 0px currentColor; border-image: none; color: rgb(51, 51, 51); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; widows: 1; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;\">　　综上所述，我国人均耕地少、耕地质量总体不高、耕地后备资源不足的基本国情没有改变，综合考虑现有耕地数量、质量和人口增长、发展用地需求等因素，耕地保护形势仍十分严峻。因此，必须始终坚持&ldquo;十分珍惜、合理利用土地和切实保护耕地&rdquo;的基本国策，毫不动摇坚持最严格的耕地保护制度，坚决守住耕地保护红线和粮食安全底线，确保我国实有耕地数量基本稳定。</p>\r\n\r\n<p style=\"font: 14px/28px \"Times New Roman\"; margin: 1em 0px; padding: 0px; border: 0px currentColor; border-image: none; color: rgb(51, 51, 51); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; widows: 1; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;\">　　第二，建设用地增加虽与经济社会发展要求相适应，但土地利用比较粗放，必须继续坚持和完善最严格的节约用地制度。二次调查数据显示，与一次调查相比，建设用地从2918.0万公顷增加到3500.0万公顷，增加了581.9万公顷。国家实施建设用地增量计划投放与鼓励存量盘活并重的调控措施，有力保障了经济社会发展的用地需求。</p>\r\n\r\n<p style=\"font: 14px/28px \"Times New Roman\"; margin: 1em 0px; padding: 0px; border: 0px currentColor; border-image: none; color: rgb(51, 51, 51); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; widows: 1; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;\">　　同时，二次调查数据也反映出，建设用地增速较快，许多地方存在建设用地格局失衡、利用粗放、效率不高等问题，建设用地供需矛盾仍很突出。因此，必须坚定不移继续实行最严格的节约用地制度，控制投放增量土地，加大盘活存量土地，优化土地利用空间布局和结构，提高土地利用效率。</p>\r\n\r\n<p style=\"font: 14px/28px \"Times New Roman\"; margin: 1em 0px; padding: 0px; border: 0px currentColor; border-image: none; color: rgb(51, 51, 51); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; widows: 1; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;\">　　第三，生态用地数据变化明显，生态承载问题日益突出，必须加大推进生态文明建设的力度。二次调查数据显示，全国因草原退化、耕地开垦、建设占用等因素导致草地减少1066.7万公顷；具有生态涵养功能的滩涂、沼泽减少10.7%，冰川与积雪减少7.5%；局部地区盐碱地、沙地增加较多，生态承载问题比较突出。因此，建设美丽中国，必须进一步强化生态优先理念，完善生态修复制度，持续加大生态文明建设力度。</p>\r\n\r\n<p style=\"font: 14px/28px \"Times New Roman\"; margin: 1em 0px; padding: 0px; border: 0px currentColor; border-image: none; color: rgb(51, 51, 51); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; widows: 1; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;\">　　二次调查成果对于准确判断国情国力，客观分析土地资源承载能力、发展潜力和土地管理形势，科学制定国家相关规划和宏观经济决策，支撑资源管理和社会共享服务等，具有重要的基础作用。</p>\r\n\r\n<p style=\"font: 14px/28px \"Times New Roman\"; margin: 1em 0px; padding: 0px; border: 0px currentColor; border-image: none; color: rgb(51, 51, 51); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; widows: 1; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;\">　　最后，需要说明的是，二次调查成果公布后，在相关支农惠农政策上，不因地类的变化而改变。</p>\r\n');
REPLACE INTO `p8_cms_item_government_affairs_addon` VALUES ('37','1107','1','','','中共中央总书记、国家主席、中央军委主席习近平近日对耕地保护工作作出重要指示。他强调，耕地是我国最为宝贵的资源。我国人多地少的基本国情，决定了我们必须把关系十几亿人吃饭大事的耕地保护好，绝不能有闪失。要实行最严格的耕地保护制度，依法依规做好耕地占补平衡','175.13.255.10','175.13.255.10','1460599756','&nbsp;\r\n<p style=\"border-top: 0px; border-right: 0px; white-space: normal; word-spacing: 0px; border-bottom: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; padding-top: 26px; font: 14px/26px 宋体, simsun, sans-serif, Arial; padding-left: 0px; margin: 0px; border-left: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">&nbsp;&nbsp;&nbsp; 中共中央总书记、国家主席、中央军委主席习近平近日对耕地保护工作作出重要指示。他强调，耕地是我国最为宝贵的资源。我国人多地少的基本国情，决定了我们必须把关系十几亿人吃饭大事的耕地保护好，绝不能有闪失。要实行最严格的耕地保护制度，依法依规做好耕地占补平衡，规范有序推进农村土地流转，像保护大熊猫一样保护耕地。</p>\r\n\r\n<p style=\"border-top: 0px; border-right: 0px; white-space: normal; word-spacing: 0px; border-bottom: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; padding-top: 26px; font: 14px/26px 宋体, simsun, sans-serif, Arial; padding-left: 0px; margin: 0px; border-left: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">　　习近平指出，耕地占补平衡政策是对工业化、城镇化建设占用耕地不断扩大的补救措施，是国家法律和政策允许的，但必须带着保护耕地的强烈意识去做这项工作，严格依法依规进行。要采取更有力的措施，加强对耕地占补平衡的监管，坚决防止耕地占补平衡中出现的补充数量不到位、补充质量不到位问题，坚决防止占多补少、占优补劣、占水田补旱地的现象。在农村土地制度改革试点中要把好关，不能让一些人以改革之名行占用耕地之实。对耕地占补平衡以及耕地保护中出现的新情况新问题，要加强调查研究，提出有效的应对之策。</p>\r\n\r\n<p style=\"border-top: 0px; border-right: 0px; white-space: normal; word-spacing: 0px; border-bottom: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; padding-top: 26px; font: 14px/26px 宋体, simsun, sans-serif, Arial; padding-left: 0px; margin: 0px; border-left: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">　　习近平强调，土地流转和多种形式规模经营，是发展现代农业的必由之路，也是农村改革的基本方向。在土地流转实践中，必须要求各地区原原本本贯彻落实党中央确定的方针政策，既要加大政策扶持力度、鼓励创新农业经营体制机制，又要因地制宜、循序渐进，不搞大跃进，不搞强迫命令，不搞行政瞎指挥。特别要防止一些工商资本到农村介入土地流转后搞非农建设、影响耕地保护和粮食生产等问题。要注意完善土地承包法律法规、落实支持粮食生产政策、健全监管和风险防范机制、加强乡镇农村经营管理体系建设，推动土地流转规范有序进行，真正激发农民搞农业生产特别是粮食生产的积极性。</p>\r\n');
REPLACE INTO `p8_cms_item_government_affairs_addon` VALUES ('38','1108','1','','','8日下午，全国政协十二届三次会议在政协礼堂举办了提案办理协商会，主题为&amp;amp;ldquo;加大耕地保护工作力度，为人民提供优质安全的农产品&amp;amp;rdquo;，各民主党派中央和全国工商联代表、提案者代表、提案委员会成员、相关承办部门代表等参加了会议。　　会上，提案者代表分析了我','175.13.255.10','175.13.255.10','1460599982','&nbsp;\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; padding-top: 0px; font: 14px/23px 宋体; padding-left: 0px; margin: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; text-indent: 0px; -webkit-text-stroke-width: 0px\">&nbsp;&nbsp;&nbsp;&nbsp;8日下午，全国政协十二届三次会议在政协礼堂举办了提案办理协商会，主题为&ldquo;加大耕地保护工作力度，为人民提供优质安全的农产品&rdquo;，各民主党派中央和全国工商联代表、提案者代表、提案委员会成员、相关承办部门代表等参加了会议。</p>\r\n\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; padding-top: 0px; font: 14px/23px 宋体; padding-left: 0px; margin: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; text-indent: 0px; -webkit-text-stroke-width: 0px\">　　会上，提案者代表分析了我国当前耕地保护的严峻形势，阐释了耕地污染治理的迫切需要，并指出耕地污染防治与耕地保护工作将直接关系我国的耕地安全、粮食安全，并将直接影响老百姓的身体健康、生活质量。有提案委员指出，当前我国土壤污染已成为影响农作物质量的重要因素。还有委员分析，土壤污染防治比大气、水污染更为复杂、艰巨、长久，且一旦污染很难治理。我国农产品质量安全检测、监督体系建设已取得进展，但仍需在源头上提高质量。</p>\r\n\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; padding-top: 0px; font: 14px/23px 宋体; padding-left: 0px; margin: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; text-indent: 0px; -webkit-text-stroke-width: 0px\">　　协商会上，提案委员们从不同角度提出诸多建议。对此，中央农办、国土资源部、环境保护部、农业部、卫生计生委、食品药品监管总局、粮食局等部门分别作出回应，表示将尽快回复提案，并积极出台措施，强化耕地保护，要加快制定专项法律法规，出台耕地污染防治和保护行动计划，完善监察检测标准，加大资金支持和科技投入，掌握污染数据，建立科学有序的管理体制。</p>\r\n\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; padding-top: 0px; font: 14px/23px 宋体; padding-left: 0px; margin: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; text-indent: 0px; -webkit-text-stroke-width: 0px\">　　全国政协副主席罗富和出席提案办理协商会并发表讲话，肯定了提案的重大意义和提案协商的有效形式，并希望有关部门尽快出台措施，积极解决耕地污染问题。</p>\r\n');
REPLACE INTO `p8_cms_item_government_affairs_addon` VALUES ('39','1109','1','','','习近平总书记近日就耕地保护和农村土地流转工作作出重要指示，强调要实行最严格的耕地保护制度，依法依规做好耕地占补平衡，规范有序推进农村土地流转，像保护大熊猫一样保护耕地。　　耕地保护是土地管理的核心，多年来，我县把保护耕地作为土地管理的首要任务，积极探','175.13.255.10','175.13.255.10','1460600170','&nbsp;\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(83,90,95); font: 14px/25px 宋体; margin: 10px auto 20px; widows: 1; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\"><span style=\"white-space: normal; word-spacing: 0px; text-transform: none; float: none; color: rgb(0,0,0); text-align: justify; font: 14px/22px Simsun; display: inline !important; letter-spacing: normal; background-color: rgb(247,250,255); text-indent: 0px; -webkit-text-stroke-width: 0px; font-stretch: normal\">&nbsp;&nbsp;&nbsp; 习近平总书记近日就耕地保护和农村土地流转工作作出重要指示，强调要实行最严格的耕地保护制度，依法依规做好耕地占补平衡，规范有序推进农村土地流转，像保护大熊猫一样保护耕地。</span></p>\r\n\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); text-align: justify; font: 14px/22px Simsun; margin: 10px auto 20px; widows: 1; letter-spacing: normal; background-color: rgb(247,250,255); text-indent: 0px; -webkit-text-stroke-width: 0px; font-stretch: normal\">　　耕地保护是土地管理的核心，多年来，我县把保护耕地作为土地管理的首要任务，积极探索建立&ldquo;用补偿激励、以长效监管、用考核约束、以整治改善&rdquo;四项机制，促使耕地得到有效保护。全县基本农田保护率（占耕地面积）达82%以上，在市政府对各县耕地保护责任目标考核中，历年考核名列前茅。</p>\r\n\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); text-align: justify; font: 14px/22px Simsun; margin: 10px auto 20px; widows: 1; letter-spacing: normal; background-color: rgb(247,250,255); text-indent: 0px; -webkit-text-stroke-width: 0px; font-stretch: normal\">　　试点有偿机制激励耕地主动保护。以实施耕地有偿保护机制试点为契机，2012年，我县在金华市率先设立基本农田补助专项资金，实行&ldquo;工业反哺农业、城市支持农村&rdquo;政策，当年县财政拨出450多万元，使农民在基本农田保护中得到实惠。2013年将补偿范围扩大到全部耕地，2014年又将补偿标准从平均每亩15元提高到50元。同时，在2013年设立了村集体国土监管专项工作经费，按照行政村(社区)的管辖面积、人口数量、工作强度不同，分别补助3600元、3000元、2400元。有偿管护机制调动了村集体管理农村集体土地的积极性，激发了农民保护耕地的热情，实现由被动管护到主动管护的转变。</p>\r\n\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); text-align: justify; font: 14px/22px Simsun; margin: 10px auto 20px; widows: 1; letter-spacing: normal; background-color: rgb(247,250,255); text-indent: 0px; -webkit-text-stroke-width: 0px; font-stretch: normal\">　　建立长效监管体制落实耕地保护。先后制定出台《关于加强国土资源执法共同监管责任机制建设的意见》、《关于进一步强化和落实乡镇（街道）国土资源管理主体责任的意见》，有效整合乡镇（街道）和国土、公安、林业、城管、建设等相关部门执法力量，全面构建起县、乡、村三级国土资源共同监管责任体系，明确了乡镇（街道）和各部门单位职责。2014年，建设了综合执法监察管理信息系统平台，将全县行政区域划分为559个网格单位，通过网络互联互通，资源共享，进行实时指挥、督办考核和全覆盖监管，使网格精细化管理和网络共享机制有机结合，促进耕地保护高效化进行。</p>\r\n\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); text-align: justify; font: 14px/22px Simsun; margin: 10px auto 20px; widows: 1; letter-spacing: normal; background-color: rgb(247,250,255); text-indent: 0px; -webkit-text-stroke-width: 0px; font-stretch: normal\">　　强化目标责任考核严格耕地保护。将耕地保护纳入政府目标管理，签订县、乡、村、户四级《耕地保护责任书》，层层落实耕地保护责任。将耕地保护列入全县各乡镇（街道）年度工作考核。严格责任追究，按照&ldquo;既查事又查人&rdquo;的原则，对于群众反映强烈、违法用地问题严重且查处整改不力的，根据干部管理权限，由县纪检部门介入进行查处和责任追究，对涉事单位主要领导、分管领导和直接责任人按具体责任追究办法，从严追究国土资源违法案件中的违法违纪行为。2012年以来，全县有11人因未履行好耕地保护责任，受到党政纪处分。</p>\r\n\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); text-align: justify; font: 14px/22px Simsun; margin: 10px auto 20px; widows: 1; letter-spacing: normal; background-color: rgb(247,250,255); text-indent: 0px; -webkit-text-stroke-width: 0px; font-stretch: normal\">　　提升耕地垦造质量推动耕地保护。按照&ldquo;占优补优、占水田补水田&rdquo;的刚性政策要求，执行最严格的耕地占补制度。坚持耕地垦造数量和质量并举，工作重心从以前的垦造旱地为主向垦造水田为主转变。严把项目选址关，按照农业生产基本条件要求,充分考虑项目立地条件和垦造耕地的适宜性，并联合林业、环保等部门对项目进行联合审批，注重保护和改善生态环境。同时，加强项目后期管护，坚持&ldquo;谁承包、谁管护、谁受益，谁损坏、谁维修、谁赔偿&rdquo;的原则，与项目所在村签订土地整治工程后期管护合同，明确管护目标和责任，设立每亩5000元的工程管理、奖励和后期管护资金。鼓励农户边垦造、边种植，并对及时种植农作物的农户，前三年按新增耕地种植面积，给予每亩每年300元的补助，让农民得到实惠，确保项目建设完成后能够最大限度发挥作用。</p>\r\n');
REPLACE INTO `p8_cms_item_government_affairs_addon` VALUES ('40','1115','1','','<!--#p8_attach#-->/cms/item/2016_04/14_10/0b6c7e344a68b9d0.jpg','中国将分&amp;amp;ldquo;三步走&amp;amp;rdquo;建立涵盖地质灾害防治、地质环境监测及保护的信息化的全国体系，2017年基本完成中国地质环境管理信息化。　　国土部近日印发《全国地质环境信息化建设方案》(以下简称《方案》)，详细部署2013年至2017年的国家地质环境信息化建设工作。　　','175.13.255.10','175.13.255.10','1460602834','&nbsp;\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(51,51,51); padding-bottom: 5px; padding-top: 5px; font: 15px/26px 微软雅黑; padding-left: 10px; margin: 0px; widows: 1; letter-spacing: 1px; padding-right: 10px; background-color: rgb(238,242,246); text-indent: 0px; -webkit-text-stroke-width: 0px\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 中国将分&ldquo;三步走&rdquo;建立涵盖地质灾害防治、地质环境监测及保护的信息化的全国体系，2017年基本完成中国地质环境管理信息化。</p>\r\n\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(51,51,51); padding-bottom: 5px; padding-top: 5px; font: 15px/26px 微软雅黑; padding-left: 10px; margin: 0px; widows: 1; letter-spacing: 1px; padding-right: 10px; background-color: rgb(238,242,246); text-indent: 0px; -webkit-text-stroke-width: 0px\">　　国土部近日印发《全国地质环境信息化建设方案》(以下简称《方案》)，详细部署2013年至2017年的国家地质环境信息化建设工作。</p>\r\n\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(51,51,51); padding-bottom: 5px; padding-top: 5px; font: 15px/26px 微软雅黑; padding-left: 10px; margin: 0px; widows: 1; letter-spacing: 1px; padding-right: 10px; background-color: rgb(238,242,246); text-indent: 0px; -webkit-text-stroke-width: 0px\">　　据国土部部署，三个时间节点分别为：2013年完善系统和平台建设，加大推广力度；2015年，集成并完善地质环境信息平台，开展地质灾害应急技术支撑平台建设，在全国范围内全面铺开省级信息中心建设和信息平台推广和部署运行工作；2017年，基本完成国家级、省级地质环境数据中心及条件具备的地州级、县市级数据节点的建设和信息平台部署，基本实现全国地质环境信息化四级体系的互联互通和全国地质环境管理工作信息化。</p>\r\n\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(51,51,51); padding-bottom: 5px; padding-top: 5px; font: 15px/26px 微软雅黑; padding-left: 10px; margin: 0px; widows: 1; letter-spacing: 1px; padding-right: 10px; background-color: rgb(238,242,246); text-indent: 0px; -webkit-text-stroke-width: 0px\">　　具体实施过程包括，利用多年来积累的海量地质环境数据，开展地质灾害、地下水、矿山地质环境、农业地质、城市地质、地热、地质遗迹等专业数据库的集成和整合工作。同时，整合各类地质环境信息资源，构建国家级地质环境数据分中心，促进省级地质环境数据分中心及地州、县市级数据节点建设。</p>\r\n\r\n<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); font: 15px/26px 微软雅黑; widows: 1; letter-spacing: normal; background-color: rgb(238,242,246); text-indent: 0px; -webkit-text-stroke-width: 0px\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div id=\"adhzh\" name=\"hzh\" style=\"padding-bottom: 0px; padding-top: 0px; padding-left: 0px; margin: 0px; padding-right: 0px\">&nbsp;</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(51,51,51); padding-bottom: 5px; padding-top: 5px; font: 15px/26px 微软雅黑; padding-left: 10px; margin: 0px; widows: 1; letter-spacing: 1px; padding-right: 10px; background-color: rgb(238,242,246); text-indent: 0px; -webkit-text-stroke-width: 0px\">&nbsp;</p>\r\n\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(51,51,51); padding-bottom: 5px; padding-top: 5px; font: 15px/26px 微软雅黑; padding-left: 10px; margin: 0px; widows: 1; letter-spacing: 1px; padding-right: 10px; background-color: rgb(238,242,246); text-indent: 0px; -webkit-text-stroke-width: 0px\">　　据了解，地质环境信息化主要建设内容包括：地质环境数据分中心建设，地质环境政务管理信息系统建设，地质环境网络环境建设，地质环境信息平台建设等多平台多系统建设。</p>\r\n\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(51,51,51); padding-bottom: 5px; padding-top: 5px; font: 15px/26px 微软雅黑; padding-left: 10px; margin: 0px; widows: 1; letter-spacing: 1px; padding-right: 10px; background-color: rgb(238,242,246); text-indent: 0px; -webkit-text-stroke-width: 0px\">　　上述方案明确，该信息化体系的服务对象为政府主管部门、专业技术人员及社会公众</p>\r\n');
REPLACE INTO `p8_cms_item_government_affairs_addon` VALUES ('41','1116','1','','<!--#p8_attach#-->/cms/item/2016_04/14_11/dcd6f0af1ce820eb.jpg','参加省政协十一届三次会议的省政协委员、省水文地质工程地质大队总工程师叶兴永提交提案，建议加强&amp;amp;ldquo;五水共治&amp;amp;rdquo;过程中地质环境研究工作。　　叶兴永委员在提案中指出，&amp;amp;ldquo;五水共治&amp;amp;rdquo;与地质环境密切相关，因为地质环境是地球岩石圈表层对人类有影响的','175.13.255.10','175.13.255.10','1460602955','&nbsp;\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; padding-top: 0px; font: 14px/23px 宋体; padding-left: 0px; margin: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; text-indent: 0px; -webkit-text-stroke-width: 0px\">&nbsp;&nbsp;&nbsp; 参加省政协十一届三次会议的省政协委员、省水文地质工程地质大队总工程师叶兴永提交提案，建议加强&ldquo;五水共治&rdquo;过程中地质环境研究工作。</p>\r\n\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; padding-top: 0px; font: 14px/23px 宋体; padding-left: 0px; margin: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; text-indent: 0px; -webkit-text-stroke-width: 0px\">　　叶兴永委员在提案中指出，&ldquo;五水共治&rdquo;与地质环境密切相关，因为地质环境是地球岩石圈表层对人类有影响的所有地质体和各种地质因素作用的总和，是人类和其它生物赖以生存和发展的基本场所，是&ldquo;五水共治&rdquo;的载体。</p>\r\n\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; padding-top: 0px; font: 14px/23px 宋体; padding-left: 0px; margin: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; text-indent: 0px; -webkit-text-stroke-width: 0px\">　　&ldquo;河道被简单地截弯取直，殊不知这是在人为破坏自然地质环境条件。将原本粗糙的河道进行人工改造，会使河水流速加快，不利于防洪。&rdquo;叶兴永委员用具体的事例来说明加强&ldquo;五水共治&rdquo;过程中地质环境研究的重要性。</p>\r\n\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; padding-top: 0px; font: 14px/23px 宋体; padding-left: 0px; margin: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; text-indent: 0px; -webkit-text-stroke-width: 0px\">　　叶兴永委员建议，要充分认识地质环境演化在&ldquo;五水共治&rdquo;中的重要作用。在城市规划建设及小流域治理等工程中，应充分认识顺应自然地质环境演化规律的重要性，从而在人类干预活动（包括&ldquo;五水共治&rdquo;活动）中适度超前地开展地质环境影响研究，提出预防自然灾害的规划和建议。要加大投入，切实做好地质环境保障工作。&ldquo;防洪水、排涝水&rdquo;等工程应按地质环境的自然演化规律来实施。要加强科研工作，不断提高地质环境研究水平。要开展重大工程建设地质环境评价工作，建立完善的地质环境监测系统。</p>\r\n');
REPLACE INTO `p8_cms_item_government_affairs_addon` VALUES ('42','1117','1','','<!--#p8_attach#-->/cms/item/2016_04/14_11/47d9fc7265ca6cea.jpg','《地质环境监测管理办法》发布施行、全国地质环境监测规划编制有序开展、国家地下水监测工程付诸实施、全国地质环境信息化建设稳步推进&amp;amp;hellip;&amp;amp;hellip;12月12日，在河北省石家庄市召开的全国地质环境监测工作座谈会上，这些为我国地质环境保护、地下水资源合理开发、地','175.13.255.10','175.13.255.10','1460603053','&nbsp;\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(51,51,51); padding-bottom: 0px; padding-top: 0px; font: 16px/35px 宋体; padding-left: 0px; margin: 15px 0px 0px; widows: 1; letter-spacing: normal; padding-right: 0px; background-color: rgb(255,255,255); text-indent: 2em; -webkit-text-stroke-width: 0px\">《地质环境监测管理办法》发布施行、全国地质环境监测规划编制有序开展、国家地下水监测工程付诸实施、全国地质环境信息化建设稳步推进&hellip;&hellip;12月12日，在河北省石家庄市召开的全国地质环境监测工作座谈会上，这些为我国地质环境保护、地下水资源合理开发、地质灾害防灾减灾等提供支撑和保障的一项项&ldquo;国家行动&rdquo;，成为代表们热议的焦点。</p>\r\n\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(51,51,51); padding-bottom: 0px; padding-top: 0px; font: 16px/35px 宋体; padding-left: 0px; margin: 15px 0px 0px; widows: 1; letter-spacing: normal; padding-right: 0px; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">　　与会专家和代表表示，目前，我国地质环境监测工作迎来了前所未有的发展新机，如何规划和实施新时期的地质环境监测工作，做好顶层设计是关键。一是要让社会和各级政府部门认识到地质环境监测工作的重要性，大力开展宣传和落实《地质环境监测管理办法》。二是在国家层面设计&ldquo;全国地质环境监测一张网&rdquo;，整体部署国家&mdash;省&mdash;市&mdash;县四级地质环境监测工作。三是在省级层面，把地质环境监测工作纳入国土资源责任目标体系，推进地质环境监测机构建设的落实。四是大力推进地质环境监测规划编制、贯彻落实和资金保障，并且抓紧编制实施细则和标准规范。五是要重视地质环境监测成果转化，加强综合研究，提高为政府决策提供支撑的服务能力。</p>\r\n\r\n<p style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(51,51,51); padding-bottom: 0px; padding-top: 0px; font: 16px/35px 宋体; padding-left: 0px; margin: 15px 0px 0px; widows: 1; letter-spacing: normal; padding-right: 0px; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">　　据悉，今年7月1日发布施行的《地质环境监测管理办法》，是我国第一部有关地质环境监测管理工作的部门行政规章，标志着我国地质环境监测管理工作正式上升为国家意志。全国地质环境监测规划是在新型城镇化背景下，地质环境监测工作及成果支撑区域国土资源可持续开发的行动方案。全国地质环境信息化建设旨在构建支撑地灾预警和应急指挥的技术支撑平台，整体提升地质环境信息的采集与监测、分析与预警、决策与处置能力和服务水平。而由水利部、国土资源部历经10年可行性研究、工程立项评估、两部联合审查、前置条件审批、投资20多亿元的国家地下水监测工程建成后，可实现对全国地下水动态的有效监控，为社会提供及时、准确、全面的地下水动态信息，为地下水资源合理开发、地下水环境保护、地面沉降防控等提供科学依据和决策支持。</p>\r\n');
REPLACE INTO `p8_cms_item_government_affairs_addon` VALUES ('43','1118','1','','<!--#p8_attach#-->/cms/item/2016_04/14_11/6096ee246d640e99.jpg','5月4日，全市地质环境工作会议在市局召开。会议总结回顾了2011年全市地质环境工作，明确了2012年工作任务，重点安排部署了当前地质灾害防治工作。局党组成员、副局长张锡勇出席会议并讲话。局办公室、地质环境科、地质环境监测站以及市地质公园办相关人员，各区、县(分','175.13.255.10','175.13.255.10','1460603160','&nbsp;\r\n<p style=\"border-top: 0px; border-right: 0px; white-space: normal; word-spacing: 0px; border-bottom: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; text-align: left; padding-top: 0px; font: 14px/22px 宋体, Verdana, Arial, Helvetica, sans-serif; padding-left: 0px; margin: 12px 0px; border-left: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">&nbsp;&nbsp;&nbsp; 5月4日，全市地质环境工作会议在市局召开。会议总结回顾了2011年全市地质环境工作，明确了2012年工作任务，重点安排部署了当前地质灾害防治工作。局党组成员、副局长张锡勇出席会议并讲话。局办公室、地质环境科、地质环境监测站以及市地质公园办相关人员，各区、县(分)国土资源局分管领导、地质环境股(站)长参加了会议。</p>\r\n\r\n<p style=\"border-top: 0px; border-right: 0px; white-space: normal; word-spacing: 0px; border-bottom: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; text-align: left; padding-top: 0px; font: 14px/22px 宋体, Verdana, Arial, Helvetica, sans-serif; padding-left: 0px; margin: 12px 0px; border-left: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">　　2011年，我市地质环境工作亮点多，成效明显。一是成功避让地质灾害3起，避免伤亡121人，避免直接经济损失2000多万元，连续8年实现地质灾害防治&ldquo;零死亡&rdquo;目标。二是&ldquo;张家界地貌&rdquo;获得世界地学界的广泛认可，为全市旅游经济发展注入了新的活力。三是完成了桑植宝塔洛等隐患点的治理，消除地质灾害隐患6处，保护群众1500余人。四是组织实施了慈利大浒镍钼矿区地质环境治理项目，矿区内群众生产生活环境明显改善。</p>\r\n\r\n<p style=\"border-top: 0px; border-right: 0px; white-space: normal; word-spacing: 0px; border-bottom: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; text-align: left; padding-top: 0px; font: 14px/22px 宋体, Verdana, Arial, Helvetica, sans-serif; padding-left: 0px; margin: 12px 0px; border-left: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">　　会议指出，2012年要以维护群众的利益为根本，切实抓好以下几项工作：一是加强汛期地质灾害防治，重点抓好地质灾害巡查、监测、预警和应急处置，确保群众生命财产安全；二是加强矿山地质环境治理，切实抓好矿山地质环境调查评价、监测和矿山地质环境恢复治理备用金的收缴；三是加大地质遗迹保护力度，重点抓好地质公园规划修编和达标创建工作。四是加大项目申报力度，切实抓好地灾隐患、矿山地质环境治理和地质遗迹保护项目的实施和监管。</p>\r\n\r\n<p style=\"border-top: 0px; border-right: 0px; white-space: normal; word-spacing: 0px; border-bottom: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; text-align: left; padding-top: 0px; font: 14px/22px 宋体, Verdana, Arial, Helvetica, sans-serif; padding-left: 0px; margin: 12px 0px; border-left: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">　　张锡勇副局长强调，地质灾害防治工作事关全市人民群众生命财产安全，要高度重视，不能麻痹大意，抱有侥幸心理，要切实将各项防灾措施抓落实。一是抓责任落实，确保责任到人；二是抓地质灾害巡查，重点突出对景点、学校、村庄、水库、公路沿线、矿山等重要区域的巡查，并建立巡查台帐；三是抓汛期值班、灾情速报、应急调查与处置等各项制度的落实，加强防灾能力建设；四是抓治理搬迁，尽力减少地质灾害隐患威胁；五是抓宣传培训，全面提升社会大众防灾意识。</p>\r\n\r\n<p style=\"border-top: 0px; border-right: 0px; white-space: normal; word-spacing: 0px; border-bottom: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; text-align: left; padding-top: 0px; font: 14px/22px 宋体, Verdana, Arial, Helvetica, sans-serif; padding-left: 0px; margin: 12px 0px; border-left: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">　　会议还就如何做好汛期地质灾害防治、矿山地质环境治理、地质遗迹保护以及地质环境项目的申报和实施进行了讨论。</p>\r\n');
REPLACE INTO `p8_cms_item_government_affairs_addon` VALUES ('44','1119','1','','<!--#p8_attach#-->/cms/item/2016_04/14_11/8db4fd5befff29e2.jpg','10月31日，全国地质环境管理工作会议在江西省南昌市召开。会议宣读了国土资源部部长、党组书记、国家土地总督察徐绍史对地质环境工作的重要批示。国土资源部党组成员、副部长、中国地质调查局局长汪民发表讲话。江西省常务副省长凌成兴致辞，江西省政协副主席胡幼桃出席','175.13.255.10','175.13.255.10','1460603274','&nbsp;\r\n<p style=\"border-top: 0px; border-right: 0px; white-space: normal; word-spacing: 0px; border-bottom: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; padding-top: 0px; font: 14px/23px Simsun; padding-left: 0px; margin: 15px 0px; border-left: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; background-color: rgb(245,248,253); text-indent: 0px; -webkit-text-stroke-width: 0px\">&nbsp;&nbsp;&nbsp; 10月31日，全国地质环境管理工作会议在江西省南昌市召开。会议宣读了国土资源部部长、党组书记、国家土地总督察徐绍史对地质环境工作的重要批示。国土资源部党组成员、副部长、中国地质调查局局长汪民发表讲话。江西省常务副省长凌成兴致辞，江西省政协副主席胡幼桃出席。</p>\r\n\r\n<p style=\"border-top: 0px; border-right: 0px; white-space: normal; word-spacing: 0px; border-bottom: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; padding-top: 0px; font: 14px/23px Simsun; padding-left: 0px; margin: 15px 0px; border-left: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; background-color: rgb(245,248,253); text-indent: 0px; -webkit-text-stroke-width: 0px\">　　徐绍史在批示中说，近几年来，地质环境工作在国土资源服务民生、服务经济社会发展全局中发挥了不可替代的作用，取得了突出成绩。在当前我国工业化、城镇化和农业现代化同步快速推进的过程中，地质环境工作一定要肩负起新的历史使命，要按照中央领导同志关于国土资源管理工作重要讲话中明确的新要求，着重解决项目从哪里来、成果提供给谁用的问题，要进一步强化服务理念，主动谋划，积极作为，为把国土资源管理工作推向一个新高度，为推动我国经济社会又好又快科学发展作出新的更大贡献。</p>\r\n\r\n<p style=\"border-top: 0px; border-right: 0px; white-space: normal; word-spacing: 0px; border-bottom: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; padding-top: 0px; font: 14px/23px Simsun; padding-left: 0px; margin: 15px 0px; border-left: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; background-color: rgb(245,248,253); text-indent: 0px; -webkit-text-stroke-width: 0px\">　　汪民总结了&ldquo;十一五&rdquo;地质环境工作，指出&ldquo;十一五&rdquo;期间，我国地质环境管理工作与经济社会发展结合更加紧密，促进经济社会发展的成效更加显著，在地质灾害调查评价与监测预警，水文地质、环境地质、城市地质、农业地质，抗旱找水打井，地下水污染防治和应对全球气候变化等方面，都增强了服务意识，提高了服务水平。&ldquo;十二五&rdquo;期间，经济社会发展对地质环境工作的需求将更加强烈，地质环境工作面临新挑战、新要求。地质环境工作要大力增强服务意识，瞄准经济社会主战场，努力增强服务经济社会的能力和水平。要充分了解国家、地方、行业部门和社会的需求，面向需求规划部署相关工作。地质调查项目立项和组织实施是决定各项工作能否有效服务于经济社会发展的关键环节，要从制度上入手，形成从立项论证开始就着眼于成果的应用、积极主动地与地方政府开展合作的良性局面，这样针对需求开展的工作才更有生命力，更会得到国家和地方的重视，更会得到相关行业部门的支持，也更会受到社会的广泛关注和欢迎。当前，地质环境领域已经做了有益有效的尝试，天津浅层地温能调查评价试点的成功经验，要在地质环境调查领域普遍推广。</p>\r\n\r\n<p style=\"border-top: 0px; border-right: 0px; white-space: normal; word-spacing: 0px; border-bottom: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; padding-top: 0px; font: 14px/23px Simsun; padding-left: 0px; margin: 15px 0px; border-left: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; background-color: rgb(245,248,253); text-indent: 0px; -webkit-text-stroke-width: 0px\">　　他指出，要发挥优势，搞好布局，在现有基础上形成部省两级地质环境领域各类信息、技术和科学研究中心，支撑地质环境管理工作，支撑地质环境工作服务经济和社会发展。地质环境工作服务经济社会发展的产品设计是今后要着力改进的重大问题。要下大功夫设计产品和各类成果提交方式，对地质调查报告和研究报告进行提炼、缩减，以满足某些特殊的需要；对一个时期的报告、信息进行综合、研究，向社会、向行业、向部门提供通报，向上级部门报告以供参考；对某些重要情况进行上报，供领导决策参考等。</p>\r\n\r\n<p style=\"border-top: 0px; border-right: 0px; white-space: normal; word-spacing: 0px; border-bottom: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; padding-top: 0px; font: 14px/23px Simsun; padding-left: 0px; margin: 15px 0px; border-left: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; background-color: rgb(245,248,253); text-indent: 0px; -webkit-text-stroke-width: 0px\">　　汪民提到，近期，国土资源部印发了《关于在国土资源系统窗口单位深入开展&ldquo;为民服务创先争优&rdquo;活动的指导意见》，明确部系统地质环境相关单位为国土资源系统窗口单位，各级地质环境管理部门和地质环境调查单位要以此为契机，进一步增强服务意识，把服务意识贯穿于地质环境工作的全过程。地质环境调查要从项目立项、项目设计、项目实施、成果总结和转化应用各环节，地质环境管理则要从调查研究、顶层设计、政策法规制定、规范性文件编制、日常监督管理各方面，围绕&ldquo;服务&rdquo;这个中心来开展工作。</p>\r\n\r\n<p style=\"border-top: 0px; border-right: 0px; white-space: normal; word-spacing: 0px; border-bottom: 0px; text-transform: none; color: rgb(0,0,0); padding-bottom: 0px; padding-top: 0px; font: 14px/23px Simsun; padding-left: 0px; margin: 15px 0px; border-left: 0px; widows: 1; letter-spacing: normal; padding-right: 0px; background-color: rgb(245,248,253); text-indent: 0px; -webkit-text-stroke-width: 0px\">　　国家发改委、民政部、水利部、中国气象局、国务院应急办等部门代表出席会议。来自全国各省（区、市）的200多名代表参加会议。会议期间，代表们将就围绕地质环境工作展开经验交流。</p>\r\n');
REPLACE INTO `p8_cms_item_govopen2_` VALUES ('1193','govopen2','1145','1','admin','闻闻哇','','0','','','','','吾问无为谓吾问无为谓','','','','','','1','admin','1459129646','1458712693','1458712693','1458712693','1458712693','1','','','5','0','0','','','','2','2','1','1','234','10','223','');
REPLACE INTO `p8_cms_item_govopen2_addon` VALUES ('1','1193','1','','','吾问无为谓吾问无为谓','59.49.77.116','59.49.77.116','1458712693','<p>吾问无为谓吾问无为谓</p>');
REPLACE INTO `p8_cms_item_govopen_` VALUES ('306','govopen','176','1','admin','223423423432','','0','23423','','','','','23423423','','','','','','1','','0','1366726862','1366726862','1366726862','1366726862','1','','','27','0','0','','','','1','2','2','1','23423','11','23423','');
REPLACE INTO `p8_cms_item_govopen_` VALUES ('311','govopen','185','1','admin','大学召开2012年第12次校长办公会议','','0','','','','','','&amp;amp;nbsp;9月17日，校长李元元主持召开了本年度第12次校长办公会议。&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp; 会议审议通过了吉林大学高层次人才特殊支持计划工作领导小组成员名单及有关预算追加事宜；研究了解决青年教职工周转房有关事宜；','','','','','','1','','0','1367808746','1367808746','1367808746','1367808746','1','','','113','0','0','','','','1','1','3','1','jda-23423432','9','23234','');
REPLACE INTO `p8_cms_item_govopen_addon` VALUES ('1','306','1','','','23423423','121.8.206.50','121.8.206.50','1366726862','23423423','23423');
REPLACE INTO `p8_cms_item_govopen_addon` VALUES ('4','311','1','','','&amp;amp;nbsp;9月17日，校长李元元主持召开了本年度第12次校长办公会议。&amp;amp;nbsp;&amp;amp;nbsp;&amp;amp;nbsp; 会议审议通过了吉林大学高层次人才特殊支持计划工作领导小组成员名单及有关预算追加事宜；研究了解决青年教职工周转房有关事宜；','183.48.64.125','183.48.64.125','1367808746','<p>\r\n	&nbsp;9月17日，校长李元元主持召开了本年度第12次校长办公会议。</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp; 会议审议通过了吉林大学高层次人才特殊支持计划工作领导小组成员名单及有关预算追加事宜；研究了解决青年教职工周转房有关事宜；听取了关于&ldquo;感动长春劳动模范&rdquo;候选人推荐人选的汇报、《吉林大学关于推动协同创新，落实高等学校创新能力提升计划的意见》及协同创新中心五个有关管理办法实施情况的汇报。</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp; 会议强调，学校必须抢抓机遇，将实施高层次人才特殊支持计划与人才培育工作相结合，加强顶层设计，统筹好校内资源，与学校中长期发展规划及相关学科的规划相衔接，与现有各项政策相协调，有效配置资源，形成良好的工作制度。学校要高度重视并切实维护师生员工的利益，努力改善师生学习、工作与生活条件，相关职能部门要以非常积极的态度切实推进相关工作，为学校事业的发展提供保障。全校上下要高度重视、全力推进协同创新中心培育工作，要将推进协同创新工作作为引领学校创新发展，全面提升学校人才培养、科学研究、服务社会、文化传承与创新的强劲动力。协同创新中心各项制度内容要体现创新性、系统性、规范性和可操作性，符合吉大实际，具有吉大特色，为学校创新发展提供完善的制度保障。</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp; 会议还研究了其他事项。</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;校长办公室</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2012年10月22日</p>\r\n','34543');
REPLACE INTO `p8_cms_item_mood` VALUES ('1','欠扁','1.gif','99');
REPLACE INTO `p8_cms_item_mood` VALUES ('2','支持','2.gif','88');
REPLACE INTO `p8_cms_item_mood` VALUES ('3','很棒','3.gif','77');
REPLACE INTO `p8_cms_item_mood` VALUES ('4','找骂','4.gif','66');
REPLACE INTO `p8_cms_item_mood` VALUES ('5','搞笑','5.gif','55');
REPLACE INTO `p8_cms_item_mood` VALUES ('6','软文','6.gif','44');
REPLACE INTO `p8_cms_item_mood` VALUES ('7','不解','7.gif','1');
REPLACE INTO `p8_cms_item_mood` VALUES ('8','吃惊','8.gif','1');
REPLACE INTO `p8_cms_item_page_` VALUES ('1102','page','781','1','admin','教育局简介','','0','','','','','','　　 广东省国微市教育局　　　　Guanzhou guowei soft Technology CO.,Ltd　　百年大计，教育为本，教育的发展是城市现代化建设的坚实基础。东莞市委、市政府充分认识到教育的重要意义，历来高度重视教育，把教育作为战略发展重点，确定科教兴市和人才强市战略，采取重','','','','','','1','admin','0','1581930868','1581930868','1581930868','1581931410','1','','','91','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_page_` VALUES ('1110','page','778','1','admin','教育局职能','','0','','<!--#p8_attach#-->/ueditor/image/20150718/1437221655116667.jpg','','','','','','','','','','1','admin','0','1582098607','1582098607','1582098607','1582098607','1','','','17','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";s:1:\\\"0\\\";s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_page_addon` VALUES ('1','1102','1','','','　　 广东省国微市教育局　　　　Guanzhou guowei soft Technology CO.,Ltd　　百年大计，教育为本，教育的发展是城市现代化建设的坚实基础。东莞市委、市政府充分认识到教育的重要意义，历来高度重视教育，把教育作为战略发展重点，确定科教兴市和人才强市战略，采取重','36.157.195.180','36.157.195.180','1581930868','<p><strong><span style=\"color:#0021b0;font-size:24px\">&nbsp; &nbsp; &nbsp;广东省国微市教育局</span></strong><br />\r\n　　<br />\r\n　　<span style=\"color:#2690fe;font-size:16px\">Guanzhou guowei soft Technology CO.,Ltd</span></p>\r\n\r\n<p><br />\r\n　　<span style=\"font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px;\">&nbsp;</span><span style=\"font-size: 14px; line-height: 25.2000007629395px; font-family: 宋体;\">百年大计，教育为本，教育的发展是城市现代化建设的坚实基础。东莞市委、市政府充分认识到教育的重要意义，历来高度重视教育，把教育作为战略发展重点，确定科教兴市和人才强市战略，采取重大举措，创造良好条件，确保教育在现代化建设中先导性、全局性、基础性的地位和作用，优先发展教育事业。经过多年不懈努力，东莞市教育事业取得较大发展，成功创建为广东省教育强市，全市</span><span style=\"font-size: 14px; line-height: 25.2000007629395px; font-family: Arial;\">32</span><span style=\"font-size: 14px; line-height: 25.2000007629395px; font-family: 宋体;\">个镇（街）全部创建为广东省教育强镇，教育现代化建设不断推进，教育综合实力稳居全省前列。</span></p>\r\n\r\n<p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal; text-indent: 24pt;\"><span style=\"font-family: Arial;\">&nbsp;&nbsp;</span><span style=\"font-family: 宋体;\">学前教育：</span><span style=\"font-family: \'Times New Roman\';\">2014-2015</span><span style=\"font-family: 宋体;\">学年，全市共有幼儿园</span><span style=\"font-family: \'Times New Roman\';\">881</span><span style=\"font-family: 宋体;\">所，</span><span style=\"font-family: \'Times New Roman\';\">3-6</span><span style=\"font-family: 宋体;\">周岁在园（班）幼儿共</span><span style=\"font-family: \'Times New Roman\';\">290548</span><span style=\"font-family: 宋体;\">人，入园率达</span><span style=\"font-family: \'Times New Roman\';\">99.2%</span><span style=\"font-family: 宋体;\">，基本普及三年学前教育。全市优质幼儿园进一步增加，共有省、市一级幼儿园</span><span style=\"font-family: \'Times New Roman\';\">341</span><span style=\"font-family: 宋体;\">所。</span></p>\r\n\r\n<p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal; text-indent: 24pt;\"><span style=\"font-family: 宋体;\">义务教育：</span><span style=\"font-family: \'Times New Roman\';\">2014-2015</span><span style=\"font-family: 宋体;\">学年，全市共有小学</span><span style=\"font-family: \'Times New Roman\';\">320</span><span style=\"font-family: 宋体;\">所，在校生</span><span style=\"font-family: \'Times New Roman\';\">687269</span><span style=\"font-family: 宋体;\">人。全市共有初中</span><span style=\"font-family: \'Times New Roman\';\">172</span><span style=\"font-family: 宋体;\">所（不含完全中学），在校生</span><span style=\"font-family: \'Times New Roman\';\">206595</span><span style=\"font-family: 宋体;\">人。高水平普及了九年义务教育。</span></p>\r\n\r\n<p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal; text-indent: 24pt;\"><span style=\"font-family: 宋体;\">高中阶段教育：</span><span style=\"font-family: \'Times New Roman\';\">2014-2015</span><span style=\"font-family: 宋体;\">学年，全市共有高中阶段学校</span><span style=\"font-family: \'Times New Roman\';\">65</span><span style=\"font-family: 宋体;\">所，其中普通高中（含完中和多层次学校高中部）</span><span style=\"font-family: \'Times New Roman\';\">40</span><span style=\"font-family: 宋体;\">所，在校生</span><span style=\"font-family: \'Times New Roman\';\">78053</span><span style=\"font-family: 宋体;\">人；中职学校</span><span style=\"font-family: \'Times New Roman\';\">25</span><span style=\"font-family: 宋体;\">所（含技工学校</span><span style=\"font-family: \'Times New Roman\';\">3</span><span style=\"font-family: 宋体;\">所），在校生</span><span style=\"font-family: \'Times New Roman\';\">67033</span><span style=\"font-family: 宋体;\">人。</span><span style=\"font-family: \'Times New Roman\';\">2012</span><span style=\"font-family: 宋体;\">年、</span><span style=\"font-family: \'Times New Roman\';\">2013</span><span style=\"font-family: 宋体;\">年、</span><span style=\"font-family: \'Times New Roman\';\">2014</span><span style=\"font-family: 宋体;\">年普通高考，我市考生录取率、每万户籍人口升入重点（第一批本科）、本科、大学人数等四项指标连续三年在全省</span><span style=\"font-family: \'Times New Roman\';\">21</span><span style=\"font-family: 宋体;\">个地级以上市中排列第一位。</span></p>\r\n\r\n<p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal; text-indent: 24pt;\"><span style=\"font-family: 宋体;\">民办教育：</span><span style=\"font-family: \'Times New Roman\';\">2014-2015</span><span style=\"font-family: 宋体;\">学年，全市经批准开办的民办幼儿园</span><span style=\"font-family: \'Times New Roman\';\">692</span><span style=\"font-family: 宋体;\">所</span><span style=\"font-family: 宋体;\">（含</span><span style=\"font-family: \'Times New Roman\';\">1</span><span style=\"font-family: 宋体;\">所国际幼儿园）</span><span style=\"font-family: 宋体;\">；民办普通中小学</span><span style=\"font-family: \'Times New Roman\';\">256</span><span style=\"font-family: 宋体;\">所</span><span style=\"font-family: 宋体;\">（含</span><span style=\"font-family: \'Times New Roman\';\">2</span><span style=\"font-family: 宋体;\">所国际学校和</span><span style=\"font-family: \'Times New Roman\';\">1</span><span style=\"font-family: 宋体;\">所台商子弟学校）</span><span style=\"font-family: 宋体;\">，其中小学</span><span style=\"font-family: \'Times New Roman\';\">114</span><span style=\"font-family: 宋体;\">所、初中</span><span style=\"font-family: \'Times New Roman\';\">10</span><span style=\"font-family: 宋体;\">所、九年一贯制学校</span><span style=\"font-family: \'Times New Roman\';\">117</span><span style=\"font-family: 宋体;\">所、完全中学</span><span style=\"font-family: \'Times New Roman\';\">1</span><span style=\"font-family: 宋体;\">所、普通高中</span><span style=\"font-family: \'Times New Roman\';\">1</span><span style=\"font-family: 宋体;\">所、多层次学校</span><span style=\"font-family: \'Times New Roman\';\">13</span><span style=\"font-family: 宋体;\">所；民办中职学校</span><span style=\"font-family: \'Times New Roman\';\">11</span><span style=\"font-family: 宋体;\">所（含</span><span style=\"font-family: \'Times New Roman\';\">2</span><span style=\"font-family: 宋体;\">所民办技工学校）。民办学校在校生分别为幼儿园</span><span style=\"font-family: \'Times New Roman\';\">222749</span><span style=\"font-family: 宋体;\">人、小学</span><span style=\"font-family: \'Times New Roman\';\">461088</span><span style=\"font-family: 宋体;\">人、初中</span><span style=\"font-family: \'Times New Roman\';\">118173</span><span style=\"font-family: 宋体;\">人、普通高中</span><span style=\"font-family: \'Times New Roman\';\">22216</span><span style=\"font-family: 宋体;\">人、中职学校</span><span style=\"font-family: \'Times New Roman\';\">22256</span><span style=\"font-family: 宋体;\">人。</span></p>\r\n\r\n<p style=\"text-align:left;font-family: sans-serif, 宋体; font-size: 14px; line-height: 25.2000007629395px; white-space: normal; text-indent: 24pt;\"><span style=\"font-family: 宋体;\">成人教育：</span><span style=\"font-family: \'Times New Roman\';\">2014-2015</span><span style=\"font-family: 宋体;\">学年，全市共有</span><span style=\"font-family: \'Times New Roman\';\">5</span><span style=\"font-family: 宋体;\">所成人高等教育机构、</span><span style=\"font-family: \'Times New Roman\';\">32</span><span style=\"font-family: 宋体;\">所乡镇成人文化技术学校、</span><span style=\"font-family: \'Times New Roman\';\">455</span><span style=\"font-family: 宋体;\">所民办培训机构，全市各类教育培训量达</span><span style=\"font-family: \'Times New Roman\';\">51.2</span><span style=\"font-family: 宋体;\">万人次，各类成人高等学历教育在校生规模达</span><span style=\"font-family: \'Times New Roman\';\">56277</span><span style=\"font-family: 宋体;\">人。全市共有</span><span style=\"font-family: \'Times New Roman\';\">24425</span><span style=\"font-family: 宋体;\">人报名参加成人高考，共有</span><span style=\"font-family: \'Times New Roman\';\">58325</span><span style=\"font-family: 宋体;\">人次报名参加全国高等教育自学考试。</span></p>\r\n\r\n<p><span style=\"font-size: 10.5pt; line-height: 25.2000007629395px; font-family: 宋体;\">新莞人子女教育：</span><span style=\"font-size: 10.5pt; line-height: 25.2000007629395px; font-family: \'Times New Roman\';\">2014-2015</span><span style=\"font-size: 10.5pt; line-height: 25.2000007629395px; font-family: 宋体;\">学年，全市中小学、幼儿园非本市户籍学生有</span><span style=\"font-size: 10.5pt; line-height: 25.2000007629395px; font-family: \'Times New Roman\';\">1008994</span><span style=\"font-size: 10.5pt; line-height: 25.2000007629395px; font-family: 宋体;\">人，其中小学生</span><span style=\"font-size: 10.5pt; line-height: 25.2000007629395px; font-family: \'Times New Roman\';\">576641</span><span style=\"font-size: 10.5pt; line-height: 25.2000007629395px; font-family: 宋体;\">人、初中生</span><span style=\"font-size: 10.5pt; line-height: 25.2000007629395px; font-family: \'Times New Roman\';\">141058</span><span style=\"font-size: 10.5pt; line-height: 25.2000007629395px; font-family: 宋体;\">人、普通高中学生</span><span style=\"font-size: 10.5pt; line-height: 25.2000007629395px; font-family: \'Times New Roman\';\">17370</span><span style=\"font-size: 10.5pt; line-height: 25.2000007629395px; font-family: 宋体;\">人、中职学生</span><span style=\"font-size: 10.5pt; line-height: 25.2000007629395px; font-family: \'Times New Roman\';\">43334</span><span style=\"font-size: 10.5pt; line-height: 25.2000007629395px; font-family: 宋体;\">人、幼儿园幼儿</span><span style=\"font-size: 10.5pt; line-height: 25.2000007629395px; font-family: \'Times New Roman\';\">230591</span><span style=\"font-size: 10.5pt; line-height: 25.2000007629395px; font-family: 宋体;\">人。</span></p>\r\n\r\n<p>&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_page_addon` VALUES ('2','1110','1','','<!--#p8_attach#-->/ueditor/image/20150718/1437221655116667.jpg','','36.157.225.191','36.157.225.191','1582098607','<p>&nbsp;</p>\r\n\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n\r\n<p style=\"text-align: center;\"><img alt=\"3.jpg\" src=\"<!--#p8_attach#-->/ueditor/image/20150718/1437221655116667.jpg\" title=\"1437221655116667.jpg\" /></p>\r\n\r\n<p>6666</p>\r\n');
REPLACE INTO `p8_cms_item_paper_` VALUES ('1017','paper','34','0','','美国劳产率水平全球最高　中国进步显著','','0','','<!--#p8_attach#-->/cms/item/2014_09/01_17/385cdb5e20e4ed8e.jpg','','','1,6,7','2日发布《劳动力市场主要指标(第五版)》的报告显示，美国依然是全球劳动生产率最高的国家，中国劳动生产率提高速度很快。（详见第三版）','政府方案1|http://nw3.php168.net','','','','','1','','0','1393171200','1379420676','1393171200','1409564906','1','','','244','0','0','','','','');
REPLACE INTO `p8_cms_item_paper_` VALUES ('1019','paper','34','0','','发展改革委：中国没有出现严重的通货膨胀','','0','','','','','','据新华社北京9月4日电(记者张毅　江国成)　国家发展和改革委员会副主任毕井泉4日说，虽然今年前七个月我国居民消费价格总水平比上年同期上涨3.5%，但主要是食品价格上涨的拉动，物价总体上仍处于可控范围，没有出现由','学校分站1|http://z3.php168.net','','','','','1','','0','1379420676','1379420676','1379420676','1379420676','1','','','95','0','0','','','','');
REPLACE INTO `p8_cms_item_paper_` VALUES ('1020','paper','34','0','','新龙船“浦江游览1号”亮相上海黄浦江','','0','','','','','','新龙船&ldquo;浦江游览1号&rdquo;亮相上海黄浦江　　9月3日，&ldquo;浦江游览1号&rdquo;龙船载着游客在黄浦江上观光。当日，一艘全新的仿古龙船&ldquo;浦江游览1号&rdquo;加入上海黄浦江水上游览运营，以替代&ldquo;','学校分站1|http://z3.php168.net','','','','','1','','0','1379420676','1379420676','1379420676','1379420676','1','','','59','0','0','','','','');
REPLACE INTO `p8_cms_item_paper_addon` VALUES ('51','1017','1','','<!--#p8_attach#-->/cms/item/2014_09/01_17/385cdb5e20e4ed8e.jpg','2日发布《劳动力市场主要指标(第五版)》的报告显示，美国依然是全球劳动生产率最高的国家，中国劳动生产率提高速度很快。（详见第三版）','127.0.0.1','14.121.14.170','1393171200','2日发布《劳动力市场主要指标(第五版)》的报告显示，美国依然是全球劳动生产率最高的国家，中国劳动生产率提高速度很快。（详见第三版）');
REPLACE INTO `p8_cms_item_paper_addon` VALUES ('52','1019','1','','','据新华社北京9月4日电(记者张毅　江国成)　国家发展和改革委员会副主任毕井泉4日说，虽然今年前七个月我国居民消费价格总水平比上年同期上涨3.5%，但主要是食品价格上涨的拉动，物价总体上仍处于可控范围，没有出现由','127.0.0.1','127.0.0.1','1379420676','据新华社北京9月4日电(记者张毅　江国成)　国家发展和改革委员会副主任毕井泉4日说，虽然今年前七个月我国居民消费价格总水平比上年同期上涨3.5%，但主要是食品价格上涨的拉动，物价总体上仍处于可控范围，没有出现由于总需求严重超过总供给而引起全面、持续的价格上涨，所以没有出现严重的通货膨胀。\r\n<p>\r\n	　　毕井泉说，中国政府采取的一系列措施，有利于促进生猪生产的恢复和猪肉价格逐步趋于稳定，但是这并不意味着在短期内就能够使价格指数回落到3%以内。因为农业生产有周期性的滞后影响，随着猪肉价格趋于稳定，物价指数上涨的幅度也会趋于稳定。</p>\r\n<p>\r\n	　　毕井泉说，今年夏粮是丰收的，比上年产量增加了43.9亿斤。秋粮的播种面积也是增加的，目前的长势良好，预计可以取得较好的收成。所以从总体上看，中国的粮食供给是充裕的，保持粮食市场价格稳定的物质基础是具备的。</p>\r\n');
REPLACE INTO `p8_cms_item_paper_addon` VALUES ('53','1020','1','','','新龙船&ldquo;浦江游览1号&rdquo;亮相上海黄浦江　　9月3日，&ldquo;浦江游览1号&rdquo;龙船载着游客在黄浦江上观光。当日，一艘全新的仿古龙船&ldquo;浦江游览1号&rdquo;加入上海黄浦江水上游览运营，以替代&ldquo;','127.0.0.1','127.0.0.1','1379420676','<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-right-color: rgb(153, 153, 153); border-right-style: solid; border-top-color: rgb(153, 153, 153); border-top-style: solid; margin-right: 8px; margin-bottom: 8px; border-left-color: rgb(153, 153, 153); border-left-style: solid; border-bottom-color: rgb(153, 153, 153); border-bottom-style: solid; \" width=\"550\">\r\n	<tbody>\r\n		<tr>\r\n			<td align=\"middle\" bgcolor=\"#e0e0c9\" class=\"px12\" style=\"PADDING-RIGHT: 3px; PADDING-LEFT: 8px; PADDING-BOTTOM: 3px; PADDING-TOP: 8px\">\r\n				<strong>新龙船&ldquo;浦江游览1号&rdquo;亮相上海黄浦江</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td align=\"left\" bgcolor=\"#e0e0c9\" class=\"px12\" style=\"PADDING-RIGHT: 3px; PADDING-LEFT: 8px; PADDING-BOTTOM: 3px; LINE-HEIGHT: 18px; PADDING-TOP: 6px\">\r\n				　　9月3日，&ldquo;浦江游览1号&rdquo;龙船载着游客在黄浦江上观光。当日，一艘全新的仿古龙船&ldquo;浦江游览1号&rdquo;加入上海黄浦江水上游览运营，以替代&ldquo;退役&rdquo;的老龙船。新的&ldquo;浦江游览1号&rdquo;游船长57米、宽17米，额定载客1000</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_photo_` VALUES ('287','photo','137','1','admin','柠檬绿茶★居家高端精品天天低价','','0','','<!--#p8_attach#-->/cms/item/2012_09/02_02/0a397fd572b3d038.jpg.thumb.jpg','','','6,7','柠檬绿茶★居家高端精品天天低价','','','','','','1','','0','1346515200','0','1346515200','1420552016','1','','','330','0','0','','','','');
REPLACE INTO `p8_cms_item_photo_addon` VALUES ('2','287','1','','<!--#p8_attach#-->/cms/item/2012_09/02_02/0a397fd572b3d038.jpg.thumb.jpg','柠檬绿茶★居家高端精品天天低价','113.64.115.80','183.48.66.5','1346515200','柠檬绿茶★居家高端精品天天低价','F251.jpg<!--#p8_attach#-->/cms/item/2012_09/02_02/ed06de3b55b12af0.jpg<!--#p8_attach#-->/cms/item/2012_09/02_02/ed06de3b55b12af0.jpg.thumb.jpgb20113332200502925146.jpg<!--#p8_attach#-->/cms/item/2010_12/08_11/9bda420096b495ab.jpg<!--#p8_attach#-->/cms/item/2010_12/08_11/9bda420096b495ab.jpg.thumb.jpg');
REPLACE INTO `p8_cms_item_video_` VALUES ('281','video','53','1','admin','耶鲁开放课程：古希腊历史简介','','0','','<!--#p8_attach#-->/cms/item/2012_09/01_21/cdd5f3b451774c11.jpg.thumb.jpg','','','6','耶鲁开放课程：古希腊历史简介耶鲁开放课程：古希腊历史简介','','','','','','1','','0','1346507685','0','1346507685','1346507685','1','','','58','0','0','','','','');
REPLACE INTO `p8_cms_item_video_` VALUES ('282','video','53','1','admin','耶鲁开放课程：1871年后的法国','','0','','<!--#p8_attach#-->/cms/item/2012_09/02_02/ed06de3b55b12af0.jpg','','','6','耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国','','','','','','1','','0','1408537248','0','1366685777','1408537248','1','','','83','0','0','','','','');
REPLACE INTO `p8_cms_item_video_` VALUES ('283','video','53','1','admin','麻省理工开放课程：物流管理专题','','0','','<!--#p8_attach#-->/cms/item/2012_09/01_21/82fa47cae98e580b.jpg.thumb.jpg','','','6','麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题','','','','','','1','','0','1346507832','0','1346507832','1346507832','1','','','69','0','0','','','','');
REPLACE INTO `p8_cms_item_video_` VALUES ('284','video','53','1','admin','开放课程：生物医学工程探索（一）','','0','','<!--#p8_attach#-->/cms/item/2014_09/01_17/593cbe81e81c1655.jpg','','','6','开放课程：生物医学工程探索开放课程：生物医学工程探索','','','','','','1','','0','1346428800','0','1346428800','1409565048','1','','','88','0','1','','','','');
REPLACE INTO `p8_cms_item_video_` VALUES ('285','video','53','1','admin','麻省理工学院：算法导论','','0','','<!--#p8_attach#-->/cms/item/2015_01/11_01/e3aaa9ee0334b92a.jpg','','','3,6','麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院','','','','','','1','','0','1346428800','0','1346428800','1431236286','1','','','292','0','0','','','','');
REPLACE INTO `p8_cms_item_video_` VALUES ('1103','video','141','1','admin','耶鲁开放课程：古希腊历史简介','','0','','<!--#p8_attach#-->/cms/item/2012_09/01_21/cdd5f3b451774c11.jpg.thumb.jpg','','','6','耶鲁开放课程：古希腊历史简介耶鲁开放课程：古希腊历史简介','','','','','','1','','0','1582019825','1582019838','1582019825','1582019838','1','','','24','0','0','','','','a:2:{i:0;s:0:\\\"\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_video_` VALUES ('1104','video','141','1','admin','耶鲁开放课程：1871年后的法国','','0','','<!--#p8_attach#-->/cms/item/2012_09/02_02/ed06de3b55b12af0.jpg','','','6','耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国','','','','','','1','','0','1582019825','1582019838','1582019825','1582019838','1','','','8','0','0','','','','a:2:{i:0;s:0:\\\"\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_video_` VALUES ('1105','video','141','1','admin','麻省理工开放课程：物流管理专题','','0','','<!--#p8_attach#-->/cms/item/2012_09/01_21/82fa47cae98e580b.jpg.thumb.jpg','','','6','麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题','','','','','','1','','0','1582019825','1582019838','1582019825','1582019838','1','','','11','0','0','','','','a:2:{i:0;s:0:\\\"\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_video_` VALUES ('1106','video','141','1','admin','开放课程：生物医学工程探索（一）','','0','','<!--#p8_attach#-->/cms/item/2014_09/01_17/593cbe81e81c1655.jpg','','','6','开放课程：生物医学工程探索开放课程：生物医学工程探索','','','','','','1','','0','1582019825','1582019838','1582019825','1582019838','1','','','4','0','0','','','','a:2:{i:0;s:0:\\\"\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_video_` VALUES ('1107','video','141','1','admin','麻省理工学院：算法导论','','0','','<!--#p8_attach#-->/cms/item/2015_01/11_01/e3aaa9ee0334b92a.jpg','','','6','麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院','','','','','','1','','0','1582019825','1582019838','1582019825','1582019838','1','','','3','0','0','','','','a:2:{i:0;s:0:\\\"\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('1','281','1','','<!--#p8_attach#-->/cms/item/2012_09/01_21/cdd5f3b451774c11.jpg.thumb.jpg','耶鲁开放课程：古希腊历史简介耶鲁开放课程：古希腊历史简介','61.144.100.3','61.144.100.3','1346507685','耶鲁开放课程：古希腊历史简介耶鲁开放课程：古希腊历史简介','390','http://v.ifeng.com/include/exterior.swf?AutoPlay=false&amp;guid=53728945-a466-4e2f-96db-6b2183fd79f9','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('2','282','1','','<!--#p8_attach#-->/cms/item/2012_09/02_02/ed06de3b55b12af0.jpg','耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国','61.144.100.3','14.120.228.114','1408537248','耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国','390','http://v.ifeng.com/include/exterior.swf?AutoPlay=false&amp;guid=bebeb228-a16e-44df-a628-6aac1fe05a9a','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('3','283','1','','<!--#p8_attach#-->/cms/item/2012_09/01_21/82fa47cae98e580b.jpg.thumb.jpg','麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题','61.144.100.3','61.144.100.3','1346507832','麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题','390','http://v.ifeng.com/include/exterior.swf?AutoPlay=false&amp;guid=13c7dd6b-0d04-4693-ac7a-cb5b2d4761e0','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('4','284','1','','<!--#p8_attach#-->/cms/item/2014_09/01_17/593cbe81e81c1655.jpg','开放课程：生物医学工程探索开放课程：生物医学工程探索','61.144.100.3','14.121.14.170','1346428800','开放课程：生物医学工程探索开放课程：生物医学工程探索','390','http://v.ifeng.com/include/exterior.swf?AutoPlay=false&amp;guid=0830f73b-71a4-4b31-8301-056806318582','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('5','285','1','','<!--#p8_attach#-->/cms/item/2015_01/11_01/e3aaa9ee0334b92a.jpg','麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院','61.144.100.3','116.22.165.33','1346428800','<p>\r\n	麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论</p>\r\n<p>\r\n	麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论</p>\r\n','390','http://v.ifeng.com/include/exterior.swf?AutoPlay=false&amp;guid=15d02f18-e22a-4a3d-b8b3-be0a2942bbd6','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('7','1103','1','','<!--#p8_attach#-->/cms/item/2012_09/01_21/cdd5f3b451774c11.jpg.thumb.jpg','耶鲁开放课程：古希腊历史简介耶鲁开放课程：古希腊历史简介','36.157.195.180','36.157.195.180','1582019825','耶鲁开放课程：古希腊历史简介耶鲁开放课程：古希腊历史简介','390','http://v.ifeng.com/include/exterior.swf?AutoPlay=false&amp;guid=53728945-a466-4e2f-96db-6b2183fd79f9','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('8','1104','1','','<!--#p8_attach#-->/cms/item/2012_09/02_02/ed06de3b55b12af0.jpg','耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国','36.157.195.180','36.157.195.180','1582019825','耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国','390','http://v.ifeng.com/include/exterior.swf?AutoPlay=false&amp;guid=bebeb228-a16e-44df-a628-6aac1fe05a9a','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('9','1105','1','','<!--#p8_attach#-->/cms/item/2012_09/01_21/82fa47cae98e580b.jpg.thumb.jpg','麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题','36.157.195.180','36.157.195.180','1582019825','麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题','390','http://v.ifeng.com/include/exterior.swf?AutoPlay=false&amp;guid=13c7dd6b-0d04-4693-ac7a-cb5b2d4761e0','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('10','1106','1','','<!--#p8_attach#-->/cms/item/2014_09/01_17/593cbe81e81c1655.jpg','开放课程：生物医学工程探索开放课程：生物医学工程探索','36.157.195.180','36.157.195.180','1582019825','开放课程：生物医学工程探索开放课程：生物医学工程探索','390','http://v.ifeng.com/include/exterior.swf?AutoPlay=false&amp;guid=0830f73b-71a4-4b31-8301-056806318582','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('11','1107','1','','<!--#p8_attach#-->/cms/item/2015_01/11_01/e3aaa9ee0334b92a.jpg','麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院','36.157.195.180','36.157.195.180','1582019825','<p>\r\n	麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论</p>\r\n<p>\r\n	麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论</p>\r\n','390','http://v.ifeng.com/include/exterior.swf?AutoPlay=false&amp;guid=15d02f18-e22a-4a3d-b8b3-be0a2942bbd6','450');
REPLACE INTO `p8_cms_model` VALUES ('1','article','文章内容','0','1','a:7:{s:14:\"prev&next_item\";s:1:\"1\";s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('2','product','产品','0','0','a:7:{s:14:\"prev&next_item\";s:1:\"1\";s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('3','photo','图片内容','0','1','a:7:{s:14:\"prev&next_item\";s:1:\"1\";s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:3:\"900\";s:20:\"content_thumb_height\";s:3:\"700\";}');
REPLACE INTO `p8_cms_model` VALUES ('9','govopen','信息公开','0','1','a:0:{}');
REPLACE INTO `p8_cms_model` VALUES ('10','paper','数字报刊','0','0','a:7:{s:14:\"prev&next_item\";s:1:\"1\";s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('6','people','人物','0','0','a:6:{s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('4','video','视频内容','0','1','a:7:{s:12:\"allow_custom\";s:1:\"0\";s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:3:\"800\";s:18:\"frame_thumb_height\";s:3:\"480\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('5','down','下载内容','0','1','a:9:{s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";s:11:\"hidedownurl\";s:1:\"0\";s:9:\"thunderid\";s:0:\"\";s:10:\"flashgetid\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('8','zlku','资料宝库','0','0','a:6:{s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('11','page','单网页','0','1','a:0:{}');
REPLACE INTO `p8_cms_model_field` VALUES ('1','article','0','content','内容','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','ueditor','','99','','');
REPLACE INTO `p8_cms_model_field` VALUES ('8','photo','0','content','内容','mediumtext','0','0','0','0','','0','1','','a:0:{}','a:0:{}','editor','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('3','product','0','aboutinfo','试用与预订','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor_common','','9','','');
REPLACE INTO `p8_cms_model_field` VALUES ('4','product','0','attrbutes','产品参数','text','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor_basic','','88','','');
REPLACE INTO `p8_cms_model_field` VALUES ('5','product','0','content','产品介绍','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor_common','','99','','');
REPLACE INTO `p8_cms_model_field` VALUES ('6','product','0','pics','图片欣赏','text','0','0','0','1','','0','1','','a:0:{}','a:0:{}','multi_uploader','','6','','');
REPLACE INTO `p8_cms_model_field` VALUES ('7','product','0','pro_down','相关下载','varchar','0','0','0','0','255','0','1','','a:0:{}','a:0:{}','uploader','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('48','govopen','0','content','内容','mediumtext','0','0','0','1','0','0','1','','a:0:{}','a:0:{}','editor','','99','','');
REPLACE INTO `p8_cms_model_field` VALUES ('9','photo','0','photourl','图片地址','text','0','0','0','1','','0','1','','a:0:{}','a:0:{}','multi_uploader','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('10','video','0','content','内容','mediumtext','0','0','0','1','0','0','1','','a:0:{}','a:0:{}','editor','','99','','');
REPLACE INTO `p8_cms_model_field` VALUES ('11','video','0','video_height','视频高度','smallint','0','0','0','1','5','0','1','390','a:0:{}','a:0:{}','text','','77','像素','');
REPLACE INTO `p8_cms_model_field` VALUES ('47','zlku','0','totaldown','总下载量','mediumint','0','0','0','1','5','0','0','','a:0:{}','a:0:{}','text','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('40','zlku','0','content','资源介绍','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor','','33','','');
REPLACE INTO `p8_cms_model_field` VALUES ('50','govopen','0','geshi','格式','tinyint','1','1','0','1','3','0','1','','a:7:{i:1;s:3:\"DOC\";i:2;s:3:\"TXT\";i:3;s:3:\"JPG\";i:4;s:3:\"PDF\";i:5;s:3:\"MP3\";i:6;s:4:\"MPEG\";i:7;s:4:\"其它\";}','a:0:{}','select','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('12','video','0','video_url','视频地址','varchar','0','0','0','0','255','0','1','http://','a:0:{}','a:2:{s:11:\"thumb_width\";s:3:\"120\";s:12:\"thumb_height\";s:2:\"90\";}','video_uploader','','66','','');
REPLACE INTO `p8_cms_model_field` VALUES ('13','video','0','video_width','视频宽度','smallint','0','0','0','1','5','0','1','450','a:0:{}','a:0:{}','text','','88','像素','');
REPLACE INTO `p8_cms_model_field` VALUES ('14','down','0','content','资源介绍','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor','','33','','');
REPLACE INTO `p8_cms_model_field` VALUES ('44','zlku','0','softlanguage','所属科目','tinyint','0','0','0','1','3','0','1','','a:9:{i:1;s:4:\"语言\";i:2;s:4:\"数学\";i:3;s:4:\"英语\";i:4;s:4:\"政治\";i:5;s:4:\"化学\";i:6;s:4:\"物理\";i:7;s:4:\"生物\";i:8;s:4:\"综合\";i:9;s:8:\"其他科目\";}','a:0:{}','select','','66','','');
REPLACE INTO `p8_cms_model_field` VALUES ('55','govopen','0','wenhao','文号','varchar','1','0','0','0','255','0','1','','a:0:{}','a:0:{}','text','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('57','govopen','0','xinxifenlei','信息分类','varchar','0','0','0','1','50','0','1','','a:0:{}','a:0:{}','text','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('58','paper','0','content','内容','mediumtext','0','0','0','1','0','0','1','','a:0:{}','a:0:{}','editor','','99','','');
REPLACE INTO `p8_cms_model_field` VALUES ('24','people','0','award','获奖荣誉','mediumtext','0','0','0','0','','0','1','','a:0:{}','a:0:{}','editor_common','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('19','down','0','softsize','资源大小','varchar','0','0','0','1','10','0','1','','a:0:{}','a:0:{}','text','','55','K','');
REPLACE INTO `p8_cms_model_field` VALUES ('20','down','0','softurl','资源地址','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','uploader','','44','','');
REPLACE INTO `p8_cms_model_field` VALUES ('21','down','0','totaldown','总下载量','mediumint','0','0','0','1','5','0','0','','a:0:{}','a:0:{}','text','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('28','people','0','education','学历','varchar','0','0','0','1','255','0','1','','a:0:{}','a:0:{}','text','','6','','');
REPLACE INTO `p8_cms_model_field` VALUES ('29','people','0','event','人物事迹','mediumtext','0','0','0','0','','0','1','','a:0:{}','a:0:{}','editor_common','','2','','');
REPLACE INTO `p8_cms_model_field` VALUES ('25','people','0','birthday','出生日期','varchar','0','0','0','1','255','0','1','','a:0:{}','a:0:{}','text','','7','','');
REPLACE INTO `p8_cms_model_field` VALUES ('26','people','0','content','人物介绍','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor_common','','2','','');
REPLACE INTO `p8_cms_model_field` VALUES ('27','people','0','department','部门','varchar','1','1','1','1','255','0','1','','a:0:{}','a:0:{}','text','','5','','');
REPLACE INTO `p8_cms_model_field` VALUES ('34','people','0','photo','照片','text','0','0','0','1','','0','1','','a:0:{}','a:0:{}','image_uploader','','3','','照片大小：148*220');
REPLACE INTO `p8_cms_model_field` VALUES ('30','people','0','Hometown','籍贯','varchar','0','0','0','1','255','0','1','','a:0:{}','a:0:{}','text','','8','','');
REPLACE INTO `p8_cms_model_field` VALUES ('31','people','0','motion','企业提案','mediumtext','0','0','0','0','','0','1','','a:0:{}','a:0:{}','editor_common','','1','','');
REPLACE INTO `p8_cms_model_field` VALUES ('33','people','0','office','职务','varchar','0','0','0','1','255','0','1','','a:0:{}','a:0:{}','text','','4','','');
REPLACE INTO `p8_cms_model_field` VALUES ('32','people','0','name','姓名','varchar','1','1','1','1','255','0','1','','a:0:{}','a:0:{}','text','','9','','');
REPLACE INTO `p8_cms_model_field` VALUES ('49','govopen','0','duixiang','对象','tinyint','1','1','0','1','3','0','1','','a:3:{i:1;s:4:\"学生\";i:2;s:4:\"老师\";i:9;s:4:\"其它\";}','a:0:{}','select','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('45','zlku','0','softsize','资源大小','varchar','0','0','0','1','10','0','1','','a:0:{}','a:0:{}','text','','55','K','');
REPLACE INTO `p8_cms_model_field` VALUES ('46','zlku','0','softurl','资源地址','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','uploader','','44','','');
REPLACE INTO `p8_cms_model_field` VALUES ('41','zlku','0','copyright','适用年级','tinyint','0','0','0','1','3','0','1','','a:6:{i:1;s:6:\"一年级\";i:2;s:6:\"二年级\";i:3;s:6:\"三年级\";i:4;s:6:\"四年级\";i:5;s:6:\"五年级\";i:6;s:6:\"六年级\";}','a:0:{}','select','','77','','');
REPLACE INTO `p8_cms_model_field` VALUES ('51','govopen','0','jigou','机构分类','tinyint','1','1','0','1','3','0','1','','a:11:{i:1;s:16:\"广州市天河区政府\";i:2;s:16:\"广州市越秀区政府\";i:3;s:16:\"广州市东山区政府\";i:4;s:16:\"广州市白云区政府\";i:5;s:16:\"广州市黄埔区政府\";i:6;s:16:\"广州市花都区政府\";i:7;s:16:\"广州市海珠区政府\";i:8;s:16:\"广州市南沙区政府\";i:9;s:16:\"广州市荔湾区政府\";i:10;s:16:\"广州市番禺区政府\";i:11;s:16:\"广州市萝岗区政府\";}','a:0:{}','select','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('52','govopen','0','shengming','生命周期','tinyint','1','1','0','1','3','0','1','','a:5:{i:1;s:6:\"婴幼儿\";i:2;s:6:\"青少年\";i:3;s:4:\"中年\";i:4;s:4:\"老年\";i:5;s:4:\"其它\";}','a:0:{}','select','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('53','govopen','0','suoyin','索引号','varchar','1','0','0','1','255','0','1','','a:0:{}','a:0:{}','text','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('54','govopen','0','ticai','体裁','tinyint','1','1','0','1','3','0','1','','a:14:{i:1;s:4:\"命令\";i:2;s:4:\"决定\";i:3;s:4:\"通告\";i:4;s:4:\"通知\";i:5;s:4:\"公告\";i:6;s:4:\"通报\";i:7;s:4:\"议案\";i:8;s:4:\"报告\";i:9;s:4:\"请示\";i:10;s:4:\"批复\";i:11;s:4:\"意见\";i:12;s:2:\"函\";i:13;s:8:\"会议纪要\";i:14;s:4:\"其它\";}','a:0:{}','select','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('59','page','0','content','','mediumtext','0','0','0','1','0','0','1','','a:0:{}','a:0:{}','editor','','99','','');
REPLACE INTO `p8_config` VALUES ('cms','','string','forbidden_dynamic','0');
REPLACE INTO `p8_config` VALUES ('cms','','string','index_to_html_crontab_id','');
REPLACE INTO `p8_config` VALUES ('cms','','string','index_file','1');
REPLACE INTO `p8_config` VALUES ('cms','item','string','dynamic_list_url_rule','{$module_controller}-list-category-{$id}#-page-{$page}#.shtml');
REPLACE INTO `p8_config` VALUES ('cms','item','string','dynamic_view_url_rule','{$module_controller}-view-id-{$id}#-page-{$page}#.shtml');
REPLACE INTO `p8_config` VALUES ('cms','item','string','dynamic_homepage_list_url_rule','{$URL}#-page-{$page}#.shtml');
REPLACE INTO `p8_config` VALUES ('cms','item','string','list_page_cacle_ttl','0');
REPLACE INTO `p8_config` VALUES ('cms','item','string','view_page_cacle_ttl','0');
REPLACE INTO `p8_config` VALUES ('cms','item','string','allow_comment','1');
REPLACE INTO `p8_config` VALUES ('cms','item','string','allow_mood','0');
REPLACE INTO `p8_config` VALUES ('cms','item','string','list_navigagion','nav_list02');
REPLACE INTO `p8_config` VALUES ('cms','item','string','allow_digg','1');
REPLACE INTO `p8_config` VALUES ('cms','item','string','first_img_to_frame','1');
REPLACE INTO `p8_config` VALUES ('cms','item','serialize','comment','a:4:{s:7:\"enabled\";s:1:\"0\";s:14:\"require_verify\";s:1:\"0\";s:9:\"page_size\";s:2:\"20\";s:14:\"view_page_size\";s:1:\"5\";}');
REPLACE INTO `p8_config` VALUES ('cms','item','serialize','sphinx','a:3:{s:7:\"enabled\";s:1:\"0\";s:4:\"host\";s:9:\"localhost\";s:4:\"port\";s:4:\"3312\";}');
REPLACE INTO `p8_config` VALUES ('cms','item','string','template','school813');
REPLACE INTO `p8_config` VALUES ('cms','item','string','htmlize','0');
REPLACE INTO `p8_config` VALUES ('cms','item','serialize','verify_acl','a:5:{i:2;a:2:{s:4:\"name\";s:6:\"初审\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}i:1;a:2:{s:4:\"name\";s:6:\"终审\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}i:0;a:2:{s:4:\"name\";s:12:\"取消审核\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}i:88;a:2:{s:4:\"name\";s:9:\"回收站\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}i:-99;a:2:{s:4:\"name\";s:6:\"退稿\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}}');
REPLACE INTO `p8_config` VALUES ('cms','','string','base_domain','');
REPLACE INTO `p8_config` VALUES ('cms','','string','domain','');
REPLACE INTO `p8_config` VALUES ('cms','','string','index_page_cache_ttl','0');
REPLACE INTO `p8_config` VALUES ('cms','','string','table_prefix','');
REPLACE INTO `p8_config` VALUES ('cms','item','serialize','attribute_acl','a:8:{i:1;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}i:2;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}i:3;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}i:4;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}i:5;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}i:6;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}i:7;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}i:8;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}}');
REPLACE INTO `p8_config` VALUES ('cms','item','string','list_page_cache_ttl','0');
REPLACE INTO `p8_config` VALUES ('cms','item','string','view_page_cache_ttl','0');
REPLACE INTO `p8_config` VALUES ('cms','','string','mobile_template','mobile/red');
REPLACE INTO `p8_config` VALUES ('cms','item','string','mobile_template','mobile/red');
REPLACE INTO `p8_config` VALUES ('cms','','string','template','school813');