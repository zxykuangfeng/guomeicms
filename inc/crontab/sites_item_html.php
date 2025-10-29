<?php
defined('PHP168_PATH') or die();

/**
* 最近1篇内容页静态
**/
$systems = $core->list_systems();
if(isset($systems['sites']) && $systems['sites']['enabled']){
	$sites = $core->load_system('sites');
	$sites_item_module = $sites->load_module('item');
	if($sites->SITE){
		$site = $sites->SITE;
		$query = "SELECT `id`,`cid` FROM $sites_item_module->main_table where `site` = '$site' ORDER BY `timestamp` desc";
		$row = $core->DB_master->fetch_one($query);
		$_id = $row['id'];		
		$item_data = $sites_item_module->data('read', $_id);
		$item_data['#category'] = $sites->fetch_category($item_data['cid']);
		$static_view_url = $sites->site_p8_url($sites_item_module, $item_data, 'view');
		if(strpos($static_view_url, '/s.php/') === false && strpos($static_view_url, '/sites/html/')) {
			$file = PHP168_PATH.strstr($static_view_url, 'sites/html/');
			if(!file_exists($file)) {
				$query = $core->DB_master->query("SELECT * FROM $sites_item_module->main_table WHERE id = '$_id'");
				//定义生成静态的常量
				defined('P8_GENERATE_HTML') or define('P8_GENERATE_HTML', true);
				
				require_once PHP168_PATH .'inc/html.func.php';
				$_GET['model'] = $row['model'];
				$sites->init_model();
				global $this_model, $MODEL, $HTML_DATA;
				foreach(array_keys($GLOBALS) as $v){
					global $$v;
				}
				$sites->load_site($sites->SITE);
				$category = &$sites->load_module('category');
				$lan_date_enable = isset($sites_item_module->CONFIG['lan_date_enable']) && $sites_item_module->CONFIG['lan_date_enable'] ? true : false;
				$lan_date_timestamp = isset($sites_item_module->CONFIG['lan_date']) && $sites_item_module->CONFIG['lan_date'] ? intval($sites_item_module->CONFIG['lan_date']) : 0;
				$lan_category = isset($sites->site['config']['lan_category']) && $sites->site['config']['lan_category'] ? explode(',',$sites->site['config']['lan_category']) : array();
				$lan_category = array_filter($lan_category);
				$this_module = &$sites->load_module('item');
				//变量尽可能怪异,防止冲突
				$__models__ = $__datas__ = array();
				while($__arr__ = $core->DB_master->fetch_array($query)){
					//设置有跳转的跳过
					if(!empty($HTML_DATA['url'])) continue;
					//限局域网的跳过
					if($lan_date_enable && $lan_date_timestamp && $__arr__['timestamp']<=$lan_date_timestamp  && !in_array($__arr__['cid'],$lan_category)) continue;		
					$__models__[$__arr__['model']][] = $__arr__['id'];
					unset($__arr__['custom_a'],$__arr__['custom_b'],$__arr__['custom_c'],$__arr__['custom_d'],$__arr__['custom_e']);
					unset($__arr__['custom_f'],$__arr__['custom_g'],$__arr__['custom_h'],$__arr__['custom_i'],$__arr__['custom_j']);
					$__datas__[$__arr__['id']] = $__arr__;
				}
				
				foreach($__models__ as $__model__ => $__ids__){
					if(! ($__ids__ = implode(',', filter_int($__ids__))) ) continue;
					$sites_item_module->set_model($__model__);
					
					$sites_item_module->_html['query'] = $core->DB_slave->query("SELECT i.*, a.*, i.timestamp AS timestamp, a.iid AS id FROM $sites_item_module->table AS i
						INNER JOIN $sites_item_module->addon_table AS a ON i.id = a.iid
						WHERE i.id IN ($__ids__) AND a.page = 1");
					
					while($__arr__ = $core->DB_slave->fetch_array($sites_item_module->_html['query'])){
						$HTML_DATA = array_merge($__arr__, $__datas__[$__arr__['id']]);
						
						$__CAT__ = &$sites->fetch_category($HTML_DATA['cid']);
						//如果分类不是生成静态的
						if(empty($__CAT__['htmlize'])) continue;
						//限局域网的跳过
						if($lan_date_enable && $lan_date_timestamp && $__arr__['timestamp']<=$lan_date_timestamp  && !in_array($__arr__['cid'],$lan_category)) continue;
						$HTML_DATA['#category'] = &$__CAT__;
						$id = $HTML_DATA['id'];
						
						//很危险的啦,你懂的啦
						$__CAT__['html_view_url_rule'] = str_replace('"', '', $__CAT__['html_view_url_rule']);
						
						//取得要生成文件的绝对路径
						$_system_path = $sites_item_module->system->path;
						$sites->path = $_system_path. 'html/'.$sites_item_module->system->SITE.'/';
						$__tmp_file__ = p8_html_url($sites_item_module, $HTML_DATA, 'view', false);
						$sites->path = $_system_path;
						
						if(!$__tmp_file__) continue;
						$sites_item_module->_html['basename'] = basename($__tmp_file__);
						//取路径
						$sites_item_module->_html['path'] = str_replace($sites_item_module->_html['basename'], '', $__tmp_file__);
						//分页文件
						$sites_item_module->_html['page_file'] = preg_replace('/#([^#]+)#/', '\1', $__tmp_file__);
						//无分页的文件
						$sites_item_module->_html['no_page'] = preg_replace('/#([^#]+)#/', '', $__tmp_file__);
											
						if($HTML_DATA['pages'] > 1){
							$sites_item_module->_html['datas'] = array();
							$sites_item_module->_html['_query'] = $core->DB_slave->query("SELECT i.*, a.*, i.timestamp AS timestamp, a.iid AS id FROM $sites_item_module->table AS i
								INNER JOIN $sites_item_module->addon_table AS a ON i.id = a.iid
								WHERE i.id = '$id' ORDER BY a.page ASC LIMIT 1,$HTML_DATA[pages]");
							
							$__i__ = 2;
							while($___arr__ = $core->DB_slave->fetch_array($sites_item_module->_html['_query'])){
								$sites_item_module->_html['datas'][$__i__++] = array_merge($___arr__, $__datas__[$___arr__['id']]);
							}
						}
						
						//生成内容分页
						$__pages__ = $HTML_DATA['pages'];
						for($__i__ = 1; $__i__ <= $__pages__; $__i__++){
							$__view_uri__ = '/s.php/'. $sites->SITE .'/item-view-id-{$id}-page-{$page}';
							
							if($__i__ > 1) $HTML_DATA = $sites_item_module->_html['datas'][$__i__];
							
							$page = $__i__;
							if($page == 1){
								$sites_item_module->_html['file'] = $sites_item_module->_html['no_page'];
							}else{
								$sites_item_module->_html['file'] = str_replace('?page?', $page, $sites_item_module->_html['page_file']);
							}
							
							//更改REQUEST_URI
							eval('$_SERVER[\'_REQUEST_URI\'] = "'. $__view_uri__ .'";');
							//echo $_SERVER['_REQUEST_URI'];exit;
							ob_start();
							require PHP168_PATH .'s.php';
							$__content__ = ob_get_clean();
							
							//创建文件夹
							md($sites_item_module->_html['path']);
							//生成文件
							$sites_item_module->_html['file'] = valid_path($sites_item_module->_html['file']);
							if(!write_file($sites_item_module->_html['file'], $__content__)){
								@chmod($sites_item_module->_html['path'], 0755);
								@chmod($sites_item_module->_html['file'], 0644);
								if(!write_file($sites_item_module->_html['file'], $__content__)){
									return false;
								}
							}
							@chmod($sites_item_module->_html['file'], 0644);							
						}
						
						unset($HTML_DATA, $HTML_DATAS, $next_item, $prev_item);
					}
				}
				
			}
		}
	}
}
