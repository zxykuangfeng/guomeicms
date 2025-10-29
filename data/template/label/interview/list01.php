<?php
defined('PHP168_PATH') or die();
?>
<?php
print <<<EOT
<ul class="label_pic_com_ul">
EOT;
$__t_foreach = @$list;
if(!empty($__t_foreach)){
foreach($__t_foreach as $value){
print <<<EOT

<li style="$wf;">
<a href="$value[url]" target="_blank" title="$value[full_title]"><img width="120" height="90" alt="$value[full_title]" onError="this.src='$RESOURCE/images/nopic.jpg'" src="
EOT;
if(empty($value['frame'])){
print <<<EOT
{$RESOURCE}/images/nopic.jpg
EOT;
}else{
print <<<EOT
$value[frame]
EOT;
}
print <<<EOT
" /></a>
<h3><a href="$value[url]" target="_blank" title="$value[full_title]">$value[title]</a></h3>
<p class="label_summary">$value[summary]<span class="cDRed"><a href="$value[url]" target="_blank">[详细]</a></span></p>
<p class="clear"></p>
</li>
EOT;
}
}

print <<<EOT

<li class="clear"></li>
</ul>
EOT;
?>