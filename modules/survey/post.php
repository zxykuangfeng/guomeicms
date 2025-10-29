<?php
defined('PHP168_PATH') or die();

//$this_controller->check_action($ACTION) or message('no_privilege');
//1反跨站请求伪造（CSRF）
$csrf_enable = $core->CONFIG['csrf_enable'] ? true : false;
if(REQUEST_METHOD == 'GET'){
	$id = 0;
	foreach($URL_PARAMS as $k => $v){ 
		switch($v){
			case 'id':
				$id = isset($URL_PARAMS[$k +1]) ? intval($URL_PARAMS[$k +1]) : 0;
			break;
		}
	}
	$id = $id? intval($id): intval($_GET['id']);
	if(!$id)message('not_such_item');
	
	$data = $this_module->get_item($id);
	$this_module->update_view($id);
	//if(!empty($data['endtime']) && $data['endtime']<P8_TIME)message('had_end',$this_router.'-view-id-'.$id);
	if(!$UID && $data['login']){
		header('Location:'.$core->U_controller.'?forward='.$this_url.'-id-'.$id);
		exit;
	}
	$data['content'] = attachment_url( $data['content']);
	$manager = $this_controller->check_action('manage');
	$titles = $this_module->get_titles($id);
	foreach($titles as $keys => $title){
		foreach($title['data'] as $key=>$val){
			if(is_array($val)){
				$titles[$keys]['data'][$key] = $val[0];
			}
		}
	}
	$SEO_KEYWORDS = $SEO_DESCRIPTION = '';
	$TITLE = $data['title'];	
	
	$template = empty($data['post_template']) ?	'post' : $data['post_template'];
	//2csrf-token
	$token_key =  "p8_".$_P8SESSION['_hash'].time();
	$token = authcode_token($token_key,'ENCODE');
	include template($this_module, $template);
}else if(REQUEST_METHOD == 'POST'){
	
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);

	$iid = intval($_POST['iid']);
	if(!$iid)message($P8LANG['not_such_item']);
	
	
	
	$data = $this_module->get_item($iid);
	if($data['cookie'] && get_cookie('survey_post_'.$iid)){
		message($P8LANG['had_post'],$this_router.'-list');
	}
	if(!$UID && $data['login']){
		header('Location:'.$core->U_controller.'?forward='.$this_url.'-id-'.$id);
		exit;
	}
	if($data['captcha'] && !captcha($_POST['captcha'])){
		message($P8LANG['captcha_incorrect']);
	}
	//3反跨站请求伪造（CSRF）
	if($csrf_enable){
		$token = authcode_token($_POST['token']);
		$token or message('token_error');
	}
	$id = $this_controller->add_data($_POST) or message('fail');
	
	$ss = set_cookie('survey_post_'.$iid,time(),86400);
	if ($data['view_result'] || $UID) {  
		message('survey_success', $this_router . '-view-id-' . $iid);  
	} else {  
		message('survey_success');  
	}
	
}
