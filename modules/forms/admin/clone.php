<?php
defined('PHP168_PATH') or die();

/**
* 克隆模型
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');
$lists = array('GBK', 'UTF-8',);
if(REQUEST_METHOD == 'GET'){
	//克隆前先导出
	$mid = isset($_GET['mid']) ? intval($_GET['mid']) : '';
	$this_module->set_model($mid,true) or message('fail');
	$this_module->export($mid) or message('fail');
	$clone_forms_info = $this_module->get_model($mid,true);	
	$data = include $this_module->path .'#export/'. $clone_forms_info['name'].'/#data.php';	
	$new_addon = strtolower(rand_str(4));
	$data['new_name'] = $data['name'].'_'.$new_addon;
	$data['new_alias'] = $data['alias'].'_'.$new_addon;
	$name_err = false;
	include template($this_module, 'clone', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){	
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	
	@set_time_limit(0);	
	$post['name'] = isset($_POST['name']) ? basename($_POST['name']) : '';
	$post['alias'] = isset($_POST['alias']) ? html_entities($_POST['alias']) : '';
	$post['template'] = isset($_POST['template']) ? $_POST['template'] : '';
	if(!$post['name'] || !$post['alias'])message('error');
	$oname = isset($_POST['oname']) ? basename($_POST['oname']) : '';
	is_dir($this_module->path .'#export/'. $oname) or message('no_such_forms_model');
	$this_module->import($post, $oname) or message('fail');	
	message('done',$this_router.'-model',3);	
}
