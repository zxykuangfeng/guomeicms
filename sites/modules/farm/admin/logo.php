<?php
defined('PHP168_PATH') or die();

$mysites = $this_system->get_manage_sites();
$mysites || $this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$site_edit = $this_controller->check_admin_action('site_edit');
	load_language($core, 'config');
	$select = select();
	$select->from($this_module->table, '*');
	$select->in('alias',$mysites);
	$select->order('sort DESC');
	//echo $select->build_sql();
	$lists = $core->list_item($select,array('page_size' => 0,'ms' => 'master'));
	$list = array();
	foreach($lists as $item){
		$config = mb_unserialize($item['config']);
		$item['authentication_mark'] = isset($config['authentication_mark']) && $config['authentication_mark'] ? 1 : 0;		
		$item['logo'] = isset($config['logo']) && $config['logo'] ? attachment_url($config['logo'],false,true):'';
		$item['logo_motto'] = isset($config['logo_motto']) && $config['logo_motto'] ? attachment_url($config['logo_motto'],false,true):'';
		$item['logo_header'] = isset($config['logo_header']) && $config['logo_header'] ? attachment_url($config['logo_header'],false,true):'';
		$item['logo_footer'] = isset($config['logo_footer']) && $config['logo_footer'] ? attachment_url($config['logo_footer'],false,true):'';
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
	
	include template($this_module, 'logo', 'admin');

}else if(REQUEST_METHOD == 'POST'){

	//批量LOGO
	foreach($_POST['logo'] as $alias => $logo){
		$data = $this_module->get_site($alias);
		$data['config'] = mb_unserialize($data['config']);
		$data['config']['logo'] = $logo ? attachment_url(html_entities($logo), true):'';
		$data['config']['logo_motto'] = $_POST['logo_motto'][$alias] ? attachment_url(html_entities($_POST['logo_motto'][$alias]), true):'';
		$data['config']['logo_header'] = $_POST['logo_header'][$alias] ? attachment_url(html_entities($_POST['logo_header'][$alias]), true):'';
		$data['config']['logo_footer'] = $_POST['logo_footer'][$alias] ? attachment_url(html_entities($_POST['logo_footer'][$alias]), true):'';
		$data['config'] = empty($data['config']) ? '' : serialize($data['config']);
		if($data['config']){
			$DB_master->update(
				$this_module->table,
				array(
					'config' => $data['config']
				),
				"alias = '$alias'"
			);
		}
	}
	$this_module->cache();
	$this_system->log(array(
		'title' => $P8LANG['_module_logo_admin_log'],
		'request' => $_POST,
	));
	message('done');	
}
