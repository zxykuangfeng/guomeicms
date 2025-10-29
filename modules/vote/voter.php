<?php
defined('PHP168_PATH') or die();

/**
* 查看投票者
**/
$this_controller->check_action($ACTION) or message('no_privilege');
//1反跨站请求伪造（CSRF）
$csrf_enable = $core->CONFIG['csrf_enable'] ? true : false;
if(REQUEST_METHOD == 'GET'){
	
	$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	$id or message('no_such_item');
	
	$data = $CACHE->read($SYSTEM .'/modules/'. $MODULE, 'vote', $id, 'serialize');
	
	$oid = isset($_GET['oid']) ? intval($_GET['oid']) : 0;
	
	if(empty($data['options'][$oid])) message('no_such_vote_option');
	
	$view_result = $this_controller->check_action('view_result');

	//不允许查看投票者,分配有权限或者创始人例外
	if((empty($data['view_voter']) || !$view_result || empty($data['viewable'])) && !$IS_FOUNDER){
		message('not_allow_to_view_voter');
	}else if(!empty($data['vote_to_view']) && !SE_ROBOT){
		//投票后才允许查看
		$check = $DB_slave->fetch_one( "SELECT timestamp FROM $this_module->voter_table WHERE vid = '$id' AND ". ($UID ? " uid = '$UID'" : " uid = '". P8_IP ."'") );
		
		if(empty($check['timestamp'])) message('vote_to_view', $this_router .'-vote?id='. $id);
		
	}
	
	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$page = max(1, $page);
	
	$select = select();
	$select->from($this_module->voter_table, '*');
	$select->in('oid', $oid);
	$select->order('timestamp ASC');
	
	$page_size = 20;
	
	$page_url = $this_url .'?id='. $id .'&oid='. $oid .'&page=?page?';
	
	$list = $core->list_item(
		$select,
		array(
			'count' => $data['options'][$oid]['votes'],
			'page' => &$page,
			'page_size' => $page_size
		)
	);
	foreach($list as $key=>$m){
		if($m['username']){
			$data = get_member($m['username']);
			unset($data['password'],$data['salt'],$data['address'],$data['fax'],$data['qq'],$data['last_role_id']);
			unset($data['msn'],$data['birthday'],$data['icon'],$data['is_admin'],$data['is_founder'],$data['login_time']);
			unset($data['friend_setting'],$data['friends'],$data['pinyin'],$data['display_order'],$data['memo'],$data['number']);
			unset($data['homepage'],$data['school'],$data['is_email_manager'],$data['new_messages'],$data['status']);
			unset($data['role_id'],$data['role_gid'],$data['register_time'],$data['last_login']);
		}else{
			$data = array();
			$data['username'] = '游客';
		}
		$data['timestamp'] = $m['timestamp'];
		$list[$key] = $data;
	}
	//print_r($list);
	
	$pages = list_page(array(
		'count' => $data['options'][$oid]['votes'],
		'page' => $page,
		'page_size' => $page_size,
		'url' => $page_url
	));
	//2csrf-token
	$token_key =  "p8_".$_P8SESSION['_hash'].time();
	$token = authcode_token($token_key,'ENCODE');
	include template($this_module, 'voter');
	
}else if(REQUEST_METHOD == 'POST'){
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$id or message('no_such_item');	
	$oid = isset($_POST['oid']) ? intval($_POST['oid']) : 0;
	//3反跨站请求伪造（CSRF）
	if($csrf_enable){
		$token = authcode_token($_POST['token']);
		$token or message('token_error');
	}	
	$select = select();
	$select->from($this_module->voter_table, '*');
	$select->in('oid', $oid);
	$select->order('timestamp ASC');
	
	$list = $core->list_item($select);
	foreach($list as $key=>$m){
		if($m['username']){
			$data = get_member($m['username']);
			unset($data['password'],$data['salt'],$data['address'],$data['fax'],$data['qq'],$data['last_role_id']);
			unset($data['msn'],$data['birthday'],$data['icon'],$data['is_admin'],$data['is_founder'],$data['login_time']);
			unset($data['friend_setting'],$data['friends'],$data['pinyin'],$data['display_order'],$data['memo'],$data['number']);
			unset($data['homepage'],$data['school'],$data['is_email_manager'],$data['new_messages'],$data['status']);
			unset($data['role_id'],$data['role_gid'],$data['register_time'],$data['last_login']);
			$data['timestamp'] = $m['timestamp'];
			$list[$key] = $data;
		}else{
			continue;
		}		
	}
	
	$head = array_keys($list[0]);
	array_unshift($list,$head);
	$list = convert_encode("UTF-8","GB2312",$list);
	require PHP168_PATH.'/inc/csv.class.php';
	$filename = 'vote-'.date('Y-m-d-h-i-s', P8_TIME).'.csv';
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
