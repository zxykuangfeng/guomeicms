<?php
defined('PHP168_PATH') or die();

/**
* 查看内容入口文件
**/

//$this_controller->check_action($ACTION) or message('no_privilege');
$id = 0;
$id = isset($_GET['id'])? intval($_GET['id']): 0;
foreach($URL_PARAMS as $k => $v){
	switch($v){
		case 'id':
			$id = isset($URL_PARAMS[$k +1]) ? intval($URL_PARAMS[$k +1]) : 0;
			$PAGE_CACHE_PARAM['id'] = $id;
			break 2;
		break;
	}
}
$id or message('no_such_item');
if(isset($id)){
	$data = $this_module->get_data($id);
	$data or message('no_such_item');

	$mid = $data['mid'];
	$this_module->set_model($mid) or message('no_such_model');
	if(!$this_model['enabled']){
		message($this_model['CONFIG']['disable_message'] ? $this_model['CONFIG']['disable_message'] : 'this_model_unable');		
	}
	if(!$data['status'] && !$this_controller->check_model_action('manage',$mid)){
		if(empty($this_model['CONFIG']['viewself']) && $data['uid'] == $UID || $data['uid'] != $UID){
			message('no_model_privilege');
		}
	}
	if(!defined('P8_GENERATE_HTML')){
		if(!$this_controller->check_model_action($ACTION,$mid) && $data['uid'] != $UID){
			message('no_model_privilege');
		}
		//display 0 show, 1 hide
		
		if(!$this_controller->check_model_action('manage',$mid) && $data['display'] && $data['uid'] != $UID){		
			message('no_model_privilege');
		}
		// 允许IP地址,超管和自己不限制
		if(!$IS_ADMIN && $data['uid'] != $UID && $this_model['CONFIG']['allow_ip']['enabled']){
			$this_controller->allow_ip($this_model['CONFIG']);
		}
		$manage = $this_controller->check_model_action('manage',$mid);
	}else{
		$manage = false;
	}
}

if(REQUEST_METHOD == 'GET' || defined('P8_GENERATE_HTML')){
	if(!empty($this_model['CONFIG']['viewhash'])){
		$viewcode = $_GET['viewcode'];
		if(!$viewcode)message('no_privilege');
		$encode = p8_code($viewcode,false);
		list($_id,$datetime) = explode('_',$encode);
		if($_id!=$id || P8_TIME-$datetime>3600 || P8_TIME-$datetime<0)message('no_privilege');
	}
	//检查是否需要密码访问,如果是超级管理员,则忽略	
	if(!$IS_ADMIN && !empty($this_model['CONFIG']['need_password']) && $this_model['CONFIG']['model_password']){
		$password = isset($_GET['password']) ? trim($_GET['password']) : '';
		if($password != $this_model['CONFIG']['model_password']){
			$errmessage = $password ? '访问密码不正确，请重新输入！' : '';
			include template($this_module, 'password');
			return;
		}
	}
	
	$SEO_KEYWORDS = $SEO_DESCRIPTION = '';
	$TITLE = $this_model['alias'];	
	
	$data = $this_module->get_data($id,$this_model['name']);
	$data or message('no_such_item');
	$this_module->format_data($data);
	$this_module->format_view($data);
	$data['config'] = mb_unserialize($data['config']);
	
	if(!empty($data['config']['manager'])){
		$uids = implode(",",$data['config']['manager']);
		$managers = $core->DB_master->fetch_all("SELECT id,username,name,email FROM {$core->TABLE_}member WHERE id IN ($uids)");
	}
	$status = $this_module->CONFIG['status'];
	
	//模型自定义脚本
	include $this_model['path'] .'view.php';
	
	$template = empty($this_model['view_template'])? 'view' : 'tpl/'.$this_model['view_template'];
	if($core->ismobile){
		$template = empty($this_model['view_template_mobile']) ? 'view' : 'tpl/'.$this_model['view_template_mobile'];
	}
	if($UID){
		$core->get_cache('role_group');
		$member = $core->load_module('member');
		$member->set_model($ROLE_GROUP);
		$member_info = $member->get_member_info($UID);
	}else{
		$member_info = array();
	}
	$status_json = p8_json($status);
	$data['p8_status'] = isset($data['p8_status']) && $data['p8_status'] ? $data['p8_status'] : '等待处理';
	//针对显示select
	foreach($this_model['fields'] as $p8_field => $p8_v){
		if(in_array($p8_v['widget'],array('select','checkbox','multi_select','radio'))){
			foreach($p8_v['data'] as $p8_value => $p8_key){
				if(is_array($p8_key)) $this_model['fields'][$p8_field]['data'][$p8_value] = $p8_key[0];
			}
		}
	}
	include template($this_module, $template);

}else if(REQUEST_METHOD == 'POST' && !defined('P8_GENERATE_HTML')){
	
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$id or message('no_such_item');
	if(!$this_controller->check_action('verify')){
		unset($_POST['verify']);
	}
	
	
	$status = $this_controller->update($id, $_POST) or message('fail');
	
	if($_POST['verify']){
		message('verifing');
	}else{
		message('done');
	}
	
}
