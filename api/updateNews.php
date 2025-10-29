<?php
/**
*接收第三方提交过来的JSON或XML数据
**/
header('Content-type: application/json;charset=utf-8');
require dirname(__FILE__) .'/../inc/init.php';
$username = isset($_REQUEST['u']) ? p8_stripslashes2($_REQUEST['u']) : '';
$password = isset($_REQUEST['p']) ? p8_stripslashes2($_REQUEST['p']) : '';
defined('PHP168_PATH') or die();
$json = array('status'=>500);
if(REQUEST_METHOD == 'POST'){
	if(!empty($username) && !empty($password)){
		$member = &$core->load_module('member');
		$ret = $member->login($username, $password,0,false,'username','api');
		if($ret['status'] == 0){
			$member_info = get_member($username, false, 'username');
			$UID = intval($ret['id']);
			$IS_ADMIN = intval($member_info['is_admin']);
			$IS_FOUNDER = intval($member_info['is_founder']);
			define('ADMIN_FORCE',true);
			define('P8_CLUSTER',true);
			define('P8_API',true);
			$SYSTEM = 'cms';
			$_P8SESSION['#admin_login#'] = 1;
			$this_system = &$core->load_system('cms');
			$this_module = $this_system->load_module('item');
			$this_controller = &$core->controller($this_module);
			//检测权限
			/*
			if(!$this_controller->check_action('add')){
				$json['message'] = '账号没有发布稿件权限';
				exit(json_encode($json,JSON_UNESCAPED_UNICODE));
			}
			*/
			$fileContent = file_get_contents("php://input");				
			//检测是否json
			$json_test = json_decode($fileContent,true);				
			if(!empty($json_test)){
				$data = $json_test;
			}else{
				libxml_disable_entity_loader(true);
				$data = json_decode(json_encode(simplexml_load_string($fileContent, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
			}			
			$data = p8_stripslashes2($data);				
			if(empty($data)){
				$json['status'] = 0;
				$json['message'] = '数据为空';
				exit(json_encode($json,JSON_UNESCAPED_UNICODE));
			}
			$id = isset($data['id']) ? intval($data['id']) : 0;
			$verified = $data['verified'] == 1 ? true : false;
			if(empty($id)){
				$json['status'] = -8;
				$json['message'] = '稿件ID没传递，必须指定要修改的稿件ID';
				exit(json_encode($json,JSON_UNESCAPED_UNICODE));
			}else{				
				if($verified){
					$originally_data = $this_module->data('read', $id);
				}else{
					$originally_data = $DB_slave->fetch_one("SELECT * FROM $this_module->unverified_table WHERE id = '$id'");
				}
				if(empty($originally_data)){
					$json['status'] = -9;
					$json['message'] = '稿件状态已被修改或被删除';
					exit(json_encode($json,JSON_UNESCAPED_UNICODE));
				}
			}
			$data['cid'] = isset($data['cid']) ? intval($data['cid']) : 839;			
			if(empty($data['cid'])) {
				$json['status'] = -1;
				$json['message'] = '栏目ID没传递，必须指定要推送的栏目ID';
				exit(json_encode($json,JSON_UNESCAPED_UNICODE));
			}
			$data['model'] = $data['model'] ? trim($data['model']) : 'article';			
			if($data['model']){
				$all_models = $this_system->get_models();
				if(!array_key_exists($data['model'],$all_models) || empty($all_models[$data['model']]['enabled'])){
					$json['status'] = -2;
					$json['message'] = $data['model'].'模型不存在或没启用！';
					exit(json_encode($json,JSON_UNESCAPED_UNICODE));
				}
			}else{
				$json['status'] = -2;
				$json['message'] = $data['model'].'模型不存在或没启用！';
				exit(json_encode($json,JSON_UNESCAPED_UNICODE));
			}
			$_REQUEST['model'] = $data['model'];								
			$this_system->init_model();			
			if(empty($this_model)){
				$json['status'] = -3;
				$json['message'] = '系统内部模型错误，模型名称可能被修改';
				exit(json_encode($json,JSON_UNESCAPED_UNICODE));
			}
			//发布时间兼容处理
			$data['timestamp'] = trim($data['timestamp']);				
			if(strpos($data['timestamp'],'-') && strtotime($data['timestamp']) <= P8_TIME){
				
			}else{
				if(strtotime(date('Y-m-d H:i:s',$data['timestamp']))){
					$data['timestamp'] = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s',$data['timestamp'])));
				}else{
					$data['timestamp'] = date('Y-m-d H:i:s',time());
				}
			}
			$data['frame'] = $data['logo'];
			$data['#field_content_posted'] = '';
			$data['username'] = $username;
			//审核
			$data['verify'] = 0;
			$data['uid'] = $ret['id'];			
			
			
			//检查分类自动终审权限			
			if($this_controller->check_category_action('autoverify', $data['cid'])){
				$data['verify'] = 1;
				$data['verifier'] = $username;
			}
			//分页
			$content = array();
			$data['field#']['content'] = array();
			if(isset($data['field#']['content'])){
				//$content = preg_split('#<div style="page-break-after:\s*?always;?">\s*?<span style="display: none;?">.*?</span>\s*?</div>#is', $data['field#']['content']);
				
				$data['field#']['content'] = $data['content'];
			}
			$data['iid'] = $id;
			$data['html'] = 1;
			$data['filter_word_enable'] = 1;
			$data['content_censor_enabled'] = 1;
			$status = $this_controller->update($id,$data,$verified,true);
			//var_dump(array('id'=>$id));
			if($status){
				$json['status'] = 200;
				$json['message'] = '成功';				
				exit(json_encode($json,JSON_UNESCAPED_UNICODE));
			}else{
				$json['status'] = -7;
				$json['message'] = '发生其它未知错误';
				exit(json_encode($json,JSON_UNESCAPED_UNICODE));
			}
		}else{
			$json['status'] = -5;
			$json['message'] = '登录失败，账号或密码不正确';
			exit(json_encode($json,JSON_UNESCAPED_UNICODE));			
		}
	}else{
		$json['status'] = -6;
		$json['message'] = '账号或密码为空';
		exit(json_encode($json,JSON_UNESCAPED_UNICODE));		
	}
}else{
	$json['status'] = -4;
	$json['message'] = '只接受POST请求，不支持GET请求';
	exit(json_encode($json,JSON_UNESCAPED_UNICODE));	
}