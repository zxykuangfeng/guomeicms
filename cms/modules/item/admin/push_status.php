<?php
defined('PHP168_PATH') or die();
$this_controller->check_admin_action($ACTION) or message('no_privilege');

$install_sites = isset($core->systems['sites']) && $core->systems['sites']['installed'] && $core->systems['sites']['enabled'];

$install_sites or message('error');

$sites_system = &$core->load_system('sites');

$category = $sites_system->load_module('category');
$category_json = $category->get_json();
$item_module = $sites_system->load_module('item');
load_language($core, 'config');
load_language($item_module, 'global');
$to_site_alias = isset($_GET['to_site_alias']) ? trim($_GET['to_site_alias']) : '';

$sc = isset($_GET['sc']) ? trim($_GET['sc']) : 's';
$site = isset($_GET['site']) ? trim($_GET['site']) : '';
$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
$model = isset($_GET['model']) ? trim($_GET['model']) : '';
$keyword = isset($_GET['word']) ? trim($_GET['word']) : '';
$username = isset($_GET['username']) ? trim($_GET['username']) : '';
$verifier = isset($_GET['verifier']) ? trim($_GET['verifier']) : '';
$class[88]='class="over"';
$select = select();
$select->from($core->TABLE_.'sites_stop_data as c', 'c.*');
if($to_site_alias) $select->in('c.site_status',$to_site_alias);

$site_info = array();
$site_domain = '';
if($site){
	$site_info = $sites_system->get_site($site);
	$site_domain = $site_info['ipordomain'] ? $site_info['domain'].'/' : $core->CONFIG['url'].'/s.php/'.$site.'/';
	$select->in('c.site',$site);
}
/*
* 上面往下推的，$sc=s;
* 查看接收情况时,$sc=c
*/
if($sc=='s'){
	$select->in('c.`to`','sites');
	$select->in('c.`from`','cms');
}else{
	$select->in('c.`to`','cms');
	$select->in('c.`from`','sites');
}
if($cid){
	//$ids = array($cid) + $category->get_children_ids($cid);
	$select->in('c.cid', $cid);
}
if($keyword){
	$select->like('c.title', $keyword);
}
if($username){
	$select->in('c.push_username', $username);
}
$select->order(" c.timestamp DESC");
$count = 0;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max(1, $page);
$page_size = 20;
//echo $select->build_sql();
$list = $core->list_item(
	$select,
	array(
		'page' => &$page,
		'count' => &$count,
		'page_size' => $page_size,
		'ms' => 'master'
	)
);
$allsites = $_allsites = $sites_system->get_sites();
$item_ids = array();
$usernames = array();
foreach($list as $key=>$item){
	$item_ids[$item['item_id']] = $item['item_id'];
	$usernames[] = $item['push_username'];
	$new_id = $item['new_id'];
	$list[$key]['link'] = $item['link'];
	if($sc = 's') $list[$key]['link'] = $this_system->controller.'/item-view-id-'.$item['item_id'];
	$list[$key]['url'] = $item['link'] ? $item['link'] : $site_domain.'item-view-id-'.$item['item_id'];	
	$list[$key]['to_url'] = '';
	$list[$key]['to_sites'] = '';
	$list[$key]['push_username16'] = $item['push_username'] ? base64_encode($item['push_username']) : '';
	$list[$key]['sitesname'] = !empty($allsites[$site]['sitename']) ? $allsites[$site]['sitename']  : '';
	$list[$key]['push_back_reason'] = '';
	$list[$key]['to_site_alias'] = '';
	$list[$key]['username'] = '';
	$item_data = mb_unserialize($item['data']);	
	if($item_data && $item_data['username']){
		$usernames[] = $item_data['username'];
		$list[$key]['username'] = $item_data['username'];
		$list[$key]['username16'] = $item_data['username'] ? base64_encode($item_data['username']) : '';
	}
	if($item['status'] != 1){		
		$sql = 'SELECT * FROM '. $core->TABLE_ .'sites_item_unverified' .' WHERE id = \''. $new_id .'\'';
		$ret = $core->DB_slave->fetch_one($sql);
		if($ret && $ret['push_back_reason']) $list[$key]['push_back_reason'] = $ret['push_back_reason'];
	}
	if($item['new_id']){
		$site_status = explode(',',$sc=='s' ? $item['site_status']:$item['site']);
		$alias = end($site_status);
		$list[$key]['to_site_alias'] = $alias;
		if($alias){
			$site_domain_new = $allsites[$alias]['ipordomain'] ? $allsites[$alias]['domain'].'/index.php/' : $core->CONFIG['url'].'/s.php/'.$alias.'/';
			$list[$key]['to_url'] = $site_domain_new.'item-view-id-'.($sc == 's' ? $item['new_id'] : $item['item_id']).'.html';
		}
		$site_num = count($site_status);
		$list[$key]['to_sites'] = !empty($allsites[$alias]['sitename']) ? $allsites[$alias]['sitename']  : '';
	}else{
		$site_status = explode(',',$sc=='s' ? $item['site_status']:$item['site']);
		$alias = end($site_status);		
		if($alias){
			$list[$key]['to_sites'] = !empty($allsites[$alias]['sitename']) ? $allsites[$alias]['sitename'] : '';
		}
	}
}
//member_info
$member_table = $core->TABLE_.'member';
$member_info = array();
if($usernames){
	$div = '';
	foreach(array_unique($usernames) as $username_tmp){
		if($username_tmp) $usernames_string .= $div."'".$username_tmp."'";
		$div = ',';
	}
	$item_table = $sc == 's' ? $this_system->item_table : $sites_system->item_table;
	$sql = "SELECT id,username,name FROM `$member_table` WHERE username in ($usernames_string)";	
	$query = $core->DB_master->query($sql);
	while($arr = $core->DB_master->fetch_array($query)){
		if($arr['id']){
			$md5_username = base64_encode($arr['username']);
			$member_info[$md5_username] = array(
				'username' => $arr['username'],
				'name' => $arr['name'],
			);
		}
	}
}
//$page_url .= '&sc=s&page=?page?';
$page_url = 'javascript:request_item(?page?)';
$pages = list_page(array(
	'count' => $count,
	'page' => $page,
	'page_size' => $page_size,
	'url' => $page_url
));
$item_router = substr($this_router,0,-4).'item';
$item_controller = $core->controller($item_module);
$allow_sites_push =  $item_controller->check_action('sites_push');
$allow_cluster_push =  $item_controller->check_action('cluster_push');
$allow_sites_push_sites = $item_controller->check_action('sites_push_sites');
$allow_verify = $this_controller->check_admin_action('verify');
$allow_verify_first = $this_controller->check_admin_action('verify_first');
$_allsites = array_keys($_allsites);
$selected_site = current($_allsites);
include template($this_module, 'push_status', 'admin');