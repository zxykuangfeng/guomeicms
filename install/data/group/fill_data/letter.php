-- <?php exit;?>
CREATE TABLE IF NOT EXISTS `p8_letter_item` (
	`id` int(11) NOT NULL auto_increment,
	`department` smallint(5) NOT NULL,
	`type` tinyint(3) NOT NULL,
	`visual` tinyint(1) NOT NULL default '0',
	`undisplay`  tinyint(1) NOT NULL DEFAULT '0',
	`vefify`  tinyint(1) NOT NULL DEFAULT '0',
	`number` varchar(20) NOT NULL,
	`uid` int(11) NOT NULL default '0',
	`username` varchar(30) NOT NULL default '',
	`code` char(32) NOT NULL default '',
	`gender` tinyint(1) NOT NULL default '0',
	`age` tinyint(3)  NOT NULL default '0',
	`phone` varchar(16) NOT NULL default '',
	`ip` varchar(20) NOT NULL default '',
	`email` varchar(100) NOT NULL default '',
	`id_type` tinyint(2) NOT NULL default '0',
	`id_num` varchar(30) NOT NULL default '',
	`source` tinyint(1) NOT NULL default '0',
	`profession` varchar(30) NOT NULL default '',
	`education` varchar(30) NOT NULL default '',
	`address`  varchar(100) NOT NULL default '',
	`title` varchar(60) NOT NULL default '',
	`create_time` int(11) NOT NULL default '0',
	`update_time` int(11) NOT NULL default '0',
	`status` tinyint(1) NOT NULL default '0',
	`status_change_time` int(11) NOT NULL default '0',
	`askable` tinyint(1) NOT NULL default '0',
	`log` text NOT NULL,
	`solve_time` int(11) NOT NULL default '0',
	`solve_uid` int(11) NOT NULL default '0',
	`solve_department` int(11) NOT NULL default '0',
	`solve_name` varchar(30) NOT NULL,
	`comment` int(1) NOT NULL default '0',
	`comment_time` int(11) NOT NULL default '0',
	`finish_time` int(11) NOT NULL default '0',
	`finish_name`  varchar(30) NOT NULL default '',
	`fengfa` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `create_time` (`create_time`),
  KEY `department` (`department`,`type`)
);

CREATE TABLE IF NOT EXISTS `p8_letter_data` (
	`id` int(11) NOT NULL auto_increment,
	`item_id` int(11) NOT NULL default '0',
	`level` tinyint(1) NOT NULL default '0',
	`attachment_name` varchar(30) NOT NULL default '',
	`attachment` varchar(255) NOT NULL default '',
	`add_time` int(11) NOT NULL default '0',
	`content` text NOT NULL,
	`reply_uid` int(11) NOT NULL default '0',
	`reply_name` varchar(30) NOT NULL,
	`reply_department` smallint(5) NOT NULL,
	`reply_time` int(11) NOT NULL,
	`reply` text NOT NULL,
	`turntig` text NOT NULL,
	`vefify_content` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `item_id` (`item_id`)
);

