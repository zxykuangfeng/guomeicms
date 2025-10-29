<?php
defined('PHP168_PATH') or die();

/**
* 缓存模型
**/
set_time_limit(0);
if(REQUEST_METHOD == 'GET'){
	
	$form = <<<EOT
<form id="form" method="post" action="$this_url">
</form>
<script type="text/javascript">
//if(confirm('$P8LANG[confirm_to_do]')){
	document.getElementById('form').submit();
//}else{
//	window.location.href = '$HTTP_REFERER';
//}
</script>
EOT;
	message($form);
	
}else if(REQUEST_METHOD == 'POST'){
	$this_module->cache();
	
	$LABEL = &$core->load_module('label');
	if(empty($_POST['_all_cache_'])){
		$LABEL->cache();
		$LABEL->cache_data();
	}
	
	$this_system->log(array(
		'title' => $P8LANG['_module_cache_admin_log'],
		'request' => $_POST,
	));
	//跳回总缓存
	!empty($_POST['_all_cache_']) && message($BACKTO_ALL_CACHE);
	message('done');
}
