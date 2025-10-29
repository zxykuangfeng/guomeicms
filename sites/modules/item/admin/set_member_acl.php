<?php
defined('PHP168_PATH') or die();

/**
* 设置权限
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');
$MODEL = '';

if(REQUEST_METHOD == 'GET'){

	$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
	$user_id or message('no_such_item');
	
	$category = &$this_system->load_module('category');
	//$category->get_cache();
	$json = $category->get_json();
	
	$member = &$core->load_module('member');
	//$role->get_cache(true);
	$acls = $member->get_acl($this_module, $user_id, $this_system->SITE);
	
	$info = include $this_module->path .'#.php';
	
	$allsites  = $this_system->get_sites();
	$mysites = $this_system->get_manage_sites();	
	unset($info['actions']['my_list'], $info['actions']['search'], $info['actions']['comment'],$info['actions']['reflash_index']);
	unset($info['actions']['sites_push'],$info['actions']['view_to_html'],$info['actions']['clone'],$info['actions']['cluster_push']);
	unset($info['actions']['filter_word'],$info['actions']['setviews'],$info['actions']['level'],$info['actions']['attribute']);
	include template($this_module, 'set_member_acl', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	$user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
	$user_id or message('no_such_item');
	
	$acl = isset($_POST['acl']) ? (array)$_POST['acl'] : array();
	$acl['category_acl'] = isset($acl['category_acl']) ? (array)$acl['category_acl'] : array();
	
	//本角色可以审核的栏目
	$my_category_to_verify = $my_category_to_verify_first = array();
	//我可以添加内容的栏目
	$my_addible_category = array();
	
	foreach($acl['category_acl'] as $cid => $a){
		if(!empty($a['actions']['verify'])){
			$my_category_to_verify[$cid] = 1;
		}
		if(!empty($a['actions']['verify_first'])){			
			$my_category_to_verify_first[$cid] = 1;
		}
		if(!empty($a['actions']['add'])){
			$my_addible_category[$cid] = 1;
		}
		
		if(!empty($a['actions'])){
			foreach($a['actions'] as $act => $v){
				//强转bool型
				$acl['category_acl'][$cid]['actions'][$act] = (bool) $v;
			}
		}
	}
	$acl['my_category_to_verify'] = $my_category_to_verify;
	$acl['my_category_to_verify_first'] = $my_category_to_verify_first;
	$acl['my_addible_category'] = $my_addible_category;
	
	$member = &$core->load_module('member');
	$controller = &$core->controller($member);

	$controller->set_acl($this_module, $user_id, $acl, $this_system->SITE);
	
	message('done');
}
