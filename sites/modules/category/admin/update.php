<?php
defined('PHP168_PATH') or die();

/**
* 修改分类
**/

$this_system->check_manager($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	$id or message('no_such_message');
	$data['type']=isset($_GET['type']) ? $_GET['type'] : 1;
	$select = select();
	$select->from($this_module->table, '*');
	$select->in('id', $id);
	$data = $core->select($select, array('single' => true, 'ms' => 'master'));
	$config = mb_unserialize($data['config']);
    $config['need_login'] = isset($config['need_login']) ? ($config['need_login'] == 1 ? 1 : 0) : 0;
	$config['allow_ip']['enabled'] = isset($config['allow_ip']['enabled']) ?$config['allow_ip']['enabled'] : 0;
	$config['allow_ip']['collectip'] = isset($config['allow_ip']['collectip']) ? $config['allow_ip']['collectip'] : array();
	$config['allow_ip']['beginip'] = isset($config['allow_ip']['beginip']) ? trim($config['allow_ip']['beginip']) : '';
	$config['allow_ip']['endip'] = isset($config['allow_ip']['endip']) ? trim($config['allow_ip']['endip']) : '';
	$config['allow_ip']['ruleoutip'] = isset($config['allow_ip']['ruleoutip']) ? $config['allow_ip']['ruleoutip'] : array();
    if($core->modules['auditflow']['enabled'] && !empty($core->CONFIG['audit_flow_enable_'.$this_system->SITE])){
        $auditFlow = $core->load_module('auditflow');
        $auditFlowSteps = $auditFlow->getSteps('sites');
    }
	$core->get_cache('role');
	//$config['administrator'] = implode(',', array_keys($config['administrator']));
	
	$data or message('no_such_sites_category');
	
	$data['frame'] && $data['frame'] = attachment_url($data['frame']);
	
	$MODEL = '';
	$models = $this_system->get_models();
	$model = $this_system->get_model($data['model']);
	
	$order_fields = array(
		'timestamp' => $P8LANG['sites_category_order_by_default'],
		'list_order' => $P8LANG['sites_category_order_by_listorder'],
		'comments' => $P8LANG['sites_category_order_by_comments'],
		'level' => $P8LANG['sites_category_order_by_level'],
	);
	
	if(!empty($model['filterable_fields'])){
		foreach($model['filterable_fields'] as $name => $v){
			$order_fields[$name] = $v['alias'];
		}
	}
	//浏览权限
	$item_config = $core->get_config($this_system->name, 'item');
	$authority = $authority_viewer = array();
	if($item_config['authority']) {
		$core->get_cache('role');
		//用户组
		$authority = isset($config['authority']) ? $config['authority'] : array();
		//用户
		if(!empty($config['authority_viewer'])){
			$authority_viewers = implode(',',$config['authority_viewer']);
			$member = &$core->load_module('member');
			$authority_viewer = $core->DB_master->fetch_all("SELECT id,username FROM {$member->table} WHERE id IN ($authority_viewers)");
		}
	}
	$cms_system = $core->load_system('cms');
	load_language($core, 'config');
	//站点信息
	$site = !empty($_GET['site']) ? $_GET['site'] : $_GET['alias'];	
	$site = in_array(clear_special_char($site),array_keys($this_system->sites)) ? clear_special_char($site) : $this_system->SITE;	
	$site_info = $this_system->get_site($site);	
	$managers = array();
	if(!empty($config['manager'])){
		$uids = implode(",",$config['manager']);			
		$managers = $core->DB_master->fetch_all("SELECT id,username,name,email FROM {$core->TABLE_}member WHERE id IN ($uids)");
	}
	include template($this_module, 'edit', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){

	//提交到iframe的
	
	$_POST = p8_stripslashes2($_POST);
	
	
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	
	$this_controller->update($id, $_POST);
    $this_system->log(array(
		'title' => $P8LANG['_module_update_admin_log'],
		'request' => $_POST,
	));
	//print_r($_POST);exit;
	if(P8_AJAX_REQUEST){
		//关闭窗口
		exit('<script type="text/javascript">alert("'. $P8LANG['done'] .'");document.domain = \''. $core->CONFIG['base_domain'] .'\';parent.edit_dialog.close();</script>');
	}else{
		message('done');
	}
}
