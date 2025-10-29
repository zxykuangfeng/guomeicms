<?php
/**
*接收第三方提交过来的JSON或XML数据
**/
header('Content-type: application/json;charset=utf-8');
require dirname(__FILE__) .'/../inc/init.php';
$core->CONFIG['debug'] = 0;
$username = isset($_REQUEST['u']) ? p8_stripslashes2($_REQUEST['u']) : '';
$password = isset($_REQUEST['p']) ? p8_stripslashes2($_REQUEST['p']) : '';
defined('PHP168_PATH') or die();
$json = array('status'=>500);
if(!isset($core->CONFIG['system&module']['sites'])){
	$json['message'] = $P8LANG['no_such_system'];
	exit(json_encode($json,JSON_UNESCAPED_UNICODE));
}
if(REQUEST_METHOD == 'POST'){
	if(!empty($username) && !empty($password)){
		$member = &$core->load_module('member');
		//强制用系统的账号体系登录。
		$ret = $member->login($username, $password,0,false,'username','api');	
		if($ret['status'] == 0){
			$member_info = get_member($username, false, 'username');
			$UID = intval($ret['id']);
			$IS_ADMIN = intval($member_info['is_admin']);
			$IS_FOUNDER = intval($member_info['is_founder']);
			define('ADMIN_FORCE',true);
			define('P8_CLUSTER',true);
			define('P8_API',true);
			$SYSTEM = 'sites';
			$_P8SESSION['#admin_login#'] = 1;
			$this_system = &$core->load_system('sites');
			$this_module = $this_system->load_module('item');
			$this_controller = &$core->controller($this_module);			
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
			if(empty($data['site'])) {
				$json['status'] = -10;
				$json['message'] = '分站别名没传递，必须指定要推送到的分站别名';
				exit(json_encode($json,JSON_UNESCAPED_UNICODE));
			}else{
				$all_sites = $this_system->get_sites();
				if(array_key_exists($data['site'],$all_sites) && $all_sites[$data['site']]['status']){
					$this_system->init_site($data['site'],true);
				}else{
					$json['status'] = -11;
					$json['message'] = '分站别名不存在或关闭！';
					exit(json_encode($json,JSON_UNESCAPED_UNICODE));
				}
			}			
			$id = isset($data['id']) ? intval($data['id']) : array();
			$value = isset($data['value']) ? intval($data['value']) : 0;
			$verified = isset($data['verified']) && $data['verified'] == 1 ? true : false;			
			if(empty($id)){
				$json['status'] = -8;
				$json['message'] = '稿件ID没传递，必须指定要审核的稿件ID';
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
			//退稿理由
			$push_back_reason = isset($data['push_back_reason']) ? html_entities(from_utf8($data['push_back_reason'])) : '';
			
			$T = $value == 1 ? $this_module->unverified_table : $this_module->main_table;
			$T = $verified ? $this_module->main_table : $this_module->unverified_table;
			
			$cond = $T .'.id = '.$id;

			$ret = $this_controller->verify(array(
				'where' => $cond,
				'value' => $value,
				'verified' => $verified,
				'push_back_reason' => $push_back_reason
			));
			if(isset($ret[0]) && $ret[0]){
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