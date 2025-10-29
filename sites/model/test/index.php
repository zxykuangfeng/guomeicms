<?php
/**
* 绑定模型的二级或一级域名
**/

// /index.php/cms/item-list-[model]-category-1-id-2

if(!preg_match("/^\/index.php/", $_SERVER['REQUEST_URI'])){
	//如果不是绑定域名
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: index.html');
	exit;
}

//子域名
$sub_domain = basename($_SERVER['SERVER_NAME'], '.168news.com');

$file = str_replace(array('\\', '\\\\'), '/', __FILE__);

$model = basename(dirname($file));
$module = 'item';
$system = 'cms';

$_SERVER['REQUEST_URI'] = preg_replace("/^\/index.php\/?/", '', $_SERVER['REQUEST_URI']);

if(preg_match("/^\-([^\-]+)\-?/", $_SERVER['REQUEST_URI'])){
	//$_SERVER['REQUEST_URI'] = preg_replace("/^\-([^\-]+)\-?/", "-\\1-$model-", $_SERVER['REQUEST_URI']);
}else{
	//如果没有动作,绑定了域名,转到首页
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: index.html');
	exit;
}


$_SERVER['REQUEST_URI'] = '/index.php/'. $SYSTEM .'/'. $MODULE . $_SERVER['REQUEST_URI'];

$_SERVER['SCRIPT_NAME'] = '/index.php';

require '../../index.php';
?>
