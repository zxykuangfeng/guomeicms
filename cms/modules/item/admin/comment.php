<?php
defined('PHP168_PATH') or die();

/**
* 评论管理
**/

if(REQUEST_METHOD == 'GET'){

	$this_controller->check_admin_action('comment') or message('no_privilege');

	if(isset($_GET['verified'])){
		$verified = empty($_GET['verified']) ? 0 : intval($_GET['verified']);
	}else{
		$verified = 1;
	}
	$very[$verified] = 'active';
	$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
	$keyword = $keyword ? $keyword : (isset($_GET['word']) ? trim($_GET['word']) : '');
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
	$allow_verify_comment = $this_controller->check_action('verify_comment');
	$allow_delete_comment = $this_controller->check_action('delete_comment');
	$config = $this_module->CONFIG;
	$order_enabled = isset($config['order']['enabled']) && $config['order']['enabled'] ? 1 : 0;
	$exp_type = isset($config['exp_type']) && $config['exp_type'] ? $config['exp_type'] : array();	
	$exp_type_json = p8_json($exp_type);
	$exp_list = array();
	foreach($exp_type as $v){
		$exp_list[$v['code']] = $v['name'];
	}
	include template($this_module, 'comment', 'admin');
	
}else if(REQUEST_METHOD == 'POST'){

	$action = isset($_POST['action']) ? $_POST['action'] : '';

	switch($action){

		case 'verify':
			$this_controller->check_admin_action('verify_comment') or exit('[]');
			
			//审核评论
			$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
			$id or exit('[]');
			
			$value = empty($_POST['value']) ? 1 : intval($_POST['value']);
			$verified = empty($_POST['verified']) ? 0 : intval($_POST['verified']);
			$exp_type = empty($_POST['exp_type']) ? '' : trim($_POST['exp_type']);
			$exp_no = empty($_POST['exp_no']) ? '' : trim($_POST['exp_no']);
			$push_back_reason = isset($_POST['push_back_reason']) ? html_entities(from_utf8($_POST['push_back_reason'])) : '';
			$ids = implode(',', $id);
			if($verified >= 1){
				$query = $DB_master->query("SELECT m.id AS iid, m.model, c.* FROM {$this_module->TABLE_}comment AS c
				INNER JOIN $this_module->main_table AS m ON c.iid = m.id
				WHERE c.id IN ($ids)");				
				
				while($arr = $DB_master->fetch_array($query)){
					$data = array();
					$sid = $arr['id'];					
					$data['verifier'] = $USERNAME;				
					$data['verified'] = $value;
					$data['verify_timestramp'] = P8_TIME;
					$data['reason'] = $push_back_reason;
					$data['exp_type'] = $exp_type;
					$data['exp_no'] = $exp_no;
					//$iid己审核
					$DB_master->update(
						$this_module->TABLE_ .'comment',
						$data,
						"id = '$sid'",
						true
					);
				}				
			}else{				
				$query = $DB_master->query("SELECT m.id AS iid, m.model, c.* FROM {$this_module->TABLE_}comment_unverified AS c
				INNER JOIN $this_module->main_table AS m ON c.iid = m.id
				WHERE c.id IN ($ids)");
				
				
				$items = array();
				while($arr = $DB_master->fetch_array($query)){
					$items[$arr['iid']] = array(
						'model' => $arr['model'],
						'comments' => isset($items[$arr['iid']]['comments']) ? $items[$arr['iid']]['comments'] +1 : 1
					);
					$arr['verifier'] = $USERNAME;				
					$arr['verified'] = $value;
					$arr['verify_timestramp'] = P8_TIME;
					$arr['reason'] = $push_back_reason;
					$arr['exp_type'] = $exp_type;
					$arr['exp_no'] = $exp_no;
					
					unset($arr['model']);					
					//移到己审核
					$DB_master->insert(
						$this_module->TABLE_ .'comment',
						$arr
					);
				}
				
				//删除未审核的
				$DB_master->delete(
					$this_module->TABLE_ .'comment_unverified',
					"id IN ($ids)"
				);
				
				foreach($items as $iid => $v){
					//更新内容的评论数
					$this_module->set_model($v['model']);
					
					$DB_master->update(
						$this_module->main_table,
						array('comments' => 'comments +'. $v['comments']),
						"id = '$iid'",
						false
					);
					
					$DB_master->update(
						$this_module->table,
						array('comments' => 'comments +'. $v['comments']),
						"id = '$iid'",
						false
					);
				}
			}			
			
			exit(jsonencode($id));
			
		break;


		case 'delete':
			//删除评论
			
			$this_controller->check_admin_action('delete_comment') or exit('[]');
			
			$id = isset($_POST['id']) ? filter_int($_POST['id']) : array();
			$id or exit('[]');
			
			$verified = isset($_POST['verified']) ? intval($_POST['verified']) : 1;
			
			//删除审核或未审核的
			$T = $verified == 0 ? $this_module->TABLE_ .'comment_unverified' : $this_module->TABLE_ .'comment';
			
			$ids = implode(',', $id);
			
			$query = $DB_master->query("SELECT m.id, c.iid, m.model FROM $T AS c
			INNER JOIN $this_module->main_table AS m ON c.iid = m.id
			WHERE c.id IN ($ids)");
			
			$items = array();
			while($arr = $DB_master->fetch_array($query)){
				if($verified){
					$items[$arr['id']] = array(
						'model' => $arr['model'],
						'comments' => isset($items[$arr['iid']]['comments']) ? $items[$arr['iid']]['comments'] +1 : 1
					);
				}
			}
			
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
