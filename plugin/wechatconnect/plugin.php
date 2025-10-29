<?php
/**
 *
 * Power by 910app.com
 * User: bingbin
 * Date: 2023/10/23
 * Time: 10:52
 */

defined('PHP168_PATH') or die();

class P8_Plugin_Wechatconnect extends P8_Plugin
{

    public $config;
    public $appid;
    public $secret;
    private $appkey;
	public $tourl = '';

    function __construct(&$core, $name)
    {
        $this->core = &$core;
        parent::__construct($name);
        $this->table = $this->TABLE_;
        $this->init();
    }

    function init(){
        $config=$this->get_config();
        $this->config = $config;
        $this->appid = $config['appid'];
        $this->secret = $config['appsecret'];
		if($config['tourl']){
			$this->tourl = $config['tourl'];
		}else{
			$this->tourl = $this->core->url?:'/';
		}
    }

    function _cache(){

    }

    function _display(){
		if($this->config['wechat_type'] && $this->config['wechat_type']==2){
			$data = $this->getMpQrCode();
		}else{
			$data = $this->getOpenQrcode();
		}
        echo $data;
    }


    /**
     * 公众平台 取二维码
     * @return null
     */
    protected function getMpQrCode(){
        $sceneId = rand(1,100000);
        $ticket = $this->getMpTicket($sceneId);
        $src = sprintf("https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=%s",$ticket);
        return $src;
    }



    /**
     * 公众平台  取ticket
     * @return null
     * //目前参数只支持1--100000
     */
    protected function getMpTicket(int $sceneId){
        $url = sprintf("https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=%s",$this->getMPAccessToken());
        $ret = p8_http_request(['url'=>$url,'post'=>['expire_seconds'=>604800,'action_name'=>'QR_SCENE','action_info'=>['scene'=>['scene_id'=>$sceneId]]]]);
        $data = json_decode($ret['body'],true);
        return $data['ticket'];

    }

    /**
     * 公众平台 取 access_coken
     * @return null
     */
    protected function getMPAccessToken(){
        $url = sprintf("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s",$this->appid,$this->secret);
        $ret = p8_http_request(['url'=>$url]);
        $accessToken = json_decode($ret['body'],true);
        return $accessToken['access_token'];
    }

    /**
     * 公众平台 - 取用户信息
     * @param $token
     * @param $openid
     * @return mixed
     */
    protected function getMpUserInfo($token,$openid){


        $url = sprintf("https://api.weixin.qq.com/cgi-bin/user/info?access_token=%s&openid=%s&lang=zh_CN",$token,$openid);
        $ret = p8_http_request(['url'=>$url]);
        $data = json_decode($ret['body'],true);
        return $data;
    }


    /**
     * 开放平台 展示二维码
     * @return string
     */
    protected function getOpenQrcode(){
        $redirectRri = urlencode($this->controller.'-login');
        $time=time();
        $state =  p8_code('p8_wechat_get_code_'.$time).$time;
        $scheme = 'http';
        if($_SERVER['REQUEST_SCHEME']=='https'){
            $scheme = 'https';
        }
        if(empty($this->core->config['url'])){
            $redirectRri = $scheme.'://'.$_SERVER['HTTP_HOST'].$redirectRri;
        }
        $str = <<<EOT
        <div id="login_container"></div>
<script type="text/javascript" src="{$scheme}://res.wx.qq.com/connect/zh_CN/htmledition/js/wxLogin.js"></script>    
<script type="text/javascript"> var obj = new WxLogin({ self_redirect:true, id:"login_container",  appid: "{$this->appid}", scope: "snsapi_login",  redirect_uri: "{$redirectRri}", state: "{$state}", style: "black", href: "" });</script>    
EOT;

        return $str;

    }

    public function checkState($state){
        return p8_code(substr($state,0,-10),false)=='p8_wechat_get_code_'.substr($state,-10);
    }

    /**
     * 开放平台 取Access_token
     * @param $code
     * @return null
     */
    function getOpenAccessToken($code){

        $url = sprintf("https://api.weixin.qq.com/sns/oauth2/access_token?appid=%s&secret=%s&code=%s&grant_type=authorization_code",$this->appid, $this->secret,$code);
        $ret = p8_http_request(['url'=>$url]);
        $data = json_decode($ret['body'],true);
        return $data;


    }

