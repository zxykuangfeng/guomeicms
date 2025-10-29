<?php
defined('PHP168_PATH') or die();

$this_system->check_manager($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$MODEL = '';
	$data['model'] = isset($_GET['model']) ? $_GET['model'] : '';
	$data['parent'] = isset($_GET['parent']) ? $_GET['parent'] : 0;
	$data['type'] = 0;
    $data['need_login'] = 0;
	$data['need_password'] =  $data['need_login'] = 0;
    $item_config = $core->get_config($this_system->name,'item');
	$data['htmlize'] = isset($item_config['htmlize']) && $item_config['htmlize'] ? 1 : 0;
	$data['category_password'] = '';
	$order_fields = array(
		'timestamp' => $P8LANG['sites_category_order_by_default'],
		'list_order' => $P8LANG['sites_category_order_by_listorder'],
		'comments' => $P8LANG['sites_category_order_by_comments'],
		'level' => $P8LANG['sites_category_order_by_level'],
	);
	$config['orderby'] = 'level';
	load_language($core, 'config');
    if($core->modules['auditflow']['enabled'] && !empty($core->CONFIG['audit_flow_enable_'.$this_system->SITE])){
        $auditFlow = $core->load_module('auditflow');
        $auditFlowSteps = $auditFlow->getSteps('sites');
        $config['auditflow']=1;
    }

	$models = $this_system->get_models();
	$core->get_cache('role');
	//$allsites = $this_system->get_sites();
	//$sitename_alias = !empty($allsites[$this_system->SITE]['sitename']) ? $allsites[$this_system->SITE]['sitename']  : '';
	//站点信息
	$site = $_GET['site'];
	$site = !empty($site) ? $site : $alias;	
	$site = clear_special_char($site);	
	$site = in_array($site,array_keys($this_system->sites)) ? $site : $this_system->SITE;	
	$site_info = $this_system->get_site($site);
	$managers = array();
	include template($this_module, 'edit', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	
	$this_system->check_suv();
	$names = isset($_POST['name']) ? array_filter(array_map('trim', explode("\r\n", $_POST['name']))) : array();
	$item_config = $core->get_config($this_system->name, 'item');

	//分类静态化
	$_POST['htmlize'] = isset($_POST['htmlize']) ? intval($_POST['htmlize']) : (empty($item_config['htmlize']) ? 0 : 1);
	if(!empty($names)){
		//批量添加
		$ids = array();
		ksort($names);
		foreach($names as $name){
			$_POST['name'] = $name;
			$id = $this_controller->add($_POST) or message('fail');
			$ids[$id] = 1;
		}
		
		$this_module->cache(false, true, $ids);
	}
	$form = '';
	//静态化列表
	if($_POST['htmlize'] == 1){
		$form .= '<form action="'.$core->admin_controller.'/sites/item-list_to_html" method="post" id="__html_vlist__" target="__html_vlist__">'.
			'<input type="hidden" name="pages" value="0" />'.			
			'<input type="hidden" name="site" value="'.$this_system->SITE.'">';
		foreach($ids as $kid=>$val){
			$form .= '<input type="hidden" name="cid[]" value="'.$kid.'" /></form>';
		}
		$form .= '<iframe style="display: none;" name="__html_vlist__"></iframe><script type="text/javascript">$("#__html_vlist__").submit();</script>';
	}
    $this_system->log(array(
		'title' => $P8LANG['_module_add_admin_log'],
		'request' => $_POST,
	));

	if(P8_AJAX_REQUEST){
		exit('<script type="text/javascript">document.domain = \''. $core->CONFIG['base_domain'] .'\';parent.edit_dialog.close();parent.ajaxing({action: \'hide\'});</script>');
	}else{
		message($P8LANG['done'].$form, $this_router.'-list');
	}
}
