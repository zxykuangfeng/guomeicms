<?php
defined('PHP168_PATH') or die();

class P8_Member extends P8_Module{

var $table;						//会员表
var $friend_table;				//好友表
var $unverified_friend_table;	//好友表
var $friend_category_table;		//好友分类表
var $getpasswd_table;			//会员验证码状态表
var $acl_table;					//会员权限表
var $models;
var $delimiter;
var $col_delimiter;
var $addon_table;
var $role_gid;
var $role_id;
var $status;
var $username_reg;
var $dept_table;
var $depts;
var $province;
var $last_cache;		//最后一次更新权限缓存的时间戳

function __construct($system, $name){
	$this->system = &$system;
	parent::__construct($name);

	$this->table = $this->core->TABLE_ .'member';
	$this->getpasswd_table = $this->TABLE_ .'getpasswd';
	$this->friend_table = $this->TABLE_ .'friend';
	$this->unverified_friend_table = $this->TABLE_ .'friend_unverified';
	$this->friend_category_table = $this->TABLE_ .'friend_category';
	$this->acl_table = $this->TABLE_ .'acl';
	$this->dept_table = $this->TABLE_ .'dept';
	$this->username_reg = '[#@%<>&,\$\(\)\*"\'\s\\\\]';
	$this->last_cache = '@'. $this->core->CONFIG['last_user_acl_cache'];
	
	$this->delimiter = chr(7);
	$this->col_delimiter = chr(6);
	
	$this->models = array();
	$this->status = array(
		0 => 0,
		1 => 1,
		2 => 2,
	);
}

function P8_Member(&$system, $name){
	$this->__construct($system, $name);
}

function set_model($role_gid){
	$this->role_gid = $role_gid;
	$this->addon_table = $this->core->TABLE_ .'role_group_'. $role_gid .'_data';
}

function &get_model($role_gid){
	global $CACHE;
	$this->models[$role_gid] = $CACHE->read('core/modules', 'role', 'group_'. $role_gid, 'serialize');
	return $this->models[$role_gid];
}

function format_data(&$data){
	foreach($this->models[$this->role_gid]['fields'] as $field => $v){
		
		if(!isset($data[$field])) continue;
		
		switch($v['widget']){
		
		//分割多选项
		case 'checkbox':
		case 'multi_select':
			$data[$field] = explode($this->delimiter, $data[$field]);
		break;
		
		//上传器,编辑器要对附件地址处理
		case 'editor': case 'editor_basic': case 'editor_common':case 'ueditor': case 'ueditor_common':
			$data[$field] = attachment_url($data[$field]);
		break;
		
		case 'uploader':
			$tmp = explode($this->delimiter, attachment_url($data[$field]));
			$data[$field] = array(
				'title' => $tmp[0],
				'url' => isset($tmp[1]) ? $tmp[1] : ''
			);
		break;
		
		//多上传器
		case 'multi_uploader':
			$tmp = explode($this->delimiter, attachment_url($data[$field]));
			
			$data[$field] = array();
			foreach($tmp as $v){
				$v = explode($this->col_delimiter, $v);
				$data[$field][] = array(
					'title' => $v[0],
					'url' => isset($v[1]) ? $v[1] : ''
				);
			}
			unset($tmp);
		break;
		}
	}
}

/**
 * 用户注册
 * @param string $username 用户名
 * @param string $password 密码
 * @param array $datas 额外数据
 * @param boolen $is_admin 后台添加
 * @return int
 * >0 返回的用户ID
 * -1 用户名不合法
 * -2 用户名己存在
 * -3 email不合法
 * -4 email被注册
 **/
function register($username, $password, $email, $datas = array(),$is_admin = false){
	return include $this->path .'call/register.call.php';
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
function mobile_register($phone, $password='', $email=''){
	if(($status = $this->check_phone($phone)) != 0){
		return $status;
	}
	
	$data = array(
		'username' => rand_str(2).'_'.$phone,
		'password' => $password?$password:md5(rand_str(6)),
		'email' => $phone.'_'.rand_str(2)."@126.com"
	);
	$datas = array(
		'cell_phone' => $phone,
		'role_id' => 2,
		'role_gid'=> 2,
	);
	$id = $this->register($data['username'],$data['password'],$data['email'],$datas,false);
	if($id){		
		return $id;
	}	
	return -4;
}
function check_phone($phone){
	$pattern = '/^1[3456789]\d{9}$/'; 
	if(strlen($phone) < 11 || !preg_match($pattern, $phone)){
		return -1;
	}
	return $this->DB_master->fetch_one("SELECT id FROM {$this->table} WHERE `cell_phone` = '$phone'") ? -2 : 0;
}

/**
 * 会员登录
 * @param string $username 用户名
 * @param string $password 密码
 * @param int $id 用户ID,为API留的接口,注意,传入$id可以直接登录
 * @param bool $test 只检查用户名和密码是否正确,不进行登录的操作
 * @return array('status' => 登录状态, 'id' => 会员ID, 'message' => 信息) 
 * 0	登录成功
 * -1	用户名不存在
 * -2	密码错误
 **/
function login($username, $password, $id = 0, $test = false, $type = 'username',$from = 'user_center'){
	
	$ret = array(
		'status' => 0,
		'id' => 0,
		'useranme' => '',
		'email' => '',
		'message' => '',
	);
	
	if(
		$type == 'username' && empty($this->CONFIG['administrators'][$username]) && //管理员不受整合影响
		($inte = &$this->core->integrate()) && empty($id) && $from == 'user_center' //从后台登录的不使用整合
	){
		//本站的整合登录

		$odata = $inte->login($username, $password);

		if($odata['id'] > 0){	//登录成功了
			$data = get_member($username);
			
			if(empty($data)){	//本系统没有用户
				$data = array('id' => $odata['id']);

				$data['role_id'] = $this->core->CONFIG['member_role'];
				//直接在本系统注册
				$this->register($odata['username'], $odata['password'], $odata['email'], $data);
			}elseif($data['status']!=0){
				$this->logout();
				$ret['status'] = $data['status'];
				return $ret;
			}
			
			$data['username'] = $username;
			
			if(!$test) $this->_login($data, $password);
			
			$ret['status'] = 0;
			$ret['id'] = $odata['id'];
			$ret['role_id'] = $odata['role_id'];
			$ret['last_change_password'] = $odata['last_change_password'];
			$ret['username'] = $odata['username'];
			$ret['email'] = $odata['email'];
			$ret['message'] = $this->sync_session() . $odata['message'];
			
			return $ret;
		}
		//整合完毕

	}else{
		//{非整合
		$data = get_member($username, false, $type);

		//用户不存在
		if(empty($data)){
			$this->logout();
			$ret['status'] = -1;
			return $ret;
		}elseif($data['status']!=0){
			$this->logout();
			$ret['status'] = $data['status'];
			return $ret;	
		}
        $ret['last_change_password'] = $data['last_change_password'];
        $ret['role_id'] = $data['role_id'];
		$ret['id'] = $data['id'];
		$ret['username'] = $data['username'];
		$ret['email'] = $data['email'];
		$flag = false;
        //兼容之前的
        if(strlen($data['password'])==32){
            if($data['password'] == md5(md5($password) . $data['salt'])){
                //登录成功
                $flag = true;
            }elseif($data['password'] == md5($password . $data['salt'])){//兼容之前的
                //登录成功
                $flag = true;
            }elseif($data['password'] == substr(sha512(sha256($password).$data['salt']),0,32)){
				//登录成功
                $flag = true;
			}
			if($flag){
				$this->DB_master->update(
					$this->table,
					array(
						'password' => sha512(sha256($password) . $data['salt']),
					),
					"id = '$data[id]'"
				);
			}
        }elseif($data['password'] == sha512(sha256($password) . $data['salt'])){
            //登录成功
            $flag = true;
        }else if($id == $data['id'] && $username == $data['username']){
			//如果有$id传入,用户名也相同,用于整合的API
			$flag = true;
		}
		
		/*
		if(!$flag && md5(md5($password . $data['dz_salt'])) == $data['password']){
			$flag = true;
		}
		*/
		
		if($flag){
			if(!$test) $this->_login($data, $password);
			
			$ret['message'] = $this->sync_session() . $ret['message'];
			
			return $ret;
		}
		//}
	}

	$this->logout();
	//密码错误
	$ret['status'] = -2;
	return $ret;
}

/**
 * 设置成功登录的SESSION和cookie
 **/
function _login(&$data, $password){
	global $P8SESSION, $_P8SESSION,$USERNAME;
	if(empty($USERNAME)) $USERNAME = $data['username'];
	$P8SESSION['uid'] = $data['id'];
	$P8SESSION['username'] = $data['username'];
	$_P8SESSION['is_founder'] = empty($data['is_founder']) ? 0 : 1;
	$_P8SESSION['role@system'] = array('core' => $data['role_id']);
	$_P8SESSION['status'] = $data['status'];
	//清空各系统的角色

	//应用积分规则
	$credit = &$this->core->load_module('credit');
	$credit->apply_rule($this, 'login', $data['id'], $data['role_id']);
	
	set_cookie('UID', $data['id']);
	set_cookie('USERNAME', jsonencode($data['username']));
	set_cookie('ROLE', $data['role_id']);
	
	$_P8SESSION['is_admin'] = $data['is_admin'];
	$_P8SESSION['role_gid'] = $data['role_gid'];
	
	if($_P8SESSION['is_admin']){
		set_cookie('IS_ADMIN', 1);
		if($inte = &$this->core->integrate()){
			//设置SESSION即算登录后台,允许登录后台则登录前台时默认登录后台，不需要二次登录。
			$_P8SESSION['#admin_login#'] = 1;			
		}		
	}
	if(!empty($_POST['remember_me'])){
		set_cookie('LOGIN', p8_code(md5_16(USER_AGENT) ."\t". $data['username'] ."\t". $password), 31536000);
	}
	delete_session('uid = '.$data['id'].' and id<>\''.SESSION_ID.'\'');

	//更新登录时间,次数,IP
	$this->DB_master->update(
		$this->table,
		array(
			'last_login' => P8_TIME,
			'login_time' => 'login_time +1',
			'last_login_ip' => '\''. P8_IP .'\''
		),
		"id = '$data[id]'",
		false
	);
}

/**
* 跨域同步SESSION
**/
function sync_session($domain=''){
	
	$js = '';
	if(!empty($this->core->CONFIG['session_cross_domains'])){
		//每个域名的根目录下必须要放sync_session.php
		
		foreach($this->core->CONFIG['session_cross_domains'] as $k => $v){
			if(($domain && strpos($v,$domain)!==false) or !$domain)
			$js .= '<script type="text/javascript" src="'. $v .'?SESSION_ID='. SESSION_ID .'&domain='. urlencode($k) .'"></script>';
		}
	}
	
	return $js;
}


/**
* 退出
* @param bool $fromapi 是否从API调用
**/
function logout($fromapi = false){
	global $P8SESSION, $_P8SESSION;
	//整合退出
	$message = '';
	if(!$fromapi && ($inte = &$this->core->integrate())){
		
		$message = $inte->logout();
	}

	$P8SESSION['uid'] = 0;
	$_P8SESSION['is_admin'] = 0;
	$_P8SESSION['role@system'] = array('core' => $this->core->CONFIG['guest_role']);
	$P8SESSION['username'] = '';
	unset($_P8SESSION['#admin_login#']);
	//客户端浏览器重新生成Session认证会话属性标识
	session_start();
	session_regenerate_id();
	set_cookie('UID', '', -1);
	set_cookie('site', '', -1);
	set_cookie('USERNAME', '', -1);
	set_cookie('IS_ADMIN', '', -1);
	set_cookie('LOGIN', '', -1);
	
	return array(
		'status' => 1, 
		'message' => $message
	);
}

function delete($data, $from_api = false){
	return include $this->path .'call/delete.call.php';
}

/**
* 修改密码
* @param string $username 用户名
* @param string $new 新密码
* @param bool $from_api 是否从API传过来的
**/
function change_password($username, $new, $old = '', $from_api = false){
	return include $this->path .'call/change_password.call.php';
}

function update($id, &$data, &$orig_data){
	return include $this->path .'call/update.call.php';
}

/**
*注册发送通知
**/
function send_register($data, $uid, $_password){
	if($this->CONFIG['register']['verify']==1){
		global $P8LANG;
		$title = p8lang($P8LANG['register_mail_title'],$this->core->CONFIG['site_name']);
		$content = p8lang($P8LANG['register_mail_content'],$data['username'],$this->controller.'-active?id='.$uid.'&salt='.$data['salt'],$this->core->CONFIG['site_name']);
		$email = $this->core->load_module('mail');
			$email->set(array(
				'subject' => $title,
				'message' => nl2br($content),
				'send_to' => $data['email']
			));
			$email->send();
	}else
	if(!$this->CONFIG['register']['verify']){
		if($this->CONFIG['register']['message'] || $this->CONFIG['register']['email'] || $this->CONFIG['register']['sms']){
			$title = str_replace(array('{username}', '{sitename}'),array($data['username'],$this->core->CONFIG['site_name']),$this->CONFIG['register']['title']);
			$content = str_replace( array('{username}', '{sitename}','{password}', '{time}','{adminemail}'),
									array($data['username'], $this->core->CONFIG['site_name'], $_password, date('Y-m-d H:i',P8_TIME),$this->core->CONFIG['admin_email']),
									$this->CONFIG['register']['notice']
									);
		}
		if($this->CONFIG['register']['message']){
			$message = $this->system->load_module('message');
			$msg = array(
				'uid' => $uid,
				'title' => $title,
				'content' => nl2br($content)
			);
			$status = $message->send($msg);
		}
		if($this->CONFIG['register']['email']){
			$email = $this->core->load_module('mail');
			$email->set(array(
				'subject' => $title,
				'message' => nl2br($content),
				'send_to' => $data['email']
			));
			$email->send();
		}
		if($this->CONFIG['register']['sms'] && $data['cell_phone']){
			$sms = $this->core->load_module('sms');
			$content = str_replace(array("\t"), '', strip_tags($content));
			$sms->send(
				$data['cell_phone'],
				$content
			);
		}
	}
}

/**
 * 设置会员角色
 **/
function set_role($id, $role_id){
	
	if(
		$this->DB_master->update(
			$this->table,
			array(
				'last_role_id' => 'role_id',
				'role_id' => $role_id
			),
			"id = '$id'",
			false
		)
	){
		foreach($this->core->systems as $sys => $v){
			//修改各系统的角色
			$_system = get_system($sys);
			if(!$_system['installed']) continue;
			
			$this->DB_master->update(
				$_system['table_prefix'] .'member',
				array('role_id' => $role_id),
				"id = '$id'"
			);
		}
		
		/*
			$config = $this->core->get_config();
			$config['administrators'] = isset($config['administrators']) ? $config['administrators'] : array();
			$config['administrators'][$username] = 1;
			$this->set_config(array('administrators' => $config['administrators']));
		}*/
		
		delete_session("uid = '$id'");
	}
	
	$this->core->get_cache('role');
	if($this->core->roles[$role_id]['gid'] == $this->core->CONFIG['administrator_role_group']){
		$this->cache();
	}
}

/**
 * 验证问题
 * @param string $q 问题答案,如果为false时生成一条问题,如果不为false时验证问题
 * @param bool $test 检查问题是否正确,如果为true,那么不清除SESSION,用于AJAX检验
 * @return string|bool 检查问题时返回bool,生成问题时返回string
 **/
function verify_question($q = false, $test = false){
	global $_P8SESSION;

	if($q === false){
		//默认参数时,产生一条问题,并写入SESSION
		$qid = array_rand($this->CONFIG['verify_question']);
		$_P8SESSION['verify_question_id'] = $qid;

		return $this->CONFIG['verify_question'][$qid]['question'];

	}else{
		//验证问题
		$ret = true;
		if(!isset($_P8SESSION['verify_question_id'])) return false;

		if($this->CONFIG['verify_question'][$_P8SESSION['verify_question_id']]['answer'] != $q) $ret = false;

		if(!$test) unset($_P8SESSION['verify_question_id']);

		return $ret;
	}
}

function recharge_by_card($sn){
	$sn = preg_replace('/[^a-zA-Z0-9]/', '', $sn);
	
	$card = $this->DB_master->fetch_one("SELECT * FROM {$this->TABLE_}recharge_card WHERE sn = '$sn' AND used == '0'");
	if(empty($card)) return false;
	
	global $UID;
	$this->DB_master->update($this->TABLE_ .'recharge_card', array('uid' => $UID, 'used_timestamp' => P8_TIME), "sn = '$sn'");
	return $this->core->update_credit($UID, array($card['credit_type'] => $card['quantity']));
}

function pay_recharge(&$pay, $notify){
	return include $this->path .'call/pay_recharge.call.php';
}

function pay_buy_role(&$pay, $notify){
	return include $this->path .'call/pay_buy_role.call.php';
}

function cache(){
	$query = $this->DB_master->query("SELECT username FROM $this->table WHERE is_admin = '1'");
	
	$usernames = array();
	while($arr = $this->DB_master->fetch_array($query)){
		$usernames[$arr['username']] = 1;
	}
	
	$this->set_config(array('administrators' => $usernames));
}

/**
 * 模块配置,具体参数参见core
 * integration_types 为保护字段,存储了允许整合的类型
 **/
function set_config(
	$datas,
	$protect_fields = array(	//整合类型需要手动添加
		'integration_types' => 1
	),
	$ignore_fields = array()
){
	parent::set_config($datas, $protect_fields, $ignore_fields);
}

function add_friend_category($name){
	global $UID;
	
	return $this->DB_master->insert(
		$this->friend_category_table,
		array(
			'uid' => $UID,
			'name' => $name
		),
		array('return_id' => true)
	);
}

function update_friend_category($id, $name){
	global $UID;
	
	return $this->DB_master->update(
		$this->friend_category_table,
		array(
			'name' => $name
		),
		"id = '$id' AND uid = '$UID'"
	);
}

function delete_friend_category($id){
	global $UID;
	$id = (array)$id;
	$ids = implode(',', $id);
	if(empty($ids)) return false;
	
	return $this->DB_master->delete(
		$this->friend_category_table,
		"id IN ($ids) AND uid = '$UID'"
	);
}

/**
* 添加好友
* @param int $fuid 好友ID
* @param int $cid 好友分类ID
* @param string $description 描述
* @return int 	1 => 成功, -1 => 用户不存在, -2 => 好友己存在, -3 => 等待验证, -4 => 验证中, -5 => 用户拒绝, 0 => 失败
**/
function add_friend($fuid, $cid = 0, $description = '', $verified = false){
	return include $this->path .'call/add_friend.call.php';
}

/**
* 审核或拒绝好友
* @param int|array $fuid 要审核或拒绝的好友UID
* @param int $value 审核或拒绝
* @param string $reason 审核或拒绝的理由
* @return bool
**/
function verify_friend($fuid, $value = 1, $reason = ''){
	return include $this->path .'call/verify_friend.call.php';
}

/**
* 删除好友
* @param int|array $fuid 要删除好友的UID
* @return bool
**/
function delete_friend($fuid, $verified = true){
	return include $this->path .'call/delete_friend.call.php';
}

/**
* 删除好友
* @param int|array $fuid 要删除好友的UID
* @param int $cid 要移动的分类ID
* @return bool
**/
function move_friend($fuid, $cid){
	return include $this->path .'call/move_friend.call.php';
}

/**
* 更新分类的好友数
* @param int $id 分类ID
* @param int $count 好友数
* @return bool
**/
function update_friend_category_count($id, $count){
	if(empty($id) || empty($count)) return false;
	
	return $this->DB_master->update(
		$this->friend_category_table,
		array('members' => 'members +'. $count),
		"id = '$id'",
		false
	);
}

/**
* 取得会员信息
* @param int $uid 会员ID
**/
function get_member_info($uid = 0,$username=''){
	$addon_table = $this->addon_table;
	if(empty($addon_table)){
		if($username){
			$member_info = $this->data('read',$username);
			$role_gid = $member_info['role_gid'];
			if(empty($role_gid)) return array();
			$addon_table = $this->core->TABLE_ .'role_group_'. $role_gid .'_data';
		}else{
			return array();
		}
	}
	
	$SQL = "SELECT M.*,M.id as m_id,R.name as r_name,A.*, A.id as a_id,C.*,C.id as c_id,G.name AS g_name
		FROM $this->table AS M
		LEFT JOIN {$this->core->TABLE_}role AS R ON M.role_id=R.id 
		LEFT JOIN {$this->core->TABLE_}role_group AS G ON M.role_gid=G.id
		LEFT JOIN {$addon_table} AS A ON M.id = A.id
		LEFT JOIN {$this->core->TABLE_}credit_member AS C ON M.id = C.id 
		WHERE M.id = '$uid'";
	
	$query = $this->DB_slave->fetch_one($SQL);
	$mess = $this->DB_slave->fetch_one("SELECT COUNT(*) AS `count` FROM {$this->core->TABLE_}message WHERE sendee_uid = '$uid' AND `new` = '1'");
	if($query){
		$this->role_id = $query['role_id'];
		$this->role_name = $query['name'];
		$this->real_name = $query['name'];
		$this->role_gid = $query['role_gid'];
		$this->address = $query['address'];
		$this->phone = $query['phone'];
		$this->cell_phone = $query['cell_phone'];
		$this->gender = $query['gender'];
		$this->qq = $query['qq'];
		$this->last_login_ip = $query['last_login_ip'];
		$this->last_login = $query['last_login'];
		$this->register_time = $query['register_time'];
		$this->login_time = $query['login_time'];
		$this->credit_1 = $query['credit_1'];
		$this->credit_2 = $query['credit_2'];
		$this->email = $query['email'];
		$this->birthday = $query['birthday'];
		$this->icon = attachment_url($query['icon']);
		$this->r_name = $query['r_name'];
		$this->g_name = $query['g_name'];
		$this->username = $query['username'];
		$this->new_messages = $mess['count'];
		//unset($query);
	}
	return $query;
}

function data($act, $data){
	
	if($act == 'read'){
		if($this->core->CACHE->memcache){
			$ret = $this->core->CACHE->memcache_read('member_'. $data);
			if(!$ret && $ret = $this->DB_master->fetch_one("SELECT * FROM $this->table WHERE username = '$data'")){
				$this->core->CACHE->memcache_write('member_'. $data, $ret);
			}
		}else{
			$ret = $this->DB_master->fetch_one("SELECT * FROM $this->table WHERE username = '$data'");
		}
		return $ret;
	}else if($act == 'write' && $this->core->CACHE->memcache){
		$this->core->CACHE->memcache_write('member_'. $data['id'], $d);
	}else if($act == 'delete' && $this->core->CACHE->memcache){
		$this->core->CACHE->memcache_delete('member_'. $data);
	}
}

function label(&$LABEL, &$label, &$var){
	
	$select = select();
	$select->from($this->table .' AS m', '*');
	
	$count = $page = 0;
	
	$list = $core->list_item(
		$select,
		array(
			'page' => &$page,
			'page_size' => $page_size,
			'count' => &$count,
		)
	);
	
	$this->core->get_cache('role');
	
	foreach($list as $k => $v){
		$list[$k]['url'] = homepage_url($v['username']);
		$list[$k]['role'] = $core->roles[$v['role_id']]['name'];
	}
	
	global $SKIN, $TEMPLATE, $RESOURCE;
	$this_system = &$this->system;
	$this_module = &$this;
	$SYSTEM = $this->system->name;
	$MODULE = $this->name;
	$core = &$this->core;
	
	if(!empty($label['option']['tplcode']) && strlen($label['option']['tplcode']) > 10){
		//即时编译的模板
		$tplcode = $LABEL->compile_template($label['option']['tplcode']);
		ob_start();
		eval($tplcode);
		$content = ob_get_clean();
	}else{
		//变量中指定了模板
		$template = empty($var['#template#']) ? $label['option']['template'] : $var['#template#'];
		
		//用数据包含模板取得标签内容
		ob_start();
		include $LABEL->template($template);
		$content = ob_get_clean();
	}
	
	return isset($pages) ? array($content, $pages) : array($content);
	
}




/**
* 个人主页相关函数
**/
function homepage_profile(&$block){
	
	global $core, $SKIN, $RESOURCE, $USER;
	
	ob_start();
	include template($this, 'block/profile');
	return ob_get_clean();
}

function homepage_view(&$block){
	global $core, $SKIN, $RESOURCE, $USER;
	
	$select = select();
	$select->from($core->TABLE_ .'homepage_view AS v', 'v.uid');
	$select->inner_join($this->table .' AS m', 'm.id, m.username, m.icon, m.role_id', 'v.view_uid = m.id');
	$select->in('v.uid', $USER['id']);
	
	$page = $count = 0;
	$page_size = $block['item_count'];
	$list = $core->list_item(
		$select,
		array(
			'page' => &$page,
			'page_size' => $page_size,
			'count' => &$count
		)
	);
	
	foreach($list as $k => $v){
		$list[$k]['url'] = homepage_url($v['username']);
	}
	
	ob_start();
	include template($this, 'block/view');
	return ob_get_clean();
}

function homepage_friend(&$block){
	global $core, $SKIN, $RESOURCE, $USER;
	
	$select = select();
	$select->from($this->friend_table .' AS f', 'f.uid');
	$select->inner_join($this->table .' AS m', 'm.id, m.username, m.icon, m.role_id', 'f.fuid = m.id');
	$select->in('f.uid', $USER['id']);
	
	$page = $count = 0;
	$page_size = $block['item_count'];
	$list = $core->list_item(
		$select,
		array(
			'page' => &$page,
			'page_size' => $page_size,
			'count' => &$count
		)
	);
	
	foreach($list as $k => $v){
		$list[$k]['url'] = homepage_url($v['username']);
	}
	
	ob_start();
	include template($this, 'block/friend');
	return ob_get_clean();
}

function homepage_diy(&$block){
	global $core, $SKIN, $RESOURCE, $USER;
	
	ob_start();
	include template($this, 'block/diy');
	return ob_get_clean();
}



/**
* 设置访问控制,基于系统/模块,角色,多对多的映射关系
* @param string $system 要设置权限的系统
* @param string $module 要设置权限的模块
* @param int $role_id 角色ID
* @param array $acl 访问控制列表
* @param array $info #.php中的信息
* @parma string $postfix 后缀
* @return boolean
**/
function set_acl($system, $module, $user_id, $acl, $info, $postfix = ''){
    if(!$system)return false;
	$acl_db = $this->DB_master->fetch_one("SELECT v FROM $this->acl_table WHERE system = '$system' AND module = '$module' AND user_id = '$user_id'");
	
	//从数据库里面取出来的
	$acl_db = $acl_db ? mb_unserialize($acl_db['v']) : array();
	
	//如果ACTION权限都不为空, 为空就不写ACTION权限
	if(!empty($acl['admin_actions'])){
		foreach($info['admin_actions'] as $k => $v){
			$acl_db['admin_actions'][$k] = empty($acl['admin_actions'][$k]) ? false : true;
		}
		if(empty($info['admin_actions'])) $acl_db['admin_actions'] = array();
	}
	
	if(!empty($acl['actions'])){
		foreach($info['actions'] as $k => $v){
			$acl_db['actions'][$k] = empty($acl['actions'][$k]) ? false : true;
		}
		if(empty($info['actions'])) $acl_db['actions'] = array();
	}
	unset($acl['admin_actions'], $acl['actions']);
	//处理完动作
	
	if(!empty($acl)){
		//处理其他细节权限设置
		foreach($acl as $k => $v){
			$acl_db[$k] = $v;
		}
	}
	
	//replace into
	$status = $this->DB_master->insert(
		$this->acl_table,
		array(
			'system' => $system,
			'module' => $module,
			'postfix' => $postfix,
			'user_id' => $user_id,
			'v' => $this->DB_master->escape_string(serialize($acl_db))
		),
		array(
			'replace' => true,
            'unique' => array('system' ,'module' ,'postfix' ,'user_id'),
		)
	);
	
	$path = empty($module) ? $system : $system .'/modules/'. $module;
	
	global $CACHE;
	$CACHE->write($path, 'acl', 'user_'. $user_id .($postfix ? '#'. $postfix : ''). $this->last_cache, $acl_db);
	
	return $status;
}

/**
* 按角色ID删除权限
* @param int|array $user_id 角色ID
**/
function delete_acl_by_user($user_id){
	$uids = $comma = '';
	foreach((array) $role as $v){
		$uids .= $comma . $v;
	}
	
	if(empty($uids)) return false;
	
	$query = $this->DB_master->query("SELECT * FROM $this->acl_table WHERE user_id IN ($uids)");
	
	global $CACHE;
	while($arr = $this->DB_master->fetch_array($query)){
		$key = $arr['system'];
		$key = $arr['module'] ? $key .'/modules/'. $arr['module'] : $key;
		
		$arr['postfix'] = $arr['postfix'] ? '#'. $arr['postfix'] : '';
		//删除缓存
		$CACHE->delete($key, 'acl', 'role_'. $arr['user_id'] . $arr['postfix']);
	}
	
	$this->DB_master->delete($this->acl_table, "user_id IN ($uids)");
	
	return true;
}


/**
* 获得访问控制列表
* @param object $obj 要设置权限的对象
* @param int $user_id 角色ID
* @return array 访问控制列表
**/
function get_acl(&$obj, $user_id, $postfix = ''){
	
	switch($obj->type){
	
	case 'core':
	case 'system':
		$system = $obj->name;
		$module = '';
	break;
	
	case 'module':
		$system = $obj->system->name;
		$module = $obj->name;
	break;
	
	}
	
	//能传入postfix*,查询条件将以postfix%后向模糊查找
	if(strpos($postfix, '*') !== false){
		$postfix = str_replace('*', '', $postfix);
		$acl_db = $this->DB_master->fetch_all("SELECT v, postfix FROM $this->acl_table WHERE system = '$system' AND module = '$module' AND user_id = '$user_id' AND postfix LIKE '$postfix%'");
		
		$ret = array();
		foreach($acl_db as $v){
			$ret[$v['postfix']] = mb_unserialize($v['v']);
		}
		
		return $ret;
	}else{
		$acl_db = $this->DB_master->fetch_one("SELECT v FROM $this->acl_table WHERE system = '$system' AND module = '$module' AND user_id = '$user_id' AND postfix = '$postfix'");
		
		return $acl_db ? mb_unserialize($acl_db['v']) : array();
	}
	
}


/**
* 复制一个角色的权限到一个或多个角色
* @param int $src_user_id源会员
* @param int|array $tar_user 目标会员,单个或数组
* @param boolean 是否覆盖目标角色的权限,如果不是,将把源角色和目标角色合并,并保留目标角色的权限,但如果有重复的权限将按源角色的为准
**/
function copy_acl($src_user_id, $tar_user = array(), $cover = true){
	global $CACHE;
	if(empty($tar_user)) return false;
	
	//源角色的权限
	$src_acls = $this->DB_master->fetch_all("SELECT * FROM $this->acl_table WHERE user_id = '$src_user_id'");
	$_src_acls = array();
	foreach($src_acls as $k => $v){
		
		$_src_acls[$v['system']][$v['module']][$v['postfix']] = mb_unserialize($v['v']);
		
		unset($src_acls[$k]['user_id']);
		$src_acls[$k]['v'] = mb_unserialize($v['v']);
	}
	
	$uploader = &$this->core->load_module('uploader');
	
	foreach((array) $tar_user as $user_id){
		if($user_id == $src_user_id) continue; //不能复制源角色的权限
		
		//上传权限
		$config = $this->core->get_config('core', 'uploader');
		$config = $config['role_filters'];
		$config[$user_id] = isset($config[$src_user_id]) ? $config[$src_user_id] : array();
		$uploader->set_config(array('role_filters' => $config));
		
		if($cover){
			
			//覆盖写入
			
			//删除目标角色的所有权限
			$this->delete_acl_by_user($user_id);
			
			foreach($src_acls as $vv){
				//插入权限表
				$this->DB_master->insert(
					$this->acl_table,
					array(
						'system' => $vv['system'],
						'module' => $vv['module'],
						'postfix' => $vv['postfix'],
						'user_id' => $user_id,
						'v' => $this->DB_master->escape_string(serialize($vv['v']))
					),
					array(
						'replace' => true
					)
				);
				$path = empty($vv['module']) ? $vv['system'] : $vv['system'] .'/modules/'. $vv['module'];
				$acl_db = $vv['v'] ? mb_unserialize($vv['v']) : array();
				$CACHE->write($path, 'acl', 'user_'. $user_id .($vv['postfix'] ? '#'. $vv['postfix'] : ''). $this->last_cache, $acl_db);
			}
			
		}else{
			
			//合并权限
			
			//读取目标角色的权限
			$tar_acls = $this->DB_master->fetch_all("SELECT * FROM $this->acl_table WHERE user_id = '$user_id'");
			$_tar_acls = array();
			foreach($tar_acls as $k => $v){
				$_tar_acls[$v['system']][$v['module']][$v['postfix']] = mb_unserialize($v['v']);
				
				
			}
			
			//$_tar_acls = array_merge($_src_acls, $_tar_acls);
			$_acls = $_src_acls;
			foreach($_tar_acls as $system => $v){
				foreach($v as $module => $vv){
					foreach($vv as $postfix => $vvv){
						$_acls[$system][$module][$postfix] = array_merge($_acls[$system][$module][$postfix], $vvv);
						
					}
				}
			}
			//print_r($_tar_acls);
			
			//删除目标角色的所有权限
			$this->delete_acl_by_user($user_id);
			
			foreach($_tar_acls as $system => $v){
				foreach($v as $module => $vv){
					foreach($vv as $postfix => $vvv){
						
						$this->DB_master->insert(
							$this->acl_table,
							array(
								'system' => $system,
								'module' => $module,
								'postfix' => $postfix,
								'user_id' => $user_id,
								'v' => $this->DB_master->escape_string(serialize($vvv))
							),
							array(
								'replace' => true
							)
						);
						
					}
				}
			}
			
		}		
		//菜单的权限
		$this->set_menu_privilege($user_id);
	}
	
	//$this->cache_acl();
	return true;
}

/**
* 分卷生成权限表的缓存
**/
function cache_acl_step($n, $tn, $on){
	global $CACHE;
	$query = $this->DB_master->fetch_all("SELECT * FROM $this->acl_table LIMIT $n,100");
	if(!$query) return false;
	foreach($query as $key=>$arr){
		
		$path = $arr['module'] ? $arr['system'] .'/modules/'. $arr['module'] : $arr['system'];
		$filepre = 'user_'. $arr['user_id'];
		//有后缀的
		$fielname = $arr['postfix'] ? $filepre .'#'. $arr['postfix'] : $filepre;
		$data = mb_unserialize($arr['v']);
		$CACHE->write($path, 'acl', $fielname . $tn, $data);
		//删除上次缓存的
		$CACHE->delete($path, 'acl', $fielname . $on);
	}	
		return true;	
}

/**
* 生成权限表的缓存
**/
function cache_acl(){
	$query = $this->DB_master->query("SELECT * FROM $this->acl_table");
	$acls = array();
	while($arr = $this->DB_master->fetch_array($query)){
		$acls[$arr['system']][$arr['module']][$arr['user_id']][$arr['postfix']] = mb_unserialize($arr['v']);
	}
	
	$last_cache = '@'. $this->core->CONFIG['last_user_acl_cache'];
	//设置上次权限更新缓存时间
	if(!defined('P8_CLUSTER')){
		$this->core->set_config(array(
			'last_user_acl_cache' => P8_TIME
		));
		$this->last_cache = '@'. P8_TIME;
	}
	
	//文件将被写到各系统/模块缓存目录中的acl目录里
	global $CACHE;
	foreach($acls as $system => $v){
		//系统
		$vkey = $system;
		foreach($v as $module => $vv){
			//系统 or 模块权限
			$vvkey = $module ? $vkey .'/modules/'. $module : $vkey;
			
			foreach($vv as $user_id => $vvv){
				//角色ID
				$vvvkey = 'user_'. $user_id;
				foreach($vvv as $postfix => $vvvv){
					//有后缀的
					$vvvvkey = $postfix ? $vvvkey .'#'. $postfix : $vvvkey;
					
					$CACHE->write($vvkey, 'acl', $vvvvkey . $this->last_cache, $vvvv);
					
					//删除上次缓存的
					$CACHE->delete($vvkey, 'acl', $vvvvkey . $last_cache);
				}
			}
		}
	}
}

/**
* 根据权限设置菜单的显示
* @param int $user_id 会员ID
**/
function set_menu_privilege($user_id){
	global $admin_menu, $member_menu;
	
	static $admin_menus = array(), $member_menus = array();
	if(empty($admin_menus)){
		$query = $this->DB_master->query("SELECT * FROM {$this->core->TABLE_}admin_menu");
		while($v = $this->DB_master->fetch_array($query)){
			if(($pos = strpos($v['action'], '?')) !== false) $v['action'] = substr($v['action'], 0, $pos);
			
			$admin_menus[$v['system'] .'-'. $v['module'] .'-'. $v['action']][] = $v;
		}
		
		$query = $this->DB_master->query("SELECT * FROM {$this->core->TABLE_}member_menu");
		while($v = $this->DB_master->fetch_array($query)){
			if(($pos = strpos($v['action'], '?')) !== false) $v['action'] = substr($v['action'], 0, $pos);
			
			$member_menus[$v['system'] .'-'. $v['module'] .'-'. $v['action']][] = $v;
		}
	}
	
	$query = $this->DB_master->query("SELECT * FROM $this->acl_table WHERE user_id = '$user_id' AND postfix = ''");
	
	//被禁止的菜单
	$admin_menu_denied = array();
	$member_menu_denied = array();
	
	while($v = $this->DB_master->fetch_array($query)){
		$acl = mb_unserialize($v['v']);
		
		if(!empty($acl['admin_actions'])){
			foreach($acl['admin_actions'] as $action => $priv){
				if(
					!$priv && !empty($admin_menus[$v['system'] .'-'. $v['module'] .'-'. $action])
				){
					foreach($admin_menus[$v['system'] .'-'. $v['module'] .'-'. $action] as $vv){
						$admin_menu_denied[$vv['id']] = 1;
					}
				}
			}
		}
		
		if(!empty($acl['actions'])){
			foreach($acl['actions'] as $action => $priv){
				if(
					!$priv && !empty($member_menus[$v['system'] .'-'. $v['module'] .'-'. $action])
				){
					foreach($member_menus[$v['system'] .'-'. $v['module'] .'-'. $action] as $vv){
						$member_menu_denied[$vv['id']] = 1;
					}
				}
			}
		}
	}
	
	global $CACHE;
	$CACHE->write('', 'core', 'admin_menu_user_'. $user_id, jsonencode($admin_menu_denied));
	$CACHE->write('core/modules', 'member', 'menu_json_user_'. $user_id, jsonencode($member_menu_denied));
}

// $string： 明文 或 密文  
// $operation：DECODE表示解密,其它表示加密  
// $key： 密匙  
// $expiry：密文有效期
function authcode($string,$rsa = false) {
    if(!$rsa){
		$key = md5('php168');   
		$keya = md5(substr($key, 0, 16));  
		$keyb = md5(substr($key, 16, 16));  
		$keyc = substr($string, 0, 4);
		$cryptkey = $keya.md5($keya.$keyc);  
		$key_length = strlen($cryptkey);  
		$string = base64_decode(substr($string, 4));
		$string_length = strlen($string);  
		$result = '';  
		$box = range(0, 255);  
		$rndkey = array();  
		for($i = 0; $i <= 255; $i++) {  
			$rndkey[$i] = ord($cryptkey[$i % $key_length]);  
		}
		for($j = $i = 0; $i < 256; $i++) {  
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;  
			$tmp = $box[$i];  
			$box[$i] = $box[$j];  
			$box[$j] = $tmp;  
		}  
		for($a = $j = $i = 0; $i < $string_length; $i++) {  
			$a = ($a + 1) % 256;  
			$j = ($j + $box[$a]) % 256;  
			$tmp = $box[$a];  
			$box[$a] = $box[$j];  
			$box[$j] = $tmp;  
			$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));  
		}
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {  
			return substr($result, 26);  
		} else {  
			return '';  
		}
	}else{
	//https://www.btool.cn/rsa-key-pair-generator
	$privateKey = "-----BEGIN RSA PRIVATE KEY-----
MIIEowIBAAKCAQEAtc/NZLtYG41WizaYFo34pDG4cpemlTOgqK1LfQBtsQk55sk0
URQSD05UY1X+VS1cc5xNGWHGj71Y1hViqE2OvZC1n4i+zS+0dD4UkXkkzaBkd2S+
SCbgWYpUjZYe3vn55YSPh7Jpn7zAgBrxtnkUnb2XTSrEpvhlWXwPVSpfIsuXkX1X
chS6kqzLYaGvNv6FyqIJPK0ttyvzDh9Nn2PF1zLIivSuTDqwgvJg6crSQ5vxF2iX
MIUcNM+lju+ccFLKCs1uo/1+X6/OSLrys4HHb4wBeXjFroshd7+3TYWIm5l1PDiY
ghS7jTncke1Dzh9z+g6k01EvSJWTx1KigJKiywIDAQABAoIBAFL5G/5ttV8VmLp9
1tjsP94HRusdJIwQ/LAeLkZE7MqPsFoP1w1tgHR1xfNzqleLFRc57MG5qpmsyx8g
sV6nzo3avdip2pHfxJYMQuzFAbPKEC+gzWo2O8sBY2cebMZMBOznG23NUYDx7lRI
d6lUBsGaZbN04jxlPjOhd4nhhXtl8snZ6qmrhcBBilJ3GTJ5Ux7zbzbtL6GFMOZ6
YGCth11AW2dXL/Okjnnmmbaicr6/43sMiPGIr6WwzhCJxL9hpB5Q7f4pmwFSwVM3
c8uHQTuE3w0X9RQUV+uzUbGo0N9gbo/TFWFIs9FM9DfXrUk7BSCAX9wCr4NpCcqj
D6OVPwECgYEA7kCbI3890BqtCiu4AZZ5PHoC20akzrA+8gnGs+6PfzrVzhkwFi68
VfMKzBU4ZVR5D++AXB/rYuf46V5bPIWxi172fsoobrfZJEOeYX5z7Spsb5B+sPCS
go0A9VuNdxTEw4WToA8uN5OM8FLxKgPCaU/Eq3+2f6ziF2EcmnRIfEsCgYEAw1rk
Vp4GG7ZXq75r4ph6n/4YzBLoiM636mXIYtEORfQfwbC3bXCkjYmR8LrBeQSmHgNV
SOeWZrmzXJRZIiJdW1QA8XwlSTet97rlVX9s59jUiMcQm4z5Ye59+ApF5vN63Wo/
RpeRWYM5r0EVK3mLQA/q8g5y8wDXc0uB330RY4ECgYEA4Gin98Jk1Xwa2sadFZnG
7ci6ohEjMK9fSpkcuOQN8zfWpL6ixXIV4RsAY4PlT8RGF1VuYNeL3ehDUoSWiSYg
OfcjU/9UIB05AOhT6N6zkILyCg9e1YhzZ1YqvfATCkPcpZFOoGdMD/sBuGdXUkyi
NJF23FZ57j5H4t+MkorOr4sCgYB7te1vpLa9ieVPD1GGt4TAGMtfQIIdULtLJpWV
bkoZppUNtXkTRwgN0Zan2bx3hKglzXqOpomqF+Mrt44SfaydDz9hrXp3OVljzek5
EW7IC5nb3CP6PXYXvE3ta6QEsx+VY5kafRVAmEdJYm+jjl7OfMYN73R/yoKlsqVV
//+pAQKBgHTt+p6gASfv1ROEDCHxcWkU7Z3XX53Ka9mXZZmPrYioOo2JnUuhdlf/
RmXvjooINIGsEQky2jk0nD820h5oitDvVbLdAbl9pKHDRyprK6Z6C3yGbmRDyrBM
BUgTtXPesXSUTxIz9Le0Q91nbkV2eEE8xC/gYhyzSePv9KTs7GyV
-----END RSA PRIVATE KEY-----";
		$decryptedData = '';
		openssl_private_decrypt(base64_decode($string), $decryptedData, $privateKey);
		return $decryptedData;
	}
  
}
/**
* 检测密码强度
* @param string $pw 密码
* @return int
*/
function checkpwlevel($pw){
	if(empty($pw)){
		return 0;
	}
	$pattern['weak'] = '/((^[0-9]{8,})|(^[a-z]{8,})|(^[A-Z]{8,}))$/';
	$pattern['middle'] = '/((^[0-9,a-z]{8,})|(^[0-9,A-Z]{8,})|(^[a-z,A-Z]{8,}))$/';
	$pattern['strong'] = '/^[\x21-\x7e,A-Za-z0-9]{8,}/';
	$key ='';
	foreach($pattern as $k=>$v){
		$res = preg_match($v,$pw);
		if($res){
			$key = $k;
			break;
		}
	}
	switch ($key){
		case 'weak':
			return 3;
		case 'middle':
			return 2;
		case 'strong':
			return 1;
		default:
			return 0;
	}
}

