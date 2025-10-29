<?php
defined('PHP168_PATH') or die();

$IS_ADMIN or message('no_privilege');


if(REQUEST_METHOD == 'POST'){
	
	define('NO_ADMIN_LOG', true);
	
	$mid = isset($_POST['mid']) ? $_POST['mid'] : '';
	$mid or exit('-1');

	$mid = intval($mid);
	$mid or exit('--1');
	
	$ret = $DB_slave->fetch_one("SELECT id FROM $this_module->table WHERE mid='$mid' LIMIT 1");
	if(empty($ret['id']))$ret['id']='-1';
	exit($ret['id']);
}
