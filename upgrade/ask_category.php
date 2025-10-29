<?php
/*问答系统栏目增加封面图片*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "ALTER TABLE `p8_ask_category_` ADD `frame` varchar( 255 ) NOT NULL DEFAULT '' AFTER `announce`;
ALTER TABLE `p8_ask_category_` ADD `category_logo` varchar( 255 ) NOT NULL DEFAULT '' AFTER `frame`;
ALTER TABLE `p8_ask_category_` ADD `category_banner` varchar( 255 ) NOT NULL DEFAULT '' AFTER `category_logo`;
ALTER TABLE `p8_ask_category_` ADD `comstom_a` mediumtext AFTER `category_banner`;
ALTER TABLE `p8_ask_category_` ADD `comstom_b` mediumtext AFTER `comstom_a`;
ALTER TABLE `p8_ask_category_` ADD `comstom_c` varchar( 255 ) NOT NULL DEFAULT '' AFTER `comstom_b`;
ALTER TABLE `p8_ask_category_` ADD `comstom_d` varchar( 255 ) NOT NULL DEFAULT '' AFTER `comstom_c`;
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略";
