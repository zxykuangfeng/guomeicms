<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');
$nums = array(10,20,30,40,50,100);
if(REQUEST_METHOD == 'GET'){

	$systems = $core->list_systems();
	$select_credit = select();
	$select_credit->from($this_module->table, '*');
	$credit_list = $core->list_item($select_credit);
	$credit_type = array();
	foreach($credit_list as $credit){
		$credit_type[$credit['id']] = $credit['name'];
	}
	$credit_json = jsonencode($credit_type);
	//初始化
	$init_credit_type = 3;
	$start_date = $end_date = '';
	
	$num = 30;
	include template($this_module, 'statistic_credit', 'admin');
}elseif(REQUEST_METHOD == 'POST'){
	$systems = $core->list_systems();
	$act = isset($_POST['act'])? $_POST['act'] : '';
	$system = isset($_POST['system']) && in_array($_POST['system'],array_keys($systems)) ?  $_POST['system'] : '';
	
	$credit_id = isset($_POST['credit_id']) ? intval($_POST['credit_id']) : 3;
	$credit_id = preg_replace('/[^0-9,]/', '', $credit_id);
	$credit_id = $credit_id ? intval($credit_id) : 3;
	
	$pattern = '/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/';	
	$start_date = isset($_POST['start_date']) && preg_match($pattern, $_POST['start_date']) ? trim($_POST['start_date']) : 0;
	$end_date = isset($_POST['end_date']) && preg_match($pattern, $_POST['end_date']) ? trim($_POST['end_date']) : 0;
	
	$num = isset($_POST['num']) && in_array($_POST['num'],$nums) ? intval($_POST['num']) : 30;
	
	if($act=='query'){
		$data = $this_module->getCredit($system,$credit_id,$start_date,$end_date,$num);
		echo json_encode($data);
		exit;
	}elseif($act=='download'){
		$static = $this_module->getCredit($system,$credit_id,$start_date,$end_date,$num,'',true);
		exit;
	}
}