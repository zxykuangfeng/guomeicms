<?php
defined('PHP168_PATH') or die();

$mysites = $this_system->get_manage_sites();
$mysites || $this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$site_create = $this_controller->check_admin_action('site_create');
    $site_delete = $this_controller->check_admin_action('site_delete');
	$site_recycle = $this_controller->check_admin_action('site_recycle');
    $site_edit = $this_controller->check_admin_action('site_edit');
    
	load_language($core, 'config');
    
	
	$select = select();
	$select->from($this_module->table, '*');
	$select->in('alias',$mysites);
	$select->order('sort DESC');
	$count = 0;
	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$page = max(1, $page);
	$page_size = 20;
	//echo $select->build_sql();
	$lists = $core->list_item(
		$select,
		array(
			'page_size' => 0,
			'ms' => 'master'
		)
	);
	$list = array();
	foreach($lists as $item){
		$item_config = mb_unserialize($item['config']);
		$item['authentication_mark'] = isset($item_config['authentication_mark']) && $item_config['authentication_mark'] ? 1 : 0;
		if($item['parent'] == 0) {
		  $list[$item['id']] = $item;
		  $list[$item['id']]['child'] = array();
		}else{
		  $list[$item['parent']]['child'][]= $item;
		}
    }
	
	foreach($list as $id=>$item){
		if(!isset($item['alias'])) {
			$alias_info = $this_module->get_parent_site($id);
			$list[$id]['alias'] = $alias_info['alias'];
			$list[$id]['sitename'] = $alias_info['sitename'];
			$list[$id]['status'] = $alias_info['status'];
			$list[$id]['timestamp'] = $alias_info['timestamp'];
			$list[$id]['sort'] = $alias_info['sort'];
		}
	}	
	
	$page_url = $this_url .'?page=?page?';
	
	$pages = list_page(array(
		'count' => $count,
		'page' => $page,
		'page_size' => $page_size,
		'url' => $page_url
	));
	$templates = $this_module->get_sites_templates();
	$item_config = $core->get_config($this_system->name, 'item');
	$allow_sites_database = $item_config['menu_sites_database'] ? false : true;
	$allow_sites_delete = $item_config['menu_sites_delete'] ? false : true;
	$allow_menu_html = $item_config['menu_menu_html'] ? false : true;
	$allow_sites_deletes = $item_config['menu_sites_deletes'] ? false : true;
	//站点信息
	$site = !empty($_GET['site']) ? $_GET['site'] : $_GET['alias'];	
	$site = in_array(clear_special_char($site),array_keys($this_system->sites)) ? clear_special_char($site) : $this_system->SITE;	
	$site_info = $this_system->get_site($site);		
	include template($this_module, 'list', 'admin');

}else if(REQUEST_METHOD == 'POST'){

		//批量排序
	$display_order = isset($_POST['_sort']) && is_array($_POST['_sort']) ? array_map('intval', $_POST['_sort']) : array();

    if($display_order){
        foreach($display_order as $id => $order){
            $DB_master->update(
                $this_module->table,
                array(
                    'sort' => $order
                ),
                "id = '$id'"
            );
        }
    }else{
        $this_module->cache();
    }
	$this_system->log(array(
		'title' => $P8LANG['_module_cache_admin_log'],
		'request' => $_POST,
	));
	message('done');
	
}
