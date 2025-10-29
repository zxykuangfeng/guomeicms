<?php
defined('PHP168_PATH') or die();
/**头部导航**/
$this_controller->check_admin_action('navigation_menu') or message('no_privilege');
require_once PHP168_PATH .'admin/inc/navigation_menu.class.php';
if(REQUEST_METHOD == 'GET'){	
	$id = isset($_GET['id']) ? intval($_GET['id']) : 0;	
	load_language($core, 'config');	
	$navigation_menu->cache(false);
	include template($core, 'menu/navigation_menu_list', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	$type = isset($_POST['type']) ? trim($_POST['type']) : '';
	if($type){
		$navigation_menu->change_url($type);		
	}else{
		$_POST = p8_stripslashes2($_POST);	
		foreach($_POST['option'] as $key=>$item){
			//$item
			foreach($item['id'] as $k=>$id){
				if(!strlen($item['name'][$k])){
					continue;
				}
				$display_order = isset($item['display_order'][$k]) ? intval($item['display_order'][$k]) : 0;
				if($display_order >=255) $display_order = 255;
				if($display_order <=0) $display_order = 0;
				$data = array(
					'name' => html_entities($item['name'][$k]),
					'parent' => isset($item['parent'][$k]) ? intval($item['parent'][$k]) : 0,
					'system' => isset($item['system'][$k]) ? $item['system'][$k] : '',	
					'url' => isset($item['url'][$k]) ? $item['url'][$k] : '',				
					'target' => isset($item['target'][$k]) && $item['target'][$k]=='_blank' ? '_blank' : '',
					'display' => isset($item['display'][$k]) ? intval($item['display'][$k]) : 0,
					'display_order' => $display_order,
				);			
				if($id){
					$odata = $navigation_menu->view($id);
					$newurl = isset($item['url'][$k]) ? $item['url'][$k] : '';
					if($odata['url'] != $newurl){
						$DB_master->update(
							$navigation_menu->table,
							array('dynamic_url'=>$newurl),
							"id = '$id'"
						);
					}
					//更新时
					$DB_master->update(
						$navigation_menu->table,
						$data,
						"id = '$id'"
					);				
				}else{
					//新增				
					$navigation_menu->add($data);
				}
				
			}
		}
		
		//显示
		$display = isset($_POST['display_json']) ? jsondecode((MAGIC_QUOTES ? stripcslashes($_POST['display_json']) : $_POST['display_json'])) : array();
		foreach((array)$display as $id => $v){
			$DB_master->update(
				$navigation_menu->table,
				array(
					'display' => (int)$v
				),
				"id = '$id'"
			);
		}
		
	}
	$navigation_menu->get_cache();
	message('done',$this_url,0);
}
