<?php
defined('PHP168_PATH') or die();

/**
* 移动内容,只提供AJAX POST调用
**/

$this_system->check_manager($ACTION) or exit('[]');

if(REQUEST_METHOD == 'POST'){
	
	$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
	$id or exit('[]');
	
	$cid = isset($_POST['cid']) ? $_POST['cid'] : '';
	$cid or exit('[]');
	$clone_push_ids = $__id__ = $id;
	
	$clone_type = intval($_POST['clone_type']);
	$clone_time = $clone_type?$_POST['clone_time']:0;
	//$filter_word_enable = isset($_POST['filter_word_enable']) ? false : true;
	$filter_word_enable = false;
	//if(isset($_POST['verified'])){
	//	$verified = $_POST['verified'] == 1 ? true : false;
	//}else{
		$verified = true;
	//}
	$cids = explode(',',$cid);
	$cids = array_filter($cids);
	$clone_uid = $UID;
	foreach($cids as $_cid){
		$this_module->cloneitem($clone_push_ids, $_cid, $verified,$clone_time,$filter_word_enable,$clone_uid) or exit('[]');
		$this_module->html_list($_cid);	
	}
	$this_system->log(array(
		'title' => $P8LANG['_module_clone_admin_log'],
		'request' => $_POST,
	));
	exit(p8_json($__id__));
	
}
