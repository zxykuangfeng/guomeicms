<?php
defined('PHP168_PATH') or die();

//P8_CMS_Item::add(&$data)
	
	//通过审核
	$verified = false;
	$ever_verified = empty($data['main']['ever_verified']) ? 0 : 1;
	//检查是否终审权限

    $autoVerify = false;
    if(!empty($this->core->modules['auditflow']) && $this->core->modules['auditflow']['enabled'] && !empty($this->core->CONFIG['audit_flow_enable'])){
        $auditFlow = &$this->core->load_module('auditflow');
        $autoVerify = $auditFlow->checkAuto($data['main']['cid'], $data['main']['uid'] );
    }
	if($data['verify'] == 1 or $autoVerify){
		$verified = true;
		$data['main']['verified'] = $data['item']['verified'] = $data['main']['ever_verified'] = 1;
		//针对处理终审数据的定时发布,发布时间在未来,暂存到非审核表
        $create_time_release = !empty($data['create_time_release']) && $data['main']['timestamp'] > P8_TIME ? 1 : 0;
		if($create_time_release){
			$verified = false;
			$data['main']['verified'] = $data['item']['verified'] = 66;
		}		
	}elseif($data['verified'] == 2){
	    //检查是否有审核过
		$data['main']['verified'] = $data['item']['verified'] = 2;
	}else{
	    //默认状态为0
		$data['main']['verified'] = $data['item']['verified'] = 0;
	}
	//草稿箱
	if($data['drafts_release']){
		$verified = false;
		$data['main']['verified'] = $data['item']['verified'] = $data['verified'] = 77;
	}
	//如果是计划任务中的自动定时发布，设置为1
	if(isset($data['relase'])) {
	    $verified = true;
        $data['main']['verified'] = $data['item']['verified'] = 1;
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
				'title' => $data['main']['title'],
				'uid' => $data['main']['uid'],
				'username' => $data['main']['username'],
				'attributes' => $data['main']['attributes'],
				'timestamp' => $data['main']['timestamp'],
				'source' => $data['main']['source'],
				'level' => $data['main']['level'],
				'level_time' => $data['main']['level_time'],
				'verified' => $data['main']['verified'],
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
		//$credit->apply_rule($this,'verify',$v[0], $v[1],'',$each_id,$data['push_back_reason']);
		/*
		$cluster = &$this->core->load_module('cluster');
		$service = &$cluster->load_service('client', $this->system->name .'_item');
		
		$map = array_flip($service->CONFIG['map']);
		$_data = $this->cluster_data($id, $map[$data['main']['cid']]);
		$cluster->server_call($this->system->name .'_item', 'push', $_data, true);
		*/
	}
	//if(!empty($data['html']) && (!defined('P8_CLUSTER') || defined('P8_API'))){
	if(!empty($data['html']) && (isset($data['relase']) || (defined('P8_CLUSTER') && defined('P8_API')))){
		//生成HTML
		$cat = $category->categories[$data['main']['cid']];
		if(!empty($cat['htmlize'])){
			
			$this->html($this->DB_master->query("SELECT * FROM $this->main_table WHERE id = '$id'"));
            
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
				$this->html($this->DB_master->query("SELECT * FROM $this->main_table WHERE id = '$id'"));
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
			
			$ACTION = 'add';
			$ADMIN_LOG = array('title' => $P8LANG['_module_add_admin_log']);
		}
		
	}
    $reflashindex = false;//为了首页显示
    if($reflashindex && !defined('P8_CLUSTER')){   

        if($this->core->ismobile)return;    
        //抗干扰
        //unset($this_module, $CAT, $data, $TITLE, $SEO_KEYWORDS, $SEO_DESCRIPTION);
        
        require_once PHP168_PATH .'inc/cache.func.php';
        cache_label();  
        clear_page_cache();

        //定义生成静态的常量
        defined('P8_GENERATE_HTML') or define('P8_GENERATE_HTML', true);

        $_SERVER['_REQUEST_URI'] = '/index.php/cms';
        
        foreach(array_keys($GLOBALS) as $v){
            global $$v;
        }

        ob_start();
        require PHP168_PATH .'index.php';

        $content = ob_get_clean();

        $index_file = &$this->system->index_files[$this_system->CONFIG['index_file']];
		$index_file = $index_file ? $index_file : 'index.html';
        if($this->core->CONFIG['index_system'] == $this_system->name){
            write_file(PHP168_PATH . $index_file, $content);
            @chmod(PHP168_PATH . $index_file, 0644);
        }
        
    }
	
	$data['main']['id'] = $id;
	
	$this->data('write', $data['main']);
	
	return $id;
