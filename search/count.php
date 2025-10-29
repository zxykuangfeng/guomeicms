<?php

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$id or exit('');
$realpath = str_replace(array('\\\\', '\\'), '/', dirname(__FILE__));
$db_config = include $realpath .'/../data/config.php';
$db_config['DB_master'] or exit('');
$core_config = include $realpath .'/../data/core/core.php';
$mysql_connect_charset = isset($core_config['mysql_charset'])?$core_config['mysql_charset']: 'utf8';
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
$system_main_table = $db_config['table_prefix'].'cms_item';
$statistic_views = $db_config['table_prefix'].'cms_statistic_views';
$data = $DB_master->fetch_one("SELECT cid, views, comments, model FROM $system_main_table WHERE id = '$id'");
$data or exit('');
$model_main_table = $db_config['table_prefix'].'cms_item_'.$data['model'].'_';
if(
	$DB_master->update(
		$system_main_table,
		array('views' => 'views +1'),
		"id = '$id'",
		false
	)
){
	
	$DB_master->update(
		$model_main_table,
		array('views' => 'views +1'),
		"id = '$id' ",
		false
	);
	$cid = $data['cid'];
	$today = mktime(0,0,0,date('m'),date('d'),date('Y'));
	$ret = $DB_master->update(
		$statistic_views,
		array('count' => 'count +1'),
		"cid = '$cid' and timestamp = '$today'",
		false
	);
	if(!$ret){
		$DB_master->insert(
			$statistic_views,
			array('cid'=> $cid, 'timestamp'=> $today, 'count' => 1)
		);
	}
}
header('Content-Type:application/javascript;charset=UTF-8');
exit('
$(function(){
	$(\'.item_views\').each(function(){$(this).html('. $data['views'] .')});
	$(\'.item_comments\').each(function(){$(this).html('. $data['comments'] .')});
});
');