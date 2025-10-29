<?php
defined('PHP168_PATH') or die();

/**
 * 广告管理
 */
$this_controller->check_admin_action('adsmanager') or message('no_privilege');
$this_module = $core->load_module('46');
$this_controller = $core->controller($this_module);
if(REQUEST_METHOD == 'GET'){
	
	$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	$id or message('no_such_item');
	
	$data = $this_module->get_buy($id);
	$data or message('no_such_item');
	
	$ad = $this_module->get($data['aid']);
	if(!$IS_FOUNDER && $UID != $ad['uid'] && !in_array($UID,explode(',',$ad['manager']))){
		message('no_privilege');
	}
	$ad or message('no_such_item');
	$ad['type_alias'] = 'ad_type_'.$ad['type'];
	if($data['data']['content']){
		$data['data']['content'] = attachment_url($data['data']['content'],false,true);
		$data['data']['content'] = html_decode_entities($data['data']['content']);
	}
	include template($this_module, 'ads_buy', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	$_POST = p8_stripslashes2($_POST);
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$id or message('no_such_item');
	$aid = isset($_POST['aid']) ? intval($_POST['aid']) : 0;
	$this_controller->update_buy($_POST);
	
	$form = <<<EOT
<form id="form" method="post" action="$this_router-ads_cache">
<input type="hidden" name="_referer" value="$HTTP_REFERER" />
'<input type="hidden" name="id" value="'.$aid.'" />'.
</form>
<script type="text/javascript">
	document.getElementById('form').submit();
</script>
EOT;	
	message($form);
}
