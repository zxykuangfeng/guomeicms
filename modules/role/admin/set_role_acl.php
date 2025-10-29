<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$system_alias = isset($_GET['system_alias']) ? trim($_GET['system_alias']) : 'cms';
	$this_module->get_cache();
	$this_module->get_group_cache();
	
	$system = isset($_GET['system']) ? $_GET['system'] : 'core';
		
	load_language($core, 'config');

	$system_list = &$core->systems;

	$list = $this_module->get_by_system($system);
	
	$role = &$this_module;

	include template($this_module, 'set_role_acl', 'admin');

}
