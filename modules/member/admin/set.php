<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){

	$config = $core->get_config($SYSTEM, $MODULE);
	$core_config = $core->get_config('core', '');
	
	
	$config['admin_login_false'] = isset($config['admin_login_false']) ? $config['admin_login_false'] : (isset($core_config['admin_login_false']) ? $core_config['admin_login_false'] : 0);
	$config['admin_login_false_lock'] = isset($config['admin_login_false_lock']) ? $config['admin_login_false_lock'] : (isset($core_config['admin_login_false_lock']) ? $core_config['admin_login_false_lock'] : 0);	
	$info = include $this_module->path .'#.php';
	$core->get_cache('role');
	$roles = $core->get_cache('role', 'all');
	unset($roles[$core->CONFIG['guest_role']]);
	load_language($core, 'config');
	$questions = isset($config['questions']) ? $config['questions'] : array();
	krsort($questions);
	include template($this_module, 'set', 'admin');

}else if(REQUEST_METHOD == 'POST'){
	
	$_POST = p8_stripslashes2($_POST);
	
	$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();
	
	$new_questions = array();
	if(isset($config['questions'])){
		foreach($config['questions'] as $key => $que){
			if(empty($que['order']) || empty($que['question'])) continue;
			$new_questions[intval($que['order'])] = $que['question'];			
		}		
	}
	$config['questions'] = $new_questions;
	if(isset($config['_verify_question'])){
		$questions = array_filter(explode("\r\n", $config['_verify_question']));
		$config['verify_question'] = array();
		$i = 0;
		foreach($questions as $v){
			$v = explode('|', $v);
			if(count($v) == 1) continue;
			
			$config['verify_question'][] = array('question' => $v[0], 'answer' => $v[1]);
		}
	}
	
	if(isset($config['recharge']['quantity'])){
		$money = isset($config['recharge']['quantity']['money']) ? $config['recharge']['quantity']['money'] : array();
		$credit = isset($config['recharge']['quantity']['credit']) ? $config['recharge']['quantity']['credit'] : array();
		
		$quantity = array();
		foreach($money as $k => $v){
			$v = intval($v);
			$c = intval($credit[$k]);
			
			if(!$v || !$c) continue;
			
			$quantity[$v] = $c;
		}
		
		$config['recharge']['quantity'] = $quantity;
		
	}else{
		$config['recharge']['quantity'] = array();
	}
	$config['admin_login_false'] = isset($config['admin_login_false']) && $config['admin_login_false'] ? intval($config['admin_login_false']) : 0; 
	$config['admin_login_false_lock'] = isset($config['admin_login_false_lock']) && $config['admin_login_false_lock'] ? intval($config['admin_login_false_lock']) : 0; 
	$config['sms_login'] = isset($config['sms_login']) && $config['sms_login'] ? 1 : 0;
	$this_module->set_config($config);	
	message('done', HTTP_REFERER);
}
