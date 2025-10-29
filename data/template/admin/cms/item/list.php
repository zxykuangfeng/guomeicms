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
</div><script type="text/javascript" src="{$RESOURCE}/js/recursive_selector.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/cms/item/admin.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/rcalendar.js"></script>
<link rel="stylesheet" href="{$SKIN}/cms/category_selector.css" type="text/css" />
<style type="text/css">
body, html{overflow:inherit;}
.legend{font-size:14px;padding-bottom:5px;}
</style>
<div class="mainbox mainborder">
<div class="section">
<table class="formtable">
<tr>
<td class="headerbtn_list">
<div class="fright">
<form id="attr_request" method="get" action="$this_router-attribute"
EOT;
if($ACTION != 'attribute'){
print <<<EOT
 target="_blank"
EOT;
}
print <<<EOT
>
<select name="attribute" onchange="if(this.value) 
EOT;
if($ACTION == 'attribute'){
print <<<EOT
this.form.cid.value = 0;$('#cids').empty();request_item(1);
EOT;
}else{
print <<<EOT
this.form.submit();
EOT;
}
print <<<EOT
">
<option value="">--文章属性筛选--</option>
EOT;
$__t_foreach = @$this_module->attributes;
if(!empty($__t_foreach)){
foreach($__t_foreach as $aid => $v){
if($aid != 9){
print <<<EOT

<option value="$aid"
EOT;
if(!(empty($attribute)) && $attribute == $aid){
print <<<EOT
 selected
EOT;
}
print <<<EOT
>
EOT;
if($this_module->CONFIG['attributes'][$aid]){
print <<<EOT
{$this_module->CONFIG['attributes'][$aid]}
EOT;
}else{
print <<<EOT
{$P8LANG['cms_item']['attribute'][$aid]}
EOT;
}
print <<<EOT
</option>
EOT;
}
}
}

print <<<EOT

</select>&nbsp;
EOT;
if($ACTION == 'attribute'){
print <<<EOT

<span id="cids"></span>
<input type="hidden" name="cid" id="cid" />
<input type="button" value="按分类筛选" onclick="dialog.show()" />
EOT;
}
print <<<EOT

</form>
</div>
<div class="course mr15 pull-right"><a href="{$RESOURCE}/attachment/jiaocheng/htzhuzhanneirong.pdf" target="_blank" style="color:#c00;"><img src="{$RESOURCE}/skin/admin/help_icon.gif" class="helpicon"> 内容教程>></a></div>
<form action="$this_url" method="get" id="request" onsubmit="request_item(1);return false;">
<div class="screen-title mr20 fleft">
<span id="cids"></span>
<input type="button" value="{$P8LANG['cms_item']['filter_by_category']}" class="screenbtn" onclick="category_dialog.show()" />
<input type="hidden" id="cid" name="cid" value="$cid" />
</div>
<div class="screen-tab mr20 fleft">
<input type="radio" name="verified" value="1" id="verified1"
EOT;
if($verified == 1){
print <<<EOT
 checked
EOT;
}
print <<<EOT
 /><label for="verified1">{$P8LANG['cms_item']['verified']}</label>
<input type="radio" name="verified" value="2" id="verified2"
EOT;
if($verified == 2){
print <<<EOT
 checked
EOT;
}
print <<<EOT
 /><label for="verified2">{$P8LANG['cms_item']['verified_passed']}</label>
<input type="radio" name="verified" value="3" id="verified3"
EOT;
if($verified == 3){
print <<<EOT
 checked
EOT;
}
print <<<EOT
 /><label for="verified3">{$P8LANG['cms_item']['direct_verify']}</label>
<input type="radio" name="verified" value="66" id="verified66"
EOT;
if($verified == 66){
print <<<EOT
 checked
EOT;
}
print <<<EOT
 /><label for="verified66">{$P8LANG['cms_item']['create_time_release']}</label>
<input type="radio" name="verified" value="77" id="verified77"
EOT;
if($verified == 77){
print <<<EOT
 checked
EOT;
}
print <<<EOT
 /><label for="verified77">{$P8LANG['cms_item']['drafts_release']}</label>
<input type="radio" name="verified" value="-99" id="verified-99"
EOT;
if($verified == -99){
print <<<EOT
 checked
EOT;
}
print <<<EOT
 /><label for="verified-99">{$P8LANG['cms_item']['rejected']}</label>
<input type="radio" name="verified" value="88" id="verified88"
EOT;
if($verified == 88){
print <<<EOT
 checked
EOT;
}
print <<<EOT
 /><label for="verified88">{$P8LANG['cms_item']['recycle']}</label>
<input type="radio" name="verified" value="0" id="verified0"
EOT;
if($verified == 0){
print <<<EOT
 checked
EOT;
}
print <<<EOT
 /><label for="verified0">{$P8LANG['cms_item']['all_unverified']}</label>
<!--input type="checkbox" name="mine" value="1" id="mine"
EOT;
if($mine){
print <<<EOT
 checked
EOT;
}
print <<<EOT
 /><label for="mine">{$P8LANG['cms_item']['my_item']}</label-->
</div>

<div class="fleft">
<select name="model" id="model" onchange="MODEL = this.value">
<option value="">{$P8LANG['cms_model']}</option>
EOT;
$__t_foreach = @$models;
if(!empty($__t_foreach)){
foreach($__t_foreach as $name => $v){
print <<<EOT

<option value="$name"
EOT;
if($MODEL == $name){
print <<<EOT
 selected
EOT;
}
print <<<EOT
>$v[alias]</option>
EOT;
}
}

print <<<EOT

</select>
<select name="order">
<option value="0" selected="selected">降序</option>
<option value="1">升序</option>
<option value="2">权重</option>
</select>
<select name="key_type" id="selected_type">
<option value="keyword">{$P8LANG['cms_item']['search_by_keyword']}</option>
<option value="id"
EOT;
if(!empty($id)){
print <<<EOT
 selected
EOT;
}
print <<<EOT
>{$P8LANG['cms_item']['search_by_id']}</option>
<option value="username"
EOT;
if(!empty($username)){
print <<<EOT
 selected
EOT;
}
print <<<EOT
>按发布人</option>
<option value="author"
EOT;
if(!empty($author)){
print <<<EOT
 selected
EOT;
}
print <<<EOT
>按作者</option>
<option value="verifier">按审核人</option>
<option value="source">按来源</option>
<option value="allitem">按全文</option>
<option value="regexp_mobile">手机号码</option>
<option value="regexp_id">身份证号</option>
<option value="url">跳转外链</option>
</select>
<input type="text" class="txt" id="cond" size="15" name="key_word" value="$key_word"/>
<input type="submit" value="{$P8LANG['search']}" class="submit btn-color1"/>
<!--<input type="button" value="{$P8LANG['refresh']}" class="refreshbtn" onclick="request_item(PAGE)" />-->
</div>
</form>
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
<li id="verified_1" class="btn-color1"><a href="$this_url?cid=$cid" class="bm_l"><i class="icon icon-ico1"></i>{$P8LANG['cms_item']['verified']}</a></li>							
<!--li id="verified_mine"><a class="bm_l" href="###" onclick="$('#mine').prop('checked', true);request_item(1);" href="$this_url?mine=1">{$P8LANG['cms_item']['my_item']}</a></li-->
EOT;
if($allow_verify_first){
print <<<EOT
							
<li id="verified_0" class="btn-color2"><a class="bm_l" href="###" onclick="verified=0;$('#verified0').prop('checked', true);request_item(1);"><i class="icon icon-ico2"></i>{$P8LANG['cms_item']['unverified_first']}</a></li>
EOT;
}
if($allow_verify){
print <<<EOT

<li id="verified_2" class="btn-color2"><a class="bm_l" href="###" onclick="verified=2;$('#verified2').prop('checked', true);request_item(1);"><i class="icon icon-ico2"></i>{$P8LANG['cms_item']['unverified']}</a></li>
EOT;
}
print <<<EOT

