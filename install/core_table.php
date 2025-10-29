-- <?php exit;?>

CREATE TABLE `p8_member` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `username` varchar(50) NOT NULL default '',
  `password` varchar(128) NOT NULL default '',
  `salt` varchar(10) NOT NULL default '',
  `number` varchar(20) NOT NULL default '',
  `email` varchar(40) NOT NULL default '',
  `name` varchar(50) NOT NULL default '',
  `phone` varchar(20) NOT NULL default '',
  `cell_phone` varchar(11) NOT NULL default '',
  `address` varchar(50) NOT NULL default '',
  `fax` varchar(20) NOT NULL default '',
  `qq` varchar(12) NOT NULL default '',
  `msn` varchar(50) NOT NULL default '',
  `gender` tinyint(1) NOT NULL default '1',
  `birthday` int(11) NOT NULL default '0',
  `icon` varchar(150) NOT NULL default '',
  `role_id` smallint(5) unsigned NOT NULL default '0',
  `role_gid` smallint(5) unsigned NOT NULL default '0',
  `last_role_id` smallint(5) unsigned NOT NULL default '0',
  `is_admin` tinyint(1) unsigned NOT NULL default '0',
  `is_founder` tinyint(1) unsigned NOT NULL default '0',
  `friend_setting` tinyint(1) unsigned NOT NULL default '0',
  `friends` smallint(5) unsigned NOT NULL default '0',
  `new_messages` int(10) unsigned NOT NULL default '0',
  `status` tinyint(1) unsigned NOT NULL default '0',
  `register_time` int(10) unsigned NOT NULL default '0',
  `last_change_password` int(10) unsigned NOT NULL default '0',
  `register_ip` varchar(15) NOT NULL default '',
  `last_login_ip` varchar(15) NOT NULL default '',
  `pinyin` varchar(50) NOT NULL default '',
  `last_login` int(10) unsigned NOT NULL default '0',
  `login_time` smallint(5) unsigned NOT NULL default '0',
  `display_order` smallint(5) unsigned NOT NULL default '0',
  `memo` varchar(255) NOT NULL DEFAULT '',
  `homepage` varchar(255) NOT NULL DEFAULT '',
  `school`  varchar(255) NOT NULL DEFAULT '',
  `dept` VARCHAR(30) NOT NULL DEFAULT '',
  `is_email_manager` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  KEY `role_gid` (`role_gid`),
  KEY `is_admin` (`is_admin`),
  KEY `is_founder` (`is_founder`),
  KEY `cell_phone` (`cell_phone`)
) ENGINE=MyISAM;

CREATE TABLE `p8_role_group_field` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `gid` smallint(5) unsigned NOT NULL default '0',
  `name` varchar(30) NOT NULL default '',
  `alias` varchar(50) NOT NULL default '',
  `type` varchar(20) NOT NULL default '',
  `not_null` tinyint(1) unsigned NOT NULL default '0',
  `length` varchar(10) NOT NULL default '',
  `is_unsigned` tinyint(3) unsigned NOT NULL default '0',
  `default_value` varchar(100) NOT NULL default '',
  `data` text NOT NULL,
  `widget` varchar(20) NOT NULL default '',
  `widget_addon_attr` varchar(255) NOT NULL default '',
  `display_order` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`gid`,`name`)
) ENGINE=MyISAM;

CREATE TABLE `p8_role_group` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `registrable` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `default_role` smallint(5) unsigned NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL DEFAULT '',
  `display_order` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE `p8_role` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `system` varchar(30) NOT NULL default 'core',
  `type` enum('system','normal') NOT NULL default 'normal',
  `gid` smallint(5) unsigned NOT NULL default '0',
  `name` varchar(20) NOT NULL default '',
  `icon` varchar(50) NOT NULL default '',
  `display_order` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

