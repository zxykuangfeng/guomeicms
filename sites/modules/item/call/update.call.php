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
		
		//添加属性
		$this->add_attribute($data['main']['attributes'], $id, $data['main']['cid']);
		
		//添加tag
		$this->add_tag($data['item']['keywords'], $id, 'update');
		
		$cid = $data['main']['cid'];
		if($data['main']['cid'] != $orig_data['cid']){
			$move = true;
			unset($data['main']['cid'], $data['item']['cid']);
		}
		//修改己审核的数据
		
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
				if($cat['htmlize']){					
					//$this->html($this->DB_master->query("SELECT * FROM $this->main_table WHERE id = '$id'"));
                    //$this->html_list($cat['id']);
					global $core,$P8LANG, $ADMIN_LOG, $ACTION;
					/*
					$item_config = $core->get_config('sites','item');
					if(!empty($item_config['sync_list_to_html'])){
						$category = &$this->system->load_module('category');
						$pids = $category->get_parents($cat['id']);
						foreach($pids as $pid){
							$this->html_list($pid['id']);
						}
					}
					*/
					if($data['main']['cid'] != $orig_data['cid']) $this->html_list($orig_data['cid']);
					$ACTION = 'update';
					$ADMIN_LOG = array('title' => $P8LANG['_module_update_admin_log']);
                }
			}
			//改变发布时间则删除原来的静态
			if($orig_data['timestamp'] != $data['main']['timestamp']){
				require_once PHP168_PATH .'inc/html.func.php';
				$category = &$this->system->load_module('category');
				$arr = $data['main'];											
				$arr['timestamp'] = $orig_data['timestamp'];
				$arr['#category'] = &$category->categories[$orig_data['cid']];
				$file = p8_html_url($this, $arr, 'view', false);
				$file = str_replace('/sites//','/sites/html/'.$this->system->SITE.'/',$file);
				$_no_page_file = preg_replace('/#([^#]+)#/', '', $file);
				$_page_file = preg_replace('/#([^#]+)#/', '$1', $file);						
				for($i = 1; $i <= $orig_data['pages']; $i++){
					$file = $i == 1 ? $_no_page_file : str_replace('?page?', $i, $_page_file);
					@unlink($file);
				}
			}
		}
		
		//与主站对接数据
		if(!empty($cat['matrix']) && !defined('P8_CLUSTER')){
			$info_iid = $this->DB_master->fetch_one("SELECT * FROM $this->matrix_table WHERE sid = '$id'");
			if($info_iid){
				$cms = &$this->core->load_system('cms');
				$item = &$cms->load_module('item');
				$category = &$cms->load_module('category');
				$category->get_cache();
				$controller = &$this->core->controller($item);
				$data = $this->cluster_data($id, $data['main']['cid'],0);		
				foreach($data as $v){
					$v['cid'] = $cat['matrix'];
					$_REQUEST['model'] = $category->categories[$v['cid']]['model'];
					$cms->init_model();
					$item->set_model($_REQUEST['model']);					
					$v['verify'] = 1;					
					//没有来源设置一下
					$v['source'] = $v['source'] ? $v['source'] : $this->system->site['sitename'] .'|'. $this->system->site['domain'];					
					$iid = $controller->update($info_iid['iid'], $v, true,true);
					unset($cid);
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
			
			if($status = $this->add($data)){
				//添加后删除旧数据
				$this->DB_master->delete($this->unverified_table, "id = '$id'");
			}
			
		}else{
			$this_verified = !empty($data['drafts_release']) ? 77 : 0;
			$status = $this->DB_master->update(
				$this->unverified_table,
				array(
					'cid' => $data['main']['cid'],
					'title' => $data['main']['title'],
					'timestamp' => $data['main']['timestamp'],
					'verified' => $this_verified,				//修改后为待审
					'data' => $this->DB_master->escape_string(serialize($data))
				),
				"id = '$id'"
			);
			
		}
		
	}

	
	return $status;
