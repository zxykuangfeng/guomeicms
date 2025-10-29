<?php
defined('PHP168_PATH') or die();

/**
* 会员转换
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	//$integration_type = xss_clear($_GET['type']);
	include $this_module->path .'call/transition.uc.php';
}else if(REQUEST_METHOD == 'POST'){
	//$integration_type = xss_clear($_POST['config']['integration_type']);
	include $this_module->path .'call/transition.uc.php';
}
