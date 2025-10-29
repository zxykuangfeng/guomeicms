<?php
defined('PHP168_PATH') or die();

/**
 * 列表模型入口文件
 * *
 */

/*
 * //304
 * if(!empty($this_module->CONFIG['list_page_cache_ttl'])){
 *
 * $hash = md5_16($_SERVER['REQUEST_URI']);
 *
 * if(isset($_SERVER['HTTP_IF_NONE_MATCH'])){
 * $tmp = explode('@', $_SERVER['HTTP_IF_NONE_MATCH']);
 *
 * if($hash == $tmp[0] && P8_TIME - $tmp[1] < 300){
 * header('Etag: '. $hash .'@'. P8_TIME, true, 304);
 * exit;
 * }
 * unset($tmp);
 * }
 *
 * header('Etag: '. $hash .'@'. P8_TIME);
 * }
 */

$cid = 0;
$page = 1;

foreach ($URL_PARAMS as $k => $v) {
    switch ($v) {
        
        case 'category':
            $cid = isset($URL_PARAMS[$k + 1]) ? intval($URL_PARAMS[$k + 1]) : 0;
            break;
        
        case 'page':
            $page = isset($URL_PARAMS[$k + 1]) ? intval($URL_PARAMS[$k + 1]) : 1;
            $page = max($page, 1);
            break;
    }
}

$cid or message('no_such_cms_category');
$CAT = &$this_system->fetch_category($cid);
// 检查当前分类权限
if (!$this_controller->check_category_action($ACTION, $cid) && !defined('P8_GENERATE_HTML')) {
	message('no_privilege', $core->U_controller.'/member-login?forward='.$CAT['url'],2);
	
	return;
}

$add_enable = $this_controller->check_category_action('add', $cid);

// 页面缓存参数: cid
$PAGE_CACHE_PARAM['cid'] = $cid;

// 页面缓存参数: page
$PAGE_CACHE_PARAM['page'] = $page;

// 页面缓存参数: 更新时间
$PAGE_CACHE_PARAM['ttl'] = empty($this_module->CONFIG['list_page_cache_ttl']) ? 0 : $this_module->CONFIG['list_page_cache_ttl'];

// 加载分类模块并取得当前分类的缓存
$category = &$this_system->load_module('category');

// 判断分类是否要显示
!$CAT['CONFIG']['enable_show'] or message('no_such_cms_category_show');

// 分类不存在
$CAT or message('no_such_cms_category');
//设置转向栏目ID
if($CAT['CONFIG']['direct_to_category_id'] && !defined('P8_GENERATE_HTML')){
	$direct_to_category_id = intval($CAT['CONFIG']['direct_to_category_id']);
	$DIRECT_CAT = &$this_system->fetch_category($direct_to_category_id);
	header('Location: '. $DIRECT_CAT['url']);
	exit;
}
// 允许IP地址,超管不限制
if(!$IS_ADMIN && $CAT['CONFIG']['allow_ip']['enabled'] && !defined('P8_GENERATE_HTML')) $this_controller->allow_ip($CAT['CONFIG']);
if(!$IS_ADMIN && $CAT['CONFIG']['need_login']) {
	$UID or message('cms_need_login', $core->U_controller.'/member-login?forward='.$CAT['url'],2);
}
if(!empty($this_system->CONFIG['forbidden_dynamic']) && ! ($IS_ADMIN || defined('P8_GENERATE_HTML'))) {
	// 禁止查看动态页,生成静态管理员例外,静态化的跳到静态文件
	
	if ($CAT['htmlize'] && $CAT['htmlize'] != 2) {
		header('Location: ' . $CAT['url']);
		exit();
	} else 
		if (empty($CAT['allow_dynamic'])) {
			message('access_denied');
		}
}

