<?php
defined('PHP168_PATH') or die();

/**
* 添加模型
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	load_language($core, 'config');
    $data['enabled']=$config['prev&next_item']=1;
	include template($this_module, 'edit_model', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	
	$this_controller->add($_POST) or message('fail');
	
	if(!empty($this_system->CONFIG['model_partition_crontab'])){
		$crontab_id = $this_system->CONFIG['model_partition_crontab'];
		
		$crontab = &$core->load_module('crontab');
		include $crontab->path .'inc/run.php';
	}
	$this_system->log(array(
		'title' => $P8LANG['_module_add_admin_log'],
		'request' => $_POST,
	));
	message('done',$this_router.'-list');
}
