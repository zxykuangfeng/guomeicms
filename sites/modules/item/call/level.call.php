<?php
defined('PHP168_PATH') or die();

	$ids = implode(',', (array)$id);
	
	if(!strlen($ids)){
		return false;
	}

	$value = intval($value);
	if($value < 0 || $value > 250) return false;

	if($verified){
        $this->DB_master->update(
            $this->main_table,
            array(
                'level' => $value,
				'level_time' => $level_time
            ),
            "id IN ($ids)"
        );
		$query = $this->DB_master->query("SELECT id,model FROM $this->main_table WHERE id IN ($ids)");
        while($arr = $this->DB_master->fetch_array($query)){
            $models[] = $arr['model'];
        }
		foreach($models as $model => $v){			
			$this->set_model($v);
			$this->DB_master->update($this->table,array('level' => $value,'level_time' => $level_time), "id IN ($ids)");
		}
        return true;
	}else{
		//未审的
		$this->DB_master->update(
			$this->unverified_table,
			array(
                'level' => $value,
				'level_time' => $level_time
			),
			"id IN ($ids)"
		);
		return true;
	}
	return false;
