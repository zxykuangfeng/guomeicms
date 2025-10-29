<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');
if(REQUEST_METHOD == 'POST'){		
	$id =  isset($_POST['id']) ? filter_int($_POST['id']) : array();
	$oid = isset($_POST['oid']) ? intval($_POST['oid']) : '';
	$p8_status = isset($_POST['p8_status']) ? trim($_POST['p8_status']) : '';
	$reply = isset($_POST['reply']) ? from_utf8(p8_html_filter($_POST['reply'])) : '';
	if(!$id && !$oid )exit('[]');
	$realarray = $oid? array($oid) : $id;
	
	$resule = $this_module->p8_status(array(
		'ids' => implode(",",$realarray),
		'reply' => $reply,
		'status' => $p8_status,
		'replyer' => $USERNAME
	));	
	exit(p8_json($resule));		
}else{
	exit("[]");
}

