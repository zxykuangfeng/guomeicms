<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$page = max(1, $page);

	$page_url = $this_router .'-'. $ACTION .'?page=?page?';
	//我管理的表单
	$my_forms_manage = $this_controller->get_acl('my_forms_manage');
	$mids = $my_forms_manage ? array_keys($my_forms_manage) : array();
	$count = 0;
	$select = select();
	$select->from($this_module->model_table,'*');
	//$select -> in('id',199,true);
	if(!$IS_FOUNDER) $select->in('id',$mids);
	$select->order('display_order DESC, id DESC');
	
	$list = $core->list_item(
		$select,
		array(
			'page' => &$page,
			'count' => &$count,
			'page_size' => 20
		)
	);

	$pages = list_page(array(
		'count' => $count,
		'page' => $page,
		'page_size' => 20,
		'url' => $page_url
	));
	
	include template($this_module, 'model', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	$action = isset($_POST['action'])? $_POST['action'] : '';
	$id =  isset($_POST['id']) ? filter_int($_POST['id']) : array();
	if($action == 'cache'){
		$this_module->cache();
	}else if($action == 'htmlall'){
		if($this_module->CONFIG['htmlize']){
			//发布
			if($this_module->CONFIG['htmlize_post']) $this_module->html($id);
			//列表
			if($this_module->CONFIG['htmlize_list']) $this_module->html_list($id,true);
			//内容
			if($this_module->CONFIG['htmlize_view']) $this_module->html_view($id);
			$ret = array(
				'status' => 200
			);
		}else{
			$ret = array(
				'status' => 300
			);			
		}		
		exit(jsonencode($ret));
	}else if($action == 'htmlize_post'){		
		if($this_module->CONFIG['htmlize'] && $this_module->CONFIG['htmlize_post']){
			//发布
			$this_module->html($id);
			$ret = array(
				'status' => 200
			);
		}else{
			$ret = array(
				'status' => 300
			);			
		}		
		exit(jsonencode($ret));
	}else if($action == 'htmlize_list'){
		if($this_module->CONFIG['htmlize'] && $this_module->CONFIG['htmlize_list']){
			//列表
			$this_module->html_list($id,true);
			$ret = array(
				'status' => 200
			);
		}else{
			$ret = array(
				'status' => 300
			);			
		}		
		exit(jsonencode($ret));
	}else if($action == 'htmlize_view'){		
		if($this_module->CONFIG['htmlize'] && $this_module->CONFIG['htmlize_view']){
			//内容
			$this_module->html_view($id);
			$ret = array(
				'status' => 200
			);
		}else{
			$ret = array(
				'status' => 300
			);			
		}
		exit(jsonencode($ret));
	}else if($action == 'clean'){
		//if(!$IS_FOUNDER)message('no_privilege');
		
		$this_module->clean($id);
		
		message('done', HTTP_REFERER);exit;
		
	}else{
		//批量修改字段的排序
		$display_order = isset($_POST['_display_order']) && is_array($_POST['_display_order']) ? array_map('intval', $_POST['_display_order']) : array();		
		foreach($display_order as $id => $order){
			$id = intval($id);
			$order = intval($order);
			if(!is_numeric($id) || !is_numeric($order)) continue;				
			$DB_master->update(
				$this_module->model_table,
				array(
					'display_order' => $order
				),
				"id = '$id'"
			);
		}
	}
	
	message('done', $this_url);

}
