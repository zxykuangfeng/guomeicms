<?php
defined('PHP168_PATH') or die();

/**
* 导入CMS模型
**/

$this_controller->check_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$mid = isset($_GET['mid'])? intval($_GET['mid']) : '';
	$AtoZ_base = range('A','Z');
	foreach($AtoZ_base as $r){$rows2[] = 'A'.$r;}
	$AtoZ = array_merge($AtoZ_base,$rows2);	
	$this_module->set_model($mid) or message('no_such_forms_model');
	$this_model['fields']['_username_168'] = array('alias'=>$P8LANG['username']);	
	include template($this_module, 'import_list');
}else if(REQUEST_METHOD == 'POST'){
	include $this_module->path .'call/import_list.call.php';
	message('done',	$this_router.'-manage?mid='.$mid,3);
}
