<?php
/**
 * 微信公众号推送初始化
 */
$this_controller->check_admin_action($ACTION) or message('no_privilege');
require_once PHP168_PATH .'inc/weixinPush.class.php';
$ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
$ids = is_array($ids) ? $ids : array($ids);
$config = $core->get_config($this_system->name, $this_module->name);

if(empty($ids)) message('wechat_push_select',$this_router.'-list',3);
if(count($ids)>8) message('wechat_push_select_exp',$this_router.'-list',3);
$tagIds = array();
$appid = $config['appid'];
$appsecret = $config['appsecret'];
$weixinPush = new weixinPush($appid,$appsecret);
$tagIds = $weixinPush->getTagId();
$arcRows = array();
foreach($ids as $id){
	$row = $core->DB_master->fetch_one("SELECT * FROM  `$this_module->pushlogs` WHERE aid = {$id}");	
	if(empty($row)){
		$row = $core->DB_master->fetch_one("SELECT * FROM  `$this_module->main_table` WHERE id = {$id}");
	}
	$arcRows[] = $row['title'];
	if($row && empty($row['title'])){
		$row = $core->DB_master->fetch_one("SELECT * FROM  `$this_module->main_table` WHERE id = {$id}");
		$query = "UPDATE `$this_module->pushlogs` SET title = '".$row['title']."' where aid = {$id}";
		$core->DB_master->query($query);
	}
	if($row && empty($row['author'])){
		$row = $core->DB_master->fetch_one("SELECT * FROM  `$this_module->main_table` WHERE id = {$id}");
		$query = "UPDATE `$this_module->pushlogs` set `author` = '".$row['author']."' where aid = {$id}";
		$core->DB_master->query($query);
	}
	if($row && empty($row['summary'])){
		$row = $core->DB_master->fetch_one("SELECT * FROM  `$this_module->main_table` WHERE id = {$id}");
		$query = "UPDATE `$this_module->pushlogs` set `description` = '".$row['summary']."' where aid = {$id}";
		$core->DB_master->query($query);
	}
}
include template($this_module, 'weixin_push', 'admin');