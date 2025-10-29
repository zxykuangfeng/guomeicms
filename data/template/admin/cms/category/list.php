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
</div><script type="text/javascript" src="{$RESOURCE}/js/autocomplete.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/recursive_selector.js"></script>
<link rel="stylesheet" href="{$SKIN}/cms/category_selector.css" type="text/css" />
<style type="text/css">
body, html{overflow:inherit;}
.field{
border: 1px solid #CCCCCC;
padding: 10px;
margin: 1em;
}

.field legend{
font-size:14px;
border: 1px solid #CCCCCC;
padding: 2px 4px;
margin-bottom:0;
}
</style>

<div style="display: none;">
<input type="text" id="srh" size="30" />
</div>

<form action="$this_url" method="post" id="form">
<div class="mainbox mainborder">
<div class="section">
<table width="100%" border="0"  class="mainbox">
<tr>
<td>
<ul class="boxmenu">
<li class="btn-color1 dropdown">
<a class="dropdown-toggle" href="{$core->admin_controller}/$SYSTEM/category-add" target="_blank"><i class="icon icon-ico44"></i>{$P8LANG['cms_list_add']}</a>			
<ul class="dropdown-menu">
EOT;
$count=1;
$__t_foreach = @$this_system->models;
if(!empty($__t_foreach)){
foreach($__t_foreach as $model => $value){
if($value['enabled']){
print <<<EOT

<li class="btn-color{$count}"><a href="{$core->admin_controller}/$SYSTEM/category-add?parent=0&model={$model}" target="_blank"><i class="icon icon-ico55"></i>{$value[alias]}</a></li>
EOT;
$count++;
}
}
}

print <<<EOT

</ul>
</li>
<li class="btn-color3"><a href="javascript:;" onclick="clone_cate(checked_values('id[]', $('#form')))"><i class="icon icon-ico48"></i>复制栏目</a></li>
<li class="btn-color2"><a href="javascript:;" onclick="update_category(checked_values('id[]', $('#form')))"><i class="icon icon-ico45"></i>编辑栏目</a></li>
<li class="btn-color10"><a href="javascript:;" onclick="recycle_category(checked_values('id[]', $('#form')))"><i class="icon icon-ico46"></i>删除栏目</a></li>
<li class="btn-color11"><a href="javascript:;" onclick="merge(checked_values('id[]', $('#form')))"><i class="icon icon-ico49"></i>合并栏目</a></li>
<li class="btn-color12"><a href="javascript:;" onclick="label_category(checked_values('id[]', $('#form')))"><i class="icon icon-ico45"></i>栏目可视化</a></li>
<li class="btn-color13"><a href="javascript:;" onclick="label_view(checked_values('id[]', $('#form')))"><i class="icon icon-ico45"></i>内容可视化</a></li>
<li class="btn-color16"><a href="javascript:;" onclick="view_category(checked_values('id[]', $('#form')))"><i class="icon icon-ico51"></i>查看动态</a></li>
<!--li class="btn-color17"><a href="javascript:;" onclick="view_category_html(checked_values('id[]', $('#form')))"><i class="icon icon-ico51"></i>查看静态</a></li-->
<li class="course pull-right"><a href="{$RESOURCE}/attachment/jiaocheng/zhuzhanlanmu.pdf" target="_blank" style="color:#c00;"><img src="{$RESOURCE}/skin/admin/help_icon.gif" class="helpicon" style="margin-right:5px;">栏目教程>></a></li>
<li class="btn-color9 dropdown">
<a class="dropdown-toggle" href="{$core->admin_controller}/$SYSTEM/item-add" target="_blank"><i class="icon icon-ico9"></i>发布内容</a>
<ul class="dropdown-menu">
EOT;
$count=1;
$__t_foreach = @$this_system->models;
if(!empty($__t_foreach)){
foreach($__t_foreach as $model => $value){
if($value['enabled']){
print <<<EOT

<li class="btn-color{$count}"><a href="{$core->admin_controller}/$SYSTEM/item-add?model={$model}"  target="_blank"><i class="icon icon-ico55"></i>{$value[alias]}</a></li>
EOT;
$count++;
}
}
}

print <<<EOT