//检查是否需要密码访问栏目,如果是超级管理员,则忽略
if(!$IS_ADMIN && $CAT['need_password']){
	//如果有密码，则检验密码
	//优先从cookie中获取密码，没有则使用用户输入的密码进行验证
	$cookie_password = get_cookie('PASSWORD_'.$cid) ? get_cookie('PASSWORD_'.$cid) : '';
	$password = isset($_POST['password']) ? trim($_POST['password']) : $cookie_password;
	if($CAT['category_password'] && $password != $CAT['category_password']){
		$action = $this_url.'-category-'.$cid;
		$errmessage = $password ? '栏目访问密码不正确，请重新输入！' : '';
		include template($this_module, 'password');
		return;
	}
	if($password && empty($cookie_password)) {
		$_config_ = &$core->CONFIG['cookie'];
		$_cookie_name = isset($_config_['prefix']) ? $_config_['prefix'].'PASSWORD_'.$cid : 'PASSWORD_'.$cid;
		setcookie($_cookie_name,$password);
		set_cookie('PASSWORD_'.$cid,$password);			
	}
}
$role = intval(trim($_REQUEST['role']));
$ROLE = $role ? $role : $ROLE;
//开启角色浏览权限控制
if(!$IS_FOUNDER && $this_module->CONFIG['authority'] && !defined('P8_GENERATE_HTML') && $ROLE){
	if($CAT['CONFIG']['authority'] || $CAT['CONFIG']['authority_viewer']){
		$authority = $CAT['CONFIG']['authority'];
		$allow_authority = empty($authority) || in_array($ROLE,$authority) || in_array('0',$authority);
		$allow_authority_viewer = empty($CAT['CONFIG']['authority_viewer']) || in_array($UID,$CAT['CONFIG']['authority_viewer']);
		if(!$allow_authority && !$allow_authority_viewer) message('no_privilege');
	}
}
/**
 * *大列表显示所有内容**
 */