function add_dept($data){
	
	$data['parent'] = isset($data['parent']) ? intval($data['parent']) : 0;
	$data['name'] = isset($data['name']) ? html_entities($data['name']) : '';
	$data['display_order'] = isset($data['display_order']) ? intval($data['display_order']) : 0;
	$data['item_count'] = $data['item_count_sites'] = 0;
	
	global $core;
	return $this->DB_master->insert(
		$this->dept_table,
		$data,
		array('return_id' => true)
	);
}

function update_dept($id, $data){
	$data['parent'] = isset($data['parent']) ? intval($data['parent']) : 0;
	$data['name'] = isset($data['name']) ? html_entities($data['name']) : '';
	$data['display_order'] = isset($data['display_order']) ? intval($data['display_order']) : 0;
	$data['item_count'] = isset($data['item_count']) ? intval($data['item_count']) : 0;
	$data['item_count_sites'] = isset($data['item_count_sites']) ? intval($data['item_count_sites']) : 0;
	$cids = $this->get_children_ids($id);
	array_push($cids, $id);
	//不能把父分类移动到子分类或者本身下面
	if(in_array($data['parent'], $cids)) return false;
	
	global $core;
	return $this->DB_master->update(
		$this->dept_table,
		$data,
		"id = '$id'"
	);
}

