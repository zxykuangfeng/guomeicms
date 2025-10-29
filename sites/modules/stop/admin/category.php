<?php
defined('PHP168_PATH') or die();

/**
* 分类管理
**/
$this_controller->check_admin_action($ACTION) or message('no_privilege');

$action = isset($_GET['action'])?$_GET['action']:'list';
if(REQUEST_METHOD == 'GET'){
	
if($action=='list'){
    $this_module->get_category_cache(false);
    $path = array();
    foreach($this_module->categories as $v){
        $parents = $this_module->get_parents($v['id']);
        foreach($parents as $vv){
            $path[$v['id']][] = $vv['id'];
        }
        $path[$v['id']][] = $v['id'];
    }
    
    $json = array(
        'json' => p8_json($this_module->make_json_sort($this_module->top_categories)),
        'path' => p8_json($path)
    );
    //$allsites = $this_system->get_sites();
	//$sitename_alias = !empty($allsites[$this_system->SITE]['sitename']) ? $allsites[$this_system->SITE]['sitename']  : '';
	$sitename_alias = $this_system->site['sitename'];
    
    include template($this_module, 'category_list', 'admin');
}
if($action=='add'){
    $json = $core->CACHE->read($this_system->name .'/modules/', $this_module->name, 'json');
	$data = array();
	$data['parent'] = isset($_GET['parent']) ? intval($_GET['parent']) : 0; 
	
	include template($this_module, 'edit_category', 'admin');
}
if($action=='update'){
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	$id or message('no_such_item');

	$select = select();
	$select->from($this_module->cat_table, '*');
	$select->in('id', $id);
	$data = $core->select($select, array('single' => true, 'ms' => 'master'));
	$data or message('no_such_item');
	
	$json = $core->CACHE->read($this_system->name .'/modules/', $this_module->name, 'json');
	
	include template($this_module, 'edit_category', 'admin');
}

}else if(REQUEST_METHOD == 'POST'){
	
if($action=='add'){   

	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);

    $name = isset($_POST['name']) ? $_POST['name'] : '';
	$name = array_filter(explode("\r\n", $name));
	foreach($name as $v){
		$_POST['name'] = $v;
		$this_module->add_category($_POST) or message('fail');
	}
	
	$this_module->cache();

	message('done',$this_router.'-category');
}
if($action=='update'){
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
    $id = isset($_POST['id']) ? $_POST['id'] : '';
	$this_module->update_category($id, $_POST) or message('fail');
	
	$this_module->cache();

	message('done',$this_router.'-category');

}

if($action=='delete'){
    @set_time_limit(600);
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	$id = isset($_POST['id']) ? $_POST['id'] : array();
	$id or exit('[]');

	$id = filter_int($id);
	$id or exit('[]');
	
	$ret = $this_module->delete_category(array(
		'where' => 'id IN ('. implode(',', $id) .')'
	)) or exit('[]');
	
	$this_module->cache_category();
	
	$this_module->log(array(
		'title' => $P8LANG['cluster_cms_item']['delete_category'],
		'request' => $_POST,
	));

	exit(jsonencode($ret));

}
if($action=='order'){    
	//批量修改栏目排序
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	$display_order = isset($_POST['_display_order']) ? array_map('intval', (array)$_POST['_display_order']) : array();
	
	foreach($display_order as $id => $order){
		$DB_master->update(
			$this_module->cat_table,
			array('display_order' => $order),
			"id = '$id'"
		);
	}
	
	$display_order && $this_module->cache_category();
	
	message('done');
}    
	
}
