<?php
defined('PHP168_PATH') or die();

/**
* 复制权限
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');
$member = &$core->load_module('member');
if(REQUEST_METHOD == 'GET'){
	
	$username = isset($_GET['username']) ? trim($_GET['username']) : '';
	$username or message('no_such_item');	
	$member_info = get_member($username);
	$member_info or message('no_such_user');	
	
	include template($core, 'copy_member_acl', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$id or message('no_such_item');
	
	$tar_user = isset($_POST['tar_user']) && is_array($_POST['tar_user']) ? array_filter(array_map('intval', $_POST['tar_user'])) : array();
	if(empty($tar_user)) message('select_target_user');
	
	$member->copy_acl($id, $tar_user) or message('fail');
	
	message('done','',0,'',0);
}
