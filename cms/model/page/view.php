<?php
defined('PHP168_PATH') or die();

/**
* 查看内容
* @language [cms/item/global.php]
**/

//页面缓存参数
$PAGE_CACHE_PARAM['ttl'] = empty($this_module->CONFIG['view_page_cache_ttl']) ? 0 : $this_module->CONFIG['view_page_cache_ttl'];
page_cache($PAGE_CACHE_PARAM);


//读取数据
if($verified){
	//己审核
	if(defined('P8_GENERATE_HTML') && !empty($HTML_DATA)){
		$data = &$HTML_DATA;
	}else{
		$data = array_merge($DB_slave->fetch_one($SQL), $data);
	}
}else{
	//未审核的数据
	
	$_data = mb_unserialize($data['data']);
	$data = array_merge($_data['addon'], $_data['item'], $_data['main']);
	unset($_data);
}

//格式化数据
$this_module->format_data($data);

$category = &$this_system->load_module('category');

//最后才加载数据较大的分类数据
$category->get_cache();

//子分类
$subcategories = array();
if(isset($category->categories[$cid]['categories'])){
	$subcategories = $category->categories[$cid]['categories'];
	$CATEGORY = $category->get_children_ids($cid) + array($cid);
}else{
	$CATEGORY = $cid;
}


//顶级分类
$root_cate = $cid;
$parent_cats = $category->get_parents($cid);
if($parent_cats){
	$root_cate = $parent_cats[0]['id'];
	$root_cates = $category->categories[$parent_cats[0]['id']]['categories'];
}else{
	$root_cates = $subcategories;
}

