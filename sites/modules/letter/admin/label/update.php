<?php
defined('PHP168_PATH') or die();

/**
* 修改标签
**/

if(REQUEST_METHOD == 'GET'){
	
	$system = isset($_GET['system']) ? $_GET['system'] : '';
	$module = isset($_GET['module']) ? $_GET['module'] : '';
	$site = isset($_GET['site']) ? $_GET['site'] : '';
	$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	$id or message('no_such_item');
	
	$data = $LABEL->view($id);
    $data['site'] = $data['site']?$data['site']:$site;
	$data or message('no_such_item');
	
	$option = &$data['option'];
	if(!empty($option['tplcode']))$option['tplcode']=stripcslashes($option['tplcode']);
	
	$systems = &$core->systems;
	
	$type = $this_module->get_category('type');
    $department = $this_module->get_category('department');
	
	//print_r($option);
	include template($this_module, 'label', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$id or message('no_such_item');
	
	//验证数据
	require $this_module->path .'admin/label/valid_data.php';

	$_POST['option'] = $option;		//选项
	
	$controller->update($id, $_POST);
	
	message(
		array(
			array('gotoview', str_replace('?','',str_replace('&','',str_replace('edit_label=1','',$HTTP_REFERER)))),
			array('gotoedit', $this_router.'-label?action=update&id='. $id),
			array('gotolabel', $HTTP_REFERER)
		)
	);
}
