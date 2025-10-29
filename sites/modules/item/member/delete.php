<?php
defined('PHP168_PATH') or die();

	//过滤非数字
	$id = isset($_REQUEST['id']) ? filter_int($_REQUEST['id']) : array();
	$id or exit('[]');
	$delete = isset($_REQUEST['verified']) && $_REQUEST['verified'] == 88 ? true : false;
	$verified = isset($_REQUEST['verified']) && $_REQUEST['verified'] != 1 ? false : true;

	$T = $verified ? $this_module->main_table : $this_module->unverified_table;
	if($verified){
		$data = $this_module->data('read', $id[0]);
		$data or message('no_such_item');
	}else{
		
		$select = select();
		$select->from($this_module->unverified_table, 'data');
		$select->in('id', $id);
		$_data = $core->select($select, array('single' => true));
		$_data or message('no_such_item');
		
		$_data = mb_unserialize($_data['data']);
		$data = array_merge($_data['addon'], $_data['item'], $_data['main']);
		
	}
	//检查分类权限
	if(!$this_controller->check_category_action('delete', $data['cid'])){
		if($data['uid'] != $UID || $data['uid'] == $UID && $data['verified']) P8_AJAX_REQUEST? exit(jsonencode('no_category_privilege')) : message('no_category_privilege');
	}	
	if($delete){
		$ret = $this_controller->delete(array(
			'where' => $T .'.id IN ('. implode(',', $id) .')',
			'verified' => $verified,
			'delete_hook' => empty($_REQUEST['delete_hook']) ? false : true,
			'iid' => $id
		));
	}else{
		/*签发源数据删除，签发数据同步删除*/	
		$id = $this_module->get_clone_ids($id);
		$ret = $this_controller->verify(array(
			'where' => $T .'.id IN ('. implode(',', $id) .')',
			'value' => 88,
			'verified' => $verified,
			'push_back_reason' => ''
		));
	}
	//强制回归action本身
	$ACTION = 'delete';
	P8_AJAX_REQUEST? exit(jsonencode($id)) : message('done');

