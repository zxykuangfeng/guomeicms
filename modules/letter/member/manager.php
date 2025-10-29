<?php
defined('PHP168_PATH') or die();
$this_controller->check_action($ACTION) or message('no_privilege');
GetGP(array('act'));

$act = $act? $act : 'search';
if($act=='search'){
    $fengfa=-1;
	$key_type = 'title';
	$begin = $end = 0;
	$search = array('key_type','begin','end','status','page','action','word','type','department','parent_department','act','comment','undisplay','fengfa');
	GetGP($search);
	$keyword = $word;
	$select = select();
	
	$my_manage = $this_controller->getcatbyAct('my_letter_manage');
	$display = $this_controller->check_action('display');
	$vefify = $this_controller->check_action('vefify');
	$cates = $this_module->get_category();
//print_r($my_manage);
	$acl_where = $split = '';
	if(!$IS_FOUNDER){
		
		$my_manage = $this_controller->getcatbyAct('manager');
		$cates['department'] = $my_manage;
		if(!$my_manage)
			message('no_privilege');
		if(array_key_exists('0',$my_manage))
		;
		elseif(!array_key_exists('0',$my_manage)){
			$deps = array_keys($my_manage);
			$select->in('department',$deps);
		}else
			message('no_privilege');
	}
	
	//二级部门处理
	$select_size = 1;
	$select_data = array();
	$data_field = array();
	$cates_departments = array();
	//构建一级
	foreach($cates['department'] as $key => $row){
		if($row['parent']) continue;
		$cates_departments[$key] = $row;
		$s = array();
		foreach($row['menus'] as $k=>$m){
			if($department == $m['id']) $data_field = array($m['parent'],$m['id']);
			$s[$m['id']] = array(
				'i' => $m['id'],
				'n' => $m['name'],
				's' => '',			
			);
			$cates_departments[$m['id']] = $m;
			$cates_departments[$m['id']]['name'] = $row['name'].' > '.$m['name'];
		}		
		if(empty($data_field) && $parent_department == $row['id']) $data_field = array($row['id']);
		if($department == $row['id']) $data_field = array($row['id']);
		$select_data[$row['id']] = array(
			'i' => $row['id'],
			'n' => $row['name'],
			's' => $s,
		);
		if(count($row['menus'])>=1) $select_size = 2;
	}
	$select_json_data = p8_json($select_data);
	//$data_field = empty($department)? array() : explode('-',$department);
	$selectdata = array();
	$inputname = 'department';
	//只选大分类的情况
	$pds = array();
	if(intval($parent_department) && !intval($department)){
		$pds = array($parent_department);
		foreach($cates['department'][$parent_department]['menus'] as $menus){
			$pds[] = $menus['id'];
		}
	}
	
	$select->from($this_module->table, '*');
	
	if($status>='0' && $status!=null)$select->in('status',trim($status));
	if(!empty($department)){
		$select->in('department',trim($department));
	}else if(!empty($parent_department)){
		$select->in('department',$pds);
	}
	if(!empty($type))$select->in('type',trim($type));
	if($fengfa!=-1  && $fengfa!=null)$select->in('fengfa',trim($fengfa));
	if(!empty($comment))$select->in('comment',trim($comment));
	if(!empty($word))$select->like($key_type,trim($word));
	if(!empty($begin))$select->where('create_time>='.strtotime($begin));
	if(!empty($end))$select->where('create_time<='.strtotime($end));
	if($undisplay>='0')$select->in('undisplay',trim($undisplay));
	$select->order('id DESC');

	if($act=='search'){
	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$page = max(1, $page);
	}else{
		$page = 0;
	}

	$page_url = $this_router .'-'. $ACTION .'?page=?page?';

	foreach($search as $v){
		if($v != 'page')$page_url .= '&'.$v.'='.$$v;
	}
	
	//echo $select->build_sql();
	$count = 0;
	$list = $core->list_item(
		$select,
		array(
			'page' => &$page,
			'count' => &$count,
			'page_size' => 20
		)
	);
	foreach($list as $key=>$row) {
        $list[$key]['title'] = p8_cutstr($row['title'],44);
        $list[$key]['dp'] = $this_module->getdp($row);
    }
	$act=='search' && $pages = list_page(array(
			'count' => $count,
			'page' => $page,
			'page_size' => 20,
			'url' => $page_url
		));
	$ptitle = $P8LANG['list'];	
	
	$id_type = $this_module->id_type();
	
	$mana_message = $this_controller->manageMessage();
	$comments = $this_module->get_comments();
	$comments[0] = $P8LANG['comments_0'];
	include template($this_module, "manager");
}
elseif($act=='delete'){
	
	$ids = $_POST['id'];
	if(!$ids)
		message('error',$this_url);
	
	$dids = array();
	foreach($ids as $id){
		$data = $this_module->getData($id);
		if($this_controller->check_acl('delletter',$data['department']))
			$dids[]=$id;
	}
	if($dids)
		$this_module->delete(array('ids'=>$dids));
	
	message(
		array(
				array('to_list', $this_router .'-manager'),
				array('colsed', "javascript:window.close();"),
			),
			$this_router .'-manager',
			3000
		);
}
elseif($act=='del'){
	$id= intval($_GET['id']);
	$data = $this_module->getData($id);
	$this_controller->check_acl('delletter',$data['department']) or	message('no_privilege');
		
	$param = array('ids'=>array($id));
	$this_module->delete($param);

	message(
		array(
				array('to_list', $this_router .'-manager'),
				array('colsed', "javascript:window.close();"),
			),
			$this_router .'-manager',
			3000
		);
}
elseif($act=='verify'){
	$ids = $_POST['id'];
	if(!$ids)
		message('error',$this_url);
	
	$dids = array();
	foreach($ids as $id){
		$data = $this_module->getData($id);
		if($data['status']==0 && $this_controller->check_acl('vefify',$data['department']))
			$dids[]=$id;
	}
	if($dids)
		$this_module->verify(array('ids'=>$dids));
	
	message(
		array(
				array('to_list', $this_router .'-manager'),
				array('colsed', "javascript:window.close();"),
			),
			$this_router .'-manager',
			3000
		);
}

?>