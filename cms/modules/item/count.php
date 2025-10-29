<?php
defined('PHP168_PATH') or die();

/**
* 内容查看次数
**/

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$id or exit('');

$data = $DB_slave->fetch_one("SELECT cid, views, comments, model FROM $this_module->main_table WHERE id = '$id'");
$data or exit('');
$statistic_views = $core->TABLE_.'cms_statistic_views';
$newViews = $data['views'] +1;
if(
	$DB_master->update(
		$this_module->main_table,
		array('views' => $newViews),
		"id = '$id'",
		false
	)
){
	
	$this_module->set_model($data['model']);
	
	$DB_master->update(
		$this_module->table,
		array('views' => $newViews),
		"id = '$id'",
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

exit('
$(function(){
	$(\'.item_views\').html('. $data['views'] .');
	$(\'.item_comments\').html('. $data['comments'] .');
});
');
