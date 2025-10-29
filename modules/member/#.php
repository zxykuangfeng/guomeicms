<?php
return array(
	//忽略项
	'alias' => '会员模块',
	'class' => 'P8_Member',
	'controller_class' => 'P8_Member_Controller',
	
	'admin_actions' => array(
		'config' => '模块配置',
		'add' => '添加会员',
		'add_list' => '导入会员',		
		'list' => '会员列表',
		'set_member_acl' => '单个用户权限设置',
		'copy_acl' => '复制权限',
		'update' => '修改会员',
		'delete' => '删除会员',
		'batch_send' => '批量发送',
		'credit' => '修改积分',
		'recharge' => '充值管理',
		'buy_role' => '会员升级管理',
		'integrate' => '系统整合',
		'transition' => '会员转换导入'
	),
	'admin_actions_map' => array(
		'config' => '模块配置',
		'add' => '添加会员',
		'add_list' => '导入会员',
		'list' => '会员列表',
		'set_member_acl' => '单个用户权限设置',
		'integrate' => '系统整合',
		'cache' => '更新缓存',
	),
	'actions' => array(
		'address_list' => '通讯录',
		'menu_button' => '主站会员站点管理按钮'
	),
	
	//可以添加积分规则的action
	'credit_rule_actions' => array(
		'register' => '注册',
		'login' => '登录',
		'update' => '完善资料'
	),
	//忽略项
	
	//保护项
	'integration_types' => array(	//整合类型
		'uc' => 'Ucenter',
		'sso' => '单点登录',
		'ldap' => 'LDAP(Microsoft Active Directory)',
	),
	//保护项
	
);