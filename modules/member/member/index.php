<?php
defined('PHP168_PATH') or die();

require_once $this_module->path .'inc/menu.class.php';

$member_menu->get_cache();
//菜单JSON
$json = $CACHE->read('core/modules', 'member', 'menu_json');
//被禁止菜单的JSON
if($IS_FOUNDER){
	$denied = '{}';
}else{

	if(($site == get_cookie('site')) && 'mainstation'!=$site){
		$denied = $CACHE->read('core/modules', 'member', 'menu_json_role_'. $core->ROLE.'_'.$site);
	}elseif(empty($denied)) {
        $denied = $CACHE->read('core/modules', 'member', 'menu_json_role_' . $core->ROLE);
    }
	!empty($denied) || $denied = '{}';
}
//被禁止菜单的JSON
$denied = '{}';
$this_module->set_model($ROLE_GROUP);
$data = $this_module->get_member_info($UID);

$message = $core->load_module('message');
$message->my_message();
//模块有设置用自己的,没有则用原来的
if(isset($message->CONFIG['windows_allow'])){
	$windows_allow = $message->CONFIG['windows_allow'] ? true : false;
}else{
	$windows_allow = $this_module->CONFIG['windows_allow'] ? true : false;
}
$reflash_index = $genrate_html = $list_to_html = false;
//检测菜单显示权限
$menu_button = false;
$systems = $core->list_systems();
$manage_sites = array();
if(isset($systems['sites']) && $systems['sites']['enabled']){
	$sites_system = $core->load_system('sites');
	$manage_sites = $sites_system->get_manage_sites();
	if($site && $site != 'mainstation'){
		$sites_system->load_module('farm')->cache($site);
	}
}
if($menu_flag && isset($systems['sites']) && $systems['sites']['enabled']){
	$item_model = $core->load_system('sites')->load_module('item');
	$item_controller = $core->controller($item_model);
	$reflash_index = $item_controller->check_action('reflash_index',$site);
	$manage_sites = $core->load_system('sites')->get_manage_sites();
	//是我管理的分站，则显示管理按钮
	$menu_button = in_array($site,$manage_sites);
}else{
	$item_model = $core->load_system('cms')->load_module('item');
	$item_controller = $core->controller($item_model);
	$reflash_index = $item_controller->check_action('reflash_index');
	$genrate_html = $item_controller->check_action('genrate_html');
	$list_to_html = $item_controller->check_action('list_to_html');
	$menu_button = $this_controller->check_action('menu_button');
}
$menu_button = $IS_FOUNDER ? true : $menu_button;
$member_info = get_member($USERNAME);
include template($this_module, 'index');

