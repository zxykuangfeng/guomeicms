<?php
/**
* 系统角色
* 角色名 => 角色配置
* 角色名将会被写入系统配置,里面记载着角色的ID
**/

 return array(
	
	'sit_manager_role' => array(
		'name'		=>	'分站管理员',
		'gid'		=>	$core->CONFIG['administrator_role_group'],
		'type'		=>	'normal'
	)
);
