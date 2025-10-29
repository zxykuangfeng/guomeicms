<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$mid = isset($_GET['mid'])? intval($_GET['mid']) : '';
	$this_module->set_model($mid) or message('no_such_model');
	$model_info = $this_module->get_model($mid,true);
	$model_config = mb_unserialize($model_info['config']);
	$select = select();
	$select->from($this_module->field_table, '*');
	$select->in('model', $this_module->MODEL);
	$select->order('display_order DESC');

	$list = $core->list_item(
		$select,
		array(
			'page_size' => 0,
			'ms' => 'master'
		)
	);
	foreach($list as $key=>$val){
		if(!empty($val['part'])){
			list($val['part'],$val['part_row']) = explode("-",$val['part']);
			$list[$key]['part_name'] = $model_config['parts'][$val['part']]['name'] ? $model_config['parts'][$val['part']]['name'] : '';
		}
	}
	include template($this_module, 'field', 'admin');

}else if(REQUEST_METHOD == 'POST'){
	//批量修改字段的排序
	$display_order = isset($_POST['_display_order']) && is_array($_POST['_display_order']) ? array_map('intval', $_POST['_display_order']) : array();
	
	foreach($display_order as $id => $order){
		$DB_master->update(
			$this_module->field_table,
			array(
				'display_order' => $order
			),
			"id = '$id'"
		);
	}
	
	$this_module->cache(isset($_POST['mid']) ? $_POST['mid'] : '');
	
	message('done',$this_router.'-field?mid='.$_POST['mid']);
	

}
