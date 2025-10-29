<?php
defined('PHP168_PATH') or die();

$this_controller->check_action($ACTION) or message($P8LANG['no_privilege']);
//1反跨站请求伪造（CSRF）
$csrf_enable = $core->CONFIG['csrf_enable'] ? true : false;
if(REQUEST_METHOD == 'GET'){
	$id = intval($_GET['id']);
	$rsdb = $this_module->get($id);
	$rsdb['replyer'] || $rsdb['replyer']=$USERNAME;	
	//2csrf-token
	$token_key =  "p8_".$_P8SESSION['_hash'].time();
	$token = authcode_token($token_key,'ENCODE');
	include template($this_module,'reply');
	exit;
}elseif(REQUEST_METHOD == 'POST'){
	$id = intval($_POST['id']);
	$postdb['replytime']=P8_TIME;
	$postdb['replyer']= $_POST['replyer'] ? html_entities(from_utf8($_POST['replyer'])) : $USERNAME;
	$postdb['reply'] = html_entities(from_utf8($_POST['reply']));
	//3反跨站请求伪造（CSRF）
	if($csrf_enable){
		$token = authcode_token($_POST['token']);
		$token or message('token_error');
	}
	$this_module->update($postdb,$id);
	$rsdb=$this_module->get($id);
	$replytime = date("Y-m-d H:i:s",$rsdb['replytime']);
	echo "<div class='border3 mtop'>$rsdb[reply]<p class='replyer'>".$P8LANG['guestbook']['replyer'].": $rsdb[replyer] &nbsp;".$P8LANG['guestbook']['replytime'].": $replytime</p></div>";
	exit;
}
