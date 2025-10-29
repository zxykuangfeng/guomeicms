<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	@set_time_limit(60);
	
	$MODEL = isset($_GET['model']) ? $_GET['model'] : '';
    $Item = $this_system->load_module('item');
    $item_controller = &$core->controller($Item);
    $_my_category_to_verify = $item_controller->get_acl('my_category_to_verify');
    $my_category_to_verify = p8_json($_my_category_to_verify);
	$models = $this_system->get_models();
	$verified = 0;
	$this_module->get_cache_recycle(false);
	$path = array();
	
	foreach($this_module->categories_recycle as $v){
		$parents = $this_module->get_parents($v['id']);
		foreach($parents as $vv){
			$path[$v['id']][] = $vv['id'];
		}
		$path[$v['id']][] = $v['id'];
	}	
	$json = array(
		'json' => p8_json($this_module->make_json_sort($this_module->top_categories_recycle)),
		'path' => p8_json($path),
		'models' => p8_json($models)
	);

	include template($this_module, 'recycle', 'admin');
	//print_r($this_module->top_categories_recycle);
}else if(REQUEST_METHOD == 'POST'){
	
	@set_time_limit(0);
	
	$action = @$_POST['action'];
	
	switch($action){	
		case 'cache_recycle':
			//更新缓存
			$this_module->cache_recycle();
		break;

		default:
			//批量修改栏目排序
			$display_order = isset($_POST['_display_order']) ? array_map('intval', (array)$_POST['_display_order']) : array();
			
			foreach($display_order as $id => $order){
				$id = intval($id);
				
				$DB_master->update(
					$this_module->table,
					array('display_order' => $order),
					"id = '$id'"
				);
			}
			
			$display_order && $this_module->cache_recycle();		
	}
	
	message('done');
	
}
