-- <?php exit;?>
DROP TABLE IF EXISTS `p8_46_`;
CREATE TABLE `p8_46_` (
  `id` mediumint(7) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT '',
  `expense_type` varchar(20) NOT NULL DEFAULT '',
  `link_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `buyable` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `buy_count` smallint(5) unsigned NOT NULL DEFAULT '0',
  `credit_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `credit` smallint(5) unsigned NOT NULL DEFAULT '0',
  `width` varchar(10) NOT NULL DEFAULT '',
  `height` varchar(10) NOT NULL DEFAULT '',
  `template` varchar(50) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `show_count` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `verify` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `max_day` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `manager` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `buyable` (`buyable`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_46_buy`;
CREATE TABLE `p8_46_buy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` mediumint(7) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(7) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '0',
  `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `showing` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `credit` smallint(5) unsigned NOT NULL DEFAULT '0',
  `day` smallint(5) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `clicks` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `postfix` varchar(60) NOT NULL DEFAULT '',
  `comment` varchar(60) NOT NULL DEFAULT '',
  `display_order` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `data` text NOT NULL,
  `expire` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`,`display_order`,`timestamp`),
  KEY `aid_2` (`aid`,`showing`,`verified`,`postfix`,`expire`),
  KEY `uid` (`uid`,`timestamp`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_46_click_log`;
CREATE TABLE `p8_46_click_log` (
  `bid` int(10) unsigned NOT NULL,
  `ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `referer` char(120) NOT NULL DEFAULT '',
  KEY `bid` (`bid`,`timestamp`),
  KEY `bid_ip` (`bid`,`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_acl`;
CREATE TABLE `p8_acl` (
  `system` varchar(30) NOT NULL DEFAULT '',
  `module` varchar(50) NOT NULL DEFAULT '',
  `role_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `postfix` varchar(30) NOT NULL DEFAULT '',
  `v` text NOT NULL,
  PRIMARY KEY (`system`,`module`,`role_id`,`postfix`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_admin_log`;
CREATE TABLE `p8_admin_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL,
  `system` char(30) NOT NULL DEFAULT '',
  `module` char(30) NOT NULL DEFAULT '',
  `action` char(30) NOT NULL DEFAULT '',
  `iid` char(30) NOT NULL DEFAULT '0',
  `cid` smallint(5) NOT NULL DEFAULT '0',
  `site` char(30) NOT NULL DEFAULT '',
  `username` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(40) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `data` mediumtext NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`timestamp`)
) ENGINE=MyISAM AUTO_INCREMENT=6481 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_admin_menu`;
CREATE TABLE `p8_admin_menu` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `system` char(30) NOT NULL DEFAULT '',
  `module` char(50) NOT NULL DEFAULT '',
  `action` char(50) NOT NULL DEFAULT '',
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` char(30) NOT NULL DEFAULT '',
  `url` char(255) NOT NULL DEFAULT '',
  `target` char(10) NOT NULL DEFAULT '',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `front` tinyint(1) NOT NULL DEFAULT '0',
  `frequent` tinyint(1) NOT NULL DEFAULT '0',
  `display_order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `menu_icon` varchar(20) NOT NULL DEFAULT 'fa-codepen',
  PRIMARY KEY (`id`),
  KEY `system` (`system`,`module`)
) ENGINE=MyISAM AUTO_INCREMENT=229 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_area`;
CREATE TABLE `p8_area` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `parent` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` char(40) NOT NULL DEFAULT '',
  `display_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_attachment`;
CREATE TABLE `p8_attachment` (
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
) ENGINE=MyISAM AUTO_INCREMENT=1132 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cache`;
CREATE TABLE `p8_cache` (
  `path` varchar(30) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `id` varchar(50) NOT NULL DEFAULT '',
  `v` mediumtext NOT NULL,
  PRIMARY KEY (`path`,`name`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=689 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_category`;
CREATE TABLE `p8_cms_category` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parent` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` varchar(60) NOT NULL DEFAULT '',
  `letter` varchar(2) NOT NULL DEFAULT '',
  `model` varchar(20) NOT NULL DEFAULT '',
  `url` varchar(1000) NOT NULL DEFAULT '',
  `domain` varchar(255) NOT NULL DEFAULT '',
  `frame` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL,
  `item_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `htmlize` tinyint(1) unsigned NOT NULL DEFAULT '0',
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
) ENGINE=MyISAM AUTO_INCREMENT=1021 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_category_recycle`;
CREATE TABLE `p8_cms_category_recycle` (
  `id` mediumint(8) unsigned NOT NULL,
  `parent` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` varchar(60) NOT NULL DEFAULT '',
  `letter` varchar(2) NOT NULL DEFAULT '',
  `model` varchar(20) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `domain` varchar(255) NOT NULL DEFAULT '',
  `frame` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL,
  `item_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `htmlize` tinyint(1) unsigned NOT NULL DEFAULT '0',
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
) ENGINE=MyISAM AUTO_INCREMENT=1018 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item`;
CREATE TABLE `p8_cms_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(500) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(520) NOT NULL DEFAULT '',
  `cid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `frame` varchar(500) NOT NULL DEFAULT '',
  `url` varchar(512) NOT NULL DEFAULT '',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `username` varchar(20) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(1255) NOT NULL DEFAULT '',
  `pages` smallint(5) unsigned NOT NULL DEFAULT '1',
  `html_view_url_rule` varchar(180) NOT NULL DEFAULT '',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `score` tinyint(3) NOT NULL DEFAULT '0',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `level_time` int(10) unsigned NOT NULL DEFAULT '0',
  `source` varchar(555) NOT NULL DEFAULT '',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `verify_frame` varchar(1255) NOT NULL,
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
  `custom_a` varchar(255) NOT NULL DEFAULT '',
  `custom_b` varchar(255) NOT NULL DEFAULT '',
  `custom_c` varchar(255) NOT NULL DEFAULT '',
  `custom_d` varchar(255) NOT NULL DEFAULT '',
  `custom_e` varchar(255) NOT NULL DEFAULT '',
  `custom_f` varchar(255) NOT NULL DEFAULT '',
  `custom_g` varchar(255) NOT NULL DEFAULT '',
  `custom_h` varchar(255) NOT NULL DEFAULT '',
  `custom_i` varchar(255) NOT NULL DEFAULT '',
  `custom_j` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `timestamp` (`timestamp`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=3695 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_article_`;
CREATE TABLE `p8_cms_item_article_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(500) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(520) NOT NULL DEFAULT '',
  `frame` varchar(500) NOT NULL DEFAULT '',
  `verify_frame` varchar(555) NOT NULL DEFAULT '',
  `url` varchar(512) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(1255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(1000) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `verifier` varchar(50) NOT NULL DEFAULT '',
  `verify_time` int(10) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `list_order` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `pages` smallint(5) unsigned NOT NULL DEFAULT '1',
  `html_view_url_rule` varchar(80) NOT NULL DEFAULT '',
  `template` varchar(30) NOT NULL DEFAULT '',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `score` tinyint(3) NOT NULL DEFAULT '0',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `level_time` int(10) unsigned NOT NULL DEFAULT '0',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `seo_keywords` varchar(500) NOT NULL DEFAULT '',
  `seo_description` varchar(200) NOT NULL DEFAULT '',
  `label_postfix` varchar(50) NOT NULL DEFAULT '',
  `config` varchar(1255) NOT NULL DEFAULT '',
  `custom_a` varchar(255) NOT NULL,
  `custom_b` varchar(255) NOT NULL,
  `custom_c` varchar(255) NOT NULL,
  `custom_d` varchar(255) NOT NULL,
  `custom_e` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_article_addon`;
CREATE TABLE `p8_cms_item_article_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  `page` smallint(5) unsigned NOT NULL DEFAULT '0',
  `addon_title` varchar(240) NOT NULL DEFAULT '',
  `addon_frame` varchar(500) NOT NULL DEFAULT '',
  `addon_summary` varchar(1080) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `custom_f` varchar(255) NOT NULL,
  `custom_g` varchar(255) NOT NULL,
  `custom_h` varchar(255) NOT NULL,
  `custom_i` varchar(255) NOT NULL,
  `custom_j` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM AUTO_INCREMENT=2871 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_asd_`;
CREATE TABLE `p8_cms_item_asd_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
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
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_asd_addon`;
CREATE TABLE `p8_cms_item_asd_addon` (
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
  `aid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `cid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `last_setter` char(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`aid`,`id`),
  KEY `id` (`id`),
  KEY `aid` (`aid`,`timestamp`),
  KEY `cid` (`aid`,`cid`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_clone`;
CREATE TABLE `p8_cms_item_clone` (
  `clone_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_id` int(10) DEFAULT '0',
  `to_id` int(8) DEFAULT '0',
  `action_uid` int(8) NOT NULL DEFAULT '0',
  `action_username` varchar(50) NOT NULL DEFAULT '',
  `action_timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`clone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_comment`;
CREATE TABLE `p8_cms_item_comment` (
  `id` bigint(20) unsigned NOT NULL,
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  `mid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `quote` text NOT NULL,
  `content` text NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` char(15) NOT NULL DEFAULT '',
  `digg` smallint(5) unsigned NOT NULL DEFAULT '0',
  `oppose` smallint(5) unsigned NOT NULL DEFAULT '0',
  `verifier` varchar(30) DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `verify_timestramp` int(10) unsigned NOT NULL DEFAULT '0',
  `reason` varchar(255) NOT NULL DEFAULT '',
  `code` varchar(30) NOT NULL DEFAULT '',
  `exp_type` varchar(25) NOT NULL DEFAULT '',
  `exp_no` varchar(50) NOT NULL DEFAULT '',
  `field_1` varchar(255) NOT NULL DEFAULT '',
  `field_2` varchar(255) NOT NULL DEFAULT '',
  `field_3` varchar(255) NOT NULL DEFAULT '',
  `field_4` varchar(255) NOT NULL DEFAULT '',
  `field_5` varchar(255) NOT NULL DEFAULT '',
  `field_6` varchar(255) NOT NULL DEFAULT '',
  `field_7` varchar(255) NOT NULL DEFAULT '',
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
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  `mid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `quote` text NOT NULL,
  `content` text NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` char(15) NOT NULL DEFAULT '',
  `digg` smallint(5) unsigned NOT NULL DEFAULT '0',
  `oppose` smallint(5) unsigned NOT NULL DEFAULT '0',
  `verifier` varchar(30) DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `verify_timestramp` int(10) unsigned NOT NULL DEFAULT '0',
  `reason` varchar(255) NOT NULL DEFAULT '',
  `code` varchar(30) NOT NULL DEFAULT '',
  `exp_type` varchar(25) NOT NULL DEFAULT '',
  `exp_no` varchar(50) NOT NULL DEFAULT '',
  `field_1` varchar(255) NOT NULL DEFAULT '',
  `field_2` varchar(255) NOT NULL DEFAULT '',
  `field_3` varchar(255) NOT NULL DEFAULT '',
  `field_4` varchar(255) NOT NULL DEFAULT '',
  `field_5` varchar(255) NOT NULL DEFAULT '',
  `field_6` varchar(255) NOT NULL DEFAULT '',
  `field_7` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_digg`;
CREATE TABLE `p8_cms_item_digg` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  `digg` mediumint(8) NOT NULL DEFAULT '0',
  `trample` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `aid` (`iid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_down_`;
CREATE TABLE `p8_cms_item_down_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(500) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(520) NOT NULL DEFAULT '',
  `frame` varchar(500) NOT NULL DEFAULT '',
  `verify_frame` varchar(555) NOT NULL DEFAULT '',
  `url` varchar(512) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(1255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(1000) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `verifier` varchar(50) NOT NULL DEFAULT '',
  `verify_time` int(10) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `list_order` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `pages` smallint(5) unsigned NOT NULL DEFAULT '1',
  `html_view_url_rule` varchar(80) NOT NULL DEFAULT '',
  `template` varchar(30) NOT NULL DEFAULT '',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `score` tinyint(3) NOT NULL DEFAULT '0',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `level_time` int(10) unsigned NOT NULL DEFAULT '0',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `seo_keywords` varchar(500) NOT NULL DEFAULT '',
  `seo_description` varchar(200) NOT NULL DEFAULT '',
  `label_postfix` varchar(50) NOT NULL DEFAULT '',
  `config` varchar(1255) NOT NULL DEFAULT '',
  `custom_a` varchar(255) NOT NULL,
  `custom_b` varchar(255) NOT NULL,
  `custom_c` varchar(255) NOT NULL,
  `custom_d` varchar(255) NOT NULL,
  `custom_e` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_down_addon`;
CREATE TABLE `p8_cms_item_down_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  `page` smallint(5) unsigned NOT NULL DEFAULT '0',
  `addon_title` varchar(240) NOT NULL DEFAULT '',
  `addon_frame` varchar(500) NOT NULL DEFAULT '',
  `addon_summary` varchar(1080) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `softsize` varchar(10) NOT NULL,
  `softurl` mediumtext NOT NULL,
  `totaldown` mediumint(5) NOT NULL,
  `custom_f` varchar(255) NOT NULL,
  `custom_g` varchar(255) NOT NULL,
  `custom_h` varchar(255) NOT NULL,
  `custom_i` varchar(255) NOT NULL,
  `custom_j` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_government_affairs_`;
CREATE TABLE `p8_cms_item_government_affairs_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
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
  `cid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(500) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(520) NOT NULL DEFAULT '',
  `frame` varchar(500) NOT NULL DEFAULT '',
  `verify_frame` varchar(555) NOT NULL DEFAULT '',
  `url` varchar(512) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(1255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(1000) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `verifier` varchar(50) NOT NULL DEFAULT '',
  `verify_time` int(10) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `list_order` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `pages` smallint(5) unsigned NOT NULL DEFAULT '1',
  `html_view_url_rule` varchar(80) NOT NULL DEFAULT '',
  `template` varchar(30) NOT NULL DEFAULT '',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `score` tinyint(3) NOT NULL DEFAULT '0',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `level_time` int(10) unsigned NOT NULL DEFAULT '0',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `seo_keywords` varchar(500) NOT NULL DEFAULT '',
  `seo_description` varchar(200) NOT NULL DEFAULT '',
  `label_postfix` varchar(50) NOT NULL DEFAULT '',
  `config` varchar(1255) NOT NULL DEFAULT '',
  `duixiang` tinyint(3) NOT NULL,
  `geshi` tinyint(3) NOT NULL,
  `jigou` tinyint(3) NOT NULL,
  `shengming` tinyint(3) NOT NULL,
  `suoyin` varchar(255) NOT NULL,
  `ticai` tinyint(3) NOT NULL,
  `wenhao` varchar(255) DEFAULT NULL,
  `custom_a` varchar(255) NOT NULL,
  `custom_b` varchar(255) NOT NULL,
  `custom_c` varchar(255) NOT NULL,
  `custom_d` varchar(255) NOT NULL,
  `custom_e` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_govopen_addon`;
CREATE TABLE `p8_cms_item_govopen_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  `page` smallint(5) unsigned NOT NULL DEFAULT '0',
  `addon_title` varchar(240) NOT NULL DEFAULT '',
  `addon_frame` varchar(500) NOT NULL DEFAULT '',
  `addon_summary` varchar(1080) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `xinxifenlei` varchar(50) NOT NULL,
  `custom_f` varchar(255) NOT NULL,
  `custom_g` varchar(255) NOT NULL,
  `custom_h` varchar(255) NOT NULL,
  `custom_i` varchar(255) NOT NULL,
  `custom_j` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_lingdao_`;
CREATE TABLE `p8_cms_item_lingdao_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
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
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `model` char(20) NOT NULL DEFAULT '',
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`iid`),
  KEY `uid` (`uid`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_member_collection`;
CREATE TABLE `p8_cms_item_member_collection` (
  `iid` int(10) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`iid`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_mood`;
CREATE TABLE `p8_cms_item_mood` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL DEFAULT '',
  `image` char(20) NOT NULL DEFAULT '',
  `display_order` smallint(5) unsigned NOT NULL DEFAULT '0',
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
  `cid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(500) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(520) NOT NULL DEFAULT '',
  `frame` varchar(500) NOT NULL DEFAULT '',
  `verify_frame` varchar(555) NOT NULL DEFAULT '',
  `url` varchar(512) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(1255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(1000) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `verifier` varchar(50) NOT NULL DEFAULT '',
  `verify_time` int(10) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `list_order` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `pages` smallint(5) unsigned NOT NULL DEFAULT '1',
  `html_view_url_rule` varchar(80) NOT NULL DEFAULT '',
  `template` varchar(30) NOT NULL DEFAULT '',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `score` tinyint(3) NOT NULL DEFAULT '0',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `level_time` int(10) unsigned NOT NULL DEFAULT '0',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `seo_keywords` varchar(500) NOT NULL DEFAULT '',
  `seo_description` varchar(200) NOT NULL DEFAULT '',
  `label_postfix` varchar(50) NOT NULL DEFAULT '',
  `config` varchar(1255) NOT NULL DEFAULT '',
  `custom_a` varchar(255) NOT NULL,
  `custom_b` varchar(255) NOT NULL,
  `custom_c` varchar(255) NOT NULL,
  `custom_d` varchar(255) NOT NULL,
  `custom_e` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `level` (`level`,`list_order`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_page_addon`;
CREATE TABLE `p8_cms_item_page_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  `page` smallint(5) unsigned NOT NULL DEFAULT '0',
  `addon_title` varchar(240) NOT NULL DEFAULT '',
  `addon_frame` varchar(500) NOT NULL DEFAULT '',
  `addon_summary` varchar(1080) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `custom_f` varchar(255) NOT NULL,
  `custom_g` varchar(255) NOT NULL,
  `custom_h` varchar(255) NOT NULL,
  `custom_i` varchar(255) NOT NULL,
  `custom_j` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_paper_`;
CREATE TABLE `p8_cms_item_paper_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(500) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(520) NOT NULL DEFAULT '',
  `frame` varchar(500) NOT NULL DEFAULT '',
  `verify_frame` varchar(555) NOT NULL DEFAULT '',
  `url` varchar(512) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(1255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(1000) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `verifier` varchar(50) NOT NULL DEFAULT '',
  `verify_time` int(10) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `list_order` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `pages` smallint(5) unsigned NOT NULL DEFAULT '1',
  `html_view_url_rule` varchar(80) NOT NULL DEFAULT '',
  `template` varchar(30) NOT NULL DEFAULT '',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `score` tinyint(3) NOT NULL DEFAULT '0',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `level_time` int(10) unsigned NOT NULL DEFAULT '0',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `seo_keywords` varchar(500) NOT NULL DEFAULT '',
  `seo_description` varchar(200) NOT NULL DEFAULT '',
  `label_postfix` varchar(50) NOT NULL DEFAULT '',
  `config` varchar(1255) NOT NULL DEFAULT '',
  `custom_a` varchar(255) NOT NULL,
  `custom_b` varchar(255) NOT NULL,
  `custom_c` varchar(255) NOT NULL,
  `custom_d` varchar(255) NOT NULL,
  `custom_e` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_paper_addon`;
CREATE TABLE `p8_cms_item_paper_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  `page` smallint(5) unsigned NOT NULL DEFAULT '0',
  `addon_title` varchar(240) NOT NULL DEFAULT '',
  `addon_frame` varchar(500) NOT NULL DEFAULT '',
  `addon_summary` varchar(1080) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `custom_f` varchar(255) NOT NULL,
  `custom_g` varchar(255) NOT NULL,
  `custom_h` varchar(255) NOT NULL,
  `custom_i` varchar(255) NOT NULL,
  `custom_j` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_pay`;
CREATE TABLE `p8_cms_item_pay` (
  `iid` int(10) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`iid`,`uid`),
  KEY `uid` (`uid`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_people_`;
CREATE TABLE `p8_cms_item_people_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(500) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(520) NOT NULL DEFAULT '',
  `frame` varchar(500) NOT NULL DEFAULT '',
  `verify_frame` varchar(555) NOT NULL DEFAULT '',
  `url` varchar(512) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(1255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(1000) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `verifier` varchar(50) NOT NULL DEFAULT '',
  `verify_time` int(10) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `list_order` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `pages` smallint(5) unsigned NOT NULL DEFAULT '1',
  `html_view_url_rule` varchar(80) NOT NULL DEFAULT '',
  `template` varchar(30) NOT NULL DEFAULT '',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `score` tinyint(3) NOT NULL DEFAULT '0',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `level_time` int(10) unsigned NOT NULL DEFAULT '0',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `seo_keywords` varchar(500) NOT NULL DEFAULT '',
  `seo_description` varchar(200) NOT NULL DEFAULT '',
  `label_postfix` varchar(50) NOT NULL DEFAULT '',
  `config` varchar(1255) NOT NULL DEFAULT '',
  `department` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `custom_a` varchar(255) NOT NULL,
  `custom_b` varchar(255) NOT NULL,
  `custom_c` varchar(255) NOT NULL,
  `custom_d` varchar(255) NOT NULL,
  `custom_e` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_people_addon`;
CREATE TABLE `p8_cms_item_people_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  `page` smallint(5) unsigned NOT NULL DEFAULT '0',
  `addon_title` varchar(240) NOT NULL DEFAULT '',
  `addon_frame` varchar(500) NOT NULL DEFAULT '',
  `addon_summary` varchar(1080) NOT NULL DEFAULT '',
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
  `custom_f` varchar(255) NOT NULL,
  `custom_g` varchar(255) NOT NULL,
  `custom_h` varchar(255) NOT NULL,
  `custom_i` varchar(255) NOT NULL,
  `custom_j` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_photo_`;
CREATE TABLE `p8_cms_item_photo_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(500) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(520) NOT NULL DEFAULT '',
  `frame` varchar(500) NOT NULL DEFAULT '',
  `verify_frame` varchar(555) NOT NULL DEFAULT '',
  `url` varchar(512) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(1255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(1000) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `verifier` varchar(50) NOT NULL DEFAULT '',
  `verify_time` int(10) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `list_order` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `pages` smallint(5) unsigned NOT NULL DEFAULT '1',
  `html_view_url_rule` varchar(80) NOT NULL DEFAULT '',
  `template` varchar(30) NOT NULL DEFAULT '',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `score` tinyint(3) NOT NULL DEFAULT '0',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `level_time` int(10) unsigned NOT NULL DEFAULT '0',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `seo_keywords` varchar(500) NOT NULL DEFAULT '',
  `seo_description` varchar(200) NOT NULL DEFAULT '',
  `label_postfix` varchar(50) NOT NULL DEFAULT '',
  `config` varchar(1255) NOT NULL DEFAULT '',
  `custom_a` varchar(255) NOT NULL,
  `custom_b` varchar(255) NOT NULL,
  `custom_c` varchar(255) NOT NULL,
  `custom_d` varchar(255) NOT NULL,
  `custom_e` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_photo_addon`;
CREATE TABLE `p8_cms_item_photo_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  `page` smallint(5) unsigned NOT NULL DEFAULT '0',
  `addon_title` varchar(240) NOT NULL DEFAULT '',
  `addon_frame` varchar(500) NOT NULL DEFAULT '',
  `addon_summary` varchar(1080) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext,
  `photourl` text NOT NULL,
  `custom_f` varchar(255) NOT NULL,
  `custom_g` varchar(255) NOT NULL,
  `custom_h` varchar(255) NOT NULL,
  `custom_i` varchar(255) NOT NULL,
  `custom_j` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_product_`;
CREATE TABLE `p8_cms_item_product_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(500) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(520) NOT NULL DEFAULT '',
  `frame` varchar(500) NOT NULL DEFAULT '',
  `verify_frame` varchar(555) NOT NULL DEFAULT '',
  `url` varchar(512) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(1255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL DEFAULT '',
  `verifier` varchar(50) NOT NULL DEFAULT '',
  `verify_time` int(10) NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `pages` smallint(5) unsigned NOT NULL DEFAULT '1',
  `html_view_url_rule` varchar(80) NOT NULL DEFAULT '',
  `template` varchar(30) NOT NULL DEFAULT '',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `score` tinyint(3) NOT NULL DEFAULT '0',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `level_time` int(10) unsigned NOT NULL DEFAULT '0',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `seo_keywords` varchar(500) NOT NULL DEFAULT '',
  `seo_description` varchar(200) NOT NULL DEFAULT '',
  `label_postfix` varchar(50) NOT NULL DEFAULT '',
  `config` varchar(1255) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(1000) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `list_order` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `custom_a` varchar(255) NOT NULL,
  `custom_b` varchar(255) NOT NULL,
  `custom_c` varchar(255) NOT NULL,
  `custom_d` varchar(255) NOT NULL,
  `custom_e` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_product_addon`;
CREATE TABLE `p8_cms_item_product_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  `page` smallint(5) unsigned NOT NULL DEFAULT '0',
  `addon_title` varchar(240) NOT NULL DEFAULT '',
  `addon_frame` varchar(500) NOT NULL DEFAULT '',
  `addon_summary` varchar(1080) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `aboutinfo` mediumtext NOT NULL,
  `attrbutes` text NOT NULL,
  `content` mediumtext NOT NULL,
  `pics` text NOT NULL,
  `pro_down` varchar(255) DEFAULT NULL,
  `custom_f` varchar(255) NOT NULL,
  `custom_g` varchar(255) NOT NULL,
  `custom_h` varchar(255) NOT NULL,
  `custom_i` varchar(255) NOT NULL,
  `custom_j` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_search`;
CREATE TABLE `p8_cms_item_search` (
  `id` int(10) unsigned NOT NULL,
  `search` mediumtext NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_tag`;
CREATE TABLE `p8_cms_item_tag` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `item_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `hot` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `display_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_tag_item`;
CREATE TABLE `p8_cms_item_tag_item` (
  `tid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `iid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`,`iid`),
  KEY `iid` (`iid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_unverified`;
CREATE TABLE `p8_cms_item_unverified` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(500) NOT NULL DEFAULT '',
  `cid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `pages` smallint(5) unsigned NOT NULL DEFAULT '1',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `score` tinyint(3) NOT NULL DEFAULT '0',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `level_time` int(10) unsigned NOT NULL DEFAULT '0',
  `source` varchar(255) NOT NULL DEFAULT '',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `verify_frame` varchar(555) NOT NULL DEFAULT '',
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
  `cid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(500) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(520) NOT NULL DEFAULT '',
  `frame` varchar(500) NOT NULL DEFAULT '',
  `verify_frame` varchar(555) NOT NULL DEFAULT '',
  `url` varchar(512) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(1255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(1000) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `verifier` varchar(50) NOT NULL DEFAULT '',
  `verify_time` int(10) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `list_order` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `pages` smallint(5) unsigned NOT NULL DEFAULT '1',
  `html_view_url_rule` varchar(80) NOT NULL DEFAULT '',
  `template` varchar(30) NOT NULL DEFAULT '',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `score` tinyint(3) NOT NULL DEFAULT '0',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `level_time` int(10) unsigned NOT NULL DEFAULT '0',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `seo_keywords` varchar(500) NOT NULL DEFAULT '',
  `seo_description` varchar(200) NOT NULL DEFAULT '',
  `label_postfix` varchar(50) NOT NULL DEFAULT '',
  `config` varchar(1255) NOT NULL DEFAULT '',
  `custom_a` varchar(255) NOT NULL,
  `custom_b` varchar(255) NOT NULL,
  `custom_c` varchar(255) NOT NULL,
  `custom_d` varchar(255) NOT NULL,
  `custom_e` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_video_addon`;
CREATE TABLE `p8_cms_item_video_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  `page` smallint(5) unsigned NOT NULL DEFAULT '0',
  `addon_title` varchar(240) NOT NULL DEFAULT '',
  `addon_frame` varchar(500) NOT NULL DEFAULT '',
  `addon_summary` varchar(1080) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `video_height` smallint(5) NOT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `video_width` smallint(5) NOT NULL,
  `custom_f` varchar(255) NOT NULL,
  `custom_g` varchar(255) NOT NULL,
  `custom_h` varchar(255) NOT NULL,
  `custom_i` varchar(255) NOT NULL,
  `custom_j` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_zlku_`;
CREATE TABLE `p8_cms_item_zlku_` (
  `id` int(10) unsigned NOT NULL,
  `model` varchar(20) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(500) NOT NULL DEFAULT '',
  `title_color` varchar(7) NOT NULL DEFAULT '',
  `title_bold` tinyint(1) NOT NULL DEFAULT '0',
  `sub_title` varchar(520) NOT NULL DEFAULT '',
  `frame` varchar(500) NOT NULL DEFAULT '',
  `verify_frame` varchar(555) NOT NULL DEFAULT '',
  `url` varchar(512) NOT NULL DEFAULT '',
  `attributes` varchar(40) NOT NULL DEFAULT '',
  `summary` varchar(1255) NOT NULL DEFAULT '',
  `source` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authority` varchar(255) NOT NULL DEFAULT '',
  `verifier` varchar(50) NOT NULL DEFAULT '',
  `verify_time` int(10) NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `pages` smallint(5) unsigned NOT NULL DEFAULT '1',
  `html_view_url_rule` varchar(80) NOT NULL DEFAULT '',
  `template` varchar(30) NOT NULL DEFAULT '',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `score` tinyint(3) NOT NULL DEFAULT '0',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `level_time` int(10) unsigned NOT NULL DEFAULT '0',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `seo_keywords` varchar(500) NOT NULL DEFAULT '',
  `seo_description` varchar(200) NOT NULL DEFAULT '',
  `label_postfix` varchar(50) NOT NULL DEFAULT '',
  `config` varchar(1255) NOT NULL DEFAULT '',
  `editer` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(1000) NOT NULL DEFAULT '',
  `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `list_order` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `custom_a` varchar(255) NOT NULL,
  `custom_b` varchar(255) NOT NULL,
  `custom_c` varchar(255) NOT NULL,
  `custom_d` varchar(255) NOT NULL,
  `custom_e` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`list_order`),
  KEY `cid_id` (`cid`,`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_item_zlku_addon`;
CREATE TABLE `p8_cms_item_zlku_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  `page` smallint(5) unsigned NOT NULL DEFAULT '0',
  `addon_title` varchar(240) NOT NULL DEFAULT '',
  `addon_frame` varchar(500) NOT NULL DEFAULT '',
  `addon_summary` varchar(1080) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `last_update_ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `copyright` tinyint(3) NOT NULL,
  `softlanguage` tinyint(3) NOT NULL,
  `softsize` varchar(10) NOT NULL,
  `softurl` mediumtext NOT NULL,
  `totaldown` mediumint(5) NOT NULL,
  `custom_f` varchar(255) NOT NULL,
  `custom_g` varchar(255) NOT NULL,
  `custom_h` varchar(255) NOT NULL,
  `custom_i` varchar(255) NOT NULL,
  `custom_j` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_member`;
CREATE TABLE `p8_cms_member` (
  `id` mediumint(8) unsigned NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT '',
  `role_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `item_count` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `role_id` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_model`;
CREATE TABLE `p8_cms_model` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(90) NOT NULL DEFAULT '',
  `alias` varchar(90) NOT NULL DEFAULT '',
  `list_order` int(10) NOT NULL DEFAULT '0',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `config` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

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
  `not_null` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `length` varchar(10) NOT NULL DEFAULT '',
  `is_unsigned` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `editable` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `default_value` text NOT NULL,
  `data` text NOT NULL,
  `config` text NOT NULL,
  `widget` varchar(50) NOT NULL DEFAULT '',
  `widget_addon_attr` varchar(255) NOT NULL DEFAULT '',
  `display_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `units` varchar(20) NOT NULL DEFAULT '',
  `description` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`model`,`name`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_order`;
CREATE TABLE `p8_cms_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NO` varchar(25) NOT NULL DEFAULT '',
  `interface_NO` varchar(25) NOT NULL DEFAULT '',
  `name` varchar(40) NOT NULL DEFAULT '',
  `subject` varchar(60) NOT NULL DEFAULT '',
  `seller_uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `seller_username` varchar(20) NOT NULL DEFAULT '',
  `buyer_uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `sid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `buyer_username` varchar(20) NOT NULL DEFAULT '',
  `phone` varchar(30) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `address` varchar(100) NOT NULL DEFAULT '',
  `interface` varchar(10) NOT NULL DEFAULT '',
  `amount` decimal(10,2) unsigned NOT NULL,
  `number` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
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

DROP TABLE IF EXISTS `p8_cms_statistic_cms_statistic_sites_content`;
CREATE TABLE `p8_cms_statistic_cms_statistic_sites_content` (
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

DROP TABLE IF EXISTS `p8_cms_statistic_cms_statistic_sites_push`;
CREATE TABLE `p8_cms_statistic_cms_statistic_sites_push` (
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
  `unverified` int(11) NOT NULL DEFAULT '0',
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
  `keyword` varchar(100) NOT NULL DEFAULT '',
  `type` varchar(10) NOT NULL DEFAULT '',
  `pattern` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `content` mediumtext NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `picurl` varchar(200) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL DEFAULT '',
  `reply_type` varchar(10) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `keyword` (`keyword`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_wechat_menus`;
CREATE TABLE `p8_cms_wechat_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL DEFAULT '',
  `value` varchar(100) NOT NULL DEFAULT '',
  `type` varchar(10) NOT NULL DEFAULT '',
  `list_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_wechat_messages`;
CREATE TABLE `p8_cms_wechat_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(30) NOT NULL DEFAULT '',
  `type` varchar(15) NOT NULL DEFAULT '',
  `content` varchar(255) NOT NULL DEFAULT '',
  `reply` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_wechat_pushlogs`;
CREATE TABLE `p8_cms_wechat_pushlogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned NOT NULL,
  `no` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `media_id` varchar(100) NOT NULL DEFAULT '',
  `msg_id` varchar(100) NOT NULL DEFAULT '',
  `msg_data_id` varchar(100) NOT NULL DEFAULT '',
  `litpic` varchar(100) NOT NULL DEFAULT '',
  `litpic_id` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(200) NOT NULL DEFAULT '',
  `username` varchar(50) NOT NULL DEFAULT '',
  `verifier` varchar(50) NOT NULL,
  `author` varchar(30) NOT NULL DEFAULT '',
  `show_author` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `open_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `fans_comment` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `push_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `aid` (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cms_wechat_users`;
CREATE TABLE `p8_cms_wechat_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(30) NOT NULL DEFAULT '',
  `subscribe` tinyint(1) NOT NULL DEFAULT '0',
  `nickname` varchar(30) NOT NULL DEFAULT '',
  `sex` tinyint(1) NOT NULL DEFAULT '0',
  `city` varchar(30) NOT NULL DEFAULT '',
  `province` varchar(30) NOT NULL DEFAULT '',
  `country` varchar(30) NOT NULL DEFAULT '',
  `headimgurl` varchar(200) NOT NULL DEFAULT '',
  `subscribe_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `unionid` varchar(30) NOT NULL DEFAULT '',
  `subscribe_scene` varchar(20) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `openid` (`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_config`;
CREATE TABLE `p8_config` (
  `system` varchar(30) NOT NULL DEFAULT '',
  `module` varchar(50) NOT NULL DEFAULT '',
  `type` varchar(10) NOT NULL DEFAULT 'string',
  `k` varchar(50) NOT NULL DEFAULT '',
  `v` mediumtext NOT NULL,
  PRIMARY KEY (`system`,`module`,`k`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_credit`;
CREATE TABLE `p8_credit` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL DEFAULT '',
  `unit` char(4) NOT NULL DEFAULT '',
  `icon` char(20) NOT NULL DEFAULT '',
  `is_unsigned` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `default_value` char(20) NOT NULL DEFAULT '0',
  `float_bit` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `float_point` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `roe` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_credit_log`;
CREATE TABLE `p8_credit_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  `system` varchar(20) NOT NULL DEFAULT '',
  `module` varchar(20) NOT NULL DEFAULT '',
  `site` varchar(20) NOT NULL DEFAULT '',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `credit_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `credit` int(11) NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `reason` varchar(255) NOT NULL DEFAULT '',
  `setter` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`credit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=393 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_credit_member`;
CREATE TABLE `p8_credit_member` (
  `id` mediumint(8) unsigned NOT NULL,
  `credit_1` int(11) NOT NULL DEFAULT '100',
  `credit_2` int(11) NOT NULL DEFAULT '50',
  `credit_3` decimal(3,0) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_credit_rule`;
CREATE TABLE `p8_credit_rule` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `system` varchar(30) NOT NULL DEFAULT '',
  `module` varchar(50) NOT NULL DEFAULT '',
  `action` varchar(20) NOT NULL DEFAULT '',
  `role_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `credit_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `credit` int(10) NOT NULL DEFAULT '0',
  `postfix` varchar(30) NOT NULL DEFAULT '',
  `times` smallint(5) unsigned NOT NULL DEFAULT '0',
  `interval` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`system`,`module`,`action`,`credit_id`,`role_id`,`postfix`),
  KEY `credit_id` (`credit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_credit_rule_log`;
CREATE TABLE `p8_credit_rule_log` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rule_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  KEY `uid` (`uid`,`rule_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_credit_rule_log_cache`;
CREATE TABLE `p8_credit_rule_log_cache` (
  `uid` mediumint(8) unsigned NOT NULL,
  `rule_id` smallint(5) unsigned NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `times` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`uid`,`rule_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_crontab_`;
CREATE TABLE `p8_crontab_` (
  `id` mediumint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `script` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `next_run_time` int(10) unsigned NOT NULL DEFAULT '0',
  `last_run_time` int(10) unsigned NOT NULL DEFAULT '0',
  `day` mediumint(4) unsigned NOT NULL DEFAULT '0',
  `week` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `month` tinyint(2) NOT NULL DEFAULT '0',
  `hour` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `minute` tinyint(2) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `script` (`script`),
  KEY `next_run_time` (`status`,`next_run_time`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cservice_`;
CREATE TABLE `p8_cservice_` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` bigint(20) NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `mobilephone` varchar(16) NOT NULL DEFAULT '0',
  `ip` varchar(20) NOT NULL DEFAULT '',
  `site` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(60) NOT NULL DEFAULT '',
  `priority` int(1) NOT NULL DEFAULT '0',
  `category` varchar(30) NOT NULL DEFAULT '',
  `timestamp` int(11) NOT NULL DEFAULT '0',
  `solvetime` int(11) NOT NULL DEFAULT '0',
  `adminuid` int(11) NOT NULL DEFAULT '0',
  `adminname` varchar(30) NOT NULL DEFAULT '',
  `state` int(1) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `timestamp` (`timestamp`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_cservice_reply`;
CREATE TABLE `p8_cservice_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `askid` int(11) NOT NULL DEFAULT '0',
  `repid` int(11) NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `title` varchar(60) NOT NULL DEFAULT '',
  `frame` varchar(255) NOT NULL DEFAULT '',
  `timestamp` int(11) NOT NULL DEFAULT '0',
  `state` int(1) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_filter_link`;
CREATE TABLE `p8_filter_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system` varchar(30) NOT NULL DEFAULT '',
  `module` varchar(30) NOT NULL DEFAULT '',
  `site` varchar(30) NOT NULL DEFAULT '',
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  `model` varchar(20) NOT NULL DEFAULT '',
  `link` varchar(512) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_filter_word`;
CREATE TABLE `p8_filter_word` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `filter_word` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `filter_word` (`filter_word`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item`;
CREATE TABLE `p8_forms_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL DEFAULT '',
  `title_color` varchar(100) NOT NULL DEFAULT '',
  `mid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `ip` varchar(16) NOT NULL DEFAULT '',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `list_order` int(10) unsigned NOT NULL DEFAULT '0',
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `recommend` tinyint(1) NOT NULL DEFAULT '0',
  `status` smallint(3) NOT NULL DEFAULT '0',
  `replyer` varchar(50) NOT NULL DEFAULT '',
  `reply_time` int(10) unsigned NOT NULL DEFAULT '0',
  `display_order` int(10) unsigned NOT NULL DEFAULT '0',
  `reply` varchar(255) NOT NULL DEFAULT '',
  `config` text NOT NULL,
  `p8_status` varchar(50) NOT NULL DEFAULT '',
  `p8_reply` varchar(255) NOT NULL DEFAULT '',
  `p8_replyer` varchar(50) NOT NULL DEFAULT '',
  `p8_reply_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`,`list_order`),
  KEY `mid_id` (`mid`,`id`),
  KEY `timestamp` (`timestamp`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=4665 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_bybd2`;
CREATE TABLE `p8_forms_item_bybd2` (
  `id` int(10) unsigned NOT NULL,
  `mingcheng` varchar(255) NOT NULL,
  `lxr` varchar(255) NOT NULL,
  `leixing` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `QQ` varchar(255) DEFAULT NULL,
  `dizhi` varchar(255) DEFAULT NULL,
  `wangzhi` varchar(255) DEFAULT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_bybd4`;
CREATE TABLE `p8_forms_item_bybd4` (
  `id` int(10) unsigned NOT NULL,
  `tibaoren` varchar(255) NOT NULL,
  `chengdu` varchar(255) NOT NULL,
  `baoxsx` varchar(255) NOT NULL,
  `bxjtnr` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_bybd6`;
CREATE TABLE `p8_forms_item_bybd6` (
  `id` int(10) unsigned NOT NULL,
  `baofei` varchar(255) DEFAULT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  `cplx` varchar(255) NOT NULL,
  `cpmc` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `hgcp` varchar(255) DEFAULT NULL,
  `nianfen` varchar(255) NOT NULL,
  `sjsl` varchar(255) NOT NULL,
  `tibaoren` varchar(255) NOT NULL,
  `yuefen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_kehu`;
CREATE TABLE `p8_forms_item_kehu` (
  `id` int(10) unsigned NOT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  `bum` varchar(255) NOT NULL,
  `caigou` varchar(255) NOT NULL,
  `csny` varchar(255) NOT NULL,
  `czhm` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `date2` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gaokao` varchar(255) NOT NULL,
  `kaoshenghao` varchar(255) NOT NULL,
  `khjb` varchar(255) NOT NULL,
  `khlb` varchar(255) NOT NULL,
  `khmc` varchar(255) NOT NULL,
  `lianxiren` varchar(255) NOT NULL,
  `QQ` varchar(255) DEFAULT NULL,
  `shouji` varchar(255) NOT NULL,
  `tongxing` varchar(255) NOT NULL,
  `wangzhi` varchar(255) DEFAULT NULL,
  `xingmin` varchar(255) NOT NULL,
  `xingming` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `yuefen` varchar(255) NOT NULL,
  `zycj` varchar(255) DEFAULT NULL,
  `zhuanye` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_library`;
CREATE TABLE `p8_forms_item_library` (
  `id` int(10) unsigned NOT NULL,
  `state` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `bookcase` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `press` varchar(255) NOT NULL,
  `zhuangtai` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_project`;
CREATE TABLE `p8_forms_item_project` (
  `id` int(10) unsigned NOT NULL,
  `diqu` varchar(255) NOT NULL,
  `sudi` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `leibie` varchar(255) NOT NULL,
  `touzhi` varchar(255) NOT NULL,
  `niandu` varchar(255) NOT NULL,
  `bianhao` varchar(255) DEFAULT NULL,
  `lxdw` varchar(255) NOT NULL,
  `xiangmuzhuangtai` varchar(255) DEFAULT NULL,
  `beizhu` longtext,
  `fujian` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_xmtj`;
CREATE TABLE `p8_forms_item_xmtj` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `iid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_model`;
CREATE TABLE `p8_forms_model` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL DEFAULT '',
  `alias` char(30) NOT NULL DEFAULT '',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `verified` varchar(20) NOT NULL DEFAULT '',
  `recommend` tinyint(1) NOT NULL DEFAULT '0',
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  `display_order` int(10) unsigned NOT NULL DEFAULT '0',
  `post_template` varchar(50) NOT NULL DEFAULT '',
  `list_template` varchar(50) NOT NULL DEFAULT '',
  `view_template` varchar(50) NOT NULL DEFAULT '',
  `post_template_mobile` varchar(50) NOT NULL DEFAULT '',
  `list_template_mobile` varchar(50) NOT NULL DEFAULT '',
  `view_template_mobile` varchar(50) NOT NULL DEFAULT '',
  `config` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=202 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_model_field`;
CREATE TABLE `p8_forms_model_field` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(30) NOT NULL DEFAULT '',
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL DEFAULT '',
  `alias` varchar(50) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT '',
  `part` varchar(20) NOT NULL DEFAULT '',
  `list_table` tinyint(1) NOT NULL DEFAULT '0',
  `filterable` tinyint(1) NOT NULL DEFAULT '0',
  `orderby` tinyint(1) NOT NULL DEFAULT '0',
  `not_null` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `length` varchar(10) NOT NULL DEFAULT '',
  `is_unsigned` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `editable` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `manager_editable` tinyint(1) NOT NULL DEFAULT '0',
  `default_value` text NOT NULL,
  `data` text NOT NULL,
  `config` text NOT NULL,
  `widget` varchar(50) NOT NULL DEFAULT '',
  `widget_addon_attr` varchar(255) NOT NULL DEFAULT '',
  `display_order` tinyint(3) unsigned NOT NULL,
  `units` varchar(20) NOT NULL DEFAULT '',
  `jsreg` varchar(40) NOT NULL DEFAULT '',
  `jsregmsg` varchar(20) NOT NULL DEFAULT '',
  `color` varchar(10) NOT NULL DEFAULT '',
  `description` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`model`,`name`)
) ENGINE=MyISAM AUTO_INCREMENT=863 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_homepage_block`;
CREATE TABLE `p8_homepage_block` (
  `name` varchar(60) NOT NULL,
  `system` varchar(20) NOT NULL,
  `module` varchar(50) NOT NULL,
  `method` varchar(20) NOT NULL,
  `alias` varchar(20) NOT NULL,
  PRIMARY KEY (`name`),
  KEY `system` (`system`,`module`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_homepage_menu`;
CREATE TABLE `p8_homepage_menu` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `system` char(30) NOT NULL DEFAULT '',
  `module` char(50) NOT NULL DEFAULT '',
  `action` char(50) NOT NULL DEFAULT '',
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` char(30) NOT NULL DEFAULT '',
  `url` char(255) NOT NULL DEFAULT '',
  `target` char(10) NOT NULL DEFAULT '',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `front` tinyint(1) NOT NULL DEFAULT '0',
  `display_order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `system` (`system`,`module`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_homepage_view`;
CREATE TABLE `p8_homepage_view` (
  `uid` mediumint(8) unsigned NOT NULL,
  `view_uid` mediumint(8) unsigned NOT NULL,
  `view_username` char(20) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`view_uid`),
  KEY `view_uid` (`view_uid`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_interview_ask`;
CREATE TABLE `p8_interview_ask` (
  `id` mediumint(7) NOT NULL AUTO_INCREMENT,
  `sid` mediumint(7) NOT NULL,
  `username` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL DEFAULT '',
  `posttime` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_interview_content`;
CREATE TABLE `p8_interview_content` (
  `id` mediumint(7) NOT NULL AUTO_INCREMENT,
  `sid` mediumint(7) NOT NULL,
  `sender` tinyint(1) NOT NULL,
  `content` text NOT NULL,
  `posttime` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_interview_picture`;
CREATE TABLE `p8_interview_picture` (
  `id` mediumint(7) NOT NULL AUTO_INCREMENT,
  `sid` mediumint(7) NOT NULL,
  `url` varchar(255) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `posttime` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_interview_subject`;
CREATE TABLE `p8_interview_subject` (
  `id` mediumint(7) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `summary` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `picture` varchar(255) NOT NULL DEFAULT '',
  `video` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `gpicture` varchar(255) NOT NULL DEFAULT '',
  `gname` varchar(255) NOT NULL DEFAULT '',
  `gintroduction` text NOT NULL,
  `cpicture` varchar(255) NOT NULL DEFAULT '',
  `cname` varchar(255) NOT NULL DEFAULT '',
  `cintroduction` text NOT NULL,
  `begintime` int(10) NOT NULL DEFAULT '0',
  `endtime` int(10) NOT NULL DEFAULT '0',
  `posttime` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_label`;
CREATE TABLE `p8_label` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `system` varchar(30) NOT NULL DEFAULT '',
  `module` varchar(50) NOT NULL DEFAULT '',
  `site` varchar(50) NOT NULL DEFAULT '',
  `env` varchar(50) NOT NULL DEFAULT '',
  `source_system` varchar(30) NOT NULL DEFAULT '',
  `source_module` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT '',
  `option` text NOT NULL,
  `content` text NOT NULL,
  `invoke` text NOT NULL,
  `variable` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `last_update` int(10) unsigned NOT NULL DEFAULT '0',
  `ttl` mediumint(8) NOT NULL DEFAULT '0',
  `postfix` varchar(20) NOT NULL DEFAULT '',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `last_setter` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `system` (`system`,`module`,`postfix`,`name`,`site`,`env`),
  KEY `name` (`name`),
  KEY `site` (`site`),
  KEY `source` (`source_system`,`source_module`)
) ENGINE=MyISAM AUTO_INCREMENT=21049 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_letter_cat`;
CREATE TABLE `p8_letter_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL DEFAULT '',
  `num` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_letter_data`;
CREATE TABLE `p8_letter_data` (
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
  `vefify_content` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_letter_department`;
CREATE TABLE `p8_letter_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL DEFAULT '',
  `num` int(11) NOT NULL DEFAULT '0',
  `desc` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_letter_item`;
CREATE TABLE `p8_letter_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` smallint(5) NOT NULL,
  `type` tinyint(3) NOT NULL,
  `visual` tinyint(1) NOT NULL DEFAULT '0',
  `undisplay` tinyint(1) NOT NULL DEFAULT '0',
  `vefify` tinyint(1) NOT NULL DEFAULT '0',
  `number` varchar(20) NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `code` char(32) NOT NULL DEFAULT '',
  `gender` tinyint(1) NOT NULL DEFAULT '0',
  `age` tinyint(3) NOT NULL DEFAULT '0',
  `recommend` tinyint(1) NOT NULL DEFAULT '0',
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
  `custom_a` varchar(255) NOT NULL DEFAULT '',
  `custom_b` varchar(255) NOT NULL DEFAULT '',
  `custom_c` varchar(255) NOT NULL DEFAULT '',
  `custom_d` varchar(255) NOT NULL DEFAULT '',
  `custom_e` varchar(255) NOT NULL DEFAULT '',
  `custom_f` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `create_time` (`create_time`),
  KEY `department` (`department`,`type`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_mail_queue`;
CREATE TABLE `p8_mail_queue` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_member`;
CREATE TABLE `p8_member` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(128) NOT NULL DEFAULT '',
  `salt` varchar(10) NOT NULL DEFAULT '',
  `number` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(40) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `phone` varchar(20) NOT NULL DEFAULT '',
  `cell_phone` varchar(11) NOT NULL DEFAULT '',
  `address` varchar(50) NOT NULL DEFAULT '',
  `fax` varchar(20) NOT NULL DEFAULT '',
  `qq` varchar(12) NOT NULL DEFAULT '',
  `msn` varchar(50) NOT NULL DEFAULT '',
  `gender` tinyint(1) NOT NULL DEFAULT '1',
  `birthday` int(11) NOT NULL DEFAULT '0',
  `icon` varchar(150) NOT NULL DEFAULT '',
  `role_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `role_gid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `last_role_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_founder` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `friend_setting` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `friends` smallint(5) unsigned NOT NULL DEFAULT '0',
  `new_messages` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `register_time` int(10) unsigned NOT NULL DEFAULT '0',
  `register_ip` varchar(15) NOT NULL DEFAULT '',
  `last_login_ip` varchar(15) NOT NULL DEFAULT '',
  `pinyin` varchar(30) NOT NULL DEFAULT '',
  `last_login` int(10) unsigned NOT NULL DEFAULT '0',
  `login_time` smallint(5) unsigned NOT NULL DEFAULT '0',
  `display_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `memo` text NOT NULL,
  `homepage` text NOT NULL,
  `school` varchar(255) NOT NULL DEFAULT '',
  `is_email_manager` tinyint(1) NOT NULL DEFAULT '0',
  `dept` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  KEY `role_gid` (`role_gid`),
  KEY `is_admin` (`is_admin`),
  KEY `is_founder` (`is_founder`),
  KEY `cell_phone` (`cell_phone`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_member_acl`;
CREATE TABLE `p8_member_acl` (
  `system` varchar(30) NOT NULL DEFAULT '',
  `module` varchar(50) NOT NULL DEFAULT '',
  `user_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `postfix` varchar(30) NOT NULL DEFAULT '',
  `v` text NOT NULL,
  PRIMARY KEY (`system`,`module`,`user_id`,`postfix`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_member_buy_role`;
CREATE TABLE `p8_member_buy_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_NO` char(25) NOT NULL DEFAULT '',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL DEFAULT '',
  `role_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `amount` mediumint(5) unsigned NOT NULL DEFAULT '0',
  `time` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `expire` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_NO` (`order_NO`),
  KEY `uid` (`uid`,`timestamp`),
  KEY `status` (`status`,`expire`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_member_friend`;
CREATE TABLE `p8_member_friend` (
  `uid` mediumint(8) unsigned NOT NULL,
  `fuid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `cid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `description` char(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`,`fuid`),
  KEY `fuid` (`fuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_member_friend_category`;
CREATE TABLE `p8_member_friend_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '',
  `members` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_member_friend_unverified`;
CREATE TABLE `p8_member_friend_unverified` (
  `uid` mediumint(8) unsigned NOT NULL,
  `fuid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `cid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `description` char(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`,`fuid`),
  KEY `fuid` (`fuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_member_getpasswd`;
CREATE TABLE `p8_member_getpasswd` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `email` char(32) NOT NULL,
  `checkcode` char(32) NOT NULL DEFAULT '',
  `createtime` mediumtext NOT NULL,
  `invalidlong` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_member_menu`;
CREATE TABLE `p8_member_menu` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `system` char(30) NOT NULL DEFAULT '',
  `module` char(50) NOT NULL DEFAULT '',
  `action` char(50) NOT NULL DEFAULT '',
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `color` char(7) NOT NULL DEFAULT '',
  `name` char(30) NOT NULL DEFAULT '',
  `url` char(255) NOT NULL DEFAULT '',
  `target` char(10) NOT NULL DEFAULT '',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `front` tinyint(1) NOT NULL DEFAULT '0',
  `display_order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `system` (`system`,`module`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_member_recharge`;
CREATE TABLE `p8_member_recharge` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_NO` char(25) NOT NULL DEFAULT '',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL DEFAULT '',
  `amount` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_NO` (`order_NO`),
  KEY `uid` (`uid`,`timestamp`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_message`;
CREATE TABLE `p8_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `othername` varchar(20) NOT NULL DEFAULT '',
  `sender_uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `sendee_uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `role_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `type` enum('in','out','rubbish','draft') NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `new` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sendee_uid` (`sendee_uid`,`timestamp`),
  KEY `sender_uid` (`sender_uid`,`timestamp`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_module`;
CREATE TABLE `p8_module` (
  `system` char(30) NOT NULL DEFAULT '',
  `name` char(50) NOT NULL DEFAULT '',
  `alias` char(30) NOT NULL DEFAULT '',
  `class` char(30) NOT NULL DEFAULT '',
  `controller_class` char(50) NOT NULL DEFAULT '',
  `installed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`system`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_navigation_menu`;
CREATE TABLE `p8_navigation_menu` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `system` char(30) NOT NULL DEFAULT '',
  `module` char(50) NOT NULL DEFAULT '',
  `color` char(10) NOT NULL DEFAULT '',
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` char(30) NOT NULL DEFAULT '',
  `url` char(255) NOT NULL DEFAULT '',
  `dynamic_url` char(255) NOT NULL DEFAULT '',
  `target` char(10) NOT NULL DEFAULT '',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `display_order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `summary` text NOT NULL,
  `frame` char(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `system` (`system`,`module`)
) ENGINE=MyISAM AUTO_INCREMENT=152 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_notify_`;
CREATE TABLE `p8_notify_` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `title` varchar(50) NOT NULL DEFAULT '',
  `send_pm` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `send_mail` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `send_sms` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `sms_back` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `sent` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  `data` mediumtext NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `send_count` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sign_in_count` smallint(5) unsigned NOT NULL DEFAULT '0',
  `expire` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_notify_sign_in`;
CREATE TABLE `p8_notify_sign_in` (
  `nid` int(10) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `hash` char(16) NOT NULL DEFAULT '',
  `comment` char(255) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `receive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nid`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_opinion_comment`;
CREATE TABLE `p8_opinion_comment` (
  `id` tinyint(10) NOT NULL AUTO_INCREMENT,
  `did` int(10) NOT NULL DEFAULT '0',
  `uid` int(10) NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '',
  `timestamp` int(10) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `did` (`did`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_opinion_data`;
CREATE TABLE `p8_opinion_data` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL DEFAULT '',
  `tel` varchar(30) NOT NULL DEFAULT '',
  `mobile` varchar(50) NOT NULL DEFAULT '',
  `ip` varchar(30) NOT NULL DEFAULT '',
  `accept` tinyint(1) NOT NULL DEFAULT '0',
  `accept_desc` varchar(255) NOT NULL DEFAULT '',
  `up` int(10) NOT NULL DEFAULT '0',
  `down` int(10) NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `status` smallint(3) NOT NULL DEFAULT '0',
  `title` varchar(30) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_opinion_item`;
CREATE TABLE `p8_opinion_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `view` int(10) unsigned NOT NULL DEFAULT '0',
  `post` int(10) unsigned NOT NULL DEFAULT '0',
  `captcha` tinyint(1) NOT NULL DEFAULT '0',
  `status` smallint(3) NOT NULL DEFAULT '0',
  `post_template` varchar(30) NOT NULL DEFAULT '',
  `list_template` varchar(30) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `timestamp` (`timestamp`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_page_`;
CREATE TABLE `p8_page_` (
  `id` mediumint(5) NOT NULL AUTO_INCREMENT,
  `fid` mediumint(5) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `timestamp` int(10) NOT NULL DEFAULT '0',
  `uid` mediumint(7) NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `style` varchar(15) NOT NULL DEFAULT '',
  `type` int(1) NOT NULL DEFAULT '0',
  `tpl_head` varchar(50) NOT NULL DEFAULT '',
  `tpl_main` varchar(50) NOT NULL DEFAULT '',
  `tpl_foot` varchar(50) NOT NULL DEFAULT '',
  `htmlize` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `tpl_mobile` varchar(50) NOT NULL DEFAULT '',
  `html_view_url_rule` varchar(100) NOT NULL DEFAULT '',
  `filepath` varchar(30) NOT NULL DEFAULT '',
  `descrip` text NOT NULL,
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `hits` int(7) NOT NULL DEFAULT '0',
  `ishtml` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `p8_pagecache` (
  `id` char(32) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `data` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_pay_interface`;
CREATE TABLE `p8_pay_interface` (
  `name` varchar(120) NOT NULL,
  `alias` varchar(120) NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `logo` varchar(120) NOT NULL DEFAULT '',
  `config` text NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_pay_log`;
CREATE TABLE `p8_pay_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_NO` char(20) NOT NULL,
  `interface` char(15) NOT NULL DEFAULT '',
  `payer_uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `payer_username` char(20) NOT NULL DEFAULT '',
  `amount` decimal(10,2) unsigned NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_pay_member_interface`;
CREATE TABLE `p8_pay_member_interface` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` char(15) NOT NULL,
  `config` text NOT NULL,
  PRIMARY KEY (`uid`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_pay_order`;
CREATE TABLE `p8_pay_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NO` varchar(25) NOT NULL DEFAULT '',
  `interface_NO` varchar(25) NOT NULL DEFAULT '',
  `name` varchar(40) NOT NULL DEFAULT '',
  `seller_uid` mediumint(8) unsigned NOT NULL,
  `seller_username` varchar(20) NOT NULL DEFAULT '',
  `buyer_uid` mediumint(8) unsigned NOT NULL,
  `buyer_username` varchar(20) NOT NULL DEFAULT '',
  `interface` varchar(10) NOT NULL DEFAULT '',
  `amount` decimal(10,2) unsigned NOT NULL,
  `number` smallint(5) unsigned NOT NULL,
  `ip` varchar(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `paid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `notify` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NO` (`NO`),
  KEY `seller_uid` (`seller_uid`,`timestamp`),
  KEY `buyer_uid` (`buyer_uid`,`timestamp`),
  KEY `status` (`status`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_pay_order_lock`;
CREATE TABLE `p8_pay_order_lock` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NO` char(20) NOT NULL DEFAULT '',
  `update_status` tinyint(1) unsigned NOT NULL,
  `notify_status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NO` (`NO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_plugin`;
CREATE TABLE `p8_plugin` (
  `name` char(50) NOT NULL DEFAULT '',
  `alias` char(30) NOT NULL DEFAULT '',
  `class` char(30) NOT NULL DEFAULT '',
  `installed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_plugin_qqconnect_`;
CREATE TABLE `p8_plugin_qqconnect_` (
  `id` mediumint(5) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(5) NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `openid` char(32) NOT NULL DEFAULT '0',
  `access_token` varchar(30) NOT NULL DEFAULT '',
  `expires_in` int(11) NOT NULL DEFAULT '0',
  `nickname` varchar(30) NOT NULL DEFAULT '',
  `gender` char(2) NOT NULL DEFAULT '0',
  `vip` tinyint(1) NOT NULL DEFAULT '0',
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `figureurl` varchar(255) NOT NULL DEFAULT '',
  `timestamp` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `openid` (`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_plugin_schedul_`;
CREATE TABLE `p8_plugin_schedul_` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `date_time` varchar(50) NOT NULL DEFAULT '',
  `dcode` varchar(50) NOT NULL DEFAULT '',
  `level` varchar(20) NOT NULL DEFAULT '0',
  `name` varchar(120) NOT NULL DEFAULT '',
  `phone` varchar(50) NOT NULL,
  `event` varchar(255) NOT NULL DEFAULT '',
  `list_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_role`;
CREATE TABLE `p8_role` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `system` char(30) NOT NULL DEFAULT 'core',
  `type` enum('system','normal') NOT NULL DEFAULT 'normal',
  `gid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` char(20) NOT NULL DEFAULT '',
  `icon` char(50) NOT NULL DEFAULT '',
  `display_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `credit_1` int(11) NOT NULL DEFAULT '0',
  `credit_2` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_role_group`;
CREATE TABLE `p8_role_group` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL DEFAULT '',
  `registrable` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `default_role` smallint(5) unsigned NOT NULL DEFAULT '0',
  `description` char(255) NOT NULL DEFAULT '',
  `display_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_role_group_1_data`;
CREATE TABLE `p8_role_group_1_data` (
  `id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_role_group_2_data`;
CREATE TABLE `p8_role_group_2_data` (
  `id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_role_group_field`;
CREATE TABLE `p8_role_group_field` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `gid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` char(30) NOT NULL DEFAULT '',
  `alias` char(50) NOT NULL DEFAULT '',
  `type` char(20) NOT NULL DEFAULT '',
  `not_null` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `length` char(10) NOT NULL DEFAULT '',
  `is_unsigned` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `default_value` char(100) NOT NULL DEFAULT '',
  `data` text NOT NULL,
  `widget` char(20) NOT NULL DEFAULT '',
  `widget_addon_attr` char(255) NOT NULL DEFAULT '',
  `display_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`gid`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `p8_session` (
  `id` char(32) NOT NULL DEFAULT '',
  `uid` mediumint(7) unsigned NOT NULL DEFAULT '0',
  `username` char(30) NOT NULL DEFAULT '',
  `system` char(20) NOT NULL DEFAULT '',
  `module` char(30) NOT NULL DEFAULT '',
  `action` char(25) NOT NULL DEFAULT '',
  `item_id` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` char(15) NOT NULL DEFAULT '',
  `lastview` int(10) unsigned NOT NULL DEFAULT '0',
  `data1` char(255) NOT NULL DEFAULT '',
  `data2` char(255) NOT NULL DEFAULT '',
  `data3` char(255) NOT NULL DEFAULT '',
  `data4` char(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `lastview` (`lastview`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_shortcutsms_data`;
CREATE TABLE `p8_shortcutsms_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` mediumtext NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_clone`;
CREATE TABLE `p8_sites_item_clone` (
  `clone_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_id` int(10) DEFAULT '0',
  `to_id` int(8) DEFAULT '0',
  `action_uid` int(8) NOT NULL DEFAULT '0',
  `action_username` varchar(50) NOT NULL DEFAULT '',
  `action_timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`clone_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sites_item_matrix`;
CREATE TABLE `p8_sites_item_matrix` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '对接分站信息ID',
  `scid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '对接分站栏目ID',
  `cid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '对接主站栏目ID',
  `iid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '对接主站信息ID',
  PRIMARY KEY (`id`)
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sms_data`;
CREATE TABLE `p8_sms_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `phone` varchar(11) NOT NULL DEFAULT '',
  `message` varchar(255) NOT NULL DEFAULT '',
  `timestramp` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_special_`;
CREATE TABLE `p8_special_` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `title` varchar(80) NOT NULL DEFAULT '',
  `frame` varchar(100) NOT NULL DEFAULT '',
  `ifcomment` int(1) NOT NULL DEFAULT '0',
  `template` char(255) NOT NULL DEFAULT '',
  `html_view_url_rule` varchar(100) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `banner` varchar(100) NOT NULL DEFAULT '',
  `seo_keywords` varchar(100) NOT NULL DEFAULT '',
  `navigation` text NOT NULL,
  `count` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`timestamp`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_special_category`;
CREATE TABLE `p8_special_category` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parent` smallint(5) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(60) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `frame` varchar(255) NOT NULL DEFAULT '',
  `item_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `display_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_sphinx`;
CREATE TABLE `p8_sphinx` (
  `id` char(50) NOT NULL,
  `max_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_spider_category`;
CREATE TABLE `p8_spider_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL DEFAULT '',
  `display_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_spider_item`;
CREATE TABLE `p8_spider_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `title` varchar(80) NOT NULL DEFAULT '',
  `pages` smallint(5) unsigned NOT NULL DEFAULT '1',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` mediumtext NOT NULL,
  `captured_items` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_spider_item_addon`;
CREATE TABLE `p8_spider_item_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`iid`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_spider_rule`;
CREATE TABLE `p8_spider_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` mediumtext NOT NULL,
  `captured_items` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_survey_addon`;
CREATE TABLE `p8_survey_addon` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  `tid` int(10) unsigned NOT NULL DEFAULT '0',
  `did` int(10) unsigned NOT NULL DEFAULT '0',
  `data` varchar(255) NOT NULL DEFAULT '',
  `other` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`),
  KEY `tid` (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_survey_data`;
CREATE TABLE `p8_survey_data` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL DEFAULT '',
  `tel` varchar(30) NOT NULL DEFAULT '',
  `mobile` varchar(30) NOT NULL DEFAULT '',
  `ip` varchar(30) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `status` smallint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_survey_item`;
CREATE TABLE `p8_survey_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `view` int(10) unsigned NOT NULL DEFAULT '0',
  `post` int(10) unsigned NOT NULL DEFAULT '0',
  `captcha` tinyint(1) NOT NULL DEFAULT '0',
  `status` smallint(3) NOT NULL DEFAULT '0',
  `post_template` varchar(30) NOT NULL DEFAULT '',
  `list_template` varchar(30) NOT NULL DEFAULT '',
  `view_template` varchar(30) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `timestamp` (`timestamp`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_survey_title`;
CREATE TABLE `p8_survey_title` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(30) NOT NULL DEFAULT '',
  `display_order` tinyint(1) NOT NULL DEFAULT '0',
  `not_null` tinyint(1) NOT NULL DEFAULT '0',
  `other` tinyint(1) NOT NULL DEFAULT '0',
  `tittle` varchar(30) NOT NULL DEFAULT '',
  `config` text NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`iid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_system`;
CREATE TABLE `p8_system` (
  `name` char(30) NOT NULL DEFAULT '',
  `alias` char(30) NOT NULL DEFAULT '',
  `table_prefix` char(20) NOT NULL DEFAULT '',
  `class` char(30) NOT NULL DEFAULT '',
  `controller_class` char(50) NOT NULL DEFAULT '',
  `installed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_vote_`;
CREATE TABLE `p8_vote_` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `frame` varchar(255) NOT NULL DEFAULT '',
  `template` varchar(40) NOT NULL,
  `label_template` varchar(40) NOT NULL,
  `content` text NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `multi` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `page_size` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `roles` varchar(255) NOT NULL DEFAULT '',
  `viewable` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `vote_to_view` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `view_voter` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `vote_interval` smallint(5) unsigned NOT NULL DEFAULT '0',
  `votes` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `expire` int(10) unsigned NOT NULL DEFAULT '0',
  `captcha` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_vote_option`;
CREATE TABLE `p8_vote_option` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vid` int(10) unsigned NOT NULL,
  `name` varchar(40) NOT NULL DEFAULT '',
  `description` varchar(100) NOT NULL DEFAULT '',
  `frame` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `display_order` int(10) unsigned NOT NULL DEFAULT '0',
  `votes` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `vid` (`vid`,`display_order`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_vote_voter`;
CREATE TABLE `p8_vote_voter` (
  `vid` int(10) unsigned NOT NULL,
  `oid` int(10) unsigned NOT NULL,
  `uid` char(15) NOT NULL DEFAULT '',
  `username` char(20) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  KEY `oid` (`oid`,`timestamp`),
  KEY `vid` (`vid`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_word_censor`;
CREATE TABLE `p8_word_censor` (
  `id` int(10) unsigned NOT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `system` varchar(30) NOT NULL DEFAULT '',
  `module` varchar(30) NOT NULL DEFAULT '',
  `site` varchar(30) NOT NULL DEFAULT '',
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  `model` varchar(20) NOT NULL DEFAULT '',
  `message` varchar(512) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

