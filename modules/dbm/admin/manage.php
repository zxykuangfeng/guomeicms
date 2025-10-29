<?php
defined('PHP168_PATH') or die();

/**
* 表管理
**/

$this_controller->check_admin_action('') or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$job = isset($_GET['job']) ? $_GET['job'] : 'backup';
	$sitesd = isset($core->systems['sites']) && $core->systems['sites']['installed']; 
	switch($job){
		case 'restore':
			$list = array();
			$handle = opendir(CACHE_PATH .'db_backup/');
			if($handle === false) {
				$error = error_get_last();
				message($error['message']);
			}
			while(($item = readdir($handle)) !== false){
				if($item == '.' || $item == '..' || !is_dir(CACHE_PATH .'db_backup/'. $item)) continue;
				
				$list[] = $item;
			}
		break;
		case 'optimize': case 'backup':
			$list = $this_module->table_status();
			$info = include $this_module->path .'#.php';
			
			$size = 0;
			foreach($list as $k => $v){
				$a = str_replace($core->CONFIG['table_prefix'], '', $v['Name']);
				$list[$k]['alias'] = isset($info['table_alias'][$a]) ? $info['table_alias'][$a] : '';
				
				$size += $v['Data_length'];
			}
        if(empty($size))$size = $DB_master->getDataSize();
		break;
		case 'execute':
			$config = &$core->CONFIG;
			if(!isset($config['executesql']) || !$config['executesql']) message('executesql_unable');
			include template($this_module, 'execute', 'admin');
			exit();
		break;
		case 'replace':
			$config = &$core->CONFIG;
			if(!isset($config['executesql']) || !$config['executesql']) message('executesql_unable');
			$systems = $core->list_systems();	
			unset($systems['ask']);
			$model = array();
			foreach($systems as $system){		
				if(!$system['enabled']) continue;
				$tmp_sys = $core->load_system($system['name']);
				$models = $tmp_sys->load_module('model');	
				
				$select = select();
				$select->from($models->table, '*');	
				$list = $core->list_item(
					$select,
					array(
						'page_size' => 0,
						'ms' => 'master'
					)
				);
				foreach($list as $item){
					if($item['enabled']) $model[$system['name']]['item'][] = $item;
				}
                $model[$system['name']]['group'] = $system['alias'];
			}
			include template($this_module, 'replace', 'admin');
			exit();
		break;
        case 'flashAutoIncrement':
            $DB_master->flashAutoIncrement();
        break;
        case 'ddl':
            $tb = $_GET['table'];
            print_r( $DB_master->getDDL($tb?:'p8_credit_member'));
            //print_r( $DB_master->getDDL('p8_cms_item_article_addon'));
            // $DB_master->flashAutoIncrement();
            // $DB_master->flashTableAutoIncrement('p8_cms_item','id');
            break;
		case 'query':
		
		break;
	
	}
	include template($this_module, 'list', 'admin');

	
}else if(REQUEST_METHOD == 'POST'){
	
	$action = isset($_POST['act']) ? $_POST['act'] : '';
	$tables = isset($_POST['name']) ? (array)$_POST['name'] : array();
	foreach($tables as $k => $v){
		if( !( $v = trim($this_controller->valid_table_name(basename($v))) ) ){
			unset($tables[$k]);
			continue;
		}
		
		$tables[$k] = $v;
	}
	
	switch($action){
	
	case 'optimize':
		$this_module->optimize_table($tables);
	break;
	
	case 'repair':
		$this_module->repair_table($tables);
	break;
	
	case 'drop':
		$this_module->drop_table($tables);
	break;
	
	case 'truncate':
		$this_module->truncate_table($tables);
	break;
	
	case 'execute':
		$config = &$core->CONFIG;
		if(!isset($config['executesql']) || !$config['executesql']) message('executesql_unable');
		$sql = isset($_POST['sql']) ? p8_stripslashes2($_POST['sql']) : '';
		$sql = preg_replace('!--[^\r\n]*|#[^\r\n]*|/\*[\s\S]*\*/!', '', $sql);
		if(!preg_match('/^select|update|alter|delete/i', $sql) || preg_match('/into\s+outfile/i', $sql)) message('access_denied');
		if(preg_match('/alter|delete/i', $sql) && !$IS_FOUNDER) message('access_denied');
		if(preg_match('/update|delete/i', $sql) && !preg_match('/where/i', $sql)) message('access_denied');
		if($sql) $DB_master->query($sql);
	break;
	
	case 'replace':
		$config = &$core->CONFIG;
        if(!isset($config['executesql']) || !$config['executesql']) message('executesql_unable');
        $_POST = p8_stripslashes2($_POST);
        if(!isset($_POST['model'])) message('model_select');
        $model = explode('|',$_POST['model']);
        $main_table = '';
        $conditon = '';
        if(in_array($model[0],array('cms','sites'))) {
            $main_table = $core->load_system($model[0])->load_module('item')->main_table;
            $search = isset($_POST['search']) ? p8_stripslashes2($_POST['search']) : '';
            $replace = isset($_POST['replace']) ? p8_stripslashes2($_POST['replace']) : '';
            if($main_table && $search && $replace) {
                $table_model = $main_table . '_' . $model[1] . '_';
                $table_addon = $main_table . '_' . $model[1] . '_addon';
                $conditon = isset($_POST['conditon']) && !empty($_POST['conditon']) ? ' WHERE '.p8_stripslashes2($_POST['conditon']) . " AND `model`='$model[1]'" : " WHERE `model`='$model[1]'";
                $fields_main = array(array('Field'=>'title'),array('Field'=>'sub_title'),array('Field'=>'summary'));
                $fields_addon = array(array('Field'=>'addon_title'),array('Field'=>'content'),array('Field'=>'addon_summary'));

                $this_module->table_replace(array($main_table), $search, $replace, $fields_main, $conditon);
                $this_module->table_replace(array($table_model), $search, $replace, $fields_main, $conditon);
                $this_module->table_replace(array($table_addon), $search, $replace, $fields_addon);
            }
        }else{
            message('fail');
        }
    break;

	case 'unlock':
		//解锁
		$tid = $CACHE->read($SYSTEM .'/modules/', $MODULE, 'backup_lock','serialize');
		$CACHE->delete($SYSTEM .'/modules/'. $MODULE, 'task', $tid);
		$CACHE->delete($SYSTEM .'/modules/', $MODULE, 'backup_lock');
        message('done', $core->admin_controller.'/core/dbm-manage');
	break;
	
	case 'sql':
        
		$sql = isset($_POST['sql']) ? p8_stripslashes2(base64_decode($_POST['sql'])) : '';
		$sql = preg_replace('!--[^\r\n]*|#[^\r\n]*|/\*[\s\S]*\*/!', '', $sql);
		//危险的,你懂的
		if(!preg_match('/^select|update|alter|delete/i', $sql) || preg_match('/into\s+outfile/i', $sql)) message('access_denied');
		if(preg_match('/alter|delete/i', $sql) && !$IS_FOUNDER) message('access_denied');
		if(preg_match('/update|delete/i', $sql) && !preg_match('/where/i', $sql)) message('access_denied');
		
		$list = $DB_master->fetch_all($sql);
		$fields = array();
		foreach($list as $v){
			foreach($v as $field => $vv) $fields[] = $field;
			break;
		}
		
		include template($this_module, 'sql', 'admin');
		exit;
	break;
	
	}
	
	message('done', HTTP_REFERER);
	
}
