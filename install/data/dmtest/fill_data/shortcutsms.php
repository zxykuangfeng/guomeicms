-- <?php exit;?>

DROP TABLE IF EXISTS `p8_shortcutsms_data`;
CREATE TABLE `p8_shortcutsms_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` mediumtext NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
INSERT INTO `p8_shortcutsms_data` (`id`,`content`,`timestamp`)VALUES('1','您的信件我们已收到，将尽快为您处理。','1388823153');
INSERT INTO `p8_shortcutsms_data` (`id`,`content`,`timestamp`)VALUES('2','您的信件已处理，请进入平台查询。','1420791910');
