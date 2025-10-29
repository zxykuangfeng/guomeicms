<?php
defined('PHP168_PATH') or die();



$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	$config = &$core->CONFIG;
	include template($this_system, 'u_ip','admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();


	$config['u_ip']['collectip'] = isset($config['u_ip']['collectip']) ? explode("\r\n", trim($config['u_ip']['collectip'])) : array();
	$config['u_ip']['collectip'] = empty($config['u_ip']['collectip'])? array() : array_flip($config['u_ip']['collectip']);
	
	$config['u_ip']['area_ip'] = isset($config['u_ip']['area_ip']) ? explode("\r\n", trim($config['u_ip']['area_ip'])) : array();
	$config['u_ip']['area_ip'] = empty($config['u_ip']['area_ip'])? array() : array_flip($config['u_ip']['area_ip']);
	
	$config['u_ip']['ruleoutip'] = isset($config['u_ip']['ruleoutip']) ? explode("\r\n", trim($config['u_ip']['ruleoutip'])) : array();
	$config['u_ip']['ruleoutip'] = empty($config['u_ip']['ruleoutip'])? array() : array_flip($config['u_ip']['ruleoutip']);

	$core->set_config($config);
	message('done',$this_url);
}

