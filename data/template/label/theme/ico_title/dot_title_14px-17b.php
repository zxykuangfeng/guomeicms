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
print <<<EOT

<li><a href="{$value['url']}" target="_blank" title="{$value['full_title']}"><div class="title">{$value['title']}</div></a></li>
EOT;
}
}

print <<<EOT

</ul>
EOT;
?>