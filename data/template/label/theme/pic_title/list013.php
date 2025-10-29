<?php
defined('PHP168_PATH') or die();
?>
<?php
print <<<EOT
<ul class="label_theme_pic_ul13">
EOT;
$__t_foreach = @$list;
if(!empty($__t_foreach)){
foreach($__t_foreach as $value){
print <<<EOT

<li class="col-md-2 col-sm-3 col-xs-6">
<div class="item">
<a href="$value[url]" target="_blank" title="$value[full_title]">
<div class="pic"><img alt="$value[full_title]" onError="this.src='$RESOURCE/images/nopic.jpg'" src="
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
"/></div>
<p> $value[title] <span>/ $value[sub_title]</span></p>
</a>
</div>
</li>
EOT;
}
}

print <<<EOT

</ul>
EOT;
?>