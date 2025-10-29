<?php
defined('PHP168_PATH') or die();
?>
<?php
print <<<EOT
<ul class="themelist14" style="font-size:14px;">
EOT;
$__t_foreach = @$list;
if(!empty($__t_foreach)){
foreach($__t_foreach as $value){
print <<<EOT

<li>
<span class="datatime">
EOT;
echo date('Y-m-d', $value['timestamp']);
print <<<EOT
</span><a href="$value[url]" target="_blank" title="$value[full_title]">$value[title]</a>
</li>
EOT;
}
}

print <<<EOT

</ul>
EOT;
?>