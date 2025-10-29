-- <?php exit;?>
CREATE TABLE `p8_step` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL DEFAULT '',
  `system` varchar(255) NOT NULL DEFAULT '',
  `module` varchar(255) NOT NULL DEFAULT '',
  `postfix` varchar(60) NOT NULL DEFAULT '',
  `num` int(11) NOT NULL DEFAULT 2,
  `desc` varchar(255) NOT NULL DEFAULT '',
  `step_one` varchar(255) NOT NULL DEFAULT '',
  `step_two` varchar(255) NOT NULL DEFAULT '',
  `step_three` varchar(255) NOT NULL DEFAULT '',
  `step_four` varchar(255) NOT NULL DEFAULT '',
  `step_final` varchar(255) NOT NULL DEFAULT '',
  `step_auto` varchar(255) NOT NULL DEFAULT '',
  `timestamp` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `p8_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system` varchar(30) NOT NULL DEFAULT '',
  `module` varchar(30) NOT NULL DEFAULT '',
  `iid` int(11) NOT NULL,
  `prestep` tinyint(1) NOT NULL DEFAULT 0,
  `step` tinyint(1) NOT NULL DEFAULT 0,
  `verifyer` varchar(30) NOT NULL DEFAULT '',
  `verify_time` int(11) NOT NULL DEFAULT 0,
  `reason` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `system` (`system`,`module`,`iid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;