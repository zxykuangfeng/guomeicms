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
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr><td>
<table class="formtable">
<tr>
<td class="headerbtn_list">
<ul>
<li><a href="$this_router-list"><i class="fa fa-list-ul"></i>信箱管理</a></li>
<li><a href="$this_router-config"><i class="fa fa-cog"></i>信箱设置</a></li>
<li><a href="$this_router-statistics"><i class="fa fa-bar-chart"></i>信箱统计</a></li>
<li><a href="{$this_module->controller}-post" target="_blank"><i class="fa fa-paper-plane-o"></i>前台信箱入口</a></li>
<li><a href="{$this_module->controller}-list" target="_blank"><i class="fa fa-list-ul"></i>前台信箱列表</a></li>
<li><a href="{$core->U_controller}/letter-manager" target="_blank"><i class="fa fa-gears"></i>信件会员中心管理</a></li>
</ul>
</td>
</tr>
</table>

</td></tr>
</table>
</div>
</div><div class="mainbox mainborder">
<div class="section">
<form name="form" id="searchFrom" action="" method="post">
<table class="columntable formtable">
<tr class="title fix_head">
<td class="title">{$P8LANG['search']}</td>
</tr>
<tr>
<td align="center">			
信件来源： <select name="source">
<option value="">全部</option>
<option value="1" 
EOT;
if($source==1){
print <<<EOT
selected
EOT;
}
print <<<EOT
>在线</option>
<option value="2" 
EOT;
if($source==2){
print <<<EOT
selected
EOT;
}
print <<<EOT
>邮箱</option>
<option value="3" 
EOT;
if($source==3){
print <<<EOT
selected
EOT;
}
print <<<EOT
>电话</option>
</select>
问题编号：<input name="number" value="$number" type="text" class="txt" /> 
关键词：<input name="word" value="$word" type="text" class="txt" /> 
解决人：<input name="solve_name" value="$solve_name" type="text" class="txt" /> 
部门: 
EOT;
if($select_size>=2){
for($i=0;$i<$select_size;$i++){
$this_value = empty($data_field[$i])? '' : $data_field[$i];
if($i==0){
$selectdata = $select_data;
}elseif($data_field){
$selectdata = (empty($selectdata[$data_field[$i-1]])? array() : $selectdata[$data_field[$i-1]]['s']);
}else{
$selectdata = array();
}
$inputname = $select_size-1==$i?'department':'parent_department';
print <<<EOT

<select name="$inputname" id="department" onchange="department_select.change(this)">
<option value="">--请选择--</option>
EOT;
$__t_foreach = @$selectdata;
if(!empty($__t_foreach)){
foreach($__t_foreach as $key => $value){
print <<<EOT

<option value="{$value['i']}" 
EOT;
if($this_value==$key){
print <<<EOT
selected
EOT;
}
print <<<EOT
>{$value['n']}</option>
EOT;
}
}

print <<<EOT

</select>
EOT;
}
print <<<EOT
							
<script type="text/javascript">
var department_select = {
CAT : {$select_json_data},
change : function (obj){
var shtml = dhtml = '<option value="">--请选择--</option>';
var thisv = $(obj).val();
$(obj).nextAll('select').html(dhtml);
if(!thisv){
return false;
}
var path = thisv.split('-');
var temp = this.CAT;
if(path.length==1)
temp=this.CAT[path]['s'];
else{
for (var k in path)
temp = temp[path[k]]['s'];
}
if(temp !=''){
for(var j in temp)
shtml += '<option value="'+temp[j]['i']+'">'+temp[j]['n']+'</option>';	
$(obj).next().html(shtml);	
}}}
</script>
EOT;
}else{
print <<<EOT

<select name="department" id="department">
<option value="">请选择</option>
EOT;
$__t_foreach = @$cates['department'];
if(!empty($__t_foreach)){
foreach($__t_foreach as $key => $row){
print <<<EOT

<option value="{$row['id']}" 
EOT;
if(!empty($data['department']) && $data['department']==$row['id']){
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
EOT;
}
print <<<EOT

每页条数:
<select name="page_size">
<option value="20" 
EOT;
if($page_size == 20){
print <<<EOT
selected
EOT;
}
print <<<EOT
>20</option>
<option value="50" 
EOT;
if($page_size == 50){
print <<<EOT
selected
EOT;
}
print <<<EOT
>50</option>
<option value="100" 
EOT;
if($page_size == 100){
print <<<EOT
selected
EOT;
}
print <<<EOT
>100</option>
<option value="300" 
EOT;
if($page_size == 300){
print <<<EOT
selected
EOT;
}
print <<<EOT
>300</option>
<option value="500" 
EOT;
if($page_size == 500){
print <<<EOT
selected
EOT;
}
print <<<EOT
>500</option>
</select>
<input type="hidden" name="act" value="search"/>
<input type="submit" value="{$P8LANG['search']}" class="submit"/>
</td>
</tr>
</table>
</form>
</div>
</div>
<div class="mainbox mainborder">
<div class="section">	
<table width="100%" border="0"  class="mainbox">
<tr>
<td>
<ul class="boxmenu">
<li id="status_0" class="$class[0] btn-color1"><a href="$this_router-list?status=0"><i class="icon icon-ico14"></i>待审核</a></li>
<li id="status_0" class="$class[2] btn-color2"><a href="$this_router-list?status=2"><i class="icon icon-ico24"></i>已受理</a></li>
<li id="status_0" class="$class[3] btn-color3"><a href="$this_router-list?status=3"><i class="icon icon-ico40"></i>处理完结</a></li>
<li class="btn-color5"><a href="{$core->U_controller}/letter-manager" target="_blank"><i class="icon icon-ico35"></i>信件会员中心管理</a></li>
<li class="course pull-right"><a href="{$RESOURCE}/attachment/jiaocheng/xinxiangshezhi.pdf" target="_blank" style="color:#c00;"><img src="{$RESOURCE}/skin/admin/help_icon.gif" class="helpicon"> 信箱管理教程>></a></li>
</ul>
</td>
</tr>
</table>
<form name="forms" id="form" action="$this_url" method="post">
<table class="columntable formtable hover_table click_changeable" width="100%" style="text-align:center" >
<tr bgcolor="#eeeeee" class="title">
<td width="2%"><input type="checkbox" name="check_all" onclick="check_item(this,'id[]', $('#form'))" /></td>
<td width="8%">ID</td>
<td width="8%">编号</td>
<td width="7%">状态</td>
<td width="7%">推荐</td>
<td width="*">标题</td>
<td width="8%">部门/类型</td>
<td width="7%">显示标题</td>
<td width="7%">公开内容</td>				
<td width="11%">提问时间</td>
<td width="11%">解决时间</td>
<td width="11%">操作</td>
</tr>
EOT;
$__t_foreach = @$list;
if(!empty($__t_foreach)){
foreach($__t_foreach as $k => $v){
print <<<EOT

<tr id="item_$v[id]">
<td><input type="checkbox" name="id[]" value="$v[id]" /></td>					
<td>$v[id]</td>
<td>$v[number]</td>
<td>
EOT;
if($v['status']==0){
print <<<EOT

{$P8LANG['status_0']}
EOT;
}elseif($v['status']==3){
print <<<EOT

{$P8LANG['status_3']}
EOT;
}else{
print <<<EOT

{$P8LANG['status_1']}
EOT;
}
print <<<EOT

</td>
<td>
EOT;
if($v[recommend]){
print <<<EOT
推荐
EOT;
}else{
print <<<EOT
不推荐
EOT;
}
print <<<EOT
</td>
<td><a href="{$this_module->controller}-view-id-{$v['id']}" target="_blank">$v[title]</a></td>
<td>{$cates_departments[$v['department']]['name']}/{$cates['type'][$v['type']]['name']}</td>
<td>
EOT;
if($v['undisplay']){
print <<<EOT
不显示
EOT;
}else{
print <<<EOT
公开显示
EOT;
}
print <<<EOT
</td>
<td>
EOT;
if($v['visual']){
print <<<EOT
公开
EOT;
}else{
print <<<EOT
不公开
EOT;
}
print <<<EOT
</td>				
<td>
EOT;
echo date("Y-m-d H:i:s",$v['create_time']);
print <<<EOT

</td>
<td>
EOT;
if($v['solve_time']) echo date("Y-m-d H:i:s",$v['solve_time']);
print <<<EOT

</td>
<td>
<a href="{$this_module->controller}-view-id-{$v['id']}" target="_blank">查看</a> / 
<a href="{$this_module->controller}-vefify?id={$v['id']}"  target="_blank">审核</a> / 
<a href="javascript:void(0)" onclick="deleteitem($v[id]);return false">删除</a></td>
</tr>
EOT;
}
}

print <<<EOT

<tr>
<td colspan="12" class="pages">{$pages}</td>
</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="foot_btn">			
<tr>
<td>
<a href="javascript:void(0)" onclick="check_all(true,'id[]',$('#form'))">全选</a> /
<a href="javascript:void(0)" onclick="check_all(false,'id[]',$('#form'));">反选</a>
<input type="button" class="submit_btn" value="删除" onclick="deleteitem()" />
</td>
</tr>
</table>
</form>
</div>
</div>
<script type="text/javascript">
function printthis(){
$('#searchFrom input[name="act"]').val('print');
$('#searchFrom').attr('target','_blank').submit();
}
function searchthis(){
$('#searchFrom input[name="act"]').val('search');
$('#searchFrom').attr('target','_self').submit();
}
function check_ids(){
var ids=[];
$.each(checked_values('id[]'), function(k, v){
ids.push(v.replace(/[^0-9]/g, ''));
});
if(ids.length<1)return false;
return true;	
}
function deleteitem(id){	
if(id == undefined){	
if(!check_ids())return;
}

p8_window.confirm('{$P8LANG['confirm_to_delete']}', function (r) {
if(r){
$.ajax({
url: '$this_router-delete',
type: 'POST',
dataType: 'json',
data: $('#form').serialize()+'&oid='+id,
beforeSend: function(){
ajaxing({});
},
success: function(json){
ajaxing({action: 'hide'});
for(var i in json){
$('#item_'+json[i]).remove();
}
}
});
}else{
return;
}
});	
}
</script>
EOT;
?>