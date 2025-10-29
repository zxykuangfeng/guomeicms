<?php
defined('PHP168_PATH') or die();

class P8_Syscheck extends P8_Module{

function __construct(&$system, $name){
	$this->system = &$system;

	parent::__construct($name);
}

function env_check(&$env_items) {
	
}


function sizeformat($bytes){
	$kb = 1024;
	$mb = $kb * 1024;
	$gb = $mb * 1024;
	$tb = $gb * 1024;
	if(($bytes >= 0) && ($bytes < $kb)) {
		return $bytes . ' Bytes';
	} elseif (($bytes >= $kb) && ($bytes < $mb)) {
		return ceil($bytes / $kb) . ' KB';
	} elseif (($bytes >= $mb) && ($bytes < $gb)) {
		return ceil($bytes / $mb) . ' MB';
	} elseif (($bytes >= $gb) && ($bytes < $tb)) {
		return ceil($bytes / $gb) . ' GB';
	} elseif ($bytes >= $tb) {
		return ceil($bytes / $tb) . ' TB';
	} else {
		return $bytes . ' B';
	}
}

function function_check(&$func_items) {
	foreach($func_items as $item) {
		function_exists($item) or show_msg('undefine_func', $item, 0);
	}
}


function get_dirfile_items($dir){
	$scandir = PHP168_PATH.str_replace('./','',$dir);
	$dir_array = scandir($scandir);
	$dirfile_items = array();
	foreach($dir_array as $key => $item){
		if(in_array($item,array('.','..'))) continue;
		$iteminfo = pathinfo($dir.'/'.$item);
		$dirfile_items[$item] = array(
			'type' => isset($iteminfo['extension']) ? 'file' : 'dir',
			'path' => ($dir == './' ? $dir : $dir.'/').$item,
			'extension' => isset($iteminfo['extension']) ? $iteminfo['extension'] : '',
		);
	}
	return $dirfile_items;	
}

function dirfile_check(&$dirfile_items){
	foreach($dirfile_items as $key => $item){
		$path = PHP168_PATH.substr($item['path'],2);
		if(file_exists($path)){
			$info = stat($path);
			$dirfile_items[$key]['ctime'] = date('Y-m-d H:i:s',$info['ctime']);
			$dirfile_items[$key]['mtime'] = date('Y-m-d H:i:s',$info['mtime']);
			$dirfile_items[$key]['need'] = '0444';
			if($item['type'] == 'file'){
				$extension = 'fa-file-text-o';
				if(isset($item['extension']) && $item['extension']){
					switch(strtolower($item['extension'])){
						case 'php':
							$extension = 'fa-file-code-o';
							if(strpos($item['path'],'/data/') || strpos($item['path'],'modules/46/js/0')) $dirfile_items[$key]['need'] = '0644';
							break;
						case 'jpg':
						case 'gif':
						case 'bmp':
						case 'png':
						case 'jpeg':
							$extension = 'fa-file-photo-o';break;
						case 'html':
							$extension = 'fa-html5';
							if(strpos($item['path'],'/html/')) $dirfile_items[$key]['need'] = '0644';
							break;
						case 'pdf':
							$extension = 'fa-file-pdf-o';break;
						case 'mp3':
						case 'mp4':
						case 'avi':
						case 'wmv':
						case 'ogg':
						case 'rmvb':
						case 'flv':
							$extension = 'fa-file-video-o';break;
						case 'doc':
						case 'docx':
							$extension = 'fa-file-word-o';break;
						case 'ppt':
						case 'pptx':
							$extension = 'fa-file-ppt-o';break;
						case 'xls':
						case 'xlsx':
							$extension = 'fa-file-excel-o';break;
						case 'zip':
						case 'rar':
							$extension = 'fa-file-zip-o';break;
						case 'css':
							$extension = 'fa-css3';break;
						case 'js':
							$extension = 'fa-file-code-o';
							break;
						default:
							$extension = 'fa-file-text-o';
					}
				}
				$dirfile_items[$key]['extension'] = $extension;				
				$dirfile_items[$key]['size'] = $this->sizeformat($info['size']);
			}else{
				$dirfile_items[$key]['extension'] = 'fa-folder-o';
				$dirfile_items[$key]['need'] = '0744';
				$dirfile_items[$key]['size'] = '';
				$dirfile_items[$key]['pathid'] = str_replace(array('.','/'),'',$item['path']);
			}
			if(isset($dirfile_items[$key]['pathid']) && empty($dirfile_items[$key]['pathid'])) $dirfile_items[$key]['pathid'] = 'root';
			$dirfile_items[$key]['current'] = substr(base_convert(fileperms($path), 10, 8),-4);
			$dirfile_items[$key]['status'] = $dirfile_items[$key]['current'] >= $dirfile_items[$key]['need'] ? 1 : 0;
			if($item['path'] == './js/config.js') $dirfile_items[$key]['need'] = '0644';
		}else{
			unset($dirfile_items[$key]);
		}				
	}
	return $dirfile_items;
}




}
