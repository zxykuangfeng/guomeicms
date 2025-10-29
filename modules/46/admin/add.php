<?php
defined('PHP168_PATH') or die();

/**
 * 广告管理
 */

$this_controller->check_admin_action('ad') or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$managers = array();
	include template($this_module, 'edit', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$this_controller->add($_POST) or message('fail');
	
	//缓存
	$form = '<form action="'.$this_router.'-cache" method="post" id="form_cache" target="form_cache_frame">'.
		'<input type="hidden" name="_referer" value="$HTTP_REFERER" />'.
		'</form>'.
		'<iframe style="display: none;" name="form_cache_frame"></iframe>'.
		'<script type="text/javascript">document.getElementById("form_cache").submit();</script>';
	message($P8LANG['done'].$form,$this_router.'-list',1);
}
