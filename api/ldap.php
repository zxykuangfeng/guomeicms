<?php
/**
* LDAP登录Active Directory域
**/

require_once dirname(__FILE__) .'/../inc/init.php';
$this_module = &$core->load_module('member');
define('P8_MEMBER',true);
if(REQUEST_METHOD == 'GET'){
	//前台登录框
	
	if(isset($_GET['username']) || isset($_GET['password'])){
		exit('attack');
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
	include template($this_module, 'login', 'member/default');
	
}else if(REQUEST_METHOD == 'POST'){
	$username = isset($_POST['username']) ? $this_module->authcode(html_entities($_POST['username'])) : '';
	$username or message("ERR:用户不存在，登录失败",$core->url, 3);
	if(!empty($core->CONFIG['admin_login_false'])){		
        $alfData = $core->CACHE->read('', 'core', 'admin_login_false');	
        if(isset($alfData[$username]) 
            && $alfData[$username]['count']>= intval($core->CONFIG['admin_login_false']) 
            && $alfData[$username]['last']> P8_TIME - intval($core->CONFIG['admin_login_false_lock'])*60){
			message(p8lang($P8LANG['admin_login_false'],$core->CONFIG['admin_login_false'],$core->CONFIG['admin_login_false_lock'])); 
        }
    }
	
	if(P8_AJAX_REQUEST)$_POST = from_utf8($_POST);
	if(!empty($this_module->CONFIG['login_with_captcha'])){
		captcha(isset($_POST['captcha']) ? $_POST['captcha'] : '') or message('captcha_incorrect');
	}

	$forward = empty($_POST['forward']) ? $core->U_controller : xss_url($_POST['forward']);
	$site_name = empty($_POST['site_name']) ? '' : xss_url($_POST['site_name']);
	$type = isset($_POST['type'])? $_POST['type'] : 'username';
	if(isset($_POST['username']) && isset($_POST['password'])){
		$_POST['username'] = $this_module->authcode(p8_addslashes2($_POST['username']));
		$_POST['password'] = $this_module->authcode($_POST['password']);
		$_POST['password'] or message('password_decode_error');
		$inte = &$core->integrate();		
		filter_var($inte->CONFIG['adip'], FILTER_VALIDATE_IP) or message('ip server err');
		$host= $inte->CONFIG['adip'];// IP地址
		$port = $inte->CONFIG['port'] ? $inte->CONFIG['port'] : '389';
		
		$conn = ldap_connect($host, $port);
		if($conn){
			//设置参数
			ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);//声明使用版本3
			ldap_set_option($conn, LDAP_OPT_REFERRALS, 0); // Binding to ldap server
			$bd = ldap_bind($conn, $_POST['username'], $_POST['password']);// 用户验证
			if($bd){
				$msg = $inte->login($_POST['username'],'');
				message($P8LANG['login_success'], $core->U_controller, 2);
			} else {
				$err_mes = ldap_error($conn);
				ldap_close($conn);// 关闭
				admin_login_false($_POST['username'],false);				
				message('LDAP 绑定失败:'.$err_mes, $core->U_controller, 2);				
			}
		} else {
			ldap_close($conn);// 关闭
			message('无法连接到AD域服务器', $core->U_controller, 2);
		}
	}else{
		message('error');	
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
/*

$inte = &$core->integrate();
var_dump($core->CONFIG);
$request = p8_stripslashes2($_POST + $_GET);
if(!empty($inte->CONFIG['script']) && file_exists(PHP168_PATH .'inc/integrate/ldap/'.$inte->CONFIG['script'])){
    include PHP168_PATH .'inc/integrate/ldap/'.$inte->CONFIG['script'];
}else{
   echo '<br/>error-没有正确配置LDAP登录Active Directory域';  
}
*/
