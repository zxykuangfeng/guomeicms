<?php
defined('PHP168_PATH') or die();

/**
* 追加内容
**/

if(REQUEST_METHOD == 'GET'){
/**
* your code
**/
	
	include template($this_module, 'addon_edit', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	
	$this_controller->addon($_POST) or message('fail');
	
	message('done', HTTP_REFERER);
}
