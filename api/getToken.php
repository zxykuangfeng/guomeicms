<?php
/**
* 单点登录获取返回的token
**/

require_once dirname(__FILE__) .'/../inc/init.php';
$inte = &$core->integrate();

$request = p8_stripslashes2($_POST + $_GET);

if(isset($request['secretKey']) && $request['secretKey'] == $inte->CONFIG['code']){
	$json = array("status"=>1,'message'=>'ok','token'=>MD5($inte->CONFIG['code']));
}else{
	$json = array("status"=>2,'message'=>'false','token'=>'');
}
exit(json_encode($json,JSON_UNESCAPED_UNICODE));