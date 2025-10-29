<?php
defined('PHP168_PATH') or die();
?>
<?php
print <<<EOT
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<title>系统后台管理平台</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="X-Csrf-Token" content="{$CSRF_TOKEN}">
<meta name="renderer" content="webkit">
<link href="{$RESOURCE}/skin/sites/common/css/bootstrap.min.css" type="text/css"  rel="stylesheet" >
<link rel="stylesheet" href="{$RESOURCE}/skin/admin/common.css" type="text/css">
<link rel="stylesheet" href="{$RESOURCE}/skin/admin/style.css" type="text/css">
<script type="text/javascript" src="{$RESOURCE}/js/config.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/util.js"></script>
</head>
<body>
<script type="text/javascript">
var cache_action = "{$core->admin_controller}/core-cache";
var index_html_action = "{$core->admin_controller}/cms-index_to_html";
var index_html_m_action = "{$core->admin_controller}/cms-index_to_html";
var item_view_action = "{$core->admin_controller}/cms/item-view_to_html";
var item_list_action = "{$core->admin_controller}/cms/item-list_to_html";
var label_action = "{$core->admin_controller}/core/label-cache";
var category_action = "{$core->admin_controller}/cms/category-cache";
var special_html = "{$core->admin_controller}/core/special-view_to_html";
var _obj = new Date(
EOT;
echo P8_TIME;
print <<<EOT
000);
var _Y = _obj.getFullYear();
var _m = _obj.getMonth() +1;
var _d = _obj.getDate();
var _H = _obj.getHours();
var _j = _obj.getDay();
</script>
<div class="wrapper">
<div class="sites-top clearfix">
<div class="sites-top-left">
<div class="title">快捷导航</div>
</div>
<div class="sites-top-right">
<ul class="nav navbar-nav sites-nav" id="sites-nav">
<li class="dropdown">
<a href="{$core->admin_controller}/cms/item-add" target="_blank"><span><img src="{$RESOURCE}/skin/admin/icons/nav1.png"/></span>内容发布</a>
<ul class="dropdown-menu">
EOT;
$__t_foreach = @$models;
if(!empty($__t_foreach)){
foreach($__t_foreach as $model => $value){
if($value['enabled']){
print <<<EOT
									
<li><a href="{$core->admin_controller}/cms/item-add?model={$model}" target="_blank"><span class="arrow"></span>{$value[alias]}模型</a></li>
EOT;
}
}
}

print <<<EOT