    /**
     * 开放平台 取用户信息
     * @param $token
     * @param $openid
     * @return mixed
     */
    function getOpenUserInfo($token,$openid){

        $url = sprintf("https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s",$token,$openid);
        $ret = p8_http_request(['url'=>$url]);
        $data = json_decode($ret['body'],true);
        return $data;
    }


    function login($data,$update=true){
        $member = $this->core->load_module('member');
        if($update){
            $this->updateUserInfo($data,$data['uid']);

        }
        if(empty($data['uid']))
            $data['uid'] = $data['id'];
        return $member->login($data['username'], '', $data['uid']);
    }



    function getUserInfo($openid=0){

        if(!$openid)
            return false;
        $SQL = "SELECT * FROM {$this->table} WHERE openid='{$openid}'";

        $query = $this->DB_slave->fetch_one($SQL);
        if($query){
            return $query;
        }else{
            return false;
        }
    }

    function updateUserInfo($data,$openid){
        if(!$data)return;
        $indata = array(
            'nickname' => html_entities(from_utf8($data['nickname'])),
            'sex' => html_entities(from_utf8($data['sex'])),
            'province' => html_entities($data['province']),
            'city' => html_entities($data['city']),
            'country' => html_entities($data['country']),
            'headimgurl' => html_entities($data['headimgurl']),
            'unionid' => html_entities($data['unionid'])
        );
        $this->DB_master->update($this->table, $indata, "openid = '{$openid}'");
    }

    /**
     * 记录信息
     * @param $data
     * @param $openid
     * @return false|void
     */
    function addUserInfo($data,$openid){

        if(!$this->getUserInfo($openid)) {



            $indata = array(
                'nickname' => html_entities(from_utf8($data['nickname'])),
                'sex' => html_entities(from_utf8($data['sex'])),
                'province' => html_entities($data['province']),
                'city' => html_entities($data['city']),
                'country' => html_entities($data['country']),
                'headimgurl' => html_entities($data['headimgurl']),
                'openid' => html_entities($data['openid']),
                'unionid' => html_entities($data['unionid']),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
            return $this->DB_master->insert($this->table, $indata, array('return_id' => true));
        }
    }

    function registerUser($indata){
        $gid = $this->config['role_gid'];
        $this->core->get_cache('role_group');
        $post = [
            'username'=>$indata['openid'],
            'name'=>$indata['nickname'],
            'password'=>rand_str(32),
            'role_id'=> $this->core->role_groups[$gid]['default_role'],
        ];

        $member = $this->core->load_module('member');
        $member_controller= $this->core->controller($member);
        if($userInfo = get_member($indata['openid'])){
            $uid = $userInfo['id'];
        }else {
            $uid = $member_controller->register($post);
        }
        if($uid>0) {
            return $this->bindUser($indata['openid'], $uid,$indata['openid']);
        }
        return false;
    }

    function bindUser($openId,$uid,$username){
        return $this->DB_master->update($this->table, ['uid'=>$uid,'username'=>$username], "openid = '{$openId}'");
    }

    function unbindbyid($id,$uid,$username){
        return $this->DB_master->update($this->table, ['uid'=>$uid,'username'=>$username], "id = '{$id}'");
    }
    function unbind($id){
        return $this->DB_master->update($this->table, ['uid'=>0,'username'=>''], "id = '{$id}'");
    }

    function getById($id){
        return $this->DB_master->fetch_one( "SELECT * FROM {$this->table} WHERE id = '{$id}'");
    }
    function getByUid($uid){
        return $this->DB_master->fetch_one( "SELECT * FROM {$this->table} WHERE uid = '{$uid}'");
    }
    function userlogin($plusUserInfo){
        $member = $this->core->load_module('member');
        return $member->login($plusUserInfo['username'], '', $plusUserInfo['uid']);
    }

    function wxlogin(){
        global  $_P8SESSION;
        $_P8SESSION['qqconnect_state'] = $state = md5(uniqid(rand(), TRUE)); //CSRF protection;
        $scope = 'get_user_info';
        $callback = $this->controller.'-login';
        $login_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id="
            . $this->appid
            . "&state=" . $state
            . "&scope=". $scope
            . "&redirect_uri=" . urlencode($callback);
        header("Location:$login_url");

    }

}