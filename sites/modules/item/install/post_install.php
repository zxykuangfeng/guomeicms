<?php
defined('PHP168_PATH') or die();

load_language($this_module, 'global');

$this_module->set_config(array(
	'verify_acl' => array(
		1 => array(
			'name' => $P8LANG['sites_item']['verify'][1],
			'role' => array(
				$core->CONFIG['administrator_role'] => 1,
				$this_system->CONFIG['verifier_role'] => 1
			)
		),
		
		0 => array(
			'name' => $P8LANG['sites_item']['verify'][0],
			'role' => array(
				$core->CONFIG['administrator_role'] => 1,
				$this_system->CONFIG['verifier_role'] => 1
			)
		),
		
		-99 => array(
			'name' => $P8LANG['sites_item']['verify'][-99],
			'role' => array(
				$core->CONFIG['administrator_role'] => 1,
				$this_system->CONFIG['verifier_role'] => 1
			)
		)
	)
));
//添加一些初始化内容
$sql = get_install_sql(
	$DB_master,
	file_get_contents($this_module->path .'install/init_data.php'),
	$this_module->TABLE_
);
foreach($sql as $v){
	$DB_master->query($v);
}
