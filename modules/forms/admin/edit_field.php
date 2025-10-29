<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action('field') or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$action = isset($_GET['action'])? $_GET['action'] : 'add';
	$mid = isset($_GET['mid'])? intval($_GET['mid']) : '';
	$this_module->set_model($mid) or message('no_such_model');
	$data = array();
	$core->get_cache('role');
	if($action == 'update'){
		$id = isset($_GET['id'])? intval($_GET['id']) : '';
		$id or message(no_such_item);
		$data = $DB_master->fetch_one("SELECT * FROM $this_module->field_table WHERE id = '$id'");
		$data or message('no_such_item');
		$widgetdata = mb_unserialize($data['data']);		
		$widget_data = array();
		foreach($widgetdata as $key=>$datas){
			$key = html_decode_entities($key);
			if(is_array($datas)){
				$val = html_decode_entities($datas['0']);
				$note = html_decode_entities($datas['1']);
				$widget_data[$key] = array($val,$note);
			}else{
				$val = html_decode_entities($datas);
				$widget_data[$key] = $val;
			}			
		}
		
		$data['config'] = mb_unserialize($data['config']);
		if(!empty($data['part'])){
			list($data['part'],$data['part_row']) = explode("-",$data['part']);
		}
		$fields = $DB_master->fetch_all("SELECT * FROM $this_module->field_table WHERE model = '".$this_module->MODEL."' AND list_table = '1'");
		
	}
	
	$data['model']  = $this_module->MODEL;
	$parts = !empty($this_model['CONFIG']['parts'])? $this_model['CONFIG']['parts'] : array();
	$parts_json = p8_json($parts);
		
	include template($this_module, 'edit_field', 'admin');

}else if(REQUEST_METHOD == 'POST'){
	$action = isset($_POST['action'])? $_POST['action'] : 'add';
	$mid = isset($_POST['mid'])? intval($_POST['mid']) : '';
	$this_module->set_model($mid) or message('no_such_model');
	if($action == 'add')
		$id = $this_controller->add_field($_POST);
	elseif($action == 'update'){
		$id = isset($_POST['id'])? intval($_POST['id']) : '';
		$id or message('no_such_item');
		$this_controller->update_field($id,$_POST);		
	}
	elseif($action == 'delete'){
		$id = isset($_POST['id'])? intval($_POST['id']) : '';
		$id or message('no_such_item');
		$this_module->delete_field($id) or exit('0');
		echo $id;
		exit;
	}
	message(
		array(
			array('forms_to_edit', $this_router .'-edit_field?action=update&mid='.$mid.'&id='.$id),
			array('forms_to_list', $this_router .'-field?mid='.$mid),
			array('forms_to_add', $this_router .'-edit_field?mid='.$mid)
		),
		$this_router .'-field?mid='.$mid,
		10000
	);
}
