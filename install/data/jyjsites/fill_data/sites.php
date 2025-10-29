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
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8
/*!50100 PARTITION BY HASH (uid)
PARTITIONS 10 */;

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
) ENGINE=MyISAM AUTO_INCREMENT=13370 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=12938 DEFAULT CHARSET=utf8;

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
  `url` varchar(1000) NOT NULL DEFAULT '',
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
) ENGINE=MyISAM AUTO_INCREMENT=4130 DEFAULT CHARSET=utf8
/*!50100 PARTITION BY KEY (id)
PARTITIONS 10 */;

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
  `url` varchar(1000) NOT NULL DEFAULT '',
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
  `site` varchar(50) NOT NULL DEFAULT '',
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
  `url` varchar(1000) NOT NULL DEFAULT '',
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
  `page` smallint(5) unsigned NOT NULL,
  `addon_title` varchar(40) NOT NULL DEFAULT '',
  `addon_frame` varchar(100) NOT NULL DEFAULT '',
  `addon_summary` varchar(180) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `site` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM AUTO_INCREMENT=2545 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

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
  `url` varchar(1000) NOT NULL DEFAULT '',
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
  `site` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

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
  `url` varchar(1000) NOT NULL DEFAULT '',
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
  `page` smallint(5) unsigned NOT NULL,
  `addon_title` varchar(40) NOT NULL DEFAULT '',
  `addon_frame` varchar(100) NOT NULL DEFAULT '',
  `addon_summary` varchar(180) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `xinxifenlei` varchar(50) NOT NULL,
  `site` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_kjih_`;
CREATE TABLE `p8_sites_item_kjih_` (
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
  `url` varchar(1000) NOT NULL DEFAULT '',
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

DROP TABLE IF EXISTS `p8_sites_item_kjih_addon`;
CREATE TABLE `p8_sites_item_kjih_addon` (
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

DROP TABLE IF EXISTS `p8_sites_item_mood`;
CREATE TABLE `p8_sites_item_mood` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL DEFAULT '',
  `image` char(20) NOT NULL DEFAULT '',
  `display_order` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`)
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
  `url` varchar(1000) NOT NULL DEFAULT '',
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
  `page` smallint(5) unsigned NOT NULL,
  `addon_title` varchar(40) NOT NULL DEFAULT '',
  `addon_frame` varchar(100) NOT NULL DEFAULT '',
  `addon_summary` varchar(180) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `site` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM AUTO_INCREMENT=759 DEFAULT CHARSET=utf8;

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
  `url` varchar(1000) NOT NULL DEFAULT '',
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
  `page` smallint(5) unsigned NOT NULL,
  `addon_title` varchar(40) NOT NULL DEFAULT '',
  `addon_frame` varchar(100) NOT NULL DEFAULT '',
  `addon_summary` varchar(180) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `site` varchar(50) NOT NULL DEFAULT '',
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
  `url` varchar(1000) NOT NULL DEFAULT '',
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
  `page` smallint(5) unsigned NOT NULL,
  `addon_title` varchar(40) NOT NULL DEFAULT '',
  `addon_frame` varchar(100) NOT NULL DEFAULT '',
  `addon_summary` varchar(180) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext,
  `photourl` text NOT NULL,
  `site` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM AUTO_INCREMENT=160 DEFAULT CHARSET=utf8;

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
  `url` varchar(1000) NOT NULL DEFAULT '',
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
  `site` varchar(50) NOT NULL DEFAULT '',
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8
/*!50100 PARTITION BY KEY (id)
PARTITIONS 10 */;

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
  `url` varchar(1000) NOT NULL DEFAULT '',
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
  `site` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM AUTO_INCREMENT=510 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_letter_data`;
CREATE TABLE `p8_sites_letter_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL DEFAULT '0',
  `level` tinyint(1) NOT NULL DEFAULT '0',
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
  `site` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_letter_item`;
CREATE TABLE `p8_sites_letter_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` smallint(5) NOT NULL,
  `type` tinyint(3) NOT NULL,
  `site` varchar(20) NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=222 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=6816 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=136 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `p8_sites_stop_category`;
CREATE TABLE `p8_sites_stop_category` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parent` smallint(5) unsigned NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `item_count` mediumint(8) unsigned NOT NULL,
  `display_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_stop_data`;
CREATE TABLE `p8_sites_stop_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` mediumint(10) unsigned NOT NULL DEFAULT '0',
  `cname` char(50) NOT NULL DEFAULT '',
  `site` char(20) NOT NULL DEFAULT '',
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
  `new_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;