-- <?php exit;?>

DROP TABLE IF EXISTS `p8_spider_rule`;
CREATE TABLE `p8_spider_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL DEFAULT '',
  `cid` smallint(5) unsigned NOT NULL DEFAULT 0,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` mediumtext NOT NULL,
  `captured_items` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `p8_spider_item`;
CREATE TABLE `p8_spider_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` mediumint(8) unsigned NOT NULL DEFAULT 0,
  `title` varchar(80) NOT NULL DEFAULT '',
  `pages` smallint(5) unsigned NOT NULL DEFAULT 1,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` mediumtext NOT NULL,
  `captured_items` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `p8_spider_item_addon`;
CREATE TABLE `p8_spider_item_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` mediumint(8) unsigned NOT NULL DEFAULT 0,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`iid`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `p8_spider_category`;
CREATE TABLE `p8_spider_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL DEFAULT '',
  `display_order` tinyint(3) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
