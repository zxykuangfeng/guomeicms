<?php
if (is_file(__DIR__ . '/../autoload.php')) {
    require_once __DIR__ . '/../autoload.php';
}
if (is_file(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
}

use OSS\OssClient;
use OSS\Core\OssException;

// 阿里云账号AccessKey拥有所有API的访问权限，风险很高。强烈建议您创建并使用RAM用户进行API访问或日常运维，请登录RAM控制台创建RAM用户。
$accessKeyId = "yourAccessKeyId";
$accessKeySecret = "yourAccessKeySecret";
// yourEndpoint填写Bucket所在地域对应的Endpoint。以华东1（杭州）为例，Endpoint填写为https://oss-cn-hangzhou.aliyuncs.com。
$endpoint = "yourEndpoint";
// 填写Bucket名称，例如examplebucket。
$bucket= "examplebucket";
// 填写Object完整路径，例如exampledir/exampleobject.txt。Object完整路径中不能包含Bucket名称。
$object = "0a397fd572b3d038.jpg";
// <yourLocalFile>由本地文件路径加文件名包括后缀组成，例如/users/local/myfile.txt。
// 填写本地文件的完整路径，例如D:\\localpath\\examplefile.txt。如果未指定本地路径，则默认从示例程序所属项目对应本地路径中上传文件。
$filePath = "D:\\phpstudy_pro\\WWW\\sharp\\attachment\\cms\\item\\2012_09\\02_02\\0a397fd572b3d038.jpg";

$accessKeyId = "LTAI5tPAeHrEwhyGvGC1vMdo";
$accessKeySecret = "8dNxqF7sqYHmrwVp29flXYpbJ3UKSC";
// Endpoint以杭州为例，其它Region请按实际情况填写。
$endpoint = "http://oss-cn-beijing.aliyuncs.com";
$bucket= "php168-net-test";

try{
    $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);

    $ossClient->uploadFile($bucket, $object, $filePath);
} catch(OssException $e) {
    printf(__FUNCTION__ . ": FAILED\n");
    printf($e->getMessage() . "\n");
    return;
}
print(__FUNCTION__ . "OK" . "\n");