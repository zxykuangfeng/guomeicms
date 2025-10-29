-- <?php exit;?>

CREATE TABLE `p8_member` (
  `iid` int(10) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `model` char(20) NOT NULL default '',
  `verified` tinyint(1) NOT NULL default '0',
  `timestamp` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`iid`),
  KEY `uid` (`uid`,`timestamp`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `p8_member_collection` (
  `iid` int(10) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `timestamp` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`iid`, `uid`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `p8_search` (
  `id` int(10) unsigned NOT NULL,
  `search` mediumtext NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`/*!50100 ,`timestamp`*/)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `p8_level` (
  `id` int(10) unsigned NOT NULL,
  `aid` tinyint(3) unsigned NOT NULL default '0',
  `cid` mediumint(8) unsigned NOT NULL default '0',
  `affect_time` int(10) unsigned NOT NULL default '0',
  `timestamp` int(10) unsigned NOT NULL default '0',
  `last_setter` char(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`aid`,`id`),
  KEY `id` (`id`),
  KEY `aid` (`aid`,`timestamp`),
  KEY `cid` (`aid`,`cid`,`timestamp`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `p8_attribute` (
  `id` int(10) unsigned NOT NULL,
  `aid` tinyint(3) unsigned NOT NULL default '0',
  `cid` mediumint(8) unsigned NOT NULL default '0',
  `timestamp` int(10) unsigned NOT NULL default '0',
  `last_setter` char(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`aid`,`id`),
  KEY `id` (`id`),
  KEY `aid` (`aid`,`timestamp`),
  KEY `cid` (`aid`,`cid`,`timestamp`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `p8_comment_id` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `p8_comment` (
  `id` bigint(20) unsigned NOT NULL,
  `iid` int(10) unsigned NOT NULL default '0',
  `mid` smallint(5) unsigned NOT NULL default '0',
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(50) NOT NULL default '',
  `quote` text NOT NULL,
  `content` text NOT NULL,
  `timestamp` int(10) unsigned NOT NULL default '0',
  `ip` char(15) NOT NULL default '',
  `digg` smallint(5) unsigned NOT NULL default '0',
  `oppose` smallint(5) unsigned NOT NULL default '0',
  `verifier` VARCHAR(30) NULL DEFAULT  '',
  `verified` tinyint(1) unsigned NOT NULL default '1',
  `verify_timestramp` int(10) unsigned NOT NULL,
  `reason` varchar(255) NOT NULL default '',
  `code` varchar(30) NOT NULL DEFAULT '',
  `exp_type` varchar(25) NOT NULL DEFAULT '',
  `exp_no` varchar(50) NOT NULL DEFAULT '',
  `field_1` varchar(255) NOT NULL default '',
  `field_2` varchar(255) NOT NULL default '',
  `field_3` varchar(255) NOT NULL default '',
  `field_4` varchar(255) NOT NULL default '',
  `field_5` varchar(255) NOT NULL default '',
  `field_6` varchar(255) NOT NULL default '',
  `field_7` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `iid` (`iid`,`timestamp`),
  KEY `digg` (`iid`,`digg`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `p8_comment_unverified` (
  `id` bigint(20) unsigned NOT NULL,
  `iid` int(10) unsigned NOT NULL default '0',
  `mid` smallint(2) unsigned NOT NULL default '0',
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(50) NOT NULL default '',
  `quote` text NOT NULL,
  `content` text NOT NULL,
  `timestamp` int(10) unsigned NOT NULL default '0',
  `ip` char(15) NOT NULL default '',
  `digg` smallint(5) unsigned NOT NULL default '0',
  `oppose` smallint(5) unsigned NOT NULL default '0',
  `verifier` VARCHAR(30) NULL DEFAULT  '',
  `verified` tinyint(1) unsigned NOT NULL default '1',
  `verify_timestramp` int(10) unsigned NOT NULL,
  `reason` varchar(255) NOT NULL default '',
  `code` varchar(30) NOT NULL DEFAULT '',
  `exp_type` varchar(25) NOT NULL DEFAULT '',
  `exp_no` varchar(50) NOT NULL DEFAULT '',
  `field_1` varchar(255) NOT NULL default '',
  `field_2` varchar(255) NOT NULL default '',
  `field_3` varchar(255) NOT NULL default '',
  `field_4` varchar(255) NOT NULL default '',
  `field_5` varchar(255) NOT NULL default '',
  `field_6` varchar(255) NOT NULL default '',
  `field_7` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `iid` (`iid`,`timestamp`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `p8_mood` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` char(20) NOT NULL default '',
  `image` char(20) NOT NULL default '',
  `display_order` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY (`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `p8_mood` (`id`, `name`, `image`,`display_order`) VALUES (1,'欠扁','1.gif',99);
INSERT INTO `p8_mood` (`id`, `name`, `image`,`display_order`) VALUES (2,'支持','2.gif',88);
INSERT INTO `p8_mood` (`id`, `name`, `image`,`display_order`) VALUES (3,'很棒','3.gif',77);
INSERT INTO `p8_mood` (`id`, `name`, `image`,`display_order`) VALUES (4,'找骂','4.gif',66);
INSERT INTO `p8_mood` (`id`, `name`, `image`,`display_order`) VALUES (5,'搞笑','5.gif',55);
INSERT INTO `p8_mood` (`id`, `name`, `image`,`display_order`) VALUES (6,'软文','6.gif',44);
INSERT INTO `p8_mood` (`id`, `name`, `image`,`display_order`) VALUES (7,'不解','7.gif',1);
INSERT INTO `p8_mood` (`id`, `name`, `image`,`display_order`) VALUES (8,'吃惊','8.gif',1);

CREATE TABLE `p8_mood_data` (
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
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `p8_digg` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `iid` int(10) unsigned NOT NULL default '0',
  `digg` mediumint(8) NOT NULL default '0',
  `trample` mediumint(8) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `aid` (`iid`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `p8_pay` (
  `iid` int(10) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `timestamp` int(8) NOT NULL,
  PRIMARY KEY (`iid`,`uid`),
  KEY `uid` (`uid`,`timestamp`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `p8_tag` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL default '',
  `item_count` mediumint(8) unsigned NOT NULL default '0',
  `hot` tinyint(1) unsigned NOT NULL default '0',
  `display_order` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY (`name`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `p8_tag_item` (
  `tid` smallint(5) unsigned NOT NULL default '0',
  `iid` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY (`tid`,`iid`),
  KEY (`iid`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