</ul>
</li>
<li class="dropdown">
<a href="{$core->admin_controller}/cms/item-list" target="_blank"><span><img src="{$RESOURCE}/skin/admin/icons/nav2.png"/></span>内容与栏目</a>
<ul class="dropdown-menu">
<li><a href="{$core->admin_controller}/cms/item-list?cid=0" target="_blank"><span class="arrow"></span>全部内容</a></li>
<li><a href="{$core->admin_controller}/cms/item-list?verified=3" target="_blank"><span class="arrow"></span>待审核内容</a></li>
<li><a href="{$core->admin_controller}/cms/item-list?verified=88" target="_blank"><span class="arrow"></span>误删内容恢复</a></li>
<li><a href="{$core->admin_controller}/cms/category-list" target="_blank"><span class="arrow"></span>栏目管理</a></li>
<li><a href="{$core->admin_controller}/cms/category-recycle_list" target="_blank"><span class="arrow"></span>误删栏目恢复</a></li>
</ul>
</li>
<li class="dropdown">
<a href="{$core->admin_controller}/core-base_config" target="_blank"><span><img src="{$RESOURCE}/skin/admin/icons/nav3.png"/></span>可视化与设置</a>
<ul class="dropdown-menu">
<li><a href="{$core->admin_controller}/core-base_config" target="_blank"><span class="arrow"></span>基本设置</a></li>
<li><a href="{$core->admin_controller}/core-navigation_menu_list" target="_blank"><span class="arrow"></span>菜单设置</a></li> 
<li><a href="{$core->admin_controller}/core-global_config" target="_blank"><span class="arrow"></span>全局设置</a></li>
<li><a href="{$core->admin_controller}/core-static_config" target="_blank"><span class="arrow"></span>内容与资源配置</a></li>
<li><a href="{$core->admin_controller}/core-reg_config" target="_blank"><span class="arrow"></span>注册与登录配置</a></li>
<li><a href="
EOT;
if($core->controller){
print <<<EOT
{$core->controller}
EOT;
}else{
print <<<EOT
{$STATIC_URL}/index.php
EOT;
}
print <<<EOT
?edit_label=1" target="_blank" ><span class="arrow"></span>首页可视化</a></li>
<li><a href="{$core->admin_controller}/cms/category-list" target="main"><span class="arrow"></span>栏目可视化</a></li>
<li><a href="{$core->U_controller}/member-center?edit_label=1" target="_blank"><span class="arrow"></span>会员中心可视化</a></li>
<li><a href="{$core->controller}/letter-list?&edit_label=1" target="_blank"><span class="arrow"></span>信件列表可视化</a></li>
<li><a href="{$core->controller}/letter-progress?&edit_label=1" target="_blank"><span class="arrow"></span>信件查询可视化</a></li>
<li><a href="{$core->controller}/letter-post?&edit_label=1" target="_blank"><span class="arrow"></span>写信页面可视化</a></li>
</ul>
</li>
<li class="dropdown">
<a href="{$core->admin_controller}/core-cache" target="_blank"><span><img src="{$RESOURCE}/skin/admin/icons/nav4.png"/></span>更新站点</a>
<ul class="dropdown-menu">
<li><a href="{$core->admin_controller}/cms-index_to_html" target="_blank"><span class="arrow"></span>静态首页</a></li>
<li><a href="javascript:;" onclick="$('#list_to_html').submit()"><span class="arrow"></span>静态栏目</a></li>
<li><a href="javascript:;" onclick="$('#view_to_html').submit()"><span class="arrow"></span>静态最近内容 </a></li>
<li><a href="javascript:;" onclick="do_cache('base')"><span class="arrow"></span>更新基础缓存 </a></li>
<li><a href="javascript:;" onclick="do_cache('template')"><span class="arrow"></span>更新模板缓存</a></li>					
<li><a href="javascript:;" onclick="do_cache('label')"><span class="arrow"></span>更新标签缓存 </a></li>
<li><a href="javascript:;" onclick="do_cache('all')"><span class="arrow"></span>更新全站缓存</a></li>		
</ul>
</li>
<li class="dropdown">
<a href="{$core->U_controller}?site=mainstation" target="_blank"><span><img src="{$RESOURCE}/skin/admin/icons/nav5.png"/></span>会员中心</a>
<ul class="dropdown-menu">
<li><a href="{$core->U_controller}?site=mainstation" target="_blank"><span class="arrow"></span>主站会员中心</a></li>
<li><a href="{$core->U_controller}/member-mysites" target="_blank"><span class="arrow"></span>子站会员中心</a></li>
<li><a href="{$RESOURCE}/dl.html" target="_blank"><span class="arrow"></span>统一登陆入口</a></li>
</ul>
</li>
<li class="dropdown">
<a href="{$core->U_controller}/message-inbox" target="_blank"><span><img src="{$RESOURCE}/skin/admin/icons/nav6.png"/></span>信息与咨询</a>
<ul class="dropdown-menu">
<li><a href="{$core->U_controller}/message-inbox" target="_blank"><span class="arrow"></span>站内信列表</a></li>
<li><a href="{$core->U_controller}/message-inbox?type=new" target="_blank"><span class="arrow"></span>未处理的信息</a></li>
<li><a href="{$core->U_controller}/message-send" target="_blank"><span class="arrow"></span>我要写信息</a></li>
<li><a href="{$core->U_controller}/notify-list" target="_blank"><span class="arrow"></span>需签收的通知</a></li>
<li><a href="{$core->U_controller}/notify-add" target="_blank"><span class="arrow"></span>我要写通知</a></li>
<li><a href="{$core->U_controller}/letter-manager" target="_blank"><span class="arrow"></span>信件管理</a></li>
<li><a href="{$core->admin_controller}/core/forms-model" target="_blank"><span class="arrow"></span>表单类型管理</a></li>
<li><a href="{$core->admin_controller}/core/forms-list" target="_blank"><span class="arrow"></span>表单内容管理</a></li>

