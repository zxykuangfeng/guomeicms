<?php
defined('PHP168_PATH') or die();
?>
<?php
print <<<EOT
<ul class="themelist17">
EOT;
$__t_foreach = @$list;
if(!empty($__t_foreach)){
foreach($__t_foreach as $k => $value){
if($k==0){
print <<<EOT

<li>
<div class="item">
<div class="pic"><a href="{$value['url']}" target="_blank"><img alt="$value[full_title]" onError="this.src='$RESOURCE/images/nopic.jpg'" src="$value[category_frame]" /></a></div>
<div class="text">
<h2><a href="$value[url]" target="_blank" title="$value[full_title]">$value[title]</a></h2>
<p class="summary"><a href="$value[url]" target="_blank">$value[summary]</a></p>
</div>
</div>
</li>
EOT;
}else{
print <<<EOT

<li><a  href="{$value['url']}" target="_blank" title="{$value['full_title']}"><div class="title">{$value['title']}</div></a></li>
EOT;
}
}
}

print <<<EOT

</ul>
EOT;
?>