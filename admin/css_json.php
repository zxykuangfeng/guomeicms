<?php
defined('PHP168_PATH') or die();

//header('Content-type: text/json; charset=utf-8');

//比如 $base_dir 为 default/cms/item, 下面有目录 article, photo, $dir 为 article
$base_dir = isset($_GET['base_dir']) && clear_special_char($_GET['base_dir']) ? clear_special_char($_GET['base_dir']) : 'skin/';
$base_dir = escapeshellcmd($base_dir);
$base_dir = real_path(PHP168_PATH.'/'. $base_dir);
if(!$base_dir || stristr($base_dir, PHP168_PATH) != $base_dir){
	//非法路径, 在模板范围外的目录是不允许访问的
	exit('[]');
}

$dir = isset($_GET['dir']) && clear_special_char($_GET['dir']) ? clear_special_char($_GET['dir']) : '';
$dir = escapeshellcmd($dir);
$dir = real_path($base_dir . $dir);

if(!$dir || stristr($dir, $base_dir) != $dir){
	//非法路径, 在模板范围外的目录是不允许访问的
	exit('[]');
}

$_dir = preg_replace('?^'. $base_dir .'?i', '', $dir);//str_replace($base_dir, '', $dir);

$dirs = $files = $json = array();
$handle = opendir($dir);
while(($item = readdir($handle)) !== false){
	if(in_array($item, array('.', '..', '.git','.svn', '_svn'))) continue;
	
	if(is_dir($dir . $item)){
		$dirs[] = array('type' => 'dir', 'name' => $_dir . $item .'/');
	}else if(is_file($dir . $item) && file_ext($item) == 'css'){
		$files[] = array('type' => 'file', 'name' => $_dir . basename($item, '.css'));
	}
}
closedir($handle);

asort($dirs); 
asort($files);

$json = array_merge($dirs, $files);
unset($dirs, $files);

exit(jsonencode($json));
