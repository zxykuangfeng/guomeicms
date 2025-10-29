<?php
defined('PHP168_PATH') or die();

//1反跨站请求伪造（CSRF）
$csrf_enable = $core->CONFIG['csrf_enable'] ? true : false;

if(REQUEST_METHOD == 'GET'){
	$id = intval($_GET['id']);
	$rsdb = $this_module->get($id);
	if($rsdb['uid'] !=$UID && !$this_controller->check_action($ACTION))message($P8LANG['no_privilege']);
	$rsdb['replyer'] || $rsdb['replyer']=$USERNAME;
	//2csrf-token
	$token_key =  "p8_".$_P8SESSION['_hash'].time();
	$token = authcode_token($token_key,'ENCODE');
	include template($this_module,'edit');
	exit;
}elseif(REQUEST_METHOD == 'POST'){
	$id = intval($_POST['id']);
	$rsdb=$this_module->get($id);
	if($rsdb['uid'] !=$UID && !$this_controller->check_action($ACTION))message($P8LANG['no_privilege']);
	$postdb['title']= html_entities(from_utf8($_POST['title']));
	$postdb['content'] = html_entities(from_utf8($_POST['content']));
	//3反跨站请求伪造（CSRF）
	if($csrf_enable){
		$token = authcode_token($_POST['token']);
		$token or message('token_error');
	}
	$this_module->update($postdb,$id);
	$rsdb=$this_module->get($id);

	$rsdb['timestamp']=date('Y-m-d H:i:s',$rsdb['posttime']);
	exit(p8_json($rsdb));

}
