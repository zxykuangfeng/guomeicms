<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action('rule') or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
    $save_space = isset($_GET['save_space']) ? trim($_GET['save_space']) : 'cms';
    $data['data']['save_space'] = $save_space;

	$this_module->get_cache();
    if($save_space=='cms') {
        $content_system = $core->load_system('cms');
        $categoryjson = $content_system->controller.'/category-json';
    }elseif($save_space=='sites') {
        $site = $_GET['site'];
        $data['data']['sites_alias'] =$site;
        $content_system = $core->load_system('sites');
        $categoryjson = $content_system->siteurl.'/category-json';
    }
	include template($this_module, 'rule_edit', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$_POST = p8_stripslashes2($_POST);
	
	$this_controller->add_rule($_POST) or message('fail');
	
	message('done');
}
