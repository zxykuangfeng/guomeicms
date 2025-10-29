<?php
defined('PHP168_PATH') or die();

//P8_Sites_Category::recycle($data)
	global $CACHE;
	
	$query = $this->DB_master->query("SELECT id, model FROM $this->table WHERE $data[where]");
	$id = array();
	$this->get_cache();
	while($arr = $this->DB_master->fetch_array($query)){
		$id[] = $arr['id'];
		//连同子分类一起删除
		$cids = $this->get_children_ids($arr['id']);
		$id = array_merge($id, $cids);
	}
	$ids = implode(',', $id);

	$status = 0;
	$sql = "INSERT INTO `$this->table_recycle` SELECT * FROM `$this->table` WHERE `id` IN ($ids)";
	if($ids && $status = $this->DB_master->query($sql)){
		$status = $this->DB_master->delete($this->table, "id IN ($ids)");
		$item = &$this->system->load_module('item');
		
		//清除权限
		//删除对应显示域的标签
		$role = &$this->core->load_module('role');
		foreach($id as $i){
			$role->delete_acl(
				array(
					'system' => $this->system->name,
					'module' => $item->name,
					'postfix' => 'category_'. $i
				)
			);
			
			$this->DB_master->delete(
				$this->core->TABLE_ .'label',
				"system = '{$this->system->name}' AND module = '{$item->name}' AND site='{$this->system->SITE}' AND postfix = 'category_$i'"
			);
			//处理到回收站
			$cond = $item->main_table.".cid=$i";			
			$item->verify(array(
				'where' => $cond,
				'value' => 88,
				'verified' => true
			));			
			//删除缓存
			$CACHE->delete($this->system->name .'/modules/'.$this->name.'/',$this->system->SITE, (int)$i);
		}
		
		//删除关联模块数据
		//if(!empty($data['delete_hook']) || !empty($data['hook'])){
		//	$this->delete_hook_module_item($ids);
		//}
	}
	
	return $status ? $id : array();
