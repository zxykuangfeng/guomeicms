<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$HTTP_REFERER = urlencode($HTTP_REFERER);
	$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	
	//没有ID跳转到添加页面,用于在页面上双击添加的时候
	if(empty($id)){
		parse_str($_SERVER['QUERY_STRING'], $queryString);
		$QUERY_STRING = '';
		$div = '';
		foreach($queryString as $key => $val){
			if(empty($val) || $key == '_referer') {
				continue;
			}
			switch($key){
				case 'system':
					$val = p8_addslashes(xss_clear($val));
					if($val && $val != 'core' && !get_system($val)){
						message('no_such_system');
					}					
				break;
				case 'module':
					$val = p8_addslashes(xss_clear($val));
					if($val && !get_module($queryString['system'], $val)){
						message('no_such_module');
					}										
				break;
				case 'name':
					$val = p8_addslashes($val);
					//JS传进来的是用encodeURIComponent编码过,UTF-8的
					empty($queryString['from_js']) || $val = from_utf8($val);														
				break;
				case 'from_js':
					$val = empty($val) ? 0 : 1;																			
				break;
				case 'place_holder_width':
					$val = intval($val) >= 300 ? 300 : intval($val);
					$val = $val <= 60 ? 60 : $val;
				break;
				case 'place_holder_height':
					$val = intval($val) >= 100 ? 100 : intval($val);
					$val = $val <= 30 ? 30 : $val;
				break;
				default:
					$val = p8_addslashes(xss_clear($val));
			}
			$QUERY_STRING .= $div.$key.'='.$val;
			$div = '&';
		}
		header('Location: '. $this_router .'-add?'. $QUERY_STRING .'&_referer='. $HTTP_REFERER);
		exit;
	}
	
	$place_holder_width = isset($_GET['place_holder_width']) ? intval($_GET['place_holder_width']) : 100;
	$place_holder_height = isset($_GET['place_holder_height']) ? intval($_GET['place_holder_height']) : 30;
	$place_holder_width = $place_holder_width >= 300 ? 300 : $place_holder_width;
	$place_holder_width = $place_holder_width <= 60 ? 60 : $place_holder_width;
	$place_holder_height = $place_holder_height >= 100 ? 100 : $place_holder_height;
	$place_holder_height = $place_holder_height <= 30 ? 30 : $place_holder_height;
	$system = $module = '';

	$data = $this_module->view($id);
	$data or message('no_such_item');
	$allsites = array();
	if($data['site']){
		$allsites  = $core->load_system('sites')->get_sites();
	}
	$data['site'] = isset($_GET['site']) ? xss_clear($_GET['site']) : $data['site'];
	
	//$this_controller->check_scope($system, $module, $postfix) or message('no_label_scope_privilege');

	$option = &$data['option'];
	if(!empty($option['tplcode'])) $option['tplcode'] = p8_stripslashes2($option['tplcode']);
	
	$systems = &$core->systems;
	
	switch($data['type']){
	
	case 'html':
		include template($this_module, 'type_html', 'admin');
	break;
	
	case 'sql':
		include template($this_module, 'type_sql', 'admin');
	break;
	
	case 'slide'://幻灯片
		include template($this_module, 'type_slide', 'admin');
	break;
	
	case 'quicklink'://链接
		include template($this_module, 'type_quicklink', 'admin');
	break;
	
	case 'flash'://flash
		include template($this_module, 'type_flash', 'admin');
	break;
	
	case 'image'://图片
		include template($this_module, 'type_image', 'admin');
	break;
	
	case 'module_data':
		if($data['source_system'] == 'core'){
			$file = PHP168_PATH .'modules/'. $data['source_module'] .'/admin/label.php';
		}else{
			$file = PHP168_PATH . $data['source_system'] .'/modules/'. $data['source_module'] .'/admin/label.php';
		}
		
		if(!is_file($file)){
			//更换设置
			header('Location: '. $this_router .'-add?'. $_SERVER['QUERY_STRING']);
			exit;
		}
		
		//跳转到模块目录下的admin/label.php
		header('Location: '. $core->admin_controller .'/'. $data['source_system'] .'/'. $data['source_module'] .'-label?'.
			'action=update&id='. $data['id'] .
			'&place_holder_width='. $place_holder_width .'&place_holder_height='. $place_holder_height .
			'&_referer='. $HTTP_REFERER
		);
		exit;
	break;
	
	}
	
}else if(REQUEST_METHOD == 'POST'){
	
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$id or message('no_such_item');
	
	$this_controller->update($id, $_POST);

	message(
		array(
			array('gotoview', str_replace('edit_label=1', '', $HTTP_REFERER)),
			array('gotoedit', $this_router .'-update?id='. $id),
			array('gotolabel', $HTTP_REFERER)
		)
	);
}

