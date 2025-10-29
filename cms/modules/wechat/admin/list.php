<?php
defined('PHP168_PATH') or die();

/**
* 内容管理
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

$use_sphinx = false;

if(!empty($_REQUEST['model'])){
	$this_system->init_model();
	
	$this_model or message('no_such_cms_model');
}else{
	$MODEL = '';	
}
$config = $core->get_config($this_system->name, $this_module->name);
if(!$config['appid']) message('wechat_config_need',$this_router.'-config',3);

//加载分类模块
$category = &$this_system->load_module('category');

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max($page, 1);
$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
$desc = empty($_GET['order']) ? ' DESC' : ' ASC';
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$keyword = $keyword ? $keyword : (isset($_GET['word']) ? trim($_GET['word']) : '');
$username = isset($_GET['username']) ? trim($_GET['username']) : '';
$verifier = isset($_GET['verifier']) ? trim($_GET['verifier']) : '';
$id = isset($_GET['id']) ? filter_int(explode(',', $_GET['id'])) : '';

$verified = 1;
$T = $this_module->main_table;

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
		$attributes[$aid] = $P8LANG['cms_item']['attribute'][$aid];
	}
	$attr_json = p8_json($attributes);
	
	$allow_update = $this_controller->check_admin_action('update');
	$allow_push = $this_controller->check_admin_action('push');	

	include template($this_module, 'list', 'admin');
	exit;
}else{
	//JS传过来的关键字,UTF-8的
	$keyword = from_utf8($keyword);
	$username = from_utf8($username);
	$verifier = from_utf8($verifier);
}


$page_url = $this_url .'?';
$page_url = 'javascript:request_item(?page?)';


$select = select();
$fields = 'i.id, i.model, i.title, i.title_color, i.title_bold, i.cid, i.url, i.uid, i.username, i.attributes, i.pages, i.views, i.level, i.comments, i.verified,i.verifier, i.timestamp, i.list_order';
$u_fields = 'i.id, i.cid, i.model, i.title, i.username, i.timestamp, i.push_back_reason, i.attributes, i.pages, i.verified, i.views, i.level, i.verifier, i.comments';

if($id){
	if($verified != 1) $fields = $u_fields;
	$select->from($T .' AS i', $fields);
	$select->in('i.id', $id);
	
}else{
	
	if($MODEL){
		$select->from($this_module->table .' AS i', $fields);
	}else{
		$select->from($this_module->main_table .' AS i', $fields);
	}
		
	if($cid){
		$category->get_cache();
		$ids = array($cid) + $category->get_children_ids($cid);
		
		$select->in('i.cid', $ids);
		$select->order('i.list_order'. $desc);
		
		$use_sphinx = $verified == 1 ? true : false;
	}else{
        //我能审核的栏目
        $my_cats = $this_controller->get_acl('my_category_to_verify');
        $all = isset($my_cats[0]); unset($my_cats[0]);
        if(!$all || !empty($my_cats) || !$IS_FOUNDER){
            $cids = array_keys((array)$my_cats);
            $select->in('i.cid', $cids);
        }
		$select->order('i.id'. $desc);
	}
	
	if($verified != 1){
		$select->order('i.id'. $desc);
	}

	
}
$select->left_join($this_system->category_table .' AS c', 'c.name AS category_name', 'c.id = i.cid');

if(strlen($keyword)){
	$use_sphinx = $verified == 1 ? true : false;
	$select->search('i.title', $keyword);
}
if(strlen($username)){
	$use_sphinx = $verified == 1 ? true : false;
	$select->search('i.username', $username);
}
if(strlen($verifier)){
	$use_sphinx = $verified == 1 ? true : false;
	$select->search('i.verifier', $verifier);
}
$select->in('i.model', 'article');
$select->where("i.frame != ''");
$page_size = 20;
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