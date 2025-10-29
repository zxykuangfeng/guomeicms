<?php
/**
 * 微信文章群发类
 */
@set_time_limit(0);
require_once PHP168_PATH .'inc/httpdown.class.php';

class weixinPush
{
    protected $appid;
    protected $appsecret;
    protected $templateId;
    protected $token = null;
    protected $cHttpDown = null;
    public $data = null;
	protected $pushlogs;

    public function __construct($appid, $appsecret)
    {
        $this->appid = $appid;
        $this->appsecret = $appsecret;
        $this->token = $this->getToken();
        $this->cHttpDown = new HttpDown();
		$this->pushlogs = 'p8_cms_wechat_pushlogs';
    }

    /**
     * 上传临时素材
     * @param $type   图片（image）、语音（voice）、视频（video）和缩略图（thumb）
     * @param $filepath   图片路径
     * @return 素材id
     */
    function upload($type,$filepath)
    {
		global $RESOURCE;
		$gettoken = $this->getToken() ? $this->getToken() : $this->getToken(true);
        $url = 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token='.$gettoken.'&type='.$type;
 		if(strstr($filepath,$RESOURCE)){
            //本地图片
            $okurl = PHP168_PATH .substr($filepath,strlen($RESOURCE)+1);
        }elseif(substr($filepath,0,8)=='<!--#p8_'){
			//本地图片
			$filepath = str_replace("<!--#p8_r_attach1#-->","<!--#p8_attach#-->",$filepath);
			$okurl = PHP168_PATH .substr($filepath,strlen('<!--#p8_attach#-->')+1);
		}else{
            //远程图片
            $okurl = $this->DownMedia($filepath);
        }

        //上传至微信
        if(version_compare(phpversion(),'5.5.0') >= 0 && class_exists('\CURLFile')){
            $data = array('media' => new \CURLFile($okurl));
        } else {
            $data = array('media'=>'@'.$okurl);
        }
        $result = self::curlPost($url,$data);
        $resultArr = json_decode($result,true);
        if($resultArr['errcode']){
            message('上传缩略图失败'.$resultArr['errmsg']);
        }
        return $resultArr['media_id'];
    }

    /**
     * 上传图片
     */
    function uploadPic($filepath)
    {
		global $RESOURCE;
		$gettoken = $this->getToken() ? $this->getToken() : $this->getToken(true);
        $url = 'https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token='.$gettoken;
        if(strstr($filepath,$RESOURCE)){
            //本地图片
            $okurl = PHP168_PATH .substr($filepath,strlen($RESOURCE)+1);
        }elseif(substr($filepath,0,8)=='<!--#p8_'){
			//本地图片
			$filepath = str_replace("<!--#p8_r_attach1#-->","<!--#p8_attach#-->",$filepath);
			$okurl = PHP168_PATH .'attachment/'.substr($filepath,strlen('<!--#p8_attach#-->')+1);
		}else{
            //远程图片
            $okurl = $this->DownMedia($filepath);
        }
		if(version_compare(phpversion(),'5.5.0') >= 0 && class_exists('\CURLFile')){
            $data = array('media' => new \CURLFile($okurl));
        } else {
            $data = array('media' => '@' . $okurl);
        }
        $result = self::curlPost($url,$data);
        $resultArr = json_decode($result,true);
        if($resultArr['errcode']==40001){
            $this->getToken(true);
            return $this->uploadPic($filepath);
        }
        if(empty($resultArr)){
            message('上传图片出错：'.$result);
        }
        if(!isset($resultArr['url'])){
            message('获取图片url出错：'.$resultArr['errmsg']);
        }
        return $resultArr['url'];
    }

