-- <?php exit;?>

DROP TABLE IF EXISTS `p8_credit_member_`;
;
DROP TABLE IF EXISTS `p8_credit_rule`;
CREATE TABLE `p8_credit_rule` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `system` varchar(30) NOT NULL DEFAULT '',
  `module` varchar(50) NOT NULL DEFAULT '',
  `action` varchar(20) NOT NULL DEFAULT '',
  `role_id` smallint(5) unsigned NOT NULL DEFAULT 0,
  `credit_id` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `credit` int(10) NOT NULL DEFAULT 0,
  `postfix` varchar(30) NOT NULL DEFAULT '',
  `times` smallint(5) unsigned NOT NULL DEFAULT 0,
  `interval` mediumint(8) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`system`,`module`,`action`,`credit_id`,`role_id`,`postfix`),
  KEY `credit_id` (`credit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
INSERT INTO `p8_credit_rule` (`id`,`system`,`module`,`action`,`role_id`,`credit_id`,`credit`,`postfix`,`times`,`interval`)VALUES('1','core','member','login','0','1','5','','3','86400');
DROP TABLE IF EXISTS `p8_credit_rule_log`;
CREATE TABLE `p8_credit_rule_log` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT 0,
  `rule_id` smallint(5) unsigned NOT NULL DEFAULT 0,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  KEY `uid` (`uid`,`rule_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `p8_credit_rule_log_cache`;
CREATE TABLE `p8_credit_rule_log_cache` (
  `uid` mediumint(8) unsigned NOT NULL,
  `rule_id` smallint(5) unsigned NOT NULL DEFAULT 0,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `times` tinyint(3) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`uid`,`rule_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
