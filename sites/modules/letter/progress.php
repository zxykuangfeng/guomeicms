<?php
defined('PHP168_PATH') or die();

$this_controller->check_action('view') or message('no_privilege');
$SEO_KEYWORDS = $SEO_DESCRIPTION = '';
$TITLE = $P8LANG['letter'] .'_'. $core->CONFIG['site_name'];	
$progress='';
if(REQUEST_METHOD=='POST'){
	$snumber 	= $_POST['snumber'];
	//$susername = $_POST['susername'];
	
	if(!$snumber){
		message('error');
	}
	
	$data = $this_module->getProgress(p8_html_filter($snumber));

	$progress = $data['log'];
}
	$cates['type'] = $this_module->get_category('type');
	$cates['department'] = $this_module->get_category('department');
	$tatistics = $this_module->getstatistics2();
	include template($this_module, 'progress');

