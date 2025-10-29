<?php
defined('PHP168_PATH') or die();

//$this_system->check_manager('config') or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$this_module->cache(false);
	message('done');
	
}else if(REQUEST_METHOD == 'POST'){
	
	@set_time_limit(0);
	
	$this_module->cache();
	
	//跳回总缓存
	!empty($_POST['_all_cache_']) && message($BACKTO_ALL_CACHE);
	
	message('done');
}
