<?php
defined('PHP168_PATH') or die();

/**
* 更新分类缓存
**/

$ask = &$core->load_system('ask');
		
$ask->models = $ask->core->CACHE->read($ask->name .'/modules', 'model', 'models');

$module = $ask->load_module('category');

$module->cache();

//item
$Item = $ask->load_module('item');
$Item->cache_statistics();
