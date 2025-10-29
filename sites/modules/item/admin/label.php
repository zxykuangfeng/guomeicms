<?php
defined('PHP168_PATH') or die();

/**
* 标签操作入口
* @language [cms/item/global.php, core/label/global.php, core/config.php]
**/

//$this_system->check_manager($ACTION) or message('no_privilege');
$mysites = $this_system->get_manage_sites();
$allsites  = $this_system->get_sites();
if($this_system->SITE == null && $allsites) {
	$this_system->SITE = current(array_keys($allsites));
	$this_system->siteurl = substr($this_system->url,0,-6).'/s.php/'.$this_system->SITE;	
}

$site = isset($_GET['site']) && $_GET['site'] ? $_GET['site'] : $this_system->SITE;

//in_array($this_system->SITE,$mysites) or message('no_privilege');

$data['type'] = 'module_data';

$LABEL = &$core->load_module('label');
load_language($LABEL, 'global');
load_language($this_module, 'label');
load_language($core, 'config');

//允许的排序字段	字段 => 语言包键值
$order_bys = array(
	'i.list_order'	=> $P8LANG['sites_item_order_default'],
	'i.id'			=> $P8LANG['sites_item_order_id'],
	'i.timestamp'	=> $P8LANG['sites_item_order_addtime'],
    'i.level'		=> $P8LANG['sites_item_order_level'],
    'i.views'		=> $P8LANG['sites_item_order_views'],
    'i.views_7'	=> $P8LANG['sites_item_order_views_last7day'],
    'i.views_30'	=> $P8LANG['sites_item_order_views_last30day'],
    'i.views_90'	=> $P8LANG['sites_item_order_views_last90day'],
	'i.comments'	=> $P8LANG['sites_item_order_comments'],	
);
//'d.digg'	=> $P8LANG['sites_item_order_digg'],
//'d.trample'	=> $P8LANG['sites_item_order_trample'],
$_REQUEST['model'] = !in_array($action,array('update','explain','preview','checktpl')) && empty($_REQUEST['model']) ? 'article' : $_REQUEST['model'];
if(!empty($_REQUEST['model'])){
	$this_system->init_model();
	
	$this_model or message('no_such_sites_model');
	
	foreach($this_model['fields'] as $name => $v){
		if($v['orderby']) $order_bys['i.'. $name] = $v['alias'];
	}
}

$models = $this_system->get_models();
$rand_ttl = rand(0,900);
$action = isset($_GET['action']) ? $_GET['action'] : '';
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
	
	case 'checktpl':
		require $this_module->path .'admin/label/checktpl.php';
	break;	
	
	default:
		require $this_module->path .'admin/label/add.php';
	break;
}