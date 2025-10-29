<?php
defined('PHP168_PATH') or die();

/**
 * 广告管理
 */

$this_controller->check_admin_action('ad') or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	$id or message('no_such_item');
	
	$postfix = isset($_GET['postfix']) ? preg_replace('/[^0-9a-zA-Z_\-]/', '', $_GET['postfix']) : '';
	
	$data = $this_module->get($id, $postfix);
	$managers = array();
	if(!empty($data['manager'])){
		$uids = $data['manager'];
		$member = &$core->load_module('member');
		$managers = $core->DB_master->fetch_all("SELECT id,username FROM {$member->table} WHERE id IN ($uids)");
	}
	
	$data or message('no_such_item');
	
	include template($this_module, 'edit', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$id or message('no_such_item');
	
	$this_controller->update($id, $_POST);
	
	//缓存
	$form = '<form action="'.$this_router.'-cache" method="post" id="form_cache" target="form_cache_frame">'.
		'<input type="hidden" name="_referer" value="$HTTP_REFERER" />'.
		'<input type="hidden" name="id" value="'.$id.'" />'.
		'</form>'.
		'<iframe style="display: none;" name="form_cache_frame"></iframe>'.
		'<script type="text/javascript">document.getElementById("form_cache").submit();</script>';
	message($P8LANG['done'].$form,$this_router.'-list',1);
}
