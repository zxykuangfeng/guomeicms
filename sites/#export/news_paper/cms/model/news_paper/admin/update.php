<?php
defined('PHP168_PATH') or die();

/**
* 更新内容
**/

if(REQUEST_METHOD == 'GET'){
	
/**
* your code
**/
	include template($this_module, 'edit', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$id or message('no_such_item');
	
	$verified = empty($_POST['verified']) ? false : true;
	$models = $this_system->get_models();
	$model = isset($_POST['model']) ? xss_clear($_POST['model']) : '';
	if($model && !array_key_exists($model,$models)){
		message('fail');
	}
	$this_controller->update($id, $_POST, $verified) or message('fail');
/**
* your code
**/
	message(
		array(
			array('cms_to_edit', $core->admin_controller .'/'. $SYSTEM .'/item-update?id='.$id.'&model='.$model),
			array('cms_to_list', $core->admin_controller .'/'. $SYSTEM .'/item-list?cid='.$_POST['cid'].'&model='.$model),
			array('cms_to_view', $this_module->controller .'-view-id-'.$id,'_blank'),
			array('cms_to_add', $core->admin_controller .'/'. $SYSTEM .'/item-add?cid='.$_POST['cid'].'&model='.$model)
		),
		$core->admin_controller .'/'. $SYSTEM .'/item-add?cid='.$_POST['cid'].'&model='.$model,
		10000
	);
}

