<?php
/*针对主站与分站的数据对接的升级*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "CREATE TABLE IF NOT EXISTS `p8_sites_item_matrix` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '对接分站信息ID',
  `scid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '对接分站栏目ID',
  `cid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '对接主站栏目ID',
  `iid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '对接主站信息ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, false);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略，请进后台更新全站缓存";
