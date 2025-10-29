<?php
defined('PHP168_PATH') or die();

//$this_controller->check_action($ACTION) or message('no_privilege');

header('Pragma: no-cache');
header('Cache-Control: no-cache, must-revalidate');
//强制登录
$UID or message('not_login', $core->U_controller.'?forward='.$this_url,2);

$system = 'core';
$module = isset($_GET['type']) ? p8_addslashes($_GET['type']) : 'logo';
$type = $module;
$keyword = isset($_GET['keyword']) ? p8_addslashes(trim($_GET['keyword'])) : '';
$table = $this_module->table;

$select = select();
$select->from($table, '*');

//if(!$IS_FOUNDER)
/*
if($UID){
	$select->in('uid', $UID);
}else{
	$select->in('uid', 0);
	$select->in('ip', P8_IP);
}
*/
if($module == 'common'){
	$select->in('module', array('common','cms_common','sites_common'));
}else{
	$select->in('module', $module);
}
$select->order('id DESC');

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max(1, $page);

$page_url = $this_url .'?system='. $system .'&module='. $module;
$page_url .= '&type='.$type;
if($keyword){
	$select->like('filename', $keyword);
	$page_url .= '&keyword='.$keyword;
}

$page_url .= '&page=?page?';

$page_size = 10;
//echo $select->build_sql();
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
	$file = PHP168_PATH.'attachment/'.$item['path'];
	$imagesize = getimagesize($file);
	$list[$key]['imagewidth'] = $imagesize[0] ? $imagesize[0] : 0;
	$list[$key]['imageheight'] = $imagesize[1] ? $imagesize[1] : 0;;
}
$pages = list_page(array(
	'count' => $count,
	'page' => $page,
	'page_size' => $page_size,
	'url' => $page_url
));

$remote_attachment_urls = p8_json($core->CONFIG['attachment']['remote']['server']);

include template($this_module, 'store', 'default');
exit;