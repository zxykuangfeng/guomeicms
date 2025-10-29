<?php
/*
 *微信公众号对接API
 */
header('Content-type:text/html; Charset=utf-8');
error_reporting(0);
$flag = file_exists(dirname(__FILE__) ."/../data/cms/modules/wechat/wechat.php");
$config = $flag ? require_once(dirname(__FILE__) ."/../data/cms/modules/wechat/wechat.php") : array();
register_shutdown_function("showDebug");
$msgSignature = $_GET['msg_signature'];
$timestamp = $_GET['timestamp'];
$nonce = $_GET['nonce'];
$xml = file_get_contents('php://input');
$wx = new WXBizMsgCrypt($config['token'], $config['aeskey'], $config['appid']);

if($_GET['echostr']){
    $result = $wx->checkSignature($_GET['signature'],$_GET['timestamp'],$_GET['nonce']);
    if($result){
        echo xss_clear($_GET['echostr']);
        exit ();
    }
}
$msg='';
$errCode = $wx->decryptMsg($msgSignature, $timestamp, $nonce, $xml, $msg);

if ($errCode == 0) {
	require_once(dirname(__FILE__) ."/../inc/init.php");
	$config = $core->get_config('cms','wechat');
	$cms = $core->load_system('cms');
	$wechat = $cms->load_module('wechat');
	$keyword = $msg->Content ? $msg->Content : $msg->EventKey;
	//$keyword = convert_encode('utf-8','gbk',$keyword);
    $openid   = $msg->FromUserName;
	$_SESSION['to_user'] = $msg->FromUserName;
	$_SESSION['from_user'] = $msg->ToUserName;
    $wechat->setWxUserInfo($openid,$config['appid'],$config['appsecret']);
	if($msg->Event=='subscribe' && (substr($msg->EventKey,0,7)=='qrscene')){
        $msg->Event = 'SCAN';
        $msg->EventKey = substr($msg->EventKey,8);
    }
    if($msg->Event=='subscribe'){
        $toUser   = $msg->FromUserName;
        $fromUser = $msg->ToUserName;
        $reply = $config['subscribe_response'] ? $config['subscribe_response'] : '欢迎关注！';
        $wechat->addMessage($toUser,'subscribe','关注公众号',$reply);
        $respondMsg =  '<xml><ToUserName><![CDATA['.$toUser.']]></ToUserName><FromUserName><![CDATA['.$fromUser.']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$reply.']]></Content></xml>';
        echo $respondMsg;
        exit();
    }
    if($msg->Event=='unsubscribe'){
        $toUser = $msg->FromUserName;     //取消关注者的openid
        $wechat->addMessage($toUser,'unsubscribe','取消关注');
        exit();
    }
    if(in_array($msg->MsgType,array('text','event')) && (strtolower($msg->EventKey)=='openid' || strtolower($msg->Content)=='openid')){
        $toUser   = $msg->FromUserName;
        $fromUser = $msg->ToUserName;		
        $wechat->addMessage($toUser,'openid','获取openid',$toUser);
        $replyMsg = '你的openid是：'.$toUser;
        $respondMsg =  '<xml><ToUserName><![CDATA['.$toUser.']]></ToUserName><FromUserName><![CDATA['.$fromUser.']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$replyMsg.']]></Content></xml>';
        echo $respondMsg;
        exit();
    }
    if(in_array($msg->MsgType,array('text','event'))){
        //关键词回复
        $toUser   = $msg->FromUserName;
        $row = $core->DB_master->fetch_one("SELECT * FROM `$wechat->keywords` WHERE keyword = '{$keyword}' and `pattern` = 2");
        if($row){
            $respondMsg = $wechat->getReplyBody($msg,$row['type'],$row['content'],$row['title'],$row['description'],$row['picurl'],$row['url']);
            $wechat->addMessage($toUser,'keyword',$keyword,$row['content']);
            echo $respondMsg;
            exit();
        }
        //模糊匹配
        $query = $core->DB_master->query("SELECT * FROM `$wechat->keywords` WHERE `pattern` = 1 ORDER BY id ASC limit 5");
        while($frow = $core->DB_master->fetch_array($query)){
            if(strstr($keyword,$frow['keyword'])!==false){
                $respondMsg = $wechat->getReplyBody($msg,$frow['type'],$frow['content'],$frow['title'],$frow['description'],$frow['picurl'],$frow['url']);
                $reply = $frow['content'] ? $frow['content'] : $frow['title'];
                $wechat->addMessage($toUser,'keyword',$keyword,$reply);
                echo $respondMsg;
                exit();
            }
        }
    }
	if($config['search_enabled'] && $msg->MsgType=='text'){
        //文章搜索
        $toUser   = $msg->FromUserName;
        $fromUser = $msg->ToUserName;
        $searchCount = $config['search_num']?intval($config['search_num']):1;
        $count = $core->DB_master->fetch_one("SELECT count(*) c from `$wechat->main_table` where title like '%{$keyword}%' or summary like '%{$keyword}%' ORDER BY timestamp DESC limit {$searchCount}");
        if($count['c']>0){
            $query = $core->DB_master->query("SELECT * FROM `$wechat->main_table` where `title` like '%{$keyword}%' or summary like '%{$keyword}%' ORDER BY timestamp DESC limit {$searchCount}");
            $respondMsg = '<xml><ToUserName><![CDATA['.$toUser.']]></ToUserName><FromUserName><![CDATA['.$fromUser.']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[news]]></MsgType><ArticleCount>1</ArticleCount><Articles>';

            $content = "关键字“{$keyword}”的搜索结果如下：\r\n\r\n";
            if(!$config['url_type']){
                $wxService = $wechat->getWxService($config['appid'],$config['appsecret']);
            }
            while($frow = $core->DB_master->fetch_array($query))
            {
                $arcurl = ($core->url ? $core->url : $RESOURCE).'/index.php/cms/item-view-id-'.$frow['id'];
                $arcurl = !$config['url_type'] ? $wxService->createShortUrl($arcurl) : $arcurl;
                $content.="{$frow['title']}\r\n<a href='{$arcurl}'>{$arcurl}</a>\r\n\r\n";
            }
            $content = rtrim($content,"\r\n");
            $respondMsg = $wechat->getReplyBody($msg,'text',$content);
            $wechat->addMessage($toUser,'keyword',$keyword,'《'.$keyword.'》的搜索结果');
            echo $respondMsg;
            exit();
        }
    }
    if($config['default_response']){
        $respondMsg = $wechat->getReplyBody($msg,'text',$config['default_response']);
        $wechat->addMessage($toUser,'text',$keyword,$config['default_response']);
        echo $respondMsg;
        exit();
    }
    $wechat->addMessage($toUser,'text',$keyword);
} else {
   error_log("解密失败：".$errCode, 3, "wechat_log.txt");
}

