-- <?php exit;?>

DROP TABLE IF EXISTS `p8_friendlink_link`;
CREATE TABLE `p8_friendlink_link` (
  `id` mediumint(5) NOT NULL AUTO_INCREMENT,
  `fid` int(7) NOT NULL DEFAULT 0,
  `name` varchar(30) NOT NULL DEFAULT '',
  `url` varchar(150) NOT NULL DEFAULT '',
  `logo` varchar(150) NOT NULL DEFAULT '',
  `descrip` varchar(255) NOT NULL DEFAULT '',
  `list` int(10) NOT NULL DEFAULT 0,
  `ifhide` tinyint(1) NOT NULL DEFAULT 0,
  `iswordlink` tinyint(1) NOT NULL DEFAULT 0,
  `hits` tinyint(7) NOT NULL DEFAULT 0,
  `posttime` int(10) NOT NULL DEFAULT 0,
  `uid` int(7) NOT NULL DEFAULT 0,
  `username` varchar(30) NOT NULL DEFAULT '',
  `yz` tinyint(1) NOT NULL DEFAULT 1,
  `endtime` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `yz` (`yz`,`endtime`,`ifhide`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
INSERT INTO `p8_friendlink_link` (`id`,`fid`,`name`,`url`,`logo`,`descrip`,`list`,`ifhide`,`iswordlink`,`hits`,`posttime`,`uid`,`username`,`yz`,`endtime`)VALUES('15','5','广州国微软件','http://php168.net','','','40','0','0','0','0','0','','1','0');
INSERT INTO `p8_friendlink_link` (`id`,`fid`,`name`,`url`,`logo`,`descrip`,`list`,`ifhide`,`iswordlink`,`hits`,`posttime`,`uid`,`username`,`yz`,`endtime`)VALUES('16','5','国微内网方案','http://bbs.php168.net/read-bbs-tid-351939.html','','','0','0','0','0','0','0','','1','0');
INSERT INTO `p8_friendlink_link` (`id`,`fid`,`name`,`url`,`logo`,`descrip`,`list`,`ifhide`,`iswordlink`,`hits`,`posttime`,`uid`,`username`,`yz`,`endtime`)VALUES('17','5','国微千万级负载报告','http://bbs.php168.net/read-bbs-tid-337244.html','','','36','0','0','0','0','0','','1','0');
INSERT INTO `p8_friendlink_link` (`id`,`fid`,`name`,`url`,`logo`,`descrip`,`list`,`ifhide`,`iswordlink`,`hits`,`posttime`,`uid`,`username`,`yz`,`endtime`)VALUES('18','5','媒体报道','http://www.php168.net/about/news.html','','','34','0','0','0','0','0','','1','0');
INSERT INTO `p8_friendlink_link` (`id`,`fid`,`name`,`url`,`logo`,`descrip`,`list`,`ifhide`,`iswordlink`,`hits`,`posttime`,`uid`,`username`,`yz`,`endtime`)VALUES('19','5','国微售后提报','http://www.php168.net/','','','32','0','0','0','0','0','','1','0');
INSERT INTO `p8_friendlink_link` (`id`,`fid`,`name`,`url`,`logo`,`descrip`,`list`,`ifhide`,`iswordlink`,`hits`,`posttime`,`uid`,`username`,`yz`,`endtime`)VALUES('20','5','国微教程中心','/help','','','30','0','0','0','0','0','','1','0');
INSERT INTO `p8_friendlink_link` (`id`,`fid`,`name`,`url`,`logo`,`descrip`,`list`,`ifhide`,`iswordlink`,`hits`,`posttime`,`uid`,`username`,`yz`,`endtime`)VALUES('21','5','国微系统版权','http://www.php168.net/','','','28','0','0','0','0','0','','1','0');
INSERT INTO `p8_friendlink_link` (`id`,`fid`,`name`,`url`,`logo`,`descrip`,`list`,`ifhide`,`iswordlink`,`hits`,`posttime`,`uid`,`username`,`yz`,`endtime`)VALUES('22','5','国微内网方案','http://www.php168.net','','','38','0','0','0','0','0','','1','0');
INSERT INTO `p8_friendlink_link` (`id`,`fid`,`name`,`url`,`logo`,`descrip`,`list`,`ifhide`,`iswordlink`,`hits`,`posttime`,`uid`,`username`,`yz`,`endtime`)VALUES('23','6','下载资料','http://www.php168.net','','','0','0','0','0','0','0','','1','0');
DROP TABLE IF EXISTS `p8_friendlink_sort`;
CREATE TABLE `p8_friendlink_sort` (
  `fid` mediumint(7) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `list` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
INSERT INTO `p8_friendlink_sort` (`fid`,`name`,`list`)VALUES('5','友情链接','10');
INSERT INTO `p8_friendlink_sort` (`fid`,`name`,`list`)VALUES('6','合作伙伴','3');
