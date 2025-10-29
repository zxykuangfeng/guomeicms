<?php
return array(
	//忽略项
	'alias' => '推送模块',
	'class' => 'P8_Sites_Stop',
	'controller_class' => 'P8_Sites_Stop_Controller',
	
	'admin_actions' => array(
        'list' => '推送管理',
		'category' => '公共栏目管理',
		'cache' => '更新缓存',
		'map' => '推送栏目对接',
		'delete' => '删除推送',
		'view' => '查看推送',
	),
	'admin_actions_map' => array(		
		'list' => '推送管理',
		'category' => '公共栏目管理',
        'add' => '新建模型',		
		'map' => '推送栏目对接',
		'cache' => '更新缓存',
	),
	'actions' => array(		
		'delete' => '删除推送',
	)
	//忽略项
	
);