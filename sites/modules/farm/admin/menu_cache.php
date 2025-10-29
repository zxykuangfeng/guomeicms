<?php
defined('PHP168_PATH') or die();

/**
* 更新导航菜单缓存
**/

$this_system->check_manager($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){	
	$this_module->menu_cache($this_system->SITE);
	message('done',$this_router.'-menu_list');
}else if(REQUEST_METHOD == 'POST'){	
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
				'parent' => isset($item['parent'][$k]) ? intval($item['parent'][$k]) : 0,
				'site' => $this_system->SITE,
				'url' => isset($item['url'][$k]) ? $item['url'][$k] : '',
				'target' => isset($item['target'][$k]) && $item['target'][$k]=='_blank' ? '_blank' : '',
				'display' => isset($item['display'][$k]) ? intval($item['display'][$k]) : 0,
				'display_order' => $display_order,
				'dynamic_url' => isset($item['dynamic_url'][$k]) ? $item['dynamic_url'][$k] : '',
			);	
			
			if($id){
				//更新时
				$newurl = isset($item['url'][$k]) ? $item['url'][$k] : '';				
				$odata = $DB_master->fetch_one("SELECT * FROM $this_module->table_menu WHERE id = '$id'");				
				if($odata['url'] != $newurl){
					$DB_master->update(
						$this_module->table_menu,
						array('dynamic_url'=>$newurl),
						"id = '$id'"
					);
				}
				$DB_master->update(
					$this_module->table_menu,
					$data,
					"id = '$id'"
				);				
			}else{
				//新增
                $data['summary']='';
				$this_module->add_menu($data);
			}			
		}
	}
	//显示
	$display = isset($_POST['display_json']) ? jsondecode((MAGIC_QUOTES ? stripcslashes($_POST['display_json']) : $_POST['display_json'])) : array();	
	foreach((array)$display as $id => $v){
		$DB_master->update(
			$this_module->table_menu,
			array(
				'display' => (int)$v
			),
			"id = '$id'"
		);
	}

	$this_module->menu_cache($this_system->SITE);
	//静态首页
	$form = '<form action="'.$this_system->admin_controller.'-index_to_html" method="post" id="'. $this_system->SITE .'" target="'. $this_system->SITE .'">'.
		'<input type="hidden" name="'.$this_system->SITE.'">'.
		'<input type="hidden" name="site" value="'.$this_system->SITE.'">'.
		'</form>'.
		'<iframe style="display: none;" name="'. $this_system->SITE .'"></iframe>'.
		'<script type="text/javascript">document.getElementById("'. $this_system->SITE .'").submit();</script>';
	message($P8LANG['done'].$form,$this_router.'-menu_list');
}

