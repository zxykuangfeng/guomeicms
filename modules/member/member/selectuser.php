<?php
/**
*会员选择
**/
defined('PHP168_PATH') or die();
$core->get_cache('role_group');
$core->get_cache('role');
$status_json = array();
foreach($this_module->status as $status => $lang){
	$status_json[$status] = $P8LANG['member_status'][$lang];
}
$depts = $this_module->CONFIG['dept'];
$dept_list = array();
foreach($depts as $d){
	$dept_list[$d['code']] = $d['name'];
}
$status_json = p8_json($status_json);
$role_group_json = p8_json($core->role_groups);
$role_json = p8_json($core->roles);
include template($this_module, 'selectuser');
