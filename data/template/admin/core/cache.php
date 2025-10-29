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
<body><div class="mainbox mainborder">
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
<form action="$this_url" method="POST" id="cache">
<div class="mainbox mainborder">
<div class="section">
<table width="100%" border="0"  class="mainbox">
<tr>
<td>
<ul class="boxmenu">
<li class="btn-color1"><a href="{$core->admin_controller}/core-cache"><i class="icon icon-ico44"></i>更新网站缓存</a></li>
<li class="btn-color5"><input type="submit" value="{$P8LANG['cache_unlock']}" onclick="this.form.type.value='unlock'" class="cache-btn" /></li>
</ul>
</td>
</tr>
</table>

<table class="columntable formtable">
<tr class="title fix_head">
<td class="title">{$P8LANG['update_all_cache']}</td>
</tr>
<tr>
<td class="headerbtn_list" align="center" style="border-bottom:0;">
<input type="submit" value="{$P8LANG['cache_all']}" class="cache_btn cache_one" />
<span class="ab_c">点击此处可以更新网站的全部缓存操作</span>
</td>
</tr>
</table>
</div>
</div>
<div class="mainbox mainborder">
<div class="section">
<table class="columntable formtable">
<tr class="title fix_head">
<td class="title">{$P8LANG['update_choice_cache']}</td>
</tr>

<tr>
<td class="headerbtn_list" align="center" style="border-bottom:0;">
<p><input type="submit" value="{$P8LANG['cache_index']}" class="cache_btn2" onclick="do_cache('base')" size="30"/><span class="ab_c">{$P8LANG['cache_note_3']}</span> </p>
<p><input type="submit" value="{$P8LANG['cache_system_module']}" class="cache_btn2" onclick="do_cache('system_module')" /></p> 
<p><input type="submit" value="{$P8LANG['cache_label']}" class="cache_btn2" onclick="do_cache('label')" size="30"/><span class="ab_c">{$P8LANG['cache_note_2']}</span></p>
<p><input type="submit" value="{$P8LANG['cache_template']}" class="cache_btn2" onclick="do_cache('template')" size="30"/> <span class="ab_c">{$P8LANG['cache_note_4']}</span></p>
<p><input type="submit" value="{$P8LANG['cache_menu']}" class="cache_btn2" onclick="do_cache('menu')" size="30"/> <span class="ab_c">{$P8LANG['cache_note_5']}</span></p>					
<p><input type="button" value="{$P8LANG['clear_page_cache']}" class="cache_btn2" onclick="ajaxing({'text':'缓存中…'});window.location.href = '{$core->admin_controller}/core/role-cache'" /><span class="ab_c">{$P8LANG['cache_note_1']}</span></p>
EOT;
if($sites_enable){
print <<<EOT

<p><input type="button" value="{$P8LANG['cache_sites']}" class="cache_btn2" onclick="ajaxing({'text':'缓存中…'});window.location.href = '{$core->admin_controller}/sites/farm-cache'" /><span class="ab_c">{$P8LANG['cache_note_6']}</span></p>
EOT;
}
print <<<EOT

<input type="hidden" name="type" id="cache_type" value="all" /> </td>
</tr>
</table>
</div>
</div>
</form>
<script type="text/javascript">
function do_cache(cache_type){		
$('#cache_type').val(cache_type);
//ajaxing({'text':'缓存中…'});
$('#cache').submit();	
}
</script><div class="clear"></div>

</body>
</html>
EOT;
?>