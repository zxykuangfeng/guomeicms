<?php
/**
* 上传附件API。
* 存储路径：\attachment\core\
**/

require_once dirname(__FILE__) .'/../inc/init.php';
$username = isset($_REQUEST['u']) ? p8_stripslashes2($_REQUEST['u']) : '';
$password = isset($_REQUEST['p']) ? p8_stripslashes2($_REQUEST['p']) : '';
$request = p8_stripslashes2($_POST + $_GET);
if(REQUEST_METHOD == 'POST'){
	if(!empty($username) && !empty($password)){
		$member = &$core->load_module('member');
		//强制用系统的账号体系登录。
		$ret = $member->login($username, $password,0,false,'username','api');	
		if($ret['status'] == 0){
			$member_info = get_member($username, false, 'username');
			$UID = intval($ret['id']);
			$IS_ADMIN = intval($member_info['is_admin']);
			$IS_FOUNDER = intval($member_info['is_founder']);
			define('ADMIN_FORCE',true);
			define('P8_CLUSTER',true);
			define('P8_API',true);
			$_P8SESSION['#admin_login#'] = 1;
			if($request['upload_files']){
				$this_module = $core->load_module('uploader');	
				$this_controller = $core->controller($this_module);
				/*缩略图大小*/
				$thumb_width = isset($request['thumb_width']) ? intval($request['thumb_width']) : 0;
				$thumb_height = isset($request['thumb_height']) ? intval($request['thumb_height']) : 0;
				/*内容页缩略图大小*/
				$cthumb_width = isset($request['content_thumb_width']) ? intval($request['content_thumb_width']) : 0;
				$cthumb_height = isset($request['content_thumb_height']) ? intval($request['content_thumb_height']) : 0;
				$json = $this_controller->capture(array(
					'files' => array($request['upload_files']),
					'thumb_width' => $thumb_width,
					'thumb_height' => $thumb_height,
					'cthumb_width' => 0,
					'cthumb_height' => 0,
				));
				if($json){
					foreach($json as $key=>$list){
						$json[$key]['status'] = 200;
					}
					exit(jsonencode($json));
				}else{
					$json['status'] = -2;
					$data['message'] = '上传失败，检查账号上传权限或源文件！';
					exit(jsonencode($data));
				}				
			}else{
				$json['status'] = -3;
				$data['message'] = '没有选择上传文件，有可能是服务器PHP设置限制了文件上传大小。而你选择了的文件超出了限制。';
				exit(jsonencode($data));
			}
		}else{
			$json['status'] = -5;
			$json['message'] = '登录失败，账号或密码不正确';
			exit(json_encode($json,JSON_UNESCAPED_UNICODE));			
		}
	
	}else{
		$json['status'] = -6;
		$json['message'] = '账号或密码为空';
		exit(json_encode($json,JSON_UNESCAPED_UNICODE));		
	}
}else{
	$json['status'] = -4;
	$json['message'] = '只接受POST请求，不支持GET请求';
	exit(json_encode($json,JSON_UNESCAPED_UNICODE));
}