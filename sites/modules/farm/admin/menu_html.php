<?php
defined('PHP168_PATH') or die();
$this_system->check_manager($ACTION) or message('no_privilege');
if(REQUEST_METHOD == 'GET'){
	$mysites = array();	
	$mysites = $this_system->get_manage_sites();
	$mysites || $this_controller->check_admin_action($ACTION) or message('no_privilege');
	$allsites  = $this_system->get_sites();
	foreach($mysites as $site){
		if($allsites[$site]['status']){
			$html_sites[] = $site;
		}		
	}
	!empty($html_sites) or message('no_privilege');
	
	$form = <<<EOT
<form id="form" method="post" action="$this_url">
</form>
<script type="text/javascript">
if(confirm('$P8LANG[confirm_to_do]')){
	document.getElementById('form').submit();
}
</script>
EOT;
	message($form);
	
}else if(REQUEST_METHOD == 'POST'){
	$step = isset($_POST['step']) ? $_POST['step'] : 'init';
	if($step == 'done'){
		GetGP(array('this_site'));
		message('done',$this_router.'-menu_list?site='.$this_site,3);
	}
	!empty($_POST['start']) or $this_module->menu_jump($this_url,$P8LANG['start'],$this_system->SITE,$this_system->SITE,0,'init');
	
	$html_sites = array();	
	$mysites = $this_system->get_manage_sites();
	$allsites  = $this_system->get_sites();
	foreach($mysites as $site){
		if($allsites[$site]['status']){
			$html_sites[] = $site;
		}		
	}	
	switch($step){
		case 'init':
			GetGP(array('this_site'));			
			$offset = 0;
			$site = $html_sites[$offset];
			$message = $allsites[$site]['sitename'].'分站导航菜单静态化进行中……';
			$step = 'site';
			$this_module->menu_jump($this_url,$message,$this_site,$site,$offset,$step);
		break;
		case 'site':
			GetGP(array('site','offset','this_site'));
			$this_module->change_url($site,'html');
			$this_module->cache($site);
			$offset = intval($offset)+1;
			$site = $html_sites[$offset];
			$message = $allsites[$site]['sitename'].'分站导航菜单静态化进行中……';
			$step = $offset >= count($html_sites)-1 ? 'done' : 'site';
			$this_module->menu_jump($this_url,$message,$this_site,$site,$offset,$step);
		break;		
	}
}