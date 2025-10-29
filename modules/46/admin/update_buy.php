<?php
defined('PHP168_PATH') or die();

/**
 * 广告管理
 */

$this_controller->check_admin_action('buy') or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	$id or message('no_such_item');
	
	$data = $this_module->get_buy($id);
	$data or message('no_such_item');
	
	$ad = $this_module->get($data['aid']);
	$ad or message('no_such_item');
	if($data['data']['content']){
		$data['data']['content'] = attachment_url($data['data']['content'],false,true);
		$data['data']['content'] = html_decode_entities($data['data']['content']);
	}
	include template($this_module, 'buy', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$id or message('no_such_item');
	$aid = isset($_POST['aid']) ? intval($_POST['aid']) : 0;
	$this_controller->update_buy($_POST);
	
	//缓存
	$form = '<form action="'.$this_router.'-cache" method="post" id="form_cache" target="form_cache_frame">'.
		'<input type="hidden" name="_referer" value="$HTTP_REFERER" />'.
		'<input type="hidden" name="id" value="'.$aid.'" />'.
		'</form>'.
		'<iframe style="display: none;" name="form_cache_frame"></iframe>'.
		'<script type="text/javascript">document.getElementById("form_cache").submit();</script>';
	message($P8LANG['done'].$form);
}
