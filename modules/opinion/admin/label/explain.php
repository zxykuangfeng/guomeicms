<?php
defined('PHP168_PATH') or die();

/**
* 解析标签的SQL
**/

if(REQUEST_METHOD == 'POST'){
	
	require $this_module->path .'admin/label/valid_data.php';
	require $LABEL->path .'inc/explain.php';
}
