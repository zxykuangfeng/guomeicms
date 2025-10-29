<?php
/*
* serverurl:http://cas.czie.edu.cn/lyuapServer/login
* parm:
* token:xxxx
* script:manage.czie.edu.cn
*/
$strKey = $inte->CONFIG['code'];
$token = $request['token'];
$username = $request['user'];
$username = $username ? $username : $request['username'];
$name = $request['name'];
$depart = $request['depart'];
$url = xss_url($request['forward']);

$domain = '';
if($url){
	$detail = parse_url($url);
	$domain = $detail['host'];
}
if($strKey != $token){
	message("请登录统一身份认证平台！","https://manage.czie.edu.cn/u.php", 2);
//	header("location:https://cas.czie.edu.cn/lyuapServer");
}else{
	//2020.11.11新增
	if(isset($_SERVER["HTTP_REFERER"]) && !empty($_SERVER["HTTP_REFERER"])){
		$servername=$_SERVER['SERVER_NAME'];		
		$sub_from=$_SERVER["HTTP_REFERER"]; 
		$sub_len=strlen($servername); 
		$checkfrom=substr($sub_from,8,$sub_len);
		$checkfrom2=substr($sub_from,7,$sub_len);
		$allow = array($servername,'cas.czie.edu.cn/');
		if(!in_array($checkfrom,$allow) && !in_array($checkfrom2,$allow)){
			message("请登录统一身份认证平台！","https://manage.czie.edu.cn/u.php", 2);
		} 
	}else{
		message("请登录统一身份认证平台！","https://manage.czie.edu.cn/u.php", 2);
	}	
	//2020.11.11新增
	$msg = $inte->login($username,$domain);
	$data = get_member($username);
	$id = $data['id'];
	$datam['name'] = $name;
	$datas['depart'] = $depart;
	$res1 = $DB_master->update($core->TABLE_."member", $datam, "id=$id",true);
	$res2 = $DB_master->update($core->TABLE_."role_group_2_data", $datas, "id=$id",true);
	//var_dump($res);
    message($P8LANG['login_success'].$msg['message'], $url?$url:'https://manage.czie.edu.cn', 1);	
}