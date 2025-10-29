<?php
defined('PHP168_PATH') or die();

/**
* 修改核心配置
**/

$this_controller->check_admin_action('config') or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	load_language($core, 'config');

	$config = html_entities($core->get_config('core', ''));
	$config['logo'] = isset($config['logo']) && $config['logo'] ? attachment_url($config['logo'],false,true):'';
	$config['logo_1'] = isset($config['logo_1']) && $config['logo_1'] ? attachment_url($config['logo_1'],false,true):'';
	$config['logo_2'] = isset($config['logo_2']) && $config['logo_2'] ? attachment_url($config['logo_2'],false,true):'';
	$config['logo_3'] = isset($config['logo_3']) && $config['logo_3'] ? attachment_url($config['logo_3'],false,true):'';
	$config['logo_slogan'] = isset($config['logo_slogan']) && $config['logo_slogan'] ? attachment_url($config['logo_slogan'],false,true):'';
	$config['logo_background'] = isset($config['logo_background']) && $config['logo_background'] ? attachment_url($config['logo_background'],false,true):'';
	$config['logo_core'] = isset($config['logo_core']) && $config['logo_core'] ? attachment_url($config['logo_core'],false,true):'';
	$config['logo_sites'] = isset($config['logo_sites']) && $config['logo_sites'] ? attachment_url($config['logo_sites'],false,true):'';
	$config['logo_sso'] = isset($config['logo_sso']) && $config['logo_sso'] ? attachment_url($config['logo_sso'],false,true):'';
	$config['logo_sso_banner'] = isset($config['logo_sso_banner']) && $config['logo_sso_banner'] ? attachment_url($config['logo_sso_banner'],false,true):'';
	$core->get_cache('credit');
	$file = PHP168_PATH .'template/'.$config['template'].'/cms/index.html';
	$data = read_file($file);
	$site_bar = strpos($data,"CONFIG['site_bar']");	
	$win_pos = strpos($data,"CONFIG['msg_win']");
	
	$file = PHP168_PATH .'template/'.$config['template'].'/core/header.html';
	$data = read_file($file);
	$gray_pos = strpos($data,"CONFIG['site_gray']");
	include template($core, 'config/base_config', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$_POST = p8_stripslashes2($_POST);
	
	$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();
	$statistics = $config['statistics'];
	$config = p8_html_filter($config);
	$config['site_name'] =  htmlspecialchars($config['site_name']);
	$config['site_key_word'] =  htmlspecialchars($config['site_key_word']);	
	$config['statistics'] = $statistics;
	$orig_admin_controller = $core->CONFIG['admin_controller'];
	
	$core->set_config($config);
	
	//如果有修改后台入口
	if(!empty($config['admin_controller']) && $config['admin_controller'] != $orig_admin_controller){
		$config['admin_controller'] = basename($config['admin_controller']);
		
		//复制一个后台入口文件,更新好缓存之后最后删除原本后台入口文件
		is_file(PHP168_PATH . $config['admin_controller']) or copy(PHP168_PATH . $orig_admin_controller, PHP168_PATH . $config['admin_controller']);
		
		//并且更新菜单缓存
		require PHP168_PATH .'inc/cache.func.php';
		
		cache_admin_menu();
		unlink(PHP168_PATH . $orig_admin_controller);
	}
	
	message('done',$this_url);
}
