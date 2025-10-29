<?php
defined('PHP168_PATH') or die();

/**
* 删除数据,只提供AJAX调用
**/
$this_system->check_manager($ACTION) or message('no_privilege');
if(REQUEST_METHOD == 'POST'){
	
	$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
	$id or exit('[]');
	
	$core->DB_master->delete(
       $this_module->table,
	   'id IN ('. implode(',', $id) .')'
	) or exit('[]');
	
	$this_system->log(array(
		'title' => $P8LANG['_module_delete_admin_log'],
		'request' => $_POST,
	));
	
	exit(p8_json($id));
	
}
exit('[]');
