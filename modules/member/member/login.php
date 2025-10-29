<?php
defined('PHP168_PATH') or die();

/**
* 登录
**/

if(empty($_GET['style']) && ($inte = &$core->integrate()) && !empty($inte->CONFIG['client'])){
	//header('HTTP/1.1 301 Moved Permanently');
    $url = strpos(REQUEST_URI,'login')===false?REQUEST_URI:HTTP_REFERER;
    $url .= (strpos($url,'?')!=false?'&':'?').'_='.time();
	header('Location: '. $inte->CONFIG['api'] . $inte->CONFIG['param'].'url='.urldecode($url));
	exit;
}

if(REQUEST_METHOD == 'GET'){
	//前台登录框
	
	if(isset($_GET['username']) || isset($_GET['password'])){
		exit('attack');
	}
	$style = !empty($_GET['style']) ? xss_clear($_GET['style']) : '';
	$style = in_array($style,array('1','admin','admin_main','banshi','banshi2','com','gov','gov18','interview','jianhua','list','loginbox','loginbox2','opi','opinion','qiyue','sites')) ? $style : '';
	if($style){
		include "loginstyle.php";
		exit;
	}
	if($UID){
		header('Location: '. $core->U_controller);
		exit;
	}
	if(isset($_GET['forward'])){
		$forward = html_entities($_GET['forward']);
	}else if(isset($forward)){

	}else{
		$forward = $this_module->U_controller;
	}

    $forward = $forward ? $forward : $core->U_controller;
    $forward = substr($forward,-13) == 'member-logout' ?  $core->U_controller : $forward;
    $sites_flag = in_array('s.php',explode('/',$HTTP_REFERER)) ? true : false;
    $site_name = !empty($_GET['site']) ? xss_clear(trim($_GET['site'])) : '';
    if(isset($core->systems['sites']) && !empty($core->systems['sites']['enabled'])){
        $site_controller = &$core->load_system('sites');
        $sites_flag2 = $site_controller->check_domain($HTTP_REFERER);
        $site_name = $site_name ? $site_name : (($sites_flag || $sites_flag2) ? $site_controller->SITE : '');
    }
    if($site_name) $forward = $forward . (strpos($forward, '?') ? '&' : '?') . 'site=' . $site_name;
	include template($this_module, 'login');
	
}else if(REQUEST_METHOD == 'POST'){
	if($_POST['mobile'] && $_POST['checkcode']){		
		$username = html_entities($_POST['mobile']);	
	}else{
		$username = isset($_POST['username']) ? $this_module->authcode(html_entities($_POST['username']),true) : '';
	}
	$admin_login_false = isset($this_module->CONFIG['admin_login_false']) ? $this_module->CONFIG['admin_login_false'] : $core->CONFIG['admin_login_false'];
	$admin_login_false_lock = isset($this_module->CONFIG['admin_login_false_lock']) ? $this_module->CONFIG['admin_login_false_lock'] : $core->CONFIG['admin_login_false_lock'];
	if(!empty($admin_login_false)){		
        $alfData = $core->CACHE->read('', 'core', 'admin_login_false');	
        if(isset($alfData[$username]) 
            && $alfData[$username]['count']>= intval($admin_login_false) 
            && $alfData[$username]['last']> P8_TIME - intval($admin_login_false_lock)*60){
			message(p8lang($P8LANG['admin_login_false'],$admin_login_false,$admin_login_false_lock)); 
        }
    }
	
	if(P8_AJAX_REQUEST)$_POST = from_utf8($_POST);
	if(
		!empty($this_module->CONFIG['login_with_captcha']) &&
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
			message($P8LANG['captcha_incorrect']);
		}				
	}
	if(P8_AJAX_REQUEST && (strpos(REQUEST_URI, '/cms/item-') !== false || strpos(REQUEST_URI, '/sites/item-') !== false)) {
		exit($P8LANG['user_offline']);
	}
	$forward = empty($_POST['forward']) ? $core->U_controller : xss_url($_POST['forward']);
	$site_name = empty($_POST['site_name']) ? '' : xss_url($_POST['site_name']);
	$type = isset($_POST['type'])? $_POST['type'] : 'username';
	$data = array();	
	if(isset($_POST['username']) && isset($_POST['password'])){
		$_POST['username'] = $this_module->authcode(p8_addslashes2($_POST['username']),true);
		$_POST['password'] = $this_module->authcode($_POST['password'],true);
		$_POST['password'] or message('password_decode_error');	
		require_once PHP168_PATH .'inc/safepost.php';
		$data = $this_module->login($_POST['username'], $_POST['password'], 0, false, $type);
	}else if(isset($_POST['checkcode']) && isset($_POST['mobile'])){
		require_once PHP168_PATH .'inc/safepost.php';
		$status = $core->load_module('sms')->check_sms($_POST['checkcode'],$_POST['mobile'],$this_module->CONFIG['sms_timeout'] ? intval($this_module->CONFIG['sms_timeout']) : 10);
		$status or message('手机验证码错误或失效！');			
		$data = get_member($username,false,'cell_phone');
		if(empty($data)){
			$this_module->mobile_register($username);
			$data = get_member($username,false,'cell_phone');
		}
		$this_module->_login($data, '');
	}
	switch($data['status']){
		case 0:				
			if(P8_AJAX_REQUEST) exit(p8_json($data));
			admin_login_false($username);
			$uc_url = $site_name ? $core->U_controller.'?site='.$site_name : $core->U_controller.'?site=mainstation';
			//密码强度检测
			$pwlevel = 1;
			$adminChPw=0;
			if(isset($this_module->CONFIG['checkpwlevel']) && !empty($this_module->CONFIG['checkpwlevel'])){
				$pwlevel = $this_module->checkpwlevel($_POST['password']);
			}
			if($this_module->CONFIG['admin_change_password_day']>0 && in_array($data['role_id'],$this_module->CONFIG['admin_change_password_role'])){//强制要求改密码
				if($data['last_change_password']<(P8_TIME-$this_module->CONFIG['admin_change_password_day']*86400))
					$adminChPw=1;
			}

			//1&forward=参数 > 2本角色登录转向URL > 3系统会员登陆转向				
			$turn_url = $forward;				
			$trun_time = 3;				
			//3.1转向指定地址
			if($this_module->CONFIG['login_forward'] == 2 && $this_module->CONFIG['login_turn_url']){
				$turn_url = $this_module->CONFIG['login_turn_url'];
				$trun_time = 0;					
			}
			//3.2转到会员中心
			if($this_module->CONFIG['login_forward'] == 1){
				$turn_url = $uc_url;					
			}
			
			//2.角色转向检测
			$role_module = &$core->load_module('role');
			$role_module->get_cache();
			$this_roles = $role_module->roles[$data['role_id']];
			if($this_roles['forward']){
				$turn_url = xss_url($this_roles['forward']);
				$trun_time = 0;
			}
			//1.&forward=参数
			if($forward != $core->U_controller){
				$turn_url = $forward;
				$trun_time = 0;
			}			
			if($site_name){
				if($pwlevel != 1)
					message($P8LANG['login_success_pw_level'],$core->U_controller.'?main_page=/member-profile?editpw=1',$trun_time);
				elseif($adminChPw)
					message($P8LANG['login_success'].$data['message'].$P8LANG['admin_change_password'], $core->U_controller.'?main_page=/member-profile?editpw=1', $trun_time);
				else
					message(p8lang($P8LANG['login_success'],$uc_url,$forward), $turn_url, 2);
			}else{
				$systems = $core->list_systems();
				if(!isset($systems['sites']) || (isset($systems['sites']) && !$systems['sites']['enabled'])){					
					if($pwlevel != 1)
							message($P8LANG['login_success_pw_level'],$core->U_controller.'?main_page=/member-profile?editpw=1',$trun_time);
						else
							message(p8lang($P8LANG['login_success'],$uc_url,$forward), $turn_url, 2);
				}else{
					$sites_system = $core->load_system('sites');
					$sites_item = $sites_system->load_module('item');
					$manage_sites = $sites_system->get_manage_sites($data['id']);
					$poster_sites = $sites_system->get_poster_site();
					$action_sites = array();
					foreach($all_sites as $keys => $v){
						$acls = $this_module->get_acl($sites_item, $UID, $keys);
						if($acls && $acls['actions']['add']){
							$action_sites[] = $keys;
						}
					}
					$mysites = array_unique(array_merge($manage_sites,$poster_sites,$action_sites));
					if($pwlevel != 1) {
						message($P8LANG['login_success_pw_level'],
							$core->U_controller . '?main_page=/member-profile?editpw=1', $trun_time);
					}elseif($adminChPw){
						message($P8LANG['login_success'].$data['message'].$P8LANG['admin_change_password'], $core->U_controller.'?main_page=/member-profile?editpw=1', $trun_time);
					}else{
						$allsites  = $sites_system->get_sites();
						foreach($mysites as $key=>$site_each){
							if(empty($allsites[$site_each]['status'])) unset($mysites[$key]);
						}
						$uc_url = count($mysites) == 1 ? $core->U_controller.'?site='.$mysites[0] : $core->U_controller.'/member-mysites';							
						message(p8lang($P8LANG['login_success'],$uc_url,$forward), $turn_url, $trun_time);							
					}
				}
			}
		break;
		case 1:
			if(P8_AJAX_REQUEST)exit("['user_no_verify']");
			admin_login_false($username,false);
			message($P8LANG['user_no_verify'] . $data['message'], $forward, 5);
		break;
		case -1:
			if(P8_AJAX_REQUEST)exit("['no_such_username']");
			admin_login_false($username,false);
			message('no_such_username', HTTP_REFERER);
		break;
		
		case -2:
			if(P8_AJAX_REQUEST)exit("['wrong_password']");
			admin_login_false($username,false);
			message('wrong_password', HTTP_REFERER);
		break;
		default:
			message('wrong_password',HTTP_REFERER);
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