</ul>
</li>
</ul>
</div>
</div>
<div class="mainbox">
<table border="0" width="100%" cellpadding="0" cellspacing="0" >
<tr>
<td>
<table class="mintable fleft mbt15">
<tr>
<td>
<table class="formtable">
<tr>
<td>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="articletips">
<tr class="tips_title">
<td width="8%" class="tips_time">时间</td>
<td width="*" class="tips_title">最新已审核内容</td>
<td width="15%" class="tips_column">栏目</td>
<td width="12%" class="tips_author">录入者</td>
<td width="15%" class="tips_edit">操作</td>
</tr>
EOT;
$__t_foreach = @$listdb;
if(!empty($__t_foreach)){
foreach($__t_foreach as $val){
print <<<EOT

<tr>
<td align="center">
EOT;
echo date('m/d',$val['timestamp']);
print <<<EOT
</td>
<td class="main_link"><a href="$val[url]" target="_blank">&nbsp;{$val['title']}</a> </td>
<td class="main_link"><a href="$val[category_url]" target="_blank">&nbsp;{$val['category_name']}</a> </td>
<td align="center"><span title="$val[username]">
EOT;
echo p8_cutstr($val['username'],8);
print <<<EOT
</span></td>
<td align="center"><a href="$val[edit]" target="_blank">修改</a></td>
</tr>
EOT;
}
}

print <<<EOT

<tr>
<td align="right" colspan="5"><a href="{$core->admin_controller}/cms/item-list" target="_blank" class="submit_btn" style="color:#fff;">进入已审核内容</a></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
<table class="mintable fright mbt15">
<tr>
<td>
<table class="formtable">
<tr>
<td>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="articletips">
<tr class="tips_title">
<td width="8%" class="tips_time">时间</td>
<td width="*" class="tips_title">最新待审内容</td>
<td width="12%" class="tips_column">栏目</td>
<td width="12%" class="tips_author">状态</td>
<td width="12%" class="tips_author">录入者</td>
<td width="12%" class="tips_edit">操作</td>
</tr>
EOT;
$__t_foreach = @$listdb2;
if(!empty($__t_foreach)){
foreach($__t_foreach as $val){
print <<<EOT

<tr>
<td align="center">
EOT;
echo date('m/d',$val['timestamp']);
print <<<EOT
</td>
<td class="main_link"><a href="$val[url]" target="_blank">&nbsp;{$val['title']}</a> </td>
<td class="main_link"><a href="$val[category_url]" target="_blank">&nbsp;{$val['category_name']}</a> </td>
<td align="center"><font style="color:red;">未审</font></td>
<td align="center"><span title="$val[username]">
EOT;
echo p8_cutstr($val['username'],8);
print <<<EOT
</span></td>
<td align="center"><a href="$val[edit]" target="_blank">修改</a></td>
</tr>
EOT;
}
}

print <<<EOT

