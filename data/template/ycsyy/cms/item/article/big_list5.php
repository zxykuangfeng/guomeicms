<?php
defined('PHP168_PATH') or die();

$LABEL = &$core->load_module('label');
global $__label;
if(!isset($LABEL_POSTFIX))global $LABEL_POSTFIX;
 if(!$SYSTEM)global $SYSTEM; if(!$MODULE)global $MODULE; if(!$SITENAME)global $SITENAME; if(!$ENV)global $ENV; if(!$LABEL_PAGE)global $LABEL_PAGE; $LABEL->init($SYSTEM, $MODULE, $LABEL_PAGE, $SITENAME, $ENV);
$LABEL->postfix(isset($LABEL_POSTFIX) ? $LABEL_POSTFIX : array());
$LABEL->get_data_cache();
$__label = array();
$__label['bigbanner_daohan_gg'] = $LABEL->display('bigbanner_daohan_gg');
$__label['big_list5_tt1'] = $LABEL->display('big_list5_tt1');
$__label['big_list5_more1'] = $LABEL->display('big_list5_more1');
$__label['big_list5_con1'] = $LABEL->display('big_list5_con1');
$__label['big_list5_tt2'] = $LABEL->display('big_list5_tt2');
$__label['big_list5_more2'] = $LABEL->display('big_list5_more2');
$__label['big_list5_con2'] = $LABEL->display('big_list5_con2');
$__label['big_list5_tt3'] = $LABEL->display('big_list5_tt3');
$__label['big_list5_more3'] = $LABEL->display('big_list5_more3');
$__label['big_list5_con3'] = $LABEL->display('big_list5_con3');
$__label['ycsyy_footer_copyright'] = $LABEL->display('ycsyy_footer_copyright');
$__label['ycsyy_footer_pic3'] = $LABEL->display('ycsyy_footer_pic3');
$__label['ycsyy_footer_t3'] = $LABEL->display('ycsyy_footer_t3');
$__label['ycsyy_footer_pic2'] = $LABEL->display('ycsyy_footer_pic2');
$__label['ycsyy_footer_t2'] = $LABEL->display('ycsyy_footer_t2');
$__label['ycsyy_footer_pic1'] = $LABEL->display('ycsyy_footer_pic1');
$__label['ycsyy_footer_t1'] = $LABEL->display('ycsyy_footer_t1');
$__label['ycsyy_footer_fixed'] = $LABEL->display('ycsyy_footer_fixed');
$__label_empty = true;
foreach($__label as $__label_key => $__label_value){
if($__label_value) {$__label_empty = false;break;}
}
if($__label_empty){
$LABEL->cache();
$LABEL->cache_data();$LABEL->postfix(isset($LABEL_POSTFIX) ? $LABEL_POSTFIX : array());
$LABEL->get_data_cache();
$__label['bigbanner_daohan_gg'] = $LABEL->display('bigbanner_daohan_gg');
$__label['big_list5_tt1'] = $LABEL->display('big_list5_tt1');
$__label['big_list5_more1'] = $LABEL->display('big_list5_more1');
$__label['big_list5_con1'] = $LABEL->display('big_list5_con1');
$__label['big_list5_tt2'] = $LABEL->display('big_list5_tt2');
$__label['big_list5_more2'] = $LABEL->display('big_list5_more2');
$__label['big_list5_con2'] = $LABEL->display('big_list5_con2');
$__label['big_list5_tt3'] = $LABEL->display('big_list5_tt3');
$__label['big_list5_more3'] = $LABEL->display('big_list5_more3');
$__label['big_list5_con3'] = $LABEL->display('big_list5_con3');
$__label['ycsyy_footer_copyright'] = $LABEL->display('ycsyy_footer_copyright');
$__label['ycsyy_footer_pic3'] = $LABEL->display('ycsyy_footer_pic3');
$__label['ycsyy_footer_t3'] = $LABEL->display('ycsyy_footer_t3');
$__label['ycsyy_footer_pic2'] = $LABEL->display('ycsyy_footer_pic2');
$__label['ycsyy_footer_t2'] = $LABEL->display('ycsyy_footer_t2');
$__label['ycsyy_footer_pic1'] = $LABEL->display('ycsyy_footer_pic1');
$__label['ycsyy_footer_t1'] = $LABEL->display('ycsyy_footer_t1');
$__label['ycsyy_footer_fixed'] = $LABEL->display('ycsyy_footer_fixed');
}
$LABEL->refresh_labels();
?>
<?php
$TITLE = (empty($data['title']) ? '' : $data['title'] .' - ').
(empty($CAT['name']) ? '' : $CAT['name'] .' - '). $core->CONFIG['site_name'];

