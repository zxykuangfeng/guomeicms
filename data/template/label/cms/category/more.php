<?php
defined('PHP168_PATH') or die();
?>
<?php
$__t_foreach = @$list;
if(!empty($__t_foreach)){
foreach($__t_foreach as $value){
print <<<EOT

<a href="$value[url]" target="_blank">更多>></a>
EOT;
}
}
?>