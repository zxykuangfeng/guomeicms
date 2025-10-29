<?php
defined('PHP168_PATH') or die();



$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	$config = &$core->CONFIG;
	include template($this_system, 'front_ip','admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();


	$config['front_ip']['collectip'] = isset($config['front_ip']['collectip']) ? explode("\r\n", trim($config['front_ip']['collectip'])) : array();
	$config['front_ip']['collectip'] = empty($config['front_ip']['collectip'])? array() : array_flip($config['front_ip']['collectip']);
	
	$config['front_ip']['area_ip'] = isset($config['front_ip']['area_ip']) ? explode("\r\n", trim($config['front_ip']['area_ip'])) : array();
	$config['front_ip']['area_ip'] = empty($config['front_ip']['area_ip'])? array() : array_flip($config['front_ip']['area_ip']);
	
	$config['front_ip']['ruleoutip'] = isset($config['front_ip']['ruleoutip']) ? explode("\r\n", trim($config['front_ip']['ruleoutip'])) : array();
	$config['front_ip']['ruleoutip'] = empty($config['front_ip']['ruleoutip'])? array() : array_flip($config['front_ip']['ruleoutip']);

	$core->set_config($config);
	message('done',$this_url);
}

