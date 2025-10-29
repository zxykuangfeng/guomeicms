<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$dir = isset($_GET['dir']) && $_GET['dir'] ? trim($_GET['dir']) : '';
	if(empty($dir)){
		$dirfile_items = array(
			'root_path' => array('type' => 'dir', 'path' => './'),
			'acl_config' => array('type' => 'file', 'path' => './#.php','extension'=> 'php'),
			'index_html' => array('type' => 'file', 'path' => './index.html','extension'=> 'html'),		
			'index_bak_html' => array('type' => 'file', 'path' => './index_bak.html','extension'=> 'html'),	
			'cms_index_html' => array('type' => 'file', 'path' => './cms/index.html','extension'=> 'html'),		
			'cms_index_bak_html' => array('type' => 'file', 'path' => './cms/index_bak.html','extension'=> 'html'),	
			'js_config' => array('type' => 'file', 'path' => './js/config.js','extension'=> 'js'),		
			'attachment' => array('type' => 'dir', 'path' => './attachment'),		
			'html' => array('type' => 'dir', 'path' => './html'),
			'data' => array('type' => 'dir', 'path' => './data'),
			'sites' => array('type' => 'dir', 'path' => './sites'),
			'mobile' => array('type' => 'dir', 'path' => './m'),
			'core_cache' => array('type' => 'file', 'path' => './data/core/core.php','extension'=> 'php'),
			'modules_46' => array('type' => 'dir', 'path' => './modules/46/js/0'),				
		);
	}else{
		$dirfile_items = $this_module->get_dirfile_items($dir);
	}
	$dirfile_items = $this_module->dirfile_check($dirfile_items);
	
	include template($this_module, $ACTION, 'admin');

}else if(REQUEST_METHOD == 'POST'){
	$dir = isset($_POST['dir']) && $_POST['dir'] ? trim($_POST['dir']) : '';
	$dirfile_items = $dir ? $this_module->get_dirfile_items($dir) : array();
	
	$dirfile_items = $dirfile_items ? $this_module->dirfile_check($dirfile_items) : array();
	echo p8_json($dirfile_items);
	exit();
	
}
