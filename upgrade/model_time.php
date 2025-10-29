<?php
/*针对通用的模型，增加时间字段*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "ALTER TABLE `p8_cms_item_article_` ADD `starttime` VARCHAR(50) NOT NULL DEFAULT '';
ALTER TABLE `p8_cms_item_article_` ADD `endtime` VARCHAR(50) NOT NULL DEFAULT '';
ALTER TABLE `p8_sites_item_article_` ADD `starttime` VARCHAR(50) NOT NULL DEFAULT '';
ALTER TABLE `p8_sites_item_article_` ADD `endtime` VARCHAR(50) NOT NULL DEFAULT '';
INSERT INTO `p8_cms_model_field` (`model`,`parent`,`name`,`alias`,`type`,`list_table`,`filterable`,`orderby`,`not_null`,`length`,`is_unsigned`,`editable`,`default_value`,`data`,`config`,`widget`,`widget_addon_attr`,`display_order`,`units`,`description`) VALUES ('article','0','endtime','到期日期','varchar','1','0','0','0','50','0','1','','a:0:{}','a:1:{s:4:\"full\";s:1:\"1\";}','textdate','placeholder=\"请选择到期时间\"','97','','针对有时间范围的信息，默认不选择');
INSERT INTO `p8_cms_model_field` (`model`,`parent`,`name`,`alias`,`type`,`list_table`,`filterable`,`orderby`,`not_null`,`length`,`is_unsigned`,`editable`,`default_value`,`data`,`config`,`widget`,`widget_addon_attr`,`display_order`,`units`,`description`) VALUES ('article','0','starttime','开始日期','varchar','1','0','0','0','50','0','1','','a:0:{}','a:1:{s:4:\"full\";s:1:\"1\";}','textdate','placeholder=\"请选择开始时间\"','98','','针对有时间范围的信息，默认不选择');
INSERT INTO `p8_sites_model_field` (`model`,`parent`,`name`,`alias`,`type`,`list_table`,`filterable`,`orderby`,`not_null`,`length`,`is_unsigned`,`editable`,`default_value`,`data`,`config`,`widget`,`widget_addon_attr`,`display_order`,`units`,`description`) VALUES ('article','0','endtime','到期日期','varchar','1','0','0','0','50','0','1','','a:0:{}','a:1:{s:4:\"full\";s:1:\"1\";}','textdate','placeholder=\"请选择到期时间\"','97','','针对有时间范围的信息，默认不选择');
INSERT INTO `p8_sites_model_field` (`model`,`parent`,`name`,`alias`,`type`,`list_table`,`filterable`,`orderby`,`not_null`,`length`,`is_unsigned`,`editable`,`default_value`,`data`,`config`,`widget`,`widget_addon_attr`,`display_order`,`units`,`description`) VALUES ('article','0','starttime','开始日期','varchar','1','0','0','0','50','0','1','','a:0:{}','a:1:{s:4:\"full\";s:1:\"1\";}','textdate','placeholder=\"请选择开始时间\"','98','','针对有时间范围的信息，默认不选择');
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "升级完成，如有错误提示，请忽略，请进后台更新全站缓存";