<li id="verified_3" class="btn-color3"><a class="bm_l" href="###" onclick="verified=3;$('#verified3').prop('checked', true);request_item(1);"><i class="icon icon-ico3"></i>{$P8LANG['cms_item']['direct_verify']}</a></li>
<li id="verified_-99" class="btn-color4"><a class="bm_l" href="###" onclick="verified=-99;$('#verified-99').prop('checked', true);request_item(1);"><i class="icon icon-ico9"></i>{$P8LANG['cms_item']['rejected']}</a></li>
<li id="verified_77" class="btn-color4"><a class="bm_l" href="###" onclick="verified=77;$('#verified77').prop('checked', true);request_item(1);"><i class="icon icon-ico7"></i>{$P8LANG['cms_item']['drafts_release']}</a></li>
<li id="verified_88" class="btn-color7"><a class="bm_l" href="###" onclick="verified=88;$('#verified88').prop('checked', true);request_item(1);"><i class="icon icon-ico7"></i>{$P8LANG['cms_item']['recycle']}</a></li>							
<li id="verified_66" class="btn-color7"><a class="bm_l" href="###" onclick="verified=66;$('#verified66').prop('checked', true);request_item(1);"><i class="icon icon-ico7"></i>{$P8LANG['cms_item']['create_time_release']}</a></li>
EOT;
if($sites_push){
print <<<EOT

<li id="my_push" class="btn-color5"><a class="bm_l" href="{$this_router}-push_status"><i class="icon icon-ico9"></i>{$P8LANG['cms_item']['push_status']}</a></li>
<li id="my_push" class="btn-color6"><a class="bm_l" href="{$this_router}-push_status?sc=c"><i class="icon icon-ico9"></i>{$P8LANG['cms_item']['receive_status']}</a></li>
EOT;
}
print <<<EOT

<li class="btn-color10"><a href="javascript:;" onclick="update_item(checked_values('id[]', $('#form')))"><i class="icon icon-ico45"></i>编辑内容</a></li>
<li class="btn-color11"><a href="javascript:;" onclick="recycle_items(checked_values('id[]', $('#form')), verified)"><i class="icon icon-ico46"></i>删除内容</a></li>							
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

<li class="btn-color{$count}"><a target="_blank" href="{$core->admin_controller}/$SYSTEM/item-add?model={$model}"><i class="icon icon-ico55"></i>{$value[alias]}</a></li>
EOT;
$count++;
}
}
}

print <<<EOT

</ul>
</li>
<li style="float:right;line-height:36px;background:none;">
EOT;
if(empty($this_module->CONFIG['menu_level']) && $allow_level){
print <<<EOT

权重设置：时效<input type="text" name="level_time" class="txt" style="font-size:12px;" id="level_time" size="20" autocomplete="off" value="不选则永久有效" onfocus="if (value =='不选则永久有效'){value =''}" onblur="if (value ==''){value='不选则永久有效'}" onclick="rcalendar(this, 'full','',true)" />
<select name="level" id="level">
<option value="">快捷设置权重值</option>
EOT;
$__t_foreach = @$P8LANG['cms_item']['level_rank'];
if(!empty($__t_foreach)){
foreach($__t_foreach as $k=>$v){
if($k){
print <<<EOT

<option value="{$k}">设置为：第{$v}名</option>
EOT;
}else{
print <<<EOT

<option value="{$k}">设置为：{$v}</option>
EOT;
}
}
}

print <<<EOT

</select> 
EOT;
}
print <<<EOT

<input type="button" value="提交" onclick="set_level(checked_values('id[]', $('#form')),$('#level').val(),verified,$('#level_time').val())" class="submit_btn">
</li>
</ul>
</td>
</tr>
</table>
<form action="" method="post" id="form">
<table width="100%" class="columntable formtable hover_table click_changeable">

<tr class="title fix_head">
<td width="2%" align="center" class="title"><input type="checkbox" name="cl" onclick="check_all(this, 'id[]', $('#form'));init_tr($('#form'));" /></td>
<td width="3%" align="center" class="title">ID</td>
<td width="20%" class="title">{$P8LANG['title']}
<a href="#"><img src="{$_SKIN}/up.png" /></a>
<a href="#op"><img src="{$_SKIN}/down.png" /></a>
</td>
<td width="5%" align="center" class="title">{$P8LANG['source']}</td>
<td width="6%" align="center" class="title">{$P8LANG['cms_category_name']}</td>
<td width="4%" align="center" class="title">{$P8LANG['cms_model']}</td>
<td width="5%" align="center" class="title">{$P8LANG['department']}</td>
<td width="5%" align="center" class="title">{$P8LANG['author']}</td>
<td width="5%" align="center" class="title">{$P8LANG['verifier']}</td>
<td width="3%" align="center" class="title">{$P8LANG['view']}</td>
<td width="7%" align="center" class="title">{$P8LANG['addtime']}</td>						
<td width="3%" align="center" class="title">{$P8LANG['score']}</td>
<td width="3%" align="center" class="title">{$P8LANG['level']}</td>
<td width="*" align="center" class="title">{$P8LANG['operation']}</td>
</tr>

<tbody id="list">

</tbody>

</table>
<table width="100%" class="columntable formtable">
<tr>
<td align="center" id="pages" class="pages"></td>
</tr>
</table>

