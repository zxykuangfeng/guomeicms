<?php
defined('PHP168_PATH') or die();
?>
<?php
print <<<EOT
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<title>系统后台管理平台</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
<link href="{$RESOURCE}/skin/sites/common/css/bootstrap.min.css" type="text/css"  rel="stylesheet" >
<link rel="stylesheet" href="{$RESOURCE}/skin/admin/style.css" type="text/css">
<link rel="stylesheet" href="{$AWESOME}/skin/default/core/awesome4.7.0/css/font-awesome.min.css" type="text/css">
<script type="text/javascript" src="{$RESOURCE}/js/config.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/util.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/jq_validator.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/admin.js"></script>
<script type="text/javascript" src="{$RESOURCE}/skin/sites/common/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/lang/core/{$core->CONFIG['lang']}.js"></script>
EOT;
if($SYSTEM != 'core'){
print <<<EOT

<script type="text/javascript" src="{$RESOURCE}/js/lang/$SYSTEM/{$core->CONFIG['lang']}.js"></script>
EOT;
}
print <<<EOT


<script type="text/javascript">
P8CONFIG.admin_controller = '{$core->admin_controller}';
var P8_ROOT = '$P8_ROOT';
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
<script type="text/javascript">
$(document).ready(function(){
var localtionurl,localtionurltemp;
localtionurl = String(window.location);
if(localtionurl.indexOf("?") != 0){
localtionurltemp = localtionurl.split("?");
localtionurl = localtionurltemp[0];
}
$('.headerbtn_list li a').each(function(){  
if($($(this))[0].href==localtionurl){  
$(this).parent().addClass('active');  
}     
}); 
}); 
$(function () {
$(".dropdown").mouseover(function () {
$(this).addClass("open");
});
$(".dropdown").mouseleave(function(){
$(this).removeClass("open");
});
});
</script>
</head>
<body><script type="text/javascript" src="{$RESOURCE}/js/rcalendar.js"></script>
<div class="mainbox mainborder">
<div class="section">
<table class="formtable">
<tr>
<td class="headerbtn_list">
<ul>
<li><a href="{$core->admin_controller}/core-cache"><i class="fa fa-refresh"></i>一键更新网站缓存</a></li>
<li><a href="{$core->admin_controller}/cms-html_all"><i class="fa fa-wpforms"></i>一键静态网站内容</a></li>
</ul>
</td>
</tr>

</table>
</div>
</div>
<div class="mainbox mainborder">
<div class="section">
<table width="100%" border="0"  class="mainbox">
<tr>
<td>
<ul class="boxmenu">
<li class="btn-color1"><a href="{$core->admin_controller}/cms-html_all"><i class="icon icon-ico11"></i>主站快捷静态</a></li>
<li class="btn-color2"><a href="{$core->admin_controller}/cms/category-list" target="_blank"><i class="icon icon-ico15"></i>进入主站栏目静态</a></li>
<li class="btn-color3"><a href="{$core->admin_controller}/sites-index" target="_blank"><i class="icon icon-ico30"></i>子站静态</a></li>
</ul>
</td>
</tr>
</table>

<table class="columntable formtable">
<tr class="title fix_head">
<td colspan="2" class="title">生成HTML</td>
</tr>			
<form action="{$core->admin_controller}/cms-index_to_html" method="post" target="_blank">
<tbody>
<tr>
<td width="45%" align="right">
<input type="submit" class="html_btn" value="一键静态主站首页" onclick="this.form.type.value = 'index_to_html'" />
</td>
<td width="50%">&nbsp;&nbsp;此操作包括：首页静态、最近10篇内容静态、标签与模板缓存更新；</td>
</tr>
</tbody>
</form>

<form action="{$core->admin_controller}/{$this_system->name}/item-view_to_html" method="post">
<tbody>
<tr>
<td align="right" ><input class="html_btn" type="submit" value="一键静态主站60天内容" /></td>
<td>&nbsp;&nbsp;此操作包括：首页静态、最近60天内容静态、标签与模板缓存更新；</td>
</tr>
</tbody>
</form>

<form action="{$core->admin_controller}/{$this_system->name}/item-list_to_html" method="post">
<tbody>
<tr>
<td align="right" ><input class="html_btn" type="submit" value="一键静态主站栏目" /></td>
<td>&nbsp;&nbsp;此操作包括：首页静态、所有栏目静态、标签与模板缓存更新；</td>
</tr>
</tbody>
</form>

<form action="{$core->admin_controller}/{$this_system->name}/item-view_to_html" method="post">
<tbody>
<tr>
<td align="right" ><input class="html_btn" type="submit" value="一键静态某时间段内容" /></td>
<td>
<input type="text" class="txt" id="time1" name="time_range[]" onclick="rcalendar(this, 'full', _valid_time_range)" autocomplete="off" />
-
<input type="text" class="txt" id="time2" name="time_range[]" onclick="rcalendar(this, 'full', _valid_time_range)" autocomplete="off" />
<input type="button" value="1小时内" onclick="_set_time_range(mktime(_H, 0, 0, _m, _d, _Y), mktime(_H +1, 0, 0, _m, _d, _Y))" />
<input type="button" value="今天" onclick="_set_time_range(mktime(0, 0, 0, _m, _d, _Y), mktime(0, 0, 0, _m, _d +1, _Y))" />
<input type="button" value="近3天" onclick="_set_time_range(mktime(0, 0, 0, _m, _d -3, _Y), mktime(0, 0, 0, _m, _d, _Y))" />
<input type="button" value="本周" onclick="_set_time_range(mktime(0, 0, 0, _m, _d - _j, _Y), mktime(0, 0, 0, _m, _d + 7 - _j, _Y))" />
<input type="button" value="本月" onclick="_set_time_range(mktime(0, 0, 0, _m, 1, _Y), mktime(0, 0, 0, _m +1, 1, _Y));" />
<script type="text/javascript">
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

function _set_time_range(t1 ,t2){
$('#time1').val(date('Y-m-d H:i:s', t1));
$('#time2').val(date('Y-m-d H:i:s', t2));
}

function _valid_time_range(time, obj){
var time1 = $('#time1').val();
var time2 = $('#time2').val();
if(time2 && time1 >= time2){
$(obj).val('');
}
}
</script>
<span style="float:right;">&nbsp;&nbsp;此操作包括：首页静态、自定义时间段的内容静态、标签与模板缓存更新；</span>
</td>
</tr>
</tbody>
</form>

<form action="{$core->admin_controller}/{$this_system->name}/item-view_to_html" method="post">
<tbody>
<tr>
<td align="right" style="border-bottom:0;"><input class="html_btn" type="submit" value="一键静态ID段内容" /></td>
<td style="border-bottom:0;">
<input type="text" class="txt" name="id_range" size="50" />&nbsp;&nbsp;此操作包括：首页静态、ID段之间内容静态、标签与模板缓存更新；
</td>
</tr>
</tbody>
</form>
</table>
</div>

</div><div class="clear"></div>

</body>
</html>
EOT;
?>