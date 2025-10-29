<?php
defined('PHP168_PATH') or die();

class P8_Integrate_ldap{

var $core;
var $CONFIG;
var $db;

function __construct(&$core){
	$this->core = &$core;
	
	isset($core->CONFIG['integration']['config']) or die('error-没有正确配置单点登录!');

	$this->CONFIG = &$core->CONFIG['integration']['config'];
	
}

function P8_Integrate_ldap(&$core){
	$this->__construct($core);
}

/**
 用户登录
  @param  string $username   - 用户名
*/
function login($username,$domain=''){

	$data = get_member($username);
	if(empty($data)){
		$id = $this->register($username);
//		var_dump($id);
//		$status = $this->register($username);
		$data = get_member($username);
	}
    $member = $this->core->load_module('member');
    $member->_login($data, '');
	$data['message'] = $member->sync_session($domain);
    return $data;	
}

function logout(){

	
}
function delete_member($ids){
	return true;
}

function passwd($username, $password, $old_password = ''){
	return 0;
}

/**
 注册
  @param  string $username - 注册用户名
  @param  string $password - 注册密码(md5)
  @param  string $email	   - 邮箱
  @return int 注册用户uid
  -1 用户名不合法
  -2 用户名己存在
  -3 email不合法
  -4 email被注册
*/
function register($username, $password='', $email=''){
	global $core;
	if(($status = $this->check_username($username)) != 0){
		return $status;
	}
    if($email && ($status = $this->check_email($email)) != 0){
//		return $status;
	}
	
	
	$data = array(
		'username' => $username,
		'password' => $password?$password:md5(rand_str(6)),
		'email' => $email?$email:$username.rand_str(4)."@126.com",
		'role_id' => 2,
		'role_gid'=> 2,
	);
	$id = $this->core->DB_master->insert($this->core->member_table, $data, array('return_id' => true));
	$member = $core->load_module('member');
	$member_controller = $core->controller($member);
	$id = $member_controller->register($data);
	if($id){		
		return $id;
	}
	
	return -4;
}

function check_username($username){
	//没整合
	if(!preg_match('/^\w{4,}/', $username)){
		return -1;
	}
	
	$member = &$this->core->load_module('member');
	global $IS_ADMIN;
	if(!empty($member->CONFIG['reg_disallow_username']) && !($IS_ADMIN || defined('P8_CLUSTER'))){
		$disallow = trim($member->CONFIG['reg_disallow_username']);
		$tmp = array_filter(explode('|', $disallow));
		$disallow = implode('|', $tmp);
		
		if(preg_match('/^('. $disallow .')/i', $username)){
			return -1;
		}
	}
	
	return get_member($username) ? -2 : 0;
}

function check_email($email){
	return true;
}

}