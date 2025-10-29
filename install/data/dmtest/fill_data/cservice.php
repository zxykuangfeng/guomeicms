-- <?php exit;?>

DROP TABLE IF EXISTS `p8_cservice_reply`;
CREATE TABLE `p8_cservice_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `askid` int(11) NOT NULL DEFAULT 0,
  `repid` int(11) NOT NULL DEFAULT 0,
  `uid` int(11) NOT NULL DEFAULT 0,
  `username` varchar(30) NOT NULL DEFAULT '',
  `title` varchar(60) NOT NULL DEFAULT '',
  `frame` varchar(255) NOT NULL DEFAULT '',
  `timestamp` int(11) NOT NULL DEFAULT 0,
  `state` int(1) NOT NULL DEFAULT 0,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','cservice','serialize','cs_category','a:7:{s:17:\"0.461215112494369\";s:9:\"综合问题 \";s:18:\"0.5945602833545108\";s:8:\"学院建议\";s:18:\"0.4329127157751459\";s:8:\"学院投诉\";i:30205;s:8:\"教师评级\";i:31098;s:12:\"科研项目申请\";i:26387;s:8:\"人才推荐\";i:97497;s:14:\"其他咨询与服务\";}');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','cservice','string','template','');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','cservice','string','mobile_template','mobile/foolish');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','cservice','serialize','admin_actions_map','a:2:{s:6:\"config\";s:12:\"模块配置\";s:4:\"list\";s:12:\"内容管理\";}');
