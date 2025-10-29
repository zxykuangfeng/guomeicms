<?php
$__FILE__ = __FILE__;
require_once dirname($__FILE__).'/inc/init.php';


/**
* 站点的入口, s.php/domain/action
**/

//上次活动时间
$P8SESSION['lastview'] = P8_TIME;

//加载会员模块并验证
member_verify();
//前端IP限制
front_ip();

defined('P8_SITES') or define('P8_SITES', true	);
//获取URL路由
$router = array();
list($uri, ) = explode('?', $_SERVER['_REQUEST_URI'], 2);
if(substr_count($uri,'/s.php')>1){header('HTTP/1.1 404 Not Found');exit;}
$self = basename($__FILE__);
if(!empty($_SITENAME)){substr($uri, -1) == '/' && $uri .= $self;}
$uri = substr(preg_replace('|^/.*'. $self .'|', '', $uri), 1);
//只分割1个/
$router = explode('/', $uri, 2);

$SYSTEM = $MODULE = $script = '';
$ACTION = 'main';
//默认动作index

$URL_PARAMS = array();
$LABEL_POSTFIX=1;
if(empty($router)){
	$SITENAME=!empty($_SITENAME)?$_SITENAME:'';
	$ACTION = 'main';
}else{
	$SITENAME=!empty($_SITENAME)?$_SITENAME:$router[0];
	if(count($router) > 1 && $action_router = match_action($router[1])){
		$MODULE = $action_router[0];
		$ACTION = $action_router[1];
		
		$URL_PARAMS = array_slice($action_router, 2);
	}else{
		//$MODULE = 'item';
		$ACTION = 'main';
	}
}

if(!empty($SITENAME))$_GET['site'] = $SITENAME;
//加载系统
$SYSTEM='sites';
$this_system = &$core->load_system($SYSTEM);
load_language($this_system, 'global');

$SITE = $this_system->site;
if(empty($SITE)){
	message('no_such_site');
}
if(empty($SITE['status'])){
	//关闭网站,管理员放行
	message('site_is_closed');
    return;
}
if(!empty($SITE['config']['login']) && !$IS_ADMIN){
	$UID or message('site_need_login',$core->U_controller.'?site='.$SITENAME.'&forward='.$core->url.'/s.php/'.$SITENAME,0);
}
if(!$IS_ADMIN && $SITE['config']['allow_ip']['enabled']) {
    $this_system->allow_ip($SITE['config']['allow_ip']);
}
if(!$IS_ADMIN && $SITE['config']['stop_ip']['enabled']) {
    $this_system->stop_ip($SITE['config']['stop_ip']);
}
if(!empty($SITE['ipordomain']) && !empty($_SITENAME) )
	$SITE_URL=$SITE['domain'].'/index.php/';
else
	$SITE_URL=$core->CONFIG['url'].'/s.php/'.$SITE['alias'].'/';

load_language($this_system, 'global');
if($MODULE){
	if(empty($this_system->modules[$MODULE]['enabled'])) message('no_such_module');
	
	//模块action system/module-action-...
	$this_module = &$this_system->load_module($MODULE);
	$this_router = $SITE_URL.$MODULE;
	$this_url = $this_router .'-'. $ACTION;
	$this_r_router = $core->CONFIG['url'].'/s.php/'.$SITE['alias'].'/'.$MODULE;
	$label_url = $core->CONFIG['url'].'/s.php/'.$SITE['alias'].'/'.$MODULE.'-'. $ACTION;
	$script_path = $this_module->path;
	$this_controller = &$core->controller($this_module);
	load_language($this_module, 'global');
}else{
	$this_router = $SITE_URL;
	$this_url = $this_router;
	$this_r_router = $core->CONFIG['url'].'/s.php/'.$SITE['alias'].'/'.$MODULE;
	$label_url = $core->CONFIG['url'].'/s.php/'.$SITE['alias'].'/';
	$script_path = $this_system->path;
	$this_controller = &$core->controller($this_system);
}

