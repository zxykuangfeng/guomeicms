<?php
defined('PHP168_PATH') or die();
global $USERNAME,$UID;
//P8_CMS_Item::move($id, $cid, $verified = true,$filter_word_enable = false){
	$ids = implode(',', (array)$id);
	global $USERNAME;
	if(!strlen($ids)){
		return false;
	}
	//强制审核
	$verified = true;
	if($verified){
		$T = $this->main_table;
		$fields = 'url, html_view_url_rule, pages, timestamp';
	}else{
		$T = $this->unverified_table;
		$fields = '';
	}
	
	$cat = $this->system->fetch_category($cid);
	if(empty($cat)) return false;
	
	require_once PHP168_PATH .'inc/html.func.php';
	
	//只能复制到相同模型的分类
	$query = $this->DB_slave->query("SELECT id, model ,timestamp FROM $this->main_table WHERE id IN ($ids) AND model = '$cat[model]'");
	$controller = &$this->core->controller($this);
	
	$data = array();
	$i = 0;
	$newids= array();
	while($arr = $this->DB_slave->fetch_array($query)){
		$model = $this->system->get_model($arr['model']);
		$_REQUEST['model'] = $arr['model'];
		$this->system->init_model();
		$this->set_model($arr['model']);
		
		$data[$i] = $this->DB_slave->fetch_one("SELECT * FROM $this->table AS i INNER JOIN $this->addon_table AS a ON i.id = a.iid WHERE i.id = '$arr[id]' AND page = '1'");
		
		$data[$i]['client_item_id'] = $arr['id'];
		$data[$i]['cid'] = $cid;
		$data[$i]['model'] = $arr['model'];
		$data[$i]['frame'] = attachment_url($data[$i]['frame']);
		$data[$i]['comments'] = 0;
		$data[$i]['views'] = 0;
		$data[$i]['level'] = 0;
		$data[$i]['level_time'] = 0;
		$data[$i]['vid'] = 0;
		$data[$i]['attribute'] = $data[$i]['frame'] ? array(6=>'6',12=>'12') : array(12=>'12');
		$data[$i]['action'] = 'add';
		$data[$i]['timestamp'] = $clone_time?$clone_time:date('Y-m-d H:i:s',$arr['timestamp']);
		$this->format_data($data[$i]);
		
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
		
		//if($controller->check_category_action('autoverify', $cid)){
		//	$data[$i]['verify'] = 1;
		//	$data[$i]['verifier'] = $USERNAME;
		//}
		$data[$i]['verify'] = 1;
		$data[$i]['verifier'] = $arr['verifier'];
		unset($data[$i]['list_order']);
		
		if($newid = $controller->add($data[$i],true,$filter_word_enable)){
			$this->DB_master->insert(
				$this->clone_table,
				array(
					'from_id' => $arr['id'],
					'to_id' => $newid,
					'action_uid' => $clone_uid,
					'action_username' => $USERNAME,
					'action_timestamp' => P8_TIME
				)
			);
			//更新源稿属性
			$attributes = explode(',', $data[$i]['attributes']);
			$attributes[] = '13';
			$attributes = array_filter($attributes);
			$attributes = implode(',',array_unique($attributes));
			$this->update_attribute($attributes,$arr['id'],$arr['cid']);
			$newids[] = $newid;
			//追加
			if(!empty($data[$i]['addon'])){
				foreach($data[$i]['addon'] as $vv){
					$vv['iid'] = $newid;
					$controller->addon($vv);
				}
			}
		}
		$i++;
	}
	if($newids){
		$newids = implode(',',$newids);
		//重新生成静态
		if(defined('P8_ADMIN')){
			global $P8LANG, $ADMIN_LOG;
			$ADMIN_LOG = array('title' => $P8LANG['_module_move_admin_log']);
		}
		$this->html($this->DB_master->query("SELECT * FROM $this->main_table WHERE id IN ($newids)"));
	}
	return true;
