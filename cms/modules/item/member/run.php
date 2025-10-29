<?php
defined('PHP168_PATH') or die();

/**
* 手动执行计划任务
**/

//$this_controller->check_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'POST'){
	$crontab = $core->load_module('crontab');
	$select = select();
	$select->from($crontab->table, '*');
	$select->like('script', 'cms_list_to_html.php?');
	$data = $core->select($select, array('single' => true));
	$data or exit(p8_json(array('action'=>'no_such_item')));
	
	$ADMIN_LOG = array('title' => $P8LANG['run_crontab']);	
	$crontab_id = $id = $data['id'];
	require $crontab->path .'inc/run.php';
	echo p8_json(array('action'=>'done'));
	//message('done', HTTP_REFERER, 3);
}