//if(defined('USEDOMAIN')){
//	$RESOURCE = $this_system->domain.'/../../..';
//}
$SITE['config']['logo'] = isset($SITE['config']['logo']) && $SITE['config']['logo'] ? attachment_url($SITE['config']['logo'],false,true) : '';
$SITE['config']['logo_motto']  = isset($SITE['config']['logo_motto']) && $SITE['config']['logo_motto'] ? attachment_url($SITE['config']['logo_motto'],false,true) : '';
$SITE['config']['logo_header']  = isset($SITE['config']['logo_header']) && $SITE['config']['logo_header'] ? attachment_url($SITE['config']['logo_header'],false,true) : '';
$SITE['config']['logo_footer']  = isset($SITE['config']['logo_footer']) && $SITE['config']['logo_footer'] ? attachment_url($SITE['config']['logo_footer'],false,true) : '';
$SITE['config']['logo_1']  = isset($SITE['config']['logo_1']) && $SITE['config']['logo_1'] ? attachment_url($SITE['config']['logo_1'],false,true) : '';
$SITE['config']['logo_2']  = isset($SITE['config']['logo_2']) && $SITE['config']['logo_2'] ? attachment_url($SITE['config']['logo_2'],false,true) : '';
$SITE['config']['logo_3']  = isset($SITE['config']['logo_3']) && $SITE['config']['logo_3'] ? attachment_url($SITE['config']['logo_3'],false,true) : '';
$TEMPLATE = empty($this_system->site['template']) ? 'default' : $this_system->site['template'];
$SKDIR = $RESOURCE .'/skin/'. $TEMPLATE .'/';
$SKIN = $RESOURCE .'/skin/sites/'. $TEMPLATE .'/';

$script = $script_path . $ACTION .'.php';

defined('P8_SYSTEM') or define('P8_SYSTEM', $SYSTEM);
defined('P8_MODULE') or define('P8_MODULE', $MODULE);
defined('P8_ACTION') or define('P8_ACTION', $ACTION);



$LABEL_URL = xss_url($label_url .($URL_PARAMS ? '-'. implode('-', $URL_PARAMS) : '').'?'. $_SERVER['QUERY_STRING']);
//初始化标签
//$LABEL_POSTFIX = array($SITENAME);
//脚本不存在
is_file($script) or message('access_denied');

if($UID && !get_cookie('USERNAME')){
	set_cookie('USERNAME', jsonencode($USERNAME));
	set_cookie('UID', $UID);
	set_cookie('ROLE', $ROLE);
	$IS_ADMIN && set_cookie('IS_ADMIN', $IS_ADMIN);
}

//如果在生成静态,把角色回归到游客
if(defined('P8_GENERATE_HTML')){
	$ROLE = $core->ROLE = $this_system->ROLE = $this_controller->ROLE = $core->CONFIG['guest_role'];
	$UID = $IS_ADMIN = $IS_FOUNDER = 0;
	$ROLE_GROUP = $core->CONFIG['person_role_group'];
	
	//重新初始化权限
	$this_controller->init();
}

//页面缓存参数
$PAGE_CACHE_PARAM = array($this_url);

//插件		插件数据	标签数据
$PLUGIN = $__plugin = $__label = array();

//gzip
if(function_exists('ob_gzhandler') && !empty($core->CONFIG['gzip']) && !defined('P8_GENERATE_HTML')) ob_start('ob_gzhandler');

if(P8_EDIT_LABEL && !defined('P8_GENERATE_HTML') && $IS_ADMIN){
    $mysites = $this_system->get_manage_sites();
    in_array($this_system->SITE,$mysites) or message('no_label_privilege');
}

//执行脚本
require $script;

//执行计划任务咯,生成静态时不执行
if(
	!defined('P8_CRONTAB') && !defined('P8_GENERATE_HTML') &&
	!$core->ismobile
){
	require $this_system->path.'/call/sites_index_to_html.php';
}
/* 
echo '<pre>';
echo $core->admin_controller.'<br/>';
echo 'script:'.$script.'<br/>';
echo $_SERVER['QUERY_STRING'].'<br/>';
echo "SITENAME=$SITENAME,MODULE=$MODULE,ACTION=$ACTION,<br/> 
SKIN=$SKIN,LABEL_URL=$LABEL_URL<br/>
this_router=$this_router<br/>
this_url=$this_url<br/>;
SITE_URL=$SITE_URL<br/>
router=";
print_r($router);
print_r(get_included_files());
echo '<br />';
echo 'Time: '. (get_timer() - $P8['start_time']) .'<br />';
echo 'Memory: '. (memory_usage() - $P8['memory_usage'])/1000 .' KB<br />';
echo 'Querys: '. $core->DB_master->query_num .'<br />';
echo 'Uid: '. $UID .'<br />';
echo 'Role: '. $core->ROLE .'<br />';
echo 'Role_gid: '. $ROLE_GROUP .'<br />';
echo '</pre>';

 */









