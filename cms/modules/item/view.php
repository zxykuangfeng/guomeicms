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
    $auditFlowEr = false;
    if(!empty($core->modules['auditflow']) && $core->modules['auditflow']['enabled'] && !empty(intval($core->CONFIG['audit_flow_enable_'.$this_system->SITE]))){
        $auditFlow = &$this_module->core->load_module('auditflow');
        $auditFlowEr = $auditFlow->checkVerfier($UID,$this_system->name);
    }
	$IS_ADMIN || $auditFlowEr || $data['uid'] == $UID || $this_controller->check_category_action('verify', $data['cid'])|| $this_controller->check_category_action('verify_first', $data['cid']) or message('no_such_item_or_unverify');
}

$data or message('no_such_item_or_unverify');

//检查当前分类权限


if(!empty($data['url'])){
    preg_match('/view-id-(?<id>\d+)/i',$data['url'],$match);
    if($match['id']!=$id){
		$data['url'] = html_entity_decode(attachment_url($data['url']));
        header("location:{$data[url]}");
        exit;
    }
}

$CAT = $this_system->fetch_category($data['cid']);

//允许IP地址,超管不限制
if(!$IS_ADMIN && $CAT['CONFIG']['allow_ip']['enabled'] && !($IS_ADMIN || defined('P8_GENERATE_HTML'))) $this_controller->allow_ip($CAT['CONFIG'],'view');
if(!$IS_ADMIN && $CAT['CONFIG']['need_login'] && !($IS_ADMIN || defined('P8_GENERATE_HTML'))) {
    $UID or message('cms_need_login', $core->U_controller.'/member-login?forward='.$this_url.'-view-id-'.$id,2);
}
if(!empty($this_system->CONFIG['forbidden_dynamic']) && !($IS_ADMIN || defined('P8_GENERATE_HTML'))){
	//禁止查看动态页,生成静态管理员例外,静态化的跳到静态文件
	
	if($CAT['htmlize']){
		$data['#category'] = &$CAT;
		header('Location: '. p8_url($this_module, $data, 'view'));
		exit;
	}else if(empty($CAT['allow_dynamic'])){
		message('access_denied');
	}
}

//检查是否需要密码访问栏目,如果是超级管理员,则忽略
if(!$IS_ADMIN && $CAT['need_password']){
	//如果有密码，则检验密码
	//优先从cookie中获取密码，没有则使用用户输入的密码进行验证
	//$cookie_password = get_cookie('PASSWORD_'.$data['cid']) ? get_cookie('PASSWORD_'.$data['cid']) : '';
	$password = isset($_POST['password']) ? trim($_POST['password']) : '';
	if($CAT['category_password'] && $password != $CAT['category_password']){
		$action = $this_url.'-id-'.$id;
		$errmessage = $password ? '栏目访问密码不正确，请重新输入！' : '';
		include template($this_module, 'password');
		return;
	}
	/*
	if($password && empty($cookie_password)) {
		$_config_ = &$core->CONFIG['cookie'];
		$_cookie_name = isset($_config_['prefix']) ? $_config_['prefix'].'PASSWORD_'.$cid : 'PASSWORD_'.$cid;
		setcookie($_cookie_name,$password);
		set_cookie('PASSWORD_'.$cid,$password);			
	}
	*/
}

$_REQUEST['model'] = $data['model'];
$this_system->init_model();
//模型不存在
$this_model or message('no_such_cms_model');
$this_model['enabled'] or message('cms_model_disabled');

load_language($this_module, 'comment');


unset($credit);
if(!empty($data['credit']) && isset($core->credits[$data['credit_type']])){
	//内容本身收费
	$credit = $core->credits[$data['credit_type']];
	$pay_credit = $data['credit'];

}else if(
	!empty($CAT['CONFIG']['fee']['credit']) &&
	isset($core->credits[$CAT['CONFIG']['fee']['credit_type']]) &&
	empty($CAT['CONFIG']['fee']['ignore_roles'][$core->ROLE])
){
	//内容所属栏目收费
	$credit = $core->credits[$CAT['CONFIG']['fee']['credit_type']];
	$pay_credit = $CAT['CONFIG']['fee']['credit'];
}

