<?php
defined('PHP168_PATH') or die();

/**
* 内容管理
**/

$this_system->check_manager($ACTION) or message('no_privilege');

$allitem = isset($_GET['allitem']) ? trim($_GET['allitem']) : '';
$regexp_mobile = isset($_GET['regexp_mobile']) ? true : false;
$regexp_id = isset($_GET['regexp_id']) ? true : false;
if((!empty($allitem) || !empty($regexp_mobile) || !empty($regexp_id)) && empty($_REQUEST['model'])){
	$models = $this_system->get_models(true);
	$models_alias = array();
	foreach($models as $alias=>$model_each){
		if($model_each['enabled']) $models_alias[] = $alias;
	}
	$_REQUEST['model'] = isset($models['article']) && $models['article']['enabled'] ? 'article': $models_alias[0];
}
$sphinx = $this_module->CONFIG['sphinx'];
$use_sphinx = false;

if(!empty($_REQUEST['model'])){
	$this_system->init_model();
	$sphinx['index'] = $this_system->sphinx_indexes(array($MODEL => 1));
	
	$this_model or message('no_such_sites_model');
}else{
	$MODEL = '';
	$sphinx['index'] = $this_system->sphinx_indexes();
}

//加载分类模块
$category = &$this_system->load_module('category');

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max($page, 1);
$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
$mine = empty($_GET['mine']) ? 0 : 1;
$desc = empty($_GET['order']) ? ' DESC' : ' ASC';
$order_num = empty($_GET['order']) ? 0 : intval($_GET['order']);
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$keyword = $keyword ? $keyword : (isset($_GET['word']) ? trim($_GET['word']) : '');
$username = isset($_GET['username']) ? trim($_GET['username']) : '';
$source = isset($_GET['source']) ? trim($_GET['source']) : '';
$url = isset($_GET['url']) ? trim($_GET['url']) : '';
$id = isset($_GET['id']) ? filter_int(explode(',', $_GET['id'])) : '';

$category->get_cache();
if(!empty($category->categories[$cid]) && $category->categories[$cid]['type']==4){
	$page_id = $this_module->get_page($cid,$category->categories[$cid]['model']);
	if($page_id){
		header('Location:'.$this_router.'-update?model='.$category->categories[$cid]['model'].'&id='.$page_id['id']);
	}else{
		header('Location:'.$this_router.'-add?model='.$category->categories[$cid]['model'].'&cid='.$cid);
	}
	exit;
}

if(isset($_GET['verified'])){
	$verified = intval($_GET['verified']);
	$T = $verified == 1 ? $this_module->main_table : $this_module->unverified_table;
	
}else{
	$verified = 1;
	$T = $this_module->main_table;
	
}
if (!in_array($verified, [0,1,2,3,66,77,88,-99,-100])) {
	message('no_privilege');
}
if(!P8_AJAX_REQUEST){
	
	
	//所有模型
	$models = $this_system->get_models();
	//模型JSON
	$model_json = p8_json($models);
	//分类JSON
	$category_json = $category->get_json();
	//属性JSON
	$attributes = array();
	foreach($this_module->attributes as $aid => $lang){		
		$attributes[$aid] = $this_module->CONFIG['attributes'][$aid] ? $this_module->CONFIG['attributes'][$aid] : $P8LANG['sites_item']['attribute'][$aid];
	}
	$attr_json = p8_json($attributes);
	
	$clustered = $this_system->check_manager('cluster_push');
	$allow_sites_push = $this_system->check_manager('sites_push');
	$allow_sites_push_sites = $this_system->check_manager('sites_push_sites');
	$allow_update = $this_system->check_manager('update');
	$allow_delete = $this_system->check_manager('delete');
	$site_info = $this_system->get_site($this_system->SITE);
	//独立审核，则检测是否有权限，否则只检测是否是管理员
	$independent_verify = !empty($site_info['config']['independent_verify']) ? true : false;	
	$allow_verify = $allow_verify_o = $independent_verify ? $this_controller->check_admin_action('verify','',true) :  $this_system->check_manager('verify');
	$allow_verify_first = $independent_verify ? $this_controller->check_admin_action('verify_first','',true) : $this_system->check_manager('verify_first');
	//检查是否有初审权限，最终审核权限只需要有审核或初审权限即可显示菜单,两都都没权限则不显示
	$allow_verify  = $allow_verify || $allow_verify_first;
	$allow_move = $this_system->check_manager('move');
	$allow_attribute = $this_system->check_manager('attribute');
	$allow_level = $this_system->check_manager('level');
	$allow_add = $this_system->check_manager('add');
	$allow_list_order = $this_system->check_manager('list_order');
	$allow_view_to_html = $this_system->check_manager('view_to_html');
	$allow_clone = $this_system->check_manager('clone');
	$allow_score = $this_system->check_manager('score');
	$allow_download = $this_system->check_manager('download');	
	$cms_system = $core->load_system('cms');
	$cms_item_config = $core->get_config('cms','item');	
	$score_level = !empty($cms_item_config['score_level']) ? $cms_item_config['score_level'] : array();
	$level_num = array();
	for($i = 0; $i < 255; $i=$i+10){
	    $level_num[] = $i;
    }
    $this_site_name = $this_system->SITE;
	$allow_verify_frame = $this_module->CONFIG['verify_frame_editable'] && $this_module->CONFIG['menu_verify_frame'] ? false : true;
	$sync_index_to_html = $this_module->CONFIG['sync_index_to_html'] ? 1 : 0;	
	$allsites = $this_system->get_sites();
	unset($allsites[$this_site_name]);
	$allsites = array_keys($allsites);
	$selected_site = current($allsites);
	//顺序改一下
	$verify_acl = $this_module->CONFIG['verify_acl'];
	foreach($verify_acl as $key=>$val){
		$verify_acl[$key]['name'] = $val['name'] ? $val['name'] : $P8LANG['sites_item']['verify'][$key];
	}
	$verify_acl_sort = array();
	if(isset($verify_acl[-99])){ $verify_acl_sort[-99] = $verify_acl[-99];unset($verify_acl[-99]);}
	if(isset($verify_acl[88])){ $verify_acl_sort[88] = $verify_acl[88];unset($verify_acl[88]);}
	if(isset($verify_acl[0])){ $verify_acl_sort[0] = $verify_acl[0];unset($verify_acl[0]);}
	if(isset($verify_acl[2])){ $verify_acl_sort[2] = $verify_acl[2];unset($verify_acl[2]);}
	if(isset($verify_acl[1])){ $verify_acl_sort[1] = $verify_acl[1];unset($verify_acl[1]);}
	foreach($verify_acl as $key=>$val){
		$verify_acl_sort[$key] = $val;
	}	
	$this_module->CONFIG['verify_acl'] = $verify_acl_sort ? $verify_acl_sort : $this_module->CONFIG['verify_acl'];
	include template($this_module, 'list', 'admin');
	exit;
}else{
	//JS传过来的关键字,UTF-8的
	$keyword = from_utf8($keyword);
}


