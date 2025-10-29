<?php
defined('PHP168_PATH') or die();

/**
* 克隆栏目
**/

$this_controller->check_admin_action($ACTION) or exit('[]');


if(REQUEST_METHOD == 'POST'){
	
	@set_time_limit(0);
	
	$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
	$id or exit('[]');
	
	$to_id = isset($_POST['to_id']) ? intval($_POST['to_id']) : 0;
	foreach($id as $tid){
		$this_module->clonecat($tid, $to_id);
	}
	exit('[]');
}
