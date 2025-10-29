<?php
defined('PHP168_PATH') or die();
$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD=='GET'){

	$cates = $this_module->get_category();

	$config = $core->get_config('core', 'letter');

	include template($this_module,'config','admin');

}else if(REQUEST_METHOD=='POST'){
	
	$_POST = p8_stripslashes2($_POST);
	
	$department = isset($_POST['department'])? $_POST['department'] : array();
	$type = isset($_POST['type'])? $_POST['type'] : array();
	$delete = isset($_POST['delete'])? $_POST['delete'] : array();
	
	if(!empty($delete))
		$this_module->deleteCat($delete);
	$this_module->updatedepartment($department);
	$this_module->updateCat($type,2);

	$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();
	$config = p8_html_filter_array($config);
	$config['custom_a_enabled'] = isset($config['custom_a_enabled']) && $config['custom_a_enabled'] ? 1 : 0;
	$config['custom_b_enabled'] = isset($config['custom_b_enabled']) && $config['custom_b_enabled'] ? 1 : 0;
	$config['custom_c_enabled'] = isset($config['custom_c_enabled']) && $config['custom_c_enabled'] ? 1 : 0;
	$config['custom_d_enabled'] = isset($config['custom_d_enabled']) && $config['custom_d_enabled'] ? 1 : 0;
	$config['custom_e_enabled'] = isset($config['custom_e_enabled']) && $config['custom_e_enabled'] ? 1 : 0;
	$config['custom_a_not_null'] = isset($config['custom_a_not_null']) && $config['custom_a_not_null'] ? 1 : 0;
	$config['custom_b_not_null'] = isset($config['custom_b_not_null']) && $config['custom_b_not_null'] ? 1 : 0;
	$config['custom_c_not_null'] = isset($config['custom_c_not_null']) && $config['custom_c_not_null'] ? 1 : 0;
	$config['custom_d_not_null'] = isset($config['custom_d_not_null']) && $config['custom_d_not_null'] ? 1 : 0;
	$config['custom_e_not_null'] = isset($config['custom_e_not_null']) && $config['custom_e_not_null'] ? 1 : 0;	
	$this_module->set_config($config);
	global $ADMIN_LOG,$ACTION;
	$ACTION = 'config';
	$ADMIN_LOG = array('title' => $P8LANG['_module_config_admin_log']);
	message('done',$this_url);
}
