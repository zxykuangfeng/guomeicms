<?php
defined('PHP168_PATH') or die();

/**
* 列表页
**/
if(!defined('P8_GENERATE_HTML')) $this_controller->check_action($ACTION) or message('no_privilege');
//如果魔法引号开启strip掉
$_GET = p8_stripslashes2($_GET);
$mid = 0;
$page = 1;
$viewself = false;
$mid = isset($_REQUEST['mid'])? intval($_REQUEST['mid']): 0;

$page = isset($_GET['page'])? intval($_GET['page']): 1;
foreach($URL_PARAMS as $k => $v){ 
	switch($v){
		case 'mid':
			$mid = isset($URL_PARAMS[$k +1]) ? intval($URL_PARAMS[$k +1]) : 0;
			$PAGE_CACHE_PARAM['mid'] = $mid;
		break;
		case 'page':
		$page = isset($URL_PARAMS[$k +1]) ? intval($URL_PARAMS[$k +1]) : 1;
		$page = max($page, 1);
		break;
	}
}

if(!$mid){
	$select = select();
	$select -> from($this_module->model_table,'*');
	$select -> order('display_order DESC, id DESC');
	$list = $core->select($select);
	include template($this_module, 'select_model');
	exit;
}
if(!defined('P8_GENERATE_HTML')) $this_controller->check_action($ACTION) or message('no_privilege',$core->U_controller.'?forward='.$this_url.'-mid-'.$mid,3);
$mid != '199' or message('no_such_model');
$this_module->set_model($mid) or message('no_such_model');
if(!$this_model['enabled']){
	message($this_model['CONFIG']['disable_message'] ? $this_model['CONFIG']['disable_message'] : 'this_model_unable');	
}
if(P8_AJAX_REQUEST && $this_model['CONFIG']['search_captcha'] && !captcha($_GET['captcha']) && !defined('P8_GENERATE_HTML')){
	echo p8_json(array(
		'list' => array(),
		'pages' => array(),
		'type' => 'captcha',
		'message' => 'captcha_incorrect',
		)
	);
	exit;	
}
if(P8_AJAX_REQUEST && $this_model['CONFIG']['mobile_search_captcha'] && !defined('P8_GENERATE_HTML')){
	$status = $core->load_module('sms')->check_sms($_GET['checkcode'],$_GET['phone']);
	if(!$status){
		echo p8_json(array(
			'list' => array(),
			'pages' => array(),
			'type' => 'sms',
			'message' => 'captcha_sms_incorrect',
			)
		);
		exit;	
	}
}
//检查是否需要密码访问,如果是超级管理员,则忽略	
if(!P8_AJAX_REQUEST && !$IS_ADMIN && !defined('P8_GENERATE_HTML') && !empty($this_model['CONFIG']['need_password']) && $this_model['CONFIG']['model_password']){
	$password = isset($_GET['password']) ? trim($_GET['password']) : '';
	if($password != $this_model['CONFIG']['model_password']){
		$errmessage = $password ? '访问密码不正确，请重新输入！' : '';
		include template($this_module, 'password');
		return;
	}
}
if(!$this_controller->check_model_action($ACTION,$mid) && empty($this_model['CONFIG']['viewself']) && !defined('P8_GENERATE_HTML')){
	message('no_privilege',$core->U_controller.'?forward='.$this_url.'-mid-'.$mid,3);
}elseif(!$this_controller->check_model_action($ACTION,$mid) && !empty($this_model['CONFIG']['viewself'])){
	$viewself = true;
}
// 允许IP地址,超管不限制
if(!$IS_ADMIN && $this_model['CONFIG']['allow_ip']['enabled'] && !defined('P8_GENERATE_HTML')){
	$this_controller->allow_ip($this_model['CONFIG']);
}
$download = $this_controller->check_model_action('download',$mid) || $viewself;
$import_list = $this_controller->check_model_action('import_list',$mid);
$manage = $this_controller->check_model_action('manage',$mid);	
$p8_status = $this_model['CONFIG']['status'];
$template = empty($this_model['list_template'])? 'list' : 'tpl/'.$this_model['list_template'];
if($core->ismobile){
	$template = empty($this_model['list_template_mobile'])? 'list' : 'tpl/'.$this_model['list_template_mobile'];
}
//搜索开始
$page_url = '';
$count = 0;
$accurate = isset($_GET['accurate']) && $_GET['accurate'] ? 1 : 0;
//自定义字段过滤
$F = isset($_GET['field#']) ? $_GET['field#'] : array();
$F || $F=$_GET;
$is_empty_keyword = true;
$accurate = $F ? 1 : $accurate;
if($accurate){
	foreach($this_model['filterable_fields'] as $field=>$field_data){		
		if(!empty($F[$field])){
			$is_empty_keyword = false;
			break;
		}
	}
	if($is_empty_keyword) {
		if(P8_AJAX_REQUEST && !defined('P8_GENERATE_HTML')){	
			exit('{"list":[],"pages":""}');
		}else{
			include template($this_module, $template);
			exit;
		}
	}
}
$select = select();
$select -> from("$this_module->table as i",'i.*');
$select -> left_join("$this_module->data_table as d",'d.*','i.id=d.id');
$select -> in('i.mid',$mid);
//fetch show data
if(empty($this_model['CONFIG']['isdisplay'])){
	$select -> in('i.display',0);
}else{
	$select -> in('i.verified',1);
	$select -> in('i.display',0);
}
if($this_model['verified'] != '')$select -> in('i.status',explode(",",$this_model['verified']));
if($this_model['recommend'] == '1')$select -> in('i.recommend',1);
if($viewself)$select -> in('i.uid',$UID);
$search_status = isset($_GET['search_status']) ? $_GET['search_status'] : '';
if($search_status) {
	$page_url .= "&search_status=$search_status";
	$select -> in('i.p8_status',$search_status);
}
//搜索条件
$mindate = isset($_GET['mindate']) ? $_GET['mindate'] : '';
if($mindate){
	$page_url .= "&mindate=$mindate";
	$select -> range('i.timestamp',strtotime($mindate));
}
$maxdate = isset($_GET['maxdate']) ? $_GET['maxdate'] : '';
if($maxdate){
	$page_url .= "&maxdate=$maxdate";
	$select -> range('i.timestamp',null,strtotime($maxdate));
}
$username = isset($_GET['username']) ? p8_addslashes(html_entities2($_GET['username'])) : '';
if($username){
	$page_url .= "&username=$username";
	$select -> in('i.username',$username);
}
$selectstatus = isset($_GET['selectstatus']) ? p8_addslashes(html_entities2($_GET['selectstatus'])) : '';

