<?php
defined('PHP168_PATH') or die();

/**
* 标签操作入口
* @language [cms/item/global.php, core/label/global.php, core/config.php]
**/

$this_system->check_manager($ACTION) or message('no_privilege');
$mysites = $this_system->get_manage_sites();
in_array($this_system->SITE,$mysites) or message('no_privilege');

$data['type'] = 'module_data';

$LABEL = &$core->load_module('label');
load_language($LABEL, 'global');
load_language($this_module, 'label');
load_language($core, 'config');


//允许的排序字段	字段 => 语言包键值
$order_bys = array(
	'i.id'			=> $P8LANG['order']['order_id'],
	'i.posttime'	=> $P8LANG['order']['add_time'],
	'd.reply_time'	=> $P8LANG['order']['reply_time'],
);

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
	
	default:
		require $this_module->path .'admin/label/add.php';
	break;
}
