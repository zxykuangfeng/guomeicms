<?php
defined('PHP168_PATH') or die();

$LABEL = &$core->load_module('label');
global $__label;
if(!isset($LABEL_POSTFIX))global $LABEL_POSTFIX;
 if(!$SYSTEM)global $SYSTEM; if(!$MODULE)global $MODULE; if(!$SITENAME)global $SITENAME; if(!$ENV)global $ENV; if(!$LABEL_PAGE)global $LABEL_PAGE; $LABEL->init($SYSTEM, $MODULE, $LABEL_PAGE, $SITENAME, $ENV);
$LABEL->postfix(isset($LABEL_POSTFIX) ? $LABEL_POSTFIX : array());
$LABEL->get_data_cache();
$__label = array();
$__label['bigbanner_letter_gg'] = $LABEL->display('bigbanner_letter_gg');
$__label['letter_top_nav_con2'] = $LABEL->display('letter_top_nav_con2');
$__label['letter_nav_con1'] = $LABEL->display('letter_nav_con1');
$__label['list_letter_box1_tt1'] = $LABEL->display('list_letter_box1_tt1');
$__label['list_letter_box1_con1'] = $LABEL->display('list_letter_box1_con1');
$__label['ycsyy_footer_copyright'] = $LABEL->display('ycsyy_footer_copyright');
$__label['ycsyy_footer_pic3'] = $LABEL->display('ycsyy_footer_pic3');
$__label['ycsyy_footer_t3'] = $LABEL->display('ycsyy_footer_t3');
$__label['ycsyy_footer_pic2'] = $LABEL->display('ycsyy_footer_pic2');
$__label['ycsyy_footer_t2'] = $LABEL->display('ycsyy_footer_t2');
$__label['ycsyy_footer_pic1'] = $LABEL->display('ycsyy_footer_pic1');
$__label['ycsyy_footer_t1'] = $LABEL->display('ycsyy_footer_t1');
$__label['ycsyy_footer_fixed'] = $LABEL->display('ycsyy_footer_fixed');
$__label['footer_adv'] = $LABEL->display('footer_adv');
$__label_empty = true;
foreach($__label as $__label_key => $__label_value){
if($__label_value) {$__label_empty = false;break;}
}
if($__label_empty){
$LABEL->cache();
$LABEL->cache_data();$LABEL->postfix(isset($LABEL_POSTFIX) ? $LABEL_POSTFIX : array());
$LABEL->get_data_cache();
$__label['bigbanner_letter_gg'] = $LABEL->display('bigbanner_letter_gg');
$__label['letter_top_nav_con2'] = $LABEL->display('letter_top_nav_con2');
$__label['letter_nav_con1'] = $LABEL->display('letter_nav_con1');
$__label['list_letter_box1_tt1'] = $LABEL->display('list_letter_box1_tt1');
$__label['list_letter_box1_con1'] = $LABEL->display('list_letter_box1_con1');
$__label['ycsyy_footer_copyright'] = $LABEL->display('ycsyy_footer_copyright');
$__label['ycsyy_footer_pic3'] = $LABEL->display('ycsyy_footer_pic3');
$__label['ycsyy_footer_t3'] = $LABEL->display('ycsyy_footer_t3');
$__label['ycsyy_footer_pic2'] = $LABEL->display('ycsyy_footer_pic2');
$__label['ycsyy_footer_t2'] = $LABEL->display('ycsyy_footer_t2');
$__label['ycsyy_footer_pic1'] = $LABEL->display('ycsyy_footer_pic1');
$__label['ycsyy_footer_t1'] = $LABEL->display('ycsyy_footer_t1');
$__label['ycsyy_footer_fixed'] = $LABEL->display('ycsyy_footer_fixed');
$__label['footer_adv'] = $LABEL->display('footer_adv');
}
$LABEL->refresh_labels();
?>
<?php
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
\$this_router = P8CONFIG.URI[SYSTEM][MODULE].controller,
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
if(!$ISBACK){
if(!empty($this_module->CONFIG['base_domain'])){
$_domain = $this_module->CONFIG['base_domain'];
}else if(!empty($this_system->CONFIG['base_domain'])){
$_domain = $this_system->CONFIG['base_domain'];
}else{
$_domain = $core->CONFIG['base_domain'];
}
echo empty($_domain) ? '' : ';document.domain = \''. $_domain .'\';';
echo ';document.base_domain = \''. $_domain .'\';';
echo "$(document).ready(function () {checkIfUserIsInLAN(STATIC_URL+'/images/arrow.gif');CheckUrlIsInLAN('body');});";
}
print <<<EOT

