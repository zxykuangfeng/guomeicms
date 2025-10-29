<?php
defined('PHP168_PATH') or die();

$this_controller->check_admin_action('add') or message('no_privilege');

if(REQUEST_METHOD == 'POST'){
    $init = $_POST['init'];
    $item = $_POST['item'];
    $site = $_POST['site'];
    
    $next_item = $this_controller->init_site($site, $init, $item);
    
    if($next_item=='done'){
		$this_module->cache($site);
        message('done',$this_router.'-list');exit;
    }
    
    $message = $P8LANG['init_'.$next_item];
    ___poster($message, $site, $init, $next_item);
}

function ___poster($message,$site,$init,$item){
			$input = '';
			
			global $this_url, $core, $_ALLCACHE;
			$form = <<<FORM
$message
<form action="$this_url" method="post" id="form">
<input type="hidden" name="init" value="$init" />
<input type="hidden" name="item" value="$item" />
<input type="hidden" name="site" value="$site" />
</form>
<script type="text/javascript">
setTimeout(function(){ document.getElementById('form').submit(); }, 1000);
</script>
FORM;
			
			message($form);
}
