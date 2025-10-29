<?php
defined('PHP168_PATH') or die();

/**
* 设置所有核心模块的管理员权限开关
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){

	$role_id = isset($_GET['role_id']) ? intval($_GET['role_id']) : 1;
	
	$role = &$core->load_module('role');
	$acl = $role->get_acl($core, $role_id);
	$info = include $core->path .'#.php';
	
	//各模块的权限
	$acls = array();
	//各模块的描述
	$infos = array();
	foreach($core->list_modules(true) as $name => $v){
		if(!$v['installed'] || !$v['enabled']) continue;
		$m = &$core->load_module($name);
		$acls[$name] = $role->get_acl($m, $role_id);
		
		$infos[$name] = include $m->path .'#.php';						
	}
	$system = $this_system->name;
	include template($core, 'system_admin_map', 'admin');	
}
