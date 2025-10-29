<?php
defined('PHP168_PATH') or die();

/**
* 添加模型内容入口文件
**/

if(REQUEST_METHOD == 'GET'){
	$request = xss_clear($request);
	$data['cates'] = $this_module->get_category();
	$data['type'] = isset($request['type'])? intval($request['type']):'';
	$data['visual'] = 1;
	$data['id_type'] = $this_module->id_type();	
	$data['config'] = $core->get_config('core', 'letter');
	$data['tatistics'] = $this_module->getstatistics2();
	exit(jsonencode($data));
}else if(REQUEST_METHOD == 'POST'){
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);	
	$captcha_enable = $this_module->CONFIG['captcha_enable'] ? true : false;
	//1反跨站请求伪造（CSRF）
	$csrf_enable = $core->CONFIG['csrf_enable'] ? true : false;
	if($this_module->CONFIG['mobile_confirm']){
		$status = $core->load_module('sms')->check_sms($_POST['checkcode'],$_POST['phone']);
		if(empty($status)){			
			$data['error'] = '手机验证码错误或失效！';
			exit(jsonencode($data));			
		}
	}
	if($this_module->CONFIG['allow_custom']){
		if($this_module->CONFIG['custom_a_enabled'] && $this_module->CONFIG['custom_a_not_null'] && empty($_POST['custom_a'])) message(p8lang($P8LANG['custom_not_null'], array($this_module->CONFIG['custom_a'])));
		if($this_module->CONFIG['custom_b_enabled'] && $this_module->CONFIG['custom_b_not_null'] && empty($_POST['custom_b'])) message(p8lang($P8LANG['custom_not_null'], array($this_module->CONFIG['custom_b'])));
		if($this_module->CONFIG['custom_c_enabled'] && $this_module->CONFIG['custom_c_not_null'] && empty($_POST['custom_c'])) message(p8lang($P8LANG['custom_not_null'], array($this_module->CONFIG['custom_c'])));
		if($this_module->CONFIG['custom_d_enabled'] && $this_module->CONFIG['custom_d_not_null'] && empty($_POST['custom_d'])) message(p8lang($P8LANG['custom_not_null'], array($this_module->CONFIG['custom_d'])));
		if($this_module->CONFIG['custom_e_enabled'] && $this_module->CONFIG['custom_e_not_null'] && empty($_POST['custom_e'])) message(p8lang($P8LANG['custom_not_null'], array($this_module->CONFIG['custom_e'])));
		if($this_module->CONFIG['custom_f_enabled'] && $this_module->CONFIG['custom_f_not_null'] && empty($_POST['custom_f'])) message(p8lang($P8LANG['custom_not_null'], array($this_module->CONFIG['custom_f'])));
	}
	if($captcha_enable && isset($_POST['checkcaptcha'])){
		$st = !captcha(isset($_POST['captcha']) ? $_POST['captcha'] : '',true)?'false':'true';
		exit($st);
	}
	//3反跨站请求伪造（CSRF）
	if($csrf_enable && empty(authcode_token($_POST['token']))){
		$data['error'] = $P8LANG['token_error'];
		exit(jsonencode($data));
	}	
	$id = $_POST['id'];
	$department = $_POST['department'] = isset($_POST['department'])? intval($_POST['department']): 0;
	$parent_department = $_POST['parent_department'] = isset($_POST['parent_department'])? intval($_POST['parent_department']): 0;
	if(empty($department) && !empty($parent_department)) $_POST['department'] = $parent_department;
	//防止重复提交
	$last_post = P8_TIME - 10;
	$last_post2 = P8_TIME - 60;
	$title = $_POST['title'];
	$p8_ip = P8_IP;
	$lastfile_list = $core->DB_master->fetch_one("select * from `$this_module->table` where (`create_time` >= '$last_post' or (`create_time` >= '$last_post2' and `title` = '$title')) and `uid` = $UID and `p8_ip` = '$p8_ip' order by `id` desc limit 0,1");
	if(!empty($lastfile_list)) {
		$data['error'] = $P8LANG['post_rule'];
		exit(jsonencode($data));		
	}
	
	$_POST['is_from_api'] = 1;
	$status = $this_controller->add($_POST);
	if(isset($status['id'])){
		$data = array('ok');
		exit(jsonencode($data));
	}else{
		$data['error'] = $P8LANG['false'];
		exit(jsonencode($data));
	}
}
