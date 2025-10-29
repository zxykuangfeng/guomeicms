<?php
defined('PHP168_PATH') or die();

/**
* 客户端管理
**/

//$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
    $delete_log = $this_controller->check_admin_action('delete_log');
	$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	if($id){
		$select = select();
		$select->from($this_system->log_table, 'request');
		$select->in('id', $id);
		
		$data = $core->select($select, array('ms' => 'master', 'single' => true));
		exit(empty($data['request']) ? '' : $data['request']);
	}
	
	$select = select();
	$select->from($this_system->log_table.' AS g', 'g.*');
	$select->in('site',$this_system->SITE);
	$member = &$core->load_module('member');
	$select->left_join($member->table.' AS m','m.name','g.username = m.username');
	$select->order('id DESC');
	
	$count = 0;
	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$page = max(1, $page);
	$page_size = 20;
	
	$list = $core->list_item(
		$select,
		array(
			'count' => &$count,
			'page' => &$page,
			'page_size' => $page_size,
			'ms' => 'master'
		)
	);
	
	$page_url = $this_url .'?page=?page?';
	
	$pages = list_page(array(
		'count' => $count,
		'page' => $page,
		'page_size' => $page_size,
		'url' => $page_url
	));

	include template($this_system, 'log', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
    /**
	* 删除日志
	**/
	$_POST = p8_stripslashes2($_POST);
	$this_controller->check_admin_action('delete_log') or exit(p8_json($P8LANG['no_privilege']));
    $act = isset($_POST['act']) ? $_POST['act'] : '';
	switch($act){
	
	case 'truncate':
		$DB_master->query("DELETE FROM {$this_system->log_table} WHERE site='{$this_system->SITE}'");
		
		$ADMIN_LOG = array('title' => $P8LANG['_core_truncate_admin_log']);
		
		message('done');
	break;
	
	case 'delete':
		$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
        $id or exit('[]');
        
        $DB_master->delete(
            $this_system->log_table,
            "id IN (". implode(',', $id) .")"
        );
        if(P8_AJAX_REQUEST)
            exit(p8_json($id));
		
		message('done');
	break;
	
	}
}
