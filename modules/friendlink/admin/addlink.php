<?php
defined('PHP168_PATH') or die();

/**
* 添加友情链接
**/

$this_controller->check_admin_action('link') or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	$select = select();

	$select->from($this_module->table_sort, '*');
	$sorts = $core->list_item($select);
	
	include template($this_module, 'link_edit', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	if($this_controller->add_link($_POST)){
		
		message('done');
	}else{
		
		message('fail');
	}
	
}
