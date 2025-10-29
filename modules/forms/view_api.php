<?php
defined('PHP168_PATH') or die();

/**
* 查看内容入口文件
**/
$data = $this_module->get_data($id);
if(empty($data)){
	$datas['error'] = $P8LANG['no_such_item'];
	exit(jsonencode($datas));
}
$mid = $data['mid'];
$ACTION = 'view';
if(!$this_module->set_model($mid)){
	$datas['error'] = $P8LANG['no_such_model'];
	exit(jsonencode($datas));
}
if(!$data['status'] || !$this_controller->check_model_action($ACTION,$mid)){
	$datas['error'] = $P8LANG['no_model_privilege'];
	exit(jsonencode($datas));
}
$data = $this_module->get_data($id,$this_model['name']);
if(empty($data)){
	$datas['error'] = $P8LANG['no_such_item'];
	exit(jsonencode($datas));
}
$this_module->format_data($data);
$this_module->format_view($data);
$data['fields'] = $this_model['fields'];
foreach($this_model['fields'] as $field => $v){
	switch($v['widget']){
		case 'checkbox':
		case 'multi_select':
			foreach($v['data'] as $value => $key){
				if(in_array($value, $data[$field])){
					$data[$field][] = $key;
				}
			}
		break;
		case 'select':
		case 'radio'://字段输入方式为：单选
			foreach($v['data'] as $value => $key){
				if($value == $data[$field]){
					$data[$field] = $key;
					break;
				}
			}
		break;
		case 'uploader'://字段输入方式为：上传器
			$data[$field]['url'] = $data[$field]['url'];
			$data[$field]['title'] = $data[$field]['title'];
		break;
		case 'image_uploader'://字段输入方式为：图片上传器
			$data[$field]['url'] = $data[$field]['url'];
			$data[$field]['thumb'] = $data[$field]['thumb'];
		break;
		case 'multi_uploader'://字段输入方式为：多上传器
			foreach($data[$field] as $vv){
				if(preg_match("/[.+](jpg|jpeg|gif|png|bmp)$/i",$vv['url'])){
					$data[$field]['url'][] = $vv['url'];
					$data[$field]['thumb'][] = $vv['thumb'];
				}else{
					$data[$field]['url'][] = $vv['url'];
					$data[$field]['title'][] = $vv['title'];
				}
			}
		break;
		case 'video_uploader'://字段输入方式为：视频上传器
			$data[$field] = $data['video_url'];
		break;
		case 'linkage'://多级联动
			$split= $temp_data = '';
			foreach($data[$field] as $k=>$vl){
				$temp_data .= $split.$vl;
				$split='&nbsp;&gt;&nbsp;';
			}
			$data[$field] = $temp_data;
		break;
		default://其它输入方式
			$data[$field] = $data[$field];
	}
}
$data['status'] = $this_module->CONFIG['status'];
if($data['uid']){
	$member = &$core->load_module('member');
	$data['member_info']=$member->get_member_info($data['uid']);
}
//模型自定义脚本
include $this_model['path'] .'view.php';
exit(jsonencode($data));
