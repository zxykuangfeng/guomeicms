<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');
$_GET = p8_stripslashes2($_GET);
$table = $core->TABLE_.'filter_word';
if (REQUEST_METHOD == 'GET') {
	$type = isset ($_GET['type']) ? $_GET['type'] : '';
	$config = $core->get_config('core', '');
	switch ($type) {

		case 'import' : //导入数据
			include template($this_system, 'syscheck/word_filter_import', 'admin');
			break;

		case 'export' : //导出数据

			$select = select();
			$select->from("{$table} as i","i.filter_word");
			$select->left_join("{$table} as d",'d.filter_word as right_word','i.id=d.aid');
			$select->in('i.type',1);
			$filter_words = $core->list_item($select);

			$export_content = '';

			foreach ($filter_words as $filter_word) {
				$export_content .= $filter_word['filter_word'];
				if($filter_word['right_word']) $export_content .= '||'.$filter_word['right_word'];
				$export_content .= "\r\n";
			}

			header('Last-Modified: ' . gmdate('D, d M Y H:i:s', P8_TIME) . ' GMT');
			header('Cache-control: no-cache');
			header('Content-Encoding: none');
			header('Content-Disposition: attachment; filename="' . P8_TIME . '.txt"');
			header('Content-type: txt');
			header('Content-Length: ' . strlen($filter_words));

			echo $export_content;
			exit;
			break;

		default :
			$page_url = $this_url . '?page=?page?';
			$filter_words = array ();
			$keyword = isset($_GET['word']) ? trim($_GET['word']) : '';
			$page_url .= "&word=$keyword";

			$page = isset ($_GET['page']) ? intval($_GET['page']) : 1;
			$page = max(1, $page);
			$count = 0;
			$page_size = 20;

			$select = select();
			$select->from("{$table} AS m", 'm.id,m.filter_word,m.aid');
			$select->left_join("{$table} AS a", 'a.filter_word as right_word', 'a.aid = m.id');
			$select->in('m.type',1);
			if($keyword) $select->like('m.filter_word', $keyword);
			//echo $select->build_sql();
			$filter_words = $core->list_item($select, array (
				'page' => &$page,
				'count' => &$count,
				'page_size' => $page_size
			));
			$pages = list_page(array (
				'count' => $count,
				'page' => $page,
				'page_size' => $page_size,
				'url' => $page_url
			));

			include template($this_system, 'syscheck/word_filter', 'admin');
	}
} elseif (REQUEST_METHOD == 'POST') {
	
	$type = isset ($_POST['type']) ? $_POST['type'] : '';

	switch ($type) {
		case 'del' :

			$id = isset ($_POST['id']) ? filter_int($_POST['id']) : array ();
			$id or exit ('[]');
			if ($DB_master->query("DELETE FROM {$table} WHERE id IN (" . implode(',', $id) . ") or aid IN (" . implode(',', $id) . ")")) {
				
				$query = $DB_master->query("SELECT * FROM {$table} where `type` = 1");
				$filter = $comma = '';
				while($arr = $DB_master->fetch_array($query)){
					$filter .= $comma . $arr['filter_word'];
					$comma = '|';
				}
				$filter = $filter ? '/('. $filter .')/i' : '';
				
				$CACHE->write('', $core->name, 'word_filter', $filter);
				
				$query = $DB_master->query("SELECT m.id,m.filter_word,m.aid,a.filter_word as right_word FROM `{$table}` AS `m` LEFT JOIN `{$table}` AS `a` ON a.aid = m.id WHERE m.type = '1'");
				$filter =  array();
				while($arr = $DB_master->fetch_array($query)){
					$filter['filter_word'][$arr['id']] = $arr['filter_word'];
					$filter['right_word'][$arr['id']] = $arr['right_word'];
				}
				$CACHE->write('', $core->name, 'word_filter_right', $filter);
				exit (jsonencode($id));
			}
			exit ('[]');
			break;
		case 'config' : //配置
			$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();	
			$config['filter_word_enable'] = empty($config['filter_word_enable']) ? 0 :1;			
			//词组
			$config['filter_word_group'] = array();
			$filter_word_group = isset($_POST['filter_word_group']) && $_POST['filter_word_group'] ? $_POST['filter_word_group'] : array();
			if($filter_word_group){
				$delete = isset($_POST['delete'])? $_POST['delete'] : array();	
				if(!empty($delete)){
					foreach($delete as $v){
						unset($filter_word_group['filter_word'][$v]);
					}
				}
				foreach($filter_word_group['filter_word'] as $k=>$v){
					if($v){
						$config['filter_word_group'][$k]['filter_word'] = html_entities(trim($v));
						$config['filter_word_group'][$k]['nofilter_word'] = $nv = html_entities(trim($filter_word_group['nofilter_word'][$k]));
						$DB_master->query("DELETE FROM {$table} WHERE type = '1' and (`filter_word` = '$v' or `filter_word` = '$nv')");
					}
				}
				
			}
			$core->set_config($config);	
			break;

		case 'import' :

			isset($_FILES['word_data']) or message('error');
			$file = clean_path(p8_filter_special_chars($_FILES['word_data']['tmp_name']));
			$file or message('error');
			if (strtolower(file_ext($_FILES['word_data']['name'])) != 'txt' && $_FILES['word_data']['error'] > 0 || 'text/plain' != $_FILES['word_data']['type'] || ($_FILES['word_data']['size'] / 1024) > 10000) {
				message('error');
			}
			$content = file($file);
			$config = $core->get_config('core', '');
			$filter_word_config = array();
			foreach($config['filter_word_group'] as $v){
				$filter_word_config[] = $v['filter_word'];
			}
			//$datas = array();
			foreach ($content as $value) {
				$values = explode('||',$value);
				$value = trim($values[0]);
				$right_word = isset($values[1]) && $values[1] ? trim($values[1]) : '';
				//if($filter_word_config && in_array(trim($value),$filter_word_config)) continue;
				$ret = $DB_master->fetch_one("SELECT * FROM {$table} where `type` = 1 and `filter_word` = '$value'");
				if(!empty($ret)) continue;
				if(!empty($value)){
					$datas = array();
					$datas[] = array (
						'filter_word' => $value
					);
					$rid = $DB_master->insert($table, $datas, array (
						'multiple' => array (
							'filter_word'
						),
						'return_id' => true,
					));
					if($rid && !empty($right_word)){
						$DB_master->insert(
							$table,
							array(
								'filter_word' => $right_word,
								'aid' => $rid,
								'type' => 0,
							)							
						);
					}
				}
			}
			/*
			if(!empty($datas)){
				if (false == $DB_master->insert($table, $datas, array (
						'multiple' => array (
							'filter_word'
						)
					))) {
					message('fail');
				}
			}
			*/
			break;

		default :
			$new_name = isset($_POST['new_name']) ? array_map('html_entities', array_map('trim', (array)$_POST['new_name'])) : array();
			$config = $core->get_config('core', '');
			$filter_word_config = array();
			foreach($config['filter_word_group'] as $v){
				$filter_word_config[] = $v['filter_word'];
			}
			foreach($new_name as $id => $name){
				$id = intval($id);
				if(!$id || !$name) continue;
				if($filter_word_config && in_array($name,$filter_word_config)){
					$DB_master->delete($table, "id = '$id'");
				}else{
					$ret = $DB_master->fetch_one("SELECT count(*) as count FROM {$table} where `type` = 1 and `filter_word` = '$name'");
					if($ret && $ret['count']>0) continue;
					$DB_master->update(
						$table,
						array(
							'filter_word' => $name,
							'aid' => $id,
							'type' => 1,
						),
						"id = '$id'"
					);
				}
			}
			$new_right_word = isset($_POST['new_right_word']) ? array_map('html_entities', array_map('trim', (array)$_POST['new_right_word'])) : array();
			foreach($new_right_word as $aid => $name){
				$aid = intval($aid);
				if(!$aid) continue;
				if($name){
					$ret = $DB_master->update(
						$table,
						array(
							'filter_word' => $name,
							'aid' => $aid,
							'type' => 0,
						),
						"aid = '$aid'"
					);
					if(!$ret){
						$DB_master->insert(
							$table,
							array(
								'filter_word' => $name,
								'aid' => $aid,
								'type' => 0,
							)
						);
					}
				}else{
					$DB_master->delete($table, "aid = '$aid'");
				}				
			}			
					
			$word = isset($_POST['word']) ? array_map('html_entities', array_map('trim', (array)$_POST['word'])) : array();
			//正确词语
			$right_word = isset($_POST['right_word']) ? array_map('html_entities', array_map('trim', (array)$_POST['right_word'])) : array();
			foreach($word as $k=>$v){
				$v = trim($v);
				if(!$v) continue;
				if($filter_word_config && in_array(trim($v),$filter_word_config)) continue;				
				$ret = $DB_master->fetch_one("SELECT count(*) as count FROM {$table} where `type` = 1 and `filter_word` = '$v'");
				if($ret && $ret['count']>0) continue;					
				$iid = $DB_master->insert(
					$table,
					array(
						'filter_word' => $v,
						'aid' => 0,
						'type' => 1,
					),
					array(
						'return_id' => true,
					)
				);
				//正确词语
				if(!$iid || !$right_word[$k]) continue;
				$DB_master->insert(
					$table,
					array(
						'filter_word' => $right_word[$k],
						'aid' => $iid,
						'type' => 0,
					)
				);
			}
		break;
	}
	
				
	$query = $DB_master->query("SELECT * FROM {$table} where `type` = 1");
	$filter = $comma = '';
	while($arr = $DB_master->fetch_array($query)){
		$filter .= $comma . $arr['filter_word'];
		$comma = '|';
	}
	/*
	$comma = $filter ? '|' : '';	
	$config = $core->get_config('core', '');
	$filter_word_config = array();
	foreach($config['filter_word_group'] as $v){
		$filter .= $comma . $v['filter_word'];
		$comma = '|';		
	}
	*/
	$filter = $filter ? '/('. $filter .')/i' : '';
	
	$CACHE->write('', $core->name, 'word_filter', $filter);
	
	$query = $DB_master->query("SELECT m.id,m.filter_word,m.aid,a.filter_word as right_word FROM `{$table}` AS `m` LEFT JOIN `{$table}` AS `a` ON a.aid = m.id WHERE m.type = '1'");
	$filter =  array();
	while($arr = $DB_master->fetch_array($query)){
		$filter['filter_word'][$arr['id']] = $arr['filter_word'];
		$filter['right_word'][$arr['id']] = $arr['right_word'];
	}
	$CACHE->write('', $core->name, 'word_filter_right', $filter);
	
	message('done', $this_url);
}
