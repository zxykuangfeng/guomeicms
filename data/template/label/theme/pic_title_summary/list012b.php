<?php
defined('PHP168_PATH') or die();
?>
<?php
print <<<EOT
<ul class="label_theme_pic_com_ul12">
EOT;
$__t_foreach = @$list;
if(!empty($__t_foreach)){
foreach($__t_foreach as $value){
print <<<EOT

<li class="col-md-4 col-sm-4 col-xs-12">
<div class="item">
<a href="$value[url]" target="_blank">
<div class="pic"><img width="240" height="205" alt="$value[full_title]" onError="this.src='$RESOURCE/images/nopic.jpg'" src="
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
" /></div>
<div class="text">
<h3>$value[title]</h3>
<p class="datatime">
EOT;
echo date('Y-m-d', $value['timestamp']);
print <<<EOT
<span></span></p>
</div>
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