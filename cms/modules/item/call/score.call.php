<?php
defined('PHP168_PATH') or die();
	global $P8LANG, $UID,$USERNAME;
	$ids = implode(',', (array)$id);
	
	if(!strlen($ids)){
		return false;
	}
	$value = intval($value);
	if($value <= -100 || $value >= 100) return false;
	$T = $verified ? $this->main_table : $this->unverified_table;
	
	if($verified){
        $this->DB_master->update(
            $this->main_table,
            array(
                'score' => $value,
            ),
            "id IN ($ids)"
        );
		$query = $this->DB_master->query("SELECT id,model FROM $this->main_table where id IN ($ids)");
		while($arr = $this->DB_master->fetch_array($query)){
			$this->set_model($arr['model']);
			$this->DB_master->update(
				$this->table,
				array(
					'score' => $value,
				),
				"id IN ($ids)"
			);			
		}
	}else{
		//未审的
		$this->DB_master->update(
			$this->unverified_table,
			array(
                'score' => $value,
			),
			"id IN ($ids)"
		);
	}
	
	$query = $this->DB_master->query("SELECT id,uid,username,title FROM $T where id IN ($ids)");
	$message = $this->core->load_module('message');
	$credit = $this->core->load_module('credit');
	while($arr = $this->DB_master->fetch_array($query)){
		$log[] = array($arr['uid'], 3, intval($value), P8_TIME,$this->system->name,'item','',$arr['id'],$push_back_reason);
		//发站内信件
		if($arr['uid'] && $arr['uid'] != $UID) {
			$m = array(
				'username' => $arr['username'],
				'title' => $P8LANG['cms_item']['set_score'].'-'.$arr['title'],
				'content' => p8lang($P8LANG['cms_item']['changed_message'], $arr['title'], intval($value), $push_back_reason),
				'system' => true
			);
			$message->send($m);
		}
	}
	$credit->log($log,true);
	
	return true;