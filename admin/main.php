<?php
defined('PHP168_PATH') or die();
$IS_ADMIN or message('no_privilege',$core->controller,2);
$this_controller->check_admin_action('main') or message('no_privilege',$core->controller,2);

if(REQUEST_METHOD == 'GET'){
	
	$db_version = $DB_master->version();
	$db_version = $P8LANG[$core->CONFIG['mysql_connect_type']].' '.$db_version;
	
	$systems = $core->list_systems();
	$beginToday = mktime(0,0,0,date('m'),date('d'),date('Y'));
	$beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
	$countCmsToday['count'] = $countCmsMonth['count'] = $countCmsUnverified['count'] = 0;
	$countSitesToday['count'] = $countSitesUnverified['count'] = 0;
	if(isset($systems['cms'])){
		$cms = $core->load_system('cms');
		$item = $cms->load_module('item');
		$countCmsToday = $DB_master->fetch_one("select count(*) as `count` from ".$item->main_table." where `timestamp`>".$beginToday);
		$countCmsMonth = $DB_master->fetch_one("select count(*) as `count` from ".$item->main_table." where `timestamp`>".$beginThismonth);
		$countCmsToday2 = $DB_master->fetch_one("select count(*) as `count` from ".$item->unverified_table." where `timestamp`>".$beginToday);
		$countCmsMonth2 = $DB_master->fetch_one("select count(*) as `count` from ".$item->unverified_table." where `timestamp`>".$beginThismonth);
		$countCmsToday['count'] += $countCmsToday2['count'];
		$countCmsMonth['count'] += $countCmsMonth2['count'];
		$countCmsUnverified = $DB_master->fetch_one("select count(*) as `count` from ".$item->unverified_table." where verified in (0,2)");
		
		$listdb = $DB_master->fetch_all("select * from ".$item->main_table." ORDER BY id DESC limit 8");
		
		foreach($listdb as $key => $val){
			$listdb[$key]['title']=p8_cutstr($listdb[$key]['title'],68);
			$listdb[$key]['url']=$item->controller."-view-id-".$val['id'];
			$listdb[$key]['edit']=$core->admin_controller."/cms/item-update?id=$val[id]&model=$val[model]&verified=1";
			$listdb[$key]['delete']=$core->admin_controller."/cms/item-delete?id=$val[id]&model=$val[model]&verified=1";
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
		$site_status = $comm = '';
		foreach($sites->sites as $key=>$val){
			if($val['status']){
				$site_status .= "$comm'$key'";
				$comm = ',';
			}
		}		
		$item = $sites->load_module('item');
		$countSitesToday = $DB_master->fetch_one("select count(*) as `count` from ".$item->main_table." where `site` in (".$site_status.") and `timestamp`>".$beginToday);
		$countSitesMonth = $DB_master->fetch_one("select count(*) as `count` from ".$item->main_table." where `site` in (".$site_status.") and `timestamp`>".$beginThismonth);
		$countSitesToday2 = $DB_master->fetch_one("select count(*) as `count` from ".$item->unverified_table." where `site` in (".$site_status.") and `timestamp`>".$beginToday);
		$countSitesMonth2 = $DB_master->fetch_one("select count(*) as `count` from ".$item->unverified_table." where `site` in (".$site_status.") and `timestamp`>".$beginThismonth);
		$countSitesToday['count'] += $countSitesToday2['count'];
		$countSitesMonth['count'] += $countSitesMonth2['count'];
		$countSitesUnverified = $DB_master->fetch_one("select count(*) as `count` from ".$item->unverified_table." where `site` in (".$site_status.") and `verified` in (0,2)");
		
	}
	//模型
	$models = $cms->get_models();
	if(is_file(PHP168_PATH.'data/installcache.lock'))$cache = true;
	$disk_config = [
        '3' => 'GB',
        '2' => 'MB',
        '1' => 'KB'
    ];	
	//当前磁盘的总容量
	$disk_total = disk_total_space('.');
	//当前磁盘的剩余空间
	$disk_free = disk_free_space('.');
	//可用率
	$free_percentage = round($disk_free/$disk_total,3)*100;
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
    $fileinfo = class_exists('finfo');

	include template($core, 'main', 'admin');

}else if(REQUEST_METHOD == 'POST'){
	
	if(isset($_POST['detect_ssi'])){
		write_file(CACHE_PATH .'ssi.html', 'ssi');
		write_file(CACHE_PATH .'ssi.shtml', '<!--#include virtual="ssi.html"-->');
		
		$core->set_config(array('ssi' => file_get_contents('http://'. $_SERVER['SERVER_PORT']=='80' ? $_SERVER['SERVER_NAME']:$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'] .'/data/ssi.shtml') == 'ssi'));
	}
	
	message('done');
}