<?php
return array(
	//忽略项
	'alias' => '万能表单',
	'class' => 'P8_forms',
	'controller_class' => 'P8_Forms_Controller',
	
	'admin_actions' => array(
		'config' => '模块配置',
		'list' => '内容管理',
		'p8_status' => '项目状态管理',
		'verify_first' => '初审',
        'verify' => '终审',
		'model' => '模型管理',
		'delete_model' => '删除模型',
		'field' => '字段管理',
		'label' => '标签管理',
		'import' => '导入表单模型',
		'clone' => '克隆表单模型',
		'download' => '导出表单内容',
		'import_list' => '导入表单内容',
		
	),
	'admin_actions_map' => array(
		'config' => '模块配置',
		'list' => '内容管理',
		'model' => '模型管理',
		'import' => '导入模型',
	),
	'actions' => array(
		'post' => '发布',
		'list' => '列表',
		'view' => '查看',
		'search' => '搜索',
		'verify_first' => '初审',
        'verify' => '终审',		
		'update' => '修改',		
		'automatic_processing' => '自动处理',
		'manage' => '管理',
		'download' => '导出',
		'import_list' => '导入',
		'get_items' => '查看留言',
	)
	//忽略项
	
);
