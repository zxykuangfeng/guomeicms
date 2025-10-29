<?php
defined('PHP168_PATH') or die();

/**
* 日志管理
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	load_language($core, 'config');
	$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	if($id){
		$data = $DB_master->fetch_one("SELECT data FROM {$core->TABLE_}admin_log WHERE id = '$id'");
		
		exit(html_entities($data['data']));
	}
	$uid = isset($_GET['uid']) ? intval($_GET['uid']) : 0;
	$iid = isset($_GET['iid']) ? intval($_GET['iid']) : 0;
	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$desc = empty($_GET['desc']) ? ' DESC' : ' ASC';
	$keyword = isset($_GET['word']) ? p8_stripslashes2(trim($_GET['word'])) : '';
	$username = isset($_GET['username']) ? p8_addslashes($_GET['username']) : '';
	$system = isset($_GET['system']) ? p8_addslashes(xss_clear($_GET['system'])) : '';
	$site = isset($_GET['site']) ? p8_addslashes(xss_clear($_GET['site'])) : '';
	if($system != 'core' && $system && !get_system($system)) message('no_such_system');
	$module = isset($_GET['module']) ? p8_addslashes(xss_clear($_GET['module'])) : '';
	$action = isset($_GET['action']) ? p8_addslashes(xss_clear($_GET['action'])) : '';
	$act = isset($_GET['act']) ? p8_addslashes(xss_clear($_GET['act'])) : 'query';
	$page_size = isset($_GET['page_size']) ? intval($_GET['page_size']) : 20;
	$page_size = min($page_size, 200);
	$page_size = $act == 'download' ? 0 : $page_size;
	$page = max($page, 1);
	$starttime = isset($_GET['starttime']) ? (trim($_GET['starttime'])!='' ? trim($_GET['starttime']) : '') : '';
	$endtime = isset($_GET['endtime']) ? (trim($_GET['endtime'])!='' ? trim($_GET['endtime']) : '') : '';
	$member_action = false;
	if(in_array($action,array('addmember','updatemember','deletemember'))){		
		$system = 'core';
		$module = 'member';
		$member_action = true;
	}
	if($action == 'addmember') $action = 'add';
	if($action == 'updatemember') $action = 'update';
	if($action == 'deletemember') $action = 'delete';

	$select = select();
	$select->from($core->TABLE_ .'admin_log AS g', 'g.*');
	$select->order('g.id'. $desc);
	$member = &$core->load_module('member');
	$select->left_join($member->table.' AS m','m.name','g.username = m.username');
	if($uid){
		$select->in('g.uid', $uid);
		$select->order('g.timestamp'. $desc);
	}
	$select->where_and();
	
	$kw = array();
	/*
	if($keyword) {
		$kw = explode('/',$keyword);
		if($kw[2]=='u.php')
			$select->like(count($kw)==2 ? 'g.title' : 'g.url', count($kw)==2 ? '/'.$kw[2]:'/'.$kw[2].'/'.$kw[1]);
		else
			$select->like(count($kw)==2 ? 'g.title' : 'g.url', count($kw)==2 ? '/'.$kw[1]:'/'.$kw[1].'/'.$kw[2]);		
	}
	*/
	if($keyword) $select->like('g.title', $keyword);
	if($username) $select->in('g.username', $username);
	if($iid) $select->in('g.iid', $iid);
	if($site) $select->in('g.site', $site);
	if($module) $select->in('g.module', $module);
	if($action) $select->in('g.action', $action);
	if($member_action){
		if($action == 'add') $action = 'addmember';
		if($action == 'update') $action = 'updatemember';
		if($action == 'delete') $action = 'deletemember';
	}
	if($starttime || $endtime){
		$select->where_and();
		$starttime_r = $starttime == '' ? 0 : strtotime($starttime);
		$endtime_r = $endtime == '' ? strtotime('2049-12-31') : strtotime($endtime);
		$select->range('g.timestamp', $starttime_r, $endtime_r);
	}
	$list_systems = $core->list_systems();
	$all_sites = array();
	if(isset($list_systems['sites']) && $list_systems['sites']['enabled']){
		$sites_system = &$core->load_system('sites');
		$all_sites = $sites_system->get_sites();	
	}	
	$enable_systems = array(0=>'core');
	$all_modules = $all_actions = array();
	foreach($list_systems as $key=>$val){
		if($val['installed'] && $val['enabled']) $enable_systems[] = $key;
		$key_system = &$core->load_system($key);
		$all_modules[$key] = $key_system->list_modules();
	}
	$all_modules['core'] = &$core->list_modules();	
	foreach($all_modules as $key=>$val){		
		if($key == 'core'){
			foreach($val as $v){
				if($v['name'] && isset($core->modules[$v['name']])){
					$all_actions[$key][$v['name']] = @include(PHP168_PATH .'modules/'. $v['name'] .'/#.php');
				}else{
					$all_actions[$key][$v['name']] = @include(PHP168_PATH .'#.php');
				}
			}			
		}else if(isset($core->systems[$key])){
			foreach($val as $v){
				if($v['name'] && isset($core->CONFIG['system&module'][$key]['modules'][$v['name']])){
					$all_actions[$key][$v['name']] = @include(PHP168_PATH . $key .'/modules/'. $v['name'] .'/#.php');
				}else{
					$all_actions[$key][$v['name']] = @include(PHP168_PATH . $key .'/#.php');
				}
			}
		}	
	}
	$list_modules = array();
	if($system || $keyword && in_array($kw[1],$enable_systems)){
		if($system == 'core' || $keyword && $kw[1]=='core'){
			$system = 'core';
			$list_modules = &$core->list_modules();			
		}else{
			$system = $system ? $system : $kw[1];
			$this_system = &$core->load_system($system);
			$list_modules = $this_system->list_modules();
		}
		if($system && in_array($system,$enable_systems)) $select->like('url', '/'.$system);
	}	
	$count = 0;
	$list = $core->list_item(
		$select,
		array(
			'page' => &$page,
			'count' => &$count,
			'page_size' => $page_size
		)
	);
	$dodata = array();
	if($act == 'download'){
		foreach($list as $key=>$row){
			$dodata[$key]['id'] = $row['id'];
			$dodata[$key]['operator'] = $row['username'].($row['name'] ? '|'.$row['name']:'');
			$dodata[$key]['operate_matter'] = $row['title'];
			$dodata[$key]['iid'] = $row['iid'];
			$dodata[$key]['cid'] = $row['cid'];
			$dodata[$key]['system'] = $row['system'] == 'core' ? $P8LANG['core'] : $list_systems[$row['system']]['alias'];
			$dodata[$key]['module'] = $all_modules[$row['system']][$row['module']]['alias'] ? $all_modules[$row['system']][$row['module']]['alias'] : $row['module'];
			if(strpos($row['url'],'admin.php')){
				if($all_actions[$row['system']][$row['module']]['admin_actions'][$row['action']]){
					$dodata[$key]['action'] = $all_actions[$row['system']][$row['module']]['admin_actions'][$row['action']];
				}else{
					$dodata[$key]['action'] = (in_array($row['action'],array('login','logout')) ? '账号':'').$P8LANG[$row['action']];
				}
			}else{
				if($all_actions[$row['system']][$row['module']]['actions'][$row['action']]){
					$dodata[$key]['action'] = $all_actions[$row['system']][$row['module']]['actions'][$row['action']];
				}else{
					$dodata[$key]['action'] = (in_array($row['action'],array('login','logout')) ? '账号':'').$P8LANG[$row['action']];
				}
			}
			$dodata[$key]['site'] = $all_sites[$row['site']]['sitename'] ? $all_sites[$row['site']]['sitename'] : $row['site'];
			$dodata[$key]['url'] = $row['url'];
			$dodata[$key]['operate_date'] = date('Y-m-d H:i:s', $row['timestamp']);
			$dodata[$key]['operate_ip'] = $row['ip'];
		}
		$headertext = array(
			$P8LANG['id'],
			$P8LANG['operator'],
			$P8LANG['operate_matter'],
			$P8LANG['iid'],
			$P8LANG['cid'],
			$P8LANG['system'],
			$P8LANG['module'],
			$P8LANG['action'],
			$P8LANG['site'],
			$P8LANG['url'],
			$P8LANG['operate_date'],
			$P8LANG['operate_ip'],
		);
		require PHP168_PATH.'/inc/excel.class.php';
		$export=new excel(1);
		$export->setFileName('log','download',date('Y-m-d-h-i-s', P8_TIME));
		$export->fileHeader($headertext);		
		$export->fileData($dodata);
		$export->fileFooter();
		$export->exportFile();
		exit;
	}
	
	//echo $select->build_sql();
	$page_url = 'javascript:request_item(?page?)';
	$pages = list_page(array(
		'count' => $count,
		'page' => $page,
		'keyword' => $keyword,
		'username' => $username,
		'page_size' => $page_size,
		'url' => $page_url
	));	
	include template($core, 'log', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$act = isset($_POST['act']) ? $_POST['act'] : '';
	switch($act){
	case 'truncate':
		$DB_master->query("TRUNCATE TABLE {$core->TABLE_}admin_log");
		
		$ADMIN_LOG = array('title' => $P8LANG['_core_truncate_admin_log']);
		
		message('done');
	break;
	
	case 'delete':
		$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
		$oid = isset($_POST['oid']) ? intval($_POST['oid']) : '';
		$realarray = $oid ? array($oid) : $id;
		$realarray or exit('[]');
		
		$resule = $DB_master->delete(
			$core->TABLE_ .'admin_log',
			'id IN ('. implode(',', $realarray) .')'
		);
		
		$ADMIN_LOG = array('title' => $P8LANG['_core_delete_admin_log']);
		exit(p8_json($realarray));
	break;
	
	}
	
}
