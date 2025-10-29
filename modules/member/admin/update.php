<?php
defined('PHP168_PATH') or die();

/**
* 修改会员资料
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	$id or message('no_such_username');
	
	$role_gid = isset($_GET['role_gid']) ? intval($_GET['role_gid']) : 0;
	
	$config = $core->get_config($SYSTEM, $MODULE);
	$questions = isset($config['questions']) ? $config['questions'] : array();
	krsort($questions);
	
	$dept = $config['dept'];
	
	$this_module->set_model($role_gid);
	$this_model = &$this_module->get_model($role_gid);
	
	
	$core->get_cache('role_group');
	$roles = $core->get_cache('role', 'all');
	unset($roles[$core->CONFIG['guest_role']]);	
	if(!$IS_FOUNDER &&isset($config['allow_role']) && !empty($config['allow_role'])){
		foreach($roles as $rid=>$rvalue){
			if(!in_array($rid,$config['allow_role'])) unset($roles[$rid]);
		}
	}
	$member_config = $core->get_config('core', 'member');
	
	$role_group_json = jsonencode($core->role_groups);
	$role_json = jsonencode($roles);
	
	$select = select();
	$select->from($this_module->table .' AS m', 'm.*,m.id as mid');
	$select->left_join($this_module->addon_table .' AS a', 'a.*', 'm.id = a.id');
	$select->in('m.id', $id);
	$data = $core->select($select, array('single' => true, 'ms' => 'master'));
	$data or message('no_such_username');
	$this_module->format_data($data);
	$find_pwd = mb_unserialize($data['find_pwd']);
	$data['icon']=attachment_url($data['icon']);
	array_multisort(array_column($this_model['fields'],'display_order'),SORT_DESC,$this_model['fields']);
	include template($this_module, 'edit', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$id or message('no_such_item');
	
	$role_gid = isset($_POST['role_gid']) ? intval($_POST['role_gid']) : 0;
	$role_id = isset($_POST['role_id']) ? intval($_POST['role_id']) : 0;
	
	$this_module->set_model($role_gid);
	$this_model = &$this_module->get_model($role_gid);
	
	$data = $this_controller->update($id, $_POST);
	
	if($data['error']) message($data['error']);
	
	message('done', $this_router .'-list');
}
