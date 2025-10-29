<?php
defined('PHP168_PATH') or die();

$this_system->check_manager($ACTION) or message('no_privilege');


//本站栏目快捷发布菜单
$custom_menu = $CACHE->read($this_system->name.'/menu_custom', $this_system->SITE);

//本站专属个性化导航
$menu_nav = $CACHE->read($this_system->name.'/menu_nav', $this_system->SITE);

//用户专属个性化导航
$menu_user = $CACHE->read($this_system->name.'/menu_user', $UID);


//站群通用导航
$menus = $CACHE->read($this_system->name.'/menu', '_index_menu_');

include template($this_system, 'index_menu', 'admin');
