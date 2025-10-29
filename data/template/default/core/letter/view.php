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
$__label['letter_vt2'] = $LABEL->display('letter_vt2');
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
$__label['letter_vt2'] = $LABEL->display('letter_vt2');
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
<div class="breadbanner mb20">
<div class="fluid">
<div class="bigbanner">
{$__label['bigbanner_letter_gg']}
</div>
</div>
</div>
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
<!--startprint1-->
<!--打印内容开始-->
<div class="layout">
<div class="maincon clearfix">
<div class="boxouter">
<h1 style="text-align:center">信件内容详情</h1>
<h1 style="text-align:center"></h1>
<div class="table_hd"><div class="fl b">编号:<span>{$data['number']}</span>
EOT;
if($manager){
print <<<EOT
&nbsp;&nbsp;查询码:<span>{$data['code']}</span>
EOT;
}
print <<<EOT

</div>
<div class="fl m">{$__label['letter_vt2']}</div><div class="fr b">申请日期:<span>
EOT;
echo date('Y-m-d',$data['create_time']);
print <<<EOT
</span></div></div>
<table class="mailtb" width="100%" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse;border:1px solid #000;">
<tr>
<td width="20%" class="grey b center">姓名</td>
<td width="30%" class="red">{$data['username']}</td>
<td width="20%" class="grey b center">性别</td>
<td width="30%" class="red">
EOT;
if($data['gender']==1){
print <<<EOT
男
EOT;
}else{
print <<<EOT
女
EOT;
}
print <<<EOT
</td>
</tr>
<tr>
<td width="20%" class="grey b center">年龄</td>
<td width="30%" class="red">{$data['age']}</td>
<td width="20%" class="grey b center">邮编</td>
<td width="30%" class="red">{$data['email']}</td>
</tr>
<tr>
<td width="20%" class="grey b center">身份</td>
<td width="30%" class="red">{$data['profession']}</td>
<td width="20%" class="grey b center">问题类别</td>
<td width="30%" class="red">{$cates['type'][$data['type']]['name']}</td>
</tr>
<tr>
<td class="grey b center">联系地址</td>
<td class="red">{$data['address']}</td>
<td class="grey b center">联系电话</td>
<td class="red">{$data['phone']}</td>
</tr>
<tr>
<td class="grey b center">申请人IP</td>
<td colspan="3" class="red">
EOT;
if($IS_FOUNDER){
print <<<EOT
{$data['p8_ip']}
EOT;
}
print <<<EOT
</td>
</tr>
<tr>
<td class="grey b center">证件类型</td>
<td class="red">{$id_type[$data['id_type']]}</td>
<td class="grey b center">证件号码</td>
<td class="red">{$data['id_num']}</td>
</tr>
<tr>
<td class="grey b center">主题</td>
<td colspan="3" class="red">{$data['title']}</td>
</tr>
<tr>
<td class="grey b center">内容</td>
<td colspan="3" class="fonty">
<span lang="zh-cn" xml:lang="zh-cn">{$data['data'][0]['content']}</span></td>
</tr>
EOT;
if(!empty($data['data'][0]['attachment'])){
print <<<EOT

<tr>
<td class="grey b center">附件</td>
<td colspan="3" class="red"><a href="{$data['data'][0]['attachment']}" target="_blank">{$data['data'][0]['attachment_name']}</a></td>
</tr>
EOT;
}
print <<<EOT

</table>
<div class="clear"></div>
<div class="rlink">处理结果</div>
<table class="mailtb" width="100%" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse;border:1px solid #000;">
<tr>
<td class="grey b center">受理部门</td>
<td class=" red">
EOT;
if(!empty($data['solve_department'])){
print <<<EOT
{$cates['department'][$data['solve_department']]['name']}
EOT;
}
print <<<EOT
</td>
EOT;
if($data['finish_name']){
print <<<EOT

<td class="grey b center">受理人</td>
<td class="red">{$data['solve_name']}</td>
</tr>

<tr>
<td class="grey b center">领导审核</td>
<td class="red">{$data['finish_name']}</td>
EOT;
}
print <<<EOT

<td class="grey b center">计划完成时间</td>
<td class="red">
EOT;
if($data['finish_time'])echo date('Y-m-d',$data['finish_time']);
print <<<EOT
</td>
</tr>


<tr>
<td class="grey b center">处理进度</td>
<td class="red">{$P8LANG['status_'.$data['status']]}</td>
<td class="grey b center">完成时间</td>
<td class="red">
EOT;
if($data['data'][0]['reply_time'])echo date('Y-m-d',$data['data'][0]['reply_time']);
print <<<EOT
</td>
</tr>

<tr>
<td class="grey b center">答复内容</td>
<td colspan="3" class="fonty"> <span lang="zh-cn" xml:lang="zh-cn">
EOT;
if(!empty($data['data'][0]['reply'])){
print <<<EOT
{$data['data'][0]['reply']}
EOT;
}
print <<<EOT
</span></td>
</tr>
</table>
<div class="clear"></div>
<!--打印内容结束-->
<!--endprint1-->
<p style="text-align:right; margin:30px 0 20px 0">
【<a href="{$this_router}-post">发布</a>】 
EOT;
if($manager){
print <<<EOT

<script type="text/javascript">
var message = new Message();
</script>
【<a href="{$this_router}-reply?id={$data['id']}">处理</a>】 
【<a href="javascript:;" onclick="message.send($data[uid])"><img src="{$RESOURCE}/images/qyfa.gif" border="0" align="top"/></a>】 
EOT;
if($delletter){
print <<<EOT
【<a  href="{$this_url}?act=del&id={$data['id']}" onclick="javascript:if(!confirm('确定要删？'))return false;">删除</a>】
EOT;
}
}
print <<<EOT

【<a href="javascript:;" onclick="javascript:preview(1)">打印</a>】 
【<a href="javascript:;"  onclick="window.close()">关闭</a>】 
</p>
</div>
</div>
</div>
</div>
</div>
</div>
<script language="javascript">
function preview(oper)
{
if (oper < 10){
bdhtml=window.document.body.innerHTML;
sprnstr="<!--startprint"+oper+"-->";
eprnstr="<!--endprint"+oper+"-->";
prnhtml=bdhtml.substring(bdhtml.indexOf(sprnstr)+18);
prnhtml=prnhtml.substring(0,prnhtml.indexOf(eprnstr));
window.document.body.innerHTML=prnhtml;
window.print();
window.document.body.innerHTML=bdhtml;
} else {
window.print();
}
}
</script></div>
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