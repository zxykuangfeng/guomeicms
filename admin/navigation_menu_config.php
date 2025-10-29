<?php
defined('PHP168_PATH') or die();
/**头部导航**/
$this_controller->check_admin_action('navigation_menu') or message('no_privilege');
if(REQUEST_METHOD == 'GET'){
	load_language($core, 'config');	
	$config = $core->get_config('core', '');
	include template($core, 'menu/navigation_menu_config', 'admin');	
}else if(REQUEST_METHOD == 'POST'){
	$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();	
	$orig_admin_controller = $core->CONFIG['admin_controller'];
	$config['ShowMenu']=empty($config['ShowMenu'])? 0 :1;
	$config['CoreMenu']=empty($config['CoreMenu'])? 0 :1;
	$config['MenuMode']=empty($config['MenuMode'])? 0 :1;
	$config['MenuModeHtml']=empty($config['MenuModeHtml'])? 0 :1;
	$core->set_config($config);	
	message('done',$this_url);
}