<tr>
<td align="right" colspan="5"><a href="{$core->admin_controller}/cms/item-list?cid=0&verified=3" target="_blank" class="submit_btn" style="color:#fff;">进入待审核内容</a></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</div>
<div class="statusList">
<div class="stsitem">
<div class="panel">
<div class="sico"><i class="ione"></i></div>
<div class="value">
<div class="vinfo">
<a href="{$core->admin_controller}/cms/item-list" target="_blank"><h1>{$countCmsToday['count']}/{$countCmsMonth['count']}条</h1>
<p>今日/本月主站内容</p></a>
</div>
</div>
</div>
</div>
<div class="stsitem">
<div class="panel">
<div class="sico"><i class="itwo"></i></div>
<div class="value">
<div class="vinfo">
<a href="{$core->admin_controller}/cms/item-list?cid=0&verified=3" target="_blank"><h1>{$countCmsUnverified['count']}条</h1>
<p>待审主站内容</p></a>
</div>
</div>
</div>
</div>
<div class="stsitem">
<div class="panel">
<div class="sico"><i class="ithree"></i></div>
<div class="value">
<div class="vinfo">
<a href="{$core->admin_controller}/sites-main" target="_blank"><h1>{$countSitesToday['count']}/{$countSitesMonth['count']}条</h1>
<p>今日/本月站群内容</p></a>
</div>
</div>
</div>
</div>
<div class="stsitem">
<div class="panel">
<div class="sico"><i class="ifour"></i></div>
<div class="value">
<div class="vinfo">
<a href="{$core->admin_controller}/sites-main?site=null&verified=3" target="_blank"><h1>{$countSitesUnverified['count']}条</h1>
<p>待审站群内容</p></a>
</div>
</div>
</div>
</div>
</div>
<div class="mainbox">
<table border="0" width="100%" cellpadding="0" cellspacing="0" >
<tr>
<td>
<table class="mintable mfoot fleft mbt15">
<tr>
<td>
<table border="0" cellpadding="0" cellspacing="0" class="formtable">
<tr>
<td>
<form method="POST" action="$this_url">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td class="tdL graybg">系统版本号:</td>
<td colspan="3" class="tdR">
国微CMS_{$core->CONFIG['build']}
</td>
</tr>
<tr>
<td class="tdL graybg">操作系统</td>
<td class="tdR">
EOT;
echo PHP_OS;
print <<<EOT

</td>
<td colspan="2" class="tdL" style="padding:5px;">当前域名：
EOT;
if($_SERVER['SERVER_PORT']=='80'){
print <<<EOT
$_SERVER[SERVER_NAME]
EOT;
}else{
print <<<EOT
$_SERVER[SERVER_NAME]:$_SERVER[SERVER_PORT]
EOT;
}
print <<<EOT
</td>
</tr>
<tr> 
<td class="tdL graybg">服务器端信息</td>
<td class="tdR">
$_SERVER[SERVER_SOFTWARE]
</td>
<td colspan="2" class="tdL" style="padding:5px;">系统安装路径：
EOT;
echo PHP168_PATH;
print <<<EOT
</td>
</tr>
<tr>
<td class="tdL graybg">程式版本</td>
<td colspan="3" class="tdR">
PHP 
EOT;
echo PHP_VERSION;
print <<<EOT
 / 
EOT;
echo $db_version;
print <<<EOT

</td>													
</tr>
<tr>
<td class="tdL graybg">磁盘容量(可用/剩余)</td>
<td colspan="3" class="tdR">{$disk_total}/{$disk_free}，可用率{$free_percentage}%</td>
</tr>
<tr>
<td class="tdL graybg">最大上传限制</td>
<td class="tdR">
EOT;
echo ini_get('upload_max_filesize');
print <<<EOT

</td>
<td colspan="2" class="tdL" style="padding:5px;">最大执行时间：
EOT;
echo ini_get('max_execution_time');
print <<<EOT
秒</td>													
</tr>
<tr>
<td class="tdL graybg">图像GD支持</td>
<td colspan="3" class="tdR">
EOT;
if(function_exists('imagecreate')){
print <<<EOT

是
EOT;
}else{
print <<<EOT

否
EOT;
}
print <<<EOT

