<?php
defined('PHP168_PATH') or die();

$IS_ADMIN or exit('0');

if(REQUEST_METHOD == 'POST'){

$alias = html_entities($_POST['alias']);
//先检测正常站点
$data = $this_module->get_site($alias);
if($data) exit('false');
//检查回收站站点
$data = $this_module->get_recycle_site($alias);
if($data) 
	exit('false');
else 
	exit('true');

}
