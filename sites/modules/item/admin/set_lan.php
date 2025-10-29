<?php
defined('PHP168_PATH') or die();

/**
* 局域网化设置
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
	load_language($core, 'config');
	$config = $core->get_config($this_system->name, $this_module->name);
	$config['lan_date'] = isset($config['lan_date']) && $config['lan_date'] ? date('Y-m-d H:i:s',$config['lan_date']) : '';
	$config['lan_date_enable'] = isset($config['lan_date_enable']) && $config['lan_date_enable'] ? 1 : 0;
	
	include template($this_module, 'set_lan', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	@set_time_limit(0);
	@ignore_user_abort(true);
	
	load_language($core, 'config');	
	$do_site_alias = $this_system->SITE;
	$type = isset($_POST['type']) ? $_POST['type'] : 'config';
	switch($type){	
		case 'config':
			$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();
			$config['lan_date_enable'] = isset($config['lan_date_enable']) && $config['lan_date_enable'] ? 1 : 0;
			$config['lan_date'] = isset($config['lan_date']) && $config['lan_date'] ? strtotime($config['lan_date']) : 0;
			$this_module->set_config($config);
		break;
		
		case 'html_init':
			$config = $core->get_config($this_system->name, $this_module->name);
			$config['lan_date'] = isset($config['lan_date']) && $config['lan_date'] ? intval($config['lan_date']) : 0;
			$config['lan_date_enable'] = isset($config['lan_date_enable']) && $config['lan_date_enable'] ? true : false;
			$count = count(array_keys($this_system->sites));
			$persentage = round(100/$count,1,PHP_ROUND_HALF_DOWN);
			if($config['lan_date_enable'] && $config['lan_date']) {
				if($count)
					___poster(p8lang($P8LANG['scanning'],array($persentage)),array_keys($this_system->sites)[0]);
				else
					message('sites_count_err',$this_url,1);
			}else{
				message('set_lan_err',$this_url,1);
			}
		break;
		case 'each_site_set_lan':
			$site = isset($_REQUEST['site']) ? $_REQUEST['site'] : '';
			if($site){
				$this_system->load_site($site);
				$this_module->set_content_html();
				
				$sites = $this_system->sites;
				$all_sites = array_keys($sites);
				if($site == end($all_sites)){
					$this_system->load_site($do_site_alias);
					message('done',$this_url,1);				
				}else{
					$index = array_search($site,$all_sites)+1;
					$site = $all_sites[$index];
					$count = count(array_keys($this_system->sites));
					$persentage = round(100*($index+1)/$count,1,PHP_ROUND_HALF_DOWN);
					___poster(p8lang($P8LANG['scanning'],array($persentage)),$site);				
				}
			}else{
				message('done',$this_url,1);
			}	
		break;
		
		case 'unlan':
			$this_module->unset_content_html();			
		break;
	
	}
	
	message('done');

}

function ___poster($message = '',$site = ''){
	global $this_url;
	$form = <<<FORM
$message
<form action="" method="post" id="form">
<input type="hidden" name="type" value="each_site_set_lan">
<input type="hidden" name="site" value="{$site}">
</form>
<script type="text/javascript">
setTimeout(function(){ document.getElementById('form').submit(); }, 1800);
</script>
FORM;
	message($form);
}
