<?php
defined('PHP168_PATH') or die();

/**
* 添加模型
**/

//$this_controller->check_admin_action($ACTION) or message('no_privilege');


if(REQUEST_METHOD == 'GET'){
	$manager=false;
	$admin=false;
	$alias = $_GET['alias'];
	$site = $_GET['site'];
	$site = !empty($site) ? $site : $alias;	
	$site = clear_special_char($site);	
	$site = in_array($site,array_keys($this_system->sites)) ? $site : $this_system->SITE;	
	$site_info = $this_module->get_site($site, true);
	$sitename_alias = $site_info['sitename'];
	$role_json = '{}';	
	$managers = $poster = $manager_role = array();
	$manager_roles = explode(',',$site_info['manager_role']);
	$admin_action = $this_controller->check_admin_action($ACTION);
	$member = &$core->load_module('member');
	if($manager_roles || $admin_action){
		$core->get_cache('role');
		$roles = $core->get_cache('role', 'all');
		unset($roles[$core->CONFIG['guest_role']]);	
	}	
	foreach($manager_roles as $role_list){
		$manager_role[$role_list] = $roles[$role_list];
	}	
	if($admin_action){
		$admin=$manager=true;
		$role_json = p8_json($roles);
		$uids = $site_info['manager'];
		if($uids){					
			$managers = $core->DB_master->fetch_all("SELECT id,username,name FROM {$member->table} WHERE id IN ($uids)");
		}
		$uids = $site_info['poster'];
		if($uids){
			$poster = $core->DB_master->fetch_all("SELECT id,username,name FROM {$member->table} WHERE id IN ($uids)");
		}		
	}elseif($this_system->check_manager()){
		$manager=true;	
		$uids = $site_info['poster'];
		if($uids){
			$poster = $core->DB_master->fetch_all("SELECT id,username,name FROM {$member->table} WHERE id IN ($uids)");
		}
	}	
	include template($this_module, 'acl', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$alias =html_entities($_POST['alias']);
	$alias = $alias ? $alias : html_entities($this_system->SITE);
	$data = $this_module->get_site($alias);
    $config = mb_unserialize($data['config']);
    $config = p8_stripslashes($config);		
	$config['independent_verify'] = isset($_POST['independent_verify']) && $_POST['independent_verify'] ? 1 : 0;
	$config = empty($config) ? '' : serialize($config);
	
	$update = array();
	if($this_controller->check_admin_action($ACTION)){
		$manager = isset($_POST['manager'])?array_filter($_POST['manager']):array();
		$manager = $manager? implode(',',$manager):'';
		$poster = isset($_POST['poster'])?array_filter($_POST['poster']):array();
		$poster = $poster? implode(',',$poster):'';
		
		$manager_role = isset($_POST['role'])?array_filter($_POST['role']):array();
		$manager_role = $manager_role? implode(',',$manager_role):'';
		$update = array('config'=> $config,'manager'=>$manager,'manager_role'=>$manager_role,'poster'=>$poster);
	}elseif($this_system->check_manager()){
		$poster = isset($_POST['poster'])?array_filter($_POST['poster']):array();
		$poster = $poster? implode(',',$poster):'';
		$update = array('config'=> $config,'poster'=>$poster);
	}
	$this_module->update(
		$alias,
		$update		
	);
	$this_module->cache($alias);
	message('done');
}

