<?php
defined('PHP168_PATH') or die();

/**
 * 广告管理
 */

$this_controller->check_admin_action('ad') or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	$aid = isset($_GET['aid']) ? intval($_GET['aid']) : 0;
	$aid or message('no_such_item');
	
	$data['postfix'] = isset($_GET['postfix']) ? preg_replace('/[^0-9a-zA-Z_\-]/', '', $_GET['postfix']) : '';
	
	$ad = $this_module->get($aid);
	$ad or message('no_such_item');
	$ad['type_alias'] = 'ad_type_'.$ad['type'];
	include template($this_module, 'buy', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	$_POST = p8_stripslashes2($_POST);
	$this_controller->add_buy($_POST);
	$aid = isset($_POST['aid']) ? intval($_POST['aid']) : 0;
	$aid or message('no_such_item');
	//缓存
	$form = '<form action="'.$this_router.'-cache" method="post" id="form_cache" target="form_cache_frame">'.
		'<input type="hidden" name="_referer" value="$HTTP_REFERER" />'.
		'<input type="hidden" name="id" value="'.$aid.'" />'.
		'</form>'.
		'<iframe style="display: none;" name="form_cache_frame"></iframe>'.
		'<script type="text/javascript">document.getElementById("form_cache").submit();</script>';
	message($P8LANG['done'].$form,$this_router.'-buy_list?aid='.$aid,2);
}
