-- <?php exit;?>

DROP TABLE IF EXISTS `p8_sms_data`;
CREATE TABLE `p8_sms_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT 0,
  `phone` varchar(11) NOT NULL DEFAULT '',
  `message` varchar(255) NOT NULL DEFAULT '',
  `timestramp` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
