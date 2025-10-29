<?php

$verify = $request['verify'];
if (empty($verify))
{
    message("ERR:verify不能为空,认证失败",$core->url, 3);
}
$strKey = $inte->CONFIG['code'];
$username = $request['userName'];
$strSysDatetime = $request['strSysDatetime'];
$jsName = $request['jsName'];
$url = xss_url($request['url']);

$time = substr($strSysDatetime,0,10).' '.substr($strSysDatetime,10);

if(abs(strtotime($time) - time())>600){
    message("ERR:超时,认证失败",$core->url, 3);
}

$verify = str_replace(array(' ','+','-','/','='),'',$verify);

$mtxt = MD5($username . $strKey . $strSysDatetime . $jsName);
$mtxt = str_replace(array(' ','+','-','/','='),'',$mtxt);
$domain = '';
if($url){
	$detail = parse_url($url);
	$domain = $detail['host'];
}
if(strtolower($verify)==strtolower($mtxt)){
    $msg = $inte->login($username,$domain);
    message($P8LANG['login_success'].$msg['message'], $url?$url:$core->url, 3);
}else{
    message( "ERR:认证失败",$core->url, 3);
}
