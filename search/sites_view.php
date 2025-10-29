<?php
$realpath = str_replace(array('\\\\', '\\'), '/', dirname(__FILE__));
$site = isset($_GET['site']) ? p8_stripslashes2(xss_clear($_GET['site'])) : '';
$data['count'] = 0;

if($site){	
	$farm_all_file = $realpath .'/../data/sites/modules/farm/farm_all.php';
	if(file_exists($farm_all_file)) {
		$allsites = include $farm_all_file;
		if(!empty($allsites) && array_key_exists($site,$allsites)){						
			$db_config = include $realpath .'/../data/config.php';
			$db_config['DB_master'] or exit('');
			$core_config = include $realpath .'/../data/core/core.php';
			$mysql_connect_charset = isset($core_config['mysql_charset']) ? $core_config['mysql_charset']: 'utf8';
			$mysql_connect_port = isset($db_config['DB_master']['port']) ? $db_config['DB_master']['port']: 3306;
			require $realpath .'/../inc/mysqli.class.php';
			$DB_master = new P8_mysqli(
				$db_config['DB_master']['host'].':'.$mysql_connect_port,
				$db_config['DB_master']['user'],
				$db_config['DB_master']['password'],
				$db_config['DB_master']['db'],
				$mysql_connect_charset,
				$mysql_connect_port,
				$db_config['DB_master']['pconnect']
			);
			$statistic_views = $db_config['table_prefix'].'cms_statistic_sites_views';
			$beginToday = mktime(0,0,0,date('m'),date('d'),date('Y'));
			$data = $DB_master->fetch_one("select sum(count) as `count` from ".$statistic_views." where `site`='$site' and `timestamp`='$beginToday'");
			$data['count'] = $data['count'] > 0 ? $data['count'] : 0;
		}
	}	
}
/**
* 根据环境去掉转义\
**/
function p8_stripslashes2($string){
	return (phpversion()<8? get_magic_quotes_gpc():false) ? p8_stripslashes($string) : $string;
}
/**
* 去掉转义\
**/
function p8_stripslashes($string){
	if(!is_array($string)) return stripslashes($string);	
	foreach($string as $k => $v)
		$string[$k] = p8_stripslashes($v);
	return $string;
}
function p8_html_filter($string, $allow_tags = array(), $disallow_tags = array()){
	global $realpath;
    if(!in_array('script',$allow_tags)){
        $string = clear_script($string);
    }
	require_once $realpath .'/../inc/drupal_xss.func.php';
	
	return filter_xss($string, (array)$allow_tags, (array)$disallow_tags);
}
function xss_clear($str){
	$temp = p8_html_filter($str);
	$temp = preg_replace('/[^\w_-]*/','',$temp);
	return $temp;
}
function clear_script($str){
   return preg_replace('/<script[^>]*>[^<]+<\/script>/','',$str);
}
header('Content-Type:application/javascript;charset=UTF-8');
exit('
$(function(){
	$(\'.site_views\').each(function(){$(this).html('. $data['count'] .')});
});
');