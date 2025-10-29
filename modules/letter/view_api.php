<?php
defined('PHP168_PATH') or die();

/**
* 查看内容入口文件
**/

$data = $this_module->getData($id,'all');
if(empty($data)){
	$data['error'] = $P8LANG['no_such_item'];
	exit(jsonencode($data));
}
foreach($data['data'] as $key=>$addon){
	if(!empty($addon['attachment'])){
		$data['data'][$key]['attachment']= attachment_url($addon['attachment']);
	}	
}
$data['username'] = setSecret($data['username'],'name');
$data['id_num'] = setSecret($data['id_num'],'tel');
$data['email'] = setSecret($data['email'],'email');
$data['address'] = setSecret($data['address'],'address');
$data['phone'] = setSecret($data['phone'],'tel');
$data['id_types'] = $this_module->id_type();
$data['cates'] = $this_module->get_category();
$data['comments'] = $this_module->get_comments();

exit(jsonencode($data));
