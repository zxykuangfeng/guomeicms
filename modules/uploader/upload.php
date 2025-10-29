<?php
defined('PHP168_PATH') or die();

$this_controller->check_role_enable() or message('no_privilege');


GetGP(array('system', 'module','only'));

if($system != 'core' && !get_system($system)) message('access_denied');
if(!empty($module) && !get_module($system, $module)) message('access_denied');

$count = isset($_GET['count']) ? intval($_GET['count'])+1 : 1;
if($count < 0) $count = 99;

$thumb = empty($_POST['thumb']) ? 0 : 1;
$thumb_width = isset($_REQUEST['thumb_width']) ? $_REQUEST['thumb_width'] : 0;
$thumb_height = isset($_REQUEST['thumb_height']) ? $_REQUEST['thumb_height'] : 0;

$cthumb_width = isset($_REQUEST['content_thumb_width']) ? $_REQUEST['content_thumb_width'] : 0;
$cthumb_height = isset($_REQUEST['content_thumb_height']) ? $_REQUEST['content_thumb_height'] : 0;
$from_word = empty($_REQUEST['from_word']) ? 0 : 1;

$this_controller->set($system, $module);

//禁止上传
//$this_controller->check_enabled() or message('upload_disabled');

if(REQUEST_METHOD == 'GET'){
	
	$filter_json = p8_json(isset($_GET['filter']) ? $_GET['filter'] : $this_controller->filter);
	$swf = empty($_GET['swf']) ? 0 : 1;	
	$store = isset($_GET['store']) ? 1 : 0;
	$store_type = isset($_GET['store_type']) && in_array($_GET['store_type'],array('index','category','logo','sites','common')) ? $_GET['store_type'] : 'index';
	load_language($core,'config');
	require_once PHP168_PATH .'inc/cache.func.php';
	$CACHE->delete('', 'core', 'sm_cache_lock');
	//cache_system_module(false,true);
	$this_module = $core->load_module('uploader');
	include template($this_module, $swf ? 'swfupload' : 'upload', 'default');
	exit;
}else if(REQUEST_METHOD == 'POST'){
	$store_path = isset($_POST['store_path']) && in_array($_POST['store_path'],array('index','category','logo','sites','common')) ? $_POST['store_path'] : '';
	if(isset($_POST['action']) && $_POST['action'] == 'capture'){
		//message('no_file_uploaded');
		//捕抓文件
		isset($_POST['upload_files']) && is_array($_POST['upload_files']) or message('select_upload_file');
		
		$json = $this_controller->capture(array(
			'files' => $_POST['upload_files'],
			'thumb_width' => $thumb_width,
			'thumb_height' => $thumb_height,
			'cthumb_width' => $cthumb_width,
			'cthumb_height' => $cthumb_height,
		));
		
	}else{
		//上传文件
		isset($_FILES['upload_files']) && is_array($_FILES['upload_files']) or message('select_upload_file');
        $json = $this_controller->upload(array(
			'files' => $_FILES['upload_files'],
			'thumb_width' => $thumb_width,
			'thumb_height' => $thumb_height,
			'cthumb_width' => $cthumb_width,
			'cthumb_height' => $cthumb_height,
		),$store_path);
		if(empty($_FILES['upload_files']['tmp_name'][0]) || empty($_FILES['upload_files']['size'][0])){
			message(p8lang($P8LANG['no_file_uploaded2'], array(ini_get('upload_max_filesize'))));
		}		
	}
    $succ = [];$falis = [];
    foreach ($json as $hsup){
        if($hsup['state']=='success'){
            $succ[]=$hsup;
        }else{
            $falis[]=$hsup;
        }
    }
	$count = count($json);
	
	if(!$succ){
        if(sizeof($falis)==1){
            message($falis[0]['msg']);
        }
        if(!$this_controller->check_role_enable()){
            message('upload_disabled');
        }
		if(!empty($_FILES['upload_files']['tmp_name'][0]) || !empty($_FILES['upload_files']['size'][0])){
			$type = array();
			if($_FILES['upload_files']['type'][0]){
				$type = explode('/',$_FILES['upload_files']['type'][0]);
			}
			$exe = !empty($type) ? $type[1] : '';
			if($exe){
				$config = $core->get_config('core', 'uploader');
				if(isset($config['filter'][$exe]) && $config['filter'][$exe] && $_FILES['upload_files']['size'][0] >= $config['filter'][$exe]){
					message(p8lang($P8LANG['no_file_uploaded3'], ceil($config['filter'][$exe]/1024).'K',ceil($_FILES['upload_files']['size'][0]/1024).'K'));
				}
			}
			message('no_file_uploaded');
		}else{
			message('no_file_uploaded');
		}
	}
	
	$json = jsonencode(array(
		'action' => 'upload',
		'from_word' => $from_word,
		'attachments' => $succ
	));
	$ISBACK = isset($_REQUEST['isback']) ? $_REQUEST['isback'] : 0;
	if($store_path){
		$json = array();
		setcookie('p8_upload_json', $json, 0, '/', $core->CONFIG['base_domain']);
		$forward = $this_router.'-upload?system=core&module=label&count=-2&content_thumb_width=0&content_thumb_height=0&store=1&store_type='.$store_path;
		message('fetch_uploaded_file', $forward, 2, array($count),0);
	}else{
		setcookie('p8_upload_json', $json, 0, '/', $core->CONFIG['base_domain']);
		$form .= '<script type="text/javascript">setTimeout(function(){$(window.parent.document).find(".php168_dialog").each(function(i){if($(this).css("display")=="block"){$(this).find(".ok").click()}});},500);</script>';
		message($P8LANG['click_ok_to_fetch_uploaded_file'].$form, '', 0, array($count),0);
	}
	
}
