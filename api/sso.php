<?php
/**
* 单点登录
**/

require_once dirname(__FILE__) .'/../inc/init.php';
$inte = &$core->integrate();

$request = p8_stripslashes2($_POST + $_GET);
if(!empty($inte->CONFIG['script']) && file_exists(PHP168_PATH .'inc/integrate/sso/'.$inte->CONFIG['script'])){
    include PHP168_PATH .'inc/integrate/sso/'.$inte->CONFIG['script'];
}else{
   echo '<br/>error-没有正确配置单点登录';  
}
