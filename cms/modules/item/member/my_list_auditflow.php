<?php
defined('PHP168_PATH') or die();

if(!empty($_REQUEST['model'])){
	$this_system->init_model();
	
	$this_model or message('no_such_cms_model');
}else{
	$MODEL = '';
}

//$this_controller->check_action($ACTION) or message('no_privilege');

//加载分类模块
$category = &$this_system->load_module('category');
$category->get_cache();

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
$username = isset($_GET['username']) ? trim($_GET['username']) : '';
$verifier = isset($_GET['verifier']) ? trim($_GET['verifier']) : '';
$desc = empty($_GET['order']) ? ' DESC' : ' ASC';
$id = isset($_GET['id']) ? filter_int(explode(',', $_GET['id'])) : '';
$word = urlencode($keyword);

$page_url = $this_url .'?';
$page_url = 'javascript:request_item(?page?)';

$select = select();
$select->in('i.uid', $UID);

if($verified == 1){
	if($MODEL){
		$select->from($this_module->table .' AS i', 'i.*');
	}else{
		$select->from($this_module->main_table .' AS i', 'i.*');
	}
}else{
	$select->from($T .' AS i', 'i.*');
    if($verified) {
        $select->in('i.verified', $verified);
    }
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
$usernames = array();
foreach($list as $k => $v){
		$list[$k]['url'] = $core->controller.'/cms/item-view-id-'.$v['id'];
		$list[$k]['url'] .= $verified == 1? '' : '?verified=0';
		$list[$k]['title'] = p8_cutstr($list[$k]['title'],90);
        $list[$k]['verifier_name'] = !empty($v['verifier']) ? generate_unique_key($v['verifier']) : '';
		if($v['verifier']) $usernames[] = $v['verifier'];
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
//分页
$pages = list_page(array(
	'count' => $count,
	'page' => $page,
	'page_size' => 20,
	'url' => $page_url
));
$item_config = $core->get_config('cms','item');
$allow_verify_frame = $item_config['menu_verify_frame'] ? false : true;
include template($this_module, 'my_list_auditflow');