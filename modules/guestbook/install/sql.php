-- <?php exit;?>
CREATE TABLE `p8_category` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL DEFAULT '',
  `ifclose` smallint(2) NOT NULL DEFAULT '0',
  `ifcaptcha` smallint(2) NOT NULL DEFAULT '0',
  `display_order` smallint(3) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `p8_` (
  `id` int(7) NOT NULL auto_increment,
  `cid` mediumint(7) NOT NULL default '0',
  `uid` int(7) NOT NULL default '0',
  `username` varchar(30) NOT NULL default '',
  `email` varchar(50) NOT NULL default '',
  `ip` varchar(15) NOT NULL default '',
  `ico` tinyint(2) NOT NULL default '0',
  `oicq` varchar(11) default '' NOT NULL,
  `weburl` varchar(150) NOT NULL default '',
  `blogurl` varchar(150) NOT NULL default '',
  `telephone` varchar(15) default NULL,
  `title` varchar(50) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `verified` tinyint(1) NOT NULL default '0',
  `ifhide` smallint(1) default NULL,
  `posttime` int(10) NOT NULL default '0',
  `list` int(10) NOT NULL default '0',
  `digg` int(5) NOT NULL default '0',
  `trample` int(5) NOT NULL default '0',
  `reply` text NOT NULL,
  `replytime` varchar(11) default NULL,
  `replyer` varchar(30) default NULL,
  PRIMARY KEY  (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
