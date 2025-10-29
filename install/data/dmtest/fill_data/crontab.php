-- <?php exit;?>

DROP TABLE IF EXISTS `p8_crontab_`;
CREATE TABLE `p8_crontab_` (
  `id` mediumint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `script` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `next_run_time` int(10) unsigned NOT NULL DEFAULT 0,
  `last_run_time` int(10) unsigned NOT NULL DEFAULT 0,
  `day` mediumint(4) unsigned NOT NULL DEFAULT 0,
  `week` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `month` tinyint(2) NOT NULL DEFAULT 0,
  `hour` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `minute` tinyint(2) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `script` (`script`),
  KEY `next_run_time` (`status`,`next_run_time`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
INSERT INTO `p8_crontab_` (`id`,`name`,`script`,`status`,`next_run_time`,`last_run_time`,`day`,`week`,`month`,`hour`,`minute`)VALUES('1','清除SESSION','clear_session.php','1','1570100400','1570060143','0','0','0','12','0');
INSERT INTO `p8_crontab_` (`id`,`name`,`script`,`status`,`next_run_time`,`last_run_time`,`day`,`week`,`month`,`hour`,`minute`)VALUES('2','清除过期角色','expired_buy_role.php','1','1570118400','1570067370','1','0','0','0','0');
INSERT INTO `p8_crontab_` (`id`,`name`,`script`,`status`,`next_run_time`,`last_run_time`,`day`,`week`,`month`,`hour`,`minute`)VALUES('3','定时静态PC版首页','cms_index_to_html.php','1','1643358300','1643358034','0','0','0','0','5');
INSERT INTO `p8_crontab_` (`id`,`name`,`script`,`status`,`next_run_time`,`last_run_time`,`day`,`week`,`month`,`hour`,`minute`)VALUES('5','定时静态移动版首页',' cms_index_to_html_mobile.php','1','1644716340','1644715464','0','0','0','0','15');
INSERT INTO `p8_crontab_` (`id`,`name`,`script`,`status`,`next_run_time`,`last_run_time`,`day`,`week`,`month`,`hour`,`minute`)VALUES('6','计划任务自动备份数据','db_backup.php','0','1569945600','0','7','0','0','0','0');
INSERT INTO `p8_crontab_` (`id`,`name`,`script`,`status`,`next_run_time`,`last_run_time`,`day`,`week`,`month`,`hour`,`minute`)VALUES('7','模块缓存','system_module_cache.php','1','1644750000','1644715483','0','0','0','10','0');
INSERT INTO `p8_crontab_` (`id`,`name`,`script`,`status`,`next_run_time`,`last_run_time`,`day`,`week`,`month`,`hour`,`minute`)VALUES('8','自动静态子站栏目','sites_list_to_html.php?site=school01&cid=12865','0','1565751600','0','0','0','0','1','0');
INSERT INTO `p8_crontab_` (`id`,`name`,`script`,`status`,`next_run_time`,`last_run_time`,`day`,`week`,`month`,`hour`,`minute`)VALUES('9','静态主站栏目','cms_list_to_html.php?cid=831,49','1','1570071600','1570068122','0','0','0','1','0');
