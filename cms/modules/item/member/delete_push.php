<?php
defined('PHP168_PATH') or die();

/**
* 删除数据,只提供AJAX调用
**/
$this_controller->check_admin_action($ACTION) or exit('[]');

if(REQUEST_METHOD == 'POST'){
	
	$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
	$id or exit('[]');	
	$table = $core->TABLE_.'sites_stop_data';
	$core->DB_master->delete(
       $table,
	   'id IN ('. implode(',', $id) .')'
	) or exit('[]');
		
	exit(p8_json($id));
	
}
exit('[]');