<!--set attribute-->
<input type="hidden" name="act" value="" />
<div id="post_attributes"></div>
</form>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="foot_btn">			
<tr>
<td>
<a name="op"></a>
<a href="javascript:void(0)" onclick="check_all(true, 'id[]');init_tr($('#form'));">全选</a> /
<a href="javascript:void(0)" onclick="check_all(false, 'id[]');init_tr($('#form'));">全不选</a>
EOT;
if(empty($this_module->CONFIG['menu_verify']) && $allow_verify){
print <<<EOT

<input type="button" value="{$P8LANG['cms_item']['verify']['']}" onclick="verify_item(checked_values('id[]', $('#form')), verified, 1)" class="edit_btn" />
EOT;
}elseif(empty($this_module->CONFIG['menu_verify_first']) && $allow_verify_first){
print <<<EOT

<input type="button" value="{$P8LANG['cms_item']['verify_first']['']}" onclick="verify_first_item(checked_values('id[]', $('#form')), 2, verified)" class="edit_btn" />
EOT;
}
if(empty($this_module->CONFIG['menu_move']) && $allow_move){
print <<<EOT

<input type="button" value="{$P8LANG['cms_item']['move']}" onclick="move_item(checked_values('id[]', $('#form')), verified)" class="edit_btn" />
EOT;
}
if(empty($this_module->CONFIG['menu_set_score']) && $allow_score){
print <<<EOT

<input type="button" value="{$P8LANG['cms_item']['set_score']}" onclick="score_item(checked_values('id[]', $('#form')), 1, verified)" class="edit_btn" />
EOT;
}
if(empty($this_module->CONFIG['menu_htmlize_view']) && $allow_view_to_html){
print <<<EOT

<input type="button" value="{$P8LANG['cms_item']['htmlize']['view']}" onclick="view_to_html(false)" class="edit_btn" />
EOT;
}
if(empty($this_module->CONFIG['menu_htmlize_mobile']) && $allow_view_to_html){
print <<<EOT

<input type="button" value="{$P8LANG['cms_item']['htmlize']['mobile']}" onclick="view_to_html(true)" class="edit_btn" />
EOT;
}
if(empty($this_module->CONFIG['menu_cluster_push']) && $clustered){
print <<<EOT

<input type="button" value="{$P8LANG['cms_item']['cluster_push']}" onclick="_push_item(checked_values('id[]', $('#form')), 1)" class="edit_btn" />
EOT;
}
if(empty($this_module->CONFIG['menu_sites_push']) && $sites_push){
print <<<EOT

<input type="button" value="{$P8LANG['cms_item']['sites_push']}" onclick="_push_item_site(checked_values('id[]', $('#form')), 1)" class="edit_btn" />
EOT;
}
if(empty($this_module->CONFIG['menu_cms_sites_push']) && $sites_push){
print <<<EOT

<input type="button" value="{$P8LANG['cms_item']['cms_sites_push']}" onclick="_push_to_site(checked_values('id[]', $('#form')), 1)" class="edit_btn" />
EOT;
}
if($verified == 1 && empty($this_module->CONFIG['menu_clone']) && $allow_clone){
print <<<EOT

<input type="button" value="{$P8LANG['cms_item']['clone']}" onclick="clone_item(checked_values('id[]', $('#form')), verified)" class="edit_btn" />
EOT;
}
if(empty($this_module->CONFIG['menu_list_order']) && $allow_list_order){
print <<<EOT

<input type="button" value="{$P8LANG['cms_item']['list_order']['up']}/{$P8LANG['cms_item']['list_order']['down']}" onclick="list_order(checked_values('id[]', $('#form')), 1, verified)" class="edit_btn" />
EOT;
}
if(empty($this_module->CONFIG['menu_download']) && $allow_download){
print <<<EOT

<input type="button" class="edit_btn" value="{$P8LANG['cms_item']['download']}" onclick="download()">
EOT;
}
print <<<EOT
					
<br />
EOT;
if(empty($this_module->CONFIG['menu_attribute']) && $allow_attribute){
print <<<EOT


<div id="attributes">
<div class="fleft">
<form id="att_form" method="post" action="$this_router-attribute" target="attr_poster">
<label style="color:#024f96;">请选择所需属性：</label>
EOT;
if(!empty($allow_attribute)){
$__t_foreach = @$this_module->attributes;
if(!empty($__t_foreach)){
foreach($__t_foreach as $aid => $v){
if($IS_FOUNDER || !empty($this_module->CONFIG['attribute_acl'][$aid][$ROLE])){
if(($aid < 9 || $aid >13) && !$this_module->CONFIG['attributes_show'][$aid]){
print <<<EOT

<input type="checkbox" name="attribute[$aid]" id="attribute[$aid]" value="$aid" /><label for="attribute[$aid]">
EOT;
if($this_module->CONFIG['attributes'][$aid]){
print <<<EOT
{$this_module->CONFIG['attributes'][$aid]}
EOT;
}else{
print <<<EOT
{$P8LANG['cms_item']['attribute'][$aid]}
EOT;
}
print <<<EOT
</label>
EOT;
}
}
}
}

print <<<EOT

&nbsp;
<input type="button" value="{$P8LANG['cms_item']['set_attribute']}" onclick="set_attribute()" class="setbtn"/>
<input type="button" value="{$P8LANG['cms_item']['delete_attribute']}" onclick="delete_attribute()" class="delbtn"/>
EOT;
}
print <<<EOT

<div id="attr_ids"></div>
<input type="hidden" name="act" />
</form>
</div>
</div>

<iframe name="attr_poster" style="display: none;"></iframe>

<script type="text/javascript">
function set_attribute(){
//no item or attribute selected
var ids = collect_attribute_ids();
if(!ids.length || !$('#attributes input[type=checkbox][id^=attribute]:checked').length){
p8_window.alert('{$P8LANG[cms_item_select]}');
return;
}

//if(!confirm('$P8LANG[confirm_to_do]')) return;
p8_window.confirm('{$P8LANG['confirm_to_do']}', function (r) {
if(r){			
ajaxing({});
$('#att_form input[name=act]').val('set');
$('#att_form').get(0).submit();
}else{
return;
}
});
}

function delete_attribute(){
//no item or attribute selected
var ids = collect_attribute_ids();
if(!ids.length || !$('#attributes input[type=checkbox][id^=attribute]:checked').length){
p8_window.alert('{$P8LANG[cms_item_select]}');
return;
}

//if(!confirm('$P8LANG[confirm_to_delete]')) return;
p8_window.confirm('{$P8LANG['confirm_to_delete']}', function (r) {
if(r){		
ajaxing({});
$('#att_form input[name=act]').val('delete');
$('#att_form').get(0).submit();
}else{
return;
}
});
}

function collect_attribute_ids(){
var ids = $('#form input[type=checkbox]:checked');
$('#attr_ids').empty();
ids.each(function(){
$('<input type="hidden" name="id[]" />').val(this.value).appendTo($('#attr_ids'));
});

return ids;
}

</script>					
EOT;
}
print <<<EOT

</td>
</tr>
</table>

</div>

</div>

<input type="hidden" id="move_cid" />
<input type="hidden" id="select_cid" />

<form action="$this_router-view_to_html" id="view_to_html2" method="post" target="__reflash_index__"></form>
<form action="$this_router-view_to_html" id="view_to_html" method="post" target="_blank"></form>
<form action="$this_router-download" id="download" method="post"></form>
<form action="{$this_system->admin_controller}-index_to_html" method="post" id="__reflash_index__" target="__reflash_index__">
<input type="hidden" name="type" value="index_to_html" />
</form>
<iframe style="display: none;" name="__reflash_index__"></iframe>
<script type="text/javascript">
$(document).ready(function(){
$(".boxmenu li").each(function (index) {
$(this).click(function(){
$('.boxmenu li').removeClass('active');
$(this).addClass('active');
});
});
});
</script>
EOT;
if($verified==3){
print <<<EOT

<script type="text/javascript">
$('.boxmenu li').removeClass('active');
$(".boxmenu li:nth-child(5)").addClass("active");
</script>
EOT;
}
print <<<EOT


<script type="text/javascript">
var move_item_id = [],
clone_item_id = [],
verify_item_id = [],
score_item_id = [],
up_down_id = [],
verified = 1,
MODEL = '$MODEL',

MODEL_JSON = $model_json,
ATTR_JSON = $attr_json,
PAGE;

