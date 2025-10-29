<?php
defined('PHP168_PATH') or die();

if(!empty($_REQUEST['model'])){
	$this_system->init_model();
	
	$this_model or message('no_such_cms_model');
}else{
	$MODEL = '';
}

$ismanager = $this_system->check_manager();
if(!empty($core->modules['auditflow']) && $core->modules['auditflow']['enabled'] && !empty(intval($core->CONFIG['audit_flow_enable_'.$this_system->SITE]))){
    $auditFlow = &$this_module->core->load_module('auditflow');
    $auditFlowvVerifier = $auditFlow->checkVerfier($UID,$this_system->name,$this_system->SITE);
    if($auditFlowvVerifier)$ismanager = true;
}
$member_module = &$this_module->core->load_module('member');
$acls = $member_module->get_acl($this_module, $UID, $this_system->SITE);
if($acls && ($acls['actions']['add'] || !empty($acls['category_acl']))){
	$ismanager = true;
}
if(!$this_system->check_poster('list') && !$ismanager)message('no_post_and_manger');

//$this_controller->check_action($ACTION) or message('no_privilege');

//加载分类模块
$category = &$this_system->load_module('category');
$category->get_cache(false);

$page_url = $this_router .'-'. $ACTION .'?';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max($page, 1);
$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
$mine = empty($_GET['mine']) ? 0 : 1;
if(isset($_GET['verified'])){
	$verified = intval($_GET['verified']);
	$T = $this_module->unverified_table;
}else{
	$verified = 1;
	$T = $this_module->main_table;
}
$keyword = isset($_GET['keyword']) ? xss_clear(p8_stripslashes2(trim($_GET['keyword']))) : '';
$keyword = $keyword ? $keyword : (isset($_GET['word']) ? xss_clear(p8_stripslashes2(trim($_GET['word']))) : '');
$username = isset($_GET['username']) ? xss_clear(trim($_GET['username'])) : '';
$verifier = isset($_GET['verifier']) ? xss_clear(trim($_GET['verifier'])) : '';
$desc = empty($_GET['order']) ? ' DESC' : ' ASC';
$id = isset($_GET['id']) ? filter_int(explode(',', $_GET['id'])) : '';
$word = urlencode($keyword);
$this_tmp_site = $this_system->SITE;
$page_url = $this_url .'?';
$page_url = 'javascript:request_item(?page?)';
$select = select();
$select->in('i.site', $this_system->SITE);
$select->in('i.uid', $UID);

if($verified == 1){
	if($MODEL){
		$select->from($this_module->table .' AS i', 'i.*');
	}else{
		$select->from($this_module->main_table .' AS i', 'i.*');
	}
}else{
	$select->from($T .' AS i', 'i.*');
	$select->in('i.verified', $verified);
}

$class[abs($verified)]='class="over"';	
if($id){
	$select->in('i.id', $id);	
}else{
	if($cid){
		$category->get_cache();
		$ids = array($cid) + $category->get_children_ids($cid);
		
		$select->in('i.cid', $ids);
		$select->order('i.timestamp'.$desc);
	}else{
		$select->order('i.id'.$desc);
	}
	if(strlen($keyword)){
		$select->search('i.title', $keyword);
	}
	if(strlen($username)){
		$select->in('i.username', $username);
	}
	if(strlen($verifier)){
		$select->in('i.verifier', $verifier);
	}
}

