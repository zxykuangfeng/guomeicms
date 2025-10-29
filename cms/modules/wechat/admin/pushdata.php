<?php
/**
 * 微信公众号
 */
$this_controller->check_admin_action($ACTION) or message('no_privilege');
@set_time_limit(3600);
$core->CONFIG['debug'] = 0;
$step = isset($_POST['step']) ? $_POST['step'] : 'init';
if($step == 'done'){
	message('done', $this_router.'-list',1);
}
if(isset($_POST['ids'])){
	$ids = is_array($_POST['ids']) ? implode('`',array_flip($_POST['ids'])) : $_POST['ids'];
}else{
	$ids = '';
}
if(empty($ids)){
	message('wechat_no_item',$this_router.'-list',3);
}else{
	count(explode('`',$ids)) <= 8 or message('wechat_no_item',$this_router.'-list',3);
}
require_once PHP168_PATH .'inc/WxService.class.php';
require_once PHP168_PATH .'inc/weixinPush.class.php';
$config = $core->get_config($this_system->name, $this_module->name);
$appid = $config['appid'];
$appsecret = $config['appsecret'];
$push_type = isset($_POST['push_type']) ? intval($_POST['push_type']) : 4;
$tag_id = isset($_POST['tag_id']) ? $_POST['tag_id'] : 0;
$preview_openid = isset($_POST['preview_openid']) ? $_POST['preview_openid'] : $config['preview_openid'];

