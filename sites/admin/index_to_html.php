<?php
defined('PHP168_PATH') or die();

/**
* 首页生成静态
**/

//$this_controller->check_admin_action($ACTION) or message('no_privilege');
$_POST = p8_stripslashes2($_POST);
if($_POST['id']){
	$form = '';
	foreach($_POST['id'] as $site){
		$site = clear_special_char($site);
		if(!in_array($site,array_keys($this_system->sites))) continue;
		$form .= '<form action="'.$this_url.'" method="post" id="'. $site .'" target="'. $site .'">'.
			'<input type="hidden" name="'.$site.'">'.
			'<input type="hidden" name="site" value="'.$site.'">'.
			'</form>'.
			'<iframe style="display: none;" name="'. $site .'"></iframe>'.
			'<script type="text/javascript">document.getElementById("'. $site .'").submit();</script>';
	}
	message($P8LANG['html_success'].$form,$this_router.'/farm-list',2);
	exit;
}else{	
	$site = clear_special_char($_POST['site']);	
	in_array($site,array_keys($this_system->sites)) or message('Hack!'); 
	$site or message('html_site_must_be_selected');
	$sdata = $this_system->get_site($site);
	/*
	if(empty($sdata['domain'])){
		if(REQUEST_METHOD == 'GET'){
			message('html_fail');
		}else{
			exit(p8_json(array('-1')));
		}
	}
	*/
	//锁定检测
	$lock = $CACHE->read('sites/', 'html_lock', $site, 'serialize');
	if($lock){
		//有锁定超时则强制解锁
		if(P8_TIME - $lock[1] > 10){
			$CACHE->delete('sites', 'html_lock', $site);
		}else{
			if(REQUEST_METHOD == 'GET'){
				message('html_lock');
			}else{
				exit(p8_json(array('-2')));
			}
		}		
	}
	//生成锁定文件
	$CACHE->write('sites/','html_lock', $site, array($site, P8_TIME), 'serialize');		
	//定义生成静态的常量
	define('P8_GENERATE_HTML', true);
	$uri = '/s.php/'. $site;

	$_SERVER['_REQUEST_URI'] = $uri;
	
	//强制更新缓存
	
	$LABEL = &$core->load_module('label');
	$query = $core->DB_master->fetch_all("SELECT id FROM $LABEL->table WHERE site = '$site' and module = ''");
	$ids = [];
	foreach($query as $label){
		$ids[] = $label['id'];
	}
	$ids && $LABEL->cache(implode(',',$ids));
	
	$index_file = $this_system->path.'/html/'.$site.'/index.html';
	$index_file_bak = $this_system->path.'/html/'.$site.'/index_bak.html';
	$index_file = str_replace(array("./","../",".\\","..\\","..","\\"),'',$index_file);
	$index_file_bak = str_replace(array("./","../",".\\","..\\","..","\\"),'',$index_file_bak);
	ob_start();
	require PHP168_PATH .'s.php';
	$content = ob_get_clean();
	
	
	//文件大于300字节生成
	if(strlen($content)>300 || !file_exists($index_file_bak) || filesize($index_file_bak)<300){
		/*生成新文件替换前换先复制备份*/
		if(file_exists($index_file) && filesize($index_file)>300) cp($index_file, $this_system->path .'/html/'.$site.'/index_bak.html');				
		write_file($index_file, $content);
		/*判断文件是否生成，如生成应大于300字节*/
		if(filesize($index_file) < 300 && filesize($index_file_bak) > 300)
			cp($this_system->path .'/html/'.$site.'/index_bak.html',$index_file);			
	}
	@chmod($index_file, 0644);
	//清除锁定
	$CACHE->delete('sites', 'html_lock', $site);
	if(REQUEST_METHOD == 'GET'){
		message('html_success',$sdata['domain'],2);
	}else{
		exit(p8_json(array($sdata['domain']?$sdata['domain']:$sdata['htmlurl'])));
	}
}