$select->inner_join($this_system->category_table .' AS c', 'c.name AS category_name', 'c.id = i.cid');
//if($verified == 1) $select->left_join($core->TABLE_.'member as m', 'm.name', 'm.username=i.verifier');
//所有模型
$models = $this_system->get_models();
//echo $select->build_sql();
$count = 0;
//取数据
$list = $core->list_item(
	$select,
	array(
		'page' => &$page,
		'count' => &$count,
		'page_size' => 20,
		'ms' => 'master'
	)
);
$usernames = $this_page_ids = $models_addon = array();
foreach($list as $k => $v){
	$list[$k]['url'] = $core->STATIC_URL.'/s.php/'.$this_system->SITE.'/item-view-id-'.$v['id'];
	$list[$k]['url'] .= $verified == 1? '' : '?verified=0';
	$list[$k]['frame_url'] = $core->STATIC_URL.'/s.php/'.$this_system->SITE.'/item-view_frame-id-'.$v['id'];
	$list[$k]['frame_url'] .= $verified == 1? '' : '?verified=0';
	$list[$k]['title'] = p8_cutstr($list[$k]['title'],90);
	$list[$k]['verifier_name'] = !empty($v['verifier']) ? generate_unique_key($v['verifier']) : '';
	if($verified != 1){
		$_data = mb_unserialize($v['data']);
		$list[$k]['cluster_push_cid'] = $_data['cluster_push_cid'] ? intval($_data['cluster_push_cid']):0;
	}else{
		$list[$k]['cluster_push_cid'] = 0;
	}
	if($v['verifier']) $usernames[] = $v['verifier'];
	$list[$k]['attributes'] = explode(',',$v['attributes']);
	if(in_array('10',$list[$k]['attributes'])){
		$this_page_ids[] = $v['id'];		
	}
	$models_addon[$v['model']][$k] = $v['id'];
	$list[$k]['lan_access_only'] = 0;
}
/*局域网*/
foreach($models_addon as $model_ => $model_ids){
	if(!$model_) continue;
	$table = $this_module->TABLE_ .$model_.'_';
	$where = 'where id in ('.implode(',',array_values($model_ids)).')';
	$query = $core->DB_master->query("select `id`,`config` from $table $where");
	$model_ids_flip = array_flip($model_ids);
	while($arr = $core->DB_master->fetch_array($query)){
		$v_config = $arr['config'] ? mb_unserialize(stripslashes($arr['config'])) : array();
		if($v_config && $v_config['allow_ip']['enabled'] >= 1){
			$list[$model_ids_flip[$arr['id']]]['lan_access_only'] = 1;
		}
	}	
}
//member_info
$member_info = array();
if($verified == 1 && $usernames){
	$push_usernames_string = '';
	$div = '';
	foreach(array_unique($usernames) as $username_tmp){
		$push_usernames_string .= $div."'".$username_tmp."'";
		$div = ',';
	}
	$member_table = $core->TABLE_.'member';
	$sql = "SELECT id,username,name FROM `$member_table` WHERE username in ($push_usernames_string);";
	$query = $core->DB_master->query($sql);
	while($arr = $core->DB_master->fetch_array($query)){
		$md5_username = generate_unique_key($arr['username']);
		$member_info[$md5_username] = $arr['name'];
	}
}

//分页
$pages = list_page(array(
	'count' => $count,
	'page' => $page,
	'page_size' => 20,
	'url' => $page_url
));

