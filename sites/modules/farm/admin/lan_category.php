<?php
defined('PHP168_PATH') or die();

$mysites = $this_system->get_manage_sites();
$mysites || $this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$site_edit = $this_controller->check_admin_action('site_edit');
	$templates = $this_module->get_sites_templates();
	$allow_template = $this_system->check_manager('template');
	load_language($core, 'config');
	$select = select();
	$select->from($this_module->table, '*');
	$select->in('alias',$mysites);
	$select->order('sort DESC');
	//echo $select->build_sql();
	$lists = $core->list_item($select,array('page_size' => 0,'ms' => 'master'));
	//var_dump($lists);
	$list = array();
	foreach($lists as $item){
		$config = mb_unserialize($item['config']);
		$item['authentication_mark'] = isset($config['authentication_mark']) && $config['authentication_mark'] ? 1 : 0;
		$item['lan_category'] = isset($config['lan_category']) && $config['lan_category'] ? explode(',',$config['lan_category']) : '';
		$item['lan_category_path'] = '';
		if($item['lan_category']){			
			foreach($item['lan_category'] as $cid){				
				$data = $this_system->fetch_category($cid,true,$item['alias']);
				$html_paths = [$data['name']]; // 以当前节点的名称开始路径数组	
				// 递归查找父节点直到根节点
				while ($data['parent'] != 0) {
					$data = $this_system->fetch_category($data['parent'],true,$item['alias']);
					array_unshift($html_paths, $data['name']);
				}				
				$item['lan_category_path'] .= implode(' &gt; ', $html_paths)."<br>";
			}		
		}
		if($item['parent'] == 0) {
		  $list[$item['id']] = $item;
		  $list[$item['id']]['child'] = array();
		}else{
		  $list[$item['parent']]['child'][]= $item;
		}
    }
	
	foreach($list as $id=>$item){
		if(!isset($item['alias'])) {
			$alias_info = $this_module->get_parent_site($id);
			$list[$id]['alias'] = $alias_info['alias'];
			$list[$id]['sitename'] = $alias_info['sitename'];
			$list[$id]['status'] = $alias_info['status'];
			$list[$id]['timestamp'] = $alias_info['timestamp'];
			$list[$id]['sort'] = $alias_info['sort'];
		}
	}
	//站点信息
	$site = !empty($_GET['site']) ? $_GET['site'] : $_GET['alias'];	
	$site = in_array(clear_special_char($site),array_keys($this_system->sites)) ? clear_special_char($site) : $this_system->SITE;	
	$site_info = $this_system->get_site($site);	
	include template($this_module, 'lan_category', 'admin');

}else if(REQUEST_METHOD == 'POST'){

	//批量模板风格设置
	foreach($_POST['template'] as $alias => $template){		
		$DB_master->update(
			$this_module->table,
			array(
				'template' => $template
			),
			"alias = '$alias'"
		);		
	}
	$this_module->cache();
	$this_system->log(array(
		'title' => $P8LANG['_module_template_admin_log'],
		'request' => $_POST,
	));
	message('done');	
}
