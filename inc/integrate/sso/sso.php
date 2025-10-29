<?php

$strKey = $inte->CONFIG['code'];
$token = $request['token'];
$username = $request['username'];
$name = $request['name'];
$depart = $request['depart'];
$url = xss_url($request['successURL']);

$domain = '';
if($url){
	$detail = parse_url($url);
	$domain = $detail['host'];
}
if($strKey != $token){
	message("ERR:token认证失败",$core->url, 3);
}else{
	$msg = $inte->login($username,$domain);
	$data = get_member($username);
	$id = $data['id'];
	$datam['name'] = $name;
	$datas['depart'] = $depart;
	$res1 = $DB_master->update($core->TABLE_."member", $datam, "id=$id",true);
	$res2 = $DB_master->update($core->TABLE_."role_group_2_data", $datas, "id=$id",true);
	//var_dump($res);
    message($P8LANG['login_success'].$msg['message'], $url?$url:$core->url, 3);	
}