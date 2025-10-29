<?php
defined('PHP168_PATH') or die();

/**
* 移动内容,只提供AJAX POST调用
**/

$this_controller->check_action($ACTION) or exit('[]');

if(REQUEST_METHOD == 'POST'){
	$id = isset($_POST['sourceid']) ? filter_int($_POST['sourceid']) : array();
	$id or exit('[]');
	
	$cid = isset($_POST['cid']) ? $_POST['cid'] : '';
	$cid or exit('[]');
	$clone_push_ids = $__id__ = $id;
	
	$clone_type = intval($_POST['clone_type']);
	$clone_time = $clone_type?$_POST['clone_time']:0;
	//$filter_word_enable = isset($_POST['filter_word_enable']) ? false : true;
	$filter_word_enable = false;
	if(isset($_POST['verified'])){
		$verified = $_POST['verified'] == 1 ? true : false;
	}else{
		$verified = true;
	}
	$cids = explode(',',$cid);
	$cids = array_filter($cids);
    define('P8_CLUSTER',true);
    $mcid = array();
    $newids = '';
	$clone_uid = $UID;
	foreach($cids as $_cid){
		$_newids = $this_module->cloneitem($clone_push_ids, $_cid, $verified,$clone_time,$filter_word_enable,$clone_uid) or exit('[]');
        $newids .= $_newids.',';
		$this_module->html_list($_cid);	
		if(!empty($this_module->core->CONFIG['enable_mobile'])){
            $mcid[$_cid] = $_cid;
		}		
	}
    
    if(!empty($this_module->core->CONFIG['enable_mobile'])){
			$_GLOBALS['core']->ismobile=true;
			$this_module->core->ismobile=true;
			$newids = rtrim($newids,',');
			$this_module->html($core->DB_master->query("SELECT * FROM $this_module->main_table WHERE id IN ($newids)"));
            foreach($mcid as $__cid){
            $this_module->html_list($__cid,true);
            }
			$_GLOBALS['core']->ismobile=false;
			$this_module->core->ismobile=false;
	}
	exit(p8_json($__id__));
	
}
