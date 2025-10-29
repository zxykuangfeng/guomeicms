<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
    $site = $_GET['alias'];
	$restore = isset($_GET['restore']) ? true: false;
    /*
	$category = &$this_system->load_module('category');
    
    $category->delete(array(
		'where' => "site ='$site'",
		'delete_hook' => true
	));
    */
	//先检测回收站点
	$data = $this_module->get_recycle_site($site);
	//兼容旧程序，防误删除
	 if(empty($data)){
		$this_module->recycle($site,$restore);
		$this_system->log(array(
			'title' => $P8LANG['_module_recycle_admin_log'],
			'request' => $_POST,
		));
	}else{
		 message('recycle_error');
	}
    message('done');
}else if(REQUEST_METHOD == 'POST'){
	
	$sites = isset($_POST['sites']) ? $_POST['sites'] : array();
	$sites or exit('[]');
	$restore = isset($_POST['restore']) ? true: false;
	foreach($sites as $site){
		//先检测站点
		$data = $restore ? $this_module->get_site($site) : $this_module->get_recycle_site($site);
		//兼容旧程序，防误删除
		if(empty($data)){				
			$this_module->recycle($site,$restore);
		}
	}
	$this_system->log(array(
		'title' => $P8LANG['_module_recycle_admin_log'],
		'request' => $_POST,
	));
	exit(jsonencode($sites));    
}
