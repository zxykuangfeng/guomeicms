<?php
defined('PHP168_PATH') or die();

/**
* 删除, 只提供AJAX
**/

$this_system->check_manager($ACTION) or exit('[]');

if(REQUEST_METHOD == 'POST'){
	//过滤非数字
	$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
	$id or exit('[]');
	
	$verified = isset($_POST['verified']) && $_POST['verified'] == 1 ? true : false;
	
	$T = $verified ? $this_module->main_table : $this_module->unverified_table;
	/*签发源数据删除，签发数据同步删除*/
	$id = $this_module->get_clone_ids($id);
	$ret = $this_controller->delete(array(
		'where' => $T .'.id IN ('. implode(',', $id) .')',
		'verified' => $verified,
		'delete_hook' => empty($_POST['delete_hook']) ? false : true,
		'iid' => $id
	));
	//删除对接数据开始
	$info_iid = $core->DB_master->fetch_all("SELECT `iid` FROM $this_module->matrix_table WHERE sid IN (".implode(',', $id).")");	
	if($info_iid){
		$temp_iid = array();
		foreach($info_iid as $iid){
			$temp_iid[] = $iid['iid'];
		}
		$core->DB_master->delete($this_module->matrix_table, "sid IN (".implode(',', $id).")");
		$cms = $core->load_system('cms');
		$item = $cms->load_module('item');
		$cms_controller = $core->controller($item);		
		$cms_controller->delete(array(
			'where' => $item->main_table .'.id IN ('. implode(',', $temp_iid) .')',
			'verified' => true,
			'delete_hook' => true,
			'iid' => $temp_iid,
		));			
	}
	//删除对接数据结束
	$this_system->log(array(
		'title' => $P8LANG['_module_delete_admin_log'],
		'request' => $_POST,
	));
	//强制回归action本身
	$ACTION = 'delete';
	exit(jsonencode($ret));
}
exit('[]');
