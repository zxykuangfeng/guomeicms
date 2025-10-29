<?php
if (is_file(__DIR__ . '/../autoload.php')) {
    require_once __DIR__ . '/../autoload.php';
}

use OSS\OssClient;
use OSS\Core\OssException;

// 阿里云主账号AccessKey拥有所有API的访问权限，风险很高。
//强烈建议您创建并使用RAM账号进行API访问或日常运维，请登录 https://ram.console.aliyun.com 创建RAM账号。
$accessKeyId = "LTAI5tPAeHrEwhyGvGC1vMdo";
$accessKeySecret = "8dNxqF7sqYHmrwVp29flXYpbJ3UKSC";
// Endpoint以杭州为例，其它Region请按实际情况填写。
$endpoint = "http://oss-cn-beijing.aliyuncs.com";
$bucket= "php168-net-test";

$ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);

$nextMarker = '';
$maxkeys = 5;
while (true) {
    try {
        $options = array(
            'delimiter' => '',
            'marker' => $nextMarker,
			'max-keys' => $maxkeys,
        );
        $listObjectInfo = $ossClient->listObjects($bucket, $options);
    } catch (OssException $e) {
        printf(__FUNCTION__ . ": FAILED\n");
        printf($e->getMessage() . "\n");
        return;
    }
    // 得到nextMarker，从上一次listObjects读到的最后一个文件的下一个文件开始继续获取文件列表。
    $nextMarker = $listObjectInfo->getNextMarker();
    $listObject = $listObjectInfo->getObjectList();
    $listPrefix = $listObjectInfo->getPrefixList();

    if (!empty($listObject)) {
        print("objectList:\n");
        foreach ($listObject as $objectInfo) {
            print($objectInfo->getKey() . "\n");
        }
    }
    if (!empty($listPrefix)) {
        print("prefixList: \n");
        foreach ($listPrefix as $prefixInfo) {
            print($prefixInfo->getPrefix() . "\n");
        }
    }
    if ($listObjectInfo->getIsTruncated() !== "true") {
       break;
    }
}