<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');
$member = $core->load_module('member');	
if(REQUEST_METHOD == 'POST'){
	$sites_system = &$core->load_system('sites');
	$category = $sites_system->load_module('category');
	$category_json = $category->get_json();
	$item_module = $sites_system->load_module('item');
	load_language($core, 'config');
	load_language($item_module, 'global');	
	$sc = $_POST['sc'] == 'c' ? 'c' : 's';
	$select = select();
	$select->from($core->TABLE_.'sites_stop_data as c', 'c.*');
	
	$site_info = array();
	$site_domain = '';

	if($sc=='s'){
		$select->in('c.`to`','sites');
		$select->in('c.`from`','cms');
	}else{
		$select->in('c.`to`','cms');
		$select->in('c.`from`','sites');
	}
	$select->order(" c.timestamp DESC");
	$list = $core->list_item($select);
	$allsites = $sites_system->get_sites();
	$item_ids = array();
	$push_usernames = array();
	$member_info = array();
	foreach($list as $key=>$item){
		$fv = array();
		$item_ids[$item['item_id']] = $item['item_id'];
		$push_usernames[$item['id']] = $item['push_username'];
		$member_info[$item['item_id']] = array();
		$new_id = $item['new_id'];
		$fv['id'] = $item['item_id'];
		$fv['cid'] = $item['cid'];
		$fv['cname'] = $item['cname'];
		$fv['title'] = $item['title'];		
		$fv['to_url'] = $sc == 's' ? $this_module->controller.'-view-id-'.$item['item_id'] : '';
			
					
		$fv['to_sites'] = '';
		/*
		$fv['push_back_reason'] = '';				
		if($item['status'] != 1){		
			$sql = 'SELECT * FROM '. $core->TABLE_ .'sites_item_unverified' .' WHERE id = \''. $new_id .'\'';
			$ret = $core->DB_slave->fetch_one($sql);
			if($ret && $ret['push_back_reason']) $fv['push_back_reason'] = $ret['push_back_reason'];
		}
		*/
		$fv['push_username'] = $item['push_username'];				
		$fv['push_direction'] = $sc == "s" ? $P8LANG['push_direction_site'] : $P8LANG['push_direction_cms'];
		$fv['link'] = $item['link'] ? $item['link'] : $this_module->controller.'-view-id-'.$item['new_id'].($item['status']!=1 ? '?verified=0':'');		
		
		$fv['timestamp'] = $item['timestamp'] ? date('Y-m-d H:i',$item['timestamp']) : '';
		$fv['username'] = '';
		$data = mb_unserialize($item['data']);
		if($data){
			$fv['username'] = $data['username'];
			$member_info = $member->get_member_info($data['uid'],$data['username']);
			if($member_info && $member_info['name']) $fv['username'] .= '|'.$member_info['name'];
		}
		$fv['status'] = '';
		if($item['status']==-99) $fv['status'] = '被退稿';
		if($item['status']==1) $fv['status'] = '已接收(终审)';
		if($item['status']==2) $fv['status'] = '已接收(初审)';		
		if($item['status']==88) $fv['status'] = '已接收(回收站)';
		if($item['status']==0) $fv['status'] = '未接收(待审)';		
		if($item['new_id']){
			$site_status = explode(',',$sc=='s' ? $item['site_status']:$item['site']);
			$alias = end($site_status);
			if($alias){
				$site_domain_new = $allsites[$alias]['ipordomain'] ? $allsites[$alias]['domain'].'/index.php/' : $core->CONFIG['url'].'/s.php/'.$alias.'/';
				$fv['to_url'] = $site_domain_new.'item-view-id-'.($sc == 's' ? $item['new_id'] : $item['item_id']).'.html';
			}
			$site_num = count($site_status);
			$fv['to_sites'] = !empty($allsites[$alias]['sitename']) ? $allsites[$alias]['sitename']  : '';
		}else{
			$site_status = explode(',',$sc=='s' ? $item['site_status']:$item['site']);
			$alias = end($site_status);		
			if($alias){
				$fv['to_sites'] = !empty($allsites[$alias]['sitename']) ? $allsites[$alias]['sitename'] : '';
			}
		}
		$fv += $fv;
		foreach($fv as $k => $v){
			$fv[$k] = $v."\t";
		}
		$list[$key] = $fv;
	}
	$head = array(
		'id'=>'id',				
		'cid' => $P8LANG['cid'],
		'category_name'=> $P8LANG['category_name'],
		'title' => $P8LANG['title'],		
		'to_url' => $P8LANG['url'],
		'to_sites' => $P8LANG['push_sites'],		
		'push_username' => $P8LANG['push_username'],
		'push_direction' => $P8LANG['push_direction'],
		'link' => $P8LANG['url'],		
		'timestamp' => $P8LANG['push_timestamp'],		
		'username' => $P8LANG['username'],		
		'status' => $P8LANG['push_status']
	);
	//member_info	
	$member_table = $core->TABLE_.'member';
	$member_info = array();
	if($item_ids){
		$item_ids_string = implode(',',$item_ids);
		$push_usernames_string = '';
		$div = '';
		foreach(array_unique($push_usernames) as $username_tmp){
			if($username_tmp) $push_usernames_string .= $div."'".$username_tmp."'";
			$div = ',';
		}
		$item_table = $sc == 's' ? $this_system->item_table : $sites_system->item_table;
		$sql = "SELECT i.id,m.id as uid,m.username,m.name FROM `$member_table` AS `m` LEFT JOIN `$item_table` AS `i` ON 
		m.username=i.username WHERE i.id in ($item_ids_string)";
		if($push_usernames_string) $sql .= " or m.username in ($push_usernames_string)";
		$query = $core->DB_master->query($sql);
		while($arr = $core->DB_master->fetch_array($query)){
			$md5_username = generate_unique_key($arr['username']);
			$member_info[$md5_username] = $member_info[$arr['id']] = array(
				'username' => $arr['username'],
				'name' => $arr['name'],
			);		
		}
	}		
	//print_r($list);exit;
	
	array_unshift($list,$head);
	$list = convert_encode("UTF-8","GB2312",$list);
	require PHP168_PATH.'/inc/csv.class.php';
	$filename = 'push-'.date('Y-m-d-h-i-s', P8_TIME).'.csv';
	$csv = new P8_Csv();
	$csv->data = $list;
	$csv->file = 'php://output';
	header("Content-type:application/vnd.ms-excel;charset=UTF-8");
	header('Last-Modified: '. gmdate('D, d M Y H:i:s', P8_TIME) .' GMT');
	header('Pragma: no-cache');
	header('Content-type: text/csv');
	header('Content-Encoding: none');
	header('Content-Disposition: attachment; filename='. $filename);
	header('Content-type: csv');
	$csv->save();
	exit;
}