if(!empty($data['seo_keywords'])){
$SEO_KEYWORDS = $data['seo_keywords'];
}else if(!empty($CAT['seo_keywords'])){
$SEO_KEYWORDS = $CAT['seo_keywords'];
}else{
$SEO_KEYWORDS = $core->CONFIG['site_key_word'];
}

if(!empty($data['seo_description'])){
$SEO_DESCRIPTION = $data['seo_description'];
}else if(!empty($CAT['seo_description'])){
$SEO_DESCRIPTION = $CAT['seo_description'];
}else{
$SEO_DESCRIPTION = $core->CONFIG['site_description'];
}
print <<<EOT

<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset={$core->CONFIG['page_charset']}" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=2.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="renderer" content="webkit">
<meta name="keywords" content="$SEO_KEYWORDS" />
<meta name="description" content="$SEO_DESCRIPTION" />
<title>$TITLE</title>
<link href="{$RESOURCE}/skin/sites/common/css/bootstrap2.min.css" type="text/css"  rel="stylesheet" >
<link href="{$RESOURCE}/skin/sites/common/css/global.css" type="text/css"  rel="stylesheet" >
<link rel="stylesheet" type="text/css" href="{$RESOURCE}/skin/ycsyy/core/header/common.css" />
<link rel="stylesheet" type="text/css" href="{$RESOURCE}/skin/ycsyy/core/header/header.css" />
<link rel="stylesheet" type="text/css" href="{$RESOURCE}/skin/label/label.css" />
<link rel="stylesheet" type="text/css" href="{$RESOURCE}/skin/label/theme/theme.css" />
<link rel="stylesheet" type="text/css" href="{$RESOURCE}/skin/label/slick.css">
<!--[if lt IE 9]>
<script src="{$RESOURCE}/html5shiv.min.js"></script>
<script src="{$RESOURCE}/respond.min.js"></script>
<![endif]-->
<script type="text/javascript" src="{$RESOURCE}/js/config.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/util.js"></script>
<script type="text/javascript" src="{$RESOURCE}/skin/sites/common/js/guowei.js"></script>
<script type="text/javascript" src="{$RESOURCE}/skin/sites/common/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{$RESOURCE}/skin/sites/common/js/breakpoints.min.js"></script>
<script type="text/javascript" src="{$RESOURCE}/skin/sites/common/js/bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/jquery.SuperSlide.2.1.1.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/jquery.iosslider.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/jquery.easing-1.3.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/slick.min.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/lang/core/{$core->CONFIG['lang']}.js"></script>
EOT;
if($SYSTEM != 'core'){
print <<<EOT

<script type="text/javascript" src="{$RESOURCE}/js/lang/$SYSTEM/{$core->CONFIG['lang']}.js"></script>
EOT;
}
print <<<EOT

