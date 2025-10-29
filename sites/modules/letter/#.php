<?php
return array(
	//忽略项
	'alias' => '子站站点信箱',
	'class' => 'P8_Sites_Letter',
	'controller_class' => 'P8_Sites_Letter_Controller',
	
	'admin_actions' => array(
		'config' => '模块配置',						
		'cache' => '更新缓存',
		'delete' => '删除信件',
		'list'=>'信件管理',
		'statistics' => '信件统计',
		
	),
	'admin_actions_map' => array(		
		'config' => '模块配置',						
		'cache' => '更新缓存',
		'list'=>'信件管理',
		'statistics' => '信件统计',
	),
	'actions' => array(
		'list'=>'列表',
		'post'=>'写信',
		'view'=>'查看',
		'manager'=>'信箱管理',
		'delletter'=>'删除信件',
		'edit'=>'修改回复',
		'turnover'=>'信件流转',
		'vefify'=>'领导审核',
		'endtime'=>'完成时间',
		'display'=>'显示管理'
	)
	//忽略项
	
);