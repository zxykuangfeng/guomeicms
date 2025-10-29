<?php
defined('PHP168_PATH') or die();

function cache_system_module($module_data_cache = false, $is_upload = false){
	global $core,$CACHE,$_ALLCACHE;
	//更新所有系统,模块配置
	$sm = array();

	$URI = [];

	md(CACHE_PATH .'core/modules/', true);
	//设置模块锁
	if($CACHE->read('', 'core', 'sm_cache_lock', 'serialize')){
	//	message('sm_caching_lock','',3, $core->admin_controller);
	}else{
		$_ALLCACHE = array('sm_offset' => 99);
		$core->CACHE->write('', 'core', 'sm_cache_lock', $_ALLCACHE, 'serialize');
	}
	//更新系统模块
	if(!$is_upload){
		foreach($core->list_systems(true) as $k => $v){
			if(!$v['installed'] || !$v['enabled']) continue;
			$s = &$core->load_system($k);
			md(CACHE_PATH . $k .'/modules/', true);
			$s->set_config(array(
				'table_prefix' => $v['table_prefix']
			));
			
			$sm[$k] = array(
				'name' => $s->name,
				'url' => $s->url,
				'controller' => $s->controller,
				'U_controller' => $s->U_controller,
				'alias' => $v['alias'],
				'class' => $v['class'],
				//系统表前缀,如果表前缀为空,自动补上当前表前缀
				'table_prefix' => empty($v['table_prefix']) ? P8_TABLE_ . $k .'_' : $v['table_prefix'] . $k .'_',
				'controller_class' => $v['controller_class'],
				'installed' => $v['installed'],
				'enabled' => $v['enabled'],
				'modules' => array()
			);
            $URI[$s->name][''] = [
                'url'=>$s->url,
                'controller'=>$s->controller,
                'U_controller'=>$s->U_controller
            ];

			foreach($s->list_modules(true) as $kk => $vv){
				if(!$vv['installed'] || !$vv['enabled']) continue;
				$m = &$s->load_module($kk);
				md(CACHE_PATH . $k .'/modules/'. $kk, true);
				
				if($module_data_cache && $vv['installed']){
					//是否也更新模块的数据缓存
					$m->set_config(array());
					$m->cache();
				}
				
				$sm[$k]['modules'][$kk] = array(
					'name' => $m->name,
					'url' => $m->url,
					'controller' => $m->controller,
					'U_controller' => $m->U_controller,
					'alias' => $vv['alias'],
					'class' => $vv['class'],
					'controller_class' => $vv['controller_class'],
					'installed' => $kk == 'item' ? true : $vv['installed'],
					'enabled' => $kk == 'item' ? true : $vv['enabled']
				);
                $URI[$s->name][$m->name]=[
                    'url'=>$m->url,
                    'controller'=>$m->controller,
                    'U_controller'=>$m->U_controller,
                ];
                
				$m = null;
			}

            
			//释放内存
			$core->unload($k);
		}
		$core->systems = $sm;

	}
	$cm = array();
	//更新核心模块配置
    $URI['core']['']=['url'=>$core->url, 'controller'=>$core->controller];
	foreach($core->list_modules(true) as $k => $v){
		if(!$v['installed'] || !$v['enabled']) continue;
		$m = &$core->load_module($k);
		md(CACHE_PATH .'core/modules/'. $k, true);
		
		if($module_data_cache && $v['installed']){
			//是否也更新模块的数据缓存
			$m->set_config(array());
			$m->cache();
		}
		
		$cm[$k] = array(
			'name' => $m->name,
			'url' => $m->url,
			'controller' => $m->controller,
			'U_controller' => $m->U_controller,
			'alias' => $v['alias'],
			'class' => $v['class'],
			'controller_class' => $v['controller_class'],
			'installed' => $v['installed'],
			'enabled' => $v['enabled']
		);
        $URI['core'][$m->name]=[
            'url'=>$m->url,
            'controller'=>$m->controller,
            'U_controller'=>$m->U_controller,
        ];
       
		$m = null;
	}
	$core->modules = $cm;


	//更新插件缓存
	if(!$is_upload){
		$ps = array();
		foreach($core->list_plugins(true) as $k => $v){
			//if(!$v['installed'] || !$v['enabled']) continue;
			$p = &$core->load_plugin($k);
			md(CACHE_PATH .'core/plugin/'. $v['name'], true);
			$p->set_config(array());
			
			$ps[$k] = array(
				'alias' => $v['alias'],
				'class' => $v['class'],
				'installed' => $v['installed'],
				'enabled' => $v['enabled']
			);
			
			if($v['installed'] && $v['enabled']){
				//$p->_cache();
			}
		}
	}
	$ps = !empty($ps) ? $ps : array();

	//更新核心缓存
	//if(!$is_upload){
	//	$core->set_config(array('modules' => $cm));
	//}else{	
		$need_modules = array('role','credit','member','uploader','crontab','label','message', 'pay', 'mail');
		if($sm && $cm){
			/*强势修正必要模块*/
			foreach($need_modules as $_module){
				if(!isset($cm[$_module]) || !$cm[$_module]['installed'] || !$cm[$_module]['enabled']){
					$cm[$_module] = array(
						'name' => isset($cm[$_module]['name']) ? $cm[$_module]['name'] : $_module,
						'url' => str_replace('/cms','/modules/'.$_module,$sm['cms']['url']).'modules/',
						'controller' => str_replace('/cms','/'.$_module,$sm['cms']['controller']),
						'U_controller' => str_replace('/cms','/'.$_module,$sm['cms']['U_controller']),
						'alias' => isset($cm[$_module]['alias']) ? $cm[$_module]['alias'] : $_module,
						'class' => isset($cm[$_module]['class']) ? $cm[$_module]['class'] : 'P8_'.$_module,
						'controller_class' => isset($cm[$_module]['controller_class']) ? $cm[$_module]['controller_class'] : 'P8_'.$_module.'_Controller',
						'installed' => true,
						'enabled' => true,
					);
				}
			}
			
			$core->set_config(array('system&module' => $sm, 'modules' => $cm, 'plugins' => $ps));
		}
	//}
	//解锁
	$CACHE->delete('', 'core', 'sm_cache_lock');
	if(!$is_upload){
		$config = $core->get_config('core', '');
		//JS配置
		$jsconfig = [
            'url'=>$config['url'],
            'RESOURCE'=>$core->RESOURCE ,
            'RESOURCE_VICE'=>$core->RESOURCE_VICE,
			'attachment_storate_type'=>$config['attachment_storate_type'],
            'language'=>$config['lang'],
            'controller'=>$core->controller,
            'U_controller'=>$core->U_controller,
            'attachment_url'=>$core->get_attachment_url(),
            'cookie_prefix'=>$config['cookie']['prefix'],
            'cookie_path'=>$config['cookie']['path'],
            'base_domain'=>$config['base_domain'],
            'mobile_status'=>intval($config['enable_mobile']),
            'mobile_auto_jump'=>intval($config['mobile_auto_jump']),
            'mobile_url'=>$config['murl'],
            'URI'=>$URI
        ];
		write_file(PHP168_PATH .'js/config.js', sprintf("var P8CONFIG='%s';",base64_encode(json_encode($jsconfig))));
	}
	rm(CACHE_PATH .'ips.php');
}