if ($CAT['list_all_model'] && $CAT['type'] == 1) {
	// 当前分类的内容数
	$count = $field_filter ? 0 : $CAT['item_count'];
	$_urltemp = $CAT['url'];
	$CAT['url'] = '';
	$CAT['is_category'] = true;
	$page_url = p8_url($this_module, $CAT, 'list', false);
	$CAT['url'] = $_urltemp;
	$select = select();
	$select->from($this_module->main_table . ' AS i', 'i.*');
	//尝试读缓存
	$category->get_cache();	
	if(empty($category->categories)){
		$category->get_cache(false);
	}
	//读不到缓存，生成后读
	if(empty($category->categories)){
		require_once PHP168_PATH .'inc/cache.func.php';
		cache_label();
		$category->cache();
		$category->get_cache();
	}
	// 父分类
	$parent_cats = $category->get_parents($cid);
	// 子分类
	$subcategories = array();
	if (isset($category->categories[$cid]['categories'])) {
		$subcategories = $category->categories[$cid]['categories'];
		$CATEGORY = $category->get_children_ids($cid) + array(
			$cid
		);
	} else {
		$CATEGORY = $cid;
	}
	
	$select->in('i.cid', $CATEGORY);
	//echo $select->build_sql();
	
	$sphinx = $this_module->CONFIG['sphinx'];
	$sphinx['index'] = $this_system->sphinx_indexes(array(
		$MODEL => 1
	));

	$orderby = empty($CAT['CONFIG']['orderby']) ? 'i.timestamp' : 'i.'.$CAT['CONFIG']['orderby'];	 
	$desc = empty($CAT['CONFIG']['orderby_desc']) ? ' DESC' : ' ASC';
	$orderby = $orderby == 'i.level' ? 'i.level'.$desc.',i.timestamp'.$desc : $orderby.$desc;

	$title_length = empty($CAT['CONFIG']['list_title_length']) ? 100 : $CAT['CONFIG']['list_title_length'];
	if ($core->ismobile)
		$title_length = empty($CAT['CONFIG']['list_title_length_mobile']) ? 20 : $CAT['CONFIG']['list_title_length_mobile'];
	$dot = empty($CAT['CONFIG']['title_dot']) ? '' : '...';
	//开启角色浏览权限控制
	if($this_module->CONFIG['authority'] && $ROLE){
		$select->where("(authority = '' or find_in_set($ROLE,authority))");
		$s = $comma = '';
		foreach($CATEGORY as $v){
			$s .= $comma ."'$v'";
			$comma = ',';
		}
		$sql = "SELECT COUNT(1) as `count` FROM $this_module->main_table WHERE cid in ($s) and (authority = '' or find_in_set($ROLE,authority))";
		$c3 = $core->DB_master->fetch_one($sql);
		$count= intval($c3['count']);
	}
	$select->left_join("{$this_module->TABLE_}digg AS s",'s.digg,s.trample','s.iid=i.id');    
	$select->order($orderby);
	//echo $select->build_sql();
	$list = $core->list_item($select, array(
		'count' => &$count,
		'page' => &$page,
		'page_size' => $CAT['page_size'],
		'sphinx' => $sphinx
	));
	$core_config = $core->get_config('core','');
	$main_domain = $core_config['static_enable'] && $core_config['static_url'] ? $core_config['static_url'] : $core->url;
	foreach ($list as $k => $v) {
		$v['#category'] = &$category->categories[$v['cid']];
		$v['url'] = attachment_url($v['url']);
		$v_config = isset($v['config']) ? mb_unserialize(stripslashes($v['config'])) : array();
		if(empty($v['url']) && $v_config['allow_ip']['enabled'] == 2 && $core_config['static_enable'] && $core_config['static_url']){
			$list[$k]['url'] = $main_domain.'/index.php/cms/item-view-id-'.$v['id'].'.html';
		}else{
			$list[$k]['url'] = p8_url($this_module, $v, 'view');
		}
		$list[$k]['url'] = $v['#category']['allow_ip_enabled'] >= 1 ? $main_domain.'/index.php/cms/item-view-id-'.$v['id'].'.html' : $list[$k]['url'];
		//权限控制下使用动态
		if(!empty($v_config['authority_viewer']) || (!empty($v['authority'])  && !in_array('0',explode(',',$v['authority'])))
			|| !empty($category->categories[$v['cid']]['authority_viewer']) ||
			(!empty($category->categories[$v['cid']]['authority']) && !in_array('0',$category->categories[$v['cid']]['authority']))
		){
			$list[$k]['url'] = $main_domain.'/index.php/cms/item-view-id-'.$v['id'].'.html';	
		}		
		$list[$k]['frame'] = attachment_url($v['frame']);
		//启用相对地址时
		if($v['#category']['attachment_type'] && $list[$k]['frame']){
			$list[$k]['frame'] = str_replace($core->url,'',$list[$k]['frame']);
			if($core->CONFIG['static_attachment_url']){
				$list[$k]['frame'] = str_replace($core->CONFIG['static_attachment_url'],'',$list[$k]['frame']);
			}
			$list[$k]['frame'] = P8_ROOT. str_replace($RESOURCE,'',$list[$k]['frame']);
			$list[$k]['frame'] = str_replace('//attachment','/attachment',$list[$k]['frame']);
		}
		$list[$k]['full_title'] = $v['title'];
		$list[$k]['title'] = p8_cutstr($v['title'], $title_length, $dot);
		$tmp = explode('|', $v['sub_title']);
		$list[$k]['sub_title'] = $tmp[0];
		$list[$k]['sub_title_url'] = isset($tmp[1]) ? $tmp[1] : '';
		
		// 分类名称
		$list[$k]['category_name'] = $v['#category']['name'];
		// 分类URL
		$list[$k]['category_url'] = $v['#category']['url'];
		//分类封面
		$list[$k]['category_frame'] = attachment_url($v['#category']['frame']);
		if (! empty($v['title_color']))
			$list[$k]['title'] = '<font color="' . $v['title_color'] . '">' . $list[$k]['title'] . '</font>';
		if (! empty($v['title_bold']))
			$list[$k]['title'] = '<b>' . $list[$k]['title'] . '</b>';
	}
	$page_template = ! empty($CAT['CONFIG']['list_pages_template']) && isset($P8LANG[$CAT['CONFIG']['list_pages_template']]) ? $P8LANG[$CAT['CONFIG']['list_pages_template']] : '';
	if ($core->ismobile)
		$page_template = ! empty($CAT['CONFIG']['list_pages_template_mobile']) && isset($P8LANG[$CAT['CONFIG']['list_pages_template_mobile']]) ? $P8LANG[$CAT['CONFIG']['list_pages_template_mobile']] : '';
	$pages = list_page(array(
		'count' => $count,
		'page' => $page,
		'page_size' => $CAT['page_size'],
		'url' => $page_url,
		'template' => $page_template
	));
} else {
	// 初始化模型
	$_REQUEST['model'] = $CAT['model'];
	$this_system->init_model();
	$this_model or message('no_such_cms_model');
	$this_model['enabled'] or message('cms_model_disabled');
}

