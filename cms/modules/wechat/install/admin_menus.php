<?php
return array(
	array(
		'name' => '微信公众号助手',
		'system' => $this_system->name,
		'module' => $this_module->name,
		'action' => '',
		'display_order' => 96,
		
		'menus' => array(
			array(
				'name' => '推送图文',
				'system' => $this_system->name,
				'module' => $this_module->name,
				'action' => 'list',
				'display_order' => 99,
			),
						
			array(
				'name' => '已推送图文',
				'system' => $this_system->name,
				'module' => $this_module->name,
				'action' => 'pushlist',
				'display_order' => 65
			),
			
			array(
				'name' => '自定义菜单',
				'system' => $this_system->name,
				'module' => $this_module->name,
				'action' => 'menu',
				'display_order' => 60
			),
			
			array(
				'name' => '素材管理',
				'system' => $this_system->name,
				'module' => $this_module->name,
				'action' => 'material',
				'display_order' => 59
			),
			
			array(
				'name' => '自动回复',
				'system' => $this_system->name,
				'module' => $this_module->name,
				'action' => 'keyword',
				'display_order' => 59
			),
			
			array(
				'name' => '消息管理',
				'system' => $this_system->name,
				'module' => $this_module->name,
				'action' => 'message',
				'display_order' => 59
			),
			
			array(
				'name' => '基本配置',
				'system' => $this_system->name,
				'module' => $this_module->name,
				'action' => 'config',
				'display_order' => 55
			)
		)
	)
);