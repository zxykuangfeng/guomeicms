<?php
defined('PHP168_PATH') or die();

/**
* 添加字段
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

$model = isset($_REQUEST['model']) ? $this_controller->valid_name($_REQUEST['model']) : '';
$model or message('no_such_cms_model');

$check = $this_module->get_model($model);
$check or message('no_such_cms_model');

if(REQUEST_METHOD == 'GET'){
	
	$data['model'] = $check['name'];
	$list_table = empty($_GET['list_table']) ? 0 : 1;
	$widget_data = array();
	$core->get_cache('role');
	$fields = $DB_master->fetch_all("SELECT * FROM $this_module->field_table WHERE model = '$model' AND list_table = '1'");
	$config_tmp = mb_unserialize($check['config']);
	$parts = !empty($config_tmp['parts'])? $config_tmp['parts'] : array();
	$parts_json = p8_json($parts);
	include template($this_module, 'edit_field', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	@set_time_limit(0);
	
	$this_controller->add_field($_POST) or message('fail');
	
	message('done', $this_router .'-list_field?model='. $_POST['model']);
}
