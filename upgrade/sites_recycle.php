<?php
/*针对站群增加恢复分站功能的升级2019.7.15*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "CREATE TABLE IF NOT EXISTS `p8_sites_site_recycle` (  `id` mediumint( 8  )  unsigned NOT  NULL  AUTO_INCREMENT ,
 `parent` smallint( 5  )  unsigned NOT  NULL DEFAULT  '0',
 `sitename` varchar( 20  )  NOT  NULL DEFAULT  '',
 `alias` varchar( 100  )  NOT  NULL DEFAULT  '',
 `ip` varchar( 255  )  NOT  NULL DEFAULT  '',
 `point` varchar( 10  )  NOT  NULL DEFAULT  '',
 `domain` varchar( 255  )  NOT  NULL DEFAULT  '',
 `ipordomain` tinyint( 1  )  NOT  NULL DEFAULT  '0',
 `manager` varchar( 255  )  NOT  NULL DEFAULT  '',
 `manager_role` varchar( 255  )  NOT  NULL DEFAULT  '',
 `poster` varchar( 255  )  NOT  NULL DEFAULT  '',
 `display` smallint( 5  )  unsigned NOT  NULL DEFAULT  '0',
 `sort` smallint( 5  )  unsigned NOT  NULL DEFAULT  '0',
 `template` varchar( 100  )  NOT  NULL DEFAULT  '',
 `lock` tinyint( 1  )  NOT  NULL DEFAULT  '0',
 `status` tinyint( 1  )  NOT  NULL DEFAULT  '0',
 `timestamp` int( 10  )  unsigned NOT  NULL DEFAULT  '0',
 `update` int( 10  )  unsigned NOT  NULL DEFAULT  '0',
 `config` text DEFAULT NULL,
 `data1` text DEFAULT NULL,
 `data2` text DEFAULT NULL,
 `data3` text DEFAULT NULL,
 PRIMARY  KEY (  `id`  ));
 alter table `p8_sites_site_recycle` drop index `alias`; 
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, false);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略，请进后台更新全站缓存";
