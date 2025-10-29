<?php
defined('PHP168_PATH') or die();

/**
* 修改内容入口文件
**/

//$this_controller->check_action($ACTION) or message('no_privilege');
$id = isset($_REQUEST['id'])? intval($_REQUEST['id']) : '';
$id or message('no_such_item');
//1反跨站请求伪造（CSRF）
$csrf_enable = $core->CONFIG['csrf_enable'] ? true : false;
if(isset($id)){
	$data = $this_module->get_data($id);
	$data or message('no_such_item');
	$mid = $data['mid'];
	if(!$this_controller->check_model_action('manage',$mid)){
		if($data['uid'] != $UID ){
			message('no_model_privilege');
		}elseif($data['uid'] == $UID && $data['status']>0){
			//message($P8LANG['forms_is_status']);
		}
		
	}	
	$this_module->set_model($mid) or message('no_such_model');
	if(!$this_model['enabled']){
		message($this_model['CONFIG']['disable_message'] ? $this_model['CONFIG']['disable_message'] : 'this_model_unable');		
	}
}

if(REQUEST_METHOD == 'GET'){
	$SEO_KEYWORDS = $SEO_DESCRIPTION = '';
	$TITLE = $this_model['alias'];	
	
	$data = $this_module->get_data($id,$this_model['name']);
	$data or message('no_such_item');	
	$this_module->format_data($data);
	$data['config'] = mb_unserialize($data['config']);
	// 允许IP地址,超管和自己不限制
	if(!$IS_ADMIN && $data['uid'] != $UID && $this_model['CONFIG']['allow_ip']['enabled'])
		$this_controller->allow_ip($this_model['CONFIG']);
	if(!empty($data['config']['manager'])){
		$uids = implode(",",$data['config']['manager']);
		$managers = $core->DB_master->fetch_all("SELECT id,username,name,email FROM {$core->TABLE_}member WHERE id IN ($uids)");
	}
	//不允许编辑时修改内容
	foreach($this_model['fields'] as $field=>$field_data){
		$this_model['fields'][$field]['editable'] = isset($field_data['CONFIG']['noupdateable']) && $field_data['CONFIG']['noupdateable'] ? 0 : $field_data['editable'];
		/*超管要能修改不可修改的字段内容*/
		if($IS_FOUNDER) $this_model['fields'][$field]['editable'] = 1;
		/*字段权限控制*/
		if(isset($field_data['CONFIG']['visible_role']) && $field_data['CONFIG']['visible_role'] && !in_array($ROLE,$field_data['CONFIG']['visible_role'])){
			unset($this_model['fields'][$field]);
		}
		//针对显示select
		if($field_data['widget'] == 'select'){
			foreach($field_data['data'] as $p8_value => $p8_key){
				if(is_array($p8_key)) $this_model['fields'][$field]['data'][$p8_value] = $p8_key[0];
			}
		}
	}
	$attachment_hash = unique_id(16);
	//模型自定义脚本
	include $this_model['path'] .'update.php';
	$template = empty($this_model['post_template']) ?
		'edit' :
		'tpl/'.$this_model['post_template'];
	//2csrf-token
	$token_key =  "p8_".$_P8SESSION['_hash'].time();
	$token = authcode_token($token_key,'ENCODE');
	$data['p8_status'] = isset($data['p8_status']) && $data['p8_status'] ? $data['p8_status'] : '等待处理';
	include template($this_module, $template);

}else if(REQUEST_METHOD == 'POST'){
	
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$step = isset($_POST['p8_form_step']) && $_POST['p8_form_step'] ? intval($_POST['p8_form_step']) : 0;
	$_POST['config']['step'][$step] = $step;
	if(empty($id)){
		if($step)
			exit(p8_json(array('message'=>'no_such_item')));
		else
			message('no_such_item');
	}
	//修改也要重新处理
	$_POST['status'] = $this_controller->check_model_action('automatic_processing',$mid)? 9 : 0;
	foreach($this_model['fields'] as $field=>$field_data){
		/*字段权限控制*/
		if(isset($field_data['CONFIG']['visible_role']) && $field_data['CONFIG']['visible_role'] && !in_array($ROLE,$field_data['CONFIG']['visible_role'])){
			unset($this_model['fields'][$field]);
		}
	}
	if($this_model['CONFIG']['captcha'] && !captcha($_POST['captcha']))message('captcha_incorrect', HTTP_REFERER, 10);
	//模型自定义脚本
	include $this_model['path'] .'update.php';
	/*分步填报*/
	if($step){
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
	}
	//3反跨站请求伪造（CSRF）
	if($csrf_enable){
		$token = authcode_token($_POST['token']);
		$token or message('token_error');
	}
	$status = $this_controller->update($id, $_POST) or message('fail');
	/*检测是否唯一*/
	if(is_array($status)){
		$mes = p8lang($P8LANG['forms_model_field_unique_message'], $status[1]);//系统提示
		if($status[0] && isset($this_model['fields'][$status[0]])){
			$mes = $this_model['fields'][$status[0]]['jsregmsg'] ? $this_model['fields'][$status[0]]['jsregmsg'] : $mes;//字段错误提示
			$mes = $this_model['fields'][$status[0]]['CONFIG']['jsregmsg'] ? $this_model['fields'][$status[0]]['CONFIG']['jsregmsg'] : '';//唯一性字段提示
		}				
		message($mes);
	}
	if($_POST['status']<1){
		message('verifing');
	}else{
		message(
			array(
				array('forms_to_edit', $this_module->controller .'-update?id='.$id.'&mid='.$mid),
				array('forms_to_list', $this_module->controller .'-list-mid-'.$mid),
				array('forms_to_view', $this_module->controller .'-view-id-'.$id)
			),
			$this_module->controller .'-list-mid-'.$mid,
			10000
		);
	}
	
}
