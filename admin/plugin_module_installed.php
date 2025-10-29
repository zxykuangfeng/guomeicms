<?php
defined('PHP168_PATH') or die();

/**
* 已安装系统、模块、插件
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

load_language($core, 'config');

$system_list = $core->list_systems();
$system_table = $core->TABLE_.'system';
$list_rets = $DB_master->fetch_all("SELECT * FROM {$system_table}");
$db_systems = array();
//读数据库里的记录	
foreach($list_rets as $v){
	$db_systems[$v['name']] = $v;
}
$diff_system = array_diff_key($db_systems,$system_list);
if(!empty($diff_system)){
	foreach($diff_system as $item =>$val){
		//文件夹下面有同名php文件,并且有配置文件的将会被认为是一个系统如b, b/system.php, b/#.php
		if(is_dir(PHP168_PATH . $item) && is_file(PHP168_PATH . $item .'/system.php') && ($info = @include PHP168_PATH . $item .'/#.php')){
			$system_list[$item] = array(
				'alias' => $info['alias'],	//系统别名
				'class' => $info['class'],	//系统的类
				'controller_class' => $info['controller_class'],	//系统的类
				'table_prefix' => '',//表前缀,强制为空
				'enabled' => empty($val['enabled']) ? false : true,//是否可用
				'installed' => empty($val['installed']) ? false : true //是否安装
			);		
		}
	}
}
foreach($system_list as $key=>$val){
	$system_list[$key]['description'] = $val['alias'];
	$system_list[$key]['version'] =  '3.0';
	
}
$uninstall_system = $this_controller->check_admin_action('uninstall_system');

$system = 'core';
$module_list = $core->list_modules(true);

foreach($module_list as $key=>$val){
	$module_list[$key]['description'] = isset($core->systems[$system]['alias']) ? $core->systems[$system]['alias'].'：'.$val['alias'] : $P8LANG['core_module'].'：'.$val['alias'];
	$module_list[$key]['version'] =  '3.0';
}
$uninstall_module = $this_controller->check_admin_action('uninstall_module');
$system_json = p8_json($core->systems);
$module_json = p8_json($this_system->modules);

$uninstall_plugin = $this_controller->check_admin_action('uninstall_plugin');
$plugin_list = $core->plugins;

if(empty($plugin_list)){
	//尝试刷新
	$core->list_plugins(false);
	$plugin_list = $core->plugins;
}
foreach($plugin_list as $key=>$val){
	$info = include $this_system->path .'plugin/'.$key.'/#.php';
	$plugin_list[$key]['description'] = isset($info['description']) && $info['description'] ? $info['description'] : '';
	$plugin_list[$key]['version'] =  isset($info['version']) && $info['version'] ? $info['version'] : '1.0';
	$plugin_list[$key]['ico'] =  isset($info['ico']) && $info['ico'] ? $info['ico'] : 'fa-codepen';
}

include template($core, 'plugin_module_installed', 'admin');