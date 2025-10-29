<?php
defined('PHP168_PATH') or die();

/**
* 更新缓存
**/

//var_dump($ACTION);
$this_controller->check_admin_action($ACTION) or message('no_privilege');
@set_time_limit(0);
@ignore_user_abort(true);
load_language($core, 'config');
require_once PHP168_PATH .'inc/cache.func.php';
//$CACHE->delete('', 'core', 'sm_cache_lock');
//$CACHE->delete('', 'core', 'cache_lock');
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
	if($core->CONFIG['index_system'] == $this_system->name){
		write_file(PHP168_PATH . 'm/'.$index_file, $content);
		@chmod(PHP168_PATH . $index_file, 0644);
	}
}
message('done');