    /**
     * 上传图文消息
     * @param $thumb_media_id  图文消息缩略图的media_id
     * @param $author  作者
     * @param $title   标题
     * @param $content 内容
     * @param string $digest  描述，如本字段为空，则默认抓取正文前64个字
     * @param string $content_source_url  点击“阅读原文”后的页面
     * @param int $show_cover_pic  是否显示封面，1为显示，0为不显示
     * @return mixed
     */
    function uploadnews($arcRows,$show_cover_pic=0)
    {
		$gettoken = $this->getToken() ? $this->getToken() : $this->getToken(true);
        $url = 'https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token='.$gettoken;
		$items = array();
        $i=0;
        foreach ($arcRows as $arcRow){

            $items['articles'][$i] = array(
                'thumb_media_id'=>$arcRow['litpic_id'],
                'author'=>$arcRow['author'],
                'title'=>$arcRow['title'],
                'content_source_url'=>$arcRow['arcurl'],
                'content'=>$this->filter_content($arcRow['body']),
                'digest'=>$arcRow['description'],
                'show_cover_pic'=>$show_cover_pic,
				'need_open_comment'=>intval($arcRow['open_comment']),
                'only_fans_can_comment'=>intval($arcRow['fans_comment']),
            );
            $i++;
        }
        $result = self::curlPost($url,$this->json_encode_ex($items,'utf-8'));
        $resultArr = json_decode($result,true);
        if(empty($resultArr)){
            message('上传图文出错：'.$result);
        }
        if($resultArr['errcode']==40001){
            message('获取media_id出错：errcode:'.$resultArr['errcode'].'  '.$resultArr['errmsg']);
        }
        if(!isset($resultArr['media_id'])){
            message('获取media_id出错：errcode:'.$resultArr['errcode'].'  '.$resultArr['errmsg']);
        }
        return $resultArr;
    }

    function filter_content($str)
    {
        $str = str_replace("\r\n","",$str);
        $str = str_replace('"','\"',$str);
        $str = trim($str);
        $str = str_replace('	','',$str);
        //去除图片style属性
        $str = $this->removeImgAttr($str);
        return $str;
    }

    function removeImgAttr($content){
        $content =  preg_replace('/(<img.*?)style=\".*?\"/i', '$1$3', $content);
        $content =  preg_replace('/(<img.*?)style=\\\".*?\\\"/i', '$1$3', $content);
        return $content;
    }

    /**
     *获取公众号已创建的标签
     */
    function getTagId()
    {
		$gettoken = $this->getToken() ? $this->getToken() : $this->getToken(true);
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/get?access_token='.$gettoken;
        $result = self::curlGet($url);
        $result = json_decode($result,true);
        if($result['errcode']==40001){
            $url = 'https://api.weixin.qq.com/cgi-bin/tags/get?access_token='.$this->getToken(true);
            $result = self::curlGet($url);
            $result = json_decode($result,true);
        }
        return $result;
    }
	
	/**
     *获取指定图文的回复列表
     */
    function getReplyList($msgId,$no=0,$begin=0,$count=10)
    {
		$gettoken = $this->getToken() ? $this->getToken() : $this->getToken(true);
        $url = 'https://api.weixin.qq.com/cgi-bin/comment/list?access_token='.$gettoken;
        $data['msg_data_id'] = $msgId;
        $data['index'] = intval($no);
        $data['begin'] = intval($begin);
        $data['count'] = intval($count);
        $data['type'] = 0;
        $result = self::curlPost($url,json_encode($data));
        $resultArr = json_decode($result,true);
        $data['code'] = 1;
        if($resultArr['errcode']==40001){
            $this->getToken(true);
            message('token过期，请重试');
        }
        if($resultArr['errcode']){
            $data['msg'] = $resultArr['errmsg'];
            return $data;
        }
        if($resultArr['total']==0){
            $data['msg'] = '该文章还没有人评论或没有更多评论！';
            return $data;
        }
        $data['code'] = 0;
        $data['comment'] = $resultArr['comment'];
        $data['total'] = $resultArr['total'];
        return $data;
    }

    function doMarkelect($commentId,$msgId,$no=0)
    {
		$gettoken = $this->getToken() ? $this->getToken() : $this->getToken(true);
        $url = 'https://api.weixin.qq.com/cgi-bin/comment/markelect?access_token='.$gettoken;
        $data['msg_data_id'] = $msgId;
        $data['index'] = intval($no);
        $data['user_comment_id'] = intval($commentId);
        $result = self::curlPost($url,json_encode($data));
        $resultArr = json_decode($result,true);
        $data['code'] = 1;
        if($resultArr['errcode']==40001){
            $this->getToken(true);
            message('token过期，请重试');
        }
        if($resultArr['errcode']){
            $data['msg'] = $resultArr['errmsg'];
            return $data;
        }
        $data['code'] = 0;
        return $data;
    }

