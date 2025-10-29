<?php
defined('PHP168_PATH') or die();

//P8_CMS_Category::cache($cache_all = true, $list_cache = true, $ids = array())
	@set_time_limit(0);
	global $STATIC_URL;
	$list = $this->DB_master->query("SELECT * FROM $this->table WHERE site='$site' ORDER BY display_order DESC");
	
	$this->categories = $this->top_categories = array();
	$_top_categories = $_categories = array();
	
	$item = $this->system->load_module('item');
	$item->controller = $this->system->controller.'/'. $item->name;
	//生成列表缓存不需要的数据
	$list_unsets = array('item_count', 'page_size', 'html_list_url_rule', 'list_template', 'view_template', 'item_template', 'list_template_mobile', 'view_template_mobile', 'item_template_mobile',  'seo_keywords', 'seo_description', 'config', 'parents', 'CONFIG');
	
	while($arr = $this->DB_master->fetch_array($list)){
		$model = $this->system->get_model($arr['model']);
		if(!empty($model['filterable_fields'])){
			//有自定义过滤字段的不可以静态,但可以访问动态,即使关闭了动态
			$arr['htmlize'] = 0;
			$arr['allow_dynamic'] = 1;
		}
		$arr['frame'] && $arr['frame'] = attachment_url($arr['frame']);
		
		$this->categories[$arr['id']] = $arr;
		$this->categories[$arr['id']]['CONFIG'] = mb_unserialize($arr['config']);
		unset($this->categories[$arr['id']]['config']);
		
		if($list_cache){
			$_categories[$arr['id']] = array(
				'id' => (int)$arr['id'],
				'parent' => (int)$arr['parent'],
				'type' => $arr['type'],
				'name' => $arr['name'],
				'model' => $arr['model'],
				'htmlize' => $arr['htmlize'],
				'url' => $arr['url'],
			);
		}
	}
	
	$path = array();
	
	foreach($this->categories as $v){
		$this->categories[$v['id']]['parents'] = array();
		$this->categories[$v['id']]['id'] = (int)$this->categories[$v['id']]['id'];
		$this->categories[$v['id']]['parent'] = (int)$this->categories[$v['id']]['parent'];
		$this->categories[$v['id']]['allow_ip_enabled'] = (int)$this->categories[$v['id']]['CONFIG']['allow_ip']['enabled'];
		$this->categories[$v['id']]['post_year'] = isset($this->categories[$v['id']]['CONFIG']['post_year']) && !empty($this->categories[$v['id']]['CONFIG']['post_year']) ? intval($this->categories[$v['id']]['CONFIG']['post_year']) : 0;
		$this->categories[$v['id']]['post_quarter'] = isset($this->categories[$v['id']]['CONFIG']['post_quarter']) && !empty($this->categories[$v['id']]['CONFIG']['post_quarter']) ? intval($this->categories[$v['id']]['CONFIG']['post_quarter']) : 0;
		$this->categories[$v['id']]['post_month'] = isset($this->categories[$v['id']]['CONFIG']['post_month']) && !empty($this->categories[$v['id']]['CONFIG']['post_month']) ? intval($this->categories[$v['id']]['CONFIG']['post_month']) : 0;
		$this->categories[$v['id']]['post_week'] = isset($this->categories[$v['id']]['CONFIG']['post_week']) && !empty($this->categories[$v['id']]['CONFIG']['post_week']) ? intval($this->categories[$v['id']]['CONFIG']['post_week']) : 0;
		$this->categories[$v['id']]['post_size'] = isset($this->categories[$v['id']]['CONFIG']['post_size']) && !empty($this->categories[$v['id']]['CONFIG']['post_size']) ? intval($this->categories[$v['id']]['CONFIG']['post_size']) : 0;
		$this->categories[$v['id']]['manager'] = isset($this->categories[$v['id']]['CONFIG']['manager']) && !empty($this->categories[$v['id']]['CONFIG']['manager']) ? $this->categories[$v['id']]['CONFIG']['manager'] : array();
		$this->categories[$v['id']]['direct_to_category_id'] = isset($this->categories[$v['id']]['CONFIG']['direct_to_category_id']) && !empty($this->categories[$v['id']]['CONFIG']['direct_to_category_id']) ? $this->categories[$v['id']]['CONFIG']['direct_to_category_id']: 0;
		$this->categories[$v['id']]['htmlize'] = (int)$this->categories[$v['id']]['htmlize'];
		$this->categories[$v['id']]['authority'] = isset($this->categories[$v['id']]['CONFIG']['authority']) ? $this->categories[$v['id']]['CONFIG']['authority'] : array();
		$this->categories[$v['id']]['authority_viewer'] = isset($this->categories[$v['id']]['CONFIG']['authority_viewer']) ? $this->categories[$v['id']]['CONFIG']['authority_viewer'] : array();
		if($v['parent']){
			
			if(empty($this->categories[$v['parent']])){
				//父分类丢失,转成一级分类
				$this->categories[$v['id']]['parent'] = 0;
				//$this->categories[$v['id']]['path'] = basename($this->categories[$v['id']]['path']);
				$this->DB_master->update($this->table, array('parent' => 0), "id = $v[id]");
				
				$path[$v['id']] = array($v['id']);
				$this->top_categories[$v['id']] = &$this->categories[$v['id']];
				
				$_top_categories[$v['id']] = &$_categories[$v['id']];
			}else{
				
				$this->categories[$v['parent']]['categories'][$v['id']] = &$this->categories[$v['id']];
				
				$_categories[$v['parent']]['categories'][$v['id']] = &$_categories[$v['id']];
			}
			
		}else{
			$path[$v['id']] = array($v['id']);
			$this->top_categories[$v['id']] = &$this->categories[$v['id']];
			
			$_top_categories[$v['id']] = &$_categories[$v['id']];
		}
		
		
		
		
		
		//父分类路径
		$parents = $this->get_parents($v['id']);
		$tmp = $domains = array();
		$domain_flag = empty($v['domain']);
		$paths = '';
		
		foreach($parents as $p){
			$tmp[] = $p['id'];
			$this->categories[$v['id']]['parents'][] = $p['id'];
			
			if($domain_flag && !empty($this->categories[$p['id']]['domain'])){
				$domains[$p['id']] = $this->categories[$p['id']]['domain'];
			}else if(!empty($this->categories[$p['id']]['path'])){
				$paths .= basename($this->categories[$p['id']]['path']) .'/';
			}
		}
		$tmp[] = $v['id'];
		$path[$v['id']] = $tmp;
		
		if(!empty($v['htmlize']) && $v['htmlize'] != 2){
			$paths .= basename($v['path']);
			$this->categories[$v['id']]['path'] = $paths;
		}
		
		//以最近一个分类绑定的域名为主,子类继承父类的域名
		if($domains){
			end($domains);
			$id = key($domains);
			$this->categories[$v['id']]['domain'] = current($domains) .'/'. $paths;
		}
		if(empty($this->categories[$v['id']]['url'])){
			//根据分类情况取得绝对地址URL
			$this->categories[$v['id']]['is_category'] = true;
			if($this->categories[$v['id']]['CONFIG']['allow_ip']['enabled']) $this->categories[$v['id']]['htmlize'] = 0;
			$this->categories[$v['id']]['url'] = $this->system->site_p8_url($item, $this->categories[$v['id']], 'list',true);			
			//if(strpos($this->categories[$v['id']]['url'])){
			//	$this->categories[$v['id']]['url'] = $this->system->siteurl.'/item-list-category-'.$v['id'];
			//}
			$this->categories[$v['id']]['url'] = $this->categories[$v['id']]['CONFIG']['allow_ip']['enabled'] ? $this->system->siteurl.'/item-list-category-'.$v['id'] : $this->categories[$v['id']]['url'];				
			if(!$this->categories[$v['id']]['htmlize'] && (strpos($this->categories[$v['id']]['url'],'https://') === false && strpos($this->categories[$v['id']]['url'],'http://') === false)){
				$this->categories[$v['id']]['url'] = $STATIC_URL.$this->categories[$v['id']]['url'];
			}
			if(!empty($this->categories[$v['id']]['CONFIG']['authority_viewer']) || (!empty($this->categories[$v['id']]['CONFIG']['authority']) && !in_array('0',$this->categories[$v['id']]['CONFIG']['authority']))){
				$this->categories[$v['id']]['url'] = $this->system->siteurl.'/item-list-category-'.$v['id'];
			}
			if($this->categories[$v['id']]['htmlize'] != 1){
				$this->categories[$v['id']]['url'] = $STATIC_URL.'/s.php/'.$site.'/item-list-category-'.$v['id'];
			}
			unset($this->categories[$v['id']]['is_category']);
		}
		
		if($this->categories[$v['id']]['type']==3)
				$this->categories[$v['id']]['target'] = isset($this->categories[$v['id']]['CONFIG']['target'])?$this->categories[$v['id']]['CONFIG']['target']:'_blank';
		
		//各个分类缓存
		if($cache_all || isset($ids[$v['id']])){
			$tmp = $this->categories[$v['id']]; unset($tmp['categories']);
			$tmp['path'] = $v['path'];
			$this->core->CACHE->write($this->system->name .'/modules/'.$this->name.'/',$site, (int)$v['id'], $tmp, 'serialize');
		}
		
		if($list_cache){
			foreach($list_unsets as $k){
				unset($this->categories[$v['id']][$k]);
			}
			
			if(empty($this->categories[$v['id']]['htmlize'])){
				unset(
					$this->categories[$v['id']]['list_htmlize'],
					$this->categories[$v['id']]['view_htmlize'],
					$this->categories[$v['id']]['path'],
					$this->categories[$v['id']]['domain']
				);
			}
			
			if(!empty($this->categories[$v['id']]['domain'])){
				unset($this->categories[$v['id']]['path']);
			}else{
				unset($this->categories[$v['id']]['domain']);
			}
		}
	}
	/*存在转向的情况下*/
	foreach($this->categories as $v){
		if(!empty($this->categories[$v['id']]['direct_to_category_id'])){				
			$direct_to_category_id = intval($this->categories[$v['id']]['direct_to_category_id']);
			$this->categories[$v['id']]['url'] = $this->categories[$direct_to_category_id]['url'];			
		}
		$this->categories[$v['id']]['models'] = $this->get_children_models($v['id']);
	}
	$this->data = array(
		'categories' => &$this->categories,
		'top_categories' => &$this->top_categories,
	);
	//var_dump($this->categories[8824]['url']);
	if($list_cache){
		$this->core->CACHE->write($this->system->name .'/modules/'.$this->name.'/', $site,'categories', $this->data, 'serialize');
		
		$json = array('json' => p8_json($this->make_json_sort($_top_categories)));
		$json['path'] = p8_json($path);
		$this->core->CACHE->write($this->system->name .'/modules/'.$this->name.'/', $site,'json', $json);
		
		unset($json, $_top_categories, $path);
	}
	//修复栏目内容数
	/*
	if($site){
		$this->DB_master->update($this->table, array('item_count' => 0), "site='{$site}'");
		$item_config = $this->core->get_config($this->system->name,'item');		
		$lan_date_enable = isset($item_config['lan_date_enable']) && $item_config['lan_date_enable'] ? true : false;
		$lan_date_timestamp = isset($item_config['lan_date']) && $item_config['lan_date'] ? intval($item_config['lan_date']) : 0;		
		$item_table = $this->system->item_table;
		//局域网限制
		if($lan_date_enable && $lan_date_timestamp){
			//限制部分
			$lan_category = isset($this->system->site['config']['lan_category']) && $this->system->site['config']['lan_category'] ? explode(',',$this->system->site['config']['lan_category']) : array();
			$lan_category = array_filter($lan_category);
			$s = $comma = '';
			foreach($lan_category as $v){
				if($v){
					$s .= $comma ."'$v'";
					$comma = ',';
				}
			}
			$where = $s ? '`timestamp` >= '.$lan_date_timestamp.' and `cid` NOT IN ('. $s .')' : '`timestamp` >= '.$lan_date_timestamp;
			
			$query = $this->DB_master->query("SELECT cid, COUNT(*) AS `count` FROM $item_table where site='{$site}' and $where GROUP BY cid");
			while($arr = $this->DB_master->fetch_array($query)){
				$this->update_count($arr['cid'], $arr['count']);
			}
			
			//不限制部分
			if(!empty($s)){
				$query = $this->DB_master->query("SELECT cid, COUNT(*) AS `count` FROM $item_table WHERE site='{$site}' and `cid` IN ($s) GROUP BY cid");
				while($arr = $this->DB_master->fetch_array($query)){
					$this->update_count($arr['cid'], $arr['count']);
				}
			}
		}else{
			$query = $this->DB_master->query("SELECT cid, COUNT(*) AS `count` FROM $item_table WHERE site='{$site}' GROUP BY cid");
			while($arr = $this->DB_master->fetch_array($query)){
				$this->update_count($arr['cid'], $arr['count']);
			}
		}
	}
	*/