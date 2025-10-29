<?php
defined('PHP168_PATH') or die();

$LABEL = &$core->load_module('label');
global $__label;
if(!isset($LABEL_POSTFIX))global $LABEL_POSTFIX;
 if(!$SYSTEM)global $SYSTEM; if(!$MODULE)global $MODULE; if(!$SITENAME)global $SITENAME; if(!$ENV)global $ENV; if(!$LABEL_PAGE)global $LABEL_PAGE; $LABEL->init($SYSTEM, $MODULE, $LABEL_PAGE, $SITENAME, $ENV);
$LABEL->postfix(isset($LABEL_POSTFIX) ? $LABEL_POSTFIX : array());
$LABEL->get_data_cache();
$__label = array();
$__label['letter_detail_top'] = $LABEL->display('letter_detail_top');
$__label_empty = true;
foreach($__label as $__label_key => $__label_value){
if($__label_value) {$__label_empty = false;break;}
}
if($__label_empty){
$LABEL->cache();
$LABEL->cache_data();$LABEL->postfix(isset($LABEL_POSTFIX) ? $LABEL_POSTFIX : array());
$LABEL->get_data_cache();
$__label['letter_detail_top'] = $LABEL->display('letter_detail_top');
}
$LABEL->refresh_labels();
?>
<?php
print <<<EOT
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=2.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="renderer" content="webkit">
<title>领导信箱</title>
<meta content="领导信箱" name="keywords">
<meta content="领导信箱" name="description">
<link href="{$RESOURCE}/skin/sites/common/css/bootstrap.min.css" type="text/css"  rel="stylesheet" >
<link rel="stylesheet" type="text/css" href="{$RESOURCE}/skin/default/core/letter/style.css" />
<script type="text/javascript" src="{$RESOURCE}/skin/sites/common/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="{$RESOURCE}/skin/sites/common/js/bootstrap.min.js"></script>
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
</head>
<body>
<div id="letter">
<div class="header mb20">
<div class="container relative clearfix">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
<div class="letter-detail-title text-center">
<img src="{$RESOURCE}/skin/default/core/letter/letter-state.png"/>信件状态
</div>
<div class="hlogin">
<div class="topmember" id="header_t">
{$__label['letter_detail_top']}
EOT;
if($IS_ADMIN){
print <<<EOT

<span id="labelshow">[显示标签]</span>
<script type="text/javascript">
LABEL_URL = location.href;
if(LABEL_URL.indexOf('edit_label')==-1){
var ls='?';
if(LABEL_URL.indexOf('?')>-1)ls='&';
LABEL_URL=LABEL_URL+ls+'edit_label=1';
$('#labelshow').html('<a href='+LABEL_URL+' id="edit_label">[显示标签]</a>');
}else{
LABEL_URL=LABEL_URL.replace('&edit_label=1','');
LABEL_URL=LABEL_URL.replace('edit_label=1','');
$('#labelshow').html('<a href='+LABEL_URL+' >[隐藏标签]</a>');
}
</script>
EOT;
}
print <<<EOT

</div>
</div>
</div>
</div>
</div>
</div>
<div class="container">
<div class="letter-outer">
<div class="bar2 clearfix"><span class="tt2">信息查询结果</div>
<table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;" class="letter-detail-table">
<tr>
<td class="tdL">编号:</td>
<td class="tdR">{$data['number']}</td>
</tr>
<tr>
<td class="tdL">提交人</td>
<td class="tdR">{$data['username']}</td>
</tr>
<tr>
<td class="tdL">当前状态:</td>
<td class="tdR"><strong>{$P8LANG['status_'.$data['status']]}</strong></td>
</tr>
<tr>
<td class="tdL">内容:</td>
<td class="tdR">{$data['data'][0]['content']}</td>
</tr>
<tr >
<td class="tdL">处理结果:</td>
<td class="tdR">
EOT;
if(!empty($data['data'][0]['reply'])){
print <<<EOT
{$data['data'][0]['reply']}
EOT;
}
print <<<EOT
<br/><br/><br/></td>
</tr>
<tr>
<td class="tdL">处理部门:</td>
<td class="tdR">
EOT;
if(!empty($data['solve_department'])){
print <<<EOT
{$cates['department'][$data['solve_department']]['name']}
EOT;
}
print <<<EOT
</td>
</tr>
<tr>
<td class="tdL">处理人</td>
<td class="tdR">{$data['solve_name']}</td>
</tr>
</table>
<div style="margin-top:20px"></div>
</div>
EOT;
if($data['status']==3){
print <<<EOT

<div class="botline">信访人的评价:<span>
EOT;
if($isposter && !$data['comment']){
print <<<EOT

<a href="javascript:;" onclick="dialog.show()">还没评价,点击这里进行评价</a>
<script type="text/javascript">
var dialog = new P8_Dialog({
title_text: '评价',
button: true,
zIndex:10000,
width: 400,
height: 180,
ok:function(){
$('#common_form').submit();
}
});
shtml ='<form id="common_form" action="" method="post"><input type="hidden" name="id" value="{$data[id]}" /><input type="hidden" name="snumber" value="{$data[code]}" /><div style="padding:10px">你对本次信访的评价是：
EOT;
$__t_foreach = @$comments;
if(!empty($__t_foreach)){
foreach($__t_foreach as $ck => $com){
print <<<EOT
&nbsp;<input type="radio" name="common" value="$ck"/>$com
EOT;
}
}

print <<<EOT
</div></form>';
dialog.content.html(shtml);

</script>
EOT;
}elseif(!$data['comment']){
print <<<EOT

还没评价
EOT;
}else{
print <<<EOT

{$comments[$data['comment']]}
EOT;
}
print <<<EOT

</span></div>
<div style="margin-top:20px"></div>
EOT;
}
print <<<EOT

</div>
</div>
</body>
</html>
EOT;
?>
<?php
if(P8_EDIT_LABEL && !defined('P8_GENERATE_HTML')) echo "<script type=\"text/javascript\">\$(document).ready(function(){\$('.label').each(function(){\$(this).hover(function(){\$(this).css({'opacity':'0.8','filter':'alpha(opacity=80)'});}, function(){\$(this).css({'opacity':'0.4','filter':'alpha(opacity=40)'});}).resizable().dblclick(function(){window.open('{$core->admin_controller}/core/label-update?system=$SYSTEM&module=$MODULE&site=$SITENAME&env=$ENV&place_holder_width='+ \$(this).width() +'&place_holder_height='+ \$(this).height() +'&id='+ this.id.replace(/[^0-9]/g, '') +'&postfix=". (empty($_GET['postfix']) ? (empty($LABEL->last_postfix) ? '' : $LABEL->last_postfix) : $_GET['postfix']) ."&name='+ encodeURIComponent($('span', this).html()) +'&from_js=1&page=". $LABEL_PAGE ."&_referer='+ encodeURIComponent(window.location.href));}).bind('contextmenu', function(){window.open('{$core->admin_controller}/core/label-add?system=$SYSTEM&module=$MODULE&site=$SITENAME&env=$ENV&place_holder_width='+ \$(this).width() +'&place_holder_height='+ \$(this).height() +'&postfix=". (empty($_GET['postfix']) ? (empty($LABEL->last_postfix) ? '' : $LABEL->last_postfix) : $_GET['postfix']) ."&name='+ encodeURIComponent($('span', this).html()) +'&from_js=1&_referer='+ encodeURIComponent(window.location.href));return false;});});});</script>";
?>