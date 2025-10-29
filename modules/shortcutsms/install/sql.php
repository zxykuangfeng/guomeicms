-- <?php exit;?>

CREATE TABLE `p8_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` mediumtext NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;


