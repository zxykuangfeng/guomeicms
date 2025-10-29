<?php
defined('PHP168_PATH') or die();

//$this_system->check_manager('config') or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	$this_module->cache(false);
	$this_module->cache_recycle(false);
    $this_system->log(array(
		'title' => $P8LANG['_module_cache_admin_log'],
		'request' => $_GET,
	));
	message('done', $this_router .'-list');
	
}else if(REQUEST_METHOD == 'POST'){
	
	@set_time_limit(0);
	//修复栏目内容数
	$do_site_alias = $this_system->SITE;
	$item_config = $core->get_config($this_system->name,'item');		
	$lan_date_enable = isset($item_config['lan_date_enable']) && $item_config['lan_date_enable'] ? true : false;
	$lan_date_timestamp = isset($item_config['lan_date']) && $item_config['lan_date'] ? intval($item_config['lan_date']) : 0;		
	//局域网限制
	if($lan_date_enable && $lan_date_timestamp){
		foreach($this_system->sites as $site_alias =>$siteval){
			if(empty($siteval['status'])) continue;
			//限制部分
			$this_system->load_site($site_alias);
			$DB_master->update($this_module->table, array('item_count' => 0), "site='{$site_alias}'");				
			$lan_category = isset($this_system->site['config']['lan_category']) && $this_system->site['config']['lan_category'] ? explode(',',$this_system->site['config']['lan_category']) : array();
			$lan_category = array_filter($lan_category);
			$s = $comma = '';
			foreach($lan_category as $v){
				if($v){
					$s .= $comma ."$v";
					$comma = ',';
				}
			}
			$where = $s ? ' and timestamp >= '.$lan_date_timestamp.' and cid NOT IN ('. $s .')' : ' and timestamp >= '.$lan_date_timestamp;				
			$query = $DB_master->query("SELECT cid, COUNT(*) AS `count` FROM $this_system->item_table where site='{$site_alias}' $where GROUP BY cid");
			while($arr = $DB_master->fetch_array($query)){
				$this_module->update_count_all($arr['cid'], $arr['count']);
			}
			//不限制部分
			if(!empty($s)){
				$query = $DB_master->query("SELECT cid, COUNT(*) AS `count` FROM $this_system->item_table WHERE site='{$site_alias}' and `cid` IN ($s) GROUP BY cid");
				while($arr = $DB_master->fetch_array($query)){
					$this_module->update_count_all($arr['cid'], $arr['count']);
				}
			}
		}
	}	
	$this_system->load_site($do_site_alias);
	$this_module->cache();
	$this_module->cache_recycle();
	
	//跳回总缓存
	!empty($_POST['_all_cache_']) && message($BACKTO_ALL_CACHE);
	
	message('done', $this_router .'-list');
}
