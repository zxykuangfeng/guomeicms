<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

load_language($this_system, 'admin');
//载入分类模块
$category = &$this_system->load_module('category');
$json = $category->get_json();
$action = isset($_GET['action']) ? $_GET['action'] : '';
$url = $this_router . '-' . $ACTION . '?page=?page?';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max(1, $page);

$select = select();
//$select->from($this_module->table .' AS M', 'M.*');
$select->from($core->TABLE_.'member AS M', 'M.username,M.name,M.role_id,M.id');
$select->left_join($this_module->table . ' AS E', 'E.verify,E.expert,E.star,E.item_count,E.solve_item_count,E.reply_count,E.fav_count,E.last_ask_time,E.last_reply_time', 'M.id=E.id');

//未审核用户
$select -> in('E.verify', 0);
$select -> order('M.id DESC');

$count = 0;
$list = $core -> list_item(
	$select,
	array(
		'page' => &$page,
		'count' => &$count,
		'page_size' => 20
	)
);

foreach($list as $k=>$v){
	if($list[$k]['expert']){
		$list[$k]['categories'] = $this_controller->get_expertor_category(array('id'=>$list[$k]['id']), false);
	}
}

$pages = list_page(array(
	'count' => $count,
	'page' => $page,
	'page_size' => 20,
	'url' => $url
));

include template($this_module, 'list', 'admin');

