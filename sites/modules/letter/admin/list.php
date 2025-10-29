<?php
defined('PHP168_PATH') or die();

$this_system->check_manager($ACTION) or message('no_privilege');
GetGP(array('status','page','action','keyword','number','act','solve_name','source','department','type'));
$act = $act? $act : 'search';
$status = isset($status)? $status:0;
$class[$status]='over';

$types = $this_module->get_category('type');
$departments = $this_module->get_category('department');
//$role = &$core->load_module('role');
//$role->get_cache();
if($act=='search'){
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max(1, $page);
}else{
	$page = 0;
}

$select = select();
$page_param = array();
$select->from($this_module->table, '*');
$select -> in('site',$this_system->SITE);
if(isset($status)){$select->in('status',$status);$page_param['status']=$status;}
if(!empty($department)){$select->in('department',trim($department));$page_param['department']=$department;}
if(!empty($type)){$select->in('type',trim($type));$page_param['type']=$type;}
if(!empty($number)){$select->in('number',trim($number));$page_param['number']=$number;}
if(!empty($keyword)){$select->like('title',trim($keyword));$page_param['keyword']=$keyword;}
if(!empty($solve_name)){$select->in('solve_name',trim($solve_name));$page_param['solve_name']=$solve_name;}
if(!empty($source)){$select->in('solve_name',intval($source)-1);$page_param['source']=$source;}
$select->order('id desc');
$count = 0;
//echo $select->build_sql();
$page_url = $this_router .'-'. $ACTION .'?status='.$status.'&page=?page?';

$list = $core->list_item(
	$select,
	array(
		'page' => &$page,
		'count' => &$count,
		'page_size' => 20
	)
);
if($page_param){
		$page_param = http_build_query($page_param);
		$page_url .= '?'.$page_param;
	}
	$page_url .= '#'.(strpos($page_url,'?')===false? '?':'&').'page=?page?# ';
	$pages = list_page(array(
		'count' => $count,
		'page' => $page,
		'page_size' => 20,
		'url' => $page_url
	));
//$cates = $this_module->get_category();
if($act=='search')
	include template($this_module, "list", 'admin');
else
	include template($this_module, "print_list", 'admin');	