function cache_language(){
	global $core, $CACHE;
	
	//更新语言包
	$core->list_language(true);
	if($CACHE->memcache){
		$path = str_replace(PHP168_PATH, '', LANGUAGE_PATH);
		$CACHE->memcache_delete($path . $core->CONFIG['lang'] .'_loaded');
	}
}

function cache_cms_category(){
	global $core;
	$this_system = $core->load_system('cms');
	$this_module = $this_system->load_module('category');
	@set_time_limit(0);	
	$this_module->cache();	
}

function cache_word_filter(){
	global $core;
	
	$query = $core->DB_master->query("SELECT * FROM {$core->TABLE_}filter_word where `type` = 1");
	$filter = $comma = '';
	while($arr = $core->DB_master->fetch_array($query)){
		$filter .= $comma . $arr['filter_word'];
		$comma = '|';
	}
	$filter = $filter ? '/('. $filter .')/i' : '';
	
	$core->CACHE->write('', $core->name, 'word_filter', $filter);
}

function cache_word_scan(){
	global $core;
	
	$query = $core->DB_master->query("SELECT * FROM {$core->TABLE_}word_scan_filter where `type` = 1");
	$filter = $comma = '';
	while($arr = $core->DB_master->fetch_array($query)){
		$filter .= $comma . $arr['filter_word'];
		$comma = '|';
	}
	$filter = $filter ? '/('. $filter .')/i' : '';
	
	$core->CACHE->write('', $core->name, 'word_scan', $filter);
	
	$query = $DB_master->query("SELECT m.id,m.filter_word,m.aid,a.filter_word as right_word FROM `{$core->TABLE_}word_scan_filter` AS `m` LEFT JOIN `{$core->TABLE_}word_scan_filter` AS `a` ON a.aid = m.id WHERE m.type = '1'");
	$filter =  array();
	while($arr = $DB_master->fetch_array($query)){
		$filter['filter_word'][$arr['id']] = $arr['filter_word'];
		$filter['right_word'][$arr['id']] = $arr['right_word'];
	}
	$core->CACHE->write('', $core->name, 'word_scan_right', $filter);
}

function cache_template(){
	global $core;
	
	//更新模板缓存
	rm(CACHE_PATH .'template/', true);
	//更新模板
	$core->list_templates(true);
}

//更新菜单缓存
function cache_menu(){	
	cache_admin_menu();
	cache_member_menu();
	cache_homepage_menu();
	cache_cms_category();
	cache_navigation_menu();	
}

function cache_admin_menu(){
	global $admin_menu;
	
	require_once PHP168_PATH .'admin/inc/menu.class.php';
	$admin_menu->cache();
}

function cache_member_menu(){
	global $member_menu;
	
	require_once PHP168_PATH .'modules/member/inc/menu.class.php';
	$member_menu->cache();
}

function cache_homepage_menu(){
	global $homepage_menu;
	
	require_once PHP168_PATH .'inc/homepage_menu.class.php';
	$homepage_menu->cache();
}

function cache_navigation_menu(){
	global $navigation_menu;
	
	require_once PHP168_PATH .'admin/inc/navigation_menu.class.php';
	$navigation_menu->cache();
}

function cache_label(){
	global $core;
	
	$LABEL = &$core->load_module('label');
	$LABEL->cache();
	$LABEL->cache_data();
}

function cache_all(){
	
	cache_system_module(true);
	cache_language();
	cache_template();
	cache_word_filter();
	cache_label();
	cache_menu();
}

/**
* 清除页面缓存
**/
function clear_page_cache(){
	global $core;
	$core->DB_master->query("TRUNCATE TABLE {$core->TABLE_}pagecache");
}
