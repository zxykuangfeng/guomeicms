<?php
defined('PHP168_PATH') or die();

/**
* 添加模型内容入口文件
**/
//1反跨站请求伪造（CSRF）
$csrf_enable = $core->CONFIG['csrf_enable'] ? true : false;

if(REQUEST_METHOD == 'GET' || defined('P8_GENERATE_HTML')){
	$SEO_KEYWORDS = $SEO_DESCRIPTION = '';
	$TITLE = $P8LANG['letter'] .'_'. $core->CONFIG['site_name'];
	
	$id=intval($_GET['id']);
	if(!$id)
		message('error');

	$id_type = $this_module->id_type();
	$data = $this_module->getData($id,'all');
	$data['data'][0]['content'] = html_decode_entities($data['data'][0]['content']);
	if($data['uid']!=$UID)message('no_privilege');
		
	!empty($data['attachment']) && $data['attachment']= attachment_url($data['attachment']);
	
	$cates = $this_module->get_category();
	//二级部门处理
	$select_size = 1;
	$select_data = array();
	$data_field = array();
	//构建一级
	foreach($cates['department'] as $key => $row){
		if($row['parent']) continue;
		$s = array();
		foreach($row['menus'] as $k=>$m){
			if($data['department'] == $m['id']) $data_field = array($m['parent'],$m['id']);
			$s[$m['id']] = array(
				'i' => $m['id'],
				'n' => $m['name'],
				's' => '',			
			);
		}
		if($data['department'] == $row['id']) $data_field = array($row['id']);
		$select_data[$row['id']] = array(
			'i' => $row['id'],
			'n' => $row['name'],
			's' => $s,
		);
		if(count($row['menus'])>=1) $select_size = 2;
	}
	$select_json_data = p8_json($select_data);
	//$data_field = empty($data['department'])? array() : explode('-',$data['department']);
	$selectdata = array();
	$inputname = 'department';
	$attachment_hash = unique_id(16);
	$widget = isset($this_module->CONFIG['widget']) && $this_module->CONFIG['widget'] ? $this_module->CONFIG['widget'] : 'widget_textarea';
	//2csrf-token
	$token_key =  "p8_".$_P8SESSION['_hash'].time();
	$token = authcode_token($token_key,'ENCODE');
	include template($this_module, 'update');

}else if(REQUEST_METHOD == 'POST'){
	
	//如果魔法引号开启strip掉
	$_POST = p8_stripslashes2($_POST);
	$data = $this_module->getData(intval($_POST['id']));
	if($data['uid']!=$UID)message('no_privilege');
	//3反跨站请求伪造（CSRF）
	if($csrf_enable){
		$token = authcode_token($_POST['token']);
		$token or message('token_error');
	}
	$department = $_POST['department'] = isset($_POST['department'])? intval($_POST['department']): 0;
	$parent_department = $_POST['parent_department'] = isset($_POST['parent_department'])? intval($_POST['parent_department']): 0;
	if(empty($department) && !empty($parent_department)) $_POST['department'] = $parent_department;
	$status = $this_controller->update($_POST) or message('fail');
	
	unset($_POST);
	$message = $P8LANG['edit_success'];
	$reurl = $this_url.'?id='.$status['id'];
	include template($this_module, 'message');		
}
