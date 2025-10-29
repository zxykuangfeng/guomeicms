<?php
defined('PHP168_PATH') or die();

//$this_system->check_manager($ACTION) or message('no_privilege');
if(REQUEST_METHOD == 'GET'){
	$menus = $this_system->get_menu_user($UID,false);
	$farm = $this_system->load_module('farm');
	include template($farm, 'menu_custom', 'admin');
}else if(REQUEST_METHOD == 'POST'){
	$_POST = p8_stripslashes2($_POST);
	$type = isset($_POST['type']) ? trim($_POST['type']) : '';
	switch($type){
		case 'delete':
			$id = isset($_POST['id']) ? intval($_POST['id']) : 0;		
			$json = $this_system->delete_menu_user($id);	
			echo jsonencode($json);
			exit;
		break;
		case 'cache':
			$this_system->menu_user_cache($UID);
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
					if($display_order >=255) $display_order = 255;
					if($display_order <=0) $display_order = 0;		
					$data = array(
						'name' => html_entities($item['name'][$k]),
						'uid' => $UID,
						'url' => isset($item['url'][$k]) ? $item['url'][$k] : '',
						'target' => isset($item['target'][$k]) && $item['target'][$k]=='_blank' ? '_blank' : '',
						'display' => isset($item['display'][$k]) ? intval($item['display'][$k]) : 1,
						'display_order' => $display_order,
					);	
					
					if($id){
						//更新时						
						$DB_master->update(
							$this_system->table_menu_user,
							$data,
							"id = '$id'"
						);				
					}else{
						//新增				
						$this_system->add_menu_user($data);
					}			
				}
			}
			//显示
			$display = isset($_POST['display_json']) ? jsondecode((MAGIC_QUOTES ? stripcslashes($_POST['display_json']) : $_POST['display_json'])) : array();	
			foreach((array)$display as $id => $v){
				$DB_master->update(
					$this_system->table_menu_user,
					array(
						'display' => (int)$v
					),
					"id = '$id'"
				);
			}

			$this_system->menu_user_cache($UID);
	}
	message($P8LANG['done'],$this_url,3);
}
