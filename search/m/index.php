<?php
/**
* 移动端搜索，适用于反向代理
**/
require_once dirname(__FILE__) .'/../../inc/init.php';
$_GET['ismobile']=isset($_GET['ismobile']) && empty($_GET['ismobile']) ? 0 : 1;
defined('ISMOBILE') || define('ISMOBILE',true);
defined('FROM_MOBILE') || define('FROM_MOBILE',true);
$this_system = $core->load_system('cms');
$this_module = $this_system->load_module('item');
$this_controller = $core->controller($this_module);
$ACTION = 'search';
$core->ismobile = true;
$search_file = $this_module->path .'search.php';
file_exists($search_file) or exit();
include $search_file;
exit;