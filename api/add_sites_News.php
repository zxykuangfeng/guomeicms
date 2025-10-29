<?php
/**
*接收第三方提交过来的JSON或XML数据
**/
header('Content-type: application/json;charset=utf-8');
require dirname(__FILE__) .'/../inc/init.php';
$username = isset($_REQUEST['u']) ? p8_stripslashes2($_REQUEST['u']) : '';
$password = isset($_REQUEST['p']) ? p8_stripslashes2($_REQUEST['p']) : '';
defined('PHP168_PATH') or die();
if(!isset($core->CONFIG['system&module']['sites'])){
	returnError(0,  $P8LANG['no_such_system']);
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
				returnError(0,'数据为空');
			}			
			$data['cid'] = isset($data['cid']) ? intval($data['cid']) : 0;
			if(empty($data['cid'])) {
				returnError(-1,'栏目ID没传递，必须指定要推送的栏目ID');
			}
			$data['site'] = isset($data['site']) ? trim($data['site']) : '';
			
			if(empty($data['site'])) {
				returnError(-9,'分站别名没传递，必须指定要推送到的分站别名');
			}else{
				$all_sites = $this_system->get_sites();
				if(array_key_exists($data['site'],$all_sites) && $all_sites[$data['site']]['status']){
					$this_system->init_site($data['site'],true);
				}else{
					returnError(-8,'分站别名不存在或关闭！');
				}
			}
			$data['model'] = $data['model'] ? trim($data['model']) : 'article';
			if($data['model']){
				$all_models = $this_system->get_models();
				if(!array_key_exists($data['model'],$all_models) || empty($all_models[$data['model']]['enabled'])){
					returnError(-2, $data['model'].'模型不存在或没启用！');
				}
			}else{
				returnError(-2, $data['model'].'模型不存在或没启用！');
			}		
			$_REQUEST['model'] = $data['model'];
			$this_system->init_model();
			if(empty($this_model)){
				returnError(-3, '系统内部模型错误，模型名称可能被修改');
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
				$data['field#']['content'] = $data['content'];
			}			
			$data['html'] = 1;
			$data['filter_word_enable'] = 1;
			$data['content_censor_enabled'] = 1;
			$id = $this_controller->add($data);
			if($id){
				$json['id'] = $id;
				returnError(200, '成功');
			}else{
				returnError(-10, '发生其它未知错误');
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