<?php
return array(
	//忽略项
	'alias' => '主站栏目模块',
	'class' => 'P8_CMS_Category',
	'controller_class' => 'P8_CMS_Category_Controller',
	
	'admin_actions' => array(
		'list' => '列表',
		'add' => '添加',
		'update' => '修改',
		'cache' => '更新缓存',
		'merge' => '合并栏目',
		'clone' => '克隆栏目',
		'set_acl' => '分配权限',
		'recycle' => '回收站',
		'restore' => '还原',
		'delete' => '删除'
	),
	'admin_actions_map' => array(		
		'list' => '栏目列表',
		'add' => '添加栏目',		
		'recycle_list' => '回收站',
		'cache' => '更新缓存',
	),
	'actions' => array(
		'update' => '修改',
	)
	//忽略项
	
	
);
