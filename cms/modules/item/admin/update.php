<?php
defined('PHP168_PATH') or die();

/**
* 修改内容
**/

$this_controller->check_admin_action($ACTION) or message('no_privilege');

$this_system->init_model();
$this_model or message('no_such_cms_model');
$this_model['enabled'] or message('cms_model_disabled');

$allow_verify = $this_controller->check_admin_action('verify');
$allow_attribute = $this_controller->check_admin_action('attribute');
$allow_level = $this_controller->check_admin_action('level');
//$allow_create_time = $this_controller->check_admin_action('create_time');
$allow_create_time = true;
$allow_set_views = $this_controller->check_admin_action('setviews');
if(REQUEST_METHOD == 'GET'){
	
	$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	$id or message('no_such_item');

	if(isset($_GET['verified'])){
		$verified = $_GET['verified'] == 1 ? true : false;
	}else{
		$verified = true;
	}
	$verified_adr = $verified;
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
	}else{
		if($verified){
			
			$select = select();
			$select->from($this_module->main_table .' AS m', 'm.*');
			$select->inner_join($this_module->table .' AS i', 'i.*', 'i.id = m.id');
			$select->inner_join($this_module->addon_table .' AS a', 'a.*, a.iid AS id', 'm.id = a.iid');
			$select->in('i.id', $id);
			$select->in('a.page', 1);
			
			$data = $core->select($select, array('single' => true, 'ms' => 'master'));
			$data or message('no_such_item');
			
		}else{
			
			$select = select();
			$select->from($this_module->unverified_table, 'verified, pages, data');
			$select->in('id', $id);
			$_data = $core->select($select, array('single' => true, 'ms' => 'master'));
			$_data or message('no_such_item');
			
			$verified = $_data['verified'];
			$pages = $_data['pages'];
			$_data = mb_unserialize($_data['data']);
			$_data['item']['create_time_release'] = $_data['create_time_release'] ? 1:0;
			$data = array_merge($_data['addon'], $_data['item'], $_data['main']);
			$data['pages'] = $pages;
			$data['verified'] = $verified;
			unset($_data);
			//print_r($_data);
		}
	}
	//echo $select->build_sql();
	
	//检查权限
	if($data['uid'] != $UID){
		$this_controller->check_category_action('update', $data['cid']) or message($P8LANG['cms_item']['no_category_privilege']);
	}
	if($this_module->CONFIG['allow_verify'] && $verified_adr && !$allow_verify){
		message($P8LANG['cms_item']['no_category_update_privilege']);
	}
	$my_addible_category = p8_json($this_controller->get_acl('my_addible_category'));
	
	
	$this_module->format_data($data);
	$data['list_order_date'] = date('Y-m-d H:i:s', $data['list_order']);
	$data['timestamp_date'] = date('Y-m-d H:i:s', $data['timestamp']);
	$data['level_date'] = $data['level_time'] > 0 ? date('Y-m-d H:i:s', $data['level_time']) : 0;
	
	//内容属性
	$data['attributes'] = array_flip(explode(',', $data['attributes']));
	$data['summary'] = html_entity_decode($data['summary']);	
	//启用相对地址时
	$postcat = $this_system->fetch_category($data['cid']);
	if($postcat['CONFIG']['attachment_type']){
		$static_attachment_url = $core->CONFIG['static_attachment_url'] ? $core->CONFIG['static_attachment_url'] : $core->url;		
		if($data['frame']){
			$data['frame'] = substr($data['frame'],0,1) == '/' ? $static_attachment_url. $data['frame'] : $data['frame'];
		}			
		if($data['verify_frame']){
			$data['verify_frame'] = substr($data['verify_frame'],0,1) == '/' ? $static_attachment_url. $data['verify_frame'] : $data['verify_frame'];
		}
		if($data['attachment_pdf']){
			$data['attachment_pdf'] = substr($data['attachment_pdf'],0,1) == '/' ? $static_attachment_url. $data['attachment_pdf'] : $data['attachment_pdf'];
		}
		$data['content'] = str_replace('src="/attachment/','src="'.$static_attachment_url.'/attachment/',$data['content']);
	}				

	$config = mb_unserialize(stripslashes($data['config']));
    
    $config['allow_ip']['enabled'] = isset($config['allow_ip']['enabled']) ? $config['allow_ip']['enabled'] : 0;
	$config['allow_ip']['collectip'] = isset($config['allow_ip']['collectip']) ? $config['allow_ip']['collectip'] : array();
	$config['allow_ip']['area_ip'] = isset($config['allow_ip']['area_ip']) ? $config['allow_ip']['area_ip'] : array();
	$config['allow_ip']['ruleoutip'] = isset($config['allow_ip']['ruleoutip']) ? $config['allow_ip']['ruleoutip'] : array();
	$select = select();
	$select->from($this_module->attribute_table. ' AS a', 'a.aid, a.timestamp, a.last_setter');
	$select->in('a.id', $id);
	$_attributes = $core->list_item(
		$select,
		array(
			'page' => 0
		)
	);
	$attributes = array();
	foreach($_attributes as $v){
		$attributes[$v['aid']] = $v;
	}
	unset($_attributes);
	
	$data['iid'] = $data['id'];
	$page_url = $this_router .'-update_addon?model='. $MODEL .'&iid='. $data['id'] .'&verified='. $verified .'&page=?page?';
	
	$pages = list_page(array(
		'count' => $data['pages'],
		'page' => 1,
		'page_size' => 0,
		'url' => $page_url
	));	
	//预留字段
	$custom = array('custom_a','custom_b','custom_c','custom_d','custom_e','custom_f','custom_g','custom_h','custom_i','custom_j');	
	$uploader_config = $core->get_config('core','uploader');
	$thumb_width = $uploader_config['thumb']['width'] ? intval($uploader_config['thumb']['width']) : 0;
	$thumb_height = $uploader_config['thumb']['height'] ? intval($uploader_config['thumb']['height']) : 0;
    //浏览权限
	$authority_enable = $this_module->CONFIG['authority'];
	$authority = $authority_viewer = array();
    if($authority_enable) {
		$core->get_cache('role');
		//用户组
		$authority = $data['authority'] ? explode(",",$data['authority']) : array();
		//用户
		if(!empty($config['authority_viewer'])){
			$authority_viewers = implode(',',$config['authority_viewer']);
			$member = &$core->load_module('member');
			$authority_viewer = $core->DB_master->fetch_all("SELECT id,username FROM {$member->table} WHERE id IN ($authority_viewers)");
		}
	}   
	require $this_model['path'] .'/admin/update.php';
	$template = empty($this_model['CONFIG']['admin_edit_template']) ? 'edit' : $this_model['CONFIG']['admin_edit_template'];
	$item_config = $core->get_config($this_system->name, $this_module->name);
	$core_config = $core->get_config('core', '');
	$allow_filter_word = $core_config['filter_word_enable'] ? true : false;
	$allow_content_censor = $core_config['content_censor_enabled'] ? true : false;
	$allow_censor_default = $core_config['content_censor_default'] ? true : false;
	//敏感词勾选权限
	$filter_word_enabled = $this_controller->check_admin_action('filter_word');
	$content_censor_enabled = $this_controller->check_admin_action('content_censor');
	include template($this_module, $template, 'admin');

}else if(REQUEST_METHOD == 'POST'){
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	//计划任务检测
	if($_POST['check_item_post_release']){
		$crontab = $core->load_module('crontab');
		exit(p8_json($crontab->check_status('cms_item_post_release.php')));
	}	
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$this_cid = isset($_POST['cid']) ? intval($_POST['cid']) : 0;
	$id or message('no_such_item');
	//大分类不允许发布信息
	$category_module = $this_system->load_module('category');	
	$category_module->get_cache();
	if($category_module->categories[$_POST['cid']]['type'] == 1) message('category_post_rule');
	
	if(!$this_controller->check_admin_action('verify')){
		unset($_POST['verify']);
	}
	$_POST['verify'] = $this_controller->check_category_action('autoverify', $_POST['cid']) ? 1 : 0;	
	$data = $this_module->data('read', $id);
	if(empty($data)){
		$data = $this_module->data_unverified($id);
		$_POST['verify'] = $data['uid'] != $UID ? 0 : $_POST['verify'];
	}
	global $UID;
	$My_UID = $UID;//存UID
	//浏览量
	$_POST['views'] = $this_controller->check_category_action('setviews', $_POST['cid']) ? intval($_POST['views']) : $data['views'];
	if(isset($_POST['verified'])){
		$verified = $_POST['verified'] == 1 ? true : false;
	}else{
		$verified = true;
	}
	$verified = !empty($_POST['drafts_release']) ? false : $verified;
	require $this_model['path'] .'/admin/update.php';
	$ADMIN_LOG = array('title' => $P8LANG['_module_update_admin_log']);		
	$models = $this_system->get_models();
	$model = isset($_POST['model']) ? xss_clear($_POST['model']) : '';
	if($model && !array_key_exists($model,$models)){
		message('fail');
	}
	$this_controller->update($id, $_POST, $verified) or message('fail');
	/*签发源数据删除，签发数据同步删除*/
	$clone_ids = $this_module->get_clone_ids($id);
	if(count($clone_ids)>1){		
		$UID = empty($UID) ? $My_UID : $UID;//强制修复UID
		$src_post = $_POST;
		foreach($clone_ids as $tid){
			if($tid == $id) continue;
			$get_clone_item = $this_module->data('read', $tid);
			if(empty($get_clone_item)) continue;
			//去除不修改的数据项
			unset($src_post['level_time'],$src_post['creat_time'],$src_post['template']);
			//保留项	
			$src_post['list_order'] = $src_post['timestamp'] = date('Y-m-d H:i:s', $get_clone_item['timestamp']);
			$src_post['attribute'] = $this_module->get_attributes($tid);
			$src_post['id'] = $get_clone_item['id'];
			$src_post['iid'] = $get_clone_item['iid'];
			$src_post['level'] = $get_clone_item['level'];
			$src_post['views'] =  $get_clone_item['views'];
			$src_post['cid'] = $get_clone_item['cid'];
			$this_controller->update($tid, $src_post, true);
			//强制修正时间
			$DB_master->update(
				$this_module->main_table,
				array('timestamp'=>$get_clone_item['timestamp']),
				"id = '$tid'"
			);
			$DB_master->update(
				$this_module->table,
				array('timestamp'=>$get_clone_item['timestamp']),
				"id = '$tid'"
			);
		}
	}
	/*
	* 针对子站推送数据给总站时，当总站修改数据时，能同步修改分站相应数据
	*/
	if($this_module->CONFIG['cms_to_sites_connect']){
		$systems = $core->list_systems();
		if(isset($systems['sites']) && $systems['sites']['installed'] && $systems['sites']['enabled']){
			$stop_table = $core->TABLE_.'sites_stop_data';
			$new_data = $DB_master->fetch_one("select item_id,model,cid,site from $stop_table where `new_id` = $id");
			if(!empty($new_data)){
				$item_id = $new_data['item_id'];		
				$this_sites = $core->load_system('sites');
				$org_site = $this_sites->SITE;
				$this_sites->init_model();
				$item = $this_sites->load_module('item');
				$read_data = $item->data('read', $item_id);
				$_POST['cid'] = $read_data['cid'];
				$controller = $core->controller($item);	
				$item->set_model($new_data['model']);
				$datas = $_POST;
				$datas['verify'] = 1;
				$this_sites->load_site($new_data['site']);
				$system_tmp = $this_system;
				$this_system = $this_sites;				
				require $this_model['path'] .'/admin/update.php';
				$controller->update($item_id, $datas, true,true);				
				if($org_site && $org_site != $new_data['site']) $this_sites->load_site($org_site);
				$this_system = $system_tmp;
			}
		}
	}
	$_POST['cid'] = $this_cid;//强势回归
	$data['#category'] = $this_system->fetch_category($data['cid'],true);
	$data['timestamp'] = strtotime($_POST['timestamp']);
	$static_view_url = p8_url($this_module, $data, 'view');
	$_POST['verify'] = !empty($_POST['drafts_release']) ? 0 : $_POST['verify'];
	$verified = $_POST['verify'] ? true : false;
    $verified = !empty($_POST['create_time_release']) && (!empty($_POST['timestamp']) && strtotime($_POST['timestamp']) > P8_TIME)  ? 66 : ($verified ? 1 : 0);
	$verified = !empty($_POST['drafts_release']) ? 77 : $verified;
	//静态首页
	$form = '';
	if(isset($this_module->CONFIG['sync_index_to_html']) && $this_module->CONFIG['sync_index_to_html'] && ($verified || $_POST['verified'] == 1)){
	$form = '<form action="'.$this_system->admin_controller.'-index_to_html" method="post" id="__reflash_index__" target="__reflash_index__">'.
			'<input type="hidden" name="type" value="index_to_html" /></form>'.
			'<iframe style="display: none;" name="__reflash_index__"></iframe>'.
			'<script type="text/javascript">$("#__reflash_index__").submit();</script>';
	}
	//静态化列表和内容本身
	if(($verified || $_POST['verified'] == 1) && $_POST['html']){
		$form .= '<form action="'.$this_module->admin_controller.'-view_list_to_html" method="post" id="__html_vlist__" target="__html_vlist__">'.
			'<input type="hidden" name="action" value="update" />'.
			'<input type="hidden" name="id" value="'.$id.'" />'.
			'<input type="hidden" name="cid" value="'.$_POST['cid'].'" /></form>'.
			'<iframe style="display: none;" name="__html_vlist__"></iframe>'.
			'<script type="text/javascript">$("#__html_vlist__").submit();</script>';
	}
	if(!empty($_POST['drafts_release'])){
		message(
			array(
				array($P8LANG['cms_to_edit'].$form, $this_module->admin_controller .'-update?id='.$id.'&model='.$model.'&verified='.$verified),
				array('cms_to_list', $this_module->admin_controller .'-list?cid='.$_POST['cid'].'&model='.$model),
				array('cms_to_view_dynamic', $core->STATIC_URL.'/index.php/cms/item-view-id-'.$id .'?verified='. $_POST['verify'], '_blank'),
				array('cms_to_add', $this_module->admin_controller .'-add?cid='.$_POST['cid'].'&model='.$model.'&type='.$category_module->categories[$_POST['cid']]['type'])
			),
			$this_module->admin_controller .'-add?cid='. $_POST['cid'] .'&model='. $model.'&type='.$category_module->categories[$_POST['cid']]['type'],
			10000
		);
	}else{
		message(
			array(
				array($P8LANG['cms_to_edit'].$form, $this_module->admin_controller .'-update?id='.$id.'&model='.$model.'&verified='.$verified),
				array('cms_to_list', $this_module->admin_controller .'-list?cid='.$_POST['cid'].'&model='.$model),
				array('cms_to_view', $static_view_url.($_POST['verify'] == 1 ? '' : '?verified='.$_POST['verify']), '_blank'),
				array('cms_to_view_dynamic', $core->STATIC_URL.'/index.php/cms/item-view-id-'.$id .'?verified='. $_POST['verify'].$flag, '_blank'),
				array('cms_to_add', $this_module->admin_controller .'-add?cid='.$_POST['cid'].'&model='.$model.'&type='.$category_module->categories[$_POST['cid']]['type'])
			),
			$this_module->admin_controller .'-add?cid='. $_POST['cid'] .'&model='. $model.'&type='.$category_module->categories[$_POST['cid']]['type'],
			10000
		);
	}
}
