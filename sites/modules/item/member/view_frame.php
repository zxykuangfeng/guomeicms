<?php
defined('PHP168_PATH') or die();

/**
* 查看内容
**/

$id = 0;
$page = 1;
$first_page = $last_page = $next_page = $prev_page = '';
$link_pages = array();

foreach($URL_PARAMS as $k => $v){
	switch($v){
	
	case 'id':
		//ID
		$id = isset($URL_PARAMS[$k +1]) ? intval($URL_PARAMS[$k +1]) : 0;
	break;
	
	case 'page':
		//页码
		$page = isset($URL_PARAMS[$k +1]) ? intval($URL_PARAMS[$k +1]) : 1;
		$page = max(1, $page);
	break;
	
	}
}
$id or message('no_such_item_or_unverify');


if(isset($_GET['verified'])){
	//只有管理员才可以查看未审核的内容
	$verified = $_GET['verified'] != 1 ? false : true;
}else{
	$verified = true;
}

if($verified){
	if(defined('P8_GENERATE_HTML') && !empty($HTML_DATA)){
		$data = &$HTML_DATA;
	}else{
		$data = $this_module->data('read', $id);
	}
}else{
	//查看未验证内容不保存页面缓存
	$PAGE_CACHE_PARAM['NO_CACHE'] = 1;
	
	$data = $DB_slave->fetch_one("SELECT * FROM $this_module->unverified_table WHERE id = '$id'");
}

if(!$verified){
	$IS_ADMIN || $data['uid'] == $UID or message('no_such_item_or_unverify');
}

$data or message('no_such_item_or_unverify');
//检查当前分类权限
if(!$this_controller->check_category_action($ACTION, $data['cid'])){
	message('no_privilege');
	
	return;
}

if($this_system->check_manager()){
	set_cookie('IS_ADMIN', 1);
}else{
	set_cookie('IS_ADMIN', 0, -1);
}

if(!empty($data['url'])){
    preg_match('/view-id-(?<id>\d+)/i',$data['url'],$match);
    if($match['id']!=$id){
        header("location:{$data[url]}");
        exit;
    }
}

$CAT = $this_system->fetch_category($data['cid']);

//允许IP地址,超管不限制
if(!$IS_ADMIN && $CAT['CONFIG']['allow_ip']['enabled']) $this_controller->allow_ip($CAT['CONFIG']);
if(!$IS_ADMIN && $CAT['CONFIG']['need_login']) {
    $UID or message('site_need_login', $core->U_controller.'/member-login?forward='.$this_url.'-view-id-'.$id,2);
}

$_REQUEST['model'] = $data['model'];
$this_system->init_model();
//模型不存在
$this_model or message('no_such_cms_model');
$this_model['enabled'] or message('cms_model_disabled');

$real_page = $page;
$page > $data['pages'] && $page = (int)$data['pages'];

$PAGE_CACHE_PARAM['id'] = $id;
$PAGE_CACHE_PARAM['page'] = $page;
$PAGE_CACHE_PARAM['pay_check'] = $pay_check;

$select_param = array();

//读取数据
if($verified){
	//己审核
	
	$_page = $page -1;
	$SQL = "SELECT i.*, a.*, i.timestamp AS timestamp, a.iid AS id FROM $this_module->table AS i
		INNER JOIN $this_module->addon_table AS a ON i.id = a.iid
		WHERE i.id = '$id' ORDER BY a.page ASC LIMIT $_page, 1";
	
}else{
	//未审核的数据
	
}

$cid = $data['cid'];
$data['#category'] = &$CAT;

//----------------------------------------------------------
//模型自定义脚本
$file = $this_model['path'] .'view.php';
if(!is_file($file)){
	$file = str_replace('/'.$MODEL.'/','/article/',$file);
}
require $file;
//----------------------------------------------------------
//IP内容控制
$data['config'] = isset($data['config']) && !empty($data['config']) ? mb_unserialize(stripslashes($data['config'])) : array();
if(!$IS_ADMIN && $data['config']['allow_ip']['enabled']) $this_controller->allow_ip($data['config']);

$TITLE = $SEO_KEYWORDS = $SEO_DESCRIPTION = '查看审核图片';
$verify_frame = $data['verify_frame'];
$verify_frame or message('no_such_item_or_unverify');
echo "<html><head><title>$TITLE</title></head><body><img src=\"$verify_frame\" /></body></html>";
//保存页面缓存
page_cache();
