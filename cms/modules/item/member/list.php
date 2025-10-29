<?php
defined('PHP168_PATH') or die();

$this_controller->check_action($ACTION) or message('no_privilege');

$class[0] = 'class="over"';
if(REQUEST_METHOD == 'GET'){
	
	@set_time_limit(60);
	$MODEL = isset($_GET['model']) ? $_GET['model'] : '';
	
	$Item = $this_system->load_module('item');	
	$item_controller = $core->controller($Item);
	$_my_addible_category = $item_controller->get_acl('my_addible_category');
	$my_addible_category = $IS_FOUNDER ? "[1]" : p8_json($_my_addible_category);
	
	$models = $this_system->get_models();
	$Category = $this_system->load_module('category');
	load_language($Category,'global');
	$Category->get_cache(false);
	$path = array();		

	foreach($Category->categories as $v){
		$parents = $Category->get_parents($v['id']);
			
		foreach($parents as $vv){
			$path[$v['id']][] = $vv['id'];
		}
		$path[$v['id']][] = $v['id'];
	}

	$json = array(
		'json' => p8_json($Category->make_json_sort($Category->top_categories)),
		'path' => p8_json($path),
		'models' => p8_json($models)
	);

	include template($this_module, 'list');
}
