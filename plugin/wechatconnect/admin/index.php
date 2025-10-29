<?php
defined('PHP168_PATH') or die();
if(REQUEST_METHOD == 'GET'){

	load_language($this_plugin, 'global');	//加载语言包
	$job = isset($_GET['job'])? $_GET['job'] : '';
	$config = $this_plugin->get_config(false);
	if(!$job){
		$config=$this_plugin->get_config();
		$config['display'] = !empty($config['display'])? $config['display']  : 6;
		$src=$this_plugin->url.'/icon';
		
		$role_module = $core->load_module('role');
		$role_module->groups || $role_module->get_group_cache();
		include $this_plugin->template('config');
		exit;
	}
	else if($job=='cache'){
		$this_plugin->_cache();
	}
    else if($job=='list'){
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $page = max(1, $page);
        $page_url = $this_url .'?plugin='.$this_plugin->name.'&page=?page?';
        $page_param= array();
        $select = select();
        $select->from($this_plugin->table, '*');
        $date_times = $dcode = $name = '';

        if(!empty($_GET['username'])){
            $name = $_GET['username'];
            $select->like('username',$name);
            $page_param['username'] = $name;
        }
        if(!empty($_GET['nickname'])){
            $name = $_GET['nickname'];
            $select->like('nickname',$name);
            $page_param['nickname'] = $name;
        }

        $count = 0;

        $list = $this_plugin->core->list_item(
            $select,
            array(
                'page' => &$page,
                'count' => &$count,
                'page_size' => 20
            )
        );

        if($page_param){
            $page_param = http_build_query($page_param);
            $page_url .=(strpos($page_url,'?')===false? '?':'&').$page_param;
        }

        $pages = list_page(array(
            'count' => $count,
            'page' => $page,
            'page_size' => 20,
            'url' => $page_url
        ));
        include $this_plugin->template('list');
        exit;
    }
	message('done',$this_url.'?plugin=wechatconnect');
}elseif(REQUEST_METHOD == 'POST'){
$do=isset($_POST['do'])? $_POST['do']:'';
load_language($this_plugin, 'global');	//加载语言包
	if($do=='config'){
		$config = isset($_POST['config']) && is_array($_POST['config']) ? $_POST['config'] : array();
		
		$config['appid'] = $config['appid'];
		$config['appsecret'] = $config['appsecret'];
		$config['wechat_type'] = $config['wechat_type']??'open';
		$this_plugin->set_config($config);
		$this_plugin->_cache();
		message('done',$this_url.'?plugin=wechatconnect',2);
	}else if($do=='unbind'){

        if($this_plugin->unbind(intval($_POST['id']))){
            exit('{"code":0,"msg":"ok"}');
        }else{
            exit('{"code":1,"msg":"fail"}');
        }
    }
    else if($do=='bind'){
        $username = p8_addslashes($_POST['username']);
        $id = intval($_POST['id']);
        $userInfo = get_member($username);
        if(!$userInfo){
            exit('{"code":1,"msg":"账号不存在"}');
        }
        $wxd = $this_plugin->getById($id);
        if(!empty($wxd['uid'])){
            exit('{"code":2,"msg":"此微信已绑定了账号['.$wxd['username'].']"}');
        }

        if($this_plugin->unbindbyid($id,$userInfo['id'],$userInfo['username'])){
            exit('{"code":0,"msg":"ok"}');
        }else{
            exit('{"code":1,"msg":"绑定失败"}');
        }
    }
}
