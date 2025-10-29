<?php
defined('PHP168_PATH') or die();
?>
<?php
print <<<EOT
<ul class="infolist3" style="font-size:14px;color:#454545;">
EOT;
$__t_foreach = @$list;
if(!empty($__t_foreach)){
foreach($__t_foreach as $value){
print <<<EOT

<li style="$wf;">
<a href="$value[url]" target="_blank" title="$value[full_title]"><span>$value[title]</span><span class="label_datatime" style="font-size:14px;color:#666;">
EOT;
echo date('Y-m-d', $value['timestamp']);
print <<<EOT
</span></a>
</li>
EOT;
}
}

print <<<EOT

</ul>
EOT;
?>