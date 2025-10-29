<?php
defined('PHP168_PATH') or die();

/**
* 权重的定期时效性检测及恢复
**/
//for cms
$cms_system = $core->load_system('cms');
$cms_models = $cms_system->load_module('model');
$cms_select = select();
$cms_select->from($cms_models->table, '*');
$cms_list = $core->list_item($cms_select,array('page_size' => 0,'ms' => 'master'));
$cms_item = $cms_system->load_module('item');
$cms_main_table = $cms_item->main_table;
$this_time = P8_TIME;
$core->DB_master->update($cms_main_table,array('level' => 0,'level_time' => 0),"`level_time`<$this_time");
foreach ($cms_list as $v){
    $cms_table = $cms_main_table.'_'.$v['name'].'_';
    $core->DB_master->update($cms_table,array('level' => 0,'level_time' => 0),"`level_time`<$this_time");
}
//for sites
$systems = $core->list_systems();
if(isset($systems['sites']) && $systems['sites']['enabled']) {
    $sites_system = $core->load_system('sites');
    $sites_module = $sites_system->load_module('model');
    $sites_select = select();
    $sites_select->from($sites_module->table, '*');
    $sites_list = $core->list_item($sites_select,array('page_size' => 0,'ms' => 'master'));
    $sites_item = $sites_system->load_module('item');
	$sites_main_table = $sites_item->main_table;
	$core->DB_master->update($sites_main_table,array('level' => 0,'level_time' => 0),"`level_time`<$this_time");
	foreach ($sites_list as $v){
		$sites_table = $sites_main_table.'_'.$v['name'].'_';
		$core->DB_master->update($sites_table,array('level' => 0,'level_time' => 0),"`level_time`<$this_time");	
	}
}