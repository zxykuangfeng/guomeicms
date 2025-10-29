-- <?php exit;?>

DROP TABLE IF EXISTS `p8_46_`;
CREATE TABLE `p8_46_` (
  `id` mediumint(7) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT '',
  `expense_type` varchar(20) NOT NULL DEFAULT '',
  `link_type` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `buyable` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `buy_count` smallint(5) unsigned NOT NULL DEFAULT 0,
  `credit_type` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `credit` smallint(5) unsigned NOT NULL DEFAULT 0,
  `width` varchar(10) NOT NULL DEFAULT '',
  `height` varchar(10) NOT NULL DEFAULT '',
  `template` varchar(50) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `show_count` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `verify` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `max_day` tinyint(3) unsigned NOT NULL DEFAULT 1,
  `manager` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `buyable` (`buyable`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
INSERT INTO `p8_46_` (`id`,`name`,`type`,`expense_type`,`link_type`,`buyable`,`buy_count`,`credit_type`,`credit`,`width`,`height`,`template`,`timestamp`,`show_count`,`verify`,`max_day`,`manager`)VALUES('3','右下角滚动图片','scroll','none','0','0','1','0','0','196','132','scroll_image','1292225236','1','1','1','');
INSERT INTO `p8_46_` (`id`,`name`,`type`,`expense_type`,`link_type`,`buyable`,`buy_count`,`credit_type`,`credit`,`width`,`height`,`template`,`timestamp`,`show_count`,`verify`,`max_day`,`manager`)VALUES('2','首页顶部拉下式广告','effect','none','1','0','2','0','0','957','335','slide_down_image_reflash','1292222255','1','1','1','');
INSERT INTO `p8_46_` (`id`,`name`,`type`,`expense_type`,`link_type`,`buyable`,`buy_count`,`credit_type`,`credit`,`width`,`height`,`template`,`timestamp`,`show_count`,`verify`,`max_day`,`manager`)VALUES('8','对联左侧广告','scroll','none','1','0','1','0','0','108','300','couplet_image','1420548586','1','1','1','');
INSERT INTO `p8_46_` (`id`,`name`,`type`,`expense_type`,`link_type`,`buyable`,`buy_count`,`credit_type`,`credit`,`width`,`height`,`template`,`timestamp`,`show_count`,`verify`,`max_day`,`manager`)VALUES('7','漂浮广告','fly','none','1','0','3','0','0','270','150','couplet_flash','1371742877','2','1','1','');
INSERT INTO `p8_46_` (`id`,`name`,`type`,`expense_type`,`link_type`,`buyable`,`buy_count`,`credit_type`,`credit`,`width`,`height`,`template`,`timestamp`,`show_count`,`verify`,`max_day`,`manager`)VALUES('9','对联广告','scroll','none','1','0','1','0','0','108','300','couplet_image','1420548621','1','1','1','');
DROP TABLE IF EXISTS `p8_46_buy`;
CREATE TABLE `p8_46_buy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` mediumint(7) unsigned NOT NULL DEFAULT 0,
  `uid` mediumint(7) unsigned NOT NULL DEFAULT 0,
  `username` varchar(20) NOT NULL DEFAULT '0',
  `verified` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `showing` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `credit` smallint(5) unsigned NOT NULL DEFAULT 0,
  `day` smallint(5) unsigned NOT NULL DEFAULT 0,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `clicks` mediumint(8) unsigned NOT NULL DEFAULT 0,
  `postfix` varchar(60) NOT NULL DEFAULT '',
  `comment` varchar(60) NOT NULL DEFAULT '',
  `display_order` tinyint(3) unsigned NOT NULL DEFAULT 255,
  `data` text NOT NULL,
  `expire` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`,`display_order`,`timestamp`),
  KEY `aid_2` (`aid`,`showing`,`verified`,`postfix`,`expire`),
  KEY `uid` (`uid`,`timestamp`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
INSERT INTO `p8_46_buy` (`id`,`aid`,`uid`,`username`,`verified`,`showing`,`credit`,`day`,`timestamp`,`clicks`,`postfix`,`comment`,`display_order`,`data`,`expire`)VALUES('7','1','1','admin','1','1','0','0','1366793945','0','','','255','a:6:{s:3:\"url\";s:30:\"http://www.php168.net/html/16/\";s:4:\"left\";s:61:\"<!--#p8_attach#-->/core/46/2010_12/13_15/d22a4e61531cd26d.swf\";s:5:\"right\";s:61:\"<!--#p8_attach#-->/core/46/2010_12/13_15/d22a4e61531cd26d.swf\";s:3:\"top\";s:3:\"100\";s:6:\"bottom\";s:0:\"\";s:6:\"margin\";s:0:\"\";}','0');
INSERT INTO `p8_46_buy` (`id`,`aid`,`uid`,`username`,`verified`,`showing`,`credit`,`day`,`timestamp`,`clicks`,`postfix`,`comment`,`display_order`,`data`,`expire`)VALUES('3','3','1','admin','0','0','0','0','1292225285','0','','','255','a:6:{s:3:\"url\";s:22:\"http://www.php168.net/\";s:4:\"left\";s:61:\"<!--#p8_attach#-->/core/46/2015_08/18_22/9b1567174f8d174b.png\";s:5:\"right\";s:50:\"http://img.alimama.cn/cms/images/1291620869457.jpg\";s:3:\"top\";s:0:\"\";s:6:\"bottom\";s:1:\"0\";s:6:\"margin\";s:1:\"5\";}','0');
INSERT INTO `p8_46_buy` (`id`,`aid`,`uid`,`username`,`verified`,`showing`,`credit`,`day`,`timestamp`,`clicks`,`postfix`,`comment`,`display_order`,`data`,`expire`)VALUES('13','7','1','admin','1','1','0','0','1502003964','0','','','255','a:3:{s:4:\"name\";s:6:\"广告\";s:5:\"media\";s:61:\"<!--#p8_attach#-->/core/46/2017_07/27_14/23936e45baec7852.jpg\";s:3:\"url\";s:21:\"http://www.php168.net\";}','0');
INSERT INTO `p8_46_buy` (`id`,`aid`,`uid`,`username`,`verified`,`showing`,`credit`,`day`,`timestamp`,`clicks`,`postfix`,`comment`,`display_order`,`data`,`expire`)VALUES('5','2','1','admin','1','1','0','0','1346260005','0','','','255','a:4:{s:5:\"media\";s:61:\"<!--#p8_attach#-->/core/46/2019_10/01_14/277169c10a9441a1.jpg\";s:5:\"thumb\";s:0:\"\";s:4:\"name\";s:0:\"\";s:3:\"url\";s:1:\"#\";}','0');
INSERT INTO `p8_46_buy` (`id`,`aid`,`uid`,`username`,`verified`,`showing`,`credit`,`day`,`timestamp`,`clicks`,`postfix`,`comment`,`display_order`,`data`,`expire`)VALUES('10','9','1','admin','1','1','0','0','1420548767','0','','','255','a:6:{s:3:\"url\";a:2:{s:4:\"left\";s:0:\"\";s:5:\"right\";s:0:\"\";}s:4:\"left\";s:61:\"<!--#p8_attach#-->/core/46/2019_09/24_16/12a68346d406419d.jpg\";s:5:\"right\";s:61:\"<!--#p8_attach#-->/core/46/2019_09/24_16/19928ac6a8be839d.jpg\";s:3:\"top\";s:3:\"180\";s:6:\"bottom\";s:0:\"\";s:6:\"margin\";s:2:\"10\";}','0');
INSERT INTO `p8_46_buy` (`id`,`aid`,`uid`,`username`,`verified`,`showing`,`credit`,`day`,`timestamp`,`clicks`,`postfix`,`comment`,`display_order`,`data`,`expire`)VALUES('11','8','1','admin','1','1','0','0','1420548863','0','','','255','a:6:{s:3:\"url\";s:30:\"http://www.php168.net/html/16/\";s:4:\"left\";s:61:\"<!--#p8_attach#-->/core/46/2015_01/06_20/e1b7df2fdae0ce9d.jpg\";s:5:\"right\";s:0:\"\";s:3:\"top\";s:3:\"180\";s:6:\"bottom\";s:0:\"\";s:6:\"margin\";s:2:\"10\";}','0');
DROP TABLE IF EXISTS `p8_46_click_log`;
CREATE TABLE `p8_46_click_log` (
  `bid` int(10) unsigned NOT NULL,
  `ip` char(15) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `referer` char(120) NOT NULL DEFAULT '',
  KEY `bid` (`bid`,`timestamp`),
  KEY `bid_ip` (`bid`,`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
