<?php
defined('PHP168_PATH') or die();

/**
* 修改核心配置
**/

//$this_controller->check_admin_action('config') or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	load_language($core, 'config');

	$config = html_entities($core->get_config('core', ''));
	$core->get_cache('credit');
	
	include template($core, 'config/base_html', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	if($IS_FOUNDER){
		$_POST = p8_stripslashes2($_POST);	
		$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();	
		$core->set_config($config);
		message('done',$this_url);
	}else{
		message('no_privilege');
	}
	
	
}
