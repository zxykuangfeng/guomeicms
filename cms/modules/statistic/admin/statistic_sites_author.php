<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$sites_system = $core->load_system('sites');
	$models = $sites_system->get_models();	
	$years= range(date("Y"),date("Y")-10);
	$months= range(01,12);
	$site = '';
	$all_sites = $sites_system->sites;
	$json = array(
		'json' => p8_json(array()),
		'path' => p8_json(array()),
		'models' => p8_json($models)
	);
	
	
	include template($this_module, 'statistic_sites_author', 'admin');
}elseif(REQUEST_METHOD == 'POST'){
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	$models = $this_system->get_models();
	$act = isset($_POST['act'])? $_POST['act'] : '';
	$site = isset($_POST['site'])? $_POST['site'] : '';
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
	$page_size = isset($_POST['page_size']) ? intval($_POST['page_size']) : 20;
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$page = max($page, 1);
	if($act=='query'){
		$data = $this_module->getStatic_sites_author($year,$month,$cid,$model,null,false,$site,$page,$page_size);
		$page_url = 'javascript:get_data(?page?)';
		//echo json_encode($data);
		echo p8_json(array(
			'list' => $data['data'],
			'pages' => list_page(array(
				'count' => $data['count'],
				'page' => $page,
				'page_size' => $page_size,
				'url' => $page_url
			)),
			'time' => get_timer() - $P8['start_time'],
			'sphinx' => $sphinx
		));
		exit;
	}elseif($act=='stat'){
		if(!$year)
		exit('false');
		
		$static = $this_module->statistic($year,$month,$cid,$model);
		echo json_encode($static);
		exit;
	}
	elseif($act=='download'){
		$static = $this_module->getStatic_sites_author($year,$month,$cid,$model,0,true,$site);
		exit;
	}
	

}
