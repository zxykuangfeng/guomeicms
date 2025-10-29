<?php
return array(
	array(
		'name' => '系统检测',
		'system' => $this_system->name,
		'module' => $this_module->name,
		'action' => '',
		'display_order' => 0,
		'position' => 'list',
		
		'menus' => array(
			
			array(
				'name' => '环境检查',
				'system' => $this_system->name,
				'module' => $this_module->name,
				'action' => 'env',
				'display_order' => 99
			),
			
			array(
				'name' => '目录/文件权限',
				'system' => $this_system->name,
				'module' => $this_module->name,
				'action' => 'dirfile',
				'display_order' => 98
			)
		),
		'menuid' => 46,
	)
);
