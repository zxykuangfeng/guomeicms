<?php
defined('PHP168_PATH') or die();

$this_system = $core->load_system('sites');
$this_module = &$this_system->load_module('item');

$sphinx = $this_module->CONFIG['sphinx'];
$use_sphinx = false;
$allitem = isset($_GET['allitem']) ? trim($_GET['allitem']) : '';
if(!empty($allitem) && empty($_REQUEST['model'])){
	$models = $this_system->get_models(true);
	$models_alias = array();
	foreach($models as $alias=>$model_each){
		if($model_each['enabled']) $models_alias[] = $alias;
	}
	$_REQUEST['model'] = isset($models['article']) && $models['article']['enabled'] ? 'article': $models_alias[0];
	$this_system->init_model();
	$sphinx['index'] = $this_system->sphinx_indexes(array($MODEL => 1));
	$this_model or message('no_such_sites_model');
}

$sphinx['index'] = $this_system->sphinx_indexes();

//加载分类模块
$category = &$this_system->load_module('category');

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max($page, 1);
$desc = empty($_GET['order']) ? ' DESC' : ' ASC';
$keyword = isset($_GET['keyword']) ? p8_stripslashes2(trim($_GET['keyword'])) : '';
$keyword = $keyword ? $keyword : (isset($_GET['word']) ? p8_stripslashes2(trim($_GET['word'])) : '');
$select_site = isset($_GET['site']) ? trim($_GET['site']) : '';
$username = isset($_GET['username']) ? trim($_GET['username']) : '';
$id = isset($_GET['id']) ? filter_int(explode(',', $_GET['id'])) : '';
$category->get_cache();

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
		$attributes[$aid] = $this_module->CONFIG['attributes'][$aid] ? $this_module->CONFIG['attributes'][$aid] : $P8LANG['cms_item']['attribute'][$aid];
	}
	$attr_json = p8_json($attributes);	
	$allsites  = $this_system->get_sites();	
	load_language($core, 'global');
	include template($this_module, 'sites');
	exit;
}else{
	//JS传过来的关键字,UTF-8的
	$keyword = from_utf8($keyword);
}


$page_url = $this_url .'?';
$page_url = 'javascript:request_item(?page?)';

$select = select();
if($select_site) $select->in('i.site', $select_site);
$fields = 'i.id,i.site, i.model, i.title, i.title_color, i.title_bold, i.cid, i.url, i.uid, i.username, i.attributes, i.pages, i.views, i.level,i.score,i.comments, i.verified, i.timestamp, i.list_order';


if($MODEL){
	$select->from($this_module->table .' AS i', $fields);
}else{
	$select->from($this_module->main_table .' AS i', $fields);
}

$select->order('i.id'. $desc);

if($verified != 1){
	$select->order('i.id'. $desc);
}

$select->left_join($this_system->category_table .' AS c', 'c.name AS category_name', 'c.id = i.cid');
$select->left_join($this_system->site_table .' AS s', 's.sitename AS sitename', 'i.site = s.alias');

if(strlen($keyword)){
	$use_sphinx = $verified == 1 ? true : false;
	$select->search('i.title', $keyword);
}
if(strlen($username)){
	$use_sphinx = $verified == 1 ? true : false;
	$select->search('i.username', $username);
}
if(strlen($allitem)){
	$use_sphinx = $verified == 1 ? true : false;
	$select->inner_join($this_module->addon_table .' AS a', 'a.*, a.iid AS id', 'i.id = a.iid');
	$select->search('a.content', $allitem,'(');
	$select->where_or();
	$select->search('i.title', $allitem,'',')');
}
if($select_site) $select->in('i.site', $select_site);
//echo $select->build_sql();
$page_size = 40;
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

foreach($list as $key => $row){	
	$list[$key]['url'] =  substr($row['url'],0,7)=='http://' ? $row['url'] : $core->STATIC_URL.'/s.php/'.$row['site'].'/item-view-id-'.$row['id'].'?verified=1';
}

//echo $select->build_sql();exit;
foreach($list as $key=>$item){
	$list[$key]['level'] = isset($P8LANG['sites_item']['level_rank'][$item['level']]) && $item['level']>240 ? $P8LANG['sites_item']['level_rank'][$item['level']] : $item['level'];
}
//var_dump($list);
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