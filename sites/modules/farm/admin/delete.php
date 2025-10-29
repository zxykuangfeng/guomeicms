<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');
$category = &$this_system->load_module('category');
if(REQUEST_METHOD == 'GET'){	
    $site = $_GET['alias'];
	//先检测正常站点
	$data = $this_module->get_site($site);
	//兼容旧程序，防误删除
	if(empty($data)){
		$category->delete(array(
			'where' => "site ='$site'",
			'delete_hook' => true
		));
		
		$this_module->delete($site);
			
		$this_system->log(array(
			'title' => $P8LANG['_module_delete_admin_log'],
			'request' => $_POST,
		));
	}else{
		$this_module->delete_recycle($site);
	}
	message('done');	
}else if(REQUEST_METHOD == 'POST'){	
	$sites = isset($_POST['sites']) ? $_POST['sites'] : array();
	$sites or exit('[]');	
    if($sites){
        foreach($sites as $site){
			//先检测正常站点
			$data = $this_module->get_site($site);
			//兼容旧程序，防误删除			
			if(empty($data)){
				$category->delete(array(
					'where' => "site ='$site'",
					'delete_hook' => true
				));
				$this_module->delete($site);
			}else{
				$this_module->delete_recycle($site);
			}
        }
    }else{
		exit('[]');
	}	
	$this_system->log(array(
		'title' => $P8LANG['_module_delete_admin_log'],
		'request' => $_POST,
	));
	exit(jsonencode($sites));    
}