class WXBizMsgCrypt
{
    private $token;
    private $encodingAesKey;
    private $appId;

    public function __construct($token, $encodingAesKey, $appId)
    {
        $this->token = $token;
        $this->encodingAesKey = $encodingAesKey;
        $this->appId = $appId;
    }

    public function checkSignature($signature,$timestamp,$nonce) {
        $token = $this->token;
        $tmpArr = array ($token, $timestamp, $nonce );
        sort ( $tmpArr, SORT_STRING );
        $tmpStr = implode ( $tmpArr );
        $tmpStr = sha1 ( $tmpStr );

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

    public function encryptMsg($replyMsg, $timeStamp, $nonce, &$encryptMsg)
    {
        $pc = new Prpcrypt($this->encodingAesKey);

        //加密
        $array = $pc->encrypt($replyMsg, $this->appId);
        $ret = $array[0];
        if ($ret != 0) {
            return $ret;
        }

        if ($timeStamp == null) {
            $timeStamp = time();
        }
        $encrypt = $array[1];

        //生成安全签名
        $sha1 = new SHA1;
        $array = $sha1->getSHA1($this->token, $timeStamp, $nonce, $encrypt);
        $ret = $array[0];
        if ($ret != 0) {
            return $ret;
        }
        $signature = $array[1];

        //生成发送的xml
        $xmlparse = new XMLParse;
        $encryptMsg = $xmlparse->generate($encrypt, $signature, $timeStamp, $nonce);
        return ErrorCode::$OK;
    }

    public function decryptMsg($msgSignature, $timestamp = null, $nonce, $postData, &$msg)
    {
        if (strlen($this->encodingAesKey) != 43) {
            return ErrorCode::$IllegalAesKey;
        }

        $pc = new Prpcrypt($this->encodingAesKey);

        //提取密文
        $xmlparse = new XMLParse;
        $array = $xmlparse->extract($postData);

        $ret = $array[0];

        if ($ret != 0) {
            return $ret;
        }

        if ($timestamp == null) {
            $timestamp = time();
        }

        $encrypt = $array[1];
        $touser_name = $array[2];

        //验证安全签名
        $sha1 = new SHA1;
        $array = $sha1->getSHA1($this->token, $timestamp, $nonce, $encrypt);

        $ret = $array[0];

        if ($ret != 0) {
            return $ret;
        }

        $signature = $array[1];
        if ($signature != $msgSignature) {
            return ErrorCode::$ValidateSignatureError;
        }

        $result = $pc->decrypt($encrypt, $this->appId);
        if ($result[0] != 0) {
            return $result[0];
        }
        $msg = simplexml_load_string($result[1], 'SimpleXMLElement', LIBXML_NOCDATA);

        return ErrorCode::$OK;
    }

}

class ErrorCode
{
    public static $OK = 0;
    public static $ValidateSignatureError = -40001;
    public static $ParseXmlError = -40002;
    public static $ComputeSignatureError = -40003;
    public static $IllegalAesKey = -40004;
    public static $ValidateAppidError = -40005;
    public static $EncryptAESError = -40006;
    public static $DecryptAESError = -40007;
    public static $IllegalBuffer = -40008;
    public static $EncodeBase64Error = -40009;
    public static $DecodeBase64Error = -40010;
    public static $GenReturnXmlError = -40011;
}

/**
 * PKCS7Encoder class
 *
 * 提供基于PKCS7算法的加解密接口.
 */
class PKCS7Encoder
{
    public static $block_size = 32;

