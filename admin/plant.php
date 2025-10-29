<?php
defined('PHP168_PATH') or die();

$db_version = $DB_master->version();
$today = date("Y-m-d",mktime());
$systems = $core->list_systems();
$beginToday = mktime(0,0,0,date('m'),date('d'),date('Y'));
$beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
$countCmsToday['count'] = $countCmsMonth['count'] = $countCmsUnverified['count'] = $countCmsAll['count'] = $countCmsCategory['count'] = $countCmsPush['count'] = 0;
$countSitesToday['count'] = $countSitesUnverified['count'] = $countSitesAll['count'] = $countSitesPush['count'] = $countSitesSite['count'] = 0;
$sumCmsAll['count'] = 0;
if(isset($systems['cms'])){
	$cms = $core->load_system('cms');
	$item = $cms->load_module('item');
	$category_table = $core->TABLE_.'cms_category';
	$countCmsAll = $DB_master->fetch_one("select count(*) as `count` from ".$item->main_table." where 1=1");
	$sumCmsAll = $DB_master->fetch_one("select sum(views) as `count` from ".$item->main_table." where 1=1");	
	$countCmsCategory = $DB_master->fetch_one("select count(*) as `count` from ".$category_table." where 1=1");
	
	$listCmsCategory = $cidCmsCategory = $sumCmsCategory = $category_views = array();	
	$listCmsCategory = $DB_master->fetch_all("select `id`,`name`,`item_count` from ".$category_table." where `parent`=0 and `type` in (1,2)");	
	
	//$sumCmsCategory = $DB_master->fetch_all("SELECT `cid`,sum(views) as counts FROM ".$item->main_table." where 1=1 group by cid");	
	$item_count = $category_views = array();
	foreach($sumCmsCategory as $key=>$v){$cidCmsCategory[$v['cid']] = $v['counts'];}
	foreach($listCmsCategory as $key=>$v){
		if($v['item_count'] == 0) continue;
		$item_count['name'][] = $v['name'];
		$item_count['data'][] = $v['item_count'] ? $v['item_count'] : 0;
		//$category_views['data'][] = $cidCmsCategory[$v['id']] ? $cidCmsCategory[$v['id']] : 0;
	}
	$countCmsToday = $DB_master->fetch_one("select count(*) as `count` from ".$item->main_table." where `timestamp`>".$beginToday);
	$countCmsMonth = $DB_master->fetch_one("select count(*) as `count` from ".$item->main_table." where `timestamp`>".$beginThismonth);
	$countCmsUnverified = $DB_master->fetch_one("select count(*) as `count` from ".$item->unverified_table." where verified in(2,0)");
	
	$listdb = $DB_master->fetch_all("select * from ".$item->main_table." ORDER BY id DESC limit 8");
	
	foreach($listdb as $key => $val){
		$listdb[$key]['title']=p8_cutstr($listdb[$key]['title'],42);
		$listdb[$key]['url']=$item->controller."-view-id-".$val['id'];		
	}
	$listdb2 = $DB_master->fetch_all("select * from ".$item->unverified_table." WHERE verified in(2,0) ORDER BY id DESC limit 8");
	
	foreach($listdb2 as $key => $val){
		$listdb2[$key]['title']=p8_cutstr($listdb2[$key]['title'],48);
		$listdb2[$key]['url']=$item->controller."-view-id-".$val['id']."?verified=0";
		$listdb2[$key]['edit']=$core->admin_controller."/cms/item-update?id=$val[id]&model=$val[model]&verified=0";
		$listdb2[$key]['delete']=$core->admin_controller."/cms/item-delete?id=$val[id]&model=$val[model]&verified=0";
	}
}
if(isset($systems['sites']) && $systems['sites']['enabled']){
	$sites = $core->load_system('sites');
	$item = $sites->load_module('item');
	$site_status = $comm = '';
	foreach($sites->sites as $key=>$val){
		if($val['status']){
			$site_status .= "$comm'$key'";
			$comm = ',';
		}
	}
	$push_table = $core->TABLE_.'sites_stop_data';
	$site_table = $core->TABLE_.'sites_site';
	$countSitesSite = $DB_master->fetch_one("select count(*) as `count` from ".$site_table." where 1=1");
	$countSitesStatusSite = $DB_master->fetch_one("select count(*) as `count` from ".$site_table." where `status`=1");
	
	$countPushToday = $DB_master->fetch_one("select count(*) as `count` from ".$push_table." where `from` = 'sites' and `to` = 'cms' and `status`='1' and `timestamp`>".$beginToday);
	$countPushMonth = $DB_master->fetch_one("select count(*) as `count` from ".$push_table." where `from` = 'sites' and `to` = 'cms' and `status`='1' and `timestamp`>".$beginThismonth);
	$countSitesAll = $DB_master->fetch_one("select count(*) as `count` from ".$item->main_table." where `site` in (".$site_status.")");
	$countSitesToday = $DB_master->fetch_one("select count(*) as `count` from ".$item->main_table." where `site` in (".$site_status.") and `timestamp`>".$beginToday);
	$countSitesMonth = $DB_master->fetch_one("select count(*) as `count` from ".$item->main_table." where `site` in (".$site_status.") and `timestamp`>".$beginThismonth);
	$countSitesUnverified = $DB_master->fetch_one("select count(*) as `count` from ".$item->unverified_table." where `site` in (".$site_status.") and `verified` not in (88,-99,66)");
}
//member
$sumMember['login_time'] = $sumMember['new_messages'] = 0;
$role_table = $core->TABLE_.'role';
$member_table = $core->TABLE_.'member';
$countMember = $DB_master->fetch_one("select count(*) as `count` from ".$member_table." where `status`=0");
$sumMember = $DB_master->fetch_one("select sum(login_time) as login_time,sum(new_messages) as new_messages from ".$member_table." where `status`=0");
$lastLogin = $DB_master->fetch_all("select name,username,last_login_ip,login_time,last_login,gender from ".$member_table." where `status`=0 ORDER BY last_login DESC limit 8");

$roles = $DB_master->fetch_all("SELECT * FROM `$role_table`");
$_roles = $role_list = $role_ret = array();
foreach($roles as $role_t){
	$_roles[$role_t['id']] = $role_t['name'];
}
$role_list = $DB_master->fetch_all("SELECT count(*) as `count`,role_id FROM `$member_table` GROUP BY `role_id`");

foreach($role_list as $key => $role_m){
	$role_ret[] = array(
		'value' => $role_m['count'],
		'name' => $_roles[$role_m['role_id']]
	);
}
$role_json = json_encode($role_ret);
$item_count_json = json_encode($item_count);
$disk_config = array('3' => 'GB','2' => 'MB','1' => 'KB');
//当前磁盘的总容量
$disk_total = disk_total_space('.');
//当前磁盘的剩余空间
$disk_free = disk_free_space('.');
//可用率
$user_percentage = round(($disk_total-$disk_free)/$disk_total,3)*100;

foreach($disk_config as $disk_key => $disk_value){
	//$disk_total
	if($disk_total > pow(1024, $disk_key)){
		$disk_total = round($disk_total / pow(1024,$disk_key)).$disk_value;
	}
	//$disk_free
	if($disk_free > pow(1024, $disk_key)){
		$disk_free = round($disk_free / pow(1024,$disk_key)).$disk_value;
	}
}
include template($core, 'plant', 'admin');