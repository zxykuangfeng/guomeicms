<?php
defined('PHP168_PATH') or die();

class P8_CMS_Wechat extends P8_Module{

var $model;				//当前模型
var $table;				//数据表
var $main_table;		//主表
var $addon_table;
var $tag_table;
var $tag_item_table;
var $order_table;
var $delimiter;			//自定义字段行分割符,有数据后不要随意修改,ascii bel
var $col_delimiter;		//自定义字段列分割符,有数据后不要随意修改,ascii ack
var $_categories;
var $attributes;		//属性
var $_html;
var $keywords;
var $menus;
var $users;
var $pushlogs;
var $messages;

function __construct(&$system, $name){
	$this->system = &$system;
	parent::__construct($name);
	
	$this->main_table = $this->system->TABLE_ .'item';
	$this->addon_table = $this->system->TABLE_ .'item_article_addon';
	$this->keywords = $this->TABLE_ .'keywords';
	$this->menus = $this->TABLE_ .'menus';
	$this->users = $this->TABLE_ .'users';
	$this->pushlogs = $this->TABLE_ .'pushlogs';
	$this->messages = $this->TABLE_ .'messages';	
	$this->model = $this->TABLE_ .'model';
	$this->delimiter = chr(7);
	$this->col_delimiter = chr(6);
	$this->_html = array();
	$this->attributes = array(
		1 => 'cms_item_attribute_1',
		2 => 'cms_item_attribute_2',
		3 => 'cms_item_attribute_3',
		4 => 'cms_item_attribute_4',
		5 => 'cms_item_attribute_5',
		6 => 'cms_item_attribute_6',
		7 => 'cms_item_attribute_7',
		8 => 'cms_item_attribute_8',
		9 => 'cms_item_attribute_9',		
		10 => 'cms_item_attribute_10',
		11 => 'cms_item_attribute_11',
		12 => 'cms_item_attribute_12',
		13 => 'cms_item_attribute_13',
		//more attributes
	);
	$this->_categories = array();
}

function P8_CMS_Wechat(&$system, $name){
	$this->__construct($system, $name);
}

/**
* 设置当前模型
* @param string $name 模型名称
**/
function set_model($name){
	$this->model = $name;
	
	$this->table = $this->TABLE_ . $name .'_';
	$this->addon_table = $this->TABLE_ . $name .'_addon';
}

function fetch_category($id){
	if(isset($this->_categories[$id])){
		return $this->_categories[$id];
	}else{
		$this->_categories[$id] = $this->core->CACHE->read($this->system->name .'/modules', 'category', (int)$id);
		if(empty($this->_category[$id])){
			$this->cache(false,true,array($id => $id));
			$this->_category[$id] = $this->core->CACHE->read($this->system->name .'/modules', 'category', (int)$id);	
		}
		return $this->_categories[$id];
	}
}


function checkPhpEnv()
{
	$msg = array();
	if (!function_exists('curl_init')) $msg[] = '没有开启curl';
	if (!ini_get('allow_url_fopen')) $msg[] = '没有开启allow_url_fopen，请在php.ini中将allow_url_fopen设置为ON';
	if(version_compare(PHP_VERSION,'5.3.0','<')) $msg[] = 'PHP版本为'.PHP_VERSION.'，建议切换至5.3或以上版本';
	return $msg;
}

function filterBody($str)
{
	$str=preg_replace("/<a [^>]*>|<\/a>/i","$1",$str);
	return preg_replace('/(<img.*?)data-original=\".*?\"/i', '$1$3', $str);
}

function getTopMenus()
{
	global $core;
	$query = $this->DB_master->query("SELECT * FROM `$this->menus` where pid = 0 order by list_order asc,id asc");
	$menus = array();
	while($data = $this->DB_master->fetch_array($query))
	{
		$menus[] = $data;
	}
	return $menus;
}

function geChildMenusByPid($pid)
{
	global $core;
	$pid = intval($pid);
	$query = $this->DB_master->query("SELECT * FROM `$this->menus` where pid = {$pid} order by list_order asc,id asc");
	$menus = array();
	while($data = $this->DB_master->fetch_array($query))
	{
		$menus[] = $data;
	}
	return $menus;
}

function get_curl_contents($url, $method ='GET', $data = array()) {
	if ($method == 'POST') {
		//使用crul模拟
		$ch = curl_init();
		//禁用https
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		//允许请求以文件流的形式返回
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_URL, $url);
		$result = curl_exec($ch); //执行发送
		curl_close($ch);
	}else {
		if (ini_get('allow_fopen_url') == '1') {
			$result = file_get_contents($url);
		}else {
			//使用crul模拟
			$ch = curl_init();
			//允许请求以文件流的形式返回
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			//禁用https
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_URL, $url);
			$result = curl_exec($ch); //执行发送
			curl_close($ch);
		}
	}
	return $result;
}


