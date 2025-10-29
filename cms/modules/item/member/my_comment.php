<?php
defined('PHP168_PATH') or die();

/**
* 评论管理
**/

if(REQUEST_METHOD == 'GET'){

	$this_controller->check_action('post_comment') or message('no_privilege');
	if(isset($_GET['verified'])){
		$verified = empty($_GET['verified']) ? 0 : intval($_GET['verified']);
	}else{
		$verified = 1;
	}
	$config = $this_module->CONFIG;
	$order_enabled = isset($config['order']['enabled']) && $config['order']['enabled'] ? 1 : 0;
	$very[$verified] = 'over';
	$keyword = isset($_GET['keyword']) ? p8_stripslashes2(trim($_GET['keyword'])) : '';
	$keyword = $keyword ? $keyword : (isset($_GET['word']) ? p8_stripslashes2(trim($_GET['word'])) : '');
	$iid = isset($_GET['iid']) ? intval($_GET['iid']) : 0;
	$desc = empty($_GET['order']) ? ' DESC' : ' ASC';
	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$page = max($page, 1);

	$page_url = $this_url .'?verified='. $verified .'&page=?page?';

	$T = $verified == 0 ? $this_module->TABLE_ .'comment_unverified' : $this_module->TABLE_ .'comment';
	
	

	$select = select();
	$select->from($T .' AS c', 'c.*');
	$select->inner_join($this_module->main_table .' AS i', 'i.title', 'i.id = c.iid');
	$select->order('c.id'. $desc);
	if($verified) $select->in('c.verified', $verified);
	if(strlen($keyword)) $select->like('c.content', $keyword);
	if($iid){
		$select->in('c.iid', $iid);
		$select->order('c.timestamp'. $desc);
		$page_url .= '&iid='. $iid;
	}
	$select->in('c.username',$USERNAME);
	
	//echo $select->build_sql();

	$count = 0;
	$page_size = 20;
	$list = $core->list_item(
		$select,
		array(
			'count' => &$count,
			'page' => &$page,
			'page_size' => $page_size
		)
	);

	$pages = list_page(array(
		'count' => $count,
		'page' => $page,
		'page_size' => $page_size,
		'url' => $page_url
	));
	$allow_verify_comment = false;
	$allow_delete_comment = true;
	$config = $this_module->CONFIG;
	$order_enabled = isset($config['order']['enabled']) && $config['order']['enabled'] ? 1 : 0;
	$exp_type = array();
	$exp_type_json = p8_json($exp_type);
	$exp_list = array();	
	include template($this_module, 'comment');
	
}else if(REQUEST_METHOD == 'POST'){

	$action = isset($_POST['action']) ? $_POST['action'] : '';

	switch($action){

		case 'delete':
			//删除评论
			
			//$this_controller->check_action('delete_comment') or exit('[]');
			
			$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();			
			$id or exit('[]');
			
			$verified = isset($_POST['verified']) ? intval($_POST['verified']) : 1;
			
			//删除审核或未审核的
			$T = $verified == 0 ? $this_module->TABLE_ .'comment_unverified' : $this_module->TABLE_ .'comment';
			
			$ids = implode(',', $id);
			
			$query = $DB_master->query("SELECT m.id, c.iid,c.id as oid,c.uid,c.username, m.model FROM $T AS c
			INNER JOIN $this_module->main_table AS m ON c.iid = m.id
			WHERE c.id IN ($ids)");
			
			$items = array();
			$id_flip = array_flip($id);			
			while($arr = $DB_master->fetch_array($query)){				
				if($arr['uid'] != $UID || $arr['username'] != $USERNAME){					
					unset($id_flip[$arr['oid']]);
				}
				if($verified && $arr['uid'] == $UID && $arr['username'] == $USERNAME){
					$items[$arr['id']] = array(
						'model' => $arr['model'],
						'comments' => isset($items[$arr['iid']]['comments']) ? $items[$arr['iid']]['comments'] +1 : 1
					);
				}				
			}
			$id = array_flip($id_flip);			
			$ids = implode(',', $id);
			if(
				$num = $DB_master->delete(
					$T,
					'id IN ('. $ids .')'
				)
			){
				
				$DB_master->delete(
					$this_module->TABLE_ .'comment_id',
					"id IN ($ids)"
				);
				
				foreach($items as $iid => $v){
					//更新内容的评论数
					$this_module->set_model($v['model']);
					
					$DB_master->update(
						$this_module->main_table,
						array('comments' => 'comments -'. $v['comments']),
						"id = '$iid'",
						false
					);
					
					$DB_master->update(
						$this_module->table,
						array('comments' => 'comments -'. $v['comments']),
						"id = '$iid'",
						false
					);
				}
				
				exit(jsonencode($id));
			}
			
			exit('[]');
			
			
		break;

	}
	
}
