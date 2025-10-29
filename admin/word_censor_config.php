<?php
defined('PHP168_PATH') or die();
@set_time_limit(0);
$this_controller->check_admin_action($ACTION) or message('no_privilege');

$word_censor_table = $core->TABLE_.'word_censor';

if(REQUEST_METHOD == 'GET'){
	
	$type = isset ($_GET['type']) ? $_GET['type'] : '';
	$config = $core->get_config('core', '');
	switch ($type) {

		case 'import' : //导入数据
			include template($this_system, 'word_filter_import', 'admin');
			break;

		case 'export' : //导出数据

			$select = select();
			$select->from("{$core->TABLE_}word_censor_filter");
			$filter_words = $core->list_item($select);

			$export_content = '';

			foreach ($filter_words as $filter_word) {
				$export_content .= $filter_word['filter_word'] . "\r\n";
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
			$keyword = isset ($_GET['word']) ? trim($_GET['word']) : '';
			$page_url .= "&word=$keyword";

			$page = isset ($_GET['page']) ? intval($_GET['page']) : 1;
			$page = max(1, $page);
			$count = 0;
			$page_size = 20;

			$select = select();
			$select->from("{$core->TABLE_}word_censor_filter", '*');
			if($keyword) $select->like('filter_word', $keyword);

			$filter_words = $core->list_item($select, array (
				'page' => & $page,
				'count' => & $count,
				'page_size' => $page_size
			));

			$pages = list_page(array (
				'count' => $count,
				'page' => $page,
				'page_size' => $page_size,
				'url' => $page_url
			));

			$sql = "show tables LIKE '$word_censor_table'";
			$ret = $DB_master->fetch_all($sql);
			if(empty($ret)) message('word_censor_table_err');
			$config = $core->get_config('core','');
			
			include template($this_system, 'syscheck/'.$ACTION, 'admin');
	
	}
	
	
	
}else if(REQUEST_METHOD == 'POST'){
	
	$type = isset ($_POST['type']) ? $_POST['type'] : '';

	switch ($type) {
		case 'del' :

			$id = isset ($_POST['id']) ? filter_int($_POST['id']) : array ();
			$id or exit ('[]');
			if ($DB_master->query("DELETE FROM {$core->TABLE_}word_censor_filter WHERE id IN (" . implode(',', $id) . ")")) {
				exit (jsonencode($id));
			}
			exit ('[]');
			break;
		case 'config' : //配置
			$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();	
			$core->set_config($config);	
			break;

		case 'import' :

			isset ($_FILES['word_data']) or message('error');
			$file = clean_path(p8_filter_special_chars($_FILES['word_data']['tmp_name']));
			$file or message('error');
			if (strtolower(file_ext($_FILES['word_data']['name'])) != 'txt' && $_FILES['word_data']['error'] > 0 || 'text/plain' != $_FILES['word_data']['type'] || ($_FILES['word_data']['size'] / 1024) > 10000) {
				message('error');
			}			
			$content = file($file);
			
			$table = "{$core->TABLE_}word_censor_filter";
			//$datas = array();
			foreach ($content as $value) {
				if(!empty(trim($value))){
					$datas = array();
					$datas[] = array (
						'filter_word' => trim($value)
					);
					$DB_master->insert($table, $datas, array (
						'multiple' => array (
							'filter_word'
						)
					));
				}
			}
			break;

		default :
			$new_name = isset($_POST['new_name']) ? array_map('html_entities', array_map('trim', (array)$_POST['new_name'])) : array();
			foreach($new_name as $id => $name){
				$id = intval($id);
				if(!$id || !$name) continue;
				
				$DB_master->update(
					$core->TABLE_ .'filter_word',
					array(
						'filter_word' => $name
					),
					"id = '$id'"
				);
			}
			
			
			
			
			
			$word = isset($_POST['word']) ? array_map('html_entities', array_map('trim', (array)$_POST['word'])) : array();
			
			foreach($word as $v){
				if(!$v) continue;
				
				$DB_master->insert(
					$core->TABLE_ .'word_censor_filter',
					array(
						'filter_word' => $v
					)
				);
			}
		break;
	}
	
	$query = $DB_master->query("SELECT * FROM {$core->TABLE_}word_censor_filter");
	$filter = $comma = '';
	while($arr = $DB_master->fetch_array($query)){
		$filter .= $comma . $arr['filter_word'];
		$comma = '|';
	}
	$filter = $filter ? '/('. $filter .')/i' : '';
	
	$CACHE->write('', $core->name, 'word_censor_filter', $filter);
	
	message('done', $this_url);
	
}