    function cancelMarkelect($commentId,$msgId,$no=0)
    {
		$gettoken = $this->getToken() ? $this->getToken() : $this->getToken(true);
        $url = 'https://api.weixin.qq.com/cgi-bin/comment/unmarkelect?access_token='.$gettoken;
        $data['msg_data_id'] = $msgId;
        $data['index'] = intval($no);
        $data['user_comment_id'] = intval($commentId);
        $result = self::curlPost($url,json_encode($data));
        $resultArr = json_decode($result,true);
        $data['code'] = 1;
        if($resultArr['errcode']==40001){
            $this->getToken(true);
            message('token过期，请重试');
        }
        if($resultArr['errcode']){
            $data['msg'] = $resultArr['errmsg'];
            return $data;
        }
        $data['code'] = 0;
        return $data;
    }

    function doReplyComment($commentId,$msgId,$no=0,$content='')
    {
		$gettoken = $this->getToken() ? $this->getToken() : $this->getToken(true);
        $url = 'https://api.weixin.qq.com/cgi-bin/comment/reply/add?access_token='.$gettoken;
        $data['msg_data_id'] = $msgId;
        $data['index'] = intval($no);
        $data['user_comment_id'] = intval($commentId);
        $data['content'] = $content;
        $result = self::curlPost($url,$this->json_encode_ex($data));
        $resultArr = json_decode($result,true);
        $data['code'] = 1;
        if($resultArr['errcode']==40001){
            $this->getToken(true);
            message('token过期，请重试');
        }
        if($resultArr['errcode']==88005){
            //已经回复过了，删除作者回复
            $deleteResult = $this->doDeleteReply($commentId,$msgId,$no);
            if($deleteResult['code']==1){
                $data['msg'] = $deleteResult['msg'];
                return $data;
            }
            $this->doReplyComment($commentId,$msgId,$no,$content);
        }
        if($resultArr['errcode']){
            $data['msg'] = $resultArr['errmsg'];
            return $data;
        }
        $data['code'] = 0;
        return $data;
    }

    /**
     * 删除评论
     */
    function doDeleteComment($commentId,$msgId,$no=0)
    {
		$gettoken = $this->getToken() ? $this->getToken() : $this->getToken(true);
        $url = 'https://api.weixin.qq.com/cgi-bin/comment/delete?access_token='.$gettoken;
        $data['msg_data_id'] = $msgId;
        $data['index'] = intval($no);
        $data['user_comment_id'] = intval($commentId);
        $result = self::curlPost($url,$this->json_encode_ex($data));
        $resultArr = json_decode($result,true);
        $data['code'] = 1;
        if($resultArr['errcode']==40001){
            $this->getToken(true);
            message('token过期，请重试');
        }
        if($resultArr['errcode']){
            message('出错：errcode:'.$resultArr['errmsg']);
        }
        $data['code'] = 0;
        return $data;
    }

    /**
     * 关闭评论
     */
    function docloseComment($msgId,$no=0)
    {
		$gettoken = $this->getToken() ? $this->getToken() : $this->getToken(true);
        $url = 'https://api.weixin.qq.com/cgi-bin/comment/close?access_token='.$gettoken;
        $data['msg_data_id'] = $msgId;
        $data['index'] = intval($no);
        $result = self::curlPost($url,$this->json_encode_ex($data));
        $resultArr = json_decode($result,true);
        $data['code'] = 1;
        if($resultArr['errcode']==40001){
            $this->getToken(true);
            message('token过期，请重试');
        }
        if($resultArr['errcode']){
           message('出错：errcode:'.$resultArr['errmsg']);
        }
        $data['code'] = 0;
        return $data;
    }

    /**
     * 开启评论
     */
    function doOpenComment($msgId,$no=0)
    {
		$gettoken = $this->getToken() ? $this->getToken() : $this->getToken(true);
        $url = 'https://api.weixin.qq.com/cgi-bin/comment/open?access_token='.$gettoken;
        $data['msg_data_id'] = $msgId;
        $data['index'] = intval($no);
        $result = self::curlPost($url,$this->json_encode_ex($data));
        $resultArr = json_decode($result,true);
        $data['code'] = 1;
        if($resultArr['errcode']==40001){
            $this->getToken(true);
			message('token过期，请重试');
        }
        if($resultArr['errcode']){
            message('出错：errcode:'.$resultArr['errmsg']);
        }
        $data['code'] = 0;
        return $data;
    }