</ul>
</li>
</ul>
</td>
</tr>
</table>
<table class="columntable formtable hover_table click_changeable">
<tr class="title fix_head">
<td width="1%" class="title" align="center"><input type="checkbox" onclick="check_all(this, 'id[]', $('#form'));" /></td>
<td width="2%" class="title" align="center">ID</td>
<td width="5%" class="title" align="left" title="0" onclick="if(this.title == 1){this.title=0;hide_all();$(this).find('span img').attr('src', '{$SKIN}/show.gif');}else{this.title=1;show_all();$(this).find('span img').attr('src', '{$SKIN}/hide.gif');}" style="cursor: pointer;"><span><img src="{$SKIN}/show.gif" /></span>（可展开）{$P8LANG['cms_category_name']}</td>
<td width="3%" class="title" align="center">{$P8LANG['cms_category_model']}</td>
<td width="3%" class="title" align="center">{$P8LANG['cms_category_type']}</td>
<td width="1%" class="title" align="center">{$P8LANG['htmlize']}</td>
<td width="3%" class="title" align="center">{$P8LANG['cms_category_item_count']}</td>
<td width="3%" class="title" align="center">{$P8LANG['views']}</td>
<td width="1%" class="title" align="center">{$P8LANG['menu_display']}</td>
<td width="1%" class="title" align="center">{$P8LANG['cms_category_order']}</td>
<td width="17%" class="title" align="center">{$P8LANG['operation']}</td>
</tr>

<tbody id="__">

</tbody>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="foot_btn">
<tr>
<td>
<ul class="column-operation celarfix">
<li><input type="button" value="{$P8LANG['update_cache']}" onclick="_submit('cache')" class="edit_btn" /></li>			
<li><input type="submit" value="{$P8LANG['cms_category_update_order']}" class="edit_btn" /></li>
<li><input type="button" value="{$P8LANG['cms_category_fix']}" onclick="_submit('fix')" class="edit_btn" /></li>
<li class="dropdown">
<a class="edit_btn">静态网站</a>
<ul class="dropdown-menu">
<li><input type="button" value="{$P8LANG['cms_html_content']}" onclick="view_to_html()" class="edit_btn" /></li>
<li><input type="button" value="{$P8LANG['cms_html_category']}" onclick="list_only_html()" class="edit_btn" /></li>
<li>
EOT;
if(empty($item_config['menu_cms_html_all'])){
print <<<EOT
				
<input type="button" value="{$P8LANG['cms_html_all']}" onclick="list_to_html()" class="edit_btn" />
EOT;
}
print <<<EOT
</li>
<li><input type="button" value="{$P8LANG['cms_html_mobile']}" onclick="mobile_to_html()" class="edit_btn" /></li>
</ul>
</li>
<li class="dropdown">
<a class="edit_btn">开启网站静态</a>
<ul class="dropdown-menu">
<li>
EOT;
if(empty($item_config['menu_cms_set_htmlize'])){
print <<<EOT

<input type="button" value="{$P8LANG['cms_set_htmlize']}" onclick="_submit('htmlize')" class="edit_btn" />
EOT;
}
print <<<EOT
</li>
<li>
EOT;
if(empty($item_config['menu_cms_conten_htmlize'])){
print <<<EOT

<input type="button" value="{$P8LANG['cms_conten_htmlize']}" onclick="_submit('conten_htmlize')" class="edit_btn" />
EOT;
}
print <<<EOT
</li>
</ul>
</li>
<li class="dropdown">
<a class="edit_btn">关闭网站静态</a>
<ul class="dropdown-menu">
<li>
EOT;
if(empty($item_config['menu_cms_set_unhtmlize'])){
print <<<EOT

<input type="button" value="{$P8LANG['cms_set_unhtmlize']}" onclick="_submit('unhtmlize')" class="edit_btn" />
EOT;
}
print <<<EOT
</li>
<li>
EOT;
if(empty($item_config['menu_cms_conten_unhtmlize'])){
print <<<EOT

<input type="button" value="{$P8LANG['cms_conten_unhtmlize']}" onclick="_submit('conten_unhtmlize')" class="edit_btn" />
EOT;
}
print <<<EOT
</li>
</ul>
</li>
<li class="dropdown">
<a class="edit_btn">{$P8LANG['cms_content_setlan']}</a>
<ul class="dropdown-menu">
<input type="button" value="{$P8LANG['cms_content_setlan']}" onclick="content_setlan(checked_values('id[]', $('#form')),'content_lan')" class="edit_btn" />
<input type="button" value="{$P8LANG['cms_content_setlan_limit']}" onclick="content_setlan(checked_values('id[]', $('#form')),'content_lan_limit')" class="edit_btn" />
</ul>
</li>
<li><input type="button" value="{$P8LANG['cms_content_setunlan']}" onclick="content_setlan(checked_values('id[]', $('#form')),'content_unlan')" class="edit_btn" /></li>
</ul>
</td>
</tr>
</table>
</div>
</div>