<script type="text/javascript">
P8CONFIG.RESOURCE = '$RESOURCE';
var SYSTEM = '$SYSTEM',
MODULE = '$MODULE',
ACTION = '$ACTION',
LABEL_URL = '$LABEL_URL',
STATIC_URL = '$STATIC_URL',
\$this_router = '{$this_router}',
\$this_url = \$this_router +'-'+ ACTION,
SKIN = '$SKIN',
TEMPLATE = '$TEMPLATE';
mobile_status= '{$core->CONFIG['enable_mobile']}',
mobile_auto_jump='{$core->CONFIG['mobile_auto_jump']}',
mobile_url = '{$core->CONFIG['murl']}';
if(mobile_status=='1' && SYSTEM!='sites'){
if(browser.versions.android || browser.versions.iPhone || browser.versions.iPad){
if(mobile_auto_jump=='1' && mobile_url!=P8CONFIG.RESOURCE){
var this_url = location.href,_pul=P8CONFIG.RESOURCE;
if(this_url.indexOf(mobile_url)==-1 && this_url.indexOf('s.php')==-1 && this_url.indexOf('u.php')==-1 && this_url.indexOf('admin.php')==-1 && SYSTEM!='sites'){
if(this_url.indexOf(P8CONFIG.RESOURCE+'/html')!=-1)_pul+='/html';
if(P8CONFIG.RESOURCE==''){
this_url = mobile_url.indexOf('http')==-1 ? this_url.mobile_url : mobile_url;
}else{
this_url = this_url.replace(_pul, mobile_url);
}
location.href = this_url;
}
}
}
}
EOT;
if($SYSTEM=='sites' && defined('P8_SITES')){
$sitestatus=$core->CONFIG['url']. '/sites/html/'.$this_system->SITE.'/sitestatus.js';
print <<<EOT

include('$sitestatus'+'?_='+Math.random())
EOT;
}
print <<<EOT


</script>
</head>
<body>
<div class="headbar">
<div class="navbar navbar-default main-nav">
<div class="header">
<div class="container">
<div class="header-main clearfix">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a href="
EOT;
if($this_system->domain){
print <<<EOT
{$this_system->domain}
EOT;
}else{
echo str_replace('index.php/cms','',$this_system->controller);
}
print <<<EOT
" class="navbar-brand navbar-logo"><img src="
EOT;
if(empty($core->CONFIG['logo'])){
print <<<EOT
{$SKIN}../core/header/images/logo.png
EOT;
}else{
print <<<EOT
{$core->CONFIG['logo']}
EOT;
}
print <<<EOT
"/></a>
</div>
<div class="topinfo hidden-sm hidden-xs">
<div class="search">
<form action="{$RESOURCE}/search" target="_blank" method="get" name="form1" id="form1" class="search-form">
<input type="text" class="form-control" id="keyword" name="word" placeholder="输入关键字">
<input type="submit" class="btn btn-default" value="搜索" id="button" name="">
</form>
</div>
</div>
</div>
</div>
</div>
<div class="navbar-collapse navbar-collapse-toolbar collapse navbar-main" id="bs-example-navbar-collapse-1" aria-expanded="false" style="height: 1px;">
<div class="container">
<ul class="nav navbar-nav navlist">
EOT;
$loadsystem = ($SYSTEM == $core->CONFIG['index_system'] || $core->CONFIG['CoreMenu'])? 'core' : $this_system->name;
$navigation_menu = $CACHE->read('', $loadsystem, 'navigation');
$i=0;
$__t_foreach = @$navigation_menu['menus'];
if(!empty($__t_foreach)){
foreach($__t_foreach as $k => $v){
$i++;
print <<<EOT

<li class="dropdown">
EOT;
if(empty($v['menus']) && $core->CONFIG['ShowMenu']){
print <<<EOT

<a class="dropdown-toggle on$i" data-hover="dropdown" href="$v[url]"  aria-expanded="false" role="button" target="$v[target]">$v[name]</a>
EOT;
}
if(!empty($v['menus']) && $core->CONFIG['ShowMenu']){
print <<<EOT

<a class="dropdown-toggle link on$i" data-toggle="dropdown" data-hover="dropdown" href="$v[url]"  aria-expanded="false" role="button" target="$v[target]">$v[name]</a>
<ul class="dropdown-menu" role="menu">
EOT;
$j=0;
$__t_foreach = @$v['menus'];
if(!empty($__t_foreach)){
foreach($__t_foreach as $k2 => $v2){
$j++;
print <<<EOT

<li class="menu$j"><a href="$v2[url]" target="$v2[target]">$v2[name]</a></li>
EOT;
}
}

print <<<EOT

</ul>
EOT;
}
print <<<EOT
		
</li>
EOT;
}
}

