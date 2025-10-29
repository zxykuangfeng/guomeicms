<?php
defined('PHP168_PATH') or die();

/**
* 推送数据,只提供AJAX POST调用
**/

$this_controller->check_action($ACTION) or exit('[]');

if(REQUEST_METHOD == 'GET'){
	
	$sites = $core->load_system('sites');
	$stop = $sites->load_module('stop');

	$json = $stop->get_json();
	$allsites  = $sites->get_sites();
	foreach($allsites as $key=>$val){
		if(empty($val['status'])) unset($allsites[$key]);
	}
	$allsites  = p8_json($allsites);
	exit('{"json":'. $json['json'] .',"path":'. $json['path'] .',"sites":'.$allsites.'}');
	
}if(REQUEST_METHOD == 'POST'){
	
	$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
	$id or exit('[]');
	$dell_id = $id;
	$cid = isset($_POST['cid']) ? intval($_POST['cid']) : 0;
	$push_site = isset($_POST['push_site']) ? $_POST['push_site'] : '';
    $send_time_type = isset($_POST['send_time_type']) ? intval($_POST['send_time_type']) : 0;
	$send_time = isset($_POST['send_time']) ? trim($_POST['send_time']) : 0;
	$filter_word_enable = isset($_POST['filter_word_enable']) ? false : true;
	$mes['message'] = $P8LANG['cms_item']['category_required'];
	$mes['push'] = 1;
	$cid or exit(p8_json($mes));
	$sites = $core->load_system('sites');
	$stop = $sites->load_module('stop');

	//生成数据
	$data = $this_module->sites_data($id, $cid,$push_site, $send_time_type, $send_time);
	$module_item = $sites->load_module('item');
	//推送给分站数据需要审核
	if($module_item->CONFIG['sites_autoverify']){
		foreach($data as $key=>$item){
			$data[$key]['verify'] = 0;
			$data[$key]['verifier'] = '';
		}
	}
	//直推数据防重复推送
	$repush_list = $this_module->check_repush($data);
	if(!empty($repush_list)){
		$mes['message'] = null;
		foreach($repush_list as $repush_item){			
			$mes['message'] .= "ID：".$repush_item['id']." 于".date('Y-m-d H:i:s',$repush_item['timestamp'])."推送过，".$P8LANG['cms_item']['status'][$repush_item['status']];
			if($repush_item['new_id']) 
				$mes['message'] .= ' <a style="color:blue" href="'.$core->controller.'/../s.php/'.$repush_item['site'].'/item-view-id-'.$repush_item['new_id'].'?verified='.($repush_item['status']==1?1:0).'" target="_blank">'.$P8LANG['view'].'>></a><br/>';
			else
				$mes['message'] .= "<br>";
		}
		exit(p8_json($mes));
	}
	//上推数据
	$count = $stop->push($data,$filter_word_enable,'sites','cms');
	if($count>0){
		//要设置属性的内容
		$this_module->set_push_attributes($dell_id);
		exit(jsonencode($dell_id));
	}else{
		exit('[]');
	}	
}
exit('[]');
