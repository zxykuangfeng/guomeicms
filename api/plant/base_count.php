<?php
/**
* 获取主站统计信息。
* 返回list和count
**/

require_once dirname(__FILE__) .'/../../inc/init.php';
$request = p8_stripslashes2($_POST + $_GET);

$data = array();
$today = date("Y-m-d",mktime());
$beginToday = mktime(0,0,0,date('m'),date('d'),date('Y'));
$beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
$systems = $core->list_systems();
$cms_main_table = $core->TABLE_.'cms_item';
$sites_main_table = $core->TABLE_.'sites_item';
$cms_unverified_table = $core->TABLE_.'cms_item_unverified';
$sites_unverified_table = $core->TABLE_.'sites_item_unverified';
$push_table = $core->TABLE_.'sites_stop_data';
$site_table = $core->TABLE_.'sites_site';

//cms
$sumCmsAll = $DB_master->fetch_one("select count(*) as count,sum(views) as views from ".$cms_main_table);
$countCmsToday = $DB_master->fetch_one("select count(*) as `count` from ".$cms_main_table." where `timestamp`>".$beginToday);
$countCmsMonth = $DB_master->fetch_one("select count(*) as `count` from ".$cms_main_table." where `timestamp`>".$beginThismonth);
$countCmsUnverified = $DB_master->fetch_one("select count(*) as `count` from ".$cms_unverified_table." where verified in(2,0)");

if(isset($systems['sites']) && $systems['sites']['enabled']){
	$site_status = $comm = '';
	$sites = $core->load_system('sites');
	foreach($sites->sites as $key=>$val){
		if($val['status']){
			$site_status .= "$comm'$key'";
			$comm = ',';
		}
	}
	$countSitesSite = $DB_master->fetch_one("select count(*) as count from ".$site_table);
	$countSitesStatusSite = $DB_master->fetch_one("select count(*) as count from ".$site_table." where `status`=1");

	$countPushToday = $DB_master->fetch_one("select count(*) as count from ".$push_table." where `from` = 'sites' and `to` = 'cms' and `status`='1' and `timestamp`>".$beginToday);
	$countPushMonth = $DB_master->fetch_one("select count(*) as count from ".$push_table." where `from` = 'sites' and `to` = 'cms' and `status`='1' and `timestamp`>".$beginThismonth);
	$countSitesAll = $DB_master->fetch_one("select count(*) as count,sum(views) as views from ".$sites_main_table." where `site` in (".$site_status.")");
	$countSitesToday = $DB_master->fetch_one("select count(*) as count from ".$sites_main_table." where `site` in (".$site_status.") and `timestamp`>".$beginToday);
	$countSitesMonth = $DB_master->fetch_one("select count(*) as count from ".$sites_main_table." where `site` in (".$site_status.") and `timestamp`>".$beginThismonth);
	$countSitesUnverified = $DB_master->fetch_one("select count(*) as count from ".$sites_unverified_table." where `site` in (".$site_status.") and `verified` not in (88,-99,66)");
}
$listdb = $DB_master->fetch_all("select * from ".$cms_main_table." ORDER BY id DESC limit 8");
	
foreach($listdb as $key => $val){
	$listdb[$key]['title']=p8_cutstr($listdb[$key]['title'],42);
	$listdb[$key]['url']=$item->controller."-view-id-".$val['id'];		
}

echo p8_json(array(
		'countCmsToday' => intval($countCmsToday['count']),
		'countCmsMonth' => intval($countCmsMonth['count']),
		'countCmsUnverified' => intval($countCmsUnverified['count']),	
		'countCmsAll' => intval($sumCmsAll['count']),
		'countCmsAll2' => intval($sumCmsAll['count']),
		'sumCmsAll' => intval($sumCmsAll['views']),		
		'countSitesSite' => intval($countSitesSite['count']),
		'sumSitesAll' => intval($countSitesAll['views']),
		'countSitesStatusSite' => intval($countSitesStatusSite['count']),	
		'countPushToday' => intval($countPushToday['count']),
		'countPushMonth' => intval($countPushMonth['count']),
		'countSitesAll' => intval($countSitesAll['count']),
		'countSitesAll2' => intval($countSitesAll['count']),
		'countSitesToday' => intval($countSitesToday['count']),
		'countSitesMonth' => intval($countSitesMonth['count']),
		'countSitesUnverified' => intval($countSitesUnverified['count']),
));
exit;