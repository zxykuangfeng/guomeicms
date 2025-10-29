<?php
defined('PHP168_PATH') or die();

$this_controller->check_action('manage') or message($P8LANG['no_privilege']);

if(REQUEST_METHOD == 'GET'){

	$id = intval($_GET['id']);
	/*
	非超管，不是自己创建的不能删除
	*/
	if(!$IS_FOUNDER) {
		$select = select();
		$select->from($this_module->table, '*');
		$select->in('id', $id);
		$select-> in('uid',$UID);	
		$rsdb = $core->select($select, array('single' => true, 'ms' => 'master'));
		if($rsdb['uid'] != $UID) message($P8LANG['no_privilege']);
	}	
	if($id && $this_module->get_item($id)){
		$this_module->delete_item($id);
		message('done');
	}	
}
