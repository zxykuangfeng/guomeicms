<?php
/**
 * 微信公众号助手
 */
$this_controller->check_admin_action($ACTION) or message('no_privilege');
GetGP(array('job','action','id'));
if($action=="edit"){
	$this_controller->check_admin_action('edit_keyword') or message('no_privilege');
	$keywordRow = array();
	$keywordRow['type'] = 'text';
	if($id && $id !='undefined'){
		$keywordRow = $core->DB_master->fetch_one("SELECT * FROM `$this_module->keywords` where id = {$id}");
	}
	if(REQUEST_METHOD == 'POST'){
		GetGP(array('keyword','type','pattern','content','title','description','picurl','url','reply_type','media_id'));
		if($type!='text') $content = $media_id;
		if($id && id !='undefined'){
			$result = $core->DB_master->query("UPDATE `$this_module->keywords` SET `keyword` = '{$keyword}',`type`= '{$type}',`pattern`= '{$pattern}',`content`='{$content}',`title`='{$title}',`description`='{$description}',`picurl`='{$picurl}',`url`='{$url}',`reply_type`={$reply_type} where id = {$id}");
		}else{
			$result = $core->DB_master->query("INSERT INTO `$this_module->keywords`(`keyword`,`type`,`pattern`,`content`,`title`,`description`,`picurl`,`url`,`reply_type`,`created_at`) VALUES('{$keyword}', '{$type}', '{$pattern}', '{$content}','{$title}','{$description}','{$picurl}','{$url}','{$reply_type}','".date('Y-m-d H:i:s')."')");
		}
		if($result){
			message('done',$this_url,2);
		}
	}
	include template($this_module, 'keyword_edit', 'admin');
}elseif($action == "delete"){
	$this_controller->check_admin_action('delete_keyword') or message('no_privilege');
	$ids=implode(",",$id);
	$where="id in ($ids)";
	$query = "DELETE FROM  `$this_module->keywords` WHERE {$where}";
	$result = $core->DB_master->query($query);
	echo jsonencode($id);
	exit;	
}else{	
	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$page = max($page, 1);
	$config = $core->get_config($this_system->name, $this_module->name);
	$limit = 20;
	$page_url = $this_url .'?page=?page?';

	$select = select();
	$select->from($this_module->keywords);
	$select->order('id desc');

	$page_size = 20;
	$count = 0;
	$keywordRows = array();
	//取数据
	$list = $core->list_item(
		$select,
		array(
			'page' => &$page,
			'count' => &$count,
			'page_size' => $page_size,
			'ms' => 'master',
			'sphinx' => null
		)
	);
	$pages = list_page(array(
			'count' => $count,
			'page' => $page,
			'page_size' => $page_size,
			'url' => $page_url
		));
	$i=0;
	$type = array(
		'image' => '图片',
		'voice' => '语音',
		'video' => '视频',
		'music' => '音乐',
		'news' => '图文',
		'text' => '文本',
	);
		
	foreach($list as $row)
	{
		$keywordRows[$i]['id'] = $row['id'];
		$keywordRows[$i]['keyword'] = $row['keyword'];
		$keywordRows[$i]['type'] = $type[$row['type']];
		$keywordRows[$i]['pattern'] = $row['pattern']==1 ? '模糊匹配' : '完全匹配';
		$keywordRows[$i]['content'] = $row['content'];
		$i++;
	}
	include template($this_module, 'keyword', 'admin');
}