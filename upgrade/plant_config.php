<?php
/*针对大数据运维总览图*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "INSERT INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES
('core', '', 'serialize', 'plant', 'a:11:{s:5:\"title\";s:24:\"大数据运维总览图\";s:12:\"base_reflash\";s:3:\"300\";s:8:\"map_show\";s:1:\"1\";s:6:\"left_c\";a:7:{s:4:\"show\";s:1:\"1\";s:5:\"title\";s:32:\"子站文章发布数排名TOP10\";s:10:\"title_type\";s:1:\"1\";s:4:\"type\";s:15:\"sites_count_all\";s:6:\"direct\";s:1:\"0\";s:6:\"height\";s:3:\"300\";s:7:\"reflash\";s:5:\"14400\";}s:6:\"left_b\";a:7:{s:4:\"show\";s:1:\"1\";s:5:\"title\";s:20:\"各营发稿量TOP10\";s:10:\"title_type\";s:1:\"1\";s:4:\"type\";s:10:\"dept_count\";s:6:\"direct\";s:1:\"0\";s:6:\"height\";s:3:\"300\";s:7:\"reflash\";s:5:\"14400\";}s:8:\"center_t\";a:7:{s:4:\"show\";s:1:\"1\";s:5:\"title\";s:26:\"会员主站发稿量TOP10\";s:10:\"title_type\";s:1:\"0\";s:4:\"type\";s:17:\"role_borderRadius\";s:6:\"direct\";s:1:\"1\";s:6:\"height\";s:3:\"300\";s:7:\"reflash\";s:5:\"86400\";}s:8:\"center_c\";a:7:{s:4:\"show\";s:1:\"1\";s:5:\"title\";s:21:\"子站每日上稿数\";s:10:\"title_type\";s:1:\"0\";s:4:\"type\";s:17:\"sites_count_today\";s:6:\"direct\";s:1:\"1\";s:6:\"height\";s:3:\"300\";s:7:\"reflash\";s:5:\"86400\";}s:8:\"center_b\";a:7:{s:4:\"show\";s:1:\"1\";s:5:\"title\";s:12:\"会员信息\";s:10:\"title_type\";s:1:\"2\";s:4:\"type\";s:0:\"\";s:6:\"direct\";s:1:\"1\";s:6:\"height\";s:3:\"300\";s:7:\"reflash\";s:4:\"1800\";}s:7:\"right_t\";a:7:{s:4:\"show\";s:1:\"1\";s:5:\"title\";s:21:\"各单位推送比例\";s:10:\"title_type\";s:1:\"0\";s:4:\"type\";s:15:\"sites_push_year\";s:6:\"direct\";s:1:\"0\";s:6:\"height\";s:3:\"300\";s:7:\"reflash\";s:5:\"86400\";}s:7:\"right_c\";a:7:{s:4:\"show\";s:1:\"1\";s:5:\"title\";s:24:\"内容分发栏目概况\";s:10:\"title_type\";s:1:\"0\";s:4:\"type\";s:16:\"cms_category_bar\";s:6:\"direct\";s:1:\"1\";s:6:\"height\";s:3:\"300\";s:7:\"reflash\";s:5:\"86400\";}s:8:\"category\";s:0:\"\";}');";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略，请进后台更新全站缓存";
