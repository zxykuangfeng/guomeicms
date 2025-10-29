<?php
/*
 *表字段默认值升级
*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH . 'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$list = $core->DB_master->getTableStatus('');

$sql = '';
foreach ($list as $table) {

    $Fields = $core->DB_master->getTableStruct($table['Name']);
	
    foreach ($Fields as $Field) {
        if (!is_null($Field['Default'])) {
            continue;
        }
        if (!empty($Field['Default'])) {
            continue;
        }
        if ($Field['Key'] == 'PRI') {
            continue;
        }
        if (!in_array($Field['Type'],
            ['varchar', 'char', 'int','text', 'mediumint', 'tinyint', 'smallint', 'decimal', 'timestamp', 'bigint'])) {
            continue;
        }
        $sql .= "ALTER TABLE `{$table['Name']}` MODIFY COLUMN `{$Field['Field']}` {$Field['Type']}";
        if (in_array($Field['Type'], ['varchar', 'int', 'mediumint', 'tinyint', 'smallint', 'decimal', 'bigint'])) {
            $sql .= '(' . $Field['Length'] . ')';
        }
        $sql .= ' ' . $Field['Property'];

        if ($Field['Null'] == 'NO') {
            $sql .= ' NOT NULL';
        }
        if (in_array($Field['Type'], ['int', 'mediumint', 'tinyint', 'smallint', 'decimal', 'timestamp', 'bigint'])) {
            $sql .= ' DEFAULT 0';
        } elseif (in_array($Field['Type'], ['varchar', 'char','text'])) {
            $sql .= " DEFAULT ''";
        }
        if (!empty($Field['Comment'])) {
            $sql .= " COMMENT '{$Field['Comment']}'";
        }
        $sql .= ";\r\n";
    }
}
$sql = get_install_sql($DB_master, $sql, $core->TABLE_, false);
print_r($sql);
foreach ($sql as $v) {
    $DB_master->query($v);
    //echo $v."<br/>\n";
    //  flush();
}
echo "表字段默认值升级完毕,提示错误请忽视";