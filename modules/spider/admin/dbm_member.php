<?php
defined('PHP168_PATH') or die();
@set_time_limit(0);
$this_controller->check_admin_action($ACTION) or message('no_privilege');
$dbm_config = $core->CACHE->read($this_system->name .'/modules', $this_module->name, 'dbm_config');
$dbm_config or message('mysql_config_err');
$db = new P8_mysql(
	$dbm_config['_db_host'],
	$dbm_config['_db_user'],
	$dbm_config['_db_password'],
	$dbm_config['_db_name'],
	$dbm_config['_db_charset'],
	0
);
if($db->connect() != 0){
	message("Error:连接失败,请检查MySQL配置参数！");
}

$dbm_table_config = $core->CACHE->read($this_system->name .'/modules', $this_module->name, 'dbm_table');
if(empty($dbm_table_config['db_member'])) message("mysql_db_member_err");
$config = $core->CACHE->read($this_system->name .'/modules', $this_module->name, 'dbm_member');

if(REQUEST_METHOD == 'GET'){	
	$core->get_cache('role');
	$core->get_cache('role_group');
	$roles = $core->get_cache('role', 'all');
	$role_group_json = jsonencode($core->role_groups);
	$role_json = jsonencode($roles);
	
	//取数据表结构
	$struct = $db->getTableStruct($dbm_table_config['db_member']);
	!empty($struct) or message('mysql_struct_err');
	
	if($dbm_config['_page_charset'] == 'gbk') $struct = convert_encode('GBK','UTF-8', $struct);
	//var_dump($struct);	
	
	include template($this_module, 'dbm_member', 'admin');
}else if(REQUEST_METHOD == 'POST'){
	
	$_POST = p8_stripslashes2($_POST);
	$action = isset($_POST['action']) && $_POST['action'] ? trim($_POST['action']) : 'config';
	if($action == 'config'){
		unset($_POST['action']);
		$core->CACHE->write($this_system->name .'/modules', $this_module->name, 'dbm_member', $_POST);
		//message('done');
		exit($P8LANG['done']);
	}else{
		//执行前先保存配置
		if($action == 'import'){
			unset($_POST['action']);
			$core->CACHE->write($this_system->name .'/modules', $this_module->name, 'dbm_member', $_POST);
			$config = $core->CACHE->read($this_system->name .'/modules', $this_module->name, 'dbm_member');
		}
		$db_member = $dbm_table_config['db_member'];
		$field = '';
		$where = isset($config['where']) && $config['where'] ? trim($config['where']) : '1=1';
		$dom = '';
		foreach($_POST as $fid=>$mem){
			if(in_array($fid,array('password','role_id','role_gid','is_admin','action','where'))) continue;
			if($mem){
				$field .= $dom.'`'.$mem.'`';
				$dom = ',';
			}			
		}
		$SQL = "SELECT {$field} FROM {$db_member} where $where";
		if($action == 'test') $SQL .= ' limit 1';
		$query = $db->query($SQL);
		$member_ = $core->load_module('member');
		$member_controller = $core->controller($member_);
		$import_c = $import_e = 0;
		$import_err = '';
		unset($config['password'],$config['role_id'],$config['role_gid'],$config['is_admin'],$config['where']);			
		while($arr = $db->fetch_array($query)){			
			if($dbm_config['_page_charset'] == 'gbk') $arr = convert_encode('GBK','UTF-8', $arr);
			$data = $this_controller->map_data($config,$arr);
			$data['password'] = isset($_POST['password']) && $_POST['password'] ? trim($_POST['password']) : 'Admin!@#123';
			$data['role_id'] = intval($_POST['role_id']);
			$data['role_gid'] = intval($_POST['role_gid']);
			$data['is_admin'] = intval($_POST['is_admin']) ? 1 : 0;
			$data['email'] = $data['email'] ? $data['email'] : substr(md5($data['username']),0,10).'@qq.com';
			if($action == 'test'){echo "MySQL:".$SQL."<br/>"; print_r($data);exit();}
			//从后台添加
			$status = $member_controller->register($data,true);
			if(intval($status) <=0){
				$import_e++;
				$import_err .= $data['username'].',';
			}else{
				$import_c++;
			}
		}
		if($import_e)
			exit(p8lang($P8LANG['member_import_result'], $import_c, $import_e,$import_err));
		else
			exit(p8lang($P8LANG['member_import_result2'], $import_c));
	}
}



