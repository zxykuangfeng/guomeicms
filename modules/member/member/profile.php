<?php
defined('PHP168_PATH') or die();

$this_model = $this_module->get_model($ROLE_GROUP);
$this_module->set_model($ROLE_GROUP);

if(REQUEST_METHOD == 'GET'){
	
	$editpw = isset($_GET['editpw']) ? true : false;
	$select = select();
	$select->from($this_module->table .' AS m', 'm.*');
	$select->inner_join($this_module->addon_table .' AS f', 'f.*', 'm.id = f.id');
	$select->in('m.id', $UID);
	$data = $core->select($select, array('single' => true));
	if(empty($data)){
		//自定义字段表如果不存在就新增数据
		$DB_master->insert($this_module->addon_table, array('id' => $UID));
		header('Location: '. $this_url);
		exit;
	}
	$config = $core->get_config($SYSTEM, $MODULE);
	$questions = isset($config['questions']) ? $config['questions'] : array();
	krsort($questions);
	$dept = $config['dept'];
	$icon_allow = isset($config['icon_allow']) && $config['icon_allow'] ? true : false;
	$this_module->format_data($data);
	$find_pwd = mb_unserialize($data['find_pwd']);
	$data['icon']=attachment_url($data['icon']);
	if($data['birthday']){
		$by[date("Y",$data['birthday'])] = " selected" ;
		$bm[date("m",$data['birthday'])] = " selected" ;
		$ba[date("d",$data['birthday'])] = " selected" ;
	}
	if($data['gender']=='2'){
		$data['2']=" checked ";
	}elseif($data['gender']=='1'){
		$data[1]=" checked ";
	}else{
		$data[0]=" checked ";
	}

    $wechatInfo = [];
    if(isset($this_module->core->CONFIG['plugins']['wechatconnect']) && $this_module->core->CONFIG['plugins']['wechatconnect']['enabled']){
        $wechatconnect = $this_module->core->load_plugin('wechatconnect');
        $wechatInfo = $wechatconnect->getByUid($UID);
    }
	
	include template($this_module, 'profile');
}else if(REQUEST_METHOD == 'POST'){
	
	$job=isset($_POST['job'])? $_POST['job'] : '';
	
	if($job=='passwd'){
		GetGP(array('old_password','new_password','confirm_password'));
		$pwlevel = $this_module->checkpwlevel($new_password);
		if($pwlevel != 1) message($P8LANG['pw_level_too_low'],'?editpw=1',2);
		switch($s = $this_controller->change_password($USERNAME, $old_password, $new_password, $confirm_password)){
			case 0:
				message('done');
			break;
			
			case -1:
				message('password_not_match');
			break;
			
			case -2:
				message('input_old_password');
			break;
			case -3:
				message('fail');
			break;
		}
		//echo $s;
	}else{
		//不允许修改的字段
		unset($_POST['role_id'], $_POST['role_gid'], $_POST['is_founder'], $_POST['status'],$_POST['id'],$_POST['username'],$_POST['is_admin']);
		
		$_POST['birthday'] = $_POST['birthday_year']."-".$_POST['birthday_month']."-".$_POST['birthday_day'];
		$_POST['usercenter'] = 1;		
		$status = $this_controller->update($UID, $_POST);
		
		if(isset($status['error']))
			message($status['error']);
		
		message('done');
		
	}
}
