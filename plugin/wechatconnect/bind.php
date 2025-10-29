<?php
/**
 *
 * Power by 910app.com
 * User: bingbin
 * Date: 2023/10/26
 * Time: 9:43
 */

defined('PHP168_PATH') or die();
load_language($this_plugin, 'global');

if(REQUEST_METHOD == 'GET'){
    $openid = $_P8SESSION['wxconnect_openid'];
    if(!$openid){
        message('fail', $this_plugin->core->url);
    }elseif($UID && $openid){
		$ud = $this_plugin->getUserInfo($openid);
		if(!$ud['uid']){
			 $this_plugin->bindUser($openid,$UID,$USERNAME);
            $_P8SESSION['wxconnect_openid'] = null;
            unset($_P8SESSION['wxconnect_openid']);
            message('绑定成功',$this_plugin->tourl);
		}else {
            message('已经绑定',$this_plugin->tourl);
        }

    }elseif($openid){
        $forward = urlencode($this_url.'?b=1');
        $this_plugin->core->get_cache('role_group');
        $groups = $this_plugin->core->role_groups;
        include $this_plugin->template('bind');
    }else{
        message('done', $this_plugin->tourl);
    }
}elseif(REQUEST_METHOD == 'POST'){
    if(isset($_POST['id']) && $UID){
        if($this_plugin->unbind(intval($_POST['id']))){
            exit('{"code":0,"msg":"ok"}');
        }else{
            exit('{"code":1,"msg":"fail"}');
        }
    }
    if(
        !empty($this_plus->core->CONFIG['admin_login_with_captcha']) &&
        !captcha(isset($_POST['captcha']) ? $_POST['captcha'] : '')
    ) {
        exit('{"error":1001,"msg":"验证码错误"}');
    }

    if(!$_P8SESSION['wxconnect_openid']){
        exit('{"error":1005,"msg":"未扫码微信"}');
    }
    $openId = $_P8SESSION['wxconnect_openid'];

    $username = isset($_POST['username'])? html_entities($_POST['username']) : '';
    $password = isset($_POST['password'])? html_entities($_POST['password']) : '';
    if(!$username || !$password)
        exit('{"error":1002,"msg":"账号与密码是必须的"}');

    $data = get_member($username);

    //用户不存在
    if(empty($data)){
        exit('{"error":1003,"msg":"用户不存在"}');
    }elseif($data['status']!=0){
        exit('{"error":1004,"msg":"用户被锁定"}');
    }

    $member = $this_plugin->core->load_module('member');
    $stat = $member->login($username,$password);

    if($stat['status']!=0){
        exit('{"error":1006,"msg":"'.$stat['message'].'"}');
    }

    $this_plugin->bindUser($openId,$stat['id'],$username);
    $_P8SESSION['wxconnect_openid'] = null;
    unset($_P8SESSION['wxconnect_openid']);
     exit('{"error":0,"msg":"绑定成功"}');


}