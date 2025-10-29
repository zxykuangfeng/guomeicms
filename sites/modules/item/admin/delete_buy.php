<?php
defined('PHP168_PATH') or die();

/**
 * 删除广告
 */

$this_controller->check_admin_action('adsmanager') or message('no_privilege');
$this_module = $core->load_module('46');
$this_controller = $core->controller($this_module);

if(REQUEST_METHOD == 'POST'){
	$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
	$id or exit('[]');

	$this_module->delete_buy(array(
		'where' => 'id IN ('. implode(',', $id) .')'
	)) or exit('[]');
	
	exit(p8_json($id));
}
