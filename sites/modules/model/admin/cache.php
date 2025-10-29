<?php
defined('PHP168_PATH') or die();

/**
* 缓存模型
**/

if(REQUEST_METHOD == 'GET'){

    $this_module->cache();
	$this_system->log(array(
		'title' => $P8LANG['_module_cache_admin_log'],
		'request' => $_POST,
	));
	message('done', $this_router .'-list');
}else
if(REQUEST_METHOD == 'POST'){
	
	$this_module->cache();
	//跳回总缓存
	!empty($_POST['_all_cache_']) && message($BACKTO_ALL_CACHE);
	message('done');
}

