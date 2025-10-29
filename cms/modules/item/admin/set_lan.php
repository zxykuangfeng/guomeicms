<?php
defined('PHP168_PATH') or die();

/**
* 局域网化设置
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	load_language($core, 'config');
	$config = $core->get_config($this_system->name, $this_module->name);
	
	$config['lan_date'] = isset($config['lan_date']) && $config['lan_date'] ? date('Y-m-d H:i:s',$config['lan_date']) : '';
	$config['lan_date_enable'] = isset($config['lan_date_enable']) && $config['lan_date_enable'] ? 1 : 0;
	load_language($core, 'config');
	
	include template($this_module, 'set_lan', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	@set_time_limit(0);
	@ignore_user_abort(true);
	
	load_language($core, 'config');	
	require_once PHP168_PATH .'inc/cache.func.php';
	
	$type = isset($_POST['type']) ? $_POST['type'] : 'all';
	switch($type){	
		case 'config':
			$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();
			$config['lan_date_enable'] = isset($config['lan_date_enable']) && $config['lan_date_enable'] ? 1 : 0;
			$config['lan_date'] = isset($config['lan_date']) && $config['lan_date'] ? strtotime($config['lan_date']) : 0;
			$this_module->set_config($config);
		break;
		
		case 'html_init':
			$config = $core->get_config($this_system->name, $this_module->name);
			$config['lan_date'] = isset($config['lan_date']) && $config['lan_date'] ? intval($config['lan_date']) : 0;
			$config['lan_date_enable'] = isset($config['lan_date_enable']) && $config['lan_date_enable'] ? true : false;
			if($config['lan_date_enable'] && $config['lan_date']) {
				$this_module->set_content_html();
			}else{
				message('set_lan_err');
			}
		break;
		
		case 'unlan':
			$this_module->unset_content_html();			
		break;
		
		case 'label':
			cache_label();
		break;
	
	}
	
	message('done');

}
