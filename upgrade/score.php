<?php
/*针对内容评分的升级*/
require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';

@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;
//for letter module
$sql = "DROP TABLE IF EXISTS `p8_credit_log`;
CREATE TABLE IF NOT EXISTS `p8_credit_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL,
  `system` varchar(20) NOT NULL,
  `module` varchar(20) NOT NULL,
  `site` varchar(20) NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL,
  `credit_id` tinyint(3) unsigned NOT NULL,
  `credit` int(10) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `reason` varchar(255) NOT NULL,
  `setter` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`credit_id`)
);
INSERT INTO `p8_config` VALUES ('cms','item','serialize','score_level','a:5:{i:0;a:2:{s:4:\"code\";s:1:\"0\";s:4:\"name\";s:6:\"普通\";}i:1;a:2:{s:4:\"code\";s:1:\"1\";s:4:\"name\";s:6:\"中等\";}i:2;a:2:{s:4:\"code\";s:1:\"2\";s:4:\"name\";s:6:\"良好\";}i:3;a:2:{s:4:\"code\";s:1:\"3\";s:4:\"name\";s:6:\"优秀\";}i:4;a:2:{s:4:\"code\";s:1:\"4\";s:4:\"name\";s:12:\"特别优秀\";}}');
INSERT INTO `p8_config` VALUES ('sites','item','serialize','score_level','a:5:{i:0;a:2:{s:4:\"code\";s:1:\"0\";s:4:\"name\";s:6:\"普通\";}i:1;a:2:{s:4:\"code\";s:1:\"1\";s:4:\"name\";s:6:\"中等\";}i:2;a:2:{s:4:\"code\";s:1:\"2\";s:4:\"name\";s:6:\"良好\";}i:3;a:2:{s:4:\"code\";s:1:\"3\";s:4:\"name\";s:6:\"优秀\";}i:4;a:2:{s:4:\"code\";s:1:\"4\";s:4:\"name\";s:12:\"特别优秀\";}}');
REPLACE INTO `p8_credit` VALUES ('1','积分','个','','0','100','0','0','a:0:{}');
REPLACE INTO `p8_credit` VALUES ('2','金币','枚','','0','50','0','0','a:0:{}');
REPLACE INTO `p8_credit` VALUES ('3','评分','分','','0','0','3','0','a:0:{}');
ALTER TABLE `p8_credit_member` ADD `credit_3` DECIMAL(3,0) NOT NULL DEFAULT '0';";

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
$unverified_table = $item->unverified_table;
$sql .= "
ALTER TABLE `$main_table` ADD `score` TINYINT(3) NOT NULL DEFAULT '0'  AFTER `views`;
ALTER TABLE `$unverified_table` ADD `score` TINYINT(3) NOT NULL DEFAULT '0'  AFTER `views`;
";
$sql = get_install_sql($DB_master, $sql, $core->TABLE_, false);
foreach($sql as $v){
    $DB_master->query($v);
}

foreach ($list as $v){
    $table = $main_table.'_'.$v['name'].'_';
    $sql = "ALTER TABLE `$table` ADD `score` TINYINT(3) NOT NULL DEFAULT '0'  AFTER `views`;";
    $sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
    $DB_master->query($sql[0]);
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
    $unverified_table = $item->unverified_table;
    $sql = "
    ALTER TABLE `$main_table` ADD `score` TINYINT(3) NOT NULL DEFAULT '0'  AFTER `views`;
    ALTER TABLE `$unverified_table` ADD `score` TINYINT(3) NOT NULL DEFAULT '0'  AFTER `views`;
    ";

    $sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
    foreach($sql as $v){
        $DB_master->query($v);
    }
    echo "站群系统主数据升级完成<br/>";
    foreach ($list as $v) {
        $table = $main_table . '_' . $v['name'] . '_';
        $sql = "ALTER TABLE `$table` ADD `score` TINYINT(3) NOT NULL DEFAULT '0'  AFTER `views`;";
        $sql = get_install_sql($DB_master, $sql, $core->TABLE_, true);
        $DB_master->query($sql[0]);
        echo "<br/>";
        echo '站群系统<b>'.$v['alias'].'</b>模型升级完成<br/>';
    }
}
echo "升级完成，如有错误提示，请忽略，请进入后台更新全站缓存";