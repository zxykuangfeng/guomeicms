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
  `need_password` tinyint(1) NOT NULL DEFAULT '0',
  `category_password` varchar(32) NOT NULL DEFAULT '',
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
  `url` varchar(255) NOT NULL DEFAULT '',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `username` varchar(50) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `pages` smallint(5) unsigned NOT NULL DEFAULT '1',
  `html_view_url_rule` varchar(80) NOT NULL DEFAULT '',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `source` varchar(255) NOT NULL DEFAULT '',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
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
  KEY `level` (`level`,`list_order`),
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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

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
  `url` varchar(100) NOT NULL DEFAULT '',
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
  `fileno` varchar(255) NOT NULL,
  `editer` varchar(20) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `indexno` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `issued` varchar(255) NOT NULL,
  `sxlb` varchar(255) NOT NULL,
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
  `opendate` varchar(255) NOT NULL,
  `recorder` varchar(255) NOT NULL,
  `toushu` varchar(255) NOT NULL,
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
  KEY `level` (`level`,`list_order`),
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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
  `url` varchar(100) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
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

DROP TABLE IF EXISTS `p8_cms_item_search`;
CREATE TABLE `p8_cms_item_search` (
  `id` int(10) unsigned NOT NULL,
  `search` mediumtext NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`,`timestamp`)
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
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `verifier` varchar(50) NOT NULL DEFAULT '',
  `ever_verified` tinyint(1) NOT NULL DEFAULT '0',
  `data` longtext NOT NULL,
  `push_back_reason` varchar(255) NOT NULL DEFAULT '',
  `push_item_id` int(11) NOT NULL DEFAULT '0',
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

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
REPLACE INTO `p8_cluster_server_cms_item_category` VALUES ('1','0','公告','0','0');
REPLACE INTO `p8_cluster_server_cms_item_category` VALUES ('2','0','新闻','0','0');
REPLACE INTO `p8_cluster_service` VALUES ('client','server','P8_Cluster_Client_S','客户端相关服务','1','1','0','0');
REPLACE INTO `p8_cluster_service` VALUES ('cms_item','server','P8_Cluster_CMS_Item_S','站群内容推送','1','1','1','0');
REPLACE INTO `p8_cluster_service` VALUES ('test','server','P8_Cluster_Test_S','测试服务端通信','1','1','0','0');
REPLACE INTO `p8_cluster_service` VALUES ('admin','client','P8_Cluster_Admin_C','管理员管理','1','1','1','0');
REPLACE INTO `p8_cluster_service` VALUES ('client','client','P8_Cluster_Client_C','客户端相关服务','1','1','0','0');
REPLACE INTO `p8_cluster_service` VALUES ('cms_item','client','P8_Cluster_CMS_Item_C','分站内容接收','1','1','0','1');
REPLACE INTO `p8_cluster_service` VALUES ('test','client','P8_Cluster_Test_C','测试客户端通信','1','1','0','0');
REPLACE INTO `p8_cluster_service_config` VALUES ('server','cms_item','string','auto_receive','1');
REPLACE INTO `p8_cluster_service_config` VALUES ('client','cms_item','serialize','map','a:2:{i:1;i:128;i:2;i:34;}');
REPLACE INTO `p8_cluster_service_config` VALUES ('client','cms_item','string','auto_verify','0');
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
REPLACE INTO `p8_cms_attachment` VALUES ('226','item','0','1','QQ截图20150727004208.png','image/x-png','png','125169','218.108.128.21','cms/item/2015_07/27_00/06864bf358037e68.png','1','0','1437929017');
REPLACE INTO `p8_cms_attachment` VALUES ('227','item','1093','1','MP4.mp4','application/octet-stream','mp4','1140279','175.9.118.184','cms/item/2015_08/11_14/105ab9e347102bac.mp4','0','0','1439273033');
REPLACE INTO `p8_cms_attachment` VALUES ('228','item','0','1','1439914434140924.png','image/png','png','47011','175.9.117.90','ueditor/image/20150819/1439914434140924.png','0','0','1439914435');
REPLACE INTO `p8_cms_attachment` VALUES ('229','item','0','1','1439914491119124.png','image/png','png','136950','175.9.117.90','ueditor/image/20150819/1439914491119124.png','0','0','1439914491');
REPLACE INTO `p8_cms_attachment` VALUES ('230','item','0','1','Chrysanthemum.jpg','image/jpeg','jpg','879394','119.131.76.147','cms/item/2015_09/05_23/cf6fa1072b5aa4ac.jpg','2','0','1441468054');
REPLACE INTO `p8_cms_attachment` VALUES ('233','item','0','1','1443226203370933.jpg','image/jpeg','jpg','63530','175.9.116.4','ueditor/image/20150926/1443226203370933.jpg','0','0','1443226203');
REPLACE INTO `p8_cms_attachment` VALUES ('234','item','0','1','1444295319422012.jpg','image/jpeg','jpg','36084','117.36.28.161','ueditor/image/20151008/1444295319422012.jpg','0','0','1444295319');
REPLACE INTO `p8_cms_attachment` VALUES ('235','item','0','1','1444295331399722.jpg','image/jpeg','jpg','36084','117.36.28.161','ueditor/image/20151008/1444295331399722.jpg','0','0','1444295331');
REPLACE INTO `p8_cms_attachment` VALUES ('236','item','0','1','024.jpg','image/pjpeg','jpg','114475','183.184.23.235','cms/item/2015_10/29_16/376cc2bb49a3b2c3.jpg','2','0','1446108679');
REPLACE INTO `p8_cms_attachment` VALUES ('237','item','0','1','1446422471587642.jpg','image/jpeg','jpg','401013','119.44.8.195','ueditor/image/20151102/1446422471587642.jpg','0','0','1446422471');
REPLACE INTO `p8_cms_attachment` VALUES ('238','item','1127','1','99科技厅.swf','application/x-shockwave-flash','swf','630878','175.13.253.8','cms/item/2016_02/24_16/3019b35b081c653f.swf','0','0','1456304158');
REPLACE INTO `p8_cms_attachment` VALUES ('239','item','1128','1','网络问政演示.jpg','image/pjpeg','jpg','50799','175.13.253.8','cms/item/2016_02/24_16/d50b79e1c026ab92.jpg','0','0','1456304234');
REPLACE INTO `p8_cms_attachment` VALUES ('240','item','1130','1','网络问政演示.jpg','image/pjpeg','jpg','50799','175.13.253.8','cms/item/2016_02/24_18/04cf85279bd3a651.jpg','0','0','1456308360');
REPLACE INTO `p8_cms_attachment` VALUES ('241','item','1130','1','网络问政演示.jpg','image/pjpeg','jpg','50799','175.13.253.8','cms/item/2016_02/24_18/3f7aca24b1d15654.jpg','0','0','1456308375');
REPLACE INTO `p8_cms_attachment` VALUES ('242','item','1142','1','iconred4.gif','image/gif','gif','45','115.29.136.133','cms/item/2016_05/23_06/613ab0e9d84bbbd8.gif','0','0','1463957606');
REPLACE INTO `p8_cms_attachment` VALUES ('243','item','1142','1','logo.png','image/png','png','23324','115.29.136.133','cms/item/2016_05/23_06/9e39cef95d2b023d.png','1','0','1463957638');
REPLACE INTO `p8_cms_attachment` VALUES ('244','item','1148','1','info1.jpg','image/jpeg','jpg','40903','118.249.32.140','cms/item/2017_01/21_14/77ccbc0d7290ad0c.jpg','1','0','1484981327');
REPLACE INTO `p8_cms_attachment` VALUES ('245','item','1160','1','leadjpg_03.jpg','image/jpeg','jpg','4186','118.249.34.29','cms/item/2017_02/17_09/0632f21ab2ee08dd.jpg','0','0','1487295933');
REPLACE INTO `p8_cms_attachment` VALUES ('246','item','1161','1','lead2_03.jpg','image/jpeg','jpg','5023','118.249.34.29','cms/item/2017_02/17_09/5bce7731b94874f8.jpg','0','0','1487296074');
REPLACE INTO `p8_cms_attachment` VALUES ('247','item','1166','1','b37659ba476b76d0.jpg','image/pjpeg','jpg','81294','113.246.92.14','cms/item/2017_05/21_00/76a5dbd20e0d0b88.jpg','1','0','1495297069');
REPLACE INTO `p8_cms_attachment` VALUES ('248','item','1169','1','01300000345731129570279669230.jpg','image/jpeg','jpg','59274','113.246.92.137','cms/item/2017_05/21_10/d73a8c8ced19f989.jpg','2','0','1495332709');
REPLACE INTO `p8_cms_attachment` VALUES ('249','item','1170','1','01300000376166124072512161187.jpg','image/pjpeg','jpg','313323','113.246.92.137','cms/item/2017_05/21_10/af32a2c6aa3e9b9a.jpg','2','0','1495332814');
REPLACE INTO `p8_cms_attachment` VALUES ('250','item','1175','1','001YRz1jzy6TQzP9jkt49&690.jpg','image/pjpeg','jpg','318049','113.246.92.137','cms/item/2017_05/22_06/cd2129dbb3b55922.jpg','2','0','1495405877');
REPLACE INTO `p8_cms_attachment` VALUES ('251','item','1175','1','001YRz1jzy6TQzP9jkt49&690.jpg','image/pjpeg','jpg','318049','113.246.92.137','cms/item/2017_05/22_06/095e2bccd17c0d22.jpg','2','0','1495405939');
REPLACE INTO `p8_cms_attachment` VALUES ('252','item','1166','1','76a5dbd20e0d0b88 (1).jpg','image/pjpeg','jpg','81294','113.247.22.211','cms/item/2017_05/25_15/86f95d5285b5a75d.jpg','1','0','1495696439');
REPLACE INTO `p8_cms_attachment` VALUES ('253','item','1176','1','d73a8c8ced19f989 (1).jpg','image/pjpeg','jpg','59274','113.247.22.211','cms/item/2017_05/25_15/06a6c6ccb5ef875a.jpg','2','0','1495696504');
REPLACE INTO `p8_cms_attachment` VALUES ('254','item','1169','1','d73a8c8ced19f989.jpg','image/pjpeg','jpg','59274','113.247.22.211','cms/item/2017_05/25_15/684ad1d384be82c7.jpg','2','0','1495696577');
REPLACE INTO `p8_cms_attachment` VALUES ('255','item','1169','1','d73a8c8ced19f989.jpg','image/pjpeg','jpg','59274','113.247.22.211','cms/item/2017_05/25_15/b89dd5c0f3862d28.jpg','2','0','1495696586');
REPLACE INTO `p8_cms_attachment` VALUES ('256','item','1176','1','d73a8c8ced19f989.jpg','image/pjpeg','jpg','59274','113.247.22.211','cms/item/2017_05/25_15/18cac615f26e9fac.jpg','2','0','1495696616');
REPLACE INTO `p8_cms_attachment` VALUES ('257','item','1166','1','76a5dbd20e0d0b88 (2).jpg','image/pjpeg','jpg','81294','113.247.22.211','cms/item/2017_05/25_15/6f7444a355a7d2a3.jpg','1','0','1495696669');
REPLACE INTO `p8_cms_attachment` VALUES ('258','item','1168','1','1e545c87a71e55bf.jpg.cthumb.jpg','image/jpeg','jpg','80043','113.247.22.211','cms/item/2017_05/25_17/0dd57f3e9319a535.jpg','2','0','1495705497');
REPLACE INTO `p8_cms_attachment` VALUES ('259','item','1168','1','timg.jpg','image/jpeg','jpg','91456','113.247.22.211','cms/item/2017_05/25_17/f08975bb70e76dcd.jpg','2','0','1495705728');
REPLACE INTO `p8_cms_attachment` VALUES ('260','item','1187','1','a.jpg','image/jpeg','jpg','24984','113.246.94.58','cms/item/2017_07/27_14/c7dbb3c44f1a9192.jpg','1','0','1501138033');
REPLACE INTO `p8_cms_attachment` VALUES ('261','item','1188','1','c.jpg','image/jpeg','jpg','8117','113.246.94.58','cms/item/2017_07/27_14/d42072e91a45aa7b.jpg','0','0','1501138154');
REPLACE INTO `p8_cms_attachment` VALUES ('262','item','1189','1','国微.jpg','image/jpeg','jpg','10982','113.246.94.58','cms/item/2017_07/27_14/d9e66c4bd1e07169.jpg','0','0','1501138255');
REPLACE INTO `p8_cms_attachment` VALUES ('263','item','1190','1','国微2.jpg','image/jpeg','jpg','6721','113.246.94.58','cms/item/2017_07/27_14/f7afd5ca201141d8.jpg','0','0','1501138308');
REPLACE INTO `p8_cms_attachment` VALUES ('264','item','1191','1','国微3.jpg','image/jpeg','jpg','10589','113.246.94.58','cms/item/2017_07/27_14/37ef06e9c33d0eee.jpg','0','0','1501138396');
REPLACE INTO `p8_cms_attachment` VALUES ('265','item','1192','1','动态1.jpg','image/jpeg','jpg','36745','113.246.94.58','cms/item/2017_07/27_15/ac93d74478454a86.jpg','2','0','1501141073');
REPLACE INTO `p8_cms_attachment` VALUES ('266','item','1192','1','动态1.jpg','image/jpeg','jpg','36745','113.246.94.58','cms/item/2017_07/27_15/b699e9743fe19c84.jpg','2','0','1501141131');
REPLACE INTO `p8_cms_attachment` VALUES ('267','item','1192','1','动态1.jpg','image/jpeg','jpg','36745','113.246.94.58','cms/item/2017_07/27_15/9002a6403aac95ed.jpg','2','0','1501141196');
REPLACE INTO `p8_cms_attachment` VALUES ('268','item','1193','1','动态2.jpg','image/jpeg','jpg','7559','113.246.94.58','cms/item/2017_07/27_15/12faad1c9ec4802c.jpg','0','0','1501141340');
REPLACE INTO `p8_cms_attachment` VALUES ('269','item','1194','1','动态3.jpg','image/jpeg','jpg','416530','113.246.94.58','cms/item/2017_07/27_15/a886c4481f6864e9.jpg','2','0','1501141429');
REPLACE INTO `p8_cms_attachment` VALUES ('270','item','1194','1','动态3.jpg','image/jpeg','jpg','416530','113.246.94.58','cms/item/2017_07/27_15/dec8d35c035eea84.jpg','2','0','1501141444');
REPLACE INTO `p8_cms_attachment` VALUES ('271','item','1195','1','动态4.jpg','image/jpeg','jpg','38304','113.246.94.58','cms/item/2017_07/27_15/86405a2e8735b713.jpg','2','0','1501141548');
REPLACE INTO `p8_cms_attachment` VALUES ('272','item','1195','1','动态4.jpg','image/jpeg','jpg','38304','113.246.94.58','cms/item/2017_07/27_15/10708333bdf103eb.jpg','2','0','1501141560');
REPLACE INTO `p8_cms_attachment` VALUES ('273','item','1196','1','4.png','image/x-png','png','97325','113.247.22.86','cms/item/2017_07/29_11/31275d7b4d2fbbb2.png','1','0','1501300425');
REPLACE INTO `p8_cms_attachment` VALUES ('274','item','1196','1','14.jpg','image/pjpeg','jpg','63214','113.247.22.86','cms/item/2017_07/29_11/149d34335c6b821f.jpg','2','0','1501300445');
REPLACE INTO `p8_cms_attachment` VALUES ('275','item','1197','1','13.jpg','image/pjpeg','jpg','176799','113.247.22.86','cms/item/2017_07/29_11/2f1b42ec4d83b823.jpg','2','0','1501300471');
REPLACE INTO `p8_cms_attachment` VALUES ('276','item','1197','1','3.png','image/x-png','png','1666164','113.247.22.86','cms/item/2017_07/29_11/e286fd5b56fbba97.png','2','0','1501300485');
REPLACE INTO `p8_cms_attachment` VALUES ('277','item','1198','1','2.png','image/x-png','png','1199717','113.247.22.86','cms/item/2017_07/29_11/684aa815569c45f3.png','2','0','1501300513');
REPLACE INTO `p8_cms_attachment` VALUES ('278','item','1198','1','2.png','image/x-png','png','1199717','113.247.22.86','cms/item/2017_07/29_11/05cfca56d7f7a132.png','2','0','1501300534');
REPLACE INTO `p8_cms_attachment` VALUES ('279','item','1199','1','11.jpg','image/pjpeg','jpg','118461','113.247.22.86','cms/item/2017_07/29_11/f56160a401c549c3.jpg','2','0','1501300562');
REPLACE INTO `p8_cms_attachment` VALUES ('280','item','1199','1','1.png','image/x-png','png','1206338','113.247.22.86','cms/item/2017_07/29_11/3fde38399d11c656.png','2','0','1501300592');
REPLACE INTO `p8_cms_attachment` VALUES ('281','item','1203','3','7.jpg','image/jpeg','jpg','1012434','113.246.108.183','cms/item/2019_09/06_15/49de3f89ff01aedc.jpg','2','0','1567754885');
REPLACE INTO `p8_cms_attachment` VALUES ('282','item','1203','3','012.jpg','image/jpeg','jpg','56705','113.246.108.183','cms/item/2019_09/06_15/5d430e7f54ced2ac.jpg','2','0','1567755534');
REPLACE INTO `p8_cms_attachment` VALUES ('283','item','1210','1','66324c54d712aa34cb135a1c532eb6a1af30375fd005f-w7JT4J_fw658.jpg','image/jpeg','jpg','128997','113.246.187.77','cms/item/2019_09/10_16/dc1cafab37ab3e13.jpg','0','0','1568103238');
REPLACE INTO `p8_cms_attachment` VALUES ('284','item','1213','1','u=2000861150,2848081289&fm=26&gp=0.jpg','image/jpeg','jpg','179888','113.246.187.77','cms/item/2019_09/10_16/bd54ceedfdd26120.jpg','1','0','1568105014');
REPLACE INTO `p8_cms_attachment` VALUES ('285','item','1211','1','1538896846-aYbpqxrkjs.jpg','image/jpeg','jpg','383954','113.246.187.77','cms/item/2019_09/10_16/e4f4dfc3fe547650.jpg','2','0','1568105092');
REPLACE INTO `p8_cms_attachment` VALUES ('286','item','1212','1','1519971850-ODrZXFiopJ.jpg','image/jpeg','jpg','329818','113.246.187.77','cms/item/2019_09/10_16/b316fb02256ac09a.jpg','2','0','1568105120');
REPLACE INTO `p8_cms_attachment` VALUES ('287','item','1214','1','b57a2ce136b4ea15186c119d42894b1fcb4ce3d47c7d-NgNIAb_fw658.jpg','image/jpeg','jpg','21260','113.246.187.77','cms/item/2019_09/10_16/20cf522da97a3a4f.jpg','0','0','1568105146');
REPLACE INTO `p8_cms_category` VALUES ('15','0','站内公告','z','article','','','','1','6','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhanneigonggao','20','article/list','article/list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list','0','','','','0','','0','a:5:{s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";}');
REPLACE INTO `p8_cms_category` VALUES ('838','832','学校设施','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','gonggongfuwu/xuexiaoxiaoli','30','article/list1','article/list_mobile4','article/view1-2','article/view_mobile','common/ico_title/list016','mobile/list4','10','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('45','0','招生就业','z','article','','','','1','6','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','yuanwugongkai','30','article/big_list','article/list_jigou','article/view','article/view_mobile','common/ico_title/list016','mobile/list','200','','','','0','','1','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('46','0','人才培养','r','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xuekejianshe','20','article/big_list','article/big_list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','215','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('49','0','合作交流','h','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhaoshengjiuye','20','article/list_hezuo','article/list_mobile8','article/view','article/view','cms/article/list','mobile/list','190','','','category_801','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('840','831','通知公告','t','article','','','','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun/xueshujiangzuo','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','6','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('874','819','科研成果','k','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhaoshengpeiyang/xueshujiangzuo','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','1','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('67','0','师资队伍','s','article','','','','1','5','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','keyandongtai','20','article/big_list_shizhi','article/big_list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list','230','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('834','832','办公电话','b','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','gonggongfuwu/bangongdianhua','30','article/list1','article/list','article/view1-2','article/view','common/ico_title/list016','mobile/list','8','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('833','832','学校校历','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','gonggongfuwu/xuexiaoxiaoli','30','article/list1','article/list_mobile4','article/view1-2','article/view_mobile','common/ico_title/list016','mobile/list3','6','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('873','716','奖助贷勤','j','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueshenggongzuo/xueshujiangzuo','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','4','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('783','776','联系我们','l','page','','','','4','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueyuangaikuang/lianxiwomen','30','page/list3','page/list','page/view','page/view','cms/page/list','mobile/list','6','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('836','832','信息公开','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','gonggongfuwu/xinxigongkai','30','article/list1','article/list_mobile4','article/view1-2','article/view_mobile','common/ico_title/list016','mobile/list3','4','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('837','832','院报','y','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','gonggongfuwu/yuanbao','30','article/list1','article/list_mobile4','article/view1-2','article/view_mobile','common/ico_title/list016','mobile/list3','2','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('143','0','下载中心','x','down','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xiazaizhongxin','20','down/big_list','down/list_mobile','down/view','down/view_mobile','common/ico_title/list016','mobile/list','35','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('149','143','其他下载','q','down','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xiazaizhongxin/qitaxiazai','30','article/list','down/list_mobile','down/view','down/view_mobile','common/ico_title/list016','mobile/list','0','','','category_144','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('867','0','重点学科','z','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun','30','article/big_list','article/big_list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list3','225','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('868','867','学科专业','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun/xueyuanlingdao','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/pic_title_summary/list025','mobile/list3','8','','','category_868','0','','0','a:13:{s:6:\"target\";s:5:\"_self\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('869','867','学科平台','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun/xueshujiangzuo','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','4','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('870','867','重点学科','z','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun/tongzhigonggao','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','6','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('146','143','文档下载','w','down','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xiazaizhongxin/wendangxiazai','30','down/list','down/list_mobile','down/view','down/view_mobile','common/ico_title/list016','mobile/list','7','','','category_144','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('148','143','表格下载','b','down','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xiazaizhongxin/biaogexiazai','20','down/list','down/list_mobile','down/view','down/view_mobile','common/ico_title/list016','mobile/list','3','','','category_144','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('716','0','学生工作','x','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueshenggongzuo','20','article/list_bumen3','article/big_list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list3','170','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('857','846','校友','x','page','','','','4','1','0','{$core_url}/html/xiaoyou.html','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','fangwenshenfen/xiaoyou','30','page/list2','page/list','page/view','page/view','cms/page/list','mobile/list','4','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('889','0','专题专栏','z','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhuantizhuanlan','30','article/big_list','article/big_list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list','0','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('858','846','考生及访客','k','page','','','','4','1','0','{$core_url}/html/kaosheng.html','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','fangwenshenfen/kaoshengjifangke','30','page/list2','page/list','page/view','page/view','cms/page/list','mobile/list','2','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('847','846','学生','x','page','','','','4','1','0','{$core_url}/html/xuesheng.html','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','fangwenshenfen/xuesheng','30','page/list2','page/list','page/view','page/view','cms/page/list','mobile/list','8','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('878','45','招生动态','z','article','','','','2','6','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','yuanwugongkai/zhaoshengdongtai','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','3','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('856','846','教职工','j','page','','','','4','1','0','{$core_url}/html/jiaozhigong.html','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','fangwenshenfen/jiaozhigong','30','page/list2','page/list','page/view','page/view','cms/page/list','mobile/list','6','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('875','819','教学管理','j','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhaoshengpeiyang/xueshujiangzuo','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','6','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('876','716','学子风采','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueshenggongzuo/xueshujiangzuo','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','2','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('877','716','学工动态','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueshenggongzuo/xueshujiangzuo','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','10','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('776','0','学院概况','x','article','','','','1','4','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueyuangaikuang','30','article/listG','article/list_mobile','category/view','article/view_mobile','common/ico_title/list014','mobile/list','245','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('780','831','学院动态','x','article','','','','2','12','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun/xueyuanlingdao','30','article/list','article/list_mobile4','article/view','article/view_mobile','adaption/ico_title/dot_title_14px-11','mobile/list4','8','','','category_34','0','','0','a:13:{s:6:\"target\";s:5:\"_self\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('819','0','教学科研','j','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhaoshengpeiyang','30','article/big_list','article/list_jigou5','article/view','article/view','cms/article/list','mobile/list','220','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('835','832','校园地图','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','gonggongfuwu/xiaoyuanditu','30','article/list1','article/list_mobile4','article/view1-2','article/view_mobile','common/ico_title/list016','mobile/list3','0','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('781','776','学院简介','x','page','','','','4','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueyuangaikuang/xueyuanjianjie','30','page/list3','page/list','page/view','page/view','cms/page/list','mobile/list','20','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('841','49','国内交流','g','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhaoshengjiuye/guoneijiaoliu','30','article/list1','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list4','2','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('842','49','国际交流','g','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhaoshengjiuye/guojijiaoliu','30','article/list1','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list4','3','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('843','67','教授','j','article','','','','2','5','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','keyandongtai/jiaoshou','30','article/list6','article/list_mobile4','article/view','article/view_mobile','common/pic_title/list036-2','mobile/list4','8','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('824','776','校园风景','x','article','','','','2','3','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueyuangaikuang/xuexiaofengjing','30','article/list','article/list_mobile','article/view','article/view_mobile','common/pic_title/list034','mobile/list4','10','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('825','776','历史沿革','l','page','','','','4','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueyuangaikuang/xueyuanjianjie','30','page/list3','page/list','page/view','page/view','cms/page/list','mobile/list','8','','','category_825','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('845','67','讲师','j','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','keyandongtai/jiangshi','30','article/list6','article/list_mobile4','article/view2','article/view_mobile','common/pic_title/list036-2','mobile/list4','4','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('872','819','科研动态','k','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhaoshengpeiyang/xueyuanlingdao','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/pic_title_summary/list025','mobile/list4','3','','','category_872','0','','0','a:13:{s:6:\"target\";s:5:\"_self\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('820','0','院系部门','y','article','','','','1','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','yuanxishezhi','30','article/list_bumen(quanbu)','article/list_mobile3','article/view','article/view','cms/article/list','mobile/list','243','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('844','67','副教授','f','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','keyandongtai/fujiaoshou','30','article/list6','article/list_mobile4','article/view2','article/view_mobile','common/pic_title/list036-2','mobile/list4','6','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('839','831','学术讲座','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun/tongzhigonggao','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','4','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('827','776','学院领导','x','article','','','','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/ling&#039;dao.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueyuangaikuang/xueyuanlingdao','30','article/list_lingdao','article/list_mobile5','article/view_jieshao','article/view_mobile2','common/pic_title_summary/list025','mobile/list','18','','','','0','','0','a:13:{s:6:\"target\";s:5:\"_self\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('828','820','院系设置','y','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','yuanxishezhi/yuanxishezhi','30','article/list_bumen2-2','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','8','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('829','820','党群组织','d','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','yuanxishezhi/dangqunzuzhi','30','article/list_bumen2-dangqun','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','6','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('830','820','行政机构','x','article','','','','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','yuanxishezhi/xingzhengjigou','30','article/list_bumen2-2_xingzheng','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','4','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('846','0','访问身份','f','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','fangwenshenfen','30','article/big_list','article/big_list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list','244','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('831','0','新闻资讯','x','article','','','','1','13','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun','30','article/big_list','article/big_list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list3','255','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('832','0','公共服务','g','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','gonggongfuwu','30','article/big_list','article/list_jigou_xiaoyuanshenghuo','article/view','article/view_mobile','cms/article/list','mobile/list3','180','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('866','831','媒体报道','m','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun/xueshujiangzuo','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','0','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('879','45','就业动态','j','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','yuanwugongkai/jiuyedongtai','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','2','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('880','46','研究生教育','y','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xuekejianshe/yanjiushengjiaoyu','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','8','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('881','46','本科生教育','b','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xuekejianshe/benkeshengjiaoyu','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','6','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('882','46','继续教育','j','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xuekejianshe/jixujiaoyu','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','4','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('883','0','视频中心','s','video','','','','1','5','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','shipinzhongxin','30','video/video_index','video/big_list_mobile','video/view','video/view_mobile','cms/video/list','mobile/list','50','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('884','883','新闻视频','x','video','','','','2','5','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','shipinzhongxin/xinwenshipin','30','video/list','video/list_mobile','video/view','video/view_mobile','common/pic_title/list036','mobile/list','0','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('885','883','活动视频','h','video','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','shipinzhongxin/huodongshipin','30','video/list','video/list_mobile','video/view','video/view_mobile','common/pic_title/list036','mobile/list','0','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('886','0','图片中心','t','photo','','','','1','4','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','tupianzhongxin','30','photo/photo_index','photo/big_list_mobile','photo/view','photo/view_mobile','cms/photo/list','mobile/list','40','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('887','886','校园风光','x','photo','','','','2','4','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','tupianzhongxin/xiaoyuanfengguang','30','photo/list','photo/list_mobile','photo/view','photo/view_mobile','common/pic_title/list035','mobile/list','0','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('888','886','活动设施','h','photo','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','tupianzhongxin/huodongsheshi','30','photo/list','photo/list_mobile','photo/view','photo/view_mobile','common/pic_title/list035','mobile/list','0','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('890','889','三严三实','s','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhuantizhuanlan/sanyansanshi','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','0','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('891','889','安全教育','a','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhuantizhuanlan/anquanjiaoyu','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','0','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('26','15','站内公告','z','article','','','','2','6','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhanneigonggao/zhanneigonggao','20','article/list','article/list_mobile','article/view2','article/view_mobile','common/ico_title/list016','mobile/list','0','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_item` VALUES ('119','article','企业站内公告1','','0','','26','','','1','','','','admin','','企业站内公告','1','','2','0','','0','1308558474','0','1308558474','1308558474','1','admin','1568192121','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('120','article','企业站内公告2','','0','','26','','','1','','','','admin','','企业站内公告','1','','4','0','','0','1308558482','0','1308558482','1308558482','1','admin','1568192121','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('121','article','企业站内公告3','','0','','26','','','1','','','','admin','','企业站内公告','1','','10','0','','0','1308558488','0','1308558488','1308558488','1','admin','1568192121','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('122','article','企业站内公告4','','0','','26','','','1','','','','admin','','企业站内公告','1','','12','0','','0','1308558495','0','1308558495','1308558495','1','admin','1568192121','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('123','article','企业站内公告5','','0','','26','','','1','','','','admin','','企业站内公告','1','','9','0','','0','1308558502','0','1308558502','1308558502','1','admin','1568192121','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('124','article','企业站内公告6','','0','','26','','','1','','','','admin','','企业站内公告','1','','10','0','','0','1308558508','0','1308558508','1308558508','1','admin','1568192121','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1054','article','学院领导','','0','','780','','','1','','','','admin','','校党委书记：易佐永主持党委全面工作。校长：庾建设主持行政全面工作。校党委副书记：赖卫华分管组织干部、宣传、思想政治理论课工作、统战、离退休、计划生育、校友会工作。副校长：董皞分管财务、高等职业教育、成人教育、体育、中小学校长和师资培训、直属单位工作。','1','','301','0','','0','1408809600','1408851788','1431064723','1408809600','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1160','article','谭文长','','0','','780','<!--#p8_attach#-->/cms/item/2017_02/17_09/0632f21ab2ee08dd.jpg','','1','','','','admin','6','主持党委工作','1','','32','0','','0','1487295833','1487295833','1487295936','1487295833','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1161','article','安晓朋','','0','','780','<!--#p8_attach#-->/cms/item/2017_02/17_09/5bce7731b94874f8.jpg','','1','','','','admin','6','协助书记负责安全维稳丶学生丶共青团及工会工作，主管学生工作处。','1','','40','0','','0','1487296076','1487296076','1487296076','1487296076','1','admin','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1166','article','科技大学校园风景摄影图效果','','0','','824','<!--#p8_attach#-->/cms/item/2017_05/25_15/6f7444a355a7d2a3.jpg','','1','','','','admin','1,6','作为校园嘉年华重头戏的南京艺术学院毕业生优秀艺术、设计作品展正式向社会开放,吸引','1','','14','0','','0','1495296000','1495297073','1495696673','1495296000','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1170','article','科技大学2017年秋天最新的校园风景拍摄图','','0','','824','<!--#p8_attach#-->/cms/item/2017_05/21_10/af32a2c6aa3e9b9a.jpg','','1','','','','admin','6','它们的头上各有一盏门灯,像两颗夜明珠镶嵌在上面。门柱中间,有一块大理石,上面刻着“余姚市阳明小学”这七个闪烁','1','','21','0','','0','1495296000','1495332835','1495705576','1495296000','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1175','article','科技大学2017年度新建的校园操场和运动会跑道','','0','','824','<!--#p8_attach#-->/cms/item/2017_05/22_06/cd2129dbb3b55922.jpg','','1','','','','admin','6','沿着通向学校的劳动路,我来到了静谧的校门前。早晨,太阳光照在校园里,像给校园披上了一件金色的外套,壮观极了!校门口有两个像卫兵似的门柱','1','','13','0','','0','1495405974','1495405974','1495405974','1495405974','1','admin','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1176','article','雄伟壮观的科技大学新建教学楼','','0','','780','<!--#p8_attach#-->/cms/item/2017_05/25_15/18cac615f26e9fac.jpg','','1','','','','admin','1,6','它可是我们校园的一大风景线。夏天,当我们在操场上玩耍热了时,就到小树下乘凉。知了在树上不停的叫,它被太阳晒得发亮。我喜欢看它在太阳下微风起舞','1','','24','0','','0','1495382400','1495406318','1495696622','1495382400','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1177','article','科技大学2017年秋天最新的校园风景拍摄图','','0','','780','<!--#p8_attach#-->/cms/item/2017_05/21_10/af32a2c6aa3e9b9a.jpg','','0','','','','admin','6','它们的头上各有一盏门灯,像两颗夜明珠镶嵌在上面。门柱中间,有一块大理石,上面刻着“余姚市阳明小学”这七个闪烁','1','','10','0','','0','1495406318','1495406318','1495406318','1495406318','1','admin','1497194716','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1178','article','科技大学2017年度新建的校园操场和运动会跑道','','0','','780','<!--#p8_attach#-->/cms/item/2017_05/22_06/cd2129dbb3b55922.jpg','','0','','','','admin','6','沿着通向学校的劳动路,我来到了静谧的校门前。早晨,太阳光照在校园里,像给校园披上了一件金色的外套,壮观极了!校门口有两个像卫兵似的门柱','1','','1','0','','0','1495406318','1495406318','1495406318','1495406318','1','admin','1497194717','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1183','article','袁军副校长率团参加第八届国际博士研究生学术研讨会','','0','','780','','','1','','','','admin','','2012年7月22至23日，袁军副校长率中国传媒大学师生学术代表团参加了在泰国曼谷朱拉隆公大学举办的第八届国际博士研究生学术研讨会。会议期间，袁军副校长与相关国际合作院校负责人就深化研究生合作办学、学术交流等事','1','','0','0','','0','1493689051','1497191599','1497191599','1493689051','1','admin','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1184','article','2012夏季学期系列：坚守在火灾现场 2012夏季学期系列：坚守在火灾现场 ','','0','','780','','','1','','','','admin','','6月28日下午，台州广播电视台《600全民新闻》节目办公室的电话骤然响起，原来是该市黄岩区一家制造太空杯的工厂发生火灾。我校实习记者徐鑫和电视台另外两名记者带上设备，立即驱车赶赴火灾现场实施报道。火灾现场一','1','','1','0','','0','1493689532','1497195254','1497195254','1493689532','1','admin','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1185','article','袁军副校长率团参加第八届国际博士研究生学术研讨会','','0','','830','','','1','','','','admin','','2012年7月22至23日，袁军副校长率中国传媒大学师生学术代表团参加了在泰国曼谷朱拉隆公大学举办的第八届国际博士研究生学术研讨会。会议期间，袁军副校长与相关国际合作院校负责人就深化研究生合作办学、学术交流等事','1','','2','0','','0','1493618517','1497196116','1497196116','1493618517','1','admin','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1186','article','专家上海研讨大城市规划 绿色可持续城市仍为热点','','0','','840','','','1','','','','admin','','&ldquo;新型城镇化&rdquo;现已成为一个全民议题。如何走新型城镇化道路，需要全社会尤其是&ldquo;规划师&rdquo;的探索与创新。作为担当城乡规划重任的&ldquo;青年规划师&rdquo;的思考及探索，将为中国新型城镇化实践提供新的思路。　　17日，以&ldquo;新型城镇化与城乡规','1','','3','0','','0','1493689051','1497196372','1497196372','1493689051','1','admin','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1187','video','麻省理工学院：算法导论','','0','','884','<!--#p8_attach#-->/cms/item/2017_07/27_14/c7dbb3c44f1a9192.jpg','','1','','','','admin','6,3','麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工','1','','12','0','','0','1468392451','1501138051','1501260779','1469602051','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1188','video','操作系统','','0','','884','<!--#p8_attach#-->/cms/item/2017_07/27_14/d42072e91a45aa7b.jpg','','1','','','','admin','6','操作系统（Operating System，简称OS）是管理和控制计算机硬件与软件资源的计算机程序，是直接运行在“裸机”上的最基本的系统软件，任何其他软件都必须在操作系统的支持下才能运行。操作系统是用户和计算机的接口，同时也是计算机硬件和其他软件的接口。操作','1','','2','0','','0','1469548800','1501138108','1501260793','1469548800','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1189','video','计算机组原理','','0','','884','<!--#p8_attach#-->/cms/item/2017_07/27_14/d9e66c4bd1e07169.jpg','','1','','','','admin','6','课程在以培养学生创新能力和解决实际问题的能力为主的思想指导下，形成了由理论课、实验课、计算机设计与实践构成的课程体系。使学生系统地理解计算机硬件系统的组织结构和工作原理，掌握计算机硬件系统的基本分析与设计方法，建立计算机系统的整体概念。','1','','7','0','','0','1469548800','1501138259','1501260800','1469548800','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1190','video','计算机网络','','0','','884','<!--#p8_attach#-->/cms/item/2017_07/27_14/f7afd5ca201141d8.jpg','','1','','','','admin','6','计算机网络也称计算机通信网。关于计算机网络的最简单定义是：一些相互连接的、以共享资源为目的的、自治的计算机的集合。若按此定义，则早期的面向终端的网络都不能算是计算机网络，而只能称为联机系统（因为那时的许多终端不能算是自治的计算机）。但随着硬件价格的下','1','','3','0','','0','1469548800','1501138328','1501260808','1469548800','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1191','video','数据结构基础','','0','','884','<!--#p8_attach#-->/cms/item/2017_07/27_14/37ef06e9c33d0eee.jpg','','1','','','','admin','6','数据结构','1','','8','0','','0','1469548800','1501138426','1501260814','1469548800','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1192','article','本科就有导师 岳麓书院把制度做成了“温度”岳麓书院把制度','','0','','780','<!--#p8_attach#-->/cms/item/2017_07/27_15/ac93d74478454a86.jpg','','1','','','','admin','6','6月初，湖南大学岳麓书院2017届毕业典礼上，2013级历史学本科生刘楚莹成了场上第一个泪崩的人。那个瞬间，她正和同门师兄一起向学业导师邓洪波教授鞠躬谢师','1','','19','0','','0','1500566400','1501141077','1501141202','1500566400','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1193','article','我校晋级湖南省高校研究生辩论赛四强','','0','','780','<!--#p8_attach#-->/cms/item/2017_07/27_15/12faad1c9ec4802c.jpg','','1','','','','admin','6','本次辩论赛由湖南省学位办主办，湖南大学承办，采用三人制辩论，分抢位赛、初赛、复赛、半决赛、决赛五个阶段，实行当场淘汰制，5月11日将举行半决赛，我校对阵湖南师范大学，决赛将于5月15日举行。本届辩论赛重在培养研究生对社会热点问题的分析能力，考验研究生对切身问题的解决能力，对国家战略布局的感知能力，比赛辩题从国内国际形势、社会改革热点和研究生培养方向三个方面展开，既涉及了校园贷、','1','','8','0','','0','1500566400','1501141343','1501141486','1500566400','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1194','article','“中华文化四海行”走进我校中华文化四海行”走进我校(图文)','','0','','780','<!--#p8_attach#-->/cms/item/2017_07/27_15/dec8d35c035eea84.jpg','','1','','','','admin','6',' 5月21日，“中华文化四海行—走进湖南”在我校举办文化讲坛，中央文史馆馆员、复旦大学资深教授、著名历史地理学家葛剑雄带来《传统文化的“传”和“承”》专题讲座。中央文史研究馆、全国各地文史研究馆的200余位专家学者和我校学生代表参加活动。校党委副书记陈伟主持讲座。','1','','2','0','','0','1500566400','1501141447','1501141447','1500566400','1','admin','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1195','article','省委教育工委来我校调研易班建设省委教育工委来我校调研易班建设','','0','','780','<!--#p8_attach#-->/cms/item/2017_07/27_15/10708333bdf103eb.jpg','','1','','','','admin','6','5月5日下午，湖南省委教育工委宣传部部长曾力勤等来我校调研易班建设及推广工作，我校学工部相关负责人、相关科室老师、学校易班工作站相关负责人陪同调研。','1','','34','0','','0','1500570000','1501141566','1501297030','1500570000','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1196','photo','校园风景','','0','','887','<!--#p8_attach#-->/cms/item/2017_07/29_11/31275d7b4d2fbbb2.png','','1','','','','admin','6','校园风景介绍','1','','1','0','','0','1469764448','1501300448','1501300682','1469764448','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1197','photo','校园风景','','0','','887','<!--#p8_attach#-->/cms/item/2017_07/29_11/2f1b42ec4d83b823.jpg','','1','','','','admin','6','校园风景2','1','','0','0','','0','1469764448','1501300488','1501300687','1469764448','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1198','photo','校园一角','','0','','887','<!--#p8_attach#-->/cms/item/2017_07/29_11/684aa815569c45f3.png','','1','','','','admin','6','校园一角2','1','','1','0','','0','1469764448','1501300537','1501300693','1469764448','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1199','photo','教学楼','','0','','887','<!--#p8_attach#-->/cms/item/2017_07/29_11/f56160a401c549c3.jpg','','1','','','','admin','6','教学楼2','1','','17','0','','0','1469764448','1501300595','1501300700','1469764448','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1200','article','学院领导','','0','','827','','','1','','','','admin','','学院领导介绍','1','','20','0','','0','1469115048','1501342248','1567757597','1468423848','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1201','page','联系我们','','0','','783','','','1','','','','admin','','联系电话保卫部24小时综合值班电话：62782001部长办公室：62784630副部长办公室：62784629、62784631、62784632综合办公室：62782039保卫保密科：62782825、62782178交通科：62782602防火科：62782050、62794497集体户口及身份证办公室：62783270治安派出所：62783779、','1','','10','0','','0','1567649190','1567649190','1567751189','1567649190','1','admin','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1202','page','历史沿革','','0','','825','','','1','','','','admin','','历史沿革','1','','17','0','','0','1567649278','1567649278','1568101750','1567649278','1','admin','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1203','page','学院简介','','0','','781','<!--#p8_attach#-->/cms/item/2019_09/06_15/49de3f89ff01aedc.jpg.cthumb.jpg','','1','','','','admin','','2001年1月，北京与深圳市人民政府签署《合作创办北京大学深圳校区协议书》，共同创办北京大学深圳研究生院。经过十五年发展，深圳研究生院依托北大、立足深圳，逐步成为扎根深圳的北京大学研究型国际化校区，北京大学创建世界一流大学战略的重要组成部分。依托北京','1','','46','0','','0','1567649363','1567649363','1568185073','1567649363','1','admin','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1204','page','学生通道','','0','','847','','','1','','','','admin','','新生专区新生导航国微概况爱国微虚拟校园国微校友新生导读邮件系统学习咨询选课系统精品课程图书借阅查询移动图书馆生活服务校内交通校园网络校园一卡通医疗服务中心宿舍管理奖助专区勤工助学助学贷款奖学金管理校务服务学籍管理学生证办理课程查询','1','','6','0','','0','1567650154','1567650154','1567650154','1567650154','1','admin','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1205','page','教职工通道','','0','','856','','','1','','','','admin','','教学科研本科生教务研究生教务教师个人主页科研管理校务工作电子校务平台校园卡网上财务教学日历邮件系统生活服务校内交通工资查询公积金查询校园资讯吉林大学BBS移动校园通信名录虚拟校园','1','','5','0','','0','1567650246','1567650246','1567650246','1567650246','1','admin','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1206','page','校友通道','','0','','857','','','1','','','','admin','','校友服务校友活动各地校友会校友撷英校友捐赠校友刊物学校校友校园服务牡丹园虚拟校园移动校园学校图库通讯名录','1','','6','0','','0','1567650338','1567650338','1567650338','1567650338','1','admin','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1207','page','考生及访客通道','','0','','858','','','1','','','','admin','','认识学校学校简介历史沿革虚拟校园移动校园师资培养院系设置师资队伍研究生培养本科生培养合作交流研究生交流本科生交流公派留学招生咨询本科生招生研究生招生留学生招生继续教育招生网络招生国防生招生奖助学金勤工助学助学贷款奖学金管理','1','','7','0','','0','1567650410','1567650410','1567650410','1567650410','1','admin','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1209','article','刘老师','','0','','843','<!--#p8_attach#-->/cms/item/2019_09/10_16/dc1cafab37ab3e13.jpg','','1','','','','admin','6','此内容为样板格式刘老师，男，汉族，1972年8月生，湖南桂阳人，中共党员，博士研究生，管理学博士,教授，研究生导师。长期从事政治学、管理学的教学科研工作，主要研究方向为管理科学、社会治理和高等教育管理。先后主持和参与完成国家社科基金项目、国家教育部人文社科','1','','7','0','','0','1473496528','1568104528','1568110847','1473496528','1','admin','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1211','article','周老师','','0','','843','<!--#p8_attach#-->/cms/item/2019_09/10_16/e4f4dfc3fe547650.jpg.thumb.jpg','','1','','','','admin','6','此内容为样板格式刘老师，男，汉族，1972年8月生，湖南桂阳人，中共党员，博士研究生，管理学博士,教授，研究生导师。长期从事政治学、管理学的教学科研工作，主要研究方向为管理科学、社会治理和高等教育管理。先后主持和参与完成国家社科基金项目、国家教育部人文社科','1','','2','0','','0','1441874320','1568104898','1568110812','1441874320','1','admin','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1212','article','黄老师','','0','','843','<!--#p8_attach#-->/cms/item/2019_09/10_16/b316fb02256ac09a.jpg.thumb.jpg','','1','','','','admin','6','此内容为样板格式刘老师，男，汉族，1972年8月生，湖南桂阳人，中共党员，博士研究生，管理学博士,教授，研究生导师。长期从事政治学、管理学的教学科研工作，主要研究方向为管理科学、社会治理和高等教育管理。先后主持和参与完成国家社科基金项目、国家教育部人文社科','1','','3','0','','0','1473496741','1568104913','1568110793','1473496741','1','admin','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1213','article','李老师','','0','','843','<!--#p8_attach#-->/cms/item/2019_09/10_16/bd54ceedfdd26120.jpg.thumb.jpg','','1','','','','admin','6','此内容为样板格式刘老师，男，汉族，1972年8月生，湖南桂阳人，中共党员，博士研究生，管理学博士,教授，研究生导师。长期从事政治学、管理学的教学科研工作，主要研究方向为管理科学、社会治理和高等教育管理。先后主持和参与完成国家社科基金项目、国家教育部人文社科','1','','2','0','','0','1473496741','1568104913','1568110773','1473496741','1','admin','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1214','article','王老师','','0','','843','<!--#p8_attach#-->/cms/item/2019_09/10_16/20cf522da97a3a4f.jpg','','1','','','','admin','6','男，汉族，1972年8月生，湖南桂阳人，中共党员，博士研究生，管理学博士,教授，研究生导师。2012年9月至2017年3月，担任邵阳学院党委委员、副校长，邵阳市优秀社会科学专家。现为湘南学院党委委员、副校长。长期从事政治学、管理学的教学科研工作，主要研究方向','1','','8','0','','0','1441874352','1568104925','1568182869','1441874352','1','admin','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1215','article','我校晋级湖南省高校研究生辩论赛四强','','0','','878','<!--#p8_attach#-->/cms/item/2017_07/27_15/12faad1c9ec4802c.jpg','','1','','','','admin','6','本次辩论赛由湖南省学位办主办，湖南大学承办，采用三人制辩论，分抢位赛、初赛、复赛、半决赛、决赛五个阶段，实行当场淘汰制，5月11日将举行半决赛，我校对阵湖南师范大学，决赛将于5月15日举行。本届辩论赛重在培养研究生对社会热点问题的分析能力，考验研究生对切身问题的解决能力，对国家战略布局的感知能力，比赛辩题从国内国际形势、社会改革热点和研究生培养方向三个方面展开，既涉及了校园贷、','1','','0','0','','0','1568182881','1568182992','1568182992','1568182881','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1216','article','“中华文化四海行”走进我校中华文化四海行”走进我校(图文)','','0','','878','<!--#p8_attach#-->/cms/item/2017_07/27_15/dec8d35c035eea84.jpg','','1','','','','admin','6',' 5月21日，“中华文化四海行—走进湖南”在我校举办文化讲坛，中央文史馆馆员、复旦大学资深教授、著名历史地理学家葛剑雄带来《传统文化的“传”和“承”》专题讲座。中央文史研究馆、全国各地文史研究馆的200余位专家学者和我校学生代表参加活动。校党委副书记陈伟主持讲座。','1','','0','0','','0','1568182881','1568182992','1568182992','1568182881','1','admin','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1217','article','省委教育工委来我校调研易班建设省委教育工委来我校调研易班建设','','0','','878','<!--#p8_attach#-->/cms/item/2017_07/27_15/10708333bdf103eb.jpg','','1','','','','admin','6,5','5月5日下午，湖南省委教育工委宣传部部长曾力勤等来我校调研易班建设及推广工作，我校学工部相关负责人、相关科室老师、学校易班工作站相关负责人陪同调研。','1','','0','0','','0','1568182881','1568182992','1568182992','1568182881','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1218','article','我校晋级湖南省高校研究生辩论赛四强','','0','','878','<!--#p8_attach#-->/cms/item/2017_07/27_15/12faad1c9ec4802c.jpg','','1','','','','admin','6','本次辩论赛由湖南省学位办主办，湖南大学承办，采用三人制辩论，分抢位赛、初赛、复赛、半决赛、决赛五个阶段，实行当场淘汰制，5月11日将举行半决赛，我校对阵湖南师范大学，决赛将于5月15日举行。本届辩论赛重在培养研究生对社会热点问题的分析能力，考验研究生对切身问题的解决能力，对国家战略布局的感知能力，比赛辩题从国内国际形势、社会改革热点和研究生培养方向三个方面展开，既涉及了校园贷、','1','','2','0','','0','1568182921','1568183023','1568183023','1568182921','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1219','article','“中华文化四海行”走进我校中华文化四海行”走进我校(图文)','','0','','878','<!--#p8_attach#-->/cms/item/2017_07/27_15/dec8d35c035eea84.jpg','','1','','','','admin','6',' 5月21日，“中华文化四海行—走进湖南”在我校举办文化讲坛，中央文史馆馆员、复旦大学资深教授、著名历史地理学家葛剑雄带来《传统文化的“传”和“承”》专题讲座。中央文史研究馆、全国各地文史研究馆的200余位专家学者和我校学生代表参加活动。校党委副书记陈伟主持讲座。','1','','0','0','','0','1568182921','1568183023','1568183023','1568182921','1','admin','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item` VALUES ('1220','article','省委教育工委来我校调研易班建设省委教育工委来我校调研易班建设','','0','','878','<!--#p8_attach#-->/cms/item/2017_07/27_15/10708333bdf103eb.jpg','','1','','','','admin','6','5月5日下午，湖南省委教育工委宣传部部长曾力勤等来我校调研易班建设及推广工作，我校学工部相关负责人、相关科室老师、学校易班工作站相关负责人陪同调研。','1','','0','0','','0','1568182921','1568183023','1568183023','1568182921','1','','0','1','1','1','0','0','0','0');
REPLACE INTO `p8_cms_item_article_` VALUES ('119','article','26','1','admin','企业站内公告1','','0','','','','','企业站内公告','','','','','','1','admin','1568192121','1308558474','0','1308558474','1308558474','1','','','2','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('120','article','26','1','admin','企业站内公告2','','0','','','','','企业站内公告','','','','','','1','admin','1568192121','1308558482','0','1308558482','1308558482','1','','','4','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('121','article','26','1','admin','企业站内公告3','','0','','','','','企业站内公告','','','','','','1','admin','1568192121','1308558488','0','1308558488','1308558488','1','','','10','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('122','article','26','1','admin','企业站内公告4','','0','','','','','企业站内公告','','','','','','1','admin','1568192121','1308558495','0','1308558495','1308558495','1','','','12','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('123','article','26','1','admin','企业站内公告5','','0','','','','','企业站内公告','','','','','','1','admin','1568192121','1308558502','0','1308558502','1308558502','1','','','9','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('124','article','26','1','admin','企业站内公告6','','0','','','','','企业站内公告','','','','','','1','admin','1568192121','1308558508','0','1308558508','1308558508','1','','','10','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1054','article','780','1','admin','学院领导','','0','','','','','校党委书记：易佐永主持党委全面工作。校长：庾建设主持行政全面工作。校党委副书记：赖卫华分管组织干部、宣传、思想政治理论课工作、统战、离退休、计划生育、校友会工作。副校长：董皞分管财务、高等职业教育、成人教育、体育、中小学校长和师资培训、直属单位工作。','','','','','','1','','0','1408809600','1408851788','1408809600','1431064723','1','','','301','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1160','article','780','1','admin','谭文长','','0','','<!--#p8_attach#-->/cms/item/2017_02/17_09/0632f21ab2ee08dd.jpg','','6','主持党委工作','','','','','','1','','0','1487295833','1487295833','1487295833','1487295936','1','','','32','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1161','article','780','1','admin','安晓朋','','0','','<!--#p8_attach#-->/cms/item/2017_02/17_09/5bce7731b94874f8.jpg','','6','协助书记负责安全维稳丶学生丶共青团及工会工作，主管学生工作处。','','','','','','1','admin','0','1487296076','1487296076','1487296076','1487296076','1','','','40','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1166','article','824','1','admin','科技大学校园风景摄影图效果','','0','','<!--#p8_attach#-->/cms/item/2017_05/25_15/6f7444a355a7d2a3.jpg','','1,6','作为校园嘉年华重头戏的南京艺术学院毕业生优秀艺术、设计作品展正式向社会开放,吸引','','','','','','1','','0','1495296000','1495297073','1495296000','1495696673','1','','','14','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1170','article','824','1','admin','科技大学2017年秋天最新的校园风景拍摄图','','0','','<!--#p8_attach#-->/cms/item/2017_05/21_10/af32a2c6aa3e9b9a.jpg','','6','它们的头上各有一盏门灯,像两颗夜明珠镶嵌在上面。门柱中间,有一块大理石,上面刻着“余姚市阳明小学”这七个闪烁','','','','','','1','','0','1495296000','1495332835','1495296000','1495705576','1','','','21','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1175','article','824','1','admin','科技大学2017年度新建的校园操场和运动会跑道','','0','','<!--#p8_attach#-->/cms/item/2017_05/22_06/cd2129dbb3b55922.jpg','','6','沿着通向学校的劳动路,我来到了静谧的校门前。早晨,太阳光照在校园里,像给校园披上了一件金色的外套,壮观极了!校门口有两个像卫兵似的门柱','','','','','','1','admin','0','1495405974','1495405974','1495405974','1495405974','1','','','13','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1176','article','780','1','admin','雄伟壮观的科技大学新建教学楼','','0','','<!--#p8_attach#-->/cms/item/2017_05/25_15/18cac615f26e9fac.jpg','','1,6','它可是我们校园的一大风景线。夏天,当我们在操场上玩耍热了时,就到小树下乘凉。知了在树上不停的叫,它被太阳晒得发亮。我喜欢看它在太阳下微风起舞','','','','','','1','','0','1495382400','1495406318','1495382400','1495696622','1','','','24','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1177','article','780','0','admin','科技大学2017年秋天最新的校园风景拍摄图','','0','','<!--#p8_attach#-->/cms/item/2017_05/21_10/af32a2c6aa3e9b9a.jpg','','6','它们的头上各有一盏门灯,像两颗夜明珠镶嵌在上面。门柱中间,有一块大理石,上面刻着“余姚市阳明小学”这七个闪烁','','','','','','1','admin','1497194716','1495406318','1495406318','1495406318','1495406318','1','','','10','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1178','article','780','0','admin','科技大学2017年度新建的校园操场和运动会跑道','','0','','<!--#p8_attach#-->/cms/item/2017_05/22_06/cd2129dbb3b55922.jpg','','6','沿着通向学校的劳动路,我来到了静谧的校门前。早晨,太阳光照在校园里,像给校园披上了一件金色的外套,壮观极了!校门口有两个像卫兵似的门柱','','','','','','1','admin','1497194717','1495406318','1495406318','1495406318','1495406318','1','','','1','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1183','article','780','1','admin','袁军副校长率团参加第八届国际博士研究生学术研讨会','','0','','','','','2012年7月22至23日，袁军副校长率中国传媒大学师生学术代表团参加了在泰国曼谷朱拉隆公大学举办的第八届国际博士研究生学术研讨会。会议期间，袁军副校长与相关国际合作院校负责人就深化研究生合作办学、学术交流等事','院系01|','','','','','1','admin','0','1493689051','1497191599','1493689051','1497191599','1','','','0','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1184','article','780','1','admin','2012夏季学期系列：坚守在火灾现场 2012夏季学期系列：坚守在火灾现场 ','','0','','','','','6月28日下午，台州广播电视台《600全民新闻》节目办公室的电话骤然响起，原来是该市黄岩区一家制造太空杯的工厂发生火灾。我校实习记者徐鑫和电视台另外两名记者带上设备，立即驱车赶赴火灾现场实施报道。火灾现场一','院系2|','','','','','1','admin','0','1493689532','1497195254','1493689532','1497195254','1','','','1','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1185','article','830','1','admin','袁军副校长率团参加第八届国际博士研究生学术研讨会','','0','','','','','2012年7月22至23日，袁军副校长率中国传媒大学师生学术代表团参加了在泰国曼谷朱拉隆公大学举办的第八届国际博士研究生学术研讨会。会议期间，袁军副校长与相关国际合作院校负责人就深化研究生合作办学、学术交流等事','招生网|','','','','','1','admin','0','1493618517','1497196116','1493618517','1497196116','1','','','2','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1186','article','840','1','admin','专家上海研讨大城市规划 绿色可持续城市仍为热点','','0','','','','','&ldquo;新型城镇化&rdquo;现已成为一个全民议题。如何走新型城镇化道路，需要全社会尤其是&ldquo;规划师&rdquo;的探索与创新。作为担当城乡规划重任的&ldquo;青年规划师&rdquo;的思考及探索，将为中国新型城镇化实践提供新的思路。　　17日，以&ldquo;新型城镇化与城乡规','院系01|','','','','','1','admin','0','1493689051','1497196372','1493689051','1497196372','1','','','3','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1192','article','780','1','admin','本科就有导师 岳麓书院把制度做成了“温度”岳麓书院把制度','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_15/ac93d74478454a86.jpg','','6','6月初，湖南大学岳麓书院2017届毕业典礼上，2013级历史学本科生刘楚莹成了场上第一个泪崩的人。那个瞬间，她正和同门师兄一起向学业导师邓洪波教授鞠躬谢师','','','','','','1','','0','1500566400','1501141077','1500566400','1501141202','1','','','19','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1193','article','780','1','admin','我校晋级湖南省高校研究生辩论赛四强','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_15/12faad1c9ec4802c.jpg','','6','本次辩论赛由湖南省学位办主办，湖南大学承办，采用三人制辩论，分抢位赛、初赛、复赛、半决赛、决赛五个阶段，实行当场淘汰制，5月11日将举行半决赛，我校对阵湖南师范大学，决赛将于5月15日举行。本届辩论赛重在培养研究生对社会热点问题的分析能力，考验研究生对切身问题的解决能力，对国家战略布局的感知能力，比赛辩题从国内国际形势、社会改革热点和研究生培养方向三个方面展开，既涉及了校园贷、','','','','','','1','','0','1500566400','1501141343','1500566400','1501141486','1','','','8','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1194','article','780','1','admin','“中华文化四海行”走进我校中华文化四海行”走进我校(图文)','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_15/dec8d35c035eea84.jpg','','6',' 5月21日，“中华文化四海行—走进湖南”在我校举办文化讲坛，中央文史馆馆员、复旦大学资深教授、著名历史地理学家葛剑雄带来《传统文化的“传”和“承”》专题讲座。中央文史研究馆、全国各地文史研究馆的200余位专家学者和我校学生代表参加活动。校党委副书记陈伟主持讲座。','','','','','','1','admin','0','1500566400','1501141447','1500566400','1501141447','1','','','2','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1195','article','780','1','admin','省委教育工委来我校调研易班建设省委教育工委来我校调研易班建设','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_15/10708333bdf103eb.jpg','','6','5月5日下午，湖南省委教育工委宣传部部长曾力勤等来我校调研易班建设及推广工作，我校学工部相关负责人、相关科室老师、学校易班工作站相关负责人陪同调研。','','','','','','1','','0','1500570000','1501141566','1500570000','1501297030','1','','','34','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1200','article','827','1','admin','学院领导','','0','','','','','学院领导介绍','','','','','','1','','0','1469115048','1501342248','1468423848','1567757597','1','','','20','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";s:1:\\\"0\\\";s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1209','article','843','1','admin','刘老师','','0','','<!--#p8_attach#-->/cms/item/2019_09/10_16/dc1cafab37ab3e13.jpg','','6','此内容为样板格式刘老师，男，汉族，1972年8月生，湖南桂阳人，中共党员，博士研究生，管理学博士,教授，研究生导师。长期从事政治学、管理学的教学科研工作，主要研究方向为管理科学、社会治理和高等教育管理。先后主持和参与完成国家社科基金项目、国家教育部人文社科','','','','','','1','admin','0','1473496528','1568104528','1473496528','1568110847','1','','','7','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";s:1:\\\"0\\\";s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1211','article','843','1','admin','周老师','','0','','<!--#p8_attach#-->/cms/item/2019_09/10_16/e4f4dfc3fe547650.jpg.thumb.jpg','','6','此内容为样板格式刘老师，男，汉族，1972年8月生，湖南桂阳人，中共党员，博士研究生，管理学博士,教授，研究生导师。长期从事政治学、管理学的教学科研工作，主要研究方向为管理科学、社会治理和高等教育管理。先后主持和参与完成国家社科基金项目、国家教育部人文社科','','','','','','1','admin','0','1441874320','1568104898','1441874320','1568110812','1','','','2','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";s:1:\\\"0\\\";s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1212','article','843','1','admin','黄老师','','0','','<!--#p8_attach#-->/cms/item/2019_09/10_16/b316fb02256ac09a.jpg.thumb.jpg','','6','此内容为样板格式刘老师，男，汉族，1972年8月生，湖南桂阳人，中共党员，博士研究生，管理学博士,教授，研究生导师。长期从事政治学、管理学的教学科研工作，主要研究方向为管理科学、社会治理和高等教育管理。先后主持和参与完成国家社科基金项目、国家教育部人文社科','','','','','','1','admin','0','1473496741','1568104913','1473496741','1568110793','1','','','3','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";s:1:\\\"0\\\";s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1213','article','843','1','admin','李老师','','0','','<!--#p8_attach#-->/cms/item/2019_09/10_16/bd54ceedfdd26120.jpg.thumb.jpg','','6','此内容为样板格式刘老师，男，汉族，1972年8月生，湖南桂阳人，中共党员，博士研究生，管理学博士,教授，研究生导师。长期从事政治学、管理学的教学科研工作，主要研究方向为管理科学、社会治理和高等教育管理。先后主持和参与完成国家社科基金项目、国家教育部人文社科','','','','','','1','admin','0','1473496741','1568104913','1473496741','1568110773','1','','','2','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";s:1:\\\"0\\\";s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1214','article','843','1','admin','王老师','','0','','<!--#p8_attach#-->/cms/item/2019_09/10_16/20cf522da97a3a4f.jpg','','6','男，汉族，1972年8月生，湖南桂阳人，中共党员，博士研究生，管理学博士,教授，研究生导师。2012年9月至2017年3月，担任邵阳学院党委委员、副校长，邵阳市优秀社会科学专家。现为湘南学院党委委员、副校长。长期从事政治学、管理学的教学科研工作，主要研究方向','','','','','','1','admin','0','1441874352','1568104925','1441874352','1568182869','1','','','8','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1215','article','878','1','admin','我校晋级湖南省高校研究生辩论赛四强','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_15/12faad1c9ec4802c.jpg','','6','本次辩论赛由湖南省学位办主办，湖南大学承办，采用三人制辩论，分抢位赛、初赛、复赛、半决赛、决赛五个阶段，实行当场淘汰制，5月11日将举行半决赛，我校对阵湖南师范大学，决赛将于5月15日举行。本届辩论赛重在培养研究生对社会热点问题的分析能力，考验研究生对切身问题的解决能力，对国家战略布局的感知能力，比赛辩题从国内国际形势、社会改革热点和研究生培养方向三个方面展开，既涉及了校园贷、','','','','','','1','','0','1568182881','1568182992','1568182881','1568182992','1','','','0','0','0','','','','a:2:{i:0;s:0:\\\"\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1216','article','878','1','admin','“中华文化四海行”走进我校中华文化四海行”走进我校(图文)','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_15/dec8d35c035eea84.jpg','','6',' 5月21日，“中华文化四海行—走进湖南”在我校举办文化讲坛，中央文史馆馆员、复旦大学资深教授、著名历史地理学家葛剑雄带来《传统文化的“传”和“承”》专题讲座。中央文史研究馆、全国各地文史研究馆的200余位专家学者和我校学生代表参加活动。校党委副书记陈伟主持讲座。','','','','','','1','admin','0','1568182881','1568182992','1568182881','1568182992','1','','','0','0','0','','','','a:2:{i:0;s:0:\\\"\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1217','article','878','1','admin','省委教育工委来我校调研易班建设省委教育工委来我校调研易班建设','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_15/10708333bdf103eb.jpg','','6,5','5月5日下午，湖南省委教育工委宣传部部长曾力勤等来我校调研易班建设及推广工作，我校学工部相关负责人、相关科室老师、学校易班工作站相关负责人陪同调研。','','','','','','1','','0','1568182881','1568182992','1568182881','1568182992','1','','','0','0','0','','','','a:2:{i:0;s:0:\\\"\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1218','article','878','1','admin','我校晋级湖南省高校研究生辩论赛四强','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_15/12faad1c9ec4802c.jpg','','6','本次辩论赛由湖南省学位办主办，湖南大学承办，采用三人制辩论，分抢位赛、初赛、复赛、半决赛、决赛五个阶段，实行当场淘汰制，5月11日将举行半决赛，我校对阵湖南师范大学，决赛将于5月15日举行。本届辩论赛重在培养研究生对社会热点问题的分析能力，考验研究生对切身问题的解决能力，对国家战略布局的感知能力，比赛辩题从国内国际形势、社会改革热点和研究生培养方向三个方面展开，既涉及了校园贷、','','','','','','1','','0','1568182921','1568183023','1568182921','1568183023','1','','','2','0','0','','','','a:2:{i:0;s:0:\\\"\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1219','article','878','1','admin','“中华文化四海行”走进我校中华文化四海行”走进我校(图文)','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_15/dec8d35c035eea84.jpg','','6',' 5月21日，“中华文化四海行—走进湖南”在我校举办文化讲坛，中央文史馆馆员、复旦大学资深教授、著名历史地理学家葛剑雄带来《传统文化的“传”和“承”》专题讲座。中央文史研究馆、全国各地文史研究馆的200余位专家学者和我校学生代表参加活动。校党委副书记陈伟主持讲座。','','','','','','1','admin','0','1568182921','1568183023','1568182921','1568183023','1','','','0','0','0','','','','a:2:{i:0;s:0:\\\"\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1220','article','878','1','admin','省委教育工委来我校调研易班建设省委教育工委来我校调研易班建设','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_15/10708333bdf103eb.jpg','','6','5月5日下午，湖南省委教育工委宣传部部长曾力勤等来我校调研易班建设及推广工作，我校学工部相关负责人、相关科室老师、学校易班工作站相关负责人陪同调研。','','','','','','1','','0','1568182921','1568183023','1568182921','1568183023','1','','','0','0','0','','','','a:2:{i:0;s:0:\\\"\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('82','119','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558474','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('83','120','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558482','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('84','121','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558488','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('85','122','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558495','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('86','123','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558502','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('87','124','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558508','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('305','1054','1','','','校党委书记：易佐永主持党委全面工作。校长：庾建设主持行政全面工作。校党委副书记：赖卫华分管组织干部、宣传、思想政治理论课工作、统战、离退休、计划生育、校友会工作。副校长：董皞分管财务、高等职业教育、成人教育、体育、中小学校长和师资培训、直属单位工作。','121.8.7.164','222.240.162.130','1408809600','<p>\r\n	<br />\r\n	<span style=\"font-size:12px;\"><strong><span style=\"font-size:16px;\">校党委书记</span></strong></span><strong style=\"font-family: serif; font-size: 12px; \"><span style=\"font-size: 16px; \">：</span></strong><span style=\"font-size:12px;\"><strong><span style=\"font-size:16px;\">易佐永</span></strong></span><br />\r\n	<span style=\"font-size: 12px;\">主持党委全面工作。</span><br />\r\n	<br />\r\n	<span style=\"font-size:12px;\"><span style=\"font-size:16px;\"><strong>校长</strong></span></span><strong style=\"font-family: serif; font-size: 12px; \"><span style=\"font-size: 16px; \">：</span></strong><span style=\"font-size:12px;\"><span style=\"font-size:16px;\"><strong>庾建设</strong></span></span><br />\r\n	<span style=\"font-size: 12px;\">主持行政全面工作。</span><br />\r\n	<br />\r\n	<span style=\"font-size:12px;\"><strong><span style=\"font-size:16px;\">校党委副书记</span></strong></span><strong style=\"font-family: serif; font-size: 12px; \"><span style=\"font-size: 16px; \">：</span></strong><span style=\"font-size:12px;\"><strong><span style=\"font-size:16px;\">赖卫华</span></strong></span><br />\r\n	<span style=\"font-size: 12px;\">分管组织干部、宣传、思想政治理论课工作、统战、离退休、计划生育、校友会工作。</span><br />\r\n	<br />\r\n	<span style=\"font-size: 12px;\"><strong><span style=\"font-size:16px;\">副校长</span></strong></span><strong style=\"font-family: serif; font-size: 12px;\"><span style=\"font-size: 16px; \">：</span></strong><span style=\"font-size: 12px;\"><strong><span style=\"font-size:16px;\">董皞</span></strong></span><br />\r\n	<span style=\"font-size: 12px;\">分管财务、高等职业教育、成人教育、体育、中小学校长和师资培训、直属单位工作。</span><br />\r\n	<br />\r\n	<span style=\"font-size: 12px;\"><span style=\"font-size:16px;\"><strong>副校长</strong></span></span><strong style=\"font-family: serif; font-size: 12px;\"><span style=\"font-size: 16px; \">：</span></strong><span style=\"font-size: 12px;\"><span style=\"font-size:16px;\"><strong>禹奇才</strong></span></span><br />\r\n	<span style=\"font-size: 12px;\">分管党委办公室校办公室、桂花岗校区、依法治校、信息化建设工作。</span><br />\r\n	<br />\r\n	<span style=\"font-size:12px;\"><strong><span style=\"font-size:16px;\">副校长</span></strong></span><strong style=\"font-family: serif; font-size: 12px; \"><span style=\"font-size: 16px; \">：</span></strong><span style=\"font-size:12px;\"><strong><span style=\"font-size:16px;\">陈永亨</span></strong><br />\r\n	<br />\r\n	分管人事、科技与服务地方、学报、档案管理、重点实验室建设工作。<br />\r\n	<br />\r\n	<br />\r\n	<span style=\"font-size:16px;\"><strong>纪委书记</strong></span></span><strong style=\"font-family: serif; font-size: 12px; \"><span style=\"font-size: 16px; \">：</span></strong><span style=\"font-size:12px;\"><span style=\"font-size:16px;\"><strong>陈少梅</strong></span></span><br />\r\n	<span style=\"font-size: 12px;\">主持纪委全面工作，分管监察、审计、招投标管理、工会、教代会工作。</span><br />\r\n	<br />\r\n	<span style=\"font-size: 12px;\"><span style=\"font-size:16px;\"><strong>副校长</strong></span></span><strong style=\"font-family: serif; font-size: 12px;\"><span style=\"font-size: 16px; \">：</span></strong><span style=\"font-size: 12px;\"><span style=\"font-size:16px;\"><strong>徐俊忠</strong></span></span><br />\r\n	<span style=\"font-size: 12px;\">分管研究生教育与管理、人文社会科学研究、重点学科建设工作。</span><br />\r\n	<br />\r\n	<span style=\"font-size:12px;\"><strong><span style=\"font-size:16px;\">副校长：陈爽</span></strong></span><br />\r\n	<span style=\"font-size: 12px;\">分管学生思想政治教育与管理、共青团、学生社团、校园文化活动、国际交流与合作、实验室与设备管理工作。&nbsp;</span><br />\r\n	<br />\r\n	<strong><span style=\"font-size: 16px; \">校长助理：</span>邓成明 &nbsp;周云 &nbsp;傅继阳</strong><br />\r\n	<span style=\"font-family: serif; font-size: 12px;\">全面辅助校长各项工作。</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('402','1160','1','','<!--#p8_attach#-->/cms/item/2017_02/17_09/0632f21ab2ee08dd.jpg','主持党委工作','118.249.34.29','118.249.34.29','1487295833','<font color=\"#333333\" face=\"微软雅黑, Microsoft YaHei, Helvetica Neue, Helvetica, Arial, sans-serif\"><span style=\"font-size: 12px; line-height: 28px; background-color: rgb(255, 255, 255);\">主持党委工作</span></font>');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('403','1161','1','','<!--#p8_attach#-->/cms/item/2017_02/17_09/5bce7731b94874f8.jpg','协助书记负责安全维稳丶学生丶共青团及工会工作，主管学生工作处。','118.249.34.29','118.249.34.29','1487296076','协助书记负责安全维稳丶学生丶共青团及工会工作，主管学生工作处。');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('407','1166','1','','<!--#p8_attach#-->/cms/item/2017_05/25_15/6f7444a355a7d2a3.jpg','作为校园嘉年华重头戏的南京艺术学院毕业生优秀艺术、设计作品展正式向社会开放,吸引','113.246.92.14','113.247.22.211','1495296000','<p>&nbsp;&nbsp; <a href=\"<!--#p8_attach#-->/cms/item/2017_05/25_15/86f95d5285b5a75d.jpg\" target=\"_blank\"><img alt=\"76a5dbd20e0d0b88 (1).jpg\" src=\"<!--#p8_attach#-->/cms/item/2017_05/25_15/86f95d5285b5a75d.jpg\" style=\"height: 224px; width: 361px\" /></a></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('411','1170','1','','<!--#p8_attach#-->/cms/item/2017_05/21_10/af32a2c6aa3e9b9a.jpg','它们的头上各有一盏门灯,像两颗夜明珠镶嵌在上面。门柱中间,有一块大理石,上面刻着“余姚市阳明小学”这七个闪烁','113.246.92.137','113.247.22.211','1495296000','<p>&nbsp;</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n\r\n<p><a href=\"<!--#p8_attach#-->/cms/item/2017_05/21_10/af32a2c6aa3e9b9a.jpg\" target=\"_blank\"><img alt=\"01300000376166124072512161187.jpg\" src=\"<!--#p8_attach#-->/cms/item/2017_05/21_10/af32a2c6aa3e9b9a.jpg.cthumb.jpg\" style=\"height: 375px; width: 600px\" /></a></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('416','1175','1','','<!--#p8_attach#-->/cms/item/2017_05/22_06/cd2129dbb3b55922.jpg','沿着通向学校的劳动路,我来到了静谧的校门前。早晨,太阳光照在校园里,像给校园披上了一件金色的外套,壮观极了!校门口有两个像卫兵似的门柱','113.246.92.137','113.246.92.137','1495405974','&nbsp;&nbsp;&nbsp; <a href=\"<!--#p8_attach#-->/cms/item/2017_05/22_06/095e2bccd17c0d22.jpg\" target=\"_blank\"><img alt=\"001YRz1jzy6TQzP9jkt49&690.jpg\" src=\"<!--#p8_attach#-->/cms/item/2017_05/22_06/095e2bccd17c0d22.jpg.cthumb.jpg\" style=\"height: 240px; width: 600px\" /></a>');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('417','1176','1','','<!--#p8_attach#-->/cms/item/2017_05/25_15/18cac615f26e9fac.jpg','它可是我们校园的一大风景线。夏天,当我们在操场上玩耍热了时,就到小树下乘凉。知了在树上不停的叫,它被太阳晒得发亮。我喜欢看它在太阳下微风起舞','113.246.92.137','113.247.22.211','1495382400','<p>&nbsp;</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href=\"<!--#p8_attach#-->/cms/item/2017_05/25_15/06a6c6ccb5ef875a.jpg\" target=\"_blank\"><img alt=\"d73a8c8ced19f989 (1).jpg\" src=\"<!--#p8_attach#-->/cms/item/2017_05/25_15/06a6c6ccb5ef875a.jpg.cthumb.jpg\" style=\"height: 390px; width: 600px\" /></a></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('422','1183','1','','','2012年7月22至23日，袁军副校长率中国传媒大学师生学术代表团参加了在泰国曼谷朱拉隆公大学举办的第八届国际博士研究生学术研讨会。会议期间，袁军副校长与相关国际合作院校负责人就深化研究生合作办学、学术交流等事','113.246.92.184','113.246.92.184','1493689051','<p style=\"TEXT-INDENT: 2em\">\r\n	2012<span style=\"FONT-FAMILY: 宋体\">年</span>7<span style=\"FONT-FAMILY: 宋体\">月</span>22<span style=\"FONT-FAMILY: 宋体\">至</span>23<span style=\"FONT-FAMILY: 宋体\">日，袁军副校长率中国传媒大学师生学术代表团参加了在泰国曼谷朱拉隆公大学举办的第八届国际博士研究生学术研讨会。会议期间，袁军副校长与相关国际合作院校负责人就深化研究生合作办学、学术交流等事宜进行了富有成果的会谈。</span></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p align=\"center\" style=\"TEXT-INDENT: 2em; TEXT-ALIGN: center\">\r\n	<span style=\"text-indent: 2em; font-family: 宋体; \">国际</span><span style=\"text-indent: 2em; font-family: 宋体; \">博士研究生学术研讨会是由澳大利亚麦考瑞大学和清华大学发起的一个集学术研讨、人才培养、国际合作于一体的高端学术活动。研讨会旨在通过学术研讨的形式，促进合作院校在博士生培养、学术研究以及国际校际合作等方面开展深度交流与合作。目前共有包括麦考瑞大学、清华大学、巴黎第三大学（巴黎索邦大学）、泰国国立朱拉隆公大学、美国德克萨斯大学奥斯汀分校和中国传媒大学在内的六所院校参与了此项活动。</span></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	<span style=\"FONT-FAMILY: 宋体\">本次会议的主题是&ldquo;&lsquo;</span>M<span style=\"FONT-FAMILY: 宋体\">&rsquo;的世界：研究方法的跨学科拓展&rdquo;，集中研讨新闻传播和传媒研究的方法论问题。我校共有</span>9<span style=\"FONT-FAMILY: 宋体\">名博士生的学术论文通过评审，进入会议主题发言和海报展示环节，其中包括</span>2<span style=\"FONT-FAMILY: 宋体\">名留学我校的国际博士生。</span></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	<span style=\"FONT-FAMILY: 宋体\">袁军副校长代表中国传媒大学在会议开幕式上作了题为《&ldquo;渔&rdquo;胜于&ldquo;鱼&rdquo;&mdash;&mdash;中国传媒大学博士生方法课教学的几点思考》的主题演讲，详细介绍了我校博士研究生培养中方法论课程的设置思路和改革路径，获得与会者高度赞赏。</span></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	<span style=\"FONT-FAMILY: 宋体\">我校研究生院副院长田智辉教授、中国国际传播战略与发展研究中心常务副主任张毓强副教授，以及传播研究院教师黄典林博士分别担任了不同小组研讨的主持人和学术评议人。</span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('423','1177','1','','<!--#p8_attach#-->/cms/item/2017_05/21_10/af32a2c6aa3e9b9a.jpg','它们的头上各有一盏门灯,像两颗夜明珠镶嵌在上面。门柱中间,有一块大理石,上面刻着“余姚市阳明小学”这七个闪烁','113.246.92.137','113.246.92.137','1495406318','<p>&nbsp;</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href=\"<!--#p8_attach#-->/cms/item/2017_05/21_10/af32a2c6aa3e9b9a.jpg\" target=\"_blank\"><img alt=\"01300000376166124072512161187.jpg\" src=\"<!--#p8_attach#-->/cms/item/2017_05/21_10/af32a2c6aa3e9b9a.jpg.cthumb.jpg\" style=\"height: 375px; width: 600px\" /></a></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('424','1178','1','','<!--#p8_attach#-->/cms/item/2017_05/22_06/cd2129dbb3b55922.jpg','沿着通向学校的劳动路,我来到了静谧的校门前。早晨,太阳光照在校园里,像给校园披上了一件金色的外套,壮观极了!校门口有两个像卫兵似的门柱','113.246.92.137','113.246.92.137','1495406318','&nbsp;&nbsp;&nbsp; <a href=\"<!--#p8_attach#-->/cms/item/2017_05/22_06/095e2bccd17c0d22.jpg\" target=\"_blank\"><img alt=\"001YRz1jzy6TQzP9jkt49&690.jpg\" src=\"<!--#p8_attach#-->/cms/item/2017_05/22_06/095e2bccd17c0d22.jpg.cthumb.jpg\" style=\"height: 240px; width: 600px\" /></a>');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('425','1184','1','','','6月28日下午，台州广播电视台《600全民新闻》节目办公室的电话骤然响起，原来是该市黄岩区一家制造太空杯的工厂发生火灾。我校实习记者徐鑫和电视台另外两名记者带上设备，立即驱车赶赴火灾现场实施报道。火灾现场一','113.246.92.184','113.246.92.184','1493689532','<div class=\"content_main\">\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		6月28日下午，台州广播电视台《600全民新闻》节目办公室的电话骤然响起，原来是该市黄岩区一家制造太空杯的工厂发生火灾。我校实习记者徐鑫和电视台另外两名记者带上设备，立即驱车赶赴火灾现场实施报道。</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		火灾现场一片惨烈，滚滚浓烟直冲天际，不时响起的爆炸声震耳欲聋，几十辆消防车停在了工厂附近，奋力灭火，交警在忙着疏散现场&hellip;&hellip;</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		在没有任何防护措施的情况下，徐鑫同学和同伴立即投入到现场报道中，通过即时画面播报火灾现场的情景，特别是消防战士手持高压水枪奋力灭火的壮举。由于火势猛烈，在离现场几十米开外的地方就已经让人感到高温难耐，塑料燃烧产生的难闻气味也让人不得不捂住鼻子。&ldquo;我们要接近现场往火势最猛的地方去，这样才能拍摄到最真实的场景。&rdquo;事后徐鑫这样说道。</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		这次新闻现场播报，是2009级广播电视新闻学专业学生徐鑫来台州广播电视总台实习的第三天遇到的事。回想那次现场拍摄经历，徐鑫别有一番感触：&ldquo;记者还要顶着最艰辛的环境做现场出镜。这样的情况是给记者们的一个选择，一个职业精神与生命安全之间的选择，其实无论是哪个都是无可厚非的。&rdquo;</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		《600全民新闻》是台州电视台的一档民生新闻节目，几乎每天都会遇到各种各样的突发性事件，记者总会在第一时间赶到现场。这样的任务，对于实习生徐鑫来说，不仅仅是采访实践的磨练机会，也是一次次真实的考验。在实习的这两周里，她克服了很多困难，也积累了不少的经验。徐鑫同学的敬业精神受到了电视台记者的肯定，影视文化频道的记者蒋琦说：&ldquo;徐鑫同学能够虚心向指导老师求教钻研业务，现在已经很好地掌握了新闻采访写作的方法，表现良好。&rdquo;</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		包括徐鑫在内，今年来台州广播电视台参加教务处顶岗实习项目的共有六名同学，分别在台州电视台新闻综合频道、影视文化频道和公共财富频道等频道实习实践，或参加采访，或参与播音，或承担技术。尽管实习实践岗位不同，有的同学还是第一次参加这样的实践，但是同学们的责任感一样的强，干劲一样的足，他们知道，只有通过一线实践，才能更好地理解、把握和运用好在课堂上学到的知识，同时，通过实践锻炼和磨砺，又可以进一步增强学校学习的针对性和主动性。正如2011级新闻双学位的王娟同学所说的那样，&ldquo;参与顶岗实习，跟着记者真正进行一次实地采访，才真正明白新闻报道应该怎么做&rdquo;。</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		雨季过后，台州进入夏季高温天气，实习生们每天都要跟随记者，冒着35℃以上的高温奔赴各地参与新闻拍摄。尽管如此，同学们没有一个叫苦，叫累，而是以他们的坚韧和毅力，用他们的学识和智慧，为台州广播电视事业贡献着点点滴滴，同时也在这点点滴滴中成长成熟&hellip;&hellip;</p>\r\n	<p align=\"right\" style=\"TEXT-INDENT: 2em\">\r\n		（文：曹坤、王悦&nbsp;图：王晴沐洋、王悦 编辑：王维家）&nbsp;</p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('426','1185','1','','','2012年7月22至23日，袁军副校长率中国传媒大学师生学术代表团参加了在泰国曼谷朱拉隆公大学举办的第八届国际博士研究生学术研讨会。会议期间，袁军副校长与相关国际合作院校负责人就深化研究生合作办学、学术交流等事','223.73.194.152','223.73.194.152','1493618517','<p style=\"TEXT-INDENT: 2em\">\r\n	2012<span style=\"FONT-FAMILY: 宋体\">年</span>7<span style=\"FONT-FAMILY: 宋体\">月</span>22<span style=\"FONT-FAMILY: 宋体\">至</span>23<span style=\"FONT-FAMILY: 宋体\">日，袁军副校长率中国传媒大学师生学术代表团参加了在泰国曼谷朱拉隆公大学举办的第八届国际博士研究生学术研讨会。会议期间，袁军副校长与相关国际合作院校负责人就深化研究生合作办学、学术交流等事宜进行了富有成果的会谈。</span></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p align=\"center\" style=\"TEXT-INDENT: 2em; TEXT-ALIGN: center\">\r\n	<span style=\"text-indent: 2em; font-family: 宋体; \">国际</span><span style=\"text-indent: 2em; font-family: 宋体; \">博士研究生学术研讨会是由澳大利亚麦考瑞大学和清华大学发起的一个集学术研讨、人才培养、国际合作于一体的高端学术活动。研讨会旨在通过学术研讨的形式，促进合作院校在博士生培养、学术研究以及国际校际合作等方面开展深度交流与合作。目前共有包括麦考瑞大学、清华大学、巴黎第三大学（巴黎索邦大学）、泰国国立朱拉隆公大学、美国德克萨斯大学奥斯汀分校和中国传媒大学在内的六所院校参与了此项活动。</span></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	<span style=\"FONT-FAMILY: 宋体\">本次会议的主题是&ldquo;&lsquo;</span>M<span style=\"FONT-FAMILY: 宋体\">&rsquo;的世界：研究方法的跨学科拓展&rdquo;，集中研讨新闻传播和传媒研究的方法论问题。我校共有</span>9<span style=\"FONT-FAMILY: 宋体\">名博士生的学术论文通过评审，进入会议主题发言和海报展示环节，其中包括</span>2<span style=\"FONT-FAMILY: 宋体\">名留学我校的国际博士生。</span></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	<span style=\"FONT-FAMILY: 宋体\">袁军副校长代表中国传媒大学在会议开幕式上作了题为《&ldquo;渔&rdquo;胜于&ldquo;鱼&rdquo;&mdash;&mdash;中国传媒大学博士生方法课教学的几点思考》的主题演讲，详细介绍了我校博士研究生培养中方法论课程的设置思路和改革路径，获得与会者高度赞赏。</span></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	<span style=\"FONT-FAMILY: 宋体\">我校研究生院副院长田智辉教授、中国国际传播战略与发展研究中心常务副主任张毓强副教授，以及传播研究院教师黄典林博士分别担任了不同小组研讨的主持人和学术评议人。</span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('427','1186','1','','','&ldquo;新型城镇化&rdquo;现已成为一个全民议题。如何走新型城镇化道路，需要全社会尤其是&ldquo;规划师&rdquo;的探索与创新。作为担当城乡规划重任的&ldquo;青年规划师&rdquo;的思考及探索，将为中国新型城镇化实践提供新的思路。　　17日，以&ldquo;新型城镇化与城乡规','113.246.92.184','113.246.92.184','1493689051','<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">&ldquo;新型城镇化&rdquo;现已成为一个全民议题。如何走新型城镇化道路，需要全社会尤其是&ldquo;规划师&rdquo;的探索与创新。作为担当城乡规划重任的&ldquo;青年规划师&rdquo;的思考及探索，将为中国新型城镇化实践提供新的思路。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　17日，以&ldquo;新型城镇化与城乡规划编制创新&rdquo;为主题的&ldquo;第三届金经昌中国青年规划师创新论坛&rdquo;在上海举行。近期，北京启动总体规划调整和修改，上海启动新一轮城市总体规划编制，在此背景下，本次论坛聚焦&ldquo;大都市地区总体规划编制创新&rdquo;这一热点，展开研讨。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　自2007年开始，全世界一半以上的人口生活在城市，世界正式进入了&ldquo;城市纪元&rdquo;，城市成为了全球人关注的重点；而预计到2040年，全球将有64.7%的人生活在城市中。城市已经成为最不了不起的成就。但城市发展中又面临种种问题。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　中国城市规划设计研究院总规划师张兵在论坛上作了题为《场所&middot;结构&middot;治理&mdash;大都市地区空间发展与总体规划》的报告。他说，大都市地区新一轮总体规划编制工作出现了一些新特点，包括开展前期评估、公众参与、以人为本、从重规模转向重结构、强调生态文明建设和文化传承等，这反映了规划工作者在改进规划方面所作的努力，但这些改进还无法真正解决大都市区历史性转变中面临着的现实需要。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　张兵强调，应该通过出行等人的行为来认识都市区内部发育状况，为规划重点问题解决提供认识基础，在此基础上，他指出大都市区总规改进的三个方向：结构塑形、设施引领场所再组织和改革空间治理体系。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　当前，生态与可持续发展已成为城市发展的目标，上海也在这方面紧随世界的步伐。上海提出以节能减排先进城市系统为其建设的基本目标。同时在具体区域，如建设崇明生态岛、真如城市副中心、崇明陈桥镇生态城镇、长风商务区等，以此在城市开发中注重生态发展。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　上海市规划与国土资源局副局长徐毅松介绍了刚刚启动的上海新一轮总体规划编制工作思路，生态环境颇为引人关注。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　值得关注的是，尽管从上世纪90年代起，全世界都热衷将生态作为一种标签，但往往流于表面形式，世界各地也依次出现了一些不同类型的生态城市试验，例如荷兰的太阳城、斯德哥尔摩哈马尔比滨水城、上海的崇明东滩生态城等。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　城市规划到底走向何方？可能如中科院院士、同济大学郑时龄教授当天在当天举行的上海科普大讲坛上所言，&ldquo;我们按照自己的文化和理想建设我们的城市，理想、想象和幻想越是丰富，我们的城市也就越理想&rdquo;。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('428','1192','1','','<!--#p8_attach#-->/cms/item/2017_07/27_15/ac93d74478454a86.jpg','6月初，湖南大学岳麓书院2017届毕业典礼上，2013级历史学本科生刘楚莹成了场上第一个泪崩的人。那个瞬间，她正和同门师兄一起向学业导师邓洪波教授鞠躬谢师','113.246.94.58','113.246.94.58','1500566400','<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: calibri;\">6</span></span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">月初，湖南大学岳麓书院</span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: calibri;\">2017</span></span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">届毕业典礼上，</span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: calibri;\">2013</span></span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">级历史学本科生刘楚莹成了场上第一个泪崩的人。那个瞬间，她正和同门师兄一起向学业导师邓洪波教授鞠躬谢师。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"<!--#p8_attach#-->/cms/item/2017_07/27_15/9002a6403aac95ed.jpg\" target=\"_blank\"><img alt=\"动态1.jpg\" src=\"<!--#p8_attach#-->/cms/item/2017_07/27_15/9002a6403aac95ed.jpg.cthumb.jpg\" style=\"height: 400px; width: 600px;\" /></a></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\"><span style=\"word-break: break-all; padding: 0px;\">&ldquo;你有什么烦恼就尽管来找我。&rdquo;&ldquo;老师这里永远为你敞开怀抱。&rdquo;&ldquo;你们就像儿女一样，老师希望你们留下来，但老师更希望你们飞得更高。&rdquo;在刘楚莹眼里，导师不只是她学术的领路人，更是她值得信赖的长辈，是精神导师，是她成长路上的&ldquo;灯塔&rdquo;。收到保研录取通知书的那一刻，一句&ldquo;楚莹，恭喜你出嫁了&rdquo;，更让她感动到哭。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">在湖南大学岳麓书院，留下了很多这样&ldquo;有温度&rdquo;的师生故事。本科生导师制搭起了师生之间的这座桥梁。从</span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: calibri;\">2009</span></span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">年开始，岳麓书院立足当代高等教育发展的实际，汲取传统书院文化之精华，实行本科生导师制。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\"><span style=\"word-break: break-all; padding: 0px;\">经过八年多的实践和探索，目前已形成了包括学业导师、生活导师、班导师、学术兴趣导师在内四位一体的本科生人才培养模式，续写着千年学府的光荣与梦想。岳麓书院院长肖永明教授表示，岳麓书院本科生导师制既有对古代书院教育传统的继承，对书院教育理念与实践经验的借鉴，也立足于高等教育发展的现实，顺应了时代发展的潮流。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p align=\"center\"><strong style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">做人与做学问</span></span></span></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">本科就有导师是什么样的体验？&ldquo;如果你对历史学习感兴趣，一定会觉得这是几辈子求来的福气。&rdquo;在岳麓书院，有学生这样形容来书院求学的&ldquo;小幸运&rdquo;。岳麓书院从</span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: calibri;\">2009</span></span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">年开始招收历史学专业本科生，每个学生都有一位学业导师进行一对一的指导。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">李伟，岳麓书院</span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: calibri;\">2010</span></span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">级历史学本科生，本科毕业后在复旦大学历史地理研究中心硕博连读，和曾经的学业导师肖永明教授依然保持着非常紧密的联系。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\"><span style=\"word-break: break-all; padding: 0px;\">&ldquo;现在看来，他发展得很不错。如果我们不去引导他，可能他的潜力就难以发掘出来了。&rdquo;肖永明感到很欣慰。他回忆，因为一些外在因素，李伟在大一时曾一心想考公务员。&ldquo;考上了，那这个社会也只是多了一个普普通通的公务员，却少了一个做学问的好苗子。&rdquo;凭他的经验，李伟好学慎思，&ldquo;是个读书的种子&rdquo;。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\"><span style=\"word-break: break-all; padding: 0px;\">引导李伟往学术方向改变，他花了不少心思。&ldquo;我经常找他谈话，希望他看到自己的特长和真正的兴趣。我的博士是他的生活导师，也会在不同的场合跟他交流，希望他找准自己的方向，要扬长避短。&rdquo;虽然中间偶有反复，但李伟在大二时终于确定了学术之路。每周二的师门读书会，他&ldquo;雷打不动&rdquo;地参加。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\"><span style=\"word-break: break-all; padding: 0px;\">学业导师是岳麓书院本科生导师制的主体。在肖永明看来，传统的书院教育追求&ldquo;求学&rdquo;与&ldquo;求道&rdquo;的统一，融德行与学问为一体，关注知识的传授，更重视学生品德的培养。&ldquo;这就要求我们的教师不仅仅在学业方面对学生加以指点，而且要在学生价值观念形成与人格养成的过程中，在为学进德、待人接物、为人处世等方面给予学生以引导。&rdquo;</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">作为肖永明教授的学生，</span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: calibri;\">2013</span></span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">级历史学本科生蒋明也在学业导师的指导下，一步步走向专业历史学科学习的大门。在为人处世上，他更是耳濡目染，以导师为榜样。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\"><span style=\"word-break: break-all; padding: 0px;\">&ldquo;让我很有体会的一点就是肖老师对他的老师陈谷嘉教授的尊重和关怀。每次提到老先生时他的眼里总是充满了敬意；老先生现在退休在家，肖老师逢年过节就会去看望他，有年中秋还叫了我们几个学生一起去陪老先生过节。&rdquo;他说，这让他真正体会到了什么是尊师重道。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\"><span style=\"word-break: break-all; padding: 0px;\">有学术探讨，有情感交流，亦师亦友，朝夕相处，谈学论道，切磋砥砺&mdash;&mdash;传统书院教育中的师生关系，在今日的岳麓书院重焕活力。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">书院连续几年就导师制实施情况对毕业生进行回访，当问到&ldquo;学业导师对您对帮助体现在什么方面&rdquo;时，有三分之二的人选择了&ldquo;人格熏陶&rdquo;和&ldquo;论文写作&rdquo;。</span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: calibri;\">2013</span></span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">级历史学本科</span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: calibri;\">29</span></span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">名学生，有</span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: calibri;\">20</span></span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">人继续读研深造，升学率近七成，又为书院当代复兴做了更为生动和有力的注脚。</span></span></span></p>\r\n\r\n<div>&nbsp;</div>\r\n\r\n<div>&nbsp;</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('429','1193','1','','<!--#p8_attach#-->/cms/item/2017_07/27_15/12faad1c9ec4802c.jpg','本次辩论赛由湖南省学位办主办，湖南大学承办，采用三人制辩论，分抢位赛、初赛、复赛、半决赛、决赛五个阶段，实行当场淘汰制，5月11日将举行半决赛，我校对阵湖南师范大学，决赛将于5月15日举行。本届辩论赛重在培养研究生对社会热点问题的分析能力，考验研究生对切身问题的解决能力，对国家战略布局的感知能力，比赛辩题从国内国际形势、社会改革热点和研究生培养方向三个方面展','113.246.94.58','113.246.94.58','1500566400','<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">5</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">月</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">6</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">日，随着辩论主席四强最后一席席位的揭晓，湖南省第三届高校研究生辩论赛</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">四强名单产生，分别为</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">湖南大学、湖南师范大学、南华大学与湖南科技大学</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">成功晋级半决赛。该辩论赛5月5日在</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">我校正式</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">拉开帷幕。湖南省教育厅副厅长葛建中，湖南省学位办主任余伟良，校长助理于德介出席开幕式。</span></div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">本次辩论赛由湖南省学位办主办，湖南大学承办，采用三人制辩论，分抢位赛、初赛、复赛、半决赛、决赛</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">五个</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">阶段，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">实行</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">当场淘汰制</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">，<span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">5月11日将举行半决赛，我校对阵湖南师范大学，</span>决赛</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">将于</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">5月15日</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">举行</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">。</span></div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">本届辩论赛重在培养研究生对社会热点问题的分析能力，考验研究生对切身问题的解决能力，对国家战略布局的感知能力，比赛辩题从国内国际形势、</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">社会改革热点和</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">研究生培养方向</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">三个方面展开，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">既涉及</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">了</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">校园贷</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">、</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">公益众筹</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">、共享单车</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">、</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">网络水军等</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">时下</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">热</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">词，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">又讨论</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">了朝鲜半岛</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">、萨德部署、中美关系等国际前沿问题</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">也不乏</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">&ldquo;</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">研究生创业应该立足学科还是市场&rdquo;</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">&ldquo;</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">研究生培养更应注重科学精神还是人文精神</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">&rdquo;</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">等</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">贴近</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">当代</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">学生</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">学习</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">生活的</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">辩题</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">。</span></div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">赛事分</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">集体奖和个人奖，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">包括</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">冠亚季军和优秀团队奖、优秀组织奖，优秀指导</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">老师</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">、优秀辩手、最佳辩手等</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">。</span></div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">主办方</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">还</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">邀请</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">了湖南省</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">大众</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">语言艺术研究会</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">、</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">省演讲与口才学会</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">相关专家</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">湖南卫视</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">、</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">湖南人民广播电台</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">等</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">优秀</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">媒体人</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">以及</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">大唐集团、中国电信等</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">知名企业</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">的辩论能手</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">、</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">司法界的优秀检察官、律师</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">等担任比赛评委。</span></div>\r\n\r\n<div>&nbsp;</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('430','1194','1','','<!--#p8_attach#-->/cms/item/2017_07/27_15/dec8d35c035eea84.jpg',' 5月21日，“中华文化四海行—走进湖南”在我校举办文化讲坛，中央文史馆馆员、复旦大学资深教授、著名历史地理学家葛剑雄带来《传统文化的“传”和“承”》专题讲座。中央文史研究馆、全国各地文史研究馆的200余位专家学者和我校学生代表参加活动。校党委副书记陈伟主持讲座。','113.246.94.58','113.246.94.58','1500566400','<p><span style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);\">&nbsp; &nbsp; &nbsp; &nbsp; 5月21日，&ldquo;中华文化四海行&mdash;走进湖南&rdquo;在我校举办文化讲坛，中央文史馆馆员、复旦大学资深教授、著名历史地理学家葛剑雄带来《传统文化的&ldquo;传&rdquo;和&ldquo;承&rdquo;》专题讲座。中央文史研究馆、全国各地文史研究馆的200余位专家学者和我校学生代表参加活动。校党委副书记陈伟主持讲座。</span></p>\r\n\r\n<p style=\"text-align: center;\"><a href=\"<!--#p8_attach#-->/cms/item/2017_07/27_15/a886c4481f6864e9.jpg\" target=\"_blank\"><img alt=\"动态3.jpg\" src=\"<!--#p8_attach#-->/cms/item/2017_07/27_15/a886c4481f6864e9.jpg.cthumb.jpg\" style=\"height: 399px; width: 600px;\" /></a></p>\r\n\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"padding: 0px; margin: 0px;\">&ldquo;中华文化四海行&mdash;走进湖南&rdquo;，由国务院参事室、中央文史研究馆、湖南省人民政府共同举办，以&ldquo;弘扬中华优秀传统文化、展示伟人故里锦绣湖南&rdquo;为主题，于5月20日至25日在长沙、岳阳举行，包括文化讲坛、书画精品联展、文艺联谊、名家进校园、大型书画联谊笔会等，在湖南大学、湖南师范大学、湖南理工学院三所高校举办文化讲坛。</span></div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"padding: 0px; margin: 0px;\"><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">讲座上，葛剑雄认为</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">传统文化的&ldquo;传&rdquo;即无条件保存保留，作为历史的记忆和资源的储存</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">，</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">传统文化的&ldquo;承&rdquo;，</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">就</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">是有选择的继承和弘扬，取其精华，去其糟粕，并需要进行创造性的转化</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">。讲座内容丰富，语言风趣幽默、通俗易懂，现场掌声阵阵、氛围热烈。</span></span></div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"padding: 0px; margin: 0px;\">陈伟在活动最后勉励我校学子，希望大家能够认真学习、主动担当、自觉传播优秀传统文化，充分认识传统文化的时代价值，坚守精神家园，坚定文化自信，努力成为中华文化的笃信者、传承者、躬行者，为中华文化发扬光大、中华民族伟大复兴贡献自己的青春力量。</span></div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"padding: 0px; margin: 0px;\">会后，与会专家学者参观了我校岳麓书院。</span></div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"padding: 0px; margin: 0px;\"><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">据悉，&ldquo;中华文化四海行&rdquo;是国务院参事室、中央文史研究馆推出的大型文化活动，</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">以强大的专家阵容、深厚的文化含量和丰富的活动形式，全方位、多角度展示和传播中华优秀传统文化，</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">自2013年以来已相继在贵州、云南、重庆、甘肃、新疆、澳门成功举办，受到各界民众的热烈欢迎。</span></span></div>\r\n\r\n<div>&nbsp;</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('431','1195','1','','<!--#p8_attach#-->/cms/item/2017_07/27_15/10708333bdf103eb.jpg','5月5日下午，湖南省委教育工委宣传部部长曾力勤等来我校调研易班建设及推广工作，我校学工部相关负责人、相关科室老师、学校易班工作站相关负责人陪同调研。','113.246.94.58','113.247.22.86','1500570000','<p style=\"text-align: center\"><a href=\"<!--#p8_attach#-->/cms/item/2017_07/27_15/86405a2e8735b713.jpg\" target=\"_blank\"><img alt=\"动态4.jpg\" src=\"<!--#p8_attach#-->/cms/item/2017_07/27_15/86405a2e8735b713.jpg.cthumb.jpg\" style=\"height: 399px; width: 600px\" /></a></p>\r\n\r\n<p align=\"justify\" style=\"background: rgb(255,255,255); padding-bottom: 0pt; text-align: justify; padding-top: 0pt; padding-left: 0pt; margin-left: 0pt; padding-right: 0pt; margin-right: 0pt; text-indent: 24pt\"><span style=\"letter-spacing: 0pt\"><span style=\"font-size: 10.5pt\"><span style=\"color: rgb(51,51,51)\"><span style=\"font-family: 微软雅黑\">5月5日下午，湖南省委教育工委宣传部部长曾力勤等来我校调研易班建设及推广工作，我校学工部相关负责人、相关科室老师、学校易班工作站相关负责人陪同调研。</span></span></span></span></p>\r\n\r\n<p align=\"justify\" style=\"background: rgb(255,255,255); padding-bottom: 0pt; text-align: justify; padding-top: 0pt; padding-left: 0pt; padding-right: 0pt; margin-right: 0pt; text-indent: 21pt\"><span style=\"letter-spacing: 0pt\"><span style=\"font-size: 10.5pt\"><span style=\"color: rgb(51,51,51)\"><span style=\"font-family: 微软雅黑\">学工部相关负责人从我校易班建设的组织架构、建设目标与总体思路、前期建设成果以及2017年建设规划等方面介绍了我校易班建设及推广情况。2016年是我校易班建设元年，学校从制度、经费、场地上给予了强有力的支持。目前我校易班注册突破1万人，2016级新生注册率突破97%，题库使用量突破35万人次。2017年学校易班发展中心、易班学生工作站将会继续开发系列贴近学生的轻应用等，完善学院易班工作站队伍建设和培训，开展系列线上线下活动，让易班更加走进同学们的生活。</span></span></span></span></p>\r\n\r\n<p align=\"justify\" style=\"background: rgb(255,255,255); padding-bottom: 0pt; text-align: justify; padding-top: 0pt; padding-left: 0pt; margin-left: 0pt; padding-right: 0pt; margin-right: 0pt; text-indent: 24pt\">&nbsp;<span style=\"letter-spacing: 0pt\"><span style=\"font-size: 10.5pt\"><span style=\"color: rgb(51,51,51)\"><span style=\"font-family: 微软雅黑\">学校易班学生工作站站长团成员展示了我校易班首页内容，汇报了工作站的中心构架、日常工作的开展和近期工作安排，并对筹备中的古诗词大会及即将在易班APP上线的线上请销假、跳蚤市场等功能进行了介绍。</span></span></span></span></p>\r\n\r\n<p align=\"justify\" style=\"background: rgb(255,255,255); padding-bottom: 0pt; text-align: justify; padding-top: 0pt; padding-left: 0pt; margin-left: 0pt; padding-right: 0pt; margin-right: 0pt; text-indent: 24pt\"><span style=\"letter-spacing: 0pt\"><span style=\"font-size: 10.5pt\"><span style=\"color: rgb(51,51,51)\"><span style=\"font-family: 微软雅黑\">曾力勤对我校易班工作站的工作表示高度认可。他希望，湖南大学作为全省最早开展易班建设的高校之一，要发挥好示范带头作用，将湖大易班建设成更受学生欢迎、服务学生发展的连接载体。</span></span></span></span></p>\r\n\r\n<p align=\"justify\" style=\"background: rgb(255,255,255); padding-bottom: 0pt; text-align: justify; padding-top: 0pt; padding-left: 0pt; margin: 0pt; padding-right: 0pt; text-indent: 0pt\">&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('432','1200','1','','','学院领导介绍','113.247.22.86','113.246.108.183','1469115048','&nbsp;学院领导介绍');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('434','1209','1','','<!--#p8_attach#-->/cms/item/2019_09/10_16/dc1cafab37ab3e13.jpg','此内容为样板格式刘老师，男，汉族，1972年8月生，湖南桂阳人，中共党员，博士研究生，管理学博士,教授，研究生导师。长期从事政治学、管理学的教学科研工作，主要研究方向为管理科学、社会治理和高等教育管理。先后主持和参与完成国家社科基金项目、国家教育部人文社科','113.246.187.77','113.246.187.77','1473496528','<p>此内容为样板格式刘老师，男，汉族，1972年8月生，湖南桂阳人，中共党员，博士研究生，管理学博士,教授，研究生导师。<br />\r\n长期从事政治学、管理学的教学科研工作，主要研究方向为管理科学、社会治理和高等教育管理。先后主持和参与完成国家社科基金项目、国家教育部人文社科规划基金、湖南省社科基金项目16项，等专著3部，在国际国内公开刊物发表论文40余篇，多篇论文被人大复印资料转载，其诸多学术观点被多家报刊摘录引用。其中，《被&ldquo;中国改革论坛：社会改革&rdquo;转载收录。&ldquo;城乡统筹发展中社会治理协同机制研究&rdquo;系列成果，获邵阳市社会科学成果一等奖1项。获省级教学论文成果二等奖、三等奖各1项。<br />\r\n2014年，被国家教育部选派参加&ldquo;中西部千名校长海外研修计划&rdquo;，先后赴悉尼大学、新南威尔士大学、阿德莱德大学等国外知名大学学习访问。2018年，被国家教育部选派赴英国牛津大学、剑桥大学、帝国理工大学、伦敦大学等世界知名大学访问和研修。<br />\r\n<br />\r\n教学情况：<br />\r\n主讲本科生课程：《管理学原理》《公共关系》《社会治理》等。<br />\r\n主要专著：<br />\r\n（1）《统筹城乡发展社会协同治理机制研究》，西南财经大学出版社，2016年12月。<br />\r\n（2）《高校危机治理模式创新研究&mdash;基于和谐文化的视角》，湖南人民出版社，2014年9月。<br />\r\n<br />\r\n<br />\r\n主持科研项目：<br />\r\n1．主持湖南省哲学社会科学基金项目（13YBB119）：&ldquo;城乡统筹发展中的社会管理协同治理研究&rdquo;，湖南省哲学社会科学规划办公室，研究起止时间：2013.07-2015.12。<br />\r\n2．主持湖南省哲学社会科学基金项目（11YBB333）：&ldquo;高校危机善治模式研究&mdash;基于和谐文化视角&rdquo;， 湖南省哲学社会科学规划办公室，研究起止时间：2011.05-2013.09。<br />\r\n3. 主持湖南省社会科学成果评审委员会课题&ldquo;南岭走廊乡村治理智慧的创新性研究&rdquo;，湖南省社科联，研究起止时间：2018.04-2019.04。</p>\r\n\r\n<p>&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('436','1211','1','','<!--#p8_attach#-->/cms/item/2019_09/10_16/e4f4dfc3fe547650.jpg.thumb.jpg','此内容为样板格式刘老师，男，汉族，1972年8月生，湖南桂阳人，中共党员，博士研究生，管理学博士,教授，研究生导师。长期从事政治学、管理学的教学科研工作，主要研究方向为管理科学、社会治理和高等教育管理。先后主持和参与完成国家社科基金项目、国家教育部人文社科','113.246.187.77','113.246.187.77','1441874320','<p>此内容为样板格式刘老师，男，汉族，1972年8月生，湖南桂阳人，中共党员，博士研究生，管理学博士,教授，研究生导师。<br />\r\n长期从事政治学、管理学的教学科研工作，主要研究方向为管理科学、社会治理和高等教育管理。先后主持和参与完成国家社科基金项目、国家教育部人文社科规划基金、湖南省社科基金项目16项，等专著3部，在国际国内公开刊物发表论文40余篇，多篇论文被人大复印资料转载，其诸多学术观点被多家报刊摘录引用。其中，《被&ldquo;中国改革论坛：社会改革&rdquo;转载收录。&ldquo;城乡统筹发展中社会治理协同机制研究&rdquo;系列成果，获邵阳市社会科学成果一等奖1项。获省级教学论文成果二等奖、三等奖各1项。<br />\r\n2014年，被国家教育部选派参加&ldquo;中西部千名校长海外研修计划&rdquo;，先后赴悉尼大学、新南威尔士大学、阿德莱德大学等国外知名大学学习访问。2018年，被国家教育部选派赴英国牛津大学、剑桥大学、帝国理工大学、伦敦大学等世界知名大学访问和研修。<br />\r\n<br />\r\n教学情况：<br />\r\n主讲本科生课程：《管理学原理》《公共关系》《社会治理》等。<br />\r\n主要专著：<br />\r\n（1）《统筹城乡发展社会协同治理机制研究》，西南财经大学出版社，2016年12月。<br />\r\n（2）《高校危机治理模式创新研究&mdash;基于和谐文化的视角》，湖南人民出版社，2014年9月。<br />\r\n<br />\r\n<br />\r\n主持科研项目：<br />\r\n1．主持湖南省哲学社会科学基金项目（13YBB119）：&ldquo;城乡统筹发展中的社会管理协同治理研究&rdquo;，湖南省哲学社会科学规划办公室，研究起止时间：2013.07-2015.12。<br />\r\n2．主持湖南省哲学社会科学基金项目（11YBB333）：&ldquo;高校危机善治模式研究&mdash;基于和谐文化视角&rdquo;， 湖南省哲学社会科学规划办公室，研究起止时间：2011.05-2013.09。<br />\r\n3. 主持湖南省社会科学成果评审委员会课题&ldquo;南岭走廊乡村治理智慧的创新性研究&rdquo;，湖南省社科联，研究起止时间：2018.04-2019.04。</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('437','1212','1','','<!--#p8_attach#-->/cms/item/2019_09/10_16/b316fb02256ac09a.jpg.thumb.jpg','此内容为样板格式刘老师，男，汉族，1972年8月生，湖南桂阳人，中共党员，博士研究生，管理学博士,教授，研究生导师。长期从事政治学、管理学的教学科研工作，主要研究方向为管理科学、社会治理和高等教育管理。先后主持和参与完成国家社科基金项目、国家教育部人文社科','113.246.187.77','113.246.187.77','1473496741','<p>此内容为样板格式刘老师，男，汉族，1972年8月生，湖南桂阳人，中共党员，博士研究生，管理学博士,教授，研究生导师。<br />\r\n长期从事政治学、管理学的教学科研工作，主要研究方向为管理科学、社会治理和高等教育管理。先后主持和参与完成国家社科基金项目、国家教育部人文社科规划基金、湖南省社科基金项目16项，等专著3部，在国际国内公开刊物发表论文40余篇，多篇论文被人大复印资料转载，其诸多学术观点被多家报刊摘录引用。其中，《被&ldquo;中国改革论坛：社会改革&rdquo;转载收录。&ldquo;城乡统筹发展中社会治理协同机制研究&rdquo;系列成果，获邵阳市社会科学成果一等奖1项。获省级教学论文成果二等奖、三等奖各1项。<br />\r\n2014年，被国家教育部选派参加&ldquo;中西部千名校长海外研修计划&rdquo;，先后赴悉尼大学、新南威尔士大学、阿德莱德大学等国外知名大学学习访问。2018年，被国家教育部选派赴英国牛津大学、剑桥大学、帝国理工大学、伦敦大学等世界知名大学访问和研修。<br />\r\n<br />\r\n教学情况：<br />\r\n主讲本科生课程：《管理学原理》《公共关系》《社会治理》等。<br />\r\n主要专著：<br />\r\n（1）《统筹城乡发展社会协同治理机制研究》，西南财经大学出版社，2016年12月。<br />\r\n（2）《高校危机治理模式创新研究&mdash;基于和谐文化的视角》，湖南人民出版社，2014年9月。<br />\r\n<br />\r\n<br />\r\n主持科研项目：<br />\r\n1．主持湖南省哲学社会科学基金项目（13YBB119）：&ldquo;城乡统筹发展中的社会管理协同治理研究&rdquo;，湖南省哲学社会科学规划办公室，研究起止时间：2013.07-2015.12。<br />\r\n2．主持湖南省哲学社会科学基金项目（11YBB333）：&ldquo;高校危机善治模式研究&mdash;基于和谐文化视角&rdquo;， 湖南省哲学社会科学规划办公室，研究起止时间：2011.05-2013.09。<br />\r\n3. 主持湖南省社会科学成果评审委员会课题&ldquo;南岭走廊乡村治理智慧的创新性研究&rdquo;，湖南省社科联，研究起止时间：2018.04-2019.04。</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('438','1213','1','','<!--#p8_attach#-->/cms/item/2019_09/10_16/bd54ceedfdd26120.jpg.thumb.jpg','此内容为样板格式刘老师，男，汉族，1972年8月生，湖南桂阳人，中共党员，博士研究生，管理学博士,教授，研究生导师。长期从事政治学、管理学的教学科研工作，主要研究方向为管理科学、社会治理和高等教育管理。先后主持和参与完成国家社科基金项目、国家教育部人文社科','113.246.187.77','113.246.187.77','1473496741','<p>此内容为样板格式刘老师，男，汉族，1972年8月生，湖南桂阳人，中共党员，博士研究生，管理学博士,教授，研究生导师。<br />\r\n长期从事政治学、管理学的教学科研工作，主要研究方向为管理科学、社会治理和高等教育管理。先后主持和参与完成国家社科基金项目、国家教育部人文社科规划基金、湖南省社科基金项目16项，等专著3部，在国际国内公开刊物发表论文40余篇，多篇论文被人大复印资料转载，其诸多学术观点被多家报刊摘录引用。其中，《被&ldquo;中国改革论坛：社会改革&rdquo;转载收录。&ldquo;城乡统筹发展中社会治理协同机制研究&rdquo;系列成果，获邵阳市社会科学成果一等奖1项。获省级教学论文成果二等奖、三等奖各1项。<br />\r\n2014年，被国家教育部选派参加&ldquo;中西部千名校长海外研修计划&rdquo;，先后赴悉尼大学、新南威尔士大学、阿德莱德大学等国外知名大学学习访问。2018年，被国家教育部选派赴英国牛津大学、剑桥大学、帝国理工大学、伦敦大学等世界知名大学访问和研修。<br />\r\n<br />\r\n教学情况：<br />\r\n主讲本科生课程：《管理学原理》《公共关系》《社会治理》等。<br />\r\n主要专著：<br />\r\n（1）《统筹城乡发展社会协同治理机制研究》，西南财经大学出版社，2016年12月。<br />\r\n（2）《高校危机治理模式创新研究&mdash;基于和谐文化的视角》，湖南人民出版社，2014年9月。<br />\r\n<br />\r\n<br />\r\n主持科研项目：<br />\r\n1．主持湖南省哲学社会科学基金项目（13YBB119）：&ldquo;城乡统筹发展中的社会管理协同治理研究&rdquo;，湖南省哲学社会科学规划办公室，研究起止时间：2013.07-2015.12。<br />\r\n2．主持湖南省哲学社会科学基金项目（11YBB333）：&ldquo;高校危机善治模式研究&mdash;基于和谐文化视角&rdquo;， 湖南省哲学社会科学规划办公室，研究起止时间：2011.05-2013.09。<br />\r\n3. 主持湖南省社会科学成果评审委员会课题&ldquo;南岭走廊乡村治理智慧的创新性研究&rdquo;，湖南省社科联，研究起止时间：2018.04-2019.04。</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('439','1214','1','','<!--#p8_attach#-->/cms/item/2019_09/10_16/20cf522da97a3a4f.jpg','男，汉族，1972年8月生，湖南桂阳人，中共党员，博士研究生，管理学博士,教授，研究生导师。2012年9月至2017年3月，担任邵阳学院党委委员、副校长，邵阳市优秀社会科学专家。现为湘南学院党委委员、副校长。长期从事政治学、管理学的教学科研工作，主要研究方向','113.246.187.77','113.218.171.101','1441874352','<p>此内容为样板格式刘老师，男，汉族，1972年8月生，湖南桂阳人，中共党员，博士研究生，管理学博士,教授，研究生导师。<br />\r\n长期从事政治学、管理学的教学科研工作，主要研究方向为管理科学、社会治理和高等教育管理。先后主持和参与完成国家社科基金项目、国家教育部人文社科规划基金、湖南省社科基金项目16项，等专著3部，在国际国内公开刊物发表论文40余篇，多篇论文被人大复印资料转载，其诸多学术观点被多家报刊摘录引用。其中，《被&ldquo;中国改革论坛：社会改革&rdquo;转载收录。&ldquo;城乡统筹发展中社会治理协同机制研究&rdquo;系列成果，获邵阳市社会科学成果一等奖1项。获省级教学论文成果二等奖、三等奖各1项。<br />\r\n2014年，被国家教育部选派参加&ldquo;中西部千名校长海外研修计划&rdquo;，先后赴悉尼大学、新南威尔士大学、阿德莱德大学等国外知名大学学习访问。2018年，被国家教育部选派赴英国牛津大学、剑桥大学、帝国理工大学、伦敦大学等世界知名大学访问和研修。<br />\r\n<br />\r\n教学情况：<br />\r\n主讲本科生课程：《管理学原理》《公共关系》《社会治理》等。<br />\r\n主要专著：<br />\r\n（1）《统筹城乡发展社会协同治理机制研究》，西南财经大学出版社，2016年12月。<br />\r\n（2）《高校危机治理模式创新研究&mdash;基于和谐文化的视角》，湖南人民出版社，2014年9月。<br />\r\n<br />\r\n<br />\r\n主持科研项目：<br />\r\n1．主持湖南省哲学社会科学基金项目（13YBB119）：&ldquo;城乡统筹发展中的社会管理协同治理研究&rdquo;，湖南省哲学社会科学规划办公室，研究起止时间：2013.07-2015.12。<br />\r\n2．主持湖南省哲学社会科学基金项目（11YBB333）：&ldquo;高校危机善治模式研究&mdash;基于和谐文化视角&rdquo;， 湖南省哲学社会科学规划办公室，研究起止时间：2011.05-2013.09。<br />\r\n3. 主持湖南省社会科学成果评审委员会课题&ldquo;南岭走廊乡村治理智慧的创新性研究&rdquo;，湖南省社科联，研究起止时间：2018.04-2019.04。<br />\r\n&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('440','1215','1','','<!--#p8_attach#-->/cms/item/2017_07/27_15/12faad1c9ec4802c.jpg','本次辩论赛由湖南省学位办主办，湖南大学承办，采用三人制辩论，分抢位赛、初赛、复赛、半决赛、决赛五个阶段，实行当场淘汰制，5月11日将举行半决赛，我校对阵湖南师范大学，决赛将于5月15日举行。本届辩论赛重在培养研究生对社会热点问题的分析能力，考验研究生对切身问题的解决能力，对国家战略布局的感知能力，比赛辩题从国内国际形势、社会改革热点和研究生培养方向三个方面展','113.218.171.101','113.218.171.101','1568182881','<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">5</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">月</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">6</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">日，随着辩论主席四强最后一席席位的揭晓，湖南省第三届高校研究生辩论赛</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">四强名单产生，分别为</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">湖南大学、湖南师范大学、南华大学与湖南科技大学</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">成功晋级半决赛。该辩论赛5月5日在</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">我校正式</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">拉开帷幕。湖南省教育厅副厅长葛建中，湖南省学位办主任余伟良，校长助理于德介出席开幕式。</span></div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">本次辩论赛由湖南省学位办主办，湖南大学承办，采用三人制辩论，分抢位赛、初赛、复赛、半决赛、决赛</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">五个</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">阶段，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">实行</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">当场淘汰制</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">，<span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">5月11日将举行半决赛，我校对阵湖南师范大学，</span>决赛</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">将于</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">5月15日</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">举行</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">。</span></div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">本届辩论赛重在培养研究生对社会热点问题的分析能力，考验研究生对切身问题的解决能力，对国家战略布局的感知能力，比赛辩题从国内国际形势、</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">社会改革热点和</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">研究生培养方向</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">三个方面展开，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">既涉及</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">了</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">校园贷</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">、</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">公益众筹</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">、共享单车</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">、</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">网络水军等</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">时下</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">热</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">词，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">又讨论</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">了朝鲜半岛</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">、萨德部署、中美关系等国际前沿问题</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">也不乏</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">&ldquo;</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">研究生创业应该立足学科还是市场&rdquo;</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">&ldquo;</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">研究生培养更应注重科学精神还是人文精神</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">&rdquo;</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">等</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">贴近</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">当代</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">学生</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">学习</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">生活的</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">辩题</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">。</span></div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">赛事分</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">集体奖和个人奖，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">包括</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">冠亚季军和优秀团队奖、优秀组织奖，优秀指导</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">老师</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">、优秀辩手、最佳辩手等</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">。</span></div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">主办方</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">还</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">邀请</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">了湖南省</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">大众</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">语言艺术研究会</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">、</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">省演讲与口才学会</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">相关专家</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">湖南卫视</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">、</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">湖南人民广播电台</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">等</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">优秀</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">媒体人</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">以及</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">大唐集团、中国电信等</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">知名企业</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">的辩论能手</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">、</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">司法界的优秀检察官、律师</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">等担任比赛评委。</span></div>\r\n\r\n<div>&nbsp;</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('441','1216','1','','<!--#p8_attach#-->/cms/item/2017_07/27_15/dec8d35c035eea84.jpg',' 5月21日，“中华文化四海行—走进湖南”在我校举办文化讲坛，中央文史馆馆员、复旦大学资深教授、著名历史地理学家葛剑雄带来《传统文化的“传”和“承”》专题讲座。中央文史研究馆、全国各地文史研究馆的200余位专家学者和我校学生代表参加活动。校党委副书记陈伟主持讲座。','113.218.171.101','113.218.171.101','1568182881','<p><span style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);\">&nbsp; &nbsp; &nbsp; &nbsp; 5月21日，&ldquo;中华文化四海行&mdash;走进湖南&rdquo;在我校举办文化讲坛，中央文史馆馆员、复旦大学资深教授、著名历史地理学家葛剑雄带来《传统文化的&ldquo;传&rdquo;和&ldquo;承&rdquo;》专题讲座。中央文史研究馆、全国各地文史研究馆的200余位专家学者和我校学生代表参加活动。校党委副书记陈伟主持讲座。</span></p>\r\n\r\n<p style=\"text-align: center;\"><a href=\"<!--#p8_attach#-->/cms/item/2017_07/27_15/a886c4481f6864e9.jpg\" target=\"_blank\"><img alt=\"动态3.jpg\" src=\"<!--#p8_attach#-->/cms/item/2017_07/27_15/a886c4481f6864e9.jpg.cthumb.jpg\" style=\"height: 399px; width: 600px;\" /></a></p>\r\n\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"padding: 0px; margin: 0px;\">&ldquo;中华文化四海行&mdash;走进湖南&rdquo;，由国务院参事室、中央文史研究馆、湖南省人民政府共同举办，以&ldquo;弘扬中华优秀传统文化、展示伟人故里锦绣湖南&rdquo;为主题，于5月20日至25日在长沙、岳阳举行，包括文化讲坛、书画精品联展、文艺联谊、名家进校园、大型书画联谊笔会等，在湖南大学、湖南师范大学、湖南理工学院三所高校举办文化讲坛。</span></div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"padding: 0px; margin: 0px;\"><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">讲座上，葛剑雄认为</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">传统文化的&ldquo;传&rdquo;即无条件保存保留，作为历史的记忆和资源的储存</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">，</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">传统文化的&ldquo;承&rdquo;，</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">就</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">是有选择的继承和弘扬，取其精华，去其糟粕，并需要进行创造性的转化</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">。讲座内容丰富，语言风趣幽默、通俗易懂，现场掌声阵阵、氛围热烈。</span></span></div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"padding: 0px; margin: 0px;\">陈伟在活动最后勉励我校学子，希望大家能够认真学习、主动担当、自觉传播优秀传统文化，充分认识传统文化的时代价值，坚守精神家园，坚定文化自信，努力成为中华文化的笃信者、传承者、躬行者，为中华文化发扬光大、中华民族伟大复兴贡献自己的青春力量。</span></div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"padding: 0px; margin: 0px;\">会后，与会专家学者参观了我校岳麓书院。</span></div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"padding: 0px; margin: 0px;\"><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">据悉，&ldquo;中华文化四海行&rdquo;是国务院参事室、中央文史研究馆推出的大型文化活动，</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">以强大的专家阵容、深厚的文化含量和丰富的活动形式，全方位、多角度展示和传播中华优秀传统文化，</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">自2013年以来已相继在贵州、云南、重庆、甘肃、新疆、澳门成功举办，受到各界民众的热烈欢迎。</span></span></div>\r\n\r\n<div>&nbsp;</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('442','1217','1','','<!--#p8_attach#-->/cms/item/2017_07/27_15/10708333bdf103eb.jpg','5月5日下午，湖南省委教育工委宣传部部长曾力勤等来我校调研易班建设及推广工作，我校学工部相关负责人、相关科室老师、学校易班工作站相关负责人陪同调研。','113.218.171.101','113.218.171.101','1568182881','<p style=\"text-align: center\"><a href=\"<!--#p8_attach#-->/cms/item/2017_07/27_15/86405a2e8735b713.jpg\" target=\"_blank\"><img alt=\"动态4.jpg\" src=\"<!--#p8_attach#-->/cms/item/2017_07/27_15/86405a2e8735b713.jpg.cthumb.jpg\" style=\"height: 399px; width: 600px\" /></a></p>\r\n\r\n<p align=\"justify\" style=\"background: rgb(255,255,255); padding-bottom: 0pt; text-align: justify; padding-top: 0pt; padding-left: 0pt; margin-left: 0pt; padding-right: 0pt; margin-right: 0pt; text-indent: 24pt\"><span style=\"letter-spacing: 0pt\"><span style=\"font-size: 10.5pt\"><span style=\"color: rgb(51,51,51)\"><span style=\"font-family: 微软雅黑\">5月5日下午，湖南省委教育工委宣传部部长曾力勤等来我校调研易班建设及推广工作，我校学工部相关负责人、相关科室老师、学校易班工作站相关负责人陪同调研。</span></span></span></span></p>\r\n\r\n<p align=\"justify\" style=\"background: rgb(255,255,255); padding-bottom: 0pt; text-align: justify; padding-top: 0pt; padding-left: 0pt; padding-right: 0pt; margin-right: 0pt; text-indent: 21pt\"><span style=\"letter-spacing: 0pt\"><span style=\"font-size: 10.5pt\"><span style=\"color: rgb(51,51,51)\"><span style=\"font-family: 微软雅黑\">学工部相关负责人从我校易班建设的组织架构、建设目标与总体思路、前期建设成果以及2017年建设规划等方面介绍了我校易班建设及推广情况。2016年是我校易班建设元年，学校从制度、经费、场地上给予了强有力的支持。目前我校易班注册突破1万人，2016级新生注册率突破97%，题库使用量突破35万人次。2017年学校易班发展中心、易班学生工作站将会继续开发系列贴近学生的轻应用等，完善学院易班工作站队伍建设和培训，开展系列线上线下活动，让易班更加走进同学们的生活。</span></span></span></span></p>\r\n\r\n<p align=\"justify\" style=\"background: rgb(255,255,255); padding-bottom: 0pt; text-align: justify; padding-top: 0pt; padding-left: 0pt; margin-left: 0pt; padding-right: 0pt; margin-right: 0pt; text-indent: 24pt\">&nbsp;<span style=\"letter-spacing: 0pt\"><span style=\"font-size: 10.5pt\"><span style=\"color: rgb(51,51,51)\"><span style=\"font-family: 微软雅黑\">学校易班学生工作站站长团成员展示了我校易班首页内容，汇报了工作站的中心构架、日常工作的开展和近期工作安排，并对筹备中的古诗词大会及即将在易班APP上线的线上请销假、跳蚤市场等功能进行了介绍。</span></span></span></span></p>\r\n\r\n<p align=\"justify\" style=\"background: rgb(255,255,255); padding-bottom: 0pt; text-align: justify; padding-top: 0pt; padding-left: 0pt; margin-left: 0pt; padding-right: 0pt; margin-right: 0pt; text-indent: 24pt\"><span style=\"letter-spacing: 0pt\"><span style=\"font-size: 10.5pt\"><span style=\"color: rgb(51,51,51)\"><span style=\"font-family: 微软雅黑\">曾力勤对我校易班工作站的工作表示高度认可。他希望，湖南大学作为全省最早开展易班建设的高校之一，要发挥好示范带头作用，将湖大易班建设成更受学生欢迎、服务学生发展的连接载体。</span></span></span></span></p>\r\n\r\n<p align=\"justify\" style=\"background: rgb(255,255,255); padding-bottom: 0pt; text-align: justify; padding-top: 0pt; padding-left: 0pt; margin: 0pt; padding-right: 0pt; text-indent: 0pt\">&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('443','1218','1','','<!--#p8_attach#-->/cms/item/2017_07/27_15/12faad1c9ec4802c.jpg','本次辩论赛由湖南省学位办主办，湖南大学承办，采用三人制辩论，分抢位赛、初赛、复赛、半决赛、决赛五个阶段，实行当场淘汰制，5月11日将举行半决赛，我校对阵湖南师范大学，决赛将于5月15日举行。本届辩论赛重在培养研究生对社会热点问题的分析能力，考验研究生对切身问题的解决能力，对国家战略布局的感知能力，比赛辩题从国内国际形势、社会改革热点和研究生培养方向三个方面展','113.218.171.101','113.218.171.101','1568182921','<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">5</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">月</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">6</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">日，随着辩论主席四强最后一席席位的揭晓，湖南省第三届高校研究生辩论赛</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">四强名单产生，分别为</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">湖南大学、湖南师范大学、南华大学与湖南科技大学</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">成功晋级半决赛。该辩论赛5月5日在</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">我校正式</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">拉开帷幕。湖南省教育厅副厅长葛建中，湖南省学位办主任余伟良，校长助理于德介出席开幕式。</span></div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">本次辩论赛由湖南省学位办主办，湖南大学承办，采用三人制辩论，分抢位赛、初赛、复赛、半决赛、决赛</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">五个</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">阶段，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">实行</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">当场淘汰制</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">，<span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">5月11日将举行半决赛，我校对阵湖南师范大学，</span>决赛</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">将于</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">5月15日</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">举行</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">。</span></div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">本届辩论赛重在培养研究生对社会热点问题的分析能力，考验研究生对切身问题的解决能力，对国家战略布局的感知能力，比赛辩题从国内国际形势、</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">社会改革热点和</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">研究生培养方向</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">三个方面展开，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">既涉及</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">了</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">校园贷</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">、</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">公益众筹</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">、共享单车</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">、</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">网络水军等</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">时下</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">热</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">词，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">又讨论</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">了朝鲜半岛</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">、萨德部署、中美关系等国际前沿问题</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">也不乏</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">&ldquo;</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">研究生创业应该立足学科还是市场&rdquo;</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">&ldquo;</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">研究生培养更应注重科学精神还是人文精神</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">&rdquo;</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">等</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">贴近</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">当代</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">学生</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">学习</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">生活的</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">辩题</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">。</span></div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">赛事分</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">集体奖和个人奖，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">包括</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">冠亚季军和优秀团队奖、优秀组织奖，优秀指导</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">老师</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">、优秀辩手、最佳辩手等</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px;\">。</span></div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">主办方</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">还</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">邀请</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">了湖南省</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">大众</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">语言艺术研究会</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">、</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">省演讲与口才学会</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">相关专家</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">湖南卫视</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">、</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">湖南人民广播电台</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">等</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">优秀</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">媒体人</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">，</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">以及</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">大唐集团、中国电信等</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">知名企业</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">的辩论能手</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">、</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">司法界的优秀检察官、律师</span><span style=\"font-size: 10.5pt; padding: 0px; margin: 0px; line-height: 21px;\">等担任比赛评委。</span></div>\r\n\r\n<div>&nbsp;</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('444','1219','1','','<!--#p8_attach#-->/cms/item/2017_07/27_15/dec8d35c035eea84.jpg',' 5月21日，“中华文化四海行—走进湖南”在我校举办文化讲坛，中央文史馆馆员、复旦大学资深教授、著名历史地理学家葛剑雄带来《传统文化的“传”和“承”》专题讲座。中央文史研究馆、全国各地文史研究馆的200余位专家学者和我校学生代表参加活动。校党委副书记陈伟主持讲座。','113.218.171.101','113.218.171.101','1568182921','<p><span style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);\">&nbsp; &nbsp; &nbsp; &nbsp; 5月21日，&ldquo;中华文化四海行&mdash;走进湖南&rdquo;在我校举办文化讲坛，中央文史馆馆员、复旦大学资深教授、著名历史地理学家葛剑雄带来《传统文化的&ldquo;传&rdquo;和&ldquo;承&rdquo;》专题讲座。中央文史研究馆、全国各地文史研究馆的200余位专家学者和我校学生代表参加活动。校党委副书记陈伟主持讲座。</span></p>\r\n\r\n<p style=\"text-align: center;\"><a href=\"<!--#p8_attach#-->/cms/item/2017_07/27_15/a886c4481f6864e9.jpg\" target=\"_blank\"><img alt=\"动态3.jpg\" src=\"<!--#p8_attach#-->/cms/item/2017_07/27_15/a886c4481f6864e9.jpg.cthumb.jpg\" style=\"height: 399px; width: 600px;\" /></a></p>\r\n\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"padding: 0px; margin: 0px;\">&ldquo;中华文化四海行&mdash;走进湖南&rdquo;，由国务院参事室、中央文史研究馆、湖南省人民政府共同举办，以&ldquo;弘扬中华优秀传统文化、展示伟人故里锦绣湖南&rdquo;为主题，于5月20日至25日在长沙、岳阳举行，包括文化讲坛、书画精品联展、文艺联谊、名家进校园、大型书画联谊笔会等，在湖南大学、湖南师范大学、湖南理工学院三所高校举办文化讲坛。</span></div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"padding: 0px; margin: 0px;\"><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">讲座上，葛剑雄认为</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">传统文化的&ldquo;传&rdquo;即无条件保存保留，作为历史的记忆和资源的储存</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">，</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">传统文化的&ldquo;承&rdquo;，</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">就</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">是有选择的继承和弘扬，取其精华，去其糟粕，并需要进行创造性的转化</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">。讲座内容丰富，语言风趣幽默、通俗易懂，现场掌声阵阵、氛围热烈。</span></span></div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"padding: 0px; margin: 0px;\">陈伟在活动最后勉励我校学子，希望大家能够认真学习、主动担当、自觉传播优秀传统文化，充分认识传统文化的时代价值，坚守精神家园，坚定文化自信，努力成为中华文化的笃信者、传承者、躬行者，为中华文化发扬光大、中华民族伟大复兴贡献自己的青春力量。</span></div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"padding: 0px; margin: 0px;\">会后，与会专家学者参观了我校岳麓书院。</span></div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"padding: 0px; margin: 0px;\"><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">据悉，&ldquo;中华文化四海行&rdquo;是国务院参事室、中央文史研究馆推出的大型文化活动，</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">以强大的专家阵容、深厚的文化含量和丰富的活动形式，全方位、多角度展示和传播中华优秀传统文化，</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">自2013年以来已相继在贵州、云南、重庆、甘肃、新疆、澳门成功举办，受到各界民众的热烈欢迎。</span></span></div>\r\n\r\n<div>&nbsp;</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('445','1220','1','','<!--#p8_attach#-->/cms/item/2017_07/27_15/10708333bdf103eb.jpg','5月5日下午，湖南省委教育工委宣传部部长曾力勤等来我校调研易班建设及推广工作，我校学工部相关负责人、相关科室老师、学校易班工作站相关负责人陪同调研。','113.218.171.101','113.218.171.101','1568182921','<p style=\"text-align: center\"><a href=\"<!--#p8_attach#-->/cms/item/2017_07/27_15/86405a2e8735b713.jpg\" target=\"_blank\"><img alt=\"动态4.jpg\" src=\"<!--#p8_attach#-->/cms/item/2017_07/27_15/86405a2e8735b713.jpg.cthumb.jpg\" style=\"height: 399px; width: 600px\" /></a></p>\r\n\r\n<p align=\"justify\" style=\"background: rgb(255,255,255); padding-bottom: 0pt; text-align: justify; padding-top: 0pt; padding-left: 0pt; margin-left: 0pt; padding-right: 0pt; margin-right: 0pt; text-indent: 24pt\"><span style=\"letter-spacing: 0pt\"><span style=\"font-size: 10.5pt\"><span style=\"color: rgb(51,51,51)\"><span style=\"font-family: 微软雅黑\">5月5日下午，湖南省委教育工委宣传部部长曾力勤等来我校调研易班建设及推广工作，我校学工部相关负责人、相关科室老师、学校易班工作站相关负责人陪同调研。</span></span></span></span></p>\r\n\r\n<p align=\"justify\" style=\"background: rgb(255,255,255); padding-bottom: 0pt; text-align: justify; padding-top: 0pt; padding-left: 0pt; padding-right: 0pt; margin-right: 0pt; text-indent: 21pt\"><span style=\"letter-spacing: 0pt\"><span style=\"font-size: 10.5pt\"><span style=\"color: rgb(51,51,51)\"><span style=\"font-family: 微软雅黑\">学工部相关负责人从我校易班建设的组织架构、建设目标与总体思路、前期建设成果以及2017年建设规划等方面介绍了我校易班建设及推广情况。2016年是我校易班建设元年，学校从制度、经费、场地上给予了强有力的支持。目前我校易班注册突破1万人，2016级新生注册率突破97%，题库使用量突破35万人次。2017年学校易班发展中心、易班学生工作站将会继续开发系列贴近学生的轻应用等，完善学院易班工作站队伍建设和培训，开展系列线上线下活动，让易班更加走进同学们的生活。</span></span></span></span></p>\r\n\r\n<p align=\"justify\" style=\"background: rgb(255,255,255); padding-bottom: 0pt; text-align: justify; padding-top: 0pt; padding-left: 0pt; margin-left: 0pt; padding-right: 0pt; margin-right: 0pt; text-indent: 24pt\">&nbsp;<span style=\"letter-spacing: 0pt\"><span style=\"font-size: 10.5pt\"><span style=\"color: rgb(51,51,51)\"><span style=\"font-family: 微软雅黑\">学校易班学生工作站站长团成员展示了我校易班首页内容，汇报了工作站的中心构架、日常工作的开展和近期工作安排，并对筹备中的古诗词大会及即将在易班APP上线的线上请销假、跳蚤市场等功能进行了介绍。</span></span></span></span></p>\r\n\r\n<p align=\"justify\" style=\"background: rgb(255,255,255); padding-bottom: 0pt; text-align: justify; padding-top: 0pt; padding-left: 0pt; margin-left: 0pt; padding-right: 0pt; margin-right: 0pt; text-indent: 24pt\"><span style=\"letter-spacing: 0pt\"><span style=\"font-size: 10.5pt\"><span style=\"color: rgb(51,51,51)\"><span style=\"font-family: 微软雅黑\">曾力勤对我校易班工作站的工作表示高度认可。他希望，湖南大学作为全省最早开展易班建设的高校之一，要发挥好示范带头作用，将湖大易班建设成更受学生欢迎、服务学生发展的连接载体。</span></span></span></span></p>\r\n\r\n<p align=\"justify\" style=\"background: rgb(255,255,255); padding-bottom: 0pt; text-align: justify; padding-top: 0pt; padding-left: 0pt; margin: 0pt; padding-right: 0pt; text-indent: 0pt\">&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1100','6','1','1441093610','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1211','6','843','1568110812','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1176','6','780','1495696622','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1175','6','824','1495405974','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1170','6','824','1495705576','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1166','1','824','1495696673','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1160','6','780','1487295936','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1161','6','780','1487296076','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1176','1','780','1495696622','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1209','6','843','1568110847','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1166','6','824','1495696673','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1177','6','780','1497194716','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1178','6','780','1497194716','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1187','6','884','1501260779','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1188','6','884','1501260793','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1189','6','884','1501260800','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1190','6','884','1501260808','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1191','6','884','1501260814','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1192','6','780','1501141202','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1193','6','780','1501141486','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1194','6','780','1501141447','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1195','6','780','1501297030','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1196','6','887','1501300682','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1197','6','887','1501300687','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1198','6','887','1501300693','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1199','6','887','1501300700','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1187','3','884','1501328621','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1212','6','843','1568110793','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1213','6','843','1568110773','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1214','6','843','1568182869','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1215','6','878','1568182992','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1216','6','878','1568182992','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1217','6','878','1568182992','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1218','6','878','1568183023','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1219','6','878','1568183023','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1220','6','878','1568183023','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1217','5','878','1568183937','admin');
REPLACE INTO `p8_cms_item_digg` VALUES ('1','1139','2','0');
REPLACE INTO `p8_cms_item_digg` VALUES ('2','1068','0','1');
REPLACE INTO `p8_cms_item_digg` VALUES ('3','1136','2','0');
REPLACE INTO `p8_cms_item_digg` VALUES ('4','1137','2','0');
REPLACE INTO `p8_cms_item_digg` VALUES ('5','234','1','0');
REPLACE INTO `p8_cms_item_digg` VALUES ('6','1140','1','1');
REPLACE INTO `p8_cms_item_digg` VALUES ('7','1138','1','0');
REPLACE INTO `p8_cms_item_digg` VALUES ('8','1192','1','0');
REPLACE INTO `p8_cms_item_digg` VALUES ('9','1175','1','0');
REPLACE INTO `p8_cms_item_mood` VALUES ('1','欠扁','1.gif','99');
REPLACE INTO `p8_cms_item_mood` VALUES ('2','支持','2.gif','88');
REPLACE INTO `p8_cms_item_mood` VALUES ('3','很棒','3.gif','77');
REPLACE INTO `p8_cms_item_mood` VALUES ('4','找骂','4.gif','66');
REPLACE INTO `p8_cms_item_mood` VALUES ('5','搞笑','5.gif','55');
REPLACE INTO `p8_cms_item_mood` VALUES ('6','软文','6.gif','44');
REPLACE INTO `p8_cms_item_mood` VALUES ('7','不解','7.gif','1');
REPLACE INTO `p8_cms_item_mood` VALUES ('8','吃惊','8.gif','1');
REPLACE INTO `p8_cms_item_page_` VALUES ('1201','page','783','1','admin','联系我们','','0','','','','','联系电话保卫部24小时综合值班电话：62782001部长办公室：62784630副部长办公室：62784629、62784631、62784632综合办公室：62782039保卫保密科：62782825、62782178交通科：62782602防火科：62782050、62794497集体户口及身份证办公室：62783270治安派出所：62783779、','','','','','','1','admin','0','1567649190','1567649190','1567649190','1567751189','1','','','10','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_page_` VALUES ('1202','page','825','1','admin','历史沿革','','0','','','','','历史沿革','','','','','','1','admin','0','1567649278','1567649278','1567649278','1568101750','1','','','17','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_page_` VALUES ('1203','page','781','1','admin','学院简介','','0','','<!--#p8_attach#-->/cms/item/2019_09/06_15/49de3f89ff01aedc.jpg.cthumb.jpg','','','2001年1月，北京与深圳市人民政府签署《合作创办北京大学深圳校区协议书》，共同创办北京大学深圳研究生院。经过十五年发展，深圳研究生院依托北大、立足深圳，逐步成为扎根深圳的北京大学研究型国际化校区，北京大学创建世界一流大学战略的重要组成部分。依托北京','','','','','','1','admin','0','1567649363','1567649363','1567649363','1568185073','1','','','46','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_page_` VALUES ('1204','page','847','1','admin','学生通道','','0','','','','','新生专区新生导航国微概况爱国微虚拟校园国微校友新生导读邮件系统学习咨询选课系统精品课程图书借阅查询移动图书馆生活服务校内交通校园网络校园一卡通医疗服务中心宿舍管理奖助专区勤工助学助学贷款奖学金管理校务服务学籍管理学生证办理课程查询','','','','','','1','admin','0','1567650154','1567650154','1567650154','1567650154','1','','','6','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";s:1:\\\"0\\\";s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_page_` VALUES ('1205','page','856','1','admin','教职工通道','','0','','','','','教学科研本科生教务研究生教务教师个人主页科研管理校务工作电子校务平台校园卡网上财务教学日历邮件系统生活服务校内交通工资查询公积金查询校园资讯吉林大学BBS移动校园通信名录虚拟校园','','','','','','1','admin','0','1567650246','1567650246','1567650246','1567650246','1','','','5','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";s:1:\\\"0\\\";s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_page_` VALUES ('1206','page','857','1','admin','校友通道','','0','','','','','校友服务校友活动各地校友会校友撷英校友捐赠校友刊物学校校友校园服务牡丹园虚拟校园移动校园学校图库通讯名录','','','','','','1','admin','0','1567650338','1567650338','1567650338','1567650338','1','','','6','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";s:1:\\\"0\\\";s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_page_` VALUES ('1207','page','858','1','admin','考生及访客通道','','0','','','','','认识学校学校简介历史沿革虚拟校园移动校园师资培养院系设置师资队伍研究生培养本科生培养合作交流研究生交流本科生交流公派留学招生咨询本科生招生研究生招生留学生招生继续教育招生网络招生国防生招生奖助学金勤工助学助学贷款奖学金管理','','','','','','1','admin','0','1567650410','1567650410','1567650410','1567650410','1','','','7','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";s:1:\\\"0\\\";s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_page_addon` VALUES ('1','1201','1','','','联系电话保卫部24小时综合值班电话：62782001部长办公室：62784630副部长办公室：62784629、62784631、62784632综合办公室：62782039保卫保密科：62782825、62782178交通科：62782602防火科：62782050、62794497集体户口及身份证办公室：62783270治安派出所：62783779、','220.170.143.6','113.246.108.183','1567649190','<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\"><strong style=\"word-break: break-all;\">联系电话</strong></p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">保卫部24小时综合值班电话：62782001</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">部长办公室：62784630</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">副部长办公室：62784629、62784631、62784632</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">综合办公室：62782039</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">保卫保密科：62782825、62782178</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">交通科：62782602</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">防火科：62782050、62794497</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">集体户口及身份证办公室：62783270</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">治安派出所：62783779、62771091、62782531、62796002</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">离退休党支部：62794975</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">东&nbsp; 门：62782165</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">南&nbsp; 门：62776790</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">西南门：62779052</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">西&nbsp; 门：62782465</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">油库门：62776792</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">西北门：62782837</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">北&nbsp; 门：62779057</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">紫荆门：62782500</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">&nbsp;</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">&nbsp;</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">&nbsp;</p>\r\n\r\n<p style=\"margin: 0px; padding: 0px; color: rgb(27, 27, 27); line-height: 28px; font-family: 宋体, Arial; font-size: 14px; word-break: break-all;\">&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_page_addon` VALUES ('2','1202','1','','','历史沿革','220.170.143.6','113.246.187.77','1567649278','<p>2001年1月，北京大学与深圳市人民政府签署《合作创办北京大学深圳校区协议书》，共同创办北京大学深圳研究生院。经过十五年发展，深圳研究生院依托北大、立足深圳，逐步成为扎根深圳的北京大学研究型国际化校区，北京大学创建世界一流大学战略的重要组成部分。</p>\r\n\r\n<p>依托北京大学学科优势，结合深圳的区位优势，深圳研究生院以&ldquo;前沿领域、交叉学科、应用学术、国际标准&rdquo;为办学方针，加强学科建设。现有信息工程学院、化学生物学与生物技术学院、环境与能源学院、城市规划与设计学院、新材料学院、汇丰商学院、国际法学院以及人文社会科学学院等八个学院，学科专业涉及信息科学与技术、电子与通讯技术、化学生物学、环境科学、环境与能源、城市与区域规划、景观设计学、社会学、心理学、新闻传播、金融、经济、管理、法律等领域。</p>\r\n\r\n<p>2001年1月，北京大学与深圳市人民政府签署《合作创办北京大学深圳校区协议书》，共同创办北京大学深圳研究生院。经过十五年发展，深圳研究生院依托北大、立足深圳，逐步成为扎根深圳的北京大学研究型国际化校区，北京大学创建世界一流大学战略的重要组成部分。</p>\r\n\r\n<p>依托北京大学学科优势，结合深圳的区位优势，深圳研究生院以&ldquo;前沿领域、交叉学科、应用学术、国际标准&rdquo;为办学方针，加强学科建设。现有信息工程学院、化学生物学与生物技术学院、环境与能源学院、城市规划与设计学院、新材料学院、汇丰商学院、国际法学院以及人文社会科学学院等八个学院，学科专业涉及信息科学与技术、电子与通讯技术、化学生物学、环境科学、环境与能源、城市与区域规划、景观设计学、社会学、心理学、新闻传播、金融、经济、管理、法律等领域。</p>\r\n');
REPLACE INTO `p8_cms_item_page_addon` VALUES ('3','1203','1','','<!--#p8_attach#-->/cms/item/2019_09/06_15/49de3f89ff01aedc.jpg.cthumb.jpg','2001年1月，北京与深圳市人民政府签署《合作创办北京大学深圳校区协议书》，共同创办北京大学深圳研究生院。经过十五年发展，深圳研究生院依托北大、立足深圳，逐步成为扎根深圳的北京大学研究型国际化校区，北京大学创建世界一流大学战略的重要组成部分。依托北京','220.170.143.6','113.218.171.101','1567649363','<p>2001年1月，北京与深圳市人民政府签署《合作创办北京大学深圳校区协议书》，共同创办深圳研究生院。经过十五年发展，研究生院依托北大、立足深圳，逐步成为扎根深圳的北京大学研究型国际化校区，北京大学创建世界一流大学战略的重要组成部分。</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style=\"text-align: center; text-indent: 0px;\"><a href=\"<!--#p8_attach#-->/cms/item/2019_09/06_15/5d430e7f54ced2ac.jpg\" target=\"_blank\"><img alt=\"012.jpg\" src=\"<!--#p8_attach#-->/cms/item/2019_09/06_15/5d430e7f54ced2ac.jpg\" style=\"width: 800px; height: 300px;\" /></a></p>\r\n\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n\r\n<p>依托北京大学学科优势，结合深圳的区位优势，深圳研究生院以&ldquo;前沿领域、交叉学科、应用学术、国际标准&rdquo;为办学方针，加强学科建设。现有信息工程学院、化学生物学与生物技术学院、环境与能源学院、城市规划与设计学院、新材料学院、汇丰商学院、国际法学院以及人文社会科学学院等八个学院，学科专业涉及信息科学与技术、电子与通讯技术、化学生物学、环境科学、环境与能源、城市与区域规划、景观设计学、社会学、心理学、新闻传播、金融、经济、管理、法律等领域。</p>\r\n\r\n<p>2001年1月，北京大学与深圳市人民政府签署《合作创办北京大学深圳校区协议书》，共同创办北京大学深圳研究生院。经过十五年发展，深圳研究生院依托北大、立足深圳，逐步成为扎根深圳的北京大学研究型国际化校区，北京大学创建世界一流大学战略的重要组成部分。</p>\r\n\r\n<p>依托北京大学学科优势，结合深圳的区位优势，深圳研究生院以&ldquo;前沿领域、交叉学科、应用学术、国际标准&rdquo;为办学方针，加强学科建设。现有信息工程学院、化学生物学与生物技术学院、环境与能源学院、城市规划与设计学院、新材料学院、汇丰商学院、国际法学院以及人文社会科学学院等八个学院，学科专业涉及信息科学与技术、电子与通讯技术、化学生物学、环境科学、环境与能源、城市与区域规划、景观设计学、社会学、心理学、新闻传播、金融、经济、管理、法律等领域。</p>\r\n');
REPLACE INTO `p8_cms_item_page_addon` VALUES ('4','1204','1','','','新生专区新生导航国微概况爱国微虚拟校园国微校友新生导读邮件系统学习咨询选课系统精品课程图书借阅查询移动图书馆生活服务校内交通校园网络校园一卡通医疗服务中心宿舍管理奖助专区勤工助学助学贷款奖学金管理校务服务学籍管理学生证办理课程查询','220.170.143.6','220.170.143.6','1567650154','<table border=\"0\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td class=\"f-16\" rowspan=\"20\" style=\"font-weight: bold; color: #ef7a08; padding-top: 10px\" valign=\"top\" width=\"20%\">新生专区</td>\r\n			<td width=\"40%\"><a href=\"#\">新生导航</a></td>\r\n			<td width=\"40%\"><a href=\"#\">国微概况</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">爱国微</a></td>\r\n			<td width=\"40%\"><a href=\"#\">虚拟校园</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">国微校友</a></td>\r\n			<td width=\"40%\"><a href=\"#\">新生导读</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">邮件系统</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td class=\"f-16\" rowspan=\"20\" style=\"font-weight: bold; color: #ef7a08; padding-top: 10px\" valign=\"top\" width=\"20%\">学习咨询</td>\r\n			<td width=\"40%\"><a href=\"#\">选课系统</a></td>\r\n			<td width=\"40%\"><a href=\"#\">精品课程</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">图书借阅查询</a></td>\r\n			<td width=\"40%\"><a href=\"#\">移动图书馆</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td class=\"f-16\" rowspan=\"20\" style=\"font-weight: bold; color: #ef7a08; padding-top: 10px\" valign=\"top\" width=\"20%\">生活服务</td>\r\n			<td width=\"40%\"><a href=\"#\">校内交通</a></td>\r\n			<td width=\"40%\"><a href=\"#\">校园网络</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">校园一卡通</a></td>\r\n			<td width=\"40%\"><a href=\"#\">医疗服务中心</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">宿舍管理</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td class=\"f-16\" rowspan=\"20\" style=\"font-weight: bold; color: #ef7a08; padding-top: 10px\" valign=\"top\" width=\"20%\">奖助专区</td>\r\n			<td width=\"40%\"><a href=\"#\">勤工助学</a></td>\r\n			<td width=\"40%\"><a href=\"#\">助学贷款</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">奖学金管理</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td class=\"f-16\" rowspan=\"20\" style=\"font-weight: bold; color: #ef7a08; padding-top: 10px\" valign=\"top\" width=\"20%\">校务服务</td>\r\n			<td width=\"40%\"><a href=\"#\">学籍管理</a></td>\r\n			<td width=\"40%\"><a href=\"#\">学生证办理</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">课程查询</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n');
REPLACE INTO `p8_cms_item_page_addon` VALUES ('5','1205','1','','','教学科研本科生教务研究生教务教师个人主页科研管理校务工作电子校务平台校园卡网上财务教学日历邮件系统生活服务校内交通工资查询公积金查询校园资讯吉林大学BBS移动校园通信名录虚拟校园','220.170.143.6','220.170.143.6','1567650246','<table border=\"0\" class=\"fl\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td class=\"f-16\" rowspan=\"20\" style=\"font-weight: bold; color: #ef7a08; padding-top: 10px\" valign=\"top\" width=\"20%\">教学科研</td>\r\n			<td width=\"40%\"><a href=\"#\">本科生教务</a></td>\r\n			<td width=\"40%\"><a href=\"#\">研究生教务</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">教师个人主页</a></td>\r\n			<td width=\"40%\"><a href=\"#\">科研管理</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" class=\"fl\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td class=\"f-16\" rowspan=\"20\" style=\"font-weight: bold; color: #ef7a08; padding-top: 10px\" valign=\"top\" width=\"20%\">校务工作</td>\r\n			<td width=\"40%\"><a href=\"#\">电子校务平台</a></td>\r\n			<td width=\"40%\"><a href=\"#\">校园卡</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">网上财务</a></td>\r\n			<td width=\"40%\"><a href=\"#\">教学日历</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">邮件系统</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" class=\"fl\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td class=\"f-16\" rowspan=\"20\" style=\"font-weight: bold; color: #ef7a08; padding-top: 10px\" valign=\"top\" width=\"20%\">生活服务</td>\r\n			<td width=\"40%\"><a href=\"#\">校内交通</a></td>\r\n			<td width=\"40%\"><a href=\"#\">工资查询</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">公积金查询</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" class=\"fl\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td class=\"f-16\" rowspan=\"20\" style=\"font-weight: bold; color: #ef7a08; padding-top: 10px\" valign=\"top\" width=\"20%\">校园资讯</td>\r\n			<td width=\"40%\"><a href=\"#\">吉林大学BBS</a></td>\r\n			<td width=\"40%\"><a href=\"#\">移动校园</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">通信名录</a></td>\r\n			<td width=\"40%\"><a href=\"#\">虚拟校园</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_page_addon` VALUES ('6','1206','1','','','校友服务校友活动各地校友会校友撷英校友捐赠校友刊物学校校友校园服务牡丹园虚拟校园移动校园学校图库通讯名录','220.170.143.6','220.170.143.6','1567650338','<table border=\"0\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td class=\"f-16\" rowspan=\"20\" style=\"font-weight: bold; color: #ef7a08; padding-top: 10px\" valign=\"top\" width=\"20%\">校友服务</td>\r\n			<td width=\"40%\"><a href=\"#\">校友活动</a></td>\r\n			<td width=\"40%\"><a href=\"#\">各地校友会</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">校友撷英</a></td>\r\n			<td width=\"40%\"><a href=\"#\">校友捐赠</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td class=\"f-16\" style=\"font-weight: bold; color: #ef7a08; padding-top: 10px\" valign=\"top\" width=\"20%\">校友刊物</td>\r\n			<td width=\"80%\"><a href=\"#\">学校校友</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td class=\"f-16\" rowspan=\"20\" style=\"font-weight: bold; color: #ef7a08; padding-top: 10px\" valign=\"top\" width=\"20%\">校园服务</td>\r\n			<td width=\"40%\"><a href=\"#\">牡丹园</a></td>\r\n			<td width=\"40%\"><a href=\"#\">虚拟校园</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">移动校园</a></td>\r\n			<td width=\"40%\"><a href=\"#\">学校图库</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">通讯名录</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n');
REPLACE INTO `p8_cms_item_page_addon` VALUES ('7','1207','1','','','认识学校学校简介历史沿革虚拟校园移动校园师资培养院系设置师资队伍研究生培养本科生培养合作交流研究生交流本科生交流公派留学招生咨询本科生招生研究生招生留学生招生继续教育招生网络招生国防生招生奖助学金勤工助学助学贷款奖学金管理','220.170.143.6','220.170.143.6','1567650410','<table border=\"0\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td class=\"f-16\" rowspan=\"20\" style=\"font-weight: bold; color: #ef7a08; padding-top: 10px\" valign=\"top\" width=\"20%\">认识学校</td>\r\n			<td width=\"40%\"><a href=\"#\">学校简介</a></td>\r\n			<td width=\"40%\"><a href=\"#\">历史沿革</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">虚拟校园</a></td>\r\n			<td width=\"40%\"><a href=\"#\">移动校园</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td class=\"f-16\" rowspan=\"20\" style=\"font-weight: bold; color: #ef7a08; padding-top: 10px\" valign=\"top\" width=\"20%\">师资培养</td>\r\n			<td width=\"40%\"><a href=\"#\">院系设置</a></td>\r\n			<td width=\"40%\"><a href=\"#\">师资队伍</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">研究生培养</a></td>\r\n			<td width=\"40%\"><a href=\"#\">本科生培养</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td class=\"f-16\" rowspan=\"20\" style=\"font-weight: bold; color: #ef7a08; padding-top: 10px\" valign=\"top\" width=\"20%\">合作交流</td>\r\n			<td width=\"40%\"><a href=\"#\">研究生交流</a></td>\r\n			<td width=\"40%\"><a href=\"#\">本科生交流</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">公派留学</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td class=\"f-16\" rowspan=\"20\" style=\"font-weight: bold; color: #ef7a08; padding-top: 10px\" valign=\"top\" width=\"20%\">招生咨询</td>\r\n			<td width=\"40%\"><a href=\"#\">本科生招生</a></td>\r\n			<td width=\"40%\"><a href=\"#\">研究生招生</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">留学生招生</a></td>\r\n			<td width=\"40%\"><a href=\"#\">继续教育招生</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">网络招生</a></td>\r\n			<td width=\"40%\"><a href=\"#\">国防生招生</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table border=\"0\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td class=\"f-16\" rowspan=\"20\" style=\"font-weight: bold; color: #ef7a08; padding-top: 10px\" valign=\"top\" width=\"20%\">奖助学金</td>\r\n			<td width=\"40%\"><a href=\"#\">勤工助学</a></td>\r\n			<td width=\"40%\"><a href=\"#\">助学贷款</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td width=\"40%\"><a href=\"#\">奖学金管理</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n');
REPLACE INTO `p8_cms_item_photo_` VALUES ('1196','photo','887','1','admin','校园风景','','0','','<!--#p8_attach#-->/cms/item/2017_07/29_11/31275d7b4d2fbbb2.png','','6','校园风景介绍','','','','','','1','','0','1469764448','1501300448','1469764448','1501300682','1','','','1','0','0','','','','');
REPLACE INTO `p8_cms_item_photo_` VALUES ('1197','photo','887','1','admin','校园风景','','0','','<!--#p8_attach#-->/cms/item/2017_07/29_11/2f1b42ec4d83b823.jpg','','6','校园风景2','','','','','','1','','0','1469764448','1501300488','1469764448','1501300687','1','','','0','0','0','','','','');
REPLACE INTO `p8_cms_item_photo_` VALUES ('1198','photo','887','1','admin','校园一角','','0','','<!--#p8_attach#-->/cms/item/2017_07/29_11/684aa815569c45f3.png','','6','校园一角2','','','','','','1','','0','1469764448','1501300537','1469764448','1501300693','1','','','1','0','0','','','','');
REPLACE INTO `p8_cms_item_photo_` VALUES ('1199','photo','887','1','admin','教学楼','','0','','<!--#p8_attach#-->/cms/item/2017_07/29_11/f56160a401c549c3.jpg','','6','教学楼2','','','','','','1','','0','1469764448','1501300595','1469764448','1501300700','1','','','17','0','0','','','','');
REPLACE INTO `p8_cms_item_photo_addon` VALUES ('1','1196','1','','<!--#p8_attach#-->/cms/item/2017_07/29_11/31275d7b4d2fbbb2.png','校园风景介绍','113.247.22.86','113.247.22.86','1469764448','<p>校园风景介绍</p>\r\n','14.jpg<!--#p8_attach#-->/cms/item/2017_07/29_11/149d34335c6b821f.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2017_07/29_11/149d34335c6b821f.jpg.thumb.jpg');
REPLACE INTO `p8_cms_item_photo_addon` VALUES ('2','1197','1','','<!--#p8_attach#-->/cms/item/2017_07/29_11/2f1b42ec4d83b823.jpg','校园风景2','113.247.22.86','113.247.22.86','1469764448','&nbsp;校园风景2','3.png<!--#p8_attach#-->/cms/item/2017_07/29_11/e286fd5b56fbba97.png.cthumb.jpg<!--#p8_attach#-->/cms/item/2017_07/29_11/e286fd5b56fbba97.png.thumb.jpg');
REPLACE INTO `p8_cms_item_photo_addon` VALUES ('3','1198','1','','<!--#p8_attach#-->/cms/item/2017_07/29_11/684aa815569c45f3.png','校园一角2','113.247.22.86','113.247.22.86','1469764448','&nbsp;校园一角2','2.png<!--#p8_attach#-->/cms/item/2017_07/29_11/05cfca56d7f7a132.png.cthumb.jpg<!--#p8_attach#-->/cms/item/2017_07/29_11/05cfca56d7f7a132.png.thumb.jpg');
REPLACE INTO `p8_cms_item_photo_addon` VALUES ('4','1199','1','','<!--#p8_attach#-->/cms/item/2017_07/29_11/f56160a401c549c3.jpg','教学楼2','113.247.22.86','113.247.22.86','1469764448','&nbsp;教学楼2','11.jpg<!--#p8_attach#-->/cms/item/2017_07/29_11/3fde38399d11c656.png.cthumb.jpg<!--#p8_attach#-->/cms/item/2017_07/29_11/3fde38399d11c656.png.thumb.jpg');
REPLACE INTO `p8_cms_item_video_` VALUES ('1187','video','884','1','admin','麻省理工学院：算法导论','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_14/c7dbb3c44f1a9192.jpg','','6,3','麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工','','','','','','1','','0','1468392451','1501138051','1469602051','1501260779','1','','','12','0','0','','','','');
REPLACE INTO `p8_cms_item_video_` VALUES ('1188','video','884','1','admin','操作系统','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_14/d42072e91a45aa7b.jpg','','6','操作系统（Operating System，简称OS）是管理和控制计算机硬件与软件资源的计算机程序，是直接运行在“裸机”上的最基本的系统软件，任何其他软件都必须在操作系统的支持下才能运行。操作系统是用户和计算机的接口，同时也是计算机硬件和其他软件的接口。操作','','','','','','1','','0','1469548800','1501138108','1469548800','1501260793','1','','','2','0','0','','','','');
REPLACE INTO `p8_cms_item_video_` VALUES ('1189','video','884','1','admin','计算机组原理','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_14/d9e66c4bd1e07169.jpg','','6','课程在以培养学生创新能力和解决实际问题的能力为主的思想指导下，形成了由理论课、实验课、计算机设计与实践构成的课程体系。使学生系统地理解计算机硬件系统的组织结构和工作原理，掌握计算机硬件系统的基本分析与设计方法，建立计算机系统的整体概念。','','','','','','1','','0','1469548800','1501138259','1469548800','1501260800','1','','','7','0','0','','','','');
REPLACE INTO `p8_cms_item_video_` VALUES ('1190','video','884','1','admin','计算机网络','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_14/f7afd5ca201141d8.jpg','','6','计算机网络也称计算机通信网。关于计算机网络的最简单定义是：一些相互连接的、以共享资源为目的的、自治的计算机的集合。若按此定义，则早期的面向终端的网络都不能算是计算机网络，而只能称为联机系统（因为那时的许多终端不能算是自治的计算机）。但随着硬件价格的下','','','','','','1','','0','1469548800','1501138328','1469548800','1501260808','1','','','3','0','0','','','','');
REPLACE INTO `p8_cms_item_video_` VALUES ('1191','video','884','1','admin','数据结构基础','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_14/37ef06e9c33d0eee.jpg','','6','数据结构','','','','','','1','','0','1469548800','1501138426','1469548800','1501260814','1','','','8','0','0','','','','');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('1','1187','1','','<!--#p8_attach#-->/cms/item/2017_07/27_14/c7dbb3c44f1a9192.jpg','麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工','113.246.94.58','113.247.23.144','1468392451','麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理','390','http://v.ifeng.com/include/exterior.swf?AutoPlay=false&amp;guid=15d02f18-e22a-4a3d-b8b3-be0a2942bbd6','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('2','1188','1','','<!--#p8_attach#-->/cms/item/2017_07/27_14/d42072e91a45aa7b.jpg','操作系统（Operating System，简称OS）是管理和控制计算机硬件与软件资源的计算机程序，是直接运行在“裸机”上的最基本的系统软件，任何其他软件都必须在操作系统的支持下才能运行。操作系统是用户和计算机的接口，同时也是计算机硬件和其他软件的接口。操作','113.246.94.58','113.247.23.144','1469548800','<div class=\"para\" label-module=\"para\" style=\"font-size: 14px; word-wrap: break-word; margin-bottom: 15px; font-family: arial, 宋体, sans-serif; zoom: 1; color: rgb(51,51,51); line-height: 24px; background-color: rgb(255,255,255); text-indent: 28px\"><a data-lemmaid=\"192\" href=\"https://baike.baidu.com/item/%E6%93%8D%E4%BD%9C%E7%B3%BB%E7%BB%9F/192\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">操作系统</a>（<a href=\"https://baike.baidu.com/item/Operating%20System\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">Operating System</a>，简称OS）是管理和控制<a href=\"https://baike.baidu.com/item/%E8%AE%A1%E7%AE%97%E6%9C%BA\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">计算机</a><a href=\"https://baike.baidu.com/item/%E7%A1%AC%E4%BB%B6\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">硬件</a>与<a data-lemmaid=\"12053\" href=\"https://baike.baidu.com/item/%E8%BD%AF%E4%BB%B6/12053\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">软件</a>资源的<a href=\"https://baike.baidu.com/item/%E8%AE%A1%E7%AE%97%E6%9C%BA\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">计算机</a>程序，是直接运行在&ldquo;<a href=\"https://baike.baidu.com/item/%E8%A3%B8%E6%9C%BA\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">裸机</a>&rdquo;上的最基本的<a href=\"https://baike.baidu.com/item/%E7%B3%BB%E7%BB%9F%E8%BD%AF%E4%BB%B6\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">系统软件</a>，任何其他软件都必须在<a data-lemmaid=\"192\" href=\"https://baike.baidu.com/item/%E6%93%8D%E4%BD%9C%E7%B3%BB%E7%BB%9F/192\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">操作系统</a>的支持下才能运行。</div>\r\n\r\n<div class=\"para\" label-module=\"para\" style=\"font-size: 14px; word-wrap: break-word; margin-bottom: 15px; font-family: arial, 宋体, sans-serif; zoom: 1; color: rgb(51,51,51); line-height: 24px; background-color: rgb(255,255,255); text-indent: 28px\">操作系统是<a href=\"https://baike.baidu.com/item/%E7%94%A8%E6%88%B7\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">用户</a>和<a href=\"https://baike.baidu.com/item/%E8%AE%A1%E7%AE%97%E6%9C%BA\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">计算机</a>的<a href=\"https://baike.baidu.com/item/%E6%8E%A5%E5%8F%A3\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">接口</a>，同时也是计算机<a href=\"https://baike.baidu.com/item/%E7%A1%AC%E4%BB%B6\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">硬件</a>和其他<a data-lemmaid=\"12053\" href=\"https://baike.baidu.com/item/%E8%BD%AF%E4%BB%B6/12053\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">软件</a>的接口。<a data-lemmaid=\"192\" href=\"https://baike.baidu.com/item/%E6%93%8D%E4%BD%9C%E7%B3%BB%E7%BB%9F/192\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">操作系统</a>的功能包括管理<a href=\"https://baike.baidu.com/item/%E8%AE%A1%E7%AE%97%E6%9C%BA%E7%B3%BB%E7%BB%9F\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">计算机系统</a>的<a href=\"https://baike.baidu.com/item/%E7%A1%AC%E4%BB%B6\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">硬件</a>、软件及数据资源，<a href=\"https://baike.baidu.com/item/%E6%8E%A7%E5%88%B6\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">控制</a>程序运行，改善<a href=\"https://baike.baidu.com/item/%E4%BA%BA%E6%9C%BA%E7%95%8C%E9%9D%A2\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">人机界面</a>，为其它<a href=\"https://baike.baidu.com/item/%E5%BA%94%E7%94%A8%E8%BD%AF%E4%BB%B6\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">应用软件</a>提供支持，让<a href=\"https://baike.baidu.com/item/%E8%AE%A1%E7%AE%97%E6%9C%BA%E7%B3%BB%E7%BB%9F\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">计算机系统</a>所有资源最大限度地发挥作用，提供各种形式的<a href=\"https://baike.baidu.com/item/%E7%94%A8%E6%88%B7%E7%95%8C%E9%9D%A2\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">用户界面</a>，使用户有一个好的工作环境，为其它软件的开发提供必要的服务和相应的接口等。实际上，用户是不用接触操作系统的，操作系统管理着<a href=\"https://baike.baidu.com/item/%E8%AE%A1%E7%AE%97%E6%9C%BA%E7%A1%AC%E4%BB%B6\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">计算机硬件</a>资源，同时按照<a href=\"https://baike.baidu.com/item/%E5%BA%94%E7%94%A8%E7%A8%8B%E5%BA%8F\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">应用程序</a>的资源请求，分配资源，如：划分<a href=\"https://baike.baidu.com/item/CPU\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">CPU</a>时间，<a href=\"https://baike.baidu.com/item/%E5%86%85%E5%AD%98\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">内存</a>空间的开辟，调用<a href=\"https://baike.baidu.com/item/%E6%89%93%E5%8D%B0%E6%9C%BA\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">打印机</a>等。</div>\r\n','390','http://player.youku.com/player.php/sid/XMjgxMDc0OTg1Ng==/v.swf','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('3','1189','1','','<!--#p8_attach#-->/cms/item/2017_07/27_14/d9e66c4bd1e07169.jpg','课程在以培养学生创新能力和解决实际问题的能力为主的思想指导下，形成了由理论课、实验课、计算机设计与实践构成的课程体系。使学生系统地理解计算机硬件系统的组织结构和工作原理，掌握计算机硬件系统的基本分析与设计方法，建立计算机系统的整体概念。','113.246.94.58','113.247.23.144','1469548800','<span style=\"color: rgb(102,102,102)\">课程在以培养学生创新能力和解决实际问题的能力为主的思想指导下，形成了由理论课、实验课、计算机设计与实践构成的课程体系。使学生系统地理解计算机硬件系统的组织结构和工作原理，掌握计算机硬件系统的基本分析与设计方法，建立计算机系统的整体概念。</span>','390','http://player.youku.com/player.php/sid/XMjkwNzU2NDA0NA==/v.swf','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('4','1190','1','','<!--#p8_attach#-->/cms/item/2017_07/27_14/f7afd5ca201141d8.jpg','计算机网络也称计算机通信网。关于计算机网络的最简单定义是：一些相互连接的、以共享资源为目的的、自治的计算机的集合。若按此定义，则早期的面向终端的网络都不能算是计算机网络，而只能称为联机系统（因为那时的许多终端不能算是自治的计算机）。但随着硬件价格的下','113.246.94.58','113.247.23.144','1469548800','<div class=\"para\" label-module=\"para\" style=\"font-size: 14px; word-wrap: break-word; margin-bottom: 15px; font-family: arial, 宋体, sans-serif; zoom: 1; color: rgb(51,51,51); line-height: 24px; background-color: rgb(255,255,255); text-indent: 2em\">计算机网络也称计算机通信网。关于<a href=\"https://baike.baidu.com/item/%E8%AE%A1%E7%AE%97%E6%9C%BA\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">计算机</a>网络的最简单定义是：一些相互连接的、以<a href=\"https://baike.baidu.com/item/%E5%85%B1%E4%BA%AB%E8%B5%84%E6%BA%90\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">共享资源</a>为目的的、自治的计算机的集合。若按此定义，则早期的面向终端的网络都不能算是计算机网络，而只能称为联机系统（因为那时的许多终端不能算是自治的计算机）。但随着硬件价格的下降，许多终端都具有一定的智能，因而&ldquo;终端&rdquo;和&ldquo;自治的计算机&rdquo;逐渐失去了严格的界限。若用微型计算机作为终端使用，按上述定义，则早期的那种面向终端的网络也可称为计算机网络。</div>\r\n\r\n<div class=\"para\" label-module=\"para\" style=\"font-size: 14px; word-wrap: break-word; margin-bottom: 15px; font-family: arial, 宋体, sans-serif; zoom: 1; color: rgb(51,51,51); line-height: 24px; background-color: rgb(255,255,255); text-indent: 2em\">另外，从<a href=\"https://baike.baidu.com/item/%E9%80%BB%E8%BE%91\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">逻辑</a>功能上看，<a href=\"https://baike.baidu.com/item/%E8%AE%A1%E7%AE%97%E6%9C%BA%E7%BD%91%E7%BB%9C\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">计算机网络</a>是以传输信息为<a href=\"https://baike.baidu.com/item/%E5%9F%BA%E7%A1%80\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">基础</a>目的，用<a href=\"https://baike.baidu.com/item/%E9%80%9A%E4%BF%A1%E7%BA%BF%E8%B7%AF\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">通信线路</a>将多个计算机连接起来的计算机系统的集合，一个计算机网络组成包括<a href=\"https://baike.baidu.com/item/%E4%BC%A0%E8%BE%93%E4%BB%8B%E8%B4%A8\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">传输介质</a>和<a href=\"https://baike.baidu.com/item/%E9%80%9A%E4%BF%A1%E8%AE%BE%E5%A4%87\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">通信设备</a>。</div>\r\n\r\n<div class=\"para\" label-module=\"para\" style=\"font-size: 14px; word-wrap: break-word; margin-bottom: 15px; font-family: arial, 宋体, sans-serif; zoom: 1; color: rgb(51,51,51); line-height: 24px; background-color: rgb(255,255,255); text-indent: 2em\">从用户角度看，计算机网络是这样定义的：存在着一个能为用户自动管理的网络<a href=\"https://baike.baidu.com/item/%E6%93%8D%E4%BD%9C%E7%B3%BB%E7%BB%9F\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">操作系统</a>。由它调用完成用户所调用的资源，而整个网络像一个大的计算机系统一样，对<a href=\"https://baike.baidu.com/item/%E7%94%A8%E6%88%B7\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">用户</a>是透明的。</div>\r\n\r\n<div class=\"para\" label-module=\"para\" style=\"font-size: 14px; word-wrap: break-word; margin-bottom: 15px; font-family: arial, 宋体, sans-serif; zoom: 1; color: rgb(51,51,51); line-height: 24px; background-color: rgb(255,255,255); text-indent: 2em\">一个比较通用的定义是：利用<a href=\"https://baike.baidu.com/item/%E9%80%9A%E4%BF%A1%E7%BA%BF%E8%B7%AF\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">通信线路</a>将地理上分散的、具有独立功能的<a href=\"https://baike.baidu.com/item/%E8%AE%A1%E7%AE%97%E6%9C%BA%E7%B3%BB%E7%BB%9F\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">计算机系统</a>和通信设备按不同的形式连接起来，以功能完善的网络软件及协议实现资源共享和信息传递的系统。</div>\r\n\r\n<div class=\"para\" label-module=\"para\" style=\"font-size: 14px; word-wrap: break-word; margin-bottom: 15px; font-family: arial, 宋体, sans-serif; zoom: 1; color: rgb(51,51,51); line-height: 24px; background-color: rgb(255,255,255); text-indent: 2em\">从整体上来说计算机网络就是把分布在不同地理区域的计算机与专门的外部设备用通信线路互联成一个规模大、功能强的系统，从而使众多的计算机可以方便地互相传递信息，共享<a href=\"https://baike.baidu.com/item/%E7%A1%AC%E4%BB%B6\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">硬件</a>、软件、数据信息等资源。简单来说，计算机网络就是由通信线路互相连接的许多自主工作的计算机构成的集合体。</div>\r\n\r\n<div class=\"para\" label-module=\"para\" style=\"font-size: 14px; word-wrap: break-word; margin-bottom: 15px; font-family: arial, 宋体, sans-serif; zoom: 1; color: rgb(51,51,51); line-height: 24px; background-color: rgb(255,255,255); text-indent: 2em\">最简单的计算机网络就只有两台计算机和连接它们的一条链路，即两个节点和一条链路。</div>\r\n','390','http://player.youku.com/player.php/sid/XMjc1NzM3NjIyOA==/v.swf','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('5','1191','1','','<!--#p8_attach#-->/cms/item/2017_07/27_14/37ef06e9c33d0eee.jpg','数据结构','113.246.94.58','113.247.23.144','1469548800','<span style=\"font-size: 12px; font-family: Simsun; color: rgb(67,67,67); widows: 1; background-color: rgb(255,255,255)\">《数据结构》课程简介 课程名称（中英文）学时学分先修课程数据结构684程序设计课程简介： 数据结构是计算机专业本科最基础、最重要的课程之一。 本课程以数据的逻辑关系为线索，介绍了线性关系、树状关系、集合关系和图型关系的数据元素的存储及处理方法、每个数据结构对应的类的C++实现、以及每个数据结构的主要应用，同时还讲解了算法设计和分析的基本知识。</span>','390','http://player.youku.com/player.php/sid/XMjczOTA5NjAxMg==/v.swf','450');
REPLACE INTO `p8_cms_model` VALUES ('1','article','文章内容','0','1','a:7:{s:14:\"prev&next_item\";s:1:\"1\";s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('2','product','产品','0','0','a:7:{s:14:\"prev&next_item\";s:1:\"1\";s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('3','photo','图片内容','0','1','a:7:{s:14:\"prev&next_item\";s:1:\"1\";s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:3:\"900\";s:20:\"content_thumb_height\";s:3:\"700\";}');
REPLACE INTO `p8_cms_model` VALUES ('9','govopen','信息公开','0','0','a:0:{}');
REPLACE INTO `p8_cms_model` VALUES ('6','people','人物','0','0','a:7:{s:14:\"prev&next_item\";s:1:\"1\";s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('4','video','视频内容','0','1','a:7:{s:12:\"allow_custom\";s:1:\"0\";s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:3:\"800\";s:18:\"frame_thumb_height\";s:3:\"480\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('5','down','下载内容','0','1','a:9:{s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";s:11:\"hidedownurl\";s:1:\"0\";s:9:\"thunderid\";s:0:\"\";s:10:\"flashgetid\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('10','page','单网页','0','1','a:0:{}');
REPLACE INTO `p8_cms_model_field` VALUES ('1','article','0','content','内容','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor','','99','','');
REPLACE INTO `p8_cms_model_field` VALUES ('8','photo','0','content','内容','mediumtext','0','0','0','0','','0','1','','a:0:{}','a:0:{}','editor','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('3','product','0','aboutinfo','试用与预订','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor_common','','9','','');
REPLACE INTO `p8_cms_model_field` VALUES ('4','product','0','attrbutes','产品参数','text','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor_basic','','88','','');
REPLACE INTO `p8_cms_model_field` VALUES ('5','product','0','content','产品介绍','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor_common','','99','','');
REPLACE INTO `p8_cms_model_field` VALUES ('6','product','0','pics','图片欣赏','text','0','0','0','1','','0','1','','a:0:{}','a:0:{}','multi_uploader','','6','','');
REPLACE INTO `p8_cms_model_field` VALUES ('7','product','0','pro_down','相关下载','varchar','0','0','0','0','255','0','1','','a:0:{}','a:0:{}','uploader','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('9','photo','0','photourl','图片地址','text','0','0','0','1','','0','1','','a:0:{}','a:0:{}','multi_uploader','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('21','down','0','totaldown','总下载量','mediumint','0','0','0','1','5','0','0','','a:0:{}','a:0:{}','text','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('50','govopen','0','geshi','格式','tinyint','1','1','0','1','3','0','1','','a:7:{i:1;s:3:\"DOC\";i:2;s:3:\"TXT\";i:3;s:3:\"JPG\";i:4;s:3:\"PDF\";i:5;s:3:\"MP3\";i:6;s:4:\"MPEG\";i:7;s:4:\"其它\";}','a:0:{}','select','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('19','down','0','softsize','资源大小','varchar','0','0','0','1','10','0','1','','a:0:{}','a:0:{}','text','','55','K','');
REPLACE INTO `p8_cms_model_field` VALUES ('20','down','0','softurl','资源地址','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','uploader','','44','','');
REPLACE INTO `p8_cms_model_field` VALUES ('24','people','0','award','获奖荣誉','mediumtext','0','0','0','0','','0','1','','a:0:{}','a:0:{}','editor_common','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('34','people','0','photo','照片','text','0','0','0','1','','0','1','','a:0:{}','a:0:{}','image_uploader','','3','','照片大小：148*220');
REPLACE INTO `p8_cms_model_field` VALUES ('30','people','0','Hometown','籍贯','varchar','0','0','0','1','255','0','1','','a:0:{}','a:0:{}','text','','8','','');
REPLACE INTO `p8_cms_model_field` VALUES ('31','people','0','motion','企业提案','mediumtext','0','0','0','0','','0','1','','a:0:{}','a:0:{}','editor_common','','1','','');
REPLACE INTO `p8_cms_model_field` VALUES ('33','people','0','office','职务','varchar','0','0','0','1','255','0','1','','a:0:{}','a:0:{}','text','','4','','');
REPLACE INTO `p8_cms_model_field` VALUES ('32','people','0','name','姓名','varchar','1','1','1','1','255','0','1','','a:0:{}','a:0:{}','text','','9','','');
REPLACE INTO `p8_cms_model_field` VALUES ('14','down','0','content','资源介绍','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor','','33','','');
REPLACE INTO `p8_cms_model_field` VALUES ('49','govopen','0','duixiang','对象','tinyint','1','1','0','1','3','0','1','','a:3:{i:1;s:4:\"学生\";i:2;s:4:\"老师\";i:9;s:4:\"其它\";}','a:0:{}','select','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('55','govopen','0','wenhao','文号','varchar','1','0','0','0','255','0','1','','a:0:{}','a:0:{}','text','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('57','govopen','0','xinxifenlei','信息分类','varchar','0','0','0','1','50','0','1','','a:0:{}','a:0:{}','text','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('10','video','0','content','内容','mediumtext','0','0','0','1','0','0','1','','a:0:{}','a:0:{}','editor','','99','','');
REPLACE INTO `p8_cms_model_field` VALUES ('11','video','0','video_height','视频高度','smallint','0','0','0','1','5','0','1','390','a:0:{}','a:0:{}','text','','77','像素','');
REPLACE INTO `p8_cms_model_field` VALUES ('12','video','0','video_url','视频地址','varchar','0','0','0','0','255','0','1','http://','a:0:{}','a:2:{s:11:\"thumb_width\";s:3:\"120\";s:12:\"thumb_height\";s:2:\"90\";}','video_uploader','','66','','');
REPLACE INTO `p8_cms_model_field` VALUES ('13','video','0','video_width','视频宽度','smallint','0','0','0','1','5','0','1','450','a:0:{}','a:0:{}','text','','88','像素','');
REPLACE INTO `p8_cms_model_field` VALUES ('28','people','0','education','学历','varchar','0','0','0','1','255','0','1','','a:0:{}','a:0:{}','text','','6','','');
REPLACE INTO `p8_cms_model_field` VALUES ('48','govopen','0','content','内容','mediumtext','0','0','0','1','0','0','1','','a:0:{}','a:0:{}','editor','','99','','');
REPLACE INTO `p8_cms_model_field` VALUES ('29','people','0','event','人物事迹','mediumtext','0','0','0','0','','0','1','','a:0:{}','a:0:{}','editor_common','','2','','');
REPLACE INTO `p8_cms_model_field` VALUES ('25','people','0','birthday','出生日期','varchar','0','0','0','1','255','0','1','','a:0:{}','a:0:{}','text','','7','','');
REPLACE INTO `p8_cms_model_field` VALUES ('26','people','0','content','人物介绍','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor_common','','2','','');
REPLACE INTO `p8_cms_model_field` VALUES ('27','people','0','department','部门','varchar','1','1','1','1','255','0','1','','a:0:{}','a:0:{}','text','','5','','');
REPLACE INTO `p8_cms_model_field` VALUES ('51','govopen','0','jigou','机构分类','tinyint','1','1','0','1','3','0','1','','a:11:{i:1;s:16:\"广州市天河区政府\";i:2;s:16:\"广州市越秀区政府\";i:3;s:16:\"广州市东山区政府\";i:4;s:16:\"广州市白云区政府\";i:5;s:16:\"广州市黄埔区政府\";i:6;s:16:\"广州市花都区政府\";i:7;s:16:\"广州市海珠区政府\";i:8;s:16:\"广州市南沙区政府\";i:9;s:16:\"广州市荔湾区政府\";i:10;s:16:\"广州市番禺区政府\";i:11;s:16:\"广州市萝岗区政府\";}','a:0:{}','select','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('52','govopen','0','shengming','生命周期','tinyint','1','1','0','1','3','0','1','','a:5:{i:1;s:6:\"婴幼儿\";i:2;s:6:\"青少年\";i:3;s:4:\"中年\";i:4;s:4:\"老年\";i:5;s:4:\"其它\";}','a:0:{}','select','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('53','govopen','0','suoyin','索引号','varchar','1','0','0','1','255','0','1','','a:0:{}','a:0:{}','text','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('54','govopen','0','ticai','体裁','tinyint','1','1','0','1','3','0','1','','a:14:{i:1;s:4:\"命令\";i:2;s:4:\"决定\";i:3;s:4:\"通告\";i:4;s:4:\"通知\";i:5;s:4:\"公告\";i:6;s:4:\"通报\";i:7;s:4:\"议案\";i:8;s:4:\"报告\";i:9;s:4:\"请示\";i:10;s:4:\"批复\";i:11;s:4:\"意见\";i:12;s:2:\"函\";i:13;s:8:\"会议纪要\";i:14;s:4:\"其它\";}','a:0:{}','select','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('58','page','0','content','','mediumtext','0','0','0','1','0','0','1','','a:0:{}','a:0:{}','editor','','99','','');
REPLACE INTO `p8_config` VALUES ('core','','string','index_system','cms');
REPLACE INTO `p8_config` VALUES ('cms','','string','template','school707');
REPLACE INTO `p8_config` VALUES ('cms','','string','forbidden_dynamic','0');
REPLACE INTO `p8_config` VALUES ('cms','','string','index_to_html_crontab_id','');
REPLACE INTO `p8_config` VALUES ('cms','','string','index_file','1');
REPLACE INTO `p8_config` VALUES ('cms','','string','mobile_template','mobile/school');
REPLACE INTO `p8_config` VALUES ('cms','','serialize','_hook_modules','a:1:{s:4:\"item\";a:2:{s:3:\"cms\";a:1:{s:8:\"category\";s:3:\"cid\";}s:4:\"core\";a:1:{s:6:\"member\";s:3:\"uid\";}}}');
REPLACE INTO `p8_config` VALUES ('cms','','serialize','hook_modules','a:2:{s:8:\"category\";a:1:{s:3:\"cms\";a:1:{s:4:\"item\";s:3:\"cid\";}}s:4:\"item\";a:1:{s:4:\"core\";a:1:{s:8:\"uploader\";s:7:\"item_id\";}}}');
REPLACE INTO `p8_config` VALUES ('cms','item','string','dynamic_list_url_rule','{$module_controller}-list-category-{$id}#-page-{$page}#.shtml');
REPLACE INTO `p8_config` VALUES ('cms','item','string','dynamic_view_url_rule','{$module_controller}-view-id-{$id}#-page-{$page}#.shtml');
REPLACE INTO `p8_config` VALUES ('cms','item','string','mobile_dynamic_list_url_rule','{$module_mobile_controller}-list-mid-{$id}#-page-{$page}#.html');
REPLACE INTO `p8_config` VALUES ('cms','item','string','mobile_dynamic_view_url_rule','{$module_mobile_controller}-view-id-{$id}.html');
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
REPLACE INTO `p8_config` VALUES ('cms','item','string','template','school707');
REPLACE INTO `p8_config` VALUES ('cms','item','string','htmlize','1');
REPLACE INTO `p8_config` VALUES ('cms','item','serialize','verify_acl','a:5:{i:2;a:2:{s:4:\"name\";s:6:\"初审\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}i:1;a:2:{s:4:\"name\";s:6:\"终审\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}i:0;a:2:{s:4:\"name\";s:12:\"取消审核\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}i:88;a:2:{s:4:\"name\";s:9:\"回收站\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}i:-99;a:2:{s:4:\"name\";s:6:\"退稿\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}}');
REPLACE INTO `p8_config` VALUES ('cms','','string','base_domain','');
REPLACE INTO `p8_config` VALUES ('cms','','string','domain','');
REPLACE INTO `p8_config` VALUES ('cms','','string','index_page_cache_ttl','0');
REPLACE INTO `p8_config` VALUES ('cms','','string','table_prefix','');
REPLACE INTO `p8_config` VALUES ('cms','item','serialize','attribute_acl','a:8:{i:1;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}i:2;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}i:3;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}i:4;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}i:5;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}i:6;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}i:7;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}i:8;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}}');
REPLACE INTO `p8_config` VALUES ('cms','item','string','list_page_cache_ttl','0');
REPLACE INTO `p8_config` VALUES ('cms','item','string','mobile_template','mobile/school');
REPLACE INTO `p8_config` VALUES ('cms','item','string','view_page_cache_ttl','0');
REPLACE INTO `p8_config` VALUES ('cms','item','string','authority','0');
