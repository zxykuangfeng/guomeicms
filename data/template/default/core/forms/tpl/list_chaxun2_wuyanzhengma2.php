<?php
defined('PHP168_PATH') or die();

$LABEL = &$core->load_module('label');
global $__label;
if(!isset($LABEL_POSTFIX))global $LABEL_POSTFIX;
 if(!$SYSTEM)global $SYSTEM; if(!$MODULE)global $MODULE; if(!$SITENAME)global $SITENAME; if(!$ENV)global $ENV; if(!$LABEL_PAGE)global $LABEL_PAGE; $LABEL->init($SYSTEM, $MODULE, $LABEL_PAGE, $SITENAME, $ENV);
$LABEL->postfix(isset($LABEL_POSTFIX) ? $LABEL_POSTFIX : array());
$LABEL->get_data_cache();
$__label = array();
$__label['forms_luqu_banner'] = $LABEL->display('forms_luqu_banner');
$__label['forms_luqu_pic1'] = $LABEL->display('forms_luqu_pic1');
$__label['forms_luqu_logo'] = $LABEL->display('forms_luqu_logo');
$__label['forms_head_link'] = $LABEL->display('forms_head_link');
$__label['forms_luqu_box1_tt1'] = $LABEL->display('forms_luqu_box1_tt1');
$__label['forms_lupu_box1_more1'] = $LABEL->display('forms_lupu_box1_more1');
$__label['luqu2'] = $LABEL->display('luqu2');
$__label['luqu1'] = $LABEL->display('luqu1');
$__label['luqu_btn'] = $LABEL->display('luqu_btn');
$__label['luqu3'] = $LABEL->display('luqu3');
$__label_empty = true;
foreach($__label as $__label_key => $__label_value){
if($__label_value) {$__label_empty = false;break;}
}
if($__label_empty){
$LABEL->cache();
$LABEL->cache_data();$LABEL->postfix(isset($LABEL_POSTFIX) ? $LABEL_POSTFIX : array());
$LABEL->get_data_cache();
$__label['forms_luqu_banner'] = $LABEL->display('forms_luqu_banner');
$__label['forms_luqu_pic1'] = $LABEL->display('forms_luqu_pic1');
$__label['forms_luqu_logo'] = $LABEL->display('forms_luqu_logo');
$__label['forms_head_link'] = $LABEL->display('forms_head_link');
$__label['forms_luqu_box1_tt1'] = $LABEL->display('forms_luqu_box1_tt1');
$__label['forms_lupu_box1_more1'] = $LABEL->display('forms_lupu_box1_more1');
$__label['luqu2'] = $LABEL->display('luqu2');
$__label['luqu1'] = $LABEL->display('luqu1');
$__label['luqu_btn'] = $LABEL->display('luqu_btn');
$__label['luqu3'] = $LABEL->display('luqu3');
}
$LABEL->refresh_labels();
?>
<?php
print <<<EOT
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>录取查询平台</title>
<link href="{$RESOURCE}/skin/sites/common/css/bootstrap.min.css" type="text/css"  rel="stylesheet" >
<link rel="stylesheet" type="text/css" href="{$RESOURCE}/skin/default/core/forms/query/style.css" />
<script type="text/javascript" src="{$RESOURCE}/js/config.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/util.js"></script>
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
<style>
#chaxun2{position:relative;background-color:#e6f8ff;}
#chaxun2 .wrap_out{background:#fff;padding:15px 12px;position:relative;}
#chaxun2 .container{width:auto;max-width:1000px;}
.channel_item_input{width:80%;}
.p8_win_layer { display: none; }
.p8_mask_layer { position: fixed; width: 100%; height: 100%; z-index: 99998; top: 0px; left: 0px; }
.p8_win_panel { position: fixed; z-index: 99999; top: 50%; left: 50%; border:1px solid #48AEE0; background:#82D1F8;padding:3px; border-radius: 4px;}
.p8_win_panel .title-panel { position: absolute; height: 36px; width: 100%; border-radius: 4px 4px 0 0; }
.p8_win_panel .title {color:#000; font-size:14px; font-family:"宋体", Arial, Times; text-align:left; line-height:120%; background:#fff; }
.p8_win_panel h3 { font-size: 14px; margin: 0;font-weight:700; }
.p8_win_panel .close-btn { display: block; text-align: center; vertical-align: middle; position: absolute; width: 36px; height: 36px; line-height: 36px; right: 0px; text-decoration: none; font-size: 24px; color: black; background-color: #DBDBDB; border-radius: 2px; z-index: 1; }
.p8_win_panel .close-btn:hover { background-color: #ccc; }
.p8_win_panel .body-panel {background:#fff;padding:15px;}
.p8_win_panel .content, .p8_win_panel .btns { text-align: center; }
.p8_win_panel .content { padding: 18px 5px 5px 5px; font-size: 14px; min-height: 44px; line-height: 22px; }
.p8_win_panel .btns .cancel{width:62px;height:28px; background:url(cancel.jpg) no-repeat; color:#fff; border:none; margin-left:10px; margin-bottom:2px;  cursor:pointer;letter-spacing:1px;}
.p8_win_panel .btns .ok{border:1px solid #eea236;background:#f0ad4e;color:#fff;width:62px;height:28px; margin-left:10px; margin-bottom:2px;  cursor:pointer}
@media (max-width: 480px){
.channel_item_title.luqu,.channel_item_input{width:100%;}
.p8_win_panel{width:280px !important;margin-left:-140px !important;}
}
</style>
</head>
<script type="text/javascript" src="{$RESOURCE}/js/jq_validator.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/upload.js"></script>
<script type="text/javascript" src="{$RESOURCE}/js/core/label/label.js"></script>
<script type="text/javascript">
var p8_window = new function () {
this.width = 494;
this.height = 152;
this.close = function () {
$('.p8_win_layer iframe').remove();
$('.p8_win_layer').remove();
};

function messageBox(html,message) {
p8_window.close();
let jq = $(html);
jq.find(".p8_win_panel").height(p8_window.height).width(p8_window.width).css("margin-left", -p8_window.width / 2).css("margin-top", -p8_window.height / 2);
//jq.find(".title-panel").height(p8_window.height);
jq.find(".title").find(":header").html(P8LANG.system_box_title);
jq.find(".body-panel").height(p8_window.height - 30);
jq.find(".content").html(message.replace('\\r\\n', '<br/>'));
jq.appendTo('body').show();
$(".p8_win_layer .w-btn:first").focus();
}

this.confirm = function (message,selected) {
this._close = function (r) {
this.close();
if ($.isFunction(selected)) selected(r);
};
let html = '<div class="p8_win_layer"><div class="p8_mask_layer"></div><div class="p8_win_panel"><iframe class="title-panel" frameborder="0" marginheight="0" marginwidth="0" scrolling="no"></iframe><div class="body-panel"><div class="title"><h3></h3></div><p class="content"></p><p class="btns"><button class="ok" tabindex="1" onclick="p8_window._close(true);">确定</button><button class="cancel" onclick="p8_window._close(false);">取消</button></p></div></div></div>';	
messageBox(html, message);
};

this.alert = function (message, closed) {
this._close = function () {
this.close();
if ($.isFunction(closed)) closed();
};
let html = '<div class="p8_win_layer"><div class="p8_mask_layer"></div><div class="p8_win_panel"><iframe class="title-panel" frameborder="0" marginheight="0" marginwidth="0" scrolling="no"></iframe><div class="body-panel"><div class="title"><h3></h3></div><p class="content"></p><p class="btns"><button class="ok" tabindex="1" onclick="p8_window._close();">关闭</button></p></div></div></div>';
messageBox(html, message);
}
};
</script>
<body id="chaxun2">
<div class="banner">{$__label['forms_luqu_banner']}</div>
<div class="container">
<div class="header">
<div class="pic">{$__label['forms_luqu_pic1']}</div>
<div class="logo">{$__label['forms_luqu_logo']}</div>
<div class="forms-label" id="header_t" style="position: absolute;right:0;top:15px;">
{$__label['forms_head_link']}
</div>
</div>
</div>
<div class="container">
<div class="wrap_out">
<div class="cx_table">
<div class="cx_header">
<div class="head">
<div class="title">{$__label['forms_luqu_box1_tt1']}</div>
<div class="more">{$__label['forms_lupu_box1_more1']}</div>
</div>
<div class="notice_luqu">
{$__label['luqu2']}
</div>
</div>
<div class="bm_middle">
<div class="tb luqu">
<form  name="request" id="form" action="$this_url" method="get" onsubmit="search_item(1);return false;">
<table class="formtable">
<tr><td class="headerbtn_list" style="border:0;">
EOT;
$__t_foreach = @$this_model['filterable_fields'];
if(!empty($__t_foreach)){
foreach($__t_foreach as $field => $field_data){
print <<<EOT

<div class="channel_item">
<div class="channel_item_title luqu">{$field_data['alias']}:</div>
<div class="channel_item_input luqu">
EOT;
include template($core, 'widget/'. $field_data['widget'], 'default');
print <<<EOT
</div>
</div>
<div class="clearfix"></div>
EOT;
}
}
if($this_model['CONFIG']['mobile_search_captcha']){
print <<<EOT

<div class="channel_item">
<div class="channel_item_title luqu">手机号码 :</div>
<div class="channel_item_input luqu"><input type="text" class="txt" style="width:180px;border: 1px solid #e1eaf4;" id="checkphone" value="" name="phone" onfocus="if (value =='输入手机号'){value =''}" onblur="if (value ==''){value='输入手机号'}"/> </div>
</div>
<div class="clearfix"></div>
<div class="channel_item">
<div class="channel_item_title luqu">手机验证码:</div>
<div class="channel_item_input luqu">																									
<input type="text" class="txt" style="width:80px;border: 1px solid #e1eaf4;" id="checkcode" value="" name="checkcode" />&nbsp;&nbsp;<span><img id="p8_sendsms" style="height:28px;" src="{$RESOURCE}/images/dtyzm.gif" /></span><span id="sms_msg"></span>
<script type="text/javascript">
$(document).ready(function(){
$("#p8_sendsms").click(function(){
var checkphone = $('#checkphone').val();console.log(checkphone.length);
if(checkphone.length == 11){
$.ajax({
url: '{$this_router}-checksms',
type: 'post',
dataType: 'json',
cache: false,
data: ajax_parameters({phone: checkphone}),
beforeSend: function(){
ajaxing({});
},
success: function(json){
ajaxing({action: 'hide'});
if(json=='OK')
p8_window.alert('手机短信发送成功！');
else
p8_window.alert('发送失败！'+json);
}
});
}else{
p8_window.alert('请输入正确的手机号码！');
}
})
})
</script>												
</div>
</div>
<div class="clearfix"></div>											
EOT;
}
if($this_model['CONFIG']['captcha']){
print <<<EOT
										
<div class="channel_item">
<div class="channel_item_title luqu">验证码:</div>
<div class="channel_item_input luqu"><input type="text" class="txt" name="captcha" style="border:#e1eaf4 1px solid;width:80px;" /> <span id="captcha"></span><span class="jsregmsg" style="color:#999;font-size:12px;">（点击左框显示验证码 / 点击验证码可更新）</span></div>
</div>
<script type="text/javascript">
captcha($('#captcha'), $('#form input[name="captcha"]'));
</script>	
EOT;
}
print <<<EOT

</td>
</tr>
</table>
<div class="zhushi">{$__label['luqu1']}</div>
<div class="form_submit">
<input type="button" class="forms_btn1" value="提交" onclick="search_item(1)">
<input type="reset" name="" class="forms_btn1" value="重填" />
<input type="hidden" name="mid" value="$mid" />
<input type="hidden" name="accurate" value="1" />
<input type="hidden" name="ids" value="" />
<div class="forms_btn2">{$__label['luqu_btn']}</div>
</div>
</form>
</div>						
<div class="notice_luqu" style="display:none;">
<p style="text-align:center;font-size:18px;background: #eef7ff none repeat scroll 0 0;border: 1px solid #bed8f3;height:40px;line-height:40px;font-weight:bold;">录取结果</p>
</div>
<div id="list"></div>
</div>
</div>
</div>
</div>
<div class="container">
<div class="footer_info">
{$__label['luqu3']}
</div>
</div>
</body>
<script type="text/javascript">
init_labelshows('header_t');
var PAGE;
var p8_window = new function () {
this.width = 494;
this.height = 152;
this.close = function () {
$('.p8_win_layer iframe').remove();
$('.p8_win_layer').remove();
};
function messageBox(html,message) {
p8_window.close();
let jq = $(html);
jq.find(".p8_win_panel").height(p8_window.height).width(p8_window.width).css("margin-left", -p8_window.width / 2).css("margin-top", -p8_window.height / 2);
//jq.find(".title-panel").height(p8_window.height);
jq.find(".title").find(":header").html(P8LANG.system_box_title);
jq.find(".body-panel").height(p8_window.height - 30);
jq.find(".content").html(message.replace('\\r\\n', '<br/>'));
jq.appendTo('body').show();
$(".p8_win_layer .w-btn:first").focus();
}
this.alert = function (message, closed) {
this._close = function () {
this.close();
if ($.isFunction(closed)) closed();
};
let html = '<div class="p8_win_layer"><div class="p8_mask_layer"></div><div class="p8_win_panel"><iframe class="title-panel" frameborder="0" marginheight="0" marginwidth="0" scrolling="no"></iframe><div class="body-panel"><div class="title"><h3></h3></div><p class="content"></p><p class="btns"><button class="ok" tabindex="1" onclick="p8_window._close();">关闭</button></p></div></div></div>';
messageBox(html, message);
}
};
function search_item(page){
var preg_pass = 1;
$("input[name^='field']").each(function(){
if($(this).val() == ''){
p8_window.alert('所有选项必填或必选！');preg_pass = 0;				
}
});
if(!preg_pass) return false;
if($('#checkcode').val() == ''){
p8_window.alert('请输入手机验证码！');		
}
$('#list').empty();
$('#pages').empty();
$.ajax({
url: '$this_url-mid-$mid',
data: $('#form').serialize() +'&page='+ (page === undefined ? 1 : page),
dataType: 'json',
cache: false,		
success: function(json){
PAGE = page;
$('#list').empty();
$('#pages').empty();
$('#captcha_msg').empty();
$('#sms_msg').empty();
if(json.message){
if(json.type == 'sms') 
p8_window.alert('手机校验码不正确！！');
else
$('#captcha_msg').html('<b style="color:red">&nbsp;不正确，请刷新！</b>');
}else{
if(json.list.length){
$('.notice_luqu').show();
for(var i in json.list){
_list_item(json.list[i]);
}
$('#pages').html(json.pages);												
window.scrollTo(0, 0);					
}else{				
$('#list').append($('<div style="text-align:center;">输入的查询信息有误！</div>'));
p8_window.alert('输入的查询信息有误！');
}
}
}
});
}

function _list_item(json){
var tr = '<div style="margin:15px auto;width:90%;padding:20px;">'+
'<table cellpadding="0" cellspacing="0" class="pop_table">'+
'<tr>'+
EOT;
$__t_foreach = @$this_model['list_table_fields'];
if(!empty($__t_foreach)){
foreach($__t_foreach as $field => $field_data){
print <<<EOT

'<td class="tdL2" style="text-align:center;">$field_data[alias]</td>'+
EOT;
}
}

print <<<EOT

'</tr>'+
'<tr>'+
EOT;
$__t_foreach = @$this_model['list_table_fields'];
if(!empty($__t_foreach)){
foreach($__t_foreach as $field => $field_data){
print <<<EOT

'<td class="tdR2" style="text-align:center;">'+(json.{$field}?json.{$field}:'')+'</td>'+
EOT;
}
}

print <<<EOT

'</tr>'+
'</table>'+
'</div>';

$('#list').append($(tr));
}
$(function(){
EOT;
if(empty($this_model['CONFIG']['parts'])){
print <<<EOT
	   
$('.pop_table tr:even').addClass('pop_tr');	
EOT;
}
print <<<EOT

})
</script>
EOT;
?>
<?php
if(P8_EDIT_LABEL && !defined('P8_GENERATE_HTML')) echo "<script type=\"text/javascript\">\$(document).ready(function(){\$('.label').each(function(){\$(this).hover(function(){\$(this).css({'opacity':'0.8','filter':'alpha(opacity=80)'});}, function(){\$(this).css({'opacity':'0.4','filter':'alpha(opacity=40)'});}).resizable().dblclick(function(){window.open('{$core->admin_controller}/core/label-update?system=$SYSTEM&module=$MODULE&site=$SITENAME&env=$ENV&place_holder_width='+ \$(this).width() +'&place_holder_height='+ \$(this).height() +'&id='+ this.id.replace(/[^0-9]/g, '') +'&postfix=". (empty($_GET['postfix']) ? (empty($LABEL->last_postfix) ? '' : $LABEL->last_postfix) : $_GET['postfix']) ."&name='+ encodeURIComponent($('span', this).html()) +'&from_js=1&page=". $LABEL_PAGE ."&_referer='+ encodeURIComponent(window.location.href));}).bind('contextmenu', function(){window.open('{$core->admin_controller}/core/label-add?system=$SYSTEM&module=$MODULE&site=$SITENAME&env=$ENV&place_holder_width='+ \$(this).width() +'&place_holder_height='+ \$(this).height() +'&postfix=". (empty($_GET['postfix']) ? (empty($LABEL->last_postfix) ? '' : $LABEL->last_postfix) : $_GET['postfix']) ."&name='+ encodeURIComponent($('span', this).html()) +'&from_js=1&_referer='+ encodeURIComponent(window.location.href));return false;});});});</script>";
?>