<?php
return array(
	//忽略项
	'alias' => '领导信箱',
	'class' => 'P8_Letter',
	'controller_class' => 'P8_Letter_Controller',
	
	'admin_actions' => array(
		'config' => '模块配置',
		'list' => '管理',
		'statistics' => '统计',
        'label' => '标签管理'
	),
	'admin_actions_map' => array(
		'config' => '模块配置',
		'list' => '信箱管理',
		'statistics' => '信箱统计',
		'cache' => '更新缓存',
	),
	'actions' => array(
		'list'=>'列表',
		'post'=>'写信',
		'view'=>'查看',
		'manager'=>'信箱管理',
		'delletter'=>'删除信件',
		'reply'=>'回复信件',
		'edit'=>'修改回复',
		'turnover'=>'信件流转',
		'vefify'=>'审核',
		'endtime'=>'完成时间',
		'display'=>'显示管理'
	)
	//忽略项
	
);
