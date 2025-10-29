<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$config = $core->get_config('core', '');
	$link_filter = isset($config['link_filter']) ? $config['link_filter'] : array();
	$uploader = $core->get_config('core','uploader');
	$filter = array_keys($uploader['filter']);
	$filter = array_map('strtolower',$filter);
		
	include template($this_system, 'filter_link_config','admin');
}else if(REQUEST_METHOD == 'POST'){	
	$_POST = p8_stripslashes2($_POST);
	$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();
	$config['filter_link_exe'] = isset($config['filter_link_exe']) ? 1 : 0;
	$core->set_config($config);
	message('done',$this_url);
}

