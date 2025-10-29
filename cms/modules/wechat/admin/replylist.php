<?php
/**
 * 微信公众号助手
 */
$this_controller->check_admin_action($ACTION) or message('no_privilege');
require_once PHP168_PATH .'inc/weixinPush.class.php';
GetGP(array('action','msg_id','aid'));
$config = $core->get_config($this_system->name, $this_module->name);
$appid = $config['appid'];
$appsecret = $config['appsecret'];
$weixinPush = new weixinPush($appid, $appsecret);
switch($action){	
	case 'markelect':
		$row = $core->DB_master->fetch_one("SELECT * FROM  `$this_module->pushlogs` WHERE aid = {$aid}");
		if(empty($row)){
			message('未找到该文章！',$this_router.'-pushlist');
		}
		$result = $weixinPush->doMarkelect($_GET['comment_id'],$msg_id,$row['no']);
		if($result['code']==1){
			message($result['msg']);
		}
		message('设置精选成功！',$this_router.'-replylist?aid='.$aid);
	break;
	case 'unmarkelect':
		$row = $core->DB_master->fetch_one("SELECT * FROM  `$this_module->pushlogs` WHERE aid = {$aid}");
		if(empty($row)){
			message('未找到该文章！',$this_router.'-pushlist');
		}
		$result = $weixinPush->cancelMarkelect($_GET['comment_id'],$msg_id,$row['no']);
		if($result['code']==1){
			message($result['msg']);
		}
		message('取消精选成功！',$this_router.'-replylist?aid='.$aid);
	break;
	case 'deletecomment':
		foreach($_POST['comment_id'] as $comment_id){
			$result = $weixinPush->doDeleteComment($comment_id,$_POST['msg_id'],$_POST['no']);
		}
		echo jsonencode($_POST['comment_id']);
		exit;
    break;
	case 'replycomment':
		if($_POST){
			$_POST = p8_stripslashes2($_POST);
			$reply = $_POST['reply'];
			if(!$reply){
				message('回复内容不能为空！');
			}
			$appid = $config['appid'];
			$appsecret = $config['appsecret'];
			$result = $weixinPush->doReplyComment($_POST['comment_id'],$msg_id,$_POST['no'],$reply);
			if($result['code']==1){
				if($result['msg'] == 'already reply')
					message('已经回复过了，请勿重复回复！',$this_url.'?aid='.$aid);
				else
					message($result['msg']);
			}
			message('回复成功！',$this_url.'?aid='.$aid);
		}else{
			$comment_id = isset($_GET['comment_id']) ? intval($_GET['comment_id']) : 1;
			$no = isset($_GET['no']) ? intval($_GET['no']) : 0;
			include template($this_module, 'comment_reply', 'admin');			
		}
	break;
	default :
		$page_size = 20;
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$page = max($page, 1);
		$start = ($page-1)*$page_size;
		$row = $core->DB_master->fetch_one("SELECT * FROM  `$this_module->pushlogs` WHERE aid = {$aid}");
		if(empty($row['msg_id']) && empty($row['msg_data_id'])){
			message('未找到该文章的推送记录！',$this_router.'-pushlist');
		}
		$page_url = $this_url .'?aid='.$aid.'&page=?page?';
		$row['msg_data_id'] = $msg_id ? $msg_id : $row['msg_data_id'];
		$result = $weixinPush->getReplyList($row['msg_data_id'],$row['no'],$start,$page_size);

		if($result['code']==1){
			message($result['msg'],$HTTP_REFERER);
		}
		//$count = $weixinPush->getReplyList($row['msg_data_id'],$row['no'],0,49);
		$dataList = array();
		$i=0;
		foreach ($result['comment'] as $comment){
			$dataList[$i] = $comment;
			$dataList[$i]['id'] = $i;
			$dataList[$i]['user'] = $this_module->getUserInfoStr($comment['openid']);
			$dataList[$i]['create_time'] = date('Y-m-d H:i:s',$comment['create_time']);
			$dataList[$i]['comment_type_str'] = $dataList[$i]['comment_type']==1 ? '<span class="badge badge-success">精选</span>': '';
			$dataList[$i]['reply_content'] = $comment['reply']['content'];
			$i++;
		}
		$pages = list_page(array(
			'count' => 2000,
			'page' => $page,
			'page_size' => $page_size,
			'url' => $page_url,
			'template' => $P8LANG['base_page_template2']
		));
		include template($this_module, 'replylist', 'admin');
}