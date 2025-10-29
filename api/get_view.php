<?php
/**
* 获取主站栏目下列表信息。
* 传递如：index.php/cms/item-view-id-1195
* s.php/yx1/item-view-id-9288.html
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
$system = isset($request['system']) ? trim($request['system']) : 'cms';
$site = isset($request['site']) ? trim($request['site']) : '';
$id = isset($request['id']) ? intval($request['id']) : 0;
$page = isset($request['page']) ? intval($request['page']) : 1;
$page_size = isset($request['page_size']) ? intval($request['page_size']) : 20;
$module = 'item';
isset($core->CONFIG['system&module'][$system]) or exit('[]');
$this_system = $core->load_system($system);
if($site=='sites') $this_system->SITE = $site;
$this_module = $this_system->load_module($module);
$this_controller = $core->controller($this_module);
$api_file = $this_module->path .'view_api.php';
// 检查api文件是否存在  
if(!file_exists($api_file)) {  
    exit(json_encode(array('status'	=> 200,'error' => 'API file not found')));  
}
include $api_file;
exit;