<?php
/**
 * 微信公众号助手
 */
$this_controller->check_admin_action($ACTION) or message('no_privilege');

require_once PHP168_PATH .'inc/WxService.class.php';
require_once PHP168_PATH .'inc/weixinPush.class.php';

$config = $core->get_config($this_system->name, $this_module->name);
$id = isset($_GET['id']) ? $_GET['id'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';
$type = !$type ? 'image' : $type;
$wx = new WxService($config['appid'],$config['appsecret']);

$result = $wx->delMaterial($id);
if($result['code']==0){
	message('done');
	exit();
}else{
	message(p8lang($P8LANG['wechat_message_false3'], array($result['errcode'])));
}