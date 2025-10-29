<?php
return array(
	//忽略项
	'alias' => '分站系统',
	'class' => 'P8_Sites',
	'controller_class' => 'P8_Sites_Controller',
	
	//后台操作
	'admin_actions' => array(
        'delete_log'=>'删除日志',
		'set_acl' => '角色分配权限',
		'set_member_acl' => '会员前台权限分配',
		'set_admin_acl'		=> '后台角色权限分配',
		'set_lan'      => '内容局域网化设置',
	),
	'admin_actions_map' => array(		
		'delete_log'=>'删除日志',
	),
	//前台操作
	'actions' => array(
	),
	
	//忽略项
	
);