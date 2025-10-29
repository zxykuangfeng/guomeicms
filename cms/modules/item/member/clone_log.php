<?php
defined('PHP168_PATH') or die();

/**
* 签发记录
**/

$this_controller->check_action('clone') or message('no_privilege');
if(REQUEST_METHOD == 'GET'){
	load_language($this_module,'global');
	$sphinx = $this_module->CONFIG['sphinx'];
	$use_sphinx = false;
	$key_word = isset($_GET['key_word']) ? trim($_GET['key_word']) : '';
	$keyword = $key_word;

	$sphinx['index'] = $this_system->sphinx_indexes();
	//加载分类模块
	$category = &$this_system->load_module('category');
	$MODEL = isset($_GET['model']) ? trim($_GET['model']) : '';
	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$page = max($page, 1);
	$desc = empty($_GET['order']) ? ' DESC' : ' ASC';
	$order_num = empty($_GET['order']) ? 0 : intval($_GET['order']);
	$username = isset($_GET['username']) ? trim($_GET['username']) : '';

	$category->get_cache();
	$verified = 1;
	if(!P8_AJAX_REQUEST){	
		
		//所有模型
		$models = $this_system->get_models();
		//模型JSON
		$model_json = p8_json($models);
		//分类JSON
		$category_json = $category->get_json();
		//属性JSON
		$attributes = array();
		foreach($this_module->attributes as $aid => $lang){
			$attributes[$aid] = $this_module->CONFIG['attributes'][$aid] ? $this_module->CONFIG['attributes'][$aid] : $P8LANG['cms_item']['attribute'][$aid];
		}
		$attr_json = p8_json($attributes);
		$allow_update = $this_controller->check_action('update');
		include template($this_module, 'clone_log');
		exit;
	}else{
		//JS传过来的关键字,UTF-8的
		$keyword = from_utf8($keyword);
		$username = from_utf8($username);
	}


	$page_url = $this_url .'?';
	$page_url = 'javascript:request_item(?page?)';

	$select = select();
	$select->from($this_module->clone_table .' AS i', 'i.*');
	$select->left_join($this_module->main_table .' AS m', 'm.*', 'm.id = i.to_id');
	$select->left_join($this_system->category_table .' AS c', 'c.name AS category_name', 'c.id = m.cid');
	$select->in('i.action_uid',$UID);
	if(strlen($keyword)){
		$use_sphinx = $verified == 1 ? true : false;
		$select->search('i.title', $keyword);
	}
	if(strlen($username)){
		$use_sphinx = $verified == 1 ? true : false;
		$select->search('i.username', $username);
	}
	if($MODEL){
		$select->in('m.model', $MODEL);
	}
	$select->order('i.clone_id'. $desc);
	$page_size = 20;
	$count = 0;
	$select->left_join($core->TABLE_.'member as t', 't.name,t.dept as department', 't.id=m.uid');
	//取数据
	//echo $select->build_sql();
	$list = $core->list_item(
		$select,
		array(
			'page' => &$page,
			'count' => &$count,
			'page_size' => $page_size,
			'ms' => 'master',
			'sphinx' => $use_sphinx && $sphinx['enabled'] ? $sphinx : null
		)
	);
	$mconfig = $core->get_config('core', 'member');
	$dept = array();
	foreach($mconfig['dept'] as $value){
		$dept[$value['code']] = $value['name'];
	}
	foreach($list as $key=>$item){
		$list[$key]['level'] = isset($P8LANG['cms_item']['level_rank'][$item['level']]) && $item['level']>240 ? $P8LANG['cms_item']['level_rank'][$item['level']] : $item['level'];
		if(!empty($list[$key]['source'])){
			$emp_source = explode('|',$list[$key]['source']);
			$list[$key]['source'] = $emp_source[0];
			$list[$key]['sourceurl'] = $emp_source[1];
		}
		$list[$key]['department'] = $item['department'] && $dept[$item['department']] ? $dept[$item['department']] : '';
	}
	echo p8_json(array(
		'list' => $list,
		'pages' => list_page(array(
			'count' => $count,
			'page' => $page,
			'page_size' => $page_size,
			'url' => $page_url
		)),
		'time' => get_timer() - $P8['start_time'],
		'sphinx' => $sphinx
	));

	exit;
}else if(REQUEST_METHOD == 'POST'){
	//过滤非数字
	$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
	$id or exit('[]');
	
	$num = $DB_master->delete($this_module->clone_table, "action_uid = ".$UID." and clone_id IN (".implode(',', $id).")");
	$ret = $num ? $id : array();
	exit(jsonencode($ret));
}