<?php
defined('PHP168_PATH') or die();

$this_system = $core->load_system('sites');
$this_module = &$this_system->load_module('item');

$sphinx = $this_module->CONFIG['sphinx'];
$use_sphinx = false;
$allitem = isset($_GET['allitem']) ? trim($_GET['allitem']) : '';
load_language($this_module, 'global');
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
$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
$mine = empty($_GET['mine']) ? 0 : 1;
$desc = empty($_GET['order']) ? ' DESC' : ' ASC';
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$keyword = $keyword ? $keyword : (isset($_GET['word']) ? trim($_GET['word']) : '');
$select_site = isset($_GET['site']) ? trim($_GET['site']) : '';
$username = isset($_GET['username']) ? trim($_GET['username']) : '';
$id = isset($_GET['id']) ? filter_int(explode(',', $_GET['id'])) : '';
$category->get_cache();
if(!empty($category->categories[$cid]) && $category->categories[$cid]['type']==4){
	$page_id = $this_module->get_page($cid,$category->categories[$cid]['model']);
	if($page_id){
		header('Location:'.$this_router.'-update?model='.$category->categories[$cid]['model'].'&id='.$page_id['id']);
	}else{
		header('Location:'.$this_router.'-add?model='.$category->categories[$cid]['model'].'&cid='.$cid);
	}
	exit;
}

if(isset($_GET['verified'])){
	$verified = intval($_GET['verified']);
	
	$T = $verified == 1 ? $this_module->main_table : $this_module->unverified_table;
	
}else{
	$verified = 1;
	$T = $this_module->main_table;	
}
if (!in_array($verified, [0,1,2,3,66,77,88,-99,-100])) {
	message('no_privilege');
}
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
		$attributes[$aid] = $P8LANG['sites_item']['attribute'][$aid];
	}
	$attr_json = p8_json($attributes);
	
	$clustered = $this_system->check_manager('cluster_push');
	$mysites = $this_system->get_manage_sites();
	$allsites  = $this_system->get_sites();
	$allow_score = $this_system->check_manager('score');
	$allow_update = $this_system->check_manager('update');
	$allow_delete = $this_system->check_manager('delete');
	$allow_download = $this_system->check_manager('download');
	$allow_verify = $this_system->check_manager('verify');
	$cms_system = $core->load_system('cms');
	$cms_item_config = $core->get_config('cms','item');
	$score_level = !empty($cms_item_config['score_level']) ? $cms_item_config['score_level'] : array();
	$level_num = array();
	for($i = 0; $i < 255; $i=$i+10){
	    $level_num[] = $i;
    }
    $this_site_name = $this_system->SITE;
	//var_dump($this_site_name);
	load_language($core, 'global');
	include template($this_system, 'main', 'admin');
	exit;
}else{
	//JS传过来的关键字,UTF-8的
	$keyword = from_utf8($keyword);
}


$page_url = $this_url .'?';
$page_url = 'javascript:request_item(?page?)';

$select = select();
$mysites = $this_system->get_manage_sites();

$fields = 'i.*';
$u_fields = 'i.id,i.site,i.cid, i.uid, i.model, i.title, i.source,i.username, i.timestamp, i.push_back_reason, i.attributes, i.pages, i.verified,i.verifier, i.views, i.level, i.comments';
if($verified == 1){
	$use_sphinx = true;
	$u_fields = $fields;
}
if($id){
	
	$select->from($T .' AS i', $u_fields);
	$select->in('i.id', $id);
	
}else{
	
	if($MODEL){
		$select->from($this_module->table .' AS i', $u_fields);
	}else{
		$select->from($T .' AS i', $u_fields);
	}
	switch($verified){
		case '-100':
			$select->in('i.verified', 88,true);
			break;
		case '3':
			$select->in('i.verified', array(0,2));
			break;
		default:
			$select->in('i.verified', $verified);
	}
	if($cid){
		$category->get_cache();
		$ids = array($cid) + $category->get_children_ids($cid);
		
		$select->in('i.cid', $ids);
		$select->order('i.list_order'. $desc);
		
		$use_sphinx = $verified == 1 ? true : false;
	}else{
		$select->order('i.id'. $desc);
	}
	
	if($verified != 1){
		$select->order('i.id'. $desc);
	}
	
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
if($select_site) {
	$select->in('i.site', $select_site);
}else{
	$select->in('i.site', $mysites);
}
$select->left_join($core->TABLE_.'member as m', 'm.name,m.dept as department', 'm.id=i.uid');
$mconfig = $core->get_config('core', 'member');
$dept = array();
foreach($mconfig['dept'] as $value){
	$dept[$value['code']] = $value['name'];
}
//echo $select->build_sql();exit;
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
	$list[$key]['url'] =  substr($row['url'],0,7)=='http://' ? $row['url'] : $core->STATIC_URL.'/s.php/'.$row['site'].'/item-view-id-'.$row['id'].'?verified='.($verified == 1 ? 1 : 0);
	$list[$key]['department'] = $row['department'] && $dept[$row['department']] ? $dept[$row['department']] : '';
	$list[$key]['verified_status'] = isset($P8LANG['sites_item']['status'][$row['verified']]) ? $P8LANG['sites_item']['status'][$row['verified']] : '';
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