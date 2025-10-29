<?php
/**
 * 微信公众号助手
 */
$this_controller->check_admin_action($ACTION) or message('no_privilege');

require_once PHP168_PATH .'inc/WxService.class.php';
require_once PHP168_PATH .'inc/weixinPush.class.php';

$config = $core->get_config($this_system->name, $this_module->name);
	
$wx = new WxService($config['appid'],$config['appsecret']);
$page = $_GET['page']?intval($_GET['page']):1;
$type = $_GET['type']?$_GET['type']:'image';
$result = $wx->getMaterialList($page,$type);
echo $result;
	