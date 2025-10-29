<?php
defined('PHP168_PATH') or die();

/**
* 子站首页静态
**/

$system = &$core->load_system('sites');

$sites = $system->get_sites();

foreach($sites as $sitename=>$sitedata){
	if($system->load_site($sitename)){
		$sdata = $system->get_site($sitename);
		if($sdata['domain']){
			require $system->path.'/call/sites_index_to_html.php';
			sleep(1);
		}
	}	
}