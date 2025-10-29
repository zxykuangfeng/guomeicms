<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$system = $module = '';
	load_language($core, 'config');
    $this_module->cache();
	include template($this_module, 'cache', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	$type = isset($_POST['type']) ? $_POST['type'] : '';
	$systems = $core->list_systems();
	$this_module->cache('cms');
	if(isset($systems['sites']) && $systems['sites']['enabled']){
		$this_module->cache('sites');
	}
	$this_module->cache('forms');

	//跳回总缓存
	!empty($_POST['_all_cache_']) && message($BACKTO_ALL_CACHE);
	
	message('done',HTTP_REFERER);
}
