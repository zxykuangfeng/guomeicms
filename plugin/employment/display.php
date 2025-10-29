<?php
defined('PHP168_PATH') or die();
	$list = $mon_list = array();
	//没时间，则以当天为准
	//var_dump($_REQUEST['date']);
	$today = $_REQUEST['date'] = $_REQUEST['date'] ?: date("Y-m-d");
	$firstDay = date('Y-m-01',strtotime($today));
	$lastDay = date('Y-m-d',strtotime("$firstDay + 1 month -1 day"));
	$today_array = explode('-',$today);	
	
	$select_mon = select();
	$select_mon->from($this_plugin->table, '*');
	$select_mon->range('date',$firstDay,$lastDay);
	$select_mon->order('date DESC,id ASC');
	$m_list = $core->list_item($select_mon);
	
	//echo $select_mon->build_sql();
	//var_dump($m_list);
	foreach($m_list as $item){
		$mon_list[$item['date']][] = $item;
	}
	$dat = $split = '';
	//var_dump($_list);exit;
	$SYSTEM = 'core';
	$json = array(
		'list' => array(),
		'mon_list' => $mon_list,
	);
	if(REQUEST_METHOD == 'POST')
		exit(jsonencode($json));
	else
		include $this_plugin->template('_display');
?>