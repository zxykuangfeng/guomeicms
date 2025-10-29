<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){

	$models = $this_system->get_models();
	$category = $this_system->load_module('category');
	$category->get_cache(false);
	$path = array();
	$start_date = date('Y-m-d H:i:s',strtotime("-1 years 1 day"));
	$end_date = date('Y-m-d  H:i:s',P8_TIME);
	
	foreach($category->categories as $v){
		$parents = $category->get_parents($v['id']);
		foreach($parents as $vv){
			$path[$v['id']][] = $vv['id'];
		}
		$path[$v['id']][] = $v['id'];
	}
	$years= range(date("Y"),date("Y")-10);
	$months= range(01,12);
	
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
	$page_size = isset($_POST['page_size']) ? intval($_POST['page_size']) : 20;
	$page_size = in_array($page_size,array(10,20,30,50)) ? $page_size : 20;	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$page = max($page, 1);	
	$cid = isset($_POST['cid']) && $_POST['cid'] ? intval($_POST['cid']) : 0;
	$cid = preg_replace('/[^0-9,]/', '', $cid);
	$cid = intval($cid);
	$pattern = '/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/';
	$start_date = isset($_POST['start_date']) && preg_match($pattern, $_POST['start_date']) ? $_POST['start_date'] : '';
	$end_date = isset($_POST['end_date']) && preg_match($pattern, $_POST['end_date']) ? $_POST['end_date'] : '';
	$group = isset($_POST['group'])? $_POST['group'] : 'day';
	$group = in_array($group,array('day','month','year')) ? $group : 'day';
	if($act=='query'){
		if($start_date || $end_date){
			$data = $this_module->getStatic_ranger($start_date,$end_date,$group,$cid,$model,false,$page,$page_size);
			$page_url = 'javascript:get_data($(\'#cid\').val(),?page?)';
			//$data = $this_module->getStatic($year,$month,$cid,$model,0,false,$start_date,$end_date,$group);
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
		}else{
			$data = $this_module->getStatic($year,$month,$cid,$model);
		}
		echo json_encode($data);
		exit;
	}elseif($act=='stat'){
		$year = $year ? $year : date('Y',P8_TIME);
		$month = $month ? $month : 0;
		$static = $this_module->statistic($year,$month,$cid,$model);
		echo json_encode($static);
		exit;
	}
	elseif($act=='download'){
		$data = $this_module->getStatic_ranger($start_date,$end_date,$group,$cid,$model,true,$page,$page_size);
		exit;
	}
	

}
