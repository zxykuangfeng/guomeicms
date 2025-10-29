-- <?php exit;?>
CREATE TABLE IF NOT EXISTS `p8_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL DEFAULT '0',
  `phone` varchar(11) NOT NULL DEFAULT '',
  `message` varchar(255) NOT NULL DEFAULT '',
  `timestramp` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
