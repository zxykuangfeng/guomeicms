<?php
defined('PHP168_PATH') or die();


if(
	!empty($this_system->CONFIG['forbidden_dynamic']) &&
	!($IS_ADMIN || $IS_FOUNDER || defined('P8_GENERATE_HTML'))
){
	//禁止查看动态页,生成静态管理员例外
	//message('access_denied');
	header('Location: '. ($core->CONFIG['index_system'] == $SYSTEM ? $core->url : $this_system->url));
	exit;
}

//页面缓存参数: 系统首页
$PAGE_CACHE_PARAM['system_index'] = 'cms';

//页面缓存
$PAGE_CACHE_PARAM['ttl'] = empty($this_system->CONFIG['index_page_cache_ttl']) ? 0 : $this_system->CONFIG['index_page_cache_ttl'];
page_cache($PAGE_CACHE_PARAM);


//防止窜标题及SEO
unset($data, $CAT);

$LINKRSS = array(
	'title' => $core->CONFIG['site_name'],
	'url' => $this_system->controller .'/item-rss'
);
$allow_main = $this_controller->check_admin_action('font_admin_menu');

//是否在子站首页显示部门统计
$detp_list = array();
$item_config = $core->get_config($this_system->name, 'item');

if($item_config['sites_show_dept']){
	$site_info = $this_system->get_site($this_system->SITE);
	$pid =  isset($site_info['config']['department']) && $site_info['config']['department'] ? intval($site_info['config']['department']) : 0;
	$module_item = $this_system->load_module('item');
	$detp_all = $module_item->get_dept_static($pid,'all');
	$detp_year = $module_item->get_dept_static($pid,'year');
	$detp_month = $module_item->get_dept_static($pid,'month');
}
//检查是否需要密码访问站点,如果是超级管理员,则忽略
if(!$IS_ADMIN && $SITE['config']['need_password']){
	//如果有密码，则检验密码
	//优先从cookie中获取密码，没有则使用用户输入的密码进行验证
	$cookie_password = get_cookie('SITE_PASSWORD_'.$SITENAME) ? get_cookie('SITE_PASSWORD_'.$SITENAME) : '';
	$password = isset($_POST['password']) ? trim($_POST['password']) : $cookie_password;
	$module_item = $this_system->load_module('item');
	if($SITE['config']['site_password']){
		if($password != $SITE['config']['site_password']){
			$action = $core->CONFIG['url'].'/s.php/'.$SITE['alias'];
			$errmessage = $password ? '站点访问密码不正确，请重新输入！' : '';
			include template($module_item, 'password');
			return;
		}
		if($password && empty($cookie_password)) {
			$_config_ = &$core->CONFIG['cookie'];
			$_cookie_name = isset($_config_['prefix']) ? $_config_['prefix'].'SITE_PASSWORD_'.$SITENAME : 'SITE_PASSWORD_'.$SITENAME;
			setcookie($_cookie_name,$password);
			set_cookie('SITE_PASSWORD_'.$SITENAME,$password);			
		}
	}
}
$template = 'index';
include template($this_system, $template);

//保存页面缓存
page_cache();
