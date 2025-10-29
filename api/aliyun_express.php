<?php
	/*
	 快递物流查询接口
	 */
    $host = "http://kdwlcxf.market.alicloudapi.com";//api访问链接
    $path = "/kdwlcx";//API访问后缀
    $method = "GET";
    $appcode = "5812d1a5b0c24dc0981e5a5051873cd9";
    $headers = array();	
    array_push($headers, "Authorization:APPCODE " . $appcode);    
	$querys = "no=".trim($_GET['no'])."&type=".trim($_GET['type']);
	if($_GET['type'] == 'others') $querys = "no=".trim($_GET['no']);
    $bodys = "";
    $url = $host . $path . "?" . $querys;//url拼接

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    if (1 == strpos("$".$host, "https://"))
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
    echo(curl_exec($curl));
?>