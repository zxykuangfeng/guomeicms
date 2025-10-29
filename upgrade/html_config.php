<?php
//强制配置静态功能
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;
$this_system = $core->load_system('cms');
$this_module = $this_system->load_module('item');
$this_module->set_config(array(
	'sync_del_html' => '0',
	'sync_index_to_html' => '1',
	'htmlize' => '1',
));
$systems = $core->list_systems();
if(isset($systems['sites']) && $systems['sites']['enabled']){
	$this_system = $core->load_system('sites');
	$this_module = $this_system->load_module('item');
	$this_module->set_config(array(
		'sync_del_html' => '0',
		'sync_index_to_html' => '1',
		'htmlize' => '1',
	));
}
echo "升级完成，请进入后台更新全站缓存！";