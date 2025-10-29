<?php
defined('PHP168_PATH') or die();

/**
* 数据过滤
**/

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


//是否开启sphinx搜索功能
!empty($option['sphinx']) && $option['sphinx']['enabled'] = 1;

//分类
$option['category'] = empty($option['category']) ? array() : $option['category'];
//删除被删除的分类
foreach($option['category'] as $key=>$sid){
	if(empty($this_system->fetch_category($sid,true))) unset($option['category'][$key]);
}
!empty($option['category']) or message("请填写栏目ID或选择显示哪个栏目");

$_POST['invoke'] = '$label['. $_POST['name'] .']';
$invoke = array();


if(!empty($option['category'])){

	$option['category'] = preg_replace('/[^0-9,]/', '', $option['category']);
	//多余的,
	$option['category'] = filter_int(explode(',', $option['category']));


}


//角色浏览权限，以字符串存储
$option['authority'] = isset($option['authority']) && !in_array('0',$option['authority']) ? implode(",", $option['authority']) : '';

$_POST['option'] = $option;		//选项
