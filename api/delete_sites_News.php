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
			if(empty($data['site'])) {
				returnError(-10, '分站别名没传递，必须指定要推送到的分站别名');
			}else{
				$all_sites = $this_system->get_sites();
				if(array_key_exists($data['site'],$all_sites) && $all_sites[$data['site']]['status']){
					$this_system->init_site($data['site'],true);
				}else{
					returnError(-11, '分站别名不存在或关闭！');
				}
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
					returnError(-9,  '稿件不存在');
				}
			}	
			$T = $verified ? $this_module->main_table : $this_module->unverified_table;
			/*签发源数据删除，签发数据同步删除*/
			$id = $this_module->get_clone_ids($id);
			$ret = $this_controller->delete(array(
				'where' => $T .'.id IN ('. implode(',', $id) .')',
				'verified' => $verified,
				'delete_hook' => false,
				'iid' => $id
			));
			//删除对接数据开始
			$info_iid = $core->DB_master->fetch_all("SELECT `iid` FROM $this_module->matrix_table WHERE sid IN (".implode(',', $id).")");	
			if($info_iid){
				$temp_iid = array();
				foreach($info_iid as $iid){
					$temp_iid[] = $iid['iid'];
				}
				$core->DB_master->delete($this_module->matrix_table, "sid IN (".implode(',', $id).")");
				$cms = $core->load_system('cms');
				$item = $cms->load_module('item');
				$cms_controller = $core->controller($item);		
				$cms_controller->delete(array(
					'where' => $item->main_table .'.id IN ('. implode(',', $temp_iid) .')',
					'verified' => true,
					'delete_hook' => true,
					'iid' => $temp_iid,
				));			
			}
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