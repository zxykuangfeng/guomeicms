<?php
/**
* 获取主站栏目，通过父栏目ID值，获取下属栏目信息。
* s.php/yx1/category-json
* 传递如：parent = 0;
**/
header('Content-type: application/json;charset=utf-8');
require_once dirname(__FILE__) .'/../inc/init.php';
$request = p8_stripslashes2($_POST + $_GET);
GetGP(array('token','user_name'));
$system = isset($request['system']) ? trim($request['system']) : 'cms';
$parent = isset($request['parent']) ? intval($request['parent']) : 0;
$id = isset($request['id']) ? intval($request['id']) : 0;
$site = isset($request['site']) ? trim($request['site']) : '';
if(empty($token) || ($token && !hash_equals($token,$core->CONFIG['p8_api_token']))){
	exit(json_encode(array('status'	=> 200,'error' => $P8LANG['api_token_err'])));  
}
// 检查系统配置是否存在  
if(!isset($core->CONFIG['system&module'][$system])) {  
    exit(json_encode(array('status'	=> 200,'error' => $P8LANG['no_such_system'])));  
}
if($system == 'sites' && empty($site)) {  
    exit(json_encode(array('status'	=> 200,'error' => $P8LANG['no_such_site'])));  
}
if($user_name){
	$user_info = get_member(p8_addslashes2($user_name));
	if($user_info){
		if(!$user_info['is_founder']){
			$_GET['add'] = 1;
			$IS_FOUNDER = 0;
			$UID = $user_info['id'];
			$core->ROLE = $ROLE = $user_info['role_id'] ? $user_info['role_id'] : 0;
		}
	}else{
		exit(json_encode(array('status' => 200,'error' => $P8LANG['no_such_user'] . "：" . $user_name)));
	}
}
// 加载模块
$this_system = $core->load_system($system);
$this_module = $this_system->load_module('category');  
$api_file = $this_module->path . 'json.php';  
$_GET['parent'] = $parent ? $parent : 0;
if($id)	$_GET['id'] = $id;
if($site) $_GET['newsite'] = $site;
$_GET['api'] = 1;
include $api_file;  
exit;
