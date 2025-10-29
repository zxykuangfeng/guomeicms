<?php
defined('PHP168_PATH') or die();

$this_controller->check_action('view') or message('no_privilege');
$SEO_KEYWORDS = $SEO_DESCRIPTION = '';
$TITLE = $P8LANG['letter'] .'_'. $core->CONFIG['site_name'];
//1反跨站请求伪造（CSRF）
$csrf_enable = $core->CONFIG['csrf_enable'] ? true : false;
if(REQUEST_METHOD=='POST'){
	$snumber 	= $_POST['snumber'];
	//$susername = $_POST['susername'];
	
	if(!$snumber){
		message('error');
	}
	//3反跨站请求伪造（CSRF）
	if($csrf_enable){
		$token = authcode_token($_POST['token']);
		$token or message('token_error');
	}
	$data = $this_module->getProgress(p8_html_filter($snumber));

	$progress = $data['log'];
}
//2csrf-token
$token_key =  "p8_".$_P8SESSION['_hash'].time();
$token = authcode_token($token_key,'ENCODE');
$cates = $this_module->get_category();	
$tatistics = $this_module->getstatistics2();
include template($this_module, 'progress');