    /**
     * 删除作者回复
     */
    function doDeleteReply($commentId,$msgId,$no=0)
    {
		$gettoken = $this->getToken() ? $this->getToken() : $this->getToken(true);
        $url = 'https://api.weixin.qq.com/cgi-bin/comment/reply/delete?access_token='.$gettoken;
        $data['msg_data_id'] = $msgId;
        $data['index'] = intval($no);
        $data['user_comment_id'] = intval($commentId);
        $result = self::curlPost($url,$this->json_encode_ex($data));
        $resultArr = json_decode($result,true);
        $data['code'] = 1;
        if($resultArr['errcode']==40001){
            $this->getToken(true);
            message('token过期，请重试');
        }
        if($resultArr['errcode']){
            message('出错：errcode:'.$resultArr['errmsg']);
        }
        $data['code'] = 0;
        return $data;
    }
    /**
     * 群发
     * @param $media_id  用于群发的消息的media_id
     * @param string $msgtype  群发的消息类型，图文消息为mpnews，文本消息为text，语音为voice，音乐为music，图片为image，视频为video，卡券为wxcard
     * @param bool $is_to_all  用于设定是否向全部用户发送，值为true或false
     * @param int $tag_id  群发到的标签的tag_id，参见用户管理中用户分组接口，若is_to_all值为true，可不填写tag_id
     */
    function sendall($media_id,$is_to_all=false,$tag_id=2)
    {
		$gettoken = $this->getToken() ? $this->getToken() : $this->getToken(true);
        $url = 'https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token='.$gettoken;
        $data['filter']['is_to_all'] = !$is_to_all ? false : true;
        $data['filter']['tag_id'] = intval($tag_id);
        $data['mpnews']['media_id'] = $media_id;
        $data['msgtype'] = 'mpnews';
        $data['send_ignore_reprint'] = 1;
        $result = self::curlPost($url,json_encode($data));
        $resultArr = json_decode($result,true);
        if($resultArr['errcode']==40001){
            $this->getToken(true);
            return $this->sendall($media_id,$is_to_all,$tag_id);
        }
        if($resultArr['errcode']==0){
            return $resultArr;
        }
        $oData['code'] = 1;
        $oData['msg'] = '群发出错：errcode:'.$resultArr['errcode'].'  '.$resultArr['errmsg'];
        echo $this->json_encode_ex($oData);
        exit();
    }

    /**
     * 预览接口
     * @param $media_id
     * @param $openid
     * @return mixed
     */
    function preview($media_id,$openid)
    {
		$gettoken = $this->getToken() ? $this->getToken() : $this->getToken(true);
        $url = 'https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token='.$gettoken;
        $data['touser'] = $openid;
        $data['mpnews']['media_id'] = $media_id;
        $data['msgtype'] = 'mpnews';
        $result = self::curlPost($url,$this->json_encode_ex($data));
        $resultArr = json_decode($result,true);
        if($resultArr['errcode']==40001){
            $this->getToken(true);
            return $this->preview($media_id,$openid);
        }
        if($resultArr['errcode']==0){
            return $resultArr;
        }
        message('预览出错：errcode:'.$resultArr['errcode'].'  '.$resultArr['errmsg']);
    }

    /**
     * 根据openid群发
     * @param $media_id  用于群发的消息的media_id
     * @param $openids array openid数组
     * @return mixed
     */
    function send($media_id,$openids)
    {
		$gettoken = $this->getToken() ? $this->getToken() : $this->getToken(true);
        $url = 'https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token='.$gettoken;
        $data['touser'] = $openids;
        $data['mpnews']['media_id'] = $media_id;
        $data['msgtype'] = 'mpnews';
        $data['send_ignore_reprint'] = 1;
        $result = self::curlPost($url,$this->json_encode_ex($data));
        $resultArr = json_decode($result,true);
        if($resultArr['errcode']==40001){
            $this->getToken(true);
            return $this->send($media_id,$openids);
        }
        if($resultArr['errcode']==0){
            return $resultArr;
        }
        $oData['code'] = 1;
        $oData['msg'] = '群发出错：errcode:'.$resultArr['errcode'].'  '.$resultArr['errmsg'];
        echo $this->json_encode_ex($oData);
        exit();
    }

    function getToken($force=false) {
		global $_P8SESSION;
		if($force===false && $this->token) return $this->token;
		$access_token = $_P8SESSION['token'];
		if($access_token && $access_token !== true) return $access_token;	
		if($force===false && $access_token !== true) return $access_token;
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->appsecret;
        $res = self::curlGet($url);
        $result = json_decode($res, true);
        if($result['errmsg']){
            $data['code'] = 1;
            $data['msg'] = 'errcode: '.$result['errcode'].', errmsg: '.$result['errmsg'];
            echo $this->json_encode_ex($data);
            if($result['errcode']==40164){
                echo '<h1>请将服务器IP配置到白名单（微信公众平台->开发->基本配置->IP白名单）</h1>';
            }
            exit();
        }
        //access_token有效期是7200s
		$_P8SESSION['token'] = set_cookie('token',$result['access_token'], 7000);        
        return $result['access_token'];
    }