</script>
EOT;
if($core->CONFIG['site_gray']){
print <<<EOT

<!--[if IE]>
<style>html{filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);}</style>
<!--<![endif]-->
<!--[if !IE]><-->
<style>html{
filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);filter: grayscale(100%);
-webkit-filter: grayscale(100%);-moz-filter: grayscale(100%);
-ms-filter: grayscale(100%);-o-filter: grayscale(100%);
filter: progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);filter: gray;
-webkit-filter: grayscale(1);
}</style>
<!--<![endif]-->
EOT;
}
print <<<EOT


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
<div id="content-full"><link rel="stylesheet" type="text/css" href="{$RESOURCE}/skin/default/core/letter/style.css" />
<link rel="stylesheet" type="text/css" href="{$RESOURCE}/skin/default/core/css/style_list.css">
<link rel="stylesheet" type="text/css" href="{$RESOURCE}/images/dialog.css" />
<script type="text/javascript" src="{$RESOURCE}/js/upload.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/core/label/label.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
$(".letternav li").hover(function() {
$(this).children("ul").slideDown();
}, function() {
$(this).children("ul").stop(true,false).slideUp();
});
});
</script>
<script type="text/javascript">
$().ready(function() {
$("#form").validate();
});
(function( factory ) {
if ( typeof define === "function" && define.amd ) {
define( ["jquery", "../jquery.validate"], factory );
} else {
factory( jQuery );
}
}(function($) {
$.extend($.validator.messages, {
required: "必填或必选",
remote: "请修正",
email: "请输入有效的电子邮件地址",
url: "请输入有效的网址",
date: "请输入有效的日期",
dateISO: "请输入有效的日期 (YYYY-MM-DD)",
number: "请输入有效的数字",
digits: "只能输入数字",
equalTo: "你的输入不相同",
extension: "请输入有效的后缀",
maxlength: $.validator.format("最多可以输入 {0} 个字符"),
minlength: $.validator.format("最少要输入 {0} 个字符"),
rangelength: $.validator.format("请输入长度在 {0} 到 {1} 之间"),
range: $.validator.format("请输入范围在 {0} 到 {1} 之间的数值"),
max: $.validator.format("请输入不大于 {0} 的数值"),
min: $.validator.format("请输入不小于 {0} 的数值")
});
}));
$.validator.addMethod('valid_email', function(value, element){
return value.length > 3 && /^[\\w\\-\\.]+@[\\w\\-\\.]+(\\.\\w+)+$/.test(value);
});
$.validator.addMethod('valid_phone', function(value, element){
return value.length > 3 && /^[0-9_-]+$/.test(value);
});
var MODEL = '$MODEL';
var attachment_hash = '$attachment_hash';
</script>
<div class="breadbanner delmag">
<div class="fluid">
<div class="bigbanner">
{$__label['bigbanner_letter_gg']}
</div>
</div>
</div>
<div class="container">
<div class="layout">
<div class="row">
<div class="col-md-12 col-sm-12">
<div class="menubar">
<div class="menu">
<div class="menulist">
{$__label['letter_top_nav_con2']}
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-8 col-sm-8 col-xs-12">
<div class="letitle">
<h2>我要写信</h2>
<div class="more"><a href="{$core->controller}/letter-list">信件</a></div>
</div>
<div class="leform">
<form id="form" action="" method="post">
EOT;
if($data['department']){
print <<<EOT
<h1 style="text-align:center;margin:10px;">{$cates['department'][$data['department']]['name']}</h1>
EOT;
}
print <<<EOT

