<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){

	$models = $this_system->get_models();
	$category = $this_system->load_module('category');
	$category->get_cache(false);
	$path = array();
	
	$models = $this_system->get_models();
	
	foreach($category->categories as $v){
		$parents = $category->get_parents($v['id']);
		foreach($parents as $vv){
			$path[$v['id']][] = $vv['id'];
		}
		$path[$v['id']][] = $v['id'];
	}
	$years= range(date("Y"),date("Y")-100);
	$months= range(01,12);
	
	$uid=$_GET['uid'];
	$username=$_GET['username'];
	
	$json = array(
		'json' => p8_json($category->top_categories),
		'path' => p8_json($path),
		'models' => p8_json($models)
	);
	include template($this_module, 'statistic_data', 'admin');
}elseif(REQUEST_METHOD == 'POST'){
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	$models = $this_system->get_models();
	$act = isset($_POST['act'])? $_POST['act'] : '';
	$years= range(date("Y"),date("Y")-10);
	$year = intval($_POST['year']);
	$year = !in_array($year,$years) ? date("Y") : $year;	
	$month = !in_array($_POST['month'],range(01,12)) ? '' : intval($_POST['month']);
	$model = xss_clear($_POST['model']);
	if($model && !array_key_exists($model,$models)){
		exit;
	}
	$cid = isset($_POST['cid']) && $_POST['cid'] ? intval($_POST['cid']) : 0;
	$cid = preg_replace('/[^0-9,]/', '', $cid);
	$cid = intval($cid);
	
	$uid = isset($_POST['uid']) && $_POST['uid'] ? intval($_POST['uid']) : 0;
	$uid = preg_replace('/[^0-9,]/', '', $uid);
	$uid = intval($uid);
	
	if($act=='query'){
		$data = $this_module->getStatic($year,$month,$cid,$model,$uid);
		echo json_encode($data);
		exit;
	}elseif($act=='stat'){
		if(!$year)
		exit('false');
		
		$static = $this_module->statistic($year,$month,$cid,$model);
		echo json_encode($static);
		exit;
	}
	elseif($act=='download'){
		$static = $this_module->getStatic($year,$month,$cid,$model,$uid,true);
		exit;
	}
	

}
