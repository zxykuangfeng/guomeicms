<?php
defined('PHP168_PATH') or die();

/**
* 供SWF上传
**/

$this_controller->check_role_enable() or exit('[]');

GetGP(array('system', 'module'));

if($system != 'core' && !get_system($system)) exit('[]');
if(!empty($module) && !get_module($system, $module)) exit('[]');

$thumb = empty($_POST['thumb']) ? 0 : 1;
$thumb_width = isset($_REQUEST['thumb_width']) ? $_REQUEST['thumb_width'] : 0;
$thumb_height = isset($_REQUEST['thumb_height']) ? $_REQUEST['thumb_height'] : 0;

$cthumb_width = isset($_REQUEST['content_thumb_width']) ? $_REQUEST['content_thumb_width'] : 0;
$cthumb_height = isset($_REQUEST['content_thumb_height']) ? $_REQUEST['content_thumb_height'] : 0;

$this_controller->set($system, $module);

if(REQUEST_METHOD == 'POST'){
	
	//上传文件
	isset($_FILES['Filedata']) && is_array($_FILES['Filedata']) or exit('[]');
	
	//自定义的文件名
	isset($_POST['_name']) && $_FILES['Filedata']['alias'] = html_entities($_POST['_name']);
	
	$json = jsonencode($this_controller->upload(array(
		'files' => from_utf8($_FILES['Filedata']),
		'thumb_width' => $thumb_width,
		'thumb_height' => $thumb_height,
		'cthumb_width' => $cthumb_width,
		'cthumb_height' => $cthumb_height,
	)));
	
	exit($json);
}
exit('[]');
