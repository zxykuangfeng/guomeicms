-- <?php exit;?>

CREATE TABLE `p8_member` (
  `iid` int(10) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL,
  `model` char(20) NOT NULL default '',
  `verified` tinyint(1) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`iid`),
  KEY `uid` (`uid`,`timestamp`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `p8_attribute` (
  `id` int(10) unsigned NOT NULL,
  `aid` tinyint(3) unsigned NOT NULL,
  `cid` mediumint(8) unsigned NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
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
  `iid` int(10) unsigned NOT NULL,
  `mid` smallint(5) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(50) NOT NULL,
  `quote` text NOT NULL,
  `content` text NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `ip` char(15) NOT NULL default '',
  `digg` smallint(5) unsigned NOT NULL default '0',
  `oppose` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `iid` (`iid`,`timestamp`),
  KEY `digg` (`iid`,`digg`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `p8_mood` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` char(20) NOT NULL default '',
  `image` char(20) NOT NULL default '',
  `display_order` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;
