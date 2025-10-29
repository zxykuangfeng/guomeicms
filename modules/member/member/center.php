<?php
defined('PHP168_PATH') or die();

$this_module->set_model($ROLE_GROUP);
$this_module->get_member_info($UID);
$member_info = $this_module->get_member_info($UID);
$cs=$core->load_module('cservice');
$csinfo=$cs->get_my_info();

$message=$core->load_module('message');
$message->my_message();

/*cms-item-verify*/	
$cms = &$core->load_system('cms');		
$item = &$cms->load_module('item');
$category = &$cms->load_module('category');
$cms_controller = &$core->controller($item);
$allow_verify =  $cms_controller->check_action('verify');
$allow_verify_first = $cms_controller->check_action('verify_first');
/*如果同时设置初审和终审，终审有最终的权限，初审将不起作用*/
$verify_flag = $allow_verify ? true : ($allow_verify_first ? false : true);	

$listdb = $DB_master->fetch_all("select * from ".$item->main_table." WHERE `username` = '$USERNAME' ORDER BY id DESC limit 5");
	
foreach($listdb as $key => $val){
	$listdb[$key]['full_title']=$listdb[$key]['title'];
	$listdb[$key]['title']=p8_cutstr($listdb[$key]['title'],48);
	$listdb[$key]['url']=$item->controller."-view-id-".$val['id'];
	$listdb[$key]['edit']=$core->U_controller."/cms/item-update?id=$val[id]&model=$val[model]&verified=1";
	$listdb[$key]['addon']=$core->U_controller."/cms/item-addon?iid=$val[id]&model=$val[model]&verified=1";
}
//角色配置,获取角色模板
$role_module = &$core->load_module('role');
$role_module->get_cache();
$this_roles = $role_module->roles[$ROLE];
$template = empty($this_roles['role_template']) ? 'center' : $this_roles['role_template'];
//获取栏目预警信息
$category->get_cache(false);
//cid post_size manager
$days = array();
foreach($category->categories as $v){
	if($v['CONFIG']['post_size'] && !empty($v['CONFIG']['manager']) && in_array($UID,$v['CONFIG']['manager'])){
		/*
		$ids = array($v['id']);
		$ids = $category->get_children_ids($v['id']) + $ids;
		foreach($ids as $id){
			if($category->categories[$id] && $category->categories[$id]['type'] != 1) $days[$v['CONFIG']['post_size']][] = $id;
		}
		*/
		$days[$v['CONFIG']['post_size']][] = $v['id'];
	}	
}
$days = array_map('array_unique',$days);
$table = $item->main_table;
$message = array();
foreach($days as $day=>$check_cids){
	$day = intval($day);
	if($day && $check_cids){
		foreach($check_cids as $check_cid){
			$ids = array($check_cid);
			$ids = $category->get_children_ids($check_cid) + $ids;		
			$SQL = "SELECT COUNT(*) as count FROM $table WHERE cid in (".implode(',',$ids).") and timestamp >= UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL $day DAY)) 
			AND timestamp <= UNIX_TIMESTAMP(NOW())";
			$ret = $core->DB_master->fetch_one($SQL);
			if(empty($ret['count'])) $message[$day][] = $check_cid;
		}
	}
}
$show_message = '<ul>';
$message_count = 0;
krsort($message);
foreach($message as $d=>$sids){	
	$show_message .= '<li style="clear:both;line-height:26px;"><font color="red"> '.$d.' </font>天没有更新的栏目：</li>';	
	$left = $d >=10 ? 36 : 28;
	foreach($sids as $sid){
		if($category->categories[$sid]['type'] == 1 ) continue;
		$each_message = '';
		$parent_cats = $category->get_parents($sid);
		$dot = '';
		foreach($parent_cats as $v){
			$each_message .= $dot.$v['name'];
			$dot = ' &gt; ';
		}
		$each_message .= $dot.$category->categories[$sid]['name'];
		$model = $category->categories[$sid]['model'];
		$show_message .= '<li style="clear:both;"><span style="color:#0079bd;float:left;padding-left:'.$left.'px;">'.$each_message.'</span>';
		$type=$category->categories[$sid]['type'];
		if($category->categories[$sid]['type'] != 1){
			$show_message .= '<span style="float:right;padding-right:10px;"><a href="'.$core->U_controller.'/cms/item-add?model='.$model.'&cid='.$sid.'" target="_blank" style="color:#0079bd;">发布>></a></span>';
		}
		$show_message .= '</li>';
		$message_count ++;
		if($message_count>15) break;
	}
	if($message_count>15) break;
}
$show_message .= '</ul>';
$message_height = 140;
$message_height += $message_count * 28;
$message_height = $message_height < 140 ? 140 : $message_height;
$message_height = $message_height > 520 ? 520 : $message_height;
include template($this_module, $template);

