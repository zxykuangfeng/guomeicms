<?php
defined('PHP168_PATH') or die();

/**
 * 短消息提示框
 */

if(REQUEST_METHOD == 'GET'){
	
	
	$where = " sendee_uid = '$UID' AND type = 'in' AND new = '1'";
	if(isset($this_module->CONFIG['message_type']) && !empty($this_module->CONFIG['message_type'])){
		$where .= " AND sender_uid != '0' ";
	}
	$json = $DB_slave->fetch_one("SELECT COUNT(*) AS `new_count` FROM $this_module->table WHERE $where");
	if($json['new_count']){
		$count = $json['new_count'];
		$json = $DB_slave->fetch_one("SELECT id, sender_uid, title, content, username FROM $this_module->table WHERE $where ORDER BY timestamp DESC LIMIT 1");
		$json['new_count'] = $count;
		$json['title'] = p8_cutstr($json['title'], 30);
		$json['content'] = p8_cutstr($json['title'], 80);
		$json['username'] || $json['username'] = $P8LANG['system_message'];
		$json['url'] = $this_router .'-read?type=in&id='. $json['id'];
	}
	
	exit(p8_json($json));
}else{
	
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	
	$DB_master->update($this_module->table, array('type' => 'rubbish'), "sendee_uid = '$UID' AND id = '$id'");
	
	exit(p8_json(array('id' => $id, 'move' => true)));
}
