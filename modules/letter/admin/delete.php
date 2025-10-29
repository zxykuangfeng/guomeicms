<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action('list') or exit('[]');

if(REQUEST_METHOD == 'POST'){
	$id =  isset($_POST['id']) ? filter_int($_POST['id']) : array();		
	$oid = isset($_POST['oid']) ? intval($_POST['oid']) : '';
	if(!$id && !$oid) exit('[]');
	$realarray = $oid ? array($oid) : $id;	
	$resule = $this_module->delete(array('ids' => $realarray));	
	global $ADMIN_LOG,$ACTION;
	$ACTION = 'delete';
	$ADMIN_LOG = array('title' => $P8LANG['_module_delete_admin_log']);
	exit(p8_json($resule));
}

exit('[]');