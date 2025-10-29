<?php
defined('PHP168_PATH') or die();
if(!empty($core->modules['auditflow']) && $core->modules['auditflow']['enabled'] && !empty(intval($core->CONFIG['audit_flow_enable_'.$this_system->SITE]))){
    include_once __DIR__.'/verify_auditflow.php';
    return;
}
($this_system->check_manager($ACTION) || $this_controller->check_action($ACTION,$this_system->SITE)) or message('', $this_module->U_controller . '-verify_first?site='.$this_system->SITE, 0);

if(REQUEST_METHOD == 'GET'){

	$MODEL = '';

	if(isset($_REQUEST['model'])) $this_system->init_model();

	$MODEL && load_language($this_module, $MODEL);

	$page_url = $this_router .'-'. $ACTION .'?';

	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$page = max($page, 1);
	$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
	$my_category_to_verify = $this_controller->get_acl('my_category_to_verify', $this_system->SITE);
	$keyword = isset($_GET['keyword']) ? p8_stripslashes2(ltrim($_GET['keyword'])) : '';
	$keyword = $keyword ? $keyword : (isset($_GET['word']) ? p8_stripslashes2(ltrim($_GET['word'])) : '');
	$username = isset($_GET['username']) ? trim($_GET['username']) : '';
	$verifier = isset($_GET['verifier']) ? trim($_GET['verifier']) : '';
	$order =  isset($_GET['order']) && $_GET['order'] ? intval($_GET['order']) : 0;
	$id = isset($_GET['id']) ? filter_int(explode(',', $_GET['id'])) : '';
	$word = urlencode($keyword);

	if(isset($_GET['verified'])){
		$verified = intval($_GET['verified']);
		$T = $verified == 1 ? $this_module->main_table : $this_module->unverified_table;
		
	}else{
		$verified = 1;
		$T = $this_module->main_table;
	}
	if (!in_array($verified, [0,1,2,3,66,77,88,-99,-100])) {
		message('no_privilege');
	}
	//如果是初审，去掉终审
	if($verified == 0) {
		unset($this_module->CONFIG['verify_acl'][1]);
	}
	$class[abs($verified)]='class="over"';
	/*
	$page_url .= '&verified='. $verified;
	$page_url .= '&model='. $MODEL;
	$page_url .= '&cid='. $cid;
	$page_url .= '&word='. urlencode($keyword);
	$page_url .= '&page=?page?';
	*/
	$page_url = $this_url .'?';
	$page_url = 'javascript:request_item(?page?)';

	$select = select();
	$my_category_to_verify = $this_controller->get_acl('my_category_to_verify', $this_system->SITE);
	$my_category_to_verify_first = $this_controller->get_acl('my_category_to_verify_first', $this_system->SITE);
	$my_addible_category = p8_json($my_category_to_verify);
	$category = &$this_system->load_module('category');
	$category->get_cache();

	if($verified == 1){
		if($MODEL){
			$select->from($this_module->table .' AS i', 'i.*');
		}else{
			$select->from($this_module->main_table .' AS i', 'i.*');
		}
	}else{
		$select->from($T .' AS i', 'i.*');
		switch($verified){
			case '-100':
				$select->in('i.verified', 88,true);
				break;
			case '3':
				$select->in('i.verified', array(0,2));
				break;
			default:
				$select->in('i.verified', $verified);
		}	
	}
	$select->in('i.site', $this_system->SITE);
	if($id){
		$select->in('i.id', $id);	
	}else{    
		/*
		if($this_system->check_manager()){
			if($cid){
				$category->get_cache();
				$ids = array($cid) + $category->get_children_ids($cid);		
				$select->in('i.cid', $ids);
			}
		}elseif($cid || $my_category_to_verify){
			$category->get_cache();
			if($cid){
				$ids = array($cid) + $category->get_children_ids($cid);
				$select->in('i.cid', $ids);
			}else if($my_category_to_verify){			
				$mycids = array_keys($my_category_to_verify);
				if(count($mycids) > 1 || count($mycids) == 1 && $mycids[0] != 0) $select->in('i.cid', $mycids);
			}	
		}else{
			if($cid){
				$category->get_cache();
				$ids = array($cid) + $category->get_children_ids($cid);		
				$select->in('i.cid', $ids);
			}else{
				$select->in('i.cid', '-1');
			}
		}
		*/
		$show[0] = $show[1] = $show[2] = $show[3] = $show[66] = $show[77] = $show[88] = $show[99] = true;    
		if (isset($my_category_to_verify[0])) {
			if (!$IS_FOUNDER) {
				if (isset($my_category_to_verify_first[0])) {
					$show[0] = $show[2] = false;
				} elseif (!empty($my_category_to_verify_first)) {
					$array_intersect = array_keys($my_category_to_verify_first);
					if ($verified == 3) {
						$select->in('i.cid', array_keys($array_intersect));
					}
					if ($verified == 2) {
						$select->in('i.cid', array_keys($array_intersect), true);
					}
					if ($verified == 0) {
						$select->in('i.cid', array_keys($array_intersect), true);
					}
				} else {
					$show[0] = $show[3] = false;
				}
			}
		} elseif (!empty($my_category_to_verify)) {
			if (!$IS_FOUNDER) {
				if (isset($my_category_to_verify_first[0])) {
					$array_intersect = array_keys($my_category_to_verify);
					if ($verified == 0 || $verified == 2) {
						$select->in('i.cid', $array_intersect, true);
					}
					if (in_array($verified, [1, 3, 66])) {
						$select->in('i.cid', $array_intersect);
					}
				} elseif (!empty($my_category_to_verify_first)) {
					$array_intersect = array_intersect(array_keys($my_category_to_verify),
						array_keys($my_category_to_verify_first));
					$array_merge = array_unique(array_merge(array_keys($my_category_to_verify),
						array_keys($my_category_to_verify_first)));
					$array_diff_verify = array_diff(array_keys($my_category_to_verify),
						array_keys($my_category_to_verify_first));
					$array_diff_verify_first = array_diff(array_keys($my_category_to_verify_first),
						array_keys($my_category_to_verify));

					if (empty($array_intersect)) {
						$show[3] = false;
						if ($verified == 0) {
							$select->in('i.cid', array_keys($my_category_to_verify_first));
						}
						if (in_array($verified, [1, 2, 66])) {
							$select->in('i.cid', array_keys($my_category_to_verify));
						}
						if (abs($verified) == 99) {
							$select->in('i.cid', $array_merge);
						}
					} else {
						if (in_array($verified, [1, 66, 99])) {
							$select->in('i.cid', array_keys($my_category_to_verify));
						}
						if ($verified == 3) {
							$select->in('i.cid', $array_intersect);
						}
						if (empty($array_diff_verify_first)) {
							$show[0] = false;
						}
						if (empty($array_diff_verify)) {
							$show[2] = false;
						}
						if ($verified == 0 && !empty($array_diff_verify_first)) {
							$select->in('i.cid', $array_diff_verify_first);
						}
						if ($verified == 2 && !empty($array_diff_verify)) {
							$select->in('i.cid', $array_diff_verify);
						}
					}
				} else {
					$show[0] = $show[3] = false;
					$mycids = array_keys($my_category_to_verify);
					if (count($mycids) > 1 || count($mycids) == 1 && $mycids[0] != 0) {
						$select->in('i.cid', $mycids);
					}
				}
			}else{
				if($cid){
					$category->get_cache();
					$ids = array($cid) + $category->get_children_ids($cid);		
					$select->in('i.cid', $ids);
				}
			}
		} else {
			if (!$IS_FOUNDER) {
				$show[2] = $show[3] = false;
				if (isset($my_category_to_verify_first[0])) {
					if ($cid) {
						$select->in('i.cid', $cid);
					}
				} elseif (!empty($my_category_to_verify_first)) {
					$select->in('i.cid', array_keys($my_category_to_verify_first));
				}
			}else{
				if($cid){
					$category->get_cache();
					$ids = array($cid) + $category->get_children_ids($cid);		
					$select->in('i.cid', $ids);
				}
			}
		}
		if ($IS_FOUNDER || $this_system->check_manager($ACTION)) {
			$show[0] = $show[1] = $show[2] = $show[3] = $show[66] = $show[77] = $show[88] = $show[99] = true;
		}
		switch($order){
			case '1':
				$select->order('i.timestamp ASC, i.level DESC');
			break;
			case '2':
				$select->order('i.level DESC, i.timestamp DESC');
			break;			
			default:
				$select->order('i.timestamp DESC, i.level DESC');
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

	//$select->order('i.id DESC');

	//所有模型
	$models = $this_system->get_models();

	$count = 0;
	$select->left_join($core->TABLE_.'member as m', 'm.name as poster_name', 'm.username=i.username');
	//$select->left_join($core->TABLE_.'member as v', 'v.name as verifier_name', 'v.username=i.verifier');
	//echo $select->build_sql();
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
	$usernames = $this_page_ids = array();
	$this_domain = $this_system->domain;
	$mconfig = $core->get_config('core', 'member');
	$dept = array();
	foreach($mconfig['dept'] as $value){
		$dept[$value['code']] = $value['name'];
	}
	$models_addon = array();
	foreach($list as $key => $row){	
		if($category->categories[$row['cid']]['htmlize']){
			$row['#category'] = $category->categories[$row['cid']];
			$list[$key]['url'] = $this_system->site_p8_url($this_module, $row, 'view');
			$list[$key]['url'] = html_entity_decode(attachment_url($list[$key]['url'],false,true));
		}else{
			$list[$key]['url'] =  $this_system->siteurl.'/item-view-id-'.$row['id'].'?verified='.$row['verified'];
		}	
		if(substr($row['url'],0,7)=='http://') $list[$key]['url'] = $row['url'];
		$list[$key]['department'] = $row['department'] && $dept[$row['department']] ? $dept[$row['department']] : '';
		$list[$key]['level'] = isset($P8LANG['sites_item']['level_rank'][$row['level']]) && $row['level']>240 ? $P8LANG['sites_item']['level_rank'][$row['level']] : $row['level'];
		//$list[$key]['url'] = $core->STATIC_URL.'/s.php/'.$this_system->SITE.'/item-view-id-'.$row['id'];
		//$list[$key]['url'] .= $verified == 1? '' : '?verified=0';
		//$list[$key]['frame_url'] = $core->STATIC_URL.'/s.php/'.$this_system->SITE.'/item-view_frame-id-'.$row['id'];
		//$list[$key]['frame_url'] .= $verified == 1? '' : '?verified=0';
		$list[$key]['title'] = p8_cutstr($list[$key]['title'],90);
		$list[$key]['attributes'] = explode(',',$row['attributes']);
		if(in_array('10',$list[$key]['attributes'])){
			$this_page_ids[] = $row['id'];		
		}
		$list[$key]['poster_name'] = !empty($row['username']) ? generate_unique_key($row['username']) : '';
		$list[$key]['verifier_name'] = !empty($row['verifier']) ? generate_unique_key($row['verifier']) : '';
		$list[$key]['static_url'] = $list[$key]['url'];	
		if(strpos($this_domain,'/s.php/') === false && strpos($list[$key]['static_url'],'http') === false && strpos($list[$key]['static_url'],'/s.php/') === false){
			$list[$key]['static_url'] = $this_domain.$list[$key]['static_url'];
		}else if(strpos($list[$key]['static_url'],'http') === false && strpos($list[$key]['static_url'],'/s.php/') === false){
			$list[$key]['static_url'] = '/sites/html/'.$this_system->SITE.$list[$key]['static_url'];
		}
		if($row['username']) $usernames[] = $row['username'];
		if($row['verifier']) $usernames[] = $row['verifier'];
		if($verified != 1){
			$_data = mb_unserialize($row['data']);
			$list[$key]['cluster_push_cid'] = $_data['cluster_push_cid'] ? intval($_data['cluster_push_cid']):0;
		}else{
			$list[$key]['cluster_push_cid'] = 0;
		}
		$models_addon[$row['model']][$key] = $row['id'];
		$list[$key]['lan_access_only'] = 0;
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
	if($usernames){
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
	//分页
	$pages = list_page(array(
		'count' => $count,
		'page' => $page,
		'page_size' => 20,
		'url' => $page_url
	));

	$allsites = $_allsites = $this_system->get_sites();
	$sitename = !empty($allsites[$this_system->SITE]['sitename']) ? $allsites[$this_system->SITE]['sitename']  : '';
	$site_domain = !empty($allsites[$this_system->SITE]['domain']) ? $allsites[$this_system->SITE]['domain']  : $this_system->controller;

	//属性JSON
	$attributes = array();
	foreach($this_module->attributes as $aid => $lang){
		$attributes[$aid] = $this_module->CONFIG['attributes'][$aid] ? $this_module->CONFIG['attributes'][$aid] : $P8LANG['sites_item']['attribute'][$aid];
	}
	$attributes[30] = $P8LANG['sites_item']['attribute_cms'];
	$attributes[31] = $P8LANG['sites_item']['attribute_sites'];

	$attr_json = p8_json($attributes);
	//推送数据到分站
	$allow_sites_push =  $this_controller->check_action('sites_push');	
	$allow_view_to_html = $this_controller->check_action('view_to_html');	
	if($verified == 1){
		//推送数据到总站
		$allow_cluster_push =  empty($this_module->CONFIG['menu_cluster_push_partent']) && $this_controller->check_action('cluster_push');
		//分站间直推送数据
		$allow_sites_push_sites = empty($this_module->CONFIG['menu_cluster_sites_push_sites']) && $this_controller->check_action('sites_push_sites');
		$allow_clone = empty($this_module->CONFIG['menu_clone']) && $this_controller->check_action('clone');
	}else{
		$allow_cluster_push = $allow_sites_push_sites = $allow_clone = false;
	}	
	$site_info = $this_system->get_site($this_system->SITE);
	$independent_verify = !empty($site_info['config']['independent_verify']) ? true : false;	
	$allow_verify = $allow_verify_o = $independent_verify ? $this_controller->check_action('verify','',true) : true;
	$allow_verify or message('', $this_module->U_controller . '-verify_first?site='.$this_system->SITE, 0);
	$allow_verify_frame = $this_module->CONFIG['verify_frame_editable'] && $this_module->CONFIG['menu_verify_frame'] ? false : true;
	$sync_index_to_html = $this_module->CONFIG['sync_index_to_html'] ? 1 : 0;
	$cms_system = $core->load_system('cms');
	$item_module = &$cms_system->load_module('item');
	unset($_allsites[$this_system->SITE]);
	$_allsites = array_keys($_allsites);
	$selected_site = current($_allsites);
	//顺序改一下
	$verify_acl = $this_module->CONFIG['verify_acl'];
	foreach($verify_acl as $key=>$val){
		$verify_acl[$key]['name'] = $val['name'] ? $val['name'] : $P8LANG['sites_item']['verify'][$key];
	}
	$verify_acl_sort = array();
	if(isset($verify_acl[-99])){ $verify_acl_sort[-99] = $verify_acl[-99];unset($verify_acl[-99]);}
	if(isset($verify_acl[88])){ $verify_acl_sort[88] = $verify_acl[88];unset($verify_acl[88]);}
	if(isset($verify_acl[0])){ $verify_acl_sort[0] = $verify_acl[0];unset($verify_acl[0]);}
	if(isset($verify_acl[2])){ $verify_acl_sort[2] = $verify_acl[2];unset($verify_acl[2]);}
	if(isset($verify_acl[1])){ $verify_acl_sort[1] = $verify_acl[1];unset($verify_acl[1]);}
	foreach($verify_acl as $key=>$val){
		$verify_acl_sort[$key] = $val;
	}
	$this_module->CONFIG['verify_acl'] = $verify_acl_sort ? $verify_acl_sort : $this_module->CONFIG['verify_acl'];
	$cms_my_addible_category = $core->controller($item_module)->get_acl('my_addible_category');
	$push_addible_category = p8_json($cms_my_addible_category);
	include template($this_module, 'verify');	
}else if(REQUEST_METHOD == 'POST'){
	//只提供AJAX调用
	
	$id = isset($_POST['id']) ? $_POST['id'] : array();
	$value = isset($_POST['value']) ? intval($_POST['value']) : 0;
	$id or message('no_such_item');
	$site_info = $this_system->get_site($this_system->SITE);
	$independent_verify = !empty($site_info['config']['independent_verify']) ? true : false;
	if($independent_verify && $value != 88){
		$this_controller->check_admin_action('verify','',true) or  message('no_such_item');
	}
	$id = filter_int($id);
	$id or exit('[]');
	
	$verified = isset($_POST['verified']) && $_POST['verified'] == 1 ? 1 : 0;
	//退稿理由
	$push_back_reason = isset($_POST['push_back_reason']) ? html_entities(from_utf8($_POST['push_back_reason'])) : '';
	$member_info = get_member($USERNAME);
	$push_back_reason .= date('Y-m-d H:i:s', P8_TIME).' '.$P8LANG['verifier'].':'.$USERNAME.($member_info['name'] ? '('.$member_info['name'].')' : '');	
	$T = $value == 1 ? $this_module->unverified_table : $this_module->main_table;
	$T = $verified ? $this_module->main_table : $this_module->unverified_table;
	
	$cond = $T .'.id IN ('. implode(',', $id) .')';
	$ret = $this_controller->verify(array(
		'where' => $cond,
		'value' => $value,
		'verified' => $verified,
		'push_back_reason' => $push_back_reason
	))or exit('[]');
	exit(jsonencode($ret));
}
