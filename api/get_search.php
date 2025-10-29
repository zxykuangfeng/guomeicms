<?php
/**
* 获取主站栏目下列表信息。
* 返回list和count
**/
header('Content-type: application/json;charset=utf-8');
require_once dirname(__FILE__) .'/../inc/init.php';
defined('PHP168_PATH') or die();
$request = p8_stripslashes2($_POST + $_GET);
GetGP(array('site','cid','search_type','starttime','endtime','model','word','year','page','page_size','token'));
$data = array();
if(empty($token) || ($token && !hash_equals($token,$core->CONFIG['p8_api_token']))){
	exit(json_encode(array('status'	=> 200,'error' => $P8LANG['api_token_err'])));  
}
$keyword = html_entities($word);
if(empty($keyword)){
	$data['error'] = $P8LANG['no_such_cms_category'];
	exit(jsonencode($data));
}
$systems = $core->list_systems();
$allsites = array();
$site = isset($site) ? p8_stripslashes2(trim($site)) : '';
$search_type = isset($search_type) ? intval($search_type) : 0;
$starttime = isset($starttime) ? (trim($starttime)!='' ? strtotime(trim(starttime).' 0:0:0') : '') : '';
$endtime = isset($endtime) ? (trim($endtime)!='' ? strtotime(trim($endtime).' 23:59:59') : '') : '';
$model = isset($model) ? xss_clear($model) : '';
$is_sites = false;
if($site && isset($systems['sites']) && $systems['sites']['enabled']) {
    $sites = $core->load_system('sites');
    $allsites = $sites->get_sites();
	$is_sites = in_array($site,array_keys($allsites)) ? true : false;
}
$year = isset($_GET['year']) ? p8_stripslashes2(trim($_GET['year'])) : '';
if($year){
	$starttime = strtotime($year.'-1-1 0:0:0');
	$endtime = strtotime($year.'-12-31 23:59:59');
}
$cid = isset($cid) ? intval($cid) : 0;
$page = isset($page) ? intval($page) : 1;
$page = max($page, 1);
$count = 0;
$list = array();
$page_size = isset($page_size) ? intval($page_size) : 20;
$this_system = $is_sites ? $core->load_system('sites') : $core->load_system('cms');
$this_module = $this_system->load_module('item');
$category = &$this_system->load_module('category');
if($is_sites){
	$this_system->load_site($site);
	$category->get_cache(true,$site);
}else{
    $category->get_cache();
}
$select = select();
//有分类
if($cid){
	$cids = array($cid);
	if(isset($category->categories[$cid]['categories'])){
		$cids = $category->get_children_ids($cid) + $cids;
	}
	$select->in('i.cid', $cids);
}

if($model){
	$models = $this_system->get_models();
	$model = $model && isset($models[$model]) ? $model : '';
	if($model) $this_module->set_model($model);
}
$T = $model ? $this_module->table : $this_module->main_table;
$T = $search_type == 2 ? $this_module->main_table : $T;
$select->from($T . ' AS i', 'i.*');
if($is_sites) $select->in('i.site', $site);
switch($search_type){
	case '1':
		$select->search('i.title', $keyword);
	break;
	case '2':
		$this_system->init_model();
		if(empty($model)){
			$this_module->set_model('article');
		}
		$select->inner_join($this_module->addon_table .' AS a', 'a.*, a.iid AS id', 'i.id = a.iid');
		$select->search('a.content', $keyword,'(');
		$select->where_or();
		$select->search('i.title', $keyword,'',')');
	break;
	case '3':
		$select->search('i.author', $keyword);
	break;
	case '4':
		$select->in('i.username', $keyword);
	break;
	case '5':
		$select->search('i.source', $keyword);
	break;
	default:		
		$select->search('i.title', $keyword,'(');
		$select->where_or();
		$select->search('i.summary', $keyword,'',')');	
}
/*
* 如果有年份，按年份
*/
if($year){
	$select->where_and();
	$fromtime = $year ? strtotime($year.'-1-1 0:0:0') : 0;
	$totime = $year ? strtotime($year.'-12-31 23:59:59') : 0;
	$select->range('i.timestamp', $fromtime, $totime);
}else{
	if($starttime || $endtime){
		$select->where_and();
		$starttime_r = $starttime == '' ? 0 : $starttime;
		$endtime_r = $endtime == '' ? 0 : $endtime;
		$select->range('i.timestamp', $starttime_r, $endtime_r);
	}
}
//取数据
$count = 0;
$select->order('i.timestamp DESC');
$list = $core->list_item(
    $select,
    array(
        'page' => &$page,
        'count' => &$count,
        'page_size' => $page_size
    )
);
echo $select->build_sql();

//处理URL
foreach($list as $k => $v){
    $v['#category'] = $category->categories[$v['cid']];
    $list[$k]['url'] = $is_sites ? $this_system->site_p8_url($this_module, $v, 'view') : p8_url($this_module, $v, 'view');
	$list[$k]['frame'] = attachment_url($v['frame']);
    $list[$k]['summary'] = html_entity_decode($v['summary']);
    $list[$k]['summary'] = preg_replace('/(amp;)+/','', $list[$k]['summary']);
	$list[$k]['summary'] = str_replace($keyword,'<font color="red">'.$keyword.'</font>',$list[$k]['summary']);
	$list[$k]['title'] = str_replace($keyword,'<font color="red">'.$keyword.'</font>',$v['title']);	
    //分类名称
    $list[$k]['category_name'] = $v['#category']['name'];
    //分类地址
    $list[$k]['category_url'] = $v['#category']['url'];
}
$data['list'] = $list;
$data['count'] = $count;
exit(jsonencode($data));