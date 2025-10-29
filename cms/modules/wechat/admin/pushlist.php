<?php
defined('PHP168_PATH') or die();

/**
* 内容管理
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');
$config = $core->get_config($this_system->name, $this_module->name);
GetGP(array('msg_id','no','aid','id','action'));
switch($action){
	case 'delete' :
		$this_controller->check_admin_action('delete_pushlist') or message('no_privilege');
		$ids=implode(",",$id);
		$where="id in ($ids)";
		$query = "DELETE FROM  `$this_module->pushlogs` WHERE {$where}";
		$result = $core->DB_master->query($query);
		echo jsonencode($id);
		exit;
	break;
	case 'closecomment' :
		$this_controller->check_admin_action('closecomment') or message('no_privilege');
		require_once PHP168_PATH .'inc/weixinPush.class.php';
		$appid = $config['appid'];
		$appsecret = $config['appsecret'];
		$weixinPush = new weixinPush($appid, $appsecret);
		$result = $weixinPush->docloseComment($msg_id,$no);
		if($result['code']==1){
			message($result['msg'],$this_url,2);
		}
		$query = "UPDATE `$this_module->pushlogs` SET `open_comment` = '0' WHERE aid = {$aid}";
		$core->DB_master->query($query);
		message('wechat_closecomment',$this_url,2);	
	break;
	case 'opencomment' :
		$this_controller->check_admin_action('opencomment') or message('no_privilege');
		require_once PHP168_PATH .'inc/weixinPush.class.php';
		$appid = $config['appid'];
		$appsecret = $config['appsecret'];
		$weixinPush = new weixinPush($appid, $appsecret);
		$token = $this_module->wx_get_token($appid,$appsecret);
		
		$result = $weixinPush->doOpenComment($msg_id,$no);
		if($result['code']==1){
			message($result['msg'],$this_url,2);
		}
		$query = "UPDATE `$this_module->pushlogs` SET `open_comment` = '1' WHERE aid = {$aid}";
		$core->DB_master->query($query);
		message('wechat_opencomment',$this_url,2);	
	break;
	default :
		$use_sphinx = false;
		if(!empty($_REQUEST['model'])){
			$this_system->init_model();	
			$this_model or message('no_such_cms_model');
		}else{
			$MODEL = '';	
		}

		//加载分类模块
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$page = max($page, 1);
		$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
		$desc = empty($_GET['order']) ? ' DESC' : ' ASC';
		$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
		$keyword = $keyword ? $keyword : (isset($_GET['word']) ? trim($_GET['word']) : '');
		$verifier = isset($_GET['verifier']) ? trim($_GET['verifier']) : '';
		$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
		$username = isset($_GET['username']) ? trim($_GET['username']) : '';

		$page_url = $this_url .'?page=?page?';

		$select = select();
		$fields = 'i.id, i.aid, i.title, i.author, i.push_at, i.verifier, i.username, i.open_comment, i.msg_data_id, i.no';
		$select->from($this_module->pushlogs .' AS i', $fields);
		if($id){	
			$select->in('i.aid', $id);
		}else{			
			$select->order('i.push_at'. $desc);
		}
		if(strlen($keyword)){
			$select->search('i.title', $keyword);
		}
		if(strlen($username)){
			$select->search('i.username', $username);
		}
		if(strlen($verifier)){
			$select->search('i.verifier', $verifier);
		}
		$page_size = 20;
		$count = 0;
		//echo $select->build_sql();
		//取数据
		$list = $core->list_item(
			$select,
			array(
				'page' => &$page,
				'count' => &$count,
				'page_size' => $page_size,
				'ms' => 'master',
				'sphinx' => $use_sphinx && $sphinx['enabled'] ? $sphinx : null
			)
		);
		$pages = list_page(array(
				'count' => $count,
				'page' => $page,
				'page_size' => $page_size,
				'url' => $page_url
			));
		$allow_delete = $this_controller->check_admin_action('delete_pushlist');
		include template($this_module, 'pushlist', 'admin');
}