function view_dept($id){
	global $core;
	
	return $this->DB_master->fetch_one("SELECT * FROM $this->dept_table WHERE id = '$id'");
}

function cache_dept($write = true){
	global $core, $CACHE;
	
	$query = $this->DB_master->query("SELECT * FROM $this->dept_table ORDER BY display_order DESC");
	$this->depts = array();
	$this->province = array();
	$_json_dept = $_province = array();
	
	while($arr = $this->DB_master->fetch_array($query)){
		if($write){
			$this->depts[$arr['id']] = array(
				'id' => $arr['id'],
				'parent' => $arr['parent'],
				'name' => $arr['name']
			);
			
			$_json_dept[$arr['id']] = array(
				'id' => $arr['id'],
				'parent' => $arr['parent'],
				'name' => $arr['name']
			);
		}else{
			$this->depts[$arr['id']] = $arr;
		}
	}
	
	foreach($this->depts as $id => $v){
		if($v['parent']){
			$this->depts[$v['parent']]['depts'][$v['id']] = &$this->depts[$v['id']];
			
			$_json_dept[$v['parent']]['depts'][$v['id']] = &$_json_dept[$v['id']];
		}else{
			$this->province[$v['id']] = &$this->depts[$v['id']];
			
			$_province[$v['id']] = &$_json_dept[$v['id']];
		}
	}
	
	if($write){
		$path = array();
		foreach($this->depts as $v){
			$parents = $this->get_parents($v['id']);
			$tmp = array();
			foreach($parents as $vv){
				$tmp[] = $vv['id'];
			}
			$tmp[] = $v['id'];
			
			$path[$v['id']] = $tmp;			
		}
		
		$this->_data = array(
			'province' => &$this->province,
			'depts' => &$this->depts
		);
		
		$_province = p8_json($_province);
		$path = p8_json($path);
		
		$CACHE->write('core/modules', 'member', 'dept', $this->_data, 'serialize');
		$CACHE->write('core/modules', 'member', 'dept_json', array('json' => $_province, 'path' => $path));
	}
}

