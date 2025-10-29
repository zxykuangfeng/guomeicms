<?php
/*针对分站专属个性化管理菜单*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "CREATE TABLE IF NOT EXISTS `p8_sites_menu_nav` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `site` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` char(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` char(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `target` char(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `display_order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
); 
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, false);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略，请进后台更新全站缓存";
