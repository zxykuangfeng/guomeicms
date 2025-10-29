<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');
$search = array('status','page','action','word','department','parent_department','number','act','solve_name','source','page_size');
GetGP($search);
$page_size = !empty($page_size) ? intval($page_size) : 20;
$act = $act? $act : 'search';
$status = isset($status)? $status:0;
$class[$status] = 'active';


if($act=='search'){
	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$page = max(1, $page);
}else{
	$page = 0;
}

$select = select();

$select->from($this_module->table, '*');
if(isset($status))$select->in('status',$status);
if(!empty($number))$select->like('number',trim($number));
if(!empty($word))$select->like('title',trim($word));
if(!empty($solve_name))$select->in('solve_name',trim($solve_name));
if(!empty($source))$select->in('solve_name',intval($source)-1);
$cates = $this_module->get_category();

//二级部门处理
$select_size = 1;
$select_data = array();
$data_field = array();
$cates_departments = array();
//构建一级
foreach($cates['department'] as $key => $row){
	if($row['parent']) continue;
	$cates_departments[$key] = $row;
	$s = array();
	foreach($row['menus'] as $k=>$m){
		if($department == $m['id']) $data_field = array($m['parent'],$m['id']);
		$s[$m['id']] = array(
			'i' => $m['id'],
			'n' => $m['name'],
			's' => '',			
		);
		$cates_departments[$m['id']] = $m;
		$cates_departments[$m['id']]['name'] = $row['name'].' > '.$m['name'];
	}		
	if(empty($data_field) && $parent_department == $row['id']) $data_field = array($row['id']);
	if($department == $row['id']) $data_field = array($row['id']);
	$select_data[$row['id']] = array(
		'i' => $row['id'],
		'n' => $row['name'],
		's' => $s,
	);
	if(count($row['menus'])>=1) $select_size = 2;
}

$select_json_data = p8_json($select_data);
//$data_field = empty($department)? array() : explode('-',$department);

$selectdata = array();
$inputname = 'department';
//只选大分类的情况
$pds = array();
if(intval($parent_department) && !intval($department)){
	$pds = array($parent_department);
	foreach($cates['department'][$parent_department]['menus'] as $menus){
		$pds[] = $menus['id'];
	}
}
if(!empty($department)){
	$select->in('department',trim($department));
}else if(!empty($parent_department)){
	$select->in('department',$pds);
}
$count = 0;
//echo $select->build_sql();
$page_url = $this_router .'-'. $ACTION .'?page=?page?';
foreach($search as $v){
	if($v != 'page')$page_url .= '&'.$v.'='.$$v;
}
$select->order('id'. ' DESC');
$list = $core->list_item(
	$select,
	array(
		'page' => &$page,
		'count' => &$count,
		'page_size' => $page_size
	)
);
//信件没分发不显示
//undisplay == 0 显示
$redepartmentid = 0;
if(!empty($this_module->CONFIG['redepartment']))
    $redepartmentid = intval($this_module->CONFIG['redepartment']);
	$pages = list_page(array(
		'count' => $count,
		'page' => $page,
		'page_size' => $page_size,
		'url' => $page_url
	));

if($act=='search')
	include template($this_module, "list", 'admin');
else
	include template($this_module, "print_list", 'admin');	