print <<<EOT

</ul>
<div class="topinfo2 visible-xs-block">
<div class="search">
<form action="{$core->STATIC_URL}/search" target="_blank" method="get" name="form1" id="form1" class="search-form">
<input type="text" class="form-control" id="keyword" name="keyword" placeholder="输入关键字">
<input type="submit" class="btn btn-default" value="搜索" id="button" name="button">
</form>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="fixednav hidden-xs">
<div class="container">
<div class="navbox clearfix">
<ul id="menu_nav">
EOT;
$loadsystem = ($SYSTEM == $core->CONFIG['index_system'] || $core->CONFIG['CoreMenu'])? 'core' : $this_system->name;
$navigation_menu = $CACHE->read('', $loadsystem, 'navigation');
$i=0;
$__t_foreach = @$navigation_menu['menus'];
if(!empty($__t_foreach)){
foreach($__t_foreach as $k => $v){
$i++;
print <<<EOT

<li class="" _t_nav="tabs$i">
<a href="$v[url]" class="on$i">$v[name]</a>
</li>
EOT;
}
}

print <<<EOT

</ul>
</div>
</div>
</div>
<script type="text/javascript">
var USERNAME = get_username();
$(document).ready(function(){
//**show_edit**//
init_labelshows('header_t');
})
$(window).scroll(function(){
var scrollTop = $(window).scrollTop();
if(scrollTop > 140){
$('.fixednav').css({display:'block'}).stop().animate({'opacity':'1',top:0},100);
}else{
$('.fixednav').css({display:'none'}).stop().animate({'opacity':'0',top:"-50px"},100);
}
});
</script>
<script type="text/javascript">
var date = new Date();
var year = date.getFullYear(),
month = date.getMonth() + 1,
day = date.getDate(),
week = date.getDay();
switch (week) {
case 1:
week = "星期一"
break;
case 2:
week = "星期二"
break;
case 3:
week = "星期三"
break;
case 4:
week = "星期四"
break;
case 5:
week = "星期五"
break;
case 6:
week = "星期六"
break;
case 7:
week = "星期日"
break;
}
$(".today").append("今天是："+week+","+year+"-"+month+"-"+day)
</script>
<div id="content-full">


<link rel="stylesheet" type="text/css" href="{$SKIN}style.css" />
<!--中间内容部分-->
<div class="breadbanner delmag">
<div class="fluid">
<div class="bigbanner">
{$__label['bigbanner_daohan_gg']}
</div>
</div>
</div>
<div class="maincon">
<div class="container">
<div class="column-location mb20 clearfix">
您现在的位置：<a href="
EOT;
if($this_system->domain){
print <<<EOT
{$this_system->domain}
EOT;
}else{
echo str_replace('index.php/cms','',$this_system->controller);
}
print <<<EOT
">首页</a>
EOT;
$__t_foreach = @$parent_cats;
if(!empty($__t_foreach)){
foreach($__t_foreach as $v){
print <<<EOT

>> <a href="$v[url]">$v[name]</a>
EOT;
}
}

print <<<EOT

>> <a href="$CAT[url]">$CAT[name]</a>
</div>
<div class="column-title clearfix">
EOT;
$parent = end($parent_cats);$parent_name = $parent ? $parent[name]:$CAT[name];$parent_url = $parent ? $parent[url] : $CAT[url];
print <<<EOT