if($selectstatus!=''){
	$selectstatus = intval($selectstatus);
	$page_url .= "&selectstatus=$selectstatus";
	$select -> in('i.status',$selectstatus);
}
if(!empty($mindate) || !empty($maxdate) || !empty($username) || !empty($selectstatus)){
	if(!defined('P8_GENERATE_HTML')) $this_controller->check_action('search') or message('no_privilege',$core->U_controller.'?forward='.$this_url.'-mid-'.$mid,3);
}

if(isset($F['mid'])) unset($F['mid']);
foreach($this_model['filterable_fields'] as $field=>$field_data){
	if(!empty($F[$field])){
		if(!defined('P8_GENERATE_HTML')) $this_controller->check_action('search') or message('no_privilege',$core->U_controller.'?forward='.$this_url.'-mid-'.$mid,3);
		if(in_array($field_data['widget'],array('text','vscode','captcha'))){
			$data[$field] = html_entities2($F[$field]);
			$page_url .= "&$field=$F[$field]";
			if($field_data['CONFIG']['filter_type'])
				$select -> in("d.$field",p8_addslashes($F[$field]));
			else
				$select -> like("d.$field",p8_addslashes($F[$field]));
		}elseif($field_data['widget']=='radio' || $field_data['widget']=='select' || $field_data['widget']=='city'){
			$data[$field] =  html_entities2($F[$field]);
			$page_url .= "&$field=$F[$field]";
			$select -> in("d.$field",p8_addslashes($F[$field]));
		}elseif($field_data['widget']=='checkbox' || $field_data['widget']=='multi_select'){
			if(!empty($F[$field])){
			if(!is_array($F[$field]))
				$F[$field] = explode('-',$F[$field]);
				$page_url .= "&{$field}=";
				$split = '';
				foreach($F[$field] as $v){
					if(array_key_exists($v,$field_data['data'])){
						$data[$field][] = $v;
						$page_url .= $split.$v;
						$select -> like("d.$field",p8_addslashes($v));
						$split = '-';
					}	
				}
			}
		}elseif($field_data['widget']=='linkage'){
			foreach($F[$field] as $k=>$vl){
					if($vl)
					$data[$field] = $vl;
			}
			if($data[$field]){
				$page_url .= "&$field=$F[$field]";
				$select -> like("d.$field",p8_addslashes($data[$field]),'left');
			}
		}
	}
}
if($this_model['CONFIG']['display_order'] && $this_model['CONFIG']['display_order'] == 'ASC'){
	$select -> order('i.display_order ASC, i.id ASC');
}else{
	$select -> order('i.display_order DESC, i.id DESC');
}
//echo $select->build_sql();	
$list = $core->list_item(
	$select,
	array(
		'page' => &$page,
		'count' => &$count,
		'page_size' => 20
	)
);
$__temp_htmlize_ = $this_module->CONFIG['htmlize'] ? 1 : 0;
$this_module->CONFIG['htmlize'] = $this_module->CONFIG['htmlize'] && $this_module->CONFIG['htmlize_list'] ? 1 : 0;
$this_model['model_name'] = $this_model['name'];
$_page_url = p8_url($this_module, $this_model, 'list', false);
$_page_url .= (strpos($_page_url,'&')===false? '?': '&').substr($page_url,1);
$pages = list_page(array(
	'count' => $count,
	'page' => $page,
	'page_size' => 20,
	'url' => $_page_url
));
$this_module->CONFIG['htmlize'] = $__temp_htmlize_;
$this_module->CONFIG['htmlize'] = $this_module->CONFIG['htmlize'] && $this_module->CONFIG['htmlize_view'] ? 1 : 0;
$search_result_title = $this_model['CONFIG']['search_result_title'] ? $this_model['CONFIG']['search_result_title'] : '';
foreach($list as $key=>$detail){
	$this_module->format_data($list[$key],0);
	$this_module->format_view($list[$key]);
	$list[$key]['search_result_title'] = $search_result_title && $list[$key][$search_result_title] ? $list[$key][$search_result_title] : '';
	$detail['model_name'] = $this_model['name'];
	$list[$key]['url'] = p8_url($this_module,$detail,'view');
	$list[$key]['url'] = str_replace('/html//','/html/'.$this_model['name'].'/',$list[$key]['url']);
	$list[$key]['url'] = str_replace('modules/forms/html/', 'html/', $list[$key]['url']);
	if(!empty($this_model['CONFIG']['viewhash']))$list[$key]['url'] .= (strpos($list[$key]['url'],'?')===false?'?':'&').'viewcode='.p8_code($detail['id'].'_'.P8_TIME);
	$list[$key]['p8_status'] = isset($list[$key]['p8_status']) && $list[$key]['p8_status'] ? $list[$key]['p8_status'] : '等待处理';
}
//针对显示select
foreach($this_model['fields'] as $p8_field => $p8_v){
	if(in_array($p8_v['widget'],array('select','checkbox','multi_select','radio'))){
		foreach($p8_v['data'] as $p8_value => $p8_key){
			if(is_array($p8_key)) $this_model['fields'][$p8_field]['data'][$p8_value] = $p8_key[0];
		}
	}
}
$this_module->CONFIG['htmlize'] = $__temp_htmlize_;
$status = $this_module->CONFIG['status'];
$status_json = p8_json($status);
$_SERVER['REQUEST_URI'] = xss_url($_SERVER['REQUEST_URI']);

