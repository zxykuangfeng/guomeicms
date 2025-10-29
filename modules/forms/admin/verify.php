<?php
defined('PHP168_PATH') or die();

/**
* 审核,只提供AJAX调用
**/
$this_controller->check_admin_action($ACTION) or exit('[]');

if(REQUEST_METHOD == 'POST'){	
	$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
	$value = isset($_POST['value']) ? intval($_POST['value']) : 0;
	$value = in_array($value,array(0,1,2,88,-99)) ? $value : 0;
	$mid = isset($_POST['mid']) ? intval($_POST['mid']) : 0;
	//$this_controller->verify_acl($value);

	$id or exit('[]');
	
	//退稿理由
	$push_back_reason = isset($_POST['push_back_reason']) ? html_entities(from_utf8($_POST['push_back_reason'])) : '';
	$member_info = get_member($USERNAME);
	$push_back_reason .= date('Y-m-d H:i:s', P8_TIME).' '.$P8LANG['verifier'].':'.$USERNAME.($member_info['name'] ? '('.$member_info['name'].')' : '');
		
	$cond = 'id IN ('. implode(',', $id) .')';
	$_tmp_ids = $id;
	$ret = $this_module->verify(array(
		'id' => $id,
		'where' => $cond,
		'value' => $value,
		'mid' => $mid,
		'push_back_reason' => $push_back_reason
	));
	foreach($_tmp_ids as $_id){
		$this_module->sendMsg($_id,'verify');
	}
    require_once PHP168_PATH. 'inc/verify_log.php';
    (new VerifyLog())->create('forms',$_tmp_ids,$P8LANG['forms_verify'][$value],$push_back_reason);
    exit(jsonencode($_tmp_ids));
}
exit('[]');
