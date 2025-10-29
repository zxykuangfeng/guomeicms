<?php
defined('PHP168_PATH') or die();

/**
* 管理员登录
**/

if(!$this_controller->check_admin_action($ACTION)){
	
	//message('你的角色不允许登录后台', $core->U_controller .'/core/member-login?forward='. urlencode($this_router));
}
if(REQUEST_METHOD == 'GET'){
	
	include template($core, 'login', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	$member = &$core->load_module('member');
	$_POST['username'] = $username = isset($_POST['username']) ? $member->authcode(html_entities($_POST['username']),true) : '';
	$admin_login_false = isset($member->CONFIG['admin_login_false']) ? $member->CONFIG['admin_login_false'] : $core->CONFIG['admin_login_false'];
	$admin_login_false_lock = isset($member->CONFIG['admin_login_false_lock']) ? $member->CONFIG['admin_login_false_lock'] : $core->CONFIG['admin_login_false_lock'];
    if(!empty($admin_login_false)){
        $alfData = $core->CACHE->read('', 'core', 'admin_login_false');

        if(isset($alfData[$username]) 
            && $alfData[$username]['count']>= intval($admin_login_false) 
            && $alfData[$username]['last']> P8_TIME - intval($admin_login_false_lock)*60){
                
            message(p8lang($P8LANG['admin_login_false'],$admin_login_false,$admin_login_false_lock)); 
        }
    }
    if(!empty($core->CONFIG['admin_login_with_mobile_captcha'])){
		$member_sms = $core->load_module('member');
		$sql = "select id,username,status,cell_phone from $member_sms->table where username='$username'";
		$member_info = $core->DB_master->fetch_one($sql);
		$sms_status = $core->load_module('sms')->check_sms($_POST['checkcode'],$member_info['cell_phone']);
		$sms_status or message('手机验证码错误或失效！');
	}
	 if(
		!empty($core->CONFIG['admin_login_with_captcha']) &&
		!captcha(isset($_POST['captcha']) ? $_POST['captcha'] : '')
	){
		if(P8_AJAX_REQUEST){
			//如果是AJAX请求
			// 检查REQUEST_URI是否包含/cms/item-或/sites/item-
			if (strpos(REQUEST_URI, '/cms/item-') !== false || strpos(REQUEST_URI, '/sites/item-') !== false) {				
				exit($P8LANG['user_offline']);
			} else {
				exit('captcha_incorrect');
			}			 
		}else{
			message($P8LANG['captcha_incorrect'],$core->admin_controller);
		}
	}	
	if (P8_AJAX_REQUEST && (strpos(REQUEST_URI, '/cms/item-') !== false || strpos(REQUEST_URI, '/sites/item-') !== false)) {
		exit($P8LANG['user_offline']);
	}
	if(
		!empty($core->CONFIG['admin_login_code']) &&
		(isset($_POST['code']) ? $_POST['code'] : '') != $core->CONFIG['admin_login_code']
	) message('admin_login_code_incorrect');
	
	if(isset($_POST['password'])){		
		/*if(empty($member->CONFIG['administrators'][$username])){
			message('no_such_user', HTTP_REFERER);
		}*/
		$_POST['password'] = $member->authcode($_POST['password'],true);
		$_POST['password'] or message('password_decode_error'); 
		require_once PHP168_PATH .'inc/safepost.php';
		//强制不使用单点登录API登录
		$data = $member->login($username, $_POST['password'],0,false,'username','admin');

		switch($data['status']){
			case 0:
				$_P8SESSION['#admin_login#'] = 1;
				//设置SESSION即算登录后台
				admin_login_false($username);
				//密码强度检测
				$pwlevel = 1;
				$member_config = $core->get_config('core', 'member');				
				
				if(isset($member_config['checkpwlevel']) && !empty($member_config['checkpwlevel'])){
					$pwlevel = $member->checkpwlevel($_POST['password']);					
				}
				if($pwlevel != 1) {
                    message($P8LANG['login_success_pw_level'],
                        $core->U_controller . '?main_page=/member-profile?editpw=1', 3);
                }elseif($member_config['admin_change_password_day']>0 && in_array($data['role_id'],(array)$member_config['admin_change_password_role']) &&  $data['last_change_password'] < (P8_TIME - $member_config['admin_change_password_day'] * 86400)){//强制要求改密码
                        message($P8LANG['login_success'] . $data['message'] . $P8LANG['admin_change_password'],
                            $core->U_controller . '?main_page=/member-profile?editpw=1', 3);
                }else{
                    message($P8LANG['login_success'].$data['message'], empty($_POST['forward']) ? $core->admin_controller : $_POST['forward'], 0);
                }
			break;
			
			case -1:
                admin_login_false($username,false);
				message('no_such_user', HTTP_REFERER);
			break;
			
			case -2:
                admin_login_false($username,false);
				message('wrong_password', HTTP_REFERER);
			break;
						
			case 2:
                admin_login_false($username,false);
				message('user_locking', HTTP_REFERER);
			break;
		}
	}
	
}

function admin_login_false($username, $success=true){
    global $core;
	$config_login = $core->get_config('core', '');
    $count = isset($config_login['admin_login_false']) ? intval($config_login['admin_login_false']) : 0;	
    if(!$count)return;
    
    $data = $core->CACHE->read('', 'core', 'admin_login_false');
    $data = $data ? (is_array($data) ? $data : array()) : array();
    
    foreach($data as $name=>$row){
        if($row['last']<P8_TIME - $count*60){
            unset($data[$name]);
        }
    }
    
    if($success){
        if(empty($data[$username]))return;
        unset($data[$username]);
        
    }
    $adminlog = array();
    if(!$success){
        
        if(empty($data[$username])){
            $adminlog = array(
                'begin' => P8_TIME,
                'last' => P8_TIME,
                'count' => 1
            );
        }else{
            $adminlog = $data[$username];
            $adminlog['last'] = P8_TIME;
            $adminlog['count'] += 1;
        }
        
    }
    if($adminlog)$data[$username] = $adminlog;
    $core->CACHE->write('', 'core', 'admin_login_false',$data);
}
