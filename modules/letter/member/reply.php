<?php
defined('PHP168_PATH') or die();
$this_controller->check_action('manager') or message('no_privilege');
GetGP(array('id','act'));
if(!$id)
	message('error');
$data = $this_module->getData($id,'all');

$this_controller->check_acl('manager',$data['department']) or	message('no_privilege');

if(REQUEST_METHOD=='GET'){
//print_r($data);
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
	
	$id_type = $this_module->id_type();
	$ptitle = $P8LANG['reply'];	
	
	$shortcutsms = $core->load_module('shortcutsms');
	$shortcuts = $shortcutsms->getAll();
	$mana_message = $this_controller->manageMessage();
	include template($this_module, "reply");
}else if(REQUEST_METHOD=='POST'){

	$this_controller->reply($_POST);
message(	array(
				array('to_list', $this_router .'-manage'),
				array('to_update', $this_url .'?id='.$_POST['id']),
			),
			$this_router .'-manage',
			3000
		);

}

?>
