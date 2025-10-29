<?php
defined('PHP168_PATH') or die();

/**
* 供前台有权限的返回后台入口,JSONP形式,可以跨域
**/

$IS_ADMIN or exit('');

//HTTP_REFERER;
$callback = isset($_GET['callback']) ? xss_clear(clear_special_char($_GET['callback'])) : '';
$callback = preg_replace('/[^\w_]*/','',$callback);
exit(isset($_GET['callback']) && $callback ? $callback .'("'. $core->CONFIG['admin_controller'] .'")' : '');
