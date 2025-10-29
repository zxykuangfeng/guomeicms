<?php
defined('PHP168_PATH') or die();



$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	$config = &$core->CONFIG;
	include template($this_system, 'allow_admin_ip','admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();
	
	$config['allow_admin_ip']['enabled'] = isset($config['allow_admin_ip']['enabled']) ? $config['allow_admin_ip']['enabled'] : 0;
	
	$config['allow_admin_ip']['collectip'] = isset($config['allow_admin_ip']['collectip']) ? explode("\r\n", trim($config['allow_admin_ip']['collectip'])) : array();
	$config['allow_admin_ip']['collectip'] = empty($config['allow_admin_ip']['collectip'])? array() : array_flip($config['allow_admin_ip']['collectip']);
	
	//$config['allow_admin_ip']['beginip'] = isset($config['allow_admin_ip']['beginip']) ? trim($config['allow_admin_ip']['beginip']) : '';
	//$config['allow_admin_ip']['endip'] = isset($config['allow_admin_ip']['endip']) ? trim($config['allow_admin_ip']['endip']) : '';

    $config['allow_admin_ip']['area_ip'] = isset($config['allow_admin_ip']['area_ip']) ? explode("\r\n", trim($config['allow_admin_ip']['area_ip'])) : array();
    $config['allow_admin_ip']['area_ip'] = empty($config['allow_admin_ip']['area_ip'])? array() : array_flip($config['allow_admin_ip']['area_ip']);
	
	$config['allow_admin_ip']['ruleoutip'] = isset($config['allow_admin_ip']['ruleoutip']) ? explode("\r\n", trim($config['allow_admin_ip']['ruleoutip'])) : array();
	$config['allow_admin_ip']['ruleoutip'] = empty($config['allow_admin_ip']['ruleoutip'])? array() : array_flip($config['allow_admin_ip']['ruleoutip']);
	
	$core->set_config($config);
	message('done',$this_url);
}

