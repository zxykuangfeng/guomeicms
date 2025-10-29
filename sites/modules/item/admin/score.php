<?php
defined('PHP168_PATH') or die();

/**
* 设置评分,只提供AJAX调用
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'POST'){
	
	$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
	
	$value = isset($_POST['value']) ? intval($_POST['value']) : 0;
    $value >= -100 && $value <= 100 or exit('[]');

	$id or exit('[]');
	$__id__ = $id;
	$verified = true;
	//理由
	$push_back_reason = isset($_POST['push_back_reason']) ? html_entities(from_utf8($_POST['push_back_reason'])) : '';
	
	$T = $this_module->main_table;
	
	$cond = $T .'.id IN ('. implode(',', $id) .')';

	$this_module->score($id, $value, $verified,$push_back_reason) or exit('[]');
		
	exit(p8_json($__id__));
}
exit('[]');