$pay_check = true;
//检查支付,作者或管理员不检查
if(isset($credit)){
	if($data['uid'] != $UID && !$IS_ADMIN){
		if(defined('P8_GENERATE_HTML')){
			//生成静态
			$pay_check = false;
		}else{
			//无页面缓存
			$PAGE_CACHE_PARAM['NO_CACHE'] = 1;
			$check = $DB_slave->fetch_one("SELECT timestamp FROM {$this_module->TABLE_}pay WHERE iid = '$id' AND uid = '$UID'");
			if(empty($check['timestamp'])){
				//获取用户积分
				$UID && $credits = $core->get_credit($UID);
				
				$pay_check = false;
			}
		}
	}
}

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

//分页URL
if($pay_check && !defined('P8_GENERATE_HTML')){
	//收费内容,并且通过收费检查,使用动态地址,并且不是生成HTML状态
	$tmp = $data['#category']['htmlize'];
	$data['#category']['htmlize'] = 0;
	$page_url = p8_url($this_module, $data, 'view', false);
	$data['#category']['htmlize'] = $tmp;
}else{
	$page_url = p8_url($this_module, $data, 'view', false);
}
//----------------------------------------------------------
//模型自定义脚本
require $this_model['path'] .'view.php';
//启用相对地址时
if($CAT['CONFIG']['attachment_type']){
	$data['content'] = str_replace('src="/attachment/','src="'.P8_ROOT.'attachment/',$data['content']);
}
$data['config'] = isset($data['config']) && !empty($data['config']) ? mb_unserialize(stripslashes($data['config'])) : array();
if(!$IS_ADMIN && $data['config']['allow_ip']['enabled'] && !($IS_ADMIN || defined('P8_GENERATE_HTML'))) $this_controller->allow_ip($data['config'],'view');
//----------------------------------------------------------
//开启角色浏览权限控制
if(!$IS_FOUNDER && $this_module->CONFIG['authority'] && !defined('P8_GENERATE_HTML')){
	
}
$role= intval(trim($_REQUEST['role']));
$ROLE = $role ? $role : $ROLE;
if(!$IS_FOUNDER && $this_module->CONFIG['authority'] && $UID != $data['uid'] && !defined('P8_GENERATE_HTML') && $ROLE){
	//1、检测内容设置
	if($data['authority'] || $data['config']['authority_viewer']){
		$authority = explode(',',$data['authority']);
		if(!in_array($ROLE,$authority) && !in_array('0',$authority)){
			if($data['config']['authority_viewer'] && in_array($UID,$data['config']['authority_viewer'])){
				
			}else{
				message('no_privilege');
			}			
		}
	}else if($CAT['CONFIG']['authority'] || $CAT['CONFIG']['authority_viewer']){
	//2、检测栏目设置
		$authority = $CAT['CONFIG']['authority'];
		$allow_authority = empty($authority) || in_array($ROLE,$authority) || in_array('0',$authority);
		$allow_authority_viewer = $CAT['CONFIG']['authority_viewer'] && in_array($UID,$CAT['CONFIG']['authority_viewer']);
		if(!$allow_authority && !$allow_authority_viewer) message('no_privilege');
	}
}
//子分类
$CATEGORY = $category->get_children_ids($cid) + array($cid);
//同级分类
$siblings = $category->get_siblings($cid);
$KEYWORD = $data['keywords'];
//会员信息
$member_info = array();
if($this_module->CONFIG['allow_member']){
	$member = $core->load_module('member');
	$member_info = $member->get_member_info($data['uid'],$data['username']);
	!empty($member_info['icon']) && $member_info['icon'] = attachment_url($member_info['icon']);
}
/**
*上一篇与下一篇,
**/
if(
	!empty($this_model['CONFIG']['prev&next_item']) &&
	(!defined('P8_GENERATE_HTML') || ($page == 1 && defined('P8_GENERATE_HTML')))
){
	unset($next_item, $prev_item);
	$orderby = empty($CAT['CONFIG']['orderby']) ? 'timestamp' : $CAT['CONFIG']['orderby'];
	$cmp = $data[$orderby];	

	if(empty($next_item) ){
        $next_item = $DB_slave->fetch_one("SELECT id, cid, title, url, html_view_url_rule, `timestamp` FROM $this_module->table WHERE $orderby < '$cmp' AND cid = '$data[cid]' ORDER BY $orderby DESC LIMIT 1");
        if(empty($next_item) ){
            $next_item = $DB_slave->fetch_one("SELECT id, cid, title, url, html_view_url_rule, `timestamp` FROM $this_module->table WHERE `timestamp` < '{$data['timestamp']}' AND cid = '$data[cid]' ORDER BY timestamp DESC LIMIT 1");
        }

		$next_item['html_view_url_rule'] = str_replace('"', '', $next_item['html_view_url_rule']);
		$next_item['subject'] = p8_cutstr($next_item['title'], 100);
		$next_item['#category'] = &$CAT;
		$next_item['url'] = empty($next_item['url'])?p8_url($this_module, $next_item, 'view'):$next_item['url'];
	}
	
	if(empty($prev_item) ){
        $prev_item =  $DB_slave->fetch_one("SELECT id, cid, title, url, html_view_url_rule, `timestamp` FROM $this_module->table WHERE $orderby > '$cmp' AND cid = '$data[cid]' ORDER BY $orderby ASC LIMIT 1");
        if(empty($prev_item) ) {
            $prev_item = $DB_slave->fetch_one("SELECT id, cid, title, url, html_view_url_rule, `timestamp` FROM $this_module->table WHERE `timestamp` > '{$data['timestamp']}' AND cid = '$data[cid]' ORDER BY timestamp ASC LIMIT 1");
        }
		$prev_item['html_view_url_rule'] = str_replace('"', '', $prev_item['html_view_url_rule']);
		$prev_item['subject'] = p8_cutstr($prev_item['title'], 100);
		$prev_item['#category'] = &$CAT;
		$prev_item['url'] = empty($prev_item['url'])?p8_url($this_module, $prev_item, 'view'):$prev_item['url'];
	}
	$temp = array();
	if(!empty($CAT['CONFIG']['orderby_desc'])){
		$temp = $next_item;
		$next_item = $prev_item;
		$prev_item = $temp;
	}
}


