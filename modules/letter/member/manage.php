<?php
defined('PHP168_PATH') or die();
$this_controller->check_action('manager') or message('no_privilege');
GetGP(array('status','page','action','word','type','department','parent_department','act'));
$act = $act? $act : 'search';

//$this_controller->check_manage($department,$type) or	message('no_privilege');
	
$select = select();
$select->from($this_module->table, 'id,department,type,number,username,create_time,title,status');
$state = isset($status)? intval($status):-1;
$sta[$state]=" class='over'";
if(intval($state)>=0){
	if($state==1)
		$select->in('status',3);
	else
		$select->in('status',3,true);
}
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


$page_url = $this_router .'-'. $ACTION .'?page=?page?';
if(!empty($department)){
	$select->in('department',trim($department));
	$page_url .= '&department='.$department;
}else if(!empty($parent_department)){
	$select->in('department',$pds);
	$page_url .= '&parent_department='.$parent_department;
}
if(!empty($type)){
	$select->in('type',trim($type));
	$page_url .= '&type='.trim($type);
}
if(!empty($word)){
	$select->like('title',trim($word));
	$page_url .= '&word='.trim($word);
}
$select->order('create_time DESC');

if($act=='search'){
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max(1, $page);
}else{
	$page = 0;
}


//echo $select->build_sql();
$count = 0;
$list = $core->list_item(
	$select,
	array(
		'page' => &$page,
		'count' => &$count,
		'page_size' => 20
	)
);

$act=='search' && $pages = list_page(array(
		'count' => $count,
		'page' => $page,
		'page_size' => 20,
		'url' => $page_url
	));
	

	
$id_type = $this_module->id_type();
if($act=='search')
	include template($this_module, "manage");
else
	include template($this_module, "print_list");	

?>