function update_item(ids){
if(Array.isArray(ids)){
if(ids.length<1) {
p8_window.alert('{$P8LANG[cms_item_select]}');
return;
}
}
for(var i in ids){
$('#item_'+ids[i]).click();
}
}
function request_item(page){

$.ajax({
url: '$this_url',
data: $('#request').serialize() +'&page='+ (page === undefined ? 1 : page),
dataType: 'json',
cache: false,
beforeSend: function(){
ajaxing({});
},
success: function(json){
PAGE = page;
verified = $('#request input[name=verified]:checked').val();
mine = $('#request input[name=mine]:checked').val();
$('.boxmenu li').removeClass('active');
if(mine)
$("#verified_mine").addClass("active");
else
$('#verified_'+verified).addClass("active");
$('#list').empty();
for(var i in json.list){
_list_item(json.list[i]);
}

$('#pages').html(json.pages);

ajaxing({action: 'hide'});

window.scrollTo(0, 0);

$('input[name=cl]').prop('checked', false);

if($('#cond').val() && $('#selected_type').val() == 'id'){
check_all(true, 'id[]');
}

init_tr($('#form'));

var keywords = $.trim($('#request input[name=keyword]').val());
if(!keywords.length) return;

var keywords = keywords.replace(/[\\+\\-\\*\\|\\!]/g, '').split(/\\s+/);

$('.list_item').each(function(){
for(var i = 0; i < keywords.length; i++){
var html = $(this).find('.item_title').get(0).innerHTML;
$(this).find('.item_title').get(0).innerHTML = html.replace(keywords[i], '<font color="red">'+ keywords[i] +'</font>', 'ig');
}
});

}
});
}

function _list_item(json){

var props = ['id', 'cid', 'attributes', 'title', 'push_back_reason', 'model', 'timestamp', 'views', 'level', 'username', 'pages','department'];

for(var i = 0; i < props.length; i++){
if(json[props[i]] === undefined) json[props[i]] = '';
}

json.otitle = json.title;
json.title_bold == 1 && (json.title = '<b>'+ json.title +'</b>');
json.title_color && (json.title = '<font color="'+ json.title_color +'">'+ json.title +'</font>');
var cmp = json.list_order - json.timestamp;
if(verified == 1 && cmp != 0){
if(cmp > 0){
json.title += '<img src="{$_SKIN}/up.png" />';
json.otitle += lang_array('{$P8LANG['cms_item']['list_order']['up_to']}', [date('Y-m-d H:i:s', json.list_order)]);
}else{
json.title += '<img src="{$_SKIN}/down.png" />';
json.otitle += lang_array('{$P8LANG['cms_item']['list_order']['down_to']}', [date('Y-m-d H:i:s', json.list_order)]);
}

}

json.model = MODEL_JSON[json.model] || {id: 0, name: MODEL, alias: ''};

var attr = json.attributes.split(',');
var attrs = '';
for(var i in attr){
if(!attr[i]) continue;

attrs += '<font color="red">'+ ATTR_JSON[attr[i]] +'</font> ';
}
attrs += json.lan_access_only == '1' ? '<font color="red">{$P8LANG[local_area_network]}</font>' : '';
var verify_link = '<a alt="'+ json.verified +'" title="'+ json.verified +'" class="btn-color42"><i class="icon icon-ico7"></i>未审</a>';
if(json.verified == 1){
verify_link = '<a alt="'+ json.verified +'" title="'+ json.verified +'" class="btn-color42"><i class="icon icon-ico1"></i>已审</a>';
}else if(json.verified == 88){
verify_link = '<a alt="'+ json.verified +'" title="'+ json.verified +'" class="btn-color42"><i class="icon icon-ico50"></i>还原</a>';
}else if(json.verified == -99){
verify_link = '<a alt="'+ json.verified +'" title="'+ json.verified +'" class="btn-color42"><i class="icon icon-ico46"></i>被退稿</a>';
}else if(json.verified == 77){
verify_link = '';
}
var update_link = '
EOT;
if($allow_update){
print <<<EOT
<a href="$this_router-update?model='+ json.model.name +'&id='+ json.id +'&verified='+ json.verified +'" target="_blank" title="{$P8LANG['edit']}" class="btn-color43"><i class="icon icon-ico45"></i><span id="item_'+ json.id +'">{$P8LANG['edit']}</span></a>
EOT;
}
print <<<EOT
 ';
var addon_link = '
EOT;
if($allow_add){
print <<<EOT
<a href="$this_router-addon?model='+ json.model.name +'&cid='+ json.cid +'&iid='+ json.id +'&verified='+ json.verified +'" target="_blank" title="{$P8LANG['cms_item']['addon']}" class="btn-color16"><i class="icon icon-ico44"></i>{$P8LANG['cms_item']['addon_alias']}</a>
EOT;
}
print <<<EOT
 ';
if(verified == 88){
var delete_link = '
EOT;
if($allow_delete){
print <<<EOT
<a id="delete_'+ json.id +'" href="###" onclick="return delete_item([this.id],verified==1?1:0);" title="{$P8LANG['delete']}" class="btn-color44"><i class="icon icon-ico4"></i>{$P8LANG['delete']}</a>
EOT;
}
print <<<EOT
 ';
}else{
var delete_link = '
EOT;
if($allow_delete){
print <<<EOT
<a id="delete_'+ json.id +'" href="###" onclick="return recycle_items([this.id],verified==1?1:0);" title="{$P8LANG['delete']}" class="btn-color44"><i class="icon icon-ico4"></i>{$P8LANG['delete']}</a>
EOT;
}
print <<<EOT
 ';
}
var verify_frame_link = '
EOT;
if($allow_verify_frame){
print <<<EOT
<a href="{$this_module->U_controller}-view_frame-id-'+ json.id +'?verified='+ json.verified +'" target="_blank" class="btn-color10"><i class="icon icon-ico42"></i>{$P8LANG['cms_item']['verify_frame_alias']}</a>
EOT;
}
print <<<EOT
 ';

var tr = 
'<tr class="list_item" id="list_'+json.id+'">'+
'<td align="center"><input type="checkbox" name="id[]" value="'+ json.id +'" /></td>'+
'<td align="center">'+ json.id +'</td>'+
'<td><span class="item_title" style="max-width: 300px; overflow: hidden; display: inline-block; line-height:26px;height: 20px;">'+
'<a href="{$this_module->controller}-view-id-'+ json.id +'?verified='+ json.verified +'" target="_blank" title="
EOT;
if(!empty($value['push_back_reason'])){
print <<<EOT
$value[push_back_reason]
EOT;
}else{
print <<<EOT
'+ json.otitle +'
EOT;
}
print <<<EOT
" alt="'+ json.otitle +'">'+ json.title +'</a></span>&nbsp;'+ attrs +
'</td>'+
'<td align="center"><a href="'+ json.sourceurl +'" target="_blank">'+ json.source +'</a></td>'+
'<td align="center" id="item_cat_'+ json.id +'" title="'+ json.cid +'">'+
'<a href="{$core->admin_controller}/cms/item-list?model=&cid='+ json.cid +'" >'+ json.category_name +'</a>'+
'</td>'+
'<td align="center">'+ json.model.alias +'</td>'+
'<td align="center">'+ json.department +'</td>'+
'<td align="center">'+ json.username +'</td>'+
'<td align="center">'+ json.verifier +'</td>'+
'<td align="center">'+ json.views +'</td>'+
'<td align="center">'+ date('Y-m-d H:i', json.timestamp) +'</td>'+
'<td align="center"><span id="item_score_'+ json.id +'">'+ (json.score ? json.score:'') +'</span></td>'+
'<td align="center"><span class="level" id="item_level_'+ json.id +'">'+ json.level +'</span></td>'+		
'<td align="center">'+
'<ul class="operation-nav">'+(json.verified == 1 ?
'<li class="dropdown">'+
'<a class="btn-color41"><i class="icon icon-ico42"></i>查看</a>'+
'<ul class="dropdown-menu">'+
'<li class="btn-color1"><a href="{$this_module->controller}-view-id-'+ json.id +'?verified='+ json.verified +'" target="_blank" title="
EOT;
if(!empty($value['push_back_reason'])){
print <<<EOT
$value[push_back_reason]
EOT;
}else{
print <<<EOT
'+ json.otitle +'
EOT;
}
print <<<EOT
" alt="'+ json.otitle +'" class="ys2"><i class="icon icon-ico55"></i>查看动态</a></li>'+
'<li class="btn-color2"><a href="'+ json.url +'" target="_blank" class="ys2"><i class="icon icon-ico55"></i>查看静态</a></li>'+
'</ul>'+
'</li>' : '<li><a href="{$this_module->controller}-view-id-'+ json.id +'?verified='+ json.verified +'" target="_blank" title="
EOT;
if(!empty($value['push_back_reason'])){
print <<<EOT
$value[push_back_reason]
EOT;
}else{
print <<<EOT
'+ json.otitle +'
EOT;
}
print <<<EOT
" alt="'+ json.otitle +'" class="btn-color41"><i class="icon icon-ico42"></i>查看</a>'+
'</li>')+(json.verified == 1 ? '<li class="dropdown"><a class="btn-color41"><i class="icon icon-ico9"></i>推送</a><ul class="dropdown-menu"><li class="btn-color1"><a href="javascript:void(0)" onclick="_push_to_site(['+json.id+'], 1)"class="ys2"><i class="icon icon-ico55"></i>推送子站</a></li><li class="btn-color1"><a href="javascript:void(0)" onclick="clone_item([\\''+json.id+'\\']) "class="ys2"><i class="icon icon-ico55"></i>推送本站</a></li></ul></li>':'')+
EOT;
if(empty($this_module->CONFIG['menu_verify_frame'])){
print <<<EOT

'<li>'+verify_frame_link+'</li>'+
EOT;
}
print <<<EOT

'<li style="cursor: pointer;" id="verify_'+ json.id +'"
EOT;
if($allow_verify){
print <<<EOT
 onclick="verify_item([this.id], $(\\'a\\', this).attr(\\'alt\\'), verified)"
EOT;
}
print <<<EOT
>'+
verify_link+
'</li>'+				
'<li>'+
update_link+
'</li>'+
'<li>'+
delete_link+
'</li>'+
'</ul>'+			
'</td>'+
'</tr>';

$('#list').append($(tr));
}

