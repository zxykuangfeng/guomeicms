<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	load_language($core, 'config');

	$list = $core->list_systems();
	$system_table = $core->TABLE_.'system';
	$list_rets = $DB_master->fetch_all("SELECT * FROM {$system_table}");
	$db_systems = array();
	//读数据库里的记录	
	foreach($list_rets as $v){
		$db_systems[$v['name']] = $v;
	}
	$diff_system = array_diff_key($db_systems,$list);
	if(!empty($diff_system)){
		foreach($diff_system as $item =>$val){
			//文件夹下面有同名php文件,并且有配置文件的将会被认为是一个系统如b, b/system.php, b/#.php
			if(is_dir(PHP168_PATH . $item) && is_file(PHP168_PATH . $item .'/system.php') && ($info = @include PHP168_PATH . $item .'/#.php')){
				$list[$item] = array(
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
	foreach($list as $key=>$val){
		$list[$key]['description'] = $val['alias'];
		$list[$key]['version'] =  '3.0';
	}
	$uninstall_system = $this_controller->check_admin_action('uninstall_system');

	include template($core, 'system_list', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$table_prefixes = isset($_POST['table_prefix']) ? (array)$_POST['table_prefix'] : array();
	$enables = isset($_POST['enables']) ? (array)$_POST['enables'] : array();
	
	//修改系统安装表前缀
	$DB_master->update(
		$core->TABLE_ .'system',
		array(
			'table_prefix' => ''
		),
		"1=1"
	);
	/*
	foreach($table_prefixes as $system => $prefix){
		$system = preg_replace('/[^a-zA-Z0-9_]/', '', $system);
		$prefix = preg_replace('/[^a-zA-Z0-9_\.]/', '', $prefix);
		
		$DB_master->update(
			$core->TABLE_ .'system',
			array(
				'table_prefix' => $prefix
			),
			"name = '$system'"
		);
	}
	*/
	
	//禁用或开启模块
	foreach($enables as $system => $v){
		$system = basename($system);
		
		$v = empty($v) ? 0 : 1;
		$data  = array('enabled' => $v);
		if($v) $data = array('enabled' => $v,'installed' => 1);
		$DB_master->update(
			$core->TABLE_ .'system',
			$data,
			"name = '$system'"
		);
	}
	
	require PHP168_PATH .'inc/cache.func.php';
	cache_system_module();
	
	message('done', HTTP_REFERER);
}


