<?php
defined('PHP168_PATH') or die();


class P8_Sites_Stop extends P8_Module{

var $cat_table;
var $table;

var $top_categories;
var $categories;

function __construct(&$system, $name){
	$this->system = &$system;
	parent::__construct($name);
	
	$this->cat_table = $this->TABLE_ .'category';
    
	$this->table = $this->TABLE_ .'data';
}


function push($data,$filter_word_enable = false,$to='sites',$from='sites'){
	global $core,$USERNAME,$P8LANG;
	defined('P8_CLUSTER') || define('P8_CLUSTER',true);	
	$d = array();
    $sc = '';
	$category_count = array();
	
	$i = 0;
    $res= array();

	foreach($data as $v){
		//客户端的内容ID
		$client_item_id = $v['id'];
		unset($v['id']);
		//没有来源设置一下
		$domain = $this->system->site['ipordomain'] == 1 ? $this->system->site['domain'] : $core->CONFIG['url'].'/s.php/'.$this->system->site['alias'];
		//上面往下推的
		if($v['sc']=='s') $domain = $core->CONFIG['url'];
		$v['source'] = ($v['sc']=='s' ? '总站' : $this->system->site['sitename']);
		$v['attribute'][] = 11;
		$v['html'] = 1;//去静态干扰
		$d = array(
            'cid' => $v['cid'],
            'cname' => $v['cname'],
            'site' => isset($v['site'])?$v['site']:'',
            'item_id' => $v['item_id'],
            'sc' => $v['sc']=='t'?'s':$v['sc'],
            'model' => $v['model'],
            'model_alias' => $v['model_alias'],
			'title' => $v['title'],
			'data' => $v,
			'link' => $v['link'],
			'timestamp' => P8_TIME,
			'push_username' => $USERNAME,
			'to' => $to ? $to : 'sites',
			'from' => $from ? $from : 'sites',
		);
		if($v['sc']=='s') $d['site_status'] = isset($v['site'])?$v['site']:'';
		
		$org_data = $d['data'] = $this->DB_master->escape_string(serialize($d['data']));
		//设置增加接收端的数据
		if($id = $this->DB_master->insert(
			$this->table,
			$d,
			array('return_id' => true))
		){			
			$d['data'] = $v;  
			//是否校验关键字，默认校验
			//var_dump($filter_word_enable);exit;
			if($filter_word_enable){
				$cms = &$this->core->load_system('cms');
				$item = &$cms->load_module('item');			
				$controller = &$this->core->controller($item);
				$matches_t = isset($d['title']) ? $controller->valid_filter_word($d['title']) : array();
				$matches_c = isset($d['data']['content']) ? $controller->valid_filter_word($d['data']['content']) : array();
				$matches = $matches_t + $matches_c;
				$ms = '';
				if($matches){
					$this->DB_master->delete(
						$this->table,
					   "id = $id"
					);
					foreach($matches as $v) $ms .= $v.',';					
					$mes['message'] = p8lang($P8LANG['title_include_filter_word2'], array(count($matches))).':'.substr($ms,0,-1);
					exit(p8_json($mes));									
				}
			}
            //下面往上推的，调用cms加文章
             if($v['sc']=='c'){              
				$new_id = $this->push_to_cms($id,$d,$filter_word_enable);
            //上面往下推的，调用item加文章
             }elseif($v['sc']=='s'){				
                $this->receive($id,$d,$filter_word_enable);
			}else{				
				//增加推送方的数据				
				$d['sc'] = 'c';
				$to_site = $d['site'];
				$d['site'] = $this->system->SITE;
				$sc_data = $d;
				$sc_data['data'] = $org_data;
				$this->DB_master->insert($this->table,$sc_data,array('return_id' => true));
				$d['site'] = $to_site;
				$this->sites_to_sites($id,$d,$filter_word_enable,$v['item_id'],$from);
			}
            
            $category_count[$v['cid']] = isset($category_count[$v['cid']]) ? $category_count[$v['cid']] +1 : 1;
		
            $i++;
        }
	}
    return $i;
}
//
function get_push_item_username($new_id){
	 if(!$new_id)return;
	 $push_info = $this->DB_master->fetch_one("SELECT `push_username` FROM {$this->table} WHERE `new_id`='$new_id'");	
	 return !empty($push_info['push_username']) ? $push_info['push_username'] : '';
}
function sites_to_sites($sid, &$data,$filter_word_enable = false,$item_id=0,$from='cms'){
	//加载本地相关模块
	$item = &$this->system->load_module('item');
	$controller = &$this->core->controller($item);
	
	$ret = array();
    $allsites = $this->system->get_sites();
    $push_site = $data['site']?explode(',',$data['site']):array();	
    $_REQUEST['model'] = $data['model'];
    $this->system->init_model();
    $item->set_model($_REQUEST['model']);
	$res=array();
	$this_site = $this->system->SITE;	
	foreach($allsites as $alias=>$sdata){
		if($push_site && !in_array($alias,$push_site))continue;
		$this->system->init_site($alias);
        if($from=='cms'){
			$map = $this->get_map();
			//没有设置这个分类的对接或默认的对接
			if(isset($map['map'][$data['cid']])){
				$cid = $map['map'][$data['cid']];
			}else if(isset($map['map'][0])){
				$cid = $map['map'][0];
			}else{
				continue;
			}
			$data['data']['verify'] = empty($map['auto_verify']) ? 0 : 1;
			$data['data']['cid'] = $cid;
			unset($cid);
		}else{
		//	$data['data']['verify'] = $controller->check_category_action('autoverify', $data['data']['cid'], $alias) ? 1 : 0;
		}		
        $data['data']['attribute'][] = 11;
		$data['data']['html'] = 1;        
		//unset($data['data']['timestamp'],$data['data']['list_order']);//主站推送给分站的时间，客户须要是最新时间，不能是主站发布的旧时间。 分站推送给主站也是一样。       
		$data['data']['content_censor_enabled'] = 1;
		$data['data']['push_item_id'] = $sid;
		if($this_site != $alias && $id = $controller->add($data['data'],true,$filter_word_enable)){
			$res[]=$alias;
			//追加
            if(!empty($data['data']['addon'])){
                foreach($data['data']['addon'] as $vv){
                    $vv['iid'] = $id;
                    $controller->addon($vv);
                }
            }
			//if($data['data']['verify']){
				//设置接收端
				$push_id = $this->set_receive_status(array($alias), $sid,$data['data']['verify']?1:0,$id);
				//设置发送端
				if($push_id) $this->set_push_item_status($id,$data['data']['verify']?1:0,array($alias), $push_id['id']);
			//}			
        }
		
    }
	//go back the sites
	$this->system->init_site($this_site);
	$this->system->load_site($this_site);
	//$this->set_receive_status($res,$sid);
}

function receive($sid, &$data,$filter_word_enable = false){
	global $core,$USERNAME;
	//加载本地相关模块
	$item = &$this->system->load_module('item');
	$controller = &$this->core->controller($item);
	
	$ret = array();
    $allsites = $this->system->get_sites();
    $push_site = $data['site']?explode(',',$data['site']):array();

    $_REQUEST['model'] = $data['model'];
    $this->system->init_model();
    $item->set_model($_REQUEST['model']);
	$res=array();
	$this_site = $this->system->SITE;
    foreach($allsites as $alias=>$sdata){
		if($push_site && !in_array($alias,$push_site))continue;
        $this->system->init_site($alias);
        /*
		$map = $this->get_map();
        //没有设置这个分类的对接或默认的对接
        if(isset($map['map'][$data['cid']])){
            $cid = $map['map'][$data['cid']];
        }else if(isset($map['map'][0])){
            $cid = $map['map'][0];
        }else{
            continue;
        }
        $data['data']['cid'] = $cid;
        //$data['data']['attributes'] = explode(',',$data['data']['attributes']);
		*/
		$data['data']['attribute'][] = 11;
		$data['data']['content_censor_enabled'] = 1;
		$data['data']['filter_word_enable'] = 1;
		$data['data']['html'] = 1;//去静态干扰
		/*
		$data['data']['verify'] = 0;		
		if($controller->check_category_action('autoverify', $data['data']['cid'],$data['data']['site'])){
			$data['data']['verify'] = 1;
			$data['data']['verifier'] = $USERNAME;
		}
		*/
		$data['data']['push_item_id'] = $sid;		
		//unset($data['data']['timestamp'],$data['data']['list_order']);//主站推送给分站的时间，客户须要是最新时间，不能是主站发布的旧时间。 分站推送给主站也是一样。
        //unset($cid);		
		//var_dump($data['data']);exit;		
		if($id = $controller->add($data['data'],true,$filter_word_enable)){
           $res[]=$alias;
            //追加			
            if(!empty($data['data']['addon'])){
                foreach($data['data']['addon'] as $vv){
                    $vv['iid'] = $id;
                    $controller->addon($vv);
                }				
			}
			//设置接收端
			$this->DB_master->update($this->table,array('new_id'=>$id,'status'=>$data['data']['verify'],'site_status'=>$data['site']),"id='$sid'");            
        }
    }
	//go back the sites
	$this->system->load_site($this_site);
    //$this->set_receive_status($res,$sid);
}
//设置接收方的状态
function set_receive_status($sites, $sid,$status=0,$iid=0){
    if(!$sites)return;
    $query = $this->DB_master->fetch_one("SELECT site_status,timestamp,title FROM {$this->table} WHERE id='$sid'");
    $site_status = explode(',',$query['site_status']);
    $site_status = array_merge($site_status,$sites);
    $site_status = array_filter($site_status);
    $site_status = implode(',',array_unique($site_status));
    $this->DB_master->update($this->table,array('status'=>$status,'site_status'=>$site_status,'new_id'=>$iid),"id='$sid'");
	$timestamp = $query['timestamp'];
	$title = $query['title'];
	return $this->DB_master->fetch_one("SELECT `id` FROM {$this->table} WHERE `sc`='c' and `title` = '$title' and timestamp='$timestamp'");
}
//设置推送方的状态
function set_push_item_status($push_item_id,$status=1,$sites='',$id=0){
	//子站推子站
	if($sites && $id){
		$query = $this->DB_master->fetch_one("SELECT site_status FROM {$this->table} WHERE `id`='$id'");
		$site_status = explode(',',$query['site_status']);
		$site_status = array_merge($site_status,$sites);
		$site_status = array_filter($site_status);
		$site_status = implode(',',array_unique($site_status));		
		return $this->DB_master->update($this->table,array('status'=>$status,'site_status'=>$site_status,'new_id'=>$push_item_id),"`id`='$id'");
	}else{
		return $this->DB_master->update($this->table,array('status'=>$status),"new_id='$push_item_id' and `to`='cms'");
	}
}

function push_to_cms($sid, $data,$filter_word_enable = false){
	global $core;	
	$cms = &$this->core->load_system('cms');
	$item = &$cms->load_module('item');
	$category = &$cms->load_module('category');
	$controller = &$this->core->controller($item);				
    $_REQUEST['model'] = $category->categories[$data['cid']]['model'];
    $cms->init_model();
    $item->set_model($_REQUEST['model']);
    //没有来源设置一下
	$domain = $this->system->site['ipordomain'] == 1 ? $this->system->site['domain'] : $core->CONFIG['url'].'/s.php/'.$this->system->site['alias'];
    $data['data']['source'] = $this->system->site['sitename'];
	$data['data']['attribute'][] = 11;
	$data['data']['html'] = 1;//干扰
	$data['data']['content_censor_enabled'] = 1;
    //unset($data['data']['timestamp'],$data['data']['list_order']);//主站推送给分站的时间，客户须要是最新时间，不能是主站发布的旧时间。 分站推送给主站也是一样。//20170517更新，像吃屎一样被要求改回用旧时间
    //var_dump($data['data']);exit;
	if($id = $controller->add($data['data'],true,$filter_word_enable)){
        $ret[] = $id;
        //追加
        if(!empty($data['addon'])){
            foreach($data['addon'] as $vv){
                $vv['iid'] = $id;
                
                $controller->addon($vv);
            }
        }
        $this->DB_master->update($this->table,array('new_id'=>$id,'status'=>$data['data']['verify']),"id='$sid'");
		return $id;
    }else{
		return false;
	}

}

function add_category($data){
    $_data = array(
		'parent' => isset($data['parent']) ? intval($data['parent']) : 0,
		'name' => isset($data['name']) ? html_entities($data['name']) : 0,
		'display_order' => isset($data['display_order']) ? intval($data['display_order']) : 0
	);
    return $this->DB_master->insert(
		$this->cat_table,
		$data,
		array('return_id' => true)
	);

}

function update_category($id, $data){
    $_data = array(
		'parent' => isset($data['parent']) ? intval($data['parent']) : 0,
		'name' => isset($data['name']) ? html_entities($data['name']) : 0,
		'display_order' => isset($data['display_order']) ? intval($data['display_order']) : 0
	);
    if(in_array($_data['parent'], $this->get_children_ids($id) + array($id))) return false;
	return $this->DB_master->update(
		$this->cat_table,
		$_data,
		"id = '$id'"
	);
}

function delete_category($data){
	$query = $this->DB_master->query("SELECT id FROM $this->cat_table WHERE $data[where]");
	$id = array();
	$this->get_category_cache();
	while($arr = $this->DB_master->fetch_array($query)){
		$id[] = $arr['id'];
		$cids = $this->get_children_ids($arr['id']);
		$id = array_merge($id, $cids);
	}
	
	$ids = implode(',', $id);
	
	if($ids && $status = $this->DB_master->delete($this->cat_table, "id IN ($ids)")){
		
		return $this->DB_master->delete(
            $this->table,
			'cid IN ('. $ids .')'
		);
	}
	return false;
}

function get_category_cache($read_cache = true){
	if(!empty($this->categories)) return;
	
	if(
		$read_cache &&
		$this->data = $this->core->CACHE->read($this->system->name .'/modules/', $this->name, 'categories','serialize')
	){
		$this->categories = &$this->data['categories'];
		$this->top_categories = &$this->data['top_categories'];
	}else{
		$this->cache(false);
	}
}

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

function get_map($reflash=false){
    
    if(!$reflash && $return = $this->core->CACHE->read($this->system->name .'/modules/'.$this->name.'/', 'map', $this->system->SITE,'serialize')){
        return $return;
    }else{
        $return = $this->DB_master->fetch_one("SELECT data2 FROM {$this->system->TABLE_}site WHERE alias='{$this->system->SITE}'");
        $return = $return['data2'];
        if($return)
            $this->core->CACHE->write($this->system->name .'/modules/letter/', 'map', $this->system->SITE, $return);
        return mb_unserialize($return);
    }

}

function set_map($data){
    $this->DB_master->update(
        $this->system->TABLE_.'site',
        array('data2'=>serialize($data)),
        "alias='{$this->system->SITE}'"
    );
}

function cache(){
    $this->cache_category();

}

function cache_category($write_cache = true){

    $this->categories = array();
	$this->top_categories = array();
	$_categories = array();
	$_top_categories = array();
	
	$query = $this->DB_master->query("SELECT * FROM $this->cat_table ORDER BY display_order DESC");
	while($arr = $this->DB_master->fetch_array($query)){
		
		$this->categories[$arr['id']] = $arr;
		
		if($write_cache){
			$_categories[$arr['id']] = $this->categories[$arr['id']] = array(
				'id' => $arr['id'],
				'parent' => $arr['parent'],
				'name' => $arr['name'],
				'display_order' => $arr['display_order'],
				'item_count' => $arr['item_count']
			);
		}
	}
	
	foreach($this->categories as $v){
		if(isset($this->categories[$v['parent']]['parent']) && $this->categories[$v['parent']]['parent']==$v['id'])
			$this->categories[$v['id']]['parent']=$v['parent']=0;
		if($v['parent']){
			$this->categories[$v['parent']]['categories'][$v['id']] = &$this->categories[$v['id']];
			
			if($write_cache) $_categories[$v['parent']]['categories'][$v['id']] = &$_categories[$v['id']];
		}else{
			$this->top_categories[$v['id']] = &$this->categories[$v['id']];
			
			if($write_cache) $_top_categories[$v['id']] = &$_categories[$v['id']];
		}
	}
	
	if($write_cache){
		$this->data = array(
			'categories' => &$this->categories,
			'top_categories' => &$this->top_categories
		);
		
		$this->core->CACHE->write($this->system->name .'/modules/', $this->name, 'categories', $this->data, 'serialize');
		
		$json = array(
			'json' => jsonencode($this->make_json_sort($_top_categories))
		);
		
		$path = array();
		foreach($this->categories as $v){
			$parents = $this->get_parents($v['id']);
			$tmp = array();
			foreach($parents as $p){
				$tmp[] = $p['id'];
			}
			$tmp[] = $v['id'];
			
			$path[$v['id']] = $tmp;
		}
		$json['path'] = jsonencode($path);
		
		$this->core->CACHE->write($this->system->name .'/modules/', $this->name, 'json', $json);
	}
    
}
/**
* 取得缓存的JSON
**/
function get_json(){
	$this->cache();
	$json = $this->core->CACHE->read($this->system->name .'/modules', $this->name, 'json');
	return array(
		'json' => empty($json['json']) ? '{}' : $json['json'],
		'path' => empty($json['path']) ? '{}' : $json['path'],
	);
}
function make_json_sort($data){
	$return = array();
	if(!is_array($data))return $return;
	foreach($data as $k=>$v){
		if(!empty($v['categories'])){
			$v['categories']=$this->make_json_sort($v['categories']);
		}
		$return[]=$v;
	}

	return $return;

}

}