<?php
/**
 *
 * Power by 910app.com
 * User: bingbin
 * Date: 2023/10/24
 * Time: 16:40
 */

if(!isset($_GET['qp'])){
    echo '<script type="text/javascript">if (window != top) {top.location.href = location.href+"&qp=1";} </script>';
    exit;
}

defined('PHP168_PATH') or die();
load_language($this_plugin, 'global');

if(!$this_plugin->checkState($_GET['state']))exit('access deny');
$accessToken = $this_plugin->getOpenAccessToken(xss_clear($_GET['code']));
if(!$accessToken)message('cant no get access token');
if(isset($accessToken['errcode']))message($accessToken['errmsg']);
$plusUserInfo = $this_plugin->getUserInfo($accessToken['openid']);

if(!$plusUserInfo){
    $wxuserinfo = $this_plugin->getOpenUserInfo($accessToken['access_token'],$accessToken['openid']);
    if(!$this_plugin->addUserInfo($wxuserinfo,$wxuserinfo['openid']))message('login fail');
    $plusUserInfo = $this_plugin->getUserInfo($wxuserinfo['openid']);
}else{
    $wxuserinfo = $this_plugin->getOpenUserInfo($accessToken['access_token'],$accessToken['openid']);
    $this_plugin->updateUserInfo($wxuserinfo,$wxuserinfo['openid']);
}

if(!$plusUserInfo['uid']){
    if($this_plugin->config['check_status']){
        $forward=$forward = urlencode($this_router.'-bind?b=1');
        $_P8SESSION['wxconnect_openid'] = $accessToken['openid'];
        include $this_plugin->template('bind');
    }else{
      if($this_plugin->registerUser($plusUserInfo)) {
          $this_plugin->userlogin($plusUserInfo);
          message('登录成功', $this_plugin->tourl);
      }else{
          message('登录失败');
      }
    }
}else {
   $this_plugin->userlogin($plusUserInfo);
    message('登录成功', $this_plugin->tourl);
}
