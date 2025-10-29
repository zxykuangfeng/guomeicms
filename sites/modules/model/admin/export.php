<?php
defined('PHP168_PATH') or die();

/**
* 导出模型
**/

$this_controller->check_admin_action('list') or message('no_privilege');

if(REQUEST_METHOD == 'POST'){
	
	@set_time_limit(0);
	
	$name = isset($_POST['name']) ? preg_replace('/[^0-9a-zA-Z_]/', '', $_POST['name']) : '';
	$new_name = isset($_POST['new_name']) ? preg_replace('/[^0-9a-zA-Z_]/', '', $_POST['new_name']) : '';
	
	$this_module->export($name, $new_name) or message('fail');;
	$this_system->log(array(
		'title' => $P8LANG['_module_export_admin_log'],
		'request' => $_POST,
	));
	message('done');
}
