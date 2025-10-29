<?php
defined('PHP168_PATH') or die();

	$date = isset($_GET['date'])?$_GET['date']:date('Y-m-d');
	$w = date('w',strtotime($date));
	
	$w = $P8LANG['week_'.($w?$w:7)];
	$nextdate = date('Y-m-d',time()+86400);
	$config=$this_plugin->get_config(false);
	$department = $date_time = array();
	foreach($config['date_time'] as $v){
		$date_time[$v['code']] = $v['name'];
	}
	foreach($config['department'] as $v){
		$department[$v['code']] = $v['name'];
	}
	$predate = date('Y-m-d',strtotime($date)-86400);
	$nextdate = date('Y-m-d',strtotime($date)+86400);
	$url = $this_plugin->controller;
	$list = array();
	$sql = "SELECT * FROM {$this_plugin->table} WHERE date IN('$date') ORDER BY date DESC, list_order ASC, id ASC";
	$query = $core->DB_master->fetch_all($sql);	
	foreach($query as $row){
		$list[$row['dcode']][] = $row;
	}
	//用数据包含模板取得标签内容
		ob_start();
		include $this_plugin->template('_display');
		$content = ob_get_clean();
	echo $content;

?>
