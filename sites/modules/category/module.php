<?php
defined('PHP168_PATH') or die();

/**
* 分类类型
* 1 只有一个页面的分类,通常用于做频道页,不能添加内容
* 2 列表分类,可以添加内容,可以包含子分类的内容
**/

class P8_Sites_Category extends P8_Module{

var $table;
var $table_recycle;
var $item_table;
var $categories;		//总分类,外部可以直接传入id $obj->categories[$id] 直接得到相应的分类,无须关心分类属于哪个父分类,并可以直接获得其子分类节点
var $top_categories;	//顶级分类,仅包含顶级分类,并且有其所有子分类的树形结构数组
var $categories_recycle;
var $top_categories_recycle;
var $data;
var $_category;

function __construct(&$system, $name){
	$this->configurable = false;	//无配置
	$this->system = &$system;
	parent::__construct($name);
	
	$this->table = $this->system->TABLE_ .'category';
	$this->table_recycle = $this->system->TABLE_ .'category_recycle';
	$this->item_table = $this->system->TABLE_ .'item';
	$this->_category = array();
}


/**
* 添加一个分类
* @param string $name 分类名称
* @param int $parent 父分类ID
* @param int $display_order 排序
**/
function add(&$data,$cache = true){
	if($cache) $this->get_cache();
	
	
	if($data['type'] != 3){
		$ext = empty($this->core->CONFIG['ssi']) ? 'html' : 'shtml';
		
		empty($data['html_list_url_rule']) && $data['html_list_url_rule'] = '{$system_url}/{$id}/#list-{$page}.'. $ext .'#';
		empty($data['html_view_url_rule']) && $data['html_view_url_rule'] = '{$system_url}/{$Y}_{$m}/{$d}_{$H}/content-{$id}#-{$page}#.'. $ext;
		
		empty($data['list_template']) && $data['list_template'] = $data['model'] .'/list';
		empty($data['view_template']) && $data['view_template'] = $data['model'] .'/view';
		empty($data['item_template']) && $data['item_template'] = 'common/ico_title/dot_title';
		
		empty($data['list_template_mobile']) && $data['list_template_mobile'] = $data['model'] .'/list_mobile';
		empty($data['view_template_mobile']) && $data['view_template_mobile'] = $data['model'] .'/view_mobile';
		empty($data['item_template_mobile']) && $data['item_template_mobile'] = 'mobile/title';
	}
	$auto_label_postfix = $data['auto_label_postfix'];
	unset($data['auto_label_postfix']);
	if(
		$id = $this->DB_master->insert(
			$this->table,
			$data,
			array('return_id' => true)
		)
	){
		if(!$auto_label_postfix && !empty($data['label_postfix'])){
			$d['label_postfix'] = 'category_'. $id;
			
			$this->DB_master->update($this->table, $d, "id = '$id'");
		}
		if($data['type'] == 1 && empty($data['label_postfix'])){
			//大分类用自己的标签后缀
			$d['label_postfix'] = 'category_'. $id;
			
			//$this->DB_master->update($this->table, $d, "id = '$id'");
		}
		
		//if(!empty($data['path']))
			//md($this->system->path . $data['path']);
	}
	return $id;
}

/**
* 更新一个分类
* 参数同add
**/
function update($id, &$data, &$orig_data){
	return include $this->path .'call/update.call.php';
}

/**
* 合并栏目
* @param array $ids 待合并的栏目(数组)
* @param int $to_id 合并到的栏目
* @return bool
**/
function merge($ids, $to_id){
	return include $this->path .'call/merge.call.php';
}
/**
* 克隆栏目
* @param array $ids 待合并的栏目(数组)
* @param int $to_id 合并到的栏目
* @return bool
**/
function clonecat($id, $to_id){
	$this->get_cache();
	$id = intval($id);
	$_ids = $comma = '';
	$cates = $this->categories[$id];
	if(!$cates)return false;

	$this->exec_clone(array($id=>$cates),$to_id);
	$this->cache();
}

function exec_clone($cates,$to_id){

	foreach($cates as $cid=>$cd){
		
		$query = $this->DB_master->fetch_one("SELECT * FROM $this->table WHERE id=$cid");
		$files = array('name','url','type','site','matrix','list_all_model','domain','model','path','letter','htmlize','html_list_url_rule',
		'html_view_url_rule','list_template','view_template','item_template','list_template_mobile','view_template_mobile',
		'item_template_mobile','frame','display_order','page_size','seo_keywords','seo_description','label_postfix','auto_label_postfix','config');
		$data = array('id' => 0,'parent' => $to_id);
		
		foreach($files as $file){
			$data[$file] = $query[$file];
		}
	
		$id = $this->add($data);
		
		if($cd['categories']){
			$this->exec_clone($cd['categories'],$id);
		}
	
	}

}

/**
* 更新分类的条目数
* @param int $id 分类的ID
* @param int $num 条数
**/
function update_count_all($id, $num){

	$this->get_cache();
/*	
	if(
		empty($this->categories[$id]) || empty($num) ||
		!($cat = $this->system->fetch_category($id, true))
	) return false;	
*/	
	if(empty($num)) return false;
	$cat = $this->system->fetch_category($id, true);
	
	$cat['item_count'] += $num;
	$this->core->CACHE->write($this->system->name .'/modules/'.$this->name.'/', $this->system->SITE, (int)$id, $cat, 'serialize');
	
	$ids = $id;
	//如果有父分类同时更新父分类
	if($parents = $this->get_parents($id)){
		$ids = '';
		foreach($parents as $v){
			if($v['model'] != $cat['model']) continue;	//模型不相同
			
			$ids .= ',' . $v['id'];
			
			$cat = $this->system->fetch_category($v['id'], true);
			$cat['item_count'] += $num;
			$this->core->CACHE->write($this->system->name .'/modules/'.$this->name.'/', $this->system->SITE, (int)$v['id'], $cat, 'serialize');
		}
		$ids = $id . $ids;
	}
	return $this->DB_master->update(
		$this->table,
		array(
			'item_count' => 'item_count + '. $num
		),
		"id IN ($ids)",
		false
	);
}

/**
* 更新分类的条目数
* @param int $id 分类的ID
* @param int $num 条数
**/
function update_count($id, $num){

	$this->get_cache();
	
	if(
		empty($this->categories[$id]) || empty($num) ||
		!($cat = $this->system->fetch_category($id, true))
	) return false;
	
	$cat['item_count'] += $num;
	$this->core->CACHE->write($this->system->name .'/modules/'.$this->name.'/', $this->system->SITE, (int)$id, $cat, 'serialize');
	
	$ids = $id;
	//如果有父分类同时更新父分类
	if($parents = $this->get_parents($id)){
		$ids = '';
		foreach($parents as $v){
			if($v['model'] != $cat['model']) continue;	//模型不相同
			
			$ids .= ',' . $v['id'];
			
			$cat = $this->system->fetch_category($v['id'], true);
			$cat['item_count'] += $num;
			$this->core->CACHE->write($this->system->name .'/modules/'.$this->name.'/', $this->system->SITE, (int)$v['id'], $cat, 'serialize');
		}
		$ids = $id . $ids;
	}
	
	return $this->DB_master->update(
		$this->table,
		array(
			'item_count' => 'item_count + '. $num
		),
		"id IN ($ids)",
		false
	);
}

/**
* 删除分类
* @param array $data 删除的条件
* @return array 被删除的ID
**/
function delete($data){
	return include $this->path .'call/delete.call.php';
}

/**
* 回收站分类
* @param array $data 回收的条件
* @return array 被回收的ID
**/
function recycle($data){
	return include $this->path .'call/recycle.call.php';
}

/**
* 恢复回收站栏目
* @param array $data 回收的条件
* @return array 被回收的ID
**/
function restore($data){
	return include $this->path .'call/restore.call.php';
}
/*
* 设置静态化
* @param id 栏目ID
* @param htmlize html状态
*/
function htmlize($id,$htmlize,$verified){
	$ids = implode(',', $id);
	$table = $verified ? $this->table : $this->table_recycle;
	$ret = $this->DB_master->update(
		$table,
		array(
			'htmlize'=> intval($htmlize) == 20 ? 0 : intval($htmlize),
		),
		"id IN ($ids)",
		true
	);
	return $ret;
}
/**
* 取得一个分类的数据缓存
* 
**/
function &fetch_one($id, $refresh = false){
	
	if($refresh){
		$this->system->_category[$id] = $this->core->CACHE->read($this->system->name .'/modules/'.$this->name.'/', $this->system->SITE, (int)$id);
		
		return $this->system->_category[$id];
	}else{
		if(empty($this->system->_category[$id])){
			$this->system->_category[$id] = $this->core->CACHE->read($this->system->name .'/modules/'.$this->name.'/', $this->system->SITE, (int)$id);
		}
		
		return $this->system->_category[$id];
	}
}

/**
* 设置“启用仅限局域网访问”时强制栏目为动态
* 
**/

function set_allow_ip_two($site=''){
	if(empty($site)) return;
	$categories = $this->DB_master->fetch_all("SELECT * FROM $this->table WHERE `site` = '$site'");
	foreach($categories as $categorie){
		$config = mb_unserialize($categorie['config']);
		if($config['allow_ip']['enabled'] != 2) continue;
		$id = $categorie['id'];		
		$this->DB_master->update(
			$this->table,
			array('htmlize' => 0),
			"id=$id"
		);		
	}	
}

function get_cache($read_cache = true, $site=''){
	if(!empty($this->categories) && !$site) return;
	if(
		$read_cache &&
		$this->data = $this->core->CACHE->read(
			$this->system->name .'/modules/'.$this->name.'/',
			$site?$site:$this->system->SITE,
			'categories',
			'serialize'
		)
	){
		$this->categories = &$this->data['categories'];
		$this->top_categories = &$this->data['top_categories'];
		if(empty($this->categories) or empty($this->top_categories)){
			$this->cache(false, false,array(),$site);
		}
	}else{
		$this->cache(false, false,array(),$site);
	}
}

function get_cache_recycle($read_cache = true, $site=''){
	if(!empty($this->categories_recycle) && !$site) return;
	if(
		$read_cache &&
		$this->data = $this->core->CACHE->read(
			$this->system->name .'/modules/'.$this->name.'/',
			$site?$site:$this->system->SITE,
			'categories_recycle',
			'serialize'
		)
	){
		$this->categories_recycle = &$this->data['categories_recycle'];
		$this->top_categories_recycle = &$this->data['top_categories_recycle'];
		if(empty($this->categories_recycle) or empty($this->top_categories_recycle)){
			$this->cache(false, false,array(),$site);
		}
	}else{
		$this->cache_recycle(false, false,array(),$site);
	}
}

/**
* 取得缓存的JSON
**/
function get_json(){
	$json = $this->core->CACHE->read($this->system->name .'/modules/'.$this->name.'/', $this->system->SITE, 'json');
	/*读不到时，尝试先缓存*/
	if(empty($json) || empty($json['json']) || $json['json'] == '[]') {
		$this->cache();
		$json = $this->core->CACHE->read($this->system->name .'/modules/'.$this->name.'/', $this->system->SITE, 'json');
	}
	return array(
		'json' => empty($json['json']) ? '{}' : $json['json'],
		'path' => empty($json['path']) ? '{}' : $json['path'],
	);
}

function make_json_sort($data){
	$return = array();
	if(!$data || !is_array($data))return $data;
	foreach($data as $k=>$v){
		if(!empty($v['categories'])){
			$v['categories']=$this->make_json_sort($v['categories']);
		}
		$return[]=$v;
	}

	return $return;

}

function make_categories_sort($data){
	$return = array();
	if(!is_array($data))return $return;
	foreach($data as $k=>$v){
		if(!empty($v['categories'])){
			$returns = $this->make_categories_sort($v['categories']);
			foreach($returns as $k_tmp=>$v_tmp){$return[$k_tmp] = $k_tmp;}
		}
		$return[$k] = $k;		
	}
	return $return;
}

function get_views_sum(){
	$site = $this->system->SITE;
	$list = $this->DB_master->fetch_all("SELECT cid,sum(views) as counts FROM $this->item_table where `site`='$site' group by cid");
	$return = array();
	foreach($list as $k=>$v){
		$return[$v['cid']] = $v['counts'];
	}
	return $return;
}
/**
* 生成缓存
* @param string $model 指定模型,如果不指定则是生成所有模型的分类
* @param bool $cache_all 缓存所有站点
* @param bool $list_cache 是否写缓存,如果否,则不写缓存,保持树形结构,用于实时刷新
* @param array $ids 只缓存的分类的ID哈希 array(id1 => 1, id2 => 1 ...)
**/
function cache($cache_all = true, $list_cache = true, $ids = array(),$site = ''){
	parent::cache();
	$_site = $site ? $site : $this->system->SITE;	
	if(!$cache_all)
		$this->exec_cache($_site,true, $list_cache, $ids);
	else{
        $this->system->get_sites();
		foreach($this->system->sites as $site=>$sdata){
			$this->system->init_site($site,false);
			$this->exec_cache($site,$cache_all, $list_cache, $ids);
		}
	}
	$this->system->init_site($_site);
}

function cache_recycle($cache_all = true, $list_cache = true, $ids = array(),$site = ''){
	parent::cache();
	$_site = $site ? $site : $this->system->SITE;	
	if(!$cache_all)
		$this->exec_cache_recycle($_site,true, $list_cache, $ids);
	else{
        $this->system->get_sites();
		foreach($this->system->sites as $site=>$sdata){
			$this->system->init_site($site,false);
			$this->exec_cache_recycle($site,$cache_all, $list_cache, $ids);
		}
	}
	$this->system->init_site($_site);
}
/**
* 生成缓存
* @param string $model 指定模型,如果不指定则是生成所有模型的分类
* @param bool $cache_all 缓存所有分类
* @param bool $list_cache 是否写缓存,如果否,则不写缓存,保持树形结构,用于实时刷新
* @param array $ids 只缓存的分类的ID哈希 array(id1 => 1, id2 => 1 ...)
**/
function exec_cache($site,$cache_all = true, $list_cache = true, $ids = array()){

	return include $this->path .'call/cache.call.php';
}
function exec_cache_recycle($site,$cache_all = true, $list_cache = true, $ids = array()){

	return include $this->path .'call/cache_recycle.call.php';
}
/**
* 取得分类的所有父分类的数据
* @param int $id 分类ID
**/
function get_parents($id){
	if(!isset($this->categories[$id])) return array();
	
	$p = $this->categories[$id]['parent'];
	$ps = array();
	while($p){
		array_unshift($ps, $this->categories[$p]);
		unset($ps[0]['categories']);
		$p = $this->categories[$p]['parent'];
	}
	return $ps;
}

function get_parents_recycle($id){
	if(!isset($this->categories_recycle[$id])) return array();
	
	$p = $this->categories_recycle[$id]['parent'];
	$ps = array();
	while($p){
		array_unshift($ps, $this->categories_recycle[$p]);
		unset($ps[0]['categories']);
		$p = $this->categories_recycle[$p]['parent'];
	}
	return $ps;
}

/**
* 取得分类的所有子分类的模型
* @param int $id 分类ID
**/
function get_children_models($id){
	if(empty($this->categories[$id]['categories'])){
		return array($this->categories[$id]['model']);
	}
	$models = array(
		$id => $this->categories[$id]['model']
	);
	foreach($this->categories[$id]['categories'] as $v){
		$models[$v['id']] = $v['model'];
		if(isset($v['categories']))
			$models = $models + $this->get_children_models($v['id']);
	}
	$model_ret = array_unique($models);
	return array_values($model_ret);
}

/**
* 取得分类的所有子分类的ID
* @param int $id 分类ID
**/
function get_children_ids($id){
	if(empty($this->categories[$id]['categories'])) return array();
	
	$ids = array();
	foreach($this->categories[$id]['categories'] as $v){
		$ids[$v['id']] = $v['id'];
		if(isset($v['categories']))
			$ids = $ids + $this->get_children_ids($v['id']);
	}
	
	return $ids;
}

function get_children_ids_recycle($id){
	if(empty($this->categories_recycle[$id]['categories'])) return array();
	
	$ids = array();
	foreach($this->categories_recycle[$id]['categories'] as $v){
		$ids[$v['id']] = $v['id'];
		if(isset($v['categories']))
			$ids = $ids + $this->get_children_ids_recycle($v['id']);
	}
	
	return $ids;
}
/**
*取得分类的所有同级分类
*@param int $id 分类ID
**/
function get_siblings($id){
	$p = $this->categories[$id]['parent'];
	$siblings = array();
	if(!$p)
		$siblings = $this->top_categories;
	elseif(isset($this->categories[$p]['categories']))
		$siblings = $this->categories[$p]['categories'];
	return $siblings;
}

function category_formate($json, $l = 0, $p = 0){
	$j = 0;
	$k = count($json);
	$list = array();
	foreach($json as $item){		
		$j++;
		$c = '';
		if($l != 0){
			$c .= str_repeat('|  ', $l - $p).str_repeat('   ', $p).'|';
			if($j == $k){
				$p++;
				$c .= '└';
			}else{
				$c .= '├';
			}			
		}
		$list[] = array(
			'id'=> $item['id'],
			'name' => $c.$item['name'],
			'model' => $item['model'],
			'type'=> $item['type'],
			'sitename' => $item['site'],
			'site' => $item['site'],					
			'htmlize' => $item['htmlize'],
			'category_count' => 0,
			'item_count' => $item['item_count'],
			'views' => 0,
			'display_order' => $item['display_order'],
		);
		if($item['categories']){
			$lists = $this->category_formate($item['categories'], $l +1, $p);
			foreach($lists as $items){
				$list[] = $items;
			}			
		}		
	}
	return $list;
}

function label($LABEL, &$label, &$var){
	$this->get_cache();
	
	global $SKIN, $TEMPLATE, $RESOURCE;
	$this_system = &$this->system;
	$this_module = &$this;
	$SYSTEM = $this->system->name;
	$MODULE = $this->name;
	$core = &$this->core;
	
	$option = &$label['option'];
	$category = &$this->system->load_module('category');
	$category->get_cache();
	//分类
	if(!empty($option['category'])){
		//如果有属性,使用属性的字段来作为条件		
		$cats = $option['category'];
		if(!empty($option['include_sub_category'])){
			foreach($option['category'] as $v){
				$cats = array_merge($category->get_children_ids($v));
			}
		}		
	}
	//var_dump($cats);
	$item = $this_system->load_module('item');
	foreach($cats as $key => $catid){
		$CAT = $this_system->fetch_category($catid);
		$list[$key] = $CAT;		
		$CAT['#category'] = &$CAT;
		if($list[$key]['type'] == 3){
			continue;
		}
		$list[$key]['url'] = empty($CAT) ? '' : ($CAT['url'] ?: $this_system->site_p8_url($item, $CAT, 'list'));
		if(!empty($CAT['htmlize']) && $CAT['htmlize'] != 2 && strpos($list[$key]['url'],'.php')){
			$CAT['is_category'] = true;
			$CAT['htmlize'] = 1;
			$list[$key]['url'] = $this_system->site_p8_url($item, $CAT, 'list');
			unset($CAT['is_category']);
		}
	}
	/*转向的情况下*/
	foreach($cats as $key => $catid){	
		$CAT_D = $this_system->fetch_category($catid);		
		$CONFIG = $CAT_D['CONFIG'];		
		$direct_to_category_id = isset($CONFIG['direct_to_category_id']) && !empty($CONFIG['direct_to_category_id']) ? $CONFIG['direct_to_category_id']: 0;		
		if($direct_to_category_id){
			$CATS = $this_system->fetch_category($direct_to_category_id);
			//$list[$key] = $CATS;		
			$CATS['#category'] = &$CATS;
			if($list[$key]['type'] == 3){
				continue;
			}
			$list[$key]['url'] = empty($CATS) ? '' : ($CATS['url'] ?: $this_system->site_p8_url($item, $CATS, 'list'));
			if(!empty($CATS['htmlize']) && $CATS['htmlize'] != 2 && strpos($list[$key]['url'],'.php')){
				$CATS['is_category'] = true;
				$CATS['htmlize'] = 1;
				$list[$key]['url'] = $this_system->site_p8_url($item, $CATS, 'list');
				unset($CATS['is_category']);
			}
		}
	}
	
	$this->categories[$v['id']]['direct_to_category_id'] = isset($this->categories[$v['id']]['CONFIG']['direct_to_category_id']) && !empty($this->categories[$v['id']]['CONFIG']['direct_to_category_id']) ? $this->categories[$v['id']]['CONFIG']['direct_to_category_id']: 0;
		
		
	if(!empty($label['option']['tplcode']) && strlen($label['option']['tplcode']) > 10){
		//即时编译的模板
		$tplcode = $LABEL->compile_template($label['option']['tplcode']);
		ob_start();
		eval($tplcode);
		$content = ob_get_clean();
		
	}else{
		//变量中指定了模板
		$template = empty($var['#template#']) ? $label['option']['template'] : $var['#template#'];
		
		//用数据包含模板取得标签内容
		ob_start();
		include $LABEL->template($template);
		$content = ob_get_clean();
	}
	
	return array($content);
}	
}
