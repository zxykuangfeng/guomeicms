<?php
defined('PHP168_PATH') or die();

header('Pragma: no-cache');
header('Cache-Control: no-cache, must-revalidate');

if(($inte = &$core->integrate()) && !empty($inte->CONFIG['client'])){
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: '. $inte->CONFIG['api'] .'/'. $inte->CONFIG['register_url'] /*.'&forward='. urlencode(isset($_GET['forward']) ? $_GET['forward'] : $core->U_controller)*/);
	exit;
}

if(empty($this_module->CONFIG['register']['enabled'])) message('register_disabled');

load_language($this_module, 'register');

if(REQUEST_METHOD == 'GET'){
	
	if(!empty($this_module->CONFIG['register_question_enabled'])){
		//需要验证码,产生一条问题
		$question = $this_module->verify_question();
	}
	
	$gid = isset($_GET['gid']) ? intval($_GET['gid']) : 0;
	$rid = isset($_GET['rid']) ? intval($_GET['rid']) : 0;
	$core->get_cache('role_group');
	$groups = $core->role_groups;	
	
	if($gid != 0 && (empty($core->role_groups[$gid]['registrable']) || empty($core->role_groups[$gid]['default_role']))) message('access_denied');
	
	foreach($core->role_groups as $k => $v){
		if(!$v['registrable'] || !$v['default_role']) unset($core->role_groups[$k]);
	}
	
	if(!$gid && count($core->role_groups) == 1){
		header('Location: '. $this_url .'?&gid='. array_rand($core->role_groups));
		//header('Location: '. $this_url .'?&gid='. array_rand($core->role_groups) .'&'. xss_clear($_SERVER['QUERY_STRING']));
		exit;
	}
	
	$this_model = &$this_module->get_model($gid);

	$_SERVER['QUERY_STRING'] = xss_url($_SERVER['QUERY_STRING']);	
	$cell_phone_not_null = $this_module->CONFIG['register']['cell_phone_not_null'] ? true : false;
	$cell_phone_show = $this_module->CONFIG['register']['cell_phone_show'] ? true : false;
	$dept2_not_null = $this_module->CONFIG['register']['dept2_not_null'] ? true : false;
	$dept2_show = $this_module->CONFIG['register']['dept2_show'] ? true : false;
	$question_show = $this_module->CONFIG['question_enabled'] ? true : false;
	$questions = isset($this_module->CONFIG['questions']) ? $this_module->CONFIG['questions'] : array();
	krsort($questions);
	array_multisort(array_column($this_model['fields'],'display_order'),SORT_DESC,$this_model['fields']);
	$role_module = $core->load_module('role');
	$role_module->get_cache();
	$roles = array();
	if($gid) {
		$this_roles = $role_module->roles[$rid ? $rid : $core->role_groups[$gid]['default_role']] or message('access_denied');
		$roles = $role_module->get_by_group($gid, 'core');
		foreach($roles['system'] as $key=>$row){
			if($row['id'] == $core->CONFIG['guest_role']) unset($roles['system'][$key]);
		}
	}
	$_GET['forward'] = xss_url($_GET['forward']?$_GET['forward']:$this_roles['forward']);
	include template($this_module, 'register', 'default');
	
}else if(REQUEST_METHOD == 'POST'){
	$_POST = p8_stripslashes2($_POST);
	//需要注册问题
	if(!empty($this_module->CONFIG['register']['question_enabled'])){
		$q = $_POST['register_question'] ? $_POST['register_question'] : '';
		
		$this_module->verify_question($q) or message('verify_question_incorrect', HTTP_REFERER, 10);
	}
	
	if(!empty($this_module->CONFIG['register']['captcha']) && !captcha(isset($_POST['captcha']) ? $_POST['captcha'] : '')){
		message('captcha_incorrect', HTTP_REFERER, 10);
	}
	
	
	//同意条款, 在模板处, 提交__agreement已经被加密
	if(empty($_POST['__agreement'])) message('agreement_required');
	
	$password = isset($_POST['password']) ? $_POST['password'] : '';
	$confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
	
	if(!strlen($password)){
		message('password_required');
	}
	
	if($password !== $confirm_password){
		message('password_not_match');
	}
	
	$gid = isset($_POST['gid']) ? intval($_POST['gid']) : 0;
	$rid = isset($_POST['rid']) ? intval($_POST['rid']) : 0;
	$core->get_cache('role_group');
	
	//角色组不允许注册
	if(
		$gid == 0 ||
		$gid != 0 && (empty($core->role_groups[$gid]['registrable']) || empty($core->role_groups[$gid]['default_role']))
	) message('access_denied');
	
	$this_model = &$this_module->get_model($gid);
	
	$_POST['role_id'] = $rid ? $rid : $core->role_groups[$gid]['default_role'];
	$_POST['role_gid'] = $gid;
	unset($_POST['is_founder'], $_POST['is_admin']);
	
	//strlen($_POST['cell_phone']) == 11 or message('fail1');	
	//is_numeric($_POST['cell_phone']) or message('fail2');	
    //preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $_POST['cell_phone']) or message('fail3');
	
	$id = $this_controller->register($_POST);
	
	if($id>0){
		if($this_module->CONFIG['register']['verify']){//邮件验证
			$message = $this_module->CONFIG['register']['verify'] ==1? $P8LANG['email_verify_message'] : $P8LANG['man_verify_message'];
			include template($this_module, 'register_message', 'default');
		}else{
			$ret = $this_module->login(html_entities($_POST['username']), $password);
			$turn_url = empty($_POST['forward']) ? $this_module->U_controller : xss_url($_POST['forward']);
			if($this_module->CONFIG['login_forward'] == 2 && $this_module->CONFIG['login_turn_url']){
				$turn_url = $this_module->CONFIG['login_turn_url'];
			}
			message($P8LANG['register_success'], $turn_url,0);
		}
	}else{
		message('fail');
	}
	
	
}
