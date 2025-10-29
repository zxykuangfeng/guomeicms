<?php
defined('PHP168_PATH') or die();

/**
* 添加模型
**/

$this_system->check_manager($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$menus = $this_module->get_menu($_GET['site']?$_GET['site']:$this_system->SITE);
	$templates = $this_module->get_sites_templates();
	$sites_info = $this_module->get_site($this_system->SITE);
    $sites_config = mb_unserialize($sites_info['config']);
	$menu_mode = intval($sites_config['menu_mode']);
	$domain = $this_system->domain ? $this_system->domain : '';
	$domain = strpos($domain,'/s.php/') ? str_replace('s.php','sites/html',$domain) : $domain;
	//站点信息
	$site = !empty($_GET['site']) ? $_GET['site'] : $_GET['alias'];	
	$site = in_array(clear_special_char($site),array_keys($this_system->sites)) ? clear_special_char($site) : $this_system->SITE;	
	$site_info = $this_system->get_site($site);	
	include template($this_module, 'menu_edit', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	isset($_POST['name']) && strlen($_POST['name']) or message('menu_name_can_not_be_empty');
	$name = html_entities($_POST['name']);	
	//有URL的情况数据可以任意,以URL为准
	$url = isset($_POST['url']) ? $_POST['url'] : '';
	$dynamic_url = isset($_POST['dynamic_url']) ? $_POST['dynamic_url'] : '';
	$target = isset($_POST['target']) ? $_POST['target'] : '';	
	$parent = isset($_POST['parent']) ? intval($_POST['parent']) : 0;		
	$color = isset($_POST['color']) ? $_POST['color'] : '';	
	$display = isset($_POST['display']) ? intval($_POST['display']) : 0;
	$display_order = isset($_POST['display_order']) ? intval($_POST['display_order']) : 0;
	$frame = isset($_POST['frame']) ? attachment_url($_POST['frame'], true) : '';
	$summary = isset($_POST['summary']) ? str_replace(array("\r", "\n", "\t","\r\n"),array("<br>", "", "","<br>"),html_entities($_POST['summary'])) : '';	
	$this_module->add_menu(
		array(
			'name' => $name,
			'parent' => $parent,
			'site' => $_GET['site']?$_GET['site']:$this_system->SITE,
			'color' => $color,
			'url' => $url,
			'target' => $target,
			'display' => $display,
			'display_order' => $display_order,
			'summary' => $summary,
			'frame' => $frame,
			'dynamic_url' => $dynamic_url,
		)
	) or message('fail');
	$this_system->log(array(
		'title' => $P8LANG['_module_add_menu_admin_log'],
		'request' => $_POST,
	));
	//静态首页
	$form = '<form action="'.$this_system->admin_controller.'-index_to_html" method="post" id="'. $this_system->SITE .'" target="'. $this_system->SITE .'">'.
		'<input type="hidden" name="'.$this_system->SITE.'">'.
		'<input type="hidden" name="site" value="'.$this_system->SITE.'">'.
		'</form>'.
		'<iframe style="display: none;" name="'. $this_system->SITE .'"></iframe>'.
		'<script type="text/javascript">document.getElementById("'. $this_system->SITE .'").submit();</script>';
	message($P8LANG['done'].$form,$this_router.'-menu_list');
}
