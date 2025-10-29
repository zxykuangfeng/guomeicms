<?php
defined('PHP168_PATH') or die();

/**
* 添加模型内容入口文件
**/

if($mid){
	if(!$this_controller->check_model_action('post', $mid)){
		$data['error'] = $P8LANG['no_model_privilege'];
		exit(jsonencode($data));
	}
	if(!$this_module->set_model($mid)){
		$data['error'] = $P8LANG['no_such_model'];
		exit(jsonencode($data));
	}
	if(!$this_model['enabled']){
		$data['error'] = $P8LANG['this_model_unable'];
		exit(jsonencode($data));
	}
}else{
	$data['error'] = $P8LANG['no_such_model'];
	exit(jsonencode($data));
}

if(REQUEST_METHOD == 'GET'){	
	//模型自定义脚本
	include $this_model['path'] .'post.php';	
	exit(jsonencode($this_model));

}else if(REQUEST_METHOD == 'POST'){
	
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	unset($_POST['module']);
	if($this_model['CONFIG']['mobile_post_captcha']){
		$status = $core->load_module('sms')->check_sms($_POST['checkcode'],$_POST['phone']);
		if(empty($status)){			
			$data['error'] = '手机验证码错误或失效！';
			exit(jsonencode($data));			
		}
	}
	$step = isset($_POST['p8_form_step']) && $_POST['p8_form_step'] ? intval($_POST['p8_form_step']) : 0;
	$_POST['config']['step'][$step] = $step;
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$_POST['status'] = $this_controller->check_model_action('automatic_processing',$mid)? 9 : 0;
	$_POST['from_api'] = 1;
	if($this_model['CONFIG']['captcha'] && !captcha($_POST['captcha'])){
		$data['error'] = $P8LANG['captcha_incorrect'];
		exit(jsonencode($data));
	}
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
			exit($status ? p8_json(array('id'=>$id,'step'=>$step)) : p8_json(array('error'=>'fail')));
		}else{
			$id = $this_controller->add($_POST,$step);
			exit($id ? p8_json(array('id'=>$id,'step'=>$step)) : p8_json(array('error'=>'fail')));
		}
	}
	//3反跨站请求伪造（CSRF）
	if($csrf_enable && empty(authcode_token($_POST['token']))){
		$data['error'] = $P8LANG['token_error'];
		exit(jsonencode($data));
	}
	$id = $this_controller->add($_POST);
	/*检测是否唯一和是否开启防护*/
	if($id){
		if(is_array($id)){
			if($id['expire']){
				$data['error'] = p8lang($P8LANG['forms_model_expire_message'], $id['expire']);
				exit(jsonencode($data));
			}else{
				$mes = p8lang($P8LANG['forms_model_field_unique_message'], $id[1]);//系统提示
				if($id[0] && isset($this_model['fields'][$id[0]])){
					$mes = $this_model['fields'][$id[0]]['jsregmsg'] ? $this_model['fields'][$id[0]]['jsregmsg'] : $mes;//字段错误提示
					$mes = $this_model['fields'][$id[0]]['CONFIG']['jsregmsg'] ? $this_model['fields'][$id[0]]['CONFIG']['jsregmsg'] : '';//唯一性字段提示
				}				
				$data['error'] = $mes;
				exit(jsonencode($data));
			}
		}else{
			$data = array('ok');
			exit(jsonencode($data));
		}
	}else{
		$data['error'] = $P8LANG['false'];
		exit(jsonencode($data));
	}		
}