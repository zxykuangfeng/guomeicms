<?php
/*主站和子站首页的标签；升级成优先权重，再优先发布时间。*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';

@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;
$this_module = $core->load_module('label');
$select = select();
$select->from($this_module->table, '*');
$select->in('system',array('cms','sites'));
$select->in('type','module_data');
//$select->in('postfix','index');
$select->in('source_module','item');
$select->in('source_system','core',true);
//echo $select->build_sql();
$list = $core->list_item(
    $select,
    array(
        'page_size' => 0,
        'ms' => 'master'
    )
);
foreach($list as $v){
	$id = $v['id'];
	$option = mb_unserialize(stripslashes($v['option']));
	if(empty($option['order_by'])){
		$option['order_by'] = array('i.level'=>1,'i.timestamp'=>1);
	}
	$status = $DB_master->update(
		$this_module->table,
		array('option'=>$DB_master->escape_string(serialize($option))),
		"id = '$id'"
	);	
}
echo "标签维护完成";
/*cms*/

$this_system = $core->load_system('cms');
$this_module = $this_system->load_module('category');
/*category*/
$table = $this_module->table;
$query = $DB_master->query("SELECT id, config FROM  `$table`");	

while($arr = $DB_master->fetch_array($query)){
	$id = $arr['id'];
	$config = mb_unserialize(stripslashes($arr['config']));
	if($config['orderby'] == 'timestamp'){
		$config['orderby'] = 'level';		
		$status = $DB_master->update(
			$this_module->table,
			array('config'=>$DB_master->escape_string(serialize($config))),
			"id = '$id'"
		);	
	}
}
echo "<br>主站栏目维护完成";
/*table_recycle*/
$table = $this_module->table_recycle;
$query = $DB_master->query("SELECT id, config FROM  `$table`");	

while($arr = $DB_master->fetch_array($query)){
	$id = $arr['id'];
	$config = mb_unserialize(stripslashes($arr['config']));
	if($config['orderby'] == 'timestamp'){
		$config['orderby'] = 'level';		
		$status = $DB_master->update(
			$this_module->table_recycle,
			array('config'=>$DB_master->escape_string(serialize($config))),
			"id = '$id'"
		);	
	}
}
echo "<br>主站栏目回收站维护完成";

/*sites*/

$this_system = $core->load_system('sites');
$this_module = $this_system->load_module('category');
/*category*/
$table = $this_module->table;
$query = $DB_master->query("SELECT id, config FROM  `$table`");	

while($arr = $DB_master->fetch_array($query)){
	$id = $arr['id'];
	$config = mb_unserialize(stripslashes($arr['config']));
	if($config['orderby'] == 'timestamp'){
		$config['orderby'] = 'level';		
		$status = $DB_master->update(
			$this_module->table,
			array('config'=>$DB_master->escape_string(serialize($config))),
			"id = '$id'"
		);	
	}
}
echo "<br>分站栏目维护完成";
/*table_recycle*/
$table = $this_module->table_recycle;
$query = $DB_master->query("SELECT id, config FROM  `$table`");	

while($arr = $DB_master->fetch_array($query)){
	$id = $arr['id'];
	$config = mb_unserialize(stripslashes($arr['config']));
	if($config['orderby'] == 'timestamp'){
		$config['orderby'] = 'level';		
		$status = $DB_master->update(
			$this_module->table_recycle,
			array('config'=>$DB_master->escape_string(serialize($config))),
			"id = '$id'"
		);	
	}
}
echo "<br>分站栏目回收站维护完成";

echo "升级完成，如有错误提示，请忽略，请进后台更新主站和分站的栏目缓存";