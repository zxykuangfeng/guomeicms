<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
    $delete_model = $this_controller->check_admin_action('delete');
    $edit_model = $this_controller->check_admin_action('update');
    $add_model = $this_controller->check_admin_action('add');
    $field = $this_controller->check_admin_action('field');
    
	load_language($core, 'config');
	
	$select = select();
	$select->from($this_module->table, '*');
	$select->order('display_order DESC');
	$count = 0;
	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$page = max(1, $page);
	$page_size = 20;
	
	$list = $core->list_item(
		$select,
		array(
			'page_size' => 0,
			'ms' => 'master'
		)
	);
	
	$page_url = $this_url .'?page=?page?';
	
	$pages = list_page(array(
		'count' => $count,
		'page' => $page,
		'page_size' => $page_size,
		'url' => $page_url
	));
	
	include template($this_module, 'list', 'admin');

}else if(REQUEST_METHOD == 'POST'){
	
	//批量排序
	$display_order = isset($_POST['_display_order']) && is_array($_POST['_display_order']) ? array_map('intval', $_POST['_display_order']) : array();
	
	foreach($display_order as $id => $order){
		$DB_master->update(
			$this_module->table,
			array(
				'display_order' => $order
			),
			"id = '$id'"
		);
	}
	$models = $this_system->get_models();
	$model = isset($_POST['model']) ? xss_clear($_POST['model']) : '';
	if($model && !array_key_exists($model,$models)){
		exit('[]');
	}
	$this_module->cache($model);
	
	message('done');
	
}