</td>
</tr>
<tr>
<td class="tdL graybg">memcache</td>
<td class="tdR">
EOT;
if(class_exists('Memcache')){
print <<<EOT

是
EOT;
}else{
print <<<EOT

否
EOT;
}
print <<<EOT

</td>
<td colspan="2" class="tdL" style="padding:5px;">eAccelerator：
EOT;
if(extension_loaded('eaccelerator')){
print <<<EOT

是
EOT;
}else{
print <<<EOT

否
EOT;
}
print <<<EOT
</td>													
</tr>
<tr>
<td class="tdL graybg">ssi</td>
<td colspan="3" class="tdR">
EOT;
if($core->CONFIG['ssi']){
print <<<EOT

是
EOT;
}else{
print <<<EOT

否
EOT;
}
print <<<EOT

<input type="submit" name="detect_ssi" value="重新检测" />
</td>
</tr>
<tr>
<td class="tdL graybg">fileinfo</td>
<td colspan="3" class="tdR">
EOT;
if($fileinfo){
print <<<EOT

是
EOT;
}else{
print <<<EOT

否
EOT;
}
print <<<EOT

</td>
</tr>
</table>
</form>
</td>
</tr>
</table>
</td>
</tr>
</table>
<table class="mintable  mfoot fright mbt15">
<tr>
<td>
<table class="formtable">
<tr>
<td>
<div class="servertips">
<ul>
<li class="li1"><a href="{$core->admin_controller}/core/dbm-manage" target="_blank">数据备份</a></li>
<li class="li2"><a href="{$core->admin_controller}/core-plant" target="_blank"><i class="fa fa-signal"></i>电子大屏</a></li>
<li class="li3"><a href="{$core->admin_controller}/core-navigation_menu_list" target="_blank">主站菜单</a></li>
<li class="li7"><a href="{$core->admin_controller}/core/uploader-list" target="_blank">附件管理</a></li>
<li class="li8"><a href="{$core->admin_controller}/core-tables" target="_blank"><i class="fa fa-signal"></i>系统升级</a></li>
<li class="li9"><a href="{$core->admin_controller}/core/letter-config" target="_blank">信箱管理</a></li>
<li class="li4"><a href="{$core->admin_controller}/core-base_config" target="_blank">系统设置</a></li>
<li class="li5"><a href="{$core->admin_controller}/core-cache" target="_blank">系统缓存</a></li>
<li class="li6"><a href="{$core->admin_controller}/cms-html_all" target="_blank">内容静态</a></li>
</ul>
</div>
</td>
</tr>
</table>
</td>
</tr>
</table>
<div style="clear:both;">
</div>
</td>
</tr>
</table>
</div>
</div>
<div class="clear"></div>
<form id="list_to_html" action="{$core->admin_controller}/cms/item-list_to_html" method="post" target="_blank"></form>
<form id="view_to_html" action="{$core->admin_controller}/cms/item-view_to_html" method="post" target="_blank"></form>
<form id="cache" action="{$core->admin_controller}/core-cache" method="post" target="_blank">
<input type="hidden" name="type" id="cache_type" value="all" /> 
</form>
<script type="text/javascript">
function do_cache(cache_type){		
$('#cache_type').val(cache_type);
$('#cache').submit();
}
$(function () {
$(".dropdown").mouseover(function () {
$(this).addClass("open");
});
$(".dropdown").mouseleave(function(){
$(this).removeClass("open");
})
});
function cache_update(){
obj = $('#cacheform');
var selected = obj.children("select");
switch(selected.val()){

case 'template':
obj.attr('action',cache_action);
obj.find('type').attr('type','template');
obj.submit();
break;

case 'index': 
obj.attr('action',cache_action);
obj.find('type').attr('type','index');
obj.submit();
break;

case 'language':
obj.attr('action',cache_action);
obj.find('type').attr('type','language');
obj.submit();
break;

case 'system_module':
obj.attr('action',cache_action);
obj.find('type').attr('type','system_module');
obj.submit();
break;

case 'all':
obj.attr('action',cache_action);
obj.find('type').attr('type','');
obj.submit();
break;

case 'category-cache':
obj.attr('action',category_action);;
obj.find('type').attr('type','');
obj.submit();
break;

case 'label-cache':
obj.attr('action',label_action);;
obj.find('type').attr('type','');
obj.submit();
break;
}
}

