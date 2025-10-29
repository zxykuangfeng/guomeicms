<?php
/*主站内容统计多作者的升级*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

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
$sql = "ALTER TABLE `$main_table` ADD `author_x` VARCHAR(50) NOT NULL DEFAULT '' AFTER `author`;
ALTER TABLE `$main_table` ADD `author_y` VARCHAR(50) NOT NULL DEFAULT '' AFTER `author_x`;
ALTER TABLE `$main_table` ADD `author_z` VARCHAR(50) NOT NULL DEFAULT '' AFTER `author_y`;";
$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
    $DB_master->query($v);
}

foreach ($list as $v){
    $table = $main_table.'_'.$v['name'].'_';
    $sql = "ALTER TABLE `$table` ADD `author_x` VARCHAR(50) NOT NULL DEFAULT '';
ALTER TABLE `$table` ADD `author_y` VARCHAR(50) NOT NULL DEFAULT '';
ALTER TABLE `$table`  ADD `author_z` VARCHAR(50) NOT NULL DEFAULT '';";
    $sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
      foreach($sql as $vv){
			$DB_master->query($vv);
		}
    echo "<br/>";
    echo 'CMS系统<b>'.$v['alias'].'</b>模型升级完成<br/>';
}
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
    $sql = "ALTER TABLE `$main_table` ADD `author_x` VARCHAR(50) NOT NULL DEFAULT '';
ALTER TABLE `$main_table` ADD `author_y` VARCHAR(50) NOT NULL DEFAULT '' ;
ALTER TABLE `$main_table` ADD `author_z` VARCHAR(50) NOT NULL DEFAULT '' AFTER `author_y`;";

    $sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
      foreach($sql as $vv){
			$DB_master->query($vv);
		}
    echo "站群系统主数据升级完成<br/>";
    foreach ($list as $v) {
        $table = $main_table . '_' . $v['name'] . '_';
        $sql = "ALTER TABLE `$table` ADD `author_x` VARCHAR(50) NOT NULL DEFAULT '';
ALTER TABLE `$table` ADD `author_y` VARCHAR(50) NOT NULL DEFAULT '';
ALTER TABLE `$table`  ADD `author_z` VARCHAR(50) NOT NULL DEFAULT '';";
        $sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
        foreach($sql as $vv){
			$DB_master->query($vv);
		}
        echo "<br/>";
        echo '站群系统<b>'.$v['alias'].'</b>模型升级完成<br/>';
    }
}
echo "升级完成，如有错误提示，请忽略，请进入后台更新全站缓存";
