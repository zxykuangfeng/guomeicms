<?php
defined('PHP168_PATH') or die();

//P8_CMS_Item::verify($data ($where, $value = 1, $verified = 1, $push_back_reason))
	/*
	verified = 2
	value =0
	*/
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

	/*
	verified = 0   	value =2   初审
					value = -99 退稿
	verified = 2    value = 0  撤回初审
					value = -99 退稿
	verified = -99  value = 2 初审
					value = 88 回收站
	*/
    global $P8LANG, $UID,$USERNAME;
    require_once PHP168_PATH. 'inc/verify_log.php';
    (new VerifyLog())->create('cms',$id,$P8LANG['cms_item']['verify'][$data['value']],$data['push_back_reason']);

	if($data['value'] == 1){
		//终审
		$num = 0;
		$orig_model = $this->model;
		
		$message = &$this->core->load_module('message');		
		$query = $this->DB_master->query("SELECT * FROM $this->unverified_table WHERE id IN ($ids)");

        while($_data = $this->DB_master->fetch_array($query)) {

            $add_data = mb_unserialize($_data['data']);

            $this->set_model($_data['model']);
            //针对处理终审数据的定时发布,发布时间在未来
            $create_time_release = !empty($add_data['create_time_release']) && $add_data['main']['timestamp'] > P8_TIME ? 1 : 0;
			$drafts_release = !empty($add_data['drafts_release']) ? 1 : 0;
            //信息设置了定时发布时，只修改状态
            if ($create_time_release) {
                $this->DB_master->update(
                    $this->unverified_table,
                    array(
                        'verified' => 66,
                    ),
                    "id = '$_data[id]'"
                );
            }else if($drafts_release){
				$this->DB_master->update(
                    $this->unverified_table,
                    array(
                        'verified' => 77,
                    ),
                    "id = '$_data[id]'"
                );				
			}else{				
                //审核通过放到主表里
                $add_data['verify'] = true;
                //针对计划任务中的定时发布
                if (isset($data['relase'])) $add_data['relase'] = true;
                //生成静态
                $add_data['html'] = true;
                $add_data['main']['cid'] = $add_data['item']['cid'] = $_data['cid'];
                $add_data['main']['pages'] = $add_data['item']['pages'] = $_data['pages'];
				$add_data['main']['verifier'] = $add_data['item']['verifier'] = $_data['verifier'] ? $_data['verifier'] : ($add_data['main']['verifier'] ? $add_data['main']['verifier'] : $USERNAME);
                $add_data['main']['verify_time'] = $add_data['item']['verify_time'] = time();
                //添加的时候修改分类内容数的逻辑已经有了,不用再写逻辑				
				$temp_p8lang = $P8LANG['cms_item']['verify'];
                if ($this->add($add_data)) {
                    //添加成功就删除未审核表里的数据
                    $this->DB_master->delete(
                        $this->unverified_table,
                        "id = '$_data[id]'"
                    );

                    $num++;
					//生成HTML
					if(!empty($add_data['html'])){				
						$category = $this->system->load_module('category');
						$category->get_cache();
						$cat = $category->categories[$add_data['main']['cid']];
						if(!empty($cat['htmlize'])){
							
							$this->html($this->DB_master->query("SELECT * FROM $this->main_table WHERE id = '$_data[id]'"));
							
							$this->html_list($cat['id']);
							//静态化父栏目
							global $core,$P8LANG, $ADMIN_LOG,$ACTION;
							$item_config = $core->get_config('cms','item');
							if(!empty($item_config['sync_list_to_html'])){
								$pids = $category->get_parents($cat['id']);
								foreach($pids as $pid){
									$this->html_list($pid['id']);
								}
							}			
							if(!empty($this->core->CONFIG['enable_mobile'])){
								$_GLOBALS['core']->ismobile=true;
								$this->core->ismobile=true;
								$this->html($this->DB_master->query("SELECT * FROM $this->main_table WHERE id = '$_data[id]'"));
								$this->html_list($cat['id'],true);
								//静态化父栏目
								if(!empty($item_config['sync_list_to_html'])){
									foreach($pids as $pid){
										$this->html_list($pid['id'],true);
									}
								}
								$_GLOBALS['core']->ismobile=false;
								$this->core->ismobile=false;
							}							
						}						
					}				
                }
				$P8LANG['cms_item']['verify'] = $temp_p8lang;
				//审核内容发送状态提醒消息，默认发送			
                if ($_data['uid'] && $_data['uid'] != $UID && empty($message->CONFIG['verify_send'])) {
                    $m = array(
                        'username' => $_data['username'],
                        'title' => $P8LANG['cms_item']['verify']['changed'],
                        'content' => p8lang($P8LANG['cms_item']['verify']['changed_message'], $_data['title'], $P8LANG['cms_item']['verify'][1], $data['push_back_reason']),
                        'system' => true
                    );
                    $message->send($m);
                }
                //推送审核
				if (!empty($_data['push_item_id']) && $this->core->modules['cluster']['installed']) {
                    $cluster = &$this->core->load_module('cluster');
                    if (!empty($cluster->CONFIG['clients'])) {
                        //echo 'ssssss';
                        $client = $cluster->load_service('client', 'cms_item');
                        $client->set_push_item_status($_data['push_item_id'], 1);
                    }
                }
				if(!empty($_data['push_item_id'])){
					$sites_system = $this->core->load_system('sites');
					if($sites_system){
						$stop = $sites_system->load_module('stop');
						$stop->set_push_item_status($_data['push_item_id']);
					}					
				}			
				$systems = &$this->core->list_systems();			
				if(isset($systems['sites']) && $systems['sites']['installed'] && $systems['sites']['enabled']){
					$stop_table = $this->core->TABLE_.'sites_stop_data';
					$new_id = $_data['id'];
					$new_data = $this->DB_master->fetch_one("select `id`,`push_username` from $stop_table where `new_id` = $new_id");
					if($new_data['id']){
						$this->DB_master->update(
							$stop_table,
							array(
								'status' => 1,							
							),
							"id = '$new_data[id]'"
						);
					}
					//审核内容发送状态提醒消息，默认发送			
					if(!empty($new_data) && $new_data['push_username'] && empty($message->CONFIG['verify_send'])){
						if($new_data['push_username'] && $USERNAME != $new_data['push_username'] && $_data['username'] != $new_data['push_username']) {
							$m = array(
								'username' => $new_data['push_username'],
								'title' => $P8LANG['cms_item']['verify']['changed'],
								'content' => p8lang($P8LANG['cms_item']['verify']['changed_message'], $_data['title'], $P8LANG['cms_item']['verify'][1], $data['push_back_reason']),
								'system' => true
							);							
							$message->send($m);
						}
					}				
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
		//取消审核、初审或未通过

		$num = 0;		
		$orig_model = $this->model;
		
		if($data['verified'] == 1){
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
			if($data['verified']==1){
				//var_dump($main);exit;
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
						$_no_page_file = preg_replace('/#([^#]+)#/', '', $file);
						$_page_file = preg_replace('/#([^#]+)#/', '$1', $file);
						
						for($i = 1; $i <= $main['pages']; $i++){
							$file = $i == 1 ? $_no_page_file : str_replace('?page?', $i, $_page_file);
							@unlink($file);
						}
					}
					$this->html_list($main['cid']);
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
			
			$lang_status = in_array($data['value'], array(0,1,2,66,77,88,-99)) ?
				$P8LANG['cms_item']['verify'][$data['value']] :
				$this->CONFIG['verify_acl'][$data['value']]['name'];
			
			$m = array(
				'username' => $main['username'],
				'title' => $P8LANG['cms_item']['verify']['changed'],
				'content' => p8lang($P8LANG['cms_item']['verify']['changed_message'], $main['title'], $lang_status, $data['push_back_reason']),
				'system' => true
			);
			//审核内容发送状态提醒消息，默认发送
			if(empty($message->CONFIG['verify_send'])) $message->send($m);
			//is it pushed data ? AND then send message later;
			$systems = &$this->core->list_systems();			
			if(isset($systems['sites']) && $systems['sites']['installed'] && $systems['sites']['enabled']){
				$stop_table = $this->core->TABLE_.'sites_stop_data';
				$new_id = $main['id'];
				$new_data = $this->DB_master->fetch_one("select `id`,`push_username` from $stop_table where `new_id` = $new_id");
				if($new_data['id']){
					$this->DB_master->update(
						$stop_table,
						array(
							'status' => $data['value'],
						),
						"id = '$new_data[id]'"
					);
				}
				//审核内容发送状态提醒消息，默认发送
				if(!empty($new_data) && $new_data['push_username'] && empty($message->CONFIG['verify_send'])){
					if($new_data['push_username'] && $USERNAME != $new_data['push_username'] && $main['username'] != $new_data['push_username']) {
						$m = array(
							'username' => $new_data['push_username'],
							'title' => $P8LANG['cms_item']['verify']['changed'],
							'content' => p8lang($P8LANG['cms_item']['verify']['changed_message'], $main['title'], $P8LANG['cms_item']['verify'][1], $data['push_back_reason']),
							'system' => true
						);
						$message->send($m);
					}
				}				
			}		
				
			$this->data('delete', $main['id']);
			
			$num++;
		}
		
		//取消审核的要更新分类的内容数
		if($data['verified'] == 1){
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