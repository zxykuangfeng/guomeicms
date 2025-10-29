<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action('item') or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$action = isset($_GET['action'])? $_GET['action'] : 'add';
	$iid = isset($_GET['iid'])? intval($_GET['iid']) : '';

	$data = array();
	if($action == 'update'){
		$id = isset($_GET['id'])? intval($_GET['id']) : '';
		$id or message(no_such_item);
		$data = $DB_master->fetch_one("SELECT * FROM $this_module->title_table WHERE id = '$id'");
		$data or message('no_such_item');
		$widgetdata = mb_unserialize($data['data']);
		$widget_data = array();
		foreach($widgetdata as $key=>$val){
			$key = html_decode_entities($key);
			if(is_array($val)){
				$val = array(html_decode_entities($val[0]),intval($val[1]));
			}else{
				$val = array(html_decode_entities($val),0);
			}
			$widget_data[$key] = $val;
		}
		
		
		$data['config'] = mb_unserialize($data['config']);
		if(!empty($data['part'])){
			list($data['part'],$data['part_row']) = explode("-",$data['part']);
		}
	
	}

	include template($this_module, 'edit_title', 'admin');

}else if(REQUEST_METHOD == 'POST'){
	$action = isset($_POST['action'])? $_POST['action'] : 'add';
	$iid = isset($_POST['iid'])? intval($_POST['iid']) : '';
	if($action == 'add'){
		$this_controller->add_title($_POST);
		global $ADMIN_LOG,$ACTION;
		$ACTION = 'add';
		$ADMIN_LOG = array('title' => $P8LANG['_module_add_admin_log']);
	}else if($action == 'update'){
		$id = isset($_POST['id'])? intval($_POST['id']) : '';
		$id or message('no_such_item');
		$this_controller->update_title($id,$_POST);
		global $ADMIN_LOG,$ACTION;
		$ACTION = 'update';
		$ADMIN_LOG = array('title' => $P8LANG['_module_update_admin_log']);
	}
	else if($action == 'delete'){
		$id = isset($_POST['id'])? intval($_POST['id']) : '';
		$id or message('no_such_item');
		$this_module->delete_title($id) or exit('0');	
		global $ADMIN_LOG,$ACTION;
		$ACTION = 'delete';
		$ADMIN_LOG = array('title' => $P8LANG['_module_delete_admin_log']);
		echo $id;
		exit;
	}
		
	message('done',$this_router.'-titles?iid='.$iid);	
}