$allsites = $this_system->get_sites();
$sitename = !empty($allsites[$this_system->SITE]['sitename']) ? $allsites[$this_system->SITE]['sitename']  : '';
$site_domain = !empty($allsites[$this_system->SITE]['domain']) ? $allsites[$this_system->SITE]['domain']  : $this_system->controller;
$item_config = $core->get_config('sites', 'item');
$allow_verify_frame = $item_config['menu_verify_frame'] ? false : true;
//获取栏目预警信息
$days = array();
foreach($category->categories as $v){
	if($v['CONFIG']['post_size'] && !empty($v['CONFIG']['manager']) && in_array($UID,$v['CONFIG']['manager'])){
		$days[$v['CONFIG']['post_size']][] = $v['id'];
	}	
}
$days = array_map('array_unique',$days);
$table = $this_module->main_table;
$message = array();
foreach($days as $day=>$check_cids){
	$day = intval($day);
	if($day && $check_cids){
		foreach($check_cids as $check_cid){
			$ids = array($check_cid);
			$ids = $category->get_children_ids($check_cid) + $ids;		
			$SQL = "SELECT COUNT(*) as count FROM $table WHERE site = '$this_tmp_site' and cid in (".implode(',',$ids).") and timestamp >= UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL $day DAY)) 
			AND timestamp <= UNIX_TIMESTAMP(NOW())";
			$ret = $core->DB_master->fetch_one($SQL);
			if(empty($ret['count'])) $message[$day][] = $check_cid;
		}
	}
}
$show_message = '<ul>';
$message_count = 0;
krsort($message);
foreach($message as $d=>$sids){	
	$show_message .= '<li style="clear:both;line-height:26px;">内容<font color="red"> '.$d.' </font>天没有更新的栏目：</li>';	
	$left = $d >=10 ? 70 : 62;
	foreach($sids as $sid){
		$each_message = '';
		$parent_cats = $category->get_parents($sid);
		$dot = '';
		foreach($parent_cats as $v){
			$each_message .= $dot.$v['name'];
			$dot = ' &gt; ';
		}
		$each_message .= $dot.$category->categories[$sid]['name'];
		$model = $category->categories[$sid]['model'];
		$show_message .= '<li style="clear:both;"><span style="color:#0079bd;float:left;padding-left:'.$left.'px;">'.$each_message.'</span>';
		$type=$category->categories[$sid]['type'];
		if($category->categories[$sid]['type'] != 1){
			$show_message .= '<span style="float:right;padding-right:10px;"><a href="'.$core->U_controller.'/sites/item-add?model='.$model.'&cid='.$sid.'&site='.$this_tmp_site.'" target="_blank" style="color:#0079bd;">去发布>></a></span>';
		}
		$show_message .= '</li>';
		$message_count ++;
		if($message_count>15) break;
	}
	if($message_count>15) break;
}
$show_message .= '</ul>';
$message_height = 140;
$message_height += $message_count * 26;
$message_height = $message_height < 120 ? 120 : $message_height;
$message_height = $message_height > 520 ? 520 : $message_height;
if($verified == 1){
	//推送数据到总站
	$allow_cluster_push =  empty($this_module->CONFIG['menu_cluster_push_partent']) && $this_controller->check_action('cluster_push');
	//分站间直推送数据
	$allow_sites_push_sites = empty($this_module->CONFIG['menu_cluster_sites_push_sites']) && $this_controller->check_action('sites_push_sites');
	$allow_clone = empty($this_module->CONFIG['menu_clone']) && $this_controller->check_action('clone');
}else{
	$allow_cluster_push = $allow_sites_push_sites = $allow_clone = false;
}
$cms_system = $core->load_system('cms');
$item_module = &$cms_system->load_module('item');
$cms_my_addible_category = $core->controller($item_module)->get_acl('my_addible_category');
$push_addible_category = p8_json($cms_my_addible_category);

//push_info
$push_info = array();
if($this_page_ids){
	$push_ids_string = '';
	$div = '';
	foreach($this_page_ids as $ids_tmp){
		$push_ids_string .= $div."'".$ids_tmp."'";
		$div = ',';
	}
	$stop_table = $core->TABLE_.'sites_stop_data';
	$sql = "SELECT * FROM `$stop_table` WHERE `sc` = 'c' AND `from`='sites' AND `site` = '$this_system->SITE' and `item_id` in ($push_ids_string);";
	$query = $core->DB_master->query($sql);
	while($arr = $core->DB_master->fetch_array($query)){
		$push_info[$arr['item_id']]['status'] = $arr['status'];
		$push_info[$arr['item_id']]['to'] = $arr['to'];
	}	
}
//属性JSON
$attributes = array();
foreach($this_module->attributes as $aid => $lang){
	$attributes[$aid] = $this_module->CONFIG['attributes'][$aid] ? $this_module->CONFIG['attributes'][$aid] : $P8LANG['sites_item']['attribute'][$aid];
}
$attributes[30] = $P8LANG['sites_item']['attribute_cms'];
$attributes[31] = $P8LANG['sites_item']['attribute_sites'];

$attr_json = p8_json($attributes);
$allsites = $_allsites = $this_system->get_sites();
unset($_allsites[$this_system->SITE]);
$_allsites = array_keys($_allsites);
$selected_site = current($_allsites);
include template($this_module, 'my_list');