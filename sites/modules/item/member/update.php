<?php
defined('PHP168_PATH') or die();

/**
* 更新模型内容入口文件
**/

$this_system->init_model();
$this_model or message('no_such_cms_model');
$this_model['enabled'] or message('sites_model_disabled');

if(REQUEST_METHOD == 'GET'){
	$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	$id or message('no_such_item');
	$models = $this_system->get_models();
	foreach($models as $k=>$m){
		if(!$m['enabled'])unset($models[$k]);
	}
	$site_domain = $this_system->get_site_domain();	
	if(isset($_GET['verified'])){
		$verified = $_GET['verified'] == 1 ? true : false;
	}else{
		$verified = true;
	}
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
			$select->inner_join($this_module->addon_table .' AS a', 'a.*', 'm.id = a.iid');
			$select->inner_join($this_module->table .' AS i', 'i.*', 'i.id = m.id');
			$select->in('i.id', $id);
			$select->in('a.page', 1);
			$data = $core->select($select, array('single' => true));
			$data or message('no_such_item');
			
		}else{
			
			$select = select();
			$select->from($this_module->unverified_table, 'verified,`data`');
			$select->in('id', $id);
			$_data = $core->select($select, array('single' => true));
			$_data or message('no_such_item');			
			$overified = isset($_data['verified']) && $_data['verified'] ? $_data['verified'] : 0;
			$_data = mb_unserialize($_data['data']);
			$_data['item']['cluster_push_cid'] = $_data['cluster_push_cid'] ? intval($_data['cluster_push_cid']):0;
			$data = array_merge($_data['addon'], $_data['item'], $_data['main']);
			$data['verified'] = $overified;
		}
	}
	//检查分类权限
	if($data['uid'] != $UID){
		$this_controller->check_category_action('update', $data['cid']) or message($P8LANG['sites_item']['no_category_privilege']);
	}
	$site_info = $this_system->get_site($this_system->SITE);
	$independent_verify = !empty($site_info['config']['independent_verify']) ? true : false;
	$allow_verify = $independent_verify ? $this_controller->check_action('verify',$this_system->SITE,true) : $this_controller->check_action('verify');	
	if($this_module->CONFIG['allow_verify'] && $verified){		
		$mysites = $this_system->get_manage_sites();
		if(!in_array($this_system->SITE, $mysites) && !$allow_verify){
			message($P8LANG['sites_item']['no_category_update_privilege']);
		}
	}
	$this_module->format_data($data);

	//内容属性
	$data['attributes'] = array_flip(explode(',', $data['attributes']));
	$data['summary'] = html_entity_decode($data['summary']);
	$data['level_date'] = $data['level_time'] > 0 ? date('Y-m-d H:i:s', $data['level_time']) : 0;
	$data['list_order_date'] = date('Y-m-d H:i:s', $data['list_order']);
	$data['timestamp_date'] = date('Y-m-d H:i:s', $data['timestamp']);
	//$allow_create_time = $this_controller->check_action('create_time');
	$allow_create_time = true;
	$allow_attribute = $this_controller->check_action('attribute');
	$allow_set_views = $this_controller->check_action('setviews');
	//config
	$config = mb_unserialize(stripslashes($data['config']));
	$config['allow_ip']['enabled'] = isset($config['allow_ip']['enabled']) ? $config['allow_ip']['enabled'] : 0;
	$config['allow_ip']['collectip'] = isset($config['allow_ip']['collectip']) ? $config['allow_ip']['collectip'] : array();
	$config['allow_ip']['beginip'] = isset($config['allow_ip']['beginip']) ? trim($config['allow_ip']['beginip']) : '';
	$config['allow_ip']['endip'] = isset($config['allow_ip']['endip']) ? trim($config['allow_ip']['endip']) : '';
	$config['allow_ip']['ruleoutip'] = isset($config['allow_ip']['ruleoutip']) ? $config['allow_ip']['ruleoutip'] : array();
	//预留字段
	$custom = array('custom_a','custom_b','custom_c','custom_d','custom_e','custom_f','custom_g','custom_h','custom_i','custom_j');
	
	//权重
	$allow_level = $this_controller->check_action('level');
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
	$my_addible_category = p8_json($this_controller->get_acl('my_addible_category'));
	$uploader_config = $core->get_config('core','uploader');
	$thumb_width = $uploader_config['thumb']['width'] ? intval($uploader_config['thumb']['width']) : 0;
	$thumb_height = $uploader_config['thumb']['height'] ? intval($uploader_config['thumb']['height']) : 0;
	$file = $this_model['path'] .'member/update.php';
	if(!is_file($file)){
		$file = str_replace('/'.$MODEL.'/','/article/',$file);
	}
	require $file;
	
	$template = empty($this_model['CONFIG']['member_edit_template']) ? 'edit' : $this_model['CONFIG']['member_edit_template'];
	$item_config = $core->get_config('sites', 'item');
	$this_fields = $this_model['fields'];
	$core_config = $core->get_config('core', '');
	$allow_filter_word = $core_config['filter_word_enable'] ? true : false;
	$allow_content_censor = $core_config['content_censor_enabled'] ? true : false;
	$allow_censor_default = $core_config['content_censor_default'] ? true : false;
	//敏感词勾选权限
	$filter_word_enabled = $this_controller->check_action('filter_word');
	$content_censor_enabled = $this_controller->check_action('content_censor');
	$allow_list_order = $this_controller->check_action('list_order');
	$cms_system = $core->load_system('cms');	
	$item_module = &$cms_system->load_module('item');
	$cms_my_addible_category = $core->controller($item_module)->get_acl('my_addible_category');
	$push_addible_category = p8_json($cms_my_addible_category);
	include template($this_module, $template);
	
}else if(REQUEST_METHOD == 'POST'){
	
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$this_cid = isset($_POST['cid']) ? intval($_POST['cid']) : 0;
	$id or message('no_such_item');
	
	//大分类不允许发布信息
	$category_module = $this_system->load_module('category');	
	$category_module->get_cache();
	if($category_module->categories[$_POST['cid']]['type'] == 1) message('category_post_rule');
	$site_info = $this_system->get_site($this_system->SITE);
	$independent_verify = !empty($site_info['config']['independent_verify']) ? true : false;
	if(!$this_controller->check_admin_action('verify','',$independent_verify)){
		unset($_POST['verify']);
	}
	
	if(isset($_POST['verified'])){
		$verified = $_POST['verified'] == 1 ? true : false;
	}else{
		$verified = true;
	}
	
	//$_POST['verify'] = $this_controller->check_category_action('autoverify', $_POST['cid'])? 1 : 0;	
	if($independent_verify)
		$_POST['verify'] = ($this_controller->check_category_action('autoverify', $_POST['cid'],'',true) &&  in_array($this_system->SITE, $mysites))? 1 : 0;
	else
		$_POST['verify'] = ($this_controller->check_category_action('autoverify', $_POST['cid']) ||  in_array($this_system->SITE, $mysites))? 1 : 0;	
	
	$data = $this_module->data('read', $id);
	if(empty($data)){
		$data = $this_module->data_unverified($id);
		$_POST['verify'] = $data['uid'] != $UID ? 0 : $_POST['verify'];
	}
	global $UID;
	$My_UID = $UID;//存UID
	//浏览量
	$_POST['views'] = $this_controller->check_category_action('setviews', $_POST['cid']) ? intval($_POST['views']) : $data['views'];	
	$file = $this_model['path'] .'member/update.php';
	if(!is_file($file)){
		$file = str_replace('/'.$MODEL.'/','/article/',$file);
	}
	require $file;
	$models = $this_system->get_models();
	$omodel = $model = isset($_POST['model']) ? xss_clear($_POST['model']) : '';
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
	* 针对子站推送数据给总站时，当子站修改数据时，能同步修改总站相应数据
	*/
	$cms_item_config = $core->get_config('cms','item');
	if($cms_item_config['sites_to_cms_connect']){
		$stop_table = $core->TABLE_.'sites_stop_data';
		$new_data = $DB_master->fetch_one("select `new_id` from $stop_table where `item_id` = $id");
		if(!empty($new_data)){
			$new_id = $new_data['new_id'];		
			$cms = $core->load_system('cms');
			$cms->init_model();
			$item = $cms->load_module('item');
			$verified_data = true;
			$read_data = $item->data('read', $new_id);
			if(empty($read_data)) {
				$read_data = $item->data_unverified($new_id);
				$verified_data = false;
			}		
			if(!empty($read_data)){
				$_POST['cid'] = $read_data['cid'];
				$controller = $core->controller($item);	
				$item->set_model($read_data['model']);
				$datas = $_POST;
				$datas['verify'] = 0;
				$datas['uid'] = $read_data['uid'];
				$datas['model'] = $read_data['model'];
				$UID = empty($UID) ? $read_data['uid'] : $UID;
				$file = $this_model['path'] .'member/update.php';
				if(!is_file($file)){
					$file = str_replace('/'.$read_data['model'].'/','/article/',$file);
				}
				require $file;
				$controller->update($new_id, $datas, $verified_data,true);
			}
		}
	}
	$_POST['cid'] = $this_cid;//强势回归
	if(!$_POST['verify']){
		message(
            array(
                array('sites_to_edit', $this_module->U_controller .'-update?id='.$id.'&model='.$omodel.'&verified=0'),
                array('sites_to_list', $this_module->U_controller .'-my_list?cid='.$_POST['cid'].'&model='.$omodel),               
                array('sites_to_view_dynamic', $core->STATIC_URL.'/s.php/'.$this_system->SITE.'/item-view-id-'.$id .'?verified=0', '_blank'),
				array('sites_continue_add', $this_module->U_controller .'-add?cid='.$_POST['cid'].'&model='.$omodel),
            ),
            $this_module->U_controller .'-add?cid='.$_POST['cid'].'&model='.$omodel,
            10000,
            array(),'',$P8LANG['sites_item']['verify']['wait_again']
        );
		//message($P8LANG['sites_item']['verify']['wait_again'], $this_module->U_controller .'-add?cid='.$_POST['cid'].'&model='.$model);
	}else{
		$data['#category'] = $this_system->fetch_category($data['cid'],true);
		$data['timestamp'] = strtotime($_POST['timestamp']);
		$static_view_url = $this_system->site_p8_url($this_module, $data, 'view');
		$verified = $_POST['verify'] ? 1 : 0;
		//静态首页
		$form = '';
		if(isset($this_module->CONFIG['sync_index_to_html']) && $this_module->CONFIG['sync_index_to_html'] && ($verified || $_POST['verified'] ==  1)){
			$form = '<form action="'.$this_module->U_controller.'-reflash_index" method="get" id="'. $this_system->SITE .'" target="'. $this_system->SITE .'">'.
				'<input type="hidden" name="'.$this_system->SITE.'">'.
				'<input type="hidden" name="site" value="'.$this_system->SITE.'">'.
				'</form>'.
				'<iframe style="display: none;" name="'. $this_system->SITE .'"></iframe>'.
				'<script type="text/javascript">document.getElementById("'. $this_system->SITE .'").submit();</script>';
		}
		//静态化列表和内容本身
		if($_POST['html']){
			$form .= '<form action="'.$this_module->U_controller.'-view_list_to_html" method="post" id="__html_vlist__" target="__html_vlist__">'.
				'<input type="hidden" name="action" value="update" />'.
				'<input type="hidden" name="site" value="'.$this_system->SITE.'">'.
				'<input type="hidden" name="id" value="'.$id.'" />'.
				'<input type="hidden" name="cid" value="'.$_POST['cid'].'" /></form>'.
				'<iframe style="display: none;" name="__html_vlist__"></iframe>'.
				'<script type="text/javascript">$("#__html_vlist__").submit();</script>';
		}
		message(
			array(
				array($P8LANG['sites_to_edit'].$form, $this_module->U_controller .'-update?id='.$id.'&model='.$omodel.'&verified='.$verified),
				array('sites_to_list', $this_module->U_controller .'-my_list?cid='.$_POST['cid'].'&model='.$omodel),
				array('sites_to_view', $static_view_url.($_POST['verify'] == 1 ? '' : '?verified='.$_POST['verify']), '_blank'),
				array('sites_to_view_dynamic', $core->STATIC_URL.'/s.php/'.$this_system->SITE.'/item-view-id-'.$id .'?verified='. $_POST['verify'], '_blank'),
				array('sites_to_add', $this_module->U_controller .'-add?cid='.$_POST['cid'].'&model='.$omodel.'&type='.$category_module->categories[$_POST['cid']]['type'])
			),
			$this_module->U_controller .'-add?cid='. $_POST['cid'] .'&model='. $omodel.'&type='.$category_module->categories[$_POST['cid']]['type'],
			10000
		);
	}
	
}
