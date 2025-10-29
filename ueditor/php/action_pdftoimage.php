<?php
/**
 * 上传PDF附件转成JPG
 * Power by php168.net
 * User: bingbin
 * Date: 2023/4/10
 * Time: 14:27
 */
@set_time_limit(0);
$result = array("state" => 'FAIL');
if(!extension_loaded('imagick')){
	return json_encode($result);
}
require dirname(__FILE__) .'/../../inc/init.php';

$p8upload = $core->load_module('uploader');
$upcontroller = &$core->controller($p8upload);
$upcontroller->check_role_enable() or  exit('{"state":"'.$P8LANG['no_privilege'].'"}');
$system = isset($_GET['system']) ? p8_addslashes($_GET['system']) : 'core';
$module = isset($_GET['module']) ? p8_addslashes($_GET['module']) : '';
$upcontroller->set($system, $module);

$thumb = empty($_POST['thumb']) ? 0 : 1;
$thumb_width = isset($_REQUEST['thumb_width']) ? $_REQUEST['thumb_width'] : 0;
$thumb_height = isset($_REQUEST['thumb_height']) ? $_REQUEST['thumb_height'] : 0;

$cthumb_width = isset($_REQUEST['content_thumb_width']) ? $_REQUEST['content_thumb_width'] : 0;
$cthumb_height = isset($_REQUEST['content_thumb_height']) ? $_REQUEST['content_thumb_height'] : 0;
$store_path = isset($_POST['store_path']) && $_POST['store_path'] ? $_POST['store_path'] : '';

isset($_FILES['upload_files']) && is_array($_FILES['upload_files']) or exit('{"state":"请选择文件"}');



$json = $upcontroller->upload(array(
    'files' => $_FILES['upload_files'],
    'thumb_width' => $thumb_width,
    'thumb_height' => $thumb_height,
    'cthumb_width' => $cthumb_width,
    'cthumb_height' => $cthumb_height,
),$store_path);

$count = count($json);
$json = $json[0];
$data = array();
if(count){
	$PDF = PHP168_PATH.strstr($json['file'],"attachment");
	$Path = "./../../attachment/ueditor/word_images";
	if(!file_exists($PDF)){
		return false;
	}
	$IM =new imagick();
	$IM->setResolution(144,144);
	$IM->setCompressionQuality(100);
	$IM->readImage($PDF);
	$IM->setBackgroundColor(new ImagickPixel('white'));
	foreach($IM as $Key => $Var){
		$Var->setImageFormat('png');
		$Var->setImageBackgroundColor('white');
		$Var->setImageAlphaChannel(imagick::ALPHACHANNEL_REMOVE);
		//$Var->mergeImageLayers(imagick::LAYERMETHOD_FLATTEN);
		//$Var->thumbnailImage(800, 1131,false,true);
		$Filename = $Path.'/'.md5($Key.time()).'.png';
		if($Var->writeImage($Filename)==true){
			$data[]= rtrim($core->attachment_url,'/').strstr($Filename,'/ueditor');
		}
	}
	//Cleanup   
   $IM->clear();
   $IM->destroy();
}


$result = array(
  "state" => 'SUCCESS',
  "url" => $json['file'],
  "title" => $json['name'],
  "original" => $json['name'],
  "type" => 'pdf',
  "width" => 800,
  "height" => 1131,
  'thumb' => $json['thumb'],
  "size" => $json['size'],
  "data" => $data,
);
/**
 * 得到上传文件所对应的各个参数,数组结构
 * array(
 *     "state" => "",          //上传状态，上传成功时必须返回"SUCCESS"
 *     "url" => "",            //返回的地址
 *     "title" => "",          //新文件名
 *     "original" => "",       //原始文件名
 *     "type" => ""            //文件类型
 *     "size" => "",           //文件大小
 * )
 */

/* 返回数据 */
return json_encode($result);
