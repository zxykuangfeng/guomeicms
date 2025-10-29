<?php
defined('PHP168_PATH') or die();

/**
* 获取推送信箱数据结果
**/
//error_reporting(E_ALL);
header("Content-type:text/html; Charset=utf-8");
$Letter = $core->load_module('letter');
$select = select();
$select->from($Letter->table, '*');
$select->in('status',3);
$select->in('pulled',2);
$select->order('id ASC');
$list = array();
$list = $core->list_item(
		$select,
		array(
			'page' => 1,
			'count' => 0,
			'page_size' => 10
		)
	);

foreach($list as $val){
	$iid = $val['id'];	
	$id = md5($iid.'_letter');
	$url = "http://218.76.27.46:8088/mess/tongbu/getAddVisitContentStatusList.jsp?user=xnxy&password=xnxy2276368&id=$id";
	var_dump($url);
	set_time_limit(0);
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);;
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)");
	$res = curl_exec($ch);
	curl_close ($ch);
	//print_r($res); 
	$xml_array=simplexml_load_string($res);
	$data = json_decode(json_encode($xml_array),TRUE);
	$fileName = "";
	$status = 0;
	$fid = 0;
	if($data){
		$Result = count($data['Result']) >=2 ? end($data['Result']) : $data['Result'];
		$fileName = $Result['@attributes']['fileName'];
		$fid = intval(substr($fileName,5,-4));
		$status = intval($Result['@attributes']['status']);
		if($fid==$iid && $status==1) $Letter->set_pull($iid,1);		
	}
}