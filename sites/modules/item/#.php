<?php
return array(
	//忽略项
	'alias' => '子站站点内容',
	'class' => 'P8_Site_Item',
	'controller_class' => 'P8_Site_Item_Controller',
	
	'admin_actions' => array(
		 'config' => '模块配置',
		//'verify_acl' => '分级审核',
		
		'add' => '添加',
		'verify_first' => '初审',
		'verify' => '审核',
		'move' => '移动内容',
		'clone' => '签发内容',
		'clone_log' => '签发管理',
		'list' => '列表',
		'update' => '修改',
		'delete' => '删除',
		'update' => '修改',
		'set_member_acl' => '设置会员前台权限',
		'level' => '设置内容权重',
		'score' => '设置内容评分',
		'setviews' => '设置浏览量',
		'comment' => '评论管理',
		'verify_comment' => '审核评论',
		'delete_comment' => '删除评论',	
		'delete_html' => '删除超年限静态页面',
		'list_to_html' => '列表页静态',
		'view_to_html' => '内容页静态',		
		'attribute' => '设置内容属性',
		'attribute_acl' => '内容属性分配权限',
		'label' => '标签管理',		
		'list_order' => '置顶或下沉内容',
		'create_time' => '设置发布时间',
		'filter_word' => '忽略系统敏感词检测',
		'content_censor' => '忽略大数据内容检测',
		'set_acl' => '分配权限',		
		'mood' => '表情管理',		
		'spider' => '采集入库',
		'tag' => 'Tag(标签)管理',
		'report' => '统计报告',
		'cluster_push' => '推送主站',
		'sites_push' => '推送分站',
		'sites_push_sites'=> '分站间直推数据',
		'download' => '导出数据',
		'adsmanager' => '广告管理'
	),
	'admin_actions_map' => array(		
		'config' => '模块配置',		
		'add' => '添加内容',		
		'list' => '列表内容',
		'clone_log' => '签发管理',
		'list_to_html' => '列表页静态',
		'view_to_html' => '内容页静态',			
		'mood' => '表情管理',		
		'tag' => 'Tag(标签)管理',		
		'ads_list' => '广告管理',
		'report' => '统计报告'
	),
	'actions' => array(		
		'reflash_index' => '更新首页',
		'list' => '查看列表',
		'view' => '查看内容',
		'search' => '搜索内容',
		'comment' => '发表评论',
		'add' => '发表内容',
		'update' => '修改',
		'delete' => '删除',	
		'verify_first' => '初审',		
		'verify' => '审核',
		'autoverify' => '自动审核',
		'view_to_html' => '内容页静态',
		'clone' => '签发到多个栏目',
		'clone_log' => '签发管理',
		'cluster_push' => '推送数据到总站',
		'sites_push_sites'=> '分站间直推数据',
		'setviews' => '设置浏览量',
		'level' => '设置权重',
		'create_time' => '设置发布时间',
		'filter_word' => '忽略系统敏感词检测',
		'content_censor' => '忽略大数据内容检测',		
		/*		
		'move' => '移动',
		'label' => '标签管理',
		'html' => '静态内容',
		'attribute' => '设置内容属性',
		'cluster_push' => '推送数据 ', */
	),
	
	//可以用于积分规则的action
	'credit_rule_actions' => array(
		'verify' => '审核通过',
		'delete' => '被删除'
	),
	//忽略项
	
);