<?php
defined('PHP168_PATH') or die();

header('Pragma: no-cache');

$IS_ADMIN or message('no_privilege');
if(!$this_controller->check_admin_action('login') && !$this_controller->check_admin_action('index') && !$this_controller->check_admin_action('main')){
	message('no_privilege',$core->controller,2);
}
require_once PHP168_PATH .'admin/inc/menu.class.php';


$core->get_cache('role');
	
$admin_menu->get_cache();

//菜单JSON
$json = $CACHE->read('', 'core', 'admin_menu_json');

//被禁止的菜单,创始人可以查看所有菜单
$denied = $IS_FOUNDER ? '{}' : $CACHE->read('', 'core', 'admin_menu_role_'. $core->ROLE);
$config = $core->get_config('core', '');
$member_info = get_member($USERNAME);
include template($core, 'index', 'admin');
exit;
