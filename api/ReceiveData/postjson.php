<?php

//首先检测是否支持curl
header('Content-type: application/json');
if (!extension_loaded("curl")) {   

	trigger_error("对不起，请开启curl功能模块！", E_USER_ERROR);

}

//构造xml

$xmldata ='{
	"id":"1634",
	"verified":"1",
    "catalogName": "新闻资讯@国内国际",
    "title": "新闻标题更新测试",
    "type": "1",
    "content": "<p>html内容</p><img src=\'/upload/2017/5/23/xx.jpg\'></img>",
    "logo": "/upload/2017/5/23/xx.jpg",
    "author": "作者",
    "keyword": "关键词",
    "summary": "摘要",
    "username": "ocean",
    "videoUrl": "/upload/2017/5/23/xx.mp4",
    "images": [
        {
            "image": "/upload/2017/5/23/xx.jpg",
            "note": "图片名"
        }
    ],
    "files": [
        {
            "filename": "xxxx.mp4",
            "fileurl": "/upload/2017/5/23/xx.mp4"
        },
        {
            "filename": "xxx.jpg",
            "fileurl": "/upload/2017/5/23/xx.jpg"
        }
    ]
}';
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

$ret = curl_exec($curl);

//关闭cURL资源，并且释放系统资源

curl_close($curl);
//var_dump($ret);

?>