    /**
     * 通过跳转获取用户的openid，跳转流程如下：
     * 1、设置自己需要调回的url及其其他参数，跳转到微信服务器https://open.weixin.qq.com/connect/oauth2/authorize
     * 2、微信服务处理完成之后会跳转回用户redirect_uri地址，此时会带上一些参数，如：code
     * @return 用户的openid
     */
    public function GetOpenid()
    {
        //通过code获得openid
        if (!isset($_GET['code'])){
            //触发微信返回code码
            $scheme = $_SERVER['HTTPS']=='on' ? 'https://' : 'http://';
            $baseUrl = urlencode($scheme.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].$_SERVER['QUERY_STRING']);
            $url = $this->__CreateOauthUrlForCode($baseUrl);
            Header("Location: $url");
            exit();
        } else {
            //获取code码，以获取openid
            $code = $_GET['code'];
            $openid = $this->getOpenidFromMp($code);
            return $openid;
        }
    }
    /**
     * 通过code从工作平台获取openid机器access_token
     * @param string $code 微信跳转回来带上的code
     * @return openid
     */
    public function GetOpenidFromMp($code)
    {
        $url = $this->__CreateOauthUrlForOpenid($code);
        $res = self::curlGet($url);
        //取出openid
        $data = json_decode($res,true);
        $this->data = $data;
        $openid = $data['openid'];
        return $openid;
    }
    /**
     * 构造获取open和access_toke的url地址
     * @param string $code，微信跳转带回的code
     * @return 请求的url
     */
    private function __CreateOauthUrlForOpenid($code)
    {
        $urlObj["appid"] = $this->appid;
        $urlObj["secret"] = $this->appsecret;
        $urlObj["code"] = $code;
        $urlObj["grant_type"] = "authorization_code";
        $bizString = $this->ToUrlParams($urlObj);
        return "https://api.weixin.qq.com/sns/oauth2/access_token?".$bizString;
    }
    /**
     * 构造获取code的url连接
     * @param string $redirectUrl 微信服务器回跳的url，需要url编码
     * @return 返回构造好的url
     */
    private function __CreateOauthUrlForCode($redirectUrl)
    {
        $urlObj["appid"] = $this->appid;
        $urlObj["redirect_uri"] = "$redirectUrl";
        $urlObj["response_type"] = "code";
        $urlObj["scope"] = "snsapi_base";
        $urlObj["state"] = "STATE"."#wechat_redirect";
        $bizString = $this->ToUrlParams($urlObj);
        return "https://open.weixin.qq.com/connect/oauth2/authorize?".$bizString;
    }
    /**
     * 拼接签名字符串
     * @param array $urlObj
     * @return 返回已经拼接好的字符串
     */
    private function ToUrlParams($urlObj)
    {
        $buff = "";
        foreach ($urlObj as $k => $v)
        {
            if($k != "sign") $buff .= $k . "=" . $v . "&";
        }
        $buff = trim($buff, "&");
        return $buff;
    }

    public static function curlGet($url = '', $options = array())
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        if (!empty($options)) {
            curl_setopt_array($ch, $options);
        }
        //https请求 不验证证书和host
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    public static function curlPost($url = '', $postData = '', $options = array())
    {
        if (is_array($postData)) {
            //$postData = http_build_query($postData);
        }
        $ch = curl_init();
        if(version_compare(phpversion(),'5.5.0') >= 0 && class_exists('\CURLFile')){
            curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
        } else {
            if (defined('CURLOPT_SAFE_UPLOAD')) {
                curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
            }
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); //设置cURL允许执行的最长秒数
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        if (!empty($options)) {
            curl_setopt_array($ch, $options);
        }
        //https请求 不验证证书和host
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $data = curl_exec($ch);
        if($data === false)
        {
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')){
                $data['code'] = 1;
                $data['msg'] = 'Curl error: ' . curl_error($ch);
                echo $this->json_encode_ex($data);exit();
            }else{
                echo 'Curl error: ' . curl_error($ch);exit();
            }
        }
        curl_close($ch);
        return $data;
    }

    /**
     *  下载特定资源，并保存为指定文件
     *
     * @access    public
     * @param     string  $dourl  操作地址
     * @param     string  $mtype  附件类型
     * @param     string  $islitpic  是否缩略图
     * @return    string
     */
    function DownMedia($dourl, $mtype='img', $islitpic=FALSE)
    {
        $parseArr = parse_url($dourl);
        if(substr($dourl,0,4)!='http'){
            $port = $parseArr['port']!=80 ? $parseArr['port'] : '';
            $dourl = $parseArr['scheme'].'://'.$parseArr['host'].$port.$parseArr['path'];
        }
        $remoteHost = $parseArr['host'];
        $localhost = $_SERVER['HTTP_HOST'];
        $ip = P8_IP;
        if(strstr($localhost,$remoteHost)===false){
            $filename = $this->GetRndName($dourl,$mtype);
        }else{
            $filename = $parseArr['path'];
        }
        if(!preg_match("#^\/#", $filename))
        {
            $filename = "/".$filename;
        }
        $filename = $this->download2local($dourl,$filename,$mtype);
        return $filename;
    }

    function download2local($dourl,$filename,$mtype)
    {
        $this->OpenUrl($dourl);
        $this->cHttpDown->SaveToBin(PHP168_PATH.$filename);
        $this->cHttpDown->Close();
        
        return substr(PHP168_PATH,0,-1).$filename;
    }
	
	    /**
     *  打开指定网址
     *
     * @access    public
     * @param     string    $url   地址
     * @param     string    $requestType   请求类型
     * @return    string
     */
    function OpenUrl($url,$requestType="GET")
    {
        $dhd = new HttpDown();
		$dhd->ResetAny();
        $dhd->JumpCount = 0;
        $dhd->m_httphead = Array() ;
        $dhd->m_html = '';
        $dhd->reTry = 0;
        $dhd->Close();

        //初始化系统
        $dhd->PrivateInit($url);
        $dhd->PrivateStartSession($requestType);
    }

    /**
     *  获得下载媒体的随机名称
     *
     * @access    public
     * @param     string  $url  地址
     * @param     string  $v  值
     * @return    string
     */
    function GetRndName($url, $v)
    {
        global $cfg_image_dir,$cfg_dir_purview;
        $this->mediaCount++;
        $mnum = $this->mediaCount;
        $timedir = "c".MyDate("ymd",time());
        //存放路径
        $fullurl = preg_replace("#\/{1,}#", "/", $cfg_image_dir."/");
        if(!is_dir(PHP168_PATH."/$fullurl"))
        {
            MkdirAll(PHP168_PATH."/$fullurl", $cfg_dir_purview);
        }

        $fullurl = $fullurl.$timedir."/";
        if(!is_dir(PHP168_PATH."/$fullurl"))
        {
            MkdirAll(PHP168_PATH."/$fullurl", $cfg_dir_purview);
        }

        //文件名称
        $timename = str_replace('.','', ExecTime());
        $threadnum = 0;
        if(isset($_GET['threadnum']))
        {
            $threadnum = intval($_GET['threadnum']);
        }
        $filename = dd2char($timename.$threadnum.'-'.$mnum.mt_rand(1000,9999));

        //分配扩展名
        $urls = explode('.',$url);
        if($v=='img')
        {
            $shortname = '.jpg';
            if(preg_match("#\.gif$#i", $url))
            {
                $shortname = '.gif';
            }
            else if(preg_match("#\.png$#i", $url))
            {
                $shortname = '.png';
            }
        }
        else if($v=='embed')
        {
            $shortname = '.swf';
        }
        else
        {
            $shortname = '';
        }
        $fullname = $fullurl.$filename.$shortname;
        return preg_replace("#\/{1,}#", "/", $fullname);
    }
	
	function json_encode_ex($value,$charset='')
	{
		ob_clean();
		if (version_compare(PHP_VERSION,'5.4.0','<')){
			$str = json_encode($value);
			$str = preg_replace_callback("#\\\u([0-9a-f]{4})#i", 'myCallback', $str);//php低版本不支持匿名函数
		}else{
			$str = json_encode($value, JSON_UNESCAPED_UNICODE);//只有php>=5.4才有
		}
		$str = str_replace("\\\\\\", "\\", $str);
		$str = str_replace("\/", "/", $str);
		return $str;
	}
}