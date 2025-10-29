<?php
/*2018.11.21 sites系统 内容IP地址访问，增加字段
*/

require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';

@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

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
$main_table = $sites->load_module('item')->main_table;

foreach ($list as $v){
    $table = $main_table.'_'.$v['name'].'_';
    $sql = "ALTER TABLE `$table` ADD `config` VARCHAR(512) NOT NULL;";
    $sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
    $DB_master->query($sql[0]);
    echo "<br/>";
    echo 'CMS系统<b>'.$v['alias'].'</b>模型字段升级完成<br/>';
}

echo "升级完成，如有错误提示，请忽略，请进入后台更新全站缓存";