<?php
/*
 *签发日志
 *
*/

require './../inc/init.php';
header('Content-type: text/html; charset=utf-8');
require_once PHP168_PATH .'inc/install.func.php';

@set_time_limit(0);
error_reporting(E_ALL);
$core->CONFIG['debug'] = 1;
$sql = "CREATE TABLE IF NOT EXISTS `p8_cms_item_clone` (
  `clone_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_id` int(10) DEFAULT '0',
  `to_id` int(8) DEFAULT '0',
  `action_uid` int(8) NOT NULL DEFAULT '0',
  `action_username` varchar(50) NOT NULL DEFAULT '',
  `action_timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`clone_id`)
) ENGINE=MyISAM;
CREATE TABLE IF NOT EXISTS `p8_sites_item_clone` (
  `clone_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_id` int(10) DEFAULT '0',
  `to_id` int(8) DEFAULT '0',
  `action_uid` int(8) NOT NULL DEFAULT '0',
  `action_username` varchar(50) NOT NULL DEFAULT '',
  `action_timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`clone_id`)
) ENGINE=MyISAM;";

$sql = get_install_sql($DB_master, $sql, $core->TABLE_, false);
foreach($sql as $v){
	$DB_master->query($v);
}
echo "数据表创建完成<br><br>";
$cms = $core->load_system('cms');
$this_module = $cms->load_module('item');
$main_table = $this_module->main_table;
$sql = "select `title`,`model`,count(*) as count from $main_table group by `title`,`model` having count>1;";
$clone_items = $DB_master->fetch_all($sql);
foreach($clone_items as $item){
	$title = $item['title'];
	$sql = "select `id`,`uid`,`timestamp`,`username`,`attributes`,`cid`,`model` from $main_table where `title` = '$title' order by id asc;";
	$clone_item = $DB_master->fetch_all($sql);	
	foreach($clone_item as $key => $items){
		if($key == 0) {
			//更新源稿属性
			$attributes = explode(',', $items['attributes']);
			$attributes[] = '13';
			$attributes = implode(',',array_unique($attributes));
			$this_module->update_attribute($attributes,$items['id'],$items['cid']);
		}else{
			$_REQUEST['model'] = $items['model'];
			$cms->init_model();
			$id = $items['id'];
			$DB_master->insert(
				$this_module->clone_table,
				array(
					'from_id' => $clone_item[0]['id'],
					'to_id' => $id,
					'action_uid' => $items['uid'],
					'action_username' => $items['username'],
					'action_timestamp' => $items['timestamp']
				)
			);
			if($items['attributes']){
				if(in_array('12',explode(',', $items['attributes']))) continue;
				$DB_master->update(
					$this_module->main_table,
					array('attributes'=>$items['attributes'].',12'),
					"id = '$id'"
				);
				$DB_master->update(
					$this_module->table,
					array('attributes'=>$items['attributes'].',12'),
					"id = '$id'"
				);
				$this_module->add_attribute($items['attributes'].',12', $id, $items['cid']);
			}else{
				$DB_master->update(
					$this_module->main_table,
					array('attributes'=>'12'),
					"id = '$id'"
				);
				$DB_master->update(
					$this_module->table,
					array('attributes'=>'12'),
					"id = '$id'"
				);
				$this_module->add_attribute('12', $id, $items['cid']);
			}
		}
	}
}

$systems = $core->list_systems();
if(isset($systems['sites']) && $systems['sites']['enabled']) {
	$sites = $core->load_system('sites');
	$this_module = $sites->load_module('item');
	$main_table = $this_module->main_table;
	$sql = "select `title`,`site`,`model`,count(*) as count from $main_table group by `title`,`site`,`model` having count>1;";
	$clone_items = $DB_master->fetch_all($sql);
	foreach($clone_items as $item){
		$title = $item['title'];
		$site = $item['site'];
		$sql = "select `id`,`uid`,`timestamp`,`username`,`attributes`,`cid`,`model` from $main_table where `site`= '$site' and `title` = '$title' order by id asc;";
		$clone_item = $DB_master->fetch_all($sql);
		foreach($clone_item as $key => $items){
			if($key == 0) {
				//更新源稿属性
				$attributes = explode(',', $items['attributes']);
				$attributes[] = '13';
				$attributes = implode(',',array_unique($attributes));
				$this_module->update_attribute($attributes,$items['id'],$items['cid']);
			}else{
				$_REQUEST['model'] = $items['model'];
				$sites->init_model();
				$id = $items['id'];
				$DB_master->insert(
					$this_module->clone_table,
					array(
						'from_id' => $clone_item[0]['id'],
						'to_id' => $id,
						'action_uid' => $items['uid'],
						'action_username' => $items['username'],
						'action_timestamp' => $items['timestamp']
					)
				);
				if($items['attributes']){
					if(in_array('12',explode(',', $items['attributes']))) continue;
					$DB_master->update(
						$this_module->main_table,
						array('attributes'=>$items['attributes'].',12'),
						"id = '$id'"
					);
					$DB_master->update(
						$this_module->table,
						array('attributes'=>$items['attributes'].',12'),
						"id = '$id'"
					);
					$this_module->add_attribute($items['attributes'].',12', $id, $items['cid']);
				}else{
					$DB_master->update(
						$this_module->main_table,
						array('attributes'=>'12'),
						"id = '$id'"
					);
					$DB_master->update(
						$this_module->table,
						array('attributes'=>'12'),
						"id = '$id'"
					);
					$this_module->add_attribute('12', $id, $items['cid']);
				}
			}
		}
	}
}
echo "升级完成，如有错误提示，请忽略，请进入后台更新全站缓存";