var dialog = new P8_Dialog({
title_text: '{$P8LANG['cms_item']['move']}',
button: true,
width: 700,
height: 500,
show: function(){
cs.init();
},
ok: function(){

var cid = $('#move_cid').val();
if(!cid) return false;

var cat = cs.get_by_id(cid);

$.ajax({
url: '$this_router-move',
type: 'post',
dataType: 'json',
cache: false,
data: ajax_parameters({id: move_item_id, cid: cid, verified: verified === undefined ? 1 : verified}),
beforeSend: function(){
ajaxing({});
},
success: function(json){
ajaxing({action: 'hide'});

for(var i = 0; i < json.length; i++){
$('#item_cat_'+ json[i]).html('<a href="'+ cat['url'] +'" target="_blank">'+ cat['name'] +'</a>');
}

request_item(PAGE);
}
});
}
});

var cs = new Recursive_Selector({
input: $('#move_cid'),
dialog: dialog,
sub_property: 'categories',
url: '{$this_system->controller}/category-json?verify=1',
item_callback: function(cat, item){
if(MODEL && cat.model != '$MODEL')
item.css({opacity: '0.3', alpha: '(opacity=30)'});

if(cat.type == 1)
item.find('span').addClass('frame_category');

if(cat.categories)
item.addClass('sub_category');
},
change: function(select){
var cat = cs.get_by_id(select.data('value'));

if(MODEL && cat.model != MODEL && !cat.categories) p8_window.alert('你选了一个非本模型的分类');
}
});

var category_dialog = new P8_Dialog({
title_text: '{$P8LANG['select_category']}',
button: true,
width: 700,
height: 500,
show: function(){
category_filter.init();
},
ok: function(){
var cid = $('#select_cid').val();
$('#cid').val(cid);

category_selected(cid);

if(cid != 0){

var cat = category_filter.get_by_id(cid);

var check = new _check_model(cat.model);
check.check(cat);

MODEL = check.checked ? cat.model : '';
$('#model').val(MODEL);

}else{
$('#model').val('');
}
}
});

var category_filter = new Recursive_Selector({
input: $('#select_cid'),
sub_property: 'categories',
url: '{$this_system->controller}/category-json?verify=1',
value: $cid,
item_callback: function(cat, item){
if(cat.type == 1)
item.find('span').addClass('frame_category');

if(cat.categories)
item.addClass('sub_category');
},
init_callback: function(){
category_selected(this.get_value());
},
dialog: category_dialog
});

function category_selected(cid){
if(cid == 0){
$('#cids').html('');
return;
}

var tmp = category_filter.get_by_id(cid);
var html = '';

while(true){
html = tmp.name +' &gt; '+ html;
if(tmp.parent == 0) break;

tmp = category_filter.get_by_id(tmp.parent);
}

$('#cids').html(html);
}

function _check_model(model){
this.checked = true;
this.last_model = model;

this.check = function(cat){
if(this.last_model != cat.model){
this.checked = false;
}

this.last_model = cat.model;

if(cat.categories){
for(var i in cat.categories)
this.check(cat.categories[i]);
}
};
}

var score_dialog = new P8_Dialog({
title_text: '{$P8LANG['cms_item']['set_score']}',
width: 500,
height: 250,
button: true,
ok: function(){
var value = this.content.find('input[name=value]:checked').val();
var reason = this.content.find('textarea').val();

$.ajax({
url: '$this_router-score',			
type: 'POST',
dataType: 'json',
cache: false,
data: ajax_parameters({id: score_item_id, value: value, verified: verified, push_back_reason: reason}),
beforeSend: function(){
ajaxing({});
},
success: function(json){
ajaxing({action: 'hide'});
p8_window.alert(lang_array(P8LANG.cms.item.set_score, [json.length]));
for(var i = 0; i < json.length; i++){
$('#item_score_'+ json[i]).html(value);
}
request_item(PAGE);
}
});
},	
show: function(){
this.content.html(score_html);
}
});

