<?php
defined('PHP168_PATH') or die();

/**
* 克隆栏目
**/

$this_system->check_manager($ACTION) or exit('[]');


if(REQUEST_METHOD == 'POST'){
	
	@set_time_limit(0);
	
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$id or exit('0');
	
	$to_id = isset($_POST['to_id']) ? intval($_POST['to_id']) : 0;
	
	$this_module->clonecat($id, $to_id);
    $this_system->log(array(
		'title' => $P8LANG['_module_clone_admin_log'],
		'request' => $_POST,
	));
	exit('1');
}
