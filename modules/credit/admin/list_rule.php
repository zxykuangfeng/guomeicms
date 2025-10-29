<?php
defined('PHP168_PATH') or die();

/**
* 积分规则列表
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

$system = isset($_GET['system']) ? xss_clear(clear_special_char($_GET['system'])) : 'core';
in_array($system,array('core','cms','ask','sites')) or exit('{}');
$module = isset($_GET['module']) ? xss_clear(clear_special_char($_GET['module'])) : '';
$module = get_module($system, $module) ? $module : '';
//初始化默认
//if(!empty($system) && empty($module)) $module = 'item';
$postfix = isset($_GET['postfix']) ? preg_replace('/[^0-9a-zA-z_]/', '', $_GET['postfix']) : '';
$all = empty($_GET['all']) ? 0 : 1;

$systems = $core->systems;
$modules = $system ? get_modules($system) : array();

if($system == 'core'){
	if($module && isset($core->modules[$module]) && get_module($system, $module)){
		$info = @include(PHP168_PATH .'modules/'. $module .'/#.php');
	}else{
		$info = @include(PHP168_PATH .'#.php');
	}	
}else if(isset($core->systems[$system])){
	if($module && isset($core->CONFIG['system&module'][$system]['modules'][$module]) && get_module($system, $module)){
		$info = @include(PHP168_PATH . $system .'/modules/'. $module .'/#.php');
	}else{
		$info = @include(PHP168_PATH . $system .'/#.php');
	}
}
//去除没有积分规则的模块
foreach($modules as $module_name => $each_module){
	if($system == 'core'){
		$module_info = include PHP168_PATH .'modules/'. $module_name .'/#.php';		
	}else{
		$module_info = include PHP168_PATH . $system .'/modules/'. $module_name .'/#.php';
	}
	if(empty($module_info['credit_rule_actions'])) unset($modules[$module_name]);
}

$core->get_cache('role');
load_language($core, 'config');
$select = select();
$select->from($this_module->rule_table, '*');
if($system) $select->in('system', $system);
if($module)	$select->in('module', $module);
$select->order('action ASC');
$list = $core->list_item($select);
$core->get_cache('credit');
	
foreach($list as $k => $v){
	$list[$k]['action'] = $info['credit_rule_actions'][$v['action']];
	$list[$k]['credit_id'] = $core->credits[$v['credit_id']]['name'];
}
include template($this_module, 'list_rule', 'admin');