    function encode($text)
    {
        $block_size = PKCS7Encoder::$block_size;
        $text_length = strlen($text);
        //计算需要填充的位数
        $amount_to_pad = PKCS7Encoder::$block_size - ($text_length % PKCS7Encoder::$block_size);
        if ($amount_to_pad == 0) {
            $amount_to_pad = PKCS7Encoder::block_size;
        }
        //获得补位所用的字符
        $pad_chr = chr($amount_to_pad);
        $tmp = "";
        for ($index = 0; $index < $amount_to_pad; $index++) {
            $tmp .= $pad_chr;
        }
        return $text . $tmp;
    }

    function decode($text)
    {

        $pad = ord(substr($text, -1));
        if ($pad < 1 || $pad > 32) {
            $pad = 0;
        }
        return substr($text, 0, (strlen($text) - $pad));
    }

}

/**
 * Prpcrypt class
 *
 * 提供接收和推送给公众平台消息的加解密接口.
 */
class Prpcrypt
{
    public $key;

    function __construct($k)
    {
        $this->key = base64_decode($k . "=");
    }


















      public function encrypt($text, $appid)
    {
        try {
            //获得16位随机字符串，填充到明文之前
            $random = $this->getRandomStr();
            $text = $random . pack("N", strlen($text)) . $text . $appid;
            $iv = substr($this->key, 0, 16);
            $pkc_encoder = new PKCS7Encoder;
            $text = $pkc_encoder->encode($text);
            $encrypted = openssl_encrypt($text,'AES-256-CBC',substr($this->key, 0, 32),OPENSSL_ZERO_PADDING,$iv);
            return array(ErrorCode::$OK, $encrypted);
        } catch (Exception $e) {
            //print $e;
            return array(ErrorCode::$EncryptAESError, null);
        }
    }

