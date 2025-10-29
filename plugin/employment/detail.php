<?php
defined('PHP168_PATH') or die();
	$TITLE="就业日历_".date("Y年m月").'_就业宣讲安排';
	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$page = max(1, $page);
	$page_url = $this_url .'?page=?page?';
	$page_param= array();
	
	
	$date_time = p8_json($date_time);
	$list = $mon_list = array();
	$select = select();
	$select->from($this_plugin->table, 'date');
	//没时间，则以当天为准
	//var_dump($_REQUEST['date']);
	$today = $_REQUEST['date'] = $_REQUEST['date'] ?: date("Y-m-d");
	$firstDay = date('Y-m-01',strtotime($today));
	$lastDay = date('Y-m-d',strtotime("$firstDay + 1 month -1 day"));
	$today_array = explode('-',$today);	
	if(!empty($_REQUEST['date'])){
		$date = $_REQUEST['date'];
		$select->in('date',$date);
		$page_param['date'] = $date;
	}
	if(!empty($_GET['name'])){
		$name = $_GET['name'];
		$select->like('name',$name);
		$page_param['name'] = $name;
	}
	
	$select->order('date DESC');
	$count = $core->DB_master->fetch_one($select->build_count_sql());
	$count = $count['num'];
	$select->group('date');
	$_list = $core->list_item(
		$select,
		array(
			'page' => &$page,
			'count' => &$count,
			'page_size' => 20
		)
	);
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
	//echo $select->build_sql();
	$dat = $split = '';
	//var_dump($_list);exit;
	
	if(!empty($_list)){
		$dat = $split = '';
		foreach($_list as $d){
			$dat .= $split."'{$d['date']}'";
			$split = ',';
		}		
		$sql = "SELECT * FROM {$this_plugin->table} WHERE date IN($dat) ORDER BY date DESC, list_order ASC, id ASC";
		$query = $core->DB_master->fetch_all($sql);
		
		foreach($query as $row){
			$list[$row['date']][] = $row;
		}
	}	
	//var_dump($date_time_json);
	if($page_param){
		$page_param = http_build_query($page_param);
		$page_url .=(strpos($page_url,'?')===false? '?':'&').$page_param;
	}
	
	$pages = list_page(array(
			'count' => $count,
			'page' => $page,
			'page_size' => 5,
			'url' => $page_url
		));
	$SYSTEM = 'core';
	$json = array(
		'list' => $list,
		'mon_list' => $mon_list,
	);
	if(REQUEST_METHOD == 'POST')
		exit(jsonencode($json));
	else
		include $this_plugin->template('detail');

?>
