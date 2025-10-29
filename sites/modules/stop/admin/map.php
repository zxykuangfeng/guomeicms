<?php
defined('PHP168_PATH') or die();

/**
* 添加字段
**/
$this_system->check_manager($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
    $cms_system = $core->load_system('cms');
	$category = &$this_system->load_module('category');
	$json = $category->get_json();
	
	$config = $this_module->get_map();
    $this_module->get_category_cache(false);
    $path = array();
    foreach($this_module->categories as $v){
        $parents = $this_module->get_parents($v['id']);
        foreach($parents as $vv){
            $path[$v['id']][] = $vv['id'];
        }
        $path[$v['id']][] = $v['id'];
    }
	$r_json = array(
        'json' => p8_json($this_module->make_json_sort($this_module->top_categories)),
        'path' => p8_json($path)
    );
	//$allsites = $this_system->get_sites();
	//$sitename_alias = !empty($allsites[$this_system->SITE]['sitename']) ? $allsites[$this_system->SITE]['sitename']  : '';
	$sitename_alias = $this_system->site['sitename'];
	include template($this_module, 'map', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	$map = isset($_POST['map']) ? (array)$_POST['map'] : array();
	$_map = array();
	foreach($map as $k => $v){
		$k = intval($k);
		$v = intval($v);
		if(!$v) continue;
		
		$_map[$k] = $v;
	}

	$this_module->set_map(array(
		'map' => $_map,
		'auto_verify' => empty($_POST['auto_verify']) ? 0 : 1,
		'auto_push' => empty($_POST['auto_push']) ? 0 : 1
	));
	
	message('done', $this_router .'-map');
}
