<?php
defined('PHP168_PATH') or die();

//检查当前动作权限
$this_controller->check_action($ACTION) or message('no_privilege');
$this_controller->check_category_action($ACTION, intval($_POST['cid'])) or message('no_category_privilege');
if(REQUEST_METHOD == 'POST'){
	$_POST = p8_stripslashes2($_POST);
	if(isset($_POST['checkcaptcha'])){
		$st = !captcha(isset($_POST['captcha']) ? $_POST['captcha'] : '',true)?'false':'true';
		exit($st);
	}
	//载入分类模块
	$category = $this_system->load_module('category');
	$category->get_cache(true);			
	$_POST['cid'] or message('ask_error_not_choose_category', HTTP_REFERER, 3);
	$_POST['title'] or message('ask_error_not_choose_category', HTTP_REFERER, 3);
	$_POST['content'] or message(p8lang($P8LANG['ask_error_content'], 10,2000), HTTP_REFERER, 3);	
	$category->categories[$_POST['cid']] or message('ask_error_not_choose_category', HTTP_REFERER, 3);
	
	if(!empty($category->categories[$_POST['cid']]['categories'])) message('ask_error_not_choose_category', HTTP_REFERER, 3);
	if(strlen($_POST['title'])<5 || strlen($_POST['title'])>80) message(p8lang($P8LANG['ask_error_title'], 5), HTTP_REFERER, 3); 
    if($this_system->CONFIG['captcha'] && !captcha($_POST['captcha']))message('captcha_incorrect', HTTP_REFERER, 10);
	$this_controller->post($_POST) or message('ask_error', HTTP_REFERER, 3);

}else{
	message('ask_error');
}
