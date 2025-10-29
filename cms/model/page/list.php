<?php
defined('PHP168_PATH') or die();

/**
* 查看分类
**/




//最后才加载数据较大的分类数据
$category->get_cache();

//子分类
$subcategories = $root_cates = $first = array();
if(isset($category->categories[$cid]['categories'])){
	$subcategories = $category->categories[$cid]['categories'];
	$CATEGORY = $category->get_children_ids($cid) + array($cid);
}else{
	$CATEGORY = $cid;
}


//顶级分类
$root_cate = $ciid = $cid;
$parent_cats = $category->get_parents($cid);
if($parent_cats){
	$root_cate = $parent_cats[0]['id'];
	$root_cates = $category->categories[$parent_cats[0]['id']]['categories'];
}elseif(!empty($subcategories)){
	$root_cates = $subcategories;
	$first = current($subcategories);
	$ciid = $first['id'];
}


$page_id = $this_module->get_page($ciid,$category->categories[$ciid]['model']);
if(!empty($page_id['id'])){
	$id = $page_id['id'];
	$data = $this_module->data('read', $id);
	$SQL = "SELECT i.*, a.*, i.timestamp AS timestamp, a.iid AS id FROM $this_module->table AS i
		INNER JOIN $this_module->addon_table AS a ON i.id = a.iid
		WHERE i.id = '$id' ORDER BY a.page ASC LIMIT 1";
	$data = array_merge($DB_slave->fetch_one($SQL), $data);
}

//格式化数据
$this_module->format_data($data);
//初始化标签



