<?php
defined('PHP168_PATH') or die();

$this_system->check_manager($ACTION) or message('no_privilege');
if(REQUEST_METHOD == 'GET'){
	$menus = $this_module->get_menu($this_system->SITE,false);
	$data = $this_module->get_site($this_system->SITE);
    $data['config'] = mb_unserialize($data['config']);
	$item_config = $core->get_config('sites','item');	
	$menu_mode = intval($data['config']['menu_mode']);	
	//站点信息
	$site = !empty($_GET['site']) ? $_GET['site'] : $_GET['alias'];	
	$site = in_array(clear_special_char($site),array_keys($this_system->sites)) ? clear_special_char($site) : $this_system->SITE;	
	$site_info = $this_system->get_site($site);	
	include template($this_module, 'menu_list', 'admin');

}else if(REQUEST_METHOD == 'POST'){
	$_POST = p8_stripslashes2($_POST);
	$type = isset($_POST['type']) ? trim($_POST['type']) : '';
	$data = $this_module->get_site($this_system->SITE);
	$set_data['config'] = mb_unserialize($data['config']);	
	switch($type){
		case 'html':
			$this_module->change_url($this_system->SITE,'html');
			$this_module->cache($this_system->SITE);
		break;
		case 'dynamic':
			if($set_data['config']['menu_change_forbidden']) message('menu_change_forbidden');
			$this_module->change_url($this_system->SITE,'dynamic');			
			$this_module->cache($this_system->SITE);
		break;
		case 'config':
			$set_data['config']['menu_mode'] = isset($_POST['config']['menu_mode']) ? intval($_POST['config']['menu_mode']) : 0;
			$set_data['config']['menu_change_forbidden'] = isset($_POST['config']['menu_change_forbidden']) ? intval($_POST['config']['menu_change_forbidden']) : 0;
			$set_data['config'] = serialize($set_data['config']);
			$this_module->set_farm_config($this_system->SITE,$set_data);			
		break;
		default:
			$this_module->cache();
	}
	//静态首页
	$form = '<form action="'.$this_system->admin_controller.'-index_to_html" method="post" id="'. $this_system->SITE .'" target="'. $this_system->SITE .'">'.
		'<input type="hidden" name="'.$this_system->SITE.'">'.
		'<input type="hidden" name="site" value="'.$this_system->SITE.'">'.
		'</form>'.
		'<iframe style="display: none;" name="'. $this_system->SITE .'"></iframe>'.
		'<script type="text/javascript">document.getElementById("'. $this_system->SITE .'").submit();</script>';
	message($P8LANG['done'].$form,$this_url,3);
}
