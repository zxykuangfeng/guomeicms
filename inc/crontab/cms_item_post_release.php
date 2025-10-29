<?php
defined('PHP168_PATH') or die();

/**
* CMS 定时发布
**/
$system = &$core->load_system('cms');
$item = &$system->load_module('item');
$now = time();
$query = $DB_slave->query("SELECT id FROM $item->unverified_table WHERE verified = '66' and `timestamp`< $now ORDER BY timestamp ASC LIMIT 10");
$comma = $ids = '';
while($arr = $DB_slave->fetch_array($query)){
	$id = $arr['id'];
	if($DB_master->fetch_one("select `id` from $item->main_table where `id` = $id")){
		$DB_master->delete($item->unverified_table,"id = $id");		
	}else{
		$ids .= $comma . $id;
		$comma = ',';
	}
}
if(empty($ids)) return;
$data = array(
    'where' => $item->unverified_table.'.id IN ('.$ids.')',
    'value' => 1,
    'verified' => 0,
    'verify' => 1,
    'relase' => 1,
);
//强制解锁
$CACHE->delete('core/modules/', 'crontab', 'lock');
$item->verify($data);