<?php
defined('PHP168_PATH') or die();

//$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'POST'){
	set_time_limit(0);
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$page = max(1, $page);
	$iid = isset($_POST['iid'])? intval($_POST['iid']) : 0;
	$item = $this_module->get_item($iid);
	$titles = $this_module->get_titles($iid);
	//var_dump($titles);echo "<br>";echo "<br>";
	$count = 0;
	$select = select();
	$select -> from($this_module->data_table.' AS d','d.*');
	$select -> left_join($this_module->table.' AS i','i.title as item_title', ' i.id=d.iid');
	if($iid)$select->in('d.iid',$iid);
	$select -> order('id DESC');
	//echo $select->build_sql();exit;
	$list = $core->list_item($select, array(
			'page' => &$page,
			'count' => &$count,
			'page_size' => 1000
		)
	);
	foreach($list as $key=>$value){
		$datas = $this_module->get_data($value['id']);
		$data = $datas['data'];
		$addon = $datas['addon'];
		
		unset($list[$key]['iid']);
		unset($list[$key]['status']);
		unset($list[$key]['item_title']);
		$list[$key]['timestamp'] = date('Y-m-d H:i:s',$value['timestamp']);
		foreach($titles as $title){
			if($title['type']=='radio' || $title['type']=='select'){
				if(is_array($title['data'][$addon[$title['id']]['data']])){
					$list[$key][$title['id']] = $title['data'][$addon[$title['id']]['data']][0];
				}else{
					$list[$key][$title['id']] = $title['data'][$addon[$title['id']]['data']];
				}
			}else if($title['type']=='checkbox'){
				$list[$key][$title['id']] =  '';
				$div = '';
				foreach($title['data'] as $title_key=>$val){
					$asw = explode(',',$addon[$title['id']]['data']);
					if(!in_array($title_key,$asw))continue;
					$list[$key][$title['id']] .= $div.(is_array($val) ? $val[0] : $val);
					$div = ',';
				}
			}else if($title['type']=='text' || $title['type']=='area'){
				$list[$key][$title['id']] = $addon[$title['id']]['data'];
			}			
		}		
	}
	$head = array(
		'id'=>'id',		
		'uid' => $P8LANG['uid'],
		'name'=> $P8LANG['username'],
		'tel' => $P8LANG['phone'],
		'mobile' => $P8LANG['cell_phone'],
		'ip' => $P8LANG['ip'],
		'timestamp' => $P8LANG['timestamp']	
	);
	foreach($titles as $title){
		$head[$title['id']] = $title['tittle'];
	}
	array_unshift($list,$head);
	$list = convert_encode("UTF-8","GB2312",$list);
	require PHP168_PATH.'/inc/csv.class.php';
	$filename = 'survey-'.date('Y-m-d', P8_TIME).'-'.$iid.'-('.$page.').csv';
	$csv = new P8_Csv();
	$csv->data = $list;
	$csv->file = 'php://output';
	header("Content-type:application/vnd.ms-excel;charset=UTF-8");
	header('Last-Modified: '. gmdate('D, d M Y H:i:s', P8_TIME) .' GMT');
	header('Pragma: no-cache');
	header('Content-type: text/csv');
	header('Content-Encoding: none');
	header('Content-Disposition: attachment; filename='. $filename);
	header('Content-type: csv');
	$csv->save();
	exit;
}