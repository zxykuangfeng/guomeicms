<?php
defined('PHP168_PATH') or die();

//P8_CMS_Item::update($id, &$data, &$orig_data, $verified = true)
	
	$status = true;
	
	//收集己上传的附件
	if(isset($data['attachment_hash'])){
		uploaded_attachments($this, $id, $data['attachment_hash']);
		unset($data['attachment_hash']);
	}
	//草稿箱
	if($data['drafts_release']){
		$verified = false;
		$data['main']['verified'] = $data['item']['verified'] = $data['verified'] = 77;
	}
	if($verified){
		//修改己审核的数据
		//添加属性
		$this->add_attribute($data['main']['attributes'], $id, $data['main']['cid']);
	
		//添加tag
		$this->add_tag($data['item']['keywords'], $id, 'update');
		$cid = $data['main']['cid'];
		if($data['main']['cid'] != $orig_data['cid']){
			$move = true;
			unset($data['main']['cid'], $data['item']['cid']);
		}
		
		if($data['create_time_release']){
			//已审核的数据，定时发布
			$data['main']['id'] = $data['item']['id'] = $data['addon']['id'] = $id;			
			$data['main']['pages'] = $data['item']['pages'] = $data['addon']['page'] = $orig_data['pages'];			
			$data['main']['uid'] = $data['item']['uid'] = $orig_data['uid'];
			$data['main']['username'] = $data['item']['username'] = $orig_data['username'];
			$data['main']['model'] = $data['item']['model'] = $orig_data['model'];
			if($status = $this->add($data)){
				//添加后删除旧数据
				$a = $this->DB_master->delete($this->main_table, "id = '$id'");
				$b = $this->DB_master->delete($this->table, "id = '$id'");
				$c = $this->DB_master->delete($this->table.'addon', "iid = '$id'");				
			}
		}else{
			$status |= $this->DB_master->update(
				$this->main_table,
				$this->DB_master->escape_string($data['main']),
				"id = '$id'"
			);
			
			$status |= $this->DB_master->update(
				$this->table,
				$this->DB_master->escape_string($data['item']),
				"id = '$id'"
			);
			
			unset($data['addon']['page']);
			
			//只能修改第一页的追加内容
			$status |= $this->DB_master->update(
				$this->addon_table,
				$this->DB_master->escape_string($data['addon']),
				"iid = '$id' AND page = 1"
			);

			$data['main']['id'] = $id;
			$data['main']['uid'] = $orig_data['uid'];
			$data['main']['model'] = $orig_data['model'];
			$data['main']['pages'] = $orig_data['pages'];
			$data['main']['cid'] = $cid;
			$this->data('write', $data['main']);
			
			if(isset($move)){
				//移动了分类
				$this->move($id, $cid, $verified);
			}
					
			if(!$data['verify']){
				//修改后变为未审核
				$this->verify(array(
					'where' => $this->main_table.".id = '$id'",
					'value' => 0,
					'verified' => $verified,
					'push_back_reason' => ''
				));
				
			}else{
				
				/*
				if(!empty($this->CONFIG['sphinx']['enabled'])){
					$attr = array(
						'cid' => $data['main']['cid'],
						'list_order' => $data['main']['list_order']
					);
					
					foreach($this_model['filterable_fields'] as $k => $v){
						$attr[$k] = $data['item'][$k];
					}
					
					$sphinx = p8_sphinx($this->CONFIG['sphinx']['host'], $this->CONFIG['sphinx']['port']);
					$sphinx->UpdateAttributes(
						$this->system->name .'-item-'. $mod,
						array($id => $attr)
					);
				}
				*/
				if(!empty($data['html'])){
					//生成静态
					$cat = $this->system->fetch_category($data['main']['cid']);
					global $core,$P8LANG, $ADMIN_LOG,$ACTION;
					if($cat['htmlize']){					
						//$this->html($this->DB_master->query("SELECT * FROM $this->main_table WHERE id = '$id'"));
						//$this->html_list($cat['id']);
						//静态化父栏目
						/*
						$item_config = $core->get_config('cms','item');
						if(!empty($item_config['sync_list_to_html'])){
							$category = &$this->system->load_module('category');
							$pids = $category->get_parents($cat['id']);
							foreach($pids as $pid){
								$this->html_list($pid['id']);
							}
						}
						*/
						if($data['main']['cid'] != $orig_data['cid']) $this->html_list($orig_data['cid']);
					}
					/*
					if(!empty($this->core->CONFIG['enable_mobile'])){
						$_GLOBALS['core']->ismobile=true;
						$this->core->ismobile=true;
						$this->html($this->DB_master->query("SELECT * FROM $this->main_table WHERE id = '$id'"));
                        $_GLOBALS['core']->ismobile=false;
                        $this->core->ismobile=false;
                    }
					*/
					$ACTION = 'update';
					$ADMIN_LOG = array('title' => $P8LANG['_module_update_admin_log']);
				}
				//改变发布时间则删除原来的静态
				if($orig_data['timestamp'] != $data['main']['timestamp']){
					require_once PHP168_PATH .'inc/html.func.php';
					$category = &$this->system->load_module('category');
					$arr = $data['main'];											
					$arr['timestamp'] = $orig_data['timestamp'];
					$arr['#category'] = &$category->categories[$orig_data['cid']];
					$file = p8_html_url($this, $arr, 'view', false);
					$_no_page_file = preg_replace('/#([^#]+)#/', '', $file);
					$_page_file = preg_replace('/#([^#]+)#/', '$1', $file);
					for($i = 1; $i <= $orig_data['pages']; $i++){
						$file = $i == 1 ? $_no_page_file : str_replace('?page?', $i, $_page_file);
						@unlink($file);
					}
				}
			}
		}
	}else{
		//修改未审核的数据
		$_data = mb_unserialize($orig_data['data']);
		//用新数据合并旧的数据
		$data['main'] = array_merge($_data['main'], $data['main']);
		$data['item'] = array_merge($_data['item'], $data['item']);
		$data['addon'] = array_merge($_data['addon'], $data['addon']);
		if($data['verify']){
			//通过审核
			
			if(!$data['create_time_release']){
				if($status = $this->add($data)){
					//添加后删除旧数据
					$this->DB_master->delete($this->unverified_table, "id = '$id'");
				}
			}else{
				$status = $this->DB_master->update(
					$this->unverified_table,
					array(
						'cid' => $data['main']['cid'],
						'title' => $data['main']['title'],
						'verified' => 66,
						'data' => $this->DB_master->escape_string(serialize($data))
					),
					"id = '$id'"
				);
				
			}
			
		}else{
			$verified = isset($data['verified_flag']) && !empty($data['verified_flag']) ? intval($data['verified_flag']) : 0;
			$verified = !empty($data['drafts_release']) ? 77 : $verified;
			$status = $this->DB_master->update(
			$this->unverified_table,
				array(
					'cid' => $data['main']['cid'],
					'title' => $data['main']['title'],
					'timestamp' => $data['main']['timestamp'],
					'verified' => $verified,
					'data' => $this->DB_master->escape_string(serialize($data))
				),
				"id = '$id'"
			);
			
		}
		
	}
	
	return $status;
