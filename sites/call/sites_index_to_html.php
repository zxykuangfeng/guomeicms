<?php
defined('PHP168_PATH') or die();

/**
* 首页静态
**/

$system = &$core->load_system('sites');
//抗干扰
unset($this_module, $CAT, $data, $TITLE, $SEO_KEYWORDS, $SEO_DESCRIPTION);

//定义生成静态的常量
defined('P8_GENERATE_HTML') or define('P8_GENERATE_HTML', true);
if(!empty($system->site['config']['indexhtml']))
{
	$index_file = PHP168_PATH.$system->name.'/html/'.$system->SITE.'/index.html';
	$index_file_bak = PHP168_PATH.$system->name.'/html/'.$system->SITE.'/index_bak.html';
	if(!file_exists($index_file) || filesize($index_file) < 300 || filemtime($index_file)<time()-$system->site['config']['indexhtml_ex']*60)
	{
		//锁定检测
		$lock = $CACHE->read('sites/', 'html_lock', $site, 'serialize');		
		if(empty($lock) || ($lock && P8_TIME - $lock[1] > 10)){
			$site = $system->SITE;
			$CACHE->delete('sites', 'html_lock', $site);
			//生成锁定文件
			$CACHE->write('sites/','html_lock', $site, array($site, P8_TIME), 'serialize');	
			//强制更新缓存		
			$LABEL = &$core->load_module('label');		
			$query = $core->DB_master->fetch_all("SELECT id FROM $LABEL->table WHERE site = '$site' and module = ''");
			$ids = [];
			foreach($query as $label){
				$ids[] = $label['id'];
			}
			$ids && $LABEL->cache(implode(',',$ids));
			
			$_SERVER['_REQUEST_URI'] = $system->controller;

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
		}		
	}
}
