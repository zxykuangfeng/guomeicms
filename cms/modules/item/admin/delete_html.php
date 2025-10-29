<?php
defined('PHP168_PATH') or die();

/**
* 删除超年限的html
**/

$this_controller->check_admin_action($ACTION) or exit('[]');

load_language($core, 'config');
$config = $core->get_config($this_system->name, $this_module->name);
$lan_date_enable = isset($config['lan_date_enable']) && $config['lan_date_enable'] ? true : false;
$lan_date_timestamp = isset($config['lan_date']) && $config['lan_date'] ? intval($config['lan_date']) : 0;
if(!$lan_date_enable || !$lan_date_timestamp){
	message('没有启用超年限内容限定访问或设置时间节点');
}
$category = &$this_system->load_module('category');
$category->get_cache();

$lan_category = isset($config['lan_category']) && $config['lan_category'] ? explode(',',$config['lan_category']) : array();
$lan_category = array_filter($lan_category);

$where = "timestamp < $lan_date_timestamp";
if(count($lan_category)) $where .= " and cid not in (".implode(',',$lan_category).")";

$query = $DB_master->query("SELECT * FROM $this_module->main_table where $where");
require_once PHP168_PATH .'inc/html.func.php';
$count = 0;
$this_module->CONFIG['htmlize'] = 1;
while($arr = $DB_master->fetch_array($query)){	
		//获取要删除的HTML文件
		$category->categories[$arr['cid']]['htmlize'] = 1;
		$arr['#category'] = &$category->categories[$arr['cid']];
		$file = p8_html_url($this_module, $arr, 'view', false);
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
if($count)
	message(p8lang($P8LANG['cms_item']['delete_html_pages'], $count),$FROMURL,3);
else
	message($P8LANG['cms_item']['no_delete_any_pages'],$FROMURL,3);

