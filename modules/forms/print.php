<?php
defined('PHP168_PATH') or die();

/**
* 打印入口文件
**/
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
$id or message('no_such_item');
if(isset($id)){
	$data = $this_module->get_data($id);
	$data or message('no_such_item');

	$mid = $data['mid'];
	$this_module->set_model($mid) or message('no_such_model');	
	if(!$IS_ADMIN && $data['uid'] != $UID){
		message('no_model_privilege');
	}	
	// 允许IP地址,超管和自己不限制
	if(!$IS_ADMIN && $data['uid'] != $UID && $this_model['CONFIG']['allow_ip']['enabled']){
		$this_controller->allow_ip($this_model['CONFIG']);
	}	
}

if(REQUEST_METHOD == 'GET'){		
	$SEO_KEYWORDS = $SEO_DESCRIPTION = '';
	$TITLE = $this_model['alias'];	
	
	$data = $this_module->get_data($id,$this_model['name']);
	$data or message('no_such_item');
	$this_module->format_data($data);
	$this_module->format_view($data);
	$data['config'] = mb_unserialize($data['config']);
	
	if(!empty($data['config']['manager'])){
		$uids = implode(",",$data['config']['manager']);
		$managers = $core->DB_master->fetch_all("SELECT id,username,name,email FROM {$core->TABLE_}member WHERE id IN ($uids)");
	}
	$status = $this_module->CONFIG['status'];
	//模型自定义脚本
	include $this_model['path'] .'view.php';
	$status_json = p8_json($this_module->CONFIG['status']);
	//针对显示select
	$unprint = array();
	foreach($this_model['fields'] as $p8_field => $p8_v){
		if(in_array($p8_v['widget'],array('select','checkbox','multi_select','radio'))){
			foreach($p8_v['data'] as $p8_value => $p8_key){
				if(is_array($p8_key)) $this_model['fields'][$p8_field]['data'][$p8_value] = $p8_key[0];
			}
		}
		//删除不显示的字段
		if(isset($p8_v['CONFIG']['print']) && empty($p8_v['CONFIG']['print'])){
			unset($this_model['fields'][$p8_field]);
			$unprint[] = $p8_field;
		}
	}
	$template = empty($this_model['CONFIG']['print_template'])? 'print' : 'tpl/'.$this_model['CONFIG']['print_template'];
	include template($this_module, $template);
}