<input type="hidden" name="action" value="" />
</form>

<div id="status">
<fieldset class="field" id="shower">
<legend>列表页</legend>
<iframe name="shower" width="100%" height="120" marginheight="0" marginheight="0" frameborder="0"></iframe>
</fieldset>

<fieldset class="field" id="shower2">
<legend>内容页</legend>
<iframe name="shower2" width="100%" height="120" marginheight="0" marginheight="0" frameborder="0"></iframe>
</fieldset>
</div>

<form id="mobile_to_html" action="{$core->admin_controller}/$SYSTEM/item-list_to_html" method="post" target="shower">
</form>
<form id="list_to_html" action="{$core->admin_controller}/$SYSTEM/item-list_to_html" method="post" target="shower">
</form>
<form id="view_to_html" action="{$core->admin_controller}/$SYSTEM/item-view_to_html" method="post" target="shower2">
</form>
<form id="list_only_html" action="{$core->admin_controller}/$SYSTEM/item-list_to_html" method="post" target="shower">
</form>
<iframe name="poster" src="about:blank" style="display: none;"></iframe>
<iframe name="index_to_html" src="about:blank" style="display: none;"></iframe>
<script type="text/javascript">
var CATEGORY_JSON = $json[json];
var CATEGORY_PATH = $json[path];
var MODEL_JSON = $json[models];
var my_category = $my_category;
var CATEGORY_SUMS = $json[sums];
var CATEGOYR_HTML = [];
var LAN_DATE = $item_config[lan_date];

function _submit(action){
//if(!confirm('$P8LANG[confirm_to_selected]')) return;
p8_window.confirm('{$P8LANG['confirm_to_selected']}', function (r) {
if(r){
ajaxing({text:'处理中...'});
$('#form input[name=action]').val(action);
$('#form').submit();
}else{
return;
}
});
}

function content_setlan(cid,action){
var id = [];
$.each(cid, function(k, v){
id.push(v.replace(/[^0-9]/g, ''));
});
if(!id.length) return false;
if(action == 'content_lan_limit' && LAN_DATE == 0){
p8_window.alert('超年限时间节点必须设置 <a href="{$this_router}/../item-set_lan" style="color:blue;" target="_blank">去设置</a>');
return false;
}
p8_window.confirm('{$P8LANG['confirm_to_do']}', function (r) {
if(r){			
$.ajax({
url: '$this_url',
type: 'POST',
dataType: 'json',
data: ajax_parameters({action: action, cid: id}),
cache: false,
beforeSend: function(){
ajaxing({});
},
success: function(json){

ajaxing({action: 'hide'});
$('#form input[name=action]').val('fix');
$('#form').submit();
}
});
}
});

return false;
}

function show_all(){
$('#__ tr').each(function(){
var tr = $(this).show();

if(tr.attr('sub')){
tr.attr('title', 1).find('td:eq(2) span').html('<img src="{$SKIN}/hide.gif" />');
}
});
}

function hide_all(){
$('#__ tr').each(function(){
var tr = $(this);

if(tr.attr('sub')){
tr.attr('title', 0).find('td:eq(2) span').html('<img src="{$SKIN}/show.gif" />');
}

if(tr.attr('level') != 1) tr.hide().attr('title', 1);
});
}

