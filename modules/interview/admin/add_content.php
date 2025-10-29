<?php
defined('PHP168_PATH') or die();

/**
 * 添加访谈内容
 */

$this_controller->check_admin_action($ACTION) or message('no_privilege');

header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache");
header("Content-type: text/x-json");

if(REQUEST_METHOD == 'GET'){

	exit('0');
	
}else{

	$jsondata = jsonencode($this_controller->add_content($_POST));
	exit($jsondata);
}

?>
