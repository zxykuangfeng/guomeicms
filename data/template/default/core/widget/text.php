<?php
defined('PHP168_PATH') or die();
?>
<?php
print <<<EOT
<input type="hidden" name="#field_{$field}_posted" />
EOT;
if(isset($field_data['editable']) && !$field_data['editable']){
print <<<EOT

<input type="text"  class="txt textinput" style="background:#eee;" id="field#[$field]" name="field#[$field]" readonly="readonly" value="
EOT;
if(isset($data[$field])){
print <<<EOT
$data[$field]
EOT;
}else{
print <<<EOT
{$field_data['default_value']}
EOT;
}
print <<<EOT
" {$field_data['widget_addon_attr']} /> 
EOT;
}else{
print <<<EOT

<input type="text"  class="txt textinput" id="field#[$field]" name="field#[$field]" value="
EOT;
if(isset($data[$field])){
print <<<EOT
$data[$field]
EOT;
}else{
print <<<EOT
{$field_data['default_value']}
EOT;
}
print <<<EOT
" {$field_data['widget_addon_attr']} /> 
EOT;
}
?>