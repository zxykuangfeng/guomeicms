<?php
defined('PHP168_PATH') or die();

/**
* 表管理
**/

//$this_controller->check_admin_action('') or message('no_privilege');

if(REQUEST_METHOD == 'GET'){

	$list = array();
	$handle = opendir(CACHE_PATH .'db_backup_sites/'.$this_system->SITE.'/');
	if($handle){
		while(($item = readdir($handle)) !== false){
			if($item == '.' || $item == '..' || !is_dir(CACHE_PATH .'db_backup_sites/'.$this_system->SITE.'/'. $item)) continue;
			
			$list[] = array($item,authcode_token($item,'INCODE',0,true));
		}
	}
	//站点信息
	$site = !empty($_GET['site']) ? $_GET['site'] : $_GET['alias'];	
	$site = in_array(clear_special_char($site),array_keys($this_system->sites)) ? clear_special_char($site) : $this_system->SITE;	
	$site_info = $this_system->get_site($site);		
	include template($this_module, 'dbm', 'admin');

}else if(REQUEST_METHOD == 'POST'){
	$action = isset($_POST['act']) ? $_POST['act'] : '';
	if($action=='backup'){
				
		function _poster($msg = ''){
			global $this_url, $P8LANG;
			
			$fields = '';
			foreach($_POST as $k => $v){
				$fields .= '<input type="hidden" name="'. $k .'" value="'. $v .'" />';
			}
			
			$form = <<<EOT
$msg
<form action="$this_url" method="post" id="form">
$fields
</form>
<script type="text/javascript">
setTimeout(function(){ document.getElementById('form').submit(); }, 1);
</script>
EOT;
			message($form);
		}



		if(empty($_POST['tid'])){
			
			//锁定中
			if($CACHE->read($SYSTEM .'/modules/', $MODULE, 'backup_lock_'.$this_system->SITE, 'serialize')){
				message('dbm_backup_locked');
			}
			
			//初始化
			$tables = $this_module->table_status();
			$tid = unique_id(16);
			$charset = !empty($_POST['charset']) ? basename($_POST['charset']) : $core->CONFIG['page_charset'];
			if(isset($_POST['rows'])){
				$rows = intval($_POST['rows']);
				$rows = max(1, $rows);
			}else{
				$rows = 50;
			}
			
			$task = array(
				'start_time' => P8_TIME,
				'site' => $this_system->SITE,
				'offset' => 0,
				'table_offset' => 0,
				'file_offset' => 0,
				'rows' => $rows,
				'prefix' => isset($_POST['prefix']) ? basename($_POST['prefix']) : '',
				'charset' => $charset,
				'path' => 'db_backup_sites/'.$this_system->SITE.'/'. date('Y-m-d#H_i(', P8_TIME) . $charset .')',
				'tables' => $tables
			);
			
			$_POST['tid'] = $tid;
			
				
			md(CACHE_PATH . $task['path']);
			
			$CACHE->write($SYSTEM .'/modules/'. $MODULE, 'task', $tid, $task, 'serialize');
			
			//加锁
			$CACHE->write($SYSTEM .'/modules/', $MODULE, 'backup_lock'.$this_system->SITE, $tid, 'serialize');
			
			$this_system->log(array(
				'title' => $P8LANG['_module_backup_admin_log'],
				'request' => $_POST,
			));
			
			_poster( p8lang($P8LANG['dbm_backup_init'], count($task['tables'])) );
		}


			define('NO_ADMIN_LOG', true);

			$tid = basename(isset($_POST['tid']) ? $_POST['tid'] : '');
			$task = $CACHE->read($SYSTEM .'/modules/'. $MODULE, 'task', $tid, 'serialize');
			$task or message('access_denied', $this_router .'-manage');

			@set_time_limit(0);
			ignore_user_abort(false);

			$current = each($task['tables']);

			if(empty($current)){
				//it's done
				$CACHE->delete($SYSTEM .'/modules/'. $MODULE, 'task', $tid);
				
				//解锁
				$CACHE->delete($SYSTEM .'/modules/', $MODULE, 'backup_lock'.$this_system->SITE);
				
				if(!empty($task['compress'])){
					//压缩
					require_once PHP168_PATH .'zip.class.php';
					$zip = new zip_file(CACHE_PATH . $task['path'] .'.zip');
					$zip->set_options(array('basedir' => CACHE_PATH .'db_backup_sites/'.$this_system->SITE.'/', 'overwrite' => 1, 'level' => 1));
					$zip->add_files(basename($task['path']));
					$zip->create_archive();
				}
				
				message(p8lang($P8LANG['dbm_backup_done'], P8_TIME - $task['start_time']), $this_router .'-dbm', 3);
			}

			$param = array(
				'rows' => $task['rows'],
				'charset' => $task['charset'],
				'prefix' => $task['prefix'],
				'site' => $task['site'],
			);
			if(isset($task['last_max'])){
				$param['last_max'] = $task['last_max'];
			}

			//需要order by 主键作为偏移

			$sql = '';
			//less than 1M
			while(strlen($sql) < 1048576){
				$param['offset'] = $task['table_offset'] * $task['rows'];
				$data = $this_module->backup($current['key'], $param);
				
				if($data['sql']){
					$sql .= $data['sql'];
						//continue
					$task['table_offset']++;
				}else{
					$param['table_offset'] = $task['table_offset'] = 0;
					
					//完成一个表,弹出
					array_shift($task['tables']);
					$current = each($task['tables']);
					
					//done
					if(empty($current)){
						break;
					}
				}
				
			}

			//写文件
			write_file(CACHE_PATH . $task['path'] .'/data_'. $task['file_offset']++ .'.php', "-- <?php exit;?>\r\n". $sql);

			$CACHE->write($SYSTEM .'/modules/'. $MODULE, 'task', $tid, $task, 'serialize');

			_poster(
				p8lang(
					$P8LANG['dbm_backup_process'],
					count($task['tables']),
					$current['key'] . $data['_sql'],
					$task['table_offset'] * $task['rows'],
					$current['value']
				)
			);

		
	}
	
	if($action=='restore'){
		@set_time_limit(0);
	
		$name = isset($_POST['name']) ? basename($_POST['name']) : '*';
		if($name){
			$name = escapeshellcmd($name);
			$name = p8_filter_special_chars(clear_special_char($name));
			$name = p8_authcode($name);
		}
		$name or message('access_denied');
		is_dir(CACHE_PATH .'db_backup_sites/'.$this_system->SITE.'/'. $name) or message('access_denied');
		
		if(!empty($_POST['delete'])){
			rm(CACHE_PATH .'db_backup_sites/'.$this_system->SITE.'/'. $name .'.zip');
			rm(CACHE_PATH .'db_backup_sites/'.$this_system->SITE.'/'. $name .'/');
			
			message('done', HTTP_REFERER, 60);
		}
		
		function _poster($msg = ''){
			global $this_url;
			
			$fields = '';
			foreach($_POST as $k => $v){
				$fields .= '<input type="hidden" name="'. $k .'" value="'. $v .'" />';
			}
			
		$form = <<<EOT
$msg
<form action="$this_url" method="post" id="form">
$fields
</form>
<script type="text/javascript">
setTimeout(function(){ document.getElementById('form').submit(); }, 1);
</script>
EOT;
		message($form);
}
	
		if(empty($_POST['start'])){
			//初始化
			$files = glob(clean_path(CACHE_PATH .'db_backup_sites/'.$this_system->SITE.'/'. $name .'/data_*.php'));
			
			$_POST['start'] = 1;
			$_POST['offset'] = 0;
			$_POST['start_time'] = P8_TIME;
			$_POST['total'] = count($files);
			$this_system->log(array(
				'title' => $P8LANG['_module_restore_admin_log'],
				'request' => $_POST,
			));
			_poster($P8LANG['dbm_restore_init']);
		}
		
		
		
		$offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
		if($offset >= $_POST['total']){
			//it's done
			message( p8lang($P8LANG['dbm_restore_done'], P8_TIME - $_POST['start_time']), $this_router .'-dbm' );
		}
		
		define('NO_ADMIN_LOG', true);
		
		if($offset == 0){
			//struct
			$content = file_get_contents(CACHE_PATH .'db_backup_sites/'.$this_system->SITE.'/'. $name .'/data_'. $offset .'.php');
			$content = str_replace(";\r", ';', $content);
			foreach(explode(";\n", $content) as $v){
				$DB_master->query($v);
			}
		}else{
			//很快的啦
			foreach(file(CACHE_PATH .'db_backup_sites/'.$this_system->SITE.'/'. $name .'/data_'. $offset .'.php') as $v){
				$DB_master->query($v);
			}
		}
		
		$_POST['offset']++;
		
		_poster(p8lang($P8LANG['dbm_restore_process'], $_POST['total'], $_POST['offset']));
		
	}
	if($action=='unlock'){
		$CACHE->delete($SYSTEM .'/modules/', $MODULE, 'backup_lock'.$this_system->SITE);
		message( 'done', $this_router .'-dbm' );
	}	
}
