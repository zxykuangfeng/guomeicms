<?php
/**
* 获得模块的JSON
**/

require dirname(__FILE__) .'/../inc/init.php';


$system = isset($_GET['system']) ? xss_clear($_GET['system']) : '';
$callback = isset($_GET['callback']) ? xss_clear(clear_special_char($_GET['callback'])) : '';
$callback = preg_replace('/[^\w_]*/','',$callback);
in_array($system,array('core','cms','ask','sites')) or exit('{}');
$modules = null;

if($system == 'core'){
	$modules = &$core->CONFIG['modules'];
}else{
	isset($core->CONFIG['system&module'][$system]) or exit('[]');
	
	$modules = &$core->CONFIG['system&module'][$system]['modules'];
}

$json = array();
foreach($modules as $k => $v){
	$json[] = array(
		'name' => $k,
		'alias' => trim($v['alias']),
		'url' => xss_url($v['url']),
	);
}
if($callback){
	exit($callback .'('. jsonencode($json) .');');
}else{
	exit('');
}
