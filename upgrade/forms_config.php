<?php
//针对表单，修改配置
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;
$this_module = $core->load_module('forms');
$this_module->set_config(array(
	'html_post_url_rule' => '{$core_url}/html/{$model_name}/post.html',
	'dynamic_list_url_rule' => '{$module_controller}-list-mid-{$id}#-page-{$page}#.html',
	'dynamic_view_url_rule' => '{$module_controller}-view-id-{$id}.html',
	'html_list_url_rule' => '{$core_url}/html/{$model_name}/list_{$id}#-page-{$page}#.html',
	'html_view_url_rule' => '{$core_url}/html/{$model_name}/view_{$id}.html',
));
echo "升级完成，请进入后台更新全站缓存！";