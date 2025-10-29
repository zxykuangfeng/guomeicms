<?php
defined('PHP168_PATH') or die();

/**
 * 删除消息,POST提供ajax调用,GET提供批量删除功能
 **/

if(REQUEST_METHOD == 'POST'){
	$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
	$deleteall = isset($_POST['deleteall']) ? true : false;
	
	if(!$deleteall) $id or exit('[]');

	$type = isset($_POST['type']) && $_POST['type'] == 'out' ? 'out' : 'in';
	$types = isset($_POST['type']) ? $_POST['types'] : '';
	switch($types){
		case 'new':
			$where = "type = 'in' and new = 1";			
		break;
		
		case 'nonew':
			$where = "type = 'in' and new != 1";				
		break;
		
		case 'public':
			$where = "type = 'in' and sender_uid = 0";
			
		break;
		
		case 'private':
			$where = "type = 'in' and sender_uid != 0";			
		break;
		
		case 'rubbish':
			$where = "type = 'rubbish' and sender_uid != 0";
		break;
		
		case 'important':
			$where = "type = 'important'";
		break;
		
		default:
			$where = "type = 'in'";
	}
	if($deleteall){
		$where .= ' AND '. ($type == 'in' ? 'sendee_uid' : 'sender_uid') .' = \''. $UID .'\'';

		//只能删除自己的
		if(
			$this_module->delete(array(
				'where' => "$where"
			))
		){
			exit(jsonencode($id));
		}
	}else{
		$and = ' AND '. ($type == 'in' ? 'sendee_uid' : 'sender_uid') .' = \''. $UID .'\'';

		//只能删除自己的
		if(
			$this_module->delete(array(
				'where' => "id IN (". implode(',', $id) .")$and"
			))
		){
			exit(jsonencode($id));
		}
	}
}

exit('[]');
