<?php
defined('PHP168_PATH') or die();

/**
* 会员管理
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');
if(REQUEST_METHOD == 'GET'){
	$role_gid = isset($_GET['role_gid']) ? intval($_GET['role_gid']) : 0;
	$role_id = isset($_GET['role_id']) ? intval($_GET['role_id']) : 0;
	$mstatus = isset($_GET['mstatus']) && $_GET['mstatus'] ? intval($_GET['mstatus']) : '';
	$keyword = isset($_GET['word']) ? $_GET['word'] : '';
	$name = isset($_GET['name']) ? $_GET['name'] : '';
	$phone = isset($_GET['phone']) ? $_GET['phone'] : '';
	$dept = isset($_GET['dept']) ? $_GET['dept'] : '';
	$id = isset($_GET['id']) ? filter_int(explode(',', (string)$_GET['id'])) : array();
	$order = isset($_GET['order']) && $_GET['order'] == 'ASC' ? 'ASC' : 'DESC';
	$depts = $this_module->CONFIG['dept'];
	$dept_list = array();
	foreach($depts as $d){
		$dept_list[$d['code']] = $d['name'];
	}
	$dept = $dept && array_key_exists($dept,$dept_list) ? $dept : '';
	$parent = isset($_GET['parent']) ? intval($_GET['parent']) : 0;
	$parentid = 0;
	if($parent) $parent_info = $this_module->view_dept($parent);
	$parentid = $parent_info['parent'] ? $parent_info['parent'] : 0;
	$parents = array();
	$sql = "SELECT * FROM $this_module->dept_table WHERE parent = '$parent' LIMIT 1";
	
	do{
		if(empty($data)){
			$data = array(
				'parent' => $parent
			);
		}
		array_unshift($parents, $data['parent']);
		$sql = "SELECT * FROM $this_module->dept_table WHERE id = '$data[parent]' LIMIT 1";
		
	}while($data = $DB_master->fetch_one($sql));
	
	$dept2_select = select();
	$dept2_select->from($this_module->dept_table, '*');
	$dept2_select->in('parent', $parents);
	$dept2_select->order('display_order DESC');	
	
	$dept2_list = $core->list_item(
		$dept2_select,
		array(
			'count' => 0,
			'page' => 0
		)
	);
	$dept2s = array();
	if($parent){
		$dept2s = $this_module->get_children_ids($parent);
		array_unshift($dept2s, $parent);
	}
	
	if(P8_AJAX_REQUEST){
		
		$select = select();
		$select->from($this_module->table, 'id, username, role_id, role_gid, name, email, phone, cell_phone, last_login_ip, last_login,register_time, status, display_order,dept');
		if(($mstatus || $mstatus === 0) && in_array($mstatus,array_keys($this_module->status))) $select->in('status', $mstatus);
		if($mstatus && in_array($mstatus,array(3,6,12))){
			switch($mstatus){
				case '3':
					$select->range('last_login', 1,strtotime('-3 months'));
				break;
				case '6':
					$select->range('last_login', 1,strtotime('-6 months'));
				break;
				default:					
					$select->range('last_login', 1,strtotime('-12 months'));				
			}
		}
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
			if($phone)
				$select->like('cell_phone', html_entities(from_utf8($phone)));
			if($name)
				$select->like('name', html_entities(from_utf8($name)));
		}else{
			$select->in('id', $id);
		}
		if($dept2s) $select->in('dept2', $dept2s);
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

	$allow_add = $this_controller->check_admin_action('add');
	$allow_update = $this_controller->check_admin_action('update');
	$allow_delete = $this_controller->check_admin_action('delete');
	$allow_send = $this_controller->check_admin_action('batch_send');
	$allow_credit = $this_controller->check_admin_action('credit');
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
	include template($this_module, 'list', 'admin');
}else if(REQUEST_METHOD == 'POST'){
	
	$action = @$_POST['action'];
	$status = in_array(intval($_POST['status']),array(0,1,2)) ? intval($_POST['status']) : 2;
	$ids = $_POST['id'] ? implode(',',$_POST['id']) : '';
	switch($action){
		case 'locked':
			if($ids){
				$DB_master->update(
						$this_module->table,
						array('status' => $status),
						"id in (".$ids.")"
					);
			}else{
				message('fail');
			}
		break;
		
		default: 
			$display_order = isset($_POST['_display_order']) ? array_map('intval', (array)$_POST['_display_order']) : array();
			
			foreach($display_order as $id => $order){
				$id = intval($id);
				
				$DB_master->update(
					$this_module->table,
					array('display_order' => $order),
					"id = '$id'"
				);
			}
	}
	$display_order && $this_module->cache();
	message('done');
}
