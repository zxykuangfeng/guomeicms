<?php
/**
 * 上传附件和上传视频
 * Power by php168.net
 * User: bingbin
 * Date: 2022/8/1
 * Time: 11:07
 */

require dirname(__FILE__) .'/../../inc/init.php';

$p8upload = $core->load_module('uploader');
$upcontroller = &$core->controller($p8upload);
$upcontroller->check_role_enable() or exit('{"state":"'.$P8LANG['no_privilege'].'"}');
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
$chunk = isset($_REQUEST['chunk']) ? $_REQUEST['chunk'] : 0;
$chunks = isset($_REQUEST['chunks']) ? $_REQUEST['chunks'] : 0;

isset($_POST['name']) && $_FILES['upload_files']['alias'] = html_entities($_POST['name']);
$json = $upcontroller->upload(array(
    'files' => $_FILES['upload_files'],
    'thumb_width' => $thumb_width,
    'thumb_height' => $thumb_height,
    'cthumb_width' => $cthumb_width,
    'cthumb_height' => $cthumb_height,
	'content_length' => $_SERVER['CONTENT_LENGTH'],
    'size' => $_REQUEST['size'],
    'chunk' => $chunk,
    'chunks' => $chunks,
),$store_path);
/**
 *   [id] => 1158
    [name] => QQ图片20220624120838.jpg
    [file] => http://www.sharpgit.hb/attachment/core/2022_08/01_15/9b4b62710e3b215c.jpg
    [size] => 1006423
    [thumb] => 2
 */

$count = count($json);
if($count==1){
    $json = $json[0];
}

if($json['state']==='false'){
    $result = [
        "state" => $json['msg'],
    ];
}else{
$result = array(
      "state" => 'SUCCESS',
      "url" => $json['file'].($json['thumb']==2?'.cthumb.jpg':''),
      "title" => $json['name'],
      "original" => $json['name'],
      "type" => $json['ext'],
      "width" => 700,
      "height" => 500,
      'thumb' => $json['thumb'],
      "size" => $json['size']
  );
}
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
