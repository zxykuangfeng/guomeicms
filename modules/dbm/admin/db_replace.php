<?php
defined('PHP168_PATH') or die();

/**
* 表管理
**/

$this_controller->check_admin_action('') or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$job = 'replace';
	$sitesd = isset($core->systems['sites']) && $core->systems['sites']['installed']; 	
	$config = $core->get_config('core','');
	if(!isset($config['executesql']) || !$config['executesql']) message('executesql_unable');
	$systems = $core->list_systems();	
	unset($systems['ask']);
	$model = array();
	foreach($systems as $system){		
		if(!$system['enabled']) continue;
		$tmp_sys = $core->load_system($system['name']);
		$models = $tmp_sys->load_module('model');	
		
		$select = select();
		$select->from($models->table, '*');	
		$list = $core->list_item(
			$select,
			array(
				'page_size' => 0,
				'ms' => 'master'
			)
		);		
		foreach($list as $item){
			if($item['enabled']) $model[$system['name']]['item'][] = $item;
		}
		$model[$system['name']]['group'] = $system['alias'];
	}
	include template($this_module, 'replace', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$config = $core->get_config('core','');
	if(!isset($config['executesql']) || !$config['executesql']) message('executesql_unable');
	$_POST = p8_stripslashes2($_POST);
	if(!isset($_POST['model'])) message('model_select');
	$search = isset($_POST['search']) ? p8_stripslashes2($_POST['search']) : '';
	$replace = isset($_POST['replace']) ? p8_stripslashes2($_POST['replace']) : '';
	if(empty($replace) || empty($search)) message('replace_search_require');
	$model = explode('|',$_POST['model']);	
	$main_table = '';
	$conditon = '';
	if(in_array($model[0],array('cms','sites'))) {		
		if($model[0] == 'sites' && $model[1] == 'menu'){
			$main_table = $core->TABLE_.'sites_menu';	
			if($main_table && $search && $replace) {
				$conditon = isset($_POST['conditon']) && !empty($_POST['conditon']) ? ' WHERE '.p8_stripslashes2($_POST['conditon']) : " WHERE 1='1'";
				$fields_main = array(array('Field'=>'name'),array('Field'=>'url'),array('Field'=>'dynamic_url'));
				$this_module->table_replace(array($main_table), $search, $replace, $fields_main, $conditon);
			}
		}else if($model[1] == 'category'){
			$main_table = $core->load_system($model[0])->load_module('category')->table;	
			if($main_table && $search && $replace) {
				$conditon = isset($_POST['conditon']) && !empty($_POST['conditon']) ? ' WHERE '.p8_stripslashes2($_POST['conditon']) : " WHERE 1='1'";
				$fields_main = array(array('Field'=>'name'),array('Field'=>'url'));
				$this_module->table_replace(array($main_table), $search, $replace, $fields_main, $conditon);
			}
		}else if($model[1] == 'arturl'){
			$main_table = $core->load_system($model[0])->load_module('item')->main_table;		
			if($main_table && $search && $replace) {
				$table_model = $main_table . '_article_';
				$conditon = isset($_POST['conditon']) && !empty($_POST['conditon']) ? ' WHERE '.p8_stripslashes2($_POST['conditon']) . " AND `model`='$model[1]'" : " WHERE `model`='$model[1]'";
				$fields_main = array(array('Field'=>'url'));
				$this_module->table_replace(array($main_table), $search, $replace, $fields_main, $conditon);
				$this_module->table_replace(array($table_model), $search, $replace, $fields_main, $conditon);
			}
		}else{
			$main_table = $core->load_system($model[0])->load_module('item')->main_table;		
			if($main_table && $search && $replace) {
				$table_model = $main_table . '_' . $model[1] . '_';
				$table_addon = $main_table . '_' . $model[1] . '_addon';
				$conditon = isset($_POST['conditon']) && !empty($_POST['conditon']) ? ' WHERE '.p8_stripslashes2($_POST['conditon']) . " AND `model`='$model[1]'" : " WHERE `model`='$model[1]'";
				$fields_main = array(array('Field'=>'title'),array('Field'=>'sub_title'),array('Field'=>'summary'),array('Field'=>'url'));
				$fields_addon = array(array('Field'=>'addon_title'),array('Field'=>'content'),array('Field'=>'addon_summary'));

				$this_module->table_replace(array($main_table), $search, $replace, $fields_main, $conditon);
				$this_module->table_replace(array($table_model), $search, $replace, $fields_main, $conditon);
				$this_module->table_replace(array($table_addon), $search, $replace, $fields_addon);
			}
		}
	}else{
		if($model[0] == 'frame_url'){
			$systems = $core->list_systems();
			unset($systems['ask']);
			foreach($systems as $system){
				$tmp_sys = $core->load_system($system['name']);
				$models = $tmp_sys->load_module('model');				
				$select = select();
				$select->from($models->table, '*');					
				$list = $core->list_item(
					$select,
					array(
						'page_size' => 0,
						'ms' => 'master'
					)
				);
				$conditon = isset($_POST['conditon']) && !empty($_POST['conditon']) ? ' WHERE '.p8_stripslashes2($_POST['conditon']) : '';
				$fields_main = array(array('Field'=>'frame'),array('Field'=>'verify_frame'));
				$main_table = $tmp_sys->load_module('item')->main_table;								
				$this_module->table_replace(array($main_table), $search, $replace, $fields_main, $conditon);
				foreach($list as $model){				
					$table_model = $main_table . '_' . $model['name'] . '_';
					$conditon = isset($_POST['conditon']) && !empty($_POST['conditon']) ? ' WHERE '.p8_stripslashes2($_POST['conditon']) . " AND `model`='$model[name]'" : " WHERE `model`='$model[name]'";
					$this_module->table_replace(array($table_model), $search, $replace, $fields_main, $conditon);				
				}
			}
			
		}else if($model[0] == 'navigation_menu'){
			$main_table = $core->TABLE_.'navigation_menu';
			$conditon = isset($_POST['conditon']) && !empty($_POST['conditon']) ? ' WHERE '.p8_stripslashes2($_POST['conditon']) : ' WHERE 1=1';
			$fields_main = array(array('Field'=>'name'),array('Field'=>'url'));					
			$this_module->table_replace(array($main_table), $search, $replace, $fields_main, $conditon);	
		}else if($model[0] == 'label'){
			$type = $model[1];
			$conditon = isset($_POST['conditon']) && !empty($_POST['conditon']) ? ' WHERE '.p8_stripslashes2($_POST['conditon']) . " AND `type`='$type'" : " WHERE `type`='$type'";
			$main_table = $core->TABLE_.'label';
			if($type == 'html') {
				$fields_main = array(array('Field'=>'content'));				
				$this_module->table_replace(array($main_table), $search, $replace, $fields_main, $conditon);
			}else{
				$fields_main = array(array('Field'=>'option'));				
				$this_module->option_replace($main_table, $search, $replace, $fields_main, $conditon);
			}
		}else{
			message('fail');
		}
	}   
	message('done', HTTP_REFERER);	
}
