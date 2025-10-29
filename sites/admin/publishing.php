<?php
defined('PHP168_PATH') or die();


$mysites = $this_system->get_manage_sites();

$farm = &$this_system->load_module('farm');
$farm_controller = $core->controller($farm);
$site_list = $farm_controller->check_admin_action('list');
$site_create = $farm_controller->check_admin_action('add');
$site_recycle = $farm_controller->check_admin_action('recycle');


$model = &$this_system->load_module('model');
$model_controller = $core->controller($model);
$model_list = $model_controller->check_admin_action('list');
$model_create = $model_controller->check_admin_action('add');

$stop = &$this_system->load_module('stop');
$stop_controller = $core->controller($stop);
$category_create = $model_controller->check_admin_action('category');


if(!$mysites && !$IS_FOUNDER)message('no_privilege');
if(!$this_system->SITE || !in_array($this_system->SITE, $mysites))$this_system->init_site($mysites[0]);

$allsites  = $this_system->get_sites();

$core->get_cache('role');

$datelong = 30;
$core->DB_master->delete(
    $this_system->log_table,
    'timestamp < '. (P8_TIME - $datelong * 86400)
);

$qu = parse_url($_SERVER["REQUEST_URI"]);
$src = $core->admin_controller.'/sites/farm-list';
if(!empty($qu['query']) && isset($_GET['frame'])){
   $src = $core->admin_controller.xss_url( str_replace('frame=','',$qu['query']));
}
$config = $core->get_config('core', '');
$member_info = get_member($USERNAME);
require_once PHP168_PATH .'admin/inc/menu.class.php';
$admin_menu->get_cache();
//菜单JSON
$json = $CACHE->read('', 'core', 'admin_menu_json');
//被禁止的菜单,创始人可以查看所有菜单
//$denied = $IS_FOUNDER ? '{}' : $CACHE->read('', 'core', 'admin_menu_role_'. $core->ROLE);
$denied = '{}';
include template($this_system, 'publishing', 'admin');
	

