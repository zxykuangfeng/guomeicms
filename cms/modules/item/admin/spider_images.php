<?php
defined('PHP168_PATH') or die();

/**
* 从采集内容图片本地化
**/
@set_time_limit(0);
if(REQUEST_METHOD == 'POST'){
	if($_POST['times'] && $_POST['content']){
		$times = isset($_POST['times']) && $_POST['times'] ? intval($_POST['times']) : 0;
		$times = $times >=3 ? 3 : $times;
		$pos = $times * floor(strlen($_POST['content'])/3);
		echo $_POST['content'] ? $this_module->content_local_images($_POST['content'],$pos) : '';
		exit;
	}
}
echo '';
