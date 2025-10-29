<?php
defined('PHP168_PATH') or die();

if(REQUEST_METHOD == 'GET'){
	$mysites = $this_system->get_manage_sites();

	$farm = &$this_system->load_module('farm');
	$farm_controller = $core->controller($farm);
	$site_list = $farm_controller->check_admin_action('list');
	$site_create = $farm_controller->check_admin_action('add');
	$site_recycle = $farm_controller->check_admin_action('recycle');


	$model = &$this_system->load_module('model');
	$model_controller = $core->controller($model);
	$model_list = $model_controller->check_admin_action('list');
	$model_create = $model_controller->check_admin_action('add');

	$stop = &$this_system->load_module('stop');
	$stop_controller = $core->controller($stop);
	$category_create = $model_controller->check_admin_action('category');


	if(!$mysites && !$IS_FOUNDER)message('no_privilege');
	if(!$this_system->SITE || !in_array($this_system->SITE, $mysites))$this_system->load_site($mysites[0]);
	//切换站点
	$_this_site = isset($_GET['site']) ? p8_stripslashes2(xss_clear($_GET['site'])) : $this_system->SITE;
	if($this_system->SITE && in_array($_this_site, $mysites) && $this_system->SITE != $_this_site) $this_system->load_site($_this_site);
	
	$item = $this_system->load_module('item');
	$site = $this_system->SITE;
	//最新已审核内容
	$listdb = $DB_master->fetch_all("select * from ".$item->main_table." where site = '$site' ORDER BY timestamp DESC limit 3");
	foreach($listdb as $key => $val){
		$listdb[$key]['url'] = $this_system->siteurl."/item-view-id-".$val['id'].'?verified=1';
		$listdb[$key]['date'] = date('Y-m-d',$val['timestamp']);
		$listdb[$key]['edit'] = $this_system->admin_controller.'/item-update?model='.$val['model'].'&id='.$val['id'].'&verified=1';
	}
	//最新未审核内容
	$listdb2 = $DB_master->fetch_all("select * from ".$item->unverified_table." where site = '$site' and verified in(2,0) ORDER BY timestamp DESC limit 3");
	foreach($listdb2 as $key => $val){
		$listdb2[$key]['url']=$this_system->siteurl."/item-view-id-".$val['id'].'?verified=0';
		$listdb2[$key]['date'] = date('Y-m-d',$val['timestamp']);
		$listdb2[$key]['edit']=$this_system->admin_controller.'/item-update?model='.$val['model'].'&id='.$val['id'].'&verified=0';
	}

	//notify内容
	$notify = $core->load_module('notify');	
	$notify_status = $notify->CONFIG['status'];
	$listdb3 = $DB_master->fetch_all("SELECT n.id, n.title, n.username, n.timestamp, n.content, i.uid, i.`comment`, i.status, i.hash,i.receive FROM ".$core->TABLE_."notify_ as n INNER JOIN ".$core->TABLE_."notify_sign_in as i ON n.id=i.nid WHERE i.uid='$UID' ORDER BY id DESC limit 3");
	foreach($listdb3 as $key => $val){
		$listdb3[$key]['url']=$core->U_controller."/notify-view?id=".$val['id'];
		$listdb3[$key]['date'] = date('Y-m-d H:i',$val['timestamp']);
	}

	//message内容
	$listdb4 = $DB_master->fetch_all("SELECT id, username, title, `new`, timestamp FROM ".$core->TABLE_."message WHERE `sender_uid` != 0 AND `sendee_uid` = '$UID' AND `username` != 'system' AND type = 'in' ORDER BY timestamp DESC limit 3");
	foreach($listdb4 as $key => $val){
		$listdb4[$key]['url'] = $core->U_controller."?main_page=/message-read?id=".$val['id']."&type=in";
		$listdb4[$key]['date'] = date('Y-m-d',$val['timestamp']);
	}

	//常见问题, 调用cid = '903'
	$listdb5 = $DB_master->fetch_all("SELECT id, title FROM ".$core->TABLE_."cms_item WHERE `cid` = '903' ORDER BY timestamp DESC limit 3");
	foreach($listdb5 as $key => $val){
		$listdb5[$key]['url'] = $core->controller."/cms/item-view-id-".$val['id'].".html";
		$listdb5[$key]['date'] = date('Y-m-d',$val['timestamp']);
	}

	//站点公告, 调用cid = '903'
	$listdb6 = $DB_master->fetch_all("SELECT id,title,timestamp FROM ".$core->TABLE_."cms_item WHERE `cid` = '903' ORDER BY timestamp DESC limit 3");
	foreach($listdb6 as $key => $val){
		$listdb6[$key]['url'] = $core->controller."/cms/item-view-id-".$val['id'].".html";
		$listdb6[$key]['date'] = date('Y-m-d',$val['timestamp']);
	}
	//模型
	$models = $this_system->get_models();

	$site_info = $farm->get_site($this_system->SITE);
	//站点账号
	$managers = $roles = $poster = array();

	$uids = $site_info['manager'];
	$last_login_info = array();
	if($uids){	
		$managers = $core->DB_master->fetch_all("SELECT id,username,name,cell_phone,last_login_ip,last_login FROM ".$core->TABLE_."member WHERE id IN ($uids) ORDER BY last_login DESC");
		if($managers) $last_login_info = $managers[0];
	}
	$uids = $site_info['manager_role'];
	if($uids){
		$roles = $core->DB_master->fetch_all("SELECT id,username,name,cell_phone,last_login_ip,last_login FROM ".$core->TABLE_."member WHERE role_id IN ($uids) ORDER BY last_login DESC");
		if(($roles && $managers && $managers[0]['last_login'] < $roles[0]['last_login']) || (!empty($managers) && $roles)) $last_login_info = $roles[0];
	}

	$uids = $site_info['poster'];
	if($uids){
		$poster = $core->DB_master->fetch_all("SELECT id,username,name,cell_phone,last_login_ip,last_login FROM ".$core->TABLE_."member WHERE id IN ($uids) ORDER BY last_login DESC");
		if(empty($last_login_info) && $poster) $last_login_info = $poster[0];
		if($poster && (!empty($managers) || !empty($roles)) && $last_login_info['last_login'] < $poster[0]['last_login']) $last_login_info = $poster[0];
	}

	//用户自定义菜单
	$custom_menu = $CACHE->read($this_system->name.'/menu_custom', $this_system->SITE);

	//$templates = $farm->get_sites_templates();

	//各类统计
	$beginToday = mktime(0,0,0,date('m'),date('d'),date('Y'));
	$beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
	//今日浏览量
	$views_today = $DB_master->fetch_one("select sum(count) as `count` from ".$core->TABLE_."cms_statistic_sites_views where `site`='$site' and `timestamp`='$beginToday'");
	$views_today['count'] = intval($views_today['count']);
	//本月浏览量
	$views_month = $DB_master->fetch_one("select sum(count) as `count` from ".$core->TABLE_."cms_statistic_sites_views where `site`='$site' and `timestamp`>='$beginThismonth'");
	$views_month['count'] = intval($views_month['count']);
	
	//今日
	$item_today = $DB_master->fetch_one("select count(*) as `count` from ".$this_system->TABLE_."item where `site`='$site' and `timestamp`>=".$beginToday);
	//本月
	$item_month = $DB_master->fetch_one("select count(*) as `count` from ".$this_system->TABLE_."item where `site`='$site' and `timestamp`>=".$beginThismonth);
			

	//数据推送采用量
	//今日
	$stop_today = $DB_master->fetch_one("SELECT count(*) as `count` FROM ".$this_system->TABLE_."stop_data WHERE `status` != -99 AND sc = 'c' AND (site='' or find_in_set('$site',site)) AND `timestamp`>=".$beginToday);
	//本月
	$stop_month = $DB_master->fetch_one("select count(*) as `count` from ".$this_system->TABLE_."stop_data WHERE `status` != -99 AND sc = 'c' AND (site='' or find_in_set('$site',site)) AND `timestamp`>=".$beginThismonth);

	//内容扫描错误数量
	$word_scan = $DB_master->fetch_one("SELECT count(*) as `count` FROM ".$core->TABLE_."word_scan WHERE `site`='$site'");

	//大数据扫描错误数量
	$word_censor = $DB_master->fetch_one("SELECT count(*) as `count` FROM ".$core->TABLE_."word_censor WHERE `system` = 'sites' AND `site`='$site'");

	//外链接数量扫描
	$filter_link = $DB_master->fetch_one("SELECT count(*) as `count` FROM ".$core->TABLE_."filter_link WHERE `system` = 'sites' AND `site`='$site'");

	//死链接数量扫描
	$filter_link2 = $DB_master->fetch_one("SELECT count(*) as `count` FROM ".$core->TABLE_."filter_link WHERE `system` = 'sites' AND conn = '0' AND `site`='$site'");


	$allsites  = $this_system->get_sites();

	$core->get_cache('role');

	$datelong = 30;
	$core->DB_master->delete(
		$this_system->log_table,
		'timestamp < '. (P8_TIME - $datelong * 86400)
	);

	$qu = parse_url($_SERVER["REQUEST_URI"]);
	$src = $core->admin_controller.'/sites/farm-list';
	if(!empty($qu['query']) && isset($_GET['frame'])){
	   $src = $core->admin_controller.xss_url( str_replace('frame=','',$qu['query']));
	}
	$config = $core->get_config('core', '');
	$member_info = get_member($USERNAME);
	require_once PHP168_PATH .'admin/inc/menu.class.php';
	$admin_menu->get_cache();
	//菜单JSON
	$json = $CACHE->read('', 'core', 'admin_menu_json');
	//被禁止的菜单,创始人可以查看所有菜单
	//$denied = $IS_FOUNDER ? '{}' : $CACHE->read('', 'core', 'admin_menu_role_'. $core->ROLE);
	$denied = '{}';
	include template($this_system, 'index_new', 'admin');
}else if(REQUEST_METHOD == 'POST'){
	$type = $_POST['type'] ? $_POST['type'] : '';
	$site = $this_system->SITE;
	//各类统计
	$beginToday = mktime(0,0,0,date('m'),date('d'),date('Y'));
	$beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
	$data = array();
	//更新
	switch($type){
		case 'item':
			//今日
			$item_today = $DB_master->fetch_one("select count(*) as `count` from ".$this_system->TABLE_."item where `site`='$site' and `timestamp`>=".$beginToday);
			//本月
			$item_month = $DB_master->fetch_one("select count(*) as `count` from ".$this_system->TABLE_."item where `site`='$site' and `timestamp`>=".$beginThismonth);
			$data['count'] =  $item_today['count'].'/'.$item_month['count'];
		break;
		case 'stop':
			//今日
			$stop_today = $DB_master->fetch_one("SELECT count(*) as `count` FROM ".$this_system->TABLE_."stop_data WHERE `status` != -99 AND sc = 'c' AND (site='' or find_in_set('$site',site)) AND `timestamp`>=".$beginToday);
			//本月
			$stop_month = $DB_master->fetch_one("select count(*) as `count` from ".$this_system->TABLE_."stop_data WHERE `status` != -99 AND sc = 'c' AND (site='' or find_in_set('$site',site)) AND `timestamp`>=".$beginThismonth);
			$data['count'] =  $stop_today['count'].'/'.$stop_month['count'];
		break;
		
		case 'word_scan':			
			$word_scan = $DB_master->fetch_one("SELECT count(*) as `count` FROM ".$core->TABLE_."word_scan WHERE `site`='$site'");
			$data['count'] =  $word_scan['count'];
		break;
		
		case 'word_censor':
			$word_censor = $DB_master->fetch_one("SELECT count(*) as `count` FROM ".$core->TABLE_."word_censor WHERE `system` = 'sites' AND `site`='$site'");
			$data['count'] =  $word_censor['count'];
		break;
		case 'filter_link':
			$filter_link = $DB_master->fetch_one("SELECT count(*) as `count` FROM ".$core->TABLE_."filter_link WHERE `system` = 'sites' AND `site`='$site'");
			$data['count'] =  $filter_link['count'];
		break;
		case 'filter_link2':
			$filter_link2 = $DB_master->fetch_one("SELECT count(*) as `count` FROM ".$core->TABLE_."filter_link WHERE `system` = 'sites' AND conn = '0' AND `site`='$site'");
			$data['count'] =  $filter_link2['count'];	
		break;
		default :
			$data['count'] = 0;		
	}
	echo p8_json($data);	
}

