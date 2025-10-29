<?php
defined('PHP168_PATH') or die();
/**
* 删除导航菜单
**/
$this_system->check_manager($ACTION) or exit("[]");
//只提供AJAX方式调用,没有界面
if(REQUEST_METHOD == 'POST'){	
	
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;		
	$json = $this_module->delete_menu($id);	
    $this_system->log(array(
		'title' => $P8LANG['_module_delete_menu_admin_log'],
		'request' => $_POST,
	));
	echo jsonencode($json);
}
exit;
