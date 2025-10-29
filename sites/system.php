<?php
defined('PHP168_PATH') or die();

class P8_Sites extends P8_System{

var $_models;	//单个模型的数组
var $models;	//全部模型
var $model;		//当前模型
var $MODEL;		//当前模型名称

var $_sites;
var $sites;	//全部站点
var $site;		//当前站点
var $SITE;		//当前站点名称
var $domain;		//当前站点名称
var $controller;		//当前站点名称
var $siteurl;		//当前站点名称
var $suv;		//当前站点名称序列

var $is_main_verifier;
var $is_category_verifier;
var $is_guest;
var $item_table;
var $category_table;
var $table_menu;
var $table_menu_user;
var $log_table;
var $_category;
var $index_files;

function __construct(&$core, $name){
	$this->core = &$core;
	parent::__construct($name);
	
	$this->is_category_verifier = array();
	$this->is_main_verifier = false;
	$this->is_guest = false;
	$this->_models = $this->_category = array();
	$this->index_files = array(
		1 => 'index.html',
		2 => 'index.shtml',
		3 => 'index.htm',
	);
	
	$this->log_table = $this->TABLE_ .'log';
	$this->item_table = $this->TABLE_ .'item';
	$this->category_table = $this->TABLE_ .'category';
	$this->table_menu = $this->TABLE_ .'menu_quick';
	$this->table_menu_user = $this->TABLE_ .'menu_user';
	$this->site_table = $this->TABLE_ .'site';
    $this->sites = $this->get_sites();
	$this->init_site();
	
}


function init_site($name='',$set=true){
    $key = defined('P8_ADMIN')?'admin_site':'site';
   
	if(!empty($name))
		$SITE = $name;
	elseif(!empty($_POST['site'])){
		$SITE =  basename($_POST['site']);
	}
	elseif(!empty($_GET['site'])){
		$SITE =  basename($_GET['site']);
	}
	elseif(get_cookie($key)!==null){
		$SITE =  basename(get_cookie($key));
	}
	else{
		$SITE = '';
	}

	if($SITE){
		if($set)set_cookie($key,$SITE,0);
		$this->site = &$this->get_site($SITE);
		if($this->site){
			$this->SITE = $SITE;
			$this->suv = md5($SITE);
			$this->domain = $this->get_site_domain($SITE);
			$this->controller = $this->get_site_controller($SITE);
			$this->siteurl = $this->core->CONFIG['url'].'/s.php/'.$SITE;
			$base_domain = substr_count($this->domain, '.') > 1 ? substr($this->domain, strpos($this->domain, '.') +1) : $this->domain;
			$this->CONFIG['base_domain']=$base_domain;
		}
	}
}
function load_site($name){
	$sdata = $this->get_site($name);
	if(!$sdata)return null;
	$this->init_site($name);
	return $this->site;

}
function &get_site($name){
	if(!$name)return array();
    $ret = array();
	if(isset($this->sites[$name])){
		$ret = $this->core->CACHE->read($this->name .'/modules', 'farm', $name);
	}
    return $ret;
}

function get_sites(){
	if(empty($this->sites)){
		
		$this->sites = $this->core->CACHE->read($this->name .'/modules', 'farm', 'all');
	}
	if(empty($this->sites) && $this->modules['farm']['installed']){
		
		$farm = &$this->load_module('farm');
		$farm->cache();
		$this->sites = $this->core->CACHE->read($this->name .'/modules', 'farm', 'all');
	}
	return $this->sites;

}

function get_site_domain($name=''){
	if(!empty($name))
		$site = $this->get_site($name);
	else
		$site = $this->site;
		
	if(!empty($site['ipordomain']) && !empty($site['domain']))
		$link = $site['domain'];
	else
		$link = $this->core->CONFIG['url'].'/s.php/'.$site['alias'];
	
	return $link;
}

function get_site_controller($name=''){
	if(!empty($name))
		$site = $this->get_site($name);
	else
		$site = $this->site;
		
	if(!empty($site['ipordomain']) && !empty($site['domain']) && !defined('P8_MEMBER'))
		$link = preg_replace('/\/?$/','',$site['domain']).'/index.php';
	else
		$link = $this->core->CONFIG['url'].'/s.php/'.$site['alias'];
	
	return $link;
}


function site_p8_url($M, $data, $action = 'view', $first_page = true){
    if(empty($M->site['ipordomain']) && (((isset($data['#category']) && !empty($data['#category']['htmlize'])) or !empty($data['htmlize'])) or (defined('HTMLING') && HTMLING))){ 
        $M->system->url = rtrim($this->core->CONFIG['resource_url']?$this->core->CONFIG['resource_url']:$this->core->url,'/').'/'.$this->name.'/html/'.$this->site['alias'];
		$M->system->CONFIG['domain'] =  $M->system->url;
    }else{
        $M->system->url = $this->domain;
        $M->system->CONFIG['domain'] =  $this->domain;
    }
	return p8_url($M, $data, $action, $first_page);
}


function init_model(){
	global $MODEL, $this_model, $this_module;
	
	$MODEL = isset($_REQUEST['model']) ? basename($_REQUEST['model']) : '';
	$this->model = &$this->get_model($MODEL);
	if(empty($this->model)) return null;
	
	$this_model = $this->model;
	
	$this_model['path'] = $this->path .'model/'. $MODEL .'/';
	
	if(isset($this_module) && $this_module->name == 'item'){
		$this_module->set_model($MODEL);
		//加载语言包
		load_language($this_module, $MODEL);
	}
	
}

/**
* 取得sphinx索引
**/
function sphinx_indexes($models = array(), $with_delta = false){
	$_models = $this->get_models();
	if(empty($models))
		$models = $_models;
	
	//拼凑所有模型的索引
	$indexes = $comma = '';
	foreach($models as $model => $v){
		if(!$_models[$model]['enabled']) continue;
		
		$indexes .= $comma . $this->core->CONFIG['sphinx_prefix'] . $this->name .'-item-'. $model .
			($with_delta ? '; delta_'. $this->core->CONFIG['sphinx_prefix'] . $this->name .'-item-'. $model : '');
		
		$comma = '; ';
	}
	return $indexes;
}

/**
* 取得模型信息
**/
function &get_model($name){
	if(isset($this->_models[$name])){
		return $this->_models[$name];
	}
	
	$this->_models[$name] = $this->core->CACHE->read($this->name .'/modules', 'model', $name, 'serialize');
	return $this->_models[$name];
}

/**
* 取得所有模型, 仅仅是全部模型的摘要,只包含ID和名称
**/
function get_models(){
	if(empty($this->models)){
		
		$this->models = $this->core->CACHE->read($this->name .'/modules', 'model', 'models');
	}
	if(empty($this->models)){
		
		$Model = &$this->load_module('model');
		$Model->cache();
		$this->models = $this->core->CACHE->read($this->name .'/modules', 'model', 'models');
	}
	return $this->models;
}

/**
* 
**/
function &fetch_category($id, $refresh = false,$site = ''){
	$site = $site ? $site : $this->SITE;
	if(isset($this->_category[$id]) && !$refresh){
		return $this->_category[$id];
	}else{
		$this->_category[$id] = $this->core->CACHE->read($this->name .'/modules/category',$site, (int)$id, 'serialize');
		if(empty($this->_category[$id])){
			$category = &$this->load_module('category');
			$category->cache(false,true,array($id => $id),$site);
			$this->_category[$id] = $this->core->CACHE->read($this->name .'/modules/category',$site, (int)$id, 'serialize');	
		}
		return $this->_category[$id];
	}
}


function check_acl($action,$type){
	if(!in_array($type,array('check_admin_action','check_action')))return false;
	$controller=$this->core->controller($this);
	return $controller->$type($action);
}

function check_manager($action='',$fix=''){
	global $IS_FOUNDER;
	if($IS_FOUNDER) return true;
    $pfix = $fix?$fix:$this->SITE;
	$mysite= $this->get_manage_sites();
	if(!$mysite || !$pfix)return false;
	return in_array($pfix,$mysite);
}

function check_poster($action='',$fix=''){
    $pfix = $fix?$fix:$this->SITE;
    if(in_array($action,array('autoverify','delete','verify','move')))return false;
  //  if(in_array($action,array('view','list','search','comment')))return true;
	$mysite= $this->get_poster_site();
	if(!$mysite || !$pfix)return false;
	return in_array($pfix,$mysite);
}

function get_poster_site(){
	global $IS_FOUNDER, $UID,$ROLE;
	if($IS_FOUNDER){
		$sites = $this->get_sites();
		$mysites = array_keys($sites);
	}else{
		$manager = $this->core->CACHE->read($this->name, '', 'manager','serialize');
        $usites = !empty( $manager['poster'][$UID] )?$manager['poster'][$UID] : array();
        $rsites = !empty( $manager['role'][$ROLE] )?$manager['role'][$ROLE] : array();
        $mysites = array_unique (array_merge($usites,$rsites));
	}
	return $mysites;
}

function get_manage_sites($uid = 0){
	global $IS_FOUNDER, $UID,$ROLE;
	$sites = $this->get_sites();
	if($IS_FOUNDER){		
		$mysites = array_keys($sites);
	}else{
		$manager = $this->core->CACHE->read($this->name, '', 'manager','serialize');
		$UID = isset($uid) && !empty($uid) ? intval($uid) : $UID;
		$usites = !empty($manager['manager'][$UID] )?$manager['manager'][$UID] : array();
		foreach($sites as $site=>$site_info){
			$sites[$site_info['id']]['id'] = $site_info['id'];
			$sites[$site_info['id']]['alias'] = $site_info['alias'];			
			if($site_info['parent']) $sites[$site_info['parent']]['childs'][] = $site_info['id'];
		}
		foreach($usites as $mysite){
			$id = $sites[$mysite]['id'];
			foreach($sites[$id]['childs'] as $child){
				$usites[] = $sites[$child]['alias'];
			}			
		}
		$mysites = array_unique($usites);
	}
	return $mysites;
}
function check_suv(){
	$suv = isset($_POST['suv'])?$_POST['suv']:(isset($_GET['suv'])?$_GET['suv']:'');
	if($suv && $suv!=md5($this->SITE)){
		message('suv_error');
	}

}

function isfromsites(){
   global $HTTP_REFERER;
	$sites_flag = in_array('s.php',explode('/',$HTTP_REFERER)) ? true : false;
    if(!$sites_flag){
        $sites_flag = $this->check_domain($HTTP_REFERER);
    }
	return $sites_flag;
}
function check_domain($refer){
    $detail = parse_url($refer);
    $sites = $this->get_sites();

	foreach($sites as $key=>$site){
        if(strpos($site['domain'], $detail['host'])!==false or strpos($refer,'/'.$key.'/')!==false){
            return true;
        }
    }
    return false;
}


/**
* 日志
**/
function log($data){
	global $USERNAME;
	
	$data['ip'] = P8_IP;
	$data['timestamp'] = P8_TIME;
	$data['username'] = $USERNAME;
	$data['url'] = REQUEST_URI;
	$data['site'] = $this->SITE;
	$data['request'] = $this->DB_master->escape_string(var_export($data['request'], true));
	
	return $this->DB_master->insert(
		$this->log_table,
		$data
	);
}

/**
 * 禁止IP
 */
function stop_ip($config){
    if(empty($config['enabled'])){
        return;
    }

    //ip集合序列
    if(in_array(P8_IP,$config['forbidip'])){
        message('not_allow_ip');
    }

    //ip段
    if(!empty($config['beginip'])){

        $pos_begin = strrpos($config['beginip'], '.');
        $pos_end = strrpos($config['endip'], '.');
        $pos_user = strrpos(P8_IP, '.');

        $ippre_begin = ($pos_begin === false) ? '' : substr($config['beginip'], 0, $pos_begin) ;
        $ippre_end = ($pos_end === false) ? '' : substr($config['endip'], 0, $pos_end);
        $ippre_user = ($pos_user === false) ? '' : substr(P8_IP, 0, $pos_user);

        if(empty($ippre_user)){
            message('not_allow_ip');
        }

        if(!empty($ippre_begin) && !empty($ippre_end) && $ippre_begin == $ippre_end){

            if($ippre_end == $ippre_user && intval(substr(P8_IP, $pos_user+1)) >= intval(substr($config['beginip'], $pos_begin+1)) && intval(substr(P8_IP, $pos_user+1)) <= intval(substr($config['endip'], $pos_end+1))){
                message('not_allow_ip');
            }
        }
    }
}
/**
 * 允许IP
 */
function allow_ip($config){
    if(!isset($config['enabled']) || $config['enabled'] == 0){
        return true;
    }
    if($config['enabled'] == 2){
        return area_ip();
    }
    //ip集合序列
    if(in_array(P8_IP,$config['collectip'])){
        return true;
    }

    //ip段
    if(!empty($config['beginip']) && !empty($config['endip'])){

        $pos_begin = strrpos($config['beginip'], '.');
        $pos_end = strrpos($config['endip'], '.');
        $pos_user = strrpos(P8_IP, '.');

        $ippre_begin = ($pos_begin === false) ? '' : substr($config['beginip'], 0, $pos_begin) ;
        $ippre_end = ($pos_end === false) ? '' : substr($config['endip'], 0, $pos_end);
        $ippre_user = ($pos_user === false) ? '' : substr(P8_IP, 0, $pos_user);

        if(empty($ippre_user)){
            message('not_allow_ip');
        }

        if(!empty($ippre_begin) && !empty($ippre_end) && $ippre_begin == $ippre_end){

            if($ippre_end == $ippre_user && intval(substr(P8_IP, $pos_user+1)) >= intval(substr($config['beginip'], $pos_begin+1)) && intval(substr(P8_IP, $pos_user+1)) <= intval(substr($config['endip'], $pos_end+1))){
                //ip例外
                if($config['ruleoutip'] && in_array(P8_IP,$config['ruleoutip'])){
                    message('not_allow_ip');
                }else{
                    return true;
                }

            }else{
                message('not_allow_ip');
            }
        }
    }else{
        message('not_allow_ip');
    }
}

function get_menu($format=true, $all=true){
	$where = $all? 'display in (0,1)':'display=1';
	$sql = "SELECT * FROM {$this->table_menu} WHERE $where ORDER BY display_order DESC";
	$query = $this->DB_master->query($sql);
	$menus = array();
	$system_url = $this->get_site_domain($this->SITE);
	$system_controller = $this->get_site_controller($this->SITE);
	$sadmin_controller = $this->admin_controller;
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

function menu_cache(){
	$menu = $this->get_menu(true ,false);
	if(!is_dir(CACHE_PATH.$this->name.'/menu'))mkdir(CACHE_PATH.$this->name.'/menu');
	$this->core->CACHE->write($this->name.'/menu', '_index_menu_','', $menu);

}

function add_menu($data){
	$id = $this->DB_master->insert(
		$this->table_menu,
		$this->DB_master->escape_string($data),
		array('return_id' => true)
	);
	$this->menu_cache();
	return $id;
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
	$menus = $this->get_menu(false);
	if(empty($menus[$id]['menus'])) return array();
	
	$ids = array();
	foreach($menus[$id]['menus'] as $v){
		$ids[$v['id']] = $v['id'];
		if(isset($v['menus']))
			$ids = $ids + $this->get_children_ids($v['id']);
	}
	
	return $ids;
}

/*
用户个人菜单
*/
function add_menu_user($data){
	global $UID;
	$id = $this->DB_master->insert(
		$this->table_menu_user,
		$this->DB_master->escape_string($data),
		array('return_id' => true)
	);
	$this->menu_user_cache($UID);
	return $id;

}
function get_menu_user($uid, $format=true, $all=true){
	$where = $all? '':' AND display=1';
	$sql = "SELECT * FROM {$this->table_menu_user} WHERE uid='$uid' $where ORDER BY display_order DESC";
	$query = $this->DB_master->query($sql);
	$menus = array();
	$sadmin_controller = $this->admin_controller;
	$U_controller = $this->core->U_controller;
	$cadmin_controller = $this->core->controller;
	while($row=$this->DB_master->fetch_array($query)){
		$format && $row['url'] = str_replace(array('{$U_controller}','{$sadmin_controller}','{$cadmin_controller}'),array($U_controller,$sadmin_controller,$cadmin_controller),$row['url']);
		$menus[$row['id']] = $row;
	}
	return $menus;
}

function delete_menu_user($id){
	global $UID;
	$this->DB_master->delete($this->table_menu_user, "id IN ($id)");
	$this->menu_user_cache($UID);
	return array($id);
}
function menu_user_cache($uid){
	$menu = $this->get_menu_user($uid, true ,false);
	if(!is_dir(CACHE_PATH.$this->name.'/menu_user'))mkdir(CACHE_PATH.$this->name.'/menu_user');
	$this->core->CACHE->write($this->name.'/menu_user', $uid,'', $menu);	
}
}
