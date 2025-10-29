<?php
defined('PHP168_PATH') or die();

$this_system->check_manager($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	@set_time_limit(60);
	
	$MODEL = isset($_GET['model']) ? $_GET['model'] : '';
	$Item = $this_system->load_module('item');
    $item_controller = &$core->controller($Item);    
	$my_addible_category = $item_controller->get_acl('my_addible_category') ?: array();
	$_my_category_to_verify = $item_controller->get_acl('my_category_to_verify') ?: array();
	$_my_category_to_verify_first = $item_controller->get_acl('my_category_to_verify_first') ?: array();
	//审核+初审+发布
	$_my_category = $_my_category_to_verify + $_my_category_to_verify_first + $my_addible_category;
	$my_category = $IS_FOUNDER ? "[1]" : p8_json($_my_category);
	
	$models = $this_system->get_models();
	$verified = 1;
	$this_module->get_cache(false);
	$path = array();
	
	foreach($this_module->categories as $v){
		$parents = $this_module->get_parents($v['id']);
		foreach($parents as $vv){
			$path[$v['id']][] = $vv['id'];
		}
		$path[$v['id']][] = $v['id'];
	}
	//views sum
	$get_all_cids = $this_module->make_categories_sort($this_module->top_categories);
	$views_sums = $this_module->get_views_sum();
	$sums = array();
	foreach($get_all_cids as $index_id => $child_cids){
		$ids = array($index_id) + $this_module->get_children_ids($index_id);
		foreach($ids as $index_id_tmp){
			$sums[$index_id] += isset($views_sums[$index_id_tmp]) ? intval($views_sums[$index_id_tmp]) : 0;
		}
	}

	$json = array(
		'json' => p8_json($this_module->make_json_sort($this_module->top_categories)),
		'path' => p8_json($path),
		'models' => p8_json($models),
		'sums' => p8_json($sums)
	);
	$allsites = $this_system->get_sites();
	$sitename_alias = !empty($allsites[$this_system->SITE]['sitename']) ? $allsites[$this_system->SITE]['sitename']  : '';
	$site_url = !empty($allsites[$this_system->SITE]['domain']) ? $allsites[$this_system->SITE]['domain']  : $this_system->siteurl;
	$item_config = $core->get_config($this_system->name,'item');
	$item_config['lan_date'] = isset($item_config['lan_date']) && $item_config['lan_date'] ? $item_config['lan_date']:0;
	$alias = html_entities($this_system->SITE);	
	$farm_data = $this_system->site['config'];
	$statistic_cats = isset($farm_data['statistic_cats']) && $farm_data['statistic_cats'] ? $farm_data['statistic_cats'] : array();
	$statistic_cats = p8_json(array_map('intval',$statistic_cats));	
	//站点信息
	$site = $_GET['site'];
	$site = !empty($site) ? $site : $alias;	
	$site = clear_special_char($site);	
	$site = in_array($site,array_keys($this_system->sites)) ? $site : $this_system->SITE;	
	$site_info = $this_system->get_site($site);	
	include template($this_module, 'list', 'admin');
	//print_r($this_module->top_categories);
}else if(REQUEST_METHOD == 'POST'){
	$do_site_alias = $_GET['site']?$_GET['site']:$this_system->SITE;
	$this_action_site = $this_system->SITE;
	$cid = $_POST['cid'] ? $_POST['cid'] : array();
	//var_dump($do_site_alias);
	@set_time_limit(0);
	
	$action = @$_POST['action'];
	
	switch($action){
	
	case 'fixall':
		//修复栏目内容数		
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
	break;
	
	case 'fix':
		//修复栏目内容数
		$DB_master->update($this_module->table, array('item_count' => 0), "site='{$do_site_alias}'");
		$item_config = $core->get_config($this_system->name,'item');		
		$lan_date_enable = isset($item_config['lan_date_enable']) && $item_config['lan_date_enable'] ? true : false;
		$lan_date_timestamp = isset($item_config['lan_date']) && $item_config['lan_date'] ? intval($item_config['lan_date']) : 0;		
		//局域网限制
		if($lan_date_enable && $lan_date_timestamp){
			//限制部分
			$lan_category = isset($this_system->site['config']['lan_category']) && $this_system->site['config']['lan_category'] ? explode(',',$this_system->site['config']['lan_category']) : array();
			$lan_category = array_filter($lan_category);
			$s = $comma = '';
			foreach($lan_category as $v){
				if($v){
					$s .= $comma ."'$v'";
					$comma = ',';
				}
			}
			$where = $s ? '`timestamp` >= '.$lan_date_timestamp.' and `cid` NOT IN ('. $s .')' : '`timestamp` >= '.$lan_date_timestamp;
			
			$query = $DB_master->query("SELECT cid, COUNT(*) AS `count` FROM $this_system->item_table where site='{$do_site_alias}' and $where GROUP BY cid");
			while($arr = $DB_master->fetch_array($query)){
				$this_module->update_count($arr['cid'], $arr['count']);
			}
			
			//不限制部分
			if(!empty($s)){
				$query = $DB_master->query("SELECT cid, COUNT(*) AS `count` FROM $this_system->item_table WHERE site='{$do_site_alias}' and `cid` IN ($s) GROUP BY cid");
				while($arr = $DB_master->fetch_array($query)){
					$this_module->update_count($arr['cid'], $arr['count']);
				}
			}
		}else{
			$query = $DB_master->query("SELECT cid, COUNT(*) AS `count` FROM $this_system->item_table WHERE site='{$do_site_alias}' GROUP BY cid");
			while($arr = $DB_master->fetch_array($query)){
				$this_module->update_count($arr['cid'], $arr['count']);
			}
		}
		$this_module->cache(FALSE);
	break;
	
	case 'cache':
		//更新缓存
		$this_module->cache(FALSE);
	break;
	
	case 'cache_all':
		$count = count(array_keys($this_system->sites));
		$persentage = round(100/$count,1,PHP_ROUND_HALF_DOWN);
		if($count)
			___poster(p8lang($P8LANG['scanning'],array($persentage)),array_keys($this_system->sites)[0]);
		else
			message('sites_count_err');		
	break;
	case 'each_site_cache':
		$site = isset($_REQUEST['site']) ? $_REQUEST['site'] : '';
		$set_lan = isset($_REQUEST['set_lan']) ? $_REQUEST['set_lan'] : '';
		if($site){			
			$this_system->load_site($site);
			$this_module->exec_cache($site,false, true, array());			
			$sites = $this_system->sites;
			$all_sites = array_keys($sites);
			if($site == end($all_sites)){
				$this_system->load_site($this_action_site);
				if($set_lan) message('done',$this_system->admin_controller.'/item-set_lan',1);				
			}else{
				$index = array_search($site,$all_sites)+1;
				$site = $all_sites[$index];
				$count = count(array_keys($this_system->sites));
				var_dump($count);
				$persentage = round(100*($index+1)/$count,1,PHP_ROUND_HALF_DOWN);
				___poster(p8lang($P8LANG['scanning'],array($persentage)),$site);				
			}
		}
	break;
	
	case 'unhtmlize':
	case 'htmlize':
		//开启/关闭所有静态化
		//if($action == 'htmlize' && (empty($this_system->site['ipordomain']) || empty($this_system->site['domain'])))message('html_set_err');
		$DB_master->update(
			$this_module->table,
			array('htmlize' => $action == 'htmlize' ? 1 : 0),
			"site='{$do_site_alias}'"
		);
		if($action == 'htmlize') $this_module->set_allow_ip_two($do_site_alias);
		$this_module->cache(FALSE);
	break;
	case 'sethtmlize':
		$DB_master->update(
			$this_module->table,
			array('htmlize' => 1),
			"site='{$do_site_alias}'"
		);
		$this_module->set_allow_ip_two($do_site_alias);
		$this_module->cache(FALSE);
		exit('[]');
	break;
	case 'content_lan':
		$item_module = &$this_system->load_module('item');
		$item_module->set_content_html($cid,false);//不限时间
		exit('[]');
	break;
	case 'content_lan_limit':
		$item_module = &$this_system->load_module('item');
		$item_module->set_content_html($cid,true);//限定时间
		exit('[]');
	break;
	case 'content_unlan':
		$item_module = &$this_system->load_module('item');
		$item_module->unset_content_html($cid);
		exit('[]');
	break;
	
	case 'content_unhtmlize':
	case 'content_htmlize':
		//开启/关闭所有内容页静态化
		//if($action == 'content_htmlize' && (empty($this_system->site['ipordomain']) || empty($this_system->site['domain'])))message('html_set_err');
		$DB_master->update(
			$this_module->table,
			array('htmlize' => $action == 'content_htmlize' ? 2 : 0),
			"site='{$do_site_alias}'"
		);
		if($action == 'content_htmlize') $this_module->set_allow_ip_two($do_site_alias);
		$this_module->cache(FALSE);
	break;
	
	default:
		//批量修改栏目排序
		$display_order = isset($_POST['_display_order']) ? array_map('intval', (array)$_POST['_display_order']) : array();
		
		foreach($display_order as $id => $order){
			$id = intval($id);
			
			$DB_master->update(
				$this_module->table,
				array('display_order' => $order),
				"id = '$id' AND site='{$do_site_alias}'"
			);
		}
		
		$display_order && $this_module->cache(FALSE);
		
	}
    
    $this_system->log(array(
		'title' => isset($P8LANG['_module_'.$action.'_admin_log'])?$P8LANG['_module_'.$action.'_admin_log']:$action,
		'request' => $_POST,
	));
	
	message('done');
	
}

function ___poster($message = '',$site = ''){
	global $this_url;
	$form = <<<FORM
$message
<form action="" method="post" id="form">
<input type="hidden" name="action" value="each_site_cache">
<input type="hidden" name="site" value="{$site}">
<input type="hidden" name="set_lan" value="1">
</form>
<script type="text/javascript">
setTimeout(function(){ document.getElementById('form').submit(); }, 1000);
</script>
FORM;
	message($form);
}
