<?php
defined('PHP168_PATH') or die();
?>
<?php
print <<<EOT
<script type="text/javascript" src="{$RESOURCE}/js/rcalendar.js"></script>
<input type="hidden" name="#field_{$field}_posted" />
<input type="text" class="txt" id="field#[$field]" name="field#[$field]" value="
EOT;
if(isset($data[$field])){
print <<<EOT
$data[$field]
EOT;
}
print <<<EOT
" onclick="rcalendar(this
EOT;
if(!empty($field_data['CONFIG']['full'])){
print <<<EOT
, 'full'
EOT;
}
print <<<EOT
);" {$field_data['widget_addon_attr']} />
EOT;
?>