function get_json(){
	global $CACHE;
	return $CACHE->read('core/modules', 'member', 'dept_json');
}

function get_cache(){
	global $CACHE;
	
	$this->_data = $CACHE->read('core/modules', 'member', 'dept', 'serialize');
	
	$this->depts = &$this->_data['depts'];
	$this->province = &$this->_data['province'];
}

/**
* 更新分类的条目数
* @param int $id 分类的ID
* @param int $num 条数
**/
function update_count($sys,$id, $num,$score){
	$this->get_cache();	
	if(empty($id) || empty($num) || !($cat = $this->view_dept($id))) return false;	
	$ids = $id;
	//如果有父分类同时更新父分类
	if($parents = $this->get_parents($id)){
		$ids = '';
		foreach($parents as $v){			
			if($v['id']) $ids .= ',' . $v['id'];			
		}
		$ids = $id . $ids;
	}
	$data = $sys == 'cms' ? array('item_count' => 'item_count + '. $num,'item_score' => 'item_score + '. $score) : array('item_count_sites' => 'item_count_sites + '. $num,'item_score_sites' => 'item_score_sites + '. $score);
	
	return $this->DB_master->update(
		$this->dept_table,
		$data,
		"id IN ($ids)",
		false
	);
}

function get_parents($id){
	if(empty($this->depts[$id]['parent'])) return array();	
	$p = $this->depts[$id]['parent'];
	$ps = array();
	while($p){
		array_unshift($ps, $this->depts[$p]);
		unset($ps[0]['depts']);
		$p = $this->depts[$p]['parent'];
	}
	return $ps;
}

function get_children_ids($id){
	$this->get_cache();
	if(empty($this->depts[$id]['depts'])) return array();	
	$ids = array();
	foreach($this->depts[$id]['depts'] as $v){
		$ids[$v['id']] = $v['id'];
		if(isset($v['depts']))
			$ids = $ids + $this->get_children_ids($v['id']);
	}	
	return $ids;
}

function delete_dept($id){	
	$cids = $this->get_children_ids($id);
	array_unshift($cids, $id);
	
	$ids = implode(',', $cids);
	
	return $this->DB_master->delete($this->dept_table, "id IN ($ids)") ? $cids : array();
}


}