if ($CAT['type'] == 2) {
	// $select的参数
	$select_param = array();
	
	$select_param['from'] = array(
		$this_module->table . ' AS i',
		'i.*'
	);
	
	$CAT['is_category'] = true;
	$tmp = $CAT['htmlize'];
	if ($CAT['htmlize'] == 2) {
		$tmp = $CAT['htmlize'];
		$CAT['htmlize'] = 0;
	}
	$page_url = p8_url($this_module, $CAT, 'list', false);
	$CAT['htmlize'] = $tmp;
	
	$page_urls = $selected_fields = array();
	
	$field_filter = false;

	$orderby = empty($CAT['CONFIG']['orderby']) ? 'i.timestamp' : 'i.'.$CAT['CONFIG']['orderby'];	 
	$desc = empty($CAT['CONFIG']['orderby_desc']) ? ' DESC' : ' ASC';
	$orderby = $orderby == 'i.level' ? 'i.level'.$desc.',i.timestamp'.$desc : $orderby.$desc;

	$select_param['order'] = array(
		$orderby
	);
	
	if (! empty($this_model['filterable_fields'])) {
		// 可过滤的自定义字段处理
		foreach ($URL_PARAMS as $k => $v) {
			
			if (empty($this_model['filterable_fields'][$v]))
				continue;
			
			$field = $this_model['filterable_fields'][$v];
			
			switch ($field['type']) {
				
				case 'tinyint':
				case 'smallint':
				case 'mediumint':
				case 'int':
				case 'bigint':
					
					switch ($field['widget']) {
						
						case 'input':
						case 'select':
						case 'radio':
							$value = isset($URL_PARAMS[$k + 1]) ? intval($URL_PARAMS[$k + 1]) : null;
							$select_param['in']['i.' . $v] = array(
								'i.' . $v,
								$value
							);
							$selected_fields[$v] = $PAGE_CACHE_PARAM[$k] = $value;
							$field_filter = true;
							break;
					}
					
					break;
				
				case 'decimal':
				case 'float':
					
					switch ($field['widget']) {
						
						case 'input':
						case 'select':
						case 'radio':
							$value = isset($URL_PARAMS[$k + 1]) ? floatval($URL_PARAMS[$k + 1]) : null;
							
							$select_param['in']['i.' . $v] = array(
								'i.' . $v,
								$value
							);
							$selected_fields[$v] = $PAGE_CACHE_PARAM[$k] = $value;
							$field_filter = true;
							break;
					}
					break;
			}
		}
		
		$keyword = isset($_GET['keyword']) ? html_entities(trim($_GET['keyword'])) : '';
		if ($keyword != '') {
			$PAGE_CACHE_PARAM['NO_CACHE'] = 1;
			$select_param['search'] = array(
				'i.title',
				$keyword
			);
			$field_filter = true;
		}
	}
} else {
	
	page_cache($PAGE_CACHE_PARAM);
	
	//尝试读缓存
	$category->get_cache();	
	if(empty($category->categories)){
		$category->get_cache(false);
	}
	//读不到缓存，生成后读
	if(empty($category->categories)){
		require_once PHP168_PATH .'inc/cache.func.php';
		cache_label();
		$category->cache();
		$category->get_cache();
	}
	// 父分类
	$parent_cats = $category->get_parents($cid);
	// 子分类
	$subcategories = array();
	if (isset($category->categories[$cid]['categories'])) {
		$subcategories = $category->categories[$cid]['categories'];
		$CATEGORY = $category->get_children_ids($cid) + array(
			$cid
		);
	}
}

