-- <?php exit;?>

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
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL,
  `paid` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `notify` text NOT NULL DEFAULT '',
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
DROP TABLE IF EXISTS `p8_pay_log`;
CREATE TABLE `p8_pay_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_NO` char(20) NOT NULL,
  `interface` char(15) NOT NULL DEFAULT '',
  `payer_uid` mediumint(8) unsigned NOT NULL DEFAULT 0,
  `payer_username` char(20) NOT NULL DEFAULT '',
  `amount` decimal(10,2) unsigned NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `p8_pay_interface`;
CREATE TABLE `p8_pay_interface` (
  `name` varchar(120) NOT NULL,
  `alias` varchar(120) NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `logo` varchar(120) NOT NULL DEFAULT '',
  `config` text NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `p8_pay_interface` (`name`,`alias`,`enabled`,`logo`,`config`)VALUES('alipay','支付宝','0','alipay.gif','a:0:{}');
INSERT INTO `p8_pay_interface` (`name`,`alias`,`enabled`,`logo`,`config`)VALUES('credit','余额付款(尚未支持)','0','alipay.gif','a:0:{}');
INSERT INTO `p8_pay_interface` (`name`,`alias`,`enabled`,`logo`,`config`)VALUES('offline','线下付款','1','unionpay.gif','a:1:{s:4:\"bank\";a:1:{i:0;a:4:{s:4:\"name\";s:18:\"中国工商银行\";s:7:\"account\";s:13:\"6222*********\";s:5:\"payee\";s:17:\"某先生(小姐)\";s:4:\"logo\";s:8:\"icbc.gif\";}}}');
INSERT INTO `p8_pay_interface` (`name`,`alias`,`enabled`,`logo`,`config`)VALUES('tenpay','财付通(尚未支持)','0','tenpay.gif','a:0:{}');
DROP TABLE IF EXISTS `p8_pay_member_interface`;
CREATE TABLE `p8_pay_member_interface` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT 0,
  `name` char(15) NOT NULL,
  `config` text NOT NULL,
  PRIMARY KEY (`uid`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
