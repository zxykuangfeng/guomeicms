<?php
/**
 * 微信公众号助手
 */
$this_controller->check_admin_action($ACTION) or message('no_privilege');
GetGP(array('action','id'));
$messageRow = array();
switch($action){
	case 'delete' :
		$this_controller->check_admin_action('delete_message') or message('no_privilege');
		$ids=implode(",",$id);
		$where="id in ($ids)";
		$query = "DELETE FROM  `$this_module->messages` WHERE {$where}";
		$result = $core->DB_master->query($query);
		echo jsonencode($id);
		exit;
	break;
	case 'reply':
		$this_controller->check_admin_action('reply_message') or message('no_privilege');
		require_once PHP168_PATH .'inc/WxService.class.php';
		require_once PHP168_PATH .'inc/weixinPush.class.php';
		$config = $core->get_config($this_system->name, $this_module->name);
		$_POST = p8_stripslashes2($_POST);
		$reply = isset($_POST['reply']) ? html_entities($_POST['reply']) : '';	
		$id or message('no_such_item',$this_url,2);
		$reply or message('wechat_message_false4',$this_url,2);
		$messageRow = $core->DB_master->fetch_one("SELECT * FROM `$this_module->messages` where id = {$id}");
		$access_token = $this_module->wx_get_token($config['appid'],$config['appsecret']);
		$url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$access_token;
		$data['touser'] = $messageRow['user'];
		$data['msgtype'] = 'text';
		$data['text']['content'] = $reply;
		$result = $this_module->get_curl_contents($url,'POST',$this_module->json_encode_ex($data,'utf-8'));
		$msg = json_decode($result,true);
		if($msg['errcode']){
			if($msg['errcode']=='45015') 
				message('wechat_message_false',$this_url,2);
			else
				message(p8lang($P8LANG['wechat_message_false3'], array($msg['errcode'])));
		}
		$status = $this_module->addMessage($messageRow['user'], $messageRow['type'], $messageRow['content'], $reply,$id);
		if($status){
			message('wechat_message_ok',$this_url,2);
		}else{
			message('wechat_message_false2',$this_url,2);
		}
	break;
	case 'doreply':
		$this_controller->check_admin_action('doreply_message') or message('no_privilege');
		$id or message('no_such_item');
		$messageRow = $core->DB_master->fetch_one("SELECT * FROM `$this_module->messages` where `id` = {$id}");	
		include template($this_module, 'message_reply', 'admin');
	break;
	case 'showuser':	
		$this_controller->check_admin_action('showuser') or message('no_privilege');
		!empty($id) or message('no_such_user');
		$userinfo = $core->DB_master->fetch_one("SELECT * FROM `$this_module->users` where `openid`='{$id}'");
		$userinfo['subscribe_scene'] = $this_module->getSubscribeScene($userinfo['subscribe_scene']);
		include template($this_module, 'userinfo', 'admin');
	break;
	default :
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$page = max($page, 1);
		$config = $core->get_config($this_system->name, $this_module->name);
		$limit = 20;
		$page_url = $this_url .'?page=?page?';

		$select = select();
		$select->from($this_module->messages);
		$select->order('id desc');

		$page_size = 20;
		$count = 0;
		$dataList = array();
		//取数据
		$list = $core->list_item(
			$select,
			array(
				'page' => &$page,
				'count' => &$count,
				'page_size' => $page_size,
				'ms' => 'master',
				'sphinx' => null
			)
		);
		$pages = list_page(array(
				'count' => $count,
				'page' => $page,
				'page_size' => $page_size,
				'url' => $page_url
			));
		$i=0;
		$type = array(
			'image' => '图片',
			'voice' => '语音',
			'video' => '视频',
			'music' => '音乐',
			'news' => '图文',
			'text' => '文本',
		);
		foreach($list as $row)
		{
			$dataList[$i] = $row;
			$dataList[$i]['user'] = $this_module->getUserInfoStr($row['user']);
			$dataList[$i]['type'] = array_key_exists($row['type'],$type) ? $type[$row['type']] : $row['type'];
			if($row['type']=='subscribe')
				$dataList[$i]['content'] = '<span class="badge badge-success">关注公众号</span>';
			if($row['type']=='unsubscribe')
				$dataList[$i]['content'] = '<span class="badge badge-danger">取消关注</span>';
			$i++;
		}
		include template($this_module, 'message', 'admin');
}