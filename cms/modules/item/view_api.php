<?php
defined('PHP168_PATH') or die();

/**
* 查看内容
**/

$data = array();
if(empty($id)){
	$data['error'] = $P8LANG['no_such_item_or_unverify'];
	exit(jsonencode($data));
}

if(defined('P8_GENERATE_HTML') && !empty($HTML_DATA)){
	$data = &$HTML_DATA;
}else{
	$data = $this_module->data('read', $id);
}
if(empty($data)){
	$data['error'] = $P8LANG['no_such_item_or_unverify'];
	exit(jsonencode($data));
}
$CAT = $this_system->fetch_category($data['cid']);
$verified = true;
$_REQUEST['model'] = $data['model'];
$this_system->init_model();
//模型不存在
if(empty($this_model)){
	$data['error'] = $P8LANG['no_such_cms_model'];
	exit(jsonencode($data));
}
if(empty($this_model['enabled'])){
	$data['error'] = $P8LANG['cms_model_disabled'];
	exit(jsonencode($data));
}

$real_page = $page;
$page > $data['pages'] && $page = (int)$data['pages'];
$select_param = array();

//读取数据
//己审核
$_page = $page -1;
$SQL = "SELECT i.*, a.*, i.timestamp AS timestamp, a.iid AS id FROM $this_module->table AS i
	INNER JOIN $this_module->addon_table AS a ON i.id = a.iid
	WHERE i.id = '$id' ORDER BY a.page ASC LIMIT $_page, 1";

$cid = $data['cid'];
$data['#category'] = &$CAT;
//模型自定义脚本
require $this_model['path'] .'view.php';
$data['seo_keywords'] = $data['keywords'];
$data['seo_description'] = $data['summary'];
//$data = p8_stripslashes2($data);
exit(jsonencode($data));