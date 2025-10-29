<?php
defined('PHP168_PATH') or die();

class P8_Forms_Controller extends P8_Controller{

var $category_acl;
function __construct(&$obj){
	//$this->no_base_acl = true;
	parent::__construct($obj);
}


function _init(){
	//获取基于分类的权限控制表
	$this->category_acl = $this->get_acl('category_acl');
}

/**
* 提交表单
**/
function add(&$POST,$step = 0){
	
	//检查权限,站群免检
	//$this_controller->check_category_action('post', $mid) or message('no_privilege');
	
	global  $UID, $USERNAME;
	
	//日志
	$POST['config']['logs'] = $this->field_logs('add');
	//验证数据
	$data = $this->valid_data($POST,$step);

	if($data === null) return false;
	
	$data['main']['timestamp'] = P8_TIME;
	$data['main']['uid'] = $UID;
	$data['main']['username'] = $USERNAME;
	$data['main']['mid'] = $this->model->model['id'];
	$data['main']['ip'] = P8_IP;
	return $this->model->add($data);
}

function update($id, &$POST,$step = 0){
	//验证数据
	$POST['config']['logs'] = $this->field_logs('update',$POST,$id);
	
	$data = $this->valid_data($POST,$step);
	
	if($data === null) return false;
	$data['main']['update_time'] = P8_TIME;
	return  $this->model->update($id, $data);
}

function delete_model($post){
	$mid = intval($post['id']);
	if(!$this->model->get_model($mid,true))return false;
	return  $this->model->delete_model($mid);
}
/*
字段操作日志
*/
function field_logs($action,&$POST = array(),$id = 0){
	global $UID, $USERNAME,$P8LANG;
	$logs = array();
	$logs[0] = array(
		'uid' => $UID,
		'username' => $USERNAME,
		'ip' => P8_IP,
		'timestamp' => P8_TIME,
		'action' => $action,
		'detail' => $P8LANG[$action] ? $P8LANG[$action] : $action,
	);
	if($id && isset($POST['field#']) && is_array($POST['field#'])){
		$data = $this->model->get_data($id,$this->model->MODEL);
		$config = mb_unserialize($data['config']);
		$logs = isset($config['logs']) && $config['logs'] ? $config['logs'] : array();
		$post = $POST['field#'];
		$detail = array();
		foreach($this->model->model['fields'] as $field => $v){
			if(isset($v['CONFIG']['logs']) && $v['CONFIG']['logs'] && $post[$field] != $data[$field]){
				switch($v['widget']){		
					//文本框,多行文本框,单选,单选下拉框,单个上传框
					case 'text': case 'textarea': case 'editor': case 'editor_basic': case 'editor_basic': case 'photo_uploader': case 'uploader_basic':
						$detail[$field] = $v['alias'].'('.$field.') 从 '.$data[$field].' 变更为：'.$post[$field];
					break;
					case 'checkbox': case 'multi_select':
						$star = $end = null;
						foreach($v['data'] as $value => $key){
							if(in_array($value, $data[$field])){
								$star .= (is_array($key) ? $key[0] : $key).'&nbsp;';								
							}
							if(in_array($value, $post[$field])){
								$end .= (is_array($key) ? $key[0] : $key).'&nbsp;';						
							}
						}
						$detail[$field] = $v['alias'].'('.$field.') 从 '.$star.' 变更为：'.$end;
					break;					
					case 'select': case 'radio'://字段输入方式为：单选
						$star = $end = null;
						foreach($v['data'] as $value => $key){
							if($value == $data[$field]){
								$star = is_array($key) ? $key[0] : $key;								
							}
							if($value == $post[$field]){
								$end = is_array($key) ? $key[0] : $key;								
							}
						}
						$detail[$field] = $v['alias'].'('.$field.') 从 '.$star.' 变更为：'.$end;
					break;											
					case 'uploader'://字段输入方式为：上传器
						$detail[$field] = 	$v['alias'].'('.$field.') 从 '.$data[$field]['url'].' 变更为：'.$post[$field]['url']."<br>";
						$detail[$field] .= 	'从 '.$data[$field]['title'].' 变更为：'.$post[$field]['title'];
					break;
					case 'image_uploader'://字段输入方式为：图片上传器			
						$detail[$field] = $v['alias'].'('.$field.') 从 '.$data[$field]['url'].' 变更为：'.$post[$field]['url']."<br>";
						$detail[$field] .= '从 '.$data[$field]['thumb'].' 变更为：'.$post[$field]['thumb'];						
					break;
					
					case 'multi_uploader_basic'://字段输入方式为：多上传器
						$star = $star2 = $end = $end2 = null;
						foreach($data[$field] as $vv){
							if(preg_match("/[.+](jpg|jpeg|gif|png|bmp)$/i",$vv['url'])){							
									$star .= $vv['url'];									
							}else{							
								$star .= $vv['url'];
								$star2 .= $vv['title'];
							}
							
						}
						foreach($post[$field] as $vv){
							if(preg_match("/[.+](jpg|jpeg|gif|png|bmp)$/i",$vv['url'])){							
									$end .= $vv['url'];									
							}else{							
								$end .= $vv['url'];
								$end2 .= $vv['title'];
							}							
						}
						$detail[$field] = $v['alias'].'('.$field.') 从 '.$star.' 变更为：'.$end."<br>";
						$detail[$field] .= '从 '.$star2.' 变更为：'.$end2;
					break;
					
					case 'multi_uploader'://字段输入方式为：多上传器
						$star = $star2 = $end = $end2 = null;
						foreach($data[$field] as $vv){
							if(preg_match("/[.+](jpg|jpeg|gif|png|bmp)$/i",$vv['url'])){							
									$star .= $vv['url'];
									$star2 .= $vv['thumb'];
							}else{							
								$star .= $vv['url'];
								$star2 .= $vv['title'];
							}
							
						}
						foreach($post[$field] as $vv){
							if(preg_match("/[.+](jpg|jpeg|gif|png|bmp)$/i",$vv['url'])){							
									$end .= $vv['url'];
									$end2 .= $vv['thumb'];
							}else{							
								$end .= $vv['url'];
								$end2 .= $vv['title'];
							}							
						}
						$detail[$field] = $v['alias'].'('.$field.') 从 '.$star.' 变更为：'.$end."<br>";
						$detail[$field] .= '从 '.$star2.' 变更为：'.$end2;
					break;
					case 'linkage'://多级联动			
						$star = $end = null;
						$split='';
						foreach($data[$field] as $k=>$vl){
							$star = $split.$vl;				
							$split='&nbsp;&gt;&nbsp;';
						}
						$split='';
						foreach($post[$field] as $k=>$vl){
							$end = $split.$vl;				
							$split='&nbsp;&gt;&nbsp;';
						}
						$detail[$field] = $v['alias'].'('.$field.') 从 '.$star.' 变更为：'.$end;
					break;
					default://其它输入方式			
						$detail[$field] = $v['alias'].'('.$field.') 从 '.$data[$field].' 变更为：'.$post[$field];
				}
			}
		}
		if($detail) $logs[] = array(
				'uid' => $UID,
				'username' => $USERNAME,
				'ip' => P8_IP,
				'timestamp' => P8_TIME,
				'action' => $action,
				'detail' => $detail,
			);
	}
	return $logs;
}
/**
* 验证数据
* field# 数组为自定义字段的值
**/
function valid_data(&$POST,$step = 0){
	global $IS_FOUNDER,$P8LANG;
	
	$data = array(
		'main' => array(),
		'item' => array()
	);
	$func = 'html_entities';	
	//关联附件哈希
	$data['attachment_hash'] = isset($POST['attachment_hash']) ? $POST['attachment_hash'] : '';
		
	//验证公共部分
	$data['main']['title'] = isset($POST['title']) ? filter_word($func($POST['title'])) : $this->model->model['alias'];
	$data['main']['title_color'] = isset($POST['title_color']) ? $func($POST['title_color']) : '';
	
	$data['main']['status'] = isset($POST['status'])? $POST['status'] : 0;
	//排序
	if($this->check_admin_action('list_order')){
		$data['main']['list_order'] = isset($POST['list_order']) && ($list_order = strtotime($POST['list_order'])) ? $list_order : P8_TIME;
	}else{
		$data['main']['list_order'] = P8_TIME;
	}
	//配置
	$data['main']['config'] = isset($POST['config']) ? serialize($POST['config']) : '';	
	$data['main']['verified'] = isset($POST['verified']) && intval($POST['verified']) ? 1 : 0;
	//自定义字段的过滤
	if(isset($POST['field#']) && is_array($POST['field#'])){
		$F = &$POST['field#'];
	}else{
		$F = array();
	}
	$step_field = array();
	if($step){
		$fieldset_step = 0;
		foreach($this->model->model['CONFIG']['parts'] as $pk=> $pd){
			$fieldset_step++;
			if($fieldset_step != $step) continue;
			for($i=1;$i<=$pd['row'];$i++){
				$tdid = "$pk-$i";
				foreach($this->model->model['parts'][$tdid] as $field){
					$step_field[] = $field;
				}
			}
		}
	}
	foreach($this->model->model['fields'] as $field => $v){
		if(isset($v['CONFIG']['visible_role']) && $v['CONFIG']['visible_role'] && !in_array($ROLE,$v['CONFIG']['visible_role'])){
			continue;
		}
		/*跳过不在分步提交的字段的检测*/
		if($step && $step_field && !in_array($field,$step_field)){
			continue;
		}
		//检测是否正确的提交字段
		$posted = true;//$v['editable']; //isset($POST['#field_'. $field .'_posted']) || defined('P8_CLUSTER');
		
		$null_flag = false;
		
		//存放在哪个表
		$table = 'item';
		
		switch($v['widget']){
		
		//文本框,多行文本框,单选,单选下拉框,单个上传框
		case 'text': case 'textarea': case 'radio': case 'select':
			
			if($v['not_null'] && !strlen($F[$field])) {
				if($step)
					exit(p8_json(array('field'=>$v['alias'].$P8LANG['forms_field_required'])));
				else
					message($v['alias'].' can not empty');
			}
			
			switch($v['type']){
			
			//整型
			case 'tinyint': case 'smallint': case 'mediumint': case 'int': case 'bigint':
				$data[$table][$field] = $posted && isset($F[$field]) ?
					(int)$F[$field] :
					$v['default_value'];
			break;
			
			//浮点
			case 'float': case 'double': case 'decimal':
				$data[$table][$field] = $posted && isset($F[$field]) ?
					(float)$F[$field] :
					$v['default_value'];
			break;
			
			//字符
			case 'char': case 'varchar':
				$data[$table][$field] = $posted && isset($F[$field]) ?
					filter_word($func($F[$field])) :
					$v['default_value'];
			break;
			
			//默认
			default: 
				$data[$table][$field] = $posted && isset($F[$field]) ?
					filter_word($func($F[$field])) :
					$v['default_value'];
			}
			
		break;
		
		//多选框,多选下拉框
		case 'checkbox': case 'multi_select':
			if($posted){
				if($v['not_null'] && empty($F[$field])) {
					if($step)
						exit(p8_json(array('field'=>$v['alias'].$P8LANG['forms_field_required'])));
					else
						message($v['alias'].' can not empty');
				}
				
				$data[$table][$field] = isset($F[$field]) ?
					implode($this->model->delimiter, $func((array)$F[$field])) :
					'';
			}else{
				$data[$table][$field] = implode($this->model->delimiter, $v['default_value']);
			}
		break;
		
		//上传器
		case 'uploader': case 'image_uploader':
			if($posted){
				if($v['not_null'] && empty($F[$field])) {
					if($step)
						exit(p8_json(array('field'=>$v['alias'].$P8LANG['forms_field_required'])));
					else
						message($v['alias'].' can not empty');
				}
				$title = isset($F[$field]['title']) ? filter_word($F[$field]['title']) : '';
				$url = isset($F[$field]['url']) ? $F[$field]['url'] : '';
				$thumb = isset($F[$field]['thumb']) ? $F[$field]['thumb'] : '';
				
				$data[$table][$field] = attachment_url($title . $this->model->delimiter . $url . $this->model->delimiter . $thumb, true);
			}else{
				$data[$table][$field] = $v['default_value'];
			}
		break;
		
		//上传器
		case 'uploader_basic':
			if($posted){
				if($v['not_null'] && empty($F[$field])) {
					if($step)
						exit(p8_json(array('field'=>$v['alias'].$P8LANG['forms_field_required'])));
					else
						message($v['alias'].' can not empty');
				}
				$url = isset($F[$field]) ? $F[$field] : '';				
				$data[$table][$field] = attachment_url($url, true);
			}else{
				$data[$table][$field] = $v['default_value'];
			}
		break;
		
		//时间选择器
		case 'textdate':
			if($v['not_null'] && !strlen($F[$field])) {
				if($step)
					exit(p8_json(array('field'=>$v['alias'].$P8LANG['forms_field_required'])));
				else
					message($v['alias'].' can not empty');
			}
			
			$data[$table][$field] = isset($F[$field]) ? strtotime($F[$field]) : '';
		break;
		
		//批量上传
		case 'multi_uploader_basic':
			if($posted){
				if($v['not_null'] && empty($F[$field])) {
					if($step)
						exit(p8_json(array('field'=>$v['alias'].$P8LANG['forms_field_required'])));
					else
						message($v['alias'].' can not empty');
				}

				$title = isset($F[$field]['title']) ? (array)$F[$field]['title'] : array();
				$url = isset($F[$field]['url']) ? (array)$F[$field]['url'] : array();
				
				$data[$table][$field] = $comma = '';
				foreach($url as $k => $v){
					if(!strlen($v)) continue;
					
					$data[$table][$field] .= $comma . 
						filter_word($title[$k]) . $this->model->col_delimiter .$v;
					
					$comma = $this->model->delimiter;
				}
				
				$data[$table][$field] = attachment_url($data[$table][$field], true);
			}
		break;
		
		//批量上传
		case 'multi_uploader':
			if($posted){
				if($v['not_null'] && empty($F[$field])) {
					if($step)
						exit(p8_json(array('field'=>$v['alias'].$P8LANG['forms_field_required'])));
					else
						message($v['alias'].' can not empty');
				}

				$title = isset($F[$field]['title']) ? (array)$F[$field]['title'] : array();
				$url = isset($F[$field]['url']) ? (array)$F[$field]['url'] : array();
				$thumb = isset($F[$field]['thumb']) ? (array)$F[$field]['thumb'] : array();
				
				$data[$table][$field] = $comma = '';
				foreach($url as $k => $v){
					if(!strlen($v)) continue;
					
					$data[$table][$field] .= $comma . 
						filter_word($title[$k]) . $this->model->col_delimiter .
						$v . $this->model->col_delimiter .
						$thumb[$k];
					
					$comma = $this->model->delimiter;
				}
				
				$data[$table][$field] = attachment_url($data[$table][$field], true);
			}
		break;
		
		//上传器
		case 'photo_uploader':
			if($posted){
				if($v['not_null'] && empty($F[$field])) {
					if($step)
						exit(p8_json(array('field'=>$v['alias'].$P8LANG['forms_field_required'])));
					else
						message($v['alias'].' can not empty');
				}				
				$data[$table][$field] = attachment_url($F[$field], true);
			}else{
				$data[$table][$field] = $v['default_value'];
			}
		break;
		
		//教育经历
		case 'multi_edu':
			if($posted){
				if($v['not_null'] && empty($F[$field])) {
					if($step)
						exit(p8_json(array('field'=>$v['alias'].$P8LANG['forms_field_required'])));
					else
						message($v['alias'].' can not empty');
				}

				$date_attended_from = isset($F[$field]['date_attended_from']) ? (array)$F[$field]['date_attended_from'] : array();
				$date_attended_to = isset($F[$field]['date_attended_to']) ? (array)$F[$field]['date_attended_to'] : array();				
				$schoolname = isset($F[$field]['schoolname']) ? (array)$F[$field]['schoolname'] : array();
				$diploma_received = isset($F[$field]['diploma_received']) ? (array)$F[$field]['diploma_received'] : array();
				$fieldofstudy = isset($F[$field]['fieldofstudy']) ? (array)$F[$field]['fieldofstudy'] : array();
				
				$data[$table][$field] = $comma = '';
				foreach($schoolname as $k => $v){
					if(!strlen($v)) continue;
					
					$data[$table][$field] .= $comma . 
						$date_attended_from[$k] . $this->model->col_delimiter .
						$date_attended_to[$k] . $this->model->col_delimiter .
						$v . $this->model->col_delimiter .
						$diploma_received[$k] . $this->model->col_delimiter .
						$fieldofstudy[$k];
					
					$comma = $this->model->delimiter;
				}				
			}
		break;
		
		//工作简历
		case 'multi_employ':
			if($posted){
				if($v['not_null'] && empty($F[$field])) {
					if($step)
						exit(p8_json(array('field'=>$v['alias'].$P8LANG['forms_field_required'])));
					else
						message($v['alias'].' can not empty');
				}

				$date_attended_from = isset($F[$field]['date_attended_from']) ? (array)$F[$field]['date_attended_from'] : array();
				$date_attended_to = isset($F[$field]['date_attended_to']) ? (array)$F[$field]['date_attended_to'] : array();				
				$employer = isset($F[$field]['employer']) ? (array)$F[$field]['employer'] : array();
				$position = isset($F[$field]['position']) ? (array)$F[$field]['position'] : array();
				
				$data[$table][$field] = $comma = '';
				foreach($employer as $k => $v){
					if(!strlen($v)) continue;
					
					$data[$table][$field] .= $comma . 
						$date_attended_from[$k] . $this->model->col_delimiter .
						$date_attended_to[$k] . $this->model->col_delimiter .
						$v . $this->model->col_delimiter .
						$position[$k];
					
					$comma = $this->model->delimiter;
				}				
			}
		break;
		
		//家庭成员
		case 'multi_family':
			if($posted){
				if($v['not_null'] && empty($F[$field])) {
					if($step)
						exit(p8_json(array('field'=>$v['alias'].$P8LANG['forms_field_required'])));
					else
						message($v['alias'].' can not empty');
				}

				$members = isset($F[$field]['members']) ? (array)$F[$field]['members'] : array();
				$name = isset($F[$field]['name']) ? (array)$F[$field]['name'] : array();				
				$phone = isset($F[$field]['phone']) ? (array)$F[$field]['phone'] : array();
				$email = isset($F[$field]['email']) ? (array)$F[$field]['email'] : array();
				$employer = isset($F[$field]['employer']) ? (array)$F[$field]['employer'] : array();
				$position = isset($F[$field]['position']) ? (array)$F[$field]['position'] : array();
				
				$data[$table][$field] = $comma = '';
				foreach($name as $k => $v){
					if(!strlen($v)) continue;
					
					$data[$table][$field] .= $comma . 
						$members[$k] . $this->model->col_delimiter .
						$v . $this->model->col_delimiter .
						$phone[$k] . $this->model->col_delimiter .
						$email[$k] . $this->model->col_delimiter .
						$employer[$k] . $this->model->col_delimiter .
						$position[$k];
					
					$comma = $this->model->delimiter;
				}				
			}
		break;
		//编辑器,编辑器的内容很危险
		case 'editor': case 'editor_basic': case 'editor_common':case 'ueditor': case 'ueditor_common':
			if($posted && isset($F[$field])){
				if($v['not_null'] && !strlen($F[$field])) {
					if($step)
						exit(p8_json(array('field'=>$v['alias'].$P8LANG['forms_field_required'])));
					else
						message($v['alias'].' can not empty');
				}
				
				$acl = $this->core->load_acl('core', '', $this->ROLE);
				$data[$table][$field] = p8_html_filter($F[$field], $acl['allow_tags'], $acl['disallow_tags']);
				//本地化图片
				if(!empty($POST['capture_image'])){
					$this->_att_ids = '';
					
					$data[$table][$field] = preg_replace_callback(
						'#<img[^>]*?src=(?:\'|")?([^\'"]+)(?:\'|")?[^>]*?>#',
						array(&$this, 'capture_image'),
						$data[$table][$field]
					);
					
					$_COOKIE[$this->core->CONFIG['cookie']['prefix'] . 'uploaded_attachments'][$data['attachment_hash']] .= $this->_att_ids;
				}
				
				$data[$table][$field] = attachment_url( filter_word($data[$table][$field]), true);
			}else{
				$data[$table][$field] = $v['default_value'];
			}
		break;
		
		//多级联动
		case 'linkage':
			if($posted  && !empty($F[$field])){
				$c = $v['data']['select_size'];
				foreach($F[$field] as $k=>$vl){
					if($vl)
					$data[$table][$field] = $vl;
				}
				if($v['not_null'] && empty($data[$table][$field])){
					if($step)
						exit(p8_json(array('field'=>$v['alias'].$P8LANG['forms_field_required'])));
					else
						message($v['alias'].' can not empty');
				}
			}else{
				$data[$table][$field] = $v['default_value'];
			}			
		break;
		
		default:
			if($v['not_null'] && !strlen($F[$field])) {
				if($step)
					exit(p8_json(array('field'=>$v['alias'].$P8LANG['forms_field_required'])));
				else
					message($v['alias'].' can not empty');
			}
			
			$data[$table][$field] = $posted && isset($F[$field]) ?
				filter_word($func($F[$field])) :
				$v['default_value'];
		}
		
	}
	//处理自定义字段结束}
	return $data;
}


/**
* 添加一个表单模型
**/
function add_model(&$POST){

	$data = $this->valid_model_data($POST);
	if(!$this->check_model_name($data['name'])) return false;
	return $this->model->add_model($data);
}

/**
* 修改模型
**/
function update_model(&$POST){
	$mid = intval($POST['id']) or message('no_such_model');
	$data = $this->valid_model_data($POST);

	$config = &$data['config'];
     $configmap=['captcha','mobile_post_captcha','search_captcha','mobile_search_captcha','parts_enabled','email_enabled'];
    foreach($configmap as $ii){
        if(!isset($config[$ii])) $config[$ii]=0;
    }
		if(!empty($config['parts'])){
			function cmp($a, $b){
				return strcmp($b['order'], $a['order']);
			}
			uasort($config['parts'],'cmp');
		}
	unset($data['name']);//模型名不允许修改
	return $this->model->update_model($mid, $data);
}


/**
* 验证模型数据
* @param array $POST
**/
function valid_model_data(&$POST){
	$data = array();
	$data['name'] = isset($POST['name']) ? $this->valid_name($POST['name']) : '';
	$data['alias'] = isset($POST['alias']) ? html_entities($POST['alias']) : '';
	$data['verified'] = empty($POST['verified']) ? '' : implode(',', $POST['verified']);
	$data['enabled'] = empty($POST['enabled']) ? false : true;
	$data['recommend'] = empty($POST['recommend']) ? 0 : 1;
	$data['post_template'] = empty($POST['post_template']) ? '' : $POST['post_template'];
	$data['list_template'] = empty($POST['list_template']) ? '' : $POST['list_template'];
	$data['view_template'] = empty($POST['view_template']) ? '' : $POST['view_template'];
	$data['post_template_mobile'] = empty($POST['post_template_mobile']) ? '' : $POST['post_template_mobile'];
	$data['list_template_mobile'] = empty($POST['list_template_mobile']) ? '' : $POST['list_template_mobile'];
	$data['view_template_mobile'] = empty($POST['view_template_mobile']) ? '' : $POST['view_template_mobile'];
	//配置IP
	$POST['config']['allow_ip']['enabled'] = isset($POST['config']['allow_ip']['enabled']) ? $POST['config']['allow_ip']['enabled'] : 0;		
	$POST['config']['allow_ip']['collectip'] = isset($POST['config']['allow_ip']['collectip']) ? explode("\r\n", trim($POST['config']['allow_ip']['collectip'])) : array();
	$POST['config']['allow_ip']['collectip'] = array_filter(array_map('trim',$POST['config']['allow_ip']['collectip']));
	$POST['config']['allow_ip']['beginip'] = isset($POST['config']['allow_ip']['beginip']) ? trim($POST['config']['allow_ip']['beginip']) : '';
	$POST['config']['allow_ip']['endip'] = isset($POST['config']['allow_ip']['endip']) ? trim($POST['config']['allow_ip']['endip']) : '';		
	$POST['config']['allow_ip']['ruleoutip'] = isset($POST['config']['allow_ip']['ruleoutip']) ? explode("\r\n", trim($POST['config']['allow_ip']['ruleoutip'])) : array();
	$POST['config']['allow_ip']['ruleoutip'] = array_filter(array_map('trim',$POST['config']['allow_ip']['ruleoutip']));

    $POST['config']['allow_ip']['area_ip'] = isset($POST['config']['allow_ip']['area_ip']) ? explode("\r\n", trim($POST['config']['allow_ip']['area_ip'])) : array();
    $POST['config']['allow_ip']['area_ip'] = array_filter(array_map('trim',$POST['config']['allow_ip']['area_ip']));
	$POST['config']['deadline'] = isset($POST['config']['deadline']) && $POST['config']['deadline'] ? strtotime($POST['config']['deadline']) : '';
	$POST['config']['post_total'] = isset($POST['config']['post_total']) && $POST['config']['post_total'] ? intval($POST['config']['post_total']) : 0;
	$data['config'] = isset($POST['config']) && is_array($POST['config']) ? $POST['config'] : array();
	
	return $data;
}


/**
* 添加一个字段
* @param array $POST 数据
**/
function add_field(&$POST){
	$data = $this->valid_field_data($POST);
	
	if(!$this->check_field_name($data['name'])) return false;
	
	if(!isset($this->model->field_types[$data['type']])) return false;	//不允许的类型
	if(!isset($this->model->widgets[$data['widget']])) return false;	//不允许的类型

	return $this->model->add_field($data);
}
/**
* 修改一个字段
* @param int $id ID
* @param array $POST 数据
**/
function update_field($id, &$POST){
	$data = $this->valid_field_data($POST);
	if(!isset($this->model->field_types[$data['type']])) return false;	//不允许的类型
	if(!isset($this->model->widgets[$data['widget']])) return false;	//不允许的类型
	if($data['parent'] == $id) $data['parent'] = 0;
	
	return $this->model->update_field($id, $data);
}

/**
* 验证模型字段数据
* @param array $POST
**/
function valid_field_data(&$POST){
	
	$data = array();
	
	$data['type'] = isset($POST['type']) ? $POST['type'] : '';
	$data['widget'] = isset($POST['widget']) ? $POST['widget'] : '';
	$data['widget_addon_attr'] = isset($POST['widget_addon_attr']) ? $POST['widget_addon_attr'] : '';
	$data['model'] = $this->model->MODEL;
	$data['name'] = isset($POST['name']) ? $this->valid_name($POST['name']) : '';
	$data['parent'] = isset($POST['parent']) ? intval($POST['parent']) : 0;
	$data['alias'] = isset($POST['alias']) ? html_entities($POST['alias']) : '';
	$data['length'] = isset($POST['fieldlength']) ? preg_replace("/[^0-9,]/", '', $POST['fieldlength']) : 0;
	$data['is_unsigned'] = empty($POST['is_unsigned']) ? 0 : 1;
	$data['editable'] = empty($POST['editable']) ? 0 : 1;
	$data['not_null'] = empty($POST['not_null']) ? 0 : 1;
	$data['list_table'] = empty($POST['list_table']) ? 0 : 1;
	$data['filterable'] = empty($POST['filterable']) ? 0 : 1;
	//$data['orderby'] = empty($POST['orderby']) ? 0 : 1;
	$data['default_value'] = isset($POST['default_value']) ? html_entities($POST['default_value']) : '';
	$data['units'] = isset($POST['units']) ? html_entities($POST['units']) : '';
	$data['description'] = isset($POST['description']) ? html_entities($POST['description']) : '';
	$data['part'] = empty($POST['part']) ? '' : $POST['part'].'-'.(empty($POST['part_row'])? '' : $POST['part_row']);
	

	$data_key = isset($POST['data_key']) ? (array)$POST['data_key'] : array();
	$data_value = isset($POST['data_value']) ? (array)$POST['data_value'] : array();
	$data_note = isset($POST['data_note']) ? (array)$POST['data_note'] : array();
	
	$data['data'] = array();
	foreach($data_key as $k => $v){
		if($data['widget']!=='linkage' && ($v=='select_size' || $v=='select_data')) continue;
		if(!isset($data_value[$k])) continue;
		$data['data'][html_entities($v)] = array(html_entities($data_value[$k]),html_entities($data_note[$k]));
	}	
	$data['display_order'] = isset($POST['display_order']) ? intval($POST['display_order']) : 0;
	$data['jsreg'] = isset($POST['jsreg']) ? $POST['jsreg'] : '';
	$data['jsregmsg'] = isset($POST['jsregmsg']) ? html_entities($POST['jsregmsg']) : ($data['jsreg']? $P8LANG['error']:'');
	$data['color'] = isset($POST['color']) ? html_entities($POST['color']) : '';
	$data['config'] = isset($POST['config']) ? p8_stripslashes2((array)$POST['config']) : array();
	$data['config']['unique'] = isset($data['config']['unique']) && $data['config']['unique'] ? 1 : 0;
	$data['config']['print'] = isset($data['config']['print']) && $data['config']['print'] ? 1 : 0;
	$fields = array_flip(array('id', 'config', 'type', 'widget', 'widget_addon_attr', 'model', 'name', 'alias', 'length', 'is_unsigned', 'not_null', 'list_table', 'filterable', 'orderby', 'default_value', 'data', 'display_order', 'part'));
	/*
	foreach($data['config'] as $k => $v){
		if(isset($fields)) unset($data[$k]);
	}*/
	
	unset($data_key, $data_value);
	
	return $data;
}

/**
* 验证是否是正确的模型名,字段名,必须以字母开头
* @param string $name
**/
function valid_name($name){
	return preg_replace('/[^0-9a-zA-Z_]/', '', $name);
}
/**
* 检查模型名称是不是合法的
* @param string $name 模型名称
* @return bool
**/

function check_model_name($name){
	
	if(!preg_match('/^[a-zA-z]/', $name) && preg_match('/[^0-9A-Za-z_]/', $name)){
		return false;
	}
	
	if(empty($name)) return false;
	
	//不能用以下的名称作为模型名称
	if(in_array($name, array('core', 'config', 'label', 'global', 'inc', 'call', 'admin', 'install', '#', 'acl', 'modules', 'model', 'widget', 'member', 'homepage', 'special', 'models'))) return false;
	
	//检查模型名是否有重复
	$tmp = $this->model->get_model($name);
	return empty($tmp);
}
/**
* 检查一个字段名是否合法
* @param int $mid 模型ID
* @param string $name 字段名称
* @return bool
**/
function check_field_name($name){
	
	if(!preg_match('/^[a-zA-z]/', $name) && preg_match('/[^0-9A-Za-z_]/', $name)){
		return false;
	}
	
	if(empty($name)) return false;
	
	//不能用以下的名称作为字段名称
	if(in_array($name, array('category', 'page', 'data', 'addon', 'model_name', 'name', 'id'))) return false;
	
	
	//字段不能与两个数据表的重复
    $tmp = $this->DB_master->checkFileExists($this->model->table,$name);
	if(!empty($tmp)){
		return false;
	}

	$tmp = $this->DB_master->checkFileExists($this->model->data_table,$name);
	if(!empty($tmp)){
		return false;
	}
	
	return true;
}
/**
* 检查模型权限
**/
function check_model_action($action, $mid = 0){
	global $IS_FOUNDER;
	if($IS_FOUNDER) return true;
	
	//如果没有上一级权限
	if(!parent::check_action($action)) return false;
	
	//如果拥有所有分类的权限
	if(!empty($this->category_acl[0]['actions'][$action])) return true;
	return !empty($this->category_acl[$mid]['actions'][$action]);
}

function get_select_data($data, $iid){
	
	$select_data = array();
	if($data){
		$select_data = stripslashes(html_decode_entities($data));
		$select_data = mb_unserialize($select_data);
		if($iid){
			$p = explode('-',$iid);
			$l = count($p);
			foreach($p as $key=>$val){
				if($key==0)
					$select_data = !empty($select_data[$val])? $select_data[$val] : array();
				else
					$select_data = !empty($select_data['s'])? $select_data['s'][$val] : array();
			}
			$select_data = !empty($select_data['s'])? $select_data['s'] : array();
		}
	}
	return $select_data;
}
function update_linkage($post){
	$fid = intval($post['fid']);
	$iid = $post['iid'];
	$file_data = $this->model->get_field($fid);
	$select = mb_unserialize($file_data['data']);
	$select_data = $this->get_select_data($select['select_data'], $iid);
	$nemes = $post['name'];
	foreach($select_data as $key=>$val){
		if($val['n']!= $nemes[$key])
			$select_data[$key]['n'] = $nemes[$key];
	}
	
	if(!empty($post['n_name'])){
		foreach($post['n_name'] as $key=>$val){
			$select_data[$key]=array(
				'i'=> ($iid? $iid.'-'.$key : $key),
				'n'=> $val,
				's'=>''
			);
		}
	}
	
	$path = explode('-',$iid);
	$main_select_data = $this->get_select_data($select['select_data'], 0);
	$temp = &$main_select_data;
	if($main_select_data && $iid){
		foreach($path as $key=>$val){
			$temp = &$temp[$val]['s'];
		}
	}
	$order = $post['order'];
	arsort($order);
	
	$_temp = array();
	foreach($order as $k=>$v){
		$_temp[$k] = $select_data[$k];
	}
	$temp = $_temp;
	$data = array(
		'data'=>array(
			'select_size'=>$select['select_size'],
			'select_data'=>html_entities(addslashes(serialize($main_select_data)))
		)
	);
	return $this->model->update_field_data($fid, $data);

}


function delete_linkage_item($post){
	$fid = intval($post['fid']);
	$iid = $post['iid'];
	$file_data = $this->model->get_field($fid);
	$select = mb_unserialize($file_data['data']);
	$select_data = $this->get_select_data($select['select_data'], $iid);
		
	$path = explode('-',$iid);
	$main_select_data = $this->get_select_data($select['select_data'], 0);
	$temp = &$main_select_data;
	$lid = array_pop($path);
	if($main_select_data && $iid){
		foreach($path as $key=>$val){
			$temp = &$temp[$val]['s'];
		}
	}
	unset($temp[$lid]);
	$data = array(
		'data'=>array(
			'select_size'=>$select['select_size'],
			'select_data'=>htmlspecialchars(addslashes(serialize($main_select_data)))
		)
	);
	return $this->model->update_field_data($fid, $data);
}

/**
 * 允许IP
 */
function allow_ip($config){
	if(!isset($config['allow_ip']['enabled']) || $config['allow_ip']['enabled'] == 0){
		return true;
	}
    if($config['allow_ip']['enabled'] == 2){
		return area_ip();
	}
	//ip集合序列
	if(in_array(P8_IP,$config['allow_ip']['collectip'])){
		return true;
	}
	
	//允许的ip段,支持*号
	if(!empty($config['allow_ip']['collectip'])){
		$ipregexp = implode('|', str_replace(array('*','.'), array('\d+','\.') ,$config['allow_ip']['collectip']));
		if(preg_match("/^(".$ipregexp.")$/", P8_IP)) return true;
	}

	//ip段
	if(!empty($config['allow_ip']['area_ip'])){
        foreach($config['allow_ip']['area_ip'] as $ipss=>$k){
            list($beginip,$endip)=explode('-',$ipss);
            $pos_begin = strrpos($beginip, '.');
            $pos_end = strrpos($endip, '.');
            $pos_user = strrpos(P8_IP, '.');

            $ippre_begin = ($pos_begin === false) ? '' : substr($beginip, 0, $pos_begin) ;
            $ippre_end = ($pos_end === false) ? '' : substr($endip, 0, $pos_end);
            $ippre_user = ($pos_user === false) ? '' : substr(P8_IP, 0, $pos_user);

            if(empty($ippre_user)){
                continue;
            }

            if(!empty($ippre_begin) && !empty($ippre_end) && $ippre_begin == $ippre_end){

                if($ippre_end == $ippre_user && intval(substr(P8_IP, $pos_user+1)) >= intval(substr($beginip, $pos_begin+1)) && intval(substr(P8_IP, $pos_user+1)) <= intval(substr($endip, $pos_end+1))){
                    //ip例外
                    if(!isset($config['allow_ip']['ruleoutip'][P8_IP])){
                        return true;
                    }
                }
            }

        }
    }

	message('not_allow_ip');

}

}
