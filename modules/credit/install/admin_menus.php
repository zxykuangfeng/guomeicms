<?php
return array(
	array(
		'name' => '绩效',
		'system' => $this_system->name,
		'module' => $this_module->name,
		'action' => '',
		'display_order' => 93,
		'display' => S_version() == 'media' ? 1 : 0,
		
		'menus' => array(
			array(
				'name' => '绩效管理',
				'system' => $this_system->name,
				'module' => $this_module->name,
				'action' => 'list',
				'display_order' => 99
			),
			array(
				'name' => '绩效规则管理',
				'system' => $this_system->name,
				'module' => $this_module->name,
				'action' => 'list_rule',
				'display_order' => 97
			),
			array(
				'name' => '更新绩效缓存',
				'system' => $this_system->name,
				'module' => $this_module->name,
				'action' => 'cache',
				'display_order' => 95
			)
		)
	)
);
