<?php
defined('PHP168_PATH') or die();



$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	$config = &$core->CONFIG;
	include template($this_system, 'cate_ip','admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();


	$config['cate_ip']['collectip'] = isset($config['cate_ip']['collectip']) ? explode("\r\n", trim($config['cate_ip']['collectip'])) : array();
	$config['cate_ip']['collectip'] = empty($config['cate_ip']['collectip'])? array() : array_flip($config['cate_ip']['collectip']);
	
	$config['cate_ip']['area_ip'] = isset($config['cate_ip']['area_ip']) ? explode("\r\n", trim($config['cate_ip']['area_ip'])) : array();
	$config['cate_ip']['area_ip'] = empty($config['cate_ip']['area_ip'])? array() : array_flip($config['cate_ip']['area_ip']);
	
	$config['cate_ip']['ruleoutip'] = isset($config['cate_ip']['ruleoutip']) ? explode("\r\n", trim($config['cate_ip']['ruleoutip'])) : array();
	$config['cate_ip']['ruleoutip'] = empty($config['cate_ip']['ruleoutip'])? array() : array_flip($config['cate_ip']['ruleoutip']);

	$core->set_config($config);
	message('done',$this_url);
}

