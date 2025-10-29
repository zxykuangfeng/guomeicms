<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');
require_once PHP168_PATH .'admin/inc/syscheck.func.php';
if(REQUEST_METHOD == 'GET'){
	load_language($core, 'config');
	$dirfile_items = array(
		'acl_config' => array('type' => 'file', 'path' => '/#.php','extension'=> 'php'),
		'index_html' => array('type' => 'file', 'path' => '/index.html','extension'=> 'html'),		
		'index_bak_html' => array('type' => 'file', 'path' => '/index_bak.html','extension'=> 'html'),	
		'cms_index_html' => array('type' => 'file', 'path' => '/cms/index.html','extension'=> 'html'),		
		'cms_index_bak_html' => array('type' => 'file', 'path' => '/cms/index_bak.html','extension'=> 'html'),	
		'js_config' => array('type' => 'file', 'path' => '/js/config.js','extension'=> 'js'),		
		'attachment' => array('type' => 'dir', 'path' => '/attachment','authcode_path'=>authcode_token('/attachment','INCODE',0,true)),
		'html' => array('type' => 'dir', 'path' => '/html','authcode_path'=>authcode_token('/html','INCODE',0,true)),
		'data' => array('type' => 'dir', 'path' => '/data','authcode_path'=>authcode_token('/data','INCODE',0,true)),
		'sites' => array('type' => 'dir', 'path' => '/sites/html','authcode_path'=>authcode_token('/sites/html','INCODE',0,true)),
		'mobile' => array('type' => 'dir', 'path' => '/m','authcode_path'=>authcode_token('/m','INCODE',0,true)),
		'core_cache' => array('type' => 'file', 'path' => '/data/core/core.php','extension'=> 'php'),
		'modules_46' => array('type' => 'dir', 'path' => '/modules/46/js/0','authcode_path'=>authcode_token('/modules/46/js/0','INCODE',0,true)),				
	);	
	$dirfile_items = dirfile_check($dirfile_items);
	include template($this_system, 'syscheck/'.$ACTION, 'admin');

}else if(REQUEST_METHOD == 'POST'){	
	$dir = isset($_POST['dir']) && $_POST['dir'] ? trim(clear_special_char($_POST['dir'])) : '';	
	$dir = escapeshellcmd($dir);
	$dir = p8_filter_special_chars($dir);
	$dir = p8_authcode($dir);
	$dirfile_items = $dir ? get_dirfile_items($dir) : array();
	
	$dirfile_items = $dirfile_items ? dirfile_check($dirfile_items) : array();
	echo p8_json($dirfile_items);
	exit();
	
}
