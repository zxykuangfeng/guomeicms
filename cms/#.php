<?php
return array(
	//忽略项
	'alias' => '主站系统',
	'class' => 'P8_CMS',
	'controller_class' => 'P8_CMS_Controller',
	
	//后台操作
	'admin_actions' => array(
		'html' => '静态化',
		'index_to_html' => '首页静态',
		'config' => '模块配置',
		'set_acl' => '角色分配权限',
		'set_member_acl' => '会员前台权限分配',
		'set_admin_acl'		=> '后台权限分配',
	),
	'admin_actions_map' => array(		
		'config' => '模块配置',
		'index_to_html' => '首页静态',
		'html_all' => '一键静态化',
	),
	//前台操作
	'actions' => array(
	),
	
	//忽略项
	
);