$page_url = $this_url .'?';
$page_url = 'javascript:request_item(?page?)';





$select = select();
$select->in('i.site', $this_system->SITE);
$fields = 'i.id, i.model, i.title, i.source, i.title_color, i.title_bold, i.cid, i.url, i.uid, i.username,i.verifier, i.attributes, i.pages, i.views, i.level,i.score, i.comments, i.verified, i.timestamp, i.list_order';
$u_fields = 'i.id, i.cid, i.uid, i.model, i.title, i.source,i.username, i.timestamp, i.push_back_reason, i.attributes, i.pages, i.verified,i.verifier, i.views, i.level, i.comments';

if($id){
	
	$select->from($T .' AS i', $fields);
	$select->in('i.id', $id);
	
}else if($mine){
	
	if($verified == 1){
		$use_sphinx = true;
		$u_fields = $fields;
	}
	
	//我发表的
	$select->from($T .' AS i', $u_fields);
	//$select->inner_join($this_module->member_table .' AS m', '', 'i.id = m.iid');
	if($cid){
		$category->get_cache();
		$ids = array($cid) + $category->get_children_ids($cid);
		
		$select->in('i.cid', $ids);
	}
	
	$select->in('i.uid', $UID);	
	switch($verified){
		case '-100':
			$select->in('i.verified', 88,true);
			break;
		case '3':
			$select->in('i.verified', array(0,2));
			break;
		default:
			$select->in('i.verified', $verified);
	}
	//$select->order('m.timestamp'. $desc);
	if($order_num == 2){
		$select->order('i.level desc,i.timestamp desc');
	}else{
		$select->order('i.timestamp'. $desc);
	}
	
}else{
	
	if($verified == 1){
		if($MODEL){
			$select->from($this_module->table .' AS i', $fields);
		}else{
			$select->from($this_module->main_table .' AS i', $fields);
		}
		
	}else{
		$select->from($T .' AS i', $u_fields);
		switch($verified){
			case '-100':
				$select->in('i.verified', 88,true);
				break;
			case '3':
				$select->in('i.verified', array(0,2));
				break;
			default:
				$select->in('i.verified', $verified);
		}
		if($MODEL){
			$select->in('i.model', $MODEL);
		}
		
		//我能审核的分级
		/*$levels = array(-99, 0);
		foreach($this_module->CONFIG['verify_acl'] as $level => $v){
			if(!empty($v['role'][$this_system->ROLE])){
				$levels[] = $level;
			}
		}
		
		$select->in('i.status', $levels);
		*/
		
		
		//我能审核的栏目
		//$my_cats = $this_controller->get_acl('my_category_to_verify');
		//$all = isset($my_cats[0]); unset($my_cats[0]);
		//if(!$all || !empty($my_cats) || !$IS_FOUNDER){
		//	$cids = array_keys((array)$my_cats);
		//	$select->in('i.cid', $cids);
		//}
		
	}
	
	if($cid){
		$category->get_cache();
		$ids = array($cid) + $category->get_children_ids($cid);
		
		$select->in('i.cid', $ids);
		//$select->order('i.list_order'. $desc);
		if($order_num == 2){
			$select->order('i.level desc,i.list_order desc');
		}else{
			$select->order('i.list_order'. $desc);
		}
		
		$use_sphinx = $verified == 1 ? true : false;
	}else{
		if($order_num == 2){
			$select->order('i.level desc,i.id desc');
		}else{
			$select->order('i.id'. $desc);
		}
		//$select->order('i.id'. $desc);
	}
	
	if($verified != 1){
		//$select->order('i.id'. $desc);
		if($order_num == 2){
			$select->order('i.level desc,i.id desc');
		}else{
			$select->order('i.id'. $desc);
		}
	}
	
}
$select->left_join($this_system->category_table .' AS c', 'c.name AS category_name', 'c.id = i.cid');

