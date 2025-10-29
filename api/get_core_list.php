<?php
/**
* 获取模块列表信息
* 传递参数与访问模块中的列表一致
* 返回list和count
**/
header('Content-type: application/json;charset=utf-8');
require_once dirname(__FILE__) .'/../inc/init.php';
$request = p8_stripslashes2($_POST + $_GET);
GetGP(array('token'));
$data = array();
if(empty($token) || ($token && !hash_equals($token,$core->CONFIG['p8_api_token']))){
	exit(json_encode(array('status'	=> 200,'error' => $P8LANG['api_token_err'])));  
}
$module = isset($request['module']) ? trim($request['module']) : 'letter';
!empty($module) && isset($core->CONFIG['modules'][$module]) && $core->CONFIG['modules'][$module]['installed'] && $core->CONFIG['modules'][$module]['enabled'] or exit('[]');
$category = isset($request['category']) ? intval($request['category']) : 0;
$mid = isset($request['mid']) ? intval($request['mid']) : 0;
$page = isset($request['page']) ? intval($request['page']) : 1;
$page_size = isset($request['page_size']) ? intval($request['page_size']) : 20;
$this_module = $core->load_module($module);
$this_controller = $core->controller($this_module);
$api_file = $this_module->path .'list_api.php';
// 检查api文件是否存在  
if(!file_exists($api_file)) {  
    exit(json_encode(array('status'	=> 200,'error' => 'API file not found')));  
}
include $api_file;
exit;