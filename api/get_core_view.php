<?php
/**
* 获取模块内容信息
* 传递参数与访问模块中的内容一致
* 返回json数据
**/
header('Content-type: application/json;charset=utf-8');
require_once dirname(__FILE__) .'/../inc/init.php';
$request = p8_stripslashes2($_POST + $_GET);
GetGP(array('token'));
$data = array();
if(empty($token) || ($token && !hash_equals($token,$core->CONFIG['p8_api_token']))){
	exit(json_encode(array('status'	=> 200,'error' => $P8LANG['api_token_err'])));  
}
$module = isset($request['module']) ? trim($request['module']) : '';
!empty($module) && isset($core->CONFIG['modules'][$module]) && $core->CONFIG['modules'][$module]['installed'] && $core->CONFIG['modules'][$module]['enabled'] or exit('[]');
$mid = isset($request['mid']) ? intval($request['mid']) : 0;
$id = isset($request['id']) ? intval($request['id']) : 0;
if(empty($id)){
	$data['error'] = $P8LANG['no_such_item'];
	exit(jsonencode($data));
}
$this_module = $core->load_module($module);
$this_controller = $core->controller($this_module);
$api_file = $this_module->path .'view_api.php';
// 检查api文件是否存在  
if(!file_exists($api_file)) {  
    exit(json_encode(array('status'	=> 200,'error' => 'API file not found')));  
}
include $api_file;
exit;