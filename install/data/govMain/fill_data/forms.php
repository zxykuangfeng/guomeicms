-- <?php exit;?>
DROP TABLE IF EXISTS `p8_forms_item`;
CREATE TABLE `p8_forms_item` (
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
) ENGINE=MyISAM AUTO_INCREMENT=24631 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_banshi`;
CREATE TABLE `p8_forms_item_banshi` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `bslb` varchar(255) NOT NULL,
  `ssbm` varchar(255) NOT NULL,
  `lxr` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `czsm` varchar(255) DEFAULT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `lianj` varchar(255) DEFAULT NULL,
  `bianhao` varchar(255) DEFAULT NULL,
  `tupian` text,
  `sybumen` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_banshigongshi`;
CREATE TABLE `p8_forms_item_banshigongshi` (
  `id` int(10) unsigned NOT NULL,
  `bianhao` varchar(255) NOT NULL,
  `shouli` varchar(255) NOT NULL,
  `xiangmumingchen` varchar(255) NOT NULL,
  `shijjian` varchar(255) NOT NULL,
  `zhuagntai` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_bmjx`;
CREATE TABLE `p8_forms_item_bmjx` (
  `id` int(10) unsigned NOT NULL,
  `bumen` varchar(255) NOT NULL,
  `fzr` varchar(255) NOT NULL,
  `ztasl` varchar(255) NOT NULL,
  `yuefen` varchar(255) NOT NULL,
  `yxta` varchar(255) DEFAULT NULL,
  `kaoqin` varchar(255) NOT NULL,
  `sksj` varchar(255) NOT NULL,
  `pxsj` int(255) NOT NULL,
  `gzwcd` varchar(255) NOT NULL,
  `zgjl` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_bmtajx`;
CREATE TABLE `p8_forms_item_bmtajx` (
  `id` int(10) unsigned NOT NULL,
  `bumen` varchar(255) NOT NULL,
  `bmzg` varchar(255) NOT NULL,
  `yuefen` varchar(255) NOT NULL,
  `tazs` int(10) NOT NULL,
  `yxtas` int(10) NOT NULL,
  `jptas` int(10) unsigned NOT NULL,
  `yptas` int(255) NOT NULL,
  `ybtas` int(255) NOT NULL,
  `zgjx` decimal(10,0) NOT NULL,
  `kaoqin` varchar(255) NOT NULL,
  `qjcs` int(10) NOT NULL,
  `kg` int(10) NOT NULL,
  `late` int(10) NOT NULL,
  `kq` decimal(10,0) NOT NULL,
  `sk` int(255) NOT NULL,
  `px` int(255) NOT NULL,
  `pxjx` int(255) NOT NULL,
  `gz` varchar(255) NOT NULL,
  `tapx` varchar(255) DEFAULT NULL,
  `gzjx` decimal(10,0) NOT NULL,
  `gznr` varchar(255) DEFAULT NULL,
  `pxbx` int(255) NOT NULL,
  `zjx` int(10) NOT NULL,
  `year` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_bom`;
CREATE TABLE `p8_forms_item_bom` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  `bianhao` varchar(255) DEFAULT NULL,
  `xiangmudiqu` varchar(255) NOT NULL,
  `xiangmuzhuangtai` varchar(255) NOT NULL,
  `gaishu` varchar(255) NOT NULL,
  `hezuofangshi` varchar(255) NOT NULL,
  `shudi` varchar(255) NOT NULL,
  `leibie` varchar(255) NOT NULL,
  `touzhi` varchar(255) NOT NULL,
  `youxiaoqi` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_bumengtiang`;
CREATE TABLE `p8_forms_item_bumengtiang` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `bumeng` varchar(255) NOT NULL,
  `tianmingcheng` varchar(255) NOT NULL,
  `tianneirong` varchar(255) NOT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `zhuguan` varchar(255) NOT NULL,
  `jasj` varchar(255) NOT NULL,
  `tasj` varchar(255) DEFAULT NULL,
  `jianjin` varchar(255) NOT NULL,
  `xiangxi` varchar(255) DEFAULT NULL,
  `yuefen` varchar(255) NOT NULL,
  `tacyr` varchar(255) DEFAULT NULL,
  `bmfzr` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_bybd1`;
CREATE TABLE `p8_forms_item_bybd1` (
  `id` int(10) unsigned NOT NULL,
  `xingming` varchar(255) NOT NULL,
  `sshubm` varchar(255) NOT NULL,
  `sfleixing` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `kdgs` varchar(255) NOT NULL,
  `jjcd` varchar(255) NOT NULL,
  `kdnr` varchar(255) DEFAULT NULL,
  `kdzt` varchar(255) DEFAULT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_bybd2`;
CREATE TABLE `p8_forms_item_bybd2` (
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

DROP TABLE IF EXISTS `p8_forms_item_bybd3`;
CREATE TABLE `p8_forms_item_bybd3` (
  `id` int(10) unsigned NOT NULL,
  `xingm` varchar(255) NOT NULL,
  `zbmc` varchar(255) NOT NULL,
  `zxzt` varchar(255) NOT NULL,
  `dt` varchar(255) NOT NULL,
  `sxbh` varchar(255) NOT NULL,
  `xqbz` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_bybd4`;
CREATE TABLE `p8_forms_item_bybd4` (
  `id` int(10) unsigned NOT NULL,
  `tibaoren` varchar(255) NOT NULL,
  `chengdu` varchar(255) NOT NULL,
  `baoxsx` varchar(255) NOT NULL,
  `bxjtnr` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_bybd6`;
CREATE TABLE `p8_forms_item_bybd6` (
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
  `yuefen` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_bybd7`;
CREATE TABLE `p8_forms_item_bybd7` (
  `id` int(10) unsigned NOT NULL,
  `xingming` varchar(255) NOT NULL,
  `bumen` varchar(255) NOT NULL,
  `chidao` int(10) NOT NULL,
  `kgcs` int(10) NOT NULL,
  `qjsj` int(10) NOT NULL,
  `nianfen` varchar(255) NOT NULL,
  `moth` varchar(255) NOT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_caigougongzhang`;
CREATE TABLE `p8_forms_item_caigougongzhang` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `gongzhangleixing` varchar(255) NOT NULL,
  `bianhao` varchar(255) NOT NULL,
  `hetongmingcheng` varchar(255) NOT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  `cpin` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_canpinjc`;
CREATE TABLE `p8_forms_item_canpinjc` (
  `id` int(10) unsigned NOT NULL,
  `wuliao` varchar(255) NOT NULL,
  `bianhao` varchar(255) DEFAULT NULL,
  `gongju` varchar(255) NOT NULL,
  `zhibiao` varchar(255) NOT NULL,
  `xiangxi` varchar(255) DEFAULT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `yichang` text,
  `jiancr` varchar(255) NOT NULL,
  `tebbzh` varchar(255) DEFAULT NULL,
  `wailian` varchar(255) DEFAULT NULL,
  `leibie` varchar(255) NOT NULL,
  `cheliang` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_cgbbd`;
CREATE TABLE `p8_forms_item_cgbbd` (
  `id` int(10) unsigned NOT NULL,
  `nmae` varchar(255) NOT NULL,
  `sxmc` varchar(255) NOT NULL,
  `xqbz` varchar(255) DEFAULT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `banji` varchar(255) NOT NULL,
  `shouji` varchar(255) NOT NULL,
  `youxiang` varchar(255) NOT NULL,
  `xingb` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_cgjhxq`;
CREATE TABLE `p8_forms_item_cgjhxq` (
  `id` int(10) unsigned NOT NULL,
  `cgwl` varchar(255) NOT NULL,
  `bianma` varchar(255) NOT NULL,
  `shuliang` varchar(255) NOT NULL,
  `jinji` varchar(255) NOT NULL,
  `xuqsj` varchar(255) NOT NULL,
  `xqdh` varchar(255) NOT NULL,
  `spdh` varchar(255) NOT NULL,
  `ytong` varchar(255) DEFAULT NULL,
  `cgzrr` varchar(255) NOT NULL,
  `wlxz` varchar(255) NOT NULL,
  `fenxiang` varchar(255) NOT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_ckbbd`;
CREATE TABLE `p8_forms_item_ckbbd` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `sxmc` varchar(255) NOT NULL,
  `bez` varchar(255) DEFAULT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `leix` varchar(255) NOT NULL,
  `zhuantia` varchar(255) NOT NULL,
  `danwei` varchar(255) NOT NULL,
  `shouj` varchar(255) NOT NULL,
  `youxiang` varchar(255) NOT NULL,
  `erer` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_ckslfl`;
CREATE TABLE `p8_forms_item_ckslfl` (
  `id` int(10) unsigned NOT NULL,
  `wlmc` varchar(255) NOT NULL,
  `wlbm` varchar(255) NOT NULL,
  `cllx` varchar(255) NOT NULL,
  `lianfen` varchar(255) NOT NULL,
  `yufen` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `shgys` varchar(255) DEFAULT NULL,
  `shdh` varchar(255) DEFAULT NULL,
  `shsl` varchar(255) DEFAULT NULL,
  `wlhgsl` varchar(255) DEFAULT NULL,
  `slbz` varchar(255) DEFAULT NULL,
  `linliaoren` varchar(255) DEFAULT NULL,
  `lldh` varchar(255) DEFAULT NULL,
  `llsll` varchar(255) DEFAULT NULL,
  `flbz` varchar(255) DEFAULT NULL,
  `slzj` varchar(255) DEFAULT NULL,
  `flzj` varchar(255) DEFAULT NULL,
  `beizhuxinxi` varchar(255) DEFAULT NULL,
  `fljsr` varchar(255) DEFAULT NULL,
  `sljsr` varchar(255) DEFAULT NULL,
  `xiankucun` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_cttc`;
CREATE TABLE `p8_forms_item_cttc` (
  `id` int(10) unsigned NOT NULL,
  `ctmc` varchar(255) NOT NULL,
  `tupian` varchar(255) DEFAULT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  `tel` varchar(255) NOT NULL,
  `pinbi` varchar(255) NOT NULL,
  `sudu` varchar(255) NOT NULL,
  `dii` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_cwbbd`;
CREATE TABLE `p8_forms_item_cwbbd` (
  `id` int(10) unsigned NOT NULL,
  `mane` varchar(255) NOT NULL,
  `ssssss` varchar(255) NOT NULL,
  `xqbb` varchar(255) DEFAULT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `bum` varchar(255) NOT NULL,
  `shouji` varchar(255) NOT NULL,
  `youxiang` varchar(255) NOT NULL,
  `xingb` varchar(255) NOT NULL,
  `riqi` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_cwyb`;
CREATE TABLE `p8_forms_item_cwyb` (
  `id` int(10) unsigned NOT NULL,
  `xingming` varchar(255) NOT NULL,
  `ganwei` varchar(255) NOT NULL,
  `nianfen` varchar(255) NOT NULL,
  `yuefen` varchar(255) NOT NULL,
  `jyzc` int(10) NOT NULL,
  `kdwlzc` int(10) DEFAULT NULL,
  `yfjf` int(10) DEFAULT NULL,
  `gysfk` int(10) DEFAULT NULL,
  `jbgzzc` int(10) DEFAULT NULL,
  `jxzc` int(10) DEFAULT NULL,
  `qita` int(10) DEFAULT NULL,
  `zzhichu` int(10) NOT NULL,
  `zongshouru` int(10) DEFAULT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `shuoming` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_dangweixingzhen`;
CREATE TABLE `p8_forms_item_dangweixingzhen` (
  `id` int(10) unsigned NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `keyanchengguo` varchar(255) NOT NULL,
  `lianxiwomen` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `shortdesc` varchar(255) NOT NULL,
  `workroom` varchar(255) NOT NULL,
  `yanjiufangxiang` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_dingcang`;
CREATE TABLE `p8_forms_item_dingcang` (
  `id` int(10) unsigned NOT NULL,
  `shengqr` varchar(255) NOT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `canting` varchar(255) NOT NULL,
  `tcbh` varchar(255) DEFAULT NULL,
  `tcmc` varchar(255) DEFAULT NULL,
  `canci` varchar(255) NOT NULL,
  `time` varchar(255) DEFAULT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  `fenshu` varchar(255) NOT NULL,
  `dangjia` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_dlxstc`;
CREATE TABLE `p8_forms_item_dlxstc` (
  `id` int(10) unsigned NOT NULL,
  `qymc` varchar(255) NOT NULL,
  `lxr` varchar(255) NOT NULL,
  `lxdh` varchar(255) DEFAULT NULL,
  `xiaoshou` decimal(10,0) NOT NULL,
  `tcje` decimal(10,0) NOT NULL,
  `tczf` varchar(255) NOT NULL,
  `tcxq` varchar(255) DEFAULT NULL,
  `fjzl` varchar(255) DEFAULT NULL,
  `nianfen` varchar(255) NOT NULL,
  `yuefen` varchar(255) NOT NULL,
  `ticmm` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_gdzc`;
CREATE TABLE `p8_forms_item_gdzc` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `bianhao` varchar(255) NOT NULL,
  `zcfl` varchar(255) NOT NULL,
  `fzr` varchar(255) NOT NULL,
  `gmje` decimal(10,0) NOT NULL,
  `goumsj` varchar(255) NOT NULL,
  `zhuantai` varchar(255) NOT NULL,
  `jhsj` varchar(255) NOT NULL,
  `jcr` varchar(255) NOT NULL,
  `tupian` varchar(255) DEFAULT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  `miaosh` varchar(255) DEFAULT NULL,
  `shiyongr` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_gongyingshang`;
CREATE TABLE `p8_forms_item_gongyingshang` (
  `id` int(10) unsigned NOT NULL,
  `gysbianma` varchar(30) NOT NULL,
  `gysjc` varchar(255) NOT NULL,
  `gysqc` varchar(255) NOT NULL,
  `wuliao` varchar(500) NOT NULL,
  `lianxiren` varchar(255) NOT NULL,
  `dianhua` varchar(40) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `gongyingshang` varchar(255) DEFAULT NULL,
  `dizhi` varchar(500) NOT NULL,
  `fuzeren` varchar(255) DEFAULT NULL,
  `zhuceziben` varchar(255) DEFAULT NULL,
  `beizhu` varchar(500) DEFAULT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `yyzz` text,
  `pingshen` varchar(255) DEFAULT NULL,
  `pinshenfzr` varchar(255) DEFAULT NULL,
  `wanzhan` varchar(255) DEFAULT NULL,
  `leibie` varchar(255) NOT NULL,
  `QQ` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_gongzi`;
CREATE TABLE `p8_forms_item_gongzi` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `bumen` varchar(255) NOT NULL,
  `yuefen` varchar(255) NOT NULL,
  `zongz` varchar(0) NOT NULL,
  `jiben` varchar(255) NOT NULL,
  `jxiao` varchar(0) NOT NULL,
  `koukuan` decimal(10,0) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `glycx` varchar(255) NOT NULL,
  `ffrq` varchar(255) NOT NULL,
  `banji` varchar(255) NOT NULL,
  `zzmm` varchar(255) NOT NULL,
  `chus` varchar(255) NOT NULL,
  `xuehao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_gysfk`;
CREATE TABLE `p8_forms_item_gysfk` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `bianma` varchar(255) DEFAULT NULL,
  `fuksj` varchar(255) DEFAULT NULL,
  `tijiaore` varchar(255) DEFAULT NULL,
  `fkbeizhu` varchar(255) DEFAULT NULL,
  `tsbt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_gzcx`;
CREATE TABLE `p8_forms_item_gzcx` (
  `id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_gzqs`;
CREATE TABLE `p8_forms_item_gzqs` (
  `id` int(10) unsigned NOT NULL,
  `xingming` varchar(255) NOT NULL,
  `bumne` varchar(255) NOT NULL,
  `nianfen` varchar(255) NOT NULL,
  `yuefen` varchar(255) NOT NULL,
  `leixing` varchar(255) NOT NULL,
  `gzff` varchar(255) DEFAULT NULL,
  `yifje` varchar(255) DEFAULT NULL,
  `sfje` varchar(255) DEFAULT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  `beizhusm` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_huodongbm`;
CREATE TABLE `p8_forms_item_huodongbm` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `bumeng` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `yidong` int(15) unsigned DEFAULT NULL,
  `shixianleb` varchar(255) NOT NULL,
  `xiangxi` varchar(255) DEFAULT NULL,
  `hdmc` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_jdbbd`;
CREATE TABLE `p8_forms_item_jdbbd` (
  `id` int(10) unsigned NOT NULL,
  `xingming` varchar(255) NOT NULL,
  `smc` varchar(255) NOT NULL,
  `xiangqing` varchar(255) DEFAULT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `sjhm` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `banji` varchar(255) NOT NULL,
  `zzlx` varchar(255) NOT NULL,
  `zhiwei` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_jiangshi`;
CREATE TABLE `p8_forms_item_jiangshi` (
  `id` int(10) unsigned NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `keyanchengguo` varchar(255) NOT NULL,
  `lianxiwomen` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `shortdesc` varchar(255) NOT NULL,
  `workroom` varchar(255) NOT NULL,
  `yanjiufangxiang` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_jiaoshou`;
CREATE TABLE `p8_forms_item_jiaoshou` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `yanjiufangxiang` varchar(255) NOT NULL,
  `keyanchengguo` varchar(250) NOT NULL,
  `lianxiwomen` varchar(255) NOT NULL,
  `workroom` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `shortdesc` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_jixiaobiaoyan`;
CREATE TABLE `p8_forms_item_jixiaobiaoyan` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `bumeng` varchar(255) NOT NULL,
  `xiangxi` varchar(255) NOT NULL,
  `shoukeshijian` decimal(10,0) DEFAULT NULL,
  `shoukejixiao` decimal(10,0) DEFAULT NULL,
  `shifqq` varchar(255) DEFAULT NULL,
  `chidao` int(255) DEFAULT NULL,
  `kuanggong` int(255) DEFAULT NULL,
  `qingjia` int(255) DEFAULT NULL,
  `qingjiasj` decimal(10,0) DEFAULT NULL,
  `kqjj` decimal(10,0) DEFAULT NULL,
  `kouzhi` decimal(10,0) DEFAULT NULL,
  `tiang` int(255) DEFAULT NULL,
  `yxtas` int(255) DEFAULT NULL,
  `jptas` int(255) DEFAULT NULL,
  `yptas` int(255) DEFAULT NULL,
  `ybtas` int(255) DEFAULT NULL,
  `tajx` decimal(10,0) DEFAULT NULL,
  `pxsjs` decimal(10,0) DEFAULT NULL,
  `pxjx` decimal(10,0) DEFAULT NULL,
  `zongjx` decimal(10,0) DEFAULT NULL,
  `gzwcd` varchar(255) DEFAULT NULL,
  `zxjx` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_kehu`;
CREATE TABLE `p8_forms_item_kehu` (
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
  `zy` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_kehucj`;
CREATE TABLE `p8_forms_item_kehucj` (
  `id` int(10) unsigned NOT NULL,
  `xingming` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `yue` varchar(255) DEFAULT NULL,
  `riqi` varchar(255) NOT NULL,
  `kehumc` varchar(255) NOT NULL,
  `khlxr` varchar(255) DEFAULT NULL,
  `khlxdh` varchar(255) NOT NULL,
  `htbh` varchar(255) NOT NULL,
  `ddnr` varchar(255) DEFAULT NULL,
  `sjcjjg` varchar(255) DEFAULT NULL,
  `fkqk` varchar(255) DEFAULT NULL,
  `mima` int(20) NOT NULL,
  `zhengjhaom` varchar(255) NOT NULL,
  `leixing` varchar(255) NOT NULL,
  `chuanzhen` varchar(255) NOT NULL,
  `yogntu` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_kq`;
CREATE TABLE `p8_forms_item_kq` (
  `id` int(10) unsigned NOT NULL,
  `xingming` varchar(255) NOT NULL,
  `bumeng` varchar(255) NOT NULL,
  `nianfen` varchar(255) NOT NULL,
  `yuefen` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `shijan` int(10) NOT NULL,
  `xiangqing` varchar(255) NOT NULL,
  `danghao` varchar(255) DEFAULT NULL,
  `dianh` varchar(255) NOT NULL,
  `yx` varchar(255) NOT NULL,
  `banji` varchar(255) NOT NULL,
  `jiezshj` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_mimaxiugai`;
CREATE TABLE `p8_forms_item_mimaxiugai` (
  `id` int(10) unsigned NOT NULL,
  `xingming` varchar(255) NOT NULL,
  `bumne` varchar(255) NOT NULL,
  `leixing` varchar(255) NOT NULL,
  `jiumim` varchar(255) DEFAULT NULL,
  `xinmima` varchar(255) NOT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_paiban`;
CREATE TABLE `p8_forms_item_paiban` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `bumeng` varchar(255) NOT NULL,
  `neirong` varchar(255) NOT NULL,
  `leixing` varchar(255) NOT NULL,
  `xiangqing` varchar(255) DEFAULT NULL,
  `renshu` varchar(255) NOT NULL,
  `xingqi` varchar(255) DEFAULT NULL,
  `lianjie` varchar(255) DEFAULT NULL,
  `zbrq` varchar(255) NOT NULL,
  `sxbh` varchar(255) NOT NULL,
  `fjxz` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_peixinbaoming`;
CREATE TABLE `p8_forms_item_peixinbaoming` (
  `id` int(10) unsigned NOT NULL,
  `peixunfangang` varchar(255) NOT NULL,
  `yuangongxingming` varchar(255) DEFAULT NULL,
  `bumen` varchar(255) NOT NULL,
  `laoshixingming` varchar(255) DEFAULT NULL,
  `peixunshijian` varchar(255) DEFAULT NULL,
  `peixunxuqiu` varchar(255) DEFAULT NULL,
  `shoukeshijian` varchar(255) DEFAULT NULL,
  `shoukeshuoming` varchar(255) DEFAULT NULL,
  `peixunyuefen` varchar(255) NOT NULL,
  `pxlx` varchar(255) NOT NULL,
  `tbsj` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_peixunfangang`;
CREATE TABLE `p8_forms_item_peixunfangang` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `suosubumeng` varchar(255) NOT NULL,
  `neirong` varchar(255) NOT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `biaoti` varchar(255) NOT NULL,
  `tel` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_rlzy`;
CREATE TABLE `p8_forms_item_rlzy` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `rrrrr` varchar(255) NOT NULL,
  `xqbz` varchar(255) DEFAULT NULL,
  `fujain` varchar(255) DEFAULT NULL,
  `shouji` varchar(255) NOT NULL,
  `youxian` varchar(255) NOT NULL,
  `xingbie` varchar(255) NOT NULL,
  `yuanxi` varchar(255) NOT NULL,
  `baom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_scbbd`;
CREATE TABLE `p8_forms_item_scbbd` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `xqdd` varchar(255) DEFAULT NULL,
  `fujain` varchar(255) DEFAULT NULL,
  `shouji` varchar(255) NOT NULL,
  `youxian` varchar(255) NOT NULL,
  `xingbie` varchar(255) NOT NULL,
  `banji` varchar(255) NOT NULL,
  `ganwei` varchar(255) NOT NULL,
  `da2` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_shengchan`;
CREATE TABLE `p8_forms_item_shengchan` (
  `id` int(10) unsigned NOT NULL,
  `chengpin` varchar(255) NOT NULL,
  `bianhao` varchar(255) DEFAULT NULL,
  `jihua` varchar(255) NOT NULL,
  `shengchan` varchar(255) NOT NULL,
  `shuliang` varchar(255) NOT NULL,
  `shishi` varchar(255) NOT NULL,
  `shishiren` varchar(255) NOT NULL,
  `jihuabh` varchar(255) NOT NULL,
  `zhuangtai` varchar(255) NOT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `jihuazhid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_shoh`;
CREATE TABLE `p8_forms_item_shoh` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `ddddd` varchar(255) NOT NULL,
  `xqbz` varchar(255) DEFAULT NULL,
  `fjian` varchar(255) DEFAULT NULL,
  `shouji` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `xingbie` varchar(255) NOT NULL,
  `zhiwei` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_tiang`;
CREATE TABLE `p8_forms_item_tiang` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(500) NOT NULL,
  `gonghao` varchar(500) DEFAULT NULL,
  `bumeng` varchar(255) NOT NULL,
  `gangwei` varchar(255) NOT NULL,
  `leixing` varchar(500) NOT NULL,
  `zhuguanxingming` varchar(800) DEFAULT NULL,
  `biaoti` varchar(255) NOT NULL,
  `neirong` varchar(255) NOT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `xiaoyi` varchar(255) DEFAULT NULL,
  `date` varchar(255) NOT NULL,
  `year` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `tapw` varchar(255) DEFAULT NULL,
  `tadc` varchar(255) DEFAULT NULL,
  `tapy` varchar(255) DEFAULT NULL,
  `jianjin` int(10) DEFAULT NULL,
  `jasj` varchar(255) DEFAULT NULL,
  `tabh` varchar(255) DEFAULT NULL,
  `tel` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_tuiliaopingt`;
CREATE TABLE `p8_forms_item_tuiliaopingt` (
  `id` int(10) unsigned NOT NULL,
  `mingcheng` varchar(255) NOT NULL,
  `leixing` varchar(255) NOT NULL,
  `bianhao` varchar(255) NOT NULL,
  `songhuo` varchar(255) NOT NULL,
  `gongyings` varchar(255) NOT NULL,
  `miaoshu` varchar(255) NOT NULL,
  `tibaoren` varchar(255) NOT NULL,
  `shenp` varchar(255) DEFAULT NULL,
  `tupian` text,
  `shuoming` varchar(255) DEFAULT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `caigouren` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `jindu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_vijiaoshou`;
CREATE TABLE `p8_forms_item_vijiaoshou` (
  `id` int(10) unsigned NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `keyanchengguo` varchar(255) NOT NULL,
  `lianxiwomen` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `shortdesc` varchar(255) NOT NULL,
  `workroom` varchar(255) NOT NULL,
  `yanjiufangxiang` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_wjsg`;
CREATE TABLE `p8_forms_item_wjsg` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `bumen` varchar(255) NOT NULL,
  `sgnr` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `xiangqing` varchar(255) DEFAULT NULL,
  `year` varchar(255) NOT NULL,
  `mouth` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `riqi` varchar(255) DEFAULT NULL,
  `glybz` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_wjzlqd`;
CREATE TABLE `p8_forms_item_wjzlqd` (
  `id` int(10) unsigned NOT NULL,
  `mingc` varchar(255) NOT NULL,
  `wlbh` varchar(255) DEFAULT NULL,
  `wlgg` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `sgxz` varchar(255) NOT NULL,
  `gongyings` varchar(255) DEFAULT NULL,
  `wltp` varchar(255) DEFAULT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  `shuliang` varchar(255) NOT NULL,
  `fj` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_workbaom`;
CREATE TABLE `p8_forms_item_workbaom` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `bumeng` varchar(255) NOT NULL,
  `dianhua` varchar(255) NOT NULL,
  `yidong` varchar(255) NOT NULL,
  `xiangxi` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `bmsx` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_wuliao`;
CREATE TABLE `p8_forms_item_wuliao` (
  `id` int(10) unsigned NOT NULL,
  `wuliaobianma` varchar(20) NOT NULL,
  `wuliaopingming` varchar(255) NOT NULL,
  `gongyingshang` varchar(255) NOT NULL,
  `lianxidianhua` varchar(10) NOT NULL,
  `youjian` varchar(255) NOT NULL,
  `wuliaojieshao` varchar(255) NOT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `beixuangongyingshang` varchar(255) DEFAULT NULL,
  `beixuangongyingshang2` varchar(255) DEFAULT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  `wllb` varchar(255) NOT NULL,
  `wltp` text,
  `lxr` varchar(255) NOT NULL,
  `wlzt` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `cgzq` int(255) NOT NULL,
  `cgnyd` varchar(255) NOT NULL,
  `gongyings` varchar(255) DEFAULT NULL,
  `cgfzr` varchar(255) NOT NULL,
  `spdh` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_wuliu`;
CREATE TABLE `p8_forms_item_wuliu` (
  `id` int(10) unsigned NOT NULL,
  `hwmc` varchar(255) NOT NULL,
  `hwbh` varchar(255) DEFAULT NULL,
  `hwjjd` varchar(255) NOT NULL,
  `hwnr` varchar(255) NOT NULL,
  `shouhdd` varchar(255) NOT NULL,
  `shlxr` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_wyh`;
CREATE TABLE `p8_forms_item_wyh` (
  `id` int(10) unsigned NOT NULL,
  `xingming` varchar(255) NOT NULL,
  `bum` varchar(255) NOT NULL,
  `baomleix` varchar(255) NOT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `ganwei` varchar(255) DEFAULT NULL,
  `nianfen` varchar(255) NOT NULL,
  `yufen` varchar(255) NOT NULL,
  `riqi` varchar(255) NOT NULL,
  `cbkz` varchar(255) NOT NULL,
  `cbkzxg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_xiaoshougongzhang`;
CREATE TABLE `p8_forms_item_xiaoshougongzhang` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `bumen` varchar(255) NOT NULL,
  `gongzhangleixing` varchar(255) NOT NULL,
  `caigouhetong` varchar(10) NOT NULL,
  `gongyingshang` varchar(255) NOT NULL,
  `jine` varchar(255) NOT NULL,
  `hetongwuliao` varchar(500) NOT NULL,
  `qianziriqi` varchar(10) DEFAULT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `xiaoshouhetongbianhao` varchar(255) DEFAULT NULL,
  `leixingsy` varchar(255) NOT NULL,
  `guidang` varchar(255) NOT NULL,
  `xingbie` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_xinxidian`;
CREATE TABLE `p8_forms_item_xinxidian` (
  `id` int(10) unsigned NOT NULL,
  `xinxidian` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `yue` varchar(255) NOT NULL,
  `tbsj` varchar(255) NOT NULL,
  `szbm` varchar(255) NOT NULL,
  `khqy` varchar(255) NOT NULL,
  `lxr` varchar(255) NOT NULL,
  `dianhua` varchar(255) NOT NULL,
  `ganwei` varchar(255) NOT NULL,
  `xxdzt` varchar(255) NOT NULL,
  `xxdbhq` varchar(255) NOT NULL,
  `khxz` varchar(255) NOT NULL,
  `sxkh` varchar(255) NOT NULL,
  `jlqk` varchar(255) DEFAULT NULL,
  `zt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_xmtj`;
CREATE TABLE `p8_forms_item_xmtj` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `iid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_xsbbd`;
CREATE TABLE `p8_forms_item_xsbbd` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `sxmc` varchar(255) NOT NULL,
  `xqcc` varchar(255) DEFAULT NULL,
  `fjuj` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_xzbbd`;
CREATE TABLE `p8_forms_item_xzbbd` (
  `id` int(10) unsigned NOT NULL,
  `mnae` varchar(255) NOT NULL,
  `sxmc` varchar(255) NOT NULL,
  `xdd` varchar(255) DEFAULT NULL,
  `fujian` varchar(255) DEFAULT NULL,
  `sjhm` varchar(255) NOT NULL,
  `youx` varchar(255) NOT NULL,
  `riq` varchar(255) NOT NULL,
  `sqbn` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_yanfapingtai`;
CREATE TABLE `p8_forms_item_yanfapingtai` (
  `id` int(10) unsigned NOT NULL,
  `dxmc` varchar(255) NOT NULL,
  `bianhao` varchar(255) NOT NULL,
  `suoslx` varchar(255) NOT NULL,
  `canshu` varchar(255) NOT NULL,
  `guanliren` varchar(255) NOT NULL,
  `zhuanan` varchar(255) NOT NULL,
  `zhuguan` varchar(255) NOT NULL,
  `zhuantai` varchar(255) NOT NULL,
  `tupyx` text,
  `fujian` varchar(255) DEFAULT NULL,
  `waibu` varchar(255) DEFAULT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  `dxzhuant` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_yfbbd`;
CREATE TABLE `p8_forms_item_yfbbd` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `sjmc` varchar(255) NOT NULL,
  `xqbz` varchar(255) DEFAULT NULL,
  `rujian` varchar(255) DEFAULT NULL,
  `shouji` varchar(255) NOT NULL,
  `yxiang` varchar(255) NOT NULL,
  `xingbie` varchar(255) NOT NULL,
  `banji` varchar(255) NOT NULL,
  `tib` varchar(255) NOT NULL,
  `jinji` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_ysqcx`;
CREATE TABLE `p8_forms_item_ysqcx` (
  `id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_zazj`;
CREATE TABLE `p8_forms_item_zazj` (
  `id` int(10) unsigned NOT NULL,
  `zamc` varchar(255) NOT NULL,
  `fzr` varchar(255) NOT NULL,
  `xiaoguo` varchar(255) NOT NULL,
  `xianqing` varchar(255) NOT NULL,
  `jiean` varchar(255) NOT NULL,
  `chengyuan` varchar(255) NOT NULL,
  `fjlz` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_zhuanan`;
CREATE TABLE `p8_forms_item_zhuanan` (
  `id` int(10) unsigned NOT NULL,
  `zamc` varchar(255) NOT NULL,
  `tibaoren` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `jindu` varchar(255) NOT NULL,
  `jindu2` varchar(255) NOT NULL,
  `fujian2` varchar(255) DEFAULT NULL,
  `yuji` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_zhuanan2`;
CREATE TABLE `p8_forms_item_zhuanan2` (
  `id` int(10) unsigned NOT NULL,
  `tibaoren` varchar(255) NOT NULL,
  `bum` varchar(255) NOT NULL,
  `leixing` varchar(255) NOT NULL,
  `biaoti` varchar(255) NOT NULL,
  `xiangqing` varchar(255) NOT NULL,
  `fjian` varchar(255) DEFAULT NULL,
  `zycd` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_item_zjbbd`;
CREATE TABLE `p8_forms_item_zjbbd` (
  `id` int(10) unsigned NOT NULL,
  `nn` varchar(255) NOT NULL,
  `rrrrr` varchar(255) NOT NULL,
  `xqdd` varchar(255) NOT NULL,
  `fjian` varchar(255) DEFAULT NULL,
  `banji` varchar(255) NOT NULL,
  `sjhm` varchar(255) NOT NULL,
  `youxiang` varchar(255) NOT NULL,
  `xingbie` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_model`;
CREATE TABLE `p8_forms_model` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL DEFAULT '',
  `alias` char(30) NOT NULL DEFAULT '',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `verified` varchar(20) NOT NULL DEFAULT '',
  `recommend` tinyint(1) NOT NULL DEFAULT '0',
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  `display_order` int(10) unsigned NOT NULL DEFAULT '0',
  `post_template` varchar(50) NOT NULL DEFAULT '',
  `post_template_mobile` varchar(50) NOT NULL DEFAULT '',
  `list_template` varchar(50) NOT NULL DEFAULT '',
  `list_template_mobile` varchar(50) NOT NULL DEFAULT '',
  `view_template` varchar(50) NOT NULL DEFAULT '',
  `view_template_mobile` varchar(50) NOT NULL DEFAULT '',
  `config` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=200 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `p8_forms_model_field`;
CREATE TABLE `p8_forms_model_field` (
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
) ENGINE=MyISAM AUTO_INCREMENT=653 DEFAULT CHARSET=utf8;
REPLACE INTO `p8_config` VALUES ('core','forms','string','htmlize','0');
REPLACE INTO `p8_config` VALUES ('core','forms','string','html_post_url_rule','{$module_url}/{$name}.shtml');
REPLACE INTO `p8_config` VALUES ('core','forms','string','dynamic_list_url_rule','{$module_controller}-list-mid-{$id}#-page-{$page}#.html');
REPLACE INTO `p8_config` VALUES ('core','forms','string','dynamic_view_url_rule','{$module_controller}-view-id-{$id}.html');
REPLACE INTO `p8_config` VALUES ('core','forms','string','html_list_url_rule','{$module_url}/list_{$id}#-page-{$page}#shtml');
REPLACE INTO `p8_config` VALUES ('core','forms','string','html_view_url_rule','{$module_url}/{$id}.shtml');
REPLACE INTO `p8_config` VALUES ('core','forms','serialize','status','a:4:{i:-1;s:4:\"退返\";i:0;s:6:\"未处理\";i:1;s:6:\"处理中\";i:9;s:6:\"己处理\";}');
REPLACE INTO `p8_config` VALUES ('core','forms','string','view_page_cache_ttl','0');
REPLACE INTO `p8_config` VALUES ('core','forms','string','template','govnew80');
REPLACE INTO `p8_config` VALUES ('core','forms','string','close','0');
REPLACE INTO `p8_config` VALUES ('core','forms','string','mobile_template','mobile/red');
REPLACE INTO `p8_forms_item` VALUES ('206','客户订单成交提报','','37','1','admin','219.136.168.170','0','1305869877','1305872791','1305872791','0','0','9','','0','0','');
REPLACE INTO `p8_forms_item` VALUES ('114','供应商付款','','19','1','admin','219.136.143.11','0','1300871114','0','1300871114','1','0','9','admin','1301796432','0',' ');
REPLACE INTO `p8_forms_item` VALUES ('253','办事流程对照表','','16','1','admin','219.136.138.145','0','1307528811','0','1307528811','0','0','9','','0','0','');
REPLACE INTO `p8_forms_item` VALUES ('24624','办事公示平台','','52','1','admin','175.13.255.16','0','1463651440','1464651471','1464651471','0','0','9','','0','0','');
REPLACE INTO `p8_forms_item` VALUES ('24580','招商项目平台','','14','1','admin','175.13.252.92','0','1458543376','1458543912','1458543912','0','0','9','admin','1458546127','0',' dfdf');
REPLACE INTO `p8_forms_item_banshi` VALUES ('253','在线办事结果查询与验证','1','18','***','*******/******','','','','L028','','1');
REPLACE INTO `p8_forms_item_banshigongshi` VALUES ('24624','M4313822016052500057','市人社局','傅桂明办理失业保险待遇申领事项','1464278400','1');
REPLACE INTO `p8_forms_item_bmjx` VALUES ('40','2','马云','8','2','6','1','20','180','1','');
REPLACE INTO `p8_forms_item_bmjx` VALUES ('41','3','燕青','5','2','2','1','0','0','4','');
REPLACE INTO `p8_forms_item_bmjx` VALUES ('42','7','罗宾勋','15','4','12','2','20','100','1','');
REPLACE INTO `p8_forms_item_bmjx` VALUES ('43','11','廖华天','5','2','5','2','20','50','2','');
REPLACE INTO `p8_forms_item_bmjx` VALUES ('44','8','爱施德','4','2','4','1','10','20','3','');
REPLACE INTO `p8_forms_item_bmjx` VALUES ('45','15','罗军','7','2','6','2','23','89','2','');
REPLACE INTO `p8_forms_item_bmjx` VALUES ('46','12','王杰','2','3','2','1','12','35','3','');
REPLACE INTO `p8_forms_item_bmjx` VALUES ('47','5','海滨','20','2','20','1','50','160','1','');
REPLACE INTO `p8_forms_item_bmjx` VALUES ('63','3','代玲','0','3','0','1','12','0','1','');
REPLACE INTO `p8_forms_item_bmjx` VALUES ('64','5','王伟中','1','2','1','2','0','0','2','1200');
REPLACE INTO `p8_forms_item_bmtajx` VALUES ('10','1','某人','12','2','3','4','5','6','345','2','0','0','0','0','0','0','0','2','2','0','456345645','1','0','');
REPLACE INTO `p8_forms_item_bmtajx` VALUES ('34','15','廖化天','12','5','4','2','1','1','1500','2','0','0','0','0','0','0','0','1','1','50','231321','2','0','');
REPLACE INTO `p8_forms_item_bmtajx` VALUES ('35','8','梁建根','12','6','3','1','1','1','860','2','0','0','0','0','0','0','0','2','2','0','654645645','1','0','');
REPLACE INTO `p8_forms_item_bmtajx` VALUES ('36','1','罗冰','12','1','1','0','0','1','50','1','0','0','0','0','0','0','0','2','1','0','456646','1','0','');
REPLACE INTO `p8_forms_item_bmtajx` VALUES ('37','16','陈星','12','2','2','1','5','1','200','2','3','2','4','200','50','60','40','3','','10','56456456','2','0','');
REPLACE INTO `p8_forms_item_bmtajx` VALUES ('38','9','王新宇','12','3','3','2','1','0','670','2','0','0','0','0','0','0','0','1','2','0','4564564','1','0','');
REPLACE INTO `p8_forms_item_bmtajx` VALUES ('39','6','艾丝凡','12','3','3','2','1','5','700','1','4','5','4','4','50','50','50','2','1','500','5464564','2','0','');
REPLACE INTO `p8_forms_item_bmtajx` VALUES ('65','4','张小亮','3','15','13','5','3','5','300','1','0','0','0','0','0','0','0','1','1','0','46564','1','0','');
REPLACE INTO `p8_forms_item_bmtajx` VALUES ('66','6','戴笠','3','5','5','3','2','0','500','1','0','0','0','0','0','0','0','1','1','0','4454','1','0','');
REPLACE INTO `p8_forms_item_bmtajx` VALUES ('67','10','毛小龙','3','10','5','1','4','2','500','1','0','0','0','0','0','0','0','1','1','0','的发生地','1','0','');
REPLACE INTO `p8_forms_item_bmtajx` VALUES ('151','4','规范化','4','234','32','234','234','234','234','2','56','46','45','234','56','343','234','1','1','678','1231231','1','5678','');
REPLACE INTO `p8_forms_item_bmtajx` VALUES ('154','3','fgh','3','45','45','0','0','0','0','2','0','10','10','200','200','100','400','1','1','456','sdfsdfsdf','2','560','');
REPLACE INTO `p8_forms_item_bom` VALUES ('24580','国微市西林麻鸭养殖与深加工项目','',' 项目经济效益分析：项目建成后，预计年收入5000万元，三年内可收回投资。\r\n  项目已具备条件及进展情况：完成项目选址。\r\n  产业背景及优势：西林属亚热带湿润气候区，四季分明，气候宜人，冬暖夏凉，雨量充沛。县境内的水系发达，大小河流30多条，总长1227公里，适合建设鸭场。西林麻鸭因其肉无腥味，肉质鲜嫩、肉汤甜美等特点而闻名于世。西林麻鸭习惯于山间水田、水沟觅食，寻食能力强，养易肥。饲养麻鸭是西林的传统优势项目，养殖户养殖经验丰富。\r\n  产业概况：肉鸭是我国大宗的加工农副产品，一些加工厂的年加工量达','gw457877888','西林县普合乡','1','新建200万羽麻鸭养殖基地和板鸭、蛋品加工厂','1','广西百色市西林县','1','总投资额.5亿元人民币，拟引进.5亿元人民币。','2015年—2017年');
REPLACE INTO `p8_forms_item_bumengtiang` VALUES ('18','刘小军','3','更加OK','3213123','2132112312','2','2132321','2321','120','2321','3','','');
REPLACE INTO `p8_forms_item_bumengtiang` VALUES ('19','张海','6','423423','234234','2342323432','2','32423','23423','500','2343','3','','');
REPLACE INTO `p8_forms_item_bumengtiang` VALUES ('20','王海滨','4','234234','234234','','3','2476800','57600','324','34234','3','','朱国祥');
REPLACE INTO `p8_forms_item_bumengtiang` VALUES ('21','黄文略','9','234234','23444564564556','','3','1785600','-28800','100','','3','','朱国祥');
REPLACE INTO `p8_forms_item_bumengtiang` VALUES ('22','刘备雄','1','23432','23432432','','1','1872000','','200','','1','','张三丰');
REPLACE INTO `p8_forms_item_bumengtiang` VALUES ('23','王立军','11','324234','234234','','2','1785600','-28800','300','','1','','朱国祥');
REPLACE INTO `p8_forms_item_bumengtiang` VALUES ('24','朱立伦','5','23423','2342323','','1','2563200','-28800','10','','1','','刘利害');
REPLACE INTO `p8_forms_item_bumengtiang` VALUES ('82','张正东','5','生产设备螺丝选型问题','详细内容看附件','','2','-28800','-28800','100','21323','3','','朱国祥');
REPLACE INTO `p8_forms_item_bumengtiang` VALUES ('81','刘晓梅','7','如何改良产品准确性的提案','改良产品准确性的提案','','3','2563200','-28800','50','www.php168.net','3','','朱国祥');
REPLACE INTO `p8_forms_item_bumengtiang` VALUES ('83','王小琴','3','如何加大销售部的代理商管理','何加大销售部的代理商管理，正文如下','','3','1300982400','1299772800','100','12312','3','张三，李四，王五','朱国祥');
REPLACE INTO `p8_forms_item_bybd1` VALUES ('372','345345','345435','1','1309795200','34543','2','34534534','','34534');
REPLACE INTO `p8_forms_item_bybd2` VALUES ('214','公安局','张小川','10','110','无','无','','广东省广州市龙口西','www.php168.net','');
REPLACE INTO `p8_forms_item_bybd2` VALUES ('246','公司行政部','***','13','********/*******','***********','***********','','','http://','');
REPLACE INTO `p8_forms_item_bybd2` VALUES ('377','aa','aa','2','aa','111111','','','','http://','');
REPLACE INTO `p8_forms_item_bybd2` VALUES ('432','3423r','dfasdfd','1','432543556546','4543543','43543@12.com','','','','');
REPLACE INTO `p8_forms_item_bybd3` VALUES ('419','345','34534535','1','1330358400','34534','');
REPLACE INTO `p8_forms_item_bybd3` VALUES ('274','dds','ddd','1','1318867200','','');
REPLACE INTO `p8_forms_item_bybd3` VALUES ('370','312312','123123','1','1310313600','','');
REPLACE INTO `p8_forms_item_bybd3` VALUES ('381','21321','213','1','1314806400','','');
REPLACE INTO `p8_forms_item_bybd3` VALUES ('385','1112','1122','1','1318348800','','');
REPLACE INTO `p8_forms_item_bybd4` VALUES ('368','23432','1','23423','23423');
REPLACE INTO `p8_forms_item_bybd4` VALUES ('383','姓名','2','报修事项 ','请填入报修事项  需维护的设备，将具体状况描述下 fgdf');
REPLACE INTO `p8_forms_item_bybd4` VALUES ('387','000000','3','00000','000000000000000');
REPLACE INTO `p8_forms_item_bybd4` VALUES ('417','王志东','2','电脑不能启动',' 不能启动，检查过电源了。');
REPLACE INTO `p8_forms_item_bybd4` VALUES ('418','郭台铭','1','认为切尔','人味儿额外人味儿');
REPLACE INTO `p8_forms_item_bybd6` VALUES ('443','4','','1','刘海军','1492012800','23422323432','1','2342334343','56678','1');
REPLACE INTO `p8_forms_item_bybd7` VALUES ('388','erwerq','','0','0','0','','','');
REPLACE INTO `p8_forms_item_bybd7` VALUES ('389','','','0','0','0','1','','');
REPLACE INTO `p8_forms_item_bybd7` VALUES ('390','','','0','0','0','','','');
REPLACE INTO `p8_forms_item_bybd7` VALUES ('391','','','0','0','0','','','');
REPLACE INTO `p8_forms_item_bybd7` VALUES ('392','李某人','','0','0','0','','','');
REPLACE INTO `p8_forms_item_bybd7` VALUES ('393','张某人','','0','0','0','1','','当天我到了，刷卡机器有问题没能签到。');
REPLACE INTO `p8_forms_item_bybd7` VALUES ('394','李某人','','0','0','0','','','');
REPLACE INTO `p8_forms_item_bybd7` VALUES ('395','张某人','','0','0','0','1','','当天我到了，刷卡机器有问题没能签到。');
REPLACE INTO `p8_forms_item_bybd7` VALUES ('396','李某人','','0','0','0','','','');
REPLACE INTO `p8_forms_item_bybd7` VALUES ('397','张某人','','0','0','0','1','10','当天我到了，刷卡机器有问题没能签到。');
REPLACE INTO `p8_forms_item_caigougongzhang` VALUES ('165','678678768','3','67867876867','86786786','','67867867','867867867');
REPLACE INTO `p8_forms_item_caigougongzhang` VALUES ('157','S1001','1','电脑为何经常重启的原因','1、突然黑屏；2:、突然蓝屏；3:、突然重启','苹果规格书.rar<!--#p8_r_attach1#-->/core/forms/2011_03/15_17/f20defc3fed27d8a.rar','无','HP电脑');
REPLACE INTO `p8_forms_item_caigougongzhang` VALUES ('164','67867876','1','568675','568678676876','','576868678','6867');
REPLACE INTO `p8_forms_item_caigougongzhang` VALUES ('166','786786','1','678678','678678','','67867','678678');
REPLACE INTO `p8_forms_item_canpinjc` VALUES ('115','马达','N1002255','稳压电源、万用表','调节稳压电源0.75-1.6V，马达均能正常运转','','苹果规格书.rar<!--#p8_r_attach1#-->/core/forms/2011_03/15_17/f20defc3fed27d8a.rar','%e6%88%bf%e5%9c%b0%e4%ba%a71111.jpg<!--#p8_r_attach1#-->/core/forms/2011_03/23_15/ac4814950239c868.jpg<!--#p8_r_attach1#-->/core/forms/2011_03/23_15/ac4814950239c868.jpg.thumb.jpg','毛小孩','','','1','1');
REPLACE INTO `p8_forms_item_canpinjc` VALUES ('132','润滑油','02030405','温度计','12312312、士大夫说道','','','','23432','','','1','2');
REPLACE INTO `p8_forms_item_canpinjc` VALUES ('367','23324','2423432','23423','23423423423','','','','234234','','','2','2');
REPLACE INTO `p8_forms_item_cgbbd` VALUES ('427','324','23423423','423423423','','','','','');
REPLACE INTO `p8_forms_item_cgjhxq` VALUES ('215','HP电脑','0201006','2台','2','1307376000','X20110506001','S20111056001','销售部新增人员','马小龙','1','1','','');
REPLACE INTO `p8_forms_item_cgjhxq` VALUES ('363','23423','4234234','234234','1','1310313600','23423','234234','23423','23423423','2','1','23423424','');
REPLACE INTO `p8_forms_item_ckslfl` VALUES ('216','马达','1214454454','1','1','4','1306857600','南科大','N4565654','500个','420个','','','','','','','','','','','');
REPLACE INTO `p8_forms_item_ckslfl` VALUES ('252','螺丝钉0406','0203002','3','1','6','1307462400','','','','','','','','','','5月份库存总5200个','5月份共发料1000个','','','','5月底库存800个');
REPLACE INTO `p8_forms_item_ckslfl` VALUES ('365','312','2312','1','1','3','1310313600','12312','12321','312321','321312','312312','','','','','','','','','12321','');
REPLACE INTO `p8_forms_item_ckslfl` VALUES ('366','234234','234234','1','3','3','1310313600','234234','234234','234234','234234','32432432','','','','','','','','','23423','');
REPLACE INTO `p8_forms_item_dangweixingzhen` VALUES ('441','20101122057344588691.jpg<!--#p8_attach#-->/core/forms/2014_11/10_10/e6bbe167bee26e8b.jpg<!--#p8_attach#-->/core/forms/2014_11/10_11/216db2eace30c53f.jpg.thumb.jpg','科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果','1245c211m@qq.com','刘三才','教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介教师简介','行政楼A-505','代数， 有限群的表示论');
REPLACE INTO `p8_forms_item_dingcang` VALUES ('425','42','23423','1','234','234','2','342','23423','234','234');
REPLACE INTO `p8_forms_item_dlxstc` VALUES ('49','南方科技','刘生','23423','5666','4545','1','345345','','1','4','123456');
REPLACE INTO `p8_forms_item_gdzc` VALUES ('93','惠普电脑-N001','020106','2','张小军','5000','1236787200','1','1300204800','刘茂军','惠普电脑<!--#p8_r_attach1#-->/core/forms/2011_03/15_17/240d3c9932a9eae6.jpg<!--#p8_r_attach1#-->/core/forms/2011_03/15_17/240d3c9932a9eae6.jpg.thumb.jpg','苹果规格书.rar<!--#p8_r_attach1#-->/core/forms/2011_03/15_17/f20defc3fed27d8a.rar','213123','','');
REPLACE INTO `p8_forms_item_gdzc` VALUES ('129','奔驰汽车','G020108','4','廖华天','500000','924796800','1','1301587200','张小雨','%e6%88%bf%e5%9c%b0%e4%ba%a71111.jpg<!--#p8_r_attach1#-->/core/forms/2011_03/23_15/ac4814950239c868.jpg<!--#p8_r_attach1#-->/core/forms/2011_03/23_15/ac4814950239c868.jpg.thumb.jpg','苹果规格书.rar<!--#p8_r_attach1#-->/core/forms/2011_03/15_17/f20defc3fed27d8a.rar','','','');
REPLACE INTO `p8_forms_item_gdzc` VALUES ('150','打印机','G201526','5','周龙龙','5000','1238601600','1','1301846400','刘栋','11.jpg<!--#p8_r_attach1#-->/core/forms/2011_04/04_21/471ff7edcbfa9367.jpg<!--#p8_r_attach1#-->/core/forms/2011_04/04_21/471ff7edcbfa9367.jpg.thumb.jpg','','','','张小封');
REPLACE INTO `p8_forms_item_gongzi` VALUES ('172','林志颖','2','5','','1024','','0','php168.net','1','5588','1306857600','','','','');
REPLACE INTO `p8_forms_item_gongzi` VALUES ('173','高志','1','1','','370202198210104536','','0','654321','1','5588','1306857600','2102','1','1304265600','');
REPLACE INTO `p8_forms_item_gysfk` VALUES ('114','国微软件','N1005','1302624000','刘蓓蓓','先处理部分','');
REPLACE INTO `p8_forms_item_gzqs` VALUES ('281','123','2','1','2','1','1','2345','3455','5','5');
REPLACE INTO `p8_forms_item_huodongbm` VALUES ('118','刘军马','3','020-26598956565','1245786545','2','希望加入到活动当中来','');
REPLACE INTO `p8_forms_item_huodongbm` VALUES ('266','sdfsdfsd','6','212312312','0','1','sdsdas','');
REPLACE INTO `p8_forms_item_huodongbm` VALUES ('273','234324','2','234234','0','1','234234','');
REPLACE INTO `p8_forms_item_huodongbm` VALUES ('343','2342343','2','23423432','0','1','234234342234234','');
REPLACE INTO `p8_forms_item_jdbbd` VALUES ('429','刘军','1','','','15989523698','dfsdfdsfs@163.com','电信02-1','2','学习部长');
REPLACE INTO `p8_forms_item_jiangshi` VALUES ('440','201122710224574742.gif<!--#p8_attach#-->/core/forms/2014_11/10_13/64e19f9df6d8fff1.gif<!--#p8_attach#-->/core/forms/2014_11/10_13/64e19f9df6d8fff1.gif.thumb.jpg','1.<a href=\"http://www.ams.org/mathscinet/search/publications.html?pg1=IID&amp;s1=660135\">Li, Shu Hai</a>; <a href=\"http://www.ams.org/mathscinet/search/publications.html?pg1=IID&amp;s1=790063\">Dai, Jin Jun</a>; <a href=\"http://www.ams.org/mathscinet/searc','jjdai@mail.ccnu.edu.cn','程亮','学习经历：<br />\r\n&nbsp;&nbsp; 2000~2005&nbsp;&nbsp;&nbsp; 武汉大学数学与统计学院&nbsp;&nbsp;基础数学专业&nbsp; &nbsp;获博士学位；<br />\r\n&nbsp;&nbsp; 1996~2000&nbsp;&nbsp;&nbsp; 中国石油大学(华东) 数学院&nbsp;&nbsp; 计算数学及应用软件专业&nbsp; 获学士学位。<br />\r\n工作经历：<br />\r\n&nbsp;&nbsp; 2005~今&nbsp;&nbsp;&','行政楼A-507','代数， 有限群的表示论');
REPLACE INTO `p8_forms_item_jiaoshou` VALUES ('437','刘三思','研究方向研究方向研究方向研究方向','科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果科研成果','1245commm@qq.com','行政楼A-508','11.jpg<!--#p8_attach#-->/core/forms/2015_01/10_12/96307c04c047f17c.jpg<!--#p8_attach#-->/core/forms/2015_01/10_12/96307c04c047f17c.jpg.thumb.jpg','2343');
REPLACE INTO `p8_forms_item_jiaoshou` VALUES ('438','董才林','计算机网络、云计算、智能计算与信息处理、统计应用','科研项目：<br />\r\n1.在研项目：合作研究：农产品质量安全监测系统，国家科技部，项目编号2011GB2D10002；<br />\r\n2.在研项目：合作研究：动态网络环境下的服务组合、重建与优化的研究，国家自然科学基金，合作，项目批准号：61070182；<br />\r\n3.合作研究：网络环境下的服务管理的基础理论研究，国家自然科学基金，合作，项目批准号：60873192；<br />\r\n4.合作研究：网络环境下自适应服务组合关键技术研究，国家自然科学基金，合作，项目批准号：60873193','cldong@mail.ccnu.edu.cn','行政楼A-507','11.jpg<!--#p8_attach#-->/core/forms/2015_01/10_12/96307c04c047f17c.jpg<!--#p8_attach#-->/core/forms/2015_01/10_12/96307c04c047f17c.jpg','董才林，1963年6月16日生于湖北省武汉市，教授。<br />\r\n华中科技大学管理学院博士毕业（管理科学与工程方向）。<br />\r\n中国现场统计研究会资源与环境统计分会常务理事。<br />\r\n电话：13307173822<br />\r\n电子邮件：<a href=\"mailto:cldong@mail.ccnu.edu.cn\">cldong@mail.ccnu.edu.cn</a>');
REPLACE INTO `p8_forms_item_jixiaobiaoyan` VALUES ('1','昌启锋','2','http://nw.php168.net/index.php','0','0','','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','','');
REPLACE INTO `p8_forms_item_jixiaobiaoyan` VALUES ('2','小六子','1','http://nw.php168.net/index.php','0','0','','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','','');
REPLACE INTO `p8_forms_item_jixiaobiaoyan` VALUES ('9','昌启锋','5','6','30','456','1','3','2','5','20','20','200','5','6','2','0','0','3000','30','200','1000','1','300');
REPLACE INTO `p8_forms_item_jixiaobiaoyan` VALUES ('14','晓燕','1','2','10','300','1','0','0','0','0','100','0','12','8','0','0','0','600','3','100','3000','1','1500');
REPLACE INTO `p8_forms_item_jixiaobiaoyan` VALUES ('16','晓燕','1','1','12','100','1','1','1','0','0','20','0','10','8','2','0','0','500','0','0','1620','1','300');
REPLACE INTO `p8_forms_item_jixiaobiaoyan` VALUES ('53','刘生生','3','3','56','560','1','0','0','2','48','100','10','3','2','0','0','0','300','0','0','200','','120');
REPLACE INTO `p8_forms_item_jixiaobiaoyan` VALUES ('54','张龙梦','8','3','0','0','1','0','0','0','0','50','0','1','1','1','0','0','200','12','36','3500','1','1000');
REPLACE INTO `p8_forms_item_jixiaobiaoyan` VALUES ('55','包云中','12','3','5','100','2','5','0','2','48','80','15','3','3','2','1','0','500','0','0','1860','2','150');
REPLACE INTO `p8_forms_item_jixiaobiaoyan` VALUES ('56','张水仙','8','3','3','60','1','0','0','0','0','100','10','0','2','0','0','0','100','0','0','1500','1','200');
REPLACE INTO `p8_forms_item_jixiaobiaoyan` VALUES ('59','何好懂','5','3','5','100','2','3','0','1','2','100','20','5','4','3','0','1','300','0','0','2300','1','1000');
REPLACE INTO `p8_forms_item_jixiaobiaoyan` VALUES ('60','张治中','11','3','0','0','1','0','0','0','2','100','5','5','2','0','0','0','250','0','0','1500','3','150');
REPLACE INTO `p8_forms_item_jixiaobiaoyan` VALUES ('61','张浩然','8','3','5','100','2','5','2','2','48','100','20','1','1','0','0','1','20','1','10','1200','2','500');
REPLACE INTO `p8_forms_item_jixiaobiaoyan` VALUES ('62','王常贵','6','3','2','40','2','2','1','0','0','150','13','2','2','1','0','1','300','0','0','300','3','50');
REPLACE INTO `p8_forms_item_jixiaobiaoyan` VALUES ('265','dd','1','1','0','0','','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','','0');
REPLACE INTO `p8_forms_item_jixiaobiaoyan` VALUES ('378','要','1','1','0','0','1','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','','0');
REPLACE INTO `p8_forms_item_jixiaobiaoyan` VALUES ('384','撒地方的说法','1','1','0','0','','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','','0');
REPLACE INTO `p8_forms_item_jixiaobiaoyan` VALUES ('400','123','1','1','0','0','2','31','31','31','31','0','9000','0','0','0','0','0','0','0','0','0','','0');
REPLACE INTO `p8_forms_item_jixiaobiaoyan` VALUES ('405','请问','1','1','0','0','','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','','0');
REPLACE INTO `p8_forms_item_jixiaobiaoyan` VALUES ('406','232323','1','2','0','0','','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','','0');
REPLACE INTO `p8_forms_item_kehu` VALUES ('442','','1','30','1489593600','23432','1','23434324232332','234','432','32432','1','1','1','2343232','2343','3242','23432','23432','234','23432','2','1','','93364-33379');
REPLACE INTO `p8_forms_item_kehucj` VALUES ('206','刘海龙','1','5','1305820800','广州国微软件','刘海军','020-25698785','N23434234232','购买国微企业内网方案','2800','2','0','','','','');
REPLACE INTO `p8_forms_item_kq` VALUES ('374','玩儿玩儿','3','2','1','1309190400','2342','23423423423','23423','','','','');
REPLACE INTO `p8_forms_item_kq` VALUES ('411','潘亮亮','3','1','9','1329840000','4','出去办事','','','','','');
REPLACE INTO `p8_forms_item_kq` VALUES ('415','‘快快捷键','4','1','2','1329235200','9','将怒旌盔','123456','','','','');
REPLACE INTO `p8_forms_item_mimaxiugai` VALUES ('279','王明','it','2','123','123','多打点');
REPLACE INTO `p8_forms_item_mimaxiugai` VALUES ('280','王明','it','1','123','123','多打点');
REPLACE INTO `p8_forms_item_mimaxiugai` VALUES ('401','fd','fdf','1','','123456','');
REPLACE INTO `p8_forms_item_paiban` VALUES ('11','昌启峰','2011-1-25','1','会议安排','2','请查看具体详情','1','7','','','','');
REPLACE INTO `p8_forms_item_paiban` VALUES ('12','杨柳、张宇、刘三全、东三只、吴高','2011-1-26','16','网络割接','2','请查看具体详情','2','4','','','','');
REPLACE INTO `p8_forms_item_paiban` VALUES ('13','戴晓燕、张东西、百姓全、张雪莲、','2011-1-14','10','月度财务审核','2','请查看具体详情','1','2','','','','');
REPLACE INTO `p8_forms_item_paiban` VALUES ('95','罗正飞','2011-4-20','1','斯蒂芬里啦','1','请查看具体详情','1','1','','','','');
REPLACE INTO `p8_forms_item_paiban` VALUES ('96','张国微','2011-5-1','3','制定采购计划','2','请查看具体详情','2','3','','','','');
REPLACE INTO `p8_forms_item_paiban` VALUES ('97','张三丰','2011-3-20','8','仓库整改','1','请查看具体详情','1','3','','','','');
REPLACE INTO `p8_forms_item_paiban` VALUES ('98','张瑞','2011-4-1','6','统计售后问题','1','请查看具体详情','1','1','','','','');
REPLACE INTO `p8_forms_item_paiban` VALUES ('99','罗宾勋','2011-3-12','5','生产线调整','1','请查看具体详情','3','3','','','','');
REPLACE INTO `p8_forms_item_paiban` VALUES ('100','杨有才','2011-4-1','2','三季度销售总结','2','请查看具体详情','1','5','','','','');
REPLACE INTO `p8_forms_item_paiban` VALUES ('101','张小军','2011-4-1','1','季度总结大会','2','请查看具体详情','3','6','http://','1302537600','','');
REPLACE INTO `p8_forms_item_paiban` VALUES ('102','周俊','2011-3-2','4','G168项目','1','请查看具体详情','1','7','http://','1302624000','','');
REPLACE INTO `p8_forms_item_paiban` VALUES ('103','张星','2010-3-19','7','G108批次产品测试','2','请查看具体详情','1','3','http://','1297785600','','');
REPLACE INTO `p8_forms_item_paiban` VALUES ('104','王小峰','2010-3-12','13','配合售后部派车','1','主要处理常规事项','1','4','http://','1308931200','','');
REPLACE INTO `p8_forms_item_paiban` VALUES ('124','刘俊杰','9月4日14：00--5日19：00','4','打扫卫生，处理阶梯一室','1','打扫卫生','2','3','http://','1307548800','','');
REPLACE INTO `p8_forms_item_paiban` VALUES ('147','刘小军、朱晓中','9月4日14：00--5日19：00','1','企业安保值班','2','刘小军看监控室、朱晓中门岗值班','2','4','http://','1307289600','','');
REPLACE INTO `p8_forms_item_paiban` VALUES ('158','2342342423','5月06日17：30--23：00 ','15','会议布置','3','12121','2','2','http://www.php168.net','1308153600','','');
REPLACE INTO `p8_forms_item_paiban` VALUES ('167','34534534','345345','4','345435','3','345345345','345435','2','345345','','','');
REPLACE INTO `p8_forms_item_paiban` VALUES ('346','34534534','345345','4','345435','3','345345345','345435','2','http://345345','','','');
REPLACE INTO `p8_forms_item_paiban` VALUES ('348','刘小军、朱晓中','9月4日14：00--5日19：00','1','企业安保值班','2','刘小军看监控室、朱晓中门岗值班','2','4','http://','1307289600','','');
REPLACE INTO `p8_forms_item_paiban` VALUES ('350','王小峰','2010-3-12','13','配合售后部派车','1','主要处理常规事项','1','4','http://','1308931200','Z12021501','');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('7','30','杨柳','1','','8月18','充电','','','15','4','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('8','18','晓燕','1','杨柳','8月18、19晚上','撒地方四大发','7月20号','斯蒂芬撒打发','15','4','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('15','20','晓燕','1','','8月18、19','财务培训','','','14','4','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('48','28','刘海鸥','6','','8月18、19','执行力方面的培训需求','','','13','4','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('49','26','张东健','2','','3月18、19晚上均可','接受相关新员工的培训锻炼','','','13','4','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('50','28','','1','刘军军','','','3月份晚上均可，除周末','给学员处理相关事宜','13','3','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('51','14','马云龙','2','','3月18、19晚上','希望得到销售提高','','','13','4','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('52','10','','9','刘生生','','','3月20、22晚上','给学员上生产课程','13','3','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('57','20','','8','周智慧','','','3月20、22晚上均可','申请报名，希望可以得到支持','13','3','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('58','24','田丽丽','1','','3月份均可','接受公司安全培训应用','','','13','4','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('68','16','周海红','9','','3月份下班均可','主要是想提高生产设计这块的知识','','','13','4','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('69','12','刘婷婷','13','','3月18、19晚上均可','希望得到学习盘点物料的机会','','','13','4','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('70','22','吴长龙','3','','3月18、19','提案的技巧这块处理','','','13','4','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('71','27','包场填','8','','3月18、19晚上均可','学会国微内网操作','','','13','4','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('72','30','','4','马丽云','','','3月20、22晚上均可','给学员处理提案这块','13','3','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('73','27','','12','周智慧','','','3月20、22晚上均可','学习信息化','13','3','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('74','14','','2','东海滨','','','3月20、22晚上均可','处理','13','3','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('75','6','','6','周智慧','','','3月20、22晚上均可','123213','13','3','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('76','24','','2','王长远','','','3月20、22晚上均可','授课','13','3','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('77','18','','3','王伟','','','3月20、22晚上均可','授课','13','3','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('78','26','','1','朱孝天','','','3月20、22晚上均可','授课看看','13','3','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('79','22','','8','张照样','','','3月20、22晚上均可','授课看看','13','3','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('80','12','刘海洋','13','','3月18、19晚上均可','学习进步下','','','13','4','10');
REPLACE INTO `p8_forms_item_peixinbaoming` VALUES ('410','12','','2','','','','','','13','4','10');
REPLACE INTO `p8_forms_item_peixunfangang` VALUES ('433','fdsaf','1','dfsafdasfdsafdsfewrtewdgfdsfewr4erfdsfvcxzvsf','','asdfdsafdsa','fdsaf');
REPLACE INTO `p8_forms_item_peixunfangang` VALUES ('434','fadsf','1','dsafdasfdwrewfdsafdsaf','','fdsafdsafdsaf','dasfdsaf');
REPLACE INTO `p8_forms_item_shengchan` VALUES ('119','路由器','C002','2','2','5000PCS','1300291200','朱贵平','H20110328','1','请填入相关详细信息。','','小毛');
REPLACE INTO `p8_forms_item_shengchan` VALUES ('122','自行车','N2564','3','2','5000PCS','1301500800','毛小球','C200356894','2','3242323423234','','小毛');
REPLACE INTO `p8_forms_item_shengchan` VALUES ('360','3123','312','1','2','12321','1310313600','12321','12312312','2','12312','','123213');
REPLACE INTO `p8_forms_item_shengchan` VALUES ('361','123123','3123123','2','2','12312','1310400000','2312','12312','2','','新建 Microsoft Word 文档.doc<!--#p8_attach#-->/core/forms/2011_07/11_12/e7f2877f09f80c1b.doc','12312');
REPLACE INTO `p8_forms_item_shoh` VALUES ('428','张小云','1','钟文斌，副教授，四川财经职业学院基础部语文教研室主任。主研《应用文写作》和《商务秘书学》，现主要讲授《应用文写作》《公共关系学》和《商务秘书学》。\r\n主要科研成果：\r\n1．2005年参加高等教育出版社“中等职业学校文化基础课”《语文》第一册第六单元的编写。\r\n2．2005年至2006年任五年制高职语文系列教材副主编，第一分册教材、教学参考书、多媒体课件文字脚本、同步练习册主编；同时，参编第二册第五单元教材、教学参考书、多媒体课件文字脚本、同步练习册；第三册第六单元教学参考书、第六册《财经应用文》诉讼文书及','','15989523698/020-8726356','ewrereewr@163.com','2','教授');
REPLACE INTO `p8_forms_item_tiang` VALUES ('3','23423','234','1','1','1','23423','23423','23423','23422342323423','234233','','','','','','','0','','','','');
REPLACE INTO `p8_forms_item_tiang` VALUES ('4','肖同事','','1','1','1','肖先生','提供升级了吗','系统软件提供升级了吗','Dormy.png<!--#p8_attach#-->/core/forms/2011_02/14_18/a74eee8657b79b50.png.cthumb.jpg<!--#p8_attach#-->/core/forms/2011_02/14_18/a74eee8657b79b50.png.thumb.jpg','提供升级了吗','','','','','','','0','','','','');
REPLACE INTO `p8_forms_item_tiang` VALUES ('5','王五','','2','2','2','张三','电脑中招了','电脑中招了，电脑中招了','Dormy.png<!--#p8_attach#-->/core/forms/2011_02/14_18/a74eee8657b79b50.png.cthumb.jpg<!--#p8_attach#-->/core/forms/2011_02/14_18/a74eee8657b79b50.png.thumb.jpg','电脑中招','','','','','','','0','','','','');
REPLACE INTO `p8_forms_item_tiang` VALUES ('105','王小峰','','3','2','1','罗欣','G108项目的开发流程优化','由原来的垂直开发流程可以优化为树形开发流程，多个开发步骤同时进行。','','可以缩短项目的研发时间，节省项目费用。','1300636800','1','5','处理中','4','','0','1305734400','T1125191223','','');
REPLACE INTO `p8_forms_item_tiang` VALUES ('26','张小鹏','','1','2','3','刘军','采购订单编号优化方案','现在的编号不是很好记忆和收集。&lt;br /&gt;\r\n&lt;br /&gt;\r\n建议改为公司缩写+年+月+日+随机码','案例文档案例文档','大幅提高了合同订单的阅读性。','1294156800','1','4','处理中','1','','0','','T1125191256','','');
REPLACE INTO `p8_forms_item_tiang` VALUES ('27','黄文略','','2','1','1','骏龙','代理商整理问题','现在的代理商的资料查找、统计、资料变化没有完整的整理或平台，能否信息化','1221','资料标准化','1296576000','1','5','处理中','2','','200','1305734400','T1125191225','','');
REPLACE INTO `p8_forms_item_tiang` VALUES ('28','刘云','','4','2','1','王海滨','研发物料申请流程优化','现在的研发物流申请流程过于复杂，可以优化下','121212','可以大幅节省时间','1298908800','1','5','处理中','3','','0','1305734400','T1125191240','','');
REPLACE INTO `p8_forms_item_tiang` VALUES ('29','张宇','','6','1','3','张宇','网线选型与购买方案','大量同事反应网络 不通，经过排查为网线质量问题。','','','1297180800','1','5','处理中','2','werwe','0','1305734400','T1105261235','','');
REPLACE INTO `p8_forms_item_tiang` VALUES ('30','刘龙中','','2','2','1','黄文略','销售部设立用户协调机制','现在有争议的客户资源，都是双方私下协商，希望公司出一个指导思想','','','1294070400','1','5','刘海涛','4','','0','1305734400','T1105251235','','');
REPLACE INTO `p8_forms_item_tiang` VALUES ('31','马丽丽','','2','2','3','刘婷玉','关于公司垃圾分类与实施','垃圾太多，最近实施分类，并联络好社会相应的人员，将公司的分类垃圾处理。','','','1299513600','1','5','处理中','2','','50','1305734400','T1125191260','','');
REPLACE INTO `p8_forms_item_tiang` VALUES ('32','刘备雄','','1','1','3','骏龙','企业信息化实施与方案','企业现在迫切需要上线信息化需求。','','','1299600000','1','5','处理中','2','','1000','1305734400','T1125191246','','');
REPLACE INTO `p8_forms_item_tiang` VALUES ('33','张宇','','1','1','3','骏龙','企业形象窗口公司网站的改良','企业形象窗口公司网站的改良，直接关系到公司的业务与宣传。','','','1299600000','1','5','处理中','2','','200','1305734400','T1125191245','','');
REPLACE INTO `p8_forms_item_tiang` VALUES ('106','张三丰','','8','1','2','马飞','成品存储仓库整改方案','通过对成品存储仓库的整改可以减少成品存储时不必要的损坏','','通过对成品存储仓库的整改可以减少成品存储时不必要的损坏','1300636800','1','5','玩儿，我认为，玩儿','3','士大夫士大夫','100','1305734400','T1125191240','','');
REPLACE INTO `p8_forms_item_tiang` VALUES ('107','杨柳','','3','2','1','周俊','MSC的管理平台不稳定问题','MSC的管理平台不稳定问题，导致不能进行日常的管理。','','','1300550400','1','5','士大夫，让让她，儿童','3','的风格大方发到发到','100','1305734400','T1125191239','','');
REPLACE INTO `p8_forms_item_tiang` VALUES ('108','晓燕','','2','2','2','张菲','公司营业厅装修方案','包括总体预算、设计方案、装修材料、施工队伍','','','1300896000','1','5','为二位，玩儿','2','为二位玩儿玩儿王二人','4000','1305734400','T1125191237','','');
REPLACE INTO `p8_forms_item_tiang` VALUES ('169','45455','454','3','1','3','454','45645','456464','','45465','1305648000','','','','','','0','','','','');
REPLACE INTO `p8_forms_item_tuiliaopingt` VALUES ('120','马达','1','C102125689','N12456898','华伦天奴','抽检不符规格','刘俊杰','张四通','','暂时无','','刘小毛','1301500800','2');
REPLACE INTO `p8_forms_item_tuiliaopingt` VALUES ('121','40欧热敏电阻','2','N20258964','N56023548','恒基电子','数量不足','刘俊杰','张四通','','暂时无','','刘小毛','1301500800','1');
REPLACE INTO `p8_forms_item_tuiliaopingt` VALUES ('131','显示器','1','02030509','S020315','索尼电子','有压坏','王杰出','刘海滨','','1212','','张冬储','1303488000','1');
REPLACE INTO `p8_forms_item_tuiliaopingt` VALUES ('364','2324332','2','34234','23432','423432','2342342','234234','324234','','','','234324','1311004800','2');
REPLACE INTO `p8_forms_item_vijiaoshou` VALUES ('439','20101139550924446.jpg<!--#p8_attach#-->/core/forms/2014_11/10_13/537410ade772e9ae.jpg<!--#p8_attach#-->/core/forms/2014_11/10_13/537410ade772e9ae.jpg.thumb.jpg','<p>\r\n	学术交流情况：<br />\r\n	2003.9&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：&nbsp;参加第1届中德群论国际会议<br />\r\n	2006.9-2007.1:&nbsp;北京大学数学科学学院访问学者<br />\r\n	2008.2-2008.6:&nbsp;上海外国语大学出国培训中心外语培训<br />\r\n	2008.9&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;参加第4届中','chenga9762002@aliyun.com','陈老师','教育、工作经历:&nbsp;<br />\r\n1996.9-2000.6:&nbsp;就读于华中师范大学数学系数学教育专业<br />\r\n2000.9-2005.6:&nbsp;就读于武汉大学数学统计学院,&nbsp;2005.6取得理学博士学位<br />\r\n2005.7-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;在华中师范大学数学与统计学学院工作','六号教学楼 405','代数， 有限群的表示论 ');
REPLACE INTO `p8_forms_item_wjsg` VALUES ('420','23423','2','23423424234','23432424','23423','2','2','1330531200','','','');
REPLACE INTO `p8_forms_item_wjsg` VALUES ('421','345','2','34534','345','','1','1','1330531200','','','');
REPLACE INTO `p8_forms_item_wjsg` VALUES ('422','34534','1','34534','345','','1','2','1330531200','','','');
REPLACE INTO `p8_forms_item_workbaom` VALUES ('272','耳嗡嗡 ','1','23423','2342342','23424234','23423','','');
REPLACE INTO `p8_forms_item_workbaom` VALUES ('340','234234234','2','2342342','234232','23423423234','','','');
REPLACE INTO `p8_forms_item_workbaom` VALUES ('341','3333333','3','333','333','333333','33','','');
REPLACE INTO `p8_forms_item_workbaom` VALUES ('342','23423','4','2342343','234234','23423423234','234324','','');
REPLACE INTO `p8_forms_item_workbaom` VALUES ('352','23232423','3','23432','2343242','23423423','','','');
REPLACE INTO `p8_forms_item_workbaom` VALUES ('373','2343242','2','23423424','234234','23423423432432','','','');
REPLACE INTO `p8_forms_item_workbaom` VALUES ('375','23424','3','23423','23423','23432','','','');
REPLACE INTO `p8_forms_item_workbaom` VALUES ('413','chang','2','234234','234234','23423423423432','234234','','');
REPLACE INTO `p8_forms_item_workbaom` VALUES ('414','324234','2','','23432','2343243243','3242','','');
REPLACE INTO `p8_forms_item_wuliu` VALUES ('111','通讯手机/设备','C20110319','2','手机1000条，通讯设备50个','广州天河区龙溪口建筑交易中心大厦201','刘大鹏');
REPLACE INTO `p8_forms_item_wuliu` VALUES ('112','拖拉机','N2564895','1','拖拉机10台','广州南方大厦208','中军');
REPLACE INTO `p8_forms_item_wyh` VALUES ('250','刘海龙','6','1','经过与采购商安富利的商谈，将IC5806价格减低至40元/pcs，较最近采购价格低5毛/Pcs。\r\n\r\n\r\n','','采购部工程师','2','6','1307462400','IC5806采购价格降低5毛/PCS','预计1年后，可以将节约成本3万美金。\r\n\r\n\r\n');
REPLACE INTO `p8_forms_item_xiaoshougongzhang` VALUES ('168','1213213121','2','5','4546554','1216545465','500','4654456454','1305129600','','','1','2','');
REPLACE INTO `p8_forms_item_xiaoshougongzhang` VALUES ('144','郭小薇','4','100','PS20110406','湖南三一重工集团','20000','国微内网方案1套，配套培训','1301760000','合同word文本.rar<!--#p8_attach#-->/core/forms/2011_03/15_17/f20defc3fed27d8a.rar','','1','1','');
REPLACE INTO `p8_forms_item_xiaoshougongzhang` VALUES ('145','朱风伟','4','100','PA20110406','南京卓越科技有限公司','0','南京地区国微代理权','1302624000','','','4','2','');
REPLACE INTO `p8_forms_item_xiaoshougongzhang` VALUES ('146','李桂军 ','6','100','PV20110406','云南大利集团','0','新增云南大利集团为公司供应商。','1301760000','','','3','1','');
REPLACE INTO `p8_forms_item_xiaoshougongzhang` VALUES ('271','味儿','2','100','34232','2342342','423423423','423423423423342','1306512000','','234','1','1','');
REPLACE INTO `p8_forms_item_xiaoshougongzhang` VALUES ('345','23423','6','100','3423423','士大夫','23423','23423423423','315849600','','','2','1','');
REPLACE INTO `p8_forms_item_xiaoshougongzhang` VALUES ('369','2342342','3','5','23424','23423','23423','23423423','1310313600','','','2','1','');
REPLACE INTO `p8_forms_item_xiaoshougongzhang` VALUES ('404','随碟附送的风','3','100','风set热','啥地方','1111','11111','1323705600','','','1','1','');
REPLACE INTO `p8_forms_item_xinxidian` VALUES ('208','周小龙','1','1','1305820800','1','广州国微软件科技有限公司','张三丰','020-38907975','刘海龙','2','1','1','1','','');
REPLACE INTO `p8_forms_item_xinxidian` VALUES ('209','周小龙','1','5','1305820800','2','广州国微软件科技有限公司','刘四龙','020-29865986/1569865986','经理','2','1','2','1','','');
REPLACE INTO `p8_forms_item_xinxidian` VALUES ('351','345345','2','3','1310227200','2','34534523','23452345','34543454','32453454','3','1','1','1','345345345345345435','1');
REPLACE INTO `p8_forms_item_xinxidian` VALUES ('357','2343242','2','2','1310313600','1','23432','23423','23432','23423','1','1','1','1','23423','1');
REPLACE INTO `p8_forms_item_yanfapingtai` VALUES ('113','40V变压器','C123456','2','40V，安全性高，10A电流','张小云','1','张骏龙','1','5.jpg<!--#p8_r_attach1#-->/core/forms/2011_03/15_17/240d3c9932a9eae6.jpg<!--#p8_r_attach1#-->/core/forms/2011_03/15_17/240d3c9932a9eae6.jpg.thumb.jpg','','','','1');
REPLACE INTO `p8_forms_item_zhuanan2` VALUES ('276','12312','2','1','12312321321232','1231232131','','');
REPLACE INTO `p8_forms_model` VALUES ('14','BOM','招商项目平台','1','9','0','1','253','','','list_table','','view_print3','','a:2:{s:7:\"captcha\";s:1:\"1\";s:6:\"status\";a:2:{i:1;s:9:\"已处理\";i:2;s:9:\"处理中\";}}');
REPLACE INTO `p8_forms_model` VALUES ('16','banshi','办事流程对照表','1','9','0','1','200','','','list_supplier','','view_print','','a:2:{s:7:\"captcha\";s:1:\"1\";s:6:\"status\";a:2:{i:1;s:9:\"已处理\";i:2;s:9:\"处理中\";}}');
REPLACE INTO `p8_forms_model` VALUES ('19','gysfk','在线访谈话题征集','1','9','0','1','166','post_wlwz','','list_gov','','view_print','','a:3:{s:7:\"captcha\";s:1:\"1\";s:6:\"status\";a:3:{i:1;s:9:\"已处理\";i:2;s:9:\"处理中\";i:3;s:9:\"未处理\";}s:5:\"parts\";a:1:{i:59924;a:3:{s:4:\"name\";s:42:\"请在下面表格中填写投诉或建议\";s:3:\"row\";s:1:\"1\";s:5:\"order\";s:1:\"2\";}}}');
REPLACE INTO `p8_forms_model` VALUES ('37','kehucj','政务公开申请','1','9','0','1','255','gongkai_shenqing','','gongkai_chaxun','','view_print','','a:2:{s:7:\"captcha\";s:1:\"1\";s:5:\"parts\";a:7:{i:47768;a:3:{s:4:\"name\";s:10:\"申请人类型\";s:3:\"row\";s:1:\"1\";s:5:\"order\";s:1:\"9\";}i:54120;a:3:{s:4:\"name\";s:16:\"申请政务公开信息\";s:3:\"row\";s:1:\"2\";s:5:\"order\";s:1:\"8\";}i:53440;a:3:{s:4:\"name\";s:8:\"联系地址\";s:3:\"row\";s:1:\"1\";s:5:\"order\";s:1:\"7\";}i:37599;a:3:{s:4:\"name\";s:6:\"扫描件\";s:3:\"row\";s:1:\"1\";s:5:\"order\";s:1:\"6\";}s:5:\"03444\";a:3:{s:4:\"name\";s:17:\"所 需 信 息 情 况\";s:3:\"row\";s:1:\"1\";s:5:\"order\";s:1:\"3\";}i:39712;a:3:{s:4:\"name\";s:8:\"获取方式\";s:3:\"row\";s:1:\"2\";s:5:\"order\";s:1:\"2\";}i:74611;a:3:{s:4:\"name\";s:4:\"密码\";s:3:\"row\";s:1:\"1\";s:5:\"order\";s:1:\"0\";}}}');
REPLACE INTO `p8_forms_model` VALUES ('49','ysqcx','依申请的查询','1','','0','0','0','','','','','','','a:1:{s:7:\"captcha\";s:1:\"1\";}');
REPLACE INTO `p8_forms_model` VALUES ('52','banshigongshi','办事公示平台','1','','0','1','254','','','list_table','','','','a:1:{s:7:\"captcha\";s:1:\"1\";}');
REPLACE INTO `p8_forms_model` VALUES ('199','xmtj','xmtj','1','','0','14','0','','','','','','','a:0:{}');
REPLACE INTO `p8_forms_model_field` VALUES ('159','BOM','0','name','项目名称','varchar','','1','1','0','1','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','size=\"60\"','120','','','','','请输入项目名称');
REPLACE INTO `p8_forms_model_field` VALUES ('621','BOM','0','bianhao','项目编号','varchar','','0','0','0','0','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','size=\"60\"','99','','','','','输入项目编号，没有则不填');
REPLACE INTO `p8_forms_model_field` VALUES ('622','BOM','0','xiangmudiqu','项目建设地区','varchar','','1','0','0','1','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','size=\"60\"','96','','','','','该项目建设所在地');
REPLACE INTO `p8_forms_model_field` VALUES ('633','BOM','0','youxiaoqi','项目有效期','varchar','','0','0','0','1','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','size=\"60\"','79','','','','','如：2015年—2017年');
REPLACE INTO `p8_forms_model_field` VALUES ('168','BOM','0','fujian','附件文档','varchar','','0','0','0','0','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','uploader','','5','','','','','如有附件资料，可以上传');
REPLACE INTO `p8_forms_model_field` VALUES ('169','BOM','0','beizhu','项目说明','varchar','','0','0','0','0','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','textarea','cols=\"70\" rows=\"6\"','60','','','','','详细填写项目的情况');
REPLACE INTO `p8_forms_model_field` VALUES ('184','banshi','0','name','事项名称','varchar','','1','1','0','1','255','0','1','0','','a:0:{}','a:0:{}','text','','100','','','','','请输入企业办事名称');
REPLACE INTO `p8_forms_model_field` VALUES ('185','banshi','0','bslb','事项类别','varchar','','1','0','0','1','255','0','1','0','','a:4:{i:1;s:10:\"工作业务类\";i:2;s:10:\"常见生活类\";i:3;s:10:\"文艺体育类\";i:4;s:4:\"其他\";}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','select','','96','','','','','请选择该办事类别');
REPLACE INTO `p8_forms_model_field` VALUES ('186','banshi','0','ssbm','所属管理部门','varchar','','1','1','0','1','255','0','1','0','','a:18:{i:18;s:8:\"公共部门\";i:1;s:10:\"公司领导层\";i:2;s:6:\"行政部\";i:3;s:6:\"研发部\";i:4;s:6:\"销售部\";i:5;s:6:\"售后部\";i:6;s:6:\"采购部\";i:7;s:6:\"生产部\";i:8;s:6:\"计调部\";i:9;s:6:\"仓管部\";i:10;s:6:\"质检部\";i:11;s:8:\"人力资源\";i:12;s:6:\"财务部\";i:13;s:6:\"物流部\";i:14;s:6:\"后勤部\";i:15;s:6:\"公关部\";i:16;s:6:\"网络部\";i:17;s:4:\"其他\";}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','select','','94','','','','','请选择该办事属于哪个部门');
REPLACE INTO `p8_forms_model_field` VALUES ('187','banshi','0','lxr','联络人','varchar','','1','0','0','1','255','0','1','0','','a:0:{}','a:0:{}','text','','92','','','','','请填入该事项的联系人或各部门相应岗位');
REPLACE INTO `p8_forms_model_field` VALUES ('188','banshi','0','tel','电话/手机','varchar','','1','0','0','1','255','0','1','0','','a:0:{}','a:0:{}','text','','90','','','','','请填入该联系人电话');
REPLACE INTO `p8_forms_model_field` VALUES ('538','banshi','0','sybumen','使用部门','varchar','','1','1','0','1','255','0','1','0','','a:18:{i:1;s:8:\"公共部门\";i:2;s:10:\"公司领导层\";i:3;s:6:\"行政部\";i:4;s:6:\"研发部\";i:5;s:6:\"销售部\";i:6;s:6:\"售后部\";i:7;s:6:\"采购部\";i:8;s:6:\"生产部\";i:9;s:6:\"计调部\";i:10;s:6:\"仓管部\";i:11;s:6:\"质检部\";i:12;s:6:\"财务部\";i:13;s:8:\"人力资源\";i:14;s:6:\"物流部\";i:15;s:6:\"公关部\";i:16;s:6:\"后勤部\";i:17;s:6:\"网络部\";i:18;s:8:\"其他部门\";}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','select','','95','','','','','请选择该流程可能会使用的部门');
REPLACE INTO `p8_forms_model_field` VALUES ('192','banshi','0','czsm','流程操作说明','varchar','','0','0','0','0','255','0','1','0','','a:0:{}','a:0:{}','textarea','cols=\"70\" rows=\"10\"','82','','','','','请填入该办事的具体流程说明');
REPLACE INTO `p8_forms_model_field` VALUES ('193','banshi','0','fujian','附件资料','varchar','','0','0','0','0','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','uploader','','80','','','','','该办事如有附件说明，请上传');
REPLACE INTO `p8_forms_model_field` VALUES ('194','banshi','0','lianj','链接地址','varchar','','0','0','0','0','255','0','1','0','','a:1:{s:6:\"target\";s:6:\"_blank\";}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','link','size=\"70\"','78','','','','','选填，如有相关网址详细说明，请填写');
REPLACE INTO `p8_forms_model_field` VALUES ('195','banshi','0','bianhao','流程编号','varchar','','1','1','0','0','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','98','','','','','请填入此流程的编号，没有则不填，一般是L***,如L001');
REPLACE INTO `p8_forms_model_field` VALUES ('230','gysfk','0','name','邮箱','varchar','59924-1','1','1','0','0','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','98','','','','','请输入您的邮箱，用于接收反馈信息');
REPLACE INTO `p8_forms_model_field` VALUES ('231','gysfk','0','bianma','电话/手机','varchar','59924-1','1','0','0','0','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','96','','','','','请输入您的手机或电话，用于接收反馈信息');
REPLACE INTO `p8_forms_model_field` VALUES ('236','gysfk','0','fuksj','附件','varchar','59924-1','0','0','0','0','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','uploader','','27','','','','','如有附件可上传');
REPLACE INTO `p8_forms_model_field` VALUES ('238','gysfk','0','tijiaore','写信人','varchar','59924-1','1','1','0','0','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','100','','','','','请填写投诉人姓名或昵称');
REPLACE INTO `p8_forms_model_field` VALUES ('243','gysfk','0','fkbeizhu','详细内容','varchar','59924-1','0','0','0','0','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','textarea','cols=\"70\" rows=\"8\"','28','','','','','请填写详细内容');
REPLACE INTO `p8_forms_model_field` VALUES ('334','banshi','0','tupian','图片说明','text','','0','0','0','0','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','multi_uploader','size=\"2\"','81','','','','','如有图片说明可上传');
REPLACE INTO `p8_forms_model_field` VALUES ('394','kehucj','0','xingming','姓名','varchar','54120-1','1','1','0','1','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','110','','','','','重要');
REPLACE INTO `p8_forms_model_field` VALUES ('396','kehucj','0','year','申请时间','varchar','54120-1','0','0','0','1','255','0','1','0','','a:10:{i:1;s:6:\"2011年\";i:2;s:6:\"2012年\";i:3;s:6:\"2013年\";i:4;s:6:\"2014年\";i:5;s:6:\"2015年\";i:6;s:6:\"2016年\";i:7;s:6:\"2017年\";i:8;s:6:\"2018年\";i:9;s:6:\"2019年\";i:10;s:6:\"2020年\";}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','textdate','','96','','','','','');
REPLACE INTO `p8_forms_model_field` VALUES ('397','kehucj','0','yue','信息提供方式','varchar','39712-1','0','0','0','0','255','0','1','0','','a:3:{i:1;s:4:\"纸面\";i:2;s:8:\"电子邮件\";i:3;s:4:\"光盘\";}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','radio','','88','','','','','');
REPLACE INTO `p8_forms_model_field` VALUES ('398','kehucj','0','riqi','证件类型','varchar','54120-1','1','0','0','1','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','106','','','','','');
REPLACE INTO `p8_forms_model_field` VALUES ('399','kehucj','0','kehumc','联系地址','varchar','53440-1','1','0','0','1','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','size=\"70\"','94','','','','','');
REPLACE INTO `p8_forms_model_field` VALUES ('400','kehucj','0','khlxr','电子邮箱','varchar','54120-2','0','0','0','0','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','98','','','','','');
REPLACE INTO `p8_forms_model_field` VALUES ('401','kehucj','0','khlxdh','手机号码','varchar','54120-2','0','0','0','1','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','101','','','','','接收信息');
REPLACE INTO `p8_forms_model_field` VALUES ('406','kehucj','0','htbh','工作单位','varchar','54120-2','1','1','0','1','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','108','','','','','');
REPLACE INTO `p8_forms_model_field` VALUES ('407','kehucj','0','ddnr','所属信息内容描述','varchar','03444-1','0','0','0','0','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','textarea','cols=\"70\" rows=\"10\"','93','','','','','如有详细内容可提交');
REPLACE INTO `p8_forms_model_field` VALUES ('612','gysfk','0','tsbt','话题标题','varchar','59924-1','1','0','0','1','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','size=80','80','','','','','请输入话题标题');
REPLACE INTO `p8_forms_model_field` VALUES ('409','kehucj','0','sjcjjg','证件扫描件','varchar','37599-1','0','0','0','0','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','uploader','size=\"10\"','103','','','','','');
REPLACE INTO `p8_forms_model_field` VALUES ('410','kehucj','0','fkqk','获取信息方式','varchar','39712-2','0','0','0','0','255','0','1','0','','a:5:{i:1;s:4:\"邮寄\";i:2;s:8:\"电子邮件\";i:3;s:4:\"传真\";i:4;s:8:\"自行领取\";i:5;s:12:\"当场阅读抄录\";}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','select','','80','','','','','');
REPLACE INTO `p8_forms_model_field` VALUES ('645','banshigongshi','0','xiangmumingchen','项目名称','varchar','','1','0','0','1','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','size=100','12','','','','','');
REPLACE INTO `p8_forms_model_field` VALUES ('646','banshigongshi','0','shijjian','办理时间','varchar','','1','0','0','1','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','textdate','','6','','','','','');
REPLACE INTO `p8_forms_model_field` VALUES ('647','banshigongshi','0','zhuagntai','状态','varchar','','0','0','0','1','255','0','1','0','','a:2:{i:1;s:8:\"一般办结\";i:2;s:8:\"等待办理\";}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','select','','4','','','','','');
REPLACE INTO `p8_forms_model_field` VALUES ('643','banshigongshi','0','bianhao','办件编号','varchar','','1','0','0','1','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','15','','','','','');
REPLACE INTO `p8_forms_model_field` VALUES ('644','banshigongshi','0','shouli','受理单位','varchar','','1','0','0','1','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','10','','','','','');
REPLACE INTO `p8_forms_model_field` VALUES ('616','kehucj','0','mima','查询密码','int','74611-1','0','0','0','1','20','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','7','','','','','请输入查询密码的数字，并记住');
REPLACE INTO `p8_forms_model_field` VALUES ('617','kehucj','0','zhengjhaom','证件号码','varchar','54120-2','0','0','0','1','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','104','','','','','');
REPLACE INTO `p8_forms_model_field` VALUES ('618','kehucj','0','leixing','申请人类型','varchar','47768-1','0','0','0','1','255','0','1','0','','a:2:{i:1;s:4:\"公民\";i:2;s:13:\"法人/其他组织\";}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','radio','','120','','','','','');
REPLACE INTO `p8_forms_model_field` VALUES ('619','kehucj','0','chuanzhen','传真','varchar','54120-1','0','0','0','1','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','99','','','','','');
REPLACE INTO `p8_forms_model_field` VALUES ('620','kehucj','0','yogntu','所需信息用途','varchar','03444-1','0','0','0','1','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','textarea','cols=\"70\" rows=\"10\"','91','','','','','');
REPLACE INTO `p8_forms_model_field` VALUES ('623','BOM','0','xiangmuzhuangtai','项目状态','varchar','','1','0','0','1','255','0','1','0','','a:2:{i:1;s:8:\"正在招商\";i:2;s:8:\"已经结束\";}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','select','','78','','','','','选择项目此时状态');
REPLACE INTO `p8_forms_model_field` VALUES ('624','BOM','0','gaishu','项目概述','varchar','','0','0','0','1','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','size=\"100\"','81','','','','','一句话说明项目情况');
REPLACE INTO `p8_forms_model_field` VALUES ('625','BOM','0','hezuofangshi','合作方式','varchar','','1','0','0','1','255','0','1','0','','a:3:{i:1;s:4:\"合资\";i:2;s:4:\"独资\";i:3;s:4:\"其他\";}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','select','','85','','','','','选择项目合作方式');
REPLACE INTO `p8_forms_model_field` VALUES ('626','BOM','0','shudi','项目属地','varchar','','0','0','0','1','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','size=\"60\"','98','','','','','项目所属地区');
REPLACE INTO `p8_forms_model_field` VALUES ('628','BOM','0','leibie','项目类别','varchar','','0','0','0','1','255','0','1','0','','a:5:{i:1;s:8:\"工业项目\";i:2;s:8:\"农业项目\";i:3;s:8:\"旅游文化\";i:4;s:8:\"商贸物流\";i:5;s:8:\"其他项目\";}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','select','','91','','','','','项目的行业类别；不清楚的选择其他项目');
REPLACE INTO `p8_forms_model_field` VALUES ('629','BOM','0','touzhi','项目拟投资/引资金额','varchar','','0','0','0','1','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','size=\"60\"','83','','','','','填写拟投资和所需引资的金额');
REPLACE INTO `p8_forms_model_field` VALUES ('648','xmtj','0','name','姓名','varchar','','0','0','0','0','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','0','','','','','');
REPLACE INTO `p8_forms_model_field` VALUES ('649','xmtj','0','telephone','电话','varchar','','0','0','0','1','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','0','','','','','');
REPLACE INTO `p8_forms_model_field` VALUES ('650','xmtj','0','email','电子邮箱','varchar','','0','0','0','0','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','0','','','','','');
REPLACE INTO `p8_forms_model_field` VALUES ('651','xmtj','0','iid','推介ID','int','','0','0','0','1','10','1','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','0','','','','','');
REPLACE INTO `p8_forms_model_field` VALUES ('652','xmtj','0','content','留言内容','varchar','','0','0','0','0','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','textarea','','0','','','','','');