var download_dialog = new P8_Dialog({
title_text: '{$P8LANG['cms_item']['download']}',
width: 750,
height: 150,
button: true,
ok: function(){
var model = this.content.find('#setmodel').val();
var mindate = this.content.find('#mindate').val();
var maxdate = this.content.find('#maxdate').val();
var cid = this.content.find('#cid').val();
var key_word = this.content.find('#key_word').val();
var key_type = this.content.find('#key_type').val();
$('#download').append('<input type="hidden" name="model" value="'+ model +'" />');
$('#download').append('<input type="hidden" name="mindate" value="'+ mindate +'" />');
$('#download').append('<input type="hidden" name="maxdate" value="'+ maxdate +'" />');
$('#download').append('<input type="hidden" name="key_word" value="'+ key_word +'" />');
$('#download').append('<input type="hidden" name="key_type" value="'+ key_type +'" />');
$('#download').append('<input type="hidden" name="cid" value="'+ cid +'" />');
$('#download').attr('method',"post");
$('#download').submit();
},
show: function(){
var download_html = '<div style="margin:12px auto 0;text-align:center;">'+
'<span id="cids"></span>'+
'<input type="button" value="{$P8LANG[cms_item][filter_by_category]}" class="screenbtn" onclick="category_dialog.show()" />'+
'<input type="hidden" id="cid" name="cid" value="" />';
download_html += ' 模型：<select name="model" id="setmodel">';
EOT;
$__t_foreach = @$models;
if(!empty($__t_foreach)){
foreach($__t_foreach as $name => $v){
print <<<EOT

download_html += '<option value="$name">$v[alias]</option>';
EOT;
}
}

print <<<EOT

download_html += '</select>';
download_html += ' 发布时间：<input type="text" name="mindate" id="mindate" size="10" onclick="rcalendar(this);" autocomplete="off" value=""/>-';
download_html += '<input type="text" name="maxdate" id="maxdate" size="10" onclick="rcalendar(this);" autocomplete="off" value=""/>';
download_html += '<select name="key_type" id="key_type">'+
'<option value="keyword">按关键字</option>'+
'<option value="username">按发布人</option>'+
'<option value="author">按作者</option>'+
'<option value="verifier">按审核人</option>'+
'<option value="source">按来源</option>'+
'<option value="allitem">按全文</option>'+
'<option value="regexp_mobile">手机号码</option>'+
'<option value="regexp_id">身份证号</option>'+
'<option value="url">跳转外链</option>'+
'</select>';
download_html += '<input type="text" class="txt" id="key_word" size="15" name="key_word" value=""/></div>';

this.content.html(download_html);
}
});
var sync_index_to_html = {$sync_index_to_html};
var verify_dialog = new P8_Dialog({
title_text: '{$P8LANG['cms_item']['verify']['']}',
width: 500,
height: 250,
button: true,
ok: function(){
var value = this.content.find('input[name=value]:checked').val();
var reason = this.content.find('textarea').val();

$.ajax({
url: '$this_router-verify',			
type: 'POST',
dataType: 'json',
cache: false,
data: ajax_parameters({id: verify_item_id, value: value, verified: verified, push_back_reason: reason}),
beforeSend: function(){
ajaxing({});
},
success: function(json){
ajaxing({action: 'hide'});
if(json.length){
for(var i in json){
$('#verify_'+ json[i]).parent().parent().remove();
}
if(value=='1' && sync_index_to_html){
$("#__reflash_index__").submit();
}				
p8_window.alert(lang_array(P8LANG.cms.item.you_verified, [json.length]));
}else{
p8_window.alert('{$P8LANG['fail']}');
}
}
});
},
show: function(){
this.content.html(verify_html);
this.content.find('#verify'+verify_item_value).prop('checked', true);
this.content.find('input[type=radio]').click(function(){
this.value == '-99' && this.checked ? $(this).parent().parent().find('div').show() : $(this).parent().parent().find('div').hide();
});
}
});

var verify_first_dialog = new P8_Dialog({
title_text: '{$P8LANG['cms_item']['verify_first']['']}',
width: 500,
height: 250,
button: true,
ok: function(){
var value = this.content.find('input[name=value]:checked').val();
var reason = this.content.find('textarea').val();

$.ajax({
url: '$this_router-verify_first',
type: 'POST',
dataType: 'json',
cache: false,
data: ajax_parameters({id: verify_item_id, value: value, verified: verified, push_back_reason: reason}),
beforeSend: function(){
ajaxing({});
},
success: function(json){
ajaxing({action: 'hide'});

for(var i in json){
$('#verify_'+ json[i]).parent().parent().remove();
}

p8_window.alert(lang_array(P8LANG.cms.item.you_verified, [json.length]));
}
});
},
show: function(){
this.content.html(verify_first_html);

this.content.find('input[type=radio]').click(function(){
this.value == '-99' && this.checked ? $(this).parent().parent().find('div').show() : $(this).parent().parent().find('div').hide();
});
}
});
var score_html = '';
EOT;
$__t_foreach = @$this_module->CONFIG['score_level'];
if(!empty($__t_foreach)){
foreach($__t_foreach as $status => $v){
print <<<EOT

score_html += '<span><input type="radio" id="score$status" name="value" value="$v[code]" /><label for="score$status">$v[name]</label> </span>';
EOT;
}
}

print <<<EOT

score_html += '<fieldset><legend style="font-size:14px;border:0;margin-bottom:5px;">{$P8LANG['cms_item']['score_reason']}</legend><textarea rows="5" cols="60"></textarea></fieldset>';

var verify_html = '';
var str_checked = '';
EOT;
$__t_foreach = @$this_module->CONFIG['verify_acl'];
if(!empty($__t_foreach)){
foreach($__t_foreach as $status => $v){
if(!$allow_verify && $status ==1) continue;
print <<<EOT

verify_html += '<span><input type="radio" id="verify$status" name="value" value="$status"/><label for="verify$status">$v[name]</label> </span>';
EOT;
}
}

print <<<EOT

verify_html += '<fieldset><legend style="font-size:14px;border:0;margin-bottom:5px;">{$P8LANG['cms_item']['verify']['reason']}</legend><textarea rows="5" cols="60"></textarea></fieldset>';

var verify_first_html = '';
EOT;
$__t_foreach = @$this_module->CONFIG['verify_acl'];
if(!empty($__t_foreach)){
foreach($__t_foreach as $status => $v){
if($status != 1){
print <<<EOT

verify_first_html += '<span><input type="radio" id="verify$status" name="value" value="$status" /><label for="verify$status">$v[name]</label> </span>';
EOT;
}
}
}

print <<<EOT

verify_first_html += '<fieldset><legend style="font-size:14px;border:0;margin-bottom:5px;">{$P8LANG['cms_item']['verify']['reason']}</legend><textarea rows="5" cols="60"></textarea></fieldset>';

var up_down_dialog = new P8_Dialog({
title_text: '{$P8LANG['cms_item']['list_order']['']}',
button: true,
width: 550,
height: 250,
ok: function(){
$.ajax({
url: '$this_router-list_order',
type: 'post',
dataType: 'json',
cache: false,
data: ajax_parameters({id: up_down_id, time: this.content.find('input').val()}),
beforeSend: function(){
ajaxing({});
},
success: function(json){
ajaxing({action: 'hide'});

request_item(PAGE);
}
});
},
show: function(){
this.content.html(up_down_html);
}
});

var _obj = new Date({$timestamp}000);
var _Y = _obj.getFullYear(),
_m = _obj.getMonth() +1,
_d = _obj.getDate(),
_H = _obj.getHours(),
_j = _obj.getDay();

function list_order_date(timestamp){
$('#list_order_input').val(date('Y-m-d H:i:s', timestamp));
}

function view_to_html(m){
$('#view_to_html').empty();

var ids = checked_values('id[]', $('#form'));
if(!ids.length) return;

$('#view_to_html').append($('<input type="hidden" name="id_range" value="'+ ids.join(',') +'" />'+

(m?'<input type="hidden" name="mobile" value="1"/>':''))).submit();
}

