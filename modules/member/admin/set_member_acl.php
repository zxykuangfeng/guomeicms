<?php
defined('PHP168_PATH') or die();

/**
* 单个用户权限设置
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');
if(REQUEST_METHOD == 'GET'){
	$system = isset($_GET['system']) ? trim($_GET['system']) : 'cms';
	$role_gid = isset($_GET['role_gid']) ? intval($_GET['role_gid']) : 0;
	$role_id = isset($_GET['role_id']) ? intval($_GET['role_id']) : 0;
	$mstatus = isset($_GET['mstatus']) ? intval($_GET['mstatus']) : '';
	$keyword = isset($_GET['word']) ? $_GET['word'] : '';
	$name = isset($_GET['name']) ? $_GET['name'] : '';
	$dept = isset($_GET['dept']) ? $_GET['dept'] : '';
	$id = isset($_GET['id']) ? filter_int(explode(',', (string)$_GET['id'])) : array();
	$order = isset($_GET['order']) && $_GET['order'] == 'ASC' ? 'ASC' : 'DESC';
	$depts = $this_module->CONFIG['dept'];
	$dept_list = array();
	foreach($depts as $d){
		$dept_list[$d['code']] = $d['name'];
	}
	if(P8_AJAX_REQUEST){
		
		$select = select();
		$select->from($this_module->table, 'id, username, role_id, role_gid, name, email, phone, cell_phone, last_login_ip, last_login,register_time, status, display_order,dept');
		if(($mstatus || $mstatus === 0) && in_array($mstatus,array_keys($this_module->status))) $select->in('status', $mstatus);
		if(empty($id)){
			
			if($role_id){
				$select->in('role_id', $role_id);
			}else if($role_gid){
				$select->in('role_gid', $role_gid);
			}
			
			if(!empty($_GET['is_admin'])){
				$select->in('is_admin', 1);
			}
			
			if($keyword)
				$select->like('username', html_entities(from_utf8($keyword)));
			if($name)
				$select->like('name', html_entities(from_utf8($name)));
		}else{
			$select->in('id', $id);
		}
		$select->order('display_order DESC,id '. $order);
		if($dept) $select->in('dept',$dept);
		$page_url = 'javascript:request_item(?page?)';

		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$page = max(1, $page);
		$page_size = 40;

		$count = 0;
		$list = $core->list_item(
			$select,
			array(
				'page' => &$page,
				'count' => &$count,
				'page_size' => $page_size,
				'ms' => 'master'
			)
		);
		foreach($list as $key => $val){
			$list[$key]['dept'] = $val['dept'] ? $dept_list[$val['dept']] : '';
		}
		$pages = list_page(array(
			'count' => $count,
			'page' => $page,
			'page_size' => $page_size,
			'url' => $page_url
		));
		
		$json = p8_json(array(
			'list' => $list,
			'pages' => $pages
		));
		//echo $select->build_sql();
		exit($json);
	}
	//core
	$controller = &$core->controller($core);
	$allow_core_set_acl = $controller->check_admin_action('set_member_acl');
	//cms
	$cms_system = &$core->load_system('cms');
	$cms_controller = &$core->controller($cms_system);
	$allow_cms_set_acl = $cms_controller->check_admin_action('set_member_acl');
	//sites
	$systems = $core->list_systems();
	$allow_set_acl =  false;
	if(isset($systems['sites']) && $systems['sites']['enabled']){
		$sites_system = &$core->load_system('sites');
		$sites_controller = &$core->controller($sites_system);
		$allow_set_acl = $sites_controller->check_admin_action('set_member_acl');
	}
	$status_json = array();
	foreach($this_module->status as $status => $lang){
		$status_json[$status] = $P8LANG['member_status'][$lang];
	}

	$core->get_cache('role_group');
	$core->get_cache('role');

	$role_group_json = p8_json($core->role_groups);
	$role_json = p8_json($core->roles);
	$status_json = p8_json($status_json);
	if($system == 'sites'){
		$allow_cms_set_acl = false;
		$allow_core_set_acl = false;
		$copyacl_link = false;
	}
	include template($this_module, 'set_member_acl', 'admin');
}else if(REQUEST_METHOD == 'POST'){
	
	$display_order = isset($_POST['_display_order']) ? array_map('intval', (array)$_POST['_display_order']) : array();
		
		foreach($display_order as $id => $order){
			$id = intval($id);
			
			$DB_master->update(
				$this_module->table,
				array('display_order' => $order),
				"id = '$id'"
			);
		}
		
		$display_order && $this_module->cache();
		message('done');
}
