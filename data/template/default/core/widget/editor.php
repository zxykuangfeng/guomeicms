<?php
defined('PHP168_PATH') or die();
?>
<?php
print <<<EOT
<input type="hidden" name="#field_{$field}_posted" />
<script name="field#[$field]" id="field_{$field}" type="text/plain">
EOT;
if(isset($data[$field])){
print <<<EOT
{$data[$field]}
EOT;
}
print <<<EOT
</script>
<script type="text/javascript">
$(function(){
P8_UEDITOR({
id: 'field_{$field}',
type:'all',
xiumi:true
});
});
</script>
EOT;
?>