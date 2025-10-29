<?php
defined('PHP168_PATH') or die();

//$this_controller->check_action($ACTION) or message('no_privilege');
if(REQUEST_METHOD == 'GET'){
	$mid = isset($_GET['mid'])? intval($_GET['mid']) : 0;
	$id = isset($_GET['id'])? intval($_GET['id']) : 0;
	$id or message('err');
	$this_module->set_model($mid);
	$data = $this_module->get_data($id,$this_module->MODEL);
	if(!$IS_FOUNDER && $this_controller->check_action($ACTION) && $this_controller->check_action('manage') && $UID == $data['uid']){
		message('no_privilege');
	}
	$config = isset($data['config']) && $data['config'] ? mb_unserialize($data['config']) : array();
	
	$list = array();
	$usernames = array();
	foreach($config['logs'] as $keys=>$log){
		if(is_array($log['detail'])){
			$log_det = '';
			foreach($log['detail'] as $detail_tmp){
				$log_det .= $detail_tmp."<br>";
			}
		}else{
			$log_det = $log['detail'];
		}
		$list[$keys]['index'] = $keys+1;
		$list[$keys]['username'] = $log['username'];
		$list[$keys]['name'] = generate_unique_key($log['username']);
		$list[$keys]['uid'] = $log['uid'];
		$list[$keys]['ip'] = $log['ip'];
		$list[$keys]['action'] = $log['action'];
		$list[$keys]['timestamp'] = $log['timestamp'];
		$list[$keys]['log_det'] = $log_det;		
		$usernames[] = $log['username'];		
	}
	//member_info
	$member_info = array();
	if($usernames){
		$push_usernames_string = '';
		$div = '';
		foreach(array_unique($usernames) as $username_tmp){
			$push_usernames_string .= $div."'".$username_tmp."'";
			$div = ',';
		}
		$member_table = $core->TABLE_.'member';
		$sql = "SELECT id,username,name FROM `$member_table` WHERE username in ($push_usernames_string);";
		$query = $core->DB_master->query($sql);
		while($arr = $core->DB_master->fetch_array($query)){
			$md5_username = generate_unique_key($arr['username']);
			$member_info[$md5_username] = $arr['name'];
		}
	}
	include template($this_module, 'logs');	
}
