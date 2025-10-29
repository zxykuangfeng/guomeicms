<?php
function xss_url($url){
	$temp = strtoupper(urldecode(urldecode($url)));
	$temp = preg_replace('/<\w+(.*?)>(.*?)<\/\w+>/','',$temp);
	$temp = urlencode($temp);
	$temp = str_replace(array('%3D','%26','%3F','%2F','%3A','%23','javascript'),array('=','&','?','/',':','#','sb'),$temp);
	return strtolower($temp);
}