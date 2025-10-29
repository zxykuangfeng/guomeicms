<?php
defined('PHP168_PATH') or die();

$uploader = &$core->load_module('uploader');
//开启上传功能
require $uploader->path .'inc/enables.php';
//上传模块挂勾到本模块
$uploader->hook($this_system->name, $this_module->name, 'form_id');

$this_module->set_config(array(
	'htmlize' => 1,
	'htmlize_post' => 1,
	'htmlize_list' => 1,
	'htmlize_view' => 1,
	'html_post_url_rule' => '{$core_url}/html/forms/{$model_name}/post.html',
	'dynamic_list_url_rule' => '{$module_controller}-list-mid-{$id}#-page-{$page}#.html',
	'dynamic_view_url_rule' => '{$module_controller}-view-id-{$id}.html',
	'html_post_url_rule' => '{$module_url}/html/forms/{$model_name}/post.html',
	'html_list_url_rule' => '{$core_url}/html/forms/{$model_name}/list_{$id}#-page-{$page}#.html',
	'html_view_url_rule' => '{$core_url}/html/forms/{$model_name}/view_{$id}.html',
	'status' => array(
		'-1'=>$P8LANG['tender_send_back'],
		'0' =>$P8LANG['tender_no_manage'],
		'1' =>$P8LANG['tender_managing'],
		'9' =>$P8LANG['tender_had_manage'],
		'99' =>$P8LANG['tender_recommend']),
	'view_page_cache_ttl' => 0,
	'html_list_size' >5,
));
