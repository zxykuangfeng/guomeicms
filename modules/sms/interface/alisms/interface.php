<?php
defined('PHP168_PATH') or die();
/**
* winic接口类,发送手机短信
*/
//namespace Aliyun\DySDKLite;

class P8_SMS_alisms{

var $accessKeyId;	  //您的AK信息 accessKeyId
var $accessKeySecret;	//您的AK信息 accessKeySecret密码
var $SignName;			//短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
var $TemplateCode;		//短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template

function __construct(&$sms, $config){
	$this->sms = &$sms;
	
	$this->accessKeyId = empty($config['accessKeyId']) ? '' : $config['accessKeyId'];
	$this->accessKeySecret = empty($config['accessKeySecret']) ? '' : $config['accessKeySecret'];
	$this->SignName = empty($config['SignName']) ? '' : $config['SignName'];
	$this->TemplateCode1 = empty($config['TemplateCode1']) ? 'SMS_157450405' : $config['TemplateCode1'];
	$this->TemplateCode2 = empty($config['TemplateCode2']) ? 'SMS_157283476' : $config['TemplateCode2'];
}

function P8_SMS_alisms(&$sms, $config){
	$this->__construct($sms, $config);
}

/**
 * 发送短信
 */
function send($send_to,$message){

    $params = array ();

    // *** 需用户填写部分 ***
    // fixme 必填：是否启用https
    $security = false;

    // fixme 必填: 请参阅 https://ak-console.aliyun.com/ 取得您的AK信息
    $accessKeyId = $this->accessKeyId;
    $accessKeySecret =  $this->accessKeySecret;

    // fixme 必填: 短信接收号码
    $params["PhoneNumbers"] = $send_to;

    // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
    $params["SignName"] = $this->SignName;

    // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
	if(count($message)==1)
		$params["TemplateCode"] = $this->TemplateCode2;
	else
		$params["TemplateCode"] = $this->TemplateCode1;
    // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
	//通知：尊敬的用户：${user}，${mtname}。发布时间${submittime}，特此通知。	
    /*$params['TemplateParam'] = Array (
        "mtname" => $message.'-',
		"submittime" => date('m-d', P8_TIME),
    );
	*/
	//尊敬的用户，您的注册会员动态密码为：${code}，请勿泄漏于他人！
	$params['TemplateParam'] = $message;

    // fixme 可选: 设置发送短信流水号
    $params['OutId'] = "";

    // fixme 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
    $params['SmsUpExtendCode'] = "";

    // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
    if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
        $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
    }

   // 此处可能会抛出异常，注意catch
    $content = $this->request(
        $accessKeyId,
        $accessKeySecret,
        "dysmsapi.aliyuncs.com",
        array_merge($params, array(
            "RegionId" => "cn-hangzhou",
            "Action" => "SendSms",
            "Version" => "2017-05-25",
        )),
        $security
    );

    return $content;
}
/**
 * 生成签名并发起请求
 *
 * @param $accessKeyId string AccessKeyId (https://ak-console.aliyun.com/)
 * @param $accessKeySecret string AccessKeySecret
 * @param $domain string API接口所在域名
 * @param $params array API具体参数
 * @param $security boolean 使用https
 * @param $method boolean 使用GET或POST方法请求，VPC仅支持POST
 * @return bool|\stdClass 返回API接口调用结果，当发生错误时返回false
 */
public function request($accessKeyId, $accessKeySecret, $domain, $params, $security=false, $method='POST') {
	$apiParams = array_merge(array (
		"SignatureMethod" => "HMAC-SHA1",
		"SignatureNonce" => uniqid(mt_rand(0,0xffff), true),
		"SignatureVersion" => "1.0",
		"AccessKeyId" => $accessKeyId,
		"Timestamp" => gmdate("Y-m-d\TH:i:s\Z"),
		"Format" => "JSON",
	), $params);
	ksort($apiParams);

	$sortedQueryStringTmp = "";
	foreach ($apiParams as $key => $value) {
		$sortedQueryStringTmp .= "&" . $this->encode($key) . "=" . $this->encode($value);
	}

	$stringToSign = "${method}&%2F&" . $this->encode(substr($sortedQueryStringTmp, 1));

	$sign = base64_encode(hash_hmac("sha1", $stringToSign, $accessKeySecret . "&",true));

	$signature = $this->encode($sign);

	$url = ($security ? 'https' : 'http')."://{$domain}/";

	try {
		$content = $this->fetchContent($url, $method, "Signature={$signature}{$sortedQueryStringTmp}");
		$rs = json_decode($content);
		return $rs->Code;
	} catch( \Exception $e) {
		return false;
	}
}

private function encode($str)
{
	$res = urlencode($str);
	$res = preg_replace("/\+/", "%20", $res);
	$res = preg_replace("/\*/", "%2A", $res);
	$res = preg_replace("/%7E/", "~", $res);
	return $res;
}

private function fetchContent($url, $method, $body) {
	$ch = curl_init();

	if($method == 'POST') {
		curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
		curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
	} else {
		$url .= '?'.$body;
	}

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		"x-sdk-client" => "php/2.0.0"
	));

	if(substr($url, 0,5) == 'https') {
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	}

	$rtn = curl_exec($ch);

	if($rtn === false) {
		// 大多由设置等原因引起，一般无法保障后续逻辑正常执行，
		// 所以这里触发的是E_USER_ERROR，会终止脚本执行，无法被try...catch捕获，需要用户排查环境、网络等故障
		trigger_error("[CURL_" . curl_errno($ch) . "]: " . curl_error($ch), E_USER_ERROR);
	}
	curl_close($ch);

	return $rtn;
}

}

