<?php
defined('PHP168_PATH') or die();

/**
* 添加模型内容入口文件
**/

//$this_controller->check_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'POST'){	
	$_POST = p8_stripslashes2($_POST);	
	$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
	if(strlen($phone)!=11) exit('[]');
	
	$rands = 'ABCDFHKMNPRTWXYabcdefgh34678';
	$code = '';
	for($i = 0; $i < 4; $i++){
		$code .= $rands{mt_rand(0, 19)};
	}
	$interface = 'alisms';
	$sms = $core->load_module('sms');
	$is_send_in_30min = $sms->check_sms(null,$phone);
	if(!$is_send_in_30min){
		$code = array("code" => $code);
		$status=$sms->send($phone, $code, $interface) or message('fail');	
		if($status=='OK'){
			$sms->store_sms($phone,$code);
			exit(p8_json(array($status)));
		}else{
			exit(p8_json(array($status)));
		}
	}else{
		exit('["请不要重复频繁发送！"]');
	}
}else{
	exit();
}
