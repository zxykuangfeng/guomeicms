<?php
defined('PHP168_PATH') or die();

/**
* 数据过滤,将option中的选项存到数据库,同时也作SQL解析用
**/

if($action == 'explain'){
	$_POST = p8_stripslashes2(from_utf8($_POST));
}

//作用域
$system = isset($_POST['system']) ? $_POST['system'] : '';
$module = isset($_POST['module']) ? $_POST['module'] : '';

$MODEL = empty($MODEL) ? '' : $MODEL;


if($system != 'core' && !get_system($system)){
	message('no_such_system');
}

if($module && !get_module($system, $module)){
	message('no_such_module');
}

//数据源模块信息
$_POST['source_system'] = $this_system->name;
$_POST['source_module'] = $this_module->name;
//标签类型为模块数据
$_POST['type'] = 'module_data';

$controller = &$core->controller($LABEL);

$option = isset($_POST['option']) && is_array($_POST['option']) ? $_POST['option'] : array();

//标签通用部分,把验证好的数据覆盖原来的数据
$option = $controller->valid_module_data_option($option) + $option;
unset($option['order_by_desc']);
$option['var_fields'] = array();

//当前模型
$option['model'] = $MODEL;



//是否开启sphinx搜索功能
!empty($option['sphinx']) && $option['sphinx']['enabled'] = 1;


$option['fields'] = isset($option['fields']) && is_array($option['fields']) ? $option['fields'] : array();

//开始构造select
$select = select();
	
$select->from($this_module->table .' AS i', 'i.*');
$select->inner_join($this_module->data_table .' AS a', 'a.*', 'a.id = i.id');
if($option['status'] !=''){
	$select->in('i.status',$option['status']);
 }else{
	unset($option['status']);
 }
if($option['recommend'] >=0){
	$select->in('i.recommend',$option['recommend']); 
}
if($option['date']>0){
	if($option['date'] == 1){
		//获取今日开始时间戳和结束时间戳  
		$begintime=mktime(0,0,0,date('m'),date('d'),date('Y')); 
		$endtime=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
	}elseif($option['date'] == 2){
	//获取近3天起始时间戳和结束时间戳  
		$begintime=mktime(0,0,0,date('m'),date('d')-2,date('Y'));
		$endtime=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
	}elseif($option['date'] == 3){
		//获取近7天起始时间戳和结束时间戳  
		$begintime=mktime(0,0,0,date('m'),date('d')-6,date('Y'));
		$endtime=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
	}elseif($option['date'] == 4){ 
		//获取本周起始时间戳和结束时间戳   
		$begintime = mktime(0,0,0,date('m'),date('d')-date('w')+1,date('y'));
		$endtime=mktime(0,0,0,date('m'),date('d')-date('w')+7,date('y'));
	}elseif($option['date'] == 5){ 
		//获取本月起始时间戳和结束时间戳  
		$begintime=mktime(0,0,0,date('m'),1,date('Y'));
		$endtime=mktime(23,59,59,date('m'),date('t'),date('Y'));
	}elseif($option['date'] == 6){ 
		$begintime = strtotime(date("Y",time())."-1"."-1"); //本年开始  
		$endtime = strtotime(date("Y",time())."-12"."-31"); //本年结束 
	}
	if($begintime && $endtime) $select->range('a.date',$begintime,$endtime);
}
//只调用要显示的数据
$select->in('i.display',0);
//排序
$str = $comma = '';
foreach($option['order_by'] as $field => $desc){
	if(!isset($order_bys[$field])) continue;
	
	$str .= $comma . $field .($desc ? ' DESC' : ' ASC');
	$comma = ',';
}

if($str){
	$select->order($str);
	$option['order_by_string'] = $str;
}

//审核
$verified = isset($option['verified'])? intval($option['verified']) : 1;
$verified = in_array($verified,array(0,1,2,3,88,-99)) ? $verified : 1; 
if($verified == 3){
	$select->in('i.verified', array(2,0));
}else{
	$select -> in('i.verified',$verified);
}
//限制
$select->limit(0, $option['limit']);


$_POST['option'] = $option;		//选项
