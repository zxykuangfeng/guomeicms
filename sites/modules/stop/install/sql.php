-- <?php exit;?>

CREATE TABLE `p8_category` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parent` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` varchar(60) NOT NULL DEFAULT '',
  `item_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `display_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `p8_data` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `cid` mediumint(10) unsigned NOT NULL default '0',
  `cname` char(50) NOT NULL default '',
  `site` varchar(255) NOT NULL default '',
  `item_id` int(5) unsigned NOT NULL default '0',
  `sc` char(1) NOT NULL default '',
  `model` char(30) NOT NULL default '',
  `model_alias` char(30) NOT NULL default '',
  `title` char(100) NOT NULL default '',
  `link` varchar(255) NOT NULL default '',
  `data` mediumtext NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL default '0',
  `site_status` text NOT NULL default '',
  `new_id` int(11) NOT NULL DEFAULT '0',
  `from` VARCHAR(20) NOT NULL DEFAULT  'cms',
  `to` VARCHAR(20) NOT NULL DEFAULT  'sites',
  `push_username` VARCHAR( 20 ) NOT NULL DEFAULT  '',
  PRIMARY KEY  (`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

