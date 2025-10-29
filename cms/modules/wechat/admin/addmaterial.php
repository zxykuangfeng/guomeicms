<?php
/**
 * 微信公众号助手
 */
$this_controller->check_admin_action($ACTION) or message('no_privilege');

require_once PHP168_PATH .'inc/WxService.class.php';
require_once PHP168_PATH .'inc/weixinPush.class.php';

$type = $_GET['type']?$_GET['type']:'image';
$config = $core->get_config($this_system->name, $this_module->name);
$wx = new WxService($config['appid'],$config['appsecret']);
error_reporting(E_ALL);
if(REQUEST_METHOD == 'POST'){
	$type = $_POST['type'];
	if(in_array($type,array('image','video','voice'))){
		if($type == 'image'){
			$domain = $core->url ? $core->url : $RESOURCE_VICE;
			$desFile = PHP168_PATH.substr($_POST['file'],strlen($domain)+1);
		}else{
			$uploadPath = PHP168_PATH.'attachment/cms/wechat';
			$pathinfo = pathinfo($_FILES["file"]["name"]);
			$filename = uniqid();
			$extension = $pathinfo['extension'];
			$desFile = $uploadPath.'/'.$filename.'.'.$extension;
			if($_FILES['file']['error']){
				switch($_FILES['file']['error']){
					case '1':
						message('上传的文件超过了服务器环境php.ini中 upload_max_filesize 选项限制的值。');
					break;
					case '2':
						message('上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。');
					break;
					case '3':
						message('文件只有部分被上传');
					break;
					case '4':
						message('没有文件被上传');
					break;
					case '6':
						message('找不到临时文件夹');
					break;
					default :
						message('文件写入失败，请检查attachment目录权限');
				}
			}
			move_uploaded_file($_FILES["file"]["tmp_name"],$desFile);
		}
		$result = $wx->addOtherMaterial($desFile,$type,$title,$introduction);
		unlink($desFile);
		if($result['media_id']){
			message('上传成功！',$this_router.'-material',2);
		}else{
			message('上传失败：'.$result['errmsg']);
		}
	}else{
		message('素材类型不符合要求!');
	}
}
include template($this_module, 'material_add', 'admin');