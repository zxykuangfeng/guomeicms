<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action('rule') or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

	$id or message('no_such_item');
    
    

	$this_module->get_cache();
	
	$data = $this_module->get_rule($id, true);
	$data or message('no_such_item');


    if(isset($_GET['save_space'])){
        $save_space = trim($_GET['save_space']);
        $data['data']['save_space'] = $save_space;
    }

    if($data['data']['save_space']=='cms') {
        $content_system = $core->load_system('cms');
        $categoryjson = $content_system->controller.'/category-json';
    }elseif($data['data']['save_space']=='sites') {
        $site = $data['data']['sites_alias'];
        if(isset($_GET['site'])){
            $site = $_GET['site'];
            $data['data']['sites_alias'] =$site;
        }

        $content_system = $core->load_system('sites');
        $categoryjson = $content_system->siteurl.'/category-json?site='.$site;
    }

	include template($this_module, 'rule_edit', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$id = isset($_POST['id']) ? intval($_POST['id']) : '';
	
	$_POST = p8_stripslashes2($_POST);
	
	$this_controller->update_rule($id, $_POST);
	
	message('done');
}
