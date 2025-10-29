<?php
defined('PHP168_PATH') or die();

if(REQUEST_METHOD == 'POST'){		
	$id =  isset($_POST['id']) ? filter_int($_POST['id']) : array();
	$p8_status = isset($_POST['p8_status']) ? trim($_POST['p8_status']) : '';
	$reply = '';
	if(!$id)exit('[]');	
	$data = $this_module->get_data($id);	
	if($IS_FOUNDER || $data['uid'] == $UID){
		$realarray = $id;	
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
}else{
	exit("[]");
}

