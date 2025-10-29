<?php

//首先检测是否支持curl
header('Content-type: application/json');
if (!extension_loaded("curl")) {   

	trigger_error("对不起，请开启curl功能模块！", E_USER_ERROR);

}

//构造xml

$xmldata='<?xml version="1.0" encoding="utf-8"?>';
$xmldata .="
<Article> 
  <catalogName>新闻资讯@国内国际</catalogName>  
  <title>新闻标题</title>  
  <type>1</type>  
  <content><![CDATA[<p>html内容</p><img src='/upload/2017/5/23/xx.jpg'></img>]]></content>  
  <logo>/upload/2017/5/23/xx.jpg</logo>  
  <author>作者</author>  
  <keyword>关键词</keyword>  
  <summary>摘要</summary>  
  <username>ocean</username>  
  <videoUrl>/upload/2017/5/23/xx.mp4</videoUrl>  
  <images> 
    <image>/upload/2017/5/23/xx.jpg</image>  
    <note>图片信息</note>  
    <image>/upload/2017/5/23/xxxx.jpg</image>  
    <note>图片路径</note> 
  </images>  
  <files> 
    <filename>xxxx.mp4</filename>  
    <fileurl>/upload/2017/5/23/xx.mp4</fileurl>  
    <filename>xxx.jpg</filename>  
    <fileurl>/upload/2017/5/23/xx.jpg</fileurl> 
  </files> 
</Article>
";

//初始一个curl会话

$curl = curl_init();

//设置url
$user = urlencode("admin"); 
$password = urlencode("admin123!@#");
curl_setopt($curl, CURLOPT_URL, "http://xxxx/api/updateNews.php?u=".$user."&p=".$password);

//设置发送方式：post
curl_setopt($curl, CURLOPT_POST, true);

//设置发送数据

curl_setopt($curl, CURLOPT_POSTFIELDS, $xmldata);

//抓取URL并把它传递给浏览器

curl_exec($curl);

//关闭cURL资源，并且释放系统资源

curl_close($curl);

?>