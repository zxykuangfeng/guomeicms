<?php
/**
* 添加模型内容入口文件
* 返回json
**/

require_once dirname(__FILE__) .'/../inc/init.php';
$request = p8_stripslashes2($_POST + $_GET);
$module = isset($request['module']) ? xss_clear($request['module']) : '';
!empty($module) && isset($core->CONFIG['modules'][$module]) && $core->CONFIG['modules'][$module]['installed'] && $core->CONFIG['modules'][$module]['enabled'] or exit('[]');
$mid = isset($request['mid']) ? intval($request['mid']) : 0;
$this_module = $core->load_module($module);
$this_controller = $core->controller($this_module);
$api_file = $this_module->path .'post_api.php';
// 检查api文件是否存在  
if(!file_exists($api_file)) {  
    exit(json_encode(array('status'	=> 200,'error' => 'API file not found')));  
}
include $api_file;
exit;