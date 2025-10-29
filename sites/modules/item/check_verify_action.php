<?php
defined('PHP168_PATH') or die();
$URI='';
$m_comma='';
$URI ="P8CONFIG.URI.sites={".
			"'': {".
				"url: '$this_system->url',".
				"controller: '$this_system->controller',".
				"U_controller: '$this_system->U_controller'".
			"},";
//检查当前分类权限
foreach($this_system->list_modules(true) as $kk => $vv){
			$m = &$this_system->load_module($kk);
			
			$sm[$k]['modules'][$kk] = array(
				'name' => $m->name,
				'url' => $m->url,
				'controller' => $m->controller,
				'U_controller' => $m->U_controller,
				'alias' => $vv['alias'],
				'class' => $vv['class'],
				'controller_class' => $vv['controller_class'],
				'installed' => $vv['installed'],
				'enabled' => $vv['enabled']
			);
			$URI .= $m_comma ."
			'$m->name': {".
				"url: '$m->url',".
				"controller: '$m->controller',".
				"U_controller: '$m->U_controller'".
			"}";
			$m_comma = ',';
			$m = null;
		}
		
		$URI .= "
		};";
$mysites = $this_system->get_manage_sites();

if(in_array($this_system->SITE,$mysites)){
	exit('var is_verify = true;');
}
exit('var is_verify = false;');