var up_down_html = '<div><input type="text" id="list_order_input" autocomplete="off" onclick="rcalendar(this, \\'full\\');">'+
'<input type="button" value="{$P8LANG['cms_item']['list_order']['up_to_1d']}" onclick="list_order_date(mktime(0, 0, 0, _m, _d +1, _Y))" /> '+
'<input type="button" value="{$P8LANG['cms_item']['list_order']['up_to_1w']}" onclick="list_order_date(mktime(0, 0, 0, _m, _d +7, _Y))" /> '+
'<input type="button" value="{$P8LANG['cms_item']['list_order']['up_to_1m']}" onclick="list_order_date(mktime(0, 0, 0, _m +1, _d, _Y))" /> '+
'<input type="button" value="{$P8LANG['cms_item']['list_order']['down_to_1d']}" onclick="list_order_date(mktime(0, 0, 0, _m, _d -1, _Y))" /> '+
'<input type="button" value="{$P8LANG['cms_item']['list_order']['down_to_1w']}" onclick="list_order_date(mktime(0, 0, 0, _m, _d -7, _Y))" /> '+
'<input type="button" value="{$P8LANG['cms_item']['list_order']['down_to_1m']}" onclick="list_order_date(mktime(0, 0, 0, _m -1, _d, _Y))" /> '+
'</div><div>{$P8LANG['cms_item']['list_order']['note']}</div>';
EOT;
if($clustered){
print <<<EOT

var push_items = [];
var c_CATEGORY_JSON = {};
var c_CATEGORY_PATH = {};
var c_CATEGORY_requested = false;

var push_dialog = new P8_Dialog({
title_text: '{$P8LANG['cms_item']['cluster_push']}',
button: true,
width: 700,
height: 500,
ok: function(){
var cid = push_cs.get_value();

push_item(push_items, cid);
}
});

var push_cs;

function _push_item(){
var array = checked_values('id[]', $('#form'));
var id = [];
$.each(array, function(k, v){
id.push(v.replace(/[^0-9]/g, ''));
});

if(!id.length) return false;

push_items = id;

push_dialog.show();

if(c_CATEGORY_requested) return;

$.ajax({
url: '$this_router-cluster_push',
dataType: 'json',
cache: false,
beforeSend: function(){
ajaxing({});
},
success: function(json){
ajaxing({action: 'hide'});

if(json === false){
p8_window.alert('{$P8LANG['cms_item']['cluster_setting_missing']}');
return;
}

c_CATEGORY_JSON = json.json;
c_CATEGORY_PATH = json.path;

c_CATEGORY_requested = true;

push_cs = new Recursive_Selector({
json: c_CATEGORY_JSON,
path: c_CATEGORY_PATH,
input: null,
sub_property: 'categories',
item_callback: function(cat, item){
if(cat.categories)
item.addClass('sub_category');
},
dialog: push_dialog
});

push_cs.init();
}
});
}
EOT;
}
if($sites_push){
print <<<EOT

var s_push_items = [];
var s_CATEGORY_JSON = {};
var s_CATEGORY_PATH = {};
var s_CATEGORY_requested = false;

var push_sites_dialog = new P8_Dialog({
title_text: '{$P8LANG['cms_item']['cluster_push']}',
button: true,
width: 700,
height: 500,
ok: function(){
var cid = push_cs_site.get_value();
var push_site = this.content.find('select').val();
var send_time_type = $('input[name=send_time_type]:checked',this.content).val();
var send_time = $('input[name=send_time]',this.content).val();
push_item_sites(s_push_items, cid, push_site, send_time_type, send_time);
}
});

var push_cs_site;

function _push_item_site(){
var array = checked_values('id[]', $('#form'));
var id = [];
$.each(array, function(k, v){
id.push(v.replace(/[^0-9]/g, ''));
});

if(!id.length) return false;

s_push_items = id;

push_sites_dialog.show();

if(s_CATEGORY_requested) return;

$.ajax({
url: '$this_router-sites_push',
dataType: 'json',
cache: false,
beforeSend: function(){
ajaxing({});
},
success: function(json){
ajaxing({action: 'hide'});

if(json === false){
p8_window.alert('{$P8LANG['cms_item']['cluster_setting_missing']}');
return;
}


s_CATEGORY_JSON = json.json;
s_CATEGORY_PATH = json.path;

s_CATEGORY_requested = true;

push_cs_site = new Recursive_Selector({
json: s_CATEGORY_JSON,
path: s_CATEGORY_PATH,
input: null,
sub_property: 'categories',
item_callback: function(cat, item){
if(cat.categories)
item.addClass('sub_category');
},
dialog: push_sites_dialog
});

push_cs_site.init();

sites = json.sites;
siteshtml = '<option value="" selected>所有站点</option>';
for(var i  in sites){
siteshtml+='<option value="'+sites[i].alias+'">'+sites[i].sitename+'</option>';
}
push_sites_dialog.content.append('<p style="height:250px;width:110px;padding-left:5px; float:right">发布时间设置<br/><br/><label><input type="radio" name="send_time_type" value="0" checked>原发布时间</label><br/><br/> <label><input type="radio" name="send_time_type" value="1">当前时间</label> <br/><br/><label><input type="radio" name="send_time_type" value="2">设置时间</label>:<br/><input type="text" name="send_time" style="width:100px" value="'+date('Y-m-d H:i:s')+'" autocomplete="off" onclick="rcalendar(this, \\'full\\')"/></p>');
push_sites_dialog.content.append('<select name="sites" style="height:360px;width:130px; float:right;border:1px solid #dcdcdc;" multiple>'+siteshtml+'</select>');
}
});
}
var selected_site = '$selected_site';
var matrix_sites = null;
var send_time_types = 0;
var push_to_sites_dialog = new P8_Dialog({
title_text: '推送数据<i class="pull-right" style="font-style: normal;color: red;">备注：先选择右边【站点】，再选择左边【对应栏目】</i>',
button: true,
width: 800,
height: 500,
ok: function(){
var cid = matrix_sites.get_value();
var push_site = this.content.find('select').val();
var send_time_type = $('input[name=send_time_type]:checked',this.content).val();
var send_time = $('input[name=send_time]',this.content).val();
cms_push_item_sites(s_push_items, cid, push_site, send_time_type, send_time);
},
show:function(){
this.content.html('<span id="select_plase">请选择分站</span>');
}
});
matrix_sites = new Recursive_Selector({
input: null,
dialog: push_to_sites_dialog,
sub_property: 'categories',
url: '{$this_system->controller}/../../s.php/'+selected_site+'/category-json?newsite='+selected_site,
value: 0,
init_callback: function(){
matrix_parent_path(this.get_value());
},
item_callback: function(cat, item){
if(cat.type == 1)
item.find('span').addClass('frame_category');

if(cat.categories)
item.addClass('sub_category');
},
change: function(select){
var cat = matrix_sites.get_by_id(select.data('value'));

if(MODEL && cat.model != MODEL && !cat.categories) p8_window.alert('你选了一个非本模型的分类');
}
});
function _push_to_site(){
var array = checked_values('id[]', $('#form'));
var id = [];
$.each(array, function(k, v){
id.push(v.replace(/[^0-9]/g, ''));
});

if(!id.length) return false;

s_push_items = id;

push_to_sites_dialog.show();

$.ajax({
url: '$this_router-cms_sites_push',
dataType: 'json',
cache: false,
beforeSend: function(){
ajaxing({});
},
success: function(json){
ajaxing({action: 'hide'});			
sites = json.sites;
SITE_HTML = '<option value="">请选择分站</option>';	
var sites_alias = '';
var sites_index = 0;
for(var i  in sites){			
SITE_HTML+='<option value="'+sites[i].alias+'">'+sites[i].sitename+'</option>';
if(sites_index == 0) sites_alias = sites[i].alias;
sites_index++;				
}
if(sites_alias) {
selected_site = sites_alias;
matrix_sites.init();				
}			

SITE_HTML ='<select name="sites" style="height:360px;width:130px; float:right;border: 1px solid #dcdcdc;" multiple onchange="show_site_category(this.value)">'+SITE_HTML+'</select>';
push_to_sites_dialog.content.append('<p style="height:250px;width:110px;padding-left:5px; float:right">发布时间设置<br/><br/><label><input type="radio" name="send_time_type" id="type_0" onclick="change_send_time_type(0)" value="0" checked>原发布时间</label><br/><br/> <label><input type="radio" name="send_time_type" id="type_1" onclick="change_send_time_type(1)" value="1">当前时间</label> <br/><br/><label><input type="radio" name="send_time_type" id="type_2" onclick="change_send_time_type(2)" value="2">设置时间</label>:<br/><input type="text" name="send_time" style="width:100px" value="'+date('Y-m-d H:i:s')+'" autocomplete="off" onclick="rcalendar(this, \\'full\\')"/></p>');
push_to_sites_dialog.content.append(SITE_HTML);
if(sites_alias){
$("select[name='sites']").find("option[value='"+selected_site+"']").attr("selected",true);
var select_plase = $('#select_plase').html();
if(select_plase != undefined) show_site_category(sites_alias);
}
},
});
}

//读子站栏目

function show_site_category(site){
var scrollTop = $("select[name='sites']").scrollTop();
if(!site) return false;
ajaxing({});
matrix_sites = new Recursive_Selector({
input: null,
dialog: push_to_sites_dialog,
sub_property: 'categories',
url: '{$this_system->controller}/../../s.php/'+site+'/category-json?newsite='+site,
value: 0,
init_callback: function(){
matrix_parent_path(this.get_value());
},
item_callback: function(cat, item){
if(cat.type == 1)
item.find('span').addClass('frame_category');

if(cat.categories)
item.addClass('sub_category');
},
});
matrix_sites.init();
ajaxing({action: 'hide'});
push_to_sites_dialog.content.append('<p style="height:250px;width:110px;padding-left:5px; float:right">发布时间设置<br/><br/><label><input type="radio" name="send_time_type" id="type_0" onclick="change_send_time_type(0)" value="0" checked>原发布时间</label><br/><br/> <label><input type="radio" name="send_time_type" id="type_1" onclick="change_send_time_type(1)" value="1">当前时间</label> <br/><br/><label><input type="radio" name="send_time_type" id="type_2" onclick="change_send_time_type(2)" value="2">设置时间</label>:<br/><input type="text" name="send_time" style="width:100px" value="'+date('Y-m-d H:i:s')+'" autocomplete="off" onclick="rcalendar(this, \\'full\\')"/></p>');
push_to_sites_dialog.content.append(SITE_HTML);	
$("select[name='sites']").scrollTop(scrollTop);
$("select[name='sites']").find("option[value='"+site+"']").attr("selected",true);
$("#type_"+send_time_types).attr("checked",true);	
}
function change_send_time_type(type){
send_time_types = type;
}
function matrix_parent_path(cid){
if(cid == 0){
$('#matrix_cid').html('');
return;
}

var tmp = matrix_cs.get_by_id(cid);
var html = '';

while(true){
if(typeof tmp == 'undefined')break;;
html = tmp.name +' &gt; '+ html;
if(tmp.parent == 0) break;

tmp = matrix_cs.get_by_id(tmp.parent);
}

$('#matrix_cid').html(html);
}
EOT;
}
if($allow_clone){
print <<<EOT


var clone_dialog = new P8_Dialog({
title_text: '{$P8LANG['cms_item']['clone']}',
button: true,
width: 700,
height: 500,
show: function(){
clone_cs.init();
},
ok: function(){

var cid = clone_cs.get_value();
if(!cid) return false;
$('#clone_cid').val(cid.join(','));
}
});
var clone_dialog_main = new P8_Dialog({
title_text: '{$P8LANG['cms_item']['clone']}',
button: true,
width: 360,
height: 240,
show: function(){
this.content.html('选择栏目：<input id="clone_cid" type="text" class="txt" value="" readonly/> <input type="button" value="选择" class="submit_btn" onclick="clone_dialog.show()"/><br/><br/>签发时间：<input type="radio" name="clone_type" value="1" checked>设置时间 :<input type="text" class="txt" style="width:130px;font-size:12px;" id="clone_time" value="'+date('Y-m-d H:i:s')+'" autocomplete="off" onclick="rcalendar(this, \\'full\\')"/><br/><span style="padding-left:60px"> <input type="radio" name="clone_type" value="0">原始发布时间</span>');
},
ok: function(){

var cid = clone_cs.get_value();
if(!cid) return false;

var cat = clone_cs.get_by_id(cid);

$.ajax({
url: '$this_router-clone',
type: 'post',
dataType: 'json',
cache: false,
data: ajax_parameters({sourceid: clone_item_id, cid: cid.join(','),clone_time:$('#clone_time').val(), verified: verified === undefined ? 1 : verified,clone_type:$('input[type=radio][name=clone_type]:checked').val()}),
beforeSend: function(){
ajaxing({});
},
success: function(json){				
ajaxing({action: 'hide'});
if(json.message){
//if(!confirm(json.message)) return;
p8_window.confirm(json.message, function (r) {
if(r){
$.ajax({
url: '$this_router-clone',
type: 'post',
dataType: 'json',
cache: false,
data: ajax_parameters({filter_word_enable:true,sourceid: clone_item_id, cid: cid.join(','),clone_time:$('#clone_time').val(), verified: verified === undefined ? 1 : verified,clone_type:$('input[type=radio][name=clone_type]:checked').val()}),
beforeSend: function(){
ajaxing({});
},
success: function(json){
if(json.length) 
p8_window.alert('{$P8LANG['done']}');
else
p8_window.alert('{$P8LANG['fail']}');
}
});
}else{
return;
}
});
}else{
p8_window.alert('{$P8LANG['done']}');
}
request_item(PAGE);
}
});
}

});
var clone_cs = new Recursive_Selector({
multiple: true,
input: $('#clone_cid'),
dialog: clone_dialog,
sub_property: 'categories',
url: '{$this_system->controller}/category-json',
item_callback: function(cat, item){
if(MODEL && cat.model != '$MODEL')
item.css({opacity: '0.3', alpha: '(opacity=30)'});

if(cat.type == 1){
item.find('span').addClass('frame_category');
item.find('input[type=checkbox]').attr('disabled', true);
}

if(cat.categories)
item.addClass('sub_category');
},
change: function(select){
var cat = cs.get_by_id(select.data('value'));

if(MODEL && cat.model != MODEL && !cat.categories) p8_window.alert('你选了一个非本模型的分类');
}
});

function clone_item(array){
clone_item_id = [];
$.each(array, function(k, v){
clone_item_id.push(v.replace(/[^0-9]/g, ''));
});

if(!clone_item_id.length) return false;

clone_dialog_main.show();
}
EOT;
}
print <<<EOT

function download(){
download_dialog.show();
}
$(function(){
request_item(1);
EOT;
if($cid){
print <<<EOT

category_filter.init();
EOT;
}
print <<<EOT

});
</script><div class="clear"></div>

</body>
</html>
EOT;
?>