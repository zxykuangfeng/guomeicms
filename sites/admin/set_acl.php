<?php
defined('PHP168_PATH') or die();

/**
* 设置系统及系统下属所有模块的权限开关
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){

	$role_id = isset($_GET['role_id']) ? intval($_GET['role_id']) : 0;
	
	$role = &$core->load_module('role');
	
	if($role_id){
		//本系统的权限
		$acl = $role->get_acl($this_system, $role_id);
		$info = include $this_system->path .'#.php';
		
		$allsites  = $this_system->get_sites();
		$mysites = $this_system->get_manage_sites();
		//各模块的权限
		$acls = array();
		//各模块的描述
		$infos = array();
		foreach($this_system->modules as $name => $v){
			//各模块的权限
			if($v['enabled']){
				$m = &$this_system->load_module($name);
				$acls[$name] = $role->get_acl($m, $role_id, $this_system->SITE);
				
				$infos[$name] = include $m->path .'#.php';
			}
		}
		
		include template($this_system, 'system_acl', 'admin');
		
	}else{
		
		$acl_system = $this_system->name;
		$acl_module = '';
		$role->get_cache();
		
		$list = $role->get_by_system('core');
		
		include template($role, 'list', 'admin');
	}
	
}else if(REQUEST_METHOD == 'POST'){
	$_POST = p8_stripslashes2($_POST);
	$acl = isset($_POST['acl']) && is_array($_POST['acl']) ? $_POST['acl'] : array();
	$acls = isset($_POST['acls']) && is_array($_POST['acls']) ? $_POST['acls'] : array();
	$role_id = isset($_POST['role_id']) ? intval($_POST['role_id']) : 0;
	
	$role = &$core->load_module('role');
	$controller = &$core->controller($role);
	
	//设置系统的权限
	$controller->set_acl($this_system, $role_id, $acl);
	$sitepostfix = $_POST['postfix'];
	
	foreach($acls as $module => $acl){
		//设置各模块的权限
		$m = &$this_system->load_module($module);
		$controller->set_acl($m, $role_id, $acl, $sitepostfix);
	}
	
	$role->set_menu_privilege($role_id, $sitepostfix);
	
	message('done', HTTP_REFERER);
}