!empty($_POST['start']) or ___poster($P8LANG['wechat_push_step_1'],$ids,$push_type,$tag_id,$preview_openid,'init');
switch($step){

	case 'init':
		$doids = explode('`',$ids);
		foreach($doids as $k=>$id){
			$row = $core->DB_master->fetch_one("SELECT * FROM  `$this_module->pushlogs` WHERE aid = {$id}");
			if(empty($row)){				
				$row = $core->DB_master->fetch_one("SELECT * FROM  `$this_module->main_table` WHERE id = {$id}");
				$row['push_at'] = date('Y-m-d H:i:s',P8_TIME);
				$row['frame'] = str_replace("<!--#p8_r_attach1#-->",$RESOURCE_VICE."/attachment",$row['frame']);
				$row['frame'] = str_replace("<!--#p8_attach#-->",$RESOURCE_VICE."/attachment",$row['frame']);			
				$row['litpic'] =  $row['frame'] ? $row['frame'] : $RESOURCE_VICE.'/images/nopic.jpg';
				if(substr($row['litpic'],0,4) != 'http') $row['litpic'] = $RESOURCE_VICE.$row['litpic'];
				if(substr($row['litpic'],0,4) != 'http') message($P8LANG['wechat_push_false5']);
				$bodyRow = $core->DB_master->fetch_one("SELECT * FROM  `$this_module->addon_table` WHERE iid = {$id}");
				$row['body'] =  p8_addslashes($this_module->filterBody($bodyRow['content']));
				if(empty($row['body'])) message($P8LANG['wechat_push_false4']);
				$query = "INSERT INTO `$this_module->pushlogs`(no,aid,litpic,body,title,author,description,verifier,username,push_at) VALUES ('".intval($no)."', '".$id."', '".$row['litpic']."', '".$row['body']."','".$row['title']."','".$row['author']."','".$row['summary']."','".$row['verifier']."','".$row['username']."','".$row['push_at']."');";
				$result = $core->DB_master->query($query);
			}
		}
		___poster($P8LANG['wechat_push_step_2'],$ids,$push_type,$tag_id,$preview_openid,'uploadLitpic');
	break;
	case 'uploadLitpic':
		$doids = explode('`',$ids);		
		$weixinPush = new weixinPush($appid, $appsecret);
		if(empty($_P8SESSION['token']) || $_P8SESSION['token'] == true) $weixinPush->getToken(true);
		foreach($doids as $k=>$id){
			$row = $core->DB_master->fetch_one("SELECT * FROM  `$this_module->pushlogs` WHERE aid = {$id}");
			if($row['litpic_id']) continue;
			//上传缩略图素材
			$licpicMediaId = $weixinPush->upload('image',$row['litpic']);
			if(empty($licpicMediaId))  message(p8lang($P8LANG['wechat_push_false2'], array($k++)));
			$query = "UPDATE `$this_module->pushlogs` SET `litpic_id` = '{$licpicMediaId}' where aid = {$id}";
			$core->DB_master->query($query);
		}
		___poster($P8LANG['wechat_push_step_3'],$ids,$push_type,$tag_id,$preview_openid,'uploadPic');
	break;
	
	case 'uploadPic':		
		$doids = explode('`',$ids);		
		$weixinPush = new weixinPush($appid, $appsecret);
		if(empty($_P8SESSION['token']) || $_P8SESSION['token'] == true) $weixinPush->getToken(true);
		foreach($doids as $k=>$id){
			$row = $core->DB_master->fetch_one("SELECT * FROM  `$this_module->pushlogs` WHERE aid = {$id}");
			$preg = '/<img.*?src=[\"|\']?(.*?)[\"|\']?\s.*?>/i';//匹配img标签的正则表达式
			$html = p8_stripslashes($row['body']);
			preg_match_all($preg, $html, $allImg);//这里匹配所有的img			
			foreach($allImg[1] as $oneimg){
				$src_img = $oneimg;
				$oneimg = str_replace("<!--#p8_r_attach1#-->",$RESOURCE_VICE."/attachment",$oneimg);
				$oneimg = str_replace("<!--#p8_attach#-->",$RESOURCE_VICE."/attachment",$oneimg);			
				if(substr($oneimg,0,4) != 'http') $oneimg = $RESOURCE_VICE.$oneimg;
				if(substr($oneimg,0,4) != 'http') message($P8LANG['wechat_push_false6']);
				//上传素材
				$url = $weixinPush->uploadPic($oneimg);
				if($url) $html = str_replace($src_img, $url, $html);
				
			}
			$html = p8_addslashes($html);
			$query = "UPDATE `$this_module->pushlogs` SET body = '".$html."' where aid = {$id}";
			$core->DB_master->query($query);
		}
		___poster($P8LANG['wechat_push_step_4'],$ids,$push_type,$tag_id,$preview_openid,'uploadnews');
	break;
	
	case 'uploadnews':
		$doids = explode('`',$ids);
		$arcRows = array();
		$i=0;
		foreach($doids as $k=>$id){
			$row = $core->DB_master->fetch_one("SELECT * FROM  `$this_module->pushlogs` WHERE aid = {$id}");
			$body = $row['body'];
			$arcRows[$i]['litpic_id'] = $row['litpic_id'];
			$arcRows[$i]['author'] = $row['author'];
			$arcRows[$i]['title'] = $row['title'];
			$arcRows[$i]['body'] = $body;
			$arcRows[$i]['description'] = p8_cutstr($row['description'],100,'...');
			$arcRows[$i]['arcurl'] = $core->controller.'/cms/item-view-id-'.$id;
			$arcRows[$i]['open_comment'] = isset($config['open_comment']) && $config['open_comment'] ? 1 : 0;
			$arcRows[$i]['fans_comment'] = isset($config['fans_comment']) && $config['fans_comment'] ? 1: 0;
			$i++;
		}
		$appid = $config['appid'];
		$appsecret = $config['appsecret'];
		$weixinPush = new weixinPush($appid, $appsecret);
		$result = $weixinPush->uploadnews($arcRows);
		if($result['media_id']){
			$res = $core->DB_master->query("UPDATE `$this_module->pushlogs` SET `media_id` = '{$result['media_id']}' WHERE aid IN (".implode(',',$doids).")");
		}else{
			message('wechat_push_false',$this_router.'-list',2);
		}
		___poster($P8LANG['wechat_push_step_5'],$ids,$push_type,$tag_id,$preview_openid,'pushToWeixin');
	break;
	
	case 'pushToWeixin':
		$doids = explode('`',$ids);
		$is_to_all = false;
		switch ($push_type){
			case 1:
				$is_to_all = true;
				break;
			case 2:
				if(!$tag_id) message('wechat_push_noid');
				break;
			case 4:
				if(!$preview_openid) message('wechat_push_no_openid');			
				break;
		}
		$appid = $config['appid'];
		$appsecret = $config['appsecret'];
		$weixinPush = new weixinPush($appid, $appsecret);
		$row = $core->DB_master->fetch_one("SELECT * FROM  `$this_module->pushlogs` WHERE aid = {$doids[0]}");
		$media_id = $row['media_id'];
		if($push_type==4){
			//预览
			$result = $weixinPush->preview($media_id,$preview_openid);
			if($result['errcode']==0){			
				message('wechat_push_step_6',$this_router.'-list',1);
			}
		}else{
			$result = $weixinPush->sendall($media_id,$is_to_all,$tag_id);
		}
		if($result['msg_data_id']){
			$query = "UPDATE `$this_module->pushlogs` SET push_at = '".date('Y-m-d H:i:s')."',msg_id='{$result['msg_id']}',msg_data_id='{$result['msg_data_id']}' where media_id = '{$media_id}'";
			$core->DB_master->query($query);
			message('wechat_push_step_7',$this_router.'-list',1);
		}else{
			message('wechat_push_false',$this_router.'-list',1);
		}
		___poster($P8LANG['wechat_push_step_7'],$ids,$push_type,$tag_id,$preview_openid,'done');
	break;
}

function ___poster($message = '',$ids ='',$push_type = '',$tag_id = '',$preview_openid = '',$step = 'init'){

	global $this_url;
	$form = <<<FORM
$message
<form action="$this_url" method="post" id="form">
<input type="hidden" name="start" value="1" />
<input type="hidden" name="ids" value="{$ids}" />
<input type="hidden" name="step" value="{$step}" />
<input type="hidden" name="push_type" value="{$push_type}" />
<input type="hidden" name="tag_id" value="{$tag_id}" />
<input type="hidden" name="preview_openid" value="{$preview_openid}" />
</form>
<script type="text/javascript">
setTimeout(function(){ document.getElementById('form').submit(); }, 1000);
</script>
FORM;
	message($form);
}