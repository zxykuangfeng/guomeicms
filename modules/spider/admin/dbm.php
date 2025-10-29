<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){

	$config = $core->CACHE->read($this_system->name .'/modules', $this_module->name, 'dbm_config');
	
	include template($this_module, 'dbm', 'admin');
}else if(REQUEST_METHOD == 'POST'){
	$_POST = p8_stripslashes2($_POST);
	$action = isset($_POST['action']) && $_POST['action'] ? trim($_POST['action']) : 'config';
	if($action == 'setconfig'){		
		$_POST['_db_host'] = $core->CONFIG['DB_master']['host'];
		$_POST['_db_user'] = $core->CONFIG['DB_master']['user'];
		$_POST['_db_password'] = $core->CONFIG['DB_master']['password'];
		$_POST['_db_name'] = $core->CONFIG['DB_master']['db'];
		$_POST['_db_port'] = $core->CONFIG['DB_master']['port'];
		$_POST['_db_charset'] = 'utf8';
		$_POST['_page_charset'] = 'utf-8';
		$core->CACHE->write($this_system->name .'/modules', $this_module->name, 'dbm_config', $_POST);
		exit($P8LANG['done']);
	}else if($action == 'config'){
		unset($_POST['action']);
		$core->CACHE->write($this_system->name .'/modules', $this_module->name, 'dbm_config', $_POST);
		exit($P8LANG['done']);
	}else{
		$core->CONFIG['debug'] = 0;
		error_reporting(0);
		$db = new P8_mysql(
			$_POST['_db_host'],
			$_POST['_db_user'],
			$_POST['_db_password'],
			$_POST['_db_name'],
			$_POST['_db_charset'],
			0
		);
		$message = "连接成功，可提交配置！";
		if($db->connect() == 0){
			exit($message);				
		}else{
			$message = "Error:连接失败，请检查配置！";
			exit($message);
		}
	}
}



