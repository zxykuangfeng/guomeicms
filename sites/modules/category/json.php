<?php
defined('PHP168_PATH') or die();

/**
* 分类的JSON
**/

$site = isset($_GET['newsite']) ? xss_clear($_GET['newsite']) : $this_system->SITE;
$this_module->get_cache(true,$site);
$callback = isset($_GET['callback']) ? xss_clear($_GET['callback']) : '';
$callback = preg_replace('/[^\w_]*/','',$callback);
$api = isset($_GET['api']) ? 1 : 0;
$json = '{}';
$is_manager = $this_system->check_manager('',$site);
$is_poster = $this_system->check_poster('',$site);
$all = true;
$my_addible_category = array();
if($is_manager || $is_poster){
	$all = true;
}else{
	$member = &$core->load_module('member');
	$item_module = &$this_system->load_module('item');
	$acls = $member->get_acl($item_module, $UID, $site);
	//有选择以选择为准，无则全部显示
	if(isset($acls['my_addible_category'])){		
		$my_addible_category = array_keys($acls['my_addible_category']);
		if(count($my_addible_category) > 1 || count($my_addible_category) == 1 && $my_addible_category[0] != 0) {
			$all = false;
			$my_addible_category = array_keys($acls['my_addible_category']);
		}else{
			$all = true;
		}
	}else{
		$all = true;
	}
}
if(isset($_GET['parent'])){
	
	$parent = intval($_GET['parent']);
	
	if(isset($this_module->categories[$parent]['categories']) || $parent == 0){
		$ret = array();		
		if(isset($this_module->categories[$parent]['categories'])){
			$for = &$this_module->categories[$parent]['categories'];
		}else{
			$for = &$this_module->top_categories;
		}
		
		foreach($for as $v){
			unset($v['allow_dynamic']);
			if(!$api){
				isset($v['categories']) && $v['categories'] = true;
			}
			if($all || in_array($v['id'],$my_addible_category)) $ret[$v['id']] = $v;
		}
		
		$json = jsonencode($this_module->make_json_sort($ret));
	}else{
		$json = '{}';
	}
	
}else if(isset($_GET['id'])){
	
	$ret = array();
	foreach((array)$_GET['id'] as $id){
	    $id = xss_clear($id);
		if(isset($this_module->categories[$id])){
			$ret[$id] = $this_module->categories[$id];
			if(!$api){
				if(isset($ret[$id]['categories'])) $ret[$id]['categories'] = true;
			}
			unset($ret[$id]['url'], $ret[$id]['allow_dynamic']);
			
			$ret[$id]['parents'] = array_merge($this_module->get_parents($id), array($ret[$id]));
			
			foreach($ret[$id]['parents'] as $parent_cat){
				$parent_id = $parent_cat['parent'];
				$tmp = $parent_id == 0 ? $this_module->top_categories : $this_module->categories[$parent_id]['categories'];
				
				foreach($tmp as $sub_cat){
					if(!$api){
						isset($sub_cat['categories']) && $sub_cat['categories'] = true;
					}
					unset($sub_cat['url'], $sub_cat['allow_dynamic']);
					$ret[$id]['paths'][$parent_id][$sub_cat['id']] = $sub_cat;
				}
			}
		}		
	}
	if(empty($ret)){
		$first = current($this_module->categories);
		$id = $first['id'];
		$ret[$id] = $this_module->categories[$id];
		if(!$api){
			if(isset($ret[$id]['categories'])) $ret[$id]['categories'] = true;
		}
		unset($ret[$id]['url'], $ret[$id]['allow_dynamic']);
		
		$ret[$id]['parents'] = array_merge($this_module->get_parents($id), array($ret[$id]));
		
		foreach($ret[$id]['parents'] as $parent_cat){
			$parent_id = $parent_cat['parent'];
			$tmp = $parent_id == 0 ? $this_module->top_categories : $this_module->categories[$parent_id]['categories'];
			
			foreach($tmp as $sub_cat){
				if(!$api){
					isset($sub_cat['categories']) && $sub_cat['categories'] = true;
				}
				unset($sub_cat['url'], $sub_cat['allow_dynamic']);
				$ret[$id]['paths'][$parent_id][$sub_cat['id']] = $sub_cat;
			}
		}
	}
	//print_R($ret);
	$json = jsonencode($ret);
	
}

if($api) 
	exit($json);
else
	exit($callback .'('. $json .');');