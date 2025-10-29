-- <?php exit;?>
CREATE TABLE `p8_subject` (
  `id` mediumint(7) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `summary` text NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `picture` varchar(255) NOT NULL DEFAULT '',
  `video` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `gpicture` varchar(255) NOT NULL DEFAULT '',
  `gname` varchar(255) NOT NULL DEFAULT '',
  `gintroduction` text NOT NULL DEFAULT '',
  `cpicture` varchar(255) NOT NULL DEFAULT '',
  `cname` varchar(255) NOT NULL DEFAULT '',
  `cintroduction` text NOT NULL DEFAULT '',
  `begintime` int(10) NOT NULL DEFAULT '0',
  `endtime` int(10) NOT NULL DEFAULT '0',
  `posttime` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);

CREATE TABLE `p8_content` (
  `id` mediumint(7) NOT NULL AUTO_INCREMENT,
  `sid` mediumint(7) NOT NULL DEFAULT '0',
  `sender` tinyint(1) NOT NULL DEFAULT '0',
  `content` text NOT NULL DEFAULT '',
  `posttime` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);

CREATE TABLE `p8_ask` (
  `id` mediumint(7) NOT NULL AUTO_INCREMENT,
  `sid` mediumint(7) NOT NULL DEFAULT '0',
  `username` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL DEFAULT '',
  `posttime` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);

CREATE TABLE `p8_picture` (
  `id` mediumint(7) NOT NULL AUTO_INCREMENT,
  `sid` mediumint(7) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL DEFAULT '',
  `summary` varchar(255) NOT NULL DEFAULT '',
  `posttime` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);


