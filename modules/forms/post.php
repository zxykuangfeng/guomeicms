<?php
defined('PHP168_PATH') or die();

/**
* 添加模型内容入口文件
**/
if(!defined('P8_GENERATE_HTML')) $this_controller->check_action($ACTION) or message('no_privilege');
//1反跨站请求伪造（CSRF）
$csrf_enable = $core->CONFIG['csrf_enable'] ? true : false;
$mid = isset($_REQUEST['mid'])? intval($_REQUEST['mid']) : '';
if($mid){
	
	if(!defined('P8_GENERATE_HTML')) $this_controller->check_model_action($ACTION, $mid) or message('no_model_privilege');
	
	$this_module->set_model($mid) or message('no_such_model');
	if(!$this_model['enabled']){
		message($this_model['CONFIG']['disable_message'] ? $this_model['CONFIG']['disable_message'] : 'this_model_unable');		
	}
	//时间限制
	if($this_model['CONFIG']['deadline'] && $this_model['CONFIG']['deadline'] < P8_TIME){
		message('forms_model_deadline_privilege');
	}
	//数量限制
	if($this_model['CONFIG']['post_total'] && intval($this_model['CONFIG']['post_total']) <= intval($this_module->get_model_count($mid))){
		message('forms_model_post_total_privilege');
	}
	if($this_model['CONFIG']['needlogin'] && !$UID){
		header('Location:'.$core->U_controller.'?forward='.$this_url.'?mid='.$mid);
		exit;
	}
}else{
	$my_addible_forms = $this_controller->get_acl('my_forms_post');
	$models = $this_module->core->CACHE->read('core/modules', 'forms', 'models');
	foreach($models as $key=>$mv){
		if($mv['id'] == 199 || empty($mv['enabled'])) unset($models[$key]);
	}
	if(!isset($my_addible_forms[0]) && !$IS_FOUNDER){
		foreach($models as $mname => $mdata){
			if(!array_key_exists($mdata['id'],$my_addible_forms))
			unset($models[$mname]);
		}
	}
	$SEO_KEYWORDS = $SEO_DESCRIPTION = '';
	$TITLE = 'chose';	
	include template($this_module, 'selectforms');	
	exit;
}
/*字段权限控制*/
foreach($this_model['fields'] as $field => $field_data){
	if(isset($field_data['CONFIG']['visible_role']) && $field_data['CONFIG']['visible_role'] && !in_array($ROLE,$field_data['CONFIG']['visible_role'])){
		unset($this_model['fields'][$field]);
	}
}
if(REQUEST_METHOD == 'GET' || defined('P8_GENERATE_HTML')){
	// 允许IP地址,超管不限制
	if(!$IS_ADMIN && $this_model['CONFIG']['allow_ip']['enabled'] && !defined('P8_GENERATE_HTML')) $this_controller->allow_ip($this_model['CONFIG']);
	$SEO_KEYWORDS = $SEO_DESCRIPTION = '';
	$TITLE = $this_model['alias'];	
	//$this_module->CONFIG['template']='media';	
	foreach($_REQUEST as $alias=>$value){
		if($alias == 'mid') continue;
		if(!isset($this_model['fields'][$alias])){
			unset($_REQUEST[$alias]);
			continue;
		}else{
			$_REQUEST[$alias] = p8_stripslashes2(xss_clear($value));
			$this_model['fields'][$alias]['default_value'] = p8_stripslashes2(trim(xss_clear($value)));
		}		
	}
	/*
	$today = strtotime(date('Y-m-d', P8_TIME));	
	$ret = $DB_slave->fetch_one("SELECT COUNT(*) as `count` from $this_module->table where `mid`='$mid' and `timestamp` >= $today");
	if($ret['count']<10){
		$numstring = '000'.$ret['count']+1;
	}else if($ret['count']<100){
		$numstring = '00'.$ret['count']+1;
	}else if($ret['count']<1000){
		$numstring = '0'.$ret['count']+1;
	}else{
		$numstring = $ret['count']+1;
	}
	//$data['bianhao'] = date('Y-m-d', P8_TIME).$numstring;
	*/
	//模型自定义脚本
	include $this_model['path'] .'post.php';
	
	$template = empty($this_model['post_template']) ?
		'edit' :
		'tpl/'.$this_model['post_template'];
	$attachment_hash = unique_id(16);
	$managers = array();
	if($core->ismobile){
		$template = empty($this_model['post_template_mobile']) ?
		'edit' :
		'tpl/'.$this_model['post_template_mobile'];
	}
	$_referer = defined('P8_GENERATE_HTML') ? $RESOURCE.'/modules/forms/html/'.$this_model['name'].'/post.html' : $this_url.'?mid='.$mid;
	//2csrf-token
	$token_key =  "p8_".$_P8SESSION['_hash'].time();
	$token = authcode_token($token_key,'ENCODE');
    
    // 初始化标签
    $LABEL_POSTFIX = array();
    array_push($LABEL_POSTFIX, 'postmid'.$mid);


        
	include template($this_module, $template);

}else if(REQUEST_METHOD == 'POST'){
	
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);	
	if($this_model['CONFIG']['mobile_post_captcha']){
		$status = $core->load_module('sms')->check_sms($_POST['checkcode'],$_POST['phone']);
		$status or message('手机验证码错误或失效！');
	}
	$step = isset($_POST['p8_form_step']) && $_POST['p8_form_step'] ? intval($_POST['p8_form_step']) : 0;
	$_POST['config']['step'][$step] = $step;
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$_POST['status'] = $this_controller->check_model_action('automatic_processing',$mid)? 9 : 0;
	$_POST['verified'] = $this_controller->check_model_action('verify', $mid) || $this_controller->check_model_action('automatic_processing', $mid) || $this_controller->check_model_action('manage', $mid) ? 1 : 0;	
	$_POST['verified'] = $IS_FOUNDER || $IS_ADMIN ? 1 : $_POST['verified'];
	if($this_model['CONFIG']['captcha'] && !captcha($_POST['captcha']))message('captcha_incorrect', HTTP_REFERER, 10);
	//模型自定义脚本
	include $this_model['path'] .'post.php';
	
	/*分步填报*/
	if($step){
		if($id){
			$data = $this_module->get_data($id);
			$config = mb_unserialize($data['config']);
			if($config){
				$config['step'][$step] = $step;
				$_POST['config'] = $config;			
			}else{
				$_POST['config']['step'][$step] = $step;
			}
			$status = $this_controller->update($id, $_POST,$step);
			exit($status ? p8_json(array('id'=>$id,'step'=>$step)) : p8_json(array('message'=>'fail')));
		}else{
			$id = $this_controller->add($_POST,$step);
			exit($id ? p8_json(array('id'=>$id,'step'=>$step)) : p8_json(array('message'=>'fail')));
		}
	}
	//3反跨站请求伪造（CSRF）
	if($csrf_enable){
		$token = authcode_token($_POST['token']);
		$token or message('token_error');
	}	
	$id = $this_controller->add($_POST);
	/*检测是否唯一和是否开启防护*/
	if($id){
		if(is_array($id)){
			if($id['expire']){
				message(p8lang($P8LANG['forms_model_expire_message'], $id['expire']));
			}else{
				$mes = p8lang($P8LANG['forms_model_field_unique_message'], $id[1]);//系统提示
				if($id[0] && isset($this_model['fields'][$id[0]])){
					$mes = $this_model['fields'][$id[0]]['jsregmsg'] ? $this_model['fields'][$id[0]]['jsregmsg'] : $mes;//字段错误提示
					$mes = $this_model['fields'][$id[0]]['CONFIG']['jsregmsg'] ? $this_model['fields'][$id[0]]['CONFIG']['jsregmsg'] : '';//唯一性字段提示
				}				
				message($mes);
			}
		}
	}else{
		message('fail');
	}
	if($_POST['status']<1){
		message('verifing', $HTTP_REFERER);
	}else{
		message(
			array(
				array('forms_to_edit', $this_module->controller .'-update?id='.$id.'&mid='.$mid),
				array('forms_to_list', $this_module->controller .'-list-mid-'.$mid),
				array('forms_to_view', $this_module->controller .'-view-id-'.$id),
				array('forms_to_add', $HTTP_REFERER)
			),
			$HTTP_REFERER,
			10000
		);
	}	
}
