<?php
defined('PHP168_PATH') or die();
if(!empty($core->modules['auditflow']) && $core->modules['auditflow']['enabled'] && !empty(intval($core->CONFIG['audit_flow_enable_'.$this_system->SITE]))){
    include_once __DIR__.'/verify_auditflow.php';
    return;
}
($this_system->check_manager($ACTION) || $this_controller->check_action($ACTION,$this_system->SITE)) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){

	$MODEL = '';

	if(isset($_REQUEST['model'])) $this_system->init_model();

	$MODEL && load_language($this_module, $MODEL);

	$page_url = $this_router .'-'. $ACTION .'?';

	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$page = max($page, 1);
	$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
	$keyword = isset($_GET['keyword']) ? p8_stripslashes2(ltrim($_GET['keyword'])) : '';
	$keyword = $keyword ? $keyword : (isset($_GET['word']) ? p8_stripslashes2(ltrim($_GET['word'])) : '');
	$username = isset($_GET['username']) ? trim($_GET['username']) : '';
	$verifier = isset($_GET['verifier']) ? trim($_GET['verifier']) : '';
	$desc = empty($_GET['order']) ? ' DESC' : ' ASC';
	$id = isset($_GET['id']) ? filter_int(explode(',', $_GET['id'])) : '';
	$word = urlencode($keyword);
	$sync_index_to_html = 0;
	if(isset($_GET['verified'])){
		$verified = intval($_GET['verified']);
		$T = $verified == 1 ? $this_module->main_table : $this_module->unverified_table;
		
	}else{
		$verified = 0;
		$T = $this_module->unverified_table;
	}

	$class = array(
		'0' => '',
		'1'=> '',
		'2' => '',
		'3' => '',
		'66' => '',
		'77' => '',
		'88' => '',
		'99' => '',
	);
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

	$my_category_to_verify = $this_controller->get_acl('my_category_to_verify_first', $this_system->SITE);

	$category = &$this_system->load_module('category');
	$category->get_cache();

	$select->from($T .' AS i', 'i.*');
	$select->in('i.verified', $verified);

	$show[0]=$show[1]=$show[2]=$show[3]=$show[66]=$show[77]=$show[88]=$show[99]=true;
	if(isset($my_category_to_verify[0]) || $IS_FOUNDER){
		if($cid)$select->in('i.cid',$cid);
	}elseif(!empty($my_category_to_verify)){
		$my_category_to_verify =array_keys($my_category_to_verify);
		if($cid && in_array($cid, $my_category_to_verify))
			$select->in('i.cid', $cid);
		else 
			$select->in('i.cid', $my_category_to_verify);

	}else{
		message('no_category_privilege');
	}
	$select->in('i.site', $this_system->SITE);
	if($id){
		$select->in('i.id', $id);	
	}else{
		if($cid){		
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
	//所有模型
	$models = $this_system->get_models();

	$count = 0;
	$select->left_join($core->TABLE_.'member as m', 'm.name', 'm.username=i.username');
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
	$mconfig = $core->get_config('core', 'member');
	$dept = array();
	foreach($mconfig['dept'] as $value){
		$dept[$value['code']] = $value['name'];
	}
	foreach($list as $k => $v){
		$list[$k]['title']=p8_cutstr($list[$k]['title'],66);		
		$list[$k]['url'] = $this_system->site_p8_url($this_module, $v, 'view');
		$list[$k]['url'] .= $verified == 1? '' : '?verified=0';
		if($verified != 1){
			$data = unserialize($v['data']);
			$list[$k]['verifier'] = $data['main']['verifier'];
		}
		$list[$k]['department'] = $v['department'] && $dept[$v['department']] ? $dept[$v['department']] : '';
		$list[$k]['level'] = isset($P8LANG['sites_item']['level_rank'][$v['level']]) && $v['level']>240 ? $P8LANG['sites_item']['level_rank'][$v['level']] : $v['level'];
		$list[$k]['poster_name'] = !empty($v['username']) ? generate_unique_key($v['username']) : '';
		if($v['username']) $usernames[] = $v['username'];
		if($v['verifier']) $usernames[] = $v['verifier'];
		if($verified != 1){
			$_data = mb_unserialize($v['data']);
			$list[$k]['cluster_push_cid'] = $_data['cluster_push_cid'] ? intval($_data['cluster_push_cid']):0;
		}else{
			$list[$k]['cluster_push_cid'] = 0;
		}
	}
	//分页
	$pages = list_page(array(
		'count' => $count,
		'page' => $page,
		'page_size' => 20,
		'url' => $page_url
	));
	$item_config = $core->get_config('sites','item');
	$site_info = $this_system->get_site($this_system->SITE);
	$independent_verify = !empty($site_info['config']['independent_verify']) ? true : false;	
	$allow_verify = $independent_verify ? $this_controller->check_action('verify','',true) : true;
	$allow_verify_first = $independent_verify ? $this_controller->check_action('verify_first','',true) : true;
	$allow_verify = $allow_verify || $allow_verify_first;
	$allow_verify or message('no_privilege');
	$allow_verify_frame = $item_config['menu_verify_frame'] ? false : true;
	$allsites = $_allsites = $this_system->get_sites();
	$sitename = !empty($allsites[$this_system->SITE]['sitename']) ? $allsites[$this_system->SITE]['sitename']  : '';
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
	$cms_system = $core->load_system('cms');
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
	include template($this_module, 'verify_first');
	
}else if(REQUEST_METHOD == 'POST'){
	//只提供AJAX调用
	$id = isset($_POST['id']) ? $_POST['id'] : array();
	$value = isset($_POST['value']) ? intval($_POST['value']) : 0;
	$id or message('no_such_item');
	
	$id = filter_int($id);
	$id or exit('[]');
	/*0 2 -99*/
	$verified = 0;
	if(isset($_POST['verified'])){
		$int_verified = intval($_POST['verified']);
		$verified = $int_verified < 0 ? -99 : ($int_verified > 1 ? 2 : 0);		
	}
	//退稿理由
	$push_back_reason = isset($_POST['push_back_reason']) ? html_entities(from_utf8($_POST['push_back_reason'])) : '';
	$member_info = get_member($USERNAME);
	$push_back_reason .= date('Y-m-d H:i:s', P8_TIME).' '.$P8LANG['verifier'].':'.$USERNAME.($member_info['name'] ? '('.$member_info['name'].')' : '');	
	$T = $this_module->unverified_table;
	
	$cond = $T .'.id IN ('. implode(',', $id) .')';
	$send = array(
		'where' => $cond,
		'value' => $value,
		'verified' => $verified,
		'push_back_reason' => $push_back_reason
	);
	$ret = $this_controller->verify_first(array(
		'where' => $cond,
		'value' => $value,
		'verified' => $verified,
		'push_back_reason' => $push_back_reason
	))or exit('[]');

	exit(jsonencode($ret));
}