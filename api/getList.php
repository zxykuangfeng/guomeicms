<?php
header('Content-type: application/json;charset=utf-8');
require_once dirname(__FILE__) .'/../inc/init.php';
$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
$cid or exit([]);
$months = isset($_GET['months']) ? intval($_GET['months']) : 12;
$months = $months == 12 ? 11 : 23;//只有11和23
$system = 'cms';
$module = 'item';
$this_system = $core->load_system($system);
$this_module = &$this_system->load_module($module);
$this_controller = $core->controller($this_module);

$CAT = &$this_system->fetch_category($cid);
$CAT or exit([]);
$category = &$this_system->load_module('category');
$list = array();

$select = select();
$select->from($this_module->main_table . ' AS i', 'i.*');
//尝试读缓存
$category->get_cache();	
if(empty($category->categories)){
	$category->get_cache(false);
}
$subcategories = array();
if (isset($category->categories[$cid]['categories'])) {
	$subcategories = $category->categories[$cid]['categories'];
	$CATEGORY = $category->get_children_ids($cid) + array(
		$cid
	);
} else {
	$CATEGORY = $cid;
}
$select->in('i.cid', $CATEGORY);

//取过去12个月1月1日凌晨时间戳
$lastMonthTimestamp = mktime(0, 0, 0, date('n') - $months, 1);
for($i=0;$i<=$months;$i++){
	$Timestamp = mktime(0, 0, 0, date('n') - $i, 1);
	$list[date('Ym',$Timestamp)] = array();	
}
$select->where("i.timestamp >= $lastMonthTimestamp");
$orderby = empty($CAT['CONFIG']['orderby']) ? 'i.timestamp' : 'i.'.$CAT['CONFIG']['orderby'];	 
$desc = empty($CAT['CONFIG']['orderby_desc']) ? ' DESC' : ' ASC';
$orderby = $orderby == 'i.level' ? 'i.level'.$desc.',i.timestamp'.$desc : $orderby.$desc;

$title_length = empty($CAT['CONFIG']['list_title_length']) ? 100 : $CAT['CONFIG']['list_title_length'];
$dot = empty($CAT['CONFIG']['title_dot']) ? '' : '...';
$select->order($orderby);
//echo $select->build_sql();
$sphinx = $this_module->CONFIG['sphinx'];
$sphinx['index'] = $this_system->sphinx_indexes(array(
	$MODEL => 1
));
$lists = $core->list_item($select, array());
foreach($lists as $k => $v){	
	$v['#category'] = &$category->categories[$v['cid']];
	$v['url'] = attachment_url($v['url'],false,true);
	$v_config = isset($v['config']) ? mb_unserialize(stripslashes($v['config'])) : array();
	if(empty($v['url']) && $v_config['allow_ip']['enabled'] >= 1 && $core_config['static_enable'] && $core_config['static_url']){
		$v['url'] = $main_domain.'/index.php/cms/item-view-id-'.$v['id'].'.html';
	}else{
		$v['url'] = p8_url($this_module, $v, 'view');
	}
	$v['url'] = $v['#category']['allow_ip_enabled'] >= 1 || $v_config['allow_ip']['enabled'] >=1 ? $main_domain.'/index.php/cms/item-view-id-'.$v['id'].'.html' : $v['url'];
	//权限控制下使用动态
	if(!empty($v_config['authority_viewer']) || (!empty($v['authority'])  && !in_array('0',explode(',',$v['authority'])))
		|| !empty($category->categories[$v['cid']]['authority_viewer']) ||
		(!empty($category->categories[$v['cid']]['authority']) && !in_array('0',$category->categories[$v['cid']]['authority']))
	){
		$v['url'] = $main_domain.'/index.php/cms/item-view-id-'.$v['id'].'.html';	
	}		
	$v['frame'] = attachment_url($v['frame'],false,true);
	//启用相对地址时
	if($v['#category']['attachment_type'] && $v['frame']){
		$v['frame'] = str_replace($core->url,'',$v['frame']);
		if($core->CONFIG['static_attachment_url']){
			$v['frame'] = str_replace($core->CONFIG['static_attachment_url'],'',$v['frame']);
		}
		$v['frame'] = P8_ROOT. str_replace($RESOURCE,'',$v['frame']);
		$v['frame'] = str_replace('//attachment','/attachment',$v['frame']);
	}
	$v['full_title'] = $v['title'];
	$v['title'] = p8_cutstr($v['title'], $title_length, $dot);
	$v['summary'] = p8_stripslashes($v['summary']);
	$v['summary'] = html_entity_decode($v['summary']);
	$v['summary'] = preg_replace('/(amp;)+/','', $v['summary']);
	if (! empty($v['title_color']))
		$v['title'] = '<font color="' . $v['title_color'] . '">' . $v['title'] . '</font>';
	if (! empty($v['title_bold']))
		$v['title'] = '<b>' . $v['title'] . '</b>';

	$list[date('Ym', $v['timestamp'])][] = array(
		'cat'	=> "p8_".$v['cid'],
		'news' 	=> array(
			0 => array(
				'cat' => "p8_".$v['cid'],
				'day' => date('n月d日', $v['timestamp']),
				'day_bak' => date('n月d日', $v['timestamp']),
				'detail' => $v['summary'],
				'id' => $v['id'],
				'issue_time' => $v['timestamp'],
				'keywords' => date('Ymd', $v['timestamp']),
				'link' => $v['url'],
				'media' => $v['frame'],
				'title' => $v['title']
			)
		)		
	);
}
$data = array(
	'code' 	=> 0,
	'msg' 	=> "ok",
	'data'	=> array(
		'list' => $list,
	)
);
exit(jsonencode($data));