<?php
return array(
		
	'administrator_role' => array(
		'name'		=>	'管理员',
		'system'	=>	'core',
		'gid'		=>	$core->CONFIG['administrator_role_group'],
		'type'		=>	'system'
	),
	'member_role' => array(
		'name'		=>	'普通会员',
		'system'	=>	'core',
		'gid'		=>	$core->CONFIG['person_role_group'],
		'type'		=>	'normal'
	),
	'guest_role' => array(
		'name'		=>	'游客',
		'system'	=>	'core',
		'gid'		=>	$core->CONFIG['person_role_group'],
		'type'		=>	'system'
	),
    'guest_role' => array(
		'name'		=>	'分站管理员',
		'system'	=>	'core',
		'gid'		=>	$core->CONFIG['person_role_group'],
		'type'		=>	'normal'
	),
    'guest_role' => array(
		'name'		=>	'投稿员',
		'system'	=>	'core',
		'gid'		=>	$core->CONFIG['person_role_group'],
		'type'		=>	'normal'
	),
    'guest_role' => array(
		'name'		=>	'终审编辑组',
		'system'	=>	'core',
		'gid'		=>	$core->CONFIG['person_role_group'],
		'type'		=>	'normal'
	),
    'guest_role' => array(
		'name'		=>	'初审编辑组',
		'system'	=>	'core',
		'gid'		=>	$core->CONFIG['person_role_group'],
		'type'		=>	'normal'
	),
    'guest_role' => array(
		'name'		=>	'常规编辑组',
		'system'	=>	'core',
		'gid'		=>	$core->CONFIG['person_role_group'],
		'type'		=>	'normal'
	),
);