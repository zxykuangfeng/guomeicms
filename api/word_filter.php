<?php
defined('PHP168_PATH') or die();
$ret = array(
	'valid '=> true,
	'message' => "验证通过",
);
if(REQUEST_METHOD == 'POST'){
	$message = '';
	if($_POST['title']){
		$matches = $this_controller->valid_filter_word($_POST['title']);
		if($matches){
			foreach($matches as $v) $ms .= $v.',';
			$message = $P8LANG['title_word_filter'].':'.substr($ms,0,-1);		
			$ret = array(
				'valid'=> false,
				'message' => $message,
			);
		}
	}
	if($_POST['summary']){
		$matches = $this_controller->valid_filter_word($_POST['summary']);
		if($matches){
			foreach($matches as $v) $ms .= $v.',';
			$message = $P8LANG['summary_word_filter'].':'.substr($ms,0,-1);		
			$ret = array(
				'valid'=> false,
				'message' => $message,
			);
		}
	}
	if($_POST['content']){
		$matches = $this_controller->valid_filter_word($_POST['title']);
		if($matches){
			foreach($matches as $v) $ms .= $v.',';
			$message = $P8LANG['content_word_filter'].':'.substr($ms,0,-1);		
			$ret = array(
				'valid'=> false,
				'message' => $message,
			);
		}
	}
}
echo p8_json($ret);


