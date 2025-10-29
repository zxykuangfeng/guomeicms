<?php
defined('PHP168_PATH') or die();

$this_system->check_manager($ACTION) or message('no_privilege');
$data = array();
if(isset($_REQUEST['model'])){
	$this_system->init_model();
	$data['cid'] = isset($_REQUEST['cid']) ? intval($_REQUEST['cid']) : '';
	$data['type'] = isset($_REQUEST['type']) ? intval($_REQUEST['type']) : '';
	if($data['cid'] && !$this_controller->check_category_action('add', $data['cid'])) message($P8LANG['sites_item']['no_category_privilege']);
	
	$this_model or message('no_such_sites_model');
	
	$this_model['enabled'] or message('sites_model_disabled');
	
	if($data['type']==4){
		$page_id = $this_module->get_page($data['cid'],$MODEL);
		if($page_id){
			header('Location:'.$this_router.'-update?model='.$MODEL.'&id='.$page_id['id']);
			exit;
		}
			
	}
	if($data['cid']) $CAT = $this_system->fetch_category($data['cid']);
}else{
	$category = &$this_system->load_module('category');
	$category->get_cache(false);
	$path = array();
	$models = $this_system->get_models();
	foreach($category->categories as $v){
		$parents = $category->get_parents($v['id']);
		foreach($parents as $vv){
			$path[$v['id']][] = $vv['id'];
		}
		$path[$v['id']][] = $v['id'];
	}

	$json = array(
		'json' => p8_json($category->top_categories),
		'path' => p8_json($path),
		'models' => p8_json($models)
	);
	
	include template($this_module, 'select_model', 'admin');
	
	exit;
}
if(REQUEST_METHOD == 'GET'){
	if(isset($_GET['url']) && $_GET['url']){
		$url = htmlspecialchars_decode($_GET['url']);	
		$content = $this_module->crawByUrl($url);
		$content_html = $data['content'] = $content['content_html'];	
		$data['content'] or message('craw_fail');
		$data['crawByUrl'] = $url;
		$data['title'] = trim($content['title']);
		$data['author'] = trim($content['author']);
		$data['content'] = $this_module->clearHtml($data['content']);		
		$data['frame'] = $content['frame'] ? $content['frame'] : '';	
		$data['timestamp_date'] = !empty($content['date']) ? date('Y-m-d H:i:s',$content['date']) : '';		
		$data['timestamp'] = !empty($content['date']) ? $content['date'] : '';
		$data['summary'] = $content['summary'];
	}
	$my_addible_category = p8_json($this_controller->get_acl('my_addible_category'));	
	$site_info = $this_system->get_site($this_system->SITE);
	$independent_verify = !empty($site_info['config']['independent_verify']) ? true : false;	
	$allow_verify = $this_controller->check_admin_action('verify','',$independent_verify);
	$allow_attribute = $this_controller->check_admin_action('attribute');
	$allow_level = $this_controller->check_admin_action('level');
	//$allow_create_time = $this_controller->check_admin_action('create_time');
	$allow_create_time = true;
	$allow_set_views = $this_controller->check_admin_action('setviews');
	//浏览权限
	$authority = $authority_viewer = array();
    $authority_enable = $this_module->CONFIG['authority'];
    if($authority_enable) $core->get_cache('role');
	//预留字段
	$custom = array('custom_a','custom_b','custom_c','custom_d','custom_e','custom_f','custom_g','custom_h','custom_i','custom_j');	
	$attributes = array();
	$uploader_config = $core->get_config('core','uploader');
	$thumb_width = $uploader_config['thumb']['width'] ? intval($uploader_config['thumb']['width']) : 0;
	$thumb_height = $uploader_config['thumb']['height'] ? intval($uploader_config['thumb']['height']) : 0;
	$file = $this_model['path'] .'admin/add.php';
	if(!is_file($file)){
		$file = str_replace('/'.$MODEL.'/','/article/',$file);
	}
	require $file;
	
	$template = empty($this_model['CONFIG']['admin_edit_template']) ? 'edit' : $this_model['CONFIG']['admin_edit_template'];
	$item_config = $core->get_config($this_system->name, $this_module->name);
	$core_config = $core->get_config('core', '');
	$allow_filter_word = $core_config['filter_word_enable'] ? true : false;
	$allow_content_censor = $core_config['content_censor_enabled'] ? true : false;
	$allow_censor_default = $core_config['content_censor_default'] ? true : false;
	//敏感词勾选权限
	$filter_word_enabled = $this_controller->check_admin_action('filter_word');
	$content_censor_enabled = $this_controller->check_admin_action('content_censor');
	$cms_system = $core->load_system('cms');	
	include template($this_module, $template, 'admin');
	
}else if(REQUEST_METHOD == 'POST'){
	
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	$site_info = $this_system->get_site($this_system->SITE);
	$independent_verify = !empty($site_info['config']['independent_verify']) ? true : false;
	if(!$this_controller->check_admin_action('verify','',$independent_verify)){
		unset($_POST['verify']);
	}
	unset($_POST['attribute'][10],$_POST['attribute'][11]);
	$_POST['verifier']='';
	//检查分类自动审核权限
	$mysites = $this_system->get_manage_sites();
	if($independent_verify){
		if($this_controller->check_category_action('autoverify', $_POST['cid'],'',$independent_verify) &&  in_array($this_system->SITE, $mysites)){
			$_POST['verify'] = 1;
			$_POST['verifier'] = $USERNAME;
		}
	}else{
		if($this_controller->check_category_action('autoverify', $_POST['cid'],'',$independent_verify) ||  in_array($this_system->SITE, $mysites)){
			$_POST['verify'] = 1;
			$_POST['verifier'] = $USERNAME;
		}
	}
	$_POST['verify'] = !empty($_POST['drafts_release']) ? 0 : $_POST['verify'];
	//浏览量
	if(!$this_controller->check_category_action('setviews', $_POST['cid'])){
		unset($_POST['views']);
	}
	$file = $this_model['path'] .'admin/add.php';
	if(!is_file($file)){
		$file = str_replace('/'.$MODEL.'/','/article/',$file);
	}
	require $file;
	$ADMIN_LOG = array('title' => $P8LANG['_module_add_admin_log']);
	
	//分页
	$content = array();
	if(isset($_POST['field#']['content'])){
		$content = preg_split('#<div style="page-break-after:\s*?always;?">\s*?<span style="display: none;?">.*?</span>\s*?</div>#is', $_POST['field#']['content']);
		
		$_POST['field#']['content'] = array_shift($content);
	}
	if(!isset($_POST['cid']) || empty($_POST['cid'])) message('category_need');
	//防止重复提交
	if($core->CONFIG['repeatable']){
		$last_post = P8_TIME - 10;
		$last_post2 = P8_TIME - 60;
		$post_cid = $_POST['cid'];
		$title = $_POST['title'];
		$lastfile_list = $core->DB_master->fetch_one("select * from `$this_module->table` where (`timestamp` >= '$last_post' or (`timestamp` >= '$last_post2' and `title` = '$title')) and `cid` = $post_cid and `uid` = $UID order by `id` desc limit 0,1");
		if(!empty($lastfile_list)) message('post_rule');
	}
	//大分类不允许发布信息
	$category_module = $this_system->load_module('category');	
	$category_module->get_cache();
	if($category_module->categories[$_POST['cid']]['type'] == 1) message('category_post_rule');
	$models = $this_system->get_models();
	$model = isset($_POST['model']) ? xss_clear($_POST['model']) : '';
	if($model && !array_key_exists($model,$models)){
		message('fail');
	}
	$id = $this_controller->add($_POST) or message('fail');
	foreach($content as $v){
		$_POST['field#']['content'] = $v;
		$_POST['iid'] = $id;
		$_POST['action'] = 'addon';
		$this_controller->addon($_POST);
	}
	$this_system->log(array(
		'title' => $P8LANG['_module_add_admin_log'],
		'request' => $_POST,
	));
	$view_url = $this_module->controller; 
	if($core->CONFIG['static_enable'] && $core->STATIC_URL){
		$view_url = $core->STATIC_URL.'/s.php/'.$this_system->SITE.'/item';
	}	
	$data = $this_module->data('read', $id);
	$data['#category'] = $this_system->fetch_category($data['cid'],true);
	$static_view_url = $this_system->site_p8_url($this_module, $data, 'view');
	$flag = !empty($_POST['drafts_release']) ? '&verified=0' : '&verified=1';
	//静态首页
	$form = '';
	if(empty($_POST['drafts_release']) && isset($this_module->CONFIG['sync_index_to_html']) && $this_module->CONFIG['sync_index_to_html']){
		$form = '<form action="'.$this_system->admin_controller.'-index_to_html" method="post" id="'. $this_system->SITE .'" target="'. $this_system->SITE .'">'.
			'<input type="hidden" name="'.$this_system->SITE.'">'.
			'<input type="hidden" name="site" value="'.$this_system->SITE.'">'.
			'</form>'.
			'<iframe style="display: none;" name="'. $this_system->SITE .'"></iframe>'.
			'<script type="text/javascript">document.getElementById("'. $this_system->SITE .'").submit();</script>';
	}
	//静态化列表和内容本身
	if(empty($_POST['drafts_release']) && $_POST['html']){
		$form .= '<form action="'.$this_module->admin_controller.'-view_list_to_html" method="post" id="__html_vlist__" target="__html_vlist__">'.
			'<input type="hidden" name="action" value="add" />'.
			'<input type="hidden" name="site" value="'.$this_system->SITE.'">'.
			'<input type="hidden" name="id" value="'.$id.'" />'.
			'<input type="hidden" name="cid" value="'.$_POST['cid'].'" /></form>'.
			'<iframe style="display: none;" name="__html_vlist__"></iframe>'.
			'<script type="text/javascript">$("#__html_vlist__").submit();</script>';
	}
	//还要推送到总站
	if(!empty($_POST['cluster_push_cid']) && intval($_POST['cluster_push_cid'])){
		$form .= '<form action="'.$this_router.'-cluster_push" method="post" id="__cluster_push__" target="__cluster_push__">'.
			'<input type="hidden" name="id" value="'.$id.'" />'.
			'<input type="hidden" name="cid" value="'.intval($_POST['cluster_push_cid']).'"></form>'.
			'<iframe style="display: none;" name="__cluster_push__"></iframe>'.
			'<script type="text/javascript">$("#__cluster_push__").submit();</script>';			
	}
	if(!empty($_POST['drafts_release'])){
		message(
			array(
				array($P8LANG['sites_to_edit'].$form, $this_module->admin_controller .'-update?id='. $id .'&model='. $model.'&verified=0'),
				array('sites_to_list', $this_module->admin_controller .'-list?cid='. $_POST['cid'].'&model='. $model),			
				array('sites_to_view_dynamic', $core->STATIC_URL.'/s.php/'.$this_system->SITE.'/item-view-id-'.$id .'?verify='. $_POST['verify'].'&verified=0', '_blank'),
				array('sites_to_add', $this_module->admin_controller .'-add?cid='. $_POST['cid']. '&model='. $model.'&type='.$category_module->categories[$_POST['cid']]['type'])
			),
			$this_module->admin_controller .'-add?cid='. $_POST['cid'] .'&model='. $model.'&type='.$category_module->categories[$_POST['cid']]['type'],
			10000
		);
	}else{
		$flag = $flag == '&verified=1' ? '' : $flag;
		message(
			array(
				array($P8LANG['sites_to_edit'].$form, $this_module->admin_controller .'-update?id='. $id .'&model='. $model.$flag),
				array('sites_to_list', $this_module->admin_controller .'-list?cid='. $_POST['cid'].'&model='. $model),			
				array('sites_to_view', $static_view_url.'?verify='. $_POST['verify'].$flag, '_blank'),
				array('sites_to_view_dynamic', $core->STATIC_URL.'/s.php/'.$this_system->SITE.'/item-view-id-'.$id .'?verify='. $_POST['verify'].$flag, '_blank'),
				array('sites_to_add', $this_module->admin_controller .'-add?cid='. $_POST['cid']. '&model='. $model.'&type='.$category_module->categories[$_POST['cid']]['type'])
			),
			$this_module->admin_controller .'-add?cid='. $_POST['cid'] .'&model='. $model.'&type='.$category_module->categories[$_POST['cid']]['type'],
			10000
		);
	}
	
}
