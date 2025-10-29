<?php
defined('PHP168_PATH') or die();
/**
* 删除模型
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'POST'){
	$id =  isset($_POST['id']) ? filter_int($_POST['id']) : array();
	if($id == '199') {
		echo '0';
		exit;
	}	
	//var_dump($_POST);exit;
	$status = $this_controller->delete_model($_POST);
	echo $status;
	exit;		
}