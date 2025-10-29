<?php
defined('PHP168_PATH') or die();
$this_controller->check_action('manager') or message('no_privilege');

$id= intval($_GET['id']);
$data = $this_module->getData($id);
$this_controller->check_manage($data['department'],$data['type']) or	message('no_privilege');
	
$param = array('ids'=>array($id));
$this_moduel->delete($param);

message(
	array(
				array('to_list', $this_router .'-manager'),
				array('colsed', "javascript:window.close();"),
			),
			$this_router .'-manager',
			3000
		);

?>
