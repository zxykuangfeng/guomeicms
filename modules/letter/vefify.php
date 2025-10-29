<?php
defined('PHP168_PATH') or die();
$this_controller->check_action('vefify') or message('no_privilege');
GetGP(array('id','act'));
if(!$id) message('error');
$data = $this_module->getData($id,'all');

$this_controller->check_acl('vefify',$data['department']) or message('no_privilege');
$display = $this_controller->check_action('display');
$editletter = $this_controller->check_acl('edit',$data['department']);
//1反跨站请求伪造（CSRF）
$csrf_enable = $core->CONFIG['csrf_enable'] ? true : false;
if(REQUEST_METHOD=='GET'){
//print_r($data);
	!empty($data['attachment']) && $data['attachment']= attachment_url($data['attachment']);
	$cates = $this_module->get_category();
	$id_type = $this_module->id_type();
	$ptitle = $P8LANG['reply'];	
	
	$departments = $this_controller->getcatbyAct('turnover');
	
	//二级部门处理
	$select_size = 1;
	$select_data = array();
	$data_field = array();
	//构建一级
	foreach($departments as $key => $row){
		if($row['parent']) continue;
		$s = array();
		foreach($row['menus'] as $k=>$m){
			if($data['department'] == $m['id']) $data_field = array($m['parent'],$m['id']);
			$s[$m['id']] = array(
				'i' => $m['id'],
				'n' => $m['name'],
				's' => '',			
			);
		}
		if($data['department'] == $row['id']) $data_field = array($row['id']);
		$select_data[$row['id']] = array(
			'i' => $row['id'],
			'n' => $row['name'],
			's' => $s,
		);
		if(count($row['menus'])>=1) $select_size = 2;
	}
	$select_json_data = p8_json($select_data);
	//$data_field = empty($data['department'])? array() : explode('-',$data['department']);
	$selectdata = array();
	$inputname = 'department';
	
	//申请人信息
	$member_info = array();
	if($data['uid']){
		$member = &$core->load_module('member');
		$member->set_model($ROLE_GROUP);
		$member_info=$member->get_member_info($data['uid']);
	}
	$data['data'][0]['attachment'] = attachment_url($data['data'][0]['attachment']);
	$data['data'][0]['content'] = html_decode_entities($data['data'][0]['content']);
	$delletter = $this_controller->check_acl('delletter',$data['department']);
	$turnover = $this_controller->check_acl('turnover',$data['department']);
	$vefify = $this_controller->check_acl('vefify',$data['department']);
	$endtime = $this_controller->check_acl('endtime',$data['department']);
	$display = $this_controller->check_acl('display',$data['department']);
	$reply = $this_controller->check_acl('reply',$data['department']);

	$shortcutsms = $core->load_module('shortcutsms');
	$shortcuts = $shortcutsms->getAll();
	$mana_message = $this_controller->manageMessage();
	$TITLE = $TITLE = $data['title'] .'_'. $core->CONFIG['site_name'];	
	//2csrf-token
	$token_key =  "p8_".$_P8SESSION['_hash'].time();
	$token = authcode_token($token_key,'ENCODE');
	include template($this_module, "vefify");
}else if(REQUEST_METHOD=='POST'){

	if(!$display)unset($_POST['undisplay']);
	if(!$editletter)unset($_POST['reply']);
	//3反跨站请求伪造（CSRF）
	if($csrf_enable){
		$token = authcode_token($_POST['token']);
		$token or message('token_error');
	}
	$department = $_POST['department'] = isset($_POST['department'])? intval($_POST['department']): 0;
	$parent_department = $_POST['parent_department'] = isset($_POST['parent_department'])? intval($_POST['parent_department']): 0;
	if(empty($department) && !empty($parent_department)) $_POST['department'] = $parent_department;
	$this_controller->vefify($_POST);

	message(array(
				array('to_list', $this_router .'-list'),
				array('to_update', $this_url .'?id='.$_POST['id']),
				array('to_view', $this_router .'-view-id-'.$_POST['id']),
			),
			$this_router .'-view-id-'.$_POST['id'],
			10000
		);

}

?>