CREATE TABLE `p8_acl` (
  `system` varchar(30) NOT NULL DEFAULT '',
  `module` varchar(50) NOT NULL DEFAULT '',
  `role_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `postfix` varchar(30) NOT NULL DEFAULT '',
  `v` text NOT NULL,
  PRIMARY KEY (`system`,`module`,`role_id`,`postfix`)
) ENGINE=MyISAM;

CREATE TABLE `p8_admin_menu` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `system` varchar(30) NOT NULL default '',
  `module` varchar(50) NOT NULL default '',
  `action` varchar(50) NOT NULL default '',
  `parent` mediumint(8) unsigned NOT NULL default '0',
  `name` varchar(30) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `target` varchar(10) NOT NULL default '',
  `display` tinyint(1) unsigned NOT NULL default '1',
  `front` tinyint(1) NOT NULL default '0',
  `frequent` tinyint(1) NOT NULL default '0',
  `display_order` mediumint(8) unsigned NOT NULL default '0',
  `menu_icon` varchar(20) NOT NULL default 'fa-codepen',
  PRIMARY KEY  (`id`),
  KEY `system` (`system`,`module`)
) ENGINE=MyISAM;

CREATE TABLE `p8_member_menu` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `system` varchar(30) NOT NULL default '',
  `module` varchar(50) NOT NULL default '',
  `action` varchar(50) NOT NULL default '',
  `parent` mediumint(8) unsigned NOT NULL default '0',
  `color` varchar(7) NOT NULL default '',
  `name` varchar(30) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `target` varchar(10) NOT NULL default '',
  `display` tinyint(1) unsigned NOT NULL default '1',
  `front` tinyint(1) NOT NULL default '0',
  `display_order` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `system` (`system`,`module`)
) ENGINE=MyISAM;

CREATE TABLE `p8_homepage_menu` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `system` varchar(30) NOT NULL default '',
  `module` varchar(50) NOT NULL default '',
  `action` varchar(50) NOT NULL default '',
  `parent` mediumint(8) unsigned NOT NULL default '0',
  `name` varchar(30) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `target` varchar(10) NOT NULL default '',
  `display` tinyint(1) unsigned NOT NULL default '1',
  `front` tinyint(1) NOT NULL default '0',
  `display_order` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `system` (`system`,`module`)
) ENGINE=MyISAM;

CREATE TABLE `p8_credit` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `unit` varchar(4) NOT NULL DEFAULT '',
  `icon` varchar(20) NOT NULL DEFAULT '',
  `is_unsigned` tinyint(1) unsigned NOT NULL,
  `default_value` varchar(20) NOT NULL DEFAULT '0',
  `float_bit` tinyint(3) unsigned NOT NULL default '0',
  `float_point` tinyint(3) unsigned NOT NULL default '0',
  `roe` text NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE `p8_navigation_menu` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `system` varchar(30) NOT NULL default '',
  `module` varchar(50) NOT NULL default '',
  `color` varchar(10) NOT NULL default '',
  `parent` mediumint(8) unsigned NOT NULL default '0',
  `name` varchar(30) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `dynamic_url` varchar(255) NOT NULL default '',
  `target` varchar(10) NOT NULL default '',
  `display` tinyint(1) unsigned NOT NULL default '1',
  `display_order` mediumint(8) unsigned NOT NULL default '0',
  `summary` text NOT NULL DEFAULT '',
  `frame` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `system` (`system`,`module`)
) ENGINE=MyISAM;

CREATE TABLE `p8_config` (
  `system` varchar(30) NOT NULL default '',
  `module` varchar(50) NOT NULL default '',
  `type` varchar(10) NOT NULL default 'string',
  `k` varchar(50) NOT NULL default '',
  `v` mediumtext NOT NULL DEFAULT '',
  PRIMARY KEY  (`system`,`module`,`k`)
) ENGINE=MyISAM;

CREATE TABLE `p8_cache` (
  `path` varchar(30) NOT NULL default '',
  `name` varchar(50) NOT NULL default '',
  `id` varchar(50) NOT NULL default '',
  `v` mediumtext NOT NULL DEFAULT '',
  PRIMARY KEY  (`path`,`name`, `id`)
) ENGINE=MyISAM;

CREATE TABLE `p8_module` (
  `system` varchar(30) NOT NULL default '',
  `name` varchar(50) NOT NULL default '',
  `alias` varchar(30) NOT NULL default '',
  `class` varchar(30) NOT NULL default '',
  `controller_class` varchar(50) NOT NULL default '',
  `installed` tinyint(1) unsigned NOT NULL default '0',
  `enabled` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`system`,`name`)
) ENGINE=MyISAM;

CREATE TABLE `p8_plugin` (
  `name` varchar(50) NOT NULL default '',
  `alias` varchar(30) NOT NULL default '',
  `class` varchar(30) NOT NULL default '',
  `installed` tinyint(1) unsigned NOT NULL default '0',
  `enabled` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM;

CREATE TABLE `p8_session` (
  `id` varchar(32) NOT NULL default '',
  `uid` mediumint(7) unsigned NOT NULL default '0',
  `username` varchar(50) NOT NULL default '',
  `system` varchar(20) NOT NULL default '',
  `module` varchar(30) NOT NULL default '',
  `action` varchar(25) NOT NULL default '',
  `item_id` int(10) unsigned NOT NULL default '0',
  `ip` varchar(15) NOT NULL default '',
  `lastview` int(10) unsigned NOT NULL default '0',
  `data1` text NOT NULL DEFAULT '',
  `data2` text NOT NULL DEFAULT '',
  `data3` text NOT NULL DEFAULT '',
  `data4` text NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`),
  KEY `lastview` (`lastview`),
  KEY `uid` (`uid`)
) ENGINE=MEMORY;

