<?php
defined('PHP168_PATH') or die();

$this_system->check_manager($ACTION) or message('no_privilege');
GetGP(array('id'));
$this_module->delete(array('ids'=>array($id)));
$this_system->log(array(
		'title' => $P8LANG['_module_delete_admin_log'],
		'request' => $_POST,
	));
message('done',$this_router.'-list');
