<?php
defined('PHP168_PATH') or die();

/**
* 查看内容
**/
$this_system->check_manager($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	
	$select = select();
	$select->from($this_module->table, '*');
	$select->in('id', $id);
	
	$_data = $core->select($select, array('single' => true));
	$_data['data'] = mb_unserialize($_data['data']);
	$data = &$_data['data'];
	include template($this_module, 'view', 'admin');
}
