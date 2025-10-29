<?php
defined('PHP168_PATH') or die();

/**
* 查看分类
**/

//栏目
if($CAT['type'] == 2){
	
	//页面缓存
	page_cache($PAGE_CACHE_PARAM);
	
	$select = select();
	
	foreach($select_param as $func => $param){
		//$select->$func($param);
		call_user_func_array(array(&$select, $func), $param);
	}
	
	//$select->xx
}
