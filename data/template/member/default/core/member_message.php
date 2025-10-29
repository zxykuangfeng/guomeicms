<?php
defined('PHP168_PATH') or die();
?>
<?php
print <<<EOT
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<title>{$P8LANG['prompt_message']}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="X-Csrf-Token" content="{$CSRF_TOKEN}">
<script type="text/javascript" src="{$RESOURCE}/js/util.js"></script>

<style type="text/css">
*{ word-break:break-all }
body{ color:#000; font-size:12px; font-family:"宋体", Arial, Times; text-align:left; line-height:120%; background:#fff; }
body, ul, li, h3 { margin:0px; padding:0px; }
ul, li { list-style:none; }
.big{text-align:center; margin:15px 2px 0 2px}
.big span {padding:2px 10px; display:inline-block; }
a:link, a:visited { color:#1E62B0; text-decoration:none; }
a:hover { color:#ff0000; text-decoration:underline; }

.wrapper { width:500px; padding:3px; border:1px solid #48AEE0; background:#82D1F8; position:absolute;}
.container { padding:15px; background:#fff; }
.container h3 { font-size:14px; }
.container ul { font-size:14px; margin:15px; line-height:150%;} 
.container ul.buttons { text-align:center; margin:0px; } 
</style>
</head>
<body>
<div class="wrapper">
<div class="container">
<h3>{$P8LANG['prompt_message']}</h3>
EOT;
if(empty($messagedb)){
print <<<EOT

<ul>
$message 
</ul>
<ul class="buttons">
EOT;
if($forward=='close' && $timeout *= 1000){
print <<<EOT

<a id="forward" href="javascript:void(0)" onclick="_close()">{$P8LANG['close']}</a>
<script type="text/javascript">
setTimeout(_close, $timeout);
function _close(){
window.close();
}
</script>
EOT;
}elseif($forward && $timeout *= 1000){
print <<<EOT

<a id="forward" href="$forward">{$P8LANG['redirecting']}</a>
<script type="text/javascript">
setTimeout(_go, $timeout);
function _go(){
window.location.href='$forward';
}
</script>
EOT;
}elseif($goback){
print <<<EOT

<script type="text/javascript">
function _go(){
history.back(-1);
}
function CloseWebPage() {     
if (navigator.userAgent.indexOf("MSIE") > 0) {     
if (navigator.userAgent.indexOf("MSIE 6.0") > 0) {     
window.opener = null; window.close();     
}     
else {     
window.open('', '_top'); window.top.close();     
}     
}     
else if (navigator.userAgent.indexOf("Firefox") > 0) {     
window.location.href = 'about:blank ';  
//window.history.go(-2);     
}     
else {     
window.opener = null;      
window.open('', '_self', '');     
window.close();     
}     
}
</script>

<a id="forward" href="javascript:_go();">{$P8LANG['back']}</a>&nbsp;&nbsp;&nbsp;&nbsp;<a id="close" href="javascript:CloseWebPage();">{$P8LANG['close']}</a>
EOT;
}
print <<<EOT


</ul>
EOT;
}else{
print <<<EOT

<ul class="buttons" style="font-weight: bold;color:#1E62B0;line-height: 150%;">
EOT;
if($message){
print <<<EOT
$message
EOT;
}else{
print <<<EOT
{$P8LANG['done']}
EOT;
}
print <<<EOT

</ul>
<div class="big">
EOT;
$__t_foreach = @$messagedb;
if(!empty($__t_foreach)){
foreach($__t_foreach as $key => $val){
print <<<EOT

<span>$val</span>
EOT;
}
}

print <<<EOT

</div>
EOT;
if($forward && $timeout){
print <<<EOT

<div class="big"><a id="forward" href="$forward">{$P8LANG['redirecting']}</a>
<script type="text/javascript">
setTimeout("_go()",$timeout);
function _go(){
window.location.href='$forward';
}
</script>
</div>	
EOT;
}
}
print <<<EOT

</div>
</div>
<script type="text/javascript">
$('.wrapper').css({
left: parseInt((get_document_width() - $('.wrapper').width())/2)+'px',
top: parseInt((get_document_height() - $('.wrapper').height())/2)+'px'
});
$(document).keydown(function(e){
if(e.keyCode == 32){
_go();
}
});
</script>
</body>
</html>
EOT;
?>