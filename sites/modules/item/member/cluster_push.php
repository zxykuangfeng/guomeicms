<?php
defined('PHP168_PATH') or die();

/**
* 推送数据,只提供AJAX POST调用
**/
$this_controller->check_action($ACTION,$this_system->SITE) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
    
	$stop = &$this_system->load_module('stop');

	$json = $core->CACHE->read($this_system->name .'/modules/', $stop->name, 'json');
	exit('{"json":'. $json['json'] .',"path":'. $json['path'] .'}');
	
}if(REQUEST_METHOD == 'POST'){
	$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
	$id or exit('[]');
	$dell_id = $id = array_unique($id);
	$cid = isset($_POST['cid']) ? intval($_POST['cid']) : 0;
	$send_time_type = isset($_POST['send_time_type']) ? intval($_POST['send_time_type']) : 0;
	$send_time = isset($_POST['send_time']) ? trim($_POST['send_time']) : 0;
	$filter_word_enable = isset($_POST['filter_word_enable']) ? false : true;
	//var_dump($filter_word_enable);
	$mes['message'] = $P8LANG['sites_item']['category_required'];
	$mes['push'] = 1;
	$cid or exit(p8_json($mes));
	if($core->CONFIG['push_allow_max_number']){
		$site = $this_system->SITE;
		$table = P8_TABLE_.'sites_stop_data';
		$this_day = mktime(0,0,0,date('m'),date('d'),date('Y'));
		$query = $DB_master->query("SELECT count(*) as `count` FROM $table WHERE `sc` = 'c' and `from` = 'sites' and `site` = '$site' and `timestamp` > $this_day");
		$res = $DB_master->fetch_array($query);
		if($res['count'] >= intval($core->CONFIG['push_allow_max_number'])){
			$mes['message'] = $P8LANG['cluster_push_fail'];
			exit(p8_json($mes));
		}
	}
	$stop = &$this_system->load_module('stop');
	
	//生成数据
	$data = $this_module->cluster_data($id, $cid, $send_time_type, $send_time);
	
	$cms_system = $core->load_system('cms');
	$module_item = $cms_system->load_module('item');
	//$module_category = $cms_system->load_module('category');
	//$module_category->get_cache();
	$item_controller = &$core->controller($module_item);
	//推送给主站数据需要审核
	if($this_module->CONFIG['autoverify']){
		foreach($data as $key=>$item){
			$data[$key]['verify'] = 0;
			$data[$key]['verifier'] = '';
		}
	}else{
		$verify = $item_controller->check_category_action('autoverify', $cid);	
		foreach($data as $key=>$item){
			$data[$key]['verify'] = $verify ? 1 : 0;
			$data[$key]['verifier'] = $verify ? $USERNAME : '';
		}
	}
	//直推数据防重复推送
	$repush_list = $this_module->check_repush($data,'cms');
	if(!empty($repush_list)){
		$mes['message'] = null;
		foreach($repush_list as $repush_item){			
			$mes['message'] .= "ID：".$repush_item['id']." 于".date('Y-m-d H:i:s',$repush_item['timestamp'])."推送过，".$P8LANG['sites_item']['status'][$repush_item['status']];
			if($repush_item['new_id']) 
				$mes['message'] .= ' <a style="color:blue" href="'.$core->controller.'/cms/item-view-id-'.$repush_item['new_id'].'?verified='.($repush_item['status']==1?1:0).'" target="_blank">'.$P8LANG['view'].'>></a><br/>';
			else
				$mes['message'] .= "<br>";
		}
		$mes['push'] = 1;
		exit(p8_json($mes));
	}
	//上推数据
	$count = $stop->push($data,$filter_word_enable,'cms');
	$this_system->log(array(
		'title' => $P8LANG['_module_cluster_push_admin_log'],
		'request' => $_POST,
	));
	if($count>0){
		//要设置属性的内容
		$this_module->set_push_attributes($dell_id);
		exit(jsonencode($dell_id));
	}else{
		exit('[]');
	}
}
exit('[]');
