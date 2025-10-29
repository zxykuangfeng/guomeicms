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
<body>
EOT;
isset($MODEL) || $MODEL = '';
print <<<EOT

<script type="text/javascript">
var MODEL = '$MODEL';
</script>
EOT;
if(!empty($MODEL)){
print <<<EOT

<div class="mainbox mainborder">
<div class="section">
<table class="formtable">
<tr>
<td class="title">{$P8LANG['operation']}</td>
</tr>
<tr>
<td class="headerbtn_list">
<ul>
<li><a href="{$core->admin_controller}/{$this_system->name}/model-manage?model=$MODEL"><i class="fa fa-cog"></i>{$P8LANG['manage']}</a></li>
<li><a href="$this_router-add?model=$MODEL" target="_blank"><i class="fa fa-check-square-o"></i>{$P8LANG['cms_item']['add']}</a></li>
EOT;
if($ACTION != 'list'){
print <<<EOT

<li><a href="$this_router-list?model=
EOT;
if(!empty($MODEL)){
print <<<EOT
$MODEL
EOT;
}
print <<<EOT
"><i class="fa fa-list-ul"></i>{$P8LANG['cms_item']['list']}</a></li>
EOT;
}
if($ACTION == 'list_addon'){
print <<<EOT

<li><a href="$this_router-addon?model=$MODEL&iid=$data[id]
EOT;
if(isset($verified)){
print <<<EOT
&verified=$verified
EOT;
}
print <<<EOT
"><i class="fa fa-plus-square"></i>{$P8LANG['cms_item']['addon']}</a></li>
EOT;
}
if($ACTION == 'addon' || $ACTION == 'update_addon'){
print <<<EOT

<li><a href="$this_router-list_addon?model=$MODEL&iid=$data[iid]
EOT;
if(isset($verified)){
print <<<EOT
&verified=$verified
EOT;
}
print <<<EOT
"><i class="fa fa-plus-square"></i>{$P8LANG['cms_item']['addon']}</a></li>
EOT;
}
print <<<EOT

</ul>
</td>
</tr>
</table>
</div>
</div>
EOT;
}
print <<<EOT

<div class="mainbox mainborder">
<div class="section">
<table class="formtable">
<tr>
<td class="headerbtn_list">
<ul>
<li class="li2"><a href="{$core->admin_controller}/$SYSTEM/item-list" class="btn2"><i class="fa fa-list-ul"></i>{$P8LANG['cms_manage']}</a></li>
<li class="li5"><a href="{$core->admin_controller}/$SYSTEM/category-list" class="btn5"><i class="fa fa-sitemap"></i>{$P8LANG['cms_list_manage']}</a></li>						
<li class="li3"><a href="{$core->admin_controller}/$SYSTEM/item-comment" class="btn2"><i class="fa fa-list-ul"></i>{$P8LANG['cms_comment']}</a></li>					
<li class="li4"><a href="{$core->admin_controller}/$SYSTEM/category-recycle_list" class="btn4"><i class="fa fa-bitbucket"></i>{$P8LANG['cms_recycle_manage']}</a></li>
<li class="li5"><a href="{$core->admin_controller}/$SYSTEM/item-config" class="btn4"><i class="fa fa-cog"></i>{$P8LANG['cms_item_config']}</a></li>	
<li class="li6"><a href="{$core->admin_controller}/core-navigation_menu_list" class="btn4" target="_blank"><i class="fa fa-cog"></i>菜单设置</a></li>	
EOT;
if($ACTION == 'list_addon'){
print <<<EOT

<li><a href="$this_router-addon?model=$MODEL&iid=$data[id]
EOT;
if(isset($verified)){
print <<<EOT
&verified=$verified
EOT;
}
print <<<EOT
"><i class="fa fa-plus-square"></i>{$P8LANG['cms_item']['addon']}</a></li>
EOT;
}
print <<<EOT
						
</ul>
</td>
</tr>
</table>
</div>
</div><div class="mainbox mainborder">
<div class="section">
<table width="100%" border="0"  class="mainbox">
<tr>
<td>
<ul class="boxmenu">
<li class="btn-color1"><a href="{$core->admin_controller}/cms/item-add"><i class="icon icon-ico45"></i>主站内容后台发布</a></li>
<li class="btn-color2"><a href="{$core->U_controller}?site=mainstation" target="_blank"><i class="icon icon-ico45"></i>主站内容会员中心发布</a></li>
<li class="btn-color3"><a href="{$core->U_controller}/member-mysites" target="_blank"><i class="icon icon-ico45"></i>子站内容发布</a></li>
</ul>
</td>
</tr>
</table>
<table width="100%" align="center" class="columntable formtable hover_table">
<tr class="title fix_head">
<td class="title">名称</td>
<td class="title">操作</td>
</tr>
EOT;
$__t_foreach = @$models;
if(!empty($__t_foreach)){
foreach($__t_foreach as $k => $v){
if(empty($v['enabled'])) continue;
print <<<EOT

<tr>
<td><img src="{$SKIN}/icon_arrow.png" />{$v['alias']}</td>
<td><a class="release" href="$this_router-add?model=$k" target="_blank"/>发布+</a></td>
</tr>
EOT;
}
}

print <<<EOT

</table>
</div>
</div>
<script type="text/javascript">
$('.headerbtn_list li').removeClass();
$(".headerbtn_list li:first-child").addClass("active");
</script><div class="clear"></div>

</body>
</html>
EOT;
?>