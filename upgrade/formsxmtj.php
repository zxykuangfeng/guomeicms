<?php
/*
 *表单内容回复信息导出功能升级
*/

require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';


@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;

$sql = "
CREATE TABLE IF NOT EXISTS `p8_forms_item_xmtj` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `iid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
REPLACE INTO `p8_forms_model` (`id`, `name`, `alias`, `enabled`, `verified`, `recommend`, `count`, `display_order`, `post_template`, `list_template`, `view_template`, `config`) VALUES ('199','xmtj','系统项目留言','1','','0','14','0','','','','a:0:{}');
REPLACE INTO `p8_forms_model_field` (`model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES ('xmtj','0','name','姓名','varchar','','1','1','0','0','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','0','','','','','');
REPLACE INTO `p8_forms_model_field` (`model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES ('xmtj','0','telephone','电话','varchar','','1','1','0','1','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','0','','','','','');
REPLACE INTO `p8_forms_model_field` (`model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES ('xmtj','0','email','电子邮箱','varchar','','1','1','0','0','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','0','','','','','');
REPLACE INTO `p8_forms_model_field` (`model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES ('xmtj','0','iid','推介ID','int','','1','1','0','1','10','1','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','text','','0','','','','','');
REPLACE INTO `p8_forms_model_field` (`model`, `parent`, `name`, `alias`, `type`, `part`, `list_table`, `filterable`, `orderby`, `not_null`, `length`, `is_unsigned`, `editable`, `manager_editable`, `default_value`, `data`, `config`, `widget`, `widget_addon_attr`, `display_order`, `units`, `jsreg`, `jsregmsg`, `color`, `description`) VALUES ('xmtj','0','content','留言内容','varchar','','0','0','0','0','255','0','1','0','','a:0:{}','a:1:{s:6:\"layout\";s:7:\"horizen\";}','textarea','','0','','','','','');
";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, false);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "表单内容回复信息导出功能升级完毕，请进入后台更新缓存！";