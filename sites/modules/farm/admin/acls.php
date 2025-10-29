<?php
defined('PHP168_PATH') or die();

$mysites = $this_system->get_manage_sites();
$mysites || $this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$site_edit = $this_controller->check_admin_action('site_edit');
	load_language($core, 'config');
	$select = select();
	$select->from($this_module->table, '*');
	$select->in('alias',$mysites);
	$select->order('sort DESC');
	$lists = $core->list_item($select,array('page_size' => 0,'ms' => 'master'));
	$list = array();
	$managers = $posters = $manager_roles = array();
	foreach($lists as $item){
		$config = mb_unserialize($item['config']);
		$item['independent_verify'] = $config['independent_verify'] ? 1 : 0;
		$item['authentication_mark'] = isset($config['authentication_mark']) && $config['authentication_mark'] ? 1 : 0;
		$item['manager'] = $item['manager'] ? explode(',',$item['manager']) : array();
		foreach($item['manager'] as $manager){
			$uids[] = $manager;
		}
		$item['manager_role'] = $item['manager_role'] ?  explode(',',$item['manager_role']) : array();
		foreach($item['manager_role'] as $manager_role){
			$manager_roles[] = $manager_role;
		}
		$item['poster'] = $item['poster'] ? explode(',',$item['poster']) : array();
		foreach($item['poster'] as $poster){
			$uids[] = $poster;
		}
		if($item['parent'] == 0) {
		  $list[$item['id']] = $item;
		  $list[$item['id']]['child'] = array();
		}else{
		  $list[$item['parent']]['child'][]= $item;
		}
    }
	$uids = array_filter($uids, function($value) {return !empty($value);});
	$uids = array_unique($uids);
	if($uids){
		$member = $core->load_module('member');
		$uids = implode(",",$uids);
		$users = $core->DB_master->fetch_all("SELECT id,username,name FROM {$member->table} WHERE id IN ($uids)");
		foreach($users as $user){
			$users_info[$user['id']] = $user;
		}
	}
	$manager_roles = array_filter($manager_roles, function($value) {return !empty($value);});
	$manager_roles = array_unique($manager_roles);
	$roles = array();
	if($manager_roles){
		$core->get_cache('role');
		$roles = $core->get_cache('role', 'all');
		unset($roles[$core->CONFIG['guest_role']]);		
	}
	$role_json = p8_json($roles);
	foreach($list as $id=>$item){
		if(!isset($item['alias'])) {
			$alias_info = $this_module->get_parent_site($id);
			$list[$id]['alias'] = $alias_info['alias'];
			$list[$id]['sitename'] = $alias_info['sitename'];
			$list[$id]['status'] = $alias_info['status'];
			$list[$id]['timestamp'] = $alias_info['timestamp'];
			$list[$id]['sort'] = $alias_info['sort'];
		}
	}	
	//站点信息
	$site = !empty($_GET['site']) ? $_GET['site'] : $_GET['alias'];	
	$site = in_array(clear_special_char($site),array_keys($this_system->sites)) ? clear_special_char($site) : $this_system->SITE;	
	$site_info = $this_system->get_site($site);	
	
	include template($this_module, 'acls', 'admin');

}else if(REQUEST_METHOD == 'POST'){
	$data = array();
	if($this_controller->check_admin_action($ACTION)){
		$manager = isset($_POST['manager'])?array_filter($_POST['manager']):array();
		$poster = isset($_POST['poster'])?array_filter($_POST['poster']):array();
		$manager_role = isset($_POST['role'])?array_filter($_POST['role']):array();
		$data = array('manager'=>$manager,'manager_role'=>$manager_role,'poster'=>$poster);
	}elseif($this_system->check_manager()){
		$poster = isset($_POST['poster'])?array_filter($_POST['poster']):array();
		$data = array('poster'=>$poster);
	}	
	$data['independent_verify'] = isset($_POST['independent_verify']) && $_POST['independent_verify'] ? $_POST['independent_verify'] : array();
	$this_module->set_acls($data);
	$this_module->cache();
	$this_system->log(array(
		'title' => $P8LANG['_module_set_acls_admin_log'],
		'request' => $_POST,
	));
	message('done');	
}
