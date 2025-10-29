<?php
defined('PHP168_PATH') or die();
?>
<?php
print <<<EOT
<ul class="label_pic_com_ul38 clearfix">
EOT;
$__t_foreach = @$list;
if(!empty($__t_foreach)){
foreach($__t_foreach as $value){
print <<<EOT
	
<li>
<a href="$value[url]" title="$value[full_title]" target="_blank" class="item">
<img width="380" height="240" alt="$value[full_title]" onError="this.src='$RESOURCE/images/nopic.jpg'" src="
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
" />
<div class="text">
<h3>$value[title]</h3>
<p>+ 更多详情</p>
</div>
</a>
</li>
EOT;
}
}

print <<<EOT

</ul>
EOT;
?>