//如果有追加内容
$pages = $data['pages'] > 1 ? 
	list_page(array(
		'count' => $data['pages'],
		'page' => $page,
		'page_size' => 1,
		'url' => $page_url,
		'template'=> !empty($CAT['CONFIG']['view_pages_template']) && isset($P8LANG[$CAT['CONFIG']['view_pages_template']]) ? $P8LANG[$CAT['CONFIG']['view_pages_template']] : $P8LANG['base_page_template'],
	)) :
	'';


//初始化标签
$LABEL_POSTFIX = array();
$ENV = $core->ismobile?'mobile':'';
//如果分类有自己的标签后缀
if($CAT['type'] == 2 && !empty($CAT['label_postfix'])) array_push($LABEL_POSTFIX, $CAT['label_postfix']);

//如果内容有自己的标签后缀
if(!empty($data['label_postfix'])) array_push($LABEL_POSTFIX, $data['label_postfix']);


$LINKRSS = array(
	'title' => $core->CONFIG['site_name'] .' - '. $CAT['name'],
	'url' => $this_system->controller .'/'. $MODULE .'-rss-category-'. $CAT['id']
);

$TITLE = $SEO_KEYWORDS = $SEO_DESCRIPTION = '';

$title_style = empty($CAT['CONFIG']['title_style']) ? 0 : $CAT['CONFIG']['title_style'];
switch($title_style){
	case 1: $TITLE = $data['title'] .'_'. $core->CONFIG['site_name']; break;
	case 2: $TITLE = $data['title'] .'_'. $CAT['name']; break;
	default: case 3: $TITLE = $data['title'] .'_'. $CAT['name'] .'_'. $core->CONFIG['site_name']; break;
}

$data['seo_keywords'] = $data['keywords'];
$data['seo_description'] = $data['summary'];
//图片延时加载
$core_config = $core->get_config('core','');
if($core_config['lazyload']){
	$data['content'] = preg_replace("/src=([\"|']?)([^ \"'>]+\.(jpg|jpeg|gif|png|bmp))\\1/i", "src=\"".$RESOURCE."/images/nopic.jpg\" class=\"lazy\" original=\"\\2\"", $data['content']);
}
//若已开启移动设备样式，且是移动设备，则用移动模板
if($core->ismobile)$CAT['view_template'] = $CAT['view_template_mobile'];
/*字段权限控制*/
foreach($this_model['fields'] as $field => $field_data){
	if(isset($field_data['CONFIG']['visible_role']) && $field_data['CONFIG']['visible_role'] && !in_array($ROLE,$field_data['CONFIG']['visible_role'])){
		unset($data[$field]);
	}
}
//获得评分信息
$credit_data = $this_module->view_credit_log($id);
//内容页模板
include template($this_module, empty($data['template']) ? $CAT['view_template'] : $data['template']);

//保存页面缓存
page_cache();
