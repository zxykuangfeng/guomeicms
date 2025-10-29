<?php
defined('PHP168_PATH') or die();

$this_system->check_manager($ACTION) or message('no_privilege');

if(REQUEST_METHOD == 'GET'){
    
    $category = &$this_system->load_module('category');
	$category_json = $category->get_json();
    $mapcate = $this_module->get_category_cache();
    $allsites = $this_system->get_sites();
	load_language($core, 'config');
	$sc = isset($_GET['sc']) && in_array($_GET['sc'],array('c','t','s','all')) ? trim($_GET['sc']) : 'c';
	$model = isset($_GET['model']) ? trim($_GET['model']) : '';
	$cid = isset($_GET['cid']) ? trim($_GET['cid']) : '';
    
    $page_url = $this_url .'?sc='.$sc;
    
	$select = select();
	$select->from($this_module->table, '*');
	if($sc=='t') $select->where("`status` = -99");
	if($sc=='c') $select->where("`status` != -99");
	
	$stc = $sc =='t' ? 'c' : $sc;
    if($stc != 'all') $select->in('sc',$stc);
    if($model){
           $select->in('model',$model);
           $page_url .= '&model='.$model;
    }   
    if($cid){
        $select->in('cid',$cid);
        $page_url .= '&cid='.$cid;
    }
    $select->where_and();
	if($stc != 'all') $select->where(" (site='' or find_in_set('{$this_system->SITE}',site))");
	$select->order(" timestamp DESC");
	$count = 0;
	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$page = max(1, $page);
	$page_size = 20;
	//echo $select->build_sql();
	$list = $core->list_item(
		$select,
		array(
			'page' => &$page,
			'count' => &$count,
			'page_size' => $page_size,
			'ms' => 'master'
		)
	);
	$item_ids = array();
	$usernames = array();
	$member_info = array();
	foreach($list as $key=>$item){
		$item_ids[$item['item_id']] = $item['item_id'];
		$usernames[$item['id']] = $item['push_username'];
		$member_info[$item['item_id']] = array();
		$list[$key]['push_username16'] = $item['push_username'] ? base64_encode($item['push_username']) : '';
		$list[$key]['to_url'] = '';
		$list[$key]['to_sites'] = '';
		$list[$key]['username'] = '';
		$item_data = mb_unserialize($item['data']);	
		if($item_data && $item_data['username']){
			$usernames[] = $item_data['username'];
			$list[$key]['username'] = $item_data['username'];
			$list[$key]['username16'] = $item_data['username'] ? base64_encode($item_data['username']) : '';
		}
		if($item['new_id']){
			if($item['to']=='cms'){
				$list[$key]['to_url'] = $core->controller.'/cms/item-view-id-'.$item['new_id'].'.shtml';
				$list[$key]['to_sites'] = '主站';
				$list[$key]['to_site_alias'] = 'mainstation';
			}else{
				$site_status = explode(',',$item['site_status']);
				$alias = end($site_status);
				$list[$key]['to_site_alias'] = $alias;
				if($alias){
					$site_domain_new = $allsites[$alias]['ipordomain'] ? $allsites[$alias]['domain'].'/index.php/' : $core->CONFIG['url'].'/s.php/'.$alias.'/';
					$list[$key]['to_url'] = $site_domain_new.'item-view-id-'.$item['new_id'].'.html';
				}
				$site_num = count($site_status);
				$list[$key]['to_sites'] = !empty($allsites[$alias]['sitename']) ? $allsites[$alias]['sitename']  : '';				
			}
		}
	}
	//member_info
	$member_table = $core->TABLE_.'member';
	$member_info = array();
	if($usernames){
		$div = '';
		foreach(array_unique($usernames) as $username_tmp){
			if($username_tmp) $usernames_string .= $div."'".$username_tmp."'";
			$div = ',';
		}
		$item_table = $sc == 's' ? $this_system->item_table : $sites_system->item_table;
		$sql = "SELECT id,username,name FROM `$member_table` WHERE username in ($usernames_string)";	
		$query = $core->DB_master->query($sql);
		while($arr = $core->DB_master->fetch_array($query)){
			if($arr['id']){
				$md5_username = base64_encode($arr['username']);
				$member_info[$md5_username] = array(
					'username' => $arr['username'],
					'name' => $arr['name'],
				);
			}
		}
	}
	//var_dump($member_info);
	$site_info = $this_system->get_site($this_system->SITE);
	$site_domain = $site_info['ipordomain'] ? $site_info['domain'].'/' : $core->CONFIG['url'].'/s.php/'.$this_system->SITE.'/';
	if($sc=="s"){
		foreach($list as $key=>$item){
			if($item['cid'] && $CAT = $this_system->fetch_category($item['cid'])){
				$list[$key]['category_name'] = $CAT['name'];
			}
			if($item['new_id'])
				$list[$key]['link'] = $site_domain.'item-view-id-'.$item['new_id'].'.html'.($item['status'] != 1? '?verified=0' : '');
			else
				$list[$key]['link'] = '';
		}
	}
	//var_dump($list);
	$page_url .= '&page=?page?';
	$pages = list_page(array(
		'count' => $count,
		'page' => $page,
		'page_size' => $page_size,
		'url' => $page_url
	));
	//
	//$sitename_alias = !empty($allsites[$this_system->SITE]['sitename']) ? $allsites[$this_system->SITE]['sitename']  : '';
	$sitename_alias = $this_system->site['sitename'];
	include template($this_module, 'list', 'admin');
}else if(REQUEST_METHOD == 'POST'){
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	//sphinx索引配置
	if(isset($_POST['sphinx'])){
		$item = &$this_system->load_module('item');
		require_once PHP168_PATH .'inc/sphinx_conf.php';
		
		$models = $this_system->get_models();
		
		foreach($models as $k => $v){
			
			$_REQUEST['model'] = $k;
			$this_system->init_model();
			$item->set_model($k);
			
			$data = array(
				'main' => array(),
				'delta' => array(),
				'index_path' => $SYSTEM .'/'
			);
			
			//索引名
			$data['index_name'] = $index_name = $core->CONFIG['sphinx_prefix'] . $SYSTEM .'-'. $item->name .'-'. $MODEL;
			
			if(empty($v['enabled'])){
				remove_sphinx_config_index($index_name);
				continue;
			}
			
			//可筛选字段,一定要为整数型
			$f_fields = $f_attrs = '';
			foreach($this_model['fields'] as $field => $v){
				if(!$v['list_table'] && (!$v['filterable'] || !$v['orderby'])) continue;
				$f_fields .= ', i.`'. $field .'`';
				$f_attrs .= "\r\n\tsql_attr_uint		= $field";
			}
			
			//生成索引的SQL
			$sql = <<<EOT
		SELECT i.id, i.id AS id, i.title, i.cid, i.uid, i.list_order, i.timestamp, i.views, i.level, i.comments, i.summary  $f_fields\
		FROM $item->table AS i INNER JOIN $item->addon_table AS a ON i.id = a.iid \
EOT;
			
			//查询的属性
			$data['attributes'] = <<<EOT
	sql_attr_uint		= id
	sql_attr_uint		= cid
	sql_attr_uint		= uid
	sql_attr_uint		= views
	sql_attr_uint		= comments
	sql_attr_timestamp	= timestamp
	sql_attr_timestamp	= list_order
	
	sql_attr_multi = uint tid from query; SELECT iid, tid FROM $item->tag_item_table
	$f_attrs
EOT;
			$data['main']['sql_query_pre'] = <<<EOT
	sql_query_pre			= \
		REPLACE INTO {$core->TABLE_}sphinx SELECT '$index_name', MAX(id) FROM $item->table
EOT;
			//主索引的取数据
			$data['main']['sql_query'] = <<<EOT
	sql_query			= \
$sql
		WHERE i.id <= (SELECT max_id FROM {$core->TABLE_}sphinx WHERE id = '$index_name')
EOT;
			$data['main']['sql_query_info'] = <<<EOT
	sql_query_info			= \
		SELECT * \
		FROM $item->table AS i INNER JOIN $item->addon_table AS a ON i.id = a.iid \
		WHERE i.id = \$id
EOT;
			
			$data['delta']['sql_query'] = <<<EOT
	sql_query			= \
$sql
		WHERE i.id > (SELECT max_id FROM {$core->TABLE_}sphinx WHERE id = '$index_name')
EOT;
			
			refresh_sphinx_config($data);
		}
		
		message('done');
	}
	
	
	
	
	$this_module->cache();
	
	message('done');
	
}
