<?php
defined('PHP168_PATH') or die();

//P8_CMS_Category::recycle($data)
	global $CACHE;
	
	$query = $this->DB_master->query("SELECT id, model FROM $this->table_recycle WHERE $data[where]");
	$id = array();
	$this->get_cache_recycle();
	while($arr = $this->DB_master->fetch_array($query)){
		$id[] = $arr['id'];
		//连同子分类一起
		$cids = $this->get_children_ids_recycle($arr['id']);
		$id = array_merge($id, $cids);
	}

	$ids = implode(',', $id);
	$status = 0;
	$sql = "INSERT INTO `$this->table` SELECT * FROM `$this->table_recycle` WHERE `id` IN ($ids)";
	if($ids && $status = $this->DB_master->query($sql)){	
		$status = $this->DB_master->delete($this->table_recycle, "id IN ($ids)");
		$item = &$this->system->load_module('item');
		foreach($id as $i){
			//处理到回收站
			$cond = $item->unverified_table.".cid=$i and ".$item->unverified_table.".verified=88";
			//$cond = $item->unverified_table.".cid=$i";
			$item->verify(array(
				'where' => $cond,
				'value' => 1,
				'verified' => 0
			));
		}
	}
	return $status? $id : array();