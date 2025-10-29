<?php
defined('PHP168_PATH') or die();

/**
* 添加标签
**/

if(REQUEST_METHOD == 'GET'){
	
	$data = array();
	$system = isset($_GET['system']) ? $_GET['system'] : '';
	$module = isset($_GET['module']) ? $_GET['module'] : '';
	$site = isset($_GET['site']) && $_GET['site'] ? $_GET['site'] : $this_system->SITE;
		
	$data = array(
		'system' => $system ? $system : 'core',
		'module' => $module,
        'site' =>  $site,
		'type' => 'module_data',
		'postfix' => isset($_GET['postfix']) ? $_GET['postfix'] : ''
	);
	//为了重设标签
	$data['id']=$id = isset($_GET['id'])? $_GET['id']:'';
	$name = isset($_GET['name']) ? $_GET['name'] : '';
	if(!empty($id) && !empty($name)){$data['name']=$name;}
	
	$systems = &$core->systems;
	
	if(isset($this_model)){
		$field_json = jsonencode($this_model['fields']);
	}
	$option['order_by'] = array(
		'i.level' => true,
		'i.timestamp' => true,
	);
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
	$form = '<form action="'.$this_system->admin_controller.'-index_to_html" method="post" id="'. $this_system->SITE .'" target="'. $this_system->SITE .'">'.
		'<input type="hidden" name="'.$this_system->SITE.'">'.
		'<input type="hidden" name="site" value="'.$this_system->SITE.'">'.
		'</form>'.
		'<iframe style="display: none;" name="'. $this_system->SITE .'"></iframe>'.
		'<script type="text/javascript">document.getElementById("'. $this_system->SITE .'").submit();</script>';
	
	message(
		array(
			array($P8LANG['gotoview'].$form, str_replace('?','',str_replace('&','',str_replace('edit_label=1','',$HTTP_REFERER)))),
			array('gotoedit', $this_router.'-label?action=update&id='. $id),
			array('gotolabel', $HTTP_REFERER)
		)
	);
}
