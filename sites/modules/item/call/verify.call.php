<?php
defined('PHP168_PATH') or die();

//P8_sites_Item::verify($data ($where, $value = 1, $verified = 1, $push_back_reason))
	
	$T = $data['value'] == 1 ? $this->unverified_table : $this->main_table;
	$T = $data['verified'] == 1 ? $this->main_table : $this->unverified_table;
	$query = $this->DB_master->query("SELECT
		$T.id, $T.cid, $T.model, $T.uid, $T.verified,$T.ever_verified, m.role_id FROM $T 
		LEFT JOIN {$this->system->member_table} m ON $T.uid = m.id 
		WHERE $data[where]");

	$ids = $comma = '';
	$credit_info = $id = array();
	//$model_ids = array();

	$num = 0;
	while($arr = $this->DB_master->fetch_array($query)){
		if($data['value'] == $arr['verified']) continue;
		$id[] = $arr['id'];
		$ids .= $comma . $arr['id'];
		$comma = ',';
		if(empty($arr['ever_verified'])){
			//已经通过一次审核就不再应用积分规则
			$credit_info[] = array($arr['uid'], $arr['role_id'], $arr['cid']);
		}
		
		$num++;
	}
	if(!$num) return $id;
	
	//修改会员关系表
	$this->DB_master->update(
		$this->member_table,
		array('verified' => $data['value']),
		"iid IN ($ids)"
	);
    global $P8LANG, $UID,$USERNAME;
    require_once PHP168_PATH. 'inc/verify_log.php';
    (new VerifyLog())->create('sites',$id,$P8LANG['sites_item']['verify'][$data['value']],$data['push_back_reason']);

if($data['value'] == 1 && $data['verified'] == 0){
		//终审
		$num = 0;
		
		$orig_model = $this->model;
		

		$message = &$this->core->load_module('message');
		
		$query = $this->DB_master->query("SELECT * FROM $this->unverified_table WHERE id IN ($ids)");
		while($_data = $this->DB_master->fetch_array($query)){
			
			$add_data = mb_unserialize($_data['data']);
			$this->set_model($_data['model']);
			$drafts_release = !empty($add_data['drafts_release']) ? 1 : 0;
			//审核通过放到主表里
			$add_data['verify'] = true;
			//生成静态
			$add_data['html'] = true;
			$add_data['main']['cid'] = $add_data['item']['cid'] = $_data['cid'];
			$add_data['main']['pages'] = $add_data['item']['pages'] = $_data['pages'];
			$add_data['main']['verifier'] = $add_data['item']['verifier'] = $USERNAME;
			if($drafts_release){
				$this->DB_master->update(
                    $this->unverified_table,
                    array(
                        'verified' => 77,
                    ),
                    "id = '$_data[id]'"
                );				
			}else{
				//添加的时候修改分类内容数的逻辑已经有了,不用再写逻辑
				if($this->add($add_data)){
					//添加成功就删除未审核表里的数据
					$this->DB_master->delete(
						$this->unverified_table,
						"id = '$_data[id]'"
					);
					
					$num++;
					//生成HTML
					if(!empty($add_data['html'])){
						$category = &$this->system->load_module('category');
						$category->get_cache(true,$add_data['main']['site']);
						$cat = $category->categories[$add_data['main']['cid']];					
						if(!empty($cat['htmlize'])){		
							$this->html($this->DB_master->query("SELECT * FROM $this->main_table WHERE id = '$_data[id]'"),$add_data['main']['site']);
							$this->html_list($cat['id'],false,$add_data['main']['site']);
							global $core,$P8LANG, $ADMIN_LOG, $ACTION;
							$item_config = $core->get_config('sites','item');
							if(!empty($item_config['sync_list_to_html'])){
								$pids = $category->get_parents($cat['id']);
								foreach($pids as $pid){
									$this->html_list($pid['id'],false,$add_data['main']['site']);
								}
							}							
						}
					}
				}
			
				if($_data['push_item_id']){
					$stop = $this->system->load_module('stop');
					//设置接收端
					$push_id = $stop->set_receive_status(array($this->system->SITE), $_data['push_item_id'],1,$_data['id']);
					//设置发送端
					if($push_id) $stop->set_push_item_status($_data['id'],1,array($this->system->SITE), $push_id['id']);
				}
				//审核内容发送状态提醒消息，默认发送
				if($_data['uid'] && $_data['uid'] != $UID && empty($message->CONFIG['verify_send'])){
					$m = array(
						'username' => $_data['username'],
						'title' => $P8LANG['sites_item']['verify']['changed'],
						'content' => p8lang($P8LANG['sites_item']['verify']['changed_message'], $_data['title'], $P8LANG['sites_item']['verify'][1], $data['push_back_reason']),
						'system' => true
					);
					$message->send($m);
				}
				
				$this->data('delete', $_data['id']);
			}
		}
		
		
		if($num){
            $credit = &$this->core->load_module('credit');
            //应用积分规则
			foreach($id as $each_id){
				foreach($credit_info as $v){
					$credit->apply_rule($this,'verify',$v[0], $v[1],'',$each_id,$data['push_back_reason']);
				}
			}
        }
		
        $this->set_model($orig_model);

        return $id;
		
	}else{
		
		//取消审核或未通过
		$num = 0;
		
		$orig_model = $this->model;
		
		if($data['verified']){
			$T = $this->main_table;
			$category = $this->system->load_module('category');
			$category->get_cache();
			$delete_file = array();
			
			//取消审核的要删除静态文件
			require_once PHP168_PATH .'inc/html.func.php';
		}else{
			$T =  $this->unverified_table;
		}
		
		$message = &$this->core->load_module('message');
		global $P8LANG;
		
		$cids = $user_item_count = array();
		$query = $this->DB_master->query("SELECT * FROM $T WHERE id IN ($ids)");
		while($main = $this->DB_master->fetch_array($query)){
			
			if($data['verified']){
				//取消审核
				$this->set_model($main['model']);
				$_data = array();
				$_data['main'] = $main;
				$_data['item'] = $this->DB_master->fetch_one("SELECT * FROM $this->table WHERE id = '$main[id]'");
				$_data['addon'] = $this->DB_master->fetch_one("SELECT * FROM $this->addon_table WHERE iid = '$main[id]' AND page = 1");
				
				$cids[$main['cid']] = isset($cids[$main['cid']]) ? $cids[$main['cid']] +1 : 1;
				$user_item_count[$arr['uid']] = isset($user_item_count[$arr['uid']]) ? $user_item_count[$arr['uid']] +1 : 1;
				
				//插入到未审核表
				$this->DB_master->insert(
					$this->unverified_table,
					array(
						'id' => $main['id'],
						'model' => $main['model'],
						'cid' => $main['cid'],
						'site' => $main['site'],
						'title' => $main['title'],
						'uid' => $main['uid'],
						'username' => $main['username'],
						'attributes' => $main['attributes'],
						'timestamp' => $main['timestamp'],
						'source' => $main['source'],
						'verified' => $data['value'],
                        'verifier' => $USERNAME,
						'pages' => $main['pages'],
						'ever_verified' => $main['ever_verified'],
						'data' => $this->DB_master->escape_string(serialize($_data)),
						'push_back_reason' => $data['push_back_reason']
					)
				);
				
				//删除原来的数据
				$this->DB_master->delete($this->main_table, "id = '$main[id]'");
				$this->DB_master->delete($this->table, "id = '$main[id]'");
				$this->DB_master->delete($this->addon_table, "iid = '$main[id]' AND page = 1");
				
				
				if(!empty($category->categories[$main['cid']]['htmlize'])){
					//获取要删除的HTML文件
					$main['#category'] = &$category->categories[$main['cid']];
					if($file = p8_html_url($this, $main, 'view', false)){
						$file = str_replace('/sites//','/sites/html/'.$this->system->SITE.'/',$file);			
						$_no_page_file = preg_replace('/#([^#]+)#/', '', $file);
						$_page_file = preg_replace('/#([^#]+)#/', '$1', $file);
						for($i = 1; $i <= $main['pages']; $i++){
							$file = $i == 1 ? $_no_page_file : str_replace('?page?', $i, $_page_file);
							@unlink($file);							
						}
					}
					$this->html_list($main['cid'],false,$main['site']);
				}
				
			}else{
				
				//修改未审核状态
				$this->DB_master->update(
					$this->unverified_table,
					array(
						'verified' => $data['value'],
                        'verifier' => $USERNAME,
						'push_back_reason' => $data['push_back_reason']
					),
					"id = '$main[id]'"
				);
				
			}
			
			$lang_status = in_array($data['value'], array(0, 1, -99)) ? 
				$P8LANG['sites_item']['verify'][$data['value']] :
				$this->CONFIG['verify_acl'][$data['value']]['name'];
			
			$m = array(
				'username' => $main['username'],
				'title' => $P8LANG['sites_item']['verify']['changed'],
				'content' => sprintf($P8LANG['sites_item']['verify']['changed_message'], $main['title'], $lang_status, $data['push_back_reason']),
				'system' => true
			);
			//审核内容发送状态提醒消息，默认发送
			if(empty($message->CONFIG['verify_send'])) $message->send($m);
			
			$this->data('delete', $main['id']);
			
			$num++;
		}
		
		//取消审核的要更新分类的内容数
		if($data['verified']){
			foreach($cids as $cid => $v){
				$category->update_count($cid, -$v);
			}
			
			//批量更新会员内容数
			foreach($user_item_count as $uid => $count){
				$this->DB_master->update(
					$this->system->member_table,
					array(
						'item_count' => 'item_count -'. $count
					),
					"id = '$uid'",
					false
				);
			}
		}
		
		$this->set_model($orig_model);
		
		return $id;
	}
	
	return $id;
