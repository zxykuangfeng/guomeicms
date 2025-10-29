-- <?php exit;?>
CREATE TABLE IF NOT EXISTS `p8_interview_ask` (
  `id` mediumint(7) NOT NULL AUTO_INCREMENT,
  `sid` mediumint(7) NOT NULL,
  `username` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL DEFAULT '',
  `posttime` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);
CREATE TABLE IF NOT EXISTS `p8_interview_content` (
  `id` mediumint(7) NOT NULL AUTO_INCREMENT,
  `sid` mediumint(7) NOT NULL,
  `sender` tinyint(1) NOT NULL,
  `content` text NOT NULL,
  `posttime` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `p8_interview_picture` (
  `id` mediumint(7) NOT NULL AUTO_INCREMENT,
  `sid` mediumint(7) NOT NULL,
  `url` varchar(255) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `posttime` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `p8_interview_subject` (
  `id` mediumint(7) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `summary` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `picture` varchar(255) NOT NULL DEFAULT '',
  `video` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `gpicture` varchar(255) NOT NULL DEFAULT '',
  `gname` varchar(255) NOT NULL DEFAULT '',
  `gintroduction` text NOT NULL,
  `cpicture` varchar(255) NOT NULL DEFAULT '',
  `cname` varchar(255) NOT NULL DEFAULT '',
  `cintroduction` text NOT NULL,
  `begintime` int(10) NOT NULL DEFAULT '0',
  `endtime` int(10) NOT NULL DEFAULT '0',
  `posttime` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);
REPLACE INTO `p8_label` (`id`,`system`,`module`,`site`,`env`,`source_system`,`source_module`,`name`,`type`,`option`,`content`,`invoke`,`variable`,`timestamp`,`last_update`,`ttl`,`postfix`)VALUES('46','core','opinion','','','core','interview','zxft_con','module_data','a:17:{s:8:\"order_by\";a:0:{}s:8:\"pageable\";s:1:\"0\";s:3:\"ids\";s:0:\"\";s:5:\"limit\";s:1:\"1\";s:8:\"template\";s:16:\"interview/list05\";s:6:\"method\";s:5:\"label\";s:13:\"unset_options\";a:0:{}s:15:\"display_content\";s:1:\"3\";s:4:\"rows\";s:1:\"1\";s:12:\"title_length\";s:2:\"60\";s:9:\"title_dot\";s:1:\"0\";s:14:\"summary_length\";s:3:\"120\";s:7:\"tplcode\";s:0:\"\";s:7:\"bgcolor\";s:0:\"\";s:13:\"allowed_roles\";a:0:{}s:18:\"place_holder_width\";s:2:\"60\";s:19:\"place_holder_height\";s:2:\"20\";}','','$label[zxft_con]','0','1379336830','1458514068','300','opinion');
REPLACE INTO `p8_label` (`id`,`system`,`module`,`site`,`env`,`source_system`,`source_module`,`name`,`type`,`option`,`content`,`invoke`,`variable`,`timestamp`,`last_update`,`ttl`,`postfix`)VALUES('9133','core','','','','core','interview','hdjl-interview_textcon','module_data','a:17:{s:8:\"order_by\";a:0:{}s:8:\"pageable\";s:1:\"0\";s:3:\"ids\";s:0:\"\";s:5:\"limit\";s:1:\"4\";s:8:\"template\";s:16:\"interview/list02\";s:6:\"method\";s:5:\"label\";s:13:\"unset_options\";a:0:{}s:15:\"display_content\";s:0:\"\";s:4:\"rows\";s:1:\"1\";s:12:\"title_length\";s:2:\"60\";s:9:\"title_dot\";s:1:\"0\";s:14:\"summary_length\";s:3:\"120\";s:7:\"tplcode\";s:0:\"\";s:7:\"bgcolor\";s:0:\"\";s:13:\"allowed_roles\";a:0:{}s:18:\"place_holder_width\";s:3:\"100\";s:19:\"place_holder_height\";s:2:\"30\";}','','$label[hdjl-interview_textcon]','0','1440686650','1459407218','300','');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','interview','string','template','');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','interview','string','mobile_template','mobile/foolish');

