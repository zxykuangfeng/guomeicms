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
  `url` varchar(255) NOT NULL DEFAULT '',
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
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
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
  `url` varchar(100) NOT NULL DEFAULT '',
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

DROP TABLE IF EXISTS `p8_cms_item_search`;
CREATE TABLE `p8_cms_item_search` (
  `id` int(10) unsigned NOT NULL,
  `search` mediumtext NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
/*!50100 PARTITION BY RANGE (timestamp)
(PARTITION p0 VALUES LESS THAN (0) ENGINE = MyISAM) */;

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
  `verify_frame` varchar(255) NOT NULL DEFAULT '',
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
  `url` varchar(100) NOT NULL DEFAULT '',
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
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', '', 'string', 'forbidden_dynamic', '0');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', '', 'string', 'index_to_html_crontab_id', '');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', '', 'string', 'index_file', '1');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', '', 'string', 'mobile_template', 'mobile/school');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', '', 'serialize', '_hook_modules', 'a:1:{s:4:"item";a:2:{s:3:"cms";a:1:{s:8:"category";s:3:"cid";}s:4:"core";a:1:{s:6:"member";s:3:"uid";}}}');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', '', 'serialize', 'hook_modules', 'a:2:{s:8:"category";a:1:{s:3:"cms";a:1:{s:4:"item";s:3:"cid";}}s:4:"item";a:1:{s:4:"core";a:1:{s:8:"uploader";s:7:"item_id";}}}');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'string', 'dynamic_list_url_rule', '{$module_controller}-list-category-{$id}#-page-{$page}#.shtml');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'string', 'dynamic_view_url_rule', '{$module_controller}-view-id-{$id}#-page-{$page}#.shtml');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'string', 'mobile_dynamic_list_url_rule', '{$module_mobile_controller}-list-mid-{$id}#-page-{$page}#.html');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'string', 'mobile_dynamic_view_url_rule', '{$module_mobile_controller}-view-id-{$id}.html');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'string', 'dynamic_homepage_list_url_rule', '{$URL}#-page-{$page}#.shtml');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'string', 'list_page_cacle_ttl', '0');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'string', 'view_page_cacle_ttl', '0');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'string', 'allow_comment', '1');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'string', 'allow_mood', '0');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'string', 'list_navigagion', 'nav_list02');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'string', 'allow_digg', '1');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'string', 'first_img_to_frame', '1');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'serialize', 'comment', 'a:4:{s:7:"enabled";s:1:"0";s:14:"require_verify";s:1:"0";s:9:"page_size";s:2:"20";s:14:"view_page_size";s:1:"5";}');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'serialize', 'sphinx', 'a:3:{s:7:"enabled";s:1:"0";s:4:"host";s:9:"localhost";s:4:"port";s:4:"3312";}');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'string', 'template', 'group7_blue');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'string', 'htmlize', '1');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'serialize', 'verify_acl', 'a:4:{i:2;a:2:{s:4:"name";s:6:"初审";s:4:"role";a:1:{i:1;s:1:"1";}}i:1;a:2:{s:4:"name";s:6:"终审";s:4:"role";a:1:{i:1;s:1:"1";}}i:0;a:2:{s:4:"name";s:12:"取消审核";s:4:"role";a:1:{i:1;s:1:"1";}}i:-99;a:2:{s:4:"name";s:6:"退稿";s:4:"role";a:1:{i:1;s:1:"1";}}}');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', '', 'string', 'base_domain', '');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', '', 'string', 'domain', '');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', '', 'string', 'index_page_cache_ttl', '0');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', '', 'string', 'table_prefix', '');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'serialize', 'attribute_acl', 'a:8:{i:1;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}i:2;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}i:3;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}i:4;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}i:5;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}i:6;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}i:7;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}i:8;a:3:{i:4;i:1;i:1;i:1;i:13;i:1;}}');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'string', 'list_page_cache_ttl', '0');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'string', 'mobile_template', 'mobile/school');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'string', 'view_page_cache_ttl', '0');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', '', 'string', 'template', 'group7_blue');
REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES ('cms', 'item', 'string', 'authority', '0');
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
REPLACE INTO `p8_cms_attachment` VALUES ('242','item','0','1','20160329093245732.jpg','image/pjpeg','jpg','260190','175.13.255.10','cms/item/2016_04/14_11/073692e19cd62df2.jpg','1','0','1460604898');
REPLACE INTO `p8_cms_attachment` VALUES ('243','item','1142','1','20160329093245732.jpg','image/pjpeg','jpg','260190','175.13.255.10','cms/item/2016_04/14_11/c113d763ea07ba44.jpg','1','0','1460605163');
REPLACE INTO `p8_cms_attachment` VALUES ('244','item','1145','1','about_his_menu.gif','image/gif','gif','46393','175.13.251.85','cms/item/2016_05/11_15/7c1b1892d11d2ac0.gif','2','0','1462950045');
REPLACE INTO `p8_cms_attachment` VALUES ('245','item','1053','1','timg.jpg','image/pjpeg','jpg','24258','175.13.251.85','cms/item/2016_05/12_10/97e2e2bacae3ab08.jpg','1','0','1463021377');
REPLACE INTO `p8_cms_attachment` VALUES ('246','item','1148','1','t01c32e5fa9a5fe4a2f.jpg','image/jpeg','jpg','9128','175.13.248.234','cms/item/2016_05/13_15/670e4772f60e08ec.jpg','0','0','1463123635');
REPLACE INTO `p8_cms_attachment` VALUES ('247','item','1148','1','iconfw01.png','image/png','png','3913','175.13.248.234','cms/item/2016_05/13_15/e0f5785119915c81.png','0','0','1463123682');
REPLACE INTO `p8_cms_attachment` VALUES ('248','item','1148','1','iconfwH2.png','image/png','png','3823','175.13.248.234','cms/item/2016_05/13_15/b5a6792e12d28b6a.png','0','0','1463123704');
REPLACE INTO `p8_cms_attachment` VALUES ('249','item','1148','1','iconfwH3.png','image/png','png','3288','175.13.248.234','cms/item/2016_05/13_15/cbc72a4b23a7e131.png','0','0','1463123716');
REPLACE INTO `p8_cms_attachment` VALUES ('250','item','0','1','lianghui.jpg','image/pjpeg','jpg','5077','175.13.253.52','cms/item/2016_05/16_07/b2bff9d0f6373f32.jpg','0','0','1463355960');
REPLACE INTO `p8_cms_attachment` VALUES ('251','item','0','1','class2.jpg','image/jpeg','jpg','22093','119.39.18.252','cms/item/2016_07/14_00/49a927d8ad3af63f.jpg','2','0','1468425921');
REPLACE INTO `p8_cms_attachment` VALUES ('252','item','0','1','class2.jpg','image/jpeg','jpg','22093','119.39.18.252','cms/item/2016_07/14_00/9a4e4e6ece4226e3.jpg','2','0','1468425934');
REPLACE INTO `p8_cms_attachment` VALUES ('253','item','1147','1','667m=21&gp=0.jpg','image/jpeg','jpg','15095','175.13.251.35','cms/item/2016_09/14_13/ebdf3f1924970659.jpg','0','0','1473831960');
REPLACE INTO `p8_cms_attachment` VALUES ('254','item','1057','1','668p=0.jpg','image/jpeg','jpg','12093','175.13.251.35','cms/item/2016_09/14_13/72931549075da279.jpg','0','0','1473831982');
REPLACE INTO `p8_cms_attachment` VALUES ('255','item','0','1','屏幕快照 2015-10-09 下午5.01.29.png','image/png','png','7335854','222.65.145.102','cms/item/2016_10/29_18/da2323bf268d108b.png','2','0','1477735519');
REPLACE INTO `p8_cms_attachment` VALUES ('256','item','0','1','屏幕快照 2015-10-09 下午5.01.29.png','image/png','png','7335854','222.65.145.102','cms/item/2016_10/29_18/3722c4c25635b840.png','2','0','1477735525');
REPLACE INTO `p8_cms_attachment` VALUES ('257','item','1153','1','20160803-1_03.jpg','image/jpeg','jpg','48017','118.249.186.50','cms/item/2017_05/11_16/2d75e5819837c03f.jpg','0','0','1494492283');
REPLACE INTO `p8_cms_attachment` VALUES ('258','item','1153','1','20160803-1_07.jpg','image/jpeg','jpg','49320','118.249.186.50','cms/item/2017_05/11_16/12d89d35785da55f.jpg','0','0','1494492293');
REPLACE INTO `p8_cms_attachment` VALUES ('259','item','1154','1','6f02b081703fd3f3.jpg','image/jpeg','jpg','22235','183.215.65.80','cms/item/2017_09/25_10/9997dc31235b5884.jpg','0','0','1506305602');
REPLACE INTO `p8_cms_attachment` VALUES ('260','item','0','1','fy.jpg','image/jpeg','jpg','120872','120.86.68.218','cms/item/2017_09/25_13/e63afbfe8f77d91f.jpg','2','0','1506317599');
REPLACE INTO `p8_cms_attachment` VALUES ('261','item','1155','1','新建文本文档 (2).txt','text/plain','txt','10','183.215.65.80','cms/item/2017_09/26_11/052e96a660089bd9.txt','0','0','1506396241');
REPLACE INTO `p8_cms_attachment` VALUES ('263','item','1163','1','t0160e77c72250bad52.jpg','image/jpeg','jpg','9507','113.247.55.68','cms/item/2017_09/30_09/726da40fec872151.jpg','1','0','1506734372');
REPLACE INTO `p8_cms_attachment` VALUES ('264','item','1163','1','t0160e77c72250bad52.jpg','image/jpeg','jpg','9507','113.247.55.68','cms/item/2017_09/30_09/bebb771295a73aac.jpg','1','0','1506734420');
REPLACE INTO `p8_cms_attachment` VALUES ('265','item','1164','1','t013c0842d6b9be52a9.jpg','image/jpeg','jpg','5463','113.247.55.68','cms/item/2017_09/30_09/52a76a9089ffd379.jpg','1','0','1506734517');
REPLACE INTO `p8_cms_attachment` VALUES ('266','item','1164','1','t013c0842d6b9be52a9.jpg','image/jpeg','jpg','5463','113.247.55.68','cms/item/2017_09/30_09/e69a5909cf127033.jpg','1','0','1506734550');
REPLACE INTO `p8_cms_attachment` VALUES ('267','item','1164','1','t0104ea20c014598a66.jpg','image/jpeg','jpg','18692','113.247.55.68','cms/item/2017_09/30_09/3c1e0fc717f3b911.jpg','1','0','1506734626');
REPLACE INTO `p8_cms_attachment` VALUES ('268','item','1164','1','t0104ea20c014598a66.jpg','image/jpeg','jpg','18692','113.247.55.68','cms/item/2017_09/30_09/bcd472de94afc9d3.jpg','1','0','1506734636');
REPLACE INTO `p8_cms_attachment` VALUES ('269','item','0','1','b93750be32f42d60.png','image/png','png','35989','113.247.55.68','cms/item/2017_09/30_09/1768c959dd4b8a1a.png','1','0','1506735675');
REPLACE INTO `p8_cms_attachment` VALUES ('270','item','1165','1','b93750be32f42d60.png','image/png','png','35989','113.247.55.68','cms/item/2017_09/30_09/61c3ba6b044a8174.png','1','0','1506736054');
REPLACE INTO `p8_cms_attachment` VALUES ('271','item','1165','1','b93750be32f42d60.png','image/png','png','35989','113.247.55.68','cms/item/2017_09/30_09/8f20d29fb3f78b0a.png','1','0','1506736063');
REPLACE INTO `p8_cms_attachment` VALUES ('272','item','1166','1','59c44bd1aca22d30.jpg','image/jpeg','jpg','2775','113.247.55.68','cms/item/2017_09/30_10/b54b65342bcadfa1.jpg','0','0','1506740311');
REPLACE INTO `p8_cms_attachment` VALUES ('273','item','1169','1','39581594935e4eed.jpg','image/jpeg','jpg','3253','113.247.55.68','cms/item/2017_09/30_10/99a368bb842c1fcf.jpg','0','0','1506740353');
REPLACE INTO `p8_cms_attachment` VALUES ('274','item','1170','1','内页01_03.jpg','image/jpeg','jpg','11293','113.247.22.7','cms/item/2017_10/11_14/a13e279767fd83cb.jpg','1','0','1507703956');
REPLACE INTO `p8_cms_attachment` VALUES ('275','item','1171','1','内页02_03.jpg','image/jpeg','jpg','18686','113.247.22.7','cms/item/2017_10/11_14/9c808356d2478211.jpg','1','0','1507704026');
REPLACE INTO `p8_cms_attachment` VALUES ('276','item','1172','1','内页03_03.jpg','image/jpeg','jpg','24610','113.247.22.7','cms/item/2017_10/11_14/b8ae2e0221bbae8e.jpg','1','0','1507704087');
REPLACE INTO `p8_cms_attachment` VALUES ('277','item','1173','1','8896.jpg','image/pjpeg','jpg','25109','113.247.22.1','cms/item/2017_10/17_23/e1b95c4365f3b71e.jpg','1','0','1508255661');
REPLACE INTO `p8_cms_attachment` VALUES ('278','item','1068','1','2.jpg','image/pjpeg','jpg','45660','113.247.22.1','cms/item/2017_10/18_00/a8f2ffbbc9897422.jpg','1','0','1508256283');
REPLACE INTO `p8_cms_attachment` VALUES ('279','item','1078','1','3.jpg','image/pjpeg','jpg','28541','113.247.22.1','cms/item/2017_10/18_00/ca6fb08679f0adce.jpg','1','0','1508256321');
REPLACE INTO `p8_cms_attachment` VALUES ('281','item','1174','1','e3017719190ff1e83db12ee09e7beada_M.png','application/octet-stream','png','83201','113.246.92.66','cms/item/2018_03/02_10/ea68a80a608d5cc8.png','0','0','1519957749');
REPLACE INTO `p8_cms_attachment` VALUES ('282','item','1174','1','e3017719190ff1e83db12ee09e7beada_M.png','application/octet-stream','png','83201','113.246.92.66','cms/item/2018_03/02_10/b4eaf6768514221d.png','0','0','1519957760');
REPLACE INTO `p8_cms_attachment` VALUES ('283','item','1174','1','pro_03.jpg','image/jpeg','jpg','220716','113.246.92.66','cms/item/2018_03/02_10/bea25d7570b14b29.jpg','2','0','1519958015');
REPLACE INTO `p8_cms_attachment` VALUES ('284','item','1174','1','pro_03.jpg','image/jpeg','jpg','220716','113.246.92.66','cms/item/2018_03/02_10/958c0fad34b4545c.jpg','2','0','1519958260');
REPLACE INTO `p8_cms_attachment` VALUES ('285','item','1174','1','pro_03.jpg','image/jpeg','jpg','220716','113.246.92.66','cms/item/2018_03/02_10/e861493b36a81089.jpg','2','0','1519958282');
REPLACE INTO `p8_cms_attachment` VALUES ('288','item','1179','1','2018110114484303246903.png','image/png','png','52394','119.129.116.229','cms/item/2019_07/31_15/85275095ac6ee631.png','0','0','1564559598');
REPLACE INTO `p8_cms_attachment` VALUES ('289','item','1179','1','a0118f642250e302.png','application/octet-stream','png','46471','119.129.116.229','cms/item/2019_07/31_15/980934408bcdfc56.png','0','0','1564559617');
REPLACE INTO `p8_cms_attachment` VALUES ('290','category','0','1','1_03.jpg','image/jpeg','jpg','23086','36.157.222.31','cms/category/2020_03/06_11/f8f1bd8c8500bdc5.jpg','1','0','1583465422');
REPLACE INTO `p8_cms_attachment` VALUES ('291','category','0','1','2_03.jpg','image/jpeg','jpg','32470','36.157.222.31','cms/category/2020_03/06_11/b1350f31e415d81a.jpg','1','0','1583465438');
REPLACE INTO `p8_cms_attachment` VALUES ('292','category','0','1','3_03.jpg','image/jpeg','jpg','23212','36.157.222.31','cms/category/2020_03/06_11/8bf1293189cac2a2.jpg','1','0','1583465454');
REPLACE INTO `p8_cms_attachment` VALUES ('293','category','0','1','4_03.jpg','image/jpeg','jpg','21058','36.157.222.31','cms/category/2020_03/06_11/de69dbb0801ba9c7.jpg','1','0','1583465471');
REPLACE INTO `p8_cms_attachment` VALUES ('294','category','0','1','5_03.jpg','image/jpeg','jpg','29892','36.157.222.31','cms/category/2020_03/06_11/dd8039561bf67e27.jpg','1','0','1583465488');
REPLACE INTO `p8_cms_attachment` VALUES ('295','category','0','1','6_03.jpg','image/jpeg','jpg','23485','36.157.222.31','cms/category/2020_03/06_11/92ee741f5bd57439.jpg','1','0','1583465507');
REPLACE INTO `p8_cms_attachment` VALUES ('296','category','0','1','9999999999999.jpg','image/jpeg','jpg','37412','113.246.87.230','cms/category/2020_03/06_12/78340ad465f3c831.jpg','1','0','1583470255');
REPLACE INTO `p8_cms_attachment` VALUES ('280','item','0','15','60debba3ef41ddb4.jpg','application/octet-stream','jpg','12332','113.246.92.66','cms/item/2018_03/01_11/3c3afacbcca2d736.jpg','1','0','1519875779');
REPLACE INTO `p8_cms_category` VALUES ('1','0','新闻资讯','x','article','','','','1','23','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xinwenzhongxin','20','article/big_list','article/big_list','article/view','article/view','cms/article/list','mobile/list','190','','','','0','','1','a:15:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('15','0','会员中心公告','h','article','','','','1','24','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','zhanneigonggao','20','article/list','article/list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list','0','','','','0','','0','a:14:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('16','20','年报/中期报告','n','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','jingxiaoshanghuodongyudaili/shouhouzixun','30','article/list','article/list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list','8','','','category_34','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('17','20','高级管理层','g','article','','','','2','4','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','jingxiaoshanghuodongyudaili/shouhouchangjianwenti','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','10','','','category_34','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('20','0','投资者关系','t','article','','','','1','8','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','jingxiaoshanghuodongyudaili','20','article/big_list','article/list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list','45','','','','0','','1','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('26','15','站内公告','z','article','','','','2','6','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','zhanneigonggao/zhanneigonggao','20','article/list','article/list_mobile','article/view2','article/view_mobile','common/ico_title/list016','mobile/list','0','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('34','1','软件研发战场服务','r','article','','','','2','15','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xinwenzhongxin/xingyedongtai','10','article/list','article/list','article/view','article/view','common/other/list_date27','mobile/list','35','','','','0','','0','a:15:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:40;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('44','1','专题活动','z','article','','','','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xinwenzhongxin/ceshilanmu','12','article/list','article/list_mobile','article/view','article/view_mobile','common/other/list_date27','mobile/list','30','','','','0','','0','a:14:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('45','0','解决方案','j','article','','','','1','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','yuanwugongkai','30','article/pindao_biaoqian','article/list','article/view','article/view','common/ico_title/list016','mobile/list14','170','','','','0','','1','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('47','20','股东通函','g','article','','','','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','jingxiaoshanghuodongyudaili/shiziduiwu','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','6','','','category_34','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('53','138','企业视频','q','video','','','','2','5','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','tupianshijie/shipinxinwen','20','video/list','video/list_mobile','video/view','video/view_mobile','common/pic_title/list001b','mobile/list','10','','','category_34','0','','0','a:14:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('55','67','通信产品','t','product','','','','2','3','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','keyandongtai/xueyuanyuanbao','10','product/list4','product/list','product/view','product/view2','common/pic_title_summary/list034','mobile/list10','20','','','','0','','0','a:15:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('58','45','电信方案','d','article','','','<!--#p8_attach#-->/cms/category/2020_03/06_12/78340ad465f3c831.jpg.thumb.jpg','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','yuanwugongkai/xueyuanwenjian','30','article/list_solution','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','16','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('59','45','系统方案','x','article','','','<!--#p8_attach#-->/cms/category/2020_03/06_11/b1350f31e415d81a.jpg.thumb.jpg','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','yuanwugongkai/guizhangzhidu','20','article/list_solution2','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','14','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('811','45','业务方案','y','article','','','<!--#p8_attach#-->/cms/category/2020_03/06_11/92ee741f5bd57439.jpg.thumb.jpg','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','yuanwugongkai/yewufangan','30','product/product_index2','article/list','article/view','article/view','common/ico_title/list016','mobile/list','36','','','category_93','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('67','0','产品服务','c','product','','','','1','7','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','keyandongtai','20','product/list_biaoqian','product/big_list2','product/view','article/view','common/pic_title_summary/list034','mobile/list','160','','','','0','','1','a:15:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('68','45','解决方案一','j','product','','','<!--#p8_attach#-->/cms/category/2020_03/06_11/f8f1bd8c8500bdc5.jpg.thumb.jpg','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','yuanwugongkai/keyanchengguo','30','product/list_biaoqian2018-2','product/list','product/view','product/view','cms/product/list','mobile/list','50','','','category_68','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:21:\"解决方案一简介\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('809','1','通知公告','t','article','','','','2','3','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xinwenzhongxin/xingyedongtai','30','article/list','article/list_mobile','article/view','article/view_mobile','common/other/list_date27','mobile/list','33','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('93','67','宣传效果1','x','product','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','keyandongtai/gaigedongtai','10','product/product_index2','product/list','product/view','product/view','cms/product/list','mobile/list','0','','','category_93','0','','0','a:14:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('94','67','机械设备','j','product','','','','2','3','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','keyandongtai/gaigeyugailiangtibao','10','product/list','product/list','product/view','product/view','common/pic_title_summary/list034','mobile/list','16','','','','0','','0','a:14:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('810','776','董事长致辞','d','page','','','','4','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xueyuangaikuang/dongshichangzhici','30','page/list','page/list','page/view','page/view','cms/page/list','mobile/list','12','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('128','1','媒体聚焦','m','article','','','','2','3','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xinwenzhongxin/tongzhigonggao','10','article/list','article/list_mobile','article/view','article/view_mobile','common/other/list_date27','mobile/list','32','','','','0','','0','a:14:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('138','0','视频世界','s','video','','','','1','6','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','tupianshijie','20','video/video_index','video/list','video/view','video/view','common/pic_title/list002b','mobile/list','11','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('140','138','活动视频','h','video','','','','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','tupianshijie/xiaoyuanfengguang','20','video/list','video/list_mobile','video/view','video/view_mobile','common/pic_title/list002b','mobile/list','0','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('141','138','教学视频','j','video','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','tupianshijie/jingpinkecheng','20','video/list','video/list_mobile','video/view','video/view_mobile','common/ico_title/list016','mobile/list','0','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('776','0','企业介绍','q','article','','','','1','14','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','index.php/cms/item-list-category-781.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xueyuangaikuang','30','article/big_list','article/big_list','article/view','article/view','cms/article/list','mobile/list','200','','','','0','','0','a:15:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('777','776','企业文化','q','page','','','','4','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xueyuangaikuang/lishiyange','30','page/list_wenhua','page/list','page/view','page/view','cms/page/list','mobile/list','5','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('778','776','荣誉展示','r','article','','','','2','2','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xueyuangaikuang/xueyuanweiyuanhui','30','article/list_1','article/list_mobile','article/view3','article/view_mobile','common/pic_title/list038-2','mobile/list13','9','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:20;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('779','776','领导介绍','l','article','','','','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xueyuangaikuang/zuzhijigou','30','article/list_leader','article/list','article/view','article/view','cms/article/list','mobile/list11','11','','','','0','','0','a:13:{s:6:\"target\";s:5:\"_self\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('780','776','发展历程','f','page','','','','4','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xueyuangaikuang/xueyuanlingdao','30','page/list','page/list','page/view','page/view','cms/page/list','mobile/list','10','','','','0','','0','a:17:{s:6:\"target\";s:5:\"_self\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('781','776','集团简介','j','page','','','','4','2','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xueyuangaikuang/xueyuanjianjie','30','page/list_jianjie2','page/list','page/view','page/view','cms/page/list','mobile/list','13','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('792','45','解决方案二','j','product','','','<!--#p8_attach#-->/cms/category/2020_03/06_11/8bf1293189cac2a2.jpg.thumb.jpg','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','yuanwugongkai/keyanjigou','30','product/product_index3','product/list','product/view','product/view','cms/product/list','mobile/list','48','','','category_792','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('793','45','解决方案四','j','product','','','<!--#p8_attach#-->/cms/category/2020_03/06_11/dd8039561bf67e27.jpg.thumb.jpg','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','yuanwugongkai/keyanhezuo','10','product/product_index','product/list','product/view','product/view','common/pic_title_summary/list035','mobile/list','40','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('795','0','人才招聘','r','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','rencaizhaopin','30','article/list_rencailinian','article/list_mobile','article/view','article/view_mobile','common/ico_title/list014','mobile/list','140','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('796','795','人才政策','r','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','rencaizhaopin/zhaopinjihua','30','article/list_rencailinian','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','0','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('797','795','招聘信息','z','article','/index.php/core/forms-list-mid-78','','','3','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','rencaizhaopin/zhaopinxinxi','30','article/list_zhaopin','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','0','','','','0','','0','a:15:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('798','795','我要应聘','w','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','rencaizhaopin/woyaoyingpin','30','article/list_yingping','article/list','article/view','article/view','cms/article/list','mobile/list','0','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('812','776','员工风采','y','article','','','','2','5','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueyuangaikuang/yuangongfengcai','30','article/big_list_pic','article/big_list','article/view','article/view_mobile','common/ico_title/list016','mobile/list','3','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('813','812','公司年会','g','article','','','','2','4','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueyuangaikuang/yuangongfengcai/gongsinianhui','30','article/list_1','article/list_mobile','article/view','article/view_mobile','common/pic_title/list037','mobile/list','0','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('814','812','户外活动','h','article','','','','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueyuangaikuang/yuangongfengcai/huwaihuodong','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','0','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('815','776','厂房设备','c','article','','','','2','2','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueyuangaikuang/changfangshebei','30','article/list_changfang','article/list_mobile','article/view','article/view_mobile','common/pic_title/list038','mobile/list13','7','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('816','0','招商合作','z','article','','','','2','4','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhaoshanghezuo','30','article/list_zhaoshanghezuo','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','150','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('817','816','合作单位','h','article','','','','2','4','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhaoshanghezuo/hezuodanwei','30','article/list_1','article/list_mobile','article/view','article/view_mobile','common/pic_title/list038-3','mobile/list','9','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('818','816','招商专题','z','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhaoshanghezuo/zhaoshangzhuanti','30','article/list_zhaoshanghezuo2','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','10','','','','0','','0','a:14:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('819','0','联系我们','l','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','lianxiwomen','30','article/list_contact','article/list_lianxi','article/view','article/view_mobile','common/ico_title/list016','mobile/list','50','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('820','819','联系方式','l','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','lianxiwomen/lianxifangshi','30','article/list_contact','article/list_mobile','article/view','article/view_mobile_II','common/ico_title/list016','mobile/list','0','','','','0','','0','a:14:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('821','819','下载专区','x','down','','','','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','lianxiwomen/xiazaizhuanqu','30','down/list','down/list','down/view','down/view','cms/down/list','mobile/list','0','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('822','819','投诉建议','t','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','lianxiwomen/tousujianyi','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','0','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('823','67','产品布局','c','product','','','','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','keyandongtai/chanpinbuju','30','product/list','product/list_mobile','product/view','product/view_mobile','common/ico_title/list016','mobile/list','10','','','','0','','0','a:14:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('824','45','解决方案三','j','product','','','<!--#p8_attach#-->/cms/category/2020_03/06_11/de69dbb0801ba9c7.jpg.thumb.jpg','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','yuanwugongkai/chanpinxuanchuan4','30','product/product_index4','product/list_mobile','product/view','product/view_mobile','common/ico_title/list016','mobile/list','45','','','category_824','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('825','45','解决方案','j','product','','','<!--#p8_attach#-->/cms/category/2020_03/06_11/b1350f31e415d81a.jpg.thumb.jpg','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','yuanwugongkai/jiejuefanganwu','30','product/list_biaoqian2018','product/list','product/view','product/view','cms/product/list','mobile/list','49','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('826','67','通信产品','t','product','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','keyandongtai/xueyuanyuanbao','10','product/list','product/list','product/view','product/view2','common/pic_title_summary/list034','mobile/list10','12','','','','0','','0','a:14:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('827','67','机械设备','j','product','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','keyandongtai/gaigeyugailiangtibao','10','product/list','product/list','product/view','product/view','common/pic_title_summary/list034','mobile/list','16','','','','0','','0','a:14:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('830','0','单网页','d','page','','','','4','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','danwangye','30','page/list_wenhua','page/list','page/view','page/view','cms/page/list','mobile/list','0','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('831','0','统一登录入口','t','article','','','','2','0','1','{$core_url}/dl.html','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','tongyidenglurukou','30','article/list_login','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','0','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('832','0','站群列表','z','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','zhanqunliebiao','30','article/list_danhang','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','0','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_item` VALUES ('1','article','湖南衡阳区划调整引堵路事件 市县抢夺资源','','0','','17','','','1','','','','admin','','湖南衡阳市衡山县争夺店门镇辖权引矛盾，传因此影响人事调整，衡山县县委书记空缺一年。衡山县村民反对划并曾多次堵路。知情者称，衡阳市划并店门镇是为争夺南岳衡山的管辖权。\r\n','1','','31','','0','4','1291778075','','0','1291778075','1291778075','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('2','article','凯里官方:网吧隔壁危险化学品引发爆炸','','0','','17','','','1','','','','admin','','贵州凯里网吧爆炸已造成6死38伤，官方称事件初步确定是由于网吧隔壁存放的大量危险化学品引发。据悉事发时网吧内有45人在上网。目前2名网吧负责人及存放化学品的业主已被警方控制。\r\n','1','','18','','0','0','1291778207','','0','1291778222','1291778207','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('3','article','银行收费新规至今无下文 监管被指成&quot;保护伞&quot;','','0','','17','','','1','','','','admin','5','　　中国新闻网12月8日报道;不少市民日前反映，最近去银行办理业务，发现此前广受质疑的小额账户管理费、短信通知费等仍在收取。银行人员称;这些收费监','1','','25','','0','0','1291778283','','0','1291882516','1291778283','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('43','article','世青赛中国女乒1-3日本8年首次丢冠 男乒3比0登顶','','0','','17','','','1','','','','admin','','　　新浪体育讯　北京时间12月9日消息，在斯洛文尼亚进行的乒乓球世青赛女团决赛中，中国女队1比3不敌石川佳纯领衔的日本队，仅获得亚军。这也是中国女乒八年来首次无缘世青赛冠军。男团决赛中国队则以3比0完','1','','16','','0','0','1291882117','','0','1291882117','1291219200','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('119','article','企业站内公告1','','0','','26','','','1','','','','admin','','企业站内公告','1','','2','','0','0','1308558474','','0','1308558474','1308558474','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('120','article','企业站内公告2','','0','','26','','','1','','','','admin','','企业站内公告','1','','5','','0','0','1308558482','','0','1308558482','1308558482','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('121','article','企业站内公告3','','0','','26','','','1','','','','admin','','企业站内公告','1','','9','','0','0','1308558488','','0','1308558488','1308558488','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('122','article','企业站内公告4','','0','','26','','','1','','','','admin','','企业站内公告','1','','11','','0','0','1308558495','','0','1308558495','1308558495','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('123','article','企业站内公告5','','0','','26','','','1','','','','admin','','企业站内公告','1','','9','','0','0','1308558502','','0','1308558502','1308558502','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('124','article','企业站内公告6','','0','','26','','','1','','','','admin','','企业站内公告','1','','11','','0','0','1308558508','','0','1308558508','1308558508','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('267','video','外交部称正在调查日本大使坐车国旗被夺事件','','0','','140','','','1','','','','admin','','外交部称正在调查日本大使坐车国旗被夺事件','1','','93','','0','0','1346204810','','0','1346233539','1346204810','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('281','video','耶鲁开放课程：古希腊历史简介','','0','','53','<!--#p8_attach#-->/cms/item/2012_09/01_21/cdd5f3b451774c11.jpg.thumb.jpg','','1','','','','admin','6','耶鲁开放课程：古希腊历史简介耶鲁开放课程：古希腊历史简介','1','','45','','0','0','1346507685','','0','1346507685','1346507685','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('282','video','耶鲁开放课程：1871年后的法国','','0','','53','<!--#p8_attach#-->/cms/item/2012_09/02_02/ed06de3b55b12af0.jpg','','1','','','','admin','6','耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国','1','','170','','0','0','1408464000','','0','1439792733','1408464000','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('283','video','麻省理工开放课程：物流管理专题','','0','','53','<!--#p8_attach#-->/cms/item/2012_09/01_21/82fa47cae98e580b.jpg.thumb.jpg','','1','','','','admin','6','麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题','1','','86','','0','0','1346507832','','0','1346507832','1346507832','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('284','video','开放课程：生物医学工程探索（一）','','0','','53','<!--#p8_attach#-->/cms/item/2014_09/01_17/593cbe81e81c1655.jpg','','1','','','','admin','6','开放课程：生物医学工程探索开放课程：生物医学工程探索','1','','98','','0','1','1346428800','','0','1409565048','1346428800','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('285','video','麻省理工学院：算法导论','','0','','53','<!--#p8_attach#-->/cms/item/2015_01/11_01/e3aaa9ee0334b92a.jpg','','1','','','','admin','3,6','麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院','1','','285','','0','0','1346428800','','0','1431236286','1346428800','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('322','article','股民中签后券商通知的法律责任分析','','0','','34','','','0','','','','','','原告李某与被告某证券公司于2000年10月19日签订了一份配售新股协议书。','1','','51','','0','0','1377244239','','1370738424','1377244239','1370738424','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('323','article','创新中国DEMO CHINA 2013”春季赛拉开帷幕','','0','创新中国DEMO CHINA 2013”春季赛拉开帷幕','34','','','0','','','','','','创新中国DEMO CHINA”是由创业邦举办的一场面向国内外创业者的创业大赛，截止2012年已举办七年，吸引了包括大陆、港台、加拿大等国家地区的创业者参与，因聚集了国内外最优质的潜力项目，创新中国 ','1','','62','','0','0','1370738424','','1370738424','1370738424','1370738424','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1021','article','西藏首个国家公园雅鲁藏布大峡谷国家公园建成','','0','','34','','','0','','','','','5','新华网林芝12月8日电  6日，西藏首个国家公园——雅鲁藏布大峡谷国家公园正式建成。','1','','65','','0','0','1379420676','','1379420676','1379420676','1379420676','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1022','article','社科院称2010住宅市场量价齐升 调控中再现回落','','0','','34','<!--#p8_attach#-->/cms/item/2010_12/08_11/1b2a4988ed469903.jpg.thumb.jpg','','0','','','','','','由中国社会科学院财政与贸易经济研究所、社会科学文献出版社联合主办的“2011年《住房绿皮书》发布暨2010~2011年住房形势与政策研讨会”8日在北京举行。','1','','49','','0','0','1379420676','','1379420676','1379420676','1379420676','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1023','article','中美大学生文化交流活动在我校举行','','0','','34','<!--#p8_attach#-->/cms/item/2012_08/23_00/afa9ec23dfb52a78.jpg.thumb.jpg','','0','','','','','','2012年7月19日，由中美文化教育基金会发起、北京市委教育工委主办、中国传媒大学学生工作处承办的&ldquo;新世纪的丝绸之路&rdquo;之中美大学生文化交流活动在中国传媒大学综合实验楼400人报告厅拉开帷幕。此次活动吸','1','','83','','0','0','1379420676','','1379420676','1379420676','1379420676','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1027','article','理论学习工作台指导意见','','0','','47','','','1','','','','admin','','理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习','1','','18','','0','0','1393140327','','1393140327','1393140327','1393140327','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1053','article','集团简介','','0','','781','<!--#p8_attach#-->/cms/item/2015_01/06_20/e6a9fd61a4dddd43.jpg.cthumb.jpg','','1','','','','admin','6','万达集团创立于1988年，形成商业、文化、金融三大产业集团，2015年资产6340亿元，收入2901亿元。万达商业是世界最大的不动产企业，世界最大的五星级酒店业主；万达文化集团是中国最大的文化企业、世界最大的电影院线运营商，世界最大的体育公司；万达金融是中国最大的网络金融企业。万达集团的目标是到2020年，资产达到2000亿美元，市值2000亿美元，收入1000亿美元，净利润100亿美元，成为世界一流跨国企业。 ','1','','2309','','0','0','1408809600','','1408851697','1463355987','1408809600','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1057','article','立信单位','','0','','778','<!--#p8_attach#-->/cms/item/2016_09/14_13/72931549075da279.jpg','','1','','','','admin','6','学院委员会人事工作小组主要负责普通租赁人员招聘，自筹经费科研助理招聘，管理系列招聘，管理系列与实验技术系列初中级职务评审，返聘申请，延聘申请等工作。这个小组根据不同表格的需要，有不同的名称，例如“岗位聘任委员会”、“中级职务聘任委员会&','1','','132','','0','0','1408809600','','1408863537','1473832103','1408809600','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1060','article','中秋送欢乐 有爱更温暖','','0','','34','','','1','','','','admin','','9月8日，正值中秋佳节，一户家庭贫困的三胞胎孩子的家中一片欢声笑语。来自土木工程学院红十字分会的3名志愿者，给这户三胞胎家庭送去了温暖和关爱。当志愿者们到达三胞胎小朋友的家中时，小朋友们十分高兴。小朋友们拉着志愿者到客厅围坐一圈，并给志愿者唱了一首ABC歌','1','','94','','0','0','1410360021','','1410360021','1410360021','1410360021','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1062','article','人民日报评论员：以“三种意识”推进全面深化改革','','0','','34','','','1','','','','admin','','历经35年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼&amp;amp;ldquo;两个一百年&amp;amp;rdquo;目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的','1','','94','','0','0','1410360106','','1410360106','1410360106','1410360106','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1065','article','“24字”核心价值观具有强大认同力和凝聚力','','0','','34','','','1','','','','admin','','十八大报告对社会主义核心价值体系建设提出了新部署新要求，强调&amp;amp;ldquo;要深入开展社会主义核心价值体系学习教育，用社会主义核心价值体系引领社会思潮、凝聚社会共识&amp;amp;rdquo;，&amp;amp;ldquo;倡导富强、民主、文明、和谐，倡导自由、平等、公正、法治，倡导爱国、敬业、诚信、友','1','','108','','0','0','1410360259','','1410360259','1410360259','1410360259','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1068','article','教育部关于切实加强和改学风建设的实施意见','','0','','128','<!--#p8_attach#-->/cms/item/2017_10/18_00/a8f2ffbbc9897422.jpg','','1','','','','admin','6,1','�各省、自治区、直辖市教育厅（教委），新疆生产建设兵团教育局，有关部门（单位）教育司（局），部属各高等学校：　　为贯彻党的十七届六中全会“深化政风、行风建设，开展道德领域突出问题专项教育和治理”的精神，落实《国家中长期教育改革和发展规划','1','','130','','0','0','1415721600','','1415764749','1508256287','1415721600','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1078','article','人民日报评论员：以“三种意识”推进全面深化改革','','0','','128','<!--#p8_attach#-->/cms/item/2017_10/18_00/ca6fb08679f0adce.jpg','','0','','','','admin','6,1','历经35年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼“两个一百年”目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的','1','','183','','0','0','1431792000','','1431835066','1508256326','1431792000','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1079','article','市属高校三年规划建设项目开展专项稽察','','0','','128','<!--#p8_attach#-->/cms/item/2015_05/23_08/def29b9c7dd0d591.jpg','','0','','','','admin','6','市发展改革委对部分市属高校三年规划建设项目开展专项稽察。为了加强对我市重点建设项目稽察监管，市发展改革委近日对北方工业大学、首都师范大学和北京第二外国语学院3所院校的6个建设项目开展了专项稽察，重点对项目进度情况、资金到位及使用情况；履行基本建设程序、','1','','57','','0','0','1431792000','','1431835066','1432341455','1431792000','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1082','article','廖祥忠副校长率团赴清华、北师大开展科研专项调研 ','','0','','58','<!--#p8_attach#-->/cms/item/2014_08/30_21/fa206fa3582f2338.jpg','','1','','','','admin','6','2012年7月10日，廖祥忠副校长赴清华大学、北京师范大学开展科研专项调研，文科科研处处长胡智锋等陪同调研，标志着我校人文社会科学专项系列调研活动正式启动。牋? 为贯彻落实《教育部关于推进高等学','1','','89','','0','0','1432396800','','1432472802','1432992473','1432396800','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1133','article','·一键替换和选择整套模板','','0','','44','<!--#p8_attach#-->/cms/item/2017_10/18_00/ca6fb08679f0adce.jpg','','1','test','','test','admin','6','网站首页实施教程[2016-02-14]标签操作教程[2016-01-28]06--标签选择与使用的教程[2016-01-28]一键导入标签数据教程[2015-04-05]栏目的模板和标签样式[2015-04-05]如何进入到“显示标签”状态','2','','84','','0','0','1456848000','','1456879516','1508256806','1456848000','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1134','article','教育部关于切实加强和改学风建设的实施意见','','0','','34','<!--#p8_attach#-->/cms/item/2014_09/01_17/385cdb5e20e4ed8e.jpg','','1','','','','','6','为贯彻党的十七届六中全会“深化政风、行风建设，开展道德领域突出问题专项教育和治理”的精神，落实《国家中长期教育改革和发展规划纲要（2010-2020年）》的要求','1','','131','','0','0','1458230400','','1458254863','1458464368','1458230400','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1135','article','人民日报评论员：以“三种意识”推进全面深化改革','','0','','34','<!--#p8_attach#-->/cms/item/2012_09/02_02/ed06de3b55b12af0.jpg','','1','','','','','6','历经35年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼“两个一百年”目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的','1','','94','','0','0','1458230400','','1458254863','1458400569','1458230400','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1140','article','专家上海研讨大城市规划 绿色可持续城市仍为热点','','0','','34','<!--#p8_attach#-->/cms/item/2015_05/23_08/2491223fbece3b6d.jpg','','1','','','','','6','“新型城镇化”现已成为一个全民议题。如何走新型城镇化道路，需要全社会尤其是“规划师”的探索与创新。作为担当城乡规划重任的“青年规划师”的思考及探索，将为中国新型城镇化实践提供新的思路。　　17日，以“新型城镇化与城乡规','1','','122','','0','0','1458230400','','1458254863','1508255349','1458230400','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1141','article','市属高校三年规划建设项目开展专项稽察','','0','','34','<!--#p8_attach#-->/cms/item/2015_05/23_08/6bda83cf89e6cf65.jpg','','1','','','','','6','市发展改革委对部分市属高校三年规划建设项目开展专项稽察。为了加强对我市重点建设项目稽察监管，市发展改革委近日对北方工业大学、首都师范大学和北京第二外国语学院3所院校的6个建设项目开展了专项稽察，重点对项目进度情况、资金到位及使用情况；履行基本建设程序、','1','','114','','0','0','1458230400','','1458254863','1458394250','1458230400','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1142','article','陈进行出席博鳌论坛并参加B20专题研讨会','','0','','34','<!--#p8_attach#-->/cms/item/2016_04/14_11/c113d763ea07ba44.jpg.thumb.jpg','','1','','','','admin','6','3月23日至24日，集团公司董事长、党组书记陈进行应邀出席2016年博鳌亚洲论坛。年会召开期间，陈进行参加了&amp;amp;ldquo;B20：全球经济治理中的商界声音与诉求&amp;amp;rdquo;专题研讨会，并作为基础设施组企业家代表发言。发言中，陈进行阐述了五点建议：一是建设低碳绿色环保高效的能','1','','315','','0','0','1460605199','','1460605199','1460605199','1460605199','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1143','article','王野平出席广州国际投资年会并会见广东省、广州市领导','','0','','34','<!--#p8_attach#-->/cms/item/2016_05/12_10/97e2e2bacae3ab08.jpg','','1','','','','admin','6,1','3月23日，集团公司副董事长、总经理、党组副书记王野平应邀出席2016年中国广州国际投资年会全体大会。本届年会的主题是“动力源　增长极——国家中心城市与三大战略枢纽建设”，年会设立了18个专题分论坛，来自海内外投资及产业界的近1600名高端人士','1','','270','','0','0','1460563200','','1460605401','1473808744','1460563200','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1146','article','新华联集团地址变更通知','','0','','809','','','1','','','','admin','','尊敬的各界朋友、各合作单位：由于新华联集团第四代总部大楼建成使用，新华联集团总部已于2015年10月26日由北京市朝阳区道家园18号新华联大厦，正式搬迁至集团新总部大楼，新址联系信息如下：地址：北京市通州区台湖镇政府大街新华联集团总部大楼电话：010-80538888传真','1','','157','','0','0','1463022590','','1463022590','1463022590','1463022590','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1147','article','公司获评集团“品牌传播先进单位','','0','','778','<!--#p8_attach#-->/cms/item/2016_09/14_13/ebdf3f1924970659.jpg','','1','','','','admin','6','3月27日，从集团公司召开的党群系统工作会上传来令人欣喜的消息，公司一举获得集团2014年度“品牌传播与新闻宣传报道先进单位”等多项荣誉，党委书记张琳代表公司上台参加授牌仪式。过去的一年中，公司的品牌传播工作一直坚持以公司网站、报纸和各项目报纸为依','1','','58','','0','0','1462982400','','1463024867','1473832061','1462982400','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1153','product','5天开心特训营','','0','','823','<!--#p8_attach#-->/cms/item/2017_09/29_23/561a5f2f024c6bf0.jpg','','1','','','','admin','6','军人形象训练：军姿、军人行为品质强化训练，了解掌握军规军纪','1','','0','','0','0','1521217387','','1494492297','1521217387','1494432000','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1154','article','刘军先生（非执行董事 ）','','0','','779','<!--#p8_attach#-->/cms/item/2017_09/25_10/9997dc31235b5884.jpg','','1','','','','admin','6','1970年出生','1','','96','','0','0','1506268800','','1506305629','1509075837','1506268800','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1155','down','测试','','0','','821','','','1','','','','admin','','测试','1','','4','','0','0','1506396263','','1506396263','1506396263','1506396263','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1156','article','厂房设备2','','0','','815','<!--#p8_attach#-->/sites/item/2017_09/01_14/5f7f727c4499a829.JPG','','1','','','','admin','6','','1','','57','','0','0','1504195200','','1506648051','1506648051','1504195200','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1157','article','厂房设备1','','0','','815','<!--#p8_attach#-->/sites/item/2017_09/29_09/6bce5b714dc924fe.jpg','','1','','','','admin','6','&nbsp;','1','','46','','0','0','1504195200','','1506648110','1506648110','1504195200','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1158','article','劳动光荣2014','','0','','813','<!--#p8_attach#-->/sites/item/2017_09/29_09/334f6519e6fb0b5e.png','','1','','','','admin','6','','1','','43','','0','0','1504540800','','1506729674','1506729674','1504540800','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1159','article','劳动节活','','0','','813','<!--#p8_attach#-->/sites/item/2017_09/29_09/94746ccf1a065e04.png','','1','','','','admin','6','','1','','45','','0','0','1506614400','','1506729674','1506729674','1506614400','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1160','article','活动2016','','0','','813','<!--#p8_attach#-->/sites/item/2017_09/29_09/a86558591db7cadd.png','','1','','','','admin','6','','1','','39','','0','0','1506649775','','1506729674','1506729674','1506649775','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1161','article','活动2017','','0','','813','<!--#p8_attach#-->/sites/item/2017_09/29_09/4c5546d7b1b3090d.png','','1','','','','admin','6','','1','','47','','0','0','1506649816','','1506729674','1506729674','1506649816','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1162','article','活动2014','','0','','814','<!--#p8_attach#-->/sites/item/2017_09/29_09/02d11fab81d52693.png','','1','','','','admin','6','','1','','70','','0','0','1506649885','','1506729696','1506729696','1506649885','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1163','product','产品1','','0','','55','<!--#p8_attach#-->/cms/item/2017_09/30_09/726da40fec872151.jpg.thumb.jpg','','1','','','','admin','6','最新产品，震撼上市。','1','','0','','0','0','1506734423','','1506734423','1506734423','1506734423','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1165','product','演出舞台烟机','','0','','55','<!--#p8_attach#-->/cms/item/2017_09/30_09/61c3ba6b044a8174.png.thumb.jpg','','1','','','','admin','6','用于多类型舞台效果渲染，有很多不同的样式','1','','0','','0','0','1506700800','','1506736076','1508257702','1506700800','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1166','article','交通银行','','0','','817','<!--#p8_attach#-->/cms/item/2017_09/30_10/b54b65342bcadfa1.jpg','','1','','','','admin','6','交通银行','1','','72','','0','0','1506740325','','1506740325','1506740325','1506740325','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1167','article','工商银行','','0','','817','<!--#p8_attach#-->/sites/item/2017_09/18_07/39581594935e4eed.jpg','','1','','','','admin','6','&nbsp;工商银行','1','','22','','0','0','1505691626','','1506740334','1506740334','1505691626','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1168','article','交通银行','','0','','817','<!--#p8_attach#-->/sites/item/2017_09/18_07/59c44bd1aca22d30.jpg','','1','','','','admin','6','交通银行','1','','33','','0','0','1505691650','','1506740334','1506740535','1505691650','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1169','article','中国工商银行','','0','','817','<!--#p8_attach#-->/cms/item/2017_09/30_10/99a368bb842c1fcf.jpg','','1','','','','admin','6','中国工商银行','1','','73','','0','0','1506740358','','1506740358','1506740358','1506740358','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1170','product','视频直博服务','','0','','94','<!--#p8_attach#-->/cms/item/2017_10/11_14/a13e279767fd83cb.jpg.thumb.jpg','','1','','','','admin','6','频服务器主打安防行业视频直播,数字景区直播、视频农场、视频商店','1','','0','','0','0','1507703974','','1507703974','1507703974','1507703974','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1171','product','视频直播服务2','','0','','94','<!--#p8_attach#-->/cms/item/2017_10/11_14/9c808356d2478211.jpg.thumb.jpg','','1','','','','admin','6','&amp;ldquo;环保监控、安全督查、园区安全和消防预警一体化视频联动系统。','1','','0','','0','0','1507704038','','1507704038','1507704038','1507704038','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1172','product','视频直播服务器3','','0','','94','<!--#p8_attach#-->/cms/item/2017_10/11_14/b8ae2e0221bbae8e.jpg.thumb.jpg','','1','','','','admin','6','一键视频语音呼叫报警、园区安全和消防预警一体化视频联动系统。','1','','0','','0','0','1507704095','','1507704095','1507704095','1507704095','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1174','product','儿童手表','','0','','55','<!--#p8_attach#-->/cms/item/2018_03/02_10/ea68a80a608d5cc8.png','','1','','','','admin','6','更聪明的电话手表，4G高清通话，实时定位','1','','0','','0','0','1519958452','','1519957763','1520504190','1519958037','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1176','article','光明网：中葡两国元首见证中粮“卓越中心”落户葡萄牙','','0','','809','<!--#p8_attach#-->/cms/item/2019_02/26_15/7b9541f281ed57ee.jpg','','1','','','','admin','6','葡萄牙当地时间12月5日，在中葡两国元首的共同见证下，中粮集团党组书记、董事长吕军和葡萄牙贸易与投资促进局局长路易斯•卡斯特罗•恩里克斯代表双方签署合作谅解备忘录。中粮集团将在葡萄牙波尔图大区设立为旗下中粮国际提供共享服务的“卓越中心&rdquo','1','','78','','0','0','1551165637','','1551165637','1551165659','1551165637','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1177','article','华为基于5G商用网络与折叠手机，重定义视频体验','','0','','809','<!--#p8_attach#-->/cms/item/2019_02/26_15/ae0544d6f30a810f.jpg','','1','','','','admin','6','在2019世界移动大会前夕，华为在巴塞罗那举办主题为&amp;amp;ldquo;构建万物互联的智能世界&amp;amp;rdquo;的华为Day0论坛。在&amp;amp;ldquo;5G is ON&amp;amp;rdquo;分论坛上，基于西班牙沃达丰与华为联合部署的5G商用网络，华为常务董事、运营商BG总裁丁耘使用5G折叠屏智能手机演示了4K超高清视频点播','1','','79','','0','0','1551166599','','1551166599','1551166599','1551166599','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1178','article','活动2016','','0','','34','<!--#p8_attach#-->/sites/item/2017_09/29_09/a86558591db7cadd.png','','1','','','','admin','6','','1','','38','企业1|','0','0','1506649775','','1557305706','1557305706','1506649775','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1184','page','集团简介','','0','','830','','','1','','','','admin','','中国国际海运集装箱（集团）股份有限公司（简称：中集集团），是世界领先的物流装备和能源装备供应商，总部位于中国深圳。公司致力于在如下主要业务领域：集装箱、道路运输车辆、能源化工及食品装备、海洋工程、物流服务、空港设备等，提供高品质与可信赖的装备和服务。','1','','10','','0','0','1583200623','','1583200623','1583201995','1583200623','1','admin','1583284967','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1185','page','集团简介','','0','','781','','','1','','','','admin','','中国国际海运集装箱（集团）股份有限公司（简称：中集集团），是世界领先的物流装备和能源装备供应商，总部位于中国深圳。公司致力于在如下主要业务领域：集装箱、道路运输车辆、能源化工及食品装备、海洋工程、物流服务、空港设备等，提供高品质与可信赖的装备和服务。','1','','64','','0','0','1583201716','','1583201716','1583201716','1583201716','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1187','page','企业文化','','0','','777','<!--#p8_attach#-->/core/label/2017_09/01_10/992bcc8ab0d40a9c.jpg','','1','','','','admin','','□使命：为物流和能源行业提供高品质与可信赖的装备和服务，为股东和员工提供良好回报，为社会创造可持续价值。□愿景：成为所进入行业的受人尊重的全球领先企业。□企业精神：自强不息 追求卓越□核心价值观：诚信正直、成就客户、开拓创新、持续改善、合作共赢、结果','1','','22','','0','0','1583202186','','1583202186','1583215687','1583202186','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1188','page','董事长致辞','','0','','810','<!--#p8_attach#-->/core/label/2016_07/15_10/c129c97e26494b96.jpg','','1','','','','admin','','','1','','12','','0','0','1583285098','','1583285098','1583285098','1583285098','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1189','page','发展历程','','0','','780','','','1','','','','admin','','2016年10月 远望谷战略投资SML，成为全球第二大服装零售物联网解决方案供应商2016年6月 远望谷成功收购TAGSYS纺织品洗涤解决方案业务和RFID标签设计与产品业务2016年10月 远望谷战略投资SML，成为全球第二大服装零售物联网解决方案供应商2016年6月 远望谷成功收购TAGSYS','1','','9','','0','0','1583285304','','1583285304','1583285409','1583285304','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1','article','17','1','admin','湖南衡阳区划调整引堵路事件 市县抢夺资源','','0','','','','','','湖南衡阳市衡山县争夺店门镇辖权引矛盾，传因此影响人事调整，衡山县县委书记空缺一年。衡山县村民反对划并曾多次堵路。知情者称，衡阳市划并店门镇是为争夺南岳衡山的管辖权。\r\n','','','','','','1','','0','1291778075','0','1291778075','1291778075','1','','','31','0','4','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('2','article','17','1','admin','凯里官方:网吧隔壁危险化学品引发爆炸','','0','','','','','','贵州凯里网吧爆炸已造成6死38伤，官方称事件初步确定是由于网吧隔壁存放的大量危险化学品引发。据悉事发时网吧内有45人在上网。目前2名网吧负责人及存放化学品的业主已被警方控制。\r\n','','','','','','1','','0','1291778207','0','1291778207','1291778222','1','','','18','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('3','article','17','1','admin','银行收费新规至今无下文 监管被指成&quot;保护伞&quot;','','0','','','','','5','　　中国新闻网12月8日报道;不少市民日前反映，最近去银行办理业务，发现此前广受质疑的小额账户管理费、短信通知费等仍在收取。银行人员称;这些收费监','','','','','','1','','0','1291778283','0','1291778283','1291882516','1','','','25','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('43','article','17','1','admin','世青赛中国女乒1-3日本8年首次丢冠 男乒3比0登顶','','0','','','','','','　　新浪体育讯　北京时间12月9日消息，在斯洛文尼亚进行的乒乓球世青赛女团决赛中，中国女队1比3不敌石川佳纯领衔的日本队，仅获得亚军。这也是中国女乒八年来首次无缘世青赛冠军。男团决赛中国队则以3比0完','','','','','','1','','0','1291882117','0','1291219200','1291882117','1','','','16','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('119','article','26','1','admin','企业站内公告1','','0','','','','','','企业站内公告','','','','','','1','','0','1308558474','0','1308558474','1308558474','1','','','2','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('120','article','26','1','admin','企业站内公告2','','0','','','','','','企业站内公告','','','','','','1','','0','1308558482','0','1308558482','1308558482','1','','','5','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('121','article','26','1','admin','企业站内公告3','','0','','','','','','企业站内公告','','','','','','1','','0','1308558488','0','1308558488','1308558488','1','','','9','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('122','article','26','1','admin','企业站内公告4','','0','','','','','','企业站内公告','','','','','','1','','0','1308558495','0','1308558495','1308558495','1','','','11','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('123','article','26','1','admin','企业站内公告5','','0','','','','','','企业站内公告','','','','','','1','','0','1308558502','0','1308558502','1308558502','1','','','9','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('124','article','26','1','admin','企业站内公告6','','0','','','','','','企业站内公告','','','','','','1','','0','1308558508','0','1308558508','1308558508','1','','','11','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('322','article','34','0','','股民中签后券商通知的法律责任分析','','0','','','','','','原告李某与被告某证券公司于2000年10月19日签订了一份配售新股协议书。','政府分站1|http://nw3.php168.net','','','','','1','','0','1377244239','1370738424','1370738424','1377244239','1','','','51','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('323','article','34','0','','创新中国DEMO CHINA 2013”春季赛拉开帷幕','','0','创新中国DEMO CHINA 2013”春季赛拉开帷幕','','','','','创新中国DEMO CHINA”是由创业邦举办的一场面向国内外创业者的创业大赛，截止2012年已举办七年，吸引了包括大陆、港台、加拿大等国家地区的创业者参与，因聚集了国内外最优质的潜力项目，创新中国 ','学校分站1|http://z3.php168.net','','','','创新中国,DEMO ,CHINA, 2013,春季赛拉开帷幕','1','','0','1370738424','1370738424','1370738424','1370738424','1','','','62','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1021','article','34','0','','西藏首个国家公园雅鲁藏布大峡谷国家公园建成','','0','','','','','5','新华网林芝12月8日电  6日，西藏首个国家公园——雅鲁藏布大峡谷国家公园正式建成。','学校分站1|http://z3.php168.net','','','','','1','','0','1379420676','1379420676','1379420676','1379420676','1','','','65','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1022','article','34','0','','社科院称2010住宅市场量价齐升 调控中再现回落','','0','','<!--#p8_attach#-->/cms/item/2010_12/08_11/1b2a4988ed469903.jpg.thumb.jpg','','','','由中国社会科学院财政与贸易经济研究所、社会科学文献出版社联合主办的“2011年《住房绿皮书》发布暨2010~2011年住房形势与政策研讨会”8日在北京举行。','中国网','','','','','1','','0','1379420676','1379420676','1379420676','1379420676','1','','','49','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1023','article','34','0','','中美大学生文化交流活动在我校举行','','0','','<!--#p8_attach#-->/cms/item/2012_08/23_00/afa9ec23dfb52a78.jpg.thumb.jpg','','','','2012年7月19日，由中美文化教育基金会发起、北京市委教育工委主办、中国传媒大学学生工作处承办的&ldquo;新世纪的丝绸之路&rdquo;之中美大学生文化交流活动在中国传媒大学综合实验楼400人报告厅拉开帷幕。此次活动吸','学校分站1|http://z3.php168.net','','','','','1','','0','1379420676','1379420676','1379420676','1379420676','1','','','83','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1027','article','47','1','admin','理论学习工作台指导意见','','0','','','','','','理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习','','','','','','1','admin','0','1393140327','1393140327','1393140327','1393140327','1','','','18','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1053','article','781','1','admin','集团简介','','0','','<!--#p8_attach#-->/cms/item/2015_01/06_20/e6a9fd61a4dddd43.jpg.cthumb.jpg','','','6','万达集团创立于1988年，形成商业、文化、金融三大产业集团，2015年资产6340亿元，收入2901亿元。万达商业是世界最大的不动产企业，世界最大的五星级酒店业主；万达文化集团是中国最大的文化企业、世界最大的电影院线运营商，世界最大的体育公司；万达金融是中国最大的网络金融企业。万达集团的目标是到2020年，资产达到2000亿美元，市值2000亿美元，收入1000亿美元，净利润100亿美元，成为世界一流跨国企业。 ','','','','','','1','','0','1408809600','1408851697','1408809600','1463355987','1','','','2309','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1057','article','778','1','admin','立信单位','','0','','<!--#p8_attach#-->/cms/item/2016_09/14_13/72931549075da279.jpg','','','6','学院委员会人事工作小组主要负责普通租赁人员招聘，自筹经费科研助理招聘，管理系列招聘，管理系列与实验技术系列初中级职务评审，返聘申请，延聘申请等工作。这个小组根据不同表格的需要，有不同的名称，例如“岗位聘任委员会”、“中级职务聘任委员会&','','','','','','1','','0','1408809600','1408863537','1408809600','1473832103','1','','','132','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1060','article','34','1','admin','中秋送欢乐 有爱更温暖','','0','','','','','','9月8日，正值中秋佳节，一户家庭贫困的三胞胎孩子的家中一片欢声笑语。来自土木工程学院红十字分会的3名志愿者，给这户三胞胎家庭送去了温暖和关爱。当志愿者们到达三胞胎小朋友的家中时，小朋友们十分高兴。小朋友们拉着志愿者到客厅围坐一圈，并给志愿者唱了一首ABC歌','','','','','','1','admin','0','1410360021','1410360021','1410360021','1410360021','1','','','94','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1062','article','34','1','admin','人民日报评论员：以“三种意识”推进全面深化改革','','0','','','','','','历经35年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼&amp;amp;ldquo;两个一百年&amp;amp;rdquo;目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的','','','','','','1','admin','0','1410360106','1410360106','1410360106','1410360106','1','','','94','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1065','article','34','1','admin','“24字”核心价值观具有强大认同力和凝聚力','','0','','','','','','十八大报告对社会主义核心价值体系建设提出了新部署新要求，强调&amp;amp;ldquo;要深入开展社会主义核心价值体系学习教育，用社会主义核心价值体系引领社会思潮、凝聚社会共识&amp;amp;rdquo;，&amp;amp;ldquo;倡导富强、民主、文明、和谐，倡导自由、平等、公正、法治，倡导爱国、敬业、诚信、友','','','','','','1','admin','0','1410360259','1410360259','1410360259','1410360259','1','','','108','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1068','article','128','1','admin','教育部关于切实加强和改学风建设的实施意见','','0','','<!--#p8_attach#-->/cms/item/2017_10/18_00/a8f2ffbbc9897422.jpg','','','6,1','�各省、自治区、直辖市教育厅（教委），新疆生产建设兵团教育局，有关部门（单位）教育司（局），部属各高等学校：　　为贯彻党的十七届六中全会“深化政风、行风建设，开展道德领域突出问题专项教育和治理”的精神，落实《国家中长期教育改革和发展规','','','','','','1','','0','1415721600','1415764749','1415721600','1508256287','1','','','130','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1078','article','128','0','admin','人民日报评论员：以“三种意识”推进全面深化改','','0','','<!--#p8_attach#-->/cms/item/2017_10/18_00/ca6fb08679f0adce.jpg','','','6,1','历经35年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼“两个一百年”目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的','|','','','','','1','','0','1431792000','1431835066','1431792000','1508256326','1','','','183','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1079','article','128','0','admin','市属高校三年规划建设项目开展专项稽察','','0','','<!--#p8_attach#-->/cms/item/2015_05/23_08/def29b9c7dd0d591.jpg','','','6','市发展改革委对部分市属高校三年规划建设项目开展专项稽察。为了加强对我市重点建设项目稽察监管，市发展改革委近日对北方工业大学、首都师范大学和北京第二外国语学院3所院校的6个建设项目开展了专项稽察，重点对项目进度情况、资金到位及使用情况；履行基本建设程序、','|','','','','','1','','0','1431792000','1431835066','1431792000','1432341455','1','','','57','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1082','article','58','1','admin','廖祥忠副校长率团赴清华、北师大开展科研专项调研 ','','0','','<!--#p8_attach#-->/cms/item/2014_08/30_21/fa206fa3582f2338.jpg','','','6','2012年7月10日，廖祥忠副校长赴清华大学、北京师范大学开展科研专项调研，文科科研处处长胡智锋等陪同调研，标志着我校人文社会科学专项系列调研活动正式启动。牋? 为贯彻落实《教育部关于推进高等学','34534543|','','','','','1','','0','1432396800','1432472802','1432396800','1432992473','1','','','89','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1133','article','44','1','admin','·一键替换和选择整套模板','','0','','<!--#p8_attach#-->/cms/item/2017_10/18_00/ca6fb08679f0adce.jpg','','','6','网站首页实施教程[2016-02-14]标签操作教程[2016-01-28]06--标签选择与使用的教程[2016-01-28]一键导入标签数据教程[2015-04-05]栏目的模板和标签样式[2015-04-05]如何进入到“显示标签”状','','test','','test','','1','','0','1456848000','1456879516','1456848000','1508256806','2','','','84','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1134','article','34','1','','教育部关于切实加强和改学风建设的实施意见','','0','','<!--#p8_attach#-->/cms/item/2014_09/01_17/385cdb5e20e4ed8e.jpg','','','6','为贯彻党的十七届六中全会“深化政风、行风建设，开展道德领域突出问题专项教育和治理”的精神，落实《国家中长期教育改革和发展规划纲要（2010-2020年）》的要求','','','','','','1','','0','1458230400','1458254863','1458230400','1458464368','1','','','131','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1135','article','34','1','','人民日报评论员：以“三种意识”推进全面深化改革','','0','','<!--#p8_attach#-->/cms/item/2012_09/02_02/ed06de3b55b12af0.jpg','','','6','历经35年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼“两个一百年”目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的','|','','','','','1','','0','1458230400','1458254863','1458230400','1458400569','1','','','94','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1140','article','34','1','','专家上海研讨大城市规','','0','','<!--#p8_attach#-->/cms/item/2015_05/23_08/2491223fbece3b6d.jpg','','','6','“新型城镇化”现已成为一个全民议题。如何走新型城镇化道路，需要全社会尤其是“规划师”的探索与创新。作为担当城乡规划重任的“青年规划师”的思考及探索，将为中国新型城镇化实践提供新的思路。　　17日，以“新型城镇化与城乡规','院系10（经济贸易学院）|','','','','','1','','0','1458230400','1458254863','1458230400','1508255349','1','','','122','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1141','article','34','1','','市属高校三年规划建设项目开展专项稽察','','0','','<!--#p8_attach#-->/cms/item/2015_05/23_08/6bda83cf89e6cf65.jpg','','','6','市发展改革委对部分市属高校三年规划建设项目开展专项稽察。为了加强对我市重点建设项目稽察监管，市发展改革委近日对北方工业大学、首都师范大学和北京第二外国语学院3所院校的6个建设项目开展了专项稽察，重点对项目进度情况、资金到位及使用情况；履行基本建设程序、','','','','','','1','','0','1458230400','1458254863','1458230400','1458394250','1','','','114','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1142','article','34','1','admin','陈进行出席博鳌论坛并参加B20专题研讨会','','0','','<!--#p8_attach#-->/cms/item/2016_04/14_11/c113d763ea07ba44.jpg.thumb.jpg','','','6','3月23日至24日，集团公司董事长、党组书记陈进行应邀出席2016年博鳌亚洲论坛。年会召开期间，陈进行参加了&amp;amp;ldquo;B20：全球经济治理中的商界声音与诉求&amp;amp;rdquo;专题研讨会，并作为基础设施组企业家代表发言。发言中，陈进行阐述了五点建议：一是建设低碳绿色环保高效的能','','','','','','1','admin','0','1460605199','1460605199','1460605199','1460605199','1','','','315','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1143','article','34','1','admin','王野平出席广州国际投资年会并会见广东省、广州市领导','','0','','<!--#p8_attach#-->/cms/item/2016_05/12_10/97e2e2bacae3ab08.jpg','','','6,1','3月23日，集团公司副董事长、总经理、党组副书记王野平应邀出席2016年中国广州国际投资年会全体大会。本届年会的主题是“动力源　增长极——国家中心城市与三大战略枢纽建设”，年会设立了18个专题分论坛，来自海内外投资及产业界的近1600名高端人士','','','','','','1','','0','1460563200','1460605401','1460563200','1473808744','1','','','270','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1146','article','809','1','admin','新华联集团地址变更通知','','0','','','','','','尊敬的各界朋友、各合作单位：由于新华联集团第四代总部大楼建成使用，新华联集团总部已于2015年10月26日由北京市朝阳区道家园18号新华联大厦，正式搬迁至集团新总部大楼，新址联系信息如下：地址：北京市通州区台湖镇政府大街新华联集团总部大楼电话：010-80538888传真','','','','','','1','admin','0','1463022590','1463022590','1463022590','1463022590','1','','','157','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1147','article','778','1','admin','公司获评集团“品牌传播先进单位','','0','','<!--#p8_attach#-->/cms/item/2016_09/14_13/ebdf3f1924970659.jpg','','','6','3月27日，从集团公司召开的党群系统工作会上传来令人欣喜的消息，公司一举获得集团2014年度“品牌传播与新闻宣传报道先进单位”等多项荣誉，党委书记张琳代表公司上台参加授牌仪式。过去的一年中，公司的品牌传播工作一直坚持以公司网站、报纸和各项目报纸为依','','','','','','1','','0','1462982400','1463024867','1462982400','1473832061','1','','','58','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1154','article','779','1','admin','刘军先生（非执行董事 ','','0','','<!--#p8_attach#-->/cms/item/2017_09/25_10/9997dc31235b5884.jpg','','','6','1970年出','','','','','','1','','0','1506268800','1506305629','1506268800','1509075837','1','','','96','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1156','article','815','1','admin','厂房设备2','','0','','<!--#p8_attach#-->/sites/item/2017_09/01_14/5f7f727c4499a829.JPG','','','6','','集团分站02|','','','','','1','admin','0','1504195200','1506648051','1504195200','1506648051','1','','','57','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1157','article','815','1','admin','厂房设备1','','0','','<!--#p8_attach#-->/sites/item/2017_09/29_09/6bce5b714dc924fe.jpg','','','6','&nbsp;','集团分站02|','','','','','1','admin','0','1504195200','1506648110','1504195200','1506648110','1','','','46','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1158','article','813','1','admin','劳动光荣2014','','0','','<!--#p8_attach#-->/sites/item/2017_09/29_09/334f6519e6fb0b5e.png','','','6','','集团分站02|','','','','','1','admin','0','1504540800','1506729674','1504540800','1506729674','1','','','43','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1159','article','813','1','admin','劳动节活','','0','','<!--#p8_attach#-->/sites/item/2017_09/29_09/94746ccf1a065e04.png','','','6','','集团分站02|','','','','','1','admin','0','1506614400','1506729674','1506614400','1506729674','1','','','45','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1160','article','813','1','admin','活动2016','','0','','<!--#p8_attach#-->/sites/item/2017_09/29_09/a86558591db7cadd.png','','','6','','集团分站02|','','','','','1','admin','0','1506649775','1506729674','1506649775','1506729674','1','','','39','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1161','article','813','1','admin','活动2017','','0','','<!--#p8_attach#-->/sites/item/2017_09/29_09/4c5546d7b1b3090d.png','','','6','','集团分站02|','','','','','1','admin','0','1506649816','1506729674','1506649816','1506729674','1','','','47','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1162','article','814','1','admin','活动2014','','0','','<!--#p8_attach#-->/sites/item/2017_09/29_09/02d11fab81d52693.png','','','6','','集团分站02|','','','','','1','admin','0','1506649885','1506729696','1506649885','1506729696','1','','','70','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1166','article','817','1','admin','交通银','','0','','<!--#p8_attach#-->/cms/item/2017_09/30_10/b54b65342bcadfa1.jpg','','','6','交通银','','','','','','1','admin','0','1506740325','1506740325','1506740325','1506740325','1','','','72','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1167','article','817','1','admin','工商银行','','0','','<!--#p8_attach#-->/sites/item/2017_09/18_07/39581594935e4eed.jpg','','','6','&nbsp;工商银行','集团分站02|','','','','','1','admin','0','1505691626','1506740334','1505691626','1506740334','1','','','22','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1168','article','817','1','admin','交通银','','0','','<!--#p8_attach#-->/sites/item/2017_09/18_07/59c44bd1aca22d30.jpg','','','6','交通银','集团分站02|','','','','','1','','0','1505691650','1506740334','1505691650','1506740535','1','','','33','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1169','article','817','1','admin','中国工商银行','','0','','<!--#p8_attach#-->/cms/item/2017_09/30_10/99a368bb842c1fcf.jpg','','','6','中国工商银行','','','','','','1','admin','0','1506740358','1506740358','1506740358','1506740358','1','','','73','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1176','article','809','1','admin','光明网：中葡两国元首见证中粮“卓越中心”落户葡萄牙','','0','','<!--#p8_attach#-->/cms/item/2019_02/26_15/7b9541f281ed57ee.jpg','','','6','葡萄牙当地时间12月5日，在中葡两国元首的共同见证下，中粮集团党组书记、董事长吕军和葡萄牙贸易与投资促进局局长路易斯•卡斯特罗•恩里克斯代表双方签署合作谅解备忘录。中粮集团将在葡萄牙波尔图大区设立为旗下中粮国际提供共享服务的“卓越中心&rdquo','','','','','','1','admin','0','1551165637','1551165637','1551165637','1551165659','1','','','78','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1177','article','809','1','admin','华为基于5G商用网络与折叠手机，重定义视频体验','','0','','<!--#p8_attach#-->/cms/item/2019_02/26_15/ae0544d6f30a810f.jpg','','','6','在2019世界移动大会前夕，华为在巴塞罗那举办主题为&amp;amp;ldquo;构建万物互联的智能世界&amp;amp;rdquo;的华为Day0论坛。在&amp;amp;ldquo;5G is ON&amp;amp;rdquo;分论坛上，基于西班牙沃达丰与华为联合部署的5G商用网络，华为常务董事、运营商BG总裁丁耘使用5G折叠屏智能手机演示了4K超高清视频点播','','','','','','1','admin','0','1551166599','1551166599','1551166599','1551166599','1','','','79','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1178','article','34','1','admin','活动2016','','0','','<!--#p8_attach#-->/sites/item/2017_09/29_09/a86558591db7cadd.png','','','6','','企业1|','','','','','1','admin','0','1506649775','1557305706','1506649775','1557305706','1','','','38','0','0','','','','a:2:{i:0;s:0:\\\"\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('1','1','1','','','湖南衡阳市衡山县争夺店门镇辖权引矛盾，传因此影响人事调整，衡山县县委书记空缺一年。衡山县村民反对划并曾多次堵路。知情者称，衡阳市划并店门镇是为争夺南岳衡山的管辖权。\r\\n','192.168.1.175','192.168.1.175','1291778075','<p align=\"center\" class=\"f_center\" style=\"text-align: center\">\r\n	　　<img alt=\"衡阳市与衡山县的“店门之争”（1）(图)\" src=\"<!--#p8_attach#-->/cms/item/2010_12/08_11/8764672f9925ff1f.jpg\" /></p>\r\n<p>\r\n	　　6月13日，衡山县群众因反对衡阳市划走店门镇而聚集在一起。一青年脸上贴着衡山县地图。资料图片</p>\r\n<p align=\"center\" class=\"f_center\" style=\"text-align: center\">\r\n	　　<img alt=\"衡阳市与衡山县的“店门之争”（2）(图)\" src=\"<!--#p8_attach#-->/cms/item/2010_12/08_11/b7e82af23b1144b0.jpg\" /></p>\r\n<p>\r\n	　　衡山坐落于衡阳市的南岳区，衡阳市&ldquo;扩城连岳&rdquo;解决南岳区行政&ldquo;飞地&rdquo;问题。</p>\r\n<p>\r\n	　　<strong>新京报12月8日报道 </strong>湖南衡阳市欲进行一次区划调整，而引发堵路事件，虽然事过半年，但如今仍是当地人的热议话题。</p>\r\n<p>\r\n	　　今年6月7日，衡阳市提出&ldquo;扩城连岳&rdquo;方案，欲把衡阳县的集兵镇、樟木乡划并给石鼓区，把衡山县的店门镇划并给南岳区。划并店门镇，遭到衡山县一些民众反对。</p>\r\n<p>\r\n	　　衡阳市发改委负责人解释，&ldquo;扩城连岳&rdquo;只为解决南岳区行政&ldquo;飞地&rdquo;问题，并能为南岳突破缺水缺地瓶颈。</p>\r\n<p>\r\n	　　而采访中湖南省委党校易可君认为，衡阳此举与湖南省推行的&ldquo;省直管县&rdquo;相背离。他说现有很多地方都在将优质资源的乡镇划并入城区，或搞经济圈，来影响&ldquo;省直管县&rdquo;行政区划调整。这是一场地方政府的利益博弈。</p>\r\n<p>\r\n	　　衡山县曾因南岳衡山而闻名。</p>\r\n<p>\r\n	　　如今，这座地处湖南省中部的小县城又再次跃入人们视线。</p>\r\n<p>\r\n	　　当地出了两件事，其一，衡山县县委书记一职已空缺近1年，衡阳市迟迟未安排人选。其二，今年6月，衡山县出现多人堵路风波，他们反对衡阳市将该县的店门镇划并到其他城区。</p>\r\n<p>\r\n	　　11月26日，这两件事依旧是当地人的热议话题。不管在商店里，还是公车上，只要提到店门镇，衡山县人的话匣子就关不住。</p>\r\n<p>\r\n	　　当地一名知情者告诉记者，其实在这两件事背后，还和湖南省正在推行的省直管县改革有关，这其中隐藏着一场地方政府的利益博弈。</p>\r\n<p>\r\n	　　<strong>&ldquo;没给衡山县穿小鞋&rdquo;</strong></p>\r\n<p>\r\n	　　<strong>当地已近一年没有县委书记，知情者称因县里闹出店门镇风波，故搁置人事调整；衡阳市官员予以否认</strong></p>\r\n<p>\r\n	　　罗东海原是衡山县的县委书记。今年2月，他被调至衡阳，任市委秘书长、办公室主任。衡山县县委书记的职务就此空缺。</p>\r\n<p>\r\n	　　衡山县一位官员说，县委书记空缺一年很不正常，地方政府是党委负责制。&ldquo;这跟空缺县长、局长概念不一样。&rdquo;</p>\r\n<p>\r\n	　　胡军是衡山县老年大学校长。他说，没有县委书记，影响到整个县的人事任免，现在有四五个局的老领导到期了，退不下来。</p>\r\n<p>\r\n	　　据了解，一般基层政府人事调动，3个月的调整期属于正常。就在罗东海被调走的4个月后的6月13日，当地发生了群众堵塞107国道事件。</p>\r\n<p>\r\n	　　据知情者介绍，当日，有省里一日常工作巡视小组到县里检查工作。上午9点左右，一些老干部和公务员聚集到县人民广场，手中打着横幅，脸上贴着衡山县地图，他们想见巡视组，反映问题，但未被接待，于是，这100多人冒雨堵塞国道，直至下午4点多，最后有代表和县政府协商后，人群方散去。胡军就是那天去协商的代表之一。</p>\r\n<p>\r\n	　　胡军说，群众堵路是因为他们反对衡阳市要划走店门镇。</p>\r\n<p>\r\n	　　今年6月7日，衡阳市委市政府联席会议决定，拟将衡山县店门镇，划归至衡阳市南岳区管辖。</p>\r\n<p>\r\n	　　6月11日晚，衡山县正式就此事召开常委会议，并同意了衡阳市的方案。</p>\r\n<p>\r\n	　　&ldquo;这个常委会开得很憋屈，要割走我们的地区，没有谁会愿意，但这又是没办法的事。&rdquo;一名与会官员事后称。</p>\r\n<p>\r\n	　　随后出现了6月13日的堵路事件。</p>\r\n<p>\r\n	　　3天后，衡阳市委、衡山县委宣布暂时停止店门镇的区划调整工作。</p>\r\n<p>\r\n	　　一名知情者透露，衡山县迟迟没有安排县委书记也和店门镇事件有关。</p>\r\n<p>\r\n	　　他说，现任县委副书记、县长周骥原应该被提拔为县委书记，此前衡阳市曾有人找过周骥，称店门并入南岳一事他要拍得了板，这是考验他的时候。</p>\r\n<p>\r\n	　　&ldquo;但现在，店门镇区划调整工作被搁置了，提拔一事也就被搁置了。&rdquo;这名知情者说。</p>\r\n<p>\r\n	　　衡阳市委宣传部新闻办主任成新平否认了这个说法。</p>\r\n<p>\r\n	　　他说，干部是一批批任免的，调研需要时间。书记调整，还要报省委组织部审批，也需要时间。</p>\r\n<p>\r\n	　　&ldquo;市里没有给衡山县穿小鞋。&rdquo;成新平说。</p>\r\n<p>\r\n	　　<strong>割店门，如割肉</strong></p>\r\n<p>\r\n	　　<strong>店门镇有水库和土地资源，若并入南岳可缓解其缺水缺地饥渴；衡山县官员称那无疑掐断县里农业命脉</strong></p>\r\n<p>\r\n	　　当划走店门镇的方案流传到民间后，激起了一些人的责难。网民在相关论坛发帖表示，资源都被划走了，衡山县的经济还要不要发展？</p>\r\n<p>\r\n	　　店门镇是衡山县面积最大的乡镇，该镇紧依南岳距其约15公里。由于衡山坐落在南岳区，店门镇也已开发出了白泥度假村、九观水上乐园、南岳衡山九龙峡漂流等旅游项目，实现年接待游客30多万人次以上。</p>\r\n<p>\r\n	　　一位不愿透露姓名的衡山县官员说，店门镇上还有兰竹、生猪养殖等基地。生猪基地养着四五万头猪，如果少了这些猪，县里连国家生猪养殖补贴都拿不到。</p>\r\n<p>\r\n	　　这名官员说，店门镇的农业收入占全县GDP三分之一，&ldquo;割店门，无异于割肉。&rdquo;</p>\r\n<p>\r\n	　　而在店门镇，还有一个更重要的宝贝：九观桥水库。这个水库总库容3370万立方米，灌溉衡山县及南岳区共10个乡镇的耕地8.13万亩。</p>\r\n<p>\r\n	　　当地知情者称，南岳区缺水、缺地，所以急需这方面的资源。</p>\r\n<p>\r\n	　　南岳区宣传部副部一官员证实了这一说法，南岳发展确实遇到瓶颈，&ldquo;缺人，缺地，缺水。&rdquo;</p>\r\n<p>\r\n	　　每年夏季，南岳衡山景区经常宾馆用水都保证不了，得分片停水。南岳人经常跑到衡山县去洗澡。他们协商到九观桥水库借水。</p>\r\n<p>\r\n	　　&ldquo;对方只答应水够的时候才能供给。他们要保证农业用水，无法同时兼顾我们。&rdquo;朱正光说。</p>\r\n<p>\r\n	　　南岳区很小，面积只有185平方公里，下辖5.4万人口，人均GDP排在衡阳市前列。</p>\r\n<p>\r\n	　　南岳区宣传部副部长朱正光说，南岳区经济结构单一，旅游产业占全区GDP产量的80%。在2003年非典时，旅游产值不到同期十分之一，对全区影响很大。</p>\r\n<p>\r\n	　　据知情人介绍，区里也想发展其他产业，想发展房产业，缺少土地；想改变旅游业单一局面，建个影视城，也得找衡山县要地；想从穿过衡山县的京珠高速开个口子方便南岳的旅游交通，不但要找高管局还要跟衡山县协调，处处受制。</p>\r\n<p>\r\n	　　&ldquo;若有了店门镇的地和水，就能缓解资源饥渴。&rdquo;这名知情人说。</p>\r\n<p>\r\n	　　而衡山县一官员对此质疑说，全县几乎1/3的农田都由此输水，受益农民达20万余人。若水库被划走，无异于掐住了衡山县农业命脉，衡山县农业还怎么存活？</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('2','2','1','','','贵州凯里网吧爆炸已造成6死38伤，官方称事件初步确定是由于网吧隔壁存放的大量危险化学品引发。据悉事发时网吧内有45人在上网。目前2名网吧负责人及存放化学品的业主已被警方控制。\r\n','192.168.1.175','192.168.1.175','1291778207','<p>\r\n	　　<strong><img alt=\"12月5日，救援人员在现场施救。新华社发(陈沛亮 摄) \" src=\"<!--#p8_attach#-->/cms/item/2010_12/08_11/7a19ccbc3af02c79.jpg\" /></strong></p>\r\n<p>\r\n	　　12月5日，救援人员在现场施救。新华社发(陈沛亮 摄)</p>\r\n<p>\r\n	　　<span style=\"font-weight: bold\">新华网贵阳12月5日报道 </span>5日，贵州省凯里市网吧爆炸事件的原因已初步查明，为网吧隔壁一出租屋内存放的危险化学品发生爆炸引发。</p>\r\n<p>\r\n	　　记者从凯里市委、市政府了解到，截至目前，经州、市公安机关刑侦部门现场勘查，初步确认爆炸系由网吧一墙之隔的一小房间堆放的危险化学物品引发。爆炸现场位于凯里市清平南路桥下，房间内靠南墙堆放有三种袋装化学粉状物品，经查看包装袋，分别为高效聚氯化铝、氢氧化铝、亚硝酸钠，在袋装物品上还散落着若干玻璃瓶装液体，瓶上标签分别为硝酸、盐酸和石油醚。</p>\r\n<p>\r\n	　　现警方已将网吧业主陈成贵、邢光昌控制，并于5日凌晨将堆放危险化学物品的业主吴展智抓获。</p>\r\n<p>\r\n	　　据了解，该网吧已开业多年，证照齐全，共有140台电脑，爆炸时，网吧共有45人正在上网。</p>\r\n<p>\r\n	　　爆炸发生后，贵州省委书记栗战书作出批示，要求全力以赴开展救援，尽快查明爆炸原因，做好善后工作；省委常委、副省长黄康生立即从贵阳赶赴凯里指挥救援、看望伤员；省委常委、政法委书记崔亚东在公安厅指挥中心连夜指挥侦查。</p>\r\n<p>\r\n	　　目前，这起爆炸事件已造成6人死亡，38人受伤，其中9人重伤。</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('3','3','1','','','　　中国新闻网12月8日报道;不少市民日前反映，最近去银行办理业务，发现此前广受质疑的小额账户管理费、短信通知费等仍在收取。银行人员称;这些收费监','192.168.1.175','192.168.1.103','1291778283','<p>\r\n	　　<strong>中国新闻网12月8日报道</strong>&nbsp;不少市民日前反映，最近去银行办理业务，发现此前广受质疑的小额账户管理费、短信通知费等仍在收取。银行人员称&ldquo;这些收费监管部门从未取消，我们一直在收取&rdquo;。</p>\r\n<p>\r\n	　　记者调查后发现，此前价格主管部门和银行监管机构称已经起草完成，并公开表示将广泛征求意见的《商业银行服务价格管理办法》，在相隔了数个月后至今不见下文，其何时能出台仍是一个未知数。</p>\r\n<p>\r\n	　　<strong>银行收费新规至今未露面</strong></p>\r\n<p>\r\n	　　记者近期在调查多家商业银行收费服务项目后发现，包括小额账户管理费、转账失败手续费等屡遭各界质疑的收费项目依然普遍存在。</p>\r\n<p>\r\n	　　今年年中，也正是这些收费项目以及来自商业银行语焉不详的解释引发社会普遍质疑。正当舆论质疑之声愈演愈烈时，监管部门的表态以及相关媒体由此引申的&ldquo;多项银行收费被叫停&rdquo;的报道让人们看到了希望。</p>\r\n<p>\r\n	　　国家发改委有关负责人7月28日就商业银行收费问题答记者问时表示：&ldquo;发展改革委已经配合有关部门研究起草了新的《商业银行服务价格管理办法》，发改委正在积极协调有关部门，对草案进行完善，争取尽快出台，以进一步规范商业银行收费行为，维护广大消费者利益&hellip;&hellip;&rdquo;</p>\r\n<p>\r\n	　　8月3日，银监会也发文说，正&ldquo;与国家发展改革委抓紧修订《商业银行服务价格管理暂行办法》&hellip;&hellip;将在征求各方意见后尽快发布&rdquo;。</p>\r\n<p>\r\n	　　然而，时隔数月，该办法不但没有&ldquo;尽快出台&rdquo;，甚至连公众意见也没有公开征求。</p>\r\n<p>\r\n	　　记者就此多次联系银监会及发改委的相关人士，询问该管理办法制定及征求意见进展情况，接受记者采访的银监会人士称&ldquo;领导忙于其他事务&rdquo;，发改委人士则称&ldquo;手中急件太多，等急件弄完再说&rdquo;，两部门人士始终不作正面回应。</p>\r\n<p>\r\n	　　据记者多方深入了解，除银行系统外，目前该办法征求意见工作仅在少数业内专家中小范围进行过。</p>\r\n<p>\r\n	　　&ldquo;既不出台，也不征求公众意见，公众甚至连该管理办法征求意见稿是个什么样子都不知道，感觉像平息公众质疑的权宜之计。&rdquo;采访中，一位银行客户的说法颇具代表性。</p>\r\n<p>\r\n	　　<strong>多方参与 为何公众声音独遭冷落</strong></p>\r\n<p>\r\n	　　商业银行服务价格的收取涉及到公众利益，其服务项目收费标准的制定和调整，理应听取包括商业银行、消费者组织及公众个人的意见。</p>\r\n<p>\r\n	　　然而，社会公众不仅从公开渠道看不到这份征求意见稿，记者辗转相关部门、被征求意见专家以及多家商业银行，也未能看到这份&ldquo;神秘&rdquo;的征求意见稿，来自银行和专家的说法是&ldquo;要保密&rdquo;。</p>\r\n<p>\r\n	　　而早在今年8月份银监会有关负责人在接受媒体采访时就表示，目前征求意见稿主要针对商业银行收集信息，约持续两周时间。各大商业银行当时亦表示已收到征求意见稿，并将积极反馈意见。</p>\r\n<p>\r\n	　　待遇的不同，不仅如此。</p>\r\n<p>\r\n	　　银监会和发改委在2003年出台的《商业银行服务价格管理暂行办法》就明文规定&ldquo;商业银行就前款事项(商业银行依据本办法制定服务价格)报告中国银行业监督管理委员会的同时，应抄送中国银行业协会&rdquo;。丝毫未提及作为公众利益发声载体的消费者协会或者其他组织。</p>\r\n<p>\r\n	　　作为银行业行业自律组织的银行业协会在年中关于银行收费的舆论质疑声中，发表意见称商业银行上调有关服务收费合法合规，遭多方诟病。</p>\r\n<p>\r\n	　　在采访中，银监会一位内部人士告诉记者，在商业银行服务价格管理办法的起草过程中，银行业协会参与了其中的部分工作，&ldquo;具体情况应该问他们&rdquo;。银行业协会人士则向记者表示，参与了管理办法起草的前期工作，但不清楚后续进展。</p>\r\n<p>\r\n	　　而消费者协会一位副会长在接受记者采访时十分无奈地说：&ldquo;消协在这次商业银行服务价格管理办法起草中基本上被冷场。&rdquo;</p>\r\n<p>\r\n	　　<strong>监管机构：是&ldquo;教练员&rdquo;还是&ldquo;裁判员&rdquo;</strong></p>\r\n<p>\r\n	　　显然，这项管理办法的制定与出台是一场多方利益的博弈。在此过程中，究竟谁能代表公众利益发声呢?</p>\r\n<p>\r\n	　　&ldquo;公众利益的代表，一方面是公权力机构，另一方面是一些社会团体。&rdquo;中国人民大学法学院教授刘俊海在接受记者采访时说，国家发改委、银监会均应代表公众利益。</p>\r\n<p>\r\n	　　然而，不为广大公众所知的是，作为银行业监管部门的银监会，每年均向商业银行征收银行业机构监管费和业务监管费。</p>\r\n<p>\r\n	　　记者手持的由国家发改委联合财政部于2007年12月及今年9月发布的两份通知表明，银行业机构监管费和业务监管费的征收额度与银行实收资本及资产总额存在关联。</p>\r\n<p>\r\n	　　与之相关，手续费及佣金净收入已成为拉动银行业绩增长的重要引擎。上市银行半年报显示，可统计的15家上市银行手续费及佣金净收入较去年同期增长382.92亿元，涨幅达35.13%，商业银行手续费及佣金增速普遍已超过传统息差收入。</p>\r\n<p>\r\n	　　&ldquo;正因为与此相关的利益勾连，银行业监管部门为商业银行收费行为充当&lsquo;保护伞&rsquo;，导致银行乱收费、乱涨价等行为一再上演。&rdquo;北京两高律师事务所律师董正伟十分犀利地指出。</p>\r\n<p>\r\n	　　2003年出台的《商业银行服务价格管理暂行办法》规定，除人民币基本结算类业务和银监会、国家发改委根据对个人、企事业的影响程度以及市场竞争状况确定的商业银行服务项目外，商业银行提供的其他服务实行市场调节价。实行市场调节价的服务价格，由商业银行总行自行制定和调整。</p>\r\n<p>\r\n	　　而这也正是今年年中众多商业银行单方面设定服务收费或上调服务收费标准的重要依据。</p>\r\n<p>\r\n	　　不少法律界人士却质疑其与现行《商业银行法》相抵触。《商业银行法》第五十条规定，商业银行收费项目和标准，由国务院银行业监督管理机构、中国人民银行根据职责分工，分别会同国务院价格主管部门制定。</p>\r\n<p>\r\n	　　细心的人士注意到，与此前出台的《商业银行服务价格管理暂行办法》只提&ldquo;市场调节价&rdquo;&ldquo;政府指导价&rdquo;、不提对公众相对有利的&ldquo;政府定价&rdquo;不同，发改委在答记者问中提出，商业银行服务收费依据其性质、特点和市场竞争状况，分别实行政府指导价、政府定价或市场调节价。</p>\r\n<p>\r\n	　　而银监会的发文丝毫未提及政府定价。</p>\r\n<p>\r\n	　　中国政法大学教授吴景明指出，措辞不同，可以看出二者立场有差异。</p>\r\n<p>\r\n	　　&ldquo;政府定价介入力度更大，政府定价机制是同企业某些见利忘义行为相抗衡的有效制度。&rdquo;刘俊海说。</p>\r\n<p>\r\n	　　&ldquo;这种差异，或许正是新规迟迟不见下文的重要原因。&rdquo;董正伟猜测说。</p>\r\n<p>\r\n	　　由于采访两部委未获正面回应，记者尚无法求证，上述猜测是否就是新办法迟迟未见进展的真实原因。</p>\r\n<p>\r\n	　　不过，法律界人士在接受记者采访时普遍认为，作为履行公共管理职能的部门，不宜成为利益攸关方，否则难以站在公正立场维护公众利益。</p>\r\n<p>\r\n	　　&ldquo;这也是商业银行不断出台收费项目、调整收费价格，老百姓反响强烈，却得不到银行监管机构任何有效制止的根源所在。&rdquo;吴景明说。</p>');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('26','43','1','','','　　新浪体育讯　北京时间12月9日消息，在斯洛文尼亚进行的乒乓球世青赛女团决赛中，中国女队1比3不敌石川佳纯领衔的日本队，仅获得亚军。这也是中国女乒八年来首次无缘世青赛冠军。男团决赛中国队则以3比0完胜日本队','192.168.1.175','192.168.1.175','1291882117','<p>\r\n	　　新浪体育讯　北京时间12月9日消息，在斯洛文尼亚进行的乒乓球世青赛女团决赛中，中国女队1比3不敌石川佳纯领衔的日本队，仅获得亚军。这也是中国女乒八年来首次无缘世青赛冠军。男团决赛中国队则以3比0完胜日本队夺冠。</p>\r\n<p>\r\n	　　<strong>女团：中国1-3日本</strong></p>\r\n<p>\r\n	　　日本队历史突破的最大功臣在于17岁的石川佳纯，她接连击败朱雨玲和顾玉婷，另外一场胜利来自于谷冈阿尤卡，她击败中国易芳贤；顾玉婷击败森园美咲赢得唯一一场胜利。详细比分为：朱雨玲2比3石川佳纯、顾玉婷3比1森园美咲、易芳贤2比3谷冈阿尤卡(音译)、顾玉婷0比3石川佳纯。</p>\r\n<p>\r\n	　　率先为中国队登场的是朱雨玲，朱雨玲在今年的日本公开赛上不敌王越古夺得亚军，一鸣惊人。而石川佳纯则是中国观众熟悉的福原爱之后的日本女乒代表。相对来讲，石川佳纯的大赛经验更为丰富。第一局，石川佳纯便以11比9拿下，第二局竞争格外胶着，一直到15比13，石川佳纯2比0领先，被逼到绝路的朱雨玲放手一搏，以11比6和11比7连扳两局，可惜的是决胜局石川佳纯轻松11比3拿下。中国队0比1落后。</p>\r\n<p>\r\n	　　第二场是中国顾玉婷，她也是2010年新加坡青奥会女单冠军得主，和森园美咲的较量中，两人前两局各有胜负，第三局11比8顾玉婷拿下，第四局两人打出16比14的高分，顾玉婷3比1胜出，中国队1比1平。</p>\r\n<p>\r\n	　　第三场由来自武汉的易芳贤出战，她在今年2月的直通赛中胜出从二队上升至一队，对手则是日本队的谷冈阿尤卡。第一局谷冈11比9拿下，易芳贤随后还以两个11比4，谁料第四局谷冈11比7实现逆转；决胜局，易芳贤再度失利，9比11不敌对手，中国队1比2落后。</p>\r\n<p>\r\n	　　第四场，由青奥会冠军顾玉婷迎战石川佳纯。中国队大比分落后，再输一场将丢冠。心理压力骤增的顾玉婷崩盘，7比11、6比11和8比11连输三局，不敌石川佳纯。成年组莫斯科世乒赛崩盘之后，世青赛上中国队再度落败，1比3，无缘女团冠军。这也是中国队八年来首度无缘女团世青赛冠军。</p>\r\n<p>\r\n	　　<strong>男团：中国3-0日本</strong></p>\r\n<p>\r\n	　　男女团冠军的较量都是中国与日本，虽然女队的姑娘们1比3落败，但男队的小伙子们顶住了日本队的强烈冲击，以3比0锁定胜局，其中周雨3比0击败吉田雅己，吴家骥3比2险胜丹羽孝希，林高远3比0击败平野友树。</p>\r\n<p>\r\n	　　首场比赛周雨的胜出显得相对容易，11比6、11比7和11比2，非常轻松；第二场吴家骥和丹羽孝希之间的较量则格外惊心动魄，首局吴家骥13比11拿下，接着5比11和4比11连丢两局；第四局，吴家骥11比9艰难胜出；关键的决胜局，吴家骥7比10落后，丹羽孝希手握三个赛点，而吴家骥此时发挥神勇连追三分，10平！丹羽孝希赢得接下来的一分，第四个赛点出现，吴家骥依旧沉着挽救赛点成功，并赢得接下来的两分，逆转成功！五局大战，吴家骥终于拿下。</p>\r\n<p>\r\n	　　第三场林高远迎战日本平野友树，他也是日本名将平野早矢香的弟弟。日本队0比2落后的情况下，平野友树也未能抵挡住中国队的攻势，7比11、6比11、6比11，平野友树0比3不敌林高远，中国队也3比0胜出，夺得男团冠军。(安然)</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('82','119','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558474','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('83','120','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558482','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('84','121','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558488','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('85','122','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558495','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('86','123','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558502','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('87','124','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558508','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('259','322','1','','','原告李某与被告某证券公司于2000年10月19日签订了一份配售新股协议书。','127.0.0.1','113.96.230.42','1377244239','<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	[案情介绍]</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　原告李某与被告某证券公司于2000年10月19日签订了一份配售新股协议书。协议约定：一、原告选择被告某证券公司为二级市场配售新股的代理商，被告经审核同意接受原告的委托；二、协议签订后，如遇新股配售发行，被告将自动进行申购处理，原告于T+2日到被告处查询中签与否并存足款项，账面资金不足，视同放弃认购；三、原告要撤销上海账户指定交易或深圳账户进行转托管必须同时撤销本协议，否则，由此引起的后果由原告负责。</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　协议签订后，2003年11月5日长江电力配售新股，原告账户中签1000股，每股4.30元。但由于原告资金账户余额不足，只成交了六股。被告于中签当日拨打原告手机通知原告，因原告手机关机，未能通知到原告，其后的两天被告未再通知。之后该股票上市交易，开盘价6.23元，当日最高价6.48元、收盘价为6.18元，原告损失1918.42元。原告向被告某证券公司索赔，遭拒绝后具状至烟台市牟平区人民法院，要求被告某证券公司赔偿损失1918.42元。</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　[法院审判]</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　法院经审理后认为，原、被告之间的民事法律关系为代理关系。被告某证券公司作为代理人为维护和实现被代理人（原告）的合法权益，应认真履行代理职责，如实、及时报告新代理事务进展情况，因其殆于通知原告股票中签，导致原告利益受损，应赔偿原告合理的经济损失。被告某证券公司以原告作为投资者，有义务查询股票是否中签，且原告已查询到股票的配号，而不查询中签结果，作为免责事由的理由不当。虽然合同中约定，原告于T+2到被告处查询中签与否并存足款项，账面资金不足，视同放弃认购。但该约定被告是根据2000年2月13日证监发行字[2000]5号 《关于向二级市场投资者配售新股有关问题的通知》的规定而制定，该条款为格式条款，在原告不具备较强专业知识的情况下，被告主张以该约定免除其责任，理由不当，本院不予支持。依据《中华人民共和国民法通则》第六十六条第二款之规定，判决被告某证券公司于判决生效后十日内赔偿原告李某经济损失1918.42元。</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　[法官评析]</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　本案的审理涉及新股中签后券商是否有通知股民的义务及格式条款的理解等问题。</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　一、新股中签后券商是否有通知股民的义务</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　新股中签后券商有无通知义务及相关法律问题，涉及投资者与券商双方的权利、义务和切身利益，存在问题和潜在纠纷较为普遍。券商往往以新股中签通知只是券商提供的一项服务内容，并不是证券公司的法定义务作为理由进行抗辩。</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　在我国目前的制度体系内，确实没有任何关于券商必须尽以上通知义务的明确法律规定。投资者和证券公司所签的协议所约定的条款就显得特别重要。如果证券公司签订的代理申购市值配售协议约定证券公司具有中签通知义务，证券公司没有履行该义务应承担违约责任；否则证券公司不应承担责任。如果证券公司在营业大厅等公开场合明确告示有中签通知服务并且股民留有准确的联系方式，但证券公司仍未通知股民，导致股民缴款不足而造成经济损失，证券公司应当承担责任。因为，证券公司以公开的方式在其大门口醒目位置张贴书面告示，称证券公司将设法通知中签者。这是对股民的郑重承诺，应视作为双方所签订协议中权利义务的补充，一旦公开告示，即对其构成法律约束力，成为其应当履行，而不是可以履行也可以不履行的义务。这不仅是一个法律问题，也是证券公司信誉和形象的问题。在此种情况下，股民新股中签并留有准确的联系方式，未能履行通知义务并导致股款不足而无法足额认购并造成经济损失，证券公司毫无疑问应承担经济责任。如果协议中约定了证券公司的中签通知义务，因为股民的联系方式不畅导致无法通知股民，需要根据具体情况分析以确定应当由谁承担责任。如股民留下的地址、电话号码准确无误，则证券公司没有通知的行为属于违约行为，应该承担违约责任。除非证券公司能够提供相反的证据，否则证券公司不能免除责任；如果是由于手机关机、电话无人接听，股民应自行承担责任。但是，限于技术条件的限制，举证可能会有一定的难度。</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　二、如果协议里无此通知的约定，证券公司是否应承担责任</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　证券公司代理投资者进行新股配售申购，双方形成平等主体之间的代理法律关系，按照代理协议的约定履行权利和义务，一方支付代理费用，另一方提供服务，是合法有效的法律行为。代理制度为被代理人的利益而设，被代理人设立代理的目的是为了利用代理人的知识和技能为自己服务。代理人的活动是为了实现被代理人的利益。因此，代理人的代理行为，应从被代理人的利益出发，以对自己事务的注意，处理好被代理人的事务，以增加被代理人的利益。一般投资者之所以委托证券公司统一申购，就是由于自己资金、时间、能力、精力的欠缺才需委托证券公司代理，证券公司作为代理人，必须尽到其善良管理人的义务，以对自己事务的注意程度来处理被代理人的事务。</p>\r\n<p style=\"font-family: Simsun; font-size: 14px; line-height: 24px; text-indent: 24px; \">\r\n	　　代理人应将处理代理事务的一切重要情况向被代理人报告，以使被代理人知道事务的进展以及自己财产的损益情况。在代理事务处理完毕后，代理人还应向被代理人报告执行任务的经过和结果，并提交必要的文件材料。证券公司作为代理人应认真履行代理职责，如实、及时报告新代理事务进展情况，以此来维护和实现被代理人的合法权益。被告为原告申购的股票中签，被告应及时尽力通知原告，便于原告在有效时间内存足款项进行认购。</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('260','323','1','','','创新中国DEMO CHINA”是由创业邦举办的一场面向国内外创业者的创业大赛，截止2012年已举办七年，吸引了包括大陆、港台、加拿大等国家地区的创业者参与，因聚集了国内外最优质的潜力项目，创新中国 ','127.0.0.1','127.0.0.1','1370738424','创新中国DEMO CHINA&rdquo;是由创业邦举办的一场面向国内外创业者的创业大赛，截止2012年已举办七年，吸引了包括大陆、港台、加拿大等国家地区的创业者参与，因聚集 了国内外最优质的潜力项目，创新中国 DEMO CHINA已然成为国内外创业项目展示的第一平台，创业、投资趋势的风向标，受到业内创业者和投资人的强烈关注。现&ldquo;创新中国DEMO CHINA 2013&rdquo;春季赛已启动，准备对&ldquo;创新中国DEMO CHINA&rdquo;app应用版本更新，地址：https://itunes.apple.com/cn/app/chuang-xin-zhong-guo /id551344402?mt=8');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('286','1021','1','','','新华网林芝12月8日电  6日，西藏首个国家公园——雅鲁藏布大峡谷国家公园正式建成。','127.0.0.1','127.0.0.1','1379420676','<p>\r\n	　　西藏林芝地区行署副专员红卫说，雅鲁藏布大峡谷国家公园的建成，可以在不远的未来带动林芝周边自然保护区和国家公园的建设，打造一个面积最大、自然体系最完整的国家公园群，这些周边地区包括察隅、然乌、波密、易贡、尼洋河流域等，描摹一幅完整的自然文化生态公园的诱人画卷，推动当地旅游业快速发展，为把旅游业培育成支撑林芝地区跨越式发展的主导产业、人民群众更加满意的现代服务业贡献力量。</p>\r\n<p>\r\n	　　西藏自治区旅游局副局长王松平说，近几年，通过当地政府和西藏有关旅游企业的精心打造，雅鲁藏布大峡谷景区基础设施不断改善，旅游产品不断丰富，景区品牌得以传播。目前，大峡谷已逐步成为集观光、摄影、徒步、自驾、游船、科考、探险、朝圣等功能为一体的综合型景区，世界级生态旅游圣地。今年前10月，大峡谷景区已接待游客13.5万人次，是整个西藏增幅最高、发展最快、潜力最大的新兴旅游区。</p>\r\n<p>\r\n	　　西藏旅游股份有限公司董事长欧阳旭说，雅鲁藏布大峡谷位于藏东南边陲，历史上由于重山阻隔、峡谷挡道，使她长期与世隔绝，像一座孤岛沉睡在群山之中。20世纪末，长期藏在隐秘腹地的雅鲁藏布大峡谷终于向人类展示了她绚丽的身姿，并以其高度、深度、长度、生物多样性、水能蕴藏量等指标，荣膺&ldquo;世界第一大峡谷&rdquo;，国务院于1998年10月10日正式予以命名。</p>\r\n<p>\r\n	　　据了解，国家公园制度是一种资源保护与开发利用实现双赢的先进管理模式，以求生态环境与旅游消费达到和谐共存。国家公园不仅仅是个名称，其背后蕴涵的是一种对自然与文化区域进行可持续发展与保护的最优化的管理体制。国内外实践证明，国家公园制度行之有效、普遍适应，体现了兼顾保护与利用、协同开发与管理的战略，既有利于保护珍贵的自然资源和人文资源，又有利于开发出游客赞赏的目的地景区，还有利于改善社区居民的生活环境。（完）</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('287','1022','1','','<!--#p8_attach#-->/cms/item/2010_12/08_11/1b2a4988ed469903.jpg.thumb.jpg','由中国社会科学院财政与贸易经济研究所、社会科学文献出版社联合主办的“2011年《住房绿皮书》发布暨2010~2011年住房形势与政策研讨会”8日在北京举行。','127.0.0.1','127.0.0.1','1379420676','<p align=\"center\" class=\"f_center\" style=\"text-align: center;\">\r\n	　　<strong><img align=\"center\" alt=\"社科院称2010住宅市场量价齐升 调控中再现回落\" border=\"0\" id=\"14551850\" sourcedescription=\"编辑提供的本地文件\" sourcename=\"本地文件\" src=\"<!--#p8_attach#-->/cms/item/2010_12/08_11/1b2a4988ed469903.jpg\" style=\"width: 600px; height: 450px;\" /></strong><br />\r\n	<br />\r\n	　　社科院《住房绿皮书》。中国网 杨佳 摄</p>\r\n<p>\r\n	　　<strong>中国网12月8日报道 </strong>由中国社会科学院财政与贸易经济研究所、社会科学文献出版社联合主办的&ldquo;2011年《住房绿皮书》发布暨2010~2011年住房形势与政策研讨会&rdquo;8日在北京举行。会议研讨了中国住房发展面临的现实问题和重大挑战,分析了2009~2010年中国住房及相关市场走势，预测了2010~2011年我国住房发展趋势, 会议正式对外发布由中国社会科学院财政与贸易经济研究所、中国社会科学院城市与竞争力研究中心完成的国家重大社科基金阶段性成果：住房绿皮书《中国住房发展报告（2010-2011）》。</p>\r\n<p>\r\n	　　绿皮书指出，住宅市场在2009年第4季度延续了回暖趋势，特别是12月由于购房优惠政策的到期，住宅销售面积达到16342.25万平方米。</p>\r\n<p>\r\n	　　进入2010年以来，住宅销售面积增速下降，特别是4月新一轮房地产调控以来，住宅销售面积呈现负增长。住宅销售价格也在2009年第3季度以来经历了较快地上升，在2010年4月增速达到15.4%。但由于严厉的房地产调控措施的出台，住宅销售价格增速也逐月下降，2010年8月降至11.7%。</p>\r\n<p>\r\n	　　绿皮书分析认为，宽松的货币政策致使住宅市场快速回暖以至于过热，从而招致了新一轮的宏观调控。尽管销售面积和销售价格有所回调,但住宅投资由于滞后效应的存在并没有受到太大影响。住宅投资完成额在2009年第3季度以来维持较高的增速，2010年1月达到40.0%，8月才有所降低，为30.8%，但总体仍维持了较高的增速。相比2009年住房投资对经济增长的直接带动作用仅为0.42个百分点（当年GDP实际增长率为8.7个百分点），贡献度为4.83%；而2010年上半年住房投资对经济增长的直接带动作用增强，为0.93个百分点，贡献度为8.34%，比上年明显提高。</p>');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('288','1023','1','','<!--#p8_attach#-->/cms/item/2012_08/23_00/afa9ec23dfb52a78.jpg.thumb.jpg','2012年7月19日，由中美文化教育基金会发起、北京市委教育工委主办、中国传媒大学学生工作处承办的&ldquo;新世纪的丝绸之路&rdquo;之中美大学生文化交流活动在中国传媒大学综合实验楼400人报告厅拉开帷幕。此次活动吸','127.0.0.1','127.0.0.1','1379420676','<p>\r\n	2012年7月19日，由中美文化教育基金会发起、北京市委教育工委主办、中国传媒大学学生工作处承办的&ldquo;新世纪的丝绸之路&rdquo;之中美大学生文化交流活动在中国传媒大学综合实验楼400人报告厅拉开帷幕。此次活动吸引了来自中国传媒大学、北京交通大学、北京工商大学以及加州大学洛杉矶分校等中美两国十余所大学的两百余名师生。&nbsp;</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp; 北京市委教工委副书记唐立军、中国传媒大学副书记田维义、北京市教工委宣教处处长王达品、中国传媒大学学生处处长张根兴，加州大学洛杉矶分校（UCLA）副校长Janina Montero，美国国家癌症学会学部委员、加州大学尔湾分校医学院流行病学系主任Hoda Culver等出席活动。田维义副书记在欢迎辞中表示，&ldquo;新世纪的丝绸之路&rdquo;项目至今已有12年历史，期间成就了许多重要的中美教育界峰会、论坛和学术交流活动，并为上万名中美大学生和教育工作者搭建了沟通的桥梁，我校十分重视本次活动，也希望今后能够与该项目持续开展合作。在随后的颁奖仪式上，唐立军副书记致开幕词，他表示，&ldquo;新世纪的丝绸之路&rdquo;活动以丝绸和绘画为载体，推动了中美大学生的文化交流和感情沟通，增进了彼此了解，扩大了文化共识，也将推动北京作为中国特色世界城市的建设。</p>\r\n<p align=\"center\">\r\n	<span style=\"FONT-FAMILY: KaiTi_GB2312\"><img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25485&amp;filename=p1052_1342756244906.jpg\" /></span></p>\r\n<p align=\"center\">\r\n	<span style=\"FONT-FAMILY: KaiTi_GB2312\">北京市教工委唐立军副书记在颁奖仪式上致辞</span></p>\r\n<p align=\"center\">\r\n	<span style=\"FONT-FAMILY: KaiTi_GB2312\">&nbsp;</span></p>\r\n<p align=\"center\">\r\n	<span style=\"FONT-FAMILY: KaiTi_GB2312\"><img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25485&amp;filename=p1052_1342756362215.jpg\" /></span></p>\r\n<p align=\"center\">\r\n	<span style=\"FONT-FAMILY: KaiTi_GB2312\">田维义副书记为获得丝画大赛一等奖的学生颁奖</span><span style=\"FONT-FAMILY: KaiTi_GB2312\">&nbsp;</span></p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp; 为使活动突出文化交流主题、凸显民族文化特色，我校周密部署，精心组织安排了交流活动的各个环节。在五个多小时的交流活动中，中美学生文化论坛、丝画展示评选、&ldquo;丝画设计大赛&rdquo;颁奖仪式等环节精彩纷呈，既突出了&ldquo;弘扬践行北京精神、增进中美文化交流&ldquo;的主题，又开拓了首都大学生的国际视野，加深了中美大学生之间的文化和思想交流。</p>\r\n<p align=\"center\">\r\n	<span style=\"FONT-FAMILY: KaiTi_GB2312\"><img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25485&amp;filename=p1052_1342756273300.jpg\" /></span></p>\r\n<p align=\"center\">\r\n	<span style=\"FONT-FAMILY: KaiTi_GB2312\">中美学生丝画作品展示 </span></p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp; 为给大家提供充分交流的机会，中美学生文化论坛分为分论坛和总论坛两部分。参加活动的中美大学生首先分组至四个分论坛展开主题为&ldquo;中美友谊对世界和平的重要性&rdquo;的热烈讨论，之后又齐聚总论坛，由各组代表向大会作主题发言，分享交流成果。</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp; 作为&ldquo;新世纪的丝绸之路&rdquo;中美大学生文化交流活动的重要组成部分，本次丝画设计大赛共征集到数十所中美高校大学生设计的作品百余幅，大赛从众多提交作品中共评出中美双方一、二、三等奖各三名，鼓励奖各五名。由到场的中美领导嘉宾为两国获奖大学生颁发了获奖证书和奖品。为感谢加州大学洛杉矶分校（UCLA）副校长Janina&nbsp;Montero对中美大学生文化交流活动的支持，大赛授予其&ldquo;特别贡献奖&rdquo;称号。随后，我校学生精心准备的精彩歌舞表演为颁奖典礼锦上添花，并博得了台下观众的阵阵掌声。此次文化交流活动在和平友好的氛围中圆满结束。 &nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('290','1027','1','','','理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习','120.86.68.196','120.86.68.196','1393140327','<p>\r\n	理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见</p>\r\n<p>\r\n	理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见理论学习工作台指导意见</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('304','1053','1','','<!--#p8_attach#-->/cms/item/2015_01/06_20/e6a9fd61a4dddd43.jpg.cthumb.jpg','万达集团创立于1988年，形成商业、文化、金融三大产业集团，2015年资产6340亿元，收入2901亿元。万达商业是世界最大的不动产企业，世界最大的五星级酒店业主；万达文化集团是中国最大的文化企业、世界最大的电影院线运营商，世界最大的体育公司；万达金融是中国最大的网络金融企业。万达集团的目标是到2020年，资产达到2000亿美元，市值2000亿美元，收入10','121.8.7.164','175.13.253.52','1408809600','<p style=\"font-size: 14px; font-family: 宋体, Arial; color: rgb(27,27,27); padding-bottom: 0px; padding-top: 0px; padding-left: 0px; margin: 0px; line-height: 28px; padding-right: 0px; background-color: rgb(250,250,250); -ms-word-break: break-all\">&nbsp;</p>\r\n\r\n<p style=\"font-size: 14px; font-family: 宋体, Arial; color: rgb(27,27,27); padding-bottom: 0px; padding-top: 0px; padding-left: 0px; margin: 0px; line-height: 28px; padding-right: 0px; background-color: rgb(250,250,250); -ms-word-break: break-all\"><strong><font color=\"#0021b0\" size=\"5\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 万达 集团</font></strong>　　<br />\r\n　　<font color=\"#2690fe\" size=\"3\">Guanzhou guowei soft Technology CO.,Ltd</font></p>\r\n\r\n<p style=\"font-size: 14px; font-family: 宋体, Arial; color: rgb(27,27,27); padding-bottom: 0px; padding-top: 0px; padding-left: 0px; margin: 0px 0px 0px 40px; line-height: 28px; padding-right: 0px; background-color: rgb(250,250,250); -ms-word-break: break-all\"><br />\r\n　　<a href=\"<!--#p8_attach#-->/cms/item/2016_05/12_10/97e2e2bacae3ab08.jpg\" target=\"_blank\"><img alt=\"timg.jpg\" src=\"<!--#p8_attach#-->/cms/item/2016_05/12_10/97e2e2bacae3ab08.jpg\" style=\"height: 235px; width: 500px\" /></a></p>\r\n\r\n<div class=\"editBody\" style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(102,102,102); padding-bottom: 0px; padding-top: 0px; font: 14px \'Microsoft YaHei\', 微软雅黑, Lucida, Verdana, \'Hiragino Sans GB\', STHeiti, \'WenQuanYi Micro Hei\', SimSun, sans-serif; padding-left: 0px; widows: 1; margin: 0px; letter-spacing: normal; padding-right: 0px; text-indent: 0px; -webkit-text-stroke-width: 0px\">\r\n<p class=\"t2\" style=\"padding-bottom: 10px; text-align: justify; padding-top: 10px; padding-left: 0px; margin: 0px; line-height: 21px; padding-right: 0px; text-indent: 2em\">万达商业(03699.HK）是全球规模最大的不动产企业，截至2016年5月，已在全国开业134座万达广场、85家酒店，持有物业面积2632万平方米。万达商业拥有全国唯一的商业规划研究院、酒店设计研究院、全国性的商业地产建设和管理团队，形成商业地产的完整产业链和企业的核心竞争优势。2015年，万达商业开始向轻资产模式转型，标志着万达商业的发展进入靠品牌获取利润的崭新阶段。</p>\r\n\r\n<p class=\"t2\" style=\"padding-bottom: 10px; text-align: justify; padding-top: 10px; padding-left: 0px; margin: 0px; line-height: 21px; padding-right: 0px; text-indent: 2em\">万达文化产业集团是中国最大的文化企业，资产903亿元，2015年收入512亿元，旗下包括影视、体育、旅游、儿童娱乐4家公司，目标是2020年成为收入排名全球前五的文化企业。</p>\r\n\r\n<p class=\"t2\" style=\"padding-bottom: 10px; text-align: justify; padding-top: 10px; padding-left: 0px; margin: 0px; line-height: 21px; padding-right: 0px; text-indent: 2em\">万达金融集团旗下拥有网络金融、投资、保险等公司，为商家和消费者提供一站式创新金融服务，2015年收入209亿元。</p>\r\n</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('308','1057','1','','<!--#p8_attach#-->/cms/item/2016_09/14_13/72931549075da279.jpg','学院委员会人事工作小组主要负责普通租赁人员招聘，自筹经费科研助理招聘，管理系列招聘，管理系列与实验技术系列初中级职务评审，返聘申请，延聘申请等工作。这个小组根据不同表格的需要，有不同的名称，例如“岗位聘任委员会”、“中级职务聘任委员会&','121.8.7.164','175.13.251.35','1408809600','<h1 id=\"xs-page-title\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 立信单位</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style=\"margin-left: 120px;\"><img alt=\"668p=0.jpg\" src=\"<!--#p8_attach#-->/cms/item/2016_09/14_13/72931549075da279.jpg\" style=\"width: 305px; height: 220px;\" /></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('311','1060','1','','','9月8日，正值中秋佳节，一户家庭贫困的三胞胎孩子的家中一片欢声笑语。来自土木工程学院红十字分会的3名志愿者，给这户三胞胎家庭送去了温暖和关爱。当志愿者们到达三胞胎小朋友的家中时，小朋友们十分高兴。小朋友们拉着志愿者到客厅围坐一圈，并给志愿者唱了一首ABC歌','14.120.231.20','14.120.231.20','1410360021','<p align=\"left\" style=\"line-height:26pt;text-indent:24pt;margin:0cm 0cm 10pt;\">\r\n	<span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">9</span></span><span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">月8</span>日，正值中秋佳节，一户家庭贫困的三胞胎孩子的家中一片欢声笑语。来自土木工程学院红十字分会的3</span>名志愿者，给这户三胞胎家庭送去了温暖和关爱。</p>\r\n<p align=\"left\" style=\"line-height:26pt;text-indent:24pt;margin:0cm 0cm 10pt;\">\r\n	<span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">当志愿者们到达三胞胎小朋友的家中时，小朋友们十分高兴。小朋友们拉着志愿者到客厅围坐一圈，并给志愿者唱了一首ABC</span>歌。随后，志愿者们拿出了一些空瓶子，在小朋友们惊奇的目光中，把那些废瓶子变成了一把扫把，这激起了小朋友的好奇心以及强烈的动手感，于是在志愿者们的指导下，小朋友们把原本的空瓶子，变成了笔筒、花篮等手工艺品。接着，志愿者们同小家伙们玩起了游戏，小朋友们欢乐的笑声贯穿在游戏之中。最后，志愿者们拿出了送给小朋友们准备的中秋礼物，在小朋友们的欢呼雀跃中，本次志愿者活动圆满的落下帷幕。</span></p>\r\n<p align=\"left\" style=\"line-height:26pt;text-indent:24pt;margin:0cm 0cm 10pt;\">\r\n	<span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">此次关爱三胞胎的活动，不仅增强了三个小朋友们的环保意识，还为她们送来温暖。志愿者们虽然未能与家人一起度过这个中秋，但是因为爱的奉献，他们没有遗憾反而倍感开心。</span></span></p>\r\n<p align=\"right\" style=\"text-align:right;line-height:26pt;text-indent:24pt;margin:0cm 0cm 10pt;\">\r\n	<span style=\"font-size:12pt;\"><span style=\"font-family:宋体;\">土木工程学院宣</span></span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('313','1062','1','','','历经35年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼&amp;amp;ldquo;两个一百年&amp;amp;rdquo;目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的','14.120.231.20','14.120.231.20','1410360106','<p align=\"left\" style=\"line-height:22.5pt;text-indent:24pt;margin:7.5pt 0cm;\">\r\n	<span style=\"font-size:16pt;\"><span style=\"color:#26214a;\"><span style=\"font-family:仿宋_gb2312;\">历经35</span>年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼&ldquo;两个一百年&rdquo;目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的历史起点上改革&ldquo;集结号&rdquo;。</span></span></p>\r\n<p align=\"left\" style=\"line-height:22.5pt;text-indent:24pt;margin:7.5pt 0cm;\">\r\n	<span style=\"font-size:16pt;\"><span style=\"color:#26214a;\"><span style=\"font-family:仿宋_gb2312;\">历史是最好的教科书，深刻揭示出一个国家、一个民族的进步发展之道。35</span>年来，从国民经济的快速增长，到人民生活水平的显著改善，从经济体制的深刻变革，到国家和人民面貌的深刻变化，莫不靠的是改革开放。今天，破解发展中面临的难题、化解来自各方面的风险挑战、推动经济社会持续健康发展，除了深化改革开放，别无他途。全面深化改革，关系党和人民事业前途命运，关系党的执政基础和执政地位，在整个社会主义现代化进程中，改革开放的旗帜，绝不能有丝毫动摇。</span></span></p>\r\n<p align=\"left\" style=\"line-height:22.5pt;text-indent:24pt;margin:7.5pt 0cm;\">\r\n	<span style=\"font-size:16pt;\"><span style=\"color:#26214a;\"><span style=\"font-family:仿宋_gb2312;\">这次三中全会制定全面深化改革的总体方案，提出了全面深化改革的指导思想、总体思路、目标任务，为的就是高举改革开放旗帜、不断推进中国特色社会主义制度自我完善和发展，为实现亿万人民的中国梦释放强大动力。这是指导新形势下全面深化改革的纲领性文件。当前和今后一个时期，全党全国的一项重要政治任务，就是要以强烈的进取意识、机遇意识、责任意识，深刻领会全会精神并转化成改造现实世界的强大力量。</span></span></span></p>\r\n<p align=\"left\" style=\"line-height:22.5pt;text-indent:24pt;margin:7.5pt 0cm;\">\r\n	<span style=\"font-size:16pt;\"><span style=\"color:#26214a;\"><span style=\"font-family:仿宋_gb2312;\">在35</span>年的改革历程中，我们谱写的中华民族自强不息、顽强奋进的壮丽史诗，靠的是一往无前的进取精神。今天，改革面临的矛盾越多、难度越大，越要坚定与时俱进、攻坚克难信心，越要有进取意识、进取精神、进取毅力，越要有&ldquo;明知山有虎，偏向虎山行&rdquo;的勇气。纵观世界，变革是大势所趋、人心所向。领导改革开放这一前无古人、世所罕见的伟大事业，最要不得的是思想僵化、固步自封。&ldquo;逆水行舟用力撑，一篙松劲退千寻&rdquo;。以习近平同志为总书记的党中央，作出了全面深化改革的战略部署，牢固树立进取意识，全面审视当今世界和当代中国发展大势，全面把握我国发展新要求和人民群众新期待，更加奋发有为地开拓进取，我们就一定能够坚定不移把改革开放引向深入。</span></span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('316','1065','1','','','十八大报告对社会主义核心价值体系建设提出了新部署新要求，强调&amp;amp;ldquo;要深入开展社会主义核心价值体系学习教育，用社会主义核心价值体系引领社会思潮、凝聚社会共识&amp;amp;rdquo;，&amp;amp;ldquo;倡导富强、民主、文明、和谐，倡导自由、平等、公正、法治，倡导爱国、敬业、诚信、友','14.120.231.20','14.120.231.20','1410360259','<div align=\"left\">\r\n	<font size=\"4\">十八大报告对社会主义核心价值体系建设提出了新部署新要求，强调&ldquo;要深入开展社会主义核心价值体系学习教育，用社会主义核心价值体系引领社会思潮、凝聚社会共识&rdquo;，&ldquo;倡导富强、民主、文明、和谐，倡导自由、平等、公正、法治，倡导爱国、敬业、诚信、友善，积极培育社会主义核心价值观&rdquo;。</font></div>\r\n<div align=\"left\">\r\n	<font size=\"4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 价值观是人们心中的深层信念，是判断是非的标准，是行动遵循的准则。一个国家和社会是否拥有广泛认同的核心价值观，直接影响到一个国家的凝聚力和影响力。十八大报告用24个字，分别从国家、社会、个人三个层面，高度概括社会主义核心价值观，清晰而凝练，不仅展现了党对社会主义核心价值观的全新认识，而且让社会公众找到核心价值观里的&ldquo;主心骨&rdquo;，为多元时代凝聚思想共识指明了方向。</font></div>\r\n<div align=\"left\">\r\n	<font size=\"4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &ldquo;共识&rdquo;产生&ldquo;合力&rdquo;，夺取中国特色社会主义新胜利，需要最大可能地引领社会思潮，凝聚社会共识。倡导富强、民主、文明、和谐，昭示中国特色社会主义伟大事业的美好前景，始终是一个鼓舞人心、振奋精神的价值理想，是一个能够凝聚起亿万人民群众智慧和力量的宏伟目标。倡导自由、平等、公正、法治，是对人民首创精神的尊重，是对人民权益的保障，更是对人民平等发展权利的维护，顺应了人民群众的呼声与需求。倡导爱国、敬业、诚信、友善，是对个人价值和个人道德的普适要求，与从古至今每个人都在追求的仁爱德义不谋而合。可以说，&ldquo;三个倡导&rdquo;顺应世情民意，最大限度地代表了社会共同理想和追求。</font></div>\r\n<div align=\"left\">\r\n	<font size=\"4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 实现&ldquo;三个倡导&rdquo;，培育社会主义核心价值观，首先需要国家层面的制度保障。如何保证自由、平等，尊重群众的创造力，如何维护社会公平正义，保障群众的基本权利，都需要相关的法规制度更加完善和执行有力。</font></div>\r\n<div align=\"left\">\r\n	<font size=\"4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 实现&ldquo;三个倡导&rdquo;，培育社会主义核心价值观，还离不开每个人从我做起，自觉践行共同的价值追求。把&ldquo;国家兴亡、匹夫有责&rdquo;化为点点滴滴爱岗奉献的行动，把诚实守信、互助友爱融入到人与人之间文明交往中，在&ldquo;春风化雨&rdquo;中弘扬真善美，呼唤中国进步发展之&ldquo;魂&rdquo;。</font></div>\r\n<div align=\"left\">\r\n	<font size=\"4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 今天，前人期待了百年的现代化之梦正在实现，对精神家园、共同理想的呼唤更加强烈。简短的24字如同一面旗帜，鲜明亮出了国家和民族的&ldquo;精气神&rdquo;。有理由相信，在这样的价值观引领下，必将凝聚起最广泛的社会力量，实现国家和民族的伟大复兴。（作者系新华社记者）</font></div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('319','1068','1','','<!--#p8_attach#-->/cms/item/2017_10/18_00/a8f2ffbbc9897422.jpg','�各省、自治区、直辖市教育厅（教委），新疆生产建设兵团教育局，有关部门（单位）教育司（局），部属各高等学校：　　为贯彻党的十七届六中全会“深化政风、行风建设，开展道德领域突出问题专项教育和治理”的精神，落实《国家中长期教育改革和发展规','14.19.97.238','113.247.22.1','1415721600','<h3>&nbsp;</h3>\r\n\r\n<div align=\"left\">各省、自治区、直辖市教育厅（教委），新疆生产建设兵团教育局，有关部门（单位）教育司（局），部属各高等学校：</div>\r\n\r\n<div align=\"left\">　　为贯彻党的十七届六中全会&ldquo;深化政风、行风建设，开展道德领域突出问题专项教育和治理&rdquo;的精神，落实《国家中长期教育改革和发展规划纲要（2010-2020年）》的要求，坚决反对不良学风，有效遏制学术不端行为，营造风清气正的育人环境和求真务实的学术氛围，教育部决定在&ldquo;十二五&rdquo;期间开展高校学风建设专项教育和治理行动，并提出如下实施意见。</div>\r\n\r\n<div align=\"left\">　　<strong>一、充分认识高校学风建设的重要性和紧迫性。</strong>学风是大学精神的集中体现，是教书育人的本质要求，是高等学校的立校之本、发展之魂。优良学风是提高教育教学质量的根本保证。能否营造一个优良学风环境，关系到高等教育的科学发展和教育事业的兴衰成败。当前，高校的学风总体上是好的。但近一个时期来，在高校教师及学生的教学与科研活动中，急功近利、浮躁浮夸、抄袭剽窃、伪造篡改、买卖论文、考试舞弊等不良现象和不端行为时有发生，严重破坏了教书育人的学术风气，也造成了极其负面的社会影响。切实加强和改进高校学风建设工作已经刻不容缓。</div>\r\n\r\n<div align=\"left\">　　<strong>二、坚持标本兼治综合治理的原则。</strong>加强高校学风建设，要坚持教育和治理相结合，坚持教育引导、制度规范、监督约束、查处警示，建立并完善弘扬优良学风的长效机制。通过专项教育治理行动，迅速建立学风建设工作体系，明确各地、各部门和高校的责任义务，力争&ldquo;十二五&rdquo;期间高校学风和科研诚信整体状况得到明显改观，为保证人才培养质量、提升科学研究水平、增强社会服务能力奠定良好的学风基础。</div>\r\n\r\n<div align=\"left\">　　<strong>三、构建学风建设工作体系。</strong>教育部设立学风建设办公室，负责制定高校学风建设相关政策，指导检查高校学风建设工作，接受对学术不端行为的举报，指导协调和督促调查处理。各地、各部门要健全学风建设机构，负责所属高校学风建设工作。各高校要建立相应的工作机构和工作机制，负责本校学风建设工作和学术不端行为查处。</div>\r\n\r\n<div align=\"left\">　　<strong>四、强化高校的主体责任。</strong>高校主要领导是本校学风建设和学术不端行为查处的第一责任人，应有专门领导分工负责学风建设。各地教育部门要将学风建设纳入高校领导班子的考核，完善目标责任制，落实问责机制。高校要将学风建设工作常规化，摆在更加突出的位置，建立健全教育宣传，制度建设、不端行为查处等完整的工作体系，实现学风建设机构、学术规范制度和不端行为查处机制三落实、三公开。高校要按年度发布学风建设工作报告。</div>\r\n\r\n<div align=\"left\">　　<strong>五、建立学术规范教育制度。</strong>坚持把教育作为加强学风和学术道德建设的基础。在师生中加强科学精神教育，注重发挥楷模的教育作用，强调学者的自律意识和自我道德养成。教育部和中国科协共同组织对全国研究生的科学道德和学风建设宣讲教育。教育部科技委组织专家赴各地讲解《科学技术学术规范指南》。各地教育部门要组织实施本地区的宣讲教育。高校要为本专科生开设科学伦理讲座，在研究生中进行学术规范宣讲教育；要把科学道德教育纳入教师岗位培训范畴和职业培训体系，纳入行政管理人员学习范畴。</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('325','1078','1','','<!--#p8_attach#-->/cms/item/2017_10/18_00/ca6fb08679f0adce.jpg','历经35年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼“两个一百年”目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的','112.124.52.149','113.247.22.1','1431792000','<p align=\"left\" style=\"margin: 7.5pt 0cm; line-height: 22.5pt; text-indent: 24pt\"><span style=\"font-size: 16pt\"><span style=\"color: #26214a\"><span style=\"font-family: 仿宋_gb2312\">历经35</span>年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼&ldquo;两个一百年&rdquo;目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的历史起点上改革&ldquo;集结号&rdquo;。</span></span></p>\r\n\r\n<p align=\"left\" style=\"margin: 7.5pt 0cm; line-height: 22.5pt; text-indent: 24pt\"><span style=\"font-size: 16pt\"><span style=\"color: #26214a\"><span style=\"font-family: 仿宋_gb2312\">历史是最好的教科书，深刻揭示出一个国家、一个民族的进步发展之道。35</span>年来，从国民经济的快速增长，到人民生活水平的显著改善，从经济体制的深刻变革，到国家和人民面貌的深刻变化，莫不靠的是改革开放。今天，破解发展中面临的难题、化解来自各方面的风险挑战、推动经济社会持续健康发展，除了深化改革开放，别无他途。全面深化改革，关系党和人民事业前途命运，关系党的执政基础和执政地位，在整个社会主义现代化进程中，改革开放的旗帜，绝不能有丝毫动摇。</span></span></p>\r\n\r\n<p align=\"left\" style=\"margin: 7.5pt 0cm; line-height: 22.5pt; text-indent: 24pt\"><span style=\"font-size: 16pt\"><span style=\"color: #26214a\"><span style=\"font-family: 仿宋_gb2312\">这次三中全会制定全面深化改革的总体方案，提出了全面深化改革的指导思想、总体思路、目标任务，为的就是高举改革开放旗帜、不断推进中国特色社会主义制度自我完善和发展，为实现亿万人民的中国梦释放强大动力。这是指导新形势下全面深化改革的纲领性文件。当前和今后一个时期，全党全国的一项重要政治任务，就是要以强烈的进取意识、机遇意识、责任意识，深刻领会全会精神并转化成改造现实世界的强大力量。</span></span></span></p>\r\n\r\n<p align=\"left\" style=\"margin: 7.5pt 0cm; line-height: 22.5pt; text-indent: 24pt\"><span style=\"font-size: 16pt\"><span style=\"color: #26214a\"><span style=\"font-family: 仿宋_gb2312\">在35</span>年的改革历程中，我们谱写的中华民族自强不息、顽强奋进的壮丽史诗，靠的是一往无前的进取精神。今天，改革面临的矛盾越多、难度越大，越要坚定与时俱进、攻坚克难信心，越要有进取意识、进取精神、进取毅力，越要有&ldquo;明知山有虎，偏向虎山行&rdquo;的勇气。纵观世界，变革是大势所趋、人心所向。领导改革开放这一前无古人、世所罕见的伟大事业，最要不得的是思想僵化、固步自封。&ldquo;逆水行舟用力撑，一篙松劲退千寻&rdquo;。以习近平同志为总书记的党中央，作出了全面深化改革的战略部署，牢固树立进取意识，全面审视当今世界和当代中国发展大势，全面把握我国发展新要求和人民群众新期待，更加奋发有为地开拓进取，我们就一定能够坚定不移把改革开放引向深入。</span></span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('326','1079','1','','<!--#p8_attach#-->/cms/item/2015_05/23_08/def29b9c7dd0d591.jpg','市发展改革委对部分市属高校三年规划建设项目开展专项稽察。为了加强对我市重点建设项目稽察监管，市发展改革委近日对北方工业大学、首都师范大学和北京第二外国语学院3所院校的6个建设项目开展了专项稽察，重点对项目进度情况、资金到位及使用情况；履行基本建设程序、','112.124.52.149','113.96.85.241','1431792000','市发展改革委对部分市属高校三年规划建设项目开展专项稽察。为了加强对我市重点建设项目稽察监管，市发展改革委近日对北方工业大学、首都师范大学和北京第二外国语学院3所院校的6个建设项目开展了专项稽察，重点对项目进度情况、资金到位及使用情况；履行基本建设程序、&ldquo;四制&rdquo;执行、概算执行、质量管理以及财务管理等情况进行了检查。稽察情况显示，这6个项目建设管理总体比较规范，基本建设程序履行比较完整，合同制、监理制落实较好，招投标过程比较规范，资金使用基本合规，未发现严重资金违规问题，实际建设内容与规模与批复基本一致，项目建设进度较快。针对稽察中发现的一些问题，市发展改革委将督促建设单位加强整改。');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('330','1082','1','','<!--#p8_attach#-->/cms/item/2014_08/30_21/fa206fa3582f2338.jpg','2012年7月10日，廖祥忠副校长赴清华大学、北京师范大学开展科研专项调研，文科科研处处长胡智锋等陪同调研，标志着我校人文社会科学专项系列调研活动正式启动。牋? 为贯彻落实《教育部关于推进高等学','116.22.165.89','113.96.84.61','1432396800','<div class=\"content_main\">\r\n<p>2012年7月10日，廖祥忠副校长赴清华大学、北京师范大学开展科研专项调研，文科科研处处长胡智锋等陪同调研，标志着我校人文社会科学专项系列调研活动正式启动。</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp; 为贯彻落实《教育部关于推进高等学校哲学社会科学繁荣发展的意见》、《高等学校哲学社会科学繁荣计划（2011&mdash;2020年）》、《中共中国传媒大学委员会关于深入推进哲学社会科学繁荣发展的意见》等文件精神，推动协同创新及我校哲学社会科学的全面发展，文科科研处启动了人文社会科学专项系列调研活动，旨在学习北京各高校的人文社科管理经验，推动我校文科科研管理机制创新，全面提升我校人文社科科研管理水平和文科科研质量，制定人文社科科学管理的长远规划。</p>\r\n\r\n<p align=\"center\"><img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25387&amp;filename=p1052_1341991110442.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp; 在清华大学，调研团队与清华大学主管文科科研管理的领导、专家进行了深入座谈。清华大学党委副书记邓卫向调研团队介绍了清华大学恢复重建文科30年来的科研管理概况，着重介绍了文科分类管理、建立文科科研评价与衡量体系、以及如何贯彻国家&ldquo;十二五&rdquo;规划和教育部、财政部&ldquo;协同创新&rdquo;等文件精神的举措。清华大学文科建设处副处长仲伟民、科研机构管理办公室主任甄树宁等介绍了清华大学文科科研管理的经验与细则，并着重介绍了主管科研的科研院与文科建设处的机构设置、对学校科研机构的认定与评估、科研信息管理系统等方面的做法与经验。</p>\r\n\r\n<p align=\"center\"><img alt=\"\" src=\"http://news.cuc.edu.cn/img?artid=25387&amp;filename=p1052_1341991123180.jpg\" /></p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp; 在北京师范大学，北京师范大学党委副书记田辉、社科处处长刘复兴、副处长田晓刚等向调研团队详细介绍了该校在人文社科项目、经费、成果管理与奖励机制等方面的经验。双方还就各自在人文社科管理方面面临的问题及未来的发展进行了深入探讨与交流。</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp; 此次调研加强了我校与兄弟高校科研管理机构的沟通与联系，有助于我校深入了解兄弟高校在人文社科方面的管理经验，开阔视野，对于我校人文社科科研的项目管理、经费管理、成果认定、奖励制定等相关管理制度的改进与提升具有重要的意义。</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp; 此次北京高校调研考察是文科科研处专项系列调研活动的第一站，调研团队随后将陆续赴外地高校深入开展调研，于今年年底形成调研报告，为形成富有我校特色的人文社会科学科研管理体制提供经验借鉴。</p>\r\n\r\n<p align=\"right\">(文：曾祥敏 编辑：王维家)&nbsp;</p>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('378','1133','1','','<!--#p8_attach#-->/cms/item/2017_10/18_00/ca6fb08679f0adce.jpg','网站首页实施教程[2016-02-14]标签操作教程[2016-01-28]06--标签选择与使用的教程[2016-01-28]一键导入标签数据教程[2015-04-05]栏目的模板和标签样式[2015-04-05]如何进入到“显示标签”状','60.10.58.48','113.247.22.1','1456848000','<ul class=\"label_ul_b\" style=\"list-style-type: none; font-size: 14px; overflow: hidden; font-family: \'Microsoft YaHei\', 微软雅黑, tahoma, arial, simsun, 宋体; word-break: break-all; color: rgb(69,69,69); padding-bottom: 0px; padding-top: 0px; padding-left: 0px; margin: 0px; line-height: 25px; padding-right: 0px; background-color: rgb(248,248,248)\">\r\n	<li style=\"list-style-type: none; word-break: break-all; padding-bottom: 0px; padding-top: 0px; padding-left: 0px; margin: 0px; padding-right: 0px\"><a href=\"http://www.php168.net/index.php/cms/item-view-id-1306.shtml\" style=\"text-decoration: none; word-break: break-all; color: rgb(51,51,51)\" target=\"_blank\" title=\"网站首页实施教程\">网站首页实施教程</a></li>\r\n	<li style=\"list-style-type: none; word-break: break-all; padding-bottom: 0px; padding-top: 0px; padding-left: 0px; margin: 0px; padding-right: 0px\"><span class=\"label_datatime\" style=\"font-size: 12px; word-break: break-all; float: right; color: rgb(101,102,104)\">[2016-02-14]</span>&middot;<a href=\"http://www.php168.net/index.php/cms/item-view-id-1305.shtml\" style=\"text-decoration: none; word-break: break-all; color: rgb(51,51,51)\" target=\"_blank\" title=\"标签操作教程\">标签操作教程</a></li>\r\n	<li style=\"list-style-type: none; word-break: break-all; padding-bottom: 0px; padding-top: 0px; padding-left: 0px; margin: 0px; padding-right: 0px\"><span class=\"label_datatime\" style=\"font-size: 12px; word-break: break-all; float: right; color: rgb(101,102,104)\">[2016-01-28]</span>&middot;<a href=\"http://www.php168.net/index.php/cms/item-view-id-1188.shtml\" style=\"text-decoration: none; word-break: break-all; color: rgb(51,51,51)\" target=\"_blank\" title=\"06--标签选择与使用的教程\">06--标签选择与使用的教程</a></li>\r\n	<li style=\"list-style-type: none; word-break: break-all; padding-bottom: 0px; padding-top: 0px; padding-left: 0px; margin: 0px; padding-right: 0px\"><span class=\"label_datatime\" style=\"font-size: 12px; word-break: break-all; float: right; color: rgb(101,102,104)\">[2016-01-28]</span>&middot;<a href=\"http://www.php168.net/index.php/cms/item-view-id-1203.shtml\" style=\"text-decoration: none; word-break: break-all; color: rgb(51,51,51)\" target=\"_blank\" title=\"一键导入标签数据教程\">一键导入标签数据教程</a></li>\r\n	<li style=\"list-style-type: none; word-break: break-all; padding-bottom: 0px; padding-top: 0px; padding-left: 0px; margin: 0px; padding-right: 0px\"><span class=\"label_datatime\" style=\"font-size: 12px; word-break: break-all; float: right; color: rgb(101,102,104)\">[2015-04-05]</span>&middot;<a href=\"http://www.php168.net/index.php/cms/item-view-id-1094.shtml\" style=\"text-decoration: none; word-break: break-all; color: rgb(51,51,51)\" target=\"_blank\" title=\"栏目的模板和标签样式\">栏目的模板和标签样式</a></li>\r\n	<li class=\"label_dashed\" style=\"list-style-type: none; font-size: 0px; height: 1px; border-bottom: rgb(204,204,204) 1px dashed; word-break: break-all; padding-bottom: 0px; padding-top: 0px; padding-left: 0px; margin: 5px 0px; line-height: 1px; padding-right: 0px\">&nbsp;</li>\r\n	<li style=\"list-style-type: none; word-break: break-all; padding-bottom: 0px; padding-top: 0px; padding-left: 0px; margin: 0px; padding-right: 0px\"><span class=\"label_datatime\" style=\"font-size: 12px; word-break: break-all; float: right; color: rgb(101,102,104)\">[2015-04-05]</span>&middot;<a href=\"http://www.php168.net/index.php/cms/item-view-id-1084.shtml\" style=\"text-decoration: none; word-break: break-all; color: rgb(51,51,51)\" target=\"_blank\" title=\"如何进入到“显示标签”状态\">如何进入到&ldquo;显示标签&rdquo;状态</a></li>\r\n</ul>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('379','1133','2','','','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','219.148.91.220','219.148.91.220','1456880503','<p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>\r\n\r\n<p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>\r\n\r\n<p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>\r\n\r\n<p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>\r\n\r\n<p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>\r\n\r\n<p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>\r\n\r\n<p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>\r\n\r\n<p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>\r\n\r\n<p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>\r\n\r\n<p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>\r\n\r\n<p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('380','1134','1','','<!--#p8_attach#-->/cms/item/2014_09/01_17/385cdb5e20e4ed8e.jpg','为贯彻党的十七届六中全会“深化政风、行风建设，开展道德领域突出问题专项教育和治理”的精神，落实《国家中长期教育改革和发展规划纲要（2010-2020年）》的要求','175.13.250.244','175.13.249.72','1458230400','<h3>&nbsp;</h3>\r\n\r\n<div align=\"left\">各省、自治区、直辖市教育厅（教委），新疆生产建设兵团教育局，有关部门（单位）教育司（局），部属各高等学校：</div>\r\n\r\n<div align=\"left\">　　为贯彻党的十七届六中全会&ldquo;深化政风、行风建设，开展道德领域突出问题专项教育和治理&rdquo;的精神，落实《国家中长期教育改革和发展规划纲要（2010-2020年）》的要求，坚决反对不良学风，有效遏制学术不端行为，营造风清气正的育人环境和求真务实的学术氛围，教育部决定在&ldquo;十二五&rdquo;期间开展高校学风建设专项教育和治理行动，并提出如下实施意见。</div>\r\n\r\n<div align=\"left\">　　<strong>一、充分认识高校学风建设的重要性和紧迫性。</strong>学风是大学精神的集中体现，是教书育人的本质要求，是高等学校的立校之本、发展之魂。优良学风是提高教育教学质量的根本保证。能否营造一个优良学风环境，关系到高等教育的科学发展和教育事业的兴衰成败。当前，高校的学风总体上是好的。但近一个时期来，在高校教师及学生的教学与科研活动中，急功近利、浮躁浮夸、抄袭剽窃、伪造篡改、买卖论文、考试舞弊等不良现象和不端行为时有发生，严重破坏了教书育人的学术风气，也造成了极其负面的社会影响。切实加强和改进高校学风建设工作已经刻不容缓。</div>\r\n\r\n<div align=\"left\">　　<strong>二、坚持标本兼治综合治理的原则。</strong>加强高校学风建设，要坚持教育和治理相结合，坚持教育引导、制度规范、监督约束、查处警示，建立并完善弘扬优良学风的长效机制。通过专项教育治理行动，迅速建立学风建设工作体系，明确各地、各部门和高校的责任义务，力争&ldquo;十二五&rdquo;期间高校学风和科研诚信整体状况得到明显改观，为保证人才培养质量、提升科学研究水平、增强社会服务能力奠定良好的学风基础。</div>\r\n\r\n<div align=\"left\">　　<strong>三、构建学风建设工作体系。</strong>教育部设立学风建设办公室，负责制定高校学风建设相关政策，指导检查高校学风建设工作，接受对学术不端行为的举报，指导协调和督促调查处理。各地、各部门要健全学风建设机构，负责所属高校学风建设工作。各高校要建立相应的工作机构和工作机制，负责本校学风建设工作和学术不端行为查处。</div>\r\n\r\n<div align=\"left\">　　<strong>四、强化高校的主体责任。</strong>高校主要领导是本校学风建设和学术不端行为查处的第一责任人，应有专门领导分工负责学风建设。各地教育部门要将学风建设纳入高校领导班子的考核，完善目标责任制，落实问责机制。高校要将学风建设工作常规化，摆在更加突出的位置，建立健全教育宣传，制度建设、不端行为查处等完整的工作体系，实现学风建设机构、学术规范制度和不端行为查处机制三落实、三公开。高校要按年度发布学风建设工作报告。</div>\r\n\r\n<div align=\"left\">　　<strong>五、建立学术规范教育制度。</strong>坚持把教育作为加强学风和学术道德建设的基础。在师生中加强科学精神教育，注重发挥楷模的教育作用，强调学者的自律意识和自我道德养成。教育部和中国科协共同组织对全国研究生的科学道德和学风建设宣讲教育。教育部科技委组织专家赴各地讲解《科学技术学术规范指南》。各地教育部门要组织实施本地区的宣讲教育。高校要为本专科生开设科学伦理讲座，在研究生中进行学术规范宣讲教育；要把科学道德教育纳入教师岗位培训范畴和职业培训体系，纳入行政管理人员学习范畴。</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('381','1135','1','','<!--#p8_attach#-->/cms/item/2012_09/02_02/ed06de3b55b12af0.jpg','历经35年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼“两个一百年”目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的','175.13.250.244','175.13.250.244','1458230400','<p align=\"left\" style=\"margin: 7.5pt 0cm; line-height: 22.5pt; text-indent: 24pt\"><span style=\"font-size: 16pt\"><span style=\"color: #26214a\"><span style=\"font-family: 仿宋_gb2312\">历经35</span>年波澜壮阔的改革开放历程，跻身世界第二大经济体的当代中国，迎来新一轮改革的壮丽征程。党的十八届三中全会着眼&ldquo;两个一百年&rdquo;目标的战略全局，审议通过了《中共中央关于全面深化改革若干重大问题的决定》，为全面深化改革指明了前进方向，吹响了新的历史起点上改革&ldquo;集结号&rdquo;。</span></span></p>\r\n\r\n<p align=\"left\" style=\"margin: 7.5pt 0cm; line-height: 22.5pt; text-indent: 24pt\"><span style=\"font-size: 16pt\"><span style=\"color: #26214a\"><span style=\"font-family: 仿宋_gb2312\">历史是最好的教科书，深刻揭示出一个国家、一个民族的进步发展之道。35</span>年来，从国民经济的快速增长，到人民生活水平的显著改善，从经济体制的深刻变革，到国家和人民面貌的深刻变化，莫不靠的是改革开放。今天，破解发展中面临的难题、化解来自各方面的风险挑战、推动经济社会持续健康发展，除了深化改革开放，别无他途。全面深化改革，关系党和人民事业前途命运，关系党的执政基础和执政地位，在整个社会主义现代化进程中，改革开放的旗帜，绝不能有丝毫动摇。</span></span></p>\r\n\r\n<p align=\"left\" style=\"margin: 7.5pt 0cm; line-height: 22.5pt; text-indent: 24pt\"><span style=\"font-size: 16pt\"><span style=\"color: #26214a\"><span style=\"font-family: 仿宋_gb2312\">这次三中全会制定全面深化改革的总体方案，提出了全面深化改革的指导思想、总体思路、目标任务，为的就是高举改革开放旗帜、不断推进中国特色社会主义制度自我完善和发展，为实现亿万人民的中国梦释放强大动力。这是指导新形势下全面深化改革的纲领性文件。当前和今后一个时期，全党全国的一项重要政治任务，就是要以强烈的进取意识、机遇意识、责任意识，深刻领会全会精神并转化成改造现实世界的强大力量。</span></span></span></p>\r\n\r\n<p align=\"left\" style=\"margin: 7.5pt 0cm; line-height: 22.5pt; text-indent: 24pt\"><span style=\"font-size: 16pt\"><span style=\"color: #26214a\"><span style=\"font-family: 仿宋_gb2312\">在35</span>年的改革历程中，我们谱写的中华民族自强不息、顽强奋进的壮丽史诗，靠的是一往无前的进取精神。今天，改革面临的矛盾越多、难度越大，越要坚定与时俱进、攻坚克难信心，越要有进取意识、进取精神、进取毅力，越要有&ldquo;明知山有虎，偏向虎山行&rdquo;的勇气。纵观世界，变革是大势所趋、人心所向。领导改革开放这一前无古人、世所罕见的伟大事业，最要不得的是思想僵化、固步自封。&ldquo;逆水行舟用力撑，一篙松劲退千寻&rdquo;。以习近平同志为总书记的党中央，作出了全面深化改革的战略部署，牢固树立进取意识，全面审视当今世界和当代中国发展大势，全面把握我国发展新要求和人民群众新期待，更加奋发有为地开拓进取，我们就一定能够坚定不移把改革开放引向深入。</span></span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('386','1140','1','','<!--#p8_attach#-->/cms/item/2015_05/23_08/2491223fbece3b6d.jpg','“新型城镇化”现已成为一个全民议题。如何走新型城镇化道路，需要全社会尤其是“规划师”的探索与创新。作为担当城乡规划重任的“青年规划师”的思考及探索，将为中国新型城镇化实践提供新的思路。　　17日，以“新型城镇化与城乡规','175.13.250.244','113.247.22.1','1458230400','<p><span style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); orphans: 2; widows: 2; line-height: 25px\">&ldquo;新型城镇化&rdquo;现已成为一个全民议题。如何走新型城镇化道路，需要全社会尤其是&ldquo;规划师&rdquo;的探索与创新。作为担当城乡规划重任的&ldquo;青年规划师&rdquo;的思考及探索，将为中国新型城镇化实践提供新的思路。</span><br style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); padding-bottom: 0px; padding-top: 0px; padding-left: 0px; orphans: 2; widows: 2; margin: 0px; line-height: 25px; padding-right: 0px\" />\r\n&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style=\"text-align: center\"><object classid=\"clsid:22d6f312-b0f6-11d0-94ab-0080c74c7e95\" codebase=\"http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701\" data=\"http://player.video.qiyi.com/9996d213bdd29ff319bfa2fe34ef8d78/0/0/w_19rssjclhh.swf-albumId=6021725609-tvId=6021725609-isPurchase=0-cnId=21\" height=\"492\" width=\"865\"><param name=\"allowFullScreen\" value=\"true\" /><param name=\"loop\" value=\"true\" /><param name=\"play\" value=\"true\" /><param name=\"menu\" value=\"true\" /><param name=\"quality\" value=\"high\" /><param name=\"flashvars\" value=\"winType=interior\" /><param name=\"movie\" value=\"http://player.video.qiyi.com/9996d213bdd29ff319bfa2fe34ef8d78/0/0/w_19rssjclhh.swf-albumId=6021725609-tvId=6021725609-isPurchase=0-cnId=21\" /><embed allowfullscreen=\"true\" flashvars=\"winType=interior\" height=\"492\" loop=\"true\" menu=\"true\" play=\"true\" pluginspage=\"http://www.microsoft.com/windows/mediaplayer/download/default.asp\" quality=\"high\" src=\"http://player.video.qiyi.com/9996d213bdd29ff319bfa2fe34ef8d78/0/0/w_19rssjclhh.swf-albumId=6021725609-tvId=6021725609-isPurchase=0-cnId=21\" type=\"application/x-mplayer2\" width=\"865\"></embed></object></p>\r\n\r\n<p><br style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); padding-bottom: 0px; padding-top: 0px; padding-left: 0px; orphans: 2; widows: 2; margin: 0px; line-height: 25px; padding-right: 0px\" />\r\n<span style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); orphans: 2; widows: 2; line-height: 25px\">　　17日，以&ldquo;新型城镇化与城乡规划编制创新&rdquo;为主题的&ldquo;第三届金经昌中国青年规划师创新论坛&rdquo;在上海举行。近期，北京启动总体规划调整和修改，上海启动新一轮城市总体规划编制，在此背景下，本次论坛聚焦&ldquo;大都市地区总体规划编制创新&rdquo;这一热点，展开研讨。</span><br style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); padding-bottom: 0px; padding-top: 0px; padding-left: 0px; orphans: 2; widows: 2; margin: 0px; line-height: 25px; padding-right: 0px\" />\r\n<br style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); padding-bottom: 0px; padding-top: 0px; padding-left: 0px; orphans: 2; widows: 2; margin: 0px; line-height: 25px; padding-right: 0px\" />\r\n<span style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); orphans: 2; widows: 2; line-height: 25px\">　　自2007年开始，全世界一半以上的人口生活在城市，世界正式进入了&ldquo;城市纪元&rdquo;，城市成为了全球人关注的重点；而预计到2040年，全球将有64.7%的人生活在城市中。城市已经成为最不了不起的成就。但城市发展中又面临种种问题。</span><br style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); padding-bottom: 0px; padding-top: 0px; padding-left: 0px; orphans: 2; widows: 2; margin: 0px; line-height: 25px; padding-right: 0px\" />\r\n<br style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); padding-bottom: 0px; padding-top: 0px; padding-left: 0px; orphans: 2; widows: 2; margin: 0px; line-height: 25px; padding-right: 0px\" />\r\n<span style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); orphans: 2; widows: 2; line-height: 25px\">　　中国城市规划设计研究院总规划师张兵在论坛上作了题为《场所&middot;结构&middot;治理&mdash;大都市地区空间发展与总体规划》的报告。他说，大都市地区新一轮总体规划编制工作出现了一些新特点，包括开展前期评估、公众参与、以人为本、从重规模转向重结构、强调生态文明建设和文化传承等，这反映了规划工作者在改进规划方面所作的努力，但这些改进还无法真正解决大都市区历史性转变中面临着的现实需要。</span><br style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); padding-bottom: 0px; padding-top: 0px; padding-left: 0px; orphans: 2; widows: 2; margin: 0px; line-height: 25px; padding-right: 0px\" />\r\n<br style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); padding-bottom: 0px; padding-top: 0px; padding-left: 0px; orphans: 2; widows: 2; margin: 0px; line-height: 25px; padding-right: 0px\" />\r\n<span style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); orphans: 2; widows: 2; line-height: 25px\">　　张兵强调，应该通过出行等人的行为来认识都市区内部发育状况，为规划重点问题解决提供认识基础，在此基础上，他指出大都市区总规改进的三个方向：结构塑形、设施引领场所再组织和改革空间治理体系。</span><br style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); padding-bottom: 0px; padding-top: 0px; padding-left: 0px; orphans: 2; widows: 2; margin: 0px; line-height: 25px; padding-right: 0px\" />\r\n<br style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); padding-bottom: 0px; padding-top: 0px; padding-left: 0px; orphans: 2; widows: 2; margin: 0px; line-height: 25px; padding-right: 0px\" />\r\n<span style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); orphans: 2; widows: 2; line-height: 25px\">　　当前，生态与可持续发展已成为城市发展的目标，上海也在这方面紧随世界的步伐。上海提出以节能减排先进城市系统为其建设的基本目标。同时在具体区域，如建设崇明生态岛、真如城市副中心、崇明陈桥镇生态城镇、长风商务区等，以此在城市开发中注重生态发展。</span><br style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); padding-bottom: 0px; padding-top: 0px; padding-left: 0px; orphans: 2; widows: 2; margin: 0px; line-height: 25px; padding-right: 0px\" />\r\n<br style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); padding-bottom: 0px; padding-top: 0px; padding-left: 0px; orphans: 2; widows: 2; margin: 0px; line-height: 25px; padding-right: 0px\" />\r\n<span style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); orphans: 2; widows: 2; line-height: 25px\">　　上海市规划与国土资源局副局长徐毅松介绍了刚刚启动的上海新一轮总体规划编制工作思路，生态环境颇为引人关注。</span><br style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); padding-bottom: 0px; padding-top: 0px; padding-left: 0px; orphans: 2; widows: 2; margin: 0px; line-height: 25px; padding-right: 0px\" />\r\n<br style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); padding-bottom: 0px; padding-top: 0px; padding-left: 0px; orphans: 2; widows: 2; margin: 0px; line-height: 25px; padding-right: 0px\" />\r\n<span style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); orphans: 2; widows: 2; line-height: 25px\">　　值得关注的是，尽管从上世纪90年代起，全世界都热衷将生态作为一种标签，但往往流于表面形式，世界各地也依次出现了一些不同类型的生态城市试验，例如荷兰的太阳城、斯德哥尔摩哈马尔比滨水城、上海的崇明东滩生态城等。</span><br style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); padding-bottom: 0px; padding-top: 0px; padding-left: 0px; orphans: 2; widows: 2; margin: 0px; line-height: 25px; padding-right: 0px\" />\r\n<br style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); padding-bottom: 0px; padding-top: 0px; padding-left: 0px; orphans: 2; widows: 2; margin: 0px; line-height: 25px; padding-right: 0px\" />\r\n<span style=\"font-size: 14px; font-family: 宋体, Verdana, Arial, Tahoma; color: rgb(51,51,51); orphans: 2; widows: 2; line-height: 25px\">　　城市规划到底走向何方？可能如中科院院士、同济大学郑时龄教授当天在当天举行的上海科普大讲坛上所言，&ldquo;我们按照自己的文化和理想建设我们的城市，理想、想象和幻想越是丰富，我们的城市也就越理想&rdquo;。</span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('387','1141','1','','<!--#p8_attach#-->/cms/item/2015_05/23_08/6bda83cf89e6cf65.jpg','市发展改革委对部分市属高校三年规划建设项目开展专项稽察。为了加强对我市重点建设项目稽察监管，市发展改革委近日对北方工业大学、首都师范大学和北京第二外国语学院3所院校的6个建设项目开展了专项稽察，重点对项目进度情况、资金到位及使用情况；履行基本建设程序、','175.13.250.244','175.13.250.244','1458230400','<p><span style=\"font-size: 14px; font-family: 宋体, Arial; color: rgb(27,27,27); line-height: 28px; background-color: rgb(250,250,250)\">市发展改革委对部分市属高校三年规划建设项目开展专项稽察。为了加强对我市重点建设项目稽察监管，市发展改革委近日对北方工业大学、首都师范大学和北京第二外国语学院3所院校的6个建设项目开展了专项稽察，重点对项目进度情况、资金到位及使用情况；履行基本建设程序、&ldquo;四制&rdquo;执行、概算执行、质量管理以及财务管理等情况进行了检查。稽察情况显示，这6个项目建设管理总体比较规范，基本建设程序履行比较完整，合同制、监理制落实较好，招投标过程比较规范，资金使用基本合规，未发现严重资金违规问题，实际建设内容与规模与批复基本一致，项目建设进度较快。针对稽察中发现的一些问题，市发展改革委将督促建设单位加强整改。</span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('388','1142','1','','<!--#p8_attach#-->/cms/item/2016_04/14_11/c113d763ea07ba44.jpg.thumb.jpg','3月23日至24日，集团公司董事长、党组书记陈进行应邀出席2016年博鳌亚洲论坛。年会召开期间，陈进行参加了&amp;amp;ldquo;B20：全球经济治理中的商界声音与诉求&amp;amp;rdquo;专题研讨会，并作为基础设施组企业家代表发言。发言中，陈进行阐述了五点建议：一是建设低碳绿色环保高效的能','175.13.255.10','175.13.255.10','1460605199','&nbsp;\r\n<p style=\"border-left-width: 0px; list-style-type: none; text-decoration: none; border-right-width: 0px; white-space: normal; border-bottom-width: 0px; word-spacing: 0px; text-transform: none; word-break: normal; color: rgb(85,85,85); padding-bottom: 0px; text-align: justify; padding-top: 0px; font: 14px/25px \'microsoft Yahei\'; padding-left: 0px; margin: 0px 0px 20px; widows: 1; letter-spacing: normal; padding-right: 0px; border-top-width: 0px; background-color: rgb(255,255,255); text-indent: 2em; -webkit-text-stroke-width: 0px\">3月23日至24日，集团公司董事长、党组书记陈进行应邀出席2016年博鳌亚洲论坛。年会召开期间，陈进行参加了&ldquo;B20：全球经济治理中的商界声音与诉求&rdquo;专题研讨会，并作为基础设施组企业家代表发言。</p>\r\n\r\n<p style=\"border-left-width: 0px; list-style-type: none; text-decoration: none; border-right-width: 0px; white-space: normal; border-bottom-width: 0px; word-spacing: 0px; text-transform: none; word-break: normal; color: rgb(85,85,85); padding-bottom: 0px; text-align: justify; padding-top: 0px; font: 14px/25px \'microsoft Yahei\'; padding-left: 0px; margin: 0px 0px 20px; widows: 1; letter-spacing: normal; padding-right: 0px; border-top-width: 0px; background-color: rgb(255,255,255); text-indent: 2em; -webkit-text-stroke-width: 0px\">发言中，陈进行阐述了五点建议：一是建设低碳绿色环保高效的能源基础设施；二是构建一个现代化能源网络；三是建设清洁高效的电力系统；四是积极推进智慧能源系统建设；五是加快推进能源基础设施国际合作。陈进行的发言得到与会嘉宾和代表的高度认同。</p>\r\n\r\n<p style=\"border-left-width: 0px; list-style-type: none; text-decoration: none; border-right-width: 0px; white-space: normal; border-bottom-width: 0px; word-spacing: 0px; text-transform: none; word-break: normal; color: rgb(85,85,85); padding-bottom: 0px; text-align: justify; padding-top: 0px; font: 14px/25px \'microsoft Yahei\'; padding-left: 0px; margin: 0px 0px 20px; widows: 1; letter-spacing: normal; padding-right: 0px; border-top-width: 0px; background-color: rgb(255,255,255); text-indent: 2em; -webkit-text-stroke-width: 0px\">中国商务部副部长王受文和印度尼西亚贸易部长托马斯.林博应邀出席研讨会，就B20与G20的相互关系、贸易与投资等相关议题进行了阐述，并听取了工商界的意见和建议。</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('389','1143','1','','<!--#p8_attach#-->/cms/item/2016_05/12_10/97e2e2bacae3ab08.jpg','3月23日，集团公司副董事长、总经理、党组副书记王野平应邀出席2016年中国广州国际投资年会全体大会。本届年会的主题是“动力源　增长极——国家中心城市与三大战略枢纽建设”，年会设立了18个专题分论坛，来自海内外投资及产业界的近1600名高端人士','175.13.255.10','175.13.253.123','1460563200','<p px=\"\" style=\"border-left-width: 0px; font-size: 14px; border-right-width: 0px; font-variant: normal; border-bottom-width: 0px; font-weight: normal; font-style: normal; line-height: 25px; border-top-width: 0px\">3月23日，集团公司副董事长、总经理、党组副书记王野平应邀出席2016年中国广州国际投资年会全体大会。</p>\r\n\r\n<p px=\"\" style=\"border-left-width: 0px; font-size: 14px; border-right-width: 0px; font-variant: normal; border-bottom-width: 0px; font-weight: normal; font-style: normal; line-height: 25px; border-top-width: 0px\">本届年会的主题是&ldquo;动力源　增长极&mdash;&mdash;国家中心城市与三大战略枢纽建设&rdquo;，年会设立了18个专题分论坛，来自海内外投资及产业界的近1600名高端人士赴会。</p>\r\n\r\n<p px=\"\" style=\"border-left-width: 0px; font-size: 14px; border-right-width: 0px; font-variant: normal; border-bottom-width: 0px; font-weight: normal; font-style: normal; line-height: 25px; border-top-width: 0px\">年会期间，王野平分别会见了广东省委常委、常务副省长徐少华，广东省委常委、广州市委书记任学锋。</p>\r\n\r\n<p px=\"\" style=\"border-left-width: 0px; font-size: 14px; border-right-width: 0px; font-variant: normal; border-bottom-width: 0px; font-weight: normal; font-style: normal; line-height: 25px; border-top-width: 0px\">在会见徐少华时，王野平简要介绍了广东省政府与大唐集团&ldquo;十二五&rdquo;期间签订的《战略合作框架协议》的完成情况，并介绍了大唐集团&ldquo;十三五&rdquo;发展规划思路及当前在广东省的项目生产运营和投资建设情况。王野平表示，大唐集团认真贯彻十八届五中全会精神和国家电力体制机制改革要求，坚决履行央企职责，以转方式为主线，以调结构为主攻方向，以科技进步为引领，优化产业布局，加快推动在广东省优质项目的开发。希望广东省政府继续关心和支持大唐在粤项目建设，为加快推进佛山高明项目、阳西核电项目、南澳海上风电项目给予政策支持，实现双方共赢发展。</p>\r\n\r\n<p px=\"\" style=\"border-left-width: 0px; font-size: 14px; border-right-width: 0px; font-variant: normal; border-bottom-width: 0px; font-weight: normal; font-style: normal; line-height: 25px; border-top-width: 0px\">徐少华在交谈时介绍了广东省当前的经济发展趋势及&ldquo;十三五&rdquo;期间能源规划发展思路，针对供给侧改革对发电市场的影响、西电东输电量与广东地区电量的配置、大用户直供与上网电价调整等相关问题进行了探讨。他表示，广东省政府欢迎大唐集团等有实力、技术强、重诚信的中央企业在粤投资建设，将一如既往地为大唐在粤项目发展提供政策支持和市场服务。希望大唐集团抓好与省政府签订的《&ldquo;十三五&rdquo;战略合作协议》落实，为促进广东深化改革、持续保持经济高速发展贡献力量。</p>\r\n\r\n<p px=\"\" style=\"border-left-width: 0px; font-size: 14px; border-right-width: 0px; font-variant: normal; border-bottom-width: 0px; font-weight: normal; font-style: normal; line-height: 25px; border-top-width: 0px\">在会见任学锋时，王野平简要介绍了大唐集团&ldquo;十三五&rdquo;发展的思路以及当前在广东省的项目生产运营和投资建设情况，希望进一步加强与广州市委市政府的合作，加大电力市场化改革和金融投资力度。</p>\r\n\r\n<p px=\"\" style=\"border-left-width: 0px; font-size: 14px; border-right-width: 0px; font-variant: normal; border-bottom-width: 0px; font-weight: normal; font-style: normal; line-height: 25px; border-top-width: 0px\">任学锋表示，广州市委市政府将认真落实广东省委省政府与大唐集团签订的《&ldquo;十三五&rdquo;战略合作框架协议》，积极做好政策支持和市场服务等工作，希望通过双方强强联合，进一步拓宽合作发展空间，保持广州经济社会快速发展势头，实现双方&ldquo;十三五&rdquo;共赢发展目标。</p>\r\n\r\n<p px=\"\" style=\"border-left-width: 0px; font-size: 14px; border-right-width: 0px; font-variant: normal; border-bottom-width: 0px; font-weight: normal; font-style: normal; line-height: 25px; border-top-width: 0px\">期间，王野平还听取了集团公司南方公司有关筹备情况的汇报。</p>\r\n\r\n<p px=\"\" style=\"border-left-width: 0px; font-size: 14px; border-right-width: 0px; font-variant: normal; border-bottom-width: 0px; font-weight: normal; font-style: normal; line-height: 25px; border-top-width: 0px\">广东省政府办公厅、省能源局，广州市委、广州市天河区委、广州市发改委、市工信委有关负责人，集团公司总经理助理、大唐广西分公司、桂冠电力公司总经理、党组书记戴波，集团公司办公厅、规划发展部、计划营销部，大唐国际发电公司，大唐广东分公司相关负责人参加上述活动。</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('392','1146','1','','','尊敬的各界朋友、各合作单位：由于新华联集团第四代总部大楼建成使用，新华联集团总部已于2015年10月26日由北京市朝阳区道家园18号新华联大厦，正式搬迁至集团新总部大楼，新址联系信息如下：地址：北京市通州区台湖镇政府大街新华联集团总部大楼电话：010-80538888传真','175.13.251.85','175.13.251.85','1463022590','&nbsp;<span style=\"white-space: normal; word-spacing: 0px; text-transform: none; float: none; color: rgb(117,117,117); font: 14px/26px 宋体; widows: 1; display: inline !important; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">尊敬的各界朋友、各合作单位：</span><br style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(117,117,117); font: 14px/26px 宋体; widows: 1; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\" />\r\n<span style=\"white-space: normal; word-spacing: 0px; text-transform: none; float: none; color: rgb(117,117,117); font: 14px/26px 宋体; widows: 1; display: inline !important; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">由于新华联集团第四代总部大楼建成使用，新华联集团总部已于2015年10月26日由北京市朝阳区道家园18号新华联大厦，正式搬迁至集团新总部大楼，新址联系信息如下：</span><br style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(117,117,117); font: 14px/26px 宋体; widows: 1; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\" />\r\n<span style=\"white-space: normal; word-spacing: 0px; text-transform: none; float: none; color: rgb(117,117,117); font: 14px/26px 宋体; widows: 1; display: inline !important; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">地址：北京市通州区台湖镇政府大街新华联集团总部大楼</span><br style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(117,117,117); font: 14px/26px 宋体; widows: 1; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\" />\r\n<span style=\"white-space: normal; word-spacing: 0px; text-transform: none; float: none; color: rgb(117,117,117); font: 14px/26px 宋体; widows: 1; display: inline !important; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">电话：010-80538888</span><br style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(117,117,117); font: 14px/26px 宋体; widows: 1; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\" />\r\n<span style=\"white-space: normal; word-spacing: 0px; text-transform: none; float: none; color: rgb(117,117,117); font: 14px/26px 宋体; widows: 1; display: inline !important; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">传真：010-80538999</span><br style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(117,117,117); font: 14px/26px 宋体; widows: 1; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\" />\r\n<span style=\"white-space: normal; word-spacing: 0px; text-transform: none; float: none; color: rgb(117,117,117); font: 14px/26px 宋体; widows: 1; display: inline !important; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">邮编：101116</span><br style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(117,117,117); font: 14px/26px 宋体; widows: 1; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\" />\r\n<span style=\"white-space: normal; word-spacing: 0px; text-transform: none; float: none; color: rgb(117,117,117); font: 14px/26px 宋体; widows: 1; display: inline !important; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">如因我集团地址变更给您带来不便，我们深感歉意，并敬请谅解!</span><br style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(117,117,117); font: 14px/26px 宋体; widows: 1; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\" />\r\n<span style=\"white-space: normal; word-spacing: 0px; text-transform: none; float: none; color: rgb(117,117,117); font: 14px/26px 宋体; widows: 1; display: inline !important; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">特此通知！　　<span class=\"Apple-converted-space\">&nbsp;</span></span><br style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(117,117,117); font: 14px/26px 宋体; widows: 1; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\" />\r\n<span style=\"white-space: normal; word-spacing: 0px; text-transform: none; float: none; color: rgb(117,117,117); font: 14px/26px 宋体; widows: 1; display: inline !important; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">新华联集团</span>');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('393','1147','1','','<!--#p8_attach#-->/cms/item/2016_09/14_13/ebdf3f1924970659.jpg','3月27日，从集团公司召开的党群系统工作会上传来令人欣喜的消息，公司一举获得集团2014年度“品牌传播与新闻宣传报道先进单位”等多项荣誉，党委书记张琳代表公司上台参加授牌仪式。过去的一年中，公司的品牌传播工作一直坚持以公司网站、报纸和各项目报纸为依','175.13.251.85','175.13.251.35','1462982400','<p align=\"left\" style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(51,51,51); font: 14px/1.5 宋体; widows: 1; letter-spacing: normal; text-indent: 32px; -webkit-text-stroke-width: 0px\"><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\"><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">3</span></span></span><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">月</span></span><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">27</span></span></span><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">日，从集团公司召开的党群系统工作会上传来令人欣喜的消息，公司一举获得集团</span></span><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">2014</span></span><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">年度&ldquo;品牌传播与新闻宣传报道先进单位&rdquo;等多项荣誉，党委书记张琳代表公司上台参加授牌仪式。</span></span></p>\r\n\r\n<p align=\"left\" style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(51,51,51); font: 14px/1.5 宋体; widows: 1; letter-spacing: normal; text-indent: 32px; -webkit-text-stroke-width: 0px\"><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\"><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">过去的一年中，公司的品牌传播工作一直坚持以公司网站、报纸和各项目报纸为依托，充分发挥基层通讯员的积极性，凝心聚力弘扬企业文化，同时积极与集团、总公司以及外媒联动，刊发稿件数量远超集团指标，同时项目施工现场形象建设水平显著提高，为公司树立了良好的企业形象，有效提升了公司影响力和美誉度，得到了集团公司的肯定和赞誉。</span></span></span></span></p>\r\n\r\n<p align=\"left\" style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(51,51,51); font: 14px/1.5 宋体; widows: 1; letter-spacing: normal; text-indent: 32px; -webkit-text-stroke-width: 0px\">&nbsp;</p>\r\n\r\n<p align=\"left\" style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(51,51,51); font: 14px/1.5 宋体; widows: 1; letter-spacing: normal; text-indent: 32px; -webkit-text-stroke-width: 0px\"><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\"><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\"><img alt=\"667m=21&amp;gp=0.jpg\" src=\"<!--#p8_attach#-->/cms/item/2016_09/14_13/ebdf3f1924970659.jpg\" style=\"width: 314px; height: 220px;\" /></span></span></span></span></p>\r\n\r\n<p align=\"left\" style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(51,51,51); font: 14px/1.5 宋体; widows: 1; letter-spacing: normal; text-indent: 32px; -webkit-text-stroke-width: 0px\"><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\"><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">此外，在创建标准化党支部、书香项目、</span></span><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">CI</span></span></span><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">创优、职工之家建设等方面，项目部积极努力，在规范中创新，在创新中提高，受到集团的好评。其中，第一、第二大项目部党支部获评集团标准化红旗党支部；第二大项目部昆山花桥项目获评集团书香示范项目，第一大项目部、上海来福士项目、温州瓯北项目、银川八里桥项目、贯辰安阳项目获评集团书香项目；昆山花桥项目获评集团<span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">CI</span></span></span><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">示范项目，温州瓯北项目获评</span></span><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">CI</span></span></span><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">金奖项目，中房&middot;城市广场项目、天鹅湖项目获评集团</span></span><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">CI</span></span></span><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">银奖项目；</span></span>上海来福士项目获评集团先进职工之<span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">家，<span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">孙建国获评集团优秀工会工作者，李兴波获评集团品牌传播与新闻宣传报道优秀通讯员</span></span></span></span><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\"><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">。</span></span></span></span></p>\r\n\r\n<p align=\"left\" style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(51,51,51); font: 14px/1.5 宋体; widows: 1; letter-spacing: normal; text-indent: 32px; -webkit-text-stroke-width: 0px\"><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\"><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">一系列荣誉的获得，是公司上下共同努力的结果，也必将激励着大家在新的年度，再接再厉，创新超越，勇争先锋，共创党群工作新局面，为助力企业健康快读发展塑造软实力，提供硬支撑。（崔文婧</span></span>&nbsp;<span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">丁玉满</span></span><span style=\"font-family: 宋体\"><span style=\"font-size: 16px\">）</span></span></span></span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('395','1154','1','','<!--#p8_attach#-->/cms/item/2017_09/25_10/9997dc31235b5884.jpg','1970年出','183.215.65.80','113.246.92.127','1506268800','<p style=\"text-align: center\"><span microsoft=\"\" style=\"font-family: ; color: rgb(99,99,99)\" yahei=\"\"><img alt=\"6f02b081703fd3f3.jpg\" src=\"<!--#p8_attach#-->/cms/item/2017_09/25_10/9997dc31235b5884.jpg\" style=\"height: 269px; width: 214px\" /></span></p>\r\n\r\n<p style=\"text-align: center\">&nbsp;</p>\r\n\r\n<p><span microsoft=\"\" style=\"font-family: ; color: rgb(99,99,99)\" yahei=\"\">1970年出生。2016年3月起担任国大集装箱运输股份有限公司总经理。2013年4月起任</span><font color=\"#636363\" face=\"宋体\">国大</font><span microsoft=\"\" style=\"font-family: ; color: rgb(99,99,99)\" yahei=\"\">投资有限公司总经理，2014年8月起兼任</span><font color=\"#636363\" face=\"宋体\">国大</font><span microsoft=\"\" style=\"font-family: ; color: rgb(99,99,99)\" yahei=\"\">集团租赁有限公司总经理。历任中海集团物流有限公司财务总监、副总经理，中海（海南）海盛船务股份有限公司总会计师，中国海运（集团）总公司资金管理部主任，</span><font color=\"#636363\" face=\"宋体\">国大</font><span microsoft=\"\" style=\"font-family: ; color: rgb(99,99,99)\" yahei=\"\">集装箱运输股份有限公司总会计师。刘军先生毕业于中山大学经济学专业，注册会计师、高级会计师。</span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('396','1156','1','','<!--#p8_attach#-->/sites/item/2017_09/01_14/5f7f727c4499a829.JPG','','113.247.55.68','113.247.55.68','1504195200','<p style=\"text-align: center\"><a href=\"<!--#p8_attach#-->/sites/item/2017_09/29_09/73c5539b43a96f62.jpg\" target=\"_blank\"><img alt=\"9.jpg\" src=\"<!--#p8_attach#-->/sites/item/2017_09/29_09/73c5539b43a96f62.jpg.cthumb.jpg\" style=\"height: 568px; width: 900px\" /></a></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('397','1157','1','','<!--#p8_attach#-->/sites/item/2017_09/29_09/6bce5b714dc924fe.jpg','&nbsp;','113.247.55.68','113.247.55.68','1504195200','<p style=\"text-align: center;\">&nbsp;</p>\r\n\r\n<p style=\"text-align: center;\"><a href=\"<!--#p8_attach#-->/sites/item/2017_09/29_09/6bce5b714dc924fe.jpg\" target=\"_blank\"><img alt=\"91.jpg\" src=\"<!--#p8_attach#-->/sites/item/2017_09/29_09/6bce5b714dc924fe.jpg.cthumb.jpg\" style=\"width: 800px; height: 454px;\" /></a></p>\r\n\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('398','1158','1','','<!--#p8_attach#-->/sites/item/2017_09/29_09/334f6519e6fb0b5e.png','','113.246.95.201','113.246.95.201','1504540800','<p style=\"text-align: center;\"><a href=\"<!--#p8_attach#-->/sites/item/2017_09/29_09/2c3296bda5ce7b9b.png\" target=\"_blank\"><img alt=\"活动1.png\" src=\"<!--#p8_attach#-->/sites/item/2017_09/29_09/2c3296bda5ce7b9b.png.cthumb.jpg\" style=\"width: 800px; height: 463px;\" /></a></p>\r\n\r\n<p style=\"text-align: center;\">劳动光荣</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('399','1159','1','','<!--#p8_attach#-->/sites/item/2017_09/29_09/94746ccf1a065e04.png','','113.246.95.201','113.246.95.201','1506614400','<a href=\"<!--#p8_attach#-->/sites/item/2017_09/29_09/edbf2f9f2adcd909.png\" target=\"_blank\"><img alt=\"活动2.png\" src=\"<!--#p8_attach#-->/sites/item/2017_09/29_09/edbf2f9f2adcd909.png.cthumb.jpg\" style=\"width: 800px; height: 503px;\" /></a>');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('400','1160','1','','<!--#p8_attach#-->/sites/item/2017_09/29_09/a86558591db7cadd.png','','113.246.95.201','113.246.95.201','1506649775','<a href=\"<!--#p8_attach#-->/sites/item/2017_09/29_09/a86558591db7cadd.png\" target=\"_blank\"><img alt=\"活动3.png\" src=\"<!--#p8_attach#-->/sites/item/2017_09/29_09/a86558591db7cadd.png.cthumb.jpg\" style=\"width: 800px; height: 530px;\" /></a>');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('401','1161','1','','<!--#p8_attach#-->/sites/item/2017_09/29_09/4c5546d7b1b3090d.png','','113.246.95.201','113.246.95.201','1506649816','<a href=\"<!--#p8_attach#-->/sites/item/2017_09/29_09/4c5546d7b1b3090d.png\" target=\"_blank\"><img alt=\"活动4.png\" src=\"<!--#p8_attach#-->/sites/item/2017_09/29_09/4c5546d7b1b3090d.png.cthumb.jpg\" style=\"width: 800px; height: 536px;\" /></a>');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('402','1162','1','','<!--#p8_attach#-->/sites/item/2017_09/29_09/02d11fab81d52693.png','','113.246.95.201','113.246.95.201','1506649885','<a href=\"<!--#p8_attach#-->/sites/item/2017_09/29_09/02d11fab81d52693.png\" target=\"_blank\"><img alt=\"活动5.png\" src=\"<!--#p8_attach#-->/sites/item/2017_09/29_09/02d11fab81d52693.png.cthumb.jpg\" /></a>');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('403','1166','1','','<!--#p8_attach#-->/cms/item/2017_09/30_10/b54b65342bcadfa1.jpg','交通银','113.247.55.68','113.247.55.68','1506740325','交通银行');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('404','1167','1','','<!--#p8_attach#-->/sites/item/2017_09/18_07/39581594935e4eed.jpg','&nbsp;工商银行','113.247.55.68','113.247.55.68','1505691626','&nbsp;工商银行');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('405','1168','1','','<!--#p8_attach#-->/sites/item/2017_09/18_07/59c44bd1aca22d30.jpg','交通银','113.247.55.68','113.247.55.68','1505691650','&nbsp;交通银行');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('406','1169','1','','<!--#p8_attach#-->/cms/item/2017_09/30_10/99a368bb842c1fcf.jpg','中国工商银行','113.247.55.68','113.247.55.68','1506740358','中国工商银行');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('409','1176','1','','<!--#p8_attach#-->/cms/item/2019_02/26_15/7b9541f281ed57ee.jpg','葡萄牙当地时间12月5日，在中葡两国元首的共同见证下，中粮集团党组书记、董事长吕军和葡萄牙贸易与投资促进局局长路易斯•卡斯特罗•恩里克斯代表双方签署合作谅解备忘录。中粮集团将在葡萄牙波尔图大区设立为旗下中粮国际提供共享服务的“卓越中心&rdquo','113.246.111.120','113.246.111.120','1551165637','<div>&nbsp;葡萄牙当地时间12月5日，在中葡两国元首的共同见证下，中粮集团党组书记、董事长吕军和葡萄牙贸易与投资促进局局长路易斯&bull;卡斯特罗&bull;恩里克斯代表双方签署合作谅解备忘录。中粮集团将在葡萄牙波尔图大区设立为旗下中粮国际提供共享服务的&ldquo;卓越中心&rdquo;，助力集团&ldquo;买全球、卖全球&rdquo;，加速打造世界一流粮商。</div>\r\n\r\n<div>&nbsp; &nbsp; &nbsp; 葡萄牙是连接陆上丝绸之路和海上丝绸之路的重要枢纽，支持国际商贸，拥有高素质的人才大军，这些都是促成&ldquo;卓越中心&rdquo;落户波尔图的重要因素。</div>\r\n\r\n<div>&nbsp; &nbsp; &nbsp; 中粮国际波尔图&ldquo;卓越中心&rdquo;将于本月开始运作，为中粮国际的全球粮、油、棉、糖的交易、仓储、物流和加工业务提供统一、专业、透明和标准化的高效服务，为当地创造400个新的工作岗位，覆盖IT、采购、人力资源和财务等多个领域。</div>\r\n\r\n<div>&nbsp; &nbsp; &nbsp; 未来，&ldquo;卓越中心&rdquo;将为中粮国际全球粮食业务增长提供强有力的支持，创造更高附加值，推动效益提升，也将为当地的经济发展和就业做出更多贡献，有望树立中葡两国经贸合作的新典范。</div>\r\n\r\n<div style=\"text-align:center\">&nbsp; &nbsp; &nbsp;<a href=\"<!--#p8_attach#-->/cms/item/2019_02/26_15/7b9541f281ed57ee.jpg\" target=\"_blank\"><img alt=\"gw1.jpg\" src=\"<!--#p8_attach#-->/cms/item/2019_02/26_15/7b9541f281ed57ee.jpg\" style=\"height:300px; width:551px\" /></a></div>\r\n\r\n<div>中粮国际是中粮集团农粮业务的唯一海外统一采购、投资和发展平台。旗下包括谷物，油籽，糖，棉花、咖啡等产品线，资产和业务覆盖全球50多个国家和地区，在35个国家设立有子公司及办事机构，海外员工1.2万人。通过全球一体化网络布局，中粮国际将农产品源源不断运往世界各地，在全球粮食产区与销区之间建立了完善的物流体系，致力于在全球范围内构建集收储、加工、物流、销售贸易、分销于一体的综合性全产业链企业，以整体协同优势实现高效运营和系统低成本。</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('410','1177','1','','<!--#p8_attach#-->/cms/item/2019_02/26_15/ae0544d6f30a810f.jpg','在2019世界移动大会前夕，华为在巴塞罗那举办主题为&amp;amp;ldquo;构建万物互联的智能世界&amp;amp;rdquo;的华为Day0论坛。在&amp;amp;ldquo;5G is ON&amp;amp;rdquo;分论坛上，基于西班牙沃达丰与华为联合部署的5G商用网络，华为常务董事、运营商BG总裁丁耘使用5G折叠屏智能手机演示了4K超高清视','113.246.111.120','113.246.111.120','1551166599','<p style=\"margin-left:0px; margin-right:0px\">在2019世界移动大会前夕，华为在巴塞罗那举办主题为&ldquo;构建万物互联的智能世界&rdquo;的华为Day0论坛。在&ldquo;5G is ON&rdquo;分论坛上，基于西班牙沃达丰与华为联合部署的5G商用网络，华为常务董事、运营商BG总裁丁耘使用5G折叠屏智能手机演示了4K超高清视频点播，展现出5G网络随时随地提供Gbps超大带宽的能力。</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">丁耘表示：&ldquo;5G浪潮已经向全球涌动，新的科技将使人类生活更加美好，同时5G通过引入Gbps连接以及CloudX业务带来体验变现，为全球运营商开启了更广阔的商业空间。华为将建设开放实验室帮助运营商在本地体验与孵化5G创新业务，从而全面助力运营商构建5G时代的商业成功&rdquo;。</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px; text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px; text-align:center\"><a href=\"<!--#p8_attach#-->/cms/item/2019_02/26_15/ae0544d6f30a810f.jpg\" target=\"_blank\"><img alt=\"gw2.jpg\" src=\"<!--#p8_attach#-->/cms/item/2019_02/26_15/ae0544d6f30a810f.jpg\" /></a></p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px; text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px; text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px; text-align:center\">华为常务董事、运营商BG总裁丁耘基于西班牙沃达丰与华为联合部署的5G网络，演示4K超高清视频点播业务</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\"><strong>5G时代，运营商将通过CloudX重定义视频以及游戏等业务，开启更大商业机遇</strong></p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">5G能够提供随时随地Gbps堪比光纤的&ldquo;Air Fiber&rdquo;高速体验，同时通过10倍比特效率提升，使能运营商快速执行FMC（固定移动网络融合）战略。运营商通过5G快速满足个人、家庭以及垂直行业的大带宽诉求，并扩大其商业边界。</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">&ldquo;5G+云&rdquo;将会催生出更多新形态业务并将重新定义视频和游戏等业务。CloudX有望成为5G时代的爆点业务。云游戏（Cloud Gaming）能够利用5G大带宽、低时延以及云计算能力将以往只能在专业游戏硬件运行的大型游戏通过智能手机上运行，极大提升用户游戏体验，与此同时运营商也可以通过体验以及内容实现更好的商业变现。</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\"><strong>5G产业与生态加速走向成熟，华为构建5G开放实验室助力运营商体验与孵化创新业务</strong></p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">2019年华为将在亚洲、欧洲以及中东新建5G开放实验室，为区域打造5G业务体验与孵化中心 。开放实验室将聚合华为在全球孵化的5G创新业务，并通过CloudX业务平台与5G网络环境支持本地生态伙伴孵化与探索适合本地市场的5G创新业务，为5G时代的商业成功夯实基础。</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">2019年全球5G产业与生态加速走向成熟，华为预计全球将有超过60张商用网络部署，40多款5G终端含智能手机上市，以及累计超过50个国家发放频谱。5G浪潮将超越以往任何一代无线通信的速度向全球普及，同时将通过一系列新的应用更加丰富人们的数字化生活。</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">本次论坛还探讨了如何通过技术创新和商业模式优化激发运营商业务新增长，以及如何打造数字化平台和数字化服务加速运营商数字化运营转型。</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">2019世界移动大会将于2月25日至2月28日在西班牙巴塞罗那举行。华为展区位于Fira Gran Via 1号馆1H50展区、3号馆3I30展区、4号馆创新城市展区、7号馆7C21和7C31展区。欲了解更多详情，请参阅</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('411','1178','1','','<!--#p8_attach#-->/sites/item/2017_09/29_09/a86558591db7cadd.png','','223.83.150.100','223.83.150.100','1506649775','<a href=\"<!--#p8_attach#-->/sites/item/2017_09/29_09/a86558591db7cadd.png\" target=\"_blank\"><img alt=\"活动3.png\" src=\"<!--#p8_attach#-->/sites/item/2017_09/29_09/a86558591db7cadd.png.cthumb.jpg\" style=\"width: 800px; height: 530px;\" /></a>');
REPLACE INTO `p8_cms_item_attribute` VALUES ('3','5','17','1291882516','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('285','6','53','1431236286','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1057','6','778','1473832103','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('285','3','53','1431236286','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('284','6','53','1409565048','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('283','6','53','1346507832','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('282','6','53','1439792733','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1178','6','34','1557305706','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1021','5','34','1393229979','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1177','6','809','1551166599','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('281','6','53','1346507685','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1147','6','778','1473832061','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1079','6','128','1432341455','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1082','6','58','1432992473','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1153','6','823','1521217387','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1143','1','34','1515914568','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1078','1','128','1515914587','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1068','1','128','1508256941','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1100','6','1','1441093610','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1053','6','781','1463355987','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1133','6','44','1508256806','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1174','6','55','1520504190','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1140','6','34','1508255349','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1141','6','34','1458394250','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1134','6','34','1458464368','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1135','6','34','1458400569','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1142','6','34','1460605199','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1143','6','34','1473808744','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1154','6','779','1509075837','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1156','6','815','1506648051','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1157','6','815','1506648110','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1158','6','813','1506729674','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1159','6','813','1506729674','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1160','6','813','1506729674','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1161','6','813','1506729674','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1162','6','814','1506729696','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1163','6','55','1506734423','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1170','6','94','1507703974','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1165','6','55','1508257702','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1166','6','817','1506740325','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1167','6','817','1506740334','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1168','6','817','1506740535','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1169','6','817','1506740358','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1171','6','94','1507704038','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1172','6','94','1507704095','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1176','6','809','1551165659','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1068','6','128','1508256287','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1078','6','128','1508256326','admin');
REPLACE INTO `p8_cms_item_down_` VALUES ('1155','down','821','1','admin','测试','','0','','','','','','测试','','','','','','1','admin','0','1506396263','1506396263','1506396263','1506396263','1','','','4','0','0','','','','');
REPLACE INTO `p8_cms_item_down_addon` VALUES ('13','1155','1','','','测试','183.215.65.80','183.215.65.80','1506396263','测试','1','新建文本文档 (2).txt<!--#p8_attach#-->/cms/item/2017_09/26_11/052e96a660089bd9.txt','18');
REPLACE INTO `p8_cms_item_mood` VALUES ('1','欠扁','1.gif','99');
REPLACE INTO `p8_cms_item_mood` VALUES ('2','支持','2.gif','88');
REPLACE INTO `p8_cms_item_mood` VALUES ('3','很棒','3.gif','77');
REPLACE INTO `p8_cms_item_mood` VALUES ('4','找骂','4.gif','66');
REPLACE INTO `p8_cms_item_mood` VALUES ('5','搞笑','5.gif','55');
REPLACE INTO `p8_cms_item_mood` VALUES ('6','软文','6.gif','44');
REPLACE INTO `p8_cms_item_mood` VALUES ('7','不解','7.gif','1');
REPLACE INTO `p8_cms_item_mood` VALUES ('8','吃惊','8.gif','1');
REPLACE INTO `p8_cms_item_page_` VALUES ('1184','page','830','1','admin','集团简介','','0','','','','','','中国国际海运集装箱（集团）股份有限公司（简称：中集集团），是世界领先的物流装备和能源装备供应商，总部位于中国深圳。公司致力于在如下主要业务领域：集装箱、道路运输车辆、能源化工及食品装备、海洋工程、物流服务、空港设备等，提供高品质与可信赖的装备和服务。','','','','','','1','admin','1583284967','1583200623','1583200623','1583200623','1583201995','1','','','10','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_page_` VALUES ('1187','page','777','1','admin','企业文化','','0','','<!--#p8_attach#-->/core/label/2017_09/01_10/992bcc8ab0d40a9c.jpg','','','','□使命：为物流和能源行业提供高品质与可信赖的装备和服务，为股东和员工提供良好回报，为社会创造可持续价值。□愿景：成为所进入行业的受人尊重的全球领先企业。□企业精神：自强不息 追求卓越□核心价值观：诚信正直、成就客户、开拓创新、持续改善、合作共赢、结果','','','','','','1','admin','0','1583202186','1583202186','1583202186','1583215687','1','','','22','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";s:1:\\\"0\\\";s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_page_` VALUES ('1185','page','781','1','admin','集团简介','','0','','','','','','中国国际海运集装箱（集团）股份有限公司（简称：中集集团），是世界领先的物流装备和能源装备供应商，总部位于中国深圳。公司致力于在如下主要业务领域：集装箱、道路运输车辆、能源化工及食品装备、海洋工程、物流服务、空港设备等，提供高品质与可信赖的装备和服务。','','','','','','1','admin','0','1583201716','1583201716','1583201716','1583201716','1','','','64','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";s:1:\\\"0\\\";s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_page_` VALUES ('1188','page','810','1','admin','董事长致辞','','0','','<!--#p8_attach#-->/core/label/2016_07/15_10/c129c97e26494b96.jpg','','','','','','','','','','1','admin','0','1583285098','1583285098','1583285098','1583285098','1','','','12','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";s:1:\\\"0\\\";s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_page_` VALUES ('1189','page','780','1','admin','发展历程','','0','','','','','','2016年10月 远望谷战略投资SML，成为全球第二大服装零售物联网解决方案供应商2016年6月 远望谷成功收购TAGSYS纺织品洗涤解决方案业务和RFID标签设计与产品业务2016年10月 远望谷战略投资SML，成为全球第二大服装零售物联网解决方案供应商2016年6月 远望谷成功收购TAGSYS','','','','','','1','admin','0','1583285304','1583285304','1583285304','1583285409','1','','','9','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_page_addon` VALUES ('1','1184','1','','','中国国际海运集装箱（集团）股份有限公司（简称：中集集团），是世界领先的物流装备和能源装备供应商，总部位于中国深圳。公司致力于在如下主要业务领域：集装箱、道路运输车辆、能源化工及食品装备、海洋工程、物流服务、空港设备等，提供高品质与可信赖的装备和服务。','36.157.225.16','36.157.225.16','1583200623','<h3><span>□&nbsp;</span>使命：</h3>\r\n\r\n<p>为物流和能源行业提供高品质与可信赖的装备和服务，为股东和员工提供良好回报，为社会创造可持续价值。</p>\r\n\r\n<h3><span>□&nbsp;</span>愿景：</h3>\r\n\r\n<p>成为所进入行业的受人尊重的全球领先企业。</p>\r\n\r\n<h3><span>□&nbsp;</span>企业精神：</h3>\r\n\r\n<p>自强不息 追求卓越</p>\r\n\r\n<h3><span>□&nbsp;</span>核心价值观：</h3>\r\n\r\n<p>诚信正直、成就客户、开拓创新、持续改善、合作共赢、结果导向。</p>\r\n');
REPLACE INTO `p8_cms_item_page_addon` VALUES ('3','1187','1','','<!--#p8_attach#-->/core/label/2017_09/01_10/992bcc8ab0d40a9c.jpg','□使命：为物流和能源行业提供高品质与可信赖的装备和服务，为股东和员工提供良好回报，为社会创造可持续价值。□愿景：成为所进入行业的受人尊重的全球领先企业。□企业精神：自强不息 追求卓越□核心价值观：诚信正直、成就客户、开拓创新、持续改善、合作共赢、结果','36.157.225.16','36.157.225.16','1583202186','<h3><span>□&nbsp;</span>使命：</h3>\r\n\r\n<p>为物流和能源行业提供高品质与可信赖的装备和服务，为股东和员工提供良好回报，为社会创造可持续价值。</p>\r\n\r\n<h3><span>□&nbsp;</span>愿景：</h3>\r\n\r\n<p>成为所进入行业的受人尊重的全球领先企业。</p>\r\n\r\n<h3><span>□&nbsp;</span>企业精神：</h3>\r\n\r\n<p>自强不息 追求卓越</p>\r\n\r\n<h3><span>□&nbsp;</span>核心价值观：</h3>\r\n\r\n<p>诚信正直、成就客户、开拓创新、持续改善、合作共赢、结果导向。</p>\r\n');
REPLACE INTO `p8_cms_item_page_addon` VALUES ('4','1188','1','','<!--#p8_attach#-->/core/label/2016_07/15_10/c129c97e26494b96.jpg','','36.157.225.16','36.157.225.16','1583285098','<img alt=\"\" border=\"none\" height=\"240\" src=\"<!--#p8_attach#-->/core/label/2016_07/15_10/c129c97e26494b96.jpg\" width=\"1140\" />\r\n<p>&nbsp;</p>\r\n\r\n<p>同志们，朋友们：</p>\r\n\r\n<p>2016农历新年即将到来。在这个辞旧迎新的美好时刻，我谨代表山东重工集团、潍柴集团管理团队，并以我个人的名义，向海内外全体员工及家属，向在各个时期为企业发展做出贡献的老领导、离退休员工，以及长期以来关心支持企业发展的社会各界朋友们致以节日的问候！祝大家新春快乐、阖家幸福！</p>\r\n\r\n<p>刚刚过去的2015年是不平凡的一年。外部经济形势严峻复杂，多种不利因素叠加，企业面临前所未有的挑战，全体干部员工齐心协力、攻坚克难，依然取得了令人鼓舞的经营业绩。这一年，我们深化改革、提质增效，企业运营质量和效率进一步提高，盈利水平继续保持行业领先；这一年，我们把握核心、创新驱动，科技研发水平得到国家高度认可，企业核心竞争力逐步增强；这一年，我们积极推动两化融合，主动拥抱工业互联网，智能制造成为行业典范；这一年，我们谋划布局、精耕细作，海外业务板块稳步增长，成为支撑企业持续健康发展的重要保障。</p>\r\n\r\n<p>2015年也是&ldquo;十二五&rdquo;的收官之年。五年来，我们充分把握外部有利机遇，持续强化自身建设，企业产业布局更加完善，业务结构日趋合理，核心竞争力不断提高，国际化、多元化水平持续提升，综合实力和品牌影响力显著增强。五年间，我们取得了历史上最佳的发展业绩，探索出了一条独具潍柴特色的可持续发展之路，在企业的发展史上写下了浓墨重彩的一笔！</p>\r\n\r\n<p>成绩的取得，离不开全体干部员工的辛勤付出，我们为自己骄傲；离不开广大合作伙伴的鼎力支持，以及社会各界的大力帮助，我们对此心怀感恩。成绩的取得，更给了我们披荆斩棘的信心和砥砺前行的力量，我们将以此为基石，自信面对未来更大的挑战。</p>\r\n\r\n<p>2016年是&ldquo;十三五&rdquo;开局之年，也是充满挑战的一年。挑战蕴含机遇，压力激发动力。我们要认清当前形势，统一思想认识，坚定必胜信心，增强主动作为意识，以&ldquo;六大战略思路&rdquo;为指导，用好&ldquo;六大抓手&rdquo;，坚决打赢&ldquo;三大战役&rdquo;，实现&ldquo;3+1目标&rdquo;。我们将坚定不移主动改革创新，加快推动战略转型，充分激发发展活力；我们将不断提高精细化管理水平，科学降低企业运营成本，拓宽企业发展空间；我们将强化市场客户意识，加强三个核心竞争力建设，提升差异化竞争优势；我们将继续深化协同发展，提高国际化运营水平，实现海外企业全面盈利；我们将坚持&ldquo;四个永葆&rdquo;，强化责任担当，努力打造适应新常态发展的干部员工队伍。没有比脚更长的路，没有比人更高的山。只要我们齐心协力，矢志发展，就一定可以拥有更强的发展动力，创造更加美好的明天！</p>\r\n\r\n<p>同志们，朋友们！站在新的起点上，我们迎难而上的信心愈加坚定，改革创新的步伐愈加有力。让我们凝心聚力、攻坚克难，在潍柴七十周年华诞的里程碑上，书写新的发展篇章！</p>\r\n\r\n<p>最后，祝愿大家新春快乐、幸福安康！</p>\r\n\r\n<p align=\"right\">&nbsp;</p>\r\n\r\n<p align=\"right\">山东重工集团、潍柴控股集团董事长</p>\r\n\r\n<p align=\"right\"><img alt=\"\" oldsrc=\"W020160205525688680942.jpg\" src=\"{$SKIN}images/W020160205525688680942.jpg\" style=\"border-left-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-top-width: 0px\" /></p>\r\n\r\n<p align=\"right\">2016年2月7日</p>\r\n');
REPLACE INTO `p8_cms_item_page_addon` VALUES ('2','1185','1','','','中国国际海运集装箱（集团）股份有限公司（简称：中集集团），是世界领先的物流装备和能源装备供应商，总部位于中国深圳。公司致力于在如下主要业务领域：集装箱、道路运输车辆、能源化工及食品装备、海洋工程、物流服务、空港设备等，提供高品质与可信赖的装备和服务。','36.157.225.16','36.157.225.16','1583201716','<p>中国国际海运集装箱（集团）股份有限公司（简称：中集集团），是世界领先的物流装备和能源装备供应商，总部位于中国深圳。公司致力于在如下主要业务领域：集装箱、道路运输车辆、能源化工及食品装备、海洋工程、物流服务、空港设备等，提供高品质与可信赖的装备和服务。支持这些业务蓬勃发展的有：提供专业资金管理的财务公司，以及提供金融解决方案的融资租赁公司。作为一家为全球市场服务的多元化跨国产业集团，中集在亚洲、北美、欧洲、澳洲等地区拥有300余家成员企业及3家上市公司，客户和销售网络分布在全球100多个国家和地区。2016年，5万优秀的中集员工，创造了511.12亿元的销售业绩，净利润约5.4亿元。</p>\r\n\r\n<p>中国国际海运集装箱（集团）股份有限公司（简称：中集集团），是世界领先的物流装备和能源装备供应商，总部位于中国深圳。公司致力于在如下主要业务领域：集装箱、道路运输车辆、能源化工及食品装备、海洋工程、物流服务、空港设备等，提供高品质与可信赖的装备和服务。支持这些业务蓬勃发展的有：提供专业资金管理的财务公司，以及提供金融解决方案的融资租赁公司。作为一家为全球市场服务的多元化跨国产业集团，中集在亚洲、北美、欧洲、澳洲等地区拥有300余家成员企业及3家上市公司，客户和销售网络分布在全球100多个国家和地区。2016年，5万优秀的中集员工，创造了511.12亿元的销售业绩，净利润约5.4亿元。</p>\r\n\r\n<p>中集集团于1980年1月创立于深圳，由招商局与丹麦宝隆洋行合资成立，初期由宝隆洋行派员管理。1994年公司在深圳证券交易所上市，2012年12月在香港联交所上市，目前是A+H股公众上市公司，主要股东为招商局集团、中国远洋海运集团和弘毅投资等。诞生时即深深植入的国际化基因，出类拔萃的公司治理结构，长期以来对于技术创新和管理效率的不懈追求，使得中集快速成长为在全球多个行业具有领先地位的企业。</p>\r\n');
REPLACE INTO `p8_cms_item_page_addon` VALUES ('5','1189','1','','','2016年10月 远望谷战略投资SML，成为全球第二大服装零售物联网解决方案供应商2016年6月 远望谷成功收购TAGSYS纺织品洗涤解决方案业务和RFID标签设计与产品业务2016年10月 远望谷战略投资SML，成为全球第二大服装零售物联网解决方案供应商2016年6月 远望谷成功收购TAGSYS','36.157.225.16','36.157.225.16','1583285304','<ul class=\"history\">\r\n	<li class=\"media bg1\"><span class=\"pull-left date\">2016年10月</span> <span class=\"media-body title\">远望谷战略投资SML，成为全球第二大服装零售物联网解决方案供应商</span></li>\r\n	<li class=\"media bg2\"><span class=\"pull-left date\">2016年6月</span> <span class=\"media-body title\">远望谷成功收购TAGSYS纺织品洗涤解决方案业务和RFID标签设计与产品业务</span></li>\r\n	<li class=\"media bg1\"><span class=\"pull-left date\">2016年10月</span> <span class=\"media-body title\">远望谷战略投资SML，成为全球第二大服装零售物联网解决方案供应商</span></li>\r\n	<li class=\"media bg2\"><span class=\"pull-left date\">2016年6月</span> <span class=\"media-body title\">远望谷成功收购TAGSYS纺织品洗涤解决方案业务和RFID标签设计与产品业务</span></li>\r\n	<li class=\"media bg1\"><span class=\"pull-left date\">2016年10月</span> <span class=\"media-body title\">远望谷战略投资SML，成为全球第二大服装零售物联网解决方案供应商</span></li>\r\n	<li class=\"media bg2\"><span class=\"pull-left date\">2016年6月</span> <span class=\"media-body title\">远望谷成功收购TAGSYS纺织品洗涤解决方案业务和RFID标签设计与产品业务</span></li>\r\n	<li class=\"media bg1\"><span class=\"pull-left date\">2016年10月</span> <span class=\"media-body title\">远望谷战略投资SML，成为全球第二大服装零售物联网解决方案供应商</span></li>\r\n	<li class=\"media bg2\"><span class=\"pull-left date\">2016年6月</span> <span class=\"media-body title\">远望谷成功收购TAGSYS纺织品洗涤解决方案业务和RFID标签设计与产品业务</span></li>\r\n</ul>\r\n');
REPLACE INTO `p8_cms_item_product_` VALUES ('1153','product','823','1','admin','5天开心特训营','','0','','<!--#p8_attach#-->/cms/item/2017_09/29_23/561a5f2f024c6bf0.jpg','','','6','军人形象训练：军姿、军人行为品质强化训练，了解掌握军规军纪','','','','','1','','0','1521217387','1494432000','1521217387','1','','','0','0','0','','','','','1494492297','');
REPLACE INTO `p8_cms_item_product_` VALUES ('1163','product','55','1','admin','产品1','','0','','<!--#p8_attach#-->/cms/item/2017_09/30_09/726da40fec872151.jpg.thumb.jpg','','','6','最新产品，震撼上市','','','','','1','admin','0','1506734423','1506734423','1506734423','1','','','0','0','0','','','','','1506734423','');
REPLACE INTO `p8_cms_item_product_` VALUES ('1170','product','94','1','admin','视频直博服务','','0','','<!--#p8_attach#-->/cms/item/2017_10/11_14/a13e279767fd83cb.jpg.thumb.jpg','','','6','频服务器主打安防行业视频直播,数字景区直播、视频农场、视频商','','','','','1','admin','0','1507703974','1507703974','1507703974','1','','','0','0','0','','','','','1507703974','');
REPLACE INTO `p8_cms_item_product_` VALUES ('1165','product','55','1','admin','演出舞台烟机','','0','','<!--#p8_attach#-->/cms/item/2017_09/30_09/61c3ba6b044a8174.png.thumb.jpg','','','6','用于多类型舞台效果渲染，有很多不同的样式','','','','','1','','0','1506700800','1506700800','1508257702','1','','','0','0','0','','','','','1506736076','');
REPLACE INTO `p8_cms_item_product_` VALUES ('1171','product','94','1','admin','视频直播服务2','','0','','<!--#p8_attach#-->/cms/item/2017_10/11_14/9c808356d2478211.jpg.thumb.jpg','','','6','&amp;ldquo;环保监控、安全督查、园区安全和消防预警一体化视频联动系统','','','','','1','admin','0','1507704038','1507704038','1507704038','1','','','0','0','0','','','','','1507704038','');
REPLACE INTO `p8_cms_item_product_` VALUES ('1172','product','94','1','admin','视频直播服务','','0','','<!--#p8_attach#-->/cms/item/2017_10/11_14/b8ae2e0221bbae8e.jpg.thumb.jpg','','','6','一键视频语音呼叫报警、园区安全和消防预警一体化视频联动系统','','','','','1','admin','0','1507704095','1507704095','1507704095','1','','','0','0','0','','','','','1507704095','');
REPLACE INTO `p8_cms_item_product_` VALUES ('1174','product','55','1','admin','儿童手表','','0','','<!--#p8_attach#-->/cms/item/2018_03/02_10/ea68a80a608d5cc8.png','','','6','更聪明的电话手表，4G高清通话，实时定位','','','','','1','admin','0','1519958452','1519958037','1520504190','1','','','0','0','0','','','','','1519957763','');
REPLACE INTO `p8_cms_item_product_addon` VALUES ('15','1153','1','','<!--#p8_attach#-->/cms/item/2017_09/29_23/561a5f2f024c6bf0.jpg','军人形象训练：军姿、军人行为品质强化训练，了解掌握军规军纪','118.249.186.50','113.246.84.255','1521217387','测试测试测试','测试测试测试测试','<span style=\"font-family: 宋体; line-height: 24px\">军人形象训练：军姿、军人行为品质强化训练，了解掌握军规军纪； 军事基础训练：军人基本动作训练、军人礼仪训练。 军营文化体验：学唱军歌、拉歌比赛、感受军营生活文化。 特种兵战术训练：特种兵穿越障碍强化训练、孤岛泅渡强化训练、400米障碍训练。 情商培养： 撕名牌大战、各种团队素质拓展，在玩乐中懂得团队合作、与人沟通相处的道理。</span>','timg.jpg<!--#p8_attach#-->/cms/item/2016_05/12_10/97e2e2bacae3ab08.jpg<!--#p8_attach#-->/cms/item/2016_05/12_10/97e2e2bacae3ab08.jpg.thumb.jpgIMG_20130630_0002.jpg<!--#p8_attach#-->/cms/item/2013_12/08_14/edd83c0579cec54f.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2013_12/08_14/edd83c0579cec54f.jpg.thumb.jpg20160803-1_03.jpg<!--#p8_attach#-->/cms/item/2017_05/11_16/2d75e5819837c03f.jpg<!--#p8_attach#-->/cms/item/2017_05/11_16/2d75e5819837c03f.jpg20160803-1_07.jpg<!--#p8_attach#-->/cms/item/2017_05/11_16/12d89d35785da55f.jpg<!--#p8_attach#-->/cms/item/2017_05/11_16/12d89d35785da55f.jpg','');
REPLACE INTO `p8_cms_item_product_addon` VALUES ('16','1163','1','','<!--#p8_attach#-->/cms/item/2017_09/30_09/726da40fec872151.jpg.thumb.jpg','最新产品，震撼上市','113.247.55.68','113.247.55.68','1506734423','<p>最新产品，震撼上市。最新产品，震撼上市。</p>\r\n\r\n<p>最新产品，震撼上市。最新产品，震撼上市。</p>\r\n','<p>最新产品，震撼上市。最新产品，震撼上市。最新产品，震撼上市。最新产品，震撼上市。</p>\r\n\r\n<p>最新产品，震撼上市。</p>\r\n\r\n<p>最新产品，震撼上市。</p>\r\n\r\n<p>最新产品，震撼上市。</p>\r\n','最新产品，震撼上市。','t0160e77c72250bad52.jpg<!--#p8_attach#-->/cms/item/2017_09/30_09/bebb771295a73aac.jpg<!--#p8_attach#-->/cms/item/2017_09/30_09/bebb771295a73aac.jpg.thumb.jpg','');
REPLACE INTO `p8_cms_item_product_addon` VALUES ('19','1170','1','','<!--#p8_attach#-->/cms/item/2017_10/11_14/a13e279767fd83cb.jpg.thumb.jpg','频服务器主打安防行业视频直播,数字景区直播、视频农场、视频商','113.247.22.7','113.247.22.7','1507703974','<span style=\"font-family: \"Microsoft YaHei\"; font-size: medium;\">敬请期待</span>','<p style=\"margin: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; background-color: rgb(255, 255, 255); text-align: justify;\">&nbsp;</p>\r\n\r\n<table border=\"1\" cellpadding=\"3\" cellspacing=\"0\" style=\"clear: both; border-collapse: collapse; word-break: break-all; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; background-color: rgb(255, 255, 255);\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"padding: 0px 10px; width: 0.590972in; text-align: center; vertical-align: top;\">\r\n			<div style=\"text-align: justify;\">1</div>\r\n			</td>\r\n			<td style=\"padding: 0px 10px; width: 5.25208in; vertical-align: top;\">\r\n			<div style=\"text-align: justify;\"><span style=\"font-family: 宋体;\">主机*1</span></div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"padding: 0px 10px; width: 0.590972in; text-align: center; vertical-align: top;\">\r\n			<div style=\"text-align: justify;\">2</div>\r\n			</td>\r\n			<td style=\"padding: 0px 10px; width: 5.25208in; vertical-align: top;\">\r\n			<div style=\"text-align: justify;\"><span style=\"font-family: 宋体;\">电源</span><span style=\"font-family: 宋体;\">*1</span></div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"padding: 0px 10px; width: 0.590972in; text-align: center; vertical-align: top;\">\r\n			<div style=\"text-align: justify;\">3</div>\r\n			</td>\r\n			<td style=\"padding: 0px 10px; width: 5.25208in; vertical-align: top;\">\r\n			<div style=\"text-align: justify;\"><span style=\"font-family: 宋体;\">安装配件套</span><span style=\"font-family: 宋体;\">*</span><span style=\"font-family: 宋体;\">1</span></div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"padding: 0px 10px; width: 0.590972in; text-align: center; vertical-align: top;\">\r\n			<div style=\"text-align: justify;\">4</div>\r\n			</td>\r\n			<td style=\"padding: 0px 10px; width: 5.25208in; vertical-align: top;\">\r\n			<div style=\"text-align: justify;\"><span style=\"font-family: 宋体;\">说明书*</span><span style=\"font-family: 宋体;\">1</span></div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n','<span style=\"font-size: 16px; color: rgb(102, 102, 102); font-family: 微软雅黑; text-align: justify;\">频服务器主打</span><span style=\"font-size: 16px; color: rgb(102, 102, 102); font-family: 微软雅黑; text-align: justify;\">安防行业视频直播,数字景区直播、视频农场</span><span style=\"font-size: 16px; color: rgb(102, 102, 102); font-family: 微软雅黑; text-align: justify;\">、</span><span style=\"font-size: 16px; color: rgb(102, 102, 102); font-family: 微软雅黑; text-align: justify;\">视频商店</span>','内页01_03.jpg<!--#p8_attach#-->/cms/item/2017_10/11_14/a13e279767fd83cb.jpg<!--#p8_attach#-->/cms/item/2017_10/11_14/a13e279767fd83cb.jpg.thumb.jpg','');
REPLACE INTO `p8_cms_item_product_addon` VALUES ('18','1165','1','','<!--#p8_attach#-->/cms/item/2017_09/30_09/61c3ba6b044a8174.png.thumb.jpg','用于多类型舞台效果渲染，有很多不同的样式','113.247.55.68','113.247.22.1','1506700800','<span medium=\"\" style=\"font-family: \">效果好以后还来</span>','<p><span microsoft=\"\" style=\"font-family: tahoma, arial,; color: rgb(102,102,102)\" yahei=\"\">功率：1500W电子恒温</span></p>\r\n\r\n<p>商品毛重：200.00g</p>\r\n','<p style=\"font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: rgb(51,51,51); widows: 1; line-height: 24px\">玻璃纤维是一种无机非金属的矿物纤维，由于成分不同，可以划分不同类别</p>\r\n\r\n<p style=\"font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: rgb(51,51,51); widows: 1; line-height: 24px\">一般分为：无碱玻纤、中碱玻纤、高碱玻纤，无碱价格最好，耐腐性及耐水性最好。</p>\r\n\r\n<p style=\"font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: rgb(51,51,51); widows: 1; line-height: 24px\">玻璃钢桶槽一般用;表面毡、短切毡、方格布、缠绕纱，表面毡比较细，吸附树脂为90%以上，主要用于设备表层，改善外观平整度。短切毡（交密集的玻璃丝）主要用于内衬防腐层施工，吸附树脂70%以上，有较好的耐腐蚀性。方格布（网格大）一般用于手糊成型的结构层，吸附树脂40%，有优良的机械性能，增加桶槽强度，降低桶槽成本。缠绕纱，主要用于机械型缠绕工艺，吸附树脂40%，有更好的强度及韧性。一般作为大型缠绕型桶槽的加强层。</p>\r\n','b93750be32f42d60.png<!--#p8_attach#-->/cms/item/2017_09/30_09/8f20d29fb3f78b0a.png<!--#p8_attach#-->/cms/item/2017_09/30_09/8f20d29fb3f78b0a.png.thumb.jpg','');
REPLACE INTO `p8_cms_item_product_addon` VALUES ('22','1174','1','','<!--#p8_attach#-->/cms/item/2018_03/02_10/ea68a80a608d5cc8.png','更聪明的电话手表，4G高清通话，实时定位','113.246.92.66','113.246.87.78','1519958452','200万像素高清拍照','200万像素高清拍照','<p style=\"text-align: center;\"><a href=\"<!--#p8_attach#-->/cms/item/2018_03/02_10/e861493b36a81089.jpg\" target=\"_blank\"><img alt=\"pro_03.jpg\" src=\"<!--#p8_attach#-->/cms/item/2018_03/02_10/e861493b36a81089.jpg\" style=\"width: 1156px; height: 1899px;\" /></a></p>\r\n','e3017719190ff1e83db12ee09e7beada_M.png<!--#p8_attach#-->/cms/item/2018_03/02_10/b4eaf6768514221d.png<!--#p8_attach#-->/cms/item/2018_03/02_10/b4eaf6768514221d.png','');
REPLACE INTO `p8_cms_item_product_addon` VALUES ('20','1171','1','','<!--#p8_attach#-->/cms/item/2017_10/11_14/9c808356d2478211.jpg.thumb.jpg','&amp;ldquo;环保监控、安全督查、园区安全和消防预警一体化视频联动系统','113.247.22.7','113.247.22.7','1507704038','<span style=\"font-family: \"Microsoft YaHei\"; font-size: medium;\">敬请期待</span>','<span style=\"font-family: \"Microsoft YaHei\"; font-size: medium;\">敬请期待</span>','<span style=\"color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 19px;\">&ldquo;环保监控、安全督查、园区安全和消防预警一体化视频联动系统。</span>','内页02_03.jpg<!--#p8_attach#-->/cms/item/2017_10/11_14/9c808356d2478211.jpg<!--#p8_attach#-->/cms/item/2017_10/11_14/9c808356d2478211.jpg.thumb.jpg','');
REPLACE INTO `p8_cms_item_product_addon` VALUES ('21','1172','1','','<!--#p8_attach#-->/cms/item/2017_10/11_14/b8ae2e0221bbae8e.jpg.thumb.jpg','一键视频语音呼叫报警、园区安全和消防预警一体化视频联动系统','113.247.22.7','113.247.22.7','1507704095','<span style=\"font-family: \"Microsoft YaHei\"; font-size: medium;\">敬请期待</span>','<span style=\"font-family: \"Microsoft YaHei\"; font-size: medium;\">敬请期待</span>','<span style=\"color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 19px;\">一键视频语音呼叫报警、园区安全和消防预警一体化视频联动系统。</span>','内页03_03.jpg<!--#p8_attach#-->/cms/item/2017_10/11_14/b8ae2e0221bbae8e.jpg<!--#p8_attach#-->/cms/item/2017_10/11_14/b8ae2e0221bbae8e.jpg.thumb.jpg','');
REPLACE INTO `p8_cms_item_tag` VALUES ('1','厦门大学EMBA，中睿信息创始人，PMP','1','0','0');
REPLACE INTO `p8_cms_item_video_` VALUES ('281','video','53','1','admin','耶鲁开放课程：古希腊历史简介','','0','','<!--#p8_attach#-->/cms/item/2012_09/01_21/cdd5f3b451774c11.jpg.thumb.jpg','','','6','耶鲁开放课程：古希腊历史简介耶鲁开放课程：古希腊历史简介','','','','','','1','','0','1346507685','0','1346507685','1346507685','1','','','45','0','0','','','','');
REPLACE INTO `p8_cms_item_video_` VALUES ('282','video','53','1','admin','耶鲁开放课程：1871年后的法国','','0','','<!--#p8_attach#-->/cms/item/2012_09/02_02/ed06de3b55b12af0.jpg','','','6','耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国','','','','','','1','','0','1408464000','0','1408464000','1439792733','1','','','170','0','0','','','','');
REPLACE INTO `p8_cms_item_video_` VALUES ('283','video','53','1','admin','麻省理工开放课程：物流管理专题','','0','','<!--#p8_attach#-->/cms/item/2012_09/01_21/82fa47cae98e580b.jpg.thumb.jpg','','','6','麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题','','','','','','1','','0','1346507832','0','1346507832','1346507832','1','','','86','0','0','','','','');
REPLACE INTO `p8_cms_item_video_` VALUES ('284','video','53','1','admin','开放课程：生物医学工程探索（一）','','0','','<!--#p8_attach#-->/cms/item/2014_09/01_17/593cbe81e81c1655.jpg','','','6','开放课程：生物医学工程探索开放课程：生物医学工程探索','','','','','','1','','0','1346428800','0','1346428800','1409565048','1','','','98','0','1','','','','');
REPLACE INTO `p8_cms_item_video_` VALUES ('285','video','53','1','admin','麻省理工学院：算法导论','','0','','<!--#p8_attach#-->/cms/item/2015_01/11_01/e3aaa9ee0334b92a.jpg','','','3,6','麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院','','','','','','1','','0','1346428800','0','1346428800','1431236286','1','','','285','0','0','','','','');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('1','281','1','','<!--#p8_attach#-->/cms/item/2012_09/01_21/cdd5f3b451774c11.jpg.thumb.jpg','耶鲁开放课程：古希腊历史简介耶鲁开放课程：古希腊历史简介','61.144.100.3','61.144.100.3','1346507685','耶鲁开放课程：古希腊历史简介耶鲁开放课程：古希腊历史简介','390','http://v.ifeng.com/include/exterior.swf?AutoPlay=false&amp;guid=53728945-a466-4e2f-96db-6b2183fd79f9','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('2','282','1','','<!--#p8_attach#-->/cms/item/2012_09/02_02/ed06de3b55b12af0.jpg','耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国','61.144.100.3','175.9.60.69','1408464000','<p>耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国耶鲁开放课程：1871年后的法国</p>','390','http://player.youku.com/player.php/Type/Folder/Fid/25997190/Ob/1/sid/XMTMwOTU2MTg1Ng==/v.swf','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('3','283','1','','<!--#p8_attach#-->/cms/item/2012_09/01_21/82fa47cae98e580b.jpg.thumb.jpg','麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题','61.144.100.3','61.144.100.3','1346507832','麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题麻省理工开放课程：物流管理专题','390','http://v.ifeng.com/include/exterior.swf?AutoPlay=false&amp;guid=13c7dd6b-0d04-4693-ac7a-cb5b2d4761e0','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('4','284','1','','<!--#p8_attach#-->/cms/item/2014_09/01_17/593cbe81e81c1655.jpg','开放课程：生物医学工程探索开放课程：生物医学工程探索','61.144.100.3','14.121.14.170','1346428800','开放课程：生物医学工程探索开放课程：生物医学工程探索','390','http://v.ifeng.com/include/exterior.swf?AutoPlay=false&amp;guid=0830f73b-71a4-4b31-8301-056806318582','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('5','285','1','','<!--#p8_attach#-->/cms/item/2015_01/11_01/e3aaa9ee0334b92a.jpg','麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院','61.144.100.3','116.22.165.33','1346428800','<p>\r\n	麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论</p>\r\n<p>\r\n	麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论</p>\r\n','390','http://v.ifeng.com/include/exterior.swf?AutoPlay=false&amp;guid=15d02f18-e22a-4a3d-b8b3-be0a2942bbd6','450');
REPLACE INTO `p8_cms_model` VALUES ('1','article','文章内容','0','1','a:7:{s:14:\"prev&next_item\";s:1:\"1\";s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('2','product','产品','0','1','a:7:{s:14:\"prev&next_item\";s:1:\"1\";s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('3','photo','图片内容','0','1','a:7:{s:14:\"prev&next_item\";s:1:\"1\";s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:3:\"900\";s:20:\"content_thumb_height\";s:3:\"700\";}');
REPLACE INTO `p8_cms_model` VALUES ('9','govopen','信息公开','0','0','a:6:{s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('10','paper','数字报刊','0','0','a:7:{s:14:\"prev&next_item\";s:1:\"1\";s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('4','video','视频内容','0','1','a:7:{s:12:\"allow_custom\";s:1:\"0\";s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:3:\"800\";s:18:\"frame_thumb_height\";s:3:\"480\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('6','people','人物','0','0','a:6:{s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('5','down','下载内容','0','1','a:9:{s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";s:11:\"hidedownurl\";s:1:\"0\";s:9:\"thunderid\";s:0:\"\";s:10:\"flashgetid\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('8','zlku','资料宝库','0','0','a:6:{s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('12','page','单网页','0','1','a:0:{}');
REPLACE INTO `p8_cms_model_field` VALUES ('1','article','0','content','内容','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','ueditor','','99','','');
REPLACE INTO `p8_cms_model_field` VALUES ('8','photo','0','content','内容','mediumtext','0','0','0','0','','0','1','','a:0:{}','a:0:{}','editor','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('3','product','0','aboutinfo','试用与预订','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor_common','','9','','');
REPLACE INTO `p8_cms_model_field` VALUES ('4','product','0','attrbutes','产品参数','text','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor_basic','','88','','');
REPLACE INTO `p8_cms_model_field` VALUES ('5','product','0','content','产品介绍','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor_common','','99','','');
REPLACE INTO `p8_cms_model_field` VALUES ('6','product','0','pics','图片欣赏','text','0','0','0','1','','0','1','','a:0:{}','a:0:{}','multi_uploader','','6','','');
REPLACE INTO `p8_cms_model_field` VALUES ('7','product','0','pro_down','相关下载','varchar','0','0','0','0','255','0','1','','a:0:{}','a:0:{}','uploader','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('9','photo','0','photourl','图片地址','text','0','0','0','1','','0','1','','a:0:{}','a:0:{}','multi_uploader','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('21','down','0','totaldown','总下载量','mediumint','0','0','0','1','5','0','0','','a:0:{}','a:0:{}','text','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('28','people','0','education','学历','varchar','0','0','0','1','255','0','1','','a:0:{}','a:0:{}','text','','6','','');
REPLACE INTO `p8_cms_model_field` VALUES ('19','down','0','softsize','资源大小','varchar','0','0','0','1','10','0','1','','a:0:{}','a:0:{}','text','','55','K','');
REPLACE INTO `p8_cms_model_field` VALUES ('20','down','0','softurl','资源地址','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','uploader','','44','','');
REPLACE INTO `p8_cms_model_field` VALUES ('47','zlku','0','totaldown','总下载量','mediumint','0','0','0','1','5','0','0','','a:0:{}','a:0:{}','text','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('40','zlku','0','content','资源介绍','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor','','33','','');
REPLACE INTO `p8_cms_model_field` VALUES ('50','govopen','0','geshi','格式','tinyint','1','1','0','1','3','0','1','','a:7:{i:1;s:3:\"DOC\";i:2;s:3:\"TXT\";i:3;s:3:\"JPG\";i:4;s:3:\"PDF\";i:5;s:3:\"MP3\";i:6;s:4:\"MPEG\";i:7;s:4:\"其它\";}','a:0:{}','select','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('24','people','0','award','获奖荣誉','mediumtext','0','0','0','0','','0','1','','a:0:{}','a:0:{}','editor_common','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('58','paper','0','content','内容','mediumtext','0','0','0','1','0','0','1','','a:0:{}','a:0:{}','editor','','99','','');
REPLACE INTO `p8_cms_model_field` VALUES ('14','down','0','content','资源介绍','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor','','33','','');
REPLACE INTO `p8_cms_model_field` VALUES ('44','zlku','0','softlanguage','所属科目','tinyint','0','0','0','1','3','0','1','','a:9:{i:1;s:4:\"语言\";i:2;s:4:\"数学\";i:3;s:4:\"英语\";i:4;s:4:\"政治\";i:5;s:4:\"化学\";i:6;s:4:\"物理\";i:7;s:4:\"生物\";i:8;s:4:\"综合\";i:9;s:8:\"其他科目\";}','a:0:{}','select','','66','','');
REPLACE INTO `p8_cms_model_field` VALUES ('55','govopen','0','wenhao','文号','varchar','1','0','0','0','255','0','1','','a:0:{}','a:0:{}','text','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('57','govopen','0','xinxifenlei','信息分类','varchar','0','0','0','1','50','0','1','','a:0:{}','a:0:{}','text','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('10','video','0','content','内容','mediumtext','0','0','0','1','0','0','1','','a:0:{}','a:0:{}','editor','','99','','');
REPLACE INTO `p8_cms_model_field` VALUES ('11','video','0','video_height','视频高度','smallint','0','0','0','1','5','0','1','390','a:0:{}','a:0:{}','text','','77','像素','');
REPLACE INTO `p8_cms_model_field` VALUES ('12','video','0','video_url','视频地址','varchar','0','0','0','0','255','0','1','http://','a:0:{}','a:2:{s:11:\"thumb_width\";s:3:\"120\";s:12:\"thumb_height\";s:2:\"90\";}','video_uploader','','66','','');
REPLACE INTO `p8_cms_model_field` VALUES ('13','video','0','video_width','视频宽度','smallint','0','0','0','1','5','0','1','450','a:0:{}','a:0:{}','text','','88','像素','');
REPLACE INTO `p8_cms_model_field` VALUES ('48','govopen','0','content','内容','mediumtext','0','0','0','1','0','0','1','','a:0:{}','a:0:{}','editor','','99','','');
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
REPLACE INTO `p8_cms_model_field` VALUES ('60','page','0','content','','mediumtext','0','0','0','1','0','0','1','','a:0:{}','a:0:{}','editor','','99','','');