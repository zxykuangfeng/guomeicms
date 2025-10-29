<?php
defined('PHP168_PATH') or die();

/**
* 更新首页
**/
$this_controller->check_action($ACTION) or message('no_privilege');
@set_time_limit(0);
@ignore_user_abort(true);
/*更新模板和标签*/
require_once PHP168_PATH .'inc/cache.func.php';
cache_template();
cache_label();
//锁定检测
$lock = $CACHE->read('cms/', 'html_lock', 'index', 'serialize');		
if(empty($lock) || ($lock && P8_TIME - $lock[1] > 10)){
	$CACHE->delete('cms', 'html_lock', 'index');
	//生成锁定文件
	$CACHE->write('cms/','html_lock', 'index', array('index', P8_TIME), 'serialize');
	
	load_language($core, 'config');
	require_once PHP168_PATH .'inc/cache.func.php';
	cache_label();
	cache_template();
	clear_page_cache();
	define('P8_GENERATE_HTML', true);
	$system = 'cms';
	//生成单个系统的首页
	$this_system = &$core->load_system($system);

	$_SERVER['_REQUEST_URI'] = '/index.php/'. $system;
	ob_start();
	require PHP168_PATH .'index.php';
	$content = ob_get_clean();
	//$content = strlen($content);
	//文件大于300字节生成
	if(strlen($content)>300){
		/*生成新文件替换前换先复制备份*/
		cp($this_system->path .'index.html', $this_system->path .'index_bak.html');
		write_file($this_system->path .'index.html', $content);
		/*判断文件是否生成，如生成应大于300字节*/
		if(filesize($this_system->path .'index.html') < 300)
			cp($this_system->path .'index_bak.html', $this_system->path .'index.html');

		if($core->CONFIG['index_system'] == $system){
			cp(PHP168_PATH .'index.html', PHP168_PATH .'index_bak.html');
			write_file(PHP168_PATH .'index.html', $content);
			if(filesize(PHP168_PATH .'index.html') < 300)
				cp(PHP168_PATH .'index_bak.html', PHP168_PATH .'index.html');
		}
	}
	//移动版
	if(!empty($core->CONFIG['enable_mobile'])){
		//抗干扰
		unset($this_module, $CAT, $data, $TITLE, $SEO_KEYWORDS, $SEO_DESCRIPTION);

		//定义生成静态的常量
		defined('P8_GENERATE_HTML') or define('P8_GENERATE_HTML', true);

		$_SERVER['_REQUEST_URI'] = '/index.php/cms';

		ob_start();
		require PHP168_PATH .'m/index.php';

		$content = ob_get_clean();

		$index_file = $this_system->index_files[$this_system->CONFIG['index_file']];
		$index_file = $index_file ? $index_file : 'index.html';
		if($core->CONFIG['index_system'] == $this_system->name){
			write_file(PHP168_PATH . 'm/'.$index_file, $content);
			@chmod(PHP168_PATH . $index_file, 0644);
		}
	}
	//清除锁定
	$CACHE->delete('cms', 'html_lock', 'index');
	//静态最近5篇内容
	$last_lists = $DB_master->fetch_all("SELECT `id` FROM $this_module->main_table order by `timestamp` desc limit 5");
	$html_ids = $comm = '';
	foreach($last_lists as $list_id){	
		$html_ids .= $comm.$list_id['id'];
		$comm = ',';
	}
	$form = '';
	if($html_ids){
		$form = '<form action="'.$this_module->U_controller.'-view_to_html" method="post" id="__html_vlist__" target="__html_vlist__">'.
			'<input type="hidden" name="action" value="add" />'.
			'<input type="hidden" name="id_range" value="'.$html_ids.'" /></form>'.
			'<iframe style="display: none;" name="__html_vlist__"></iframe>'.
			'<script type="text/javascript">$("#__html_vlist__").submit();</script>';
	}
	if(strpos($FROMURL, '.html') !== false || strpos($FROMURL, '.shtml') !== false || strpos($FROMURL, 'verify') !== false || strpos($FROMURL, '/index.php') !== false || strpos($FROMURL, '/s.php/') !== false) {
		message($P8LANG['done'].$form, $FROMURL, 3);
	}else{
		message($P8LANG['done'].$form,'',0,'',3);
	}
}else{
	message('html_lock','',0,'',0);
}