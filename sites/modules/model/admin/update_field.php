<?php
defined('PHP168_PATH') or die();

/**
* 修改字段
**/

$this_controller->check_admin_action('field') or message('no_privilege');

$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
$id or message('no_such_item');

$data = $DB_master->fetch_one("SELECT * FROM $this_module->field_table WHERE id = '$id'");
$data or message('no_such_item');

$model = $data['model'];
$model or message('no_such_cms_model');

$check = $this_module->get_model($model);
$check or message('no_such_cms_model');
if(REQUEST_METHOD == 'GET'){
	
	$widget_data = mb_unserialize($data['data']);
	$data['config'] = mb_unserialize($data['config']);
	
	$fields = $DB_master->fetch_all("SELECT * FROM $this_module->field_table WHERE model = '$model' AND list_table = '1'");
	$core->get_cache('role');
	$config_tmp = mb_unserialize($check['config']);
	$parts = !empty($config_tmp['parts'])? $config_tmp['parts'] : array();
	$parts_json = p8_json($parts);	
	if(!empty($data['part'])){
		list($data['part'],$data['part_row']) = explode("-",$data['part']);
	}
	include template($this_module, 'edit_field', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	@set_time_limit(0);
	
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	
	$this_controller->update_field($id, $_POST);
	$this_system->log(array(
		'title' => $P8LANG['_module_update_field_admin_log'],
		'request' => $_POST,
	));
	$models = $this_system->get_models();
	$model = isset($_POST['model']) ? xss_clear($_POST['model']) : '';
	if($model && !array_key_exists($model,$models)){
		message('fail');
	}
	message('done', $this_router .'-list_field?model='. $model);
}
