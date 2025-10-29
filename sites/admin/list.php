<?php
defined('PHP168_PATH') or die();

$this_module = &$this_system->load_module('category');
if(REQUEST_METHOD == 'GET'){
	
	$MODEL = isset($_GET['model']) ? $_GET['model'] : '';

	$models = $this_system->get_models();
	$verified = 1;
	
	$path = array();
	$allsites = $this_system->get_sites();
	$sitenames = array();
	foreach($allsites as $_name =>$_sites){
		$sitenames[$_name] = $_sites['sitename'];
		if(empty($_sites['status'])) unset($allsites[$_name]);
	}
	$sitenames_json = p8_json($sitenames);
	$allsite_alias = p8_json(array_keys($allsites));
	
	load_language($this_module,'global');
	if(!P8_AJAX_REQUEST){
		$mysites = $IS_FOUNDER ? array_keys($allsites) : $this_system->get_manage_sites();
		include template($this_system, 'list', 'admin');
		exit;
	}
	@set_time_limit(60);	
	$site = !empty($_GET['site']) ? $_GET['site'] : '';
	if(empty($site)) return;
	$keyword = isset($_GET['word']) ? trim($_GET['word']) : '';
	$imp_cid = isset($_GET['imp_cid']) ? intval($_GET['imp_cid']) : 0;
	
	$this_module->get_cache(false,$site);
	
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
	$farm_module = &$this_system->load_module('farm');
	$farm_data = $farm_module->get_site($site);
    $farm_data['config'] = p8_stripslashes(mb_unserialize($farm_data['config']));
	$statistic_cats = isset($farm_data['config']['statistic_cats']) && $farm_data['config']['statistic_cats'] ? array_map('intval',$farm_data['config']['statistic_cats']) : array();
	$show_data = $this_module->top_categories;
	//var_dump($keyword);
	if($keyword){
		foreach($show_data as $key=>$item){			
			if(stripos($item['name'],$keyword) == false){
				unset($show_data[$key]);
			}
		}
	}
	//var_dump($statistic_cats);
//	echo "<br>";
	if($imp_cid){
		foreach($show_data as $key=>$item){
			$ids = array($item['id']) + $this_module->get_children_ids($item['id']);
			$has_array_intersect =  array_intersect($ids,$statistic_cats);
			if(empty($has_array_intersect)){
				unset($show_data[$key]);
			}else{
				foreach($item['categories'] as $ckey=>$categories){
					$ids = array($categories['id']) + $this_module->get_children_ids($categories['id']);
					$has_array_intersect =  array_intersect($ids,$statistic_cats);
					if(empty($has_array_intersect)){
						unset($show_data[$key]['categories'][$ckey]);
					}
				}
			}
		}
	}
	echo p8_json(array(
		'json' => $this_module->make_json_sort($show_data),
		'path' => $path,
		'models' => $models,
		'sums' => $sums,
		'statistic_cats' => array_map('intval',$statistic_cats),
	));
	exit;	
	//print_r($this_module->top_categories);
}else if(REQUEST_METHOD == 'POST'){
	$_POST = p8_stripslashes2($_POST);
	$action = @$_POST['action'];
	$allsites = $this_system->get_sites();
	$mysites = $IS_FOUNDER ? array_keys($allsites) : $this_system->get_manage_sites();
	switch($action){
		case 'cache':
			//更新缓存
			foreach($mysites as $do_site_alias){
				$this_module->cache(FALSE,true,array(),$do_site_alias);
			}		
		break;
		case 'fix':
			//修复栏目内容数
			foreach($mysites as $do_site_alias){
				$DB_master->update($this_module->table, array('item_count' => 0), "site='{$do_site_alias}'");
				
				$query = $DB_master->query("SELECT cid, COUNT(*) AS `count` FROM $this_system->item_table WHERE site='{$do_site_alias}' GROUP BY cid");
				while($arr = $DB_master->fetch_array($query)){
					$this_module->update_count($arr['cid'], $arr['count']);
				}
			}
		break;
		
		case 'download':
			load_language($this_module,'global');
			$models = $this_system->get_models();
			$farm_module = &$this_system->load_module('farm');
			$list = array();
			foreach($mysites as $site){
				if(empty($allsites[$site]['status'])) continue;
				$this_module->get_cache(false,$site);				
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
				$farm_data = $farm_module->get_site($site);
				$farm_data['config'] = p8_stripslashes(mb_unserialize($farm_data['config']));
				$statistic_cats = isset($farm_data['config']['statistic_cats']) && $farm_data['config']['statistic_cats'] ? array_map('intval',$farm_data['config']['statistic_cats']) : array();
				$show_data = $this_module->top_categories;
				$show_datas = $this_module->category_formate($show_data);
				foreach($show_datas as $item){
					switch($item['type']){
						case '1': $type = $P8LANG['sites_category_type_1_s'];break;
						case '2': $type = $P8LANG['sites_category_type_2_s'];break;
						case '3': $type = $P8LANG['sites_category_type_3_s'];break;
						default: $type = $P8LANG['sites_category_type_4_s'];
					}					
					$list[] = array(
						'id'=> $item['id'],
						'category_name' => $item['name'],
						'model' => $models[$item['model']]['alias'],
						'type'=> $type,
						'sitename' => $allsites[$item['site']]['sitename'],
						'site' => $item['site'],						
						'htmlize' => $item['htmlize'] == 1 ? $P8LANG['Y'] : $P8LANG['N'],
						'category_count' => in_array($item['id'],$statistic_cats) ? $P8LANG['Y'] : $P8LANG['N'],
						'item_count' => $item['item_count'],
						'views' => $sums[$item['id']],
						'display_order' => $item['display_order'],
					);					
				}
			}				
			$head = array(
				'id'=>'id',		
				'category_name' => $P8LANG['category_name'],		
				'model' => $P8LANG['sites_category_model'],
				'type'=> $P8LANG['sites_category_type'],				
				'sitename' => $P8LANG['sitename'],
				'site' => $P8LANG['sitealias'],
				'htmlize' => $P8LANG['htmlize'],
				'category_count' => $P8LANG['sites_category_count'],
				'item_count' => $P8LANG['sites_category_item_count'],
				'views' => $P8LANG['views'],
				'display_order' => $P8LANG['sites_category_order'],				
			);
			array_unshift($list,$head);
			$list = convert_encode("UTF-8","GB2312",$list);
			require PHP168_PATH.'/inc/csv.class.php';
			$filename = 'category-'.date('Y-m-d-h-i-s', P8_TIME).'.csv';
			$csv = new P8_Csv();
			$csv->data = $list;
			$csv->file = 'php://output';
			header("Content-type:application/vnd.ms-excel;charset=UTF-8");
			header('Last-Modified: '. gmdate('D, d M Y H:i:s', P8_TIME) .' GMT');
			header('Pragma: no-cache');
			header('Content-type: text/csv');
			header('Content-Encoding: none');
			header('Content-Disposition: attachment; filename='. $filename);
			header('Content-type: csv');
			$csv->save();
			exit;
		break;
	}
	$this_system->log(array(
		'title' => isset($P8LANG['_module_'.$action.'_admin_log'])?$P8LANG['_module_'.$action.'_admin_log']:$action,
		'request' => $_POST,
	));
	
	message('done');
}
