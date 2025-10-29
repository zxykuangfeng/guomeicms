<?php
defined('PHP168_PATH') or die();

/**
* 登录
**/

header('Content-Type: application/javascript; charset=utf-8');
if(REQUEST_METHOD == 'GET'){
	if(isset($_GET['username']) || isset($_GET['password'])){
		exit('attack');
	}
    $forward=HTTP_REFERER; 
	$id = $_GET['id'] ? intval($_GET['id']) : 0;
	if(empty($id)){
		exit('attack');
	}
	$data = array();
	if($UID){
		$this_module->set_model($ROLE_GROUP);
		$member_info = $this_module->get_member_info($UID);
		//调取报名信息
		$tender_module = $core->load_module('tender');
		$get_bidding_info = $tender_module->get_model_info('bidding') ? $tender_module->get_model_info('bidding') : array();
		$data['company'] = $member_info['dwmc'] ? $member_info['dwmc'] : '';
		$data['contact'] = $member_info['lxname'] ? $member_info['lxname'] : '';
		$data['telephone'] = $member_info['lxtel'] ? $member_info['lxtel'] : '';
		$data['address'] = $member_info['lxdz'] ? $member_info['lxdz'] : '';
	}else{
		$tender_module = $core->load_module('tender');
		$tender_module->set_model('1');
		$data = $tender_module->get_data($id,'tender');
		$forward = p8_url($tender_module,$data,'view');
		$forward = str_replace('/html//','/html/'.$this_model['name'].'/',$forward);
		$forward = str_replace('modules/tender/html/', 'html/', $forward);
		$forward = str_replace('//view_', '/'.$this_model['name'].'/view_',$forward);
	}
	ob_start();
	include template($this_module, 'login/bidding');
	$show=ob_get_contents();
	ob_end_clean();
	$show=str_replace(array("\n","\r","'"),array("","","\'"),$show);
	echo "$('#bidding_info').html('$show');";
	exit;
    

}