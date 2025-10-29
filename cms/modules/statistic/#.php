<?php
return array(
	//忽略项
	'alias' => '全站统计',
	'class' => 'P8_CMS_Statistic',
	'controller_class' => 'P8_CMS_Statistic_Controller',
	
	'admin_actions' => array(
		'statistic_data' => '主站内容统计',
        'statistic_member' => '主站考核统计',
		'statistic_author' => '主站作者内容统计',
        'statistic_sites_content' => '子站内容统计',
        'statistic_sites_push' => '子站推送统计',
		'statistic_dept' => '组织机构统计',
		'statistic_sites_author' => '子站作者统计',
        'label' => '标签管理'
    ),
	'admin_actions_map' => array(		
		'statistic_data' => '主站内容统计',
        'statistic_member' => '主站考核统计',
		'statistic_author' => '主站作者内容统计',
        'statistic_sites_content' => '子站内容统计',
        'statistic_sites_push' => '子站推送统计',
		'statistic_dept' => '组织机构统计',
		'statistic_credit' => '用户币种统计',
	),
	
	
);
