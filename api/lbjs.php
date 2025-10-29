<?php
/**
*js调用标签数据
**/
require dirname(__FILE__) .'/../inc/init.php';
$name = isset($_GET['n'])?trim(xss_clear(clear_special_char($_GET['n']))):'';
$system = isset($_GET['sys'])?trim(xss_clear(clear_special_char($_GET['sys']))):'core';
$site = isset($_GET['site'])?trim(xss_clear(clear_special_char($_GET['site']))):'';
$id = isset($_GET['id'])?intval($_GET['id']):0;
$page = isset($_GET['p'])?intval($_GET['p']):0;
$page = max(1, $page);
if(!$id && !$name)exit("document.write('label name is need!!');");
in_array($system,array('core','cms','ask','sites')) or exit("The system $system you load doesn't exist");


if($site && $site != 'core' && in_array($system,array('core','cms','ask','sites'))){
	$core->load_system($system);
}
$name = html_entities($name);
defined('PHP168_PATH') or die();
$LABEL = &$core->load_module('label');
global $__label;
global $SYSTEM, $MODULE, $LABEL_POSTFIX, $LABEL_PAGE; 
$name = from_utf8($name);

$LABEL->init($system, 'label', $LABEL_PAGE,$site,'');

$LABEL->get_data_cache();
$data = $LABEL->display($name);
if($data){
	//$LABEL->refresh_labels();	
	$label = str_replace(array("'","\r\n","\r"),array("\'",' ',' '),$data);
	header('Content-type: application/javascript');
	echo "document.write('".$label."');";
}else{
	echo "document.write('');";
}
exit;


