<?php
defined('PHP168_PATH') or die();

/**
* 列表模型入口文件
**/

$data = array();
$cid = $category;
if(empty($cid)){
	$data['error'] = $P8LANG['no_such_cms_category'];
	exit(jsonencode($data));
}

//加载分类模块并取得当前分类的缓存
$category = &$this_system->load_module('category');
$CAT = &$this_system->fetch_category($cid);
if(empty($CAT)){
	$data['error'] = $P8LANG['no_such_cms_category'];
	exit(jsonencode($data));
}
$CAT['page_size'] = $page_size ?: $CAT['page_size'];
//列表页强制显示所有内容
$CAT['list_all_model'] = 1;
$resource = $RESOURCE_VICE ? $RESOURCE_VICE : $RESOURCE;
/***大列表显示所有内容***/
if($CAT['list_all_model'] && $CAT['type'] == 1){
	//当前分类的内容数
	$count = $field_filter ? 0 : $CAT['item_count'];
	$_urltemp = $CAT['url'];
	$CAT['url']='';
	$CAT['is_category'] = true;
	$page_url = $this_system->site_p8_url($this_module, $CAT, 'list', false);
	$CAT['url'] = $_urltemp;
	$select = select();
	$select->from($this_module->main_table .' AS i', 'i.*');
	//最后才加载数据较大的分类数据
	$category->get_cache();
	//print_r($CAT);
	//父分类
	$parent_cats = $category->get_parents($cid);
	//子分类
	$subcategories = array();
	if(isset($category->categories[$cid]['categories'])){
		$subcategories = $category->categories[$cid]['categories'];
		$CATEGORY = $category->get_children_ids($cid) + array($cid);
	}else{
		$CATEGORY = $cid;
	}
	
	$select->in('i.cid', $CATEGORY);
	//echo $select->build_sql();
	
	$sphinx = $this_module->CONFIG['sphinx'];
	$sphinx['index'] = $this_system->sphinx_indexes(array($MODEL => 1));
	
	$orderby = empty($CAT['CONFIG']['orderby']) ? 'i.timestamp' : 'i.'.$CAT['CONFIG']['orderby'];	 
	$desc = empty($CAT['CONFIG']['orderby_desc']) ? ' DESC' : ' ASC';
	$orderby = $orderby == 'i.level' ? 'i.level'.$desc.',i.timestamp'.$desc : $orderby.$desc;
	switch($myorderby){
		case '1':
			$orderby = 'i.timestamp DESC';
		break;
		case '2':
			$orderby = 'i.list_order DESC';
		break;
		case '3':
			$orderby = 'i.views DESC';
		break;
		case '4':
			$orderby = 'i.comments DESC';
		break;
		case '5':
			$orderby = 'i.level DESC,i.timestamp DESC';
		break;
	}
	$select->order($orderby);
	//echo $select->build_sql();
	$list = $core->list_item(
		$select,
		array(
			'count' => &$count,
			'page' => &$page,
			'page_size' => $CAT['page_size'],
			'sphinx' => $sphinx
		)
	);
	
	foreach($list as $k => $v){
		$v['#category'] = &$category->categories[$v['cid']];
		$list[$k]['url'] = $this_system->site_p8_url($this_module, $v, 'view');
		if(strrpos($list[$k]['url'],"http://") === FALSE && strrpos($list[$k]['url'],"https://") === FALSE){
			$path = substr($resource, -1) != '/' ? $resource : substr($resource,0,-1);//去/
			$list[$k]['url'] = substr($list[$k]['url'],0,1) != '/' ? '/'.$list[$k]['url'] : $list[$k]['url'];//加/
			$list[$k]['url'] = $path.$list[$k]['url'];
		}
		$list[$k]['frame'] = attachment_url($v['frame'],false,true);
		$list[$k]['full_title'] = $v['title'];
		$list[$k]['title'] = $v['title'];
		$tmp = explode('|', $v['sub_title']);
		$list[$k]['sub_title'] = $tmp[0];
		$list[$k]['sub_title_url'] = isset($tmp[1]) ? $tmp[1] : '';
		
		//分类名称
		$list[$k]['category_name'] = $v['#category']['name'];
		//分类URL
		$list[$k]['category_url'] = $v['#category']['url'];
		
		if(!empty($v['title_color'])) $list[$k]['title'] = '<font color="'. $v['title_color'] .'">'. $list[$k]['title'] .'</font>';
		if(!empty($v['title_bold'])) $list[$k]['title'] = '<b>'. $list[$k]['title'] .'</b>';
	}
	
	// 获得内容图片数、内容字符数
	if($iids){
		$_REQUEST['model'] = $CAT['model'];
		$this_system->init_model();
		$SQL = "SELECT iid,content FROM $this_module->addon_table WHERE iid in(".implode(',',$iids).")";
		$query = $core->DB_master->query($SQL);
		$list_count = array();
		while($arr = $core->DB_master->fetch_array($query)){
			//获得内容图片数
			$attachs = array();
			preg_match_all('/(<img\s+?[^>]*?)(src)=[\'"]?([^\'"\s\>]+)[\'"]?/i',$arr['content'],$attachs);
			$list_count[$arr['iid']]['frame_count'] = isset($attachs[0]) ? count($attachs[0]) : 0;
			//获得内容字符数
			preg_match_all("/./us", $arr['content'], $match);
			$list_count[$arr['iid']]['content_count'] = isset($match[0]) ? count($match[0]) : 0;			
		}
	}
	foreach($list as $key=>$val){
		$list[$key]['frame_count'] = isset($list_count[$val['id']]['frame_count']) ? $list_count[$val['id']]['frame_count'] : 0;
		$list[$key]['content_count'] = isset($list_count[$val['id']]['content_count']) ? $list_count[$val['id']]['content_count'] : 0;
	}
	
	$data['list'] = $list;
	$data['count'] = $count;
}else{
	//初始化模型
	$_REQUEST['model'] = $CAT['model'];
	$this_system->init_model();
	if(empty($this_model)){
		$data['error'] = $P8LANG['no_such_cms_model'];
		exit(jsonencode($data));
	}
	if(empty($this_model['enabled'])){
		$data['error'] = $P8LANG['cms_model_disabled'];
		exit(jsonencode($data));
	}
}

