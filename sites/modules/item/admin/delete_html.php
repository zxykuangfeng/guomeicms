<?php
defined('PHP168_PATH') or die();

/**
* 删除超年限的html
**/
@set_time_limit(0);
$this_controller->check_admin_action($ACTION) or exit('[]');

load_language($core, 'config');
$config = $core->get_config($this_system->name, $this_module->name);
$lan_date_enable = isset($config['lan_date_enable']) && $config['lan_date_enable'] ? true : false;
$lan_date_timestamp = isset($config['lan_date']) && $config['lan_date'] ? intval($config['lan_date']) : 0;
if(!$lan_date_enable || !$lan_date_timestamp){
	message('没有启用超年限内容限定访问或设置时间节点');
}
$category = &$this_system->load_module('category');
$allsites = $this_system->get_sites();
if(!$this_system->SITE) $this_system->SITE = key($allsites);
$this_site = $this_system->SITE;

$site_flag = isset($_GET['site_flag']) && $_GET['site_flag'] ? $this_system->SITE : '';	
if($site_flag){
	$allsites = array(
		$site_flag => '1',
	);
}
require_once PHP168_PATH .'inc/html.func.php';

$count = 0;

//var_dump($allsites);exit;
$this_module->CONFIG['htmlize'] = 1;
foreach($allsites as $site => $site_info){
	if(!$site) continue;	
	//$this_system->load_site($site);	
	$farm_data = $core->CACHE->read($this_system->name .'/modules/', 'farm', $site);
	$category_data = $core->CACHE->read($this_system->name .'/modules/category',$site,'categories','serialize');
	
	$lan_category = isset($farm_data['config']['lan_category']) && $farm_data['config']['lan_category'] ? explode(',',$farm_data['config']['lan_category']) : array();
	$lan_category = array_filter($lan_category);
	
	$where = "`timestamp` < $lan_date_timestamp";
	$where .= " and `site` = '$site'";	
	if(count($lan_category)) $where .= " and `cid` not in (".implode(',',$lan_category).")";	
	//var_dump($where);echo "<br>";
	$query = $DB_master->query("SELECT * FROM $this_module->main_table where $where");
	
	while($arr = $DB_master->fetch_array($query)){
		//获取要删除的HTML文件
		$category_data['categories'][$arr['cid']]['htmlize'] = 1;
		$arr['#category'] = $category_data['categories'][$arr['cid']];
		$file = p8_html_url($this_module, $arr, 'view', false);
		$file = str_replace('/sites//','/sites/html/'.$arr['site'].'/',$file);
		$_no_page_file = preg_replace('/#([^#]+)#/', '', $file);
		$_page_file = preg_replace('/#([^#]+)#/', '$1', $file);		
		for($i = 1; $i <= $arr['pages']; $i++){
			$file = $i == 1 ? $_no_page_file : str_replace('?page?', $i, $_page_file);
			if($file){
				$count++;
				@unlink($file);
			}		
		}
		
	}
	
}
if($this_site != $this_system->SITE) $this_system->load_site($this_site);
if($site_flag){
	echo p8_json(array('1'));
	exit;
}
if($count)
	message(p8lang($P8LANG['sites_item']['delete_html_pages'], $count),$FROMURL,3);
else
	message($P8LANG['sites_item']['no_delete_any_pages'],$FROMURL,3);