$CAT[name]
</div>
<div class="row row30">
<div class="col-md-6 col-sm-6 col-xs-12 col-pd-30">
<div class="part-list4">
<div class="list-title clearfix">
<div class="title pull-left">{$__label['big_list5_tt1']}</div> 
<span class="more pull-right"> 
{$__label['big_list5_more1']}
</span>
</div>
<div class="list-main">
<div class="list-content">
{$__label['big_list5_con1']}
</div>
</div>
</div>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 col-pd-30">
<div class="part-list4">
<div class="list-title clearfix">
<div class="title pull-left">{$__label['big_list5_tt2']}</div> 
<span class="more pull-right"> 
{$__label['big_list5_more2']}
</span>
</div>
<div class="list-main">
<div class="list-content">
{$__label['big_list5_con2']}
</div>
</div>
</div>
<div class="part-list4">
<div class="list-title clearfix">
<div class="title pull-left">{$__label['big_list5_tt3']}</div> 
<span class="more pull-right"> 
{$__label['big_list5_more3']}
</span>
</div>
<div class="list-main">
<div class="list-content">
{$__label['big_list5_con3']}
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="footer">
<div class="container">
<div class="row">
<div class="col-md-9 col-sm-9 col-xs-12">
<div class="copyright">
{$__label['ycsyy_footer_copyright']}
</div>
</div>
<div class="col-md-3 col-sm-3 col-xs-12">
<div class="row">
<div class="col-md-4 col-sm-6 col-xs-6">
<div class="footpic">
<div class="pic">{$__label['ycsyy_footer_pic3']}</div>
<h3 style="color:black;" >{$__label['ycsyy_footer_t3']}</h3>
</div>
</div>
<div class="col-md-4 col-sm-6 col-xs-6">
<div class="footpic">
<div class="pic">{$__label['ycsyy_footer_pic2']}</div>
<h3 style="color:black;" >{$__label['ycsyy_footer_t2']}</h3>
</div>
</div>
<div class="col-md-4 col-sm-6 col-xs-6">
<div class="footpic">
<div class="pic">{$__label['ycsyy_footer_pic1']}</div>
<h3 style="color:black;" >{$__label['ycsyy_footer_t1']}</h3>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="right-nav">
{$__label['ycsyy_footer_fixed']}
</div>
<script type="text/javascript">
$(".top").click(function() {
$("html,body").animate({scrollTop:0}, 500);
}); 
$('.weixin').hover(
function(){
$(".hideBox").addClass('show')
},
function(){
$(".hideBox").removeClass('show')
}
)
</script>
</body>
</html>
EOT;
?>
<?php
if(P8_EDIT_LABEL && !defined('P8_GENERATE_HTML')) echo "<script type=\"text/javascript\">\$(document).ready(function(){\$('.label').each(function(){\$(this).hover(function(){\$(this).css({'opacity':'0.8','filter':'alpha(opacity=80)'});}, function(){\$(this).css({'opacity':'0.4','filter':'alpha(opacity=40)'});}).resizable().dblclick(function(){window.open('{$core->admin_controller}/core/label-update?system=$SYSTEM&module=$MODULE&site=$SITENAME&env=$ENV&place_holder_width='+ \$(this).width() +'&place_holder_height='+ \$(this).height() +'&id='+ this.id.replace(/[^0-9]/g, '') +'&postfix=". (empty($_GET['postfix']) ? (empty($LABEL->last_postfix) ? '' : $LABEL->last_postfix) : $_GET['postfix']) ."&name='+ encodeURIComponent($('span', this).html()) +'&from_js=1&page=". $LABEL_PAGE ."&_referer='+ encodeURIComponent(window.location.href));}).bind('contextmenu', function(){window.open('{$core->admin_controller}/core/label-add?system=$SYSTEM&module=$MODULE&site=$SITENAME&env=$ENV&place_holder_width='+ \$(this).width() +'&place_holder_height='+ \$(this).height() +'&postfix=". (empty($_GET['postfix']) ? (empty($LABEL->last_postfix) ? '' : $LABEL->last_postfix) : $_GET['postfix']) ."&name='+ encodeURIComponent($('span', this).html()) +'&from_js=1&_referer='+ encodeURIComponent(window.location.href));return false;});});});</script>";
?>