<?php
defined('PHP168_PATH') or die();

/**
* 首页生成静态
**/

$site = $_GET['site'] ? xss_clear($_GET['site']) : $this_system->SITE;
$site or message('html_site_must_be_selected');
$mysites = $this_system->get_manage_sites();
!in_array(site,$mysites) or message('no_privilege');
//更新模板缓存
$sdata = $this_system->site;
rm(CACHE_PATH .'template/sites/'.$sdata['template'].'/', true);
$LABEL = &$core->load_module('label');
$query = $core->DB_master->query("SELECT id FROM $LABEL->table WHERE site = '$site'");
while($v = $core->DB_master->fetch_array($query)){
	$LABEL->cache($v['id']);
}   
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

$sdata = $this_system->get_site($site);
	
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

ob_start();
require PHP168_PATH .'s.php';
$content = ob_get_clean();

$index_file = $this_system->path.'/html/'.$site.'/index.html';
//文件大于300字节生成
if(strlen($content)>300){
	/*生成新文件替换前换先复制备份*/
	cp($index_file, $this_system->path .'/html/'.$site.'/index_bak.html');				
	write_file($index_file, $content);
	/*判断文件是否生成，如生成应大于300字节*/
	if(filesize($index_file) < 300)
		cp($this_system->path .'/html/'.$site.'/index_bak.html',$index_file);			
}
@chmod($index_file, 0644);
//清除锁定
$CACHE->delete('sites', 'html_lock', $site);
//静态最近5篇内容
$last_lists = $core->DB_master->fetch_all("SELECT `id` FROM $this_module->main_table WHERE site = '$site' order by `timestamp` desc limit 5");
$html_ids = $comm = '';
foreach($last_lists as $list_id){	
	$html_ids .= $comm.$list_id['id'];
	$comm = ',';
}
$form = '';
if($html_ids){
	$form = '<form action="'.$this_module->U_controller.'-view_to_html" method="post" id="__html_vlist__" target="__html_vlist__">'.
		'<input type="hidden" name="action" value="add" />'.
		'<input type="hidden" name="site" value="'.$site.'">'.
		'<input type="hidden" name="id_range" value="'.$html_ids.'" /></form>'.
		'<iframe style="display: none;" name="__html_vlist__"></iframe>'.
		'<script type="text/javascript">$("#__html_vlist__").submit();</script>';
}
if(strpos($FROMURL, '.html') !== false || strpos($FROMURL, '.shtml') !== false || strpos($FROMURL, 'verify') !== false || strpos($FROMURL, '/index.php') !== false || strpos($FROMURL, '/s.php/') !== false) {
	message($P8LANG['done'].$form, $FROMURL, 3);
}else{
	message($P8LANG['done'].$form,'',0,'',3);
}