function ___(json, l, p){
l = l === undefined ? 0 : l;
p = p === undefined ? 0 : p;

var j = 0, k = count(json);

for(var i in json){
if(!my_category || my_category[0] || my_category[json[i].id]){
if(json[i].htmlize >0) {
CATEGOYR_HTML.push("h_"+json[i].id);
}
var html = '';
j++;
var c = '';
if(l != 0){
c += str_repeat('│&nbsp;&nbsp;', l - p) + str_repeat('&nbsp;&nbsp;&nbsp;', p);
if(j == k){
p++;
c += '└';
}else{
c += '├';
}
}
var sub = json[i].categories ? true : false;
var path = CATEGORY_PATH[json[i].id].join('_');
c += (json[i].categories ? '<span style="cursor: pointer;"><img src="{$SKIN}/hide.gif" /></span> ' : '') +
'<a href="{$core->admin_controller}/$SYSTEM/item-list?model='+ (json[i].categories ? json[i].model : '') +'&cid='+ json[i].id +'" target="_blank">'+ json[i].name +'</a>';

html +=
'<tr id="category_'+ json[i].id +'" path="path_'+ path +'" title="1"'+ (sub ? ' sub="1"' : '') +' level="'+ (l +1) +'">'+
'<td align="center"><input type="checkbox" name="id[]" value="'+ json[i].id +'" onclick="_check(\\''+ path +'\\', this.checked)" /></td>'+
'<td align="center">'+ json[i].id +'</td>'+
'<td class="c_name" model="'+ json[i].model +'">'+ c +'</td>'+
'<td align="center"><a href="###" onclick="filter_model(\\''+ json[i].model +'\\')">'+ (json[i].type==3?'none':MODEL_JSON[json[i].model].alias) +'</a></td>'+
'<td align="center">'+ (json[i].type == 1 ? '{$P8LANG['cms_category_type_1_s']}' : json[i].type == 2? '{$P8LANG['cms_category_type_2_s']}':json[i].type == 3? '{$P8LANG['cms_category_type_3_s']}':'{$P8LANG['cms_category_type_4_s']}') +'</td>'+
'<td align="center" class="enables"><img id="cate_'+json[i].id+'" title="'+json[i].htmlize+'" src="{$SKIN}/'+ (json[i].htmlize == 1 ? 'check_yes.gif' : (json[i].htmlize == 2?'check_2.gif':'check_no.gif')) +'"></td>'+
'<td align="center">'+ json[i].item_count +'</td>'+
'<td align="center">'+ CATEGORY_SUMS[json[i].id] +'</td>'+
'<td align="center"><img src="{$SKIN}/'+ (json[i].enable_show == 1 ? 'display_no.gif' : 'display_yes.gif') +'"></td>'+
'<td align="center"><input type="text" class="txt" name="display_order['+ json[i].id +']" value="'+ json[i].display_order +'" size="4" /></td>'+
'<td align="center" class="columntd">'+
'<ul class="columntd-nav">'+
'<li><a href="'+ json[i].url +'" target="_blank" title="静态预览"><img id="category_html_'+json[i].id+'" src="{$SKIN}/icon_view.gif" /></a></li> '+
'<li><a href="'+(json[i].type==3?json[i].url:'{$this_system->modules['item']['controller']}-list-category-'+ json[i].id )+'" target="_blank" title="动态预览"><img src="{$SKIN}/icon_view2.gif" /></a></li> '+
'<li><a href="'+(json[i].type==3?json[i].url:'{$core->murl}/index.php/cms/item-list-category-'+ json[i].id )+'" target="_blank" title="手机版预览"><img src="{$SKIN}/icon_phone.gif" /></a></li> '+
'<li><a href="$this_router-update?model=&id='+ json[i].id +'" title="编辑修改栏目" target="_blank"><img src="{$SKIN}/button_edit2.gif" /></a></li> '+
'<li><a href="{$core->admin_controller}/$SYSTEM/item-add?model='+ json[i].model +'&cid='+ json[i].id +'&type='+json[i].type+'" target="_blank" title="{$P8LANG['add_cms_item']}"><img src="{$SKIN}/post_icon.gif" /></a></li> '+
'<li><a href="$this_router-add?parent='+ json[i].id +'&model='+json[i].model+'" title="{$P8LANG['add_cms_sub_category']}" target="_blank"><img src="{$SKIN}/icon_add2.gif" /></a></li> '+
'<li><a href="{$core->controller}/$SYSTEM/item-list-category-'+ json[i].id +'?edit_label=1" target="_blank" title="{$P8LANG['label']}"><img src="{$SKIN}/icon_updatalabel.gif" /></a></li> '+
'<li><a href="{$core->controller}/$SYSTEM/item-view-id-?edit_label=1" target="_blank" onclick="edit_view_label('+json[i].type+','+json[i].id+');return(false)" title="{$P8LANG['cms_category_view_page_label']}"><img id="edit_view_label_'+json[i].id+'" src="{$SKIN}/html.gif" /></a></li> '+
'<li><a href="###" title="{$P8LANG['cms_category_merge']}" onclick="merge('+ json[i].id +');"><img src="{$SKIN}/plub.gif" /></a></li> '+
'<li><a href="###" title="{$P8LANG['cms_category_clone']}" onclick="clone_cate('+ json[i].id +');"><img src="{$SKIN}/fach.gif" /></a></li> '+
'<li><a id="recycle_'+ json[i].id +'" href="javascript:;" onclick="return recycle_category([this.id]);" title="{$P8LANG['recycle']}"><img src="{$SKIN}/icon_recycle.gif" /></a></li> '+
'<li class="dropdown">'+
'<a><img src="{$SKIN}/icon_more.png" /></a>'+
'<ul class="dropdown-menu">'+
'<li class="btn-color1"><a href="{$core->admin_controller}/core/member-set_member_acl" target="_blank" title="栏目权限" class="ys1"><i class="icon icon-ico55"></i><span>栏目权限</span></a></li> '+
'</ul>'+
'</li>'+
'</ul>'+
'</td>'+
'</tr>';

var tr = $(html);
$('#__').append(tr);
if(sub){
___(json[i].categories, l +1, p);
_toggle(
$(tr).find('td:eq(2) span').
bind('click', function(){_toggle($(this)); return false;})
);
}
}
}
}

