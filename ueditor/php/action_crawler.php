<?php
/**
 * 抓取远程图片
 * Power by php168.net
 * User: bingbin
 * Date: 2022/8/1
 * Time: 11:07
 */
set_time_limit(0);

require dirname(__FILE__) .'/../../inc/init.php';

$p8upload = $core->load_module('uploader');
$upcontroller = &$core->controller($p8upload);
$upcontroller->check_role_enable() or  exit('{"state":"'.$P8LANG['no_privilege'].'"}');
$system = isset($_GET['system']) ? p8_addslashes($_GET['system']) : 'core';
$module = isset($_GET['module']) ? p8_addslashes($_GET['module']) : '';
$upcontroller->set($system, $module);

/* 上传配置 */

$fieldName = $CONFIG['catcherFieldName'];

/* 抓取远程图片 */
$list = array();
if (isset($_POST[$fieldName])) {
    $source = $_POST[$fieldName];
} else {
    $source = $_GET[$fieldName];
}
foreach ($source as $url) {
  
  if(attachment_url($url, true) != $url){
		continue;
	}
    
    if(
		$ret = $upcontroller->capture(array(
			'files' => $url,
			'thumb_width' => empty($CONFIG['frame_thumb_width']) ? 0 : $CONFIG['frame_thumb_width'],
			'thumb_height' => empty($CONFIG['frame_thumb_height']) ? 0 : $CONFIG['frame_thumb_height'],
			'cthumb_width' => empty($CONFIG['content_thumb_width']) ? 0 : $CONFIG['content_thumb_width'],
			'cthumb_height' => empty($CONFIG['content_thumb_height']) ? 0 : $CONFIG['content_thumb_height'],
		))
	){
		$ret = current($ret);
		
		$ret['file'] = $ret['file'].($ret['thumb']==2?'.cthumb.jpg':($ret['thumb']==1?'.thumb.jpg':''));
		$ret['file'] = substr($ret['file'],strlen($core->get_attachment_url()));
		
         array_push($list, array(
            "state" => 'SUCCESS',
            "url" => $ret['file'],
            "size" => $ret["size"],
            "title" => htmlspecialchars($ret["name"]),
            "original" => htmlspecialchars($ret["name"]),
            "source" => htmlspecialchars($url)
        ));
	}

  
   
}

/* 返回抓取数据 */
return json_encode(array(
    'state'=> count($list) ? 'SUCCESS':'ERROR',
    'list'=> $list
));