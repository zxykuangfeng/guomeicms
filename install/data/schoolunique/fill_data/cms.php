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
) ENGINE=MyISAM AUTO_INCREMENT=335 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=933 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=933 DEFAULT CHARSET=utf8;

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
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `source` varchar(255) NOT NULL DEFAULT '',
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
  KEY `level` (`level`,`list_order`),
  KEY `timestamp` (`timestamp`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=1366 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=572 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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
REPLACE INTO `p8_cms_attachment` VALUES ('282','item','1320','1','20121031_115728.mp4','video/mp4','mp4','9472987','113.246.111.251','cms/item/2020_01/15_18/04bcd16d4fefd5a6.mp4','0','0','1579082546');
REPLACE INTO `p8_cms_attachment` VALUES ('283','item','0','1','test.mp4','video/mp4','mp4','10246115','113.246.111.251','cms/item/2020_01/15_18/06d133e47db47164.mp4','0','0','1579082593');
REPLACE INTO `p8_cms_attachment` VALUES ('284','item','0','1','20121021_164716.mp4','video/mp4','mp4','16777215','113.246.111.251','cms/item/2020_01/15_18/9ca3c3cb79d5a47f.mp4','0','0','1579082632');
REPLACE INTO `p8_cms_attachment` VALUES ('285','item','1321','2','图层 10.png','image/png','png','69789','36.148.55.8','cms/item/2020_02/16_20/219919077f47ff3a.png','1','0','1581856968');
REPLACE INTO `p8_cms_attachment` VALUES ('286','item','1322','2','图层 10 拷贝.png','image/png','png','82517','36.148.55.8','cms/item/2020_02/16_20/5ae318209e32d92f.png','1','0','1581857034');
REPLACE INTO `p8_cms_attachment` VALUES ('287','item','1323','2','图层 10 拷贝 2.png','image/png','png','80834','36.148.55.8','cms/item/2020_02/16_20/eb96a315e2f23be9.png','1','0','1581857076');
REPLACE INTO `p8_cms_attachment` VALUES ('288','item','1333','5','D333A096CEFFD46ED6E97BB9413_9B782EA1_17179.jpg','image/jpeg','jpg','94585','36.157.141.61','cms/item/2020_02/26_15/0a570913838eb596.jpg','2','0','1582703108');
REPLACE INTO `p8_cms_attachment` VALUES ('289','item','1333','5','0E4B4E4A70D301556C3CC825872_2E9E1064_22F26.jpg','image/jpeg','jpg','143142','36.157.141.61','cms/item/2020_02/26_15/639528263437df6b.jpg','2','0','1582703163');
REPLACE INTO `p8_cms_attachment` VALUES ('290','item','1333','5','3936F53BBC799214F2C78883A5C_5617C877_13465.jpg','image/jpeg','jpg','78949','36.157.141.61','cms/item/2020_02/26_15/b29805cd21c8ec8f.jpg','2','0','1582703227');
REPLACE INTO `p8_cms_attachment` VALUES ('291','item','1333','5','5DFA60485CAF68B72A4631EFD47_FB730D26_16977.jpg','image/jpeg','jpg','92535','36.157.141.61','cms/item/2020_02/26_15/474dc878cb1de900.jpg','2','0','1582703300');
REPLACE INTO `p8_cms_attachment` VALUES ('292','item','1333','5','A16305E2776DC3ECA5055303304_55974E7B_119E0.jpg','image/jpeg','jpg','72160','36.157.141.61','cms/item/2020_02/26_15/86006a0eac6c3c07.jpg','2','0','1582703369');
REPLACE INTO `p8_cms_attachment` VALUES ('293','item','1333','5','0E4B4E4A70D301556C3CC825872_2E9E1064_22F26.jpg','image/jpeg','jpg','143142','36.157.141.61','cms/item/2020_02/26_15/3877c07be7e00597.jpg','2','0','1582703809');
REPLACE INTO `p8_cms_attachment` VALUES ('294','item','1334','5','1576224558833.jpg','image/jpeg','jpg','132318','36.157.141.61','cms/item/2020_02/26_16/4563b77dc741831f.jpg','1','0','1582706181');
REPLACE INTO `p8_cms_attachment` VALUES ('295','item','1334','5','1576224558833.jpg','image/jpeg','jpg','132318','36.157.141.61','cms/item/2020_02/26_16/385afef771a36af7.jpg','1','0','1582706272');
REPLACE INTO `p8_cms_attachment` VALUES ('296','item','1335','5','1575114315355.jpg','image/jpeg','jpg','97330','36.157.141.61','cms/item/2020_02/26_16/20371e3143d36278.jpg','1','0','1582706494');
REPLACE INTO `p8_cms_attachment` VALUES ('297','item','1335','5','1575114329416.png','image/png','png','339283','36.157.141.61','cms/item/2020_02/26_16/c2278f557cfe91d7.png','1','0','1582706521');
REPLACE INTO `p8_cms_attachment` VALUES ('298','item','1335','5','1575114329416.png','image/png','png','339283','36.157.141.61','cms/item/2020_02/26_16/b5386e55a818e2d7.png','1','0','1582706547');
REPLACE INTO `p8_cms_attachment` VALUES ('299','item','1336','5','E41D237AAA5E47E3895DF1738C0_CC78FCC9_18669.jpg','image/jpeg','jpg','99945','36.157.141.61','cms/item/2020_02/26_17/cca72ccb06cf4bee.jpg','2','0','1582707746');
REPLACE INTO `p8_cms_attachment` VALUES ('300','item','1336','5','E41D237AAA5E47E3895DF1738C0_CC78FCC9_18669.jpg','image/jpeg','jpg','99945','36.157.141.61','cms/item/2020_02/26_17/b06c741ec00052e3.jpg','2','0','1582707771');
REPLACE INTO `p8_cms_attachment` VALUES ('301','item','1337','5','e0eba684-f555-496f-a89f-c4046821ea98.jpg','image/jpeg','jpg','161461','36.157.141.61','cms/item/2020_02/26_17/72687b6eefb42a8f.jpg','2','0','1582708324');
REPLACE INTO `p8_cms_attachment` VALUES ('302','item','1337','5','0bf61230-381f-4562-92a4-5ecbeb75ce78.jpg','image/jpeg','jpg','45537','36.157.141.61','cms/item/2020_02/26_17/2af08f5b0efe88c0.jpg','2','0','1582708348');
REPLACE INTO `p8_cms_attachment` VALUES ('303','item','1337','5','0bf61230-381f-4562-92a4-5ecbeb75ce78.jpg','image/jpeg','jpg','45537','36.157.141.61','cms/item/2020_02/26_17/52a11c0f6f192f9f.jpg','2','0','1582708437');
REPLACE INTO `p8_cms_attachment` VALUES ('304','item','1338','5','f66c6fad-0c62-4630-bc8a-cf35a1b92852.jpg','image/jpeg','jpg','337211','36.157.141.61','cms/item/2020_02/26_17/128a5cf0215becb5.jpg','1','0','1582708736');
REPLACE INTO `p8_cms_attachment` VALUES ('305','item','1338','5','a0e784e3-aa14-4f59-85d8-b7b08e46b55b.jpg','image/jpeg','jpg','343722','36.157.141.61','cms/item/2020_02/26_17/097809f5e355fd89.jpg','1','0','1582708765');
REPLACE INTO `p8_cms_attachment` VALUES ('306','item','1338','5','9e3a005e-a04c-4bb4-844e-1afb943450d7.jpg','image/jpeg','jpg','336095','36.157.141.61','cms/item/2020_02/26_17/37ff5e80d0a37ee9.jpg','1','0','1582708794');
REPLACE INTO `p8_cms_attachment` VALUES ('307','item','1338','5','a0e784e3-aa14-4f59-85d8-b7b08e46b55b.jpg','image/jpeg','jpg','343722','36.157.141.61','cms/item/2020_02/26_17/0f0d592f1856380b.jpg','1','0','1582708914');
REPLACE INTO `p8_cms_attachment` VALUES ('308','item','1339','5','8e655e2b270a41d5865964c54085a230.png','image/png','png','215396','36.157.141.61','cms/item/2020_02/26_17/1b320148244434bd.png','2','0','1582710215');
REPLACE INTO `p8_cms_attachment` VALUES ('309','item','1339','5','rea_17.jpg','image/jpeg','jpg','16822','36.157.141.61','cms/item/2020_02/26_17/4128bb2a0f56aa9a.jpg','0','0','1582710246');
REPLACE INTO `p8_cms_attachment` VALUES ('310','item','1340','5','rea_11.jpg','image/jpeg','jpg','16523','36.157.141.61','cms/item/2020_02/26_17/3c48f5485338da98.jpg','0','0','1582710752');
REPLACE INTO `p8_cms_attachment` VALUES ('311','item','1341','5','rea_09.jpg','image/jpeg','jpg','22422','36.157.141.61','cms/item/2020_02/26_17/559576cf4e8d9625.jpg','0','0','1582711016');
REPLACE INTO `p8_cms_attachment` VALUES ('312','item','1341','5','0E5BEAD1A2DBA9C0C0F2135534A_D80C1293_1F402.jpg','image/jpeg','jpg','128002','36.157.141.61','cms/item/2020_02/26_17/e3ccefb56c31c9d6.jpg','2','0','1582711039');
REPLACE INTO `p8_cms_attachment` VALUES ('313','item','1341','5','1019E1EA2C1F466D27FC060EB71_C873AED3_200D0.jpg','image/jpeg','jpg','131280','36.157.141.61','cms/item/2020_02/26_17/b35dcb2008c95414.jpg','2','0','1582711064');
REPLACE INTO `p8_cms_attachment` VALUES ('314','item','1342','5','CA35006CE8A62957DC5E0B4E579_7FB3CFA1_5F730.png','image/png','png','390960','36.157.141.61','cms/item/2020_02/26_18/4ac885a28469ce71.png','1','0','1582711321');
REPLACE INTO `p8_cms_attachment` VALUES ('315','item','1342','5','2466E73BF08785685571576BE98_43E61D7D_7B608.png','image/png','png','505352','36.157.141.61','cms/item/2020_02/26_18/a16e49e1fcd0f220.png','1','0','1582711351');
REPLACE INTO `p8_cms_attachment` VALUES ('316','item','1342','5','rea_07.jpg','image/jpeg','jpg','18752','36.157.141.61','cms/item/2020_02/26_18/b473c345bbcc0a29.jpg','0','0','1582711425');
REPLACE INTO `p8_cms_attachment` VALUES ('317','item','1344','5','0ae789a9cf5f4fc2b28b4790ea95c8db.jpg','image/jpeg','jpg','77527','36.157.141.61','cms/item/2020_02/26_18/251e9f8b65877349.jpg','1','0','1582712040');
REPLACE INTO `p8_cms_attachment` VALUES ('318','item','1344','5','351bc6fcdaa64aaa8614cfdfbdd7c97e.jpg','image/jpeg','jpg','18082','36.157.141.61','cms/item/2020_02/26_18/e95df59c73f53b75.jpg','1','0','1582712067');
REPLACE INTO `p8_cms_attachment` VALUES ('319','item','1344','5','dbc922c5ba09497fa4c78bb783835964.jpg','image/jpeg','jpg','15963','36.157.141.61','cms/item/2020_02/26_18/178756f7b2e034d3.jpg','1','0','1582712092');
REPLACE INTO `p8_cms_attachment` VALUES ('320','item','1344','5','351bc6fcdaa64aaa8614cfdfbdd7c97e.jpg','image/jpeg','jpg','18082','36.157.141.61','cms/item/2020_02/26_18/591d233d9dcfd23d.jpg','1','0','1582712217');
REPLACE INTO `p8_cms_attachment` VALUES ('321','item','1347','5','778.jpg','image/jpeg','jpg','337074','113.247.22.80','cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','2','0','1582727599');
REPLACE INTO `p8_cms_attachment` VALUES ('322','item','1349','5','7791.jpg','image/jpeg','jpg','62729','113.247.22.80','cms/item/2020_02/26_22/d57883c29273e0f4.jpg','2','0','1582727791');
REPLACE INTO `p8_cms_attachment` VALUES ('323','item','1320','5','视频模型封面.jpg','image/jpeg','jpg','81188','113.247.22.80','cms/item/2020_02/26_22/08dbf0db2ae25eec.jpg','2','0','1582729165');
REPLACE INTO `p8_cms_attachment` VALUES ('324','item','1320','5','视频模型文件.mp4','video/mp4','mp4','1720644','113.247.22.80','cms/item/2020_02/26_22/858bb21f8623485d.mp4','0','0','1582729194');
REPLACE INTO `p8_cms_attachment` VALUES ('325','item','1188','1','视频模型封面.jpg','image/jpeg','jpg','81188','113.247.20.49','cms/item/2020_02/27_11/845ff247925b3cf5.jpg','2','0','1582773556');
REPLACE INTO `p8_cms_attachment` VALUES ('326','item','1199','1','1.jpg','image/jpeg','jpg','412253','113.247.23.222','cms/item/2020_04/11_22/d48db809fd837e12.jpg','2','0','1586617145');
REPLACE INTO `p8_cms_attachment` VALUES ('327','item','1199','1','2.jpg','image/jpeg','jpg','138462','113.247.23.222','cms/item/2020_04/11_22/6f02fe967e5282df.jpg','2','0','1586617185');
REPLACE INTO `p8_cms_attachment` VALUES ('328','item','1198','1','4.jpg','image/jpeg','jpg','174776','113.247.23.222','cms/item/2020_04/11_23/c9e8c49aab963485.jpg','2','0','1586617596');
REPLACE INTO `p8_cms_attachment` VALUES ('329','item','1198','1','4.jpg','image/jpeg','jpg','174776','113.247.23.222','cms/item/2020_04/11_23/4ee29edc3681e5ce.jpg','2','0','1586618195');
REPLACE INTO `p8_cms_attachment` VALUES ('330','item','1197','1','3.jpg','image/jpeg','jpg','158377','113.247.23.222','cms/item/2020_04/11_23/7a4d91ded59ea744.jpg','2','0','1586618355');
REPLACE INTO `p8_cms_attachment` VALUES ('331','item','1196','1','5.jpg','image/jpeg','jpg','266819','113.247.23.222','cms/item/2020_04/11_23/23dad8ddda2ae9d8.jpg','2','0','1586618405');
REPLACE INTO `p8_cms_attachment` VALUES ('332','item','1313','1','qinghua.jpg','image/jpeg','jpg','39284','113.247.23.222','cms/item/2020_04/12_09/996bf7d495a5b20e.jpg','2','0','1586654640');
REPLACE INTO `p8_cms_attachment` VALUES ('333','item','1312','1','qinghua214.jpg','image/jpeg','jpg','60103','113.247.23.222','cms/item/2020_04/12_09/282163366352d397.jpg','1','0','1586655403');
REPLACE INTO `p8_cms_category` VALUES ('15','0','站内公告','z','article','','','','1','6','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','zhanneigonggao','20','article/list','article/list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list','1','','','','0','','0','a:5:{s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";}');
REPLACE INTO `p8_cms_category` VALUES ('26','15','站内公告','z','article','','','','2','6','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','zhanneigonggao/zhanneigonggao','20','article/list','article/list_mobile','article/view2','article/view_mobile','common/ico_title/list016','mobile/list','0','','','','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('838','832','学校设施','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','gonggongfuwu/xuexiaoxiaoli','30','article/list','article/list_mobile4','article/view','article/view_mobile','adaption/ico_title/dot_title_14px-1a','mobile/list4','10','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('45','0','招生就业','z','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','yuanwugongkai','30','article/list_daohan-zhaosheng','article/list_jigou','article/view','article/view_mobile','common/ico_title/list016','mobile/list','200','','','','0','','1','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('46','0','人才培养','r','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xuekejianshe','20','article/big_list','article/big_list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','215','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('49','0','合作交流','h','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','zhaoshengjiuye','20','article/list_hezuo1','article/list_mobile8','article/view','article/view','cms/article/list','mobile/list','190','','','category_801','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('840','831','通知公告','t','article','','','','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun/xueshujiangzuo','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/dot_title_14px-102','mobile/list3','6','','','','0','','0','a:15:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('874','819','科研成果','k','article','','','','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhaoshengpeiyang/xueshujiangzuo','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','1','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('67','0','师资队伍','s','article','','','','1','2','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','keyandongtai','20','article/big_list','article/big_list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list','230','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('834','832','办公电话','b','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','gonggongfuwu/bangongdianhua','30','article/list','article/list','article/view1','article/view','adaption/ico_title/dot_title_14px-1a','mobile/list','8','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('833','832','学校校历','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','gonggongfuwu/xuexiaoxiaoli','30','article/list','article/list_mobile4','article/view','article/view_mobile','adaption/ico_title/dot_title_14px-1a','mobile/list3','6','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('873','716','奖助贷勤','j','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueshenggongzuo/xueshujiangzuo','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','4','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('903','831','学院动态','x','article','','','','2','14','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun/xueyuanlingdao','30','article/list','article/list_mobile4','article/view','article/view_mobile','adaption/pic_title_summary/list026','mobile/list4','8','','','','0','','0','a:17:{s:6:\"target\";s:5:\"_self\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('836','832','信息公开','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','gonggongfuwu/xinxigongkai','30','article/list','article/list_mobile4','article/view','article/view_mobile','adaption/ico_title/dot_title_14px-1a','mobile/list3','4','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('837','832','院报','y','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','gonggongfuwu/yuanbao','30','article/list','article/list_mobile4','article/view','article/view_mobile','adaption/ico_title/dot_title_14px-1a','mobile/list3','2','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('143','0','下载中心','x','down','','','','1','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xiazaizhongxin','20','down/big_list','down/list_mobile','down/view','down/view_mobile','common/ico_title/list016','mobile/list','35','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('149','143','其他下载','q','down','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xiazaizhongxin/qitaxiazai','30','article/list','down/list_mobile','down/view','down/view_mobile','common/ico_title/list016','mobile/list','0','','','category_144','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('867','0','重点学科','z','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun','30','article/big_list','article/big_list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list3','225','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('868','867','学科专业','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun/xueyuanlingdao','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/pic_title_summary/list025','mobile/list3','8','','','category_868','0','','0','a:13:{s:6:\"target\";s:5:\"_self\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('869','867','学科平台','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun/xueshujiangzuo','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','4','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('870','867','重点学科','z','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun/tongzhigonggao','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','6','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('146','143','文档下载','w','down','','','','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xiazaizhongxin/wendangxiazai','30','down/list','down/list_mobile','down/view','down/view_mobile','common/ico_title/list016','mobile/list','7','','','category_144','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('148','143','表格下载','b','down','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xiazaizhongxin/biaogexiazai','20','down/list','down/list_mobile','down/view','down/view_mobile','common/ico_title/list016','mobile/list','3','','','category_144','0','','0','a:12:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('716','0','学生工作','x','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xueshenggongzuo','20','article/big_list','article/big_list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list3','170','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('889','0','专题专栏','z','article','','','','1','6','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhuantizhuanlan','30','article/list_new_zt1','article/big_list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list','8','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('878','45','招生动态','z','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','yuanwugongkai/zhaoshengdongtai','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','3','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('875','819','教学管理','j','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhaoshengpeiyang/xueshujiangzuo','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','6','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('876','716','学子风采','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueshenggongzuo/xueshujiangzuo','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','2','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('877','716','学工动态','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueshenggongzuo/xueshujiangzuo','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','10','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('776','0','学院概况','x','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','xueyuangaikuang','30','article/big_list','article/list_mobile','category/view','article/view_mobile','common/ico_title/list014','mobile/list','255','','','','0','','0','a:15:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:50;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('819','0','教学科研','j','article','','','','1','4','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhaoshengpeiyang','30','article/big_list','article/list_jigou5','article/view','article/view','cms/article/list','mobile/list','220','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('835','832','校园地图','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','gonggongfuwu/xiaoyuanditu','30','article/list','article/list_mobile4','article/view','article/view_mobile','adaption/ico_title/dot_title_14px-1a','mobile/list3','0','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('841','49','国内交流','g','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhaoshengjiuye/guoneijiaoliu','30','article/list1_2','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list4','2','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('842','49','国际交流','g','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhaoshengjiuye/guojijiaoliu','30','article/list1_2','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list4','3','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('843','67','教授','j','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','keyandongtai/jiaoshou','30','article/list6','article/list_mobile4','article/view','article/view_mobile','adaption/ico_title/dot_title_shizhiduiwu','mobile/list4','8','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('824','776','校园风景','x','photo','','','','2','6','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueyuangaikuang/xuexiaofengjing','30','photo/list','photo/list2_mobile','photo/view','photo/view','common/pic_title/list034','mobile/list4','6','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('845','67','讲师','j','article','','','','2','2','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','keyandongtai/jiangshi','30','article/list6','article/list_mobile4','article/view2','article/view_mobile','adaption/ico_title/dot_title_shizhiduiwu','mobile/list4','4','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('872','819','科研动态','k','article','','','','2','3','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.shtml','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhaoshengpeiyang/xueyuanlingdao','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/pic_title_summary/list025','mobile/list4','3','','','category_872','0','','0','a:13:{s:6:\"target\";s:5:\"_self\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:60;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('820','0','院系部门','y','article','','','','1','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','yuanxishezhi','30','article/list_jigou1','article/list_mobile3','article/view','article/view','cms/article/list','mobile/list','243','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('844','67','副教授','f','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','keyandongtai/fujiaoshou','30','article/list6','article/list_mobile4','article/view2','article/view_mobile','adaption/ico_title/dot_title_shizhiduiwu','mobile/list4','6','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('839','831','学术讲座','x','article','','','','2','4','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun/tongzhigonggao','30','article/list','article/list_mobile4','article/view','article/view_mobile','adaption/ico_title/dot_title_14px-11','mobile/list3','4','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('828','820','院系设置','y','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','yuanxishezhi/yuanxishezhi','30','article/list_jigou_yuanxi1','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','8','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('829','820','党群组织','d','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','yuanxishezhi/dangqunzuzhi','30','article/list_jigou_dangqun','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','6','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('830','820','行政机构','x','article','','','','2','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','yuanxishezhi/xingzhengjigou','30','article/list_jigou_xinzheng1','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','4','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('831','0','新闻资讯','x','article','','','','1','25','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun','30','article/big_list','article/big_list_mobile','article/view','article/view_mobile','common/ico_title/dot_title_14px-100','mobile/list3','250','','','','0','','1','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('832','0','公共服务','g','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','gonggongfuwu','30','article/list_daohan-ggfuwu3','article/list_jigou_xiaoyuanshenghuo','article/view','article/view_mobile','cms/article/list','mobile/list3','180','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('866','831','媒体报道','m','article','','','','2','6','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun/xueshujiangzuo','30','article/list','article/list_mobile4','article/view','article/view_mobile','adaption/ico_title/dot_title_14px-11','mobile/list3','0','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:100;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('879','45','就业动态','j','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','yuanwugongkai/jiuyedongtai','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','2','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('880','46','研究生教育','y','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xuekejianshe/yanjiushengjiaoyu','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','8','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('881','46','本科生教育','b','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xuekejianshe/benkeshengjiaoyu','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','6','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('882','46','继续教育','j','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xuekejianshe/jixujiaoyu','30','article/list','article/list_mobile4','article/view','article/view_mobile','common/ico_title/list016','mobile/list3','4','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}}');
REPLACE INTO `p8_cms_category` VALUES ('883','0','视频中心','s','video','','','','1','6','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','shipinzhongxin','30','video/video_index','video/big_list_mobile','video/view','video/view_mobile','cms/video/list','mobile/list','50','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('884','883','新闻视频','x','video','','','','2','6','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','shipinzhongxin/xinwenshipin','30','video/list','video/list_mobile','video/view','video/view_mobile','common/pic_title/list036','mobile/list','0','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('885','883','活动视频','h','video','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','shipinzhongxin/huodongshipin','30','video/list','video/list_mobile','video/view','video/view_mobile','common/pic_title/list036','mobile/list','0','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('886','0','图片中心','t','photo','','','','1','4','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','tupianzhongxin','30','photo/big_list','photo/big_list_mobile','photo/view','photo/view_mobile','cms/photo/list','mobile/list','40','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('887','886','校园风光','x','photo','','','','2','4','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','tupianzhongxin/xiaoyuanfengguang','30','photo/list3','photo/list_mobile','photo/view','photo/view_mobile','common/pic_title/list036','mobile/list','0','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('888','886','活动设施','h','photo','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','tupianzhongxin/huodongsheshi','30','photo/list','photo/list_mobile','photo/view','photo/view_mobile','common/pic_title/list036','mobile/list','0','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('890','889','三严三实','s','article','','','','2','2','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhuantizhuanlan/sanyansanshi','30','article/list_new_zt2','article/list_mobile','article/view_zhuanti','article/view_mobile','adaption/pic_title_summary/list024','mobile/list','0','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('891','889','安全教育','a','article','','','','2','2','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhuantizhuanlan/anquanjiaoyu','30','article/list','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','0','','','','0','','0','a:13:{s:6:\"target\";s:6:\"_blank\";s:17:\"list_title_length\";i:0;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:13:\"administrator\";a:0:{}s:3:\"fee\";a:2:{s:11:\"credit_type\";i:0;s:6:\"credit\";i:0;}s:8:\"allow_ip\";a:5:{s:7:\"enabled\";i:0;s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}}');
REPLACE INTO `p8_cms_category` VALUES ('892','0','登录统一入口','d','article','','','','2','0','0','{$core_url}/dl.html','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','denglu','30','article/list_login','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','5','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('895','776','学院简介','x','page','','','','4','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueyuangaikuang/xueyuanjianjie','30','page/list','page/list','page/view','page/view','cms/page/list','mobile/list','10','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('896','776','学院领导','x','page','','','','4','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueyuangaikuang/xueyuanlingdao','30','article/list_lingdao1','page/list','page/view','page/view','cms/page/list','mobile/list','8','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('897','776','历史沿革','l','page','','','','4','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueyuangaikuang/lishiyange','30','page/list','page/list','page/view','page/view','cms/page/list','mobile/list','4','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('898','776','联系我们','l','page','','','','4','1','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xueyuangaikuang/lianxiwomen','30','page/list','page/list','page/view','page/view','cms/page/list','mobile/list','0','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('912','0','访问身份','f','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','fangwenshenfen','30','article/big_list','article/big_list_mobile','article/view','article/view_mobile','cms/article/list','mobile/list','240','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('913','912','学生','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','fangwenshenfen/xuesheng','30','article/daohang_xuesheng2','article/list','article/view','article/view','cms/article/list','mobile/list','8','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('914','912','教职工','j','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','fangwenshenfen/jiaozhigong','30','article/daohang_jiaozhiyuangong2','article/list','article/view','article/view','cms/article/list','mobile/list','6','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('915','912','校友','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','fangwenshenfen/xiaoyou','30','article/daohang_xiaoyou2','article/list','article/view','article/view','cms/article/list','mobile/list','4','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('916','912','考生及访客','k','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','fangwenshenfen/kaoshengjifangke','30','article/daohang_kaosheng2','article/list','article/view','article/view','cms/article/list','mobile/list','2','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('924','0','新闻网','x','article','','','','1','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun','30','xinwen/list-xinwen3','article/big_list_mobile','article/view','article/view_mobile','common/ico_title/dot_title_14px-100','mobile/list3','250','','','','0','','1','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:10:\"list_order\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('921','924','新闻网2','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun/xinwenwang2','30','xinwen/list-xinwen2','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','248','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('922','924','新闻网3','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun/xinwenwang3','30','xinwen/list-xinwen','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','247','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('923','924','新闻网4','x','article','','','','2','0','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','xinwenzixun/xinwenwang4','30','xinwen/list-xinwen4','article/list_mobile','article/view','article/view_mobile','common/ico_title/list016','mobile/list','246','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_category` VALUES ('929','889','优秀建议专栏','y','article','','','','2','2','0','{$core_url}/html/{$id}/#list-{$page}.html#','{$core_m_url}/{$id}/#list-{$page}.html#','{$core_url}/html/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','{$core_m_url}/{$cid}/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html','zhuantizhuanlan/youxiujianyizhuanlan','30','article/list_new_zt2','article/list_mobile','article/view_zhuanti','article/view_mobile','adaption/pic_title_summary/list024','mobile/list','0','','','','0','','0','a:17:{s:6:\"target\";s:6:\"_blank\";s:11:\"enable_show\";i:0;s:7:\"orderby\";s:9:\"timestamp\";s:12:\"orderby_desc\";i:0;s:17:\"list_title_length\";i:120;s:24:\"list_title_length_mobile\";i:40;s:21:\"list_title_length_dot\";s:1:\"0\";s:28:\"list_title_length_mobile_dot\";s:1:\"0\";s:19:\"list_pages_template\";s:0:\"\";s:26:\"list_pages_template_mobile\";s:20:\"page_template_mobile\";s:19:\"view_pages_template\";s:18:\"base_page_template\";s:7:\"summary\";s:0:\"\";s:7:\"linkurl\";s:0:\"\";s:10:\"need_login\";i:0;s:8:\"allow_ip\";a:5:{s:7:\"enabled\";s:1:\"0\";s:9:\"collectip\";a:0:{}s:7:\"beginip\";s:0:\"\";s:5:\"endip\";s:0:\"\";s:9:\"ruleoutip\";a:0:{}}s:3:\"fee\";a:2:{s:6:\"credit\";i:0;s:11:\"credit_type\";i:0;}s:13:\"administrator\";a:0:{}}');
REPLACE INTO `p8_cms_item` VALUES ('119','article','企业站内公告1','','0','','26','','','1','','','','admin','','企业站内公告','1','','2','0','','0','1308558474','','0','1308558474','1308558474','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('120','article','企业站内公告2','','0','','26','','','1','','','','admin','','企业站内公告','1','','4','0','','0','1308558482','','0','1308558482','1308558482','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('121','article','企业站内公告3','','0','','26','','','1','','','','admin','','企业站内公告','1','','10','0','','0','1308558488','','0','1308558488','1308558488','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('122','article','企业站内公告4','','0','','26','','','1','','','','admin','','企业站内公告','1','','12','0','','0','1308558495','','0','1308558495','1308558495','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('123','article','企业站内公告5','','0','','26','','','1','','','','admin','','企业站内公告','1','','9','0','','0','1308558502','','0','1308558502','1308558502','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('124','article','企业站内公告6','','0','','26','','','1','','','','admin','','企业站内公告','1','','10','0','','0','1308558508','','0','1308558508','1308558508','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1054','article','学院领导','','0','','903','','','1','','','','admin','','校党委书记：易佐永主持党委全面工作。校长：庾建设主持行政全面工作。校党委副书记：赖卫华分管组织干部、宣传、思想政治理论课工作、统战、离退休、计划生育、校友会工作。副校长：董皞分管财务、高等职业教育、成人教育、体育、中小学校长和师资培训、直属单位工作。','1','','312','0','','0','1408809600','','1408851788','1431064723','1408809600','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1160','article','谭文长','','0','','903','<!--#p8_attach#-->/cms/item/2017_02/17_09/0632f21ab2ee08dd.jpg','','1','','','','admin','6','主持党委工作','1','','41','0','','0','1487295833','','1487295833','1487295936','1487295833','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1161','article','安晓朋','','0','','903','<!--#p8_attach#-->/cms/item/2017_02/17_09/5bce7731b94874f8.jpg','','1','','','','admin','6','协助书记负责安全维稳丶学生丶共青团及工会工作，主管学生工作处。','1','','53','0','','0','1487296076','','1487296076','1487296076','1487296076','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1164','article','张老师','','0','','845','','','1','','','','admin','','23423432','1','','11','0','','0','1495294748','','1495294748','1495294748','1495294748','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1165','article','张老师','','0','','845','','','1','','','','admin','','23423432','1','','14','0','','0','1495294754','','1495294754','1495294754','1495294754','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1170','article','科技大学2017年秋天最新的校园风景拍摄图','','0','','866','<!--#p8_attach#-->/cms/item/2017_05/21_10/af32a2c6aa3e9b9a.jpg','','1','','','','admin','6','它们的头上各有一盏门灯,像两颗夜明珠镶嵌在上面。门柱中间,有一块大理石,上面刻着“余姚市阳明小学”这七个闪烁','1','','32','0','','0','1495296000','','1495332835','1586618581','1495296000','1','admin168.','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1175','article','科技大学2017年度新建的校园操场和运动会跑道','','0','','866','<!--#p8_attach#-->/cms/item/2017_05/22_06/cd2129dbb3b55922.jpg','','1','','','','admin','6','沿着通向学校的劳动路,我来到了静谧的校门前。早晨,太阳光照在校园里,像给校园披上了一件金色的外套,壮观极了!校门口有两个像卫兵似的门柱','1','','28','0','','0','1495405974','','1495405974','1586618619','1495405974','1','admin168.','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1177','article','科技大学2017年秋天最新的校园风景拍摄图','','0','','903','<!--#p8_attach#-->/cms/item/2017_05/21_10/af32a2c6aa3e9b9a.jpg','','0','','','','admin','6','它们的头上各有一盏门灯,像两颗夜明珠镶嵌在上面。门柱中间,有一块大理石,上面刻着“余姚市阳明小学”这七个闪烁','1','','24','0','','0','1495406318','','1495406318','1495406318','1495406318','1','admin','1497194716','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1178','article','科技大学2017年度新建的校园操场和运动会跑道','','0','','903','<!--#p8_attach#-->/cms/item/2017_05/22_06/cd2129dbb3b55922.jpg','','0','','','','admin','6','沿着通向学校的劳动路,我来到了静谧的校门前。早晨,太阳光照在校园里,像给校园披上了一件金色的外套,壮观极了!校门口有两个像卫兵似的门柱','1','','28','0','','0','1495406318','','1495406318','1495406318','1495406318','1','admin','1497194717','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1183','article','袁军副校长率团参加第八届国际博士研究生学术研讨会','','0','','903','','','1','','','','admin','','2012年7月22至23日，袁军副校长率中国传媒大学师生学术代表团参加了在泰国曼谷朱拉隆公大学举办的第八届国际博士研究生学术研讨会。会议期间，袁军副校长与相关国际合作院校负责人就深化研究生合作办学、学术交流等事','1','','13','0','','0','1493689051','','1497191599','1497191599','1493689051','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1184','article','2012夏季学期系列：坚守在火灾现场 2012夏季学期系列：坚守在火灾现场 ','','0','','903','','','1','','','','admin','','6月28日下午，台州广播电视台《600全民新闻》节目办公室的电话骤然响起，原来是该市黄岩区一家制造太空杯的工厂发生火灾。我校实习记者徐鑫和电视台另外两名记者带上设备，立即驱车赶赴火灾现场实施报道。火灾现场一','1','','24','0','','0','1493689532','','1497195254','1497195254','1493689532','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1185','article','袁军副校长率团参加第八届国际博士研究生学术研讨会','','0','','830','','','1','','','','admin','','2012年7月22至23日，袁军副校长率中国传媒大学师生学术代表团参加了在泰国曼谷朱拉隆公大学举办的第八届国际博士研究生学术研讨会。会议期间，袁军副校长与相关国际合作院校负责人就深化研究生合作办学、学术交流等事','1','','9','0','','0','1493618517','','1497196116','1497196116','1493618517','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1186','article','专家上海研讨大城市规划 绿色可持续城市仍为热点','','0','','840','','','1','','','','admin','','&ldquo;新型城镇化&rdquo;现已成为一个全民议题。如何走新型城镇化道路，需要全社会尤其是&ldquo;规划师&rdquo;的探索与创新。作为担当城乡规划重任的&ldquo;青年规划师&rdquo;的思考及探索，将为中国新型城镇化实践提供新的思路。　　17日，以&ldquo;新型城镇化与城乡规','1','','18','0','','0','1493689051','','1497196372','1497196372','1493689051','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1187','video','麻省理工学院：算法导论','','0','','884','<!--#p8_attach#-->/cms/item/2017_07/27_14/c7dbb3c44f1a9192.jpg','','1','','','','admin','3,6','麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工','1','','57','0','','0','1468392451','','1501138051','1582729273','1468392451','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1188','video','操作系统','','0','','884','<!--#p8_attach#-->/cms/item/2020_02/27_11/845ff247925b3cf5.jpg','','1','','','','admin','6','操作系统（Operating System，简称OS）是管理和控制计算机硬件与软件资源的计算机程序，是直接运行在“裸机”上的最基本的系统软件，任何其他软件都必须在操作系统的支持下才能运行。操作系统是用户和计算机的接口，同时也是计算机硬件和其他软件的接口。操作','1','','41','0','','0','1469548800','','1501138108','1582773560','1469548800','1','admin168.','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1189','video','计算机组原理','','0','','884','<!--#p8_attach#-->/cms/item/2017_07/27_14/d9e66c4bd1e07169.jpg','','1','','','','admin','6','课程在以培养学生创新能力和解决实际问题的能力为主的思想指导下，形成了由理论课、实验课、计算机设计与实践构成的课程体系。使学生系统地理解计算机硬件系统的组织结构和工作原理，掌握计算机硬件系统的基本分析与设计方法，建立计算机系统的整体概念。','1','','27','0','','0','1469548800','','1501138259','1582729305','1469548800','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1190','video','计算机网络','','0','','884','<!--#p8_attach#-->/cms/item/2017_07/27_14/f7afd5ca201141d8.jpg','','1','','','','admin','6','计算机网络也称计算机通信网。关于计算机网络的最简单定义是：一些相互连接的、以共享资源为目的的、自治的计算机的集合。若按此定义，则早期的面向终端的网络都不能算是计算机网络，而只能称为联机系统（因为那时的许多终端不能算是自治的计算机）。但随着硬件价格的下','1','','17','0','','0','1469548800','','1501138328','1582729322','1469548800','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1191','video','数据结构基础','','0','','884','<!--#p8_attach#-->/cms/item/2017_07/27_14/37ef06e9c33d0eee.jpg','','1','','','','admin','6','数据结构','1','','31','0','','0','1469548800','','1501138426','1582729335','1469548800','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1192','article','本科就有导师 岳麓书院把制度做成了“温度”岳麓书院把制度','','0','','903','<!--#p8_attach#-->/cms/item/2017_07/27_15/ac93d74478454a86.jpg','','1','','','','admin','6','6月初，湖南大学岳麓书院2017届毕业典礼上，2013级历史学本科生刘楚莹成了场上第一个泪崩的人。那个瞬间，她正和同门师兄一起向学业导师邓洪波教授鞠躬谢师','1','','53','0','','0','1500566400','','1501141077','1501141202','1500566400','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1194','article','“中华文化四海行”走进我校中华文化四海行”走进我校(图文)','','0','','903','<!--#p8_attach#-->/cms/item/2017_07/27_15/dec8d35c035eea84.jpg','','1','','','','admin','6',' 5月21日，“中华文化四海行—走进湖南”在我校举办文化讲坛，中央文史馆馆员、复旦大学资深教授、著名历史地理学家葛剑雄带来《传统文化的“传”和“承”》专题讲座。中央文史研究馆、全国各地文史研究馆的200余位专家学者和我校学生代表参加活动。校党委副书记陈伟主持讲座。','1','','25','0','','0','1500566400','','1501141447','1501141447','1500566400','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1195','article','省委教育工委来我校调研易班建设省委教育工委来我校调研易班建设','','0','','903','<!--#p8_attach#-->/cms/item/2017_07/27_15/10708333bdf103eb.jpg','','1','','','','admin','6','5月5日下午，湖南省委教育工委宣传部部长曾力勤等来我校调研易班建设及推广工作，我校学工部相关负责人、相关科室老师、学校易班工作站相关负责人陪同调研。','1','','138','0','','0','1500570000','','1501141566','1501297030','1500570000','1','','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1196','photo','校园风景','','0','','887','<!--#p8_attach#-->/cms/item/2020_04/11_23/23dad8ddda2ae9d8.jpg.thumb.jpg','','1','','','','admin','6','校园风景介绍','1','','12','0','','0','1469764448','','1501300448','1586618441','1469764448','1','admin168.','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1197','photo','校园风景','','0','','887','<!--#p8_attach#-->/cms/item/2020_04/11_23/7a4d91ded59ea744.jpg.thumb.jpg','','1','','','','admin','6','校园风景2','1','','13','0','','0','1469764448','','1501300488','1586618372','1469764448','1','admin168.','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1198','photo','校园一角','','0','','887','<!--#p8_attach#-->/cms/item/2020_04/11_23/4ee29edc3681e5ce.jpg.cthumb.jpg','','1','','','','admin','6','校园一角2','1','','25','0','','0','1469764448','','1501300537','1586618290','1469764448','1','admin168.','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1199','photo','教学楼','','0','','887','<!--#p8_attach#-->/cms/item/2020_04/11_22/6f02fe967e5282df.jpg.thumb.jpg','','1','','','','admin','6','教学楼2','1','','35','0','','0','1469764448','','1501300595','1586618319','1469764448','1','admin168.','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1312','page','学院简介','','0','','895','<!--#p8_attach#-->/cms/item/2020_04/12_09/282163366352d397.jpg','','3','','','','admin2','','123','1','','449','0','','0','1565937875','','1565937875','1586656684','1565937875','1','admin168.','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1313','page','联系我们','','0','','898','<!--#p8_attach#-->/cms/item/2020_04/12_09/996bf7d495a5b20e.jpg.cthumb.jpg','','1','','','','admin','','一、校内各单位电话两办26035866科研处26035633教务处26035375学工处26035259人事处26032109财务处26035567后勤保障处26035562发展办公室26033178培训中心在职研究生教育：26035372高级研修：26035556信息化办公室26035565信息工程学院26032723化学生物学与生物技术学院','1','','62','0','','0','1565939036','','1565939036','1586770407','1565939036','1','admin168.','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1314','page','历史沿革','','0','','897','','','1','','','','admin','',' 依托大学学科优势，结合深圳的区位优势，深圳研究生院以“前沿领域、交叉学科、应用学术、国际标准”为办学方针，加强学科建设。现有信息工程学院、化学生物学与生物技术学院、环境与能源学院、城市规划与设计学院、新材料学院、汇丰商学院','1','','63','0','','0','1565939714','','1565939714','1586770459','1565939714','1','admin168.','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1315','page','学院领导','','0','','896','','','1','','','','admin','','学院领导介绍','1','','44','0','','0','1565939911','','1565939911','1565939978','1565939911','1','admin','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1320','video','放飞梦想勇敢追逐青春的梦想','','0','','884','<!--#p8_attach#-->/cms/item/2020_02/26_22/08dbf0db2ae25eec.jpg','','1','','','','admin168.','','放飞梦想勇敢追逐青春的梦想放飞梦想勇敢追逐青春的梦想放飞梦想勇敢追逐青春的梦想','1','','33','0','','0','1579082560','','1579082560','1582729199','1579082560','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1332','down','测试下载内容模型的下载试用','','0','','146','','','3','','','','admin2','','2332','1','','15','0','','0','1582562902','','1582562902','1582562902','1582562902','1','admin2','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1339','article','胡敏、郭松课题组在PNAS上发文揭示机动车尾气的光化学氧化促进大气新粒子生成','','0','','874','<!--#p8_attach#-->/cms/item/2020_02/26_17/4128bb2a0f56aa9a.jpg','','5','','','','admin5','6','北京大学环境科学与工程学院胡敏教授、郭松研究员课题组与美国德州A&amp;amp;M大学张人一教授和彭剑飞博士开展合作研究，揭示机动车尾气的光化学氧化促进大气新粒子生成，进而导致我国城市地区霾的形成。研究显示，我国大气复合污染条件下，大气具有很强的超细颗粒物生成潜势，','1','','2','0','','0','1582710309','','1582710309','1582710309','1582710309','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1340','article','我校马克思主义学院承办北京高校思政理论课教师学习实践暨集体备课会','','0','','872','<!--#p8_attach#-->/cms/item/2020_02/26_17/3c48f5485338da98.jpg','','5','','','','admin5','6','　　新闻网讯　1月9至10日，为深入贯彻习近平总书记在学校思想政治理论课教师座谈会重要讲话精神，进一步加强北京高校思政课教师队伍建设，培养思政课教师&amp;amp;ldquo;六种素养&amp;amp;rdquo;，以&amp;amp;ldquo;京华大地看小康&amp;amp;rdquo;为主题的北京高校思想政治理论课教师&amp;amp;ldquo;看北京、看','1','','2','0','','0','1578304380','','1582710786','1582710786','1578304380','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1341','article','哲学与宗教学学院举办“新时代中国特色宗教政策解读”讲座','','0','','872','<!--#p8_attach#-->/cms/item/2020_02/26_17/559576cf4e8d9625.jpg','','5','','','','admin5','6','　　新闻网讯　12月9日上午9:50，哲学与宗教学学院在文西1102教室开展讲座，由黄杰主讲。黄杰现任中共山西省委统战部九处处长、兼任中央民族大学宗教研究院客座研究员、山西省反邪教协会常务理事、山西省公安厅特聘专家、山西社会主义学院院务咨询委员会成员。他长期从','1','','3','0','','0','1582711077','','1582711077','1582711089','1582711077','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1342','article','中国社会科学院陈思副研究员应邀来校讲座： 从“人生”到“世界” 今天我们怎样读懂路遥','','0','','872','<!--#p8_attach#-->/cms/item/2020_02/26_18/b473c345bbcc0a29.jpg','','5','','','','admin5','6','　　新闻网讯　2019年11月7日下午，中国社会科学院文学研究所陈思副研究员在文华楼西区701教室做题为：&amp;amp;ldquo;从&amp;amp;lsquo;人生&amp;amp;rsquo;到&amp;amp;lsquo;世界&amp;amp;rsquo;：今天我们怎样读懂路遥&amp;amp;rdquo;的学术讲座。讲座由我校文学院现当代文学教研室主任毕海主持，文学院50多位师生聆听','1','','3','0','','0','1582711470','','1582711470','1582711470','1582711470','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1343','article','有效提升舆论引导水平','','0','','866','','','5','','','','admin5','','提升舆论引导水平，是做好新闻舆论工作的重大课题。当前，全媒体不断发展，出现了全程媒体、全息媒体、全员媒体、全效媒体，舆论生态、媒体格局、传播方式发生深刻变化，新闻舆论工作面临新的挑战，提升舆论引导水平显得尤为重要。党的十九届四中全会《决定》提出&amp;amp;ldquo','1','','4','0','人民日报','0','1582711790','','1582711790','1582711790','1582711790','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1344','article','现实力量与想象空间——面对“互联网+”的电影美学新表达','','0','','866','<!--#p8_attach#-->/cms/item/2020_02/26_18/251e9f8b65877349.jpg','','5','','','','admin5','','','1','','6','0','人民日报','0','1582712129','','1582712129','1582712243','1582712129','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1345','article','客观理性地看待圈层文化','','0','','866','','','5','','','','admin5','','随着互联网普及程度的提高及其对社会生活的深度浸透，圈层文化现象正逐渐进入大众视野，成为舆论关注的热点。无论是主动、被动参与或是无意识加入，从大面上说，作为一种新型的社会组织方式，绝大部分网民都可以被分入一定的文化圈层，二次元圈、电竞圈、书法圈&amp;amp;hellip;','1','','4','0','社会科学报','0','1582712499','','1582712499','1582712499','1582712499','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1346','article','王红漫：远程医疗一点通 e网打尽全世界','','0','','866','','','5','','','','admin5','','为了落实《国务院办公厅关于促进&amp;amp;ldquo;互联网+医疗健康&amp;amp;rdquo;发展的意见》，规范现有和未来的互联网诊疗活动，推动互联网医疗服务健康快速发展，达到保障医疗质量和医疗安全的目的，国家卫生健康委员会和国家中医药管理局在广泛征求社会各界的意见和建议，根据《执业','1','','8','0','光明网','0','1582712733','','1582712733','1582712733','1582712733','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1347','article','为“艾”发光 共建健康中国','','0','','903','<!--#p8_attach#-->/cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','','5','','','','admin5','6','为“艾”发光 共建健康中国第32个世界艾滋病日到来之际，11月29日晚，学生举办为“艾”发光活动，用烛光点亮“NO AIDS”和红丝带的字样和图案，呼吁广大青年知艾防艾，共享健康。','1','','23','0','','0','1582726810','','1582726817','1582728002','1582726810','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1348','article','校党委中心组开展2020年第2次集中学习','','0','','903','<!--#p8_attach#-->/cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','','5','','','','admin5','6','2月24日，校党委中心组开展2020年第2次集中学习，深入学习习近平总书记系列重要讲话精神和教育部党组有关文件精神。校党委书记邓卫主持会议，校长段献忠、全体在校校领导、校党委常委参加学习。','1','','17','0','','0','1582726810','','1582726817','1582727669','1582726810','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1349','article','“我和我的祖国”全校师生大合唱比赛开赛','','0','','903','<!--#p8_attach#-->/cms/item/2020_02/26_22/d57883c29273e0f4.jpg','','5','','','','admin5','6','我和我的祖国”全校师生大合唱比赛开我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛赛','1','','12','0','','0','1582726810','','1582726817','1582727980','1582726810','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1350','article','青春科技 创造未来','','0','','903','<!--#p8_attach#-->/cms/item/2020_02/26_17/0f0d592f1856380b.jpg.thumb.jpg','','5','','','','admin5','6','学生优秀科技作品展在浙大紫金港校区展出。该展览汇集了浙江各大高校近年来在国内外各大科技竞赛中的优秀获奖作品，这些作品展现了近年来大学生','1','','8','0','','0','1582726810','','1582726817','1586767682','1582726810','1','admin168.','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1352','photo','校园风景','','0','','824','<!--#p8_attach#-->/cms/item/2020_04/11_23/23dad8ddda2ae9d8.jpg.thumb.jpg','','1','','','','admin','6','校园风景介绍','1','','0','0','','0','1523460314','','1586618716','1586618716','1523460314','1','admin168.','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1353','photo','校园风景','','0','','824','<!--#p8_attach#-->/cms/item/2020_04/11_23/7a4d91ded59ea744.jpg.thumb.jpg','','1','','','','admin','6','校园风景2','1','','0','0','','0','1523460314','','1586618716','1586618716','1523460314','1','admin168.','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1354','photo','校园一角','','0','','824','<!--#p8_attach#-->/cms/item/2020_04/11_23/4ee29edc3681e5ce.jpg.cthumb.jpg','','1','','','','admin','6','校园一角2','1','','1','0','','0','1523460314','','1586618716','1586618716','1523460314','1','admin168.','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1355','photo','教学楼','','0','','824','<!--#p8_attach#-->/cms/item/2020_04/11_22/6f02fe967e5282df.jpg.thumb.jpg','','1','','','','admin','6','教学楼2','1','','9','0','','0','1523460314','','1586618716','1586618716','1523460314','1','admin168.','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1356','article','校党委中心组开展2020年第2次集中学习','','0','','891','<!--#p8_attach#-->/cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','','1','','','','admin5','6','2月24日，校党委中心组开展2020年第2次集中学习，深入学习习近平总书记系列重要讲话精神和教育部党组有关文件精神。校党委书记邓卫主持会议，校长段献忠、全体在校校领导、校党委常委参加学习。','1','','1','0','','0','1582726810','','1586668060','1586668060','1582726810','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1357','article','“我和我的祖国”全校师生大合唱比赛开赛','','0','','891','<!--#p8_attach#-->/cms/item/2020_02/26_22/d57883c29273e0f4.jpg','','1','','','','admin5','6','我和我的祖国”全校师生大合唱比赛开我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛赛','1','','0','0','','0','1582726810','','1586668060','1586668060','1582726810','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1358','article','校党委中心组开展2020年第2次集中学习','','0','','929','<!--#p8_attach#-->/cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','','1','','','','admin5','6','2月24日，校党委中心组开展2020年第2次集中学习，深入学习习近平总书记系列重要讲话精神和教育部党组有关文件精神。校党委书记邓卫主持会议，校长段献忠、全体在校校领导、校党委常委参加学习。','1','','5','0','','0','1582726810','','1586668060','1586668060','1582726810','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1359','article','“我和我的祖国”全校师生大合唱比赛开赛','','0','','929','<!--#p8_attach#-->/cms/item/2020_02/26_22/d57883c29273e0f4.jpg','','1','','','','admin5','6','我和我的祖国”全校师生大合唱比赛开我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛赛','1','','2','0','','0','1582726810','','1586668060','1586668060','1582726810','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1360','article','校党委中心组开展2020年第2次集中学习','','0','','890','<!--#p8_attach#-->/cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','','1','','','','admin5','6','2月24日，校党委中心组开展2020年第2次集中学习，深入学习习近平总书记系列重要讲话精神和教育部党组有关文件精神。校党委书记邓卫主持会议，校长段献忠、全体在校校领导、校党委常委参加学习。','1','','0','0','','0','1522822645','','1586672257','1586672257','1522822645','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1361','article','“我和我的祖国”全校师生大合唱比赛开赛','','0','','890','<!--#p8_attach#-->/cms/item/2020_02/26_22/d57883c29273e0f4.jpg','','1','','','','admin5','6','我和我的祖国”全校师生大合唱比赛开我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛赛','1','','1','0','','0','1522822645','','1586672257','1586672257','1522822645','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1362','article','为“艾”发光 共建健康中国','','0','','839','<!--#p8_attach#-->/cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','','1','','','','admin5','6','为“艾”发光 共建健康中国第32个世界艾滋病日到来之际，11月29日晚，学生举办为“艾”发光活动，用烛光点亮“NO AIDS”和红丝带的字样和图案，呼吁广大青年知艾防艾，共享健康。','1','','0','0','','0','1586767761','','1586767781','1586767781','1586767761','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1363','article','校党委中心组开展2020年第2次集中学习','','0','','839','<!--#p8_attach#-->/cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','','1','','','','admin5','6','2月24日，校党委中心组开展2020年第2次集中学习，深入学习习近平总书记系列重要讲话精神和教育部党组有关文件精神。校党委书记邓卫主持会议，校长段献忠、全体在校校领导、校党委常委参加学习。','1','','0','0','','0','1586767761','','1586767781','1586767781','1586767761','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1364','article','“我和我的祖国”全校师生大合唱比赛开赛','','0','','839','<!--#p8_attach#-->/cms/item/2020_02/26_22/d57883c29273e0f4.jpg','','1','','','','admin5','6','我和我的祖国”全校师生大合唱比赛开我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛赛','1','','0','0','','0','1586767761','','1586767781','1586767781','1586767761','1','admin5','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item` VALUES ('1365','article','青春科技 创造未来','','0','','839','<!--#p8_attach#-->/cms/item/2020_02/26_17/0f0d592f1856380b.jpg.thumb.jpg','','1','','','','admin5','6','学生优秀科技作品展在浙大紫金港校区展出。该展览汇集了浙江各大高校近年来在国内外各大科技竞赛中的优秀获奖作品，这些作品展现了近年来大学生','1','','1','0','','0','1586767761','','1586767781','1586767781','1586767761','1','admin168.','0','1','1','1','0','0','0','0','','','','','','','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('119','article','26','1','admin','企业站内公告1','','0','','','','','','企业站内公告','','','','','','1','','0','1308558474','0','1308558474','1308558474','1','','','2','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('120','article','26','1','admin','企业站内公告2','','0','','','','','','企业站内公告','','','','','','1','','0','1308558482','0','1308558482','1308558482','1','','','4','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('121','article','26','1','admin','企业站内公告3','','0','','','','','','企业站内公告','','','','','','1','','0','1308558488','0','1308558488','1308558488','1','','','10','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('122','article','26','1','admin','企业站内公告4','','0','','','','','','企业站内公告','','','','','','1','','0','1308558495','0','1308558495','1308558495','1','','','12','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('123','article','26','1','admin','企业站内公告5','','0','','','','','','企业站内公告','','','','','','1','','0','1308558502','0','1308558502','1308558502','1','','','9','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('124','article','26','1','admin','企业站内公告6','','0','','','','','','企业站内公告','','','','','','1','','0','1308558508','0','1308558508','1308558508','1','','','10','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1054','article','903','1','admin','学院领导','','0','','','','','','校党委书记：易佐永主持党委全面工作。校长：庾建设主持行政全面工作。校党委副书记：赖卫华分管组织干部、宣传、思想政治理论课工作、统战、离退休、计划生育、校友会工作。副校长：董皞分管财务、高等职业教育、成人教育、体育、中小学校长和师资培训、直属单位工作。','','','','','','1','','0','1408809600','1408851788','1408809600','1431064723','1','','','312','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1160','article','903','1','admin','谭文长','','0','','<!--#p8_attach#-->/cms/item/2017_02/17_09/0632f21ab2ee08dd.jpg','','','6','主持党委工作','','','','','','1','','0','1487295833','1487295833','1487295833','1487295936','1','','','41','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1161','article','903','1','admin','安晓朋','','0','','<!--#p8_attach#-->/cms/item/2017_02/17_09/5bce7731b94874f8.jpg','','','6','协助书记负责安全维稳丶学生丶共青团及工会工作，主管学生工作处。','','','','','','1','admin','0','1487296076','1487296076','1487296076','1487296076','1','','','53','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1164','article','845','1','admin','张老师','','0','','','','','','23423432','','','','','','1','admin','0','1495294748','1495294748','1495294748','1495294748','1','','','11','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1165','article','845','1','admin','张老师','','0','','','','','','23423432','','','','','','1','admin','0','1495294754','1495294754','1495294754','1495294754','1','','','14','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1170','article','866','1','admin','科技大学2017年秋天最新的校园风景拍摄图','','0','','<!--#p8_attach#-->/cms/item/2017_05/21_10/af32a2c6aa3e9b9a.jpg','','','6','它们的头上各有一盏门灯,像两颗夜明珠镶嵌在上面。门柱中间,有一块大理石,上面刻着“余姚市阳明小学”这七个闪烁','','','','','','1','admin168.','0','1495296000','1495332835','1495296000','1586618581','1','','','32','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1175','article','866','1','admin','科技大学2017年度新建的校园操场和运动会跑道','','0','','<!--#p8_attach#-->/cms/item/2017_05/22_06/cd2129dbb3b55922.jpg','','','6','沿着通向学校的劳动路,我来到了静谧的校门前。早晨,太阳光照在校园里,像给校园披上了一件金色的外套,壮观极了!校门口有两个像卫兵似的门柱','','','','','','1','admin168.','0','1495405974','1495405974','1495405974','1586618619','1','','','28','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1177','article','903','0','admin','科技大学2017年秋天最新的校园风景拍摄图','','0','','<!--#p8_attach#-->/cms/item/2017_05/21_10/af32a2c6aa3e9b9a.jpg','','','6','它们的头上各有一盏门灯,像两颗夜明珠镶嵌在上面。门柱中间,有一块大理石,上面刻着“余姚市阳明小学”这七个闪烁','','','','','','1','admin','1497194716','1495406318','1495406318','1495406318','1495406318','1','','','24','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1178','article','903','0','admin','科技大学2017年度新建的校园操场和运动会跑道','','0','','<!--#p8_attach#-->/cms/item/2017_05/22_06/cd2129dbb3b55922.jpg','','','6','沿着通向学校的劳动路,我来到了静谧的校门前。早晨,太阳光照在校园里,像给校园披上了一件金色的外套,壮观极了!校门口有两个像卫兵似的门柱','','','','','','1','admin','1497194717','1495406318','1495406318','1495406318','1495406318','1','','','28','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1183','article','903','1','admin','袁军副校长率团参加第八届国际博士研究生学术研讨会','','0','','','','','','2012年7月22至23日，袁军副校长率中国传媒大学师生学术代表团参加了在泰国曼谷朱拉隆公大学举办的第八届国际博士研究生学术研讨会。会议期间，袁军副校长与相关国际合作院校负责人就深化研究生合作办学、学术交流等事','院系01|','','','','','1','admin','0','1493689051','1497191599','1493689051','1497191599','1','','','13','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1184','article','903','1','admin','2012夏季学期系列：坚守在火灾现场 2012夏季学期系列：坚守在火灾现场 ','','0','','','','','','6月28日下午，台州广播电视台《600全民新闻》节目办公室的电话骤然响起，原来是该市黄岩区一家制造太空杯的工厂发生火灾。我校实习记者徐鑫和电视台另外两名记者带上设备，立即驱车赶赴火灾现场实施报道。火灾现场一','院系2|','','','','','1','admin','0','1493689532','1497195254','1493689532','1497195254','1','','','24','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1185','article','830','1','admin','袁军副校长率团参加第八届国际博士研究生学术研讨会','','0','','','','','','2012年7月22至23日，袁军副校长率中国传媒大学师生学术代表团参加了在泰国曼谷朱拉隆公大学举办的第八届国际博士研究生学术研讨会。会议期间，袁军副校长与相关国际合作院校负责人就深化研究生合作办学、学术交流等事','招生网|','','','','','1','admin','0','1493618517','1497196116','1493618517','1497196116','1','','','9','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1186','article','840','1','admin','专家上海研讨大城市规划 绿色可持续城市仍为热点','','0','','','','','','&ldquo;新型城镇化&rdquo;现已成为一个全民议题。如何走新型城镇化道路，需要全社会尤其是&ldquo;规划师&rdquo;的探索与创新。作为担当城乡规划重任的&ldquo;青年规划师&rdquo;的思考及探索，将为中国新型城镇化实践提供新的思路。　　17日，以&ldquo;新型城镇化与城乡规','院系01|','','','','','1','admin','0','1493689051','1497196372','1493689051','1497196372','1','','','18','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1192','article','903','1','admin','本科就有导师 岳麓书院把制度做成了“温度”岳麓书院把制度','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_15/ac93d74478454a86.jpg','','','6','6月初，湖南大学岳麓书院2017届毕业典礼上，2013级历史学本科生刘楚莹成了场上第一个泪崩的人。那个瞬间，她正和同门师兄一起向学业导师邓洪波教授鞠躬谢师','','','','','','1','','0','1500566400','1501141077','1500566400','1501141202','1','','','53','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1194','article','903','1','admin','“中华文化四海行”走进我校中华文化四海行”走进我校(图文)','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_15/dec8d35c035eea84.jpg','','','6',' 5月21日，“中华文化四海行—走进湖南”在我校举办文化讲坛，中央文史馆馆员、复旦大学资深教授、著名历史地理学家葛剑雄带来《传统文化的“传”和“承”》专题讲座。中央文史研究馆、全国各地文史研究馆的200余位专家学者和我校学生代表参加活动。校党委副书记陈伟主持讲座。','','','','','','1','admin','0','1500566400','1501141447','1500566400','1501141447','1','','','25','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1195','article','903','1','admin','省委教育工委来我校调研易班建设省委教育工委来我校调研易班建设','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_15/10708333bdf103eb.jpg','','','6','5月5日下午，湖南省委教育工委宣传部部长曾力勤等来我校调研易班建设及推广工作，我校学工部相关负责人、相关科室老师、学校易班工作站相关负责人陪同调研。','','','','','','1','','0','1500570000','1501141566','1500570000','1501297030','1','','','138','0','0','','','','');
REPLACE INTO `p8_cms_item_article_` VALUES ('1339','article','874','5','admin5','胡敏、郭松课题组在PNAS上发文揭示机动车尾气的光化学氧化促进大气新粒子生成','','0','','<!--#p8_attach#-->/cms/item/2020_02/26_17/4128bb2a0f56aa9a.jpg','','','6','北京大学环境科学与工程学院胡敏教授、郭松研究员课题组与美国德州A&amp;amp;M大学张人一教授和彭剑飞博士开展合作研究，揭示机动车尾气的光化学氧化促进大气新粒子生成，进而导致我国城市地区霾的形成。研究显示，我国大气复合污染条件下，大气具有很强的超细颗粒物生成潜势，','','','','','','1','admin5','0','1582710309','1582710309','1582710309','1582710309','1','','','2','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";s:1:\\\"0\\\";s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1340','article','872','5','admin5','我校马克思主义学院承办北京高校思政理论课教师学习实践暨集体备课会','','0','','<!--#p8_attach#-->/cms/item/2020_02/26_17/3c48f5485338da98.jpg','','','6','　　新闻网讯　1月9至10日，为深入贯彻习近平总书记在学校思想政治理论课教师座谈会重要讲话精神，进一步加强北京高校思政课教师队伍建设，培养思政课教师&amp;amp;ldquo;六种素养&amp;amp;rdquo;，以&amp;amp;ldquo;京华大地看小康&amp;amp;rdquo;为主题的北京高校思想政治理论课教师&amp;amp;ldquo;看北京、看','','','','','','1','admin5','0','1578304380','1582710786','1578304380','1582710786','1','','','2','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";s:1:\\\"0\\\";s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1341','article','872','5','admin5','哲学与宗教学学院举办“新时代中国特色宗教政策解读”讲座','','0','','<!--#p8_attach#-->/cms/item/2020_02/26_17/559576cf4e8d9625.jpg','','','6','　　新闻网讯　12月9日上午9:50，哲学与宗教学学院在文西1102教室开展讲座，由黄杰主讲。黄杰现任中共山西省委统战部九处处长、兼任中央民族大学宗教研究院客座研究员、山西省反邪教协会常务理事、山西省公安厅特聘专家、山西社会主义学院院务咨询委员会成员。他长期从','','','','','','1','admin5','0','1582711077','1582711077','1582711077','1582711089','1','','','3','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";s:1:\\\"0\\\";s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1342','article','872','5','admin5','中国社会科学院陈思副研究员应邀来校讲座： 从“人生”到“世界” 今天我们怎样读懂路遥','','0','','<!--#p8_attach#-->/cms/item/2020_02/26_18/b473c345bbcc0a29.jpg','','','6','　　新闻网讯　2019年11月7日下午，中国社会科学院文学研究所陈思副研究员在文华楼西区701教室做题为：&amp;amp;ldquo;从&amp;amp;lsquo;人生&amp;amp;rsquo;到&amp;amp;lsquo;世界&amp;amp;rsquo;：今天我们怎样读懂路遥&amp;amp;rdquo;的学术讲座。讲座由我校文学院现当代文学教研室主任毕海主持，文学院50多位师生聆听','','','','','','1','admin5','0','1582711470','1582711470','1582711470','1582711470','1','','','3','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";s:1:\\\"0\\\";s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1343','article','866','5','admin5','有效提升舆论引导水平','','0','','','','','','提升舆论引导水平，是做好新闻舆论工作的重大课题。当前，全媒体不断发展，出现了全程媒体、全息媒体、全员媒体、全效媒体，舆论生态、媒体格局、传播方式发生深刻变化，新闻舆论工作面临新的挑战，提升舆论引导水平显得尤为重要。党的十九届四中全会《决定》提出&amp;amp;ldquo','人民日报','','','','','1','admin5','0','1582711790','1582711790','1582711790','1582711790','1','','','4','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";s:1:\\\"0\\\";s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1344','article','866','5','admin5','现实力量与想象空间——面对“互联网+”的电影美学新表达','','0','','<!--#p8_attach#-->/cms/item/2020_02/26_18/251e9f8b65877349.jpg','','','','','人民日报','','','','','1','admin5','0','1582712129','1582712129','1582712129','1582712243','1','','','6','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1345','article','866','5','admin5','客观理性地看待圈层文化','','0','','','','','','随着互联网普及程度的提高及其对社会生活的深度浸透，圈层文化现象正逐渐进入大众视野，成为舆论关注的热点。无论是主动、被动参与或是无意识加入，从大面上说，作为一种新型的社会组织方式，绝大部分网民都可以被分入一定的文化圈层，二次元圈、电竞圈、书法圈&amp;amp;hellip;','社会科学报','','','','','1','admin5','0','1582712499','1582712499','1582712499','1582712499','1','','','4','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";s:1:\\\"0\\\";s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1346','article','866','5','admin5','王红漫：远程医疗一点通 e网打尽全世界','','0','','','','','','为了落实《国务院办公厅关于促进&amp;amp;ldquo;互联网+医疗健康&amp;amp;rdquo;发展的意见》，规范现有和未来的互联网诊疗活动，推动互联网医疗服务健康快速发展，达到保障医疗质量和医疗安全的目的，国家卫生健康委员会和国家中医药管理局在广泛征求社会各界的意见和建议，根据《执业','光明网','','','','','1','admin5','0','1582712733','1582712733','1582712733','1582712733','1','','','8','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";s:1:\\\"0\\\";s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1347','article','903','5','admin5','为“艾”发光 共建健康中国','','0','','<!--#p8_attach#-->/cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','','','6','为“艾”发光 共建健康中国第32个世界艾滋病日到来之际，11月29日晚，学生举办为“艾”发光活动，用烛光点亮“NO AIDS”和红丝带的字样和图案，呼吁广大青年知艾防艾，共享健康。','','','','','','1','admin5','0','1582726810','1582726817','1582726810','1582728002','1','','','23','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1348','article','903','5','admin5','校党委中心组开展2020年第2次集中学习','','0','','<!--#p8_attach#-->/cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','','','6','2月24日，校党委中心组开展2020年第2次集中学习，深入学习习近平总书记系列重要讲话精神和教育部党组有关文件精神。校党委书记邓卫主持会议，校长段献忠、全体在校校领导、校党委常委参加学习。','','','','','','1','admin5','0','1582726810','1582726817','1582726810','1582727669','1','','','17','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1349','article','903','5','admin5','“我和我的祖国”全校师生大合唱比赛开赛','','0','','<!--#p8_attach#-->/cms/item/2020_02/26_22/d57883c29273e0f4.jpg','','','6','我和我的祖国”全校师生大合唱比赛开我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛赛','','','','','我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛','1','admin5','0','1582726810','1582726817','1582726810','1582727980','1','','','12','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1350','article','903','5','admin5','青春科技 创造未来','','0','','<!--#p8_attach#-->/cms/item/2020_02/26_17/0f0d592f1856380b.jpg.thumb.jpg','','','6','学生优秀科技作品展在浙大紫金港校区展出。该展览汇集了浙江各大高校近年来在国内外各大科技竞赛中的优秀获奖作品，这些作品展现了近年来大学生','','','','','','1','admin168.','0','1582726810','1582726817','1582726810','1586767682','1','','','8','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_article_` VALUES ('1356','article','891','1','admin5','校党委中心组开展2020年第2次集中学习','','0','','<!--#p8_attach#-->/cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','','','6','2月24日，校党委中心组开展2020年第2次集中学习，深入学习习近平总书记系列重要讲话精神和教育部党组有关文件精神。校党委书记邓卫主持会议，校长段献忠、全体在校校领导、校党委常委参加学习。','','','','','','1','admin5','0','1582726810','1586668060','1582726810','1586668060','1','','','1','0','0','','','','a:2:{i:0;s:145:\\\"a:1:{s:8:\\\\\\\"allow_ip\\\\\\\";a:5:{s:7:\\\\\\\"enabled\\\\\\\";i:0;s:9:\\\\\\\"collectip\\\\\\\";a:0:{}s:7:\\\\\\\"beginip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:5:\\\\\\\"endip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:9:\\\\\\\"ruleoutip\\\\\\\";a:0:{}}}\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\');
REPLACE INTO `p8_cms_item_article_` VALUES ('1357','article','891','1','admin5','“我和我的祖国”全校师生大合唱比赛开赛','','0','','<!--#p8_attach#-->/cms/item/2020_02/26_22/d57883c29273e0f4.jpg','','','6','我和我的祖国”全校师生大合唱比赛开我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛赛','','','','','我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛','1','admin5','0','1582726810','1586668060','1582726810','1586668060','1','','','0','0','0','','','','a:2:{i:0;s:145:\\\"a:1:{s:8:\\\\\\\"allow_ip\\\\\\\";a:5:{s:7:\\\\\\\"enabled\\\\\\\";i:0;s:9:\\\\\\\"collectip\\\\\\\";a:0:{}s:7:\\\\\\\"beginip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:5:\\\\\\\"endip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:9:\\\\\\\"ruleoutip\\\\\\\";a:0:{}}}\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\');
REPLACE INTO `p8_cms_item_article_` VALUES ('1358','article','929','1','admin5','校党委中心组开展2020年第2次集中学习','','0','','<!--#p8_attach#-->/cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','','','6','2月24日，校党委中心组开展2020年第2次集中学习，深入学习习近平总书记系列重要讲话精神和教育部党组有关文件精神。校党委书记邓卫主持会议，校长段献忠、全体在校校领导、校党委常委参加学习。','','','','','','1','admin5','0','1582726810','1586668060','1582726810','1586668060','1','','','5','0','0','','','','a:2:{i:0;s:145:\\\"a:1:{s:8:\\\\\\\"allow_ip\\\\\\\";a:5:{s:7:\\\\\\\"enabled\\\\\\\";i:0;s:9:\\\\\\\"collectip\\\\\\\";a:0:{}s:7:\\\\\\\"beginip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:5:\\\\\\\"endip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:9:\\\\\\\"ruleoutip\\\\\\\";a:0:{}}}\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\');
REPLACE INTO `p8_cms_item_article_` VALUES ('1359','article','929','1','admin5','“我和我的祖国”全校师生大合唱比赛开赛','','0','','<!--#p8_attach#-->/cms/item/2020_02/26_22/d57883c29273e0f4.jpg','','','6','我和我的祖国”全校师生大合唱比赛开我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛赛','','','','','我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛','1','admin5','0','1582726810','1586668060','1582726810','1586668060','1','','','2','0','0','','','','a:2:{i:0;s:145:\\\"a:1:{s:8:\\\\\\\"allow_ip\\\\\\\";a:5:{s:7:\\\\\\\"enabled\\\\\\\";i:0;s:9:\\\\\\\"collectip\\\\\\\";a:0:{}s:7:\\\\\\\"beginip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:5:\\\\\\\"endip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:9:\\\\\\\"ruleoutip\\\\\\\";a:0:{}}}\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\');
REPLACE INTO `p8_cms_item_article_` VALUES ('1360','article','890','1','admin5','校党委中心组开展2020年第2次集中学习','','0','','<!--#p8_attach#-->/cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','','','6','2月24日，校党委中心组开展2020年第2次集中学习，深入学习习近平总书记系列重要讲话精神和教育部党组有关文件精神。校党委书记邓卫主持会议，校长段献忠、全体在校校领导、校党委常委参加学习。','','','','','','1','admin5','0','1522822645','1586672257','1522822645','1586672257','1','','','0','0','0','','','','a:2:{i:0;s:255:\\\"a:2:{i:0;s:145:\\\\\\\"a:1:{s:8:\\\\\\\\\\\\\\\"allow_ip\\\\\\\\\\\\\\\";a:5:{s:7:\\\\\\\\\\\\\\\"enabled\\\\\\\\\\\\\\\";i:0;s:9:\\\\\\\\\\\\\\\"collectip\\\\\\\\\\\\\\\";a:0:{}s:7:\\\\\\\\\\\\\\\"beginip\\\\\\\\\\\\\\\";s:0:\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\";s:5:\\\\\\\\\\\\\\\"endip\\\\\\\\\\\\\\\";s:0:\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\";s:9:\\\\\\\\\\\\\\\"rule');
REPLACE INTO `p8_cms_item_article_` VALUES ('1361','article','890','1','admin5','“我和我的祖国”全校师生大合唱比赛开赛','','0','','<!--#p8_attach#-->/cms/item/2020_02/26_22/d57883c29273e0f4.jpg','','','6','我和我的祖国”全校师生大合唱比赛开我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛赛','','','','','我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛','1','admin5','0','1522822645','1586672257','1522822645','1586672257','1','','','1','0','0','','','','a:2:{i:0;s:255:\\\"a:2:{i:0;s:145:\\\\\\\"a:1:{s:8:\\\\\\\\\\\\\\\"allow_ip\\\\\\\\\\\\\\\";a:5:{s:7:\\\\\\\\\\\\\\\"enabled\\\\\\\\\\\\\\\";i:0;s:9:\\\\\\\\\\\\\\\"collectip\\\\\\\\\\\\\\\";a:0:{}s:7:\\\\\\\\\\\\\\\"beginip\\\\\\\\\\\\\\\";s:0:\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\";s:5:\\\\\\\\\\\\\\\"endip\\\\\\\\\\\\\\\";s:0:\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\";s:9:\\\\\\\\\\\\\\\"rule');
REPLACE INTO `p8_cms_item_article_` VALUES ('1362','article','839','1','admin5','为“艾”发光 共建健康中国','','0','','<!--#p8_attach#-->/cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','','','6','为“艾”发光 共建健康中国第32个世界艾滋病日到来之际，11月29日晚，学生举办为“艾”发光活动，用烛光点亮“NO AIDS”和红丝带的字样和图案，呼吁广大青年知艾防艾，共享健康。','','','','','','1','admin5','0','1586767761','1586767781','1586767761','1586767781','1','','','0','0','0','','','','a:2:{i:0;s:145:\\\"a:1:{s:8:\\\\\\\"allow_ip\\\\\\\";a:5:{s:7:\\\\\\\"enabled\\\\\\\";i:0;s:9:\\\\\\\"collectip\\\\\\\";a:0:{}s:7:\\\\\\\"beginip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:5:\\\\\\\"endip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:9:\\\\\\\"ruleoutip\\\\\\\";a:0:{}}}\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\');
REPLACE INTO `p8_cms_item_article_` VALUES ('1363','article','839','1','admin5','校党委中心组开展2020年第2次集中学习','','0','','<!--#p8_attach#-->/cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','','','6','2月24日，校党委中心组开展2020年第2次集中学习，深入学习习近平总书记系列重要讲话精神和教育部党组有关文件精神。校党委书记邓卫主持会议，校长段献忠、全体在校校领导、校党委常委参加学习。','','','','','','1','admin5','0','1586767761','1586767781','1586767761','1586767781','1','','','0','0','0','','','','a:2:{i:0;s:145:\\\"a:1:{s:8:\\\\\\\"allow_ip\\\\\\\";a:5:{s:7:\\\\\\\"enabled\\\\\\\";i:0;s:9:\\\\\\\"collectip\\\\\\\";a:0:{}s:7:\\\\\\\"beginip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:5:\\\\\\\"endip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:9:\\\\\\\"ruleoutip\\\\\\\";a:0:{}}}\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\');
REPLACE INTO `p8_cms_item_article_` VALUES ('1364','article','839','1','admin5','“我和我的祖国”全校师生大合唱比赛开赛','','0','','<!--#p8_attach#-->/cms/item/2020_02/26_22/d57883c29273e0f4.jpg','','','6','我和我的祖国”全校师生大合唱比赛开我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛赛','','','','','我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛','1','admin5','0','1586767761','1586767781','1586767761','1586767781','1','','','0','0','0','','','','a:2:{i:0;s:145:\\\"a:1:{s:8:\\\\\\\"allow_ip\\\\\\\";a:5:{s:7:\\\\\\\"enabled\\\\\\\";i:0;s:9:\\\\\\\"collectip\\\\\\\";a:0:{}s:7:\\\\\\\"beginip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:5:\\\\\\\"endip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:9:\\\\\\\"ruleoutip\\\\\\\";a:0:{}}}\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\');
REPLACE INTO `p8_cms_item_article_` VALUES ('1365','article','839','1','admin5','青春科技 创造未来','','0','','<!--#p8_attach#-->/cms/item/2020_02/26_17/0f0d592f1856380b.jpg.thumb.jpg','','','6','学生优秀科技作品展在浙大紫金港校区展出。该展览汇集了浙江各大高校近年来在国内外各大科技竞赛中的优秀获奖作品，这些作品展现了近年来大学生','','','','','','1','admin168.','0','1586767761','1586767781','1586767761','1586767781','1','','','1','0','0','','','','a:2:{i:0;s:145:\\\"a:1:{s:8:\\\\\\\"allow_ip\\\\\\\";a:5:{s:7:\\\\\\\"enabled\\\\\\\";i:0;s:9:\\\\\\\"collectip\\\\\\\";a:0:{}s:7:\\\\\\\"beginip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:5:\\\\\\\"endip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:9:\\\\\\\"ruleoutip\\\\\\\";a:0:{}}}\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('82','119','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558474','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('83','120','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558482','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('84','121','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558488','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('85','122','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558495','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('86','123','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558502','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('87','124','1','','','企业站内公告','219.136.169.248','219.136.169.248','1308558508','企业站内公告');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('305','1054','1','','','校党委书记：易佐永主持党委全面工作。校长：庾建设主持行政全面工作。校党委副书记：赖卫华分管组织干部、宣传、思想政治理论课工作、统战、离退休、计划生育、校友会工作。副校长：董皞分管财务、高等职业教育、成人教育、体育、中小学校长和师资培训、直属单位工作。','121.8.7.164','222.240.162.130','1408809600','<p>\r\n	<br />\r\n	<span style=\"font-size:12px;\"><strong><span style=\"font-size:16px;\">校党委书记</span></strong></span><strong style=\"font-family: serif; font-size: 12px; \"><span style=\"font-size: 16px; \">：</span></strong><span style=\"font-size:12px;\"><strong><span style=\"font-size:16px;\">易佐永</span></strong></span><br />\r\n	<span style=\"font-size: 12px;\">主持党委全面工作。</span><br />\r\n	<br />\r\n	<span style=\"font-size:12px;\"><span style=\"font-size:16px;\"><strong>校长</strong></span></span><strong style=\"font-family: serif; font-size: 12px; \"><span style=\"font-size: 16px; \">：</span></strong><span style=\"font-size:12px;\"><span style=\"font-size:16px;\"><strong>庾建设</strong></span></span><br />\r\n	<span style=\"font-size: 12px;\">主持行政全面工作。</span><br />\r\n	<br />\r\n	<span style=\"font-size:12px;\"><strong><span style=\"font-size:16px;\">校党委副书记</span></strong></span><strong style=\"font-family: serif; font-size: 12px; \"><span style=\"font-size: 16px; \">：</span></strong><span style=\"font-size:12px;\"><strong><span style=\"font-size:16px;\">赖卫华</span></strong></span><br />\r\n	<span style=\"font-size: 12px;\">分管组织干部、宣传、思想政治理论课工作、统战、离退休、计划生育、校友会工作。</span><br />\r\n	<br />\r\n	<span style=\"font-size: 12px;\"><strong><span style=\"font-size:16px;\">副校长</span></strong></span><strong style=\"font-family: serif; font-size: 12px;\"><span style=\"font-size: 16px; \">：</span></strong><span style=\"font-size: 12px;\"><strong><span style=\"font-size:16px;\">董皞</span></strong></span><br />\r\n	<span style=\"font-size: 12px;\">分管财务、高等职业教育、成人教育、体育、中小学校长和师资培训、直属单位工作。</span><br />\r\n	<br />\r\n	<span style=\"font-size: 12px;\"><span style=\"font-size:16px;\"><strong>副校长</strong></span></span><strong style=\"font-family: serif; font-size: 12px;\"><span style=\"font-size: 16px; \">：</span></strong><span style=\"font-size: 12px;\"><span style=\"font-size:16px;\"><strong>禹奇才</strong></span></span><br />\r\n	<span style=\"font-size: 12px;\">分管党委办公室校办公室、桂花岗校区、依法治校、信息化建设工作。</span><br />\r\n	<br />\r\n	<span style=\"font-size:12px;\"><strong><span style=\"font-size:16px;\">副校长</span></strong></span><strong style=\"font-family: serif; font-size: 12px; \"><span style=\"font-size: 16px; \">：</span></strong><span style=\"font-size:12px;\"><strong><span style=\"font-size:16px;\">陈永亨</span></strong><br />\r\n	<br />\r\n	分管人事、科技与服务地方、学报、档案管理、重点实验室建设工作。<br />\r\n	<br />\r\n	<br />\r\n	<span style=\"font-size:16px;\"><strong>纪委书记</strong></span></span><strong style=\"font-family: serif; font-size: 12px; \"><span style=\"font-size: 16px; \">：</span></strong><span style=\"font-size:12px;\"><span style=\"font-size:16px;\"><strong>陈少梅</strong></span></span><br />\r\n	<span style=\"font-size: 12px;\">主持纪委全面工作，分管监察、审计、招投标管理、工会、教代会工作。</span><br />\r\n	<br />\r\n	<span style=\"font-size: 12px;\"><span style=\"font-size:16px;\"><strong>副校长</strong></span></span><strong style=\"font-family: serif; font-size: 12px;\"><span style=\"font-size: 16px; \">：</span></strong><span style=\"font-size: 12px;\"><span style=\"font-size:16px;\"><strong>徐俊忠</strong></span></span><br />\r\n	<span style=\"font-size: 12px;\">分管研究生教育与管理、人文社会科学研究、重点学科建设工作。</span><br />\r\n	<br />\r\n	<span style=\"font-size:12px;\"><strong><span style=\"font-size:16px;\">副校长：陈爽</span></strong></span><br />\r\n	<span style=\"font-size: 12px;\">分管学生思想政治教育与管理、共青团、学生社团、校园文化活动、国际交流与合作、实验室与设备管理工作。&nbsp;</span><br />\r\n	<br />\r\n	<strong><span style=\"font-size: 16px; \">校长助理：</span>邓成明 &nbsp;周云 &nbsp;傅继阳</strong><br />\r\n	<span style=\"font-family: serif; font-size: 12px;\">全面辅助校长各项工作。</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('402','1160','1','','<!--#p8_attach#-->/cms/item/2017_02/17_09/0632f21ab2ee08dd.jpg','主持党委工作','118.249.34.29','118.249.34.29','1487295833','<font color=\"#333333\" face=\"微软雅黑, Microsoft YaHei, Helvetica Neue, Helvetica, Arial, sans-serif\"><span style=\"font-size: 12px; line-height: 28px; background-color: rgb(255, 255, 255);\">主持党委工作</span></font>');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('403','1161','1','','<!--#p8_attach#-->/cms/item/2017_02/17_09/5bce7731b94874f8.jpg','协助书记负责安全维稳丶学生丶共青团及工会工作，主管学生工作处。','118.249.34.29','118.249.34.29','1487296076','协助书记负责安全维稳丶学生丶共青团及工会工作，主管学生工作处。');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('405','1164','1','','','23423432','113.246.92.14','113.246.92.14','1495294748','&nbsp;23423432');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('406','1165','1','','','23423432','113.246.92.14','113.246.92.14','1495294754','&nbsp;23423432');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('411','1170','1','','<!--#p8_attach#-->/cms/item/2017_05/21_10/af32a2c6aa3e9b9a.jpg','它们的头上各有一盏门灯,像两颗夜明珠镶嵌在上面。门柱中间,有一块大理石,上面刻着“余姚市阳明小学”这七个闪烁','113.246.92.137','113.247.23.222','1495296000','<p>&nbsp;</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n\r\n<p style=\"text-align: center;\"><a href=\"<!--#p8_attach#-->/cms/item/2017_05/21_10/af32a2c6aa3e9b9a.jpg\" target=\"_blank\"><img alt=\"01300000376166124072512161187.jpg\" src=\"<!--#p8_attach#-->/cms/item/2017_05/21_10/af32a2c6aa3e9b9a.jpg.cthumb.jpg\" style=\"height: 375px; width: 600px\" /></a></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('416','1175','1','','<!--#p8_attach#-->/cms/item/2017_05/22_06/cd2129dbb3b55922.jpg','沿着通向学校的劳动路,我来到了静谧的校门前。早晨,太阳光照在校园里,像给校园披上了一件金色的外套,壮观极了!校门口有两个像卫兵似的门柱','113.246.92.137','113.247.23.222','1495405974','<p style=\"text-align: center;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href=\"<!--#p8_attach#-->/cms/item/2017_05/22_06/095e2bccd17c0d22.jpg\" target=\"_blank\"><img alt=\"001YRz1jzy6TQzP9jkt49&690.jpg\" src=\"<!--#p8_attach#-->/cms/item/2017_05/22_06/095e2bccd17c0d22.jpg.cthumb.jpg\" style=\"height: 240px; width: 600px\" /></a></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('422','1183','1','','','2012年7月22至23日，袁军副校长率中国传媒大学师生学术代表团参加了在泰国曼谷朱拉隆公大学举办的第八届国际博士研究生学术研讨会。会议期间，袁军副校长与相关国际合作院校负责人就深化研究生合作办学、学术交流等事','113.246.92.184','113.246.92.184','1493689051','<p style=\"TEXT-INDENT: 2em\">\r\n	2012<span style=\"FONT-FAMILY: 宋体\">年</span>7<span style=\"FONT-FAMILY: 宋体\">月</span>22<span style=\"FONT-FAMILY: 宋体\">至</span>23<span style=\"FONT-FAMILY: 宋体\">日，袁军副校长率中国传媒大学师生学术代表团参加了在泰国曼谷朱拉隆公大学举办的第八届国际博士研究生学术研讨会。会议期间，袁军副校长与相关国际合作院校负责人就深化研究生合作办学、学术交流等事宜进行了富有成果的会谈。</span></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p align=\"center\" style=\"TEXT-INDENT: 2em; TEXT-ALIGN: center\">\r\n	<span style=\"text-indent: 2em; font-family: 宋体; \">国际</span><span style=\"text-indent: 2em; font-family: 宋体; \">博士研究生学术研讨会是由澳大利亚麦考瑞大学和清华大学发起的一个集学术研讨、人才培养、国际合作于一体的高端学术活动。研讨会旨在通过学术研讨的形式，促进合作院校在博士生培养、学术研究以及国际校际合作等方面开展深度交流与合作。目前共有包括麦考瑞大学、清华大学、巴黎第三大学（巴黎索邦大学）、泰国国立朱拉隆公大学、美国德克萨斯大学奥斯汀分校和中国传媒大学在内的六所院校参与了此项活动。</span></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	<span style=\"FONT-FAMILY: 宋体\">本次会议的主题是&ldquo;&lsquo;</span>M<span style=\"FONT-FAMILY: 宋体\">&rsquo;的世界：研究方法的跨学科拓展&rdquo;，集中研讨新闻传播和传媒研究的方法论问题。我校共有</span>9<span style=\"FONT-FAMILY: 宋体\">名博士生的学术论文通过评审，进入会议主题发言和海报展示环节，其中包括</span>2<span style=\"FONT-FAMILY: 宋体\">名留学我校的国际博士生。</span></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	<span style=\"FONT-FAMILY: 宋体\">袁军副校长代表中国传媒大学在会议开幕式上作了题为《&ldquo;渔&rdquo;胜于&ldquo;鱼&rdquo;&mdash;&mdash;中国传媒大学博士生方法课教学的几点思考》的主题演讲，详细介绍了我校博士研究生培养中方法论课程的设置思路和改革路径，获得与会者高度赞赏。</span></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	<span style=\"FONT-FAMILY: 宋体\">我校研究生院副院长田智辉教授、中国国际传播战略与发展研究中心常务副主任张毓强副教授，以及传播研究院教师黄典林博士分别担任了不同小组研讨的主持人和学术评议人。</span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('423','1177','1','','<!--#p8_attach#-->/cms/item/2017_05/21_10/af32a2c6aa3e9b9a.jpg','它们的头上各有一盏门灯,像两颗夜明珠镶嵌在上面。门柱中间,有一块大理石,上面刻着“余姚市阳明小学”这七个闪烁','113.246.92.137','113.246.92.137','1495406318','<p>&nbsp;</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href=\"<!--#p8_attach#-->/cms/item/2017_05/21_10/af32a2c6aa3e9b9a.jpg\" target=\"_blank\"><img alt=\"01300000376166124072512161187.jpg\" src=\"<!--#p8_attach#-->/cms/item/2017_05/21_10/af32a2c6aa3e9b9a.jpg.cthumb.jpg\" style=\"height: 375px; width: 600px\" /></a></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('424','1178','1','','<!--#p8_attach#-->/cms/item/2017_05/22_06/cd2129dbb3b55922.jpg','沿着通向学校的劳动路,我来到了静谧的校门前。早晨,太阳光照在校园里,像给校园披上了一件金色的外套,壮观极了!校门口有两个像卫兵似的门柱','113.246.92.137','113.246.92.137','1495406318','&nbsp;&nbsp;&nbsp; <a href=\"<!--#p8_attach#-->/cms/item/2017_05/22_06/095e2bccd17c0d22.jpg\" target=\"_blank\"><img alt=\"001YRz1jzy6TQzP9jkt49&690.jpg\" src=\"<!--#p8_attach#-->/cms/item/2017_05/22_06/095e2bccd17c0d22.jpg.cthumb.jpg\" style=\"height: 240px; width: 600px\" /></a>');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('425','1184','1','','','6月28日下午，台州广播电视台《600全民新闻》节目办公室的电话骤然响起，原来是该市黄岩区一家制造太空杯的工厂发生火灾。我校实习记者徐鑫和电视台另外两名记者带上设备，立即驱车赶赴火灾现场实施报道。火灾现场一','113.246.92.184','113.246.92.184','1493689532','<div class=\"content_main\">\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		6月28日下午，台州广播电视台《600全民新闻》节目办公室的电话骤然响起，原来是该市黄岩区一家制造太空杯的工厂发生火灾。我校实习记者徐鑫和电视台另外两名记者带上设备，立即驱车赶赴火灾现场实施报道。</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		火灾现场一片惨烈，滚滚浓烟直冲天际，不时响起的爆炸声震耳欲聋，几十辆消防车停在了工厂附近，奋力灭火，交警在忙着疏散现场&hellip;&hellip;</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		在没有任何防护措施的情况下，徐鑫同学和同伴立即投入到现场报道中，通过即时画面播报火灾现场的情景，特别是消防战士手持高压水枪奋力灭火的壮举。由于火势猛烈，在离现场几十米开外的地方就已经让人感到高温难耐，塑料燃烧产生的难闻气味也让人不得不捂住鼻子。&ldquo;我们要接近现场往火势最猛的地方去，这样才能拍摄到最真实的场景。&rdquo;事后徐鑫这样说道。</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		这次新闻现场播报，是2009级广播电视新闻学专业学生徐鑫来台州广播电视总台实习的第三天遇到的事。回想那次现场拍摄经历，徐鑫别有一番感触：&ldquo;记者还要顶着最艰辛的环境做现场出镜。这样的情况是给记者们的一个选择，一个职业精神与生命安全之间的选择，其实无论是哪个都是无可厚非的。&rdquo;</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		《600全民新闻》是台州电视台的一档民生新闻节目，几乎每天都会遇到各种各样的突发性事件，记者总会在第一时间赶到现场。这样的任务，对于实习生徐鑫来说，不仅仅是采访实践的磨练机会，也是一次次真实的考验。在实习的这两周里，她克服了很多困难，也积累了不少的经验。徐鑫同学的敬业精神受到了电视台记者的肯定，影视文化频道的记者蒋琦说：&ldquo;徐鑫同学能够虚心向指导老师求教钻研业务，现在已经很好地掌握了新闻采访写作的方法，表现良好。&rdquo;</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		包括徐鑫在内，今年来台州广播电视台参加教务处顶岗实习项目的共有六名同学，分别在台州电视台新闻综合频道、影视文化频道和公共财富频道等频道实习实践，或参加采访，或参与播音，或承担技术。尽管实习实践岗位不同，有的同学还是第一次参加这样的实践，但是同学们的责任感一样的强，干劲一样的足，他们知道，只有通过一线实践，才能更好地理解、把握和运用好在课堂上学到的知识，同时，通过实践锻炼和磨砺，又可以进一步增强学校学习的针对性和主动性。正如2011级新闻双学位的王娟同学所说的那样，&ldquo;参与顶岗实习，跟着记者真正进行一次实地采访，才真正明白新闻报道应该怎么做&rdquo;。</p>\r\n	<p style=\"TEXT-INDENT: 2em\">\r\n		雨季过后，台州进入夏季高温天气，实习生们每天都要跟随记者，冒着35℃以上的高温奔赴各地参与新闻拍摄。尽管如此，同学们没有一个叫苦，叫累，而是以他们的坚韧和毅力，用他们的学识和智慧，为台州广播电视事业贡献着点点滴滴，同时也在这点点滴滴中成长成熟&hellip;&hellip;</p>\r\n	<p align=\"right\" style=\"TEXT-INDENT: 2em\">\r\n		（文：曹坤、王悦&nbsp;图：王晴沐洋、王悦 编辑：王维家）&nbsp;</p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('426','1185','1','','','2012年7月22至23日，袁军副校长率中国传媒大学师生学术代表团参加了在泰国曼谷朱拉隆公大学举办的第八届国际博士研究生学术研讨会。会议期间，袁军副校长与相关国际合作院校负责人就深化研究生合作办学、学术交流等事','223.73.194.152','223.73.194.152','1493618517','<p style=\"TEXT-INDENT: 2em\">\r\n	2012<span style=\"FONT-FAMILY: 宋体\">年</span>7<span style=\"FONT-FAMILY: 宋体\">月</span>22<span style=\"FONT-FAMILY: 宋体\">至</span>23<span style=\"FONT-FAMILY: 宋体\">日，袁军副校长率中国传媒大学师生学术代表团参加了在泰国曼谷朱拉隆公大学举办的第八届国际博士研究生学术研讨会。会议期间，袁军副校长与相关国际合作院校负责人就深化研究生合作办学、学术交流等事宜进行了富有成果的会谈。</span></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p align=\"center\" style=\"TEXT-INDENT: 2em; TEXT-ALIGN: center\">\r\n	<span style=\"text-indent: 2em; font-family: 宋体; \">国际</span><span style=\"text-indent: 2em; font-family: 宋体; \">博士研究生学术研讨会是由澳大利亚麦考瑞大学和清华大学发起的一个集学术研讨、人才培养、国际合作于一体的高端学术活动。研讨会旨在通过学术研讨的形式，促进合作院校在博士生培养、学术研究以及国际校际合作等方面开展深度交流与合作。目前共有包括麦考瑞大学、清华大学、巴黎第三大学（巴黎索邦大学）、泰国国立朱拉隆公大学、美国德克萨斯大学奥斯汀分校和中国传媒大学在内的六所院校参与了此项活动。</span></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	<span style=\"FONT-FAMILY: 宋体\">本次会议的主题是&ldquo;&lsquo;</span>M<span style=\"FONT-FAMILY: 宋体\">&rsquo;的世界：研究方法的跨学科拓展&rdquo;，集中研讨新闻传播和传媒研究的方法论问题。我校共有</span>9<span style=\"FONT-FAMILY: 宋体\">名博士生的学术论文通过评审，进入会议主题发言和海报展示环节，其中包括</span>2<span style=\"FONT-FAMILY: 宋体\">名留学我校的国际博士生。</span></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	<span style=\"FONT-FAMILY: 宋体\">袁军副校长代表中国传媒大学在会议开幕式上作了题为《&ldquo;渔&rdquo;胜于&ldquo;鱼&rdquo;&mdash;&mdash;中国传媒大学博士生方法课教学的几点思考》的主题演讲，详细介绍了我校博士研究生培养中方法论课程的设置思路和改革路径，获得与会者高度赞赏。</span></p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	&nbsp;</p>\r\n<p style=\"TEXT-INDENT: 2em\">\r\n	<span style=\"FONT-FAMILY: 宋体\">我校研究生院副院长田智辉教授、中国国际传播战略与发展研究中心常务副主任张毓强副教授，以及传播研究院教师黄典林博士分别担任了不同小组研讨的主持人和学术评议人。</span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('427','1186','1','','','&ldquo;新型城镇化&rdquo;现已成为一个全民议题。如何走新型城镇化道路，需要全社会尤其是&ldquo;规划师&rdquo;的探索与创新。作为担当城乡规划重任的&ldquo;青年规划师&rdquo;的思考及探索，将为中国新型城镇化实践提供新的思路。　　17日，以&ldquo;新型城镇化与城乡规','113.246.92.184','113.246.92.184','1493689051','<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">&ldquo;新型城镇化&rdquo;现已成为一个全民议题。如何走新型城镇化道路，需要全社会尤其是&ldquo;规划师&rdquo;的探索与创新。作为担当城乡规划重任的&ldquo;青年规划师&rdquo;的思考及探索，将为中国新型城镇化实践提供新的思路。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　17日，以&ldquo;新型城镇化与城乡规划编制创新&rdquo;为主题的&ldquo;第三届金经昌中国青年规划师创新论坛&rdquo;在上海举行。近期，北京启动总体规划调整和修改，上海启动新一轮城市总体规划编制，在此背景下，本次论坛聚焦&ldquo;大都市地区总体规划编制创新&rdquo;这一热点，展开研讨。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　自2007年开始，全世界一半以上的人口生活在城市，世界正式进入了&ldquo;城市纪元&rdquo;，城市成为了全球人关注的重点；而预计到2040年，全球将有64.7%的人生活在城市中。城市已经成为最不了不起的成就。但城市发展中又面临种种问题。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　中国城市规划设计研究院总规划师张兵在论坛上作了题为《场所&middot;结构&middot;治理&mdash;大都市地区空间发展与总体规划》的报告。他说，大都市地区新一轮总体规划编制工作出现了一些新特点，包括开展前期评估、公众参与、以人为本、从重规模转向重结构、强调生态文明建设和文化传承等，这反映了规划工作者在改进规划方面所作的努力，但这些改进还无法真正解决大都市区历史性转变中面临着的现实需要。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　张兵强调，应该通过出行等人的行为来认识都市区内部发育状况，为规划重点问题解决提供认识基础，在此基础上，他指出大都市区总规改进的三个方向：结构塑形、设施引领场所再组织和改革空间治理体系。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　当前，生态与可持续发展已成为城市发展的目标，上海也在这方面紧随世界的步伐。上海提出以节能减排先进城市系统为其建设的基本目标。同时在具体区域，如建设崇明生态岛、真如城市副中心、崇明陈桥镇生态城镇、长风商务区等，以此在城市开发中注重生态发展。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　上海市规划与国土资源局副局长徐毅松介绍了刚刚启动的上海新一轮总体规划编制工作思路，生态环境颇为引人关注。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　值得关注的是，尽管从上世纪90年代起，全世界都热衷将生态作为一种标签，但往往流于表面形式，世界各地也依次出现了一些不同类型的生态城市试验，例如荷兰的太阳城、斯德哥尔摩哈马尔比滨水城、上海的崇明东滩生态城等。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n<span style=\"widows: 2; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\">　　城市规划到底走向何方？可能如中科院院士、同济大学郑时龄教授当天在当天举行的上海科普大讲坛上所言，&ldquo;我们按照自己的文化和理想建设我们的城市，理想、想象和幻想越是丰富，我们的城市也就越理想&rdquo;。</span><br style=\"padding: 0px; widows: 2; margin: 0px; font-size: 14px; line-height: 25px; font-family: 宋体, Verdana, Arial, Tahoma; orphans: 2; color: rgb(51, 51, 51);\" />\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('428','1192','1','','<!--#p8_attach#-->/cms/item/2017_07/27_15/ac93d74478454a86.jpg','6月初，湖南大学岳麓书院2017届毕业典礼上，2013级历史学本科生刘楚莹成了场上第一个泪崩的人。那个瞬间，她正和同门师兄一起向学业导师邓洪波教授鞠躬谢师','113.246.94.58','113.246.94.58','1500566400','<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: calibri;\">6</span></span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">月初，湖南大学岳麓书院</span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: calibri;\">2017</span></span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">届毕业典礼上，</span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: calibri;\">2013</span></span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">级历史学本科生刘楚莹成了场上第一个泪崩的人。那个瞬间，她正和同门师兄一起向学业导师邓洪波教授鞠躬谢师。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"<!--#p8_attach#-->/cms/item/2017_07/27_15/9002a6403aac95ed.jpg\" target=\"_blank\"><img alt=\"动态1.jpg\" src=\"<!--#p8_attach#-->/cms/item/2017_07/27_15/9002a6403aac95ed.jpg.cthumb.jpg\" style=\"height: 400px; width: 600px;\" /></a></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\"><span style=\"word-break: break-all; padding: 0px;\">&ldquo;你有什么烦恼就尽管来找我。&rdquo;&ldquo;老师这里永远为你敞开怀抱。&rdquo;&ldquo;你们就像儿女一样，老师希望你们留下来，但老师更希望你们飞得更高。&rdquo;在刘楚莹眼里，导师不只是她学术的领路人，更是她值得信赖的长辈，是精神导师，是她成长路上的&ldquo;灯塔&rdquo;。收到保研录取通知书的那一刻，一句&ldquo;楚莹，恭喜你出嫁了&rdquo;，更让她感动到哭。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">在湖南大学岳麓书院，留下了很多这样&ldquo;有温度&rdquo;的师生故事。本科生导师制搭起了师生之间的这座桥梁。从</span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: calibri;\">2009</span></span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">年开始，岳麓书院立足当代高等教育发展的实际，汲取传统书院文化之精华，实行本科生导师制。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\"><span style=\"word-break: break-all; padding: 0px;\">经过八年多的实践和探索，目前已形成了包括学业导师、生活导师、班导师、学术兴趣导师在内四位一体的本科生人才培养模式，续写着千年学府的光荣与梦想。岳麓书院院长肖永明教授表示，岳麓书院本科生导师制既有对古代书院教育传统的继承，对书院教育理念与实践经验的借鉴，也立足于高等教育发展的现实，顺应了时代发展的潮流。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p align=\"center\"><strong style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">做人与做学问</span></span></span></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">本科就有导师是什么样的体验？&ldquo;如果你对历史学习感兴趣，一定会觉得这是几辈子求来的福气。&rdquo;在岳麓书院，有学生这样形容来书院求学的&ldquo;小幸运&rdquo;。岳麓书院从</span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: calibri;\">2009</span></span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">年开始招收历史学专业本科生，每个学生都有一位学业导师进行一对一的指导。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">李伟，岳麓书院</span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: calibri;\">2010</span></span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">级历史学本科生，本科毕业后在复旦大学历史地理研究中心硕博连读，和曾经的学业导师肖永明教授依然保持着非常紧密的联系。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\"><span style=\"word-break: break-all; padding: 0px;\">&ldquo;现在看来，他发展得很不错。如果我们不去引导他，可能他的潜力就难以发掘出来了。&rdquo;肖永明感到很欣慰。他回忆，因为一些外在因素，李伟在大一时曾一心想考公务员。&ldquo;考上了，那这个社会也只是多了一个普普通通的公务员，却少了一个做学问的好苗子。&rdquo;凭他的经验，李伟好学慎思，&ldquo;是个读书的种子&rdquo;。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\"><span style=\"word-break: break-all; padding: 0px;\">引导李伟往学术方向改变，他花了不少心思。&ldquo;我经常找他谈话，希望他看到自己的特长和真正的兴趣。我的博士是他的生活导师，也会在不同的场合跟他交流，希望他找准自己的方向，要扬长避短。&rdquo;虽然中间偶有反复，但李伟在大二时终于确定了学术之路。每周二的师门读书会，他&ldquo;雷打不动&rdquo;地参加。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\"><span style=\"word-break: break-all; padding: 0px;\">学业导师是岳麓书院本科生导师制的主体。在肖永明看来，传统的书院教育追求&ldquo;求学&rdquo;与&ldquo;求道&rdquo;的统一，融德行与学问为一体，关注知识的传授，更重视学生品德的培养。&ldquo;这就要求我们的教师不仅仅在学业方面对学生加以指点，而且要在学生价值观念形成与人格养成的过程中，在为学进德、待人接物、为人处世等方面给予学生以引导。&rdquo;</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">作为肖永明教授的学生，</span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: calibri;\">2013</span></span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">级历史学本科生蒋明也在学业导师的指导下，一步步走向专业历史学科学习的大门。在为人处世上，他更是耳濡目染，以导师为榜样。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\"><span style=\"word-break: break-all; padding: 0px;\">&ldquo;让我很有体会的一点就是肖老师对他的老师陈谷嘉教授的尊重和关怀。每次提到老先生时他的眼里总是充满了敬意；老先生现在退休在家，肖老师逢年过节就会去看望他，有年中秋还叫了我们几个学生一起去陪老先生过节。&rdquo;他说，这让他真正体会到了什么是尊师重道。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\"><span style=\"word-break: break-all; padding: 0px;\">有学术探讨，有情感交流，亦师亦友，朝夕相处，谈学论道，切磋砥砺&mdash;&mdash;传统书院教育中的师生关系，在今日的岳麓书院重焕活力。</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">书院连续几年就导师制实施情况对毕业生进行回访，当问到&ldquo;学业导师对您对帮助体现在什么方面&rdquo;时，有三分之二的人选择了&ldquo;人格熏陶&rdquo;和&ldquo;论文写作&rdquo;。</span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: calibri;\">2013</span></span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">级历史学本科</span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: calibri;\">29</span></span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">名学生，有</span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: calibri;\">20</span></span></span><span style=\"word-break: break-all; padding: 0px;\"><span style=\"font-family: 宋体;\">人继续读研深造，升学率近七成，又为书院当代复兴做了更为生动和有力的注脚。</span></span></span></p>\r\n\r\n<div>&nbsp;</div>\r\n\r\n<div>&nbsp;</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('430','1194','1','','<!--#p8_attach#-->/cms/item/2017_07/27_15/dec8d35c035eea84.jpg',' 5月21日，“中华文化四海行—走进湖南”在我校举办文化讲坛，中央文史馆馆员、复旦大学资深教授、著名历史地理学家葛剑雄带来《传统文化的“传”和“承”》专题讲座。中央文史研究馆、全国各地文史研究馆的200余位专家学者和我校学生代表参加活动。校党委副书记陈伟主持讲座。','113.246.94.58','113.246.94.58','1500566400','<p><span style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);\">&nbsp; &nbsp; &nbsp; &nbsp; 5月21日，&ldquo;中华文化四海行&mdash;走进湖南&rdquo;在我校举办文化讲坛，中央文史馆馆员、复旦大学资深教授、著名历史地理学家葛剑雄带来《传统文化的&ldquo;传&rdquo;和&ldquo;承&rdquo;》专题讲座。中央文史研究馆、全国各地文史研究馆的200余位专家学者和我校学生代表参加活动。校党委副书记陈伟主持讲座。</span></p>\r\n\r\n<p style=\"text-align: center;\"><a href=\"<!--#p8_attach#-->/cms/item/2017_07/27_15/a886c4481f6864e9.jpg\" target=\"_blank\"><img alt=\"动态3.jpg\" src=\"<!--#p8_attach#-->/cms/item/2017_07/27_15/a886c4481f6864e9.jpg.cthumb.jpg\" style=\"height: 399px; width: 600px;\" /></a></p>\r\n\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"padding: 0px; margin: 0px;\">&ldquo;中华文化四海行&mdash;走进湖南&rdquo;，由国务院参事室、中央文史研究馆、湖南省人民政府共同举办，以&ldquo;弘扬中华优秀传统文化、展示伟人故里锦绣湖南&rdquo;为主题，于5月20日至25日在长沙、岳阳举行，包括文化讲坛、书画精品联展、文艺联谊、名家进校园、大型书画联谊笔会等，在湖南大学、湖南师范大学、湖南理工学院三所高校举办文化讲坛。</span></div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"padding: 0px; margin: 0px;\"><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">讲座上，葛剑雄认为</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">传统文化的&ldquo;传&rdquo;即无条件保存保留，作为历史的记忆和资源的储存</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">，</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">传统文化的&ldquo;承&rdquo;，</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">就</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">是有选择的继承和弘扬，取其精华，去其糟粕，并需要进行创造性的转化</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">。讲座内容丰富，语言风趣幽默、通俗易懂，现场掌声阵阵、氛围热烈。</span></span></div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"padding: 0px; margin: 0px;\">陈伟在活动最后勉励我校学子，希望大家能够认真学习、主动担当、自觉传播优秀传统文化，充分认识传统文化的时代价值，坚守精神家园，坚定文化自信，努力成为中华文化的笃信者、传承者、躬行者，为中华文化发扬光大、中华民族伟大复兴贡献自己的青春力量。</span></div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"padding: 0px; margin: 0px;\">会后，与会专家学者参观了我校岳麓书院。</span></div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\">&nbsp;</div>\r\n\r\n<div align=\"justify\" style=\"font-size: 14px; font-family: 微软雅黑; color: rgb(50, 51, 51); padding: 0px; text-align: justify; margin: 0pt; line-height: 21px; background-color: rgb(255, 255, 255); text-indent: 21pt;\"><span style=\"padding: 0px; margin: 0px;\"><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">据悉，&ldquo;中华文化四海行&rdquo;是国务院参事室、中央文史研究馆推出的大型文化活动，</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">以强大的专家阵容、深厚的文化含量和丰富的活动形式，全方位、多角度展示和传播中华优秀传统文化，</span><span style=\"padding: 0px; margin: 0px; line-height: 21px;\">自2013年以来已相继在贵州、云南、重庆、甘肃、新疆、澳门成功举办，受到各界民众的热烈欢迎。</span></span></div>\r\n\r\n<div>&nbsp;</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('431','1195','1','','<!--#p8_attach#-->/cms/item/2017_07/27_15/10708333bdf103eb.jpg','5月5日下午，湖南省委教育工委宣传部部长曾力勤等来我校调研易班建设及推广工作，我校学工部相关负责人、相关科室老师、学校易班工作站相关负责人陪同调研。','113.246.94.58','113.247.22.86','1500570000','<p style=\"text-align: center\"><a href=\"<!--#p8_attach#-->/cms/item/2017_07/27_15/86405a2e8735b713.jpg\" target=\"_blank\"><img alt=\"动态4.jpg\" src=\"<!--#p8_attach#-->/cms/item/2017_07/27_15/86405a2e8735b713.jpg.cthumb.jpg\" style=\"height: 399px; width: 600px\" /></a></p>\r\n\r\n<p align=\"justify\" style=\"background: rgb(255,255,255); padding-bottom: 0pt; text-align: justify; padding-top: 0pt; padding-left: 0pt; margin-left: 0pt; padding-right: 0pt; margin-right: 0pt; text-indent: 24pt\"><span style=\"letter-spacing: 0pt\"><span style=\"font-size: 10.5pt\"><span style=\"color: rgb(51,51,51)\"><span style=\"font-family: 微软雅黑\">5月5日下午，湖南省委教育工委宣传部部长曾力勤等来我校调研易班建设及推广工作，我校学工部相关负责人、相关科室老师、学校易班工作站相关负责人陪同调研。</span></span></span></span></p>\r\n\r\n<p align=\"justify\" style=\"background: rgb(255,255,255); padding-bottom: 0pt; text-align: justify; padding-top: 0pt; padding-left: 0pt; padding-right: 0pt; margin-right: 0pt; text-indent: 21pt\"><span style=\"letter-spacing: 0pt\"><span style=\"font-size: 10.5pt\"><span style=\"color: rgb(51,51,51)\"><span style=\"font-family: 微软雅黑\">学工部相关负责人从我校易班建设的组织架构、建设目标与总体思路、前期建设成果以及2017年建设规划等方面介绍了我校易班建设及推广情况。2016年是我校易班建设元年，学校从制度、经费、场地上给予了强有力的支持。目前我校易班注册突破1万人，2016级新生注册率突破97%，题库使用量突破35万人次。2017年学校易班发展中心、易班学生工作站将会继续开发系列贴近学生的轻应用等，完善学院易班工作站队伍建设和培训，开展系列线上线下活动，让易班更加走进同学们的生活。</span></span></span></span></p>\r\n\r\n<p align=\"justify\" style=\"background: rgb(255,255,255); padding-bottom: 0pt; text-align: justify; padding-top: 0pt; padding-left: 0pt; margin-left: 0pt; padding-right: 0pt; margin-right: 0pt; text-indent: 24pt\">&nbsp;<span style=\"letter-spacing: 0pt\"><span style=\"font-size: 10.5pt\"><span style=\"color: rgb(51,51,51)\"><span style=\"font-family: 微软雅黑\">学校易班学生工作站站长团成员展示了我校易班首页内容，汇报了工作站的中心构架、日常工作的开展和近期工作安排，并对筹备中的古诗词大会及即将在易班APP上线的线上请销假、跳蚤市场等功能进行了介绍。</span></span></span></span></p>\r\n\r\n<p align=\"justify\" style=\"background: rgb(255,255,255); padding-bottom: 0pt; text-align: justify; padding-top: 0pt; padding-left: 0pt; margin-left: 0pt; padding-right: 0pt; margin-right: 0pt; text-indent: 24pt\"><span style=\"letter-spacing: 0pt\"><span style=\"font-size: 10.5pt\"><span style=\"color: rgb(51,51,51)\"><span style=\"font-family: 微软雅黑\">曾力勤对我校易班工作站的工作表示高度认可。他希望，湖南大学作为全省最早开展易班建设的高校之一，要发挥好示范带头作用，将湖大易班建设成更受学生欢迎、服务学生发展的连接载体。</span></span></span></span></p>\r\n\r\n<p align=\"justify\" style=\"background: rgb(255,255,255); padding-bottom: 0pt; text-align: justify; padding-top: 0pt; padding-left: 0pt; margin: 0pt; padding-right: 0pt; text-indent: 0pt\">&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('549','1339','1','','<!--#p8_attach#-->/cms/item/2020_02/26_17/4128bb2a0f56aa9a.jpg','北京大学环境科学与工程学院胡敏教授、郭松研究员课题组与美国德州A&amp;amp;M大学张人一教授和彭剑飞博士开展合作研究，揭示机动车尾气的光化学氧化促进大气新粒子生成，进而导致我国城市地区霾的形成。研究显示，我国大气复合污染条件下，大气具有很强的超细颗粒物生成潜势，','36.157.141.61','36.157.141.61','1582710309','<div class=\"article\">\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\"><span style=\"text-indent: 2em;\">北京大学环境科学与工程学院胡敏教授、郭松研究员课题组与美国德州A&amp;M大学张人一教授和彭剑飞博士开展合作研究，揭示机动车尾气的光化学氧化促进大气新粒子生成，进而导致我国城市地区霾的形成。研究显示，我国大气复合污染条件下，大气具有很强的超细颗粒物生成潜势，而机动车尾气排放的大量挥发性有机物是造成大量超细颗粒物生成和增长的元凶。研究还进一步指出，单方面控制一次颗粒物的排放反而会促进超细颗粒物的生成，造成严重的颗粒物污染，甚至可能对人体健康危害更大。</span></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">该成果由北京大学环境模拟与污染控制国家重点实验室大气化学研究团队的胡敏教授、郭松研究员、吴志军研究员、曾立民教授和美国Texas A&amp;M University张人一教授团队、清华大学汽车与安全国家重点实验室帅石金教授研究团队等通力合作完成，得到国家自然科学基金和科技部国家重点研发计划资助。成果于北京时间2月4日发表在美国著名科学期刊《美国科学院院报》（<em>Proceedings of the National Academy of the Sciences of the United States of America</em>，缩写<em>PNAS</em>）上。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">大气中粒径小于100nm的颗粒物被称为超细颗粒物，这些超细颗粒物主要来自大气中气态污染物经过光化学反应生成，这一过程被称为&ldquo;新粒子生成&rdquo;。该团队前期的研究表明，城市地区新粒子生成过程产生了大量的纳米级粒子，数量可以达到每立方厘米100万个，这些纳米级颗粒物进一步增长是我国霾形成的重要原因。新粒子生成机制极其复杂，因时因地存在差别。由于新生成的粒子是纳米量级的，其气态前体物有机物的测定难度大，如何在真实环境大气中追踪新粒子生产过程，并给出直接的证据，是当今国际大气环境化学领域具有挑战性的前沿科学问题。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">该成果是研究团队2014年PNAS上发表的新粒子生成和持续增长是我国霾形成机制基础上的深化研究，以新的视角探究城市地区普遍存在机动车排放与新粒子生成的关联。研究团队开发了一套&ldquo;准实际&rdquo;大气烟雾箱模拟系统，在线追踪真实大气条件下新粒子生成的化学转化过程。通过同步测量实际大气和&ldquo;准实际&rdquo;大气烟雾箱中气态污染物和超细颗粒物的理化特征，揭示新粒子生成和增长的参数特征、化学机制和限制因素，发现机动车排放挥发性有机物是新粒子生成重要前体物。进一步利用清华大学汽车与安全国家重点实验室的机动车排放模拟平台结合烟雾箱模拟，验证机动车排放对新粒子生成的作用。研究结果表明，我国城市地区大气复合污染条件下，环境大气具有极强的新粒子生成潜势，这主要是由于机动车排放的高浓度的挥发性有机物造成的；该研究从机理上揭示了大气中已存在颗粒物、光化学反应和多种污染物协同光化学过程对新粒子生成的作用，提出了多种协同效应下城市污染地区新粒子生成与增长的机制，该研究成果对城市地区新粒子生成及其健康效应具有普适性。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">该研究成果表明大气中已存在颗粒物可以限制新粒子过程的发生，相反地，如果仅控制污染源排放的一次颗粒物，而不限制排放的气态污染物，尤其是挥发性有机物，将会促进新粒子过程的发生，随后新粒子的进一步增长将会加重我国城市地区霾的形成；另外，新粒子生成时产生大量更有穿透力的超细颗粒物，对人体健康存在更大的风险。为此，建议协同控制机动车一次排放的颗粒物和气态污染物，进而达到改善空气质量和保护人体健康的双赢效果。</p>\r\n\r\n<p><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/1b320148244434bd.png\" target=\"_blank\"><img alt=\"8e655e2b270a41d5865964c54085a230.png\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/1b320148244434bd.png.cthumb.jpg\" style=\"margin: 0px auto; width: 550px; height: 289px; text-align: center; text-indent: 0px; display: block;\" /></a></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px; text-align: center;\">机动车尾气导致城市大气中显著的新粒子生成和增长</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">原文网址：<a href=\"https://www.pnas.org/content/early/2020/01/28/1916366117\" style=\"text-decoration:none\">https://www.pnas.org/content/early/2020/01/28/1916366117</a></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">&nbsp;</p>\r\n</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('550','1340','1','','<!--#p8_attach#-->/cms/item/2020_02/26_17/3c48f5485338da98.jpg','　　新闻网讯　1月9至10日，为深入贯彻习近平总书记在学校思想政治理论课教师座谈会重要讲话精神，进一步加强北京高校思政课教师队伍建设，培养思政课教师&amp;amp;ldquo;六种素养&amp;amp;rdquo;，以&amp;amp;ldquo;京华大地看小康&amp;amp;rdquo;为主题的北京高校思想政治理论课教师&amp;amp;ldquo;看','36.157.141.61','36.157.141.61','1578304380','<p style=\"text-align: justify;\"><span style=\"font-family: 微软雅黑, \"Microsoft YaHei\"; font-size: 18px;\"><span style=\"font-family: 微软雅黑, \"Microsoft YaHei\"; font-size: 18px; text-align: justify;\">　　</span><span style=\"font-size: 18px; text-align: justify; font-family: 宋体, SimSun;\"><strong>新闻网讯　</strong></span><span style=\"font-family: 微软雅黑, \"Microsoft YaHei\"; font-size: 18px; text-align: justify;\">1月9至10日，<span style=\"font-family: 微软雅黑, \"Microsoft YaHei\"; font-size: 18px; text-align: justify;\">为</span></span>深入贯彻习近平总书记在学校思想政治理论课教师座谈会重要讲话精神，进一步加强北京高校思政课教师队伍建设，培养思政课教师&ldquo;六种素养&rdquo;，以&ldquo;京华大地看小康&rdquo;为主题的北京高校思想政治理论课教师&ldquo;看北京、看变化、看成就&rdquo;学习实践暨集体备课会在天湖国际会议酒店举办。本次会议为期两天，由北京市委教育工作委员会主办，北京高校中国特色社会主义理论研究协同创新中心（中央民族大学马克思主义学院）承办。来自北京市五十多所高校的近三百位专家学者参加会议。</span></p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"font-family: 微软雅黑, \"Microsoft YaHei\"; font-size: 18px;\"><span style=\"font-family: 微软雅黑, \"Microsoft YaHei\"; font-size: 18px; text-align: justify;\">　　</span>1月9日上午，北京市委教育工委副书记狄涛作辅导报告，清华大学马克思主义学院副院长肖贵清教授做&ldquo;改革开放与全面建成小康社会&rdquo;专题辅导报告。中央民族大学马克思主义学院副院长邵士庆介绍了会议组织情况。</span></p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"font-family: 微软雅黑, \"Microsoft YaHei\"; font-size: 18px;\"><span style=\"font-family: 微软雅黑, \"Microsoft YaHei\"; font-size: 18px; text-align: justify;\">　　</span>当日下午，六个研究分会小组分别前往门头沟区妙峰山炭厂村、门头沟区洪水口村、房山区韩村河村、朝阳区高碑店乡白家楼村、大兴区魏善庄李家场村、通州区于家务乡仇庄村六个实践点进行实地调研。调研中，各位老师通过了解所到村庄的发展变化，为思政课程建设提供了丰富多样的实践素材，有利于新时代背景下思政教育深入发展。当晚，全体与会人员集体观看电影《第一书记》。</span></p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"font-family: 微软雅黑, \"Microsoft YaHei\"; font-size: 18px;\"><span style=\"font-family: 微软雅黑, \"Microsoft YaHei\"; font-size: 18px; text-align: justify;\">　　</span>1月10日，五个研究分会小组分会场举行本课程寒假备课会，并进行交流讨论。马克思主义基本原理概论分会场中，北京大学马克思主义学院执行院长孙熙国教授、副院长陈培永教授分别作了&ldquo;十九届四中全会精神&rdquo;、&ldquo;思政课改革创新的若干思考&rdquo;专题报告，北京大学王浦劬教授作了&ldquo;国家社科基金项目申报的若干建议&rdquo;主题报告。思想道德修养与法律基础分会场中，郭建宁教授作了&ldquo;决胜全面小康，实现伟大复兴&rdquo;主题报告，徐斌教授作了从&ldquo;中国之制&rdquo;到&ldquo;中国之治&rdquo;的主题报告，并对撰写研讨与项目申报进行讲解。研究生思想政治理论课分会场中，张旭教授阐述了如何认识社会主义基本经济制度，李松林教授作了&ldquo;国家治理体系家制度和国家治理体系新宣言&mdash;&mdash;十九届四中全会精神解读&rdquo;的主题报告，张明国教授对《论&ldquo;理论创新和实践创新良性互动&rdquo;&mdash;&mdash;关于十九届四中全会精神&ldquo;三进&rdquo;的思考》进行了细致解读，并进行了优秀教学课程展示。中国近现代史纲要分会场中，北京高教学会中国近现代史研究会理事长、首都师范大学黄延敏教授汇报研究会2019年工作，北京大学仝华教授从三个时间段指出要加强&ldquo;纲要&rdquo;课教学与科研，北京航空航天大学李文爽副教授作&ldquo;北航&lsquo;纲要&rsquo;课程的教学与改革&rdquo;主题发言，北京信息科技大学杨延霞教授作&ldquo;新时代信息技术触入课的实践探索&rdquo;主题发言，并进行了国史、改革开放史教学的教学研讨。北京科技大学彭庆红教授作了&ldquo;坚决打赢脱贫攻坚战&rdquo;主题报告，北京体育大学陈世阳副教授作了&ldquo;人类命运共同体与中国外交新变化&rdquo;的主题报告，北方工业大学王包泉副教授作了&ldquo;止暴制乱，坚决维护&lsquo;一国两制&rsquo;与香港繁荣稳定&rdquo;主题报告。</span></p>\r\n\r\n<p style=\"text-align: justify;\"><span style=\"font-family: 微软雅黑, \"Microsoft YaHei\"; font-size: 18px;\"><span style=\"font-family: 微软雅黑, \"Microsoft YaHei\"; font-size: 18px; text-align: justify;\">　　</span>本次北京高校思想政治理论课教师学习实践暨集体备课会，有助于提升2020年北京市各高校思政课的建设水平，不断提升教学质量和教学效果，培养德智体美劳全面发展的社会主义建设者和接班人。</span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('551','1341','1','','<!--#p8_attach#-->/cms/item/2020_02/26_17/559576cf4e8d9625.jpg','　　新闻网讯　12月9日上午9:50，哲学与宗教学学院在文西1102教室开展讲座，由黄杰主讲。黄杰现任中共山西省委统战部九处处长、兼任中央民族大学宗教研究院客座研究员、山西省反邪教协会常务理事、山西省公安厅特聘专家、山西社会主义学院院务咨询委员会成员。他长期从','36.157.141.61','36.157.141.61','1582711077','<p class=\"vsbcontent_start\"><strong><span style=\"font-family: 宋体,SimSun; font-size: 18px;\">　　新闻网讯　</span></strong><span style=\"font-family: 微软雅黑,Microsoft YaHei; font-size: 18px;\">12月9日上午9:50，<span px=\"\" style=\"font-family: 微软雅黑, \">哲学与宗教学学院</span>在文西1102教室开展讲座，由黄杰主讲。黄杰现任中共山西省委统战部九处处长、兼任中央民族大学宗教研究院客座研究员、山西省反邪教协会常务理事、山西省公安厅特聘专家、山西社会主义学院院务咨询委员会成员。他长期从事民族宗教工作，参与处理了上世纪九十年代以来山西几乎所有重大宗教事件。本次讲座题目是&ldquo;新时代中国特色宗教政策解读&rdquo;，他围绕新时代中国特色宗教政策的种种相关问题展开讨论。</span></p>\r\n\r\n<p style=\"text-align:center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/e3ccefb56c31c9d6.jpg\" target=\"_blank\"><img alt=\"0E5BEAD1A2DBA9C0C0F2135534A_D80C1293_1F402.jpg\" class=\"img_vsb_content\" orisrc=\"/__local/8/B6/D6/0E5BEAD1A2DBA9C0C0F2135534A_D80C1293_1F402.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/e3ccefb56c31c9d6.jpg.cthumb.jpg\" style=\"border-width: 0px; border-style: solid; margin: 0px; width: 800px; height: 600px;\" title=\"\" vheight=\" 600px\" vsbhref=\"vurl\" vurl=\"/_vsl/8B6D60E5BEAD1A2DBA9C0C0F2135534A/D80C1293/1F402?e=.jpg\" vwidth=\" 800px\" /></a></p>\r\n\r\n<p><span px=\"\" style=\"font-family: 微软雅黑, \"><strong style=\"white-space: normal;\"><span style=\"font-family: 宋体, SimSun; font-size: 18px;\">　　</span></strong>黄杰首先从坚持和发展中国特色社会主义宗教理论讲起，提出：宗教有其存在的自身根源、社会根源、认识根源，因此要认识到宗教存在的长期性，准确把握我国宗教的主要特征，即：长期性、群众性、民族性、国际性、复杂性。他提出，宗教有积极作用和消极作用两重性，两者共生共存，我们要辩证看待我国宗教的社会作用，要因势利导、趋利避害，防止认识上的偏差和工作上的摇摆。结合若干典型案例，他指出我们要牢牢坚持党宗教工作的基本方针，坚持我国宗教中国化方向。我们处于各行各界的工作者、服务者们都要主动构建积极健康的宗教关系。最后他谈到了巩固和发展党同宗教界的爱国统一战线，共同致力于中国特色社会主义事业。</span></p>\r\n\r\n<p style=\"text-align:center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/b35dcb2008c95414.jpg\" target=\"_blank\"><img alt=\"1019E1EA2C1F466D27FC060EB71_C873AED3_200D0.jpg\" class=\"img_vsb_content\" orisrc=\"/__local/8/9B/7D/1019E1EA2C1F466D27FC060EB71_C873AED3_200D0.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/b35dcb2008c95414.jpg.cthumb.jpg\" style=\"border-width: 0px; border-style: solid; margin: 0px; width: 800px; height: 600px;\" title=\"\" vheight=\" 600px\" vsbhref=\"vurl\" vurl=\"/_vsl/89B7D1019E1EA2C1F466D27FC060EB71/C873AED3/200D0?e=.jpg\" vwidth=\" 800px\" /></a></p>\r\n\r\n<p class=\"vsbcontent_end\"><span style=\"font-family: 微软雅黑,Microsoft YaHei; font-size: 18px;\"><strong style=\"white-space: normal;\"><span style=\"font-family: 宋体, SimSun; font-size: 18px;\">　　</span></strong>在互动交流环节中，大家争先恐后积极提问，黄杰一一给予耐心细致的解答。</span></p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('552','1342','1','','<!--#p8_attach#-->/cms/item/2020_02/26_18/b473c345bbcc0a29.jpg','　　新闻网讯　2019年11月7日下午，中国社会科学院文学研究所陈思副研究员在文华楼西区701教室做题为：&amp;amp;ldquo;从&amp;amp;lsquo;人生&amp;amp;rsquo;到&amp;amp;lsquo;世界&amp;amp;rsquo;：今天我们怎样读懂路遥&amp;amp;rdquo;的学术讲座。讲座由我校文学院现当代文学教','36.157.141.61','36.157.141.61','1582711470','<p><span style=\"font-family: 宋体, SimSun; font-size: 18px; font-weight: 700;\">　　</span><strong><span style=\"font-family: 宋体,SimSun; font-size: 18px;\">新闻网讯　</span></strong><span style=\"font-family: 微软雅黑, \"Microsoft YaHei\"; font-size: 18px;\">2019年11月7日下午，中国社会科学院文学研究所陈思副研究员在文华楼西区701教室做题为：&ldquo;从&lsquo;人生&rsquo;到&lsquo;世界&rsquo;：今天我们怎样读懂路遥&rdquo;的学术讲座。讲座由我校文学院现当代文学教研室主任毕海主持，文学院50多位师生聆听了讲座。</span></p>\r\n\r\n<div>\r\n<p><span style=\"font-family: 微软雅黑,Microsoft YaHei; font-size: 18px;\">　　讲座主要内容分五个部分：路遥现象的冷与热；怎样的&ldquo;人生&rdquo;；《平凡的世界》多了什么；路遥的人生与创作；路遥为什么重要及如何读懂路遥和如何读懂经典。</span></p>\r\n\r\n<p style=\"text-align:center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_18/4ac885a28469ce71.png\" target=\"_blank\"><img alt=\"CA35006CE8A62957DC5E0B4E579_7FB3CFA1_5F730.png\" class=\"img_vsb_content\" orisrc=\"/__local/E/04/D4/CA35006CE8A62957DC5E0B4E579_7FB3CFA1_5F730.png\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_18/4ac885a28469ce71.png\" style=\"border-width: 0px; border-style: solid; margin: 0px; width: 800px; height: 593px; text-align: center; font-family: 微软雅黑,\"Microsoft YaHei\"; font-size: 18px;\" title=\"微信图片_20191118084954.png\" vheight=\" 593px\" vsbhref=\"vurl\" vurl=\"/_vsl/E04D4CA35006CE8A62957DC5E0B4E579/7FB3CFA1/5F730?e=.png\" vwidth=\" 800px\" /></a></p>\r\n\r\n<p><span style=\"font-family: 微软雅黑,Microsoft YaHei; font-size: 18px;\">　　陈思首先从分析路遥文学接受&ldquo;冷与热&rdquo;这一独特现象开始，介绍了路遥创作的艰难起步与挣扎前行。与路遥小说在读者中持续引发的巨大反响不同，路遥及其创作在主流文学界一直处在争议甚至被&ldquo;漠视&rdquo;的状态。20世纪80年代中期，同时期作家如贾平凹、莫言、王蒙等人展开了对&ldquo;现代主义&rdquo;文学的追求和实验，路遥却始终坚守社会主义现实主义文学创作的艺术手法和观念，由此被视为&ldquo;落伍&rdquo;作家，一度在文学史中&ldquo;消失&rdquo;。这一&ldquo;诡异&rdquo;的路遥现象，呈现出路遥文学的&ldquo;独特性&rdquo;以及特定时代文学观念对于作家的&ldquo;规训&rdquo;。</span></p>\r\n\r\n<p><span style=\"font-family: 微软雅黑,Microsoft YaHei; font-size: 18px;\">　　在讲座二、三部分，陈思对路遥两部经典作品《人生》和《平凡的世界》进行了细致的文本分析。他指出80年代初引起青年人广泛共鸣的《人生》实则是一个&ldquo;中国版&rdquo;的&ldquo;于连进城&rdquo;故事，反映了&ldquo;城乡差距&rdquo;和&ldquo;个人奋斗&rdquo;的时代主题。而与《人生》相比，《平凡的世界》则多了&ldquo;世界&rdquo;：作品以孙少安、孙少平兄弟的个人奋斗为线索，记录了中国西北部从&ldquo;文革&rdquo;后期至八十年代中期的变化，全景式地反映了农村改革不同环境和层面的社会问题。主要包括&ldquo;自由市场&rdquo;的逐步开放、&ldquo;水利&rdquo;与&ldquo;农业学大寨&rdquo;的余波、&ldquo;家庭联产承包责任制&rdquo;的多层脉动、农村劳动力的转移等。从&ldquo;人生&rdquo;到&ldquo;世界&rdquo;，路遥由对个人命运书写转向了表现时代历史的宏大叙事。</span></p>\r\n\r\n<p style=\"text-align: center;\"><span style=\"font-family: 微软雅黑,Microsoft YaHei; font-size: 18px;\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_18/a16e49e1fcd0f220.png\" target=\"_blank\"><img alt=\"2466E73BF08785685571576BE98_43E61D7D_7B608.png\" class=\"img_vsb_content\" orisrc=\"/__local/7/60/12/2466E73BF08785685571576BE98_43E61D7D_7B608.png\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_18/a16e49e1fcd0f220.png\" style=\"border-width: 0px; border-style: solid; margin: 0px; width: 800px; height: 617px; text-align: center; white-space: normal;\" title=\"微信图片_20191118084958.png\" vheight=\" 617px\" vsbhref=\"vurl\" vurl=\"/_vsl/760122466E73BF08785685571576BE98/43E61D7D/7B608?e=.png\" vwidth=\" 800px\" /></a></span></p>\r\n\r\n<p><span style=\"font-family: 微软雅黑,Microsoft YaHei; font-size: 18px;\"><span style=\"font-family: 宋体, SimSun; font-size: 18px; font-weight: 700;\">　　</span>讲座第四部分主要介绍了路遥&ldquo;早晨从中午开始&rdquo;的独特创作状态，指出路遥是一位非常强调写作&ldquo;仪式感&rdquo;的作家，他每次写作都需要抽烟、喝&ldquo;雀巢咖啡&rdquo;，陈思老师风趣地将路遥与海明威、席勒等拥有怪癖创作方式的作家进行了比较分析。路遥小说多是对自己人生经验的&ldquo;记录&rdquo;，陈老师特别提醒同学们注意小说创作与作家实际生活之间的联系与差异，尤其是在文学研究过程中不能完全&ldquo;盲从&rdquo;作者自己的&ldquo;叙述&rdquo;，而应该将作者的各种回忆录也作为研究的&ldquo;文本&rdquo;，展开多层面的分析。</span></p>\r\n\r\n<p><span style=\"font-family: 微软雅黑,Microsoft YaHei; font-size: 18px;\">　　讲座第五部分陈思老师向师生解读了路遥为什么那么重要和如何读懂路遥的问题。路遥通过文学反映了复杂的人性，展现了宏阔的农村改革历史全景与问题。而复杂的&ldquo;路遥现象&rdquo;&mdash;&mdash;则进一步促使我们反思当代文学史叙述与基本的文学观念。通过路遥，我们能够更深入地了解中国社会，更深刻理解当代文学的价值和意义。而只有将文学与社会史、文学与作家传记、文学与文学史结合起来阅读和分析，我们才能真正读懂路遥，也才能真正读懂文学经典。</span></p>\r\n\r\n<p><span style=\"font-family: 微软雅黑,Microsoft YaHei; font-size: 18px;\">　　毕海在简要总结讲座基础上，对陈思受邀来中央民族大学文学院做讲座表示由衷感谢，指出陈思对路遥及文学经典阅读的解读和分析让在座师生深受启迪，为今后的学习、教学和研究提供了非常好的借鉴。路杨老师与多位同学结合近几年兴起的&ldquo;路遥热&rdquo;与陈思副研究员进行了学术互动,一致认为&ldquo;路遥作品尤其是《平凡的世界》中，主人公身上所带有的不惧挫折、追逐理想的精神鼓舞着现代人尤其是年轻一代，其思想已经超越了那个时代。&rdquo;</span></p>\r\n</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('553','1343','1','','','提升舆论引导水平，是做好新闻舆论工作的重大课题。当前，全媒体不断发展，出现了全程媒体、全息媒体、全员媒体、全效媒体，舆论生态、媒体格局、传播方式发生深刻变化，新闻舆论工作面临新的挑战，提升舆论引导水平显得尤为重要。党的十九届四中全会《决定》提出&amp;amp;ldquo','36.157.141.61','36.157.141.61','1582711790','<div class=\"article\">\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\"><span style=\"text-indent: 2em;\">提升舆论引导水平，是做好新闻舆论工作的重大课题。当前，全媒体不断发展，出现了全程媒体、全息媒体、全员媒体、全效媒体，舆论生态、媒体格局、传播方式发生深刻变化，新闻舆论工作面临新的挑战，提升舆论引导水平显得尤为重要。党的十九届四中全会《决定》提出&ldquo;完善坚持正确导向的舆论引导工作机制&rdquo;，并作出一系列重要部署。贯彻落实这些重要部署，有效提升舆论引导水平，需要把握好以下几个方面。</span></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">把握舆论生态变化。随着信息技术快速发展，新兴媒体方兴未艾，互联网成为舆论工作主阵地、舆论交锋最前沿。在网络空间，我们既能看到人民群众对实现民族复兴的坚定自信，看到人民群众身上迸发出来的丰沛的爱国热情，看到满满的正能量；也能看到一些亟待解决的事关人民群众切身利益的民生问题；还会看到一些消极负面言论。提升舆论引导水平，必须准确把握舆论生态变化，高度重视网上舆论引导工作，让宣传思想战线主力军加速进入互联网主战场，构建网上网下一体的主流舆论格局。要善于通过网络体民情、察民意、知民心，同时加强网络媒体管控，推动落实主体责任、主管责任、监管责任。只有这样，才能增进共识、凝聚力量、成风化人，不断提升舆论引导水平。同时要看到，随着我国日益走近世界舞台中央，我国与世界的联系日益紧密。当今世界正处于大发展大变革大调整时期，世界面临的不稳定性不确定性突出。这就要求我们在舆论引导中统筹好内宣与外宣，打造内宣外宣联动的主流舆论格局，注重用中国故事传播中国价值、中国精神。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">建立全媒体传播体系。党的十九届四中全会《决定》提出，&ldquo;建立以内容建设为根本、先进技术为支撑、创新管理为保障的全媒体传播体系。&rdquo;这是提升舆论引导水平的重要举措。建立全媒体传播体系，要有大局观念，树立系统思维。这是因为，体系建设是一项系统工程，其中任何一个环节出现问题，都可能影响全局的推进。在全媒体传播体系中，应以优质内容增强吸引力和竞争力，特别是适应内容消费的新变化，不断用优质内容及时回应网民关切、满足网民需求；以先进技术支撑内容呈现，加强5G、人工智能、区块链等新技术应用，让人们对优质内容读得进、听得清、看得畅，不断提升传播效果；以优化的管理手段提高效率、降低成本，建立有效的管理制度，以确保系统高效运转。只有把内容、技术、管理有机结合起来，才能建好全媒体传播体系，有效提升舆论引导水平。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">强化制度意识。提升舆论引导水平，需要强化制度意识，建立健全相关制度。党的十九届四中全会《决定》提出&ldquo;完善坚持正确导向的舆论引导工作机制&rdquo;，正是从制度层面着力提升舆论引导水平。比如，《决定》提出的&ldquo;完善舆论监督制度&rdquo;与&ldquo;健全重大舆情和突发事件舆论引导机制&rdquo;，对于提升舆论引导水平具有重要意义。完善舆论监督制度，就要依据法律法规和相关政策，制定一套规范舆论监督的制度，明确如何支持新闻媒体正确开展舆论监督，如何强化新闻媒体在舆论监督中的社会责任等。健全重大舆情和突发事件舆论引导机制的重心在&ldquo;机制&rdquo;。机制是实施综合治理的关键，能够使各部门协调运作进而充分发挥作用。重大舆情和突发事件舆论引导机制应是一个包括预判、引导、处置在内的完备机制，要明确&ldquo;谁来管、怎么管&rdquo;：舆情还没有出现时，要积极分析和研判，结合互联网的特点做好数据处理，对日常社会热点问题进行分析，加强预判；一旦舆情出现，就要精准施策，拿出高效有力的协调联动处置手段。只有依靠制度，才能不断提升舆论引导水平，营造风清气正的网络空间。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">原文链接：<a href=\"http://theory.people.com.cn/n1/2020/0217/c40531-31589573.html?from=singlemessage\" target=\"_self\">有效提升舆论引导水平</a>&nbsp;<span style=\"color: rgb(51, 51, 51); font-family: arial; font-size: 16px; text-align: justify; text-indent: 32px; background-color: rgb(255, 255, 255);\">(</span><span style=\"color: rgb(51, 51, 51); font-family: arial; font-size: 16px; text-align: justify; background-color: rgb(255, 255, 255);\">《 人民日报 》 2020年02月17日 09 版)</span></p>\r\n</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('554','1344','1','','<!--#p8_attach#-->/cms/item/2020_02/26_18/251e9f8b65877349.jpg','','36.157.141.61','36.157.141.61','1582712129','<p style=\"text-align: center;\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_18/591d233d9dcfd23d.jpg\" target=\"_blank\"><img alt=\"351bc6fcdaa64aaa8614cfdfbdd7c97e.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_18/591d233d9dcfd23d.jpg\" style=\"width: 400px; height: 283px;\" /></a></p>\r\n\r\n<div class=\"article\">\r\n<p><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_18/251e9f8b65877349.jpg\" target=\"_blank\"><img alt=\"0ae789a9cf5f4fc2b28b4790ea95c8db.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_18/251e9f8b65877349.jpg\" style=\"border-width: 0px; border-style: solid; margin: 0px auto; width: 500px; height: 354px; text-align: center; text-indent: 0px; display: block;\" title=\"\" /></a></p>\r\n\r\n<p><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_18/178756f7b2e034d3.jpg\" target=\"_blank\"><img alt=\"dbc922c5ba09497fa4c78bb783835964.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_18/178756f7b2e034d3.jpg\" style=\"border-width: 0px; border-style: solid; margin: 0px auto; width: 500px; height: 544px; text-align: center; text-indent: 0px; display: block;\" title=\"\" /></a></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px; text-align: center;\"><span style=\"font-size: 15px;\">图片自上而下为电影《特警队》《被光抓走的人》《宠爱》剧照。（<span style=\"text-indent: 2em;\">制图：蔡华伟）</span></span></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\"><strong><span style=\"font-family: 楷体, 楷体_GB2312, SimKai;\">核心阅读</span></strong></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\"><span style=\"font-family: 楷体, 楷体_GB2312, SimKai;\">中国电影拥有丰厚的资源，讲好中国故事，需要把不可替代的文化资源、美学资源转化为新型的、具有世界意义的文化影响力、工业生产力和市场竞争力。</span></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">当前，&ldquo;互联网+&rdquo;正深度融合电影产业，网络影评、评分网站使&ldquo;口碑&rdquo;日益重要，创意、内容、质量成为一部电影真正的制胜之道。中国电影步入高质量发展的新常态，电影美学成为电影人新的探索课题。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\"><strong>现实题材创作持续拓展</strong></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">现实主义创作风格是近两年最为重要的电影文化和美学景观之一。继《我不是药神》《找到你》等现实题材佳作之后，中国电影在现实题材及现实主义创作方面持续拓展和掘进。这方面，以去年国庆档三部献礼片《我和我的祖国》《中国机长》《攀登者》、聚焦校园欺凌题材的电影《少年的你》、展现当代社会变革中普通人伦理道德力量的《地久天长》等为代表。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">献礼片《我和我的祖国》点燃全民记忆，把作为个体的&ldquo;我&rdquo;与新中国荣辱与共的关系，通过普通人的故事具象化、生活化。《中国机长》取材于真实事件，借鉴但超越了国外灾难片的类型模式，在相对&ldquo;封闭&rdquo;的时空展开线性情节。《少年的你》将校园霸凌与青春成长、家庭教育、社会阶层等社会话题融为一体。片中男女主人公表演出色，特写镜头细腻写实，故事叙述老到沉稳，相比青春片常有的&ldquo;低龄化&rdquo;&ldquo;轻浅化&rdquo;倾向，该片以直面现实的勇气、广阔的社会关联，呈现部分年轻人的真实生活状态，表现了他们的生活梦想和对纯真爱情的追求。《地久天长》通过两个普通家庭的悲欢离合，折射时代变迁的轨迹，没有夸张的情感宣泄，而是着意于人与人之间的善意，呈现道德的力量与克制、平和、冲淡的美学精神。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">电影创作聚焦现实题材是中国当下现实的需求。电影人讲述基于当下的&ldquo;中国故事&rdquo;，表现出来的关注民生、直面现实的勇气和力量，源自文化自信和使命意识。当然，现实主义创作的道路是宽广的，现实主义电影美学理应呈现丰富多元的样态。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\"><strong>想象力消费时代到来</strong></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">近年来，中国电影在科幻、幻想类型上突破显著，在想象力消费等维度创造了新空间与新经验。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">《流浪地球》打破中国电影缺少科幻大片的窘境，视野开阔，想象力丰富，视听效果震撼。影片在时间上延伸到未来世界，空间上扩展到外星宇宙，既有冰天雪地、沦陷崩塌的地表灾难，也有宏阔浩渺的太空场景等科幻大片、灾难片的典型性景观，并对此实施具有中国特色的超越。《疯狂的外星人》跳脱科幻片惯用的剧情模式和宏大场面，是科幻电影与黑色幽默喜剧电影的杂糅和类型拼贴。同属&ldquo;幻想类&rdquo;动画电影的《哪吒之魔童降世》也出手不凡，高居中国电影票房第二名。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">值得注意的是，这些电影充分展现了想象力崛起的一面，能够满足青少年观众群体的想象力消费需求，同时也都是接地气的，讲述的都是中国故事，表现的都是中国经验。《疯狂的外星人》具有鲜明的中国当下性和宁浩导演的个人风格，影片主人公以四两拨千斤的中国智慧化解地球人与外星人的冲突，包裹了中国哲学特有的世俗化特性、经验论思维。《哪吒之魔童降世》在创造性改写中国古代神话传说之余，表达了&ldquo;英雄成长&rdquo;式主题。《流浪地球》把地球推离太阳系，带着地球流浪，以及具有文化原型意义的&ldquo;夸父逐日&rdquo;、愚公移山精神等，都非常具有想象力，也契合了全球化时代和谐共处、互惠互利的&ldquo;人类命运共同体&rdquo;思想。这种想象力、价值观的表达和受到的热烈欢迎，预示了一个属于青少年受众的&ldquo;想象力消费&rdquo;时代的到来。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">科幻、幻想类型电影的勃兴，对中国电影的发展意义重大。一定程度上，这类电影是衡量想象力、创造力的一种尺度，它的完成度也依赖电影产业的工业化水准。这类电影不仅因其故事的假定性和虚构性，充分契合当下年轻观众对虚拟影像的期待，也在探索中实现对中国优秀传统文化的现代转化。《流浪地球》以其中国特色的想象、全人类情怀和大宇宙格局成就其美学品格。当然，从《流浪地球》式的现象级到常态化是中国电影需要突破的难点。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\"><strong>建构中国电影工业体系</strong></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">近年来，随着《战狼Ⅱ》《红海行动》《流浪地球》等主流大片或重工业电影的崛起，&ldquo;工业品质&rdquo;&ldquo;重工业电影&rdquo;&ldquo;电影工业美学&rdquo;等成为业界学界的焦点话题。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">一个成熟的电影工业体系，不仅指巨额的资金投入、高新的工业技术，更指电影生产过程中高度的标准化、流程化、规范化。一部电影需要经由无数工序共同来完成最终的制作，真正的电影工业须是分工精细、协同良好的。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">《中国机长》完整、协调、系统、统一的工业化制造流程，彰显了中国的工匠精神；影片崇高美学的平民化呈现，也于&ldquo;伟大出自平凡&rdquo;&ldquo;人人为我，我为人人&rdquo;的共同价值中得以表达。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">从工业角度看，硬科幻电影因其想象力大胆、场面宏大壮阔、工业化程度高等，成为衡量一个国家电影工业水平、科技水平的标准。现实题材电影，因为&ldquo;接地气&rdquo;的本土性，加之体量适中、投资风险系数相对较小，在未来有着开阔的前景。这在今年的贺岁档有所体现。《叶问4》以不错的口碑为叶问系列画上圆满句号。叶问电影稳扎稳打的系列化运作，为电影IP化生产提供了鲜活个案。爱情片《只有芸知道》、软科幻片《被光抓走的人》、开心麻花品牌的《半个喜剧》等中小成本电影的多元化拓展，展示了电影创作多样化、工业分层化等可能性。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">国产电影有不可替代的文化资源、历史资源、现实资源，讲好中国故事，需要把这些资源转化为新型的、具有世界性意义的文化影响力、工业生产力和市场竞争力。<span style=\"text-indent: 2em;\">（作者陈旭光为北京大学教授）</span></p>\r\n</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('555','1345','1','','','随着互联网普及程度的提高及其对社会生活的深度浸透，圈层文化现象正逐渐进入大众视野，成为舆论关注的热点。无论是主动、被动参与或是无意识加入，从大面上说，作为一种新型的社会组织方式，绝大部分网民都可以被分入一定的文化圈层，二次元圈、电竞圈、书法圈&amp;amp;hellip;','36.157.141.61','36.157.141.61','1582712499','<div class=\"article\">\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\"><span style=\"text-indent: 2em;\">随着互联网普及程度的提高及其对社会生活的深度浸透，圈层文化现象正逐渐进入大众视野，成为舆论关注的热点。无论是主动、被动参与或是无意识加入，从大面上说，作为一种新型的社会组织方式，绝大部分网民都可以被分入一定的文化圈层，二次元圈、电竞圈、书法圈&hellip;&hellip;每个人因为自己的爱好、职业、性格、特长等被划归为不同圈层，只是有人积极融入，寻求同好，组成圈层，甚至形成&ldquo;茧房&rdquo;；有人独自陶醉，选择不主动参与。但不可否认的是，圈层文化已然成为一种不可忽视的社会现象和文化形态，涵盖着众多的社会群体，成为当前社会管理、尤其是高校育人工作必须考量的重要因素。</span></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">而回溯中外历史可以发现，圈层现象古已有之，无论是竹林七贤以歌酒会友，还是东林党志于振兴朝政，抑或是阿卡德米自由多元的学术探讨，圈层现象存在于历史的各个阶段、社会的各个领域，只是组成方式、覆盖范围、影响力度不尽相同而已。当前，圈层文化受到广泛关注，成为大众文化现象，则正是因为互联网的快速发展，为多种多样的亚文化现象提供了传播便利，从而实现了大规模的普及和扩张。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">那么着眼于这一基本背景，我们应当如何客观理性地看待圈层文化现象呢？</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">首先，所谓圈层是正常的人性需求。人作为社会性动物，除去自我成长，不可避免地要与社会发生联系，受到他人影响，社会交往也是最基本的人性需求。人们在进行社会交往的过程中，一方面深刻地受到地域、环境等客观因素的影响，产生相应的社会联系，如同学、同事等；另一方面，每个人都有自己的意趣与爱好，人们在社会交往中往往会突破地域和环境的限制，与有共同话语的个体和群体进行交往，这种交流更加深入，也更顺应人们进行人际交往的社会心理，更加贴合人性需求。因此，圈层文化现象是正常人际交往的形式之一，要从社会交往与文化交流的角度去理解和看待。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">其次，圈层文化现象的繁荣是互联网技术支持的结果。圈层文化现象是正常的历史文化现象和变迁变革表现，长期存在于人类历史的发展过程中，但由于技术落后和交往成本过高，文化圈层往往受到较多的时空限制。而正是信息革命中互联网技术的发展，为人们跨越地域和环境限制提供了极大便利，推动了圈层文化现象的繁荣。圈层文化现象的繁荣是互联网技术发展的重要成果，同时也是信息社会发展的必然结果，信息社会中海量信息的涌入，使得每个人能够接触到的信息呈几何倍数增长，而人的注意力资源是有限的，攫取其中符合自我需求的信息成为必然选择，长此以往，人们往往会深度卷入固有的信息圈层。因此，认识圈层文化现象，要将其置于信息革命的大环境中，要辩证地看待信息技术给圈层文化现象带来的发展与挑战。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">此外，当前圈层文化现象有其历史必然性，但也与此前的圈层现象有着本质性的不同。认识圈层文化现象，既要看到其历史传承的一面，更要看到其中的本质性区别。与历史上的圈层相比，信息时代的圈层文化时效性更强，流行文化通过互联网得以快速传播，人们能够通过互联网接收和传播实时信息，甚至迅速创造全新的亚文化现象；广泛度更大，互联网连接了世界的各个角落，文化圈层得以大大突破地域限制，分散的区域性圈层得以整合，成为全国性乃至全球性圈层，追星族的&ldquo;全球粉丝会&rdquo;就是其中的典型现象；多元性更强，在信息时代，亚文化无处不在，凡事皆可被创造成为亚文化，且以往不被主流文化认可的亚文化也能够被社会包容，圈层文化的内容更丰富、更多元。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">而在信息社会中，人们除了主动获取信息，也在被动地接触大量信息，这些信息夹杂着不同的情感倾向与价值观念，裹挟着消费主义的内核，塑造着人们的思想观念和行为模式，也塑造着人们对后续信息的接受，从而导致了&ldquo;信息圈养&rdquo;现象，这是对当代青年主体性的极大伤害。客观认识圈层文化现象，也需要理性辨析，区分清楚良性的圈层文化与被动的信息圈养之间的区别，破除信息圈养的弊端。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">对于正常的圈层文化，要秉持辩证态度，鼓励理性发展。具体而言，要加强制度建构，信息时代的文化圈层是自然形成的网络社群，与现实生活中的团体一样需要加强管理，因此要加强网络空间制度法规的建设，完善网络群体管理；要加强文化引导，当前还有很多流行性、浅层性的文化圈层，要推动圈层文化现象的高质量发展，就要引导注意力资源由碎片化信息转向体系化文化，建构文化价值共同体；要构建张力结构，圈层文化现象的勃兴在一定程度上是对现实压力转移和逃避的结果，因此推动圈层文化的良性发展，也要增强线上、线下生活的弹性，避免虚拟与现实的紧张对立。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">而对于信息圈养形成的伪圈层，则要通过教育引导加以尽量避免。对于高校育人工作者而言，要加强网络素养教育，信息圈养体现的是网络信息素养的缺失，因此首先增强青年对网络信息的甄别能力，培养青年对于信息选择多少、辨别真伪、明晰是非、界定善恶的能力，帮助青年摆脱信息茧房；要加强集体主义教育和关怀，帮助青年正确认识集体与个体的辩证关系，使得假独立、伪自我转变成为真自主；同时要锻造青年主体性，培养青年的认识辨析能力、现实转化能力、主体建构能力和价值塑造能力，以培育网络新青年作为高校育人工作的成才导向。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">（作者系北京大学网信办主任、青年研究中心原<span style=\"text-indent: 2em;\">主任 蒋广学</span><span style=\"text-indent: 2em;\">）</span></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\"><span style=\"text-indent: 2em;\">原文链接：<a href=\"http://www.shekebao.com.cn/shekebao/n440/n441/u1ai15155.html\" target=\"_self\">客观理性地看待圈层文化 </a>（《</span>社会科学报<span style=\"text-indent: 2em;\">》第1665期第4版</span>）</p>\r\n</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('556','1346','1','','','为了落实《国务院办公厅关于促进&amp;amp;ldquo;互联网+医疗健康&amp;amp;rdquo;发展的意见》，规范现有和未来的互联网诊疗活动，推动互联网医疗服务健康快速发展，达到保障医疗质量和医疗安全的目的，国家卫生健康委员会和国家中医药管理局在广泛征求社会各界的意见和建议，根据《执业','36.157.141.61','36.157.141.61','1582712733','<div class=\"article\">\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\"><span style=\"text-indent: 2em;\">为了落实《国务院办公厅关于促进&ldquo;互联网+医疗健康&rdquo;发展的意见》，规范现有和未来的互联网诊疗活动，推动互联网医疗服务健康快速发展，达到保障医疗质量和医疗安全的目的，国家卫生健康委员会和国家中医药管理局在广泛征求社会各界的意见和建议，根据《执业医师法》《医疗机构管理条例》等法律法规，制定并于2018年7月17日发布了《互联网诊疗管理办法（试行）》《互联网医院管理办法（试行）》《远程医疗服务管理规范（试行）》等3份互联网医疗领域重磅文件，要求各省、自治区、直辖市及新疆生产建设兵团卫健委、中医药管理局遵照执行。&ldquo;互联网+医疗&rdquo;的推进与实现，让城市的优质医生在线上与基层群众对接，从而在硬件条件改善的基础上实现软件资源的更新，在医疗设备和医疗服务两个层面优化现有配置，促进社会公平。</span></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">如今，全国所有的三级甲等医院都开展了远程医疗服务，而且覆盖了全国所有的贫困县县医院，正在向乡和村一级延伸。从长远、深层看，远程医疗应是一个多方共赢的方案。&ldquo;互联网+医疗&rdquo;是新业态，既要加大油门往前走，还要拧紧质量&ldquo;安全阀&rdquo;，让云端医疗接地气，满足个性化医疗需求，使优质的医疗资源遍布每个角落。发展&ldquo;远程医疗&rdquo;的必要性有哪些？如何看待&ldquo;互联网+医疗&rdquo;这种新型诊疗方式？&ldquo;远程医疗&rdquo;尚存哪些难点亟待破解？</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\"><strong>发展&ldquo;远程医疗&rdquo;的必要性</strong></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">远程医疗（Telemedicine）是指通过计算机技术、遥感、遥测、遥控技术为依托，充分发挥大医院或专科医疗中心的医疗技术和医疗设备优势，对医疗条件较差的边远地区、海岛或舰船上的伤病员进行远距离诊断、治疗和咨询。远程医疗旨在提高诊断与医疗水平、降低医疗开支、满足广大人民群众保健需求的一项全新的医疗服务。目前，远程医疗技术已经从最初的电视监护、电话远程诊断发展到利用高速网络进行数字、图像、语音的综合传输，并且实现了实时的语音和高清晰图像的交流，为现代医学的应用提供了更广阔的发展空间。国外在这一领域的发展已有40多年的历史，而我国只在最近几年才得到重视和发展。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">上世纪50年代末，美国学者Wittson首先将双向电视系统用于医疗;同年，Jutra等人创立了远程放射医学。此后，美国相继不断有人利用通讯和电子技术进行医学活动，并出现了&ldquo;Telemedicine&rdquo;这一词汇，现在国内专家统一将其译为&ldquo;远程医疗&rdquo;。欧美各国近半个世纪在远程医疗领域取得了很大进展，例如：佐治亚医学院的儿科远程医疗；比萨大学放射学系病人图像和数据通讯系统；EWISH免疫学和呼吸医疗中心与ALAMOS国家实验室联合远程医疗项目以及UWGSP9远程医疗项目等。国内远程医疗起步较晚，其医疗活动内容包括以下几种形式：远程医疗会诊，远程医疗教育，学术会议转播，手术示教等，近10年来，我国远程医疗进入实际应用阶段，上海交大已开发完成全国首个无线远程心电监控技术服务平台，该系统可以实时将人体生理信号转换为数字信号，通过移动网络使医学专家能在第一时间获得心血管疾病的诊断和预警。2011年，我国首家急诊远程监护室在武警总医院急救监护中心启用，通过GPRS技术实时远程心电监测。呼救者可以通过&ldquo;护心宝 &rdquo;监测器与医生进行交流。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">近5年来，在政府的大力支持下，远程医疗在我国一线城市以及相对发达的城市地区都已经开花结果，在科技助力下，进一步的实现经济和医疗价值。根据我国国情需要，远程医疗的推广及时使用的最重要的地区是偏远山区，是广大的农民群体。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">根据2015&mdash;2018年《我国卫生健康事业发展统计公报》《中国统计年鉴》等统计数据分析，从卫生总费用来看（卫生总费用主要反映的是一段时间内全国范围内投入医疗卫生领域资金的总和，包含了用于医护人员、医疗设备及其他方面的所有卫生支出，是衡量卫生总投入大小的指标）我国每年的卫生总费用占GDP的比重几乎都维持在6%～6.4%之间，在满足城乡居民对医疗卫生服务的需求上尚有差距；此外，卫生总费用在城乡间的分布也不均衡，城市所获得的卫生资源高于农村。我国人口众多，地域辽阔，医疗水平发展不平衡，以近六年数据为例，2012年城市每千人口所享有卫生技术人数为8.54人，农村为3.41人，城市比农村大近2.5倍；城市医疗机构每千人口执业医生人数为3.65人，农村为1.09人，城市同样比农村大近3.35倍。2017年，城乡每千人口享有卫生技术人数均有所增加，城市为10.87人，农村为4.28人，但城乡比也在增加，城市比农村高2.54倍；城市医疗机构每千人口执业医生人数为3.97人，农村为1.68人，城市比农村高2.36倍，差距有所缓解。以上数据表明，城乡医疗卫生人力资源在数量上存在差异，投向农村地区的医疗卫生人力资源明显不足；此外，从人力资源配置质量来看，据2013年《中国卫生和计划生育年鉴》数据显示：2012年城市医疗机构医护人员大学本科以上学历人员达到了31.8%，同期乡镇卫生院医护人员大学本科以上学历人员仅为5.3%，我国城乡医疗卫生人力资源分布不合理，城乡医疗卫生人力资源无论是在数量上还是在质量上都存在着巨大的差距，城市居民拥有更优质的医疗卫生人力资源，而农村医护人员数量较少且素质有待提高，无法满足农民对高质量的基本医疗卫生服务日益增长的需求。笔者亲历亲为的北京大学承担的国家级医保政策研究项目调查数据显示：绝大多数（85%）农民觉得看病不难，但是九成（90%）农民觉得看病贵。各种看病贵的因素中，检查费、药费居首位，占到80%以上。基层医疗机构技术配置存在问题造成农民检查费用高，且在不同医院重复检查过多，进一步加重了医疗费用过高。从2009年起，我国实施新医改，扩大了医疗的覆盖面，海量资金投入以改变基层落后面貌，医疗设备升级换代。但医疗设备大量闲置派不上用场，目前基层医院医疗设备使用率不足四成。而医疗设备和专家资源分布不均，危重、疑难病人需要到上级医院进行会诊时产生的交通费、陪护费和住院医疗费等进一步增加了病人的经济负担，长途旅途劳累和颠簸也会造成病人的病情加重，在很大程度上也造成了城市大医院的病源拥堵和不堪重负，而乡镇卫生院的资源却没有得到充分的利用，打破传统医疗模式经济、地域的限制，解决医疗资源分布不均衡的问题，远程医疗的推广势在必行，这是关乎民生关乎国家发展的大问题。好似一棵大树，根系要扎得稳扎得牢，才会有枝繁叶茂的未来，只有发展好基层医疗，解决基层群众的实际问题，才能实现真正的全民小康。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">科技改变生活，医疗健康是关系民生的重要部分，在&ldquo;健康中国2030&rdquo;战略部署下，提升医疗卫生现代化水平，优化现有资源配置，开创新型的医疗服务模式，提高我国医疗水平备受瞩目，借助我国网络通讯发展的优势，&ldquo;互联网+医疗&rdquo;模式，也得到了相当的重视。《全国医疗卫生服务体系规划纲要（2015&mdash;2020 年）》中，明确地提出了医疗服务工作应该积极地与多媒体、计算机、互联网、大数据、云计算、物联网等内容进行紧密的联系，也体现出了&ldquo;互联网+医疗&rdquo;发展对医疗行业的重要性。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">在今年4月，国家卫生健康委员会规划发展与信息化司司长表示，医疗健康信息化建设要从&ldquo;通信息&rdquo;转向&ldquo;通健康&rdquo;，他介绍，目前全国有 6376 家二级以上公立医院接入区域全民健康信息平台，1273 家三级医院初步实现院内医疗服务信息互通共享，3300 多家公立医院出台了信息化便民惠民服务措施。 一台电脑、一个摄像头，即便是身在农村、地处偏远，患者也可以向专家实时在线问诊，互联网让偏远地区医疗实现&ldquo;触屏可及&rdquo;。&ldquo;互联网+医疗&rdquo;已经成为我国医疗行业的重要的发展方向。在资源配置不平衡的情况下，通过互联网的优势，可使得农村地区、医疗相对落后地区也能享受到先进的医疗服务，实现城乡医疗卫生统筹。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\"><strong>&ldquo;互联网+医疗&rdquo;这种新型诊疗方式的亮点</strong></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">这一举措，将优质医疗资源公开透明化，尤其是挂号实名制，有利于杜绝熟人加塞、<span style=\"text-indent: 2em;\">黄牛号等现象，有利于公平。与此同时，民众通过互联网进行预约，减少了在医院大厅排长队挂号的时间成本，按照预约的时间前来就诊，避免了患者的长久等待，给患者带来了很大的便利，同时，有利于医院的号源管理，极大程度优化了医院的空间资源。</span></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">患者可以足不出户，通过手机等各类客户端，达到看病的目的，有效避免了患者到实体医院诊疗时的相关医疗流程所带来的不便，尤其适用于慢性病患者复诊及一些轻微疾病、医疗保健等医疗健康服务提供。大大减少了医疗的直接成本与间接成本。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">医生在电脑上能直接看到患者在其他医院的检查报告，甚至在未接触到病人前就能有<span style=\"text-indent: 2em;\">一个初步印象，这大大节省了就诊的时间，提高了工作的效率。也避免了因为&ldquo;资料遗失&rdquo;而回初诊医院找回的麻烦。与此同时，患者所有既往的就诊资料，可以通过互联网一目了然。有效避免了因为某些患者刻意隐瞒病史而造成的不良医疗后果。再者，由于采购新设备时，成本效益分析工作不够科学，一些医疗单位存在新购置设备空置的现象，造成了极大的资源浪费，通过互联网的共享，可以实现基层医院检查，上级医院就诊的模式，有利于设备资源的整合。大大减少了患者&ldquo;重复检查&rdquo;的概率，有利于缓和医患关系紧张的局面。</span></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">医疗档案在医院工作中举足轻重，传统医疗档案的载体是纸质化的，不仅占用了医院<span style=\"text-indent: 2em;\">的空间资源，并且在查找患者病历档案的过程中也相对较为困难，耗费了大量的时间和空间。无纸化的工作可以大大减少医疗工作者耗费在病历书写的时间，将更多的时间用于患者的人文关怀、诊疗工作上。信息化的病历系统，有助于病历规范化，通过数据传输方式保存，避免资料遗失。通过数据内存的形式，能够有效节省医院的空间资源，还能实现节能环保；而且通过无纸化信息化的处理，对于医院的数据分析、科研教学工作的开展大有裨益。</span></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\"><strong>&ldquo;互联网+&rdquo;远程医疗尚存亟待破解的难点</strong></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">现阶段远程医疗发展上存在的问题和运行效率不高可主要归结为以下几个方面原因：</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">1.<span style=\"text-indent: 2em;\">将号源放在公共平台，让民众网上挂号、接受群众监督的做法，做到了公平，但也存在着&ldquo;失公&rdquo;的因素。对于广大的老年群体，因为对互联网接受程度较差，主要还是通过现场排队的方式进行就诊。这正如出租车行业，如果完全都采用智能设备预约的方式，不会使用智能手机和电脑的老年人将无法乘坐出租车。同理，如果将号源完全放到网上，对这个群体，是有失公平的。第二，从北京市哲学社会科学基金重大项目（17ZDA16））课题组对一线医务人员的访谈了解到，网上预约后，不少患者因为各种原因&ldquo;爽约&rdquo;，也不退号。而对于这类&ldquo;爽约&rdquo;的患者，缺乏相应的惩罚制度。一边是占了资源不来看病，另一边着急看病却挂不上号，造成了严重的资源浪费。这也体现了这种模式的现阶段缺陷所在。</span></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">2.患者可以通过互联网，通过医生个人公众号、网上医院、APP软件等向医生进行诊疗的咨询，构建了一种新的医疗服务模式，这一新生产物同样存在缺点， 第一，线上诊疗服务由于受到移动设备和患者主述等多种因素的影响，只能通过对患者简单的了解和询问来初步判断患者的身体状况，容易造成误诊及导致诊疗不及时。第二，医疗服务连续性不佳：医生明确诊断后，只能给出相应的建议，无法形成病历及处方，尤其是一些处方药，患者依然需要到医院正规就诊，然后以处方来购买药物，未能达到便利的目的。同时，线上进行医疗服务，是否属于&ldquo;在非执业地点行医&rdquo;，未有明确的法律界定，一旦出现医疗纠纷，无论是患方还是医方，都存在取证以及适用法律条款问题。因而，双方的权益无法得到充分保障。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">3.电子化病历带来方便的同时，也带来了一些问题。课题组调研发现，病案内容复制粘贴现象严重，发生张冠李戴的情况。格式化病历，对医学生的培养也造成了不利的影响，一些临床带教老师反馈，在教学过程中发现，一旦撤离开电脑，一些学生甚至不知道该如何书写病历。另外，对于网络过度依赖，一旦出现网络系统故障或者大面积停电等突发紧急情况，后续保障与应急措施是否能足以应对日常医疗工作。这里，存在着一定的安全隐患，课题组调研时，恰逢某三甲医院发生了停电现象的尴尬。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">4.&ldquo;明明才做过的检查，换了一家医院又要求重做&rdquo;这是很多患者的痛点，同时也是医疗工作者的难处。笔者在亲历亲为的国家医保政策研究项目调查中发现：基层医疗机构技术配置存在问题，造成农民检查费用高，且在不同医院重复检查过多，进一步加重了医疗费用。建议以国产化、经济型的高科技集成化的检验设备降低直接成本，标准化、网格化的电子诊断结果和病历可在不同医院使用，达到减少重复检查，资源共享，并使远程诊断成为可能。 通过互联网的中介，可以做到各医院间结果的共享，有效解决这一症结。但是，同样存在优缺点：各个医院在诊断及治疗水平上&ldquo;同质化差异&rdquo;依然存在，所以往往存在上级医院不承认下级医院的检查报告。其实这个问题解决不难，因为不承认下级医院的主观报告可以理解，但对于一些客观的资料，上级医院可以根据自己的诊断经验及水平做出判断。但是，这里就牵涉到互联网医疗现阶段另一层面的困境：网络传输的速度、精确度、稳定性、安全性。课题组调研了解到，目前在临床工作中，有时候通过网络来阅读其他医院的资料时，发现通过互联网传输资料的过程中，存在资料不清晰、速度慢、缺项漏项等问题，无法做出精确的判断。此外，如果医生根据外院的主观性资料进行诊断，一旦发生误诊漏诊，责任该如何划分，也是亟待解决的问题。最后，信息时代下，远程医疗中关于患者个人病例、诊疗等隐私信息的安全性能否得到有效保障，也面临着重大的挑战。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\"><strong>&ldquo;互联网+医疗&rdquo;公平效率质量安全的着力点</strong></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">突飞猛进的网络技术使人们获取数据门槛降低，保密性、安全性也成为公众接受远程医疗的阻碍，国家卫生健康委员会、国家中医药管理局于2018年出台的《互联网诊疗管理办法（试行）》等3个文件，对规范国内远程医疗管理制度，发挥远程医疗服务积极作用，提高医疗效率，确保远程医疗安全性，起到了关键作用，但真正的在患者身上使用远程医疗技术，实现医疗资源的再次分配，提高偏远地区的医疗水平，提高患者的治愈率，需要建立规范持续的培训系统以及简化远程医疗系统操作难度，提升远程医疗的准确度，实现检查结果的资源共享，以便利医疗服务、惠及城乡居民、壮大健康产业为目标，以医疗服务信息标准化、检查检验结果全国互认为基础，推广远程医疗，建立和完善重大公共卫生、传染病等健康信息监测预警体系，促进优质资源共享和卫生服务普惠，建立完善电子病历、电子健康档案，逐步实现全国范围跨机构、跨区域、跨卫生业务的健康信息、就诊信息共享和一卡通用，积极推进应用具有集约型的能够集居民个人信息、健康与社会保障、金融 IC卡、市民服务等公共服务的应用集成的第二代电子身份证。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">&ldquo;互联网+&rdquo;远程医疗的实施不止于国内，也不只是科技服务医疗的问题，更是整个人类社会需要的进步，体现公平、效率、质量、安全的相关技术标准与体系、国际公法与私法制定具有国防性和外交性。中国正在更加深刻地走向世界、在全球各项事务中发挥越来越重要的大国作用的今天，更需要通过在核心技术、专利、平台、生态环境方面进行战略布局，掌握国际市场话语权，占领生态链高端市场，通过研发和收购并举，快速掌握核心技术，发布技术框架、平台，建设&ldquo;互联网+医疗&rdquo;生态系统，发挥我们负责任大国对全球卫生与健康在人类命运共同体中的重要领导作用，积极参与并引导国际标准和法律法规的制定，为人类健康与社会发展提供远程医疗一点通，e网打尽全世界的中国方案。</p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\"><span style=\"font-family: 楷体, 楷体_GB2312, SimKai;\">本文为北京市哲学社会科学基金重大项目（17ZDA16）阶段性成果，作者王红漫，北京大学博导，从事健康与社会发展理论与实证研究，17ZDA16项目负责人。</span></p>\r\n\r\n<p style=\"line-height: 200%; text-indent: 2em; font-size: 16px;\">原文链接：<a href=\"http://share.gmw.cn/life/2019-06/17/content_32926657.htm?from=&quot;singlemessage\" target=\"_self\">王红漫：远程医疗一点通 e网打尽全世界</a></p>\r\n</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('557','1347','1','','<!--#p8_attach#-->/cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','为“艾”发光 共建健康中国第32个世界艾滋病日到来之际，11月29日晚，学生举办为“艾”发光活动，用烛光点亮“NO AIDS”和红丝带的字样和图案，呼吁广大青年知艾防艾，共享健康。','113.247.22.80','113.247.22.80','1582726810','<p style=\";text-indent:32px;text-autospace:ideograph-numeric;text-align:center;line-height:33px\"><strong><span style=\"font-family: 微软雅黑;font-size: 16px\"><span style=\"font-family:微软雅黑\">为</span>&ldquo;艾&rdquo;发光 共建健康中国</span></strong></p>\r\n\r\n<p style=\"text-indent: 32px; line-height: 33px; text-align: center;\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_16/20371e3143d36278.jpg\" target=\"_blank\"><img alt=\"1575114315355.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_16/20371e3143d36278.jpg\" title=\"3.jpg\" /></a><span style=\"font-family: 微软雅黑;\">&nbsp;</span></p>\r\n\r\n<p style=\"text-indent: 32px; line-height: 33px; text-align: center;\">&nbsp;</p>\r\n\r\n<p style=\";text-indent: 28px;line-height: 33px\"><span style=\";font-family:微软雅黑;font-size:14px\"><span style=\"font-family:微软雅黑\">本网讯（通讯员刘攀</span> <span style=\"font-family:微软雅黑\">记者李建华）在第</span>32个世界艾滋病日到来之际，11月29日晚，学生举办为&ldquo;艾&rdquo;发光活动，用烛光点亮&ldquo;NO AIDS&rdquo;和红丝带的字样和图案，呼吁广大青年知艾防艾，共享健康。</span></p>\r\n\r\n<p style=\";text-indent: 28px;line-height: 33px\"><span style=\";font-family:微软雅黑;font-size:14px\"><span style=\"font-family:微软雅黑\">青年志愿者中心骨干大学生向在场的近</span>200名大学生讲解防艾知识，唤起防&ldquo;艾&rdquo;从自身做起的社会责任感，消除歧视和偏见，关心和帮助艾滋病患者，共担防艾责任，共享健康权益，共建健康中国。</span></p>\r\n\r\n<p style=\"text-indent: 28px; line-height: 33px; text-align: center;\"><span style=\";font-family:微软雅黑;font-size:14px\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_16/c2278f557cfe91d7.png\" target=\"_blank\"><img alt=\"1575114329416.png\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_16/c2278f557cfe91d7.png\" title=\"2.png\" /></a></span></p>\r\n\r\n<p style=\"text-indent: 43px\"><span style=\";font-family:宋体;font-size:21px\">&nbsp;</span></p>\r\n\r\n<p style=\"text-indent:43px;text-align:justify;text-justify:inter-ideograph\"><span style=\";font-family:Calibri;font-size:21px\">&nbsp;</span></p>\r\n\r\n<p>&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('558','1348','1','','<!--#p8_attach#-->/cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','2月24日，校党委中心组开展2020年第2次集中学习，深入学习习近平总书记系列重要讲话精神和教育部党组有关文件精神。校党委书记邓卫主持会议，校长段献忠、全体在校校领导、校党委常委参加学习。','113.247.22.80','113.247.22.80','1582726810','<p class=\"vsbcontent_start\">2月24日，校党委中心组开展2020年第2次集中学习，深入学习习近平总书记系列重要讲话精神和教育部党组有关文件精神。校党委书记邓卫主持会议，校长段献忠、全体在校校领导、校党委常委参加学习。</p>\r\n\r\n<p style=\"text-align: center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/b06c741ec00052e3.jpg\" target=\"_blank\"><img alt=\"E41D237AAA5E47E3895DF1738C0_CC78FCC9_18669.jpg\" class=\"img_vsb_content\" orisrc=\"/__local/9/C8/6B/270B3B1FF17FEC6C031C50B40A7_A0608562_1AD3D1.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/b06c741ec00052e3.jpg.cthumb.jpg\" style=\"width: 500px;\" vheight=\"\" vsbhref=\"vurl\" vurl=\"/_vsl/EBAD4E41D237AAA5E47E3895DF1738C0/CC78FCC9/18669\" vwidth=\"500\" /></a></p>\r\n\r\n<p style=\"text-align: center;\"><span style=\"font-family: 楷体, 楷体_GB2312, SimKai;\">会议现场。</span></p>\r\n\r\n<p>会上，邓卫传达领学了习近平总书记关于新冠肺炎疫情防控工作的最新重要讲话精神、习近平总书记在第十九届中央纪律检查委员会第四次全体会议上的重要讲话精神、教育部党组有关直属高校领导班子建设的文件精神。陈伟传达领学了习近平总书记在中央统战工作会议上的重要讲话精神。</p>\r\n\r\n<p>邓卫在主持学习时指出，习近平总书记关于新冠肺炎疫情防控工作的最新重要讲话，为决胜疫情防控人民战争、总体战、阻击战，指明了方向、明确了路径、划定了重点。习近平总书记在十九届中央纪委四次全会上的重要讲话，对以全面从严治党新成效推进国家治理体系和治理能力现代化作出了战略部署。习近平总书记在中央统战工作会议上的重要讲话，对于加强和改进统一战线工作、团结一切可以团结的力量具有重大指导意义。</p>\r\n\r\n<p>邓卫强调，要把思想和行动进一步统一到习近平总书记系列重要讲话精神上来，坚决打赢疫情防控阻击战，确保师生员工生命安全和身体健康，统筹做好各项工作，加快推进学校&ldquo;双一流&rdquo;建设发展。</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('559','1349','1','','<!--#p8_attach#-->/cms/item/2020_02/26_22/d57883c29273e0f4.jpg','我和我的祖国”全校师生大合唱比赛开我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛赛','113.247.22.80','113.247.22.80','1582726810','<div class=\"wp_articlecontent\">\r\n<p style=\"text-align:center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/72687b6eefb42a8f.jpg\" target=\"_blank\"><img alt=\"e0eba684-f555-496f-a89f-c4046821ea98.jpg\" data-layer=\"photo\" original-src=\"/_upload/article/images/de/78/2cff74594bf0a709690aa671d186/e0eba684-f555-496f-a89f-c4046821ea98_d.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/72687b6eefb42a8f.jpg.cthumb.jpg\" sudyfile-attr=\"{\'title\':\'3.jpg\'}\" /></a></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/2af08f5b0efe88c0.jpg\" target=\"_blank\"><img alt=\"0bf61230-381f-4562-92a4-5ecbeb75ce78.jpg\" data-layer=\"photo\" original-src=\"/_upload/article/images/de/78/2cff74594bf0a709690aa671d186/df4e4fcf-6364-44f2-8f67-490e2dee6d54_d.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/2af08f5b0efe88c0.jpg.cthumb.jpg\" sudyfile-attr=\"{\'title\':\'2.jpg\'}\" /></a></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-indent:2em;text-align:justify;line-height:2em;\"><span style=\"text-indent:32px;font-size:16px;font-family:宋体, simsun;line-height:2em;\">&ldquo;我和我的祖国，一刻也不能分割，无论我走到哪里，都流出一首赞歌&hellip;&hellip;&rdquo;6月11日晚，剧场回荡着《我和我的祖国》的响亮歌声，来自全校54个院级工会的4000余名师生，用歌声献礼中华人民共和国70华诞。&ldquo;我和我的祖国&rdquo;全校师生大合唱比赛现场，师生们通过歌声、朗诵、独唱、舞蹈等形式把自己对祖国的爱&ldquo;尽情诉说&rdquo;。</span></p>\r\n\r\n<p style=\"text-indent:2em;text-align:justify;font-size:16px;font-family:宋体, simsun;line-height:2em;\">70年风雨兼程，70年砥砺奋进，中华儿女勠力同心；70年春华秋实，70年薪火相传，铸就今日辉煌中国。师生们唱出中国梦，唱响爱国情，用歌声讲述国家富强、民族振兴、人民幸福的今日中国。唱响主旋律、讴歌新时代，师生们把对祖国的热爱融入到美妙的歌声中，为扎根中国大地加快推进&ldquo;双一流&rdquo;建设，迈向世界一流大学前列汇聚磅礴力量。</p>\r\n\r\n<p style=\"text-indent:2em;text-align:justify;font-size:16px;font-family:宋体, simsun;line-height:2em;\">作为材料科学与工程学院的领唱，张泽院士引吭高歌，用一曲《祖国不会忘记》表达对祖国的深情厚谊；医学院的一曲《东方之珠》讲述了百年来求是文脉的滋养；医学院附属第二医院的一曲《我为共产主义把青春贡献》唱出了六千多名员工坚持&ldquo;患者与服务对象至上&rdquo;的理念；管理学院在众多自选曲目之中另辟蹊径，用一曲《游子情思》表达归国管理人在异国他乡求学深造之时的思乡之情&hellip;&hellip;</p>\r\n\r\n<p style=\"text-indent:2em;text-align:justify;font-size:16px;font-family:宋体, simsun;line-height:2em;\">在中华人民共和国成立70周年之际，浙大师生以大合唱的方式，展示了浙大师生斗志昂扬、奋发有为、蓬勃向上的新时代精神风貌，进一步激发了爱国热情，增强了民族自信心和自豪感。各个参赛队伍用真情的歌声谱写了对祖国母亲真挚的告白。本次比赛由校工会主办，校党委宣传部、公共体育与艺术部、校团委协办，预赛为期三天，决赛将于9月27日举行。</p>\r\n</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('560','1350','1','','<!--#p8_attach#-->/cms/item/2020_02/26_17/0f0d592f1856380b.jpg.thumb.jpg','学生优秀科技作品展在浙大紫金港校区展出。该展览汇集了浙江各大高校近年来在国内外各大科技竞赛中的优秀获奖作品，这些作品展现了近年来大学生','113.247.22.80','113.218.174.87','1582726810','<div class=\"wp_articlecontent\">\r\n<p style=\"text-align: center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/128a5cf0215becb5.jpg\" target=\"_blank\"><img alt=\"f66c6fad-0c62-4630-bc8a-cf35a1b92852.jpg\" data-layer=\"photo\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/128a5cf0215becb5.jpg\" sudyfile-attr=\"{\'title\':\'A33E7714-1.jpg\'}\" /></a></p>\r\n\r\n<p style=\"text-align: center\">&nbsp;</p>\r\n\r\n<p style=\"text-align: center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/097809f5e355fd89.jpg\" target=\"_blank\"><img alt=\"a0e784e3-aa14-4f59-85d8-b7b08e46b55b.jpg\" data-layer=\"photo\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/097809f5e355fd89.jpg\" sudyfile-attr=\"{\'title\':\'A33E7716-2.jpg\'}\" /></a></p>\r\n\r\n<p style=\"text-align: center\">&nbsp;</p>\r\n\r\n<p style=\"text-align: center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/37ff5e80d0a37ee9.jpg\" target=\"_blank\"><img alt=\"9e3a005e-a04c-4bb4-844e-1afb943450d7.jpg\" data-layer=\"photo\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/37ff5e80d0a37ee9.jpg\" sudyfile-attr=\"{\'title\':\'A33E7747-3.jpg\'}\" /></a></p>\r\n\r\n<p style=\"text-align: left; line-height: 2em; text-indent: 2em\">&nbsp;</p>\r\n\r\n<p style=\"text-align: left; line-height: 2em; text-indent: 2em\"><span lang=\"EN-US\" style=\"font-size: 16px; font-family: 宋体,simsun; line-height: 2em\">5</span><span style=\"font-size: 16px; font-family: 宋体,simsun; line-height: 2em\">月</span><span lang=\"EN-US\" style=\"font-size: 16px; font-family: 宋体,simsun; line-height: 2em\">27</span><span style=\"font-size: 16px; font-family: 宋体,simsun; line-height: 2em\">日，学生优秀科技作品展在浙大紫金港校区展出。该展览汇集了浙江各大高校近年来在国内外各大科技竞赛中的优秀获奖作品，这些作品展现了近年来大学生依托高校丰富的资源平台，主动开展创新学习、创新研讨、创新实践的丰富内容，展示了当代大学生勇攀科技新高峰、开拓科技新领域的创新成果。</span></p>\r\n\r\n<p style=\"font-size: 16px; font-family: 宋体,simsun; text-align: left; line-height: 2em; text-indent: 2em\">（文 者也／摄影 古越）</p>\r\n</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('562','1356','1','','<!--#p8_attach#-->/cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','2月24日，校党委中心组开展2020年第2次集中学习，深入学习习近平总书记系列重要讲话精神和教育部党组有关文件精神。校党委书记邓卫主持会议，校长段献忠、全体在校校领导、校党委常委参加学习。','113.247.23.222','113.247.23.222','1582726810','<p class=\"vsbcontent_start\">2月24日，校党委中心组开展2020年第2次集中学习，深入学习习近平总书记系列重要讲话精神和教育部党组有关文件精神。校党委书记邓卫主持会议，校长段献忠、全体在校校领导、校党委常委参加学习。</p>\r\n\r\n<p style=\"text-align: center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/b06c741ec00052e3.jpg\" target=\"_blank\"><img alt=\"E41D237AAA5E47E3895DF1738C0_CC78FCC9_18669.jpg\" class=\"img_vsb_content\" orisrc=\"/__local/9/C8/6B/270B3B1FF17FEC6C031C50B40A7_A0608562_1AD3D1.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/b06c741ec00052e3.jpg.cthumb.jpg\" style=\"width: 500px;\" vheight=\"\" vsbhref=\"vurl\" vurl=\"/_vsl/EBAD4E41D237AAA5E47E3895DF1738C0/CC78FCC9/18669\" vwidth=\"500\" /></a></p>\r\n\r\n<p style=\"text-align: center;\"><span style=\"font-family: 楷体, 楷体_GB2312, SimKai;\">会议现场。</span></p>\r\n\r\n<p>会上，邓卫传达领学了习近平总书记关于新冠肺炎疫情防控工作的最新重要讲话精神、习近平总书记在第十九届中央纪律检查委员会第四次全体会议上的重要讲话精神、教育部党组有关直属高校领导班子建设的文件精神。陈伟传达领学了习近平总书记在中央统战工作会议上的重要讲话精神。</p>\r\n\r\n<p>邓卫在主持学习时指出，习近平总书记关于新冠肺炎疫情防控工作的最新重要讲话，为决胜疫情防控人民战争、总体战、阻击战，指明了方向、明确了路径、划定了重点。习近平总书记在十九届中央纪委四次全会上的重要讲话，对以全面从严治党新成效推进国家治理体系和治理能力现代化作出了战略部署。习近平总书记在中央统战工作会议上的重要讲话，对于加强和改进统一战线工作、团结一切可以团结的力量具有重大指导意义。</p>\r\n\r\n<p>邓卫强调，要把思想和行动进一步统一到习近平总书记系列重要讲话精神上来，坚决打赢疫情防控阻击战，确保师生员工生命安全和身体健康，统筹做好各项工作，加快推进学校&ldquo;双一流&rdquo;建设发展。</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('563','1357','1','','<!--#p8_attach#-->/cms/item/2020_02/26_22/d57883c29273e0f4.jpg','我和我的祖国”全校师生大合唱比赛开我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛赛','113.247.23.222','113.247.23.222','1582726810','<div class=\"wp_articlecontent\">\r\n<p style=\"text-align:center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/72687b6eefb42a8f.jpg\" target=\"_blank\"><img alt=\"e0eba684-f555-496f-a89f-c4046821ea98.jpg\" data-layer=\"photo\" original-src=\"/_upload/article/images/de/78/2cff74594bf0a709690aa671d186/e0eba684-f555-496f-a89f-c4046821ea98_d.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/72687b6eefb42a8f.jpg.cthumb.jpg\" sudyfile-attr=\"{\'title\':\'3.jpg\'}\" /></a></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/2af08f5b0efe88c0.jpg\" target=\"_blank\"><img alt=\"0bf61230-381f-4562-92a4-5ecbeb75ce78.jpg\" data-layer=\"photo\" original-src=\"/_upload/article/images/de/78/2cff74594bf0a709690aa671d186/df4e4fcf-6364-44f2-8f67-490e2dee6d54_d.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/2af08f5b0efe88c0.jpg.cthumb.jpg\" sudyfile-attr=\"{\'title\':\'2.jpg\'}\" /></a></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-indent:2em;text-align:justify;line-height:2em;\"><span style=\"text-indent:32px;font-size:16px;font-family:宋体, simsun;line-height:2em;\">&ldquo;我和我的祖国，一刻也不能分割，无论我走到哪里，都流出一首赞歌&hellip;&hellip;&rdquo;6月11日晚，剧场回荡着《我和我的祖国》的响亮歌声，来自全校54个院级工会的4000余名师生，用歌声献礼中华人民共和国70华诞。&ldquo;我和我的祖国&rdquo;全校师生大合唱比赛现场，师生们通过歌声、朗诵、独唱、舞蹈等形式把自己对祖国的爱&ldquo;尽情诉说&rdquo;。</span></p>\r\n\r\n<p style=\"text-indent:2em;text-align:justify;font-size:16px;font-family:宋体, simsun;line-height:2em;\">70年风雨兼程，70年砥砺奋进，中华儿女勠力同心；70年春华秋实，70年薪火相传，铸就今日辉煌中国。师生们唱出中国梦，唱响爱国情，用歌声讲述国家富强、民族振兴、人民幸福的今日中国。唱响主旋律、讴歌新时代，师生们把对祖国的热爱融入到美妙的歌声中，为扎根中国大地加快推进&ldquo;双一流&rdquo;建设，迈向世界一流大学前列汇聚磅礴力量。</p>\r\n\r\n<p style=\"text-indent:2em;text-align:justify;font-size:16px;font-family:宋体, simsun;line-height:2em;\">作为材料科学与工程学院的领唱，张泽院士引吭高歌，用一曲《祖国不会忘记》表达对祖国的深情厚谊；医学院的一曲《东方之珠》讲述了百年来求是文脉的滋养；医学院附属第二医院的一曲《我为共产主义把青春贡献》唱出了六千多名员工坚持&ldquo;患者与服务对象至上&rdquo;的理念；管理学院在众多自选曲目之中另辟蹊径，用一曲《游子情思》表达归国管理人在异国他乡求学深造之时的思乡之情&hellip;&hellip;</p>\r\n\r\n<p style=\"text-indent:2em;text-align:justify;font-size:16px;font-family:宋体, simsun;line-height:2em;\">在中华人民共和国成立70周年之际，浙大师生以大合唱的方式，展示了浙大师生斗志昂扬、奋发有为、蓬勃向上的新时代精神风貌，进一步激发了爱国热情，增强了民族自信心和自豪感。各个参赛队伍用真情的歌声谱写了对祖国母亲真挚的告白。本次比赛由校工会主办，校党委宣传部、公共体育与艺术部、校团委协办，预赛为期三天，决赛将于9月27日举行。</p>\r\n</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('564','1358','1','','<!--#p8_attach#-->/cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','2月24日，校党委中心组开展2020年第2次集中学习，深入学习习近平总书记系列重要讲话精神和教育部党组有关文件精神。校党委书记邓卫主持会议，校长段献忠、全体在校校领导、校党委常委参加学习。','113.247.23.222','113.247.23.222','1582726810','<p class=\"vsbcontent_start\">2月24日，校党委中心组开展2020年第2次集中学习，深入学习习近平总书记系列重要讲话精神和教育部党组有关文件精神。校党委书记邓卫主持会议，校长段献忠、全体在校校领导、校党委常委参加学习。</p>\r\n\r\n<p style=\"text-align: center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/b06c741ec00052e3.jpg\" target=\"_blank\"><img alt=\"E41D237AAA5E47E3895DF1738C0_CC78FCC9_18669.jpg\" class=\"img_vsb_content\" orisrc=\"/__local/9/C8/6B/270B3B1FF17FEC6C031C50B40A7_A0608562_1AD3D1.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/b06c741ec00052e3.jpg.cthumb.jpg\" style=\"width: 500px;\" vheight=\"\" vsbhref=\"vurl\" vurl=\"/_vsl/EBAD4E41D237AAA5E47E3895DF1738C0/CC78FCC9/18669\" vwidth=\"500\" /></a></p>\r\n\r\n<p style=\"text-align: center;\"><span style=\"font-family: 楷体, 楷体_GB2312, SimKai;\">会议现场。</span></p>\r\n\r\n<p>会上，邓卫传达领学了习近平总书记关于新冠肺炎疫情防控工作的最新重要讲话精神、习近平总书记在第十九届中央纪律检查委员会第四次全体会议上的重要讲话精神、教育部党组有关直属高校领导班子建设的文件精神。陈伟传达领学了习近平总书记在中央统战工作会议上的重要讲话精神。</p>\r\n\r\n<p>邓卫在主持学习时指出，习近平总书记关于新冠肺炎疫情防控工作的最新重要讲话，为决胜疫情防控人民战争、总体战、阻击战，指明了方向、明确了路径、划定了重点。习近平总书记在十九届中央纪委四次全会上的重要讲话，对以全面从严治党新成效推进国家治理体系和治理能力现代化作出了战略部署。习近平总书记在中央统战工作会议上的重要讲话，对于加强和改进统一战线工作、团结一切可以团结的力量具有重大指导意义。</p>\r\n\r\n<p>邓卫强调，要把思想和行动进一步统一到习近平总书记系列重要讲话精神上来，坚决打赢疫情防控阻击战，确保师生员工生命安全和身体健康，统筹做好各项工作，加快推进学校&ldquo;双一流&rdquo;建设发展。</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('565','1359','1','','<!--#p8_attach#-->/cms/item/2020_02/26_22/d57883c29273e0f4.jpg','我和我的祖国”全校师生大合唱比赛开我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛赛','113.247.23.222','113.247.23.222','1582726810','<div class=\"wp_articlecontent\">\r\n<p style=\"text-align:center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/72687b6eefb42a8f.jpg\" target=\"_blank\"><img alt=\"e0eba684-f555-496f-a89f-c4046821ea98.jpg\" data-layer=\"photo\" original-src=\"/_upload/article/images/de/78/2cff74594bf0a709690aa671d186/e0eba684-f555-496f-a89f-c4046821ea98_d.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/72687b6eefb42a8f.jpg.cthumb.jpg\" sudyfile-attr=\"{\'title\':\'3.jpg\'}\" /></a></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/2af08f5b0efe88c0.jpg\" target=\"_blank\"><img alt=\"0bf61230-381f-4562-92a4-5ecbeb75ce78.jpg\" data-layer=\"photo\" original-src=\"/_upload/article/images/de/78/2cff74594bf0a709690aa671d186/df4e4fcf-6364-44f2-8f67-490e2dee6d54_d.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/2af08f5b0efe88c0.jpg.cthumb.jpg\" sudyfile-attr=\"{\'title\':\'2.jpg\'}\" /></a></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-indent:2em;text-align:justify;line-height:2em;\"><span style=\"text-indent:32px;font-size:16px;font-family:宋体, simsun;line-height:2em;\">&ldquo;我和我的祖国，一刻也不能分割，无论我走到哪里，都流出一首赞歌&hellip;&hellip;&rdquo;6月11日晚，剧场回荡着《我和我的祖国》的响亮歌声，来自全校54个院级工会的4000余名师生，用歌声献礼中华人民共和国70华诞。&ldquo;我和我的祖国&rdquo;全校师生大合唱比赛现场，师生们通过歌声、朗诵、独唱、舞蹈等形式把自己对祖国的爱&ldquo;尽情诉说&rdquo;。</span></p>\r\n\r\n<p style=\"text-indent:2em;text-align:justify;font-size:16px;font-family:宋体, simsun;line-height:2em;\">70年风雨兼程，70年砥砺奋进，中华儿女勠力同心；70年春华秋实，70年薪火相传，铸就今日辉煌中国。师生们唱出中国梦，唱响爱国情，用歌声讲述国家富强、民族振兴、人民幸福的今日中国。唱响主旋律、讴歌新时代，师生们把对祖国的热爱融入到美妙的歌声中，为扎根中国大地加快推进&ldquo;双一流&rdquo;建设，迈向世界一流大学前列汇聚磅礴力量。</p>\r\n\r\n<p style=\"text-indent:2em;text-align:justify;font-size:16px;font-family:宋体, simsun;line-height:2em;\">作为材料科学与工程学院的领唱，张泽院士引吭高歌，用一曲《祖国不会忘记》表达对祖国的深情厚谊；医学院的一曲《东方之珠》讲述了百年来求是文脉的滋养；医学院附属第二医院的一曲《我为共产主义把青春贡献》唱出了六千多名员工坚持&ldquo;患者与服务对象至上&rdquo;的理念；管理学院在众多自选曲目之中另辟蹊径，用一曲《游子情思》表达归国管理人在异国他乡求学深造之时的思乡之情&hellip;&hellip;</p>\r\n\r\n<p style=\"text-indent:2em;text-align:justify;font-size:16px;font-family:宋体, simsun;line-height:2em;\">在中华人民共和国成立70周年之际，浙大师生以大合唱的方式，展示了浙大师生斗志昂扬、奋发有为、蓬勃向上的新时代精神风貌，进一步激发了爱国热情，增强了民族自信心和自豪感。各个参赛队伍用真情的歌声谱写了对祖国母亲真挚的告白。本次比赛由校工会主办，校党委宣传部、公共体育与艺术部、校团委协办，预赛为期三天，决赛将于9月27日举行。</p>\r\n</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('566','1360','1','','<!--#p8_attach#-->/cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','2月24日，校党委中心组开展2020年第2次集中学习，深入学习习近平总书记系列重要讲话精神和教育部党组有关文件精神。校党委书记邓卫主持会议，校长段献忠、全体在校校领导、校党委常委参加学习。','113.247.23.222','113.247.23.222','1522822645','<p class=\"vsbcontent_start\">2月24日，校党委中心组开展2020年第2次集中学习，深入学习习近平总书记系列重要讲话精神和教育部党组有关文件精神。校党委书记邓卫主持会议，校长段献忠、全体在校校领导、校党委常委参加学习。</p>\r\n\r\n<p style=\"text-align: center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/b06c741ec00052e3.jpg\" target=\"_blank\"><img alt=\"E41D237AAA5E47E3895DF1738C0_CC78FCC9_18669.jpg\" class=\"img_vsb_content\" orisrc=\"/__local/9/C8/6B/270B3B1FF17FEC6C031C50B40A7_A0608562_1AD3D1.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/b06c741ec00052e3.jpg.cthumb.jpg\" style=\"width: 500px;\" vheight=\"\" vsbhref=\"vurl\" vurl=\"/_vsl/EBAD4E41D237AAA5E47E3895DF1738C0/CC78FCC9/18669\" vwidth=\"500\" /></a></p>\r\n\r\n<p style=\"text-align: center;\"><span style=\"font-family: 楷体, 楷体_GB2312, SimKai;\">会议现场。</span></p>\r\n\r\n<p>会上，邓卫传达领学了习近平总书记关于新冠肺炎疫情防控工作的最新重要讲话精神、习近平总书记在第十九届中央纪律检查委员会第四次全体会议上的重要讲话精神、教育部党组有关直属高校领导班子建设的文件精神。陈伟传达领学了习近平总书记在中央统战工作会议上的重要讲话精神。</p>\r\n\r\n<p>邓卫在主持学习时指出，习近平总书记关于新冠肺炎疫情防控工作的最新重要讲话，为决胜疫情防控人民战争、总体战、阻击战，指明了方向、明确了路径、划定了重点。习近平总书记在十九届中央纪委四次全会上的重要讲话，对以全面从严治党新成效推进国家治理体系和治理能力现代化作出了战略部署。习近平总书记在中央统战工作会议上的重要讲话，对于加强和改进统一战线工作、团结一切可以团结的力量具有重大指导意义。</p>\r\n\r\n<p>邓卫强调，要把思想和行动进一步统一到习近平总书记系列重要讲话精神上来，坚决打赢疫情防控阻击战，确保师生员工生命安全和身体健康，统筹做好各项工作，加快推进学校&ldquo;双一流&rdquo;建设发展。</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('567','1361','1','','<!--#p8_attach#-->/cms/item/2020_02/26_22/d57883c29273e0f4.jpg','我和我的祖国”全校师生大合唱比赛开我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛赛','113.247.23.222','113.247.23.222','1522822645','<div class=\"wp_articlecontent\">\r\n<p style=\"text-align:center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/72687b6eefb42a8f.jpg\" target=\"_blank\"><img alt=\"e0eba684-f555-496f-a89f-c4046821ea98.jpg\" data-layer=\"photo\" original-src=\"/_upload/article/images/de/78/2cff74594bf0a709690aa671d186/e0eba684-f555-496f-a89f-c4046821ea98_d.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/72687b6eefb42a8f.jpg.cthumb.jpg\" sudyfile-attr=\"{\'title\':\'3.jpg\'}\" /></a></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/2af08f5b0efe88c0.jpg\" target=\"_blank\"><img alt=\"0bf61230-381f-4562-92a4-5ecbeb75ce78.jpg\" data-layer=\"photo\" original-src=\"/_upload/article/images/de/78/2cff74594bf0a709690aa671d186/df4e4fcf-6364-44f2-8f67-490e2dee6d54_d.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/2af08f5b0efe88c0.jpg.cthumb.jpg\" sudyfile-attr=\"{\'title\':\'2.jpg\'}\" /></a></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-indent:2em;text-align:justify;line-height:2em;\"><span style=\"text-indent:32px;font-size:16px;font-family:宋体, simsun;line-height:2em;\">&ldquo;我和我的祖国，一刻也不能分割，无论我走到哪里，都流出一首赞歌&hellip;&hellip;&rdquo;6月11日晚，剧场回荡着《我和我的祖国》的响亮歌声，来自全校54个院级工会的4000余名师生，用歌声献礼中华人民共和国70华诞。&ldquo;我和我的祖国&rdquo;全校师生大合唱比赛现场，师生们通过歌声、朗诵、独唱、舞蹈等形式把自己对祖国的爱&ldquo;尽情诉说&rdquo;。</span></p>\r\n\r\n<p style=\"text-indent:2em;text-align:justify;font-size:16px;font-family:宋体, simsun;line-height:2em;\">70年风雨兼程，70年砥砺奋进，中华儿女勠力同心；70年春华秋实，70年薪火相传，铸就今日辉煌中国。师生们唱出中国梦，唱响爱国情，用歌声讲述国家富强、民族振兴、人民幸福的今日中国。唱响主旋律、讴歌新时代，师生们把对祖国的热爱融入到美妙的歌声中，为扎根中国大地加快推进&ldquo;双一流&rdquo;建设，迈向世界一流大学前列汇聚磅礴力量。</p>\r\n\r\n<p style=\"text-indent:2em;text-align:justify;font-size:16px;font-family:宋体, simsun;line-height:2em;\">作为材料科学与工程学院的领唱，张泽院士引吭高歌，用一曲《祖国不会忘记》表达对祖国的深情厚谊；医学院的一曲《东方之珠》讲述了百年来求是文脉的滋养；医学院附属第二医院的一曲《我为共产主义把青春贡献》唱出了六千多名员工坚持&ldquo;患者与服务对象至上&rdquo;的理念；管理学院在众多自选曲目之中另辟蹊径，用一曲《游子情思》表达归国管理人在异国他乡求学深造之时的思乡之情&hellip;&hellip;</p>\r\n\r\n<p style=\"text-indent:2em;text-align:justify;font-size:16px;font-family:宋体, simsun;line-height:2em;\">在中华人民共和国成立70周年之际，浙大师生以大合唱的方式，展示了浙大师生斗志昂扬、奋发有为、蓬勃向上的新时代精神风貌，进一步激发了爱国热情，增强了民族自信心和自豪感。各个参赛队伍用真情的歌声谱写了对祖国母亲真挚的告白。本次比赛由校工会主办，校党委宣传部、公共体育与艺术部、校团委协办，预赛为期三天，决赛将于9月27日举行。</p>\r\n</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('568','1362','1','','<!--#p8_attach#-->/cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','为“艾”发光 共建健康中国第32个世界艾滋病日到来之际，11月29日晚，学生举办为“艾”发光活动，用烛光点亮“NO AIDS”和红丝带的字样和图案，呼吁广大青年知艾防艾，共享健康。','113.218.174.87','113.218.174.87','1586767761','<p style=\";text-indent:32px;text-autospace:ideograph-numeric;text-align:center;line-height:33px\"><strong><span style=\"font-family: 微软雅黑;font-size: 16px\"><span style=\"font-family:微软雅黑\">为</span>&ldquo;艾&rdquo;发光 共建健康中国</span></strong></p>\r\n\r\n<p style=\"text-indent: 32px; line-height: 33px; text-align: center;\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_16/20371e3143d36278.jpg\" target=\"_blank\"><img alt=\"1575114315355.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_16/20371e3143d36278.jpg\" title=\"3.jpg\" /></a><span style=\"font-family: 微软雅黑;\">&nbsp;</span></p>\r\n\r\n<p style=\"text-indent: 32px; line-height: 33px; text-align: center;\">&nbsp;</p>\r\n\r\n<p style=\";text-indent: 28px;line-height: 33px\"><span style=\";font-family:微软雅黑;font-size:14px\"><span style=\"font-family:微软雅黑\">本网讯（通讯员刘攀</span> <span style=\"font-family:微软雅黑\">记者李建华）在第</span>32个世界艾滋病日到来之际，11月29日晚，学生举办为&ldquo;艾&rdquo;发光活动，用烛光点亮&ldquo;NO AIDS&rdquo;和红丝带的字样和图案，呼吁广大青年知艾防艾，共享健康。</span></p>\r\n\r\n<p style=\";text-indent: 28px;line-height: 33px\"><span style=\";font-family:微软雅黑;font-size:14px\"><span style=\"font-family:微软雅黑\">青年志愿者中心骨干大学生向在场的近</span>200名大学生讲解防艾知识，唤起防&ldquo;艾&rdquo;从自身做起的社会责任感，消除歧视和偏见，关心和帮助艾滋病患者，共担防艾责任，共享健康权益，共建健康中国。</span></p>\r\n\r\n<p style=\"text-indent: 28px; line-height: 33px; text-align: center;\"><span style=\";font-family:微软雅黑;font-size:14px\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_16/c2278f557cfe91d7.png\" target=\"_blank\"><img alt=\"1575114329416.png\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_16/c2278f557cfe91d7.png\" title=\"2.png\" /></a></span></p>\r\n\r\n<p style=\"text-indent: 43px\"><span style=\";font-family:宋体;font-size:21px\">&nbsp;</span></p>\r\n\r\n<p style=\"text-indent:43px;text-align:justify;text-justify:inter-ideograph\"><span style=\";font-family:Calibri;font-size:21px\">&nbsp;</span></p>\r\n\r\n<p>&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('569','1363','1','','<!--#p8_attach#-->/cms/item/2020_02/26_22/7bc0c0f04abca1d8.jpg','2月24日，校党委中心组开展2020年第2次集中学习，深入学习习近平总书记系列重要讲话精神和教育部党组有关文件精神。校党委书记邓卫主持会议，校长段献忠、全体在校校领导、校党委常委参加学习。','113.218.174.87','113.218.174.87','1586767761','<p class=\"vsbcontent_start\">2月24日，校党委中心组开展2020年第2次集中学习，深入学习习近平总书记系列重要讲话精神和教育部党组有关文件精神。校党委书记邓卫主持会议，校长段献忠、全体在校校领导、校党委常委参加学习。</p>\r\n\r\n<p style=\"text-align: center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/b06c741ec00052e3.jpg\" target=\"_blank\"><img alt=\"E41D237AAA5E47E3895DF1738C0_CC78FCC9_18669.jpg\" class=\"img_vsb_content\" orisrc=\"/__local/9/C8/6B/270B3B1FF17FEC6C031C50B40A7_A0608562_1AD3D1.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/b06c741ec00052e3.jpg.cthumb.jpg\" style=\"width: 500px;\" vheight=\"\" vsbhref=\"vurl\" vurl=\"/_vsl/EBAD4E41D237AAA5E47E3895DF1738C0/CC78FCC9/18669\" vwidth=\"500\" /></a></p>\r\n\r\n<p style=\"text-align: center;\"><span style=\"font-family: 楷体, 楷体_GB2312, SimKai;\">会议现场。</span></p>\r\n\r\n<p>会上，邓卫传达领学了习近平总书记关于新冠肺炎疫情防控工作的最新重要讲话精神、习近平总书记在第十九届中央纪律检查委员会第四次全体会议上的重要讲话精神、教育部党组有关直属高校领导班子建设的文件精神。陈伟传达领学了习近平总书记在中央统战工作会议上的重要讲话精神。</p>\r\n\r\n<p>邓卫在主持学习时指出，习近平总书记关于新冠肺炎疫情防控工作的最新重要讲话，为决胜疫情防控人民战争、总体战、阻击战，指明了方向、明确了路径、划定了重点。习近平总书记在十九届中央纪委四次全会上的重要讲话，对以全面从严治党新成效推进国家治理体系和治理能力现代化作出了战略部署。习近平总书记在中央统战工作会议上的重要讲话，对于加强和改进统一战线工作、团结一切可以团结的力量具有重大指导意义。</p>\r\n\r\n<p>邓卫强调，要把思想和行动进一步统一到习近平总书记系列重要讲话精神上来，坚决打赢疫情防控阻击战，确保师生员工生命安全和身体健康，统筹做好各项工作，加快推进学校&ldquo;双一流&rdquo;建设发展。</p>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('570','1364','1','','<!--#p8_attach#-->/cms/item/2020_02/26_22/d57883c29273e0f4.jpg','我和我的祖国”全校师生大合唱比赛开我和我的祖国”全校师生大合唱比赛开赛我和我的祖国”全校师生大合唱比赛开赛赛','113.218.174.87','113.218.174.87','1586767761','<div class=\"wp_articlecontent\">\r\n<p style=\"text-align:center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/72687b6eefb42a8f.jpg\" target=\"_blank\"><img alt=\"e0eba684-f555-496f-a89f-c4046821ea98.jpg\" data-layer=\"photo\" original-src=\"/_upload/article/images/de/78/2cff74594bf0a709690aa671d186/e0eba684-f555-496f-a89f-c4046821ea98_d.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/72687b6eefb42a8f.jpg.cthumb.jpg\" sudyfile-attr=\"{\'title\':\'3.jpg\'}\" /></a></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/2af08f5b0efe88c0.jpg\" target=\"_blank\"><img alt=\"0bf61230-381f-4562-92a4-5ecbeb75ce78.jpg\" data-layer=\"photo\" original-src=\"/_upload/article/images/de/78/2cff74594bf0a709690aa671d186/df4e4fcf-6364-44f2-8f67-490e2dee6d54_d.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/2af08f5b0efe88c0.jpg.cthumb.jpg\" sudyfile-attr=\"{\'title\':\'2.jpg\'}\" /></a></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-indent:2em;text-align:justify;line-height:2em;\"><span style=\"text-indent:32px;font-size:16px;font-family:宋体, simsun;line-height:2em;\">&ldquo;我和我的祖国，一刻也不能分割，无论我走到哪里，都流出一首赞歌&hellip;&hellip;&rdquo;6月11日晚，剧场回荡着《我和我的祖国》的响亮歌声，来自全校54个院级工会的4000余名师生，用歌声献礼中华人民共和国70华诞。&ldquo;我和我的祖国&rdquo;全校师生大合唱比赛现场，师生们通过歌声、朗诵、独唱、舞蹈等形式把自己对祖国的爱&ldquo;尽情诉说&rdquo;。</span></p>\r\n\r\n<p style=\"text-indent:2em;text-align:justify;font-size:16px;font-family:宋体, simsun;line-height:2em;\">70年风雨兼程，70年砥砺奋进，中华儿女勠力同心；70年春华秋实，70年薪火相传，铸就今日辉煌中国。师生们唱出中国梦，唱响爱国情，用歌声讲述国家富强、民族振兴、人民幸福的今日中国。唱响主旋律、讴歌新时代，师生们把对祖国的热爱融入到美妙的歌声中，为扎根中国大地加快推进&ldquo;双一流&rdquo;建设，迈向世界一流大学前列汇聚磅礴力量。</p>\r\n\r\n<p style=\"text-indent:2em;text-align:justify;font-size:16px;font-family:宋体, simsun;line-height:2em;\">作为材料科学与工程学院的领唱，张泽院士引吭高歌，用一曲《祖国不会忘记》表达对祖国的深情厚谊；医学院的一曲《东方之珠》讲述了百年来求是文脉的滋养；医学院附属第二医院的一曲《我为共产主义把青春贡献》唱出了六千多名员工坚持&ldquo;患者与服务对象至上&rdquo;的理念；管理学院在众多自选曲目之中另辟蹊径，用一曲《游子情思》表达归国管理人在异国他乡求学深造之时的思乡之情&hellip;&hellip;</p>\r\n\r\n<p style=\"text-indent:2em;text-align:justify;font-size:16px;font-family:宋体, simsun;line-height:2em;\">在中华人民共和国成立70周年之际，浙大师生以大合唱的方式，展示了浙大师生斗志昂扬、奋发有为、蓬勃向上的新时代精神风貌，进一步激发了爱国热情，增强了民族自信心和自豪感。各个参赛队伍用真情的歌声谱写了对祖国母亲真挚的告白。本次比赛由校工会主办，校党委宣传部、公共体育与艺术部、校团委协办，预赛为期三天，决赛将于9月27日举行。</p>\r\n</div>\r\n');
REPLACE INTO `p8_cms_item_article_addon` VALUES ('571','1365','1','','<!--#p8_attach#-->/cms/item/2020_02/26_17/0f0d592f1856380b.jpg.thumb.jpg','学生优秀科技作品展在浙大紫金港校区展出。该展览汇集了浙江各大高校近年来在国内外各大科技竞赛中的优秀获奖作品，这些作品展现了近年来大学生','113.218.174.87','113.218.174.87','1586767761','<div class=\"wp_articlecontent\">\r\n<p style=\"text-align: center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/128a5cf0215becb5.jpg\" target=\"_blank\"><img alt=\"f66c6fad-0c62-4630-bc8a-cf35a1b92852.jpg\" data-layer=\"photo\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/128a5cf0215becb5.jpg\" sudyfile-attr=\"{\'title\':\'A33E7714-1.jpg\'}\" /></a></p>\r\n\r\n<p style=\"text-align: center\">&nbsp;</p>\r\n\r\n<p style=\"text-align: center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/097809f5e355fd89.jpg\" target=\"_blank\"><img alt=\"a0e784e3-aa14-4f59-85d8-b7b08e46b55b.jpg\" data-layer=\"photo\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/097809f5e355fd89.jpg\" sudyfile-attr=\"{\'title\':\'A33E7716-2.jpg\'}\" /></a></p>\r\n\r\n<p style=\"text-align: center\">&nbsp;</p>\r\n\r\n<p style=\"text-align: center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/37ff5e80d0a37ee9.jpg\" target=\"_blank\"><img alt=\"9e3a005e-a04c-4bb4-844e-1afb943450d7.jpg\" data-layer=\"photo\" src=\"<!--#p8_attach#-->/cms/item/2020_02/26_17/37ff5e80d0a37ee9.jpg\" sudyfile-attr=\"{\'title\':\'A33E7747-3.jpg\'}\" /></a></p>\r\n\r\n<p style=\"text-align: left; line-height: 2em; text-indent: 2em\">&nbsp;</p>\r\n\r\n<p style=\"text-align: left; line-height: 2em; text-indent: 2em\"><span lang=\"EN-US\" style=\"font-size: 16px; font-family: 宋体,simsun; line-height: 2em\">5</span><span style=\"font-size: 16px; font-family: 宋体,simsun; line-height: 2em\">月</span><span lang=\"EN-US\" style=\"font-size: 16px; font-family: 宋体,simsun; line-height: 2em\">27</span><span style=\"font-size: 16px; font-family: 宋体,simsun; line-height: 2em\">日，学生优秀科技作品展在浙大紫金港校区展出。该展览汇集了浙江各大高校近年来在国内外各大科技竞赛中的优秀获奖作品，这些作品展现了近年来大学生依托高校丰富的资源平台，主动开展创新学习、创新研讨、创新实践的丰富内容，展示了当代大学生勇攀科技新高峰、开拓科技新领域的创新成果。</span></p>\r\n\r\n<p style=\"font-size: 16px; font-family: 宋体,simsun; text-align: left; line-height: 2em; text-indent: 2em\">（文 者也／摄影 古越）</p>\r\n</div>\r\n');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1100','6','1','1441093610','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1175','6','866','1586618619','admin168.');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1170','6','866','1586618581','admin168.');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1160','6','903','1487295936','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1161','6','903','1487296076','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1177','6','903','1497194716','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1178','6','903','1497194716','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1187','6','884','1582729273','admin5');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1188','6','884','1582773560','admin168.');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1189','6','884','1582729305','admin5');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1190','6','884','1582729322','admin5');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1191','6','884','1582729335','admin5');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1192','6','903','1501141202','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1194','6','903','1501141447','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1195','6','903','1501297030','admin');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1196','6','887','1586618441','admin168.');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1197','6','887','1586618372','admin168.');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1198','6','887','1586618290','admin168.');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1199','6','887','1586618319','admin168.');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1187','3','884','1582729273','admin5');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1339','6','874','1582710309','admin5');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1340','6','872','1582710786','admin5');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1341','6','872','1582711089','admin5');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1342','6','872','1582711470','admin5');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1347','6','903','1582728002','admin5');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1348','6','903','1582727669','admin5');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1349','6','903','1582727980','admin5');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1350','6','903','1586767682','admin168.');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1352','6','824','1586618716','admin168.');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1353','6','824','1586618716','admin168.');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1354','6','824','1586618716','admin168.');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1355','6','824','1586618716','admin168.');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1356','6','891','1586668060','admin168.');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1357','6','891','1586668060','admin168.');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1358','6','929','1586668060','admin168.');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1359','6','929','1586668060','admin168.');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1360','6','890','1586672257','admin168.');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1361','6','890','1586672257','admin168.');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1362','6','839','1586767781','admin168.');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1363','6','839','1586767781','admin168.');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1364','6','839','1586767781','admin168.');
REPLACE INTO `p8_cms_item_attribute` VALUES ('1365','6','839','1586767781','admin168.');
REPLACE INTO `p8_cms_item_digg` VALUES ('1','1139','2','0');
REPLACE INTO `p8_cms_item_digg` VALUES ('2','1068','0','1');
REPLACE INTO `p8_cms_item_digg` VALUES ('3','1136','2','0');
REPLACE INTO `p8_cms_item_digg` VALUES ('4','1137','2','0');
REPLACE INTO `p8_cms_item_digg` VALUES ('5','234','1','0');
REPLACE INTO `p8_cms_item_digg` VALUES ('6','1140','1','1');
REPLACE INTO `p8_cms_item_digg` VALUES ('7','1138','1','0');
REPLACE INTO `p8_cms_item_digg` VALUES ('8','1192','1','0');
REPLACE INTO `p8_cms_item_digg` VALUES ('9','1175','1','0');
REPLACE INTO `p8_cms_item_digg` VALUES ('10','1195','1','0');
REPLACE INTO `p8_cms_item_down_` VALUES ('1332','down','146','3','admin2','测试下载内容模型的下载试用','','0','','','','','','2332','','','','','','1','admin2','0','1582562902','1582562902','1582562902','1582562902','1','','','15','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";s:1:\\\"0\\\";s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_down_addon` VALUES ('1','1332','1','','','2332','113.246.95.68','113.246.95.68','1582562902','&nbsp;2332','','11','1');
REPLACE INTO `p8_cms_item_mood` VALUES ('1','欠扁','1.gif','99');
REPLACE INTO `p8_cms_item_mood` VALUES ('2','支持','2.gif','88');
REPLACE INTO `p8_cms_item_mood` VALUES ('3','很棒','3.gif','77');
REPLACE INTO `p8_cms_item_mood` VALUES ('4','找骂','4.gif','66');
REPLACE INTO `p8_cms_item_mood` VALUES ('5','搞笑','5.gif','55');
REPLACE INTO `p8_cms_item_mood` VALUES ('6','软文','6.gif','44');
REPLACE INTO `p8_cms_item_mood` VALUES ('7','不解','7.gif','1');
REPLACE INTO `p8_cms_item_mood` VALUES ('8','吃惊','8.gif','1');
REPLACE INTO `p8_cms_item_page_` VALUES ('1312','page','895','3','admin2','学院简介','','0','','<!--#p8_attach#-->/cms/item/2020_04/12_09/282163366352d397.jpg','','','','123','','','','','','1','admin168.','0','1565937875','1565937875','1565937875','1586656684','1','','','449','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_page_` VALUES ('1313','page','898','1','admin','联系我们','','0','','<!--#p8_attach#-->/cms/item/2020_04/12_09/996bf7d495a5b20e.jpg.cthumb.jpg','','','','一、校内各单位电话两办26035866科研处26035633教务处26035375学工处26035259人事处26032109财务处26035567后勤保障处26035562发展办公室26033178培训中心在职研究生教育：26035372高级研修：26035556信息化办公室26035565信息工程学院26032723化学生物学与生物技术学院','','','','','','1','admin168.','0','1565939036','1565939036','1565939036','1586770407','1','','','62','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_page_` VALUES ('1314','page','897','1','admin','历史沿革','','0','','','','','',' 依托大学学科优势，结合深圳的区位优势，深圳研究生院以“前沿领域、交叉学科、应用学术、国际标准”为办学方针，加强学科建设。现有信息工程学院、化学生物学与生物技术学院、环境与能源学院、城市规划与设计学院、新材料学院、汇丰商学院','','','','','','1','admin168.','0','1565939714','1565939714','1565939714','1586770459','1','','','63','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_page_` VALUES ('1315','page','896','1','admin','学院领导','','0','','','','','','学院领导介绍','','','','','','1','admin','0','1565939911','1565939911','1565939911','1565939978','1','','','44','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_page_addon` VALUES ('7','1312','1','','<!--#p8_attach#-->/cms/item/2020_04/12_09/282163366352d397.jpg','123','113.246.110.81','113.247.23.222','1565937875','<p><span style=\"font-size:16px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2001年1月，与深圳市人民政府签署《合作创办北协议书》，共同创办院。经过十五年发展，研究生院依托立足深圳，逐步成为扎根深圳的大学研究型国际化校区，大学创建世界一流大学战略的重要组成部分。</span></p>\r\n\r\n<p><span style=\"font-size:16px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 依托大学学科优势，结合深圳的区位优势，深圳研究生院以&ldquo;前沿领域、交叉学科、应用学术、国际标准&rdquo;为办学方针，加强学科建设。现有信息工程学院、化学生物学与生物技术学院、环境与能源学院、城市规划与设计学院、新材料学院、汇丰商学院、国际法学院以及人文社会科学学院等八个学院，学科专业涉及信息科学与技术、电子与通讯技术、化学生物学、环境科学、环境与能源、城市与区域规划、景观设计学、社会学、心理学、新闻传播、金融、经济、管理、法律等领域。</span></p>\r\n\r\n<p><span style=\"font-size:16px;\">&nbsp; &nbsp; &nbsp;2001年1月，大学与深圳市人民政府签署《合作创办大学深圳校区协议书》，共同创办研究生院。经过十五年发展，研究生院依托、立足深圳，逐步成为扎根深圳的大学研究型国际化校区，大学创建世界一流大学战略的重要组成部分。</span></p>\r\n\r\n<p><span style=\"font-size:16px;\">&nbsp; &nbsp; &nbsp; 依托大学学科优势，结合深圳的区位优势，研究生院以&ldquo;前沿领域、交叉学科、应用学术、国际标准&rdquo;为办学方针，加强学科建设。现有信息工程学院、化学生物学与生物技术学院、环境与能源学院、城市规划与设计学院、新材料学院、汇丰商学院、国际法学院以及人文社会科学学院等八个学院，学科专业涉及信息科学与技术、电子与通讯技术、化学生物学、环境科学、环境与能源、城市与区域规划、景观设计学、社会学、心理学、新闻传播、金融、经济、管理、法律等领域。</span></p>\r\n\r\n<p><span style=\"font-size:16px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 依托大学学科优势，结合深圳的区位优势，深圳研究生院以&ldquo;前沿领域、交叉学科、应用学术、国际标准&rdquo;为办学方针，加强学科建设。现有信息工程学院、化学生物学与生物技术学院、环境与能源学院、城市规划与设计学院、新材料学院、汇丰商学院、国际法学院以及人文社会科学学院等八个学院，学科专业涉及信息科学与技术、电子与通讯技术、化学生物学、环境科学、环境与能源、城市与区域规划、景观设计学、社会学、心理学、新闻传播、金融、经济、管理、法律等领域。</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style=\"text-align: center;\"><a href=\"<!--#p8_attach#-->/cms/item/2020_04/12_09/282163366352d397.jpg\" target=\"_blank\"><img alt=\"qinghua214.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_04/12_09/282163366352d397.jpg\" style=\"width: 766px; height: 315px;\" /></a></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:16px;\">&nbsp; &nbsp; &nbsp;2001年1月，大学与深圳市人民政府签署《合作创办大学深圳校区协议书》，共同创办研究生院。经过十五年发展，研究生院依托、立足深圳，逐步成为扎根深圳的大学研究型国际化校区，大学创建世界一流大学战略的重要组成部分。</span></p>\r\n\r\n<p><span style=\"font-size:16px;\">&nbsp; &nbsp; &nbsp; 依托大学学科优势，结合深圳的区位优势，研究生院以&ldquo;前沿领域、交叉学科、应用学术、国际标准&rdquo;为办学方针，加强学科建设。现有信息工程学院、化学生物学与生物技术学院、环境与能源学院、城市规划与设计学院、新材料学院、汇丰商学院、国际法学院以及人文社会科学学院等八个学院，学科专业涉及信息科学与技术、电子与通讯技术、化学生物学、环境科学、环境与能源、城市与区域规划、景观设计学、社会学、心理学、新闻传播、金融、经济、管理、法律等领域。</span></p>\r\n\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_page_addon` VALUES ('8','1313','1','','<!--#p8_attach#-->/cms/item/2020_04/12_09/996bf7d495a5b20e.jpg.cthumb.jpg','一、校内各单位电话两办26035866科研处26035633教务处26035375学工处26035259人事处26032109财务处26035567后勤保障处26035562发展办公室26033178培训中心在职研究生教育：26035372高级研修：26035556信息化办公室26035565信息工程学院26032723化学生物学与生物技术学院','113.246.110.81','113.218.174.87','1565939036','<p style=\"text-align: center\"><a href=\"<!--#p8_attach#-->/cms/item/2020_04/13_17/cda4987c5a4d1e35.jpg\" target=\"_blank\"><img alt=\"998.jpg\" src=\"<!--#p8_attach#-->/cms/item/2020_04/13_17/cda4987c5a4d1e35.jpg.cthumb.jpg\" style=\"height: 306px; width: 1000px\" /></a></p>\r\n\r\n<p style=\"margin-left: 40px\">&nbsp;</p>\r\n\r\n<p style=\"margin-left: 40px\">&nbsp;</p>\r\n\r\n<p style=\"margin-left: 40px\"><span style=\"font-size: 16px\"><font face=\"幼圆\">.</font>学校综合办公电话：党政办公室综合科 83590060</span></p>\r\n\r\n<p style=\"margin-left: 40px\">&nbsp;</p>\r\n\r\n<p style=\"margin-left: 40px\"><span style=\"font-size: 16px\"><font face=\"幼圆\">.</font>网站宏观管理、技术支持:网络与信息中心</span></p>\r\n\r\n<p style=\"margin-left: 40px\">&nbsp;</p>\r\n\r\n<p style=\"margin-left: 40px\"><span style=\"font-size: 16px\"><font face=\"幼圆\">.</font>通知通告发布：888888888&nbsp;</span></p>\r\n\r\n<p style=\"margin-left: 40px\">&nbsp;</p>\r\n\r\n<p style=\"margin-left: 40px\"><span style=\"font-size: 16px\"><font face=\"幼圆\">.</font>矿大新闻发布：新闻中心 88888888</span></p>\r\n\r\n<p style=\"margin-left: 40px\">&nbsp;</p>\r\n\r\n<p style=\"margin-left: 40px\"><span style=\"font-size: 16px\">.学术动态发布：科学技术研究院 8888888</span></p>\r\n\r\n<p style=\"margin-left: 40px\">&nbsp;</p>\r\n\r\n<p style=\"margin-left: 40px\"><span style=\"font-size: 16px\">.信息反馈与意见建议请发送到邮箱:email@xx.edu.cn</span></p>\r\n\r\n<p style=\"margin-left: 40px\">&nbsp;</p>\r\n\r\n<p style=\"margin-left: 40px\"><span style=\"font-size: 16px\">.学校地址：江苏省徐州市大学路1号中国矿业大学南湖校区&nbsp;</span></p>\r\n\r\n<p style=\"margin-left: 40px\">&nbsp;</p>\r\n\r\n<p style=\"margin-left: 40px\">&nbsp;</p>\r\n\r\n<p style=\"margin-left: 40px\">&nbsp;</p>\r\n');
REPLACE INTO `p8_cms_item_page_addon` VALUES ('9','1314','1','','',' 依托大学学科优势，结合深圳的区位优势，深圳研究生院以“前沿领域、交叉学科、应用学术、国际标准”为办学方针，加强学科建设。现有信息工程学院、化学生物学与生物技术学院、环境与能源学院、城市规划与设计学院、新材料学院、汇丰商学院','113.246.110.81','113.218.174.87','1565939714','<p>2001年1月，与深圳市人民政府签署《合作创办北协议书》，共同创办院。经过十五年发展，研究生院依托立足深圳，逐步成为扎根深圳的大学研究型国际化校区，大学创建世界一流大学战略的重要组成部分。</p>\r\n\r\n<p><span style=\"font-size: 16px\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 依托大学学科优势，结合深圳的区位优势，深圳研究生院以&ldquo;前沿领域、交叉学科、应用学术、国际标准&rdquo;为办学方针，加强学科建设。现有信息工程学院、化学生物学与生物技术学院、环境与能源学院、城市规划与设计学院、新材料学院、汇丰商学院、国际法学院以及人文社会科学学院等八个学院，学科专业涉及信息科学与技术、电子与通讯技术、化学生物学、环境科学、环境与能源、城市与区域规划、景观设计学、社会学、心理学、新闻传播、金融、经济、管理、法律等领域。</span></p>\r\n\r\n<p><span style=\"font-size: 16px\">&nbsp; &nbsp; &nbsp;2001年1月，大学与深圳市人民政府签署《合作创办大学深圳校区协议书》，共同创办研究生院。经过十五年发展，研究生院依托、立足深圳，逐步成为扎根深圳的大学研究型国际化校区，大学创建世界一流大学战略的重要组成部分。</span></p>\r\n\r\n<p><span style=\"font-size: 16px\">&nbsp; &nbsp; &nbsp; 依托大学学科优势，结合深圳的区位优势，研究生院以&ldquo;前沿领域、交叉学科、应用学术、国际标准&rdquo;为办学方针，加强学科建设。现有信息工程学院、化学生物学与生物技术学院、环境与能源学院、城市规划与设计学院、新材料学院、汇丰商学院、国际法学院以及人文社会科学学院等八个学院，学科专业涉及信息科学与技术、电子与通讯技术、化学生物学、环境科学、环境与能源、城市与区域规划、景观设计学、社会学、心理学、新闻传播、金融、经济、管理、法律等领域。</span></p>\r\n');
REPLACE INTO `p8_cms_item_page_addon` VALUES ('10','1315','1','','','学院领导介绍','113.246.110.81','113.246.110.81','1565939911','&nbsp;学院领导介绍');
REPLACE INTO `p8_cms_item_photo_` VALUES ('1196','photo','887','1','admin','校园风景','','0','','<!--#p8_attach#-->/cms/item/2020_04/11_23/23dad8ddda2ae9d8.jpg.thumb.jpg','','','6','校园风景介绍','','','','','','1','admin168.','0','1469764448','1501300448','1469764448','1586618441','1','','','12','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_photo_` VALUES ('1197','photo','887','1','admin','校园风景','','0','','<!--#p8_attach#-->/cms/item/2020_04/11_23/7a4d91ded59ea744.jpg.thumb.jpg','','','6','校园风景2','','','','','','1','admin168.','0','1469764448','1501300488','1469764448','1586618372','1','','','13','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_photo_` VALUES ('1198','photo','887','1','admin','校园一角','','0','','<!--#p8_attach#-->/cms/item/2020_04/11_23/4ee29edc3681e5ce.jpg.cthumb.jpg','','','6','校园一角2','','','','','','1','admin168.','0','1469764448','1501300537','1469764448','1586618290','1','','','25','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_photo_` VALUES ('1199','photo','887','1','admin','教学楼','','0','','<!--#p8_attach#-->/cms/item/2020_04/11_22/6f02fe967e5282df.jpg.thumb.jpg','','','6','教学楼2','','','','','','1','admin168.','0','1469764448','1501300595','1469764448','1586618319','1','','','35','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_photo_` VALUES ('1352','photo','824','1','admin','校园风景','','0','','<!--#p8_attach#-->/cms/item/2020_04/11_23/23dad8ddda2ae9d8.jpg.thumb.jpg','','','6','校园风景介绍','','','','','','1','admin168.','0','1523460314','1586618716','1523460314','1586618716','1','','','0','0','0','','','','a:2:{i:0;s:145:\\\"a:1:{s:8:\\\\\\\"allow_ip\\\\\\\";a:5:{s:7:\\\\\\\"enabled\\\\\\\";i:0;s:9:\\\\\\\"collectip\\\\\\\";a:0:{}s:7:\\\\\\\"beginip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:5:\\\\\\\"endip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:9:\\\\\\\"ruleoutip\\\\\\\";a:0:{}}}\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\');
REPLACE INTO `p8_cms_item_photo_` VALUES ('1353','photo','824','1','admin','校园风景','','0','','<!--#p8_attach#-->/cms/item/2020_04/11_23/7a4d91ded59ea744.jpg.thumb.jpg','','','6','校园风景2','','','','','','1','admin168.','0','1523460314','1586618716','1523460314','1586618716','1','','','0','0','0','','','','a:2:{i:0;s:145:\\\"a:1:{s:8:\\\\\\\"allow_ip\\\\\\\";a:5:{s:7:\\\\\\\"enabled\\\\\\\";i:0;s:9:\\\\\\\"collectip\\\\\\\";a:0:{}s:7:\\\\\\\"beginip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:5:\\\\\\\"endip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:9:\\\\\\\"ruleoutip\\\\\\\";a:0:{}}}\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\');
REPLACE INTO `p8_cms_item_photo_` VALUES ('1354','photo','824','1','admin','校园一角','','0','','<!--#p8_attach#-->/cms/item/2020_04/11_23/4ee29edc3681e5ce.jpg.cthumb.jpg','','','6','校园一角2','','','','','','1','admin168.','0','1523460314','1586618716','1523460314','1586618716','1','','','1','0','0','','','','a:2:{i:0;s:145:\\\"a:1:{s:8:\\\\\\\"allow_ip\\\\\\\";a:5:{s:7:\\\\\\\"enabled\\\\\\\";i:0;s:9:\\\\\\\"collectip\\\\\\\";a:0:{}s:7:\\\\\\\"beginip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:5:\\\\\\\"endip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:9:\\\\\\\"ruleoutip\\\\\\\";a:0:{}}}\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\');
REPLACE INTO `p8_cms_item_photo_` VALUES ('1355','photo','824','1','admin','教学楼','','0','','<!--#p8_attach#-->/cms/item/2020_04/11_22/6f02fe967e5282df.jpg.thumb.jpg','','','6','教学楼2','','','','','','1','admin168.','0','1523460314','1586618716','1523460314','1586618716','1','','','9','0','0','','','','a:2:{i:0;s:145:\\\"a:1:{s:8:\\\\\\\"allow_ip\\\\\\\";a:5:{s:7:\\\\\\\"enabled\\\\\\\";i:0;s:9:\\\\\\\"collectip\\\\\\\";a:0:{}s:7:\\\\\\\"beginip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:5:\\\\\\\"endip\\\\\\\";s:0:\\\\\\\"\\\\\\\";s:9:\\\\\\\"ruleoutip\\\\\\\";a:0:{}}}\\\";s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\');
REPLACE INTO `p8_cms_item_photo_addon` VALUES ('1','1196','1','','<!--#p8_attach#-->/cms/item/2020_04/11_23/23dad8ddda2ae9d8.jpg.thumb.jpg','校园风景介绍','113.247.22.86','113.247.23.222','1469764448','<p>校园风景介绍</p>\r\n','5.jpg<!--#p8_attach#-->/cms/item/2020_04/11_23/23dad8ddda2ae9d8.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2020_04/11_23/23dad8ddda2ae9d8.jpg.thumb.jpg');
REPLACE INTO `p8_cms_item_photo_addon` VALUES ('2','1197','1','','<!--#p8_attach#-->/cms/item/2020_04/11_23/7a4d91ded59ea744.jpg.thumb.jpg','校园风景2','113.247.22.86','113.247.23.222','1469764448','&nbsp;校园风景2','3.png<!--#p8_attach#-->/cms/item/2020_04/11_23/7a4d91ded59ea744.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2020_04/11_23/7a4d91ded59ea744.jpg.thumb.jpg');
REPLACE INTO `p8_cms_item_photo_addon` VALUES ('3','1198','1','','<!--#p8_attach#-->/cms/item/2020_04/11_23/4ee29edc3681e5ce.jpg.cthumb.jpg','校园一角2','113.247.22.86','113.247.23.222','1469764448','&nbsp;校园一角2','2.png<!--#p8_attach#-->/cms/item/2020_04/11_23/4ee29edc3681e5ce.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2020_04/11_23/4ee29edc3681e5ce.jpg.thumb.jpg教学楼<!--#p8_attach#-->/cms/item/2020_04/11_22/d48db809fd837e12.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2020_04/11_22/6f02fe967e5282df.jpg.thumb.jpg');
REPLACE INTO `p8_cms_item_photo_addon` VALUES ('4','1199','1','','<!--#p8_attach#-->/cms/item/2020_04/11_22/6f02fe967e5282df.jpg.thumb.jpg','教学楼2','113.247.22.86','113.247.23.222','1469764448','&nbsp;教学楼2','美丽的校园风光1<!--#p8_attach#-->/cms/item/2020_04/11_22/d48db809fd837e12.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2020_04/11_22/d48db809fd837e12.jpg.thumb.jpg教学楼<!--#p8_attach#-->/cms/item/2020_04/11_22/6f02fe967e5282df.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2020_04/11_22/6f02fe967e5282df.jpg.thumb.jpg');
REPLACE INTO `p8_cms_item_photo_addon` VALUES ('5','1352','1','','<!--#p8_attach#-->/cms/item/2020_04/11_23/23dad8ddda2ae9d8.jpg.thumb.jpg','校园风景介绍','113.247.23.222','113.247.23.222','1523460314','<p>校园风景介绍</p>\r\n','5.jpg<!--#p8_attach#-->/cms/item/2020_04/11_23/23dad8ddda2ae9d8.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2020_04/11_23/23dad8ddda2ae9d8.jpg.thumb.jpg');
REPLACE INTO `p8_cms_item_photo_addon` VALUES ('6','1353','1','','<!--#p8_attach#-->/cms/item/2020_04/11_23/7a4d91ded59ea744.jpg.thumb.jpg','校园风景2','113.247.23.222','113.247.23.222','1523460314','&nbsp;校园风景2','3.png<!--#p8_attach#-->/cms/item/2020_04/11_23/7a4d91ded59ea744.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2020_04/11_23/7a4d91ded59ea744.jpg.thumb.jpg');
REPLACE INTO `p8_cms_item_photo_addon` VALUES ('7','1354','1','','<!--#p8_attach#-->/cms/item/2020_04/11_23/4ee29edc3681e5ce.jpg.cthumb.jpg','校园一角2','113.247.23.222','113.247.23.222','1523460314','&nbsp;校园一角2','2.png<!--#p8_attach#-->/cms/item/2020_04/11_23/4ee29edc3681e5ce.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2020_04/11_23/4ee29edc3681e5ce.jpg.thumb.jpg教学楼<!--#p8_attach#-->/cms/item/2020_04/11_22/d48db809fd837e12.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2020_04/11_22/6f02fe967e5282df.jpg.thumb.jpg');
REPLACE INTO `p8_cms_item_photo_addon` VALUES ('8','1355','1','','<!--#p8_attach#-->/cms/item/2020_04/11_22/6f02fe967e5282df.jpg.thumb.jpg','教学楼2','113.247.23.222','113.247.23.222','1523460314','&nbsp;教学楼2','美丽的校园风光1<!--#p8_attach#-->/cms/item/2020_04/11_22/d48db809fd837e12.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2020_04/11_22/d48db809fd837e12.jpg.thumb.jpg教学楼<!--#p8_attach#-->/cms/item/2020_04/11_22/6f02fe967e5282df.jpg.cthumb.jpg<!--#p8_attach#-->/cms/item/2020_04/11_22/6f02fe967e5282df.jpg.thumb.jpg');
REPLACE INTO `p8_cms_item_tag` VALUES ('1','我和我的祖国”全校师生大合唱比赛开赛我和','1','0','0');
REPLACE INTO `p8_cms_item_video_` VALUES ('1187','video','884','1','admin','麻省理工学院：算法导论','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_14/c7dbb3c44f1a9192.jpg','','','3,6','麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工','','','','','','1','admin5','0','1468392451','1501138051','1468392451','1582729273','1','','','57','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_video_` VALUES ('1188','video','884','1','admin','操作系统','','0','','<!--#p8_attach#-->/cms/item/2020_02/27_11/845ff247925b3cf5.jpg','','','6','操作系统（Operating System，简称OS）是管理和控制计算机硬件与软件资源的计算机程序，是直接运行在“裸机”上的最基本的系统软件，任何其他软件都必须在操作系统的支持下才能运行。操作系统是用户和计算机的接口，同时也是计算机硬件和其他软件的接口。操作','','','','','','1','admin168.','0','1469548800','1501138108','1469548800','1582773560','1','','','41','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_video_` VALUES ('1189','video','884','1','admin','计算机组原理','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_14/d9e66c4bd1e07169.jpg','','','6','课程在以培养学生创新能力和解决实际问题的能力为主的思想指导下，形成了由理论课、实验课、计算机设计与实践构成的课程体系。使学生系统地理解计算机硬件系统的组织结构和工作原理，掌握计算机硬件系统的基本分析与设计方法，建立计算机系统的整体概念。','','','','','','1','admin5','0','1469548800','1501138259','1469548800','1582729305','1','','','27','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_video_` VALUES ('1190','video','884','1','admin','计算机网络','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_14/f7afd5ca201141d8.jpg','','','6','计算机网络也称计算机通信网。关于计算机网络的最简单定义是：一些相互连接的、以共享资源为目的的、自治的计算机的集合。若按此定义，则早期的面向终端的网络都不能算是计算机网络，而只能称为联机系统（因为那时的许多终端不能算是自治的计算机）。但随着硬件价格的下','','','','','','1','admin5','0','1469548800','1501138328','1469548800','1582729322','1','','','17','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_video_` VALUES ('1191','video','884','1','admin','数据结构基础','','0','','<!--#p8_attach#-->/cms/item/2017_07/27_14/37ef06e9c33d0eee.jpg','','','6','数据结构','','','','','','1','admin5','0','1469548800','1501138426','1469548800','1582729335','1','','','31','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_video_` VALUES ('1320','video','884','1','admin168.','放飞梦想勇敢追逐青春的梦想','','0','','<!--#p8_attach#-->/cms/item/2020_02/26_22/08dbf0db2ae25eec.jpg','','','','放飞梦想勇敢追逐青春的梦想放飞梦想勇敢追逐青春的梦想放飞梦想勇敢追逐青春的梦想','','','','','','1','admin5','0','1579082560','1579082560','1579082560','1582729199','1','','','33','0','0','','','','a:1:{s:8:\\\"allow_ip\\\";a:5:{s:7:\\\"enabled\\\";i:0;s:9:\\\"collectip\\\";a:0:{}s:7:\\\"beginip\\\";s:0:\\\"\\\";s:5:\\\"endip\\\";s:0:\\\"\\\";s:9:\\\"ruleoutip\\\";a:0:{}}}');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('1','1187','1','','<!--#p8_attach#-->/cms/item/2017_07/27_14/c7dbb3c44f1a9192.jpg','麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工','113.246.94.58','113.247.22.80','1468392451','麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理工学院：算法导论麻省理','390','<!--#p8_attach#-->/cms/item/2020_02/26_22/858bb21f8623485d.mp4','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('2','1188','1','','<!--#p8_attach#-->/cms/item/2020_02/27_11/845ff247925b3cf5.jpg','操作系统（Operating System，简称OS）是管理和控制计算机硬件与软件资源的计算机程序，是直接运行在“裸机”上的最基本的系统软件，任何其他软件都必须在操作系统的支持下才能运行。操作系统是用户和计算机的接口，同时也是计算机硬件和其他软件的接口。操作','113.246.94.58','113.247.20.49','1469548800','<div class=\"para\" label-module=\"para\" style=\"font-size: 14px; word-wrap: break-word; margin-bottom: 15px; font-family: arial, 宋体, sans-serif; zoom: 1; color: rgb(51,51,51); line-height: 24px; background-color: rgb(255,255,255); text-indent: 28px\"><a data-lemmaid=\"192\" href=\"https://baike.baidu.com/item/%E6%93%8D%E4%BD%9C%E7%B3%BB%E7%BB%9F/192\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">操作系统</a>（<a href=\"https://baike.baidu.com/item/Operating%20System\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">Operating System</a>，简称OS）是管理和控制<a href=\"https://baike.baidu.com/item/%E8%AE%A1%E7%AE%97%E6%9C%BA\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">计算机</a><a href=\"https://baike.baidu.com/item/%E7%A1%AC%E4%BB%B6\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">硬件</a>与<a data-lemmaid=\"12053\" href=\"https://baike.baidu.com/item/%E8%BD%AF%E4%BB%B6/12053\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">软件</a>资源的<a href=\"https://baike.baidu.com/item/%E8%AE%A1%E7%AE%97%E6%9C%BA\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">计算机</a>程序，是直接运行在&ldquo;<a href=\"https://baike.baidu.com/item/%E8%A3%B8%E6%9C%BA\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">裸机</a>&rdquo;上的最基本的<a href=\"https://baike.baidu.com/item/%E7%B3%BB%E7%BB%9F%E8%BD%AF%E4%BB%B6\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">系统软件</a>，任何其他软件都必须在<a data-lemmaid=\"192\" href=\"https://baike.baidu.com/item/%E6%93%8D%E4%BD%9C%E7%B3%BB%E7%BB%9F/192\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">操作系统</a>的支持下才能运行。</div>\r\n\r\n<div class=\"para\" label-module=\"para\" style=\"font-size: 14px; word-wrap: break-word; margin-bottom: 15px; font-family: arial, 宋体, sans-serif; zoom: 1; color: rgb(51,51,51); line-height: 24px; background-color: rgb(255,255,255); text-indent: 28px\">操作系统是<a href=\"https://baike.baidu.com/item/%E7%94%A8%E6%88%B7\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">用户</a>和<a href=\"https://baike.baidu.com/item/%E8%AE%A1%E7%AE%97%E6%9C%BA\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">计算机</a>的<a href=\"https://baike.baidu.com/item/%E6%8E%A5%E5%8F%A3\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">接口</a>，同时也是计算机<a href=\"https://baike.baidu.com/item/%E7%A1%AC%E4%BB%B6\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">硬件</a>和其他<a data-lemmaid=\"12053\" href=\"https://baike.baidu.com/item/%E8%BD%AF%E4%BB%B6/12053\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">软件</a>的接口。<a data-lemmaid=\"192\" href=\"https://baike.baidu.com/item/%E6%93%8D%E4%BD%9C%E7%B3%BB%E7%BB%9F/192\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">操作系统</a>的功能包括管理<a href=\"https://baike.baidu.com/item/%E8%AE%A1%E7%AE%97%E6%9C%BA%E7%B3%BB%E7%BB%9F\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">计算机系统</a>的<a href=\"https://baike.baidu.com/item/%E7%A1%AC%E4%BB%B6\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">硬件</a>、软件及数据资源，<a href=\"https://baike.baidu.com/item/%E6%8E%A7%E5%88%B6\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">控制</a>程序运行，改善<a href=\"https://baike.baidu.com/item/%E4%BA%BA%E6%9C%BA%E7%95%8C%E9%9D%A2\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">人机界面</a>，为其它<a href=\"https://baike.baidu.com/item/%E5%BA%94%E7%94%A8%E8%BD%AF%E4%BB%B6\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">应用软件</a>提供支持，让<a href=\"https://baike.baidu.com/item/%E8%AE%A1%E7%AE%97%E6%9C%BA%E7%B3%BB%E7%BB%9F\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">计算机系统</a>所有资源最大限度地发挥作用，提供各种形式的<a href=\"https://baike.baidu.com/item/%E7%94%A8%E6%88%B7%E7%95%8C%E9%9D%A2\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">用户界面</a>，使用户有一个好的工作环境，为其它软件的开发提供必要的服务和相应的接口等。实际上，用户是不用接触操作系统的，操作系统管理着<a href=\"https://baike.baidu.com/item/%E8%AE%A1%E7%AE%97%E6%9C%BA%E7%A1%AC%E4%BB%B6\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">计算机硬件</a>资源，同时按照<a href=\"https://baike.baidu.com/item/%E5%BA%94%E7%94%A8%E7%A8%8B%E5%BA%8F\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">应用程序</a>的资源请求，分配资源，如：划分<a href=\"https://baike.baidu.com/item/CPU\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">CPU</a>时间，<a href=\"https://baike.baidu.com/item/%E5%86%85%E5%AD%98\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">内存</a>空间的开辟，调用<a href=\"https://baike.baidu.com/item/%E6%89%93%E5%8D%B0%E6%9C%BA\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">打印机</a>等。</div>\r\n','390','<!--#p8_attach#-->/cms/item/2020_02/26_22/858bb21f8623485d.mp4','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('3','1189','1','','<!--#p8_attach#-->/cms/item/2017_07/27_14/d9e66c4bd1e07169.jpg','课程在以培养学生创新能力和解决实际问题的能力为主的思想指导下，形成了由理论课、实验课、计算机设计与实践构成的课程体系。使学生系统地理解计算机硬件系统的组织结构和工作原理，掌握计算机硬件系统的基本分析与设计方法，建立计算机系统的整体概念。','113.246.94.58','113.247.22.80','1469548800','<span style=\"color: rgb(102,102,102)\">课程在以培养学生创新能力和解决实际问题的能力为主的思想指导下，形成了由理论课、实验课、计算机设计与实践构成的课程体系。使学生系统地理解计算机硬件系统的组织结构和工作原理，掌握计算机硬件系统的基本分析与设计方法，建立计算机系统的整体概念。</span>','390','<!--#p8_attach#-->/cms/item/2020_02/26_22/858bb21f8623485d.mp4','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('4','1190','1','','<!--#p8_attach#-->/cms/item/2017_07/27_14/f7afd5ca201141d8.jpg','计算机网络也称计算机通信网。关于计算机网络的最简单定义是：一些相互连接的、以共享资源为目的的、自治的计算机的集合。若按此定义，则早期的面向终端的网络都不能算是计算机网络，而只能称为联机系统（因为那时的许多终端不能算是自治的计算机）。但随着硬件价格的下','113.246.94.58','113.247.22.80','1469548800','<div class=\"para\" label-module=\"para\" style=\"font-size: 14px; word-wrap: break-word; margin-bottom: 15px; font-family: arial, 宋体, sans-serif; zoom: 1; color: rgb(51,51,51); line-height: 24px; background-color: rgb(255,255,255); text-indent: 2em\">计算机网络也称计算机通信网。关于<a href=\"https://baike.baidu.com/item/%E8%AE%A1%E7%AE%97%E6%9C%BA\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">计算机</a>网络的最简单定义是：一些相互连接的、以<a href=\"https://baike.baidu.com/item/%E5%85%B1%E4%BA%AB%E8%B5%84%E6%BA%90\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">共享资源</a>为目的的、自治的计算机的集合。若按此定义，则早期的面向终端的网络都不能算是计算机网络，而只能称为联机系统（因为那时的许多终端不能算是自治的计算机）。但随着硬件价格的下降，许多终端都具有一定的智能，因而&ldquo;终端&rdquo;和&ldquo;自治的计算机&rdquo;逐渐失去了严格的界限。若用微型计算机作为终端使用，按上述定义，则早期的那种面向终端的网络也可称为计算机网络。</div>\r\n\r\n<div class=\"para\" label-module=\"para\" style=\"font-size: 14px; word-wrap: break-word; margin-bottom: 15px; font-family: arial, 宋体, sans-serif; zoom: 1; color: rgb(51,51,51); line-height: 24px; background-color: rgb(255,255,255); text-indent: 2em\">另外，从<a href=\"https://baike.baidu.com/item/%E9%80%BB%E8%BE%91\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">逻辑</a>功能上看，<a href=\"https://baike.baidu.com/item/%E8%AE%A1%E7%AE%97%E6%9C%BA%E7%BD%91%E7%BB%9C\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">计算机网络</a>是以传输信息为<a href=\"https://baike.baidu.com/item/%E5%9F%BA%E7%A1%80\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">基础</a>目的，用<a href=\"https://baike.baidu.com/item/%E9%80%9A%E4%BF%A1%E7%BA%BF%E8%B7%AF\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">通信线路</a>将多个计算机连接起来的计算机系统的集合，一个计算机网络组成包括<a href=\"https://baike.baidu.com/item/%E4%BC%A0%E8%BE%93%E4%BB%8B%E8%B4%A8\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">传输介质</a>和<a href=\"https://baike.baidu.com/item/%E9%80%9A%E4%BF%A1%E8%AE%BE%E5%A4%87\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">通信设备</a>。</div>\r\n\r\n<div class=\"para\" label-module=\"para\" style=\"font-size: 14px; word-wrap: break-word; margin-bottom: 15px; font-family: arial, 宋体, sans-serif; zoom: 1; color: rgb(51,51,51); line-height: 24px; background-color: rgb(255,255,255); text-indent: 2em\">从用户角度看，计算机网络是这样定义的：存在着一个能为用户自动管理的网络<a href=\"https://baike.baidu.com/item/%E6%93%8D%E4%BD%9C%E7%B3%BB%E7%BB%9F\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">操作系统</a>。由它调用完成用户所调用的资源，而整个网络像一个大的计算机系统一样，对<a href=\"https://baike.baidu.com/item/%E7%94%A8%E6%88%B7\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">用户</a>是透明的。</div>\r\n\r\n<div class=\"para\" label-module=\"para\" style=\"font-size: 14px; word-wrap: break-word; margin-bottom: 15px; font-family: arial, 宋体, sans-serif; zoom: 1; color: rgb(51,51,51); line-height: 24px; background-color: rgb(255,255,255); text-indent: 2em\">一个比较通用的定义是：利用<a href=\"https://baike.baidu.com/item/%E9%80%9A%E4%BF%A1%E7%BA%BF%E8%B7%AF\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">通信线路</a>将地理上分散的、具有独立功能的<a href=\"https://baike.baidu.com/item/%E8%AE%A1%E7%AE%97%E6%9C%BA%E7%B3%BB%E7%BB%9F\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">计算机系统</a>和通信设备按不同的形式连接起来，以功能完善的网络软件及协议实现资源共享和信息传递的系统。</div>\r\n\r\n<div class=\"para\" label-module=\"para\" style=\"font-size: 14px; word-wrap: break-word; margin-bottom: 15px; font-family: arial, 宋体, sans-serif; zoom: 1; color: rgb(51,51,51); line-height: 24px; background-color: rgb(255,255,255); text-indent: 2em\">从整体上来说计算机网络就是把分布在不同地理区域的计算机与专门的外部设备用通信线路互联成一个规模大、功能强的系统，从而使众多的计算机可以方便地互相传递信息，共享<a href=\"https://baike.baidu.com/item/%E7%A1%AC%E4%BB%B6\" style=\"color: rgb(19,110,194); text-decoration-line: none\" target=\"_blank\">硬件</a>、软件、数据信息等资源。简单来说，计算机网络就是由通信线路互相连接的许多自主工作的计算机构成的集合体。</div>\r\n\r\n<div class=\"para\" label-module=\"para\" style=\"font-size: 14px; word-wrap: break-word; margin-bottom: 15px; font-family: arial, 宋体, sans-serif; zoom: 1; color: rgb(51,51,51); line-height: 24px; background-color: rgb(255,255,255); text-indent: 2em\">最简单的计算机网络就只有两台计算机和连接它们的一条链路，即两个节点和一条链路。</div>\r\n','390','<!--#p8_attach#-->/cms/item/2020_02/26_22/858bb21f8623485d.mp4','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('5','1191','1','','<!--#p8_attach#-->/cms/item/2017_07/27_14/37ef06e9c33d0eee.jpg','数据结构','113.246.94.58','113.247.22.80','1469548800','<span style=\"font-size: 12px; font-family: Simsun; color: rgb(67,67,67); widows: 1; background-color: rgb(255,255,255)\">《数据结构》课程简介 课程名称（中英文）学时学分先修课程数据结构684程序设计课程简介： 数据结构是计算机专业本科最基础、最重要的课程之一。 本课程以数据的逻辑关系为线索，介绍了线性关系、树状关系、集合关系和图型关系的数据元素的存储及处理方法、每个数据结构对应的类的C++实现、以及每个数据结构的主要应用，同时还讲解了算法设计和分析的基本知识。</span>','390','<!--#p8_attach#-->/cms/item/2020_02/26_22/858bb21f8623485d.mp4','450');
REPLACE INTO `p8_cms_item_video_addon` VALUES ('6','1320','1','','<!--#p8_attach#-->/cms/item/2020_02/26_22/08dbf0db2ae25eec.jpg','放飞梦想勇敢追逐青春的梦想放飞梦想勇敢追逐青春的梦想放飞梦想勇敢追逐青春的梦想','113.246.111.251','113.247.22.80','1579082560','放飞梦想勇敢追逐青春的梦想放飞梦想勇敢追逐青春的梦想放飞梦想勇敢追逐青春的梦想','390','<!--#p8_attach#-->/cms/item/2020_02/26_22/858bb21f8623485d.mp4','450');
REPLACE INTO `p8_cms_model` VALUES ('1','article','文章内容','30','1','a:7:{s:14:\"prev&next_item\";s:1:\"1\";s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('2','product','产品','0','0','a:7:{s:14:\"prev&next_item\";s:1:\"1\";s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('3','photo','图片内容','20','1','a:7:{s:14:\"prev&next_item\";s:1:\"1\";s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:3:\"900\";s:20:\"content_thumb_height\";s:3:\"700\";}');
REPLACE INTO `p8_cms_model` VALUES ('9','govopen','信息公开','0','0','a:7:{s:14:\"prev&next_item\";s:1:\"1\";s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('6','people','人物','0','0','a:7:{s:14:\"prev&next_item\";s:1:\"1\";s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('4','video','视频内容','16','1','a:6:{s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:3:\"120\";s:18:\"frame_thumb_height\";s:2:\"90\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('5','down','下载内容','14','1','a:9:{s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";s:11:\"hidedownurl\";s:1:\"0\";s:9:\"thunderid\";s:0:\"\";s:10:\"flashgetid\";s:0:\"\";}');
REPLACE INTO `p8_cms_model` VALUES ('10','page','单网页','26','1','a:6:{s:19:\"admin_edit_template\";s:0:\"\";s:20:\"member_edit_template\";s:0:\"\";s:17:\"frame_thumb_width\";s:0:\"\";s:18:\"frame_thumb_height\";s:0:\"\";s:19:\"content_thumb_width\";s:0:\"\";s:20:\"content_thumb_height\";s:0:\"\";}');
REPLACE INTO `p8_cms_model_field` VALUES ('1','article','0','content','内容','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor','','99','','');
REPLACE INTO `p8_cms_model_field` VALUES ('8','photo','0','content','内容','mediumtext','0','0','0','0','','0','1','','a:0:{}','a:0:{}','editor','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('3','product','0','aboutinfo','试用与预订','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor_common','','9','','');
REPLACE INTO `p8_cms_model_field` VALUES ('4','product','0','attrbutes','产品参数','text','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor_basic','','88','','');
REPLACE INTO `p8_cms_model_field` VALUES ('5','product','0','content','产品介绍','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor_common','','99','','');
REPLACE INTO `p8_cms_model_field` VALUES ('6','product','0','pics','图片欣赏','text','0','0','0','1','','0','1','','a:0:{}','a:0:{}','multi_uploader','','6','','');
REPLACE INTO `p8_cms_model_field` VALUES ('7','product','0','pro_down','相关下载','varchar','0','0','0','0','255','0','1','','a:0:{}','a:0:{}','uploader','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('9','photo','0','photourl','图片地址','text','0','0','0','1','','0','1','','a:0:{}','a:0:{}','multi_uploader','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('21','down','0','totaldown','总下载量','mediumint','0','0','0','1','5','0','0','','a:0:{}','a:0:{}','text','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('28','people','0','education','学历','varchar','0','0','0','1','255','0','1','','a:0:{}','a:0:{}','text','','6','','');
REPLACE INTO `p8_cms_model_field` VALUES ('50','govopen','0','geshi','格式','tinyint','1','1','0','1','3','0','1','','a:7:{i:1;s:3:\"DOC\";i:2;s:3:\"TXT\";i:3;s:3:\"JPG\";i:4;s:3:\"PDF\";i:5;s:3:\"MP3\";i:6;s:4:\"MPEG\";i:7;s:4:\"其它\";}','a:0:{}','select','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('19','down','0','softsize','资源大小','varchar','0','0','0','1','10','0','1','','a:0:{}','a:0:{}','text','','55','K','');
REPLACE INTO `p8_cms_model_field` VALUES ('20','down','0','softurl','资源地址','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','uploader','','44','','');
REPLACE INTO `p8_cms_model_field` VALUES ('24','people','0','award','获奖荣誉','mediumtext','0','0','0','0','','0','1','','a:0:{}','a:0:{}','editor_common','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('34','people','0','photo','照片','text','0','0','0','1','','0','1','','a:0:{}','a:0:{}','image_uploader','','3','','照片大小：148*220');
REPLACE INTO `p8_cms_model_field` VALUES ('30','people','0','Hometown','籍贯','varchar','0','0','0','1','255','0','1','','a:0:{}','a:0:{}','text','','8','','');
REPLACE INTO `p8_cms_model_field` VALUES ('31','people','0','motion','企业提案','mediumtext','0','0','0','0','','0','1','','a:0:{}','a:0:{}','editor_common','','1','','');
REPLACE INTO `p8_cms_model_field` VALUES ('33','people','0','office','职务','varchar','0','0','0','1','255','0','1','','a:0:{}','a:0:{}','text','','4','','');
REPLACE INTO `p8_cms_model_field` VALUES ('32','people','0','name','姓名','varchar','1','1','1','1','255','0','1','','a:0:{}','a:0:{}','text','','9','','');
REPLACE INTO `p8_cms_model_field` VALUES ('49','govopen','0','duixiang','对象','tinyint','1','1','0','1','3','0','1','','a:3:{i:1;s:4:\"学生\";i:2;s:4:\"老师\";i:9;s:4:\"其它\";}','a:0:{}','select','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('14','down','0','content','资源介绍','mediumtext','0','0','0','1','','0','1','','a:0:{}','a:0:{}','editor','','33','','');
REPLACE INTO `p8_cms_model_field` VALUES ('51','govopen','0','jigou','机构分类','tinyint','1','1','0','1','3','0','1','','a:11:{i:1;s:16:\"广州市天河区政府\";i:2;s:16:\"广州市越秀区政府\";i:3;s:16:\"广州市东山区政府\";i:4;s:16:\"广州市白云区政府\";i:5;s:16:\"广州市黄埔区政府\";i:6;s:16:\"广州市花都区政府\";i:7;s:16:\"广州市海珠区政府\";i:8;s:16:\"广州市南沙区政府\";i:9;s:16:\"广州市荔湾区政府\";i:10;s:16:\"广州市番禺区政府\";i:11;s:16:\"广州市萝岗区政府\";}','a:0:{}','select','','0','','');
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
REPLACE INTO `p8_cms_model_field` VALUES ('52','govopen','0','shengming','生命周期','tinyint','1','1','0','1','3','0','1','','a:5:{i:1;s:6:\"婴幼儿\";i:2;s:6:\"青少年\";i:3;s:4:\"中年\";i:4;s:4:\"老年\";i:5;s:4:\"其它\";}','a:0:{}','select','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('53','govopen','0','suoyin','索引号','varchar','1','0','0','1','255','0','1','','a:0:{}','a:0:{}','text','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('54','govopen','0','ticai','体裁','tinyint','1','1','0','1','3','0','1','','a:14:{i:1;s:4:\"命令\";i:2;s:4:\"决定\";i:3;s:4:\"通告\";i:4;s:4:\"通知\";i:5;s:4:\"公告\";i:6;s:4:\"通报\";i:7;s:4:\"议案\";i:8;s:4:\"报告\";i:9;s:4:\"请示\";i:10;s:4:\"批复\";i:11;s:4:\"意见\";i:12;s:2:\"函\";i:13;s:8:\"会议纪要\";i:14;s:4:\"其它\";}','a:0:{}','select','','0','','');
REPLACE INTO `p8_cms_model_field` VALUES ('58','page','0','content','','mediumtext','0','0','0','1','0','0','1','','a:0:{}','a:0:{}','editor','','99','','');
REPLACE INTO `p8_config` VALUES ('cms','','string','template','school795');
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
REPLACE INTO `p8_config` VALUES ('cms','item','string','template','school795');
REPLACE INTO `p8_config` VALUES ('cms','item','string','htmlize','1');
REPLACE INTO `p8_config` VALUES ('cms','item','serialize','verify_acl','a:5:{i:2;a:2:{s:4:\"name\";s:6:\"初审\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}i:1;a:2:{s:4:\"name\";s:6:\"终审\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}i:0;a:2:{s:4:\"name\";s:12:\"取消审核\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}i:88;a:2:{s:4:\"name\";s:9:\"回收站\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}i:-99;a:2:{s:4:\"name\";s:6:\"退稿\";s:4:\"role\";a:1:{i:1;s:1:\"1\";}}}');
REPLACE INTO `p8_config` VALUES ('cms','','string','base_domain','');
REPLACE INTO `p8_config` VALUES ('cms','','string','domain','');
REPLACE INTO `p8_config` VALUES ('cms','','string','index_page_cache_ttl','0');
REPLACE INTO `p8_config` VALUES ('cms','','string','table_prefix','');
REPLACE INTO `p8_config` VALUES ('cms','item','serialize','attribute_acl','a:10:{i:1;a:2:{i:6;i:1;i:1;i:1;}i:2;a:2:{i:6;i:1;i:1;i:1;}i:3;a:2:{i:6;i:1;i:1;i:1;}i:4;a:2:{i:6;i:1;i:1;i:1;}i:5;a:2:{i:6;i:1;i:1;i:1;}i:6;a:2:{i:6;i:1;i:1;i:1;}i:7;a:2:{i:6;i:1;i:1;i:1;}i:8;a:2:{i:6;i:1;i:1;i:1;}i:9;a:2:{i:6;i:1;i:1;i:1;}i:10;a:2:{i:6;i:1;i:1;i:1;}}');
REPLACE INTO `p8_config` VALUES ('cms','item','string','list_page_cache_ttl','0');
REPLACE INTO `p8_config` VALUES ('cms','item','string','mobile_template','mobile/school');
REPLACE INTO `p8_config` VALUES ('cms','item','string','view_page_cache_ttl','0');
REPLACE INTO `p8_config` VALUES ('cms','item','string','authority','0');