if($CAT['type'] == 2){
	//$select的参数
	$select_param = array();
	
	$select_param['from'] = array($this_module->table .' AS i', 'i.*');
	
	$CAT['is_category'] = true;
	
	if($CAT['htmlize'] == 2){
		$tmp = $CAT['htmlize'];
		$CAT['htmlize'] = 0;
	}
	$page_url = $this_system->site_p8_url($this_module, $CAT, 'list', false);
	
	$page_urls = $selected_fields = array();
	
	$field_filter = false;
	
	$orderby = empty($CAT['CONFIG']['orderby']) ? 'i.timestamp' : 'i.'.$CAT['CONFIG']['orderby'];	 
	$desc = empty($CAT['CONFIG']['orderby_desc']) ? ' DESC' : ' ASC';
	$orderby = $orderby == 'i.level' ? 'i.level'.$desc.',i.timestamp'.$desc : $orderby.$desc;
	$select_param['order'] = array($orderby);
	
}else{	
	$category->get_cache();
	
	//父分类
	$parent_cats = $category->get_parents($cid);
	//子分类
	$subcategories = array();
	if(isset($category->categories[$cid]['categories'])){
		$subcategories = $category->categories[$cid]['categories'];
		$CATEGORY = $category->get_children_ids($cid) + array($cid);
	}

}

//print_R($page_urls);
//----------------------------------------------------------
//模型自定义脚本
if(!$CAT['list_all_model']){
	$file = $this_model['path'] .'list.php';
	if(!is_file($file)){
		$file = str_replace('/'.$MODEL.'/','/article/',$file);
	}
	require $file;
}
//----------------------------------------------------------


