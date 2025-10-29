<?php
defined('PHP168_PATH') or die();

/**
* 内容管理
**/

$this_system->check_manager($ACTION) or message('no_privilege');

$allsites  = $this_system->get_sites();

$sphinx = $this_module->CONFIG['sphinx'];
$use_sphinx = false;

if(!empty($_REQUEST['model'])){
	$this_system->init_model();
	$sphinx['index'] = $this_system->sphinx_indexes(array($MODEL => 1));
	
	$this_model or message('no_such_sites_model');
}else{
	$MODEL = '';
	$sphinx['index'] = $this_system->sphinx_indexes();
}

//加载分类模块
$category = &$this_system->load_module('category');
$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
$this_site_name = $this_system->SITE;
$minquery = $core->DB_master->fetch_one("SELECT `create_time` FROM $this_system->item_table where `site` = '$this_site_name' and `create_time` !=0 order by `create_time` asc limit 0,1");
$maxquery = $core->DB_master->fetch_one("SELECT `create_time` FROM $this_system->item_table where `site` = '$this_site_name' and `create_time` !=0 order by `create_time` desc limit 0,1");
$first_year = date('Y',$minquery['create_time']);
$this_year = date('Y',$maxquery['create_time']);
$this_mon = intval(date('m',$maxquery['create_time']));
$act = isset($_GET['act'])? $_GET['act'] : 'list';
$mon = isset($_GET['mon']) ? intval($_GET['mon']) : $this_mon>=2 ? $this_mon-1 : 12;
$mindate = isset($_GET['mindate']) ? $_GET['mindate'] : date('Y-m-d',strtotime("-1 years 1 day",$maxquery['create_time']));
$maxdate = isset($_GET['maxdate']) ? $_GET['maxdate'].' 23:59:59' : date('Y-m-d',$maxquery['create_time']);
$compare_type = isset($_GET['compare_type']) ? $_GET['compare_type'] : 'post_year';
$compare_type_name = array(
	'post_year'=> $P8LANG['compare_type_1'],
	'post_quarter'=> $P8LANG['compare_type_2'],
	'post_month'=> $P8LANG['compare_type_3'],
	'post_week'=> $P8LANG['compare_type_4'],	
);

if(!P8_AJAX_REQUEST && $act == 'list'){
	
	//所有模型
	$models = $this_system->get_models();
	//模型JSON
	$model_json = p8_json($models);
	//分类JSON
	$category_json = $category->get_json();
	//属性JSON
	$maxdate = date("Y-m-d",strtotime($maxdate));    
	include template($this_module, 'report', 'admin');
	exit;
}
$category->get_cache();
$ids = array();
if($cid){
	$ids = array($cid) + $category->get_children_ids($cid);	
}else{
	$top_categories = $category->top_categories;
	$ids = array_keys($top_categories);
}
//取每个分类的发布数量
$list = array();
foreach($ids as $each_cid){
	//SELECT count(*) count FROM `p8_cms_item`  WHERE cid IN ('1','707','1332','230','1072','1353')  AND 
	//timestamp >= '1492531200'  AND timestamp <= '1597161600'
	$sql = "SELECT count(*) count FROM $this_module->main_table where `site` = '$this_site_name'";
	$each_cids = array($each_cid) + $category->get_children_ids($each_cid);	
	$where = ' AND cid in ('.implode(',',$each_cids).')';	
	
	if($mindate){
		$where .= ' AND timestamp >= '.strtotime($mindate);		
	}
	if($maxdate){
		$where .= ' AND timestamp <= '.strtotime($maxdate);
	}
	if($MODEL){
		$where .= " AND model = '$MODEL'";		
	}
	$query = $core->DB_master->fetch_one($sql.$where);
	$list[] = array(
		'cid'	=>$each_cid,
		'count'	=>$query['count'],
	);
	
}
$maxdate = date("Y-m-d",strtotime($maxdate));
/*标准量*/
$category_list = array();
foreach($category->categories as $cat_item){	
	$category_list[$cat_item['id']] = array(
		'id' => $cat_item['id'],
		'name' => $cat_item['name'],
		'post_year'=> isset($cat_item['post_year']) && !empty($cat_item['post_year']) ? intval($cat_item['post_year']) : 0,
		'post_quarter'=> isset($cat_item['post_quarter']) && !empty($cat_item['post_quarter']) ? intval($cat_item['post_quarter']) : 0,
		'post_month'=> isset($cat_item['post_month']) && !empty($cat_item['post_month']) ? intval($cat_item['post_month']) : 0,
		'post_week'=> isset($cat_item['post_week']) && !empty($cat_item['post_week']) ? intval($cat_item['post_week']) : 0,
	);		
}

/*取数据*/
$category_title = $category_data = array();
$post_year = $post_quarter = $post_month = $post_week = array();
$data[0] = array($P8LANG['title'],$P8LANG['count'],$P8LANG['compare_type_1'],$P8LANG['compare_type_2'],$P8LANG['compare_type_3'],$P8LANG['compare_type_4']);
foreach($list as $item){
	$key = $key+1;
	$category_title[] = $data[$key]['title'] = $category_list[$item['cid']]['name'];
	$category_data[] = $data[$key]['count'] = $item['count'] ? intval($item['count']) : 0;
	$post_year[] = $data[$key]['post_year'] = isset($category_list[$item['cid']]['post_year']) ? intval($category_list[$item['cid']]['post_year']) : 0;
	$post_quarter[] = $data[$key]['post_quarter'] = isset($category_list[$item['cid']]['post_quarter']) ? intval($category_list[$item['cid']]['post_quarter']) : 0;
	$post_month[] = $data[$key]['post_month'] = isset($category_list[$item['cid']]['post_month']) ? intval($category_list[$item['cid']]['post_month']) : 0;
	$post_week[] = $data[$key]['post_week'] = isset($category_list[$item['cid']]['post_week']) ? intval($category_list[$item['cid']]['post_week']) : 0;
}

$category_post = array(
	'compare_type' => $compare_type,
	'compare_type_name' => !empty($compare_type) ? $compare_type_name[$compare_type] : '',
	'compare_data' => !empty($compare_type) ? $$compare_type : array(),
	'category_title' => $category_title,
	'category_data' => $category_data,
);
if($act == 'download'){
	$sitename_alias = $allsites[$this_site_name]['sitename'];	
	$headertext=array("$sitename_alias 发布统计报告($mindate 至 $maxdate)");
	require PHP168_PATH.'/inc/excel.class.php';
	$export=new excel(1);
	$export->setFileName('report','download',date('Y-m-d-h-i-s', P8_TIME));
	$export->fileHeader($headertext,6);	
	$export->fileData($data);
	$export->fileFooter();
	$export->exportFile();
	exit;
}else{
	exit(p8_json($category_post));	
}