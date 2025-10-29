-- <?php exit;?>
CREATE TABLE IF NOT EXISTS `p8_forms_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `title_color` varchar(100) NOT NULL DEFAULT '',
  `mid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `ip` varchar(16) NOT NULL DEFAULT '',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `list_order` int(10) unsigned NOT NULL DEFAULT '0',
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `recommend` tinyint(1) NOT NULL DEFAULT '0',
  `status` smallint(3) NOT NULL DEFAULT '0',
  `replyer` varchar(20) NOT NULL DEFAULT '',
  `reply_time` int(10) unsigned NOT NULL DEFAULT '0',
  `display_order` int(10) unsigned NOT NULL DEFAULT '0',
  `reply` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`,`list_order`),
  KEY `mid_id` (`mid`,`id`),
  KEY `timestamp` (`timestamp`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
REPLACE INTO `p8_forms_item` (`id`, `title`, `title_color`, `mid`, `uid`, `username`, `ip`, `views`, `timestamp`, `update_time`, `list_order`, `verified`, `recommend`, `status`, `replyer`, `reply_time`, `display_order`, `reply`) VALUES
(4646, '学院常用电话', '', 27, 1, 'admin', '119.44.7.84', 0, 1549083509, 0, 1549083509, 0, 0, 9, '', 0, 0, '');
REPLACE INTO `p8_forms_item` (`id`, `title`, `title_color`, `mid`, `uid`, `username`, `ip`, `views`, `timestamp`, `update_time`, `list_order`, `verified`, `recommend`, `status`, `replyer`, `reply_time`, `display_order`, `reply`) VALUES
(4652, '学院常用电话', '', 27, 29, 'admin5', '113.246.108.26', 0, 1561089752, 0, 1561089752, 0, 0, 9, '', 0, 0, '');
REPLACE INTO `p8_forms_item` (`id`, `title`, `title_color`, `mid`, `uid`, `username`, `ip`, `views`, `timestamp`, `update_time`, `list_order`, `verified`, `recommend`, `status`, `replyer`, `reply_time`, `display_order`, `reply`) VALUES
(4653, '学院常用电话', '', 27, 29, 'admin5', '113.246.108.26', 0, 1561089752, 0, 1561089752, 0, 0, 9, '', 0, 0, '');
REPLACE INTO `p8_forms_item` (`id`, `title`, `title_color`, `mid`, `uid`, `username`, `ip`, `views`, `timestamp`, `update_time`, `list_order`, `verified`, `recommend`, `status`, `replyer`, `reply_time`, `display_order`, `reply`) VALUES
(4654, '学院常用电话', '', 27, 29, 'admin5', '113.246.108.26', 0, 1561089752, 0, 1561089752, 0, 0, 9, '', 0, 0, '');
REPLACE INTO `p8_forms_item` (`id`, `title`, `title_color`, `mid`, `uid`, `username`, `ip`, `views`, `timestamp`, `update_time`, `list_order`, `verified`, `recommend`, `status`, `replyer`, `reply_time`, `display_order`, `reply`) VALUES
(4655, '学院常用电话', '', 27, 29, 'admin5', '113.246.108.26', 0, 1561089752, 0, 1561089752, 0, 0, 9, '', 0, 0, '');
REPLACE INTO `p8_forms_item` (`id`, `title`, `title_color`, `mid`, `uid`, `username`, `ip`, `views`, `timestamp`, `update_time`, `list_order`, `verified`, `recommend`, `status`, `replyer`, `reply_time`, `display_order`, `reply`) VALUES
(4656, '学院常用电话', '', 27, 29, 'admin5', '113.246.108.26', 0, 1561089752, 0, 1561089752, 0, 0, 9, '', 0, 0, '');
REPLACE INTO `p8_forms_item` (`id`, `title`, `title_color`, `mid`, `uid`, `username`, `ip`, `views`, `timestamp`, `update_time`, `list_order`, `verified`, `recommend`, `status`, `replyer`, `reply_time`, `display_order`, `reply`) VALUES
(4657, '图书管理系统', '', 200, 5, 'admin4', '113.218.172.201', 0, 1567040615, 1571638985, 1571638985, 0, 0, 9, '', 0, 0, '');
REPLACE INTO `p8_forms_item` (`id`, `title`, `title_color`, `mid`, `uid`, `username`, `ip`, `views`, `timestamp`, `update_time`, `list_order`, `verified`, `recommend`, `status`, `replyer`, `reply_time`, `display_order`, `reply`) VALUES
(4658, '图书管理系统', '', 200, 5, 'admin4', '113.218.172.201', 0, 1567040643, 1571630677, 1571630677, 0, 0, 9, '', 0, 0, '');
REPLACE INTO `p8_forms_item` (`id`, `title`, `title_color`, `mid`, `uid`, `username`, `ip`, `views`, `timestamp`, `update_time`, `list_order`, `verified`, `recommend`, `status`, `replyer`, `reply_time`, `display_order`, `reply`) VALUES
(4664, '招生平台', '', 68, 1, 'admin', '113.247.21.241', 0, 1583827260, 0, 1583827260, 0, 0, 9, '', 0, 0, '');
REPLACE INTO `p8_forms_item` (`id`, `title`, `title_color`, `mid`, `uid`, `username`, `ip`, `views`, `timestamp`, `update_time`, `list_order`, `verified`, `recommend`, `status`, `replyer`, `reply_time`, `display_order`, `reply`) VALUES
(4660, '图书管理系统', '', 200, 29, 'admin5', '113.218.172.82', 0, 1571622720, 1571638972, 1571638972, 0, 0, 9, '', 0, 0, '');
REPLACE INTO `p8_forms_item` (`id`, `title`, `title_color`, `mid`, `uid`, `username`, `ip`, `views`, `timestamp`, `update_time`, `list_order`, `verified`, `recommend`, `status`, `replyer`, `reply_time`, `display_order`, `reply`) VALUES
(4661, '图书管理系统', '', 200, 29, 'admin5', '113.218.168.127', 0, 1572407443, 0, 1572407443, 0, 0, 9, '', 0, 0, '');
REPLACE INTO `p8_forms_item` (`id`, `title`, `title_color`, `mid`, `uid`, `username`, `ip`, `views`, `timestamp`, `update_time`, `list_order`, `verified`, `recommend`, `status`, `replyer`, `reply_time`, `display_order`, `reply`) VALUES
(4662, '项目库', '', 201, 5, 'admin4', '220.170.143.2', 0, 1576658645, 0, 1576658645, 0, 0, 9, '', 0, 0, '');
REPLACE INTO `p8_forms_item` (`id`, `title`, `title_color`, `mid`, `uid`, `username`, `ip`, `views`, `timestamp`, `update_time`, `list_order`, `verified`, `recommend`, `status`, `replyer`, `reply_time`, `display_order`, `reply`) VALUES
(4663, '项目库', '', 201, 5, 'admin4', '220.170.143.2', 0, 1576658756, 0, 1576658756, 0, 0, 9, '', 0, 0, '');
CREATE TABLE IF NOT EXISTS `p8_forms_item_bybd2` (
  `id` int(10) unsigned NOT NULL,
  `mingcheng` varchar(255) NOT NULL,
  `lxr` varchar(255) NOT NULL,
  `leixing` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `QQ` varchar(255) DEFAULT NULL,
  `dizhi` varchar(255) DEFAULT NULL,
  `wangzhi` varchar(255) DEFAULT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
REPLACE INTO `p8_forms_item_bybd2` (`id`, `mingcheng`, `lxr`, `leixing`, `tel`, `fax`, `email`, `QQ`, `dizhi`, `wangzhi`, `beizhu`) VALUES
(4646, '23423', '234232', '1', '2343242332', '234322332', '2423423', '2343223', '234223', '23432', '23432');
REPLACE INTO `p8_forms_item_bybd2` (`id`, `mingcheng`, `lxr`, `leixing`, `tel`, `fax`, `email`, `QQ`, `dizhi`, `wangzhi`, `beizhu`) VALUES
(4652, '2019', '北京', '', '艺术(文)', '四年', '美术学（师范类）', '5', '', '', '');
REPLACE INTO `p8_forms_item_bybd2` (`id`, `mingcheng`, `lxr`, `leixing`, `tel`, `fax`, `email`, `QQ`, `dizhi`, `wangzhi`, `beizhu`) VALUES
(4653, '2019', '河北', '', '文史类', '四年', '法学', '3', '', '', '');
REPLACE INTO `p8_forms_item_bybd2` (`id`, `mingcheng`, `lxr`, `leixing`, `tel`, `fax`, `email`, `QQ`, `dizhi`, `wangzhi`, `beizhu`) VALUES
(4654, '2019', '河北', '', '理工类', '四年', '法学', '2', '', '', '');
REPLACE INTO `p8_forms_item_bybd2` (`id`, `mingcheng`, `lxr`, `leixing`, `tel`, `fax`, `email`, `QQ`, `dizhi`, `wangzhi`, `beizhu`) VALUES
(4655, '2019', '河北', '', '文史类', '四年', '汉语国际教育（师范类）', '3', '', '', '');
REPLACE INTO `p8_forms_item_bybd2` (`id`, `mingcheng`, `lxr`, `leixing`, `tel`, `fax`, `email`, `QQ`, `dizhi`, `wangzhi`, `beizhu`) VALUES
(4656, '2019', '河北', '', '文史类', '四年', '汉语言文学（师范类）', '2', '', '', '');
CREATE TABLE IF NOT EXISTS `p8_forms_item_bybd4` (
  `id` int(10) unsigned NOT NULL,
  `tibaoren` varchar(255) NOT NULL,
  `chengdu` varchar(255) NOT NULL,
  `baoxsx` varchar(255) NOT NULL,
  `bxjtnr` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `p8_forms_item_bybd6` (
  `id` int(10) unsigned NOT NULL,
  `baofei` varchar(255) DEFAULT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  `cplx` varchar(255) NOT NULL,
  `cpmc` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `hgcp` varchar(255) DEFAULT NULL,
  `nianfen` varchar(255) NOT NULL,
  `sjsl` varchar(255) NOT NULL,
  `tibaoren` varchar(255) NOT NULL,
  `yuefen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `p8_forms_item_kehu` (
  `id` int(10) unsigned NOT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  `bum` varchar(255) NOT NULL,
  `caigou` varchar(255) NOT NULL,
  `csny` varchar(255) NOT NULL,
  `czhm` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `date2` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gaokao` varchar(255) NOT NULL,
  `kaoshenghao` varchar(255) NOT NULL,
  `khjb` varchar(255) NOT NULL,
  `khlb` varchar(255) NOT NULL,
  `khmc` varchar(255) NOT NULL,
  `lianxiren` varchar(255) NOT NULL,
  `QQ` varchar(255) DEFAULT NULL,
  `shouji` varchar(255) NOT NULL,
  `tongxing` varchar(255) NOT NULL,
  `wangzhi` varchar(255) DEFAULT NULL,
  `xingmin` varchar(255) NOT NULL,
  `xingming` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `yuefen` varchar(255) NOT NULL,
  `zycj` varchar(255) DEFAULT NULL,
  `zhuanye` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
REPLACE INTO `p8_forms_item_kehu` (`id`, `beizhu`, `bum`, `caigou`, `csny`, `czhm`, `date`, `date2`, `email`, `gaokao`, `kaoshenghao`, `khjb`, `khlb`, `khmc`, `lianxiren`, `QQ`, `shouji`, `tongxing`, `wangzhi`, `xingmin`, `xingming`, `year`, `yuefen`, `zycj`, `zhuanye`) VALUES
(4664, '24323423', '1', '2', '1584979200', '32423', '1', '234324324', '3432', '23423', '23432', '1', '2', '1', '2343244', '23432', '23432', '23432', '23432', '2342343', '23423', '23432', '2', '234', '55168-87222');
CREATE TABLE IF NOT EXISTS `p8_forms_item_library` (
  `id` int(10) unsigned NOT NULL,
  `state` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `bookcase` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `press` varchar(255) NOT NULL,
  `zhuangtai` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
REPLACE INTO `p8_forms_item_library` (`id`, `state`, `number`, `name`, `price`, `genre`, `bookcase`, `author`, `press`, `zhuangtai`) VALUES
(4657, '1', '8008208820', '三国演义', '100', '历史', '文学', '罗贯中', '中国人民出版社', '一般推荐');
REPLACE INTO `p8_forms_item_library` (`id`, `state`, `number`, `name`, `price`, `genre`, `bookcase`, `author`, `press`, `zhuangtai`) VALUES
(4658, '1', '8008208821', '红楼梦', '100', '历史', '文学', '曹雪芹', '中国人民出版社1', '一般推荐');
REPLACE INTO `p8_forms_item_library` (`id`, `state`, `number`, `name`, `price`, `genre`, `bookcase`, `author`, `press`, `zhuangtai`) VALUES
(4660, '1', 'gw20191021001', '国微软件技能手册', '100', '其他', 'C105', '张国微', '历史出版社', '一般推荐');
REPLACE INTO `p8_forms_item_library` (`id`, `state`, `number`, `name`, `price`, `genre`, `bookcase`, `author`, `press`, `zhuangtai`) VALUES
(4661, '1', '国微', '国微培训手册', '500', '历史', 'C1555', '刘军', '长城出版社', '特级推荐');
CREATE TABLE IF NOT EXISTS `p8_forms_item_project` (
  `id` int(10) unsigned NOT NULL,
  `diqu` varchar(255) NOT NULL,
  `sudi` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `leibie` varchar(255) NOT NULL,
  `touzhi` varchar(255) NOT NULL,
  `niandu` varchar(255) NOT NULL,
  `bianhao` varchar(255) DEFAULT NULL,
  `lxdw` varchar(255) NOT NULL,
  `xiangmuzhuangtai` varchar(255) DEFAULT NULL,
  `beizhu` longtext,
  `fujian` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
REPLACE INTO `p8_forms_item_project` (`id`, `diqu`, `sudi`, `name`, `leibie`, `touzhi`, `niandu`, `bianhao`, `lxdw`, `xiangmuzhuangtai`, `beizhu`, `fujian`) VALUES
(4662, '西宁市', NULL, '牛羊肉加工及废弃物综合利用项目', '轻工农牧业产业化', '1--5亿', '2019', '', '湟源县经济商务和信息化局', '1', '<p>一、项目提出的背景<br />\r\n1、市场分析：该项目立足青海省西宁市丰富的农牧业资源，积极开发青藏高原无污染、绿色、有机的农畜产品，打造绿色品牌，生产绿色产品，对调整农牧业产业结构，提升农畜产品加工科技水平，延长产业链条起着重要的作用。<br />\r\n2、地区优势<br />\r\n（1）产业优势：牛羊肉加工及废弃物综合利用项目，该项目充分利用农畜成品的边角料和畜禽的内脏、骨骼等组织，采用生化工艺将动物组织蛋白、微生物蛋白等经酸、碱、酶水解将蛋白质最终转化为小肽和氨基酸混合物，加工成蛋白胨系列产品。<br />\r\n（2）区位优势：西宁地处青藏高原东北部，地处黄土高原与青藏高原结合部，历史上中原农耕文明与西部草原文化在此相交，是连接藏区与中原地区的重要节点，形成了背靠大牧场、面向大市场的独特优势，为发展该项目提供了广阔的发展空间。<br />\r\n二、主要原材料供应情况<br />\r\n供应量充足。<br />\r\n三、项目基本情况<br />\r\n&nbsp; &nbsp; 建设内容主要包括原料区、生产区、成品区、和其他配套工程等。本项目利用动物杂骨生产工业蛋白胨、骨粒、骨油、骨粉等产品。工业蛋白胨是从生产骨粒的废水中提取的，利用动物杂骨进行深加工。<br />\r\n四、建设条件<br />\r\n&nbsp; 建设地点位于湟源大华工业园区，距离湟源县县城7公里，距离省会城市55公里，315国道、西格铁路穿区而过，区位优势十分明显。<br />\r\n五、现阶段项目进展<br />\r\n&nbsp; 正在招商。<br />\r\n六、投资概算、合作方式及经济效益<br />\r\n&nbsp; 项目总投资20000万元，其中：固定投资资产为13000万元，占总投资的65%；流动资金为7000万元，占总投资的35%。<br />\r\n七、优惠政策<br />\r\n&nbsp; 享受西部大开发优惠政策。<br />\r\n八、联系方式<br />\r\n联系单位：湟源县经济商务和信息化局<br />\r\n联系人：星胜周<br />\r\n电话：0971&mdash;2437834<br />\r\n传真：0971&mdash;2432027<br />\r\n电子邮箱：hyxswj@163.com</p>\r\n', '');
REPLACE INTO `p8_forms_item_project` (`id`, `diqu`, `sudi`, `name`, `leibie`, `touzhi`, `niandu`, `bianhao`, `lxdw`, `xiangmuzhuangtai`, `beizhu`, `fujian`) VALUES
(4663, '西宁市', NULL, '年加工1亿瓶高原特色饮料加工项目', '轻工农牧业产业化', '1--5亿', '2019', '', '湟源县经济商务和信息化局', '1', '<p>一、项目提出的背景<br />\r\n1、市场分析：随着人们生活水平的不断提高，人们对健康的诉求也日益提高，&ldquo;高原特色饮料&rdquo;，正是基于人们的这种诉求开发出的新一代健康饮品，其原料如、沙棘、黑枸杞、胡萝卜等来自天然纯净的青藏高原，因其是公认的高原特色植物，其富含蛋白质、氨基酸、维生素、矿物质、微量元素等多种营养成分，利用先进的冷萃工艺将植物中95%以上的营养元素无破坏的提取出来，做成可以随身携带的饮料，享受健康可以随时随地，高原特色饮料口味独特，老少皆宜，不仅可以消暑解渴，更能补充多种营养元素。<br />\r\n2、地区优势<br />\r\n（1）产业优势：高原特色饮料加工项目，随着居民收入水平的不断提高，饮料生产量和消费量持续增长，消费者对天然、低糖、健康型饮料的需求，促进了果蔬汁饮料、茶饮料、瓶装饮用水、功能型饮料等新品种的崛起。<br />\r\n（2）区位优势：西宁地处青藏高原东北部，地处黄土高原与青藏高原结合部，历史上中原农耕文明与西部草原文化在此相交，是连接藏区与中原地区的重要节点，形成了背靠大牧场、面向大市场的独特优势，为发展该项目提供了广阔的发展空间。<br />\r\n二、主要原材料供应情况<br />\r\n&nbsp; 特色高原植物供应量充足。<br />\r\n三、项目基本情况<br />\r\n&nbsp; &nbsp; 计划总占地面积约为200亩，项目充分利用青藏高原特色植物资源建设高原特色饮料无菌灌装生产线，年加工1亿瓶高原特色饮料生产线一条。<br />\r\n四、建设条件<br />\r\n&nbsp; 建设地点位于湟源大华工业园区，距离湟源县县城7公里，距离省会城市55公里，315国道、西格铁路穿区而过，区位优势十分明显。<br />\r\n五、现阶段项目进展<br />\r\n&nbsp; 正在招商。<br />\r\n六、投资概算、合作方式及经济效益<br />\r\n&nbsp; 项目总投资20000万元，其中：固定投资资产为13000万元，占总投资的65%；流动资金为7000万元，占总投资的35%。<br />\r\n七、优惠政策<br />\r\n&nbsp; &nbsp; 享受西部大开发优惠政策。<br />\r\n八、联系方式<br />\r\n联系单位：湟源县经济商务和信息化局<br />\r\n联系人：星胜周<br />\r\n电话：0971&mdash;2437834<br />\r\n传真：0971&mdash;2432027<br />\r\n电子邮箱：hyxswj@163.com</p>\r\n', '');
CREATE TABLE IF NOT EXISTS `p8_forms_item_xmtj` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `iid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `p8_forms_model`;
CREATE TABLE IF NOT EXISTS `p8_forms_model` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL DEFAULT '',
  `alias` char(30) NOT NULL DEFAULT '',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `verified` varchar(20) NOT NULL DEFAULT '',
  `recommend` tinyint(1) NOT NULL DEFAULT '0',
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  `display_order` int(10) unsigned NOT NULL DEFAULT '0',
  `post_template` varchar(50) NOT NULL DEFAULT '',
  `list_template` varchar(50) NOT NULL DEFAULT '',
  `view_template` varchar(50) NOT NULL DEFAULT '',
  `post_template_mobile` varchar(50) NOT NULL,
  `list_template_mobile` varchar(50) NOT NULL,
  `view_template_mobile` varchar(50) NOT NULL,
  `config` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
REPLACE INTO `p8_forms_model` (`id`, `name`, `alias`, `enabled`, `verified`, `recommend`, `count`, `display_order`, `post_template`, `list_template`, `view_template`, `post_template_mobile`, `list_template_mobile`, `view_template_mobile`, `config`) VALUES
(27, 'bybd2', '学院常用电话', 1, '', 0, 6, 245, 'post_lianxi_2017', 'list_supplier2017', 'view_print', 'list_luqu2', 'list_supplier', '', 'a:1:{s:7:"captcha";s:1:"1";}');
REPLACE INTO `p8_forms_model` (`id`, `name`, `alias`, `enabled`, `verified`, `recommend`, `count`, `display_order`, `post_template`, `list_template`, `view_template`, `post_template_mobile`, `list_template_mobile`, `view_template_mobile`, `config`) VALUES
(29, 'bybd4', '网络IT报修平台', 1, '', 0, 0, 0, '', 'list_status2', 'view_print', '', '', '', 'a:2:{s:7:"captcha";s:1:"1";s:8:"viewself";s:1:"1";}');
REPLACE INTO `p8_forms_model` (`id`, `name`, `alias`, `enabled`, `verified`, `recommend`, `count`, `display_order`, `post_template`, `list_template`, `view_template`, `post_template_mobile`, `list_template_mobile`, `view_template_mobile`, `config`) VALUES
(68, 'kehu', '招生平台', 1, '', 0, 1, 249, 'post_baomin_2017', 'list_supplier2017', 'view_print', '', '', '', 'a:1:{s:5:"parts";a:3:{i:74083;a:3:{s:4:"name";s:12:"基本资料";s:3:"row";s:1:"1";s:5:"order";s:1:"6";}i:15854;a:3:{s:4:"name";s:12:"报考专业";s:3:"row";s:1:"1";s:5:"order";s:1:"3";}s:5:"08206";a:3:{s:4:"name";s:12:"其他资料";s:3:"row";s:1:"1";s:5:"order";s:1:"1";}}}');
REPLACE INTO `p8_forms_model` (`id`, `name`, `alias`, `enabled`, `verified`, `recommend`, `count`, `display_order`, `post_template`, `list_template`, `view_template`, `post_template_mobile`, `list_template_mobile`, `view_template_mobile`, `config`) VALUES
(69, 'bybd6', '录取平台', 1, '', 0, 0, 247, '', 'list_luqu2', 'view_luqujieguo', '', '', '', 'a:1:{s:7:"captcha";s:1:"1";}');
REPLACE INTO `p8_forms_model` (`id`, `name`, `alias`, `enabled`, `verified`, `recommend`, `count`, `display_order`, `post_template`, `list_template`, `view_template`, `post_template_mobile`, `list_template_mobile`, `view_template_mobile`, `config`) VALUES
(199, 'xmtj', 'xmtj', 1, '', 0, 14, 0, '', '', '', '', '', '', 'a:0:{}');
REPLACE INTO `p8_forms_model` (`id`, `name`, `alias`, `enabled`, `verified`, `recommend`, `count`, `display_order`, `post_template`, `list_template`, `view_template`, `post_template_mobile`, `list_template_mobile`, `view_template_mobile`, `config`) VALUES
(200, 'library', '图书管理系统', 1, '', 0, 4, 245, 'post_table', 'list_table', 'view_table', '', '', '', 'a:0:{}');
REPLACE INTO `p8_forms_model` (`id`, `name`, `alias`, `enabled`, `verified`, `recommend`, `count`, `display_order`, `post_template`, `list_template`, `view_template`, `post_template_mobile`, `list_template_mobile`, `view_template_mobile`, `config`) VALUES
(201, 'project', '项目库', 1, '', 0, 2, 0, 'edit_project', 'list_project', 'view_project', '', 'list_project', 'view_project', 'a:0:{}');
CREATE TABLE IF NOT EXISTS `p8_forms_model_field` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(30) NOT NULL DEFAULT '',
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL DEFAULT '',
  `alias` varchar(50) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT '',
  `part` varchar(20) NOT NULL DEFAULT '',
  `list_table` tinyint(1) NOT NULL DEFAULT '0',
  `filterable` tinyint(1) NOT NULL DEFAULT '0',
  `orderby` tinyint(1) NOT NULL DEFAULT '0',
  `not_null` tinyint(1) unsigned NOT NULL,
  `length` varchar(10) NOT NULL DEFAULT '',
  `is_unsigned` tinyint(1) unsigned NOT NULL,
  `editable` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `manager_editable` tinyint(1) DEFAULT '0',
  `default_value` text NOT NULL,
  `data` text NOT NULL,
  `config` text NOT NULL,
  `widget` varchar(50) NOT NULL DEFAULT '',
  `widget_addon_attr` varchar(255) NOT NULL DEFAULT '',
  `display_order` tinyint(3) unsigned NOT NULL,
  `units` varchar(20) NOT NULL,
  `jsreg` varchar(40) NOT NULL DEFAULT '',
  `jsregmsg` varchar(20) NOT NULL DEFAULT '',
  `color` varchar(10) NOT NULL DEFAULT '',
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`model`,`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(83, 'dails', 0, 'dlsxm', '代理商名称', 'varchar', '', 1, 1, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 70, '', '', '', '', '请填入代理商企业名称');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(121, 'dlsdd', 0, 'cwqrdz', '财务确认到账', 'varchar', '14003-1', 0, 1, 0, 0, '255', 0, 1, 0, '', 'a:3:{i:1;s:8:"尚未到账";i:2;s:8:"已经到账";i:3;s:8:"其他状态";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'select', '', 0, '', '', '', '', '请确认代理商提交的款项状态是否已经到账');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(778, 'kehu', 0, 'QQ', 'QQ号码', 'varchar', '08206-1', 0, 0, 0, 0, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 35, '', '', '', '', '请输入您的QQ号码');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(779, 'kehu', 0, 'shouji', '联系电话', 'varchar', '08206-1', 1, 0, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 43, '', '', '', '', '请输入联系人电话与手机号码');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(780, 'kehu', 0, 'tongxing', '通讯地址', 'varchar', '08206-1', 0, 0, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', 'style="width:585px;border:1px soild #ff0000"', 50, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(781, 'kehu', 0, 'wangzhi', '准考证号', 'varchar', '15854-1', 0, 0, 0, 0, '255', 0, 1, 0, '', 'a:1:{s:6:"target";s:5:"_self";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 115, '', '', '', '', '请输入准考证号');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(777, 'kehu', 0, 'lianxiren', '毕业院校', 'varchar', '74083-1', 1, 0, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 240, '', '', '', '', '请输入毕业院校');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(775, 'kehu', 0, 'khlb', '考籍所在地', 'varchar', '15854-1', 1, 0, 0, 1, '255', 0, 1, 0, '', 'a:31:{i:1;s:6:"北京";i:2;s:6:"天津";i:3;s:6:"上海";i:4;s:6:"重庆";i:5;s:6:"河北";i:6;s:6:"河南";i:7;s:6:"山东";i:8;s:6:"山西";i:9;s:6:"安徽";i:10;s:6:"江西";i:11;s:6:"江苏";i:12;s:6:"浙江";i:13;s:6:"湖边";i:14;s:6:"湖南";i:15;s:6:"广东";i:16;s:6:"广西";i:17;s:6:"云南";i:18;s:6:"贵州";i:19;s:6:"四川";i:20;s:6:"陕西";i:21;s:6:"青海";i:22;s:6:"宁夏";i:23;s:6:"吉林";i:24;s:6:"辽宁";i:25;s:6:"西藏";i:26;s:6:"新疆";i:27;s:6:"海南";i:28;s:6:"福建";i:29;s:6:"甘肃";i:30;s:9:"黑龙江";i:31;s:9:"内蒙古";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'select', '', 210, '', '', '', '', '请选择考籍所在地');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(776, 'kehu', 0, 'khmc', '填写志愿和意向', 'varchar', '15854-1', 1, 0, 0, 1, '255', 0, 1, 0, '', 'a:5:{i:1;s:9:"计算机";i:2;s:12:"信息工程";i:3;s:12:"电子商务";i:4;s:12:"经济管理";i:5;s:12:"幼儿师范";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'select', '', 94, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(774, 'kehu', 0, 'khjb', '政治面貌', 'varchar', '74083-1', 0, 0, 0, 1, '255', 0, 1, 0, '', 'a:3:{i:1;s:6:"党员";i:2;s:6:"团员";i:3;s:6:"群众";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'select', '', 238, '', '', '', '', '请选择您的政治面貌');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(783, 'kehu', 0, 'xingming', '收件人姓名', 'varchar', '08206-1', 0, 0, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:8:"vertical";}', 'text', '', 48, '', '', '', '', '请输入您的姓名');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(782, 'kehu', 0, 'xingmin', '姓名', 'varchar', '74083-1', 1, 1, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', 'style="width:185px;border:1px soild #ff0000"', 249, '', '', '', '', '请填入报考人姓名');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(771, 'kehu', 0, 'email', 'e-mail地址', 'varchar', '08206-1', 0, 0, 0, 0, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 40, '', '', '', '', '请输入您的邮箱号码');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(772, 'kehu', 0, 'gaokao', '高考成绩', 'varchar', '15854-1', 0, 0, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 111, '', '', '', '', '请输入高考成绩');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(773, 'kehu', 0, 'kaoshenghao', '考生号', 'varchar', '15854-1', 0, 0, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 113, '', '', '', '', '请输入考生号');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(769, 'kehu', 0, 'date', '专业调剂', 'varchar', '15854-1', 0, 0, 0, 1, '255', 0, 1, 0, '', 'a:2:{i:1;s:12:"服从调剂";i:2;s:15:"不服从调剂";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'select', '', 93, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(770, 'kehu', 0, 'date2', '身份证号码', 'varchar', '74083-1', 1, 1, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 220, '', '', '', '', '请输入身份证号码');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(768, 'kehu', 0, 'czhm', '邮编', 'varchar', '08206-1', 0, 0, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 46, '', '', '', '', '请输入邮编');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(438, 'bybd2', 0, 'mingcheng', '单位名称', 'varchar', '', 1, 1, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 0, '', '', '', '', '请填入联系单位名称');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(439, 'bybd2', 0, 'lxr', '联系人', 'varchar', '', 1, 1, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 0, '', '', '', '', '请填入联系人名称');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(440, 'bybd2', 0, 'leixing', '单位类型', 'varchar', '', 1, 1, 0, 1, '255', 0, 1, 0, '', 'a:3:{s:6:"党委";s:6:"党委";s:12:"党委党委";s:12:"党委党委";s:18:"党委党委党委";s:18:"党委党委党委";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'select', '', 0, '', '', '', '', '请选择该单位所属类型');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(836, 'xmtj', 0, 'name', '姓名', 'varchar', '', 0, 0, 0, 0, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 0, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(837, 'xmtj', 0, 'telephone', '电话', 'varchar', '', 0, 0, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 0, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(441, 'bybd2', 0, 'tel', '电话/手机', 'varchar', '', 1, 0, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 0, '', '', '', '', '请输入联系人电话与手机号码');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(442, 'bybd2', 0, 'fax', '传真号码', 'varchar', '', 1, 0, 0, 0, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 0, '', '', '', '', '请输入联系人传真号码');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(443, 'bybd2', 0, 'email', '邮箱', 'varchar', '', 1, 0, 0, 0, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 0, '', '', '', '', '请输入联系人邮箱');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(444, 'bybd2', 0, 'QQ', 'QQ/MSN', 'varchar', '', 0, 0, 0, 0, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 0, '', '', '', '', '请输入联系人QQ/MSN号码');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(445, 'bybd2', 0, 'dizhi', '具体地址', 'varchar', '', 0, 0, 0, 0, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', 'size="38"', 0, '', '', '', '', '请输入联系单位具体地址');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(446, 'bybd2', 0, 'wangzhi', '网址', 'varchar', '', 0, 0, 0, 0, '255', 0, 1, 0, '', 'a:1:{s:6:"target";s:6:"_blank";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'link', 'size="38"', 0, '', '', '', '', '请输入联系单位的具体网址');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(447, 'bybd2', 0, 'beizhu', '备注说明', 'varchar', '', 0, 0, 0, 0, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'textarea', 'cols="20" rows="6"', 0, '', '', '', '', '如还有相关备注，请输入');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(767, 'kehu', 0, 'csny', '出生年月', 'varchar', '74083-1', 1, 0, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'textdate', '', 244, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(765, 'kehu', 0, 'bum', '性别', 'varchar', '74083-1', 1, 0, 0, 1, '255', 0, 1, 0, '', 'a:2:{i:1;s:3:"男";i:2;s:3:"女";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'select', '', 248, '', '', '', '', '请选性别');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(766, 'kehu', 0, 'caigou', '学历', 'varchar', '74083-1', 0, 0, 0, 1, '255', 0, 1, 0, '', 'a:3:{i:1;s:6:"高中";i:2;s:6:"初中";i:3;s:6:"其他";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'select', '', 241, '', '', '', '', '请选择学历');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(763, 'kehu', 0, 'beizhu', '备注信息', 'varchar', '08206-1', 0, 0, 0, 0, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'textarea', 'cols="30" rows="10"', 10, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(472, 'bybd4', 0, 'tibaoren', '提报人', 'varchar', '', 1, 1, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 0, '', '', '', '', '请填写提报人姓名');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(473, 'bybd4', 0, 'chengdu', '紧急程度', 'varchar', '', 1, 1, 0, 1, '255', 0, 1, 0, '', 'a:2:{i:1;s:6:"常规";i:2;s:6:"紧急";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'select', '', 0, '', '', '', '', '请选择此事项的紧急程度');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(474, 'bybd4', 0, 'baoxsx', '报修事项', 'varchar', '', 1, 0, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', 'site="75"', 0, '', '', '', '', '请填入报修事项');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(475, 'bybd4', 0, 'bxjtnr', '情况描述', 'varchar', '', 1, 0, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'textarea', 'cols="70" rows="6"', 0, '', '', '', '', '需维护的设备，将具体状况描述下');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(784, 'kehu', 0, 'year', '民族', 'varchar', '74083-1', 0, 0, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 246, '', '', '', '', '请选择民族');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(785, 'kehu', 0, 'yuefen', '科类', 'varchar', '15854-1', 0, 0, 0, 1, '255', 0, 1, 0, '', 'a:2:{i:1;s:10:"自定义1";i:2;s:10:"自定义2";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'select', '', 84, '', '', '', '', '请选择科类');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(786, 'kehu', 0, 'zycj', '专业成绩', 'varchar', '15854-1', 0, 0, 0, 0, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 99, '', '', '', '', '请填写您的专业成绩');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(787, 'bybd6', 0, 'baofei', '录取状态', 'varchar', '', 1, 0, 0, 0, '255', 0, 1, 0, '', 'a:3:{i:1;s:9:"已录取";i:2;s:12:"没有录取";i:3;s:12:"正待处理";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'select', '', 42, '', '', '', '', '请填入录取状态');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(788, 'bybd6', 0, 'beizhu', '备注', 'varchar', '', 0, 0, 0, 0, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'textarea', 'cols="70" rows="6"', 40, '', '', '', '', '如有备注，请填写');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(789, 'bybd6', 0, 'cplx', '性别', 'varchar', '', 0, 0, 0, 1, '255', 0, 1, 0, '', 'a:2:{i:1;s:3:"男";i:2;s:3:"女";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'select', '', 59, '', '', '', '', '请选择性别');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(790, 'bybd6', 0, 'cpmc', '姓名', 'varchar', '', 1, 0, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', 'style="border:1px solid #e1eaf4"', 60, '', '', '', '', '请输入考生姓名');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(791, 'bybd6', 0, 'date', '录取日期', 'varchar', '', 1, 0, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'textdate', '', 48, '', '', '', '', '请选择录取日期');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(792, 'bybd6', 0, 'hgcp', '邮寄地址', 'varchar', '', 0, 0, 0, 0, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 44, '', '', '', '', '请填入邮寄地址');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(793, 'bybd6', 0, 'nianfen', '录取专业', 'varchar', '', 0, 0, 0, 1, '255', 0, 1, 0, '', 'a:4:{i:1;s:9:"计算机";i:2;s:12:"电子商务";i:3;s:12:"汽车工程";i:4;s:12:"经济管理";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'select', '', 51, '', '', '', '', '请选择录取专业');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(794, 'bybd6', 0, 'sjsl', 'EMS编号', 'varchar', '', 0, 0, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 46, '', '', '', '', '请填入快递编号');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(795, 'bybd6', 0, 'tibaoren', '考生号', 'varchar', '', 1, 1, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', 'style="border:1px solid #e1eaf4"', 55, '', '', '', '', '请填入考生号');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(796, 'bybd6', 0, 'yuefen', '层次', 'varchar', '', 0, 0, 0, 0, '255', 0, 1, 0, '', 'a:2:{i:1;s:10:"自定义1";i:2;s:10:"自定义2";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'select', '', 50, '', '', '', '', '请选择录取层次');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(862, 'kehu', 0, 'zhuanye', '报考专业', 'varchar', '15854-1', 0, 0, 0, 1, '255', 0, 1, 0, '', 'a:2:{s:11:"select_size";s:1:"2";s:11:"select_data";s:807:"a:2:{i:55168;a:3:{s:1:&quot;i&quot;;i:55168;s:1:&quot;n&quot;;s:12:&quot;电子商务&quot;;s:1:&quot;s&quot;;a:2:{i:87222;a:3:{s:1:&quot;i&quot;;s:11:&quot;55168-87222&quot;;s:1:&quot;n&quot;;s:18:&quot;电子商务课程&quot;;s:1:&quot;s&quot;;s:0:&quot;&quot;;}i:93411;a:3:{s:1:&quot;i&quot;;s:11:&quot;55168-93411&quot;;s:1:&quot;n&quot;;s:12:&quot;电子营销&quot;;s:1:&quot;s&quot;;s:0:&quot;&quot;;}}}i:32133;a:3:{s:1:&quot;i&quot;;i:32133;s:1:&quot;n&quot;;s:9:&quot;计算机&quot;;s:1:&quot;s&quot;;a:2:{i:31476;a:3:{s:1:&quot;i&quot;;s:11:&quot;32133-31476&quot;;s:1:&quot;n&quot;;s:9:&quot;大数据&quot;;s:1:&quot;s&quot;;s:0:&quot;&quot;;}i:66664;a:3:{s:1:&quot;i&quot;;s:11:&quot;32133-66664&quot;;s:1:&quot;n&quot;;s:15:&quot;计算机科学&quot;;s:1:&quot;s&quot;;s:0:&quot;&quot;;}}}}";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'linkage', '', 97, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(838, 'xmtj', 0, 'email', '电子邮箱', 'varchar', '', 0, 0, 0, 0, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 0, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(839, 'xmtj', 0, 'iid', '推介ID', 'int', '', 0, 0, 0, 1, '10', 1, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 0, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(840, 'xmtj', 0, 'content', '留言内容', 'varchar', '', 0, 0, 0, 0, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'textarea', '', 0, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(842, 'library', 0, 'state', '状态', 'varchar', '', 1, 0, 0, 1, '255', 0, 1, 0, '1', 'a:2:{i:1;s:6:"在售";i:2;s:6:"售罄";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'radio', '', 0, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(843, 'library', 0, 'number', '书号', 'varchar', '', 1, 1, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', 'placeholder="请输入书号"', 0, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(844, 'library', 0, 'name', '书名', 'varchar', '', 1, 1, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', 'placeholder="请输入书名"', 0, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(845, 'library', 0, 'price', '价格', 'varchar', '', 1, 1, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', 'placeholder="请输入价格"', 0, '￥', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(846, 'library', 0, 'genre', '类别', 'varchar', '', 1, 0, 0, 1, '255', 0, 1, 0, '', 'a:6:{s:6:"历史";s:6:"历史";s:6:"文学";s:6:"文学";s:6:"哲学";s:6:"哲学";s:6:"数学";s:6:"数学";s:6:"语文";s:6:"语文";s:6:"其他";s:6:"其他";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'select', 'placeholder="请选择书类别"', 0, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(847, 'library', 0, 'bookcase', '架位', 'varchar', '', 1, 1, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', 'placeholder="请输入书架位"', 0, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(848, 'library', 0, 'author', '作者', 'varchar', '', 1, 1, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', 'placeholder="请输入书作者"', 0, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(849, 'library', 0, 'press', '出版社', 'varchar', '', 1, 0, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', 'placeholder="请输入出版社" size="40"', 0, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(851, 'project', 0, 'diqu', '项目地区', 'varchar', '', 0, 1, 0, 1, '255', 0, 1, 0, '', 'a:8:{s:9:"西宁市";s:9:"西宁市";s:12:"海东地区";s:12:"海东地区";s:21:"海北藏族自治州";s:21:"海北藏族自治州";s:21:"黄南藏族自治州";s:21:"黄南藏族自治州";s:21:"海南藏族自治州";s:21:"海南藏族自治州";s:21:"玉树藏族自治州";s:21:"玉树藏族自治州";s:30:"海西蒙古族藏族自治州";s:30:"海西蒙古族藏族自治州";s:21:"果洛藏族自治州";s:21:"果洛藏族自治州";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'select', '', 255, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(850, 'library', 0, 'zhuangtai', '推荐级别', 'varchar', '', 0, 0, 0, 1, '255', 0, 1, 0, '特级推荐', 'a:2:{s:12:"特级推荐";s:12:"特级推荐";s:12:"一般推荐";s:12:"一般推荐";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'radio', '', 0, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(852, 'project', 0, 'sudi', '项目属地', 'varchar', '', 1, 0, 0, 0, '255', 0, 1, 0, '', 'a:2:{s:11:"select_size";s:1:"2";s:11:"select_data";s:850:"a:2:{i:12693;a:3:{s:1:\\&quot;i\\&quot;;i:12693;s:1:\\&quot;n\\&quot;;s:7:\\&quot;县市2\\&quot;;s:1:\\&quot;s\\&quot;;a:2:{i:49216;a:3:{s:1:\\&quot;i\\&quot;;s:11:\\&quot;12693-49216\\&quot;;s:1:\\&quot;n\\&quot;;s:7:\\&quot;乡镇2\\&quot;;s:1:\\&quot;s\\&quot;;s:0:\\&quot;\\&quot;;}i:81795;a:3:{s:1:\\&quot;i\\&quot;;s:11:\\&quot;12693-81795\\&quot;;s:1:\\&quot;n\\&quot;;s:7:\\&quot;乡镇1\\&quot;;s:1:\\&quot;s\\&quot;;s:0:\\&quot;\\&quot;;}}}i:89310;a:3:{s:1:\\&quot;i\\&quot;;i:89310;s:1:\\&quot;n\\&quot;;s:7:\\&quot;县市1\\&quot;;s:1:\\&quot;s\\&quot;;a:2:{i:73066;a:3:{s:1:\\&quot;i\\&quot;;s:11:\\&quot;89310-73066\\&quot;;s:1:\\&quot;n\\&quot;;s:7:\\&quot;乡镇6\\&quot;;s:1:\\&quot;s\\&quot;;s:0:\\&quot;\\&quot;;}s:5:\\&quot;03381\\&quot;;a:3:{s:1:\\&quot;i\\&quot;;s:11:\\&quot;89310-03381\\&quot;;s:1:\\&quot;n\\&quot;;s:7:\\&quot;乡镇5\\&quot;;s:1:\\&quot;s\\&quot;;s:0:\\&quot;\\&quot;;}}}}";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'linkage', '', 254, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(853, 'project', 0, 'name', '项目名称', 'varchar', '', 1, 1, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', 'size="60"', 253, '', '', '', '', '请输入项目名称');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(854, 'project', 0, 'leibie', '产业类别', 'varchar', '', 1, 1, 0, 1, '255', 0, 1, 0, '', 'a:8:{s:9:"新能源";s:9:"新能源";s:9:"新材料";s:9:"新材料";s:12:"装备制造";s:12:"装备制造";s:6:"化工";s:6:"化工";s:12:"新型建材";s:12:"新型建材";s:12:"文化旅游";s:12:"文化旅游";s:9:"房地产";s:9:"房地产";s:12:"电子信息";s:12:"电子信息";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'select', '', 252, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(855, 'project', 0, 'touzhi', '投资总额', 'varchar', '', 1, 1, 0, 1, '255', 0, 1, 0, '投资额度', 'a:8:{s:12:"500万以下";s:12:"500万以下";s:11:"500-1500万";s:11:"500-1500万";s:13:"1000--5000万";s:13:"1000--5000万";s:9:"0.5--1亿";s:9:"0.5--1亿";s:7:"1--5亿";s:7:"1--5亿";s:7:"5-10亿";s:7:"5-10亿";s:9:"10--30亿";s:9:"10--30亿";s:11:"30亿以上";s:11:"30亿以上";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'select', '', 251, '', '', '', '', '请选择额度');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(856, 'project', 0, 'niandu', '申报年度', 'varchar', '', 1, 0, 0, 1, '255', 0, 1, 0, '', 'a:1:{i:2019;s:4:"2019";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'select', '', 250, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(857, 'project', 0, 'bianhao', '项目编号', 'varchar', '', 0, 0, 0, 0, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', 'size="60"', 249, '', '', '', '', '输入项目编号，没有则不填');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(858, 'project', 0, 'lxdw', '联系单位', 'varchar', '', 1, 0, 0, 1, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'text', '', 248, '', '', '', '', '');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(859, 'project', 0, 'xiangmuzhuangtai', '项目状态', 'varchar', '', 0, 0, 0, 0, '255', 0, 1, 0, '', 'a:4:{s:0:"";s:12:"项目状态";i:1;s:9:"招商中";i:2;s:9:"准备中";i:3;s:12:"暂停招商";}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'select', '', 247, '', '', '', '', '选择项目此时状态');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(860, 'project', 0, 'beizhu', '项目说明', 'longtext', '', 0, 0, 0, 0, '', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'editor', '', 246, '', '', '', '', '详细填写项目的情况');
REPLACE INTO `p8_forms_model_field` (`id`, `model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES
(861, 'project', 0, 'fujian', '附件文档', 'varchar', '', 0, 0, 0, 0, '255', 0, 1, 0, '', 'a:0:{}', 'a:1:{s:6:"layout";s:7:"horizen";}', 'uploader', '', 245, '', '', '', '', '如有附件资料，可以上传');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','forms','string','htmlize','0');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','forms','string','html_post_url_rule','{$module_url}/{$name}.html');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','forms','string','dynamic_list_url_rule','{$module_controller}-list-mid-{$id}#-page-{$page}#.html');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','forms','string','dynamic_view_url_rule','{$module_controller}-view-id-{$id}.html');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','forms','string','html_list_url_rule','{$module_url}/list_{$id}#-page-{$page}#html');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','forms','string','html_view_url_rule','{$module_url}/{$id}.html');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','forms','serialize','status','a:4:{i:-1;s:4:\"退返\";i:0;s:6:\"未处理\";i:1;s:6:\"处理中\";i:9;s:6:\"己处理\";}');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','forms','string','view_page_cache_ttl','0');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','forms','string','template','');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','forms','string','close','0');
REPLACE INTO `p8_config` (`system`,`module`,`type`,`k`,`v`)VALUES('core','forms','string','mobile_template','mobile/school');