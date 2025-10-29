<?php
defined('PHP168_PATH') or die();

/**
* htmlize-CMS分类,只提供AJAX调用
**/

//$this_controller->check_admin_action($ACTION) or exit('[]');


if(REQUEST_METHOD == 'POST'){
	
	@set_time_limit(0);
	
	$id = isset($_POST['id']) ? intval($_POST['id']) : array();
	$htmlize = isset($_POST['htmlize']) ? intval($_POST['htmlize']) : 0;
	in_array($htmlize,array(0,1,2,20)) or exit('[]');
	if(isset($_POST['verified'])){
		$verified = $_POST['verified'] == 1 ? true : false;
	}else{
		$verified = true;
	}
	$id or exit('[]');
	if($id){
		$ids = array($id);
		if($verified)
			$this_module->get_cache();
		else
			$this_module->get_cache_recycle();		
		if($verified && isset($this_module->categories[$id]['categories'])){
			$ids = $this_module->get_children_ids($id) + $ids;
		}
		if(!$verified && isset($this_module->categories_recycle[$id]['categories'])){
			$ids = $this_module->get_children_ids_recycle($id) + $ids;
		}
	}
	$ret = $this_module->htmlize($ids,$htmlize,$verified) or exit('[]');
	
	if($verified)
		$this_module->cache();
	else
		$this_module->cache_recycle();
	if($ret)
		exit(jsonencode($ids));
	else
		exit('[]');	
}
