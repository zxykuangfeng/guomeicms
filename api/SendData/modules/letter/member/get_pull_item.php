<?php
header("Content-type:text/html; Charset=utf-8");
$iid = intval($_GET['iid']);
$id= trim($_GET['id']);
if(!$id || !$iid) message('error',$this_router .'-pull_data',2);

$url = "http://218.76.27.46:8088/mess/tongbu/getAddVisitContentStatusList.jsp?user=xnxy&password=xnxy2276368&id=$id";

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
	if($fid==$iid && $status==1){
		$this_module->set_pull($iid,1);
		message('获取成功，推送数据成功',$this_router .'-pull_data',3000);
	}	
}else{
	message('没有从省厅获取成功，请尝试重新推送数据',$this_router .'-pull_data',3000);	
}

?>
