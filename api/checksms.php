<?php
require dirname(__FILE__) .'/../inc/init.php';
/*
* sms_check
*/
if(REQUEST_METHOD == 'POST'){
	$_POST = p8_stripslashes2($_POST);	
	$username = isset($_POST['username']) ? $_POST['username'] : '';
	if(strlen($username)<=0) exit('[]');
	$member = $core->load_module('member');
	$sql = "select id,username,status,cell_phone from $member->table where username='$username'";
	$member_info = $core->DB_master->fetch_one($sql);
	if(empty($member_info)) exit('["用户或手机号不存在"]');
	$phone = $member_info['cell_phone'];
	if(strlen($phone)!=11) exit('["手机号不正确"]');
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
		exit('["请不要重复频繁发送，30分钟内有效！"]');
	}
}else{
	exit();
}
