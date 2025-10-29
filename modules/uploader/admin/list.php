<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

$system = isset($_GET['system']) ? p8_addslashes($_GET['system']) : 'cms';
if($system != 'core' && !get_system($system)) message('no_such_system');
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max(1, $page);
$page_url = $this_url .'?system='. $system .'&module='. $module .'&page=?page?';

$module = isset($_GET['module']) ? $_GET['module'] : '';
$word = isset($_GET['word']) ? trim($_GET['word']) : '';
$ext = isset($_GET['ext']) ? trim($_GET['ext']) : '';
$key_type = isset($_GET['key_type']) ? trim($_GET['key_type']) : 'path';
$filename = $username = $path = '';
switch($key_type){
	case 'filename':
		$filename = $word;		
	break;
	case 'username':
		$username = $word;
	break;
	case 'path':
		$path = $word;
	break;	
}
$fetch = true;
$pages = '';


$systems = $core->systems;
$modules = get_modules($system);
$exts = array(
	'jpg','gif','png','zip','rar','swf',
	'rmvb','rm','avi','wmv','flv','docx','csv','xls',
	'mp3','txt','doc','ppt','xlsx','mp4',
);

$select = select();
if($system == 'core'){
	$table = $this_module->table;
}else{
	$sys_info = get_system($system);
	$table = $sys_info['table_prefix'] .'attachment';
}
$select->from($table .' AS a', 'a.*');
$select->inner_join($core->member_table .' AS m', 'm.username', 'm.id = a.uid');
$select->order('a.id DESC');
if($word){
	if($key_type == 'filename') $select->like('a.filename',$word);
	if($key_type == 'username') $select->in('m.username',$word);
	if($key_type == 'path') $select->like('a.path',$word);
	$page_url .= '&key_type='.$key_type.'&word='.$word;
}
if($ext){
	$select->in('a.ext',$ext);
	$page_url .= '&ext='.$ext;
}
if($module){
	$select->in('module', $module);
	$select->order('a.timestamp DESC');
}

$a_config = $core->CONFIG['attachment'];

//echo $select->build_sql();

$count = 0;
$list = $core->list_item(
	$select,
	array(
		'page' => &$page,
		'count' => &$count,
		'page_size' => 20
	)
);
foreach($list as $key=>$value){
	if($value['site']){
		$list[$key]['view_url'] = $value['module'] == 'item' && $value['item_id'] ? $core->url.'/s.php/'.$value['site'].'/item-view-id-'.$value['item_id'] : '';
	}else{
		$list[$key]['view_url'] = $value['module'] == 'item' && $value['item_id'] ? $sys_info['modules']['item']['controller'].'-view-id-'.$value['item_id'] : '';
	}
	$list[$key]['is_image'] = in_array($value['ext'],array('jpg','gif','png','jpeg')) ? 1 : 0;
	
	switch($value['ext']){
		case 'jpg':
		case 'gif':
		case 'png':
		case 'jpeg':
			$list[$key]['file_icons'] = 'fa-file-picture-o';
		break;
		case 'zip':
		case 'rar':
			$list[$key]['file_icons'] = 'fa-file-zip-o';
		break;
		case 'swf':
		case 'rmvb':
		case 'rm':
		case 'avi':
		case 'wmv':
		case 'flv':
		case 'mp3':
		case 'mp4':
			$list[$key]['file_icons'] = 'fa-file-zip-o';
		break;
		case 'docx':
		case 'doc':
			$list[$key]['file_icons'] = 'fa-file-word-o';
		break;
		case 'pdf':
			$list[$key]['file_icons'] = 'fa-file-pdf-o';
		break;
		case 'csv':
		case 'xls':
		case 'xlsx':
			$list[$key]['file_icons'] = 'fa-file-excel-o';
		break;
		case 'ppt':
		case 'pptx':
			$list[$key]['file_icons'] = 'fa-file-powerpoint-o';
		break;
		default:
			$list[$key]['file_icons'] = 'fa-file-archive-o';
	}
}

$pages = list_page(array(
	'count' => $count,
	'page' => $page,
	'page_size' => 20,
	'url' => $page_url
));

include template($this_module, 'list', 'admin');

