<?php
defined('PHP168_PATH') or die();

//$this_system->check_manager($ACTION) or message('no_privilege');
$IS_FOUNDER or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	$config = $core->get_config($this_system->name, $this_module->name);
	
	$info = include $this_module->path. '#.php';
	load_language($core, 'config');
	$site = isset($_GET['site']) ? trim($_GET['site']) : '';
	
	include template($this_module, 'config', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$_POST = p8_stripslashes2($_POST);
	
	$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();	
	$site = isset($_POST['site']) && !empty($_POST['site']) ? trim($_POST['site']) : '';
	$orig_htmlize = $this_module->CONFIG['htmlize'];
	//来源类别
	$config['author_required'] = isset($config['author_required']) && $config['author_required'] ? 1 : 0;
	$config['source_required'] = isset($config['source_required']) && $config['source_required'] ? 1 : 0;
	$config['verify_frame_editable'] = isset($config['verify_frame_editable']) && $config['verify_frame_editable'] ? 1 : 0;	
	$config['verify_frame_required'] = isset($config['verify_frame_required']) && $config['verify_frame_required'] ? 1 : 0;
	$config['verify_frame_show'] = isset($config['verify_frame_show']) && $config['verify_frame_show'] ? 1 : 0;
	$config['menu_verify_frame'] = $config['verify_frame_editable'] ? intval($config['menu_verify_frame']) : 1;
	$source = isset($_POST['source']) && is_array($_POST['source']) ? $_POST['source'] : array();	
	$source_delete = isset($_POST['source_delete'])? $_POST['source_delete'] : array();	
	foreach($source['name'] as $k=>$v){
		$config['source'][$k]['name'] = trim($source['name'][$k]);
		$config['source'][$k]['url'] = trim($source['url'][$k]);
	}
	if(!empty($source_delete)){
		foreach($source_delete as $v){
			unset($config['source'][$v]);
		}
	}
	//如果开启或关闭静态化,应用到所有分类
	if(
		isset($config['htmlize']) && !empty($_POST['htmlize_apply_category']) &&
		$orig_htmlize != $config['htmlize']
	){
		$htmlize = intval($config['htmlize']);
		$category = &$this_system->load_module('category');
		$DB_master->update(
			$category->table,
			array('htmlize' => $htmlize),
			$site ? "site='".$site."'" : ""
		);
		//更新分类的缓存
		$category->cache();
	}
	
	//这两个参数很危险,会放到eval
	if(!empty($config['dynamic_list_url_rule'])) $config['dynamic_list_url_rule'] = html_entities($config['dynamic_list_url_rule']);
	if(!empty($config['dynamic_view_url_rule'])) $config['dynamic_view_url_rule'] = html_entities($config['dynamic_view_url_rule']);
	//这两个参数很危险,会放到eval
	
	$this_module->set_config($config);
	
	message('done');
}