if(strlen($keyword)){
	$use_sphinx = $verified == 1 ? true : false;
	$select->search('i.title', $keyword);
}
if(strlen($username)){
	$use_sphinx = $verified == 1 ? true : false;
	$select->search('i.username', $username);
}
if(strlen($source)){
	$use_sphinx = $verified == 1 ? true : false;
	$select->search('i.source', $source);
}
if(strlen($url)){
	$use_sphinx = $verified == 1 ? true : false;
	$select->search('i.url', $url);
}
if(strlen($allitem)){
	$use_sphinx = $verified == 1 ? true : false;
	$select->inner_join($this_module->addon_table .' AS a', 'a.*, a.iid AS id', 'i.id = a.iid');
	$select->search('a.content', $allitem,'(');
	$select->where_or();
	$select->search('i.title', $allitem,'',')');
}
if($regexp_mobile){
	$use_sphinx = $verified == 1 ? true : false;
	$select->inner_join($this_module->addon_table .' AS a', 'a.*, a.iid AS id', 'i.id = a.iid');
	$select->where("`content` REGEXP '1[0-9]{10}'");
}
if($regexp_id){
	$use_sphinx = $verified == 1 ? true : false;
	$select->inner_join($this_module->addon_table .' AS a', 'a.*, a.iid AS id', 'i.id = a.iid');
	$select->where("`content` REGEXP '[0-9]{15,18}'");
}
$page_size = 40;
$count = 0;
$select->left_join($core->TABLE_.'member as m', 'm.name,m.dept as department', 'm.id=i.uid');
$mconfig = $core->get_config('core', 'member');
$dept = array();
foreach($mconfig['dept'] as $value){
	$dept[$value['code']] = $value['name'];
}
//取数据
$list = $core->list_item(
	$select,
	array(
		'page' => &$page,
		'count' => &$count,
		'page_size' => $page_size,
		'ms' => 'master',
		'sphinx' => $use_sphinx && $sphinx['enabled'] ? $sphinx : null
	)
);
foreach($list as $key => $row){	
	if($category->categories[$row['cid']]['htmlize']){
		$row['#category'] = $category->categories[$row['cid']];
		$list[$key]['url'] = $this_system->site_p8_url($this_module, $row, 'view');
		$list[$key]['url'] = html_entity_decode(attachment_url($list[$key]['url'],false,true));
	}else{
		$list[$key]['url'] =  $this_system->siteurl.'/item-view-id-'.$row['id'].'?verified='.$row['verified'];
	}	
	if(substr($row['url'],0,7)=='http://') $list[$key]['url'] = $row['url'];
	$list[$key]['department'] = $row['department'] && $dept[$row['department']] ? $dept[$row['department']] : '';
}
$models_addon = array();
//echo $select->build_sql();exit;
foreach($list as $key=>$item){
	$list[$key]['level'] = isset($P8LANG['sites_item']['level_rank'][$item['level']]) && $item['level']>240 ? $P8LANG['sites_item']['level_rank'][$item['level']] : $item['level'];
	if(!empty($list[$key]['source'])){
		$emp_source = explode('|',$list[$key]['source']);
		$list[$key]['source'] = $emp_source[0];
		$list[$key]['sourceurl'] = $emp_source[1];
	}
	$list[$key]['lan_access_only'] = 0;
	$models_addon[$item['model']][$key] = $item['id'];
}
/*局域网*/
foreach($models_addon as $model_ => $model_ids){
	if(!$model_) continue;
	$table = $this_module->TABLE_ .$model_.'_';
	$where = 'where id in ('.implode(',',array_values($model_ids)).')';
	$query = $core->DB_master->query("select `id`,`config` from $table $where");
	$model_ids_flip = array_flip($model_ids);
	while($arr = $core->DB_master->fetch_array($query)){
		$v_config = $arr['config'] ? mb_unserialize(stripslashes($arr['config'])) : array();
		if($v_config && $v_config['allow_ip']['enabled'] >= 1){
			$list[$model_ids_flip[$arr['id']]]['lan_access_only'] = 1;
		}
	}	
}
echo p8_json(array(
	'list' => $list,
	'pages' => list_page(array(
		'count' => $count,
		'page' => $page,
		'page_size' => $page_size,
		'url' => $page_url
	)),
	'time' => get_timer() - $P8['start_time'],
	'sphinx' => $sphinx
));

exit;
