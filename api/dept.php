<?php
require dirname(__FILE__) .'/../inc/init.php';


$dept = $core->load_module('member');
$dept->get_cache();

$callback = isset($_GET['callback']) ? xss_clear($_GET['callback']) : '';
$callback = preg_replace('/[^\w_]*/','',$callback);
$json = '{}';

if(isset($_GET['parent'])){
	$parent = intval($_GET['parent']);
	if(isset($dept->depts[$parent]['depts']) || $parent == 0){
		$ret = array();
		if(isset($dept->depts[$parent]['depts'])){
			$for = $dept->depts[$parent]['depts'];
		}else{
			$for = $dept->province;
		}
		
		foreach($for as $v){
			isset($v['depts']) && $v['depts'] = true;
			$ret[$v['id']] = $v;
		}
		
		$json = jsonencode($ret);
	}else{
		$json = '{}';
	}
	
}else if(isset($_GET['id'])){
	$ret = array();	
	foreach((array)$_GET['id'] as $id){
		if(isset($dept->depts[$id])){
			$ret[$id] = $dept->depts[$id];
			if(isset($ret[$id]['depts'])) $ret[$id]['depts'] = true;
			
			$ret[$id]['parents'] = array_merge($dept->get_parents($id), array($ret[$id]));
			
			foreach($ret[$id]['parents'] as $parent_cat){
				$tmp = $parent_cat['parent'] == 0 ? $dept->province : $dept->depts[$parent_cat['parent']]['depts'];
				
				foreach($tmp as $sub_cat){
					isset($sub_cat['depts']) && $sub_cat['depts'] = true;
					$ret[$id]['paths'][$parent_cat['parent']][$sub_cat['id']] = $sub_cat;
				}
			}
		}		
	}
	if(empty($ret)){
		$parent = $_GET['parent'] = 0;
		if(isset($dept->depts[$parent]['depts']) || $parent == 0){
			$ret = array();
			if(isset($dept->depts[$parent]['depts'])){
				$for = $dept->depts[$parent]['depts'];
			}else{
				$for = $dept->province;
			}
			
			foreach($for as $v){
				isset($v['depts']) && $v['depts'] = true;
				$ret[$v['id']] = $v;
			}
			
			$json = jsonencode($ret);
		}else{
			$json = '{}';
		}
	}
	//print_R($ret);
	$json = jsonencode($ret);
}
if($callback){
	exit($callback .'('. $json .');');
}else{
	exit('');
}
