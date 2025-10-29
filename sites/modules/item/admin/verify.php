<?php
defined('PHP168_PATH') or die();

/**
* 审核文章,只提供AJAX调用
**/

$this_system->check_manager($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'POST'){
	
	$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
	$value = isset($_POST['value']) ? intval($_POST['value']) : 0;
	
	$site_info = $this_system->get_site($this_system->SITE);
	$independent_verify = !empty($site_info['config']['independent_verify']) ? true : false;
	if($independent_verify && $value != 88){
		$this_controller->check_admin_action('verify','',true) or  exit('[]');
	}
	//$this_controller->verify_acl($value);
	
	$id or exit('[]');
	
	$verified = isset($_POST['verified']) && $_POST['verified'] == 1 ? true : false;
	//退稿理由
	$push_back_reason = isset($_POST['push_back_reason']) ? html_entities(from_utf8($_POST['push_back_reason'])) : '';
	$member_info = get_member($USERNAME);
	$push_back_reason .= date('Y-m-d H:i:s', P8_TIME).' '.$P8LANG['verifier'].':'.$USERNAME.($member_info['name'] ? '('.$member_info['name'].')' : '');	
	$T = $value == 1 ? $this_module->unverified_table : $this_module->main_table;
	$T = $verified ? $this_module->main_table : $this_module->unverified_table;
	
	$cond = $T .'.id IN ('. implode(',', $id) .')';
	
	$ret = $this_controller->verify(array(
		'where' => $cond,
		'value' => $value,
		'verified' => $verified,
		'push_back_reason' => $push_back_reason
	));
	$this_system->log(array(
		'title' => $P8LANG['_module_verify_admin_log'],
		'request' => $_POST,
	));
	exit(jsonencode($ret));
}
exit('[]');
