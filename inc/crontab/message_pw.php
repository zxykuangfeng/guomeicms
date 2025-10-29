<?php
defined('PHP168_PATH') or die();

/**
* 针对30天内登录过的用户进行提醒，?day=30
**/
$message = $core->load_module('message');
$member = $core->load_module('member');
$select = select();
$select->from($member->table, 'id, username, last_login,status');
$select->in('status', 0);
$day = isset($_GET['day']) ? intval($_GET['day']) : 30;
$last_30day = P8_TIME-$day*3600*24;
$select->where("last_login>=$last_30day");
$query = $select->build_sql();
$member_list = $core->DB_master->fetch_all($query);
$m = array(	
	'title' => $P8LANG['changed_pw_note'],
	'content' => $P8LANG['changed_pw_note'],
	'system' => true
);
foreach($member_list as $member_info){	
	$m['username'] = $member_info['username'];
	$message->send($m);
}