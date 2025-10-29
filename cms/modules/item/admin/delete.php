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
	
	$verified = isset($_POST['verified']) && $_POST['verified'] == 1 ? true : false;
	
	$T = $verified ? $this_module->main_table : $this_module->unverified_table;
	/*签发源数据删除，签发数据同步删除*/
	$id = $this_module->get_clone_ids($id);
	
	$ret = $this_controller->delete(array(
		'where' => $T .'.id IN ('. implode(',', $id) .')',
		'verified' => $verified,
		'delete_hook' => false,
		'iid' => $id
	));
	//强制回归action本身
	$ACTION = 'delete';
	exit(jsonencode($ret));
}
exit('[]');
