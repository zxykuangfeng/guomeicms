<?php
/**
*接收第三方提交过来的JSON或XML数据
**/
header('Content-type: application/json;charset=utf-8');
require dirname(__FILE__) .'/../inc/init.php';
$username = isset($_REQUEST['username']) ? p8_stripslashes2($_REQUEST['username']) : '';
$password = isset($_REQUEST['password']) ? p8_stripslashes2($_REQUEST['password']) : '';
defined('PHP168_PATH') or die();
$json = array("code"=>200,'status'=>500);
if(REQUEST_METHOD == 'POST'){
	if(!empty($username) && !empty($password)){
		$member = &$core->load_module('member');		
		$username = isset($username) ? $member->authcode(html_entities($username)) : '';
		$password = isset($password) ? $member->authcode(html_entities($password)) : '';
		if(!empty($username) && !empty($password)){
			$ret = $member->login($username, $password);		
			if($ret['status'] == 0){
				//执行计划任务咯,生成静态时不执行
				$crontab = &$core->load_module('crontab');				
				$select = select();
				$select->from($crontab->table, '*');
				$select->in('script',array('cms_index_to_html.php','cms_index_to_html_mobile.php',' cms_index_to_html_mobile.php'));
				$list = $core->list_item($select);
				foreach($list as $k => $v){
					$crontab_id = $v['id'];
					require $crontab->path .'inc/run.php';
				}									
				$json['status'] = 200;
				$json['message'] = '成功';				
				exit(json_encode($json,JSON_UNESCAPED_UNICODE));
				
			}else{
				$json['message'] = '登录失败，账号或密码不正确';
				exit(json_encode($json,JSON_UNESCAPED_UNICODE));			
			}
		}else{
			$json['message'] = '账号或密码为空';
			exit(json_encode($json,JSON_UNESCAPED_UNICODE));
		}
	}else{
		$json['message'] = '账号或密码为空';
		exit(json_encode($json,JSON_UNESCAPED_UNICODE));		
	}
}else{	
	$json['message'] = '只接受POST请求，不支持GET请求';
	exit(json_encode($json,JSON_UNESCAPED_UNICODE));
}