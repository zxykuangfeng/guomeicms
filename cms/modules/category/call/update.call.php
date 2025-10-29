<?php
defined('PHP168_PATH') or die();

//P8_CMS_Category::update($id, &$data, &$orig_data)
	$this->get_cache();
	$ids = $this->get_children_ids($id) + array($id);
	//不能把父分类移动到其子分类去
	if(in_array($data['parent'], $ids)) return false;
	unset($data['auto_label_postfix']);
	$status = $this->DB_master->update(
		$this->table,
		$data,
		"id = '$id'"
	);
	//如果是外链，以下就无关紧要了
	if($data['type'] == 3){
		$this->cache(false, true, $ids);
	
		return $status;
	}
	if($data['parent'] != $this->categories[$id]['parent']){
		//移动过分类
		
		//$orig_data = $this->DB_master->fetch_one("SELECT item_count FROM $this->table WHERE id = '$id'");
		
		//移到的分类增加记录数
		$this->update_count($data['parent'], $orig_data['item_count']);
		
		//被移动的减少记录数
		$this->update_count($this->categories[$id]['parent'], -$orig_data['item_count']);
	}
	
	$ids = array($id => 1);
	
	//修改了静态化开关
	if(
		isset($data['htmlize']) && !empty($_POST['htmlize_apply_category'])
	){
		
		$htmlize = $data['htmlize'];
		$cids = $this->get_children_ids($id);
		
		//更新所有子分类的静态化设置
		if(!empty($cids)){
			$this->DB_master->update(
				$this->table,
				array('htmlize' => $htmlize),
				'id IN ('. implode(',', $cids) .')'
			);
			
			$ids = $ids + array_flip($cids);
		}
		
	}
	/*
	IP控制应用到子分类
	*/
	if(
		!empty($_POST['allow_ip_apply_category'])
	){
		
		$cids = $this->get_children_ids($id);
		if(!empty($cids)){
			$query = $this->DB_master->query("SELECT `id`,`config`,`htmlize` FROM $this->table where `id` IN (".implode(',', $cids).")");
			while($arr = $this->DB_master->fetch_array($query)){
				$org_config = mb_unserialize($arr['config']);
				unset($org_config['allow_ip']);
				$new_config = mb_unserialize(stripslashes($data['config']));
				$org_config['allow_ip'] = $new_config['allow_ip'];
				$this->DB_master->update(
					$this->table,
					array(
						'htmlize' => $new_config['allow_ip']['enabled'] ? 0 : $arr['htmlize'],
						'config' => $this->DB_master->escape_string(serialize($org_config))),
					"id = ".$arr['id']
				);
			}
		}		
	}
    if(
    !empty($_POST['allow_auditflow_apply_category'])
    ){

        $cids = $this->get_children_ids($id);
        if(!empty($cids)){
            $query = $this->DB_master->query("SELECT `id`,`config`,`htmlize` FROM $this->table where `id` IN (".implode(',', $cids).")");
            while($arr = $this->DB_master->fetch_array($query)){
                $org_config = mb_unserialize($arr['config']);
                unset($org_config['auditflow']);
                $new_config = mb_unserialize(stripslashes($data['config']));
                $org_config['auditflow'] = $new_config['auditflow'];
                $this->DB_master->update(
                    $this->table,
                    array(
                        'config' => $this->DB_master->escape_string(serialize($org_config))),
                    "id = ".$arr['id']
                );
            }
        }
    }
	//修改了HTML路径
	if(isset($data['path']) && $orig_data['path'] != $data['path']){
		$cids = $this->get_children_ids($id);
		
		//通知所有子分类更新路径
		foreach($cids as $v){
			$d = $this->DB_master->fetch_one("SELECT path FROM $this->table WHERE id = '$v'");
			
			$this->DB_master->update(
				$this->table,
				array('path' => preg_replace('|^'. $orig_data['path'] .'/|', $data['path'] .'/', $d['path'])),
				"id = '$v'"
			);
		}
		
		$ids = $ids + array_flip($cids);
		
		//改名
		@rename($this->system->path . $orig_data['path'], $this->system->path . $data['path']);
	}
	
    //URL规则,栏目访问密码
    if(
        ($cids = $this->get_children_ids($id)) &&
        (!empty($_POST['list_rule_apply_category']) || !empty($_POST['view_rule_apply_category']) || !empty($_POST['password_rule_apply_category']))
    ){
        $rule = array();

        if(!empty($_POST['list_rule_apply_category'])){
            $rule['html_list_url_rule'] = $data['html_list_url_rule'];
            $rule['html_list_url_rule_mobile'] = $data['html_list_url_rule_mobile'];
        }
        if(!empty($_POST['view_rule_apply_category'])){
            $rule['html_view_url_rule'] = $data['html_view_url_rule'];
            $rule['html_view_url_rule_mobile'] = $data['html_view_url_rule_mobile'];
        }
        if(!empty($_POST['password_rule_apply_category'])){
            $rule['need_password'] = $data['need_password'];
            $rule['category_password'] = $data['category_password'];
        }

        $this->DB_master->update(
            $this->table,
            $rule,
            'id IN ('. implode(',', $cids) .')'
        );

        $ids = $ids + array_flip($cids);
    }
	
	$this->cache(false, true, $ids);
	
	return $status;
