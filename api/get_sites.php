<?php
/**
* 获取分站基本信息
**/
header('Content-type: application/json;charset=utf-8');
require_once dirname(__FILE__) .'/../inc/init.php';
$request = p8_stripslashes2($_POST + $_GET);
GetGP(array('token','user_name'));
$data = array();
if(empty($token) || ($token && !hash_equals($token,$core->CONFIG['p8_api_token']))){
	exit(json_encode(array('status'	=> 200,'error' => $P8LANG['api_token_err'])));  
}
if(!isset($core->CONFIG['system&module']['sites'])) {  
    exit(json_encode(array('status'	=> 200,'error' => $P8LANG['no_such_system'])));  
}
// 读取站点模块缓存数据  
$sites_modules = $core->CACHE->read('sites/modules', 'farm', 'all');  
if (!$sites_modules) {  
    exit(json_encode($data));  
}
// 过滤未启用的站点  
$sites_modules = array_filter($sites_modules, function ($site) {  
    return !empty($site['status']);  
}); 

// 如果提供了用户名，则进一步处理  
if($user_name) {  
    // 获取用户信息  
    $user_info = get_member(p8_addslashes2($user_name));  
    $UID = $user_info['id'] ? $user_info['id'] : 0;  
    $ROLE = $user_info['role_id'] ? $user_info['role_id'] : 0;  
	// 如果用户存在且不是创始人，则继续处理权限  
    if($UID) {
		if($user_info['is_founder'] != 1){
			$IS_FOUNDER = 0;
			// 读取管理员权限缓存数据  
			$manager_cache = $core->CACHE->read('sites', '', 'manager', 'serialize');  
			$manage_sites = isset($manager_cache['manager'][$UID]) ? $manager_cache['manager'][$UID] : [];  
	  
			// 读取帖子发布者和角色权限缓存数据  
			$poster_sites = isset($manager_cache['poster'][$UID]) ? $manager_cache['poster'][$UID] : [];  
			$role_sites = isset($manager_cache['role'][$ROLE]) ? $manager_cache['role'][$ROLE] : [];  
	  
			// 合并站点权限  
			$poster_sites = array_unique(array_merge($poster_sites, $role_sites));  
			// 读取站点ACL数据  
			$acl_table = $core->TABLE_.'member_acl';  
			$acl_dbs = $core->DB_master->fetch_array("SELECT v,postfix FROM $acl_table WHERE system = 'sites' AND module = 'item' AND user_id = '$UID'");  
			$acls = [];  
			foreach($acl_dbs as $site) {  
				$acls[] = $site['v'] ? mb_unserialize($site['v']) : [];  
	  
				// 检查是否拥有添加权限或分类权限  
				foreach ($acls as $permissions) {// 检查添加、更新或删除权限中的任何一个是否被设置为真
					// 检查是否有权限				
					$hasPermission = $permissions['actions']['add'] ?? false || $permissions['actions']['update'] ?? false ||$permissions['actions']['delete'] ?? false; 
					$categoryAclExists = isset($permissions['category_acl']);  // 如果存在任何添加、更新、删除权限或分类权限，则将该站点添加到管理站点数组中
					if($hasPermission || $categoryAclExists) {					
						$manage_sites[] = $site['postfix'];					
					}
				} 
			}  
			// 合并所有权限并过滤未授权站点  
			$authorized_sites = array_unique(array_merge($manage_sites, $poster_sites));  
			$sitesResult = array_intersect_key($sites_modules, array_flip($authorized_sites));
			// 过滤未启用的站点  
			$sites_modules = $sitesResult;
		}
    }else{
		exit(json_encode(array('status' => 200,'error' => $P8LANG['no_such_user'] . "：" . $user_name)));
	}
}  
// 输出JSON数据  
exit(json_encode($sites_modules));