CREATE TABLE `p8_system` (
  `name` varchar(30) NOT NULL default '',
  `alias` varchar(30) NOT NULL default '',
  `table_prefix` varchar(20) NOT NULL default '',
  `class` varchar(30) NOT NULL default '',
  `controller_class` varchar(50) NOT NULL default '',
  `installed` tinyint(1) unsigned NOT NULL default '0',
  `enabled` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM;

CREATE TABLE `p8_message` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(50) NOT NULL default '',
  `othername` varchar(20) NOT NULL default '',
  `sender_uid` mediumint(8) unsigned NOT NULL,
  `sendee_uid` mediumint(8) unsigned NOT NULL,
  `role_id` smallint(5) unsigned NOT NULL default '0',
  `type` enum('in','out','rubbish','draft','important') NOT NULL,
  `title` varchar(100) NOT NULL default '',
  `content` text NOT NULL DEFAULT '',
  `new` tinyint(1) unsigned NOT NULL default '0',
  `timestamp` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `sendee_uid` (`sendee_uid`,`timestamp`),
  KEY `sender_uid` (`sender_uid`,`timestamp`)
) ENGINE=MyISAM;

CREATE TABLE `p8_label` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `system` varchar(30) NOT NULL default '',
  `module` varchar(50) NOT NULL default '',
  `site` varchar(50) NOT NULL default '',
  `env` varchar(50) NOT NULL default '',
  `source_system` varchar(30) NOT NULL default '',
  `source_module` varchar(50) NOT NULL default '',
  `name` varchar(50) NOT NULL default '',
  `type` varchar(20) NOT NULL default '',
  `option` text NOT NULL DEFAULT '',
  `content` text NOT NULL DEFAULT '',
  `invoke` text NOT NULL DEFAULT '',
  `variable` tinyint(1) unsigned NOT NULL default '0',
  `timestamp` int(10) unsigned NOT NULL default '0',
  `last_update` int(10) unsigned NOT NULL default '0',
  `ttl` mediumint(8) NOT NULL default '0',
  `postfix` varchar(20) NOT NULL default '',
  `update_time` int(10) unsigned NOT NULL default '0',
  `last_setter` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `system` (`system`,`module`,`postfix`, `name`, `site`,`env`),
  KEY `name` (`name`),
  KEY `site` (`site`),
  KEY `source` (`source_system`,`source_module`)
) ENGINE=MyISAM;

CREATE TABLE `p8_area` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `parent` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` varchar(40) NOT NULL DEFAULT '',
  `display_order` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

CREATE TABLE `p8_filter_word` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `filter_word` varchar(100) NOT NULL DEFAULT '',
  `aid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL default '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `filter_word` (`filter_word`)
) ENGINE=MyISAM;

CREATE TABLE `p8_sphinx` (
  `id` varchar(50) NOT NULL,
  `max_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

CREATE TABLE `p8_pagecache` (
  `id` varchar(32) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `data` mediumtext NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;


CREATE TABLE `p8_admin_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ip`  varchar(20) NOT NULL DEFAULT '',
  `username` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(40) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `system` varchar(30) NOT NULL DEFAULT '',
  `module` varchar(30) NOT NULL DEFAULT '',
  `action` varchar(30) NOT NULL DEFAULT '',
  `site` varchar(30) NOT NULL DEFAULT '',
  `iid` int(11) NOT NULL DEFAULT '0',
  `cid` int(11) NOT NULL DEFAULT '0',
  `data` mediumtext NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`, `timestamp`)
) ENGINE=MyISAM;

CREATE TABLE `p8_homepage_block` (
  `name` varchar(60) NOT NULL DEFAULT '',
  `system` varchar(20) NOT NULL DEFAULT '',
  `module` varchar(50) NOT NULL DEFAULT '',
  `method` varchar(20) NOT NULL DEFAULT '',
  `alias` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`name`),
  KEY `system` (`system`,`module`)
) ENGINE=MyISAM;

CREATE TABLE `p8_homepage_view` (
  `uid` mediumint(8) unsigned NOT NULL,
  `view_uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `view_username` varchar(20) NOT NULL default '',
  `timestamp` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY (`uid`,`view_uid`),
  KEY `view_uid` (`view_uid`,`timestamp`)
) ENGINE=MyISAM;

CREATE TABLE `p8_item_verify_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(30) NOT NULL DEFAULT '',
  `iid` int(11) NOT NULL DEFAULT 0,
  `step` int(11) NOT NULL DEFAULT 0,
  `step_title` varchar(60) NOT NULL DEFAULT '',
  `operator` varchar(30) NOT NULL DEFAULT '',
  `update_time` int(11) NOT NULL DEFAULT 0,
  `reason` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;