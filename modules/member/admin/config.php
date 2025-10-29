<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){

	$config = $core->get_config($SYSTEM, $MODULE);
	$info = include $this_module->path .'#.php';
	$core->get_cache('role');
	$roles = $core->get_cache('role', 'all');
	unset($roles[$core->CONFIG['guest_role']]);
	load_language($core, 'config');
	$questions = isset($config['questions']) ? $config['questions'] : array();
	krsort($questions);
	include template($this_module, 'config', 'admin');

}else if(REQUEST_METHOD == 'POST'){
	
	$_POST = p8_stripslashes2($_POST);
	
	$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();
	$config = p8_html_filter_array($config);
	//部门
	$dept = isset($_POST['dept']) && is_array($_POST['dept']) ? $_POST['dept'] : array();	
	$delete = isset($_POST['delete'])? $_POST['delete'] : array();	
	foreach($dept['code'] as $k=>$v){
		$config['dept'][$k]['code'] = $v;
		$config['dept'][$k]['name'] = $dept['name'][$k];
	}
	if(!empty($delete)){
		foreach($delete as $v){
			unset($config['dept'][$v]);
		}
	}
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
	
	$this_module->set_config($config);
	
	message('done', HTTP_REFERER);
}
