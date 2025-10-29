-- <?php exit;?>
CREATE TABLE IF NOT EXISTS `p8_46_` (
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
  `manager` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `buyable` (`buyable`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `p8_46_buy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` mediumint(7) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(7) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '0',
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `p8_46_click_log` (
  `bid` int(10) unsigned NOT NULL,
  `ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `referer` char(120) NOT NULL DEFAULT '',
  KEY `bid` (`bid`,`timestamp`),
  KEY `bid_ip` (`bid`,`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
REPLACE INTO `p8_46_` (`id`, `name`, `type`, `expense_type`, `link_type`, `buyable`, `buy_count`, `credit_type`, `credit`, `width`, `height`, `template`, `timestamp`, `show_count`, `verify`, `max_day`, `manager`) VALUES(12, '右侧广告', 'scroll', 'none', 1, 0, 2, 0, 0, '108', '300', 'couplet_image', 1417608201, 1, 1, 1, '');
REPLACE INTO `p8_46_` (`id`, `name`, `type`, `expense_type`, `link_type`, `buyable`, `buy_count`, `credit_type`, `credit`, `width`, `height`, `template`, `timestamp`, `show_count`, `verify`, `max_day`, `manager`) VALUES(13, '左侧广告', 'scroll', 'none', 0, 0, 1, 0, 0, '108', '300', 'couplet_image', 1417608251, 1, 1, 1, '');
REPLACE INTO `p8_46_` (`id`, `name`, `type`, `expense_type`, `link_type`, `buyable`, `buy_count`, `credit_type`, `credit`, `width`, `height`, `template`, `timestamp`, `show_count`, `verify`, `max_day`, `manager`) VALUES(14, '弹窗广告', 'windows', 'none', 0, 0, 1, 0, 0, '108', '300', 'couplet_windows', 1490922847, 1, 1, 1, '');
REPLACE INTO `p8_46_buy` (`id`, `aid`, `uid`, `username`, `verified`, `showing`, `credit`, `day`, `timestamp`, `clicks`, `postfix`, `comment`, `display_order`, `data`, `expire`) VALUES(6, 10, 1, 'admin', 1, 1, 0, 0, 1371981530, 0, '', '', 255, 'a:3:{s:4:"name";s:6:"漂浮AD";s:5:"media";s:61:"<!--#p8_attach#-->/core/46/2014_08/23_22/173b853e08d9ca42.jpg";s:3:"url";s:1:"#";}', 0);
REPLACE INTO `p8_46_buy` (`id`, `aid`, `uid`, `username`, `verified`, `showing`, `credit`, `day`, `timestamp`, `clicks`, `postfix`, `comment`, `display_order`, `data`, `expire`) VALUES(7, 11, 1, 'admin', 1, 1, 0, 0, 1371981594, 0, '', '', 255, 'a:6:{s:3:"url";s:26:"http://php168.net/gov.html";s:4:"left";s:61:"<!--#p8_attach#-->/core/46/2010_12/13_15/d22a4e61531cd26d.swf";s:5:"right";s:61:"<!--#p8_attach#-->/core/46/2010_12/13_15/d22a4e61531cd26d.swf";s:3:"top";s:3:"130";s:6:"bottom";s:0:"";s:6:"margin";s:0:"";}', 0);
REPLACE INTO `p8_46_buy` (`id`, `aid`, `uid`, `username`, `verified`, `showing`, `credit`, `day`, `timestamp`, `clicks`, `postfix`, `comment`, `display_order`, `data`, `expire`) VALUES(8, 13, 1, 'admin', 1, 0, 0, 0, 1417608309, 0, '', '', 255, 'a:6:{s:3:"url";s:1:"#";s:4:"left";s:61:"<!--#p8_attach#-->/core/46/2014_12/23_20/a8d555cbd1b72ff7.jpg";s:5:"right";s:0:"";s:3:"top";s:3:"180";s:6:"bottom";s:0:"";s:6:"margin";s:2:"10";}', 0);
REPLACE INTO `p8_46_buy` (`id`, `aid`, `uid`, `username`, `verified`, `showing`, `credit`, `day`, `timestamp`, `clicks`, `postfix`, `comment`, `display_order`, `data`, `expire`) VALUES(10, 12, 1, 'admin', 1, 0, 0, 0, 1417609834, 0, '', '', 255, 'a:6:{s:3:"url";s:1:"#";s:4:"left";s:0:"";s:5:"right";s:61:"<!--#p8_attach#-->/core/46/2014_12/23_20/45bc3d96a8308176.jpg";s:3:"top";s:3:"180";s:6:"bottom";s:0:"";s:6:"margin";s:2:"10";}', 0);
REPLACE INTO `p8_46_buy` (`id`, `aid`, `uid`, `username`, `verified`, `showing`, `credit`, `day`, `timestamp`, `clicks`, `postfix`, `comment`, `display_order`, `data`, `expire`) VALUES(11, 14, 1, 'admin', 1, 0, 0, 0, 1490922877, 0, '', '', 255, 'a:3:{s:3:"url";s:17:"http://www.qq.com";s:3:"top";s:2:"10";s:6:"bottom";s:2:"10";}', 0);