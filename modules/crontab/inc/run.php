<?php
defined('PHP168_PATH') or die();

define('P8_CRONTAB', true);
$lock = $CACHE->read('core/modules/', 'crontab', 'lock', 'serialize');
if($lock && P8_TIME - $lock[1] < 120) $CACHE->delete('core/modules', 'crontab', 'lock');
//检查锁定,锁定超过120秒解锁
if(!isset($_GET['dbm']) && $lock &&	P8_TIME - $lock[1] < 120){
    if(!empty($_GET['show_crontab'])){
        echo "<br/>lock crontab: {$lock[0]}", date('Y-m-d H:i:s',$lock[1]);
    }
	return false;
}
@set_time_limit(0);
@ignore_user_abort(true);

if(!empty($crontab_id)){
	//有ID情况下无论是否启动都要执行
	$crontabbbtask = $DB_master->fetch_one("SELECT * FROM $crontab->table WHERE id = '$crontab_id'");
}else{
    $crontabbbtask = $DB_master->fetch_one("SELECT * FROM $crontab->table WHERE status = '1' ORDER BY next_run_time ASC LIMIT 1");
}

if(empty($crontabbbtask)) return false;
if($core->ismobile && strpos($crontabbbtask['script'],'mobile')===false) return false;
if(!empty($_GET['show_crontab'])){
    echo "<br/>runing crontab:{$crontabbbtask['id']}";
}

$CACHE->write('core/modules/', 'crontab', 'lock', array($crontabbbtask['id'], P8_TIME), 'serialize');
//锁住,并发
$pm = parse_url($crontabbbtask['script']);

if(!empty($pm['query'])){
    parse_str($pm['query'],$param);
   extract($param);
    $crontabbbtask['script']  = $pm['path'];
    unset($pm, $k, $v);
 }

//不要用require来执行,用require出错时会退出脚本
include PHP168_PATH .'inc/crontab/'. $crontabbbtask['script'];

$time = $crontab->next_run_time($crontabbbtask);

//更新本次执行时间以及下次执行时间
$DB_master->update(
	$crontab->table,
	array(
		'last_run_time' => P8_TIME,
		'next_run_time' => $time,
	),
	"id = '$crontabbbtask[id]'"
);

//再选出一个任务来执行
$crontab->pop();

//解锁
$CACHE->delete('core/modules/', 'crontab', 'lock');

return true;