___(CATEGORY_JSON);


function _toggle(span){
var id = $(span).parent().parent().attr('id').replace(/[^0-9]/g, '');
var path = CATEGORY_PATH[id].join('_');

var on = $('#category_'+ id).attr('title') == 0;

var keep_close = [];
$('tr[path^=path_'+ path +'_]').each(function(){
if(on){

if($(this).show().attr('title') == 1 && $(this).attr('sub')){
keep_close.push(this.id.replace(/[^0-9]/g, ''));
$(this).attr('title', 0);
}else{
$(this).attr('title', 1);
}

}else{

if($(this).hide().attr('title') == 0 && $(this).attr('sub')){
//keep close
$(this).attr('title', 1);
}else{
$(this).attr('title', 0);
}

}
});

if(on){
$(span).parent().parent().attr('title', 1);
$(span).html('<img src="{$SKIN}/hide.gif" />');
}else{
$(span).parent().parent().attr('title', 0);
$(span).html('<img src="{$SKIN}/show.gif" />');
}

for(var i = 0; i < keep_close.length; i++){
$('tr[path^=path_'+ CATEGORY_PATH[keep_close[i]].join('_') +'_]').hide().find('span');
}
return false;
}
function find_category(json,find_id){
var category_name = '';

for(var i in json){
if(json[i].id == find_id){
category_name = json[i].name;
return category_name;
}else{
if(json[i].categories){
category_name = find_category(json[i].categories,find_id);
if(category_name) return category_name;
}
}
}
return category_name;
};

function recycle_category(array){

var id = [];
$.each(array, function(k, v){
id.push(v.replace(/[^0-9]/g, ''));
});
if(!id.length) {
p8_window.alert('{$P8LANG[cms_category_need_select]}');
return;
}
var category_name = '';
var confirm_info = '{$P8LANG['cms_category_confirm_to_recycle']}';
if(id.length == 1){
category_name = find_category(CATEGORY_JSON,id[0]);
confirm_info = '{$P8LANG['cms_category_confirm_to_recycle']}<br><span style="color:blue;text-align:centet;">'+category_name+'(ID：'+id[0]+')</span>';
}
p8_window.confirm(confirm_info, function (r) {
if(r){			
$.ajax({
url: '$this_router-recycle',
type: 'POST',
dataType: 'json',
data: ajax_parameters({model: '$MODEL', id: id}),
cache: false,
beforeSend: function(){
ajaxing({});
},
success: function(json){

ajaxing({action: 'hide'});

for(var i in json){
$('#recycle_'+ json[i]).parent().parent().remove();
}
}
});
}
});

return false;
}

