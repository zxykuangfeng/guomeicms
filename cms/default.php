<?php
defined('PHP168_PATH') or die();

if(!$UID){
	header("location:".$core->U_controller."?forward=".$this_url);
    exit;
}
/**
* CMS首页
**/

if(
	!empty($this_system->CONFIG['forbidden_dynamic']) &&
	!($IS_ADMIN || $IS_FOUNDER || defined('P8_GENERATE_HTML'))
){
	//禁止查看动态页,生成静态管理员例外
	message('access_denied');
}

//页面缓存参数: 系统首页
$PAGE_CACHE_PARAM['system_index'] = 'cms';

//页面缓存
$PAGE_CACHE_PARAM['ttl'] = empty($this_system->CONFIG['index_page_cache_ttl']) ? 0 : $this_system->CONFIG['index_page_cache_ttl'];
page_cache($PAGE_CACHE_PARAM);

//标签后缀
$LABEL_POSTFIX = array('index');

//防止窜标题及SEO
unset($data, $CAT);

$LINKRSS = array(
	'title' => $core->CONFIG['site_name'],
	'url' => $this_system->controller .'/item-rss'
);
$select = select();
$select -> from("p8_forms_item as i",'i.*');
$select -> left_join("p8_forms_item_student_platform as d",'d.*','i.id=d.id');
$select -> in('i.mid',206);
$select -> in('i.uid',$UID);
$mylist = $core->list_item($select,array());

$member_config = $core->get_config('core','member');
$member_info = $USERNAME ? get_member($USERNAME) : array();
$member_info['personalphoto'] = $mylist[0]['personalphoto'] ? attachment_url($mylist[0]['personalphoto']) : '';
include template($this_system, 'default');

//保存页面缓存
page_cache();
