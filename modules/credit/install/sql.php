-- <?php exit;?>

CREATE TABLE `p8_member` (
  `id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `p8_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  `system` varchar(20) NOT NULL DEFAULT '',
  `module` varchar(20) NOT NULL DEFAULT '',
  `site` varchar(20) NOT NULL DEFAULT '',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `credit_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `credit` int(10) NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `reason` varchar(255) NOT NULL DEFAULT '',
  `setter` varchar(50) NOT NULL DEFAULT '',
  KEY `uid` (`uid`,`credit_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `p8_rule` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `system` char(30) NOT NULL DEFAULT '',
  `module` char(50) NOT NULL DEFAULT '',
  `action` char(20) NOT NULL DEFAULT '',
  `role_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `credit_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `credit` int(10) NOT NULL DEFAULT '0',
  `postfix` char(30) NOT NULL DEFAULT '',
  `times` smallint(5) unsigned NOT NULL DEFAULT '0',
  `interval` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`system`,`module`,`action`,`credit_id`,`role_id`,`postfix`),
  KEY `credit_id` (`credit_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `p8_rule_log` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rule_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL,
  KEY `uid` (`uid`,`rule_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `p8_rule_log_cache` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rule_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `times` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`uid`,`rule_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



