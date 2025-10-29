<?php
defined('PHP168_PATH') or die();

/**
* 合并栏目
**/

$this_system->check_manager($ACTION) or exit('[]');


if(REQUEST_METHOD == 'POST'){
	
	@set_time_limit(0);
	
	$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
	$id or exit('0');
	
	$to_id = isset($_POST['to_id']) ? intval($_POST['to_id']) : 0;
	$to_id or exit('0');
	
	$this_module->merge($id, $to_id);
    
    $this_system->log(array(
		'title' => $P8LANG['_module_merge_admin_log'],
		'request' => $_POST,
	));

	exit('1');
}
