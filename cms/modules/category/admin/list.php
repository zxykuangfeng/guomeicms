<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	@set_time_limit(60);
	
	$MODEL = isset($_GET['model']) ? $_GET['model'] : '';
    $Item = $this_system->load_module('item');
    $item_controller = &$core->controller($Item);    
	$my_addible_category = $item_controller->get_acl('my_addible_category') ?: array();
	$_my_category_to_verify = $item_controller->get_acl('my_category_to_verify') ?: array();
	$_my_category_to_verify_first = $item_controller->get_acl('my_category_to_verify_first') ?: array();
	//审核+初审+发布
	$_my_category = $_my_category_to_verify + $_my_category_to_verify_first + $my_addible_category;
	$my_category = $IS_FOUNDER ? "[1]" : p8_json($_my_category);
	$models = $this_system->get_models();
	$verified = 1;
	$this_module->get_cache(false);
	$path = array();

	foreach($this_module->categories as $v){
		$parents = $this_module->get_parents($v['id']);
		foreach($parents as $vv){
			$path[$v['id']][] = $vv['id'];
		}
		$path[$v['id']][] = $v['id'];
	}
	
	//views sum
	$get_all_cids = $this_module->make_categories_sort($this_module->top_categories);
	$views_sums = $this_module->get_views_sum();
	$sums = array();
	foreach($get_all_cids as $index_id => $child_cids){
		$ids = array($index_id) + $this_module->get_children_ids($index_id);
		foreach($ids as $index_id_tmp){
			$sums[$index_id] += isset($views_sums[$index_id_tmp]) ? intval($views_sums[$index_id_tmp]) : 0;
		}
	}
	$json = array(
		'json' => p8_json($this_module->make_json_sort($this_module->top_categories)),
		'path' => p8_json($path),
		'models' => p8_json($models),
		'sums' => p8_json($sums)
	);
	$item_config = $core->get_config($this_system->name,'item');
	$item_config['lan_date'] = isset($item_config['lan_date']) && $item_config['lan_date'] ? $item_config['lan_date']:0;
	include template($this_module, 'list', 'admin');
	//print_r($this_module->top_categories);
}else if(REQUEST_METHOD == 'POST'){
	
	@set_time_limit(0);
	
	$action = @$_POST['action'];
	$cid = $_POST['cid'] ? $_POST['cid'] : array();
	switch($action){
	
	case 'fix':
		//修复栏目内容数
		$DB_master->update($this_module->table, array('item_count' => 0), '');
		$item_config = $core->get_config($this_system->name,'item');		
		$lan_date_enable = isset($item_config['lan_date_enable']) && $item_config['lan_date_enable'] ? true : false;
		$lan_date_timestamp = isset($item_config['lan_date']) && $item_config['lan_date'] ? intval($item_config['lan_date']) : 0;		
		//局域网限制
		if($lan_date_enable && $lan_date_timestamp){
			//限制部分
			$lan_category = isset($item_config['lan_category']) && $item_config['lan_category'] ? explode(',',$item_config['lan_category']) : array();	
			$lan_category = array_filter($lan_category);
			$s = $comma = '';
			foreach($lan_category as $v){
				if($v){
					$s .= $comma ."$v";
					$comma = ',';
				}
			}
			$where = $s ? 'timestamp >= '.$lan_date_timestamp.' and cid NOT IN ('. $s .')' : 'timestamp >= '.$lan_date_timestamp;
			$query = $DB_master->query("SELECT cid, COUNT(*) AS `count` FROM $this_system->item_table where $where GROUP BY cid");
			while($arr = $DB_master->fetch_array($query)){
				$this_module->update_count($arr['cid'], $arr['count']);
			}
			//不限制部分
			if(!empty($s)){
				$query = $DB_master->query("SELECT cid, COUNT(*) AS `count` FROM $this_system->item_table where `cid` IN ($s) GROUP BY cid");
				while($arr = $DB_master->fetch_array($query)){
					$this_module->update_count($arr['cid'], $arr['count']);
				}
			}
		}else{
			$query = $DB_master->query("SELECT cid, COUNT(*) AS `count` FROM $this_system->item_table GROUP BY cid");
			while($arr = $DB_master->fetch_array($query)){
				$this_module->update_count($arr['cid'], $arr['count']);
			}
		}		
	break;
	
	case 'cache':
		//更新缓存
		$this_module->cache();
	break;
	
	case 'content_lan':
		$item_module = &$this_system->load_module('item');
		$item_module->set_content_html($cid,false);//不限定时间时
		exit('[]');
	break;
	case 'content_lan_limit':
		$item_module = &$this_system->load_module('item');
		$item_module->set_content_html($cid,true);//限定时间时
		exit('[]');
	break;
	case 'content_unlan':
		$item_module = &$this_system->load_module('item');
		$item_module->unset_content_html($cid);
		exit('[]');
	break;
	
	case 'unhtmlize':
	case 'htmlize':
		//开启/关闭所有静态化
		$ids = isset($_POST['id']) && !empty($_POST['id']) ? $_POST['id'] : '';		
		$DB_master->update(
			$this_module->table,
			array('htmlize' => $action == 'htmlize' ? 1 : 0),
			$ids ? 'id IN ('. implode(',', $ids) .')' : ''
		);		
		
		if($action == 'htmlize'){
			$div = '';
			$model_alias = '';
			$models = $this_system->get_models();
			foreach($models as $model=>$val){
				$model_info = $this_system->get_model($model);
				foreach($model_info['filterable_fields'] as $filterable_field){
					$model_alias .= $div.$model_info['alias'].'->'.$filterable_field['alias'];
					$div = ',';	
				}
			}
			if($model_alias) message(p8lang($P8LANG['cms_category_set_htmlize_fail'], array($model_alias)));
		}
		$this_module->cache();
	break;
		
	case 'conten_unhtmlize':
	case 'conten_htmlize':
		//开启/关闭所有内容页静态化
		$ids = isset($_POST['id']) && !empty($_POST['id']) ? $_POST['id'] : '';
		$DB_master->update(
			$this_module->table,
			array('htmlize' => $action == 'conten_htmlize' ? 2 : 0),
			$ids ? 'id IN ('. implode(',', $ids) .')' : ''
		);	
		
		if($action == 'conten_htmlize'){
			$div = '';
			$model_alias = '';
			$models = $this_system->get_models();
			foreach($models as $model=>$val){
				$model_info = $this_system->get_model($model);
				foreach($model_info['filterable_fields'] as $filterable_field){
					$model_alias .= $div.$model_info['alias'].'->'.$filterable_field['alias'];
					$div = ',';	
				}
			}
			if($model_alias) message(p8lang($P8LANG['cms_category_set_htmlize_fail'], array($model_alias)));
		}
		$this_module->cache();
	break;
	
	default:
		//批量修改栏目排序
		$display_order = isset($_POST['_display_order']) ? array_map('intval', (array)$_POST['_display_order']) : array();
		
		foreach($display_order as $id => $order){
			$id = intval($id);
			
			$DB_master->update(
				$this_module->table,
				array('display_order' => $order),
				"id = '$id'"
			);
		}
		
		$display_order && $this_module->cache();
		
	}
	
	message('done');
	
}
