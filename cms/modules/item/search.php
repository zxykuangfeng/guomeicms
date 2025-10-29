<?php
defined('PHP168_PATH') or die();

/**
* CMS内容搜索
**/
$this_controller->check_action($ACTION) or message('no_privilege');
//关键字
$keyword = isset($_GET['keyword']) ? p8_stripslashes2(trim($_GET['keyword'])) : '';
$keyword = $keyword ? $keyword : (isset($_GET['word']) ? p8_stripslashes2(trim($_GET['word'])) : '');
$url = $this_system->domain ? $this_system->domain : str_replace('index.php/cms','',$this_system->controller);
$url .= (substr($url,-1) == '/' ? '' : '/').'search/index.html?word='.$keyword;
header("location:{$url}");
exit;
