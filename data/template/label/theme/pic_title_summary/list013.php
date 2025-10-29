<?php
defined('PHP168_PATH') or die();
?>
<?php
print <<<EOT
<ul class="label_theme_pic_com_ul13">
EOT;
$i=0;
$__t_foreach = @$list;
if(!empty($__t_foreach)){
foreach($__t_foreach as $value){
$i++;
print <<<EOT

<li>
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
" /></div>
<div class="text">
<p class="name">$value[title]<span class="post">/$value[sub_title]</span></p>
<div class="good">
<h3>擅长</h3>
<p class="dkv">$value[custom_a]</p>
</div>
<div class="info">
<h3>简介</h3>
<div class="shows" id="show$i">            
$value[content]
</div>
<div class="dkvv"> 
$value[content]......
<a href="javascript:;" class="pubc-more" showid="$i">更多内容</a>
</div>
</div>
</div>
</li>
EOT;
}
}

print <<<EOT

</ul>
EOT;
?>