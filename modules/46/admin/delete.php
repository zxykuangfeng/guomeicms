<?php
defined('PHP168_PATH') or die();

/**
 * 删除广告
 */

$this_controller->check_admin_action('ad') or message('no_privilege');

if(REQUEST_METHOD == 'POST'){
	$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
	$id or exit('[]');

	$this_module->delete(array(
		'where' => 'id IN ('. implode(',', $id) .')'
	)) or exit('[]');
	
	exit(p8_json($id));
}
