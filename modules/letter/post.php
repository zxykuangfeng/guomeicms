<?php
defined('PHP168_PATH') or die();

/**
* 添加模型内容入口文件
**/

$this_controller->check_action($ACTION) or message('no_privilege');
$captcha_enable = $this_module->CONFIG['captcha_enable'] ? true : false;
//1反跨站请求伪造（CSRF）
$csrf_enable = $core->CONFIG['csrf_enable'] ? true : false;
if(REQUEST_METHOD == 'GET' || defined('P8_GENERATE_HTML')){
	$mobile_confirm = $this_module->CONFIG['mobile_confirm'];	
	$SEO_KEYWORDS = $SEO_DESCRIPTION = '';
	$TITLE = '我要写信_'. $core->CONFIG['site_name'];
	$_GET = xss_clear($_GET);
	$department = $data['department'] = isset($_GET['department']) ? intval($_GET['department']): 0;
	$cates = $this_module->get_category();
	$type = '';
	foreach($URL_PARAMS as $k => $v){
		switch($v){		
			case 'type':
				$type = isset($URL_PARAMS[$k +1]) ? intval($URL_PARAMS[$k +1]) : '';
			break;		
		}
	}
	$data['visual'] = 1;
	$data['type'] = !empty($type) ? intval($type):'';
	if(!empty($this_module->CONFIG['redepartment'])){
		unset($cates['department'][$this_module->CONFIG['redepartment']]);
	}
	
	//二级部门处理
	$select_size = 1;
	$select_data = array();
	$cates_alias = array();
	//构建一级
	foreach($cates['department'] as $key => $row){
		$cates_alias[$row['id']] = $row;
		if($row['parent']) continue;
		$s = array();
		foreach($row['menus'] as $k=>$m){
			$cates_alias[$m['id']] = array('name'=>$row['name'].' . '.$m['name']);
			if($department == $m['id']) $data_field = array($m['parent'],$m['id']);
			$s[$m['id']] = array(
				'i' => $m['id'],
				'n' => $m['name'],
				's' => '',			
			);
		}
		if($department == $row['id']) $data_field = array($row['id']);
		$select_data[$row['id']] = array(
			'i' => $row['id'],
			'n' => $row['name'],
			's' => $s,
		);
		if(count($row['menus'])>=1) $select_size = 2;
	}
	$select_json_data = p8_json($select_data);
	//$data_field = empty($department) ? array() : explode('-',$data_field);
	$selectdata = array();
	$inputname = 'department';
	//二级部门
	
	$id_type = $this_module->id_type();
	$attachment_hash = unique_id(16);
	
	$letterconfig = $this_module->CONFIG;	
	$widget = isset($this_module->CONFIG['widget']) && $this_module->CONFIG['widget'] ? $this_module->CONFIG['widget'] : 'widget_textarea';	
	$tatistics = $this_module->getstatistics2();
	//2csrf-token
	$token_key =  "p8_".$_P8SESSION['_hash'].time();
	$token = authcode_token($token_key,'ENCODE');
	include template($this_module, 'edit');

}else if(REQUEST_METHOD == 'POST'){
	if(preg_match('/AND|OR|MD5|BENCHMARK|DUMP|DELETE/i',$_POST['title'])){
		header('HTTP/1.1 403 Access Deny');
		message('access deny');
	}
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);	
	if($this_module->CONFIG['mobile_confirm']){
		$status = $core->load_module('sms')->check_sms($_POST['checkcode'],$_POST['phone']);
		$status or message('手机验证码错误或失效！');
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
	unset($_POST['is_from_api']);
	if(!$captcha_enable) $_POST['is_from_api'] = true;
	//3反跨站请求伪造（CSRF）
	if($csrf_enable){
		$token = authcode_token($_POST['token']);
		$token or message('token_error');
	}
	
	$id = $_POST['id'];
	//防止重复提交
	$last_post = P8_TIME - 10;
	$last_post2 = P8_TIME - 60;
	$post_cid = $_POST['cid'];
	$title = $_POST['title'] = p8_addslashes($_POST['title']);
	$title = preg_replace('/AND|OR|MD5|BENCHMARK/i','',$title);
	$title or message('error_content');
	$p8_ip = P8_IP;
	$lastfile_list = $core->DB_master->fetch_one("select * from `$this_module->table` where (`create_time` >= '$last_post' or (`create_time` >= '$last_post2' and `title` = '$title')) and `uid` = $UID and `p8_ip` = '$p8_ip' order by `id` desc limit 0,1");
	if(!empty($lastfile_list)) message('post_rule');
	
	$status = $this_controller->add($_POST) or message('fail');
	unset($_POST);
	$message = p8lang($P8LANG['post_success'], $status['number'],$status['code']);
	$reurl = $this_url;
	include template($this_module, 'message');	
}
