<?php
defined('PHP168_PATH') or die();

/**
* 标签操作入口
* @language [cms/item/global.php, core/label/global.php, core/config.php]
**/
$LABEL = &$core->load_module('label');
$label_controller = &$core->controller($LABEL);
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$label_controller->check_admin_action($action) or message('no_privilege');

$data['type'] = 'module_data';
load_language($LABEL, 'global');
load_language($this_module, 'label');
load_language($core, 'config');

//允许的排序字段	字段 => 语言包键值
$order_bys = array(
	'i.list_order'	=> $P8LANG['cms_item_order_default'],
	'i.id'			=> $P8LANG['cms_item_order_id'],
	'i.timestamp'	=> $P8LANG['cms_item_order_addtime'],
	'i.level'		=> $P8LANG['cms_item_order_level'],
	'i.views'		=> $P8LANG['cms_item_order_views'],
	'i.views_7'		=> $P8LANG['cms_item_order_views_last7day'],
	'i.views_30'	=> $P8LANG['cms_item_order_views_last30day'],
	'i.views_90'	=> $P8LANG['cms_item_order_views_last90day'],
	'i.comments'	=> $P8LANG['cms_item_order_comments'],
	'd.digg'	=> $P8LANG['cms_item_order_digg'],
	'd.trample'	=> $P8LANG['cms_item_order_trample'],
);

if(!empty($_REQUEST['model'])){
	$this_system->init_model();
	
	$this_model or message('no_such_cms_model');
	
	foreach($this_model['fields'] as $name => $v){
		if($v['orderby']) $order_bys['i.'. $name] = $v['alias'];
	}
}

$enable = $action=='add'?true:false;
$models = $this_system->get_models($enable);

switch($action){
	case 'update':
		require $this_module->path .'admin/label/update.php';
	break;
	
	case 'explain':
		require $this_module->path .'admin/label/explain.php';
	break;
	
	case 'preview':
		require $this_module->path .'admin/label/preview.php';
	break;
	
	default:
		require $this_module->path .'admin/label/add.php';
	break;
}
