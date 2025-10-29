<?php
defined('PHP168_PATH') or die();

/**
* 组织架构管理
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$config = $core->get_config($SYSTEM, $MODULE);
	$config['statistic_start_date'] = isset($config['statistic_start_date']) && $config['statistic_start_date'] ? date('Y-m-d H:i:s',$config['statistic_start_date']) : '';
	$config['statistic_end_date'] = isset($config['statistic_end_date']) && $config['statistic_end_date'] ? date('Y-m-d H:i:s',$config['statistic_end_date']) : '';
	
	$role = $core->load_module('role');
	load_language($role, 'global');
	$act = isset($_GET['act']) ? $_GET['act'] : '';
	$parent = isset($_GET['parent']) ? intval($_GET['parent']) : 0;
	$parentid = 0;
	if($parent) $parent_info = $this_module->view_dept($parent);
	$parentid = $parent_info['parent'] ? $parent_info['parent'] : 0;
	$parents = array();
	$sql = "SELECT * FROM $this_module->dept_table WHERE parent = '$parent' LIMIT 1";
	
	do{
		if(empty($data)){
			$data = array(
				'parent' => $parent
			);
		}
		array_unshift($parents, $data['parent']);
		$sql = "SELECT * FROM $this_module->dept_table WHERE id = '$data[parent]' LIMIT 1";
		
	}while($data = $DB_master->fetch_one($sql));
	
	$select = select();
	$select->from($this_module->dept_table, '*');
	$select->in('parent', $parents);
	$select->order('display_order DESC');	
	
	$list = $core->list_item(
		$select,
		array(
			'count' => 0,
			'page' => 0
		)
	);	
	
	include template($this_module, 'dept', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	$_POST = p8_stripslashes2($_POST);
	
	$act = isset($_POST['act']) ? $_POST['act'] : '';	
	
	switch($act){
		case 'cache':
			$this_module->cache_dept();		
		break;
		
		case 'config':
			$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();
			$config['statistic_start_date'] = isset($config['statistic_start_date']) && $config['statistic_start_date'] ? strtotime($config['statistic_start_date']) : 0;
			$config['statistic_end_date'] = isset($config['statistic_end_date']) && $config['statistic_end_date'] ? strtotime($config['statistic_end_date']) : 0;
			if($config['statistic_start_date'] >= $config['statistic_end_date']) message('statistic_date_err');
			$this_module->set_config($config);
		break;
		
		case 'fix':
			//修复栏目内容数
			$DB_master->update($this_module->dept_table, array('item_count' => 0,'item_score' => 0,'item_count_sites' => 0,'item_score_sites' => 0), '');
			$config = $core->get_config($SYSTEM, $MODULE);		
			//1970-01-01
			$statistic_start_date = isset($config['statistic_start_date']) && $config['statistic_start_date'] ? intval($config['statistic_start_date']) : 0;		
			//2050-01-01
			$statistic_end_date = isset($config['statistic_end_date']) && $config['statistic_end_date'] ? intval($config['statistic_end_date']) : 2524579200;
			$systems = $core->list_systems();
			foreach($systems as $sys=>$system){
				if(!in_array($sys,array('cms','sites'))) continue;
				if($system['installed'] && $system['enabled']){
					$this_sys = $core->load_system($sys);			
					$item = $this_sys->load_module('item');					
					$where = "m.dept2 >0 and i.timestamp >= $statistic_start_date and i.timestamp <= $statistic_end_date";
					if($sys == 'sites'){
						$all_sites = $this_sys->get_sites();
						foreach($all_sites as $site=>$site_tmp){							
							if(empty($site_tmp['status'])) unset($all_sites[$site]);
						}						
						$where .= ' and i.site in (\''. implode("','",array_keys($all_sites)) .'\')';
					}
					$SQL = "SELECT m.dept2 as dept, COUNT(*) AS `count` FROM $item->main_table AS i INNER JOIN $this_module->table AS m ON i.uid = m.id WHERE $where and i.score>0  GROUP BY dept";
					$list = $DB_master->fetch_all($SQL);
					$score_list = array();
					foreach($list as $score){
						$score_list[$score['dept']] = $score['count'];
					}
					$SQL = "SELECT m.dept2 as dept, COUNT(*) AS `count` FROM $item->main_table AS i INNER JOIN $this_module->table AS m ON i.uid = m.id WHERE $where  GROUP BY dept";
					$query = $DB_master->query($SQL);
					while($arr = $DB_master->fetch_array($query)){
						$this_module->update_count($sys,$arr['dept'], $arr['count'],intval($score_list[$arr['dept']]['count']));
					}
					
				}
			}
		break;
		
		default:	
			$parent = isset($_POST['parent']) ? intval($_POST['parent']) : 0;
			$post = isset($_POST['post']) ? (array)$_POST['post'] : array();
			$name = isset($post['name']) ? (array)$post['name'] : array();
			
			foreach($name as $k => $v){
				if(!empty($post['name'][$k]))
				$id = $this_module->add_dept(array(
					'parent' => $parent,
					'name' => $post['name'][$k],
					'display_order' => isset($post['display_order'][$k]) ? $post['display_order'][$k] : 0
				));
			}
			
			$updates = isset($_POST['update']) ? filter_int($_POST['update']) : array();
			foreach($updates as $v){
				$DB_master->update(
					$this_module->dept_table,
					array(
						'name' => isset($_POST['name'][$v]) ? html_entities($_POST['name'][$v]) : '',
						'display_order' => isset($_POST['display_order'][$v]) ? html_entities($_POST['display_order'][$v]) : '',
					),
					"id = '$v'"
				);
			}
			
			$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
			if($id){
				$DB_master->delete(
					$this_module->dept_table,
					'id IN ('. implode(',', $id) .')'
				);
			}
			$this_module->cache_dept();				
	}
	message('done', HTTP_REFERER);
	
}
