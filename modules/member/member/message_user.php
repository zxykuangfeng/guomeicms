<?php
defined('PHP168_PATH') or die();

/**
* 短消息默认用户
**/

if(REQUEST_METHOD == 'GET'){
	$select = select();
	$select->from($this_module->table, 'id, username, number, role_id, role_gid, name, email, phone, cell_phone, last_login_ip, last_login, status');
	$select->in('status', 0);
	$select->in('is_message_user', 1);
	$count = 0;
	$page = 0;
	$list = $core->list_item(
		$select,
		array(
			'count' => &$count,
			'page' => &$page
		)
	);
	
	if(P8_AJAX_REQUEST){
		//AJAX jsonp请求
		$callback = isset($_GET['callback']) ? xss_clear($_GET['callback']) : '';
		$callback = preg_replace('/[^\w_]*/','',$callback);
		exit($callback .'('. jsonencode($list) .');');		
	}	
}