//模型自定义脚本
include $this_model['path'] .'list.php';

$SEO_KEYWORDS = $SEO_DESCRIPTION = '';
$TITLE = $this_model['alias'].' - '.$core->CONFIG['site_name'];

$props = '[';
$dot = '';
foreach($this_model['list_table_fields'] as $name=>$value){
	$props .= $dot."'".$name."'";
	$dot = ',';
}
$props .= ']';

// 初始化标签
$LABEL_POSTFIX = array();
// 如果分类有自己的标签后缀
if (! empty($this_model['CONFIG']['label_postfix']))
    array_push($LABEL_POSTFIX, $this_model['CONFIG']['label_postfix']);


if(P8_AJAX_REQUEST && !defined('P8_GENERATE_HTML')){	
	foreach($list as $key=>$value){	
		foreach($this_model['list_table_fields'] as $field => $field_data){			
			$list[$key]['value'] = '';
			if(isset($value[$field])){
				$list[$key][$field] = $value[$field];
			}
			if(isset($value[$field]) && ($field_data['widget']=='radio' || $field_data['widget']=='select' || $field_data['widget']=='city')){
				$list[$key][$field] = $field_data['data'][$value[$field]];
			}
			if(isset($value[$field]) && ($field_data['widget']=='checkbox' || $field_data['widget']=='multi_select')){
				$list[$key][$field] = '';
				foreach($value[$field] as $v){
					$list[$key][$field] .= $field_data['data'][$v][0].',';					
				}				
			}			
		}		
	}
	$page_url = $this_url .'?';
	$page_url = 'javascript:search_item(?page?)';
	echo p8_json(array(
		'list' => $list,
		'pages' => list_page(array(
			'count' => $count,
			'page' => $page,
			'page_size' => 20,
			'url' => $page_url
		)),		
	));
	exit;
}else{
	include template($this_module, $template);
}