<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	
	$form = <<<EOT
<form id="form" method="post" action="$this_url">
</form>
<script type="text/javascript">
if(confirm('$P8LANG[confirm_to_do]')){
	document.getElementById('form').submit();
}else{
	window.location.href = '$HTTP_REFERER';
}
</script>
EOT;
	message($form);
	
}else if(REQUEST_METHOD == 'POST'){
	
	@set_time_limit(0);
	//修复栏目内容数
	$DB_master->update($this_module->table, array('item_count' => 0), '');
	$item_config = $core->get_config($this_system->name,'item');		
	$lan_date_enable = isset($item_config['lan_date_enable']) && $item_config['lan_date_enable'] ? true : false;
	$lan_date_timestamp = isset($item_config['lan_date']) && $item_config['lan_date'] ? intval($item_config['lan_date']) : 0;		
	//局域网限制
	if($lan_date_enable && $lan_date_timestamp){
		//限制部分
		$lan_category = isset($item_config['lan_category']) && $item_config['lan_category'] ? explode(',',$item_config['lan_category']) : array();	
		$lan_category = array_filter($lan_category);
		$s = $comma = '';
		foreach($lan_category as $v){
			if($v){
				$s .= $comma ."$v";
				$comma = ',';
			}
		}
		$where = $s ? 'timestamp >= '.$lan_date_timestamp.' and cid NOT IN ('. $s .')' : 'timestamp >= '.$lan_date_timestamp;
		$query = $DB_master->query("SELECT cid, COUNT(*) AS `count` FROM $this_system->item_table where $where GROUP BY cid");
		while($arr = $DB_master->fetch_array($query)){
			$this_module->update_count($arr['cid'], $arr['count']);
		}
		//不限制部分
		if(!empty($s)){
			$query = $DB_master->query("SELECT cid, COUNT(*) AS `count` FROM $this_system->item_table where `cid` IN ($s) GROUP BY cid");
			while($arr = $DB_master->fetch_array($query)){
				$this_module->update_count($arr['cid'], $arr['count']);
			}
		}
	}else{
		$query = $DB_master->query("SELECT cid, COUNT(*) AS `count` FROM $this_system->item_table GROUP BY cid");
		while($arr = $DB_master->fetch_array($query)){
			$this_module->update_count($arr['cid'], $arr['count']);
		}
	}
	$this_module->cache();
	$this_module->cache_recycle();
	//跳回总缓存
	!empty($_POST['_all_cache_']) && message($BACKTO_ALL_CACHE);
	
	message('done', $this_router .'-list');
}
