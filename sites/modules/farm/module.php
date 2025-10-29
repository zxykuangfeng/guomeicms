<?php
defined('PHP168_PATH') or die();

/**
* 添加模型的系统需求
* /template/default/cms/item/		可写	创建模板目录
* /template/label/cms/				可写	创建标签模板
* /lang/zh-cn/cms/item/				可写	创建语言包
* /skin/default/cms/item/			可写	创建风格目录
* /cms/model/						可写	创建模型脚本
* /cms/								可写	创建HTML存放目录
**/

class P8_Sites_farm extends P8_Module{

var $table;
var $table_recycle;
var $table_menu;
var $table_menu_custom;
var $table_menu_nav;
var $dept_table;

function __construct(&$system, $name){
	$this->configurable = false;	//暂没有设置
	$this->system = &$system;
	parent::__construct($name);
	
	$this->table = $this->system->TABLE_ .'site';
	$this->table_recycle = $this->system->TABLE_ .'site_recycle';
	$this->table_menu = $this->system->TABLE_ .'menu';
	$this->table_menu_custom = $this->system->TABLE_ .'menu_custom';
	$this->table_menu_nav = $this->system->TABLE_ .'menu_nav';
	$this->dept_table = $this->core->TABLE_ .'member_dept';
}


function get_sites_templates(){
	$path = TEMPLATE_PATH . '/sites/';
	$h = opendir($path);
	$return = array();
	while($n = readdir($h)){
		if($n!='..' && $n!='.'){
			if(is_dir($path.$n)){
				if(is_file($path.$n.'/#.php'))
					$return[$n] = require($path.$n.'/#.php');
			}
		}
	
	}
	return $return;
}

function get_department_category($reflash=false){
	global $CACHE;
	if($reflash || !$return = $CACHE->read('core/modules/', 'member', 'dept','serialize')){
		$query = $this->DB_master->fetch_all("SELECT * FROM $this->dept_table ORDER BY display_order desc");		
		foreach($query as $key => $rs){
			//构建一级架构
			if($rs['parent'] == 0){
				$department[$rs['id']] = $rs;
			}			
		}
		//构建二级架构
		foreach($query as $key=>$rs){
			if($rs['parent']){
				$department[$rs['parent']]['menus'][] = $rs;
			}			
		}			
	}else{		
		$department = $this->department_deal($return['province']);	
	}
	$return = array('department'=>$department);
	return $return;
}

function department_deal($data){
	foreach($data as $key=>$val){
		unset($data[$key]['item_count']);
		unset($data[$key]['item_score']);
		unset($data[$key]['item_count_sites']);
		unset($data[$key]['item_score_sites']);
		$val['depts'] = $this->department_deal($val['depts']);
		$data[$key]['menus'] = $val['depts'];
		unset($data[$key]['depts']);
	}
	return $data;
}
function add($data){
	$id = $this->DB_master->insert(
		$this->table,
		$this->DB_master->escape_string($data),
		array('return_id' => true)
	);
	if($id){
		md($this->system->path.'html/'.$data['alias']);
		cp($this->system->path.'html/default/index.php',$this->system->path.'html/'.$data['alias'].'/index.php');
		cp($this->system->path.'html/default/sync_session.php',$this->system->path.'html/'.$data['alias'].'/sync_session.php');
		cp($this->system->path.'html/default/respond_proxy.php',$this->system->path.'html/'.$data['alias'].'/respond_proxy.php');
		$this->system->load_site($data['alias']);
        $data['domain'] && $this->set_session_sync($data['domain']);
		$this->cache($data['alias']);
		return $id;
	}
	return false;
}
function update($alias, $data){
	$status = $this->DB_master->update(
		$this->table,
		$this->DB_master->escape_string($data),
		"alias='$alias'"
	);
    $data['domain'] && $this->set_session_sync($data['domain']);
	
	$this->cache($alias);
	return $status;
}

function recycle($alias,$backup = false){ 

    if($backup){
		//restore
		$data = $this->DB_master->fetch_one("SELECT * from {$this->table_recycle} WHERE alias='$alias'");
		unset($data['id']);
		$status = $this->DB_master->insert(
			$this->table,
			$this->DB_master->escape_string($data),
			array('return_id' => true)		
		);
		if($status){
			$this->DB_master->delete(
				$this->table_recycle,
				"alias='$alias'"
			);
		}	
		mkdir($this->system->path.'html/'.$alias);
		mkdir(CACHE_PATH.'sites/menu/'.$alias);
		mkdir(CACHE_PATH.'sites/modules/category/'.$alias);
	}else{
		//recycle
		$data = $this->DB_master->fetch_one("SELECT * from {$this->table} WHERE alias='$alias'");
		unset($data['id']);
		$status = $this->DB_master->insert(
			$this->table_recycle,
			$this->DB_master->escape_string($data),
			array('return_id' => true)		
		);
		if($status){
			$this->DB_master->delete(
				$this->table,
				"alias='$alias'"
			);
		}
		rm($this->system->path.'html/'.$alias);
		rm(CACHE_PATH.'sites/menu/'.$alias);
		rm(CACHE_PATH.'sites/modules/category/'.$alias);
	}
    $this->cache();
}

function delete($alias){
    $this->DB_master->delete(
		$this->table_recycle,
		"alias='$alias'"
	);

    $this->DB_master->delete($this->core->TABLE_ .'label', "site = '$alias'");
    $this->DB_master->delete($this->system->TABLE_ .'menu', "site = '$alias'");
    $this->DB_master->delete($this->system->TABLE_ .'log', "site = '$alias'");
    $this->DB_master->delete($this->system->TABLE_ .'category', "site = '$alias'");
    rm($this->system->path.'html/'.$alias);
    rm(CACHE_PATH.'sites/menu/'.$alias);
    rm(CACHE_PATH.'sites/modules/category/'.$alias);

    $this->cache();
}

function delete_recycle($alias){
	return $this->DB_master->delete(
		$this->table_recycle,
		"alias='$alias'"
	);
}

function get_site($alias, $format=false){
	$site = $this->DB_master->fetch_one("SELECT * from {$this->table} WHERE alias='$alias'");
    return $format?$this->format_cate($site):$site;
}

function get_recycle_site($alias){
	return $this->DB_master->fetch_one("SELECT * from {$this->table_recycle} WHERE alias='$alias'");
}

function get_sub_site($parent){
	return $this->DB_master->fetch_all("SELECT `alias` from {$this->table} WHERE parent='$parent'");
}

function get_parent_site($parent){
	return $this->DB_master->fetch_one("SELECT * from {$this->table} WHERE id='$parent'");
}

function set_session_sync($domain){
    $_domain = str_replace(array('http://','https://'),'',$domain);
    $session_cross_domains = $this->core->CONFIG['session_cross_domains'];
    if(!array_key_exists($_domain,$session_cross_domains)){
        $session_cross_domains[$_domain] = $domain.'/sync_session.php';
    }
    $this->core->set_config(array('session_cross_domains'=>$session_cross_domains));
}

function format_cate($site){
    global $STATIC_URL;
    $site['config']= mb_unserialize($site['config']);
    $site['config'] = str_replace('{$STATIC_URL}',$STATIC_URL,$site['config']);
    $site['data1']= mb_unserialize($site['data1']);
    $site['data2']= mb_unserialize($site['data2']);
    $site['data3']= mb_unserialize($site['data3']);
    $site['htmlurl']= rtrim($this->core->url,'/').'/'.$this->system->name.'/html/'.$site['alias'];
    return $site;
}

function set_acls($data){
	$data['independent_verify'] = isset($data['independent_verify']) && $data['independent_verify'] ? $data['independent_verify'] : array();
	$alias = array_keys($data['independent_verify']);
	if(empty($alias)) return;
	$s = $comma = '';
	foreach($alias as $v){
		$s .= $comma ."'$v'";
		$comma = ',';
	}	
	$sites = $this->DB_master->fetch_all("SELECT * FROM $this->table where alias in ($s) ORDER BY sort DESC");
	$site_data = array();
	foreach($sites as $site){
		$this_site = $site['alias'];
		if($this_site){
			$config = mb_unserialize($site['config']);
			$config = p8_stripslashes($config);		
			$config['independent_verify'] = isset($data['independent_verify'][$this_site]) && $data['independent_verify'][$this_site] ? 1 : 0;
			$site_data['config'] = serialize($config);
			if(isset($data['manager'])){
				$site_data['manager'] = $data['manager'][$this_site] ? implode(',',$data['manager'][$this_site]) : '';
			}
			if(isset($data['manager_role'])){
				$site_data['manager_role'] = $data['manager_role'][$this_site] ? implode(',',$data['manager_role'][$this_site]) : '';			
			}
			if(isset($data['poster'])){
				$site_data['poster'] = $data['poster'][$this_site] ? implode(',',$data['poster'][$this_site]) : '';			
			}		
			$this->update(
				$this_site,
				$site_data		
			);
		}		
	}
}

function cache($alias = ''){

	parent::cache();

	$sites = $this->DB_master->fetch_all("SELECT * FROM $this->table ORDER BY sort DESC");
    if(empty($sites))return;
	//读取缓存的模型
	$cache_sites = array();
	$sites_all = 'var P8_SITES_ALL = [';

	$role = &$this->core->load_module('role');
    $manager_data = $alias? $this->core->CACHE->read($this->system->name, '', 'manager','serialize'):array('manager'=>array(),'poster'=>array(),'role'=>array());
    
	foreach($sites as $site){

		$cache_sites[$site['alias']] = array(
            'id' => $site['id'],
            'sitename' => $site['sitename'],
            'alias' => $site['alias'],
            'domain' => $site['domain'],
            'ipordomain' => $site['ipordomain'],
            'manager' => $site['manager'],
            'poster' => $site['poster'],
            'manager_role' => $site['manager_role'],
            'status' => $site['status'],
			'parent' => $site['parent'] ? $site['parent'] : 0,
        );
		if($site['status']){
			$sites_all .= '{alias:"'.$site['alias'].'",name:"'.$site['sitename'].'"},';
		}
        $site = $this->format_cate($site);
        
       if(!empty($alias) && $alias!=$site['alias'])continue;
       if($alias==$site['alias']){
            foreach($manager_data['manager'] as $u=>$ss){
                if(in_array($site['alias'],$ss)){
                    $tmp = array_flip($ss);
                    unset($tmp[$site['alias']]);
                    $manager_data['manager'][$u]=array_flip($tmp);
                }
            }
			if(!empty($manager_data['poster']))foreach($manager_data['poster'] as $u=>$ss){
                if(in_array($site['alias'],$ss)){
                    $tmp = array_flip($ss);
                    unset($tmp[$site['alias']]);
                    $manager_data['poster'][$u]=array_flip($tmp);
                }
            }
             if(!empty($manager_data['role']))foreach($manager_data['role'] as $u=>$ss){
                if(in_array($site['alias'],$ss)){
                    $tmp = array_flip($ss);
                    unset($tmp[$site['alias']]);
                    $manager_data['role'][$u]=array_flip($tmp);
                }
            }
        }
		
        if(!empty($site['manager'])){
            $manager = explode(',',$site['manager']);
            foreach($manager as $uid){
                $manager_data['manager'][$uid][] = $site['alias'];
            }
        }
		if(!empty($site['poster'])){
            $poster = explode(',',$site['poster']);
            foreach($poster as $uid){
                $manager_data['poster'][$uid][] = $site['alias'];
            }
        }
        if(!empty($site['manager_role'])){
            $manager_role = explode(',',$site['manager_role']);
            foreach($manager_role as $r){
                $manager_data['role'][$r][] = $site['alias'];
            }
        }
        //写站点缓存
        $this->core->CACHE->write($this->system->name .'/modules/', $this->name,$site['alias'], $site);
        
		$role->cache_role($site['alias']);
		
		if(!is_dir($this->system->path.'html/'.$site['alias'])){
			
			md($this->system->path.'html/'.$site['alias']);
			cp($this->system->path.'html/default/index.php',$this->system->path.'html/'.$site['alias'].'/index.php');
			cp($this->system->path.'html/default/sync_session.php',$this->system->path.'html/'.$site['alias'].'/sync_session.php');
            cp($this->system->path.'html/default/respond_proxy.php',$this->system->path.'html/'.$site['alias'].'/respond_proxy.php');
        }
		
		
	}
	$sites_all .= '];';
	//写模型总缓存
    if($cache_sites){
        $this->core->CACHE->write($this->system->name .'/modules/', $this->name, 'all', $cache_sites);
		write_file(PHP168_PATH .'js/sites_all.js', $sites_all);
    }
	$this->core->CACHE->write($this->system->name, '', 'manager', $manager_data,'serialize');
    
	$this->menu_cache($alias);
}


function add_menu($data){
	$id = $this->DB_master->insert(
		$this->table_menu,
		$this->DB_master->escape_string($data),
		array('return_id' => true)
	);
	$this->menu_cache($this->system->SITE);
	return $id;

}

function update_menu($data,$id){
	$id = $this->DB_master->update(
		$this->table_menu,
		$this->DB_master->escape_string($data),
		"id='$id'"
	);
	$this->menu_cache($this->system->SITE);
	return $id;
}
function get_menu($site, $format=true, $all=true){
	$where = $all? '':' AND display=1';
	$sql = "SELECT * FROM {$this->table_menu} WHERE site='$site' $where ORDER BY display_order DESC";
	$query = $this->DB_master->query($sql);
	$menus = array();
	$system_url = $this->system->get_site_domain($site);
	$system_controller = $this->system->get_site_controller($site);
	while($row=$this->DB_master->fetch_array($query)){
		$format && $row['url'] = str_replace(array('{$system_url}','{$site_domain}','{$system_controller}'),array($system_controller,$system_url,$system_controller),$row['url']);
		$row['frame'] = $row['frame'] ? attachment_url($row['frame']) : '';
		$menus[$row['id']] = $row;
	}
	foreach($menus as $mid=>$md){
		if($md['parent']){
			$menus[$md['parent']]['menus'][$mid] = $md;
			unset($menus[$mid]);
		}	
	}
	return $menus;
}
function delete_menu($id){
	
	$cids = $this->get_children_ids($id);
	array_unshift($cids, $id);
	
	$ids = implode(',', $cids);
	
	$this->DB_master->delete($this->table_menu, "id IN ($ids)");
	$this->menu_cache($this->system->SITE);
	return $cids;
}
function get_children_ids($id){
	$menus = $this->get_menu($this->system->SITE);
	if(empty($menus[$id]['menus'])) return array();
	
	$ids = array();
	foreach($menus[$id]['menus'] as $v){
		$ids[$v['id']] = $v['id'];
		if(isset($v['menus']))
			$ids = $ids + $this->get_children_ids($v['id']);
	}
	
	return $ids;
}

function set_farm_config($alias, $data){
	$status = $this->DB_master->update(
		$this->table,
		$this->DB_master->escape_string($data),
		"alias='$alias'"
	);    
	$this->cache($alias);
	return $status;
}
/**
* 菜单动静态转换
**/
function change_url($site='',$changeto = 'html'){
	if(empty($site)) return;
	if($changeto == 'html'){
		$domain = $this->system->domain;
		$domain = strpos($domain,'/s.php/') ? str_replace('s.php','sites/html',$domain) : $domain;
		$query = $this->DB_master->query("SELECT * FROM $this->table_menu where `site`='$site' ORDER BY display_order DESC");
		while($arr = $this->DB_master->fetch_array($query)){			
			$action = $url = '';
			$data = $CAT = array();
			$ids = 0;
			$id = $arr['id'];
			//优先使用动态
			$empty_dynamic = empty($arr['dynamic_url']) ? true : false;	
			$tmpexp = explode('-',$arr['dynamic_url']?$arr['dynamic_url']:$arr['url']);
			$ids = explode('.',end($tmpexp));
			if(in_array('list',$tmpexp) && in_array('category',$tmpexp)){						
				$action = 'list';
			}elseif(in_array('view',$tmpexp)){
				$action = 'view';
			}
			if($action && $ids){
				if($action=='list'){						
					$CAT = $this->system->fetch_category($ids[0]);
					$item_module = $this->system->load_module('item');
					/*如果内容不存在，尝试使用默认静态规则静态化*/
					if(empty($CAT)){												
						$CAT = array(
							'id' => $ids[0],
							'html_list_url_rule' => '{$system_url}/{$id}/#list-{$page}.shtml#',						
						);
					}
					$CAT['is_category'] = true;
					$CAT['htmlize'] = 1;			
					$url = $this->system->site_p8_url($item_module, $CAT, 'list');
					$dynamic_url = '{$system_url}/item-list-category-'.$ids[0].'.html';
					if($this->system->site['config']['menu_mode'] == 1) $url = str_replace($domain.'/','',$url);
					if($this->system->site['config']['menu_mode'] == 2) $url = str_replace('/sites/html/','/',$url);
					if($url) $this->DB_master->update($this->table_menu,array('url'=>$url),"`id`=$id");
					if($empty_dynamic) $this->DB_master->update($this->table_menu,array('dynamic_url'=>$dynamic_url),"`id`=$id");
				}elseif($action=='view'){
					$item_module = $this->system->load_module('item');
					$data = $item_module->data('read', $ids[0]);					
					$CAT = array();
					/*如果内容不存在，尝试使用默认静态规则静态化*/
					if(empty($data)){
						$data['id'] = $ids[0];
						$data['timestamp'] = P8_TIME;
						$CAT['html_view_url_rule'] = '{$system_url}/{$Y}_{$m}/{$d}_{$H}/content-{$id}#-{$page}#.shtml';						
					}else{
						$CAT = $this->system->fetch_category($data['cid']);
					}
					$CAT['htmlize'] = 2;
					$data['#category'] = &$CAT;
					$url = $this->system->site_p8_url($item_module, $data, 'view');	
					$dynamic_url = '{$system_url}/item-view-id-'.$ids[0].'.html';
					if($this->system->site['config']['menu_mode'] ==1) $url = str_replace($domain.'/','',$url);
					if($this->system->site['config']['menu_mode'] ==2) $url = str_replace('/sites/html/','/',$url);
					if($url) $this->DB_master->update($this->table_menu,array('url'=>$url),"`id`=$id");
					if($empty_dynamic) $this->DB_master->update($this->table_menu,array('dynamic_url'=>$dynamic_url),"`id`=$id");
				}
			}else{
				if($arr['dynamic_url']){					
					if($arr['dynamic_url'] == '{$system_url}'){
						$url = $domain;
						if(empty($this->system->site['ipordomain']) && substr($this->system->domain,0,7) == '/s.php/'){
							$url = rtrim($this->core->CONFIG['resource_url'] ? $this->core->CONFIG['resource_url'] : $this->core->url,'/').'/'.'sites/html/'.$site;
						}
						if($this->system->site['config']['menu_mode'] ==1) $url = str_replace($domain.'/','',$url);
						if($this->system->site['config']['menu_mode'] ==2) $url = str_replace('/sites/html/','/',$url);					
						$this->DB_master->update($this->table_menu,array('url'=>$url,'dynamic_url'=>'{$system_url}'),"`id`=$id");
					}else{
						//$this->DB_master->update($this->table_menu,array('dynamic_url'=>'url'),"`id`=$id",false);
						$item_module = $this->system->load_module('item');
						$data['url'] = $arr['dynamic_url'];
						$data['is_category'] = false;
						$url = $this->system->site_p8_url($item_module,$data);				
						$system_url = $this->system->get_site_domain($site);
						$system_controller = $this->system->get_site_controller($site);
						$url = str_replace(array('{$system_url}','{$system_controller}','{$site_domain}'),array($system_url, $system_controller,$system_url),$url, $this->system->CONFIG['domain']);
						if(!strpos($url,'.php')){
							if($this->system->site['config']['menu_mode'] ==1) $url = str_replace($domain.'/','',$url);
							if($this->system->site['config']['menu_mode'] ==2) $url = str_replace('/sites/html/','/',$url);
							if($url) $this->DB_master->update($this->table_menu,array('url'=>$url),"`id`=$id");
						}
					}
				}else{
					if($arr['url'] == '{$system_url}'){
						$this->DB_master->update($this->table_menu,array('url'=>$domain,'dynamic_url'=>'{$system_url}'),"`id`=$id");
					}else{
						$this->DB_master->update($this->table_menu,array('dynamic_url'=>'url'),"`id`=$id",false);
					}
				}
			}
		}
	}else{
		$this->DB_master->update($this->table_menu,array('url'=>'dynamic_url'),"site='$site' and dynamic_url != ''",false);
	}
}

function menu_html($site='',$menu = array()){
	if(empty($site)) return $menu;
	foreach($menu as $key=>$val){		
		//menus
		if(isset($val['menus']) && !empty($val['menus'])){
			$menu[$key]['menus'] = $this->menu_html($val['site'],$val['menus']);
		}
	}
	return $menu;
}

function menu_jump($this_url,$message = '',$this_site = '',$site = '',$offset = 0,$step = 'init'){
	$form = <<<FORM
$message
<form action="$this_url" method="post" id="form">
<input type="hidden" name="start" value="1" />
<input type="hidden" name="this_site" value="{$this_site}" />
<input type="hidden" name="offset" value="{$offset}" />
<input type="hidden" name="site" value="{$site}" />
<input type="hidden" name="step" value="{$step}" />
</form>
<script type="text/javascript">
document.getElementById('form').submit();
</script>
FORM;
	message($form);
}

function menu_cache($site=''){
	if($site)
		$sites = array($site=>$site);
	else	
		$sites  = $this->system->get_sites();

	foreach($sites as $site=>$sitedata){
		//如果有静态，以静态优先
		$menu = $this->menu_html($site,$this->get_menu($site, true ,false));
		//$menu = $this->get_menu($site, true ,false);
		if(!is_dir(CACHE_PATH.$this->system->name.'/menu'))mkdir(CACHE_PATH.$this->system->name.'/menu');
        $this->core->CACHE->write($this->system->name.'/menu', $site,'', $menu);
	}	
}
function init_site($site,$init){
    $init_site = $this->get_site($init);
    $mapdata = $this->core->CACHE->read($this->system->name .'/modules/category/', $site, 'map');
    
    if($init_site['data2']){
        $data2 = mb_unserialize($init_site['data2']);
        $map = $data2['map'];
        foreach($map as $k=>$v){
            if(isset($mapdata[$v]))
                $map[$k] = $mapdata[$v];
        }
        $data2['map'] = $map;
        $init_site['data2'] = serialize($data2);
    }
    
    $status = $this->DB_master->update(
		$this->table,
		$this->DB_master->escape_string(array(
            'template'=>$init_site['template'],
            'config'=>$init_site['config'],
            'data1'=>$init_site['data1'],
            'data2'=>$init_site['data2'],
            'data3'=>$init_site['data3'],
            )),
		"alias='$site'"
	);
}

function init_menu($site,$init){
    $data = $this->get_menu($init, false);
    
    foreach($data as $menu){
       $pid = $this->ex_init_menu($menu, $site,$init);
       if(!empty($menu['menus'])){
            foreach($menu['menus'] as $m){
                $m['parent'] = $pid;
                $this->ex_init_menu($m, $site, $init);
            }
       }
    
    }
}
function ex_init_menu($data, $site, $init){
    $oldurl = $this->system->get_site_domain($init);
    $newurl = $this->system->get_site_domain($site);
    $url = preg_replace_callback('/category-(\d+)/',array(&$this,'chcid'),$data['url']);
    $url = str_replace($oldurl,$newurl,$url);
    if(strpos($url,'s.php'))$url = str_replace('/index.php','',$url);
    return $this->add_menu(
            array(
                'name' => $data['name'],
                'parent' => $data['parent'],
                'site' => $site,
                'color' => $data['color'],
                'url' => $url,
                'target' => $data['target'],
                'display' => $data['display'],
                'display_order' => $data['display_order']
            )
        );
}
function chcid($m){
    
    if(!empty($m[1])){
        $mapdata = $this->core->CACHE->read($this->system->name .'/modules/category/', $this->system->SITE, 'map');
        if(!empty($mapdata[$m[1]]))
                return str_replace($m[1],$mapdata[$m[1]],$m[0]);
    }
    return $m[0];
}
function init_site_category($site, $categories, $parent=0){
     $category= &$this->system->load_module('category');
     $controller = $this->core->controller($category);
    foreach($categories as $ocid=>$codata){
		
		$cdata = $this->DB_master->fetch_one("SELECT * FROM {$category->table} WHERE id=$ocid");
		
        $POST = array(
            'name'=>html_entities($cdata['name']),
            'type'=>$cdata['type'],
            'url'=>$cdata['type']==3?$cdata['url']:'',
            'parent'=>$cdata['parent']?$parent:0,
            'model'=>$cdata['model'],
            'matrix'=>$cdata['matrix'],
            'config'=>mb_unserialize($cdata['config']),
            'path'=>$cdata['path'],
            'display_order'=>$cdata['display_order'],
            'label_postfix'=>$cdata['label_postfix'],
            'list_template'=>$cdata['list_template'],
            'view_template'=>$cdata['view_template'],
            'item_template'=>$cdata['item_template'],
            'html_list_url_rule'=>$cdata['html_list_url_rule'],
            'html_view_url_rule'=>$cdata['html_view_url_rule'],
            'frame'=>$cdata['frame'],
            'page_size'=>$cdata['page_size'],
            'seo_keywords'=>$cdata['seo_keywords'],
            'seo_description'=>$cdata['seo_description'],
            'site'=>$site
        );
        $ncid = $controller->add($POST);
        if($mapdata = $this->core->CACHE->read($this->system->name .'/modules/category/', $site, 'map')){
            $mapdata[$ocid] = $ncid;
           
        }else{
             $mapdata = array($ocid=>$ncid);
        }
        $this->core->CACHE->write($this->system->name .'/modules/category/', $site, 'map', $mapdata);
        
        if(!empty($codata['categories'])){
            $this->init_site_category($site, $codata['categories'], $ncid);
        }
    }

}
function init_site_label($site, $init){
    $label= &$this->core->load_module('label');
    $mapdata = $this->core->CACHE->read($this->system->name .'/modules/category/', $site, 'map');
    $query = $this->DB_master->query("SELECT * FROM {$label->table} WHERE site='$init'");
    while($arr = $this->DB_master->fetch_array($query)){
        unset($arr['id']);
        $arr['site'] = $site;
        if(strpos($arr['postfix'],'category')!==false){
            $cid = substr($arr['postfix'],strpos($arr['postfix'],'_')+1);
            if(!empty($mapdata[$cid]))
                $arr['postfix'] = 'category_'.$mapdata[$cid];
        }
        
        $option= mb_unserialize($arr['option']);
        if(!empty($option['category'])){
            $cids = $option['category'];
            foreach($cids as $k=>$cid){
                $cids[$k]= empty($mapdata[$cid])?$cid:$mapdata[$cid];
            }
            $option['category'] = $cids;
        }
        $arr['option']= serialize($option);
        $this->DB_master->insert(
            $label->table,
            $this->DB_master->escape_string($arr)
        );
	}
    $label->cache();
	$label->cache_data();
}

function init_site_item($site, $init){
    global $USERNAME;
	$item = &$this->system->load_module('item');
	$category = &$this->system->load_module('category');
	$category->get_cache();
	$controller = &$this->core->controller($item);
    $mapdata = $this->core->CACHE->read($this->system->name .'/modules/category/', $site, 'map');
    
    $query = $this->DB_master->query("SELECT id,cid,model FROM {$item->main_table} WHERE site='$init'");
	
	$data = array();
	$i = 0;
	$newids= array();
	while($arr = $this->DB_slave->fetch_array($query)){
        $cid = !empty($mapdata[$arr['cid']])?$mapdata[$arr['cid']]:0;
        if(!$cid)continue;
		$model = $this->system->get_model($arr['model']);
		$_REQUEST['model'] = $arr['model'];
		$this->system->init_model();
		$item->set_model($arr['model']);
		
		$data[$i] = $this->DB_slave->fetch_one("SELECT * FROM $item->table AS i INNER JOIN $item->addon_table AS a ON i.id = a.iid WHERE i.id = '$arr[id]' AND page = '1'");
		
		$data[$i]['client_item_id'] = $arr['id'];
		$data[$i]['cid'] = $cid;
		$data[$i]['model'] = $arr['model'];
		$data[$i]['frame'] = attachment_url($data[$i]['frame']);
		$data[$i]['comments'] = 0;
		$data[$i]['views'] = 0;
		$data[$i]['level'] = 0;
		$data[$i]['vid'] = 0;
		$data[$i]['attributes'] = $data[$i]['frame'] ? 6 : '';
		$data[$i]['action'] = 'add';
		$data[$i]['timestamp'] = date('Y-m-d H:i:s',$data[$i]['timestamp']);
		$item->format_data($data[$i]);
		
		foreach($model['fields'] as $field => $field_data){
			
			//引用
			$data[$i]['field#'][$field] = &$data[$i][$field];
			//$data[$i]['field#'][$field] = &$data[$i][$field];
			//unset($data[$i][$field]);
		}
		
		unset($data[$i]['label_postfix']);
		
		//追加数据
		$_query = $this->DB_slave->query("SELECT * FROM $item->addon_table WHERE iid = '$arr[id]' AND page != '1' ORDER BY page ASC");
		$j = 0;
		while($addon = $this->DB_slave->fetch_array($_query)){
			unset($addon['id'], $addon['iid'], $addon['page']);
			$data[$i]['addon'][$j] = $addon;
			
			$item->format_data($data[$i]['addon'][$j]);
			
			foreach($model['fields'] as $field => $field_data){
				if(!isset($addon[$field])) continue;
				
				//引用
				$data[$i]['addon'][$j]['field#'][$field] = &$data[$i]['addon'][$j][$field];
			}
			
			$j++;
		}
		
		if($controller->check_category_action('autoverify', $cid)){
			$data[$i]['verify'] = 1;
			$data[$i]['verifier'] = $USERNAME;
		}
		unset($data[$i]['list_order']);
		
		if($newid = $controller->add($data[$i])){
			$newids[] = $newid;
			//追加
			if(!empty($data[$i]['addon'])){
				foreach($data[$i]['addon'] as $vv){
					$vv['iid'] = $newid;
					$controller->addon($vv);
				}
			}
		}
		$i++;
	}

}

function table_status($table = ''){
	$prefix = $this->system->TABLE_;
	$tables = array(
		$prefix.'category'=>0,
		$prefix.'item'=>0,
		$prefix.'letter_data'=>0,
		$prefix.'letter_department'=>0,
		$prefix.'letter_type'=>0,
		$prefix.'letter_item'=>0,
		$prefix.'menu'=>0
	);
	
	$model = $this->system->get_models();
	$sql = '';
	foreach($model as $key=>$val){
		$tables[$prefix.'item_'.$key.'_']=0;
		$tables[$prefix.'item_'.$key.'_addon']=0;
	}
	
	foreach($tables as $table=>$cc){
		$sql = "SELECT COUNT(*) as c FROM $table WHERE site='{$this->system->SITE}'";
		$result = $this->DB_master->fetch_one($sql);
		if($result['c'])
			$tables[$table] = $result['c'];
		else
			unset($tables[$table]);
	}
	
	return $tables;
}


/**
* 备份
* @param string $table 表名
* @param int $rows 行数
* @param int $offset 偏移
* @param string $charset 字符集
**/
function backup($table, $param = array('rows' => 1000, 'offset' => 0, 'charset' => '', 'prefix' => '')){
	
	$new_table = empty($param['prefix']) ? $table : str_replace($this->core->CONFIG['table_prefix'], $param['prefix'], $table);
	
	$ret = array('sql' => 'REPLACE INTO `'. $new_table.'`' );
	
	$primary = isset($param['primary']) ? $param['primary'] : '';

	$sql = "SELECT * FROM `$table` WHERE site='$param[site]' LIMIT $param[offset],$param[rows]";

	$ret['_sql'] = $sql;
	$query = $this->DB_master->query($sql);
	
	$i = 0;
	$comma = $files= $sqls ='';
	$charset = !empty($param['charset']) && $param['charset'] != $this->core->CONFIG['page_charset'] ? $param['charset'] : '';
	while($data = $this->DB_master->fetch_array($query)){
		$datas = $comma2 = $files='';
		
		foreach($data as $file =>$v){
			if($charset){
				//不解释,你懂的
				if(preg_match('/^a:\d+:\{/', $v)){
					if(($_v = mb_unserialize($v)) !== false){
						//really unserializable
						$v = serialize(convert_encode($this->core->CONFIG['page_charset'], $charset, $_v));
						unset($_v);
					}
				}else{
					$v = convert_encode($this->core->CONFIG['page_charset'], $charset, $v);
				}
			}
			
			$v = $this->DB_master->escape_string($v);
			$files .= "$comma2`$file`";
			$datas .= "$comma2'$v'";
			$comma2 = ',';
		}
		
		$sqls .= "$comma($datas)";
		
		$comma = ',';
		$i++;
	}
	$ret['sql'] .=  '('.$files .')'.' VALUES '.$sqls;
	$this->DB_master->free_result($query);
	
	$ret['sql'] = $i ? $ret['sql'] .= ";\r\n" : '';
	return $ret;
}

/*
自定义菜单
*/
function add_custom_menu($data){
	$id = $this->DB_master->insert(
		$this->table_menu_custom,
		$this->DB_master->escape_string($data),
		array('return_id' => true)
	);
	$this->menu_custom_cache($this->system->SITE);
	return $id;

}
function get_custom_menu($site, $format=true, $all=true){
	$where = $all? '':' AND display=1';
	$sql = "SELECT * FROM {$this->table_menu_custom} WHERE site='$site' $where ORDER BY display_order DESC";
	$query = $this->DB_master->query($sql);
	$menus = array();
	$sadmin_controller = $this->system->admin_controller;
	$U_controller = $this->core->U_controller;
	$cadmin_controller = $this->core->controller;
	while($row=$this->DB_master->fetch_array($query)){
		$format && $row['url'] = str_replace(array('{$U_controller}','{$sadmin_controller}','{$cadmin_controller}'),array($U_controller,$sadmin_controller,$cadmin_controller),$row['url']);
		$menus[$row['id']] = $row;
	}
	return $menus;
}

function delete_custom_menu($id){	
	$this->DB_master->delete($this->table_menu_custom, "id IN ($id)");
	$this->menu_custom_cache($this->system->SITE);
	return array($id);
}
function menu_custom_cache($site){
	$menu = $this->get_custom_menu($site, true ,false);
	if(!is_dir(CACHE_PATH.$this->system->name.'/menu_custom'))mkdir(CACHE_PATH.$this->system->name.'/menu_custom');
	$this->core->CACHE->write($this->system->name.'/menu_custom', $this->system->SITE,'', $menu);	
}

//本站管理菜单
function get_menu_nav($site,$format=true, $all=true){
	$where = $all? '':' and display=1';
	$sql = "SELECT * FROM {$this->table_menu_nav} WHERE site='$site' $where ORDER BY display_order DESC";
	$query = $this->DB_master->query($sql);
	$menus = array();
	$system_url = $this->system->get_site_domain($this->SITE);
	$system_controller = $this->system->get_site_controller($this->SITE);
	$sadmin_controller = $this->system->admin_controller;
	$U_controller = $this->core->U_controller;
	$cadmin_controller = $this->core->controller;
	while($row=$this->DB_master->fetch_array($query)){
		$format && $row['url'] = str_replace(array('{$U_controller}','{$sadmin_controller}','{$cadmin_controller}','{$system_url}','{$site_domain}','{$system_controller}'),array($U_controller,$sadmin_controller,$cadmin_controller,$system_controller,$system_url,$system_controller),$row['url']);
		$menus[$row['id']] = $row;
	}
	foreach($menus as $mid=>$md){
		if($md['parent']){
			$menus[$md['parent']]['menus'][$mid] = $md;
			unset($menus[$mid]);
		}	
	}
	return $menus;
}

function menu_nav_cache($site){
	$menu = $this->get_menu_nav($site,true ,false);
	if(!is_dir(CACHE_PATH.$this->system->name.'/menu_nav'))mkdir(CACHE_PATH.$this->system->name.'/menu_nav');
    $this->core->CACHE->write($this->system->name.'/menu_nav', $site,'', $menu);
}

function add_menu_nav($data){
	$id = $this->DB_master->insert(
		$this->table_menu_nav,
		$this->DB_master->escape_string($data),
		array('return_id' => true)
	);
	$this->menu_cache();
	return $id;
}

function delete_menu_nav($id){	
	$cids = $this->get_children_ids_nav($id);
	array_unshift($cids, $id);
	
	$ids = implode(',', $cids);
	
	$this->DB_master->delete($this->table_menu_nav, "id IN ($ids)");
	$this->menu_nav_cache($this->system->SITE);
	return $cids;
}

function get_children_ids_nav($id){
	$menus = $this->get_menu_nav($this->system->SITE,false);
	if(empty($menus[$id]['menus'])) return array();
	
	$ids = array();
	foreach($menus[$id]['menus'] as $v){
		$ids[$v['id']] = $v['id'];
		if(isset($v['menus']))
			$ids = $ids + $this->get_children_ids_nav($v['id']);
	}
	
	return $ids;
}

}
