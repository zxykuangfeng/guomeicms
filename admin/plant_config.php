<?php
defined('PHP168_PATH') or die();

/**
* 数据展示配置管理
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	load_language($core, 'config');

	$config = html_entities($core->get_config('core', ''));
	$blocks = array('left_t','left_c','left_b','center_t','center_c','center_b','right_t','right_c','right_b');
	//vertical horizontal
	$models = array(
		'cms_category_bar','cms_category_bar_cids','cms_post_everyday',
		'cms_author_post_bar','sites_count_all',
		'sites_count_year','sites_count_month','sites_count_today',
		'sites_count_today_stacked','sites_count_today3',
		'sites_count_today_stacked_area','sites_count_today_stacked_area3',		
		'sites_author_post_bar','sites_push_all','sites_push_year',
		'sites_push_month','sites_count_year3','sites_count_month3',
		'dept_count','role_borderRadius','role_pie','disk_free_space','clock',
		'sites_count_day7','sites_count_hour24','sites_push_day7'
	);
	//初始化
	$config['plant']['map_show'] = isset($config['plant']['map_show']) && $config['plant']['map_show'] ? 1 : 0;
	foreach($blocks as $key=>$block){
		$config['plant'][$key]['show'] = isset($config['plant'][$key]['show']) ? $config['plant'][$key]['show'] : 1;
		$config['plant'][$key]['title_type'] = isset($config['plant'][$key]['title_type']) ? $config['plant'][$key]['title_type'] : rand(0,1);
		$config['plant'][$key]['direct'] = isset($config['plant'][$key]['direct']) ? $config['plant'][$key]['direct'] : rand(0,1);
	}
	include template($core, 'config/plant_config', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$_POST = p8_stripslashes2($_POST);
	
	$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();
	
	$orig_admin_controller = $core->CONFIG['admin_controller'];
	
	$core->set_config($config);
	
	message('done',$this_url);
}