//获取微信公从号access_token

function wx_get_token($appid,$appsecret) {
	global $_P8SESSION;
	$access_token = $_P8SESSION['token'];
	if($access_token && $access_token !== true) return $access_token;
	$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
	$res = $this->get_curl_contents($url);
	$res = json_decode($res, true);
	if($res['errmsg']){
		@trigger_error($res['errmsg']);
		echo json_encode($res);exit();
	}
	$_P8SESSION['token'] = set_cookie('token',$res['access_token'], 7000);
	return $res['access_token'];
}

function myCallback($matchs){
    return iconv('UCS-2BE', 'utf-8', pack('H4', $matchs[1]));
}
function myCallbackGBK($matchs){
    return iconv('UCS-2BE', 'gbk', pack('H4', $matchs[1]));
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


function getHttpProtocol() {
	$protocol = 'http';
	if ( !empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
		$protocol='https';
	} elseif ( isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
		$protocol='https';
	} elseif ( !empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
		$protocol='https';
	}
	return $protocol;
}

function getWxUserInfo($openid,$appid,$appsecret)
{
	$url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$this->wx_get_token($appid,$appsecret).'&openid='.$openid.'&lang=zh_CN';
	$result = $this->get_curl_contents($url);
	$result = json_decode($result,true);
	return $result;
}


function setWxUserInfo($openid,$appid,$appsecret)
{
	$userinfo = $this->getWxUserInfo($openid,$appid,$appsecret);
	if(empty($userinfo['openid']) || empty($userinfo['nickname'])) return false;

	$sql = "SELECT count(*) c FROM $this->users WHERE openid='{$openid}'";
	$count = $this->DB_master->fetch_one($sql);
	if($count['c']==0){
		$inquery = "INSERT INTO $this->users(openid,subscribe,nickname,sex,city,province,country,headimgurl,subscribe_time,unionid,subscribe_scene,created_at)
			  VALUES ('{$userinfo['openid']}','{$userinfo['subscribe']}','{$userinfo['nickname']}','{$userinfo['sex']}','{$userinfo['city']}','{$userinfo['province']}','{$userinfo['country']}','{$userinfo['headimgurl']}','".date('Y-m-d H:i:s',$userinfo['subscribe_time'])."','{$userinfo['unionid']}','{$userinfo['subscribe_scene']}','".date('Y-m-d H:i:s')."'); ";
	}else{
		$inquery = "UPDATE $this->users SET nickname = '{$userinfo['nickname']}',headimgurl = '{$userinfo['headimgurl']}',updated_at='".date('Y-m-d H:i:s')."' where openid = '{$userinfo['openid']}'";
	}
	$this->DB_master->query($inquery);
	return true;
}

function addMessage($user, $type, $content, $reply = '',$id = 0)
{
	global $core;
	if(empty($user) || empty($content)) return;
	if($id)
		$rsult = $this->DB_master->query("UPDATE `$this->messages` SET `reply` = '{$reply}',`updated_at` = '".date('Y-m-d H:i:s')."' WHERE `id` = {$id}");
	else
		$rsult = $this->DB_master->query("INSERT INTO $this->messages(`user`,`type`,`content`,`reply`,`created_at`) VALUES('{$user}', '{$type}', '{$content}', '{$reply}','" . date('Y-m-d H:i:s') . "')");
	return $rsult;
}

function getReplyBody($msg,$type,$content,$title='',$description='',$picurl='',$url='')
{
	$toUser   = $msg->FromUserName;
	$fromUser = $msg->ToUserName;
	$respondMsg =  '<xml><ToUserName><![CDATA['.$toUser.']]></ToUserName><FromUserName><![CDATA['.$fromUser.']]></FromUserName><CreateTime>'.time().'</CreateTime>';
	switch ($type){
		case 'text':
			$respondMsg.='<MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$content.']]></Content>';
			break;
		case 'image':
			$respondMsg.='<MsgType><![CDATA[image]]></MsgType><Image><MediaId><![CDATA['.$content.']]></MediaId></Image>';
			break;
		case 'voice':
			$respondMsg.='<MsgType><![CDATA[voice]]></MsgType><Voice><MediaId><![CDATA['.$content.']]></MediaId></Voice>';
			break;
		case 'video':
			$respondMsg.='<MsgType><![CDATA[video]]></MsgType><Video><MediaId><![CDATA['.$content.']]></MediaId></Video><Title><![CDATA['.$title.']]></Title><Description><![CDATA['.$description.']]></Description>';
			break;
		case 'music':
			$respondMsg.='<MsgType><![CDATA[music]]></MsgType><Music><Title><![CDATA['.$title.']]></Title><Description><![CDATA['.$description.']]></Description><MusicUrl><![CDATA['.$url.']]></MusicUrl><HQMusicUrl><![CDATA['.$url.']]></HQMusicUrl><ThumbMediaId><![CDATA['.$content.']]></ThumbMediaId></Music>';
			break;
		case 'news':
			$respondMsg.='<MsgType><![CDATA[news]]></MsgType><ArticleCount>1</ArticleCount><Articles><item><Title><![CDATA['.$title.']]></Title><Description><![CDATA['.$description.']]></Description><PicUrl><![CDATA['.$picurl.']]></PicUrl><Url><![CDATA['.$url.']]></Url></item></Articles>';
			break;
	}
	$respondMsg.='</xml>';
	return $respondMsg;
}

