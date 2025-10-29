<?php
defined('PHP168_PATH') or die();

/**
* 分类的JSON
**/

$this_module->get_cache();
$callback = isset($_GET['callback']) ? xss_clear($_GET['callback']) : '';
$callback = preg_replace('/[^\w_]*/','',$callback);
$api = isset($_GET['api']) ? 1 : 0;
$json = '{}';
if(isset($_GET['parent'])){

	$parent = intval($_GET['parent']);

	if(isset($this_module->categories[$parent]['categories']) || $parent == 0){
		$ret = array();
		if(isset($this_module->categories[$parent]['categories'])){
			$for = &$this_module->categories[$parent]['categories'];
		}else{
			$for = &$this_module->top_categories;
		}		
        $my_cat = $my_add_cat = $my_add_parents_cat = array();
        if(!$IS_FOUNDER && $_GET['verify']){
            $Item = $this_system->load_module('item');
            $item_controller = $core->controller($Item);
            $my_category_to_verify = $item_controller->get_acl('my_category_to_verify');
			$my_addible_category = array_keys($my_category_to_verify);	
            $my_cat = !empty($my_addible_category) && (count($my_addible_category) > 1 || count($my_addible_category) == 1 && $my_addible_category[0] != 0) ? $my_addible_category : array();
        }
		if(!$IS_FOUNDER && $_GET['add']){
			$Item = $this_system->load_module('item');
            $item_controller = $core->controller($Item);
			$my_category_to_add = $item_controller->get_acl('my_addible_category');
			$my_addible_category = array_keys($my_category_to_add);	
            $my_add_cat = !empty($my_addible_category) && (count($my_addible_category) > 1 || count($my_addible_category) == 1 && $my_addible_category[0] != 0) ? $my_addible_category : array();		
        }		
		foreach($for as $v){
			unset($v['allow_dynamic']);
			if(!$api){
				isset($v['categories']) && $v['categories'] = true;
			}
            if(!$IS_FOUNDER && $_GET['verify']){
                if(isset($my_category_to_verify[0]) || (!empty($my_category_to_verify) && in_array($v['id'],$my_cat))){
                    $ret[$v['id']] = $v;
                }
            }else if(!$IS_FOUNDER && $_GET['add']){
                if(isset($my_category_to_add[0]) || (!empty($my_category_to_add) && in_array($v['id'],$my_add_cat))){
                    $ret[$v['id']] = $v;
                }
            }else{
                $ret[$v['id']] = $v;
            }
		}
		$json = jsonencode($this_module->make_json_sort($ret));
	}else{
		$json = '{}';
	}

}else if(isset($_GET['id'])){

	$ret = array();
	foreach((array)$_GET['id'] as $id){
	    $id=xss_clear($id);
		if(isset($this_module->categories[$id])){
			$ret[$id] = $this_module->categories[$id];
			if(!$api){
				if(isset($ret[$id]['categories'])) $ret[$id]['categories'] = true;
			}
			unset($ret[$id]['url'], $ret[$id]['allow_dynamic']);

			$ret[$id]['parents'] = array_merge($this_module->get_parents($id), array($ret[$id]));

			foreach($ret[$id]['parents'] as $parent_cat){
				$parent_id = $parent_cat['parent'];
				$tmp = $parent_id == 0 ? $this_module->top_categories : $this_module->categories[$parent_id]['categories'];

				foreach($tmp as $sub_cat){
					if(!$api){
						isset($sub_cat['categories']) && $sub_cat['categories'] = true;
					}
					unset($sub_cat['url'], $sub_cat['allow_dynamic']);
					$ret[$id]['paths'][$parent_id][$sub_cat['id']] = $sub_cat;
				}
			}
		}
	}
	if(empty($ret)){
		$first = current($this_module->categories);
		$id = $first['id'];
		$ret[$id] = $this_module->categories[$id];
		if(!$api){
			if(isset($ret[$id]['categories'])) $ret[$id]['categories'] = true;
		}
		unset($ret[$id]['url'], $ret[$id]['allow_dynamic']);

		$ret[$id]['parents'] = array_merge($this_module->get_parents($id), array($ret[$id]));

		foreach($ret[$id]['parents'] as $parent_cat){
			$parent_id = $parent_cat['parent'];
			$tmp = $parent_id == 0 ? $this_module->top_categories : $this_module->categories[$parent_id]['categories'];

			foreach($tmp as $sub_cat){
				if(!$api){
					isset($sub_cat['categories']) && $sub_cat['categories'] = true;
				}
				unset($sub_cat['url'], $sub_cat['allow_dynamic']);
				$ret[$id]['paths'][$parent_id][$sub_cat['id']] = $sub_cat;
			}
		}
	}
	//print_R($ret);
	$json = jsonencode($ret);

}

if($api) {
	exit($json);
}else{
	exit($callback .'('. $json .');');
}
