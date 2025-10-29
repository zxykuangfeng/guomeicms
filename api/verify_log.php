<?php
header('Content-type: application/json;charset=utf-8');
require_once dirname(__FILE__) .'/../inc/init.php';
$request = p8_stripslashes2($_POST + $_GET);
GetGP(array('token'));
$data = array();
if(empty($token) || ($token && !hash_equals($token,$core->CONFIG['p8_api_token']))){
	exit(json_encode(array('status'	=> 200,'error' => $P8LANG['api_token_err'])));  
}
$module = isset($_GET['m'])?trim(xss_clear(clear_special_char($_GET['m']))):'';
$iid = isset($_GET['id'])?intval($_GET['id']):0;
require_once PHP168_PATH. 'inc/verify_log.php';
$data = (new VerifyLog())->listHtml($module,$iid);
exit(json_encode($data));