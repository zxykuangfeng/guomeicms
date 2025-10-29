<?php
defined('PHP168_PATH') or die();
	$TITLE="值班日历_".date("Y年m月").'_值班表';
	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$page = max(1, $page);
	$page_url = $this_url .'?page=?page?';
	$page_param= array();
	
	
	$date_time = p8_json($date_time);

	$select = select();
	$select->from($this_plugin->table, 'date');
	//没时间，则以当天为准
	$today = $_REQUEST['date'] = $_REQUEST['date'] ?: date("Y-m-d");
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
			'page_size' => 5
		)
	);
	//echo $select->build_sql();
	$dat = $split = '';
	//var_dump($_list);exit;
	$list = array();
	if(!empty($_list)){
		$dat = $split = '';
		foreach($_list as $d){
			$dat .= $split."'{$d['date']}'";
			$split = ',';
		}		
		$sql = "SELECT * FROM {$this_plugin->table} WHERE date IN($dat) ORDER BY date DESC, list_order ASC, id ASC";
		$query = $core->DB_master->fetch_all($sql);
		
		foreach($query as $row){
			$list[$row['dcode']][] = $row;
		}
	}
	$config=$this_plugin->get_config(false);
	$department = $date_time = array();
	foreach($config['date_time'] as $v){
		$date_time[$v['code']] = $v['name'];
	}
	foreach($config['department'] as $v){
		$department[$v['code']] = $v['name'];
	}
	$department_json = p8_json($department);
	$date_time_json = p8_json($date_time);
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
	if(REQUEST_METHOD == 'POST')
		exit(jsonencode($list));
	else
		include $this_plugin->template('detail');

?>
