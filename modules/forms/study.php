<?php
defined('PHP168_PATH') or die();

/**
* 查看内容入口文件
**/

//$this_controller->check_action($ACTION) or message('no_privilege');
$id = 0;
$id = isset($_GET['id'])? intval($_GET['id']): 0;
foreach($URL_PARAMS as $k => $v){
	switch($v){
		case 'id':
			$id = isset($URL_PARAMS[$k +1]) ? intval($URL_PARAMS[$k +1]) : 0;
			$PAGE_CACHE_PARAM['id'] = $id;
			break 2;
		break;
	}
}
$data = $this_module->get_data($id);
$data or exit("[]");
$mid = $data['mid'];
$this_module->set_model($mid);	
$data = $this_module->get_data($id,$this_model['name']);
$data orexit("[]");
$this_module->format_data($data);
$this_module->format_view($data);

$status = $this_module->CONFIG['status'];
//模型自定义脚本
include $this_model['path'] .'view.php';
exit(jsonencode($data));