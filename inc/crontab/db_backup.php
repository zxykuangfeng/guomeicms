<?php
defined('PHP168_PATH') or die();
$dbm = $core->load_module('dbm');

$_POST['id'] = $crontab_id;

//锁定中
if($CACHE->read('core/modules/','dbm', 'backup_lock', 'serialize')){
	//解锁
	$CACHE->delete('core/modules/','dbm', 'backup_lock');
}

//初始化
$tables = $dbm->table_status();

$tid = unique_id(16);
$_POST['ours'] = 1;
$charset = $core->CONFIG['page_charset'];
$rows = 1;

$table_prefix = $afx = '';
$table_prefix = $core->CONFIG['table_prefix'];
$afx = '_ours';
		
$tasks = array(
	'start_time' => P8_TIME,
	'offset' => 0,
	'table_offset' => 0,
	'file_offset' => 1,
	'rows' => $rows,
	'prefix' => isset($_POST['prefix']) ? basename($_POST['prefix']) : '',
	'charset' => $charset,
	'path' => 'db_backup/'. date('Y-m-d#H_i', P8_TIME).$afx. '('. $charset .')',
	'tables' => array()
);

$sql = "-- <?php exit;?>\r\n";
foreach($tables as $v){
	if($_POST['ours']==1 && strpos($v['Name'], $table_prefix)!==0){
		continue;
	}elseif($_POST['ours']==2 && strpos($v['Name'], $table_prefix)===0){
		continue;
	}
	$data = $DB_master->fetch_one("SHOW CREATE TABLE `$v[Name]`");
	if(!empty($tasks['charset']) && $tasks['charset'] != $core->CONFIG['page_charset']){
		$data['Create Table'] = preg_replace(
			'/DEFAULT\s+CHARSET=.+/i',
			'DEFAULT CHARSET='. (strtolower($charset) == 'utf-8' ? 'utf8' : $charset),
			$data['Create Table']
		);
	}
	
	if(
		$v['Name'] == $core->CONFIG['table_prefix'] .'session' ||
		$v['Name'] == $core->CONFIG['table_prefix'] .'pagecache'
	){
		//session, pagecache 表不管
		
		$sql .= preg_replace('/^CREATE TABLE/i', 'CREATE TABLE IF NOT EXISTS', $data['Create Table']) .";\r\n\r\n";
		
	}else{
		$sql .= "DROP TABLE IF EXISTS `$v[Name]`;\r\n";
		$sql .= $data['Create Table'] .";\r\n\r\n";
		
		$tasks['tables'][$v['Name']] = $v['Rows'];
	}
	
}

md(CACHE_PATH . $tasks['path']);
//写创建表
write_file(CACHE_PATH . $tasks['path'] .'/data_0.php', $sql);
//写任务清单
$CACHE->write('core/modules/dbm', 'task', $tid, $tasks, 'serialize');
//加锁
$CACHE->write('core/modules/','dbm', 'backup_lock', $tid, 'serialize');
define('NO_ADMIN_LOG', true);
//定义TID
$tid = basename($tid);
@set_time_limit(0);
ignore_user_abort(false);
//读任务清单
$tasks = $CACHE->read('core/modules/dbm', 'task', $tid, 'serialize');
$tasks or exit;
$param = array(
	'rows' => 1,
	'charset' => $charset,
	'prefix' => ''
);
//需要order by 主键作为偏移
$primaries = include $dbm->path .'backup_primary.php';
for($i=0;$i<=count($tasks['tables']);$i++){
	//循环开始
	$tasks = $CACHE->read('core/modules/dbm', 'task', $tid, 'serialize');
	$tasks or exit;
	$current = each($tasks['tables']);

	if(empty($current)){
		//it's done
		$CACHE->delete('core/modules/dbm', 'task', $tid);
		//解锁
		$CACHE->delete('core/modules/','dbm', 'backup_lock');
		break;
	}
	if(isset($tasks['last_max'])){
		$param['last_max'] = $tasks['last_max'];
	}
	$sql = '';
	//less than 1M
	while(strlen($sql) < 1048576){		
		if($is_primary = isset($primaries[$current['key']])){
			$param['primary'] = $tasks['primary'] = $primaries[$current['key']];
		}		
		$param['offset'] = $tasks['table_offset'];
		$data = $dbm->backup($current['key'], $param);
		
		if($data['sql']){
			$sql .= $data['sql'];
			if($is_primary && isset($data['last_max'])){
				$tasks['last_max'] = $param['last_max'] = $data['last_max'];
			}
			
			//continue
			$tasks['table_offset']++;
		}else{
			unset($param['primary'], $param['last_max'], $tasks['last_max']);
			$param['table_offset'] = $tasks['table_offset'] = 0;
			
			//完成一个表,弹出
			array_shift($tasks['tables']);
			$current = each($tasks['tables']);
			
			//done
			if(empty($current)){
				break;
			}
		}
		
	}
	//写文件
	write_file(CACHE_PATH . $tasks['path'] .'/data_'. $tasks['file_offset']++ .'.php', "-- <?php exit;?>\r\n". $sql);
	$CACHE->write('core/modules/dbm', 'task', $tid, $tasks, 'serialize');
	//循环结束
}