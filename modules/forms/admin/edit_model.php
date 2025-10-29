<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action('model') or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$action = isset($_GET['action'])? $_GET['action'] : 'add';
	$data = array();
	$managers = array();
	$actions = array(
		'post' => '发布',		
		'verify_first' => '初审',
        'verify' => '终审',		
		'update' => '修改',		
		'automatic_processing' => '自动处理',
		'manage' => '管理',		
	);
	if($action == 'update'){
		$id = isset($_GET['id'])? intval($_GET['id']) : '';
		!empty($id) or message('no_such_item');
		$select = select();
		$select->from($this_module->model_table, '*');
		$select->in('id', $id);
		
		$data = $core->select($select, array('single' => true, 'ms' => 'master'));
		//$data['config'] = mb_unserialize($data['config']);
		
		$config = $data['config'] = mb_unserialize($data['config']);
		$config['allow_ip']['enabled'] = isset($config['allow_ip']['enabled']) ? $config['allow_ip']['enabled'] : 0;
		$config['allow_ip']['collectip'] = isset($config['allow_ip']['collectip']) ? $config['allow_ip']['collectip'] : array();
		$config['allow_ip']['beginip'] = isset($config['allow_ip']['beginip']) ? trim($config['allow_ip']['beginip']) : '';
		$config['allow_ip']['endip'] = isset($config['allow_ip']['endip']) ? trim($config['allow_ip']['endip']) : '';
		$config['allow_ip']['ruleoutip'] = isset($config['allow_ip']['ruleoutip']) ? $config['allow_ip']['ruleoutip'] : array();
        $config['allow_ip']['area_ip'] = isset($config['allow_ip']['area_ip']) ? $config['allow_ip']['area_ip'] : '';
		$config['deadline'] = isset($config['deadline']) && $config['deadline'] ? date('Y-m-d H:i:s',$config['deadline']) : '';
		
		$data['verified'] = $data['verified'] !=='' ? explode(",",$data['verified']) : array();
		//$config = &$data['config'];
		load_language($core, 'config');
		$core->get_cache('role');
		if(!empty($config['manager'])){
			$uids = implode(",",$config['manager']);			
			$managers = $core->DB_master->fetch_all("SELECT id,username,name,email FROM {$core->TABLE_}member WHERE id IN ($uids)");
		}
		$this_module->set_model($id);
	}
   if (!empty($core->modules['auditflow']) && !empty(intval($core->CONFIG['audit_flow_enable_forms_'.$data['name']]))) {
        $auditFlow = $core->load_module('auditflow');
        $auditFlowSteps = $auditFlow->getSteps('forms');
     //   $config['auditflow']=1;
    }
	$template_dir = !empty($this_module->CONFIG['template'])? $this_module->CONFIG['template'].'/core/' : 'default/core/';
	$template_dir .= $this_module->name.'/tpl/';
	
	$template_dir_mobile = !empty($this_module->CONFIG['mobile_template'])? $this_module->CONFIG['mobile_template'].'/core/' : 'mobile/default/core/';
	$template_dir_mobile .= $this_module->name.'/tpl/';
	include template($this_module, 'edit_model', 'admin');

}else if(REQUEST_METHOD == 'POST'){
	$action = isset($_POST['action'])? $_POST['action'] : 'add';
	
	if($action == 'add'){
		$this_controller->add_model($_POST);
		message('done',$this_router.'-model');
	}elseif($action == 'update'){
		$id = $_POST['id'];
		$this_controller->update_model($_POST);	
		message('done',$thi_url.'?action=update&id='.$id);
	}	
}