// print_R($page_urls);
// ----------------------------------------------------------
// 模型自定义脚本
if (! $CAT['list_all_model'])
	require $this_model['path'] . 'list.php';
	// ----------------------------------------------------------

if ($CAT['type'] == 2) {
	
	if (! empty($this_model['filterable_fields'])) {
		
		// ---------------------------------------------------------------{
		
		$CAT['filter'] = '{filter}';
		$CAT['htmlize'] = 0;
		$this_module->CONFIG['dynamic_list_url_rule'] = str_replace('{$id}', '{$id}{$filter}', $this_module->CONFIG['dynamic_list_url_rule']);
		$_page_url = p8_url($this_module, $CAT, 'list', false);
		
		$filter = '';
		foreach ($selected_fields as $field => $value) {
			$filter .= '-' . $field . '-' . $value;
		}
		$page_url = str_replace('{filter}', $filter, $_page_url);
		$_page_url = preg_replace('/#[^#]+#/', '', $_page_url);
		
		$form_url = preg_replace('/#[^#]+#/', '', $page_url);
		if ($keyword != '') {
			$_page_url .= '?keyword=' . urlencode($keyword);
		}
		// print_r($selected_fields);
		
		// 各字段的过滤链接
		foreach ($this_model['filterable_fields'] as $field => $field_data) {
			// 取消过滤链接(全部)
			$page_urls[$field][''] = '';
			
			foreach ($selected_fields as $_field => $_value) {
				if ($_field == $field)
					continue;
				
				$page_urls[$field][''] .= '-' . $_field . '-' . $_value;
			}
			
			$page_urls[$field][''] = str_replace('{filter}', $page_urls[$field][''], $_page_url);
			
			foreach ($field_data['data'] as $value => $key) {
				$page_urls[$field][$value] = '';
				
				foreach ($selected_fields as $_field => $_value) {
					if ($_field == $field)
						continue;
					
					$page_urls[$field][$value] .= '-' . $_field . '-' . $_value;
				}
				
				$page_urls[$field][$value] .= '-' . $field . '-' . $value;
				
				$page_urls[$field][$value] = str_replace('{filter}', $page_urls[$field][$value], $_page_url);
			}
		}
		
		// ---------------------------------------------------------------}
	}
	
	// 当前分类的内容数
	$count = $field_filter ? 0 : $CAT['item_count'];
	
	$select = select();
	
	//尝试读缓存
	$category->get_cache();	
	if(empty($category->categories)){
		$category->get_cache(false);
	}
	//读不到缓存，生成后读
	if(empty($category->categories)){
		require_once PHP168_PATH .'inc/cache.func.php';
		cache_label();
		$category->cache();
		$category->get_cache();
	}
	// 父分类
	$parent_cats = $category->get_parents($cid);
	
	// 子分类
	$subcategories = array();
	if (isset($category->categories[$cid]['categories'])) {
		$subcategories = $category->categories[$cid]['categories'];
		$CATEGORY = $category->get_children_ids($cid) + array(
			$cid
		);
	} else {
		$CATEGORY = $cid;
	}
	
	$select->in('i.cid', $CATEGORY);
	
	// print_R($select_param);
	foreach ($select_param as $func => $param) {
		// $select->$func($param);
		switch ($func) {
			
			case 'in':
				foreach ($param as $field => $_param) {
					call_user_func_array(array(
						&$select,
						$func
					), $_param);
				}
				break;
			
			case 'range':
				foreach ($param as $field => $_param) {
					call_user_func_array(array(
						&$select,
						$func
					), $_param);
				}
				break;
			
			default:
				call_user_func_array(array(
					&$select,
					$func
				), $param);
				break;
		}
	}
	//开启角色浏览权限控制
	if($this_module->CONFIG['authority'] && $ROLE){		
		$select->where("(authority = '' or find_in_set($ROLE,authority))");
		$sql = "SELECT COUNT(1) as `count` FROM $this_module->table WHERE cid = '$cid' and (authority = '' or find_in_set($ROLE,authority))";
		$c3 = $core->DB_master->fetch_one($sql);
		$count= intval($c3['count']);
	}
	$select->left_join("{$this_module->TABLE_}digg AS s",'s.digg,s.trample','s.iid=i.id');
	//INNER JOIN $this_module->addon_table AS a ON i.id = a.iid
	$select->left_join("{$this_module->addon_table} AS a",'a.content','i.id=a.iid');
	// print_r($this_model);
	//echo $select->build_sql();
	
	$sphinx = $this_module->CONFIG['sphinx'];
	$sphinx['index'] = $this_system->sphinx_indexes(array(
		$MODEL => 1
	));
	
	$title_length = empty($CAT['CONFIG']['list_title_length']) ? 120 : $CAT['CONFIG']['list_title_length'];
	if ($core->ismobile)
		$title_length = empty($CAT['CONFIG']['list_title_length_mobile']) ? 20 : $CAT['CONFIG']['list_title_length_mobile'];
	$dot = empty($CAT['CONFIG']['title_dot']) ? '' : '...';

	$list = $core->list_item($select, array(
		'count' => &$count,
		'page' => &$page,
		'page_size' => $CAT['page_size'],
		'sphinx' => $sphinx
	));
	$core_config = $core->get_config('core','');
	$main_domain = $core_config['static_enable'] && $core_config['static_url'] ? $core_config['static_url'] : $core->url;
	foreach ($list as $k => $v) {
        @$list[$k]['timestamp'] = $v['TIMESTAMP']?:$v['timestamp'];
		$v['#category'] = &$category->categories[$v['cid']];
		$v['url'] = attachment_url($v['url']);
		$v_config = isset($v['config']) ? mb_unserialize(stripslashes($v['config'])) : array();
		if(empty($v['url']) && $v_config['allow_ip']['enabled'] >= 1 && $core_config['static_enable'] && $core_config['static_url']){
			$list[$k]['url'] = $main_domain.'/index.php/cms/item-view-id-'.$v['id'].'.html';
		}else{
			$list[$k]['url'] = p8_url($this_module, $v, 'view');
		}
		$list[$k]['url'] = $v['#category']['allow_ip_enabled'] >= 1 ? $main_domain.'/index.php/cms/item-view-id-'.$v['id'].'.html' : $list[$k]['url'];
		//权限控制下使用动态
		if(!empty($v_config['authority_viewer']) || (!empty($v['authority'])  && !in_array('0',explode(',',$v['authority'])))
			|| !empty($category->categories[$v['cid']]['authority_viewer']) ||
			(!empty($category->categories[$v['cid']]['authority']) && !in_array('0',$category->categories[$v['cid']]['authority']))
		){
			$list[$k]['url'] = $main_domain.'/index.php/cms/item-view-id-'.$v['id'].'.html';
		}		
		$list[$k]['frame'] = attachment_url($v['frame']);
		//启用相对地址时
		if($v['#category']['attachment_type'] && $list[$k]['frame']){
			$list[$k]['frame'] = str_replace($core->url,'',$list[$k]['frame']);
			if($core->CONFIG['static_attachment_url']){
				$list[$k]['frame'] = str_replace($core->CONFIG['static_attachment_url'],'',$list[$k]['frame']);
			}
			$list[$k]['frame'] = P8_ROOT. str_replace($RESOURCE,'',$list[$k]['frame']);
			$list[$k]['frame'] = str_replace('//attachment','/attachment',$list[$k]['frame']);
		}
		$list[$k]['full_title'] = $v['title'];
		$list[$k]['title'] = p8_cutstr($v['title'], $title_length, $dot);
		$tmp = explode('|', $v['sub_title']);
		$list[$k]['sub_title'] = $tmp[0];
		$list[$k]['sub_title_url'] = isset($tmp[1]) ? $tmp[1] : '';
		$list[$k]['summary'] = html_entity_decode($v['summary']);
		$list[$k]['summary'] = preg_replace('/(amp;)+/', '', $list[$k]['summary']);
		// 分类名称
		$list[$k]['category_name'] = $v['#category']['name'];
		// 分类URL
		$list[$k]['category_url'] = $v['#category']['url'];
		//分类封面
		$list[$k]['category_frame'] = attachment_url($v['#category']['frame']);
		if (! empty($v['title_color']))
			$list[$k]['title'] = '<font color="' . $v['title_color'] . '">' . $list[$k]['title'] . '</font>';
		if (! empty($v['title_bold']))
			$list[$k]['title'] = '<b>' . $list[$k]['title'] . '</b>';
	}
	
	$page_template = ! empty($CAT['CONFIG']['list_pages_template']) && isset($P8LANG[$CAT['CONFIG']['list_pages_template']]) ? $P8LANG[$CAT['CONFIG']['list_pages_template']] : '';
	if ($core->ismobile)
		$page_template = ! empty($CAT['CONFIG']['list_pages_template_mobile']) && isset($P8LANG[$CAT['CONFIG']['list_pages_template_mobile']]) ? $P8LANG[$CAT['CONFIG']['list_pages_template_mobile']] : '';
	$pages = list_page(array(
		'count' => $count,
		'page' => $page,
		'page_size' => $CAT['page_size'],
		'url' => $page_url,
		'template' => $page_template
	));
}

