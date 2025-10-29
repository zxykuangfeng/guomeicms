<?php
defined('PHP168_PATH') or die();

$this_controller->check_action($ACTION) or message('no_privilege');
//1反跨站请求伪造（CSRF）
$csrf_enable = $core->CONFIG['csrf_enable'] ? true : false;
if(REQUEST_METHOD == 'GET'){
	//2csrf-token
	$token_key =  "p8_".$_P8SESSION['_hash'].time();
	$token = authcode_token($token_key,'ENCODE');
}elseif(REQUEST_METHOD == 'POST'){
	$id = intval($_POST['id']);
	//3反跨站请求伪造（CSRF）
	if($csrf_enable){
		$token = authcode_token($_POST['token']);
		$token or message('token_error');
	}
	if($id && $this_module->get($id)){
		$where="id ='$id'";
		$yz =1;
		$status =$this_module->verify($where,$yz);
		exit($id);
	}
}
