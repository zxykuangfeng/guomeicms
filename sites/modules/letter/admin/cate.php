<?php
defined('PHP168_PATH') or die();
$this_system->check_manager($ACTION) or message('no_privilege');
$MODEL = '';

if(REQUEST_METHOD == 'GET'){

    $kind = isset($_GET['kind'])?$_GET['kind']:'department';
    //print_r($list);
    
    $data = $this_module->get_category($kind);
    
    include template($this_module, "cate", 'admin');
}else
if(REQUEST_METHOD == 'POST'){
	
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	
    $delete = isset($_POST['delete'])? $_POST['delete'] : array();
    $kind = isset($_POST['kind'])? $_POST['kind'] : '';
	
   if(!empty($delete))
		$this_module->deleteCat($delete);
	
	$this_module->updateCat($_POST,$kind);
	$this_system->log(array(
		'title' => $P8LANG['_module_update_admin_log'],
		'request' => $_POST,
	));
    message('done',$this_url.'?kind='.$kind);
}


