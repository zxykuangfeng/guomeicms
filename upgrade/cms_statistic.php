<?php
/*针对统计失效的数据表重命名的修复*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "RENAME TABLE `p8_cms_statistic_cms_statistic_sites_content` TO `p8_cms_statistic_sites_content`;
RENAME TABLE `p8_cms_statistic_cms_statistic_sites_push` TO `p8_cms_statistic_sites_push`;
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略，请进后台更新全站缓存";
