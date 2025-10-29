<?php
defined('PHP168_PATH') or die();

/**
* 预览广告
**/
$TITLE = '广告预览';
$id = 0;
$id = isset($_GET['id'])? intval($_GET['id']): 0;
foreach($URL_PARAMS as $k => $v){
	switch($v){
		case 'id':
			$id = isset($URL_PARAMS[$k +1]) ? intval($URL_PARAMS[$k +1]) : 0;
			break 2;
		break;
	}
}
$id or message('no_such_item');	
$data = $this_module->get($id, '');
include template($this_module, 'preview');