    /**
     * 对密文进行解密
     * @param string $encrypted 需要解密的密文
     * @return string 解密得到的明文
     */
    public function decrypt($encrypted, $appid)
    {
        try {
            $iv = substr($this->key, 0, 16);
            $decrypted = openssl_decrypt($encrypted,'AES-256-CBC',substr($this->key, 0, 32),OPENSSL_ZERO_PADDING,$iv);
        } catch (Exception $e) {
            return array(ErrorCode::$DecryptAESError, null);
        }
        try {
            //去除补位字符
            $pkc_encoder = new PKCS7Encoder;
            $result = $pkc_encoder->decode($decrypted);
            //去除16位随机字符串,网络字节序和AppId
            if (strlen($result) < 16)
                return "";
            $content = substr($result, 16, strlen($result));
            $len_list = unpack("N", substr($content, 0, 4));
            $xml_len = $len_list[1];
            $xml_content = substr($content, 4, $xml_len);
            $from_appid = substr($content, $xml_len + 4);
            if (!$appid)
                $appid = $from_appid;
            //如果传入的appid是空的，则认为是订阅号，使用数据中提取出来的appid
        } catch (Exception $e) {
            //print $e;
            return array(ErrorCode::$IllegalBuffer, null);
        }
        if ($from_appid != $appid)
            return array(ErrorCode::$ValidateAppidError, null);
        //不注释上边两行，避免传入appid是错误的情况
        return array(0, $xml_content, $from_appid);
        //增加appid，为了解决后面加密回复消息的时候没有appid的订阅号会无法回复
    }






















    function getRandomStr()
    {

        $str = "";
        $str_pol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($str_pol) - 1;
        for ($i = 0; $i < 16; $i++) {
            $str .= $str_pol[mt_rand(0, $max)];
        }
        return $str;
    }

}

/**
 * SHA1 class
 *
 * 计算公众平台的消息签名接口.
 */
class SHA1
{
    public function getSHA1($token, $timestamp, $nonce, $encrypt_msg)
    {
        //排序
        try {
            $array = array($encrypt_msg, $token, $timestamp, $nonce);
            sort($array, SORT_STRING);
            $str = implode($array);
            return array(ErrorCode::$OK, sha1($str));
        } catch (Exception $e) {
            //print $e . "\n";
            return array(ErrorCode::$ComputeSignatureError, null);
        }
    }

}

/**
 * XMLParse class
 *
 * 提供提取消息格式中的密文及生成回复消息格式的接口.
 */
class XMLParse
{

    public function extract($xmltext)
    {
        libxml_disable_entity_loader(true);
        try {
            $xml = new DOMDocument();
            $xml->loadXML($xmltext);
            $array_e = $xml->getElementsByTagName('Encrypt');
            $array_a = $xml->getElementsByTagName('ToUserName');
            $encrypt = $array_e->item(0)->nodeValue;
            $tousername = $array_a->item(0)->nodeValue;
            return array(0, $encrypt, $tousername);
        } catch (Exception $e) {
            //print $e . "\n";
            return array(ErrorCode::$ParseXmlError, null, null);
        }
    }

    public function generate($encrypt, $signature, $timestamp, $nonce)
    {
        $format = "<xml>
<Encrypt><![CDATA[%s]]></Encrypt>
<MsgSignature><![CDATA[%s]]></MsgSignature>
<TimeStamp>%s</TimeStamp>
<Nonce><![CDATA[%s]]></Nonce>
</xml>";
        return sprintf($format, $encrypt, $signature, $timestamp, $nonce);
    }

}


function showDebug()
{        
	$error = error_get_last();
	if ($error && in_array($error['type'],array(1024,1))) {
		$pos = strpos($error['message'],'hint');
		if($pos) $error['message'] = substr($error['message'],0,$pos);
		if(is_array($error['message'])){
			$error['message'] = implode(' ',$error['message']);
		}
		$errorString = '错误：'.$error['message'] . ' File: ' . $error['file'] . ' on line ' . $error['line'];
		$respondMsg =  '<xml><ToUserName><![CDATA['.$_SESSION['to_user'].']]></ToUserName><FromUserName><![CDATA['.$_SESSION['from_user'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$errorString.']]></Content></xml>';
		echo $respondMsg;
		exit();
	}
}