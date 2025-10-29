-- <?php exit;?>

DROP TABLE IF EXISTS `p8_mail_queue`;
CREATE TABLE `p8_mail_queue` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
