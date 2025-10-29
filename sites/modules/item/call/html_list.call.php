<?php
@set_time_limit(0);
@ignore_user_abort(false);
define('P8_GENERATE_HTML', true);
define('NO_ADMIN_LOG', true);
require_once PHP168_PATH .'inc/html.func.php';
global $this_model, $MODEL, $HTML_DATA;
foreach(array_keys($GLOBALS) as $v){
    global $$v;
}
$change_sites_flag = false;
$old_site = $this->system->SITE;
if($this->system->SITE != $this_site){
	$change_sites_flag = true;
	$this->system->load_site($this_site);
}
$__task__ = array();
$__perpage__ = isset($this->CONFIG['html_list_size'])?intval($this->CONFIG['html_list_size']):5;
if(!$__perpage__)return;
$__CAT__ = $this->system->fetch_category($dcid);
$__CAT__['is_category'] = true;
$model = $this->system->get_model($__CAT__['model']);
if(
    empty($__CAT__['htmlize']) || $__CAT__['htmlize'] == 2 ||
    ($__CAT__['type'] == 2 && !empty($model['filterable_fields']))
){
    return;
}
if($__CAT__['type'] == 1 && !$__CAT__['list_all_model']){
    $pages = 1;
}else{
    $_pages = ceil($__CAT__['item_count'] / $__CAT__['page_size']);
    $pages = $__task__['pages'] && $__task__['pages'] <= $_pages ?
        $__task__['pages'] :
        $_pages;
}
$pages = max($pages, 1);
$__task__['current_category_page'] = 1;
$__task__['current_category_pages'] = $pages;
$this_module = &$this->system->load_module('item');
//############## 强制生成列表最后一页 ###############{
if($_pages>$__perpage__){
	$__page__ = $page = $_pages;
	$__CAT__['html_list_url_rule'] = str_replace('"', '', $__CAT__['html_list_url_rule']);
	$_system_path = $this_module->system->path;
	$this_module->system->path = $_system_path. 'html/'.$this_module->system->SITE.'/';
	$__file__ = p8_html_url($this_module, $__CAT__, 'list', false);
	$this_module->system->path = $_system_path;	
	if($__file__){
		$this_module->_html['basename'] = basename($__file__);
		$this_module->_html['path'] = str_replace($this_module->_html['basename'], '', $__file__);
		$this_module->_html['path'] = str_replace('//','/',$this_module->_html['path']);
		$page_file = preg_replace('/#([^#]+)#/', '\1', $__file__);
		$no_page = preg_replace('/#([^#]+)#/', '', $__file__);
		$this_module->_html['file'] = str_replace('?page?', $page, $page_file);
		$__list_uri__ = '/s.php/'. $this_module->system->SITE .'/item-list-category-{$dcid}-page-{$page}';
		eval('$_SERVER[\'_REQUEST_URI\'] = "'. $__list_uri__ .'";');
		ob_start();
		require PHP168_PATH .'s.php';
		$__content__ = ob_get_clean();
		md($this_module->_html['path']);
		$this_module->_html['file'] = str_replace('//','/',$this_module->_html['file']);
		if(!write_file($this_module->_html['file'], $__content__)){
			@chmod($this_module->_html['path'], 0755);
			@chmod($this_module->_html['file'], 0644);
			if(!write_file($this_module->_html['file'], $__content__)){
				echo p8lang($P8LANG['sites_item_html_unwritable'], array($this_module->_html['file']));
				//message(p8lang($P8LANG['sites_item_html_unwritable'], array($this_module->_html['file'])));
			}
		}
		@chmod($this_module->_html['file'], 0644);
	}
}
//############## 强制生成列表最后一页 ###############}

for($__i__ = 0; $__i__ < $__perpage__; $__i__++){
	if(++$__count__ > $__perpage__) break;
	$__page__ = $page = $__task__['current_category_page'] + $__i__;	
	$__CAT__['html_list_url_rule'] = str_replace('"', '', $__CAT__['html_list_url_rule']);
	$_system_path = $this_module->system->path;
	$this_module->system->path = $_system_path. 'html/'.$this_module->system->SITE.'/';
	$__file__ = p8_html_url($this_module, $__CAT__, 'list', false);
	$this_module->system->path = $_system_path;	
	if($__file__){
		$this_module->_html['basename'] = basename($__file__);
		$this_module->_html['path'] = str_replace($this_module->_html['basename'], '', $__file__);
		$this_module->_html['path'] = str_replace('//','/',$this_module->_html['path']);
		$page_file = preg_replace('/#([^#]+)#/', '\1', $__file__);
		$no_page = preg_replace('/#([^#]+)#/', '', $__file__);
		if($page == 1){
			if(preg_match('/^#.*\.(.*)#$/', $this_module->_html['basename'], $m)){
				$this_module->_html['file'] = $this_module->_html['path'] .'index.'. $m[1];
			}else{
				$this_module->_html['file'] = $no_page;
			}
		}else{
			$this_module->_html['file'] = str_replace('?page?', $page, $page_file);
		}
		$this_module->_html['file'] = str_replace('//','/',$this_module->_html['file']);		
		$_html_file = $this_module->_html['file'];
		$__list_uri__ = '/s.php/'. $this_module->system->SITE .'/item-list-category-{$dcid}-page-{$page}';
		eval('$_SERVER[\'_REQUEST_URI\'] = "'. $__list_uri__ .'";');
		ob_start();
		require PHP168_PATH .'s.php';
		$__content__ = ob_get_clean();
		md($this_module->_html['path']);		
		$_html_file = $this_module->_html['file'] ? $this_module->_html['file'] : $_html_file;
		if(!write_file($_html_file, $__content__)){
			@chmod($this_module->_html['path'], 0755);
			@chmod($this_module->_html['file'], 0644);
			if(!write_file($_html_file, $__content__)){
				echo p8lang($P8LANG['sites_item_html_unwritable'], array($this_module->_html['file']));
			}
			//message(p8lang($P8LANG['sites_item_html_unwritable'], array($this_module->_html['file'])));
		}
		@chmod($this_module->_html['file'], 0644);
	}
	if($__page__ >= $__task__['current_category_pages'])return;	
}
//回归
if($change_sites_flag) $this->system->load_site($old_site);
