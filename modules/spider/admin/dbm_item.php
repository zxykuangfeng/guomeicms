<?php
defined('PHP168_PATH') or die();
$core->CONFIG['debug'] = 0;
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
	message("mysql_config_err");
}

$dbm_table_config = $core->CACHE->read($this_system->name .'/modules', $this_module->name, 'dbm_table');
if(empty($dbm_table_config['db_category'])) message("mysql_db_category_err");
$config = $core->CACHE->read($this_system->name .'/modules', $this_module->name, 'dbm_item');

if(REQUEST_METHOD == 'GET'){
	$build_sql = $this_controller->build_item_sql($dbm_table_config);
	$system = 'cms';
	if(isset($config['system']) && $config['system']) $system = trim($config['system']);	
	if(isset($_GET['system']) && $_GET['system']){
		$config['system'] = $system = trim($_GET['system']);
	}
	if(isset($_GET['sites_alias']) && $_GET['sites_alias']){
		$config['sites_alias'] = $sites_alias = trim($_GET['sites_alias']);
	}
	
	if(isset($_GET['sites_num']) && $_GET['sites_num']){
		$config['sites_num'] = trim($_GET['sites_num']);
	}
	
	$systems = $core->list_systems();
	if($system == 'sites' && isset($systems['sites']) && $systems['sites']['installed'] && $systems['sites']['enabled']){
		$sites_system = $core->load_system('sites');
	}else{
		$cms_system = $core->load_system('cms');
	}
	//初始化
	$config['sites_num'] = isset($config['sites_num']) ? intval($config['sites_num']) : 1;
	$config['cid_num'] = isset($config['cid_num']) ? intval($config['cid_num']) : 1;
	
	//取数据表结构和站点标识
	$struct = array();
	$old_sites = array();
	$site_field = $config['site'] ? $config['site'] : '';
	if(isset($dbm_table_config['db_item_sql']) && $dbm_table_config['db_item_sql']){
		$query = $db->query($build_sql);		
		while($arr = $db->fetch_array($query)){
			if($dbm_config['_db_charset'] == 'gbk') $arr = convert_encode('GBK','UTF-8', $arr);				
			if($site_field && !in_array($arr[$site_field],$old_sites)) $old_sites[] = $arr[$site_field];	
			if($arr) $struct = array_keys($arr);
		}
	}else{
		foreach($dbm_table_config['main_Comment'] as $field=>$comment){
			$struct['a.'.$field] = $comment;
		}
		foreach($dbm_table_config['main2_Comment'] as $field=>$comment){
			$struct['b.'.$field] = $comment;
		}
		foreach($dbm_table_config['main3_Comment'] as $field=>$comment){
			$struct['c.'.$field] = $comment;
		}
		
		$old_sites = array();
		if($site_field){
			$site_fields = explode('.',$site_field);
			$db_web_id = $dbm_table_config['db_item_main'];
			$web_id = $site_fields[1];
			if($site_fields[0] == 'b') $db_web_id = $dbm_table_config['db_item_main2'];
			if($site_fields[0] == 'c') $db_web_id = $dbm_table_config['db_item_main3'];			
			$SQL = "SELECT distinct $web_id FROM {$db_web_id}";
			$query = $db->query($SQL);
			while($arr = $db->fetch_array($query)){
				if($dbm_config['_db_charset'] == 'gbk') $arr = convert_encode('GBK','UTF-8', $arr);
				$old_sites[] = $arr[$web_id];				
			}
		}			
	}
	asort($old_sites);
	!empty($struct) or message('mysql_struct_err');
	
	//自定义模型字段
	if($system){
		$system_ = $core->load_system($system);
		$MODEL = $_REQUEST['model'] = 'article';
		$system_->init_model();		
		//$site = $_GET['sites_alias'];
		$categoryjson = $system_->controller.'/category-json';
	}	
	include template($this_module, 'dbm_item', 'admin');
}else if(REQUEST_METHOD == 'POST'){
	$_POST = p8_stripslashes2($_POST);
	$action = isset($_POST['action']) && $_POST['action'] ? trim($_POST['action']) : 'config';
	$offset = isset($_POST['offset']) && $_POST['offset'] ? intval($_POST['offset']) : 0;
	switch($action){
		case 'config':
			unset($_POST['action'],$_POST['each_site']);
			$core->CACHE->write($this_system->name .'/modules', $this_module->name, 'dbm_item', $_POST);
			exit($P8LANG['done']);
		break;
		
		case 'get_sites':			
			$old_sites = array();
			$site_field = $_POST['site'] ? $_POST['site'] : '';
			if(isset($dbm_table_config['db_item_sql']) && $dbm_table_config['db_item_sql']){
				$query = $db->query($build_sql);		
				while($arr = $db->fetch_array($query)){
					if($dbm_config['_db_charset'] == 'gbk') $arr = convert_encode('GBK','UTF-8', $arr);				
					if($site_field && !in_array($arr[$site_field],$old_sites)) $old_sites[$arr[$site_field]] = $arr[$site_field];
				}
			}else{				
				$old_sites = array();
				if($site_field){
					$site_fields = explode('.',$site_field);
					$db_web_id = $dbm_table_config['db_item_main'];
					$web_id = $site_fields[1];
					if($site_fields[0] == 'b') $db_web_id = $dbm_table_config['db_item_main2'];
					if($site_fields[0] == 'c') $db_web_id = $dbm_table_config['db_item_main3'];			
					$SQL = "SELECT distinct $web_id FROM {$db_web_id}";
					$query = $db->query($SQL);		
					while($arr = $db->fetch_array($query)){
						if($dbm_config['_db_charset'] == 'gbk') $arr = convert_encode('GBK','UTF-8', $arr);
						$old_sites[] = $arr[$web_id];				
					}
				}				
			}
			asort($old_sites);
			exit(p8_json($old_sites));
		break;
		
		case 'category_config':
			$dbm_category = $core->CACHE->read($this_system->name .'/modules', $this_module->name, 'dbm_category');
			$dbm_category['sites_map'];
			exit(p8_json($dbm_category['sites_map']));
		break;
		
		case 'import':
		case 'test':
			//执行前先保存配置
			if($action == 'import'){
				unset($_POST['action'],$_POST['each_site']);
				$core->CACHE->write($this_system->name .'/modules', $this_module->name, 'dbm_item', $_POST);
				$config = $core->CACHE->read($this_system->name .'/modules', $this_module->name, 'dbm_item');
			}			
			if($config['system'] != $_POST['system']) exit($P8LANG['change_system_err']);			
			$system = $config['system'];			
			$system_ = $core->load_system($config['system']);
			$perpage = 10;
			$SQL = $this_controller->build_item_sql($dbm_table_config);
			$where = isset($config['where']) && $config['where'] ? trim($config['where']) : '';
			if($where) $SQL .= strpos(strtolower($SQL),'where') ?  ' and '.$where : ' where '.$where;
			
			//有对接关系，则限制
			if($_POST['sites_num'] == 2 && $_POST['sites_map']) {
				$dom = $str = '';
				foreach($_POST['sites_map'] as $s=>$m){
					if($m){
						$str .= $dom.$m;
						$dom = ',';	
					}
				}
			}
			//分站点操作时，优先			
			if(isset($_POST['each_site']) && $_POST['each_site']){
				$str = $_POST['each_site'];
			}
			
			if($str) $SQL .= (strpos(strtolower($SQL),'where') ? ' and ' : ' where ').$_POST['site'].' in ('.$str.')';
			//测试时只限一条数据
			if($action == 'test'){
				if(strpos(strtolower($SQL),'limit')){
					$SQL = substr($SQL,0,strpos(strtolower($SQL),'limit')).' limit 1';
				}else{
					$SQL .= ' limit 1';
				}
			}else{				
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
			//模型初始化配置
			$_module_ = $system_->load_module('item');
			$_member_ = $core->load_module('member');
			$MODEL = $_REQUEST['model'] = 'article';
			$system_->init_model();
			$_module_->set_model($MODEL);
			
			$_controller_ = $core->controller($_module_);
			//强制去除辅助数据
			unset($config['post_cid'],$config['where'],$config['cid_num'],$config['system'],$config['each_site'],$config['sites_alias']);
			
			//没配置的选项直接删除
			foreach($config as $key=>$val){
				if(empty($val)) unset($config[$key]);
			}
			
			//echo $SQL;echo "<br/>";exit;
			$query = $db->query($SQL);
			//处理a.id这类数据配置
			$config = array_map(function($config){
					$field = explode('.',$config);
					if(count($field) <= 1)
						return $config;
					else
						return $field[1];
				},$config);
			//自定义字段
			$model_fields = array_keys($this_model['fields']);
			$count = 0;
			while($arr = $DB_master->fetch_array($query)){
				if($dbm_config['_page_charset'] == 'gbk') $arr = convert_encode('GBK','UTF-8', $arr);
				$data = $this_controller->map_data($config,$arr);
				
				//检测配置自定义字段
				foreach($data as $field=>$value){
					if(in_array($field,$model_fields)){
						$data['field#'][$field] = $data[$field];	
						$data['#field_'.$field.'_posted'] = '';
						unset($data[$field]);
					}
				}
				//站点名称对接转换
				if($system == 'sites')	$data['site'] = $this_site;
				//数据分别导入到多个分站，保持源栏目ID不变，否则使用匹配关系或指定栏目。
				if($config['cid_num'] == 2){
					$data['cid'] = $map[$arr['category_id']];
				}
				if($config['cid_num'] == 3 && intval($config['post_cid'])){
					$data['cid'] = intval($config['post_cid']);
				}
				if($data['frame']) $data['frame'] = attachment_url($data['frame'],true);
				if(empty($data['cid'])) continue;
				unset($data['sites_map'],$data['sites_num']);
				//强制给模型和辅助数据
				$data['model'] = 'article';				
				$data['content_censor_enabled'] = 1;
				$data['filter_word_enable'] = 1;
				$data['verify'] = 1;
				//发布时间兼容处理
				if($data['timestamp']){
					if(strtotime($data['timestamp'])){
						$data['timestamp'] = date('Y-m-d H:i:s',strtotime($data['timestamp']));
					}else{			
						if(strtotime(date('Y-m-d H:i:s',$data['timestamp']))){
							$data['timestamp'] = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s',$data['timestamp'])));
						}else{
							$data['timestamp'] = date('Y-m-d H:i:s',time());
						}
					}
				}
				//匹配会员
				if($data['username']){
					$ret = $_member_->data('read',$data['username']);
					if($ret) $data['uid'] = $ret['id'];
				}
				if($action == 'test'){echo "MySQL:".$SQL.'<br/>';print_r($data);exit();}
				if($system == 'sites' && empty($data['site'])) break;
				$_controller_->add($data);
				//print_r($data);exit();
				$count++;
			}
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