<?php
defined('PHP168_PATH') or die();

/**
* 还原CMS分类,只提供AJAX调用
**/

$this_controller->check_admin_action($ACTION) or exit('[]');


if(REQUEST_METHOD == 'POST'){
	
	@set_time_limit(0);
	
	$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();

	$id or exit('[]');
	$this_module->cache_recycle();
	$ret = $this_module->restore(array(
		'where' => 'id IN ('. implode(',', $id) .')',
		'delete_hook' => false
	)) or exit('[]');
	
	$this_module->cache_recycle();
	$this_module->cache();
	
	exit(jsonencode($ret));
}

