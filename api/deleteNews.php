<?php
/**
*接收第三方提交过来的JSON或XML数据
**/
header('Content-type: application/json;charset=utf-8');
require dirname(__FILE__) .'/../inc/init.php';
//$core->CONFIG['debug'] = 0;
$username = isset($_REQUEST['u']) ? p8_stripslashes2($_REQUEST['u']) : '';
$password = isset($_REQUEST['p']) ? p8_stripslashes2($_REQUEST['p']) : '';
defined('PHP168_PATH') or die();
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
			$SYSTEM = 'cms';
			$_P8SESSION['#admin_login#'] = 1;
			$this_system = &$core->load_system('cms');
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
				returnError(0, '数据为空');
			}			
			
			$id = isset($data['id']) ? filter_int($data['id']) : array();
			$verified = isset($data['verified']) && $data['verified'] == 1 ? true : false;			
			if(empty($id)){
				returnError(-8, '稿件ID没传递，必须指定要删除的稿件ID');
			}else{				
				if($verified){
					$originally_data = $this_module->data('read', $id[0]);
				}else{
					$originally_data = $DB_slave->fetch_one("SELECT * FROM $this_module->unverified_table WHERE id = '$id[0]'");
				}
				if(empty($originally_data)){
					returnError(-9, '稿件不存在');
				}
			}			
			$T = $verified ? $this_module->main_table : $this_module->unverified_table;
			/*签发源数据删除，签发数据同步删除*/
			$id = $this_module->get_clone_ids(filter_int($id));
			$ret = $this_controller->delete(array(
				'where' => $T .'.id IN ('. implode(',', $id) .')',
				'verified' => $verified,
				'delete_hook' => false,
				'iid' => $id
			));
			if(isset($ret[0]) && $ret[0]){
				returnError(200, '成功');
			}else{
				returnError(-7, '发生其它未知错误');
			}
		}else{
			returnError(-5, '登录失败，账号或密码不正确');		
		}
	}else{
		returnError(-6, '账号或密码为空');	
	}
}else{
	returnError(-4, '只接受POST请求，不支持GET请求');
}