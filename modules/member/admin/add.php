<?php
defined('PHP168_PATH') or die();

/**
* 修改会员资料
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$nomenu = $_GET['nomenu'] ? 1 : 0;
	$core->get_cache('role_group');
	$config = $core->get_config($SYSTEM, $MODULE);
	$dept = $config['dept'];
	$roles = $core->get_cache('role', 'all');
	unset($roles[$core->CONFIG['guest_role']]);
	if(!$IS_FOUNDER &&isset($config['allow_role']) && !empty($config['allow_role'])){
		foreach($roles as $rid=>$rvalue){
			if(!in_array($rid,$config['allow_role'])) unset($roles[$rid]);
		}
	}
	$role_group_json = jsonencode($core->role_groups);
	$role_json = jsonencode($roles);
	$tdL = $nomenu ? 'tdL td150' : 'tdL';
	include template($this_module, 'edit', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$status = $this_controller->register($_POST,true);
	switch(intval($status)){	
		case -1: message('username_hint'); break;
		case -2: message('username_exists_or_denied'); break;
		case -3: message('email_invalid'); break;
		case -4: message('email_registerd'); break;	
	}
	
	message('done', HTTP_REFERER);
}
