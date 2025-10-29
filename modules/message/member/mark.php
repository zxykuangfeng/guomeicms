<?php
defined('PHP168_PATH') or die();

/**
* 读信息
**/

$id = $id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
$id or message('[]');
$type = isset($_POST['type']) && in_array($_POST['type'], array('in','out','rubbish','draft','important'))? $_POST['type'] : 'read';


$select = select();
$select->from($this_module->table .' AS m', 'm.*');
$select->in('m.id', $id);
$data = $core->select($select, array('single' => true));
$data or message('[]');
$ids = implode(',',$id);
switch($type){
	case 'read':
		//标记为己读
		$DB_master->update(
			$this_module->table,
			array('new' => 0),
			"id in ($ids) AND sendee_uid = '$UID'"
		);
		//减少未读信息数
		$DB_master->update(
			$core->member_table,
			array('new_messages' => 'new_messages -'.count($id)),
			"id = '$UID'",
			false
		);
	break;
	case 'important':
		//标记为重点
		$DB_master->update(
			$this_module->table,
			array('type'=> $type),
			"id in ($ids) AND sendee_uid = '$UID'"
		);
	break;
	case 'in':
		//标记为重点
		$DB_master->update(
			$this_module->table,
			array('type'=> $type),
			"id in ($ids) AND sendee_uid = '$UID'"
		);
	break;	
}
exit(p8_json($id));