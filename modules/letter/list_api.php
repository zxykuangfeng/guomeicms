<?php
defined('PHP168_PATH') or die();

/**
* 列表页

**/
$data = array();

//搜索开始
$count = 0;

$select = select();
$select -> from("$this_module->table",'*');

$acl_where = $split = '';	
$page_param = array();
//搜索条件
$department = isset($request['department']) ?  intval($request['department']) : '';
if($department){
	$page_param['department']=$department;
	$select -> in('department',$department);
}
$type = isset($request['type']) ? intval($request['type']) : '';
$typ = isset($request['typ']) ? intval($request['typ']) : '';
$type = $type?$type:$typ;
if($type){
	$page_param['type']=$type;
	$select -> like('type',$type);
}
$number = isset($request['number']) ? html_entities($request['number']) : '';
if($number){
	$page_param['number']=$number;
	$select -> in('number',$number);
}
$keyword = isset($request['keyword']) ? html_entities(p8_html_filter($request['keyword'])) : '';
if(isset($request['keyword'])){
	$page_param['keyword']=$keyword;
	$select -> like('title',$core->DB_master->escape_string($keyword));
}
$username = isset($request['username']) ? html_entities($request['username']) : '';
if($username){
	$page_param['username']=$username;
	$select -> like('username',$username);
}
$status = isset($request['status']) ? intval($request['status']) : '-1';
if($status!=-1){
	$page_param['status']=$status;
	$select -> in('status',$status);
}
//不公开信件的显示模式
if($this_module->CONFIG['display_model'])
	$select -> in('undisplay',array(0,1));
else
	$select -> in('undisplay',0);
$rec = isset($request['rec']) ? 1 : '0';
//用户设置是否公开
$select -> in('visual',1);
//recommend
if(!empty($rec)){
	$page_param['rec']=1;
	$select -> in('recommend',1);
}
$select -> order(' id DESC');
$list = $core->list_item(
	$select,
	array(
		'page' => &$page,
		'count' => &$count,
		'page_size' => 20
	)
);
$cates = $this_module->get_category();
foreach($list as $key=>$row){
	$list[$key]['status_name'] = $P8LANG['status_'.$row['status']];
	$list[$key]['department_name'] = $cates['department'][$row['department']]['name'];
	$list[$key]['type_name'] = $cates['type'][$row['type']]['name'];
	$list[$key]['url'] = $this_router.'-view-id-'.$row['id'];
	$list[$key]['title_s'] = p8_cutstr($row['title'],44);
	$list[$key]['dp'] = $this_module->getdp($row);
}
$data['list'] = $list;
$data['count'] = $count;
exit(jsonencode($data));