<?php
defined('PHP168_PATH') or die();

/**
* 登录
**/
$cms_system = $core->load_system('cms');
$cms_item = $cms_system->load_module('item');
$cms_enable = $core->controller($cms_item )->check_action('add');
$sites_system = $core->load_system('sites');
$sites_item = $sites_system->load_module('item');
$this_module = $core->load_module('member');
$all_sites = $sites_system->get_sites();
$manage_sites = $sites_system->get_manage_sites();
$poster_sites = $sites_system->get_poster_site();
$action_sites = array();
$acls = array();

foreach($all_sites as $keys => $v){
	$acls = $this_module->get_acl($sites_item, $UID, $keys);
	if($acls && $acls['actions']['add']){
		$action_sites[] = $keys;
	}
	if($acls && !empty($acls['category_acl'])){
		$action_sites[] = $keys;
	}
}
$mysites = array_unique(array_merge($manage_sites,$poster_sites,$action_sites));
if(!empty($sites_system) && !empty($mysites)){
	$allsites  = $sites_system->get_sites();
	foreach($mysites as $key=>$site_each){
		if(empty($allsites[$site_each]['status'])) unset($mysites[$key]);
	}
	/*
	if(count($mysites) == 1){
		$uc_url = $core->U_controller.'?site='.$mysites[0];
		header("location:{$uc_url}");
		exit;
	}
	*/	
	$member_info = get_member($USERNAME);
	include template($this_module, 'mysites');	
}else{
	$uc_url = $core->U_controller.'?site=mainstation';
	header("location:{$uc_url}");
	exit;
}