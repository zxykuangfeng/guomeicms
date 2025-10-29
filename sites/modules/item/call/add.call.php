<?php
defined('PHP168_PATH') or die();

//P8_CMS_Item::add(&$data)
	
	//通过审核
	$verified = false;
	
	$ever_verified = empty($data['main']['ever_verified']) ? 0 : 1;
	
	if($data['verify'] == 1){
		$verified = true;
		$data['main']['verified'] = $data['item']['verified'] = $data['main']['ever_verified'] = 1;
	}else{
		$data['main']['verified'] = $data['item']['verified'] = 0;
	}
	//草稿箱
	if($data['drafts_release']){
		$verified = false;
		$data['main']['verified'] = $data['item']['verified'] = $data['verified'] = 77;
	}
	//插入主表取得ID
	$id = $this->DB_master->insert(
		$this->main_table,
		$this->DB_master->escape_string($data['main']),
		array('return_id' => true)
	);
	
	//原本的ID,非递增
	$id = isset($data['main']['id']) ? $data['main']['id'] : $id;
	
	if(empty($id)) return false;
	
	//收集己上传的附件
	if(isset($data['attachment_hash'])){
		uploaded_attachments($this, $id, $data['attachment_hash']);
		unset($data['attachment_hash']);
	}
	
	if(!isset($data['main']['id'])){
		//会员数据表
		$this->DB_master->insert(
			$this->member_table,
			array(
				'iid' => $id,
				'uid' => $data['item']['uid'],
				'model' => $data['main']['model'],
				'verified' => $data['main']['verified'],
				'timestamp' => $data['item']['timestamp']
			)
		);
	}
	
	//更新会员的内容数
	$this->DB_master->update(
		$this->system->member_table,
		array(
			'item_count' => 'item_count +1'
		),
		"id = '{$data['main']['uid']}'",
		false
	);
	
	
	//未审核
	if(!$verified){
		$data['main']['id'] = $id;
		
		//未审核的放到另一个表
		
		$this->DB_master->insert(
			$this->unverified_table,
			array(
				'id' => $id,
				'model' => $data['main']['model'],
				'cid' => $data['main']['cid'],
				'site' => $data['main']['site'],
				'title' => $data['main']['title'],
				'uid' => $data['main']['uid'],
				'username' => $data['main']['username'],				
				'attributes' => $data['main']['attributes'],
				'timestamp' => $data['main']['timestamp'],
				'level' => $data['main']['level'],
				'level_time' => $data['main']['level_time'],
				'verified' => $data['main']['verified'],
				'source' => $data['main']['source'],
				'push_item_id' => isset($data['push_item_id']) ? $data['push_item_id'] : 0,
				'data' => $this->DB_master->escape_string(serialize($data))
			)
		);
		
		//删除
		$this->DB_master->delete(
			$this->main_table,
			"id = '$id'"
		);
		
		//返回,审核通过的时候再执行此方法插入数据
		return $id;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	//己审核
	$data['item']['id'] = $id;
	$data['item'] = $this->DB_master->escape_string($data['item']);
	$this->DB_master->insert(
		$this->table,
		$data['item']
	);
	
	//追加表
	$data['addon'] = $this->DB_master->escape_string($data['addon']);
	$data['addon']['iid'] = $id;	//内容ID
	$data['addon']['page'] = 1;		//页码
	$this->DB_master->insert(
		$this->addon_table,
		$data['addon']
	);
	
	//添加属性
	$this->add_attribute($data['main']['attributes'], $id, $data['main']['cid']);
	$this->add_tag($data['item']['keywords'], $id);
	
	//更新分类记录数
	$category = &$this->system->load_module('category');
	$category->update_count($data['item']['cid'], 1);
	
	//没有审核过,新添加的
	if(!$ever_verified && empty($data['main']['id'])){
		$credit = &$this->core->load_module('credit');
		//应用积分规则
		$credit->apply_rule(
			$this,
			'verify',
			$data['main']['uid'], $this->system->ROLE,'',
			$id,'发布新内容'
		);
		/*
		$cluster = &$this->core->load_module('cluster');
		$service = &$cluster->load_service('client', $this->system->name .'_item');
		
		$map = array_flip($service->CONFIG['map']);
		$_data = $this->cluster_data($id, $map[$data['main']['cid']]);
		$cluster->server_call($this->system->name .'_item', 'push', $_data, true);
		*/
	}
	$cat = $category->categories[$data['main']['cid']];
	//var_dump(!defined('P8_CLUSTER'));
	//if(!empty($data['html']) && !defined('P8_CLUSTER')){
	//if(!empty($data['html'])){
	if(!empty($data['html']) && defined('P8_CLUSTER') && defined('P8_API')){
		//生成HTML
		if(empty($cat)){
			$category->get_cache(true,$data['main']['site']);
			$cat = $category->categories[$data['main']['cid']];
		}
		if(!empty($cat['htmlize'])){			
			$this->html($this->DB_master->query("SELECT * FROM $this->main_table WHERE id = '$id'"));
            $this->html_list($cat['id']);
			global $core,$P8LANG, $ADMIN_LOG, $ACTION;
			$item_config = $core->get_config('sites','item');
			if(!empty($item_config['sync_list_to_html'])){
				$pids = $category->get_parents($cat['id']);
				foreach($pids as $pid){
					$this->html_list($pid['id']);
				}
			}			
			$ACTION = 'add';
			$ADMIN_LOG = array('title' => $P8LANG['_module_add_admin_log']);			
		}
	}
	
	$data['main']['id'] = $id;
	
	$this->data('write', $data['main']);
	
	//与主站对接数据
	if(!empty($cat['matrix']) && !defined('P8_CLUSTER')){
		$cms = &$this->core->load_system('cms');
		$item = &$cms->load_module('item');
		$category = &$cms->load_module('category');
		$category->get_cache();
		$controller = &$this->core->controller($item);
		$data = $this->cluster_data($id, $data['main']['cid']);		
		foreach($data as $v){
			$scid = $v['cid'];
			$v['html'] = 1;
			$v['filter_word_enable'] = 1;
			$v['content_censor_enabled'] = 1;
			$v['cid'] = $cat['matrix'];
			$_REQUEST['model'] = $category->categories[$v['cid']]['model'];
			$cms->init_model();
			$item->set_model($_REQUEST['model']);
			
			$v['verify'] = 1;
			/*
			if($controller->check_category_action('autoverify', $v['cid'])){
				$v['verify'] = 1;
			}else{
				$v['verify'] = 0;
			}
			*/
			//没有来源设置一下
			$v['source'] = $v['source'] ? $v['source'] : $this->system->site['sitename'] .'|'. $this->system->site['domain'];
			if($iid = $controller->add($v,true,false)){
				$ret[] = $iid;
				//追加
				if(!empty($v['addon'])){
					foreach($v['addon'] as $vv){
						$vv['iid'] = $iid;
						
						$controller->addon($vv);
					}
				}
				//数据对应表
				$this->DB_master->insert(
					$this->matrix_table,
					array(
						'id' => null,
						'sid' => $id,
						'scid' => $scid,
						'cid' => $v['cid'],
						'iid' => $iid,						
					)
				);
				
			}
			unset($cid);
		}
	}
	return $id;
