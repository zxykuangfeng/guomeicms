<?php
defined('PHP168_PATH') or die();

/**
* 积分类型列表
**/
$this_controller->check_admin_action($ACTION) or message('no_privilege');
load_language($core, 'config');
$system = isset($_GET['system']) ? trim($_GET['system']) : '';
$credit_id = isset($_GET['credit_id']) ? intval($_GET['credit_id']) : 0;
$credit_level = isset($_GET['credit_level']) ? intval($_GET['credit_level']) : 0;
$start_date = isset($_GET['start_date'])? trim($_GET['start_date']) : '';
$end_date = isset($_GET['end_date'])? trim($_GET['end_date']) : '';
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$keyword = $keyword ? $keyword : (isset($_GET['word']) ? trim($_GET['word']) : '');
$username = isset($_GET['username']) ? trim($_GET['username']) : '';
$name = isset($_GET['name']) ? trim($_GET['name']) : '';
$setter = isset($_GET['setter']) ? trim($_GET['setter']) : '';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max(1, $page);

//system
$systems = $core->list_systems();
$cms_item_config = $core->get_config('cms','item');
$score_levels = !empty($cms_item_config['score_level']) ? $cms_item_config['score_level'] : array();
$levels = array();
foreach($score_levels as $score_level){
	$levels[$score_level['code']] = $score_level['name'];
}
$select_credit = select();
$select_credit->from($this_module->table, '*');
$credit_list = $core->list_item($select_credit);
$credit_type = array();
foreach($credit_list as $credit){
	$credit_type[$credit['id']] = $credit['name'];
}
$credit_json = jsonencode($credit_id);
if(!P8_AJAX_REQUEST){
	$allow_delete = $this_controller->check_admin_action('delete');
	include template($this_module, 'credit_log', 'admin');
	exit;
}else{
	$keyword = from_utf8($keyword);
	$username = from_utf8($username);
}

$page_url = $this_url .'?';
$page_url = 'javascript:request_item(?page?)';

$count = 0;
$select = select();
$select->from($this_module->log_table.' AS i', 'i.*');
$select->left_join($core->TABLE_.'member AS m', 'm.name,m.username', 'm.id = i.uid');
if(strlen($keyword)){
	$select->in('i.username', $keyword);
}
if($system){
	$select->in('i.system', $system);
}
if($credit_id){
	$select->in('i.credit_id', $credit_id);
	if($credit_level) $select->in('i.credit', $credit_level);
}
if($name){
	$select->in('m.name', $name);
}
if($username){
	$select->in('m.username', $username);
}
if($start_date || $end_date){
	$select->where_and();
	$starttime_r = $start_date == '' ? 0 : strtotime(trim($start_date));
	$endtime_r = $end_date == '' ? 4070880000 : strtotime(trim($end_date));
	$select->range('i.timestamp', $starttime_r, $endtime_r);
}
$select->order('id desc');
//echo $select->build_sql();
$page_size = 20;
$count = 0;
//取数据
$list = $core->list_item(
	$select,
	array(
		'page' => &$page,
		'count' => &$count,
		'page_size' => $page_size,
		'ms' => 'master',		
	)
);
foreach($list as $key=>$item){
	$list[$key]['system'] = $item['system'] && $systems[$item['system']]['alias'] ? $systems[$item['system']]['alias'] : $item['system'];
	$list[$key]['module'] = $systems[$item['system']]['modules'][$item['module']]['alias'] ? $systems[$item['system']]['modules'][$item['module']]['alias'] : $item['module'];
	$list[$key]['url'] = '';
	if($item['system'] && $item['system'] == 'sites' && $item['site'] && $item['iid'])
		$list[$key]['url'] = $core->controller .'/../s.php/'.$item['site'].'/item-view-id-'.$item['iid'].'?verified=1';
	if($item['system'] && $item['system'] != 'sites' && $item['iid'])
		$list[$key]['url'] = $core->controller .'/'.$item['system'].'/item-view-id-'.$item['iid'].'?verified=1';
	$list[$key]['credit_id'] = isset($credit_type[$item['credit_id']]) ? $credit_type[$item['credit_id']] : $item['credit_id'];
	$list[$key]['credit'] = $item['credit_id'] == 3 && $levels[$item['credit']] ? $levels[$item['credit']] : $item['credit'];	
}
echo p8_json(array(
	'list' => $list,
	'pages' => list_page(array(
		'count' => $count,
		'page' => $page,
		'page_size' => $page_size,
		'url' => $page_url
	)),
	'time' => get_timer() - $P8['start_time']
));
exit;