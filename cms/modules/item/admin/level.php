<?php
defined('PHP168_PATH') or die();

/**
* 移动内容,只提供AJAX POST调用
**/

$this_controller->check_admin_action($ACTION) or exit('[]');

if(REQUEST_METHOD == 'POST'){
	$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
	$id or exit('[]');

	$value = isset($_POST['value']) ? intval($_POST['value']) : 0;
    $value >= 0 && $value <= 250 or exit('[]');

	$__id__ = $id;
	if(isset($_POST['verified'])){
		$verified = $_POST['verified'] == 1 ? true : false;
	}else{
		$verified = true;
	}
	$level_time = isset($_POST['level_time']) ? strtotime($_POST['level_time']) : 0;

    $this_module->level($id, $value, $verified,$level_time) or exit('[]');
    exit(p8_json($__id__));
}