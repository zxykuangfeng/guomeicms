<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');
$dbm_config = $core->CACHE->read($this_system->name .'/modules', $this_module->name, 'dbm_config');
$db = new P8_mysql(
	$dbm_config['_db_host'],
	$dbm_config['_db_user'],
	$dbm_config['_db_password'],
	$dbm_config['_db_name'],
	$dbm_config['_db_charset'],
	0
);
if($db->connect() != 0){
	message("mysql_config_err");
}
$config = $core->CACHE->read($this_system->name .'/modules', $this_module->name, 'dbm_table');

if(REQUEST_METHOD == 'GET'){	
	$tables = $db->getTableStatus('');
	$db_item_main = $db_item_main2 = $db_item_main3 = '';
	//主表
	$item_main = array();
	if($config['db_item_main']){
		$db_item_main = $db->getTableStruct($config['db_item_main']);
		if($dbm_config['_page_charset'] == 'gbk') $db_item_main = convert_encode('GBK','UTF-8', $db_item_main);		
		foreach($db_item_main as $item){
			if(in_array($item['Field'],$config['db_item_main_field'])) $item_main[] = $item['Field'];
		}
	}
	$db_item_main_json = p8_json($item_main);
	
	//副表1
	$item_main = array();
	if($config['db_item_main2']){
		$db_item_main2 = $db->getTableStruct($config['db_item_main2']);
		if($dbm_config['_page_charset'] == 'gbk') $db_item_main2 = convert_encode('GBK','UTF-8', $db_item_main2);		
		foreach($db_item_main2 as $item){
			if(in_array($item['Field'],$config['db_item_main2_field'])) $item_main[] = $item['Field'];
		}		
	}
	$db_item_main2_json = p8_json($item_main);
	
	//副表2
	$item_main = array();
	if($config['db_item_main3']){
		$db_item_main3 = $db->getTableStruct($config['db_item_main3']);
		if($dbm_config['_page_charset'] == 'gbk') $db_item_main3 = convert_encode('GBK','UTF-8', $db_item_main3);		
		foreach($db_item_main3 as $item){
			if(in_array($item['Field'],$config['db_item_main3_field'])) $item_main[] = $item['Field'];
		}		
	}
	$db_item_main3_json = p8_json($item_main);
	include template($this_module, 'dbm_table', 'admin');
}else if(REQUEST_METHOD == 'POST'){
	//强制暂关防护
	
	$_POST = p8_stripslashes2($_POST);
	$action = isset($_POST['action']) && $_POST['action'] ? trim($_POST['action']) : 'config';
	switch($action){
		case 'config':
			unset($_POST['action'],$_POST['tmptable']);
			$_POST = str_replace('，',',',$_POST);
			if(empty($_POST['db_item_main2'])) unset($_POST['db_item_main2_field'],$_POST['db_item_main2_inner'],$_POST['db_item_main2_where']);
			if(empty($_POST['db_item_main3'])) unset($_POST['db_item_main3_field'],$_POST['db_item_main3_inner'],$_POST['db_item_main3_where']);
			if($_POST['db_item_main'] && empty($_POST['db_item_main_field'])) exit($P8LANG['db_item_main_field_err']);
			if($_POST['db_item_main2'] && empty($_POST['db_item_main2_field'])) exit($P8LANG['db_item_main2_field_err']);
			if($_POST['db_item_main3'] && empty($_POST['db_item_main3_field'])) exit($P8LANG['db_item_main3_field_err']);
			if($_POST['db_item_main2'] && empty($_POST['db_item_main2_inner'])) exit($P8LANG['db_item_main2_inner_err']);
			if($_POST['db_item_main3'] && empty($_POST['db_item_main3_inner'])) exit($P8LANG['db_item_main3_inner_err']);
			$_POST['main_Comment'] = $_POST['main2_Comment'] = $_POST['main3_Comment'] = array();
			foreach($_POST['db_item_main_field'] as $field){
				$_POST['main_Comment'][$field] = $_POST['main_comment'][$field];
			}
			foreach($_POST['db_item_main2_field'] as $field){
				$_POST['main2_Comment'][$field] = $_POST['main2_comment'][$field];
			}
			foreach($_POST['db_item_main3_field'] as $field){
				$_POST['main3_Comment'][$field] = $_POST['main3_comment'][$field];
			}
						
			$core->CACHE->write($this_system->name .'/modules', $this_module->name, 'dbm_table', $_POST);
			exit($P8LANG['done']);
		break;
		
		case 'get_table_struct':
			$name = isset($_POST['tmptable']) ? trim($_POST['tmptable']) : '';			
			$list = $db->getTableStruct($name);
			if($dbm_config['_page_charset'] == 'gbk') $list = convert_encode('GBK','UTF-8', $list);
			//var_dump(p8_json($list));
			exit(p8_json($list));
		break;
		case 'build_sql':
			$SQL = $this_controller->build_item_sql($config);
			if(!strpos('LIMIT',strtoupper($SQL))) $SQL .= ' LIMIT 1';
			
			echo "MySQL:".$SQL."<br>";
			$data = $db->fetch_one($SQL);
			if($dbm_config['_page_charset'] == 'gbk') $data = convert_encode('GBK','UTF-8', $data);				
			print_r($data);						
			exit;
		break;
	}
}



