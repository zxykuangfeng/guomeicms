<?php
defined('PHP168_PATH') or die();

/**
* 首页内容本身和相应的列表静态
**/
if(REQUEST_METHOD == 'POST'){
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$cid = isset($_POST['cid']) ? intval($_POST['cid']) : 0;
	$action = $_POST['action'] == 'add' ? 'add' : 'update';
	($id && $cid) or message('no_such_item');
	//生成HTML
	$category = $this_system->load_module('category');
	$category->get_cache();	
	$cat = $category->categories[$cid];
	global $core,$P8LANG, $ADMIN_LOG,$ACTION;
	if($action == 'add'){		
		if(!empty($cat['htmlize'])){
			$this_module->html($DB_master->query("SELECT * FROM $this_module->main_table WHERE id = '$id'"));
			
			$this_module->html_list($cat['id']);
			//静态化父栏目
			
			$item_config = $core->get_config('cms','item');
			if(!empty($item_config['sync_list_to_html'])){
				$pids = $category->get_parents($cat['id']);
				foreach($pids as $pid){
					$this_module->html_list($pid['id']);
				}
			}			
			if(!empty($core->CONFIG['enable_mobile'])){
				$_GLOBALS['core']->ismobile=true;
				$core->ismobile=true;
				$this_module->html($DB_master->query("SELECT * FROM $this_module->main_table WHERE id = '$id'"));
				$this_module->html_list($cat['id'],true);
				//静态化父栏目
				if(!empty($item_config['sync_list_to_html'])){
					foreach($pids as $pid){
						$this_module->html_list($pid['id'],true);
					}
				}
				$_GLOBALS['core']->ismobile=false;
				$core->ismobile=false;
			}			
			
			$ACTION = 'add';
			$ADMIN_LOG = array('title' => $P8LANG['_module_add_admin_log']);
		}
	}else{
		//生成静态
		if($cat['htmlize']){					
			$this_module->html($DB_master->query("SELECT * FROM $this_module->main_table WHERE id = '$id'"));
			$this_module->html_list($cat['id']);
			//静态化父栏目					
			$item_config = $core->get_config('cms','item');
			if(!empty($item_config['sync_list_to_html'])){
				$pids = $category->get_parents($cat['id']);
				foreach($pids as $pid){
					$this_module->html_list($pid['id']);
				}
			}
			//if($data['main']['cid'] != $orig_data['cid']) $this_module->html_list($orig_data['cid']);
		}
		if(!empty($core->CONFIG['enable_mobile'])){
			$_GLOBALS['core']->ismobile=true;
			$core->ismobile=true;
			$this_module->html($DB_master->query("SELECT * FROM $this_module->main_table WHERE id = '$id'"));
			$_GLOBALS['core']->ismobile=false;
			$core->ismobile=false;
		}
		$ACTION = 'update';
		$ADMIN_LOG = array('title' => $P8LANG['_module_update_admin_log']);
	}
}