CREATE TABLE IF NOT EXISTS `p8_letter_cat` (
`id` int(11) NOT NULL auto_increment,
`type` tinyint(1) NOT NULL default '0',
`name` varchar(30) NOT NULL default '',
`num` int(11) NOT NULL default '0',
PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `p8_letter_department` (
`id` int(11) NOT NULL auto_increment,
`pid` int(11) NOT NULL default '0',
`name` varchar(30) NOT NULL default '',
`num` int(11) NOT NULL default '0',
`desc` varchar(255) NOT NULL default '',
PRIMARY KEY  (`id`)
);
REPLACE INTO `p8_letter_cat` (`id`, `type`, `name`, `num`) VALUES
(1, 1, '综合部门', 0),
(5, 2, '建议', 0),
(3, 2, '咨询', 1),
(4, 2, '投诉', 2),
(6, 1, '后勤', 1),
(7, 1, '学生处', 2);
REPLACE INTO `p8_letter_data` (`id`, `item_id`, `level`, `attachment_name`, `attachment`, `add_time`, `content`, `reply_uid`, `reply_name`, `reply_department`, `reply_time`, `reply`, `turntig`, `vefify_content`) VALUES
(1, 1, 0, '', '', 1531203411, '全国人大常委会组成人员热议人民陪审员法草案全国人大常委会组成人员热议人民陪审员法草案全国人大常委会组成人员热议人民陪审员法草案', 1, 'admin', 6, 1531209618, '', '', ''),
(2, 2, 0, '', '', 1531203439, '全国人大常委会组成人员热议人民陪审员法草案全国人大常委会组成人员热议人民陪审员法草案全国人大常委会组成人员热议人民陪审员法草案', 1, 'admin', 6, 1531209540, '', '', ''),
(3, 3, 0, '', '', 1531203470, '全国人大常委会组成人员热议人民陪审员法草案全国人大常委会组成人员热议人民陪审员法草案全国人大常委会组成人员热议人民陪审员法草案', 1, 'admin', 7, 1531213620, '', '', ''),
(4, 4, 0, '', '', 1531203502, '全国人大常委会组成人员热议人民陪审员法草案全国人大常委会组成人员热议人民陪审员法草案全国人大常委会组成人员热议人民陪审员法草案', 1, 'admin', 6, 1531210111, '', '', ''),
(5, 5, 0, '', '', 1531759624, 'tester123tester123tester123tester123tester123tester123tester123tester123tester123tester123tester123tester123tester123tester123tester123tester123', 1, 'admin', 6, 1531759674, 'fdasfdstester123tester123tester123tester123tester123tester123tester123', '', '');
REPLACE INTO `p8_letter_item` (`id`, `department`, `type`, `visual`, `undisplay`, `vefify`, `number`, `uid`, `username`, `code`, `gender`, `age`, `recommend`, `phone`, `ip`, `email`, `id_type`, `id_num`, `source`, `profession`, `education`, `address`, `title`, `create_time`, `update_time`, `status`, `status_change_time`, `askable`, `log`, `solve_time`, `solve_uid`, `solve_department`, `solve_name`, `comment`, `comment_time`, `finish_time`, `finish_name`, `fengfa`) VALUES
(1, 6, 5, 1, 0, 0, '201807101416518079', 1, '终审', '43159', 1, 45, 0, '4343433', '127.0.0.1', 'admin@admin.com', 1, '445465632435', 0, '机械师', '', 'fjdkfdadfdasf', '全国人大常委会组成人员热议人民陪审员法草案', 1531203411, 0, 2, 1531209618, 0, '<br/>[2018-07-10 16:00]admin把此信件转到部门:后勤<br/>[2018-07-10 16:00]admin信件处理', 0, 1, 6, 'admin', 0, 0, 0, '', 1),
(2, 6, 3, 1, 0, 0, '201807101417195688', 1, 'admin2', '27091', 1, 88, 0, '15697786868', '127.0.0.1', 'admin9@admin9.com', 0, '4553387878686', 0, '机械', '', '全国人大常委会组成人员热议人民陪审员法草案', '全国人大常委会组成人员热议人民陪审员法草案', 1531160220, 0, 2, 1531329621, 0, '<br/>[2018-07-10 15:59]admin把此信件转到部门:后勤<br/>[2018-07-10 15:59]admin处理此信件。<br/>[2018-07-10 15:59]admin信件处理<br/>[2018-07-12 01:12]admin信件处理<br/>[2018-07-12 01:20]admin信件处理', 0, 1, 6, 'admin', 0, 0, 0, '', 1),
(3, 7, 5, 1, 1, 0, '201807101417502958', 1, 'tester123', '24691', 1, 45, 1, '15697786868', '127.0.0.1', 'testyu123@testyu123.com', 0, '4553387878686', 0, '机械师2', '', '全国人大常委会组成人员热议人民陪审员法草案', '全国人大常委会组成人员热议人民陪审员法草案23', 1531160220, 0, 2, 1531329139, 0, '<br/>[2018-07-10 15:29]admin把此信件转到部门:学生处<br/>[2018-07-10 15:29]admin处理此信件。<br/>[2018-07-10 15:29]admin信件处理<br/>[2018-07-10 16:16]admin信件处理<br/>[2018-07-10 16:16]admin信件处理<br/>[2018-07-10 16:16]admin信件处理<br/>[2018-07-10 16:19]admin信件处理<br/>[2018-07-10 17:07]admin处理此信件。<br/>[2018-07-10 17:07]admin信件处理<br/>[2018-07-12 00:20]admin信件处理<br/>[2018-07-12 00:24]admin信件处理<br/>[2018-07-12 00:25]admin信件处理<br/>[2018-07-12 00:25]admin信件处理<br/>[2018-07-12 01:12]admin信件处理', 0, 1, 7, 'admin', 0, 0, 0, '', 1),
(4, 6, 3, 1, 1, 1, '201807101418229492', 1, 'editor123', '19407', 1, 45, 0, '15697786868', '127.0.0.1', 'admin2018@com.com', 0, '4553387878686', 0, '机械师', '', '全国人大常委会组成人员热议人民陪审员法草案55', '全国人大常委会组成人员热议人民陪审员法草案5', 1531203502, 0, 3, 1531210111, 0, '<br/>[2018-07-10 15:17]admin信件处理<br/>[2018-07-10 15:29]admin把此信件转到部门:后勤<br/>[2018-07-10 15:29]admin处理此信件。<br/>[2018-07-10 15:29]admin信件处理<br/>[2018-07-10 16:07]admin处理完毕此信件。<br/>[2018-07-10 16:07]admin信件处理<br/>[2018-07-10 16:08]admin处理完毕此信件。<br/>[2018-07-10 16:08]admin信件处理', 1531210111, 1, 6, 'admin', 0, 0, 0, '', 1),
(5, 6, 5, 1, 0, 0, '201807170047044958', 2, 'tester123', '66659', 1, 23, 0, '21234323433', 'unknown', '4df@tester123.com', 0, '', 0, '4324', '', 'tester123tester123', 'tester123tester123tester123', 1531802820, 0, 2, 1531759674, 0, '<br/>[2018-07-17 00:47]admin把此信件转到部门:后勤<br/>[2018-07-17 00:47]admin处理此信件。<br/>[2018-07-17 00:47]admin信件处理', 0, 1, 6, 'admin', 0, 0, 0, '', 1);
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','letter','string','template','');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','letter','string','redepartment','1');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','letter','string','receive','1');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','letter','string','mobile_template','mobile/school');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','letter','string','hong','7');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','letter','string','huan','3');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','letter','string','undisplay','0');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','letter','string','status', '0'),
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','letter','string','mobile_confirm', '0'),
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','letter','string','display_model', '0'),
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','letter','string','finish_days', '3');