<table width="100%" cellspacing="0" cellpadding="0" border="0" class="letabel">
<tr class="tt">
<td colspan="5">姓名：</td>
</tr>
<tr>
<td  class="white" colspan="4">
<input type="text" name="username" id="username" value="
EOT;
if(!empty($data['username'])){
print <<<EOT
{$data['username']}
EOT;
}else{
print <<<EOT
{$USERNAME}
EOT;
}
print <<<EOT
" required />
<span class="start">*</span></td>
</td>
</tr>
<tr class="tt">
<td colspan="5">身份：</td>
</tr>
<tr>
<td  class="white" colspan="4">
<select name="profession" id="profession">
<option value="">请选择</option>
<option value="患者" 
EOT;
if(!empty($data['profession']) && $data['profession']=='患者'){
print <<<EOT
selected
EOT;
}
print <<<EOT
>患者</option>
<option value="医生" 
EOT;
if(!empty($data['profession']) && $data['profession']=='医生'){
print <<<EOT
selected
EOT;
}
print <<<EOT
>医生</option>
<option value="其他" 
EOT;
if(!empty($data['profession']) && $data['profession']=='其他'){
print <<<EOT
selected
EOT;
}
print <<<EOT
>其他</option>
</select>
</td>
</tr>
<tr class="tt">
<td colspan="5">性别：</td>
</tr>
<tr>
<td  class="white" colspan="4">
<select name="gender" id="gender" required>
<option value="1" 
EOT;
if(!empty($data['gender']) && $data['gender']==1){
print <<<EOT
selected
EOT;
}
print <<<EOT
>男</option>
<option value="2" 
EOT;
if(!empty($data['gender']) && $data['gender']==2){
print <<<EOT
selected
EOT;
}
print <<<EOT
>女</option>
</select><span class="start">*</span></td>
</td>
</tr>
<tr class="tt">
<td colspan="5">地址：</td>
</tr>
<tr>
<td  class="white" colspan="4">
<input type="text" name="address" id="address"  class="input1"  value="
EOT;
if(!empty($data['address'])){
print <<<EOT
{$data['address']}
EOT;
}
print <<<EOT
" />
</td>
</tr>
<tr class="tt">
<td colspan="5">邮编：</td>
</tr>
<tr>
<td  class="white" colspan="4">
<input type="text" name="email" id="email"  value="
EOT;
if(!empty($data['email'])){
print <<<EOT
{$data['email']}
EOT;
}
print <<<EOT
" required/>
</td>
</tr>
<tr class="tt">
<td colspan="5">联系电话：</td>
</tr>
<tr>
<td  class="white" colspan="4"><input type="text" name="phone" id="phone"  value="
EOT;
if(!empty($data['phone'])){
print <<<EOT
{$data['phone']}
EOT;
}
print <<<EOT
"/>
<span class="start">*</span>
</td>
</tr>

<tr class="tt">
<td colspan="5">年龄：</td>
</tr>
<tr>
<td  class="white" colspan="4"><input type="text" name="age" id="age" value="
EOT;
if(!empty($data['age'])){
print <<<EOT
{$data['age']}
EOT;
}
print <<<EOT
" />
<span class="start">*</span>
</td>
</tr>
<tr class="tt">
<td colspan="5">证件类型：</td>
</tr>
<tr>
<td  class="white" colspan="4">
<select name="id_type" id="id_type">
<option value="">请选择</option>
EOT;
$__t_foreach = @$id_type;
if(!empty($__t_foreach)){
foreach($__t_foreach as $key => $row){
print <<<EOT

<option value="{$key}" 
EOT;
if(!empty($data['id_type']) && $data['id_type']==$key){
print <<<EOT
selected
EOT;
}
print <<<EOT
>{$row}</option>
EOT;
}
}

print <<<EOT
   
