<?php
defined('PHP168_PATH') or die();

/**
* 我的表单
**/

//$this_controller->check_action($ACTION) or message('no_privilege');
if(REQUEST_METHOD == 'GET'){
	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$page = max(1, $page);
	$page_url = $this_router .'-'. $ACTION .'?page=?page?';
	$count = 0;
	$select = select();
	$select -> from("$this_module->table as i",'i.*');
	$select -> in('i.uid',$UID);
	$select -> order('i.id DESC');
	$mid = $_mid = isset($_GET['mid'])? intval($_GET['mid']) : 0;
	$mid != 199 or message('no_such_model');
	$model_alias = '';
	if($mid){
		$this_module->set_model($mid) or message('no_such_model');
		$model_alias = $this_model['alias'];
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
		$page_url .="&mid=$mid";
	}
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
	$selectstatus = isset($_GET['selectstatus']) ? $_GET['selectstatus'] : '';

	if($selectstatus!=''){
		$selectstatus = intval($selectstatus);
		$page_url .= "&selectstatus=$selectstatus";
		$select -> in('i.status',$selectstatus);
	}

//echo $select->build_sql();	
	$list = $core->list_item(
		$select,
		array(
			'page' => &$page,
			'count' => &$count,
			'page_size' => 20
		)
	);
	foreach($list as $key=>$detail){
		$this_module->format_data($list[$key],36);
		$this_module->format_view($list[$key]);
		$detail['model_name'] = $this_model['name'];
		$list[$key]['url'] = p8_url($this_module,$detail,'view');
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
	$status = $this_module->CONFIG['status'];
	$my_addible_forms =  $this_controller->get_acl('my_forms_post');
	$models = $this_module->core->CACHE->read('core/modules', 'forms', 'models');
	foreach($models as $key=>$mv){
		if($mv['id'] == 199 || empty($mv['enabled'])) unset($models[$key]);
	}
	if(!isset($my_addible_forms[0]) && !$IS_FOUNDER){
		foreach($models as $mname => $mdata){
			if(!array_key_exists($mdata['id'],$my_addible_forms))
			unset($models[$mname]);
		}
	}
	
	include template($this_module, 'myforms');
}else if(REQUEST_METHOD == 'POST'){
	$action =  isset($_POST['action'])? $_POST['action'] : '';
	if($action == 'delete'){
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