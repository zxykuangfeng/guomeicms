<?php
defined('PHP168_PATH') or die();
?>
<?php
print <<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{$P8LANG['prompt_message']}</title>
<meta http-equiv="Content-Type" content="text/html; charset={$core->CONFIG['page_charset']}" />
<script type="text/javascript" src="{$RESOURCE}/js/util.js"></script>

<script type="text/javascript">
EOT;
if(!empty($this_module->CONFIG['base_domain'])){
$_domain = $this_module->CONFIG['base_domain'];
}else if(!empty($this_system->CONFIG['base_domain'])){
$_domain = $this_system->CONFIG['base_domain'];
}else{
$_domain = $core->CONFIG['base_domain'];
}
echo empty($_domain) ? '' : 'document.domain = \''. $_domain .'\';';
echo 'document.base_domain = \''. $_domain .'\';';
print <<<EOT

</script>
<style type="text/css">
*{ word-break:break-all }
body{ color:#000; font-size:12px; font-family:"瀹嬩綋", Arial, Times; text-align:left; line-height:120%; background:#fff; }
body, ul, li, h3 { margin:0px; padding:0px; }
ul, li { list-style:none; }
.big{text-align:center; margin:15px 2px 0 2px}
.big span {padding:2px 10px; display:inline-block; }
a:link, a:visited { color:#1E62B0; text-decoration:none; }
a:hover { color:#ff0000; text-decoration:underline; }

.wrapper { width:500px; padding:3px; border:1px solid #48AEE0; background:#82D1F8; position: absolute; }
.container { padding:15px; background:#fff; }
.container h3 { font-size:14px; }
.container ul { font-size:14px; margin:15px; } 
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
<img  border="none" src="{$RESOURCE}/skin/default/core/alonepage/tip.gif"> $message 
</ul>
<ul class="buttons">
EOT;
if($forward && $timeout *= 1000){
print <<<EOT


<a id="forward" href="$forward">椤甸潰姝ｅ湪璺宠浆, 濡傛灉涓嶆兂绛夊緟鐐规?閾炬帴, 鎴栬€呮寜绌烘牸閿?/a>
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
</script>

<a id="forward" href="javascript:_go();">杩斿洖</a>
EOT;
}
print <<<EOT


</ul>
EOT;
}else{
print <<<EOT

<ul class="buttons">
鎿嶄綔鎴愬姛锛侊紒 
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

<div class="big"><a id="forward" href="$forward">濡傛灉涓嶆兂绛夊緟鐐规?閾炬帴, 鎴栬€呮寜绌烘牸閿?/a>
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
$(document).ready(function(){
element_to_center($('.wrapper'));
$(document).keydown(function(e){
if(e.keyCode == 32){
_go();
}
});
});
</script>
</body>
</html>
EOT;
?>