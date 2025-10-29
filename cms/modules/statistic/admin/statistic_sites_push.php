<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(!isset($core->systems['sites']))message('sites not installed');

if(REQUEST_METHOD == 'GET'){

	$SITE = $core->load_system('sites');
    $sites = $SITE->get_sites();
    $sites = p8_json($sites);

	$years= range(date("Y"),date("Y")-10);
	$months= range(01,12);

	include template($this_module, 'statistic_sites', 'admin');
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
	$cid = $_POST['cid'];
	$cid = preg_replace('/[^0-9,]/', '', $cid);
	$cid = intval($cid);
	
	if($act=='query'){
		$data = $this_module->getStaticSitesPush($year,$month,$cid,$model);		
		echo json_encode($data);
		exit;
	}elseif($act=='stat'){
		if(!$year)
		exit('false');
		
		$static = $this_module->statisticSitesPush($year,$month);
		echo json_encode($static);
		exit;
	}
	elseif($act=='download'){
		$static = $this_module->getStaticSitesPush($year,$month,$cid,$model,true);
		exit;
	}
	

}
