<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$MODEL = '';
	$data['model'] = isset($_GET['model']) ? $_GET['model'] : '';
	$data['parent'] = isset($_GET['parent']) ? $_GET['parent'] : 0;
	$data['type']=isset($_GET['type']) ? $_GET['type'] : 2;
    $data['need_password'] =  $data['need_login'] = 0;
    $data['category_password'] = '';
	$item_config = $core->get_config($this_system->name,'item');
	$data['htmlize'] = isset($item_config['htmlize']) && $item_config['htmlize'] ? 1 : 0;
	$order_fields = array(
		'timestamp' => $P8LANG['cms_category_order_by_default'],
		'list_order' => $P8LANG['cms_category_order_by_listorder'],
		'views' => $P8LANG['cms_category_order_by_views'],
		'comments' => $P8LANG['cms_category_order_by_comments'],
		'level' => $P8LANG['cms_category_order_by_level'],
	);
	$config['orderby'] = 'level';
    if (!empty($core->modules['auditflow']) && $core->modules['auditflow']['enabled'] && !empty(intval($core->CONFIG['audit_flow_enable']))) {
        $auditFlow = $core->load_module('auditflow');
        $auditFlowSteps = $auditFlow->getSteps('cms');
        $config['auditflow']=1;
    }

	load_language($core, 'config');
	
	$models = $this_system->get_models(true);
	$core->get_cache('role');
	$managers = array();
	include template($this_module, 'edit', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){

	$names = isset($_POST['name']) ? array_filter(array_map('trim', explode("\r\n", $_POST['name']))) : array();
	$item_config = $core->get_config($this_system->name, 'item');
	
	//设置分类静态化
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
		$form .= '<form action="'.$core->admin_controller.'/cms/item-list_to_html" method="post" id="__html_vlist__" target="__html_vlist__"><input type="hidden" name="pages" value="0" />';
		foreach($ids as $kid=>$val){
			$form .= '<input type="hidden" name="cids[]" value="'.$kid.'" /></form>';
		}
		$form .= '<iframe style="display: none;" name="__html_vlist__"></iframe><script type="text/javascript">$("#__html_vlist__").submit();</script>';
	}
	if(P8_AJAX_REQUEST){
		exit('<script type="text/javascript">document.domain = \''. $core->CONFIG['base_domain'] .'\';parent.edit_dialog.close();parent.ajaxing({action: \'hide\'});</script>');
	}else{
		message($P8LANG['done'].$form, $this_url);
	}
}
