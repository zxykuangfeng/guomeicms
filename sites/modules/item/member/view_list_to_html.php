<?php
defined('PHP168_PATH') or die();

/**
* 首页内容本身和相应的列表静态
**/
if(REQUEST_METHOD == 'POST'){
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$cid = isset($_POST['cid']) ? intval($_POST['cid']) : 0;
	$action = $_POST['action'] == 'add' ? 'add' : 'update';
	$site = isset($_POST['site']) ? trim($_POST['site']) : '';
	($id && $cid) or message('no_such_item');
	$site or message('no_such_site');
	//生成HTML
	$category = $this_system->load_module('category');
	$category->get_cache();	
	$cat = $category->categories[$cid];
	global $core,$P8LANG, $ADMIN_LOG,$ACTION;
	if($action == 'add'){		
		if(empty($cat)){
			$category->get_cache(true,$site);
			$cat = $category->categories[$cid];
		}
		if(!empty($cat['htmlize'])){		
			$this_module->html($DB_master->query("SELECT * FROM $this_module->main_table WHERE id = '$id'"),$site);
            $this_module->html_list($cat['id'],false,$site);
			$item_config = $core->get_config('sites','item');
			if(!empty($item_config['sync_list_to_html'])){
				$pids = $category->get_parents($cat['id']);
				foreach($pids as $pid){
					$this_module->html_list($pid['id'],false,$site);
				}
			}			
			$ACTION = 'add';
			$ADMIN_LOG = array('title' => $P8LANG['_module_add_admin_log']);			
		}
	}else{
		//生成静态
		$cat = $this_system->fetch_category($cid);
		if($cat['htmlize']){					
			$this_module->html($DB_master->query("SELECT * FROM $this_module->main_table WHERE id = '$id'"),$site);
			$this_module->html_list($cat['id'],false,$site);
			$item_config = $core->get_config('sites','item');
			if(!empty($item_config['sync_list_to_html'])){
				$pids = $category->get_parents($cat['id']);
				foreach($pids as $pid){
					$this_module->html_list($pid['id'],false,$site);
				}
			}
			//if($data['main']['cid'] != $orig_data['cid']) $this->html_list($orig_data['cid']);
			$ACTION = 'update';
			$ADMIN_LOG = array('title' => $P8LANG['_module_update_admin_log']);
		}
	}
}

