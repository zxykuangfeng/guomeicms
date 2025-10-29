<?php
/*普通审核记录*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "CREATE TABLE `p8_item_verify_log` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`module` varchar(30) NOT NULL DEFAULT '',
`iid` int(11) NOT NULL DEFAULT 0,
`step` int(11) NOT NULL DEFAULT 0,
`step_title` varchar(60) NOT NULL DEFAULT '',
`operator` varchar(30) NOT NULL DEFAULT '',
`update_time` int(11) NOT NULL DEFAULT 0,
`reason` varchar(255) NOT NULL DEFAULT '',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, false);
foreach($sql as $v){
    $DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略";

