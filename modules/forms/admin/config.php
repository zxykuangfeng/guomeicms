<?php
defined('PHP168_PATH') or die();

/**
* 模块配置
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){

	$config = $core->get_config('core', 'forms');
	$info = include $this_module->path .'#.php';
	$config = array_merge($info, $core->CONFIG, $config);
	$config['html_post_url_rule'] = str_replace('$module_url', '$core_url', $config['html_post_url_rule']);
	$config['html_list_url_rule'] = str_replace('$module_url', '$core_url', $config['html_list_url_rule']);
	$config['html_view_url_rule'] = str_replace('$module_url', '$core_url', $config['html_view_url_rule']);
	include template($this_module, 'config', 'admin');

}else if(REQUEST_METHOD == 'POST'){
	
	$_POST = p8_stripslashes2($_POST);
	
	$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();
	$config['html_post_url_rule'] = str_replace('$module_url', '$core_url', $config['html_post_url_rule']);
	$config['html_list_url_rule'] = str_replace('$module_url', '$core_url', $config['html_list_url_rule']);
	$config['html_view_url_rule'] = str_replace('$module_url', '$core_url', $config['html_view_url_rule']);
	$this_module->set_config($config);
	
	message('done');
}
