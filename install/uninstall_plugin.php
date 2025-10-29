<?php
defined('PHP168_PATH') or die();

/**
* 卸载一个插件
**/

require_once PHP168_PATH .'inc/install.func.php';

//删除配置
$DB_master->delete(
	$core->TABLE_ .'config',
	"system = 'core' AND module LIKE '$this_plugin->name%'"
);

$DB_master->delete(
	$core->TABLE_ .'plugin',
	"name = '$this_plugin->name'"
);

if(is_file($this_plugin->path .'install/uninstall.php')){
	//执行卸载脚本
	require $this_plugin->path .'install/uninstall.php';
}

//删除整个目录
rm($this_plugin->path);
//模板目录
rm(TEMPLATE_PATH .'plugin/'. $this_plugin->name);
//缓存
rm(CACHE_PATH .'core/plugin/'. $this_plugin->name);
