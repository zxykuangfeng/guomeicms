<?php
defined('PHP168_PATH') or die();
$this_controller->check_action($ACTION) or message('no_privilege');
GetGP(array('act'));

$act = 'search';
    $fengfa=-1;
	$key_type = 'title';
	$begin = $end = 0;
	$search = array('key_type','begin','end','status','page','action','word','type','department','act','comment','undisplay','fengfa');
	GetGP($search);
	$keyword = $word;
	$select = select();
	
	$my_manage = $this_controller->getcatbyAct('my_letter_manage');
	$display = $this_controller->check_action('display');
	$vefify = $this_controller->check_action('vefify');
	$cates = $this_module->get_category();
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

	$select->from($this_module->table, '*');
	
	$select->in('status',3);
	if(!empty($department))$select->in('department',trim($department));
	if(!empty($type))$select->in('type',trim($type));
	if($fengfa!=-1  && $fengfa!=null)$select->in('fengfa',trim($fengfa));
	if(!empty($comment))$select->in('comment',trim($comment));
	if(!empty($word))$select->like($key_type,trim($word));
	if(!empty($begin))$select->where('create_time>='.strtotime($begin));
	if(!empty($end))$select->where('create_time<='.strtotime($end));
	if($undisplay>='0')$select->in('undisplay',trim($undisplay));
	$select->order('create_time DESC');

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

	include template($this_module, "pull_data");


?>