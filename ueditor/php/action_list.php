<?php
/**
 * 获取已上传的文件列表
 * Power by php168.net
 * User: bingbin
 * Date: 2022/8/1
 * Time: 11:07
 */
/* 判断类型 */
require dirname(__FILE__) .'/../../inc/init.php';

$system = isset($_GET['system']) ? p8_addslashes($_GET['system']) : 'core';
$module = isset($_GET['module']) ? p8_addslashes($_GET['module']) : '';
$page_size = isset($_GET['size']) ? p8_addslashes($_GET['size']) : 20;
$start = $page = isset($_GET['start']) ? p8_addslashes($_GET['start']) : 1;

$p8upload = $core->load_module('uploader');
$upcontroller = &$core->controller($p8upload);
$upcontroller->check_action('list') or  exit('{"state":"'.$P8LANG['no_privilege'].'"}');

$this_module = $core->load_module('uploader');

if($system != 'core'){
	$sys_info = get_system($system);
	$table = $sys_info['table_prefix'] .'attachment';
}else{
	$table = $this_module->table;
}

$select = select();
$select->from($table, '*');
if($UID){
    $select->in('uid', $UID);
}else{
    $select->in('uid', 0);
    $select->in('ip', P8_IP);
}

$select -> order(' id DESC');
$count = 0;

$list = $core->list_item(
	$select,
	array(
		'page' => &$page,
		'count' => &$count,
		'page_size' => $page_size
	)
);

foreach($list as $key=>$item){
	$file = attachment_url($item['path']);
    $files[] = [
                'url'=> $core->attachment_url.'/'.$file,
                'mtime'=> filemtime($file)
            ];
}


/* 返回数据 */
$result = json_encode(array(
    "state" => "SUCCESS",
    "list" => $files,
    "start" => $start,
    "total" => count($files)
));

return $result;