function getUserInfoStr($openid)
{
	global $core;
	$sql = "SELECT * FROM $this->users WHERE openid='{$openid}'";
	$row = $this->DB_master->fetch_one($sql);
	if(empty($row)) return $openid;
	$genderIcon = $row['sex']==1 ? '<i class="fa fa-mars text-primary"></i>' : '<i class="fa fa-venus text-danger"></i>';
	return '<a href="javascript:;" onclick="return _show_user(\''.$openid.'\')"><img src="'.$row['headimgurl'].'" width="30px" /> '.$row['nickname'].' '.$genderIcon.'</a>';
}


function getSubscribeScene($key)
{
	$array = array(
		'ADD_SCENE_SEARCH'=>'公众号搜索',
		'ADD_SCENE_ACCOUNT_MIGRATION'=>'公众号迁移',
		'ADD_SCENE_PROFILE_CARD'=>'名片分享',
		'ADD_SCENE_QR_CODE'=>'扫描二维码',
		'ADD_SCENEPROFILE'=>'图文页内名称点击',
		'ADD_SCENE_PROFILE_ITEM'=>'图文页右上角菜单',
		'ADD_SCENE_PAID'=>'支付后关注',
		'ADD_SCENE_OTHERS'=>'其他',
	);
	return $array[$key];
}

function getWxService($appid,$appsecret)
{
    include_once PHP168_PATH .'inc/WxService.class.php';
	return new WxService($appid,$appsecret);
}

}