function filter_model(m){
$('#__ td.c_name[model='+ m +']').attr('style', '');
$('#__ td.c_name[model!='+ m +']').attr('style', 'filter: alpha(opacity=40); opacity: 0.4;');
}

$('form input[name^=display_order]').change(function(){
this.value = this.value.replace(/[^0-9]/g, '') || 0;
if(this.value > 9999) this.value = 9999;
if(this.value < 0) this.value = 0;

$('#form').append('<input type="hidden" name="_display_order['+ this.name.replace(/[^0-9]/g, '') +']" value="'+ this.value +'" />');
$(this).css({border: '1px solid #ff0000'});
});

function get_category_by_id(id){
var path = clone(CATEGORY_PATH[id]);
var root = path.shift();
var search = CATEGORY_JSON[root];

if(path.length == 0){
return search;
}
for(var i in path){
search = search.categories[path[i]];
}
return search;
}

function edit_view_label(b,id){
if(b == '1'){
p8_window.alert('{$P8LANG['cms_category_type_1_no_item_label']}');
return;
}

$.ajax({
url: '$this_router-edit_view_label',
type: 'POST',
dataType: 'html',
data: 'cid='+id,
cache: false,
beforeSend: function(){
ajaxing({});
},
success: function(json){
ajaxing({action: 'hide'});
if(json=='-1'){p8_window.alert('{$P8LANG['cms_category_no_item_yet']}');return;}
openUrl("{$core->controller}/{$SYSTEM}/item-view-id-"+json+"?edit_label=1&postfix=");
}
});
}

function _check(path, checked){
$('#form tr[path^=path_'+ path +'_] input[name="id[]"]').attr('checked', checked);
}

function list_to_html(){
if(CATEGOYR_HTML.length<1){
p8_window.alert('{$P8LANG[cms_category_htmlize]}');
return;
}
$('#list_to_html').empty();
$('#view_to_html').empty();
var ids = checked_values('id[]', $('#form'));
if(!ids.length){
check_all(true, 'id[]');
ids = checked_values('id[]', $('#form'));		
}	
var pages = 0;
var items = -1;
var htmlize_index = -1;
$('#list_to_html').append($('<input type="hidden" name="pages" value="'+ pages +'" />'));
for(var i = 0; i < ids.length; i++){
$('#list_to_html').append($('<input type="hidden" name="cids[]" value="'+ ids[i] +'" />'));
if($.inArray("h_"+ids[i],CATEGOYR_HTML) >=0){
htmlize_index = 1;
}
}
if(htmlize_index == 1){
$('#list_to_html').submit();
html_dialog.show();
}else{
p8_window.alert('{$P8LANG[cms_category_htmlize]}');
return;
}
if(items != 0){
$('#view_to_html').append($('<input type="hidden" name="items" value="'+ items +'" />'));
for(var i = 0; i < ids.length; i++){
$('#view_to_html').append($('<input type="hidden" name="cids[]" value="'+ ids[i] +'" />'));
}

$('#view_to_html').submit();		
}
//静态首页
window.open('{$this_system->admin_controller}-index_to_html','index_to_html');
}

function mobile_to_html(){
if(CATEGOYR_HTML.length<1){
p8_window.alert('{$P8LANG[cms_category_htmlize]}');
return;
}
$('#mobile_to_html').empty();
$('#view_to_html').empty();

var ids = checked_values('id[]', $('#form'));
if(!ids.length){
p8_window.alert('{$P8LANG[cms_category_htmlize]}');
return;
}	
var pages = 0;
var items = -1;
var htmlize_index = -1;
$('#mobile_to_html').append($('<input type="hidden" name="pages" value="'+ pages +'" />'));
for(var i = 0; i < ids.length; i++){
$('#mobile_to_html').append($('<input type="hidden" name="cids[]" value="'+ ids[i] +'" />'));
if($.inArray("h_"+ids[i],CATEGOYR_HTML) >=0){
htmlize_index = 1;
}
}
$('#mobile_to_html').append($('<input type="hidden" name="mobile" value="1" />'));
if(htmlize_index == 1){
$('#mobile_to_html').submit();
html_dialog.show();
}else{
p8_window.alert('{$P8LANG[cms_category_htmlize]}');
return;
}
if(items != 0){
$('#view_to_html').append($('<input type="hidden" name="items" value="'+ items +'" />'));
for(var i = 0; i < ids.length; i++){
$('#view_to_html').append($('<input type="hidden" name="cids[]" value="'+ ids[i] +'" />'));
}
$('#view_to_html').append($('<input type="hidden" name="mobile" value="1" />'));
$('#view_to_html').submit();		
}
}

