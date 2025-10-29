<?php
/**
* 头部导航菜单类
**/

class P8_Navigation_Menu{

var $_data;			//存储数据的引用
var $menus;			//可供查找的数据
var $top_menus;		//顶级数据
var $core_menus;	//核心菜单
var $system_menus;	//系统的菜单
var $system_menu;	//指定某系统的菜单
var $table;			//表

function __construct(){
	global $core;
	$this->table = $core->TABLE_ .'navigation_menu';
}

function get($params){
	global $core;
	
	$params = array(
		'system' => $params['system'],
		'module' => isset($params['system']) ? $params['module'] : '',
		'parent' => isset($params['parent']) ? $params['parent'] : null,
		'return' => isset($params['return']) && $params['return'] == 'all' ? 'all' : 'one'
	);
	
	$sql = "SELECT * FROM $this->table WHERE system = '$params[system]' AND module = '$params[module]'". ($params['parent'] === null ? '' : " AND parent = '$params[parent]'");
	
	return $params['return'] == 'all' ? $core->DB_master->fetch_all($sql) : $core->DB_master->fetch_one($sql);
}

function add($data){
	global $core;
	
	$name = $data['name'];
	$parent = empty($data['parent']) ? 0 : $data['parent'];
	$system = empty($data['system']) ? 'core' : $data['system'];
	$module = empty($data['module']) ? '' : $data['module'];
	$display = empty($data['display']) ? 1 : $data['display'];
	$display_order = empty($data['display_order']) ? 0 : $data['display_order'];
	$url = empty($data['url']) ? '' : $data['url'];
	$target = empty($data['target']) ? '' : $data['target'];
	$frame = isset($data['frame']) ? attachment_url($data['frame'], true) : '';
	$summary = isset($data['summary']) ? str_replace(array("\r", "\n", "\t","\r\n"),array("<br>", "", "","<br>"),html_entities($data['summary'])) : '';
	$color = empty($data['color']) ? '' : $data['color'];

	
	if(
		$id = $core->DB_master->insert(
			$this->table,
			array(
				'name' => $name,
				'parent' => $parent,
				'system' => $system,
				'module' => $module,
				'display' => $display,
				'display_order' => $display_order,
				'url' => $url,
				'target' => $target,
				'summary' => $summary,
				'frame' => $frame,
				'dynamic_url' => $url,
				'color' => $color
			),
			array('return_id' => true)
		)
	){
		//$this->cache();
	}
	
	return $id;
}

function view($id){
	global $core;
	return $core->DB_master->fetch_one("SELECT * FROM $this->table WHERE id = '$id'");
}

function update($id, $data){
	global $core;
	
	$name = html_entities($data['name']);
	//有URL的情况数据可以任意,以URL为准
	$url = isset($data['url']) ? $data['url'] : '';
	
	$target = isset($data['target']) ? $data['target'] : '';
	$parent = isset($data['parent']) ? intval($data['parent']) : 0;
	$system = isset($data['system']) ? $data['system'] : 'core';
	$color = isset($data['color']) ? $data['color'] : '';
	$display = !isset($data['display']) ? 1 : $data['display'];
	$display_order = isset($data['display_order']) ? intval($data['display_order']) : 0;
	$frame = isset($data['frame']) ? attachment_url($data['frame'], true) : '';
	$summary = isset($data['summary']) ? str_replace(array("\r", "\n", "\t","\r\n"),array("<br>", "", "","<br>"),html_entities($data['summary'])) : '';
	//$summary = isset($data['summary']) ? str_replace('\r\n','<br>',htmlspecialchars($data['summary'],ENT_QUOTES)) : '';
	
	$cids = $this->get_children_ids($id);
	array_push($cids, $id);
	//不能把父分类移动到子分类或者本身下面
	if(in_array($parent, $cids)) return false;
	if(
		$status = $core->DB_master->update(
			$this->table,
			array(
				'name' => $name,
				'parent' => $parent,
				'system' => $system,
				'color' => $color,
				'url' => $url,
				'target' => $target,
				'summary' => $summary,
				'frame' => $frame,
				'dynamic_url' => $url,
				'display' => $display,
				'display_order' => $display_order
			),
			"id = '$id'"
		)
	){
		//$this->cache();
	}
	
	return $status;
}

/**
* 删除菜单,把ID传入即可,注意,如果菜单有子菜单将全部删除
* @param int $id 菜单的ID
* @return 
**/
function delete($id){
	global $core;
	
	$cids = $this->get_children_ids($id);
	array_unshift($cids, $id);
	
	$ids = implode(',', $cids);
	
	return $core->DB_master->delete($this->table, "id IN ($ids)") ? $cids : array();
}
/**
* 菜单动静态转换
**/
function change_url($changeto = 'html'){
	global $core;	
	if($changeto == 'html'){
		$query = $core->DB_master->query("SELECT * FROM $this->table ORDER BY display_order DESC");
		while($arr = $core->DB_master->fetch_array($query)){
			$action = $url = '';
			$data = $CAT = array();
			$ids = 0;
			$id = $arr['id'];
			if($arr['dynamic_url']=='index.php'){
				$url = $core->url;
				$core->DB_master->update($this->table,array('url'=>$url),"`id`=$id");				
				continue;
			}
			if(strpos($arr['dynamic_url'],'.php')){
				if(in_array('cms',explode('/',$arr['dynamic_url']))){
					$tmpexp = explode('-',$arr['dynamic_url']);
					$ids = explode('.',end($tmpexp));
					if(in_array('list',$tmpexp)){						
						$action = 'list';
					}elseif(in_array('view',$tmpexp)){
						$action = 'view';
					}					
				}			
				if($action && $ids){
					$loadsystem = $core->load_system('cms');
					if($action=='list'){					
						$CAT = $loadsystem->fetch_category($ids[0]);
						$item_module = $loadsystem->load_module('item');
						/*如果内容不存在，尝试使用默认静态规则静态化*/
						if(empty($CAT)){												
							$CAT = array(
								'id' => $ids[0],
								'html_list_url_rule' => '{$core_url}/html/{$id}/#list-{$page}.html#',						
							);
						}
						$CAT['is_category'] = true;
						$CAT['htmlize'] = 1;
						$url = p8_url($item_module, $CAT, 'list');
						if(!empty($core->CONFIG['MenuMode']) && $core->url) $url = str_replace($core->url.'/','',$url);
						if(!empty($core->CONFIG['MenuModeHtml']) && $core->CONFIG['static_url']){
							if(!empty($core->CONFIG['MenuMode']))
								$url = $core->CONFIG['static_url'].'/'.$url;
							else
								$url = str_replace($core->url,$core->CONFIG['static_url'],$url);
						}
						$core->DB_master->update($this->table,array('url'=>$url),"`id`=$id");												
					}elseif($action=='view'){
						$item_module = $loadsystem->load_module('item');
						$data = $item_module->data('read', $ids[0]);											
						$CAT = array();
						/*如果内容不存在，尝试使用默认静态规则静态化*/
						if(empty($data)){
							$data['id'] = $ids[0];
							$data['timestamp'] = P8_TIME;
							$CAT['html_view_url_rule'] = '{$core_url}/html/0/{$Y}-{$m}-{$d}/content-{$id}#-{$page}#.html';
						}else{
							$CAT = $loadsystem->fetch_category($data['cid']);
						}					
						$CAT['htmlize'] = 2;
						$data['#category'] = $CAT;						
						$url = p8_url($item_module, $data, 'view');						
						if(!empty($core->CONFIG['MenuMode']) && $core->url) $url = str_replace($core->url.'/','',$url);
						if(!empty($core->CONFIG['MenuModeHtml']) && $core->CONFIG['static_url']){
							if(!empty($core->CONFIG['MenuMode']))
								$url = $core->CONFIG['static_url'].'/'.$url;
							else
								$url = str_replace($core->url,$core->CONFIG['static_url'],$url);
						}
						$core->DB_master->update($this->table,array('url'=>$url),"`id`=$id");
						
					}
				}
			}else{
				$data['url'] = $arr['dynamic_url'];
				$data['is_category'] = false;
				$loadsystem = $core->load_system('cms');
				$item_module = $loadsystem->load_module('item');
				$url = p8_url($item_module,$data);
				if(!strpos($url,'.php')){
					if(!empty($core->CONFIG['MenuMode']) && $core->url) $url = str_replace($core->url,'',$url);
					$core->DB_master->update($this->table,array('url'=>$url),"`id`=$id");
				}			
			}
		}
	}else{
		$core->DB_master->update($this->table,array('url'=>'dynamic_url'),'',false);
	}
	$this->cache();
}

/**
* 生成菜单缓存
* @param bool $write 是否写缓存,如果是false,保持写缓存的格式,但是不写到缓存,一般用于实时刷新的列表
**/
function cache($write = true){
	global $core, $CACHE;
	
	$this->menus = $this->system_menus = $this->core_menus = array();
	$query = $core->DB_master->query("SELECT * FROM $this->table ORDER BY display_order DESC");
	$_menus = array();
	
	while($arr = $core->DB_master->fetch_array($query)){
		$url = '/'. $arr['system'];
		$url = empty($info['bind_domain']) ? $core->U_controller .'/'. $arr['system'] : $info['bind_domain'];
		if($arr['module']){
			$url = $url .'/'. $arr['module'];
		}
				
		if($write){
			if(!$arr['display']) continue;			
			$_menus[$arr['id']] = $this->menus[$arr['id']] = array(
				'id' => $arr['id'],
				'system' => $arr['system'],
				'parent' => $arr['parent'],
				'name' => $arr['name'],
				'url' => $arr['url'],
				'color' => $arr['color'],
				'target' => $arr['target'],
				'summary' => !empty($arr['summary']) ? html_entity_decode(str_replace('\r\n','<br>',$arr['summary'])) : '',
				'frame' => !empty($arr['frame']) ? attachment_url($arr['frame']) : '',
			);
			
		}else{
			$this->menus[$arr['id']] = $arr;
			
		}
	}
	
	//生成JSON用的
	$_top_menus = array();
	
	foreach($this->menus as $v){
		if($v['parent']){
			$this->menus[$v['parent']]['menus'][] = &$this->menus[$v['id']];
			
			$_menus[$v['parent']]['menus'][$v['id']] = &$_menus[$v['id']];
		}else{
			$this->top_menus[] = &$this->menus[$v['id']];
			
			$_top_menus[$v['id']] = &$_menus[$v['id']];
			
			if($v['system'] == 'core'){
				$this->core_menus[] = &$this->menus[$v['id']];
			}else{
				$this->system_menus[] = &$this->menus[$v['id']];
			}
		}
	}
	
	$this->_data = array(
		'top_menus' => &$this->top_menus,
		'core_menus' => &$this->core_menus,
		'system_menus' => &$this->system_menus,
		'menus' => &$this->menus
	);
	
	if($write){
		$CACHE->write('', 'core', 'navigation_menu', $this->_data, 'serialize');
		$CACHE->write('', 'core', 'navigation', $this->make_full_url($this->core_menus['0']), 'var_export');
		//每个系统的导航分开缓存
		foreach($this->system_menus as $k  => $v){
			$CACHE->write('', $v['system'], 'navigation', $this->make_full_url($v), 'var_export');
		}
		$json = array(
			'json' => jsonencode($_top_menus)
		);
		
		$json = array(
			'json' => jsonencode($_top_menus)
		);
		
		//菜单路径
		$path = array();
		foreach($this->menus as $v){
			$parents = $this->get_parents($v['id']);
			$tmp = array();
			foreach($parents as $p){
				if(isset($p['id'])) $tmp[] = $p['id'];
			}
			if(isset($v['id'])) {
				$tmp[] = $v['id'];
				$path[$v['id']] = $tmp;
			}
		}
		$json['path'] = jsonencode($path);
		$CACHE->write('', 'core', 'navigation_menu_json', $json);
	}
	
	unset($_menus, $_top_menus);
}
function make_full_url($data){
	global $core;
	foreach((array)$data['menus'] as $k => $v){
		if(!empty($v['menus']))$data['menus'][$k]=$this->make_full_url($v);
		if(strstr($v['url'],"http"))continue;
		$data['menus'][$k]['url']=$core->url.'/'.$v['url'];
		if(substr($data['menus'][$k]['url'],0,2) == '//') $data['menus'][$k]['url'] = substr($data['menus'][$k]['url'],1);		
	}
	return $data;
}
/**
* 读取菜单缓存
**/
function get_cache(){
	global $CACHE;
	
	$this->_data = $CACHE->read('', 'core', 'navigation_menu', 'serialize');
	
	$this->menus = &$this->_data['menus'];
	$this->top_menus = &$this->_data['top_menus'];
	$this->core_menus = &$this->_data['core_menus'];
	$this->system_menus = &$this->_data['system_menus'];
}
function get_system_menu($system){
	global $CACHE;
	
	$this->_data = $CACHE->read('', 'core', 'navigation_menu', 'serialize');
	foreach($this->_data->menus as $k=>$v){
		if($v['system']==$system){
			$m[] = $v;
		}
	}
	$this->system_menu = $m;
}
/**
* 追溯菜单的父菜单到根
* @param int $id 菜单的ID
* @return array 
**/
function get_parents($id){
	
	if(empty($this->menus[$id]['parent'])) return array();
	
	$p = $this->menus[$id]['parent'];
	$ps = array();
	while($p){
		array_unshift($ps, $this->menus[$p]);
		unset($ps[0]['menus']);
		$p = $this->menus[$p]['parent'];
	}
	return $ps;
}

/**
* 获得菜单全部子菜单的ID
* @param int $id 菜单的ID
* @return array 
**/
function get_children_ids($id){
	if(empty($this->menus[$id]['menus'])) return array();
	
	$ids = array();
	foreach($this->menus[$id]['menus'] as $v){
		$ids[$v['id']] = $v['id'];
		if(isset($v['menus']))
			$ids = $ids + $this->get_children_ids($v['id']);
	}
	
	return $ids;
}

}

$navigation_menu = new P8_Navigation_Menu();