function html_update(obj){
var selected = $(obj).children("select");
switch(selected.val()){

case 'index_to_html':
obj.action = index_html_action;
obj.type.value = 'index_to_html';
obj.submit();
break;

case 'index_to_m_html':
obj.action = index_html_m_action;
obj.type.value = 'index_to_m_html';
obj.submit();
break;

case 'all_item':
obj.action = item_view_action;
obj.type.value = '';
obj.submit();
break;

case 'all_item_time':
obj.action = item_view_action;
obj.type.value = '';
$(obj).children("#timer_begin").val(date('Y-m-d H:i:s', mktime(0, 0, 0, _m, _d, _Y)));
$(obj).children("#timer_end").val(date('Y-m-d H:i:s', mktime(0, 0, 0, _m, _d+1, _Y)));
obj.submit();
break;

case 'all_list':
obj.action = item_list_action;
obj.type.value = '';
obj.submit();
break;

case 'all_list_time':
obj.action = item_list_action;
obj.type.value = '';
$(obj).children("#timer_begin").val(date('Y-m-d H:i:s', mktime(0, 0, 0, _m, _d, _Y)));
$(obj).children("#timer_end").val(date('Y-m-d H:i:s', mktime(0, 0, 0, _m, _d+1, _Y)));
obj.submit();
break;

case 'all_special':
obj.action = special_html;
obj.type.value = 'all';
obj.submit();
break;
}
}
EOT;
if(isset($cache)){
print <<<EOT

var p8_dialog = new P8_Dialog({
title_text: '温馨提醒',
button: false,
width: 300,
height: 200,
show: function(){
showhtml = '<p style="text-align:center;color:red;font-size:16px;padding-top:10px;">你还没更新全站缓存<br><br><input type="button" value="马上更新缓存>>" class="header_r_btn" onclick="javascript:$(\\'#cacheform>select\\').val(\\'all\\');cache_update();"/></p>';
this.content.html(showhtml);
}
});
p8_dialog.show();
EOT;
}
if($free_percentage<15){
print <<<EOT

var p8_free_disk_dialog = new P8_Dialog({
title_text: '磁盘空间预警',
button: false,
width: 300,
height: 160,
show: function(){
showhtml = '<p style="text-align:center;color:red;font-size:16px;padding-top:20px;">当前磁盘剩余{$disk_free}，可用率{$free_percentage}%，请及时清理，防止系统出现异常！</p>';
this.content.html(showhtml);
}
});
p8_free_disk_dialog.show();
EOT;
}
print <<<EOT

</script>
<div class="footer">
<ul>
<li><a href="http://www.php168.net/html/aboutus.shtml" target="_blank">联系我们</a></li>
<li><a href="http://www.php168.net/html/ld.shtml" target="_blank">产品亮点</a></li>
<li class="footerweb"><a href="http://www.php168.net" target="_blank">官方网站</a></li>
</ul>
</div>
EOT;
if(isset($cache)){
print <<<EOT

<form name="cacheform" id= "cacheform" method="post" style="display:none;">
<select name="type">
<option value="template">模板缓存</option>
<option value="index">首页缓存</option>
<option value="language">语言包缓存</option>
<option value="system_module">模块缓存</option>
<option value="all">所有缓存</option>
<option value="category-cache">栏目缓存</option>
<option value="label-cache" selected>标签缓存</option>
</select>
<input type="button" value="执行" class="cachebtn" onclick="cache_update()"/>
</form>
EOT;
}
print <<<EOT
<div class="clear"></div>

</body>
</html>
EOT;
?>