</select><span style="color:#808069"> 仅自己和管理员可查看</span>
</td>
</tr>
<tr class="tt">
<td colspan="5">证件号码：</td>
</tr>
<tr>
<td  class="white" colspan="4">
<input type="text" name="id_num" id="id_num" class="input2" value="
EOT;
if(!empty($data['id_num'])){
print <<<EOT
{$data['id_num']}
EOT;
}
print <<<EOT
"/>
</td>
</tr>
<tr class="tt">
<td colspan="5">标题：</td>
</tr>
<tr>
<td  class="white" colspan="4"><input type="text" name="title" id="title"  class="input1" value="
EOT;
if(!empty($data['title'])){
print <<<EOT
{$data['title']}
EOT;
}
print <<<EOT
"/>
<span class="start">*</span>
</td>
</tr>
<tr class="tt">
<td colspan="5">信件类别:</td>
</tr>
<tr>
<td  class="white">
<select name="type" id="type" class="input2">
<option value="">----请选择类别----</option>
EOT;
$__t_foreach = @$cates['type'];
if(!empty($__t_foreach)){
foreach($__t_foreach as $key => $row){
print <<<EOT

<option value="{$row['id']}" 
EOT;
if(!empty($data['type']) && $data['type']==$row['id']){
print <<<EOT
selected
EOT;
}
print <<<EOT
>{$row['name']}</option>
EOT;
}
}

print <<<EOT

</select>
<span class="start">*</span>
</td>
</tr>
<tr class="tt">
<td colspan="5">内容:</td>
</tr>
<tr>
<td  class="white" colspan="3"><textarea name="content" id="content" cols="45" rows="5" class="input3">
EOT;
if(!empty($data['data'][0]['content'])){
print <<<EOT
{$data['data'][0]['content']}
EOT;
}
print <<<EOT
</textarea>
<span class="start">*</span></td>
</tr>
<!--<tr class="tt">
<td colspan="5">是否公开:</td>
</tr>
<tr>
<td  class="white" colspan="3"><input type="radio" name="visual"  value="1"  
EOT;
if(!empty($data['visual'])){
print <<<EOT
checked
EOT;
}
print <<<EOT
/>
公开
<input type="radio" name="visual"  value="0" 
EOT;
if(empty($data['visual'])){
print <<<EOT
checked
EOT;
}
print <<<EOT
 />
不公开
<span style="color:#808069">（此内容是否愿意公开显示出来）</span>
</td>
</tr>-->
EOT;
if($captcha_enable){
print <<<EOT

<tr class="tt">
<td colspan="5">验证码:</td>
</tr>
<tr>
<td class="white" colspan="3"><input name="captcha" type="text" id="captcha" class="input" />
<span id="captcham"></span>
<script type="text/javascript">
captcha($('#captcham'), $('#captcha'));
</script><span style="color:#808069">（点击填写框显示验证码 / 点击验证码可更新）</span>
</td>
</tr>
EOT;
}
print <<<EOT

<tr>
<td  align="center" colspan="5">
<input type="submit" name="submitbutton" class="sbtn" value="提交" />
<input type="reset" name="reset" class="rbtn" value="重置" />
<input type="hidden" name="id" value="
EOT;
if(!empty($id)){
print <<<EOT
{$id}
EOT;
}
print <<<EOT
" />
<input type="hidden" name="username" value="{$USERNAME}" />
<input type="hidden" name="token" value="{$token}" />
<input type="hidden" name="department" id="department" value="
EOT;
if($data['department']){
print <<<EOT
{$data['department']}
EOT;
}else{
print <<<EOT
{$letterconfig['redepartment']}
EOT;
}
print <<<EOT
"/>
<input type="hidden" name="attachment_hash" value="{$attachment_hash}" />
</td>
</tr>
</table>
</form>
</div>
</div>
<div class="col-md-4 col-sm-4 col-xs-12">
<div class="letternav">
{$__label['letter_nav_con1']}
</div>
<div class="lxxz">
<div class="hd">
<h3>{$__label['list_letter_box1_tt1']}</h3>
</div>
<div class="bd">
{$__label['list_letter_box1_con1']}
</div>
</div>
</div>
</div>
</div>
</div>
<div class="clear"> </div></div>
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
<div>{$__label['footer_adv']}</div>
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