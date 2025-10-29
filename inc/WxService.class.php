<?php

class WxService
{
    protected $appid;
    protected $appsecret;
    protected $templateId;
    protected $token = null;
    public $data = null;
    public function __construct($appid, $appsecret)
    {
        $this->appid = $appid;
        $this->appsecret = $appsecret;
        $this->token = $this->getToken();
    }

    /**
     * 获取素材列表
     */
    public function getMaterialList($page,$type='image')
    {
        $count = 10;
        $offset = $page*$count-$count;
        $token = $this->getToken();
        if(is_array($token) && $token['code']==1){
            $data['code'] = 1;
            $data['msg'] = $token['msg'].$token['tips'];
            return json_encode($data);
        }else{
            $url = 'https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token='.$token;
            $data['code'] = 0;
            $data['type'] = $type;
            $data['offset'] = $offset;
            $data['count'] = $count;
            $result = self::curlPost($url,json_encode($data));
            $resultArr = json_decode($result,true);
            if($resultArr['errcode']==40001){
                $this->getToken(true);
                return $this->getMaterialList($page,$type);
            }
            return $result;
        }
    }

    /**
     * 新增其他类型永久素材
     */
    function addOtherMaterial($filepath,$type='image',$title='',$introduction='')
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/material/add_material?access_token='.$this->getToken().'&type='.$type;
        if(version_compare(phpversion(),'5.5.0') >= 0 && class_exists('\CURLFile')){
            $data = array('media' => new \CURLFile($filepath));
        } else {
            $data = array('media'=>'@'.$filepath);
        }
        $pathinfo = pathinfo($filepath);
        $extension = $pathinfo['extension'];
        if(strtolower($extension)=='mp4'){
            $video['title'] = $title ? $title : '视频标题';
            $video['introduction'] = $introduction;
            $data['description'] = $this->json_encode_ex($video);
        }
        $result = self::curlPost($url,$data);
        $resultArr = json_decode($result,true);
        if($resultArr['errcode']==40001){
            $this->getToken(true);
            return $this->addOtherMaterial($filepath,$type);
        }
        return $resultArr;
    }

    /**
     * 获取永久素材
     * @param $mediaId
     */
    public function getMaterial($mediaId,$type='image')
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/material/get_material?access_token='.$this->getToken();
        $data['media_id'] = $mediaId;
        $result = self::curlPost($url,json_encode($data));
        $resultArr = json_decode($result,true);
        if($type=='image' && !is_array($resultArr)){
            $imgPath = tempnam(sys_get_temp_dir(), 'php168');
            $fp = @fopen($imgPath, "w");
            @fwrite($fp, $result);
            fclose($fp);
            $imginfo= getimagesize($imgPath);
            $mime = $imginfo['mime'];
            ob_clean();
            header("Content-Type: {$mime};text/html; charset=utf-8");
            echo $result;
            exit;
        }
        if($type=='video' && $resultArr['down_url']){
            echo "<h2>{$resultArr['title']}</h2>";
            echo "<p>{$resultArr['description']}</p>";
            echo '<video controls="controls" autoplay="autoplay">
  <source src="'.$resultArr['down_url'].'" type="video/mp4" />
Your browser does not support the video tag.
</video>';
            exit();
        }
        if($type=='voice'){
            $voicePath = tempnam(sys_get_temp_dir(), 'php168');
            $fp = @fopen($voicePath, "w");
            @fwrite($fp, $result);
            fclose($fp);
            $filesize= filesize($voicePath);
            header("Content-type:audio/mpeg");
            header("Content-length:$filesize");
            readfile($voicePath);
            exit;
        }
        if($resultArr['errcode']==40001){
            $this->getToken(true);
            return $this->getMaterial($mediaId,$type);
        }
        var_dump($result);die;
    }

    /**
     * 删除永久素材
     * @param $mediaId
     */
    public function delMaterial($mediaId)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/material/del_material?access_token='.$this->getToken();
        $data['media_id'] = $mediaId;
        $result = self::curlPost($url,json_encode($data));
        return json_decode($result,true);
    }

    public function getMaterialCount()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token='.$this->getToken();
        $result = self::curlGet($url);
        var_dump($result);die;
    }

    public function createMenu($data)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->getToken();
        $menu = array();
        $i=0;
        foreach ($data as $item){
            $menu['button'][$i]['name'] = $item['name'];
            if($item['sub_button']){
                $j=0;
                foreach ($item['sub_button'] as $sub){
                    $menu['button'][$i]['sub_button'][$j]['type'] = $sub[1];
                    $menu['button'][$i]['sub_button'][$j]['name'] = $sub[0];
                    if($sub[1]=='view') $menu['button'][$i]['sub_button'][$j]['url'] = $sub[2];
                    if($sub[1]=='click') $menu['button'][$i]['sub_button'][$j]['key'] = $sub[2];
                    if($sub[1]=='media_id') $menu['button'][$i]['sub_button'][$j]['media_id'] = $sub[2];
                    $j++;
                }
            }else{
                $menu['button'][$i]['type'] = $item['type'];
                if($item['type']=='view') $menu['button'][$i]['url'] = $item['value'];
                if($item['type']=='click') $menu['button'][$i]['key'] = $item['value'];
                if($item['type']=='media_id') $menu['button'][$i]['media_id'] = $item['value'];
            }
            $i++;
        }
        $menuJson = $this->json_encode_ex($menu,'utf-8');
        $menuJson = str_replace("\\","",$menuJson);
        $result = self::curlPost($url,$menuJson);
        return json_decode($result,true);
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

    public function deleteMenu()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='.$this->getToken();
        $result = self::curlGet($url);
        return json_decode($result,true);
    }

    function getToken($force=false) {
        if($force===false && $this->token) return $this->token;
		if($force===false && $_P8SESSION['token']) return $_P8SESSION['token'];
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->appsecret;
        $res = self::curlGet($url);
        $result = json_decode($res, true);
        if($result['errmsg']){
            $data['code'] = 1;
            $data['msg'] = 'errcode: '.$result['errcode'].', errmsg: '.$result['errmsg'];
            if($result['errcode']==40164){
                $data['tips'] = '请将服务器IP配置到白名单（微信公众平台->开发->基本配置->IP白名单）';
            }
            return $data;
        }
        //access_token有效期是7200s
        $_P8SESSION['token'] = set_cookie('token',$result['access_token'], 7000);
        return $result['access_token'];
    }

    /**
     * 获取临时二维码tiket
     */
    function createQrcode()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$this->getToken();
        $data['expire_seconds'] = 60;
        $data['action_name'] = 'QR_STR_SCENE';
        $data['action_info']['scene']['scene_str'] = 'admin_login';
        $result = self::curlPost($url,json_encode($data));
        $resultArr = json_decode($result,true);
        if($resultArr['errcode']){
            if($resultArr['errcode']==40001){
                DelCache('weixin', 'token');
            }
        }
        return $resultArr['ticket'] ?$resultArr['ticket'] : false;
    }

    /**
     * 上传临时素材
     * @param $filepath   图片路径
     * @param $type   图片（image）、语音（voice）、视频（video）和缩略图（thumb）
     * @return 素材id
     */
    function uploadMedia($filepath,$type='image')
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token='.$this->getToken().'&type='.$type;
        if(version_compare(phpversion(),'5.5.0') >= 0 && class_exists('\CURLFile')){
            $data = array('media' => new \CURLFile($filepath));
        } else {
            $data = array('media'=>'@'.$filepath);
        }
        $result = self::curlPost($url,$data);
        $resultArr = json_decode($result,true);
        if($resultArr['errcode']){
            if($resultArr['errcode']==40001){
                $this->getToken(true);
                return $this->upload($type,$filepath);
            }
            $data['code'] = 1;
            $data['msg'] = $resultArr['errmsg'];
            echo self::xjson_encode($data);exit();
        }
        return $resultArr['media_id'];
    }

    /**
     * 获取临时素材
     * @param $mediaId
     */
    public function getMedia($mediaId)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token='.$this->getToken().'&media_id='.$mediaId;
        $result = self::curlGet($url);
        if(!is_array(json_decode($result,true))){
            $imgPath = tempnam(sys_get_temp_dir(), 'php168');
            $fp = @fopen($imgPath, "w");
            @fwrite($fp, $result);
            fclose($fp);
            $imginfo= getimagesize($imgPath);
            $mime = $imginfo['mime'];
            header("Content-Type: {$mime};text/html; charset=utf-8");
            echo $result;
            exit;
        }
        var_dump($result);die;
    }

    /**
     * 新增永久图文素材
     */
    function uploadNews($arcRows,$show_cover_pic=0)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token='.$this->getToken();
        $items = array();
        $i=0;
        foreach ($arcRows as $arcRow){
            $items['articles'][$i] = array(
                'thumb_media_id'=>$arcRow['litpic_id'],
                'author'=>$arcRow['writer'],
                'title'=>$arcRow['title'],
                'content_source_url'=>$arcRow['arcurl'],
                'content'=>$this->filter_content($arcRow['body']),
                'digest'=>$arcRow['description'],
                'show_cover_pic'=>$show_cover_pic
            );
            $i++;
        }
        $result = self::curlPost($url,self::xjson_encode($items));
        $resultArr = json_decode($result,true);
        if(empty($resultArr)){
            $data['code'] = 1;
            $data['msg'] = '上传图文出错：'.$result;
            echo self::xjson_encode($data);exit();
        }
        if($resultArr['errcode']==40001){
            $data['code'] = 1;
            $data['msg'] = '获取media_id出错：errcode:'.$resultArr['errcode'].'  '.$resultArr['errmsg'];
            echo self::xjson_encode($data);exit();
            $this->getToken(true);
            return $this->uploadnews($arcRows);
        }
        if(!isset($resultArr['media_id'])){
            $data['code'] = 1;
            $data['msg'] = '获取media_id出错：errcode:'.$resultArr['errcode'].'  '.$resultArr['errmsg'];
            echo self::xjson_encode($data);exit();
        }
        return $resultArr;
    }

    /**
     * 生成短连接
     */
    function createShortUrl($longUrl)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/shorturl?access_token='.$this->getToken();
        $data['action'] = 'long2short';
        $data['long_url'] = $longUrl;
        $result = self::curlPost($url,json_encode($data));
        $resultArr = json_decode($result,true);
        if($resultArr['errcode']==40001){
            return $this->createShortUrl($longUrl);
        }
        return $resultArr['short_url'] ? $resultArr['short_url'] : false;
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
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); //设置cURL允许执行的最长秒数
        if (!empty($options)) {
            curl_setopt_array($ch, $options);
        }
        //https请求 不验证证书和host
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $data = curl_exec($ch);
        if($data === false)
        {
            echo 'Curl error: ' . curl_error($ch);exit();
        }
        curl_close($ch);
        return $data;
    }

    private function replace($matchs){
        return iconv('UCS-2BE', 'UTF-8', pack('H4', $matchs[1]));
    }

    public static function xjson_encode($data)
    {
        if(version_compare(PHP_VERSION,'5.4.0','<')){
            $str = json_encode($data);
            $str = preg_replace_callback("#\\\u([0-9a-f]{4})#i", 'self::replace',$str);
            return $str;
        }
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