if($CAT['type'] == 2){

	//当前分类的内容数
	$count = $field_filter ? 0 : $CAT['item_count'];
	
	$select = select();
	
	//最后才加载数据较大的分类数据
	$category->get_cache();
	
	//父分类
	$parent_cats = $category->get_parents($cid);
	
	//子分类
	$subcategories = array();
	if(isset($category->categories[$cid]['categories'])){
		$subcategories = $category->categories[$cid]['categories'];
		$CATEGORY = $category->get_children_ids($cid) + array($cid);
	}else{
		$CATEGORY = $cid;
	}
	
	$select->in('i.cid', $CATEGORY);
	
	//print_R($select_param);
	foreach($select_param as $func => $param){
		//$select->$func($param);
		switch($func){
		
		case 'in':
			foreach($param as $field => $_param){
				call_user_func_array(array(&$select, $func), $_param);
			}
		break;
		
		case 'range':
			foreach($param as $field => $_param){
				call_user_func_array(array(&$select, $func), $_param);
			}
		break;
		
		default:
			call_user_func_array(array(&$select, $func), $param);
		break;
		
		}
	}
			
	$sphinx = $this_module->CONFIG['sphinx'];
	$sphinx['index'] = $this_system->sphinx_indexes(array($MODEL => 1));	
	
	$orderby = empty($CAT['CONFIG']['orderby']) ? 'i.timestamp' : 'i.'.$CAT['CONFIG']['orderby'];	 
	$desc = empty($CAT['CONFIG']['orderby_desc']) ? ' DESC' : ' ASC';
	$orderby = $orderby == 'i.level' ? 'i.level'.$desc.',i.timestamp'.$desc : $orderby.$desc;
	switch($myorderby){
		case '1':
			$orderby = 'i.timestamp DESC';
		break;
		case '2':
			$orderby = 'i.list_order DESC';
		break;
		case '3':
			$orderby = 'i.views DESC';
		break;
		case '4':
			$orderby = 'i.comments DESC';
		break;
		case '5':
			$orderby = 'i.level DESC,i.timestamp DESC';
		break;
	}
	$select->order($orderby);
	//echo $select->build_sql();
	$list = $core->list_item(
		$select,
		array(
			'count' => &$count,
			'page' => &$page,
			'page_size' => $CAT['page_size'],
			'sphinx' => $sphinx
		)
	);
	
	foreach($list as $k => $v){
		$v['#category'] = &$category->categories[$v['cid']];
		$list[$k]['url'] = $this_system->site_p8_url($this_module, $v, 'view');
		if(strrpos($list[$k]['url'],"http://") === FALSE && strrpos($list[$k]['url'],"https://") === FALSE){
			$path = substr($resource, -1) != '/' ? $resource : substr($resource,0,-1);//去/
			$list[$k]['url'] = substr($list[$k]['url'],0,1) != '/' ? '/'.$list[$k]['url'] : $list[$k]['url'];//加/
			$list[$k]['url'] = $path.$list[$k]['url'];
		}
		$list[$k]['frame'] = attachment_url($v['frame'],false,true);
		$list[$k]['full_title'] = $v['title'];
		$list[$k]['title'] = $v['title'];
		$tmp = explode('|', $v['sub_title']);
		$list[$k]['sub_title'] = $tmp[0];
		$list[$k]['sub_title_url'] = isset($tmp[1]) ? $tmp[1] : '';
		$list[$k]['summary'] = html_entity_decode($v['summary']);
		$list[$k]['summary'] = preg_replace('/(amp;)+/','', $list[$k]['summary']);
		//分类名称
		$list[$k]['category_name'] = $v['#category']['name'];
		//分类URL
		$list[$k]['category_url'] = $v['#category']['url'];
		
		if(!empty($v['title_color'])) $list[$k]['title'] = '<font color="'. $v['title_color'] .'">'. $list[$k]['title'] .'</font>';
		if(!empty($v['title_bold'])) $list[$k]['title'] = '<b>'. $list[$k]['title'] .'</b>';
	}
	// 获得内容图片数、内容字符数
	if($iids){
		$SQL = "SELECT iid,content FROM $this_module->addon_table WHERE iid in(".implode(',',$iids).")";
		$query = $core->DB_master->query($SQL);
		$list_count = array();
		while($arr = $core->DB_master->fetch_array($query)){
			//获得内容图片数
			$attachs = array();
			preg_match_all('/(<img\s+?[^>]*?)(src)=[\'"]?([^\'"\s\>]+)[\'"]?/i',$arr['content'],$attachs);
			$list_count[$arr['iid']]['frame_count'] = isset($attachs[0]) ? count($attachs[0]) : 0;
			//获得内容字符数
			preg_match_all("/./us", $arr['content'], $match);
			$list_count[$arr['iid']]['content_count'] = isset($match[0]) ? count($match[0]) : 0;			
		}
	}
	foreach($list as $key=>$val){
		$list[$key]['frame_count'] = isset($list_count[$val['id']]['frame_count']) ? $list_count[$val['id']]['frame_count'] : 0;
		$list[$key]['content_count'] = isset($list_count[$val['id']]['content_count']) ? $list_count[$val['id']]['content_count'] : 0;
	}
	$data['list'] = $list;
	$data['count'] = $count;
}
exit(jsonencode($data));