<?php
defined('PHP168_PATH') or die();

/**
* 插件管理
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$system = isset($_GET['system']) ? $_GET['system'] : 'core';

	if($system != 'core' && !isset($core->systems[$system]))
		message('no_such_system');

	load_language($core, 'config');
	
	$uninstall_plugin = $this_controller->check_admin_action('uninstall_plugin');
	$list = $core->plugins;
	
	if(empty($list)){
		//尝试刷新
		$core->list_plugins(false);
		$list = $core->plugins;
	}
	foreach($list as $key=>$val){
		$info = include $this_system->path .'plugin/'.$key.'/#.php';
		$list[$key]['description'] = isset($info['description']) && $info['description'] ? $info['description'] : '';
		$list[$key]['version'] =  isset($info['version']) && $info['version'] ? $info['version'] : '1.0';
		$list[$key]['ico'] =  isset($info['ico']) && $info['ico'] ? $info['ico'] : 'fa-codepen';
	}
	include template($core, 'plugin_list', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){

	$enables = isset($_POST['enables']) ? (array)$_POST['enables'] : array();
	
	//禁用或开启插件
	foreach($enables as $plugin => $v){
		$plugin = basename($plugin);
		
		$v = empty($v) ? 0 : 1;
		$DB_master->update(
			$core->TABLE_ .'plugin',
			array('enabled' => $v),
			"name = '$plugin'"
		);
	}
	
	require PHP168_PATH .'inc/cache.func.php';
	cache_system_module();
	
	message('done', HTTP_REFERER);
}
