<?php
/*分站内容统计重点栏目的升级*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "
ALTER TABLE `p8_cms_statistic_sites_content` CHANGE `unverified` `unverified` INT(10) NOT NULL DEFAULT '0';
ALTER TABLE `p8_cms_statistic_sites_content` ADD `post_im` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `timestamp`;
ALTER TABLE `p8_cms_statistic_sites_content` ADD `verified_im` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `post_im`;
ALTER TABLE `p8_cms_statistic_sites_content` ADD `views` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `verified_im`;
ALTER TABLE `p8_cms_statistic_sites_content` ADD `views_im` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `views`;
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略，请进后台更新全站缓存";
