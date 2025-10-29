<?php
defined('PHP168_PATH') or die();

/**
* 删除, 只提供AJAX
**/

$this_controller->check_admin_action($ACTION) or exit('[]');

if(REQUEST_METHOD == 'POST'){
	//过滤非数字
	$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
	$id or exit('[]');
	
	$this_controller->delete_data($id);
	exit(jsonencode($id));
}
exit('[]');
