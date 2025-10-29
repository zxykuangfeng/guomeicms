<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action('list') or message('no_privilege');
GetGP(array('id'));
$this_module->delete($id);
global $ADMIN_LOG,$ACTION;
$ACTION = 'delete';
$ADMIN_LOG = array('title' => $P8LANG['_module_delete_admin_log']);
message('done',$this_router.'-list');
