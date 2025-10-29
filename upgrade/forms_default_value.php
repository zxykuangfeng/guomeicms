<?php
//针对表单默认值字段
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "
ALTER TABLE p8_forms_model MODIFY post_template_mobile VARCHAR(50) NOT NULL DEFAULT '';
ALTER TABLE p8_forms_model MODIFY list_template_mobile VARCHAR(50) NOT NULL DEFAULT '';
ALTER TABLE p8_forms_model MODIFY view_template_mobile VARCHAR(50) NOT NULL DEFAULT '';
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，请进入后台更新全站缓存！";