// 同级分类
$siblings = $category->get_siblings($cid);
// 初始化标签
$LABEL_POSTFIX = array();
$ENV = $core->ismobile ? 'mobile' : '';
// 如果分类有自己的标签后缀
if (! empty($CAT['label_postfix']))
    array_push($LABEL_POSTFIX, $CAT['label_postfix']);

$LINKRSS = array(
    'title' => $core->CONFIG['site_name'] . ' - ' . $CAT['name'],
    'url' => $this_system->controller . '/item-rss-category-' . $CAT['id']
);
// 随机数
$rand = rand_str(4);
// 每行的宽度,用于多列
$width = '99%';

$TITLE = $SEO_KEYWORDS = $SEO_DESCRIPTION = '';

$title_style = empty($CAT['CONFIG']['title_style']) ? 0 : $CAT['CONFIG']['title_style'];
switch ($title_style) {
    case 2:
        $TITLE = $CAT['name'];
        break;
    default:
    case 3:
        $TITLE = $CAT['name'] . '_' . $core->CONFIG['site_name'];
        break;
}
//标题重置
if($CAT['type'] != 4) unset($data['title']);
// 若已开启移动设备样式，且是移动设备，则用移动模板
if ($core->ismobile)
    $CAT['list_template'] = $CAT['list_template_mobile'];
    
    // 自定义的分类列表页模板
include template($this_module, $CAT['list_template']);
// 保存页面缓存
page_cache();
