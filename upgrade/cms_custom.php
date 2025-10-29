<?php
/*针对新增预留字段升级字段*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';

@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;
echo "==========主站升级==========<br/>";
//for cms
$cms = $core->load_system('cms');
$this_module = $cms->load_module('model');
$select = select();
$select->from($this_module->table, '*');
$list = $core->list_item(
    $select,
    array(
        'page_size' => 0,
        'ms' => 'master'
    )
);
$item = $cms->load_module('item');
$main_table = $item->main_table;

foreach ($list as $v){
	//var_dump($v);exit;
    $table = $main_table.'_'.$v['name'].'_';
	$table_addon = $main_table.'_'.$v['name'].'_addon';
    $sql = "ALTER TABLE `$table` ADD  `custom_a` VARCHAR( 255 ) NOT NULL DEFAULT '',ADD  `custom_b` VARCHAR( 255 ) NOT NULL DEFAULT '',ADD  `custom_c` VARCHAR( 255 ) NOT NULL DEFAULT '',ADD  `custom_d` VARCHAR( 255 ) NOT NULL DEFAULT '',ADD `custom_e` VARCHAR( 255 ) NOT NULL DEFAULT '';
	ALTER TABLE `$table_addon` ADD  `custom_f` VARCHAR( 255 ) NOT NULL DEFAULT '',ADD `custom_g` VARCHAR( 255 ) NOT NULL DEFAULT '',ADD `custom_h` VARCHAR( 255 ) NOT NULL DEFAULT '',ADD `custom_i` VARCHAR( 255 ) NOT NULL DEFAULT '',ADD `custom_j` VARCHAR( 255 ) NOT NULL DEFAULT '';";
    $sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
    foreach($sql as $vv){
		$DB_master->query($vv);
	}
    echo "<br/>";
    echo '--------主站系统 <b>'.$v['alias'].'</b> 模型升级完成<br/>';
}
echo "<br/><br/><br/><br/>==========站群升级==========<br/>";
//for sites
$systems = $core->list_systems();
if(isset($systems['sites'])) {
    $sites = $core->load_system('sites');
    $this_module = $sites->load_module('model');
    $select = select();
    $select->from($this_module->table, '*');
    $list = $core->list_item(
        $select,
        array(
            'page_size' => 0,
            'ms' => 'master'
        )
    );
    $item = $sites->load_module('item');
    $main_table = $item->main_table;
    foreach ($list as $v) {
        $table = $main_table.'_'.$v['name'].'_';
		$table_addon = $main_table.'_'.$v['name'].'_addon';
		$sql = "ALTER TABLE `$table` ADD  `custom_a` VARCHAR( 255 ) NOT NULL DEFAULT '',ADD  `custom_b` VARCHAR( 255 ) NOT NULL DEFAULT '',ADD `custom_c` VARCHAR( 255 ) NOT NULL DEFAULT '',ADD `custom_d` VARCHAR( 255 ) NOT NULL DEFAULT '',ADD `custom_e` VARCHAR( 255 ) NOT NULL DEFAULT '';
		ALTER TABLE `$table_addon` ADD  `custom_f` VARCHAR( 255 ) NOT NULL DEFAULT '',ADD  `custom_g` VARCHAR( 255 ) NOT NULL DEFAULT '',ADD `custom_h` VARCHAR( 255 ) NOT NULL DEFAULT '',ADD `custom_i` VARCHAR( 255 ) NOT NULL DEFAULT '',ADD `custom_j` VARCHAR( 255 ) NOT NULL DEFAULT '';";
		$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
		foreach($sql as $vv){
			$DB_master->query($vv);
		}
        echo "<br/>";
        echo '----站群系统 <b>'.$v['alias'].'</b> 模型升级完成<br/>';
    }
}
echo "<br><br><br>升级完成，如有错误提示，请忽略，请进入后台更新全站缓存";
