<?php
defined('PHP168_PATH') or die();

/**
* 修改核心配置
**/

$this_controller->check_admin_action('config') or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	load_language($core, 'config');

	$config = $core->get_config('core', '');
	$info = include $core->path .'#.php';
	$config = html_entities(array_merge($info, $core->CONFIG, $config));
	
	include template($core, 'config/static_config', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$_POST = p8_stripslashes2($_POST);
	
	$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();
	
	$core->set_config($config);

	message('done');
}
