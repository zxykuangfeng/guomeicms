<?php
defined('PHP168_PATH') or die();

/**
* 我管理的表单
**/

//$this_controller->check_action($ACTION) or message('no_privilege');
$my_forms_manage = $this_controller->get_acl('my_forms_manage');
$mids = $my_forms_manage? array_keys($my_forms_manage) : array();

if(REQUEST_METHOD == 'GET'){
	$mid = $_mid = 199;
	$iid = isset($_GET['iid'])? intval($_GET['iid']) : '';
	$iid or message('no_such_item');	
	if(isset($_GET['display']) && in_array($_GET['display'],array(2,1))){
		$display = isset($_GET['display']) ? intval($_GET['display']) : 0;
	}else{
		$display = null;
	}	
	$this_model = array();
	$model_alias = '';
	if($mid){
		$mids = $mid;
		$this_module->set_model($mid) or message('no_such_model');
		$model_alias = $this_model['alias'];
	}
	$data = $this_module->get_data($iid,$this_model['name']);
	if(!$IS_FOUNDER && ($this_controller->check_action('manage') || $this_controller->check_action('verify') || $this_controller->check_action('verify_first')) && $data['uid'] != $UID){
		message('no_privilege');
	}
	if(empty($mids) && !$mid && !$IS_FOUNDER) message('no_privilege');
	
	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$page = max(1, $page);
	$page_url = $this_router .'-'. $ACTION .'?page=?page?';
	$page_url .="&mid=$mid";
	$count = 0;
	$select = select();
	$select -> from("$this_module->table as i",'i.*');
	//$select -> in("i.mid",199,true);
	if($mid){
		$select -> left_join("$this_module->data_table as d",'d.*','i.id=d.id');
		$select -> in('i.mid',$mid);
		//自定义字段过滤
		$F = isset($_GET['field#']) ? $_GET['field#'] : array();
		$F || $F=$_GET;		
		if(isset($F['mid'])) unset($F['mid']);
		foreach($this_model['filterable_fields'] as $field=>$field_data){
			if(!empty($F[$field])){
				if(in_array($field_data['widget'],array('text','vscode','captcha'))){
					$data[$field] = html_entities2($F[$field]);
					$page_url .= "&$field=$F[$field]";
					if($field_data['CONFIG']['filter_type'])
						$select -> in("d.$field",p8_addslashes($F[$field]));
					else
						$select -> like("d.$field",p8_addslashes($F[$field]));
				}elseif($field_data['widget']=='radio' || $field_data['widget']=='select' || $field_data['widget']=='city'){
					$data[$field] =  html_entities2($F[$field]);
					$page_url .= "&$field=$F[$field]";
					$select -> in("d.$field",p8_addslashes($F[$field]));
				}elseif($field_data['widget']=='checkbox' || $field_data['widget']=='multi_select'){
					if(!empty($F[$field])){
					if(!is_array($F[$field]))
						$F[$field] = explode('-',$F[$field]);
						$page_url .= "&{$field}=";
						$split = '';
						foreach($F[$field] as $v){
							if(array_key_exists($v,$field_data['data'])){
								$data[$field][] = $v;
								$page_url .= $split.$v;
								$select -> like("d.$field",p8_addslashes($v));
								$split = '-';
							}	
						}
					}
				}elseif($field_data['widget']=='linkage'){
					foreach($F[$field] as $k=>$vl){
						if($vl)
							$data[$field] = $vl;
					}
					if($data[$field]){
						$page_url .= "&$field=$F[$field]";
						$select -> like("d.$field",p8_addslashes($data[$field]),'left');
					}
				}
			}
		}
	}
	if($IS_FOUNDER && $mid || !$IS_FOUNDER) $select -> in('i.mid',$mids);
	//$select -> left_join("$this_module->model_table as m",'m.name as model_name','i.mid=m.id');
	//搜索条件
	$mindate = isset($_GET['mindate']) ? $_GET['mindate'] : '';
	if($mindate){
		$page_url .= "&mindate=$mindate";
		$select -> range('i.timestamp',strtotime($mindate));
	}
	$maxdate = isset($_GET['maxdate']) ? $_GET['maxdate'] : '';
	if($maxdate){
		$page_url .= "&maxdate=$maxdate";
		$select -> range('i.timestamp',null,strtotime($maxdate));
	}
	$username = isset($_GET['username']) ? p8_html_filter($_GET['username']) : '';
	if($username){
		$page_url .= "&username=$username";
		$select -> like('i.username',$username);
	}
	$name = isset($_GET['name']) ? p8_html_filter($_GET['name']) : '';
	if($name){
		$page_url .= "&name=$name";
		$member_table = $core->TABLE_.'member';
		$select -> left_join("$member_table as member",'member.name as name','i.username=member.username');
		$select -> like('member.name',$name);
	}
	if(isset($display) && in_array($display,array(2,1))){
		$page_url .= "&display=$display";
		$select -> in('i.display',$display == 2 ? 0 : 1);
	}
	$selectstatus = isset($_GET['selectstatus']) ? $_GET['selectstatus'] : '';

	if($selectstatus!=''){
		$selectstatus = intval($selectstatus);
		$page_url .= "&selectstatus=$selectstatus";
		$select -> in('i.status',$selectstatus);
	}
	
	$select -> order('i.id DESC');
	//echo $select->build_sql();	
	$list = $core->list_item(
		$select,
		array(
			'page' => &$page,
			'count' => &$count,
			'page_size' => 20
		)
	);	
	$this_module->CONFIG['htmlize'] = $this_module->CONFIG['htmlize_view'] = $this_module->CONFIG['htmlize_post'] = $this_module->CONFIG['htmlize_list'] = 0;
	foreach($list as $key=>$detail){
		//var_dump($detail);
		$this_module->format_data($list[$key],36);
		$this_module->format_view($list[$key]);	
		$detail['model_name'] = $this_model['name'];		
		$list[$key]['url'] = p8_url($this_module,$detail,'view');
		$list[$key]['url'] = str_replace('/html//','/html/'.$detail['model_name'].'/',$list[$key]['url']);		
	}	
	if(P8_AJAX_REQUEST){
		$page_url = $this_url .'?';
		$page_url = 'javascript:IntraForms.request_item(?page?,'.$mid.')';
		$json = p8_json(
			array('list'=>$list, 
				'pages'=>list_page(array(
				'count' => $count,
				'page' => $page,
				'page_size' => 20,
				'url' => $page_url
			))
			
			));
		exit($json);
	}
	$pages = list_page(array(
		'count' => $count,
		'page' => $page,
		'page_size' => 20,
		'url' => $page_url
	));

	$manage = $this_controller->check_action('manage');
	$my_addible_forms = $manage? $this_controller->get_acl('my_forms_manage') : $this_controller->get_acl('my_forms_post');
	if(!isset($my_addible_forms[0]) && !$IS_FOUNDER){
		foreach($models as $mname => $mdata){
			if(!array_key_exists($mdata['id'],$my_addible_forms))
			unset($models[$mname]);
		}
	}
	
	$status = $this_module->CONFIG['status'];
	$statuses = $this_module->get_statuses();
	$status_json = p8_json($status);
	include template($this_module, 'manage');
	
}else if(REQUEST_METHOD == 'POST'){
	$action =  isset($_POST['action'])? $_POST['action'] : '';
	
	if($action == 'check_status'){
		$id =  isset($_POST['id']) ? intval($_POST['id']) : '';
		$data = $this_module->DB_master->fetch_one("SELECT id, status, reply FROM $this_module->table WHERE id = '$id'");
		exit(p8_json($data));
	}else if($action == 'set_status'){
		$id =  isset($_POST['id']) ? filter_int($_POST['id']) : array();
		$oid = isset($_POST['oid']) ? intval($_POST['oid']) : '';
		$status = isset($_POST['status']) ? intval($_POST['status']) : '';
		$reply = isset($_POST['reply']) ? from_utf8(p8_html_filter($_POST['reply'])) : '';
		if(!$id && !$oid )exit('[]');
		$realarray = $oid? array($oid) : $id;
		
		$resule = $this_module->status(array(
			'ids' => implode(",",$realarray),
			'reply' => $reply,
			'status' => $status,
			'replyer' => $USERNAME
		));
		
		
		exit(p8_json($resule));
		
	}else if($action == 'verify'){
		
		$id =  isset($_POST['id']) ? filter_int($_POST['id']) : array();
		$oid = isset($_POST['oid']) ? intval($_POST['oid']) : '';
		$ov = isset($_POST['ov']) ? intval($_POST['ov']) : '';
		if(!$id && !$oid)exit('[]');
		$realarray = $oid? array($oid) : $id;
		$resule = $this_module->verify(array(
			'ids' => implode(",",$realarray),
			'ov' => $ov
		));
		
		
		exit(p8_json($resule));
		
	}else if($action == 'delete'){
		$id =  isset($_POST['id']) ? filter_int($_POST['id']) : array();
		$oid = isset($_POST['oid']) ? intval($_POST['oid']) : '';
		$mid = isset($_POST['mid']) ? intval($_POST['mid']) : '';
		if(!$id && !$oid || !$mid)exit('[]');
		$this_module->set_model($mid);
		$realarray = $oid? array($oid) : $id;
		
		$resule = $this_module->delete(array('ids' => $realarray));
		
		
		exit(p8_json($resule));
		
	}
}