function list_only_html(){
if(CATEGOYR_HTML.length<1){
p8_window.alert('{$P8LANG[cms_category_htmlize]}');
return;
}
$('#list_only_html').empty();
var ids = checked_values('id[]', $('#form'));
if(!ids.length){
p8_window.alert('{$P8LANG[cms_category_htmlize]}');
return;
}
var pages = 0;
var htmlize_index = -1;
$('#list_only_html').append($('<input type="hidden" name="pages" value="'+ pages +'" />'));
for(var i = 0; i < ids.length; i++){
$('#list_only_html').append($('<input type="hidden" name="cids[]" value="'+ ids[i] +'" />'));
if($.inArray("h_"+ids[i],CATEGOYR_HTML) >=0){
htmlize_index = 1;
}
}	
if(htmlize_index == 1){
$('#list_only_html').submit();		
}else{
p8_window.alert('{$P8LANG[cms_category_htmlize]}');		
return;
}
html_dialog.show();
}

function view_to_html(){
if(CATEGOYR_HTML.length<1){
p8_window.alert('{$P8LANG[cms_category_htmlize]}');
return;
}
$('#view_to_html').empty();

var ids = checked_values('id[]', $('#form'));
if(!ids.length){
p8_window.alert('{$P8LANG[cms_category_htmlize]}');
return;
}
var htmlize_index = -1;
for(var i = 0; i < ids.length; i++){
$('#view_to_html').append($('<input type="hidden" name="cids[]" value="'+ ids[i] +'" />'));
if($.inArray("h_"+ids[i],CATEGOYR_HTML) >=0){
htmlize_index = 1;
}
}
if(htmlize_index == 1){
$('#view_to_html').submit();
html_dialog.show();	
}else{
p8_window.alert('{$P8LANG[cms_category_htmlize]}');		
return;
}	
}
var merge_dialog = new P8_Dialog({
title_text: '{$P8LANG['cms_category_merge']}',
button: true,
width: 700,
height: 500,
show: function(){
cs.init();
}
});

var cs = new Recursive_Selector({
json: CATEGORY_JSON,
path: CATEGORY_PATH,
input: $('#move_cid'),
dialog: merge_dialog,
sub_property: 'categories',
item_callback: function(cat, item){
if(cat.type == 1)
item.find('span').addClass('frame_category');

if(cat.categories)
item.addClass('sub_category');
},
change: function(select){
var cat = this.get_by_id(select.data('value'));
}
});

function merge(id){
if(Array.isArray(id)){
if(id.length<1) {
p8_window.alert('{$P8LANG[cms_category_need_select]}');
return;
}
}
merge_dialog.show();

merge_dialog.ok(function(){
$.ajax({
url: '$this_router-merge',
type: 'post',
cache: false,
data: {id: id, to_id: cs.get_value()},
beforeSend: function(){
ajaxing({});
},
success: function(s){
ajaxing({action: 'hide'});

merge_dialog.close();
}
});
return false;
});
}
var clone_dialog = new P8_Dialog({
title_text: '{$P8LANG['cms_category_clone']} - {$P8LANG['cms_category_clone_to']}',
button: true,
width: 700,
height: 500,
show: function(){
cs2.init();
}
});
var cs2 = new Recursive_Selector({
json: CATEGORY_JSON,
path: CATEGORY_PATH,
input: $('#move_cid'),
dialog: clone_dialog,
sub_property: 'categories',
item_callback: function(cat, item){
if(cat.type == 1)
item.find('span').addClass('frame_category');

if(cat.categories)
item.addClass('sub_category');
},
change: function(select){
var cat = this.get_by_id(select.data('value'));
}
});
function clone_cate(id){
if(Array.isArray(id)){
if(id.length<1) {
p8_window.alert('{$P8LANG[cms_category_need_select]}');
return;
}
}

clone_dialog.show();

clone_dialog.ok(function(){
$.ajax({
url: '$this_router-clone',
type: 'post',
cache: false,
data: {id: id, to_id: cs2.get_value()},
beforeSend: function(){
ajaxing({});
},
success: function(s){
ajaxing({action: 'hide'});
clone_dialog.close();
p8_window.alert('{$P8LANG['done']}');
location.reload();
}
});
return false;
});
}
function update_category(ids){
if(Array.isArray(ids)){
if(ids.length<1) {
p8_window.alert('{$P8LANG[cms_category_need_select]}');
return;
}
}
for(var i in ids){
openUrl("$this_router-update?model=&id="+ids[i]);
}
}

