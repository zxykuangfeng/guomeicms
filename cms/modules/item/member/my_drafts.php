<?php
defined('PHP168_PATH') or die();

/**
* 内容管理
**/

$MODEL = '';
$sphinx['index'] = $this_system->sphinx_indexes();
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max($page, 1);
//加载分类模块
$category = &$this_system->load_module('category');
$category->get_cache();
$T = $this_module->unverified_table;
if(!P8_AJAX_REQUEST){	
	//所有模型
	$models = $this_system->get_models();
	//模型JSON
	$model_json = p8_json($models);
	//分类JSON
	$category_json = $category->get_json();	
	include template($this_module, 'my_drafts');
	exit;
}
$page_url = $this_url .'?';
$page_url = 'javascript:request_item(?page?)';
$select = select();
$u_fields = 'i.id, i.cid, i.model, i.uid, i.title,i.username, i.`timestamp`, i.pages, i.verified, i.verifier';
$select->from($T .' AS i', $u_fields);
$select->in('i.uid', $UID);
$select->in('i.verified', 77);		
$select->order('i.id desc');	
$select->left_join($this_system->category_table .' AS c', 'c.name AS category_name', 'c.id = i.cid');
$page_size = 7;
$count = 0;
//取数据
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
//echo $select->build_sql();exit;
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