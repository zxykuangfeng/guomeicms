<?php
/*针对表单静态化的升级*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "REPLACE INTO `p8_config` (`system`, `module`, `type`, `k`, `v`) VALUES
('core', 'forms', 'string', 'htmlize', '1'),
('core', 'forms', 'string', 'htmlize_post', '1'),
('core', 'forms', 'string', 'htmlize_list', '1'),
('core', 'forms', 'string', 'htmlize_view', '1'),
('core', 'forms', 'string', 'dynamic_list_url_rule', '{\$module_controller}-list-mid-{\$id}#-page-{\$page}#.html'),
('core', 'forms', 'string', 'dynamic_view_url_rule', '{\$module_controller}-view-id-{\$id}.html'),
('core', 'forms', 'string', 'html_list_url_rule', '{\$module_url}/html/{\$name}/list_{\$id}#-page-{\$page}#.html'),
('core', 'forms', 'string', 'html_post_url_rule', '{\$module_url}/html/{\$name}/post.html'),
('core', 'forms', 'string', 'html_view_url_rule', '{\$module_url}/html/{\$name}/view_{\$id}.html');";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略，请进后台更新全站缓存";