function label_category(ids){
if(Array.isArray(ids)){
if(ids.length<1) {
p8_window.alert('{$P8LANG[cms_category_need_select]}');
return;
}
}
for(var i in ids){
openUrl('{$core->controller}/$SYSTEM/item-list-category-'+ids[i]+'?edit_label=1');
}
}

function label_view(ids){
if(Array.isArray(ids)){
if(ids.length<1) {
p8_window.alert('{$P8LANG[cms_category_need_select]}');
return;
}
}
for(var i in ids){
$('#edit_view_label_'+ids[i]).click();
}
}
function view_category_html(ids){
if(Array.isArray(ids)){
if(ids.length<1) {
p8_window.alert('{$P8LANG[cms_category_need_select]}');
return;
}
}
for(var i in ids){
$('#category_html_'+ids[i]).click();
}
}
function view_category(ids){
if(Array.isArray(ids)){
if(ids.length<1) {
p8_window.alert('{$P8LANG[cms_category_need_select]}');
return;
}
}
for(var i in ids){
openUrl("{$this_system->modules['item']['controller']}-list-category-"+ids[i]);
}
}
function _find(n, json){
var ret = [];
for(var i in json){
if(json[i].name.indexOf(n) != -1)
ret.push(json[i].id);

if(json[i].categories){
ret = ret.concat(_find(n, json[i].categories));
}
}

return ret;
}

var auto = new P8_Autocomplete({
input: $('#srh'),
className: 'autocomplete',
trigger: function(){
var find = _find(this.keyword, CATEGORY_JSON);

if(!find.length) return;
//p8_window.alert(find);
var json = [];
var parents = '';
for(var i = 0; i < find.length; i++){
var parents = '';
for(var j in CATEGORY_PATH[find[i]]){
parents += get_category_by_id(CATEGORY_PATH[find[i]][j]).name +' &gt; ';
}

var cat = get_category_by_id(find[i]);
json.push({text: parents, value: cat.id});
}

this.deploy(json);
},
callback: function(li){
p8_window.alert(li.data('value'));

return false;
}
});

var html_dialog = new P8_Dialog({
width: 700,
height: 500,
overlay: false,
cancel: function(){
this.content.find('iframe').attr('src', 'about:blank');
}
});
html_dialog.content.append($('#status'));
$('.enables img').click(function(){
var enabled = this.title;
var htmlize = 0;
var verified = '$verified';
if(enabled == 2) htmlize = 20;
if(enabled == 20) htmlize = 2;
if(enabled == 0) htmlize = 1;	
$.ajax({
url: '$this_router-htmlize',
type: 'post',
dataType: 'json',
cache: false,
data: {id: this.id.replace(/[^0-9]/g, ''), htmlize: htmlize,verified:verified?1:0},
beforeSend: function(){
ajaxing({});
},
success: function(json){
ajaxing({action: 'hide'});
for(var i in json){
if(enabled == 1){
$('#cate_'+ json[i]).attr('src', '{$SKIN}/check_no.gif').attr('title', 0);				
}
if(enabled == 2){
$('#cate_'+ json[i]).attr('src', '{$SKIN}/check_no.gif').attr('title', 20);				
}
if(enabled == 20){
$('#cate_'+ json[i]).attr('src', '{$SKIN}/check_2.gif').attr('title', 2);				
}
if(enabled == 0){
$('#cate_'+ json[i]).attr('src', '{$SKIN}/check_yes.gif').attr('title', 1);				
}
}

}
});
});
</script><div class="clear"></div>

</body>
</html>
EOT;
?>