<?php
defined('PHP168_PATH') or die();

/**
* 删除追加内容, 只能由ajax请求, 如果成功则返回被删除的页数
**/

$this_system->check_manager('delete') or message('[]');

if(REQUEST_METHOD == 'POST'){
	$models = $this_system->get_models();
	$model = isset($_POST['model']) ? xss_clear($_POST['model']) : '';
	if($model && !array_key_exists($model,$models)){
		exit('[]');
	}
	$iid = isset($_POST['iid']) ? intval($_POST['iid']) : 0;
	$iid or exit('[]');
	
	$id = isset($_POST['id']) ? filter_int((array)$_POST['id']) : array();
	$__id__ = $id;
	$verified = isset($_POST['verified']) && $_POST['verified'] == 1 ? true : false;
	
	$this_controller->delete_addon(array(
		'iid' => $iid,
		'id' => $id,
		'verified' => $verified
	));
	$this_system->log(array(
		'title' => $P8LANG['_module_delete_addon_admin_log'],
		'request' => $_POST,
	));
	exit(jsonencode($__id__));
}
