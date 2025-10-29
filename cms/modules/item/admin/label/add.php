<?php
defined('PHP168_PATH') or die();

/**
* 添加标签
**/

if(REQUEST_METHOD == 'GET'){
	
	$data = array();
	$system = isset($_GET['system']) ? $_GET['system'] : '';
	$module = isset($_GET['module']) ? $_GET['module'] : '';
	$site = isset($_GET['site']) ? $_GET['site'] : '';
	$env = isset($_GET['env']) ? $_GET['env'] : '';

    $authority_enable = $this_module->CONFIG['authority'];
    if($authority_enable) $core->get_cache('role');
    $option['authority'] = array();
	$option['order_by'] = array(
		'i.level' => true,
		'i.timestamp' => true,
	);
    $data = array(
		'system' => $system ? $system : 'core',
		'module' => $module,
		'type' => 'module_data',
		'env' => $env,
		'site' => $site,
		'postfix' => isset($_GET['postfix']) ? $_GET['postfix'] : ''
	);

	//为了重设标签
	$data['id']=$id = isset($_GET['id'])? $_GET['id']:'';
	$data['system'] = !empty($data['site']) ? 'sites' : $data['system'];
	$name = isset($_GET['name']) ? $_GET['name'] : '';
	if(!empty($id) && !empty($name)){$data['name']=$name;}
	
	$systems = &$core->systems;
	
	if(isset($this_model)){
		$field_json = jsonencode($this_model['fields']);
	}

	include template($this_module, 'label', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$name = isset($_POST['name']) ? $_POST['name'] : '';
	
	//验证数据
	require $this_module->path .'admin/label/valid_data.php';
	
	if(!empty($_POST['id'])){
		$id = $_POST['id'];
		$controller->update($_POST['id'], $_POST) or message('fail');
	}else{
		$id = $controller->add($_POST) or message('fail');
	}
	//静态首页
	$form = '<form action="'.$this_system->admin_controller.'-index_to_html" method="post" id="__reflash_index__" target="__reflash_index__">'.
			'<input type="hidden" name="type" value="index_to_html" /></form>'.
			'<iframe style="display: none;" name="__reflash_index__"></iframe>'.
			'<script type="text/javascript">$("#__reflash_index__").submit();</script>';
	message(
		array(
			array($P8LANG['gotoview'].$form, str_replace('?','',str_replace('&','',str_replace('edit_label=1','',$HTTP_REFERER)))),
			array('gotoedit', $this_router.'-label?action=update&id='. $id),
			array('gotolabel', $HTTP_REFERER)
		)
	);
}
