<?php
return array(
	array(
		'name' => S_version() == 'company' ? '文章内容' : 'CMS',
		'system' => $this_system->name,
		'module' => '',
		'action' => '',
        'target' => '',
        'top' => '1',
        'url' => 'u.php/'.$this_system->name.'/item-my_list',
		'display_order' => 88
	)
);
