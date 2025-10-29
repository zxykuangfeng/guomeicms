<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action('field') or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$action = isset($_GET['action'])? $_GET['action'] : 'add';
	$mid = isset($_GET['mid'])? intval($_GET['mid']) : '';
	$mid = $mid ? preg_replace('/[^0-9,]/', '', $mid) : '';
	$mid = $mid ? intval($mid) : '';
	$mid or message('no_such_model');
	
	$fid = isset($_GET['fid']) && $_GET['fid'] ? intval($_GET['fid']) : '';
	$fid = $fid ? preg_replace('/[^0-9,]/', '', $fid) : '';
	$fid = $fid ? intval($fid) : '';
	
	$iid = isset($_GET['iid']) && $_GET['iid'] ? $_GET['iid'] : '';
	$iid = $iid ? preg_replace('/[^0-9,]/', '', $iid) : '';
	$iid = $iid ? intval($iid) : '';	
	
	$this_module->set_model($mid) or message('no_such_model');
	$data = array();
	$data = $this_module->get_field($fid);
	$path = explode('-',$iid);
	$l = $iid ? count($path) : 0;
	$select = mb_unserialize($data['data']);
	$select_data = $this_controller->get_select_data($select['select_data'], $iid);
	$pid = substr($iid,0,strrpos($iid,'-'));
	include template($this_module, 'edit_linkage', 'admin');

}else if(REQUEST_METHOD == 'POST'){
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	$action = isset($_POST['action'])? $_POST['action'] : 'update';
	$mid = isset($_POST['mid']) ? intval($_POST['mid']) : '';
	$mid = $mid ? preg_replace('/[^0-9,]/', '', $mid) : '';
	$mid = $mid ? intval($mid) : '';
	$mid or message('no_such_model');
	$this_module->set_model($mid) or message('no_such_model');
	$fid = isset($_POST['fid']) && $_POST['fid'] ? intval($_POST['fid']) : '';
	$fid = $fid ? preg_replace('/[^0-9,]/', '', $fid) : '';
	$fid = $fid ? intval($fid) : '';
	$fid or message('no_such_item');
	$iid = isset($_POST['iid']) && $_POST['iid'] ? $_POST['iid'] : '';
	$iid = $iid ? preg_replace('/[^0-9,]/', '', $iid) : '';
	$iid = $iid ? intval($iid) : '';
	if($action == 'update'){		
		$this_controller->update_linkage($_POST);
	}
	elseif($action == 'delete'){
		$status = $this_controller->delete_linkage_item($_POST);
		echo json_encode($status);
		exit;
	}
		
	message('done',$this_url.'?mid='.$mid.'&fid='.$fid.'&iid='.$iid);	
}
