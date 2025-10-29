<?php
defined('PHP168_PATH') or die();

/**
* 删除模型
**/

$this_controller->check_admin_action($ACTION) or exit('0');

if(REQUEST_METHOD == 'POST'){
	
	@set_time_limit(0);
	
	$name = isset($_POST['name']) ? $this_controller->valid_name($_POST['name']) : '';
	$name or exit('0');
	//文章模型不能删除
	if($name == 'article') exit('0');
	
	$Cate = $this_system->load_module('category');
	$Cate->get_cache(false);
	foreach($Cate->categories as $v){
		if($v['model']==$name){
			exit('more cate has this model');
		}
	}
	
	$this_controller->delete($name) or exit('0');
	
	exit('1');
}
