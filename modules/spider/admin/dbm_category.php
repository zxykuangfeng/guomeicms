<?php
defined('PHP168_PATH') or die();
@set_time_limit(0);
$core->CONFIG['debug'] = 1;
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
	message("mysql_config_err");
}

$dbm_table_config = $core->CACHE->read($this_system->name .'/modules', $this_module->name, 'dbm_table');
if(empty($dbm_table_config['db_category'])) message("mysql_db_category_err");
$config = $core->CACHE->read($this_system->name .'/modules', $this_module->name, 'dbm_category');
if(REQUEST_METHOD == 'GET'){
	
	$system = 'cms';
	if(isset($config['system']) && $config['system']) $system = trim($config['system']);	
	if(isset($_GET['system']) && $_GET['system']){
		$config['system'] = $system = trim($_GET['system']);
	}
	
	$systems = $core->list_systems();
	$models = array();
	if($system == 'sites' && isset($systems['sites']) && $systems['sites']['installed'] && $systems['sites']['enabled']){
		$sites_system = $core->load_system('sites');
		$models = $sites_system->get_models();
	}else{
		$cms_system = $core->load_system('cms');
		$models = $cms_system->get_models();
	}
	//初始化
	$config['model'] = isset($config['model']) ? $config['model'] : 'article';
	$config['sites_num'] = isset($config['sites_num']) ? intval($config['sites_num']) : 1;
	//取数据表结构
	$struct = $db->getTableStruct($dbm_table_config['db_category']);	
	!empty($struct) or message('mysql_struct_err');
	
	//站点标识ID/别名
	$db_category = $dbm_table_config['db_category'];	
	$site_field = $config['site'] ? $config['site'] : '';
	$old_sites = array();
	if($site_field){
		$SQL = "SELECT distinct $site_field FROM {$db_category}";
		$query = $db->query($SQL);		
		while($arr = $db->fetch_array($query)){
			if($dbm_config['_db_charset'] == 'gbk') $arr = convert_encode('GBK','UTF-8', $arr);
			$old_sites[] = $arr[$site_field];				
		}
	}
	if($dbm_config['_db_charset'] == 'gbk') $struct = convert_encode('GBK','UTF-8', $struct);
	//var_dump($struct);	
	
	include template($this_module, 'dbm_category', 'admin');
}else if(REQUEST_METHOD == 'POST'){
	$_POST = p8_stripslashes2($_POST);
	$action = isset($_POST['action']) && $_POST['action'] ? trim($_POST['action']) : 'config';
	$offset = isset($_POST['offset']) && $_POST['offset'] ? intval($_POST['offset']) : 0;
	switch($action){
		case 'config':
			unset($_POST['action'],$_POST['each_site']);
			$core->CACHE->write($this_system->name .'/modules', $this_module->name, 'dbm_category', $_POST);
			exit($P8LANG['done']);
		break;
		
		case 'get_sites':
			$db_category = $dbm_table_config['db_category'];
			$site_field = $_POST['site'] ? $_POST['site'] : '';
			$SQL = "SELECT distinct $site_field FROM {$db_category}";
			$query = $db->query($SQL);
			$old_sites = array();
			while($arr = $db->fetch_array($query)){
				if($dbm_config['_page_charset'] == 'gbk') $arr = convert_encode('GBK','UTF-8', $arr);
				$old_sites[] = $arr[$site_field];				
			}
			exit(p8_json($old_sites));
		break;
		
		case 'import':
		case 'test':
			//执行前先保存配置			
			if($action == 'import'){
				unset($_POST['action'],$_POST['each_site']);
				$core->CACHE->write($this_system->name .'/modules', $this_module->name, 'dbm_category', $_POST);
				$config = $core->CACHE->read($this_system->name .'/modules', $this_module->name, 'dbm_category');
			}			
			if($config['system'] != $_POST['system']) exit($P8LANG['change_system_err']);
			$perpage = 10;
			$system = $config['system'];
			$system_ = $core->load_system($config['system']);
			$db_category = $dbm_table_config['db_category'];
			$field = '';
			$where = isset($config['where']) && $config['where'] ? trim($config['where']) : '';
			$dom = '';
			foreach($config as $fid=>$mem){
				if(in_array($fid,array('offset','sites_num','sites_alias','clear_table','each_site','system','page_sizes','model','action','where','sites_map'))) continue;
				if($mem){
					$field .= $dom.'`'.$mem.'`';
					$dom = ',';					
				}
			}
			//导入多个分站栏目(数据源携带站点标识字段)
			if($_POST['sites_num'] == 2 && $_POST['sites_map']) {
				$dom = '';			
				$str = '';
				foreach($_POST['sites_map'] as $s=>$m){
					if($m){
						$str .= $dom.$m;
						$dom = ',';	
					}
				}
			}
			
			//分站点操作时			
			if(isset($_POST['each_site']) && $_POST['each_site']){
				$str = $_POST['each_site'];
			}
			
			if($str) $where .= ($where ? ' and ' : '').$_POST['site'].' in ('.$str.')';
			if($where)
				$SQL = "SELECT {$field} FROM {$db_category} where $where";
			else
				$SQL = "SELECT {$field} FROM {$db_category}";
			if($action == 'test'){
				$SQL .= ' limit 1';		
			}else{				
				//只清空一次栏目结构
				//var_dump($offset);
				//var_dump($config['clear_table']);
				//var_dump(empty($offset) && $config['clear_table']);
				if(empty($offset) && $config['clear_table']){
					$DB_master->query("TRUNCATE TABLE ".$system_->TABLE_."category");
					$config['clear_table'] = 0;
					$core->CACHE->write($this_system->name .'/modules', $this_module->name, 'dbm_category', $config);
				}
				if(strpos(strtolower($SQL),'limit')){
					$SQL = substr($SQL,0,strpos(strtolower($SQL),'limit')).' limit '.$perpage*$offset.','.$perpage;
				}else{
					$SQL .= ' limit '.($perpage*$offset).','.$perpage;
				}
			}
			//有对接关系
			$this_site = '';
			if($config['sites_num'] == 2 && $config['sites_map']) {
				$this_site = array_search($_POST['each_site'],$config['sites_map']);				
				$system_->load_site($this_site);				
			}
			//单独站点导入优先
			if($config['sites_num'] == 1 && isset($_POST['sites_alias']) && $_POST['sites_alias']){
				$this_site = $_POST['sites_alias'];
				$system_->load_site($this_site);
			}
			if($this_site){
				$_GET['site'] = $this_site;
				$system_->SITE = $this_site;
			}
			if($system == 'sites' && empty($this_site)) exit('');
			$category = $system_->load_module('category');
			$controller_ = $core->controller($category);			
			
			//去除辅助数据
			unset($config['where'],$config['system'],$config['page_sizes'],$config['clear_table']);
			unset($config['sites_num'],$config['sites_alias']);
			//var_dump($SQL);exit;
			$query = $db->query($SQL);
			$count = 0;
			while($arr = $DB_master->fetch_array($query)){				
				if($dbm_config['_page_charset'] == 'gbk') $arr = convert_encode('GBK','UTF-8', $arr);
				$data = $this_controller->map_data($config,$arr);			
				$data['config'] = array(
					'enable_show' => 0,
					'orderby' => 'level',
					'view_pages_template' => 'base_page_template',
					'need_login' => 0,
					'need_password' => 0,
					'allow_ip' => array(
						'enabled' => 0,
					),
					'attachment_type' => 0,						
				);
				//站点名称对接转换
				if($this_site) $data['site'] = $this_site;
				$data['model'] = $config['model'];
				$data['htmlize'] = $config['htmlize'];
				$data['display_order'] = 0;
				$data['parent'] = isset($data['parent']) && intval($data['parent'])>0 && intval($data['parent']) != $data['id'] ? intval($data['parent']) : 0;
				$data['page_size'] = isset($data['page_size']) && intval($data['page_size'])>0 ? intval($data['page_size']) : intval($config['page_sizes']);
				$data['type'] = 2;
				$data['list_template'] = $config['model'].'/list';
				$data['view_template'] = $config['model'].'/view';
				$data['item_template'] = 'common/ico_title/list016';
				unset($data['sites_map']);
				if($action == 'test'){echo "MySQL:".$SQL.'<br/>';print_r($data);exit();}
				if($system == 'sites' && empty($this_site)) break;
				//不缓存插入数据
				$controller_->add($data,false);
				$count++;
			}				
			/*
			if($config['sites_map']) {
				if(!$count) $category->cache($this_site);
			}else{
				if(!$count) $category->cache();
			}
			*/		
			$offset++;
			$ret = array(
				'count' => $count,
				'sum' => $offset*$perpage + $count,
				'offset' => $offset,
				'message' => $count ? p8lang($P8LANG['doing_import'], $offset*$perpage + $count) : p8lang($P8LANG['done_import'], $offset*$perpage + $count)
			);
			exit(p8_json($ret));
		break;
		
	}
}



