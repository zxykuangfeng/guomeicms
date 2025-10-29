<?php
defined('PHP168_PATH') or die();

/**
* 导入CMS模型
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');
$lists = array('GBK', 'UTF-8',);
if(REQUEST_METHOD == 'GET'){
	$importable_models = array();
	
	$dir = $this_module->path .'#export/';
	$handle = opendir($dir);
	while(($item = readdir($handle)) !== false){
		if($item == '.' || $item == '..' || !is_file($dir . $item .'/#data.php')) continue;
		$data = include $this_module->path .'#export/'. $item.'/#data.php';
		$item = str_replace(array("./","../",".\\","..\\","..","\\"),'',$item);
		$str = file_get_contents($this_module->path.'#export/'.$item.'/#data.php');
		foreach ($lists as $items) {
			$tmp = convert_encode($items,'UTF-8',$str);
			if (md5($tmp) == md5($str)) {
				if($items == 'GBK') $data = convert_encode('GBK','UTF-8',$data);
			}
		}
		$importable_models[$item] = array(
			'name' => $item,
			'alias' => $data['alias'],
		);
	}
	include template($this_module, 'import', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){	
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	$step = $_POST['step'];
	
	if($step == 1){
		$name = isset($_POST['name']) ? basename($_POST['name']) : '';
		is_dir($this_module->path .'#export/'. $name) or message('no_such_forms_model');
		$data = include $this_module->path .'#export/'. $name.'/#data.php';	
		$name = str_replace(array("./","../",".\\","..\\","..","\\"),'',$name);
		$str = file_get_contents($this_module->path.'#export/'.$name.'/#data.php');
		foreach ($lists as $item) {
			$tmp = convert_encode($item,'UTF-8',$str);
			if (md5($tmp) == md5($str)) {
				if($item == 'GBK') $data = convert_encode('GBK','UTF-8',$data);
			}
		}
		$select = select();
		$select -> from($this_module->model_table,'*');
		$select -> in('id',199,true);
		
		$list = $core->list_item($select,array());
		$models = array();
		foreach($list as $model){
			$models[] = $model['name'];
		}
		$name_err = in_array($name,$models) ? true : false;
		include template($this_module, 'import', 'admin');
	}else if($step == 2){
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
}
