<?php
defined('PHP168_PATH') or die();

$this_system->check_manager($ACTION) or message('no_privilege');
if(REQUEST_METHOD == 'GET'){
	$menus = $this_module->get_menu_nav($this_system->SITE,false);
	include template($this_module, 'menu_nav', 'admin');

}else if(REQUEST_METHOD == 'POST'){
	$_POST = p8_stripslashes2($_POST);
	$type = isset($_POST['type']) ? trim($_POST['type']) : '';
	switch($type){
		case 'delete':
			$id = isset($_POST['id']) ? intval($_POST['id']) : 0;		
			$json = $this_module->delete_menu_nav($id);	
			echo jsonencode($json);
			exit;
		break;
		case 'cache':
			$this_module->menu_nav_cache($this_system->SITE);
			exit('done');
		break;
		default:
			$_POST = p8_stripslashes2($_POST);
			foreach($_POST['option'] as $key=>$item){	
				//$item				
				foreach($item['id'] as $k=>$id){					
					if(!strlen($item['name'][$k])){
						continue;
					}
					$display_order = isset($item['display_order'][$k]) ? intval($item['display_order'][$k]) : 0;
					if($display_order >=999) $display_order = 999;
					if($display_order <=0) $display_order = 0;		
					$data = array(
						'name' => html_entities($item['name'][$k]),
						'site' => $this_system->SITE,
						'parent' => isset($item['parent'][$k]) ? intval($item['parent'][$k]) : 0,
						'url' => isset($item['url'][$k]) ? $item['url'][$k] : '',
						'target' => isset($item['target'][$k]) && $item['target'][$k]=='_blank' ? '_blank' : '',
						'display' => isset($item['display'][$k]) ? intval($item['display'][$k]) : 1,
						'display_order' => $display_order,
					);	
					
					if($id){
						//更新时						
						$DB_master->update(
							$this_module->table_menu_nav,
							$data,
							"id = '$id'"
						);				
					}else{
						//新增
						$this_module->add_menu_nav($data);
					}		
				}
			}
			//显示
			$display = isset($_POST['display_json']) ? jsondecode((MAGIC_QUOTES ? stripcslashes($_POST['display_json']) : $_POST['display_json'])) : array();	
			foreach((array)$display as $id => $v){
				$DB_master->update(
					$this_module->table_menu_nav,
					array(
						'display' => (int)$v
					),
					"id = '$id'"
				);
			}

			$this_module->menu_nav_cache($this_system->SITE);
	}
	message($P8LANG['done'],$this_url,3);
}
