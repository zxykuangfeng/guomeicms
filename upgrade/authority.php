<?php
/*2018.8.18
* authority
* 分角色浏览信息权限字段增加升级文件
*/

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
$sql = "
ALTER TABLE  `$main_table` ADD `authority` VARCHAR( 255 ) NOT NULL AFTER  `author`;
";
$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
    $DB_master->query($v);
}

foreach ($list as $v){
    $table = $main_table.'_'.$v['name'].'_';
    $sql = "ALTER TABLE `$table` ADD `authority` VARCHAR( 255 ) NOT NULL AFTER  `author`;";
    $sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
    $DB_master->query($sql[0]);
    echo "<br/>";
    echo 'CMS系统<b>'.$v['alias'].'</b>模型升级完成<br/>';
}
//for sites
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
$sql = "
ALTER TABLE  `$main_table` ADD `authority` VARCHAR( 255 ) NOT NULL AFTER  `author`;
";
$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
    $DB_master->query($v);
}

foreach ($list as $v){
    $table = $main_table.'_'.$v['name'].'_';
    $sql = "ALTER TABLE `$table` ADD `authority` VARCHAR( 255 ) NOT NULL AFTER  `author`;";
    $sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
    $DB_master->query($sql[0]);
    echo "<br/>";
    echo 'Sites系统<b>'.$v['alias'].'</b>模型升级完成<br/>';
}
echo "升级完成，如有错误提示，请忽略，请进入后台更新全站缓存";