<?php
defined('PHP168_PATH') or die();

//P8_CMS_Item::cluster_data($id, $cid)
    $cms_system = &$this->core->load_system('cms');
	$category = &$cms_system->load_module('category');
    $category->get_cache();
    
	$id = (array)$id;
	$ids = implode(',', $id);
	
	$ret = array();
	$query = $this->DB_slave->query("SELECT id, model,site FROM $this->main_table WHERE id IN ($ids)");
	
	$data = array();
	$i = 0;
	while($arr = $this->DB_slave->fetch_array($query)){
		$model = $this->system->get_model($arr['model']);
		$_REQUEST['model'] = $arr['model'];
		$this->system->init_model();
		$this->set_model($arr['model']);
		
		$data[$i] = $this->DB_slave->fetch_one("SELECT * FROM $this->table AS i INNER JOIN $this->addon_table AS a ON i.id = a.iid WHERE i.id = '$arr[id]' AND page = '1'");
		
		$data[$i]['item_id'] = $arr['id'];
		$data[$i]['cid'] = $cid;
		$data[$i]['cname'] = $category->categories[$cid]['name'];
		$data[$i]['model'] = $arr['model'];
		$data[$i]['model_alias'] = $model['alias'];
		$data[$i]['frame'] = attachment_url($data[$i]['frame']);
		$data[$i]['verify_frame'] = attachment_url($data[$i]['verify_frame']);
		$data[$i]['attachment_pdf'] = attachment_url($data[$i]['attachment_pdf']);
		$data[$i]['comments'] = 0;
		$data[$i]['views'] = 0;
		$data[$i]['vid'] = 0;
		$data[$i]['attributes'] = $data[$i]['frame'] ? 6 : '';
		$data[$i]['action'] = 'add';
		$data[$i]['sc'] = 'c';
		$data[$i]['verify'] = $data[$i]['verified'];
		$data[$i]['link'] = $this->system->site_p8_url($this, $arr, 'view');
		$data[$i]['site'] = $arr['site'];
		//$data[$i]['site'] = $this->system->SITE;
		
		$this->format_data($data[$i]);
		if($send_time_type==1)
            $timestamp = date('Y-m-d H:i:s',P8_TIME);
        elseif($send_time_type==2 && $send_time)
            $timestamp = $send_time;
        else
            $timestamp = date('Y-m-d H:i:s',$data[$i]['timestamp']);
		$data[$i]['timestamp'] = $data[$i]['list_order']  = $timestamp;
		
		foreach($model['fields'] as $field => $field_data){
			
			//引用
			$data[$i]['field#'][$field] = &$data[$i][$field];
			//$data[$i]['field#'][$field] = &$data[$i][$field];
			//unset($data[$i][$field]);
		}
		
		unset($data[$i]['label_postfix']);
		
		//追加数据
		$_query = $this->DB_slave->query("SELECT * FROM $this->addon_table WHERE iid = '$arr[id]' AND page != '1' ORDER BY page ASC");
		$j = 0;
		while($addon = $this->DB_slave->fetch_array($_query)){
			unset($addon['id'], $addon['iid'], $addon['page']);
			$data[$i]['addon'][$j] = $addon;
			
			$this->format_data($data[$i]['addon'][$j]);
			
			foreach($model['fields'] as $field => $field_data){
				if(!isset($addon[$field])) continue;
				
				//引用
				$data[$i]['addon'][$j]['field#'][$field] = &$data[$i]['addon'][$j][$field];
				//$data[$i]['addon'][$j]['field#'][$field] = &$data[$i]['addon'][$j][$field];
				//unset($data[$i]['addon'][$j][$field]);
			}
			
			$j++;
		}
		
		$i++;
	}
	if(empty($data)){
		$query = $this->DB_slave->query("SELECT * FROM $this->unverified_table WHERE id IN ($ids)");
		while($_data = $this->DB_master->fetch_array($query)){
			$model = $this->system->get_model($_data['model']);
			$_REQUEST['model'] = $_data['model'];
			$this->system->init_model();
			$this->set_model($_data['model']);
			$add_data = mb_unserialize($_data['data']);
			
			
			$data[$i] = array_merge($add_data['main'],$add_data['item']);
			$data[$i]['item_id'] = $_data['id'];
			$data[$i]['cid'] = $cid;
			$data[$i]['cname'] = $category->categories[$cid]['name'];
			$data[$i]['model'] = $_data['model'];
			$data[$i]['model_alias'] = $model['alias'];
			$data[$i]['frame'] = attachment_url($data[$i]['frame']);
			$data[$i]['verify_frame'] = attachment_url($data[$i]['verify_frame']);
			$data[$i]['attachment_pdf'] = attachment_url($data[$i]['attachment_pdf']);
			$data[$i]['comments'] = 0;
			$data[$i]['views'] = 0;
			$data[$i]['vid'] = 0;
			$data[$i]['attributes'] = $data[$i]['frame'] ? 6 : '';
			$data[$i]['action'] = 'add';
			$data[$i]['sc'] = 'c';
			$data[$i]['verify'] = $data[$i]['verified'];
			$data[$i]['link'] = $this->system->site_p8_url($this, $_data, 'view');
			$data[$i]['site'] = $_data['site'];
			
			$this->format_data($data[$i]);
			if($send_time_type==1)
				$timestamp = date('Y-m-d H:i:s',P8_TIME);
			elseif($send_time_type==2 && $send_time)
				$timestamp = $send_time;
			else
				$timestamp = date('Y-m-d H:i:s',$data[$i]['timestamp']);
			$data[$i]['timestamp'] = $data[$i]['list_order']  = $timestamp;
			
			foreach($model['fields'] as $field => $field_data){		
				//引用
				$table = $field_data['list_table'] ? 'item' : 'addon';
				$data[$i]['field#'][$field] = $add_data[$table][$field]; 
			}
			
			unset($data[$i]['label_postfix'],$data[$i]['data']);
			
		}		
	}
	return $data;
