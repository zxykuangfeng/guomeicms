<?php
defined('PHP168_PATH') or die();

/**
* 登录
**/

//style=com&id=header_login

if(REQUEST_METHOD == 'GET'){
	if(isset($_GET['username']) || isset($_GET['password'])){
		exit('attack');
	}
	$style = 'apply';
    $boxid = 'header_login';
    $forward=HTTP_REFERER;
    if(!$boxid){
        include template($this_module, 'login/apply');
    }else{	
		if($UID){
			$this_module->set_model($ROLE_GROUP);
			$this_module->get_member_info($UID);
		}
		ob_start();
		include template($this_module, 'login/apply');
		$show=ob_get_contents();
		ob_end_clean();
		$show=str_replace(array("\n","\r","'"),array("","","\'"),$show);
		echo "$('#header_apply').html('$show');";
		exit;
	}
}