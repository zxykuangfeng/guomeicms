<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(!$core->clustered)message('clustered not installed');

if(REQUEST_METHOD == 'GET'){

	$cluster = $core->load_module('cluster');
	$clients = $cluster->clients;
	$path = array();
	
	$models = $this_system->get_models();

	$years= range(date("Y"),date("Y")-100);
	$months= range(01,12);
	
	$json = array(
		'clients' => p8_json($clients),
		'models' => p8_json($models)
	);
	include template($this_module, 'statistic_cluster', 'admin');
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
	if($act=='query'){
		$data = $this_module->getStaticCluster($year,$month,$cid,$model);
		echo json_encode($data);
		exit;
	}elseif($act=='stat'){
		if(!$year)
		exit('false');
		
		$static = $this_module->statisticCluster($year,$month,$cid,$model);
		echo json_encode($static);
		exit;
	}
	elseif($act=='download'){
		$static = $this_module->getStaticCluster($year,$month,$cid,$model,true);
		exit;
	}
	

}
