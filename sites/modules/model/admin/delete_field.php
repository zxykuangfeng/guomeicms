<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action('field') or exit('0');

if(REQUEST_METHOD == 'POST'){
	
	@set_time_limit(0);
	
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$id or exit('0');
	$this_system->log(array(
		'title' => $P8LANG['_module_delete_field_admin_log'],
		'request' => $_POST,
	));
	$this_controller->delete_field($id) or exit('0');
	
	exit('1');
}
