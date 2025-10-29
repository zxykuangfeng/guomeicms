<?php
defined('PHP168_PATH') or die();

//初始化配置

$this_module->set_config(
	array(
		'send_type' => 'smtp',
		'CRLF' => 'rn',
		'server' => 'smtp.163.com',
		'port' => 25,
		'email' => 'xxx@163.com',
		'password' => '***',
		'logged' => 1,
	)
);
