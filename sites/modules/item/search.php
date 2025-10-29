<?php
defined('PHP168_PATH') or die();

/**
* 内容搜索
**/
$this_controller->check_action($ACTION) or message('no_privilege');
//关键字
$keyword = isset($_GET['keyword']) ? p8_stripslashes2(trim($_GET['keyword'])) : '';
$keyword = $keyword ? $keyword : (isset($_GET['word']) ? p8_stripslashes2(trim($_GET['word'])) : '');

$url = $core->domain ? $core->domain : str_replace('index.php','',$core->controller);
$url .= (substr($url,-1) == '/' ? '' : '/').'search/index.html?word='.$keyword.'&site='.$this_system->SITE;
header("location:{$url}");
exit;
