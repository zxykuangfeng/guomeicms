<?php
defined('PHP168_PATH') or die();

class P8_CMS_Wechat_Controller extends P8_Controller{

var $category_acl;
var $att_ids;

function __construct(&$obj){
	//$this->no_base_acl = true;
	parent::__construct($obj);
}

function P8_CMS_Wechat_Controller(&$obj){
	$this->__construct($obj);
}

function _init(){
	//获取基于分类的权限控制表
	$this->category_acl = $this->get_acl('category_acl');
}

/**
* 检查分类权限
**/
function check_category_action($action, $cid = 0){
	global $IS_FOUNDER;
	if($IS_FOUNDER) return true;
	
	//如果没有上一级权限
	if(!parent::check_action($action)) return false;
	
	//如果拥有所有分类的权限
	if(!empty($this->category_acl[0]['actions'][$action])) return true;
	
	return !empty($this->category_acl[$cid]['actions'][$action]);
}

/**
* 检查分级审核权限
**/
function verify_acl($value){
	global $IS_FOUNDER;
	if($IS_FOUNDER) return true;
	
	return !empty($this->model->CONFIG['verify_acl'][$value]['role'][$this->model->system->ROLE]);
}

function update($id, &$POST, $verified = true){
	
	$T = $verified ? $this->model->main_table : $this->model->unverified_table;
	
	$orig_data = $this->DB_master->fetch_one("SELECT i.*, m.role_id FROM $T AS i
	LEFT JOIN {$this->model->system->member_table} AS m ON i.uid = m.id
	WHERE i.id = '$id'");
	if(empty($orig_data)) return false;
	
	
	global $UID, $IS_FOUNDER;
	if($UID != $orig_data['uid']){
		//检查权限,不是内容所有者,不是创始人,没有修改当前分类内容权限的
		
		if(!$this->check_category_action('update', $orig_data['cid'])){
			return false;
		}
	}
	
	//验证数据
	$data = $this->valid_data($POST);
	
	$data['addon']['addon_summary'] = &$data['main']['summary'];
	$data['addon']['addon_frame'] = &$data['main']['frame'];
	if($data['main']['list_order'] == P8_TIME){
		$data['main']['list_order'] = $data['item']['list_order'] = $orig_data['timestamp'];
	}
	
	$data['main']['update_time'] = $data['item']['update_time'] = P8_TIME;
	
	//不允许改动的字段
	unset($data['addon']['iid'], $data['addon']['ip'], $data['addon']['id'], $data['addon']['page']);

	return $this->model->update($id, $data, $orig_data, $verified);
}


function delete($data){
	
	$T = $data['verified'] ? $this->model->main_table : $this->model->unverified_table;
	
	$query = $this->DB_master->query("SELECT
	$T.id, $T.cid, $T.uid FROM $T 
	WHERE $data[where]");
	
	$ids = $comma = '';
	while($arr = $this->DB_master->fetch_array($query)){
		//检查权限
		if(!$this->check_category_action('delete', $arr['cid'])) continue;
		
		$ids .= $comma . $arr['id'];
		$comma = ',';
	}
	
	if(!$ids) return array();
	
	$data['where'] = "$T.id IN ($ids)";
	
	return $this->model->delete($data);
}



}
