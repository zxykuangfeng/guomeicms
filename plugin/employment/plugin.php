<?php
defined('PHP168_PATH') or die();

class P8_Plugin_Employment extends P8_Plugin{

private $appkey;

function __construct(&$core, $name){
	$this->core = &$core;
	parent::__construct($name);
	$this->table = $this->TABLE_;
}


function _cache(){
	rm(CACHE_PATH .'core/plugin/Employment/date', true);
}

function get_data($id){
	$sql = "SELECT * FROM {$this->table} WHERE id='$id'";
	$query = $this->DB_slave->fetch_all($sql);
	return $query?$query[0]:array();
}

function add($data){
	return $this->DB_slave->insert(
		$this->table,
		$data,
		true
	);

}
function listorder($data){
	return $this->DB_slave->update(
		$this->table,
		$data,
		"id=$id"
	);

}

function update($id,$data){
	return $this->DB_slave->update(
		$this->table,
		$data,
		"id=$id"
	);

}
function delete($id){
	$ids = is_array($id) ? implode(',', $id) : $id;	
	return $this->DB_slave->delete(
			$this->table,
			"id in ($ids)"
		);
}

function get_date($date, $reflash=false){
	if($reflash || !$return = $this->core->CACHE->read('core/plugin/Employment', 'date', $date)){
		$nextdate_1 = date('Y-m-d',strtotime($date)+86400);
		$nextdate_2 = date('Y-m-d',strtotime($date)+86400*2);
		$dat = "'$date','$nextdate_1','$nextdate_2'";
		$sql = "SELECT * FROM {$this->table} WHERE date IN($dat) ORDER BY date DESC, list_order ASC, id ASC";
		$return = $this->DB_slave->fetch_all($sql);
		 $this->core->CACHE->write('core/plugin/Employment', 'date', $date, $return);
	}
	return $return?$return:array();
}

function _display(){
	$this_url = $this->controller.'-display';
	$mon_list = array();
	$today = date("Y-m-d");
	$today_array = explode('-',$today);		
	ob_start();
		include $this->template('_display');
		$content = ob_get_clean();
	echo $content;
}

}
