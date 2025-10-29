<?php
defined('PHP168_PATH') or die();

if(REQUEST_METHOD == 'POST'){
	$this_module->cache_count();
	///跳回总缓存
	!empty($_POST['_all_cache_']) && message($BACKTO_ALL_CACHE);
	global $ADMIN_LOG,$ACTION;
	$ACTION = 'cache';
	$ADMIN_LOG = array('title' => $P8LANG['_module_cache_admin_log']);	
	message('done');
}
