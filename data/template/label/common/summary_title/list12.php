<?php
defined('PHP168_PATH') or die();
?>
<?php
print <<<EOT
<ul class="label_title_ul12">
EOT;
$__t_foreach = @$list;
if(!empty($__t_foreach)){
foreach($__t_foreach as $value){
print <<<EOT

<li>
<h3><a href="$value[url]" target="_blank" title="$value[full_title]">$value[title]</a><span class="datatime">
EOT;
echo date('Y-m-d', $value['timestamp']);
print <<<EOT
</span></h3>
<p>$value[summary]</p>
</li>
EOT;
}
}

print <<<EOT

</ul>
EOT;
?>