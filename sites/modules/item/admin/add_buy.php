<?php
defined('PHP168_PATH') or die();
$this_controller->check_admin_action('adsmanager') or message('no_privilege');
/**
 * 广告管理
 */
$this_module = $core->load_module('46');
$this_controller = $core->controller($this_module);
if(REQUEST_METHOD == 'GET'){
	
	$aid = isset($_GET['aid']) ? intval($_GET['aid']) : 0;
	$aid or message('no_such_item');
	
	$data['postfix'] = isset($_GET['postfix']) ? preg_replace('/[^0-9a-zA-Z_\-]/', '', $_GET['postfix']) : '';
	
	$ad = $this_module->get($aid);

	if(!$IS_FOUNDER && $UID != $ad['uid'] && !in_array($UID,explode(',',$ad['manager']))){
		message('no_privilege');
	}
	$ad or message('no_such_item');
	$ad['type_alias'] = 'ad_type_'.$ad['type'];
	include template($this_module, 'ads_buy', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$this_controller->add_buy($_POST);
	
	//缓存
	$form = '<form action="'.$this_router.'-ads_cache" method="post" id="form_cache" target="form_cache_frame">'.
		'<input type="hidden" name="_referer" value="$HTTP_REFERER" />'.
		'</form>'.
		'<iframe style="display: none;" name="form_cache_frame"></iframe>'.
		'<script type="text/javascript">document.getElementById("form_cache").submit();</script>';
	message($P8LANG['done'].$form);
}
