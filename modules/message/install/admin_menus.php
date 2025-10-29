<?php
return array(
	array(
		'name' => '站内信',
		'system' => $this_system->name,
		'module' => $this_module->name,
		'action' => '',
		'display_order' => 85,
		'position' => 'extern',
		
		'menus' => array(			
			array(
				'name' => '模块配置',
				'system' => $this_system->name,
				'module' => $this_module->name,
				'action' => 'config',
				'display_order' => 80
			)
		)
	)
);
