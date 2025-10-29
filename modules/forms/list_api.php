<?php
defined('PHP168_PATH') or die();

/**
* 列表页
**/
$data = array();
$_GET = p8_stripslashes2($_GET);
$mid = 0;
$page = 1;
$mid = isset($_GET['mid'])? intval($_GET['mid']): 0;
$page = isset($_GET['page'])? intval($_GET['page']): 1;
foreach($URL_PARAMS as $k => $v){ 
	switch($v){
		case 'mid':
			$mid = isset($URL_PARAMS[$k +1]) ? intval($URL_PARAMS[$k +1]) : 0;
			$PAGE_CACHE_PARAM['mid'] = $mid;
		break;
		case 'page':
			$page = isset($URL_PARAMS[$k +1]) ? intval($URL_PARAMS[$k +1]) : 1;
			$page = max($page, 1);
		break;
	}
}
if(!$mid){
	$select = select();
	$select -> from($this_module->model_table,'*');
	$select -> order('display_order DESC, id DESC');
	$list = $core->select($select);
	include template($this_module, 'select_model');
	exit;
}
if($mid == '199' || !$this_module->set_model($mid)){
	$data['error'] = $P8LANG['no_such_model'];
	exit(jsonencode($data));
}
$import_list = $this_controller->check_model_action('import_list',$mid);
$manage = $this_controller->check_model_action('manage',$mid);

//搜索开始
$count = 0;
$select = select();
$select -> from("$this_module->table as i",'i.*');
$select -> left_join("$this_module->data_table as d",'d.*','i.id=d.id');
$select -> in('i.mid',$mid);
if($this_model['verified'] != '')$select -> in('i.status',explode(",",$this_model['verified']));
if($this_model['recommend'] == '1')$select -> in('i.recommend',1);
//搜索条件
$mindate = isset($_GET['mindate']) ? $_GET['mindate'] : '';
if($mindate){
	$select -> range('i.timestamp',strtotime($mindate));
}
$maxdate = isset($_GET['maxdate']) ? $_GET['maxdate'] : '';
if($maxdate){
	$select -> range('i.timestamp',null,strtotime($maxdate));
}
$username = isset($_GET['username']) ? p8_addslashes(html_entities2($_GET['username'])) : '';
if($username){
	$select -> in('i.username',$username);	
}
$selectstatus = isset($_GET['selectstatus']) ? p8_addslashes(html_entities2($_GET['selectstatus'])) : '';

if($selectstatus!=''){
	$selectstatus = intval($selectstatus);
	$select -> in('i.status',$selectstatus);
}
if(!empty($mindate) || !empty($maxdate) || !empty($username) || !empty($selectstatus)){
	$this_controller->check_action('search') or message('no_privilege');
}
//自定义字段过滤
$F = isset($_GET['field#']) ? $_GET['field#'] : array();
$F || $F=$_GET;
foreach($this_model['filterable_fields'] as $field=>$field_data){
	if(!empty($F[$field])){
		$this_controller->check_action('search') or message('no_privilege');
		if($field_data['widget']=='text'){
			$data[$field] = html_entities2($F[$field]);
			if($field_data['CONFIG']['filter_type'])
				$select -> in("d.$field",p8_addslashes($F[$field]));
			else
				$select -> like("d.$field",p8_addslashes($F[$field]));
		}elseif($field_data['widget']=='radio' || $field_data['widget']=='select' || $field_data['widget']=='city'){
			$data[$field] =  html_entities2($F[$field]);
			$select -> in("d.$field",p8_addslashes($F[$field]));
		}elseif($field_data['widget']=='checkbox' || $field_data['widget']=='multi_select'){
			if(!empty($F[$field])){
			if(!is_array($F[$field]))
				$F[$field] = explode('-',$F[$field]);
				$split = '';
				foreach($F[$field] as $v){
					if(array_key_exists($v,$field_data['data'])){
						$data[$field][] = $v;
						$select -> like("d.$field",p8_addslashes($v));
						$split = '-';
					}	
				}
			}
		}elseif($field_data['widget']=='linkage'){
			foreach($F[$field] as $k=>$vl){
					if($vl)
					$data[$field] = $vl;
			}
			if($data[$field]){
				$select -> like("d.$field",p8_addslashes($data[$field]),'left');
			}
		}
	}
}

$select -> order('i.display_order DESC, i.id DESC');
//echo $select->build_sql();	
$list = $core->list_item(
	$select,
	array(
		'page' => &$page,
		'count' => &$count,
		'page_size' => 20
	)
);
foreach($list as $key=>$detail){
	$this_module->format_data($list[$key],80);
	$this_module->format_view($list[$key]);
	$detail['model_name'] = $this_model['name'];
	$list[$key]['url'] = p8_url($this_module,$detail,'view');
	if(!empty($this_model['CONFIG']['viewhash']))$list[$key]['url'] .= (strpos($list[$key]['url'],'?')===false?'?':'&').'viewcode='.p8_code($detail['id'].'_'.P8_TIME);
}
$_SERVER['REQUEST_URI'] = xss_url($_SERVER['REQUEST_URI']);
//模型自定义脚本
include $this_model['path'] .'list.php';
$data['list'] = $list;
$data['count'] = $count;
exit(jsonencode($data));