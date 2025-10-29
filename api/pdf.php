<?php
$__FILE__ = __FILE__;

$core_conf = include dirname($__FILE__).'/../data/core/core.php';
$file = $_GET['file'] ? trim($_GET['file']) : '';
if($core_conf['url'] && strpos($file,$core_conf['url']) !== false){
	$file = str_replace($core_conf['url'],'',$file);
}
if($core_conf['resource_url'] && strpos($file,$core_conf['resource_url']) !== false){
	$file = str_replace($core_conf['resource_url'],'',$file);
}
if($core_conf['static_url'] && strpos($file,$core_conf['static_url']) !== false){
	$file = str_replace($core_conf['static_url'],'',$file);
}
$file = '../'.$file;
if($file){
	if(strtolower(substr(strrchr($file,'.'),1)) != 'pdf') exit('文件格式不对.');
	if(!file_exists($file)) exit('文件不存在');
	header("Content-type:application/pdf");
	//header("Content-Disposition:attachment;filename=downloaded.pdf");
	readfile($file);
	exit; 
}else{
	exit('err');
}